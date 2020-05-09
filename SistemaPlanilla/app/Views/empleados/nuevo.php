<?php if($post):?>
<?php if ($exito) : ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> EMPLEADO CREADO!</h5>
        Se ha creado un nuevo Empleado con exito.
    </div>
<?php else: ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> ERROR AL CREAR EMPLEADO!</h5>
        Ha ocurrido un problema al crear empleado
        <?= \Config\Services::validation()->listErrors(); ?>
    </div>
<?php endif ?>
<?php endif ?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Nuevo Empleado</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="<?= base_url() ?>/empleados/nuevo" method="post">
        <?= csrf_field() ?>
        <div class="card-body row">
            <div class="col-md-6 ">
                <div class="form-group">
                    <label for="">Codigo Empleado</label>
                    <input name="codigo_empleado" type="text" class="form-control" id="" placeholder="" value="<?=$cod_empleado?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Primer Nombre</label>
                    <input name="nombre_primero" type="text" class="form-control" id="" placeholder="Primer nombre">
                </div>
                <div class="form-group">
                    <label for="">Segundo Nombre</label>
                    <input name="nombre_segundo" type="text" class="form-control" id="" placeholder="Segundo nombre">
                </div>
                <div class="form-group">
                    <label for="">Primer Apellido</label>
                    <input name="apellido_paterno" type="text" class="form-control" id="" placeholder="Primer apellido">
                </div>
                <div class="form-group">
                    <label for="">Segundo Apellido</label>
                    <input name="apellido_materno" type="text" class="form-control" id="" placeholder="Segundo apellido">
                </div>
                <div class="form-group">
                    <label>Fecha Nacimiento:</label>
                    <div class="input-group date" id="nacimientodate" data-target-input="nearest">
                        <input name="fecha_nacimiento" type="text" class="form-control datetimepicker-input" data-target="#nacimientodate" placeholder="dd/mm/aaaa">
                        <div class="input-group-append" data-target="#nacimientodate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Dirección</label>
                    <input name="direccion" type="text" class="form-control" id="" placeholder="Calle ## pasaje tal casa ##">
                </div>
                <div class="form-group">
                    <label for="">DUI</label>
                    <input name="numero_documento" type="text" class="form-control" id="" placeholder="00000000-1">
                </div>
                <div class="form-group">
                    <label>Fecha Expedición:</label>
                    <div class="input-group date" id="expediciondate" data-target-input="nearest">
                        <input name="fecha_expedicion" type="text" class="form-control datetimepicker-input" data-target="#expediciondate" placeholder="dd/mm/aaaa">
                        <div class="input-group-append" data-target="#expediciondate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">NIT</label>
                    <input name="nit" type="text" class="form-control" id="" placeholder="0000-0000-111">
                </div>
                <div class="form-group">
                    <label for="">NUP</label>
                    <input name="nup" type="text" class="form-control" id="" placeholder="1234567890">
                </div>
                <div class="form-group">
                    <label for="">Numero ISS</label>
                    <input name="numero_iss" type="text" class="form-control" id="" placeholder="1234567890">
                </div>
                <div class="form-group">
                    <label>Fecha Ingreso:</label>
                    <div class="input-group date" id="ingresodate" data-target-input="nearest">
                        <input name="fecha_ingreso" type="text" class="form-control datetimepicker-input" data-target="#ingresodate" placeholder="dd/mm/aaaa">
                        <div class="input-group-append" data-target="#ingresodate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Fecha Contratacion:</label>
                    <div class="input-group date" id="contrataciondate" data-target-input="nearest">
                        <input name="fecha_contratacion" type="text" class="form-control datetimepicker-input" data-target="#contrataciondate" placeholder="dd/mm/aaaa">
                        <div class="input-group-append" data-target="#contrataciondate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Salario</label>
                    <input name="salario" type="number" class="form-control" id="" placeholder="300">
                </div>
            </div>
            <div class="col-md-6">


                <div class="form-group">
                    <label>Sub Seccion</label>
                    <select name="id_sub_seccion" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                        <?php foreach ($sub_secciones as $index => $sub_seccion) : ?>
                            <option value="<?= $sub_seccion['ID_SUB_SECCION'] ?>"><?= $sub_seccion['NOMBRE_SUB_SECCION'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <select name="id_estado" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                        <?php foreach ($estado_empleados as $index => $estado) : ?>
                            <option value="<?= $estado['ID_ESTADO'] ?>"><?= $estado['NOMBRE_ESTADO'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Estado Civil</label>
                    <select name="id_estado_civil" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                        <?php foreach ($estados_civil as $index => $estado) : ?>
                            <option value="<?= $estado['ID_ESTADO_CIVIL'] ?>"><?= $estado['NOMBRE_ESTADO_CIVIL'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>AFP</label>
                    <select name="id_afp" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                        <?php foreach ($afps as $index => $afp) : ?>
                            <option value="<?= $afp['ID_AFP'] ?>"><?= $afp['NOMBRE_AFP'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>puesto</label>
                    <select name="id_puesto" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                        <?php foreach ($puestos_trabajo as $index => $puesto) : ?>
                            <option value="<?= $puesto['ID_PUESTO'] ?>"><?= $puesto['DESCRIPCION_PUESTO'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Genero</label>
                    <select name="id_genero" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                        <?php foreach ($generos as $index => $genero) : ?>
                            <option value="<?= $genero['ID_GENERO'] ?>"><?= $genero['DESCRIPCION_GENERO'] ?></option>
                        <?php endforeach ?>
                    </select>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tipo Contratacion</label>
                    <select name="id_tipo_contratacion" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                        <?php foreach ($tipos_contratacion as $index => $contratacion) : ?>
                            <option value="<?= $contratacion['ID_TIPO_CONTRATACION'] ?>"><?= $contratacion['NOMBRE_CONTRATACION'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Muncipio</label>
                    <select name="id_municipio" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                        <?php foreach ($municipios as $index => $municipio) : ?>
                            <option value="<?= $municipio['ID_MUNICIPIO'] ?>"><?= $municipio['NOMBRE_MUNICIPIO'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Profesion u Oficio</label>
                    <select name="id_profesion_oficio" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                        <?php foreach ($profesiones as $index => $profesion) : ?>
                            <option value="<?= $profesion['ID_PROFESION_OFICIO'] ?>"><?= $profesion['NOMBRE_PROFESION'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Correo Electronico Personal</label>
                    <input name="correo_electronico_personal" type="email" class="form-control" id="" placeholder="example@example.com">
                </div>
                <div class="form-group">
                    <label for="">Correo Electronico Intitucional</label>
                    <input name="correo_electronico_institucional" type="email" class="form-control" id="" placeholder="example@example.com">
                </div>
                <div class="form-group">
                    <label for="">Telefono Celular</label>
                    <input name="telefono_movil" type="text" class="form-control" id="" placeholder="7777-7777">
                </div>
                <div class="form-group">
                    <label for="">Telefono fijo</label>
                    <input name="telefono" type="text" class="form-control" id="" placeholder="2222-2222">
                </div>
                <div class="form-group">
                    <label for="">Horario de trabajo</label>
                    <input name="horario_trabajo" type="text" class="form-control" id="" placeholder="6 AM - 6 PM">
                </div>
                <div class="form-group">
                    <label>Jefe De Empleado</label>
                    <select name="id_empleado_jefe" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                    <?php foreach ($empleados as $index => $empleado) : ?>
                            <option value="<?= $empleado['ID_EMPLEADO'] ?>">
                            <?= $empleado['APELLIDO_PATERNO'].' '.$empleado['APELLIDO_MATERNO'].','.$empleado['NOMBRE_PRIMERO'].' '.$empleado['NOMBRE_SEGUNDO'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary col-10 offset-1">Crear Empleado</button>
        </div>
    </form>
</div>