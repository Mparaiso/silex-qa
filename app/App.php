<?php
use Silex\Application;
use Symfony\Component\HttpKernel\Exception\HttpException;


class App extends Application
{
    public function __construct(array $values = array())
    {
        parent::__construct($values);

        $this->register(new Config);

        $this->match("/exception",function(){
            throw new HttpException(400,"this is a bad request");
        });

    }

}
