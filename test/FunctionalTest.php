<?php

use Silex\WebTestCase;

class FunctionalTest extends WebTestCase
{
    public function createApplication()
    {
        $app = require __DIR__ . './../app/bootstrap.php';
        $app['debug'] = true;
        return $app;
    }

    public function testIndexRoute()
    {
        $client = $this->createClient();
        $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertEquals(
            'INDEX',
            $client->getResponse()->getContent()
        );
    }

    public function testAddAction(){
        $client = $this->createClient();
        $client->request('GET', '/add/4/3');

        //we test response is ok(200)
        $this->assertTrue($client->getResponse()->isOk());
        //and now the result
        $this->assertEquals(7, $client->getResponse()->getContent());
    }

    public function testSubAction(){
        $client = $this->createClient();
        $client->request('GET', '/sub/4/3');

        //we test response is ok(200)
        $this->assertTrue($client->getResponse()->isOk());
        //and now the result
        $this->assertEquals(1, $client->getResponse()->getContent());
    }
}