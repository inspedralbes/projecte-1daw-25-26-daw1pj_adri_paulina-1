SET NAMES 'utf8mb4';
SET CHARACTER SET utf8mb4;
SET collation_connection = 'utf8mb4_unicode_ci';

CREATE TABLE DEPARTAMENT(
    idDepartament INT(11) AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(200)
);

CREATE TABLE TECNIC(
    idTecnic INT(11) AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(200)
);

CREATE TABLE INCIDENCIA(
    idIncidencia INT(11) AUTO_INCREMENT PRIMARY KEY,
    descripcio VARCHAR(2000),
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    departament INT(11),
    tecnic INT(11),
    dataFinalitzacio DATE,
    tipo ENUM('Software', 'Hardware', 'Internet', 'Corrent'),
    prioritat ENUM('Alta', 'Mitja', 'Baixa'),
    FOREIGN KEY (departament) REFERENCES DEPARTAMENT(idDepartament),
    FOREIGN KEY (tecnic) REFERENCES TECNIC(idTecnic)
);

CREATE TABLE ACTUACIO(
    idActuacio INT(11) AUTO_INCREMENT PRIMARY KEY,
    descripcio VARCHAR(2000),
    data TIMESTAMP,
    incidencia INT(11),
    visible INT(1),
    duracio INT(11),
    FOREIGN KEY (incidencia) REFERENCES INCIDENCIA(idIncidencia)
);
    -- INCIDENCIAS DE PRUEBA HECHAS POR IA PARA TESTEAR 
    -- 1. Insertar Departamentos
    INSERT INTO DEPARTAMENT (nom) VALUES 
    ('Informatica'), 
    ('Catala'), 
    ('Matematiques'), 
    ('Secretaria');

    -- 2. Insertar Técnicos
    INSERT INTO TECNIC (nom) VALUES 
    ('Ermengol Bota'), 
    ('Alvaro Perez'), 
    ('Gerard Torrents'),
    ('Rafa Cuestas');
-- Manually save current data by using DEFAULT CURRENT_TIMESTAMP --