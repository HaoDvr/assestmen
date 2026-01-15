<?php

/** @var Controller $this */
// Asegúrate de que el nombre de la clase coincida con el nombre del archivo
class CtrDashboard extends Controller
{

    public function index()
    {
        // Datos que le pasaremos a la vista
        $data = [
            'titulo' => 'Panel de Control - Assestmen',
            'usuario' => 'Vicente Manuel Ramirez Reyes' // Ejemplo de dato dinámico
        ];

        // Cargamos la vista que está en views/dashboard/inicio.php
        $this->view('dashboard/inicio', $data);
    }
}
