<?php

class Conectar{
    protected $dbh;
    protected function conexion(){
        try{
            $conectar = $this->dbh = new PDO('mysql:host=localhost;dbname=soap_ejercicio','root','');
            return $conectar;
        } catch (Exception $e){
            print "ERROR yin yon: " . $e->getMessage();
            die();
        }
    
    }

    public function set_names(){
        return $this->dbh->query("SET NAMES 'utf8'");
    }
}
?>