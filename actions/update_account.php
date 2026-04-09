<?php
require_once '../core/Database.php';

session_start();

$db = new Database();
$conn = $db->connect();

$name = $_POST['name'];
$id = $_SESSION['admin_id'];

$stmt = $conn->prepare("UPDATE users SET name=? WHERE id=?");
$stmt->bind_param("si", $name, $id);
$stmt->execute();

$_SESSION['name'] = $name;

header("Location: ../pages/account.php");
exit;