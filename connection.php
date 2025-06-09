<?php 

class Connection {

    private $con;
    protected function getConnection(?string $databaseName){
        $this-> con = new PDO("sn","","");
        return $this->con;
    }

    protected function closeConnection(){
        $this->con = null;
    }

}