<?php


require_once __DIR__ . '/../vendor/autoload.php';

use Felipe\EmrClinica\Core\Auth;

Auth::check();

echo "<h2>Bienvenido " . $_SESSION['user']['username'] . "</h2>";
echo "<p>Rol: " . $_SESSION['user']['role_name'] . "</p>";

$role = $_SESSION['user']['role_name'];

if($role == 'Administrador' || $role == 'Recepcionista'){
    echo '<a href="patients.php">Gestion de Pacientes</a><br>';
}

if($role == 'Administrador'){
    echo '<a href="doctors.php">Gestion de Medicos</a><br>';
}

if($role == 'Administrador' || $role == 'Recepcionista'){
    echo '<a href="appointments.php">Agenda de citas</a><br>';
}

if($role == 'Administrador'){
    echo '<a href="report_compliance.php">Reporte de cumplimiento</a><br>';
}

if($role == 'Medico'){
    echo '<a href="my_appointments.php">Mis citas</a><br>';
}

echo "<br><a href='logout.php'>Cerrar sesión</a>";