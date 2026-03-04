<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Felipe\EmrClinica\Controllers\DoctorController;
use Felipe\EmrClinica\Core\Auth;

Auth::role(['Administrador','Recepcionista']);

$controller = new DoctorController();
$doctors = $controller->index();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Medico</title>
</head>
<body>

<h1>Medicos</h1>
<a href="create_doctor.php">Crear medico</a><br></br>
<table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Especialidad</th>
            <th>Licencia</th>
            <th>Acciones</th>
        </tr>
        <?php  foreach($doctors as $d): ?>
        <tr>
            <td><?= $d['doctor_id']?></td>
            <td><?= $d['first_name']." ".$d['last_name']?>
            </td>
            <td><?= $d['speciality']?></td>
            <td><?= $d['license_number']?></td>
            <td>
                <a href="edit_doctor.php?id=<?= $d['doctor_id'] ?>">editar</a>
                <a href="doctors.php?delete<?= $d['doctor_id'] ?>">eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
</table>

</body>
</html>