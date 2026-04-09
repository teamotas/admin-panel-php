<?php
require_once '../core/Auth.php';
require_once '../core/Database.php';

$auth = new Auth();

if (!$auth->check()) {
    header("Location: ../index.php");
    exit;
}

// DB setup
$db = new Database();
$db->connect();

// fetch data
$result = $db->getEnquiries();

$contact_entries = ($result && $result->num_rows > 0) 
    ? $result->num_rows 
    : 0;
?>


<?php include('../layout/header.php'); ?>
<?php include('../layout/navbar.php'); ?>
<?php include('../layout/sidebar.php'); ?>

<h2>Dashboard</h2>
<p>Welcome, <?= $_SESSION['name']; ?> 👋</p>

<div class="card p-3 shadow-sm">
    <h5>Total Enquiries</h5>
    <h2><?= $contact_entries ?></h2>
</div>
<?php include('../layout/footer.php'); ?>
<?php include('../layout/footer-close.php'); ?>
