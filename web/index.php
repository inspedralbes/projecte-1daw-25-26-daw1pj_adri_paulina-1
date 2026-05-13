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
<!-- Div con las mismas dimensiones para que no sobresalga el body. Utilitzem dimensions de pantalla y no %. No necesita overflow: hidden; -->
    <div style="position: relative; width: 100vw; height: 100vh;">
        <video playsinline autoplay muted loop>
            <source src="https://mdbootstrap.com/img/video/Lines.mp4" type="video/mp4" />
        </video>
        
        <div class="position-absolute top-0 start-0 w-100 h-100 mask-alpha"></div>
    <!--Cerramos div para centar el contenido por encima de la máscara-->
        <!--Contenidor de tot el contingut-->
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center text-white" style="z-index: 2;">
            <!--Creem un div de 2 columnes y les centrem-->
            <div class="row g-4 align-items-center w-100 justify-content-center">
                <!--Contingut a la esquerra-->
                <div class="col-auto d-flex flex-column align-items-center gap-3">
                    <img src="../img/logoGI3P.svg" alt="logo del projecte" style="width: 250px;">
                        <a class="btn btn-outline-light btn-lg m-2 btn-index" href="../logs.php">SYSTEM LOGS</a>
                </div>
                <!--Contingut a la dreta-->
                <div class="col-auto d-flex flex-column align-items-center gap-3">
                    <h1>Gestor d'Incidències</h1>
                    <p>Tria una de les opcions:</p>

                    <div class="d-grid gap-3 w-100">
                        <a class="btn btn-outline-light btn-lg m-2 btn-index" href="user/CrearIncidUser.php">PROFESSOR</a>
                        <a class="btn btn-outline-light btn-lg m-2 btn-index" href="tecnic/tecnic.php">TÈCNIC</a>
                        <a class="btn btn-outline-light btn-lg m-2 btn-index" href="admin/admin.php">ADMINISTRADOR</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include_once "footer.php";?>
</body>
