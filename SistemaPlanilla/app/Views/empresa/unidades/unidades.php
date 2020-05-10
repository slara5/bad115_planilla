<table class="table table-striped ">
  <thead class="thead-dark">
    <tr>
    <th>numero</th>
      <th>Nombre</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($unidades as $index => $unidad): ?>
    <tr>
    <td><?= $index ?></td>
      <td><?= $unidad['NOMBRE_UNIDAD'] ?></td>
    </tr>
    <?php endforeach; ?> 
       
  </tbody>
</table>
</table>



