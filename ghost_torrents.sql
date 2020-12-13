
-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: ghost_torrents
-- ------------------------------------------------------
-- Server version	8.0.22-0ubuntu0.20.04.2

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) DEFAULT NULL,
  `content` text NOT NULL,
  `author` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `image_path` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `interactions` json DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (2,'How to manage JSON object in sql.','<p><span style=\"color: #ced4d9;\">In this article we are going to look that how we can populate json object in sql.</span></p>\n<p><span style=\"font-size: 12pt; color: #ced4d9;\">So first we need to make data type in sql. If you don\'t seed json data type in your database manager no worries you can also used long text to store json array.</span></p>\n<p><span style=\"color: #ced4d9;\">So First we need to make empty json object. Query is :</span></p>\n<div style=\"color: #d4d4d4; background-color: #1e1e1e; font-family: \'Droid Sans Mono\', \'monospace\', monospace, \'Droid Sans Fallback\'; font-weight: normal; font-size: 14px; line-height: 19px; white-space: pre;\">\n<div><span style=\"color: #569cd6;\">INSERT</span><span style=\"color: #ce9178;\"> </span><span style=\"color: #569cd6;\">INTO</span><span style=\"color: #ce9178;\"> table (json_array</span><span style=\"color: #ce9178;\">) </span><span style=\"color: #569cd6;\">VALUES</span><span style=\"color: #ce9178;\">(JSON_ARRAY());</span></div>\n</div>','tabish','/static/article-images/25faf96c4929665.53613410.png','[{\"status\": \"liked\", \"username\": \"ali\", \"interact_id\": \"1b4054573bfc670d52a43345a97bdce45f89a5655a1f1\"}, {\"status\": \"liked\", \"username\": \"tabish\", \"interact_id\": \"29798c4d89512c26dbd0a49f9ee1940f5fad68b95567b\"}]','09/05/2020 23:13:29','2020-09-05 18:13:29'),(10,'Article 2','1914 translation by H. Rackham\n\n\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"\nSection 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\n\n\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"','tabish','/static/article-images/105f8bd6b949ebd2.37455679.png','[{\"status\": \"liked\", \"username\": \"ali\", \"interact_id\": \"158a28927d585278385dedcddfb3d5c25f89a5f1ec2e0\"}, {\"status\": \"liked\", \"username\": \"tabish\", \"interact_id\": \"4cc4ac9c43b8b0326f9e056de53a626a5f8bd6d0e979a\"}]','09/11/2020 20:01:36','2020-09-11 15:01:36'),(15,'test','<p><span style=\"background-color: #000000;\"><strong><span style=\"color: #ecf0f1;\">this is test article and i would like to enter some of the articles and we are using tinymce and it is very light textarea plugin and very <span style=\"color: #e03e2d;\">efficient.</span></span></strong></span></p>','tabish','/static/article-images/default.jpg','[]','11/14/2020 10:01:37','2020-11-14 05:01:37');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_temp`
--

DROP TABLE IF EXISTS `password_reset_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
INSERT INTO `password_reset_temp` VALUES ('alitabish669@gmail.com','03da61d2af3a270799ac64462cd17bc6420b6b284e','2020-11-15 16:02:25'),('alitabish669@gmail.com','03da61d2af3a270799ac64462cd17bc67313114a00','2020-11-15 16:03:32');
/*!40000 ALTER TABLE `password_reset_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `torrents`
--

DROP TABLE IF EXISTS `torrents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `torrents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` text,
  `uploader` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `file_path` varchar(200) DEFAULT NULL,
  `peers_info` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date` varchar(100) DEFAULT NULL,
  `comments` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `torrents`
--

LOCK TABLES `torrents` WRITE;
/*!40000 ALTER TABLE `torrents` DISABLE KEYS */;
INSERT INTO `torrents` VALUES (1,'This is big buck bunny torrent.','tabish','movies','/static/torrent-statics/torrent-files/big-buck-bunny.torrent','{\"seeders\": 9, \"leechers\": 4, \"completed\": 627}','2020-09-02 07:03:12','09/02/2020 12:03:12','[{\"date\": \"09/29/2020 10:17:49\", \"comment\": \"wow very nice torrent.\", \"username\": \"tabish\", \"comment_id\": \"a45d6f2aa25f021fb83ba415c1b281ae5f72c37d027f5\"}, {\"date\": \"10/15/2020 21:14:55\", \"comment\": \"nice\", \"username\": \"tabish\", \"comment_id\": \"1d2290b314969c3682131bbff7f8e5855f88757f92309\"}, {\"date\": \"10/16/2020 19:06:00\", \"comment\": \"Very nice torrent. Thanks\", \"username\": \"ali\", \"comment_id\": \"e286e5478ebec170b1cf00161703118f5f89a8c853f85\"}]'),(2,'This is cosmos-laundromat torrent.','tabish','movies','/static/torrent-statics/torrent-files/cosmos-laundromat.torrent','{\"seeders\": 12, \"leechers\": 0, \"completed\": 49}','2020-09-02 07:03:52','09/02/2020 12:03:52','[]'),(29,'','tabish','movies','/static/torrent-statics/torrent-files/1C11F931CA0E0CBB47F63E59E6A6B76277E772E6.torrent','{\"seeders\": 9, \"leechers\": 131, \"completed\": 0}','2020-11-15 05:15:05','11/15/2020 10:15:05','[]');
/*!40000 ALTER TABLE `torrents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `image_path` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `intro` text,
  `admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'tabish','alitabish669@gmail.com','$2y$10$FPHy9.JCblZc7h6wOcGFLuxa7Nn10U7ChwmooF2Jn/Dnf8r98ULPe','/static/user-images/tabish5f89b47c3fb142.59892861.png','2020-09-01 14:45:09','Hi this is tabish, developer of this site. I am enhancing this site. Soon i will online it.',1),(4,'ali','ali@email.com','$2y$10$MRihLqMu.v6aILgRoxtgw.7Jma70KMUctcej59RkEsvwxXenrizeq','/static/user-images/ali5f54975aa35dc6.55581135.jpg','2020-09-01 15:09:22','this is intro',NULL);
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

-- Dump completed on 2020-11-15 16:33:21



