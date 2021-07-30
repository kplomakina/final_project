<?php
    class User {
        
        private $db;
        
        public function __construct() {
            $this->db = DB::getInstance();
        }
        
        public function getPetTypes() {
            $query = (new Select('`pet_types`'))
                ->build();
            $result = mysqli_query($this->db, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
            
        public function checkIfEmailExists($email) {
            $query = (new Select('`users`'))
                ->what(array('`count`' => 'COUNT(*)'))
                ->where(array('WHERE' => array('`user_email`', '=', "'$email'")))
                ->build();
            $result = mysqli_query($this->db, $query);
            $count = mysqli_fetch_assoc($result)['count'];
            return (intval($count) === 1);
        }
        
        public function checkIfPhoneExists($phone) {
            $query = (new Select('`users`'))
                ->what(array('`count`' => 'COUNT(*)'))
                ->where(array('WHERE' => array('`user_phone`', '=', "'$phone'")))
                ->build();
            $result = mysqli_query($this->db, $query);
            $count = mysqli_fetch_assoc($result)['count'];
            return (intval($count) === 1);
        }
        
        public function register($email, $password, $name, $phone, $dob, $pet) {
            $query = "INSERT INTO `users` 
                     SET `user_email` = '$email',
                         `user_password` = '$password',
                         `user_name` = '$name',
                         `user_phone` = '$phone',
                         `user_dob` = '$dob',
                         `user_pet_type_id` = '$pet';
            ";
        mysqli_query($this->db, $query);
        $userId = mysqli_insert_id($this->db);
        return $userId;
        }
        
        public function checkIfUserExists($email, $password) {
            $query = (new Select('`users`'))
                ->what(array('`count`' => 'COUNT(*)', '`user_id`', '`user_is_admin`'))
                ->where(array('WHERE' => array('`user_email`', '=', "'$email'"), 'AND' => array('`user_password`', '=', "'$password'") ))
                ->build();
            $result = mysqli_query($this->db, $query);
            return mysqli_fetch_assoc($result);
        }
        
        public function getUserById($id) {
            $query = (new Select('`users`'))
                ->join(array(array('type' => 'LEFT', 'table' => '`pet_types`', 'key1' => '`pet_type_id`', 'key2' => '`user_pet_type_id`')))
                ->where(array('WHERE' => array('`user_id`', '=', "'$id'")))
                ->build();
            $result = mysqli_query($this->db, $query);
            return mysqli_fetch_assoc($result);
        }
        
        public function getUserOrders($id) {
            $query = (new Select('`orders`'))
                ->what(array('*', 'service_price_sum' => 'SUM(`service_price`)', 'service_name' => 'GROUP_CONCAT(DISTINCT `service_name` SEPARATOR "; <br>")'))
                ->join(array(array('type' => 'LEFT', 'table' => '`carts`', 'key1' => '`cart_order_id`', 'key2' => '`order_id`'), array('type' => 'LEFT', 'table' => '`services`', 'key1' => '`cart_service_id`', 'key2' => '`service_id`')))
                ->where(array('WHERE' => array('`order_user_id`', '=', "'$id'")))
                ->groupBy('`order_id`')
                ->build();
            $result = mysqli_query($this->db, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        
        public function insertToken($userId, $token, $tokenTime) {
            $query = "INSERT INTO `connects` 
                     SET `connect_user_id` = $userId,
                         `connect_token` = '$token',
                         `connect_token_time` = FROM_UNIXTIME($tokenTime);
            ";
        mysqli_query($this->db, $query);
        return true;
        }
        
        public function checkToken($userId, $token, $tokenTime) {
            $query = (new Select('`connects`'))
                ->what(array('`connect_id`'))
                ->where(array('WHERE' => array('`connect_user_id`', '=', "$userId"), 'AND' => array('`connect_token`', '=', "'$token'") ))
                ->build();
            $result = mysqli_query($this->db, $query);
            return mysqli_fetch_assoc($result)['connect_id'];
        }
        
        public function updateToken($connectionId, $token, $tokenTime) {
            $query = "UPDATE `connects` 
                     SET `connect_token` = '$token',
                         `connect_token_time` = FROM_UNIXTIME($tokenTime)
                     WHERE `connect_id` = $connectionId;
            ";
        mysqli_query($this->db, $query);
        return true;
        }
    }