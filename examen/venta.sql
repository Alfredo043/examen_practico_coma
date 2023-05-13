-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2023 a las 09:13:46
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `venta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` decimal(18,0) NOT NULL,
  `id_usuario` decimal(18,0) NOT NULL,
  `folio` varchar(4) NOT NULL,
  `saldo` int(4) NOT NULL,
  `fecha_facturacion` date NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `id_usuario`, `folio`, `saldo`, `fecha_facturacion`, `fecha_creacion`) VALUES
('1', '1', '001', 300, '2023-05-13', '2023-05-13'),
('2', '2', '002', 400, '2023-05-13', '2023-05-13'),
('3', '3', '003', 500, '2023-05-13', '2023-05-13'),
('4', '4', '004', 600, '2023-05-13', '2023-05-13'),
('5', '5', '005', 700, '2023-05-13', '2023-05-13'),
('6', '6', '006', 800, '2023-05-13', '2023-05-13'),
('7', '7', '007', 900, '2023-05-13', '2023-05-13'),
('8', '8', '008', 1000, '2023-05-13', '2023-05-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` decimal(18,0) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `edad` int(3) NOT NULL,
  `correo_electronico` varchar(100) NOT NULL,
  `tipo_usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `edad`, `correo_electronico`, `tipo_usuario`) VALUES
('1', 'John', 'Doe', 30, 'johndoe@gmail.com', 'cliente'),
('2', 'Peter', 'Parker', 30, 'peterparker@gmail.com', 'gerente'),
('3', 'Fran', 'Wilson', 35, 'franwilson@gmail.com', 'administrador'),
('4', 'Jamie', 'Foxx', 50, 'jamiefoxx@gmail.com', 'cliente'),
('5', 'Michael', 'Keaton', 60, 'michaelkeaton@gmail.com', 'gerente'),
('6', 'Cristina', 'Iglesias', 35, 'cristinaiglesias@gmail.com', 'administrador'),
('7', 'Frida', ' Kahlo', 40, 'fridakahlo@gmail.com', 'cliente'),
('8', 'Alicia', 'Parra', 35, 'aliciaparra@gmail.com', 'gerente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
