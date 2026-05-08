<?php
require_once "../header.php";
$misqli = include_once "../conexion.php";
# creamos una variable que haga un SELECT a la BD mediante conexion.php
$return = $misqli -> query("SELECT * FROM TECNIC");

$v_tecnics = $return -> fetch_all(MYSQLI_ASSOC);

/*Si selecciona un técnico hace un bucle para mostrar solo sus incidéncias asignadas */
$incid_tecnic = [];
if (isset($_GET["id"])) {
    $id_tecnic = $_GET["id"];
    $stmt = $misqli -> prepare("SELECT * FROM INCIDENCIA WHERE tecnic = ?");
    
    $stmt -> bind_param("i", $id_tecnic);
    $stmt -> execute();

    $result = $stmt -> get_result();
    $incid_tecnic = $result -> fetch_all(MYSQLI_ASSOC);
    }
?>

<link rel="stylesheet" href="../css/responsive.css">

<div class="container">
    <div>
        <h2>Escull el teu usuari:</h2>
        <table border="1" cellpadding="10">
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
    </div>

    <?php if(isset($_GET['id'])): ?>
        <h2>Incidències que s'ha t'han assignat:</h2>
        <table border="1" cellpadding="10">
            <tr>
                <th>ID</th>
                <th>Descripció</th>
                <th>Data</th>
                <th>Data de finalització</th>
                <th>Tipus</th>
                <th>Prioritat</th>
            </tr>
            <?php if(count($incid_tecnic)>0): ?>
                <?php foreach ($incid_tecnic as $incidencia): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($incidencia['idIncidencia']); ?></td>
                        <td><?php echo htmlspecialchars($incidencia['descripcio']); ?></td>
                        <td><?php echo htmlspecialchars($incidencia['data']); ?></td>
                        <td><?php echo htmlspecialchars($incidencia['dataFinalitzacio'] ?? 'No finalitzada'); ?></td>
                        <td><?php echo htmlspecialchars($incidencia['tipo']); ?></td>
                        <td><?php echo htmlspecialchars($incidencia['prioritat']); ?></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Aquest tècnic no té incidències assignades!</td>
                </tr>
            <?php endif; ?>
        </table>
    <?php endif; ?>
</div>

<div>
    <a href="../index.php" class="btn rounded text-white btn-index" style="background-color: #7a1b0c">INICI</a>
</div>

<?php require_once "../footer.php" ?>
