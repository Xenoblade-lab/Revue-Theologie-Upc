<?php  
  namespace App;
  
  class App
  {
      public static function view(string $view,array $loading = [])
      {
          extract($loading);
          require dirname(__DIR__) .  DIRECTORY_SEPARATOR ."views" . DIRECTORY_SEPARATOR . $view . ".php";
      }
      public function jsonResponse($array = [])
      {
          header('Content-Type: application/json; charset=utf-8');
          if($array !== null && is_array($array))
          {
              http_response_code($array['status']);
              echo json_encode($array);
          }
          die();
      }
  }
?>