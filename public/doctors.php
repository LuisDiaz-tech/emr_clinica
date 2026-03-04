<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Felipe\EmrClinica\Controllers\DoctorController;
use Felipe\EmrClinica\Core\Auth;

Auth::role(['administrador','recepcionista']);

$controller = new DoctorController();
$doctors = $controller->index();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Listado de Pacientes</title>
</head>
<body>

<h1>Pacientes</h1>
<a href="create_doctor.php">Crear medico</a><br></br>
<form method="GET">
    <input type="text" name="search" placeholder="Buscar por nombre o el numero de documento">
    <button type="submit">Buscar</button>
    <a href="patients.php">Limpiar</a> <br></br>
</form>
<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Documento</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Acciones</th>
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
                <td><a href="edit_patient.php?id=<?= $patient['patient_id'] ?>">Editar</a>
                    <a href="patients.php?delete=<?= $patient['patient_id']?>" 
                            onclick="return confirm('Está seguro que quiere eliminar este paciente?')">Eliminar</a> </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>