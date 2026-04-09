<?php

require_once '../config.php';

class Database {

    public $conn;

    public function connect() {
        $this->conn = new mysqli(
            DB_HOST,
            DB_USER,
            DB_PASS,
            DB_NAME
        );

        if ($this->conn->connect_error) {
            die("DB Error: " . $this->conn->connect_error);
        }

        return $this->conn;
    }

    public function getEnquiries() {
        $sql = "SELECT * FROM contact_forms ORDER BY created_at DESC";
        return $this->conn->query($sql);
    }

}