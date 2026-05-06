<?php
require_once '../function.php';
require_admin_auth();

$postId = (int)($_POST['id'] ?? 0);
$post = get_post_by_id($postId);
if ($postId <= 0 || !$post) {
    header('Location: index.php');
    exit;
}

$newImage = handle_upload('image');
$image = $newImage === 'uploads/no-image.jpg' ? $post['image'] : $newImage;

$data = [
    'title' => trim($_POST['title'] ?? ''),
    'content' => trim($_POST['content'] ?? ''),
    'category_id' => (int)($_POST['category_id'] ?? 0),
    'published_at' => $_POST['published_at'] ?? date('Y-m-d'),
    'image' => $image
];

if ($data['title'] === '' || $data['content'] === '' || $data['category_id'] <= 0) {
    header('Location: edit-new.php?post_id=' . $postId);
    exit;
}

update_post($postId, $data);
header('Location: index.php');
exit;

