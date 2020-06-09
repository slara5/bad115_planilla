
<div id="tabla">

<table id="" class="table table-bordered table-hover">
  <thead >
    <tr>
    <th>Correlativo</th>
    <th hidden="true">identificador</th>
      <th>Descripcion</th>
      <th>Salario minimo</th>
      <th>Salario maximo</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($ptrabajos as $index => $ptrabajo):?>
    <tr>
    <th scope="row"><?=$index+1?></th>
    <th scope="row" class='idelemento' hidden="true"><?= $ptrabajo['ID_PUESTO'] ?></th>

    
      <td class='id_nombre_depto'><?= $ptrabajo['DESCRIPCION_PUESTO'] ?></td>
      <td class='sal_min'><?= $ptrabajo['SALARIO_MIN'] ?></td>
      <td class='sal_max'><?= $ptrabajo['SALARIO_MAX'] ?></td>


      <td>
      <button href="#" id="delete" role="button" class="btn btn-danger"><i class="icon fas fa-trash"></i></button>
      <button href="#"  id="edit" role="button" class="btn btn-primary col-5" ><i class="icon fas fa-pen"></i></button>
      
      </td>
    </tr>
    <?php endforeach; ?> 

       
  </tbody>
</table>

</div>