-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 21-07-2015 a las 20:00:47
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sistemacanchas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canchas`
--

CREATE TABLE IF NOT EXISTS `canchas` (
  `id` int(100) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `latitud` varchar(50) NOT NULL,
  `longitud` varchar(50) NOT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `capacidad` int(2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `canchas`
--

INSERT INTO `canchas` (`id`, `nombre`, `latitud`, `longitud`, `direccion`, `capacidad`) VALUES
(2, 'Calva y Calva', '-4.024482', '-79.203387', 'Alexander Humboldt y Heroes del Cenepa', 12),
(3, 'Max futbol', '-3.9697618142526756', '-79.20818294874188', 'Av. 8 de Diciembre', 12),
(4, 'Recreo el Valle', '-3.979449 ', '-79.202022', 'El Valle', 12),
(5, 'Pió Jaramillo', '-4.008344 ', ' -79.205038', '\r\nAvenida Pio Jaramillo', 10),
(6, 'Ciudad Victoria', '-4.001434  ', '-79.233212', '\r\nCanchas deportivas Ciudad Victoria Ciudad Victor', 12),
(7, 'Parque Infantil', '-4.004727968342348', '-79.20057356357574', 'González Suárez y Olmedo ', 16),
(8, 'Colegio de Ingenieros', '-4.006301254815873', '-79.19658243656158', '\r\nGonzález Suárez', 12),
(9, 'Colegio de Arquitectos', '-3.97166684941937', '-79.20181810855865', '\r\nSalvador Bustamante Cel', 12),
(10, 'Sintética Belén', '-3.9793089194275777', '-79.2234044849014', 'Belén y vía a la costa', 12),
(11, 'Comil', '-3.9491727', '-79.21885629999997', 'Sendero Parque La Banda', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id_chat` int(10) NOT NULL,
  `id_grupo` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `mensaje` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`id_chat`, `id_grupo`, `id_usuario`, `mensaje`) VALUES
(1, 2, 2, 'hola'),
(2, 2, 1, 'que hubo'),
(3, 2, 1, 'bn'),
(4, 2, 1, 'bn'),
(5, 2, 1, 'asdas'),
(6, 2, 1, 'sdf'),
(7, 2, 1, 'sdfsdfds'),
(8, 2, 1, 'sdfsdfdssdfsd'),
(9, 2, 1, 'asdasd'),
(10, 2, 1, 'asdasdasd'),
(11, 2, 1, 'asdasdasd'),
(12, 2, 1, 'asdasdasd'),
(13, 2, 1, 'asdasdasd'),
(14, 2, 1, 'asdasdasd'),
(15, 2, 1, 'asdasdasd'),
(16, 2, 1, 'asdasdasd'),
(17, 2, 1, 'asdasdasd'),
(18, 2, 1, ''),
(19, 2, 1, ''),
(20, 2, 1, ''),
(21, 2, 1, ''),
(22, 2, 1, ''),
(23, 2, 1, ''),
(24, 2, 1, 'xssdf'),
(25, 2, 1, 'xssdf'),
(26, 2, 1, 'xssdf'),
(27, 2, 1, 'xssdf'),
(28, 2, 1, 'xssdf'),
(29, 2, 1, 'sdfsd'),
(30, 2, 1, 'sdfsdsdfs'),
(31, 2, 1, 'sdfsdsdfs'),
(32, 3, 1, 'xdfsdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int(10) NOT NULL,
  `idUsuario` int(10) NOT NULL,
  `idGrupo` int(10) NOT NULL,
  `encabezado` text NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `idUsuario`, `idGrupo`, `encabezado`, `imagen`, `fecha`) VALUES
