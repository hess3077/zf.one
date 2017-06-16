<?php

/**
 * Auto-chargement des classes PHP
 * @return void
 */

function my_autoloader($class) {
    $class = '../library/classes/' . strtolower($class) . '.class.php';

    if(file_exists($class)){
        include $class;
    }
}

spl_autoload_register('my_autoloader');

?>