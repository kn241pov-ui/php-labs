<?php
/**
 * Завдання 6: Пошук унікальних елементів
 *
 * Варіант 20: Очікуваний результат: [5, 14, 2, 8]
 * Масив: [3, 10, 7, 12, 10, 3, 5, 7, 14, 12, 2, 8] 
 */
require_once __DIR__ . '/layout.php';

/**
 * Знаходить елементи, які зустрічаються в масиві лише один раз
 *
 * @param array $arr
 * @return array
 */
function findUniqueElements(array $arr): array
{
    if (empty($arr)) {
        return [];
    }

    // Рахуємо кількість кожного елемента
    $counts = array_count_values($arr);

    // Фільтруємо: залишаємо тільки ті, що зустрічаються 1 раз
    $uniques = array_filter($counts, fn($count) => $count === 1);

    // Повертаємо тільки ключі (самі числа)
    return array_keys($uniques);
}

// Обробка форми
$input = $_POST['array'] ?? '3, 10, 7, 12, 10, 3, 5, 7, 14, 12, 2, 8';
$submitted = isset($_POST['array']);

// Перетворюємо рядок у масив чисел
$arr = array_map('trim', explode(',', $input));
$arr = array_filter($arr, fn($v) => $v !== '');

// Викликаємо нову функцію
$uniqueElements = findUniqueElements($arr);

ob_start();
?>
<div class="demo-card">
    <h2>Пошук унікальних елементів</h2>
    <p class="demo-subtitle">Виводить елементи, які зустрічаються в масиві лише один раз</p>

    <form method="post" class="demo-form">
        <div>
            <label for="array">Масив (через кому)</label>
            <input type="text" id="array" name="array" value="<?= htmlspecialchars($input) ?>">
        </div>
        <button type="submit" class="btn-submit">Знайти унікальні</button>
    </form>

    <?php if (!empty($arr)): ?>
    <div class="demo-section">
        <h3>Результат:</h3>
        <div class="array-display">
            <?php foreach ($uniqueElements as $item): ?>
                <span class="array-item array-item-unique"><?= htmlspecialchars($item) ?></span>
            <?php endforeach; ?>
        </div>
        <?php if (empty($uniqueElements)): ?>
            <p>Унікальних елементів не знайдено.</p>
        <?php endif; ?>
    </div>

    <div class="demo-code">
        // Очікуваний результат для [3, 10, 7, 12, 10, 3, 5, 7, 14, 12, 2, 8]:
        // [5, 14, 2, 8]
    </div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 6');