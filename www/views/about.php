<? include_once('views/common/header.php'); ?>
<div class="wrap-content about-page">
    <div class="container">
        <div class="row">
            <div class="about-block">
                <div class="about-text">
                    <? if($userIsAdmin): ?>
                    <form action="" method="POST">
                        <textarea name="editor1" id="editor1" cols="30" rows="10">
                        <? endif; ?>
                        <?= $aboutText; ?>
                        <? if($userIsAdmin): ?>
                            </textarea>
                        <button class="admin-btn" id="about-new-text" type="submit">Заменить текст</button>
                    </form>
                    <? endif; ?>
                </div>
                <div class="about-btn">
                    <a data-toggle="modal" data-target="#arrangeModal" class="btn about-btn-arrange">Записывайся на приём</a>
                </div>
            </div>
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
                                    <button type="submit" class="btn btn-auth">Заказать обратный звонок</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<? include_once('views/common/footer.php'); ?>
