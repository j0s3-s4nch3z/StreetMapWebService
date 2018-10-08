<?php

class Route {
    
    private $route_id;
    private $agency_id;
    private $route_short_name;
    private $route_long_name;
    private $route_type;
    private $route_color;
    private $route_text_color;
    private $shapes;
    private $route_sequence;
    
    function getRoute_id() {
        return $this->route_id;
    }

    function getAgency_id() {
        return $this->agency_id;
    }

    function getRoute_short_name() {
        return $this->route_short_name;
    }

    function getRoute_long_name() {
        return $this->route_long_name;
    }

    function getRoute_type() {
        return $this->route_type;
    }

    function getRoute_color() {
        return $this->route_color;
    }

    function getRoute_text_color() {
        return $this->route_text_color;
    }

    function getShapes() {
        return $this->shapes;
    }

    function getRoute_sequence() {
        return $this->route_sequence;
    }

    function setRoute_id($route_id) {
        $this->route_id = $route_id;
    }

    function setAgency_id($agency_id) {
        $this->agency_id = $agency_id;
    }

    function setRoute_short_name($route_short_name) {
        $this->route_short_name = $route_short_name;
    }

    function setRoute_long_name($route_long_name) {
        $this->route_long_name = $route_long_name;
    }

    function setRoute_type($route_type) {
        $this->route_type = $route_type;
    }

    function setRoute_color($route_color) {
        $this->route_color = $route_color;
    }

    function setRoute_text_color($route_text_color) {
        $this->route_text_color = $route_text_color;
    }

    function setShapes($shapes) {
        $this->shapes = $shapes;
    }

    function setRoute_sequence($route_sequence) {
        $this->route_sequence = $route_sequence;
    }


    
    
    
}
