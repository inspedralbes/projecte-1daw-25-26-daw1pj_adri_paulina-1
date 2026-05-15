<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://admin:pass@mongo:27017");

$collection = $client->logs->logs;

// Obtenim l'adreça IP origen de la petció.
// Teniu informació sobre l'operador ?? a 
// https://phpsensei.es/operadores-en-php-null-coalesce-operator/
// "Si no es pot obtenir, es fa servir 'unknown' com a valor per defecte"

$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$pagina_actual = $_SERVER['REQUEST_URI'];
$hora = date("H:i:s");

# SYSTEM LOGS
$collection->insertOne([
    'ip_origin' => $ip,
    'page' => $pagina_actual,
    'method' => $_SERVER['REQUEST_METHOD'],
    'date' => $hora,
    'datetime' => date("d-m-Y H:i:s")
]);
# Per guardar el 10 últims logs (la variable la utilitzem a un altre doc.)
$logs = $collection->find([],
[
    'sort' => ['_id' => -1],
    'limit' => 10
]);
?>