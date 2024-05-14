-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: fatte
-- ------------------------------------------------------
-- Server version	8.0.34

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
  `admNome` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`admId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` VALUES (1,'momoide@gmail.com','master100','Momo');
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `catId` int NOT NULL AUTO_INCREMENT,
  `catProId` int NOT NULL,
  `catNome` varchar(100) DEFAULT NULL,
  `catGenero` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`catId`),
  KEY `fk_categoria_produtos1_idx` (`catProId`),
  CONSTRAINT `fk_categoria_produtos1` FOREIGN KEY (`catProId`) REFERENCES `produtos` (`proId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
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
  `cliSenha` varchar(255) DEFAULT NULL,
  `cliNome` varchar(80) DEFAULT NULL,
  `cliTelefone` varchar(25) DEFAULT NULL,
  `cliGenero` enum('M','F','O','N') DEFAULT 'M',
  PRIMARY KEY (`cliId`),
  KEY `fk_cliente_administrador1_idx` (`cliAdmId`),
  CONSTRAINT `fk_cliente_administrador1` FOREIGN KEY (`cliAdmId`) REFERENCES `administrador` (`admId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,NULL,'lucas@dev.com','Master@100','Pablo','41991591003','N'),(2,NULL,'rafael@dev.com','','Rafael','41991591003','M'),(3,NULL,'kucha@dev.com','','Kucha','41991591003','M'),(4,NULL,'rafael@gmail.com','$2y$10$RiBTQzUubib1nzJKiip7pO3IsEdXixpUl6k27K9xRZAMdp6ndNtZe','rafael','41991591003','M'),(5,NULL,'carlos@gmail.com','$2y$10$Q.I3u66FaDy65MQQSUGqH.uA.0Yd/MY6tiNDF6kAOKgb4FRkwxQiK','Carlos','41991591003','M');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itenspedido`
--

DROP TABLE IF EXISTS `itenspedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `itenspedido` (
  `itpId` int NOT NULL AUTO_INCREMENT,
  `itpProId` int DEFAULT NULL,
  `itpPedId` int DEFAULT NULL,
  `qtdPedido` double DEFAULT NULL,
  PRIMARY KEY (`itpId`),
  KEY `fk_itensPedido_produtos1_idx` (`itpProId`),
  KEY `fk_itensPedido_pedidos1_idx` (`itpPedId`),
  CONSTRAINT `fk_itensPedido_pedidos1` FOREIGN KEY (`itpPedId`) REFERENCES `pedidos` (`pedId`),
  CONSTRAINT `fk_itensPedido_produtos1` FOREIGN KEY (`itpProId`) REFERENCES `produtos` (`proId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itenspedido`
--

LOCK TABLES `itenspedido` WRITE;
/*!40000 ALTER TABLE `itenspedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `itenspedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `pedId` int NOT NULL AUTO_INCREMENT,
  `pedStaId` int DEFAULT NULL,
  `pedCliId` int DEFAULT NULL,
  `pedCodigo` varchar(30) DEFAULT NULL,
  `pedData` datetime DEFAULT NULL,
  PRIMARY KEY (`pedId`),
  KEY `fk_pedidos_cliente1_idx` (`pedCliId`),
  KEY `fk_pedidos_status1_idx` (`pedStaId`),
  CONSTRAINT `fk_pedidos_cliente1` FOREIGN KEY (`pedCliId`) REFERENCES `cliente` (`cliId`),
  CONSTRAINT `fk_pedidos_status1` FOREIGN KEY (`pedStaId`) REFERENCES `status` (`staId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
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
  `proNome` varchar(80) DEFAULT NULL,
  `proGenero` enum('M','F') DEFAULT 'M',
  `proPreco` float DEFAULT NULL,
  `proDescricao` mediumblob,
  `proTipo` varchar(60) DEFAULT NULL,
  `proTamanho` enum('P','M','G') DEFAULT 'M',
  `proImagem` blob,
  PRIMARY KEY (`proId`),
  KEY `fk_produtos_administrador1_idx` (`proAdmId`),
  CONSTRAINT `fk_produtos_administrador1` FOREIGN KEY (`proAdmId`) REFERENCES `administrador` (`admId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,NULL,'Casaco do Vale','M',120,_binary 'Utomo da fatte.','Casaco','M',''),(2,NULL,'Camisa do Utomo','M',200,_binary 'O utomo foi a loucura!!','Camisa','P',''),(3,NULL,'Calça do PUC','M',300,_binary 'Quem não quer uma calça da pontifícia','Calça','G',''),(4,NULL,'Through The Valley','F',130,_binary 'O melhor top para o verão','Top','P',''),(5,NULL,'abc','M',12,_binary 'abcde','cde','P',''),(6,NULL,'teste','M',1200,_binary 'Para de falar que tu é minha namorrrrrrr','teste','P',''),(7,NULL,'Casaquin do Totomo','M',250,_binary 'Ta frio!!','casaquin','G',''),(8,NULL,'fatte','F',100,_binary 'top','Top','P','');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status` (
  `staId` int NOT NULL AUTO_INCREMENT,
  `staCor` varchar(100) DEFAULT NULL,
  `staNome` varchar(100) DEFAULT NULL,
  `staIcone` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`staId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-14 11:08:20
