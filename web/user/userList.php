<?php include_once "../header.php";?>

<?php
$mysqli = include_once "../conexion.php";
$resultado = $mysqli->query("SELECT * FROM INCIDENCIA");
$incidencies = $resultado->fetch_all(MYSQLI_ASSOC);  
?>
<table class="table">
    <thead>
        <legend>Llista d'incidències completa</legend>
        <tr>
            <th>ID</th>
            <th>Descripcio</th>
            <th>Data Creació</th>
            <th>Departament</th>
            <th>Data Finalitzacio</th>
            <th>Tipus</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($incidencies as $INCIDENCIA) { ?>
            <tr> <!--Evita XSS quan es fa echo de la BD en cas que es guardi una "comanda" maliciosa-->
                <td><?php echo htmlspecialchars($INCIDENCIA["idIncidencia"])?></td>
                <td><?php echo htmlspecialchars($INCIDENCIA["descripcio"])?></td>
                <td><?php echo htmlspecialchars($INCIDENCIA["data"])?></td>
                <td><?php echo htmlspecialchars($INCIDENCIA["departament"])?></td>
                <td><?php echo htmlspecialchars($INCIDENCIA["dataFinalitzacio"])?></td>
                <td><?php echo htmlspecialchars($INCIDENCIA["tipo"])?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<a href="../index.php" class="btn rounded text-white btn-index" style="background-color:#129987">INICI</a>
<a href="CrearIncidUser.php" class="btn rounded text-white btn-index" style="background-color:#129987">VOLVER</a>

<?php include_once "../footer.php";?>