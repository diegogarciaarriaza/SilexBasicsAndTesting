# SilexBasicsAndTesting

The purpose of this guide is to show how to use Silex in a basic way and unit and functional test.

## Contents
* **Installation of Silex**

    Install Silex is pretty simple, we can do it using **composer**:
    For it, we will execute the **composer.json** file and we will have all for the right working of silex, unit test, functional test, logs and routing with controller. 
    But if you just want to install silex, you only need:
    ``` 
    "require-dev": {
        "phpunit/phpunit": "5.7.5",
        "symfony/browser-kit": ">=2.3,<2.4-dev"
    }
    ```
    
* **First Usage**

    After that you only need a file like this **index.html**
    ```
    <?php
    require_once __DIR__.'/../vendor/autoload.php';
    
    $app = new Silex\Application();
    
    $app->get('/', function() use($app) {
        return $app->escape("Hello world");
    });
    
    $app->run();
    ```
    
* **Good practices**

    It is a really good practice to separate the call to autoload and the routing functionalities, for this we will use a simple index with the call to autoload and other file **bootstrap.php** with the real work of the application.
    
    In this file we can type the differents routes of two ways.
        
    * Having in the same order the call and the functionality
        ```
        $app->get('/hello/{name}', function ($name) use ($app) {
              return 'Hello '.$app->escape($name);
        });
        ```
    * Having separates the call and functionality in an extern controller
        ```
        $app->get('/', 'AppBundle\Controller\AppControl::indexAction');
        ```
    * And a similar way of ahead, with more posibilities
        ```
        $app
            ->match('/', 'AppBundle\Controller\AppControl::indexAction')
            ->method('GET|POST');
        ```
        
    We will use the second and third way following the symfony philosophy :)
    
* **Controllers**

    As good programmers... we will have separated the controller of the rest of the application. In our case, we will have a simple function for add two numbers and return the result with a html response
    ```
    public function addAction(Application $app, Request $request){
        return new Response((new Functions())->add($request->get('sum1'), $request->get('sum2')), 200);
    }
    ```
    Always we can do it in a more detailed mode:
    ```
    public function addAction(Application $app, Request $request){
        $app['monolog']->addInfo('Add Action from controller');

        $sum1 = $request->get('sum1');
        $sum2 = $request->get('sum2');
        $calc = new Functions();
        $res = $calc->add($sum1, $sum2);
        
        return new Response($res, 200);
    }
    ```
    
* **Tests**
