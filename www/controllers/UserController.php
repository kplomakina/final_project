<?php
    class UserController {
        
        public $userModel;
        public $menu;
        public $check;
     
        public function __construct() {
            $this->userModel = new User();
            $this->menu = new Menu();
            $this->check = new Check();
        }

        /**
         * Функция регистрации новых пользователей
         */
        public function actionRegister() {
            $title = 'Регистрация';
            $menuItems = $this->menu->getMenu();
            $menuItems = Helper::build_menu($menuItems);
            $petTypes = $this->userModel->getPetTypes();
            $errors = [];
            if(isset($_POST['user_email'])) {
                $userEmail = Helper::escape($_POST['user_email']);
                $userPassword = Helper::escape($_POST['user_password']);
                $userRepeatPassword = Helper::escape($_POST['user_repeat_password']);
                $userName = Helper::escape($_POST['user_name']);
                $userPhone = Helper::escape($_POST['user_phone']);
                $userDOB = Helper::escape($_POST['user_dob']);
                $userPetType = Helper::escape($_POST['pet_type']);
                if($userPassword !== $userRepeatPassword) {
                    $errors['user_password'] = 'Пароли не совпадают';
                }
                if($this->userModel->checkIfEmailExists($userEmail)) {
                    $errors['user_email'] = 'Такой email уже существует';
                }
                if($this->userModel->checkIfPhoneExists($userPhone)) {
                    $errors['user_phone'] = 'Такой номер телефона уже существует';
                }
                if (!preg_match('~^[0-9a-z]([0-9a-z_\-])*@((?1)|[0-9а-я])*\.((?1)|[0-9а-я]){2,10}$~iu', $userEmail)) {
                    $errors['user_email'] = 'Email некорректный';
                }
                if(!preg_match('~^([0-9A-zА-я\s])+$~iu', $userName)) {
                    $errors['user_name'] = 'Некорректные ФИО';
                }
                if(!preg_match('~\+[0-9]([0-9]{10})$~iu', $userPhone)) {
                    $errors['user_phone'] = 'Телефон введен некорректно';
                }
                $userPassword = md5($userPassword);
                
                if(empty($errors)) {
                    echo $userEmail, $userPassword, $userName, $userPhone, $userDOB, $userPetType;
                    $userId = $this->userModel->register($userEmail, $userPassword, $userName, $userPhone, $userDOB, $userPetType);
                    setcookie('user', $userId, time() + 2 * 24 * 60 * 60);
                    $token = Helper::generateToken();
                    $tokenTime = time() + 15 * 60;
                    setcookie('token', $token, time() + 2 * 24 * 60 * 60);
                    setcookie('tokenTime', $tokenTime, time() + 2 * 24 * 60 * 60);
                    $this->userModel->insertToken($userId, $token, $tokenTime);
                    header('Location: ' . FULL_SITE_ROOT . "view/$userId");
                }
            }
            include_once('views/user/reg.php');
            return;
        }

        /**
         * Функция авторизации пользователя
         */
        public function actionAuth() {
            $title = 'Авторизация';
            $menuItems = $this->menu->getMenu();
            $menuItems = Helper::build_menu($menuItems);
            $errors = [];
            if(isset($_POST['user_email'])) {
                $userEmail = Helper::escape($_POST['user_email']);
                $userPassword = Helper::escape($_POST['user_password']);
                $userPassword = md5($userPassword);
                $userInfo = $this->userModel->checkIfUserExists($userEmail, $userPassword);
                if (!preg_match('~^[0-9a-z]([0-9a-z_\-])*@((?1)|[0-9а-я])*\.((?1)|[0-9а-я]){2,10}$~iu', $userEmail)) {
                    $errors['user_email'] = 'Email некорректный';
                }
                if(intval($userInfo['count']) !== 1) {
                    $errors[] = 'Такой связки email/пароль нет';
                }
                if(empty($errors)) {
                    $userId = $userInfo['user_id'];
                    $userIsAdmin = ($userInfo['user_is_admin'] == USER_ADMIN);
                    setcookie('user', $userId, time() + 2 * 24 * 60 * 60);
                    $token = Helper::generateToken();
                    $tokenTime = time() + 15 * 60;
                    setcookie('token', $token, time() + 2 * 24 * 60 * 60);
                    setcookie('tokenTime', $tokenTime, time() + 2 * 24 * 60 * 60);
                    $this->userModel->insertToken($userId, $token, $tokenTime);
                    if (!$userIsAdmin) {
                        header("Location: " . FULL_SITE_ROOT . "view/$userId");
                        } else {
                        header("Location: " . FULL_SITE_ROOT . "admin");
                    }
                }
            }
            include_once('views/user/auth.php');
            return;
        }

        /**
         * Функция просмотра страницы пользователя по $id
         * @param integer $id
         */
        public function actionView($id) {
            $title = 'Страница пользователя';
            $menuItems = $this->menu->getMenu();
            $menuItems = Helper::build_menu($menuItems);
            $errors = [];
            $userIsAuthorized = $this->check->checkIfAuthorized();
            $userIsAdmin = $this->check->checkIfAdmin();
            if(!$userIsAuthorized) {
                $errors[] = 'Для просмотра информации необходимо авторизоваться';
            } else if ($_COOKIE['user'] !== $id) {
                $errors[] = 'Для просмотра информации необходимо авторизоваться';
            } else {
                if(!$userIsAdmin) {
                    $userInfo = $this->userModel->getUserById($id);
                    $userOrders = $this->userModel->getUserOrders($id);
                } else {
                    header("Location: " . FULL_SITE_ROOT . "admin");
                }
            }
            include_once('views/user/page.php');
            return;
        }
    }
