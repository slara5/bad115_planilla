<div id="tabla">

<table class="table table-striped ">
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
    <th scope="row"><?=$index?></th>
    <th scope="row" class='idelemento'><?= $unidad['ID_UNIDAD'] ?></th>
      <td><?= $unidad['NOMBRE_UNIDAD'] ?></td>
      <td><button href="#"  button class="btn btn-navbar" id="delete" role="button" ><i class="fas fa-trash"></i></button></td>
    </tr>
    <?php endforeach; ?> 

       
  </tbody>
</table>
</table>



</div>
<script src="<?= base_url() ?>/js/unidades/unidades.js"></script>