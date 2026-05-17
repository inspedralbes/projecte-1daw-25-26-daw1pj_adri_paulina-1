<?php
include_once 'header.php'; #require 'vendor/autoload.php'; ja se carga en el header (evitar duplicados)
// Connexió a MongoDB
$client = new MongoDB\Client("mongodb://admin:pass@mongo:27017");
$collection = $client->logs->logs;

// Obtenir tots els registres (sense filtre)
$documents = $collection->find();

$totalGeneral = 0;
$conteoPerData = []; // S'agrupa per hora, per a la gràfica de tèndencia
$conteoPerPagina = []; // Pàgines més visitades
$conteoPerUsuari = []; // Per usuari més actiu
$accessosAvui = 0; // Accessos del dia
$avui = date("d-m-Y");

foreach ($documents as $doc) {
    $totalGeneral++;
    
    // Agrupació -> tendència (d-m-Y H:i)
    $hora = substr($doc['date'] ?? '00:00', 0, 5);
    $conteoPerData[$hora] = ($conteoPerData[$hora] ?? 0) + 1;
    
    // pàgines
    $pagina = $doc['page'] ?? 'Desconeguda';
    $conteoPerPagina[$pagina] = ($conteoPerPagina[$pagina] ?? 0) + 1;

    //usuari més actiu: Extraemos el role del usuario
    $usuari = $doc['usuari'] ?? 'anonim';
    $conteoPerUsuari[$usuari] = ($conteoPerUsuari[$usuari] ?? 0) +1;

    //acces del dia (agafem els 10 primer characters = "dd-mm-YYYY")
    $dataDoc = substr($doc['datetime']  ?? '', 0, 10);
    if($dataDoc === $avui){
        $accessosAvui++;
    }
}

ksort($conteoPerData); // Ordenar per data/hores
arsort($conteoPerPagina); // Pàgines més vistes primer
arsort($conteoPerUsuari); // Usuaris més actius

// labels i dades per al chart
$labelsGrafica = array_keys($conteoPerData);
$dadesGrafica = array_values($conteoPerData);

// labels i dades per al chart de usuaris
$labelUsuaris = array_keys($conteoPerUsuari);
$dadesUsuaris = array_values($conteoPerUsuari);

// Usuari més actiu (será el 1er de la llista ordenada)
$usuariMesActiu = array_key_first($conteoPerUsuari) ?? '-';

// Pagina més visitada
$paginaMesVisitada = array_key_first($conteoPerPagina) ?? '-';

// Variables per als filtres
$filtreDataInici = $_GET['data_inici'] ?? '';
$filtreDataFi = $_GET['data_fi'] ?? '';
$filtreUsuari = $_GET['usuari'] ?? '';
$filtrePagina = $_GET['pagina'] ?? '';
// Filtre amb MongoDB
$filtre = [];

// Data (a l'hora s l'hi afeguiex espai)
if ($filtreDataInici && $filtreDataFi) {
    $inici = DateTime::createFromFormat('Y-m-d', $filtreDataInici) -> format('d-m-Y') . ' 00:00:00';
    $fi = DateTime::createFromFormat('Y-m-d', $filtreDataFi) -> format('d-m-Y') . ' 23:59:59';
    $filtre['datetime'] = ['$gte' => $inici, '$lte' => $fi];
} elseif ($filtreDataInici) {
    // to filtre només el dia de inici
    $inici = DateTime::createFromFormat('Y-m-d', $filtreDataInici) -> format('d-m-Y') . ' 00:00:00';
    $fi = DateTime::createFromFormat('Y-m-d', $filtreDataFi) -> format('d-m-Y') . ' 23:59:59';
    $filtre['datatime'] =['$gte' => $inici, '$lte' => $fi];
}
// Usuari
if ($filtreUsuari) {
    $filtre['usuari'] = $filtreUsuari;
}
// Pagina
if ($filtrePagina) {
    $filtre['page'] = $filtrePagina;
}


$logs = $collection -> find($filtre, [
    'sort' => ['_id' => -1],
    'limit'    => 10,
]);
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12 text-center mb-4">
            <h1 class="display-4 text-primary">Panell d'Estadístiques</h1>
            <hr class="border border-secondary">
            <p class="lead">Monitorització d'activitat de la pàgina web en temps real</p>
        </div>
    </div>
</div>

