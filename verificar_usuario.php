<?php

session_start();


header("Content-Type: text/javascript");
include("conexion.php");

$email = $_POST['email'];
$clave = $_POST['clave'];

$sql = "SELECT * FROM Usuario WHERE email='$email' AND clave='$clave'";

echo $sql;
$resultado = $conexion->query($sql);

if($fila = $resultado->fetch_assoc())
{
    $_SESSION["usuario"] = $fila["usuario"];
    $_SESSION["id"] = $fila["id"];
    $id = $_SESSION["id"];

    $sql2 = "UPDATE Usuario SET conexion=1 WHERE id='$id'";
    $rpta = $conexion->query($sql2);
    
    header('Location: chat.php');
}
else{
    header('Location: inicio.php');
}
$conexion->close();


?>