<?php 
  
  namespace Controllers;

  class BlogContoller
  {
      public function index(){
        \Service\AuthService::requireLogin();
        \App\App::view('archives');
      }

      public function show($id){
        echo $id['id'];
      }
  }
?>