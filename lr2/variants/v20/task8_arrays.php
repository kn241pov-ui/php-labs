<?php
/**
 * Завдання 8: Операції з масивами
 *
 * Варіант 20: array_intersect + sort ascending
 * createArray(): довжина 3-6, значення 1-50
 */
require_once __DIR__ . '/layout.php';

/**
 * Створює масив випадкової довжини (3-6) з випадковими значеннями (1-50)
 */
function createArray(): array
{
    $length = random_int(4, 8);
    $arr = [];
    for ($i = 0; $i < $length; $i++) {
        $arr[] = random_int(1, 50);
    }
    return $arr;
}

/**
 * Знаходить спільні елементи двох масивів і сортує за спаданням
 */
function mergeSorted(array $a, array $b): array
{
    $merged = array_merge($a, $b);
    $unique = array_unique($merged);
    rsort($unique);
    return $unique;
}

// Генеруємо масиви (варіант 20)
$arr1 = createArray();
$arr2 = createArray();

$result = mergeSorted($arr1, $arr2);

ob_start();
?>
<div class="demo-card demo-card-wide">
    <h2>Операції з масивами: Об'єднання</h2>
    <p class="demo-subtitle">Обʼєднати → видалити дублікати → сортувати за спаданням</p>

    <form method="post" class="demo-form">
        <button type="submit" name="regenerate" class="btn-submit">Згенерувати нові масиви</button>
    </form>

    <div class="demo-section">
        <h3>Масив 1</h3>
        <div class="array-display">
            <?php foreach ($arr1 as $v): ?>
                <span class="array-item"><?= $v ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="demo-section">
        <h3>Масив 2</h3>
        <div class="array-display">
            <?php foreach ($arr2 as $v): ?>
                <span class="array-item"><?= $v ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="array-arrow">&#8595; Об'єднання та очищення</div>

    <div>
        <h3 class="demo-section-title-success">Результат (унікальні, за спаданням)</h3>
        <div class="array-display">
            <?php foreach ($result as $v): ?>
                <span class="array-item array-item-unique"><?= $v ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="demo-code">
$a = [<?= implode(', ', $arr1) ?>];
$b = [<?= implode(', ', $arr2) ?>];
$result = array_unique(array_merge($a, $b));
rsort($result);
// Результат: [<?= implode(', ', $result) ?>]
    </div>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 8');