<?php
    class Router {
        
        private $routes;
        
        public function __construct() {
            include_once('config/routes.php');
            $this->routes=$routes;    
        }
        
        public function run() {
            $requestedUrl = trim($_SERVER['REQUEST_URI'], '/');
            foreach ($this->routes as $controller => $availableRoutes) {
                foreach ($availableRoutes as $availableRoute => $actionWithParameters) {
                    if(preg_match("~$availableRoute~", $requestedUrl)) {
                        $actionWithParameters = preg_replace("~$availableRoute~", $actionWithParameters, $requestedUrl);
                        $count = 1;
                        $actionWithParameters = str_replace(SITE_ROOT, '', $actionWithParameters, $count);
                        $actionWithParametersArray = explode('/', $actionWithParameters);
                        $selectedController = new $controller();
                        $action = array_shift($actionWithParametersArray);
                        $selectedAction = 'action' . ucfirst($action);
                        call_user_func_array(array($selectedController, $selectedAction), $actionWithParametersArray);
                        break 2;
                    } 
                      
                } 
            } 
            if (!preg_match("~$availableRoute~", $requestedUrl)) {
                    $selectedController = new ErrorController();
                        $selectedAction = 'actionIndex';
                        $actionWithParametersArray[] = '404';
                        call_user_func_array(array($selectedController, $selectedAction), $actionWithParametersArray);
            }
        }
    }


        
    
