/*
MySQL Data Transfer
Source Host: mreldb04.mrec.ar
Source Database: cake24_template_rbac
Target Host: mreldb04.mrec.ar
Target Database: cake24_template_rbac
Date: 25/08/2014 03:52:48 p.m.
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for configuracion
-- ----------------------------
CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `valor` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Table structure for rbac_acciones
-- ----------------------------
CREATE TABLE `rbac_acciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller` varchar(100) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for rbac_acciones_rbac_perfiles
-- ----------------------------
CREATE TABLE `rbac_acciones_rbac_perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rbac_accion_id` int(11) NOT NULL,
  `rbac_perfil_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`rbac_accion_id`,`rbac_perfil_id`),
  KEY `fk_ap_accion_idx` (`rbac_accion_id`),
  KEY `fk_ap_perfil_idx` (`rbac_perfil_id`),
  CONSTRAINT `fk_acion` FOREIGN KEY (`rbac_accion_id`) REFERENCES `rbac_acciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_perfil` FOREIGN KEY (`rbac_perfil_id`) REFERENCES `rbac_perfiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=527 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for rbac_perfiles
-- ----------------------------
CREATE TABLE `rbac_perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `inicio` int(11) DEFAULT NULL,
  `usa_area_representacion` BINARY(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descripcion_UNIQUE` (`descripcion`),
  KEY `fk_inicio_id` (`inicio`),
  CONSTRAINT `fk_inicio_id` FOREIGN KEY (`inicio`) REFERENCES `rbac_acciones` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for rbac_perfiles_rbac_usuarios
-- ----------------------------
CREATE TABLE `rbac_perfiles_rbac_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rbac_perfil_id` int(11) NOT NULL,
  `rbac_usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`rbac_usuario_id`,`rbac_perfil_id`),
  KEY `fk_rbac_perfil_has_rbac_usuario_rbac_usuario1_idx` (`rbac_usuario_id`),
  KEY `fk_rbac_perfil_has_rbac_usuario_rbac_perfil1_idx` (`rbac_perfil_id`),
  CONSTRAINT `rbac_perfiles_rbac_usuarios_ibfk_3` FOREIGN KEY (`rbac_perfil_id`) REFERENCES `rbac_perfiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rbac_perfiles_rbac_usuarios_ibfk_4` FOREIGN KEY (`rbac_usuario_id`) REFERENCES `rbac_usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for rbac_usuarios
-- ----------------------------
CREATE TABLE `rbac_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(120) CHARACTER SET utf8 NOT NULL,
  `nombre` text CHARACTER SET utf8,
  `apellido` text CHARACTER SET utf8,
  `valida_ldap` varchar(2) CHARACTER SET utf8 NOT NULL DEFAULT '1',
  `password` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `seed` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `perfil_default` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `rbac_token` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` varchar(500) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `validez` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `configuracion` VALUES ('1', 'captcha', 'No');
INSERT INTO `configuracion` VALUES ('2', 'NoLDAP', 'Si');
INSERT INTO `rbac_acciones` VALUES ('1', 'RbacUsuarios', 'index');
INSERT INTO `rbac_acciones` VALUES ('2', 'RbacUsuarios', 'add');
INSERT INTO `rbac_acciones` VALUES ('3', 'RbacUsuarios', 'edit');
INSERT INTO `rbac_acciones` VALUES ('4', 'RbacUsuarios', 'delete');
INSERT INTO `rbac_acciones` VALUES ('5', 'RbacPerfiles', 'index');
INSERT INTO `rbac_acciones` VALUES ('6', 'RbacPerfiles', 'add');
INSERT INTO `rbac_acciones` VALUES ('7', 'RbacPerfiles', 'edit');
INSERT INTO `rbac_acciones` VALUES ('8', 'RbacPerfiles', 'delete');
INSERT INTO `rbac_acciones` VALUES ('9', 'RbacAcciones', 'index');
INSERT INTO `rbac_acciones` VALUES ('13', 'Pages', 'display');
INSERT INTO `rbac_acciones` VALUES ('18', 'RbacUsuarios', 'autocompleteLdap');
INSERT INTO `rbac_acciones` VALUES ('19', 'RbacUsuarios', 'validarLoginLdap');
INSERT INTO `rbac_acciones` VALUES ('20', 'RbacUsuarios', 'validarLoginDB');
INSERT INTO `rbac_acciones` VALUES ('21', 'RbacUsuarios', 'login');
INSERT INTO `rbac_acciones` VALUES ('28', 'RbacUsuarios', 'changePass');
INSERT INTO `rbac_acciones` VALUES ('29', 'RbacUsuarios', 'cambiarPerfil');
INSERT INTO `rbac_acciones` VALUES ('30', 'RbacUsuarios', 'recuperar');
INSERT INTO `rbac_acciones` VALUES ('31', 'RbacUsuarios', 'recuperarPass');
INSERT INTO `rbac_acciones` VALUES ('34', 'Manual', 'index');
INSERT INTO `rbac_acciones` VALUES ('35', 'Configuracion', 'index');
INSERT INTO `rbac_acciones` VALUES ('36', 'Configuracion', 'edit');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('1', '1', '3');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('2', '1', '2');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('3', '1', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('4', '1', '9');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('5', '2', '3');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('6', '2', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('7', '3', '3');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('8', '3', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('9', '4', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('10', '5', '3');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('11', '5', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('12', '5', '9');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('13', '6', '3');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('14', '6', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('15', '7', '3');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('16', '7', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('17', '8', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('18', '9', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('19', '13', '3');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('20', '13', '2');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('21', '13', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('22', '18', '3');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('23', '18', '2');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('24', '18', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('25', '19', '3');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('26', '19', '2');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('27', '19', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('28', '20', '3');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('29', '20', '2');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('30', '20', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('31', '21', '3');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('32', '21', '2');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('33', '21', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('34', '28', '3');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('35', '28', '2');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('36', '28', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('37', '29', '3');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('38', '29', '2');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('39', '29', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('40', '30', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('41', '31', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('42', '34', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('43', '35', '1');
INSERT INTO `rbac_acciones_rbac_perfiles` VALUES ('44', '36', '1');
INSERT INTO `rbac_perfiles` VALUES ('1', 'Desarrollador', '34');
INSERT INTO `rbac_perfiles` VALUES ('2', 'Invitado', '1');
INSERT INTO `rbac_perfiles` VALUES ('3', 'Administrador', '1');
INSERT INTO `rbac_perfiles` VALUES ('9', 'teste', '1');
INSERT INTO `rbac_perfiles_rbac_usuarios` VALUES ('1', '1', '1');
INSERT INTO `rbac_perfiles_rbac_usuarios` VALUES ('2', '2', '1');
INSERT INTO `rbac_perfiles_rbac_usuarios` VALUES ('3', '3', '1');
INSERT INTO `rbac_perfiles_rbac_usuarios` VALUES ('4', '1', '15');
INSERT INTO `rbac_perfiles_rbac_usuarios` VALUES ('5', '1', '16');
INSERT INTO `rbac_perfiles_rbac_usuarios` VALUES ('6', '1', '17');
INSERT INTO `rbac_perfiles_rbac_usuarios` VALUES ('7', '1', '18');
INSERT INTO `rbac_perfiles_rbac_usuarios` VALUES ('8', '1', '19');
INSERT INTO `rbac_perfiles_rbac_usuarios` VALUES ('9', '1', '35');
INSERT INTO `rbac_perfiles_rbac_usuarios` VALUES ('10', '1', '36');
INSERT INTO `rbac_perfiles_rbac_usuarios` VALUES ('11', '1', '38');
INSERT INTO `rbac_perfiles_rbac_usuarios` VALUES ('12', '1', '39');
INSERT INTO `rbac_perfiles_rbac_usuarios` VALUES ('13', '1', '40');
INSERT INTO `rbac_usuarios` VALUES ('1', 'wsb', 'Sebastián', 'Bustelo', '1', 'd7ffcf22813d03f28fabe19882293952137a6f333296177f16a1379765d95a3c', '05ec04f7fb3bc3281f1db83bfc1a2490', '2014-06-23 23:01:55', '2014-07-15 15:11:31', '1');
INSERT INTO `rbac_usuarios` VALUES ('15', 'jpx', 'Juan', 'Colonna', '1', '3f1ccf53a09ffaa3ca8544e67a705331ea1a5fb9c181abdf749b222fb29ddd36', '48259990138bc03361556fb3f94c5d45', '2014-07-15 19:39:12', '2014-07-15 19:39:12', '1');
INSERT INTO `rbac_usuarios` VALUES ('16', 'cjq', 'Juan', 'Castellano', '1', 'd078999422b6fd7f90c264d8b734f1d0177909799d76364c8b80156fe1ed699c', 'bb836c01cdc9120a9c984c525e4b1a4a', '2014-07-15 19:40:04', '2014-07-15 19:40:04', '1');
INSERT INTO `rbac_usuarios` VALUES ('17', 'tjg', 'Alejandro', 'Gajate', '1', 'b80c74674abc53603196498ff9980eba8a45d60d1c0c28e33b8ddef7c60f3e46', '2ba596643cbbbc20318224181fa46b28', '2014-07-15 20:06:32', '2014-07-15 20:06:32', '1');
INSERT INTO `rbac_usuarios` VALUES ('18', 'fzq', 'Rocío', 'Fernandez', '1', '592feb8043f1cc559babd942a7d52cffcdb352eb756ae2b9e4c410c5aed7779f', 'ff2d5fc3ab1932df3c00308bead36006', '2014-07-15 21:23:22', '2014-07-15 21:23:22', '1');
INSERT INTO `rbac_usuarios` VALUES ('19', 'ufd', 'Facundo', 'Musil', '1', '46423ce1d54efc7d8f6e55d5bef5b4e4e8098e2df10d8a8bd2c78e6d8514937f', 'd01eeca8b24321cd2fe89dd85b9beb51', '2014-07-15 21:24:03', '2014-07-15 21:24:03', '1');
INSERT INTO `rbac_usuarios` VALUES ('35', 'nnc', 'Diego Nicolás ', 'Casar González', '1', '6690b4bb4f05905ce18fb580a96deaab7798ae0a69420aa8425d459d94b2e909', '3d3d286a8d153a4a58156d0e02d8570c', '2014-07-28 15:55:23', '2014-07-28 15:55:23', '1');
INSERT INTO `rbac_usuarios` VALUES ('36', 'shd', 'Diego Horacio ', 'Sueiro', '1', 'ccdbb2f7f46c6acd65b0feb837dbd42f2f3b083cbc0513ef3f15c9e5981a4b51', '41c576a3bac4220845f9427b002a2a9d', '2014-07-28 15:55:40', '2014-07-28 15:55:40', '1');
INSERT INTO `rbac_usuarios` VALUES ('38', 'Graciela', 'Graciela', 'Valles', '0', '0d682b481c0b7797015767da2360e54d81417f2e415396d3394e7271169651f4', 'edea298442a67de045e88dfb6e5ea4a2', '2014-08-22 12:48:32', '2014-08-22 12:48:32', '1');
INSERT INTO `rbac_usuarios` VALUES ('39', 'rocio', 'rocio', 'fer', '0', '0b874866cadb3d3eb1346755f4eb68e050c9f901f24644502f0e90f9c3c16ca6', 'fe4b8556000d0f0cae99daa5c5c5a410', '2014-08-22 15:09:39', '2014-08-22 15:09:39', '1');
INSERT INTO `rbac_usuarios` VALUES ('40', 'joq', 'Joaquín Lucas', 'Casarino', '1', '5bb25a7e2a35fc650c7c0cf90c6e9a9e06f3ad772d5693d465f5c6d42af55c72', 'ec36e2ba64f11c9e910e0353e0836d81', '2014-08-25 13:57:57', '2014-08-25 13:57:57', '1');
