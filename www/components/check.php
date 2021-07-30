<?php
    class Check {
        
        public $userModel;
        
        public function __construct() {
            $this->userModel = new User();
        }
        
        public function checkIfAuthorized() {
            if (isset($_COOKIE['user']) && isset($_COOKIE['token']) && isset($_COOKIE['tokenTime'])) {
                $userId = $_COOKIE['user'];
                $token = $_COOKIE['token'];
                $tokenTime = $_COOKIE['tokenTime'];
                $connectionId = $this->userModel->checkToken($userId, $token, $tokenTime);
                if ($connectionId > 0) {
                    if (time() > $tokenTime) {
                        $token = Helper::generateToken();
                        $tokenTime = time() + 15 * 60;
                        setcookie('token', $token, time() + 2 * 24 * 60 * 60);
                        setcookie('tokenTime', $tokenTime);
                        $this->userModel->updateToken($connectionId, $token, $tokenTime);
                    }
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        
        public function checkIfAdmin() {
            $userIsAuthorized = $this->checkIfAuthorized();
            if($userIsAuthorized) {
                $userInfo = $this->userModel->getUserById($_COOKIE['user']);
                return $userIsAdmin = ($userInfo['user_is_admin'] == USER_ADMIN);
            } else {
                return false;
            }
        }
    }
