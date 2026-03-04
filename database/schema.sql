CREATE DATABASE emr_clinica;

CREATE TABLE roles(
    role_id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(150)
);

CREATE TABLE usuarios(
    user_id SERIAL PRIMARY KEY,
    role_id INT NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash TEXT NOT NULL,
    status VARCHAR(20) DEFAULT 'activo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_usuario_role FOREIGN KEY (role_id) REFERENCES roles(role_id) ON DELETE RESTRICT
);

CREATE TABLE especialidades(
    speciality_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description VARCHAR(255)
);

CREATE TABLE medicos(
    doctor_id SERIAL PRIMARY KEY,
    user_id INT UNIQUE,
    speciality_id INT NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    license_number VARCHAR(50) NOT NULL UNIQUE,
    phone VARCHAR(50),
    email VARCHAR(150) UNIQUE,
    CONSTRAINT fk_medico_user FOREIGN KEY(user_id)
    REFERENCES usuarios(user_id) ON DELETE SET NULL,
    CONSTRAINT fk_medico_specialty
    FOREIGN KEY(speciality_id) 
    REFERENCES especialidades(speciality_id) ON DELETE RESTRICT
);


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
);

CREATE TABLE citas(
    appointment_id SERIAL PRIMARY KEY,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    scheduled_at TIMESTAMP NOT NULL,
    status VARCHAR(20) DEFAULT 'programada',
    reason VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by_user_id INT,
    updated_at TIMESTAMP,
    CONSTRAINT fk_cita_paciente
        FOREIGN KEY (patient_id)
        REFERENCES pacientes(patient_id)
        ON DELETE CASCADE,

    CONSTRAINT fk_cita_medico
        FOREIGN KEY (doctor_id)
        REFERENCES medicos(doctor_id)
        ON DELETE CASCADE,

    CONSTRAINT fk_cita_created_by
        FOREIGN KEY (created_by_user_id)
        REFERENCES usuarios(user_id)
        ON DELETE SET NULL
);

CREATE TABLE login (
    login_id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(50),
    user_agent VARCHAR(50),
    session_id VARCHAR(50),
    logout_time TIMESTAMP,
    status VARCHAR(20),
    CONSTRAINT fk_login_user
        FOREIGN KEY (user_id)
        REFERENCES usuarios(user_id)
        ON DELETE CASCADE

);

ALTER TABLE citas(
ADD CONSTRAINT unique_medico_fecha
UNIQUE (doctor_id,scheduled_at)
);

CREATE INDEX idx_citas_fecha ON citas(scheduled_at);
CREATE INDEX idx_citas_medico ON citas(doctor_id);
CREATE INDEX idx_citas_paciente ON citas(patient_id);
CREATE INDEX idx_paciente_documento ON pacientes(document_number);

ALTER TABLE citas
ADD CONSTRAINT unique_medico_fecha UNIQUE (doctor_id, scheduled_at);

