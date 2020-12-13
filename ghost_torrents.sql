-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: localhost    Database: ghost_torrents
-- ------------------------------------------------------
-- Server version	5.7.32-0ubuntu0.18.04.1

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) COLLATE latin1_general_ci DEFAULT NULL,
  `content` text COLLATE latin1_general_ci NOT NULL,
  `author` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `image_path` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `interactions` json DEFAULT NULL,
  `date` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (16,'this is my first article','<p><span style=\"color: #ced4d9;\">Hope youre doing good. More good articles to come. Stick with us</span></p>\n<p><span style=\"color: #ced4d9;\">bye</span></p>','henry','/static/article-images/article-image-5fd37ee6edc878.24704064.jpg','[{\"status\": \"liked\", \"username\": \"henry\", \"interact_id\": \"03f922191cbbc8c01729b2c99efcb12d5fd4908e71b2b\"}]','12/11/2020 19:15:02','2020-12-11 14:15:02'),(17,'How to converting JSON text to PHP associative array','<p class=\"lang-php s-code-block hljs\"><code>$assocArray = json_decode($data, <span class=\"hljs-literal\">true</span>);<br /></code><span style=\"color: #ecf0f1;\">The second parameter set the result as an object(false, default) or an associative array(true).</span></p>','james','/static/article-images/175fd46d7ed51df2.59993633.png','[{\"status\": \"liked\", \"username\": \"james\", \"interact_id\": \"778230376987ef4a068d2cf61b8cd7205fd466a152ca9\"}, {\"status\": \"liked\", \"username\": \"tabish\", \"interact_id\": \"df82c013d063a5da11f9b7598b05c1fa5fd49bf8c1645\"}]','12/12/2020 11:43:31','2020-12-12 06:43:31');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `message` text COLLATE latin1_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (11,'tabish','tabish@email.com','this is message from tabish ali\nhi how are you'),(12,'tabish','tabish@email.com','this is message from tabish ali\nhi how are you'),(13,'name','tabish@email.com','sdfadf'),(14,'Ali','tabish@email.com','Hi i am glad to visit your site.\nThanks');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_temp`
--

DROP TABLE IF EXISTS `password_reset_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_temp` (
  `email` varchar(250) NOT NULL,
  `key` varchar(250) NOT NULL,
  `exp_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_temp`
--

LOCK TABLES `password_reset_temp` WRITE;
/*!40000 ALTER TABLE `password_reset_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `torrents`
--

DROP TABLE IF EXISTS `torrents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `torrents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text COLLATE latin1_general_ci,
  `uploader` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `category` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `file_path` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `peers_info` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `comments` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `torrents`
--

