<?php 

<<<<<<< HEAD
    Router\Router::post('/register', function(){
       //     header("Content-Type: application/json");
       //     $datas = json_decode(file_get_contents('php://input'), true) ?? [];
           $auth = new Service\AuthService();
           var_dump($_POST);
           $auth->sign($_POST);

    });

    Router\Router::post('/login', function(){
       //     header("Content-Type: application/json");
       //     $datas = json_decode(file_get_contents('php://input'), true) ?? [];
=======
    Router\Router::post('/api/register', function(){
           header("Content-Type: application/json");
           $datas = json_decode(file_get_contents('php://input'), true) ?? [];
           $auth = new Service\AuthService();
           $auth->sign($datas);
    });

    Router\Router::post('/api/login', function(){
           header("Content-Type: application/json");
           $datas = json_decode(file_get_contents('php://input'), true) ?? [];
>>>>>>> c23bfdfdc56501fc0411a9644e7d6e90305931ca
           $auth = new Service\AuthService();
           $auth->login($_POST);
    });
?>