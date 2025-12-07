<?php 
  
  namespace Controllers;

  class BlogContoller
  {
      public function index(){
        \App\App::view('archives');
      }

      public function show($id){
        echo $id['id'];
      }
  }
?>