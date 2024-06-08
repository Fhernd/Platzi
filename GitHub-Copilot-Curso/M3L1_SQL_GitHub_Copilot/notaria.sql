CREATE DATABASE Notaria;
USE Notaria;

CREATE TABLE TipoPersona (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(255) NOT NULL
);

CREATE TABLE Persona (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    tipo_persona_id INT,
    FOREIGN KEY (tipo_persona_id) REFERENCES TipoPersona(id)
);

CREATE TABLE TipoPropiedad (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(255) NOT NULL
);

CREATE TABLE Propiedad (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(255),
    tipo_propiedad_id INT,
    FOREIGN KEY (tipo_propiedad_id) REFERENCES TipoPropiedad(id)
);

CREATE TABLE Inmueble (
    id INT AUTO_INCREMENT PRIMARY KEY,
    direccion VARCHAR(255),
    propiedad_id INT,
    FOREIGN KEY (propiedad_id) REFERENCES Propiedad(id)
);

CREATE TABLE Vehiculo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(255),
    modelo VARCHAR(255),
    propiedad_id INT,
    FOREIGN KEY (propiedad_id) REFERENCES Propiedad(id)
);

CREATE TABLE Documento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE,
    persona_id INT,
    propiedad_id INT,
    FOREIGN KEY (persona_id) REFERENCES Persona(id),
    FOREIGN KEY (propiedad_id) REFERENCES Propiedad(id)
);