<?php

namespace controllers;


use models\RecetaModel as RecetaModel;

require_once("../models/RecetaModel.php");


class ControlCrearReceta{

    public $tipo_lente;
    public $esfera_oi;
    public $esfera_od;
    public $cilindro_oi;
    public $cilindro_od;
    public $eje_oi;
    public $eje_od;
    public $prisma;
    public $base;
    public $armazon;
    public $material_cristal;
    public $tipo_cristal;
    public $distancia_pupilar;
    public $valor_lente;
    public $fecha_entrega;
    public $fecha_retiro;
    public $observacion;
    public $rut_cliente;
    public $fecha_visita_medico;
    public $rut_medico;
    public $nombre_medico;
    public $rut_usuario;

    public function __construct()
    {
        $this->tipo_lente           = $_POST['tipo_lente'];
        $this->esfera_oi            = $_POST['esfera_oi'];
        $this->esfera_od            = $_POST['esfera_od'];
        $this->cilindro_oi          = $_POST['cilindro_oi'];
        $this->cilindro_od          = $_POST['cilindro_od'];
        $this->eje_oi               = $_POST['eje_oi'];
        $this->eje_od               = $_POST['eje_od'];
        $this->prisma               = $_POST['prisma'];
        $this->base                 = $_POST['base'];
        $this->armazon              = $_POST['armazon'];
        $this->material_cristal     = $_POST['material_cristal'];
        $this->tipo_cristal         = $_POST['tipo_cristal'];
        $this->distancia_pupilar    = $_POST['distancia_pupilar'];
        $this->valor_lente          = $_POST['valor_lente'];
        $this->fecha_entrega        = $_POST['fecha_entrega'];
        $this->fecha_retiro         = $_POST['fecha_retiro'];
        $this->observacion          = $_POST['observacion'];
        $this->rut_cliente          = $_POST['rut_cliente'];
        $this->rut_medico           = $_POST['rut_medico'];
        $this->nombre_medico        = $_POST['nombre_medico'];
    }

