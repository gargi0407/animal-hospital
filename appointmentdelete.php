<?php
// Compatibility redirect: use the Delete button on appointmentinfo.php.
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if ($id) {
    header("Location: appointmentinfo.php?delete=" . $id);
} else {
    header("Location: appointmentinfo.php");
}
exit;
?>
