<?php

namespace Felipe\ErmClinica\Models;

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
        $stmt = $this->con->query("SELECT * FROM pacientes ORDER BY patient_id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}