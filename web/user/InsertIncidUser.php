
<div>
    <?php
include_once "../header.php"; 
include_once "../conexion.php"; // $mysqli está disponible amn "con.php"

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $desc = $_POST["descripcion"]; /*$variable  [columna] */
    $dept = $_POST["departament"];
#id i data es autocompleten amb ID autoincremental i SYSDATE()
    $sentencia = $mysqli -> prepare("INSERT INTO INCIDENCIA (descripcio, data, departament)
    VALUES (?,SYSDATE(),?)"
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
</div>
<div>
    <a href="../index.php" class="btn rounded text-white btn-index" style="background-color:#278DE6">INICI</a>
    <a href="CrearIncidUser.php" class="btn rounded text-white btn-index" style="background-color:#129987">VOLVER</a>

</div>
