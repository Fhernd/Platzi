CREATE DATABASE Notaria;
USE Notaria;

-- Tabla para los tipos de persona
CREATE TABLE TipoPersona (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único para el tipo de persona
    descripcion VARCHAR(255) NOT NULL, -- Descripción del tipo de persona
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de última actualización
    UNIQUE KEY (descripcion) -- Índice único para la descripción
) COMMENT 'Tipos de personas';

-- Tabla para las personas
CREATE TABLE Persona (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único para la persona
    nombre VARCHAR(255) NOT NULL, -- Nombre de la persona
    tipo_persona_id INT, -- Tipo de persona (FK)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de última actualización
    FOREIGN KEY (tipo_persona_id) REFERENCES TipoPersona(id), -- Relación con TipoPersona
    INDEX (tipo_persona_id) -- Índice para la columna tipo_persona_id
) COMMENT 'Tabla de personas';

-- Tabla para los tipos de propiedad
CREATE TABLE TipoPropiedad (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único para el tipo de propiedad
    descripcion VARCHAR(255) NOT NULL, -- Descripción del tipo de propiedad
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de última actualización
    UNIQUE KEY (descripcion) -- Índice único para la descripción
) COMMENT 'Tipos de propiedades';

-- Tabla para las propiedades
CREATE TABLE Propiedad (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único para la propiedad
    descripcion VARCHAR(255), -- Descripción de la propiedad
    tipo_propiedad_id INT, -- Tipo de propiedad (FK)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de última actualización
    FOREIGN KEY (tipo_propiedad_id) REFERENCES TipoPropiedad(id), -- Relación con TipoPropiedad
    INDEX (tipo_propiedad_id) -- Índice para la columna tipo_propiedad_id
) COMMENT 'Tabla de propiedades';

-- Tabla para los inmuebles
CREATE TABLE Inmueble (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único para el inmueble
    direccion VARCHAR(255), -- Dirección del inmueble
    propiedad_id INT, -- Propiedad (FK)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de última actualización
    FOREIGN KEY (propiedad_id) REFERENCES Propiedad(id), -- Relación con Propiedad
    INDEX (propiedad_id) -- Índice para la columna propiedad_id
) COMMENT 'Tabla de inmuebles';

-- Tabla para los vehículos
CREATE TABLE Vehiculo (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único para el vehículo
    marca VARCHAR(255), -- Marca del vehículo
    modelo VARCHAR(255), -- Modelo del vehículo
    propiedad_id INT, -- Propiedad (FK)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de última actualización
    FOREIGN KEY (propiedad_id) REFERENCES Propiedad(id), -- Relación con Propiedad
    INDEX (propiedad_id) -- Índice para la columna propiedad_id
) COMMENT 'Tabla de vehículos';

-- Tabla para los documentos
CREATE TABLE Documento (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único para el documento
    fecha DATE, -- Fecha del documento
    persona_id INT, -- Persona (FK)
    propiedad_id INT, -- Propiedad (FK)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de última actualización
    FOREIGN KEY (persona_id) REFERENCES Persona(id), -- Relación con Persona
    FOREIGN KEY (propiedad_id) REFERENCES Propiedad(id), -- Relación con Propiedad
    INDEX (persona_id), -- Índice para la columna persona_id
    INDEX (propiedad_id) -- Índice para la columna propiedad_id
) COMMENT 'Tabla de documentos';
