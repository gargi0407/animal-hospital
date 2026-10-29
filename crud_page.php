<?php
require_once __DIR__ . "/config.php";

function fieldLabel($name) {
    return ucwords(str_replace("_", " ", $name));
}

function h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}

$error = "";
$notice = "";
$columns = [];
$records = [];
$editRow = null;

try {
    $columns = $pdo->query("SHOW COLUMNS FROM `$table`")->fetchAll();
    $allowed = array_column($columns, "Field");

    if (!in_array($primaryKey, $allowed, true)) {
        throw new RuntimeException("Primary key not found.");
    }

    // DELETE RECORD
    if (isset($_GET["delete"]) && ctype_digit((string)$_GET["delete"])) {
        $stmt = $pdo->prepare(
            "DELETE FROM `$table` WHERE `$primaryKey` = ?"
        );
        $stmt->execute([(int)$_GET["delete"]]);

        header("Location: $self", true, 303);
        exit;
    }

    // GET RECORD FOR EDITING
    if (isset($_GET["edit"]) && ctype_digit((string)$_GET["edit"])) {
        $stmt = $pdo->prepare(
            "SELECT * FROM `$table` WHERE `$primaryKey` = ?"
        );
        $stmt->execute([(int)$_GET["edit"]]);
        $editRow = $stmt->fetch();

        if (!$editRow) {
            $error = "Record not found.";
        }
    }

    // ADD OR UPDATE RECORD
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = isset($_POST[$primaryKey]) && $_POST[$primaryKey] !== ""
            ? (int)$_POST[$primaryKey]
            : 0;

        $values = [];

        foreach ($columns as $column) {
            $name = $column["Field"];

            if (
                $name === $primaryKey ||
                $column["Extra"] === "auto_increment"
            ) {
                continue;
            }

            if (array_key_exists($name, $_POST)) {
                $value = trim((string)$_POST[$name]);

                // Preserve database defaults for empty optional fields.
                if ($value === "" && $column["Default"] !== null) {
                    continue;
                }

                $values[$name] = ($value === "") ? null : $value;
            }
        }

        if (!$values) {
            $error = "No editable fields were found.";
        } else {
            try {
                if ($id > 0) {
                    // UPDATE RECORD
                    $sets = [];

                    foreach (array_keys($values) as $col) {
                        $sets[] = "`$col` = ?";
                    }

                    $sql = "UPDATE `$table` SET "
                         . implode(", ", $sets)
                         . " WHERE `$primaryKey` = ?";

                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(
                        array_merge(array_values($values), [$id])
                    );

                    header("Location: $self?added=1", true, 303);
                    exit;

                } else {
                    // INSERT RECORD
                    $names = array_keys($values);

                    $quoted = array_map(
                        fn($col) => "`$col`",
                        $names
                    );

                    $marks = array_fill(0, count($names), "?");

                    $sql = "INSERT INTO `$table` ("
                         . implode(",", $quoted)
                         . ") VALUES ("
                         . implode(",", $marks)
                         . ")";

                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array_values($values));

                    header("Location: $self?added=1", true, 303);
                    exit;
                }

            } catch (PDOException $e) {
                // Temporary debugging message for local development.
                $error = "Database Error: " . $e->getMessage();
            }
        }
    }

    // SUCCESS MESSAGES
    if (isset($_GET["added"])) {
        $notice = "Record added successfully.";
    }

    if (isset($_GET["updated"])) {
        $notice = "Record updated successfully.";
    }

    // DISPLAY RECORDS
    $records = $pdo->query(
        "SELECT * FROM `$table` ORDER BY `$primaryKey` DESC"
    )->fetchAll();

} catch (Throwable $e) {
    $error = "Error: " . $e->getMessage();
}

// Include header after processing redirects.
require_once __DIR__ . "/header.php";
?>

<h2><?= h($heading) ?></h2>

<p><?= h($description) ?></p>

<?php if ($notice): ?>
    <div class="notice"><?= h($notice) ?></div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="error"><?= h($error) ?></div>
<?php endif; ?>

<?php if ($columns): ?>

