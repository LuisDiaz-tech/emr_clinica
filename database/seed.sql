INSERT INTO roles (name, description) VALUES
('Administrador','Acceso total'),
('Recepcionista','Agenda y pacientes'),
('Medico','Solo sus citas');

INSERT INTO especialidades (name, description) VALUES
('Medicina General','Atención primaria'),
('Cardiologia','Especialista corazón'),
('Pediatria','Especialista niños');

INSERT INTO pacientes 
(first_name, last_name, date_of_birth, gender, phone, email, document_number, address, insurance_number)
VALUES
('Fernando', 'Gomez', '1995-05-10', 'Masculino', '3001111111', 'fernando01@mail.com', '1001', 'Calle 10 #20-30', 'SOS'),
('Maria', 'Jojoa', '2001-08-22', 'Femenino', '3002222222', 'maria@mail.com', '1002', 'Carrera 15 #40-50', 'EPS002');

INSERT INTO usuarios (role_id, username, email, password_hash, status, created_at) 
VALUES 
(1, 'admin', 'admin@clinica.com', '$2y$10$A2v/pXvT2KDie8cUtKKPEuDcrj4ZE3yY0E.B.16BUUF69U3mZimAW', 'activo', CURRENT_TIMESTAMP),
(2, 'recep1', 'recepcion@clinica.com', '$2y$10$A2v/pXvT2KDie8cUtKKPEuDcrj4ZE3yY0E.B.16BUUF69U3mZimAW', 'activo', CURRENT_TIMESTAMP),
(3, 'medico1', 'mgarcia@clinica.com', '$2y$10$A2v/pXvT2KDie8cUtKKPEuDcrj4ZE3yY0E.B.16BUUF69U3mZimAW', 'activo', CURRENT_TIMESTAMP);
/*pass 123456*/