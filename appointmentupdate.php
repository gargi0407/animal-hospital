<?php
// Compatibility redirect: open appointmentinfo.php and select Edit beside a record.
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if ($id) {
    header("Location: appointmentinfo.php?edit=" . $id);
} else {
    header("Location: appointmentinfo.php");
}
exit;
?>
