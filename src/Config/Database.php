<?php

namespace Felipe\EmrClinica\Config;

use PDO;
use PDOException;

Class Database{
    private $host ="localhost";
    private $db ="emr_clinica";
    private $user = "postgres";
    private $pass = "Lucas2023.";
    private $port = "5432";

    public function connect(){
    try{
        $pdo = new PDO("pgqsl:host={$this->host};port={$this->port};dbname={$this->db}",$this->user,$this->pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;    
        }catch(PDOException $e){
            die("Error conexión: " . $e->getMessage());
        }
    }


}