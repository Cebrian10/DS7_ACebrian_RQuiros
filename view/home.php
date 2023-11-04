<?php
$controller = new Controller();
$salones = $controller->GetSalonesController();
$equipos = $controller->GetComputersController();

$equiposPorLinea = 5;
$totalEquipos = count($equipos);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="public/img/utp-icon.png">
    <title>Reserva de Equipo</title>
    <link rel="stylesheet" href="public/css/home.css">
</head>

<body>

    <nav>
        <div class="img-label">
            <img src="public/img/utp-icon.png" alt="utp">
            <a href="?op=profile">
                <label>
                    <?php
                    if (isset($_SESSION['user_name'])) {
                        echo $_SESSION['user_name'];
                    } else {
                        echo 'Visitante';
                    }
                    ?>
                </label>

            </a>
        </div>
        <div class="botones">
            <a href="?op=register"><button type="button">Registrarse</button></a>
            <a href="?op=login"><button type="button">Iniciar Sesion</button></a>
            <a href="?op=logout"><button type="button">Cerrar Sesion</button></a>
        </div>

    </nav>

    <div class="titulo">
        <h1>Reserva de Computadoras</h1>
    </div>

    <section class="section-principal">
        <section class="section-1">
            <div class="selec-salon">
                <label>Seleccionar salón</label>
                <select name="select" id="salonSelect">
                    <?php
                    foreach ($salones as $salon) {
                        echo '<option value="' . $salon['id'] . '">' . $salon['name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </section>

        <section class="section-2">
            <?php
            echo '<div class="equipos">';
            for ($i = 0; $i < $totalEquipos; $i += $equiposPorLinea) {
                echo '<div class="linea linea' . ($i / $equiposPorLinea + 1) . '">';
                for ($j = $i; $j < min($i + $equiposPorLinea, $totalEquipos); $j++) {
                    $equipo = $equipos[$j];
                    echo '<a href="?op=reserve">';
                    echo '<div class="eq eq' . $equipo['id'] . '" data-salon-id="' . $equipo['id_salon'] . '">';
                    echo '<img src="public/img/pc.png" alt="pc' . $equipo['id'] . '">';
                    echo '<label>' . $equipo['name'] . '</label>';
                    echo '<p>' . $equipo['status'] . '</p>';
                    echo '</div>';
                    echo '</a>';
                }
                echo '</div>';
            }
            echo '</div>';
            ?>
        </section>
    </section>
    <script src="public/js/home.js"></script>
</body>

</html>