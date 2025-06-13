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
(1, '¿Qué es el Servicio Comunitario?' , 'Es una actividad que deben desarrollar en las comunidades los estudiantes de educación superior que cursen estudios de formación profesional, aplicando los conocimientos científicos, técnicos, culturales, deportivos y humanísticos adquiridos durante su formación académica, en beneficio de la comunidad, para cooperar con su participación al cumplimiento de los fines del bienestar social, de acuerdo con lo establecido en la Constitución de la República Bolivariana de Venezuela y en esta Ley. El Servicio Comunitario es un requisito para la obtención del título de Educación superior.'),
(2, '¿Por qué debo hacer el Servicio Comunitario?' , 'Porque está establecido en diversos instrumentos legales como la Constitución de la República Bolivariana de Venezuela, la Ley de Universidades, la Ley de Servicio Comunitario del Estudiante de Educación Superior y el Reglamento de la Ley de Servicio Comunitario del estudiante de la Universidad de Carabobo, en los que se señala la participación e integración de los futuros profesionales en la transformación social del país. Esta Ley de Servicio Comunitario fue decretada según Gaceta Oficial N° 38.272 del 14-09-2005 y constituye un requisito obligatorio para poder obtener el título universitario. Casi todas las universidades del mundo tienen este mismo requisito (en la mayoría de los casos los estudiantes deben cumplir mayor cantidad de horas que en nuestro país).'),
(3, '¿Quiénes deben realizar el SC?' , 'En la Facultad de Educación, todos los estudiantes que hayan cursado los dos módulos (del 6to y 7mo semestre respectivamente), que tengan aprobado el 50% de la carga académica y que formalicen la inscripción en el Departamento que le corresponda según su Especialidad.'),
(4, '¿Cuándo puedo realizar mi SC?' , 'Una vez aprobado el 50 % de los créditos (carga académica) de la carrera y aprobados los Módulos preparatorios.'),
(5, '¿Cómo puedo realizar mi SC?' , 'El estudiante debe inscribirse en el Departamento (de su mención), especificando el nombre del Proyecto en el que se incorporará, posteriormente debe presentar una Propuesta de acción en forma individual o grupal (de acuerdo al Proyecto en el que se adscribe).'),
(6, '¿Cuáles son las asignaturas preparatorias?' , 'Los Módulos que administra el Departamento de Ciencias Sociales (Proyecto Comunitario), en el 6to y 7mo semestre de la Carrera.'),
(7, '¿Cuánto dura el Servicio Comunitario?' , 'El Servicio Comunitario tendrá una duración mínima de 120 horas que deben cumplirse en un lapso no menor de 3 meses. Es posible cumplir con la obligación del Servicio Comunitario con más de un Proyecto, siempre que la suma de las horas den como resultado, como mínimo, las 120 horas requeridas por la Ley. Todos los Proyectos deben ser aprobados por la Dirección de Extensión y Servicios a la Comunidad (D.E.S.C.O) de la Universidad de Carabobo.'),
(8, 'Además del 50% de la carga académica y de la asignatura preparatoria, ¿Hay algún otro requisito?' , 'Algunos Proyectos de Servicio Comunitario pueden requerir de entrenamiento especial (seminarios, cursos o talleres) para su planificación y ejecución. En ese caso, el tiempo invertido en el entrenamiento especial se puede contabilizar como parte del lapso total de duración del Servicio Comunitario, siempre y cuando esa acreditación no sea superior al veinte por ciento (20%) de la duración de cada proyecto.'),
(9, '¿Cuándo se inscribe el SC?' , 'Después de satisfechos los requisitos antes mencionados, el SC podrá inscribirse en el 8vo semestre de la carrera.'),
(10, '¿Puedo esperar culminar todas las asignaturas del pensum para inscribirme en el SC?' , 'El SC puede realizarse simultáneamente con el semestre regular o en periodos vacacionales, ya que no exige dedicación exclusiva y debe desarrollarse a lo largo de dos semestres como máximo (en un periodo no menor a tres meses ni mayor de un año). Al iniciar el SC en el 8vo semestre de la carrera, culminarás en el 9no; lo que te permitirá dedicar mayor cantidad de tiempo a las materias como Práctica Profesional y Trabajo de Grado, así no tendrás que cursar otros semestres exclusivamente con el Servicio Comunitario. Te recomendamos leer el árbol de prelaciones de la carrera.'),
(11, '¿Cómo sé qué Proyecto voy a realizar?' , 'La Universidad ofrecerá, a través de la Dirección de Extensión y Servicios a la Comunidad (D.E.S.C.O), del Departamento respectivo, proyectos de impacto social en los que los estudiantes puedan realizar su Servicio Comunitario. El Departamento de Arte ya ha iniciado contacto con una comunidad, lo que facilitará el ingreso del estudiante al Proyecto General y/o Proyectos Específicos que se vienen ejecutando. Esto no significa que los estudiantes por iniciativa propia o en conjunto con otros estudiantes, profesores-tutores, u organizaciones de trabajo social comunitario presenten sus propias propuestas de proyecto de servicio que sean de interés personal y colectivo. Todos los Proyectos de SC, sin embargo, deberán ser elaborados según el formato de la Universidad de Carabobo y consignados a la Coordinación del Departamento, quien a su vez lo presentará a la Dirección de Extensión de la Facultad y esta a su vez lo presentará ante la D.E.S.C.O para su aprobación.'),
(12, '¿Qué dedicación requiere el SC?' , 'El SC puede realizarse en modalidades a tiempo completo, propia de los períodos vacacionales, a medio tiempo, dedicación menor a medio tiempo o una combinación de todas ellas. Todo dependerá de la organización del equipo de prestadores. Mientras más tiempo continuo dedique podrá obtener mejores resultados y a su vez culminar el SC en menor lapso de tiempo. Para culminar en el tiempo indicado (durante dos semestres) deberías dedicar de CUATRO (04) A SEIS (06) horas semanales.'),
(13, '¿Cómo se evalúa el SC?' , 'Al final de cada mes el estudiante entregará a su tutor un REPORTE MENSUAL DE ACTIVIDADES y al término del SC el estudiante deberá entregar un INFORME FINAL en el cual se anexarán evidencias, registros, hojas de asistencia, entre otros; las pautas de presentación de este informe final serán detalladas por el profesor – tutor. En este sentido, la evaluación del SC se realizará en términos del proceso, del trabajo cumplido y del informe final. La evaluación es responsabilidad del tutor académico, quien podrá pedir opinión al representante de la comunidad. Este tutor académico (profesor adscrito al Departamento) emitirá informe y resultado de evaluaciones al Coordinador del Departamento, que es quien registrará evaluación definitiva. La calificación definitiva será “aprobó” o “no aprobó”. En el último caso, el estudiante deberá iniciar un nuevo Proyecto. Los Proyectos del SC no tienen unidades crédito.'),
(14, 'Las actividades voluntarias ¿pueden ser acreditadas como SC?' , 'No, a menos que respondan a los objetivos del PROYECTO GENERAL que desarrolla el Departamento o se circunscriba a la comunidad en la que el Departamento realiza para ese momento el SC. No se acreditarán actividades desarrolladas como preparador, beca de servicio o similares, ni actividades desempeñadas como representante estudiantil, centro de estudiantes o similar. El Servicio Comunitario no puede ser sustituido por las Pasantías Profesionales o por los Proyectos de Grado.'),
(15, '¿Cuales Proyectos no cumplen con las directrices y el espíritu de la Ley?' , 'No se aceptarán como propuestas válidas, proyectos que beneficien exclusivamente a comunidades de medios y altos recursos. Las propuestas deben especificar claramente la comunidad mas desproveída a beneficiar y definir como será la relación del estudiante con dicha comunidad. Deben existir actividades de reflexión, acción y retroalimentación del estudiante, e intercambio de saberes con la comunidad.'),
(16, '¿Que es la Comunidad?' , 'Es el conglomerado social de familias, ciudadanos y ciudadanas que habitan en un espacio geográfico donde además: Se conocen entre sí y pueden relacionarse fácilmente; usan los mismos servicios públicos; comparten una historia común; comparten necesidades y potencialidades similares, económicas, sociales, urbanísticas. (Art. 4, nral 1, LCC).'),
(17, '¿Cómo está organizada la comunidad?' , ' Hay comunidades con importantes tradiciones organizativas y de lucha, que cuentan con un sinnúmero de organizaciones. Hay otras que cuentan con una o dos organizaciones. Y otras que quizás no cuentan con ninguna. Cuando se va a realizar un trabajo en una comunidad hay que tener muy en cuenta sus características. En las comunidades donde existan organizaciones habrá que articularlas (…) donde no las haya, habrá que promover su surgimiento. (Art. 21 nral 2, LCC).'),
(18, '¿Qué es un DIAGNÓSTICO – PARTICIPATIVO?' , ' Es el estudio realizado por un colectivo, empleando formas, técnicas e instrumentos dirigidos al registro “en colectivo” de información sobre su realidad y el reconocimiento de los problemas que las afectan, los recursos con los que cuenta y las potencialidades propias de la localidad, que puedan ser aprovechadas en beneficio de todos. Permite identificar, ordenar y jerarquizar los problemas comunitarios y, por ello, la gente llega mejor preparada a la formulación del Proyecto.'),
(19, '¿Qué se entiende por Problemas Comunitarios?' , ' Problemas comunitarios son aquellos asuntos que afectan el normal y digno desenvolvimiento social de los habitantes residentes en una localidad determinada.'),
(20, '¿Qué es el PROYECTO SOCIAL?' , ' Es un plan de trabajo organizado en el que se consideran diversos elementos como los objetivos y recursos, dirigidos a alcanzar metas concretas en un tiempo determinado de acuerdo a problemas y necesidades detectadas; en este se describe la situación inicial, situación futura, y las acciones para lograr resultados satisfactorios en función del mejoramiento de la calidad de vida de los habitantes de una comunidad. No basta entonces que la comunidad realice múltiples actividades, de lo que se trata es de que éstas se ordenen para así cumplir el objetivo en forma más eficiente, en mucho menos tiempo y con mucho menos desgaste.'),
(21, '¿Cuales son las fases del Servicio Comunitario?' , 'Inducción, información, sensibilización, preparación.
Organización: Definición de roles. Observación. Diagnóstico. Registro de Información. Análisis de la situación inicial. Selección de la Situación o Problema a Intervenir.
Definición de la Participación. Planificación y elaboración de Propuesta de trabajo.
Ejecución del Proyecto, seguimiento, elaboración de informes parciales (reportes mensuales).Descripción de la experiencia, elaboración y presentación del Informe final.
'),
(22, 'En qué se fundamenta el MODELO «APRENDIZAJE-SERVICIO»?' , 'En las siguientes premisas:
a.- El estudiante debe asumir liderazgo para ser protagonista, activador, promotor de todas las actividades y de su propio aprendizaje. Para ello debe reconocer sus debilidades e identificar sus fortalezas, a los fines de desaprender, aprender, para redirigir acciones y tomar decisiones que favorezcan el desarrollo de experiencias de intercambio en el contexto sociocomunitario.
b.- Bajo esta concepción se atiende  de manera desinteresada, cooperativa y solidaria las necesidades y problemas reales de la comunidad (intencionalidad solidaria).
c.- Se requiere de una organización conjunta y planificación de acciones dirigidas a atender las necesidades de un colectivo, para contribuir con el mejoramiento de su calidad de vida y el mejoramiento de la calidad del aprendizaje obtenido (intencionalidad pedagógica).
');
