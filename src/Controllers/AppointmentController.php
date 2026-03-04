<?php

namespace Felipe\EmrClinica\Controllers;

use Felipe\EmrClinica\Config\Database;
use Felipe\EmrClinica\Models\Appointment;
use Felipe\EmrClinica\Models\Doctor;
use Felipe\EmrClinica\Models\Patient;

class AppointmentController{

    private $appointment;
    private $doctor;
    private $patient;

    public function __construct(){

        $database = new Database();
        $pdo = $database->connect();

        $this->appointment = new Appointment($pdo);
        $this->doctor = new Doctor($pdo);
        $this->patient = new Patient($pdo);
    }

    public function index(){
        return $this->appointment->getAll();
    }

    public function getDoctors(){
    return $this->doctor->getForSelect();
    }

    public function getPatients(){
    return $this->patient->getForSelect();
    }

    public function store($data){

        if(strtotime($data['scheduled_at']) < time()){
            die("No se pueden agendar citas en fechas pasadas");
        }

        if($this->appointment->doctorBusy($data['doctor_id'],$data['scheduled_at'])){
            die("El medico ya tiene una cita en ese horario");
        }

        return $this->appointment->create($data);
    }

    public function compliance($start,$end){
    return $this->appointment->compliance($start,$end);
    }

    public function myAppointments($doctor_id){
    return $this->appointment->myAppointments($doctor_id);
}
}