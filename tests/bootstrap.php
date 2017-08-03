<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'testing'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));


/** SMARTY */
require_once ('../library/Smarty-3.1.30/Smarty.class.php');

/** AutoLoad */
require_once ('../library/auto_load.php');

require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();
