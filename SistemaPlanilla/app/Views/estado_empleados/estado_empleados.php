<?php if ($operacion == 'guardar') : ?>
    <?php if ($exito) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Estado Empleado Guardado!</h5>
            Se ha guardado el Estado Empleado con exito
        </div>
    <?php else : ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> ERROR AL GUARDAR ESTADO EMPLEADO!</h5>
            Ha ocurrido un problema al guardar Estado Empleado
            <?= \Config\Services::validation()->listErrors(); ?>
        </div>
    <?php endif ?>
<?php endif ?>
<?php if ($operacion == 'eliminar') : ?>
    <?php if ($exito) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Estado Empleado eliminado con exito</h5>
        </div>
    <?php else : ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> ERROR AL ELIMINAR ESTADO EMPLEADO!</h5>
        </div>
    <?php endif ?>
<?php endif ?>
<?php if ($operacion == 'buscar') : ?>
    <?php if ($exito) : ?>
        <div class="alert alert-primary alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> RESULTADOS DE BUSQUEDA: </h5>
        </div>
    <?php else : ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> ALGO HA SALIDO MAL EN LA BUSQUEDA!</h5>
        </div>
    <?php endif ?>
<?php endif ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><b>Estado Empleados</b></h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-4">
                        <button type="button" class="btn  btn-success col-8" data-toggle="modal" data-target="#estadoEmpleadosModal" onclick="limpiar()">Nuevo</button>
                    </div>
                    <div class="col-8">
                        <form class="mr-0 ml-auto" action="<?= $url_buscar ?>" method="post">
                            <div class="input-group input-group-md">
                                <input name="termino" class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <table id="" class="table table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Afecta Planilla?</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($estado_empleados as $index => $estado) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $estado['NOMBRE_ESTADO'] ?></td>
                                <?php if($estado['AFECTA_CALCULO'] == 1): ?>
                                    <td align="center"><b class="badge-pill badge-success h5">SI</b></td>
                                <?php else:?>
                                    <td align="center"><b class="badge-pill badge-dark h5">NO</b></td>
                                <?php endif?>
                                <td class="row d-flex justify-content-around">
                                    <form action="<?= $url_eliminar ?>" method="post" class=" col-5">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="ID_ESTADO" value="<?= $estado['ID_ESTADO'] ?>">
                                        <button class="btn btn-danger  btn-block">Eliminar</button>
                                    </form>
                                    <button class="btn btn-primary col-5 btn-sm" 
                                    onclick="editar_estado(<?= $estado['ID_ESTADO'] ?>, 
                                    '<?= $estado['NOMBRE_ESTADO'] ?>', <?= $estado['AFECTA_CALCULO'] ?>)" data-toggle="modal" data-target="#estadoEmpleadosModal">Editar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Afecta Planilla?</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<!-- MODALES -->
<div class="modal" id="estadoEmpleadosModal" tabindex="-1" role="dialog" aria-labelledby="estadoEmpleadosModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="estadoEmpleadosModalLabel">Genero</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= $url_guardar ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="ID_ESTADO" id="ID_ESTADO">
                    <div class="form-group">
                        <label for="">Nombre de Género</label>
                        <input name="NOMBRE_ESTADO" id="NOMBRE_ESTADO" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" id="" placeholder="nombre de genero">
                        <div class="invalid-feedback" style="display:none">
                            El nombre no debe comenzar con números ni caracteres especiales
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Afecta Calculo en Planilla</label>
                        <select name="AFECTA_CALCULO" id="AFECTA_CALCULO" class="form-control">
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                        </select>
                    </div>
                    <button id="btn_submit" disabled type="submit" class="btn btn-success btn-block">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>