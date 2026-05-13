<?php
require_once "conexion.php";

if (!isset($_GET['id'])) {
    echo "Introdueix un ID vàlid.";
    exit;
}

$id = $_GET['id'];

$sql = "SELECT i.*, d.nom AS nomDept, t.nom AS nomTech FROM INCIDENCIA i LEFT JOIN DEPARTMENT d ON i.department = d.idDepartment LEFT JOIN TECNIC t ON i.tecnic = t.idTecninc  WHERE i.idIncidencia = ?";
$stmt = $conn ->prepare($sql);
$stmt -> bind_param("i", $id);

$stmt -> execute();

$result = $stmt -> get_result();
/* si no encuentra (= 0) */
if ($result -> num_rows === 0) {
    echo "No s'ha trobat la incidència";
    exit;
} 

$incidencia = $result -> fetch_assoc();
?>

<h1>Incidència <?= htmlspecialchars($incidencia['idIncidencia']) ?></h1>

<div class="table-responsive">
    <legend>Detalls de la incidència</legend>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Descripció</th>
                <th>Data Creació</th>
                <th>Departament</th>
                <th>Data Finalització</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= htmlspecialchars($incidencia['idIncidencia']) ?></td>
                <td><?= htmlspecialchars($incidencia['descripcio'] ?? 'Sense descripció') ?></td>
                <td><?= date('d-m-Y', strtotime($incidencia['data'])) ?></td>
                <td><?= htmlspecialchars($incidencia['nomDept'] ?? 'Desconegut') ?></td>
                <td><?= htmlspecialchars($incidencia['dataFinalitzacio'] ?? 'No Finalitzada') ?></td>
                <td><?= htmlspecialchars($incidencia['tipo'] ?? 'No assignat') ?></td>
            </tr>
        </tbody>
    </table>
    <div class="container">
        <a href="../index.php" class="btn btn-primary rounded text-white btn-index">INICI</a>
        <a href="CrearIncidUser.php" class="btn btn-primary rounded text-white btn-index">TORNAR</a>
    </div>
</div>

