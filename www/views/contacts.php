<? include_once('views/common/header.php'); ?>
<div class="wrap-content main-page">
    <div class="container">
        <div class="row">
            <div class="col-md-6 half-contacts">
                <address>
                    <a class="contacts-item" href="mailto:vetyourpet@gmail.com"><i class="fa fa-fw fa-envelope"></i> vetyourpet@gmail.com</a>
                    <a class="contacts-item" href="tel:+78125554433"><i class="fa fa-fw fa-phone"></i> (812)&nbsp;555-44-33</a>
                    <a class="contacts-item" href="https://goo.gl/maps/enrmhAujK4CMNHmD9"><i class="fa fa-fw fa-map-marker"></i>Невский&nbsp;пр., дом 1</a>
                </address>
                <a data-toggle="modal" data-target="#arrangeModal" class="btn btn-arrange-contacts">Вызвать доктора домой</a>
                <div class="modal fade" id="arrangeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal_heading">
                                    <i class="fa fa-phone"></i><span>Мы вам позвоним</span>
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <? if(!empty($errors)): ?>
                                <? foreach($errors as $error): ?>
                                <div class="errors" style="color: red">
                                    <p><?= $error; ?></p>
                                </div>
                                <? endforeach; ?>
                                <? endif; ?>
                                <form method="POST">
                                    <div class="form-group">
                                        <label>Номер телефона</label>
                                        <input type="tel" class="form-control" name="user_tel" placeholder="+79998887766">
                                    </div>
                                    <div class="form-group">
                                        <label>Имя</label>
                                        <input type="text" class="form-control" name="user_name" placeholder="Иван">
                                    </div>
                                    <div class="btns_block">
                                        <button type="submit" class="btn reg-form-btn">Заказать обратный звонок</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 half-contacts">
                <iframe class="location" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1998.7155132858315!2d30.310029316100614!3d59.936862669203954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4696311af3115d53%3A0x95467c366bfc8035!2z0J3QtdCy0YHQutC40Lkg0L_RgC4sIDEsINCh0LDQvdC60YIt0J_QtdGC0LXRgNCx0YPRgNCzLCDQoNC-0YHRgdC40Y8sIDE5MTE4Ng!5e0!3m2!1sru!2sus!4v1605735904163!5m2!1sru!2sus" width="500" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
</div>
<? include_once('views/common/footer.php'); ?>
