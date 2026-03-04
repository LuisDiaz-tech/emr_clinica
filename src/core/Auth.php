<?php

namespace Felipe\EmrClinica\Core;
session_start();

Class Auth{

    public static function check(){
        if(!isset($_SESSION['user'])){
            header("Location: index.php");
            exit;
        }
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");
        header("Expires: 0");
    }

    public static function role(array $allowedRoles = []){
        if(!isset($_SESSION['user'])){
            header("Location: index.php");
            exit;
        }
        if(!in_array($_SESSION['user']['role_name'],$allowedRoles)){
            echo "Acceso no autorizado";
            exit;
        }
    }
}