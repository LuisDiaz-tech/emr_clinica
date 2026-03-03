<?php 

namespace Felipe\EmrClinica\Models;

use PDO;

class user{
    private PDO $conn;

    public function _construct(PDO $db){
        $this->conn = $db;
    }

    public function login($usrename,$password){
        $sql = "SELECT u.*, r.name as role_name
                FROM usuarios u
                JOIN roles r ON r.role_id = u.role_id
                WHERE u.username = :username
                AND u.status = 'activo";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['username'=> $username]);

        $user= $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password_hash'])){
            return $user;
        }
        return false;
    }
}