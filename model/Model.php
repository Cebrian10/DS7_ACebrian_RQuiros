<?php
require_once('./config/DatosDB.php');
require_once('model/DB.php');
class Model
{
    private $pdo;
    public $name;
    public $email;
    public $password;
    public $hashedPassword;
    public $rol;
    public function __CONSTRUCT()
    {
        try {
            $this->pdo = DB::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function RegisterModel(Model $data)
    {
        if (!$this->VerificarExistenciaEmail($data)) {
            try {
                $sql = "INSERT INTO usuarios (name, email, pass, rol) VALUES (?,?,?,?)";
                $stmt = $this->pdo->prepare($sql);
                $result = $stmt->execute(array(
                    $data->name,
                    $data->email,
                    $data->hashedPassword,
                    $data->rol = 'usr'
                ));
                return $result;
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            return false;
        }
    }


    public function VerificarExistenciaEmail(Model $data)
    {
        try {
            $sql = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$data->email]);
            $count = $stmt->fetchColumn();
            return $count > 0;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
