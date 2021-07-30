<? include_once('views/common/header.php'); ?>
<div class="wrap-content reg-back">
    <div class="container">
        <form class="reg-form" method="POST">
            <legend class="reg-form-legend">Расскажите о себе<i class="fa fa-user-secret"></i>и своем питомце<i class="fa fa-paw"></i></legend>
            <fieldset class="reg-form-fieldset">
                <span class="reg-form-info">Персональная информация</span>
                <div class="reg-form-group">
                    <label class="reg-form-label">Email</label>
                    <input type="email" class="reg-form-control" name="user_email" placeholder="ivanov@gmail.com" required value="<?= (isset($_POST['user_email'])) ? $_POST['user_email'] : ''; ?>">
                </div>
                <? if(!empty($errors)): ?>
                <? foreach ($errors as $key => $error): ?>
                <? if($key == 'user_email'): ?>
                <div class="reg-error">
                    <?= $errors['user_email']; ?>
                </div>
                <? endif; ?>
                <? endforeach; ?>
                <? endif; ?>
                <div class="reg-form-group">
                    <label class="reg-form-label">Пароль</label>
                    <input type="password" class="reg-form-control" required name="user_password">
                </div>
                <div class="reg-form-group">
                    <label class="reg-form-label">Повторите пароль</label>
                    <input type="password" class="reg-form-control" required name="user_repeat_password">
                </div>
                <? if(!empty($errors)): ?>
                <? foreach ($errors as $key => $error): ?>
                <? if($key == 'user_password'): ?>
                <div class="reg-error">
                    <?= $errors['user_password']; ?>
                </div>
                <? endif; ?>
                <? endforeach; ?>
                <? endif; ?>
            </fieldset>
            <fieldset class="reg-form-fieldset">
                <div class="reg-form-group">
                    <label class="reg-form-label">ФИО</label>
                    <input type="text" class="reg-form-control" name="user_name" placeholder="Иванов Иван Иванович" required value="<?= (isset($_POST['user_name'])) ? $_POST['user_name'] : ''; ?>">
                </div>
                <? if(!empty($errors)): ?>
                <? foreach ($errors as $key => $error): ?>
                <? if($key == 'user_name'): ?>
                <div class="reg-error">
                    <?= $errors['user_name']; ?>
                </div>
                <? endif; ?>
                <? endforeach; ?>
                <? endif; ?>
                <div class="reg-form-group">
                    <label class="reg-form-label">Номер телефона</label>
                    <input type="tel" class="reg-form-control" name="user_phone" placeholder="+79998887766" required value="<?= (isset($_POST['user_phone'])) ? $_POST['user_phone'] : ''; ?>">
                </div>
                <? if(!empty($errors)): ?>
                <? foreach ($errors as $key => $error): ?>
                <? if($key == 'user_phone'): ?>
                <div class="reg-error">
                    <?= $errors['user_phone']; ?>
                </div>
                <? endif; ?>
                <? endforeach; ?>
                <? endif; ?>
                <div class="reg-form-group">
                    <label class="reg-form-label">Дата рождения</label>
                    <input class="reg-form-dob" type="date" name="user_dob" required id="dateofbirth">
                </div>
            </fieldset>
            <fieldset class="reg-form-fieldset">
                <span class="reg-form-info">Информация о питомце</span>
                <div class="reg-form-group">
                    <? foreach($petTypes as $petType): ?>
                    <div class="reg-form__radio-block">
                        <input type="radio" class="reg-form-radio" name="pet_type" id="pet_type<?= $petType['pet_type_id']; ?>" required value="<?= $petType['pet_type_id']; ?>">
                        <label class="reg-form-label-radio" for="pet_type"><?= $petType['pet_type_name']; ?></label>
                    </div>
                    <? endforeach; ?>
                </div>
            </fieldset>
            <fieldset class="reg-form-fieldset">
                <label class="reg-form-label-checkbox">
                    <input type="checkbox" name="rg_agree" required checked class="reg-form-checkbox"> <span>Устанавливая галочку, вы соглашаетесь с условиями обработки персональных данных</span>
                </label>
            </fieldset>
            <div class="g-recaptcha" data-sitekey="6LdqikIaAAAAAOcinsb5OV-gO_LUc0ZLJFaD70Hc"></div>
            <button type="submit" class="reg-form-btn">Зарегистрироваться</button>
        </form>
    </div>
</div>
<? include_once('views/common/footer.php'); ?>
