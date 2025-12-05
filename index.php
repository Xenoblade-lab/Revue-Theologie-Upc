<?php
      require __DIR__ . DIRECTORY_SEPARATOR .'vendor' . DIRECTORY_SEPARATOR .'autoload.php';
      require_once 'routes/web.php';
      Router\Router::matcher();
?>