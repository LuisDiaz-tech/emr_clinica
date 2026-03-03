<?php

session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use Felipe\EmrClinica\Controllers\AuthController;

$auth = new AuthController();

if($_SERVER['REQUEST_METHOD']=='POST'){
    $login = $auth->login($_POST['username'], $_POST['password']);

    if(!$login){
        $error = "Credenciales invalidas";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login </h2>

    <?php if(!empty($error)) : ?>
        <p style="color:red;"><?php echo $error;?></p>
    <?php endif;?>
    
    <form method="POST">
        <input type="text" name="username" placeholder="Usuario" required> <br>
        <input type="password" name="password" placeholder="Contraseña" required> <br>
        <button type="submit">Ingresar</button>
    </form>
</body>
</html>