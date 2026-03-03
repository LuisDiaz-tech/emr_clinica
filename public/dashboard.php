<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use Felipe\EmrClinica\Core\Auth;

Auth::check();

echo "<h2>Bienvenido " . $_SESSION['user']['username'] . "</h2>";
echo "<p>Rol: " . $_SESSION['user']['role_name'] . "</p>";