<?php include_once "header.php";?>

<link rel="stylesheet" href="/css/responsive.css">

<div class="mx-auto mt-5 text-center" style="width: 200px;">
    <img src="../img/logoGI3P.png" alt="logo projecte">    
    <h1>Benvingut!</h1>
    <p>Tria una de les opcions:</p>
    
    <div class="d-grid gap-4">
        <a href="user/CrearIncidUser.php" class="text-light btn btn-primary btn-index"><h4>PROFESSOR</h4></a>
        <a href="tecnic/tecnic.php" class="text-light btn btn-primary btn-index"><h4>TÈCNIC</h4></a>
        <a href="admin/admin.php" class="text-light btn btn-primary btn-index"><h4>ADMINISTRADOR</h4></a>
    </div>
</div>

<?php include_once "footer.php";?>
