<?php
date_default_timezone_set('Asia/Kolkata');

class PDOModel {
    public $db;
    public $config = array();

    function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=idsystem;charset=utf8', 'root', '');
            // Enable PDO exceptions for error handling
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //var_dump("Database connection established.");
        } catch (PDOException $e) {
            echo "<h1>Error establishing a database connection: " . $e->getMessage() . "</h1>";
            die();
        }
    }

    // Function to return the PDO instance
    public function getDb() {
        return $this->db;
    }
}
?>
