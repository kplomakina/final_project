<?php
    $routes = array(
        'MainController' => array (
            'main' => 'index',
            'contacts' => 'contacts',
            'about' => 'about'
        ),
        'DoctorController' => array (
            'doctors' => 'index'
        ),
        'ServiceController' => array (
            'desc' => 'desc',
            'prices' => 'index'
        ),
        'UserController' => array (
            'reg' => 'register',
            'auth' => 'auth',
            'view/([0-9]+)' => 'view/$1'            
        ),
        'AdminController' => array (
            'admin' => 'index',          
        ),
        'CartController' => array (
            'order' => 'order',
            'cart' => 'index',
            'preorder' => 'preorder'
        ),
        'ErrorController' => array (
            'errors/([0-9]+)' => 'index/$1'
        )
    );
?>