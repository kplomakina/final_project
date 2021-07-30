<? include_once('views/common/header.php'); ?>
<div class="wrap-content reg-back">
    <div class="container">
        <div class="row">
            <? if(!empty($errors)): ?>
            <? foreach($errors as $error): ?>
            <div class="reg-error no-rights">
                <h6><?= $error; ?></h6>
            </div>
            <? endforeach; ?>
            <? else: ?>
            <div class="accordions">
                <div class="accordions_title user-accordions_title">
                    <h3>Персональная информация</h3><span></span>
                </div>
                <div class="accordions_content user-accordions_content">
                    <div class="user-intro">Персональная информация</div>
                    <table class="table">
                        <tr>
                            <td>ФИО</td>
                            <td><?= $userInfo['user_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Телефон</td>
                            <td><?= $userInfo['user_phone']; ?></td>
                        </tr>
                        <tr>
                            <td>Дата Рождения</td>
                            <td><?= $userInfo['user_dob']; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?= $userInfo['user_email']; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="accordions_title user-accordions_title">
                    <h3>Заказы</h3><span></span>
                </div>
                <div class="accordions_content user-accordions_content">
                    <div class="user-intro">Вашему питомцу (<?= $userInfo['pet_type_name']; ?>) были оказаны следующие услуги:</div>
                    <table class="table">
                        <? foreach($userOrders as $order): ?>
                        <th>Заказ №<?= $order['order_id']; ?></th>
                        <tr>
                            <td>Дата заказа</td>
                            <td><?= $order['order_date']; ?></td>
                        </tr>
                        <tr>
                            <td>Услуги</td>
                            <td><?= $order['service_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Стоимость заказа</td>
                            <td><?= $order['service_price_sum']; ?> руб.</td>
                        </tr>
                        <? endforeach; ?>
                    </table>
                </div>
                <a href="<?= FULL_SITE_ROOT . 'prices'; ?>" class="accordions_title user-accordions_title add-to-cart-from-page">
                    <h3>Сделать заказ</h3><i class="fa fa-shopping-cart"></i>
                </a>
            </div>
            <? endif; ?>
        </div>
    </div>
</div>
<? include_once('views/common/footer.php'); ?>
