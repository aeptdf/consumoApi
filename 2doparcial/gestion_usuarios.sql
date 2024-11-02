-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2024 a las 02:28:25
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_usuarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `nombre_estado`) VALUES
(1, 'noVerificado'),
(2, 'verificado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `estado_validacion` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_modificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `nombre`, `email`, `password`, `estado_validacion`, `token`, `fecha_creacion`, `fecha_modificacion`) VALUES
(31, 'Ariel', 'arielplante02@gmail.com', '$2y$10$OcasTtSZR9tXTUfzUA.xhu1EnmUvEm9SZz00fWaX4hsnzlnN0Ozv.', 2, '0c0f92bd0eac9eb48c7d36caf2114fdee9bff98dac66398dbda62cac830fbec937dd459e5f288eb12632d97254215669d69e', '2024-11-01 20:52:11', '2024-11-01 22:07:34'),
(33, 'cosocoso', 'felef63048@ruhtan.com', '$2y$10$1ZYJkjcXE4YOAJMo.C3gDuSgxdILxk0NiViNnetZSlW35.85LW5eG', 2, 'aa0a135278c85bca9c0eb34e95513ffa0aee1e2291eaf8a38194fe0e513ce40f9e1e2d5f14cc2ab334eff7fcf0990bfe0502', '2024-11-01 23:46:59', '2024-11-01 20:47:58'),
(36, 'Juan', 'arieltdf11@gmail.com', '$2y$10$tuoSDEjjUOh.BbB3gmnnVet4gfShfOiwZqxJqzN2UJHtyywQqINe2', 2, '3fe5c0c66c1069c13813131c89a4d586bac6d27d0ff181eea620c1c74626176dcb66e78b625db47a45cdf9f6b443c139cd25', '2024-11-02 00:32:24', '2024-11-01 21:34:15'),
(37, 'Isma', 'ismchaves03@gmail.com', '$2y$10$DdBuOVR8XOHXIoRlIJhf4.zmGtuG.Jb0X6ZU4y31V.cgXTBfa6gxm', 1, 'f319aacfcfb0cb67d7571d9fcdb765e9b8c77b64f0e4c98f4f3cc0b32338108351a4f8fcd7bbf93e423d7175bcce98da7a88', '2024-11-02 01:00:38', NULL),
(38, 'anana', 'adan_cerdatafoya346@curyx.org', '$2y$10$t4R07MAr9j6RiQY98PhJZ.pAw0iXCl0p7buFZhlKM0sGdvKguLzUm', 2, '19f40d3fad671ab51aa30d83d2bb94350beb5d4faf857781a4b62bcd3fe810da3601a611376536142bb017a684d1ddbb9c76', '2024-11-02 01:03:13', '2024-11-01 22:05:33'),
(39, 'nikkk', 'niknebarta@gufum.com', '$2y$10$GdQb.1CvQAXwDbBlbEqzU.kN1futkrJwHLwX9mMswUHpR02PIOrWa', 2, '3c220c769525cbc47d18db2a7aab533fd8f48f45ce5382c3f447a11883940639c2c0c4991a29d002ba09bd5fefa9925c0426', '2024-11-02 01:13:28', '2024-11-01 22:14:59');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`),
  ADD KEY `estado` (`id_estado`) USING BTREE;

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `estado_validacion` (`estado_validacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`estado_validacion`) REFERENCES `estados` (`id_estado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
