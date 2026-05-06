<?php
require_once __DIR__ . '/conf.php';

function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function get_categories(): array {
    global $conn;
    $sql = 'SELECT id, name FROM categories ORDER BY name';
    $result = mysqli_query($conn, $sql);
    return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
}

function get_news(?int $categoryId = null): array {
    global $conn;
    $sql = 'SELECT n.id, n.title, n.content, n.image, n.published_at, c.name AS category_name
            FROM news n
            LEFT JOIN categories c ON c.id = n.category_id';

    if ($categoryId !== null) {
        $sql .= ' WHERE n.category_id = ?';
    }

    $sql .= ' ORDER BY n.published_at DESC, n.id DESC';
    $stmt = mysqli_prepare($conn, $sql);

    if ($categoryId !== null) {
        mysqli_stmt_bind_param($stmt, 'i', $categoryId);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function get_post_by_id(int $postId): ?array {
    global $conn;
    $sql = 'SELECT n.*, c.name AS category_name
            FROM news n
            LEFT JOIN categories c ON c.id = n.category_id
            WHERE n.id = ? LIMIT 1';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $postId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $post = mysqli_fetch_assoc($result);
    return $post ?: null;
}

function get_category_title(int $categoryId): ?array {
    global $conn;
    $sql = 'SELECT id, name FROM categories WHERE id = ? LIMIT 1';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $categoryId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $category = mysqli_fetch_assoc($result);
    return $category ?: null;
}

function create_post(array $data): bool {
    global $conn;
    $sql = 'INSERT INTO news (title, content, image, category_id, published_at)
            VALUES (?, ?, ?, ?, ?)';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param(
        $stmt,
        'sssis',
        $data['title'],
        $data['content'],
        $data['image'],
        $data['category_id'],
        $data['published_at']
    );
    return mysqli_stmt_execute($stmt);
}

function update_post(int $id, array $data): bool {
    global $conn;
    $sql = 'UPDATE news
            SET title = ?, content = ?, image = ?, category_id = ?, published_at = ?
            WHERE id = ?';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param(
        $stmt,
        'sssisi',
        $data['title'],
        $data['content'],
        $data['image'],
        $data['category_id'],
        $data['published_at'],
        $id
    );
    return mysqli_stmt_execute($stmt);
}

function delete_post(int $id): bool {
    global $conn;
    $sql = 'DELETE FROM news WHERE id = ?';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    return mysqli_stmt_execute($stmt);
}

function require_admin_auth(): void {
    session_start();
    if (empty($_SESSION['is_admin'])) {
        header('Location: ../login/index.php');
        exit;
    }
}

function handle_upload(string $field = 'image'): string {
    $defaultImage = 'https://via.placeholder.com/800x400?text=No+Image';
    if (empty($_FILES[$field]['name']) || empty($_FILES[$field]['tmp_name'])) {
        return $defaultImage;
    }

    $file = $_FILES[$field];
    $allowed = ['image/jpeg', 'image/png', 'image/webp'];

    if (!in_array($file['type'], $allowed, true)) {
        return $defaultImage;
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $safeName = uniqid('post_', true) . '.' . strtolower($ext);
    $target = __DIR__ . '/uploads/' . $safeName;

    if (move_uploaded_file($file['tmp_name'], $target)) {
        return 'uploads/' . $safeName;
    }

    return $defaultImage;
}

