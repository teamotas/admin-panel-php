<?php

require_once '../config.php';
require_once 'Database.php';

class Auth {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
        session_start();
    }

    public function login($email, $password) {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {

                session_regenerate_id(true);

                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];

                return true;
            }
        }
        
        return false;
    }

    public function check() {
        return isset($_SESSION['admin_id']);
    }

    public function logout() {
        session_unset();
        session_destroy();
    }

    public function changePassword($userId, $oldPassword, $newPassword) {

        $stmt = $this->conn->prepare("SELECT password FROM users WHERE id=?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();

        if (!password_verify($oldPassword, $result['password'])) {
            return false;
        }

        $newHash = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("UPDATE users SET password=? WHERE id=?");
        $stmt->bind_param("si", $newHash, $userId);

        return $stmt->execute();
    }

}

