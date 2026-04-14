<?php
$regData = $regData ?? [];
?>

<div class="success-page">
    <div class="alert alert--success">
        <h2>Реєстрація успішна!</h2>
        <p>Ласкаво просимо до пральної, <strong><?= htmlspecialchars($regData['login'] ?? '') ?></strong>!</p>
        <p>Тепер ви можете слідкувати за станом ваших пральних речей.</p>
    </div>

    <div class="success-page__actions">
        <a href="index.php" class="btn">На головну</a>
        <a href="index.php?route=regform/form" class="btn btn--secondary">Ще одна реєстрація</a>
    </div>
</div>
