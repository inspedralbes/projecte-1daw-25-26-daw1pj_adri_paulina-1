<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$_SESSION['role'] = 'tecnic';

include_once "../header.php"; 

if (!isset($mysqli)) { $mysqli = include "../conexion.php"; }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $desc = $_POST["descripcio"]; /*$variable  [columna] */
        $idInc = $_POST["idIncidencia"]; // Necesitas saber a qué incidencia pertenece
        $duracio = $_POST["duracio"];    // Duración de la actuación
        $visible = $_POST["visible"]; // "Boolean" para visibilidad
    #id i data es autocompleten amb ID autoincremental i SYSDATE()
        $sentencia = $mysqli -> prepare("INSERT INTO ACTUACIO (descripcio, data, incidencia, visible, duracio)
        VALUES (?,SYSDATE(),?,?,?)"
        );
        // prepare() & bind_param() preveuen SQL injections
        $sentencia -> bind_param("siii", $desc, $idInc, $visible, $duracio);
                /*data type we wanna introduce: string, date, int */
        $sentencia -> execute();
        // Un cop fet l'INSERT, obtenim l'ID de la nova fila
        $idActuacio = $mysqli->insert_id; // últim ID (el de la nova fila insertada)
    }
    ?>

    <?php if (isset($idActuacio)): ?>
        <div class='container mt-5 text-center'>
            <img src='../img/AnimatedForm.gif' alt='A gif de un formulario siendo enviado' class='img-fluid mb-5 rounded shadow' style='max-width: 300px;'>
            <h1>Actuació registrada amb èxit!</h1>
            <p>ID de l'actuació: <?php echo $idActuacio; ?></p>
            <a href='tecnic.php' class='btn btn-primary'>Torna a la llista</a>
        </div>
    <?php endif; 
?>