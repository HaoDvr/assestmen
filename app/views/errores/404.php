<?php require_once '../app/views/layout/Header.php'; ?>
<div class="page-body">
    <div class="container-xl d-flex flex-column justify-content-center">
        <div class="empty">
            <div class="empty-header">404</div>
            <p class="empty-title">Ups... Página no encontrada</p>
            <p class="empty-subtitle text-secondary">
                La ruta que intentas buscar no está en nuestra lista permitida.
            </p>
            <div class="empty-action">
                <a href="./dashboard" class="btn btn-primary">
                    Volver al Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
<?php require_once '../app/views/layout/Footer.php'; ?>