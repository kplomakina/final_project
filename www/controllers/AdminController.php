<?php
    class AdminController {
        
        public $serviceModel;
        public $doctorModel;
        public $userModel;
        public $menu;
        public $check;
        
        public function __construct() {
            $this->serviceModel = new Service();
            $this->doctorModel = new Doctor();
            $this->userModel = new User();
            $this->menu = new Menu();
            $this->check = new Check();
        }
        
        public function actionIndex() {
            $title='Админ';
            $menuItems = $this->menu->getMenu();
            $menuItems = Helper::build_menu($menuItems);
            
            $userIsAdmin = $this->check->checkIfAdmin();
            
            $serviceGroups = $this->serviceModel->GetTypesDesc();
            $services = $this->serviceModel->GetAllForAdmin();
            $doctors = $this->doctorModel->GetAllForAdmin();
            $qualificationTypes = $this->doctorModel->GetQualificationTypes();
            $doctorsServices = $this->doctorModel->GetDoctorsServices();
            
            $answers = [];
            
            if(isset($_POST['service_type_id1']) && isset($_POST['service_type_name1']) && isset($_POST['service_type_desc1'])) {
                $servicesInfo = array_chunk($_POST, 3);
                foreach($servicesInfo as $serviceInfo) {
                    $serviceTypeId = Helper::escape($serviceInfo[0]);
                    $serviceTypeName = Helper::escape($serviceInfo[1]);
                    $serviceTypeDesc = Helper::escape($serviceInfo[2]);
                    $this->serviceModel->updateServiceTypeInfo($serviceTypeId, $serviceTypeName, $serviceTypeDesc);
                    $serviceGroups = $this->serviceModel->GetTypesDesc();
                }
                $answers[] = 'Изменения успешно сохранены';
            }
            
            if(isset($_POST['add-service_type_name']) && isset($_POST['add-service_type_desc'])) {
                $serviceTypeName = Helper::escape($_POST['add-service_type_name']);
                $serviceTypeDesc = Helper::escape($_POST['add-service_type_desc']);
                $this->serviceModel->addServiceType($serviceTypeName, $serviceTypeDesc);
                $serviceGroups = $this->serviceModel->GetTypesDesc();
                $answers[] = 'Изменения успешно сохранены';
            }
            
            if(isset($_POST['delete-service-type'])) {
                $serviceTypeId = Helper::escape($_POST['delete-service-type']);
                if($this->serviceModel->checkIfServiceTypeEmpty($serviceTypeId)) {
                    $answers[] = 'В этой группе есть услуги. Удаление невозможно.';
                }
                if(empty($answers)) {
                    $this->serviceModel->deleteServiceType($serviceTypeId);
                    $answers[] = 'Группа услуг удалена';
                    $serviceGroups = $this->serviceModel->GetTypesDesc();
                }
            }
            
            if(isset($_POST['service_id1']) && isset($_POST['service-service-type1']) && isset($_POST['service_name1']) && isset($_POST['service_price1']) && isset($_POST['service-is-deleted1'])) {
                $servicesInfo = array_chunk($_POST, 5);
                foreach($servicesInfo as $serviceInfo) {
                    $serviceId = Helper::escape($serviceInfo[0]);
                    $serviceTypeId = Helper::escape($serviceInfo[1]);
                    $serviceName = Helper::escape($serviceInfo[2]);
                    $servicePrice = Helper::escape($serviceInfo[3]);
                    $serviceIsDeleted = Helper::escape($serviceInfo[4]);
                    $this->serviceModel->updateServiceInfo($serviceId, $serviceTypeId, $serviceName, $servicePrice, $serviceIsDeleted);
                    $services = $this->serviceModel->GetAllForAdmin();
                }
                $answers[] = 'Изменения успешно сохранены';
            }
            
            if(isset($_POST['add-service']) && isset($_POST['add-service_name']) && isset($_POST['add-service_price'])) {
                $serviceTypeId = Helper::escape($_POST['add-service']);
                $serviceName = Helper::escape($_POST['add-service_name']);
                $servicePrice = Helper::escape($_POST['add-service_price']);
                $this->serviceModel->addService($serviceTypeId, $serviceName, $servicePrice);
                $services = $this->serviceModel->GetAllForAdmin();
                $answers[] = 'Изменения успешно сохранены';
            }
            
            if(isset($_POST['doctor-id1']) && isset($_POST['doctor-name1']) && isset($_POST['doctor-qualification-type1']) && isset($_POST['doctor-experience1']) && isset($_POST['doctor-pic1']) && isset($_POST['doctor-is-deleted1']) && isset($_POST['doctor-services1'])) {
                $oldDoctorsServices = $this->doctorModel->getOldDoctorsServices();
                $doctorsInfo = array_chunk($_POST, 7);
                foreach($doctorsInfo as $doctorInfo) {
                    $doctorId = Helper::escape($doctorInfo[0]);
                    $doctorName = Helper::escape($doctorInfo[1]);
                    $doctorQualificationTypeId = Helper::escape($doctorInfo[2]);
                    $doctorExperience = Helper::escape($doctorInfo[3]);
                    $doctorPicName = Helper::escape($doctorInfo[4]);
                    $doctorIsDeleted = Helper::escape($doctorInfo[5]);
                    $this->doctorModel->updateDoctorInfo($doctorId, $doctorName, $doctorQualificationTypeId, $doctorExperience, $doctorPicName, $doctorIsDeleted);
                    foreach($oldDoctorsServices as $oldDoctorServices) {
                        if ($oldDoctorServices['doctors_services_doctor_id'] == $doctorId) {
                            $oldDoctorServices['services'] = explode(',', $oldDoctorServices['services']);
                            if ($oldDoctorServices['services'] !== $doctorInfo[6]) {
                                $this->doctorModel->deleteDoctorServices($doctorId);
                                $str = "";
                                foreach ($doctorInfo[6] as $doctorService) {
                                    $str .= "($doctorId, $doctorService), ";
                                }
                                $str = rtrim($str, ', ');
                                $this->doctorModel->addDoctorServices($str);
                            }
                        }
                    }
                }
                $doctors = $this->doctorModel->GetAllForAdmin();
                $doctorsServices = $this->doctorModel->GetDoctorsServices();
                $answers[] = 'Изменения успешно сохранены';
            }
            
            if(isset($_POST['add-doctor-name']) && isset($_POST['add-doctor-qualification-type']) && isset($_POST['add-doctor-experience']) && isset($_POST['add-doctor-pic']) && isset($_POST['add-doctor-services'])) {
                $doctorName = Helper::escape($_POST['add-doctor-name']);
                $doctorQualificationTypeId = Helper::escape($_POST['add-doctor-qualification-type']);
                $doctorExperience = Helper::escape($_POST['add-doctor-experience']);
                $doctorPicName = Helper::escape($_POST['add-doctor-pic']);
                $doctorId = $this->doctorModel->addDoctor($doctorName, $doctorQualificationTypeId, $doctorExperience, $doctorPicName);
                $str = "";
                foreach ($_POST['add-doctor-services'] as $doctorService) {
                    $str .= "($doctorId, $doctorService), ";
                };
                $str = rtrim($str, ', ');
                $this->doctorModel->addDoctorServices($str);
                $doctors = $this->doctorModel->GetAllForAdmin();
                $doctorsServices = $this->doctorModel->GetDoctorsServices();
                $answers[] = 'Доктор добавлен';
            }
            include_once('views/user/admin.php');
            return;
        }
    }
