-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-01-2025 a las 16:24:08
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `canciones`
--
CREATE DATABASE IF NOT EXISTS `canciones` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `canciones`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canciones`
--

CREATE TABLE `canciones` (
  `ID` int(11) NOT NULL,
  `autor` varchar(250) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `canciones`
--

INSERT INTO `canciones` (`ID`, `autor`, `titulo`, `fecha`) VALUES
(1, 'The Beatles', 'Hey Jude', '2025-05-06'),
(2, 'Led Zeppelin', 'Stairway to Heaven', '2025-01-15'),
(3, 'Queen', 'Bohemian Rhapsody', '2024-02-01'),
(4, 'Pink Floyd', 'Comfortably Numb', '2024-06-08'),
(5, 'The Rolling Stones', 'Paint It Black', '2024-06-07'),
(6, 'The Who', 'Baba O\'Riley', '2024-06-07'),
(7, 'Jimi Hendrix', 'Purple Haze', '2024-06-05'),
(8, 'The Doors', 'Light My Fire', '2024-06-05'),
(9, 'Nirvana', 'Smells Like Teen Spirit', '2024-06-04'),
(10, 'Metallica', 'Enter Sandman', '2024-06-05'),
(11, 'AC/DC', 'Back In Black', '2024-06-08'),
(12, 'Guns N\' Roses', 'Sweet Child O Mine', '2024-06-07'),
(13, 'Eagles', 'Hotel California', '2024-06-07'),
(14, 'Bob Dylan', 'Like a Rolling Stone', '2024-06-07'),
(15, 'Fleetwood Mac', 'Go Your Own Way', '2024-06-09'),
(16, 'David Bowie', 'Space Oddity', '2024-06-11'),
(17, 'The Clash', 'London Calling', '2024-06-09'),
(18, 'U2', 'With or Without You', '2024-06-08'),
(19, 'Bruce Springsteen', 'Born to Run', '2024-06-07'),
(20, 'The Police', 'Every Breath You Take', '2024-06-07'),
(61, 'Radiohead', 'Creep', '2024-05-23'),
(62, 'Oasis', 'Wonderwall', '2024-05-23'),
(63, 'Coldplay', 'Yellow', '2024-05-23'),
(64, 'Foo Fighters', 'Everlong', '2024-05-23'),
(65, 'Arctic Monkeys', 'Do I Wanna Know?', '2024-05-23'),
(66, 'Green Day', 'Boulevard of Broken Dreams', '2024-05-23'),
(67, 'Red Hot Chili Peppers', 'Californication', '2024-05-23'),
(68, 'Linkin Park', 'In the End', '2024-05-23'),
(69, 'Imagine Dragons', 'Radioactive', '2024-05-23'),
(70, 'The Killers', 'Mr. Brightside', '2024-05-23'),
(71, 'Muse', 'Supermassive Black Hole', '2024-05-23'),
(72, 'Kings of Leon', 'Use Somebody', '2024-05-23'),
(73, 'Blur', 'Song 2', '2024-05-23'),
(74, 'Pearl Jam', 'Alive', '2024-05-23'),
(75, 'Smashing Pumpkins', '1979', '2024-05-23'),
(76, 'My Chemical Romance', 'Welcome to the Black Parade', '2024-05-23'),
(77, 'The Strokes', 'Last Nite', '2024-05-23'),
(78, 'Franz Ferdinand', 'Take Me Out', '2024-05-23'),
(79, 'The White Stripes', 'Seven Nation Army', '2024-05-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `email` varchar(255) NOT NULL,
  `contrasenia_hash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`email`, `contrasenia_hash`) VALUES
('usuario1@email.com', '$2y$10$vVOW65YMRiS.fXCRh7fqjuMSD3hL5xpjDuMwGBKzbsfvQc14g4RQK'),
('usuario2@email.com', '$2y$10$m4RWNL2jCp/vxo7pZo4GluBm0mly/kguIdLnBePiKr104lIt33/re'),
('usuario3@email.com', '$2y$10$2MqdGdNqh4kBcQ94ZjIQHOhtt2vuGeUXZgzOX.RcWuL4K5gZl0aBC'),
('usuario4@email.com', '$2y$10$/Y7wN2occURNn07q9gnb3OpeC2ArJXw.DfH./C/HzwSkxnXhpcpOC'),
('usuario5@email.com', '$2y$10$qqIZ4jUMSzw3fbDNVFOiGulpU7UYS.aPGSV3CSzVtAE82veMwOTjm');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `canciones`
--
ALTER TABLE `canciones`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `canciones`
--
ALTER TABLE `canciones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
