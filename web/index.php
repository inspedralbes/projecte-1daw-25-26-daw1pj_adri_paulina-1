<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GI3P</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="icon" href="../img/logoGI3P.png">
    <link rel="stylesheet" href="/css/responsive.css">
</head>
<!-- body sense margin, padding i ocupa tot el ample i altura de la pantalla per evitar espais en blanc-->
<body style="margin: 0; padding: 0; width: 100%; height: 100%;">
    <div id="intro" class="bg-image vh-100 shadow-1-strong">
        <video style="width: 100vw;" playsinline autoplay muted loop>
            <source src="https://mdbootstrap.com/img/video/Lines.mp4" type="video/mp4" />
        </video>
        <div class="mask video-alpha">
            <div class="mx-auto mt-5 text-center text-light" style="width: 200px;">
                <div class="container">
                    <img class="mt-5" src="../img/logoGI3P.svg" alt="logo del projecte">    
                        <h1>Gestor d'Incidències</h1>
                        <p>Tria una de les opcions:</p>
                    <div class="d-grid gap-4">
                        <a class="btn btn-outline-light btn-lg m-2 btn-index" href="user/CrearIncidUser.php"><h4>PROFESSOR</h4></a>
                        <a class="btn btn-outline-light btn-lg m-2 btn-index" href="tecnic/tecnic.php"><h4>TÈCNIC</h4></a>
                        <a class="btn btn-outline-light btn-lg m-2 btn-index" href="admin/admin.php"><h4>ADMINISTRADOR</h4></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once "footer.php";?>
</body>
