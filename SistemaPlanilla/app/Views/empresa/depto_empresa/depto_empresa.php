<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title"><b>Departamentos de la empresa</b></h2>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-4">
            <button type="button" class="btn  btn-success col-8" id="nuevo">Nuevo</button>
          </div>
          <div class="col-8">


<div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search" id="busqueda" onkeyup="Buscar()">
        <div class="input-group-append">
        <button class="btn btn-secondary" disabled>
                    <i class="fas fa-search"></i>
                  </button>
        </div>
      </div>



          </div>
        </div>


<div id="cambio">
<?php

echo view('empresa/depto_empresa/busqueda');

?>





</div>



      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>

<div class="modal" id="unidadesModal" tabindex="-1" role="dialog" aria-labelledby="unidadesModalLabel" aria-hidden="true">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generoModalLabel">Crear nueva unidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="formulario" >

                    <input type="hidden" name="ID_DEPARTAMENTO_EMPRESA" id="ID_DEPARTAMENTO_EMPRESA">
                    <div class="form-group">
                        <label for="">Nombre de la unidad</label>
                        <input name="NOMBRE_DEPARTAMENTO_EMPRESA" id="NOMBRE_DEPARTAMENTO_EMPRESA" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" placeholder="Nombre del departamento" required>
                        <div class="invalid-feedback" style="display:none">
                            El nombre no debe comenzar con números ni caracteres especiales
                        </div>
                    </div><div class="form-group">
                    <label>Unidades</label>
                    <select required name="ID_UNIDAD" id="ID_UNIDAD"  class="form-control select2" style="width: 100%;">
                        <?php foreach ($lista_u as $index => $l_unidades) : ?>
                            <option value="<?= $l_unidades['ID_UNIDAD'] ?>"><?= $l_unidades['NOMBRE_UNIDAD'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                        <label for="">Codigo de centro de costos</label>
                        <input name="CODIGO_CENTRO_COSTO" id="CODIGO_CENTRO_COSTO"  type="number" onkeyup="validador(this)" class="form-control" id="CODIGO_CENTRO_COSTO" placeholder="Ingrese codigo" min ="0" required pattern="[0-9]{3}">
                        <div class="invalid-feedback" style="display:none">
            El codigo debe tener tres digitos
                        </div>

                    <button id="btn_submit" disabled  type="submit" class="btn btn-success btn-block">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php echo $paginador->links(); ?>
<script src="<?= base_url() ?>/js/depto_empresa/depto_empresa.js"></script>
 