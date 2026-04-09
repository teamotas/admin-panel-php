<?php require_once __DIR__ . '../config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- Bootstrap 5 CDN (lighter & modern) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4e73df, #224abe);
            height: 100vh;
        }
        .login-card {
            border-radius: 12px;
        }
        .form-control {
            height: 45px;
        }
        .logo {
            max-height: 60px;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">

<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-4 col-sm-10">
            <div class="card shadow login-card p-4">

                <!-- Logo -->
                <div class="text-center mb-3">
                    <img src="./assets/img/logo.png" class="logo" alt="logo">
                </div>

                <h4 class="text-center mb-4">Admin Login</h4>

                <!-- ERROR MESSAGE -->
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="./actions/login.php">

                    <div class="mb-3">
                        <label class="form-label">Email Id</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100" id="loginBtn">
                        Login
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

<script>
document.querySelector("form").addEventListener("submit", function() {
    document.getElementById("loginBtn").innerText = "Logging...";
});
</script>

</body>
</html>