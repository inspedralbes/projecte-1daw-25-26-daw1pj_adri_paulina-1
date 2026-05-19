# 🗄️ Documentació de MongoDB & Pipelines d'Auditoria

S'ha implementat **MongoDB Atlas** com a base de dades NoSQL per gestionar el sistema de logs, auditar les accions dels usuaris en temps real i generar analítiques d'accés sense carregar la base de dades relacional d'incidències.

## 📋 1. Registre de Logs Automatitzat (`mongo.php`)

Cada vegada que un usuari navega per l'aplicació, el fitxer `mongo.php` intercepta la petició i injecta un document a la col·lecció `logs`. S'ha programat per capturar de manera nativa els següents camps:

```php
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$pagina_actual = $_SERVER['REQUEST_URI'];
$hora = date("H:i:s");

$collection->insertOne([
    'ip_origin' => $ip,
    'page' => $pagina_actual,
    'method' => $_SERVER['REQUEST_METHOD'],
    'date' => $hora,
    'datetime' => date("d-m-Y H:i:s"),
    'usuari' => $_SESSION['role'] ?? null,
]);