<?php
session_start();
$adminLogin = 'admin';
$adminPassword = '123';

$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';

if ($login === $adminLogin && $password === $adminPassword) {
    $_SESSION['is_admin'] = true;
    $_SESSION['admin_login'] = $login;
    header('Location: ../admin/index.php');
    exit;
}

header('Location: index.php?error=1');
exit;

