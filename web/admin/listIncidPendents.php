<?php include_once "../header.php";?>

<?php
$mysqli = include_once "../conexion.php";
$resultado = $mysqli->query("SELECT i.*, t.nom AS tecnic 
    FROM INCIDENCIA i LEFT JOIN TECNIC t ON i.tecnic = t.idTecnic 
    WHERE dataFinalitzacio IS NULL ORDER BY prioritat ASC");
$incidencies = $resultado->fetch_all(MYSQLI_ASSOC);  
$departments = [1 => "Informàtica", 2 => "Català", 3 => "Matemàtiques", 4 => "Secretaria"];
?>

<link rel="stylesheet" href="../css/responsive.css">

<table class="table table-hover">
    <thead>
        <legend>Llista de totes les incidències:</legend>
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
                <td><?php echo htmlspecialchars($INCIDENCIA["descripcio"])?></td>
                <td><?php echo htmlspecialchars($INCIDENCIA["data"])?></td>
                <td><?php echo htmlspecialchars($departments[$INCIDENCIA["departament"]])?></td>
<!--Fem un JOIN LEFT per obtenir només el nom del tècnic i mostar-ho, en comptes del seu ID-->
                <td><?php echo htmlspecialchars($INCIDENCIA["tecnic"])?></td>
                <td><?php echo htmlspecialchars($INCIDENCIA["dataFinalitzacio"] ?? 'No finalitzada')?></td>
                <td><?php echo htmlspecialchars($INCIDENCIA["tipo"])?></td>
                <td><?php echo htmlspecialchars($INCIDENCIA["prioritat"])?></td>
                <td>
                    <a href="EditarAdmin.php?id=<?php echo htmlspecialchars($INCIDENCIA["idIncidencia"])?>">EDITAR</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<a href="../index.php" class="btn rounded text-white btn-index" style="background-color:#278DE6">INICI</a>
<a href="admin.php" class="btn rounded text-white btn-index" style="background-color:#278DE6">VOLVER</a>

<?php include_once "../footer.php";?>