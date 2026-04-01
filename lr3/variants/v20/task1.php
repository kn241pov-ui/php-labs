<?php
/**
 * Завдання 1: Створення класів та об'єктів
 *
 * Варіант 20: клас Product, створення 3 об'єктів з довільними значеннями
 */
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/Product.php';

// Створюємо 3 об'єкти з довільними значеннями
$product1 = new Product();
$product1->name = 'Земля';
$product1->diameter = 12742.0;
$product1->moons = 1;

$product2 = new Product();
$product2->name = 'Марс';
$product2->diameter = 6779.0;
$product2->moons = 2;

$product3 = new Product();
$product3->name = 'Юпітер';
$product3->diameter = 139822.0;
$product3->moons = 79;

$products = [
    ['obj' => $product1, 'avatar' => 'avatar-indigo', 'initial' => 'З'],
    ['obj' => $product2, 'avatar' => 'avatar-green', 'initial' => 'М'],
    ['obj' => $product3, 'avatar' => 'avatar-amber', 'initial' => 'Ю'],
];

ob_start();
?>

<div class="task-header">
    <h1>Створення об'єктів</h1>
    <p>Клас <code>Product</code> з властивостями: name, diameter, moons</p>
</div>

<div class="code-block"><span class="code-comment">// Створюємо об'єкт та задаємо властивості</span>
<span class="code-variable">$product1</span> = <span class="code-keyword">new</span> <span class="code-class">Product</span>();
<span class="code-variable">$product1</span><span class="code-arrow">-></span><span class="code-method">name</span> = <span class="code-string">'Земля'</span>;
<span class="code-variable">$product1</span><span class="code-arrow">-></span><span class="code-method">diameter</span> = <span class="code-string">12742.0</span>;
<span class="code-variable">$product1</span><span class="code-arrow">-></span><span class="code-method">moons</span> = <span class="code-string">1</span>;</div>

<div class="section-divider">
    <span class="section-divider-text">3 об'єкти</span>
</div>

<div class="users-grid">
    <?php foreach ($products as $i => $data): ?>
    <div class="user-card">
        <div class="user-card-header">
            <div class="user-card-avatar <?= $data['avatar'] ?>"><?= $data['initial'] ?></div>
            <div>
                <div class="user-card-name"><?= htmlspecialchars($data['obj']->name) ?></div>
                <div class="user-card-label">Об'єкт #<?= $i + 1 ?></div>
            </div>
        </div>
        <div class="user-card-body">
            <div class="user-card-field">
                <span class="user-card-field-label">name</span>
                <span class="user-card-field-value"><?= htmlspecialchars($data['obj']->name) ?></span>
            </div>
            <div class="user-card-field">
                <span class="user-card-field-label">diameter</span>
                <span class="user-card-field-value"><?= $data['obj']->diameter ?> км</span>
            </div>
            <div class="user-card-field">
                <span class="user-card-field-label">moons</span>
                <span class="user-card-field-value"><?= $data['obj']->moons ?></span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 1', 'task1-body');
