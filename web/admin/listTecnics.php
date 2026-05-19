<?php
$_SESSION['role'] = 'admin';
include_once "../header.php"; 

$mysqli = include_once "../conexion.php";
$resultado = $mysqli -> query("SELECT * FROM TECNIC");
$tecnics = $resultado -> fetch_all(MYSQLI_ASSOC);
$resultado -> free();
?>
<div class="table-responsive container mt-5 col-12 col-md-8">
    <table border="1" cellpadding="10" class="table table-hover mx-auto text-center">
        <h2>Llistat de Tècnics:</h2>
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Actuacions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tecnics as $v_tecnic): ?>
                <tr>
                    <td><?php echo htmlspecialchars($v_tecnic["idTecnic"])?></td>
                    <td><?php echo htmlspecialchars($v_tecnic["nom"])?></td>
                    <td><a href="llistarActuacionsAdmin.php?id=<?php echo htmlspecialchars($v_tecnic["idTecnic"])?>" 
                        class="btn btn-sm btn-info">Llistat d'actuacions</a></td></tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="admin.php" class="btn btn-primary rounded text-white btn-index">TORNAR</a>
</div>



<?php include_once "../footer.php"; ?>