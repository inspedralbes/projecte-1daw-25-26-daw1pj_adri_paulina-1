<?php
$mysqli = include_once "../conexion.php";

#només actualitzem el que editem
$idIncidencia = $_POST["idIncidencia"];
$tecnic = $_POST["tecnic"];
$tipo = $_POST["tipo"];
$prioritat = $_POST["prioritat"];

$sentencia = $mysqli -> prepare("UPDATE INCIDENCIA SET
tecnic = ?, tipo = ?, prioritat = ?
WHERE idIncidencia = ?");

$sentencia -> bind_param("issi", $tecnic, $tipo, $prioritat, $idIncidencia);
# PORTEGIT amb prepare() & bind_param() 
$sentencia -> execute();

header("Location: listIncidAdmin.php");
?>