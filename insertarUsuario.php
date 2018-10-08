<?php
include './query/Query.php';

header('Content-Type: text/plain');
$usuario = $_POST['usuario'];
$query = new Query();
$data = $query->insertarUsuario($usuario);

echo "insertado";

