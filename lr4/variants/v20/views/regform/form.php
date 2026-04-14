<?php
$errors = $errors ?? [];
$old = $old ?? [];
?>

<h1>Реєстрація клієнта пральні</h1>
<p>Створіть акаунт для онлайн-замовлень та відстеження статусу прання.</p>

<?php if (!empty($errors)): ?>
    <div class="alert alert--error">
        <strong>Помилки при заповненні форми:</strong>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="index.php?route=regform/form" class="form">
    <div class="form__group">
        <label for="login" class="form__label">Логін</label>
        <input type="text" id="login" name="login" class="form__input" value="<?= htmlspecialchars($old['login'] ?? '') ?>">
    </div>

    <div class="form__row">
        <div class="form__group">
            <label for="password" class="form__label">Пароль 1</label>
            <input type="password" id="password" name="password" class="form__input">
        </div>
        <div class="form__group">
            <label for="password_confirm" class="form__label">Пароль 2 (підтвердження)</label>
            <input type="password" id="password_confirm" name="password_confirm" class="form__input">
        </div>
    </div>

    <div class="form__group">
        <label for="email" class="form__label">E-mail</label>
        <input type="text" id="email" name="email" class="form__input" 
               value="<?= htmlspecialchars($old['email'] ?? '') ?>" placeholder="example@mail.com">
    </div>

    <div class="form__actions">
        <button type="submit" class="btn">Зареєструватися</button>
        <button type="reset" class="btn btn--secondary">Очистити</button>
    </div>
</form>