<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Felipe\EmrClinica\Controllers\PatientController;

session_start();

Auth::role(['Administrador','Recepcionista']);

$controller = new PatientController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'date_of_birth' => $_POST['date_of_birth'],
        'gender' => $_POST['gender'],
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'document_number' => $_POST['document_number'],
        'address' => $_POST['address'],
        'insurance_number' => $_POST['insurance_number']
    ];

    $controller->store($data);

    header("Location: patients.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Paciente</title>
</head>
<body>

<h1>Crear Paciente</h1>

<form method="POST">
    <input type="text" name="first_name" placeholder="Nombre" required><br><br>
    <input type="text" name="last_name" placeholder="Apellido" required><br><br>
    <input type="date" name="date_of_birth" required><br><br>
    <select name="gender">
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
    </select><br><br>
    <input type="text" name="phone" placeholder="Teléfono"><br><br>
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="text" name="document_number" placeholder="Documento" required><br><br>
    <input type="text" name="address" placeholder="Dirección"><br><br>
    <input type="text" name="insurance_number" placeholder="Seguro"><br><br>

    <button type="submit">Guardar</button>
</form>

<br>
<a href="patients.php">Volver al listado</a>

</body>
</html>