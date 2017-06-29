<?php

class Webservices_RaceController extends Zend_Controller_Action
{
    protected $_instance_vars = null;
    protected $_model_mapper = null;

    public function init()
    {
        /* Initialize action controller here */
        $this->_instance_vars = new Vars();
        $this->_model_mapper = new Application_Model_RaceMapper();
    }

    public function indexAction()
    {
        // action body

        $this->view->output = $this->_instance_vars->MVC_format_datas($this->_model_mapper->fetchAll('array'), 'race');
    }
}

