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

    public function create($data){

        $sql = "INSERT INTO citas
                (patient_id, doctor_id, scheduled_at, reason, created_by_user_id)
                VALUES
                (:patient_id, :doctor_id, :scheduled_at, :reason, :user_id)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            'patient_id'=>$data['patient_id'],
            'doctor_id'=>$data['doctor_id'],
            'scheduled_at'=>$data['scheduled_at'],
            'reason'=>$data['reason'],
            'user_id'=>$data['user_id']
        ]);
    }

    public function doctorBusy($doctor_id,$datetime){

        $sql="SELECT COUNT(*) 
              FROM citas
              WHERE doctor_id = :doctor_id
              AND scheduled_at = :datetime";

        $stmt=$this->conn->prepare($sql);
        $stmt->execute([
            'doctor_id'=>$doctor_id,
            'datetime'=>$datetime
        ]);

        return $stmt->fetchColumn();
    }

}