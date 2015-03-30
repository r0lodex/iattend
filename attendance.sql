/*
Navicat MySQL Data Transfer

Source Server         : vagrant
Source Server Version : 50541
Source Host           : localhost:8889
Source Database       : attendance

Target Server Type    : MYSQL
Target Server Version : 50541
File Encoding         : 65001

Date: 2015-03-31 03:03:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for attendance
-- ----------------------------
DROP TABLE IF EXISTS `attendance`;
CREATE TABLE `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `time_reg` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384;

-- ----------------------------
-- Records of attendance
-- ----------------------------
INSERT INTO `attendance` VALUES ('3', '2', '2', '18:06:16');
INSERT INTO `attendance` VALUES ('4', '2', '1', '18:44:02');
INSERT INTO `attendance` VALUES ('5', '1', '1', '18:44:25');

-- ----------------------------
-- Table structure for event
-- ----------------------------
DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `descp` varchar(255) DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `day` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

-- ----------------------------
-- Records of event
-- ----------------------------
INSERT INTO `event` VALUES ('1', 'ceramah', 'minggu orientasi', 'dewan', '2015-03-08', '19:00:00');
INSERT INTO `event` VALUES ('2', 'bengkel', 'kerja kumpulan', 'makmal', '2015-03-19', '21:00:00');
INSERT INTO `event` VALUES ('3', 'Skor SPM', 'bengkel kecemerlangan SPM', 'dewan', '2015-03-18', '22:46:19');
INSERT INTO `event` VALUES ('4', 'orientasi', 'minggu orientasi ambilan julai', 'bangunan dato onn', '2015-03-28', '22:47:46');

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) DEFAULT NULL,
  `ic` varchar(20) DEFAULT NULL,
  `matrix_no` varchar(25) DEFAULT NULL,
  `serial_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('1', 'syukri', '111', '222', '333');
INSERT INTO `student` VALUES ('2', 'kamal', '444', '555', '666');
