-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2020 a las 00:44:20
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_cuestionario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cues_aspirantes`
--

CREATE TABLE `cues_aspirantes` (
  `asp_id` int(11) NOT NULL,
  `asp_folio` longtext DEFAULT NULL,
  `asp_password` longtext DEFAULT NULL,
  `asp_nombres` longtext DEFAULT NULL,
  `asp_apellido1` longtext DEFAULT NULL,
  `asp_apellido2` longtext DEFAULT NULL,
  `asp_clave_ceneval` varchar(45) DEFAULT NULL,
  `asp_fin_examen` varchar(45) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cues_aspirantes`
--

INSERT INTO `cues_aspirantes` (`asp_id`, `asp_folio`, `asp_password`, `asp_nombres`, `asp_apellido1`, `asp_apellido2`, `asp_clave_ceneval`, `asp_fin_examen`) VALUES
(1, 'LC2011111', 'asasas', 'aaa', 'aaa', 'aaa', 'aaa', 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cues_pregunta`
--

CREATE TABLE `cues_pregunta` (
  `preg_id` int(11) NOT NULL,
  `preg_pregunta` longtext DEFAULT NULL,
  `preg_numero` int(11) DEFAULT NULL,
  `preg_cuestionario` int(11) DEFAULT NULL,
  `preg_codigo` longtext DEFAULT NULL,
  `preg_video` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cues_pregunta`
--

INSERT INTO `cues_pregunta` (`preg_id`, `preg_pregunta`, `preg_numero`, `preg_cuestionario`, `preg_codigo`, `preg_video`) VALUES
(1, 'pregunta 1', 1, 1, '1', NULL),
(2, 'pregunta 2', 2, 1, '2', NULL),
(3, 'pregunta 3', 3, 1, '3', NULL),
(4, 'pregunta 4', 4, 1, '4', NULL),
(5, 'pregunta 5', 5, 1, '5', NULL),
(6, 'pregunta 6', 6, 1, '6', NULL),
(7, 'pregunta 7', 7, 1, '7', NULL),
(8, 'pregunta 8', 8, 1, '8', NULL),
(9, 'pregunta 9', 9, 1, '9', NULL),
(10, 'pregunta 10', 10, 1, '10', NULL),
(11, 'pregunta 11', 11, 1, '11', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cues_repuesta`
--

CREATE TABLE `cues_repuesta` (
  `resp_id` int(11) NOT NULL,
  `resp_texto` longtext DEFAULT NULL,
  `resp_opcion` varchar(45) DEFAULT NULL,
  `resp_idpregunta` int(11) DEFAULT NULL,
  `resp_valor` varchar(100) DEFAULT NULL,
  `resp_video` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cues_repuesta`
--

INSERT INTO `cues_repuesta` (`resp_id`, `resp_texto`, `resp_opcion`, `resp_idpregunta`, `resp_valor`, `resp_video`) VALUES
(1, 'a', 'a', 1, '1', NULL),
(2, 'b', 'b', 1, '2', NULL),
(3, 'c', 'c', 1, '3', NULL),
(4, 'd', 'd', 1, '4', NULL),
(5, 'a', 'a', 2, '1', NULL),
(6, 'b', 'b', 2, '2', NULL),
(7, 'c', 'c', 2, '3', NULL),
(8, 'd', 'd', 2, '4', NULL),
(9, 'a', 'a', 3, '1', NULL),
(10, 'b', 'b', 3, '2', NULL),
(11, 'c', 'c', 3, '3', NULL),
(12, 'd', 'd', 3, '4', NULL),
(13, 'a', 'a', 4, '1', NULL),
(14, 'b', 'b', 4, '2', NULL),
(15, 'c', 'c', 4, '3', NULL),
(16, 'd', 'd', 4, '4', NULL),
(17, 'a', 'a', 5, '1', NULL),
(18, 'b', 'b', 5, '2', NULL),
(19, 'c', 'c', 5, '3', NULL),
(20, 'd', 'd', 5, '4', NULL),
(21, 'a', 'a', 6, '1', NULL),
(22, 'b', 'b', 6, '2', NULL),
(23, 'c', 'c', 6, '3', NULL),
(24, 'd', 'd', 6, '4', NULL),
(25, 'a', 'a', 7, '1', NULL),
(26, 'b', 'b', 7, '2', NULL),
(27, 'c', 'c', 7, '3', NULL),
(28, 'd', 'd', 7, '4', NULL),
(29, 'a', 'a', 8, '1', NULL),
(30, 'b', 'b', 8, '2', NULL),
(31, 'c', 'c', 8, '3', NULL),
(32, 'd', 'd', 8, '4', NULL),
(33, 'a', 'a', 9, '1', NULL),
(34, 'b', 'b', 9, '2', NULL),
(35, 'c', 'c', 9, '3', NULL),
(36, 'd', 'd', 9, '4', NULL),
(37, 'a', 'a', 10, '1', NULL),
(38, 'b', 'b', 10, '2', NULL),
(39, 'c', 'c', 10, '3', NULL),
(40, 'd', 'd', 10, '4', NULL),
(41, 'a', 'a', 11, '1', NULL),
(42, 'b', 'b', 11, '2', NULL),
(43, 'c', 'c', 11, '3', NULL),
(44, 'd', 'd', 11, '4', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cues_respuesta_usuario`
--

CREATE TABLE `cues_respuesta_usuario` (
  `resp_usu_id` int(11) NOT NULL,
  `resp_usu_preg` int(11) DEFAULT NULL,
  `resp_usu_resp` int(11) DEFAULT NULL,
  `resp_usu_aspirante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cues_respuesta_usuario`
--

INSERT INTO `cues_respuesta_usuario` (`resp_usu_id`, `resp_usu_preg`, `resp_usu_resp`, `resp_usu_aspirante`) VALUES
(20, 9, 34, 1),
(21, 8, 30, 1),
(22, 10, 38, 1),
(23, 11, 44, 1),
(26, 2, 7, 1),
(27, 1, 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cues_aspirantes`
--
ALTER TABLE `cues_aspirantes`
  ADD PRIMARY KEY (`asp_id`);

--
-- Indices de la tabla `cues_pregunta`
--
ALTER TABLE `cues_pregunta`
  ADD PRIMARY KEY (`preg_id`);

--
-- Indices de la tabla `cues_repuesta`
--
ALTER TABLE `cues_repuesta`
  ADD PRIMARY KEY (`resp_id`);

--
-- Indices de la tabla `cues_respuesta_usuario`
--
ALTER TABLE `cues_respuesta_usuario`
  ADD PRIMARY KEY (`resp_usu_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cues_aspirantes`
--
ALTER TABLE `cues_aspirantes`
  MODIFY `asp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cues_pregunta`
--
ALTER TABLE `cues_pregunta`
  MODIFY `preg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cues_repuesta`
--
ALTER TABLE `cues_repuesta`
  MODIFY `resp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `cues_respuesta_usuario`
--
ALTER TABLE `cues_respuesta_usuario`
  MODIFY `resp_usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
