<?php require_once 'header.php'; ?>
<div class="container">
    <div class="row g-4">
        <?php $news = get_news(); ?>
        <?php foreach ($news as $item): ?>
            <div class="col-md-6">
                <article class="card h-100 shadow-sm">
                    <img src="<?= e($item['image']); ?>" class="card-img-top post-image" alt="Зображення новини">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= e($item['title']); ?></h5>
                        <p class="text-muted small mb-2">Категорія: <?= e($item['category_name'] ?? 'Без категорії'); ?></p>
                        <p class="card-text"><?= e(mb_substr($item['content'], 0, 150)) . '...'; ?></p>
                        <a href="post.php?post_id=<?= (int)$item['id']; ?>" class="btn btn-primary mt-auto">Читати далі</a>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php require_once 'footer.php'; ?>

