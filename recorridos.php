<?php
include './query/Query.php';

header('Content-Type: application/json');
$query = new Query();
$data = $query->obtenerRecorridos();
echo "[";
for ($i = 0 ; $i < count($data); $i++)
{
    $routeId = $data[$i]->getRoute_id();
    $agencyId = $data[$i]->getAgency_id();
    $routeShortName = $data[$i]->getRoute_short_name();
    $routeLongName = $data[$i]->getRoute_long_name();
    $routeType = $data[$i]->getRoute_type();
    $routeColor = $data[$i]->getRoute_color();
    $routeTextColor = $data[$i]->getRoute_text_color();
    $routeSequence = $data[$i]->getRoute_sequence();
    echo " {\"route_id\":\"".$routeId."\","
        . "\"agency_id\":\"".$agencyId."\","
        . "\"route_sh_name\":\"".$routeShortName."\","
        . "\"route_ln_nme\":\"".$routeLongName."\","
        . "\"route_type\":\"".$routeType."\","
        . "\"route_color\":\"".$routeColor."\","
        . "\"route_tx_color\":\"".$routeTextColor."\""
        . "}";
    if (($i+1) != count($data))
    {
        echo ",";
    }
}
echo "]";
