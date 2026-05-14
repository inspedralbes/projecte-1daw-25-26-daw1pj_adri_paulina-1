<?php include_once "../header.php";?>

<?php
$mysqli = include_once "../conexion.php";
$resultado = $mysqli->query("SELECT i.*, t.nom AS tecnic 
    FROM INCIDENCIA i LEFT JOIN TECNIC t ON i.tecnic = t.idTecnic 
    WHERE dataFinalitzacio IS NULL AND tecnic IS NULL ORDER BY prioritat ASC");
$incidencies = $resultado->fetch_all(MYSQLI_ASSOC);  
$departments = [1 => "Informàtica", 2 => "Català", 3 => "Matemàtiques", 4 => "Secretaria"];
?>

<link rel="stylesheet" href="../css/responsive.css">

<div class="container">
    <table class="table table-hover table-responsive">
        <thead class="thead-dark">
            <legend class="mt-5">Llista de totes les incidències:</legend>
            <tr>
                <th class="text-white" scope="col">ID</th>
                <th class="text-white" scope="col">Descripcio</th>
                <th class="text-white" scope="col">Data Creació</th>
                <th class="text-white" scope="col">Departament</th>
                <th class="text-white" scope="col">Tècnic</th>
                <th class="text-white" scope="col">Data Finalitzacio</th>
                <th class="text-white" scope="col">Tipus</th>
                <th class="text-white" scope="col">Prioritat</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($incidencies as $INCIDENCIA) { ?>
                <?php
                        if ($INCIDENCIA["prioritat"] == "Alta") {
                            $claseCss = "table-danger";
                        } elseif ($INCIDENCIA["prioritat"] == "Mitja") {
                            $claseCss = "table-warning";
                        } else {
                            $claseCss = "table-success";;
                        }
                    ?>
                <tr class="<?php echo $claseCss; ?>"> <!--Exita inyeccions XSS mitjançant htmlspecialchars()-->
                    <td><?php echo htmlspecialchars($INCIDENCIA["idIncidencia"])?></td>
                    <td><?php echo htmlspecialchars($INCIDENCIA["descripcio"] ?? 'Sense descripció')?></td>
                    <td><?php echo date('d-m-Y', strtotime($INCIDENCIA["data"]?? 'Falta data'))?></td>
                    <td><?php echo htmlspecialchars($departments[$INCIDENCIA["departament"]])?></td>
    <!--Fem un JOIN LEFT per obtenir només el nom del tècnic i mostar-ho, en comptes del seu ID-->
                    <td><?php echo htmlspecialchars($INCIDENCIA["tecnic"] ?? 'No assignat')?></td>
                    <td><?php echo htmlspecialchars($INCIDENCIA["dataFinalitzacio"] ?? 'No finalitzada')?></td>
                    <td><?php echo htmlspecialchars($INCIDENCIA["tipo"] ?? 'No assignat')?></td>
                    <td><?php echo htmlspecialchars($INCIDENCIA["prioritat"] ?? 'No assignada')?></td>
                    <td>
                        <a href="EditarAdmin.php?id=<?php echo htmlspecialchars($INCIDENCIA["idIncidencia"])?>">EDITAR</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../index.php" class="btn btn-primary rounded text-white btn-index">INICI</a>
    <a href="admin.php" class="btn btn-primary rounded text-white btn-index">TORNAR</a>
</div>


<?php include_once "../footer.php";?>