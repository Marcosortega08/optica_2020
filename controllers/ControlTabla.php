<?php

namespace controllers;

use models\UsuarioModel as UsuarioModel;

session_start();

require_once("../models/UsuarioModel.php");

class ControlTabla
{
    public $bt_edit;

    public function __construct()
    {
        $modelo = new UsuarioModel;
        $this->bt_edit = $_POST['bt_edit'];

        if(isset($this->bt_edit)){
            
            $_SESSION['editar'] = "ON";
            $usuario = $modelo->buscarUsuario($this->bt_edit);
            $_SESSION['usuario'] = $usuario[0];
            
            header("Location: ../views/gestion.php");
            
        }
        
    }
    public function procesar()
    {

    }
}
$obj = new ControlTabla();
$obj->procesar();