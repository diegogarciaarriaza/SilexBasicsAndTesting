<?php

date_default_timezone_set('Europe/Madrid');

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';
$app = new Silex\Application;

$app['debug'] = true;

//library for use of monolog (logs)
use Silex\Provider\MonologServiceProvider;

//register of monolog
$app->register(new MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__ . '/../logs/dev.log'
));


//On this way we have in the same order the call and the functionality
$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello '.$app->escape($name);
});

//This other separates call and functionality in an extern controller
$app->get('/', 'AppBundle\Controller\AppControl::indexAction');
//above is similar
/*$app
    ->match('/', 'AppBundle\Controller\AppControl::indexAction')
    ->method('GET|POST');
*/

$app->get('/add/{sum1}/{sum2}', 'AppBundle\Controller\AppControl::addAction');

$app->get('/sub/{sum1}/{sum2}', 'AppBundle\Controller\AppControl::subAction');

//Return $app
return $app;