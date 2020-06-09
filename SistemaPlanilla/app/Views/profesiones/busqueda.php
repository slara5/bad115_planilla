<div id="tabla">

<table id="" class="table table-bordered table-hover">
  <thead >
    <tr>
    <th>Correlativo</th>
    <th hidden="true">identificador</th>
      <th>Nombre</th>
      <th>Es oficio</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($profesiones as $index => $profesion): ?>
    <tr>
    <th scope="row"><?=$index+1?></th>
    <th scope="row" class='idelemento' hidden="true"><?= $profesion['ID_PROFESION_OFICIO'] ?></th>
    <td class='id_nombre_profesion'><?= $profesion['NOMBRE_PROFESION'] ?></td>

      <?php if ( $profesion['ES_OFICIO']) : ?>

      <td class='esoficio' value="1"> si</td>

        <?php else : ?>
        <td class='esoficio' value="0" >no </td>

    <?php endif ?>

    
      <td>
      <button href="#" id="delete" role="button" class="btn btn-danger"><i class="icon fas fa-trash"></i></button>
      <button href="#"  id="edit" role="button" class="btn btn-primary col-5" ><i class="icon fas fa-pen"></i></button>
      
      </td>
    </tr>
    <?php endforeach; ?> 

       
  </tbody>
</table>

</div>