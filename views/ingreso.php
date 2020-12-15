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
            <div class="row" >
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
                
                <div id="nuevareceta">
                    <br>
                    <div class="col l1 m4 s12"></div>
                    <div class="col l10 m4 s12 white redondo">
                        <h5 class="purple-text center">Ingresar Receta</h5>
                        <br><br>
                        <div class="row" >
                            <div class="col l6">
                                <form @submit.prevent="buscar">
                                    <input type="text" class="col l6" placeholder="Rut" v-model="rut">
                                    <button class="btn purple redondo col l4">BUSCAR</button>
                                </form>
                            </div>
                            <div class="col l6 m12 s12">
                                <p>
                                    <ul v-if="esta == true" class="collection">
                                        <li class="collection-item">{{cliente.nombre_cliente}}</li>
                                        <li class="collection-item">{{cliente.direccion_cliente}}</li>
                                        <li class="collection-item">{{cliente.telefono_cliente}}</li>
                                        <li class="collection-item">{{cliente.email_cliente}}</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    
                        <br><br><br><br>
                        <hr>
                        <form @submit.prevent="crearR">
                            <div class="col l6 m6 s6 purple-text">
                            <span>TIPO  LENTE : </span>
                            <br><br>
                                <label>
                                    <input type="radio" id="lejos" value="lejos" v-model="tipo_lentes">
                                    <span>LEJOS</span>
                                </label>
                                <label>
                                    <input type="radio" id="cerca" value="cerca" v-model="tipo_lentes">
                                    <span>CERCA</span>
                                </label>
                                <br></br>

                        <div class="row" >
                            <div class="col l6">
                                <span> Seleccione Material </span>
                                <Select v-model="id_material_cristal" class="browser-default">
                                    <option v-for="m in materiales" :value="m.id_material_cristal">
                                        {{m.material_cristal}}
                                    </option>
                                </Select>
                                <span> Seleccione Tipo</span>
                                <Select v-model="id_tipo_cristal" class="browser-default">
                                    <option v-for="t in tipos" :value="t.id_tipo_cristal">
                                        {{t.tipo_cristal}}
                                    </option>
                                </Select>
                                <span> Seleccione Armazon </span>
                                <Select class="browser-default" v-model="id_armazon">
                                    <option v-for="a in armazones" :value="a.id_armazon">
                                        {{a.nombre_armazon}}
                                    </option>
                                </Select>
                            </div>
                        </div>
                            </div>
                            <div class="col l3 center purple-text">
                                <p>OJO IZQUIERDO</p>
                                <input type="text" placeholder="Esfera" v-model="esfeizq">
                                <input type="text" placeholder="Cilindro" v-model="cilizq">
                                <input type="text" placeholder="Eje" v-model="ejeizq">
                            </div>
                            <div class="col l3 center purple-text">
                                <p>OJO DERECHO</p>
                                <input type="text" placeholder="Esfera" v-model="esfeder">
                                <input type="text" placeholder="Cilindro" v-model="cilder">
                                <input type="text" placeholder="Eje" v-model="ejeder">
                            </div>
                            <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                            <hr>
                            <div class="col l6">
                                <div class="input-field">
                                    <input id="prisma" type="text" v-model="prisma">
                                    <label for="prisma">Prisma</label>
                                </div>
                            </div>
                            

                            <div class="col l6">
                            <h6 class="center purple-text accent-2">BASE</h6>
                            <select v-model="base_sel" class="browser-default">
                                <option value="" disabled selected hidden></option>
                                <option value="1">superior</option>
                                <option value="2">inferior</option>
                                <option value="3">interna</option>
                                <option value="4">externa</option>
                            </select>
                            </div>


                            <div class="col l6">
                                <div class="input-field">
                                    <input id="pupilar" type="text" v-model="pupilar">
                                    <label for="pupilar">Distancia Pupilar</label>
                                </div>
                            </div>
                            <div class="col l6">
                                <div class="input-field">
                                    <i class="material-icons cl-black prefix">insert_invitation</i>
                                    <input id="fechaentrega" type="text" class="validate datepicker" name="fechaentrega">
                                    <label for="fechaentrega">Fecha De Entrega</label>
                                </div>
                            </div>
                            <div class="col l6">
                                <div class="input-field">
                                    <i class="material-icons cl-black prefix">insert_invitation </i>
                                    <input id="fecharetiro" type="text" class="validate datepicker" name="fecharetiro">
                                    <label for="fecharetiro">Fecha Del Retiro</label>
                                </div>
                            </div>

                            <div class="col l4">
                                <div class="input-field">
                                    <input v-model="rutmed" type="text" name="rutmed">
                                    <label for="rutmed">Rut Del Medico</label>
                                </div>
                            </div>
                            <div class="col l8">
                                <div class="input-field">
                                    <input v-model="nombremed" type="text" name="nombremed">
                                    <label for="nombremed">Nombre Del Medico</label>
                                </div>
                            </div>
                            <div class="col l12">
                                <div class="input-field">
                                    <input v-model="obs" type="text" name="obs">
                                    <label for="obs">Observaciones</label>
                                </div>
                            </div>
                            <div class="col l4"></div>
                            <div class="col l4">
                                <div class="input-field">
                                    <input v-model="precio" type="number" name="precio">
                                    <label for="precio">Valor Del Lente</label>
                                </div>
                            </div>
                            <div class="col l4">
                                <div class="input-field">
                                    <button class="btn ancho-100 redondo purple">Crear Receta</button>
                                </div>
                            </div>
                        </form>
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