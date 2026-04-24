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
    data TIMESTAMP,
    departament INT(11),
    tecnic INT(11),
    dataFinalitzacio DATE,
    tipo ENUM('Software', 'Hardware', 'Internet', 'Corrent'),
    prioritat ENUM('Alta', 'Mitja', 'Baixa'),
    FOREIGN KEY (departament) REFERENCES DEPARTAMENT(idDepartament),
    FOREIGN KEY (tecnic) REFERENCES TECNIC(idTecnic)
);

CREATE TABLE ACTUACIO(
    idActiacio INT(11) AUTO_INCREMENT PRIMARY KEY,
    descripcio VARCHAR(2000),
    data TIMESTAMP,
    incidencia INT(11),
    visible INT(1),
    FOREIGN KEY (incidencia) REFERENCES INCIDENCIA(idIncidencia)
);
    -- INCIDENCIAS DE PRUEBA HECHAS POR IA PARA TESTEAR 
    -- 1. Insertar Departamentos
    INSERT INTO DEPARTAMENT (nom) VALUES 
    ('Recursos Humans'), 
    ('Contabilitat'), 
    ('Sistemes'), 
    ('Vendes');

    -- 2. Insertar Técnicos
    INSERT INTO TECNIC (nom) VALUES 
    ('Joan Garcia'), 
    ('Marta Puig'), 
    ('Albert Roca');

    -- 3. Insertar Incidencias
    -- Incidencia 1: Cerrada (con dataFinalitzacio)
    INSERT INTO INCIDENCIA (descripcio, data, departament, tecnic, dataFinalitzacio, tipo, prioritat) VALUES 
    ('L''ordinador no encén després de la tempesta', '2024-05-10 09:00:00', 2, 1, '2024-05-11', 'Hardware', 'Alta');

    -- Incidencia 2: Abierta (dataFinalitzacio es NULL)
    INSERT INTO INCIDENCIA (descripcio, data, departament, tecnic, dataFinalitzacio, tipo, prioritat) VALUES 
    ('No funciona el correu electrònic a l''Outlook', '2024-05-12 10:30:00', 1, 2, NULL, 'Software', 'Mitja');

    -- Incidencia 3: Problema de red
    INSERT INTO INCIDENCIA (descripcio, data, departament, tecnic, dataFinalitzacio, tipo, prioritat) VALUES 
    ('La connexió va molt lenta a la planta 3', '2024-05-12 11:15:00', 4, 3, NULL, 'Internet', 'Baixa');

    -- 4. Insertar Actuaciones (historial de qué se ha hecho)
    INSERT INTO ACTUACIO (descripcio, data, incidencia, visible) VALUES 
    ('He revisat la font d''alimentació i estava cremada. S''ha de canviar.', '2024-05-10 12:00:00', 1, 1),
    ('S''ha instal·lat la nova font i ja funciona correctament.', '2024-05-11 08:30:00', 1, 1),
    ('He intentat reconfigurar el perfil d''usuari però segueix donant error.', '2024-05-12 13:00:00', 2, 0);