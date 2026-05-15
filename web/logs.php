<?php
include_once 'header.php'; #require 'vendor/autoload.php'; ja se carga en el header (evitar duplicados)
// Connexió a MongoDB
$client = new MongoDB\Client("mongodb://admin:pass@mongo:27017");
$collection = $client->logs->logs;

// Obtenir tots els registres
$documents = $collection->find();

$totalGeneral = 0;
$conteoPerData = [];
$conteoPerPagina = [];

foreach ($documents as $doc) {
    $totalGeneral++;
    
    // 1. Agrupació per a la gràfica (HH:mm)
    $hora = substr($doc['date'] ?? '00:00', 0, 5);
    $conteoPerData[$hora] = ($conteoPerData[$hora] ?? 0) + 1;
    
    // 2. Agrupació per pàgina
    $pagina = $doc['page'] ?? 'Desconeguda';
    $conteoPerPagina[$pagina] = ($conteoPerPagina[$pagina] ?? 0) + 1;
}

ksort($conteoPerData); // Ordenar per hores
arsort($conteoPerPagina); // Pàgines més vistes primer

$labelsGrafica = array_keys($conteoPerData);
$dadesGrafica = array_values($conteoPerData);

?>


<div class="container mt-5">
    <div class="row">
        <div class="col-12 text-center mb-4">
            <h1 class="display-4 text-primary">Panell d'Estadístiques</h1>
            <p class="lead">Monitorització de l'activitat de la pàgina web en temps real.</p>
        </div>
    </div>
</div>

<!-- Informacio general en una targeta -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card border-primary text-center">
            <div class="card-body">
                <h3 class="card-title text-secondary">Total de Registres</h3>
                <p class="display-2 fw-bold text-primary"><?= $totalGeneral ?></p>
                <p class="text-muted">Interaccions totals detectades pel sistema</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Gràfica d'activitat (del moment) -->
    <div class="col-lg-7 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Activitat Temporal (Avui)</h5>
            </div>
            <div class="card-body">
                <canvas id="grafica"></canvas>
            </div>
        </div>
    </div>

    <!-- Recollida per pàgines -->
    <div class="col-lg-5 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Rànquing de Pàgines</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>URL / Pàgina</th>
                            <th class="text-center">Visites</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($conteoPerPagina as $url => $visites): ?>
                        <tr>
                            <td><small class="text-info"><?= htmlspecialchars($url) ?></small></td>
                            <td class="text-center fw-bold text-primary"><?= $visites ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        
    <!--Taula -->
    <div class="card mb-5">
        <div class="card-header bg-primary text-white">
            <h6 class="mb-0">Últim 10 accessos</h6>
        </div>
        <div class="table table-responsive">
            <table>
                <thead class="thead-dark table-hover">
                    <tr>
                        <th class="text-white">Dia + Hora</th>
                        <th class="text-white">Mètode</th>
                        <th class="text-white">URL</th>
                        <th class="text-white">IP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?= htmlspecialchars($log['datetime'] ?? '') ?></td>
                            <td><?= htmlspecialchars($log['method'] ?? '') ?></td>
                            <td><?= htmlspecialchars($log['pagina_actual'] ?? '') ?></td>
                            <td><?= htmlspecialchars($log['ip'] ?? '') ?></td>      
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Scripts per a la gràfica -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('grafica').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($labelsGrafica) ?>,
            datasets: [{
                label: 'Nombre de visites',
                data: <?= json_encode($dadesGrafica) ?>,
                borderColor: '#3E7D7D', // Color Sandstone Teal/Green
                backgroundColor: 'rgba(62, 125, 125, 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: '#3E7D7D'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, color: '#3e3f3a' }
                },
                x: {
                    ticks: { color: '#3e3f3a' }
                }
            }
        }
    });
</script>

</body>
</html>