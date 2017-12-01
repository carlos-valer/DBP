<?php

session_start();

header("Content-Type: text/javascript");
include("conexion.php");

$id = $_SESSION["id"];
$sql = "UPDATE Usuario SET conexion=0 WHERE id='$id'";
$rpta = $conexion->query($sql);
session_destroy();

header('Location: inicio.php');

?>