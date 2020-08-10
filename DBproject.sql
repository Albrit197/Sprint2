CREATE DATABASE  IF NOT EXISTS `sprint2` 
USE `sprint2`;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_lithuanian_ci DEFAULT NULL,
  `projects` varchar(45) COLLATE utf8mb4_lithuanian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
INSERT INTO `employees` VALUES (1,'John','2'),(2,'George','2'),(3,'Mary','3'),(4,'Vasilisa Krasavica','1'),(5,'Chuck',NULL),(6,'Susan','4'),(7,'Vova','8'),(8,'Conchita','5');
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_lithuanian_ci DEFAULT NULL,
  `employees` varchar(45) COLLATE utf8mb4_lithuanian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
INSERT INTO `projects` VALUES (1,'Messing around',NULL),(2,'Anger management',NULL),(3,'Programming',NULL),(4,'Wrecking house',NULL),(5,'Doing nothing',NULL),(6,'Managing',NULL),(7,'Inventing ',NULL),(8,'Bombing',NULL);
UNLOCK TABLES;


