<?php
/**
 * Class DB - Установка подключения к БД через создание паттерна Одиночка
 */
    final class DB {
        private static $instance = null;
        
        private function __construct() {
            include_once('config/db.php');
            $connection = mysqli_connect($db['host'], $db['user'], $db['password'], $db['db_name']);
            mysqli_set_charset($connection, 'utf8');
            self::$instance = $connection;
            
        }
        public static function getInstance() {
            if(self::$instance === null) {
                new self();
            }
            return self::$instance;
        }
        
        private function __clone(){
        
        }
        private function __wakeup(){
        
        }
        private function __sleep(){
        
        }
    }