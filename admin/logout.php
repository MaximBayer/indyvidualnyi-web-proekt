<?php
session_start();
unset($_SESSION['is_admin'], $_SESSION['admin_login']);
header('Location: ../login/index.php');
exit;

