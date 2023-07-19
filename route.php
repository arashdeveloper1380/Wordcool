<?php

include ARASH_DIR . 'app/Controllers/HomeController.php';
include ARASH_DIR . 'core/router.php';
use Controllers\HomeController;

$router = new Router('/arash-framework');

//  \?id=.*         =>      send Parametr [product?id=33]
//  :id             =>      product/2

// $router->addRoute('/hello/product/:id', function($id) {
//     if($id == 2){
//         echo "2";
//     }else{
//         echo "bilmiram";
//     }
// });

// $router->addRoute('/hello/product\?id=.*', function() {
//     $id = $_GET['id'];
//     echo $id;
// });

// $router->get('/home/:name', function($name) {
//     $homeController = new HomeController();
//     $homeController->index($name);
// });

$router->get('/', function() {
    $homeController = new HomeController();
    $homeController->index();
});

$router->post('/save', function() {
    $homeController = new HomeController();
    $homeController->save();
});

$router->get('/create-user', function() {
    $homeController = new HomeController();
    $homeController->createUser();
});


$router->dispatch();