<?php
include './query/Query.php';

header('Content-Type: application/json');
$fp = fopen("posicionamiento.json", "r");
$query = new Query();
while (!feof($fp)){
    $json = json_decode(fgets($fp),true);
}
$recorridos = $_REQUEST['recorridos'];
$str = "";
print "[";
foreach($json['posiciones'] as $item) {
    $data = explode(";", $item);
    $recorrido = $query->obtenerNombreRealRecorrido($data[7]);
    if(strpos($recorridos,$recorrido."I") !== false || strpos($recorridos,$recorrido."R") !== false)
    {
        $fechaTransmision = $data[0];
        $patente = $data[1];
        $latitud = $data[2];
        $longitud = $data[3];
        $velocidad = $data[4];
        $dirGeografica = $data[5];
        $numOperador = $data[6];
        $sentido = $data[8];
        $rutaConsola = $data[9];
        $rutaSinoptico = $data[10];
        $fechaInsercion = $data[11];
        if(strpos($recorridos, $recorrido.$sentido) !== false)
        {
            $str = $str . "{\"recorrido\":\"".$recorrido."\","
            . "\"patente\":\"".$patente."\","
            . "\"latitud\":\"".$latitud."\","
            . "\"longitud\":\"".$longitud."\","
            . "\"fecha_transmision\":\"".$fechaTransmision."\","
            . "\"velocidad\":\"".$velocidad."\","
            . "\"operador\":\"".$numOperador."\","
            . "\"sentido\":\"".$sentido."\","
            . "\"ruta_consola\":\"".$rutaConsola."\","
            . "\"ruta_sinoptico\":\"".$rutaSinoptico."\","
            . "\"fecha_insercion\":\"".$fechaInsercion."\","
            . "\"direccion_geografica\":\"".$dirGeografica."\""
            . "},";
        }
    }
}

print substr($str,0,-1);
print "]";
fclose($fp);