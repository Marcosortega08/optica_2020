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
    <title>Gestión De Usuarios</title>
</head>

<body>
    <?php if (isset($_SESSION['user'])) { ?>
        <div class="container">
            <div class="row">
                <nav class="purple darken-3">
                    <div class="nav-wrapper">
                    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>    
                    <a href="gestion.php" class="brand-logo">Bienvenido <?= $_SESSION['user']['nombre'] ?></a>
                        <ul id="nav-mobile" class="right hide-on-med-and-down">
                            <li class="active"><a href="gestion.php">Gestión De Usuarios</a></li>
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
                    <li class="active"><a class="black-text" href="gestion.php">Gestión de Usuarios<i class="material-icons yellow-text small ">account_box</i></a></li>
                    <li><a class="black-text" href="salir.php">Salir<i class="material-icons yellow-text small ">reply</i></a></li>
                </ul>

                <div class="col l4 m4 s12">
                    <?php if (isset($_SESSION['editar'])) { ?>
                        <div class="card">
                            <div class="card-content">
                                <i class="material-icons cl-black medium ">account_box</i>
                                <h4 class="center purple-text accent-2">Editar Usuario</h4>
                                <form action="../controllers/ControlEdit.php" method="POST">
                                    <div class="input-field">
                                        <input id="rut" type="text" name="rut" value="<?= $_SESSION['usuario']['rut'] ?>">
                                        <label for="rut">Rut Usuario</label>
                                    </div>
                                    <div class="input-field">
                                        <input id="nombre" type="text" name="nombre" value="<?= $_SESSION['usuario']['nombre'] ?>">
                                        <label for="nombre">Nombre Usuario</label>
                                    </div>
                                    
                                    <div class="input-field col s12">
                                        <select name="estado" id="estado">
                                            <option value="1">Habilitado</option>
                                            <option value="0">Bloqueado</option>
                                        </select>
                                        <label>Estado del Vendedor</label>
                                    </div>
                                    <button class="btn purple ancho-100 redondo">Editar Usuario</button>
                                </form>
                            </div>
                        </div>
                    <?php
                        unset($_SESSION['editar']);
                        unset($_SESSION['usuario']);
                    } else {
                    ?>
                        <div class="card">
                            <div class="card-content">
                                <i class="material-icons cl-black medium ">account_box</i>
                                <h5 class="center purple-text accent-2">Nuevo Vendedor</h5>
                            </div>
                            <div class="card-action">
                                <form action="../controllers/ControlInsert.php" method="POST">
                                    <div class="input-field">
                                        <input id="rut" type="text" name="rut">
                                        <label for="rut">Rut Vendedor</label>
                                    </div>
                                    <div class="input-field">
                                        <input id="nombre" type="text" name="nombre">
                                        <label for="nombre">Nombre Vendedor</label>
                                    </div>
                                
                                    <input type="hidden" name="rol" value="vendedor">
                                    <input type="hidden" name="clave" value="123">
                                    <input type="hidden" name="estado" value="1">
                                    <button class="btn purple ancho-100 redondo">Crear Vendedor</button>
                                </form>
                                <p class="purple-text">
                                    <?php
                                    if (isset($_SESSION['respuesta'])) {
                                        echo $_SESSION['respuesta'];
                                        unset($_SESSION['respuesta']);
                                    } else
                                    ?>
                                </p>
                                <p class="red-text">
                                    <?php
                                if (isset($_SESSION['error'])) {
                                    echo $_SESSION['error'];
                                    unset($_SESSION['error']);
                                }
                                    ?>
                                </p>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="col l8 m8 s12">
                    <div class="card">
                        <div class="card-content">
                            <h4 class="center purple-text accent-2">Lista De Vendedores</h4>
                            <form action="../controllers/ControlTabla.php" method="POST">
                                <table class="black-text accent-2">
                                    <tr>
                                        <th>Rut</th>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                        <th>Acción</th>
                                    </tr>
                                    <?php foreach ($usuario as $item) { ?>
                                        <tr>
                                            <td> <?= htmlspecialchars($item["rut"]) ?> </td>
                                            <td> <?= htmlspecialchars($item["nombre"]) ?> </td>
                                            <?php if ($item['estado'] == 1) { ?>
                                                <td class="blue-text"> <?=  $item['estado'] = "Habilitado"; ?> </td>
                                            <?php } else { ?>
                                                <td class="red-text"> <?= $item['estado'] = "Bloqueado"; ?> </td>
                                            <?php } ?>
                                            <td>
                                                <button name="bt_edit" value="<?= $item["rut"] ?>" class="btn-floating purple">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { header("Location: ../index.php")?>
    <?php } ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);
        });
    </script>

</body>

</html>