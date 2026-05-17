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

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <!-- Header: afeguim el gif. d-flex per posicionar el txt al costat del gif -->
                    <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                        <img src="/img/assignIncidencia.gif" alt="Animació de reparació" style="height: 60px; width: 60px;">
                        <div>
                            <h4 class="mb-0">Actualitzar incidència</h4>
                            <span class="text-muted small">Nº <?= htmlspecialchars($incidencia["idIncidencia"]); ?></span>
                        </div>
                    </div>
                    <!--Form: prioritat, tipus, tècnic-->
                    <form action="UpdateAdmin.php" method="POST">
                        <input type="hidden" name="idIncidencia" value="<?= htmlspecialchars($incidencia["idIncidencia"]); ?>">
                        <!--Prioritat-->
                        <div class="mb-3">
                            <label for="prioritat" class="form-label">Prioritat</label>
                            <select name="prioritat" id="prioritat" class="form-select">
                                <option disabled>-- Prioritat --</option>
                                <option value="Alta" <?php if($incidencia["prioritat"] == "Alta") echo "selected"; ?>>Alta</option>
                                <option value="Mitja" <?php if($incidencia["prioritat"] == "Mitja") echo "selected"; ?>>Mitja</option>
                                <option value="Baixa" <?php if($incidencia["prioritat"] == "Baixa") echo "selected"; ?>>Baixa</option>
                            </select>
                        </div>
                        <!--Tipus-->
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipus</label>
                            <select name="tipo" id="tipo" class="form-select">
                                <option disabled>-- Tipo --</option>
                                <option value="Software" <?php if($incidencia["tipo"] == "Software") echo "selected"; ?>>Software</option>
                                <option value="Hardware" <?php if($incidencia["tipo"] == "Hardware") echo "selected"; ?>>Hardware</option>
                                <option value="Internet" <?php if($incidencia["tipo"] == "Internet") echo "selected"; ?>>Internet</option>
                                <option value="Corrent" <?php if($incidencia["tipo"] == "Corrent") echo "selected"; ?>>Corrent</option>
                            </select>
                        </div>
                        <!--Tècnic-->
                        <div class="mb-4">
                            <label for="tecnic" class="form-label">Assignar tècnic</label>
                            <select name="tecnic" id="tecnic" class="form-select">
                                <option disabled> -Tècnics- </option>
                                <option value="1" <?php if($incidencia["tecnic"] == 1) echo "selected"; ?>>Ermengol Bota</option>
                                <option value="2" <?php if($incidencia["tecnic"] == 2) echo "selected"; ?>>Alvaro Perez</option>
                                <option value="3" <?php if($incidencia["tecnic"] == 3) echo "selected"; ?>>Gerard Torrents</option>
                                <option value="4" <?php if($incidencia["tecnic"] == 4) echo "selected"; ?>>Rafa Cuestas</option>
                            </select>
                        </div>
                        <!--Button DESA (action)-->
                        <div class="d-flex justify-content-center pt-3">
                            <button type="submit" class="btn btn-outline-primary btn-index">DESA</button>
                        </div>
                    </form>

                </div>
            </div>
            <!--Botons en el mateix "container"-->
            <div class="pt-5">
                <a href="../index.php" class="btn btn-primary rounded text-white btn-index">INICI</a>
                <a href="listIncidAdmin.php" class="btn btn-primary rounded text-white btn-index">TORNAR</a>
            </div>
        </div>
    </div>
</div>

<?php include_once "../footer.php"; ?>