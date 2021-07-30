<?php
   
    class DoctorController {
        
        private $doctorModel;
        private $serviceModel;
        public $menu;
        
        public function __construct() {
            $this->doctorModel = new Doctor();
            $this->serviceModel = new Service();
            $this->menu = new Menu();
        }
        
        public function actionIndex() {
            $title='Наша команда';
            $doctors = $this->doctorModel->GetAll();
            $doctorsServices = $this->doctorModel->GetDoctorsServices();
            $services = $this->serviceModel->GetAll();
            $menuItems = $this->menu->getMenu();
            $menuItems = Helper::build_menu($menuItems);
            include_once('views/doctor/list.php');
            return;
        }
    }