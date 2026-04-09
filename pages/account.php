<?php
require_once '../core/Auth.php';

$auth = new Auth();
if (!$auth->check()) {
    header("Location: ../index.php");
    exit;
}

$step = $_GET['step'] ?? 'profile';
?>

<?php include('../layout/header.php'); ?>
<?php include('../layout/navbar.php'); ?>
<?php include('../layout/sidebar.php'); ?>

<h2>Account Settings</h2>

<div class="mb-3">
    <a href="?step=profile">Profile</a> |
    <a href="?step=password">Change Password</a>
</div>

<?php if($step == 'profile'): ?>

<form method="POST" action="../actions/update_account.php">

    <input type="text" name="name" value="<?= $_SESSION['name'] ?>" class="form-control mb-2">

    <button class="btn btn-primary">Update Profile</button>

</form>

<?php elseif($step == 'password'): ?>

<form method="POST" action="../actions/change_password.php">

    <input type="password" name="old_password" placeholder="Old Password" class="form-control mb-2">

    <input type="password" name="new_password" placeholder="New Password" class="form-control mb-2">

    <button class="btn btn-danger">Change Password</button>

</form>

<?php endif; ?>

<?php include('../layout/footer.php'); ?>
<?php include('../layout/footer-close.php'); ?>
