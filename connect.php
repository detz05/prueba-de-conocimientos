<?php

class connection
{
    private $con;
    public $isConnected = false;
    
    public function __construct(){
        $connectionString = "mysql:host=localhost;dbname=test;charset=utf8";
        try {
            $this->con = new PDO($connectionString, 'root', '');
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->isConnected = true;
        } catch (PDOException $th) {
            $this->isConnected = false;
            $this->con = false;
        }
    }

    public function query(string $query, ...$param){
        $this->arrValues = [];

        $stmt = $this->con->prepare($query);
        $stmt->execute($param);
        while($fetch = $stmt->fetch(PDO::FETCH_OBJ)):
            $this->arrValues[] = $fetch;
        endwhile;

        return $this->arrValues;
    }

    public function indelup(string $query, ...$param){
        $stmt = $this->con->prepare($query);
        $result = $stmt->execute($param);
        if($result){
            return true;
        }else{
            return false;
        }
    }
}
