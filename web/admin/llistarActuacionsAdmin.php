<?php include_once "../header.php";
$_SESSION['role'] = 'admin';

$mysqli = include_once "../conexion.php";
$id_tecnic = $_GET['id'] ?? null;
if ($id_tecnic) {
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

<div class="container">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-dark">
                <legend class="mt-5">Llista de totes les actuacions</legend>
                <tr>
                    <th class="text-white" scope="col">ID</th>
                    <th class="text-white" scope="col">Descripcio</th>
                    <th class="text-white" scope="col">Data Creació</th>
                    <th class="text-white" scope="col">Incidència</th>
                    <th class="text-white" scope="col">Visibilitat</th>
                    <th class="text-white" scope="col">Duració (min)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($actuacions) > 0): ?>
                    <?php foreach ($actuacions as $actuacio): ?>
                        <tr>
                            <td class="text-wrap"><?php echo htmlspecialchars($actuacio["idActuacio"] ?? 'Error: No té ID') ?></td>
                            <td class="text-wrap"><?php echo htmlspecialchars($actuacio["descripcio"]) ?></td>
                            <!-- Camviar l'output de la data -->
                            <td class="text-wrap"><?php echo date('d-m-Y', strtotime($actuacio["data"])) ?></td>
                            <td class="text-wrap"><?php echo htmlspecialchars($actuacio["incidencia"]) ?></td>
                            <td class="text-wrap"><?php echo ($actuacio["visible"] == 1) ? 'Públic' : 'Privat'; ?></td>
                            <td class="text-wrap"><?php echo htmlspecialchars($actuacio["duracio"] ?? 'No assignat') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No hi ha actuacions per a aquesta incidència.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
    <div class="d-flex flex-column flex-md-row gap-2 mt-4 mb-5">
        <a href="../index.php" class="btn btn-primary rounded text-white btn-index">INICI</a>
        <a href="admin.php" class="btn btn-primary rounded text-white btn-index">TORNAR</a>
    </div>
</div>



<?php include_once "../footer.php"; ?>