CREATE DATABASE IF NOT EXISTS mosushi;

USE mosushi;

CREATE TABLE IF NOT EXISTS usuario(
	id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    tlf VARCHAR(100) NOT NULL,
    direccion VARCHAR(200) NOT NULL
);

CREATE TABLE IF NOT EXISTS pedido(
	id INT PRIMARY KEY AUTO_INCREMENT,
    datafono BOOLEAN NOT NULL,
    cambio BOOLEAN NOT NULL,
    estado VARCHAR(100) NOT NULL,
    fechaYHora DATETIME NOT NULL,
    idU INT,
    FOREIGN KEY (idU) REFERENCES usuario(id) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS categoria(
	id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS producto(
    nombre VARCHAR(100) PRIMARY KEY,
    descr VARCHAR(200) NOT NULL,
    precio DECIMAL(5,2) NOT NULL,
    idCat INT,
    FOREIGN KEY (idCat) REFERENCES categoria(id) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS linea(
	orden INT NOT NULL,
    idPed INT NOT NULL,
    idProd VARCHAR(100),
    cant INT NOT NULL,
    precioT DECIMAL(5,2) NOT NULL,
    PRIMARY KEY (orden,idPed),
    FOREIGN KEY (idPed) REFERENCES pedido(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (idProd) REFERENCES producto(nombre) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS reserva(
	id INT PRIMARY KEY AUTO_INCREMENT,
    fechaYHora DATETIME NOT NULL,
    estado VARCHAR(100) NOT NULL,
    idU INT,
    FOREIGN KEY (idU) REFERENCES usuario(id) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE USER 'ahmed'@'localhost' IDENTIFIED BY '123456';
GRANT ALL ON *.* TO 'ahmed'@'localhost';