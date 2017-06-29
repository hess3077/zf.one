<?php

class AnimalController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $animals = new Application_Model_AnimalMapper();
        $this->view->animals = $animals->fetchAll();
    }
}