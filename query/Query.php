<?php

include 'Conexion.php';
include 'dto/Route.php';
include 'dto/Stop.php';
include 'dto/Shape.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Query
 *
 * @author elsan
 */
class Query {

    function obtenerRecorridos() {
        $routes = array();
        $conn = new Conexion();
        try {
            $conn->conectar();
            $query = "SELECT * FROM routes r WHERE r.route_id not in (SELECT br.route_id FROM banned_routes br WHERE banned_type = 0) ORDER BY route_id"; 
            $result = pg_query($query); 
            while($row = pg_fetch_array($result)) {
                $route = new Route();
                $route->setRoute_id($row["route_id"]);
                $route->setAgency_id($row["agency_id"]);
                $route->setRoute_short_name($row["route_short_name"]);
                $route->setRoute_long_name($row["route_long_name"]);
                $route->setRoute_type($row["route_type"]);
                $route->setRoute_color($row["route_color"]);
                $route->setRoute_text_color($row["route_text_color"]);
                array_push($routes, $route);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } 
        //finally {
            //$conn->desconectar();
        //}
        return $routes;
    }
    
    function obtenerParaderos() {
        $stops = array();
        $conn = new Conexion();
        try {
            $conn->conectar();
            $query = "SELECT stop_id,stop_name,stop_lat,stop_lon FROM stops"; 
            $result = pg_query($query); 
            while($row = pg_fetch_array($result)) {
                $stop = new Stop();
                $stop->setStop_id($row["stop_id"]);  
                //$stop->setStop_Code($row["stop_code"]);
                $stop->setStop_name($row["stop_name"]);
                $stop->setStop_lat($row["stop_lat"]);
                $stop->setStop_long($row["stop_lon"]);
                //$stop->setStop_url($row["stop_url"]);
                array_push($stops, $stop);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } 
        //finally {
            //$conn->desconectar();
        //}
        return $stops;
    }
    
    function obtenerParadero($stopId) {
        $stop = new Stop();
        $conn = new Conexion();
        try {
            $conn->conectar();
            $query = "SELECT * FROM stops WHERE stop_id = '".$stopId."'"; 
            $result = pg_query($query); 
            while($row = pg_fetch_array($result)) {
                $stop->setStop_id($row["stop_id"]);  
                $stop->setStop_Code($row["stop_code"]);
                $stop->setStop_name($row["stop_name"]);
                $stop->setStop_lat($row["stop_lat"]);
                $stop->setStop_long($row["stop_lon"]);
                $stop->setStop_url($row["stop_url"]);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } 
        //finally {
            //$conn->desconectar();
        //}
        return $stop;
    }
    function obtenerParaderoRutas($stopId) {
        $stop = new Stop();
        $conn = new Conexion();
        $routes = array();
        try {
            $conn->conectar();
            $query = "select distinct split_part(trip_id,'-',1)as route,split_part(trip_id,'-',2) as sentido from stop_times where stop_id = '".$stopId."' order by 1"; 
            $result = pg_query($query); 
            while($row = pg_fetch_array($result)) {
                array_push($routes, $row['route'].'-'.$row['sentido']);
            }
            $stop->setRoutes($routes);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        //finally {
        //    $conn->desconectar();
        //}
        return $stop;
    }
    
    function obtenerLineaMetro($linea) {
        $route = new Route();
        $conn = new Conexion();
        try {
            $conn->conectar();
            $query = "SELECT * FROM routes WHERE route_type in (0,1) AND route_id ilike '".$linea."%'"; 
            $result = pg_query($query); 
            while($row = pg_fetch_array($result)) {
                $route = new Route();
                $route->setRoute_id($linea);
                $route->setAgency_id($row["agency_id"]);
                $route->setRoute_short_name($row["route_short_name"]);
                $route->setRoute_long_name($row["route_long_name"]);
                $route->setRoute_type($row["route_type"]);
                $route->setRoute_color($row["route_color"]);
                $route->setRoute_text_color($row["route_text_color"]);
                $shapes = $this->obtenerFormasMetro($linea);
                $route->setShapes($shapes);
                //$route->setRoute_sequence($row["route_sequence"]);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } 
        //finally {
        //    $conn->desconectar();
        //}
        return $route;
    }
    
    function obtenerRecorrido($recorrido,$sentido) {
        $route = new Route();
        $conn = new Conexion();
        try {
            $conn->conectar();
            $query = "SELECT * FROM routes r left join special_routes sr on r.route_id = sr.route_id WHERE r.route_type = 3 AND r.route_id ilike '".$recorrido."'"; 
            $result = pg_query($query); 
            while($row = pg_fetch_array($result)) {
                $route = new Route();
                $route->setRoute_id($recorrido);
                $route->setAgency_id($row["agency_id"]);
                $route->setRoute_short_name($row["route_short_name"]);
                $route->setRoute_long_name($row["route_long_name"]);
                $route->setRoute_type($row["route_type"]);
                $route->setRoute_color($row["route_color"]);
                $route->setRoute_text_color($row["route_text_color"]);
                $shapes = $this->obtenerFormasRecorrido($recorrido,$sentido);
                $route->setShapes($shapes);
                $route->setRoute_sequence($row["route_sequence"]);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } 
        //finally {
        //    $conn->desconectar();
        //}
        return $route;
    }
    
    function obtenerFormasRecorrido($recorrido,$sentido){
        $shapes = array();
        $conn = new Conexion();
        try {
            $conn->conectar();
            $query = "SELECT * FROM shapes WHERE shape_id ILIKE '".$recorrido.$sentido."%' and shape_id not like '%PM%' and shape_id not like '%TNOCPT%' and shape_id not like '%PT%' and shape_id not like '%PRN%' and shape_id not like '%IN%' and shape_id not like '%RN%' and shape_id not like '%RTNOC%' ORDER BY shape_pt_sequence"; 
            $result = pg_query($query); 
            while($row = pg_fetch_array($result)) {
                $shape = new Shape();
                $shape->setRoute_id($recorrido);
                $shape->setLatitud($row["shape_pt_lat"]);
                $shape->setLongitud($row["shape_pt_lon"]);
                $shape->setSequence($row["shape_pt_sequence"]);
                array_push($shapes, $shape);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $shapes;
    }
    function obtenerFormasMetro($linea){
        $shapes = array();
        $conn = new Conexion();
        try {
            $conn->conectar();
            $query = "SELECT * FROM shapes WHERE shape_id ILIKE '".$linea."-I%' ORDER BY shape_pt_sequence"; 
            $result = pg_query($query); 
            while($row = pg_fetch_array($result)) {
                $shape = new Shape();
                $shape->setRoute_id($linea);
                $shape->setLatitud($row["shape_pt_lat"]);
                $shape->setLongitud($row["shape_pt_lon"]);
                $shape->setSequence($row["shape_pt_sequence"]);
                array_push($shapes, $shape);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $shapes;
    }
    
    function obtenerNombreRealRecorrido($recorrido){
        $conn = new Conexion();
        try {
            $conn->conectar();
            $query = "SELECT route_id FROM routes WHERE route_translate = '".$recorrido."'"; 
            $result = pg_query($query); 
            while($row = pg_fetch_array($result)) {
                return $row['route_id'];
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $recorrido;
    }
    
    function isRecorridoEspecial($recorrido){
        $conn = new Conexion();
        $especial = 0;
        try {
            $conn->conectar();
            $query = "SELECT route_id FROM special_routes WHERE route_id = '".strtoupper($recorrido)."'"; 
            $result = pg_query($query); 
            while($row = pg_fetch_array($result)) {
                $especial = 1;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $especial;
    }
    
    function obtenerUsuario($usuario){
        $conn = new Conexion();
        $existe = "no";
        try {
            $conn->conectar();
            $query = "SELECT * FROM \"user\" WHERE android_id = '".$usuario."'"; 
            $result = pg_query($query); 
            while($row = pg_fetch_array($result)) {
                $existe = "si";
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $existe;
    }
    
    function insertarUsuario($usuario)
    {
        $conn = new Conexion();
        try {
            $conn->conectar();
            $query = "INSERT INTO \"user\" (android_id) VALUES ('".$usuario."')"; 
            pg_query($query); 
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }


function obtenerHorario($recorrido,$sentido){
        $conn = new Conexion();
        try {
            $conn->conectar();
            $query = "SELECT MIN(start_time),MAX(end_time) FROM frequencies WHERE trip_id ilike '".$recorrido."-".$sentido."%' AND trip_id ILIKE '%D_V40%'";
            $result = pg_query($query); 
            while($row = pg_fetch_array($result)) {
                
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $shapes;
    }
}

