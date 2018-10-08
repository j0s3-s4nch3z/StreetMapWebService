<?php
include './query/Query.php';

header('Content-Type: application/json');
$usuario = $_GET['usuario'];
$query = new Query();
$data = $query->obtenerUsuario($usuario);
echo "{\"usuario\":\"".$data."\"}";
