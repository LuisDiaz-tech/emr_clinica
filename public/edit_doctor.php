<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Felipe\EmrClinica\Core\Auth;
use Felipe\EmrClinica\Controllers\DoctorController;

Auth::role(['Administrador']);

$controller = new DoctorController();

$id = $_GET['id'];

$doctor = $controller->edit($id);

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $controller->update($id,$_POST);

    header("Location: doctors.php");

    exit;
}

?>

<h2>Editar médico</h2>

<form method="POST">

<input type="text" name="first_name" value="<?= $doctor['first_name'] ?>">

<input type="text" name="last_name" value="<?= $doctor['last_name'] ?>">

<input type="text" name="license_number" value="<?= $doctor['license_number'] ?>">

<input type="text" name="phone" value="<?= $doctor['phone'] ?>">

<input type="email" name="email" value="<?= $doctor['email'] ?>">

<select name="specialty_id">

<option value="1">Medicina General</option>
<option value="2">Cardiologia</option>
<option value="3">Pediatria</option>

</select>

<button type="submit">Actualizar</button>

</form>

<a href="doctors.php">Volver</a>