<? include_once('views/common/header.php'); ?>
<div class="wrap-content reg-back">
    <div class="container">
        <div class="row">
            <? if(empty($preorderInfo)): ?>
            <div class="reg-error no-rights">
                <h6>Корзина пуста. <a class="add-to-cart-from-cart" href="<?= FULL_SITE_ROOT . 'services/index'; ?>">Добавьте услуги в корзину.</a></h6>
            </div>
            <? elseif (!$userIsAuthorized): ?>
            <div class="reg-error no-rights">
                <h6>Для просмотра информации необходимо авторизоваться.</h6>
            </div>
            <? else: ?>
            <form action="" method="POST">
                <div class="cart-list">
                    <div class="preorder-user"><?= $userInfo['user_name']; ?>, вашему питомцу окажут следующие услуги:</div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Услуга</th>
                                <th>Цена</th>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach ($preorderInfo as $item): ?>
                            <tr>
                                <td><?= $item['service_name']; ?></td>
                                <td id="service_price"><?= $item['service_price']; ?> руб.</td>
                            </tr>
                            <? endforeach; ?>
                        </tbody>
                    </table>
                    <div class="preorder-user">И забота о нем в этот раз обойдется вам в <?= $orderSum; ?> руб.<br>Но будьте уверены, он останется здоровеньким и довольненьким <i class="fa fa-paw"></i></div>
                    <div class="preorder-user">Каким способом предпочитаете оплатить?</div>
                    <div class="reg-form-group">
                        <? foreach ($paymentTypes as $type): ?>
                        <div class="reg-form__radio-block">
                            <input type="radio" class="reg-form-radio" name="preorder-payment-type" required value="<?= $type['payment_type_id']; ?>">
                            <label class="reg-form-label-radio" for="payment_type"><?= $type['payment_type_name']; ?></label>
                        </div>
                        <? endforeach; ?>
                    </div>
                    <div class="mt-5">
                        <button id="sendOrder" type="submit" class="cart-btn">Отправить заказ</button>
                    </div>
                </div>
            </form>
            <? endif; ?>
        </div>
    </div>
</div>
<? include_once('views/common/footer.php'); ?>
