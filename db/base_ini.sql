SET NAMES utf8;
SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS `tintainformatica` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tintainformatica`;

CREATE TABLE IF NOT EXISTS `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `valor` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE `configuracion` DISABLE KEYS;
INSERT INTO `configuracion` (`id`, `clave`, `valor`) VALUES
	(1, 'captcha', 'No'),
	(2, 'noLDAP', 'Si');
ALTER TABLE `configuracion` ENABLE KEYS;

CREATE TABLE IF NOT EXISTS `permisos_virtual_hosts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `permiso` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


ALTER TABLE `permisos_virtual_hosts` DISABLE KEYS;
INSERT INTO `permisos_virtual_hosts` (`id`, `permiso`, `url`) VALUES
	(1, 'solo_lectura', NULL),
	(2, 'carga_publica', NULL),
	(3, 'carga_login_publica', NULL),
	(4, 'carga_login_interna', NULL),
	(5, 'carga_administracion', NULL);
ALTER TABLE `permisos_virtual_hosts` ENABLE KEYS;

CREATE TABLE IF NOT EXISTS `marca` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


ALTER TABLE `marca` DISABLE KEYS;
INSERT INTO `marca` (`id`, `nombre`) VALUES
	(1, 'Genius'),
	(2, 'HP'),
	(3, 'Epson');
ALTER TABLE `marca` ENABLE KEYS;


CREATE TABLE IF NOT EXISTS `producto_tipo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


ALTER TABLE `producto_tipo` DISABLE KEYS;
INSERT INTO `producto_tipo` (`id`, `nombre`) VALUES
	(1, 'Pen Driver'),
	(2, 'Cartucho'),
	(3, 'Cable'),
	(5, 'Impresora');
ALTER TABLE `producto_tipo` ENABLE KEYS;


CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(10) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `codigo` varchar(500) DEFAULT NULL,
  `marca_id` int(10) NOT NULL,
  `productotipo_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Unicidad` (`descripcion`),
  KEY `fk_producto_marca` (`marca_id`),
  KEY `fk_producto_productotipo` (`productotipo_id`),
  CONSTRAINT `fk_producto_marca` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`id`),
  CONSTRAINT `fk_producto_productotipo` FOREIGN KEY (`productotipo_id`) REFERENCES `producto_tipo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `producto` DISABLE KEYS;
INSERT INTO `producto` (`id`, `descripcion`, `costo`, `codigo`, `marca_id`, `productotipo_id`) VALUES
	(1, 'Cartucho Original 662 negro', 155.68, '456464654654', 2, 2),
	(2, 'Cartucho Original 662 color', 85.90, '979465465461', 2, 2);
ALTER TABLE `producto` ENABLE KEYS;



CREATE TABLE IF NOT EXISTS `rbac_acciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `action` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `solo_lectura` int(1) DEFAULT NULL,
  `carga_publica` int(1) DEFAULT NULL,
  `carga_login_publica` int(1) DEFAULT NULL,
  `carga_login_interna` int(1) DEFAULT NULL,
  `carga_administracion` int(1) DEFAULT NULL,
  `heredado` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `controller` (`controller`,`action`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


/*!40000 ALTER TABLE `rbac_acciones` DISABLE KEYS */;
INSERT INTO `rbac_acciones` (`id`, `controller`, `action`, `solo_lectura`, `carga_publica`, `carga_login_publica`, `carga_login_interna`, `carga_administracion`, `heredado`) VALUES
	(1, 'RbacUsuarios', 'index', 0, 0, 0, 0, 1, 0),
	(2, 'RbacUsuarios', 'add', 0, 0, 0, 0, 1, 0),
	(3, 'RbacUsuarios', 'edit', 0, 0, 0, 0, 1, 0),
	(4, 'RbacUsuarios', 'delete', 0, 0, 0, 0, 1, 0),
	(5, 'RbacPerfiles', 'index', 0, 0, 0, 0, 1, 0),
	(6, 'RbacPerfiles', 'add', 0, 0, 0, 0, 1, 0),
	(7, 'RbacPerfiles', 'edit', 0, 0, 0, 0, 1, 0),
	(8, 'RbacPerfiles', 'delete', 0, 0, 0, 0, 1, 0),
	(9, 'RbacPerfiles', 'getAccionesByVirtualHost', 0, 0, 0, 0, 1, 0),
	(10, 'RbacAcciones', 'index', 0, 0, 0, 0, 1, 0),
	(11, 'RbacAcciones', 'delete', 0, 0, 0, 0, 1, 0),
	(12, 'RbacAcciones', 'sincronizar', 0, 0, 0, 0, 1, 0),
	(13, 'RbacAcciones', 'switchAccion', 0, 0, 0, 0, 1, 0),
	(14, 'RbacUsuarios', 'autocompleteLdap', 0, 0, 0, 0, 1, 0),
	(15, 'RbacUsuarios', 'validarLoginLdap', 0, 0, 0, 0, 1, 0),
	(16, 'RbacUsuarios', 'validarLoginDB', 0, 0, 0, 0, 1, 0),
	(17, 'RbacUsuarios', 'login', 0, 0, 1, 1, 1, 0),
	(18, 'RbacUsuarios', 'changePass', 0, 0, 1, 1, 1, 0),
	(19, 'RbacUsuarios', 'cambiarPerfil', 0, 0, 1, 1, 1, 0),
	(20, 'RbacUsuarios', 'recuperar', 0, 0, 1, 1, 1, 0),
	(21, 'RbacUsuarios', 'recuperarPass', 0, 0, 1, 1, 1, 0),
	(22, 'RbacPermisos', 'index', 0, 0, 0, 0, 1, 0),
	(23, 'RbacPermisos', 'add', 0, 0, 0, 0, 1, 0),
	(24, 'RbacPermisos', 'edit', 0, 0, 0, 0, 1, 0),
	(25, 'RbacPermisos', 'delete', 0, 0, 0, 0, 1, 0),
	(26, 'RbacUsuarios', 'cambiarEntorno', 1, 1, 1, 1, 1, 0),
	(27, 'Configuracion', 'index', 0, 0, 0, 0, 1, 0),
	(28, 'Configuracion', 'edit', 0, 0, 0, 0, 1, 0),
	(31, 'Admin', '_null', NULL, NULL, NULL, NULL, 1, NULL),
	(32, 'Admin', 'index', NULL, NULL, NULL, NULL, 1, NULL),	
	(88, 'ProductoTipo', '_null', NULL, NULL, NULL, NULL, 1, NULL),
	(89, 'ProductoTipo', 'index', NULL, NULL, NULL, NULL, 1, NULL),
	(90, 'ProductoTipo', 'add', NULL, NULL, NULL, NULL, 1, NULL),
	(94, 'ProductoTipo', 'editar', NULL, NULL, NULL, NULL, 1, NULL),
	(95, 'ProductoTipo', 'eliminar', NULL, NULL, NULL, NULL, 1, NULL),
	(96, 'Marca', '_null', NULL, NULL, NULL, NULL, 1, NULL),
	(97, 'Marca', 'index', NULL, NULL, NULL, NULL, 1, NULL),
	(98, 'Marca', 'add', NULL, NULL, NULL, NULL, 1, NULL),
	(99, 'Marca', 'editar', NULL, NULL, NULL, NULL, 1, NULL),
	(100, 'Marca', 'eliminar', NULL, NULL, NULL, NULL, 1, NULL),
	(101, 'Producto', '_null', NULL, NULL, NULL, NULL, 1, NULL),
	(102, 'Producto', 'index', NULL, NULL, NULL, NULL, 1, NULL),
	(103, 'Producto', 'add', NULL, NULL, NULL, NULL, 1, NULL),
	(104, 'Producto', 'editar', NULL, NULL, NULL, NULL, 1, NULL),
	(105, 'Producto', 'eliminar', NULL, NULL, NULL, NULL, 1, NULL),
	(106, 'Admin', 'producto', NULL, NULL, NULL, NULL, 1, NULL);
/*!40000 ALTER TABLE `rbac_acciones` ENABLE KEYS */;


-- Dumping structure for table tintainformatica.rbac_acciones_rbac_perfiles
CREATE TABLE IF NOT EXISTS `rbac_acciones_rbac_perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rbac_accion_id` int(11) NOT NULL,
  `rbac_perfil_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`rbac_accion_id`,`rbac_perfil_id`),
  KEY `fk_ap_accion_idx` (`rbac_accion_id`),
  KEY `fk_ap_perfil_idx` (`rbac_perfil_id`),
  CONSTRAINT `fk_acion` FOREIGN KEY (`rbac_accion_id`) REFERENCES `rbac_acciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_perfil` FOREIGN KEY (`rbac_perfil_id`) REFERENCES `rbac_perfiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1235 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Dumping data for table tintainformatica.rbac_acciones_rbac_perfiles: ~163 rows (approximately)
/*!40000 ALTER TABLE `rbac_acciones_rbac_perfiles` DISABLE KEYS */;
INSERT INTO `rbac_acciones_rbac_perfiles` (`id`, `rbac_accion_id`, `rbac_perfil_id`) VALUES
	(447, 1, 6),
	(1200, 1, 1),
	(445, 2, 6),
	(1201, 2, 1),
	(443, 3, 6),
	(1202, 3, 1),
	(446, 4, 6),
	(1203, 4, 1),
	(1191, 5, 1),
	(1192, 6, 1),
	(1193, 7, 1),
	(1194, 8, 1),
	(395, 9, 6),
	(1195, 9, 1),
	(441, 10, 6),
	(1187, 10, 1),
	(439, 11, 6),
	(1188, 11, 1),
	(440, 12, 6),
	(1189, 12, 1),
	(438, 13, 6),
	(1190, 13, 1),
	(442, 14, 6),
	(1204, 14, 1),
	(448, 15, 6),
	(1205, 15, 1),
	(444, 16, 6),
	(1206, 16, 1),
	(455, 17, 6),
	(1230, 17, 1),
	(456, 18, 6),
	(1229, 18, 1),
	(457, 19, 6),
	(1228, 19, 1),
	(458, 20, 6),
	(1231, 20, 1),
	(459, 21, 6),
	(1232, 21, 1),
	(1196, 22, 1),
	(1197, 23, 1),
	(1198, 24, 1),
	(1199, 25, 1),
	(460, 26, 6),
	(1227, 26, 1),
	(407, 27, 6),
	(1144, 27, 1),
	(408, 28, 6),
	(1145, 28, 1),
	(1213, 29, 1),
	(396, 30, 6),
	(1132, 30, 1),
	(1214, 31, 1),
	(397, 32, 6),
	(1133, 32, 1),
	(1215, 33, 1),
	(403, 34, 6),
	(1135, 34, 1),
	(402, 35, 6),
	(1136, 35, 1),
	(398, 36, 6),
	(1137, 36, 1),
	(404, 37, 6),
	(1138, 37, 1),
	(401, 38, 6),
	(1139, 38, 1),
	(399, 39, 6),
	(1140, 39, 1),
	(400, 40, 6),
	(1141, 40, 1),
	(1216, 41, 1),
	(405, 42, 6),
	(1142, 42, 1),
	(1217, 43, 1),
	(406, 44, 6),
	(1143, 44, 1),
	(1218, 45, 1),
	(413, 46, 6),
	(1146, 46, 1),
	(412, 47, 6),
	(1147, 47, 1),
	(409, 48, 6),
	(1148, 48, 1),
	(410, 49, 6),
	(1149, 49, 1),
	(411, 50, 6),
	(1150, 50, 1),
	(1219, 51, 1),
	(422, 52, 6),
	(1151, 52, 1),
	(417, 53, 6),
	(1152, 53, 1),
	(420, 54, 6),
	(1153, 54, 1),
	(414, 55, 6),
	(1154, 55, 1),
	(415, 56, 6),
	(1155, 56, 1),
	(416, 57, 6),
	(1156, 57, 1),
	(418, 58, 6),
	(1157, 58, 1),
	(421, 59, 6),
	(1158, 59, 1),
	(419, 60, 6),
	(1159, 60, 1),
	(1222, 61, 1),
	(429, 62, 6),
	(1169, 62, 1),
	(430, 63, 6),
	(1170, 63, 1),
	(428, 64, 6),
	(1171, 64, 1),
	(1221, 65, 1),
	(424, 66, 6),
	(1164, 66, 1),
	(423, 67, 6),
	(1165, 67, 1),
	(425, 68, 6),
	(1166, 68, 1),
	(426, 69, 6),
	(1167, 69, 1),
	(427, 70, 6),
	(1168, 70, 1),
	(1223, 71, 1),
	(431, 72, 6),
	(1172, 72, 1),
	(432, 73, 6),
	(1173, 73, 1),
	(1224, 74, 1),
	(434, 75, 6),
	(1174, 75, 1),
	(433, 76, 6),
	(1175, 76, 1),
	(435, 77, 6),
	(1176, 77, 1),
	(436, 78, 6),
	(1177, 78, 1),
	(437, 79, 6),
	(1178, 79, 1),
	(1233, 80, 1),
	(453, 81, 6),
	(1207, 81, 1),
	(452, 82, 6),
	(1208, 82, 1),
	(449, 83, 6),
	(1209, 83, 1),
	(450, 84, 6),
	(1210, 84, 1),
	(451, 85, 6),
	(1211, 85, 1),
	(1234, 86, 1),
	(454, 87, 6),
	(1212, 87, 1),
	(1226, 88, 1),
	(1183, 89, 1),
	(1184, 90, 1),
	(1185, 94, 1),
	(1186, 95, 1),
	(1220, 96, 1),
	(1160, 97, 1),
	(1161, 98, 1),
	(1162, 99, 1),
	(1163, 100, 1),
	(1225, 101, 1),
	(1179, 102, 1),
	(1180, 103, 1),
	(1181, 104, 1),
	(1182, 105, 1),
	(1134, 106, 1);
/*!40000 ALTER TABLE `rbac_acciones_rbac_perfiles` ENABLE KEYS */;


-- Dumping structure for table tintainformatica.rbac_perfiles
CREATE TABLE IF NOT EXISTS `rbac_perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `es_default` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usa_area_representacion` binary(1) DEFAULT NULL,
  `permiso_virtual_host_id` int(10) DEFAULT NULL,
  `accion_default_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descripcion_UNIQUE` (`descripcion`),
  KEY `rbac_perfiles_pvh` (`permiso_virtual_host_id`),
  KEY `rbac_perfiles_ra` (`accion_default_id`),
  CONSTRAINT `rbac_perfiles_pvh` FOREIGN KEY (`permiso_virtual_host_id`) REFERENCES `permisos_virtual_hosts` (`id`),
  CONSTRAINT `rbac_perfiles_ra` FOREIGN KEY (`accion_default_id`) REFERENCES `rbac_acciones` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Dumping data for table tintainformatica.rbac_perfiles: ~2 rows (approximately)
/*!40000 ALTER TABLE `rbac_perfiles` DISABLE KEYS */;
INSERT INTO `rbac_perfiles` (`id`, `descripcion`, `es_default`, `usa_area_representacion`, `permiso_virtual_host_id`, `accion_default_id`) VALUES
	(1, 'Administrador', '1', _binary 0x30, 5, 32),
	(6, 'erwwtewt', '0', _binary 0x30, 5, 30);
/*!40000 ALTER TABLE `rbac_perfiles` ENABLE KEYS */;


-- Dumping structure for table tintainformatica.rbac_perfiles_rbac_usuarios
CREATE TABLE IF NOT EXISTS `rbac_perfiles_rbac_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rbac_perfil_id` int(11) NOT NULL,
  `rbac_usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`rbac_usuario_id`,`rbac_perfil_id`),
  KEY `fk_rbac_perfil_has_rbac_usuario_rbac_usuario1_idx` (`rbac_usuario_id`),
  KEY `fk_rbac_perfil_has_rbac_usuario_rbac_perfil1_idx` (`rbac_perfil_id`),
  CONSTRAINT `rbac_perfiles_rbac_usuarios_ibfk_3` FOREIGN KEY (`rbac_perfil_id`) REFERENCES `rbac_perfiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rbac_perfiles_rbac_usuarios_ibfk_4` FOREIGN KEY (`rbac_usuario_id`) REFERENCES `rbac_usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Dumping data for table tintainformatica.rbac_perfiles_rbac_usuarios: ~2 rows (approximately)
/*!40000 ALTER TABLE `rbac_perfiles_rbac_usuarios` DISABLE KEYS */;
INSERT INTO `rbac_perfiles_rbac_usuarios` (`id`, `rbac_perfil_id`, `rbac_usuario_id`) VALUES
	(1, 1, 1),
	(13, 1, 12);
/*!40000 ALTER TABLE `rbac_perfiles_rbac_usuarios` ENABLE KEYS */;


-- Dumping structure for table tintainformatica.rbac_token
CREATE TABLE IF NOT EXISTS `rbac_token` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `validez` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Dumping data for table tintainformatica.rbac_token: ~6 rows (approximately)
/*!40000 ALTER TABLE `rbac_token` DISABLE KEYS */;
INSERT INTO `rbac_token` (`id`, `token`, `usuario_id`, `created`, `modified`, `validez`) VALUES
	(1, 'EayakWgqk55Qrieeu6eX64FS', 6, '2015-04-16 13:49:01', '2015-04-16 13:49:01', 1440),
	(2, 'F3z1veY7fAXHG5xtVJEnPPO8', 7, '2015-04-16 13:55:52', '2015-04-16 13:55:52', 1440),
	(3, '9xeQtkdKQMJZqdcZuzTjczjI', 8, '2015-04-16 14:12:26', '2015-04-16 14:12:26', 1440),
	(4, 'oCikd3+cpuJQ6cScnEZ9dRHp', 9, '2015-04-16 14:17:12', '2015-04-16 14:17:12', 1440),
	(5, '3dRyKO1JaydCyXRjMfvxP4py', 10, '2015-04-16 14:20:21', '2015-04-16 14:20:21', 1440),
	(6, 'xlj2ifa3sDMQY3ugbncclqYx', 11, '2015-04-16 14:26:35', '2015-04-16 14:26:35', 1440);
/*!40000 ALTER TABLE `rbac_token` ENABLE KEYS */;


-- Dumping structure for table tintainformatica.rbac_usuarios
CREATE TABLE IF NOT EXISTS `rbac_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(120) CHARACTER SET utf8 NOT NULL,
  `nombre` text CHARACTER SET utf8,
  `apellido` text CHARACTER SET utf8,
  `password` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `seed` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `perfil_default` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`usuario`),
  KEY `fk_perfil_default` (`perfil_default`),
  CONSTRAINT `fk_perfil_default` FOREIGN KEY (`perfil_default`) REFERENCES `rbac_perfiles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Dumping data for table tintainformatica.rbac_usuarios: ~2 rows (approximately)
/*!40000 ALTER TABLE `rbac_usuarios` DISABLE KEYS */;
INSERT INTO `rbac_usuarios` (`id`, `usuario`, `nombre`, `apellido`, `password`, `seed`, `created`, `modified`, `perfil_default`) VALUES
	(1, 'cyc', 'Cesar Sebastian ', 'Carrazana', 'c62b037d2011430245bf54fece6553f1fa4e513c5fec15bce2cef2c89ae0b54b', '091bc5440296cc0e41dd60ce22fbaf88', '2014-11-19 10:43:28', '2015-03-18 18:36:48', 1),
	(12, 'flavia@gmail.com', 'FlaviaR', 'RamosF', '90fcd15bec08f774290088241bed9a33ef561da60b6c28e42597bff7ca408fbf', '44968aece94f667e4095002d140b5896', '2015-04-17 17:19:05', '2015-04-17 17:58:56', 1);
/*!40000 ALTER TABLE `rbac_usuarios` ENABLE KEYS */;

/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
