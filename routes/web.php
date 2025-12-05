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

    Router\Router::get('/test', function(){
       echo "<h1>Royi suce moi la bite</h1>";
    });
?>