<?php
/**
 * Завдання 10: Результат реєстрації
 *
 * Варіант 20: відображає дані збережені в сесії
 */
session_start();
require_once __DIR__ . '/layout.php';

$data = $_SESSION['reg_data'] ?? null;
$lang = $_COOKIE['lang'] ?? 'uk';

ob_start();
?>
<div class="demo-card">
    <h2>Вітаємо, <?= htmlspecialchars($data['login'] ?? 'Гість') ?>!</h2>
    <p>Мова інтерфейсу (з куків): <strong><?= $lang ?></strong></p>

    <?php if ($data): ?>
        <ul>
            <li>Стать: <?= $data['gender'] === 'male' ? 'Чоловік' : 'Жінка' ?></li>
            <li>Місто: <?= htmlspecialchars($data['city']) ?></li>
            <li>Хобі: <?= implode(', ', $data['hobbies']) ?></li>
            <li>Про себе: <?= nl2br(htmlspecialchars($data['about'])) ?></li>
        </ul>
        <?php if ($data['photo']): ?>
            <p>Ваше фото:</p>
            <img src="<?= $data['photo'] ?>" style="max-width: 200px; border-radius: 10px;">
        <?php endif; ?>
    <?php else: ?>
        <p>Дані не знайдені. <a href="task10_form.php">Заповніть форму</a>.</p>
    <?php endif; ?>
    
    <p><a href="task10_form.php">Повернутися та змінити дані</a></p>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 10 - Результат');