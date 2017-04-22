# SilexBasicsAndTesting

The purpose of this guide is to show how to use Silex in a basic way and unit and functional test.

## Theory about Silex and Tests
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
    
    We can to do two types of test, UnitTest and FunctionalTest. For use it, we have to configure **phpunit.xml.dist** where we will configure the directory where tests are found.
    
    * **UnitTest:** 
    
        They check the proper functioning of the differents task (like a method) in an independient way. In order to use this, we can extends the PHPUnit_Framework_TestCase functionality and we create the differents test like above:
        
        ```
        public function testFalse(){
            $this->assertFalse(false,true );
        }
        ```
        
    * **FunctionalTest:**
    
        They are used for verify that each function of the software application operates in conformance with the requirement specifications. In silex we can extends WebTestCase. We can do something like this:
        
        ```
        public function testIndexRoute()
        {
            $client = $this->createClient();
            $client->request('GET', '/');
        
            $this->assertTrue($client->getResponse()->isOk());
            $this->assertEquals('Hello World', $client->getResponse()->getContent()
            );
        }
        ```
  
## How to test this project

The installation of this project is very easy. Simple clone the repository with 
```
git clone https://github.com/https://github.com/diegogarciaarriaza/SilexBasicsAndTesting
```

And install the dependencies of composer.json
```
php composer.phar install
```

Create a server for php from your terminal (for example in localhost:7788). In SilexBasicsAndTesting/web type:
```
php -S localhost:7788
```

For testing, simply launch phpunit from SilexBasicsAndTesting root. If phpunit is not recognized, you should make an alias:
```
SilexBasicsAndTesting >_ alias phpunit="vendor/bin/phpunit"
SilexBasicsAndTesting >_ phpunit
```

>I hope you find it useful.
Regards, Diego.