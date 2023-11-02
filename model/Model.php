<?php
session_start();

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

    public function LoginModel(Model $data)
    {
        try {
            $sql = "SELECT email, pass FROM usuarios WHERE email = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$data->email]);
            $result = $stmt->fetch();

            return ($result && password_verify($data->password, $result['pass']));
        } catch (Exception $e) {
            session_destroy();
            die($e->getMessage());
        }
    }

    public function VerificarSesion(Model $data)
    {
        try {
            $sql = "SELECT id FROM usuarios WHERE email = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$data->email]);
            $result = $stmt->fetch();

            if ($result) {
                $sesiones_activas = isset($_SESSION['sesiones_activas']) ? $_SESSION['sesiones_activas'] : [];

                if (in_array($result['id'], $sesiones_activas)) {
                    return false;
                } else {
                    $sesiones_activas[] = $result['id'];
                    $_SESSION['sesiones_activas'] = $sesiones_activas;

                    return true;
                }
            } else {
                return false;
            }
        } catch (Exception $e) {
            session_destroy();
            die($e->getMessage());
        }
    }

    // public function GetComputersModel()
    // {
    //     try {
    //         $sql = "SELECT * FROM computadoras";
    //         $stmt = $this->pdo->prepare($sql);
    //         $stmt->execute();
    //         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //         return $result;
    //     } catch (Exception $e) {
    //         session_destroy();
    //         die($e->getMessage());
    //     }
    // }

    public function GetComputersModel($selectedSalonId) {
        try {
            $sql = "SELECT * FROM computadoras WHERE id_salon = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$selectedSalonId]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            session_destroy();
            die($e->getMessage());
        }
    }
    

    public function GetSalonesModel()
    {
        try {
            $sql = "SELECT * FROM salones";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            session_destroy();
            die($e->getMessage());
        }
    }
}
