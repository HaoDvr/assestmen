<?php
// ajax/respuestas.ajax.php

require_once "../controllers/RespuestasController.php";
require_once "../models/RespuestasModel.php";

class AjaxRespuestas
{
    public $datos;

    public function ajaxGuardarEncuesta()
    {
        $respuesta = RespuestasControlador::ctrGuardarEncuesta($this->datos);
        echo $respuesta; // Esto imprime "ok" o "error"
    }
}

if (isset($_POST["id_usuario"])) {
    $guarda = new AjaxRespuestas();
    $guarda->datos = $_POST;
    $guarda->ajaxGuardarEncuesta();
}
