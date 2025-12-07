<?php 

    Router\Router::post('/register', function(){
      
           $auth = new Service\AuthService();
           $auth->register($_POST);

    });
?>