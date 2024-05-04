-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-05-2024 a las 00:37:27
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
<<<<<<< HEAD
<<<<<<< HEAD
  `dni_empleado` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `cuentas_web`
--

INSERT INTO `cuentas_web` (`dni_empleado`, `password`) VALUES
('03491731D', '$2y$10$L5/2ikdqTl4VBlctPiuwp.MRlJwRM088wb0bKqDlRLjh31u2tEp0y');

=======
                               `dni_empleado` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
                               `password` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

>>>>>>> 59e9d48 (db v2.0)
=======
                               `dni_empleado` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
                               `password` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
<<<<<<< HEAD
<<<<<<< HEAD
  `dni` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellidos` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` int NOT NULL,
  `correo` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha_nacimiento` int NOT NULL,
  `fecha_inicio_empresa` int NOT NULL,
  `cargo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`dni`, `nombre`, `apellidos`, `telefono`, `correo`, `fecha_nacimiento`, `fecha_inicio_empresa`, `cargo`) VALUES
('03491731D', 'Ivan', 'Garcia', 635966792, 'ivan@gmail.com', 20040617, 20240504, 1),
('12345678A', 'Prueba', 'Prueba', 666666666, 'prueba@gmail.com', 20000101, 20240101, 1);

=======
                             `dni` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
                             `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
                             `apellidos` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
                             `telefono` int NOT NULL,
                             `correo` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
                             `fecha_nacimiento` int NOT NULL,
                             `fecha_inicio_empresa` int NOT NULL,
                             `cargo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

>>>>>>> 59e9d48 (db v2.0)
=======
                             `dni` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
                             `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
                             `apellidos` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
                             `telefono` int NOT NULL,
                             `correo` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
                             `fecha_nacimiento` int NOT NULL,
                             `fecha_inicio_empresa` int NOT NULL,
                             `cargo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada_empleados`
--

CREATE TABLE `jornada_empleados` (
<<<<<<< HEAD
<<<<<<< HEAD
  `dni_empleado` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha_jornada` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `hora_entrada` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `hora_salida` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `jornada_empleados`
--

INSERT INTO `jornada_empleados` (`dni_empleado`, `fecha_jornada`, `hora_entrada`, `hora_salida`) VALUES
('03491731D', '5/5/2024', '0:35:42', '0:35:43'),
('03491731D', '5/5/2024', '0:35:44', '0:35:45'),
('03491731D', '5/5/2024', '0:36:33', '0:36:33'),
('03491731D', '5/5/2024', '0:36:34', '0:36:34');

=======
                                     `dni_empleado` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
                                     `fecha_jornada` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
                                     `hora_entrada` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
                                     `hora_salida` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

>>>>>>> 59e9d48 (db v2.0)
=======
                                     `dni_empleado` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
                                     `fecha_jornada` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
                                     `hora_entrada` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
                                     `hora_salida` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mercancia`
--

CREATE TABLE `mercancia` (
<<<<<<< HEAD
<<<<<<< HEAD
  `localizador` int NOT NULL,
  `cliente` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `peso` float(7,2) NOT NULL,
=======
                             `localizador` int NOT NULL,
                             `cliente` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
                             `peso` float(7,2) NOT NULL,
>>>>>>> 59e9d48 (db v2.0)
=======
                             `localizador` int NOT NULL,
                             `cliente` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
                             `peso` float(7,2) NOT NULL,
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
  `tipo_estado` int NOT NULL,
  `tipo_peso` int NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planificacion_empleados`
--

