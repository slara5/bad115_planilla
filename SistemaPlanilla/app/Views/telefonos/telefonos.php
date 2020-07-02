<?php if ($operacion == 'guardar') : ?>
    <?php if ($exito) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> <?= $nombre_obj?> Guardado!</h5>
            Se ha guardado el <?= $nombre_obj?> con exito
        </div>
    <?php else : ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> ERROR AL GUARDAR <?= strtoupper($nombre_obj)?>!</h5>
            Ha ocurrido un problema al guardar <?= $nombre_obj?>
            <?= \Config\Services::validation()->listErrors(); ?>
        </div>
    <?php endif ?>
<?php endif ?>
<?php if ($operacion == 'eliminar') : ?>
    <?php if ($exito) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> <?= $nombre_obj?> eliminado con exito</h5>
        </div>
    <?php else : ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> ERROR AL ELIMINAR <?= strtoupper($nombre_obj)?>!</h5>
        </div>
    <?php endif ?>
<?php endif ?>
<?php if ($operacion == 'buscar') : ?>
    <?php if ($exito) : ?>
        <div class="alert alert-primary alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> RESULTADOS DE BUSQUEDA: <?= strtoupper($termino) ?> </h5>
        </div>
    <?php else : ?>
        <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-exclamation-triangle"></i> NO SE ENCONTRARON COINCIDENCIAS</h5>
    </div>
    <?php endif ?>
<?php endif ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><b><?= $nombre_obj?></b></h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-4">
                        <button type="button" class="btn  btn-success col-8" data-toggle="modal" data-target="#telefonoModel" onclick="limpiar()">Nuevo</button>
                    </div>
                    <div class="col-8">
                        <form class="mr-0 ml-auto" action="<?= $url_buscar?>" method="post">
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
                <table id="" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Teléfono</th>
                            <th>Tipo</th>
                            <th>Empleado</th>
                            <th>Fecha de teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($telefonos as $index => $telefono) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $telefono['TELEFONO']?></td>
                                <td><?= $telefono['TIPO_TELEFONO']?></td>
                                <td><?= $empleadosModel->get_nombre_compleado($telefono['ID_EMPLEADO'])?></td>
                                <td><?= $telefono['DESDE_FECHA_TELEFONO']?></td>
                                <td class="row d-flex justify-content-around">
                                <button type="button" onclick="eliminar(<?= $telefono['ID_TELEFONO'] ?>)" class="btn btn-danger col-5" data-toggle="modal" data-target="#eliminarModal">
                                <i class="icon fas fa-trash"></i></button>
                                    <button class="btn btn-primary col-5 btn-sm" 
                                    onclick="editar_estado(
                                        <?= $telefono['ID_TELEFONO'] ?>, 
                                        <?= $telefono['ID_EMPLEADO'] ?>,
                                        '<?= $telefono['TELEFONO'] ?>',
                                        '<?= $telefono['TIPO_TELEFONO'] ?>'
                                        )" 
                                    data-toggle="modal" data-target="#telefonoModel"><i class="icon fas fa-edit"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Teléfono</th>
                            <th>Tipo</th>
                            <th>Empleado</th>
                            <th>Fecha de teléfono</th>
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
<div class="modal" id="telefonoModel" tabindex="-1" role="dialog" aria-labelledby="telefonoModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="telefonoModelLabel"><?= $nombre_obj?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= $url_guardar ?>" method="post">
                     <?= csrf_field() ?>
                    <input type="hidden" name="ID_TELEFONO" id="ID_TELEFONO">

                    <div class="form-group">
                        <label>Empleado</label>
                        <select required name="ID_EMPLEADO" id="ID_EMPLEADO"  class="form-control select2 " style="width: 100%;">
                            <?php foreach ($empleados as $index => $empleado) : ?>
                                <option value="<?= $empleado['ID_EMPLEADO'] ?>">
                                <?= $empleado['APELLIDO_PATERNO'] ?> <span> </span>
                                <?= $empleado['APELLIDO_MATERNO'] ?><span>, </span>
                                <?= $empleado['NOMBRE_PRIMERO'] ?><span> </span>
                                <?= $empleado['NOMBRE_SEGUNDO'] ?><span> </span>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Telefono Celular</label>
                        <input name="TELEFONO" onkeyup="validar_numero(this, 1000000, 99999999999)" onblur="validar_numero(this, 1000000, 99999999999)" type="text" class="form-control" id="TELEFONO" placeholder="22334455">
                        <div class="invalid-feedback" style="display:none">
                        Telefono invalido: <strong>Telefono valido ejemplo: 70809010</strong>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Tipo</label>
                        <input name="TIPO_TELEFONO" onkeyup="validar_string(this)" onblur="validar_string(this)" type="text" class="form-control" id="TIPO_TELEFONO" placeholder="Personal">
                        <div class="invalid-feedback" style="display:none">
                            Tipo invalido: <strong>Ejemplo: Mi celular secundario</strong>
                        </div>
                    </div>

                    <button id="btn_submit" disabled type="submit" class="btn btn-success btn-block">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar -->
<div class="modal" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content  bg-danger">
      <div class="modal-header">
        <h5 class="modal-title" id="eliminarModalLabel">Eliminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h4>¿Esta seguro que desea eliminar  <?= $nombre_obj ?> seleccionado?</h4>

      <form action="<?= $url_eliminar ?>" method="post" class=" mt-4 row d-flex justify-content-around">
          <?= csrf_field() ?>
          <input type="hidden" id="id_eliminar" name="ID_TELEFONO">
          <button type="button" class="btn btn-outline-light col-4" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-outline-light col-4" >
          Eliminar
          </button>
      </form>
      </div>
    </div>
  </div>
</div>