<div class="container">
    <!--Total accesos. Usuari més actiu. Pagina més visitada. Accessos per dia-->
    <div class="row g-3 mb-4">
        <!--Total Accesos-->
        <div class="col-md-3">
            <div class="card text-white bg-primary h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-bar-chart-fill fs-1"></i><!--Icona d'un chart-->
                    <h6 class="mt-2">Total accessos</h6>
                    <h2><?= $totalGeneral ?></h2>
                </div>
            </div>
        </div>
        <!--Usuari més actiu-->
        <div class="col-md-3">
            <div class="card text-white bg-primary h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-person-check fs-1"></i><!--Usuari + actiu, o guanyador: bi-person-fill o bi-trophy-fill-->
                    <h6 class="mt-2">Usuari més actiu</h6>
                    <h2><?= $usuariMesActiu ?></h2>
                </div>
            </div>
        </div>
        <!--Pàgina més visitada-->
        <div class="col-md-3">
            <div class="card text-white bg-primary h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi-globe fs-1"></i><!--o: bi-file-earmark-text-fill-->
                    <h6 class="mt-2">Pàgina més visitada</h6>
                    <h2><?= $paginaMesVisitada ?></h2>
                </div>
            </div>
        </div>
        <!--Accessos per dia-->
        <div class="col-md-3">
            <div class="card text-white bg-primary h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi-calendar-event-fill fs-1"></i><!--o: bi-graph-up-arrow-->
                    <h6 class="mt-2">Accessos per dia</h6>
                    <h2><?= $accessosAvui ?></h2>
                </div>
            </div>
        </div>
    </div>
    <!--Filters-->
    <form method="GET" action="logs.php">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6 col-md-2">
                        <label for="Data Inici" class="form-label small fw-medium">Des de:</label>
                        <input type="date" name="data_inici" class="form-control form-control-sm" value="<?= htmlspecialchars($filtreDataInici) ?>">
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="útima data" class="form-label small fw-medium">Fins a:</label>
                        <input type="date" name="data_fi" class="form-control form-control-sm" value="<?= htmlspecialchars($filtreDataFi) ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="Data Inici" class="form-label small fw-medium">Usuari</label>
                        <select name="usuari" id="usuari" class="form-control form-control-sm">
                            <option value="">Tots</option>
                            <option value="professor" <?= $filtreUsuari === 'professor' ? 'selected' : '' ?>>Professor</option>
                            <option value="tecnic" <?= $filtreUsuari === 'tecnic' ? 'selected' : '' ?>>Tècnic</option>
                            <option value="admin" <?= $filtreUsuari === 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="anonim" <?= $filtreUsuari === 'anonim' ? 'selected' : '' ?>>Anònim</option>
                        </select>
                    </div>
                    <div class="col-md-5 d-flex align-items-end gap-2">
                        <button class="btn btn-primary text-white btn-sm px-3">
                            <i class="bi bi-funnel me-1"></i>Filtrar
                        </button>
                        <a href="logs.php" class="btn btn-light border btn-sm px-3 text-muted">
                            <i class="bi bi-eraser-fill me-1"></i>Natejar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--Charts-->
    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-8">
            <div class="card-border shadow-sm h-100">
                <div class="card-header">
                    <h6 class="fw-bold mb-0"><i class="bi bi-graph-up"></i> Tendència</h6>
                </div>
                <div class="card-body">
                    <div style="height: 250px;">
                        <canvas id="trendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card border-0">
                <div class="card-header">
                    <h6 class="fw-bold mb-0"><i class="bi bi-people-fill"> Usuari</i></h6>
                </div>
                <div class="card-body">
                    <div style="height: 200px;">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Tabla-->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white py-3">
            <h6 class="fw-bold mb-0"><i class="bi bi-list-columns-reverse">Últims 10 logs</i></h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr class="small">
                        <th class="ps-3">Data amb Hora</th>
                        <th>URL</th>
                        <th>Role</th>
                        <th>Mètode</th>
                        <th class="pe-3">IP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $log): ?>
                    <!--Loop per saber quin badge utilitzar-->
                    <?php
                        $method = htmlspecialchars($log['method'] ?? 'GET');
                        $badgeClass = match($method) {
                            'POST' => 'bg-warning text-dark',
                            'DELETE' => 'bg-danger',
                            default => 'bg-success',
                        };
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($log['datetime'] ?? '') ?></td>
                            <td><code><?= htmlspecialchars($log['page'] ?? '') ?></code></td>
                            <td><div class="badge bg-secondary"><?= htmlspecialchars($log['usuari'] ?? 'anonim') ?></div></td>
                            <td><span class="badge <?= $badgeClass ?>"><?= $method ?></span></td>
                            <td><?= htmlspecialchars($log['ip_origin'] ?? '') ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Dades i scripts per al Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // gràfica tendencia
    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: <?= json_encode($labelsGrafica) ?>,
            datasets: [{
                label: 'Acessos',
                data: <?= json_encode($dadesGrafica) ?>,
                borderColor: '#185FA5',
                backgroundColor: 'rgba(24, 95, 165, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {  legend: { display: false}},
            scales: { y: { grid: { display: false}}}
        }
    });
    // Pie Chart
    new Chart(document.getElementById('pieChart'), {
        type: 'doughnut',
        data: {
            labels: <?= json_encode($labelUsuaris) ?>,
            datasets: [{
                data: <?= json_encode($dadesUsuaris) ?>,
                backgroundColor: ['#185FA5', '#1D9E75', '#534AB7', '#038103']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 12}}}
        }
    });
</script>


</body>
</html>