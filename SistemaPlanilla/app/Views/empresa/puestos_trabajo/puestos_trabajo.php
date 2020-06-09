<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title"><b>Puestos de trabajo</b></h2>
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

echo view('empresa/puestos_trabajo/busqueda');


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
                <h5 class="modal-title" id="generoModalLabel">Crear nuevo puesto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="formulario" >

                <input type="hidden" name="ID_PUESTO" id="ID_PUESTO">
                    <div class="form-group">
                        <label for="">Descripcion del puesto</label>
                        <input name="DESCRIPCION_PUESTO" id="DESCRIPCION_PUESTO" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" require placeholder="Descripcion acerca del puesto">
                        <div class="invalid-feedback" style="display:none">
                        La descripcion no debe comenzar con números ni caracteres especiales
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Salario minimo del puesto</label>
                        <input name="SALARIO_MIN" id="SALARIO_MIN"  type="number" class="form-control" id="SALARIO_MIN" placeholder="Ingrese el salario minimo" min ="0" required>
                        <label for="">Salario maximo del puesto</label>
                        <input name="SALARIO_MAX" id="SALARIO_MAX"  type="number" class="form-control" id="SALARIO_MAX" placeholder="Ingrese el salario maximo" min ="0" required>
                                              </div>

                    <button id="btn_submit" disabled  type="submit" class="btn btn-success btn-block">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php echo $paginador->links(); ?>
<script src="<?= base_url() ?>/js/empleados/puestos_trabajo.js"></script>
 