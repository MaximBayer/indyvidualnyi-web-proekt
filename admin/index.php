<?php
require_once '../function.php';
require_admin_auth();
$posts = get_news();
?>
<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Адмін-панель</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="m-0">Адмін-панель</h2>
        <div>
            <a href="add-new.php" class="btn btn-success me-2">Додати новину</a>
            <a href="logout.php" class="btn btn-outline-secondary">Вийти</a>
        </div>
    </div>

    <table class="table table-striped align-middle">
        <thead>
        <tr>
            <th>ID</th>
            <th>Заголовок</th>
            <th>Категорія</th>
            <th>Дата</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($posts as $post): ?>
            <tr>
                <td><?= (int)$post['id']; ?></td>
                <td><?= e($post['title']); ?></td>
                <td><?= e($post['category_name'] ?? 'Без категорії'); ?></td>
                <td><?= e($post['published_at']); ?></td>
                <td>
                    <a href="edit-new.php?post_id=<?= (int)$post['id']; ?>" class="btn btn-sm btn-info">Редагувати</a>
                    <a href="delete-new.php?post_id=<?= (int)$post['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Видалити запис?')">Видалити</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>

