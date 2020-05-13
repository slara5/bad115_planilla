<table id="datos" class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr>
      <th>Usuario</th>
      <th>Nombres</th>
      <th>Apellidos</th>
      <th>Activo</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($usuarios as $index => $usuario): ?>
      <tr>
        <td><?= $usuario['USUARIO'] ?></td>
        <td><?= $usuario['NOMBRES'] ?></td>
        <td><?= $usuario['APELLIDOS'] ?></td>
        <td>
          <?php
            $activo = ($usuario['ACTIVO'] == 1) ? "ACTIVO" : "INACTIVO";
            echo $activo; ?>
         </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>