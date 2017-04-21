<?php

namespace AppBundle\Controller;

use Silex\Application;

class AppControl
{
    public function index(Application $app){
        $app['monolog']->addInfo('Basic use of routing and logging');
        return 'INDEX';
    }
}