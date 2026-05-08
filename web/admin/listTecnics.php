<?php include_once "../header.php"; 

$mysqli = include_once "../conexion.php";
$resultado = $mysqli -> query("SELECT * FROM TECNIC");
$tecnics = $resultado -> fetch_all(MYSQLI_ASSOC);
?>

<table>
    <thead>
        <caption>Llistat de Tècnics:</caption>
        <tr>
            <th>Id</th>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tecnics as $v_tecnic) { ?>
            <tr>
                <td><?php echo htmlspecialchars($v_tecnic["idTecnic"])?></td>
                <td><?php echo htmlspecialchars($v_tecnic["nom"])?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php include_once "../footer.php"; ?>