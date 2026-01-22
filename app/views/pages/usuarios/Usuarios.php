<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-AddUsuario">
                            <i class="fa-solid fa-user-plus"></i> Agregar Usuario
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="tablaUsuarios" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre Copleto</th>
                                    <th>Correo</th>
                                    <th>Área</th>
                                    <th>Perfil</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $usuarios = UsuariosController::ctrMostrarUsuarios();
                                foreach ($usuarios as $key => $value): ?>

                                    <tr>
                                        <td style="width:10px;"><?php echo ($key + 1); ?></td>
                                        <td>
                                            <?php
                                            echo ucwords(strtolower($value["nombre_usuario"])) . ' ' .
                                                ucwords(strtolower($value["apellido_paterno_usuario"])) . ' ' .
                                                ucwords(strtolower($value["apellido_materno_usuario"]));
                                            ?>
                                        </td>
                                        <td><?php echo $value["correo_usuario"]; ?></td>
                                        <td><?php echo $value["area"]; ?></td>
                                        <td>
                                            <?php
                                            // Transformamos el valor de la BD a texto amigable
                                            if ($value["perfil_usuario"] == "admin") {
                                                echo '<span class="badge badge-primary">Administrador</span>';
                                            } else {
                                                echo '<span class="badge badge-secondary">Usuario</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <button type="button"
                                                    class="btn btn-outline-warning mr-2 btnEditarUsuario"
                                                    idUsuario="<?php echo $value["id_usuarios"]; ?>"
                                                    data-toggle="modal"
                                                    data-target="#modal-EditarUsuario">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-danger btnEliminarUsuario" idUsuario="<?php echo $value["id_usuarios"]; ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- --------------------------
* Modal Insertar Usuario
------------------------------->
<div class="modal fade" id="modal-AddUsuario" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="formAddUsuario">

                <div class="modal-header">
                    <h4 class="modal-title">Agregar Nuevo Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label for="nuevoNombre">Nombre</label>
                        <input type="text" class="form-control" name="nuevoNombre" placeholder="Nombre(s) completo(s)" required>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nuevoApellidoP">Apellido Paterno</label>
                                <input type="text" class="form-control" name="nuevoApellidoP" placeholder="Primer apellido" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nuevoApellidoM">Apellido Materno</label>
                                <input type="text" class="form-control" name="nuevoApellidoM" placeholder="Segundo apellido">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nuevaArea">Área</label>
                                <input type="text" class="form-control" name="nuevaArea" placeholder="Ej: Consultoría" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nuevoCorreo">Correo</label>
                                <input type="email" class="form-control" name="nuevoCorreo" placeholder="correo@nttdata.com" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Perfil</label>
                        <select class="form-control" name="nuevoPerfil" required>
                            <option value="" disabled selected>Selecciona un perfil</option>
                            <option value="admin">Administrador</option>
                            <option value="user">Usuario</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nuevaContrasena">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="nuevaContrasena" id="nuevaContrasena" placeholder="Contraseña segura" required>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" onclick="mostrarPassword()">
                                    <i class="fas fa-eye" id="iconoPassword"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-outline-primary">Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- --------------------------
* EDITAR USUARIO
------------------------------->

<div class="modal fade" id="modal-EditarUsuario" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="formEditarUsuario">

                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Editar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="idUsuario" id="idUsuario">
                    <input type="hidden" name="passwordActual" id="passwordActual">

                    <div class="form-group">
                        <label for="editarNombre">Nombre</label>
                        <input type="text" class="form-control" name="editarNombre" id="editarNombre" placeholder="Nombre(s) completo(s)" required>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="editarApellidoP">Apellido Paterno</label>
                                <input type="text" class="form-control" name="editarApellidoP" id="editarApellidoP" placeholder="Primer apellido" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="editarApellidoM">Apellido Materno</label>
                                <input type="text" class="form-control" name="editarApellidoM" id="editarApellidoM" placeholder="Segundo apellido">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="editarArea">Área</label>
                                <input type="text" class="form-control" name="editarArea" id="editarArea" placeholder="Ej: Consultoría" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="editarCorreo">Correo</label>
                                <input type="email" class="form-control" name="editarCorreo" id="editarCorreo" placeholder="correo@nttdata.com" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Perfil</label>
                        <select class="form-control" name="editarPerfil" id="editarPerfil" required>
                            <option value="admin">Administrador</option>
                            <option value="user">Usuario</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editarContrasena">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="editarContrasena" id="editarContrasena" placeholder="Dejar vacío si no desea cambiarla">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" onclick="mostrarPasswordEditar()">
                                    <i class="fas fa-eye" id="iconoPasswordEditar"></i>
                                </button>
                            </div>
                        </div>
                        <small class="text-muted">Si escribe una nueva, se actualizará automáticamente.</small>
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-outline-warning">Guardar Cambios</button>
                </div>

                <?php
                // Instancia del controlador para editar
                $editar = new UsuariosController();
                $editar->ctrEditarUsuario();
                ?>
            </form>
        </div>
    </div>
</div>
