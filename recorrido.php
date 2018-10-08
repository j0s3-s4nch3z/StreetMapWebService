<?php
include './query/Query.php';

header('Content-Type: application/json');
$query = new Query();
$id = $_GET['recorrido']; 
$sentido = $_GET['sentido'];
$especial = $query->isRecorridoEspecial($id);
if($especial == 1)
{
    $sentido = "i";
}
$data = $query->obtenerRecorrido($id,$sentido);
$routeId = $data->getRoute_id();
    $agencyId = $data->getAgency_id();
    $routeShortName = $data->getRoute_short_name();
    $routeLongName = $data->getRoute_long_name();
    $routeType = $data->getRoute_type();
    $routeColor = $data->getRoute_color();
    $routeTextColor = $data->getRoute_text_color();
    $routeSequence = $data->getRoute_sequence();
    echo "{\"route_id\":\"".$routeId."\","
        . "\"agency_id\":\"".$agencyId."\","
        . "\"route_sh_name\":\"".$routeShortName."\","
        . "\"route_ln_nme\":\"".$routeLongName."\","
        . "\"route_type\":\"".$routeType."\","
        . "\"route_color\":\"".$routeColor."\","
        . "\"route_tx_color\":\"".$routeTextColor."\","
         ."\"route_shapes\":[";
        $shapes = $data->getShapes();
        //$shapes = $query->obtenerFormasRecorrido($id,$sentido);
        for($i = 0 ; $i < count($shapes); $i++)
        {
            $shape_pt_lat = $shapes[$i]->getLatitud();
            $shape_pt_lon = $shapes[$i]->getLongitud();
            $shape_pt_sequence = $shapes[$i]->getSequence();
            echo "{\"shape_route_id\":\"".$routeId."\","
                . "\"shape_pt_lat\":\"".$shape_pt_lat."\","
                . "\"shape_pt_lon\":\"".$shape_pt_lon."\","
                . "\"shape_pt_sequence\":\"".$shape_pt_sequence."\"}";
                    
            if (($i+1) != count($shapes))
            {
                echo ",";
            }
        }
        echo "],"
        . "\"route_sequence\":\"".$routeSequence."\""
        . "}";
    