<?php
session_start();
include __DIR__ . '/../includes/koneksi.php';

if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    if ($user == 'admin' && $pass == 'admin123') {
        $_SESSION['admin'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            border-radius: 15px;
            overflow: hidden;
        }

        .login-header {
            background: #1e3c72;
            color: white;
            text-align: center;
            padding: 25px;
        }

        .login-header i {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-login {
            background: #1e3c72;
            border: none;
            border-radius: 50px;
            padding: 10px;
            font-weight: bold;
        }

        .btn-login:hover {
            background: #16325c;
        }
    </style>
</head>
<body>

<div class="col-md-4">
    <div class="card shadow login-card">

        <div class="login-header">
            <i class="fas fa-user-shield"></i>
            <h4 class="mt-2 mb-0">ADMIN LOGIN</h4>
            <small>Silakan masuk ke dashboard</small>
        </div>

        <div class="card-body p-4">

            <?php if(isset($error)) : ?>
                <div class="alert alert-danger text-center">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>

                <button name="login" class="btn btn-login w-100 text-white">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>

        </div>

        <div class="card-footer text-center small text-muted">
            © <?= date('Y') ?> Admin Panel
        </div>

    </div>
</div>

</body>
</html>
