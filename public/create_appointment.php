<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Felipe\EmrClinica\Core\Auth;
use Felipe\EmrClinica\Controllers\AppointmentController;

Auth::role(['Administrador','Recepcionista']);

$controller = new AppointmentController();

$patients = $controller->getPatients();
$doctors = $controller->getDoctors();

if($_SERVER['REQUEST_METHOD']=="POST"){

    $_POST['user_id']=$_SESSION['user']['user_id'];

    $controller->store($_POST);

    header("Location: appointments.php");
    exit;
}

?>

<h2>Crear cita</h2>

<form method="POST">

Paciente

<select name="patient_id">

<?php foreach($patients as $p): ?>

<option value="<?= $p['patient_id'] ?>">
<?= $p['patient'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>

Medico

<select name="doctor_id">

<?php foreach($doctors as $d): ?>

<option value="<?= $d['doctor_id'] ?>">
<?= $d['doctor'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>

Fecha

<input type="datetime-local" name="scheduled_at" required>

<br><br>

Motivo

<input type="text" name="reason">

<br><br>

<button type="submit">Guardar cita</button>

</form>

<br>

<a href="appointments.php">Volver</a>