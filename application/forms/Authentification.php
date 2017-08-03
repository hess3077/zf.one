<?php

class Application_Form_Authentification extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        $this->setAttrib('class', 'ui large form login');

        $username = new Zend_Form_Element_Text('username', array(
            'label' => 'Login',
            'required' => false,
            'filters'    => array('StringTrim'),
            'placeholder' => 'Login',
            'decorators' => array(
                'ViewHelper',
                'Errors',
                array(array('label' => 'HtmlTag'), array('tag' => 'i', 'class' => 'user icon', 'placement' => 'prepend')),
                array(
                    array( 'wrapperField' => 'HtmlTag' ),
                    array( 'tag' => 'div', 'class' => 'ui left icon input' ),
                ),
                array( 'Label', array( 'placement' => 'prepend', 'class' => 'label_input' ) ),
                array( array( 'wrapperAll' => 'HtmlTag' ), array( 'tag' => 'div', 'class' => 'clearfix' ) ),
            )
        ));

        $password = new Zend_Form_Element_Password('password', array(
            'label' => 'Mot de passe',
            'required' => false,
            'placeholder' => 'Mot de passe',
            'decorators' => array(
                'ViewHelper',
                'Errors',
                array(array('label' => 'HtmlTag'), array('tag' => 'i', 'class' => 'lock icon', 'placement' => 'prepend')),
                array(
                    array( 'wrapperField' => 'HtmlTag' ),
                    array( 'tag' => 'div', 'class' => 'ui left icon input' ),
                ),
                array( 'Label', array( 'placement' => 'prepend', 'class' => 'label_input' ) ),
                array( array( 'wrapperAll' => 'HtmlTag' ), array( 'tag' => 'div', 'class' => 'clearfix' ) ),
            )
        ));

        $submit = new Zend_Form_Element_Submit('submit', array(
            'ignore'   => true,
            'require'  => false,
            'label'    => 'Se connecter',
        ));

        $this->addElements(array(
            $username, $password, $submit
        ));
    }
}

