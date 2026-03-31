<?php
/**
 * Завдання 2: Сортування міст за довжиною назви
 *
 * Варіант 20: за довжиною назви (від короткої до довгої), при однаковій довжині — за алфавітом
 */
require_once __DIR__ . '/layout.php';

/**
 * Сортує міста за довжиною назви

 */
function sortCitiesLargeName(string $input): array
{
    $cities = array_filter(array_map('trim', explode(' ', $input)));
    usort($cities, function ($a, $b) {
        $lenA = strlen($a);
        $lenB = strlen($b);
        if ($lenA === $lenB) {
            return strcmp($a, $b);
        }
        return $lenB - $lenA;
    });
    return $cities;
}

// Вхідні дані (варіант 20)
$input = $_POST['cities'] ?? '';
$submitted = isset($_POST['cities']);
$defaultCities = 'Надвірна Турка Збараж Козятин Синельникове Марганець Лисичанськ Борислав';

if (!$submitted) {
    $input = $defaultCities;
}

$sorted = sortCitiesLargeName($input);

ob_start();
?>
<div class="demo-card">
    <h2>Сортування міст за довжиною назви</h2>
    <p class="demo-subtitle">Введіть назви міст через пробіл — сортування від довгої до короткої</p>

    <form method="post" class="demo-form">
        <div>
            <label for="cities">Міста (через пробіл)</label>
            <input type="text" id="cities" name="cities" value="<?= htmlspecialchars($input) ?>" placeholder="Краматорськ Ладижин Бердянськ">
        </div>
        <button type="submit" class="btn-submit">Сортувати</button>
    </form>

    <?php if (!empty($sorted)): ?>
    <div class="demo-section">
        <h3>Вхідні дані</h3>
        <div class="array-display">
            <?php foreach (array_filter(array_map('trim', explode(' ', $input))) as $city): ?>
            <span class="array-item"><?= htmlspecialchars($city) ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="array-arrow">&#8595;</div>

    <div>
        <h3 class="demo-section-title-success">Відсортовані за довжиною назви</h3>
        <div class="array-display">
            <?php foreach ($sorted as $city): ?>
            <span class="array-item array-item-unique"><?= htmlspecialchars($city) ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="demo-code">sortCitiesLargeName("<?= htmlspecialchars($input) ?>")
// usort() — сортування за довжиною назви
// Результат: [<?= htmlspecialchars(implode(', ', array_map(fn($c) => "\"$c\"", $sorted))) ?>]</div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 2');
