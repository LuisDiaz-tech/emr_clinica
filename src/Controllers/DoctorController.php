<?php

namespace Felipe\EmrClinica\Controllers;

use Felipe\EmrClinica\Config\Database;
use Felipe\EmrClinica\Models\Doctor;

class DoctorController{

    private $doctor;

    public function __construct(){
        $database = new Database();
        $pdo = $database->connect();
        $this->doctor = new Doctor($pdo);
    }

     public function index(){

        if(isset($_GET['search'])){
            return $this->doctor->search($_GET['search']);
        }

        return $this->doctor->getAll();
    }

    public function store($data)  {
        return $this->doctor->create($data);
    }

    public function edit($edit){
        return $this->doctor->getById($id);
    }

    public function update($id,$data){
        return $this->doctor->update($id,$data);
    }

    public function destroy($id){
        return $this->doctor->delete($id);
    }


}