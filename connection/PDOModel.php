<?php
date_default_timezone_set('Asia/Kolkata');

class PDOModel {
    public $db;
    public $config = array();

    function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=id_system;charset=utf8', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            var_dump($this->db);
        } catch (PDOException $e) {
            echo "<h1>Error establishing a database connection</h1>";
            // Optionally log the error message for debugging purposes
            error_log($e->getMessage());
            die();
        }
        var_dump("test");
    }
}
var_dump("test 2");
?>
