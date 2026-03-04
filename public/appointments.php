<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Felipe\EmrClinica\Core\Auth;
use Felipe\EmrClinica\Controllers\AppointmentController;

Auth::role(['Administrador','Recepcionista','Medico']);

$controller = new AppointmentController();
$appointments = $controller->index();

?>

<h2>Agenda de Citas</h2>

<a href="create_appointment.php">Crear cita</a>

<table border="1">

<tr>
<th>ID</th>
<th>Paciente</th>
<th>Medico</th>
<th>Fecha</th>
<th>Estado</th>
<th>Motivo</th>
</tr>

<?php foreach($appointments as $a): ?>

<tr>

<td><?= $a['appointment_id'] ?></td>
<td><?= $a['patient'] ?></td>
<td><?= $a['doctor'] ?></td>
<td><?= $a['scheduled_at'] ?></td>
<td><?= $a['status'] ?></td>
<td><?= $a['reason'] ?></td>

</tr>

<?php endforeach; ?>

</table>

<br>
<a href="dashboard.php">Volver</a>