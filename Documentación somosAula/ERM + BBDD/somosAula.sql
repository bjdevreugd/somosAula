-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2016 a las 16:32:10
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `proyectofinal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alum_asig_curs_grad`
--

CREATE TABLE IF NOT EXISTS `alum_asig_curs_grad` (
`id` int(10) unsigned NOT NULL,
  `user_rol_id` int(10) unsigned NOT NULL,
  `asig_curs_grad_id` int(10) unsigned NOT NULL,
  `nota` decimal(8,2) NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `alum_asig_curs_grad`
--

INSERT INTO `alum_asig_curs_grad` (`id`, `user_rol_id`, `asig_curs_grad_id`, `nota`, `descripcion`, `created_at`, `updated_at`) VALUES
(2, 16, 79, '3.00', 'Ha de mejorar su ortografía y su expresión oral', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 16, 74, '7.00', 'será cierto', '0000-00-00 00:00:00', '2016-06-04 13:14:04'),
(5, 16, 96, '10.00', 'gkjfhgfvxbcnvmmghj', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 16, 30, '5.50', 'dfghjmfdfghfh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 16, 98, '7.00', 'qwerdfghdt', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 16, 42, '6.00', 'dshfgjdgdfg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 16, 100, '5.00', 'jhkgfcxdsdsfghdsaf', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 16, 33, '4.00', 'qertytrewq', '2016-06-02 15:34:18', '2016-06-02 15:34:18'),
(32, 18, 13, '5.00', 'mala suerte', '2016-06-02 20:26:46', '2016-06-02 20:26:46'),
(33, 18, 7, '8.00', 'enhorabuena', '2016-06-02 20:34:07', '2016-06-02 20:34:07'),
(34, 16, 7, '4.00', 'Sorry', '2016-06-02 20:34:51', '2016-06-02 20:34:51'),
(36, 26, 7, '5.00', 'evoluciona favorablemente', '2016-06-05 10:11:46', '2016-06-05 10:11:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE IF NOT EXISTS `asignaturas` (
`id` int(10) unsigned NOT NULL,
  `nombre_asignatura` enum('Ciencias naturales','Ciencias sociales','Castellano','Primera lengua extranjera','Matemáticas','Educación física','Religión','Valores sociales y civicas','educación artistica','Segunda lengua extranjera','Refuerzo','Lengua cooficial','Geografía e historia','Biología y geología','Física y química','Especficia 1','Especifica 2','Tutoría','Opcional 1','Opcional 2') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`id`, `nombre_asignatura`, `created_at`, `updated_at`) VALUES
(1, 'Ciencias naturales', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(2, 'Ciencias sociales', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(3, 'Castellano', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(4, 'Primera lengua extranjera', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(5, 'Matemáticas', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(6, 'Educación física', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(7, 'Religión', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(8, 'Valores sociales y civicas', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(9, 'educación artistica', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(10, 'Segunda lengua extranjera', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(11, 'Refuerzo', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(12, 'Lengua cooficial', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(13, 'Geografía e historia', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(14, 'Biología y geología', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(15, 'Física y química', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(16, 'Especficia 1', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(17, 'Especifica 2', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(18, 'Tutoría', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(19, 'Opcional 1', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(20, 'Opcional 2', '2016-05-28 22:00:00', '2016-05-28 22:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asig_curs_grad`
--

CREATE TABLE IF NOT EXISTS `asig_curs_grad` (
`id` int(10) unsigned NOT NULL,
  `asignatura_id` int(10) unsigned NOT NULL,
  `curso_grado_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `asig_curs_grad`
--

INSERT INTO `asig_curs_grad` (`id`, `asignatura_id`, `curso_grado_id`, `created_at`, `updated_at`) VALUES
(2, 1, 2, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(3, 1, 3, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(4, 1, 4, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(5, 1, 5, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(6, 1, 6, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(7, 2, 1, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(8, 2, 2, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(9, 2, 3, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(10, 2, 4, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(11, 2, 5, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(12, 2, 6, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(13, 3, 1, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(14, 3, 2, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(16, 3, 4, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(17, 3, 5, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(18, 3, 6, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(19, 3, 7, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(20, 3, 8, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(21, 3, 9, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(22, 3, 10, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(23, 4, 1, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(24, 4, 2, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(25, 4, 3, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(26, 4, 4, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(27, 4, 5, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(28, 4, 6, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(29, 4, 7, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(30, 4, 8, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(31, 4, 9, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(32, 4, 10, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(33, 5, 1, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(34, 5, 2, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(35, 5, 3, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(37, 5, 5, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(38, 5, 6, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(39, 5, 7, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(40, 5, 8, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(42, 5, 10, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(44, 6, 2, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(46, 6, 4, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(47, 6, 5, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(48, 6, 6, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(49, 6, 7, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(50, 6, 8, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(52, 6, 10, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(54, 7, 2, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(55, 7, 3, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(56, 7, 4, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(57, 7, 5, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(58, 7, 6, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(59, 7, 7, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(60, 7, 8, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(61, 7, 9, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(62, 7, 10, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(64, 8, 2, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(65, 8, 3, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(66, 8, 4, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(67, 8, 5, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(68, 8, 6, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(69, 8, 7, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(71, 8, 9, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(72, 8, 10, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(74, 9, 4, '2016-05-28 22:00:00', '2016-06-04 13:14:04'),
(75, 9, 3, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(76, 9, 4, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(77, 9, 5, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(78, 9, 6, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(79, 12, 1, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(80, 12, 2, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(81, 12, 3, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(82, 12, 4, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(83, 12, 5, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(84, 12, 6, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(85, 12, 7, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(86, 12, 8, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(87, 12, 9, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(88, 12, 10, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(89, 13, 7, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(90, 13, 8, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(91, 13, 9, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(92, 13, 10, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(93, 14, 7, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(94, 14, 9, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(95, 15, 8, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(96, 15, 9, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(97, 16, 7, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(98, 16, 8, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(99, 16, 9, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(100, 16, 10, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(101, 17, 8, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(102, 17, 9, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(103, 18, 7, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(104, 18, 8, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(105, 18, 9, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(106, 18, 10, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(107, 19, 10, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(108, 20, 10, '2016-05-28 22:00:00', '2016-05-28 22:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE IF NOT EXISTS `asistencia` (
`id` int(10) unsigned NOT NULL,
  `fecha_clase` datetime NOT NULL,
  `asignatura_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `fecha_clase`, `asignatura_id`, `created_at`, `updated_at`) VALUES
(5, '2016-01-01 00:01:00', 4, '2016-06-02 08:20:12', '2016-06-02 08:20:12'),
(11, '2016-01-01 00:01:00', 10, '2016-06-02 18:26:58', '2016-06-02 18:26:58'),
(12, '2016-12-31 23:58:00', 7, '2016-06-02 18:37:50', '2016-06-02 18:37:50'),
(13, '2016-12-31 23:58:00', 7, '2016-06-02 18:40:02', '2016-06-02 18:40:02'),
(14, '2017-01-01 00:00:00', 9, '2016-06-02 18:41:45', '2016-06-02 18:41:45'),
(29, '2016-06-04 10:00:45', 5, '2016-06-04 16:22:46', '2016-06-04 16:22:46'),
(30, '2016-06-04 18:00:53', 1, '2016-06-04 16:23:10', '2016-06-04 16:23:10'),
(31, '2016-06-05 12:10:38', 6, '2016-06-05 10:11:08', '2016-06-05 10:11:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colegio`
--

CREATE TABLE IF NOT EXISTS `colegio` (
`id` int(10) unsigned NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cod_aula` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `user_rol_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `colegio`
--

INSERT INTO `colegio` (`id`, `nombre`, `cod_aula`, `user_rol_id`, `created_at`, `updated_at`) VALUES
(18, 'Ies Francesc de Borja Moll', 'icTJe', 15, '2016-05-22 15:45:38', '2016-05-29 12:45:32'),
(19, 'Ies Francesc de Borja Moll', 'icTJe', 16, '2016-05-22 16:13:36', '2016-05-30 08:59:19'),
(21, 'Ies Francesc de Borja Moll', 'icTJe', 18, '2016-06-02 15:05:27', '2016-06-02 15:08:35'),
(22, 'Ies Frances de Bora Moll', 'nU3eg', 23, '2016-06-05 07:27:32', '2016-06-05 08:17:02'),
(23, 'Ies Francesc de Borja Moll', 'g1iiX', 25, '2016-06-05 08:36:44', '2016-06-05 08:38:03'),
(24, 'Ies Francesc de Borja Moll', 'g1iiX', 26, '2016-06-05 10:05:44', '2016-06-05 10:09:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
`id` int(10) unsigned NOT NULL,
  `nombre_curso` enum('primero','segundo','tercero','cuarto','quinto','sexto') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id`, `nombre_curso`, `created_at`, `updated_at`) VALUES
(1, 'primero', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(2, 'segundo', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(3, 'tercero', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(4, 'cuarto', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(5, 'quinto', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(6, 'sexto', '2016-05-28 22:00:00', '2016-05-28 22:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_educativo`
--

CREATE TABLE IF NOT EXISTS `curso_educativo` (
`id` int(10) unsigned NOT NULL,
  `curso_id` int(10) unsigned NOT NULL,
  `grado_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `curso_educativo`
--

INSERT INTO `curso_educativo` (`id`, `curso_id`, `grado_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(2, 2, 1, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(3, 3, 1, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(4, 4, 1, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(5, 5, 1, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(6, 6, 1, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(7, 1, 2, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(8, 2, 2, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(9, 3, 2, '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(10, 4, 2, '2016-05-28 22:00:00', '2016-05-28 22:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_personales`
--

CREATE TABLE IF NOT EXISTS `datos_personales` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secondname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secondname2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DNI` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `fechanacimiento` date NOT NULL,
  `imgperfil` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'perfiles/perfil.jpg',
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `datos_personales`
--

INSERT INTO `datos_personales` (`id`, `name`, `secondname`, `secondname2`, `DNI`, `email`, `telefono`, `fechanacimiento`, `imgperfil`, `user_id`, `created_at`, `updated_at`) VALUES
(11, 'Bartolomé Jordan', 'Palmer', 'de vreugd', '43179384N', 'bj.devreugd@gmail.com', 662916686, '1991-08-28', 'perfiles/perfil.jpg', 23, '2016-05-22 16:12:24', '2016-05-29 12:45:35'),
(12, 'Batman', 'Sin', 'Padres', '43179384N', 'bj.devreugd@hotmail.com', 662916685, '2000-08-28', 'perfiles/perfil.jpg', 24, '2016-05-22 16:15:42', '2016-05-30 08:59:19'),
(13, 'Pepito', 'Ruiz', 'Mateos', '12345678A', 'pepe@gmail.com', 654987321, '2005-05-02', 'perfiles/perfil.jpg', 29, '2016-06-02 15:08:35', '2016-06-02 15:08:35'),
(14, 'Juan', 'Ruiz', 'rato', '47958763J', 'sysjordan@hotmail.com', 668789547, '1983-06-01', 'perfiles/perfil.jpg', 34, '2016-06-05 07:29:49', '2016-06-05 08:17:02'),
(15, 'Prueba', 'prueba', 'prueba', '98765432h', 'pp451064@gmail.com', 654987732, '1990-08-01', 'perfiles/perfil.jpg', 35, '2016-06-05 08:38:03', '2016-06-05 08:38:03'),
(16, 'Luisito', 'Salom', 'Mexicano', '87654321A', 'luisito@gmail.com', 667856987, '2010-02-01', 'perfiles/perfil.jpg', 36, '2016-06-05 10:09:06', '2016-06-05 10:09:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `excursion`
--

CREATE TABLE IF NOT EXISTS `excursion` (
`id` int(10) unsigned NOT NULL,
  `titulo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `importe` decimal(8,2) NOT NULL,
  `fecha_excursion` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `excursion`
--

INSERT INTO `excursion` (`id`, `titulo`, `descripcion`, `importe`, `fecha_excursion`, `created_at`, `updated_at`) VALUES
(4, 'Vuela ciclista', 'iremos a ver la vuelta ciclista por palma', '0.00', '2016-06-16 10:38:38', '2016-06-03 08:39:19', '2016-06-04 14:33:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado_educativo`
--

CREATE TABLE IF NOT EXISTS `grado_educativo` (
`id` int(10) unsigned NOT NULL,
  `grado` enum('primaria','secundaria') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `grado_educativo`
--

INSERT INTO `grado_educativo` (`id`, `grado`, `created_at`, `updated_at`) VALUES
(1, 'primaria', '2016-05-28 22:00:00', '2016-05-28 22:00:00'),
(2, 'secundaria', '2016-05-28 22:00:00', '2016-05-28 22:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajeria`
--

CREATE TABLE IF NOT EXISTS `mensajeria` (
`id` int(10) unsigned NOT NULL,
  `emisor_id` int(10) unsigned NOT NULL,
  `asunto` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `mensaje` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_enviado` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2014_11_19_171459_datos_personales', 1),
('2016_05_18_164636_rol', 1),
('2016_05_19_155905_user_rol', 1),
('2016_05_20_213127_create_colegio_table', 1),
('2016_05_29_152036_asignaturas', 2),
('2016_05_29_155549_grado_educativo', 3),
('2016_05_29_160056_curso', 4),
('2016_05_29_160329_asignaturas', 5),
('2016_05_29_164322_curso_educativo', 6),
('2016_05_29_170105_asig_curs_grad', 7),
('2016_05_29_173928_alum_asig_curs_grad', 8),
('2016_05_30_163436_tarea', 9),
('2016_05_30_165037_user_tarea', 10),
('2016_05_30_173154_excursion', 11),
('2016_05_30_173219_user_excursion', 12),
('2016_05_30_204320_asistencia', 13),
('2016_05_30_204328_user_asistencia', 13),
('2016_06_05_084302_tutorlegal_hijo', 14),
('2016_06_05_151738_tutoria', 15),
('2016_06_05_151815_user_tutoria', 15),
('2016_06_05_153731_mensajeria', 16),
('2016_06_05_153745_user_mensajeria', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
`id` int(10) unsigned NOT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `tipo`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'administrador de la aplicacaion', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'profesor', 'profesor del aula', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'alumno', 'alumno del aula', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'tutor', 'tutor del alumno', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE IF NOT EXISTS `tarea` (
`id` int(10) unsigned NOT NULL,
  `asignatura_id` int(10) unsigned NOT NULL,
  `titulo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tarea`
--

INSERT INTO `tarea` (`id`, `asignatura_id`, `titulo`, `descripcion`, `fecha_inicio`, `fecha_fin`, `created_at`, `updated_at`) VALUES
(18, 2, 'abcdef', 'acbwfdf', '2016-12-31 22:59:00', '2015-12-31 23:59:00', '2016-06-02 20:00:01', '2016-06-02 20:00:01'),
(19, 1, 'prueba de tiempo', 'tiempo tiempo', '2016-06-07 01:10:23', '2016-06-23 11:55:23', '2016-06-02 22:14:24', '2016-06-02 22:14:24'),
(20, 2, 'abcdef', 'asdgdcasd', '2016-06-03 10:35:42', '2016-06-10 10:39:42', '2016-06-03 08:47:30', '2016-06-03 08:47:30'),
(21, 3, 'sfghfhfh', 'hfghfgdh', '2016-06-03 06:30:23', '2016-06-10 11:55:23', '2016-06-03 08:48:44', '2016-06-03 08:48:44'),
(22, 2, 'asdsadsad', 'sdfsadfsdaf', '2009-01-27 01:05:39', '2016-06-03 12:05:39', '2016-06-03 10:08:29', '2016-06-03 10:08:29'),
(23, 4, 'funcionaaaaaa', 'abcfggh', '2016-06-04 09:35:54', '2016-06-04 09:15:54', '2016-06-04 07:24:12', '2016-06-04 07:30:53'),
(25, 5, 'prueba ocho', 'sdhasfhttrgfdg', '2016-06-23 11:55:00', '2016-06-23 11:55:00', '2016-06-05 09:42:07', '2016-06-05 09:42:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutoria`
--

CREATE TABLE IF NOT EXISTS `tutoria` (
`id` int(10) unsigned NOT NULL,
  `emisor_id` int(10) unsigned NOT NULL,
  `titulo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_tutoria` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutorlegal_hijo`
--

CREATE TABLE IF NOT EXISTS `tutorlegal_hijo` (
`id` int(10) unsigned NOT NULL,
  `hijo_id` int(10) unsigned NOT NULL,
  `tutor_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tutorlegal_hijo`
--

INSERT INTO `tutorlegal_hijo` (`id`, `hijo_id`, `tutor_id`, `created_at`, `updated_at`) VALUES
(2, 18, 23, '2016-06-05 07:23:26', '2016-06-05 07:23:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `confirm_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `imgperfil` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'perfiles/perfil.jpg'
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `active`, `confirm_token`, `remember_token`, `created_at`, `updated_at`, `imgperfil`) VALUES
(23, 'Bartolomé', 'bj.devreugd@gmail.com', '$2y$10$4Odp0j4w3X/erflbqHt/0O3yAlrmr4M3y5UmSkFqDRu0PsIPh02Yi', 1, 'tSYjNzGtROABZMRpHb85PUGhmdmPi9nvCnqk4O7NbNeaSfOKWPLl2kUan9B1HVo3xWeM0QvBDthWOHSfBcs8bW2ZlnzD0lhN8VEj', 'bDBNxodeOa2p0kOtl6ATb60rURiMim6ZyNeENkWvmq2Gc2kn2B1vuPuB8c5d', '2016-05-22 15:43:41', '2016-06-05 09:00:06', 'perfiles/dxxgb4mqCtKnOcVA6xuEexMlyxhXrn-slack.JPG'),
(24, 'Jordan', 'bj.devreugd@hotmail.com', '$2y$10$ZM4kZFXir5bC2b4cuibUTOok8YaOpHLY9p7KIqmbibAP3D/cJoZsC', 1, '0FO2Z0FG3eYI5zecZLmF2rHU1QhBXwgASGID0AToVaxb4DYoRMqcWQDtwtW8NioxDnJOeGpTXVdciSbdb8dgEfemgU4lqJPl6e6g', 'cIXpfo1tMM5tPnOSczGNcniqygLR116k7dZe6UUck4UNPXa0S1I5LJ6NKfEK', '2016-05-22 16:13:35', '2016-06-05 12:28:22', 'perfiles/PDVWXwMq18TevhNtId5Vq5189oqgtW-slack.JPG'),
(29, 'Pepito', 'pepe@gmail.com', '$2y$10$wKiX0E4VZjeStgGFTFcqmuGGYhjwoAj87vUXfsVaaH9Rgbgcu57na', 1, 'cbtxFbuE8HHkGXaEmi9oSLaXZ2Ifus1yJTgHSUkAEKdcuC0agN7A1zEBLPTVp2NTTb7eG16BnLlARXW010wKWlGK4OBfGUOM5u2Q', 'oIX0TQKbAVSR5rzF4urCUN2FBIRWJipDUsKXhyPt9GzCuVb6zE17Q20dBi42', '2016-06-02 15:05:26', '2016-06-04 16:19:18', 'perfiles/perfil.jpg'),
(34, 'Juan', 'sysjordan@hotmail.com', '$2y$10$vDybGDc5w89zVSCDQhBLzeoAD7747MxL5PDHUKWMhRPwR4QK.iasK', 1, 'zDiZMRuxmJaP2aCoGCsr1MCsUUx4QGHOuycCp2S0ENCfQM30OguQ8wrNkmqlYQfVcspu0QOSSE2z3qu0ZvKg3HL4aGUYRos7O9F9', 'GCfvNWTiXWsIy7voBpe7zHsUOAeNIPlwwFLzmoASoRv5RZj731VFQ9N3DZo0', '2016-06-05 07:23:26', '2016-06-05 08:17:15', 'perfiles/perfil.jpg'),
(35, 'Prueba', 'pp451064@gmail.com', '$2y$10$NTfDAY2ivQZg3zkCnhD3tu6R72td/0fBP7uk4mHj.oHOpGhK9bldi', 1, 'rLWC9c4aVpZInGqXP4eUs7gip5FmOtCU1WgfLY8oPVB57iTbsfL5J9HG1566rpHlaktFP3eSGulhOjT9eQ1gI8uA1qu4UkijdpB7', 'KauBviAm7a3NiiqX3P7Z5XI5L4DtAShoGHjcehQsWppufhrv2CxkoROS58oq', '2016-06-05 08:36:28', '2016-06-05 10:12:38', 'perfiles/perfil.jpg'),
(36, 'Luisito', 'luisito@gmail.com', '$2y$10$xc1ZRluFvvomLd4LyfhQz.vg7DmevI6zzCS9zeRDuwEW3SVPgOSPC', 1, 'IQePTzYpBBjXiH30Rxvrjtb1dt5eEaYaSSq3VdfEgWDzHIU67EmaczhWzqsgbVqcsLQ4WJFQ2P4FQsCD61qeN0sUmMsumvkl44GU', 'JblXz0o5ltJkAKnu2juncCIjqBlJmgHR2UowBgSOTCmrh7yNQXs5I0vYsJL5', '2016-06-05 10:05:44', '2016-06-05 12:16:52', 'perfiles/perfil.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_asistencia`
--

CREATE TABLE IF NOT EXISTS `user_asistencia` (
`id` int(10) unsigned NOT NULL,
  `user_rol_id` int(10) unsigned NOT NULL,
  `asistencia_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `asiste` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user_asistencia`
--

INSERT INTO `user_asistencia` (`id`, `user_rol_id`, `asistencia_id`, `created_at`, `updated_at`, `asiste`) VALUES
(23, 18, 29, '2016-06-04 16:22:46', '2016-06-04 16:22:46', 0),
(24, 16, 30, '2016-06-04 16:23:10', '2016-06-04 16:23:10', 1),
(25, 26, 31, '2016-06-05 10:11:08', '2016-06-05 10:11:08', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_excursion`
--

CREATE TABLE IF NOT EXISTS `user_excursion` (
`id` int(10) unsigned NOT NULL,
  `user_rol_id` int(10) unsigned NOT NULL,
  `excursion_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user_excursion`
--

INSERT INTO `user_excursion` (`id`, `user_rol_id`, `excursion_id`, `created_at`, `updated_at`) VALUES
(3, 18, 4, '2016-06-03 08:39:39', '2016-06-03 08:39:39'),
(6, 16, 4, '2016-06-03 09:53:36', '2016-06-03 09:53:36'),
(8, 26, 4, '2016-06-05 10:12:07', '2016-06-05 10:12:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_mensajeria`
--

CREATE TABLE IF NOT EXISTS `user_mensajeria` (
`id` int(10) unsigned NOT NULL,
  `mensajeria_id` int(10) unsigned NOT NULL,
  `receptor_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_rol`
--

CREATE TABLE IF NOT EXISTS `user_rol` (
`id` int(10) unsigned NOT NULL,
  `rol_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user_rol`
--

INSERT INTO `user_rol` (`id`, `rol_id`, `user_id`, `created_at`, `updated_at`) VALUES
(15, 2, 23, '2016-05-22 15:45:38', '2016-05-22 15:45:38'),
(16, 3, 24, '2016-05-22 16:13:36', '2016-05-22 16:13:36'),
(18, 3, 29, '2016-06-02 15:05:26', '2016-06-02 15:05:26'),
(23, 4, 34, '2016-06-05 07:23:26', '2016-06-05 07:23:26'),
(24, 2, 34, '2016-06-05 07:27:32', '2016-06-05 07:27:32'),
(25, 2, 35, '2016-06-05 08:36:43', '2016-06-05 08:36:43'),
(26, 3, 36, '2016-06-05 10:05:44', '2016-06-05 10:05:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_tarea`
--

CREATE TABLE IF NOT EXISTS `user_tarea` (
`id` int(10) unsigned NOT NULL,
  `user_rol_id` int(10) unsigned NOT NULL,
  `tarea_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user_tarea`
--

INSERT INTO `user_tarea` (`id`, `user_rol_id`, `tarea_id`, `created_at`, `updated_at`) VALUES
(34, 18, 18, '2016-06-02 20:00:13', '2016-06-02 20:00:13'),
(35, 18, 19, '2016-06-02 22:14:38', '2016-06-02 22:14:38'),
(36, 18, 20, '2016-06-03 08:48:20', '2016-06-03 08:48:20'),
(37, 18, 22, '2016-06-03 10:08:58', '2016-06-03 10:08:58'),
(39, 18, 23, '2016-06-04 07:24:36', '2016-06-04 07:24:36'),
(41, 16, 23, '2016-06-04 10:05:11', '2016-06-04 10:05:11'),
(42, 16, 22, '2016-06-04 10:05:45', '2016-06-04 10:05:45'),
(43, 16, 19, '2016-06-04 10:06:15', '2016-06-04 10:06:15'),
(45, 16, 23, '2016-06-04 13:19:05', '2016-06-04 13:19:05'),
(46, 16, 18, '2016-06-05 09:41:00', '2016-06-05 09:41:00'),
(47, 18, 25, '2016-06-05 09:42:26', '2016-06-05 09:42:26'),
(48, 26, 19, '2016-06-05 10:10:33', '2016-06-05 10:10:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_tutoria`
--

CREATE TABLE IF NOT EXISTS `user_tutoria` (
`id` int(10) unsigned NOT NULL,
  `tutoria_id` int(10) unsigned NOT NULL,
  `receptor_id` int(10) unsigned NOT NULL,
  `asiste` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alum_asig_curs_grad`
--
ALTER TABLE `alum_asig_curs_grad`
 ADD PRIMARY KEY (`id`), ADD KEY `alum_asig_curs_grad_user_rol_id_foreign` (`user_rol_id`), ADD KEY `alum_asig_curs_grad_asig_curs_grad_id_foreign` (`asig_curs_grad_id`);

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asig_curs_grad`
--
ALTER TABLE `asig_curs_grad`
 ADD PRIMARY KEY (`id`), ADD KEY `asig_curs_grad_asignatura_id_foreign` (`asignatura_id`), ADD KEY `asig_curs_grad_curso_grado_id_foreign` (`curso_grado_id`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
 ADD PRIMARY KEY (`id`), ADD KEY `asistencia_asignatura_id_foreign` (`asignatura_id`);

--
-- Indices de la tabla `colegio`
--
ALTER TABLE `colegio`
 ADD PRIMARY KEY (`id`), ADD KEY `colegio_user_rol_id_foreign` (`user_rol_id`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `curso_educativo`
--
ALTER TABLE `curso_educativo`
 ADD PRIMARY KEY (`id`), ADD KEY `curso_educativo_curso_id_foreign` (`curso_id`), ADD KEY `curso_educativo_grado_id_foreign` (`grado_id`);

--
-- Indices de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `datos_personales_email_unique` (`email`), ADD KEY `datos_personales_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `excursion`
--
ALTER TABLE `excursion`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grado_educativo`
--
ALTER TABLE `grado_educativo`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajeria`
--
ALTER TABLE `mensajeria`
 ADD PRIMARY KEY (`id`), ADD KEY `mensajeria_emisor_id_foreign` (`emisor_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
 ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tarea`
--
ALTER TABLE `tarea`
 ADD PRIMARY KEY (`id`), ADD KEY `tarea_asignatura_id_foreign` (`asignatura_id`);

--
-- Indices de la tabla `tutoria`
--
ALTER TABLE `tutoria`
 ADD PRIMARY KEY (`id`), ADD KEY `tutoria_emisor_id_foreign` (`emisor_id`);

--
-- Indices de la tabla `tutorlegal_hijo`
--
ALTER TABLE `tutorlegal_hijo`
 ADD PRIMARY KEY (`id`), ADD KEY `tutorlegal_hijo_hijo_id_foreign` (`hijo_id`), ADD KEY `tutorlegal_hijo_tutor_id_foreign` (`tutor_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `user_asistencia`
--
ALTER TABLE `user_asistencia`
 ADD PRIMARY KEY (`id`), ADD KEY `user_asistencia_user_rol_id_foreign` (`user_rol_id`), ADD KEY `user_asistencia_asistencia_id_foreign` (`asistencia_id`);

--
-- Indices de la tabla `user_excursion`
--
ALTER TABLE `user_excursion`
 ADD PRIMARY KEY (`id`), ADD KEY `user_excursion_user_rol_id_foreign` (`user_rol_id`), ADD KEY `user_excursion_excursion_id_foreign` (`excursion_id`);

--
-- Indices de la tabla `user_mensajeria`
--
ALTER TABLE `user_mensajeria`
 ADD PRIMARY KEY (`id`), ADD KEY `user_mensajeria_mensajeria_id_foreign` (`mensajeria_id`), ADD KEY `user_mensajeria_receptor_id_foreign` (`receptor_id`);

--
-- Indices de la tabla `user_rol`
--
ALTER TABLE `user_rol`
 ADD PRIMARY KEY (`id`), ADD KEY `user_rol_rol_id_foreign` (`rol_id`), ADD KEY `user_rol_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `user_tarea`
--
ALTER TABLE `user_tarea`
 ADD PRIMARY KEY (`id`), ADD KEY `user_tarea_user_rol_id_foreign` (`user_rol_id`), ADD KEY `user_tarea_tarea_id_foreign` (`tarea_id`);

--
-- Indices de la tabla `user_tutoria`
--
ALTER TABLE `user_tutoria`
 ADD PRIMARY KEY (`id`), ADD KEY `user_tutoria_tutoria_id_foreign` (`tutoria_id`), ADD KEY `user_tutoria_receptor_id_foreign` (`receptor_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alum_asig_curs_grad`
--
ALTER TABLE `alum_asig_curs_grad`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `asig_curs_grad`
--
ALTER TABLE `asig_curs_grad`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=109;
--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `colegio`
--
ALTER TABLE `colegio`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `curso_educativo`
--
ALTER TABLE `curso_educativo`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `excursion`
--
ALTER TABLE `excursion`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `grado_educativo`
--
ALTER TABLE `grado_educativo`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `mensajeria`
--
ALTER TABLE `mensajeria`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tarea`
--
ALTER TABLE `tarea`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `tutoria`
--
ALTER TABLE `tutoria`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tutorlegal_hijo`
--
ALTER TABLE `tutorlegal_hijo`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `user_asistencia`
--
ALTER TABLE `user_asistencia`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `user_excursion`
--
ALTER TABLE `user_excursion`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `user_mensajeria`
--
ALTER TABLE `user_mensajeria`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `user_rol`
--
ALTER TABLE `user_rol`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `user_tarea`
--
ALTER TABLE `user_tarea`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de la tabla `user_tutoria`
--
ALTER TABLE `user_tutoria`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alum_asig_curs_grad`
--
ALTER TABLE `alum_asig_curs_grad`
ADD CONSTRAINT `alum_asig_curs_grad_asig_curs_grad_id_foreign` FOREIGN KEY (`asig_curs_grad_id`) REFERENCES `asig_curs_grad` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `alum_asig_curs_grad_user_rol_id_foreign` FOREIGN KEY (`user_rol_id`) REFERENCES `user_rol` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `asig_curs_grad`
--
ALTER TABLE `asig_curs_grad`
ADD CONSTRAINT `asig_curs_grad_asignatura_id_foreign` FOREIGN KEY (`asignatura_id`) REFERENCES `asignaturas` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `asig_curs_grad_curso_grado_id_foreign` FOREIGN KEY (`curso_grado_id`) REFERENCES `curso_educativo` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
ADD CONSTRAINT `asistencia_asignatura_id_foreign` FOREIGN KEY (`asignatura_id`) REFERENCES `asignaturas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `colegio`
--
ALTER TABLE `colegio`
ADD CONSTRAINT `colegio_user_rol_id_foreign` FOREIGN KEY (`user_rol_id`) REFERENCES `user_rol` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `curso_educativo`
--
ALTER TABLE `curso_educativo`
ADD CONSTRAINT `curso_educativo_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `curso_educativo_grado_id_foreign` FOREIGN KEY (`grado_id`) REFERENCES `grado_educativo` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
ADD CONSTRAINT `datos_personales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `mensajeria`
--
ALTER TABLE `mensajeria`
ADD CONSTRAINT `mensajeria_emisor_id_foreign` FOREIGN KEY (`emisor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tarea`
--
ALTER TABLE `tarea`
ADD CONSTRAINT `tarea_asignatura_id_foreign` FOREIGN KEY (`asignatura_id`) REFERENCES `asignaturas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tutoria`
--
ALTER TABLE `tutoria`
ADD CONSTRAINT `tutoria_emisor_id_foreign` FOREIGN KEY (`emisor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tutorlegal_hijo`
--
ALTER TABLE `tutorlegal_hijo`
ADD CONSTRAINT `tutorlegal_hijo_hijo_id_foreign` FOREIGN KEY (`hijo_id`) REFERENCES `user_rol` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `tutorlegal_hijo_tutor_id_foreign` FOREIGN KEY (`tutor_id`) REFERENCES `user_rol` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_asistencia`
--
ALTER TABLE `user_asistencia`
ADD CONSTRAINT `user_asistencia_asistencia_id_foreign` FOREIGN KEY (`asistencia_id`) REFERENCES `asistencia` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `user_asistencia_user_rol_id_foreign` FOREIGN KEY (`user_rol_id`) REFERENCES `user_rol` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_excursion`
--
ALTER TABLE `user_excursion`
ADD CONSTRAINT `user_excursion_excursion_id_foreign` FOREIGN KEY (`excursion_id`) REFERENCES `excursion` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `user_excursion_user_rol_id_foreign` FOREIGN KEY (`user_rol_id`) REFERENCES `user_rol` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_mensajeria`
--
ALTER TABLE `user_mensajeria`
ADD CONSTRAINT `user_mensajeria_mensajeria_id_foreign` FOREIGN KEY (`mensajeria_id`) REFERENCES `mensajeria` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `user_mensajeria_receptor_id_foreign` FOREIGN KEY (`receptor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_rol`
--
ALTER TABLE `user_rol`
ADD CONSTRAINT `user_rol_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `user_rol_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_tarea`
--
ALTER TABLE `user_tarea`
ADD CONSTRAINT `user_tarea_tarea_id_foreign` FOREIGN KEY (`tarea_id`) REFERENCES `tarea` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `user_tarea_user_rol_id_foreign` FOREIGN KEY (`user_rol_id`) REFERENCES `user_rol` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_tutoria`
--
ALTER TABLE `user_tutoria`
ADD CONSTRAINT `user_tutoria_receptor_id_foreign` FOREIGN KEY (`receptor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `user_tutoria_tutoria_id_foreign` FOREIGN KEY (`tutoria_id`) REFERENCES `tutoria` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
