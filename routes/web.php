<?php

    Router\Router::get('/', function(){
        App\App::view('index');
    });

    Router\Router::get('/test', function(){
       echo "<h1>Royi suce moi la bite</h1>";
    });
?>