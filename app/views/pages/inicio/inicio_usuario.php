<?php
// Formateamos el nombre: primero todo a minúsculas y luego Capitalizamos cada palabra
$nombreFormateado = mb_convert_case(mb_strtolower($_SESSION["nombre"]), MB_CASE_TITLE, "UTF-8");
?>

<nav class="navbar navbar-expand-md navbar-light bg-light elevation-1" style="border-bottom: 1px solid #dee2e6;">
    <div class="container-fluid">
        <a href="inicio" class="navbar-brand d-flex align-items-center">
            <span class="img-circle elevation-2 bg-warning d-flex justify-content-center align-items-center"
                style="width: 33px; height: 33px; font-weight: bold; font-size: 18px; color: #343a40;">
                A
            </span>
            <span class="brand-text font-weight-normal ml-2" style="color: #495057;">Assess<b>ment</b></span>
        </a>

        <div class="ml-3 d-none d-sm-block">
            <img src="public/assets/img/att-logo.svg" alt="Logo Empresa" class="brand-image" style="max-height: 35px;">
        </div>

        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto mt-2 mt-md-0">

                <li class="nav-item mr-md-3 mb-2 mb-md-0">
                    <div class="text-md-right text-left" style="line-height: 1.2;">
                        <span class="d-block" style="font-size: 15px; color: #343a40; font-weight: 600;">
                            <?php echo $nombreFormateado; ?>
                        </span>
                        <small class="text-success">
                            <i class="fas fa-circle" style="font-size: 8px;"></i> Activo
                        </small>
                    </div>
                </li>

                <li class="nav-item border-top border-md-0 pt-2 pt-md-0">
                    <a class="nav-link text-danger d-flex align-items-center" href="salir" data-toggle="tooltip" data-placement="bottom" title="Cerrar Sesión">
                        <i class="fas fa-power-off fa-lg mr-2 mr-md-0"></i>
                        <span class="d-md-none" style="font-weight: 500;">Cerrar Sesión</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="content mt-4">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="text-muted">Bienvenido al sistema de evaluación</h2>
                <hr>
                <div class="alert alert-info elevation-2">
                    <h5><i class="icon fas fa-info"></i> Próximamente</h5>
                    Aquí se cargarán las preguntas asignadas a tu cuenta desde la base de datos.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Inicializar tooltips de Bootstrap
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
