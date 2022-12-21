-- MySQL dump 10.13  Distrib 5.7.27-30, for Linux (x86_64)
--
-- Host: localhost    Database: u1799130_djoya
-- ------------------------------------------------------
-- Server version	5.7.27-30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*!50717 SELECT COUNT(*) INTO @rocksdb_has_p_s_session_variables FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'performance_schema' AND TABLE_NAME = 'session_variables' */;
/*!50717 SET @rocksdb_get_is_supported = IF (@rocksdb_has_p_s_session_variables, 'SELECT COUNT(*) INTO @rocksdb_is_supported FROM performance_schema.session_variables WHERE VARIABLE_NAME=\'rocksdb_bulk_load\'', 'SELECT 0') */;
/*!50717 PREPARE s FROM @rocksdb_get_is_supported */;
/*!50717 EXECUTE s */;
/*!50717 DEALLOCATE PREPARE s */;
/*!50717 SET @rocksdb_enable_bulk_load = IF (@rocksdb_is_supported, 'SET SESSION rocksdb_bulk_load = 1', 'SET @rocksdb_dummy_bulk_load = 0') */;
/*!50717 PREPARE s FROM @rocksdb_enable_bulk_load */;
/*!50717 EXECUTE s */;
/*!50717 DEALLOCATE PREPARE s */;

--
-- Table structure for table `yupe_blog_blog`
--

DROP TABLE IF EXISTS `yupe_blog_blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_blog_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `description` text,
  `icon` varchar(250) NOT NULL DEFAULT '',
  `slug` varchar(150) NOT NULL,
  `lang` char(2) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `create_user_id` int(11) NOT NULL,
  `update_user_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `member_status` int(11) NOT NULL DEFAULT '1',
  `post_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_blog_blog_slug_lang` (`slug`,`lang`),
  KEY `ix_yupe_blog_blog_create_user` (`create_user_id`),
  KEY `ix_yupe_blog_blog_update_user` (`update_user_id`),
  KEY `ix_yupe_blog_blog_status` (`status`),
  KEY `ix_yupe_blog_blog_type` (`type`),
  KEY `ix_yupe_blog_blog_create_date` (`create_time`),
  KEY `ix_yupe_blog_blog_update_date` (`update_time`),
  KEY `ix_yupe_blog_blog_lang` (`lang`),
  KEY `ix_yupe_blog_blog_slug` (`slug`),
  KEY `ix_yupe_blog_blog_category_id` (`category_id`),
  CONSTRAINT `fk_yupe_blog_blog_category_id` FOREIGN KEY (`category_id`) REFERENCES `yupe_category_category` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_yupe_blog_blog_create_user` FOREIGN KEY (`create_user_id`) REFERENCES `yupe_user_user` (`id`),
  CONSTRAINT `fk_yupe_blog_blog_update_user` FOREIGN KEY (`update_user_id`) REFERENCES `yupe_user_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_blog_blog`
--

LOCK TABLES `yupe_blog_blog` WRITE;
/*!40000 ALTER TABLE `yupe_blog_blog` DISABLE KEYS */;
INSERT INTO `yupe_blog_blog` VALUES (1,NULL,'Блог','<p>Основной блог</p>','','blog',NULL,1,1,1,1,1638860770,1667466697,1,1);
/*!40000 ALTER TABLE `yupe_blog_blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_blog_post`
--

DROP TABLE IF EXISTS `yupe_blog_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_blog_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `create_user_id` int(11) NOT NULL,
  `update_user_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `publish_time` int(11) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `lang` char(2) DEFAULT NULL,
  `title` varchar(250) NOT NULL,
  `quote` text,
  `content` text NOT NULL,
  `link` varchar(250) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT '0',
  `comment_status` int(11) NOT NULL DEFAULT '1',
  `create_user_ip` varchar(20) NOT NULL,
  `access_type` int(11) NOT NULL DEFAULT '1',
  `meta_keywords` varchar(250) NOT NULL DEFAULT '',
  `meta_description` varchar(500) DEFAULT NULL,
  `image` varchar(300) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `meta_title` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_blog_post_lang_slug` (`slug`,`lang`),
  KEY `ix_yupe_blog_post_blog_id` (`blog_id`),
  KEY `ix_yupe_blog_post_create_user_id` (`create_user_id`),
  KEY `ix_yupe_blog_post_update_user_id` (`update_user_id`),
  KEY `ix_yupe_blog_post_status` (`status`),
  KEY `ix_yupe_blog_post_access_type` (`access_type`),
  KEY `ix_yupe_blog_post_comment_status` (`comment_status`),
  KEY `ix_yupe_blog_post_lang` (`lang`),
  KEY `ix_yupe_blog_post_slug` (`slug`),
  KEY `ix_yupe_blog_post_publish_date` (`publish_time`),
  KEY `ix_yupe_blog_post_category_id` (`category_id`),
  CONSTRAINT `fk_yupe_blog_post_blog` FOREIGN KEY (`blog_id`) REFERENCES `yupe_blog_blog` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_yupe_blog_post_category_id` FOREIGN KEY (`category_id`) REFERENCES `yupe_category_category` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_yupe_blog_post_create_user` FOREIGN KEY (`create_user_id`) REFERENCES `yupe_user_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_yupe_blog_post_update_user` FOREIGN KEY (`update_user_id`) REFERENCES `yupe_user_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_blog_post`
--

