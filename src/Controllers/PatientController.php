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
}