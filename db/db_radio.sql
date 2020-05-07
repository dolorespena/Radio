-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2020 a las 23:00:49
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_radio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `columnista`
--

CREATE TABLE `columnista` (
  `id_columnista` int(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `profesion` varchar(100) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `url_imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `columnista`
--

INSERT INTO `columnista` (`id_columnista`, `nombre`, `profesion`, `descripcion`, `url_imagen`) VALUES
(6, 'Felipe Pigna', 'Historiador', 'Historias de nuestra historia', '/img/profile/pigna.jpg'),
(7, 'Alejandro Dolina', 'Humorista', 'La venganza será terrible', '/img/profile/dolina.jpg'),
(8, 'Gabriel Rolón', 'Psicólogo', 'Palabra Plena', 'img/profile/rolon.jpg'),
(9, 'Paulina Cocina', 'Cocinera', 'Receta en 30 minutos', 'img/profile/paulina.jpg'),
(10, 'Darío Sztajnszrajber', 'Filósofo', 'Pienso luego existo', 'img/profile/sztajnszrajber.jpg'),
(11, 'Eduardo Sacheri', 'Escritor', 'Libros recomendados', 'img/profile/sacheri.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `podcast`
--

CREATE TABLE `podcast` (
  `id_podcast` int(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `url_audio` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `duracion` int(10) NOT NULL,
  `tag` varchar(20) DEFAULT NULL,
  `invitado` varchar(20) DEFAULT NULL,
  `id_columnista_fk` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `podcast`
--

INSERT INTO `podcast` (`id_podcast`, `nombre`, `descripcion`, `url_audio`, `fecha`, `duracion`, `tag`, `invitado`, `id_columnista_fk`) VALUES
(1, 'No piensen por nosotros', 'Seguramente muchas veces hemos escuchado la palabra \"narcisita\". Analizaremos su origen y su historia de amor detrás. Para ver que no siempre pensar en uno mismo es pecado.', 'audio/no-piensen-por-nosotros.ogg', '2020-03-17', 8, 'narcisismo', NULL, 8);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `columnista`
--
ALTER TABLE `columnista`
  ADD PRIMARY KEY (`id_columnista`);

--
-- Indices de la tabla `podcast`
--
ALTER TABLE `podcast`
  ADD PRIMARY KEY (`id_podcast`),
  ADD KEY `id_columnista_fk` (`id_columnista_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `columnista`
--
ALTER TABLE `columnista`
  MODIFY `id_columnista` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `podcast`
--
ALTER TABLE `podcast`
  MODIFY `id_podcast` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
