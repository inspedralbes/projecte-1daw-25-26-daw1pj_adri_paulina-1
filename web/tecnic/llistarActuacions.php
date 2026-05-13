<?php include_once "../header.php";

$mysqli = include_once "../conexion.php";
$idIncidencia = $_GET['id'] ?? $_GET['idIncidencia'] ?? null;
if($idIncidencia){
    $sentencia = $mysqli->prepare("SELECT idActuacio, descripcio, DATE(data) AS fecha, incidencia, visible, duracio FROM ACTUACIO WHERE incidencia = ?");
    $sentencia->bind_param("i", $idIncidencia);
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
                <legend>Llista d'actuacions completa</legend>
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
                        <td><?php echo htmlspecialchars($actuacio["idActuacio"]) ?></td>
                        <td><?php echo htmlspecialchars($actuacio["descripcio"])?></td>
                        <td><?php echo htmlspecialchars($actuacio["fecha"]) ?></td>
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
        <a href="tecnic.php" class="btn btn-primary rounded text-white btn-index">TORNAR</a>
    </div>
</div>

<?php include_once "../footer.php";?>
