<? include_once('views/common/header.php'); ?>
<div class="wrap-content services-back">
    <div class="container">
        <div class="service-heading">
            <div class="row">
                <div class="col-md-6">
                    <div class="service-heading-first_half">Сколько это стоит?</div>
                </div>
                <div class="col-md-6">
                    <div class="service-heading-second_half">Недорого.</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="accordions">
                <? foreach($service_types as $type): ?>
                <div class="accordions_title">
                    <h3><?= $type['service_type_name']; ?></h3><span></span>
                </div>
                <div class="accordions_content">
                    <table class="table">
                        <? foreach($services as $service): ?>
                        <? if($service['service_service_type_id'] == $type['service_type_id']): ?>
                        <tr>
                            <td><?= $service['service_name']; ?></td>
                            <td><?= $service['service_price']; ?></td>
                            <? if($userIsAuthorized): ?>
                            <td><a class="add-to-cart" id="add-to-cart" onclick="addToCart(<?= $service['service_id']; ?>)">Добавить в корзину</a><i id="added" class="fa fa-check" hidden></i></td>
                            <? endif; ?>
                        </tr>
                        <? endif; ?>
                        <? endforeach; ?>
                    </table>
                </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>
<? include_once('views/common/footer.php'); ?>
