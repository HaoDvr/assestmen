<?php

class  OpcionesRespuestaControlador
{

    static public function ctrMostrarOpcionesRespuesta()
    {

        $tabla = "opciones_respuestas";
        $respuesta = ModeloMostrarOpcionesRespuesta::mdlMostrarOpcionesRespuesta($tabla);
        return $respuesta;
    }
}
