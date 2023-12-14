<?php
if (isset($_POST['guardar'])) {
	$nombres = trim($_POST['name']);
	$apellidos = trim($_POST['lastname']);
	$login = trim($_POST['login']);
	$id_rol = trim($_POST['rol']);

	if ($login != "") {
		$sql_login = "SELECT * FROM usuarios WHERE login = '$login'";
		$query_login = mysqli_query($conn,$sql_login);
		$num_rows_login = mysqli_num_rows($query_login);

		if ($num_rows_login==0) {
			if ($nombres != "" && $apellidos != "" && $login != "" && $id_rol != "") {
				$sql_insert_user = "INSERT INTO usuarios (login,nombres,apellidos,id_rol,estado,id_usuario_crea,fecha_crea,id_usuario_modifica,fecha_modifica) VALUES ('$login','$nombres','$apellidos',$id_rol,'Activo',1,NOW(),1,NOW())";
				$query_insert_user = mysqli_query($conn,$sql_insert_user);
			}
		}
	}
}

if (isset($_POST['update'])) {

	$id_usuario = $_POST['update'];
	$sql_usuario_update = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";
	$query_usuario_update = mysqli_query($conn, $sql_usuario_update);
	$row_usuario_update = mysqli_fetch_assoc($query_usuario_update);

	$nombres_update = $row_usuario_update['nombres'];
	$apellidos_update = $row_usuario_update['apellidos'];
	$login_update = $row_usuario_update['login'];
	$id_rol_update = $row_usuario_update['id_rol'];
	$estado_update = $row_usuario_update['estado'];
}

if (isset($_POST['updateUser'])) {
	$id_usuario_updater = $_POST['updateUser'];
	$nombres_updater = $_POST['name'];
	$apellidos_updater = $_POST['lastname'];
	$login_updater = trim($_POST['login']);
	$id_rol_updater = $_POST['rol'];
	$estado_updater = $_POST['estado'];
	if ($nombres_updater!="" && $apellidos_updater!="" && $login_updater!="" && $id_rol_updater!="" && $estado_updater!="") {

		$sql_verificar_login = "SELECT login FROM usuarios WHERE id_usuario = $id_usuario_updater";
		$query_verificar_login = mysqli_query($conn,$sql_verificar_login);
		$row_verificar_login = mysqli_fetch_assoc($query_verificar_login);
		$num_row_verificar_login = mysqli_num_rows($query_verificar_login);
		$login = trim($row_verificar_login['login']);

		if ($num_row_verificar_login>0) {
			$sql_login_updater = "SELECT id_usuario FROM usuarios WHERE login = '$login_updater' AND id_usuario != '$id_usuario_updater'";
			$query_login_updater = mysqli_query($conn,$sql_login_updater);
			$num_row_login_updater = mysqli_num_rows($query_login_updater);

			if ($num_row_login_updater==0) {
				$sql_update_usuario = "UPDATE usuarios SET login = '$login_updater',nombres = '$nombres_updater',apellidos = '$apellidos_updater', id_rol = $id_rol_updater, estado = '$estado_updater', id_usuario_modifica = 1, fecha_modifica = NOW() WHERE id_usuario = $id_usuario_updater";
				$query_update_usuario = mysqli_query($conn,$sql_update_usuario);
			}
		}

	}
}

if (isset($_POST['delete'])) {
	$id_delete = $_POST['delete'];
	$sql_delete_virtual = "UPDATE usuarios SET estado = 'Eliminado' WHERE id_usuario = $id_delete";
	$query_delete_virtual = mysqli_query($conn,$sql_delete_virtual);
}

