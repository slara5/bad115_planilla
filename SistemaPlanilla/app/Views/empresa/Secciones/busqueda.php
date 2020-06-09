
<div id="tabla">

<table id="" class="table table-bordered table-hover">
  <thead >
    <tr>
    <th>Correlativo</th>
    <th hidden="true">identificador</th>
      <th>Nombre de la seccion</th>
      <th>Area</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($secciones as $index => $seccion):?>
    <tr>
    <th scope="row"><?=$index+1?></th>
    <th scope="row" class='idelemento' hidden="true"><?= $seccion['ID_SECCION'] ?></th>
    <th scope="row" class='idelemento2' hidden="true"><?= $seccion['IDAREA'] ?></th>    

    
      <td class='id_nombre_depto'><?= $seccion['NOMBRE_SECCION'] ?></td>
      <td><?= $area->get($seccion['IDAREA'])[0]['NOMBRE_AREA']?></td>



      <td>
      <button href="#" id="delete" role="button" class="btn btn-danger"><i class="icon fas fa-trash"></i></button>
      <button href="#"  id="edit" role="button" class="btn btn-primary col-5" ><i class="icon fas fa-pen"></i></button>
      
      </td>
    </tr>
    <?php endforeach; ?> 

       
  </tbody>
</table>

</div>