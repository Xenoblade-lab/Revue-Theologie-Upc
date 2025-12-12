<?php
  namespace Controllers;

  class AdminController extends UserController
  {
      public function delete(array $params = [])
      {
        return parent::delete($params);
      }
  }
?>