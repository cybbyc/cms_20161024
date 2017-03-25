/*
Navicat MySQL Data Transfer

Source Server         : cyb
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : cms_20161024

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-03-25 10:47:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) NOT NULL,
  `admin_limit` varchar(255) NOT NULL,
  `admin_pwd` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'cyb', '[\"1\",\"1.1\",\"1.2\",\"2\",\"2.1\",\"2.2\",\"3\",\"3.1\",\"3.2\",\"4\",\"4.1\",\"4.2\",\"5\",\"5.1\",\"5.2\"]', '123456');
INSERT INTO `admin` VALUES ('3', 'abc', '[\"1\",\"1.1\",\"1.2\",\"2\",\"2.1\",\"2.2\"]', '123');

-- ----------------------------
-- Table structure for `image`
-- ----------------------------
DROP TABLE IF EXISTS `image`;
CREATE TABLE `image` (
  `img_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img_name` varchar(255) NOT NULL,
  `img_msg` varchar(255) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `img_suolue` varchar(255) NOT NULL,
  `img_time` datetime NOT NULL,
  `img_user` varchar(255) NOT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of image
-- ----------------------------
INSERT INTO `image` VALUES ('28', '海贼王', '海贼王路飞', 'upload/2016/11/02/201611021055364af2ef19531484c8446cfe8441decb49.jpg', 'upload/suolue/2016/11/02/201611021055364af2ef19531484c8446cfe8441decb49.jpg', '2016-11-02 10:55:36', 'cyb');
INSERT INTO `image` VALUES ('31', '汽车', '靓丽跑车', 'upload/2016/11/02/2016110211561512da923701fc065b357015817af9e5f5.jpg', 'upload/suolue/2016/11/02/2016110211561512da923701fc065b357015817af9e5f5.jpg', '2016-11-02 11:56:15', 'cyb');
INSERT INTO `image` VALUES ('32', '风车', '草原上的风车', 'upload/2016/11/02/201611021156371b0c4faff74b711f155eddc0ebe36a3a.jpg', 'upload/suolue/2016/11/02/201611021156371b0c4faff74b711f155eddc0ebe36a3a.jpg', '2016-11-02 11:56:37', 'cyb');

-- ----------------------------
-- Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `news_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) NOT NULL,
  `news_content` varchar(255) NOT NULL,
  `news_user` varchar(255) NOT NULL,
  `news_time` datetime NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('8', '新闻标题1', '新闻内容1', 'cyb', '2016-10-25 10:40:44');
INSERT INTO `news` VALUES ('10', 'gggggggggg', 'hhhhhhhhhhhhhh', 'cyb', '2016-10-25 10:18:04');
INSERT INTO `news` VALUES ('11', '密码', '库纠结', 'cyb', '2016-10-25 10:37:19');
INSERT INTO `news` VALUES ('12', 'hwrt', 'gwer', 'cyb', '2016-10-25 10:40:44');
INSERT INTO `news` VALUES ('13', 'hwrt', 'gwer', 'cyb', '2016-10-25 10:40:44');
INSERT INTO `news` VALUES ('16', 'k6il67;o', '儿童户外儿童画 ', 'cyb', '2016-10-26 17:13:10');
INSERT INTO `news` VALUES ('17', 'k6il67;o', '儿童户外儿童画 ', 'cyb', '2016-10-26 17:13:10');
INSERT INTO `news` VALUES ('19', 'k6il67;o', '儿童户外儿童画 ', 'cyb', '2016-10-26 17:13:10');
INSERT INTO `news` VALUES ('21', 'k6il67;o', '儿童户外儿童画 ', 'cyb', '2016-10-26 17:13:10');
INSERT INTO `news` VALUES ('22', 'k6il67;o', '儿童户外儿童画 ', 'cyb', '2016-10-26 17:13:10');
INSERT INTO `news` VALUES ('23', 'k6il67;o', '儿童户外儿童画 ', 'cyb', '2016-10-26 17:13:10');
INSERT INTO `news` VALUES ('24', 'k6il67;o', '儿童户外儿童画 ', 'cyb', '2016-10-26 17:13:10');
INSERT INTO `news` VALUES ('27', 'k6il67;o', '儿童户外儿童画 ', 'cyb', '2016-10-26 17:13:10');
INSERT INTO `news` VALUES ('28', 'k6il67;o', '儿童户外儿童画 ', 'cyb', '2016-10-26 17:13:10');
INSERT INTO `news` VALUES ('29', 'k6il67;o', '儿童户外儿童画 ', 'cyb', '2016-10-26 17:13:10');
INSERT INTO `news` VALUES ('37', 'k6il67;o', '儿童户外儿童画 ', 'cyb', '2016-10-26 17:13:10');
INSERT INTO `news` VALUES ('43', 'k6il67;o', '儿童户外儿童画 ', 'cyb', '2016-10-26 17:13:10');
INSERT INTO `news` VALUES ('52', 'abc', 'ggggggggggggrrrrrrrrrrr                                ', 'cyb', '2016-10-31 11:13:44');

-- ----------------------------
-- Table structure for `news_classify`
-- ----------------------------
DROP TABLE IF EXISTS `news_classify`;
CREATE TABLE `news_classify` (
  `classify_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `classify_name` varchar(255) NOT NULL,
  `p_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`classify_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news_classify
-- ----------------------------
INSERT INTO `news_classify` VALUES ('1', '国内', '0');
INSERT INTO `news_classify` VALUES ('2', '国际', '0');
INSERT INTO `news_classify` VALUES ('3', '体育', '0');
INSERT INTO `news_classify` VALUES ('4', '娱乐', '1');
INSERT INTO `news_classify` VALUES ('5', '娱乐', '2');
INSERT INTO `news_classify` VALUES ('6', '交通', '1');
INSERT INTO `news_classify` VALUES ('7', '热点', '1');
INSERT INTO `news_classify` VALUES ('10', '欧洲杯', '2');
INSERT INTO `news_classify` VALUES ('11', '世界杯', '2');
INSERT INTO `news_classify` VALUES ('13', '曼联', '10');
INSERT INTO `news_classify` VALUES ('14', '巴塞罗那', '10');
INSERT INTO `news_classify` VALUES ('15', '综艺', '5');
INSERT INTO `news_classify` VALUES ('16', '电影', '5');
INSERT INTO `news_classify` VALUES ('18', '奥运会', '3');
INSERT INTO `news_classify` VALUES ('19', '世界杯', '3');
INSERT INTO `news_classify` VALUES ('20', '世乒赛', '3');
INSERT INTO `news_classify` VALUES ('21', '中国队', '20');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_pwd` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(11) NOT NULL,
  `user_img` varchar(255) DEFAULT NULL,
  `user_des` varchar(255) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'cyb', '055519', '1378511140@qq.com', '13128796754', 'http://localhost/cms/upload/2016/11/02/201611021156371b0c4faff74b711f155eddc0ebe36a3a.jpg', '这是一个测试用户1这是一个测试用户1这是一个测试用户1这是一个测试用户1这是一个测试用户1这是一个测试用户1', '2016-12-23 10:04:41', '2016-12-23 10:04:51');
