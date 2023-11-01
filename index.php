<?php

require_once 'controller/Controller.php';

$controller = new Controller();

if (isset($_GET['op'])){
    $opcion = $_GET['op'];

    switch ($opcion){
        case "": ;
            break;
        default: $controller->Index();;
            break;
    }
}else {
    $controller->Index();
}

?>
