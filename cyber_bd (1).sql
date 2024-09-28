-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-09-2024 a las 05:11:47
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cyber_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `computadoras`
--

CREATE TABLE `computadoras` (
  `id` int(11) NOT NULL,
  `estado` enum('sin usar','en uso') NOT NULL DEFAULT 'sin usar',
  `inicio` datetime DEFAULT NULL,
  `contador` time DEFAULT NULL,
  `dto` varchar(50) DEFAULT NULL,
  `parar_a` time DEFAULT NULL,
  `extras` varchar(100) DEFAULT NULL,
  `nota` text DEFAULT NULL,
  `mensaje` varchar(255) DEFAULT NULL,
  `cd` tinyint(1) DEFAULT 0,
  `pri` int(11) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `computadoras`
--

INSERT INTO `computadoras` (`id`, `estado`, `inicio`, `contador`, `dto`, `parar_a`, `extras`, `nota`, `mensaje`, `cd`, `pri`, `nombre`) VALUES
(61, 'sin usar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'PROYECTO'),
(62, 'sin usar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'WEB'),
(63, 'sin usar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'ANTONIO'),
(65, 'sin usar', NULL, NULL, NULL, '00:00:01', NULL, '', NULL, 0, NULL, 'KIKE');

-- --------------------------------------------------------






CREATE TABLE `notificaciones_personalizadas` (
  `id` int(11) NOT NULL,
  `computadora_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `sonido` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `activa` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
-- Estructura de tabla para la tabla `timers`
--

CREATE TABLE `timers` (
  `id` int(11) NOT NULL,
  `workspace_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'stopped',
  `elapsed_time` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `timers`
--

INSERT INTO `timers` (`id`, `workspace_id`, `type`, `start_time`, `end_time`, `status`, `elapsed_time`, `created_at`, `updated_at`) VALUES
(43, 20, 'default', '2024-09-14 12:18:33', '2024-09-14 12:18:48', 'stopped', 15, '2024-09-14 04:18:33', '2024-09-14 04:18:48'),
(44, 21, 'default', '2024-09-14 12:19:40', '2024-09-14 12:19:54', 'stopped', 14, '2024-09-14 04:19:40', '2024-09-14 04:19:54'),
(45, 20, 'default', '2024-09-14 12:23:35', '2024-09-14 12:23:58', 'stopped', 23, '2024-09-14 04:23:35', '2024-09-14 04:23:58'),
(46, 20, 'default', '2024-09-14 17:29:01', '2024-09-14 17:29:55', 'stopped', 54, '2024-09-14 09:29:01', '2024-09-14 09:29:55'),
(47, 23, 'default', '2024-09-14 17:37:11', NULL, 'running', 0, '2024-09-14 09:37:11', '2024-09-14 09:37:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'antonio', 'e67c10a4c8fbfc0c400e047bb9a056a1', '2024-09-17 13:59:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `workspaces`
--

CREATE TABLE `workspaces` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `workspaces`
--

INSERT INTO `workspaces` (`id`, `name`, `description`, `color`, `image`, `created_at`, `updated_at`) VALUES
(20, 'espacio 1 ', 'df', '#000000', 'default.png', '2024-09-14 06:59:51', '2024-09-14 06:59:51'),
(21, 'espacio 1 ', 'zxzx', '#ca7272', 'default.png', '2024-09-14 08:54:42', '2024-09-14 08:54:42'),
(22, 'espacio 1 ', 'dfdsfdf', '#44d1ee', 'default.png', '2024-09-14 15:30:33', '2024-09-14 15:30:33'),
(23, 'espacio a', 'sdsdsd', '#ea1010', 'default.png', '2024-09-14 15:36:10', '2024-09-14 15:36:10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `computadoras`
--
ALTER TABLE `computadoras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `timers`
--
ALTER TABLE `timers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workspace_id` (`workspace_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `workspaces`
--
ALTER TABLE `workspaces`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `computadoras`
--
ALTER TABLE `computadoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `timers`
--
ALTER TABLE `timers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `workspaces`
--
ALTER TABLE `workspaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `timers`
--
ALTER TABLE `timers`
  ADD CONSTRAINT `timers_ibfk_1` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
