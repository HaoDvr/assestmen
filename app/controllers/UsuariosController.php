<?php

class UsuariosController
{
    /*-- --------------------------
    * Mostrar datos en la pantalla
    -------------------------------*/
    public function index()
    {
        // Aquí definimos los parámetros para el diseño dashboard
        $config = [
            "titulo" => "Usuarios",
            "breadcrumbActivo" => "Usuarios",
            "load_datatables" => true // Le avisamos al footer que cargue los scripts
        ];

        return $config;
    }

    /*-- --------------------------
    * MOSTRAR LOS USUARIOS
    * $item: nombre de la columna (ej: correo_usuario)
    * $valor: el valor a buscar (ej: vramirez@nttdata.com)
    -------------------------------*/
    static public function ctrMostrarUsuarios($item = null, $valor = null)
    {
        $tabla = "usuarios";

        // Pasamos los parámetros al modelo para que decida si busca uno o todos
        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

        return $respuesta;
    }

    /*-- --------------------------
    * AGREGAR USUARIO
    -------------------------------*/
    static public function ctrCrearUsuario()
    {
        if (isset($_POST["nuevoNombre"])) {

            // 1. Validamos solo los campos de texto
            $soloTexto = $_POST["nuevoNombre"] . $_POST["nuevoApellidoP"] . $_POST["nuevoApellidoM"] . $_POST["nuevaArea"];

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $soloTexto)) {

                // 2. Validación específica para el Correo (Estándar Senior)
                if (!filter_var($_POST["nuevoCorreo"], FILTER_VALIDATE_EMAIL)) {
                    return "error_correo";
                }

                $tabla = "usuarios";
                $encrypt = password_hash($_POST["nuevaContrasena"], PASSWORD_DEFAULT);

                $datos = array(
                    "nombre"     => $_POST["nuevoNombre"],
                    "apellido_p" => $_POST["nuevoApellidoP"],
                    "apellido_m" => $_POST["nuevoApellidoM"],
                    "area"       => $_POST["nuevaArea"],
                    "correo"     => $_POST["nuevoCorreo"],
                    "perfil"     => $_POST["nuevoPerfil"],
                    "password"   => $encrypt
                );

                $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
                return $respuesta;
            } else {
                return "error_formato";
            }
        }
    }

    /*-- --------------------------
    * BORRAR USUARIO
    -------------------------------*/
    static public function ctrEliminarUsuario($id)
    {
        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::mdlEliminarUsuario($tabla, $id);
        return $respuesta;
    }

    /*-- --------------------------
    * INGRESO USUARIO
    -------------------------------*/
    public function ctrIngresoUsuario()
    {
        if (isset($_POST["ingUsuario"])) {

            // 1. Validamos formato de correo
            if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingUsuario"])) {

                $tabla = "usuarios";
                $item = "correo_usuario"; // Ajustado a tu BD
                $valor = $_POST["ingUsuario"];

                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

                // 2. Verificamos si existe el usuario y comparamos el password encriptado
                if (
                    is_array($respuesta) &&
                    $respuesta["correo_usuario"] == $_POST["ingUsuario"] &&
                    password_verify($_POST["ingPassword"], $respuesta["password"])
                ) { // Usamos password_verify

                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION["id"] = $respuesta["id_usuarios"];
                    $_SESSION["perfil"] = $respuesta["perfil_usuario"];

                    // Concatenación que pediste
                    $_SESSION["nombre"] = $respuesta["nombre_usuario"] . " " . $respuesta["apellido_paterno_usuario"] . " " . $respuesta["apellido_materno_usuario"];

                    echo '<script>
                    window.location = "inicio";
                </script>';
                } else {
                    echo '<br><div class="alert alert-danger">El usuario y/o contraseña son incorrectos</div>';
                }
            }
        }
    }

    /*-- --------------------------
    * EDITAR USUARIO
    -------------------------------*/
    public function ctrEditarUsuario()
    {
        if (isset($_POST["editarNombre"])) {

            $tabla = "usuarios";

            /*=============================================
            LÓGICA PARA LA CONTRASEÑA
            =============================================*/
            if ($_POST["editarContrasena"] != "") {
                $encriptar = password_hash($_POST["editarContrasena"], PASSWORD_DEFAULT);
            } else {
                $encriptar = $_POST["passwordActual"];
            }

            $datos = array(
                "id_usuarios" => $_POST["idUsuario"],
                "nombre_usuario" => $_POST["editarNombre"],
                "apellido_paterno_usuario" => $_POST["editarApellidoP"],
                "apellido_materno_usuario" => $_POST["editarApellidoM"],
                "area_usuario" => $_POST["editarArea"],
                "correo_usuario" => $_POST["editarCorreo"],
                "perfil_usuario" => $_POST["editarPerfil"],
                "password" => $encriptar
            );

            $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                // Esperamos a que el documento esté listo para asegurar que Swal exista
                document.addEventListener("DOMContentLoaded", function() {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });

                    Toast.fire({
                        icon: "success",
                        title: "¡Usuario actualizado con éxito!"
                    }).then(function(){
                        // Solo refrescamos después de que el usuario vea el mensaje
                        window.location = "usuarios";
                    });
                });
            </script>';
            }
        }
    }
}