<form method="post" action="<?= h($self) ?><?= $editRow ? '?edit=' . (int)$editRow[$primaryKey] : '' ?>">

    <h3><?= $editRow ? "Update Record" : "Add New Record" ?></h3>

    <?php if ($editRow): ?>
        <input
            type="hidden"
            name="<?= h($primaryKey) ?>"
            value="<?= (int)$editRow[$primaryKey] ?>"
        >
    <?php endif; ?>

    <?php foreach ($columns as $column):

        $name = $column["Field"];

        if (
            $name === $primaryKey ||
            $column["Extra"] === "auto_increment"
        ) {
            continue;
        }

        $value = $_POST[$name] ?? ($editRow[$name] ?? "");
        $type = "text";

        if (stripos($name, "email") !== false) {
            $type = "email";
        } elseif (
            stripos($name, "date") !== false &&
            stripos($name, "time") === false
        ) {
            $type = "date";
        } elseif (stripos($name, "time") !== false) {
            $type = "datetime-local";
        } elseif (
            stripos($name, "phone") !== false ||
            stripos($name, "contact") !== false ||
            stripos($name, "mobile") !== false
        ) {
            $type = "tel";
        } elseif (
            stripos($name, "age") !== false ||
            stripos($name, "_id") !== false ||
            stripos($name, "cost") !== false ||
            stripos($name, "fee") !== false
        ) {
            $type = "number";
        }

        $required = (
            $column["Null"] === "NO" &&
            $column["Default"] === null &&
            $column["Extra"] !== "auto_increment"
        );

        $inputValue = (string)$value;

        if ($type === "datetime-local" && $inputValue !== "") {
            $inputValue = str_replace(
                " ",
                "T",
                substr($inputValue, 0, 16)
            );
        }
    ?>

        <label for="<?= h($name) ?>">
            <?= h(fieldLabel($name)) ?>
        </label>

        <?php if (
            stripos($name, "description") !== false ||
            stripos($name, "address") !== false ||
            stripos($name, "notes") !== false
        ): ?>

            <textarea
                id="<?= h($name) ?>"
                name="<?= h($name) ?>"
                <?= $required ? "required" : "" ?>
            ><?= h($inputValue) ?></textarea>

        <?php else: ?>

            <input
                id="<?= h($name) ?>"
                type="<?= h($type) ?>"
                name="<?= h($name) ?>"
                value="<?= h($inputValue) ?>"
                <?= $required ? "required" : "" ?>
                <?= $type === "number" ? 'min="0" step="any"' : "" ?>
            >

        <?php endif; ?>

    <?php endforeach; ?>

    <br><br>

    <input
        type="submit"
        value="<?= $editRow ? "Save Changes" : "Add Record" ?>"
    >

    <?php if ($editRow): ?>
        <a class="button" href="<?= h($self) ?>">Cancel</a>
    <?php endif; ?>

</form>

<?php endif; ?>

<h3>Saved Records</h3>

<div class="table-wrap">
<table>

    <?php if ($records): ?>

        <thead>
            <tr>
                <?php foreach (array_keys($records[0]) as $col): ?>
                    <th><?= h(fieldLabel($col)) ?></th>
                <?php endforeach; ?>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($records as $record): ?>
                <tr>
                    <?php foreach ($record as $value): ?>
                        <td><?= h($value) ?></td>
                    <?php endforeach; ?>

                    <td>
                        <div class="actions">
                            <a
                                class="small-button"
                                href="<?= h($self) ?>?edit=<?= (int)$record[$primaryKey] ?>"
                            >Edit</a>

                            <a
                                class="small-button delete-button"
                                href="<?= h($self) ?>?delete=<?= (int)$record[$primaryKey] ?>"
                                onclick="return confirm('Are you sure you want to delete this record?')"
                            >Delete</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    <?php else: ?>

        <thead>
            <tr><th>Records</th></tr>
        </thead>

        <tbody>
            <tr><td>No records found yet.</td></tr>
        </tbody>

    <?php endif; ?>

</table>
</div>

<?php require_once __DIR__ . "/footer.php"; ?>