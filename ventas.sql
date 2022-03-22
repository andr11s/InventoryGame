-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 12-05-2018 a las 20:38:14
-- Versión del servidor: 5.7.21
-- Versión de PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `nombreAdmin` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `rol` varchar(50) NOT NULL,
  `intentos` int(11) NOT NULL DEFAULT '0',
  `fechaCreado` varchar(15) NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`idAdmin`, `nombreAdmin`, `password`, `rol`, `intentos`, `fechaCreado`) VALUES
(1, 'jeffrey', 'Admin321', 'Administrador', 0, '2018-05-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCategoria` varchar(50) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nombreCategoria`) VALUES
(12, 'Vacuno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
CREATE TABLE IF NOT EXISTS `ciudad` (
  `idCiudad` int(11) NOT NULL,
  `nombreCiudad` varchar(60) NOT NULL,
  `codPostal` int(4) NOT NULL,
  `idProvincia` int(11) NOT NULL,
  PRIMARY KEY (`idCiudad`),
  KEY `codPostal` (`codPostal`),
  KEY `FK_ciudad_provincia` (`idProvincia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`idCiudad`, `nombreCiudad`, `codPostal`, `idProvincia`) VALUES
(1, 'Valledupar', 5555, 70);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCliente` varchar(150) NOT NULL,
  `apellidoCliente` varchar(150) NOT NULL,
  `idProvincia` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `usuarioCliente` varchar(50) NOT NULL,
  `passwordCliente` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `emailCliente` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `idCiudad` int(11) NOT NULL,
  `cuit` int(11) NOT NULL,
  PRIMARY KEY (`idCliente`),
  KEY `FK_clientes_provincia` (`idProvincia`),
  KEY `FK_clientes_ciudad` (`idCiudad`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nombreCliente`, `apellidoCliente`, `idProvincia`, `estado`, `usuarioCliente`, `passwordCliente`, `telefono`, `emailCliente`, `direccion`, `idCiudad`, `cuit`) VALUES
(13, 'Jeffrey', 'Maestre', 70, 1, 'ing jeffrey', 'A123456', '3017201979', 'jalejandromaestre@unicesar.edu.co', 'diagonal 20b #25a 47', 1, 1063333333);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles`
--

DROP TABLE IF EXISTS `detalles`;
CREATE TABLE IF NOT EXISTS `detalles` (
  `idDetalle` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `fechaVenta` date NOT NULL,
  `precioVenta` double NOT NULL,
  `cantidadKilos` int(11) NOT NULL,
  `totalVenta` double NOT NULL,
  `numFac` int(110) NOT NULL,
  `tipoFactura` varchar(5) NOT NULL,
  PRIMARY KEY (`idDetalle`),
  KEY `FK_detalles_clientes` (`idCliente`),
  KEY `FK_detalles_productos` (`idProducto`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalles`
--

INSERT INTO `detalles` (`idDetalle`, `idCliente`, `idProducto`, `fechaVenta`, `precioVenta`, `cantidadKilos`, `totalVenta`, `numFac`, `tipoFactura`) VALUES
(6, 13, 3, '2018-05-12', 20000, 1, 20000, 3, 'A'),
(5, 13, 4, '2018-05-12', 20000, 2, 40000, 2, 'A'),
(4, 13, 3, '2018-05-11', 20000, 1, 20000, 1, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE IF NOT EXISTS `factura` (
  `idFactura` int(11) NOT NULL AUTO_INCREMENT,
  `numFac` int(110) NOT NULL,
  `fechaVenta` date NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idAdmin` int(11) NOT NULL,
  `totalVenta` double NOT NULL,
  `tipoFactura` varchar(50) NOT NULL,
  PRIMARY KEY (`idFactura`),
  KEY `FK_factura_clientes` (`idCliente`),
  KEY `FK_factura_administrador` (`idAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idFactura`, `numFac`, `fechaVenta`, `idCliente`, `idAdmin`, `totalVenta`, `tipoFactura`) VALUES
(59, 1, '2018-05-11', 13, 1, 20000, 'A'),
(60, 2, '2018-05-12', 13, 1, 40000, 'A'),
(61, 3, '2018-05-12', 13, 1, 20000, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

DROP TABLE IF EXISTS `inventario`;
CREATE TABLE IF NOT EXISTS `inventario` (
  `idInventario` int(11) NOT NULL AUTO_INCREMENT,
  `cantidadIngresada` int(11) NOT NULL,
  `precioVenta` double NOT NULL,
  `idProducto` int(11) NOT NULL,
  PRIMARY KEY (`idInventario`),
  KEY `FK_inventario_productos` (`idProducto`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`idInventario`, `cantidadIngresada`, `precioVenta`, `idProducto`) VALUES
(3, 0, 20000, 3),
(4, 0, 20000, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pass`
--

DROP TABLE IF EXISTS `pass`;
CREATE TABLE IF NOT EXISTS `pass` (
  `idpass` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(50) NOT NULL,
  `idAdmin` int(11) NOT NULL,
  PRIMARY KEY (`idpass`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pass`
--

INSERT INTO `pass` (`idpass`, `password`, `idAdmin`) VALUES
(1, 'Admin321', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombreProducto` varchar(50) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `precioProducto` double NOT NULL,
  `idCategoria` int(11) NOT NULL,
  PRIMARY KEY (`idProducto`),
  KEY `FK_productos_categorias` (`idCategoria`),
  KEY `FK_productos_proveedores` (`idProveedor`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombreProducto`, `idProveedor`, `precioProducto`, `idCategoria`) VALUES
(3, 'Lomo Liso', 18, 20000, 12),
(4, 'cafe', 18, 400000, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `idProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombreProveedor` varchar(100) NOT NULL,
  `apellidoProveedor` varchar(100) NOT NULL,
  `nombreEmpresa` varchar(100) DEFAULT NULL,
  `telefonoProveedor` varchar(100) NOT NULL,
  `direccionProveedor` varchar(100) NOT NULL,
  `idCiudad` int(11) NOT NULL,
  PRIMARY KEY (`idProveedor`),
  KEY `FK_proveedores_ciudad` (`idCiudad`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idProveedor`, `nombreProveedor`, `apellidoProveedor`, `nombreEmpresa`, `telefonoProveedor`, `direccionProveedor`, `idCiudad`) VALUES
(18, 'Prueba', 'Proveedor', 'Carnes Vitello', '123456789', 'En/Alguna/Parte', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

DROP TABLE IF EXISTS `provincia`;
CREATE TABLE IF NOT EXISTS `provincia` (
  `idProvincia` int(11) NOT NULL,
  `nombreProvincia` varchar(50) NOT NULL,
  PRIMARY KEY (`idProvincia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`idProvincia`, `nombreProvincia`) VALUES
(70, 'Cesar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp`
--

DROP TABLE IF EXISTS `temp`;
CREATE TABLE IF NOT EXISTS `temp` (
  `idTemp` int(11) NOT NULL AUTO_INCREMENT,
  `idProducto` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `precioVenta` double NOT NULL,
  `cantidad` int(11) NOT NULL,
  `iva` double NOT NULL,
  `totalVenta` double NOT NULL,
  `numFac` int(11) NOT NULL,
  `fechaVenta` date NOT NULL,
  `unidad` int(11) NOT NULL,
  `tipoFactura` varchar(5) NOT NULL,
  PRIMARY KEY (`idTemp`),
  KEY `FK_temp_productos` (`idProducto`),
  KEY `FK_temp_clientes` (`idCliente`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `FK_ciudad_provincia` FOREIGN KEY (`idProvincia`) REFERENCES `provincia` (`idProvincia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `FK_clientes_ciudad` FOREIGN KEY (`idCiudad`) REFERENCES `ciudad` (`idCiudad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_clientes_provincia` FOREIGN KEY (`idProvincia`) REFERENCES `provincia` (`idProvincia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `FK_factura_administrador` FOREIGN KEY (`idAdmin`) REFERENCES `administrador` (`idAdmin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_factura_clientes` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `FK_proveedores_ciudad` FOREIGN KEY (`idCiudad`) REFERENCES `ciudad` (`idCiudad`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
