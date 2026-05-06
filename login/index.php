<?php
session_start();
if (!empty($_SESSION['is_admin'])) {
    header('Location: ../admin/index.php');
    exit;
}
$error = $_GET['error'] ?? '';
?>
<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід в адмінку</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="mb-4">Вхід в адмін-панель</h3>
                    <?php if ($error): ?>
                        <div class="alert alert-danger">Невірний логін або пароль.</div>
                    <?php endif; ?>
                    <form method="post" action="check-login.php">
                        <div class="mb-3">
                            <label class="form-label">Логін</label>
                            <input type="text" name="login" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Пароль</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Увійти</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

