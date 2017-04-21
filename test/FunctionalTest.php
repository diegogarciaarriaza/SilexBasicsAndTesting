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
}