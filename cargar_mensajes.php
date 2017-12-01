<?php
session_start();

header("Content-Type: text/javascript");
include("conexion.php");

$data = json_decode(file_get_contents('php://input'), true);

$id_contacto = $data["id_contacto"];
$id = $_SESSION["id"];

$sql = "SELECT id_emisor, mensaje, fecha FROM Chat WHERE (id_emisor='$id' or id_emisor='$id_contacto') AND (id_receptor='$id' or id_receptor='$id_contacto')";

$resultado = $conexion->query($sql);

$datos = array();

while($fila = $resultado->fetch_assoc()){
	
	$fecha = date("g:i a",strtotime($fila["fecha"]));
	$item = '{"id_emisor": "' . $fila["id_emisor"];
	$item .= '", "mensaje": "' . $fila["mensaje"];
	$item .= '", "fecha": "' . $fecha . '"}';

	array_push($datos, $item);
}

echo "[" . implode(", ", $datos) . "]";


$conexion->close();


?>
