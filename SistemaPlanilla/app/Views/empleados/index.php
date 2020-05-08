<table class="table table-striped ">
  <thead class="thead-dark">
    <tr>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Correo Personal</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($empleados as $index => $empleado): ?>
    <tr>
      <td><?= $empleado['NOMBRE_PRIMERO'].' '.$empleado['NOMBRE_SEGUNDO'] ?></td>
      <td><?= $empleado['APELLIDO_PATERNO'].' '.$empleado['APELLIDO_MATERNO'] ?></td>
      <td><?= $empleado['CORREO_ELECTRONICO_PERSONAL']?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</table>