<?php
/**
 * Created by PhpStorm.
 * User: kitoko
 * Date: 12/07/2017
 * Time: 10:54
 */

class GlobalControllerPlugin extends Zend_Controller_Plugin_Abstract
{

    function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $auth = Zend_Auth::getInstance();

        // On détecte l'action
        $module_name = $request->getModuleName();
        $action = ($module_name=='default') ? $request->getControllerName() : $module_name;

        if (!$auth->hasIdentity() && !in_array($action, array('webservices', 'auth'))) {
           header('location: auth/login');
        }
    }
}