<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<link rel="stylesheet" href="/css/responsive.css">

<div id="intro" class="bg-image vh-100 shadow-1-strong">
    <video style="min-width: 100%; max-height: 100%;" playsinline autoplay muted loop>
        <source class="h-100" src="https://mdbootstrap.com/img/video/Lines.mp4" type="video/mp4" />
    </video>
    <div class="mask video-alpha">

        <div class="mx-auto mt-5 text-center text-light" style="width: 200px;">
            <img class="mt-5" src="../img/logoGI3P.png" alt="logo del projecte">    
            <h1>Benvingut!</h1>
            <p>Tria una de les opcions:</p>
            
            <div class="d-grid gap-4">
                <a class="btn btn-outline-light btn-lg m-2 btn-index" href="user/CrearIncidUser.php"><h4>PROFESSOR</h4></a>
                <a class="btn btn-outline-light btn-lg m-2 btn-index" href="tecnic/tecnic.php"><h4>TÈCNIC</h4></a>
                <a class="btn btn-outline-light btn-lg m-2 btn-index" href="admin/admin.php"><h4>ADMINISTRADOR</h4></a>
            </div>
        </div>
    </div>

</div>

<?php include_once "footer.php";?>