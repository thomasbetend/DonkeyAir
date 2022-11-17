-- MySQL dump 10.13  Distrib 8.0.30, for macos10.15 (x86_64)
--
-- Host: localhost    Database: donkey_air
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `airport`
--

DROP TABLE IF EXISTS `airport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `airport` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `airport`
--

LOCK TABLES `airport` WRITE;
/*!40000 ALTER TABLE `airport` DISABLE KEYS */;
/*!40000 ALTER TABLE `airport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `arrival_airport`
--

DROP TABLE IF EXISTS `arrival_airport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `arrival_airport` (
  `id` int NOT NULL AUTO_INCREMENT,
  `arrival_airport_name` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arrival_airport`
--

LOCK TABLES `arrival_airport` WRITE;
/*!40000 ALTER TABLE `arrival_airport` DISABLE KEYS */;
INSERT INTO `arrival_airport` VALUES (1,'Paris CDG'),(2,'Lyon'),(3,'Nice');
/*!40000 ALTER TABLE `arrival_airport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departure_airport`
--

DROP TABLE IF EXISTS `departure_airport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departure_airport` (
  `id` int NOT NULL AUTO_INCREMENT,
  `departure_airport_name` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departure_airport`
--

LOCK TABLES `departure_airport` WRITE;
/*!40000 ALTER TABLE `departure_airport` DISABLE KEYS */;
INSERT INTO `departure_airport` VALUES (1,'Paris CDG'),(2,'Lyon'),(3,'Nice'),(4,'Bordeaux');
/*!40000 ALTER TABLE `departure_airport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flight`
--

DROP TABLE IF EXISTS `flight`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `flight` (
  `id` int NOT NULL AUTO_INCREMENT,
  `departure_date` datetime DEFAULT NULL,
  `arrival_date` datetime DEFAULT NULL,
  `nb_seats` int DEFAULT NULL,
  `price` float DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `departure_airport_id` int DEFAULT NULL,
  `arrival_airport_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_flight_departure_airport` (`departure_airport_id`),
  KEY `fk_flight_arrival_airport` (`arrival_airport_id`),
  CONSTRAINT `fk_flight_arrival_airport` FOREIGN KEY (`arrival_airport_id`) REFERENCES `arrival_airport` (`id`),
  CONSTRAINT `fk_flight_departure_airport` FOREIGN KEY (`departure_airport_id`) REFERENCES `departure_airport` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flight`
--

LOCK TABLES `flight` WRITE;
/*!40000 ALTER TABLE `flight` DISABLE KEYS */;
INSERT INTO `flight` VALUES (1,'2022-12-18 18:00:00','2022-12-18 19:05:00',5,145,'PN001',1,3),(2,'2022-11-17 09:00:00','2022-11-17 11:30:00',4,320,'LS001',3,2),(3,'2022-11-17 17:00:00','2022-11-17 19:30:00',4,335,'LS002',4,2),(4,'2022-12-18 18:00:00','2022-12-18 19:05:00',5,155,'NP001',2,1);
/*!40000 ALTER TABLE `flight` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `price` float DEFAULT NULL,
  `nb_passengers` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reservations_user` (`user_id`),
  CONSTRAINT `fk_reservations_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (1,1,435,3),(2,2,345,3),(3,3,235,1),(4,1,430,1);
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation_flight`
--

DROP TABLE IF EXISTS `reservation_flight`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation_flight` (
  `id` int NOT NULL AUTO_INCREMENT,
  `flight_id` int DEFAULT NULL,
  `reservations_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_flight_reservations_idx` (`reservations_id`),
  KEY `fk_reservations_flight_idx` (`flight_id`),
  CONSTRAINT `fk_flight_reservations` FOREIGN KEY (`reservations_id`) REFERENCES `reservation` (`id`),
  CONSTRAINT `fk_reservations_flight` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation_flight`
--

LOCK TABLES `reservation_flight` WRITE;
/*!40000 ALTER TABLE `reservation_flight` DISABLE KEYS */;
INSERT INTO `reservation_flight` VALUES (1,1,1);
/*!40000 ALTER TABLE `reservation_flight` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(80) DEFAULT NULL,
  `lastname` varchar(80) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `nationality` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'thomas','betend','$2y$10$KfpTzcYyrI8RfyxtGB8AFOtFnern1/yzUPStQVx9J.Mbz5SBxa3c6','thomas.betend@yahoo.fr',NULL),(2,'lucie','guinebert','$2y$10$UBVHDt1zHVd2q2864mi86.P1DNEeMRZ35tTXTbSNwDJY6.2rHUnsK','lucie.guinebert77@gmail.com',NULL),(3,'vincent','pennec','$2y$10$kwmmpmlW4bfnZd3drhrWKuDU77JJs7evpnB.IXh4ZnKmSgOiCd7CC','veens34@free.fr',NULL),(4,'thomas','leherissé','$2y$10$Q7zHbAWeJXTiVDWbIGs3tucyyIRKruGLL.ldRWyFuleqqToo6oY3u','chronicover@gmail.com',NULL),(5,'','admin','$2y$10$nLSl3OILpsP.raQZLYvLbOfDUCMdHEXmfqpQr/vQVDVRk1mCbQZze','admin@gmail.com',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_flight`
--

DROP TABLE IF EXISTS `user_flight`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_flight` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `flight_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_flight_user_idx` (`flight_id`),
  KEY `fk_user_flight_idx` (`user_id`),
  CONSTRAINT `fk_flight_user` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id`),
  CONSTRAINT `fk_user_flight` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_flight`
--

LOCK TABLES `user_flight` WRITE;
/*!40000 ALTER TABLE `user_flight` DISABLE KEYS */;
INSERT INTO `user_flight` VALUES (1,1,1);
/*!40000 ALTER TABLE `user_flight` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-17 12:17:23
