<?php

use models\UsuarioModel as UsuarioModel;

session_start();
require_once("../models/UsuarioModel.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_SESSION['user'])) {
    $model = new UsuarioModel();
    $usuario = $model->getAllUsuarios();
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>Ingresar Receta</title>
</head>

<body>
    <?php if (isset($_SESSION['user'])) { ?>
        <div class="container">
            <div class="row">
                <nav class="purple darken-3">
                    <div class="nav-wrapper">
                        <a href="ingreso.php" class="brand-logo"><?= $_SESSION['user']['rol'] ?>: <?= $_SESSION['user']['nombre'] ?></a>
                        <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                        <ul id="nav-mobile" class="right hide-on-med-and-down">
                            <li><a href="creadores.php">Creadores</a></li>
                            <li><a href="clientes.php">Crear Cliente</a></li>
                            <li><a href="buscarReceta.php">Buscar Receta</a></li>
                            <li class="active"><a href="ingreso.php">Ingreso</a></li>
                            <li><a href="salir.php"><i class="material-icons white-text small ">exit_to_app</i></a></li>
                        </ul>
                    </div>
                </nav>
                <ul id="slide-out" class="sidenav purple accent-2">
                    <li>
                        <div class="user-view">
                            <a href="ingreso.php"><img class="circle" src="../img/perfil.jpg"></a>
                            <a href="ingreso.php" class="brand-logo black-text"><?= $_SESSION['user']['nombre'] ?></a>
                        </div>
                    </li>
                    <li><a class="black-text" href="clientes.php">Crear Cliente<i class="material-icons yellow-text small ">group_add</i></a></li>
                    <li class="active"><a class="black-text" href="buscarReceta.php">Buscar Receta<i class="material-icons yellow-text small ">search</i></a></li>
                    <li><a class="black-text" href="ingreso.php">Ingreso de Receta<i class="material-icons yellow-text small ">mode_edit</i></a></li>
                    <li><a class="black-text" href="salir.php">Salir<i class="material-icons yellow-text small ">reply</i></a></li>
                </ul>
                <div class="col l12 m4 s12">
                    <div class="card" id="app">
                        <div class="card-content">
                            <h2 class="purple-text center">MARCOS ORTEGA</h2>
                            <h2 class="purple-text center">ANTONIO CANCINO</h2>
                        </div>
                    </div>
                </div>

            </div>
        <?php } else {
        header("Location: ../index.php") ?>
        <?php } ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
        <script src="../js/ingresoreceta.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var elems = document.querySelectorAll('select');
                var instances = M.FormSelect.init(elems);
                var elems = document.querySelectorAll('.datepicker');
                var instances = M.Datepicker.init(elems, {
                    'autoClose': true,
                    'format': 'yyyy/mm/dd',
                    'i18n': {
                        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
                        weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                        weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                        weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"],
                        cancel: 'Cancelar',
                        clear: 'Limpiar',
                        done: 'Aceptar'
                    }
                });
                var elems = document.querySelectorAll('.sidenav');
                var instances = M.Sidenav.init(elems);
            });
        </script>
</body>

</html>