<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include_once 'header.php'; 

// URI de connexió a MongoDB Atlas (producció)

//$mongoUri = "mongodb+srv://a25adrtomdie_db_user:PLT+Rf4jTW61VqCN@cluster0.ew1qzdv.mongodb.net/?appName=Cluster0";//<-- direccion mongo atlas (solo produccion)
//$client = new MongoDB\Client($mongoUri);//<-- crar conexion a producion (Atlas)

//Mongo a local
$client = new MongoDB\Client("mongodb://admin:pass@mongo:27017"); //<-- Crear conexion mongo a local

$collection = $client->logs->logs;

// 1. Recollim les variables del filtre (mètode GET)
$filtreDataInici = $_GET['data_inici'] ?? '';
$filtreDataFi    = $_GET['data_fi']    ?? '';
$filtreUsuari    = $_GET['usuari']     ?? '';
$filtrePagina    = $_GET['pagina']     ?? '';

// 2. Filtre directe a MongoDB només per text exacte (Usuari i Pàgina)
$filtreMongo = [];
if ($filtreUsuari) { $filtreMongo['usuari'] = $filtreUsuari; }
if ($filtrePagina) { $filtreMongo['page'] = $filtrePagina; }

// Obtenim els registres ordenats del més nou al més vell
$documents = $collection->find($filtreMongo, ['sort' => ['_id' => -1]]);

// 3. Preparem els objectes de data en PHP per al filtre de rang de temps
$dateIniciObj = $filtreDataInici ? DateTime::createFromFormat('Y-m-d', $filtreDataInici) : null;
if ($dateIniciObj) $dateIniciObj->setTime(0, 0, 0);

$dateFiObj = $filtreDataFi ? DateTime::createFromFormat('Y-m-d', $filtreDataFi) : null;
if ($dateIniciObj && !$dateFiObj) {
    $dateFiObj = clone $dateIniciObj; // Si només hi ha inici, el fi és aquest mateix dia
}
if ($dateFiObj) $dateFiObj->setTime(23, 59, 59);

// Variables de les targetes i gràfiques
$totalGeneral = 0;
$conteoPerData = []; 
$conteoPerPagina = []; 
$conteoPerUsuari = []; 
$accessosAvui = 0; 
$avui = date("d-m-Y");

$logsTaula = []; // Aquí guardarem només els 10 últims logs vàlids per a la taula

// 4. Processament de dades
foreach ($documents as $doc) {
    // Extraiem només el dia (dd-mm-yyyy)
    $dataDocText = isset($doc['datetime']) ? substr($doc['datetime'], 0, 10) : '';
    if (!$dataDocText) continue;

    $docDateObj = DateTime::createFromFormat('d-m-Y', $dataDocText);
    if (!$docDateObj) continue;

    // APLIQUEM EL FILTRE DE DATES AQUÍ (Molt més segur que a MongoDB)
    if ($dateIniciObj && $docDateObj < $dateIniciObj) continue;
    if ($dateFiObj && $docDateObj > $dateFiObj) continue;

    // --- SI PASSA TOTS ELS FILTRES, SUMEM LES ESTADÍSTIQUES ---
    $totalGeneral++;
    
    // Guardem els 10 més recents per a la taula HTML
    if (count($logsTaula) < 10) {
        $logsTaula[] = $doc;
    }

    // Gràfica per DIES (Agrupem per dia, ex: "17-05-2026")
    $conteoPerData[$dataDocText] = ($conteoPerData[$dataDocText] ?? 0) + 1;
    
    // Pàgines més visitades
    $pagina = $doc['page'] ?? 'Desconeguda';
    $conteoPerPagina[$pagina] = ($conteoPerPagina[$pagina] ?? 0) + 1;

    // Usuari més actiu
    $usuari = $doc['usuari'] ?? 'anonim';
    $conteoPerUsuari[$usuari] = ($conteoPerUsuari[$usuari] ?? 0) + 1;

    // Accessos del dia actual
    if ($dataDocText === $avui) {
        $accessosAvui++;
    }
}

// 5. Ordenació final per a que les gràfiques tinguin sentit
// Ordenem les dates cronològicament (de més antiga a més nova per a l'eix X)
uksort($conteoPerData, function($a, $b) {
    $dateA = DateTime::createFromFormat('d-m-Y', $a);
    $dateB = DateTime::createFromFormat('d-m-Y', $b);
    return $dateA <=> $dateB;
});

arsort($conteoPerPagina); 
arsort($conteoPerUsuari); 

