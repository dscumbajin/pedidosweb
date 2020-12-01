-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-07-2019 a las 08:32:50
-- Versión del servidor: 10.3.15-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pedidosweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `codigoCliente` varchar(30) NOT NULL COMMENT 'codcli',
  `nombreCliente` varchar(200) NOT NULL DEFAULT '' COMMENT 'nombrecli',
  `codigoLisPre` int(11) NOT NULL COMMENT 'codlp',
  `codigoPromo1` int(11) NOT NULL DEFAULT 1016371 COMMENT 'flagpromdircli',
  `codigoPromo2` int(11) NOT NULL DEFAULT 1016371 COMMENT 'flagpromocli',
  `codigoPromo3` int(11) NOT NULL DEFAULT 1016371 COMMENT 'flagpromocasillacli',
  `permitirPromocion` binary(1) NOT NULL DEFAULT '1' COMMENT 'flagpromocli',
  `descuentoCliente` decimal(6,2) NOT NULL DEFAULT 0.00 COMMENT 'descuecli',
  `mailCliente` varchar(100) NOT NULL DEFAULT '' COMMENT 'mailcli',
  `estadoCliente` binary(1) NOT NULL DEFAULT '1' COMMENT 'statuscli',
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`codigoCliente`, `nombreCliente`, `codigoLisPre`, `codigoPromo1`, `codigoPromo2`, `codigoPromo3`, `permitirPromocion`, `descuentoCliente`, `mailCliente`, `estadoCliente`, `password`) VALUES
('0102170396001', 'CANTOS VERA DAVID EDUARDO 123456', 4, 894354, 1016371, 941604, 0x31, '48.00', 'proneumatico@hotmail.com', 0x31, '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO'),
('0102403474001', 'VANEGAS YANZA KLEBER FERNANDO', 4, 1016371, 442809, 1016371, 0x31, '56.00', 'importadora@subateria.net', 0x31, '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO'),
('0102403474002', 'VANEGAS YANZA KLEBER FERNANDO (LOJA)', 4, 1016371, 442809, 1016371, 0x31, '56.00', 'importadora@subateria.net', 0x31, '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO'),
('0123456789123', 'Administrador', 0, 442809, 894354, 1016371, 0x01, '10.00', 'jorgefprietol@gmail.com', 0x01, '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO'),
('0701592321001', 'ING BLANCA OCHOA', 4, 1016371, 1016371, 1016371, 0x30, '0.00', 'eufemiaochoa@hotmail.com', 0x31, '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO'),
('0704012798001', 'ROMERO OCHOA JIMMY BYRON', 4, 894354, 1016371, 941604, 0x31, '45.00', 'romerobyron@hotmail.com', 0x31, '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO'),
('0909811978001', 'LUBRICADORA REGALO DE DIOS', 1, 1016371, 1016371, 1016371, 0x30, '0.00', 'gustavovillamar94@hotmail.com', 0x31, '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO'),
('0916561012001', 'MORAN NOBLECILLA CESAR ANTONIO', 1, 894354, 1016371, 1016371, 0x31, '50.00', 'cesar.moran.n@gmail.com', 0x31, '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO'),
('0992215437001', 'FILVERCOR S.A.', 4, 894354, 1016371, 1016371, 0x31, '50.00', 'info@filvercor.com', 0x31, '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO'),
('0992777494001', 'DISJEVISA S.A.', 4, 894354, 1016371, 941604, 0x31, '45.00', 'disjevisa2012@gmail.com', 0x31, '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO'),
('1001303260', 'AZUCENA CHAVEZ', 1, 1016371, 442809, 1016371, 0x31, '10.00', 'nd@hotmail.com', 0x31, '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO'),
('1700685447001', 'DISTRIBUIDORA M.LL.', 4, 894354, 1016371, 941604, 0x31, '48.00', 'jmmunoz@hotmail.es', 0x31, '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO'),
('1701166140002', 'BROWN VILLA VICTOR HUGO (QUITO)', 4, 1016371, 1016371, 1016371, 0x30, '0.00', 'vhbrownvilla@hotmail.com', 0x30, '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO'),
('1709212946001', 'POZO COQUE MILTON', 2, 1016371, 1016371, 1016371, 0x30, '25.00', 'milton_pozo@hotmail.com', 0x30, '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO'),
('1715976534001', 'ENERGISUR', 4, 894354, 1016371, 941604, 0x31, '48.00', 'ximemorales11@hotmail.com', 0x31, '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO'),
('1792115418001', 'IMPORTACIONES FULLENERGY S.A.', 7, 894354, 941604, 1016371, 0x31, '53.00', 'fullenergyec@gmail.com', 0x31, '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentoclientelinea`
--

CREATE TABLE `descuentoclientelinea` (
  `codigoDesCL` int(11) NOT NULL DEFAULT 0 COMMENT 'coddesdescliln',
  `codigoCliente` varchar(30) NOT NULL DEFAULT '' COMMENT 'codcli',
  `codigoLinea` int(11) NOT NULL COMMENT 'codln',
  `porcentajeDesCL` double(5,2) NOT NULL DEFAULT 0.00 COMMENT 'porcdesdescliln'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `descuentoclientelinea`
--

INSERT INTO `descuentoclientelinea` (`codigoDesCL`, `codigoCliente`, `codigoLinea`, `porcentajeDesCL`) VALUES
(2, '1001303260', 14, 7.00),
(70, '0992215437001', 308, 50.00),
(73, '0102403474001', 315, 40.00),
(74, '0102403474002', 315, 40.00),
(81, '0102170396001', 37, 42.00),
(82, '0102170396001', 308, 42.00),
(83, '1792115418001', 308, 38.00),
(89, '1792115418001', 315, 47.00),
(98, '0102403474001', 213, 55.00),
(100, '0102403474002', 213, 55.00),
(105, '1001303260', 33, 15.00),
(113, '0916561012001', 213, 53.00),
(114, '0102403474001', 301, 40.00),
(115, '1700685447001', 315, 40.00),
(120, '0102403474001', 308, 49.00),
(152, '0102170396001', 315, 40.00),
(169, '1001303260', 4, 11.00),
(170, '1001303260', 76, 20.00),
(196, '1715976534001', 213, 50.00),
(236, '1792115418001', 213, 58.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentoclienteproducto`
--

CREATE TABLE `descuentoclienteproducto` (
  `codigoDesCP` int(11) NOT NULL DEFAULT 0 COMMENT 'coddescli',
  `codigoCliente` varchar(30) DEFAULT '' COMMENT 'codcli',
  `idProducto` int(11) DEFAULT NULL COMMENT 'porcdesdescli',
  `precioVenta` decimal(10,2) DEFAULT 0.00 COMMENT 'pvfinaldescli',
  `porcentajeDes` decimal(5,2) DEFAULT 0.00 COMMENT 'porcdesdescli'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `descuentoclienteproducto`
--

INSERT INTO `descuentoclienteproducto` (`codigoDesCP`, `codigoCliente`, `idProducto`, `precioVenta`, `porcentajeDes`) VALUES
(39, '1001303260', 10158, '110.00', '39.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentolistaprecios`
--

CREATE TABLE `descuentolistaprecios` (
  `codigoDesLP` int(11) NOT NULL DEFAULT 0 COMMENT 'coddlp',
  `idProducto` int(11) DEFAULT NULL COMMENT 'codpro',
  `codigoLisPre` int(5) DEFAULT NULL COMMENT 'codlp',
  `porcentajeDesLP` decimal(5,2) DEFAULT 0.00 COMMENT 'porcdescuelp',
  `precioLP` decimal(10,2) DEFAULT 0.00 COMMENT 'pvlp',
  `estadoLP` binary(1) DEFAULT '1' COMMENT 'statusdlp'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `descuentolistaprecios`
--

INSERT INTO `descuentolistaprecios` (`codigoDesLP`, `idProducto`, `codigoLisPre`, `porcentajeDesLP`, `precioLP`, `estadoLP`) VALUES
(56, 1056, 3, '40.00', '0.48', 0x31),
(118, 1094, 4, '27.78', '130.00', 0x31),
(141, 1043, 4, '20.00', '8.00', 0x31),
(155, 1115, 4, '35.00', '3.25', 0x31),
(188, 1117, 4, '0.00', '1.90', 0x31),
(1277, 1060, 4, '16.67', '100.00', 0x31),
(1411, 1132, 4, '22.37', '6.94', 0x31),
(1412, 1125, 4, '23.05', '16.16', 0x31),
(1414, 1127, 4, '23.07', '22.47', 0x31),
(1415, 1130, 4, '0.00', '20.61', 0x31),
(1416, 1131, 4, '0.00', '20.61', 0x31),
(1417, 1122, 4, '0.00', '26.55', 0x31),
(1418, 1123, 4, '0.00', '26.46', 0x31),
(1419, 1124, 4, '23.08', '30.49', 0x31),
(1420, 1135, 4, '0.00', '12.88', 0x31),
(1421, 1136, 4, '0.00', '12.88', 0x31),
(1422, 1137, 4, '0.00', '13.55', 0x31),
(1423, 1139, 4, '23.09', '13.26', 0x31),
(1424, 1141, 4, '23.08', '17.50', 0x31),
(1426, 1143, 4, '0.00', '22.00', 0x31),
(1501, 1059, 15, '0.00', '2.20', 0x31),
(1507, 1058, 15, '0.00', '0.50', 0x31),
(1508, 1056, 15, '0.00', '0.80', 0x31),
(1511, 1108, 15, '0.00', '0.89', 0x31),
(1515, 1117, 15, '0.00', '3.00', 0x31),
(1516, 1118, 15, '0.00', '3.00', 0x31),
(1519, 1094, 15, '0.00', '180.00', 0x31),
(1522, 1043, 15, '0.00', '10.00', 0x31),
(1529, 1115, 15, '0.00', '5.00', 0x31),
(1532, 1060, 15, '0.00', '120.00', 0x31),
(1538, 1134, 4, '23.09', '8.76', 0x31),
(1539, 1128, 4, '0.00', '21.31', 0x31),
(1545, 1059, 2, '0.00', '2.20', 0x31),
(1551, 1058, 2, '0.00', '0.50', 0x31),
(1552, 1056, 2, '0.00', '0.80', 0x31),
(1555, 1108, 2, '0.00', '0.89', 0x31),
(1559, 1117, 2, '0.00', '3.00', 0x31),
(1560, 1118, 2, '0.00', '3.00', 0x31),
(1563, 1094, 2, '0.00', '180.00', 0x31),
(1566, 1043, 2, '0.00', '10.00', 0x31),
(1567, 1108, 4, '41.57', '0.52', 0x31),
(1570, 1059, 4, '41.36', '1.29', 0x31),
(1572, 1056, 4, '31.25', '0.55', 0x31),
(1574, 1058, 4, '34.00', '0.33', 0x31),
(1576, 1115, 2, '0.00', '5.00', 0x31),
(1580, 1129, 4, '0.00', '22.01', 0x31),
(1581, 1138, 4, '0.00', '19.06', 0x31),
(1582, 1144, 4, '0.00', '24.39', 0x31),
(1583, 1116, 2, '0.00', '5.00', 0x31),
(1585, 1116, 15, '0.00', '5.00', 0x31),
(1586, 1116, 4, '35.00', '3.25', 0x31),
(1591, 1094, 7, '27.78', '130.00', 0x31),
(1604, 1043, 7, '30.00', '7.00', 0x31),
(1607, 1115, 7, '35.00', '3.25', 0x31),
(1609, 1118, 7, '0.00', '3.00', 0x31),
(1611, 1060, 7, '0.00', '120.00', 0x31),
(1615, 1132, 7, '36.80', '5.65', 0x31),
(1616, 1125, 7, '37.62', '13.10', 0x31),
(1618, 1127, 7, '37.83', '18.16', 0x31),
(1619, 1130, 7, '26.65', '19.65', 0x31),
(1620, 1131, 7, '35.01', '17.41', 0x31),
(1621, 1122, 7, '32.73', '19.65', 0x31),
(1622, 1123, 7, '0.00', '34.39', 0x31),
(1623, 1124, 7, '50.43', '19.65', 0x31),
(1624, 1135, 7, '0.00', '16.75', 0x31),
(1625, 1136, 7, '47.58', '8.78', 0x31),
(1626, 1137, 7, '0.00', '17.62', 0x31),
(1627, 1139, 7, '23.09', '13.26', 0x31),
(1628, 1141, 7, '31.30', '15.63', 0x31),
(1629, 1142, 7, '38.43', '17.51', 0x31),
(1630, 1143, 7, '31.33', '19.64', 0x31),
(1631, 1134, 7, '31.26', '7.83', 0x31),
(1632, 1128, 7, '37.80', '17.23', 0x31),
(1634, 1108, 7, '0.00', '0.89', 0x31),
(1637, 1059, 7, '0.00', '2.20', 0x31),
(1639, 1056, 7, '0.00', '0.80', 0x31),
(1641, 1058, 7, '0.00', '0.50', 0x31),
(1643, 1129, 7, '31.32', '19.65', 0x31),
(1644, 1138, 7, '35.11', '16.08', 0x31),
(1645, 1144, 7, '12.59', '27.71', 0x31),
(1646, 1116, 7, '35.00', '3.25', 0x31),
(1649, 1142, 4, '23.07', '21.88', 0x31),
(1716, 1108, 8, '30.34', '0.62', 0x31),
(1719, 1059, 8, '42.27', '1.27', 0x31),
(1721, 1056, 8, '40.00', '0.48', 0x31),
(1731, 1063, 4, '0.00', '300.00', 0x31),
(1742, 1126, 7, '37.83', '18.16', 0x31),
(1743, 1126, 4, '23.07', '22.47', 0x31),
(1751, 1140, 7, '0.00', '11.84', 0x31),
(1752, 1094, 1, '19.44', '145.00', 0x31),
(1765, 1043, 1, '16.67', '10.00', 0x31),
(1768, 1115, 1, '30.00', '3.50', 0x31),
(1772, 1060, 1, '16.67', '100.00', 0x31),
(1776, 1132, 1, '22.37', '6.94', 0x31),
(1777, 1125, 1, '23.05', '16.16', 0x31),
(1778, 1127, 1, '23.07', '22.47', 0x31),
(1779, 1130, 1, '0.00', '26.79', 0x31),
(1780, 1131, 1, '0.00', '26.79', 0x31),
(1781, 1122, 1, '0.00', '29.21', 0x31),
(1782, 1123, 1, '0.00', '34.39', 0x31),
(1783, 1124, 1, '23.08', '30.49', 0x31),
(1784, 1135, 1, '0.00', '16.75', 0x31),
(1785, 1136, 1, '23.10', '12.88', 0x31),
(1786, 1137, 1, '0.00', '17.62', 0x31),
(1787, 1139, 1, '23.09', '13.26', 0x31),
(1788, 1141, 1, '23.08', '17.50', 0x31),
(1789, 1143, 1, '0.00', '28.60', 0x31),
(1790, 1134, 1, '23.09', '8.76', 0x31),
(1791, 1128, 1, '0.00', '27.70', 0x31),
(1793, 1108, 1, '28.09', '0.64', 0x31),
(1796, 1059, 1, '31.82', '1.50', 0x31),
(1798, 1056, 1, '18.75', '0.65', 0x31),
(1800, 1058, 1, '10.00', '0.45', 0x31),
(1802, 1129, 1, '0.00', '28.61', 0x31),
(1803, 1138, 1, '23.08', '19.06', 0x31),
(1804, 1144, 1, '0.00', '31.70', 0x31),
(1805, 1116, 1, '30.00', '3.50', 0x31),
(1806, 1142, 1, '23.07', '31.16', 0x31),
(1808, 1063, 1, '0.00', '380.00', 0x31),
(1809, 1126, 1, '23.07', '22.47', 0x31),
(1810, 1117, 1, '31.67', '2.05', 0x31),
(1811, 1117, 7, '31.67', '2.05', 0x31),
(1812, 1118, 1, '36.67', '1.90', 0x31),
(1813, 1118, 4, '41.67', '1.75', 0x31),
(1817, 1117, 8, '47.00', '1.59', 0x31),
(1818, 1118, 8, '47.00', '1.59', 0x31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `numero_pedido` int(11) DEFAULT 0,
  `codigo_producto` varchar(80) DEFAULT '',
  `detalle_producto` varchar(150) DEFAULT '',
  `cantidad` int(5) DEFAULT 0,
  `precio_unitario` double(15,2) DEFAULT 0.00,
  `descuento_unitario` double(5,2) DEFAULT 0.00,
  `porcentaje_iva` int(11) DEFAULT 0,
  `promocion` int(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`numero_pedido`, `codigo_producto`, `detalle_producto`, `cantidad`, `precio_unitario`, `descuento_unitario`, `porcentaje_iva`, `promocion`) VALUES
(1, '1791', '', 1, 91.00, 0.00, 0, 0),
(1, '1850', '', 15, 107.00, 0.00, 0, 0),
(2, '1787', '', 1, 94.00, 0.00, 0, 0),
(3, '1787', '', 2, 94.00, 0.00, 0, 0),
(3, '1795', '', 28, 77.00, 0.00, 0, 0),
(4, '1043', '', 100, 7.00, 0.00, 0, 0),
(4, '1787', '', 27, 94.00, 0.00, 0, 0),
(4, '1790', '', 4, 91.00, 0.00, 0, 0),
(4, '8810', '', 1, 35.00, 0.00, 0, 0),
(4, '8811', '', 1, 35.00, 0.00, 0, 0),
(4, '8812', '', 1, 35.00, 0.00, 0, 0),
(5, '1043', '', 1, 7.00, 0.00, 0, 0),
(5, '1790', '', 1, 91.00, 0.00, 0, 0),
(5, '2184', '', 1, 12.86, 0.00, 0, 0),
(5, '10158', '', 13, 117.00, 0.00, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadopedido`
--

CREATE TABLE `estadopedido` (
  `codigoestped` varchar(2) DEFAULT NULL,
  `descripcion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estadopedido`
--

INSERT INTO `estadopedido` (`codigoestped`, `descripcion`) VALUES
('01', 'CREADO'),
('02', 'DEVUELTO'),
('03', 'CANCELADO'),
('04', 'APROBADO'),
('05', 'PENDIENTE'),
('06', 'ENVIADO'),
('07', 'ENVIADO S.C.'),
('08', 'REPROBADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listalinea`
--

CREATE TABLE `listalinea` (
  `codigoLinea` int(11) NOT NULL DEFAULT 0 COMMENT 'codln',
  `nombreLinea` varchar(50) DEFAULT '' COMMENT 'nomln',
  `estadoLinea` binary(1) DEFAULT '1' COMMENT 'staln'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `listalinea`
--

INSERT INTO `listalinea` (`codigoLinea`, `nombreLinea`, `estadoLinea`) VALUES
(1, 'BATERIAS', 0x31),
(2, 'SETS Y ACCESORIOS', 0x31),
(3, 'NOTAS DE DEBITO', 0x30),
(4, 'ACCESORIOS', 0x31),
(5, 'RECICLADOS', 0x31),
(6, 'MERCADEO', 0x31),
(7, 'NO FACTURABLES', 0x30),
(10, 'MATERIALES', 0x31),
(11, 'MANO DE OBRA', 0x31),
(12, 'INVENTARIO', 0x31),
(13, 'OTROS FINANCIEROS', 0x31),
(14, 'BATERIAS BOSCH', 0x31),
(15, 'BATERIAS MAC', 0x31),
(16, 'BATERIAS EXIWILL', 0x31),
(17, 'BATERIAS JCI TERM', 0x31),
(18, 'BATERIAS JCI SECAS', 0x31),
(19, 'BATERIAS ECUADOR JCI', 0x31),
(21, 'MAQUINARIA', 0x31),
(29, 'MATERIA PRIMA.', 0x31),
(30, 'ACTIVO', 0x31),
(31, 'INVENTARIO DE OPERACION', 0x31),
(32, 'BATERIAS SECAS', 0x31),
(33, 'BATERIAS PF', 0x31),
(34, 'MATERIALES PRODUCIDOS', 0x31),
(35, 'MP PRODUCIDA', 0x31),
(36, 'AGUA DESMINERALIZADA', 0x31),
(37, 'BATERIAS DE MOTO', 0x31),
(39, 'BATERIAS CHATARRA', 0x31),
(43, 'MATERIA PRIMA RECICLADOS', 0x31),
(44, 'SCRAP', 0x31),
(45, 'CARGADORES', 0x31),
(46, 'ANTISULFATANTES', 0x31),
(47, 'NOTAS DE CREDITO (GENERAL)', 0x30),
(48, 'ELECTROLITO', 0x31),
(49, 'REFINACION PLOMO 3%', 0x31),
(50, 'REFINACION PLOMO PURO', 0x31),
(51, 'OXIDACION', 0x31),
(52, 'REJILLAS', 0x31),
(53, 'PLACAS', 0x31),
(54, 'ENSAMBLAJE', 0x30),
(55, 'CARGA Y ACABADO', 0x30),
(56, 'SUMINISTROS', 0x31),
(58, 'REFINACION PLOMO REJILLAS 1.9%', 0x31),
(59, 'REFINACION PLOMO CALCIO', 0x31),
(60, 'RECICLAJE PLOMO CRUDO', 0x31),
(61, 'RECICLAJE REF.  PLOMO ANTIMONIO', 0x31),
(62, 'RECICLAJE REF.  PLOMO COBRE', 0x31),
(63, 'RECICLAJE REF.  PLOMO ESTANIO', 0x31),
(64, 'CENIZA', 0x31),
(65, 'CENIZA CALCIO', 0x31),
(70, 'REFINACION PREALEACION  ANTIMONIO', 0x31),
(76, 'ARTICULOS PROMOCIONALES', 0x31),
(77, 'REFINACION PLOMO CICLO PROFUNDO POSITIVO', 0x31),
(78, 'REFINACION PLOMO CICLO PROFUNDO NEGATIVO', 0x31),
(79, 'GASTOS', 0x31),
(80, 'BATERIAS JCI MERCADERIAS GOLD', 0x31),
(81, 'TRITURADO.', 0x31),
(82, 'BATERIAS JCI MERCADERIAS VARTA', 0x31),
(83, 'BATERIAS JCI MERCADERIAS SILVER', 0x31),
(84, 'BATERIAS JCI MERCADERIAS PMV', 0x31),
(100, 'MATERIAL DE EMPAQUE', 0x30),
(101, 'MATERIA PRIMA', 0x30),
(102, 'PP SCRAP', 0x30),
(103, 'PP RECICLADORA RECICLAJE', 0x30),
(104, 'PP OXIDADORA', 0x30),
(105, 'PP REJILLAS ', 0x30),
(106, 'PP PLACAS', 0x30),
(107, 'PP ENSAMBLE BATERIAS SECAS ', 0x30),
(108, 'TRITURADO', 0x30),
(109, 'MATERIA PRIMA BATERIAS CHATARRA', 0x30),
(110, 'PP ENSAMBLE BATERIAS SECAS GM ', 0x30),
(111, 'PP RECICLADORA REFINACION', 0x30),
(112, 'YESO', 0x30),
(113, 'PP ENSAMBLE BATERIAS SECAS PRUEBAS', 0x30),
(114, 'PP PLACAS PRUEBAS', 0x30),
(115, 'PP REJILLAS PRUEBAS', 0x30),
(116, 'PP ENSAMBLE BATERIAS SECAS VELKO', 0x30),
(117, 'PP ENSAMBLE BATERIAS SECAS RUBIX', 0x30),
(118, 'PP ENSAMBLE BATERIAS SECAS RUBIX (exp)', 0x30),
(119, 'PP ENSAMBLE BATERIAS SECAS Q PARTS', 0x30),
(120, 'PP ADAPTADOR DE PLOMO', 0x30),
(121, 'PP ENSAMBLE BATERIAS SECAS HELLA', 0x30),
(122, 'PP ENSAMBLE BATERIAS SECAS KOOR', 0x30),
(123, 'PP TRITURADORA', 0x30),
(201, 'PT FABRICADO BATERIAS ', 0x30),
(202, 'PT FABRICADO BATERIAS PRUEBAS', 0x30),
(203, 'PT FABRICADO BATERIAS PF', 0x30),
(204, 'PT FABRICADO BATERIAS JCI', 0x30),
(205, 'PT FABRICADO BATERIAS ETNA ', 0x30),
(206, 'PT FABRICADO BATERIAS ECUADOR JCI ', 0x30),
(207, 'PT FABRICADO BATERIAS ECUADOR ETNA', 0x30),
(208, 'PT FABRICADO BATERIAS ECUADOR  ENERSYSTEM', 0x30),
(210, 'PT FABRICADO BATERIAS ENERSYSTEM', 0x30),
(211, 'PT FABRICADO BATERIAS ECUADOR GM', 0x30),
(212, 'PT FABRICADO BATERIAS VELKO (exp)', 0x30),
(213, 'PT FABRICADO BATERIAS RUBIX', 0x30),
(214, 'PT FABRICADO BATERIAS RUBIX (exp)', 0x30),
(215, 'PT FABRICADO BATERIAS Q PARTS', 0x30),
(216, 'PT FABRICADO BATERIAS HELLA (exp)', 0x30),
(217, 'PT FABRICADO BATERIAS KOOR', 0x30),
(218, 'PT FABRICADO BATERIAS HELLA', 0x30),
(220, 'PT FABRICADO AGUA DESMINERALIZADA', 0x30),
(250, 'PT FABRICADO ANTISULFATANTES', 0x30),
(301, 'COMERCIAL BOSCH', 0x30),
(302, 'COMERCIAL MAC', 0x30),
(303, 'COMERCIAL MAC SILVER ', 0x30),
(304, 'COMERCIAL MAC VARTA', 0x30),
(305, 'COMERCIAL MAC GOLD', 0x30),
(306, 'COMERCIAL MAC PMV GOLD', 0x30),
(307, 'COMERCIAL MAC PMV SILVER ', 0x30),
(308, 'COMERCIAL BATERIAS DE MOTO', 0x30),
(309, 'COMERCIAL ACCESORIOS', 0x30),
(310, 'PT FABRICADO CARGADORES', 0x30),
(311, 'COMERCIAL ELECTROLITO', 0x30),
(312, 'COMERCIAL ARTICULOS PROMOCIONALES ', 0x30),
(313, 'COMERCIAL SET ', 0x30),
(314, 'COMERCIAL DURACELL', 0x30),
(315, 'COMERCIAL HELLA', 0x30),
(316, 'COMERCIAL CICLO PROFUNDO', 0x30),
(317, 'COMERCIAL MARKETING', 0x30),
(318, 'COMERCIAL SERVICIOS', 0x30),
(401, 'GASTOS COSTOS Y SERVICIOS ', 0x30),
(501, 'PROPIEDAD PLANTA EQUIPO ', 0x30),
(601, 'SUMINISTROS Y REPUESTOS (OLD)', 0x31),
(602, 'SUMINISTROS Y REPUESTOS', 0x30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listaprecios`
--

CREATE TABLE `listaprecios` (
  `codigoLisPre` int(11) NOT NULL DEFAULT 0 COMMENT 'codlp',
  `nombreLisPre` varchar(255) DEFAULT '' COMMENT 'nombrelp',
  `estadoLisPre` binary(1) DEFAULT '1' COMMENT 'statuslp'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `listaprecios`
--

INSERT INTO `listaprecios` (`codigoLisPre`, `nombreLisPre`, `estadoLisPre`) VALUES
(0, 'NINGUNA', 0x31),
(1, 'DISTRIBUIDOR', 0x31),
(2, 'CONSUMIDOR FINAL', 0x31),
(3, 'ESPECIAL', 0x31),
(4, 'MAYORISTA', 0x31),
(6, 'BATERIAS ECUADOR', 0x31),
(7, 'MAYORISTA MOTO', 0x31),
(8, 'SUPERMERCADOS', 0x31),
(9, 'PRUEBAS IT', 0x31),
(15, 'EMPLEADOS', 0x31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `numero_pedido` int(11) DEFAULT 0,
  `fecha_pedido` date DEFAULT NULL,
  `ruc_cliente` varchar(20) DEFAULT '',
  `nombre_cliente` varchar(200) DEFAULT '',
  `subtotal_pedido` double(15,2) DEFAULT 0.00,
  `descuento_pedido` double(5,2) DEFAULT 0.00,
  `estado_pedido` varchar(50) DEFAULT '',
  `codigo_lista_precios` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`numero_pedido`, `fecha_pedido`, `ruc_cliente`, `nombre_cliente`, `subtotal_pedido`, `descuento_pedido`, `estado_pedido`, `codigo_lista_precios`) VALUES
(1, '2019-06-27', '0704012798001', '', 1899.52, 0.00, '06', 0),
(2, '2019-06-27', '0704012798001', '', 105.28, 0.00, '01', 0),
(3, '2019-06-27', '1792115418001', '', 2625.28, 0.00, '01', 0),
(4, '2019-06-28', '0704012798001', '', 4151.84, 0.00, '01', 0),
(5, '2019-06-28', '0992215437001', '', 1827.68, 0.00, '01', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `codigoProducto` varchar(50) NOT NULL DEFAULT '',
  `nombreProducto` varchar(200) DEFAULT '',
  `nombreCorto` varchar(200) NOT NULL DEFAULT '',
  `codigoListaPrecio` varchar(50) NOT NULL DEFAULT '',
  `precioUnitario` decimal(10,2) NOT NULL DEFAULT 0.00,
  `iva` int(11) NOT NULL DEFAULT 0,
  `codigoLinea` int(11) NOT NULL DEFAULT 0,
  `codigoFamilia` varchar(50) NOT NULL DEFAULT '0',
  `codigoSubfamilia` varchar(200) NOT NULL DEFAULT '',
  `codigoClase` varchar(200) NOT NULL DEFAULT '',
  `estadoProd` binary(1) NOT NULL DEFAULT '1',
  `facturar` tinyint(2) NOT NULL DEFAULT 0,
  `web` tinyint(2) NOT NULL DEFAULT 0,
  `promocion` tinyint(2) NOT NULL DEFAULT 0,
  `electronico` tinyint(2) NOT NULL DEFAULT 0,
  `tipo` varchar(30) NOT NULL DEFAULT '',
  `modelo` varchar(30) NOT NULL DEFAULT '',
  `caja` varchar(30) NOT NULL DEFAULT '',
  `capacidad` smallint(6) NOT NULL DEFAULT 0,
  `equivalencia` smallint(6) NOT NULL DEFAULT 0,
  `polaridad` varchar(10) NOT NULL DEFAULT '0',
  `potencia27` smallint(6) NOT NULL DEFAULT 0,
  `potencia0` smallint(6) NOT NULL DEFAULT 0,
  `potencia18` smallint(6) NOT NULL DEFAULT 0,
  `largo` smallint(6) NOT NULL DEFAULT 0,
  `ancho` smallint(6) NOT NULL DEFAULT 0,
  `alto` smallint(6) NOT NULL DEFAULT 0,
  `capacReserva` smallint(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `codigoProducto`, `nombreProducto`, `nombreCorto`, `codigoListaPrecio`, `precioUnitario`, `iva`, `codigoLinea`, `codigoFamilia`, `codigoSubfamilia`, `codigoClase`, `estadoProd`, `facturar`, `web`, `promocion`, `electronico`, `tipo`, `modelo`, `caja`, `capacidad`, `equivalencia`, `polaridad`, `potencia27`, `potencia0`, `potencia18`, `largo`, `ancho`, `alto`, `capacReserva`) VALUES
(1043, 'ACCEALU0029', 'DENSIMETRO', 'DENSIMETRO', '', '7.00', 12, 309, 'ALU', 'ALU', '0029', 0x31, 1, 1, 0, 1, 'NINGUNO', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1044, 'ACCEALU0027', 'COMPROBADOR 6-12 VOLTIOS', 'COMPROBADOR', '', '25.00', 12, 309, 'ALU', 'ALU', '0027', 0x31, 1, 1, 0, 1, 'NINGUNO', 'NINGUNO', '', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(1056, 'COMPADEAG. DESM.1 LITRO', 'AGUA DESMINERALIZADA CON ENVASE 1 LT COD.7862109650486', 'AG. DESM.1 LITRO', '', '0.80', 12, 220, 'ADE', 'ADE', 'AG. DESM.1 LITRO', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1058, 'COMPADEAG.DSM.NO ENVASE', 'AGUA DESMINERALIZADA SIN ENVASE', 'AG.DSM.NO ENVASE', '', '0.50', 12, 220, 'ADE', 'ADE', 'AG.DSM.NO ENVASE', 0x31, 1, 0, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1059, 'COMPADEAGUA D. 1 GL', 'AGUA DESMINERALIZADA CON ENVASE ( 1 GALON) COD. 7862109650561', 'AGUA D. 1 GL', '', '2.20', 12, 220, 'ADE', 'ADE', 'AGUA D. 1 GL', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1060, 'ACCECAR0002', 'CARGADOR DE 1 BATERIA DE MOTO', 'CARGADOR MOTO', '', '120.00', 12, 310, 'CAR', 'CAR', '0002', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1063, 'ACCEALU0028', 'COMPROBADOR DE BATERIAS E-200', 'COMPROBADOR', '', '380.00', 12, 309, 'ALU', 'ALU', '0028', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1094, 'ACCECAR0001', 'CARGADOR DE 1 A 5 BATERIAS', 'CARGADOR 1-5 BT', '', '180.00', 12, 310, 'CAR', 'CAR', '0001', 0x31, 1, 1, 0, 1, 'NINGUNO', 'NINGUNO', '', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(1108, 'COMPANTANTISUFT PAR', 'ANTISULFATANTES ( PAR) COD.7862109650490', 'ANTISUFT PAR', '', '0.89', 12, 250, 'ANT', 'ANT', 'ANTISUFT PAR', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1115, 'ACCEALU0080', 'SOPORTES DE BATERIAS UNIVERSAL COD.7862109651032', 'SOPORTE BAT UNIV', '', '5.00', 12, 309, 'ALU', 'ALU', '0080', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1116, 'ACCEALU0079', 'SOPORTE DE BATERIAS REGULABLE', 'SOPORTE DE B', '', '5.00', 12, 309, 'ALU', 'ALU', '0079', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1117, 'ACCEALU0019', 'BORNES REFORZADOS (PAR + . -) COD.7862109651049', 'BORNES REF. PAR', '', '3.00', 12, 309, 'ALU', 'ALU', '0019', 0x31, 1, 1, 0, 1, 'NINGUNO', 'NINGUNO', '', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(1118, 'ACCEALU0020', 'BORNES REFORZADOS PEQUEÑOS  (PAR / BORNE FINO) COD.7862109651056', 'BORNE REF PEQ', '', '3.00', 12, 309, 'ALU', 'ALU', '0020', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1122, 'BMOTBMC12N10-3B', '12N10-3B', '12N10-3B', '', '29.21', 12, 308, 'BMC', 'BMC', '12N10-3B', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1123, 'BMOTBMC12N12A-4A-1', '12N12A-4A-1', '12N12A-4A-1', '', '34.39', 12, 308, 'BMC', 'BMC', '12N12A-4A-1', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1124, 'BMOTBMC12N14-3A', '12N14-3A', '12N14-3A', '', '39.64', 12, 308, 'BMC', 'BMC', '12N14-3A', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1125, 'BMOTBMC12N5-3B', '12N5-3B', '12N5-3B', '', '27.50', 12, 308, 'BMC', 'BMC', '12N5-3B', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1126, 'BMOTBMC12N7-3B', '12N7-3B', '12N7-3B', '', '37.95', 12, 308, 'BMC', 'BMC', '12N7-3B', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1127, 'BMOTBMC12N7-4A', '12N7-4A', '12N7-4A', '', '37.95', 12, 308, 'BMC', 'BMC', '12N7-4A', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1128, 'BMOTBMC12N7A-3A', '12N7A-3A', '12N7A-3A', '', '39.80', 12, 308, 'BMC', 'BMC', '12N7A-3A', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1129, 'BMOTBMC12N9-3A', '12N9-3A', '12N9-3A', '', '28.61', 12, 308, 'BMC', 'BMC', '12N9-3A', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1130, 'BMOTBMC12N9-3B', '12N9-3B COD.7862109650912', '12N9-3B', '', '41.30', 12, 308, 'BMC', 'BMC', '12N9-3B', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1131, 'BMOTBMC12N9-4B-1', '12N9-4B-1 COD.7862109650929', '12N9-4B-1', '', '36.92', 12, 308, 'BMC', 'BMC', '12N9-4B-1', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1132, 'BMOTBMC6N4-2A', '6N4-2A', '6N4-2A', '', '16.00', 12, 308, 'BMC', 'BMC', '6N4-2A', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1134, 'BMOTBMCYB2.5L-C', 'YB2.5L-C', 'YB2.5L-C', '', '18.90', 12, 308, 'BMC', 'BMC', 'YB2.5L-C', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1135, 'BMOTBMCYB3L-A', 'YB3L-A COD.7862109650967', 'YB3L-A', '', '16.75', 12, 308, 'BMC', 'BMC', 'YB3L-A', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1136, 'BMOTBMCYB3L-B', 'YB3L-B COD.7862109650974', 'YB3L-B', '', '16.75', 12, 308, 'BMC', 'BMC', 'YB3L-B', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1137, 'BMOTBMCYB4L-B', 'YB4L-B', 'YB4L-B', '', '17.62', 12, 308, 'BMC', 'BMC', 'YB4L-B', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1138, 'BMOTBMCYB6.5L-B', 'YB6.5L-B', 'YB6.5L-B', '', '32.00', 12, 308, 'BMC', 'BMC', 'YB6.5L-B', 0x31, 1, 1, 0, 1, 'NINGUNO', 'NINGUNO', '', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(1139, 'BMOTBMCYT4L-BS', 'YT4L-BS COD.7862109650998', 'YT4L-BS', '', '17.24', 12, 308, 'BMC', 'BMC', 'YT4L-BS', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1140, 'BMOTBMCYTX-4L-BS', 'YTX-4L-BS', 'YTX-4L-BS', '', '24.00', 12, 308, 'BMC', 'BMC', 'YTX-4L-BS', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1141, 'BMOTBMCYTX5L-BS', 'YTX5L-BS', 'YTX5L-BS', '', '38.88', 12, 308, 'BMC', 'BMC', 'YTX5L-BS', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1142, 'BMOTBMCYTX7A-BS', 'YTX7A-BS', 'YTX7A-BS', '', '40.50', 12, 308, 'BMC', 'BMC', 'YTX7A-BS', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1143, 'BMOTBMCYTX7L-BS', 'YTX7L-BS', 'YTX7L-BS', '', '43.90', 12, 308, 'BMC', 'BMC', 'YTX7L-BS', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1144, 'BMOTBMCYTX9-BS', 'YTX9-BS', 'YTX9-BS', '', '31.70', 12, 308, 'BMC', 'BMC', 'YTX9-BS', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(1787, 'FTERTE4N40-FEI-E4', 'E4 N40 FE I 12V 11PL 43AMP', 'E4 N40 FE I', 'NS60', '94.00', 12, 201, 'TE4', 'TE4', 'N40-FEI-E4', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', 'N40', 43, 11, 'I', 0, 0, 0, 0, 0, 0, 0),
(1788, 'FTERTE4N40-FE--E4', 'E4 N40 FE 12V 11PL 43AMP', 'E4 N40 FE', 'NS60L', '94.00', 12, 201, 'TE4', 'TE4', 'N40-FE--E4', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', 'N40', 43, 11, 'D', 520, 440, 370, 238, 133, 228, 80),
(1790, 'FTERTE3N40-FE--E3', 'E3 N40 FE 12V 11PL 43AMP', 'E3 N40 FE', 'NS60L', '91.00', 12, 201, 'TE3', 'TE3', 'N40-FE--E3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', 'N40', 80, 11, 'D', 520, 440, 370, 238, 133, 228, 80),
(1791, 'FTERTE3N40-FEI-E3', 'E3 N40 FE I 12V 11PL 43AMP', 'E3 N40 FE I', 'NS60', '91.00', 12, 201, 'TE3', 'TE3', 'N40-FEI-E3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', 'N40', 80, 11, 'I', 520, 440, 370, 238, 133, 228, 80),
(1792, 'FTERTE3N40-FEIFE3', 'E3 N40 FE I F 12V 11PL 43AMP', 'E3 N40 FE I F', 'NS60BF', '91.00', 12, 201, 'TE3', 'TE3', 'N40-FEIFE3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', 'N40', 43, 11, 'I-F', 520, 440, 370, 238, 133, 228, 80),
(1795, 'FTERTE3NS40FE-FE3', 'E3 NS40 FE F 12V 10PL 42AMP', 'E3 NS40 FE F', 'NS40ZZL', '77.00', 12, 201, 'TE3', 'TE3', 'NS40FE-FE3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', 'NS40', 42, 10, 'D-F', 520, 440, 370, 193, 124, 224, 71),
(1796, 'FTERTE4NS40FE--E4', 'E4 NS40 FE 12V 10PL 42AMP', 'E4 NS40 FE', 'NS40ZZL', '89.00', 12, 201, 'TE4', 'TE4', 'NS40FE--E4', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', 'NS40', 42, 10, 'D', 0, 0, 0, 0, 0, 0, 0),
(1797, 'FTERTE3NS40FEIFE3', 'E3 NS40 FE I F 12V 10PL 42AMP', 'E3 NS40 FE I F', 'NS40ZZ', '77.00', 12, 201, 'TE3', 'TE3', 'NS40FEIFE3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', 'NS40', 42, 10, 'I-F', 520, 440, 370, 193, 124, 224, 71),
(1798, 'FTERTE4NS40FEI-E4', 'E4 NS40 FE I 12V 10PL 42AMP', 'E4 NS40 FE I', 'NS40ZZ', '89.00', 12, 201, 'TE4', 'TE4', 'NS40FEI-E4', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', 'NS40', 42, 10, 'I', 0, 0, 0, 0, 0, 0, 0),
(1799, 'FTERTE3NS40ST-FE3', 'E3 NS40 ST F 12V 9PL 40AMP', 'E3 NS40 ST F', 'NS40ZL', '78.00', 12, 201, 'TE3', 'TE3', 'NS40ST-FE3', 0x31, 1, 1, 1, 1, 'E3', 'STANDAR', 'NS40', 40, 9, 'D-F', 0, 0, 0, 0, 0, 0, 0),
(1801, 'FTERTE3NS40STIF-E3', 'E3 NS40 ST I F 12V 9PL 40AMP', 'E3 NS40 ST I F', 'NS40Z', '78.00', 12, 201, 'TE3', 'TE3', 'NS40STIF-E3', 0x31, 1, 1, 1, 1, 'E3', 'STANDAR', 'NS40', 40, 9, 'I-F', 0, 0, 0, 0, 0, 0, 0),
(1811, 'FTERTE324--FE-E3', 'E3 24 FE 12V 11PL 54AMP', 'E3 24 FE', 'N50ZL', '112.00', 12, 201, 'TE3', 'TE3', '24--FE-E3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', '24', 54, 11, 'D', 620, 520, 440, 255, 170, 224, 117),
(1812, 'FTERTE324--FEI-E3', 'E3 24 FE I 12V 11PL 54AMP', 'E3 24 FE I', 'N50Z', '112.00', 12, 201, 'TE3', 'TE3', '24--FEI-E3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', '24', 54, 11, 'I', 620, 520, 440, 255, 170, 224, 117),
(1817, 'FTERTE324--HP--E3', 'E3 24 HP 12V 13PL 64AMP', 'E3 24 HP', 'NS70L', '128.00', 12, 201, 'TE3', 'TE3', '24--HP--E3', 0x31, 1, 1, 1, 1, 'E3', 'HIGH POWER', '24', 64, 13, 'D', 790, 660, 550, 255, 170, 224, 127),
(1818, 'FTERTE424--HP--E4', 'E4 24 HP 12V 13PL 64AMP', 'E4 24 HP', 'NS70L', '130.00', 12, 201, 'TE4', 'TE4', '24--HP--E4', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '24', 64, 13, 'D', 790, 660, 550, 255, 170, 224, 127),
(1819, 'FTERTE324--HPI-E3', 'E3 24 HP I 12V 13PL 64AMP', 'E3 24 HP I', 'NS70', '128.00', 12, 201, 'TE3', 'TE3', '24--HPI-E3', 0x31, 1, 1, 1, 1, 'E3', 'HIGH POWER', '24', 64, 13, 'I', 790, 660, 550, 255, 170, 224, 127),
(1820, 'FTERTE424--HPI-E4', 'E4 24 HP I 12V 13PL 64AMP', 'E4 24 HP I', 'NS70', '130.00', 12, 201, 'TE4', 'TE4', '24--HPI-E4', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '24', 64, 13, 'I', 790, 660, 550, 255, 170, 224, 127),
(1821, 'FTERTE324--STI-E3', 'E3 24 ST I 12V 9PL 52AMP', 'E3 24 ST I', 'N50', '100.00', 12, 201, 'TE3', 'TE3', '24--STI-E3', 0x31, 1, 1, 1, 1, 'E3', 'STANDAR', '24', 52, 9, 'I', 540, 450, 380, 255, 170, 224, 98),
(1825, 'FTERTE327--FEI-E3', 'E3 27 FE I 12V 13PL 74AMP', 'E3 27 FE I', 'N70', '140.00', 12, 201, 'TE3', 'TE3', '27--FEI-E3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', '27', 74, 13, 'I', 860, 720, 600, 300, 168, 224, 166),
(1826, 'FTERTE327--HP--E3', 'E3 27 HP 12V 15PL 88AMP', 'E3 27 HP', 'N70ZL', '156.00', 12, 201, 'TE3', 'TE3', '27--HP--E3', 0x31, 1, 1, 1, 1, 'E3', 'HIGH POWER', '27', 88, 15, 'D', 930, 780, 650, 300, 168, 224, 172),
(1827, 'FTERTE427--HP--E4', 'E4 27 HP 12 V 15 PL 88AMP', 'E4 27 HP', 'N70ZL', '162.50', 12, 201, 'TE4', 'TE4', '27--HP--E4', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '27', 88, 15, 'D', 930, 780, 650, 300, 168, 224, 172),
(1828, 'FTERTE327--HPI-E3', 'E3 27 HP I 12V 15PL 88AMP', 'E3 27 HP I', 'N70Z', '156.00', 12, 201, 'TE3', 'TE3', '27--HPI-E3', 0x31, 1, 1, 1, 1, 'E3', 'HIGH POWER', '27', 88, 15, 'I', 930, 780, 650, 300, 168, 224, 172),
(1829, 'FTERTE427--HPI-E4', 'E4 27 HP I 12V 15PL 88AMP', 'E4 27 HP I', 'N70Z', '162.50', 12, 201, 'TE4', 'TE4', '27--HPI-E4', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '27', 88, 15, 'I', 930, 780, 650, 300, 168, 224, 172),
(1835, 'FTERTE334--FE--E3', 'E3 34 FE 12V 13PL 61AMP', 'E3 34 FE', 'NS70BL', '115.00', 12, 201, 'TE3', 'TE3', '34--FE--E3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', '34', 61, 13, 'D', 750, 630, 530, 255, 170, 200, 122),
(1837, 'FTERTE334--FEI-E3', 'E3 34 FE I 12V 13PL 61AMP', 'E3 34 FE I', 'NS70B', '115.00', 12, 201, 'TE3', 'TE3', '34--FEI-E3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', '34', 61, 13, 'I', 750, 630, 530, 255, 170, 200, 122),
(1839, 'FTERTE334--HP--E3', 'E3 34 HP 12V 15PL 70AMP', 'E3 34 HP', 'NS78BL', '130.00', 12, 201, 'TE3', 'TE3', '34--HP--E3', 0x31, 1, 1, 1, 1, 'E3', 'HIGH POWER', '34', 70, 15, 'D', 810, 680, 570, 255, 170, 200, 144),
(1840, 'FTERTE434--HP--E4', 'E4 34 HP 12V 15PL 70AMP', 'E4 34 HP', 'NS78BL', '133.00', 12, 201, 'TE4', 'TE4', '34--HP--E4', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '34', 70, 15, 'D', 810, 680, 570, 255, 170, 200, 144),
(1841, 'FTERTE334--HPI-E3', 'E3 34 HP I 12V 15PL 70AMP', 'E3 34 HP I', 'NS78B', '130.00', 12, 201, 'TE3', 'TE3', '34--HPI-E3', 0x31, 1, 1, 1, 1, 'E3', 'HIGH POWER', '34', 70, 15, 'I', 810, 680, 570, 255, 170, 200, 144),
(1842, 'FTERTE434--HPI-E4', 'E4 34 HP I 12V 15PL 70AMP', 'E4 34 HP I', 'NS78B', '133.00', 12, 201, 'TE4', 'TE4', '34--HPI-E4', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '34', 70, 15, 'I', 810, 680, 570, 255, 170, 200, 144),
(1845, 'FTERTE342--FE--E3', 'E3 42 FE 12V 11PL 45AMP', 'E3 42 FE', '55530', '85.00', 12, 201, 'TE3', 'TE3', '42--FE--E3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', '42', 45, 11, 'D', 520, 440, 370, 233, 174, 172, 80),
(1846, 'FTERTE442--FE--E4', 'E4 42 FE 12 V 11PL 45AMP', 'E4 42 FE', '55530', '100.00', 12, 201, 'TE4', 'TE4', '42--FE--E4', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '42', 45, 11, 'I', 520, 440, 370, 233, 174, 172, 80),
(1847, 'FTERTE342--FEI-E3', 'E3 42 FE I 12V 11PL 45AMP', 'E3 42 FE I', '55530R', '85.00', 12, 201, 'TE3', 'TE3', '42--FEI-E3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', '42', 45, 11, 'I', 520, 440, 370, 233, 174, 172, 80),
(1848, 'FTERTE442--FEI-E4', 'E4 42 FE I 12V 11PL 45AMP', 'E4 42 FE I', '55530R', '100.00', 12, 201, 'TE4', 'TE4', '42--FEI-E4', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '42', 45, 11, 'I', 0, 0, 0, 0, 0, 0, 0),
(1849, 'FTERTE342--HP--E3', 'E3 42 HP 12V 13PL 55AMP', 'E3 42 HP', '55560', '103.00', 12, 201, 'TE3', 'TE3', '42--HP--E3', 0x31, 1, 1, 1, 1, 'E3', 'HIGH POWER', '42', 55, 13, 'D', 660, 550, 460, 233, 174, 172, 100),
(1850, 'FTERTE442--HP--E4', 'E4 42 HP 12 V 13PL 55AMP', 'E4 42 HP', '55560', '107.00', 12, 201, 'TE4', 'TE4', '42--HP--E4', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '42', 55, 13, 'D', 660, 550, 460, 233, 174, 172, 100),
(1851, 'FTERTE342--HPI-E3', 'E3 42 HP I 12V 13PL 55AMP', 'E3 42 HP I', '55560R', '103.00', 12, 201, 'TE3', 'TE3', '42--HPI-E3', 0x31, 1, 1, 1, 1, 'E3', 'HIGH POWER', '42', 55, 13, 'I', 660, 550, 460, 233, 174, 172, 100),
(1852, 'FTERTE442--HPI-E4', 'E4 42 HP I 12V 13PL 55AMP', 'E4 42 HP I', '55560R', '107.00', 12, 201, 'TE4', 'TE4', '42--HPI-E4', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '42', 55, 13, 'I', 660, 550, 460, 233, 174, 172, 100),
(1853, 'FTERTE342--ST--E3', 'E3 42 ST 12V 10PL 40AMP', 'E3 42 ST', '54533', '88.00', 12, 201, 'TE3', 'TE3', '42--ST--E3', 0x31, 1, 1, 1, 1, 'E3', 'STANDAR', 'NS40', 40, 10, 'D', 0, 0, 0, 0, 0, 0, 0),
(1859, 'FTERTE355--FE--E3', 'E3 55 FE 12V 13PL 58AMP', 'E3 55 FE', '55 FE', '104.00', 12, 201, 'TE3', 'TE3', '55--FE--E3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', '55', 58, 13, 'D', 760, 640, 540, 240, 175, 188, 100),
(1860, 'FTERTE355--FEI-E3', 'E3 55 FE I 12V 13PL 58AMP', 'E3 55 FEI', '55 FE I', '104.00', 12, 201, 'TE3', 'TE3', '55--FEI-E3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', '55', 58, 13, 'I', 760, 640, 540, 240, 175, 188, 100),
(1874, 'FTERTE366--FE--E3', 'E3 66 FE 12V 15PL 68AMP', 'E3 66 FE', '56618', '121.00', 12, 201, 'TE3', 'TE3', '66--FE--E3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', '66-48', 68, 15, 'D', 930, 780, 650, 277, 174, 175, 121),
(1875, 'FTERTE466--FE--E4', 'E4 66 FE 12V 15PL 68AMP', 'E4 66 FE', '56618', '127.00', 12, 201, 'TE4', 'TE4', '66--FE--E4', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '66-48', 68, 15, 'D', 930, 780, 650, 277, 174, 175, 121),
(1876, 'FTERTE366--FEI-E3', 'E3 66 FE I 12V 15PL 68AMP', 'E3 66 FE I', '56618R', '121.00', 12, 201, 'TE3', 'TE3', '66--FEI-E3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', '66-48', 68, 15, 'I', 930, 780, 650, 277, 174, 175, 121),
(1877, 'FTERTE466--FEI-E4', 'E4 66 FE I 12V 15PL 68AMP', 'E4 66 FE I', '56618R', '127.00', 12, 201, 'TE4', 'TE4', '66--FEI-E4', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '66-48', 68, 15, 'I', 930, 780, 650, 277, 174, 175, 121),
(1904, 'FTERTE330H-FEI-E3', 'E3 30H FE I 12V 15PL 82AMP', 'E3 30H FE I', '30H90', '157.00', 12, 201, 'TE3', 'TE3', '30H-FEI-E3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', '30H', 82, 15, 'I', 900, 750, 630, 338, 162, 241, 182),
(1905, 'FTERTE330H-HD--E3', 'E3 30H HD 12V 17PL 98AMP', 'E3 30H HD', '30H102L', '173.00', 12, 201, 'TE3', 'TE3', '30H-HD--E3', 0x31, 1, 1, 1, 1, 'E3', 'HEAVY DUTY', '30H', 98, 17, 'D', 1030, 860, 720, 338, 162, 241, 183),
(1906, 'FTERTE330H-HDI-E3', 'E3 30H HD I 12V 17PL 98AMP', 'E3 30H HD I', '30H102', '173.00', 12, 201, 'TE3', 'TE3', '30H-HDI-E3', 0x31, 1, 1, 1, 1, 'E3', 'HEAVY DUTY', '30H', 98, 17, 'I', 1030, 860, 720, 338, 162, 241, 183),
(1913, 'FTERTE331-HD-I-E3', 'E3 31 HD I 12V 17PL 102AMP', 'E3 31 HD I', '31H102E', '173.00', 12, 201, 'TE3', 'TE3', '31-HD-I-E3', 0x31, 1, 1, 1, 1, 'E3', 'HEAVY DUTY', '30H', 102, 17, 'P-I', 930, 750, 630, 338, 162, 241, 182),
(1915, 'FTERTE34DLTHD-E3', 'E3 4DLT HD 12V 23PL 124AMP', 'E3 4DLT HD', 'N135', '249.00', 12, 201, 'TE3', 'TE3', '4DLTHD-E3', 0x31, 1, 1, 1, 1, 'E3', 'HEAVY DUTY', '4DLT', 124, 23, 'D', 1180, 990, 830, 496, 220, 210, 242),
(1924, 'FTERTE3N150HD--E3', 'E3 N150 HD 12V 23PL 150AMP', 'E3 N150 HD', 'N150', '265.00', 12, 201, 'TE3', 'TE3', 'N150HD--E3', 0x31, 1, 1, 1, 1, 'E3', 'HEAVY DUTY', 'N150', 150, 23, 'D', 1260, 1050, 880, 496, 220, 236, 250),
(2163, 'FTERTE434--HP--E4 A', 'E4 34HP A', 'E4 34 HP A', '', '145.00', 12, 201, 'TE4', 'TE4', '34--HP--E4 A', 0x30, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(2184, 'BMOTBMC26', 'YB7B-B', 'nd', '', '12.86', 12, 308, 'BMC', 'BMC', '26', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(2366, 'FTERTE4NS40HP--E4', 'E4 NS40 HP 12V 11PL 47AMP', 'E4 NS40 HP', 'NS40 HP', '105.00', 12, 201, 'TE4', 'TE4', 'NS40HP--E4', 0x31, 1, 0, 0, 1, 'E4', 'FULL EQUIPO', 'NS40', 42, 10, 'D-F', 520, 440, 370, 193, 124, 224, 71),
(2367, 'FTERTE4NS40HPI-E4', 'E4 NS40 HP I 12V 11PL 47AMP', 'E4 NS40 HP I', 'NS40 HPI', '105.00', 12, 201, 'TE4', 'TE4', 'NS40HPI-E4', 0x31, 1, 0, 0, 1, 'E4', 'HIGH POWER', 'NS40', 42, 10, 'I-F', 520, 440, 370, 193, 124, 224, 71),
(2368, 'FTERTE366--HP--E3', 'E3 66 HP 12V 17PL 72AMP', 'E3 66 HP', '66 HP', '128.00', 12, 201, 'TE3', 'TE3', '66--HP--E3', 0x31, 1, 0, 0, 1, 'E3', 'STANDAR', '', 70, 17, 'D', 0, 0, 0, 0, 0, 0, 0),
(2369, 'FTERTE3NS40HP--E3', 'E3 NS40 HP 12V 11PL 47AMP', 'E3 NS40 HP', 'NS40 HP', '86.00', 12, 201, 'TE3', 'TE3', 'NS40HP--E3', 0x31, 1, 1, 1, 1, 'E3', 'HIGH POWER', 'NS40', 47, 11, 'D-F', 570, 480, 400, 193, 124, 224, 77),
(2370, 'FTERTE3NS40HPI-E3', 'E3 NS40 HP I 12V 11PL 47AMP', 'E3 NS40 HP I', 'NS40 HPI', '86.00', 12, 201, 'TE3', 'TE3', 'NS40HPI-E3', 0x31, 1, 1, 1, 1, 'E3', 'HIGH POWER', 'NS40', 77, 11, 'I-F', 570, 480, 400, 193, 124, 224, 77),
(2371, 'FTERTE324--ST--E3', 'E3 24 ST 12V 9PL 52AMP', 'E3 24 ST', 'N50L', '100.00', 12, 201, 'TE3', 'TE3', '24--ST--E3', 0x31, 1, 1, 1, 1, 'E3', 'STANDAR', '24', 52, 9, 'D', 540, 450, 380, 255, 170, 224, 98),
(2372, 'FTERTE4N40-HP--E4', 'E4 N40 HP 12V 13PL 57AMP', 'E4 N40 HP', 'N40 HP', '112.00', 12, 201, 'TE4', 'TE4', 'N40-HP--E4', 0x31, 1, 0, 0, 1, 'E4', 'HIGH POWER', '', 57, 13, 'D', 0, 0, 0, 0, 0, 0, 0),
(2373, 'FTERTE324--MP--E3', 'E3 24 MP 12V 15PL 83AMP', 'E3 24 MP', '24MP', '155.00', 12, 201, 'TE3', 'TE3', '24--MP--E3', 0x31, 1, 1, 1, 1, 'E3', 'MEGA POWER', '24', 83, 15, 'D', 930, 780, 650, 255, 170, 224, 161),
(2374, 'FTERTE324--MPI-E3', 'E3 24 MP I 12V 15PL 83AMP', 'E3 24 MP I', '24MPI', '155.00', 12, 201, 'TE3', 'TE3', '24--MPI-E3', 0x31, 1, 1, 1, 1, 'E3', 'MEGA POWER', '24', 83, 15, 'I', 930, 780, 650, 255, 170, 224, 161),
(2375, 'FTERTE4N40-HPI-E4', 'E4 N40 HP I 12V 13PL 57AMP', 'E4 N40 HP I', 'N40 HP I', '112.00', 12, 201, 'TE4', 'TE4', 'N40-HPI-E4', 0x31, 1, 0, 0, 1, 'E4', 'FULL EQUIPO', 'N40', 43, 11, 'I', 520, 440, 370, 238, 133, 228, 80),
(2376, 'FTERTE424--MP--E4', 'E4 24 MP 12V 15PL 83AMP', 'E4 24 MP', '24 MP', '159.00', 12, 201, 'TE4', 'TE4', '24--MP--E4', 0x31, 1, 1, 1, 1, 'E4', 'MEGA POWER', '24', 83, 15, 'D', 0, 0, 0, 0, 0, 0, 0),
(2378, 'FTERTE424--MPI-E4', 'E4 24 MP I 12V 15PL 83AMP', 'E4 24 MP I', '24 MP I', '159.00', 12, 201, 'TE4', 'TE4', '24--MPI-E4', 0x31, 1, 0, 0, 1, 'E4', 'MEGA POWER', '24', 83, 15, 'I', 0, 0, 0, 0, 0, 0, 0),
(2380, 'FTERTE436--HP--E4', 'E4 36 HP 12V 10PL 50AMP', 'E4 36 HP', '54434', '103.00', 12, 201, 'TE4', 'TE4', '36--HP--E4', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '36', 50, 10, 'D', 620, 520, 440, 207, 174, 175, 80),
(2381, 'FTERTE342-STI-E3', 'E3 42 ST I 12V 10PL 40AMP', 'E3 42 ST I', '54533R', '88.00', 12, 201, 'TE3', 'TE3', '42-STI-E3', 0x31, 1, 1, 1, 1, 'E3', 'STANDAR', 'NS40', 40, 10, 'I', 0, 0, 0, 0, 0, 0, 0),
(2382, 'FTERTE442--MP--E4', 'E4 42 MP 12V 14PL 62AMP', 'E4 42 MP', '42 MP', '120.00', 12, 201, 'TE4', 'TE4', '42--MP--E4', 0x31, 1, 1, 1, 1, 'E4', 'MEGA POWER', '42', 62, 14, 'D', 800, 670, 560, 233, 174, 172, 111),
(2383, 'FTERTE442--MPI-E4', 'E4 42 MP I 12V 14PL 62AMP', 'E4 42 MP I', '42 MPI', '120.00', 12, 201, 'TE4', 'TE4', '42--MPI-E4', 0x31, 1, 1, 1, 1, 'E4', 'MEGA POWER', '42', 62, 14, 'I', 800, 670, 560, 233, 174, 172, 111),
(2384, 'FTERTE434--MP--E4', 'E4 34 MP 12V 17PL 78AMP', 'E4 34 MP', '34 MP', '159.00', 12, 201, 'TE4', 'TE4', '34--MP--E4', 0x31, 1, 0, 0, 1, 'E4', 'MEGA POWER', '34', 78, 17, 'D', 0, 0, 0, 0, 0, 0, 0),
(2385, 'FTERTE342--MP--E3', 'E3 42 MP 12V 14PL 62AMP', 'E3 42 MP', '42 MP', '110.00', 12, 201, 'TE3', 'TE3', '42--MP--E3', 0x31, 1, 1, 1, 1, 'E3', 'MEGA POWER', '42', 62, 14, 'D', 800, 670, 560, 233, 174, 172, 111),
(2386, 'FTERTE342--MPI-E3', 'E3 42 MP I 12V 14PL 62AMP', 'E3 42 MP I', '42 MP I', '110.00', 12, 201, 'TE3', 'TE3', '42--MPI-E3', 0x31, 1, 1, 1, 1, 'E3', 'MEGA POWER', '42', 62, 14, 'I', 800, 670, 560, 233, 174, 172, 111),
(2387, 'FTERTE455--FE--E4', 'E4 55 FE 12V 12PL 58AMP', 'E4 55 FE', '55 FE', '107.50', 12, 201, 'TE4', 'TE4', '55--FE--E4', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '55', 58, 13, 'D', 760, 640, 540, 240, 175, 188, 100),
(2388, 'FTERTE434--MPI--E4', 'E4 34 MP I 12V 17PL 78AMP', 'E4 34 MP I', '34 MPI', '159.00', 12, 201, 'TE4', 'TE4', '34--MPI--E4', 0x31, 1, 0, 0, 1, 'E4', 'MEGA POWER', '34', 78, 17, 'I', 0, 0, 0, 0, 0, 0, 0),
(2389, 'FTERTE455--FEI-E4', 'E4 55 FE I 12V 12PL 58AMP', 'E4 55 FE I', '55 FE I', '107.50', 12, 201, 'TE4', 'TE4', '55--FEI-E4', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '55', 58, 13, 'I', 760, 640, 540, 240, 175, 188, 100),
(2390, 'FTERTE334--MP--E3', 'E3 34 MP 12V 17PL 78AMP', 'E3 34 MP', '34 MP', '146.00', 12, 201, 'TE3', 'TE3', '34--MP--E3', 0x31, 1, 1, 1, 1, 'E3', 'MEGA POWER', '34', 78, 17, 'D', 1040, 870, 730, 255, 170, 200, 155),
(2391, 'FTERTE455--HP--E4', 'E4 55 HP 12V 13PL 63AMP', 'E4 55 HP', '55 HP', '121.00', 12, 201, 'TE4', 'TE4', '55--HP--E4', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '55', 63, 14, 'D', 790, 660, 550, 240, 175, 188, 111),
(2392, 'FTERTE334--MPI--E3', 'E3 34 MPI 12V 17PL 78AMP', 'E3 34 MP I', '34 MP I', '146.00', 12, 201, 'TE3', 'TE3', '34--MPI--E3', 0x31, 1, 1, 1, 1, 'E3', 'MEGA POWER', '34', 78, 17, 'I', 1040, 870, 730, 255, 170, 200, 155),
(2393, 'FTERTE455--HPI-E4', 'E4 55 HP I 12V 13PL 63AMP', 'E4 55 HP I', '55 HPI', '121.00', 12, 201, 'TE4', 'TE4', '55--HPI-E4', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '55', 63, 14, 'I', 790, 660, 550, 240, 175, 188, 111),
(2394, 'FTERTE355--HP--E3', 'E3 55 HP 12V 14PL 63AMP', 'E3 55 HP', '55 HP', '113.00', 12, 201, 'TE3', 'TE3', '55--HP--E3', 0x31, 1, 1, 1, 1, 'E3', 'HIGH POWER', '55', 63, 14, 'D', 790, 660, 550, 240, 175, 188, 111),
(2395, 'FTERTE427--MP--E4', 'E4 27 MP 12V 17PL 103 AMP', 'E4 27 MP', '27 MP', '198.00', 12, 201, 'TE4', 'TE4', '27--MP--E4', 0x31, 1, 0, 0, 1, 'E4', 'MEGA POWER', '', 103, 17, 'D', 0, 0, 0, 0, 0, 0, 0),
(2396, 'FTERTE355--HPI-E3', 'E3 55 HP I 12V 14PL 63AMP', 'E3 55 HP I', '55 HP I', '113.00', 12, 201, 'TE3', 'TE3', '55--HPI-E3', 0x31, 1, 1, 1, 1, 'E3', 'HIGH POWER', '55', 63, 14, 'I', 790, 660, 550, 240, 175, 188, 111),
(2397, 'FTERTE427--MPI--E4', 'E4 27 MP I 12V 17PL 103AMP', 'E4 27 MP I', '27 MPI', '198.00', 12, 201, 'TE4', 'TE4', '27--MPI--E4', 0x31, 1, 0, 0, 1, 'E4', 'MEGA POWER', '', 103, 17, 'I', 0, 0, 0, 0, 0, 0, 0),
(2398, 'FTERTE365--HP--E3', 'E3 65 HP 12V 12PL 62AMP', 'E3 65 HP', 'N65L', '126.00', 12, 201, 'TE3', 'TE3', '65--HP--E3', 0x31, 1, 1, 1, 1, 'E3', 'HIGH POWER', '65', 62, 12, 'D', 810, 680, 570, 230, 175, 215, 125),
(2399, 'FTERTE365--HPI-E3', 'E3 65 HP I 12V 12PL 62AMP', 'E3 65 HP I', '65 HP I', '126.00', 12, 201, 'TE3', 'TE3', '65--HPI-E3', 0x31, 1, 0, 0, 1, 'E3', 'HIGH POWER', '', 62, 12, 'I', 0, 0, 0, 0, 0, 0, 0),
(2400, 'FTERTE449--HP--E4', 'E4 49 HP 12V 17PL 90AMP', 'E4 49 HP', '58817', '160.00', 12, 201, 'TE4', 'TE4', '49--HP--E4', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '49', 90, 17, 'D', 1020, 840, 670, 350, 175, 190, 130),
(2401, 'FTERTE465--HP--E4', 'E4 65 HP 12V 12PL 62AMP', 'E4 65 HP', 'N65L', '129.00', 12, 201, 'TE4', 'TE4', '65--HP--E4', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '65', 62, 12, 'D', 810, 680, 570, 230, 175, 215, 125),
(2402, 'FTERTE465--HPI-E4', 'E4 65 HP I 12V 12PL 62AMP', 'E4 65 HP I', '65 HP I', '129.00', 12, 201, 'TE4', 'TE4', '65--HPI-E4', 0x31, 1, 0, 0, 1, 'E3', 'HIGH POWER', '66-48', 62, 12, 'I', 0, 0, 0, 0, 0, 0, 0),
(2403, 'FTERTE466--HP--E4', 'E4 66 HP 12V 17PL 72AMP', 'E4 66 HP', '66HP', '147.00', 12, 201, 'TE4', 'TE4', '66--HP--E4', 0x31, 1, 0, 0, 1, 'E4', 'HIGH POWER', '66-48', 70, 17, 'D', 0, 0, 0, 0, 0, 0, 0),
(2407, 'FTERTE3N100 HDI-E3', 'E3 N100 HD I 12V 17PL 104AMP', 'E3 N100 HD I', 'N100', '198.00', 12, 201, 'TE3', 'TE3', 'N100 HDI-E3', 0x31, 1, 1, 1, 1, 'E3', 'HEAVY DUTY', 'N100', 104, 17, 'I', 930, 780, 650, 390, 170, 232, 177),
(2408, 'FTERTE3N100 SHDI-E3', 'E3 N100 SHD I 12V 19PL 128AMP', 'E3 N100 SHD I', 'N100A', '213.00', 12, 201, 'TE3', 'TE3', 'N100 SHDI-E3', 0x31, 1, 1, 1, 1, 'E3', 'SUPER HEAVY DUTY', 'N100', 128, 19, 'I', 1200, 1000, 840, 390, 170, 232, 250),
(2409, 'FTERTE3N120SHD--E3', 'E3 N120 SHD 12V 21PL 138AMP', 'E3 N120 SHD', 'N120L', '256.00', 12, 201, 'TE3', 'TE3', 'N120SHD--E3', 0x31, 1, 1, 1, 1, 'E3', 'SUPER HEAVY DUTY', 'N120', 138, 21, 'D', 1260, 1050, 880, 496, 180, 235, 266),
(2413, 'FTERTE3N150SHD--E3', 'E3 N150 SHD 12V 25PL 165AMP', 'E3 N150 SHD', 'N165', '303.00', 12, 201, 'TE3', 'TE3', 'N150SHD--E3', 0x31, 1, 1, 1, 1, 'E3', 'SUPER HEAVY DUTY', 'N150', 165, 25, 'D', 1510, 1260, 150, 496, 220, 236, 333),
(2414, 'FTERTE3N200SHD--E3', 'E3 N200 SHD 12V 35PL 231AMP', 'E3 N200 SHD', 'N200A', '399.00', 12, 201, 'TE3', 'TE3', 'N200SHD--E3', 0x31, 1, 1, 1, 1, 'E3', 'SUPER HEAVY DUTY', 'N200', 231, 35, 'D', 1900, 1590, 1330, 496, 260, 244, 466),
(2415, 'FTERTE327--FE -E3', 'E3 27 FE 12V 13PL 74AMP', 'E3 27 FE', 'N70L', '140.00', 12, 201, 'TE3', 'TE3', '27--FE -E3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', '27', 74, 13, 'D', 860, 720, 600, 300, 168, 224, 166),
(2416, 'FTERTE330H-FE--E3', 'E3 30H FE 12V 15PL 82AMP', 'E3 30H FE', '30H90L', '157.00', 12, 201, 'TE3', 'TE3', '30H-FE--E3', 0x31, 1, 1, 1, 1, 'E3', 'FULL EQUIPO', '30H', 82, 15, 'D', 900, 750, 630, 338, 162, 241, 182),
(2449, 'FTERTE3N200 HD--E3', 'E3 N200 HD 12V 33PL 175AMP', 'E3 N200 HD', 'N180', '333.00', 12, 201, 'TE3', 'TE3', 'N200 HD--E3', 0x31, 1, 1, 1, 1, 'E3', 'HEAVY DUTY', 'N200', 175, 33, 'D', 1620, 1350, 1130, 496, 260, 244, 400),
(2495, 'FTERTE3F65--HPI-E3', 'E3 F65 HP I 12V 15PL 95AMP', 'E3 F65 HP I', 'F65 HP I', '140.00', 12, 201, 'TE3', 'TE3', 'F65--HPI-E3', 0x31, 1, 1, 1, 1, 'E3', 'HIGH POWER', 'F65', 95, 15, 'I', 950, 800, 600, 286, 190, 192, 115),
(2496, 'FTERTE4F65--MPI-E4', 'E4 F65 MP I 12V 17PL 100AMP', 'E4 F65 MP I', 'F65 MP I', '152.00', 12, 201, 'TE4', 'TE4', 'F65--MPI-E4', 0x31, 1, 1, 1, 1, 'E4', 'MEGA POWER', 'F65', 100, 17, 'I', 1250, 920, 700, 286, 190, 192, 185),
(2933, 'MBIEMKP0004', 'ESTANTERÍAS', 'ESTANTERÍAS', '', '0.00', 12, 401, '0', 'MKP', '0004', 0x31, 1, 0, 0, 1, 'NINGUNO', 'NINGUNO', '', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(2981, 'FTERTE366--HPI-E3', 'E3 66 HP I 12V 17PL 72AMP', 'E3 66 HP I', '66 HP I', '128.00', 12, 201, 'TE3', 'TE3', '66--HPI-E3', 0x31, 1, 0, 0, 1, 'E3', 'HIGH POWER', '66-48', 0, 0, 'I', 0, 0, 0, 0, 0, 0, 0),
(2982, 'FTERTE466--HPI-E4', 'E4 66 HP I 12V 17PL 72AMP', 'E4 66 HP I', '66 HP I', '147.00', 12, 201, 'TE4', 'TE4', '66--HPI-E4', 0x31, 1, 0, 0, 1, 'E4', 'HIGH POWER', '66-48', 0, 0, 'I', 0, 0, 0, 0, 0, 0, 0),
(6569, '602HERRHEL0002', 'MIDTRONICS', '0', '', '850.00', 12, 602, '0', 'HEL', '0002', 0x31, 1, 0, 1, 1, 'NINGUNO', 'NINGUNO', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(8146, '206FTERBEJU1 HP I', 'E3 U1 HP I', 'E3 U1 HP I', 'U1 HP', '74.12', 12, 206, 'BEJ', 'BEJ', 'U1 HP I', 0x31, 1, 1, 1, 1, 'E3', 'HIGH POWER', 'U1', 22, 9, 'I', 360, 330, 275, 195, 132, 181, 30),
(8809, '206FTERBEJNS40-FE-BG', 'E3 NS40-FE-BG', 'E3 NS40-FE-BG', '', '35.00', 12, 206, 'BEJ', 'BEJ', 'NS40-FE-BG', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(8810, '206FTERBEJE3 NS40-FEI-BG', 'E3 NS40-FEI-BG', 'E3 NS40-FEI-BG', '', '35.00', 12, 206, 'BEJ', 'BEJ', 'E3 NS40-FEI-BG', 0x31, 1, 1, 1, 1, 'E3', 'STANDAR', 'NS40', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(8811, '206FTERBEJE3 NS40-ST-BG', 'E3 NS40-ST-BG', 'E3 NS40-ST-BG', '', '35.00', 12, 206, 'BEJ', 'BEJ', 'E3 NS40-ST-BG', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(8812, '206FTERBEJE3 NS40-STI-BG', 'E3 NS40-STI-BG', 'E3 NS40-STI-BG', '', '35.00', 12, 206, 'BEJ', 'BEJ', 'E3 NS40-STI-BG', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(9426, '315PLUMCLE0001', 'PLUMA 14\" CLEANTECH', 'nd', '', '8.78', 12, 315, 'CLE', 'CLE', '0001', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9427, '315PLUMCLE0002', 'PLUMA 16\" CLEANTECH', 'nd', '', '9.42', 12, 315, 'CLE', 'CLE', '0002', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9428, '315PLUMCLE0003', 'PLUMA 18\" CLEANTECH', 'nd', '', '9.84', 12, 315, 'CLE', 'CLE', '0003', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9429, '315PLUMCLE0004', 'PLUMA 19\" CLEANTECH', 'nd', '', '9.86', 12, 315, 'CLE', 'CLE', '0004', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9430, '315PLUMCLE0005', 'PLUMA 20\" CLEANTECH', 'nd', '', '10.20', 12, 315, 'CLE', 'CLE', '0005', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9431, '315PLUMCLE0006', 'PLUMA 21\" CLEANTECH', 'nd', '', '10.53', 12, 315, 'CLE', 'CLE', '0006', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9432, '315PLUMCLE0007', 'PLUMA 22\" CLEANTECH', 'nd', '', '10.77', 12, 315, 'CLE', 'CLE', '0007', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9433, '315PLUMCLE0008', 'PLUMA 24\" CLEANTECH', 'nd', '', '10.90', 12, 315, 'CLE', 'CLE', '0008', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9434, '315PLUMCLE0009', 'PLUMA 26\" CLEANTECH', 'nd', '', '12.38', 12, 315, 'CLE', 'CLE', '0009', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9435, '315PLUMEST0001', 'PLUMA 14 \" STANDARD', 'nd', '', '4.56', 12, 315, 'EST', 'EST', '0001', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9436, '315PLUMEST0002', 'PLUMA 16 \" STANDARD', 'nd', '', '5.36', 12, 315, 'EST', 'EST', '0002', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9437, '315PLUMEST0003', 'PLUMA 18 \" STANDARD PAR', 'nd', '', '10.33', 12, 315, 'EST', 'EST', '0003', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9438, '315PLUMEST0004', 'PLUMA 18 \" STANDARD', 'nd', '', '5.83', 12, 315, 'EST', 'EST', '0004', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9439, '315PLUMEST0005', 'PLUMA 19 \" STANDARD', 'nd', '', '5.85', 12, 315, 'EST', 'EST', '0005', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9440, '315PLUMEST0006', 'PLUMA 20 \" STANDARD', 'nd', '', '6.02', 12, 315, 'EST', 'EST', '0006', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9441, '315PLUMEST0007', 'PLUMA 21 \" STANDARD', 'nd', '', '6.34', 12, 315, 'EST', 'EST', '0007', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9442, '315PLUMEST0008', 'PLUMA 22 \" STANDARD', 'nd', '', '6.73', 12, 315, 'EST', 'EST', '0008', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9443, '315PLUMEST0009', 'PLUMA 24 \" STANDARD', 'nd', '', '6.82', 12, 315, 'EST', 'EST', '0009', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9444, '315PLUMEST0010', 'PLUMA 26 \" STANDARD', 'nd', '', '8.50', 12, 315, 'EST', 'EST', '0010', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9445, '315PLUMHD0001', 'PLUMA 32\" EQUIPO PESADO', 'nd', '', '36.54', 12, 315, 'HD', 'HD', '0001', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9447, '315PLUMHD0002', 'PLUMA 36\" EQUIPO PESADO', 'nd', '', '43.98', 12, 315, 'HD', 'HD', '0002', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NINGUNO', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9535, '317MERCEXH0001', 'EXHIBIDORES PARA PLUMAS', 'EXHIBIDOR PLUMAS', '', '0.00', 12, 317, '0', 'EXH', '0001', 0x31, 1, 0, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(9542, '309ACCEALU0103', 'SACHET LIMPIAPARABRISAS 10ML', 'nd', '', '0.00', 12, 309, 'ALU', 'ALU', '0103', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(9993, '317MERCEXH0012', 'EXHIBIDOR 6 BATERIAS', 'nd', '', '0.00', 12, 317, 'EXH', 'EXH', '0012', 0x31, 1, 0, 0, 1, 'NINGUNO', 'NINGUNO', '', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9994, '317MERCEXH0013', 'EXHIBIDOR 12 BATERIAS', 'nd', '', '0.00', 12, 317, 'EXH', 'EXH', '0013', 0x31, 1, 0, 0, 1, 'NINGUNO', 'NINGUNO', '', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9995, '317MERCEXH0014', 'EXHIBIDOR 24 BATERIAS', 'nd', '', '0.00', 12, 317, 'EXH', 'EXH', '0014', 0x31, 1, 0, 0, 1, 'NINGUNO', 'NINGUNO', '', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9996, '317MERCEXH0015', 'EXHIBIDOR 36 BATERIAS', 'nd', '', '0.00', 12, 317, 'EXH', 'EXH', '0015', 0x31, 1, 0, 1, 1, 'NINGUNO', 'NINGUNO', '', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(9997, '317MERCEXH0016', 'EXHIBIDOR 40 BATERIAS', 'nd', '', '0.00', 12, 317, 'EXH', 'EXH', '0016', 0x31, 1, 0, 1, 1, 'NINGUNO', 'NINGUNO', '', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(10054, '602MECAMEC1529', 'COMPROBADOR DE BATERIA  6-12 VOLTIOS', 'COMPROBADOR', '', '25.00', 12, 602, '0', 'MEC', '1529', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(10150, '201FTERTE448--HP--E4', 'E4 48 HP 12V 17PL 80AMP', 'E4 48 HP', '48 HP', '144.00', 12, 201, 'TE4', 'TE4', '48--HP--E4', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '66-48', 80, 17, 'D', 1020, 840, 670, 277, 175, 190, 130),
(10158, '201FTERTE542--HP--E5', 'E5 42 HP 12V 13PL 60AMP', 'E5 42 HP', '55560', '117.00', 12, 201, 'TE5', 'TE5', '42--HP--E5', 0x31, 1, 1, 1, 1, 'E5', 'HIGH POWER', '42', 60, 13, 'D', 660, 550, 470, 233, 147, 172, 100),
(10159, '201FTERTE542--HPI-E5', 'E5 42 HP I 12V 13PL 60AMP', 'E5 42 HP I', '55560R', '117.00', 12, 201, 'TE5', 'TE5', '42--HPI-E5', 0x31, 1, 1, 1, 1, 'E5', 'HIGH POWER', '42', 60, 13, 'I', 660, 550, 470, 233, 147, 172, 100),
(10160, '201FTERTE555--HP--E5', 'E5 55 HP 12V 14PL 63AMP', 'E5 55 HP', '55 HP', '124.00', 12, 201, 'TE5', 'TE5', '55--HP--E5', 0x31, 1, 1, 1, 1, 'E5', 'HIGH POWER', '55', 63, 14, 'D', 790, 660, 575, 240, 175, 188, 111),
(10161, '201FTERTE555--HPI-E5', 'E5 55 HP I 12V 14PL 63AMP', 'E5 55 HP I', '55 HP I', '124.00', 12, 201, 'TE5', 'TE5', '55--HPI-E5', 0x31, 1, 1, 1, 1, 'E5', 'HIGH POWER', '55', 63, 14, 'I', 790, 660, 575, 240, 175, 188, 111),
(10162, '201FTERTE566--HP--E5', 'E5 66 HP 12V 18PL 72AMP', 'E5 66 HP', '66 HP', '147.00', 12, 201, 'TE5', 'TE5', '66--HP--E5', 0x31, 1, 1, 1, 1, 'E5', 'HIGH POWER', '66-48', 72, 18, 'D', 940, 790, 660, 277, 174, 175, 133),
(10163, '201FTERTE566--HPI--E5', 'E5 66 HP I 12V 18PL 72AMP', 'E5 66 HP I', '66 HP I', '147.00', 12, 201, 'TE5', 'TE5', '66--HPI--E5', 0x31, 1, 1, 1, 1, 'E5', 'HIGH POWER', '66-48', 72, 18, 'I', 940, 790, 660, 277, 174, 175, 133),
(10164, '201FTERTE548--HP--E5', 'E5 48 HP 12V 18PL 80AMP', 'E5 48 HP', '48 HP', '149.00', 12, 201, 'TE5', 'TE5', '48--HP--E5', 0x31, 1, 1, 1, 1, 'E5', 'HIGH POWER', '66-48', 80, 18, 'D', 1020, 840, 750, 277, 175, 190, 130),
(10328, '201FTERTE455--HPT--E4', 'E4 55 HP T 12V 14PL 63AMP', 'E4 55 HP T', '55 HP T', '108.00', 12, 201, 'TE4', 'TE4', '55--HPT--E4', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '55', 63, 14, 'D', 790, 660, 575, 240, 175, 188, 111),
(10411, '201FTERTE455--HPIT--E4', 'E4 55 HP I T 12V 14PL 63AMP', 'E4 55 HP I T', '55 HP I T', '108.00', 12, 201, 'TE4', 'TE4', '55--HPIT--E4', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '55', 63, 14, 'I', 790, 660, 575, 240, 175, 188, 111),
(10683, '317MERCEXH0021', 'EXHIBIDOR RUBIX 10 BATERIAS', 'nd', '', '0.00', 12, 317, 'EXH', 'EXH', '0021', 0x31, 1, 0, 0, 1, 'NINGUNO', 'NINGUNO', '', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(10914, '317MERCEXH0023', 'EXHIBIDOR RUBIX 6 BATERIAS', 'nd', '', '0.00', 12, 317, 'EXH', 'EXH', '0023', 0x31, 1, 0, 0, 1, 'NINGUNO', 'NINGUNO', '', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(10915, '317MERCEXH0024', 'EXHIBIDOR RUBIX 12 BATERIAS', 'nd', '', '0.00', 12, 317, 'EXH', 'EXH', '0024', 0x31, 1, 1, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(10946, '213FTERRX-TITANIUM-NS40-FE', 'TITANIUM NS40 FE', 'TITANIUM NS40 FE', '', '98.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-NS40-FE', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', 'NS40', 48, 12, 'D-F', 0, 570, 440, 193, 127, 220, 77),
(10947, '213FTERRX-TITANIUM-NS40-FEI', 'TITANIUM NS40 FE I', 'TITANIUM NS40 FE I', '', '98.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-NS40-FEI', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', 'NS40', 48, 12, 'I-F', 0, 570, 440, 193, 127, 220, 77),
(10948, '213FTERRX-TITANIUM-NS40-HP', 'TITANIUM NS40 HP', 'TITANIUM NS40 HP', '', '105.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-NS40-HP', 0x30, 1, 0, 1, 1, 'E4', 'HIGH POWER', 'NS40', 0, 0, 'D-F', 0, 0, 0, 0, 0, 0, 0),
(10949, '213FTERRX-TITANIUM-NS40-HPI', 'TITANIUM NS40 HP I', 'TITANIUM NS40 HP I', '', '105.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-NS40-HPI', 0x30, 1, 0, 1, 1, 'E4', 'HIGH POWER', 'NS40', 0, 0, 'I-F', 0, 0, 0, 0, 0, 0, 0),
(10950, '213FTERRX-TITANIUM-N40-FE', 'TITANIUM N40 FE', 'TITANIUM N40 FE', '', '101.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-N40-FE', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', 'N40', 0, 11, 'D', 0, 0, 0, 0, 0, 0, 0),
(10951, '213FTERRX-TITANIUM-N40-FEI', 'TITANIUM N40 FE I', 'TITANIUM N40 FE I', '', '101.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-N40-FEI', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', 'N40', 0, 11, 'I', 0, 0, 0, 0, 0, 0, 0),
(10952, '213FTERRX-TITANIUM-N40-HP', 'TITANIUM N40 HP', 'TITANIUM N40 HP', '', '112.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-N40-HP', 0x30, 1, 0, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(10953, '213FTERRX-TITANIUM-N40-HPI', 'TITANIUM N40 HP I', 'TITANIUM N40 HP I', '', '112.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-N40-HPI', 0x30, 1, 0, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(10954, '213FTERRX-TITANIUM-36-HP', 'TITANIUM 36 HP', 'TITANIUM 36 HP', '', '106.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-36-HP', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '36', 0, 10, 'D', 0, 0, 0, 0, 0, 0, 0),
(10955, '213FTERRX-TITANIUM-42-FE', 'TITANIUM 42 FE', 'TITANIUM 42 FE', '', '110.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-42-FE', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '42', 0, 12, 'D', 0, 0, 0, 0, 0, 0, 0),
(10956, '213FTERRX-TITANIUM-42-FEI', 'TITANIUM 42 FE I', 'TITANIUM 42 FE I', '', '110.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-42-FEI', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '42', 0, 12, 'I', 0, 0, 0, 0, 0, 0, 0),
(10957, '213FTERRX-TITANIUM-42-HP', 'TITANIUM 42 HP', 'TITANIUM 42 HP', '', '118.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-42-HP', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '42', 0, 13, 'D', 0, 0, 0, 0, 0, 0, 0),
(10958, '213FTERRX-TITANIUM-42-HPI', 'TITANIUM 42 HP I', 'TITANIUM 42 HP I', '', '118.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-42-HPI', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '42', 0, 13, 'I', 0, 0, 0, 0, 0, 0, 0),
(10959, '213FTERRX-TITANIUM-42-MP', 'TITANIUM 42 MP', 'TITANIUM 42 MP', '', '127.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-42-MP', 0x31, 1, 0, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(10960, '213FTERRX-TITANIUM-42-MPI', 'TITANIUM 42 MP I', 'TITANIUM 42 MP I', '', '127.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-42-MPI', 0x30, 1, 0, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(10961, '213FTERRX-TITANIUM-55-FE', 'TITANIUM 55 FE', 'TITANIUM 55 FE', '', '114.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-55-FE', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '55', 0, 13, 'D', 0, 0, 0, 0, 0, 0, 0),
(10962, '213FTERRX-TITANIUM-55-FEI', 'TITANIUM 55 FE I', 'TITANIUM 55 FE I', '', '114.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-55-FEI', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '55', 0, 13, 'I', 0, 0, 0, 0, 0, 0, 0),
(10964, '213FTERRX-TITANIUM-55-HP', 'TITANIUM 55 HP', 'TITANIUM 55 HP', '', '125.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-55-HP', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '55', 0, 14, 'D', 0, 0, 0, 0, 0, 0, 0),
(10965, '213FTERRX-TITANIUM-55-HPI', 'TITANIUM 55 HP I', 'TITANIUM 55 HP I', '', '125.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-55-HPI', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '55', 0, 14, 'I', 0, 0, 0, 0, 0, 0, 0),
(10966, '213FTERRX-TITANIUM-65-HP', 'TITANIUM 65 HP', 'TITANIUM 65 HP', '', '138.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-65-HP', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '65', 0, 13, 'D', 0, 0, 0, 0, 0, 0, 0),
(10967, '213FTERRX-TITANIUM-65-HPI', 'TITANIUM 65 HP I', 'TITANIUM 65 HP I', '', '138.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-65-HPI', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '65', 0, 13, 'I', 0, 0, 0, 0, 0, 0, 0),
(10968, '213FTERRX-TITANIUM-66-HP', 'TITANIUM 66 HP', 'TITANIUM 66 HP', '', '147.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-66-HP', 0x31, 1, 0, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(10969, '213FTERRX-TITANIUM-66-HPI', 'TITANIUM 66 HP I', 'TITANIUM 66 HP I', '', '147.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-66-HPI', 0x31, 1, 0, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(10970, '213FTERRX-TITANIUM-48-HP', 'TITANIUM 48 HP', 'TITANIUM 48 HP', '', '140.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-48-HP', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '66-48', 0, 14, 'D', 0, 0, 0, 0, 0, 0, 0),
(10971, '213FTERRX-TITANIUM-24-HP', 'TITANIUM 24 HP', 'TITANIUM 24 HP', '', '140.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-24-HP', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '24', 0, 13, 'D', 0, 0, 0, 0, 0, 0, 0),
(10972, '213FTERRX-TITANIUM-24-HPI', 'TITANIUM 24 HP I', 'TITANIUM 24 HP I', '', '140.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-24-HPI', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '24', 0, 13, 'I', 0, 0, 0, 0, 0, 0, 0),
(10973, '213FTERRX-TITANIUM-24-MP', 'TITANIUM 24 MP', 'TITANIUM 24 MP', '', '159.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-24-MP', 0x31, 1, 1, 1, 1, 'E4', 'MEGA POWER', '24', 0, 15, 'D', 0, 0, 0, 0, 0, 0, 0),
(10974, '213FTERRX-TITANIUM-24-MPI', 'TITANIUM 24 MP I', 'TITANIUM 24 MP I', '', '159.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-24-MPI', 0x31, 1, 1, 1, 1, 'E4', 'MEGA POWER', '24', 0, 15, 'I', 0, 0, 0, 0, 0, 0, 0),
(10975, '213FTERRX-TITANIUM-34-HP', 'TITANIUM 34 HP', 'TITANIUM 34 HP', '', '145.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-34-HP', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '34', 0, 15, 'D', 0, 0, 0, 0, 0, 0, 0),
(10976, '213FTERRX-TITANIUM-34-HPI', 'TITANIUM 34 HP I', 'TITANIUM 34 HP I', '', '145.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-34-HPI', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '34', 0, 15, 'I', 0, 0, 0, 0, 0, 0, 0),
(10977, '213FTERRX-TITANIUM-34-MP', 'TITANIUM 34 MP', 'TITANIUM 34 MP', '', '159.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-34-MP', 0x31, 1, 1, 1, 1, 'E4', 'MEGA POWER', '34', 0, 17, 'D', 0, 0, 0, 0, 0, 0, 0),
(10978, '213FTERRX-TITANIUM-34-MPI', 'TITANIUM 34 MP I', 'TITANIUM 34 MP I', '', '159.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-34-MPI', 0x31, 1, 1, 1, 1, 'E4', 'MEGA POWER', '34', 0, 17, 'I', 0, 0, 0, 0, 0, 0, 0),
(10979, '213FTERRX-TITANIUM-F65-MPI', 'TITANIUM F65 MP I', 'TITANIUM F65 MP I', '', '150.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-F65-MPI', 0x31, 1, 1, 1, 1, 'E4', 'MEGA POWER', 'F65', 0, 17, 'I', 0, 0, 0, 0, 0, 0, 0),
(10980, '213FTERRX-TITANIUM-27-HP', 'TITANIUM 27 HP', 'TITANIUM 27 HP', '', '165.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-27-HP', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '27', 0, 15, 'D', 0, 0, 0, 0, 0, 0, 0),
(10981, '213FTERRX-TITANIUM-27-HPI', 'TITANIUM 27 HP I', 'TITANIUM 27 HP I', '', '165.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-27-HPI', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '27', 0, 15, 'I', 0, 0, 0, 0, 0, 0, 0),
(10982, '213FTERRX-TITANIUM-27-MP', 'TITANIUM 27 MP', 'TITANIUM 27 MP', '', '198.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-27-MP', 0x30, 1, 0, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(10983, '213FTERRX-TITANIUM-27-MPI', 'TITANIUM 27 MP I', 'TITANIUM 27 MP I', '', '198.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-27-MPI', 0x30, 1, 0, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(10984, '213FTERRX-TITANIUM-49-HP', 'TITANIUM 49 HP', 'TITANIUM 49 HP', '', '150.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-49-HP', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '49', 0, 17, 'D', 0, 0, 0, 0, 0, 0, 0),
(10985, '213FTERRX-TITANIUM-30H-FE', 'TITANIUM 30H FE', 'TITANIUM 30H FE', '', '165.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-30H-FE', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '30H', 0, 15, 'D', 0, 0, 0, 0, 0, 0, 0),
(10986, '213FTERRX-TITANIUM-30H-FEI', 'TITANIUM 30H FE I', 'TITANIUM 30H FE I', '', '165.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-30H-FEI', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '30H', 0, 15, 'I', 0, 0, 0, 0, 0, 0, 0),
(10987, '213FTERRX-TITANIUM-30H-HD', 'TITANIUM 30H HD', 'TITANIUM 30H HD', '', '182.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-30H-HD', 0x31, 1, 1, 1, 1, 'E4', 'HEAVY DUTY', '30H', 0, 17, 'D', 0, 0, 0, 0, 0, 0, 0),
(10988, '213FTERRX-TITANIUM-30H-HDI', 'TITANIUM 30H HD I', 'TITANIUM 30H HD I', '', '182.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-30H-HDI', 0x31, 1, 1, 1, 1, 'E4', 'HIGH POWER', '30H', 0, 17, 'I', 0, 0, 0, 0, 0, 0, 0),
(10989, '213FTERRX-TITANIUM-31-HD I', 'TITANIUM 31 HD I', 'TITANIUM 31 HD I', '', '190.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-31-HD I', 0x31, 1, 1, 1, 1, 'E4', 'HEAVY DUTY', '31', 0, 17, 'P-I', 0, 0, 0, 0, 0, 0, 0),
(10990, '213FTERRX-TITANIUM-N100-SHDI', 'TITANIUM N100 SHD I', 'TITANIUM N100 SHD I', '', '225.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-N100-SHDI', 0x31, 1, 1, 1, 1, 'E4', 'SUPER HEAVY DUTY', 'N100', 0, 20, 'I', 0, 0, 0, 0, 0, 0, 0),
(10991, '213FTERRX-TITANIUM-N150-SHD', 'TITANIUM N150 SHD', 'TITANIUM N150 SHD', '', '298.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-N150-SHD', 0x31, 1, 1, 1, 1, 'E4', 'SUPER HEAVY DUTY', 'N150', 0, 25, 'D', 0, 0, 0, 0, 0, 0, 0),
(10992, '213FTERRX-TITANIUM-N200-HD', 'TITANIUM N200 HD', 'TITANIUM N200 HD', '', '351.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-N200-HD', 0x31, 1, 1, 1, 1, 'E4', 'HEAVY DUTY', 'N200', 0, 33, 'D', 0, 0, 0, 0, 0, 0, 0),
(10995, '213FTERR5-TITANIUM-R5-55-HP', 'TITANIUM R5 55 HP', 'TITANIUM R5 55 HP', '', '132.00', 12, 213, 'R5-', 'R5-', 'TITANIUM-R5-55-HP', 0x30, 0, 0, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(10996, '213FTERR5-TITANIUM-R5-55-HPI', 'TITANIUM R5 55 HP I', 'TITANIUM R5 55 HP I', '', '132.00', 12, 213, 'R5-', 'R5-', 'TITANIUM-R5-55-HPI', 0x30, 0, 0, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(10997, '213FTERR5-TITANIUM-R5-66-HP', 'TITANIUM R5 66 HP', 'TITANIUM R5 66 HP', '', '152.00', 12, 213, 'R5-', 'R5-', 'TITANIUM-R5-66-HP', 0x31, 0, 0, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(10998, '213FTERR5-TITANIUM-R5-66-HPI', 'TITANIUM R5 66 HP I', 'TITANIUM R5 66 HP I', '', '152.00', 12, 213, 'R5-', 'R5-', 'TITANIUM-R5-66-HPI', 0x31, 0, 0, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(10999, '213FTERR5-TITANIUM-R5-48-HP', 'TITANIUM R5 48 HP', 'TITANIUM R5 48 HP', '', '146.00', 12, 213, 'R5-', 'R5-', 'TITANIUM-R5-48-HP', 0x31, 0, 0, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(11254, '317MERCEXH0025', 'EXHIBIDORES PEQUEÑOS PARA PLUMAS', 'nd', '', '0.00', 12, 317, 'EXH', 'EXH', '0025', 0x31, 1, 0, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(11326, '317MERCARP1301', 'COMATEX RUBIX', 'nd', '', '0.00', 12, 317, 'ARP', 'ARP', '1301', 0x31, 1, 0, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(11610, '317MERCEXH0026', 'ESTANTERIA 6 BANDEJAS RUBIX', 'nd', '', '0.00', 12, 317, 'EXH', 'EXH', '0026', 0x31, 1, 0, 0, 1, 'NINGUNO', 'NINGUNO', '', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(11636, '213FTERRX-TITANIUM-NS40-ST', 'TITANIUM NS40 ST', 'TITANIUM NS40 ST', '', '91.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-NS40-ST', 0x31, 1, 1, 1, 1, 'E4', 'STANDAR', 'NS40', 45, 11, 'D-F', 0, 500, 390, 193, 127, 220, 75),
(11637, '213FTERRX-TITANIUM-NS40-STI', 'TITANIUM NS40 ST I', 'TITANIUM NS40 ST I', '', '91.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-NS40-STI', 0x31, 1, 1, 1, 1, 'E4', 'STANDAR', 'NS40', 45, 11, 'I-F', 0, 500, 390, 193, 127, 220, 75),
(11638, '213FTERRX-TITANIUM-N40-FEIF', 'TITANIUM N40 FE I F', 'TITANIUM N40 FE I F', '', '101.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-N40-FEIF', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', 'N40', 0, 11, 'I-F', 0, 0, 0, 0, 0, 0, 0),
(11639, '213FTERRX-TITANIUM-42-ST', 'TITANIUM 42 ST', 'TITANIUM 42 ST', '', '97.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-42-ST', 0x31, 1, 1, 1, 1, 'E4', 'STANDAR', '42', 0, 10, 'D', 0, 0, 0, 0, 0, 0, 0),
(11640, '213FTERRX-TITANIUM-42-STI', 'TITANIUM 42 ST I', 'TITANIUM 42 ST I', '', '97.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-42-STI', 0x31, 1, 1, 1, 1, 'E4', 'STANDAR', '42', 0, 10, 'I', 0, 0, 0, 0, 0, 0, 0),
(11641, '213FTERRX-TITANIUM-66-FE', 'TITANIUM 66 FE', 'TITANIUM 66 FE', '', '130.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-66-FE', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '66-48', 0, 15, 'D', 0, 0, 0, 0, 0, 0, 0),
(11642, '213FTERRX-TITANIUM-66-FEI', 'TITANIUM 66 FE I', 'TITANIUM 66 FE I', '', '130.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-66-FEI', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '66-48', 0, 15, 'I', 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `productos` (`idProducto`, `codigoProducto`, `nombreProducto`, `nombreCorto`, `codigoListaPrecio`, `precioUnitario`, `iva`, `codigoLinea`, `codigoFamilia`, `codigoSubfamilia`, `codigoClase`, `estadoProd`, `facturar`, `web`, `promocion`, `electronico`, `tipo`, `modelo`, `caja`, `capacidad`, `equivalencia`, `polaridad`, `potencia27`, `potencia0`, `potencia18`, `largo`, `ancho`, `alto`, `capacReserva`) VALUES
(11643, '213FTERRX-TITANIUM-24-ST', 'TITANIUM 24 ST', 'TITANIUM 24 ST', '', '106.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-24-ST', 0x31, 1, 1, 1, 1, 'E4', 'STANDAR', '24', 0, 9, 'D', 0, 0, 0, 0, 0, 0, 0),
(11644, '213FTERRX-TITANIUM-24-STI', 'TITANIUM 24 ST I', 'TITANIUM 24 ST I', '', '106.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-24-STI', 0x31, 1, 1, 1, 1, 'E4', 'STANDAR', '24', 0, 9, 'I', 0, 0, 0, 0, 0, 0, 0),
(11645, '213FTERRX-TITANIUM-24-FE', 'TITANIUM 24 FE', 'TITANIUM 24 FE', '', '123.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-24-FE', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '24', 0, 11, 'D', 0, 0, 0, 0, 0, 0, 0),
(11646, '213FTERRX-TITANIUM-24-FEI', 'TITANIUM 24 FE I', 'TITANIUM 24 FE I', '', '123.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-24-FEI', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '24', 0, 11, 'I', 0, 0, 0, 0, 0, 0, 0),
(11647, '213FTERRX-TITANIUM-34-FE', 'TITANIUM 34 FE', 'TITANIUM 34 FE', '', '135.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-34-FE', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '34', 0, 13, 'D', 0, 0, 0, 0, 0, 0, 0),
(11648, '213FTERRX-TITANIUM-34-FEI', 'TITANIUM 34 FE I', 'TITANIUM 34 FE I', '', '135.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-34-FEI', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '34', 0, 13, 'I', 0, 0, 0, 0, 0, 0, 0),
(11650, '213FTERRX-TITANIUM-27-FE', 'TITANIUM 27 FE', 'TITANIUM 27 FE', '', '152.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-27-FE', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '27', 0, 13, 'D', 0, 0, 0, 0, 0, 0, 0),
(11651, '213FTERRX-TITANIUM-27-FEI', 'TITANIUM 27 FE I', 'TITANIUM 27 FE I', '', '152.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-27-FEI', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '27', 0, 13, 'I', 0, 0, 0, 0, 0, 0, 0),
(11652, '213FTERRX-TITANIUM-N100-HDI', 'TITANIUM N100 HD I', 'TITANIUM N100 HD I', '', '208.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-N100-HDI', 0x31, 1, 1, 1, 1, 'E4', 'HEAVY DUTY', 'N100', 0, 19, 'I', 0, 0, 0, 0, 0, 0, 0),
(11653, '213FTERRX-TITANIUM-N120-SHD', 'TITANIUM N120 SHD', 'TITANIUM N120 SHD', '', '260.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-N120-SHD', 0x31, 1, 1, 1, 1, 'E4', 'SUPER HEAVY DUTY', 'N120', 0, 21, 'D', 0, 0, 0, 0, 0, 0, 0),
(11654, '213FTERRX-TITANIUM-4DLT-HD', 'TITANIUM 4DLT HD', 'TITANIUM 4DLT HD', '', '255.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-4DLT-HD', 0x31, 1, 1, 1, 1, 'E4', 'HEAVY DUTY', '4DLT', 0, 23, 'D', 0, 0, 0, 0, 0, 0, 0),
(11655, '213FTERRX-TITANIUM-N150-HD', 'TITANIUM N150 HD', 'TITANIUM N150 HD', '', '267.00', 12, 213, 'RX-', 'RX-', 'TITANIUM-N150-HD', 0x31, 1, 1, 1, 1, 'E3', 'HEAVY DUTY', 'N150', 0, 23, 'D', 0, 0, 0, 0, 0, 0, 0),
(11824, '317MERCARP1310', 'COMATEX RUBIX 55.04X90 CM', 'nd', '', '0.00', 12, 317, 'ARP', 'ARP', '1310', 0x31, 1, 0, 0, 1, 'NINGUNO', 'NINGUNO', '', 0, 0, 'NINGUNO', 0, 0, 0, 0, 0, 0, 0),
(12211, '201FTERTE34DLT--HDI--E3', 'E3 4DLT HD I 12V 23PL 124AMP', 'E3 4DLT HD I', '4 DLT HD I', '249.00', 12, 201, 'TE3', 'TE3', '4DLT--HDI--E3', 0x31, 1, 1, 1, 1, 'E3', 'HEAVY DUTY', '4DLT', 124, 23, 'I', 1180, 990, 830, 496, 220, 210, 242),
(12216, '201FTERTE424--FE--E4', 'E4 24 FE 12V 11PL 54AMP', 'E4 24 FE', 'N50ZL', '114.00', 12, 201, 'TE4', 'TE4', '24--FE--E4', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '24', 54, 11, 'D', 620, 520, 440, 255, 170, 224, 117),
(12217, '201FTERTE424--FEI--E4', 'E4 24 FE I 12V 11PL 54AMP', 'E4 24 FE I', 'N50Z', '114.00', 12, 201, 'TE4', 'TE4', '24--FEI--E4', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '24', 54, 11, 'I', 620, 520, 440, 255, 170, 224, 117),
(12220, '201FTERTE434--FE--E4', 'E4 34 FE 12V 13PL 61AMP', 'E4 34 FE', 'NS70BL', '124.00', 12, 201, 'TE4', 'TE4', '34--FE--E4', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '34', 61, 13, 'D', 750, 630, 530, 255, 170, 200, 122),
(12221, '201FTERTE434--FEI--E4', 'E4 34 FE I 12V 13PL 61AMP', 'E4 34 FE I', 'NS70B', '124.00', 12, 201, 'TE4', 'TE4', '34--FEI--E4', 0x31, 1, 1, 1, 1, 'E4', 'FULL EQUIPO', '34', 0, 0, 'I', 0, 0, 0, 0, 0, 0, 0),
(12283, '201FTERTE348--HP--E3', 'E3 48 HP 12V 17PL 80AMP', 'E3 48 HP', '48 HP', '140.00', 12, 201, 'TE3', 'TE3', '48--HP--E3', 0x31, 1, 1, 1, 1, 'E3', 'HIGH POWER', '66-48', 80, 17, 'D', 1020, 840, 670, 277, 175, 190, 130),
(12367, '317MERCEXH0027', 'ESTANTERIA 6 BANDEJAS BATERIAS ECUADOR', 'nd', '', '0.00', 12, 317, 'EXH', 'EXH', '0027', 0x31, 1, 0, 0, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13388, '317MERCEXH0005', 'EXHIBIDOR HELLA 10 BATERIAS', '0', '', '0.00', 12, 317, '0', 'EXH', '0005', 0x31, 1, 1, 0, 1, 'E3', 'STANDAR', 'NS40', 0, 0, 'I', 0, 0, 0, 0, 0, 0, 0),
(13389, '317MERCEXH0004', 'EXHIBIDOR HELLA 6 BATERIAS', 'nd', '', '0.00', 12, 317, '0', 'EXH', '0004', 0x31, 1, 1, 0, 1, 'NINGUNO', 'STANDAR', 'NS40', 0, 0, 'I', 0, 0, 0, 0, 0, 0, 0),
(13408, '218FTERH4-HELLA-NS40-HP', 'HELLA NS40 HP', 'HELLA NS40 HP', '', '91.00', 12, 218, '0', 'H4-', 'HELLA-NS40-HP', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13409, '218FTERH4-HELLA-NS40-HPI', 'HELLA NS40 HP I', 'HELLA NS40 HP I', '', '91.00', 12, 218, '0', 'H4-', 'HELLA-NS40-HPI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13410, '218FTERH4-HELLA-N40-FE', 'HELLA N40 FE', 'HELLA N40 FE', '', '96.00', 12, 218, '0', 'H4-', 'HELLA-N40-FE', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13411, '218FTERH4-HELLA-N40-FEI', 'HELLA N40 FE I', 'HELLA N40 FE I', '', '96.00', 12, 218, '0', 'H4-', 'HELLA-N40-FEI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13412, '218FTERH4-HELLA-36-HP', 'HELLA 36 HP', 'HELLA 36 HP', '', '104.00', 12, 218, '0', 'H4-', 'HELLA-36-HP', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13413, '218FTERH4-HELLA-42-ST', 'HELLA 42 ST', 'HELLA 42 ST', '', '91.00', 12, 218, '0', 'H4-', 'HELLA-42-ST', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13414, '218FTERH4-HELLA-42-STI', 'HELLA 42 ST I', 'HELLA 42 ST I', '', '91.00', 12, 218, '0', 'H4-', 'HELLA-42-STI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13415, '218FTERH4-HELLA-42-FE', 'HELLA 42 FE', 'HELLA 42 FE', '', '101.00', 12, 218, '0', 'H4-', 'HELLA-42-FE', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13416, '218FTERH4-HELLA-42-FEI', 'HELLA 42 FE I', 'HELLA 42 FE I', '', '101.00', 12, 218, '0', 'H4-', 'HELLA-42-FEI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13417, '218FTERH4-HELLA-42-HP', 'HELLA 42 HP', 'HELLA 42 HP', '', '110.00', 12, 218, '0', 'H4-', 'HELLA-42-HP', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13418, '218FTERH4-HELLA-42-HPI', 'HELLA 42 HP I', 'HELLA 42 HP I', '', '110.00', 12, 218, '0', 'H4-', 'HELLA-42-HPI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13419, '218FTERH4-HELLA-55-FE', 'HELLA 55 FE', 'HELLA 55 FE', '', '110.00', 12, 218, '0', 'H4-', 'HELLA-55-FE', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13420, '218FTERH4-HELLA-55-FEI', 'HELLA 55 FE I', 'HELLA 55 FE I', '', '110.00', 12, 218, '0', 'H4-', 'HELLA-55-FEI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13421, '218FTERH4-HELLA-55-HP', 'HELLA 55 HP', 'HELLA 55 HP', '', '121.50', 12, 218, '0', 'H4-', 'HELLA-55-HP', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13422, '218FTERH4-HELLA-55-HPI', 'HELLA 55 HP I', 'HELLA 55 HP I', '', '121.50', 12, 218, '0', 'H4-', 'HELLA-55-HPI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13423, '218FTERH4-HELLA-65-HP', 'HELLA 65 HP', 'HELLA 65 HP', '', '130.00', 12, 218, '0', 'H4-', 'HELLA-65-HP', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13424, '218FTERH4-HELLA-F65-HPI', 'HELLA F65 HP I', 'HELLA F65 HP I', '', '150.00', 12, 218, '0', 'H4-', 'HELLA-F65-HPI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13425, '218FTERH4-HELLA-F65-MPI', 'HELLA F65 MP I', 'HELLA F65 MP I', '', '180.00', 12, 218, '0', 'H4-', 'HELLA-F65-MPI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13426, '218FTERH4-HELLA-66-HP', 'HELLA 66 HP', 'HELLA 66 HP', '', '127.50', 12, 218, '0', 'H4-', 'HELLA-66-HP', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13427, '218FTERH4-HELLA-66-HPI', 'HELLA 66 HP I', 'HELLA 66 HP I', '', '127.50', 12, 218, '0', 'H4-', 'HELLA-66-HPI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13428, '218FTERH4-HELLA-48-HP', 'HELLA 48 HP', 'HELLA 48 HP', '', '145.00', 12, 218, '0', 'H4-', 'HELLA-48-HP', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13429, '218FTERH4-HELLA-24-FE', 'HELLA 24 FE', 'HELLA 24 FE', '', '115.00', 12, 218, '0', 'H4-', 'HELLA-24-FE', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13430, '218FTERH4-HELLA-24-FEI', 'HELLA 24 FE I', 'HELLA 24 FE I', '', '115.00', 12, 218, '0', 'H4-', 'HELLA-24-FEI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13431, '218FTERH4-HELLA-24-HP', 'HELLA 24 HP', 'HELLA 24 HP', '', '132.00', 12, 218, '0', 'H4-', 'HELLA-24-HP', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13432, '218FTERH4-HELLA-24-HPI', 'HELLA 24 HP I', 'HELLA 24 HP I', '', '132.00', 12, 218, '0', 'H4-', 'HELLA-24-HPI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13433, '218FTERH4-HELLA-24-MP', 'HELLA 24 MP', 'HELLA 24 MP', '', '155.00', 12, 218, '0', 'H4-', 'HELLA-24-MP', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13434, '218FTERH4-HELLA-24-MPI', 'HELLA 24 MP I', 'HELLA 24 MP I', '', '155.00', 12, 218, '0', 'H4-', 'HELLA-24-MPI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13435, '218FTERH4-HELLA-34-FE', 'HELLA 34 FE', 'HELLA 34 FE', '', '125.00', 12, 218, '0', 'H4-', 'HELLA-34-FE', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13436, '218FTERH4-HELLA-34-FEI', 'HELLA 34 FE I', 'HELLA 34 FE I', '', '125.00', 12, 218, '0', 'H4-', 'HELLA-34-FEI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13437, '218FTERH4-HELLA-34-HP', 'HELLA 34 HP', 'HELLA 34 HP', '', '135.00', 12, 218, '0', 'H4-', 'HELLA-34-HP', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13438, '218FTERH4-HELLA-34-HPI', 'HELLA 34 HP I', 'HELLA 34 HP I', '', '135.00', 12, 218, '0', 'H4-', 'HELLA-34-HPI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13439, '218FTERH4-HELLA-27-FE', 'HELLA 27 FE', 'HELLA 27 FE', '', '157.00', 12, 218, '0', 'H4-', 'HELLA-27-FE', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13440, '218FTERH4-HELLA-27-FEI', 'HELLA 27 FE I', 'HELLA 27 FE I', '', '157.00', 12, 218, '0', 'H4-', 'HELLA-27-FEI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13441, '218FTERH4-HELLA-27-HP', 'HELLA 27 HP', 'HELLA 27 HP', '', '162.00', 12, 218, '0', 'H4-', 'HELLA-27-HP', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13442, '218FTERH4-HELLA-27-HPI', 'HELLA 27 HP I', 'HELLA 27 HP I', '', '162.00', 12, 218, '0', 'H4-', 'HELLA-27-HPI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13443, '218FTERH4-HELLA-49-HP', 'HELLA 49 HP', 'HELLA 49 HP', '', '190.00', 12, 218, '0', 'H4-', 'HELLA-49-HP', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13444, '218FTERH4-HELLA-30H-FEI', 'HELLA 30H FE I', 'HELLA 30H FE I', '', '158.00', 12, 218, '0', 'H4-', 'HELLA-30H-FEI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13445, '218FTERH4-HELLA-30H-HDI', 'HELLA 30H HD I', 'HELLA 30H HD I', '', '175.00', 12, 218, '0', 'H4-', 'HELLA-30H-HDI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13446, '218FTERH4-HELLA-31-HDI', 'HELLA 31 HD I', 'HELLA 31 HD I', '', '175.00', 12, 218, '0', 'H4-', 'HELLA-31-HDI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13447, '218FTERH4-HELLA-N100-HDI', 'HELLA N100 HD I', 'HELLA N100 HD I', '', '198.00', 12, 218, '0', 'H4-', 'HELLA-N100-HDI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13448, '218FTERH4-HELLA-N100-SHDI', 'HELLA N100 SHD I', 'HELLA N100 SHD I', '', '213.00', 12, 218, '0', 'H4-', 'HELLA-N100-SHDI', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13449, '218FTERH4-HELLA-N120-SHD', 'HELLA N120 SHD', 'HELLA N120 SHD', '', '256.00', 12, 218, '0', 'H4-', 'HELLA-N120-SHD', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13450, '218FTERH4-HELLA-N150-FE', 'HELLA N150 FE', 'HELLA N150 FE', '', '255.00', 12, 218, '0', 'H4-', 'HELLA-N150-FE', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13451, '218FTERH4-HELLA-N150-HD', 'HELLA N150 HD', 'HELLA N150 HD', '', '265.00', 12, 218, '0', 'H4-', 'HELLA-N150-HD', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13452, '218FTERH4-HELLA-N150-SHD', 'HELLA N150 SHD', 'HELLA N150 SHD', '', '303.00', 12, 218, '0', 'H4-', 'HELLA-N150-SHD', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0),
(13453, '218FTERH4-HELLA-N200-HD', 'HELLA N200 HD', 'HELLA N200 HD', '', '335.00', 12, 218, '0', 'H4-', 'HELLA-N200-HD', 0x31, 1, 1, 1, 1, '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `codigoPromocion` int(11) NOT NULL DEFAULT 0,
  `numeroUnidBase` int(4) DEFAULT 0,
  `porcentaje` double DEFAULT 0,
  `nombre` varchar(50) DEFAULT '0',
  `numeroUnidProm` int(4) DEFAULT 0,
  `tolerancia` int(4) DEFAULT 0,
  `estadoPromocion` binary(1) DEFAULT '1',
  `numeroPromocion` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`codigoPromocion`, `numeroUnidBase`, `porcentaje`, `nombre`, `numeroUnidProm`, `tolerancia`, `estadoPromocion`, `numeroPromocion`) VALUES
(442809, 15, 6.66, 'Promoción # 2 ( 15 + 1 )', 1, 1, 0x31, 2),
(894354, 12, 8.33, 'Promoción # 1 ( 12 + 1 )', 1, 1, 0x31, 1),
(941604, 10, 10, 'Promoción # 3 ( 10 + 1 )', 1, 1, 0x31, 3),
(1016371, 0, 0, 'NINGUNA', 0, 0, 0x31, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp`
--

CREATE TABLE `tmp` (
  `id_tmp` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_tmp` int(11) NOT NULL,
  `precio_tmp` double(8,2) DEFAULT NULL,
  `session_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `promo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tmp`
--

INSERT INTO `tmp` (`id_tmp`, `id_producto`, `cantidad_tmp`, `precio_tmp`, `session_id`, `promo`) VALUES
(0, 1790, 8, 91.00, '0102403474001', 0),
(0, 12221, 4, 124.00, '0102403474001', 0),
(0, 12221, 4, 124.00, '0102403474001', 0),
(0, 1787, 7, 94.00, '0102403474001', 0),
(0, 1043, 100, 7.00, '0102403474001', 0),
(0, 1117, 40, 3.00, '0102403474001', 0),
(0, 1790, 8, 91.00, '0102403474001', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`codigoCliente`),
  ADD KEY `FK_clientes_promociones` (`codigoPromo1`),
  ADD KEY `FK_clientes_promociones_2` (`codigoPromo2`),
  ADD KEY `FK_clientes_promociones_3` (`codigoPromo3`),
  ADD KEY `FK_clientes_listaprecios` (`codigoLisPre`);

--
-- Indices de la tabla `descuentoclientelinea`
--
ALTER TABLE `descuentoclientelinea`
  ADD PRIMARY KEY (`codigoDesCL`),
  ADD KEY `FK_descuentoclientelinea_clientes` (`codigoCliente`),
  ADD KEY `FK_descuentoclientelinea_listalinea` (`codigoLinea`);

--
-- Indices de la tabla `descuentoclienteproducto`
--
ALTER TABLE `descuentoclienteproducto`
  ADD PRIMARY KEY (`codigoDesCP`),
  ADD KEY `FK_descuentoclienteproducto_clientes` (`codigoCliente`),
  ADD KEY `FK_descuentoclienteproducto_productos` (`idProducto`);

--
-- Indices de la tabla `descuentolistaprecios`
--
ALTER TABLE `descuentolistaprecios`
  ADD PRIMARY KEY (`codigoDesLP`),
  ADD KEY `FK_descuentolistaprecios_productos` (`idProducto`),
  ADD KEY `FK_descuentolistaprecios_listaprecios` (`codigoLisPre`);

--
-- Indices de la tabla `listalinea`
--
ALTER TABLE `listalinea`
  ADD PRIMARY KEY (`codigoLinea`);

--
-- Indices de la tabla `listaprecios`
--
ALTER TABLE `listaprecios`
  ADD PRIMARY KEY (`codigoLisPre`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `FK_productos_listalinea` (`codigoLinea`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`codigoPromocion`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `FK_clientes_listaprecios` FOREIGN KEY (`codigoLisPre`) REFERENCES `listaprecios` (`codigoLisPre`),
  ADD CONSTRAINT `FK_clientes_promociones` FOREIGN KEY (`codigoPromo1`) REFERENCES `promociones` (`codigoPromocion`),
  ADD CONSTRAINT `FK_clientes_promociones_2` FOREIGN KEY (`codigoPromo2`) REFERENCES `promociones` (`codigoPromocion`),
  ADD CONSTRAINT `FK_clientes_promociones_3` FOREIGN KEY (`codigoPromo3`) REFERENCES `promociones` (`codigoPromocion`);

--
-- Filtros para la tabla `descuentoclientelinea`
--
ALTER TABLE `descuentoclientelinea`
  ADD CONSTRAINT `FK_descuentoclientelinea_clientes` FOREIGN KEY (`codigoCliente`) REFERENCES `clientes` (`codigoCliente`),
  ADD CONSTRAINT `FK_descuentoclientelinea_listalinea` FOREIGN KEY (`codigoLinea`) REFERENCES `listalinea` (`codigoLinea`);

--
-- Filtros para la tabla `descuentoclienteproducto`
--
ALTER TABLE `descuentoclienteproducto`
  ADD CONSTRAINT `FK_descuentoclienteproducto_clientes` FOREIGN KEY (`codigoCliente`) REFERENCES `clientes` (`codigoCliente`),
  ADD CONSTRAINT `FK_descuentoclienteproducto_productos` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

--
-- Filtros para la tabla `descuentolistaprecios`
--
ALTER TABLE `descuentolistaprecios`
  ADD CONSTRAINT `FK_descuentolistaprecios_listaprecios` FOREIGN KEY (`codigoLisPre`) REFERENCES `listaprecios` (`codigoLisPre`),
  ADD CONSTRAINT `FK_descuentolistaprecios_productos` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `FK_productos_listalinea` FOREIGN KEY (`codigoLinea`) REFERENCES `listalinea` (`codigoLinea`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
