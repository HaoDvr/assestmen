<?php
class PreguntasControlador
{
    static public function ctrMostrarPreguntas($idUsuario)
    {
        $tabla = "preguntas_final";
        // Aquí podrías filtrar por usuario en el futuro si agregas una tabla de asignación
        $respuesta = ModeloMostrarPreguntas::mdlMostrarPreguntas($tabla, $idUsuario);
        return $respuesta;
    }
}
