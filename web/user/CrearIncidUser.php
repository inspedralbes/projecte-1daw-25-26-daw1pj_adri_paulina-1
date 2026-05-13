<?php include_once "../header.php"; ?>

    <div class="container mt-5"> <!--con Margin Top: 5-->
        <div class="row justify-content-center align-items-center g-4"> <!-- -->
            <div class="col-md-5 text-center"> <!-- centrar img + txt -->
                <img src="../img/formularis-incidencies.jpg" alt="imatge d'un formulari d'incidències" class="img-fluid rounded shadow mb-4" style="max-width:400px"> <!-- fluid per moure l'imatge-->
                <div class="d-flex gap-2 justify-content-center mt-3" style="margin-top: 100px">
                    <a href="../index.php" class="btn btn-primary rounded text-white btn-index">INICI</a>
                    <a href="userList.php" class="btn btn-primary rounded text-white btn-index">LLISTAR INCIDÈNCIES</a>
            </div>
            </div>
            
            <div class="col-md-6 text-center" > <!-- md: medium -->
                <h1 class="fw-bold text-center mb-5" style="margin-top: 20px">Crear incidència</h1> <!--Color anterior del formulario: background-color: #60c7b6-->
                <form action="InsertIncidUser.php" method="POST" class="border rounded" style="width:600px; background: linear-gradient(172deg,rgba(96, 199, 182, 1) 0%, rgba(133, 199, 161, 1) 0%, rgba(95, 178, 222, 1) 100%);">
                
                    <div class="p-2">
                        <label class="fs-4 mt-4" for="descripcion">Descripció</label> <br>
                        <textarea name="descripcion" id="descripcion" placeholder="Descriu la incidència ..." cols="40" rows="10" required></textarea>
                    </div>  
                    <div class="p-2"> <!--el for busca al id del input-->
                        <label class="fs-4" for="departament">Departament</label>
                        <select name="departament" id="departament">
                            <option value="1">Informàtica</option>
                            <option value="2">Català</option>
                            <option value="3">Matemàtiques</option>
                            <option value="4">Secretaria</option>
                        </select>
                    </div>
                <div class="form-group mb-3"><button class="btn btn-outline-light border-3 shadow">Crear</button></div>
            </form>
        </div>
    </div>
<?php include_once "../footer.php"; ?>
