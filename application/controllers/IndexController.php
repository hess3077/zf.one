<?php

class IndexController extends Zend_Controller_Action
{

    private $firephp;

    public function init()
    {
        /* Initialize action controller here */

        $invoke_args = $this->_invokeArgs;
        $this->firephp = $invoke_args['bootstrap']->firephp;
    }

    public function indexAction()
    {
        $this->view->message = 'Données en cours de fabrication ...';
    }
}

