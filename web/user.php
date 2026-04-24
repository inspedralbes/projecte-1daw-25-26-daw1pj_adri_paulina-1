<?php include_once "header.php"; ?>
<!--CREATE-->
<?php
$mysqli = include_once "conexion.php";
$descr = $_POST["descripcio"]; /*$variable  [columna] */
$fecha = $_POST["data"];
$dept = $_POST["deptartament"];

$sentencia = $mysqli -> prepare("INSERT INTO INCIDENCIA (descripcio, data, departament) VALUES (?,?,?)");
$sentencia -> bind_param("sdi", $descr, $fecha, $dept);
            /*data type we wanna introduce: string, date, int */
$sentencia -> execute();

$id = $mysql -> query ("SELECT LAST_INSERT_ID()")->fetch_row[0];
?>
    <div class="">
        <h1>Crear incidència</h1>
        <form action="crearInc.php" method="POST">
        <div>
            <label for="descripcio">Descripció</label>
            <textarea name="desc" id="desc" placeholder="Descriu la incidència ..." cols="30" rows="10" required></textarea>
        </div>
        <div>
            <label for="data">Dada de la incidència</label>
            <option type="date" name="data" required>
        </div>    
        <div> <!--el for busca al id del input-->
            <label for="departament">Dapartament</label>
            <select name="departament" id="dept">
                <option value="1">Informàtica</option>
                <option value="2">Català</option>
                <option value="3">Matemàtiques</option>
                <option value="4">Secretaria</option>
            </select>
        </div>

        </form>
    
        <h1>Estat incidència creada</h1>

    </div>
    <a href="index.php"><button>INICI</button></a>
    <button href="">TORNAR</button>
<?php include_once "footer.php"; ?>