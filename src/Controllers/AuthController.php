<?php

namespace Felipe\EmrClinica\Controllers;

use Felipe\EmrClinica\Models\User;
use Felipe\EmrClinica\Config\Database;

class AuthController{
    public function login($username, $password){
    $database = new Database();
    $pdo = $database->connect();

    $userModel = new User($pdo);
    $user = $userModel->login($username,$password);

    if($user){
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
        exit;
    }
    return false;
    }

    public function logout(){
        session_destroy();
        header("Location: index.php");
        exit;
    }

}

