<?php
    class Cart {
        
        private $db;
        
        public function __construct() {
            $this->db = DB::getInstance();
        }
        
        public function getPaymentTypes() {
            $query = (new Select('`payment_types`'))
                ->build();
            $result = mysqli_query($this->db, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
            
        public function addOrder($userId, $paymentType, $orderDate) {
            $query = "INSERT INTO `orders` 
                     SET `order_user_id` = $userId,
                         `order_payment_type_id` = $paymentType,
                         `order_date` = FROM_UNIXTIME($orderDate);
            ";
        mysqli_query($this->db, $query);
        $orderId = mysqli_insert_id($this->db);
        return $orderId;
        }
        
        public function addCarts($str) {
            $query = "INSERT INTO `carts`(`cart_order_id`, `cart_service_id`)
				     VALUES $str;
            ";
            mysqli_query($this->db, $query);
            return true;
        }
    }