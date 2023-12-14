<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "test";

	// crear DB en mysql
	// CREATE DATABASE IF NOT EXISTS test

#	---------------------CONEXION PROCEDIMENTAL---------------------
	// $conexion = mysqli_connect($servername,$username,$password,$dbname);

	// if (!$conexion) {
	// 	die("Conexión Fallida".mysqli_connect_error());
	// }
	// else{
	// 	echo 'conectado!';
	// }
	// mysqli_close($conexion);

#	---------------------CONEXION POO---------------------
	$conn = new mysqli($servername,$username,$password,$dbname);

	if ($conn->connect_error) {
		die("Conexión Fallida ".$conn->connect_error);
	}
	// else
	// {
	// 	echo 'conectado!';
	// }
	// $conn->close();
# ------------------------CREACION TABLA USUARIOS------------------------

	$sql_create_table = "
	CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(30),
    nombres VARCHAR(30),
    apellidos VARCHAR(30),
    id_rol INT(11),
	estado VARCHAR (150),
	id_usuario_crea INT (11),
	fecha_crea DATETIME ,
	id_usuario_modifica INT (11),
	fecha_modifica DATETIME)
	";
	// $query_create_table = mysqli_query($conn,$sql_create_table);
	$query_create_table = $conn->query($sql_create_table);

	if ($query_create_table === TRUE) {
		echo "Tablea creada con exito y tabla ya existente";
	}else{
		echo "Error en la creacion de la tabla";
	}
?>