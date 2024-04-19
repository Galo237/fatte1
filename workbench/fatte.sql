-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: fatte
-- ------------------------------------------------------
-- Server version	8.0.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrador` (
  `admId` int NOT NULL AUTO_INCREMENT,
  `admEmail` varchar(100) DEFAULT NULL,
  `admSenha` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`admId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `cliId` int NOT NULL AUTO_INCREMENT,
  `cliAdmId` int DEFAULT NULL,
  `cliEmail` varchar(100) DEFAULT NULL,
  `cliSenha` varchar(50) DEFAULT NULL,
  `cliNome` varchar(80) DEFAULT NULL,
  `cliTelefone` varchar(25) DEFAULT NULL,
  `cliGenero` enum('M','F','O','N') DEFAULT 'M',
  PRIMARY KEY (`cliId`),
  KEY `fk_cliente_administrador1_idx` (`cliAdmId`),
  CONSTRAINT `fk_cliente_administrador1` FOREIGN KEY (`cliAdmId`) REFERENCES `administrador` (`admId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `pedId` int NOT NULL AUTO_INCREMENT,
  `pedCliId` int DEFAULT NULL,
  `pedCodigo` varchar(30) DEFAULT NULL,
  `pedData` datetime DEFAULT NULL,
  PRIMARY KEY (`pedId`),
  KEY `fk_pedidos_cliente1_idx` (`pedCliId`),
  CONSTRAINT `fk_pedidos_cliente1` FOREIGN KEY (`pedCliId`) REFERENCES `cliente` (`cliId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `proId` int NOT NULL AUTO_INCREMENT,
  `proAdmId` int DEFAULT NULL,
  `proPedId` int DEFAULT NULL,
  `proNome` varchar(80) DEFAULT NULL,
  `proGenero` enum('M','F') DEFAULT 'M',
  `proPreco` float DEFAULT NULL,
  `proDescricao` mediumblob,
  `proTipo` varchar(60) DEFAULT NULL,
  `proTamanho` enum('P','M','G') DEFAULT 'M',
  PRIMARY KEY (`proId`),
  KEY `fk_produtos_administrador1_idx` (`proAdmId`),
  KEY `fk_produtos_pedidos1_idx` (`proPedId`),
  CONSTRAINT `fk_produtos_administrador1` FOREIGN KEY (`proAdmId`) REFERENCES `administrador` (`admId`),
  CONSTRAINT `fk_produtos_pedidos1` FOREIGN KEY (`proPedId`) REFERENCES `pedidos` (`pedId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-18 22:14:58
