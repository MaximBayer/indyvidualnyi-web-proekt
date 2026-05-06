<?php
require_once '../function.php';
require_admin_auth();

$postId = $_GET['post_id'] ?? '';
if (is_numeric($postId)) {
    delete_post((int)$postId);
}

header('Location: index.php');
exit;

