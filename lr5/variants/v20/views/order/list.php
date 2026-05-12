<h1>Список замовлень</h1>
<div class="form__actions" style="margin-bottom: 20px">
    <a href="index.php?route=order/create" class="btn">Додати замовлення</a>
</div>

<?php if (empty($orders)): ?>
    <p class="text-muted">Замовлень поки немає.</p>
<?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th><a href="index.php?route=order/list&sort=client_name&order=ASC">Клієнт</a></th>
                <th>Вага</th>
                <th><a href="index.php?route=order/list&sort=price&order=DESC">Ціна ↓</a></th>
                <th><a href="index.php?route=order/list&sort=service_type&order=ASC">Послуга</a></th>
                    <th><a href="index.php?route=order/list&sort=status&order=ASC">Статус</a></th>
                <th>Дії</th>    
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $o): ?>
                <tr>
                    <td><?= (int)$o['id'] ?></td>
                    <td><strong><?= htmlspecialchars($o['client_name']) ?></strong></td>
                    <td><?= htmlspecialchars($o['service_type']) ?></td>
                    <td><?= number_format($o['weight_kg'], 1) ?> кг</td>
                    <td><?= number_format($o['price'], 2) ?> грн</td>
                    <td><span class="badge"><?= htmlspecialchars($o['status']) ?></span></td>
                    <td>
                        <a href="index.php?route=order/edit&id=<?= (int)$o['id'] ?>" class="btn btn--small">Ред.</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>