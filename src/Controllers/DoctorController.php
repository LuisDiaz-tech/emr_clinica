<?php

namespace Felipe\EmrClinica\Controllers;

use Felipe\EmrClinica\Config\Database;
use Felipe\EmrClinica\Models\Doctor;

class DoctorController{

    private doctor $doctorModel;

    public function __construct(){
        $database = new Database();
        $pdo = $database->connect();
        $this->doctorModel = new Doctor($pdo);
    }

     public function index(){

        if(isset($_GET['search'])){
            return $this->doctorModel->search($_GET['search']);
        }

        return $this->doctorModel->getAll();
    }

    public function store($data)  {
        return $this->doctorModel->create($data);
    }

    public function edit($id){
        return $this->doctorModel->getById($id);
    }

    public function update($id,$data){
        return $this->doctorModel->update($id,$data);
    }

    public function destroy($id){
       return  $this->doctorModel->delete($id);
    }


}