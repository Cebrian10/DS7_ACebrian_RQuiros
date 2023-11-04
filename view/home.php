<?php
$controller = new Controller();
$salones = $controller->GetSalonesController();
$id_salon = 2;
$equipos = $controller->GetComputersController($id_salon);

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
    <link rel="stylesheet" href="public/css/reloj.css">
</head>

<body>

    <nav>
        <div class="img-label">
            <img src="public/img/utp-icon.png" alt="utp">
            <a href="?op=profile"><label>Visitante</label></a>
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
             <div id="reloj">
                <span id="horas">00</span>:
                <span id="minutos">00</span>:
                <span id="segundos">00</span>
                </div>
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

        <!-- tuve que realizar unos cambios desde aqui para hacer pruebas pero sigue funcionando de la misma manera
            pase algunas de las funciones al home.js, nada del otro mundo-->
       <!--Tuve que realizar unos cambios para que funcionara bien lo del status-->
       <section class="section-2">
            <div class="equipos">
                <?php for ($i = 0; $i < $totalEquipos; $i += $equiposPorLinea) : ?>
                    <div class="linea linea<?= ($i / $equiposPorLinea + 1) ?>">
                        <?php for ($j = $i; $j < min($i + $equiposPorLinea, $totalEquipos); $j++) :
                            $equipo = $equipos[$j]; ?>
                                 <?php
                                // Agrega una clase basada en el estado
                                $statusClass = ($equipo['status'] == 'disponible') ? 'available' : 'occupied'; ?>
                                <div class="eq eq<?= $equipo['id'] ?> <?= $statusClass ?>">
                                <img id="equipo-<?= $equipo['id'] ?>" src="public/img/pc.png" alt="pc<?= $equipo['id'] ?>" style="cursor: pointer;">
                                <label><?= $equipo['name'] ?></label>
                                <p><?= $equipo['status'] ?></p>
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php endfor; ?>
            </div>
        </section>


        <script src="public/js/home.js"></script>
        <script src="public/js/reloj.js"></script>
    </body>

</html>
