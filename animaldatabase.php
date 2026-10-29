<?php
require_once __DIR__ . "/includes/config.php";
class db {
    public $con;
    public function __construct() {
        global $pdo;
        $this->con = $pdo;
    }
}
?>
