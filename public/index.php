<?php
      require dirname(__DIR__) . DIRECTORY_SEPARATOR .'vendor' . DIRECTORY_SEPARATOR .'autoload.php';
      require_once dirname(__DIR__) . DIRECTORY_SEPARATOR .'routes'. DIRECTORY_SEPARATOR .'web.php';
      require_once dirname(__DIR__) . DIRECTORY_SEPARATOR .'routes'. DIRECTORY_SEPARATOR .'api.php';

      
      $whoops = new \Whoops\Run();
      $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
      $whoops->register();
      
      $origin = isset($_SERVER['BASE_URI']) ? $_SERVER['BASE_URI'] : '';
      Router\Router::origin($origin);
      Router\Router::matcher();
?>
<link rel="stylesheet" href="./css/styles.css">
<link rel="stylesheet" href="./css/auth-styles.css">
<link rel="stylesheet" href="./css/instructions-styles.css">
<link rel="stylesheet" href="./css/dashboard-styles.css">
<link rel="stylesheet" href="./css/soumettre-styles.css">
<link rel="stylesheet" href="./css/recherche-styles.css">
<link rel="stylesheet" href="./css/numeros-styles.css">
<link rel="stylesheet" href="./css/comite-styles.css">
