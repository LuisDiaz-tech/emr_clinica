<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Felipe\EmrClinica\Core\Auth;
use Felipe\EmrClinica\Controllers\AppointmentController;

Auth::role(['Administrador']);

$controller = new AppointmentController();

$data=[];

if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['start']) && isset($_GET['end'])){
    $start=$_GET['start'];
    $end=$_GET['end'];

    $data=$controller->compliance($start,$end);
}

?>

<h2>Indicador de Cumplimiento</h2>

<form>

Fecha inicio

<input type="date" name="start" required>

Fecha fin

<input type="date" name="end" required>

<button type="submit">Consultar</button>

</form>

<br>

<table border="1">

<tr>
<th>Medico</th>
<th>Total Programadas</th>
<th>Atendidas</th>
<th>No Asiste</th>
<th>% Cumplimiento</th>
</tr>

<?php foreach($data as $r): ?>

<tr>

<td><?= $r['doctor'] ?></td>
<td><?= $r['total_programadas'] ?></td>
<td><?= $r['total_atendidas'] ?></td>
<td><?= $r['total_no_asiste'] ?></td>
<td><?= $r['cumplimiento'] ?>%</td>

</tr>

<?php endforeach; ?>

</table>

<br>

<a href="dashboard.php">Volver</a>