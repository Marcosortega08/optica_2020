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
    <title>Gestión Clientes</title>
</head>

<body>
    <?php if (isset($_SESSION['user'])) { ?>
        <div class="container">
            <div class="row">
                <nav class="purple darken-3">
                    <div class="nav-wrapper">
                        <a href="clientes.php" class="brand-logo"><?= $_SESSION['user']['rol'] ?>: <?= $_SESSION['user']['nombre'] ?></a>
                        <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                        <ul id="nav-mobile" class="right hide-on-med-and-down">
                            <li><a href="creadores.php">Creadores</a></li>
                            <li class="active"><a href="clientes.php">Crear Cliente</a></li>
                            <li><a href="buscarReceta.php">Buscar Receta</a></li>
                            <li><a href="ingreso.php">Ingreso</a></li>
                            <li><a href="salir.php"><i class="material-icons white-text small ">exit_to_app</i></a></li>
                        </ul>
                    </div>
                </nav>
               
                <ul id="slide-out" class="sidenav purple accent-2">
                    <li>
                        <div class="user-view">
                            <a href="gestion.php"><img class="circle" src="../img/perfil.jpg"></a>
                            <a href="gestion.php" class="brand-logo black-text"><?= $_SESSION['user']['nombre'] ?></a>
                        </div>
                   
                </li>
                    <li class="active"><a class="black-text" href="clientes.php">Crear Cliente<i class="material-icons yellow-text small ">group_add</i></a></li>
                    <li><a class="black-text" href="buscarReceta.php">Buscar Receta<i class="material-icons yellow-text small ">search</i></a></li>
                    <li><a class="black-text" href="ingreso.php">Ingreso de Receta<i class="material-icons yellow-text small ">mode_edit</i></a></li>
                    <li><a class="black-text" href="salir.php">Salir<i class="material-icons yellow-text small ">reply</i></a></li>
                </ul>


                <div class="col l2 m4 s12"></div>
                <div class="col l8 m4 s12">
                    <div class="card">
                        <div class="card-action">
                            <h6 class="purple-text">Nuevo Cliente</h6>
                            <form action="../controllers/ClienteController.php" method="POST">
                                <p class="green-text">
                                    <?php
                                    if (isset($_SESSION['respuestaCli'])) {
                                        echo $_SESSION['respuestaCli'];
                                        unset($_SESSION['respuestaCli']);
                                    } else
                                    ?>
                                </p>
                                <p class="red-text">
                                    <?php
                                if (isset($_SESSION['errorCli'])) {
                                    echo $_SESSION['errorCli'];
                                    unset($_SESSION['errorCli']);
                                }
                                    ?>
                                 </p>
                                <div class="input-field col l4">
                                    <i class="material-icons cl-black prefix">account_box</i>
                                    <input id="clirut" type="text" name="clirut">
                                    <label for="clirut">Rut</label>
                                </div>
                                <div class="input-field col l8">
                                    <i class="material-icons cl-black prefix">person_pin</i>
                                    <input id="cliname" type="text" name="cliname">
                                    <label for="cliname">Nombre</label>
                                </div>
                                <div class="input-field col l12">
                                    <i class="material-icons cl-black prefix">location_on</i>
                                    <input id="clidir" type="text" name="clidir">
                                    <label for="clidir">Dirección</label>
                                </div>
                                <div class="input-field col l6">
                                    <i class="material-icons cl-black prefix">call</i>
                                    <input id="clifono" type="number" name="clifono">
                                    <label for="clifono">Teléfono o Celular</label>
                                </div>
                                <div class="input-field col l6">
                                    <i class="material-icons cl-black prefix">insert_invitation</i>
                                    <input id="icon_prefix" type="text" class="validate datepicker" name="clifecha">
                                    <label for="icon_prefix">Fecha de creación</label>
                                </div>
                                <div class="input-field col l12">
                                    <i class="material-icons cl-black prefix">local_post_office</i>
                                    <input id="cliemail" type="email" name="cliemail">
                                    <label for="cliemail">Correo Eléctronico</label>
                                </div>
                                <button class="btn purple ancho-100 redondo">Crear Nuevo Cliente</button>
                            </form>
                            <p class="red-text">
                                <?php
                                if (isset($_SESSION['respuesta'])) {
                                    echo $_SESSION['respuesta'];
                                    unset($_SESSION['respuesta']);
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } else {
        header("Location: ../index.php") ?>

    <?php } ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.datepicker');
            var instances = M.Datepicker.init(elems, {
                'autoClose': true,
                'format': 'yyyy/mm/dd',
                i18n: {
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