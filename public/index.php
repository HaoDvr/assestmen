<?php
// 1. Mostrar errores para debug (solo en desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Cargar el Corazón del MVC
// Importante: El orden importa. Primero el Controller base para que Dashboard pueda heredarlo.
require_once "../app/core/Controller.php";
require_once "../app/core/App.php";

// 3. Arrancar la Aplicación
$app = new App();
