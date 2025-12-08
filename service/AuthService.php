<?php 
 
  namespace Service;
  
  class AuthService 
  {
       public function register(array $data = [])
       {
            echo json_encode([
               'status' => 200,
               'message' => 'User registered successfully',
               
            ],JSON_PRETTY_PRINT); 
       }
       public function login(array $data = [])
       {
         echo json_encode($data,JSON_PRETTY_PRINT); 

       }    

       public function logout()
      {
          $_SESSION = array();
          session_destroy();
       }

       public static function requireLogin() 
       {
            if (!self::isLoggedIn()) {
                header('Location: ' .\Router\Router::route('login'));
                exit;
            }
        }
        
        public static function isLoggedIn() {
            return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
        }

  }
?>