<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/reserva.css">
    <title>Reserva</title>
</head>
<body>
    <div class="flotante">
        <a href="javascript:history.back();">
            <img src="public/img/atras.png" alt="atras">
            <button>Volver</button>
        </a>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $equipo_id = $_POST['equipo_id']; //Obtiene el ID del equipo
        $controller = new Controller();
        $equipo = $controller->GetComputerById($equipo_id); //optiene la informacion del equipo

        if ($equipo) {
            //cuando se elige el equipo mostrara el formulario
            echo '<h1>Reservar: ' . $equipo['name'] . '</h1>'; //aqui mostrara el nombre del equipo
            echo '<form action="?op=confirm_reserva" method="post">
                     <input type="hidden" name="equipo_id" value="' . $equipo_id . '">
                     <label for="day">Día:</label>
                     <input type="date" id="day" name="day" required><br>
                     <label for="start_time">Hora de inicio:</label>
                     <input type="time" id="start_time" name="start_time" required><br>
                     <label for="end_time">Hora de fin:</label>
                     <input type="time" id="end_time" name="end_time" required><br>
                     <button type="submit">Confirmar Reserva</button>
                  </form>';
        } else {
        }
    }
    ?>
</body>
</html>
