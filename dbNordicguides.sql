-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-03-2022 a las 23:52:18
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nordicguides`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `annualfee`
--

CREATE TABLE `annualfee` (
  `annualfeeID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `date` date NOT NULL,
  `amout` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

CREATE TABLE `cities` (
  `cityID` int(11) NOT NULL,
  `cityname` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cities`
--

INSERT INTO `cities` (`cityID`, `cityname`, `country`) VALUES
(1, 'Tornio', 'Finland'),
(2, 'Kemi', 'Finland'),
(3, 'Happaranda', 'Swedn');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fees`
--

CREATE TABLE `fees` (
  `year` int(11) NOT NULL,
  `basicfee` double NOT NULL,
  `duedate` date NOT NULL,
  `extrafee` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groupcities`
--

CREATE TABLE `groupcities` (
  `groupcityID` int(11) NOT NULL,
  `cityID` int(11) NOT NULL,
  `groupID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `groupcities`
--

INSERT INTO `groupcities` (`groupcityID`, `cityID`, `groupID`) VALUES
(1, 1, 1),
(4, 1, 2),
(2, 2, 1),
(3, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `groupID` int(11) NOT NULL,
  `groupname` varchar(100) NOT NULL,
  `groupdescription` text DEFAULT NULL,
  `contactpersonID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`groupID`, `groupname`, `groupdescription`, `contactpersonID`) VALUES
(1, 'Tornio-Kemi', NULL, 1),
(2, 'Tornio-Happaranda', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `languages`
--

CREATE TABLE `languages` (
  `language` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `languages`
--

INSERT INTO `languages` (`language`) VALUES
('Catalan'),
('Chinese'),
('English'),
('Finnish'),
('Spanish');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membergroups`
--

CREATE TABLE `membergroups` (
  `membergroupID` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `membergroups`
--

INSERT INTO `membergroups` (`membergroupID`, `groupID`, `memberID`) VALUES
(6, 2, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `memberlanguages`
--

CREATE TABLE `memberlanguages` (
  `memberlanguagesID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `language` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `memberlanguages`
--

INSERT INTO `memberlanguages` (`memberlanguagesID`, `memberID`, `language`, `level`) VALUES
(1, 1, 'Spanish', 'B2'),
(2, 1, 'English', 'B2'),
(3, 2, 'Finnish', 'C2'),
(4, 1, 'Catalan', 'Good'),
(5, 1, 'Finnish', 'Basic');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `members`
--

CREATE TABLE `members` (
  `memberID` int(11) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `street` varchar(50) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(120) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'member',
  `driverslicense` varchar(10) DEFAULT NULL,
  `profileimage` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `members`
--

INSERT INTO `members` (`memberID`, `birthdate`, `firstname`, `lastname`, `street`, `city`, `zip`, `phone`, `email`, `password`, `role`, `driverslicense`, `profileimage`) VALUES
(1, NULL, 'Marc', 'Lozano', NULL, NULL, NULL, NULL, 'mark.lozano777@gmail.com', '$2y$10$mZuUz1XAiOJyR1fhyDobeexZ3Lm0eyKVG6oE1vX0U1v1nUvm43pLS', 'admin', NULL, 'WhatsApp Image 2020-04-14 at 16.57.39.jpeg'),
(2, '2020-09-01', 'Yrjo', 'Finn', NULL, NULL, NULL, NULL, 'yrjo@lapinamk.fi', '', 'member', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `annualfee`
--
ALTER TABLE `annualfee`
  ADD PRIMARY KEY (`annualfeeID`),
  ADD KEY `memberID` (`memberID`,`year`),
  ADD KEY `year` (`year`);

--
-- Indices de la tabla `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`cityID`);

--
-- Indices de la tabla `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`year`);

--
-- Indices de la tabla `groupcities`
--
ALTER TABLE `groupcities`
  ADD PRIMARY KEY (`groupcityID`),
  ADD KEY `cityID` (`cityID`,`groupID`),
  ADD KEY `groupID` (`groupID`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupID`),
  ADD KEY `contactpersonID` (`contactpersonID`);

--
-- Indices de la tabla `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`language`);

--
-- Indices de la tabla `membergroups`
--
ALTER TABLE `membergroups`
  ADD PRIMARY KEY (`membergroupID`),
  ADD KEY `groupID` (`groupID`,`memberID`),
  ADD KEY `memberID` (`memberID`);

--
-- Indices de la tabla `memberlanguages`
--
ALTER TABLE `memberlanguages`
  ADD PRIMARY KEY (`memberlanguagesID`),
  ADD KEY `memberID` (`memberID`);

--
-- Indices de la tabla `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memberID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `annualfee`
--
ALTER TABLE `annualfee`
  MODIFY `annualfeeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cities`
--
ALTER TABLE `cities`
  MODIFY `cityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `groupcities`
--
ALTER TABLE `groupcities`
  MODIFY `groupcityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `groupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `membergroups`
--
ALTER TABLE `membergroups`
  MODIFY `membergroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `memberlanguages`
--
ALTER TABLE `memberlanguages`
  MODIFY `memberlanguagesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `members`
--
ALTER TABLE `members`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `annualfee`
--
ALTER TABLE `annualfee`
  ADD CONSTRAINT `annualfee_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `members` (`memberID`),
  ADD CONSTRAINT `annualfee_ibfk_2` FOREIGN KEY (`year`) REFERENCES `fees` (`year`);

--
-- Filtros para la tabla `groupcities`
--
ALTER TABLE `groupcities`
  ADD CONSTRAINT `groupcities_ibfk_1` FOREIGN KEY (`cityID`) REFERENCES `cities` (`cityID`),
  ADD CONSTRAINT `groupcities_ibfk_2` FOREIGN KEY (`groupID`) REFERENCES `groups` (`groupID`);

--
-- Filtros para la tabla `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`contactpersonID`) REFERENCES `members` (`memberID`);

--
-- Filtros para la tabla `membergroups`
--
ALTER TABLE `membergroups`
  ADD CONSTRAINT `membergroups_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `members` (`memberID`),
  ADD CONSTRAINT `membergroups_ibfk_2` FOREIGN KEY (`groupID`) REFERENCES `groups` (`groupID`);

--
-- Filtros para la tabla `memberlanguages`
--
ALTER TABLE `memberlanguages`
  ADD CONSTRAINT `memberlanguages_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `members` (`memberID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
