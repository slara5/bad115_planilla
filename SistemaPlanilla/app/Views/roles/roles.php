<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title"><b>Roles</b></h2>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-4">
            <button type="button" class="btn  btn-success col-8" id="nuevo">Nuevo</button>
          </div>
          <div class="col-8">
            <div class="input-group input-group-sm">

        <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search" id="busqueda" onkeyup="Alerta()">
        <div class="input-group-append">
        <button class="btn btn-secondary" disabled>
                    <i class="fas fa-search"></i>
                  </button>
        </div>
      </div>

          </div>
        </div>
        
        <p id="ruta" style="display: none"><?= base_url() ?></p>


<div id="cambio">

<?php echo view('roles/busqueda');?>

</div>

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>


<?php echo $paginador->links(); ?>

 
<div class="modal" id="rolesModal" tabindex="-1" role="dialog" aria-labelledby="rolesModalLabel" aria-hidden="true">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rolesModalLabel">Crear/Editar Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="formulario" >

                    <input type="hidden" name="ID_ROL" id="ID_ROL">
                    <div class="form-group">
                        <label for="">Nombre del Rol</label>
                        <input name="NOMBRE_ROL" id="NOMBRE_ROL" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" id="" placeholder="Nombre del rol">
                        <div class="invalid-feedback" style="display:none">
                            El nombre no debe comenzar con números ni caracteres especiales
                        </div>
                    </div>
                    <h4>Menú</h4>
                    <?php foreach ($menus->getResultArray() as $index => $menus) : ?>
                      <div class="form-group">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="show-child" value="<?= $menus["ID_MENU"] ?>">
                          <label class="form-check-label"><?= $menus["NOMBRE_MENU"] ?></label>
                        </div>
                      </div>
                    
                    <?php endforeach ?>

                    <button id="btn_submit" disabled type="submit" class="btn btn-success btn-block">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>/js/roles/roles.js"></script>