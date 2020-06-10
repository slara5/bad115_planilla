
<div id="tabla">

<table id="" class="table table-bordered table-hover">
  <thead >
    <tr>
    <th>Correlativo</th>
    <th hidden="true">identificador</th>
      <th>Nombre de la subseccion</th>
      <th>Seccion</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($subsecciones as $index => $subseccion):?>
    <tr>
    <th scope="row"><?=$index+1?></th>
    <th scope="row" class='idelemento' hidden="true"><?= $subseccion['ID_SUB_SECCION'] ?></th>
    <th scope="row" class='idelemento2' hidden="true"><?= $subseccion['ID_SECCION'] ?></th>    

    
      <td class='id_nombre_depto'><?= $subseccion['NOMBRE_SUB_SECCION'] ?></td>
      <td><?= $secciones->get($subseccion['ID_SECCION'])[0]['NOMBRE_SECCION']?></td>



      <td>
      <button href="#" id="delete" role="button" class="btn btn-danger"><i class="icon fas fa-trash"></i></button>
      <button href="#"  id="edit" role="button" class="btn btn-primary col-5" ><i class="icon fas fa-pen"></i></button>
      
      </td>
    </tr>
    <?php endforeach; ?> 

       
  </tbody>
</table>

</div>