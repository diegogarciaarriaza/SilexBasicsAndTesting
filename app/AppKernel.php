<?php

class AppKernel extends Kernel
{
    // Other methods and variables


    // Append this init function below

    public function __construct($environment, $debug)
    {
        date_default_timezone_set( 'Europe/Paris' );
        parent::__construct($environment, $debug);
    }

}