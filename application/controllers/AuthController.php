<?php

class AuthController extends Zend_Controller_Action
{
    public $_message_errors;
    private $_adapter;


    public function init()
    {
        $this->_helper->layout->disableLayout();

        $this->_message_errors = self::getMessageErrors();

        $this->_adapter = new Zend_Auth_Adapter_DbTable(
            Zend_Db_Table_Abstract::getDefaultAdapter(),
            'users',
            'username',
            'password'
        );
    }

    public function getMessageErrors()
    {
        $errors = array(
            'username' => array(
                'empty' => 'Saisissez votre Login'
            ),
            'password' => array(
                'empty' => 'Entrez un mot de passe',
                'invalid' => 'Mot de passe incorrect. Veuillez réessayer.'
            )
        );

        return $errors;
    }

    public function indexAction()
    {
        $this->redirect('auth/login/');
    }

    public function loginAction()
    {
        $loginForm = new Application_Form_Authentification($_POST);
        $message_errors = $this->_message_errors;

        if ($loginForm->isValid($_POST) && !empty($_POST['submit'])) {
            foreach ($message_errors as $element=>$error) {
                if(empty($loginForm->getValue($element))){
                    $loginForm->getElement($element)->setErrors(array($error['empty']));
                }
            }

            $adapter = $this->_adapter;
            $adapter->setIdentity($loginForm->getValue('username'));
            $adapter->setCredential($loginForm->getValue('password'));

            try {
                $result = $adapter->authenticate($adapter);

                if ($result->isValid()) {
                    $auth = Zend_Auth::getInstance();
                    $userInfo = $adapter->getResultRowObject(null, 'password');

                    // the default storage is a session with namespace Zend_Auth
                    $authStorage = $auth->getStorage();
                    $authStorage->write($userInfo);

                    $this->_helper->FlashMessenger('Successful Login');
                    $this->redirect('/');

                    return;
                }
                else {
                    $loginForm->getElement('password')->setErrors(array($message_errors['password']['invalid']));
                }
            }
            catch (Exception $e) {}
        }
        else {
            if(!empty($_POST['submit'])) {
                foreach ($message_errors as $element=>$error) {
                    if(empty($loginForm->getValue($element))){
                        //$loginForm->getElement($element)->addDecorator('errors');
                        $loginForm->getElement($element)->setErrors(array($error['empty']));
                    }
                }
            }
        }

        $this->view->loginForm = $loginForm;
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();

        $this->redirect('/');
    }
}