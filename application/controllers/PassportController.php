<?php

class PassportController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $passport = new Application_Model_PassportMapper();
        $this->view->agents = $passport->fetchAll();
    }
}

