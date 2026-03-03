<?php

namespace Felipe\EmrClinica\Config;


class Database{
    private $host ="localhost";
    private $db ="emr_clinica";
    private $user = "postgres";
    private $pass = "Lucas2023.";
    private $port = "5432";

    public function connect(){
    try{
       $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db}";

        $pdo = new \PDO($dsn, $this->user, $this->pass);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $pdo;    
        }catch(\PDOException $e){
            die("Error conexión: " . $e->getMessage());
        }
    }


}