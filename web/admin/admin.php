<?php require_once "../header.php"; ?>



<!--Contenidor de tot el contingut -->
<div class="container mt-5">
    <!-- Div amb 2 columnes centrades-->
    <div class="row w-100 align-items-center text-center">
        <!-- contingut esquerra -->
        <div class="col d-flex flex-column justify-content-center align-items-center gap-3">
            <div class="col-md-4"> <!-- Utilitzem d-block: display:block per fer un salt de linea ¿? mx-auto +  mb-2?-->
                <a href="listTecnics.php" class="btn btn-index" style="color:#278DE6">
                    <img src="../img/technician-icon.png" alt="Llistar Tècnics" class="border border-3 border-primary d-block mx-auto btn-index" style="width: 150px; height: 150px;">TROBA UN TÈCNIC</a>
            </div>
            <div class="col-md-4">
                <a href="listIncidAdmin.php" class="btn rounded btn-index" style="color:#278DE6">
                    <img src="../img/list-icon.png" alt="Llistar Incidències" class="border border-3 border-primary d-block mx-auto btn-index" style="width: 150px; height: 150px;">LLISTAR INCIDÈNCIES</a>
            </div>
            <div class="col-md-4">
                <a href="listIncidPendents.php" class="btn rounded btn-index" style="color:#278DE6">
                    <img src="../img/choosing-icon.jpg" alt="Assignar incidéncies a un tècnic" class="border border-3 border-primary d-block mx-auto btn-index" style="width: 150px; height: 150px;">ASSIGNAR INCIDÈNCIES</a>
            </div>
            <div>
            <a href="../index.php" class="btn btn-primary rounded text-white btn-index">INICI</a>
            </div>
        </div>
        <!-- Contingut dreta -->
        <div class="col">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="text-primary">Gràfiques Incidències</h2>

                </div>
                <!--Pie chart-->
                <div class="card border-primary text-center mb-4">
                    <h4>Pie Chart</h4>
                    <canvas id="pieChart"></canvas>
                </div>

                <div class="card border-primary text-center">
                    <h4>Stacked Bar Chart</h4>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Creem les variables per a les gràfiques (ens contectem a la BD) -->
<?php
$mysqli = include_once "../conexion.php"; # AS total, obertes, tancades es neccesari per poder fer-ho sevir al fetch_assoc()

$totalIncid = $mysqli -> query("SELECT COUNT(*) AS total FROM INCIDENCIA") -> fetch_assoc()['total'];
$incidObertes = $mysqli -> query("SELECT COUNT(*) AS obertes FROM INCIDENCIA WHERE dataFinalitzacio IS NULL") -> fetch_assoc()['obertes'];
$incidTancades = $mysqli -> query("SELECT COUNT(*) AS tancades FROM INCIDENCIA WHERE dataFinalitzacio IS NOT NULL") -> fetch_assoc()['tancades'];
# departaments:
$depts = $mysqli -> query("SELECT d.nom, d.idDepartament COUNT(i.idIncidencia) AS totalDept FROM DEPARTAMENT d LEFT JOIN INCIDENCIA i ON d.idTecnic = d.idTecnic GROUP BY d.idDepartament, d.nom");
# variables para el bucle
$labelsDept = [];
$dataDept = [];

while($row = $depts -> fetch_assoc()){
    $labelsDept[] = $row['nom'];
    $dataDept[] = $row['totalDept'];
}

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
window.addEventListener('load', function(){
    const pieData = {
        labels: ['Total','Obertes', 'Tancades'],
        datasets: [{
            label: 'Incidències',
            /* afegir (int) en cas de que sigui NULL */
            data: [<?= (int)$totalIncid?>, <?= (int)$incidObertes?>, <?= (int)$incidTancades?>],
            backgroundColor: ['#41cab3',
                            '#41ca53',
                            '#f3128e'],
        }]
    };
    new Chart (document.getElementById('pieChart'),{
        type: 'pie',
        data: pieData
    });
});
    
</script>

<script>
window.addEventListener('load', function() {
    new Chart(
        document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: <?= json_encode($labelsDept) ?>,
                datasets: [{
                    label: 'Incidències per departament',
                    data: <?= json_encode($dataDept) ?>,
                    backgroundColor: '#278DE6',
                }]
            }
        });
    });
</script>


<?php require_once "../footer.php"; ?>
