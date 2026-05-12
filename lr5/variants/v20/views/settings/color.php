<h1>Налаштування інтерфейсу</h1>

<?php if ($message): ?>
    <div class="alert alert--success"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert alert--error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" action="index.php?route=settings/color" class="form">
    <div class="form__group">
        <label class="form__label">Оберіть колір фону сторінки:</label>
        
        <div class="color-picker">
            <?php foreach ($colors as $hex => $label): ?>
                <label class="color-picker__item <?= $currentColor === $hex ? 'color-picker__item--active' : '' ?>">
                    <input type="radio" name="bg_color" value="<?= $hex ?>" 
                           <?= $currentColor === $hex ? 'checked' : '' ?>>
                    
                    <div class="color-picker__swatch" style="background-color: <?= $hex ?>;"></div>
                    
                    <span class="color-picker__label">
                        <?= htmlspecialchars($label) ?><br>
                        <small><?= strtoupper($hex) ?></small>
                    </span>
                </label>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="form__actions">
        <button type="submit" class="btn">Зберегти налаштування</button>
        <a href="index.php" class="btn btn--secondary">Скасувати</a>
    </div>
</form>

<script>
    document.querySelectorAll('.color-picker__item').forEach(item => {
        item.addEventListener('click', function() {
            // 1. Отримуємо HEX-код з радіокнопки всередині цієї картки
            const radio = this.querySelector('input[type="radio"]');
            const selectedColor = radio.value;

            // 2. Змінюємо фон всієї сторінки миттєво
            document.body.style.backgroundColor = selectedColor;

            // 3. Оновлюємо візуальне виділення карток (синю рамку)
            document.querySelectorAll('.color-picker__item').forEach(i => {
                i.classList.remove('color-picker__item--active');
            });
            this.classList.add('color-picker__item--active');
            
            // 4. Позначаємо радіокнопку як вибрану (щоб форма відправилася правильно)
            radio.checked = true;
        });
    });
</script>