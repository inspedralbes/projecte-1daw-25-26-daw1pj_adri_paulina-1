<?php
include_once "header.php";
include_once "conexion.php"; // $mysqli = 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $desc = $_POST["descripcion"]; /*$variable  [columna] */
    $fecha = $_POST["data"];
    $dept = $_POST["departament"];

    $sentencia = $mysqli -> prepare("INSERT INTO INCIDENCIA (descripcio, data, departament)
    VALUES (?,?,?)"
    );
    $sentencia -> bind_param("ssi", $desc, $fecha, $dept);
            /*data type we wanna introduce: string, date, int */
    $sentencia -> execute();
    // Un cop fet l'INSERT, obtenim l'ID de la nova fila
    $id = $mysqli -> query("SELECT LAST_INSERT_ID()") -> fetch_row()[0];
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<h1 class="d-flex align-items-center">Incidència creda amb éxit</h1>
<?php include_once "header.php"; ?>