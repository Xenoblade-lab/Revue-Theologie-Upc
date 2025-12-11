<?php
  namespace Models;
  class Model{
    protected $table = "model";
    public function all(){
        "SELECT * FROM {$this->table}";
    }
  }
?>