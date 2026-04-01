<?php
/**
 * Завдання 10: Реєстраційна форма
 *
 * Варіант 20
 */
session_start();
require_once __DIR__ . '/layout.php';

// --- Мова (Cookie на 6 місяців) ---
$languages = [
    'uk' => 'Українська',
    'en' => 'English',
    'de' => 'Deutsch',
];

// --- Міста (Варіант 20) ---
$cities = ['Київ', 'Львів', 'Одеса', 'Харків', 'Дніпро', 'Запоріжжя', 'Вінниця', 'Полтава', 'Чернігів', 'Тернопіль'];

$hobbies = ['sport' => 'Спорт', 'music' => 'Музика', 'reading' => 'Читання', 'gaming' => 'Ігри'];

$sessionData = $_SESSION['reg_data'] ?? [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $city = $_POST['city'] ?? '';
    $selectedHobbies = $_POST['hobbies'] ?? [];
    $about = trim($_POST['about'] ?? '');

    // Валідація
    if ($login === '') $errors[] = 'Логін не може бути порожнім';
    if (strlen($password) < 4) $errors[] = 'Пароль повинен бути не менше 4 символів';
    if ($password !== $password2) $errors[] = 'Паролі не збігаються';
    if (empty($gender)) $errors[] = 'Оберіть стать';
    if (empty($city)) $errors[] = 'Оберіть місто';

    // Завантаження фото
    $photoPath = $sessionData['photo'] ?? '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        
        $newName = uniqid('img_') . '.' . pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $newName)) {
            $photoPath = 'uploads/' . $newName;
        }
    }

    // Збереження в сесію
    $_SESSION['reg_data'] = [
        'login' => $login,
        'gender' => $gender,
        'city' => $city,
        'hobbies' => $selectedHobbies,
        'about' => $about,
        'photo' => $photoPath
    ];

    if (empty($errors)) {
        header('Location: task10_result.php');
        exit;
    }
}

// Автозаповнення: пріоритет POST -> Сесія -> Дефолтний логін
$formData = [
    'login' => $_POST['login'] ?? $sessionData['login'] ?? 'grigoriy_b20',
    'gender' => $_POST['gender'] ?? $sessionData['gender'] ?? '',
    'city' => $_POST['city'] ?? $sessionData['city'] ?? '',
    'hobbies' => $_POST['hobbies'] ?? $sessionData['hobbies'] ?? [],
    'about' => $_POST['about'] ?? $sessionData['about'] ?? '',
];

ob_start();
?>
<div class="demo-card">
    <h2>Реєстрація (Варіант 20)</h2>
    
    <div class="lang-selector">
        <?php foreach ($languages as $code => $name): ?>
            <a href="?lang=<?= $code ?>" style="<?= $lang === $code ? 'font-weight:bold; color:green;' : '' ?>">
                [<?= strtoupper($code) ?>]
            </a>
        <?php endforeach; ?>
    </div>

    <?php if ($errors): ?>
        <div style="color: red; border: 1px solid red; padding: 10px; margin: 10px 0;">
            <?php foreach ($errors as $e) echo "<li>$e</li>"; ?>
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <p>Логін: <input type="text" name="login" value="<?= htmlspecialchars($formData['login']) ?>"></p>
        <p>Пароль: <input type="password" name="password"> Повтор: <input type="password" name="password2"></p>
        
        <p>Стать: 
            <input type="radio" name="gender" value="male" <?= $formData['gender']=='male'?'checked':'' ?>> Чоловік
            <input type="radio" name="gender" value="female" <?= $formData['gender']=='female'?'checked':'' ?>> Жінка
        </p>

        <p>Місто: 
            <select name="city">
                <option value="">-- Оберіть --</option>
                <?php foreach ($cities as $c): ?>
                    <option value="<?= $c ?>" <?= $formData['city']==$c?'selected':'' ?>><?= $c ?></option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>Хобі:<br>
            <?php foreach ($hobbies as $k => $v): ?>
                <input type="checkbox" name="hobbies[]" value="<?= $k ?>" <?= in_array($k, $formData['hobbies'])?'checked':'' ?>> <?= $v ?>
            <?php endforeach; ?>
        </p>

        <p>Про себе:<br><textarea name="about"><?= htmlspecialchars($formData['about']) ?></textarea></p>
        <p>Фото: <input type="file" name="photo"></p>
        
        <button type="submit" class="btn-submit">Зареєструватися</button>
    </form>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 10');