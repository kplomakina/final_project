<?php
    spl_autoload_register(function($class) {
        $dirs = array('components', 'controllers', 'models'); //здесь перечисляем директории, в которых могут содержаться классы
        foreach ($dirs as $dir)  {
            $filePath = $dir . '/' . strtolower($class) . '.php';
            if(file_exists($filePath)) {
                include_once($filePath);
                break;
            }
        }
    });
?>