-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 31-05-2024 a las 16:45:42
-- Versión del servidor: 8.0.36-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tesseract`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte_mercancia`
--

CREATE TABLE `transporte_mercancia` (
  `localizador` int NOT NULL,
  `matricula` varchar(7) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `transporte_mercancia`
--
ALTER TABLE `transporte_mercancia`
  ADD PRIMARY KEY (`localizador`,`matricula`),
  ADD KEY `fk-matricula-transporte` (`matricula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `transporte_mercancia`
--
ALTER TABLE `transporte_mercancia`
  MODIFY `localizador` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `transporte_mercancia`
--
ALTER TABLE `transporte_mercancia`
  ADD CONSTRAINT `fk-localizador-transporte` FOREIGN KEY (`localizador`) REFERENCES `mercancia` (`localizador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-matricula-transporte` FOREIGN KEY (`matricula`) REFERENCES `vehiculos` (`matricula`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
