<?php
$host = 'sql107.infinityfree.com';
$user = 'if0_39990083';
$pass = 'c4XGpyHXnxBcEY';
$dbname = 'if0_39990083_project';

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die('Помилка підключення до БД: ' . mysqli_connect_error());
}

mysqli_set_charset($conn, 'utf8mb4');

