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
                        <button type="button" class="btn  btn-success col-8" data-toggle="modal" data-target="#domicilioModel" onclick="limpiar()">Nuevo</button>
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
                            <th>Direccion</th>
                            <th>Empleado</th>
                            <th>Fecha de dirección</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($domicilios as $index => $domicilio) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $domicilio['DIRECCION']?></td>
                                <td><?= $empleadosModel->get_nombre_compleado($domicilio['ID_EMPLEADO'])?></td>
                                <td><?= $domicilio['DESDE_FECHA_DOMICILIO']?></td>
                                <td class="row d-flex justify-content-around">
                                <button type="button" onclick="eliminar(<?= $domicilio['ID_DOMICILIO'] ?>)" class="btn btn-danger col-5" data-toggle="modal" data-target="#eliminarModal">
                                <i class="icon fas fa-trash"></i></button>
                                    <button class="btn btn-primary col-5 btn-sm" 
                                    onclick="editar_estado(
                                        <?= $domicilio['ID_DOMICILIO'] ?>, 
                                        <?= $domicilio['ID_EMPLEADO'] ?>,
                                        '<?= $domicilio['DIRECCION'] ?>'
                                        )" 
                                    data-toggle="modal" data-target="#domicilioModel"><i class="icon fas fa-edit"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Direccion</th>
                            <th>Empleado</th>
                            <th>Fecha de dirección</th>
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
<div class="modal" id="domicilioModel" tabindex="-1" role="dialog" aria-labelledby="domicilioModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="domicilioModelLabel"><?= $nombre_obj?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= $url_guardar ?>" method="post">
                     <?= csrf_field() ?>
                    <input type="hidden" name="ID_DOMICILIO" id="ID_DOMICILIO">

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
                        <label for="">Dirección: </label>
                        <input name="DIRECCION" onkeyup="validar_string_con_longitud(this, 15)" onblur="validar_string_con_longitud(this, 15)" type="text" class="form-control" id="DIRECCION" placeholder="Colonia los Alpes Suizos, casa N 10">
                        <div class="invalid-feedback" style="display:none">
                                Direccion invalida: <strong>La direccion es muy corta</strong>
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
          <input type="hidden" id="id_eliminar" name="ID_DOMICILIO">
          <button type="button" class="btn btn-outline-light col-4" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-outline-light col-4" >
          Eliminar
          </button>
      </form>
      </div>
    </div>
  </div>
</div>