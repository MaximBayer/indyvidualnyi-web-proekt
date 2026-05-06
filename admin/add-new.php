<?php
require_once '../function.php';
require_admin_auth();
$categories = get_categories();
?>
<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Додавання новини</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h3 class="mb-3">Додати новину</h3>
    <form action="check-new.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Заголовок</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Текст</label>
            <textarea name="content" class="form-control" rows="8" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Категорія</label>
            <select name="category_id" class="form-select" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= (int)$category['id']; ?>"><?= e($category['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Дата публікації</label>
            <input type="date" name="published_at" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Зображення</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Створити</button>
        <a href="index.php" class="btn btn-secondary">Скасувати</a>
    </form>
</div>
</body>
</html>

