-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:8889
-- Tiempo de generación: 09-06-2016 a las 17:12:59
-- Versión del servidor: 5.5.42
-- Versión de PHP: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `carga`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE `acceso` (
  `id` int(11) NOT NULL,
  `tiempo` bigint(20) DEFAULT NULL,
  `usuario_docentes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `idasiganturas` int(11) NOT NULL COMMENT 'id auto incrementado de las asignaturas',
  `asignaturas` varchar(250) NOT NULL COMMENT 'asignaturas de las diferentes carreras',
  `anio` int(11) NOT NULL COMMENT 'año en que se oferta esa asignatura',
  `plan` int(11) DEFAULT NULL,
  `horas` int(11) NOT NULL COMMENT 'horas por semana que tiene cada asignatura.\nEjemplo\nUna asignatura puede tener 4 horas por semana',
  `thoras` int(11) NOT NULL COMMENT 'total de horas de cada asignatura\nejemplo\nuna asignatura puede tener 60 o bien 90 horas totales',
  `turno_idturno` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`idasiganturas`, `asignaturas`, `anio`, `plan`, `horas`, `thoras`, `turno_idturno`) VALUES
(1, 'Programación Visual I', 2, 13, 4, 60, 1),
(2, 'Programación Visual II', 2, 13, 4, 60, 1),
(3, 'Programación Visual III', 3, 13, 4, 60, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiario`
--

CREATE TABLE `beneficiario` (
  `id` int(11) NOT NULL,
  `cedula` varchar(16) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `docentes_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `beneficiario`
--

INSERT INTO `beneficiario` (`id`, `cedula`, `nombre`, `apellidos`, `direccion`, `docentes_id`) VALUES
(12, '0010511890052Y', 'Maria Ivette', 'Estrada Hernandez', 'NANA', 74),
(13, '1234', '2', '2', '2', 75),
(14, '1234', '2', '2', '2', 77);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carga`
--

CREATE TABLE `carga` (
  `docentes_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `permitir` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carga`
--

INSERT INTO `carga` (`docentes_id`, `periodo_id`, `permitir`) VALUES
(74, 14, 1),
(74, 20, 0),
(74, 21, 0),
(74, 22, 0),
(74, 23, 0),
(74, 24, 0),
(74, 25, 0),
(74, 26, 0),
(74, 27, 0),
(74, 28, 0),
(75, 14, 0),
(75, 20, 0),
(75, 21, 0),
(75, 23, 0),
(75, 25, 0),
(75, 28, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carga_asignatura`
--

CREATE TABLE `carga_asignatura` (
  `idcarga` int(11) NOT NULL COMMENT 'id auto incrementado de la carga de los docente',
  `thoras` int(11) NOT NULL,
  `hexcedentes` int(11) NOT NULL COMMENT 'Horas excedentes a la carga ordinaria.Todavia no comprendo muy bien a que se refiere y para que se ocupa este parametro',
  `hreducidas` int(11) NOT NULL COMMENT 'Horas reducidas a la carga ordinaria.Todavia no comprendo muy bien a que se refiere y para que se ocupa este parametro',
  `hadicionales` int(11) NOT NULL COMMENT 'Horas adicionales a pagarse en el semestre.',
  `_idasiganturas` int(11) NOT NULL COMMENT 'id asignatura a la que pertenece la carga',
  `carga_periodo_id` int(11) NOT NULL,
  `carga_docentes_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carga_asignatura`
--

INSERT INTO `carga_asignatura` (`idcarga`, `thoras`, `hexcedentes`, `hreducidas`, `hadicionales`, `_idasiganturas`, `carga_periodo_id`, `carga_docentes_id`) VALUES
(102, 60, 30, 30, 0, 1, 14, 74),
(103, 60, 0, 0, 0, 2, 14, 74),
(104, 60, 0, 0, 0, 1, 14, 75),
(105, 60, 0, 0, 0, 2, 14, 75),
(110, 60, 0, 0, 0, 3, 14, 74),
(118, 60, 30, 0, 0, 1, 22, 74),
(129, 60, 0, 0, 0, 1, 21, 74),
(130, 60, 0, 0, 0, 2, 21, 74),
(131, 60, 0, 0, 0, 1, 23, 74),
(132, 60, 0, 0, 0, 2, 23, 74),
(146, 60, 0, 0, 0, 1, 25, 74),
(147, 60, 0, 0, 0, 2, 25, 74),
(148, 60, 0, 0, 0, 3, 25, 74),
(149, 60, 0, 0, 0, 1, 24, 74),
(150, 60, 0, 0, 0, 2, 24, 74),
(151, 60, 0, 0, 0, 3, 24, 74),
(169, 60, 0, 0, 0, 1, 28, 74),
(170, 60, 0, 0, 0, 2, 28, 74),
(171, 60, 0, 0, 0, 1, 23, 75),
(172, 60, 0, 0, 0, 2, 23, 75);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` int(11) NOT NULL COMMENT 'id auto incrementado de las carreras de cada departamento',
  `carreras` varchar(250) NOT NULL COMMENT 'carreras de cada departamento',
  `_id` int(11) NOT NULL COMMENT 'id de los departamentos asociados a las carreras'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id`, `carreras`, `_id`) VALUES
(1, 'Informática Educativa', 2),
(2, 'DGM', 2),
(13, 'OTV', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_docente`
--

CREATE TABLE `categoria_docente` (
  `id` int(11) NOT NULL COMMENT 'id auto incrementado de la categoria',
  `categoria` varchar(20) NOT NULL COMMENT 'Titutular o asistente',
  `descripcion` varchar(45) DEFAULT NULL COMMENT 'una descripción de la simbologia\nejemplo\nTi = Titular\nAs = Asistente'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria_docente`
--

INSERT INTO `categoria_docente` (`id`, `categoria`, `descripcion`) VALUES
(1, 'Ninguno', NULL),
(2, 'TI', 'Titular'),
(3, 'AS', 'Asistente '),
(4, 'AU', 'Auxiliar'),
(5, 'AD', 'Adjunto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ccontrato`
--

CREATE TABLE `ccontrato` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL COMMENT 'Características del contrato: Permanente (P) o Temporal ( T ).             					\n'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ccontrato`
--

INSERT INTO `ccontrato` (`id`, `nombre`) VALUES
(1, 'Ninguno'),
(2, 'Permanente'),
(3, 'Temporal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id` int(11) NOT NULL COMMENT 'id de la tabla departamento',
  `departamento` varchar(45) NOT NULL COMMENT 'Departamentos o coordinaciones de las facultades',
  `_idfacultad` int(11) NOT NULL COMMENT 'id de la facultad'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id`, `departamento`, `_idfacultad`) VALUES
(1, 'Ninguno', 1),
(2, 'Tecnología Educativa', 2),
(13, 'Frances', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id` int(11) NOT NULL,
  `cedula` varchar(16) NOT NULL COMMENT 'la cedula de los docentes, la cedula debe de ser unica',
  `inss` int(11) DEFAULT NULL COMMENT 'inss de cada uno de los docentes, el inss debe de ser unico',
  `pnombre` varchar(45) NOT NULL COMMENT 'primer nombre',
  `snombre` varchar(45) DEFAULT NULL COMMENT 'segundo nombre',
  `papellido` varchar(45) NOT NULL COMMENT 'primer apellido',
  `sapellido` varchar(45) DEFAULT NULL COMMENT 'segundo apellido',
  `sexo` char(1) DEFAULT NULL COMMENT 'sexo de los docentes',
  `telefono` varchar(45) DEFAULT NULL COMMENT 'telefono del docente',
  `direccion` varchar(250) NOT NULL,
  `direccion2` text NOT NULL,
  `tipo_contratacion_id` int(11) DEFAULT NULL COMMENT 'tipo de contrato (Si tiene), este campo puede ser nulo ya que no todos los docentes no son planta o contratado por parte de la faculta de educación e idiomas',
  `categoria_docente_id` int(11) DEFAULT NULL COMMENT 'categoria (Si tiene), este campo puede ser nulo ya que no todos los docentes son titular o asistentes',
  `departamento_id` int(11) DEFAULT NULL,
  `ccontrato_id` int(11) DEFAULT NULL,
  `ecivil_id` int(11) DEFAULT NULL,
  `oficio_id` int(11) NOT NULL,
  `nacionalidad_id` int(11) NOT NULL,
  `nivel_academico_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id`, `cedula`, `inss`, `pnombre`, `snombre`, `papellido`, `sapellido`, `sexo`, `telefono`, `direccion`, `direccion2`, `tipo_contratacion_id`, `categoria_docente_id`, `departamento_id`, `ccontrato_id`, `ecivil_id`, `oficio_id`, `nacionalidad_id`, `nivel_academico_id`) VALUES
(74, '1', 0, 'Docente', '', 'Docente', '', 'M', '0', 'lespinozae@unan.edu.ni', 'NINGUNA', 6, 3, 2, 1, 1, 1, 1, 1),
(75, '2', 0, 'Decano', '', 'Decano', '', 'M', '0', 'decano@unan.edu.ni', '', 6, 2, 2, 2, 3, 1, 1, 4),
(77, '3', 3, 'Docente', '', 'Docente', 'Docente', 'M', '2', 'lmanuel2007@yahoo.es', 'NINGUNA', 1, 1, 2, 1, 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ecivil`
--

CREATE TABLE `ecivil` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ecivil`
--

INSERT INTO `ecivil` (`id`, `nombre`) VALUES
(1, 'Ninguno'),
(2, 'Soltero'),
(3, 'Casado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

CREATE TABLE `facultad` (
  `idfacultad` int(11) NOT NULL COMMENT 'id de la facultad',
  `facultad` varchar(250) NOT NULL COMMENT 'facultades pertenecientes a la UNAN-Managua'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`idfacultad`, `facultad`) VALUES
(1, 'Ninguno'),
(2, 'Educación e Idiomas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `idhorario` int(11) NOT NULL,
  `dia` varchar(45) DEFAULT NULL COMMENT 'Dia de la asignatura',
  `inicio` varchar(250) DEFAULT NULL COMMENT 'Hora de inicio',
  `fin` varchar(250) DEFAULT NULL COMMENT 'Hora de fin',
  `carga_asignatura_idcarga` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`idhorario`, `dia`, `inicio`, `fin`, `carga_asignatura_idcarga`) VALUES
(1, 'Luis', '2', '2', 102),
(2, 'Martes', '09:40', '11:10', 149),
(3, 'Jueves', '08:00', '09:40', 149),
(4, 'Lunes', '08:00', '09:40', 171),
(5, 'Viernes', '08:00', '09:00', 171);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `evento` varchar(250) NOT NULL,
  `usuario_docentes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `archivo` varchar(100) NOT NULL,
  `id_padre` int(11) NOT NULL,
  `m` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `menu`, `archivo`, `id_padre`, `m`) VALUES
(1, 'Inicio', 'home.php', 0, 0),
(2, 'Periodo', 'p.php', 10, 1),
(10, 'Administraci&oacute;n', '', 0, 1),
(11, 'Docentes', 'user.php', 10, 1),
(12, 'Limite de horas', 'h.php', 10, 1),
(13, 'Carga', 'c.php', 10, 0),
(14, 'Horario', 'horas.php', 10, 0),
(15, 'Carga - Docente', 'cc.php', 10, 0),
(16, 'Docentes', 'userc.php', 10, 1),
(17, 'Docentes', 'users.php', 10, 1),
(18, 'cpass', 'cpass.php', 0, 0),
(19, 'beneficiario', 'b.php', 0, 0),
(20, 'dg', 'dg.php', 0, 0),
(21, 'Carga - Decano', 'd.php', 10, 0),
(22, 'Departamento', 'dc.php', 10, 1),
(23, 'Carreras', 'car.php', 10, 1),
(24, 'Asignaturas', 'asig.php', 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacionalidad`
--

CREATE TABLE `nacionalidad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nacionalidad`
--

INSERT INTO `nacionalidad` (`id`, `nombre`) VALUES
(1, 'Nicaraguense');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_academico`
--

CREATE TABLE `nivel_academico` (
  `id` int(11) NOT NULL COMMENT 'id auto incrementado de los niveles academicos de los docentes\nejemplo:\nLIC.\nMsc.\nDoc.',
  `nivel` varchar(100) NOT NULL,
  `pagoxhora` varchar(45) DEFAULT NULL COMMENT 'Pago por hora para cada profesor... \nOsea: \nLos licenciados ganan 144\nLos maestros ganan 160\nLos doctores ganan 200\npor ejemplo\n'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nivel_academico`
--

INSERT INTO `nivel_academico` (`id`, `nivel`, `pagoxhora`) VALUES
(1, 'Doctor', '200'),
(2, 'Máster', '195.44'),
(3, 'Especialista', '178.45'),
(4, 'Licenciado', '159.3'),
(5, 'TEC/SUP', '112.55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficio`
--

CREATE TABLE `oficio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `oficio`
--

INSERT INTO `oficio` (`id`, `nombre`) VALUES
(1, 'Docente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE `periodo` (
  `id` int(11) NOT NULL,
  `finicio` bigint(20) NOT NULL COMMENT 'Inicio del periodo',
  `ffin` bigint(20) NOT NULL COMMENT 'Fin del periodo',
  `semestre_id` int(11) NOT NULL COMMENT 'id del semestre a que corresponde el perido',
  `estado` tinyint(1) NOT NULL COMMENT 'Estado en que se encuentra el periodo. Abierto = 1, Cerrado = 0',
  `descripcion` text COMMENT 'Breve descripción del periodo',
  `anio_lectivo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`id`, `finicio`, `ffin`, `semestre_id`, `estado`, `descripcion`, `anio_lectivo`) VALUES
(14, 1970, 1970, 1, 0, '', 2016),
(20, 1451602800, 1483138800, 2, 0, '', 2011),
(21, -3600, -3600, 1, 0, '', 2012),
(22, -3600, -3600, 1, 0, '', 2018),
(23, 1459461600, 1482447600, 1, 1, '', 2013),
(24, 1451602800, 1483138800, 2, 0, '', 2013),
(25, 1451602800, 1483138800, 1, 0, '', 2014),
(26, 1459461600, 1483138800, 1, 0, '', 2015),
(27, 1459461600, 1483138800, 1, 0, '', 2011),
(28, 1467064800, 1482879600, 2, 0, '', 2016);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestre`
--

CREATE TABLE `semestre` (
  `id` int(11) NOT NULL,
  `nombre` varchar(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `semestre`
--

INSERT INTO `semestre` (`id`, `nombre`) VALUES
(1, 'I'),
(2, 'II');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblreseteopass`
--

CREATE TABLE `tblreseteopass` (
  `id` int(10) unsigned NOT NULL,
  `idusuario` int(10) unsigned NOT NULL,
  `username` varchar(15) NOT NULL,
  `token` varchar(64) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_contratacion`
--

CREATE TABLE `tipo_contratacion` (
  `id` int(11) NOT NULL COMMENT 'id auto incrementado del tipo de contrato',
  `contratacion` varchar(45) NOT NULL COMMENT 'por ejemplo 1/4 de tiempo, 1/3 de tiempo, 1/2 tiempo, TC',
  `descripcion` varchar(250) DEFAULT NULL COMMENT 'Una descripción de cada uno de la simbologia del tiempo\npor ejemplo\nTC = Tiempo completo\nEste campo no es obligatorio',
  `limiteshoras` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_contratacion`
--

INSERT INTO `tipo_contratacion` (`id`, `contratacion`, `descripcion`, `limiteshoras`) VALUES
(1, 'Docente - TC', NULL, 245),
(2, 'Docente - 3/4', NULL, 180),
(3, 'Docente - 1/2', NULL, 120),
(4, 'Docente - 1/4', NULL, 60),
(5, 'Horario', NULL, 240),
(6, 'Administrativo', NULL, 120);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `idturno` int(11) NOT NULL COMMENT 'id auto incrementado del turno',
  `turno` varchar(45) NOT NULL COMMENT 'turnos existente en la UNAN - Managua\nejemplo\nsabatino\nvespertino\nnocturno\nmatutino',
  `carreras_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`idturno`, `turno`, `carreras_id`) VALUES
(1, 'Presencial', 1),
(36, 'Profesionalización', 2),
(37, 'Por Encuentro', 2),
(38, 'Mixta', 2),
(39, 'Profesionalización', 1),
(41, 'Mixta', 1),
(42, 'Presencial', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusuario`
--

CREATE TABLE `tusuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tusuario`
--

INSERT INTO `tusuario` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Decanato'),
(3, 'Director o Coordinador'),
(4, 'Docente'),
(5, 'Secretaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusuario_has_menu`
--

CREATE TABLE `tusuario_has_menu` (
  `tusuario_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tusuario_has_menu`
--

INSERT INTO `tusuario_has_menu` (`tusuario_id`, `menu_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(1, 2),
(2, 2),
(1, 10),
(2, 10),
(3, 10),
(5, 10),
(1, 11),
(2, 11),
(1, 12),
(2, 12),
(1, 14),
(2, 14),
(3, 15),
(5, 15),
(3, 16),
(5, 17),
(1, 18),
(2, 18),
(3, 18),
(4, 18),
(5, 18),
(1, 19),
(2, 19),
(3, 19),
(4, 19),
(5, 19),
(1, 20),
(2, 20),
(3, 20),
(4, 20),
(5, 20),
(1, 21),
(2, 21),
(1, 22),
(2, 22),
(1, 23),
(2, 23),
(1, 24),
(2, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `pass` varchar(250) NOT NULL,
  `docentes_id` int(11) NOT NULL,
  `tusuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`pass`, `docentes_id`, `tusuario_id`) VALUES
('c4ca4238a0b923820dcc509a6f75849b', 74, 3),
('c4ca4238a0b923820dcc509a6f75849b', 75, 2),
('502ff82f7f1f8218dd41201fe4353687', 77, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_acceso_usuario1_idx` (`usuario_docentes_id`);

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`idasiganturas`),
  ADD KEY `fk_asiganturas_turno1_idx` (`turno_idturno`);

--
-- Indices de la tabla `beneficiario`
--
ALTER TABLE `beneficiario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_beneficiario_docentes1_idx` (`docentes_id`);

--
-- Indices de la tabla `carga`
--
ALTER TABLE `carga`
  ADD PRIMARY KEY (`docentes_id`,`periodo_id`),
  ADD KEY `fk_carga_periodo1_idx` (`periodo_id`);

--
-- Indices de la tabla `carga_asignatura`
--
ALTER TABLE `carga_asignatura`
  ADD PRIMARY KEY (`idcarga`),
  ADD KEY `fk_carga_asiganturas1_idx` (`_idasiganturas`),
  ADD KEY `fk_carga_asignatura_carga1_idx` (`carga_periodo_id`),
  ADD KEY `fk_carga_carga1` (`carga_periodo_id`,`carga_docentes_id`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carreras_departamento1_idx` (`_id`);

--
-- Indices de la tabla `categoria_docente`
--
ALTER TABLE `categoria_docente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ccontrato`
--
ALTER TABLE `ccontrato`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_departamento_facultad_idx` (`_idfacultad`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula_UNIQUE` (`cedula`),
  ADD KEY `fk_docentes_tipo_contratacion1_idx` (`tipo_contratacion_id`),
  ADD KEY `fk_docentes_categoria_docente1_idx` (`categoria_docente_id`),
  ADD KEY `fk_docentes_departamento1_idx` (`departamento_id`),
  ADD KEY `fk_docentes_ccontrato1_idx` (`ccontrato_id`),
  ADD KEY `fk_docentes_ecivil1_idx` (`ecivil_id`),
  ADD KEY `fk_docentes_oficio1_idx` (`oficio_id`),
  ADD KEY `fk_docentes_nacionalidad1_idx` (`nacionalidad_id`),
  ADD KEY `fk_docentes_nivel_academico1_idx` (`nivel_academico_id`);

--
-- Indices de la tabla `ecivil`
--
ALTER TABLE `ecivil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD PRIMARY KEY (`idfacultad`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`idhorario`),
  ADD KEY `fk_horario_carga_asignatura1_idx` (`carga_asignatura_idcarga`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_log_usuario1_idx` (`usuario_docentes_id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nacionalidad`
--
ALTER TABLE `nacionalidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nivel_academico`
--
ALTER TABLE `nivel_academico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oficio`
--
ALTER TABLE `oficio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_periodo_semestre1_idx` (`semestre_id`);

--
-- Indices de la tabla `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tblreseteopass`
--
ALTER TABLE `tblreseteopass`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `tipo_contratacion`
--
ALTER TABLE `tipo_contratacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`idturno`),
  ADD KEY `fk_turno_carreras1_idx` (`carreras_id`);

--
-- Indices de la tabla `tusuario`
--
ALTER TABLE `tusuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tusuario_has_menu`
--
ALTER TABLE `tusuario_has_menu`
  ADD PRIMARY KEY (`tusuario_id`,`menu_id`),
  ADD KEY `fk_tusuario_has_menu_menu1_idx` (`menu_id`),
  ADD KEY `fk_tusuario_has_menu_tusuario1_idx` (`tusuario_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`docentes_id`),
  ADD KEY `fk_usuario_docentes1_idx` (`docentes_id`),
  ADD KEY `fk_usuario_tusuario1_idx` (`tusuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acceso`
--
ALTER TABLE `acceso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  MODIFY `idasiganturas` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id auto incrementado de las asignaturas',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `beneficiario`
--
ALTER TABLE `beneficiario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `carga_asignatura`
--
ALTER TABLE `carga_asignatura`
  MODIFY `idcarga` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id auto incrementado de la carga de los docente',AUTO_INCREMENT=173;
--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id auto incrementado de las carreras de cada departamento',AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `categoria_docente`
--
ALTER TABLE `categoria_docente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id auto incrementado de la categoria',AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `ccontrato`
--
ALTER TABLE `ccontrato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id de la tabla departamento',AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT de la tabla `ecivil`
--
ALTER TABLE `ecivil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `facultad`
--
ALTER TABLE `facultad`
  MODIFY `idfacultad` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id de la facultad',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `idhorario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `nacionalidad`
--
ALTER TABLE `nacionalidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `nivel_academico`
--
ALTER TABLE `nivel_academico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id auto incrementado de los niveles academicos de los docentes\nejemplo:\nLIC.\nMsc.\nDoc.',AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `oficio`
--
ALTER TABLE `oficio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `semestre`
--
ALTER TABLE `semestre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tblreseteopass`
--
ALTER TABLE `tblreseteopass`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_contratacion`
--
ALTER TABLE `tipo_contratacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id auto incrementado del tipo de contrato',AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `idturno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id auto incrementado del turno',AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT de la tabla `tusuario`
--
ALTER TABLE `tusuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD CONSTRAINT `fk_acceso_usuario1` FOREIGN KEY (`usuario_docentes_id`) REFERENCES `docentes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD CONSTRAINT `fk_asiganturas_turno1` FOREIGN KEY (`turno_idturno`) REFERENCES `turno` (`idturno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `beneficiario`
--
ALTER TABLE `beneficiario`
  ADD CONSTRAINT `fk_beneficiario_docentes` FOREIGN KEY (`docentes_id`) REFERENCES `docentes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `carga`
--
ALTER TABLE `carga`
  ADD CONSTRAINT `fk_carga_docentes1` FOREIGN KEY (`docentes_id`) REFERENCES `docentes` (`id`),
  ADD CONSTRAINT `fk_carga_periodo1` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `carga_asignatura`
--
ALTER TABLE `carga_asignatura`
  ADD CONSTRAINT `fk_carga_asiganturas1` FOREIGN KEY (`_idasiganturas`) REFERENCES `asignaturas` (`idasiganturas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_carga_carga1` FOREIGN KEY (`carga_periodo_id`, `carga_docentes_id`) REFERENCES `carga` (`periodo_id`, `docentes_id`);

--
-- Filtros para la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD CONSTRAINT `fk_carreras_departamento1` FOREIGN KEY (`_id`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `fk_departamento_facultad` FOREIGN KEY (`_idfacultad`) REFERENCES `facultad` (`idfacultad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD CONSTRAINT `fk_docentes_categoria_docente1` FOREIGN KEY (`categoria_docente_id`) REFERENCES `categoria_docente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docentes_ccontrato1` FOREIGN KEY (`ccontrato_id`) REFERENCES `ccontrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docentes_departamento1` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docentes_ecivil1` FOREIGN KEY (`ecivil_id`) REFERENCES `ecivil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docentes_nacionalidad1` FOREIGN KEY (`nacionalidad_id`) REFERENCES `nacionalidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docentes_nivel_academico1` FOREIGN KEY (`nivel_academico_id`) REFERENCES `nivel_academico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docentes_oficio1` FOREIGN KEY (`oficio_id`) REFERENCES `oficio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docentes_tipo_contratacion1` FOREIGN KEY (`tipo_contratacion_id`) REFERENCES `tipo_contratacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `fk_horario_carga_asignatura1` FOREIGN KEY (`carga_asignatura_idcarga`) REFERENCES `carga_asignatura` (`idcarga`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `fk_log_usuario1` FOREIGN KEY (`usuario_docentes_id`) REFERENCES `docentes` (`id`);

--
-- Filtros para la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD CONSTRAINT `fk_periodo_semestre1` FOREIGN KEY (`semestre_id`) REFERENCES `semestre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `turno`
--
ALTER TABLE `turno`
  ADD CONSTRAINT `fk_turno_carreras1` FOREIGN KEY (`carreras_id`) REFERENCES `carreras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tusuario_has_menu`
--
ALTER TABLE `tusuario_has_menu`
  ADD CONSTRAINT `fk_tusuario_has_menu_menu1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tusuario_has_menu_tusuario1` FOREIGN KEY (`tusuario_id`) REFERENCES `tusuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_docente_usuario` FOREIGN KEY (`docentes_id`) REFERENCES `docentes` (`id`),
  ADD CONSTRAINT `fk_usuario_tusuario1` FOREIGN KEY (`tusuario_id`) REFERENCES `tusuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

