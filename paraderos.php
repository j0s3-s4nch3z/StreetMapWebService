<?php
include './query/Query.php';

header('Content-Type: application/json');
$query = new Query();
$stops = $query->obtenerParaderos();
echo "[";
for ($i = 0 ; $i < count($stops); $i++)
{
    $stopId = $stops[$i]->getStop_id();
    $stopCode = $stops[$i]->getStop_code();
    $stopName = $stops[$i]->getStop_name();
    $stopLat = $stops[$i]->getStop_lat();
    $stopLong = $stops[$i]->getStop_long();
    $stopUrl = $stops[$i]->getStop_url();
    echo "{\"stop_id\":\"".$stopId."\","
        //. "\"stop_code\":\"".$stopCode."\","
        . "\"stop_name\":\"".$stopName."\","
        . "\"stop_lat\":\"".$stopLat."\","
        . "\"stop_lon\":\"".$stopLong."\""
        //. "\"stop_url\":\"".$stopUrl."\""
        . "}";
    if (($i+1) != count($stops))
    {
        echo ",";
    }
}
echo "]";
