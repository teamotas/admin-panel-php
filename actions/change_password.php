<?php
require_once '../core/Auth.php';

$auth = new Auth();

$userId = $_SESSION['admin_id'];

$old = $_POST['old_password'];
$new = $_POST['new_password'];

if ($auth->changePassword($userId, $old, $new)) {
    $_SESSION['success'] = "Password updated";
} else {
    $_SESSION['error'] = "Wrong old password";
}

header("Location: ../pages/settings.php");
exit;