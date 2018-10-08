<?php

class Stop {
    private $stop_id;
    private $stop_Code;
    private $stop_name;
    private $stop_lat;
    private $stop_long;
    private $stop_url;
    private $routes;
    
    function getStop_id() {
        return $this->stop_id;
    }

    function getStop_Code() {
        return $this->stop_Code;
    }

    function getStop_name() {
        return $this->stop_name;
    }

    function getStop_lat() {
        return $this->stop_lat;
    }

    function getStop_long() {
        return $this->stop_long;
    }

    function getStop_url() {
        return $this->stop_url;
    }

    function getRoutes() {
        return $this->routes;
    }

    function setStop_id($stop_id) {
        $this->stop_id = $stop_id;
    }

    function setStop_Code($stop_Code) {
        $this->stop_Code = $stop_Code;
    }

    function setStop_name($stop_name) {
        $this->stop_name = $stop_name;
    }

    function setStop_lat($stop_lat) {
        $this->stop_lat = $stop_lat;
    }

    function setStop_long($stop_long) {
        $this->stop_long = $stop_long;
    }

    function setStop_url($stop_url) {
        $this->stop_url = $stop_url;
    }

    function setRoutes($routes) {
        $this->routes = $routes;
    }


}
