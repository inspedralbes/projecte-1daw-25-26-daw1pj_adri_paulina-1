<?php
$_SESSION['role'] = 'user';

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
}
?>

<?php if (isset($idIncidencia)): ?>
    <div class='container mt-5 text-center'>
        <img src='../img/AnimatedForm.gif' alt='A gif de un formulario siendo enviado' class='img-fluid mb-5 rounded shadow' style='max-width: 300px;'>
        <h1>Incidència registrada amb éxit! </h1>
        <p>ID de la incidència: <?php echo $idIncidencia; ?></p>
        <a href='CrearIncidUser.php' class='btn btn-primary btn-index'>TORNAR</a>
    </div>
<?php endif; ?>
