<?php

class Database
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            // Переконайтеся, що ROOT_DIR визначено в init.php
            $config = require ROOT_DIR . '/config/database.php';

            try {
                // ТУТ НЕ МОЖЕ БУТИ $this! Тільки створення нового об'єкта
                self::$instance = new PDO(
                    $config['dsn'],
                    $config['username'] ?? null,
                    $config['password'] ?? null
                );
                
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                if (strpos($config['dsn'], 'sqlite') === 0) {
                    self::$instance->exec('PRAGMA foreign_keys = ON');
                }
            } catch (PDOException $e) {
                die("Технічна помилка підключення: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}