?>
	<div class="tittle_div">
		<h1 class="tittle_h1">CRUD PHP ONLY</h1>
	</div>
	<div class="form">
		<form action="index.php" method="POST">
		<h3>REGISTRO DE DATOS</h3>
			<div class="group">
				<label for="name">Nombre: </label>
				<input type="text" id="name" name="name" value="<?php if(isset($_POST['guardar']) && !isset($query_insert_user) && $nombres != ""){echo $nombres;} if(isset($_POST['update'])){ echo $nombres_update; } if(isset($_POST['updateUser']) && !isset($query_update_usuario)){ echo $nombres_updater; }?>">
			</div>
			<?php
				if ((isset($_POST['guardar']) && $nombres == "") || (isset($_POST['updateUser']) && $nombres_updater == "")) {
					echo "<span class='alerta'>Ingrese Nombre</span>";
				}
			?>
			<div class="group">
				<label for="lastname">Apellidos: </label>
				<input type="text" id="lastname" name="lastname" value="<?php if(isset($_POST['guardar']) && !isset($query_insert_user) && $apellidos != ""){echo $apellidos;} if(isset($_POST['update'])){ echo $apellidos_update; } if(isset($_POST['updateUser']) && !isset($query_update_usuario)){ echo $apellidos_updater; }?>">
			</div>
			<?php
				if ((isset($_POST['guardar']) && $apellidos == "") || (isset($_POST['updateUser']) && $apellidos_updater == "")) {
					echo "<span class='alerta'>Ingrese Apellidos</span>";
				}
			?>
			<div class="group">
				<label for="login">Login: </label>
				<input type="text" id="login" name="login" value="<?php if(isset($_POST['guardar']) && !isset($query_insert_user) && $login != ""){echo $login;} if(isset($_POST['update'])){ echo $login_update; } if(isset($_POST['updateUser']) && !isset($query_update_usuario)){ echo $login_updater; }?>">
			</div>
			<?php
				if ((isset($_POST['guardar']) && $login == "") || (isset($_POST['updateUser']) && $login_updater == "")) {
					echo "<span class='alerta'>Ingrese Login</span>";
				}
			?>
			<div class="group">
				<label for="rol">Rol: </label>
				<select name="rol" id="rol">
					<option value="" <?php if(isset($_POST['guardar']) && !isset($query_insert_user) && $id_rol == ""){echo "selected";} if(isset($_POST['update']) && $id_rol_update == ""){echo "selected";} if(isset($_POST['updateUser']) && !isset($query_update_usuario) && $id_rol_updater == ""){echo "selected";} ?>>--Seleccione Rol--</option>
					<option value="1" <?php if(isset($_POST['guardar']) && !isset($query_insert_user) && $id_rol == "1"){echo "selected";} if(isset($_POST['update']) && $id_rol_update == "1"){echo "selected";} if(isset($_POST['updateUser']) && !isset($query_update_usuario) && $id_rol_updater == "1"){echo "selected";}?>>Administrador</option>
					<option value="2" <?php if(isset($_POST['guardar']) && !isset($query_insert_user) && $id_rol == "2"){echo "selected";} if(isset($_POST['update']) && $id_rol_update == "2"){echo "selected";} if(isset($_POST['updateUser']) && !isset($query_update_usuario) && $id_rol_updater == "2"){echo "selected";}?>>Usuario</option>
					<option value="3" <?php if(isset($_POST['guardar']) && !isset($query_insert_user) && $id_rol == "3"){echo "selected";} if(isset($_POST['update']) && $id_rol_update == "3"){echo "selected";} if(isset($_POST['updateUser']) && !isset($query_update_usuario) && $id_rol_updater == "3"){echo "selected";}?>>Visitante</option>
				</select>
			</div>
			<?php
				if ((isset($_POST['guardar']) && $id_rol == "") || (isset($_POST['updateUser']) && $id_rol_updater == "")) {
					echo "<span class='alerta'>Seleccione Rol</span>";
				}
			?>
			<div class="group" style="<?php if(!isset($_POST['update']) && !isset($_POST['updateUser'])){ echo 'display:none'; }?>">
				<label for="estado">Estado: </label>
				<select name="estado" id="estado">
					<option value="" <?php if(isset($_POST['update']) && $estado_update == ""){echo "selected";} if(isset($_POST['updateUser']) && !isset($query_update_usuario) && $estado_updater == ""){echo "selected";}?>>--Seleccione Estado--</option>
					<option value="Activo" <?php if(isset($_POST['update']) && $estado_update == "Activo"){echo "selected";} if(isset($_POST['updateUser']) && !isset($query_update_usuario) && $estado_updater == "Activo"){echo "selected";}?>>Activo</option>
					<option value="Inactivo" <?php if(isset($_POST['update']) && $estado_update == "Inactivo"){echo "selected";} if(isset($_POST['updateUser']) && !isset($query_update_usuario) && $estado_updater == "Inactivo"){echo "selected";}?>>Inactivo</option>
				</select>
			</div>
			<?php
				if ((isset($_POST['update']) && $estado_update == "") || (isset($_POST['updateUser']) && $estado_updater == "")) {
					echo "<span class='alerta'>Seleccione Estado</span>";
				}
			?>
			<div class="group">
				<button class="updateUser" name="updateUser" style="<?php if(!isset($_POST['update']) && !isset($_POST['updateUser']) ){ echo 'display:none'; }?>" value="<?php if(isset($_POST['update'])){echo $id_usuario; } if(isset($_POST['updateUser'])){echo $id_usuario_updater; }?>">Actualizar</button>
				<button class="guardar" name="guardar" style="<?php if(isset($_POST['update']) || isset($_POST['updateUser'])){ echo 'display:none'; }?>">Guardar</button>
				<button class="cancelar" name="cancelar">Cancelar</button>
			</div>
		</form>
	</div>
	<div class="mensaje">
		<?php
			if (isset($_POST['guardar']) && $nombres != "" && $apellidos != "" && $login != "" && $id_rol != "" && $num_rows_login==0) {
				if (!$query_insert_user) {
					echo "<span class='msgERR'>Error en la insercion ".mysqli_error($conn)."</span>";
				}
				else
				{
					echo "<span class='msgOK'>Usuario: <b>$login</b> insertado con éxito!</span>";
				}
			}
			if (isset($_POST['guardar']) && $login != "") {
				if ($num_rows_login!=0) {
					echo "<span class='msgERR' style='font-size:1.5rem;'>Alerta: Usuario: <b>$login</b> ya existe!</span>";
				}
			}
			if (isset($_POST['updateUser'])) {
				if (isset($query_update_usuario)) {
					if ($login != $login_updater) {
						echo "<span class='msgOK'>Usuario: <b>$login</b> actualizado con éxito a <b>$login_updater</b>!</span>";
					}else{
						echo "<span class='msgOK'>Usuario: <b>$login</b> actualizado con éxito!</span>";
					}
				}
				if ($nombres_updater!="" && $apellidos_updater!="" && $login_updater!="" && $id_rol_updater!="" && $estado_updater!="") {
					if (!isset($query_update_usuario)) {
						echo "<span class='msgERR'>Error en la Actualización, El usuario <b>$login_updater</b> ya existe</span>";
					}
				}
			}
			if (isset($_POST['delete'])) {
				if ($query_delete_virtual) {
					echo "<span class='msgOK'>Usuario eliminado con éxito!</span>";
				}
				else{
					echo "<span class='msgERR'>Error en la eliminación ".mysqli_error($conn)."</span>";
				}
			}
		?>
	</div>
<?php
?>