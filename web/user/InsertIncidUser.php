<?php
include_once "../header.php"; 
include_once "../conexion.php"; // $mysqli está disponible amn "con.php"

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $desc = $_POST["descripcion"]; /*$variable  [columna] */
    $dept = $_POST["departament"];
#id i data es autocompleten amb ID autoincremental i SYSDATE()
    $sentencia = $mysqli -> prepare("INSERT INTO INCIDENCIA (descripcio, departament)
    VALUES (?,?)"
    );
    // prepare() & bind_param() preveuen SQL injections
    $sentencia -> bind_param("si", $desc, $dept);
            /*data type we wanna introduce: string, date, int */
    $sentencia -> execute();
    // Un cop fet l'INSERT, obtenim l'ID de la nova fila
    $idIncidencia = $mysqli -> insert_id; // últim ID (el de la nova fila insertada)

echo "<h1>Incidència registrada amb éxit! </h1>";
echo " ID de la incidència: " . $idIncidencia . "";
}

?>
