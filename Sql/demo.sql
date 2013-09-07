# Host: localhost  (Version: 5.5.16)
# Date: 2013-08-16 15:07:35
# Generator: MySQL-Front 5.3  (Build 4.4)

/*!40101 SET NAMES utf8 */;

#
# Source for table "think_contact"
#

DROP TABLE IF EXISTS `think_contact`;
CREATE TABLE `think_contact` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '姓名',
  `letter` varchar(50) DEFAULT '' COMMENT '拼音',
  `company` varchar(30) DEFAULT '' COMMENT '公司',
  `dept` varchar(20) DEFAULT '' COMMENT '部门',
  `position` varchar(20) DEFAULT '' COMMENT '职位',
  `email` varchar(255) DEFAULT NULL COMMENT '邮件',
  `office_tel` varchar(20) DEFAULT NULL COMMENT '办公电话',
  `mobile_tel` varchar(20) DEFAULT '' COMMENT '移动电话',
  `website` varchar(50) DEFAULT '' COMMENT '网站',
  `im` varchar(20) DEFAULT '' COMMENT '即时通讯',
  `address` varchar(50) DEFAULT '' COMMENT '地址',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `is_del` tinyint(3) NOT NULL DEFAULT '0' COMMENT '删除标记',
  `remark` text COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='think_user_info';

#
# Data for table "think_contact"
#

/*!40000 ALTER TABLE `think_contact` DISABLE KEYS */;
INSERT INTO `think_contact` VALUES (8,'马云','MY','阿里巴巴','董事会','','mayun@ma.com','010-0000001','139-1234-1234','','','2',1,0,''),(9,'马化腾','MIT','腾讯','CEO','CEO','pony@qq.com','公电话','手机','','','2',1,0,''),(10,'雷军','LJ','小米','CEO','CEO','yyyyy@yy.com','010-12341234','139-1234-1234','www.sohu.com','1234567','',1,0,''),(11,'张三','ZS','张三','IT','CEO','zhang@zhang.com','654','321','','12356','1',1,0,'');
/*!40000 ALTER TABLE `think_contact` ENABLE KEYS */;

#
# Source for table "think_customer"
#

DROP TABLE IF EXISTS `think_customer`;
CREATE TABLE `think_customer` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '名称',
  `letter` varchar(50) DEFAULT '' COMMENT '拼音',
  `biz_license` varchar(30) DEFAULT '' COMMENT '营业许可',
  `short` varchar(20) DEFAULT '' COMMENT '简称',
  `contact` varchar(20) DEFAULT '' COMMENT '联系人姓名',
  `email` varchar(255) DEFAULT NULL COMMENT '邮件地址',
  `office_tel` varchar(20) DEFAULT NULL COMMENT '办公电话',
  `mobile_tel` varchar(20) DEFAULT '' COMMENT '移动电话',
  `fax` varchar(20) DEFAULT NULL COMMENT '传真',
  `salesman` varchar(50) DEFAULT '' COMMENT '业务员',
  `im` varchar(20) DEFAULT '' COMMENT '即时通讯',
  `address` varchar(50) DEFAULT '' COMMENT '地址',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `is_del` tinyint(3) NOT NULL DEFAULT '0' COMMENT '删除标记',
  `remark` text,
  `payment` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

#
# Data for table "think_customer"
#

/*!40000 ALTER TABLE `think_customer` DISABLE KEYS */;
INSERT INTO `think_customer` VALUES (18,'123123','','2342342','123123','lianxiren','abc@sdof.com','123125123','123125123','','222yewu','','',1,0,'3245324',''),(19,'123123','','2342342','123123','lianxiren','abc@sdof.com','123125123',NULL,NULL,'yewu',NULL,NULL,0,0,NULL,NULL);
/*!40000 ALTER TABLE `think_customer` ENABLE KEYS */;

#
# Source for table "think_dept"
#

DROP TABLE IF EXISTS `think_dept`;
CREATE TABLE `think_dept` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `dept_no` varchar(20) NOT NULL DEFAULT '',
  `dept_grade_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `short` varchar(20) NOT NULL,
  `sort` varchar(20) NOT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

#
# Data for table "think_dept"
#

/*!40000 ALTER TABLE `think_dept` DISABLE KEYS */;
INSERT INTO `think_dept` VALUES (1,0,'A1',5,'XX企业','','',0,''),(2,1,'BD',7,'运营部','运营','5',0,''),(3,1,'PD',7,'产品部','产品','4',0,''),(4,6,'HR',9,'人事科','人事','',0,''),(5,1,'CEO',6,'总经理','总经','1',0,''),(6,1,'AD',6,'行政部','行政','2',0,''),(7,1,'SD',6,'销售部','销售','3',0,''),(8,1,'RD',6,'开发部','开发','2',0,''),(9,7,'SD1',9,'销售1科','销售1','',0,''),(10,6,'AC',9,'会计科','会计','',0,''),(11,7,'SD2',0,'销售2科','销售2','',0,''),(12,8,'RD2',9,'开发二科','开二','',0,''),(13,8,'RD1',9,'开发一科','开一','',0,'');
/*!40000 ALTER TABLE `think_dept` ENABLE KEYS */;

#
# Source for table "think_dept_grade"
#

DROP TABLE IF EXISTS `think_dept_grade`;
CREATE TABLE `think_dept_grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grade_no` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL,
  `sort` varchar(10) NOT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

#
# Data for table "think_dept_grade"
#

/*!40000 ALTER TABLE `think_dept_grade` DISABLE KEYS */;
INSERT INTO `think_dept_grade` VALUES (5,'DG1','总经理','10',0),(6,'DG10','本部','20',0),(7,'DG20','部','30',0),(8,'DG30','处','40',0),(9,'DG40','科','50',0);
/*!40000 ALTER TABLE `think_dept_grade` ENABLE KEYS */;

#
# Source for table "think_doc"
#

DROP TABLE IF EXISTS `think_doc`;
CREATE TABLE `think_doc` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `doc_no` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `folder` int(11) NOT NULL,
  `add_file` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  `tag_name` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

#
# Data for table "think_doc"
#

/*!40000 ALTER TABLE `think_doc` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_doc` ENABLE KEYS */;

#
# Source for table "think_duty"
#

DROP TABLE IF EXISTS `think_duty`;
CREATE TABLE `think_duty` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `duty_no` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL,
  `sort` varchar(20) NOT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

#
# Data for table "think_duty"
#

/*!40000 ALTER TABLE `think_duty` DISABLE KEYS */;
INSERT INTO `think_duty` VALUES (14,'P001','采购员','',0,'采购员'),(15,'S001','业务员','',0,'');
/*!40000 ALTER TABLE `think_duty` ENABLE KEYS */;

#
# Source for table "think_file"
#

DROP TABLE IF EXISTS `think_file`;
CREATE TABLE `think_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `savename` varchar(100) NOT NULL,
  `size` varchar(20) NOT NULL,
  `extension` varchar(20) NOT NULL,
  `node_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=619 DEFAULT CHARSET=utf8;

#
# Data for table "think_file"
#

/*!40000 ALTER TABLE `think_file` DISABLE KEYS */;
INSERT INTO `think_file` VALUES (596,'logo.png','file/201305/5188996c21ed6.png','5208','png',0,1,1367906668,0),(597,'《中小企业管理制度精细化设计全案》配套光盘.doc','file/201305/51919fc8275c8.doc','2442752','doc',0,1,1368498120,0),(598,'小微企业信息化之道.doc','Doc/201305/5191a5b250fb3.doc','214016','doc',0,1,1368499634,0),(599,'VID_20111105_202255.mp4','Video/201305/51a75c8bcb76f.mp4','16815909','mp4',0,1,1369922699,0),(600,'照片3 031.avi','Video/201305/51a75d6e70fbd.avi','24719178','avi',0,1,1369922926,0),(601,'3.AVI','Video/201305/51a75eb5bb733.AVI','403773818','AVI',0,1,1369923255,0),(602,'mc_slide9_animation_cut.avi','video/201306/51ad73c8c04e3.avi','3211668','avi',0,1,1370321864,0),(603,'video.mp4','video/201306/51afedee248dd.mp4','3479719','mp4',0,1,1370484206,0),(604,'video.mp4','video/201306/51b018c715313.mp4','3479719','mp4',0,1,1370495175,0),(605,'video.mp4','video/201306/51b01d4daaa66.mp4','3479719','mp4',0,1,1370496333,0),(606,'IMG_8604.JPG','question/201306/51b1305038283.JPG','5251295','JPG',0,1,1370566736,0),(607,'IMG_20130129_091441.jpg','question/201306/51b1307b677ed.jpg','560884','jpg',0,1,1370566779,0),(608,'__-0020.jpg','doc/201306/51b44d1f13b20.jpg','96376','jpg',0,1,1370770719,0),(609,'mc_slide9_animation_cut.avi','doc/201306/51b4546f3ce3f.avi','3211668','avi',0,1,1370772591,0),(610,'video.mp4','doc/201306/51b454a6b325e.mp4','3479719','mp4',0,1,1370772646,0),(611,'文档想法.xlsx','userinfo/201306/51b6c753d28ac.xlsx','10267','xlsx',0,1,1370933075,0),(612,'文档想法.xlsx','userinfo/201306/51b6c773efd58.xlsx','10267','xlsx',0,1,1370933107,0),(613,'IMG_8234.JPG','userinfo/201306/51bb2182c2346.JPG','7616658','JPG',0,1,1371218306,0),(614,'video.mp4','video/201306/51bfbb057c8cf.mp4','3479719','mp4',0,1,1371519749,0),(615,'a1ec08fa513d2697b9526ce454fbb2fb4216d882.jpg','userinfo/201306/51bffdef88b9b.jpg','8564','jpg',0,1,1371536879,0),(616,'ThinkPHP3.0 完全开发手册.pdf','notice/201307/51f73668660cd.pdf','2516024','pdf',0,1,1375155816,0),(617,'ThinkPHP3.0 完全开发手册.pdf','notice/201307/51f7374a1c95f.pdf','2516024','pdf',0,1,1375156042,0),(618,'신사업추진팀 네트워크 개선방안20130718.pptx','doc/201308/51f9bebbb9e52.pptx','437704','pptx',0,1,1375321787,0);
/*!40000 ALTER TABLE `think_file` ENABLE KEYS */;

