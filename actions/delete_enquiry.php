<?php
require_once '../core/Auth.php';
require_once '../core/Database.php';

$auth = new Auth();

if (!$auth->check()) {
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $db = new Database();
    $conn = $db->connect();

    $stmt = $conn->prepare("DELETE FROM contact_forms WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: ../pages/enquiries.php");
exit;