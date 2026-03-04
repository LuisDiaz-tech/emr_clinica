<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Felipe\EmrClinica\Core\Auth;
use Felipe\EmrClinica\Controllers\AppointmentController;

Auth::role(['Medico']);

$controller = new AppointmentController();

$doctor_id = $_SESSION['user']['user_id'];

$appointments = $controller->myAppointments($doctor_id);

?>

<h2>Mis citas</h2>

<table border="1">

<tr>
<th>Paciente</th>
<th>Fecha</th>
<th>Motivo</th>
<th>Estado</th>
</tr>

<?php foreach($appointments as $a): ?>

<tr>
<td><?= $a['patient'] ?></td>
<td><?= $a['scheduled_at'] ?></td>
<td><?= $a['reason'] ?></td>
<td><?= $a['status'] ?></td>
</tr>

<?php endforeach; ?>

</table>

<br>

<a href="dashboard.php">Volver</a>