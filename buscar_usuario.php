<?php
session_start();

header("Content-Type: text/javascript");
include("conexion.php");



$data = json_decode(file_get_contents('php://input'), true);

$contactos = $_SESSION["contactos"];
$busqueda = $data["sms"];

$sql = "SELECT * FROM Usuario WHERE email LIKE '%$busqueda%'";

$resultado = $conexion->query($sql);

$datos = array();

while($fila = $resultado->fetch_assoc()){
    $i = 0;
    $bool;
    $item = '';
    $item .= '{"id": "' . $fila["id"];
    $item .= '", "email": "' . $fila["email"];
    while( $i < sizeof($contactos) ){
        if($contactos[$i] == $fila["id"]){
            $item .= '", "contacto": "1"}';
            $bool = true;
            break;
        }
        $i++;

    }
    if($bool == false){
        $item .= '", "contacto": "0"}';
    }
    array_push($datos, $item);
}

echo "[" . implode(", ", $datos) . "]";
$conexion->close();


?>
