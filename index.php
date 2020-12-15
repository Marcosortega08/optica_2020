<?php
use models\UsuarioModel as UsuarioModel;
session_start();
require_once("models/UsuarioModel.php");
if (isset($_SESSION['usuario'])) {
    $model = new UsuarioModel();
    $usuario = $model->getAllUsuarios();

    print_r($usuario);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Optica</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col l4 m4 s12">

            </div>
            <div class="col l4 m4 s12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-image">
                            <img src="img/login.jpg">
                        </div>
                        <h5 class="center purple-text accent-2">Vendedor</h5>
                    </div>
                    <div class="card-action">
                        <form action="controllers/LoginController.php" method="POST">
                            <p class="red-text">
                                <?php
                                if (isset($_SESSION['error'])) {
                                    echo $_SESSION['error'];
                                    unset($_SESSION['error']);
                                }
                                ?>
                            </p>
                            <div class="input-field">
                                <input id="rut" type="text" name="rut">
                                <label for="rut">Rut De Vendedor</label>
                            </div>
                            <div class="input-field">
                                <input id="clave" type="password" name="clave">
                                <label for="clave">Clave De Acceso</label>
                            </div>

                            <button class="btn purple ancho-100 redondo">Entrar</button>
                            <p>
                                <a href="admin.php" class="purple-text">Administrador</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>

</html>