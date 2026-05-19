<?php
require_once "conexion.php";
include_once "header.php";

if (!isset($_GET['id'])) {
    echo "Introdueix un ID vàlid.";
    exit;
}

$id = $_GET['id'];

$sql = "SELECT i.*, d.nom AS nomDept, t.nom AS nomTech FROM INCIDENCIA i LEFT JOIN DEPARTAMENT d ON i.departament = d.idDepartament LEFT JOIN TECNIC t ON i.tecnic = t.idTecnic  WHERE i.idIncidencia = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id);

$stmt->execute();

$result = $stmt->get_result();
/* si no encuentra (= 0) */
if ($result->num_rows === 0) {
    echo "No s'ha trobat la incidència";
    exit;
}

$incidencia = $result->fetch_assoc();
$sql_actuaciones = "SELECT * FROM ACTUACIO WHERE incidencia = ? AND visible = 1"; 
$stmt_act = $mysqli->prepare($sql_actuaciones);
$stmt_act->bind_param("i", $id);
$stmt_act->execute();
$res_actuaciones = $stmt_act->get_result();
$actuaciones = $res_actuaciones->fetch_all(MYSQLI_ASSOC);
?>


<div class="table-responsive">
    <div class="container">
        <h1 class="mt-5 text-primary fw-bold">Incidència <?= htmlspecialchars($incidencia['idIncidencia']) ?></h1>

        <legend>Detalls de la incidència</legend>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th class="text-white">ID</th>
                    <th class="text-white">Descripció</th>
                    <th class="text-white">Data Creació</th>
                    <th class="text-white">Departament</th>
                    <th class="text-white">Data Finalització</th>
                    <th class="text-white">Tipo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= htmlspecialchars($incidencia['idIncidencia']) ?></td>
                    <td><?= htmlspecialchars($incidencia['descripcio'] ?? 'Sense descripció') ?></td>
                    <td><?= date('d-m-Y', strtotime($incidencia['data'])) ?></td>
                    <td><?= htmlspecialchars($incidencia['nomDept'] ?? 'Desconegut') ?></td>
                    <td><?= date('d-m-Y', strtotime($incidencia['dataFinalitzacio']) ?? 'No Finalitzada') ?></td>
                    <td><?= htmlspecialchars($incidencia['tipo'] ?? 'No assignat') ?></td>
                </tr>
            </tbody>
        </table>
        <div class="container mt-4">
            <div class="row justify-content-end">
                <div class="col-md-7">
                    <h3 class="fw-bold" style="color: #002d54;">Actuacions realitzades</h3>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped">
                            <thead class="text-white thead-dark">
                                <tr>
                                    <th>Data</th>
                                    <th>Descripció</th>
                                    <th>Temps (min)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($actuaciones) > 0): ?>
                                    <?php foreach ($actuaciones as $act): ?>
                                        <tr>
                                            <td><?= date('d-m-Y', strtotime($act['data'])) ?></td>
                                            <td><?= htmlspecialchars($act['descripcio']) ?></td>
                                            <td><?= htmlspecialchars($act['duracio'] ?? '0') ?>'</td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">No hi ha actuacions per aquesta incidència.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <a href="../index.php" class="btn btn-primary rounded text-white btn-index">INICI</a>
            <a href="CrearIncidUser.php" class="btn btn-primary rounded text-white btn-index">TORNAR</a>
        </div>
    </div>
</div>

<?php include_once "footer.php"; ?>