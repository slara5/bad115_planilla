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
                        <button type="button" class="btn  btn-success col-8" data-toggle="modal" data-target="#afpModal" onclick="limpiar()" >Nuevo</button>
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
                            <th>Nombre AFP</th>
                            <th>Porcentaje Laboral</th>
                            <th>Porcentaje Patronal</th>
                            <th>Límite Máximo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($afps as $index => $afp) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $afp['NOMBRE_AFP'] . ' ' ?></td>
                                <td><?= $afp['PORCENTAJE_LABORAL'] . ' %' ?></td>
                                <td><?= $afp['PORCENTAJE_PATRONAL'] . ' %' ?></td>
                                <td><?= '$ '.$afp['LIMITE_MAXIMO_AFP'] . ' ' ?></td>
                                <td class="row d-flex justify-content-around">
                                    <form action="<?= $url_eliminar?>" method="post" class=" col-5">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="ID_AFP" value="<?=$afp['ID_AFP'] ?>">
                                    <button class="btn btn-danger"><i class="icon fas fa-trash"></i></button>
                                    </form>
                                    <button class="btn btn-primary col-5" 
                                    onclick="editar_estado(<?= $afp['ID_AFP'] ?>, 
                                    '<?= $afp['NOMBRE_AFP'] ?>',
                                    '<?= $afp['PORCENTAJE_LABORAL'] ?>',
                                    '<?= $afp['PORCENTAJE_PATRONAL'] ?>',
                                    '<?= $afp['LIMITE_MAXIMO_AFP'] ?>',)" 
                                    data-toggle="modal" data-target="#afpModal">
                                    <i class="icon fas fa-edit"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nombre AFP</th>
                            <th>Porcentaje Laboral</th>
                            <th>Porcentaje Patronal</th>
                            <th>Límite Máximo</th>
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
<div class="modal" id="afpModal" tabindex="-1" role="dialog" aria-labelledby="afpModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="afpModalLabel"><?= $nombre_obj?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= $url_guardar ?>" method="post">
                     <?= csrf_field() ?>
                    <input type="hidden" name="ID_AFP" id="ID_AFP">
                    <div class="form-group">
                        <label for="">Nombre de <?= $nombre_obj?> *</label>
                        <input name="NOMBRE_AFP" id="NOMBRE_AFP" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" placeholder="Nombre de <?= $nombre_obj?>">
                        <div class="invalid-feedback" style="display:none">
                            El nombre no debe comenzar con números ni caracteres especiales
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Porcentaje Laboral *</label>
                        <input name="PORCENTAJE_LABORAL" id="PORCENTAJE_LABORAL" onkeyup="validar_numero(this, 1,100)" onblur="validar_numero(this, 1)" type="number" class="form-control" step="0.01" placeholder="1">
                        <div class="invalid-feedback" style="display:none">
                        Porcentaje invalido: <strong>Porcentaje debe ser mayor 1 y menor a 100</strong>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Porcentaje Patronal *</label>
                        <input name="PORCENTAJE_PATRONAL" id="PORCENTAJE_PATRONAL" onkeyup="validar_numero(this, 1,100)" onblur="validar_numero(this, 1)" type="number" class="form-control" step="0.01" placeholder="1">
                        <div class="invalid-feedback" style="display:none">
                        Porcentaje invalido: <strong>Porcentaje debe ser mayor 1 y menor a 100</strong>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Límite máximo</label>
                        <input name="LIMITE_MAXIMO_AFP" id="LIMITE_MAXIMO_AFP"  onkeyup="validar_numero(this, 300)" onblur="validar_numero(this, 300)" type="number" class="form-control" step="0.01" placeholder="300">
                        <div class="invalid-feedback" style="display:none">
                        Monto invalido: <strong>Monto debe ser mayor que el salario minimo</strong>
                        </div>
                    </div>
                    <button id="btn_submit" disabled type="submit" class="btn btn-success btn-block">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>