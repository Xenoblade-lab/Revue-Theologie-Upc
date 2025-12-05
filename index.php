<?php
      require __DIR__ . DIRECTORY_SEPARATOR .'vendor' . DIRECTORY_SEPARATOR .'autoload.php';
      require_once __DIR__ . DIRECTORY_SEPARATOR .'routes'. DIRECTORY_SEPARATOR .'web.php';
      $origin = isset($_SERVER['BASE_URI']) ? $_SERVER['BASE_URI'] : '';
      Router\Router::origin($origin);
      Router\Router::matcher();
?>