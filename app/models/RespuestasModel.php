<?php

require_once "conexion.php";

class RespuestasModelo
{

    static public function mdlGuardarRespuesta($tabla, $datos)
    {

        // CAMBIO: Se cambió "id_usuarios" por "id_usuario"
        // y "id_preguntas_finales" por "id_pregunta" (revisa que coincidan con tu tabla)

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (token_respuesta, id_usuario, id_pregunta, pregunta_txt, id_respuesta_seleccionada, respuesta_seleccionada_txt, valor_respuesta, respuesta_libre_txt, respuesta_detallada_txt, nombre_usuario_txt) VALUES (:token, :id_u, :id_p, :p_txt, :id_r, :r_txt, :valor, :libre, :detallada, :nom_u)");

        $stmt->bindParam(":token",     $datos["token_respuesta"], PDO::PARAM_STR);
        $stmt->bindParam(":id_u",      $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":id_p",      $datos["id_pregunta"], PDO::PARAM_INT);
        $stmt->bindParam(":p_txt",     $datos["pregunta_txt"], PDO::PARAM_STR);
        $stmt->bindParam(":id_r",      $datos["id_respuesta_seleccionada"], PDO::PARAM_INT);
        $stmt->bindParam(":r_txt",     $datos["respuesta_seleccionada_txt"], PDO::PARAM_STR);
        $stmt->bindParam(":valor",     $datos["valor_respuesta"], PDO::PARAM_INT);
        $stmt->bindParam(":libre",     $datos["respuesta_libre_txt"], PDO::PARAM_STR);
        $stmt->bindParam(":detallada", $datos["respuesta_detallada_txt"], PDO::PARAM_STR);
        $stmt->bindParam(":nom_u",     $datos["nombre_usuario_txt"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }
}
