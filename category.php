<?php
require_once 'header.php';
$categoryId = $_GET['category_id'] ?? '';
if (!is_numeric($categoryId)) {
    http_response_code(400);
    echo '<div class="container"><div class="alert alert-danger">Некоректний ID категорії.</div></div>';
    require_once 'footer.php';
    exit;
}
$category = get_category_title((int)$categoryId);
$posts = get_news((int)$categoryId);
?>
<div class="container">
    <h2 class="mb-3"><?= e($category['name'] ?? 'Категорія'); ?></h2>
    <div class="row g-4">
        <?php if (!$posts): ?>
            <div class="col-12"><div class="alert alert-info">У цій категорії поки немає записів.</div></div>
        <?php endif; ?>
        <?php foreach ($posts as $post): ?>
            <div class="col-md-6">
                <article class="card h-100 shadow-sm">
                    <img src="<?= e($post['image']); ?>" class="card-img-top post-image" alt="Зображення новини">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= e($post['title']); ?></h5>
                        <p class="card-text"><?= e(mb_substr($post['content'], 0, 140)) . '...'; ?></p>
                        <a href="post.php?post_id=<?= (int)$post['id']; ?>" class="btn btn-primary mt-auto">Детальніше</a>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php require_once 'footer.php'; ?>

