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
            <button type="button" class="btn  btn-success col-8" data-toggle="modal" data-target="#ingresoDescuentoModal" onclick="limpiar()">Nuevo</button>
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
                <th>Tipo Movimiento</th>
                <th>Concepto</th>
                <th>Seguro</th>
                <th>Afp</th>
                <th>Renta</th>
                <th>Tipo</th>
                <th>Prefijo</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($ingresos_descuentos as $index => $ingreso_descuento) : ?>
                <tr>
                  <td><?= $index + 1 ?></td>

                  <td><?= $tipos_movimientoModel->get($ingreso_descuento['ID_TIPO_MOVIMIENTO'])[0]['NOMBRE_TIPO_MOVIMIENTO'] ?></td>
                  <td><?= $ingreso_descuento['NOMBRE_CONCEPTO'] ?></td>
                  <td><?= ($ingreso_descuento['APLICA_SEGURO'] == 1) ? "SI" : "NO" ?></td>
                  <td><?= ($ingreso_descuento['APLICA_AFP'] == 1) ? "SI" : "NO" ?></td>
                  <td><?= ($ingreso_descuento['APLICA_RENTA'] == 1) ? "SI" : "NO" ?></td>
                  <td><?= $ingreso_descuento['TIPO'] ?></td>
                  <td><?= $ingreso_descuento['PREFIJO'] ?></td>
                  <td class="row d-flex justify-content-around">
                    <form action="<?= $url_eliminar ?>" method="post" class="col-5">
                      <?= csrf_field() ?>
                      <input type="hidden" name="ID_CODIGO" value="<?= $ingreso_descuento['ID_CODIGO'] ?>">
                      <button class="btn btn-danger"><i class="icon fas fa-trash"></i></button>
                    </form>
                    <button class="btn btn-primary col-5"
                      onclick="editar_estado(
                        <?= $ingreso_descuento['ID_CODIGO'] ?>,
                        <?= $ingreso_descuento['ID_TIPO_MOVIMIENTO'] ?>,
                        '<?= $ingreso_descuento['NOMBRE_CONCEPTO'] ?>',
                        <?= $ingreso_descuento['APLICA_SEGURO'] ?>,
                        <?= $ingreso_descuento['APLICA_AFP'] ?>,
                        <?= $ingreso_descuento['APLICA_RENTA'] ?>,
                        <?= $ingreso_descuento['TIPO'] ?>,
                        '<?= $ingreso_descuento['PREFIJO'] ?>',
                        )"
                      data-toggle="modal" data-target="#ingresoDescuentoModal"><i class="icon fas fa-edit"></i>
                    </button>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Tipo Movimiento</th>
                <th>Concepto</th>
                <th>Seguro</th>
                <th>Afp</th>
                <th>Renta</th>
                <th>Tipo</th>
                <th>Prefijo</th>
                <th>Acciones</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>

<!-- MODALS -->
<div class="modal" id="ingresoDescuentoModal" tabindex="-1" role="dialog" aria-labelledby="ingresoDescuentoModalLabel" aria-hidden ="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ingresoDescuentoModalLabel"><?= $nombre_obj ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- FORM -->
        <form role="form" action="<?= $url_guardar ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="ID_CODIGO" id="ID_CODIGO">
          <div class="card-body row">
            <div class="col-md-12">
              <!-- CAMPOS -->
              
              <div class="form-group">
                <label>Tipo de Movimiento</label>
                <select required name="ID_TIPO_MOVIMIENTO" id="ID_TIPO_MOVIMIENTO" class="form-control select2">
                  <?php foreach ($tipos_movimiento as $index => $tipo_movimiento) : ?>
                    <option value="<?= $tipo_movimiento['ID_TIPO_MOVIMIENTO'] ?>"><?= $tipo_movimiento['NOMBRE_TIPO_MOVIMIENTO'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>

              <div class="form-group">
                <label for="">Concepto *</label>
                <input name="NOMBRE_CONCEPTO" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" id="NOMBRE_CONCEPTO" placeholder="Nombre">
                <div class="invalid-feedback" style="display:none">
                  Nombre no válido: <strong>El nombre debe empezar con letras</strong>
                </div>
              </div>

              <div class="row">

                <div class="col-4">
                  <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="APLICA_SEGURO" name="APLICA_SEGURO">
                        <label class="form-check-label">Aplica Seguro</label>
                    </div>
                  </div>
                </div>

                <div class="col-4">
                  <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="APLICA_AFP" name="APLICA_AFP">
                        <label class="form-check-label">Aplica Afp</label>
                    </div>
                  </div>
                </div>
                  
                <div class="col-4">
                  <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="APLICA_RENTA" name="APLICA_RENTA">
                        <label class="form-check-label">Aplica Renta</label>
                    </div>
                  </div>
                </div>

              </div>

              <div class="form-group">
                <label for="">Tipo *</label>
                <input name="TIPO" onkeyup="" onblur="" type="text" class="form-control" id="TIPO" placeholder="Tipo">
                <div class="invalid-feedback" style="display:none">
                  Tipo no válido: <strong>El tipo debe ser un número</strong>
                </div>
              </div>

              <div class="form-group">
                <label for="">Prefijo *</label>
                <input name="PREFIJO" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" id="PREFIJO" placeholder="Prefijo">
                <div class="invalid-feedback" style="display:none">
                  Prefijo no válido: <strong>El prefijo debe empezar con letras</strong>
                </div>
              </div>

            </div>
          </div>

          <div class="card-footer">
            <button id="btn-submit" type="submit" class="btn btn-primary col-10 offset-1">Guardar Cambios</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $('#APLICA_SEGURO').click(function(){
    if(document.getElementById("APLICA_SEGURO").checked == true)
    {
        document.getElementById("APLICA_SEGURO").value = 1;
    }
    else
    {
        document.getElementById("APLICA_SEGURO").value = 0;
    }
  });
  $('#APLICA_AFP').click(function(){
    if(document.getElementById("APLICA_AFP").checked == true)
    {
        document.getElementById("APLICA_AFP").value = 1;
    }
    else
    {
        document.getElementById("APLICA_AFP").value = 0;
    }
  });
  $('#APLICA_RENTA').click(function(){
    if(document.getElementById("APLICA_RENTA").checked == true)
    {
        document.getElementById("APLICA_RENTA").value = 1;
    }
    else
    {
        document.getElementById("APLICA_RENTA").value = 0;
    }
  });
});
</script>