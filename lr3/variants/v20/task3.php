<?php
/**
 * Завдання 3: Конструктор
 *
 * Варіант 20: конструктор задає початкові значення name, diameter, moons
 */
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/Product.php';

// Створюємо 3 об'єкти через конструктор
$product1 = new Product('Земля', 12742.0, 1);
$product2 = new Product('Марс', 6779.0, 2);
$product3 = new Product('Юпітер', 139822.0, 79);

$products = [
    ['obj' => $product1, 'avatar' => 'avatar-indigo', 'initial' => 'Н', 'var' => '$product1'],
    ['obj' => $product2, 'avatar' => 'avatar-green', 'initial' => 'К', 'var' => '$product2'],
    ['obj' => $product3, 'avatar' => 'avatar-amber', 'initial' => 'Р', 'var' => '$product3'],
];

ob_start();
?>

<div class="task-header">
    <h1>Конструктор</h1>
    <p>Початкові значення задаються одразу при створенні об'єкта</p>
</div>

<div class="code-block"><span class="code-comment">// Конструктор класу Product</span>
<span class="code-keyword">public function</span> <span class="code-method">__construct</span>(<span class="code-class">string</span> <span class="code-variable">$name</span>, <span class="code-class">float</span> <span class="code-variable">$diameter</span>, <span class="code-class">int</span> <span class="code-variable">$moons</span>)
{
    <span class="code-variable">$this</span><span class="code-arrow">-></span><span class="code-method">name</span> = <span class="code-variable">$name</span>;
    <span class="code-variable">$this</span><span class="code-arrow">-></span><span class="code-method">diameter</span> = <span class="code-variable">$diameter</span>;
    <span class="code-variable">$this</span><span class="code-arrow">-></span><span class="code-method">moons</span> = <span class="code-variable">$moons</span>;
}

<span class="code-comment">// Створення через конструктор</span>
<span class="code-variable">$product1</span> = <span class="code-keyword">new</span> <span class="code-class">Product</span>(<span class="code-string">'Земля'</span>, <span class="code-string">12742.0</span>, <span class="code-string">1</span>);
<span class="code-variable">$product2</span> = <span class="code-keyword">new</span> <span class="code-class">Product</span>(<span class="code-string">'Марс'</span>, <span class="code-string">6779.0</span>, <span class="code-string">2</span>);
<span class="code-variable">$product3</span> = <span class="code-keyword">new</span> <span class="code-class">Product</span>(<span class="code-string">'Юпітер'</span>, <span class="code-string">139822.0</span>, <span class="code-string">79</span>);</div>

<div class="section-divider">
    <span class="section-divider-text">Об'єкти створені через конструктор</span>
</div>

<div class="users-grid">
    <?php foreach ($products as $data): ?>
    <div class="user-card">
        <div class="user-card-header">
            <div class="user-card-avatar <?= $data['avatar'] ?>"><?= $data['initial'] ?></div>
            <div>
                <div class="user-card-name"><?= htmlspecialchars($data['obj']->name) ?></div>
                <div class="user-card-label"><?= $data['var'] ?> <span class="user-card-badge badge-constructor">constructor</span></div>
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

<div class="section-divider">
    <span class="section-divider-text">getInfo() для кожного</span>
</div>

<div class="info-output">
    <div class="info-output-header">Виклик getInfo() для об'єктів, створених через конструктор</div>
    <div class="info-output-body">
        <?php foreach ($products as $data): ?>
        <div class="info-output-row">
            <span class="info-output-label"><?= $data['var'] ?></span>
            <span class="info-output-text"><?= htmlspecialchars($data['obj']->getInfo()) ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 3', 'task3-body');
