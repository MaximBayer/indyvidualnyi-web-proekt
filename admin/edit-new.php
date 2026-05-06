<?php
require_once '../function.php';
require_admin_auth();

$postId = $_GET['post_id'] ?? '';
if (!is_numeric($postId)) {
    header('Location: index.php');
    exit;
}

$post = get_post_by_id((int)$postId);
if (!$post) {
    header('Location: index.php');
    exit;
}
$categories = get_categories();
?>
<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагування новини</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h3 class="mb-3">Редагувати новину</h3>
    <form action="update-new.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= (int)$post['id']; ?>">

        <div class="mb-3">
            <label class="form-label">Заголовок</label>
            <input type="text" name="title" class="form-control" value="<?= e($post['title']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Текст</label>
            <textarea name="content" class="form-control" rows="8" required><?= e($post['content']); ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Категорія</label>
            <select name="category_id" class="form-select" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= (int)$category['id']; ?>" <?= ((int)$category['id'] === (int)$post['category_id']) ? 'selected' : ''; ?>>
                        <?= e($category['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Дата публікації</label>
            <input type="date" name="published_at" class="form-control" value="<?= e($post['published_at']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Нове зображення (необов'язково)</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            <small class="text-muted">Поточне: <?= e($post['image']); ?></small>
        </div>
        <button type="submit" class="btn btn-primary">Зберегти</button>
        <a href="index.php" class="btn btn-secondary">Скасувати</a>
    </form>
</div>
</body>
</html>

