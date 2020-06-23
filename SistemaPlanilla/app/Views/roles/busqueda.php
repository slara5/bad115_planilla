<div id="tabla">

<table id="" class="table table-bordered table-hover">
  <thead>
    <tr>
    <th>#</th>
    <th hidden="true">ID</th>
      <th>Nombre</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($roles as $index => $roles): ?>
    <tr>
    <th scope="row"><?=$index+1?></th>
    <th scope="row" class='idelemento' hidden="true"><?= $roles['ID_ROL'] ?></th>
      <td><?= $roles['NOMBRE_ROL'] ?></td>
      <td>
      <button href="#" id="delete" role="button" class="btn btn-danger col-5"><i class="far fa-trash-alt"></i></button>
      <button href="#"  id="edit" role="button" class="btn btn-primary col-5" ><i class="fas fa-pencil-alt"></i></button>
      </td>
    </tr>
    <?php endforeach; ?> 

       
  </tbody>
</table>

</div>