/*
 Navicat Premium Data Transfer

 Source Server         : phpMysql
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : test

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 16/01/2019 21:55:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for buy
-- ----------------------------
DROP TABLE IF EXISTS `buy`;
CREATE TABLE `buy`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `user_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户名',
  `buy_time` datetime NULL DEFAULT NULL COMMENT '购买时间',
  `over_time` datetime NULL DEFAULT NULL COMMENT '过期时间',
  `buy_type` varchar(800) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '购买的套餐类型',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 41 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `web_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `admin_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `admin_pass` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `admin_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `com_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `com_qq` int(255) NULL DEFAULT NULL,
  `comm_qq_group` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `statistics` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES (1, '幽灵SS', 'admin', 'admin', '245778404@qq.com', '245778404@qq.com', 245778404, '52516626', '<script type=\"text/javascript\">var cnzz_protocol = ((\"https:\" == document.location.protocol) ? \"https://\" : \"http://\");document.write(unescape(\"%3Cspan id=\'cnzz_stat_icon_1274036013\'%3E%3C/span%3E%3Cscript src=\'\" + cnzz_protocol + \"s19.cnzz.com/z_stat.php%3Fid%3D1274036013%26show%3Dpic\' type=\'text/javascript\'%3E%3C/script%3E\"));</script>');

-- ----------------------------
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '组名',
  `node` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '线路用,隔开\r\n例如 1,2,3\r\n代表线路1和线路2和线路3可用\r\n',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of group
-- ----------------------------
INSERT INTO `group` VALUES (1, '分组1', '1,2,3');
INSERT INTO `group` VALUES (2, '分组2', '3,4');
INSERT INTO `group` VALUES (6, '分组3', '1,3,4,5');

-- ----------------------------
-- Table structure for nodelist
-- ----------------------------
DROP TABLE IF EXISTS `nodelist`;
CREATE TABLE `nodelist`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(800) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '线路名称',
  `ip_address` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '服务器IP',
  `port` int(255) NULL DEFAULT NULL COMMENT '端口号',
  `pass` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '密码',
  `encryption` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '加密方式',
  `confusion` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '混淆方式',
  `url` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'ssr链接',
  `agreement` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '协议',
  `confusion_cs` varchar(3000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '混淆参数',
  `agreement_cs` varchar(3000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '协议参数',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nodelist
-- ----------------------------
INSERT INTO `nodelist` VALUES (1, '香港线路12', '150.26.121.02', 1325, 'dsgf15s', 'chacha20', 'http_simple', 'ssr://MTQ5LjEyOS44NC4yMTQ6MTk1MDY6YXV0aF9zaGExX3Y0OmNoYWNoYTIwOmh0dHBfc2ltcGxlOll6TktaMjU0Lz9vYmZzcGFyYW09JnJlbWFya3M9ZEdWemRBJmdyb3VwPWRHVnpkQQ', 'auth_sha1_v4', 'null ', 'null ');
INSERT INTO `nodelist` VALUES (2, '日本线路1', '192.546.451.1', 1252, '85641651', 'chacha20', 'http_simple', 'ssr://d3d3Lmdvb2dsZS5jb206MjphdXRoX2NoYWluX2E6Y2hhY2hhMjA6dGxzMS4yX3RpY2tldF9hdXRoOlluSmxZV3QzWVd4cy8_b2Jmc3BhcmFtPSZyZW1hcmtzPVZrbFE1YmV5NVlpdzVweWY3N3lNNVlxZzVZV2xWa2xRNUxxcjVZLVg1NjItNVlpdzVZLU01WUNONXJXQjZZZVAmZ3JvdXA9YkdsaGJtZGphR1Z1ZVhWdQ', 'auth_sha1_v4', NULL, NULL);
INSERT INTO `nodelist` VALUES (3, '韩国高速1', '151.41.13.55', 5521, '4561651', 'chacha20', 'http_simple', 'ssr://aGsyLnNzLm5hY2cudG9wOjEwODU2OmF1dGhfY2hhaW5fYjpub25lOmh0dHBfc2ltcGxlOlozQkZUamd5ZDJkUlZBLz9vYmZzcGFyYW09WjJsMGFIVmlMbU52YlEmZ3JvdXA9VG1samIxTlRVZw', 'auth_sha1_v4', NULL, NULL);
INSERT INTO `nodelist` VALUES (4, '马来西亚1', '132.58.36.123', 2665, '5615156', 'chacha20', 'http_simple', 'ssr://ZGNzMi5zcy5uYWNnLnRvcDoxMDcwMzphdXRoX2NoYWluX2I6bm9uZTpodHRwX3NpbXBsZTphSGxNU0RjemJIWlFXUS8_b2Jmc3BhcmFtPVoybDBhSFZpTG1OdmJRJmdyb3VwPVRtbGpiMU5UVWc', 'auth_sha1_v4', NULL, NULL);

-- ----------------------------
-- Table structure for note
-- ----------------------------
DROP TABLE IF EXISTS `note`;
CREATE TABLE `note`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'note名称',
  `position` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'note位置备注',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'note内容',
  `time` datetime NULL DEFAULT NULL COMMENT 'note发布时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of note
-- ----------------------------
INSERT INTO `note` VALUES (1, 'user_home', '用户中心首页顶部公告', '幽灵SS公告：请勿外借账号，7天内登录IP变动超过3次立即封号！', '2019-01-05 13:44:13');
INSERT INTO `note` VALUES (2, 'user_home_dayline', '用户中心首页模块每日一句', '最好的总会是在最不经意的时候出现。', '2019-01-05 16:45:58');
INSERT INTO `note` VALUES (3, 'user_pay', '用户充值公告', '充值成功后，请耐心等待1-3分钟余额到账后，如遇问题请及时联系客服！', '2019-01-08 13:00:39');
INSERT INTO `note` VALUES (4, 'user_buy', '用户购买公告', '购买套餐前确保余额充足，购买新套餐会覆盖原有套餐！', '2019-01-08 13:08:47');

-- ----------------------------
-- Table structure for pay
-- ----------------------------
DROP TABLE IF EXISTS `pay`;
CREATE TABLE `pay`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NULL DEFAULT NULL,
  `user_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pay_num` decimal(10, 2) NULL DEFAULT NULL,
  `sub_time` datetime NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `way` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10014 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for server
-- ----------------------------
DROP TABLE IF EXISTS `server`;
CREATE TABLE `server`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '套餐名称',
  `price` decimal(10, 2) NULL DEFAULT NULL COMMENT '套餐价格',
  `node_num` int(255) NULL DEFAULT NULL COMMENT '线路数量',
  `dev_num` int(255) NULL DEFAULT NULL COMMENT '设备数量',
  `long_time` varchar(10000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '套餐时长',
  `group` int(255) NULL DEFAULT NULL COMMENT '默认分组',
  `introduce` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '套餐介绍',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of server
-- ----------------------------
INSERT INTO `server` VALUES (1, '月付套餐', 18.88, 4, 2, '720', 1, '月付普通');
INSERT INTO `server` VALUES (2, '季付套餐', 50.00, 6, 2, '2160', 2, '季付普通');
INSERT INTO `server` VALUES (3, '年付套餐', 168.88, 8, 5, '8640', 3, '年付普通');

-- ----------------------------
-- Table structure for ticket
-- ----------------------------
DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '工单标题',
  `content` varchar(6000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '工单内容',
  `user_id` int(255) NULL DEFAULT NULL COMMENT '所属用户ID',
  `user_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '所属用户名',
  `status` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '工单状态\r\n0=等待解决\r\n1=正在处理\r\n2=已回复\r\n3=已解决',
  `back` varchar(6000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '回复工单内容',
  `sub_time` datetime NULL DEFAULT NULL COMMENT '工单提交时间',
  `back_time` datetime NULL DEFAULT NULL COMMENT '工单回复时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10013 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '密码',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '邮箱',
  `qq` int(255) NULL DEFAULT NULL COMMENT 'QQ',
  `last_ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '上次登录IP',
  `ip_check` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '绑定IP',
  `reg_time` datetime NULL DEFAULT NULL COMMENT '注册时间',
  `last_login_time` datetime NULL DEFAULT NULL COMMENT '上次登录时间',
  `is_vip` tinyint(255) NULL DEFAULT 0 COMMENT '是否VIP',
  `vip_time` datetime NULL DEFAULT NULL COMMENT 'VIP过期时间',
  `balance` decimal(10, 2) UNSIGNED NULL DEFAULT 0.00 COMMENT '账户余额',
  `service_type` varchar(600) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '月付套餐' COMMENT '套餐类型',
  `status` int(255) NULL DEFAULT 1 COMMENT '账号状态\r\n0=封禁\r\n1=正常',
  `group` int(255) NULL DEFAULT 0 COMMENT '账号所属分组',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
