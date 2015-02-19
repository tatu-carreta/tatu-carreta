-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.16 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para jma_tatu
DROP DATABASE IF EXISTS `jma_tatu`;
CREATE DATABASE IF NOT EXISTS `jma_tatu` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `jma_tatu`;


-- Volcando estructura para tabla jma_tatu.acceso_ilegal
DROP TABLE IF EXISTS `acceso_ilegal`;
CREATE TABLE IF NOT EXISTS `acceso_ilegal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_acceso` datetime NOT NULL,
  `ip` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.acceso_ilegal: ~0 rows (aproximadamente)
DELETE FROM `acceso_ilegal`;
/*!40000 ALTER TABLE `acceso_ilegal` DISABLE KEYS */;
/*!40000 ALTER TABLE `acceso_ilegal` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.archivo
DROP TABLE IF EXISTS `archivo`;
CREATE TABLE IF NOT EXISTS `archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `titulo` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `carpeta` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL,
  `usuario_id_carga` int(11) NOT NULL,
  `usuario_id_baja` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.archivo: ~0 rows (aproximadamente)
DELETE FROM `archivo`;
/*!40000 ALTER TABLE `archivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `archivo` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.assigned_roles
DROP TABLE IF EXISTS `assigned_roles`;
CREATE TABLE IF NOT EXISTS `assigned_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_assigned_roles_usuario` (`user_id`),
  KEY `FK_assigned_roles_roles` (`role_id`),
  CONSTRAINT `FK_assigned_roles_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `FK_assigned_roles_usuario` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.assigned_roles: ~2 rows (aproximadamente)
DELETE FROM `assigned_roles`;
/*!40000 ALTER TABLE `assigned_roles` DISABLE KEYS */;
INSERT INTO `assigned_roles` (`id`, `user_id`, `role_id`) VALUES
	(1, 1, 1),
	(2, 2, 2);
