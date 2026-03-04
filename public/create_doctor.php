<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Felipe\EmrClinica\Core\Auth;
use Felipe\EmrClinica\Controllers\DoctorController;

Auth::role(['Administrador']);

$controller = new DoctorController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $controller->store($_POST);

    header("Location: doctors.php");
    exit;
}

?>

<h2>Crear medico</h2>

<form method="POST">
    <input type="text" name="first_name" placeholder="Nombre" required><br><br>
    <input type="text" name="last_name" placeholder="Apellido" required><br><br>
    <input type="text" name="license_number" placeholder="Licencia" required><br><br>
    <input type="text" name="phone" placeholder="Teléfono"><br><br>
    <input type="email" name="email" placeholder="Email"><br><br>
    <select name="specialty_id">
        <option value="1">Medicina General</option>
        <option value="2">Cardiologia</option>
        <option value="3">Pediatria</option>
    </select><br><br>

    <button type="submit">Guardar</button>
    <br></br><a href="doctors.php">Volver al listado</a>
</form>