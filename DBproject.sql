CREATE DATABASE  IF NOT EXISTS `sprint2`;
USE `sprint2`;


DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_lithuanian_ci DEFAULT NULL,
  `projects` varchar(45) COLLATE utf8mb4_lithuanian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;
--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
INSERT INTO `employees` VALUES (1,'John','3'),(2,'Mary','5'),(3,'Jack','2'),(4,'Susan','7'),(6,'Daniel',''),(7,'Victoria','6'),(8,'George','1');
UNLOCK TABLES;
--
-- Table structure for table `projects`
--
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_lithuanian_ci DEFAULT NULL,
  `employees` varchar(45) COLLATE utf8mb4_lithuanian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;
--
-- Dumping data for table `projects`
--
LOCK TABLES `projects` WRITE;
INSERT INTO `projects` VALUES (2,'Standing and watching',NULL),(3,'Dancing',NULL),(4,'Programming',NULL),(6,'Managing',NULL),(7,'Inventing ',NULL);
UNLOCK TABLES;

