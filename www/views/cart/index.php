<? include_once('views/common/header.php'); ?>
<div class="wrap-content reg-back">
    <div class="container">
        <div class="row">
            <? if(empty($services)): ?>
            <div class="reg-error no-rights">
                <h6>Корзина пуста. <a class="add-to-cart-from-cart" href="<?= FULL_SITE_ROOT . 'prices'; ?>">Добавьте услуги в <i class="fa fa-shopping-cart"></i></a></h6>
            </div>
            <? elseif (!$userIsAuthorized): ?>
            <div class="reg-error no-rights">
                <h6>Для просмотра информации необходимо авторизоваться.</h6>
            </div>
            <? else: ?>
            <div class="cart-list">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Услуга</th>
                            <th>Цена</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? foreach ($services as $service): ?>
                        <tr>
                            <td><?= $service['service_name']; ?></td>
                            <td id="service_price"><?= $service['service_price']; ?> руб.</td>
                            <td><a class="remove-from-cart" id="remove-from-cart" onclick="removeFromCart(<?= $service['service_id']; ?>)">Удалить</a></td>
                        </tr>
                        <? endforeach; ?>
                    </tbody>
                </table>
                <a class="cart-btn" href="<?= FULL_SITE_ROOT . 'preorder'; ?>" onclick="updateCart()">Заказать</a>
            </div>
            <? endif; ?>
        </div>
    </div>
</div>
<? include_once('views/common/footer.php'); ?>
