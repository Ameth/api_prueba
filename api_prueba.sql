/*
 Navicat MySQL Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100607
 Source Host           : localhost:3306
 Source Schema         : api_prueba

 Target Server Type    : MySQL
 Target Server Version : 100607
 File Encoding         : 65001

 Date: 15/05/2022 20:22:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ofertas
-- ----------------------------
DROP TABLE IF EXISTS `ofertas`;
CREATE TABLE `ofertas`  (
  `id_oferta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_oferta` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `estado` int(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_oferta`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ofertas
-- ----------------------------
INSERT INTO `ofertas` VALUES (1, 'Desarrollador web', 1);
INSERT INTO `ofertas` VALUES (5, 'Full stack', 1);
INSERT INTO `ofertas` VALUES (6, 'Desarrollador JAVA', 1);
INSERT INTO `ofertas` VALUES (7, 'Desarrollador C3', 1);

-- ----------------------------
-- Table structure for rel_oferta_usuario
-- ----------------------------
DROP TABLE IF EXISTS `rel_oferta_usuario`;
CREATE TABLE `rel_oferta_usuario`  (
  `id_oferta` int(255) NOT NULL,
  `id_usuario` int(255) NOT NULL,
  PRIMARY KEY (`id_oferta`, `id_usuario`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rel_oferta_usuario
-- ----------------------------
INSERT INTO `rel_oferta_usuario` VALUES (1, 1);
INSERT INTO `rel_oferta_usuario` VALUES (1, 2);
INSERT INTO `rel_oferta_usuario` VALUES (5, 1);
INSERT INTO `rel_oferta_usuario` VALUES (5, 2);
INSERT INTO `rel_oferta_usuario` VALUES (5, 3);
INSERT INTO `rel_oferta_usuario` VALUES (6, 4);
INSERT INTO `rel_oferta_usuario` VALUES (6, 5);
INSERT INTO `rel_oferta_usuario` VALUES (7, 1);
INSERT INTO `rel_oferta_usuario` VALUES (7, 4);
INSERT INTO `rel_oferta_usuario` VALUES (7, 6);

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `tipo_documento` varchar(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `documento` int(20) NULL DEFAULT NULL,
  `correo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'ameth', 'CC', 1140847389, 'amethgabriel@hotmail.com');
INSERT INTO `usuarios` VALUES (2, 'Ameth', 'CC', 1140847389, 'amethgabriel@hotmail.com');
INSERT INTO `usuarios` VALUES (3, 'Britney Ordoñez', 'CC', 1002163137, 'britneypaola@gmail.com');
INSERT INTO `usuarios` VALUES (4, 'Elkin Ordoñez', 'CC', 7216167, 'elgaorma@hotmail.com');
INSERT INTO `usuarios` VALUES (5, 'Maria Erazo', 'CC', 32757460, 'mariaerazoan@hotmail.com');
INSERT INTO `usuarios` VALUES (6, 'Verisimo Erazo', 'CC', 72161320, 'veroerazo@gmail.com');

SET FOREIGN_KEY_CHECKS = 1;
