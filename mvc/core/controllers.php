<?php 
class controllers{
    public function model($model){
        require_once "./mvc/models/".$model.".php";
        return new $model;
    }
    public function view($view,$data=[]){
        require_once "./mvc/views/".$view.".php";
    }
    // public function contro($model){
    //     require_once "./mvc/controllers/".$model.".php";
    //     return new $model;
    // }
}
?>