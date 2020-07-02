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
            <button type="button" class="btn  btn-success col-8" data-toggle="modal" data-target="#presupuestoModal" onclick="limpiar()">Nuevo</button>
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
              <th>Departamento</th>
              <th>Año</th>
              <th>Mes</th>
              <th>Monto Presupuesto Anual</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($presupuestos as $index => $presupuesto) : ?>
              <tr>
                <td><?= $index + 1 ?></td>

                <td><?= $departamentoModel->get_nombre_departamento($presupuesto['ID_DEPARTAMENTO_EMPRESA'])?></td>
                <td><?= $presupuesto['ANIO']?></td>
                <td><?= $presupuesto['MES']?></td>
                <td><?= '$ '.$presupuesto['MONTO_PRESUPUESTOANUAL'] ?></td>
                

                <td class="row d-flex justify-content-around">
                  <form action="<?= $url_eliminar ?>" method="post" class=" col-5">
                    <?= csrf_field() ?>
                    <input type="hidden" name="ID_PRESUPUESTO" value="<?= $presupuesto['ID_PRESUPUESTO'] ?>">
                    <button class="btn btn-danger"><i class="icon fas fa-trash"></i></button>
                  </form>
                  <button class="btn btn-primary col-5" 
                  onclick="editar_estado(
                    <?= $presupuesto['ID_PRESUPUESTO'] ?>,
                    '<?= $presupuesto['ID_DEPARTAMENTO_EMPRESA'] ?>',
                    '<?= $presupuesto['ANIO'] ?>',
                    '<?= $presupuesto['MES'] ?>',
                    '<?= $presupuesto['MONTO_PRESUPUESTOANUAL'] ?>',
                  )" data-toggle="modal" data-target="#presupuestoModal">
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
            <th>Empresa</th>
              <th>Monto Desde</th>
              <th>Monto Hasta</th>
              <th>Porcentaje Comisión</th>
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
<div class="modal" id="presupuestoModal" tabindex="-1" role="dialog" aria-labelledby="presupuestoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="presupuestoModalLabel"><?= $nombre_obj?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= $url_guardar ?>" method="post">
                     <?= csrf_field() ?>
                    <input type="hidden" name="ID_PRESUPUESTO" id="ID_PRESUPUESTO">

                    <div class="form-group">
                    <label>Departamento *</label>
                    <select required name="ID_DEPARTAMENTO_EMPRESA" id="ID_DEPARTAMENTO_EMPRESA" class="form-control select2 " style="width: 100%;">
                        <?php foreach ($departamentos as $index => $departamento) : ?>
                            <option value="<?= $departamento['ID_DEPARTAMENTO_EMPRESA'] ?>"><?= $departamento['NOMBRE_DEPARTAMENTO_EMPRESA'] ?></option>
                        <?php endforeach ?>
                    </select>
                    </div>

                    <div class="form-group">
                        <label for="">Año *</label>
                        <input name="ANIO" id="ANIO"  onkeyup="validar_numero(this, 1900)" onblur="validar_numero(this, 1900)" type="number" class="form-control" placeholder="1900">
                        <div class="invalid-feedback" style="display:none">
                        Año invalido: <strong>Monto debe ser mayor 1900</strong>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Mes *</label>
                        <input name="MES" id="MES"  onkeyup="validar_numero(this, 1, 12)" onblur="validar_numero(this, 1, 12)" type="number" class="form-control" placeholder="1">
                        <div class="invalid-feedback" style="display:none">
                        Mes invalido: <strong>Mes debe ser entre 1 y 12</strong>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Monto Presupuesto Anual *</label>
                        <input name="MONTO_PRESUPUESTOANUAL" id="MONTO_PRESUPUESTOANUAL" onkeyup="validar_numero(this, 1)" onblur="validar_numero(this, 1)" type="number" class="form-control" step="0.01" placeholder="1.00">
                        <div class="invalid-feedback" style="display:none">
                        Monto invalido: <strong>Monto debe ser mayor 1.00</strong>
                        </div>
                    </div>


                    <button id="btn_submit" disabled type="submit" class="btn btn-success btn-block">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>