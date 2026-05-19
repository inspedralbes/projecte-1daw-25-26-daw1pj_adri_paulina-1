<?php include_once "../header.php";
ini_set('display_errors', 1); error_reporting(E_ALL);
$_SESSION['role'] = 'tecnic';

if (!isset($mysqli)) { $mysqli = include "../conexion.php"; }
$idIncidencia = $_GET['id'] ?? $_GET['idIncidencia'] ?? null;
if ($idIncidencia) {
    $sentencia = $mysqli->prepare("SELECT * FROM ACTUACIO WHERE incidencia = ?");
    $sentencia->bind_param("i", $idIncidencia);
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
                <legend class="mt-5">Llista de les teves actuacions</legend>
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
                            <td><?php echo htmlspecialchars($actuacio["idActuacio"]) ?></td>
                            <td><?php echo htmlspecialchars($actuacio["descripcio"]) ?></td>
                            <td><?php echo htmlspecialchars($actuacio["data"]) ?></td>
                            <td><?php echo htmlspecialchars($actuacio["incidencia"]) ?></td>
                            <td><?php echo ($actuacio["visible"] == 1) ? 'Públic' : 'Privat'; ?></td>
                            <td><?php echo htmlspecialchars($actuacio["duracio"] ?? 'No assignat') ?></td>
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
        <a href="tecnic.php" class="btn btn-primary rounded text-white btn-index">TORNAR</a>
    </div>
</div>

<?php include_once "../footer.php"; ?>