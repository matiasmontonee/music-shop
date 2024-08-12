-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: dw3_montone_guastavino
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.24-MariaDB

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
-- Table structure for table `cds`
--

DROP TABLE IF EXISTS `cds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cds` (
  `cd_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) DEFAULT NULL,
  `sinopsis` text DEFAULT NULL,
  `precio` decimal(2,0) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `texto` text DEFAULT NULL,
  `discografica_id` int(10) unsigned DEFAULT NULL,
  `productor_id` int(10) unsigned DEFAULT NULL,
  `genero_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`cd_id`),
  KEY `precio_INDEX` (`precio`),
  KEY `fk_cds_discografica` (`discografica_id`),
  KEY `fk_cds_productor` (`productor_id`),
  KEY `fk_cds_genero` (`genero_id`),
  CONSTRAINT `fk_cds_discografica` FOREIGN KEY (`discografica_id`) REFERENCES `discograficas` (`discografica_id`),
  CONSTRAINT `fk_cds_genero` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`genero_id`),
  CONSTRAINT `fk_cds_productor` FOREIGN KEY (`productor_id`) REFERENCES `productores` (`productor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cds`
--

LOCK TABLES `cds` WRITE;
/*!40000 ALTER TABLE `cds` DISABLE KEYS */;
INSERT INTO `cds` VALUES (1,'Is This It','Primer álbum de estudio de The Strokes.',10,'assets/imgs/is_this_it.png','Is This It —en español: ¿Esto es todo?— es el álbum debut de la banda de rock estadounidense The Strokes. Grabado en el estudio Transporterraum de Nueva York con el productor Gordon Raphael, el álbum se publicó por primera vez el 30 de julio de 2001 en Australia, con RCA Records como compañía discográfica.',1,1,1),(2,'Room On Fire','Segundo álbum de estudio de The Strokes.',12,'assets/imgs/room_on_fire.png','Room On Fire —en español: Habitación En Llamas-es el segundo álbum de la banda The Strokes. Publicado en Octubre de 2003, incluyendo tres sencillos: «12:51», «Reptilia» y «The End Has No End».',1,1,1),(3,'First Impressions Of Earth','Tercer álbum de estudio de The Strokes.',13,'assets/imgs/first_impressions_of_earth.png','First Impressions of Earth —en español: Primeras impresiones de la Tierra—es el tercer álbum de la banda de rock estadounidense The Strokes. Fue publicado en enero de 2006, siendo precedido por el sencillo hit \'Juicebox\' algunas semanas antes. Además, es el primer álbum de The Strokes con Parental Advisory.',1,1,1),(4,'Angles','Cuarto álbum de estudio de The Strokes.',14,'assets/imgs/angles.png','Angles -en español: Anglos-es el cuarto álbum de estudio de la banda de rock estadounidense The Strokes, que fue lanzado el 21 de Marzo de 2011 en el Reino Unido y un día después en los Estados Unidos.',1,2,1),(5,'Comedown Machine','Quinto álbum de estudio de The Strokes.',12,'assets/imgs/comedown_machine.png','Comedown Machine es el quinto álbum de estudio de la banda de indie rock estadounidense The Strokes, programado para lanzarse el 26 de Marzo de 2013 en los Estados Unidos y el 25 de Marzo en el Reino Unido, exactamente dos años después que su anterior disco, Angles.',1,2,1),(6,'The New Abnormal','Sexto álbum de estudio de The Strokes.',13,'assets/imgs/the_new_abnormal.png','The New Abnormal —en español: la nueva anormalidad— es el sexto álbum de estudio de la banda de garage rock estadounidense The Strokes. Fue lanzado el 10 de Abril de 2020 en todas las plataformas y países.',2,3,1),(7,'Bleach','Primer álbum de estudio de Nirvana.',12,'assets/imgs/bleach.png','Bleach —en español: «Lejía» o «Blanqueador»— es el álbum debut de la banda de grunge estadounidense Nirvana, lanzado en Junio de 1989 a través del sello discográfico independiente Sub Pop.',3,4,2),(8,'Nevermind','Segundo álbum de estudio de Nirvana.',16,'assets/imgs/nevermind.png','Nevermind es el segundo álbum de estudio de la banda estadounidense de grunge Nirvana, publicado en Septiembre de 1991. Producido por Butch Vig, Nevermind fue el primer lanzamiento de la banda con DGC Records.',4,5,2),(9,'Incesticide','Álbum de rarezas, lados b y otras grabaciones',11,'assets/imgs/incesticide.png','Incesticide es un álbum recopilatorio de rarezas, lados b y otras grabaciones de estudio lanzado por Nirvana el 14 de Diciembre de 1992 en Europa y al día siguiente en Estados Unidos, por medio de Geffen Records en colaboración con Sub Pop.',4,4,2),(10,'In Utero','Tercer álbum de estudio de Nirvana.',10,'assets/imgs/in_utero.png','In Utero es el tercer y último álbum de estudio de la banda estadounidense de grunge Nirvana, lanzado en septiembre de 1993 por DGC Records. Nirvana pretendía que esta grabación sonara diferente a la pulida producción de su anterior álbum, Nevermind.',4,6,2),(11,'MTV Unplugged','Álbum en vivo de una actuación acústica.',14,'assets/imgs/mtv_unplugged.png','MTV Unplugged in New York es un álbum en vivo de la banda de rock estadounidense Nirvana, lanzado el 1 de noviembre de 1994 por DGC Records. Presenta una actuación acústica grabada en Sony Music Studios en la ciudad de Nueva York el 18 de Noviembre de 1993 para la serie de televisión MTV Unplugged.',5,4,2),(12,'Nirvana','Álbum recopilatorio de la banda.',18,'assets/imgs/nirvana.png','Nirvana es un álbum recopilatorio de la banda estadounidense de género grunge homónima, lanzado el 29 de octubre de 2002. para promocionar el álbum fue lanzada una canción inédita de la banda titulada «you know youre right». en australia fue certificado con tres discos de platino.',4,4,2);
/*!40000 ALTER TABLE `cds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cds_compras`
--

DROP TABLE IF EXISTS `cds_compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cds_compras` (
  `cd_id` int(10) unsigned NOT NULL,
  `compras_id` int(11) NOT NULL,
  `precio_total` decimal(10,0) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`cd_id`,`compras_id`),
  KEY `FK_CDS_COMPRAS_COMPRA_idx` (`compras_id`),
  CONSTRAINT `FK_CDS_COMPRAS_CD` FOREIGN KEY (`cd_id`) REFERENCES `cds` (`cd_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_CDS_COMPRAS_COMPRA` FOREIGN KEY (`compras_id`) REFERENCES `compras` (`compra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cds_compras`
--

LOCK TABLES `cds_compras` WRITE;
/*!40000 ALTER TABLE `cds_compras` DISABLE KEYS */;
/*!40000 ALTER TABLE `cds_compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras` (
  `compra_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(10) unsigned DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`compra_id`),
  KEY `fk_compras_usuarios` (`usuario_id`),
  CONSTRAINT `fk_compras_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discograficas`
--

DROP TABLE IF EXISTS `discograficas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discograficas` (
  `discografica_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`discografica_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discograficas`
--

LOCK TABLES `discograficas` WRITE;
/*!40000 ALTER TABLE `discograficas` DISABLE KEYS */;
INSERT INTO `discograficas` VALUES (1,'RCA Records'),(2,'Cult Records'),(3,'SUB POP'),(4,'DGC Records'),(5,'Geffen Records'),(6,'Sony Music'),(7,'Universal Music'),(8,'Warner Music'),(9,'EMI'),(10,'Otra');
/*!40000 ALTER TABLE `discograficas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generos`
--

DROP TABLE IF EXISTS `generos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generos` (
  `genero_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`genero_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generos`
--

LOCK TABLES `generos` WRITE;
/*!40000 ALTER TABLE `generos` DISABLE KEYS */;
INSERT INTO `generos` VALUES (1,'Indie rock'),(2,'Grunge'),(3,'Pop'),(4,'Jazz'),(5,'Rock'),(6,'Electrónica'),(7,'Hip Hop'),(8,'Clásica'),(9,'Reggae'),(10,'Otro');
/*!40000 ALTER TABLE `generos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productores`
--

DROP TABLE IF EXISTS `productores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productores` (
  `productor_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`productor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productores`
--

LOCK TABLES `productores` WRITE;
/*!40000 ALTER TABLE `productores` DISABLE KEYS */;
INSERT INTO `productores` VALUES (1,'Gordon Raphael'),(2,'Gus Oberg, Joe Chicarelli'),(3,'Rick Rubin'),(4,'Jack Endino'),(5,'Butch Vig'),(6,'Steve Albini, Scott Litt'),(7,'Max Martin'),(8,'Quincy Jones'),(9,'Rick Rubin'),(10,'Otro');
/*!40000 ALTER TABLE `productores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `rol_id` int(10) unsigned NOT NULL,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador'),(2,'Usuario');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `usuario_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `correo_electronico` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `correo_electronico_UNIQUE` (`correo_electronico`),
  KEY `rol_id` (`rol_id`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (3,'Matías','root@gmail.com','$2y$10$ZwUiAau0r62ulreLc4WTRuoSNHNgBNrK4yWznwwixJv3ataj1DMae',1),(23,'Andrés','andres@gmail.com','$2y$10$MsnaVjSTHjw6YP1hYUmMiOZX0KwAj.XXiGI3yW9xg7a7Yy06/6H.C',2);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-06  8:58:40


--
-- Ejemplo de UPDATE en la tabla `cds`
--

-- Actualizar el título del CD con cd_id = 1
-- UPDATE cds SET titulo = 'Antics' WHERE cd_id = 1;

--
-- Ejemplo de SELECT en la tabla `cds`
--

-- Seleccionar todas las columnas de la tabla cds donde genero_id es 1
-- SELECT * FROM cds WHERE genero_id = 1;

--
-- Ejemplo de INSERT en la tabla `cds`
--

-- Insertar un nuevo CD en la tabla cds
-- INSERT INTO cds (titulo, sinopsis, precio, imagen, texto, discografica_id, productor_id, genero_id)
-- VALUES ('Antics', 'primer CD de Interpol', 15, 'img/antics.jpg', 'album debut de interpol producido en nueva york', 2, 3, 4);

--
-- Ejemplo de DELETE en la tabla `cds`
--

-- Eliminar el CD con cd_id = 3 de la tabla cds
-- DELETE FROM cds WHERE cd_id = 3;