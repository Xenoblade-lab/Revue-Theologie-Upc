<?php

    Router\Router::get('/', function(){
        App\App::view('index');
    });

    Router\Router::get('/archives', function(){
        App\App::view('archives');
    });
    
    Router\Router::get('/comite', function(){
        App\App::view('comite');
    });

    Router\Router::get('/instructions', function(){
        App\App::view('instructions');
    });

    Router\Router::get('/login',function(){
        App\App::view('login');
    });

    Router\Router::get('/search', function(){
        App\App::view('search');
    });

    Router\Router::get('/register', function(){
        App\App::view('register');
    });

    Router\Router::get('/submit', function(){
        App\App::view('submit');
    });

    Router\Router::get('/test', function(){
       echo "<h1>test</h1>";
    });
?>