(1, 1, 3, 'grupo 3', '', '2015-07-21'),
(2, 1, 3, 'grupo 3', '', '2015-07-21'),
(3, 1, 3, 'grupo 3', '', '2015-07-21'),
(4, 1, 2, 'grupo 2', '', '2015-07-21'),
(5, 1, 2, 'COn imagensisisichihf', '../imagenes/usuarios/starw.png', '2015-07-21'),
(6, 1, 2, 'Spider', '../imagenes/usuarios/spiderman.jpg', '2015-07-20'),
(7, 1, 2, 'Star wars', '../imagenes/usuarios/starw.png', '2015-07-21'),
(8, 1, 2, 'tu', '', '2015-07-21'),
(9, 1, 2, '', '', '2015-07-21'),
(10, 1, 2, '', '../imagenes/usuarios/starw.png', '2015-07-21'),
(11, 1, 2, '', '', '2015-07-21'),
(12, 1, 2, '', '../imagenes/usuarios/spiderman.jpg', '2015-07-21'),
(13, 1, 3, 'UTPL', '', '2015-07-21'),
(14, 1, 3, 'sdfs', '', '2015-07-21'),
(15, 1, 2, 'asd', '', '2015-07-21'),
(16, 1, 2, 'nlaskndasd', '', '2015-07-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `confirmaciones`
--

CREATE TABLE IF NOT EXISTS `confirmaciones` (
  `id` int(11) NOT NULL,
  `id_partido` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `estado` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `confirmaciones`
--

INSERT INTO `confirmaciones` (`id`, `id_partido`, `id_usuario`, `estado`) VALUES
(1, 1, 1, 'aceptado'),
(2, 1, 2, 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int(100) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `id_creador` int(100) DEFAULT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `nombre`, `id_creador`, `logo`) VALUES
(2, 'Panchitos', 1, '../imagenes/grupos/fondoGrupo.jpg'),
(3, 'Utpl', 1, '../imagenes/grupos/fondoGrupo.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitaciones`
--

CREATE TABLE IF NOT EXISTS `invitaciones` (
  `id_grupo` int(100) NOT NULL,
  `id_usuario` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `invitaciones`
--

INSERT INTO `invitaciones` (`id_grupo`, `id_usuario`) VALUES
(2, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos`
--

CREATE TABLE IF NOT EXISTS `partidos` (
  `id` int(255) NOT NULL,
  `id_grupo` int(100) DEFAULT NULL,
  `id_cancha` int(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time NOT NULL,
  `resultado` varchar(10) NOT NULL,
  `observacion` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `partidos`
--

INSERT INTO `partidos` (`id`, `id_grupo`, `id_cancha`, `fecha`, `hora`, `resultado`, `observacion`) VALUES
(1, 2, 2, '2015-07-17', '08:00:00', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(100) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `acerca` text NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `email`, `password`, `sexo`, `telefono`, `direccion`, `acerca`, `imagen`) VALUES
(1, 'Erik ', 'OrdÃ³Ã±ez', 'donatis@hotmail.es', 'erik', 'Hombre', '', '', '', '../imagenes/usuarios/dos.jpg'),
(2, 'Santiago', 'Robles', 'esordonez@utpl.edu.ec', 'erik2', 'Hombre', '', '', '', '../imagenes/usuarios/avatarHombre.png'),
(3, 'Perfil', 'Incompleto', '', '3sgjoj4q', '', '', '', '', '../imagenes/usuarios/avatarHombre.png'),
(4, 'Perfil', 'Incompleto', 'donatis91@gmail.com', 'hg7ozuly', '', '', '', '', '../imagenes/usuarios/avatarHombre.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_grupos`
--

CREATE TABLE IF NOT EXISTS `usuarios_grupos` (
  `id_usuario` int(100) DEFAULT NULL,
  `id_grupo` int(100) DEFAULT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios_grupos`
--

INSERT INTO `usuarios_grupos` (`id_usuario`, `id_grupo`, `fecha`) VALUES
(1, 2, '2015-07-21'),
(1, 3, '2015-07-21'),
(2, 2, '2015-07-21');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `canchas`
--
ALTER TABLE `canchas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `confirmaciones`
--
ALTER TABLE `confirmaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `canchas`
--
ALTER TABLE `canchas`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `confirmaciones`
--
ALTER TABLE `confirmaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `partidos`
--
ALTER TABLE `partidos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
