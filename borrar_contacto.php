<?php
session_start();

header("Content-Type: text/javascript");
include("conexion.php");

$data = json_decode(file_get_contents('php://input'), true);

$mensaje = $data["mensaje"];
$id_contacto = $data["id_contacto"];
$id_emisor = $_SESSION["id"];

$sql = "DELETE FROM Contacto WHERE (id_emisor='$id_contacto' and id_receptor='$id_emisor') or (id_emisor='$id_emisor' and id_receptor='$id_contacto')";

$resultado = $conexion->query($sql);

if($resultado == TRUE){
	echo "contacto borrado";
}
else{
	echo "contacto no se pudo borrar";
}
$conexion->close();


?>
