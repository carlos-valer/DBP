<?php

session_start();

header("Content-Type: text/javascript");
include("conexion.php");

$email = $_POST['email'];
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$sql = "INSERT INTO Usuario(id, email, usuario, clave, conexion, sala) VALUES (NULL,'$email', '$usuario', '$clave', '1' , NULL)";

$resultado = $conexion->query($sql);

if($resultado === TRUE){

	$consulta = "SELECT MAX(id) AS id FROM Usuario";
    $rpta = $conexion->query($consulta);

    $_SESSION["usuario"] = $usuario;
    $_SESSION["id"] = mysqli_result($rpta, 0);
    header('Location: chat.php');
}

else{
	header('Location: inicio.php');	
}

$conexion->close();
?>