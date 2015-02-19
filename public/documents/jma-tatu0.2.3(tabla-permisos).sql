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

-- Volcando estructura para tabla jma_tatu.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.permissions: ~49 rows (aproximadamente)
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
	(49, 'elegir_modulo');
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla jma_tatu.permission_role: ~49 rows (aproximadamente)
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
	(49, 49, 1);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
