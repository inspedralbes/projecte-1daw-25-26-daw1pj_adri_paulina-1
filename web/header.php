<!-- Només la página activa se li aplica el active -->
<?php $pagActual = basename($_SERVER['PHP_SELF']); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GI3P</title>
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.8/dist/sandstone/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="icon" href="../img/logoGI3P.png">
<!-- Afeguim un sol cop bootstrap i el favicon que aparecixerán a totes les pàgines on s'afegueixi el header -->
</head>
<body>

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid position-relative">
    <!--Esquerra-->
    <a class="navbar-brand" href="/index.php">
      <img src="../img/logoGI3P.svg" alt="logo del projecte de 1er DAW de linstitut" style="height: 50px;">
    </a>
    <!--En mig-->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <!--Per centrar de manera simétrica-->
      <ul class="navbar-nav nav-center">
        <li class="nav-item">
          <a class="nav-link <?= $pagActual === 'CrearIncidUser.php' ? 'active' : '' ?>" href="../user/CrearIncidUser.php"><h5>Professors</h5></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $pagActual === 'tecnic.php' ? 'active' : '' ?> " href="../tecnic/tecnic.php"><h5>Tècnics</h5></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $pagActual === 'admin.php' ? 'active' : '' ?> " href="../admin/admin.php"><h5>Administrador</h3></a>
        </li>
      </ul>
      <!--Dreta-->
      <form class="d-flex ms-auto form-right" action="/buscarIncidencia.php" method="GET">
        <input class="form-control me-sm-2" type="search" size="25" placeholder="Buscar incidència pel seu ID">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>