<?php
$_SESSION['role'] = 'admin';
include_once "../header.php";

    $mysqli = include_once "../conexion.php";
    $id = $_GET["id"];
    $sentencia = $mysqli -> prepare("SELECT * FROM INCIDENCIA WHERE idIncidencia = ?");
    $sentencia -> bind_param("i", $id); #Evitar inyeccions XSS amb prepare() & bind_param()
    $sentencia -> execute();
    $resultado = $sentencia -> get_result();

    #Obtenim només la fila (incidencia) que volem editar
    $incidencia = $resultado -> fetch_assoc();
    if(!$incidencia) {
        exit("No existeix aquesta incidència!");
    }
?>

<h1>Actualitzar incidència:</h1>
<form action="UpdateAdmin.php" method="POST">
    <input type="hidden" name="idIncidencia" value="<?php echo htmlspecialchars($incidencia["idIncidencia"]); ?>">

    <label for="prioritat">Prioritat:</label>
    <select name="prioritat" id="prioritat"> <!--El echo solo imprime el txt slected, nada de la BD-->
        <option hidden>--Prioritat--</option>                
        <option value="Alta" <?php if($incidencia["prioritat"] == "Alta") echo "selected"; ?>>Alta</option>
        <option value="Mitja" <?php if($incidencia["prioritat"] == "Mitja") echo "selected"; ?>>Mitja</option>
        <option value="Baixa" <?php if($incidencia["prioritat"] == "Baixa") echo "selected"; ?>>Baixa</option>
    </select>
    
    <label for="tipo">Tipus:</label>
    <select name="tipo" id="tipo">
        <option hidden>--Tipus--</option>        
        <option value="Software" <?php if($incidencia["tipo"] == "Software") echo "selected"; ?>>Software</option>
        <option value="Hardware" <?php if($incidencia["tipo"] == "Hardware") echo "selected"; ?>>Hardware</option>
        <option value="Internet" <?php if($incidencia["tipo"] == "Internet") echo "selected"; ?>>Internet</option>
        <option value="Corrent" <?php if($incidencia["tipo"] == "Corrent") echo "selected"; ?>>Corrent</option>
    </select>
    <label for="tecnic">Assignar técnic:</label>
    <select name="tecnic" id="tecnic" value="<?php echo htmlspecialchars($incidencia["tecnic"]); ?>">
        <option hidden>--Tècnic--</option>
        <option value="1">Ermengol Bota</option>
        <option value="2">Alvaro Perez</option>
        <option value="3">Gerard Torrents</option>
        <option value="4">Rafa Cuestas</option>
    </select>

    <button class="btn btn-success btn-index">DESA</button>

<div>
    <a href="../index.php" class="btn btn-primary rounded text-white btn-index">INICI</a>
    <a href="listIncidAdmin.php" class="btn btn-primary rounded text-white btn-index">TORNAR</a>
</div>

</form>

<?php include_once "../footer.php"; ?>