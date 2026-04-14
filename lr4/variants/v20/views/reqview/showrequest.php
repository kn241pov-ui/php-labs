<?php
$getParams = $getParams ?? [];
$postParams = $postParams ?? [];
$method = $method ?? 'GET';
?>

<h1>Перегляд параметрів запиту</h1>

<div class="reqview-grid">
    <div class="reqview-section">
        <h2>Перевірка статусу замовлення (POST)</h2>
        <form method="POST" action="index.php?route=reqview/showrequest&source=laundry_form" class="form">
            <div class="form__group">
                <label for="order_id" class="form__label">Номер квитанції</label>
                <input type="text" id="order_id" name="order_id" class="form__input" placeholder="L-10245">
            </div>
            <div class="form__group">
                <label for="client_name" class="form__label">Прізвище клієнта</label>
                <input type="text" id="client_name" name="client_name" class="form__input" placeholder="Іванов">
            </div>
            <button type="submit" class="btn">Перевірити</button>
        </form>

        <h3>GET-параметри (Приклад для пральні)</h3>
        <code class="code-block">index.php?route=reqview/showrequest&service=dry_cleaning&item=coat</code>
    </div>
    </div>