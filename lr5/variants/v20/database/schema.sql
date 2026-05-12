-- Таблиця користувачів (10 полів за завданням)
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    login VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone VARCHAR(20) DEFAULT '',
    city VARCHAR(50) DEFAULT '',
    gender VARCHAR(10) DEFAULT '',
    about TEXT DEFAULT '',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Таблиця замовлень для Пральні (CRUD)
CREATE TABLE IF NOT EXISTS orders (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    client_name VARCHAR(100) NOT NULL,
    service_type VARCHAR(50) NOT NULL, -- прання, хімчистка, глажка
    weight_kg DECIMAL(5,2) NOT NULL,
    price DECIMAL(8,2) NOT NULL,
    status VARCHAR(30) DEFAULT 'прийнято', -- прийнято, в роботі, готово
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Початкові дані для тестування
INSERT INTO orders (client_name, service_type, weight_kg, price, status) VALUES
('Іванов Іван', 'Прання', 5.5, 250.00, 'готово'),
('Марія Петренко', 'Хімчистка', 2.0, 600.00, 'в роботі'),
('Олексій Сидорчук', 'Глажка', 3.2, 150.00, 'прийнято');