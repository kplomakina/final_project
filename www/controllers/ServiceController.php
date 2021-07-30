<?php
   
    class ServiceController {
        
        public $serviceModel;
        public $userModel;
        public $menu;
        public $check;
                
        public function __construct() {
            $this->serviceModel = new Service();
            $this->userModel = new User();
            $this->menu = new Menu();
            $this->check = new Check();
        }
        
        public function actionDesc() {
            $title='Что мы делаем';
            $menuItems = $this->menu->getMenu();
            $menuItems = Helper::build_menu($menuItems);
            $services = $this->serviceModel->GetTypesDesc();
            include_once('views/service/desc.php');
            return;
        }
        
        public function actionIndex() {
            $title='Цены';
            $menuItems = $this->menu->getMenu();
            $menuItems = Helper::build_menu($menuItems);
            $userIsAuthorized = $this->check->checkIfAuthorized();
            $service_types = $this->serviceModel->GetTypesDesc();
            $services = $this->serviceModel->GetAll();
            include_once('views/service/list.php');
            return;
        }
    }