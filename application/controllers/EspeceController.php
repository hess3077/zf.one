<?php

class EspeceController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $especes = new Application_Model_EspeceMapper();
        $this->view->especes = $especes->fetchAll();
    }
}

