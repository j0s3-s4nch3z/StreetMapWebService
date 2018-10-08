<?php
include './query/Query.php';

header('Content-Type: application/json');
$query = new Query();
$id = $_GET['recorrido']; 
$data = $query->isRecorridoEspecial($id);
echo $data + ' <<<';