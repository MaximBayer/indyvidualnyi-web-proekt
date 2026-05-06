<?php
require_once '../function.php';
require_admin_auth();

$data = [
    'title' => trim($_POST['title'] ?? ''),
    'content' => trim($_POST['content'] ?? ''),
    'category_id' => (int)($_POST['category_id'] ?? 0),
    'published_at' => $_POST['published_at'] ?? date('Y-m-d'),
    'image' => handle_upload('image')
];

if ($data['title'] === '' || $data['content'] === '' || $data['category_id'] <= 0) {
    header('Location: add-new.php');
    exit;
}

create_post($data);
header('Location: index.php');
exit;

