CREATE DATABASE emr_clinica;

CREATE TABLE roles(
    role_id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(150)
)

CREATE TABLE Usuarios(
    user_id SERIAL PRIMARY KEY,
    role_id INT NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash TEXT NOT NULL,
    status VARCHAR(20) DEFAULT 'activo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_usuario_role FOREIGN KEY (role_id) REFERENCES roles(role_id) ON DELETE RESTRICT
)
CREATE TABLE especialidades(
    speciality_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description VARCHAR(255)
)


CREATE TABLE pacientes(
    patient_id SERIAL PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    date_of_birth DATE,
    gender VARCHAR(20),
    phone VARCHAR(50),
    email VARCHAR(100),
    document_number VARCHAR(50) UNIQUE NOT NULL,
    adress VARCHAR(255),
    insurence_number VARCHAR(100)
)




