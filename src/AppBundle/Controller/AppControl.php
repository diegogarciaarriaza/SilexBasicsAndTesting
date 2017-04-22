<?php

namespace AppBundle\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Helper\Functions;

class AppControl
{
    public function indexAction(Application $app){
        $app['monolog']->addInfo('Basic use of routing and logging');
        return 'INDEX';
    }

    public function addAction(Application $app, Request $request){
        $app['monolog']->addInfo('Add Action from controller');

        //return new Response((new Functions())->add($request->get('sum1'), $request->get('sum2')), 200);
        //more detailed...
        $sum1 = $request->get('sum1');
        $sum2 = $request->get('sum2');
        $calc = new Functions();
        $res = $calc->add($sum1, $sum2);

        return new Response($res, 200);
    }

    public function subAction(Application $app, Request $request){
        $app['monolog']->addInfo('Add Action from controller');

        //return new Response((new Functions())->sub($request->get('sum1'), $request->get('sum2')), 200);
        //more detailed...
        $sum1 = $request->get('sum1');
        $sum2 = $request->get('sum2');
        $calc = new Functions();
        $res = $calc->sub($sum1, $sum2);

        return new Response($res, 200);
    }
}