<?php if ($operacion == 'guardar') : ?>
    <?php if ($exito) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> <?= $nombre_obj ?> Guardado!</h5>
            Se ha guardado el <?= $nombre_obj ?> con exito
        </div>
    <?php else : ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> ERROR AL GUARDAR <?= strtoupper($nombre_obj) ?>!</h5>
            Ha ocurrido un problema al guardar <?= $nombre_obj ?>
            <?= \Config\Services::validation()->listErrors(); ?>
        </div>
    <?php endif ?>
<?php endif ?>
<?php if ($operacion == 'eliminar') : ?>
    <?php if ($exito) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> <?= $nombre_obj ?> eliminado con exito</h5>
        </div>
    <?php else : ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> ERROR AL ELIMINAR <?= strtoupper($nombre_obj) ?>!</h5>
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
                <h2 class="card-title"><b><?= $nombre_obj ?></b></h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-4">
                        <button type="button" class="btn  btn-success col-8" data-toggle="modal" data-target="#descuentoProgramadosModal" onclick="limpiar()">Nuevo</button>
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
                <table id="" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Empleado</th>
                            <th>Descuento</th>
                            <th>Valor descuento</th>
                            <th>Fecha inicio</th>
                            <th>Fecha Fin</th>
                            <th>Descuento activo?</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($descuentos_programados as $index => $descuento) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $empleadosModel->get_nombre_compleado($descuento['ID_EMPLEADO'])?></td>
                                <td><?= $ingresosDescuentosModel->get_nombre_concepto($descuento['ID_CODIGO']) ?></td>
                                <td><?= $descuento['VALOR_CUOTA_DESCUENTO'] ?></td>
                                <td><?= $descuento['FECHA_INICIO_DESCUENTO'] ?></td>
                                <td><?= $descuento['FECHA_FIN_DESCUENTO'] ?></td>
                                <?php if ($descuento['ACTIVO_DESCUENTO'] == 1) : ?>
                                    <td align="center"><b class="badge-pill badge-success h5">SI</b></td>
                                <?php else : ?>
                                    <td align="center"><b class="badge-pill badge-dark h5">NO</b></td>
                                <?php endif ?>
                                <td class="row d-flex justify-content-around">
                                <button type="button" onclick="eliminar(<?= $descuento['ID_MOVIMIENTO_DESCUENTO'] ?>)" class="btn btn-danger col-5" data-toggle="modal" data-target="#eliminarModal">
                                <i class="icon fas fa-trash"></i></button>
                                <button class="btn btn-primary col-5 btn-sm" onclick="editar_estado(
                                    <?= $descuento['ID_MOVIMIENTO_DESCUENTO'] ?>, 
                                    <?= $descuento['ID_EMPLEADO'] ?>, 
                                    <?= $descuento['ID_CODIGO'] ?>,
                                    <?= $descuento['VALOR_CUOTA_DESCUENTO'] ?>,
                                    '<?= $descuento['FECHA_INICIO_DESCUENTO'] ?>',
                                    '<?= $descuento['FECHA_FIN_DESCUENTO'] ?>',
                                    <?= $descuento['ACTIVO_DESCUENTO'] ?>
                                    )" data-toggle="modal" data-target="#descuentoProgramadosModal"><i class="icon fas fa-edit"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Empleado</th>
                            <th>Descuento</th>
                            <th>Valor descuento</th>
                            <th>Fecha inicio</th>
                            <th>Fecha Fin</th>
                            <th>Descuento activo?</th>
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
<div class="modal" id="descuentoProgramadosModal" tabindex="-1" role="dialog" aria-labelledby="descuentoProgramadosModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="descuentoProgramadosModalLabel"><?= $nombre_obj ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= $url_guardar ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="ID_MOVIMIENTO_DESCUENTO" id="ID_MOVIMIENTO_DESCUENTO">
                    

                    <div class="form-group">
                        <label>Empleado </label>
                        <select required name="ID_EMPLEADO" id="ID_EMPLEADO" class="form-control select2 " style="width: 100%;">
                            <?php foreach ($empleados as $index => $empleado) : ?>
                                <option value="<?= $empleado['ID_EMPLEADO'] ?>"><?= $empleadosModel->get_nombre_compleado($empleado['ID_EMPLEADO']) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tipo Movimiento</label>
                        <select required name="ID_CODIGO" id="ID_CODIGO" class="form-control select2 " style="width: 100%;">
                            <?php foreach ($descuentos as $index => $descuento) : ?>
                                <option value="<?= $descuento['ID_CODIGO'] ?>"><?= $descuento['NOMBRE_CONCEPTO'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Valor Descuento</label>
                        <input name="VALOR_CUOTA_DESCUENTO" step="0.01" min="0"  onkeyup="validar_numero(this, 0)" onblur="validar_numero(this, 0)" type="number" class="form-control" id="VALOR_CUOTA_DESCUENTO" placeholder="1" value="1">
                        <div class="invalid-feedback" style="display:none">
                        Valor de descuento invalido: <strong>No puede ser menor que cero</strong>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Fecha Inicio Descuento:</label>
                        <div class="input-group date" id="iniciodate" data-target-input="nearest">
                            <input name="FECHA_INICIO_DESCUENTO" id="FECHA_INICIO_DESCUENTO" onkeyup="validar_fecha_inicio_fin('FECHA_INICIO_DESCUENTO', 'FECHA_FIN_DESCUENTO', this)" onblur="validar_fecha_inicio_fin('FECHA_INICIO_DESCUENTO', 'FECHA_FIN_DESCUENTO', this)"  type="text" class="form-control datetimepicker-input" data-target="#iniciodate" placeholder="aaaa-mm-dd">
                            <div class="invalid-feedback" style="display:none">
                                Fecha invalida: <strong>Fecha llevar el formato: aaaa-mm-dd y debe ser anterior a fecha fin</strong>
                            </div>
                            <div class="input-group-append" data-target="#iniciodate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Fecha Fin Descuento:</label>
                        <div class="input-group date" id="findate" data-target-input="nearest">
                            <input name="FECHA_FIN_DESCUENTO" id="FECHA_FIN_DESCUENTO" onkeyup="validar_fecha_inicio_fin('FECHA_INICIO_DESCUENTO', 'FECHA_FIN_DESCUENTO', this)" onblur="validar_fecha_inicio_fin('FECHA_INICIO_DESCUENTO', 'FECHA_FIN_DESCUENTO', this)"  type="text" class="form-control datetimepicker-input" data-target="#findate" placeholder="aaaa-mm-dd">
                            <div class="invalid-feedback" style="display:none">
                                Fecha Incorrecta: <strong>Fecha debe llevar el formato: aaaa-mm-dd y debe ser posterior a la fecha de inicio</strong>
                            </div>
                            <div class="input-group-append" data-target="#findate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                              

                    <div class="form-group">
                        <label for="">Descuento activo?</label>
                        <select required name="ACTIVO_DESCUENTO" id="ACTIVO_DESCUENTO" class="form-control">
                            <option value="1" >SI</option>
                            <option value="0">NO</option>
                        </select>
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
      <form action="<?= $url_eliminar ?>" method="post" class="mt-4 row d-flex justify-content-around">
          <?= csrf_field() ?>
          <input type="hidden" id="id_eliminar" name="ID_MOVIMIENTO_DESCUENTO">
          <button type="button" class="btn btn-outline-light col-4" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-outline-light col-4" >
          Eliminar
          </button>
      </form>
      </div>
    </div>
  </div>
</div>