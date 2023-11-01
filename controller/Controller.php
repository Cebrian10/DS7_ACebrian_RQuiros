<?php
require_once('model/Model.php');
class Controller 
{
    private $model;
    public function Index()
    {
        require('view/login.php');
    }
}
?>