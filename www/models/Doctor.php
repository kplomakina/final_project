<?php
    class Doctor {
        
        private $db;
        
        public function __construct() {
            $this->db = DB::getInstance();
        }
        
        public function GetAll() {
            $query = (new Select('`doctors`'))
                ->what(array('*', '`qualification_type_name`'))
                ->join(array(array('type' => 'LEFT', 'table' => '`qualification_types`', 'key1' => '`qualification_type_id`', 'key2' => '`doctor_qualification_type_id`')))
                ->sort(array('name' => '`doctor_qualification_type_id`', 'direction' => 'ASC'))
                ->where(array('WHERE' => array('`doctor_is_deleted`', '=', 0)))
                ->build();
            $result = mysqli_query($this->db, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        
        public function GetAllForAdmin() {
            $query = (new Select('`doctors`'))
                ->what(array('*', '`qualification_type_name`'))
                ->join(array(array('type' => 'LEFT', 'table' => '`qualification_types`', 'key1' => '`qualification_type_id`', 'key2' => '`doctor_qualification_type_id`')))
                ->sort(array('name' => '`doctor_qualification_type_id`', 'direction' => 'ASC'))
                ->build();
            $result = mysqli_query($this->db, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        
        public function GetQualificationTypes() {
            $query = (new Select('`qualification_types`'))
                ->build();
            $result = mysqli_query($this->db, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        
        public function GetDoctorsServices() {
            $query = (new Select('`doctors_services`'))
                ->build();
            $result = mysqli_query($this->db, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        
        public function getOldDoctorsServices() {
            $query = (new Select('`doctors_services`'))
                ->what(array('`doctors_services_doctor_id`', 'services' => 'GROUP_CONCAT(DISTINCT `doctors_services_service_id`)'))
                ->groupBy('`doctors_services_doctor_id`')
                ->build();
            $result = mysqli_query($this->db, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        
        public function updateDoctorInfo($doctorId, $doctorName, $doctorQualificationTypeId, $doctorExperience, $doctorPicName, $doctorIsDeleted) {
            $query = "UPDATE `doctors`
				     SET `doctor_name` = '$doctorName', `doctor_qualification_type_id` = $doctorQualificationTypeId, `doctor_experience_years` = $doctorExperience, `doctor_pic_name` = '$doctorPicName', `doctor_is_deleted` = $doctorIsDeleted
				     WHERE `doctor_id` = $doctorId;
            ";
            mysqli_query($this->db, $query);
            return true;
        }
        
        public function deleteDoctorServices($doctorId) {
            $query = "DELETE FROM `doctors_services`
				     WHERE `doctors_services_doctor_id` = $doctorId;
            ";
            mysqli_query($this->db, $query);
            return true;
        }
        
        public function addDoctorServices($str) {
            $query = "INSERT INTO `doctors_services`(`doctors_services_doctor_id`, `doctors_services_service_id`)
				     VALUES $str;
            ";
            mysqli_query($this->db, $query);
            return true;
        }
        
        public function addDoctor($doctorName, $doctorQualificationTypeId, $doctorExperience, $doctorPicName) {
            $query = "INSERT INTO `doctors`
				     SET `doctor_name` = '$doctorName', `doctor_qualification_type_id` = $doctorQualificationTypeId, `doctor_experience_years` = $doctorExperience, `doctor_pic_name` = '$doctorPicName'
            ";
            mysqli_query($this->db, $query);
            $doctorId = mysqli_insert_id($this->db);
            return $doctorId;
        }
    }