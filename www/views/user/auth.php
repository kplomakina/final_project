<? include_once('views/common/header.php'); ?>
<div class="wrap-content reg-back">
    <div class="container">
        <form class="reg-form" method="POST">
            <legend class="reg-form-legend"><i class="fa fa-paw"></i><span>Мой кабинет</span></legend>
            <? if(!empty($errors)): ?>
            <? foreach($errors as $error): ?>
            <div class="errors reg-error">
                <?= $error; ?>
            </div>
            <? endforeach; ?>
            <? endif; ?>
            <fieldset class="reg-form-fieldset">
                <div class="reg-form-group">
                    <label class="reg-form-label">Email</label>
                    <input type="email" class="reg-form-control" name="user_email" placeholder="ivanov@gmail.com" required value="<?= (isset($_POST['user_email'])) ? $_POST['user_email'] : ''; ?>">
                </div>
                <div class="reg-form-group">
                    <label class="reg-form-label">Пароль</label>
                    <input type="password" class="reg-form-control" required name="user_password">
                </div>
            </fieldset>
            <button type="submit" class="reg-form-btn">Войти</button>
            <span>или</span>
            <a href="<?= FULL_SITE_ROOT . 'reg'; ?>" class="btn-reg">Зарегистрироваться</a>
        </form>
    </div>
</div>
<? include_once('views/common/footer.php'); ?>
