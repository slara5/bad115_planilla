<div id="tabla">

<table id="" class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr>
    <th>Correlativo</th>
    <th>identificador</th>
      <th>Nombre</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($unidades as $index => $unidad): ?>
    <tr>
    <th scope="row"><?=$index+1?></th>
    <th scope="row" class='idelemento'><?= $unidad['ID_UNIDAD'] ?></th>
      <td><?= $unidad['NOMBRE_UNIDAD'] ?></td>
      <td><button href="#"  button class="btn btn-navbar" id="delete" role="button" ><i class="fas fa-trash"></i></button></td>
    </tr>
    <?php endforeach; ?> 

       
  </tbody>
</table>
</table>

</div>