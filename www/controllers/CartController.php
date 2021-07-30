<?php

    class CartController {
        
        public $serviceModel;
        public $userModel;
        public $cartModel;
        public $menu;
        public $check;
        
        public function __construct() {
            $this->serviceModel = new Service();
            $this->userModel = new User();
            $this->cartModel = new Cart();
            $this->menu = new Menu();
            $this->check = new Check();
        }
        
        public function actionIndex() {
            $title = 'Корзина';
            $menuItems = $this->menu->getMenu();
            $menuItems = Helper::build_menu($menuItems);
            $userIsAuthorized = $this->check->checkIfAuthorized();
            $services = [];
            if (isset($_COOKIE['cart'])) {
                $cart = json_decode($_COOKIE['cart'], true);
                $ids = array_keys($cart);
                $services = $this->serviceModel->getCartInfo($ids);
            }
            include_once('views/cart/index.php');
            return;
        }
        
        public function actionPreorder() {
            $title = 'Оформление заказа';
            $menuItems = $this->menu->getMenu();
            $menuItems = Helper::build_menu($menuItems);
            $userIsAuthorized = $this->check->checkIfAuthorized();
            
                
            $cartItems = [];
            if (isset($_COOKIE['cart'])) {
                $userId = $_COOKIE['user'];
                
                $cart = json_decode($_COOKIE['cart'], true);
                foreach ($cart as $key => $item) {
                    if ($item !== 0) {
                        $cartItems[] = $key;
                    }
                }
                $preorderInfo = $this->serviceModel->getCartInfo($cartItems);
                $userInfo = $this->userModel->getUserById($userId);
                $paymentTypes = $this->cartModel->getPaymentTypes();
                $orderSum = 0;
                foreach ($preorderInfo as $item) {
                    $orderSum += $item['service_price'];
                }
                if(isset($_POST['preorder-payment-type'])) {
                    $paymentType = Helper::escape($_POST['preorder-payment-type']);
                    $orderDate = time();
                    $orderId = $this->cartModel->addOrder($userId, $paymentType, $orderDate);
                    $str = "";
                    foreach ($cartItems as $cartItem) {
                        $str .= "($orderId, $cartItem), ";
                    }
                    $str = rtrim($str, ', ');
                    $this->cartModel->addCarts($str);
                    setcookie('cart', null);
                    header("Location: " . FULL_SITE_ROOT . "order/$orderId");
                }
            }
            include_once('views/cart/preorder.php');
            return ;
        }
        
        public function actionOrder($orderId) {
            $title = 'Заказ оформлен!';
            $menuItems = $this->menu->getMenu();
            $menuItems = Helper::build_menu($menuItems);
            
            $userIsAuthorized = $this->check->checkIfAuthorized();
            include_once('views/cart/order.php');
            return ;
        } 
    }