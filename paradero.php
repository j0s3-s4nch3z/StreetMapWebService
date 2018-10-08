<?php
include './query/Query.php';

header('Content-Type: application/json');
$query = new Query();
$stopId = $_GET['paradero'];
$stop = $query->obtenerParadero($stopId);
$data = $query->obtenerParaderoRutas($stopId);
$routes = $data->getRoutes();
echo "{\"stop_id\":\"".strtoupper($stopId)."\","
     ."\"stop_lat\":\"".$stop->getStop_lat()."\","
     ."\"stop_lon\":\"".$stop->getStop_long()."\","
     ."\"stop_routes\":[";
for($i = 0 ; $i < count($routes); $i++)
{
    echo "\"".$routes[$i]."\"";
    if (($i+1) != count($routes))
    {
        echo ",";
    }
}
    echo "]}";

    