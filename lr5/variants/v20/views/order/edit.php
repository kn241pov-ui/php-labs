<?php
$order = $order ?? [];
$errors = $errors ?? [];
?>

<h1>Редагувати замовлення #<?= (int)($order['id'] ?? 0) ?></h1>

<?php if (!empty($errors)): ?>
    <div style="color: red; background: #fee; padding: 10px; margin-bottom: 20px; border: 1px solid red;">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="index.php?route=order/edit&id=<?= (int)($order['id'] ?? 0) ?>" class="form">
    <input type="hidden" name="id" value="<?= $order['id'] ?>">
    <div class="form__group">
        <label class="form__label">ПІБ Клієнта</label>
        <input type="text" name="client_name" class="form__input" 
               value="<?= htmlspecialchars($order['client_name'] ?? '') ?>">
    </div>

    <div class="form__row">
        <div class="form__group">
            <label class="form__label">Тип послуги</label>
            <input type="text" name="service_type" class="form__input" 
                   value="<?= htmlspecialchars($order['service_type'] ?? '') ?>">
        </div>

        <div class="form__group">
            <label class="form__label">Вага (кг)</label>
            <input type="number" step="0.1" name="weight_kg" class="form__input" 
                   value="<?= htmlspecialchars($order['weight_kg'] ?? '') ?>">
        </div>
    </div>
    <div class="form__group">
            <label class="form__label">Ціна (грн)</label>
            <input type="number" step="0.01" name="price" class="form__input" 
               value="<?= htmlspecialchars($order['price'] ?? '') ?>">
    </div>
    <div class="form__group">
        <label class="form__label">Статус</label>
        <select name="status" class="form__input">
            <?php $s = $order['status'] ?? ''; ?>
            <option value="прийнято" <?= $s == 'прийнято' ? 'selected' : '' ?>>Прийнято</option>
            <option value="в роботі" <?= $s == 'в роботі' ? 'selected' : '' ?>>В роботі</option>
            <option value="готово" <?= $s == 'готово' ? 'selected' : '' ?>>Готово</option>
        </select>
    </div>

    <div class="form__actions">
        <button type="submit" class="btn">Зберегти зміни</button>
        <a href="index.php?route=order/list" class="btn btn--secondary">Скасувати</a>
    </div>
</form>