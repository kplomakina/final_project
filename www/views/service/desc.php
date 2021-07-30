<? include_once('views/common/header.php'); ?>
<div class="wrap-content services-back">
    <div class="container">
        <div class="service-heading">
            <div class="row">
                <div class="col-md-6">
                    <div class="service-heading-first_half">Что мы делаем?</div>
                </div>
                <div class="col-md-6">
                    <div class="service-heading-second_half">Практически всё.</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="accordions">
                <? foreach($services as $service): ?>
                <div class="accordions_title">
                    <h3><?= $service['service_type_name']; ?></h3><span></span>
                </div>
                <div class="accordions_content">
                    <p class="p-accord"><?= $service['service_type_desc']; ?></p>
                </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>
<? include_once('views/common/footer.php'); ?>
