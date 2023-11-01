<?php
require_once('./config/DatosDB.php');
require_once('model/Model.php');
class Model 
{
    private $pdo;
    public function __CONSTRUCT()
    {
        try {
            $this->pdo = DB::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
