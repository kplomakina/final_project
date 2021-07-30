<?php

    class MainController {
        
        public $menu;
        public $check;
        
        public function __construct() {
            $this->menu = new Menu();
            $this->check = new Check();
        }
        
        public function actionIndex() {
            $title = 'Главная';
            $menuItems = $this->menu->getMenu();
            $menuItems = Helper::build_menu($menuItems);
            include_once('views/main.php');
        }
        public function actionContacts() {
            $title = 'Контакты';
            $menuItems = $this->menu->getMenu();
            $menuItems = Helper::build_menu($menuItems);
            include_once('views/contacts.php');
        }
        public function actionAbout() {
            $title = 'О нас';
            $menuItems = $this->menu->getMenu();
            $menuItems = Helper::build_menu($menuItems);
            $aboutText = $this->menu->getText('about');
            $aboutText = html_entity_decode($aboutText['static_page_text']);
            $userIsAdmin = $this->check->checkIfAdmin();
            if(isset($_POST['editor1'])) {
                $aboutNewText = Helper::escape($_POST['editor1']);
                $this->menu->updateText('about', $aboutNewText);
                $aboutText = $this->menu->getText('about');
                $aboutText = html_entity_decode($aboutText['static_page_text']);
            }
            include_once('views/about.php');
        }
    }