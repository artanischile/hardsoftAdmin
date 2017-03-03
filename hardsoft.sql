/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 100113
Source Host           : localhost:3306
Source Database       : hardsoft

Target Server Type    : MYSQL
Target Server Version : 100113
File Encoding         : 65001

Date: 2016-12-12 08:19:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for modulos
-- ----------------------------
DROP TABLE IF EXISTS `modulos`;
CREATE TABLE `modulos` (
  `mod_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_descripcion` varchar(50) DEFAULT NULL,
  `mod_controller` varchar(255) DEFAULT NULL,
  `mod_estado` int(11) DEFAULT NULL,
  `mod_creacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of modulos
-- ----------------------------

-- ----------------------------
-- Table structure for perfil
-- ----------------------------
DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  `creado` datetime DEFAULT NULL,
  `creadopor` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of perfil
-- ----------------------------
INSERT INTO `perfil` VALUES ('1', 'Administrador', '2016-11-11 22:53:02', '1', '1');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `perfil` int(11) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `direccion` varchar(60) DEFAULT NULL,
  `comuna` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `creado_por` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', 'Daniel Nuñez', 'dnunez', 'qsRQqqmoDldCLdVda1VdR9qjdisrY_gIm7bmYdAufU8', 'danielnune@gmail.com', '1', null, null, null, '2016-12-11 17:01:43', null, '1');
INSERT INTO `usuarios` VALUES ('2', 'Agustin Nuñez', 'aguschile', 'N7z4LBIXHHHsZkCq1x9sMrpkh9-yhOKtu1e5DcTbiL4', 'agustin@gmail.com', '1', null, null, null, '2016-12-11 17:01:08', null, '1');

-- ----------------------------
-- View structure for listadousuarios
-- ----------------------------
DROP VIEW IF EXISTS `listadousuarios`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `listadousuarios` AS SELECT
usuarios.id,
usuarios.nombre,
usuarios.usuario,
usuarios.password,
usuarios.email,
usuarios.perfil,
perfil.descripcion,
usuarios.telefono,
usuarios.direccion,
usuarios.comuna,
usuarios.fecha_creacion,
usuarios.creado_por,
usuarios.estado
FROM
usuarios 
LEFT JOIN perfil on usuarios.perfil=perfil.id ;