LOCK TABLES `torrents` WRITE;
/*!40000 ALTER TABLE `torrents` DISABLE KEYS */;
INSERT INTO `torrents` VALUES (31,'<p>Dead or Alive 5 is a fighting video game in the Dead or Alive series, developed by Team Ninja and released by Tecmo Koei simultaneously for the PlayStation 3 and Xbox 360 in 2012.</p>','tabish','games','/static/torrent-statics/torrent-files/[limetorrents.info]3DMGAME-Dead.or.Alive.5.Last.Round.Update.16.v1.08A.H1..and.Crack-3DM.torrent','null','2020-12-11 13:15:21','12/11/2020 18:15:21','[{\"date\": \"12/12/2020 12:07:01\", \"comment\": \"nice thanks.\", \"username\": \"james\", \"comment_id\": \"a92571a39fab1554dcc5d959746d601c5fd46c15ed449\"}]'),(32,'<p>Half-human, half-Atlantean Arthur is born with the ability to communicate with marine creatures. He goes on a quest to retrieve the legendary Trident of Atlan and protect the water world.</p>','tabish','movies','/static/torrent-statics/torrent-files/[limetorrents.info]Aquaman..2018..720p.BluRay..Org..DD5.1..160Kbps..[Tam...Tel...Hin...Eng]..1.6GB..ESubs.torrent','null','2020-12-11 13:16:57','12/11/2020 18:16:57','[]'),(33,'<p>Baldur\'s Gate III is an upcoming role-playing video game that is being developed and published by Larian Studios. It is the third main game in the Baldur\'s Gate series, itself based on the Dungeons &amp; Dragons tabletop role-playing system.</p>','tabish','movies','/static/torrent-statics/torrent-files/[limetorrents.info]Baldur\'s.Gate.3.v4.1.90.2222..GOG..torrent','{\"seeders\": 2, \"leechers\": 13, \"completed\": 0}','2020-12-11 13:21:11','12/11/2020 18:21:11','[]'),(34,'<p>Hello sailors!<br /><br />The Uncharted Depths update has just been released. Be sure to update your game to the latest version to be able to host and join multiplayer servers! You can find a summary of the update in this <a class=\"eventbbcodeparser_Link_29bMZ\" href=\"https://store.steampowered.com/newshub/app/602960/view/2880578659072337283\"><span data-tooltip-text=\"store.steampowered.com\">this earlier post</span></a>, and scroll further below for the full list of changes.<br /><br />Let us know what you think!</p>','tabish','games','/static/torrent-statics/torrent-files/[limetorrents.info]Barotrauma.Uncharted.Depths.torrent','{\"seeders\": 1, \"leechers\": 3, \"completed\": 7}','2020-12-11 13:29:33','12/11/2020 18:29:33','[]'),(35,'<p><span class=\"ILfuVd\"><span class=\"hgKElc\">Adapted from the short film of the same name, <strong>Don\'t Click</strong> attempts to critique the dark web and the nasty world of underground porn. Unfortunately this disturbingly self congratulatory film ends up being no better than the practices it tries to criticise.</span></span></p>','tabish','movies','/static/torrent-statics/torrent-files/[limetorrents.info]Dont.Click.2020.HDRip.XviD.torrent','{\"seeders\": 2, \"leechers\": 8, \"completed\": 0}','2020-12-11 13:31:26','12/11/2020 18:31:26','[]'),(36,'<p>An Angolan woman and her daughter reunite with her husband after spending 17 years in exile. Now strangers, they find common ground in their shared love of dance.</p>','tabish','movies','/static/torrent-statics/torrent-files/[limetorrents.info]Farewell.Amor.2020.HDRip.XviD.torrent','{\"seeders\": 7, \"leechers\": 8, \"completed\": 33}','2020-12-11 13:34:00','12/11/2020 18:34:00','[{\"date\": \"12/12/2020 15:24:48\", \"comment\": \"nice\", \"username\": \"tabish\", \"comment_id\": \"2ea51dc438bff9e4bf53bd8c6c688d0d5fd49a70abff9\"}]'),(37,'<p>Grand Theft Auto is a series of action-adventure games created by David Jones and Mike Dailly. Later titles were developed under the oversight of brothers Dan and Sam Houser, Leslie Benzies and Aaron Garbut.</p>','tabish','movies','/static/torrent-statics/torrent-files/[limetorrents.info]GTA.NEXTRP.10.12.20.torrent','{\"seeders\": 6, \"leechers\": 1, \"completed\": 5}','2020-12-11 13:36:50','12/11/2020 18:36:50','[{\"date\": \"12/11/2020 18:43:22\", \"comment\": \"Enjoy people. More to come\", \"username\": \"tabish\", \"comment_id\": \"8aa00826735935c7e0e3b267762972305fd3777a3910f\"}]'),(38,'<p>Horizon Zero Dawn is a 2017 action role-playing game developed by Guerrilla Games and published by Sony Interactive Entertainment. The plot follows Aloy, a hunter in a world overrun by machines, who sets out to uncover her past. <a class=\"ruhjFe NJLBac fl\" href=\"https://en.wikipedia.org/wiki/Horizon_Zero_Dawn\" data-ved=\"2ahUKEwj2uuGAisbtAhXimFwKHdfHDEMQmhMwInoECDIQAg\">Wikipedia</a></p>\n<p>Initial release date: February 28, 2017<br />Developer: Guerrilla Games<br />Engine: Decima<br />Series: <span style=\"color: #f1c40f;\"><strong>Horizon</strong></span><br />Platforms: PlayStation 4, Microsoft Windows<br />Awards: Writers Guild of America Award for Achievement in Videogame Writing, MORE</p>','tabish','movies','/static/torrent-statics/torrent-files/[limetorrents.info]Horizon.Zero.Dawn.Complete.Edition.v1.0.9.3..GOG..torrent','{\"seeders\": 1, \"leechers\": 27, \"completed\": 0}','2020-12-11 13:54:44','12/11/2020 18:54:44','[{\"date\": \"12/11/2020 19:18:28\", \"comment\": \"nice one \", \"username\": \"tabish\", \"comment_id\": \"6dffdba4ea3c3ab23d3dbfebc6309c305fd37fb45266c\"}]'),(39,'<p style=\"text-align: justify;\">Roman empire. 20 A.D. very hard times. No! Not for you! For the slaves! You are a damn Roman! You can do whatever you like. You are a god among men! And men (and women) are here for one reason only. To serve you and other Romans. It\'s not all fun and games however. For decades, your family was bringing the best slaves in the republic. You are mostly known for your ability and knowledge in training the most hard, stubborn northern women and bending them to the will of the empire! However, with the last war, money ran out. Now that victory has been achieved on the northern boarders, slaves are pouring in again and you know just what to do with them. It\'s time to fill your purse (and your dungeons) with new toys. And you, my <strong><span style=\"color: #2dc26b;\">noble master</span></strong> you know just how to do that. Release Date: <span style=\"color: #f1c40f;\"><strong>3 December 2020</strong></span></p>\n<p style=\"text-align: justify;\">Genre: 3D Game, Male protagonist, <span style=\"text-decoration: underline;\"><em>Female protagonist</em></span>, Vaginal sex, Simulation, Female domination, Male domination, BDSM <br />Version: 0.9.9 ($100 build)<br />Censorship: No<br />Language: English<br />OS: Windows<br />Enjoy !</p>','tabish','games','/static/torrent-statics/torrent-files/C1E47255F0DDE66BA2BEF147824F1BFB58FABB90.torrent','{\"seeders\": 9, \"leechers\": 2, \"completed\": 619}','2020-12-12 07:36:16','12/12/2020 12:36:16','[]');
/*!40000 ALTER TABLE `torrents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `password` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `image_path` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `intro` text COLLATE latin1_general_ci,
  `admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (5,'henry','henry@email.com','$2y$10$554LBaL/rZ9/cvdXs3a.k.Yj9zAG9hRRCpoxmHKH2.JVrHyEPC3UW','/static/user-images/henry5fd36d848d7080.07423440.jpeg','2020-12-11 13:00:40','Hi my name is henry and i am new member of ghost torrents.',NULL),(6,'tabish','alitabish669@gmail.com','$2y$10$Lkzbsr3/eWq3tFTi5f1Lxum5oX2393OEQisjfVqBJUfHk2tkl2Oi6','/static/user-images/tabish5fd36f695948c2.47409017.jpg','2020-12-11 13:01:51','Hi i am Tabish developer and programmer of Ghost Torrents.',1),(7,'james','james@email.com','$2y$10$.l7p7naDA2I9olueXAnuwe/v./U85KFjJadU6vnWVOVVskJwmXpdS','/static/user-images/james5fd465d176ae26.64607412.jpg','2020-12-12 05:04:06','Hi my name is james.',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-13 11:51:13
