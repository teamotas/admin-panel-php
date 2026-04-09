<?php

require_once '../config.php';   
require_once '../core/Auth.php';


$auth = new Auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'] ?? ''; 
    $password = $_POST['password'] ?? '';

    if ($auth->login($email, $password)) {
        header("Location:../pages/dashboard.php");

        exit;
    } else {
        $_SESSION['error'] = "Invalid email or password";
        header("Location: ../index.php");
        exit;
    }
}