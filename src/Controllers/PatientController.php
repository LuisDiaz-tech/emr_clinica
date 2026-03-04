<?php

namespace Felipe\EmrClinica\Controllers;

use Felipe\EmrClinica\Models\Patient;
use Felipe\EmrClinica\Config\Database;

class PatientController{

private patient $patientModel;

    public function __construct(){
        $database = new Database();
        $pdo = $database->connect();
        $this->patientModel = new Patient($pdo);
    }

    public function index(): array{
        return $this->patientModel->getAll();
    }

    public function store(array $data): bool {
    return $this->patientModel->create($data);
    }

    public function search(string $term): array{
        return $this->patientModel->search($term);
    }

    public function destroy($id)
    {   
    $this->patientModel->delete($id);
    }

    public function edit($id){
        return $this->patientModel->getById($id);
    }

    public function update($id,$data){
        return $this->patientModel->update($id,$data);
    }
}