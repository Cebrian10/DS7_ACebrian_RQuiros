<?php
require_once('model/Model.php');

class Controller
{
    private $model;

    public function __construct()
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

    public function Reserva()
    {
        require('view/reserva.php');
    }

    public function RegisterController()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            if (!empty($name) && !empty($email) && !empty($pass)) {
                $usuario = new Model();
                $usuario->name = $name;
                $usuario->email = $email;
                $usuario->pass = $pass;
                $usuario->hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

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
            header('Location: ?op=home&msg=Bienvenido');
        } else {
            header('Location: ?op=login&msg=Error... Credenciales Inválidas');
        }
    }

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




    //A partir de aqui funciona la gestion de reservas

    //Obtiene la informacion de la computdora a traves de su ID
    public function GetComputerById($equipo_id)
    {
        return $this->model->GetComputerByIdModel($equipo_id);
    }


    //Marca la computadora elegida como "ocupada" en la base de datos
    public function ReservarEquipo($equipo_id)
    {
        try {
            $pdo = DB::StartUp();
            $sql = "UPDATE computadoras SET status = 'Ocupado' WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$equipo_id]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Procesa el formulario de confirmacion de reserva
    public function ConfirmarReserva()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $equipo_id = $_POST['equipo_id'];
            $day = $_POST['day'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];

            try {
                $pdo = DB::StartUp();
                $sql = "INSERT INTO reservas (day, start_time, end_time, id_usuarios) VALUES (?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$day, $start_time, $end_time, $_SESSION['user_id']]);

                $this->ReservarEquipo($equipo_id);

                header('Location: ?op=home');
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
    }
}
