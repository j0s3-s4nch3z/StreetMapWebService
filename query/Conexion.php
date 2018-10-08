<?php

class Conexion {
    
    private $host="localhost";
    private $port="5432";
    private $user="postgres";
    private $pass="12345";
    private $dbname="streetmap";

    private $conn;
    
    function conectar()
    {       $conn_string = "host=".$this->host." port=$this->port dbname=$this->dbname user=$this->user password=$this->pass";
            $this->conn = pg_connect($conn_string);
            if($this->conn)
            {
                return true;
            } 
        return false;
    }
    
    function desconectar()
    {
        pg_close($this->conn);
    }
}
