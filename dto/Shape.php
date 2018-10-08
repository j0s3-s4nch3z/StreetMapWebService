<?php

class Shape {

    private $route_id;
    private $latitud;
    private $longitud;
    private $sequence;
    
    function getRoute_id() {
        return $this->route_id;
    }

    function getLatitud() {
        return $this->latitud;
    }

    function getLongitud() {
        return $this->longitud;
    }

    function setRoute_id($route_id) {
        $this->route_id = $route_id;
    }

    function setLatitud($latitud) {
        $this->latitud = $latitud;
    }

    function setLongitud($longitud) {
        $this->longitud = $longitud;
    }
    
    function getSequence() {
        return $this->sequence;
    }

    function setSequence($sequence) {
        $this->sequence = $sequence;
    }
}


