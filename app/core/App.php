<?php
class App
{
    protected $controlador = 'CtrDashboard';
    protected $metodo = 'index';
    protected $parametros = [];

    // Lista blanca estricta
    protected $rutas_permitidas = [
        'dashboard',
    ];

    public function __construct()
    {
        $url = $this->parseUrl();

        // Si hay algo en la URL (ej: localhost/assestmen/usuarios)
        if (isset($url[0]) && !empty($url[0])) {
            $rutaPedida = strtolower($url[0]);

            // 1. Validar contra Lista Blanca
            if (in_array($rutaPedida, $this->rutas_permitidas)) {

                $nombreControlador = 'Ctr' . ucfirst($rutaPedida);

                if (file_exists('../app/controllers/' . $nombreControlador . '.php')) {
                    $this->controlador = $nombreControlador;
                    unset($url[0]);
                } else {
                    $this->error404("El archivo del controlador no existe físicamente.");
                }
            } else {
                // Si la palabra no está en el array, mandamos al 404
                $this->error404("Ruta no autorizada en la lista blanca.");
            }
        }

        // 2. Carga del archivo validado o el por defecto
        require_once '../app/controllers/' . $this->controlador . '.php';
        $this->controlador = new $this->controlador;

        // 3. Verificar el método
        if (isset($url[1])) {
            if (method_exists($this->controlador, $url[1])) {
                $this->metodo = $url[1];
                unset($url[1]);
            }
        }

        $this->parametros = $url ? array_values($url) : [];
        call_user_func_array([$this->controlador, $this->metodo], $this->parametros);
    }

    // Método para mostrar la vista de error profesional
    private function error404($mensaje = "")
    {
        http_response_code(404);

        // Datos mínimos para que el Header no falle al buscar variables
        $data = ['titulo' => 'Error 404', 'usuario' => 'Invitado'];
        extract($data);

        // Cargamos la estructura de vistas (Asegúrate que los archivos existan)
        if (file_exists('../app/views/errores/404.php')) {
            require_once '../app/views/layout/Header.php';
            require_once '../app/views/errores/404.php';
            require_once '../app/views/layout/Footer.php';
        } else {
            // Fallback por si aún no creas la carpeta de errores
            echo "<h1>404 Not Found</h1><p>$mensaje</p>";
        }

        die();
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
