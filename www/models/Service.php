<?php
    class Service {
        
        private $db;
        
        public function __construct() {
            $this->db = DB::getInstance();
        }
        
        public function GetTypesDesc() {
            $query = (new Select('`service_types`'))
                ->build();
            $result = mysqli_query($this->db, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        public function GetAll() {
            $query = (new Select('`services`'))
                ->where(array('WHERE' => array('`service_is_deleted`', '=', 0)))
                ->build();
            $result = mysqli_query($this->db, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        
        public function getCartInfo($ids) {
            $idsString = implode(',', $ids);
            $query = (new Select('`services`')) 
                ->what(['service_name', 'service_price', 'service_id'])
                ->where(array('WHERE' => array('`service_id`', 'IN', "($idsString)")))
                ->build();
            $result = mysqli_query($this->db, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);     
        }
        
        public function updateServiceTypeInfo($serviceTypeId, $serviceTypeName, $serviceTypeDesc) {
            $query = "UPDATE `service_types`
				     SET `service_type_name` = '$serviceTypeName', `service_type_desc` = '$serviceTypeDesc'
				     WHERE `service_type_id` = $serviceTypeId;
            ";
            mysqli_query($this->db, $query);
            return true;
        }
        
        public function addServiceType($serviceTypeName, $serviceTypeDesc) {
            $query = "INSERT INTO `service_types`
				     SET `service_type_name` = '$serviceTypeName', `service_type_desc` = '$serviceTypeDesc'
            ";
            mysqli_query($this->db, $query);
            return true;
        }
        
        public function checkIfServiceTypeEmpty($serviceTypeId) {
            $query = (new Select('`services`'))
                ->what(array('`count`' => 'COUNT(*)'))
                ->where(array('WHERE' => array('`service_service_type_id`', '=', $serviceTypeId)))
                ->build();
            $result = mysqli_query($this->db, $query);
            $count = mysqli_fetch_assoc($result)['count'];
            return (intval($count) !== 0);
        }
        
        public function deleteServiceType($serviceTypeId) {
            $query = "DELETE FROM `service_types`
				     WHERE `service_type_id` = $serviceTypeId;
            ";
            mysqli_query($this->db, $query);
            return true;
        }
        
        public function GetAllForAdmin() {
            $query = (new Select('`services`'))
                ->build();
            $result = mysqli_query($this->db, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        
        public function updateServiceInfo($serviceId, $serviceTypeId, $serviceName, $servicePrice, $serviceIsDeleted) {
            $query = "UPDATE `services`
				     SET `service_name` = '$serviceName', `service_price` = '$servicePrice', `service_service_type_id` = $serviceTypeId, `service_is_deleted` = $serviceIsDeleted
				     WHERE `service_id` = $serviceId;
            ";
            mysqli_query($this->db, $query);
            return true;
        }
        
        public function addService($serviceTypeId, $serviceName, $servicePrice) {
            $query = "INSERT INTO `services`
				     SET `service_name` = '$serviceName', `service_price` = '$servicePrice', `service_service_type_id` = $serviceTypeId
            ";
            mysqli_query($this->db, $query);
            return true;
        }
    }