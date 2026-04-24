<?php include_once "header.php";?>


<?php
$mysqli = include_once "conexion.php";
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
            <th>Tècnic</th>
            <th>Data Finalitzacio</th>
            <th>Tipus</th>
            <th>Prioritat</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($incidencies as $INCIDENCIA) { ?>
            <tr>
                <td><?php echo $INCIDENCIA["idIncidencia"]?></td>
                <td><?php echo $INCIDENCIA["descripcio"]?></td>
                <td><?php echo $INCIDENCIA["data"]?></td>
                <td><?php echo $INCIDENCIA["departament"]?></td>
                <td><?php echo $INCIDENCIA["tecnic"]?></td>
                <td><?php echo $INCIDENCIA["dataFinalitzacio"]?></td>
                <td><?php echo $INCIDENCIA["tipo"]?></td>
                <td><?php echo $INCIDENCIA["prioritat"]?></td>
            </tr>           
        <?php } ?>
    </tbody>
</table>

<button class="btn btn-primary"><a href="index.php" class="text-light">Inici</a></button>


<?php include_once "footer.php";?>