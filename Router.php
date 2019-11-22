<?php 


namespace App\Router;

use App\Router\Route;
use App\Exceptions\RouterException;



class Router{

    private $url;
    private $routes = [];
    private $namedRoutes = [];


    public function __construct($url)
    {
        $this->url = $url;
    }

    public function get( $path, $callable, $name=null)
    {
        return $this->add($path, $callable, $name, 'GET');
    }


    public function post( $path, $callable, $name=null)
    {
        return $this->add($path, $callable, $name, 'POST');

    }

    private function add($path ,$callable, $name, $method)
     {
         $route = new Route($path, $callable);
         $this->routes[$method][] = $route;
         if($name)
         {
             $this->namedRoutes[$name] = $route;
         }
         return $route;
     }

    public function run()
    {
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
           throw new RouterException('Method request does not exist'); 
        }
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route)
        {
            if($route->match($this->url))
            {
            
                    return $route->call();
                
            }
        }
        throw new RouterException('no match routes');
    }

    public function url($name ,$params =[])
    {
        if(!isset($this->namedRoutes[$name]))
        {
            throw new RouterException('No routes matches name');
        }
        return  $this->namedRoutes[$name]->getUrl($params);
    }
}