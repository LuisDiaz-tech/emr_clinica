<?php

namespace Felipe\EmrClinica\Models;

use PDO;

class Patient{
    private PDO $conn;

    public function __construct(PDO $db){
        $this->conn = $db;
    } 

    public function create(array $data): bool{
        $sql = "INSERT INTO pacientes
        (first_name, last_name, date_of_birth, gender, phone, email, document_number, address, insurance_number)
        VALUES
        (:first_name, :last_name, :date_of_birth, :gender, :phone, :email, :document_number, :address, :insurance_number)";

        $stmt= $this->conn->prepare($sql);
        return $stmt->execute($data);
    } 

    public function getAll(): array{
        $stmt = $this->conn->query("SELECT * FROM pacientes ORDER BY patient_id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search(string $term): array{
        $term = trim($term);
        $termLike = "%{$term}%";

       $sql = "SELECT * FROM pacientes
            WHERE first_name ILIKE :term
            OR last_name ILIKE :term
            OR document_number ILIKE :term
            ORDER BY patient_id DESC";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':term', $termLike, \PDO::PARAM_STR);
    $stmt->execute();
   
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
    $stmt = $this->conn->prepare("DELETE FROM pacientes WHERE patient_id = :id");
    return $stmt->execute(['id' => $id]);
    }
    
    public function getById($id)
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM pacientes WHERE patient_id = :id"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
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