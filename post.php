<?php
require_once 'header.php';
$postId = $_GET['post_id'] ?? '';
if (!is_numeric($postId)) {
    http_response_code(400);
    echo '<div class="container"><div class="alert alert-danger">Некоректний ID запису.</div></div>';
    require_once 'footer.php';
    exit;
}
$post = get_post_by_id((int)$postId);
if (!$post) {
    http_response_code(404);
    echo '<div class="container"><div class="alert alert-warning">Новину не знайдено.</div></div>';
    require_once 'footer.php';
    exit;
}
?>
<div class="container">
    <div class="card shadow-sm">
        <img src="<?= e($post['image']); ?>" class="card-img-top post-image" alt="Зображення новини">
        <div class="card-body">
            <h2 class="card-title"><?= e($post['title']); ?></h2>
            <p class="text-muted">Категорія: <?= e($post['category_name'] ?? 'Без категорії'); ?> | Дата: <?= e($post['published_at']); ?></p>
            <p class="card-text"><?= nl2br(e($post['content'])); ?></p>
            <a href="index.php" class="btn btn-secondary">Назад</a>
        </div>
    </div>
</div>
<?php require_once 'footer.php'; ?>

