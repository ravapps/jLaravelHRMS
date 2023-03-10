-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: laravel_h
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account_lists`
--

DROP TABLE IF EXISTS `account_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_lists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `initial_balance` double NOT NULL DEFAULT '0',
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_branch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_lists`
--

LOCK TABLES `account_lists` WRITE;
/*!40000 ALTER TABLE `account_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `account_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `allowance_options`
--

DROP TABLE IF EXISTS `allowance_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `allowance_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `al_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `limit_month` double NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `allowance_options`
--

LOCK TABLES `allowance_options` WRITE;
/*!40000 ALTER TABLE `allowance_options` DISABLE KEYS */;
INSERT INTO `allowance_options` VALUES (4,'Test','Percentage','20',100,2,'2021-01-07 02:53:02','2021-01-07 02:53:02'),(5,'Test User','Fixed','20',1111,2,'2021-06-18 07:17:17','2021-06-18 07:17:17');
/*!40000 ALTER TABLE `allowance_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `allowances`
--

DROP TABLE IF EXISTS `allowances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `allowances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `allowance_option` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `allowances`
--

LOCK TABLES `allowances` WRITE;
/*!40000 ALTER TABLE `allowances` DISABLE KEYS */;
INSERT INTO `allowances` VALUES (1,1,3,'T',5,2,'2020-12-29 22:02:32','2020-12-29 22:02:32'),(2,2,4,'Test',22,2,'2021-01-12 01:30:47','2021-01-12 01:30:47'),(3,5,4,'Test',100,2,'2021-06-29 03:00:02','2021-06-29 03:00:02');
/*!40000 ALTER TABLE `allowances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcement_employees`
--

DROP TABLE IF EXISTS `announcement_employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcement_employees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `announcement_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcement_employees`
--

LOCK TABLES `announcement_employees` WRITE;
/*!40000 ALTER TABLE `announcement_employees` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcement_employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `branch_id` int NOT NULL,
  `department_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
INSERT INTO `announcements` VALUES (2,'Test','Pending','2021-01-08','0000-00-00',0,'','','',2,'2021-01-15 00:51:18','2021-01-15 00:51:18');
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appraisals`
--

DROP TABLE IF EXISTS `appraisals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appraisals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch` int NOT NULL DEFAULT '0',
  `employee` int NOT NULL DEFAULT '0',
  `appraisal_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_experience` int NOT NULL DEFAULT '0',
  `marketing` int NOT NULL DEFAULT '0',
  `administration` int NOT NULL DEFAULT '0',
  `professionalism` int NOT NULL DEFAULT '0',
  `integrity` int NOT NULL DEFAULT '0',
  `attendance` int NOT NULL DEFAULT '0',
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appraisals`
--

LOCK TABLES `appraisals` WRITE;
/*!40000 ALTER TABLE `appraisals` DISABLE KEYS */;
/*!40000 ALTER TABLE `appraisals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` date NOT NULL,
  `supported_date` date NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assets`
--

LOCK TABLES `assets` WRITE;
/*!40000 ALTER TABLE `assets` DISABLE KEYS */;
INSERT INTO `assets` VALUES (1,'Test','2020-12-30','2020-12-30',2444,'Test',2,'2020-12-30 02:18:41','2020-12-30 02:18:41'),(2,'Test','2021-06-18','2021-06-18',100,'',2,'2021-06-18 07:47:07','2021-06-18 07:47:07');
/*!40000 ALTER TABLE `assets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assign_emp_document`
--

DROP TABLE IF EXISTS `assign_emp_document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assign_emp_document` (
  `id` int NOT NULL AUTO_INCREMENT,
  `document_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `read_flag` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assign_emp_document`
--

LOCK TABLES `assign_emp_document` WRITE;
/*!40000 ALTER TABLE `assign_emp_document` DISABLE KEYS */;
INSERT INTO `assign_emp_document` VALUES (3,1,2,'0','2021-01-18 06:02:38',2),(4,1,3,'0','2021-01-18 06:02:38',2),(5,1,4,'0','2021-06-18 01:17:57',2);
/*!40000 ALTER TABLE `assign_emp_document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assign_emp_policy`
--

DROP TABLE IF EXISTS `assign_emp_policy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assign_emp_policy` (
  `id` int NOT NULL AUTO_INCREMENT,
  `document_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `read_flag` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assign_emp_policy`
--

LOCK TABLES `assign_emp_policy` WRITE;
/*!40000 ALTER TABLE `assign_emp_policy` DISABLE KEYS */;
INSERT INTO `assign_emp_policy` VALUES (1,1,2,'0','2021-01-18 05:58:24',2),(2,1,3,'0','2021-01-18 06:03:38',2),(3,2,2,'0','2021-01-18 06:04:54',2),(4,2,3,'0','2021-01-18 06:04:54',2),(5,1,4,'0','2021-06-18 04:09:30',2);
/*!40000 ALTER TABLE `assign_emp_policy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendance_employees`
--

DROP TABLE IF EXISTS `attendance_employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendance_employees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift_id` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_hrs` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `clock_in` time NOT NULL,
  `clock_out` time NOT NULL,
  `late` time NOT NULL,
  `early_leaving` time NOT NULL,
  `overtime` time NOT NULL,
  `total_rest` time NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance_employees`
--

LOCK TABLES `attendance_employees` WRITE;
/*!40000 ALTER TABLE `attendance_employees` DISABLE KEYS */;
INSERT INTO `attendance_employees` VALUES (3,3,'2021-01-12','Present','','-1','13:20:00','13:20:00','04:20:00','04:40:00','00:00:00','00:00:00',2,'2021-01-07 02:18:24','2021-01-07 02:18:24'),(4,2,'2021-06-22','Present','3','-15','17:00:00','03:00:00','00:00:00','00:00:00','00:00:00','00:00:00',2,'2021-06-22 04:39:08','2021-06-22 04:39:08');
/*!40000 ALTER TABLE `attendance_employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `award_types`
--

DROP TABLE IF EXISTS `award_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `award_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `award_types`
--

LOCK TABLES `award_types` WRITE;
/*!40000 ALTER TABLE `award_types` DISABLE KEYS */;
INSERT INTO `award_types` VALUES (1,'Commission',2,'2021-01-07 03:01:48','2021-01-07 03:01:57');
/*!40000 ALTER TABLE `award_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awards`
--

DROP TABLE IF EXISTS `awards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awards` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `award_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `gift` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awards`
--

LOCK TABLES `awards` WRITE;
/*!40000 ALTER TABLE `awards` DISABLE KEYS */;
/*!40000 ALTER TABLE `awards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES (1,'IT',2,'2020-12-06 16:50:38','2020-12-06 16:50:57'),(2,'Facility',2,'2021-09-01 07:00:38','2021-09-14 02:27:17');
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `claims`
--

DROP TABLE IF EXISTS `claims`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `claims` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `documents` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `claimdate` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `claims`
--

LOCK TABLES `claims` WRITE;
/*!40000 ALTER TABLE `claims` DISABLE KEYS */;
INSERT INTO `claims` VALUES (4,2,'MyFirst',0,'for site visit','Pending','sample_1630481752.pdf#sample_1630482253.pdf',2,'2021-09-01 02:02:39','2021-09-01 02:14:13','2021-09-01');
/*!40000 ALTER TABLE `claims` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `claims_items`
--

DROP TABLE IF EXISTS `claims_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `claims_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `claim_id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `qty` int NOT NULL,
  `price` int NOT NULL,
  `tax` varchar(3) DEFAULT NULL,
  `remark` text,
  `documents` text,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `claims_items`
--

LOCK TABLES `claims_items` WRITE;
/*!40000 ALTER TABLE `claims_items` DISABLE KEYS */;
INSERT INTO `claims_items` VALUES (1,4,'Petrol',5,91,'Yes','for bike fuel','sample_1630481752.pdf',2,'2021-09-01 02:02:40','2021-09-01 02:02:40'),(2,4,'Lonch',1,130,'No','Lunch in way','',2,'2021-09-01 02:02:40','2021-09-01 02:02:40');
/*!40000 ALTER TABLE `claims_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commissions`
--

DROP TABLE IF EXISTS `commissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `documents` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commissions`
--

LOCK TABLES `commissions` WRITE;
/*!40000 ALTER TABLE `commissions` DISABLE KEYS */;
INSERT INTO `commissions` VALUES (4,2,'3',22,'Test test','Pending','invoice-7_1610008895.pdf',2,'2021-01-07 03:11:12','2021-01-07 03:11:52'),(5,3,'3',22,'Test','Pending','5fad08f809b9c_1610008872.png',2,'2021-01-07 03:11:12','2021-01-07 03:11:12');
/*!40000 ALTER TABLE `commissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_policies`
--

DROP TABLE IF EXISTS `company_policies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_policies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_policies`
--

LOCK TABLES `company_policies` WRITE;
/*!40000 ALTER TABLE `company_policies` DISABLE KEYS */;
INSERT INTO `company_policies` VALUES (1,1,'Test','',NULL,2,'2021-01-15 00:01:16','2021-01-15 00:01:16'),(2,1,'Testt','',NULL,2,'2021-01-18 00:34:45','2021-01-18 00:34:45');
/*!40000 ALTER TABLE `company_policies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complaints`
--

DROP TABLE IF EXISTS `complaints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `complaints` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `complaint_from` int NOT NULL,
  `complaint_against` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `complaint_date` date NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complaints`
--

LOCK TABLES `complaints` WRITE;
/*!40000 ALTER TABLE `complaints` DISABLE KEYS */;
/*!40000 ALTER TABLE `complaints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double(8,2) NOT NULL DEFAULT '0.00',
  `limit` int NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_active` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deduction_options`
--

DROP TABLE IF EXISTS `deduction_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deduction_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deduct_amt` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=991 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deduction_options`
--

LOCK TABLES `deduction_options` WRITE;
/*!40000 ALTER TABLE `deduction_options` DISABLE KEYS */;
INSERT INTO `deduction_options` VALUES (1,'Government Tax',2,'2020-12-06 16:50:38','2021-09-06 03:50:22','5'),(2,'TDS',2,'2020-12-06 16:50:38','2021-09-06 03:50:51','4'),(987,'Others',2,'2020-12-06 16:50:38','2021-09-06 03:50:36','0'),(990,'Test 21',2,'2021-09-14 02:48:46','2021-09-14 02:48:53','5');
/*!40000 ALTER TABLE `deduction_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,1,'Tech Support',2,'2020-12-06 16:51:15','2020-12-06 16:51:15'),(3,2,'Cleaning',2,'2021-09-01 07:02:01','2021-09-01 07:02:01');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deposits`
--

DROP TABLE IF EXISTS `deposits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deposits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `amount` int NOT NULL,
  `date` date NOT NULL,
  `income_category_id` int NOT NULL,
  `payer_id` int NOT NULL,
  `payment_type_id` int NOT NULL,
  `referal_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deposits`
--

LOCK TABLES `deposits` WRITE;
/*!40000 ALTER TABLE `deposits` DISABLE KEYS */;
/*!40000 ALTER TABLE `deposits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `designations`
--

DROP TABLE IF EXISTS `designations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `designations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `designations`
--

LOCK TABLES `designations` WRITE;
/*!40000 ALTER TABLE `designations` DISABLE KEYS */;
INSERT INTO `designations` VALUES (1,1,'Technical person',2,'2020-12-06 16:53:53','2020-12-06 16:53:53'),(2,1,'Technical Expert',2,'2020-12-16 07:25:19','2020-12-16 07:25:19'),(4,3,'Supervisor',2,'2021-09-01 07:02:51','2021-09-01 07:02:51'),(5,3,'Worker',2,'2021-09-01 07:03:30','2021-09-01 07:03:30');
/*!40000 ALTER TABLE `designations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_images`
--

DROP TABLE IF EXISTS `document_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `document_id` varchar(20) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `created_by` int NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_images`
--

LOCK TABLES `document_images` WRITE;
/*!40000 ALTER TABLE `document_images` DISABLE KEYS */;
INSERT INTO `document_images` VALUES (1,'1','pro_1610692069.csv',2,'2021-01-15 06:27:48'),(2,'1','invoice-7_1610692110.pdf',2,'2021-01-15 06:28:30');
/*!40000 ALTER TABLE `document_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_required` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ducument_uploads`
--

DROP TABLE IF EXISTS `ducument_uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ducument_uploads` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ducument_uploads`
--

LOCK TABLES `ducument_uploads` WRITE;
/*!40000 ALTER TABLE `ducument_uploads` DISABLE KEYS */;
INSERT INTO `ducument_uploads` VALUES (1,'Test','0',NULL,NULL,2,'2021-01-15 00:57:48','2021-01-15 00:57:48');
/*!40000 ALTER TABLE `ducument_uploads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_addresses`
--

DROP TABLE IF EXISTS `emp_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_addresses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `postalcode` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `building` varchar(255) NOT NULL,
  `unitfrm` varchar(20) NOT NULL,
  `unitto` varchar(20) DEFAULT NULL,
  `address_type` char(1) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_addresses`
--

LOCK TABLES `emp_addresses` WRITE;
/*!40000 ALTER TABLE `emp_addresses` DISABLE KEYS */;
INSERT INTO `emp_addresses` VALUES (12,15,'sadsadasd','sadasd','sadasd','asdas','','C','2021-09-07 12:26:57'),(13,15,'sadsad','asdasd','asdasd','asdasd','','P','2021-09-07 12:26:57'),(17,16,'sfsdfsd','sdfsdf','sdfsdf','fdsdsfsd','','C','2021-09-14 07:34:46'),(18,16,'sdfsdf','sfsdfs','sdfsdfs','sdfsdf','','P','2021-09-14 07:34:46'),(19,9,'12345','current street','current build','123','','C','2021-09-14 08:45:53'),(20,9,'76890','permanent street','perm built','456','','P','2021-09-14 08:45:53'),(23,7,'140507','Punjab India','sdfsdfs','345345','','P','2021-09-14 09:52:37'),(24,8,'140507','Punjab India','sdfsdf','234324','','P','2021-09-14 09:54:11'),(25,12,'2342342','sdasda','zdasd','23423','','P','2021-09-14 09:56:17'),(26,13,'3453455','RRRR','DDDDD','01','222','C','2021-09-14 09:57:19'),(27,13,'43545435','01-05, CHOA CHU KANG LIAN HE TEMPLE 11 CHOA CHU KANG STREET 51','DD','3434','33','P','2021-09-14 09:57:19'),(28,14,'3434343','fdfdfd','dfdf','32323','','C','2021-09-14 09:59:00'),(29,14,'34343','dfdfd','dfdfd','2323','','P','2021-09-14 09:59:00'),(30,5,'140507','Punjab India','asas','2424','','P','2021-09-14 10:42:49'),(37,6,'140507','Punjab India','perm built','53453','','P','2021-09-14 11:22:41');
/*!40000 ALTER TABLE `emp_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_bank_info`
--

DROP TABLE IF EXISTS `emp_bank_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_bank_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_account_no` varchar(255) NOT NULL,
  `bank_branch_code` varchar(255) NOT NULL,
  `unique_no` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `bank_pay_now` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_bank_info`
--

LOCK TABLES `emp_bank_info` WRITE;
/*!40000 ALTER TABLE `emp_bank_info` DISABLE KEYS */;
INSERT INTO `emp_bank_info` VALUES (12,'15','sadasd','asdasd','asdasd','','2021-09-07 12:26:57',''),(15,'16','sdfsd','ffsdfsdf','sdfsfsdf','','2021-09-14 07:34:46',''),(16,'9','Mumbai bank','23423423423423','TTG345345','','2021-09-14 08:45:53',''),(19,'7','asdasd','asdasd','adasd','asdasdasd','2021-09-14 09:52:37',''),(20,'8','SG Private Bank','23232323','2313123','SG33532S','2021-09-14 09:54:11',''),(21,'12','Mumbai bank','23423423423423','TTG345345','','2021-09-14 09:56:17',''),(22,'13','SG Private Bank','4343S534SG','adsasd','SG33532S','2021-09-14 09:57:19','Test 22221212'),(23,'14','sdfsdf','dsfsdfsd','sdfsdf','','2021-09-14 09:59:00',''),(24,'5','Test','23232323','adsasd','sa232123','2021-09-14 10:42:49',''),(31,'6','test','test','test','test','2021-09-14 11:22:41','');
/*!40000 ALTER TABLE `emp_bank_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_bonus`
--

DROP TABLE IF EXISTS `emp_bonus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_bonus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(20) NOT NULL,
  `bonus_id` varchar(50) NOT NULL,
  `date_bonus` date NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_bonus`
--

LOCK TABLES `emp_bonus` WRITE;
/*!40000 ALTER TABLE `emp_bonus` DISABLE KEYS */;
INSERT INTO `emp_bonus` VALUES (1,'2','2','2021-01-06','2021-01-06 10:10:29',2),(2,'3','2','2021-06-18','2021-06-18 12:48:55',2);
/*!40000 ALTER TABLE `emp_bonus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_certificates`
--

DROP TABLE IF EXISTS `emp_certificates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_certificates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `emp_ertificates_text` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_certificates`
--

LOCK TABLES `emp_certificates` WRITE;
/*!40000 ALTER TABLE `emp_certificates` DISABLE KEYS */;
INSERT INTO `emp_certificates` VALUES (9,'5','WHS Safety','','2021-06-29 08:28:41');
/*!40000 ALTER TABLE `emp_certificates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_commissionbonus_type`
--

DROP TABLE IF EXISTS `emp_commissionbonus_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_commissionbonus_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cb_type` varchar(50) NOT NULL,
  `sal_type` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_commissionbonus_type`
--

LOCK TABLES `emp_commissionbonus_type` WRITE;
/*!40000 ALTER TABLE `emp_commissionbonus_type` DISABLE KEYS */;
INSERT INTO `emp_commissionbonus_type` VALUES (1,'Bonus','Basic','Festival',100,'2021-01-06 10:01:35',2),(2,'Bonus','Gross','Annual',200,'2021-01-06 10:17:00',2),(3,'Commision','Basic','22',22,'2021-01-07 08:33:11',2);
/*!40000 ALTER TABLE `emp_commissionbonus_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_cpf_info`
--

DROP TABLE IF EXISTS `emp_cpf_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_cpf_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) NOT NULL,
  `cpf_contribution` varchar(255) NOT NULL,
  `cpf_no` varchar(255) DEFAULT NULL,
  `emp_cpf_contribution` varchar(50) DEFAULT NULL,
  `additional_rate` varchar(50) DEFAULT NULL,
  `total_rate` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_cpf_info`
--

LOCK TABLES `emp_cpf_info` WRITE;
/*!40000 ALTER TABLE `emp_cpf_info` DISABLE KEYS */;
INSERT INTO `emp_cpf_info` VALUES (12,'15','No','','',NULL,NULL,'2021-09-07 12:26:57'),(15,'16','No','','',NULL,NULL,'2021-09-14 07:34:46'),(16,'9','No','','',NULL,NULL,'2021-09-14 08:45:53'),(19,'7','No','','',NULL,NULL,'2021-09-14 09:52:37'),(20,'8','Yes','FF4646464','Yes',NULL,NULL,'2021-09-14 09:54:11'),(21,'12','No','xvcvv','Yes',NULL,NULL,'2021-09-14 09:56:17'),(22,'13','No','','',NULL,NULL,'2021-09-14 09:57:19'),(23,'14','No','','',NULL,NULL,'2021-09-14 09:59:00'),(24,'5','Yes','FF4646464','Yes',NULL,NULL,'2021-09-14 10:42:49'),(31,'6','Yes','432423423','Yes',NULL,NULL,'2021-09-14 11:22:41');
/*!40000 ALTER TABLE `emp_cpf_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_deductions`
--

DROP TABLE IF EXISTS `emp_deductions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_deductions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `deduction_id` int NOT NULL,
  `deduction_amount` varchar(20) NOT NULL,
  `other_text_d` varchar(255) NOT NULL,
  `other_amount` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_deductions`
--

LOCK TABLES `emp_deductions` WRITE;
/*!40000 ALTER TABLE `emp_deductions` DISABLE KEYS */;
INSERT INTO `emp_deductions` VALUES (10,16,2,'4','','','2021-09-14 07:34:46'),(11,9,1,'5','','','2021-09-14 08:45:53'),(14,12,1,'5','','','2021-09-14 09:56:17'),(15,13,2,'4','','','2021-09-14 09:57:19'),(16,14,1,'5','','','2021-09-14 09:59:00'),(17,14,2,'4','','','2021-09-14 09:59:00'),(18,5,2,'4','','','2021-09-14 10:42:49'),(31,6,1,'5','','','2021-09-14 11:22:41'),(32,6,990,'5','','','2021-09-14 11:22:41'),(33,6,2,'4','','','2021-09-14 11:22:41');
/*!40000 ALTER TABLE `emp_deductions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_education`
--

DROP TABLE IF EXISTS `emp_education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_education` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `other_text` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_education`
--

LOCK TABLES `emp_education` WRITE;
/*!40000 ALTER TABLE `emp_education` DISABLE KEYS */;
/*!40000 ALTER TABLE `emp_education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_experience_info`
--

DROP TABLE IF EXISTS `emp_experience_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_experience_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `exp_name` varchar(255) NOT NULL,
  `exp_location` varchar(255) DEFAULT NULL,
  `exp_job_position` varchar(150) DEFAULT NULL,
  `exp_from` varchar(100) DEFAULT NULL,
  `exp_to` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_experience_info`
--

LOCK TABLES `emp_experience_info` WRITE;
/*!40000 ALTER TABLE `emp_experience_info` DISABLE KEYS */;
INSERT INTO `emp_experience_info` VALUES (13,'15','sadasdas','','','07-09-2021','07-09-2021','2021-09-07 12:26:57'),(16,'16','sdfsdfsdf','','','07-09-2021','07-09-2021','2021-09-14 07:34:46'),(17,'9','GoodCompany','','','07-09-2021','07-09-2021','2021-09-14 08:45:53'),(20,'7','asdasd','','','19-01-2021','19-01-2021','2021-09-14 09:52:37'),(21,'8','Test Company','SG - SDG CENTRE 26 UBI ROAD 4 408613','Accountant','18-06-2021','18-06-2021','2021-09-14 09:54:11'),(22,'12','sdfsdfsdf','','','07-09-2021','07-09-2021','2021-09-14 09:56:17'),(23,'13','Test Company','SG - SDG CENTRE 26 UBI ROAD 4 408613','Accountant','07-09-2021','07-09-2021','2021-09-14 09:57:19'),(24,'13','Test Company','SG - SDG CENTRE 26 UBI ROAD 4 408613','Accountant DR','06-09-2021','17-09-2021','2021-09-14 09:57:19'),(25,'14','sdfsdfsd','','','07-09-2021','07-09-2021','2021-09-14 09:59:00'),(26,'5','Test','','','04-01-2021','04-01-2021','2021-09-14 10:42:49'),(33,'6','test','','','07-01-2021','07-01-2021','2021-09-14 11:22:41');
/*!40000 ALTER TABLE `emp_experience_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_family_info`
--

DROP TABLE IF EXISTS `emp_family_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_family_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `emr_family_name2` varchar(255) NOT NULL,
  `emr_family_relation2` varchar(255) DEFAULT NULL,
  `emr_dob` varchar(50) DEFAULT NULL,
  `emr_family_phone` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_family_info`
--

LOCK TABLES `emp_family_info` WRITE;
/*!40000 ALTER TABLE `emp_family_info` DISABLE KEYS */;
INSERT INTO `emp_family_info` VALUES (10,'7','asdasda','','19-01-2021','','2021-09-14 09:52:37'),(11,'8','Test User','','18-06-2021','345457673','2021-09-14 09:54:11'),(12,'13','Skip Ande','Brother','06-07-1989','34545767311','2021-09-14 09:57:19'),(13,'13','Test User','Brother R','21-07-1983','34545767321','2021-09-14 09:57:19'),(14,'5','Test','','04-01-2021','','2021-09-14 10:42:49'),(21,'6','test','','07-01-2021','','2021-09-14 11:22:41');
/*!40000 ALTER TABLE `emp_family_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_grade_allowances`
--

DROP TABLE IF EXISTS `emp_grade_allowances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_grade_allowances` (
  `id` int NOT NULL AUTO_INCREMENT,
  `grade_id` varchar(20) NOT NULL,
  `allowance_id` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_grade_allowances`
--

LOCK TABLES `emp_grade_allowances` WRITE;
/*!40000 ALTER TABLE `emp_grade_allowances` DISABLE KEYS */;
INSERT INTO `emp_grade_allowances` VALUES (14,'7','4','2021-09-14 11:48:44','2021-09-14 11:48:44');
/*!40000 ALTER TABLE `emp_grade_allowances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_increments`
--

DROP TABLE IF EXISTS `emp_increments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_increments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(50) NOT NULL,
  `department_id` varchar(50) NOT NULL,
  `designation_id` varchar(50) NOT NULL,
  `grade_id` varchar(255) NOT NULL,
  `joining_date` date NOT NULL,
  `previous_salary` varchar(50) NOT NULL,
  `salary_type` varchar(20) NOT NULL,
  `increment_date` date NOT NULL,
  `increment_on` varchar(50) DEFAULT NULL,
  `increment_percent` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_increments`
--

LOCK TABLES `emp_increments` WRITE;
/*!40000 ALTER TABLE `emp_increments` DISABLE KEYS */;
INSERT INTO `emp_increments` VALUES (2,'2','1','2','3','0001-11-30','400','Monthly','2021-01-07',NULL,'10','2021-01-07 09:01:17','2021-01-07 09:01:17',2),(3,'2','1','2','3','0001-11-30','400','Monthly','2021-01-19',NULL,'10','2021-01-07 09:01:59','2021-01-07 09:01:59',2),(4,'3','1','3','3','2021-01-12','400','Daily','2021-06-18',NULL,'20','2021-06-18 12:46:23','2021-06-18 12:46:23',2);
/*!40000 ALTER TABLE `emp_increments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_it`
--

DROP TABLE IF EXISTS `emp_it`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_it` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `technical_other_text` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_it`
--

LOCK TABLES `emp_it` WRITE;
/*!40000 ALTER TABLE `emp_it` DISABLE KEYS */;
INSERT INTO `emp_it` VALUES (17,'5','MYOB','','2021-06-29 08:28:41'),(18,'5','VideoEdit','','2021-06-29 08:28:41');
/*!40000 ALTER TABLE `emp_it` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_license`
--

DROP TABLE IF EXISTS `emp_license`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_license` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `emp_licence_text` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_license`
--

LOCK TABLES `emp_license` WRITE;
/*!40000 ALTER TABLE `emp_license` DISABLE KEYS */;
INSERT INTO `emp_license` VALUES (9,'5','Car','','2021-06-29 08:28:41');
/*!40000 ALTER TABLE `emp_license` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_licenses`
--

DROP TABLE IF EXISTS `emp_licenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_licenses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `emp_license` varchar(255) NOT NULL,
  `other_text` varchar(255) DEFAULT NULL,
  `lic_expire_Date` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_licenses`
--

LOCK TABLES `emp_licenses` WRITE;
/*!40000 ALTER TABLE `emp_licenses` DISABLE KEYS */;
INSERT INTO `emp_licenses` VALUES (8,16,'Car','','07-09-2021','2021-09-14 07:34:46'),(9,16,'Lorry','','08-09-2021','2021-09-14 07:34:46'),(10,16,'Others','sdfsdfsd','10-09-2021','2021-09-14 07:34:46'),(11,13,'Boat','','06-09-2021','2021-09-14 09:57:19'),(12,13,'Car','','10-09-2021','2021-09-14 09:57:19'),(13,6,'Car','','14-09-2021','2021-09-14 11:22:41'),(14,6,'E-bike','','08-09-2021','2021-09-14 11:22:41');
/*!40000 ALTER TABLE `emp_licenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_paygrades`
--

DROP TABLE IF EXISTS `emp_paygrades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_paygrades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `grade_type` varchar(20) NOT NULL,
  `grade_name` varchar(255) NOT NULL,
  `gross_salary` double NOT NULL,
  `basic_salary` double NOT NULL,
  `percentage` varchar(15) NOT NULL,
  `overtime` double NOT NULL,
  `allowence` varchar(255) NOT NULL,
  `created_by` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_paygrades`
--

LOCK TABLES `emp_paygrades` WRITE;
/*!40000 ALTER TABLE `emp_paygrades` DISABLE KEYS */;
INSERT INTO `emp_paygrades` VALUES (1,'Monthly','Monthly Grade A',700,650,'10',5,'',2,'2020-12-24 03:10:25','2020-12-30 08:39:00'),(3,'Monthly','Monthly Grade B',400,350,'5',80,'',2,'2020-12-24 03:32:33','2020-12-30 08:39:16'),(5,'Daily','Daily Grade',45,35,'15',6,'',2,'2020-12-24 03:43:21','2020-12-30 08:40:10'),(6,'Hourly','5 hours or less',5,3,'10',5,'',2,'2020-12-24 03:45:10','2020-12-30 08:40:40'),(7,'Monthly','Grade B',700,600,'15',5,'',2,'2021-06-18 12:56:15','2021-06-18 12:56:15'),(8,'Monthly','sss',211,500,'10',500,'',2,'2021-06-29 08:01:02','2021-06-29 08:01:02');
/*!40000 ALTER TABLE `emp_paygrades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_personal_info`
--

DROP TABLE IF EXISTS `emp_personal_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_personal_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) NOT NULL,
  `passport_no` varchar(255) NOT NULL,
  `passport_expire` date DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `spouse` varchar(255) DEFAULT NULL,
  `no_of_child` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `marital_status1` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_personal_info`
--

LOCK TABLES `emp_personal_info` WRITE;
/*!40000 ALTER TABLE `emp_personal_info` DISABLE KEYS */;
INSERT INTO `emp_personal_info` VALUES (2,'5','2323223','0001-11-30','','Bahamian','HINDU','Single','','','2021-01-04 09:35:08','HINDU'),(3,'6','2323223','0001-11-30','','Armenian','HINDU','Single','','','2021-01-07 07:05:52','HINDU'),(4,'7','23232323','0001-11-30','','Antarctic','HINDU','Single','','','2021-01-19 09:37:16','HINDU'),(5,'8','232323r','0001-11-30','23232354','Algerian','Buddhism','Single','Father','2','2021-06-18 12:13:09','Buddhism'),(6,'9','CVBCVB343443','2021-09-07','','Bangladeshi','Hindi','Married','','','2021-09-07 07:29:23','Hindi'),(9,'12','CVBCVB343443','2021-09-07','','Barbadian','Hindi','Single','','','2021-09-07 10:01:52','Hindi'),(10,'13','TS23232G33','2021-09-25','343243242','Singaporean','Buddhism','Single','','','2021-09-07 12:15:12','Buddhism'),(11,'14','CVBCVB343443','2021-09-07','','Austrian','Hindi','Married','','','2021-09-07 12:23:07','Hindi'),(12,'15','asdasd','2021-09-07','','Bangladeshi','asdsad','Single','','','2021-09-07 12:26:57',''),(13,'16','sdfsdf','2021-09-07','','Bahraini','sdfsdfsd','Single','sdfsdfsdf','','2021-09-07 12:31:36','sdfsdfsd');
/*!40000 ALTER TABLE `emp_personal_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_primary_details`
--

DROP TABLE IF EXISTS `emp_primary_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_primary_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `emr_name1` varchar(255) NOT NULL,
  `emr_relation1` varchar(50) DEFAULT NULL,
  `emr_phone1` varchar(50) DEFAULT NULL,
  `emr_phone12` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_primary_details`
--

LOCK TABLES `emp_primary_details` WRITE;
/*!40000 ALTER TABLE `emp_primary_details` DISABLE KEYS */;
INSERT INTO `emp_primary_details` VALUES (2,'5','Dheeraj Bhatia','','','','2021-01-04 09:35:08'),(3,'6','Dheeraj Bhatia','','','','2021-01-07 07:05:52'),(4,'7','Dheeraj Bhatia','','09780559405','','2021-01-19 09:37:16'),(5,'8','Dheeraj Bhatia','','345457673','','2021-06-18 12:13:09'),(6,'9','John','','','','2021-09-07 07:29:23'),(9,'12','ersdfsdf','','','','2021-09-07 10:01:52'),(10,'13','Test 1111','Father','345457673','345457673','2021-09-07 12:15:12'),(11,'14','sdfsdfsdf','','','','2021-09-07 12:23:07'),(12,'15','sadasdas','','','','2021-09-07 12:26:57'),(13,'16','sdfsdfsd','','','','2021-09-07 12:31:36');
/*!40000 ALTER TABLE `emp_primary_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_qualification`
--

DROP TABLE IF EXISTS `emp_qualification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_qualification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `emp_qual_text` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_qualification`
--

LOCK TABLES `emp_qualification` WRITE;
/*!40000 ALTER TABLE `emp_qualification` DISABLE KEYS */;
INSERT INTO `emp_qualification` VALUES (14,'13','Cert','','2021-09-14 09:57:19'),(15,'13','Diploma','','2021-09-14 09:57:19'),(16,'13','Degree','','2021-09-14 09:57:19');
/*!40000 ALTER TABLE `emp_qualification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_roaster_shifts`
--

DROP TABLE IF EXISTS `emp_roaster_shifts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_roaster_shifts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `shift_type` varchar(20) NOT NULL,
  `created_by` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `siteid` int NOT NULL,
  `cid` int NOT NULL,
  `weekdays` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_roaster_shifts`
--

LOCK TABLES `emp_roaster_shifts` WRITE;
/*!40000 ALTER TABLE `emp_roaster_shifts` DISABLE KEYS */;
INSERT INTO `emp_roaster_shifts` VALUES (1,2,'2021-01-11','2021-01-31','2',2,'2021-01-13 07:21:16','2021-01-13 07:21:16',0,0,NULL),(2,2,'2021-01-11','2021-01-31','3',2,'2021-01-13 07:22:42','2021-01-13 07:22:58',0,0,NULL),(3,2,'2021-01-13','2021-01-13','3',2,'2021-01-13 07:35:46','2021-01-13 07:35:46',0,0,NULL),(4,3,'2021-01-13','2021-01-13','3',2,'2021-01-13 07:36:30','2021-01-13 07:36:30',0,0,NULL),(5,3,'2021-01-13','2021-01-13','3',2,'2021-01-13 07:36:47','2021-01-13 07:36:47',0,0,NULL),(6,3,'2021-01-13','2021-01-13','2',2,'2021-01-13 07:36:56','2021-01-13 07:36:56',0,0,NULL),(7,2,'2021-08-23','2021-08-23','3',2,'2021-08-23 10:55:52','2021-08-23 10:55:52',0,0,NULL),(8,2,'2021-08-19','2021-08-12','5',2,'2021-08-26 01:07:32','2021-08-26 13:07:32',0,0,NULL),(9,10,'2021-09-16','2021-09-18','2',2,'2021-09-13 05:23:12','2021-09-13 05:23:53',0,0,2),(10,13,'2021-09-06','2021-09-09','2',2,'2021-09-13 05:24:28','2021-09-13 05:24:28',0,0,1),(11,2,'2021-09-08','2021-09-11','2',2,'2021-09-13 05:25:00','2021-09-13 05:25:00',0,0,1),(12,2,'2021-09-13','2021-09-14','2',2,'2021-09-13 05:36:33','2021-09-13 05:36:33',0,0,1),(13,10,'2021-09-13','2021-09-13','2',2,'2021-09-13 11:17:12','2021-09-13 11:17:12',0,0,1),(14,14,'2021-10-06','2021-10-07','2',2,'2021-09-13 11:18:22','2021-09-13 11:18:22',0,0,1),(15,11,'2021-09-07','2021-09-25','2',2,'2021-09-14 08:25:43','2021-09-14 08:25:43',0,0,1);
/*!40000 ALTER TABLE `emp_roaster_shifts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_secondry_details`
--

DROP TABLE IF EXISTS `emp_secondry_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_secondry_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `emr_name2` varchar(255) NOT NULL,
  `emr_relation2` varchar(50) DEFAULT NULL,
  `emr_phone2` varchar(50) DEFAULT NULL,
  `emr_phone22` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_secondry_details`
--

LOCK TABLES `emp_secondry_details` WRITE;
/*!40000 ALTER TABLE `emp_secondry_details` DISABLE KEYS */;
INSERT INTO `emp_secondry_details` VALUES (2,'5','Test','','','','2021-01-04 09:35:08'),(3,'6','Test','','','','2021-01-07 07:05:52'),(4,'7','asdasd','','','','2021-01-19 09:37:16'),(5,'8','Test User','','345457673','','2021-06-18 12:13:09'),(6,'9','Robbin','','','','2021-09-07 07:29:23'),(9,'12','asdasdas','','','','2021-09-07 10:01:52'),(10,'13','asdsadsd','Brother','78678877','78678877','2021-09-07 12:15:12'),(11,'14','sdfsdfsdf','','','','2021-09-07 12:23:07'),(12,'15','asdasds','','','','2021-09-07 12:26:57'),(13,'16','fsdfsfsdf','','','','2021-09-07 12:31:36');
/*!40000 ALTER TABLE `emp_secondry_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_set_date`
--

DROP TABLE IF EXISTS `emp_set_date`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_set_date` (
  `id` int NOT NULL AUTO_INCREMENT,
  `from_d` int NOT NULL,
  `to_d` int NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_set_date`
--

LOCK TABLES `emp_set_date` WRITE;
/*!40000 ALTER TABLE `emp_set_date` DISABLE KEYS */;
INSERT INTO `emp_set_date` VALUES (1,1,1,'2020-12-28 01:54:57'),(2,5,31,'2021-06-22 02:51:09');
/*!40000 ALTER TABLE `emp_set_date` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_set_date_custom`
--

DROP TABLE IF EXISTS `emp_set_date_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_set_date_custom` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(50) NOT NULL,
  `from_d` int NOT NULL,
  `to_d` int NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_set_date_custom`
--

LOCK TABLES `emp_set_date_custom` WRITE;
/*!40000 ALTER TABLE `emp_set_date_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `emp_set_date_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_skills`
--

DROP TABLE IF EXISTS `emp_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_skills` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `emp_skills_text` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_skills`
--

LOCK TABLES `emp_skills` WRITE;
/*!40000 ALTER TABLE `emp_skills` DISABLE KEYS */;
INSERT INTO `emp_skills` VALUES (9,'5','Engine','','2021-06-29 08:28:41');
/*!40000 ALTER TABLE `emp_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_slary_info`
--

DROP TABLE IF EXISTS `emp_slary_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_slary_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `salary_type` varchar(50) NOT NULL,
  `salary_amount` varchar(50) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_slary_info`
--

LOCK TABLES `emp_slary_info` WRITE;
/*!40000 ALTER TABLE `emp_slary_info` DISABLE KEYS */;
INSERT INTO `emp_slary_info` VALUES (12,'Daily','45','Cash','15','2021-09-07 12:26:57'),(15,'Hourly','5','Cheque','16','2021-09-14 07:34:46'),(16,'Daily','45','Bank transfer','9','2021-09-14 08:45:53'),(19,'Hourly','5','Cheque','7','2021-09-14 09:52:37'),(20,'Hourly','5','Cash','8','2021-09-14 09:54:11'),(21,'Hourly','5','Cheque','12','2021-09-14 09:56:17'),(22,'Daily','45','Bank transfer','13','2021-09-14 09:57:19'),(23,'Daily','45','Bank transfer','14','2021-09-14 09:59:00'),(24,'Monthly','211','Bank transfer','5','2021-09-14 10:42:49'),(31,'Daily','400','Cheque','6','2021-09-14 11:22:41');
/*!40000 ALTER TABLE `emp_slary_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_documents`
--

DROP TABLE IF EXISTS `employee_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `document_id` int DEFAULT NULL,
  `document_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_documents`
--

LOCK TABLES `employee_documents` WRITE;
/*!40000 ALTER TABLE `employee_documents` DISABLE KEYS */;
INSERT INTO `employee_documents` VALUES (1,4,NULL,'invoice-7_1611049036.pdf',2,'2021-01-19 04:07:16',NULL),(2,2,NULL,'invoice-7_1611051165.pdf',2,'2021-01-19 04:42:45',NULL),(3,5,NULL,'download_1624018390.png',2,'2021-06-18 06:43:09',NULL),(4,2,NULL,'download_1624951489.png',2,'2021-06-29 01:54:49',NULL),(5,3,NULL,'download_1624951569.png',2,'2021-06-29 01:56:09',NULL),(6,2,NULL,'Screen Shot 2021-06-29 at 1.35.02 PM_1624953921.png',2,'2021-06-29 02:35:21',NULL),(7,2,NULL,'Screen Shot 2021-06-29 at 1.35.02 PM_1624954039.png',2,'2021-06-29 02:37:19',NULL),(8,2,NULL,'download_1624955056.png',2,'2021-06-29 02:54:16',NULL),(9,2,NULL,'download_1624955320.png',2,'2021-06-29 02:58:40',NULL),(10,3,NULL,'HRM - Payslip_1625127858.pdf',2,'2021-07-01 02:54:18',NULL),(11,6,NULL,'sample1_1630999764.jpg',2,'2021-09-07 01:59:23',NULL),(14,9,NULL,'sample1_1631008912.jpg',2,'2021-09-07 04:31:52',NULL),(15,10,NULL,'dummy_1631016912.pdf',2,'2021-09-07 06:45:12',NULL),(16,11,NULL,'sample2_1631017387.jpg',2,'2021-09-07 06:53:07',NULL),(18,13,NULL,'sample1_1631017896.jpg',2,'2021-09-07 07:01:36',NULL),(19,14,NULL,'sample1_1631018352.jpg',2,'2021-09-07 07:09:12',NULL);
/*!40000 ALTER TABLE `employee_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_jbrs`
--

DROP TABLE IF EXISTS `employee_jbrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_jbrs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `jbr_id` int NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_jbrs`
--

LOCK TABLES `employee_jbrs` WRITE;
/*!40000 ALTER TABLE `employee_jbrs` DISABLE KEYS */;
INSERT INTO `employee_jbrs` VALUES (10,15,1,0,'2021-09-07 06:56:57',NULL),(13,16,3,0,'2021-09-14 02:04:46',NULL),(14,9,2,0,'2021-09-14 03:15:53',NULL),(17,7,3,0,'2021-09-14 04:22:37',NULL),(18,8,4,0,'2021-09-14 04:24:11',NULL),(19,12,3,0,'2021-09-14 04:26:17',NULL),(20,13,3,0,'2021-09-14 04:27:19',NULL),(21,14,1,0,'2021-09-14 04:29:00',NULL),(22,14,4,0,'2021-09-14 04:29:00',NULL),(23,5,4,0,'2021-09-14 05:12:49',NULL),(30,6,3,0,'2021-09-14 05:52:41',NULL);
/*!40000 ALTER TABLE `employee_jbrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_locations`
--

DROP TABLE IF EXISTS `employee_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `location_value` varchar(255) NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_locations`
--

LOCK TABLES `employee_locations` WRITE;
/*!40000 ALTER TABLE `employee_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_manage_leave`
--

DROP TABLE IF EXISTS `employee_manage_leave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_manage_leave` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `leave_type_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_leaves` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_manage_leave`
--

LOCK TABLES `employee_manage_leave` WRITE;
/*!40000 ALTER TABLE `employee_manage_leave` DISABLE KEYS */;
INSERT INTO `employee_manage_leave` VALUES (1,'1','','4','2','2020-12-11 02:28:52','2020-12-11 02:28:52'),(2,'2','','4','2','2020-12-11 02:30:57','2020-12-11 02:30:57'),(3,'1','','4','2','2020-12-11 02:34:18','2020-12-11 02:34:18'),(4,'1','','4','2','2020-12-11 02:34:46','2020-12-11 02:34:46'),(5,'1','','2','2','2020-12-11 02:34:51','2020-12-11 02:34:51'),(6,'1','','4','2','2020-12-11 02:43:11','2020-12-11 02:43:11'),(7,'1','','4','2','2020-12-11 02:43:33','2020-12-11 02:43:33'),(9,'1','2','4','2','2021-01-07 02:14:03','2021-01-07 02:14:03'),(10,'8','2','5','2','2021-01-12 00:27:55','2021-01-12 00:28:06'),(11,'9','5','12','2','2021-06-27 21:17:11','2021-06-27 21:17:11');
/*!40000 ALTER TABLE `employee_manage_leave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_salary`
--

DROP TABLE IF EXISTS `employee_salary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_salary` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(50) NOT NULL,
  `grade_id` varchar(50) NOT NULL,
  `claim_id` int NOT NULL,
  `gross_salary` varchar(50) NOT NULL,
  `salary_type` varchar(50) NOT NULL,
  `cpf_e` varchar(50) NOT NULL,
  `cpf_c` varchar(50) NOT NULL,
  `donation_type` varchar(50) NOT NULL,
  `donation_amount` varchar(50) NOT NULL,
  `allnc_cost` varchar(20) NOT NULL,
  `commission_cost` varchar(50) NOT NULL,
  `get_commission_id` varchar(50) NOT NULL,
  `get_bonus_id` varchar(20) NOT NULL,
  `get_overtime_cost` varchar(100) NOT NULL,
  `total_salary` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_salary`
--

LOCK TABLES `employee_salary` WRITE;
/*!40000 ALTER TABLE `employee_salary` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_salary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donation_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_grade` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_emp` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pass_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_join` date NOT NULL,
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nok` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uniform` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uniform_size` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contract_period` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` int NOT NULL,
  `department_id` int NOT NULL,
  `designation_id` int NOT NULL,
  `company_doj` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documents` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_holder_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_identifier_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_payer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary_type` int DEFAULT NULL,
  `salary` double DEFAULT '0',
  `is_active` int NOT NULL DEFAULT '1',
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `other_contract` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `probation_period` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_other_prob` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notice_period` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_notice` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identifications_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `race` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shift_type` int NOT NULL,
  `own_bike` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `own_sg_car` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iunumber_b` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iunumber_c` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regis_no_b` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regis_no_c` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `worker_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (2,5,'Dheeraj Bhatia','Dheeraj','Bhatia','asdasdasd','Singapore Citizen','CDAC','8','','One Year','','0000-00-00','ravapps.com','KKKK','White','M','','1980-01-15','','09780559405','asdasdasd','ravapps@gmail.com','','14',2,3,5,'2020-07-15','5f87c1b76da29_1611051165.jpg',NULL,NULL,NULL,NULL,NULL,NULL,1,556,1,2,'2021-01-04 04:05:09','2021-06-30 23:59:25','','180','','90','','dasdasdas','sadasdasd',2,NULL,NULL,'','','','','',4),(3,6,'Dheeraj Bhatia','Dheeraj','Bhatia','TestII','Singapore Citizen','N/A','5','','','','0000-00-00','ravapps.com','KKKK','White','M','','2021-01-07','','09780559405','01-05, CHOA CHU KANG LIAN HE TEMPLE 11 CHOA CHU KANG STREET 51','ravapps@gmail.com','','14',2,3,5,'2020-04-01','avatar_1610003153.jpg',NULL,NULL,NULL,NULL,NULL,NULL,1,533,1,2,'2021-01-07 01:35:53','2021-06-29 02:57:08','','730','','14','','feeffsdfsd','sadasdas',2,NULL,NULL,'','','','','',4),(4,7,'Name Title','Name','Title','name@title','Work Pass','','6','','','S-Pass','0000-00-00','asdasd','a','adasd','asdasd','','1970-01-01','','23232','','test7877@yopmail.com','','14',2,3,5,'2021-01-19','',NULL,NULL,NULL,NULL,NULL,NULL,1,333,1,2,'2021-01-19 04:07:16','2021-06-29 02:57:30','','365','','60','','eefsdfsdf','fsdfsd',2,NULL,NULL,'','','','','',4),(5,8,'Dheeraj Bhatia','Dheeraj','Bhatia','newuser21222@yopmail.com','Permanent Resident','ECF','6','','One Year','','0000-00-00','ravapps.com','KKKK','White','L','','2021-06-18','','09780559405','','ravapps@gmail.com','','14',2,3,5,'2021-06-18','images66666_1624018390.jpg',NULL,NULL,NULL,NULL,NULL,NULL,1,222,1,2,'2021-06-18 06:43:10','2021-06-29 02:57:40','','365','','60','','asdasd','asdasd',2,NULL,NULL,'','','','','',4),(6,9,'Supervisor Employee','Supervisor','Employee','supervisor','Malaysia','','5','','','Work Permit','0000-00-00','ravapps.com','','blue','large','365','2021-09-07',NULL,'1234567890',NULL,'supervisor@gmail.com','','13',2,3,4,'2021-09-07','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,2,'2021-09-07 01:59:24','2021-09-07 01:59:24','','90','','7','','SDFSDS2323','Malyasian',2,NULL,NULL,'','','','','',4),(9,12,'qadasf dsfsdfsdf','qadasf','dsfsdfsdf','dfsdfsd','Singapore Citizen','N/A','6','','One Year','','0000-00-00','sdffsdf','','blue','large','365','2021-09-07',NULL,'534534534',NULL,'dfdsf@dfsdfs.com','','14',2,3,5,'2021-09-07','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,2,'2021-09-07 04:31:52','2021-09-07 04:31:52','','90','','14','','SDFSDS2323','Malyasian',2,NULL,NULL,'','','','','floater',4),(10,13,'Test Name','Test','Name','Testname1','Work Pass','','5','','','S-Pass','0000-00-00','Test xyz','','Test','S','Other','2006-01-19',NULL,'324324234234',NULL,'testeelat122111@yopmail.com','','14',2,3,5,'2008-05-30','asdasd_1631016912.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,2,'2021-09-07 06:45:12','2021-09-07 06:45:12','Test Contract Period 23','Other','Test Other Probation 23','Other','180 Days','34434DSF34','Testt',2,'Own Bike','Own SG Car','Test23T','Test244EE','Test234T','Test2233RR','floater',4),(11,14,'dddd dddd','dddd','dddd','hr@example.com','Malaysia','','5','','','S-Pass','0000-00-00','dddddd','','blue','large','1095','2021-09-07',NULL,'3333',NULL,'ddd@ddd','','14',2,3,5,'2021-09-07','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,2,'2021-09-07 06:53:07','2021-09-07 06:53:07','','365','','30','','SDFSDS2323','Malyasian',2,NULL,NULL,'','','','','floater',4),(12,15,'asdsad adasdasdas','asdsad','adasdasdas','hr@example.com','Malaysia','','5','','','S-Pass','0000-00-00','sadsad','','asdas','dsdasdas','730','2021-09-07',NULL,'23423423423',NULL,'asdasd@sdsfsd.com','','10',2,3,4,'2021-09-07','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,2,'2021-09-07 06:56:57','2021-09-07 06:56:57','','180','','14','','asdasdas','asdasdas',2,NULL,NULL,'','','','',NULL,4),(13,16,'Supervisor Two','Supervisor','Two','hr@example.com','Malaysia','','6','','','S-Pass','0000-00-00','fsdfsdfsd','','dsfsd','fdfsdfsd','1095','2021-09-07',NULL,'dfsfsdfsdfsd',NULL,'sdfds@sdfsdfsd.com','','13',2,3,4,'2021-09-07','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,2,'2021-09-07 07:01:36','2021-09-07 07:01:36','','90','','60','','sdfsdf','sdfsdfsd',2,NULL,NULL,'','','','','',4);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_employees`
--

DROP TABLE IF EXISTS `event_employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_employees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_employees`
--

LOCK TABLES `event_employees` WRITE;
/*!40000 ALTER TABLE `event_employees` DISABLE KEYS */;
INSERT INTO `event_employees` VALUES (1,1,1,2,'2020-12-30 02:19:26','2020-12-30 02:19:26'),(2,2,2,2,'2021-06-18 07:54:18','2021-06-18 07:54:18'),(3,3,2,2,'2021-08-23 05:45:01','2021-08-23 05:45:01'),(4,3,3,2,'2021-08-23 05:45:01','2021-08-23 05:45:01');
/*!40000 ALTER TABLE `event_employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `department_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,0,'[\"1\"]','[\"0\"]','Test','2020-12-30','2020-12-30','#ffa426','',2,'2020-12-30 02:19:26','2020-12-30 02:19:26'),(2,1,'[\"1\"]','[\"2\"]','Test','2021-06-16','2021-06-18','#ffa426','Testt',2,'2021-06-18 07:54:18','2021-06-18 07:54:18'),(3,1,'[\"0\",\"2\"]','[\"2\",\"3\"]','Transport','0000-00-00','0000-00-00','#cdd3d8','',2,'2021-08-23 05:45:01','2021-08-23 05:45:01');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_types`
--

DROP TABLE IF EXISTS `expense_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_types`
--

LOCK TABLES `expense_types` WRITE;
/*!40000 ALTER TABLE `expense_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `expense_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `amount` int NOT NULL,
  `date` date NOT NULL,
  `expense_category_id` int NOT NULL,
  `payee_id` int NOT NULL,
  `payment_type_id` int NOT NULL,
  `referal_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorites` (
  `id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `favorite_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
INSERT INTO `favorites` VALUES (15331898,3,7,'2021-08-23 05:50:28','2021-08-23 05:50:28'),(87932643,3,2,'2021-06-17 06:17:08','2021-06-17 06:17:08');
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genrate_payslip_options`
--

DROP TABLE IF EXISTS `genrate_payslip_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genrate_payslip_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genrate_payslip_options`
--

LOCK TABLES `genrate_payslip_options` WRITE;
/*!40000 ALTER TABLE `genrate_payslip_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `genrate_payslip_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goal_trackings`
--

DROP TABLE IF EXISTS `goal_trackings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goal_trackings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch` int NOT NULL,
  `goal_type` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_achievement` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '0',
  `progress` int NOT NULL DEFAULT '0',
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goal_trackings`
--

LOCK TABLES `goal_trackings` WRITE;
/*!40000 ALTER TABLE `goal_trackings` DISABLE KEYS */;
/*!40000 ALTER TABLE `goal_trackings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goal_types`
--

DROP TABLE IF EXISTS `goal_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goal_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goal_types`
--

LOCK TABLES `goal_types` WRITE;
/*!40000 ALTER TABLE `goal_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `goal_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `holidays`
--

DROP TABLE IF EXISTS `holidays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `holidays` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` int NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `occasion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `holidays`
--

LOCK TABLES `holidays` WRITE;
/*!40000 ALTER TABLE `holidays` DISABLE KEYS */;
INSERT INTO `holidays` VALUES (1,'2030-11-01','2030-11-01','00:00:00',23,'is an annual festival commemorating the birth of Jesus Christ','Christmas Day',2,'2020-12-11 06:50:15','2020-12-15 23:10:16'),(2,'0000-00-00','0000-00-00','00:00:00',0,'Test','Test',2,'2020-12-14 04:26:52','2020-12-14 04:26:52'),(3,'0000-00-00','0000-00-00','00:00:00',0,'Test','das',2,'2020-12-14 04:27:29','2020-12-14 04:27:29'),(4,'2020-12-09','2020-12-10','00:00:00',0,'test','Test',2,'2020-12-14 23:49:57','2020-12-14 23:49:57'),(5,'2020-12-18','2020-12-18','00:00:00',12,'Test','Test',2,'2020-12-15 23:11:04','2020-12-15 23:11:04');
/*!40000 ALTER TABLE `holidays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `income_types`
--

DROP TABLE IF EXISTS `income_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `income_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `income_types`
--

LOCK TABLES `income_types` WRITE;
/*!40000 ALTER TABLE `income_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `income_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indicators`
--

DROP TABLE IF EXISTS `indicators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `indicators` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch` int NOT NULL DEFAULT '0',
  `department` int NOT NULL DEFAULT '0',
  `designation` int NOT NULL DEFAULT '0',
  `customer_experience` int NOT NULL DEFAULT '0',
  `marketing` int NOT NULL DEFAULT '0',
  `administration` int NOT NULL DEFAULT '0',
  `professionalism` int NOT NULL DEFAULT '0',
  `integrity` int NOT NULL DEFAULT '0',
  `attendance` int NOT NULL DEFAULT '0',
  `created_user` int NOT NULL DEFAULT '0',
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indicators`
--

LOCK TABLES `indicators` WRITE;
/*!40000 ALTER TABLE `indicators` DISABLE KEYS */;
/*!40000 ALTER TABLE `indicators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jbrs`
--

DROP TABLE IF EXISTS `jbrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jbrs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `designation_id` int NOT NULL,
  `res_name` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jbrs`
--

LOCK TABLES `jbrs` WRITE;
/*!40000 ALTER TABLE `jbrs` DISABLE KEYS */;
INSERT INTO `jbrs` VALUES (1,3,'Daily Reporting','2','2021-10-28 18:49:29','2021-07-19 01:13:00'),(2,3,'Daily Tool Check Updations','1','2021-10-28 18:49:29','2021-07-19 03:35:17'),(3,3,'Responsibility1','2','2021-10-28 18:49:29','2021-09-12 21:45:47'),(4,3,'Responsibility2','2','2021-10-28 18:49:29','2021-09-12 21:45:47'),(5,3,'Responsibility3','2','2021-10-28 18:49:29','2021-09-12 21:45:47'),(6,1,'Responsibility12','2','2021-10-28 18:49:29','2021-09-14 02:45:44'),(7,1,'Responsibility2','2','2021-10-28 18:49:29','2021-09-12 21:46:03'),(8,1,'Responsibility3','2','2021-10-28 18:49:29','2021-09-12 21:46:03');
/*!40000 ALTER TABLE `jbrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_document`
--

DROP TABLE IF EXISTS `leave_document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_document` (
  `id` int NOT NULL AUTO_INCREMENT,
  `leave_id` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_document`
--

LOCK TABLES `leave_document` WRITE;
/*!40000 ALTER TABLE `leave_document` DISABLE KEYS */;
/*!40000 ALTER TABLE `leave_document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_types`
--

DROP TABLE IF EXISTS `leave_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` int NOT NULL,
  `leaves_days` int NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_types`
--

LOCK TABLES `leave_types` WRITE;
/*!40000 ALTER TABLE `leave_types` DISABLE KEYS */;
INSERT INTO `leave_types` VALUES (1,'Annual ( Normal / Urgent )',3,0,2,'2020-12-10 01:33:26','2020-12-16 23:34:45'),(2,'Medical Leave',2,0,2,'2020-12-10 01:33:44','2020-12-16 23:34:34'),(3,'ChildCare Leaves',4,0,2,'2020-12-10 01:33:50','2020-12-16 23:34:54'),(4,'Marriage',5,0,2,'2020-12-10 01:33:55','2020-12-16 23:35:03'),(5,'Maternity & Paternity leave',6,0,2,'2020-12-10 01:34:08','2020-12-16 23:35:13'),(6,'Others',10,0,2,'2020-12-10 01:34:24','2020-12-16 23:35:51'),(7,'Probation Leave',7,0,2,'2020-12-10 01:34:33','2020-12-16 23:35:23'),(8,'Reservist list',8,0,2,'2020-12-10 01:34:41','2020-12-16 23:35:35'),(9,'Sick Leave',1,0,2,'2020-12-10 01:34:49','2020-12-16 23:34:22'),(10,'Unpaid Leave',9,0,2,'2020-12-10 01:34:56','2020-12-16 23:35:44');
/*!40000 ALTER TABLE `leave_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leaves`
--

DROP TABLE IF EXISTS `leaves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leaves` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `leave_type_id` int NOT NULL,
  `applied_on` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `from_time` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_leave_days` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leaves`
--

LOCK TABLES `leaves` WRITE;
/*!40000 ALTER TABLE `leaves` DISABLE KEYS */;
INSERT INTO `leaves` VALUES (2,2,1,'2021-01-07','2021-01-13','2021-01-14','PM','Armenia','Kolkata','AM','2','Test','','Reject',2,'2021-01-07 02:14:52','2021-01-07 02:16:16');
/*!40000 ALTER TABLE `leaves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan_options`
--

DROP TABLE IF EXISTS `loan_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_options`
--

LOCK TABLES `loan_options` WRITE;
/*!40000 ALTER TABLE `loan_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `loan_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loans`
--

DROP TABLE IF EXISTS `loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `loan_option` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loans`
--

LOCK TABLES `loans` WRITE;
/*!40000 ALTER TABLE `loans` DISABLE KEYS */;
/*!40000 ALTER TABLE `loans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meeting_employees`
--

DROP TABLE IF EXISTS `meeting_employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meeting_employees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meeting_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meeting_employees`
--

LOCK TABLES `meeting_employees` WRITE;
/*!40000 ALTER TABLE `meeting_employees` DISABLE KEYS */;
/*!40000 ALTER TABLE `meeting_employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meetings`
--

DROP TABLE IF EXISTS `meetings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meetings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `department_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings`
--

LOCK TABLES `meetings` WRITE;
/*!40000 ALTER TABLE `meetings` DISABLE KEYS */;
/*!40000 ALTER TABLE `meetings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` bigint NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint NOT NULL,
  `to_id` bigint NOT NULL,
  `body` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (2241617054,'user',3,5,';ljpoj',NULL,0,'2021-06-15 07:50:53','2021-06-15 07:50:53'),(2292950127,'user',3,5,'','5b9a44ee-99f2-42a4-b9fd-cad4c528e54b.jpg,1.jpg',0,'2021-06-17 06:17:29','2021-06-17 06:17:29'),(2387466572,'user',3,2,'Test',NULL,0,'2021-06-18 07:48:34','2021-06-18 07:48:34');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_09_22_192348_create_messages_table',1),(5,'2019_09_28_102009_create_settings_table',1),(6,'2019_10_16_211433_create_favorites_table',1),(7,'2019_10_18_223259_add_avatar_to_users',1),(8,'2019_10_20_211056_add_messenger_color_to_users',1),(9,'2019_10_22_000539_add_dark_mode_to_users',1),(10,'2019_10_25_214038_add_active_status_to_users',1),(11,'2019_12_26_101754_create_departments_table',1),(12,'2019_12_26_101814_create_designations_table',1),(13,'2019_12_26_105721_create_documents_table',1),(14,'2019_12_27_083751_create_branches_table',1),(15,'2019_12_27_090831_create_employees_table',1),(16,'2019_12_27_112922_create_employee_documents_table',1),(17,'2019_12_28_050508_create_awards_table',1),(18,'2019_12_28_050919_create_award_types_table',1),(19,'2019_12_31_060916_create_termination_types_table',1),(20,'2019_12_31_062259_create_terminations_table',1),(21,'2019_12_31_070521_create_resignations_table',1),(22,'2019_12_31_072252_create_travels_table',1),(23,'2019_12_31_090637_create_promotions_table',1),(24,'2019_12_31_092838_create_transfers_table',1),(25,'2019_12_31_100319_create_warnings_table',1),(26,'2019_12_31_103019_create_complaints_table',1),(27,'2020_01_02_090837_create_payslip_types_table',1),(28,'2020_01_02_093331_create_allowance_options_table',1),(29,'2020_01_02_102558_create_loan_options_table',1),(30,'2020_01_02_103822_create_deduction_options_table',1),(31,'2020_01_02_110828_create_genrate_payslip_options_table',1),(32,'2020_01_02_111807_create_set_salaries_table',1),(33,'2020_01_03_084302_create_allowances_table',1),(34,'2020_01_03_101735_create_commissions_table',1),(35,'2020_01_03_105019_create_loans_table',1),(36,'2020_01_03_105046_create_saturation_deductions_table',1),(37,'2020_01_03_105100_create_other_payments_table',1),(38,'2020_01_03_105111_create_overtimes_table',1),(39,'2020_01_04_072527_create_pay_slips_table',1),(40,'2020_01_06_045425_create_account_lists_table',1),(41,'2020_01_06_062213_create_payees_table',1),(42,'2020_01_06_070037_create_payers_table',1),(43,'2020_01_06_072939_create_income_types_table',1),(44,'2020_01_06_073055_create_expense_types_table',1),(45,'2020_01_06_085218_create_deposits_table',1),(46,'2020_01_06_090709_create_payment_types_table',1),(47,'2020_01_06_121442_create_expenses_table',1),(48,'2020_01_06_124036_create_transfer_balances_table',1),(49,'2020_01_13_084720_create_events_table',1),(50,'2020_01_16_041720_create_announcements_table',1),(51,'2020_01_16_090747_create_leave_types_table',1),(52,'2020_01_16_093256_create_leaves_table',1),(53,'2020_01_16_110357_create_meetings_table',1),(54,'2020_01_17_051906_create_tickets_table',1),(55,'2020_01_17_112647_create_ticket_replies_table',1),(56,'2020_01_23_101613_create_meeting_employees_table',1),(57,'2020_01_23_123844_create_event_employees_table',1),(58,'2020_01_24_062752_create_announcement_employees_table',1),(59,'2020_01_27_052503_create_attendance_employees_table',1),(60,'2020_02_17_035047_create_plans_table',1),(61,'2020_02_17_072503_create_orders_table',1),(62,'2020_02_28_051636_create_time_sheets_table',1),(63,'2020_03_12_095629_create_coupons_table',1),(64,'2020_03_12_120749_create_user_coupons_table',1),(65,'2020_04_21_115823_create_assets_table',1),(66,'2020_05_01_122144_create_ducument_uploads_table',1),(67,'2020_05_04_070452_create_indicators_table',1),(68,'2020_05_05_023742_create_appraisals_table',1),(69,'2020_05_05_061241_create_goal_types_table',1),(70,'2020_05_05_095926_create_goal_trackings_table',1),(71,'2020_05_07_093520_create_company_policies_table',1),(72,'2020_05_07_131311_create_training_types_table',1),(73,'2020_05_08_023838_create_trainers_table',1),(74,'2020_05_08_043039_create_trainings_table',1),(75,'2020_05_21_065337_create_permission_tables',1),(76,'2020_07_06_102454_add_payment_type_in_orders_table',1),(77,'2020_07_18_065859_create_messageses_table',1),(78,'2020_07_22_131715_change_amount_type_size',1),(79,'2020_10_07_034726_create_holidays_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\User',1),(2,'App\\User',2),(3,'App\\User',3),(4,'App\\User',5),(4,'App\\User',6),(4,'App\\User',7),(4,'App\\User',8),(3,'App\\User',9),(3,'App\\User',12),(3,'App\\User',13),(3,'App\\User',14),(3,'App\\User',15),(3,'App\\User',16),(2,'App\\User',18);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nationality`
--

DROP TABLE IF EXISTS `nationality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nationality` (
  `num_code` int NOT NULL DEFAULT '0',
  `alpha_2_code` varchar(2) DEFAULT NULL,
  `alpha_3_code` varchar(3) DEFAULT NULL,
  `en_short_name` varchar(52) DEFAULT NULL,
  `nationality` varchar(39) DEFAULT NULL,
  PRIMARY KEY (`num_code`),
  UNIQUE KEY `alpha_2_code` (`alpha_2_code`),
  UNIQUE KEY `alpha_3_code` (`alpha_3_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nationality`
--

LOCK TABLES `nationality` WRITE;
/*!40000 ALTER TABLE `nationality` DISABLE KEYS */;
INSERT INTO `nationality` VALUES (4,'AF','AFG','Afghanistan','Afghan'),(8,'AL','ALB','Albania','Albanian'),(10,'AQ','ATA','Antarctica','Antarctic'),(12,'DZ','DZA','Algeria','Algerian'),(16,'AS','ASM','American Samoa','American Samoan'),(20,'AD','AND','Andorra','Andorran'),(24,'AO','AGO','Angola','Angolan'),(28,'AG','ATG','Antigua and Barbuda','Antiguan or Barbudan'),(31,'AZ','AZE','Azerbaijan','Azerbaijani, Azeri'),(32,'AR','ARG','Argentina','Argentine'),(36,'AU','AUS','Australia','Australian'),(40,'AT','AUT','Austria','Austrian'),(44,'BS','BHS','Bahamas','Bahamian'),(48,'BH','BHR','Bahrain','Bahraini'),(50,'BD','BGD','Bangladesh','Bangladeshi'),(51,'AM','ARM','Armenia','Armenian'),(52,'BB','BRB','Barbados','Barbadian'),(56,'BE','BEL','Belgium','Belgian'),(60,'BM','BMU','Bermuda','Bermudian, Bermudan'),(64,'BT','BTN','Bhutan','Bhutanese'),(68,'BO','BOL','Bolivia (Plurinational State of)','Bolivian'),(70,'BA','BIH','Bosnia and Herzegovina','Bosnian or Herzegovinian'),(72,'BW','BWA','Botswana','Motswana, Botswanan'),(74,'BV','BVT','Bouvet Island','Bouvet Island'),(76,'BR','BRA','Brazil','Brazilian'),(84,'BZ','BLZ','Belize','Belizean'),(86,'IO','IOT','British Indian Ocean Territory','BIOT'),(90,'SB','SLB','Solomon Islands','Solomon Island'),(92,'VG','VGB','Virgin Islands (British)','British Virgin Island'),(96,'BN','BRN','Brunei Darussalam','Bruneian'),(100,'BG','BGR','Bulgaria','Bulgarian'),(104,'MM','MMR','Myanmar','Burmese'),(108,'BI','BDI','Burundi','Burundian'),(112,'BY','BLR','Belarus','Belarusian'),(116,'KH','KHM','Cambodia','Cambodian'),(120,'CM','CMR','Cameroon','Cameroonian'),(124,'CA','CAN','Canada','Canadian'),(132,'CV','CPV','Cabo Verde','Cabo Verdean'),(136,'KY','CYM','Cayman Islands','Caymanian'),(140,'CF','CAF','Central African Republic','Central African'),(144,'LK','LKA','Sri Lanka','Sri Lankan'),(148,'TD','TCD','Chad','Chadian'),(152,'CL','CHL','Chile','Chilean'),(156,'CN','CHN','China','Chinese'),(158,'TW','TWN','Taiwan, Province of China','Chinese, Taiwanese'),(162,'CX','CXR','Christmas Island','Christmas Island'),(166,'CC','CCK','Cocos (Keeling) Islands','Cocos Island'),(170,'CO','COL','Colombia','Colombian'),(174,'KM','COM','Comoros','Comoran, Comorian'),(175,'YT','MYT','Mayotte','Mahoran'),(178,'CG','COG','Congo (Republic of the)','Congolese'),(180,'CD','COD','Congo (Democratic Republic of the)','Congolese'),(184,'CK','COK','Cook Islands','Cook Island'),(188,'CR','CRI','Costa Rica','Costa Rican'),(191,'HR','HRV','Croatia','Croatian'),(192,'CU','CUB','Cuba','Cuban'),(196,'CY','CYP','Cyprus','Cypriot'),(203,'CZ','CZE','Czech Republic','Czech'),(204,'BJ','BEN','Benin','Beninese, Beninois'),(208,'DK','DNK','Denmark','Danish'),(212,'DM','DMA','Dominica','Dominican'),(214,'DO','DOM','Dominican Republic','Dominican'),(218,'EC','ECU','Ecuador','Ecuadorian'),(222,'SV','SLV','El Salvador','Salvadoran'),(226,'GQ','GNQ','Equatorial Guinea','Equatorial Guinean, Equatoguinean'),(231,'ET','ETH','Ethiopia','Ethiopian'),(232,'ER','ERI','Eritrea','Eritrean'),(233,'EE','EST','Estonia','Estonian'),(234,'FO','FRO','Faroe Islands','Faroese'),(238,'FK','FLK','Falkland Islands (Malvinas)','Falkland Island'),(239,'GS','SGS','South Georgia and the South Sandwich Islands','South Georgia or South Sandwich Islands'),(242,'FJ','FJI','Fiji','Fijian'),(246,'FI','FIN','Finland','Finnish'),(248,'AX','ALA','Ã…land Islands','Ã…land Island'),(250,'FR','FRA','France','French'),(254,'GF','GUF','French Guiana','French Guianese'),(258,'PF','PYF','French Polynesia','French Polynesian'),(260,'TF','ATF','French Southern Territories','French Southern Territories'),(262,'DJ','DJI','Djibouti','Djiboutian'),(266,'GA','GAB','Gabon','Gabonese'),(268,'GE','GEO','Georgia','Georgian'),(270,'GM','GMB','Gambia','Gambian'),(275,'PS','PSE','Palestine, State of','Palestinian'),(276,'DE','DEU','Germany','German'),(288,'GH','GHA','Ghana','Ghanaian'),(292,'GI','GIB','Gibraltar','Gibraltar'),(296,'KI','KIR','Kiribati','I-Kiribati'),(300,'GR','GRC','Greece','Greek, Hellenic'),(304,'GL','GRL','Greenland','Greenlandic'),(308,'GD','GRD','Grenada','Grenadian'),(312,'GP','GLP','Guadeloupe','Guadeloupe'),(316,'GU','GUM','Guam','Guamanian, Guambat'),(320,'GT','GTM','Guatemala','Guatemalan'),(324,'GN','GIN','Guinea','Guinean'),(328,'GY','GUY','Guyana','Guyanese'),(332,'HT','HTI','Haiti','Haitian'),(334,'HM','HMD','Heard Island and McDonald Islands','Heard Island or McDonald Islands'),(336,'VA','VAT','Vatican City State','Vatican'),(340,'HN','HND','Honduras','Honduran'),(344,'HK','HKG','Hong Kong','Hong Kong, Hong Kongese'),(348,'HU','HUN','Hungary','Hungarian, Magyar'),(352,'IS','ISL','Iceland','Icelandic'),(356,'IN','IND','India','Indian'),(360,'ID','IDN','Indonesia','Indonesian'),(364,'IR','IRN','Iran','Iranian, Persian'),(368,'IQ','IRQ','Iraq','Iraqi'),(372,'IE','IRL','Ireland','Irish'),(376,'IL','ISR','Israel','Israeli'),(380,'IT','ITA','Italy','Italian'),(384,'CI','CIV','CÃ´te d\'Ivoire','Ivorian'),(388,'JM','JAM','Jamaica','Jamaican'),(392,'JP','JPN','Japan','Japanese'),(398,'KZ','KAZ','Kazakhstan','Kazakhstani, Kazakh'),(400,'JO','JOR','Jordan','Jordanian'),(404,'KE','KEN','Kenya','Kenyan'),(408,'KP','PRK','Korea (Democratic People\'s Republic of)','North Korean'),(410,'KR','KOR','Korea (Republic of)','South Korean'),(414,'KW','KWT','Kuwait','Kuwaiti'),(417,'KG','KGZ','Kyrgyzstan','Kyrgyzstani, Kyrgyz, Kirgiz, Kirghiz'),(418,'LA','LAO','Lao People\'s Democratic Republic','Lao, Laotian'),(422,'LB','LBN','Lebanon','Lebanese'),(426,'LS','LSO','Lesotho','Basotho'),(428,'LV','LVA','Latvia','Latvian'),(430,'LR','LBR','Liberia','Liberian'),(434,'LY','LBY','Libya','Libyan'),(438,'LI','LIE','Liechtenstein','Liechtenstein'),(440,'LT','LTU','Lithuania','Lithuanian'),(442,'LU','LUX','Luxembourg','Luxembourg, Luxembourgish'),(446,'MO','MAC','Macao','Macanese, Chinese'),(450,'MG','MDG','Madagascar','Malagasy'),(454,'MW','MWI','Malawi','Malawian'),(458,'MY','MYS','Malaysia','Malaysian'),(462,'MV','MDV','Maldives','Maldivian'),(466,'ML','MLI','Mali','Malian, Malinese'),(470,'MT','MLT','Malta','Maltese'),(474,'MQ','MTQ','Martinique','Martiniquais, Martinican'),(478,'MR','MRT','Mauritania','Mauritanian'),(480,'MU','MUS','Mauritius','Mauritian'),(484,'MX','MEX','Mexico','Mexican'),(492,'MC','MCO','Monaco','MonÃ©gasque, Monacan'),(496,'MN','MNG','Mongolia','Mongolian'),(498,'MD','MDA','Moldova (Republic of)','Moldovan'),(499,'ME','MNE','Montenegro','Montenegrin'),(500,'MS','MSR','Montserrat','Montserratian'),(504,'MA','MAR','Morocco','Moroccan'),(508,'MZ','MOZ','Mozambique','Mozambican'),(512,'OM','OMN','Oman','Omani'),(516,'NA','NAM','Namibia','Namibian'),(520,'NR','NRU','Nauru','Nauruan'),(524,'NP','NPL','Nepal','Nepali, Nepalese'),(528,'NL','NLD','Netherlands','Dutch, Netherlandic'),(531,'CW','CUW','CuraÃ§ao','CuraÃ§aoan'),(533,'AW','ABW','Aruba','Aruban'),(534,'SX','SXM','Sint Maarten (Dutch part)','Sint Maarten'),(535,'BQ','BES','Bonaire, Sint Eustatius and Saba','Bonaire'),(540,'NC','NCL','New Caledonia','New Caledonian'),(548,'VU','VUT','Vanuatu','Ni-Vanuatu, Vanuatuan'),(554,'NZ','NZL','New Zealand','New Zealand, NZ'),(558,'NI','NIC','Nicaragua','Nicaraguan'),(562,'NE','NER','Niger','Nigerien'),(566,'NG','NGA','Nigeria','Nigerian'),(570,'NU','NIU','Niue','Niuean'),(574,'NF','NFK','Norfolk Island','Norfolk Island'),(578,'NO','NOR','Norway','Norwegian'),(580,'MP','MNP','Northern Mariana Islands','Northern Marianan'),(581,'UM','UMI','United States Minor Outlying Islands','American'),(583,'FM','FSM','Micronesia (Federated States of)','Micronesian'),(584,'MH','MHL','Marshall Islands','Marshallese'),(585,'PW','PLW','Palau','Palauan'),(586,'PK','PAK','Pakistan','Pakistani'),(591,'PA','PAN','Panama','Panamanian'),(598,'PG','PNG','Papua New Guinea','Papua New Guinean, Papuan'),(600,'PY','PRY','Paraguay','Paraguayan'),(604,'PE','PER','Peru','Peruvian'),(608,'PH','PHL','Philippines','Philippine, Filipino'),(612,'PN','PCN','Pitcairn','Pitcairn Island'),(616,'PL','POL','Poland','Polish'),(620,'PT','PRT','Portugal','Portuguese'),(624,'GW','GNB','Guinea-Bissau','Bissau-Guinean'),(626,'TL','TLS','Timor-Leste','Timorese'),(630,'PR','PRI','Puerto Rico','Puerto Rican'),(634,'QA','QAT','Qatar','Qatari'),(638,'RE','REU','RÃ©union','RÃ©unionese, RÃ©unionnais'),(642,'RO','ROU','Romania','Romanian'),(643,'RU','RUS','Russian Federation','Russian'),(646,'RW','RWA','Rwanda','Rwandan'),(652,'BL','BLM','Saint BarthÃ©lemy','BarthÃ©lemois'),(654,'SH','SHN','Saint Helena, Ascension and Tristan da Cunha','Saint Helenian'),(659,'KN','KNA','Saint Kitts and Nevis','Kittitian or Nevisian'),(660,'AI','AIA','Anguilla','Anguillan'),(662,'LC','LCA','Saint Lucia','Saint Lucian'),(663,'MF','MAF','Saint Martin (French part)','Saint-Martinoise'),(666,'PM','SPM','Saint Pierre and Miquelon','Saint-Pierrais or Miquelonnais'),(670,'VC','VCT','Saint Vincent and the Grenadines','Saint Vincentian, Vincentian'),(674,'SM','SMR','San Marino','Sammarinese'),(678,'ST','STP','Sao Tome and Principe','SÃ£o TomÃ©an'),(682,'SA','SAU','Saudi Arabia','Saudi, Saudi Arabian'),(686,'SN','SEN','Senegal','Senegalese'),(688,'RS','SRB','Serbia','Serbian'),(690,'SC','SYC','Seychelles','Seychellois'),(694,'SL','SLE','Sierra Leone','Sierra Leonean'),(702,'SG','SGP','Singapore','Singaporean'),(703,'SK','SVK','Slovakia','Slovak'),(704,'VN','VNM','Vietnam','Vietnamese'),(705,'SI','SVN','Slovenia','Slovenian, Slovene'),(706,'SO','SOM','Somalia','Somali, Somalian'),(710,'ZA','ZAF','South Africa','South African'),(716,'ZW','ZWE','Zimbabwe','Zimbabwean'),(724,'ES','ESP','Spain','Spanish'),(728,'SS','SSD','South Sudan','South Sudanese'),(729,'SD','SDN','Sudan','Sudanese'),(732,'EH','ESH','Western Sahara','Sahrawi, Sahrawian, Sahraouian'),(740,'SR','SUR','Suriname','Surinamese'),(744,'SJ','SJM','Svalbard and Jan Mayen','Svalbard'),(748,'SZ','SWZ','Swaziland','Swazi'),(752,'SE','SWE','Sweden','Swedish'),(756,'CH','CHE','Switzerland','Swiss'),(760,'SY','SYR','Syrian Arab Republic','Syrian'),(762,'TJ','TJK','Tajikistan','Tajikistani'),(764,'TH','THA','Thailand','Thai'),(768,'TG','TGO','Togo','Togolese'),(772,'TK','TKL','Tokelau','Tokelauan'),(776,'TO','TON','Tonga','Tongan'),(780,'TT','TTO','Trinidad and Tobago','Trinidadian or Tobagonian'),(784,'AE','ARE','United Arab Emirates','Emirati, Emirian, Emiri'),(788,'TN','TUN','Tunisia','Tunisian'),(792,'TR','TUR','Turkey','Turkish'),(795,'TM','TKM','Turkmenistan','Turkmen'),(796,'TC','TCA','Turks and Caicos Islands','Turks and Caicos Island'),(798,'TV','TUV','Tuvalu','Tuvaluan'),(800,'UG','UGA','Uganda','Ugandan'),(804,'UA','UKR','Ukraine','Ukrainian'),(807,'MK','MKD','Macedonia (the former Yugoslav Republic of)','Macedonian'),(818,'EG','EGY','Egypt','Egyptian'),(826,'GB','GBR','United Kingdom of Great Britain and Northern Ireland','British, UK'),(831,'GG','GGY','Guernsey','Channel Island'),(832,'JE','JEY','Jersey','Channel Island'),(833,'IM','IMN','Isle of Man','Manx'),(834,'TZ','TZA','Tanzania, United Republic of','Tanzanian'),(840,'US','USA','United States of America','American'),(850,'VI','VIR','Virgin Islands (U.S.)','U.S. Virgin Island'),(854,'BF','BFA','Burkina Faso','BurkinabÃ©'),(858,'UY','URY','Uruguay','Uruguayan'),(860,'UZ','UZB','Uzbekistan','Uzbekistani, Uzbek'),(862,'VE','VEN','Venezuela (Bolivarian Republic of)','Venezuelan'),(876,'WF','WLF','Wallis and Futuna','Wallis and Futuna, Wallisian or Futunan'),(882,'WS','WSM','Samoa','Samoan'),(887,'YE','YEM','Yemen','Yemeni'),(894,'ZM','ZMB','Zambia','Zambian');
/*!40000 ALTER TABLE `nationality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_number` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_exp_month` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_exp_year` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_id` int NOT NULL,
  `price` double(8,2) NOT NULL,
  `price_currency` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `txn_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Manually',
  `receipt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_id_unique` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `other_payments`
--

DROP TABLE IF EXISTS `other_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `other_payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `other_payments`
--

LOCK TABLES `other_payments` WRITE;
/*!40000 ALTER TABLE `other_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `other_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `overtimes`
--

DROP TABLE IF EXISTS `overtimes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `overtimes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_days` int NOT NULL,
  `hours` int NOT NULL,
  `rate` int NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `overtimes`
--

LOCK TABLES `overtimes` WRITE;
/*!40000 ALTER TABLE `overtimes` DISABLE KEYS */;
/*!40000 ALTER TABLE `overtimes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_slips`
--

DROP TABLE IF EXISTS `pay_slips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_slips` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `net_payble` int NOT NULL,
  `salary_month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `basic_salary` int NOT NULL,
  `allowance` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `saturation_deduction` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_payment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `overtime` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_slips`
--

LOCK TABLES `pay_slips` WRITE;
/*!40000 ALTER TABLE `pay_slips` DISABLE KEYS */;
INSERT INTO `pay_slips` VALUES (1,2,556,'06',0,556,'0','0','0','0','0','0',2,'2021-07-01 02:00:46','2021-07-01 02:00:46'),(2,3,533,'06',0,533,'0','0','0','0','0','0',2,'2021-07-01 02:00:46','2021-07-01 02:00:46'),(3,4,333,'06',0,333,'0','0','0','0','0','0',2,'2021-07-01 02:00:46','2021-07-01 02:00:46'),(4,5,222,'06',0,222,'0','0','0','0','0','0',2,'2021-07-01 02:00:46','2021-07-01 02:00:46'),(5,2,556,'05',0,556,'0','0','0','0','0','0',2,'2021-07-01 02:24:45','2021-07-01 02:24:45'),(6,3,533,'05',0,533,'0','0','0','0','0','0',2,'2021-07-01 02:24:45','2021-07-01 02:24:45'),(7,4,333,'05',0,333,'0','0','0','0','0','0',2,'2021-07-01 02:24:45','2021-07-01 02:24:45'),(8,5,222,'05',0,222,'0','0','0','0','0','0',2,'2021-07-01 02:24:46','2021-07-01 02:24:46'),(9,2,556,'01',0,556,'0','0','0','0','0','0',2,'2021-07-01 02:37:49','2021-07-01 02:37:49'),(10,3,533,'01',0,533,'0','0','0','0','0','0',2,'2021-07-01 02:37:50','2021-07-01 02:37:50'),(11,4,333,'01',0,333,'0','0','0','0','0','0',2,'2021-07-01 02:37:50','2021-07-01 02:37:50'),(12,5,222,'01',0,222,'0','0','0','0','0','0',2,'2021-07-01 02:37:50','2021-07-01 02:37:50'),(13,2,556,'01',0,556,'0','0','0','0','0','0',2,'2021-07-01 02:41:49','2021-07-01 02:41:49'),(14,3,533,'01',0,533,'0','0','0','0','0','0',2,'2021-07-01 02:41:50','2021-07-01 02:41:50'),(15,4,333,'01',0,333,'0','0','0','0','0','0',2,'2021-07-01 02:41:50','2021-07-01 02:41:50'),(16,5,222,'01',0,222,'0','0','0','0','0','0',2,'2021-07-01 02:41:50','2021-07-01 02:41:50'),(17,2,556,'02',0,556,'0','0','0','0','0','0',2,'2021-07-01 02:56:12','2021-07-01 02:56:12'),(18,3,533,'02',0,533,'0','0','0','0','0','0',2,'2021-07-01 02:56:12','2021-07-01 02:56:12'),(19,4,333,'02',0,333,'0','0','0','0','0','0',2,'2021-07-01 02:56:13','2021-07-01 02:56:13'),(20,5,222,'02',0,222,'0','0','0','0','0','0',2,'2021-07-01 02:56:13','2021-07-01 02:56:13'),(21,2,556,'01',0,556,'0','0','0','0','0','0',2,'2021-07-02 01:15:24','2021-07-02 01:15:24'),(22,3,533,'01',0,533,'0','0','0','0','0','0',2,'2021-07-02 01:15:25','2021-07-02 01:15:25'),(23,4,333,'01',0,333,'0','0','0','0','0','0',2,'2021-07-02 01:15:25','2021-07-02 01:15:25'),(24,5,222,'01',0,222,'0','0','0','0','0','0',2,'2021-07-02 01:15:25','2021-07-02 01:15:25'),(25,2,556,'06',0,556,'0','0','0','0','0','0',2,'2021-07-02 01:16:26','2021-07-02 01:16:26'),(26,3,533,'06',0,533,'0','0','0','0','0','0',2,'2021-07-02 01:16:26','2021-07-02 01:16:26'),(27,4,333,'06',0,333,'0','0','0','0','0','0',2,'2021-07-02 01:16:26','2021-07-02 01:16:26'),(28,5,222,'06',0,222,'0','0','0','0','0','0',2,'2021-07-02 01:16:26','2021-07-02 01:16:26'),(29,2,556,'03',0,556,'0','0','0','0','0','0',2,'2021-07-02 01:19:06','2021-07-02 01:19:06'),(30,3,533,'03',0,533,'0','0','0','0','0','0',2,'2021-07-02 01:19:06','2021-07-02 01:19:06'),(31,4,333,'03',0,333,'0','0','0','0','0','0',2,'2021-07-02 01:19:06','2021-07-02 01:19:06'),(32,5,222,'03',0,222,'0','0','0','0','0','0',2,'2021-07-02 01:19:06','2021-07-02 01:19:06'),(33,2,556,'06',0,556,'0','0','0','0','0','0',2,'2021-07-12 01:47:09','2021-07-12 01:47:09'),(34,3,533,'06',0,533,'0','0','0','0','0','0',2,'2021-07-12 01:47:09','2021-07-12 01:47:09'),(35,4,333,'06',0,333,'0','0','0','0','0','0',2,'2021-07-12 01:47:09','2021-07-12 01:47:09'),(36,5,222,'06',0,222,'0','0','0','0','0','0',2,'2021-07-12 01:47:09','2021-07-12 01:47:09'),(37,2,556,'01',0,556,'0','0','0','0','0','0',2,'2021-08-23 05:28:47','2021-08-23 05:28:47'),(38,3,533,'01',0,533,'0','0','0','0','0','0',2,'2021-08-23 05:28:47','2021-08-23 05:28:47'),(39,4,333,'01',0,333,'0','0','0','0','0','0',2,'2021-08-23 05:28:47','2021-08-23 05:28:47'),(40,5,222,'01',0,222,'0','0','0','0','0','0',2,'2021-08-23 05:28:47','2021-08-23 05:28:47'),(41,2,556,'01',0,556,'0','0','0','0','0','0',2,'2021-08-23 05:29:11','2021-08-23 05:29:11'),(42,3,533,'01',0,533,'0','0','0','0','0','0',2,'2021-08-23 05:29:11','2021-08-23 05:29:11'),(43,4,333,'01',0,333,'0','0','0','0','0','0',2,'2021-08-23 05:29:11','2021-08-23 05:29:11'),(44,5,222,'01',0,222,'0','0','0','0','0','0',2,'2021-08-23 05:29:12','2021-08-23 05:29:12'),(45,2,556,'01',0,556,'0','0','0','0','0','0',2,'2021-08-23 05:29:15','2021-08-23 05:29:15'),(46,3,533,'01',0,533,'0','0','0','0','0','0',2,'2021-08-23 05:29:16','2021-08-23 05:29:16'),(47,4,333,'01',0,333,'0','0','0','0','0','0',2,'2021-08-23 05:29:16','2021-08-23 05:29:16'),(48,5,222,'01',0,222,'0','0','0','0','0','0',2,'2021-08-23 05:29:16','2021-08-23 05:29:16'),(49,2,556,'01',0,556,'0','0','0','0','0','0',2,'2021-08-23 05:29:28','2021-08-23 05:29:28'),(50,3,533,'01',0,533,'0','0','0','0','0','0',2,'2021-08-23 05:29:28','2021-08-23 05:29:28'),(51,4,333,'01',0,333,'0','0','0','0','0','0',2,'2021-08-23 05:29:28','2021-08-23 05:29:28'),(52,5,222,'01',0,222,'0','0','0','0','0','0',2,'2021-08-23 05:29:28','2021-08-23 05:29:28'),(53,2,556,'07',0,556,'0','0','0','0','0','0',2,'2021-08-23 05:30:59','2021-08-23 05:30:59'),(54,3,533,'07',0,533,'0','0','0','0','0','0',2,'2021-08-23 05:30:59','2021-08-23 05:30:59'),(55,4,333,'07',0,333,'0','0','0','0','0','0',2,'2021-08-23 05:30:59','2021-08-23 05:30:59'),(56,5,222,'07',0,222,'0','0','0','0','0','0',2,'2021-08-23 05:31:00','2021-08-23 05:31:00');
/*!40000 ALTER TABLE `pay_slips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payees`
--

DROP TABLE IF EXISTS `payees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `payee_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payees`
--

LOCK TABLES `payees` WRITE;
/*!40000 ALTER TABLE `payees` DISABLE KEYS */;
/*!40000 ALTER TABLE `payees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payers`
--

DROP TABLE IF EXISTS `payers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `payer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payers`
--

LOCK TABLES `payers` WRITE;
/*!40000 ALTER TABLE `payers` DISABLE KEYS */;
/*!40000 ALTER TABLE `payers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_types`
--

DROP TABLE IF EXISTS `payment_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_types`
--

LOCK TABLES `payment_types` WRITE;
/*!40000 ALTER TABLE `payment_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payslip_allownces`
--

DROP TABLE IF EXISTS `payslip_allownces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payslip_allownces` (
  `id` int NOT NULL AUTO_INCREMENT,
  `payslip_id` int NOT NULL,
  `emp_id` int NOT NULL,
  `allow_type` tinyint DEFAULT NULL COMMENT '1= increament,2=deduction',
  `allow_name` varchar(100) NOT NULL,
  `allow_value` double(10,2) NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payslip_allownces`
--

LOCK TABLES `payslip_allownces` WRITE;
/*!40000 ALTER TABLE `payslip_allownces` DISABLE KEYS */;
/*!40000 ALTER TABLE `payslip_allownces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payslip_types`
--

DROP TABLE IF EXISTS `payslip_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payslip_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payslip_types`
--

LOCK TABLES `payslip_types` WRITE;
/*!40000 ALTER TABLE `payslip_types` DISABLE KEYS */;
INSERT INTO `payslip_types` VALUES (1,'Test',2,'2021-06-29 02:56:13','2021-06-29 02:56:13');
/*!40000 ALTER TABLE `payslip_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=268 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Manage User','web','2020-12-06 16:46:02','2020-12-06 16:46:02'),(2,'Create User','web','2020-12-06 16:46:02','2020-12-06 16:46:02'),(3,'Edit User','web','2020-12-06 16:46:02','2020-12-06 16:46:02'),(4,'Delete User','web','2020-12-06 16:46:02','2020-12-06 16:46:02'),(5,'Manage Role','web','2020-12-06 16:46:02','2020-12-06 16:46:02'),(6,'Create Role','web','2020-12-06 16:46:02','2020-12-06 16:46:02'),(7,'Delete Role','web','2020-12-06 16:46:02','2020-12-06 16:46:02'),(8,'Edit Role','web','2020-12-06 16:46:03','2020-12-06 16:46:03'),(9,'Manage Award','web','2020-12-06 16:46:03','2020-12-06 16:46:03'),(10,'Create Award','web','2020-12-06 16:46:03','2020-12-06 16:46:03'),(11,'Delete Award','web','2020-12-06 16:46:03','2020-12-06 16:46:03'),(12,'Edit Award','web','2020-12-06 16:46:03','2020-12-06 16:46:03'),(13,'Manage Transfer','web','2020-12-06 16:46:03','2020-12-06 16:46:03'),(14,'Create Transfer','web','2020-12-06 16:46:03','2020-12-06 16:46:03'),(15,'Delete Transfer','web','2020-12-06 16:46:03','2020-12-06 16:46:03'),(16,'Edit Transfer','web','2020-12-06 16:46:03','2020-12-06 16:46:03'),(17,'Manage Resignation','web','2020-12-06 16:46:03','2020-12-06 16:46:03'),(18,'Create Resignation','web','2020-12-06 16:46:03','2020-12-06 16:46:03'),(19,'Edit Resignation','web','2020-12-06 16:46:03','2020-12-06 16:46:03'),(20,'Delete Resignation','web','2020-12-06 16:46:03','2020-12-06 16:46:03'),(21,'Manage Travel','web','2020-12-06 16:46:03','2020-12-06 16:46:03'),(22,'Create Travel','web','2020-12-06 16:46:03','2020-12-06 16:46:03'),(23,'Edit Travel','web','2020-12-06 16:46:03','2020-12-06 16:46:03'),(24,'Delete Travel','web','2020-12-06 16:46:03','2020-12-06 16:46:03'),(25,'Manage Promotion','web','2020-12-06 16:46:03','2020-12-06 16:46:03'),(26,'Create Promotion','web','2020-12-06 16:46:04','2020-12-06 16:46:04'),(27,'Edit Promotion','web','2020-12-06 16:46:04','2020-12-06 16:46:04'),(28,'Delete Promotion','web','2020-12-06 16:46:04','2020-12-06 16:46:04'),(29,'Manage Complaint','web','2020-12-06 16:46:04','2020-12-06 16:46:04'),(30,'Create Complaint','web','2020-12-06 16:46:04','2020-12-06 16:46:04'),(31,'Edit Complaint','web','2020-12-06 16:46:04','2020-12-06 16:46:04'),(32,'Delete Complaint','web','2020-12-06 16:46:04','2020-12-06 16:46:04'),(33,'Manage Warning','web','2020-12-06 16:46:04','2020-12-06 16:46:04'),(34,'Create Warning','web','2020-12-06 16:46:04','2020-12-06 16:46:04'),(35,'Edit Warning','web','2020-12-06 16:46:04','2020-12-06 16:46:04'),(36,'Delete Warning','web','2020-12-06 16:46:04','2020-12-06 16:46:04'),(37,'Manage Termination','web','2020-12-06 16:46:04','2020-12-06 16:46:04'),(38,'Create Termination','web','2020-12-06 16:46:04','2020-12-06 16:46:04'),(39,'Edit Termination','web','2020-12-06 16:46:04','2020-12-06 16:46:04'),(40,'Delete Termination','web','2020-12-06 16:46:04','2020-12-06 16:46:04'),(41,'Manage Department','web','2020-12-06 16:46:05','2020-12-06 16:46:05'),(42,'Create Department','web','2020-12-06 16:46:05','2020-12-06 16:46:05'),(43,'Edit Department','web','2020-12-06 16:46:05','2020-12-06 16:46:05'),(44,'Delete Department','web','2020-12-06 16:46:05','2020-12-06 16:46:05'),(45,'Manage Designation','web','2020-12-06 16:46:05','2020-12-06 16:46:05'),(46,'Create Designation','web','2020-12-06 16:46:05','2020-12-06 16:46:05'),(47,'Edit Designation','web','2020-12-06 16:46:05','2020-12-06 16:46:05'),(48,'Delete Designation','web','2020-12-06 16:46:05','2020-12-06 16:46:05'),(49,'Manage Document Type','web','2020-12-06 16:46:05','2020-12-06 16:46:05'),(50,'Create Document Type','web','2020-12-06 16:46:05','2020-12-06 16:46:05'),(51,'Edit Document Type','web','2020-12-06 16:46:05','2020-12-06 16:46:05'),(52,'Delete Document Type','web','2020-12-06 16:46:05','2020-12-06 16:46:05'),(53,'Manage Branch','web','2020-12-06 16:46:05','2020-12-06 16:46:05'),(54,'Create Branch','web','2020-12-06 16:46:05','2020-12-06 16:46:05'),(55,'Edit Branch','web','2020-12-06 16:46:05','2020-12-06 16:46:05'),(56,'Delete Branch','web','2020-12-06 16:46:05','2020-12-06 16:46:05'),(57,'Manage Award Type','web','2020-12-06 16:46:06','2020-12-06 16:46:06'),(58,'Create Award Type','web','2020-12-06 16:46:06','2020-12-06 16:46:06'),(59,'Edit Award Type','web','2020-12-06 16:46:06','2020-12-06 16:46:06'),(60,'Delete Award Type','web','2020-12-06 16:46:06','2020-12-06 16:46:06'),(61,'Manage Termination Type','web','2020-12-06 16:46:06','2020-12-06 16:46:06'),(62,'Create Termination Type','web','2020-12-06 16:46:06','2020-12-06 16:46:06'),(63,'Edit Termination Type','web','2020-12-06 16:46:06','2020-12-06 16:46:06'),(64,'Delete Termination Type','web','2020-12-06 16:46:06','2020-12-06 16:46:06'),(65,'Manage Employee','web','2020-12-06 16:46:06','2020-12-06 16:46:06'),(66,'Create Employee','web','2020-12-06 16:46:06','2020-12-06 16:46:06'),(67,'Edit Employee','web','2020-12-06 16:46:06','2020-12-06 16:46:06'),(68,'Delete Employee','web','2020-12-06 16:46:07','2020-12-06 16:46:07'),(69,'Show Employee','web','2020-12-06 16:46:07','2020-12-06 16:46:07'),(70,'Manage Payslip Type','web','2020-12-06 16:46:07','2020-12-06 16:46:07'),(71,'Create Payslip Type','web','2020-12-06 16:46:07','2020-12-06 16:46:07'),(72,'Edit Payslip Type','web','2020-12-06 16:46:07','2020-12-06 16:46:07'),(73,'Delete Payslip Type','web','2020-12-06 16:46:07','2020-12-06 16:46:07'),(74,'Manage Allowance Option','web','2020-12-06 16:46:08','2020-12-06 16:46:08'),(75,'Create Allowance Option','web','2020-12-06 16:46:08','2020-12-06 16:46:08'),(76,'Edit Allowance Option','web','2020-12-06 16:46:08','2020-12-06 16:46:08'),(77,'Delete Allowance Option','web','2020-12-06 16:46:08','2020-12-06 16:46:08'),(78,'Manage Loan Option','web','2020-12-06 16:46:08','2020-12-06 16:46:08'),(79,'Create Loan Option','web','2020-12-06 16:46:08','2020-12-06 16:46:08'),(80,'Edit Loan Option','web','2020-12-06 16:46:08','2020-12-06 16:46:08'),(81,'Delete Loan Option','web','2020-12-06 16:46:08','2020-12-06 16:46:08'),(82,'Manage Deduction Option','web','2020-12-06 16:46:08','2020-12-06 16:46:08'),(83,'Create Deduction Option','web','2020-12-06 16:46:08','2020-12-06 16:46:08'),(84,'Edit Deduction Option','web','2020-12-06 16:46:08','2020-12-06 16:46:08'),(85,'Delete Deduction Option','web','2020-12-06 16:46:08','2020-12-06 16:46:08'),(86,'Manage Set Salary','web','2020-12-06 16:46:08','2020-12-06 16:46:08'),(87,'Create Set Salary','web','2020-12-06 16:46:08','2020-12-06 16:46:08'),(88,'Edit Set Salary','web','2020-12-06 16:46:08','2020-12-06 16:46:08'),(89,'Delete Set Salary','web','2020-12-06 16:46:08','2020-12-06 16:46:08'),(90,'Manage Allowance','web','2020-12-06 16:46:08','2020-12-06 16:46:08'),(91,'Create Allowance','web','2020-12-06 16:46:09','2020-12-06 16:46:09'),(92,'Edit Allowance','web','2020-12-06 16:46:09','2020-12-06 16:46:09'),(93,'Delete Allowance','web','2020-12-06 16:46:09','2020-12-06 16:46:09'),(94,'Create Commission','web','2020-12-06 16:46:09','2020-12-06 16:46:09'),(95,'Create Loan','web','2020-12-06 16:46:09','2020-12-06 16:46:09'),(96,'Create Saturation Deduction','web','2020-12-06 16:46:09','2020-12-06 16:46:09'),(97,'Create Other Payment','web','2020-12-06 16:46:09','2020-12-06 16:46:09'),(98,'Create Overtime','web','2020-12-06 16:46:09','2020-12-06 16:46:09'),(99,'Edit Commission','web','2020-12-06 16:46:09','2020-12-06 16:46:09'),(100,'Delete Commission','web','2020-12-06 16:46:09','2020-12-06 16:46:09'),(101,'Edit Loan','web','2020-12-06 16:46:09','2020-12-06 16:46:09'),(102,'Delete Loan','web','2020-12-06 16:46:09','2020-12-06 16:46:09'),(103,'Edit Saturation Deduction','web','2020-12-06 16:46:10','2020-12-06 16:46:10'),(104,'Delete Saturation Deduction','web','2020-12-06 16:46:10','2020-12-06 16:46:10'),(105,'Edit Other Payment','web','2020-12-06 16:46:10','2020-12-06 16:46:10'),(106,'Delete Other Payment','web','2020-12-06 16:46:10','2020-12-06 16:46:10'),(107,'Edit Overtime','web','2020-12-06 16:46:10','2020-12-06 16:46:10'),(108,'Delete Overtime','web','2020-12-06 16:46:10','2020-12-06 16:46:10'),(109,'Manage Pay Slip','web','2020-12-06 16:46:10','2020-12-06 16:46:10'),(110,'Create Pay Slip','web','2020-12-06 16:46:10','2020-12-06 16:46:10'),(111,'Edit Pay Slip','web','2020-12-06 16:46:10','2020-12-06 16:46:10'),(112,'Delete Pay Slip','web','2020-12-06 16:46:10','2020-12-06 16:46:10'),(113,'Manage Account List','web','2020-12-06 16:46:10','2020-12-06 16:46:10'),(114,'Create Account List','web','2020-12-06 16:46:10','2020-12-06 16:46:10'),(115,'Edit Account List','web','2020-12-06 16:46:10','2020-12-06 16:46:10'),(116,'Delete Account List','web','2020-12-06 16:46:10','2020-12-06 16:46:10'),(117,'View Balance Account List','web','2020-12-06 16:46:10','2020-12-06 16:46:10'),(118,'Manage Payee','web','2020-12-06 16:46:10','2020-12-06 16:46:10'),(119,'Create Payee','web','2020-12-06 16:46:11','2020-12-06 16:46:11'),(120,'Edit Payee','web','2020-12-06 16:46:11','2020-12-06 16:46:11'),(121,'Delete Payee','web','2020-12-06 16:46:11','2020-12-06 16:46:11'),(122,'Manage Payer','web','2020-12-06 16:46:11','2020-12-06 16:46:11'),(123,'Create Payer','web','2020-12-06 16:46:11','2020-12-06 16:46:11'),(124,'Edit Payer','web','2020-12-06 16:46:11','2020-12-06 16:46:11'),(125,'Delete Payer','web','2020-12-06 16:46:11','2020-12-06 16:46:11'),(126,'Manage Expense Type','web','2020-12-06 16:46:11','2020-12-06 16:46:11'),(127,'Create Expense Type','web','2020-12-06 16:46:11','2020-12-06 16:46:11'),(128,'Edit Expense Type','web','2020-12-06 16:46:11','2020-12-06 16:46:11'),(129,'Delete Expense Type','web','2020-12-06 16:46:11','2020-12-06 16:46:11'),(130,'Manage Income Type','web','2020-12-06 16:46:11','2020-12-06 16:46:11'),(131,'Edit Income Type','web','2020-12-06 16:46:11','2020-12-06 16:46:11'),(132,'Delete Income Type','web','2020-12-06 16:46:11','2020-12-06 16:46:11'),(133,'Create Income Type','web','2020-12-06 16:46:11','2020-12-06 16:46:11'),(134,'Manage Payment Type','web','2020-12-06 16:46:11','2020-12-06 16:46:11'),(135,'Create Payment Type','web','2020-12-06 16:46:12','2020-12-06 16:46:12'),(136,'Edit Payment Type','web','2020-12-06 16:46:12','2020-12-06 16:46:12'),(137,'Delete Payment Type','web','2020-12-06 16:46:12','2020-12-06 16:46:12'),(138,'Manage Deposit','web','2020-12-06 16:46:12','2020-12-06 16:46:12'),(139,'Create Deposit','web','2020-12-06 16:46:12','2020-12-06 16:46:12'),(140,'Edit Deposit','web','2020-12-06 16:46:12','2020-12-06 16:46:12'),(141,'Delete Deposit','web','2020-12-06 16:46:12','2020-12-06 16:46:12'),(142,'Manage Expense','web','2020-12-06 16:46:12','2020-12-06 16:46:12'),(143,'Create Expense','web','2020-12-06 16:46:12','2020-12-06 16:46:12'),(144,'Edit Expense','web','2020-12-06 16:46:12','2020-12-06 16:46:12'),(145,'Delete Expense','web','2020-12-06 16:46:12','2020-12-06 16:46:12'),(146,'Manage Transfer Balance','web','2020-12-06 16:46:13','2020-12-06 16:46:13'),(147,'Create Transfer Balance','web','2020-12-06 16:46:13','2020-12-06 16:46:13'),(148,'Edit Transfer Balance','web','2020-12-06 16:46:13','2020-12-06 16:46:13'),(149,'Delete Transfer Balance','web','2020-12-06 16:46:13','2020-12-06 16:46:13'),(150,'Manage Event','web','2020-12-06 16:46:13','2020-12-06 16:46:13'),(151,'Create Event','web','2020-12-06 16:46:13','2020-12-06 16:46:13'),(152,'Edit Event','web','2020-12-06 16:46:13','2020-12-06 16:46:13'),(153,'Delete Event','web','2020-12-06 16:46:13','2020-12-06 16:46:13'),(154,'Manage Announcement','web','2020-12-06 16:46:13','2020-12-06 16:46:13'),(155,'Create Announcement','web','2020-12-06 16:46:13','2020-12-06 16:46:13'),(156,'Edit Announcement','web','2020-12-06 16:46:13','2020-12-06 16:46:13'),(157,'Delete Announcement','web','2020-12-06 16:46:13','2020-12-06 16:46:13'),(158,'Manage Leave Type','web','2020-12-06 16:46:13','2020-12-06 16:46:13'),(159,'Create Leave Type','web','2020-12-06 16:46:13','2020-12-06 16:46:13'),(160,'Edit Leave Type','web','2020-12-06 16:46:14','2020-12-06 16:46:14'),(161,'Delete Leave Type','web','2020-12-06 16:46:14','2020-12-06 16:46:14'),(162,'Manage Leave','web','2020-12-06 16:46:14','2020-12-06 16:46:14'),(163,'Create Leave','web','2020-12-06 16:46:14','2020-12-06 16:46:14'),(164,'Edit Leave','web','2020-12-06 16:46:14','2020-12-06 16:46:14'),(165,'Delete Leave','web','2020-12-06 16:46:14','2020-12-06 16:46:14'),(166,'Manage Meeting','web','2020-12-06 16:46:14','2020-12-06 16:46:14'),(167,'Create Meeting','web','2020-12-06 16:46:14','2020-12-06 16:46:14'),(168,'Edit Meeting','web','2020-12-06 16:46:14','2020-12-06 16:46:14'),(169,'Delete Meeting','web','2020-12-06 16:46:14','2020-12-06 16:46:14'),(170,'Manage Ticket','web','2020-12-06 16:46:14','2020-12-06 16:46:14'),(171,'Create Ticket','web','2020-12-06 16:46:14','2020-12-06 16:46:14'),(172,'Edit Ticket','web','2020-12-06 16:46:14','2020-12-06 16:46:14'),(173,'Delete Ticket','web','2020-12-06 16:46:14','2020-12-06 16:46:14'),(174,'Manage Attendance','web','2020-12-06 16:46:14','2020-12-06 16:46:14'),(175,'Create Attendance','web','2020-12-06 16:46:14','2020-12-06 16:46:14'),(176,'Edit Attendance','web','2020-12-06 16:46:15','2020-12-06 16:46:15'),(177,'Delete Attendance','web','2020-12-06 16:46:15','2020-12-06 16:46:15'),(178,'Manage Language','web','2020-12-06 16:46:15','2020-12-06 16:46:15'),(179,'Create Language','web','2020-12-06 16:46:15','2020-12-06 16:46:15'),(180,'Manage Plan','web','2020-12-06 16:46:15','2020-12-06 16:46:15'),(181,'Create Plan','web','2020-12-06 16:46:15','2020-12-06 16:46:15'),(182,'Edit Plan','web','2020-12-06 16:46:15','2020-12-06 16:46:15'),(183,'Buy Plan','web','2020-12-06 16:46:15','2020-12-06 16:46:15'),(184,'Manage System Settings','web','2020-12-06 16:46:15','2020-12-06 16:46:15'),(185,'Manage Company Settings','web','2020-12-06 16:46:15','2020-12-06 16:46:15'),(186,'Manage TimeSheet','web','2020-12-06 16:46:15','2020-12-06 16:46:15'),(187,'Create TimeSheet','web','2020-12-06 16:46:15','2020-12-06 16:46:15'),(188,'Edit TimeSheet','web','2020-12-06 16:46:15','2020-12-06 16:46:15'),(189,'Delete TimeSheet','web','2020-12-06 16:46:16','2020-12-06 16:46:16'),(190,'Manage Order','web','2020-12-06 16:46:16','2020-12-06 16:46:16'),(191,'manage coupon','web','2020-12-06 16:46:16','2020-12-06 16:46:16'),(192,'create coupon','web','2020-12-06 16:46:16','2020-12-06 16:46:16'),(193,'edit coupon','web','2020-12-06 16:46:16','2020-12-06 16:46:16'),(194,'delete coupon','web','2020-12-06 16:46:16','2020-12-06 16:46:16'),(195,'Manage Assets','web','2020-12-06 16:46:16','2020-12-06 16:46:16'),(196,'Create Assets','web','2020-12-06 16:46:16','2020-12-06 16:46:16'),(197,'Edit Assets','web','2020-12-06 16:46:16','2020-12-06 16:46:16'),(198,'Delete Assets','web','2020-12-06 16:46:16','2020-12-06 16:46:16'),(199,'Manage Document','web','2020-12-06 16:46:16','2020-12-06 16:46:16'),(200,'Create Document','web','2020-12-06 16:46:16','2020-12-06 16:46:16'),(201,'Edit Document','web','2020-12-06 16:46:16','2020-12-06 16:46:16'),(202,'Delete Document','web','2020-12-06 16:46:16','2020-12-06 16:46:16'),(203,'Manage Employee Profile','web','2020-12-06 16:46:16','2020-12-06 16:46:16'),(204,'Show Employee Profile','web','2020-12-06 16:46:16','2020-12-06 16:46:16'),(205,'Manage Employee Last Login','web','2020-12-06 16:46:16','2020-12-06 16:46:16'),(206,'Manage Indicator','web','2020-12-06 16:46:17','2020-12-06 16:46:17'),(207,'Create Indicator','web','2020-12-06 16:46:17','2020-12-06 16:46:17'),(208,'Edit Indicator','web','2020-12-06 16:46:17','2020-12-06 16:46:17'),(209,'Delete Indicator','web','2020-12-06 16:46:17','2020-12-06 16:46:17'),(210,'Show Indicator','web','2020-12-06 16:46:17','2020-12-06 16:46:17'),(211,'Manage Appraisal','web','2020-12-06 16:46:18','2020-12-06 16:46:18'),(212,'Create Appraisal','web','2020-12-06 16:46:18','2020-12-06 16:46:18'),(213,'Edit Appraisal','web','2020-12-06 16:46:18','2020-12-06 16:46:18'),(214,'Delete Appraisal','web','2020-12-06 16:46:18','2020-12-06 16:46:18'),(215,'Show Appraisal','web','2020-12-06 16:46:18','2020-12-06 16:46:18'),(216,'Manage Goal Type','web','2020-12-06 16:46:18','2020-12-06 16:46:18'),(217,'Create Goal Type','web','2020-12-06 16:46:18','2020-12-06 16:46:18'),(218,'Edit Goal Type','web','2020-12-06 16:46:18','2020-12-06 16:46:18'),(219,'Delete Goal Type','web','2020-12-06 16:46:18','2020-12-06 16:46:18'),(220,'Manage Goal Tracking','web','2020-12-06 16:46:18','2020-12-06 16:46:18'),(221,'Create Goal Tracking','web','2020-12-06 16:46:19','2020-12-06 16:46:19'),(222,'Edit Goal Tracking','web','2020-12-06 16:46:19','2020-12-06 16:46:19'),(223,'Delete Goal Tracking','web','2020-12-06 16:46:19','2020-12-06 16:46:19'),(224,'Manage Company Policy','web','2020-12-06 16:46:19','2020-12-06 16:46:19'),(225,'Create Company Policy','web','2020-12-06 16:46:19','2020-12-06 16:46:19'),(226,'Edit Company Policy','web','2020-12-06 16:46:19','2020-12-06 16:46:19'),(227,'Delete Company Policy','web','2020-12-06 16:46:19','2020-12-06 16:46:19'),(228,'Manage Trainer','web','2020-12-06 16:46:19','2020-12-06 16:46:19'),(229,'Create Trainer','web','2020-12-06 16:46:19','2020-12-06 16:46:19'),(230,'Edit Trainer','web','2020-12-06 16:46:19','2020-12-06 16:46:19'),(231,'Delete Trainer','web','2020-12-06 16:46:19','2020-12-06 16:46:19'),(232,'Show Trainer','web','2020-12-06 16:46:19','2020-12-06 16:46:19'),(233,'Manage Training','web','2020-12-06 16:46:19','2020-12-06 16:46:19'),(234,'Create Training','web','2020-12-06 16:46:20','2020-12-06 16:46:20'),(235,'Edit Training','web','2020-12-06 16:46:20','2020-12-06 16:46:20'),(236,'Delete Training','web','2020-12-06 16:46:20','2020-12-06 16:46:20'),(237,'Show Training','web','2020-12-06 16:46:20','2020-12-06 16:46:20'),(238,'Manage Training Type','web','2020-12-06 16:46:20','2020-12-06 16:46:20'),(239,'Create Training Type','web','2020-12-06 16:46:20','2020-12-06 16:46:20'),(240,'Edit Training Type','web','2020-12-06 16:46:20','2020-12-06 16:46:20'),(241,'Delete Training Type','web','2020-12-06 16:46:20','2020-12-06 16:46:20'),(242,'Manage Report','web','2020-12-06 16:46:20','2020-12-06 16:46:20'),(243,'Manage Holiday','web','2020-12-06 16:46:20','2020-12-06 16:46:20'),(244,'Create Holiday','web','2020-12-06 16:46:20','2020-12-06 16:46:20'),(245,'Edit Holiday','web','2020-12-06 16:46:20','2020-12-06 16:46:20'),(246,'Delete Holiday','web','2020-12-06 16:46:20','2020-12-06 16:46:20'),(247,'Manage Leave Employee','web','2020-12-10 06:45:04','2020-12-10 06:45:04'),(248,'Manage Increment','web','2020-12-15 05:54:27','2020-12-15 05:54:27'),(249,'Manage Monthly Grade','web','2020-12-18 03:07:49','2020-12-18 03:07:49'),(250,'Manage Daily Grade','web','2020-12-18 03:07:49','2020-12-18 03:07:49'),(251,'Manage Hourly Grade','web','2020-12-18 03:09:11','2020-12-18 03:09:11'),(252,'Commission','web','2020-12-24 08:26:29','2020-12-24 08:26:29'),(253,'Manage Bonus Commission Type','web','2021-01-04 09:33:47','2021-01-04 09:33:47'),(254,'Create Bonus Commission Type','web','2021-01-04 09:33:47','2021-01-04 09:33:47'),(255,'Manage Bonus','web','2021-01-05 03:04:25','2021-01-05 03:04:25'),(256,'Create Bonus','web','2021-01-05 03:04:25','2021-01-05 03:04:25'),(257,'Claim','web','2021-01-07 06:52:12','2021-01-07 06:52:12'),(258,'Create Claim','web','2021-01-07 06:52:12','2021-01-07 06:52:12'),(259,'Shift Type','web','2021-01-11 06:25:34','2021-01-11 06:25:34'),(261,'Create Shift Type','web','2021-01-11 06:33:05','2021-01-11 06:33:05'),(262,'Edit Shift Type','web','2021-01-13 07:03:39','2021-01-13 07:03:39'),(263,'Roaster','web','2021-01-13 07:03:39','2021-01-13 07:03:39'),(264,'Create Roaster','web','2021-01-06 07:04:12','2021-01-13 07:04:12'),(265,'Edit Roaster','web','2021-01-13 07:04:12','2021-01-13 07:04:12'),(266,'Manage Team','web','2021-01-06 07:04:12','2021-01-13 07:04:12'),(267,'Create Team','web','2021-01-06 07:04:12','2021-01-13 07:04:12');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `duration` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_users` int NOT NULL DEFAULT '0',
  `max_employees` int NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plans_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES (1,'Free Plan',0.00,'Unlimited',1,5,NULL,'free_plan.png','2020-12-06 16:47:19','2020-12-06 16:47:19');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `policy_images`
--

DROP TABLE IF EXISTS `policy_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `policy_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `policy_id` varchar(20) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `created_by` int NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `policy_images`
--

LOCK TABLES `policy_images` WRITE;
/*!40000 ALTER TABLE `policy_images` DISABLE KEYS */;
INSERT INTO `policy_images` VALUES (1,'1','invoice-7_1610688797.pdf',2,'2021-01-15 05:33:17'),(2,'1','Value error_1610688863.png',2,'2021-01-15 05:34:23'),(3,'1','Test excel file.xls_1610688882.xlsx',2,'2021-01-15 05:34:42'),(4,'1','Sample file_1610689059.csv',2,'2021-01-15 05:37:39'),(5,'2','5f87c1b76da29_1610949885.jpg',2,'2021-01-18 06:04:45');
/*!40000 ALTER TABLE `policy_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promotions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `designation_id` int NOT NULL,
  `designation_to_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `promotion_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promotion_date` date NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotions`
--

LOCK TABLES `promotions` WRITE;
/*!40000 ALTER TABLE `promotions` DISABLE KEYS */;
INSERT INTO `promotions` VALUES (2,2,2,'2',NULL,'2020-12-25',NULL,'2','2020-12-16 23:15:51','2021-01-07 04:09:12'),(3,2,2,'1',NULL,'2021-06-18',NULL,'2','2021-06-18 07:16:37','2021-06-18 07:16:37'),(4,4,1,'2',NULL,'2021-08-23',NULL,'2','2021-08-23 05:18:29','2021-08-23 05:18:29');
/*!40000 ALTER TABLE `promotions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resignations`
--

DROP TABLE IF EXISTS `resignations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resignations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `notice_date` date NOT NULL,
  `resignation_date` date NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resignations`
--

LOCK TABLES `resignations` WRITE;
/*!40000 ALTER TABLE `resignations` DISABLE KEYS */;
/*!40000 ALTER TABLE `resignations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(178,1),(179,1),(180,1),(181,1),(182,1),(184,1),(190,1),(191,1),(192,1),(193,1),(194,1),(1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,2),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(31,2),(32,2),(33,2),(34,2),(35,2),(36,2),(37,2),(38,2),(39,2),(40,2),(41,2),(42,2),(43,2),(44,2),(45,2),(46,2),(47,2),(48,2),(49,2),(50,2),(51,2),(52,2),(53,2),(54,2),(55,2),(56,2),(57,2),(58,2),(59,2),(60,2),(61,2),(62,2),(63,2),(64,2),(65,2),(66,2),(67,2),(68,2),(69,2),(70,2),(71,2),(72,2),(73,2),(74,2),(75,2),(76,2),(77,2),(78,2),(79,2),(80,2),(81,2),(82,2),(83,2),(84,2),(85,2),(86,2),(87,2),(88,2),(89,2),(90,2),(91,2),(92,2),(93,2),(94,2),(95,2),(96,2),(97,2),(98,2),(99,2),(100,2),(101,2),(102,2),(103,2),(104,2),(105,2),(106,2),(107,2),(108,2),(109,2),(110,2),(111,2),(112,2),(113,2),(114,2),(115,2),(116,2),(117,2),(118,2),(119,2),(120,2),(121,2),(122,2),(123,2),(124,2),(125,2),(126,2),(127,2),(128,2),(129,2),(130,2),(131,2),(132,2),(133,2),(134,2),(135,2),(136,2),(137,2),(138,2),(139,2),(140,2),(141,2),(142,2),(143,2),(144,2),(145,2),(146,2),(147,2),(148,2),(149,2),(150,2),(151,2),(152,2),(153,2),(154,2),(155,2),(156,2),(157,2),(158,2),(159,2),(160,2),(161,2),(162,2),(163,2),(164,2),(165,2),(166,2),(167,2),(168,2),(169,2),(170,2),(171,2),(172,2),(173,2),(174,2),(175,2),(176,2),(177,2),(178,2),(180,2),(183,2),(185,2),(186,2),(187,2),(188,2),(189,2),(190,2),(195,2),(196,2),(197,2),(198,2),(199,2),(200,2),(201,2),(202,2),(203,2),(204,2),(205,2),(206,2),(207,2),(208,2),(209,2),(210,2),(211,2),(212,2),(213,2),(214,2),(215,2),(216,2),(217,2),(218,2),(219,2),(220,2),(221,2),(222,2),(223,2),(224,2),(225,2),(226,2),(227,2),(228,2),(229,2),(230,2),(231,2),(232,2),(233,2),(234,2),(235,2),(236,2),(237,2),(238,2),(239,2),(240,2),(241,2),(242,2),(243,2),(244,2),(245,2),(246,2),(1,3),(9,3),(10,3),(11,3),(12,3),(13,3),(14,3),(15,3),(16,3),(17,3),(18,3),(19,3),(20,3),(21,3),(22,3),(23,3),(24,3),(25,3),(26,3),(27,3),(28,3),(29,3),(30,3),(31,3),(32,3),(33,3),(34,3),(35,3),(36,3),(37,3),(38,3),(39,3),(40,3),(41,3),(42,3),(43,3),(44,3),(45,3),(46,3),(47,3),(48,3),(49,3),(50,3),(51,3),(52,3),(53,3),(54,3),(55,3),(56,3),(57,3),(58,3),(59,3),(60,3),(61,3),(62,3),(63,3),(64,3),(65,3),(66,3),(67,3),(68,3),(69,3),(70,3),(71,3),(72,3),(73,3),(74,3),(75,3),(76,3),(77,3),(78,3),(79,3),(80,3),(81,3),(82,3),(83,3),(84,3),(85,3),(86,3),(87,3),(88,3),(89,3),(90,3),(91,3),(92,3),(93,3),(94,3),(95,3),(96,3),(97,3),(98,3),(99,3),(100,3),(101,3),(102,3),(103,3),(104,3),(105,3),(106,3),(107,3),(108,3),(109,3),(110,3),(111,3),(112,3),(150,3),(151,3),(152,3),(153,3),(154,3),(155,3),(156,3),(157,3),(158,3),(159,3),(160,3),(161,3),(162,3),(163,3),(164,3),(165,3),(166,3),(167,3),(168,3),(169,3),(170,3),(171,3),(172,3),(173,3),(174,3),(175,3),(176,3),(177,3),(186,3),(187,3),(188,3),(189,3),(195,3),(196,3),(197,3),(198,3),(199,3),(200,3),(201,3),(202,3),(203,3),(204,3),(205,3),(206,3),(207,3),(208,3),(209,3),(210,3),(211,3),(212,3),(213,3),(214,3),(215,3),(216,3),(217,3),(218,3),(219,3),(220,3),(221,3),(222,3),(223,3),(224,3),(225,3),(226,3),(227,3),(228,3),(229,3),(230,3),(231,3),(232,3),(233,3),(234,3),(235,3),(236,3),(237,3),(238,3),(239,3),(240,3),(241,3),(243,3),(244,3),(245,3),(246,3),(247,3),(248,3),(249,3),(250,3),(251,3),(252,3),(253,3),(254,3),(255,3),(256,3),(257,3),(258,3),(259,3),(261,3),(262,3),(263,3),(264,3),(265,3),(9,4),(13,4),(17,4),(18,4),(19,4),(20,4),(21,4),(25,4),(29,4),(30,4),(31,4),(32,4),(33,4),(34,4),(35,4),(36,4),(37,4),(65,4),(67,4),(69,4),(90,4),(150,4),(154,4),(162,4),(163,4),(164,4),(165,4),(166,4),(170,4),(171,4),(172,4),(173,4),(174,4),(178,4),(186,4),(187,4),(188,4),(189,4),(199,4),(243,4);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'super admin','web',0,'2020-12-06 16:46:20','2020-12-06 16:46:20'),(2,'company','web',1,'2020-12-06 16:46:23','2020-12-06 16:46:23'),(3,'hr','web',2,'2020-12-06 16:46:53','2020-12-06 16:46:53'),(4,'employee','web',2,'2020-12-06 16:47:14','2020-12-06 16:47:14');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saturation_deductions`
--

DROP TABLE IF EXISTS `saturation_deductions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saturation_deductions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `deduction_option` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saturation_deductions`
--

LOCK TABLES `saturation_deductions` WRITE;
/*!40000 ALTER TABLE `saturation_deductions` DISABLE KEYS */;
/*!40000 ALTER TABLE `saturation_deductions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `set_salaries`
--

DROP TABLE IF EXISTS `set_salaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `set_salaries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `set_salaries`
--

LOCK TABLES `set_salaries` WRITE;
/*!40000 ALTER TABLE `set_salaries` DISABLE KEYS */;
/*!40000 ALTER TABLE `set_salaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_name_created_by_unique` (`name`,`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'title_text','',1,NULL,NULL),(2,'footer_text','',1,NULL,NULL),(3,'default_language','en',1,NULL,NULL),(4,'logo','/tmp/phpQ17tYG',1,NULL,NULL),(5,'small_logo','/tmp/php0wSiA7',1,NULL,NULL),(6,'favicon','/tmp/phpMw2zzy',1,NULL,NULL),(13,'award_create','1',2,'2021-06-18 05:10:58','2021-06-18 05:10:58');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shift_types`
--

DROP TABLE IF EXISTS `shift_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shift_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `late_time` time NOT NULL,
  `created_by` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `weekdays` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shift_types`
--

LOCK TABLES `shift_types` WRITE;
/*!40000 ALTER TABLE `shift_types` DISABLE KEYS */;
INSERT INTO `shift_types` VALUES (2,'Day Shift','09:00:00','17:00:00','18:30:00',2,'2021-01-13 07:20:39','2021-09-13 11:16:38',2),(3,'Night Shift','17:00:00','03:00:00','17:30:00',2,'2021-01-13 07:22:23','2021-01-13 07:22:23',1),(4,'Test','18:00:00','18:00:00','18:00:00',2,'2021-06-18 12:23:29','2021-06-18 12:23:29',1),(5,'Test User','18:30:00','18:30:00','18:30:00',2,'2021-06-18 12:53:57','2021-06-18 12:53:57',1);
/*!40000 ALTER TABLE `shift_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supervisor_emp_id` int NOT NULL,
  `team_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (4,6,'Team1',2,'2021-09-07 02:59:17','2021-09-14 02:02:31'),(5,13,'Team 5',2,'2021-09-14 02:05:21','2021-09-14 02:05:21');
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams_workers`
--

DROP TABLE IF EXISTS `teams_workers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams_workers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint unsigned NOT NULL,
  `worker_emp_id` int NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teams_workers_FK` (`team_id`),
  CONSTRAINT `teams_workers_FK` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams_workers`
--

LOCK TABLES `teams_workers` WRITE;
/*!40000 ALTER TABLE `teams_workers` DISABLE KEYS */;
INSERT INTO `teams_workers` VALUES (16,5,9,0,'2021-09-14 04:26:17',NULL),(17,4,10,0,'2021-09-14 04:27:19',NULL),(18,5,11,0,'2021-09-14 04:29:00',NULL),(19,4,2,0,'2021-09-14 05:12:49',NULL),(26,5,3,0,'2021-09-14 05:52:41',NULL);
/*!40000 ALTER TABLE `teams_workers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams_workers_locations`
--

DROP TABLE IF EXISTS `teams_workers_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams_workers_locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `location_id` bigint unsigned NOT NULL,
  `worker_emp_id` int NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams_workers_locations`
--

LOCK TABLES `teams_workers_locations` WRITE;
/*!40000 ALTER TABLE `teams_workers_locations` DISABLE KEYS */;
INSERT INTO `teams_workers_locations` VALUES (4,0,16,0,'2021-09-14 02:04:46',NULL),(5,0,9,0,'2021-09-14 03:15:53',NULL),(8,0,7,0,'2021-09-14 04:22:37',NULL),(9,0,8,0,'2021-09-14 04:24:11',NULL),(10,0,12,0,'2021-09-14 04:26:17',NULL),(11,0,13,0,'2021-09-14 04:27:19',NULL),(12,0,14,0,'2021-09-14 04:29:00',NULL),(13,0,5,0,'2021-09-14 05:12:49',NULL),(20,0,6,0,'2021-09-14 05:52:41',NULL);
/*!40000 ALTER TABLE `teams_workers_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `termination_types`
--

DROP TABLE IF EXISTS `termination_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `termination_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `termination_types`
--

LOCK TABLES `termination_types` WRITE;
/*!40000 ALTER TABLE `termination_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `termination_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terminations`
--

DROP TABLE IF EXISTS `terminations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `terminations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `notice_date` date NOT NULL,
  `termination_date` date NOT NULL,
  `termination_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terminations`
--

LOCK TABLES `terminations` WRITE;
/*!40000 ALTER TABLE `terminations` DISABLE KEYS */;
/*!40000 ALTER TABLE `terminations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_replies`
--

DROP TABLE IF EXISTS `ticket_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_replies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `is_read` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_replies`
--

LOCK TABLES `ticket_replies` WRITE;
/*!40000 ALTER TABLE `ticket_replies` DISABLE KEYS */;
INSERT INTO `ticket_replies` VALUES (1,1,6,'Test',2,0,'2021-06-18 07:43:59','2021-06-18 07:43:59');
/*!40000 ALTER TABLE `ticket_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` int NOT NULL,
  `priority` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` date NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `ticket_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (1,'Test',6,'medium','2021-06-16','Test','010646',2,'open','2021-06-18 07:43:46','2021-06-18 07:44:46');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_sheets`
--

DROP TABLE IF EXISTS `time_sheets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `time_sheets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `hours` double(8,2) NOT NULL DEFAULT '0.00',
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_sheets`
--

LOCK TABLES `time_sheets` WRITE;
/*!40000 ALTER TABLE `time_sheets` DISABLE KEYS */;
INSERT INTO `time_sheets` VALUES (1,6,'2021-01-11',11.00,'Test',2,'2021-01-07 01:56:24','2021-01-07 01:56:24'),(2,5,'2021-01-07',10.00,'Test',2,'2021-01-07 01:56:51','2021-01-07 01:56:51');
/*!40000 ALTER TABLE `time_sheets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainers`
--

DROP TABLE IF EXISTS `trainers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `expertise` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainers`
--

LOCK TABLES `trainers` WRITE;
/*!40000 ALTER TABLE `trainers` DISABLE KEYS */;
/*!40000 ALTER TABLE `trainers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `training_types`
--

DROP TABLE IF EXISTS `training_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `training_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `training_types`
--

LOCK TABLES `training_types` WRITE;
/*!40000 ALTER TABLE `training_types` DISABLE KEYS */;
INSERT INTO `training_types` VALUES (2,'Test','Test training','Active',2,'2021-01-19 04:36:24','2021-01-19 04:36:31');
/*!40000 ALTER TABLE `training_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainings`
--

DROP TABLE IF EXISTS `trainings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch` int NOT NULL,
  `trainer_option` int NOT NULL,
  `training_type` int NOT NULL,
  `trainer` int NOT NULL,
  `training_cost` double(8,2) NOT NULL DEFAULT '0.00',
  `employee` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `performance` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainings`
--

LOCK TABLES `trainings` WRITE;
/*!40000 ALTER TABLE `trainings` DISABLE KEYS */;
/*!40000 ALTER TABLE `trainings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transfer_balances`
--

DROP TABLE IF EXISTS `transfer_balances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transfer_balances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `from_account_id` int NOT NULL,
  `to_account_id` int NOT NULL,
  `date` date NOT NULL,
  `amount` int NOT NULL,
  `payment_type_id` int NOT NULL,
  `referal_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfer_balances`
--

LOCK TABLES `transfer_balances` WRITE;
/*!40000 ALTER TABLE `transfer_balances` DISABLE KEYS */;
/*!40000 ALTER TABLE `transfer_balances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transfers`
--

DROP TABLE IF EXISTS `transfers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transfers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `department_id` int NOT NULL,
  `transfer_date` date NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfers`
--

LOCK TABLES `transfers` WRITE;
/*!40000 ALTER TABLE `transfers` DISABLE KEYS */;
/*!40000 ALTER TABLE `transfers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travels`
--

DROP TABLE IF EXISTS `travels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `travels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `purpose_of_visit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_of_visit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travels`
--

LOCK TABLES `travels` WRITE;
/*!40000 ALTER TABLE `travels` DISABLE KEYS */;
/*!40000 ALTER TABLE `travels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_coupons`
--

DROP TABLE IF EXISTS `user_coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user` int NOT NULL,
  `coupon` int NOT NULL,
  `order` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_coupons`
--

LOCK TABLES `user_coupons` WRITE;
/*!40000 ALTER TABLE `user_coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `messenger_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#2180f3',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan` int DEFAULT NULL,
  `plan_expire_date` date DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Super Admin','','superadmin@example.com',0,0,'#2180f3',NULL,'$2y$10$XjC6AtLX1uuLv8y.5Vvi6ucRBi39moxlqIbp/ZfigbLVYUWnMgfAe','super admin','','en',NULL,NULL,'2023-03-09 22:10:36',1,'0',NULL,'2020-12-06 16:46:23','2023-03-09 22:10:36'),(2,'company','','company@example.com',0,0,'#2180f3',NULL,'$2y$10$XjC6AtLX1uuLv8y.5Vvi6ucRBi39moxlqIbp/ZfigbLVYUWnMgfAe','company','','en',1,NULL,'2021-06-22 09:11:11',1,'1',NULL,'2020-12-06 16:46:53','2021-06-22 09:11:11'),(3,'hr','','hr@example.com',0,0,'#2180f3',NULL,'$2y$10$XjC6AtLX1uuLv8y.5Vvi6ucRBi39moxlqIbp/ZfigbLVYUWnMgfAe','hr','','en',NULL,NULL,'2023-03-09 22:10:54',1,'2','vJwBnCb8g7p70aFgayPiiGoUHDNla6gN8YyqgJC0iZ4fMedJxcnZRXA6P8La','2020-12-06 16:47:14','2023-03-09 22:10:54'),(5,'Arup shaw','','arup_wari@yahoo.com',0,0,'#2180f3',NULL,'$2y$10$XjC6AtLX1uuLv8y.5Vvi6ucRBi39moxlqIbp/ZfigbLVYUWnMgfAe','employee',NULL,'en',NULL,NULL,NULL,1,'2',NULL,'2021-01-04 04:05:09','2021-01-04 04:05:09'),(6,'Test Person II III','','testeelat@yopmail.com',0,0,'#2180f3',NULL,'$2y$10$XjC6AtLX1uuLv8y.5Vvi6ucRBi39moxlqIbp/ZfigbLVYUWnMgfAe','employee',NULL,'en',NULL,NULL,NULL,1,'2',NULL,'2021-01-07 01:35:52','2021-01-07 01:35:52'),(7,'Name Title','','test7877@yopmail.com',0,0,'#2180f3',NULL,'$2y$10$XjC6AtLX1uuLv8y.5Vvi6ucRBi39moxlqIbp/ZfigbLVYUWnMgfAe','employee',NULL,'en',NULL,NULL,NULL,1,'2',NULL,'2021-01-19 04:07:16','2021-01-19 04:07:16'),(8,'Test User','','newuser21222@yopmail.com',0,0,'#2180f3',NULL,'$2y$10$XjC6AtLX1uuLv8y.5Vvi6ucRBi39moxlqIbp/ZfigbLVYUWnMgfAe','employee',NULL,'en',NULL,NULL,'2021-06-23 03:25:41',1,'2',NULL,'2021-06-18 06:43:09','2021-06-23 03:25:41'),(9,'Supervisor Employee','','supervisor@gmail.com',0,0,'#2180f3',NULL,'$2y$10$XjC6AtLX1uuLv8y.5Vvi6ucRBi39moxlqIbp/ZfigbLVYUWnMgfAe','employee',NULL,'en',NULL,NULL,NULL,1,'2',NULL,'2021-09-07 01:59:24','2021-09-07 01:59:24'),(12,'qadasf dsfsdfsdf','','dfdsf@dfsdfs.com',0,0,'#2180f3',NULL,'$2y$10$XjC6AtLX1uuLv8y.5Vvi6ucRBi39moxlqIbp/ZfigbLVYUWnMgfAe','employee',NULL,'en',NULL,NULL,NULL,1,'2',NULL,'2021-09-07 04:31:52','2021-09-07 04:31:52'),(13,'Test Name','','testeelat122111@yopmail.com',0,0,'#2180f3',NULL,'$2y$10$XjC6AtLX1uuLv8y.5Vvi6ucRBi39moxlqIbp/ZfigbLVYUWnMgfAe','employee',NULL,'en',NULL,NULL,NULL,1,'2',NULL,'2021-09-07 06:45:12','2021-09-07 06:45:12'),(14,'dddd dddd','','ddd@ddd',0,0,'#2180f3',NULL,'$2y$10$XjC6AtLX1uuLv8y.5Vvi6ucRBi39moxlqIbp/ZfigbLVYUWnMgfAe','employee',NULL,'en',NULL,NULL,NULL,1,'2',NULL,'2021-09-07 06:53:07','2021-09-07 06:53:07'),(15,'asdsad adasdasdas','','asdasd@sdsfsd.com',0,0,'#2180f3',NULL,'$2y$10$XjC6AtLX1uuLv8y.5Vvi6ucRBi39moxlqIbp/ZfigbLVYUWnMgfAe','employee',NULL,'en',NULL,NULL,NULL,1,'2',NULL,'2021-09-07 06:56:57','2021-09-07 06:56:57'),(16,'sdfsdf sdfsdfsdf','','sdfds@sdfsdfsd.com',0,0,'#2180f3',NULL,'$2y$10$XjC6AtLX1uuLv8y.5Vvi6ucRBi39moxlqIbp/ZfigbLVYUWnMgfAe','employee',NULL,'en',NULL,NULL,NULL,1,'2',NULL,'2021-09-07 07:01:36','2021-09-07 07:01:36'),(18,'Demon','','demo@demo.com',0,0,'#2180f3',NULL,'$2y$10$XjC6AtLX1uuLv8y.5Vvi6ucRBi39moxlqIbp/ZfigbLVYUWnMgfAe','company',NULL,'en',1,NULL,NULL,1,'1',NULL,'2023-03-09 22:08:42','2023-03-09 22:08:42');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warnings`
--

DROP TABLE IF EXISTS `warnings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warnings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `warning_to` int NOT NULL,
  `warning_by` int NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `warning_date` date NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warnings`
--

LOCK TABLES `warnings` WRITE;
/*!40000 ALTER TABLE `warnings` DISABLE KEYS */;
INSERT INTO `warnings` VALUES (1,2,2,'Test','2021-06-18','Test','2','2021-06-18 07:54:58','2021-06-18 07:54:58');
/*!40000 ALTER TABLE `warnings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'laravel_h'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-10 11:04:08
