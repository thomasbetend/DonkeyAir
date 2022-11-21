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
  `id_airport` int NOT NULL AUTO_INCREMENT,
  `airport_name` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_airport`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `airport`
--

LOCK TABLES `airport` WRITE;
/*!40000 ALTER TABLE `airport` DISABLE KEYS */;
INSERT INTO `airport` VALUES (1,'Paris CDG'),(2,'Lyon'),(3,'Nice'),(4,'Bordeaux'),(5,'Lille'),(6,'Biarritz'),(7,'Strasbourg'),(8,'Paris Orly'),(9,'New York'),(10,'Londres'),(11,'Berlin');
/*!40000 ALTER TABLE `airport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `arrival_airport`
--

DROP TABLE IF EXISTS `arrival_airport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `arrival_airport` (
  `id_arrival_airport` int NOT NULL AUTO_INCREMENT,
  `arrival_airport_name` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_arrival_airport`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arrival_airport`
--

LOCK TABLES `arrival_airport` WRITE;
/*!40000 ALTER TABLE `arrival_airport` DISABLE KEYS */;
INSERT INTO `arrival_airport` VALUES (1,'Paris CDG'),(2,'Lyon'),(3,'Nice'),(4,'Bordeaux'),(5,'Lille'),(6,'Biarritz'),(7,'Strasbourg'),(8,'Paris Orly'),(9,'New York'),(10,'Londres'),(11,'Berlin');
/*!40000 ALTER TABLE `arrival_airport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departure_airport`
--

DROP TABLE IF EXISTS `departure_airport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departure_airport` (
  `id_departure_airport` int NOT NULL AUTO_INCREMENT,
  `departure_airport_name` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_departure_airport`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departure_airport`
--

LOCK TABLES `departure_airport` WRITE;
/*!40000 ALTER TABLE `departure_airport` DISABLE KEYS */;
INSERT INTO `departure_airport` VALUES (1,'Paris CDG'),(2,'Lyon'),(3,'Nice'),(4,'Bordeaux'),(5,'Lille'),(6,'Biarritz'),(7,'Strasbourg'),(8,'Paris Orly'),(9,'New York'),(10,'Londres'),(11,'Berlin');
/*!40000 ALTER TABLE `departure_airport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flight`
--

DROP TABLE IF EXISTS `flight`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `flight` (
  `id_flight` int NOT NULL AUTO_INCREMENT,
  `departure_date` datetime DEFAULT NULL,
  `arrival_date` datetime DEFAULT NULL,
  `nb_seats` int DEFAULT NULL,
  `price` float DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `departure_airport_id` int DEFAULT NULL,
  `arrival_airport_id` int DEFAULT NULL,
  PRIMARY KEY (`id_flight`),
  KEY `fk_arrival_airport_id` (`arrival_airport_id`),
  KEY `fk_departure_airport_id` (`departure_airport_id`),
  CONSTRAINT `fk_arrival_airport_id` FOREIGN KEY (`arrival_airport_id`) REFERENCES `airport` (`id_airport`),
  CONSTRAINT `fk_departure_airport_id` FOREIGN KEY (`departure_airport_id`) REFERENCES `airport` (`id_airport`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flight`
--

