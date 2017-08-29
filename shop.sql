/*
Navicat MySQL Data Transfer

Source Server         : Laravel
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : shop

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-08-29 22:12:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cart`
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `browser_tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '浏览器标记',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `product_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名称',
  `price` decimal(8,2) NOT NULL COMMENT '单价',
  `qty` int(11) NOT NULL DEFAULT '1' COMMENT '数量',
  `attribute` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '其他属性',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_browser_tag_index` (`browser_tag`),
  KEY `cart_member_id_index` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cart
-- ----------------------------
INSERT INTO `cart` VALUES ('9', '599fe4dac47df', '0', '14', 'accc', '555.00', '4', '', '2017-08-25 16:50:40', '2017-08-25 16:50:40');
INSERT INTO `cart` VALUES ('10', '599fe4dac47df', '0', '15', '鼻尖部abc', '77.00', '3', '', '2017-08-28 10:45:14', '2017-08-28 10:45:14');
INSERT INTO `cart` VALUES ('11', '59a38b87e7f40', '0', '15', '鼻尖部abc', '77.00', '3', '', '2017-08-28 11:18:35', '2017-08-28 11:18:35');
INSERT INTO `cart` VALUES ('12', '59a24de7a86a2', '0', '15', '鼻尖部abc', '77.00', '8', '', '2017-08-29 16:02:37', '2017-08-29 20:29:14');
INSERT INTO `cart` VALUES ('14', '59a24de7a86a2', '0', '14', 'accc', '555.00', '16', '', '2017-08-29 17:26:07', '2017-08-29 20:30:06');

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `parent_id` int(11) NOT NULL COMMENT '父级ID',
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '路径',
  `status` int(11) NOT NULL COMMENT '状态',
  `sort` int(11) NOT NULL COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_parent_id_index` (`parent_id`),
  KEY `category_path_index` (`path`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '电脑', '0', '0,', '1', '222', '2017-08-23 10:41:54', '2017-08-23 15:32:28');
INSERT INTO `category` VALUES ('2', '电脑整机', '1', '0,1,', '1', '222', '2017-08-23 10:42:10', '2017-08-23 10:42:10');
INSERT INTO `category` VALUES ('3', '服装', '0', '0,', '1', '333', '2017-08-23 10:42:25', '2017-08-23 10:42:25');
INSERT INTO `category` VALUES ('4', '男士服装', '3', '0,3,', '1', '333', '2017-08-23 10:42:37', '2017-08-23 10:42:37');
INSERT INTO `category` VALUES ('5', '笔记本', '2', '0,1,2,', '1', '444', '2017-08-23 10:42:58', '2017-08-23 10:42:58');
INSERT INTO `category` VALUES ('6', '台式机', '2', '0,1,2,', '1', '666', '2017-08-23 10:43:26', '2017-08-23 10:43:26');
INSERT INTO `category` VALUES ('15', '女士服装', '3', '0,3,', '1', '666', '2017-08-23 13:45:33', '2017-08-23 13:45:33');
INSERT INTO `category` VALUES ('16', '新的一级分类', '0', '0,', '1', '555', '2017-08-25 10:01:35', '2017-08-25 10:01:35');
INSERT INTO `category` VALUES ('17', '信的而积分类', '16', '0,16,', '1', '777', '2017-08-25 10:07:24', '2017-08-25 10:07:24');
INSERT INTO `category` VALUES ('18', '童装', '3', '0,3,', '1', '666', '2017-08-25 10:07:55', '2017-08-25 10:07:55');
INSERT INTO `category` VALUES ('20', '电脑整机测试', '2', '0,1,2,', '1', '666', '2017-08-25 10:11:29', '2017-08-25 10:11:29');

-- ----------------------------
-- Table structure for `member`
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `member_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('1', 'aa', 'aa@bb.cc', '$2y$10$5hRNj6tGie1NP3EpiVvmzO2jA0Rz9bXhM00UHkZi/AoYJOgBEn7MK', '2017-08-29 21:48:43', '2017-08-29 21:48:43');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2017_08_21_162000_create_categories_table', '1');
INSERT INTO `migrations` VALUES ('4', '2017_08_21_162947_create_products_table', '1');
INSERT INTO `migrations` VALUES ('5', '2017_08_21_163631_create_product_descriptions_table', '1');
INSERT INTO `migrations` VALUES ('8', '2017_08_25_144450_create_carts_table', '2');
INSERT INTO `migrations` VALUES ('9', '2017_08_29_204003_create_members_table', '3');

-- ----------------------------
-- Table structure for `password_reset`
-- ----------------------------
DROP TABLE IF EXISTS `password_reset`;
CREATE TABLE `password_reset` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_reset_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_reset
-- ----------------------------

-- ----------------------------
-- Table structure for `product`
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL COMMENT '分类ID',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `price` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '单价',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `sort` int(11) NOT NULL DEFAULT '1000' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_category_id_status_index` (`category_id`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('9', '1', 'hgdgdf', '444.00', '2', '554', '2017-08-24 10:59:10', '2017-08-24 10:59:10');
INSERT INTO `product` VALUES ('10', '1', 'fsafsda', '666.00', '1', '76', '2017-08-24 11:28:28', '2017-08-24 11:28:28');
INSERT INTO `product` VALUES ('11', '1', 'gafds', '444.00', '1', '55', '2017-08-24 11:28:48', '2017-08-24 11:28:48');
INSERT INTO `product` VALUES ('12', '1', '范德萨富士达反对撒', '545.00', '2', '545', '2017-08-24 11:29:02', '2017-08-24 11:29:02');
INSERT INTO `product` VALUES ('13', '1', '反对撒反对撒反对撒反对撒', '55.00', '1', '43', '2017-08-24 11:29:17', '2017-08-24 11:29:17');
INSERT INTO `product` VALUES ('14', '1', 'accc', '555.00', '1', '444', '2017-08-24 11:37:10', '2017-08-24 11:37:10');
INSERT INTO `product` VALUES ('15', '5', '鼻尖部abc', '77.00', '1', '545', '2017-08-25 14:04:56', '2017-08-25 14:04:56');

-- ----------------------------
-- Table structure for `product_description`
-- ----------------------------
DROP TABLE IF EXISTS `product_description`;
CREATE TABLE `product_description` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL COMMENT '商品ID',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of product_description
-- ----------------------------
INSERT INTO `product_description` VALUES ('6', '9', 'fdsafsdafdsa', '2017-08-24 10:59:10', '2017-08-24 10:59:10');
INSERT INTO `product_description` VALUES ('7', '10', 'fsafd', '2017-08-24 11:28:28', '2017-08-24 11:28:28');
INSERT INTO `product_description` VALUES ('8', '11', 'fasfsdafs', '2017-08-24 11:28:48', '2017-08-24 11:28:48');
INSERT INTO `product_description` VALUES ('9', '12', '反对撒反对撒分撒', '2017-08-24 11:29:02', '2017-08-24 11:29:02');
INSERT INTO `product_description` VALUES ('10', '13', '反对撒反对撒反对', '2017-08-24 11:29:17', '2017-08-24 11:29:17');
INSERT INTO `product_description` VALUES ('11', '14', 'fsafsa', '2017-08-24 11:37:10', '2017-08-24 11:37:10');
INSERT INTO `product_description` VALUES ('12', '15', '短发范德萨发撒旦', '2017-08-25 14:04:57', '2017-08-25 14:04:57');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '373966902@qq.com', '$2y$10$9bqT5iNsVZgaSHiWdRbh9Om2ZX5KvS4LsYkHohPmPYc2yytsjylay', '1M71dd24aGxMYwXlMuNf8ekZt6Vw0mKYGjURkfs5BYgR6QU5800sKGYfSlmS', null, null);
