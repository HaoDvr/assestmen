<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="inicio" class="brand-link d-flex align-items-center">
        <span class="brand-image img-circle elevation-3 bg-warning d-flex justify-content-center align-items-center"
            style="width: 33px; height: 33px; font-weight: bold; font-size: 18px; color: #343a40;">
            A
        </span>
        <span class="brand-text font-weight-light ml-2">Assess<b>ment</b></span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="public/assets/img/admin.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo ucwords($_SESSION["nombre"]); ?></a>
                <small class="text-muted">
                    <i class="fas fa-circle text-success" style="font-size: 8px;"></i>
                    Activo
                </small>
            </div>
        </div>

        <div class="form-inline mt-2">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Buscar en menú..." aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="usuarios" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Usuarios</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="salir" class="nav-link text-red font-weight-bold">
                        <i class="fa-regular fa-circle-xmark"></i>
                        <p>Cerrar Sesion</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
