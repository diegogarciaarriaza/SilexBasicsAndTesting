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


//de este modo tenemos en una misma orden, la llamada a la ruta y la funcionalidad de la misma
$app->get('/test', function() use($app){
    $app['monolog']->addInfo('Basic use of routing and logging');
    return 'INDEX';
}) ;


//De este otro, separamos el routing de la funcionalidad propia
$app->get('/', 'AppBundle\Controller\AppControl::index');
/*$app
    ->match('/', 'AppBundle\Controller\AppControl::index')
    ->method('GET|POST');

return $app;
*/


$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello '.$app->escape($name);
});


$app['debug'] = true;
return $app;