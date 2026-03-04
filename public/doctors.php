<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Felipe\EmrClinica\Controllers\DoctorController;
use Felipe\EmrClinica\Core\Auth;

Auth::role(['Administrador']);

$controller = new DoctorController();

$doctors = [];

if(isset($_GET['search']) && !empty($_GET['search'])){
   $doctors = $controller->search($_GET['search']);
} else {
    $doctors = $controller->index();    
}

if(isset($_GET['delete'])){
    $controller->destroy($_GET['delete']);
    header("Location: doctors.php");
    exit;
}
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
                <a href="doctors.php?delete=<?= $d['doctor_id'] ?>"
                onclick="return confirm('¿Eliminar médico?')">eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
</table>
<br></br><a href="dashboard.php">Volver al menú</a>
</body>
</html>