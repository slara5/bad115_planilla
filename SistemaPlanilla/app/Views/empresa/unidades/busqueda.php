<table class="table table-striped ">
  <thead class="thead-dark">
    <tr>
    <th>Correlativo</th>
      <th>Nombre</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($unidades as $index => $unidad): ?>
    <tr>
    <td><?= $index ?></td>
      <td><?= $unidad['NOMBRE_UNIDAD'] ?></td>
      <td><button class="btn btn-navbar" onclick="borrar(<?=$unidad['ID_UNIDAD']?>)">
            <i class="fas fa-trash"></i>
          </button></td>
    </tr>
    <?php endforeach; ?> 

       
  </tbody>
</table>
</table>

