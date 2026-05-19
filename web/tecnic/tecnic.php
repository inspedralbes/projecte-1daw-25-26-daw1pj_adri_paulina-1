<?php
$_SESSION['role'] = 'tecnic'; // to set user's role

$mysqli = include_once "../conexion.php";
# creamos una variable que haga un SELECT a la BD mediante conexion.php
$return = $mysqli->query("SELECT * FROM TECNIC");

$v_tecnics = $return->fetch_all(MYSQLI_ASSOC);
$return->free(); // liberamos memoria

/*Si selecciona un técnico hace un bucle para mostrar solo sus incidéncias asignadas */
$incid_tecnic = [];
if (isset($_GET["id"])) {
    $id_tecnic = $_GET["id"];
    $stmt = $mysqli->prepare("SELECT idIncidencia, descripcio, DATE(data) AS fecha, departament, tecnic, dataFinalitzacio, tipo, prioritat FROM INCIDENCIA WHERE tecnic = ? AND dataFinalitzacio IS NULL");

    $stmt->bind_param("i", $id_tecnic);
    $stmt->execute();

    $result = $stmt->get_result();
    $incid_tecnic = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close(); // cerramos la consulta preparada
}

if (isset($_GET['action']) && $_GET['action'] == 'tancar' && isset($_GET['id_incidencia'])) {
    $id_a_tancar = $_GET['id_incidencia'];
    $stmt_update = $mysqli->prepare("UPDATE INCIDENCIA SET dataFinalitzacio = NOW(), prioritat = NULL WHERE idIncidencia = ?");
    $stmt_update->bind_param("i", $id_a_tancar);
    $stmt_update->execute();
    $stmt_update->close();

    $id_actual = $_GET['id'];
    header("Location: tecnic.php?id=$id_actual");
    exit;
}
require_once "../header.php";

?>

<link rel="stylesheet" href="../css/responsive.css">

<div class="table-responsive container container mt-5 col-12 col-md-6 col-lg-4 mx-auto">

    <?php if (!isset($_GET["id"])): ?>
        <h2>Escull el teu usuari:</h2>
        <table border="1" cellpadding="10" class="table table-hover mx-auto text-center">
            <tr>
                <th>ID</th>
                <th>Nom</th>
            </tr>
            <?php foreach ($v_tecnics as $tecnic): ?>
                <tr>
                    <td><?php echo htmlspecialchars($tecnic['idTecnic']); ?></td>
                    <td><a href="?id=<?php echo $tecnic['idTecnic']; ?>">
                            <?php echo htmlspecialchars($tecnic['nom']); ?></a></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="../index.php" class="btn btn-primary rounded text-white btn-index">INICI</a>
    <?php endif; ?>
</div>
<div class="container">

    <?php if(isset($_GET['id'])): ?>
        <h2>Incidències que s'ha t'han assignat:</h2>
        <div class="table-responsive">
            <table border="1" cellpadding="10" class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">Descripció</th>
                        <th class="text-white">Data</th>
                        <th class="text-white">Data de finalització</th>
                        <th class="text-white">Tipus</th>
                        <th class="text-white">Prioritat</th>
                        <th class="text-center"><i class="bi bi-lock-fill" style="font-size: 18px; color: white;"></i></th>
                        <th class="text-center"><i class="bi bi-card-checklist" style="font-size: 18px; color: white;"></th>
                        <th class="text-center"><i class="bi bi-eraser-fill" style="font-size: 18px; color: white;"></i></th>
                    </tr>
                </thead>
                <?php if(count($incid_tecnic)>0): ?>
                    <?php foreach ($incid_tecnic as $incidencia): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($incidencia['idIncidencia']); ?></td>
                            <td><?php echo htmlspecialchars($incidencia['descripcio']); ?></td>
                            <td><?php echo htmlspecialchars($incidencia['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($incidencia['dataFinalitzacio'] ?? 'No finalitzada'); ?></td>
                            <td><?php echo htmlspecialchars($incidencia['tipo']); ?></td>
                            <td><?php echo htmlspecialchars($incidencia['prioritat']); ?></td>
                            <td><a href="tecnic.php?id=<?php echo urlencode($id_tecnic); ?>&action=tancar&id_incidencia=<?php 
                            echo urlencode($incidencia['idIncidencia']); ?>" class="btn btn-sm btn-danger" 
                                onclick="return confirm('Segur que vols tancar la incidència <?php echo htmlspecialchars($incidencia['idIncidencia']); ?>?')">
                                    Tancar
                                </a>
                            </td>
                            <td><a href="llistarActuacions.php?id=<?php echo htmlspecialchars($incidencia["idIncidencia"])?>" 
                            class="btn btn-sm btn-info">Llistat d'actuacions</a></td>
                            <td><a href="actuacioTec.php?id=<?php echo $incidencia['idIncidencia']; ?>" class="btn btn-primary">
                                Afegir Actuació
                            </a></td>
                            
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Aquest tècnic no té incidències assignades!</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    <?php endif; ?>

    <div class="d-flex gap-2 mt-3">
        <!--Btn para volver atrás en la misma pàgina -->
        <?php if (isset($_GET['id'])): ?>
            <a href="../index.php" class="btn btn-primary rounded text-white btn-index">INICI</a>
            <a href="?" class="btn btn-primary rounded text-white btn-index">TORNAR</a>
        <?php endif; ?>

    </div>
</div>

<?php require_once "../footer.php" ?>