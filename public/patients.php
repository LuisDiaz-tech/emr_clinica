<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Felipe\EmrClinica\Controllers\PatientController;

session_start();

$controller = new PatientController();
$patients = $controller->index();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Listado de Pacientes</title>
</head>
<body>

<h1>Pacientes</h1>

<a href="create_patient.php">Crear nuevo paciente</a>

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Documento</th>
            <th>Teléfono</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($patients as $patient): ?>
            <tr>
                <td><?= $patient['patient_id'] ?></td>
                <td><?= $patient['first_name'] . ' ' . $patient['last_name'] ?></td>
                <td><?= $patient['document_number'] ?></td>
                <td><?= $patient['phone'] ?></td>
                <td><?= $patient['email'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>