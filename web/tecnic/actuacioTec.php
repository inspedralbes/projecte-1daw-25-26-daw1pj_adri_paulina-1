<?php
$_SESSION['role'] = 'tecnic';
include_once "../header.php";
?>

<div class="container mt-5"> <!--con Margin Top: 5-->
    <div class="row justify-content-center align-items-center g-4"> <!-- -->
        <div class="col-12 col-md-5 text-center"> <!-- centrar img + txt -->
            <img src="../img/registre-actuacio-img.jpg" alt="imatge tècnic arreglant errors." class="img-fluid rounded shadow mb-4"> <!-- fluid per moure l'imatge-->

        </div>

        <div class="col-md-6 text-center"> <!-- md: medium -->
            <h1 class="fw-bold text-center mb-5">Afegir actuació</h1>
            <form id="formActuacio" action="insertActuacio.php" method="POST" class="border border-success rounded mx-auto w-100" style="max-width:600px; background: linear-gradient(135deg, #ffcc80, #ff924a);">
                <div class="p-2">
                    <label class="fs-4 mt-3" for="visible">Visibilitat</label> <br>
                    <select name="visible" id="visible" class="form-select w-50 mx-auto">
                        <option value="0">No visible</option>
                        <option value="1">Visible</option>
                    </select> <br>
                    <label class="fs-4 mt-2" for="temps">Temps dedicat (minuts)</label> <br>
                    <input type="text" name="duracio" id="temps" class="form-control w-50 mx-auto" placeholder="Nombre de minuts..."><br>
                    <label class="fs-4 mt-2" for="descripcion">Descripció</label> <br>
                    <textarea name="descripcio" class="form-control w-75 mx-auto" id="descripcion" placeholder="Descriu l'actuació..." cols="40" rows="10" aria-describedby="error-descripcion"></textarea>
                    <div id="error-descripcion" class="invalid-feedback bg-white p-1 rounded mt-1">
                        La descripció és obligatòria (mínim 10 caràcters).
                    </div>
                <input type="hidden" name="idIncidencia" value="<?php echo htmlspecialchars($_GET['id'] ?? $_GET['idIncidencia'] ?? ''); ?>">
                </div>
                <div class="form-group mb-4 mt-3"><button class="btn btn-outline-light border-3 shadow">Crear</button></div>
            </form>
        </div>
        <div class="d-flex gap-2 justify-content-center mt-5 mb-5">
            <a href="../index.php" class="btn btn-primary rounded text-white btn-index">INICI</a>
            <a href="tecnic.php" class="btn btn-primary rounded text-white btn-index">TORNAR</a>
        </div>
    </div>

    <script>
        document.getElementById('formActuacio').addEventListener('submit', function(event) {
            let formValido = true;

            const descField = document.getElementById('descripcion');

            descField.classList.remove('is-invalid');

            if (descField.value.trim().length < 10) {
                descField.classList.add('is-invalid');
                descField.setAttribute('aria-invalid', 'true');
                formValido = false;
            } else {
                descField.removeAttribute('aria-invalid');
            }

            if (!formValido) {
                event.preventDefault();
                event.stopPropagation();
            }
        })
    </script>
    <?php include_once "../footer.php"; ?>