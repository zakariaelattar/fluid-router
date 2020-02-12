# fluid-router
A basic fast router for php projects

## Install
To install with composer:

````
composer require `zakariaelattar/fluid-router
````
Requires PHP 7.1 or newer.


## Usage

Here's a basic usage example:

```php
<?php
$router=new Router($_GET['url']);

/*
* basics Routes
*/

// Using  callback function 

$router->get('/',function(){
   $view = new View('home');
    $view->render();

});
$router->post('/',function(){
   $view = new View('home');
    $view->render();

});
// Using a method of a class

$router->get('/articles',"Article@getArticles");

$router->post('/articles',"Article@setArticles");



$router->run();
`````

