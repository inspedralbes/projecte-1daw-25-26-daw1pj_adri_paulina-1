<?php include_once "../header.php"; 

$mysqli = include_once "../conexion.php";
$resultado = $mysqli -> query("SELECT * FROM TECNIC");
$tecnics = $resultado -> fetch_all(MYSQLI_ASSOC);
$resultado -> free();
?>

<table border="1" cellpadding="10">
    <h2>Llistat de Tècnics:</h2>
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tecnics as $v_tecnic): ?>
            <tr>
                <td><?php echo htmlspecialchars($v_tecnic["idTecnic"])?></td>
                <td><?php echo htmlspecialchars($v_tecnic["nom"])?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="admin.php" class="btn rounded text-white btn-index" style="background-color: #117a0c">Tornar enrrere</a>

<?php include_once "../footer.php"; ?>