<?php  
  namespace App;
  
  class App
  {
      public static function view(string $view,array $loading = [])
      {
          extract($loading);
          require dirname(__DIR__) .  DIRECTORY_SEPARATOR ."views" . DIRECTORY_SEPARATOR . $view . ".php";
      }
  }
?>