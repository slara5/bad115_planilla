<div id="tabla">

<table id="" class="table table-bordered table-hover">
  <thead >
    <tr>
    <th>Correlativo</th>
    <th hidden="true">identificador</th>
      <th>Nombre</th>
      <th>Unidad perteneciente</th>
      <th>Codigo de centro de costo</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($depto_empresa as $index => $depto):?>
    <tr>
    <th scope="row"><?=$index+1?></th>
    <th scope="row" class='idelemento' hidden="true"><?= $depto['ID_DEPARTAMENTO_EMPRESA'] ?></th>
    <th scope="row" class='idelemento2' hidden="true"><?= $depto['ID_UNIDAD'] ?></th>
      <td class='id_nombre_depto'><?= $depto['NOMBRE_DEPARTAMENTO_EMPRESA'] ?></td>
      <td><?= $unidades->get($depto['ID_UNIDAD'])[0]['NOMBRE_UNIDAD']?></td>
      <td class='clase_centro_costo'><?= $depto['CODIGO_CENTRO_COSTO'] ?></td>
      <td>
      <button href="#" id="delete" role="button" class="btn btn-danger"><i class="icon fas fa-trash"></i></button>
      <button href="#"  id="edit" role="button" class="btn btn-primary col-5" ><i class="icon fas fa-pen"></i></button>
      </td>
    </tr>
    <?php endforeach; ?> 

       
  </tbody>
</table>

</div>