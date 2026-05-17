<?php
$_SESSION['role'] = 'admin';
include_once "../header.php";

$mysqli = include_once "../conexion.php";
$resultado = $mysqli->query("SELECT i.*, t.nom AS tecnic 
    FROM INCIDENCIA i LEFT JOIN TECNIC t ON i.tecnic = t.idTecnic 
    ORDER BY prioritat ASC");
$incidencies = $resultado->fetch_all(MYSQLI_ASSOC);
$departments = [1 => "Informàtica", 2 => "Català", 3 => "Matemàtiques", 4 => "Secretaria"];
?>

<link rel="stylesheet" href="../css/responsive.css">

<div class="container">
    <div class="table-responsive-md">
        <table class="table table-hover">
            <thead class="thead-dark">
                <legend class="mt-5">Llista de totes les incidències:</legend>
                <tr>
                    <th class="text-white">ID</th>
                    <th class="text-white">Descripcio</th>
                    <th class="text-white">Data Creació</th>
                    <th class="text-white">Departament</th>
                    <th class="text-white">Tècnic</th>
                    <th class="text-white">Data Finalitzacio</th>
                    <th class="text-white">Tipus</th>
                    <th class="text-white">Prioritat</th>
                    <th class="text-center"><i class="bi bi-lock-fill" style="font-size: 18px; color: white;"></i></th>
                    <th class="text-center"><i class="bi bi-eraser-fill" style="font-size: 18px; color: white;"></i></th>
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
                            } elseif ($INCIDENCIA["prioritat"] == "Baixa"){
                                $claseCss = "table-success";;
                            }
                            else {
                                $claseCss = "table-default";
                            }
                        ?>
                    <tr class="<?php echo $claseCss; ?>"> <!--Exita inyeccions XSS mitjançant htmlspecialchars()-->
                        <td><?php echo htmlspecialchars($INCIDENCIA["idIncidencia"])?></td>
                        <td><?php echo htmlspecialchars($INCIDENCIA["descripcio"] ?? 'Sense descripció')?></td>
                        <td><?php echo date('d-m-Y', strtotime(($INCIDENCIA["data"]?? 'Falta data')))?></td>
                        <td><?php echo htmlspecialchars($departments[$INCIDENCIA["departament"]])?></td>
        <!--Fem un JOIN LEFT per obtenir només el nom del tècnic i mostar-ho, en comptes del seu ID-->
                        <td><?php echo htmlspecialchars($INCIDENCIA["tecnic"] ?? 'No assignat')?></td>
                        <td><?php echo htmlspecialchars($INCIDENCIA["dataFinalitzacio"] ?? 'No finalitzada')?></td>
                        <td><?php echo htmlspecialchars($INCIDENCIA["tipo"] ?? 'No assignat')?></td>
                        <td><?php echo htmlspecialchars($INCIDENCIA["prioritat"] ?? 'No assignada')?></td>
                        <td>
                            <a href="EditarAdmin.php?id=<?php echo htmlspecialchars($INCIDENCIA["idIncidencia"])?>">EDITAR</a>
                        </td>
                        <td>
                            <a href="eliminarIncid.php?id=<?php echo htmlspecialchars($INCIDENCIA["idIncidencia"])?>" 
                            class="btn btn-sm btn-danger" onclick="return confirm('¿Vols eliminar aquesta Incidencia?');"> ELIMINAR</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="../index.php" class="btn btn-primary rounded text-white btn-index">INICI</a>
        <a href="admin.php" class="btn btn-primary rounded text-white btn-index">TORNAR</a>
    </div>

</div>


<?php include_once "../footer.php"; ?>