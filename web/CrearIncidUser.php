<?php include_once "header.php"; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <div class="container mt-5"> <!--con Margin Top: 5-->
        <div class="row justify-content-center align-items-center"> <!-- -->
            <div class="col-md-5 align-items-start"> <!--  ¿? -->
                <img src="formularis-incidencies.jpg" alt="img Incidencies" style="max-width:400px" class="img-fluid rounded shadow"> <!-- fluid per moure l'imatge-->
                <div class="d-grid gap-2 d-md-flex justify-content-md-center" style="margin-top: 100px">
                    <a href="index.php"><button class="btn rounded" style="background-color:#129987">INICI</button></a>
                    <a href=""><button class="btn rounded" style="background-color:#129987">LLISTAR INCIDÈNCIES</button></a>
            </div>
            </div>
            
            <div class="col-md-6 text-center"> <!-- md: medium -->
                <h1 class="fw-bold text-center mb-5" style="margin-top: 60px">Crear incidència</h1>
                <form action="InsertIncidUser.php" method="POST" class="border border-success rounded" style="width:600px">
                
                    <div class="p-2">
                        <label class="fs-4 mt-4" for="descripcion">Descripció</label> <br>
                        <textarea name="descripcion" id="descripcion" placeholder="Descriu la incidència ..." cols="40" rows="10" required></textarea>
                    </div>
                    <div class="p-2">
                        <label class="fs-4" for="data">Data de la incidència</label>
                        <input type="date" name="data" required>
                    </div>    
                    <div class="p-2"> <!--el for busca al id del input-->
                        <label class="fs-4" for="departament">Departament</label>
                        <select name="departament" id="department">
                            <option value="1">Informàtica</option>
                            <option value="2">Català</option>
                            <option value="3">Matemàtiques</option>
                            <option value="4">Secretaria</option>
                        </select>
                    </div>
                <div class="form-group mb-3"><button class="btn btn-success">Crear</button></div>
            </form>
        </div>
    </div>
<?php include_once "footer.php"; ?>
<?php include_once "header.php"; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <div class="container mt-5"> <!--con Margin Top: 5-->
        <div class="row justify-content-center align-items-center"> <!-- -->
            <div class="col-md-5 align-items-start"> <!--  ¿? -->
                <img src="../img/formularis-incidencies.jpg" alt="img Incidencies" style="max-width:400px" class="img-fluid rounded shadow"> <!-- fluid per moure l'imatge-->
                <div class="d-grid gap-2 d-md-flex justify-content-md-center" style="margin-top: 100px">
                    <a href="index.php"><button class="btn rounded text-white" style="background-color:#129987">INICI</button></a>
                    <a href="userList.php"><button class="btn rounded text-white" style="background-color:#129987">LLISTAR INCIDÈNCIES</button></a>
            </div>
            </div>
            
            <div class="col-md-6 text-center"> <!-- md: medium -->
                <h1 class="fw-bold text-center mb-5" style="margin-top: 60px">Crear incidència</h1>
                <form action="InsertIncidUser.php" method="POST" class="border border-success rounded" style="width:600px">
                
                    <div class="p-2">
                        <label class="fs-4 mt-4" for="descripcion">Descripció</label> <br>
                        <textarea name="descripcion" id="descripcion" placeholder="Descriu la incidència ..." cols="40" rows="10" required></textarea>
                    </div>
                    <div class="p-2">
                        <label class="fs-4" for="data">Data de la incidència</label>
                        <input type="date" name="data" required>
                    </div>    
                    <div class="p-2"> <!--el for busca al id del input-->
                        <label class="fs-4" for="departament">Departament</label>
                        <select name="departament" id="department">
                            <option value="1">Informàtica</option>
                            <option value="2">Català</option>
                            <option value="3">Matemàtiques</option>
                            <option value="4">Secretaria</option>
                        </select>
                    </div>
                <div class="form-group mb-3"><button class="btn btn-success">Crear</button></div>
            </form>
        </div>
    </div>
<?php include_once "footer.php"; ?>
