-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 25-05-2024 a las 13:27:48
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
-- Estructura de tabla para la tabla `cuentas_web`
--

CREATE TABLE `cuentas_web` (
  `dni_empleado` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `dni` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellidos` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` int NOT NULL,
  `correo` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha_nacimiento` int NOT NULL,
  `fecha_inicio_empresa` int NOT NULL,
  `cargo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada_empleados`
--

CREATE TABLE `jornada_empleados` (
  `dni_empleado` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha_jornada` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `hora_entrada` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `hora_salida` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mercancia`
--

CREATE TABLE `mercancia` (
  `localizador` int NOT NULL,
  `cliente` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `peso` float(7,2) NOT NULL,
  `tipo_estado` int NOT NULL,
  `tipo_peso` int NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planificacion_empleados`
--

CREATE TABLE `planificacion_empleados` (
  `fecha` int NOT NULL,
  `empleado` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cargo`
--

CREATE TABLE `tipo_cargo` (
  `tipo` int NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_cargo`
--

INSERT INTO `tipo_cargo` (`tipo`, `nombre`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'TRANSPORTISTA'),
(3, 'MOZO ALMACÉN'),
(4, 'RR.HH');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_estado_mercancia`
--

CREATE TABLE `tipo_estado_mercancia` (
  `tipo` int NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_estado_mercancia`
--

INSERT INTO `tipo_estado_mercancia` (`tipo`, `nombre`) VALUES
(1, 'En almacén'),
(2, 'Pendiente de recogida'),
(3, 'En tránsito'),
(4, 'En reparto'),
(5, 'Entregado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_estado_vehiculo`
--

CREATE TABLE `tipo_estado_vehiculo` (
  `tipo` int NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_estado_vehiculo`
--

INSERT INTO `tipo_estado_vehiculo` (`tipo`, `nombre`) VALUES
(1, 'En almacén'),
(2, 'Cargando mercancía'),
(3, 'En punto de recogida'),
(4, 'Listo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_peso`
--

CREATE TABLE `tipo_peso` (
  `tipo` int NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_peso`
--

INSERT INTO `tipo_peso` (`tipo`, `nombre`) VALUES
(1, 'KG'),
(2, 'L');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte_mercancia`
--

CREATE TABLE `transporte_mercancia` (
  `localizador` int NOT NULL,
  `matricula` varchar(7) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `dni` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellidos` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` int NOT NULL,
  `correo` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `matricula` varchar(7) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `carga_util` float(7,2) NOT NULL,
  `tipo_peso` int NOT NULL,
  `tipo_estado` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuentas_web`
--
ALTER TABLE `cuentas_web`
  ADD KEY `fk-cuentas-empleado` (`dni_empleado`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`dni`),
  ADD KEY `fk-cargo-empleado` (`cargo`);

--
-- Indices de la tabla `jornada_empleados`
--
ALTER TABLE `jornada_empleados`
  ADD PRIMARY KEY (`dni_empleado`,`fecha_jornada`,`hora_entrada`,`hora_salida`);

--
-- Indices de la tabla `mercancia`
--
ALTER TABLE `mercancia`
  ADD PRIMARY KEY (`localizador`),
  ADD KEY `fk-cliente-mercancia` (`cliente`),
  ADD KEY `fk-tipo-estado-mercancia` (`tipo_estado`),
  ADD KEY `fk-tipo-peso-mercancia` (`tipo_peso`);

--
-- Indices de la tabla `planificacion_empleados`
--
ALTER TABLE `planificacion_empleados`
  ADD PRIMARY KEY (`fecha`,`empleado`,`descripcion`),
  ADD KEY `fk-planificacion-empleado` (`empleado`);

--
-- Indices de la tabla `tipo_cargo`
--
ALTER TABLE `tipo_cargo`
  ADD PRIMARY KEY (`tipo`);

--
-- Indices de la tabla `tipo_estado_mercancia`
--
ALTER TABLE `tipo_estado_mercancia`
  ADD PRIMARY KEY (`tipo`);

--
-- Indices de la tabla `tipo_estado_vehiculo`
--
ALTER TABLE `tipo_estado_vehiculo`
  ADD PRIMARY KEY (`tipo`);

--
-- Indices de la tabla `tipo_peso`
--
ALTER TABLE `tipo_peso`
  ADD PRIMARY KEY (`tipo`);

--
-- Indices de la tabla `transporte_mercancia`
--
ALTER TABLE `transporte_mercancia`
  ADD PRIMARY KEY (`localizador`,`matricula`),
  ADD KEY `fk-matricula-transporte` (`matricula`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `fk-tipo-estado-vehiculo` (`tipo_estado`),
  ADD KEY `fk-tipo-peso-vehiculo` (`tipo_peso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mercancia`
--
ALTER TABLE `mercancia`
  MODIFY `localizador` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `transporte_mercancia`
--
ALTER TABLE `transporte_mercancia`
  MODIFY `localizador` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuentas_web`
--
ALTER TABLE `cuentas_web`
  ADD CONSTRAINT `fk-cuentas-empleado` FOREIGN KEY (`dni_empleado`) REFERENCES `empleados` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `fk-cargo-empleado` FOREIGN KEY (`cargo`) REFERENCES `tipo_cargo` (`tipo`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `jornada_empleados`
--
ALTER TABLE `jornada_empleados`
  ADD CONSTRAINT `fk-empleado-jornada` FOREIGN KEY (`dni_empleado`) REFERENCES `empleados` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mercancia`
--
ALTER TABLE `mercancia`
  ADD CONSTRAINT `fk-cliente-mercancia` FOREIGN KEY (`cliente`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-tipo-estado-mercancia` FOREIGN KEY (`tipo_estado`) REFERENCES `tipo_estado_mercancia` (`tipo`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-tipo-peso-mercancia` FOREIGN KEY (`tipo_peso`) REFERENCES `tipo_peso` (`tipo`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `planificacion_empleados`
--
ALTER TABLE `planificacion_empleados`
  ADD CONSTRAINT `fk-planificacion-empleado` FOREIGN KEY (`empleado`) REFERENCES `empleados` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transporte_mercancia`
--
ALTER TABLE `transporte_mercancia`
  ADD CONSTRAINT `fk-localizador-transporte` FOREIGN KEY (`localizador`) REFERENCES `mercancia` (`localizador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-matricula-transporte` FOREIGN KEY (`matricula`) REFERENCES `vehiculos` (`matricula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `fk-tipo-estado-vehiculo` FOREIGN KEY (`tipo_estado`) REFERENCES `tipo_estado_vehiculo` (`tipo`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-tipo-peso-vehiculo` FOREIGN KEY (`tipo_peso`) REFERENCES `tipo_peso` (`tipo`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
