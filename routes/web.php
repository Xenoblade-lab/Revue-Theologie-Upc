<?php
//  =========== GET ================


    Router\Router::get('/', function(){
        App\App::view('index');
    });

    Router\Router::get('/archives',[\Controllers\BlogContoller::class,'index']);

    Router\Router::get('/archives/[i:id]',[\Controllers\BlogContoller::class,'show']);
    
    Router\Router::get('/comite', function(){
        App\App::view('comite');
    });

    Router\Router::get('/instructions', function(){
        Service\AuthService::requireLogin();
        App\App::view('instructions');
    });

    Router\Router::get('/login',function(){
        App\App::view('login');
    });

    Router\Router::get('/search', function(){
        Service\AuthService::requireLogin();
        App\App::view('search');
    });

    Router\Router::get('/register', function(){
        App\App::view('register');
    });

    Router\Router::get('/submit', function(){
        Service\AuthService::requireLogin();
        App\App::view('submit');
    });

    Router\Router::get('/test', function(){
        
        var_dump(App\Html::class('/test'));
    });

    Router\Router::get('/admin', function(){
        App\App::view('admin' . DIRECTORY_SEPARATOR . 'index');
    });
    Router\Router::get('/author', function(){
        App\App::view('author' . DIRECTORY_SEPARATOR . 'index');
    });
    
   // =========== POST ================
    Router\Router::post('/login', function(){
        $auth = new Service\AuthService();
        $auth->login($_POST);
    });



?>