<?php
$host = "db";
$usuario = "user";
$contrasenia = "123456";
$base_de_datos = "incidencies";
$mysqli = new mysqli($host, $usuario, $contrasenia, $base_de_datos);
$mysqli->set_charset("utf8mb4");
if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
return $mysqli;