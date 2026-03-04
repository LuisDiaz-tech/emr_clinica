<?php

namespace Felipe\EmrClinica\Models;

class Doctor{
    private $conn;

    public function __construct(PDO $db){
        $this->conn = $db;
    } 

    public function getAll(){
        $sql = "SELECT m.doctor_id,
                       m.first_name,
                       m.last_name,
                       m.license_number,
                       m.phone,
                       m.email,
                       e.name as speciality
                       FROM medicos m
                       JOIN especialidades e ON m.speciality = e.speciality_id
                       ORDER BY m.doctor_id DESC";
        
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function search($search){
        $sql = "SELECT m.doctor_id,
                       m.first_name,
                       m.last_name,
                       m.license_number,
                       m.phone,
                       m.email,
                       e.name as speciality
                       FROM medicos m
                       JOIN especialidades e ON m.speciality = e.speciality_id
                       WHERE m.first_name ILIKE :search
                       OR m.last_name ILIKE :search";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['search'=>"%$search%"]);
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create($data){
        $sql = "INSERT INTO medicos
        (first_name,last_name,speciality_id,license_number,phone,email)
        VALUES
        (:first_name,:last_name,:speciality_id,:license_number,:phone,:email)";
        $stmt= $this->conn->prepare($sql);
         return $stmt->execute([
            'first_name'=>$data['first_name'],
            'last_name'=>$data['last_name'],
            'speciality_id'=>$data['speciality_id'],
            'license_number'=>$data['license_number'],
            'phone'=>$data['phone'],
            'email'=>$data['email']
        ]);
    }

     public function update($id,$data)
    {
        $sql = "UPDATE pacientes SET first_name = :first_name,
                                    last_name = :last_name,
                                    phone = :phone,
                                    email = :email
                                    WHERE patient_id = :id";

        $stmt = $this->conn->prepare($sql); 
        
        return $stmt->execute(
            [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'id' => $id
            ]
        );
    }

}