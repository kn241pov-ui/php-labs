<?php
/**
 * Завдання 9: Асоціативний масив
 *
 * Варіант 20: студенти => оцінки (1-12)
 * Сортування: ksort (за ім'ям), asort (за оцінками)
 */
require_once __DIR__ . '/layout.php';

/**
 * Сортує масив за ключами (прізвищами студентів) — алфавітний порядок
 */
function sortByStudentName(array $students): array
{
    ksort($students);
    return $students;
}

/**
 * Сортує масив за значеннями (оцінками) — від найнижчої до найвищої
 */
function sortByGrade(array $students): array
{
    asort($students);
    return $students;
}

// Вхідні дані згідно з умовою
$students = [
    "Бутенко Григорій" => 5,
    "Ганущак Оксана" => 11,
    "Журавель Тарас" => 8,
    "Козак Вероніка" => 3,
    "Ляшенко Богдан" => 10,
    "Савчук Карина" => 12,
    "Юрченко Дмитро" => 1,
];

// Обробка сортування
$sortBy = $_POST['sort'] ?? 'name';
$sorted = ($sortBy === 'grade') ? sortByGrade($students) : sortByStudentName($students);

ob_start();
?>
<div class="demo-card">
    <h2>Асоціативний масив: Студенти</h2>
    <p class="demo-subtitle">Використання функцій ksort() та asort() для обробки даних</p>

    <div class="flex-buttons" style="display: flex; gap: 10px; margin-bottom: 20px;">
        <form method="post">
            <input type="hidden" name="sort" value="name">
            <button type="submit" class="<?= $sortBy === 'name' ? 'btn-submit' : 'btn-secondary' ?>">За прізвищем (ksort)</button>
        </form>
        <form method="post">
            <input type="hidden" name="sort" value="grade">
            <button type="submit" class="<?= $sortBy === 'grade' ? 'btn-submit' : 'btn-secondary' ?>">За оцінкою (asort)</button>
        </form>
    </div>

    <div class="demo-section">
        <h3>Результат сортування: <span class="demo-tag demo-tag-primary"><?= $sortBy === 'grade' ? 'за оцінкою' : 'за прізвищем' ?></span></h3>
        <table class="demo-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ПІБ студента <?= $sortBy === 'name' ? '&#8595;' : '' ?></th>
                    <th>Бали (1-12) <?= $sortBy === 'grade' ? '&#8593;' : '' ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($sorted as $name => $grade): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= htmlspecialchars($name) ?></td>
                    <td>
                        <span class="demo-tag <?= $grade >= 10 ? 'demo-tag-success' : ($grade <= 3 ? 'demo-tag-danger' : 'demo-tag-primary') ?>">
                            <?= $grade ?> балів
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="demo-code">
// Використаний метод:
<?php if ($sortBy === 'grade'): ?>
asort($students); // Сортування за значенням (оцінкою)
<?php else: ?>
ksort($students); // Сортування за ключем (ім'ям)
<?php endif; ?>
    </div>
</div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 9');