<?php

class UploadController extends PageController
{
    private string $uploadDir;
    private array $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    private int $maxSize = 5 * 1024 * 1024; // 5 MB

    public function __construct()
    {
        parent::__construct();
        // Використовуємо константу DATA_DIR, переконайтеся, що вона визначена в init.php
        $this->uploadDir = DATA_DIR . '/uploads';

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }
    }

    public function action_index(): void
    {
        $message = '';
        $error = '';

        if ($this->request->isPost() && isset($_FILES['image'])) {
            $file = $_FILES['image'];

            if ($file['error'] !== UPLOAD_ERR_OK) {
                $error = 'Помилка завантаження файлу (код: ' . $file['error'] . ').';
            } elseif ($file['size'] > $this->maxSize) {
                $error = 'Максимальний розмір файлу: 5 МБ.';
            } else {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                
                // Перевірка 1: Чи дозволене розширення
                if (!in_array($ext, $this->allowedExtensions, true)) {
                    $error = 'Недопустимий формат файлу. Дозволено: JPG, PNG, GIF, WebP.';
                } else {
                    // Перевірка 2: Чи це дійсно зображення (заміна finfo)
                    $check = getimagesize($file['tmp_name']);
                    if ($check === false) {
                        $error = 'Файл не є дійсним зображенням.';
                    }
                }
            }

            if ($error === '' && isset($ext)) {
                // Генеруємо безпечне ім'я
                $safeName = time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
                $dest = $this->uploadDir . '/' . $safeName;

                if (move_uploaded_file($file['tmp_name'], $dest)) {
                    $message = 'Зображення "' . htmlspecialchars($file['name']) . '" завантажено!';
                } else {
                    $error = 'Не вдалося зберегти файл. Перевірте права доступу до папки data/uploads/.';
                }
            }
        }

        $images = $this->getImages();

        $this->render('upload/index', [
            'images' => $images,
            'message' => $message,
            'error' => $error,
        ], 'Завантаження зображень');
    }

    private function getImages(): array
    {
        $images = [];
        // Шукаємо файли в папці uploads
        $files = glob($this->uploadDir . '/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);

        if ($files) {
            rsort($files); // Нові завантаження будуть першими
            foreach ($files as $file) {
                $images[] = [
                    'name' => basename($file),
                    'url' => 'data/uploads/' . basename($file),
                    'size' => filesize($file),
                    'date' => date('Y-m-d H:i', filemtime($file)),
                ];
            }
        }

        return $images;
    }
}