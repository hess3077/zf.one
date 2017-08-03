<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public $_instance_vars;
    public $_instance_pages;
    public $firephp;


    protected function _initView()
    {
        // initialize smarty view
        $view = new ViewSmarty($this->getOption('smarty'));
        // setup viewRenderer with suffix and view
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->setViewSuffix('tpl');
        $viewRenderer->setView($view);

        // ensure we have layout bootstraped
        $this->bootstrap('layout');
        // set the tpl suffix to layout also
        $layout = Zend_Layout::getMvcInstance();
        $layout->setViewSuffix('tpl');

        return $view;
    }

    protected function _initCss()
    {
        /**
         * If in production, the CSS should already be compiled
         *  so we don't want to waste our processing time.
         */
        if (APPLICATION_ENV == "production") {
            return;
        }

        /**
         * Include the LessPHP library from where we saved it.
         */
        require_once APPLICATION_PATH."/../library/lessphp/lessc.inc.php";

        /**
         * Identify the source LESS stylesheet, and the
         *  destination CSS stylesheet.
         */
        $sLess_and_sCss = Files::generated_LESS_to_CSS();
        $sLess = $sLess_and_sCss['less'];
        $sCss  = $sLess_and_sCss['css'];

        /**
         * Compile the source LESS through lessc() and save
         *  the output CSS into the destination.
         */
        foreach ($sLess as $key_sLess=>$file_sLess){
            $oLessc = new lessc($file_sLess);
            file_put_contents($sCss[$key_sLess], $oLessc->parse());
        }
    }

    public function _initGlobalPlugin() {
        $this->bootstrap('frontController');

        require_once 'controllers/GlobalControllerPlugin.php';
        $plugin = new GlobalControllerPlugin();

        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin($plugin);

        return $plugin;
    }
}