<?php
// ajax/respuestas.ajax.php

require_once "../controller/RespuestasController.php";
require_once "../model/respuestas.model.php";

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
