<?php

class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
        $this->bootstrap = array($this, 'appBootstrap');
        parent::setUp();
    }

    public function testEquality()
    {
        $this->assertEquals(
            [1, 2, 3, 4, 5, 6],
            [1, 2, 33, 4, 5, 6]
        );
    }
}

