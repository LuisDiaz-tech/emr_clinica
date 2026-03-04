<?php

namespace Felipe\EmrClinica\Models;

class Appointment{

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getAll(){

        $sql = "SELECT 
                    a.appointment_id,
                    p.first_name || ' ' || p.last_name AS patient,
                    m.first_name || ' ' || m.last_name AS doctor,
                    a.scheduled_at,
                    a.status,
                    a.reason
                FROM citas a
                JOIN pacientes p ON a.patient_id = p.patient_id
                JOIN medicos m ON a.doctor_id = m.doctor_id
                ORDER BY a.scheduled_at DESC";

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

   

}