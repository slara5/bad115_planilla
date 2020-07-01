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
            <button type="button" class="btn  btn-success col-8" data-toggle="modal" data-target="#detalleModal" onclick="limpiar()">Nuevo</button>
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
              <th>Tabla</th>
              <th>Monto Desde</th>
              <th>Monto Hasta</th>
              <th>Porcentaje Des.</th>
              <th>Valor Fijo</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($detalles as $index => $detalle) : ?>
              <tr>
                <td><?= $index + 1 ?></td>

                <td><?= $tablaModel->get($detalle['ID_TABLA'])[0]['NOMBRE_TABLA']?></td>
                <td><?= '$ '.$detalle['DESDE_MONTO_INGRESOS']?></td>
                <td><?= '$ '.$detalle['HASTA_MONTO_INGRESOS']?></td>
                <td><?= $detalle['PORCENTAJE_RENTA_TABLA'] . ' %' ?></td>
                <td><?= '$ '.$detalle['VALOR_FIJO_RENTA_TABLA']?></td>

                <td class="row d-flex justify-content-around">
                  <form action="<?= $url_eliminar ?>" method="post" class=" col-5">
                    <?= csrf_field() ?>
                    <input type="hidden" name="ID_RANGO_RENTA" value="<?= $detalle['ID_RANGO_RENTA'] ?>">
                    <button class="btn btn-danger"><i class="icon fas fa-trash"></i></button>
                  </form>
                  <button class="btn btn-primary col-5" 
                  onclick="editar_estado(
                    <?= $detalle['ID_RANGO_RENTA'] ?>,
                    '<?= $detalle['ID_TABLA'] ?>',
                    '<?= $detalle['DESDE_MONTO_INGRESOS'] ?>',
                    '<?= $detalle['HASTA_MONTO_INGRESOS'] ?>',
                    '<?= $detalle['PORCENTAJE_RENTA_TABLA'] ?>',
                    '<?= $detalle['VALOR_FIJO_RENTA_TABLA'] ?>',
                  )" data-toggle="modal" data-target="#detalleModal">
                  <i class="icon fas fa-edit"></i></button>
                  <!-- <button class="btn btn-info col-3" 
                  onclick="" data-toggle="modal" data-target="#empleadoModal">
                  <i class="icon fas fa-eye"></i></button> -->
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
            <th>#</th>
              <th>Tabla</th>
              <th>Monto Desde</th>
              <th>Monto Hasta</th>
              <th>Porcentaje Des.</th>
              <th>Valor Fijo</th>
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
<div class="modal" id="detalleModal" tabindex="-1" role="dialog" aria-labelledby="detalleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detalleModalLabel"><?= $nombre_obj?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= $url_guardar ?>" method="post">
                     <?= csrf_field() ?>
                    <input type="hidden" name="ID_RANGO_RENTA" id="ID_RANGO_RENTA">

                    <div class="form-group">
                    <label>Tabla Renta *</label>
                    <select required name="ID_TABLA" id="ID_TABLA" class="form-control select2 " style="width: 100%;">
                        <?php foreach ($tablas as $index => $tabla) : ?>
                            <option value="<?= $tabla['ID_TABLA'] ?>"><?= $tabla['NOMBRE_TABLA'] ?></option>
                        <?php endforeach ?>
                    </select>
                    </div>

                    <div class="form-group">
                        <label for="">Monto desde *</label>
                        <input name="DESDE_MONTO_INGRESOS" id="DESDE_MONTO_INGRESOS"  onkeyup="validar_numero(this, 1)" onblur="validar_numero(this, 1)" type="number" class="form-control" step="0.01" placeholder="0.01">
                        <div class="invalid-feedback" style="display:none">
                        Monto invalido: <strong>Monto debe ser mayor que 1</strong>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Monto hasta *</label>
                        <input name="HASTA_MONTO_INGRESOS" id="HASTA_MONTO_INGRESOS"  onkeyup="validar_numero(this, 1)" onblur="validar_numero(this, 1)" type="number" class="form-control" step="0.01" placeholder="0.01">
                        <div class="invalid-feedback" style="display:none">
                        Monto invalido: <strong>Monto debe ser mayor que 1</strong>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Porcentaje Renta *</label>
                        <input name="PORCENTAJE_RENTA_TABLA" id="PORCENTAJE_RENTA_TABLA" onkeyup="validar_numero(this, 1,100)" onblur="validar_numero(this, 1,100)" type="number" class="form-control" step="0.01" placeholder="0.01">
                        <div class="invalid-feedback" style="display:none">
                        Porcentaje invalido: <strong>Porcentaje debe ser mayor 1 y menor a 100</strong>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Monto descuento fijo *</label>
                        <input name="VALOR_FIJO_RENTA_TABLA" id="VALOR_FIJO_RENTA_TABLA"  onkeyup="validar_numero(this, 1)" onblur="validar_numero(this, 1)" type="number" class="form-control" step="0.01" placeholder="0.01">
                        <div class="invalid-feedback" style="display:none">
                        Monto invalido: <strong>Monto debe ser mayor que 1</strong>
                        </div>
                    </div>

                    <button id="btn_submit" disabled type="submit" class="btn btn-success btn-block">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>