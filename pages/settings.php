<?php
require_once '../core/Auth.php';
require_once '../core/Settings.php';

$auth = new Auth();
if (!$auth->check()) {
    header("Location: ../index.php");
    exit;
}

$settingsObj = new Settings();
$settings = $settingsObj->get();

// step control
$step = $_GET['step'] ?? 'site';
?>

<?php include('../layout/header.php'); ?>
<?php include('../layout/navbar.php'); ?>
<?php include('../layout/sidebar.php'); ?>

<h2>Settings</h2>

<!-- STEP NAV -->
<div class="mb-3">
    <a href="?step=site">Site</a> |
    <a href="?step=contact">Contact</a> |
    <a href="?step=social">Social</a>
</div>

<form method="POST" action="../actions/update_settings.php" enctype="multipart/form-data">

<?php if($step == 'site'): ?>

    <h4>Site Settings</h4>

    <input type="text" name="site_name" value="<?= $settings['site_name'] ?? '' ?>" placeholder="Site Name" class="form-control mb-2">

    <input type="file" name="logo" class="form-control mb-2">

<?php elseif($step == 'contact'): ?>

    <h4>Contact Settings</h4>

    <input type="text" name="email" value="<?= $settings['email'] ?? '' ?>" placeholder="Email" class="form-control mb-2">

    <input type="text" name="phone" value="<?= $settings['phone'] ?? '' ?>" placeholder="Phone" class="form-control mb-2">

    <textarea name="address" class="form-control mb-2"><?= $settings['address'] ?? '' ?></textarea>

<?php elseif($step == 'social'): ?>

    <h4>Social Links</h4>

    <input type="text" name="facebook" value="<?= $settings['facebook']  ?? '' ?>" placeholder="Facebook" class="form-control mb-2">

    <input type="text" name="instagram" value="<?= $settings['instagram']  ?? '' ?>" placeholder="Instagram" class="form-control mb-2">

    <input type="text" name="linkedin" value="<?= $settings['linkedin']  ?? '' ?>" placeholder="LinkedIn" class="form-control mb-2">

    <input type="text" name="twitter" value="<?= $settings['twitter']  ?? '' ?>" placeholder="Twitter" class="form-control mb-2">

    <input type="text" name="youtube" value="<?= $settings['youtube']  ?? '' ?>" placeholder="YouTube" class="form-control mb-2">

<?php endif; ?>

<button class="btn btn-primary mt-2">Save</button>

</form>

<?php include('../layout/footer.php'); ?>
<?php include('../layout/footer-close.php'); ?>