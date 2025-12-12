<?php
      // Démarrer la session si elle n'est pas déjà démarrée
      if (session_status() === PHP_SESSION_NONE) {
          session_start();
      }
      
      require dirname(__DIR__) . DIRECTORY_SEPARATOR .'vendor' . DIRECTORY_SEPARATOR .'autoload.php';
      require_once dirname(__DIR__) . DIRECTORY_SEPARATOR .'routes'. DIRECTORY_SEPARATOR .'web.php';
      require_once dirname(__DIR__) . DIRECTORY_SEPARATOR .'routes'. DIRECTORY_SEPARATOR .'api.php';

      
      $whoops = new \Whoops\Run();
      $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
      $whoops->register();
      $db = new \Models\Database();
      $db->connect();
      
      $origin = isset($_SERVER['BASE_URI']) ? $_SERVER['BASE_URI'] : '';
      // Router\Router::$defaultUri= "http://localhost/Revue-Theologie-Upc/public/";
      Router\Router::origin($origin);
      Router\Router::matcher();
?>
 