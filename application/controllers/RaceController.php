<?php

class RaceController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $races = new Application_Model_RaceMapper();
        $this->view->races = $races->fetchAll();
    }
}

