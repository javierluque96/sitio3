-- MariaDB dump 10.19  Distrib 10.5.9-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: librarian
-- ------------------------------------------------------
-- Server version	10.5.9-MariaDB

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

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author` (
  `id_author` int(11) NOT NULL AUTO_INCREMENT,
  `name_author` varchar(40) NOT NULL,
  `surname_author` varchar(80) NOT NULL,
  PRIMARY KEY (`id_author`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (1,'Karilynn','Coke'),(2,'Gonzalo','Dolder'),(3,'Bartie','Gilliat'),(4,'Priscella','Bengochea'),(5,'Kaela','Gerrietz'),(6,'Andee','Cowdroy'),(7,'Sayers','Blundon'),(8,'Laureen','Tythe'),(9,'Ansley','Rubke'),(10,'Garvin','Bortolozzi'),(11,'Jennica','Grimolbie'),(12,'Rahel','Lewsy'),(13,'Oriana','Mumbray'),(14,'Padraic','Nibloe'),(15,'Mirabelle','Sighart'),(16,'Cob','Tilzey'),(17,'Sheree','Buggy'),(18,'Rustie','Novotne'),(19,'Karry','Biford'),(20,'Frants','Gelardi');
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book` (
  `id_book` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `pages` int(11) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `borrowed` int(11) NOT NULL,
  `genre` varchar(30) NOT NULL,
  PRIMARY KEY (`id_book`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES (1,'Keeper of Lost Causes, The (Kvinden i buret)',85,'150250357-3',0,'Crime|Mystery|Thriller'),(2,'Simpatico',242,'094861540-0',0,'Comedy|Drama'),(3,'Sharon\'s Baby',371,'174694050-6',0,'Horror'),(4,'Lost Souls',405,'267589929-1',0,'Drama|Horror|Thriller'),(5,'Caesar Must Die (Cesare deve morire)',297,'776147618-7',0,'Drama'),(6,'BBOY for LIFE',237,'621839223-6',0,'Adventure|Crime|Documentary|Dr'),(7,'Thin Blue Line, The',118,'787061325-8',0,'Documentary'),(8,'Garbage Pail Kids Movie, The',246,'684301845-9',0,'Adventure|Children|Comedy'),(9,'Lincz',266,'864636438-0',0,'Drama|Thriller'),(10,'Think Fast, Mr. Moto',487,'641365691-3',0,'Crime|Drama|Mystery|Thriller'),(11,'Hostile Intentions',170,'349206703-4',0,'Action|Drama|Thriller'),(12,'Tall Tale',346,'470453003-5',0,'Adventure|Children|Fantasy|Wes'),(13,'Universal Soldier',279,'435362297-8',0,'Action|Sci-Fi'),(14,'D.O.A.',295,'660957419-7',0,'Documentary'),(15,'Wild Things',349,'128250135-6',0,'Crime|Drama|Mystery|Thriller'),(16,'Born on the Fourth of July',347,'456294469-2',0,'Drama|War'),(17,'Missing Picture, The (L\'image manquante)',117,'732712578-7',0,'Documentary'),(18,'Sun Alley (Sonnenallee)',137,'783030769-5',0,'Comedy|Romance'),(19,'Nightmare Man',493,'853127752-3',0,'Comedy|Horror|Thriller'),(20,'Hidden Blade, The (Kakushi ken oni no tsume)',84,'637736836-4',0,'Action|Drama|Romance');
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan`
--

DROP TABLE IF EXISTS `loan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan` (
  `date_start` date NOT NULL,
  `id_loan` int(11) NOT NULL AUTO_INCREMENT,
  `date_end` date NOT NULL,
  `id_book` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_loan`),
  UNIQUE KEY `id_book` (`id_book`,`id_user`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `loan_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`),
  CONSTRAINT `loan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan`
--

LOCK TABLES `loan` WRITE;
/*!40000 ALTER TABLE `loan` DISABLE KEYS */;
/*!40000 ALTER TABLE `loan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name_user` varchar(40) NOT NULL,
  `surname_user` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(75) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int(11) DEFAULT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Catina','Seeks','cseeks0@newyorker.com','432-900-6082','05 Sheridan Terrace','$2y$10$gnMDZBKvF.ciRpeKS9Y1r.ORImXVFpShiOFBjqu3hztX0WKaMygjS',20,NULL),(2,'Corella','Du Barry','cdubarry1@statcounter.com','236-975-1483','077 La Follette Avenue','$2y$10$qw4sNT38rrJcZ5wiwljrZe28P8CcGNyRmwdBULnmmlR8IdDAoTo8.',10,NULL),(3,'Garey','Darben','gdarbon2@prweb.com','313-613-6293','11112 Warbler Avenue','$2y$10$K/X4IdN7TY4AIGUsevikjuELs7p6ziuDnJPAWR3Qvlc3F9K8wWsVa',20,NULL),(4,'Carrol','Lorenz','clorenz3@etsy.com','165-467-8298','47244 Milwaukee Lane','$2y$10$l7zoG1r7urbV6TVG0LGE9emKr83Eh.8loMnj4CcSosVdFUXnWh3Ce',20,NULL),(5,'Luise','Huckerbe','lhuckerbe4@independent.co.uk','358-816-0547','316 3rd Crossing','$2y$10$ES3G2B.outYXEWfYcj3j3OZ/o6ibl.Skh3oF5xT6HEe96xEOuMTye',20,NULL),(6,'Caritta','Foxley','cfoxley5@theglobeandmail.com','895-836-7292','31 Hoard Road','$2y$10$VagO3h9RrrUHCblb3bHvcuoe3S5VFozUMOgYBlNc30o86GEPs8Yc.',20,NULL),(7,'Gifford','Quinane','gquinane6@ucsd.edu','495-646-2603','74 Roxbury Pass','$2y$10$jt6Ex00bjymrDZG4O8hlzeGAqiDoTCBt/DMcOQt4peikkh4x7Iwti',20,NULL),(8,'Angele','Mayling','amayling7@unicef.org','883-316-7504','1 Autumn Leaf Trail','$2y$10$P259vNXol1C/7EgSEm5VpOWtaY0JKFM9F0InCZGcx0lsTam5MOWeO',20,NULL),(9,'Rodolfo','Macci','rmacci8@youtu.be','985-183-8854','17666 Arapahoe Street','$2y$10$sExbtU/FCznvPp2D7ExIdOuJCoc890OM4ECwfwy2tX2dx94S9aPe6',20,NULL),(10,'Belle','Chidgey','bchidgey9@hubpages.com','802-382-0370','325 Monica Lane','$2y$10$keW3EOBHEMQDE0FpDB30nuLykxAfyLUoiUCmJB9paQh2JsuNHgeje',20,NULL),(11,'Meade','McKirdy','mmckirdya@mediafire.com','471-564-1408','72 Caliangt Place','$2y$10$NA2Ux8vCp2WiTq/gptf25OXojpYgkivEAbiVyS.4yW0HHTR96C3eK',20,NULL),(12,'Clyve','MacKerley','cmackerleyb@artisteer.com','463-584-8207','556 Eagle Crest Lane','$2y$10$HezWAIyisy0NSd.huzUuluJoh4PR4N5ywH.5.WPjQeo2Lp8.emyF.',20,NULL),(13,'Crosby','Squirrell','csquirrellc@webs.com','157-931-6087','5995 Stoughton Place','$2y$10$w6/TtJgrPdgWJddub1ITA./pUG.MOo5sKLaOUV3oCtZC3P5WAEKgK',20,NULL),(14,'Janeen','Ayshford','jayshfordd@g.co','174-846-9675','2 Morning Road','$2y$10$m/rr9wkSMHmuBuSKn80N3.Eo.Euqn.5FMdEDGDGw5NqQH8AsMeL/W',20,NULL),(15,'Ramonda','Blincow','rblincowe@blogger.com','943-946-1217','7562 Morning Terrace','$2y$10$c/mZCFTlxgVupb1eJihRHenlBxHv6WP35URtSzDWkAOdmzs33Ycie',20,NULL),(16,'Pat','Bruyntjes','pbruyntjesf@eepurl.com','752-126-7667','17 Darwin Park','$2y$10$CJ2N9SXnyKDU3W0sywe2YOFSV0jBoQQmDfdDFMZeiBRjkYV.qHu.6',20,NULL),(17,'Victor','Gittins','vgittinsg@qq.com','889-630-5110','203 Lawn Avenue','$2y$10$.aVB/JmAn80d2NV04ToFuOtQ9Zea.YOtqABPBrP83kS2U7RsEIuEy',20,NULL),(18,'Murdock','Joliffe','mjoliffeh@jiathis.com','432-556-3239','0 Lindbergh Parkway','$2y$10$YJ9ZzqUW7dC3LDGsd0sGAOiqJIRi/Ye2vcoE8RrDGZd7bZbK9lO.G',20,NULL),(28,'Javier','Rodríguez','luque@gmail.com','612345678','Calle Málaga N7','$2y$10$6Mf5mmeDBvoCj1T0zNKtUO757V1vKxLzuvgDDz00bj6LRZDNlJkQO',10,'c899dae827827a170504d347b753e059'),(29,'Bilbo','Bolson','bilbobolson@librarian.com','','C/Comarca 10','$2y$10$4JfPhpHJ.DGGkEdP3zukE.O0F1bhIGf2sDyzKapeAW5tzc3k1uDau',1,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `written`
--

DROP TABLE IF EXISTS `written`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `written` (
  `id_book` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  PRIMARY KEY (`id_book`,`id_author`),
  KEY `id_author` (`id_author`),
  CONSTRAINT `written_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`),
  CONSTRAINT `written_ibfk_2` FOREIGN KEY (`id_author`) REFERENCES `author` (`id_author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `written`
--

LOCK TABLES `written` WRITE;
/*!40000 ALTER TABLE `written` DISABLE KEYS */;
INSERT INTO `written` VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10),(11,11),(12,12),(13,13),(14,14),(15,15),(16,16),(17,17),(18,18),(19,19),(20,20);
/*!40000 ALTER TABLE `written` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-28 15:56:43