 public function nuevaReceta(){
    
    session_start();
    if (isset($_SESSION['user'])) {
        $usr = $_SESSION['user'];
        $x = $usr['rut'];
        $this->rut_usuario = $x;
        $this->fecha_visita_medico = date("Y/m/d");
        $model = new RecetaModel();
        $data =["tipolente"=>$this->tipo_lente,
                "esferaoiz"=>$this->esfera_oi,
                "esferaode"=>$this->esfera_od,
                "cilindrooiz"=>$this->cilindro_oi,
                "cilindroode"=>$this->cilindro_od,
                "ejeoiz"=>$this->eje_oi,
                "ejeode"=>$this->eje_od,
                "prisma"=>$this->prisma,
                "base"=>$this->base,
                "armazon"=>$this->armazon,
                "materialcristal"=>$this->material_cristal,
                "tipocristal"=>$this->tipo_cristal,
                "distanciapupilar"=>$this->distancia_pupilar,
                "valorlente"=>$this->valor_lente,
                "fechaentrega"=>$this->fecha_entrega,
                "fecharetiro"=>$this->fecha_retiro,
                "observacion"=>$this->observacion,
                "rutcliente"=>$this->rut_cliente,
                "fechavimed"=>$this->fecha_visita_medico,
                "rutmedico"=>$this->rut_medico,
                "nombremedico"=>$this->nombre_medico,
                "rutusuario"=>$this->rut_usuario];

        //aqui empiezan las validacions
        if ($this->rut_cliente == ""){
            $mensaje = ["msg"=>"ingrese un rut valido"];
            echo json_encode($mensaje);
            return;
        }

        if ($this->tipo_lente == "" || $this->tipo_cristal == "" || $this->material_cristal == "" || $this->armazon == "" || $this->distancia_pupilar == "" 
        || $this->esfera_oi == "" || $this->esfera_od == "" || $this->cilindro_oi == "" || $this->cilindro_od == "" || $this->eje_oi == ""
         || $this->eje_od == "" || $this->rut_medico == "" || $this->nombre_medico == "" || $this->fecha_entrega =="" || $this->fecha_retiro == "" || $this->valor_lente == "") {

            $mensaje = ["msg"=>"complete los campos obligatorios"];

            
            echo json_encode($mensaje);
        } else {
            
            if ($this->prisma != "") {
                if (is_numeric($this->prisma)) {
                    if ($this->prisma < 1 || $this->prisma > 5 ) {
                        $mensaje["msg2"] = "el valor del prisma debe ser entre 1 y 5";   
                    }
                } else {                
                    $mensaje["msg2"] = "el valor del prisma debe ser numerico";
                }
            } else {
                $this->base = "";
            }
            
            if (is_numeric($this->distancia_pupilar)) {
                if ($this->distancia_pupilar < 40 || $this->distancia_pupilar > 75){
                    $mensaje["msg3"] ="la distancia pupilar debe ser entre 40 y 75";
                }
            }
             else {
                $mensaje["msg3"] ="la distancia pupilar debe ser numerica";
            }

            if (is_numeric($this->esfera_oi)) {
                if ($this->esfera_oi < -99 || $this->esfera_oi > 99){
                    array_push($mensaje, "msg4", "la dificultad visual (esfera isquierda) debe tener maximo 2 digitos");
                }
            } else {
                $mensaje["msg4"] ="el valor de la esfera isquierda debe ser numerico";
            } 

            if (is_numeric($this->esfera_od)) {
                if ($this->esfera_od < -99 || $this->esfera_od > 99){
                    $mensaje["msg5"] ="la dificultad visual (esfera derecha) debe tener maximo 2 digitos";
                }            
            } else {
                $mensaje["msg5"] ="el valor de la esfera derecha debe ser numerico";
            }

            if (is_numeric($this->cilindro_oi)) {
                if ($this->cilindro_oi < -99 || $this->cilindro_oi > 99){
                    $mensaje["msg6"] ="el cilindro isquierdo debe tener maximo 2 digitos";
                }
            } else {
                $mensaje["msg6"] ="el valor del cilindro isquierdo debe ser numerico";
            }

            if (is_numeric($this->cilindro_od)) {
                if ($this->cilindro_od < -99 || $this->cilindro_od > 99){
                    $mensaje["msg7"] ="el cilindro derecho debe tener maximo 2 digitos";
                }
            } else {
                $mensaje["ms7"] ="el valor del cilindro derecho debe ser numerico";
            }

            if (is_numeric($this->eje_od)) {
                if ($this->eje_od < 1|| $this->eje_od > 180){
                    $mensaje["msg8"] ="el angulo del eje derecho debe ser entre 1 y 180 grados";
                }               
            } else {
                $mensaje["msg8"] ="el angulo del eje derecho debe ser numerico";
            }

            if (is_numeric($this->eje_oi)) {
                if ($this->eje_oi < 1|| $this->eje_oi > 180){
                    $mensaje["msg3"] ="el angulo del eje isquierdo debe ser entre 1 y 180 grados";
                }               
            } else {
                $mensaje["msg9"] ="el angulo del eje isquierdo debe ser numerico";
            }

            if (is_numeric($this->valor_lente)) {
                if ($this->valor_lente < 0|| $this->valor_lente > 999999999){
                    $mensaje["msg10"] ="el valor maximo es de 999.999.999";
                }               
            } else {
                $mensaje["msg10"] ="el precio debe ser numerico";
            }

            if (strlen($this->observacion) > 1000 ){
                $mensaje["msg11"] ="observacion demasiado larga, maximo 1000 caracteres";
            }  




            if ((isset($mensaje))){
                echo json_encode($mensaje); 
                return;
            }

            $count = $model->insertarReceta($data);
            if ($count == 1) {
                $mensaje = ["msg"=>"receta creada"];
                echo json_encode($mensaje);
            } else {
                $mensaje = ["msg"=>"no se ha podido generar la receta"];
                echo json_encode($mensaje);
                
                
                
            }
        }
        } else {
            $mensaje = ["msg"=>"session no iniciada"];
            echo json_encode($mensaje);
        }

        



        
    }

}
$obj = new ControlCrearReceta();
$obj->nuevaReceta();