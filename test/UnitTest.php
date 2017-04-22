<?php

use AppBundle\Helper\Functions;

class Test extends \PHPUnit_Framework_TestCase
{
    protected $calc;

    public function setUp()
    {
        $this->calc = new Functions();
    }

    public function testTrue(){
        $this->assertTrue(true,true);
    }

    public function testFalse(){
        $this->assertFalse(false,true );
    }

    public function testAdd(){
        $res = $this->calc->add(3,5);
        $this->assertEquals(8, $res);
    }

    public function testSub(){
        $res = $this->calc->sub(3,5);
        $this->assertEquals(-2, $res);
    }
}