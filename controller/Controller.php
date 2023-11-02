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
                $usuario->password = $_REQUEST['pass'];
                $usuario->hashedPassword = password_hash($usuario->password, PASSWORD_DEFAULT);

                $result = $this->model->RegisterModel($usuario);
                if ($result === true) {
                    header('Location: ?op=login&msg=Registro Exitoso');
                } else {
                    header('Location: ?op=register&msg=Error al registrar... El correo ya está registrado');
                }
            }
        }
    }

    public function Logout()
    {
    }
}
