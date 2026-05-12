<?php
$errors = $errors ?? [];
$old = $old ?? [];
?>

<h1>Нове замовлення</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert--error">
        <strong>Помилки:</strong>
        <ul>
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="index.php?route=order/create" class="form">
    <div class="form__group">
        <label class="form__label">Клієнт</label>
        <input type="text" name="client_name" class="form__input" required>
    </div>
    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Послуга</label>
            <select name="service_type" class="form__input">
                <option value="Прання">Прання</option>
                <option value="Хімчистка">Хімчистка</option>
            </select>
        </div>
        <div class="form__group">
            <label class="form__label">Вага (кг)</label>
            <input type="number" step="0.1" name="weight_kg" class="form__input" value="1.0">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Ціна (грн)</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" required>
        </div>
    </div>
    <button type="submit" class="btn">Створити</button>
</form>