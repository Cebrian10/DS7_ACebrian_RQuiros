<?php
require_once('model/Model.php');
class Controller
{
    private $model;
    public function __CONSTRUCT()
    {
        $this->model = new Model();
    }
    public function Home()
    {
        require('view/home.php');
    }
    public function Login()
    {
        require('view/login.php');
    }
    public function Profile()
    {
        require('view/profile.php');
    }

    public function Register()
    {
        require('view/register.php');
    }

    public function RegisterController()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['pass'])) {
            } else {
                $usuario = new Model();

                $usuario->name = $_REQUEST['name'];
                $usuario->email = $_REQUEST['email'];
                $usuario->pass = $_REQUEST['pass'];
                $usuario->hashedPassword = password_hash($usuario->pass, PASSWORD_DEFAULT);

                $result = $this->model->RegisterModel($usuario);
                if ($result === true) {
                    header('Location: ?op=login&msg=Registro Exitoso');
                } else {
                    header('Location: ?op=register&msg=Error al registrar... El correo ya está registrado');
                }
            }
        }
    }

    public function LoginController()
    {
        $usuario = new Model();

        $usuario->email = $_REQUEST['email'];
        $usuario->pass = $_REQUEST['pass'];

        if ($this->model->LoginModel($usuario)) {
            // if ($this->model->VerificarSesion($usuario)) {
            //     // $this->model->ObtenerDatosUsuario($usuario); 
            header('Location: ?op=home&msg=Bienvenido');
            // } else {
            //     header('Location: ?op=login&msg=Error... Sesión Existente');
            // }
        } else {
            header('Location: ?op=login&msg=Error... Credenciales Inválidas');
        }
    }

    // public function GetComputersController(){
    //     return $this->model->GetComputersModel();
    // }

    public function GetComputersController($selectedSalonId)
    {
        return $this->model->GetComputersModel($selectedSalonId);
    }


    public function GetSalonesController()
    {
        return $this->model->GetSalonesModel();
    }

    public function Logout()
    {
        $usuario = new Model();
        $usuario->email = $_SESSION['user_email'];

        if (isset($_SESSION['sesiones_activas'])) {
            $sesiones_activas = $_SESSION['sesiones_activas'];
            $user_id = array_search($usuario->email, $sesiones_activas);

            if ($user_id !== false) {
                unset($sesiones_activas[$user_id]);
                $_SESSION['sesiones_activas'] = $sesiones_activas;
            }
        }
        session_destroy();
        header('Location: ?op=home');
    }
}