LOCK TABLES `yupe_blog_post` WRITE;
/*!40000 ALTER TABLE `yupe_blog_post` DISABLE KEYS */;
INSERT INTO `yupe_blog_post` VALUES (1,1,1,1,1667467244,1667467252,1667201149,'glavnoe-o-duhovnosti',NULL,'Главное о духовности','','<p><strong><span style=\"white-space: pre-wrap;\">Духовность - это...</span></strong></p>\r\n<p><span style=\"white-space: pre-wrap;\">В социологии, культурологии и публицистике &laquo;духовностью&raquo; часто называют объединяющие начала общества, выражаемые в виде моральных ценностей и традиций, сконцентрированные, как правило, в религиозных учениях и практиках, а также в художественных образах искусства.</span></p>\r\n<p><span style=\"white-space: pre-wrap;\"><img src=\"/uploads/blogs/Rectangle%20103.png\" alt=\"Rectangle 103.png\" width=\"1110\" height=\"400\"></span></p>\r\n<p class=\"blog-notation\"><span style=\"white-space: pre-wrap;\">Проблема духовности в психологии впервые стала рассматриваться в конце XIX &mdash; начале XX века в рамках понимающей психологии, представители которой (Вильгельм Дильтей, Эдуард Шпрангер) делали акцент на изучении человеческой психики в связи с духовными видами деятельности (культура, искусство, этика и др.), а не с естественными науками.</span></p>','',1,1,'127.0.0.1',1,'','','3fde1c3535398e3c7e6a38873602da79.png',1,'');
/*!40000 ALTER TABLE `yupe_blog_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_blog_post_to_tag`
--

DROP TABLE IF EXISTS `yupe_blog_post_to_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_blog_post_to_tag` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `ix_yupe_blog_post_to_tag_post_id` (`post_id`),
  KEY `ix_yupe_blog_post_to_tag_tag_id` (`tag_id`),
  CONSTRAINT `fk_yupe_blog_post_to_tag_post_id` FOREIGN KEY (`post_id`) REFERENCES `yupe_blog_post` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_yupe_blog_post_to_tag_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `yupe_blog_tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_blog_post_to_tag`
--

LOCK TABLES `yupe_blog_post_to_tag` WRITE;
/*!40000 ALTER TABLE `yupe_blog_post_to_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_blog_post_to_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_blog_tag`
--

DROP TABLE IF EXISTS `yupe_blog_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_blog_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_blog_tag_tag_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_blog_tag`
--

LOCK TABLES `yupe_blog_tag` WRITE;
/*!40000 ALTER TABLE `yupe_blog_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_blog_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_blog_user_to_blog`
--

DROP TABLE IF EXISTS `yupe_blog_user_to_blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_blog_user_to_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `note` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_blog_user_to_blog_blog_user_to_blog_u_b` (`user_id`,`blog_id`),
  KEY `ix_yupe_blog_user_to_blog_blog_user_to_blog_user_id` (`user_id`),
  KEY `ix_yupe_blog_user_to_blog_blog_user_to_blog_id` (`blog_id`),
  KEY `ix_yupe_blog_user_to_blog_blog_user_to_blog_status` (`status`),
  KEY `ix_yupe_blog_user_to_blog_blog_user_to_blog_role` (`role`),
  CONSTRAINT `fk_yupe_blog_user_to_blog_blog_user_to_blog_blog_id` FOREIGN KEY (`blog_id`) REFERENCES `yupe_blog_blog` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_yupe_blog_user_to_blog_blog_user_to_blog_user_id` FOREIGN KEY (`user_id`) REFERENCES `yupe_user_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_blog_user_to_blog`
--

LOCK TABLES `yupe_blog_user_to_blog` WRITE;
/*!40000 ALTER TABLE `yupe_blog_user_to_blog` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_blog_user_to_blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_callback`
--

DROP TABLE IF EXISTS `yupe_callback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_callback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `url` text,
  `agree` int(11) DEFAULT '0',
  `type` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_callback`
--

LOCK TABLES `yupe_callback` WRITE;
/*!40000 ALTER TABLE `yupe_callback` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_callback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_category_category`
--

DROP TABLE IF EXISTS `yupe_category_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_category_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `slug` varchar(150) NOT NULL,
  `lang` char(2) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `short_description` text,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_category_category_alias_lang` (`slug`,`lang`),
  KEY `ix_yupe_category_category_parent_id` (`parent_id`),
  KEY `ix_yupe_category_category_status` (`status`),
  CONSTRAINT `fk_yupe_category_category_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `yupe_category_category` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_category_category`
--

LOCK TABLES `yupe_category_category` WRITE;
/*!40000 ALTER TABLE `yupe_category_category` DISABLE KEYS */;
INSERT INTO `yupe_category_category` VALUES (1,NULL,'vdohnovenie','ru','Вдохновение',NULL,'','<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae distinctio neque ullam. Dolorem corrupti mollitia non, eligendi inventore harum, sed odio doloribus aperiam enim temporibus.</p>',1);
/*!40000 ALTER TABLE `yupe_category_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_city`
--

DROP TABLE IF EXISTS `yupe_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_user_id` int(11) NOT NULL,
  `update_user_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `category_id` int(11) DEFAULT NULL COMMENT 'Категория',
  `name_short` varchar(255) DEFAULT NULL COMMENT 'Короткое название',
  `name` varchar(255) DEFAULT NULL COMMENT 'Название',
  `phone` text COMMENT 'Телефон',
  `email` varchar(255) DEFAULT NULL COMMENT 'E-mail',
  `mode` varchar(255) DEFAULT NULL COMMENT 'График работы',
  `address` text COMMENT 'Адрес',
  `code_map` text COMMENT 'Код карты',
  `coords` varchar(255) DEFAULT NULL COMMENT 'Координаты на карте',
  `description` text COMMENT 'Описание',
  `status` int(11) DEFAULT NULL COMMENT 'Статус',
  `meta_title` varchar(255) DEFAULT NULL COMMENT 'Title (SEO)',
  `meta_keywords` text COMMENT 'Ключевые слова SEO',
  `meta_description` text COMMENT 'Описание SEO',
  `position` int(11) DEFAULT NULL COMMENT 'Сортировка',
  `slug` varchar(250) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `price_file` varchar(255) DEFAULT NULL,
  `vk` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `ok` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_default` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_city`
--

LOCK TABLES `yupe_city` WRITE;
/*!40000 ALTER TABLE `yupe_city` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_city_category`
--

DROP TABLE IF EXISTS `yupe_city_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_city_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_user_id` int(11) NOT NULL,
  `update_user_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `name_short` varchar(255) DEFAULT NULL COMMENT 'Короткое Название',
  `name` varchar(255) DEFAULT NULL COMMENT 'Название',
  `image` varchar(255) DEFAULT NULL COMMENT 'Изображение',
  `description` text COMMENT 'Описание',
  `meta_title` varchar(255) DEFAULT NULL COMMENT 'Title (SEO)',
  `meta_keywords` text COMMENT 'Ключевые слова SEO',
  `meta_description` text COMMENT 'Описание SEO',
  `status` int(11) DEFAULT NULL COMMENT 'Статус',
  `position` int(11) DEFAULT NULL COMMENT 'Сортировка',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_city_category`
--

LOCK TABLES `yupe_city_category` WRITE;
/*!40000 ALTER TABLE `yupe_city_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_city_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_comment_comment`
--

DROP TABLE IF EXISTS `yupe_comment_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_comment_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `model` varchar(100) NOT NULL,
  `model_id` int(11) NOT NULL,
  `url` varchar(150) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `text` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(20) DEFAULT NULL,
  `level` int(11) DEFAULT '0',
  `root` int(11) DEFAULT '0',
  `lft` int(11) DEFAULT '0',
  `rgt` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ix_yupe_comment_comment_status` (`status`),
  KEY `ix_yupe_comment_comment_model_model_id` (`model`,`model_id`),
  KEY `ix_yupe_comment_comment_model` (`model`),
  KEY `ix_yupe_comment_comment_model_id` (`model_id`),
  KEY `ix_yupe_comment_comment_user_id` (`user_id`),
  KEY `ix_yupe_comment_comment_parent_id` (`parent_id`),
  KEY `ix_yupe_comment_comment_level` (`level`),
  KEY `ix_yupe_comment_comment_root` (`root`),
  KEY `ix_yupe_comment_comment_lft` (`lft`),
  KEY `ix_yupe_comment_comment_rgt` (`rgt`),
  CONSTRAINT `fk_yupe_comment_comment_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `yupe_comment_comment` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_yupe_comment_comment_user_id` FOREIGN KEY (`user_id`) REFERENCES `yupe_user_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_comment_comment`
--

LOCK TABLES `yupe_comment_comment` WRITE;
/*!40000 ALTER TABLE `yupe_comment_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_comment_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_contentblock_content_block`
--

DROP TABLE IF EXISTS `yupe_contentblock_content_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_contentblock_content_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(100) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `content` text NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_contentblock_content_block_code` (`code`),
  KEY `ix_yupe_contentblock_content_block_type` (`type`),
  KEY `ix_yupe_contentblock_content_block_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_contentblock_content_block`
--

LOCK TABLES `yupe_contentblock_content_block` WRITE;
/*!40000 ALTER TABLE `yupe_contentblock_content_block` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_contentblock_content_block` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_dealers`
--

DROP TABLE IF EXISTS `yupe_dealers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_dealers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_user_id` int(11) NOT NULL,
  `update_user_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `name_short` varchar(255) DEFAULT NULL COMMENT 'Короткое Название',
  `name` varchar(255) DEFAULT NULL COMMENT 'Название',
  `phone` varchar(255) DEFAULT NULL COMMENT 'Телефоны',
  `location` text COMMENT 'Адрес',
  `mode` varchar(255) DEFAULT NULL COMMENT 'График работы',
  `coords` varchar(255) DEFAULT NULL COMMENT 'Координаты',
  `image` varchar(255) DEFAULT NULL COMMENT 'Изображение',
  `description` text COMMENT 'Описание',
  `meta_title` varchar(255) DEFAULT NULL COMMENT 'Title (SEO)',
  `meta_keywords` varchar(255) DEFAULT NULL COMMENT 'Ключевые слова SEO',
  `meta_description` varchar(255) DEFAULT NULL COMMENT 'Описание SEO',
  `status` int(11) DEFAULT NULL COMMENT 'Статус',
  `position` int(11) DEFAULT NULL COMMENT 'Сортировка',
  `slug` varchar(255) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_dealers`
--

LOCK TABLES `yupe_dealers` WRITE;
/*!40000 ALTER TABLE `yupe_dealers` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_dealers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_dealers_city`
--

DROP TABLE IF EXISTS `yupe_dealers_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_dealers_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_user_id` int(11) NOT NULL,
  `update_user_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `name_short` varchar(255) DEFAULT NULL COMMENT 'Короткое Название',
  `name` varchar(255) DEFAULT NULL COMMENT 'Название',
  `image` varchar(255) DEFAULT NULL COMMENT 'Изображение',
  `description` text COMMENT 'Описание',
  `meta_title` varchar(255) DEFAULT NULL COMMENT 'Title (SEO)',
  `meta_keywords` varchar(255) DEFAULT NULL COMMENT 'Ключевые слова SEO',
  `meta_description` varchar(255) DEFAULT NULL COMMENT 'Описание SEO',
  `status` int(11) DEFAULT NULL COMMENT 'Статус',
  `position` int(11) DEFAULT NULL COMMENT 'Сортировка',
  `slug` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `big_city` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_dealers_city`
--

LOCK TABLES `yupe_dealers_city` WRITE;
/*!40000 ALTER TABLE `yupe_dealers_city` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_dealers_city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_dealers_order`
--

DROP TABLE IF EXISTS `yupe_dealers_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_dealers_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `company` varchar(255) DEFAULT NULL COMMENT 'Компания',
  `city` varchar(255) DEFAULT NULL COMMENT 'Город',
  `name` text COMMENT 'Контактное лицо',
  `email` varchar(255) DEFAULT NULL COMMENT 'E-mail',
  `phone` varchar(255) DEFAULT NULL COMMENT 'Телефон',
  `site` varchar(255) DEFAULT NULL COMMENT 'Сайт',
  `platform` text,
  `image` varchar(255) DEFAULT NULL COMMENT 'Изображение',
  `comment` text COMMENT 'Комментарий',
  `status` int(11) DEFAULT NULL COMMENT 'Статус',
  `position` int(11) DEFAULT NULL COMMENT 'Сортировка',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_dealers_order`
--

LOCK TABLES `yupe_dealers_order` WRITE;
/*!40000 ALTER TABLE `yupe_dealers_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_dealers_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_feedback_feedback`
--

DROP TABLE IF EXISTS `yupe_feedback_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_feedback_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `answer_user` int(11) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(150) DEFAULT NULL,
  `theme` varchar(250) NOT NULL,
  `text` text NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `answer` text NOT NULL,
  `answer_time` datetime DEFAULT NULL,
  `is_faq` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_yupe_feedback_feedback_category` (`category_id`),
  KEY `ix_yupe_feedback_feedback_type` (`type`),
  KEY `ix_yupe_feedback_feedback_status` (`status`),
  KEY `ix_yupe_feedback_feedback_isfaq` (`is_faq`),
  KEY `ix_yupe_feedback_feedback_answer_user` (`answer_user`),
  CONSTRAINT `fk_yupe_feedback_feedback_answer_user` FOREIGN KEY (`answer_user`) REFERENCES `yupe_user_user` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_yupe_feedback_feedback_category` FOREIGN KEY (`category_id`) REFERENCES `yupe_category_category` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_feedback_feedback`
--

LOCK TABLES `yupe_feedback_feedback` WRITE;
/*!40000 ALTER TABLE `yupe_feedback_feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_feedback_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_gallery_gallery`
--

DROP TABLE IF EXISTS `yupe_gallery_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_gallery_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `owner` int(11) DEFAULT NULL,
  `preview_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `ix_yupe_gallery_gallery_status` (`status`),
  KEY `ix_yupe_gallery_gallery_owner` (`owner`),
  KEY `fk_yupe_gallery_gallery_gallery_preview_to_image` (`preview_id`),
  KEY `fk_yupe_gallery_gallery_gallery_to_category` (`category_id`),
  KEY `ix_yupe_gallery_gallery_sort` (`sort`),
  CONSTRAINT `fk_yupe_gallery_gallery_gallery_preview_to_image` FOREIGN KEY (`preview_id`) REFERENCES `yupe_image_image` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_yupe_gallery_gallery_gallery_to_category` FOREIGN KEY (`category_id`) REFERENCES `yupe_category_category` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_yupe_gallery_gallery_owner` FOREIGN KEY (`owner`) REFERENCES `yupe_user_user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_gallery_gallery`
--

LOCK TABLES `yupe_gallery_gallery` WRITE;
/*!40000 ALTER TABLE `yupe_gallery_gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_gallery_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_gallery_image_to_gallery`
--

DROP TABLE IF EXISTS `yupe_gallery_image_to_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_gallery_image_to_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `position` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_gallery_image_to_gallery_gallery_to_image` (`image_id`,`gallery_id`),
  KEY `ix_yupe_gallery_image_to_gallery_gallery_to_image_image` (`image_id`),
  KEY `ix_yupe_gallery_image_to_gallery_gallery_to_image_gallery` (`gallery_id`),
  CONSTRAINT `fk_yupe_gallery_image_to_gallery_gallery_to_image_gallery` FOREIGN KEY (`gallery_id`) REFERENCES `yupe_gallery_gallery` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_yupe_gallery_image_to_gallery_gallery_to_image_image` FOREIGN KEY (`image_id`) REFERENCES `yupe_image_image` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_gallery_image_to_gallery`
--

LOCK TABLES `yupe_gallery_image_to_gallery` WRITE;
/*!40000 ALTER TABLE `yupe_gallery_image_to_gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_gallery_image_to_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_image_image`
--

DROP TABLE IF EXISTS `yupe_image_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_image_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `description` text,
  `file` varchar(250) NOT NULL,
  `create_time` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `alt` varchar(250) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `ix_yupe_image_image_status` (`status`),
  KEY `ix_yupe_image_image_user` (`user_id`),
  KEY `ix_yupe_image_image_type` (`type`),
  KEY `ix_yupe_image_image_category_id` (`category_id`),
  KEY `fk_yupe_image_image_parent_id` (`parent_id`),
  CONSTRAINT `fk_yupe_image_image_category_id` FOREIGN KEY (`category_id`) REFERENCES `yupe_category_category` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_yupe_image_image_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `yupe_image_image` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_yupe_image_image_user_id` FOREIGN KEY (`user_id`) REFERENCES `yupe_user_user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_image_image`
--

LOCK TABLES `yupe_image_image` WRITE;
/*!40000 ALTER TABLE `yupe_image_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_image_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_mail_mail_event`
--

DROP TABLE IF EXISTS `yupe_mail_mail_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_mail_mail_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_mail_mail_event_code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_mail_mail_event`
--

LOCK TABLES `yupe_mail_mail_event` WRITE;
/*!40000 ALTER TABLE `yupe_mail_mail_event` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_mail_mail_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_mail_mail_template`
--

DROP TABLE IF EXISTS `yupe_mail_mail_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_mail_mail_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(150) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text,
  `from` varchar(150) NOT NULL,
  `to` varchar(150) NOT NULL,
  `theme` text NOT NULL,
  `body` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_mail_mail_template_code` (`code`),
  KEY `ix_yupe_mail_mail_template_status` (`status`),
  KEY `ix_yupe_mail_mail_template_event_id` (`event_id`),
  CONSTRAINT `fk_yupe_mail_mail_template_event_id` FOREIGN KEY (`event_id`) REFERENCES `yupe_mail_mail_event` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_mail_mail_template`
--

LOCK TABLES `yupe_mail_mail_template` WRITE;
/*!40000 ALTER TABLE `yupe_mail_mail_template` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_mail_mail_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_menu_menu`
--

DROP TABLE IF EXISTS `yupe_menu_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_menu_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_menu_menu_code` (`code`),
  KEY `ix_yupe_menu_menu_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_menu_menu`
--

LOCK TABLES `yupe_menu_menu` WRITE;
/*!40000 ALTER TABLE `yupe_menu_menu` DISABLE KEYS */;
INSERT INTO `yupe_menu_menu` VALUES (1,'Верхнее меню','top-menu','Основное меню сайта',1),(9,'Нижнее меню','bottom-menu','Меню в подвале сайта',1);
/*!40000 ALTER TABLE `yupe_menu_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_menu_menu_item`
--

DROP TABLE IF EXISTS `yupe_menu_menu_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_menu_menu_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `regular_link` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(150) NOT NULL,
  `href` varchar(150) NOT NULL,
  `class` varchar(150) DEFAULT NULL,
  `title_attr` varchar(150) DEFAULT NULL,
  `before_link` varchar(150) DEFAULT NULL,
  `after_link` varchar(150) DEFAULT NULL,
  `target` varchar(150) DEFAULT NULL,
  `rel` varchar(150) DEFAULT NULL,
  `condition_name` varchar(150) DEFAULT '0',
  `condition_denial` int(11) DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `entity_module_name` varchar(40) DEFAULT NULL,
  `entity_name` varchar(40) DEFAULT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `svg_icon` text,
  PRIMARY KEY (`id`),
  KEY `ix_yupe_menu_menu_item_menu_id` (`menu_id`),
  KEY `ix_yupe_menu_menu_item_sort` (`sort`),
  KEY `ix_yupe_menu_menu_item_status` (`status`),
  CONSTRAINT `fk_yupe_menu_menu_item_menu_id` FOREIGN KEY (`menu_id`) REFERENCES `yupe_menu_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_menu_menu_item`
--

LOCK TABLES `yupe_menu_menu_item` WRITE;
/*!40000 ALTER TABLE `yupe_menu_menu_item` DISABLE KEYS */;
INSERT INTO `yupe_menu_menu_item` VALUES (57,0,1,1,'Главная','/',NULL,NULL,NULL,NULL,NULL,NULL,'0',0,2,1,NULL,NULL,NULL,NULL),(61,0,1,1,'О нас','/about-us',NULL,NULL,NULL,NULL,NULL,NULL,'0',0,37,1,NULL,NULL,NULL,NULL),(66,0,1,1,'Наш журнал','/blog',NULL,NULL,NULL,NULL,NULL,NULL,'0',0,17,1,NULL,NULL,NULL,NULL),(68,0,1,1,'Магазин','/store','','','','','','','',0,16,1,'','',NULL,''),(93,0,9,1,'Отзывы клиентов','/review','','','','','','','',0,39,1,'','',NULL,''),(94,0,9,1,'Условия оплаты','/oplata','','','','','','','',0,41,1,'','',NULL,''),(95,0,9,1,'О мастерской','/about-us','','','','','','','',0,38,1,'','',NULL,''),(96,0,9,1,'Условия доставки','/delivery','','','','','','','',0,40,1,'','',NULL,''),(97,0,9,1,'Частые вопросы','/faq','','','','','','','',0,42,1,'','',NULL,''),(98,0,1,1,'Контакты','/contacts','','','','','','','',0,43,1,'','',NULL,''),(99,0,9,1,'Наши контакты','/contacts','','','','','','','',0,44,1,'','',NULL,'');
/*!40000 ALTER TABLE `yupe_menu_menu_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_migrations`
--

DROP TABLE IF EXISTS `yupe_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_migrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_migrations_module` (`module`)
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_migrations`
--

LOCK TABLES `yupe_migrations` WRITE;
/*!40000 ALTER TABLE `yupe_migrations` DISABLE KEYS */;
INSERT INTO `yupe_migrations` VALUES (1,'user','m000000_000000_user_base',1576817728),(2,'user','m131019_212911_user_tokens',1576817728),(3,'user','m131025_152911_clean_user_table',1576817729),(4,'user','m131026_002234_prepare_hash_user_password',1576817729),(5,'user','m131106_111552_user_restore_fields',1576817729),(6,'user','m131121_190850_modify_tokes_table',1576817729),(7,'user','m140812_100348_add_expire_to_token_table',1576817730),(8,'user','m150416_113652_rename_fields',1576817730),(9,'user','m151006_000000_user_add_phone',1576817730),(10,'yupe','m000000_000000_yupe_base',1576817730),(11,'yupe','m130527_154455_yupe_change_unique_index',1576817730),(12,'yupe','m150416_125517_rename_fields',1576817730),(13,'yupe','m160204_195213_change_settings_type',1576817730),(14,'category','m000000_000000_category_base',1576817731),(15,'category','m150415_150436_rename_fields',1576817731),(16,'image','m000000_000000_image_base',1576817732),(17,'image','m150226_121100_image_order',1576817732),(18,'image','m150416_080008_rename_fields',1576817732),(19,'comment','m000000_000000_comment_base',1576817733),(20,'comment','m130704_095200_comment_nestedsets',1576817733),(21,'comment','m150415_151804_rename_fields',1576817733),(22,'gallery','m000000_000000_gallery_base',1576817734),(23,'gallery','m130427_120500_gallery_creation_user',1576817734),(24,'gallery','m150416_074146_rename_fields',1576817734),(25,'gallery','m160514_131314_add_preview_to_gallery',1576817734),(26,'gallery','m160515_123559_add_category_to_gallery',1576817735),(27,'gallery','m160515_151348_add_position_to_gallery_image',1576817735),(28,'gallery','m181224_072816_add_sort_to_gallery',1576817735),(29,'store','m140812_160000_store_attribute_group_base',1576817735),(30,'store','m140812_170000_store_attribute_base',1576817736),(31,'store','m140812_180000_store_attribute_option_base',1576817736),(32,'store','m140813_200000_store_category_base',1576817736),(33,'store','m140813_210000_store_type_base',1576817736),(34,'store','m140813_220000_store_type_attribute_base',1576817736),(35,'store','m140813_230000_store_producer_base',1576817736),(36,'store','m140814_000000_store_product_base',1576817737),(37,'store','m140814_000010_store_product_category_base',1576817737),(38,'store','m140814_000013_store_product_attribute_eav_base',1576817738),(39,'store','m140814_000018_store_product_image_base',1576817738),(40,'store','m140814_000020_store_product_variant_base',1576817738),(41,'store','m141014_210000_store_product_category_column',1576817738),(42,'store','m141015_170000_store_product_image_column',1576817739),(43,'store','m141218_091834_default_null',1576817739),(44,'store','m150210_063409_add_store_menu_item',1576817739),(45,'store','m150210_105811_add_price_column',1576817739),(46,'store','m150210_131238_order_category',1576817739),(47,'store','m150211_105453_add_position_for_product_variant',1576817739),(48,'store','m150226_065935_add_product_position',1576817739),(49,'store','m150416_112008_rename_fields',1576817739),(50,'store','m150417_180000_store_product_link_base',1576817740),(51,'store','m150825_184407_change_store_url',1576817740),(52,'store','m150907_084604_new_attributes',1576817740),(53,'store','m151218_081635_add_external_id_fields',1576817741),(54,'store','m151218_082939_add_external_id_ix',1576817741),(55,'store','m151218_142113_add_product_index',1576817741),(56,'store','m151223_140722_drop_product_type_categories',1576817741),(57,'store','m160210_084850_add_h1_and_canonical',1576817741),(58,'store','m160210_131541_add_main_image_alt_title',1576817742),(59,'store','m160211_180200_add_additional_images_alt_title',1576817742),(60,'store','m160215_110749_add_image_groups_table',1576817742),(61,'store','m160227_114934_rename_producer_order_column',1576817742),(62,'store','m160309_091039_add_attributes_sort_and_search_fields',1576817742),(63,'store','m160413_184551_add_type_attr_fk',1576817742),(64,'store','m160602_091243_add_position_product_index',1576817742),(65,'store','m160602_091909_add_producer_sort_index',1576817742),(66,'store','m160713_105449_remove_irrelevant_product_status',1576817742),(67,'store','m160805_070905_add_attribute_description',1576817743),(68,'store','m161015_121915_change_product_external_id_type',1576817743),(69,'store','m161122_090922_add_sort_product_position',1576817743),(70,'store','m161122_093736_add_store_layouts',1576817743),(71,'store','m181218_121815_store_product_variant_quantity_column',1576817743),(72,'mail','m000000_000000_mail_base',1576817744),(73,'payment','m140815_170000_store_payment_base',1576817745),(74,'delivery','m140815_190000_store_delivery_base',1576817747),(75,'delivery','m140815_200000_store_delivery_payment_base',1576817747),(76,'order','m140814_200000_store_order_base',1576817749),(77,'order','m150324_105949_order_status_table',1576817749),(78,'order','m150416_100212_rename_fields',1576817749),(79,'order','m150514_065554_change_order_price',1576817749),(80,'order','m151209_185124_split_address',1576817749),(81,'order','m151211_115447_add_appartment_field',1576817750),(82,'order','m160415_055344_add_manager_to_order',1576817750),(83,'order','m160618_145025_add_status_color',1576817750),(84,'page','m000000_000000_page_base',1576817751),(85,'page','m130115_155600_columns_rename',1576817751),(86,'page','m140115_083618_add_layout',1576817751),(87,'page','m140620_072543_add_view',1576817751),(88,'page','m150312_151049_change_body_type',1576817751),(89,'page','m150416_101038_rename_fields',1576817751),(90,'page','m180224_105407_meta_title_column',1576817752),(91,'page','m180421_143324_update_page_meta_column',1576817752),(92,'notify','m141031_091039_add_notify_table',1576817752),(93,'blog','m000000_000000_blog_base',1576817755),(94,'blog','m130503_091124_BlogPostImage',1576817755),(95,'blog','m130529_151602_add_post_category',1576817755),(96,'blog','m140226_052326_add_community_fields',1576817756),(97,'blog','m140714_110238_blog_post_quote_type',1576817756),(98,'blog','m150406_094809_blog_post_quote_type',1576817756),(99,'blog','m150414_180119_rename_date_fields',1576817756),(100,'blog','m160518_175903_alter_blog_foreign_keys',1576817756),(101,'blog','m180421_143937_update_blog_meta_column',1576817756),(102,'blog','m180421_143938_add_post_meta_title_column',1576817757),(103,'coupon','m140816_200000_store_coupon_base',1576817759),(104,'coupon','m150414_124659_add_order_coupon_table',1576817759),(105,'coupon','m150415_153218_rename_fields',1576817759),(106,'sitemap','m141004_130000_sitemap_page',1576817760),(107,'sitemap','m141004_140000_sitemap_page_data',1576817760),(108,'menu','m000000_000000_menu_base',1576817761),(109,'menu','m121220_001126_menu_test_data',1576817762),(110,'menu','m160914_134555_fix_menu_item_default_values',1576817762),(111,'menu','m181214_110527_menu_item_add_entity_fields',1576817763),(112,'rbac','m140115_131455_auth_item',1576817763),(113,'rbac','m140115_132045_auth_item_child',1576817764),(114,'rbac','m140115_132319_auth_item_assign',1576817764),(115,'rbac','m140702_230000_initial_role_data',1576817764),(116,'feedback','m000000_000000_feedback_base',1576817768),(117,'feedback','m150415_184108_rename_fields',1576817768),(118,'contentblock','m000000_000000_contentblock_base',1576817768),(119,'contentblock','m140715_130737_add_category_id',1576817768),(120,'contentblock','m150127_130425_add_status_column',1576817769),(121,'slider','m000000_000000_slider_base',1576820742),(122,'slider','m000000_000001_slider_add_column_image_xs',1576820742),(124,'news','m000000_000000_news_base',1576821833),(125,'news','m150416_081251_rename_fields',1576821833),(126,'news','m180224_105353_meta_title_column',1576821833),(127,'news','m180421_142416_update_news_meta_column',1576821833),(128,'partners','m000000_000000_partners_base',1577637541),(129,'store','m181218_121816_store_category_name_short_icon',1578313567),(130,'page','m190421_143324_add_page_text_mirror_column',1578417776),(132,'store','m181218_121818_create_table_tabs',1578514695),(134,'dealers','m000000_000000_dealers_base',1579079431),(135,'dealers','m000000_000001_dealers_add_cloumn',1579079431),(136,'dealers','m000000_000002_dealers_add_cloumn_city_id',1579079431),(137,'dealers','m000000_000003_dealers_add_cloumn_title',1579079431),(138,'dealers','m000000_000004_dealers_add_cloumn_big_city',1579079432),(139,'dealers','m000000_000005_dealers_order_table',1579079432),(140,'dealers','m000000_000006_dealers_order_rename',1579079432),(141,'menu','m191214_110527_menu_item_add_svg_icon',1580380937),(142,'slider','m000003_000001_slider_add_column_discont',1581257828),(146,'slider','m000004_000001_slider_drop_column_buttwo',1581260947),(147,'slider','m000005_000001_slider_drop_column_cat_name',1581261278),(148,'slider','m000006_000001_slider_add_column_discont_css',1581262355),(149,'stocks','m000000_000000_stocks_base',1581692142),(150,'stocks','m000001_000000_rename_fields',1581692142),(151,'stocks','m000003_000000_add_badge_and_badge_color_column',1581699662),(152,'stocks','m000004_000000_add_bg_stock_column',1581702989),(153,'review','m000000_000000_review_base',1581789242),(154,'review','m000000_000001_review_add_column',1581789242),(155,'review','m000000_000002_review_add_column_pos',1581789242),(156,'review','m000000_000003_review_add_column_name_service',1581789242),(157,'review','m000000_000004_review_add_column_rating',1581789243),(158,'review','m000000_000005_review_rename_column',1581789243),(159,'store','m201218_121818_add_product_raiting',1581789663),(161,'store','m211218_121817_create_table_haracteristic',1581804451),(162,'store','m211218_121818_add_product_visits',1582556370),(163,'store','m221218_121821_store_product_add_column_price_result',1582736209),(164,'page','m200421_143324_add_page_image_column',1584037546),(165,'store','m231218_121816_store_category_name_short_icon_drop',1594478028),(166,'store','m240000_000000_store_product_add_column_is',1594481653),(167,'store','m240000_000001_store_product_add_column_is',1594481836),(168,'store','m240000_000001_store_product_add_column_is',1594481836),(169,'store','m240000_000002_store_product_add_column_is',1594481914),(170,'store','m250000_000000_add_column_image_variant_color_id',1595174918),(171,'store','m250000_000001_add_column_attribute_option_color',1595174918),(172,'store','m261205_150639_add_field_parent_id_variant',1595174919),(173,'store','m271205_150639_add_field_option_id_variant',1595174919),(174,'review','m000000_000006_add_table_images',1595781445),(175,'review','m000000_000007_rename_table_images_name',1595781445),(176,'review','m000000_000008_add_column_count',1595781445),(177,'store','m280000_000000_add_field_video',1597530654),(178,'review','m000001_000000_review_add_column_order',1599416581),(179,'store','m280000_000001_change_size_meta_description_column',1601020196),(180,'city','m000000_000000_city_base',1601286631),(181,'city','m000000_000001_city_base',1601286631),(182,'city','m000000_000002_city_add_column_price_file',1601286631),(183,'city','m000000_000003_city_add_column_soc',1601286631),(184,'city','m000000_000004_city_add_image',1601286631),(185,'city','m200307_080044_add_column_is_default',1601286631),(186,'callback','m150926_083350_callback_base',1601363238),(187,'callback','m160621_075232_add_date_to_callback',1601363238),(188,'callback','m161125_181730_add_url_to_callback',1601363238),(189,'callback','m161204_122528_update_callback_encoding',1601363238),(190,'callback','m180224_103745_add_agree_column',1601363238),(191,'callback','m181213_214512_add_type_column',1601363238),(192,'page','m200421_143325_change_page_meta_description_column_size',1601366030),(193,'store','m280000_000002_change_store_category_size_meta_description_column',1601882748),(194,'order','m170415_055344_add_fields_orderId',1606733901),(195,'page','m200422_143325_add_meta_robots_column',1608809167),(201,'video','m000000_000000_video_base',1620192120),(202,'video','m000000_000001_video_add_column',1620192120),(203,'video','m000001_000000_video_category_base',1620192120),(204,'quest','m000000_000000_quest_base',1620196866),(205,'quest','m000000_000001_quest_add_column',1620196866),(206,'quest','m000001_000000_quest_category_base',1620196866),(207,'store','m290000_000000_store_category_image_two_add',1620822359),(208,'delivery','m191019_192322_add_column_class_delivery',1620880690),(209,'payment','m150000_000000_store_payment_add_column_discount',1620880882),(210,'order','m191007_090158_add_region_order',1620881010),(211,'order','m191007_091721_add_region_city_order',1620881010),(212,'order','m191017_190431_add_fields_for_order',1620881010),(213,'order','m191017_191427_rename_fields_for_order',1620881011),(214,'order','m191018_090038_create_order_post_price_table',1620881011),(215,'order','m191020_181356_create_table_order_sdek',1620881011),(216,'order','m191020_183335_add_column_tariff_pvz_order',1620881011),(217,'order','m191020_203319_add_column_order_id_order_sdek_data',1620881011),(218,'order','m200212_172620_add_dispatch_number',1620881011),(219,'order','m201001_053645_add_dadata_fields',1620884874),(220,'order','m201001_053646_add_sub_delivery_id',1620884874),(221,'order','m210114_064703_add_address_obj_column_to_store_order_table',1620884874),(222,'order','m210125_220341_add_sub_delivery_data',1620884874),(223,'order','m210220_073130_add_track_column_to_store_order_table',1620884874),(224,'order','m210220_073333_add_delivery_column_to_store_order_table',1620884874),(225,'order','m210317_104812_add_send_1c_column_to_store_order_table',1620884874),(226,'delivery','m200831_093440_add_module_column_to_delivery_table',1620884878),(227,'delivery','m200831_123501_add_settings_column_to_store_delivery_table',1620884878),(228,'user','m200715_154203_add_address_columnt_to_user_user_table',1620884885),(229,'user','m201123_121507_add_user_type_column_to_user_user_table',1620884885),(230,'page','m210421_143324_add_page_noindex_column',1621322446),(231,'page','m220421_143330_directions_add_column_data',1621322446),(232,'page','m230421_143328_add_page_image_tbl',1621322446),(233,'page','m240421_143328_add_page_icon_field',1621322446),(234,'page','m250421_143324_drop_page_text_mirror_column',1621323049),(235,'store','m300000_000000_store_category_show_in_catalog',1626082890),(236,'store','m211217_093033_add_product_gallery_category_column',1639734783),(237,'blog','m180421_143943_alter_column_meta_description',1645078868),(238,'store','m220304_063343_add_is_delivery_column_to_store_product_table',1646381286),(239,'store','m220712_100240_create_table_product_photos_reviews',1657799768),(240,'store','m220715_053858_create_table_product_photos_reviews_marketplace',1657883573),(241,'order','m221003_065855_add_gift_message_column_to_order_table',1664780382);
/*!40000 ALTER TABLE `yupe_migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_news_news`
--

DROP TABLE IF EXISTS `yupe_news_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_news_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `lang` char(2) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `date` date NOT NULL,
  `title` varchar(250) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `short_text` text,
  `full_text` text NOT NULL,
  `image` varchar(300) DEFAULT NULL,
  `link` varchar(300) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `is_protected` tinyint(1) NOT NULL DEFAULT '0',
  `meta_keywords` varchar(250) NOT NULL,
  `meta_description` varchar(250) NOT NULL,
  `meta_title` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_news_news_alias_lang` (`slug`,`lang`),
  KEY `ix_yupe_news_news_status` (`status`),
  KEY `ix_yupe_news_news_user_id` (`user_id`),
  KEY `ix_yupe_news_news_category_id` (`category_id`),
  KEY `ix_yupe_news_news_date` (`date`),
  CONSTRAINT `fk_yupe_news_news_category_id` FOREIGN KEY (`category_id`) REFERENCES `yupe_category_category` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_yupe_news_news_user_id` FOREIGN KEY (`user_id`) REFERENCES `yupe_user_user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_news_news`
--

LOCK TABLES `yupe_news_news` WRITE;
/*!40000 ALTER TABLE `yupe_news_news` DISABLE KEYS */;
INSERT INTO `yupe_news_news` VALUES (1,NULL,'ru','2019-12-29 19:00:35','2020-09-29 16:17:03','2019-12-29','Секреты современной рыбалки  на поплавочную удочку','sekrety-sovremennoy-rybalki-na-poplavochnuyu-udochku','<p>Первые несколько строчек из самой новости. Повседневная практика показывает, что новая модель организационной деятельности требуют определения </p>','<p>Первые несколько строчек из самой новости. Повседневная практика показывает, что новая модель организационной деятельности требуют определения Первые несколько строчек из самой новости. Повседневная практика показывает, что новая модель организационной деятельности требуют определения <span class=\"redactor-invisible-space\">Первые несколько строчек из самой новости. Повседневная практика показывает, что новая модель организационной деятельности требуют определения <span class=\"redactor-invisible-space\">Первые несколько строчек из самой новости. Повседневная практика показывает, что новая модель организационной деятельности требуют определения <span class=\"redactor-invisible-space\">Первые несколько строчек из самой новости. Повседневная практика показывает, что новая модель организационной деятельности требуют определения <span class=\"redactor-invisible-space\">Первые несколько строчек из самой новости. Повседневная практика показывает, что новая модель организационной деятельности требуют определения <span class=\"redactor-invisible-space\"></span></span></span></span></span></p>','0d42d92d0bcdad2cb574a6a9101cb87f.jpg','',1,0,0,'','',''),(2,NULL,'ru','2019-12-29 19:01:03','2020-09-29 16:17:06','2019-12-29','Поиск и ловля щуки с помощью эхолота','poisk-i-lovlya-shchuki-s-pomoshchyu-eholota','<p>Frankfurt Prolight & Sound 2019 FBT new MYRA & JMaxx - Ежегодная выставка прошла во Франкфурте.Frankfurt Prolight & Sound 2019 FBT new MYRA & JMaxx - Ежегодная выставка прошла во Франкфурте.<span class=\"redactor-invisible-space\">Frankfurt Prolight & Sound 2019 FBT new MYRA & JMaxx - Ежегодная выставка прошла во Франкфурте.<span class=\"redactor-invisible-space\">Frankfurt Prolight & Sound 2019 FBT new MYRA & JMaxx - Ежегодная выставка прошла во Франкфурте.<span class=\"redactor-invisible-space\">Frankfurt Prolight & Sound 2019 FBT new MYRA & JMaxx - Ежегодная выставка прошла во Франкфурте.<span class=\"redactor-invisible-space\">Frankfurt Prolight & Sound 2019 FBT new MYRA & JMaxx - Ежегодная выставка прошла во Франкфурте.<span class=\"redactor-invisible-space\"></span></span></span></span></span></p>','<p>Frankfurt Prolight & Sound 2019 FBT new MYRA & JMaxx - Ежегодная выставка прошла во Франкфурте.Frankfurt Prolight & Sound 2019 FBT new MYRA & JMaxx - Ежегодная выставка прошла во Франкфурте.<span class=\"redactor-invisible-space\">Frankfurt Prolight & Sound 2019 FBT new MYRA & JMaxx - Ежегодная выставка прошла во Франкфурте.<span class=\"redactor-invisible-space\">Frankfurt Prolight & Sound 2019 FBT new MYRA & JMaxx - Ежегодная выставка прошла во Франкфурте.<span class=\"redactor-invisible-space\">Frankfurt Prolight & Sound 2019 FBT new MYRA & JMaxx - Ежегодная выставка прошла во Франкфурте.<span class=\"redactor-invisible-space\">Frankfurt Prolight & Sound 2019 FBT new MYRA & JMaxx - Ежегодная выставка прошла во Франкфурте.<span class=\"redactor-invisible-space\">Frankfurt Prolight & Sound 2019 FBT new MYRA & JMaxx - Ежегодная выставка прошла во Франкфурте.<span class=\"redactor-invisible-space\"></span></span></span></span></span></span></p>','f94be61a18cfa36d2620c7a3ed435ced.jpg','',1,0,0,'','',''),(4,NULL,'ru','2020-02-22 14:30:30','2020-09-29 16:17:01','2020-02-22','Поступление новой коллекции обоев  от Английского дома моды VersonteСовмененные устройства подавления сигнала сотовой связи','postuplenie-novoy-kollekcii-oboev-ot-angliyskogo-doma-mody-versonte55','','<p>Первые несколько строчек из самой новости. Повседневная практика показывает, что новая модель организационной деятельности требуют определения Первые несколько строчек из самой новости. Повседневная практика показывает, что новая модель организационной деятельности требуют определения <span class=\"redactor-invisible-space\">Первые несколько строчек из самой новости. Повседневная практика показывает, что новая модель организационной деятельности требуют определения <span class=\"redactor-invisible-space\">Первые несколько строчек из самой новости. Повседневная практика показывает, что новая модель организационной деятельности требуют определения <span class=\"redactor-invisible-space\">Первые несколько строчек из самой новости. Повседневная практика показывает, что новая модель организационной деятельности требуют определения <span class=\"redactor-invisible-space\">Первые несколько строчек из самой новости. Повседневная практика показывает, что новая модель организационной деятельности требуют определения</span></span></span></span></p>','21f0ea69844b198f55385ea09f2bf873.jpg','',1,0,0,'','','');
/*!40000 ALTER TABLE `yupe_news_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_notify_settings`
--

DROP TABLE IF EXISTS `yupe_notify_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_notify_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `my_post` tinyint(1) NOT NULL DEFAULT '1',
  `my_comment` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `ix_yupe_notify_settings_user_id` (`user_id`),
  CONSTRAINT `fk_yupe_notify_settings_user_id` FOREIGN KEY (`user_id`) REFERENCES `yupe_user_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_notify_settings`
--

LOCK TABLES `yupe_notify_settings` WRITE;
/*!40000 ALTER TABLE `yupe_notify_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_notify_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_order_post_price`
--

DROP TABLE IF EXISTS `yupe_order_post_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_order_post_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` decimal(6,2) DEFAULT NULL,
  `index` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `min_deys` int(11) DEFAULT NULL,
  `max_deys` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_order_post_price`
--

LOCK TABLES `yupe_order_post_price` WRITE;
/*!40000 ALTER TABLE `yupe_order_post_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_order_post_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_page_page`
--

DROP TABLE IF EXISTS `yupe_page_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_page_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `lang` char(2) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `change_user_id` int(11) DEFAULT NULL,
  `title_short` varchar(150) NOT NULL,
  `title` varchar(250) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `body` mediumtext NOT NULL,
  `meta_keywords` varchar(250) NOT NULL,
  `meta_description` varchar(500) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `is_protected` tinyint(1) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `layout` varchar(250) DEFAULT NULL,
  `view` varchar(250) DEFAULT NULL,
  `meta_title` varchar(250) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `meta_robots` varchar(250) DEFAULT NULL,
  `noindex` tinyint(1) NOT NULL DEFAULT '0',
  `data` longtext,
  `icon` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_page_page_slug_lang` (`slug`,`lang`),
  KEY `ix_yupe_page_page_status` (`status`),
  KEY `ix_yupe_page_page_is_protected` (`is_protected`),
  KEY `ix_yupe_page_page_user_id` (`user_id`),
  KEY `ix_yupe_page_page_change_user_id` (`change_user_id`),
  KEY `ix_yupe_page_page_menu_order` (`order`),
  KEY `ix_yupe_page_page_category_id` (`category_id`),
  CONSTRAINT `fk_yupe_page_page_category_id` FOREIGN KEY (`category_id`) REFERENCES `yupe_category_category` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_yupe_page_page_change_user_id` FOREIGN KEY (`change_user_id`) REFERENCES `yupe_user_user` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_yupe_page_page_user_id` FOREIGN KEY (`user_id`) REFERENCES `yupe_user_user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_page_page`
--

LOCK TABLES `yupe_page_page` WRITE;
/*!40000 ALTER TABLE `yupe_page_page` DISABLE KEYS */;
INSERT INTO `yupe_page_page` VALUES (1,NULL,'ru',NULL,'2019-12-20 10:35:14','2022-09-26 21:55:00',1,1,'Сайт Djoya','Сайт Djoya','sayt-djoya','<p>TEST</p>','','',0,0,3,'','','Сайт Djoya',NULL,'',1,NULL,NULL),(3,NULL,'ru',NULL,'2020-07-11 22:23:24','2022-10-03 10:33:06',1,1,'','О мастерской','about-us','<p>TEST</p>','','',1,0,4,'','about-us','',NULL,'',0,NULL,NULL),(5,NULL,'ru',NULL,'2020-07-11 22:24:10','2022-10-03 09:48:56',1,1,'','Доставка','delivery','<p>TEST</p>','','',1,0,6,'','dostavka','','97437323020a34f4f76d77d16380e2f5.jpg','',0,NULL,NULL),(6,NULL,'ru',NULL,'2020-07-11 22:24:29','2022-10-03 09:49:33',1,1,'','Контакты','contacts','<p>TEST</p>','','',1,0,1,'','contacts','',NULL,'',0,NULL,NULL),(18,NULL,'ru',NULL,'2022-10-03 09:46:25','2022-10-03 09:49:05',1,1,'','Оплата','oplata','<p>TEST</p>','','',1,0,7,'','oplata','',NULL,NULL,0,NULL,NULL),(20,NULL,'ru',NULL,'2022-10-05 20:46:41','2022-10-05 20:46:51',1,1,'','Все хиты','hits','','','',1,0,8,'','hits','',NULL,NULL,0,NULL,NULL),(21,NULL,'ru',NULL,'2022-11-03 15:29:47','2022-11-03 15:33:04',1,1,'','Технические работы','tehnicheskie-raboty','<p>TEST</p>','','',1,0,9,'','tehnicheskie-raboty','',NULL,NULL,0,NULL,NULL),(22,NULL,'ru',NULL,'2022-11-14 22:12:07','2022-11-14 22:12:45',1,1,'','Пустая корзина','basket','<p>TEST</p>','','',1,0,10,'','empty-basket','',NULL,NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `yupe_page_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_page_page_image`
--

DROP TABLE IF EXISTS `yupe_page_page_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_page_page_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL COMMENT 'Изображение',
  `title` varchar(255) NOT NULL COMMENT 'Название изображения',
  `alt` varchar(255) NOT NULL COMMENT 'Alt изображения',
  `position` int(11) DEFAULT NULL COMMENT 'Сортировка',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_page_page_image`
--

LOCK TABLES `yupe_page_page_image` WRITE;
/*!40000 ALTER TABLE `yupe_page_page_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_page_page_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_partners`
--

DROP TABLE IF EXISTS `yupe_partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_user_id` int(11) NOT NULL,
  `update_user_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_yupe_partners_create_user` (`create_user_id`),
  KEY `ix_yupe_partners_update_user` (`update_user_id`),
  KEY `ix_yupe_partners_create_time` (`create_time`),
  KEY `ix_yupe_partners_update_time` (`update_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_partners`
--

LOCK TABLES `yupe_partners` WRITE;
/*!40000 ALTER TABLE `yupe_partners` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_partners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_quest`
--

DROP TABLE IF EXISTS `yupe_quest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_quest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'Название',
  `body` text NOT NULL COMMENT 'Содержание',
  `status` int(11) DEFAULT '0' COMMENT 'Статус',
  `position` int(11) DEFAULT NULL COMMENT 'Сортировка',
  `category_id` int(11) DEFAULT NULL COMMENT 'ID категории',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_quest`
--

LOCK TABLES `yupe_quest` WRITE;
/*!40000 ALTER TABLE `yupe_quest` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_quest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_quest_category`
--

DROP TABLE IF EXISTS `yupe_quest_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_quest_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'Название',
  `status` int(11) DEFAULT '0' COMMENT 'Статус',
  `position` int(11) DEFAULT NULL COMMENT 'Сортировка',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_quest_category`
--

LOCK TABLES `yupe_quest_category` WRITE;
/*!40000 ALTER TABLE `yupe_quest_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_quest_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_review`
--

DROP TABLE IF EXISTS `yupe_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `text` text NOT NULL,
  `moderation` int(11) DEFAULT NULL,
  `username` varchar(256) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL,
  `useremail` varchar(256) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL COMMENT 'Категория',
  `position` int(11) DEFAULT NULL COMMENT 'Сортировка',
  `product_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `countImage` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_review`
--

LOCK TABLES `yupe_review` WRITE;
/*!40000 ALTER TABLE `yupe_review` DISABLE KEYS */;
INSERT INTO `yupe_review` VALUES (1,1,'2022-11-03 11:28:35','Тестовый отзыв',1,'TEST',NULL,NULL,NULL,1,NULL,4,0,NULL),(2,1,'2022-11-01 06:25:00','Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni sequi sint ab doloribus labore nihil?',1,'test',NULL,NULL,NULL,2,NULL,3,0,NULL);
/*!40000 ALTER TABLE `yupe_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_review_image`
--

DROP TABLE IF EXISTS `yupe_review_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_review_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `review_id` int(11) DEFAULT NULL COMMENT 'Id отзыва',
  `image` varchar(255) DEFAULT NULL COMMENT 'Изображение',
  `title` varchar(255) DEFAULT NULL COMMENT 'Title',
  `alt` varchar(255) DEFAULT NULL COMMENT 'Alt',
  `position` int(11) DEFAULT NULL COMMENT 'Сортировка',
  PRIMARY KEY (`id`),
  KEY `fk_yupe_review_image_review_id` (`review_id`),
  CONSTRAINT `fk_yupe_review_image_review_id` FOREIGN KEY (`review_id`) REFERENCES `yupe_review` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_review_image`
--

LOCK TABLES `yupe_review_image` WRITE;
/*!40000 ALTER TABLE `yupe_review_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_review_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_sitemap_page`
--

DROP TABLE IF EXISTS `yupe_sitemap_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_sitemap_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(250) NOT NULL,
  `changefreq` varchar(20) NOT NULL,
  `priority` float NOT NULL DEFAULT '0.5',
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_sitemap_page_url` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_sitemap_page`
--

LOCK TABLES `yupe_sitemap_page` WRITE;
/*!40000 ALTER TABLE `yupe_sitemap_page` DISABLE KEYS */;
INSERT INTO `yupe_sitemap_page` VALUES (1,'/','daily',0.5,1);
/*!40000 ALTER TABLE `yupe_sitemap_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_slider`
--

DROP TABLE IF EXISTS `yupe_slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'Название',
  `name_short` varchar(255) DEFAULT NULL COMMENT 'Короткое Название',
  `image` varchar(255) DEFAULT NULL COMMENT 'Изображение',
  `description` text COMMENT 'Описание',
  `description_short` text COMMENT 'Краткое описание',
  `button_name` varchar(255) DEFAULT NULL COMMENT 'Название кнопки',
  `button_link` varchar(255) DEFAULT NULL COMMENT 'url для кнопки',
  `status` int(11) DEFAULT NULL COMMENT 'Статус',
  `position` int(11) DEFAULT NULL COMMENT 'Сортировка',
  `image_xs` varchar(255) DEFAULT NULL COMMENT 'Изображение',
  `discont` text,
  `discont_css` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_slider`
--

LOCK TABLES `yupe_slider` WRITE;
/*!40000 ALTER TABLE `yupe_slider` DISABLE KEYS */;
INSERT INTO `yupe_slider` VALUES (20,'banner-1',NULL,'c5e52fd1ed5324d61f8d72ec3211af9a.png','',NULL,NULL,'/',1,1,NULL,NULL,NULL),(21,'banner-2',NULL,'1011efe857d1a2797672091adfe6160a.png','',NULL,NULL,'/',1,2,NULL,NULL,NULL);
/*!40000 ALTER TABLE `yupe_slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_stocks`
--

DROP TABLE IF EXISTS `yupe_stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` char(2) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `date` date NOT NULL,
  `title` varchar(250) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `short_text` text,
  `full_text` text NOT NULL,
  `image` varchar(300) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `description` varchar(250) NOT NULL,
  `badge` varchar(255) DEFAULT NULL,
  `badge_color` varchar(255) DEFAULT NULL,
  `bg_stock` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_stocks_slug_lang` (`slug`,`lang`),
  KEY `ix_yupe_stocks_status` (`status`),
  KEY `ix_yupe_stocks_date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_stocks`
--

LOCK TABLES `yupe_stocks` WRITE;
/*!40000 ALTER TABLE `yupe_stocks` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_stocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_attribute`
--

DROP TABLE IF EXISTS `yupe_store_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `unit` varchar(30) DEFAULT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `is_filter` smallint(6) NOT NULL DEFAULT '1',
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_store_attribute_name_group` (`name`,`group_id`),
  KEY `ix_yupe_store_attribute_title` (`title`),
  KEY `fk_yupe_store_attribute_group` (`group_id`),
  CONSTRAINT `fk_yupe_store_attribute_group` FOREIGN KEY (`group_id`) REFERENCES `yupe_store_attribute_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_attribute`
--

LOCK TABLES `yupe_store_attribute` WRITE;
/*!40000 ALTER TABLE `yupe_store_attribute` DISABLE KEYS */;
INSERT INTO `yupe_store_attribute` VALUES (89,NULL,'material','Материал',3,'',0,1,1,''),(90,NULL,'upakovka','Упаковка',3,'',0,2,1,'');
/*!40000 ALTER TABLE `yupe_store_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_attribute_group`
--

DROP TABLE IF EXISTS `yupe_store_attribute_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_attribute_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_attribute_group`
--

LOCK TABLES `yupe_store_attribute_group` WRITE;
/*!40000 ALTER TABLE `yupe_store_attribute_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_store_attribute_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_attribute_option`
--

DROP TABLE IF EXISTS `yupe_store_attribute_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_attribute_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) DEFAULT NULL,
  `position` tinyint(4) DEFAULT NULL,
  `value` varchar(255) DEFAULT '',
  `color` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_yupe_store_attribute_option_attribute_id` (`attribute_id`),
  KEY `ix_yupe_store_attribute_option_position` (`position`),
  CONSTRAINT `fk_yupe_store_attribute_option_attribute` FOREIGN KEY (`attribute_id`) REFERENCES `yupe_store_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_attribute_option`
--

LOCK TABLES `yupe_store_attribute_option` WRITE;
/*!40000 ALTER TABLE `yupe_store_attribute_option` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_store_attribute_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_category`
--

DROP TABLE IF EXISTS `yupe_store_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `slug` varchar(150) NOT NULL,
  `name` varchar(250) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `short_description` text,
  `description` text,
  `meta_title` varchar(250) DEFAULT NULL,
  `meta_description` varchar(500) DEFAULT NULL,
  `meta_keywords` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '1',
  `external_id` varchar(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `meta_canonical` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `image_title` varchar(255) DEFAULT NULL,
  `view` varchar(100) DEFAULT NULL,
  `image_two` varchar(255) DEFAULT NULL,
  `show_in_catalog` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_store_category_alias` (`slug`),
  KEY `ix_yupe_store_category_parent_id` (`parent_id`),
  KEY `ix_yupe_store_category_status` (`status`),
  KEY `yupe_store_category_external_id_ix` (`external_id`),
  CONSTRAINT `fk_yupe_store_category_parent` FOREIGN KEY (`parent_id`) REFERENCES `yupe_store_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_category`
--

LOCK TABLES `yupe_store_category` WRITE;
/*!40000 ALTER TABLE `yupe_store_category` DISABLE KEYS */;
INSERT INTO `yupe_store_category` VALUES (34,NULL,'talismany','Талисманы','718dbab99b0f5035c7e9b9a9829fab7a.png','','','','','',1,1,NULL,'Талисманы','','','','',NULL,1),(35,NULL,'amulety','Амулеты','c1497b9ee1904c70208d4c19e93c54a3.png','','','','','',1,2,NULL,'','','','','',NULL,1),(36,NULL,'oberegi','Обереги','3400b9133fcf9fbc998fe3d7f2938d65.png','','','','','',1,3,NULL,'','','','','',NULL,1),(37,NULL,'svechi','Свечи','e9826040ed51aaa2fcd94ada3f4e17ea.png','','','','','',1,4,NULL,'Свечи','','','','',NULL,1),(38,NULL,'ukrasheniya','Украшения','36d43ee5a361e01b68fdcafde8d8df33.png','','','','','',1,5,NULL,'Украшения','','','','',NULL,1),(39,NULL,'masla','Масла','17f86c0d284cbbd08c6af83308a62b4f.png','','','','','',1,6,NULL,'Масла','','','','',NULL,1),(40,NULL,'nabory','Наборы','cb44b1f0fb2a71b23c92d87a277552fe.png','','','','','',1,7,NULL,'Наборы','','','','',NULL,1),(41,NULL,'podarki','Подарки','33218599a54f713810e714b21893ec82.png','','','','','',1,8,NULL,'Подарки','','','','',NULL,1),(42,NULL,'kukly','Куклы','99120b9a270369702e897ca441708ffc.png','','','','','',1,9,NULL,'Куклы','','','','',NULL,1),(43,NULL,'akcii','Акции','c4f620be6ddb83e2d06bf7aab2caad57.png','','','','','',1,10,NULL,'Акции','','','','',NULL,1),(44,37,'sinie-svechi','Синие свечи',NULL,'','','','','',1,11,NULL,'Синие свечи','','','','',NULL,1),(45,34,'test','test',NULL,'','','','','',1,12,NULL,'','','','','',NULL,0);
/*!40000 ALTER TABLE `yupe_store_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_coupon`
--

DROP TABLE IF EXISTS `yupe_store_coupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `code` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `min_order_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `registered_user` tinyint(4) NOT NULL DEFAULT '0',
  `free_shipping` tinyint(4) NOT NULL DEFAULT '0',
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `quantity_per_user` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_coupon`
--

LOCK TABLES `yupe_store_coupon` WRITE;
/*!40000 ALTER TABLE `yupe_store_coupon` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_store_coupon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_delivery`
--

DROP TABLE IF EXISTS `yupe_store_delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_delivery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` float(10,2) NOT NULL DEFAULT '0.00',
  `free_from` float(10,2) DEFAULT NULL,
  `available_from` float(10,2) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `separate_payment` tinyint(4) DEFAULT '0',
  `class_delivery` varchar(255) DEFAULT NULL,
  `module` varchar(100) DEFAULT NULL,
  `settings` text,
  PRIMARY KEY (`id`),
  KEY `idx_yupe_store_delivery_position` (`position`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_delivery`
--

LOCK TABLES `yupe_store_delivery` WRITE;
/*!40000 ALTER TABLE `yupe_store_delivery` DISABLE KEYS */;
INSERT INTO `yupe_store_delivery` VALUES (2,'Почта России','',0.00,NULL,NULL,1,1,0,NULL,'rupost','a:7:{s:5:\"token\";s:0:\"\";s:3:\"key\";s:0:\"\";s:5:\"login\";s:0:\"\";s:8:\"password\";s:0:\"\";s:10:\"index_from\";s:0:\"\";s:15:\"sending_package\";s:1:\"0\";s:6:\"weight\";s:0:\"\";}'),(3,'ТК СДЭК','',0.00,NULL,NULL,2,1,0,NULL,'cdek','a:4:{s:7:\"account\";s:0:\"\";s:15:\"secure_password\";s:0:\"\";s:18:\"from_location_code\";s:0:\"\";s:7:\"is_test\";s:1:\"1\";}'),(4,'Boxberry','',0.00,NULL,NULL,3,1,0,NULL,NULL,NULL),(5,'Курьер по Москве','',0.00,NULL,NULL,4,0,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `yupe_store_delivery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_delivery_payment`
--

DROP TABLE IF EXISTS `yupe_store_delivery_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_delivery_payment` (
  `delivery_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  PRIMARY KEY (`delivery_id`,`payment_id`),
  KEY `fk_yupe_store_delivery_payment_payment` (`payment_id`),
  CONSTRAINT `fk_yupe_store_delivery_payment_delivery` FOREIGN KEY (`delivery_id`) REFERENCES `yupe_store_delivery` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_yupe_store_delivery_payment_payment` FOREIGN KEY (`payment_id`) REFERENCES `yupe_store_payment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_delivery_payment`
--

LOCK TABLES `yupe_store_delivery_payment` WRITE;
/*!40000 ALTER TABLE `yupe_store_delivery_payment` DISABLE KEYS */;
INSERT INTO `yupe_store_delivery_payment` VALUES (2,4),(3,4),(4,4),(5,4);
/*!40000 ALTER TABLE `yupe_store_delivery_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_order`
--

DROP TABLE IF EXISTS `yupe_store_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_id` int(11) DEFAULT NULL,
  `delivery_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payment_method_id` int(11) DEFAULT NULL,
  `paid` tinyint(4) DEFAULT '0',
  `payment_time` datetime DEFAULT NULL,
  `payment_details` text,
  `total_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `coupon_discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `separate_delivery` tinyint(4) DEFAULT '0',
  `status_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `street` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `comment` varchar(1024) NOT NULL DEFAULT '',
  `ip` varchar(15) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `note` varchar(1024) NOT NULL DEFAULT '',
  `modified` datetime DEFAULT NULL,
  `zipcode` varchar(30) DEFAULT NULL,
  `country` varchar(150) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `house` varchar(50) DEFAULT NULL,
  `apartment` varchar(10) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `orderId` varchar(150) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `regionName` varchar(255) DEFAULT NULL,
  `regionCode` varchar(255) DEFAULT NULL,
  `regionCodeEx` varchar(255) DEFAULT NULL,
  `cityName` varchar(255) DEFAULT NULL,
  `cityCode` int(11) DEFAULT NULL,
  `family` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `pvz_id` varchar(100) DEFAULT NULL,
  `pvz_address` varchar(1000) DEFAULT NULL,
  `tariff_id` int(11) DEFAULT NULL,
  `dispatch_number` int(11) DEFAULT NULL,
  `region_obj` text,
  `city_obj` text,
  `street_obj` text,
  `house_obj` text,
  `apartment_obj` text,
  `sub_delivery_id` int(11) DEFAULT NULL,
  `number_track` varchar(255) DEFAULT NULL,
  `address_obj` text,
  `sub_delivery_data` text,
  `delivery_pvz_data` text,
  `track` varchar(255) DEFAULT NULL,
  `delivery_data` text,
  `send_1c` int(11) DEFAULT '0',
  `gift_message` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `udx_yupe_store_order_url` (`url`),
  KEY `idx_yupe_store_order_user_id` (`user_id`),
  KEY `idx_yupe_store_order_date` (`date`),
  KEY `idx_yupe_store_order_status` (`status_id`),
  KEY `idx_yupe_store_order_paid` (`paid`),
  KEY `fk_yupe_store_order_delivery` (`delivery_id`),
  KEY `fk_yupe_store_order_payment` (`payment_method_id`),
  KEY `fk_yupe_store_order_manager` (`manager_id`),
  CONSTRAINT `fk_yupe_store_order_delivery` FOREIGN KEY (`delivery_id`) REFERENCES `yupe_store_delivery` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_yupe_store_order_manager` FOREIGN KEY (`manager_id`) REFERENCES `yupe_user_user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_yupe_store_order_payment` FOREIGN KEY (`payment_method_id`) REFERENCES `yupe_store_payment` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_yupe_store_order_status` FOREIGN KEY (`status_id`) REFERENCES `yupe_store_order_status` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_yupe_store_order_user` FOREIGN KEY (`user_id`) REFERENCES `yupe_user_user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_order`
--

LOCK TABLES `yupe_store_order` WRITE;
/*!40000 ALTER TABLE `yupe_store_order` DISABLE KEYS */;
INSERT INTO `yupe_store_order` VALUES (1,2,0.00,NULL,0,NULL,NULL,3800.00,0.00,0.00,0,1,'2022-11-09 19:42:42',NULL,'Test','','+7(999)999-99-99','Test','Test','46.191.249.46','9ed8687f37731dcf6ef976bd880f0ce6','','2022-11-09 19:42:42',NULL,'г Москва, ул Тестовская',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(2,2,0.00,NULL,0,NULL,NULL,1800.00,0.00,0.00,0,1,'2022-11-10 13:16:01',NULL,'вйцвйцв','','+7(312)312-31-23','цйвйцвцй','вцйвйцвцй','143.244.46.109','978aa8f569faaf6ddb9b9202b4e52c31','','2022-11-10 13:16:01',NULL,'йцвйвйцв',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(3,2,0.00,NULL,0,NULL,NULL,2000.00,0.00,0.00,0,1,'2022-11-10 13:20:45',NULL,'ацуауца','','+7(123)123-12-31','ацуацуа','ацуацуа','143.244.46.109','5daedf3570e917263732b5460b0c1f79','','2022-11-10 13:20:45',NULL,'1ауцацуауц',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(4,2,0.00,NULL,0,NULL,NULL,1800.00,0.00,0.00,0,1,'2022-11-10 13:23:53',NULL,'ТЕСТ','','+7(999)999-99-99','','','145.255.22.177','cb004c2f8b620d3424aca318420fb798','','2022-11-10 13:23:53',NULL,'г Оренбург',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(5,2,0.00,NULL,0,NULL,NULL,1800.00,0.00,0.00,0,1,'2022-11-10 15:43:21',NULL,'Testt','','+7(111)111-11-11','test@test.test','qweqwe','37.212.84.117','1b49ef0d76eff8427904da676908d877','','2022-11-10 15:43:21',NULL,'Test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(6,2,0.00,NULL,0,NULL,NULL,10800.00,0.00,0.00,0,1,'2022-11-21 11:19:01',1,'admin','','+7(899)999-99-99','bxsis1993@gmail.com','','145.255.22.177','85d0124aac090cff5c535eec4b0cc2fc','','2022-11-21 11:19:01',NULL,'г Оренбург',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL);
/*!40000 ALTER TABLE `yupe_store_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_order_coupon`
--

DROP TABLE IF EXISTS `yupe_store_order_coupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_order_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_yupe_store_order_coupon_order` (`order_id`),
  KEY `fk_yupe_store_order_coupon_coupon` (`coupon_id`),
  CONSTRAINT `fk_yupe_store_order_coupon_coupon` FOREIGN KEY (`coupon_id`) REFERENCES `yupe_store_coupon` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_yupe_store_order_coupon_order` FOREIGN KEY (`order_id`) REFERENCES `yupe_store_order` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_order_coupon`
--

LOCK TABLES `yupe_store_order_coupon` WRITE;
/*!40000 ALTER TABLE `yupe_store_order_coupon` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_store_order_coupon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_order_product`
--

DROP TABLE IF EXISTS `yupe_store_order_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_order_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `variants` text,
  `variants_text` varchar(1024) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `sku` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_yupe_store_order_product_order_id` (`order_id`),
  KEY `idx_yupe_store_order_product_product_id` (`product_id`),
  CONSTRAINT `fk_yupe_store_order_product_order` FOREIGN KEY (`order_id`) REFERENCES `yupe_store_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_yupe_store_order_product_product` FOREIGN KEY (`product_id`) REFERENCES `yupe_store_product` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_order_product`
--

LOCK TABLES `yupe_store_order_product` WRITE;
/*!40000 ALTER TABLE `yupe_store_order_product` DISABLE KEYS */;
INSERT INTO `yupe_store_order_product` VALUES (1,1,103,'Денежный талисман \"Деньговорот\"','a:0:{}',NULL,1800.00,1,'124356453'),(2,1,104,'Рунический талисман «Выход из тупика»','a:0:{}',NULL,2000.00,1,'5464575675'),(3,2,103,'Денежный талисман \"Деньговорот\"','a:0:{}',NULL,1800.00,1,'124356453'),(4,3,104,'Рунический талисман «Выход из тупика»','a:0:{}',NULL,2000.00,1,'5464575675'),(5,4,103,'Денежный талисман \"Деньговорот\"','a:0:{}',NULL,1800.00,1,'124356453'),(6,5,103,'Денежный талисман \"Деньговорот\"','a:0:{}',NULL,1800.00,1,'124356453'),(7,6,103,'Денежный талисман \"Деньговорот\"','a:0:{}',NULL,1800.00,6,'124356453');
/*!40000 ALTER TABLE `yupe_store_order_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_order_sdek_data`
--

DROP TABLE IF EXISTS `yupe_store_order_sdek_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_order_sdek_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `pvz_id` varchar(100) DEFAULT NULL,
  `pvz_address` varchar(1000) DEFAULT NULL,
  `tariff_id` int(11) DEFAULT NULL,
  `min_days` int(11) DEFAULT NULL,
  `max_days` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_order_sdek_data`
--

LOCK TABLES `yupe_store_order_sdek_data` WRITE;
/*!40000 ALTER TABLE `yupe_store_order_sdek_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_store_order_sdek_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_order_status`
--

DROP TABLE IF EXISTS `yupe_store_order_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_system` tinyint(1) NOT NULL DEFAULT '0',
  `color` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_order_status`
--

LOCK TABLES `yupe_store_order_status` WRITE;
/*!40000 ALTER TABLE `yupe_store_order_status` DISABLE KEYS */;
INSERT INTO `yupe_store_order_status` VALUES (1,'Новый',1,'default'),(2,'Принят',1,'info'),(3,'Выполнен',1,'success'),(4,'Удален',1,'danger');
/*!40000 ALTER TABLE `yupe_store_order_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_payment`
--

DROP TABLE IF EXISTS `yupe_store_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `settings` text,
  `currency_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `discount` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_yupe_store_payment_position` (`position`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_payment`
--

LOCK TABLES `yupe_store_payment` WRITE;
/*!40000 ALTER TABLE `yupe_store_payment` DISABLE KEYS */;
INSERT INTO `yupe_store_payment` VALUES (2,'alfabank','Онлайн оплата','','a:8:{s:8:\"userName\";s:11:\"anvikor-api\";s:8:\"password\";s:10:\"jw&4%6u04H\";s:6:\"server\";s:37:\"https://pay.alfabank.ru/payment/rest/\";s:8:\"merchant\";s:66:\"https://pay.alfabank.ru/payment/merchants/alfapage/payment_ru.html\";s:18:\"sessionTimeoutSecs\";s:4:\"1800\";s:9:\"returnUrl\";s:42:\"https://hoods.anvikor.ru/payment/process/2\";s:7:\"failUrl\";s:42:\"https://hoods.anvikor.ru/payment/process/2\";s:8:\"language\";s:2:\"ru\";}',NULL,2,1,0),(4,'yandexmoney3','ЮКасса','','a:5:{s:6:\"shopId\";s:0:\"\";s:8:\"password\";s:0:\"\";s:14:\"includeReceipt\";s:1:\"0\";s:8:\"vat_code\";s:1:\"1\";s:15:\"tax_system_code\";s:1:\"1\";}',NULL,3,1,0);
/*!40000 ALTER TABLE `yupe_store_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_producer`
--

DROP TABLE IF EXISTS `yupe_store_producer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_producer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_short` varchar(150) NOT NULL,
  `name` varchar(250) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `short_description` text,
  `description` text,
  `meta_title` varchar(250) DEFAULT NULL,
  `meta_keywords` varchar(250) DEFAULT NULL,
  `meta_description` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '0',
  `view` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_yupe_store_producer_slug` (`slug`),
  KEY `ix_yupe_store_producer_sort` (`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_producer`
--

LOCK TABLES `yupe_store_producer` WRITE;
/*!40000 ALTER TABLE `yupe_store_producer` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_store_producer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_product`
--

DROP TABLE IF EXISTS `yupe_store_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `producer_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `price` decimal(19,3) NOT NULL DEFAULT '0.000',
  `discount_price` decimal(19,3) DEFAULT NULL,
  `discount` decimal(19,3) DEFAULT NULL,
  `description` text,
  `short_description` text,
  `data` text,
  `is_special` tinyint(1) NOT NULL DEFAULT '0',
  `length` decimal(19,3) DEFAULT NULL,
  `width` decimal(19,3) DEFAULT NULL,
  `height` decimal(19,3) DEFAULT NULL,
  `weight` decimal(19,3) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `in_stock` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `meta_title` varchar(250) DEFAULT NULL,
  `meta_keywords` varchar(250) DEFAULT NULL,
  `meta_description` varchar(500) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `average_price` decimal(19,3) DEFAULT NULL,
  `purchase_price` decimal(19,3) DEFAULT NULL,
  `recommended_price` decimal(19,3) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '1',
  `external_id` varchar(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `meta_canonical` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `image_title` varchar(255) DEFAULT NULL,
  `view` varchar(100) DEFAULT NULL,
  `raiting` int(11) DEFAULT '0',
  `visits` int(11) DEFAULT '0',
  `price_result` decimal(19,3) DEFAULT NULL,
  `is_new` tinyint(1) NOT NULL DEFAULT '0',
  `is_hit` tinyint(1) NOT NULL DEFAULT '0',
  `video` varchar(255) DEFAULT NULL,
  `gallery_category` int(11) DEFAULT NULL,
  `is_delivery` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_store_product_alias` (`slug`),
  KEY `ix_yupe_store_product_status` (`status`),
  KEY `ix_yupe_store_product_type_id` (`type_id`),
  KEY `ix_yupe_store_product_producer_id` (`producer_id`),
  KEY `ix_yupe_store_product_price` (`price`),
  KEY `ix_yupe_store_product_discount_price` (`discount_price`),
  KEY `ix_yupe_store_product_create_time` (`create_time`),
  KEY `ix_yupe_store_product_update_time` (`update_time`),
  KEY `fk_yupe_store_product_category` (`category_id`),
  KEY `yupe_store_product_external_id_ix` (`external_id`),
  KEY `ix_yupe_store_product_sku` (`sku`),
  KEY `ix_yupe_store_product_name` (`name`),
  KEY `ix_yupe_store_product_position` (`position`),
  CONSTRAINT `fk_yupe_store_product_category` FOREIGN KEY (`category_id`) REFERENCES `yupe_store_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_yupe_store_product_producer` FOREIGN KEY (`producer_id`) REFERENCES `yupe_store_producer` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_yupe_store_product_type` FOREIGN KEY (`type_id`) REFERENCES `yupe_store_type` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_product`
--

LOCK TABLES `yupe_store_product` WRITE;
/*!40000 ALTER TABLE `yupe_store_product` DISABLE KEYS */;
INSERT INTO `yupe_store_product` VALUES (103,6,NULL,34,'124356453','Денежный талисман \"Деньговорот\"','denezhnyy-talisman-dengovorot',1800.000,NULL,NULL,'<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni voluptatibus aliquam ratione laboriosam maxime, soluta quas illo. Nobis ipsam aspernatur maxime totam dolores? Iste, molestiae placeat iusto asperiores repellendus, blanditiis minus delectus voluptatem quibusdam dicta dolore sed vel, ipsum deserunt nulla laudantium sit eius adipisci nemo molestias inventore aperiam dignissimos. Eveniet aperiam optio ab neque atque, odit accusamus perspiciatis excepturi qui esse. Error perspiciatis placeat nostrum! Beatae expedita delectus libero vel ducimus, tempore velit harum facilis quis voluptatibus sit deleniti odit suscipit quasi maxime amet. Beatae delectus molestias sint qui exercitationem consequatur sapiente. Sed similique, nobis repellendus rerum expedita nemo saepe praesentium voluptatum neque aperiam nam assumenda. Deleniti recusandae praesentium, impedit amet quisquam obcaecati debitis quae, accusantium ullam corporis maiores dicta iusto accusamus quod ipsa itaque odit placeat! Laboriosam mollitia corrupti quis ea debitis sequi quae perspiciatis provident rerum? Eius rem veniam a unde velit sint nam quo quaerat ipsum.</p>','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-09-26 11:16:34','2022-12-16 22:36:02','','','','43b1becdf5dc29d0f53cc28a31e92d69.png',NULL,NULL,NULL,1,NULL,'','','','','',0,333,1800.000,0,1,'',NULL,0),(104,6,NULL,34,'5464575675','Рунический талисман «Выход из тупика»','runicheskii-talisman-vyhod-iz-tupika',2000.000,NULL,NULL,'<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Adipisci eos vel perferendis vitae non veniam at dicta? Excepturi blanditiis voluptatibus voluptatum. Molestias inventore modi veniam quia quis, repellat temporibus distinctio, tempore aperiam fugiat ratione a, atque eum illo mollitia impedit nostrum eos necessitatibus corporis. Accusantium impedit laborum error a cumque libero soluta harum minus cum! Labore consequuntur sunt dolores facere pariatur voluptate commodi, laborum eaque odit molestiae deserunt hic fugit veritatis vel laboriosam odio dolorem voluptatum quod autem nobis velit mollitia accusamus voluptas! Quo earum illum ratione neque minima et provident, vero officiis qui tempore, ducimus tenetur dolor assumenda voluptatem?</p>','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-09-26 19:15:22','2022-12-21 00:02:06','','','','c98ceb208c8552acdcee9d1a86d1c62b.png',NULL,NULL,NULL,2,NULL,'','','','','',0,61,2000.000,0,1,'',NULL,0),(105,6,NULL,35,'111111','Тестовый','testovyy',1500.000,0.000,0.000,'<p>Тестовый</p>','','',0,NULL,NULL,NULL,NULL,100,1,1,'2022-12-18 14:03:50','2022-12-21 12:08:34','','','','50c40f629e01314284dab181d805e91e.png',NULL,NULL,NULL,3,NULL,'','','','','',0,7,1500.000,0,0,'',NULL,0),(106,6,NULL,37,'20230001','Свеча из пчелиного воска','svecha-iz-pchelinogo-voska',950.000,NULL,NULL,'<p>Свеча из пчелиного воска ручной работы</p>','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 12:30:55','2022-12-20 13:08:02','','','','2dd084ad7342568b68ba2f53b7fe7643.jpg',NULL,NULL,NULL,4,NULL,'','','','','',0,1,950.000,0,0,'',NULL,0),(107,6,NULL,35,'20230002','Браслет-амулет на удачу','braslet-amulet-na-udachu',3500.000,NULL,NULL,'<p>Браслет из натуральных камней</p>','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 12:37:46','2022-12-20 12:37:46','','','','d06f2219cc482b8e0bcd700947662494.jpg',NULL,NULL,NULL,5,NULL,'','','','','',0,0,3500.000,0,0,'',NULL,0),(108,6,NULL,40,'20230003','Набор свечей из соевого воска','nabor-svechey-iz-soevogo-voska',3800.000,NULL,NULL,'<p>Набор свечей из соевого воска с кристаллами и травами</p>','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 12:39:22','2022-12-20 12:39:22','','','','1a00da49145901f9eb78cb80c12b72e5.jpg',NULL,NULL,NULL,6,NULL,'','','','','',0,0,3800.000,1,0,'',NULL,0),(109,6,NULL,38,'20230004','Колье ручной работы','kole-ruchnoy-raboty',4200.000,NULL,NULL,'<p>Колье ручной работы&nbsp;</p>','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 12:41:00','2022-12-20 12:41:00','','','','7041306cc69acc80d08b4c9e92bf0b6b.jpg',NULL,NULL,NULL,7,NULL,'','','','','',0,0,4200.000,0,0,'',NULL,0),(110,6,NULL,37,'20230005','Свеча из соевого воска','svecha-iz-soevogo-voska',860.000,NULL,NULL,'','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 12:41:57','2022-12-20 13:07:52','','','','de7477946628a4c6f55c86d44f5d923f.jpg',NULL,NULL,NULL,8,NULL,'','','','','',0,1,860.000,0,0,'',NULL,0),(111,6,NULL,37,'20230006','Свеча из пчелиного воска \"Морская\"','svecha-iz-pchelinogo-voska-morskaya',1200.000,NULL,NULL,'<p>Свеча из пчелиного воска с ракушками</p>','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 12:45:06','2022-12-20 13:54:37','','','','7dbe10f754ee5c14ad1a60f91a66a8c4.jpg',NULL,NULL,NULL,9,NULL,'','','','','',0,1,1200.000,0,0,'',NULL,0),(112,6,NULL,35,'20230007','Браслет-амулет на исполнение мечты','braslet-amulet-na-ispolnenie-mechty',0.000,NULL,NULL,'','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 12:46:43','2022-12-20 12:46:43','','','','e376c2345117bf140af31f274b338774.jpg',NULL,NULL,NULL,10,NULL,'','','','','',0,0,0.000,0,0,'',NULL,0),(113,6,NULL,42,'20230007','Текстильная кукла - талисман','tekstilnaya-kukla-talisman',5000.000,NULL,NULL,'<p>Текстильная кукла - талисман ручной работы</p>','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 13:00:38','2022-12-20 13:00:38','','','','afc66a8ab9993c57fc4a7a4e26b4b247.jpg',NULL,NULL,NULL,11,NULL,'','','','','',0,0,5000.000,0,0,'',NULL,0),(114,6,NULL,38,'20230008','Колье из натуральных камней','kole-iz-naturalnyh-kamney',5500.000,NULL,NULL,'','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 13:02:10','2022-12-20 18:26:05','','','','c1440b82cd1fb57961743ab021172dfb.jpg',NULL,NULL,NULL,12,NULL,'','','','','',0,1,5500.000,0,0,'',NULL,0),(115,6,NULL,39,'20230008','Ботаническое масло любви','botanicheskoe-maslo-lyubvi',4200.000,NULL,NULL,'','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 13:10:57','2022-12-20 13:10:57','','','','cc5100e0238b0f6e92670b3c57ef5011.jpg',NULL,NULL,NULL,13,NULL,'','','','','',0,0,4200.000,0,0,'',NULL,0),(116,6,NULL,41,'20230009','Подарочный набор \"Свечи\"','podarochnyy-nabor-svechi',5000.000,NULL,NULL,'','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 13:12:37','2022-12-20 13:12:37','','','','21711eba747dcd8220de3e55c35e6a7e.jpg',NULL,NULL,NULL,14,NULL,'','','','','',0,0,5000.000,0,0,'',NULL,0),(117,6,NULL,35,'20230009','Браслет-амулет \"Любовь\"','braslet-amulet-lyubov',4800.000,NULL,NULL,'','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 13:13:49','2022-12-21 14:09:47','','','','c231353d70d593ce9df9751e478f7dfa.jpg',NULL,NULL,NULL,15,NULL,'','','','','',0,3,4800.000,0,0,'',NULL,0),(118,6,NULL,34,'20230010','Браслет - талисман \"Сила камней\"','braslet-talisman-sila-kamney',4200.000,NULL,NULL,'','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 13:15:10','2022-12-20 13:58:36','','','','d0021467b4198e5316827381ffdd86f1.jpg',NULL,NULL,NULL,16,NULL,'','','','','',0,2,4200.000,0,0,'',NULL,0),(119,6,NULL,37,'20230011','Розовая свеча с травами','rozovaya-svecha-s-travami',520.000,NULL,NULL,'','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 13:17:50','2022-12-21 00:18:49','','','','40036c159e4d63c894d14ff6a7678d5f.jpg',NULL,NULL,NULL,17,NULL,'','','','','',0,1,520.000,0,0,'',NULL,0),(120,6,NULL,37,'20230012','Цветные свечи из пчелиного воска с травми','cvetnye-svechi-iz-pchelinogo-voska-s-travmi',580.000,NULL,NULL,'','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 13:19:19','2022-12-20 13:19:19','','','','161eb9bbecd7a00fe6fa2ca85b10a655.jpg',NULL,NULL,NULL,18,NULL,'','','','','',0,0,580.000,0,0,'',NULL,0),(121,6,NULL,41,'20230013','Масло для сна и расслабления','maslo-dlya-sna-i-rasslableniya',3800.000,NULL,NULL,'','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 13:47:23','2022-12-20 13:47:23','','','','1f1d4772b2b813f98001538407f048ca.jpg',NULL,NULL,NULL,19,NULL,'','','','','',0,0,3800.000,0,0,'',NULL,0),(122,6,NULL,39,'20230014','Натуральное масло розы','naturalnoe-maslo-rozy',2500.000,NULL,NULL,'','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 13:48:33','2022-12-21 07:47:12','','','','be7bd25d6036ea0c3e40d1f81d18198f.jpg',NULL,NULL,NULL,20,NULL,'','','','','',0,1,2500.000,0,0,'',NULL,0),(123,6,NULL,34,'20230015','Масло - талисман','maslo-talisman',3350.000,NULL,NULL,'','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 13:49:39','2022-12-21 08:01:15','','','','8fc1f26bede33543a8571ba9c10ab6f5.jpg',NULL,NULL,NULL,21,NULL,'','','','','',0,5,3350.000,0,0,'',NULL,0),(124,6,NULL,40,'20230017','Набор цветочных масел для тела','nabor-cvetochnyh-masel-dlya-tela',6300.000,NULL,NULL,'','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 13:51:09','2022-12-20 13:51:09','','','','38eead90b1e56012cea78976a40ec847.jpg',NULL,NULL,NULL,22,NULL,'','','','','',0,0,6300.000,0,0,'',NULL,0),(125,6,NULL,40,'20230018','Набор свечей','nabor-svechey',7500.000,NULL,NULL,'','','',0,NULL,NULL,NULL,NULL,NULL,1,1,'2022-12-20 13:52:55','2022-12-20 13:52:55','','','','1848c1668024ab36d46e17cb121ab0ea.jpg',NULL,NULL,NULL,23,NULL,'','','','','',0,0,7500.000,0,0,'',NULL,0);
/*!40000 ALTER TABLE `yupe_store_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_product_attribute_value`
--

DROP TABLE IF EXISTS `yupe_store_product_attribute_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_product_attribute_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `number_value` double DEFAULT NULL,
  `string_value` varchar(250) DEFAULT NULL,
  `text_value` text,
  `option_value` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `yupe_fk_product_attribute_product` (`product_id`),
  KEY `yupe_fk_product_attribute_attribute` (`attribute_id`),
  KEY `yupe_fk_product_attribute_option` (`option_value`),
  KEY `yupe_ix_product_attribute_number_value` (`number_value`),
  KEY `yupe_ix_product_attribute_string_value` (`string_value`),
  CONSTRAINT `yupe_fk_product_attribute_attribute` FOREIGN KEY (`attribute_id`) REFERENCES `yupe_store_attribute` (`id`) ON DELETE CASCADE,
  CONSTRAINT `yupe_fk_product_attribute_option` FOREIGN KEY (`option_value`) REFERENCES `yupe_store_attribute_option` (`id`) ON DELETE CASCADE,
  CONSTRAINT `yupe_fk_product_attribute_product` FOREIGN KEY (`product_id`) REFERENCES `yupe_store_product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1063 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_product_attribute_value`
--

LOCK TABLES `yupe_store_product_attribute_value` WRITE;
/*!40000 ALTER TABLE `yupe_store_product_attribute_value` DISABLE KEYS */;
INSERT INTO `yupe_store_product_attribute_value` VALUES (1058,103,89,1,NULL,NULL,NULL,NULL),(1059,104,89,0,NULL,NULL,NULL,NULL),(1060,105,89,1,NULL,NULL,NULL,NULL),(1061,111,89,0,NULL,NULL,NULL,NULL),(1062,111,90,0,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `yupe_store_product_attribute_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_product_category`
--

DROP TABLE IF EXISTS `yupe_store_product_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_yupe_store_product_category_product_id` (`product_id`),
  KEY `ix_yupe_store_product_category_category_id` (`category_id`),
  CONSTRAINT `fk_yupe_store_product_category_category` FOREIGN KEY (`category_id`) REFERENCES `yupe_store_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_yupe_store_product_category_product` FOREIGN KEY (`product_id`) REFERENCES `yupe_store_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_product_category`
--

LOCK TABLES `yupe_store_product_category` WRITE;
/*!40000 ALTER TABLE `yupe_store_product_category` DISABLE KEYS */;
INSERT INTO `yupe_store_product_category` VALUES (1,105,40),(2,105,40);
/*!40000 ALTER TABLE `yupe_store_product_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_product_image`
--

DROP TABLE IF EXISTS `yupe_store_product_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_product_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `option_color_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_yupe_store_product_image_product` (`product_id`),
  KEY `fk_yupe_store_product_image_group` (`group_id`),
  CONSTRAINT `fk_yupe_store_product_image_group` FOREIGN KEY (`group_id`) REFERENCES `yupe_store_product_image_group` (`id`) ON UPDATE SET NULL,
  CONSTRAINT `fk_yupe_store_product_image_product` FOREIGN KEY (`product_id`) REFERENCES `yupe_store_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_product_image`
--

LOCK TABLES `yupe_store_product_image` WRITE;
/*!40000 ALTER TABLE `yupe_store_product_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_store_product_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_product_image_group`
--

DROP TABLE IF EXISTS `yupe_store_product_image_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_product_image_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_product_image_group`
--

LOCK TABLES `yupe_store_product_image_group` WRITE;
/*!40000 ALTER TABLE `yupe_store_product_image_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_store_product_image_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_product_link`
--

DROP TABLE IF EXISTS `yupe_store_product_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_product_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `linked_product_id` int(11) NOT NULL,
  `position` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_store_product_link_product` (`product_id`,`linked_product_id`),
  KEY `fk_yupe_store_product_link_linked_product` (`linked_product_id`),
  KEY `fk_yupe_store_product_link_type` (`type_id`),
  CONSTRAINT `fk_yupe_store_product_link_linked_product` FOREIGN KEY (`linked_product_id`) REFERENCES `yupe_store_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_yupe_store_product_link_product` FOREIGN KEY (`product_id`) REFERENCES `yupe_store_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_yupe_store_product_link_type` FOREIGN KEY (`type_id`) REFERENCES `yupe_store_product_link_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_product_link`
--

LOCK TABLES `yupe_store_product_link` WRITE;
/*!40000 ALTER TABLE `yupe_store_product_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_store_product_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_product_link_type`
--

DROP TABLE IF EXISTS `yupe_store_product_link_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_product_link_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_store_product_link_type_code` (`code`),
  UNIQUE KEY `ux_yupe_store_product_link_type_title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_product_link_type`
--

LOCK TABLES `yupe_store_product_link_type` WRITE;
/*!40000 ALTER TABLE `yupe_store_product_link_type` DISABLE KEYS */;
INSERT INTO `yupe_store_product_link_type` VALUES (1,'similar','Похожие'),(2,'related','Сопутствующие');
/*!40000 ALTER TABLE `yupe_store_product_link_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_product_photos_reviews`
--

DROP TABLE IF EXISTS `yupe_store_product_photos_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_product_photos_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `alt` varchar(250) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_product_photos_reviews`
--

LOCK TABLES `yupe_store_product_photos_reviews` WRITE;
/*!40000 ALTER TABLE `yupe_store_product_photos_reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_store_product_photos_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_product_photos_reviews_marketplace`
--

DROP TABLE IF EXISTS `yupe_store_product_photos_reviews_marketplace`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_product_photos_reviews_marketplace` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `alt` varchar(250) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_product_photos_reviews_marketplace`
--

LOCK TABLES `yupe_store_product_photos_reviews_marketplace` WRITE;
/*!40000 ALTER TABLE `yupe_store_product_photos_reviews_marketplace` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_store_product_photos_reviews_marketplace` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_product_tabs`
--

DROP TABLE IF EXISTS `yupe_store_product_tabs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_product_tabs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `body` text,
  PRIMARY KEY (`id`),
  KEY `fk_yupe_store_product_tabs_product` (`product_id`),
  CONSTRAINT `fk_yupe_store_product_tabs_product` FOREIGN KEY (`product_id`) REFERENCES `yupe_store_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_product_tabs`
--

LOCK TABLES `yupe_store_product_tabs` WRITE;
/*!40000 ALTER TABLE `yupe_store_product_tabs` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_store_product_tabs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_product_variant`
--

DROP TABLE IF EXISTS `yupe_store_product_variant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_product_variant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `type` tinyint(4) NOT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '1',
  `quantity` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_yupe_store_product_variant_product` (`product_id`),
  KEY `idx_yupe_store_product_variant_attribute` (`attribute_id`),
  KEY `idx_yupe_store_product_variant_value` (`attribute_value`),
  CONSTRAINT `fk_yupe_store_product_variant_attribute` FOREIGN KEY (`attribute_id`) REFERENCES `yupe_store_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_yupe_store_product_variant_product` FOREIGN KEY (`product_id`) REFERENCES `yupe_store_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_product_variant`
--

LOCK TABLES `yupe_store_product_variant` WRITE;
/*!40000 ALTER TABLE `yupe_store_product_variant` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_store_product_variant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_type`
--

DROP TABLE IF EXISTS `yupe_store_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_store_type_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_type`
--

LOCK TABLES `yupe_store_type` WRITE;
/*!40000 ALTER TABLE `yupe_store_type` DISABLE KEYS */;
INSERT INTO `yupe_store_type` VALUES (6,'Общий');
/*!40000 ALTER TABLE `yupe_store_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_store_type_attribute`
--

DROP TABLE IF EXISTS `yupe_store_type_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_store_type_attribute` (
  `type_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  PRIMARY KEY (`type_id`,`attribute_id`),
  KEY `fk_yupe_store_type_attribute_attribute` (`attribute_id`),
  CONSTRAINT `fk_yupe_store_type_attribute_attribute` FOREIGN KEY (`attribute_id`) REFERENCES `yupe_store_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_yupe_store_type_attribute_type` FOREIGN KEY (`type_id`) REFERENCES `yupe_store_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_store_type_attribute`
--

LOCK TABLES `yupe_store_type_attribute` WRITE;
/*!40000 ALTER TABLE `yupe_store_type_attribute` DISABLE KEYS */;
INSERT INTO `yupe_store_type_attribute` VALUES (6,89),(6,90);
/*!40000 ALTER TABLE `yupe_store_type_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_user_tokens`
--

DROP TABLE IF EXISTS `yupe_user_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_user_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `expire_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_yupe_user_tokens_user_id` (`user_id`),
  CONSTRAINT `fk_yupe_user_tokens_user_id` FOREIGN KEY (`user_id`) REFERENCES `yupe_user_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=870 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_user_tokens`
--

LOCK TABLES `yupe_user_tokens` WRITE;
/*!40000 ALTER TABLE `yupe_user_tokens` DISABLE KEYS */;
INSERT INTO `yupe_user_tokens` VALUES (869,1,'QXR6WeEzxLqLWsvjClNcPGIMoqojex8N',4,0,'2022-12-20 12:00:36','2022-12-20 12:00:36','176.15.63.100','2022-12-27 12:00:36');
/*!40000 ALTER TABLE `yupe_user_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_user_user`
--

DROP TABLE IF EXISTS `yupe_user_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_user_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `update_time` datetime NOT NULL,
  `first_name` varchar(250) DEFAULT NULL,
  `middle_name` varchar(250) DEFAULT NULL,
  `last_name` varchar(250) DEFAULT NULL,
  `nick_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '0',
  `birth_date` date DEFAULT NULL,
  `site` varchar(250) NOT NULL DEFAULT '',
  `about` varchar(250) NOT NULL DEFAULT '',
  `location` varchar(250) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT '2',
  `access_level` int(11) NOT NULL DEFAULT '0',
  `visit_time` datetime DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `avatar` varchar(150) DEFAULT NULL,
  `hash` varchar(255) NOT NULL DEFAULT 'cd5b72e139b6eac28da738a399c57f9c0.32374800 1576817729',
  `email_confirm` tinyint(1) NOT NULL DEFAULT '0',
  `phone` char(30) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `building` varchar(255) DEFAULT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT '0',
  `inn` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `ogrn` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_user_user_nick_name` (`nick_name`),
  UNIQUE KEY `ux_yupe_user_user_email` (`email`),
  KEY `ix_yupe_user_user_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_user_user`
--

LOCK TABLES `yupe_user_user` WRITE;
/*!40000 ALTER TABLE `yupe_user_user` DISABLE KEYS */;
INSERT INTO `yupe_user_user` VALUES (1,'2022-09-26 17:44:13','','','','admin','tyumikov.ivan@yandex.ru',1,NULL,'','','Оренбург',1,1,'2022-12-20 12:00:36','2019-12-20 09:58:04','1_1597586326.png','$2y$13$NsbP1UKVc1nMTiqRXVQrkeq19FPxGA2ppHmiOWVprJlpFIFJZx5qG',1,'','','','','','','',0,'','','');
/*!40000 ALTER TABLE `yupe_user_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_user_user_auth_assignment`
--

DROP TABLE IF EXISTS `yupe_user_user_auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_user_user_auth_assignment` (
  `itemname` char(64) NOT NULL,
  `userid` int(11) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  KEY `fk_yupe_user_user_auth_assignment_user` (`userid`),
  CONSTRAINT `fk_yupe_user_user_auth_assignment_item` FOREIGN KEY (`itemname`) REFERENCES `yupe_user_user_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_yupe_user_user_auth_assignment_user` FOREIGN KEY (`userid`) REFERENCES `yupe_user_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_user_user_auth_assignment`
--

LOCK TABLES `yupe_user_user_auth_assignment` WRITE;
/*!40000 ALTER TABLE `yupe_user_user_auth_assignment` DISABLE KEYS */;
INSERT INTO `yupe_user_user_auth_assignment` VALUES ('admin',1,NULL,NULL);
/*!40000 ALTER TABLE `yupe_user_user_auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_user_user_auth_item`
--

DROP TABLE IF EXISTS `yupe_user_user_auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_user_user_auth_item` (
  `name` char(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`),
  KEY `ix_yupe_user_user_auth_item_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_user_user_auth_item`
--

LOCK TABLES `yupe_user_user_auth_item` WRITE;
/*!40000 ALTER TABLE `yupe_user_user_auth_item` DISABLE KEYS */;
INSERT INTO `yupe_user_user_auth_item` VALUES ('admin',2,'Администратор',NULL,NULL),('Blog.BlogBackend.Create',0,'Создание блога',NULL,NULL),('Blog.BlogBackend.Delete',0,'Удаление блога',NULL,NULL),('Blog.BlogBackend.Index',0,'Просмотр списка блогов',NULL,NULL),('Blog.BlogBackend.Update',0,'Редактирование блога',NULL,NULL),('Blog.BlogBackend.View',0,'Просмотр блога',NULL,NULL),('Blog.BlogManager',1,'Блоги',NULL,NULL),('Blog.PostBackend.Create',0,'Создание записи',NULL,NULL),('Blog.PostBackend.Delete',0,'Удаление записи',NULL,NULL),('Blog.PostBackend.Index',0,'Просмотр списка постов',NULL,NULL),('Blog.PostBackend.Update',0,'Редактирование записи',NULL,NULL),('Blog.PostBackend.View',0,'Просмотр записи',NULL,NULL),('Blog.UserToBlogBackend.Create',0,'Создание участника',NULL,NULL),('Blog.UserToBlogBackend.Delete',0,'Удаление участника',NULL,NULL),('Blog.UserToBlogBackend.Index',0,'Просмотр списка участников',NULL,NULL),('Blog.UserToBlogBackend.Update',0,'Редактирование участника',NULL,NULL),('Blog.UserToBlogBackend.View',0,'Просмотр участника',NULL,NULL),('Category.CategoryBackend.Create',0,'Создание категории',NULL,NULL),('Category.CategoryBackend.Delete',0,'Удаление категории',NULL,NULL),('Category.CategoryBackend.Index',0,'Просмотр списка категорий',NULL,NULL),('Category.CategoryBackend.Update',0,'Редактирование категорий',NULL,NULL),('Category.CategoryBackend.View',0,'Просмотр категорий',NULL,NULL),('Category.CategoryManager',1,'Управление категориями',NULL,NULL),('Comment.CommentBackend.Create',0,'Создание комментария',NULL,NULL),('Comment.CommentBackend.Delete',0,'Удаление комментария',NULL,NULL),('Comment.CommentBackend.Index',0,'Просмотр списка комментариев',NULL,NULL),('Comment.CommentBackend.Update',0,'Редактирование комментария',NULL,NULL),('Comment.CommentBackend.View',0,'Просмотр комментариев',NULL,NULL),('Comment.CommentManager',1,'Управление комментариями',NULL,NULL),('ContentBlock.ContentblockBackend.Create',0,'Создание блока',NULL,NULL),('ContentBlock.ContentblockBackend.Delete',0,'Удаление блока',NULL,NULL),('ContentBlock.ContentblockBackend.Index',0,'Просмотр списка блоков',NULL,NULL),('ContentBlock.ContentblockBackend.Update',0,'Редактирование блока контента',NULL,NULL),('ContentBlock.ContentblockBackend.View',0,'Просмотр блоков',NULL,NULL),('ContentBlock.ContentBlockManager',1,'Управление блоками',NULL,NULL),('Coupon.CouponBackend.Create',0,'Добавить купон',NULL,NULL),('Coupon.CouponBackend.Delete',0,'Удалить купон',NULL,NULL),('Coupon.CouponBackend.Index',0,'Купоны',NULL,NULL),('Coupon.CouponBackend.Management',1,'Управление купонами',NULL,NULL),('Coupon.CouponBackend.Update',0,'Редактировать купон',NULL,NULL),('Coupon.CouponBackend.View',0,'Просмотреть купон',NULL,NULL),('Dealers.DealersBackend.Index',0,'Index',NULL,NULL),('Dealers.DealersManager',1,'Manage dealers',NULL,NULL),('Delivery.DeliveryBackend.Create',0,'Добавить способ доставки',NULL,NULL),('Delivery.DeliveryBackend.Delete',0,'Удалить способ доставки',NULL,NULL),('Delivery.DeliveryBackend.Index',0,'Способы доставки',NULL,NULL),('Delivery.DeliveryBackend.Management',1,'Управление способами доставки',NULL,NULL),('Delivery.DeliveryBackend.Update',0,'Редактировать способ доставки',NULL,NULL),('Delivery.DeliveryBackend.View',0,'Просмотреть способ доставки',NULL,NULL),('Feedback.FeedbackBackend.Answer',0,'Ответ на сообщения обратной связи',NULL,NULL),('Feedback.FeedbackBackend.Create',0,'Создание сообщения обратной связи',NULL,NULL),('Feedback.FeedbackBackend.Delete',0,'Удаление сообщений обратной связи',NULL,NULL),('Feedback.FeedbackBackend.Index',0,'Просмотр списка сообщений обратной связи',NULL,NULL),('Feedback.FeedbackBackend.Update',0,'Редактирование сообщений обратной связи',NULL,NULL),('Feedback.FeedbackBackend.View',0,'Просмотр сообщения обратной связи',NULL,NULL),('Feedback.FeedbackManager',1,'Управление обратной связью',NULL,NULL),('Gallery.GalleryBackend.Addimages',0,'Добавить изображение',NULL,NULL),('Gallery.GalleryBackend.Create',0,'Создание галерей',NULL,NULL),('Gallery.GalleryBackend.Delete',0,'Удаление галерей',NULL,NULL),('Gallery.GalleryBackend.DeleteImage',0,'Удаление изображения галереи',NULL,NULL),('Gallery.GalleryBackend.Images',0,'Просмотр списка изображений галерей',NULL,NULL),('Gallery.GalleryBackend.Index',0,'Просмотр списка галерей',NULL,NULL),('Gallery.GalleryBackend.Update',0,'Редактирование галерей',NULL,NULL),('Gallery.GalleryBackend.View',0,'Просмотр галерей',NULL,NULL),('Gallery.GalleryManager',1,'Управление галереями',NULL,NULL),('Homepage.YupeBackend.Modulesettings',0,'Настройка домашней страницы',NULL,NULL),('Image.ImageBackend.Create',0,'Создание изображений',NULL,NULL),('Image.ImageBackend.Delete',0,'Удаление изображений',NULL,NULL),('Image.ImageBackend.Index',0,'Просмотр списка изображений',NULL,NULL),('Image.ImageBackend.Update',0,'Редактирование изображений',NULL,NULL),('Image.ImageBackend.View',0,'Просмотр изображений',NULL,NULL),('Image.ImageManager',1,'Управление изображениями',NULL,NULL),('Mail.EventBackend.Create',0,'Создание почтового события',NULL,NULL),('Mail.EventBackend.Delete',0,'Удаление почтового события',NULL,NULL),('Mail.EventBackend.Index',0,'Просмотр списка почтовых событий',NULL,NULL),('Mail.EventBackend.Update',0,'Редактирование почтовых событий',NULL,NULL),('Mail.EventBackend.View',0,'Просмотр постовых событий',NULL,NULL),('Mail.MailManager',1,'Управление почтовыми событиями и шаблонами',NULL,NULL),('Mail.TemplateBackend.Create',0,'Создание шаблона для почтового события',NULL,NULL),('Mail.TemplateBackend.Delete',0,'Удаление шаблона почтового события',NULL,NULL),('Mail.TemplateBackend.Index',0,'Просмотр списка шаблонов почтовых событий',NULL,NULL),('Mail.TemplateBackend.Update',0,'Редактирование шаблона почтового события',NULL,NULL),('Mail.TemplateBackend.View',0,'Просмотр шаблона почтового события',NULL,NULL),('ManageHomePage',1,'Настройка домашней страницы',NULL,NULL),('ManageYupeParams',1,'Управление параметрами Юпи!',NULL,NULL),('Menu.MenuBackend.Create',0,'Создание меню',NULL,NULL),('Menu.MenuBackend.Delete',0,'Удаление меню',NULL,NULL),('Menu.MenuBackend.Index',0,'Просмотр списка меню',NULL,NULL),('Menu.MenuBackend.Update',0,'Редактирование меню',NULL,NULL),('Menu.MenuBackend.View',0,'Просмотр меню',NULL,NULL),('Menu.MenuitemBackend.Create',0,'Создание пунктов меню',NULL,NULL),('Menu.MenuitemBackend.Delete',0,'Удаление пунктов меню',NULL,NULL),('Menu.MenuitemBackend.Index',0,'Просмотр списка пунктов меню',NULL,NULL),('Menu.MenuitemBackend.Update',0,'Редактирование пунктов меню',NULL,NULL),('Menu.MenuitemBackend.View',0,'Просмотр пунктов меню',NULL,NULL),('Menu.MenuManager',1,'Меню',NULL,NULL),('News.NewsBackend.Create',0,'Создание новости',NULL,NULL),('News.NewsBackend.Delete',0,'Удаление новости',NULL,NULL),('News.NewsBackend.Index',0,'Просмотр списка новостей',NULL,NULL),('News.NewsBackend.Update',0,'Редактирование новостей',NULL,NULL),('News.NewsBackend.View',0,'Просмотр новости',NULL,NULL),('News.NewsManager',1,'Управление новостями',NULL,NULL),('NotifyModule.NotifyManage',1,'Управление уведомлениями',NULL,NULL),('NotifyModule.NotifyManage.manage',0,'Управление уведомлениями',NULL,NULL),('Order.OrderBackend.Create',0,'Добавить заказ',NULL,NULL),('Order.OrderBackend.Delete',0,'Удалить заказ',NULL,NULL),('Order.OrderBackend.Index',0,'Просмотреть список заказов',NULL,NULL),('Order.OrderBackend.Management',1,'Все заказы',NULL,NULL),('Order.OrderBackend.Update',0,'Редактировать заказ',NULL,NULL),('Order.OrderBackend.View',0,'Просмотреть заказ',NULL,NULL),('Order.StatusBackend.Create',0,'Добавить статус',NULL,NULL),('Order.StatusBackend.Delete',0,'Удалить статус',NULL,NULL),('Order.StatusBackend.Index',0,'Просмотреть список статусов',NULL,NULL),('Order.StatusBackend.Management',1,'Статусы заказов',NULL,NULL),('Order.StatusBackend.Update',0,'Редактировать статус',NULL,NULL),('Page.PageBackend.Create',0,'Создание страниц',NULL,NULL),('Page.PageBackend.Delete',0,'Удаление страниц',NULL,NULL),('Page.PageBackend.Index',0,'Просмотр списка страниц',NULL,NULL),('Page.PageBackend.Update',0,'Редактирование страниц',NULL,NULL),('Page.PageBackend.View',0,'Просмотр страниц',NULL,NULL),('Page.PageManager',1,'Управление страницами',NULL,NULL),('Payment.PaymentBackend.Create',0,'Добавить способ оплаты',NULL,NULL),('Payment.PaymentBackend.Delete',0,'Удалить способ оплаты',NULL,NULL),('Payment.PaymentBackend.Index',0,'Способы оплаты',NULL,NULL),('Payment.PaymentBackend.Management',1,'Управление способами оплаты',NULL,NULL),('Payment.PaymentBackend.Update',0,'Редактировать способ оплаты',NULL,NULL),('Payment.PaymentBackend.View',0,'Просмотреть способ оплаты',NULL,NULL),('Rbac.RbacBackend.Assign',0,'Назначение ролей',NULL,NULL),('Rbac.RbacBackend.Create',0,'Создание ролей',NULL,NULL),('Rbac.RbacBackend.Delete',0,'Удаление ролей',NULL,NULL),('Rbac.RbacBackend.Import',0,'Импорт правил из модулей',NULL,NULL),('Rbac.RbacBackend.Index',0,'Роли',NULL,NULL),('Rbac.RbacBackend.Update',0,'Редактирование ролей',NULL,NULL),('Rbac.RbacBackend.View',0,'Просмотр ролей',NULL,NULL),('Rbac.RbacManager',1,'Все роли',NULL,NULL),('Review.ReviewBackend.Create',0,'Добавление отзыва',NULL,NULL),('Review.ReviewBackend.Delete',0,'Удаление отзыва',NULL,NULL),('Review.ReviewBackend.Index',0,'Список отзывов',NULL,NULL),('Review.ReviewBackend.Inline',0,'Редактировать отзывы',NULL,NULL),('Review.ReviewBackend.Update',0,'Редактировать отзывы',NULL,NULL),('Review.ReviewBackend.View',0,'Просмотр отзывов',NULL,NULL),('Review.ReviewManager',1,'Управление отзывами',NULL,NULL),('SitemapModule.SitemapBackend.manage',0,'Управление картой сайта',NULL,NULL),('SitemapModule.SitemapManage',1,'Управление картой сайта',NULL,NULL),('Slider.SliderBackend.Index',0,'Index',NULL,NULL),('Slider.SliderManager',1,'Manage slider',NULL,NULL),('Stocks.StocksBackend.Create',0,'Создать акцию',NULL,NULL),('Stocks.StocksBackend.Delete',0,'Удалить акцию',NULL,NULL),('Stocks.StocksBackend.Index',0,'Список акций',NULL,NULL),('Stocks.StocksBackend.Update',0,'Редактирование акций',NULL,NULL),('Stocks.StocksBackend.View',0,'Просмотр акций',NULL,NULL),('Stocks.StocksManager',1,'Управление акциями',NULL,NULL),('Store.AttributeBackend.Create',0,'Добавить',NULL,NULL),('Store.AttributeBackend.Delete',0,'Удалить',NULL,NULL),('Store.AttributeBackend.Index',0,'Просмотреть список атрибутов',NULL,NULL),('Store.AttributeBackend.Management',1,'Управление атрибутами товара',NULL,NULL),('Store.AttributeBackend.Update',0,'Редактировать',NULL,NULL),('Store.AttributeBackend.View',0,'Просмотреть',NULL,NULL),('Store.CategoryBackend.Create',0,'Новая категория',NULL,NULL),('Store.CategoryBackend.Delete',0,'Удалить категорию',NULL,NULL),('Store.CategoryBackend.Index',0,'Просмотр списка категорий',NULL,NULL),('Store.CategoryBackend.Management',1,'Управление категориями товаров',NULL,NULL),('Store.CategoryBackend.Update',0,'Редактировать категорию',NULL,NULL),('Store.CategoryBackend.View',0,'Просмотреть категорию',NULL,NULL),('Store.Manager',2,'Управляющий каталогом товаров',NULL,NULL),('Store.ProducerBackend.Create',0,'Добавить',NULL,NULL),('Store.ProducerBackend.Delete',0,'Удалить производителя',NULL,NULL),('Store.ProducerBackend.Index',0,'Просмотреть список производителей',NULL,NULL),('Store.ProducerBackend.Management',1,'Все бренды',NULL,NULL),('Store.ProducerBackend.Update',0,'Редактировать производителя',NULL,NULL),('Store.ProducerBackend.View',0,'Просмотреть производителя',NULL,NULL),('Store.ProductBackend.Create',0,'Добавить товар',NULL,NULL),('Store.ProductBackend.Delete',0,'Удалить товар',NULL,NULL),('Store.ProductBackend.Index',0,'Просмотреть список товаров',NULL,NULL),('Store.ProductBackend.Management',1,'Все товары',NULL,NULL),('Store.ProductBackend.Update',0,'Изменить товар',NULL,NULL),('Store.ProductBackend.View',0,'Просмотреть товар',NULL,NULL),('Store.TypeBackend.Create',0,'Типы товаров',NULL,NULL),('Store.TypeBackend.Delete',0,'Удалить тип',NULL,NULL),('Store.TypeBackend.Index',0,'Типы товаров',NULL,NULL),('Store.TypeBackend.Management',1,'Управление типами товаров',NULL,NULL),('Store.TypeBackend.Update',0,'Редактировать тип',NULL,NULL),('Store.TypeBackend.View',0,'Просмотреть тип',NULL,NULL),('User.TokensBackend.Delete',0,'Удаление токена пользователя',NULL,NULL),('User.TokensBackend.Index',0,'Просмотр списка токенов пользователей',NULL,NULL),('User.TokensBackend.Update',0,'Редактирование токена пользователя',NULL,NULL),('User.TokensBackend.View',0,'Просмотр токена пользователя',NULL,NULL),('User.UserBackend.Changepassword',0,'Изменить пароль',NULL,NULL),('User.UserBackend.Create',0,'Создание пользователя',NULL,NULL),('User.UserBackend.Delete',0,'Удаление пользователя',NULL,NULL),('User.UserBackend.Index',0,'Просмотр списка пользователей',NULL,NULL),('User.UserBackend.Update',0,'Редактирование пользователя',NULL,NULL),('User.UserBackend.View',0,'Просмотр пользователя',NULL,NULL),('User.UserManager',1,'Все пользователи',NULL,NULL),('Yupe.Backend.Ajaxflush',0,'Очистка кеша и ресурсов (assets)',NULL,NULL),('Yupe.Backend.FlushDumpSettings',0,'Очистка кеша настроек',NULL,NULL),('Yupe.Backend.index',0,'Панель управления Юпи! Главная страница',NULL,NULL),('Yupe.Backend.Modulesettings',0,'Просмотр настроек модуля',NULL,NULL),('Yupe.Backend.Modupdate',0,'Обновление модуля',NULL,NULL),('Yupe.Backend.SaveModulesettings',0,'Изменение настроек модуля',NULL,NULL),('Yupe.Backend.Settings',0,'Просмотр списка модулей',NULL,NULL),('Yupe.Backend.Themesettings',0,'Изменение настроек темы',NULL,NULL),('Yupe.ModulesBackend.ConfigUpdate',0,'Обновление конфигурации модуля',NULL,NULL),('Yupe.ModulesBackend.ModuleStatus',0,'Обновление статуса модуля',NULL,NULL),('Zendsearch.ManageBackend.Index',0,'Переиндексация сайта',NULL,NULL),('ZendSearch.ZendSearchManager',1,'Управление поисковым индексом',NULL,NULL);
/*!40000 ALTER TABLE `yupe_user_user_auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_user_user_auth_item_child`
--

DROP TABLE IF EXISTS `yupe_user_user_auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_user_user_auth_item_child` (
  `parent` char(64) NOT NULL,
  `child` char(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `fk_yupe_user_user_auth_item_child_child` (`child`),
  CONSTRAINT `fk_yupe_user_user_auth_item_child_child` FOREIGN KEY (`child`) REFERENCES `yupe_user_user_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_yupe_user_user_auth_itemchild_parent` FOREIGN KEY (`parent`) REFERENCES `yupe_user_user_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_user_user_auth_item_child`
--

LOCK TABLES `yupe_user_user_auth_item_child` WRITE;
/*!40000 ALTER TABLE `yupe_user_user_auth_item_child` DISABLE KEYS */;
INSERT INTO `yupe_user_user_auth_item_child` VALUES ('Blog.BlogManager','Blog.BlogBackend.Create'),('Blog.BlogManager','Blog.BlogBackend.Delete'),('Blog.BlogManager','Blog.BlogBackend.Index'),('Blog.BlogManager','Blog.BlogBackend.Update'),('Blog.BlogManager','Blog.BlogBackend.View'),('Blog.BlogManager','Blog.PostBackend.Create'),('Blog.BlogManager','Blog.PostBackend.Delete'),('Blog.BlogManager','Blog.PostBackend.Index'),('Blog.BlogManager','Blog.PostBackend.Update'),('Blog.BlogManager','Blog.PostBackend.View'),('Blog.BlogManager','Blog.UserToBlogBackend.Create'),('Blog.BlogManager','Blog.UserToBlogBackend.Delete'),('Blog.BlogManager','Blog.UserToBlogBackend.Index'),('Blog.BlogManager','Blog.UserToBlogBackend.Update'),('Blog.BlogManager','Blog.UserToBlogBackend.View'),('Category.CategoryManager','Category.CategoryBackend.Create'),('Category.CategoryManager','Category.CategoryBackend.Delete'),('Category.CategoryManager','Category.CategoryBackend.Index'),('Category.CategoryManager','Category.CategoryBackend.Update'),('Category.CategoryManager','Category.CategoryBackend.View'),('Comment.CommentManager','Comment.CommentBackend.Create'),('Comment.CommentManager','Comment.CommentBackend.Delete'),('Comment.CommentManager','Comment.CommentBackend.Index'),('Comment.CommentManager','Comment.CommentBackend.Update'),('Comment.CommentManager','Comment.CommentBackend.View'),('ContentBlock.ContentBlockManager','ContentBlock.ContentblockBackend.Create'),('ContentBlock.ContentBlockManager','ContentBlock.ContentblockBackend.Delete'),('ContentBlock.ContentBlockManager','ContentBlock.ContentblockBackend.Index'),('ContentBlock.ContentBlockManager','ContentBlock.ContentblockBackend.Update'),('ContentBlock.ContentBlockManager','ContentBlock.ContentblockBackend.View'),('Coupon.CouponBackend.Management','Coupon.CouponBackend.Create'),('Coupon.CouponBackend.Management','Coupon.CouponBackend.Delete'),('Coupon.CouponBackend.Management','Coupon.CouponBackend.Index'),('Coupon.CouponBackend.Management','Coupon.CouponBackend.Update'),('Coupon.CouponBackend.Management','Coupon.CouponBackend.View'),('Dealers.DealersManager','Dealers.DealersBackend.Index'),('Delivery.DeliveryBackend.Management','Delivery.DeliveryBackend.Create'),('Delivery.DeliveryBackend.Management','Delivery.DeliveryBackend.Delete'),('Delivery.DeliveryBackend.Management','Delivery.DeliveryBackend.Index'),('Delivery.DeliveryBackend.Management','Delivery.DeliveryBackend.Update'),('Delivery.DeliveryBackend.Management','Delivery.DeliveryBackend.View'),('Feedback.FeedbackManager','Feedback.FeedbackBackend.Answer'),('Feedback.FeedbackManager','Feedback.FeedbackBackend.Create'),('Feedback.FeedbackManager','Feedback.FeedbackBackend.Delete'),('Feedback.FeedbackManager','Feedback.FeedbackBackend.Index'),('Feedback.FeedbackManager','Feedback.FeedbackBackend.Update'),('Feedback.FeedbackManager','Feedback.FeedbackBackend.View'),('Gallery.GalleryManager','Gallery.GalleryBackend.Addimages'),('Gallery.GalleryManager','Gallery.GalleryBackend.Create'),('Gallery.GalleryManager','Gallery.GalleryBackend.Delete'),('Gallery.GalleryManager','Gallery.GalleryBackend.DeleteImage'),('Gallery.GalleryManager','Gallery.GalleryBackend.Images'),('Gallery.GalleryManager','Gallery.GalleryBackend.Index'),('Gallery.GalleryManager','Gallery.GalleryBackend.Update'),('Gallery.GalleryManager','Gallery.GalleryBackend.View'),('ManageHomePage','Homepage.YupeBackend.Modulesettings'),('Image.ImageManager','Image.ImageBackend.Create'),('Image.ImageManager','Image.ImageBackend.Delete'),('Image.ImageManager','Image.ImageBackend.Index'),('Image.ImageManager','Image.ImageBackend.Update'),('Image.ImageManager','Image.ImageBackend.View'),('Mail.MailManager','Mail.EventBackend.Create'),('Mail.MailManager','Mail.EventBackend.Delete'),('Mail.MailManager','Mail.EventBackend.Index'),('Mail.MailManager','Mail.EventBackend.Update'),('Mail.MailManager','Mail.EventBackend.View'),('Mail.MailManager','Mail.TemplateBackend.Create'),('Mail.MailManager','Mail.TemplateBackend.Delete'),('Mail.MailManager','Mail.TemplateBackend.Index'),('Mail.MailManager','Mail.TemplateBackend.Update'),('Mail.MailManager','Mail.TemplateBackend.View'),('Menu.MenuManager','Menu.MenuBackend.Create'),('Menu.MenuManager','Menu.MenuBackend.Delete'),('Menu.MenuManager','Menu.MenuBackend.Index'),('Menu.MenuManager','Menu.MenuBackend.Update'),('Menu.MenuManager','Menu.MenuBackend.View'),('Menu.MenuManager','Menu.MenuitemBackend.Create'),('Menu.MenuManager','Menu.MenuitemBackend.Delete'),('Menu.MenuManager','Menu.MenuitemBackend.Index'),('Menu.MenuManager','Menu.MenuitemBackend.Update'),('Menu.MenuManager','Menu.MenuitemBackend.View'),('News.NewsManager','News.NewsBackend.Create'),('News.NewsManager','News.NewsBackend.Delete'),('News.NewsManager','News.NewsBackend.Index'),('News.NewsManager','News.NewsBackend.Update'),('News.NewsManager','News.NewsBackend.View'),('NotifyModule.NotifyManage','NotifyModule.NotifyManage.manage'),('Order.OrderBackend.Management','Order.OrderBackend.Create'),('Order.OrderBackend.Management','Order.OrderBackend.Delete'),('Order.OrderBackend.Management','Order.OrderBackend.Index'),('Order.OrderBackend.Management','Order.OrderBackend.Update'),('Order.OrderBackend.Management','Order.OrderBackend.View'),('Order.StatusBackend.Management','Order.StatusBackend.Create'),('Order.StatusBackend.Management','Order.StatusBackend.Delete'),('Order.StatusBackend.Management','Order.StatusBackend.Index'),('Order.StatusBackend.Management','Order.StatusBackend.Update'),('Page.PageManager','Page.PageBackend.Create'),('Page.PageManager','Page.PageBackend.Delete'),('Page.PageManager','Page.PageBackend.Index'),('Page.PageManager','Page.PageBackend.Update'),('Page.PageManager','Page.PageBackend.View'),('Payment.PaymentBackend.Management','Payment.PaymentBackend.Create'),('Payment.PaymentBackend.Management','Payment.PaymentBackend.Delete'),('Payment.PaymentBackend.Management','Payment.PaymentBackend.Index'),('Payment.PaymentBackend.Management','Payment.PaymentBackend.Update'),('Payment.PaymentBackend.Management','Payment.PaymentBackend.View'),('Rbac.RbacManager','Rbac.RbacBackend.Assign'),('Rbac.RbacManager','Rbac.RbacBackend.Create'),('Rbac.RbacManager','Rbac.RbacBackend.Delete'),('Rbac.RbacManager','Rbac.RbacBackend.Import'),('Rbac.RbacManager','Rbac.RbacBackend.Index'),('Rbac.RbacManager','Rbac.RbacBackend.Update'),('Rbac.RbacManager','Rbac.RbacBackend.View'),('Review.ReviewManager','Review.ReviewBackend.Create'),('Review.ReviewManager','Review.ReviewBackend.Delete'),('Review.ReviewManager','Review.ReviewBackend.Index'),('Review.ReviewManager','Review.ReviewBackend.Inline'),('Review.ReviewManager','Review.ReviewBackend.Update'),('Review.ReviewManager','Review.ReviewBackend.View'),('SitemapModule.SitemapManage','SitemapModule.SitemapBackend.manage'),('Slider.SliderManager','Slider.SliderBackend.Index'),('Stocks.StocksManager','Stocks.StocksBackend.Create'),('Stocks.StocksManager','Stocks.StocksBackend.Delete'),('Stocks.StocksManager','Stocks.StocksBackend.Index'),('Stocks.StocksManager','Stocks.StocksBackend.Update'),('Stocks.StocksManager','Stocks.StocksBackend.View'),('Store.AttributeBackend.Management','Store.AttributeBackend.Create'),('Store.AttributeBackend.Management','Store.AttributeBackend.Delete'),('Store.AttributeBackend.Management','Store.AttributeBackend.Index'),('Store.Manager','Store.AttributeBackend.Management'),('Store.AttributeBackend.Management','Store.AttributeBackend.Update'),('Store.AttributeBackend.Management','Store.AttributeBackend.View'),('Store.CategoryBackend.Management','Store.CategoryBackend.Create'),('Store.CategoryBackend.Management','Store.CategoryBackend.Delete'),('Store.CategoryBackend.Management','Store.CategoryBackend.Index'),('Store.Manager','Store.CategoryBackend.Management'),('Store.CategoryBackend.Management','Store.CategoryBackend.Update'),('Store.CategoryBackend.Management','Store.CategoryBackend.View'),('Store.ProducerBackend.Management','Store.ProducerBackend.Create'),('Store.ProducerBackend.Management','Store.ProducerBackend.Delete'),('Store.ProducerBackend.Management','Store.ProducerBackend.Index'),('Store.Manager','Store.ProducerBackend.Management'),('Store.ProducerBackend.Management','Store.ProducerBackend.Update'),('Store.ProducerBackend.Management','Store.ProducerBackend.View'),('Store.ProductBackend.Management','Store.ProductBackend.Create'),('Store.ProductBackend.Management','Store.ProductBackend.Delete'),('Store.ProductBackend.Management','Store.ProductBackend.Index'),('Store.Manager','Store.ProductBackend.Management'),('Store.ProductBackend.Management','Store.ProductBackend.Update'),('Store.ProductBackend.Management','Store.ProductBackend.View'),('Store.TypeBackend.Management','Store.TypeBackend.Create'),('Store.TypeBackend.Management','Store.TypeBackend.Delete'),('Store.TypeBackend.Management','Store.TypeBackend.Index'),('Store.Manager','Store.TypeBackend.Management'),('Store.TypeBackend.Management','Store.TypeBackend.Update'),('Store.TypeBackend.Management','Store.TypeBackend.View'),('User.UserManager','User.TokensBackend.Delete'),('User.UserManager','User.TokensBackend.Index'),('User.UserManager','User.TokensBackend.Update'),('User.UserManager','User.TokensBackend.View'),('User.UserManager','User.UserBackend.Changepassword'),('User.UserManager','User.UserBackend.Create'),('User.UserManager','User.UserBackend.Delete'),('User.UserManager','User.UserBackend.Index'),('User.UserManager','User.UserBackend.Update'),('User.UserManager','User.UserBackend.View'),('ManageYupeParams','Yupe.Backend.Ajaxflush'),('ManageYupeParams','Yupe.Backend.FlushDumpSettings'),('ManageYupeParams','Yupe.Backend.index'),('ManageYupeParams','Yupe.Backend.Modulesettings'),('ManageYupeParams','Yupe.Backend.Modupdate'),('ManageYupeParams','Yupe.Backend.SaveModulesettings'),('ManageYupeParams','Yupe.Backend.Settings'),('ManageYupeParams','Yupe.Backend.Themesettings'),('ManageYupeParams','Yupe.ModulesBackend.ConfigUpdate'),('ManageYupeParams','Yupe.ModulesBackend.ModuleStatus'),('ZendSearch.ZendSearchManager','Zendsearch.ManageBackend.Index');
/*!40000 ALTER TABLE `yupe_user_user_auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_video`
--

DROP TABLE IF EXISTS `yupe_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'Название',
  `code` text NOT NULL COMMENT 'Код видео',
  `image` varchar(255) DEFAULT NULL COMMENT 'Изображение(миниатюра)',
  `status` int(11) DEFAULT '0' COMMENT 'Статус',
  `position` int(11) DEFAULT NULL COMMENT 'Сортировка',
  `category_id` int(11) DEFAULT NULL COMMENT 'Категория',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_video`
--

LOCK TABLES `yupe_video` WRITE;
/*!40000 ALTER TABLE `yupe_video` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_video_category`
--

DROP TABLE IF EXISTS `yupe_video_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_video_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'Название',
  `status` int(11) DEFAULT '0' COMMENT 'Статус',
  `position` int(11) DEFAULT NULL COMMENT 'Сортировка',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_video_category`
--

LOCK TABLES `yupe_video_category` WRITE;
/*!40000 ALTER TABLE `yupe_video_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `yupe_video_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yupe_yupe_settings`
--

DROP TABLE IF EXISTS `yupe_yupe_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yupe_yupe_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` varchar(100) NOT NULL,
  `param_name` varchar(100) NOT NULL,
  `param_value` varchar(2500) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_yupe_yupe_settings_module_id_param_name_user_id` (`module_id`,`param_name`,`user_id`),
  KEY `ix_yupe_yupe_settings_module_id` (`module_id`),
  KEY `ix_yupe_yupe_settings_param_name` (`param_name`),
  KEY `fk_yupe_yupe_settings_user_id` (`user_id`),
  CONSTRAINT `fk_yupe_yupe_settings_user_id` FOREIGN KEY (`user_id`) REFERENCES `yupe_user_user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yupe_yupe_settings`
--

LOCK TABLES `yupe_yupe_settings` WRITE;
/*!40000 ALTER TABLE `yupe_yupe_settings` DISABLE KEYS */;
INSERT INTO `yupe_yupe_settings` VALUES (1,'yupe','siteDescription','','2019-12-20 10:03:01','2022-09-26 09:59:05',1,1),(2,'yupe','siteName','DJOYA','2019-12-20 10:03:01','2022-09-26 09:59:05',1,1),(3,'yupe','siteKeyWords','','2019-12-20 10:03:01','2021-05-05 11:46:15',1,1),(4,'yupe','email','','2019-12-20 10:03:01','2022-10-03 09:52:25',1,1),(5,'yupe','theme','default','2019-12-20 10:03:01','2019-12-20 10:03:01',1,1),(6,'yupe','backendTheme','','2019-12-20 10:03:01','2019-12-20 10:03:01',1,1),(7,'yupe','defaultLanguage','ru','2019-12-20 10:03:01','2019-12-20 10:03:01',1,1),(8,'yupe','defaultBackendLanguage','ru','2019-12-20 10:03:01','2019-12-20 10:03:01',1,1),(9,'homepage','mode','2','2019-12-20 10:35:25','2022-09-26 17:49:35',1,1),(10,'homepage','target','19','2019-12-20 10:35:25','2022-09-26 21:33:03',1,1),(11,'homepage','limit','','2019-12-20 10:35:25','2019-12-20 10:35:25',1,1),(12,'store','uploadPath','store','2019-12-23 12:41:32','2019-12-23 12:41:32',1,1),(13,'store','defaultImage','/images/nophoto.jpg','2019-12-23 12:41:32','2019-12-23 12:41:32',1,1),(14,'store','editor','','2019-12-23 12:41:32','2021-05-18 13:55:18',1,1),(15,'store','itemsPerPage','24','2019-12-23 12:41:32','2022-11-09 16:23:00',1,1),(16,'store','phone','','2019-12-23 12:41:32','2019-12-23 12:41:32',1,1),(17,'store','email','','2019-12-23 12:41:32','2019-12-23 12:41:32',1,1),(18,'store','currency','RUB','2019-12-23 12:41:32','2019-12-23 12:41:32',1,1),(19,'store','title','','2019-12-23 12:41:32','2022-03-10 14:57:34',1,1),(20,'store','address','','2019-12-23 12:41:32','2019-12-23 12:41:32',1,1),(21,'store','city','','2019-12-23 12:41:32','2019-12-23 12:41:32',1,1),(22,'store','zipcode','','2019-12-23 12:41:32','2019-12-23 12:41:32',1,1),(23,'store','defaultSort','visits','2019-12-23 12:41:32','2020-02-26 23:03:42',1,1),(24,'store','defaultSortDirection','DESC','2019-12-23 12:41:32','2020-02-26 23:03:54',1,1),(25,'store','metaTitle','','2019-12-23 12:41:32','2022-10-03 11:09:23',1,1),(26,'store','metaDescription','','2019-12-23 12:41:32','2022-10-03 11:09:23',1,1),(27,'store','metaKeyWords','','2019-12-23 12:41:32','2019-12-23 12:41:32',1,1),(28,'store','controlStockBalances','','2019-12-23 12:41:32','2019-12-23 12:41:32',1,1),(29,'store','mostInteresting','','2019-12-23 12:41:32','2021-05-12 15:12:17',1,1),(30,'store','newId','','2019-12-23 12:41:32','2020-09-25 12:26:11',1,1),(31,'store','stockId','','2019-12-23 12:41:32','2020-03-01 14:59:56',1,1),(32,'store','saleId','','2019-12-23 12:41:32','2020-09-25 12:26:11',1,1),(33,'product','pageSize','100','2019-12-24 17:01:11','2019-12-24 17:01:11',1,2),(34,'menuitem','pageSize','50','2020-02-04 09:39:49','2020-02-04 09:39:49',1,2),(35,'contentblock','pageSize','20','2020-02-04 09:45:28','2020-02-04 09:45:28',1,2),(36,'storecategory','pageSize','100','2020-02-09 03:31:21','2020-02-09 03:31:21',1,2),(37,'yupe','coreCacheTime','3600','2020-02-14 20:40:33','2020-02-14 20:40:33',1,1),(38,'yupe','uploadPath','uploads','2020-02-14 20:40:33','2020-02-14 20:40:33',1,1),(39,'yupe','editor','tinymce5','2020-02-14 20:40:33','2021-05-18 13:51:09',1,1),(40,'yupe','availableLanguages','ru,en','2020-02-14 20:40:33','2020-02-14 20:40:33',1,1),(41,'yupe','allowedIp','','2020-02-14 20:40:33','2020-02-14 20:40:33',1,1),(42,'yupe','hidePanelUrls','0','2020-02-14 20:40:33','2020-02-14 20:40:33',1,1),(43,'yupe','logo','images/logo.png','2020-02-14 20:40:33','2020-02-14 20:40:33',1,1),(44,'yupe','allowedExtensions','gif, jpeg, png, jpg, zip, rar, doc, docx, xls, xlsx, pdf','2020-02-14 20:40:33','2020-02-14 20:40:33',1,1),(45,'yupe','mimeTypes','image/gif,image/jpeg,image/png,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/zip,application/x-rar,application/x-rar-compressed, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','2020-02-14 20:40:33','2020-02-14 20:40:33',1,1),(46,'yupe','maxSize','5242880','2020-02-14 20:40:33','2020-02-14 20:40:33',1,1),(47,'yupe','defaultImage','/images/nophoto.jpg','2020-02-14 20:40:33','2020-02-14 20:40:33',1,1),(48,'user','avatarMaxSize','5242880','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(49,'user','avatarExtensions','jpg,png,gif,jpeg','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(50,'user','defaultAvatarPath','images/avatar.png','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(51,'user','avatarsDir','avatars','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(52,'user','showCaptcha','0','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(53,'user','minCaptchaLength','3','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(54,'user','maxCaptchaLength','6','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(55,'user','minPasswordLength','8','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(56,'user','autoRecoveryPassword','0','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(57,'user','recoveryDisabled','0','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(58,'user','registrationDisabled','0','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(59,'user','notifyEmailFrom','no-reply@anvikor.ru','2020-03-12 19:25:51','2020-09-17 09:51:51',1,1),(60,'user','logoutSuccess','/','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(61,'user','loginSuccess','/','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(62,'user','accountActivationSuccess','/user/account/login','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(63,'user','accountActivationFailure','/user/account/registration','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(64,'user','loginAdminSuccess','/yupe/backend/index','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(65,'user','registrationSuccess','/user/account/login','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(66,'user','sessionLifeTime','7','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(67,'user','usersPerPage','20','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(68,'user','emailAccountVerification','1','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(69,'user','badLoginCount','3','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(70,'user','phoneMask','+7-999-999-9999','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(71,'user','phonePattern','/^((\\+?7)(-?\\d{3})-?)?(\\d{3})(-?\\d{4})$/','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(72,'user','generateNickName','1','2020-03-12 19:25:51','2020-03-12 19:25:51',1,1),(73,'review','itemsperpage','2','2020-07-26 22:37:41','2020-07-26 22:37:41',1,1),(74,'review','itemsperpagefront','0','2020-07-26 22:37:41','2020-07-26 22:37:41',1,1),(75,'review','moderation','1','2020-07-26 22:37:41','2020-07-26 22:37:41',1,1),(76,'review','email_from','','2020-07-26 22:37:41','2020-07-26 22:37:41',1,1),(77,'review','email_notification','','2020-07-26 22:37:41','2020-07-26 22:37:41',1,1),(78,'review','adminMenuOrder','0','2020-07-26 22:37:41','2020-07-26 22:37:41',1,1),(79,'review','metaTitle','','2020-07-26 22:37:41','2022-11-08 10:41:16',1,1),(80,'review','metaDescription','','2020-07-26 22:37:41','2022-11-08 10:41:16',1,1),(81,'review','metaKeyWords','','2020-07-26 22:37:41','2020-07-26 22:37:41',1,1),(82,'order','notifyEmailFrom','no-reply@djoya.ru','2020-09-17 09:52:28','2022-10-03 16:21:25',1,1),(83,'order','notifyEmailsTo','tyumikov.ivan@yandex.ru','2020-09-17 09:52:28','2022-10-03 16:21:25',1,1),(84,'order','showOrder','1','2020-09-17 09:52:28','2020-09-17 09:52:28',1,1),(85,'order','enableCheck','1','2020-09-17 09:52:28','2020-09-17 09:52:28',1,1),(86,'order','defaultStatus','1','2020-09-17 09:52:28','2020-09-17 09:52:28',1,1),(87,'order','enableComments','1','2020-09-17 09:52:28','2020-09-17 09:52:28',1,1),(88,'yupe','idYandexMetrika','','2020-09-24 22:42:44','2021-05-05 11:46:06',1,1),(89,'yupe','script','','2020-09-24 22:42:44','2020-09-24 22:42:44',1,1),(90,'feedback','showCaptcha','0','2020-09-25 16:09:45','2020-09-25 16:09:45',1,1),(91,'feedback','sendConfirmation','0','2020-09-25 16:09:45','2020-09-25 16:09:45',1,1),(92,'feedback','notifyEmailFrom','no-reply@djoya.ru','2020-09-25 16:09:45','2022-11-08 10:41:40',1,1),(93,'feedback','emails','tyumikov.ivan@yandex.ru','2020-09-25 16:09:45','2022-11-08 10:41:40',1,1),(94,'feedback','successPage','','2020-09-25 16:09:45','2020-09-25 16:09:45',1,1),(95,'feedback','cacheTime','60','2020-09-25 16:09:45','2020-09-25 16:09:45',1,1),(96,'feedback','mainCategory','','2020-09-25 16:09:45','2020-09-25 16:09:45',1,1),(97,'feedback','minCaptchaLength','3','2020-09-25 16:09:45','2020-09-25 16:09:45',1,1),(98,'feedback','maxCaptchaLength','6','2020-09-25 16:09:45','2020-09-25 16:09:45',1,1),(99,'city','itemsPerCity_1','0','2020-09-28 14:51:11','2022-09-26 22:11:35',1,1),(100,'yupe','phone1','','2020-09-28 19:59:20','2022-10-03 09:52:25',1,1),(101,'yupe','phone2','','2020-09-28 19:59:20','2022-10-03 09:52:25',1,1),(102,'yupe','time','','2020-09-28 19:59:20','2022-10-03 09:52:25',1,1),(103,'yupe','dayWork','','2020-09-28 19:59:20','2022-10-03 09:52:25',1,1),(104,'yupe','adress','','2020-09-28 19:59:20','2020-09-28 19:59:20',1,1),(105,'yupe','adress1','','2020-09-28 20:09:36','2022-10-03 09:52:25',1,1),(106,'yupe','adress2','','2020-09-28 20:09:36','2022-10-03 09:52:25',1,1),(107,'yupe','adress3','','2020-09-28 20:09:36','2022-10-03 09:52:25',1,1),(108,'amocrm','clientId','6076c264-5637-4cb4-8d19-519dc3f5398e','2020-11-14 23:31:22','2021-06-01 17:35:44',1,1),(109,'amocrm','clientSecret','LXvY61bGzLfKDApNUr38GXwiAlNw1PmvyiqyQvbWdKq3aEkbEriPVzWzOkIrxr87','2020-11-14 23:31:22','2021-06-01 17:35:44',1,1),(110,'amocrm','redirectUri','https://hoods.anvikor.ru/backend/amocrm/amocrm','2020-11-14 23:31:22','2021-06-01 17:35:44',1,1),(111,'amocrm','access_token','eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImVlYTJjZTU3ODlmYjNkMjc5YTljODBiZmYzMzcxYjNhNDdlNTdmNWRkYjFkMTQ3MDI4YzQxNGVjZDZhNjU5YjEwZjcxNWYxNDllMWUxMzhmIn0.eyJhdWQiOiI2MDc2YzI2NC01NjM3LTRjYjQtOGQxOS01MTlkYzNmNTM5OGUiLCJqdGkiOiJlZWEyY2U1Nzg5ZmIzZDI3OWE5YzgwYmZmMzM3MWIzYTQ3ZTU3ZjVkZGIxZDE0NzAyOGM0MTRlY2Q2YTY1OWIxMGY3MTVmMTQ5ZTFlMTM4ZiIsImlhdCI6MTYyMjczNjA5MywibmJmIjoxNjIyNzM2MDkzLCJleHAiOjE2MjI4MjI0OTEsInN1YiI6IjM3MTU4MTAiLCJhY2NvdW50X2lkIjoyOTExMzg4OCwic2NvcGVzIjpbInB1c2hfbm90aWZpY2F0aW9ucyIsImNybSIsIm5vdGlmaWNhdGlvbnMiXX0.LaUDyq7HXtjCVS-WyQoqdP8qdv-w_QJI9VvSBd1757uwv6g9Imb6y4UBZz-kSimfhLnCLZDn-hi6RQfvx1yNVN7APdco1wMeYsrH7rqxqvYS6HS6CY6M3XdzTVuj0mEAJJDX77PwhQrTYY9l3fJJhHycl_606WXKEWp2h29uSBtRU9oZdeoCPKFvdP1CeQIq4WOQrTeI1oH0eZgjvy9EzbyxYMw_zZ2wlj503p2jW5R_g-j8S-Dqn484XuD9k1TP7hK8Q99PjEyG_mC5S3q7s1g2yMKWwI_RWfTl9tQBzWUEe5S9lPFqWXwH5YE056HWgeSMGklo66OoK0Fry2M6sQ','2020-11-15 01:28:43','2021-06-03 21:01:33',NULL,1),(112,'amocrm','refresh_token','def50200d542ce20dce6017ae837b9b2a05065cf79d8791f354ab30e704bb34275ff2439b392307707d11f9c850cb9670a4d9a2b2f87819ed4c3539d709867b586e346ff43eeb8f32b67d7ba7f1eb27787a519a45469dde41583f84244ee6fb8bde7b0cc08573b8afd864745b5cf47b5d32d0b35ada7ad7263f7fdb545229f745eecc45fe6c3f27240096aa47c6046e8df24c2d5ccd06bcb4723b3cfbbef2ab476f1c8a66c14f2e772fedfc1ba10ac25cdf0776f30f0a94e294cfd748ef3aa03c87c1cefbb4f15cb3d3be4a467dcff1fc7e8c7f2233750e9f3a2ecaeccf068498bb207f4784b0b0794798efae88d4898df0acefb8834523e9f90947d32fe7d6833491b1f88e0dc221649a57d64f3cbac0de64dc67ad77360a90963314a5a23342cb0a4e765d1178d159ec6437494bcdb10bcc188e56d11c38d81718820fc02c83d681211a3297c9f0bc8b5425d22ca7e32c3a27928f20c70c7748b5f6a6ff96f86de7fb63ca0d5e4e5b3fa3e655bbcf7bac2454186b4fce5eaa377ad1b6f0d19b6586841261c4d34fb06e2606eaad3daae227defa5f8a1646f4af7acb80d8abc026a82a2f7cbb0c17943d0ac649df573a20237d946e9dc6b99c395b09eab9cacaf5fc0b5f79b5d332829','2020-11-15 01:34:33','2021-06-03 21:01:33',NULL,1),(113,'amocrm','expires','1622822491','2020-11-15 01:34:33','2021-06-03 21:01:32',NULL,1),(114,'amocrm','baseDomain','anvikor.amocrm.ru','2020-11-15 01:34:33','2021-06-01 17:35:52',1,1),(115,'attributestore','pageSize','50','2021-05-06 12:11:27','2021-05-06 12:11:27',1,2),(116,'yupe','map','https://yandex.ru/map-widget/v1/?um=constructor%3Aae4aa8a920f533e3b4612a509c761d43041da6f94b1115f7e0de245f7c0debce&amp;source=constructor;scroll=false','2021-05-12 15:46:57','2022-11-03 21:51:55',1,1),(117,'page','editor','','2021-05-18 12:33:32','2021-05-18 12:33:53',1,1),(118,'page','mainCategory','','2021-05-18 12:33:32','2021-05-18 12:33:32',1,1),(119,'store','smallImgWidth','70','2021-05-26 10:30:44','2021-05-26 10:30:44',1,1),(120,'store','smallImgHeight','93','2021-05-26 10:30:44','2021-05-26 10:30:44',1,1),(121,'store','imgWidth','405','2021-05-26 10:30:44','2021-05-26 10:30:44',1,1),(122,'store','imgHeight','536','2021-05-26 10:30:44','2021-05-26 10:30:44',1,1),(123,'yupe','whatsapp','','2021-07-19 09:42:41','2022-10-03 09:52:25',1,1),(124,'yupe','telegram','','2021-07-19 09:42:41','2022-10-03 09:52:25',1,1),(125,'yupe','viber','','2021-07-19 09:42:41','2022-10-03 09:52:25',1,1),(126,'coupon','categoryId','19,20,21,28,22,25,26,27,29,30,31,32','2021-08-09 15:53:57','2021-10-29 18:38:39',1,1),(127,'order','pageSize','100','2021-09-27 12:24:48','2021-09-27 12:24:48',1,2),(128,'page','pageSize','100','2021-12-14 10:56:10','2021-12-14 10:56:10',1,2),(129,'image','uploadPath','image','2021-12-17 12:37:05','2021-12-17 12:37:05',1,1),(130,'image','allowedExtensions','jpg,jpeg,png,gif,mp4','2021-12-17 12:37:05','2021-12-17 12:37:05',1,1),(131,'image','minSize','0','2021-12-17 12:37:05','2021-12-17 12:37:05',1,1),(132,'image','maxSize','20971520','2021-12-17 12:37:05','2021-12-17 12:37:21',1,1),(133,'image','mainCategory','','2021-12-17 12:37:05','2021-12-17 12:37:05',1,1),(134,'image','mimeTypes','image/gif, image/jpeg, image/png, video/mp4','2021-12-17 12:37:05','2021-12-17 12:37:30',1,1),(135,'image','width','950','2021-12-17 12:37:05','2021-12-17 12:37:05',1,1),(136,'image','height','950','2021-12-17 12:37:05','2021-12-17 12:37:05',1,1),(137,'yupe','classmates','','2022-03-14 10:07:50','2022-10-03 09:52:25',1,1),(138,'coupon','pageSize','100','2022-03-28 23:59:12','2022-03-28 23:59:12',1,2),(139,'stocks','editor','','2022-06-14 16:18:56','2022-06-14 16:18:56',1,1),(140,'stocks','uploadPath','stocks','2022-06-14 16:18:56','2022-06-14 16:18:56',1,1),(141,'stocks','allowedExtensions','jpg,jpeg,png,gif','2022-06-14 16:18:56','2022-06-14 16:18:56',1,1),(142,'stocks','minSize','0','2022-06-14 16:18:56','2022-06-14 16:18:56',1,1),(143,'stocks','maxSize','5368709120','2022-06-14 16:18:56','2022-06-14 16:18:56',1,1),(144,'stocks','title','Акции на вытяжки Anvikor[[w:CityReplacement|caseRus=предложный;pretext=в;displayOnMain=false;]]','2022-06-14 16:18:56','2022-06-14 16:18:56',1,1),(145,'stocks','description','Скидки на вытяжки Анвикор[[w:CityReplacement|caseRus=предложный;pretext=в;displayOnMain=false;]]. Официальная гарантия 1 год. Доставка по всей России! Купить вытяжки Anvikor для маникюра и педикюра по акции. Скидки и специальные предложения: именинникам, оптовикам, при покупке от трех штук','2022-06-14 16:18:56','2022-06-14 16:18:56',1,1),(146,'post','pageSize','100','2022-06-21 14:54:59','2022-06-21 14:54:59',1,2),(147,'video','pageSize','10','2022-07-05 17:22:19','2022-07-05 17:22:19',1,2);
/*!40000 ALTER TABLE `yupe_yupe_settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!50112 SET @disable_bulk_load = IF (@is_rocksdb_supported, 'SET SESSION rocksdb_bulk_load = @old_rocksdb_bulk_load', 'SET @dummy_rocksdb_bulk_load = 0') */;
/*!50112 PREPARE s FROM @disable_bulk_load */;
/*!50112 EXECUTE s */;
/*!50112 DEALLOCATE PREPARE s */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-21 14:56:45
