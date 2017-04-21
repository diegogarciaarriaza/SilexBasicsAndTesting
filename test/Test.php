<?php

class Test extends \PHPUnit_Framework_TestCase
{
    public function testTrue(){
        $this->assertTrue(true,true);
    }

    public function testFalse(){
        $this->assertFalse(false,true );
    }
}