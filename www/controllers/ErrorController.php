<?php
    class ErrorController {
        public function actionIndex($num) {
            include_once('views/error/index.php');
            return;
        }
    }