-- Eliminar la base de datos si existe y crearla con la configuración adecuada
DROP DATABASE IF EXISTS bdci4;
CREATE DATABASE IF NOT EXISTS bdci4 CHARACTER SET utf8 COLLATE utf8_general_ci;
USE bdci4;

-- Crear el usuario de la base de datos y asignar permisos
CREATE USER 'userci'@'localhost' IDENTIFIED BY 'passwordci4';
GRANT ALL PRIVILEGES ON bdci4.* TO 'userci'@'localhost';
FLUSH PRIVILEGES;

-- Creación de la tabla roles
CREATE TABLE roles (
    id_rol INT(3) PRIMARY KEY,
    nombre_rol VARCHAR(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Inserción de roles obligatorios
INSERT INTO roles (id_rol, nombre_rol) VALUES
(745, 'Administrador'),
(125, 'Operador');

-- Creación de la tabla usuarios
CREATE TABLE usuarios (
    id_usuario INT(3) AUTO_INCREMENT PRIMARY KEY,
    estatus_usuario TINYINT(1) NOT NULL DEFAULT 1,  -- -1: Deshabilitado, 1: Habilitado
    nombre_usuario VARCHAR(30) NOT NULL,
    ap_usuario VARCHAR(30) NOT NULL,
    am_usuario VARCHAR(30) NOT NULL,
    sexo_usuar io TINYINT(1) NOT NULL,  -- 0: Femenino, 1: Masculino
    email_usuario VARCHAR(50) NOT NULL UNIQUE,
    password_usuario VARCHAR(64) NOT NULL,  -- Se almacenará con SHA2('pass', 256)
    imagen_usuario VARCHAR(100) NULL DEFAULT NULL,  -- Inicialmente NULL
    id_rol INT(3) NOT NULL,
    FOREIGN KEY (id_rol) REFERENCES roles(id_rol) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Insertar un usuario Administrador
INSERT INTO usuarios (nombre_usuario, ap_usuario, am_usuario, sexo_usuario, email_usuario, password_usuario, imagen_usuario, id_rol)
VALUES ('Carlos', 'Gómez', 'Fernández', 1, 'carlos.admin@example.com', SHA2('AdminPass123', 256), NULL, 745);

-- Insertar un usuario Operador
INSERT INTO usuarios (nombre_usuario, ap_usuario, am_usuario, sexo_usuario, email_usuario, password_usuario, imagen_usuario, id_rol)
VALUES ('María', 'López', 'Rodríguez', 0, 'maria.operadora@example.com', SHA2('OperadorPass456', 256), NULL, 125);

-- Insertar un usuario Administrador
INSERT INTO usuarios (nombre_usuario, ap_usuario, am_usuario, sexo_usuario, email_usuario, password_usuario, imagen_usuario, id_rol)
VALUES ('Jose Miguel', 'Echavarria', 'Matamoros', 1, 'miguel@gmail.com', SHA2('123', 256), NULL, 745);
