/*
Navicat MySQL Data Transfer

Source Server         : koneksi01
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_tp3dpbo

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-05-01 09:42:16
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `brand`
-- ----------------------------
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_nama` varchar(50) NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of brand
-- ----------------------------
INSERT INTO `brand` VALUES ('1', 'Instaperfect');
INSERT INTO `brand` VALUES ('3', 'Maybelline');
INSERT INTO `brand` VALUES ('14', 'Hanasui');
INSERT INTO `brand` VALUES ('15', 'Pinkflash');

-- ----------------------------
-- Table structure for `kategori`
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_nama` varchar(100) NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES ('1', 'Waterproof');
INSERT INTO `kategori` VALUES ('2', 'Transferproof');
INSERT INTO `kategori` VALUES ('3', 'Smudgeproof');
INSERT INTO `kategori` VALUES ('4', 'Sweatproof');

-- ----------------------------
-- Table structure for `makeup`
-- ----------------------------
DROP TABLE IF EXISTS `makeup`;
CREATE TABLE `makeup` (
  `makeup_id` int(11) NOT NULL AUTO_INCREMENT,
  `makeup_foto` varchar(255) NOT NULL,
  `makeup_nama` varchar(100) NOT NULL,
  `makeup_harga` varchar(100) NOT NULL,
  `makeup_deskripsi` varchar(100) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  PRIMARY KEY (`makeup_id`),
  KEY `brand_C` (`brand_id`),
  KEY `kategori_C` (`kategori_id`),
  CONSTRAINT `brand_C` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kategori_C` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of makeup
-- ----------------------------
INSERT INTO `makeup` VALUES ('1', 'cushion.jpg', 'Cushion', '110000', 'Full coverage', '2', '1');
INSERT INTO `makeup` VALUES ('2', 'lipcream.png', 'Lipcream', '30000', 'Anti kering', '3', '14');
INSERT INTO `makeup` VALUES ('11', 'primer.webp', 'Primer', '170000', 'Menutup pori-pori', '4', '3');
INSERT INTO `makeup` VALUES ('12', 'eyeshadow.webp', 'Eyeshadow', '80000', 'Glittery', '1', '15');
