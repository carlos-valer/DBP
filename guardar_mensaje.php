<?php
session_start();

header("Content-Type: text/javascript");
include("conexion.php");

$data = json_decode(file_get_contents('php://input'), true);

$mensaje = $data["mensaje"];
$id_receptor = $data["id_receptor"];
$id_emisor = $_SESSION["id"];

$sql = "INSERT INTO Chat(id_emisor, id_receptor, mensaje, fecha) VALUES ('$id_emisor','$id_receptor', '$mensaje', NULL)";

$resultado = $conexion->query($sql);

if($resultado === TRUE){
	echo "mensaje enviado";
}
else{
	echo "mensaje fallido";
}
$conexion->close();


?>
