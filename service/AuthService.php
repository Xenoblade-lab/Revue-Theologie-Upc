<?php 
 
  namespace Service;
  
  class AuthService 
  {
       public function register(array $data)
       {
            var_dump($data);
       }
       public function login(array $data)
       {
          echo json_encode( var_dump($data));

       }    
  }
?>