/*!40000 ALTER TABLE `assigned_roles` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.categoria
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL,
  `usuario_id_carga` int(11) NOT NULL,
  `usuario_id_baja` int(11) DEFAULT NULL,
  `imagen_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `url` (`url`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.categoria: ~0 rows (aproximadamente)
DELETE FROM `categoria`;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.categoria_asociada
DROP TABLE IF EXISTS `categoria_asociada`;
CREATE TABLE IF NOT EXISTS `categoria_asociada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `categoria_id_asociada` int(11) NOT NULL,
  `orden` int(11) DEFAULT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  KEY `categoria_id_asociada` (`categoria_id_asociada`),
  CONSTRAINT `categoria_asociada_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`),
  CONSTRAINT `categoria_asociada_ibfk_2` FOREIGN KEY (`categoria_id_asociada`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.categoria_asociada: ~0 rows (aproximadamente)
DELETE FROM `categoria_asociada`;
/*!40000 ALTER TABLE `categoria_asociada` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria_asociada` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.categoria_modificacion
DROP TABLE IF EXISTS `categoria_modificacion`;
CREATE TABLE IF NOT EXISTS `categoria_modificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `nombre` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `usuario_id_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `categoria_modificacion_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.categoria_modificacion: ~0 rows (aproximadamente)
DELETE FROM `categoria_modificacion`;
/*!40000 ALTER TABLE `categoria_modificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria_modificacion` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.evento
DROP TABLE IF EXISTS `evento`;
CREATE TABLE IF NOT EXISTS `evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto_id` int(11) NOT NULL,
  `fecha_desde` date DEFAULT NULL,
  `fecha_hasta` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_evento_texto` (`texto_id`),
  CONSTRAINT `FK_evento_texto` FOREIGN KEY (`texto_id`) REFERENCES `texto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.evento: ~0 rows (aproximadamente)
DELETE FROM `evento`;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.galeria
DROP TABLE IF EXISTS `galeria`;
CREATE TABLE IF NOT EXISTS `galeria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_galeria_item` (`item_id`),
  CONSTRAINT `FK_galeria_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.galeria: ~0 rows (aproximadamente)
DELETE FROM `galeria`;
/*!40000 ALTER TABLE `galeria` DISABLE KEYS */;
/*!40000 ALTER TABLE `galeria` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.html
DROP TABLE IF EXISTS `html`;
CREATE TABLE IF NOT EXISTS `html` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `cuerpo` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `FK__item` (`item_id`),
  CONSTRAINT `FK__item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.html: ~0 rows (aproximadamente)
DELETE FROM `html`;
/*!40000 ALTER TABLE `html` DISABLE KEYS */;
/*!40000 ALTER TABLE `html` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.imagen
DROP TABLE IF EXISTS `imagen`;
CREATE TABLE IF NOT EXISTS `imagen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `epigrafe` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `carpeta` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `ampliada` int(11) DEFAULT NULL,
  `estado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL,
  `usuario_id_carga` int(11) NOT NULL,
  `usuario_id_baja` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.imagen: ~0 rows (aproximadamente)
DELETE FROM `imagen`;
/*!40000 ALTER TABLE `imagen` DISABLE KEYS */;
/*!40000 ALTER TABLE `imagen` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.item
DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `url` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL,
  `usuario_id_carga` int(11) NOT NULL,
  `usuario_id_baja` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `url` (`url`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.item: ~0 rows (aproximadamente)
DELETE FROM `item`;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
/*!40000 ALTER TABLE `item` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.item_archivo
DROP TABLE IF EXISTS `item_archivo`;
CREATE TABLE IF NOT EXISTS `item_archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `archivo_id` int(11) NOT NULL,
  `orden` int(11) DEFAULT NULL,
  `destacado` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_archivo_item` (`item_id`),
  KEY `FK_item_archivo_archivo` (`archivo_id`),
  CONSTRAINT `FK_item_archivo_archivo` FOREIGN KEY (`archivo_id`) REFERENCES `archivo` (`id`),
  CONSTRAINT `FK_item_archivo_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.item_archivo: ~0 rows (aproximadamente)
DELETE FROM `item_archivo`;
/*!40000 ALTER TABLE `item_archivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_archivo` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.item_categoria
DROP TABLE IF EXISTS `item_categoria`;
CREATE TABLE IF NOT EXISTS `item_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `item_categoria_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  CONSTRAINT `item_categoria_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.item_categoria: ~0 rows (aproximadamente)
DELETE FROM `item_categoria`;
/*!40000 ALTER TABLE `item_categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_categoria` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.item_imagen
DROP TABLE IF EXISTS `item_imagen`;
CREATE TABLE IF NOT EXISTS `item_imagen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `imagen_id` int(11) NOT NULL,
  `orden` int(11) DEFAULT NULL,
  `destacado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `imagen_id` (`imagen_id`),
  CONSTRAINT `item_imagen_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  CONSTRAINT `item_imagen_ibfk_2` FOREIGN KEY (`imagen_id`) REFERENCES `imagen` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.item_imagen: ~0 rows (aproximadamente)
DELETE FROM `item_imagen`;
/*!40000 ALTER TABLE `item_imagen` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_imagen` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.item_modificacion
DROP TABLE IF EXISTS `item_modificacion`;
CREATE TABLE IF NOT EXISTS `item_modificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `titulo` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `url` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `item_modificacion_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.item_modificacion: ~0 rows (aproximadamente)
DELETE FROM `item_modificacion`;
/*!40000 ALTER TABLE `item_modificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_modificacion` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.item_seccion
DROP TABLE IF EXISTS `item_seccion`;
CREATE TABLE IF NOT EXISTS `item_seccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `seccion_id` int(11) NOT NULL,
  `orden` int(11) DEFAULT NULL,
  `destacado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `seccion_id` (`seccion_id`),
  CONSTRAINT `item_seccion_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  CONSTRAINT `item_seccion_ibfk_2` FOREIGN KEY (`seccion_id`) REFERENCES `seccion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.item_seccion: ~0 rows (aproximadamente)
DELETE FROM `item_seccion`;
/*!40000 ALTER TABLE `item_seccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_seccion` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.marca
DROP TABLE IF EXISTS `marca`;
CREATE TABLE IF NOT EXISTS `marca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `imagen_id` int(11) DEFAULT NULL,
  `tipo` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'P: Principal - S: Secundaria',
  `estado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL,
  `usuario_id_carga` int(11) NOT NULL,
  `usuario_id_baja` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.marca: ~0 rows (aproximadamente)
DELETE FROM `marca`;
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `url` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `estado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL,
  `usuario_id_carga` int(11) NOT NULL,
  `usuario_id_baja` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `url` (`url`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.menu: ~0 rows (aproximadamente)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.menu_asociado
DROP TABLE IF EXISTS `menu_asociado`;
CREATE TABLE IF NOT EXISTS `menu_asociado` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `menu_id_asociado` int(11) NOT NULL,
  `orden` int(11) DEFAULT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `menu_id_asociado` (`menu_id_asociado`),
  CONSTRAINT `menu_asociado_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`),
  CONSTRAINT `menu_asociado_ibfk_2` FOREIGN KEY (`menu_id_asociado`) REFERENCES `menu` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.menu_asociado: ~0 rows (aproximadamente)
DELETE FROM `menu_asociado`;
/*!40000 ALTER TABLE `menu_asociado` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_asociado` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.menu_categoria
DROP TABLE IF EXISTS `menu_categoria`;
CREATE TABLE IF NOT EXISTS `menu_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `menu_categoria_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`),
  CONSTRAINT `menu_categoria_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.menu_categoria: ~0 rows (aproximadamente)
DELETE FROM `menu_categoria`;
/*!40000 ALTER TABLE `menu_categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_categoria` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.menu_modificacion
DROP TABLE IF EXISTS `menu_modificacion`;
CREATE TABLE IF NOT EXISTS `menu_modificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `nombre` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `url` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `usuario_id_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  CONSTRAINT `menu_modificacion_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.menu_modificacion: ~0 rows (aproximadamente)
DELETE FROM `menu_modificacion`;
/*!40000 ALTER TABLE `menu_modificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_modificacion` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.menu_modulo
DROP TABLE IF EXISTS `menu_modulo`;
CREATE TABLE IF NOT EXISTS `menu_modulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_baja` datetime DEFAULT NULL,
  `usuario_id_carga` int(11) NOT NULL,
  `usuario_id_baja` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__menu` (`menu_id`),
  KEY `FK__modulo` (`modulo_id`),
  CONSTRAINT `FK__menu` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`),
  CONSTRAINT `FK__modulo` FOREIGN KEY (`modulo_id`) REFERENCES `modulo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.menu_modulo: ~0 rows (aproximadamente)
DELETE FROM `menu_modulo`;
/*!40000 ALTER TABLE `menu_modulo` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_modulo` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.menu_seccion
DROP TABLE IF EXISTS `menu_seccion`;
CREATE TABLE IF NOT EXISTS `menu_seccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `seccion_id` int(11) NOT NULL,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `seccion_id` (`seccion_id`),
  CONSTRAINT `menu_seccion_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`),
  CONSTRAINT `menu_seccion_ibfk_2` FOREIGN KEY (`seccion_id`) REFERENCES `seccion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.menu_seccion: ~0 rows (aproximadamente)
DELETE FROM `menu_seccion`;
/*!40000 ALTER TABLE `menu_seccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_seccion` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.modulo
DROP TABLE IF EXISTS `modulo`;
CREATE TABLE IF NOT EXISTS `modulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.modulo: ~5 rows (aproximadamente)
DELETE FROM `modulo`;
/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
INSERT INTO `modulo` (`id`, `nombre`) VALUES
	(1, 'producto'),
	(2, 'noticia'),
	(3, 'evento'),
	(4, 'portfolio_simple'),
	(5, 'portfolio_completo');
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.noticia
DROP TABLE IF EXISTS `noticia`;
CREATE TABLE IF NOT EXISTS `noticia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto_id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `fuente` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__texto` (`texto_id`),
  CONSTRAINT `FK__texto` FOREIGN KEY (`texto_id`) REFERENCES `texto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.noticia: ~0 rows (aproximadamente)
DELETE FROM `noticia`;
/*!40000 ALTER TABLE `noticia` DISABLE KEYS */;
/*!40000 ALTER TABLE `noticia` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.perfil
DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_baja` datetime DEFAULT NULL,
  `usuario_id_carga` int(11) NOT NULL,
  `usuario_id_baja` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.perfil: ~0 rows (aproximadamente)
DELETE FROM `perfil`;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` (`id`, `nombre`, `estado`, `fecha_carga`, `fecha_baja`, `usuario_id_carga`, `usuario_id_baja`) VALUES
	(1, 'Superadmin', 'A', '2014-07-25 11:26:23', NULL, 1, NULL);
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.permiso
DROP TABLE IF EXISTS `permiso`;
CREATE TABLE IF NOT EXISTS `permiso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil_id` int(11) NOT NULL,
  `nombre` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `modulo` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perfil_id` (`perfil_id`),
  KEY `modulo` (`modulo`(255)),
  CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.permiso: ~0 rows (aproximadamente)
DELETE FROM `permiso`;
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.permissions: ~50 rows (aproximadamente)
DELETE FROM `permissions`;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`) VALUES
	(1, 'agregar_slide'),
	(2, 'agregar_galeria'),
	(3, 'agregar_texto'),
	(4, 'agregar_html'),
	(5, 'ver_menu_admin'),
	(6, 'ver_item_admin'),
	(7, 'ver_seccion_admin'),
	(8, 'agregar_menu_boton'),
	(9, 'agregar_menu_categoria'),
	(10, 'ordenar_menu_principal'),
	(11, 'editar_menu_principal'),
	(12, 'borrar_menu_principal'),
	(13, 'ordenar_menu_interno'),
	(14, 'editar_menu_interno'),
	(15, 'borrar_menu_interno'),
	(16, 'agregar_pagina_inicio'),
	(17, 'agregar_pagina_contacto'),
	(18, 'seleccionar_nivel_menu'),
	(19, 'seleccionar_nivel_categoria'),
	(20, 'cambiar_categoria'),
	(21, 'ordenar_seccion_estatica'),
	(22, 'ordenar_seccion_dinamica'),
	(23, 'ver_menu_estatico_admin'),
	(24, 'editar_texto'),
	(25, 'borrar_texto'),
	(26, 'editar_html'),
	(27, 'borrar_html'),
	(28, 'editar_galeria'),
	(29, 'borrar_galeria'),
	(30, 'editar_slide'),
	(31, 'borrar_slide'),
	(32, 'convertir_subcategoria'),
	(33, 'agregar_seccion'),
	(34, 'editar_seccion'),
	(35, 'borrar_seccion'),
	(36, 'agregar_item'),
	(37, 'editar_item'),
	(38, 'borrar_item'),
	(39, 'destacar_item'),
	(40, 'quitar_destacado_item'),
	(41, 'ordenar_item'),
	(42, 'ver_marca_admin'),
	(43, 'agregar_marca'),
	(44, 'editar_marca'),
	(45, 'borrar_marca'),
	(46, 'agregar_slide_home'),
	(47, 'editar_slide_home'),
	(48, 'borrar_slide_home'),
	(49, 'elegir_modulo'),
	(50, 'cambiar_seccion_item');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.permission_role
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_permission_role_permissions` (`permission_id`),
  KEY `FK_permission_role_roles` (`role_id`),
  CONSTRAINT `FK_permission_role_permissions` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  CONSTRAINT `FK_permission_role_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.permission_role: ~50 rows (aproximadamente)
DELETE FROM `permission_role`;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES
	(1, 1, 1),
	(2, 2, 1),
	(3, 3, 1),
	(4, 4, 1),
	(5, 5, 1),
	(6, 6, 1),
	(7, 7, 1),
	(8, 8, 1),
	(9, 9, 1),
	(10, 10, 1),
	(11, 11, 1),
	(12, 12, 1),
	(13, 13, 1),
	(14, 14, 1),
	(15, 15, 1),
	(16, 16, 1),
	(17, 17, 1),
	(18, 18, 1),
	(19, 19, 1),
	(20, 20, 1),
	(21, 21, 1),
	(22, 22, 1),
	(23, 23, 1),
	(24, 24, 1),
	(25, 25, 1),
	(26, 26, 1),
	(27, 27, 1),
	(28, 28, 1),
	(29, 29, 1),
	(30, 30, 1),
	(31, 31, 1),
	(32, 32, 1),
	(33, 33, 1),
	(34, 34, 1),
	(35, 35, 1),
	(36, 36, 1),
	(37, 37, 1),
	(38, 38, 1),
	(39, 39, 1),
	(40, 40, 1),
	(41, 41, 1),
	(42, 42, 1),
	(43, 43, 1),
	(44, 44, 1),
	(45, 45, 1),
	(46, 46, 1),
	(47, 47, 1),
	(48, 48, 1),
	(49, 49, 1),
	(50, 50, 1);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.portfolio_completo
DROP TABLE IF EXISTS `portfolio_completo`;
CREATE TABLE IF NOT EXISTS `portfolio_completo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `portfolio_simple_id` int(11) NOT NULL,
  `cuerpo` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `FK_portfolio_completo_portfolio_simple` (`portfolio_simple_id`),
  CONSTRAINT `FK_portfolio_completo_portfolio_simple` FOREIGN KEY (`portfolio_simple_id`) REFERENCES `portfolio_simple` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.portfolio_completo: ~0 rows (aproximadamente)
DELETE FROM `portfolio_completo`;
/*!40000 ALTER TABLE `portfolio_completo` DISABLE KEYS */;
/*!40000 ALTER TABLE `portfolio_completo` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.portfolio_simple
DROP TABLE IF EXISTS `portfolio_simple`;
CREATE TABLE IF NOT EXISTS `portfolio_simple` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_portfolio_simple_item` (`item_id`),
  CONSTRAINT `FK_portfolio_simple_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.portfolio_simple: ~0 rows (aproximadamente)
DELETE FROM `portfolio_simple`;
/*!40000 ALTER TABLE `portfolio_simple` DISABLE KEYS */;
/*!40000 ALTER TABLE `portfolio_simple` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.producto
DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `cuerpo` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `FK_producto_item` (`item_id`),
  CONSTRAINT `FK_producto_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.producto: ~0 rows (aproximadamente)
DELETE FROM `producto`;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.producto_marca
DROP TABLE IF EXISTS `producto_marca`;
CREATE TABLE IF NOT EXISTS `producto_marca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `marca_id` int(11) NOT NULL,
  `estado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_producto_marca_producto` (`producto_id`),
  KEY `FK_producto_marca_marca` (`marca_id`),
  CONSTRAINT `FK_producto_marca_marca` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`id`),
  CONSTRAINT `FK_producto_marca_producto` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.producto_marca: ~0 rows (aproximadamente)
DELETE FROM `producto_marca`;
/*!40000 ALTER TABLE `producto_marca` DISABLE KEYS */;
/*!40000 ALTER TABLE `producto_marca` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.producto_precio
DROP TABLE IF EXISTS `producto_precio`;
CREATE TABLE IF NOT EXISTS `producto_precio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `tipo_precio_id` int(11) NOT NULL,
  `valor` double NOT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_producto_precio_producto` (`producto_id`),
  KEY `FK_producto_precio_tipo_precio` (`tipo_precio_id`),
  CONSTRAINT `FK_producto_precio_producto` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`),
  CONSTRAINT `FK_producto_precio_tipo_precio` FOREIGN KEY (`tipo_precio_id`) REFERENCES `tipo_precio` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.producto_precio: ~0 rows (aproximadamente)
DELETE FROM `producto_precio`;
/*!40000 ALTER TABLE `producto_precio` DISABLE KEYS */;
/*!40000 ALTER TABLE `producto_precio` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_baja` datetime DEFAULT NULL,
  `usuario_id_carga` int(11) NOT NULL,
  `usuario_id_baja` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.roles: ~2 rows (aproximadamente)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `estado`, `fecha_carga`, `fecha_baja`, `usuario_id_carga`, `usuario_id_baja`) VALUES
	(1, 'Superadmin', 'A', '0000-00-00 00:00:00', NULL, 0, NULL),
	(2, 'Administrador', 'A', '0000-00-00 00:00:00', NULL, 0, NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.seccion
DROP TABLE IF EXISTS `seccion`;
CREATE TABLE IF NOT EXISTS `seccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL,
  `usuario_id_carga` int(11) NOT NULL,
  `usuario_id_baja` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.seccion: ~0 rows (aproximadamente)
DELETE FROM `seccion`;
/*!40000 ALTER TABLE `seccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `seccion` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.slide
DROP TABLE IF EXISTS `slide`;
CREATE TABLE IF NOT EXISTS `slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seccion_id` int(11) DEFAULT NULL,
  `tipo` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL,
  `usuario_id_carga` int(11) NOT NULL,
  `usuario_id_baja` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seccion_id` (`seccion_id`),
  CONSTRAINT `slide_ibfk_1` FOREIGN KEY (`seccion_id`) REFERENCES `seccion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.slide: ~0 rows (aproximadamente)
DELETE FROM `slide`;
/*!40000 ALTER TABLE `slide` DISABLE KEYS */;
/*!40000 ALTER TABLE `slide` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.slide_imagen
DROP TABLE IF EXISTS `slide_imagen`;
CREATE TABLE IF NOT EXISTS `slide_imagen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slide_id` int(11) NOT NULL,
  `imagen_id` int(11) NOT NULL,
  `texto` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `estado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL,
  `usuario_id_carga` int(11) NOT NULL,
  `usuario_id_baja` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slide_id` (`slide_id`),
  KEY `imagen_id` (`imagen_id`),
  CONSTRAINT `slide_imagen_ibfk_1` FOREIGN KEY (`slide_id`) REFERENCES `slide` (`id`),
  CONSTRAINT `slide_imagen_ibfk_2` FOREIGN KEY (`imagen_id`) REFERENCES `imagen` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.slide_imagen: ~0 rows (aproximadamente)
DELETE FROM `slide_imagen`;
/*!40000 ALTER TABLE `slide_imagen` DISABLE KEYS */;
/*!40000 ALTER TABLE `slide_imagen` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.texto
DROP TABLE IF EXISTS `texto`;
CREATE TABLE IF NOT EXISTS `texto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `cuerpo` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `FK_texto_item` (`item_id`),
  CONSTRAINT `FK_texto_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.texto: ~0 rows (aproximadamente)
DELETE FROM `texto`;
/*!40000 ALTER TABLE `texto` DISABLE KEYS */;
/*!40000 ALTER TABLE `texto` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.tipo_precio
DROP TABLE IF EXISTS `tipo_precio`;
CREATE TABLE IF NOT EXISTS `tipo_precio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.tipo_precio: ~4 rows (aproximadamente)
DELETE FROM `tipo_precio`;
/*!40000 ALTER TABLE `tipo_precio` DISABLE KEYS */;
INSERT INTO `tipo_precio` (`id`, `nombre`) VALUES
	(1, 'Precio Antes'),
	(2, 'Precio Actual'),
	(3, 'Precio Mayorista'),
	(4, 'Precio Minorista');
