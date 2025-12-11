<?php 

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
           $auth = new Service\AuthService();
           $auth->login($_POST);
    });
?>