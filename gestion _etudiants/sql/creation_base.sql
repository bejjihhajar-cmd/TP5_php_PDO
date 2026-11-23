DROP DATABASE IF EXISTS gestion_etudiants;
CREATE DATABASE gestion_etudiants CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gestion_etudiants;

CREATE TABLE etudiants (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cne VARCHAR(20) NOT NULL UNIQUE,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    filiere VARCHAR(50) NOT NULL,
    date_naissance DATE NULL,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO etudiants (cne, nom, prenom, email, filiere, date_naissance) VALUES
('R130456789', 'Alaoui', 'Salma', 'salma.alaoui@etu.uca.ma', 'Informatique', '2004-03-15'),
('D140987654', 'Bennani', 'Youssef', 'youssef.bennani@etu.uca.ma', 'Informatique', '2003-11-02'),
('J120112233', 'El Idrissi', 'Hajar', 'hajar.elidrissi@etu.uca.ma', 'Mathématiques', '2004-07-21');
