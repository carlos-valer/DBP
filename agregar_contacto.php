<?php
session_start();

header("Content-Type: text/javascript");
include("conexion.php");

$data = json_decode(file_get_contents('php://input'), true);

$mensaje = $data["mensaje"];
$id_contacto = $data["id_contacto"];
$id_emisor = $_SESSION["id"];

$sql = "INSERT INTO Contacto(id_emisor, id_receptor) VALUES ('$id_emisor', '$id_contacto')";

$resultado = $conexion->query($sql);

if($resultado == TRUE){
	echo "contacto agregado";
}
else{
	echo "contacto no se pudo agregar";
}
$conexion->close();


?>
