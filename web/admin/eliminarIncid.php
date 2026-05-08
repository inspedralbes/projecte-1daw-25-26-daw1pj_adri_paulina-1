<?php
    $mysqli = include_once "../conexion.php";
    $id = $_GET["id"];
    $sentencia = $mysqli->prepare("DELETE FROM INCIDENCIA WHERE idIncidencia = ?");
    $sentencia->bind_param("i", $id);
    $sentencia->execute();
    header("Location: listIncidAdmin.php");
    $sentencia->close();
    $mysqli->close();
?>