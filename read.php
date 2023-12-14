<?php
	$sql_usuarios = "SELECT * FROM usuarios WHERE estado IN ('Activo','Inactivo') ORDER BY id_usuario,estado";
	$query_usuarios = mysqli_query($conn,$sql_usuarios);
	$row_usuarios = mysqli_fetch_all($query_usuarios,MYSQLI_ASSOC);
?>

<div class="tabla_usuarios">
	<div class="tittle_table">
		<h2>USUARIOS REGISTRADOS</h2>
	</div>
	<table border="1">
		<thead>
			<tr>
				<th>LOGIN</th>
				<th>NOMBRES</th>
				<th>APELLIDOS</th>
				<th>ROL</th>
				<th>ESTADO</th>
				<th>USUARIO CREA</th>
				<th>FECHA CREA</th>
				<th>ACCIONES</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($row_usuarios as $value): ?>
				<tr>
					<td><?=$value['login']?></td>
					<td><?=$value['nombres']?></td>
					<td><?=$value['apellidos']?></td>
					<td><?php if($value['id_rol']==1){echo"Administrador";}elseif($value['id_rol']==2){echo"Usuario";}else{echo"Visitante";}?></td>
					<td><?=$value['estado']?></td>
					<td><?=$value['id_usuario_crea']?></td>
					<td><?=$value['fecha_crea']?></td>
					<td>
						<form action="index.php" method="POST" accept-charset="utf-8">
							<button class="update" name="update" value="<?=$value['id_usuario']?>">Update</button>
							<button class="delete" name="delete" value="<?=$value['id_usuario']?>">Delete</button>
						</form>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>