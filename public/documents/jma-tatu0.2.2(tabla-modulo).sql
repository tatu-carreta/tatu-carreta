DROP TABLE IF EXISTS `modulo`;
CREATE TABLE `modulo` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(200) NOT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
AUTO_INCREMENT=3
;

DROP TABLE IF EXISTS `menu_modulo`;
CREATE TABLE `menu_modulo` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`menu_id` INT(11) NOT NULL,
	`modulo_id` INT(11) NOT NULL,
	`estado` CHAR(1) NOT NULL COLLATE 'utf8_unicode_ci',
	`fecha_carga` DATETIME NOT NULL,
	`fecha_baja` DATETIME NULL DEFAULT NULL,
	`usuario_id_carga` INT(11) NOT NULL,
	`usuario_id_baja` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX `FK__menu` (`menu_id`),
	INDEX `FK__modulo` (`modulo_id`),
	CONSTRAINT `FK__menu` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`),
	CONSTRAINT `FK__modulo` FOREIGN KEY (`modulo_id`) REFERENCES `modulo` (`id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
AUTO_INCREMENT=3
;