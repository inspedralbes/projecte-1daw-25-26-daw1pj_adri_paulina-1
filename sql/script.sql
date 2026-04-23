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