LOCK TABLES `flight` WRITE;
/*!40000 ALTER TABLE `flight` DISABLE KEYS */;
INSERT INTO `flight` VALUES (1,'2022-12-15 17:00:00','2022-12-15 18:10:00',3,145,'PN001',1,3),(2,'2022-11-17 09:00:00','2022-11-17 11:30:00',-16,320,'LS001',3,2),(3,'2022-11-17 17:00:00','2022-11-17 19:30:00',1,335,'LS002',4,2),(4,'2022-12-18 18:00:00','2022-12-18 19:20:00',4,155,'NP001',2,1),(5,'2022-11-20 11:10:00','2022-11-20 12:30:00',2,295,'NL445',4,10),(7,'2022-11-27 15:20:00','2022-11-27 16:40:00',7,300,'BoLo446',4,10),(8,'2022-12-07 10:00:00','2022-12-07 11:15:00',4,210,'StBe543',7,11),(10,'2022-12-10 15:30:00','2022-12-10 16:30:00',5,550,'PaNe335',1,9);
/*!40000 ALTER TABLE `flight` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation` (
  `id_reservation` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `price` float DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `fk_reservations_user` (`user_id`),
  CONSTRAINT `fk_reservations_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (1,1,435,'2022-11-20 00:00:00'),(2,2,345,'2022-11-20 00:00:00'),(3,3,235,'2022-11-20 00:00:00'),(5,1,430,'2022-11-20 00:00:00'),(6,1,430,'2022-11-20 00:00:00'),(45,1,155,'2022-11-20 00:00:00'),(46,1,155,'2022-11-20 00:00:00'),(47,1,155,'2022-11-20 00:00:00'),(48,1,155,'2022-11-20 00:00:00'),(49,1,155,'2022-11-20 00:00:00'),(50,1,155,'2022-11-20 00:00:00'),(51,1,155,'2022-11-20 00:00:00'),(52,1,155,'2022-11-20 00:00:00'),(53,1,155,'2022-11-20 00:00:00'),(54,1,155,'2022-11-20 00:00:00'),(55,1,155,'2022-11-20 00:00:00'),(56,1,155,'2022-11-20 00:00:00'),(57,1,320,'2022-11-20 00:00:00'),(58,1,320,'2022-11-20 00:00:00'),(59,1,155,'2022-11-20 00:00:00'),(60,1,155,'2022-11-20 00:00:00'),(61,1,155,'2022-11-20 00:00:00'),(62,1,155,'2022-11-20 00:00:00'),(63,1,155,'2022-11-20 00:00:00'),(64,1,465,'2022-11-20 00:00:00'),(65,1,0,'2022-11-20 00:00:00'),(66,1,0,'2022-11-20 00:00:00'),(67,1,640,'2022-11-20 00:00:00'),(68,1,310,'2022-11-20 00:00:00'),(69,12,725,'2022-11-20 00:00:00'),(70,1,465,'2022-11-20 00:00:00'),(71,1,465,'2022-11-20 00:00:00'),(72,1,465,'2022-11-20 00:00:00'),(73,1,310,'2022-11-20 00:00:00'),(74,1,335,'2022-11-20 00:00:00'),(75,1,335,'2022-11-20 00:00:00'),(76,1,295,'2022-11-20 00:00:00'),(77,1,550,'2022-11-20 00:00:00'),(78,1,1180,'2022-11-20 00:00:00'),(79,1,310,'2022-11-20 00:00:00'),(80,1,155,'2022-11-20 00:00:00'),(81,1,155,'2022-11-20 00:00:00'),(82,1,155,'2022-11-20 00:00:00'),(83,1,2200,'2022-11-20 00:00:00'),(84,1,335,'2022-11-20 00:00:00'),(85,5,335,'2022-11-20 00:00:00'),(86,5,335,'2022-11-20 00:00:00'),(87,1,290,'2022-11-20 00:00:00'),(88,6,950,'2022-11-21 00:00:00'),(89,6,950,'2022-11-21 00:00:00'),(90,6,950,'2022-11-21 00:00:00'),(91,6,950,'2022-11-21 00:00:00'),(92,6,950,'2022-11-21 00:00:00'),(93,6,950,'2022-11-21 00:00:00'),(94,6,950,'2022-11-21 00:00:00'),(95,6,950,'2022-11-21 00:00:00'),(96,6,950,'2022-11-21 00:00:00'),(97,6,950,'2022-11-21 00:00:00'),(98,6,310,'2022-11-21 00:00:00'),(99,6,1340,'2022-11-21 00:00:00'),(100,1,335,'2022-11-21 00:00:00');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation_flight`
--

DROP TABLE IF EXISTS `reservation_flight`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation_flight` (
  `id_reservation_flight` int NOT NULL AUTO_INCREMENT,
  `flight_id` int DEFAULT NULL,
  `reservation_id` int DEFAULT NULL,
  `nb_passengers` int DEFAULT NULL,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`id_reservation_flight`),
  KEY `fk_flight_reservations_idx` (`reservation_id`),
  KEY `fk_reservations_flight_idx` (`flight_id`),
  CONSTRAINT `fk_flight_reservations` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id_reservation`),
  CONSTRAINT `fk_reservations_flight` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id_flight`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation_flight`
--

LOCK TABLES `reservation_flight` WRITE;
/*!40000 ALTER TABLE `reservation_flight` DISABLE KEYS */;
INSERT INTO `reservation_flight` VALUES (1,1,1,NULL,NULL),(3,3,75,NULL,NULL),(4,5,76,NULL,NULL),(5,10,77,NULL,NULL),(6,5,1,NULL,NULL),(7,4,1,NULL,NULL),(8,4,1,NULL,NULL),(9,4,1,NULL,NULL),(10,4,1,NULL,NULL),(11,10,83,NULL,NULL),(12,3,84,NULL,NULL),(13,3,85,NULL,NULL),(14,3,86,NULL,NULL),(15,1,87,NULL,NULL),(16,4,88,2,310),(17,2,88,2,640),(18,4,89,2,310),(19,2,89,2,640),(20,4,90,2,310),(21,2,90,2,640),(22,4,91,2,310),(23,2,91,2,640),(24,4,92,2,310),(25,2,92,2,640),(26,4,93,2,310),(27,2,93,2,640),(28,4,94,2,310),(29,2,94,2,640),(30,4,95,2,310),(31,2,95,2,640),(32,4,96,2,310),(33,2,96,2,640),(34,4,97,2,310),(35,2,97,2,640),(36,4,98,2,310),(37,3,99,4,1340),(38,3,100,1,335);
/*!40000 ALTER TABLE `reservation_flight` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(80) DEFAULT NULL,
  `lastname` varchar(80) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'thomas','betend','$2y$10$KfpTzcYyrI8RfyxtGB8AFOtFnern1/yzUPStQVx9J.Mbz5SBxa3c6','thomas.betend@yahoo.fr'),(2,'lucie','guinebert','$2y$10$UBVHDt1zHVd2q2864mi86.P1DNEeMRZ35tTXTbSNwDJY6.2rHUnsK','lucie.guinebert77@gmail.com'),(3,'vincent','pennec','$2y$10$kwmmpmlW4bfnZd3drhrWKuDU77JJs7evpnB.IXh4ZnKmSgOiCd7CC','veens34@free.fr'),(4,'thomas','leherissé','$2y$10$Q7zHbAWeJXTiVDWbIGs3tucyyIRKruGLL.ldRWyFuleqqToo6oY3u','chronicover@gmail.com'),(5,'','admin','$2y$10$nLSl3OILpsP.raQZLYvLbOfDUCMdHEXmfqpQr/vQVDVRk1mCbQZze','admin@gmail.com'),(6,'jean','dujardin','$2y$10$qP2IoKFPxailVECfBU3i2uu50Xn8NIR50myJ4lZzC5deb22TqdtYa','jean.dujardin@gmail.com'),(10,'Emmanuel','Macron','$2y$10$EUNfMmgZ26lxV8pOjjXh5O6cCmbdDchwBEr7r7RWIa7mTd8PkHasC','emmanuel.macron@gmail.com'),(12,'roger','moore','$2y$10$/gStGpwWVJjLYMXs/69rsOdcY1V.DA9mxhYtNR1tfaFHE96mRUhbu','roger.moore@gmail.com'),(13,'toto','toto','$2y$10$plC9GpxCGzcclITGIO87meKg0wIb1GBBaP4nG1yV3FImuTySvP8h.','toto@gmail.com');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_flight`
--

DROP TABLE IF EXISTS `user_flight`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_flight` (
  `id_user_flight` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `flight_id` int DEFAULT NULL,
  PRIMARY KEY (`id_user_flight`),
  KEY `fk_flight_user_idx` (`flight_id`),
  KEY `fk_user_flight_idx` (`user_id`),
  CONSTRAINT `fk_flight_user` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id_flight`),
  CONSTRAINT `fk_user_flight` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
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

-- Dump completed on 2022-11-21 19:27:12
