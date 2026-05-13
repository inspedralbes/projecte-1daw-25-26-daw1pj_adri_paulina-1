<?php include_once "../header.php";

$mysqli = include_once "../conexion.php";
$id_tecnic = $_GET['id'] ?? null;
if($id_tecnic){
    $sentencia = $mysqli->prepare("SELECT a.* FROM ACTUACIO a INNER JOIN INCIDENCIA i ON a.incidencia = i.idIncidencia WHERE i.tecnic = ?");
    $sentencia->bind_param("i", $id_tecnic);
    $sentencia->execute();
    $resultado = $sentencia->get_result();
    $actuacions = $resultado->fetch_all(MYSQLI_ASSOC);
    $sentencia->close();
} else {
    $actuacions = [];
}
?>

<div class="table-responsive">
    <div class="container">
            <table class="table">
            <thead>
                <legend>Llista de totes les actuacions</legend>
                <tr>
                    <th>ID</th>
                    <th>Descripcio</th>
                    <th>Data Creació</th>
                    <th>Incidència</th>
                    <th>Visibilitat</th>
                    <th>Duració (min)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($actuacions) > 0): ?>
                    <?php foreach ($actuacions as $actuacio): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($actuacio["idActuacio"] ?? 'Error: No té ID') ?></td>
                        <td><?php echo htmlspecialchars($actuacio["descripcio"])?></td>
                    <!-- Camviar l'output de la data -->
                        <td><?php echo date('d-m-Y', strtotime($actuacio["data"])) ?></td>
                        <td><?php echo htmlspecialchars($actuacio["incidencia"]) ?></td>
                        <td><?php echo ($actuacio["visible"] == 1) ? 'Públic' : 'Privat'; ?></td>
                        <td><?php echo htmlspecialchars($actuacio["duracio"] ?? 'No assignat')?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No hi ha actuacions per a aquesta incidència.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="../index.php" class="btn btn-primary rounded text-white btn-index">INICI</a>
        <a href="listTecnics.php" class="btn btn-primary rounded text-white btn-index">TORNAR</a>
    </div>
</div>



<?php include_once "../footer.php";?>
