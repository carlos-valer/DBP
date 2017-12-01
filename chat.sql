CREATE DATABASE Chat_db;

CREATE TABLE Usuario(
	id int AUTO_INCREMENT,
	email varchar(50) not null,
	usuario varchar(20),
	clave varchar(12),
	conexion tinyint,
	sala int,
	PRIMARY KEY(id),
	FOREIGN KEY(sala) REFERENCES Grupo(id)
);

CREATE TABLE Grupo(
	id int AUTO_INCREMENT,
	nombre varchar(50),
	id_emisor int,
	mensaje text,
	fecha timestamp,
	PRIMARY KEY(id),
	FOREIGN KEY(id_emisor) REFERENCES Usuario(id)
);

CREATE TABLE Contacto(
	id_emisor int,
	id_receptor int,
	FOREIGN KEY(id_emisor) REFERENCES Usuario(id)
	FOREIGN KEY(id_receptor) REFERENCES Usuario(id)
);

CREATE TABLE Chat(
	id_emisor int,
	id_receptor int,
	mensaje text,
	fecha timestamp,
	FOREIGN KEY(id_emisor) REFERENCES Usuario(id)
	FOREIGN KEY(id_receptor) REFERENCES Usuario(id)
);

INSERT INTO Usuario(email, usuario, clave, conexion, sala) VALUES
('carlos@ucsp.edu.pe','carlos', '123', '1', NULL),
('luis@ucsp.edu.pe','luis', '123', '1', NULL),
('jose@ucsp.edu.pe','jose', '123', '1', NULL);
