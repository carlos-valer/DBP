<?php

session_start();


header("Content-Type: text/javascript");
include("conexion.php");

$id = $_SESSION["id"];

$sql = "SELECT * FROM Contacto WHERE id_emisor='$id' or id_receptor='$id'";

$resultado = $conexion->query($sql);

$contactos = array();


while($fila = $resultado->fetch_assoc())
{
	if($fila["id_emisor"] == $id){
		$item = $fila["id_receptor"];
	}
	else{
	   	$item = $fila["id_emisor"];
	}
array_push($contactos, $item);
}

$_SESSION["contactos"]= $contactos;

$datos = array();

for($i = 0;$i < sizeof($contactos);$i++)
{
	$consulta = "SELECT usuario, conexion FROM Usuario WHERE id = '$contactos[$i]'";
 	$result = $conexion->query($consulta);
	$user = $result->fetch_assoc();
	$info = '{"id": "' . $contactos[$i] . '", "usuario": "' . $user["usuario"] . '", "conexion": "' . $user["conexion"] . '"}';

 	array_push($datos, $info);
}

echo "[" . implode(", ", $datos) . "]";

$conexion->close();

?>