CREATE TABLE `planificacion_empleados` (
<<<<<<< HEAD
<<<<<<< HEAD
  `fecha` int NOT NULL,
  `empleado` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
=======
                                           `fecha` int NOT NULL,
                                           `empleado` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
                                           `descripcion` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
>>>>>>> 59e9d48 (db v2.0)
=======
                                           `fecha` int NOT NULL,
                                           `empleado` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
                                           `descripcion` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cargo`
--

CREATE TABLE `tipo_cargo` (
<<<<<<< HEAD
<<<<<<< HEAD
  `tipo` int NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_cargo`
--

INSERT INTO `tipo_cargo` (`tipo`, `nombre`) VALUES
(1, 'ADMINISTRADOR');

=======
                              `tipo` int NOT NULL,
                              `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

>>>>>>> 59e9d48 (db v2.0)
=======
                              `tipo` int NOT NULL,
                              `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_estado`
--

CREATE TABLE `tipo_estado` (
<<<<<<< HEAD
<<<<<<< HEAD
  `tipo` int NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL
=======
                               `tipo` int NOT NULL,
                               `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL
>>>>>>> 59e9d48 (db v2.0)
=======
                               `tipo` int NOT NULL,
                               `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_peso`
--

CREATE TABLE `tipo_peso` (
<<<<<<< HEAD
<<<<<<< HEAD
  `tipo` int NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL
=======
                             `tipo` int NOT NULL,
                             `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL
>>>>>>> 59e9d48 (db v2.0)
=======
                             `tipo` int NOT NULL,
                             `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte_mercancia`
--

CREATE TABLE `transporte_mercancia` (
<<<<<<< HEAD
<<<<<<< HEAD
  `localizador` int NOT NULL,
  `matricula` varchar(7) COLLATE utf8mb4_spanish2_ci NOT NULL
=======
                                        `localizador` int NOT NULL,
                                        `matricula` varchar(7) COLLATE utf8mb4_spanish2_ci NOT NULL
>>>>>>> 59e9d48 (db v2.0)
=======
                                        `localizador` int NOT NULL,
                                        `matricula` varchar(7) COLLATE utf8mb4_spanish2_ci NOT NULL
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
<<<<<<< HEAD
<<<<<<< HEAD
  `dni` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellidos` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` int NOT NULL,
  `correo` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL
=======
=======
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
                            `dni` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
                            `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
                            `apellidos` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
                            `telefono` int NOT NULL,
                            `correo` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL
<<<<<<< HEAD
>>>>>>> 59e9d48 (db v2.0)
=======
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
<<<<<<< HEAD
<<<<<<< HEAD
  `matricula` varchar(7) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `carga_util` float(7,2) NOT NULL,
=======
                             `matricula` varchar(7) COLLATE utf8mb4_spanish2_ci NOT NULL,
                             `carga_util` float(7,2) NOT NULL,
>>>>>>> 59e9d48 (db v2.0)
=======
                             `matricula` varchar(7) COLLATE utf8mb4_spanish2_ci NOT NULL,
                             `carga_util` float(7,2) NOT NULL,
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
  `tipo_peso` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos_empleados`
--

CREATE TABLE `vehiculos_empleados` (
<<<<<<< HEAD
<<<<<<< HEAD
  `empleado` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `vehiculo` varchar(7) COLLATE utf8mb4_spanish2_ci NOT NULL
=======
                                       `empleado` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
                                       `vehiculo` varchar(7) COLLATE utf8mb4_spanish2_ci NOT NULL
>>>>>>> 59e9d48 (db v2.0)
=======
                                       `empleado` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
                                       `vehiculo` varchar(7) COLLATE utf8mb4_spanish2_ci NOT NULL
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuentas_web`
--
ALTER TABLE `cuentas_web`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD KEY `fk-cuentas-empleado` (`dni_empleado`);
=======
    ADD KEY `fk-cuentas-empleado` (`dni_empleado`);
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD KEY `fk-cuentas-empleado` (`dni_empleado`);
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD PRIMARY KEY (`dni`),
=======
    ADD PRIMARY KEY (`dni`),
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD PRIMARY KEY (`dni`),
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
  ADD KEY `fk-cargo-empleado` (`cargo`);

--
-- Indices de la tabla `jornada_empleados`
--
ALTER TABLE `jornada_empleados`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD PRIMARY KEY (`dni_empleado`,`fecha_jornada`,`hora_entrada`,`hora_salida`);
=======
    ADD PRIMARY KEY (`dni_empleado`,`fecha_jornada`,`hora_entrada`,`hora_salida`);
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD PRIMARY KEY (`dni_empleado`,`fecha_jornada`,`hora_entrada`,`hora_salida`);
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103

--
-- Indices de la tabla `mercancia`
--
ALTER TABLE `mercancia`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD PRIMARY KEY (`localizador`),
=======
    ADD PRIMARY KEY (`localizador`),
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD PRIMARY KEY (`localizador`),
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
  ADD KEY `fk-tipo-peso-mercancia` (`tipo_peso`),
  ADD KEY `fk-tipo-estado-mercancia` (`tipo_estado`),
  ADD KEY `fk-cliente-mercancia` (`cliente`);

--
-- Indices de la tabla `planificacion_empleados`
--
ALTER TABLE `planificacion_empleados`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD PRIMARY KEY (`fecha`,`empleado`),
=======
    ADD PRIMARY KEY (`fecha`,`empleado`),
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD PRIMARY KEY (`fecha`,`empleado`),
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
  ADD KEY `fk-planificacion-empleado` (`empleado`);

--
-- Indices de la tabla `tipo_cargo`
--
ALTER TABLE `tipo_cargo`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD PRIMARY KEY (`tipo`);
=======
    ADD PRIMARY KEY (`tipo`);
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD PRIMARY KEY (`tipo`);
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103

--
-- Indices de la tabla `tipo_estado`
--
ALTER TABLE `tipo_estado`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD PRIMARY KEY (`tipo`);
=======
    ADD PRIMARY KEY (`tipo`);
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD PRIMARY KEY (`tipo`);
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103

--
-- Indices de la tabla `tipo_peso`
--
ALTER TABLE `tipo_peso`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD PRIMARY KEY (`tipo`);
=======
    ADD PRIMARY KEY (`tipo`);
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD PRIMARY KEY (`tipo`);
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103

--
-- Indices de la tabla `transporte_mercancia`
--
ALTER TABLE `transporte_mercancia`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD PRIMARY KEY (`localizador`,`matricula`),
=======
    ADD PRIMARY KEY (`localizador`,`matricula`),
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD PRIMARY KEY (`localizador`,`matricula`),
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
  ADD KEY `fk-matricula-transporte` (`matricula`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD PRIMARY KEY (`dni`);
=======
    ADD PRIMARY KEY (`dni`);
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD PRIMARY KEY (`dni`);
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD PRIMARY KEY (`matricula`),
=======
    ADD PRIMARY KEY (`matricula`),
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD PRIMARY KEY (`matricula`),
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
  ADD KEY `fk-tipo-peso-vehiculo` (`tipo_peso`);

--
-- Indices de la tabla `vehiculos_empleados`
--
ALTER TABLE `vehiculos_empleados`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD PRIMARY KEY (`empleado`,`vehiculo`),
=======
    ADD PRIMARY KEY (`empleado`,`vehiculo`),
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD PRIMARY KEY (`empleado`,`vehiculo`),
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
  ADD KEY `fk-vehiculo-empleado` (`vehiculo`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuentas_web`
--
ALTER TABLE `cuentas_web`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD CONSTRAINT `fk-cuentas-empleado` FOREIGN KEY (`dni_empleado`) REFERENCES `empleados` (`dni`) ON DELETE RESTRICT ON UPDATE RESTRICT;
=======
    ADD CONSTRAINT `fk-cuentas-empleado` FOREIGN KEY (`dni_empleado`) REFERENCES `empleados` (`dni`) ON DELETE RESTRICT ON UPDATE RESTRICT;
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD CONSTRAINT `fk-cuentas-empleado` FOREIGN KEY (`dni_empleado`) REFERENCES `empleados` (`dni`) ON DELETE RESTRICT ON UPDATE RESTRICT;
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD CONSTRAINT `fk-cargo-empleado` FOREIGN KEY (`cargo`) REFERENCES `tipo_cargo` (`tipo`) ON DELETE RESTRICT ON UPDATE RESTRICT;
=======
    ADD CONSTRAINT `fk-cargo-empleado` FOREIGN KEY (`cargo`) REFERENCES `tipo_cargo` (`tipo`) ON DELETE RESTRICT ON UPDATE RESTRICT;
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD CONSTRAINT `fk-cargo-empleado` FOREIGN KEY (`cargo`) REFERENCES `tipo_cargo` (`tipo`) ON DELETE RESTRICT ON UPDATE RESTRICT;
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103

--
-- Filtros para la tabla `jornada_empleados`
--
ALTER TABLE `jornada_empleados`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD CONSTRAINT `fk-empleado-jornada` FOREIGN KEY (`dni_empleado`) REFERENCES `empleados` (`dni`) ON DELETE RESTRICT ON UPDATE RESTRICT;
=======
    ADD CONSTRAINT `fk-empleado-jornada` FOREIGN KEY (`dni_empleado`) REFERENCES `empleados` (`dni`) ON DELETE RESTRICT ON UPDATE RESTRICT;
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD CONSTRAINT `fk-empleado-jornada` FOREIGN KEY (`dni_empleado`) REFERENCES `empleados` (`dni`) ON DELETE RESTRICT ON UPDATE RESTRICT;
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103

--
-- Filtros para la tabla `mercancia`
--
ALTER TABLE `mercancia`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD CONSTRAINT `fk-cliente-mercancia` FOREIGN KEY (`cliente`) REFERENCES `usuarios` (`dni`) ON DELETE RESTRICT ON UPDATE RESTRICT,
=======
    ADD CONSTRAINT `fk-cliente-mercancia` FOREIGN KEY (`cliente`) REFERENCES `usuarios` (`dni`) ON DELETE RESTRICT ON UPDATE RESTRICT,
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD CONSTRAINT `fk-cliente-mercancia` FOREIGN KEY (`cliente`) REFERENCES `usuarios` (`dni`) ON DELETE RESTRICT ON UPDATE RESTRICT,
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
  ADD CONSTRAINT `fk-tipo-estado-mercancia` FOREIGN KEY (`tipo_estado`) REFERENCES `tipo_estado` (`tipo`),
  ADD CONSTRAINT `fk-tipo-peso-mercancia` FOREIGN KEY (`tipo_peso`) REFERENCES `tipo_peso` (`tipo`);

--
-- Filtros para la tabla `planificacion_empleados`
--
ALTER TABLE `planificacion_empleados`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD CONSTRAINT `fk-planificacion-empleado` FOREIGN KEY (`empleado`) REFERENCES `empleados` (`dni`) ON DELETE RESTRICT ON UPDATE RESTRICT;
=======
    ADD CONSTRAINT `fk-planificacion-empleado` FOREIGN KEY (`empleado`) REFERENCES `empleados` (`dni`) ON DELETE RESTRICT ON UPDATE RESTRICT;
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD CONSTRAINT `fk-planificacion-empleado` FOREIGN KEY (`empleado`) REFERENCES `empleados` (`dni`) ON DELETE RESTRICT ON UPDATE RESTRICT;
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103

--
-- Filtros para la tabla `transporte_mercancia`
--
ALTER TABLE `transporte_mercancia`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD CONSTRAINT `fk-localizador-transporte` FOREIGN KEY (`localizador`) REFERENCES `mercancia` (`localizador`) ON DELETE RESTRICT ON UPDATE RESTRICT,
=======
    ADD CONSTRAINT `fk-localizador-transporte` FOREIGN KEY (`localizador`) REFERENCES `mercancia` (`localizador`) ON DELETE RESTRICT ON UPDATE RESTRICT,
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD CONSTRAINT `fk-localizador-transporte` FOREIGN KEY (`localizador`) REFERENCES `mercancia` (`localizador`) ON DELETE RESTRICT ON UPDATE RESTRICT,
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
  ADD CONSTRAINT `fk-matricula-transporte` FOREIGN KEY (`matricula`) REFERENCES `vehiculos` (`matricula`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD CONSTRAINT `fk-tipo-peso-vehiculo` FOREIGN KEY (`tipo_peso`) REFERENCES `tipo_peso` (`tipo`) ON DELETE RESTRICT ON UPDATE RESTRICT;
=======
    ADD CONSTRAINT `fk-tipo-peso-vehiculo` FOREIGN KEY (`tipo_peso`) REFERENCES `tipo_peso` (`tipo`) ON DELETE RESTRICT ON UPDATE RESTRICT;
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD CONSTRAINT `fk-tipo-peso-vehiculo` FOREIGN KEY (`tipo_peso`) REFERENCES `tipo_peso` (`tipo`) ON DELETE RESTRICT ON UPDATE RESTRICT;
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103

--
-- Filtros para la tabla `vehiculos_empleados`
--
ALTER TABLE `vehiculos_empleados`
<<<<<<< HEAD
<<<<<<< HEAD
  ADD CONSTRAINT `fk-empleado-vehiculo` FOREIGN KEY (`empleado`) REFERENCES `empleados` (`dni`) ON DELETE RESTRICT ON UPDATE RESTRICT,
=======
    ADD CONSTRAINT `fk-empleado-vehiculo` FOREIGN KEY (`empleado`) REFERENCES `empleados` (`dni`) ON DELETE RESTRICT ON UPDATE RESTRICT,
>>>>>>> 59e9d48 (db v2.0)
=======
    ADD CONSTRAINT `fk-empleado-vehiculo` FOREIGN KEY (`empleado`) REFERENCES `empleados` (`dni`) ON DELETE RESTRICT ON UPDATE RESTRICT,
>>>>>>> 59e9d4878a4a59ca751b4667db87d04ada930103
  ADD CONSTRAINT `fk-vehiculo-empleado` FOREIGN KEY (`vehiculo`) REFERENCES `vehiculos` (`matricula`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
