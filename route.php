<?php

include ARASH_DIR . 'app/Controllers/HomeController.php';
include ARASH_DIR . 'core/router.php';

use app\Controllers\HomeController;

$router = new Router('/wordpress');

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

$router->get('/', function () {
    $homeController = new HomeController();
    $homeController->index();
});

$router->post('/save', function () {
    $homeController = new HomeController();
    $homeController->save();
});

$router->get('/create-user', function () {
    $homeController = new HomeController();
    $homeController->createUser();
});

$router->get('/insert-user', function (){
    $homeController = new HomeController();
    $homeController->insertUser();
});

$router->get('/update-user/:id', function ($id){
    $homeController = new HomeController();
    $homeController->updateUser($id);
});

$router->get('/delete-user/:id', function ($id){
    $homeController = new HomeController();
    $homeController->deleteUser($id);
});

$router->get('/meta-user', function (){
    $homeController = new HomeController();
    $homeController->metaUser();
});

$router->get('/costom-login', function (){
    $homeController = new HomeController();
    $homeController->costomLogin();
});

$router->get('/user-count', function (){
    $homeController = new HomeController();
    $homeController->userCount();
});

$router->get('/count-user-posts', function (){
    $homeController = new HomeController();
    $homeController->countUserPosts();
});

$router->get('/get-current-user', function (){
    $homeController = new HomeController();
    $homeController->getCurrentUser();
});

$router->get('/get-userdata/:id', function ($id){
    $homeController = new HomeController();
    $homeController->getUserData($id);
});


$router->dispatch();