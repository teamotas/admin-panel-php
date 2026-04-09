<nav class="navbar navbar-dark bg-dark px-3">
    <span class="navbar-brand">Admin Panel</span>

    <div>
        <span class="text-white me-3">
            <?= $_SESSION['name'] ?? 'Admin'; ?>
        </span>
        <a href="../actions/logout.php" class="btn btn-sm btn-danger">Logout</a>
    </div>
</nav>