#
# Source for table "think_flow"
#

DROP TABLE IF EXISTS `think_flow`;
CREATE TABLE `think_flow` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `doc_no` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `confirm` varchar(200) NOT NULL,
  `confirm_name` text NOT NULL,
  `consult` varchar(200) NOT NULL,
  `consult_name` text NOT NULL,
  `refer` varchar(200) NOT NULL,
  `refer_name` text NOT NULL,
  `type` varchar(20) NOT NULL,
  `add_file` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(20) NOT NULL,
  `create_date` varchar(10) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `step` int(11) NOT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FULLTEXT KEY `refer_name` (`refer_name`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

#
# Data for table "think_flow"
#

/*!40000 ALTER TABLE `think_flow` DISABLE KEYS */;
INSERT INTO `think_flow` VALUES (75,'开二201308001','申请休假3个月','<span style=\"font-family:宋体;font-size:12pt;\"> </span> \r\n<table style=\"width:100%;border-collapse:collapse;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n\t<tbody>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid black;\" rowspan=\"2\" width=\"83\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"font-family:宋体;font-size:12pt;\">类别<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"761\">\r\n\t\t\t\t<p style=\"text-align:left;\" align=\"left\">\r\n\t\t\t\t\t<span style=\"font-family:宋体;font-size:12pt;\"><span> </span><span>1.</span></span><span style=\"font-family:宋体;font-size:12pt;\"><span>市内公出</span></span><span style=\"font-family:宋体;font-size:12pt;\"><span><span> </span>2.</span>串休，余<span>( )</span>小时<span><span> </span>3.</span>加班<span><span> </span><span style=\"background-color:#E53333;\">4.</span></span><span style=\"background-color:#E53333;\">其它：</span><span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:currentColor;\" height=\"37\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"761\">\r\n\t\t\t\t<p style=\"text-align:left;\" align=\"left\">\r\n\t\t\t\t\t<span style=\"font-family:宋体;font-size:12pt;\"><span> </span><span style=\"background-color:#E53333;\">1. </span></span><span style=\"font-family:宋体;font-size:12pt;\"><span style=\"background-color:#E53333;\">事假</span><span><span> </span>2. </span>病假<span><span> </span>3. </span>婚假<span><span> </span>4. </span>产假<span><span> </span>5. </span>带薪假<span><span> </span>6.</span>丧假<span><span> </span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:currentColor;\" height=\"37\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"83\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"font-family:宋体;font-size:12pt;\"><span> </span></span><span style=\"font-family:宋体;font-size:12pt;\">时间：<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"761\">\r\n\t\t\t\t<p style=\"text-align:left;\" align=\"left\">\r\n\t\t\t\t\t<span style=\"font-family:;font-size:12pt;\"> 201<span> </span></span><span style=\"font-family:宋体;font-size:12pt;\">年</span><span style=\"font-family:;font-size:12pt;\"><span>( )</span></span><span style=\"font-family:宋体;font-size:12pt;\">月</span><span style=\"font-family:;font-size:12pt;\"><span>( )<span></span></span></span><span style=\"font-family:宋体;font-size:12pt;\">日</span><span style=\"font-family:;font-size:12pt;\"><span>( )</span></span><span style=\"font-family:宋体;font-size:12pt;\">时</span><span style=\"font-family:;font-size:12pt;\">——<span> </span>201<span> </span></span><span style=\"font-family:宋体;font-size:12pt;\">年</span><span style=\"font-family:;font-size:12pt;\"><span>( )月( )</span></span><span style=\"font-family:宋体;font-size:12pt;\">日( )</span><span style=\"font-family:宋体;font-size:12pt;\">时</span><span style=\"font-family:;font-size:12pt;\"><span> </span></span><span style=\"font-family:宋体;font-size:12pt;\">合计：( )</span><span style=\"font-family:;font-size:12pt;\"><span> </span></span><span style=\"font-family:宋体;font-size:12pt;\">天</span><span style=\"font-family:;font-size:12pt;\"><span>( )</span></span><span style=\"font-family:宋体;font-size:12pt;\">小时</span><span style=\"font-family:;font-size:12pt;\"></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:currentColor;\" height=\"70\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid black;\" rowspan=\"2\" width=\"83\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"font-family:宋体;font-size:12pt;\">事由：</span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid black;\" rowspan=\"2\" width=\"761\">\r\n\t\t\t\t<span><span style=\"line-height:24px;\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"left\">\r\n\t\t\t\t\t休假需要理由吗？ 需要吗？<br />\r\n&nbsp;</span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"text-align:center;\" height=\"45\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"text-align:left;\" height=\"49\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t</tbody>\r\n</table>\r\n<br />','demo|member|','\r\n\t\t\t\t\t\t\t\t\t\t&nbsp;\r\n\t\t\t\t\t\t\t\t\t<span emp_no=\"demo\">演示  / 总监 <b>→</b>\t</span><span emp_no=\"member\">员工  / 副总 \t</span>','','\r\n\t\t\t\t\t\t\t\t\t\t\t&nbsp;\r\n\t\t\t\t\t\t\t\t\t','','\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t','10','',1,'管理员',12,'开发二科','',1376634340,0,20,0),(76,'开二201308002','采购打印机','办公用品采购计划','admin|demo|','\r\n\t\t\t\t\t\t\t\t\t\t<span emp_no=\"dgp_9_2\">科-经理    <b>→</b>\t</span>&nbsp;\r\n\t\t\t\t\t\t\t\t\t<span emp_no=\"admin\">管理员  / 主管 <b>→</b>\t</span><span emp_no=\"demo\">演示  / 总监 \t</span>','','\r\n\t\t\t\t\t\t\t\t\t\t\t&nbsp;\r\n\t\t\t\t\t\t\t\t\t','','\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t','8','',1,'管理员',12,'开发二科','',1376634389,0,20,0),(77,'开二201308003','报销上海出差费用','<table style=\"width:100%;height:100%;border-collapse:collapse;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n\t<tbody>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"153\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">部门：<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"219\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span><span style=\"line-height:22px;font-size:15px;\"><br />\r\n</span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"109\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">报销项目：<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"219\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">1.</span><span style=\"color:black;font-family:宋体;font-size:11pt;\">费用报销<span><span> </span>2.</span>差旅费报销<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"153\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">报销金额（大写）：<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"219\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span><span style=\"line-height:22px;font-size:15px;\"><br />\r\n</span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"109\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">¥</span><span style=\"color:black;font-family:宋体;font-size:11pt;\">：<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"219\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span><span style=\"line-height:22px;font-size:15px;\"><br />\r\n</span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" valign=\"top\" width=\"700\" colspan=\"4\">\r\n\t\t\t\t<p>\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">用途说明：</span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" valign=\"top\" width=\"700\" colspan=\"4\">\r\n\t\t\t\t<p>\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">原始单据扫描件：</span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t</tbody>\r\n</table>\r\n<span></span>','demo|','\r\n\t\t\t\t\t\t\t\t\t\t&nbsp;\r\n\t\t\t\t\t\t\t\t\t<span emp_no=\"demo\">演示  / 总监 \t</span>','','\r\n\t\t\t\t\t\t\t\t\t\t\t&nbsp;\r\n\t\t\t\t\t\t\t\t\t','','\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t','11','',1,'管理员',12,'开发二科','',1376634426,0,20,0),(78,'开二起案2013-001','1234','<table style=\"width:94.48%;height:112px;\" border=\"1\" cellspacing=\"0\" bordercolor=\"#000000\" cellpadding=\"2\">\r\n\t<tbody>\r\n\t\t<tr>\r\n\t\t\t<td>\r\n\t\t\t\t<p align=\"center\">\r\n\t\t\t\t\tASDF\r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t\t<p align=\"center\">\r\n\t\t\t\t\tASDF\r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t\t<p align=\"center\">\r\n\t\t\t\t\tASDF\r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t\t<p align=\"center\">\r\n\t\t\t\t\tASDF\r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t\t<span></span> \r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t</tbody>\r\n</table>','','\r\n\t\t\t\t\t\t\t\t\t\t<span emp_no=\"dgp_5_2\">总经理-副总经理 <b>→</b> </span><span emp_no=\"dp_6_2\">财务部-副总经理 </span>&nbsp;\r\n\t\t\t\t\t\t\t\t\t','','\r\n\t\t\t\t\t\t\t\t\t\t\t&nbsp;\r\n\t\t\t\t\t\t\t\t\t','','\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t','1','',1,'管理员',12,'开发二科','',1376635576,0,20,0),(79,'开二201308005','123145123','<span style=\"font-family:宋体;font-size:12pt;\"> </span> \r\n<table style=\"width:100%;border-collapse:collapse;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n\t<tbody>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid black;\" rowspan=\"2\" width=\"83\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"font-family:宋体;font-size:12pt;\">类别<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"761\">\r\n\t\t\t\t<p style=\"text-align:left;\" align=\"left\">\r\n\t\t\t\t\t<span style=\"font-family:宋体;font-size:12pt;\"><span> </span>1.</span><span style=\"font-family:宋体;font-size:12pt;\">市内公出<span><span> </span>2.</span>串休，余<span>( )</span>小时<span><span> </span>3.</span>加班<span><span> </span>4.</span>其它：<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:currentColor;\" height=\"37\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"761\">\r\n\t\t\t\t<p style=\"text-align:left;\" align=\"left\">\r\n\t\t\t\t\t<span style=\"font-family:宋体;font-size:12pt;\"><span> </span>1. </span><span style=\"font-family:宋体;font-size:12pt;\">事假<span><span> </span>2. </span>病假<span><span> </span>3. </span>婚假<span><span> </span>4. </span>产假<span><span> </span>5. </span>带薪假<span><span> </span>6.</span>丧假<span><span> </span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:currentColor;\" height=\"37\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"83\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"font-family:宋体;font-size:12pt;\"><span> </span></span><span style=\"font-family:宋体;font-size:12pt;\">时间：<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"761\">\r\n\t\t\t\t<p style=\"text-align:left;\" align=\"left\">\r\n\t\t\t\t\t<span style=\"font-family:;font-size:12pt;\"> 201<span> </span></span><span style=\"font-family:宋体;font-size:12pt;\">年</span><span style=\"font-family:;font-size:12pt;\"><span>( )</span></span><span style=\"font-family:宋体;font-size:12pt;\">月</span><span style=\"font-family:;font-size:12pt;\"><span>( )<span></span></span></span><span style=\"font-family:宋体;font-size:12pt;\">日</span><span style=\"font-family:;font-size:12pt;\"><span>( )</span></span><span style=\"font-family:宋体;font-size:12pt;\">时</span><span style=\"font-family:;font-size:12pt;\">——<span> </span>201<span> </span></span><span style=\"font-family:宋体;font-size:12pt;\">年</span><span style=\"font-family:;font-size:12pt;\"><span>( )月( )</span></span><span style=\"font-family:宋体;font-size:12pt;\">日( )</span><span style=\"font-family:宋体;font-size:12pt;\">时</span><span style=\"font-family:;font-size:12pt;\"><span> </span></span><span style=\"font-family:宋体;font-size:12pt;\">合计：( )</span><span style=\"font-family:;font-size:12pt;\"><span> </span></span><span style=\"font-family:宋体;font-size:12pt;\">天</span><span style=\"font-family:;font-size:12pt;\"><span>( )</span></span><span style=\"font-family:宋体;font-size:12pt;\">小时</span><span style=\"font-family:;font-size:12pt;\"></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:currentColor;\" height=\"70\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid black;\" rowspan=\"2\" width=\"83\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"font-family:宋体;font-size:12pt;\">事由：</span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid black;\" rowspan=\"2\" width=\"761\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span><span style=\"line-height:24px;\"><br />\r\n</span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"text-align:center;\" height=\"45\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"text-align:left;\" height=\"49\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t</tbody>\r\n</table>\r\n<br />','admin|demo|member|','\r\n\t\t\t\t\t\t\t\t\t\t&nbsp;\r\n\t\t\t\t\t\t\t\t\t<span emp_no=\"admin\">管理员  / 主管 <b>→</b>\t</span><span emp_no=\"demo\">演示  / 总监 <b>→</b>\t</span><span emp_no=\"member\">员工  / 副总 \t</span>','','\r\n\t\t\t\t\t\t\t\t\t\t\t&nbsp;\r\n\t\t\t\t\t\t\t\t\t','','\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t','10','',1,'管理员',12,'开发二科','',1376635719,0,21,0);
/*!40000 ALTER TABLE `think_flow` ENABLE KEYS */;

#
# Source for table "think_flow_log"
#

DROP TABLE IF EXISTS `think_flow_log`;
CREATE TABLE `think_flow_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flow_id` int(11) NOT NULL,
  `emp_no` varchar(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(20) NOT NULL,
  `step` int(11) NOT NULL,
  `result` int(11) DEFAULT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;

#
# Data for table "think_flow_log"
#

/*!40000 ALTER TABLE `think_flow_log` DISABLE KEYS */;
INSERT INTO `think_flow_log` VALUES (90,75,'demo',1,'',21,NULL,0,1376634340,0,''),(91,76,'admin',1,'',21,NULL,0,1376634389,0,''),(92,77,'demo',1,'',21,NULL,0,1376634426,0,''),(93,79,'admin',1,'管理员',21,1,0,1376635719,1376635806,'123123123123123123'),(94,79,'demo',NULL,'',22,NULL,0,1376635806,0,'');
/*!40000 ALTER TABLE `think_flow_log` ENABLE KEYS */;

#
# Source for table "think_flow_type"
#

DROP TABLE IF EXISTS `think_flow_type`;
CREATE TABLE `think_flow_type` (
  `id` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(20) NOT NULL,
  `type` int(11) NOT NULL,
  `doc_no_format` varchar(50) NOT NULL,
  `name` varchar(25) NOT NULL,
  `short` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `confirm` varchar(100) NOT NULL,
  `confirm_name` text NOT NULL,
  `consult` varchar(100) NOT NULL,
  `consult_name` text NOT NULL,
  `refer` varchar(100) NOT NULL,
  `refer_name` text NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

#
# Data for table "think_flow_type"
#

/*!40000 ALTER TABLE `think_flow_type` DISABLE KEYS */;
INSERT INTO `think_flow_type` VALUES (1,'起案',0,'{DEPT}{SHORT}{YYYY}-{###}','起案','起案','<table style=\"width:94.48%;height:112px;\" border=\"1\" cellspacing=\"0\" bordercolor=\"#000000\" cellpadding=\"2\">\r\n\t<tbody>\r\n\t\t<tr>\r\n\t\t\t<td>\r\n\t\t\t\t<p align=\"center\">\r\n\t\t\t\t\tASDF\r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t\t<p align=\"center\">\r\n\t\t\t\t\t&nbsp;ASDF\r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t\t<p align=\"center\">\r\n\t\t\t\t\t&nbsp;ASDF\r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t\t<p align=\"center\">\r\n\t\t\t\t\t&nbsp;ASDF\r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td>\r\n\t\t\t\t&nbsp;\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t\t&nbsp;\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t\t&nbsp;\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t\t&nbsp;\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td>\r\n\t\t\t\t&nbsp;&nbsp;\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td>\r\n\t\t\t\t&nbsp;\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t</td>\r\n\t\t\t<td>\r\n\t\t\t\t<span></span>\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t</tbody>\r\n</table>','dgp_5_2|dp_6_2|','<SPAN emp_no=\"dgp_5_2\">总经理-副总经理 <B>→</B> </SPAN><SPAN emp_no=\"dp_6_2\">财务部-副总经理 </SPAN>','','','','',0,1375151700,0,0),(5,'固定',1,'{DEPT}{####}','固定流程','固定','固定流程','dgp_5_2|dp_5_2|dept_10|','<span emp_no=\"dgp_5_2\">总经理-副总经理 <b>→</b>   </span><span emp_no=\"dp_5_2\">总经理-副总经理 <b>→</b>   </span><span emp_no=\"dept_10\">会计科    </span>','','','','',1346553291,1366708686,0,0),(8,'',0,'{DEPT}{YYYY}{M}{###}','办公用品采购','办公用品采购','办公用品采购计划','dgp_9_2|','<span emp_no=\"dgp_9_2\">科-经理    </span>','','','','',1376464817,0,0,0),(9,'',0,'{DEPT}{YYYY}{M}{###}','出差审批','出差审批','<span style=\"color:black;font-family:宋体;font-size:11pt;\">&nbsp;</span><span style=\"color:black;font-family:宋体;font-size:11pt;\">&nbsp;</span><span style=\"color:black;font-family:宋体;font-size:11pt;\">&nbsp;</span> \r\n<table style=\"width:100%;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n\t<tbody>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"109\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">申请时间<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"109\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span><span style=\"line-height:22px;font-size:15px;\"><br />\r\n</span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"109\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">预计完成时间<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"109\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span><span style=\"line-height:22px;font-size:15px;\"><br />\r\n</span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"109\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">实际完成时间<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"109\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span><span style=\"line-height:22px;font-size:15px;\"><br />\r\n</span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:currentColor;\" height=\"33\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" rowspan=\"3\" width=\"109\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">出差城市、路线及时间安排<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" rowspan=\"3\" width=\"547\" colspan=\"5\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span><span style=\"line-height:22px;font-size:15px;\"><br />\r\n</span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:currentColor;\" height=\"33\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:currentColor;\" height=\"33\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:currentColor;\" height=\"33\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" rowspan=\"2\" width=\"109\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">出差要达成的主要绩效目标<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" rowspan=\"2\" width=\"547\" colspan=\"5\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span><span style=\"line-height:22px;font-size:15px;\"><br />\r\n</span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:currentColor;\" height=\"33\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:currentColor;\" height=\"33\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t</tbody>\r\n</table>','','','','','','',1376464911,0,0,101),(10,'',0,'{DEPT}{YYYY}{M}{###}','员工请假申请（三天以内）','员工请假申请','<span style=\"font-family:宋体;font-size:12pt;\">&nbsp;</span> \r\n<table style=\"width:100%;border-collapse:collapse;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n\t<tbody>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid black;\" rowspan=\"2\" width=\"83\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"font-family:宋体;font-size:12pt;\">类别<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"761\">\r\n\t\t\t\t<p style=\"text-align:left;\" align=\"left\">\r\n\t\t\t\t\t<span style=\"font-family:宋体;font-size:12pt;\"><span> </span>1.</span><span style=\"font-family:宋体;font-size:12pt;\">市内公出<span><span> </span>2.</span>串休，余<span>( )</span>小时<span><span> </span>3.</span>加班<span><span> </span>4.</span>其它：<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:currentColor;\" height=\"37\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"761\">\r\n\t\t\t\t<p style=\"text-align:left;\" align=\"left\">\r\n\t\t\t\t\t<span style=\"font-family:宋体;font-size:12pt;\"><span> </span>1. </span><span style=\"font-family:宋体;font-size:12pt;\">事假<span><span> </span>2. </span>病假<span><span> </span>3. </span>婚假<span><span> </span>4. </span>产假<span><span> </span>5. </span>带薪假<span><span> </span>6.</span>丧假<span><span> </span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:currentColor;\" height=\"37\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"83\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"font-family:宋体;font-size:12pt;\"><span> </span></span><span style=\"font-family:宋体;font-size:12pt;\">时间：<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"761\">\r\n\t\t\t\t<p style=\"text-align:left;\" align=\"left\">\r\n\t\t\t\t\t<span style=\"font-family:;font-size:12pt;\"> 201<span> </span></span><span style=\"font-family:宋体;font-size:12pt;\">年</span><span style=\"font-family:;font-size:12pt;\"><span>( )</span></span><span style=\"font-family:宋体;font-size:12pt;\">月</span><span style=\"font-family:;font-size:12pt;\"><span>( )<span></span></span></span><span style=\"font-family:宋体;font-size:12pt;\">日</span><span style=\"font-family:;font-size:12pt;\"><span>( )</span></span><span style=\"font-family:宋体;font-size:12pt;\">时</span><span style=\"font-family:;font-size:12pt;\">——<span> </span>201<span> </span></span><span style=\"font-family:宋体;font-size:12pt;\">年</span><span style=\"font-family:;font-size:12pt;\"><span>( )月( )</span></span><span style=\"font-family:宋体;font-size:12pt;\">日( )</span><span style=\"font-family:宋体;font-size:12pt;\">时</span><span style=\"font-family:;font-size:12pt;\"><span> </span></span><span style=\"font-family:宋体;font-size:12pt;\">合计：( )</span><span style=\"font-family:;font-size:12pt;\"><span> </span></span><span style=\"font-family:宋体;font-size:12pt;\">天</span><span style=\"font-family:;font-size:12pt;\"><span>( )</span></span><span style=\"font-family:宋体;font-size:12pt;\">小时</span><span style=\"font-family:;font-size:12pt;\"></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:currentColor;\" height=\"70\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid black;\" rowspan=\"2\" width=\"83\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"font-family:宋体;font-size:12pt;\">事由：</span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid black;\" rowspan=\"2\" width=\"761\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span><span style=\"line-height:24px;\"><br />\r\n</span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"text-align:center;\" height=\"45\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"text-align:left;\" height=\"49\" width=\"0\">\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t</tbody>\r\n</table>\r\n<br />','','','','','','',1376464960,0,0,0),(11,'',0,'{DEPT}{YYYY}{M}{###}','报销审批','报销审批','<table style=\"width:100%;height:100%;border-collapse:collapse;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n\t<tbody>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"153\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">部门：<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"219\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span><span style=\"line-height:22px;font-size:15px;\"><br />\r\n</span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"109\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">报销项目：<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"219\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">1.</span><span style=\"color:black;font-family:宋体;font-size:11pt;\">费用报销<span><span> </span>2.</span>差旅费报销<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"153\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">报销金额（大写）：<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"219\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span><span style=\"line-height:22px;font-size:15px;\"><br />\r\n</span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"109\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">¥</span><span style=\"color:black;font-family:宋体;font-size:11pt;\">：<span></span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" width=\"219\">\r\n\t\t\t\t<p style=\"text-align:center;\" align=\"center\">\r\n\t\t\t\t\t<span><span style=\"line-height:22px;font-size:15px;\"><br />\r\n</span></span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" valign=\"top\" width=\"700\" colspan=\"4\">\r\n\t\t\t\t<p>\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">用途说明：</span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td style=\"border:1pt solid windowtext;\" valign=\"top\" width=\"700\" colspan=\"4\">\r\n\t\t\t\t<p>\r\n\t\t\t\t\t<span style=\"color:black;font-family:宋体;font-size:11pt;\">原始单据扫描件：</span> \r\n\t\t\t\t</p>\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t</tbody>\r\n</table>\r\n<span></span>','','','','','','',1376465071,0,0,0);
/*!40000 ALTER TABLE `think_flow_type` ENABLE KEYS */;

#
# Source for table "think_forum"
#

DROP TABLE IF EXISTS `think_forum`;
CREATE TABLE `think_forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folder` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `views` int(11) NOT NULL,
  `reply` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `add_file` varchar(200) NOT NULL,
  `last_post` int(11) NOT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

#
# Data for table "think_forum"
#

/*!40000 ALTER TABLE `think_forum` DISABLE KEYS */;
INSERT INTO `think_forum` VALUES (8,17,1,'管理员','发表主题 ','<span>发表主题</span>',10,0,0,'',0,0,1366872802,0),(9,25,1,'管理员','发了各自','发了各自',29,2,0,'',0,0,1374028398,0),(10,27,1,'管理员','员工交流天地','<p>\r\n\t员工交流天地\r\n</p>\r\n<p>\r\n\t&nbsp;\r\n</p>\r\n<p>\r\n\t&nbsp; 今年秋天旅游去哪里&nbsp;\r\n</p>\r\n<p>\r\n\t&nbsp;&nbsp; 1. 夏威夷\r\n</p>\r\n<p>\r\n\t&nbsp;&nbsp; 2. 韩国\r\n</p>\r\n<p>\r\n\t&nbsp;&nbsp; 3. 马尔代夫\r\n</p>\r\n<p>\r\n\t&nbsp;&nbsp; 4. 香港\r\n</p>\r\n<p>\r\n\t&nbsp;&nbsp; 5. 西藏\r\n</p>',7,0,0,'',0,0,1374053565,1376634141);
/*!40000 ALTER TABLE `think_forum` ENABLE KEYS */;

#
# Source for table "think_mail"
#

DROP TABLE IF EXISTS `think_mail`;
CREATE TABLE `think_mail` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `folder` int(11) NOT NULL,
  `mid` varchar(200) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `add_file` varchar(200) DEFAULT NULL,
  `from` varchar(2000) DEFAULT NULL,
  `to` varchar(2000) DEFAULT NULL,
  `reply_to` varchar(2000) DEFAULT NULL,
  `cc` varchar(2000) DEFAULT NULL,
  `read` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`)
) ENGINE=MyISAM AUTO_INCREMENT=1125 DEFAULT CHARSET=utf8;

#
# Data for table "think_mail"
#

/*!40000 ALTER TABLE `think_mail` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_mail` ENABLE KEYS */;

#
# Source for table "think_mail_account"
#

DROP TABLE IF EXISTS `think_mail_account`;
CREATE TABLE `think_mail_account` (
  `id` mediumint(6) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mail_name` varchar(50) NOT NULL,
  `pop3svr` varchar(50) NOT NULL,
  `smtpsvr` varchar(50) NOT NULL,
  `mail_id` varchar(50) NOT NULL,
  `mail_pwd` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='think_user_info';

#
# Data for table "think_mail_account"
#

/*!40000 ALTER TABLE `think_mail_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_mail_account` ENABLE KEYS */;

#
# Source for table "think_mail_organize"
#

DROP TABLE IF EXISTS `think_mail_organize`;
CREATE TABLE `think_mail_organize` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL,
  `sender_check` int(11) NOT NULL,
  `sender_option` int(11) NOT NULL,
  `sender_key` varchar(50) NOT NULL,
  `domain_check` int(100) NOT NULL,
  `domain_option` int(11) NOT NULL,
  `domain_key` varchar(50) NOT NULL,
  `recever_check` int(11) NOT NULL,
  `recever_option` int(11) NOT NULL,
  `recever_key` varchar(50) NOT NULL,
  `title_check` int(11) NOT NULL,
  `title_option` int(11) NOT NULL,
  `title_key` varchar(50) NOT NULL,
  `to` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

#
# Data for table "think_mail_organize"
#

/*!40000 ALTER TABLE `think_mail_organize` DISABLE KEYS */;
INSERT INTO `think_mail_organize` VALUES (12,1,0,0,0,1,'',1,1,'12345',0,1,'',0,1,'',0),(13,1,0,0,0,1,'',1,1,'12345',0,1,'',0,1,'',8),(14,1,1,0,1,1,'1231',0,1,'',0,1,'',0,1,'',0);
/*!40000 ALTER TABLE `think_mail_organize` ENABLE KEYS */;

#
# Source for table "think_node"
#

DROP TABLE IF EXISTS `think_node`;
CREATE TABLE `think_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  `url` varchar(200) NOT NULL,
  `sub_folder` varchar(20) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `sort` varchar(20) DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`is_del`)
) ENGINE=MyISAM AUTO_INCREMENT=177 DEFAULT CHARSET=utf8;

#
# Data for table "think_node"
#

/*!40000 ALTER TABLE `think_node` DISABLE KEYS */;
INSERT INTO `think_node` VALUES (83,'公告',0,'notice/index','','','7',0),(84,'管理',0,'user/index','','','999',0),(85,'邮件',0,'mail/folder?fid=inbox','','','1',0),(87,'审批',0,'flow/index','','','2',0),(88,'文档',0,'doc/index','','','3',0),(91,'日程',0,'schedule/index','','','4',0),(94,'职位',0,'position/index',NULL,'','',1),(97,'部门',0,'dept/index',NULL,'','',1),(100,'写信',0,'mail/add','','','1',85),(101,'收件箱',0,'mail/index','MailFolder','','3',85),(102,'邮件设置',0,'','','','4',85),(104,'垃圾箱',0,'mail/folder?fid=spambox','','','5',101),(105,'发件箱',0,'mail/folder?fid=outbox','','','2',101),(106,'已删除',0,'mail/folder?fid=delbox','','','3',101),(107,'草稿箱',0,'mail/folder?fid=darftbox','','','4',101),(108,'邮件帐户设置',0,'mail_account/index','','','1',102),(110,'公司信息管理',0,'',NULL,'','1',84),(112,'权限管理',0,'',NULL,'','3',84),(113,'系统设定',0,'',NULL,'','4',84),(114,'系统设置',0,'system_config/index','','','1',113),(115,'组织图管理',0,'dept/index','','','1',110),(116,'员工登记',0,'user/index','','','5',110),(118,'权限编码登记',0,'role/index',NULL,'','1',112),(119,'权限编码-菜单映射',0,'role/node',NULL,'','2',112),(120,'权限编码-用户映射',0,'role/user',NULL,'','3',112),(121,'菜单信息设置',0,'node/index',NULL,'','1',113),(122,'职级',0,'rank/index','','','3',110),(123,'职位',0,'position/index','','','2',110),(124,'文件夹设置',0,'mail_folder/index','','','2',102),(125,'联系人',0,'contact/index','','','1',157),(126,'文档搜索',0,'doc/index','','','1',88),(127,'文档库管理',0,'',NULL,'','4',88),(131,'公用文档库管理',0,'doc_folder/index','','','',127),(132,'公用文档库',0,'','DocFolder','','2',88),(134,'公告',0,'','NoticeFolder','','1',83),(137,'论坛',0,'forum/index','ForumFolder','','3',0),(138,'公告管理',0,'notice_folder/index','','','4',134),(139,'论坛管理',0,'forum_folder/index','','','',137),(140,'按月查看',0,'schedule/index','','','1',91),(141,'日程查询',0,'schedule/search','','','2',91),(142,'按日查看',0,'schedule/day_view','','','2',91),(143,'邮件分类',0,'mail_organize/index','','','',102),(144,'起案',0,'flow/index','','','1',87),(145,'审批箱',0,'','','','2',87),(146,'流程管理',0,'flow_type/index','','','3',87),(147,'待审批',0,'flow/folder?fid=confirm','','','3',145),(148,'已办理',0,'flow/folder?fid=finish','','','1',145),(149,'草稿箱',0,'flow/folder?fid=darft','','','2',145),(150,'已提交',0,'flow/folder?fid=submit','','','4',145),(151,'收信',0,'mail/folder?fid=receve','','','2',85),(152,'待办事项',0,'todo/index','','','4',91),(153,'部门级别',0,'dept_grade/index','','','4',110),(154,'业务权限',0,'duty/index','','','4',112),(155,'权限编码-业务权限',0,'role/duty','','','5',112),(156,'客户',0,'customer/index','','','2',157),(157,'人脉',0,'contact/index','','','5',0),(158,'供应商',0,'supplier/index','','','3',157),(169,'职员',0,'staff/index','','','',157);
/*!40000 ALTER TABLE `think_node` ENABLE KEYS */;

#
# Source for table "think_notice"
#

DROP TABLE IF EXISTS `think_notice`;
CREATE TABLE `think_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_no` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `folder` int(11) NOT NULL DEFAULT '0',
  `add_file` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

#
# Data for table "think_notice"
#

/*!40000 ALTER TABLE `think_notice` DISABLE KEYS */;
INSERT INTO `think_notice` VALUES (24,'2013-0001','sssss','ssssssssssssssssssssssssss',15,'',1,'管理员',0,1366874793,0),(25,'2013-0002','xxxxxx','xxxxxxxxxxxxxxxxxxxxxx',15,'',1,'管理员',0,1367735751,0),(26,'2013-0003','q','qqqqqqqqqqqqq',15,'',1,'管理员',0,1367735757,0),(27,'2013-0004','1','111111111111111',15,'',1,'管理员',0,1370508661,0),(28,'2013-0005','33333','333333333333333333333',15,'',1,'管理员',0,1370508667,0),(29,'2013-0006','333','3333333333333333333',15,'',1,'管理员',0,1370508673,0),(30,'2013-0007','3222222222','22222222222222222222',15,'',1,'管理员',0,1370508678,0),(31,'2013-0008','XXXXXXXXXXXXXXXXXXX','SSSSSSSSSSSSSSS',15,'',1,'管理员',0,1370508706,0),(32,'2013-0009','ZZZZZZZZZZZZZ','ZZZZZZZZZZZZZZZZZZ',15,'',1,'管理员',0,1370508714,0),(33,'2013-0010','CCCCCC','CCCCCCCCCCCCCCCCCCCCC',15,'',1,'管理员',0,1370508723,0),(34,'2013-0011','DDDDDDDD','DDDDDDDDDDDDDDDDDDDDD',15,'',1,'管理员',0,1370508728,0),(35,'2013-0012','FFFFFFFFFF','FFFFFFFFFFFFFFFFF',15,'',1,'管理员',0,1370508734,0),(36,'2013-0013','33333333','333333333333333333',15,'',1,'管理员',0,1370508785,0),(37,'2013-0014','333333333','3333333333333333333',15,'',1,'管理员',0,1370508791,0),(38,'2013-0015','3333333333','33333333333333333333',15,'',1,'管理员',0,1370508799,0),(39,'2013-0016','333333333','33333333333333333333',15,'',1,'管理员',0,1370508805,0),(40,'2013-0017','333333333333','333333333333333333333333333',15,'',1,'管理员',0,1370508812,0),(41,'2013-0018','公告 1','1公告',26,'',1,'管理员',0,1373937632,0),(42,'2013-0019','QQQQQQQQ','AAAAAAAAAAAAAAAAAAAAQQQQQQQQQQQQQQQQQQ',26,'',1,'管理员',0,1374031714,1375155796),(43,'2013-0020','岗位轮换 XXX部 部长 担任 XX部 ','岗位轮换 XXX部 部长 担任 XX部 部长',26,'',1,'管理员',0,1374031720,1376634040),(44,'2013-0021','BABABABABABBABABB','XXXXXXX',0,'616;',1,'管理员',0,1375155819,0),(45,'2013-0022','XXX晋升为XXXX X月X日开始生效','XXX晋升为XXXX X月X日开始生效',26,'617;',1,'管理员',0,1375156032,1376634004);
/*!40000 ALTER TABLE `think_notice` ENABLE KEYS */;

#
# Source for table "think_position"
#

DROP TABLE IF EXISTS `think_position`;
CREATE TABLE `think_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position_no` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL,
  `sort` varchar(10) NOT NULL,
  `is_del` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Data for table "think_position"
#

/*!40000 ALTER TABLE `think_position` DISABLE KEYS */;
INSERT INTO `think_position` VALUES (1,'PG40','主管','5',0),(2,'PG30','经理','4',0),(3,'PG20','总监','3',0),(4,'PG10','副总','2',0),(5,'PG1','总经理','1',0),(6,'PG50','员工','6',0);
/*!40000 ALTER TABLE `think_position` ENABLE KEYS */;

#
# Source for table "think_post"
#

DROP TABLE IF EXISTS `think_post`;
CREATE TABLE `think_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `add_file` varchar(200) NOT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

#
# Data for table "think_post"
#

/*!40000 ALTER TABLE `think_post` DISABLE KEYS */;
INSERT INTO `think_post` VALUES (37,9,'','1234123123',1,'管理员','',0,1374029462,0),(38,9,'','123123123123',1,'管理员','',0,1374029878,0);
/*!40000 ALTER TABLE `think_post` ENABLE KEYS */;

#
# Source for table "think_push"
#

DROP TABLE IF EXISTS `think_push`;
CREATE TABLE `think_push` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `data` text NOT NULL,
  `status` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `info` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=618 DEFAULT CHARSET=utf8;

#
# Data for table "think_push"
#

/*!40000 ALTER TABLE `think_push` DISABLE KEYS */;
/*!40000 ALTER TABLE `think_push` ENABLE KEYS */;

#
# Source for table "think_rank"
#

DROP TABLE IF EXISTS `think_rank`;
CREATE TABLE `think_rank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rank_no` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL,
  `sort` varchar(10) NOT NULL,
  `is_del` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "think_rank"
#

/*!40000 ALTER TABLE `think_rank` DISABLE KEYS */;
INSERT INTO `think_rank` VALUES (1,'RG40','总监','',0),(2,'RG30','经理','',0),(3,'RG20','主管','',0),(4,'RG10','助理','',0);
/*!40000 ALTER TABLE `think_rank` ENABLE KEYS */;

#
# Source for table "think_recent"
#

DROP TABLE IF EXISTS `think_recent`;
CREATE TABLE `think_recent` (
  `user_id` int(11) NOT NULL,
  `recent` varchar(2000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "think_recent"
#

/*!40000 ALTER TABLE `think_recent` DISABLE KEYS */;
INSERT INTO `think_recent` VALUES (1,'smeoa@qq.com|smeoa@qq.com;cn86shichang@foxmail.com|cn86shichang@foxmail.com;');
/*!40000 ALTER TABLE `think_recent` ENABLE KEYS */;

#
# Source for table "think_relation"
#

DROP TABLE IF EXISTS `think_relation`;
CREATE TABLE `think_relation` (
  `row_id` int(11) NOT NULL DEFAULT '0',
  `relation_id` int(11) NOT NULL DEFAULT '0',
  `relation` varchar(20) NOT NULL DEFAULT '',
  KEY `row_id` (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "think_relation"
#

/*!40000 ALTER TABLE `think_relation` DISABLE KEYS */;
INSERT INTO `think_relation` VALUES (17,31,'Course|Video'),(16,29,'Course|Video'),(16,28,'Course|Video'),(14,29,'Course|Video'),(14,28,'Course|Video'),(14,27,'Course|Video'),(14,4,'Course|Position'),(14,3,'Course|Position'),(14,2,'Course|Position'),(14,10,'Course|Dept'),(14,6,'Course|Dept'),(14,5,'Course|Dept'),(13,29,'Course|Video'),(13,28,'Course|Video'),(13,27,'Course|Video'),(13,4,'Course|Position'),(13,3,'Course|Position'),(13,2,'Course|Position'),(13,10,'Course|Dept'),(13,6,'Course|Dept'),(13,5,'Course|Dept'),(17,30,'Course|Video'),(17,28,'Course|Video'),(24,30,'Course|Video'),(24,31,'Course|Video'),(22,32,'Course|Video'),(23,31,'Course|Video'),(21,32,'Course|Video'),(21,31,'Course|Video'),(21,30,'Course|Video'),(22,31,'Course|Video');
/*!40000 ALTER TABLE `think_relation` ENABLE KEYS */;

#
# Source for table "think_role"
#

DROP TABLE IF EXISTS `think_role`;
CREATE TABLE `think_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` varchar(20) DEFAULT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parentId` (`pid`),
  KEY `ename` (`sort`),
  KEY `status` (`is_del`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

#
# Data for table "think_role"
#

/*!40000 ALTER TABLE `think_role` DISABLE KEYS */;
INSERT INTO `think_role` VALUES (1,'公司管理员',0,0,'','1',1208784792,1368507168),(2,'基本权限',0,0,'','2',1215496283,1368507164),(7,'测试组',0,0,'','2',1254325787,1368507159);
/*!40000 ALTER TABLE `think_role` ENABLE KEYS */;

#
# Source for table "think_role_duty"
#

DROP TABLE IF EXISTS `think_role_duty`;
CREATE TABLE `think_role_duty` (
  `role_id` smallint(6) unsigned NOT NULL,
  `duty_id` smallint(6) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "think_role_duty"
#

/*!40000 ALTER TABLE `think_role_duty` DISABLE KEYS */;
INSERT INTO `think_role_duty` VALUES (1,14),(1,15),(2,14),(2,15);
/*!40000 ALTER TABLE `think_role_duty` ENABLE KEYS */;

#
# Source for table "think_role_node"
#

DROP TABLE IF EXISTS `think_role_node`;
CREATE TABLE `think_role_node` (
  `role_id` int(11) NOT NULL,
  `node_id` int(11) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `read` tinyint(1) DEFAULT NULL,
  `write` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "think_role_node"
#

/*!40000 ALTER TABLE `think_role_node` DISABLE KEYS */;
INSERT INTO `think_role_node` VALUES (2,136,NULL,NULL,NULL),(2,137,NULL,NULL,NULL),(2,135,NULL,NULL,NULL),(2,134,NULL,NULL,NULL),(1,94,NULL,NULL,NULL),(1,97,NULL,NULL,NULL),(1,98,NULL,NULL,NULL),(1,99,NULL,NULL,NULL),(1,69,NULL,NULL,NULL),(1,6,NULL,NULL,NULL),(1,2,NULL,NULL,NULL),(1,7,NULL,NULL,NULL),(1,131,1,1,1),(1,130,NULL,NULL,NULL),(1,127,NULL,NULL,NULL),(1,133,NULL,NULL,NULL),(1,132,NULL,NULL,NULL),(1,126,1,1,1),(1,139,1,1,1),(1,137,1,1,1),(1,135,NULL,NULL,NULL),(1,136,NULL,NULL,NULL),(1,117,NULL,NULL,NULL),(1,138,1,1,1),(1,134,NULL,NULL,NULL),(2,125,NULL,NULL,NULL),(2,100,NULL,NULL,NULL),(2,101,NULL,NULL,NULL),(2,105,NULL,NULL,NULL),(2,106,NULL,NULL,NULL),(2,107,NULL,NULL,NULL),(2,104,NULL,NULL,NULL),(2,102,NULL,NULL,NULL),(2,108,NULL,NULL,NULL),(2,124,NULL,NULL,NULL),(2,103,NULL,NULL,NULL),(2,100,NULL,NULL,NULL),(2,126,NULL,NULL,NULL),(2,132,NULL,NULL,NULL),(2,133,NULL,NULL,NULL),(2,130,NULL,NULL,NULL),(2,125,NULL,NULL,NULL),(7,124,NULL,NULL,NULL),(7,108,NULL,NULL,NULL),(7,102,NULL,NULL,NULL),(7,104,NULL,NULL,NULL),(7,107,NULL,NULL,NULL),(7,106,NULL,NULL,NULL),(7,105,NULL,NULL,NULL),(7,101,NULL,NULL,NULL),(7,100,NULL,NULL,NULL),(7,125,NULL,NULL,NULL),(1,152,NULL,NULL,NULL),(1,142,NULL,NULL,NULL),(1,141,NULL,NULL,NULL),(2,100,NULL,NULL,NULL),(2,151,NULL,NULL,NULL),(2,101,NULL,NULL,NULL),(2,105,NULL,NULL,NULL),(2,106,NULL,NULL,NULL),(2,107,NULL,NULL,NULL),(2,104,NULL,NULL,NULL),(2,102,NULL,NULL,NULL),(2,108,NULL,NULL,NULL),(2,124,NULL,NULL,NULL),(2,103,NULL,NULL,NULL),(2,125,NULL,NULL,NULL),(1,140,NULL,NULL,NULL),(1,91,NULL,NULL,NULL),(1,91,NULL,NULL,NULL),(2,151,NULL,NULL,NULL),(2,101,NULL,NULL,NULL),(2,105,NULL,NULL,NULL),(2,106,NULL,NULL,NULL),(2,107,NULL,NULL,NULL),(2,104,NULL,NULL,NULL),(2,103,NULL,NULL,NULL),(2,109,NULL,NULL,NULL),(2,102,NULL,NULL,NULL),(2,143,NULL,NULL,NULL),(2,108,NULL,NULL,NULL),(2,124,NULL,NULL,NULL),(2,144,NULL,NULL,NULL),(2,145,NULL,NULL,NULL),(2,149,NULL,NULL,NULL),(2,147,NULL,NULL,NULL),(2,148,NULL,NULL,NULL),(2,150,NULL,NULL,NULL),(2,140,NULL,NULL,NULL),(2,142,NULL,NULL,NULL),(2,141,NULL,NULL,NULL),(2,152,NULL,NULL,NULL),(1,117,NULL,NULL,NULL),(1,117,NULL,NULL,NULL),(1,117,NULL,NULL,NULL),(1,117,NULL,NULL,NULL),(1,103,NULL,NULL,NULL),(1,109,NULL,NULL,NULL),(1,117,NULL,NULL,NULL),(1,117,NULL,NULL,NULL),(1,163,NULL,NULL,NULL),(1,158,1,1,1),(1,170,NULL,NULL,NULL),(1,164,NULL,NULL,NULL),(1,114,1,1,1),(1,146,1,1,1),(1,121,1,1,1),(1,113,NULL,NULL,NULL),(1,188,NULL,NULL,NULL),(1,155,NULL,NULL,NULL),(1,154,1,1,1),(1,120,NULL,NULL,NULL),(1,119,NULL,NULL,NULL),(1,118,1,1,1),(1,112,NULL,NULL,NULL),(1,116,1,1,1),(1,153,1,1,1),(1,111,NULL,NULL,NULL),(1,122,1,1,1),(1,156,1,1,1),(1,123,1,1,1),(1,115,1,1,1),(1,110,NULL,NULL,NULL),(1,150,NULL,NULL,NULL),(1,149,NULL,NULL,NULL),(1,148,NULL,NULL,NULL),(1,147,NULL,NULL,NULL),(1,145,NULL,NULL,NULL),(1,144,1,1,1),(1,124,1,1,1),(1,108,1,1,1),(1,143,1,1,1),(1,102,NULL,NULL,NULL),(1,104,NULL,NULL,NULL),(1,107,NULL,NULL,NULL),(1,106,NULL,NULL,NULL),(1,105,NULL,NULL,NULL),(1,101,1,1,1),(1,151,NULL,NULL,NULL),(1,125,1,1,1),(1,168,NULL,NULL,NULL),(1,162,NULL,NULL,NULL),(1,166,NULL,NULL,NULL),(1,161,NULL,NULL,NULL),(1,171,NULL,NULL,NULL),(1,169,1,1,1),(1,165,NULL,NULL,NULL),(1,174,NULL,NULL,NULL),(1,172,NULL,NULL,NULL),(1,173,NULL,NULL,NULL),(1,160,NULL,NULL,NULL),(1,175,NULL,NULL,NULL),(1,186,NULL,NULL,NULL),(1,185,NULL,NULL,NULL),(1,183,NULL,NULL,NULL),(1,182,NULL,NULL,NULL),(1,181,NULL,NULL,NULL),(1,180,NULL,NULL,NULL),(1,179,NULL,NULL,NULL),(1,178,NULL,NULL,NULL),(1,184,NULL,NULL,NULL),(1,176,NULL,NULL,NULL),(1,84,1,1,1),(1,194,NULL,NULL,NULL),(1,193,NULL,NULL,NULL),(1,187,NULL,NULL,NULL),(1,100,NULL,NULL,NULL),(1,85,NULL,NULL,NULL),(1,87,1,1,1),(1,88,1,1,1),(1,157,1,1,1),(1,167,NULL,NULL,NULL),(1,83,1,1,1),(1,128,NULL,NULL,NULL),(1,192,NULL,NULL,NULL),(1,191,NULL,NULL,NULL),(1,190,NULL,NULL,NULL),(1,189,NULL,NULL,NULL),(1,177,NULL,NULL,NULL),(1,195,NULL,NULL,NULL),(1,199,NULL,NULL,NULL),(1,213,NULL,NULL,NULL),(1,198,NULL,NULL,NULL),(1,197,NULL,NULL,NULL),(1,229,NULL,NULL,NULL),(1,228,NULL,NULL,NULL),(1,227,NULL,NULL,NULL),(1,226,NULL,NULL,NULL),(1,225,NULL,NULL,NULL),(1,224,NULL,NULL,NULL),(1,223,NULL,NULL,NULL),(1,222,NULL,NULL,NULL),(1,221,NULL,NULL,NULL),(1,220,NULL,NULL,NULL),(1,219,NULL,NULL,NULL),(1,217,NULL,NULL,NULL),(1,218,NULL,NULL,NULL),(1,216,NULL,NULL,NULL),(1,215,NULL,NULL,NULL),(1,214,NULL,NULL,NULL),(1,196,NULL,NULL,NULL),(1,200,NULL,NULL,NULL),(1,201,NULL,NULL,NULL),(1,202,NULL,NULL,NULL),(1,203,NULL,NULL,NULL),(1,204,NULL,NULL,NULL),(1,205,NULL,NULL,NULL),(1,206,NULL,NULL,NULL),(1,207,NULL,NULL,NULL),(1,208,NULL,NULL,NULL),(1,209,NULL,NULL,NULL),(1,210,NULL,NULL,NULL),(1,211,NULL,NULL,NULL),(1,212,NULL,NULL,NULL);
/*!40000 ALTER TABLE `think_role_node` ENABLE KEYS */;

#
# Source for table "think_role_user"
#

DROP TABLE IF EXISTS `think_role_user`;
CREATE TABLE `think_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "think_role_user"
#

/*!40000 ALTER TABLE `think_role_user` DISABLE KEYS */;
INSERT INTO `think_role_user` VALUES (4,'27'),(4,'26'),(5,'31'),(3,'22'),(7,'1'),(1,'4'),(1,'3'),(2,'2'),(1,'35'),(1,'36'),(1,'2'),(2,'1'),(2,'3'),(1,'1'),(7,'36'),(7,'2');
/*!40000 ALTER TABLE `think_role_user` ENABLE KEYS */;

#
# Source for table "think_schedule"
#

DROP TABLE IF EXISTS `think_schedule`;
CREATE TABLE `think_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `location` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_date` date NOT NULL,
  `end_time` time NOT NULL,
  `actor` varchar(200) NOT NULL,
  `add_file` varchar(200) NOT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

#
# Data for table "think_schedule"
#

/*!40000 ALTER TABLE `think_schedule` DISABLE KEYS */;
INSERT INTO `think_schedule` VALUES (43,'新建事项','','123123',1,'2013-03-01','05:00:00','2013-03-01','05:00:00','','',0,3),(44,'qqqqqqqqqqqqqq','','',1,'2013-04-25','05:00:00','2013-03-13','05:00:00','','',0,3),(45,'看看日程中文样式效果','','',1,'2013-05-07','08:00:00','2013-05-07','05:00:00','','',0,3),(46,'123456','xxx','1234',1,'2013-07-03','05:00:00','2013-07-18','05:00:00','管理员 / 总经理 ✕|undefined;演示 / 部长 ✕|undefined;员工 / 经理1 ✕|undefined;','',0,3),(47,'123','123123','123',1,'2013-08-15','05:00:00','2013-08-15','05:00:00','','',0,3),(48,'234','','',1,'2013-08-15','05:00:00','2013-08-16','05:00:00','','',0,3),(49,'456','','234234',1,'2013-08-15','05:00:00','2013-08-15','05:00:00','','',0,3),(50,'5677','','',1,'2013-08-15','05:00:00','2013-08-30','05:00:00','','',0,3),(51,'123456','114474','',1,'2013-08-15','05:00:00','2013-08-31','05:00:00','','',0,3),(52,'123352435','3234234234','2342342',1,'2013-08-15','05:00:00','2013-08-15','05:00:00','','',0,3),(53,'给幼儿园老师送礼','需要吗？','需要吗？',1,'2013-09-12','05:00:00','2013-09-21','05:00:00','','',0,3);
/*!40000 ALTER TABLE `think_schedule` ENABLE KEYS */;

#
# Source for table "think_supplier"
#

DROP TABLE IF EXISTS `think_supplier`;
CREATE TABLE `think_supplier` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `letter` varchar(50) DEFAULT '',
  `short` varchar(30) DEFAULT '',
  `account` varchar(20) DEFAULT '',
  `tax_no` varchar(20) DEFAULT '',
  `payment` varchar(20) DEFAULT NULL,
  `contact` varchar(20) NOT NULL DEFAULT '',
  `office_tel` varchar(20) DEFAULT NULL,
  `mobile_tel` varchar(20) DEFAULT '',
  `email` varchar(50) DEFAULT '',
  `im` varchar(20) DEFAULT '',
  `address` varchar(50) DEFAULT '',
  `user_id` int(11) NOT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  `remark` text,
  `fax` varchar(255) DEFAULT NULL,
  `user_name` varchar(21) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

#
# Data for table "think_supplier"
#

/*!40000 ALTER TABLE `think_supplier` DISABLE KEYS */;
INSERT INTO `think_supplier` VALUES (18,'供应商2','GYS','供应2','4321','4321','ZZ ','联系人','1234','','ABC@QQ.COM','',' XX',1,0,'','',NULL),(19,'供应商1','GY','供应','1234','4321','ZZ ','联系人','1234','','YY@QQ.COM','',' XX',0,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `think_supplier` ENABLE KEYS */;

#
# Source for table "think_system_config"
#

DROP TABLE IF EXISTS `think_system_config`;
CREATE TABLE `think_system_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `val` varchar(255) DEFAULT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Data for table "think_system_config"
#

/*!40000 ALTER TABLE `think_system_config` DISABLE KEYS */;
INSERT INTO `think_system_config` VALUES (1,'SYSTEM_NAME','系统名称','小微企业信息化',1),(2,'GSM_PORT','GSM端口','COM4',1);
/*!40000 ALTER TABLE `think_system_config` ENABLE KEYS */;

#
# Source for table "think_system_folder"
#

DROP TABLE IF EXISTS `think_system_folder`;
CREATE TABLE `think_system_folder` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `folder` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `admin` varchar(200) NOT NULL,
  `write` varchar(200) NOT NULL,
  `read` varchar(200) NOT NULL,
  `sort` varchar(20) NOT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

#
# Data for table "think_system_folder"
#

/*!40000 ALTER TABLE `think_system_folder` DISABLE KEYS */;
INSERT INTO `think_system_folder` VALUES (21,0,'DocFolder','公司制度','管理员 / 总经理 |admin;','','','',0,''),(22,0,'DocFolder','公司表格','','管理员 / 总经理 |admin;','','',0,''),(23,0,'DocFolder','系统使用手册','管理员 / 总经理 |admin;演示 / 部长 |demo;员工 / 经理1 |member;','','','',0,''),(24,0,'DocFolder','123123','','','','',1,''),(25,0,'ForumFolder','员工之家','管理员 / 总经理 |admin;','','','',0,''),(26,0,'NoticeFolder','人事令','管理员 / 总经理 |admin;','','','',0,''),(27,0,'ForumFolder','OA系统错误提交','','','','',0,''),(28,0,'NoticeFolder','培训通知','','','','',0,''),(29,0,'NoticeFolder','放假通知','','','','',0,'');
/*!40000 ALTER TABLE `think_system_folder` ENABLE KEYS */;

#
# Source for table "think_system_tag"
#

DROP TABLE IF EXISTS `think_system_tag`;
CREATE TABLE `think_system_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `module` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sort` varchar(20) NOT NULL,
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

#
# Data for table "think_system_tag"
#

/*!40000 ALTER TABLE `think_system_tag` DISABLE KEYS */;
INSERT INTO `think_system_tag` VALUES (11,0,'Video','所属科室','11',''),(12,11,'Video','外科系统','12',''),(13,11,'Video','内科系统','13',''),(14,12,'Video','普通外科','14',''),(15,12,'Video','肛肠科','15',''),(16,11,'Video','专科中心','16',''),(17,11,'Video','医技辅助','17',''),(18,12,'Video','肝胆外科','18',''),(19,12,'Video','器官移植','19',''),(20,12,'Video','心血管外科','20',''),(21,12,'Video','显微外科','21',''),(22,12,'Video','胸外科','22',''),(23,12,'Video','泌尿生殖','23',''),(24,12,'Video','神经外科','24',''),(25,12,'Video','烧伤外科','25',''),(26,13,'Video','普通内科','26',''),(27,13,'Video','心血管内科','27',''),(28,13,'Video','呼吸内科','28',''),(29,13,'Video','消化内科','29',''),(30,13,'Video','肾内科','30',''),(31,13,'Video','血液科','31',''),(32,13,'Video','神经内科','32',''),(33,13,'Video','心理、精神科','33',''),(34,13,'Video','内分泌科','34',''),(35,13,'Video','感染传染','35',''),(36,16,'Video','妇产科','36',''),(37,16,'Video','儿科','37',''),(38,16,'Video','口腔科','38',''),(39,16,'Video','骨科','39',''),(40,16,'Video','皮肤病与性病科','40',''),(41,16,'Video','眼科','41',''),(42,16,'Video','耳鼻咽喉科','42',''),(43,16,'Video','肿瘤及核医学','43',''),(44,16,'Video','中医及中西医结合','44',''),(45,16,'Video','麻醉科','45',''),(46,16,'Video','美容整形','46',''),(47,17,'Video','门、急诊，ICU','47',''),(48,17,'Video','医学影像','48',''),(49,17,'Video','护理','49',''),(50,17,'Video','检验科','50',''),(51,17,'Video','康复理疗科','51',''),(52,17,'Video','药剂科','52',''),(53,17,'Video','信息科','53',''),(54,17,'Video','医院管理','54',''),(55,17,'Video','基础教学','55',''),(56,17,'Video','其他','56',''),(57,NULL,'Customer','123','',''),(58,NULL,'Supplier','123','',''),(59,0,'Doc','123123','123123',''),(60,0,'Doc','123123','',''),(61,0,'Doc','abc','',''),(62,NULL,'Customer','2345','','');
/*!40000 ALTER TABLE `think_system_tag` ENABLE KEYS */;

#
# Source for table "think_system_tag_data"
#

DROP TABLE IF EXISTS `think_system_tag_data`;
CREATE TABLE `think_system_tag_data` (
  `row_id` int(11) NOT NULL DEFAULT '0',
  `tag_id` int(11) NOT NULL DEFAULT '0',
  `module` varchar(20) NOT NULL DEFAULT '',
  KEY `row_id` (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "think_system_tag_data"
#

/*!40000 ALTER TABLE `think_system_tag_data` DISABLE KEYS */;
INSERT INTO `think_system_tag_data` VALUES (18,58,'Supplier'),(29,14,'Video'),(18,57,'Customer'),(29,46,'Video'),(30,46,'Video'),(30,47,'Video'),(30,56,'Video'),(64,59,'Doc'),(64,60,'Doc'),(64,61,'Doc'),(65,61,'Doc'),(33,14,'Video'),(18,62,'Customer');
/*!40000 ALTER TABLE `think_system_tag_data` ENABLE KEYS */;

#
# Source for table "think_todo"
#

DROP TABLE IF EXISTS `think_todo`;
CREATE TABLE `think_todo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `end_date` varchar(10) DEFAULT NULL,
  `priority` int(11) NOT NULL,
  `add_file` varchar(200) NOT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

#
# Data for table "think_todo"
#

/*!40000 ALTER TABLE `think_todo` DISABLE KEYS */;
INSERT INTO `think_todo` VALUES (11,'邮件整理时显示名称错误','',1,'',3,'',0,NULL),(12,'日历今天样式颜色','日历今天样式颜色',1,'',3,'',0,NULL);
/*!40000 ALTER TABLE `think_todo` ENABLE KEYS */;

#
# Source for table "think_user"
#

DROP TABLE IF EXISTS `think_user`;
CREATE TABLE `think_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `emp_no` varchar(10) NOT NULL,
  `emp_name` varchar(20) NOT NULL,
  `letter` varchar(10) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `birthday` date DEFAULT NULL,
  `last_login_ip` varchar(40) DEFAULT NULL,
  `login_count` int(8) DEFAULT NULL,
  `pic` varchar(200) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `duty` varchar(2000) NOT NULL,
  `office_tel` varchar(20) NOT NULL,
  `mobile_tel` varchar(20) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`emp_no`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

#
# Data for table "think_user"
#

/*!40000 ALTER TABLE `think_user` DISABLE KEYS */;
INSERT INTO `think_user` VALUES (1,'admin','管理员','GLY','21232f297a57a5a743894a0e4a801fc3',12,1,1,'male','0000-00-00','127.0.0.1',1878,'','smeoa@qq.com','2342343','XXXXXX','1',1222907803,1374109343,0),(2,'demo','演示','YS','fe01ce2a7fbac8fafaed7c982a04e229',9,3,3,'female','1983-03-17','127.0.0.1',112,'','XXXX','asdf','','2',1239783735,1371214569,0),(3,'member','员工','YG','202cb962ac59075b964b07152d234b70',6,4,4,'male','2012-03-15','127.0.0.1',19,'','XXXX','asd','','3',1253514375,1370333340,0);
/*!40000 ALTER TABLE `think_user` ENABLE KEYS */;

#
# Source for table "think_user_config"
#

DROP TABLE IF EXISTS `think_user_config`;
CREATE TABLE `think_user_config` (
  `id` int(11) NOT NULL DEFAULT '0',
  `home_sort` varchar(255) DEFAULT NULL,
  `list_rows` int(11) DEFAULT '20',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "think_user_config"
#

/*!40000 ALTER TABLE `think_user_config` DISABLE KEYS */;
INSERT INTO `think_user_config` VALUES (1,'1,2,3,4,5,6,',13);
/*!40000 ALTER TABLE `think_user_config` ENABLE KEYS */;

#
# Source for table "think_user_folder"
#

DROP TABLE IF EXISTS `think_user_folder`;
CREATE TABLE `think_user_folder` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `folder` varchar(20) NOT NULL,
  `public` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `admin` varchar(200) NOT NULL,
  `write` varchar(200) NOT NULL,
  `read` varchar(200) NOT NULL,
  `sort` varchar(20) NOT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

#
# Data for table "think_user_folder"
#

/*!40000 ALTER TABLE `think_user_folder` DISABLE KEYS */;
INSERT INTO `think_user_folder` VALUES (21,24,'MailFolder',2,1,'123','','','','',0,''),(22,0,'MailFolder',2,1,'QQQQ','','','','',0,''),(23,21,'MailFolder',2,1,'XXXX','','','','',0,''),(24,21,'MailFolder',2,1,'ZZZZ','','','','',0,''),(25,0,'MailFolder',2,1,'11111','','','','',0,'');
/*!40000 ALTER TABLE `think_user_folder` ENABLE KEYS */;

#
# Source for table "think_user_tag"
#

DROP TABLE IF EXISTS `think_user_tag`;
CREATE TABLE `think_user_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `module` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sort` varchar(20) NOT NULL,
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

#
# Data for table "think_user_tag"
#

/*!40000 ALTER TABLE `think_user_tag` DISABLE KEYS */;
INSERT INTO `think_user_tag` VALUES (18,NULL,'Contact',1,'1234','','');
/*!40000 ALTER TABLE `think_user_tag` ENABLE KEYS */;

#
# Source for table "think_user_tag_data"
#

DROP TABLE IF EXISTS `think_user_tag_data`;
CREATE TABLE `think_user_tag_data` (
  `row_id` int(11) NOT NULL DEFAULT '0',
  `tag_id` int(11) NOT NULL DEFAULT '0',
  `module` varchar(20) NOT NULL DEFAULT '',
  KEY `row_id` (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "think_user_tag_data"
#

/*!40000 ALTER TABLE `think_user_tag_data` DISABLE KEYS */;
INSERT INTO `think_user_tag_data` VALUES (8,18,'Contact');
/*!40000 ALTER TABLE `think_user_tag_data` ENABLE KEYS */;
