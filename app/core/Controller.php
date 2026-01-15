<?php
class Controller
{
    public function view($view, $data = [])
    {
        // Extrae el array para usar variables como $titulo o $usuario
        extract($data);

        // Definimos la ruta completa partiendo desde la carpeta app
        $archivo = '../app/views/' . $view . '.php';

        if (file_exists($archivo)) {
            require_once $archivo;
        } else {
            // Este mensaje es para que tú veas la ruta real en el navegador si falla
            die("Error Fatal: No se encontró el archivo de vista en: " . realpath('../app/views/') . DIRECTORY_SEPARATOR . $view . '.php');
        }
    }
}