$labelsGrafica = array_keys($conteoPerData);
$dadesGrafica = array_values($conteoPerData);
$labelUsuaris = array_keys($conteoPerUsuari);
$dadesUsuaris = array_values($conteoPerUsuari);
$usuariMesActiu = array_key_first($conteoPerUsuari) ?? '-';
$paginaMesVisitada = array_key_first($conteoPerPagina) ?? '-';
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
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-bar-chart-fill fs-1"></i>
                    <h6 class="mt-2">Total accessos</h6>
                    <h2><?= $totalGeneral ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-primary h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-person-check fs-1"></i>
                    <h6 class="mt-2">Usuari més actiu</h6>
                    <h2><?= $usuariMesActiu ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-primary h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi-globe fs-1"></i>
                    <h6 class="mt-2">Pàgina més visitada</h6>
                    <h2><?= $paginaMesVisitada ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-primary h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi-calendar-event-fill fs-1"></i>
                    <h6 class="mt-2">Accessos d'avui</h6>
                    <h2><?= $accessosAvui ?></h2>
                </div>
            </div>
        </div>
    </div>

    <form method="GET" action="logs.php">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6 col-md-2">
                        <label for="data_inici" class="form-label small fw-medium">Des de:</label>
                        <input type="date" name="data_inici" id="data_inici" class="form-control form-control-sm" value="<?= htmlspecialchars($filtreDataInici) ?>">
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="data_fi" class="form-label small fw-medium">Fins a:</label>
                        <input type="date" name="data_fi" id="data_fi" class="form-control form-control-sm" value="<?= htmlspecialchars($filtreDataFi) ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="usuari" class="form-label small fw-medium">Usuari</label>
                        <select name="usuari" id="usuari" class="form-select form-select-sm">
                            <option value="">Tots</option>
                            <option value="professor" <?= $filtreUsuari === 'professor' ? 'selected' : '' ?>>Professor</option>
                            <option value="tecnic" <?= $filtreUsuari === 'tecnic' ? 'selected' : '' ?>>Tècnic</option>
                            <option value="admin" <?= $filtreUsuari === 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="anonim" <?= $filtreUsuari === 'anonim' ? 'selected' : '' ?>>Anònim</option>
                        </select>
                    </div>
                    <div class="col-md-5 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary text-white btn-sm px-3">
                            <i class="bi bi-funnel me-1"></i>Filtrar
                        </button>
                        <a href="logs.php" class="btn btn-light border btn-sm px-3 text-muted">
                            <i class="bi bi-eraser-fill me-1"></i>Netejar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-8">
            <div class="card border shadow-sm h-100">
                <div class="card-header">
                    <h6 class="fw-bold mb-0"><i class="bi bi-graph-up"></i> Tendència per Dies</h6>
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
                    <h6 class="fw-bold mb-0"><i class="bi bi-people-fill"> Usuaris</i></h6>
                </div>
                <div class="card-body">
                    <div style="height: 200px;">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white py-3">
            <h6 class="fw-bold mb-0"><i class="bi bi-list-columns-reverse"> Últims 10 logs trobats</i></h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr class="small">
                        <th class="ps-3">Data amb Hora</th>
                        <th>URL</th>
                        <th>Navegador</th>
                        <th>Role</th>
                        <th>Mètode</th>
                        <th class="pe-3">IP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($logsTaula)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No hi ha registres amb aquests filtres.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($logsTaula as $log): ?>
                        <?php
                            $method = htmlspecialchars($log['method'] ?? 'GET');
                            $badgeClass = match($method) {
                                'POST' => 'bg-warning text-dark',
                                'DELETE' => 'bg-danger',
                                default => 'bg-success',
                            };
                        ?>
                            <tr>
                                <td class="ps-3"><?= htmlspecialchars($log['datetime'] ?? '') ?></td>
                                <td><code><?= htmlspecialchars($log['page'] ?? '') ?></code></td>
                                <td title="<?= htmlspecialchars($log['navegador'] ?? 'Desconegut') ?>" style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    <?= htmlspecialchars($log['navegador'] ?? 'Desconegut') ?>
                                </td>
                                <td><div class="badge bg-secondary"><?= htmlspecialchars($log['usuari'] ?? 'anonim') ?></div></td>
                                <td><span class="badge <?= $badgeClass ?>"><?= $method ?></span></td>
                                <td class="pe-3"><?= htmlspecialchars($log['ip_origin'] ?? '') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gràfica tendencia (Eix X: Dies)
    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: <?= json_encode($labelsGrafica) ?>,
            datasets: [{
                label: 'Accessos al dia',
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
            scales: { y: { beginAtZero: true, grid: { display: false}}}
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