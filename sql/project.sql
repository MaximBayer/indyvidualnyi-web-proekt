CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(500) NOT NULL,
    category_id INT NOT NULL,
    published_at DATE NOT NULL,
    CONSTRAINT fk_news_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO categories (id, name) VALUES
(1, 'Технології'),
(2, 'Освіта'),
(3, 'Події');

INSERT IGNORE INTO news (id, title, content, image, category_id, published_at) VALUES
(1, 'Перший запис проєкту', 'Це демо-контент для перевірки роботи виведення списку новин.', 'https://via.placeholder.com/800x400?text=News+1', 1, '2026-05-01'),
(2, 'Навчальна стаття', 'Тут розміщений приклад детального тексту новини для сторінки post.php.', 'https://via.placeholder.com/800x400?text=News+2', 2, '2026-05-03'),
(3, 'Анонс події', 'Запис для перевірки фільтрації по категорії та роботи меню.', 'https://via.placeholder.com/800x400?text=News+3', 3, '2026-05-05');