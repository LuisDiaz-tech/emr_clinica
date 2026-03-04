<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Felipe\EmrClinica\Controllers\PatientController;

$controller = new PatientController();

if(!isset($_GET['id'])){
    header("Location: patients.php");
    exit;
}

$id= (int) $_GET['id'];
$patient = $controller->edit($id);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $controller->update($id,$_POST);
    header("Location: patients.php");
    exit;
}
?>
<h2> Editar paciente </h2>
<form method="POST">
    <input type="text" name="first_name" value="<?= $patient['first_name'] ?>" required>
    <input type="text" name="last_name" value="<?= $patient['last_name'] ?>" required>
    <input type="text" name="phone" value="<?= $patient['phone'] ?>" required>
    <input type="email" name="email" value="<?= $patient['email'] ?>" required>
    <button type="submit">Actualizar</button>
</form>
<a href="patients.php">Volver</a>