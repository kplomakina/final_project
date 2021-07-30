<? include_once('views/common/header.php'); ?>
<div class="wrap-content main-page">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="first-half">
                    <div class="first-half__title">Vet Your Pet</div>
                    <div class="first-half__desc">Ветеринарная клиника,<br>в&nbsp;которой позаботятся</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="second-half">
                    <div class="second-half__price">700 руб.</div>
                    <div class="second-half__desc">Первичный<br>осмотр</div>
                    <a data-toggle="modal" data-target="#arrangeModal" class="btn btn-arrange-main">Записаться</a>
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
            </div>
            <div class="cookie-notification js-cookie-notification">
                Мы&nbsp;используем файлы cookie, чтобы обеспечить вам наилучшую работу на&nbsp;нашем веб-сайте. Продолжая использовать этот сайт, вы&nbsp;даете согласие на&nbsp;использование файлов cookie. Вы&nbsp;можете найти больше информации об&nbsp;этом в&nbsp;<a class="a-cookie-notification">нашей политике конфиденциальности.</a><a class="close-cookie" href="#" id="close">ОК</a>
            </div>
        </div>
    </div>
</div>
<? include_once('views/common/footer.php'); ?>
