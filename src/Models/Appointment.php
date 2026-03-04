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
    
    public function compliance($start,$end){

    $sql = "SELECT 
        m.first_name || ' ' || m.last_name AS doctor,

        COUNT(a.appointment_id) AS total_programadas,

        SUM(CASE 
            WHEN a.status='atendida' THEN 1 
            ELSE 0 
        END) AS total_atendidas,

        SUM(CASE 
            WHEN a.status='no_asiste' THEN 1 
            ELSE 0 
        END) AS total_no_asiste,

        ROUND(
            SUM(CASE WHEN a.status='atendida' THEN 1 ELSE 0 END)::decimal
            / NULLIF(COUNT(a.appointment_id),0) * 100
        ,2) AS cumplimiento

        FROM citas a
        JOIN medicos m ON a.doctor_id = m.doctor_id

        WHERE a.scheduled_at BETWEEN :start AND :end

        GROUP BY m.doctor_id";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute([
        'start'=>$start,
        'end'=>$end
    ]);

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

    public function myAppointments($doctor_id){

    $sql="SELECT
            a.appointment_id,
            p.first_name || ' ' || p.last_name AS patient,
            a.scheduled_at,
            a.reason,
            a.status
          FROM citas a
          JOIN pacientes p
          ON a.patient_id=p.patient_id
          JOIN medicos m
          ON a.doctor_id=m.doctor_id
          WHERE m.user_id=:doctor_id
          ORDER BY a.scheduled_at";

    $stmt=$this->conn->prepare($sql);

    $stmt->execute([
        'doctor_id'=>$doctor_id
    ]);

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
}