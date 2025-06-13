  /*CREATE DATABASE IF NOT EXISTS BDSanMar*/

DROP DATABASE IF EXISTS sistema_noticia;

CREATE DATABASE sistema_noticia;
USE sistema_noticia;

CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Usuario VARCHAR(100),    
    password varchar(255) NOT NULL,
    email varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO Usuarios (id, Usuario, password, email) 
VALUES (1, 'Webmaster', '$2y$10$Txcu4iqLJsZzn5iYK7CK2eIHnDui4Cel2M4CQhO5csah0wHwd69VG', 'jeanko@hotmail.com'),
	   (2, 'admin', '$2y$10$2H0Gbf35rT2yf.Gn/6.VrOjH0hVZI/kWNVmnxWNhnkMeem5qwOC/q', 'jeanko@hotmail.com');
	   


CREATE TABLE Privilegios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_privilegio VARCHAR(50) UNIQUE
);

INSERT INTO privilegios (id, nombre_privilegio) VALUES 
    ('1', 'Webmaster'), 
	('2', 'Admin'), 
   	('3', 'Usuario');

CREATE TABLE Usuario_Privilegios (
    usuario_id INT,
    privilegio_id INT,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id),
    FOREIGN KEY (privilegio_id) REFERENCES Privilegios(id),
    PRIMARY KEY (usuario_id, privilegio_id)
);

INSERT INTO Usuario_Privilegios (usuario_id, privilegio_id) VALUES (1,1), (2,2);
												


CREATE TABLE noticias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255),
    contenido TEXT,
    fecha DATE,
    imagen VARCHAR(255)
);


INSERT INTO `noticias` (`id`, `titulo`, `contenido`, `fecha`, `imagen`) VALUES
(1,'Gobierno anuncia medidas económicas  ', 'El gobierno ha anunciado una serie de medidas para estimular la economía. Se espera que estas medidas traigan beneficios a los ciudadanos.', '2024-12-08', 'imagenes/logo.jpeg'),
(2,'NASA descubre nuevo planeta habitable', 'Investigadores de la NASA han anunciado el descubrimiento de un nuevo planeta que podría ser habitable. La comunidad científica está     .', '2024-08-15', 'imagenes/logo.jpeg'),
(3,'Equipo local gana campeonato de fútbol', 'En un emocionante partido final, el equipo local logró ganar el campeonato de fútbol profesional. Los aficionados celebraron en las calles.', '2024-07-30', 'imagenes/logo.jpeg'),
(4,'Festival de música reúne a estrellas internacionales', 'El famoso festival de música ha comenzado. Este año se presentan artistas reconocidos de todo el mundo. El público disfruta con los conciertos.', '2024-06-25', 'imagenes/logo.jpeg');

CREATE TABLE `chatbot` (
    id INT AUTO_INCREMENT PRIMARY KEY,
  `queries` varchar(300) NOT NULL,
  `replies` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Volcado de datos para la tabla `chatbot`
--

INSERT INTO `chatbot` (`id`, `queries`, `replies`) VALUES
(1, 'Hola me podrías ayudar? Tengo una consulta', 'Claro estoy para servirte en lo que requieras'),
(2, 'No tengo acceso a Internet', 'Vale te pregunto, donde te encuentras ahora, ¿hay más dispositivos conectados a tu red local?'),
(3, 'Si claro tengo dos teléfonos, pero ninguno tiene acceso a Internet tampoco', 'Tienes algún ordenador conectado por cable'),
(4, 'Si, claro, requieres que lo encienda?', 'Si por favor y me confirmas si no tienes acceso a Internet, en tu ordenador cuando encienda'),
(5, 'Te confirmo que tampoco tiene Internet', 'Reinicia tu modem, espera 10 minutos y reintenta, me confirmas'),
(6, 'Ya me funciona el Internet, muchas gracias', 'Excelente me alegro mucho, gracias por comunicarte con Soporte Técnico ChatBot ConfiguroWeb');
