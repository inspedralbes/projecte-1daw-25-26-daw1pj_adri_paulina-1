<?php include_once "../header.php";
# Incloem capçelera i la connexio a la BD
$mysqli = include_once "../conexion.php";

// Consulta per obtenir totes les dades de INCIDENCIA
$resultado = $mysqli->query("SELECT * FROM INCIDENCIA");
$incidencies = $resultado->fetch_all(MYSQLI_ASSOC);  
# Creem mapa per mostrar nom_dept en comptes del seu ID
$departments = [1 => "Informàtica", 2 => "Català", 3 => "Matemàtiques", 4 => "Secretaria"];
?>

<div class="table-responsive">
    <div class="container">
            <table class="table table-hover">
            <thead class="thead-dark">
                <legend class="mt-5">Llista d'incidències completa</legend>
                <tr>
                    <th class="text-white" scope="col">ID</th>
                    <th class="text-white" scope="col">Descripcio</th>
                    <th class="text-white" scope="col">Data Creació</th>
                    <th class="text-white" scope="col">Departament</th>
                    <th class="text-white" scope="col">Data Finalitzacio</th>
                    <th class="text-white" scope="col">Tipus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($incidencies as $INCIDENCIA) { ?>
                    <tr> <!--Evita injeccions XSS quan es fa echo de la BD en cas que es guardi una "comanda" maliciosa-->
                        <td><?php echo htmlspecialchars($INCIDENCIA["idIncidencia"])?></td>
                        <td><?php echo htmlspecialchars($INCIDENCIA["descripcio"] ?? 'Sense descripció')?></td>
                        <td><?php echo date('d-m-Y', strtotime($INCIDENCIA["data"]))?></td>
                        <td><?php echo htmlspecialchars($departments[$INCIDENCIA["departament"]])?></td>
                        <td><?php echo htmlspecialchars($INCIDENCIA["dataFinalitzacio"]?? 'No Finalitzada')?></td>
                        <td><?php echo htmlspecialchars($INCIDENCIA["tipo"]?? 'No assignat') ?></td> <!-- No pot tenir valors NULL: afeguim ?? '' -->
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="../index.php" class="btn btn-primary rounded text-white btn-index">INICI</a>
        <a href="CrearIncidUser.php" class="btn btn-primary rounded text-white btn-index">TORNAR</a>

    </div>
</div>


<?php include_once "../footer.php";?>