/*!40000 ALTER TABLE `tipo_precio` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `iderUser` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ultimo_ingreso` datetime DEFAULT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL,
  `remember_token` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nombre` (`nombre`(255)),
  KEY `clave` (`clave`(255)),
  KEY `iderUser` (`iderUser`(255))
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.usuario: ~2 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nombre`, `clave`, `iderUser`, `estado`, `ultimo_ingreso`, `fecha_carga`, `fecha_modificacion`, `fecha_baja`, `remember_token`) VALUES
	(1, 'superadmin', '$2y$10$0JDU9/Ys.wS9c0ATKGEhb.7DCTYznN9pLBHELQwGwJ6VK/DiIhm6S', '', 'A', '2015-01-26 15:11:08', '2014-07-25 11:26:05', NULL, NULL, 0),
	(2, 'maurog', '$2y$10$XtJDjEZRXBKKdiI/loKIguGlgLmEa.j/qKSUseZhGKSGoIut/4Lq2', '', 'A', '2014-12-05 13:03:38', '2014-12-05 11:01:24', NULL, NULL, 0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.usuario_acceso
DROP TABLE IF EXISTS `usuario_acceso`;
CREATE TABLE IF NOT EXISTS `usuario_acceso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `fecha_acceso` datetime NOT NULL,
  `ip` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `usuario_acceso_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.usuario_acceso: ~0 rows (aproximadamente)
DELETE FROM `usuario_acceso`;
/*!40000 ALTER TABLE `usuario_acceso` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_acceso` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.usuario_modificacion
DROP TABLE IF EXISTS `usuario_modificacion`;
CREATE TABLE IF NOT EXISTS `usuario_modificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `usuario_modificacion_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.usuario_modificacion: ~0 rows (aproximadamente)
DELETE FROM `usuario_modificacion`;
/*!40000 ALTER TABLE `usuario_modificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_modificacion` ENABLE KEYS */;


-- Volcando estructura para tabla jma_tatu.usuario_perfil
DROP TABLE IF EXISTS `usuario_perfil`;
CREATE TABLE IF NOT EXISTS `usuario_perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `perfil_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `perfil_id` (`perfil_id`),
  CONSTRAINT `usuario_perfil_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `usuario_perfil_ibfk_2` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.usuario_perfil: ~0 rows (aproximadamente)
DELETE FROM `usuario_perfil`;
/*!40000 ALTER TABLE `usuario_perfil` DISABLE KEYS */;
INSERT INTO `usuario_perfil` (`id`, `usuario_id`, `perfil_id`) VALUES
	(1, 1, 1);
/*!40000 ALTER TABLE `usuario_perfil` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
