-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB-0+deb9u1

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
-- Table structure for table `access_time`
--

DROP TABLE IF EXISTS `access_time`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access_time` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(3) DEFAULT NULL,
  `Mon` varchar(3) DEFAULT NULL,
  `Tue` varchar(3) DEFAULT NULL,
  `Wed` varchar(3) DEFAULT NULL,
  `Thu` varchar(3) DEFAULT NULL,
  `Fri` varchar(3) DEFAULT NULL,
  `Sat` varchar(3) DEFAULT NULL,
  `Sun` varchar(3) DEFAULT NULL,
  `stime` varchar(5) DEFAULT NULL,
  `etime` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_time`
--

LOCK TABLES `access_time` WRITE;
/*!40000 ALTER TABLE `access_time` DISABLE KEYS */;
INSERT INTO `access_time` VALUES (1,'any','Mon','Tue','Wed','Thu','Fri','Sat','Sun','00:00','23:59');
/*!40000 ALTER TABLE `access_time` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_tokens`
--

DROP TABLE IF EXISTS `auth_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_tokens` (
  `id` smallint(6) DEFAULT NULL,
  `selector` varchar(16) DEFAULT NULL,
  `token` varchar(64) DEFAULT NULL,
  `userid` tinyint(4) DEFAULT NULL,
  `expires` varchar(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_tokens`
--

LOCK TABLES `auth_tokens` WRITE;
/*!40000 ALTER TABLE `auth_tokens` DISABLE KEYS */;
INSERT INTO `auth_tokens` VALUES (1,'NzYyNjEyNDM5','932f4f91d2af5fa197d4188944c5ca825c422dec821f830d2cdfb9bebdad45b2',1,'2018-07-21T21:35:47'),(2,'MzQ1MjcyMzAy','3feb76f2c0eea74824a0eec85414ea9faa0c0014a9f0dd25f788db65563c9672',1,'2018-08-03T09:09:02'),(3,'MTcyMzc1NTgxMA==','779747dea129dfbba0c8e63d4fd710e28a431a8591ce3e4bb3a080072ac8e0ed',1,'2018-08-17T08:56:52'),(4,'MTY0MDM3MDUyNg==','0e16096e642eabd2079618a17d97371a05cc31832edf63b3840b55ab0b63e23c',1,'2018-08-17T08:57:23'),(5,'MTg1OTMxOTI5Nw==','ca1c9094d69007f4790ae98b172e8073666473d665f42de4d86694b7d8767565',1,'2018-08-17T09:57:21'),(6,'MTczOTAwOTAxNA==','3ac0535926d9534d9d813dfdaf766df137f15c28b0e236b0d4946acd517db1bd',1,'2018-08-17T10:28:36'),(7,'NjQ0MDQ5MDE2','b8de0392f7cc0a6cdc469482333ab76be90d2f93fe622cddf15efe55727e9506',1,'2018-08-19T13:54:41'),(8,'MTM0NzkwOTc0Nw==','2a5dec299da16ff579a9ffd3a016bffdc64020f2237303f23a913c9230833819',1,'2018-08-24T14:13:19'),(9,'NjYyNzA4NDg3','3ef182ac373afb3a5fdce441251e8d2d7e1622de94818bb25c730ea39af9444e',1,'2018-08-25T14:42:41'),(10,'MTgzODI5NzE2Ng==','c143edffcdb5f35e40bf8c716bdc43de289008b0db50ee6278d110586bb3e609',1,'2018-08-25T17:18:09'),(11,'MTg3MTMwMDk3Mg==','f58d33455b82983f09fef364df2e5740c7ffe0fd258c0a487220df7db144dc12',1,'2018-08-27T13:58:04'),(12,'MjExODIyOTI2OQ==','5a2306afcda29ff523e9a95740860c53f14b9709fb32f2d8b230bbdb021ac9f3',1,'2018-09-13T07:24:06'),(13,'OTE3NzU2NjA0','4678bfaa085bae7a768d7559356d895d637dbcd0b77445f972de7f7af3cb6c97',1,'2018-09-13T14:34:45'),(14,'NTAwMDg4ODEy','0164c8f3d461b8442ad01d236c900fcceea0db6aa7a6ada35e5e71712c956ae2',1,'2018-09-15T15:43:46'),(15,'MzAyNDkxMTg0','fe55a1021fd4760522a8d93bda6f52477869610b3a5f86aaf263bfe1de1be60c',1,'2018-09-16T13:22:36'),(16,'MTk3MDA3NjExNA==','ea0a2b7bcd8d4b47b09d0ae73d339df935f46f0f3e7807ca989dbce5a58020c7',1,'2018-09-19T06:21:47'),(17,'NDkyNTYyOTk3','e69c0b3174dd55a393b9fa98b655b95d415c3abbf7fc79502857a3757d98550d',1,'2018-09-21T16:56:55'),(18,'NDA4MzQ3MDI0','f86cac1279e8889b1cc7cab23ff15975aa26d2e45272fe6137c8f9796dbbe99e',1,'2018-09-23T09:46:12'),(19,'MTM3Mzc2MzI3MA==','d1a4cb15d81ae6f63ea193ba4397ae25dcb287a55359cb76c40f5388b8098ae1',1,'2018-09-25T15:58:20'),(20,'MzkxOTA4MDIw','0dc86405013c1a88964f218a55704f42139a15a27d72eb1b0a30a05a7bcd3842',1,'2018-09-28T13:17:53'),(21,'MTI5NTc2OTE3OQ==','0cff81596085f9dc2857b1e041b7f21a1052632b28cfcb21c040aa9657e1590c',1,'2018-09-28T20:57:46'),(22,'MTA2NzA5OTU1Ng==','3c9d4aa7f9ae95acef1c911cfe040f35870e2bd9a8ffdfa4bf2d9a4abb7269a8',1,'2018-09-29T12:14:31'),(23,'MjExMTgwODQxMQ==','88f980a73edbb1f9c80b931b4573fc835b12a3a1d3a89b1471ab93795ff8e67d',1,'2018-10-03T07:42:38'),(24,'MTExOTI2MjM3NA==','236b03bb4646d50878d6ee707594999b724c717136b48f365b019c95446d34fc',1,'2018-10-04T19:52:12'),(25,'NjQyNjEwMzA0','43c425f3fd50aa9ebd03f5fc0b01db09e21375466064ca5c84b71e99ea57c33f',1,'2018-10-11T14:39:39'),(26,'NDk0NzU4NDU3','c94ff7285f6749ad1433ce5f513c7bd966cf33409fc561f6606b12b67e01e38d',1,'2018-10-19T18:28:06'),(27,'MTQ2ODExNTc0','0bfc73935c16886604f5e16ec8cfb9538219dcf3a828a4ec110c8ce1e599d77d',1,'2018-10-21T10:10:20'),(28,'MTg3MzM4OTYwMg==','0479371bc4bb8d5027d019872af01d5ecf59102dd93a696210725f6585afbebb',1,'2018-10-21T20:55:14'),(29,'MTEwMDAxODExNw==','094a121da4eb0a5117defd79de2fe05fd6cc99d42c853b2bfb0c9ae3232ebc24',1,'2018-10-22T11:42:03'),(30,'ODI5NDI0Mzc4','91089ee231076fbad98b5178a64c65ddf4c6eb295dcd5a835793b6ecafe30f5f',1,'2018-10-24T09:05:43'),(31,'MTE1MDg0Njc3MQ==','1167857c473acd7bd6d785ee68488d2d5d5ad288e27b06329ea3950eb9950377',1,'2018-11-03T10:10:43'),(32,'MjEzMTIxMzI5Mw==','2f99fcd6abea42be840a5d1b0916e90d899d479f5d337ae2e1fbf1effba08856',1,'2018-11-08T11:22:04'),(33,'MjgxNjY0Mzc0','0997044626abaf48c4189f05ad310b450924e2b77cb7f79f30a7c0353bb16c0c',1,'2018-11-11T17:28:53'),(34,'NzMyNDI3MjUx','18083c2452deb86c0ebad93d28edb0396461330a90f4fdcfbfb70ef0ce3fa709',1,'2018-11-11T17:32:49'),(35,'MjEzMzM1MDE0Mg==','c0cdfca746abb2537073cce2008213b19af3d16f5504a12a18a8c69a43a1f9ed',1,'2018-11-14T11:41:19'),(36,'NTcyOTU1MjA4','c2679c88a631870112caa8b6a53283a59ab40a1cce2e077e443144e806476ed3',1,'2018-11-14T12:32:53'),(37,'NzY3ODY0NDM1','3c96f55b5fe3940e5a622ddbef18f73b8e398b964e970697076d3fe6ac8b57a9',1,'2018-11-21T14:41:39'),(38,'MTA2NTMwODU1OQ==','1ee92a7889a30e30822bda91d588e6b61668b9282241efa8bfdc3ec06cd07648',1,'2018-11-21T17:10:15'),(39,'MTg5MzUwMTg5Mg==','b3d358920d0c2e66d4ee021e2bb9692b170cafe66229cc7d07b884a6e8cbab67',1,'2018-11-21T17:19:05'),(40,'MTQ1Mzk3MzU4OA==','d38272cb80fdb22366f89e839a143d9945f661be27116069bd2e1a8bcdcf1e05',1,'2018-11-28T09:50:07'),(41,'MTA2NjM4NTMxMQ==','f66865b61c0dec845adafa45c1e0b7f0c517a701338c69d07aefd4b93ca5d5ee',1,'2018-11-28T09:55:46'),(42,'MTgxOTM4MTA3NA==','7a4531eeba319a0292055301eded68f546483f496b1f8fcbfa6881c78add0bf1',1,'2018-11-29T21:03:09'),(43,'Mjk5ODA5Mjc5','6e6aea7195e90e6f88221b6d212260801a75ed56e1e144f67329e55b006da43c',1,'2018-12-02T16:55:13'),(44,'MTY3MjE0NDg1OA==','882ba5c1a0a58b92912d548915d4a94353601f3627aa46ffb37af444810bdd1d',1,'2018-12-23T19:05:52'),(45,'MzYzMTQwNDEy','34932f019267da9d919dbab75efab328aac2763cf1b57be77a6a91a341f2004d',1,'2018-12-27T14:39:07'),(46,'MTYxMjc3NDUy','739531c37aca2a46baf14fd19eefd2e7baab81e5ec778077b7258dd21a26f2ac',1,'2018-12-28T10:00:28'),(47,'MTAxODExNTg1OQ==','d293755e80f7f0e4e206f74069884bdd9bbd684cee9c89aa72f4cf9ac3da6616',1,'2018-12-29T14:28:22'),(48,'MzY3MDM5MTk5','95697b9846523560d43ae0576981e72c8050efcc7a162bed39020d39e304de1c',1,'2018-12-30T10:39:10'),(49,'MTQ0NTk3NzUxNg==','749caab64361806afd3c10d1a4d3d343ac403b784f48e7e47632f1ce0ffa8984',1,'2019-01-09T09:44:17'),(50,'MTQ1NzY2MTgyOA==','5d895347a035e298161bb07e89077ba4183563e7b9a69c1d78d4a81287966e6b',1,'2019-01-10T13:55:40'),(52,'NjI2NjY5Mjcz','57603fb45a119a1b7d6e12249bad91d250e13262b13567ac46103adffe4ddcfb',1,'2019-01-18T12:27:40'),(53,'MTU0NDEwODg2OQ==','f722662a201f7abc91089af788cef649d6063fe821184853f128ea44e2362ae1',1,'2019-01-18T12:47:37'),(54,'NTM0ODE0OTkz','4bf0e567e7b024345cdc90176b3f7dcde7f63e1c447932b1cd4c5030ccd4da33',1,'2019-01-26T21:38:00'),(55,'MTIzOTA1OTY3Mg==','b5d42ffd20ef54420de9b01edcfeab99e8df1cc717edb4b77c76b91987a502b2',1,'2019-01-27T09:01:13'),(56,'MzA1NDk1NzQy','1728cf0f3987d03073593f9c7eef2a26af9516f9bf85aea5c2baeec2bab02745',1,'2019-01-27T09:06:28'),(57,'MTUwOTE0NjQwMA==','c3978b62738261a8b09ab5617530c0b1b6590a6e8fc51e42e6dabbd59ad7f423',1,'2019-01-30T17:52:58'),(58,'MTMxNDQ1MjQ4OA==','63513c3e1712b9b6892224ad0dfe0e929e192fe74145f0ecdae05028d0ee9a59',1,'2019-02-01T08:29:04'),(59,'MTE3MzIzNTgwNA==','c0ed6d39ad4e75f603eac667ad3be3a75c70cffd9704a6a30c0321ad003ebfea',1,'2019-02-06T20:28:42'),(60,'NTkyNzA1MzMy','910b4999e8e9adcdbc51ba36912e5540941aa4c9f70c389d95bafb203cb739a8',1,'2019-02-07T08:30:16'),(61,'MTIzNDEyMzQ5MQ==','0864902ac08c04310e195c2cc20b25039826ad43eb01b4bcb5fb98feac0fb5db',1,'2019-02-07T17:54:36'),(62,'MTg2MDcwOTE5','672000bc5703f86b90e4bb8b62e4a6af29eabab72c894b27980cdf8b14144d1a',1,'2019-02-17T21:19:34'),(63,'Mzk1NjAxNDQ0','3ac04cf1630f04130ba08b6166d48c652214945ad9341e4170a12b7dc3cf13c3',1,'2019-02-18T10:02:37'),(64,'Nzg3ODEzMTM4','4392483998397720a23b1241744fe72111b792800dda0f81d56b0e87da9c5981',1,'2019-02-21T08:57:19'),(65,'MjMyNjIzMjIw','8eca83b1595de9872b6485969347f50aed18d7b39c58229d8088db1138c6015a',1,'2019-02-28T16:22:37'),(66,'MTcyMzMyNTk5NQ==','bbce1fbfbc7222f9f9d01e3dd2bd5a1a1cb7cb57894ddf48bf554815b70982a5',1,'2019-02-28T16:29:49'),(67,'NTEwNDI4NTU4','5466702126a16e79b48a6c24ad26ed056f53bd41d48136f56d2bff0c83b3b705',1,'2019-03-01T10:03:13'),(68,'NTQ2NTQyNjcz','99c01331143a4fffc8b5a01720c9227115c7dadb4158b347071ae3880296acf1',1,'2019-03-01T11:45:40'),(69,'NDgwMjY3NTMw','a8a2ceec31553c4c2375637152f6e9472fc731fa18753d3e407140e888e914ec',1,'2019-03-02T14:45:51'),(70,'MTk0OTc4OTky','0e5615b521894cc2bb7afae0ae1249d1e7a7d5cc0bf08ca093f14c4488b40b25',1,'2019-03-10T20:31:08'),(71,'MjQzMzA4MzUz','eb4bbd7966195f7feedbe32f3988393ea38d78a046f79f79502b62ab7f7cf3b6',1,'2019-03-16T11:24:46'),(72,'MTcxNzExNzM4MA==','37a879d2b24b578370a535775c252c2d217b5cd9d94f6220dc8752668798caab',1,'2019-04-02T07:38:53'),(73,'MTk2ODQyODA1NA==','c14e25a2fa059d9122d0ad08399fe54bee80c137a385215ee33adec9d4c0424b',1,'2019-04-07T15:39:42'),(74,'NDk0MTgxODM1','e761705f74346334c0aa369d43b0683645fec8e7d5df6dc51d493057c7de91eb',1,'2019-04-11T21:43:40'),(75,'MjU2MjIyMTYw','d1020945b05ef674a023b092ae35842e53f0a45e40d77025adeb9b875c3b0cf1',1,'2019-04-22T18:12:04'),(76,'MTg4ODQ3NzEzMA==','ca7028835de9194a2b3985f9c317c1a4f80cb4dcc1b2c197140c3480d664996e',1,'2019-04-24T14:31:13'),(77,'MTk3NzgwNjM3Ng==','ed47c69f77cc23662467c4d436c7cc47d2880f33f1051e3a7fb6a987254cd86f',1,'2019-04-27T11:34:08'),(78,'OTY2MzYxNzIz','1eb4e4d647be1759994ed78cf83064be4c22974b2c6bf9ad85678bc43ec7e59a',1,'2019-04-28T14:02:30'),(79,'NTg3MzA0Nzk0','67fa12d9edd64706c64427e6381206ea42c3cb540c295c19eb53c90c6ac09d92',1,'2019-05-12T13:50:02'),(80,'NTI5ODM5MDA3','bc22b2c4bbea8d50132635e758c26088b6060fc6d26762779d722eacc900f1ae',1,'2019-05-17T15:40:58'),(81,'NTE2Mjk4OTE=','fa348461a77b4ac5204f9927cbd24f13ba7b7e5cf3627d02da0b57a05f4d1a22',1,'2019-05-23T20:23:53'),(83,'MTQ5NjE3MDU4NA==','a9de7471540960ecfdfdfb83dfeeae757a4e2bef1ef267608d650ef38f2bddac',1,'2019-06-06T09:53:34'),(84,'MTMzNzg2NzA5','e191dc3ca95c252d9257287890022b665e85819a073d914d42b2c507743e6b74',1,'2019-06-06T10:13:24'),(85,'MTQxMzgxNjczOQ==','efef2897797954ef44ea00e3efc40564500724cb9cec660d07678e3ea2860d51',1,'2019-06-08T14:20:20'),(86,'MTM2OTc4MjAyOQ==','431fd1d56ef3d298c46243d8cc5cffffc43f7afb35e750a1d6b37e9f3a0c0b02',1,'2019-06-15T08:38:02'),(87,'MjcyOTY4OTU4','8259fcc0eb71b7377248a655e0fa80b8177eee153bb388cf72e427e93303c76b',1,'2019-06-21T18:58:05'),(88,'NjA3MzE2MDQ3','ff6a26ce440190afb3799bef13c31e1ce8f6c7c0ab90c53b6b862a4fec35ab68',1,'2019-07-05T11:00:59'),(89,'MjA5ODUyMjAyNg==','7aed82e7a6beef1681609b859036d64bff1dea8e9d7978b2542fb49098742b7b',1,'2019-07-14T19:10:09'),(90,'NDAyOTEyOTg5','e4725809a1216b42672cc45454cf8fa62481e2253bf2655e66d435c476336c56',1,'2019-07-23T10:53:10'),(91,'NTEwMTAxNDIy','0735b1b6d84e774f525b7a70700fb3c1ba4c6447cc9c09f4ddd9707e1d6276b8',1,'2019-08-01T18:46:04'),(92,'NjAyMzQ5MDgz','ccd912c1518c867b2e799137e59a59d3d127491eef25f36b7daf4fe7515afd7c',1,'2019-08-04T12:02:33'),(93,'MzQ4NDQxNDEz','f98d399ddc7c7ad0362b262be624df5e4f9c61b8170fef851dc898ccbc287d5b',1,'2019-08-08T11:01:55'),(94,'NDMzMjE1MTIy','66a23f6bfd7a0801d2f22f3a372bd17c8a158bb12a29be305343e7b62c119a56',1,'2019-08-16T21:10:13'),(95,'NDIxOTM2Mzk=','4bd225143061bc37506f75cd412a4abf1929e4f6aa82cbda0cdd22318a5bf50c',1,'2019-08-16T13:11:00'),(96,'MTY0MjYwMDIyNw==','27b5212447fa9e8a0ad9107af17cab7564ae2387fba7773378d59f58714256bd',1,'2019-08-23T08:31:35'),(97,'ODk4NDIwNTQ0','38efb68f0553cb073b41e1a23df2e6f2d8aab6c949d256609b3b9e7cef1c4637',1,'2019-08-27T14:53:36'),(98,'NDU1MjI3MDY2','5f0b52e2d73a263034a6fe872789f0f69814616cc3ed966733d781e6a16c3b92',1,'2019-09-16T10:46:36'),(99,'MTg1MzgyODQ0OA==','7ece3a7a1ba1d2a6f15ccd6476307da3d44dff468d87ff674b643b3a5a662a91',1,'2019-09-18T08:47:28'),(100,'MTYxNTMxOTcwMw==','3424f1caf7b2f74399d6c2f3a8b3c15767af7d34e4ffb6b28703d0ba56746103',1,'2019-09-18T08:49:34'),(101,'MjA1OTIyMDUzNg==','c08580704b8d1e9b3a125668187d3113a4b3ddb943946b3cef5428c6c872bd62',1,'2019-09-18T12:48:50'),(102,'MjM5MDYxMTU1','772920667d4167603be311eb9544502c98f16ca62ac43c711af81268a72c10cb',1,'2019-09-22T15:09:39'),(103,'MTQzNDkxNzcxNA==','d2bdebc225e8c72582a7efc5dddf887d3a0545482a8ccce7daa53a2c888e135c',1,'2019-10-05T10:38:29'),(104,'MTMxMDEyNzMxMg==','de0aa410ec6f6ec215c1b629e5eff54185c2b712a616225b504cc80dec0afbad',1,'2019-10-08T11:21:14'),(105,'OTg0OTU3MzM3','568acf231fd63039bf429fb308649721ff0f07597068c96971c9edaf4e5e0557',1,'2019-10-17T15:19:49'),(106,'MTAxNzM1NTQ3Mw==','3df7306d8abf4210c2dad081f08d143d4f78251ff81c418cea1642909829ff86',1,'2019-10-22T17:02:16'),(107,'MTI3MTE1OTU2Nw==','cc5434f9823827bad128216508fd3c8a7745b03f5b4bd039fb7aa851218e498f',1,'2019-11-06T09:02:29'),(108,'MTY3OTYxMjIzNw==','ce15f6940abe8b367df90176d2283f23fc9bbc1d74721febd461f8860713871c',1,'2019-11-09T09:08:10'),(109,'MTkyOTUzNjgz','10a8ed90323c0e1b73b23d86041dbadcae5353f90f6bcce0c4ca0a684ecbfc4a',1,'2019-11-09T19:05:51'),(110,'MTM1MjI0NTU4','ccb7a46f6a7831634947e680232004a84df3bf4d154078627b284b2544d4c1e8',1,'2019-11-23T04:41:58'),(111,'NDMxMDMxNTAy','da4a125a41874ba10986b4acc8aca3002ea4e46d9c1b24cb854f8e7235609432',1,'2019-11-23T04:54:43'),(112,'NjYxNTgwNTQ4','9c98b7e2081756adc5354e1aeba4518650e2643730bd46fd7ffdea0513e94c4e',1,'2019-11-30T10:30:11'),(113,'OTk0NjY5MjM=','65cec9461a32a96243779d7f4bc714099668137a6ded79c9074e0231529422c8',1,'2019-12-03T10:23:31'),(114,'MTQ2MjM0NjY5','38d3e27cb3d35362c7dcd923fd8680ef58057ea8e3ae1fa333eb05c91ba6e032',1,'2019-12-05T10:13:32'),(115,'MTU2NjY1MjQwMw==','857274aa00e8512a647d4007c2345bf6c8303c64dd6f96746d89a66429260bee',1,'2019-12-16T21:41:21'),(116,'OTc3NTU4NzA1','21b6d4243371c56e5cb864ed429f9756fe1960f7fec4f4023ade9d80caf15dc2',1,'2019-12-23T09:31:01'),(117,'MTgwNzMyODIzOQ==','91c78cee4cf87096527e458fb3fc7dbd393d78f89b32c468b4ec29d0a09a33f2',1,'2019-12-23T13:57:13'),(118,'MTEyOTg5NjE1Mg==','0406da11e1e1df08492c96563a27f8939e647572307a6559109b1b5c356b24c3',1,'2020-01-04T12:35:17'),(119,'MjQyOTEwMDAx','b4d92bb9355e03f6b539589c34b88e422d651d47e0531c1b5b681b5101579e46',1,'2020-01-09T16:14:03'),(120,'ODk0ODA0NDk5','6a1339e95f8cd4b5dffa03eadf652471051f0f5fd783112a288696f3cea53a1c',1,'2020-01-13T10:37:13'),(121,'MTUzNDUzNTYyNg==','93f764d0bf55efd50dbc88901604daa3510af7f1fdb54b4943f0f7fd380bc21b',1,'2020-02-06T10:32:06'),(122,'MTM5OTU3Njg3NQ==','cbf57ebd3f00159cfbc29324c037e68417e13e02f8d97ecc4da15afdb074bd2b',1,'2020-02-12T20:53:23'),(123,'ODgyNjk2ODE3','5d44b65b2b19e47b44e5fcfbf95c7946df99f4d0ef8b37261bbec4d3edaccb97',1,'2020-02-14T17:58:31'),(124,'NTEwMDM5NTA0','71fbc16d33b6fd33d57abea588838dd212aa7c39b46e2f6af109586ffacdab74',1,'2020-02-24T12:42:06'),(125,'ODA1NDEzNjkz','3dbb203964dad951b0bf765bc5df37cbb8689a5a4a8f7f1075475b5f923460cc',1,'2020-03-08T13:56:57'),(126,'NTAxNTc5MTcw','5eb48d506b90921c4f93013ded7f8d2b39aa36837e04fdf023817641f6781be2',1,'2020-03-16T11:00:46'),(127,'MTQyMzIxNzI0Mg==','93a32d0f18c83570c51e61c2377d7093e59d66bcc16607a1d8044a5b85a3d3a9',1,'2020-03-17T16:21:40'),(128,'NjUwMDQzNDM1','a0b0145d6dff2fc3f219d7b4e83293f36ac941e04455e10f36309de86ca3f61b',1,'2020-03-22T11:59:25'),(129,'MTE5Mjk5NzY5Ng==','0dd50cfcee574d04dbc1f5c07436fcf903edcff5c321654e9fbd0e066bcac058',1,'2020-03-27T10:06:44'),(130,'MTMzNjc0MTI1Mw==','3154e45cd59b6149e659b22ce948f12564171e72e6c4b943870d52ed93ff5876',1,'2020-03-28T18:04:22'),(131,'MTkyMzgxODQ1Mw==','240e288e21a7dd30bd5b6f03ec2dcb8b21ff741bfb18f2afe1591e7472afa1e7',1,'2020-04-04T11:31:52'),(132,'MTA2MzM4OTA0Mg==','332990487e38f742af65d1018cca7ba2a56ad504f5696fc2f438b53f3b85095e',1,'2020-04-05T12:07:01'),(133,'MTkzNjY1OTU0OQ==','c197917a076d576a6b5445c5f42368fca6a76f03b63ccf86af05f2e9301c6bf8',1,'2020-04-15T13:38:30'),(134,'MTgyODg1OTE0OQ==','c3c169a29ad02dc0837a27f64e2dfcb1018d0447a4595216421f2bc89068c749',1,'2020-04-18T19:36:27'),(135,'MzA3NjM1ODky','9b83ebdb03fee0735524186f49ef1274c51bbd74fa528b5b76010e6d48df91e0',1,'2020-04-24T11:20:33'),(136,'MTkxMjc5NDgwNA==','ba6732dd1cc93c777befa557779b37879d971130b300b645f6950f75882ad542',1,'2020-04-24T14:55:47'),(137,'NTU3MzQxOTYz','820ef7b0a73ac815211d10459c6a5d3815aa047afe2d8c4bf1d9e716306c5a83',1,'2020-04-25T09:56:53'),(138,'MTA2MDc2MjQzOA==','9cc6150ba9ded84ee27bd762dcde31b74a4f9cb48f56fad2f4713356d31dccd9',1,'2020-04-25T19:36:45'),(139,'MTE5NDU0MDc4','9987e93b93734c753695e642ec798ee93a14464bee64d649d5a14d9d94525b71',1,'2020-04-25T20:13:59'),(140,'MTc0NDg2NTYw','330c93b073e7c3e38e26b862da51728f705b378a40d9c481f77f0b35f96c9f4f',1,'2020-05-18T09:54:40'),(141,'NDY2MDIyODg2','180e1c36b1bb46fdceab8c1a1e2a77e1f43511b90138e0ce9b1f3340230a3ee6',1,'2020-05-19T12:00:16'),(142,'ODIyMzc2NzY0','5241d67782c3565662eaf1d6117a1ae620b9a3534bcdb6768d7648a63f43f7bb',1,'2020-05-19T13:27:41'),(143,'MTEzODcyOTQwNQ==','03c0ca19b78be3b1d3f2bcafd79da1764d011fc67cbc39970cc6efaf573b0a2d',1,'2020-05-21T10:32:19'),(144,'MTgxODIxNTEzOQ==','a6027058f3ed2f08a8200cf146b679d432253a632a017b3b61443e7ad76254a8',1,'2020-05-21T15:16:16'),(145,'MTA3MjAwNjI3MQ==','8fadadf536d8df4995419a9773fe463ca921d3de0d91116a2c90d4d751806eab',1,'2020-05-22T06:48:20'),(146,'MTY5MzkxMjMzMw==','5dd9e8bfad46687031137d21c45f0440ed3206920c5722076763a8a3e77fd4d0',1,'2020-05-22T14:36:59'),(147,'MTg1NTE2NTg5Mg==','60fef379a0d31c41f0b2c87b9d992f5056b91330ef6084c656f32ad83ceb9948',1,'2020-05-23T20:31:54'),(148,'NDA0MzI1NjY2','54a2715c82dea9996e422afd7472d67a1cc7d38b1b475f2af901a00ef7c3e60a',1,'2020-05-26T08:56:13'),(149,'MTU1Njc2MzU1Mw==','e5f5a0c1ec5b559f9fce8e905039f9c20089c52722b7230681afea7e47cf8aec',1,'2020-05-27T09:22:44'),(150,'MTk1NjU5MjU3OQ==','bba0d136b28706f430c3cbdc3e16a50e9d15547be80600c74dc60be153336463',1,'2020-06-04T11:55:16'),(151,'MTE5MzAyOTQ=','1124b69a1ff062eed0a8a0991c40f4d9da3c18629d5be43072b420915822cf43',1,'2020-07-12T21:58:29'),(152,'Njk2ODc2OTM3','99054bfd58906766b80fb7a61dc69b5d38a6fffa6dd2d51359243eb4ef736e9b',1,'2020-07-13T13:03:07'),(153,'OTE3MTQzMDg0','31cd3bbe71484a0ba65f796f930108ad91cc486619e8d6fd3c2f7138ad99a274',1,'2020-07-28T09:00:35'),(154,'MTU0NTIxNzYxOA==','241a7580a267a1f469ea014735af995c3ccb6ff4f063ad9564d0548cbe0f9c07',1,'2020-07-30T09:58:37'),(155,'MjAxMjM1NDc2OA==','49a12e5465959d7c10ff4223b141df0f761a2c1ccade09c1f1c0a9158dfc8837',1,'2020-10-01T19:59:52'),(156,'MjE0NDgwNjc0Nw==','391523e231478ba9108b86c810f760ece4293f01f012a52bdc32493b37ff89bb',1,'2020-11-05T15:44:07'),(157,'MTAxMTcwMzIwNA==','c2585a692fcfc0e55d65eb59f5b0f60517ea4901af4295dc9a2b816b7f95fcae',1,'2020-11-18T07:31:55'),(158,'NzM5MTUzNzEz','8bf7b0064bce6764dcd39f0c1b653e39553e16183d417a175b787a52d7dbf501',1,'2021-03-01T13:53:41'),(159,'MjAyMzM1MjA4OQ==','16a7e334df309992291d2a3e953e8ef5747322bd7899b84b5f98b39748bd7cd2',1,'2021-03-04T17:50:09'),(160,'MTk3MDA3Mzk4NQ==','a7122999ccbadce1d4aa68b699c89aaae049c04f4a38b5f994167a4096b35dfa',1,'2021-03-07T14:48:48'),(161,'MTY3NDY4MzUwMQ==','43289853ab66698a8fd54c5c87d18e9bf9d8cc03a8b8aa29797242d354fa78fe',1,'2021-04-06T18:29:14'),(162,'MTIwNzM3NTM4Mg==','59be988bb11fa55317ea6b0c38f39ae38500bf61e2b374152f3d59b394edba46',1,'2021-04-15T13:51:37'),(163,'MTcxMTU1OTcwMA==','e50da5784b6d01a2789201576b4b2d0af20df9e3c608db62ce41c94bf1ad50e1',1,'2021-05-25T14:52:20'),(164,'MTk5MzU5OTg1','47f9311162f25a568ae77750245386cfaf1ac3eaf2ba0dca5ac4be9f0cd6d7d6',1,'2021-05-28T08:43:11'),(165,'MzcyNzU2MjE5','2a06d49f1efd513ff295087a6cd7c8565c89f2a03e909507f0f4722fb4ddb483',1,'2021-06-21T21:05:43'),(166,'MTk5MjE2MjY1Mw==','99f26e116aac5bcbaa532c9e41102dc624aea02016d6747f315142b2f4f60c11',1,'2021-07-07T15:08:44');
/*!40000 ALTER TABLE `auth_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `call_settings`
--

DROP TABLE IF EXISTS `call_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `call_settings` (
  `id` varchar(0) DEFAULT NULL,
  `name` varchar(0) DEFAULT NULL,
  `dev` varchar(0) DEFAULT NULL,
  `default_dev` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_settings`
--

LOCK TABLES `call_settings` WRITE;
/*!40000 ALTER TABLE `call_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `call_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `camera`
--

DROP TABLE IF EXISTS `camera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `camera` (
  `id` varchar(0) DEFAULT NULL,
  `name` varchar(0) DEFAULT NULL,
  `link` varchar(0) DEFAULT NULL,
  `access_all` varchar(0) DEFAULT NULL,
  `hide` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `camera`
--

LOCK TABLES `camera` WRITE;
/*!40000 ALTER TABLE `camera` DISABLE KEYS */;
/*!40000 ALTER TABLE `camera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `day_plan`
--

DROP TABLE IF EXISTS `day_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `day_plan` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(12) DEFAULT NULL,
  `Mon` varchar(3) DEFAULT NULL,
  `Tue` varchar(3) DEFAULT NULL,
  `Wed` varchar(3) DEFAULT NULL,
  `Thu` varchar(3) DEFAULT NULL,
  `Fri` varchar(3) DEFAULT NULL,
  `Sat` varchar(3) DEFAULT NULL,
  `Sun` varchar(3) DEFAULT NULL,
  `stime` varchar(5) DEFAULT NULL,
  `etime` varchar(5) DEFAULT NULL,
  `gpio` tinyint(4) DEFAULT NULL,
  `active` varchar(3) DEFAULT NULL,
  `rom` varchar(23) DEFAULT NULL,
  `active2` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `day_plan`
--

LOCK TABLES `day_plan` WRITE;
/*!40000 ALTER TABLE `day_plan` DISABLE KEYS */;
INSERT INTO `day_plan` VALUES (1,'Cały_tydzień','Mon','Tue','Wed','Thu','Fri','Sat','Sun','14:50','15:01',6,'off','gpio_6','on'),(2,'aa','','','','','Fri','Sat','Sun','15:08','15:15',6,'off','gpio_6','on'),(4,'Otwarte','Mon','Tue','Wed','Thu','Fri','Sat','Sun','06:03','21:40',13,'on','ip_mqtt_Kurnik_gpio_13_','on'),(5,'Zapalone','Mon','Tue','Wed','Thu','Fri','Sat','Sun','19:20','16:28',12,'off','ip_mqtt_Kurnik_gpio_12_','off');
/*!40000 ALTER TABLE `day_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device`
--

DROP TABLE IF EXISTS `device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device` (
  `id` tinyint(4) DEFAULT NULL,
  `usb` varchar(3) DEFAULT NULL,
  `onewire` varchar(0) DEFAULT NULL,
  `serial` varchar(0) DEFAULT NULL,
  `i2c` varchar(3) DEFAULT NULL,
  `lmsensors` varchar(0) DEFAULT NULL,
  `wireless` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device`
--

LOCK TABLES `device` WRITE;
/*!40000 ALTER TABLE `device` DISABLE KEYS */;
INSERT INTO `device` VALUES (1,'off','','','off','','');
/*!40000 ALTER TABLE `device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domoticz`
--

DROP TABLE IF EXISTS `domoticz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domoticz` (
  `id` tinyint(4) DEFAULT NULL,
  `ip` varchar(0) DEFAULT NULL,
  `login` varchar(0) DEFAULT NULL,
  `password` varchar(0) DEFAULT NULL,
  `port` varchar(0) DEFAULT NULL,
  `active` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domoticz`
--

LOCK TABLES `domoticz` WRITE;
/*!40000 ALTER TABLE `domoticz` DISABLE KEYS */;
INSERT INTO `domoticz` VALUES (1,'','','','','off'),(2,'','','','','off');
/*!40000 ALTER TABLE `domoticz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fw`
--

DROP TABLE IF EXISTS `fw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fw` (
  `id` tinyint(4) DEFAULT NULL,
  `ssh` varchar(3) DEFAULT NULL,
  `icmp` varchar(3) DEFAULT NULL,
  `openvpn` varchar(3) DEFAULT NULL,
  `ext` varchar(9) DEFAULT NULL,
  `radius` varchar(3) DEFAULT NULL,
  `syslog` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fw`
--

LOCK TABLES `fw` WRITE;
/*!40000 ALTER TABLE `fw` DISABLE KEYS */;
INSERT INTO `fw` VALUES (1,'off','off','off','0.0.0.0/0','off','');
/*!40000 ALTER TABLE `fw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g_func`
--

DROP TABLE IF EXISTS `g_func`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g_func` (
  `id` tinyint(4) DEFAULT NULL,
  `position` tinyint(4) DEFAULT NULL,
  `sensor` smallint(6) DEFAULT NULL,
  `sensor2` varchar(0) DEFAULT NULL,
  `onoff` varchar(3) DEFAULT NULL,
  `value` tinyint(4) DEFAULT NULL,
  `op` varchar(2) DEFAULT NULL,
  `hyst` varchar(1) DEFAULT NULL,
  `source` varchar(9) DEFAULT NULL,
  `gpio` tinyint(4) DEFAULT NULL,
  `w_profile` varchar(3) DEFAULT NULL,
  `active` varchar(2) DEFAULT NULL,
  `rom` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g_func`
--

LOCK TABLES `g_func` WRITE;
/*!40000 ALTER TABLE `g_func` DISABLE KEYS */;
INSERT INTO `g_func` VALUES (4,4,43,'','on',1,'ge','','value',19,'any','on','gpio_19'),(5,5,49,'','on',1,'ge','','value',13,'any','on','gpio_13'),(6,6,49,'','off',0,'le','','value',13,'any','on','gpio_13'),(7,7,43,'','off',0,'le','','value',19,'any','on','gpio_19'),(9,9,109,'','on',15,'lt','1','valuehyst',6,'any','on','gpio_6'),(10,10,37,'','on',1,'ge','','value',26,'any','on','gpio_26'),(11,11,37,'','off',0,'le','','value',26,'any','on','gpio_26');
/*!40000 ALTER TABLE `g_func` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gpio`
--

DROP TABLE IF EXISTS `gpio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gpio` (
  `id` tinyint(4) DEFAULT NULL,
  `gpio` tinyint(4) DEFAULT NULL,
  `name` varchar(14) DEFAULT NULL,
  `mode` varchar(6) DEFAULT NULL,
  `simple` varchar(6) DEFAULT NULL,
  `rev` varchar(0) DEFAULT NULL,
  `status` varchar(3) DEFAULT NULL,
  `time_run` varchar(0) DEFAULT NULL,
  `time_offset` varchar(2) DEFAULT NULL,
  `time_start` varchar(0) DEFAULT NULL,
  `humid_type` varchar(0) DEFAULT NULL,
  `day_run` varchar(3) DEFAULT NULL,
  `week_run` varchar(0) DEFAULT NULL,
  `week_status` varchar(0) DEFAULT NULL,
  `trigger_run` varchar(0) DEFAULT NULL,
  `trigger_notice` varchar(0) DEFAULT NULL,
  `kwh_run` varchar(0) DEFAULT NULL,
  `kwh_divider` varchar(0) DEFAULT NULL,
  `temp_run` varchar(0) DEFAULT NULL,
  `trigger_source` varchar(0) DEFAULT NULL,
  `control` varchar(0) DEFAULT NULL,
  `control_run` varchar(0) DEFAULT NULL,
  `trigger_delay` varchar(0) DEFAULT NULL,
  `trigger_con` varchar(0) DEFAULT NULL,
  `tel_num1` varchar(0) DEFAULT NULL,
  `tel_num2` varchar(0) DEFAULT NULL,
  `tel_num3` varchar(0) DEFAULT NULL,
  `tel_any` varchar(3) DEFAULT NULL,
  `tel_at` varchar(3) DEFAULT NULL,
  `elec_divider` varchar(0) DEFAULT NULL,
  `water_divider` varchar(0) DEFAULT NULL,
  `gas_divider` varchar(0) DEFAULT NULL,
  `elec_run` varchar(0) DEFAULT NULL,
  `water_run` varchar(0) DEFAULT NULL,
  `gas_run` varchar(0) DEFAULT NULL,
  `elec_debouncing` varchar(0) DEFAULT NULL,
  `water_debouncing` varchar(0) DEFAULT NULL,
  `gas_debouncing` varchar(0) DEFAULT NULL,
  `fnum` varchar(0) DEFAULT NULL,
  `state` varchar(3) DEFAULT NULL,
  `position` tinyint(4) DEFAULT NULL,
  `day_zone2s` varchar(0) DEFAULT NULL,
  `day_zone2e` varchar(0) DEFAULT NULL,
  `day_zone3s` varchar(0) DEFAULT NULL,
  `day_zone3e` varchar(0) DEFAULT NULL,
  `moment_time` varchar(2) DEFAULT NULL,
  `ip` varchar(13) DEFAULT NULL,
  `rom` varchar(33) DEFAULT NULL,
  `locked` varchar(4) DEFAULT NULL,
  `map` varchar(0) DEFAULT NULL,
  `map_num` varchar(0) DEFAULT NULL,
  `map_pos` varchar(0) DEFAULT NULL,
  `week_Fri` varchar(0) DEFAULT NULL,
  `week_Mon` varchar(0) DEFAULT NULL,
  `week_Sat` varchar(0) DEFAULT NULL,
  `week_Sun` varchar(0) DEFAULT NULL,
  `week_Thu` varchar(0) DEFAULT NULL,
  `week_Tue` varchar(0) DEFAULT NULL,
  `week_Wed` varchar(0) DEFAULT NULL,
  `ico` varchar(15) DEFAULT NULL,
  `bsensor` varchar(4) DEFAULT NULL,
  `snameon` varchar(0) DEFAULT NULL,
  `token` varchar(0) DEFAULT NULL,
  `trigout` varchar(0) DEFAULT NULL,
  `trigsource` varchar(0) DEFAULT NULL,
  `sprinkler_run` varchar(0) DEFAULT NULL,
  `sprinkler_trig` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gpio`
--

LOCK TABLES `gpio` WRITE;
/*!40000 ALTER TABLE `gpio` DISABLE KEYS */;
INSERT INTO `gpio` VALUES (2,20,'Brama','moment','moment','','OFF','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',1,'','','','','1','','gpio_20','','','','','','','','','','','','switch-icon.png','none','','','','','',''),(4,13,'P._Wiatrołap','temp','off','','OFF','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','OFF',1,'','','','','','','gpio_13','','','','','','','','','','','','','','','','','','',''),(5,19,'P._Pralnia','temp','on','','OFF','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','OFF',1,'','','','','','','gpio_19','','','','','','','','','','','','','','','','','','',''),(6,26,'P._Graciarnia','temp','off','','OFF','','','','','off','','','','','','','','','','','','','','','','','','','','','','','','','','','','OFF',1,'','','','','','','gpio_26','','','','','','','','','','','','','','','','','','',''),(7,6,'Lato','simple','off','','OFF','','11','','','','','','','','','','','','','','','','','','','off','any','','','','','','','','','','','ON',1,'','','','','45','','gpio_6','user','','','','','','','','','','','','','','','','','',''),(11,12,'Ledy_HOME','simple','error','','ON','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',1,'','','','','','192.168.50.55','ip_mqtt_Kominek_gpio_12_Ledy','user','','','','','','','','','','','','','','','','','',''),(12,12,'Lampa_Brama','simple','off','','OFF','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',1,'','','','','','192.168.50.61','ip_mqtt_ESP_Brama_gpio_12_BramaPK','user','','','','','','','','','','','','','','','','','',''),(13,0,'Przekaźnik','simple','on','','ON','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',1,'','','','','','','shelly1pm-A4CF12F3CEFB_gpio_0','user','','','','','','','','','','','','','','','','','',''),(15,12,'Kurnik_światło','day','off','','OFF','','','','','on','','','','','','','','','','','','','','','','','','','','','','','','','','','','',1,'','','','','5','192.168.50.63','ip_mqtt_Kurnik_gpio_12_','','','','','','','','','','','','','','','','','','',''),(16,13,'Kurnik_drzwi','day','on','','ON','','','','','on','','','','','','','','','','','','','','','','','','','','','','','','','','','','',1,'','','','','','192.168.50.63','ip_mqtt_Kurnik_gpio_13_','','','','','','','','','','','','','','','','','','',''),(17,17,'NT_Ogród','moment','moment','','OFF','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',1,'','','','','3','','gpio_17','user','','','','','','','','','','','','','','','','','','');
/*!40000 ALTER TABLE `gpio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hosts`
--

DROP TABLE IF EXISTS `hosts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hosts` (
  `id` tinyint(4) DEFAULT NULL,
  `time` varchar(19) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `ip` varchar(17) DEFAULT NULL,
  `type` varchar(4) DEFAULT NULL,
  `last` varchar(0) DEFAULT NULL,
  `status` varchar(0) DEFAULT NULL,
  `rom` varchar(14) DEFAULT NULL,
  `map_pos` varchar(14) DEFAULT NULL,
  `map_num` smallint(6) DEFAULT NULL,
  `map` varchar(2) DEFAULT NULL,
  `alarm` varchar(0) DEFAULT NULL,
  `position` tinyint(4) DEFAULT NULL,
  `element_id` varchar(0) DEFAULT NULL,
  `mail` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hosts`
--

LOCK TABLES `hosts` WRITE;
/*!40000 ALTER TABLE `hosts` DISABLE KEYS */;
INSERT INTO `hosts` VALUES (1,'2018-09-27 18:51:18','Desktop','192.168.50.81','ping','','','host_Desktop','{left:0,top:0}',2363,'on','',1,'',''),(2,'2018-09-27 18:51:33','Laptop','192.168.50.80','ping','','','host_Laptop','{left:0,top:0}',1303,'on','',1,'',''),(3,'2018-09-28 10:37:47','Domoticz','192.168.50.2','ping','','','host_Domoticz','{left:0,top:0}',1568,'on','',1,'',''),(4,'2018-10-05 15:28:46','Brama__','192.168.50.61','ping','','','host_Brama__','{left:0,top:0}',4453,'on','',1,'',''),(5,'2018-10-05 18:52:06','Weranda','192.168.50.60','ping','','','host_Weranda','{left:0,top:0}',1695,'on','',1,'',''),(6,'2018-10-06 12:57:04','Kominek','192.168.50.55','ping','','','host_Kominek','{left:0,top:0}',1236,'on','',1,'',''),(7,'2018-11-02 15:33:55','Nas','192.168.50.7','ping','','','host_Nas','{left:0,top:0}',2074,'on','',1,'',''),(8,'2019-01-31 13:20:44','Tytus_1','89.25.182.54','ping','','','host_Portal','{left:0,top:0}',2089,'on','',1,'',''),(9,'2019-02-01 19:33:59','Tytus_2','tytus2.robelit.pl','ping','','','host_Tytus2','{left:0,top:0}',8378,'on','',1,'',''),(10,'2019-02-06 08:48:13','CK_1_188.95.27.58','188.95.27.58','ping','','','host_CK_1','{left:0,top:0}',2000,'on','',1,'',''),(11,'2019-02-06 08:48:31','CK_2_178.19.103.179','178.19.103.179','ping','','','host_CK_2','{left:0,top:0}',7015,'on','',1,'',''),(12,'2019-02-06 08:49:42','CP_1_188.164.243.230','188.164.243.230','ping','','','host_CP_1','{left:0,top:0}',2338,'on','',1,'',''),(13,'2019-02-06 08:49:52','CP_2_	79.190.133.138','79.190.133.138','ping','','','host_CP_2','{left:0,top:0}',9259,'on','',1,'',''),(14,'2020-07-24 20:57:41','Rpi_Ogrod','192.168.50.250','ping','','','host_Rpi_Ogrod','{left:0,top:0}',1960,'on','',1,'','');
/*!40000 ALTER TABLE `hosts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `i2c`
--

DROP TABLE IF EXISTS `i2c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `i2c` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(9) DEFAULT NULL,
  `addr` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `i2c`
--

LOCK TABLES `i2c` WRITE;
/*!40000 ALTER TABLE `i2c` DISABLE KEYS */;
INSERT INTO `i2c` VALUES (1,'bh1750','23'),(2,'bme280','76'),(3,'bmp180','77'),(4,'ds2482','18'),(5,'ds2482','1a'),(6,'hih6130','27'),(7,'htu21d','40'),(8,'mpl3115a2','60'),(9,'tmp102','48'),(10,'tsl2561','39');
/*!40000 ALTER TABLE `i2c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inverters`
--

DROP TABLE IF EXISTS `inverters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inverters` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(10) DEFAULT NULL,
  `ip` varchar(12) DEFAULT NULL,
  `port` tinyint(4) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `user` varchar(0) DEFAULT NULL,
  `pass` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inverters`
--

LOCK TABLES `inverters` WRITE;
/*!40000 ALTER TABLE `inverters` DISABLE KEYS */;
INSERT INTO `inverters` VALUES (3,'Zeversolar','192.168.50.8',80,'zeversolar','','');
/*!40000 ALTER TABLE `inverters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lcd_group_assign`
--

DROP TABLE IF EXISTS `lcd_group_assign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lcd_group_assign` (
  `rom` varchar(0) DEFAULT NULL,
  `grpkey` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lcd_group_assign`
--

LOCK TABLES `lcd_group_assign` WRITE;
/*!40000 ALTER TABLE `lcd_group_assign` DISABLE KEYS */;
/*!40000 ALTER TABLE `lcd_group_assign` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lcd_groups`
--

DROP TABLE IF EXISTS `lcd_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lcd_groups` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(2) DEFAULT NULL,
  `active` varchar(2) DEFAULT NULL,
  `charts` varchar(0) DEFAULT NULL,
  `grpkey` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lcd_groups`
--

LOCK TABLES `lcd_groups` WRITE;
/*!40000 ALTER TABLE `lcd_groups` DISABLE KEYS */;
INSERT INTO `lcd_groups` VALUES (1,'as','on','','eb556af4');
/*!40000 ALTER TABLE `lcd_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lcds`
--

DROP TABLE IF EXISTS `lcds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lcds` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(2) DEFAULT NULL,
  `addr` varchar(4) DEFAULT NULL,
  `rows` tinyint(4) DEFAULT NULL,
  `cols` tinyint(4) DEFAULT NULL,
  `clock` varchar(3) DEFAULT NULL,
  `avg` varchar(3) DEFAULT NULL,
  `active` varchar(2) DEFAULT NULL,
  `grp` varchar(7) DEFAULT NULL,
  `loop` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lcds`
--

LOCK TABLES `lcds` WRITE;
/*!40000 ALTER TABLE `lcds` DISABLE KEYS */;
INSERT INTO `lcds` VALUES (1,'AA','0x27',2,16,'off','off','on','Mariusz','off');
/*!40000 ALTER TABLE `lcds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` varchar(0) DEFAULT NULL,
  `date` varchar(0) DEFAULT NULL,
  `type` varchar(0) DEFAULT NULL,
  `message` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maps`
--

DROP TABLE IF EXISTS `maps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maps` (
  `id` smallint(6) DEFAULT NULL,
  `type` varchar(7) DEFAULT NULL,
  `element_id` smallint(6) DEFAULT NULL,
  `map_num` smallint(6) DEFAULT NULL,
  `map_pos` varchar(19) DEFAULT NULL,
  `position` tinyint(4) DEFAULT NULL,
  `map_on` varchar(2) DEFAULT NULL,
  `transparent` varchar(0) DEFAULT NULL,
  `control_on_map` varchar(0) DEFAULT NULL,
  `display_name` varchar(2) DEFAULT NULL,
  `transparent_bkg` varchar(0) DEFAULT NULL,
  `background_color` varchar(0) DEFAULT NULL,
  `background_low` varchar(0) DEFAULT NULL,
  `background_high` varchar(0) DEFAULT NULL,
  `font_color` varchar(0) DEFAULT NULL,
  `font_size` varchar(0) DEFAULT NULL,
  `icon` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maps`
--

LOCK TABLES `maps` WRITE;
/*!40000 ALTER TABLE `maps` DISABLE KEYS */;
INSERT INTO `maps` VALUES (1,'sensors',1,1616,'{left:52, top:143}',1,'on','','','on','','','','','','',''),(3,'gpio',3,8028,'{left:64, top:99}',1,'on','','','on','','','','','','','Light'),(4,'sensors',4,1484,'{left:0,top:0}',1,'on','','','','','','','','','',''),(5,'sensors',5,1417,'{left:0,top:0}',1,'on','','','','','','','','','',''),(6,'sensors',6,1111,'{left:0,top:0}',1,'on','','','','','','','','','',''),(7,'sensors',7,1421,'{left:0,top:0}',1,'on','','','','','','','','','',''),(8,'sensors',8,1380,'{left:0,top:0}',1,'on','','','','','','','','','',''),(9,'sensors',9,1235,'{left:0,top:0}',1,'on','','','','','','','','','',''),(11,'sensors',11,8278,'{left:0,top:0}',1,'on','','','','','','','','','',''),(12,'sensors',12,1179,'{left:0,top:0}',1,'on','','','','','','','','','',''),(13,'sensors',13,1283,'{left:0,top:0}',1,'on','','','','','','','','','',''),(15,'sensors',15,9083,'{left:0,top:0}',1,'on','','','','','','','','','',''),(16,'sensors',16,3364,'{left:0,top:0}',1,'on','','','','','','','','','',''),(18,'sensors',18,4152,'{left:0,top:0}',1,'on','','','','','','','','','',''),(19,'sensors',19,1620,'{left:0,top:0}',1,'on','','','','','','','','','',''),(20,'sensors',20,1429,'{left:0,top:0}',1,'on','','','','','','','','','',''),(21,'sensors',21,7518,'{left:0,top:0}',1,'on','','','','','','','','','',''),(22,'sensors',22,1950,'{left:0,top:0}',1,'on','','','','','','','','','',''),(23,'sensors',23,1108,'{left:0,top:0}',1,'on','','','','','','','','','',''),(24,'sensors',24,7587,'{left:0,top:0}',1,'on','','','','','','','','','',''),(25,'sensors',25,5358,'{left:0,top:0}',1,'on','','','','','','','','','',''),(26,'sensors',26,5703,'{left:0,top:0}',1,'on','','','','','','','','','',''),(27,'sensors',27,1211,'{left:0,top:0}',1,'on','','','','','','','','','',''),(28,'sensors',28,2363,'{left:0,top:0}',1,'on','','','','','','','','','',''),(29,'sensors',29,1303,'{left:0,top:0}',1,'on','','','','','','','','','',''),(30,'sensors',30,1568,'{left:0,top:0}',1,'on','','','','','','','','','',''),(31,'sensors',31,1914,'{left:0,top:0}',1,'on','','','','','','','','','',''),(32,'sensors',32,4453,'{left:0,top:0}',1,'on','','','','','','','','','',''),(33,'sensors',33,8833,'{left:0,top:0}',1,'on','','','','','','','','','',''),(34,'sensors',34,1695,'{left:0,top:0}',1,'on','','','','','','','','','',''),(35,'sensors',35,1236,'{left:0,top:0}',1,'on','','','','','','','','','',''),(36,'sensors',36,1422,'{left:0,top:0}',1,'on','','','','','','','','','',''),(37,'sensors',37,1327,'{left:178, top:157}',1,'on','','','','','','','','','',''),(38,'sensors',38,7533,'{left:0,top:0}',1,'on','','','','','','','','','',''),(39,'sensors',39,1677,'{left:0,top:0}',1,'on','','','','','','','','','',''),(40,'sensors',40,9139,'{left:0,top:0}',1,'on','','','','','','','','','',''),(41,'sensors',41,4572,'{left:0,top:0}',1,'on','','','','','','','','','',''),(42,'sensors',42,2033,'{left:434, top:388}',1,'on','','','','','','','','','',''),(43,'sensors',43,1628,'{left:0,top:0}',1,'on','','','','','','','','','',''),(44,'sensors',44,7971,'{left:0,top:0}',1,'on','','','','','','','','','',''),(46,'gpio',46,1452,'{left:410, top:63}',1,'on','','','on','','','','','','',''),(47,'gpio',47,1100,'{left:115, top:4}',1,'on','','','','','','','','','',''),(48,'gpio',48,1405,'{left:-12, top:64}',1,'on','','','','','','','','','',''),(49,'sensors',49,3472,'{left:0,top:0}',1,'on','','','','','','','','','',''),(50,'sensors',50,2074,'{left:0,top:0}',1,'on','','','','','','','','','',''),(51,'sensors',51,7754,'{left:0,top:0}',1,'on','','','','','','','','','',''),(52,'gpio',52,1476,'{left:122, top:48}',1,'on','','','','','','','','','',''),(56,'sensors',56,2061,'{left:-18, top:102}',1,'on','','','','','','','','','',''),(58,'sensors',58,1981,'{left:0,top:0}',1,'on','','','','','','','','','',''),(60,'sensors',60,1731,'{left:0,top:0}',1,'on','','','','','','','','','',''),(61,'sensors',61,1854,'{left:0,top:0}',1,'on','','','','','','','','','',''),(62,'sensors',62,1783,'{left:0,top:0}',1,'on','','','','','','','','','',''),(63,'sensors',62,2089,'{left:0,top:0}',1,'on','','','','','','','','','',''),(64,'sensors',63,8378,'{left:0,top:0}',1,'on','','','','','','','','','',''),(65,'sensors',64,2000,'{left:0,top:0}',1,'on','','','','','','','','','',''),(66,'sensors',65,7015,'{left:0,top:0}',1,'on','','','','','','','','','',''),(67,'sensors',66,2338,'{left:0,top:0}',1,'on','','','','','','','','','',''),(68,'sensors',67,9259,'{left:508, top:231}',1,'on','','','','','','','','','',''),(80,'sensors',79,1367,'{left:534, top:329}',1,'on','','','','','','','','','',''),(81,'sensors',80,8118,'{left:0,top:0}',1,'on','','','','','','','','','',''),(82,'sensors',81,1982,'{left:0,top:0}',1,'on','','','','','','','','','',''),(83,'sensors',82,1897,'{left:0,top:0}',1,'on','','','','','','','','','',''),(84,'sensors',83,1749,'{left:0,top:0}',1,'on','','','','','','','','','',''),(85,'sensors',84,1754,'{left:0,top:0}',1,'on','','','','','','','','','',''),(86,'sensors',85,1520,'{left:0,top:0}',1,'on','','','','','','','','','',''),(87,'sensors',86,1774,'{left:0,top:0}',1,'on','','','','','','','','','',''),(88,'sensors',87,5284,'{left:0,top:0}',1,'on','','','','','','','','','',''),(89,'sensors',88,6512,'{left:0,top:0}',1,'on','','','','','','','','','',''),(90,'sensors',89,2576,'{left:500, top:129}',1,'on','','','','','','','','','',''),(91,'sensors',90,1407,'{left:0,top:0}',1,'on','','','','','','','','','',''),(92,'sensors',91,1620,'{left:0,top:0}',1,'on','','','','','','','','','',''),(93,'sensors',92,8692,'{left:0,top:0}',1,'on','','','','','','','','','',''),(94,'sensors',93,1403,'{left:0,top:0}',1,'on','','','','','','','','','',''),(95,'sensors',94,6737,'{left:0,top:0}',1,'on','','','','','','','','','',''),(96,'sensors',95,1097,'{left:0,top:0}',1,'on','','','','','','','','','',''),(97,'sensors',96,1261,'{left:0,top:0}',1,'on','','','','','','','','','',''),(98,'sensors',97,7337,'{left:0,top:0}',1,'on','','','','','','','','','',''),(99,'sensors',98,1424,'{left:0,top:0}',1,'on','','','','','','','','','',''),(100,'sensors',99,1787,'{left:0,top:0}',1,'on','','','','','','','','','',''),(109,'sensors',108,3212,'{left:0,top:0}',1,'on','','','','','','','','','',''),(114,'sensors',113,1381,'{left:-11, top:274}',1,'on','','','','','','','','','',''),(115,'sensors',114,9687,'{left:0,top:0}',1,'on','','','','','','','','','',''),(116,'gpio',115,6278,'{left:0,top:0}',1,'on','','','','','','','','','',''),(127,'sensors',126,2056,'{left:0,top:0}',1,'on','','','','','','','','','',''),(128,'sensors',127,2657,'{left:0,top:0}',1,'on','','','','','','','','','',''),(129,'sensors',128,1935,'{left:0,top:0}',1,'on','','','','','','','','','',''),(130,'sensors',129,2091,'{left:0,top:0}',1,'on','','','','','','','','','',''),(131,'gpio',130,9645,'{left:0,top:0}',1,'on','','','','','','','','','',''),(132,'sensors',131,1991,'{left:0,top:0}',1,'on','','','','','','','','','',''),(145,'sensors',144,1820,'{left:0,top:0}',1,'on','','','','','','','','','',''),(146,'sensors',145,1203,'{left:0,top:0}',1,'on','','','','','','','','','',''),(147,'sensors',146,1271,'{left:0,top:0}',1,'on','','','','','','','','','',''),(148,'sensors',147,1960,'{left:0,top:0}',1,'on','','','','','','','','','',''),(150,'sensors',149,1177,'{left:0,top:0}',1,'on','','','','','','','','','',''),(151,'sensors',150,2143,'{left:0,top:0}',1,'on','','','','','','','','','',''),(152,'sensors',151,2821,'{left:0,top:0}',1,'on','','','','','','','','','',''),(153,'gpio',152,4614,'{left:0,top:0}',1,'on','','','','','','','','','',''),(154,'sensors',153,2327,'{left:0,top:0}',1,'on','','','','','','','','','',''),(155,'sensors',154,1582,'{left:0,top:0}',1,'on','','','','','','','','','',''),(159,'gpio',158,1714,'{left:0,top:0}',1,'on','','','','','','','','','',''),(160,'gpio',159,7014,'{left:0,top:0}',1,'on','','','','','','','','','',''),(162,'sensors',161,1584,'{left:0,top:0}',1,'on','','','','','','','','','',''),(163,'gpio',162,1865,'{left:0,top:0}',1,'on','','','','','','','','','','');
/*!40000 ALTER TABLE `maps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meteo`
--

DROP TABLE IF EXISTS `meteo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meteo` (
  `id` tinyint(4) DEFAULT NULL,
  `temp` tinyint(4) DEFAULT NULL,
  `latitude` varchar(2) DEFAULT NULL,
  `height` tinyint(4) DEFAULT NULL,
  `pressure` varchar(0) DEFAULT NULL,
  `humid` tinyint(4) DEFAULT NULL,
  `onoff` varchar(0) DEFAULT NULL,
  `normalized` varchar(2) DEFAULT NULL,
  `jg` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meteo`
--

LOCK TABLES `meteo` WRITE;
/*!40000 ALTER TABLE `meteo` DISABLE KEYS */;
INSERT INTO `meteo` VALUES (1,11,'0 ',0,'',13,'','on','');
/*!40000 ALTER TABLE `meteo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newdev`
--

DROP TABLE IF EXISTS `newdev`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newdev` (
  `id` tinyint(4) DEFAULT NULL,
  `list` varchar(0) DEFAULT NULL,
  `rom` varchar(37) DEFAULT NULL,
  `device` varchar(9) DEFAULT NULL,
  `gpio` varchar(2) DEFAULT NULL,
  `i2c` varchar(0) DEFAULT NULL,
  `ip` varchar(13) DEFAULT NULL,
  `name` smallint(6) DEFAULT NULL,
  `type` varchar(11) DEFAULT NULL,
  `usb` varchar(0) DEFAULT NULL,
  `seen` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newdev`
--

LOCK TABLES `newdev` WRITE;
/*!40000 ALTER TABLE `newdev` DISABLE KEYS */;
INSERT INTO `newdev` VALUES (1,'','ip_mqtt_ESP_Brama_status_LWT','ip_mqtt','','','192.168.50.61',1782,'status','',1),(2,'','ip_mqtt_Kurnik_status_LWT','ip_mqtt','','','192.168.50.63',2443,'status','',1),(3,'','system_cpu','system','','','',5853,'cpuusage','',1),(4,'','system_memory','system','','','',1116,'memoryusage','',1),(5,'','shelly1pm-A4CF12F3CEFB','mqtt','','','',9169,'shelly1pm','',1),(6,'','announce','mqtt','','','',3438,'announce','',1),(7,'','lmsensors_temp1_temp','lmsensors','','','',6737,'temp','',1),(8,'','gpio_4','gpio','4','','',1354,'gpio','',1),(9,'','gpio_27','gpio','27','','',1489,'gpio','',1),(10,'','gpio_22','gpio','22','','',1762,'gpio','',1),(11,'','gpio_5','gpio','5','','',1421,'gpio','',1),(12,'','gpio_18','gpio','18','','',7952,'gpio','',1),(13,'','gpio_23','gpio','23','','',1924,'gpio','',1),(14,'','gpio_24','gpio','24','','',3608,'gpio','',1),(15,'','gpio_25','gpio','25','','',4871,'gpio','',1),(16,'','gpio_12','gpio','12','','',1763,'gpio','',1),(17,'','gpio_16','gpio','16','','',1072,'gpio','',1),(18,'','gpio_21','gpio','21','','',9417,'gpio','',1),(19,'','ip_meteo_id4_uv','ip','','','192.168.50.3',7584,'uv','',1),(20,'','ip_meteo_id6_press','ip','','','192.168.50.3',1229,'press','',1),(21,'','ip_meteo_id7_humid','ip','','','192.168.50.3',1393,'humid','',1),(22,'','ip_meteo_id8_temp','ip','','','192.168.50.3',1342,'temp','',1),(23,'','ip_meteo_id10_temp','ip','','','192.168.50.3',1190,'temp','',1),(24,'','ip_meteo_id11_temp','ip','','','192.168.50.3',1797,'temp','',1),(25,'','ip_meteo_id12_temp','ip','','','192.168.50.3',4789,'temp','',1),(26,'','ip_meteo_id13_temp','ip','','','192.168.50.3',2074,'temp','',1),(27,'','ip_meteo_id14_temp','ip','','','192.168.50.3',9385,'temp','',1),(28,'','ip_meteo_id16_volt','ip','','','192.168.50.3',8326,'volt','',1),(29,'','ip_meteo_id17_volt','ip','','','192.168.50.3',1288,'volt','',1),(30,'','ip_meteo_id21_storm','ip','','','192.168.50.3',6403,'storm','',1),(31,'','ip_meteo_id22_lightining','ip','','','192.168.50.3',9403,'lightining','',1),(32,'','ip_mqtt_ESP_Brama_Switch_BramaTrigger','ip_mqtt','','','192.168.50.61',5525,'Switch','',1);
/*!40000 ALTER TABLE `newdev` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` tinyint(4) DEFAULT NULL,
  `rom` varchar(29) DEFAULT NULL,
  `type` varchar(7) DEFAULT NULL,
  `wheen` tinyint(4) DEFAULT NULL,
  `value` varchar(3) DEFAULT NULL,
  `sms` varchar(2) DEFAULT NULL,
  `mail` varchar(2) DEFAULT NULL,
  `pov` varchar(2) DEFAULT NULL,
  `message` varchar(38) DEFAULT NULL,
  `priority` tinyint(4) DEFAULT NULL,
  `iginterval` varchar(0) DEFAULT NULL,
  `recovery` varchar(2) DEFAULT NULL,
  `active` varchar(2) DEFAULT NULL,
  `sent` varchar(4) DEFAULT NULL,
  `interval` varchar(3) DEFAULT NULL,
  `fc` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (5,'ip_meteo_id5_lux','lupdate',3,'5','','','on','',0,'','on','on','','15m',''),(7,'domo_Salon','value',2,'19','on','on','on','Salon - niska temperatura',0,'','on','on','','30m',''),(8,'domo_Salon','value',4,'40','on','on','on','Salon - możliwy pożar',0,'','on','on','','1m',''),(9,'domo_Sypialnia','value',2,'19','on','on','on','Sypialnia - niska temperatura',0,'','on','on','','30m',''),(10,'domo_Sypialnia','value',4,'40','on','on','on','Sypialnia - Możliwy pożar',0,'','on','on','','1m',''),(11,'domo_Jas','value',2,'19','on','on','on','Jaś - niska temperatura',0,'','on','on','','30m',''),(12,'domo_Jas','value',3,'40','on','on','on','Jaś - możliwy pożar',0,'','on','on','','1m',''),(13,'domo_Zosia','value',2,'19','on','on','on','Zosia - niska temperatura',0,'','on','on','','30m',''),(14,'domo_Zosia','value',4,'40','on','on','on','Zosia - Możliwy pożar',0,'','on','on','','1m',''),(15,'domo_laz_mala','value',2,'19','on','on','on','Łazienka mała - niska temperatura',0,'','on','on','','30m',''),(16,'domo_laz_mala','value',4,'40 ','on','on','on','Łazienka mała - możliwy pozar',0,'','on','on','','1m',''),(17,'domo_laz_duz','value',2,'19','on','on','on','Łazienka duża - niska temperatura',0,'','on','on','','30m',''),(18,'domo_laz_duz','value',4,'40','on','on','on','Łazienka duża - możliwy pożar',0,'','on','on','','1m',''),(19,'domo_Bawialnia','value',2,'19','on','on','on','Bawialnia - niska temperatura',0,'','on','on','','30m',''),(20,'domo_Bawialnia','value',4,'40','on','on','on','Bawialnia - możliwy pożar',0,'','on','on','','1m',''),(21,'domo_Piw_wiatrolap','value',2,'15','','','on','Wiatrołap - niska temperatura',0,'','on','on','','30m',''),(22,'domo_Piw_wiatrolap','value',4,'35','on','on','on','Wiatrołap - możliwy pożar',0,'','on','on','','1m',''),(24,'domo_Graciarnia','value',4,'35','on','on','on','Graciarnia - możliwy pożar',0,'','on','on','','1m',''),(25,'domo_Pralnia','value',2,'17','','','on','Pralnia - niska temperatura',0,'','','on','sent','30m',''),(26,'domo_Pralnia','value',4,'35','on','on','on','Pralnia - możliwy pożar',0,'','on','on','','1m',''),(27,'domo_Korytarz','value',2,'18','on','on','on','Korytarz - niska temperatura',0,'','','on','sent','30m',''),(28,'domo_Korytarz','value',4,'35','on','on','on','Korytarz - możliwy pożar',0,'','on','on','','1m',''),(29,'domo_Piec','value',4,'85','on','on','on','Piec C.O. - Przegrzanie',0,'','on','on','','1m',''),(30,'domo_Bojler','value',4,'80','on','on','on','Bojler - przegrzanie',0,'','on','on','','1m',''),(31,'domo_Zasil_Pod','value',4,'50','on','on','on','Podłoga zasilanie - wysoka temperatura',0,'','on','on','','1m',''),(32,'Raspberry_Pi','value',4,'70','','','on','Rpi TH35 - przegrzanie',0,'','on','on','','15m',''),(33,'ip_meteo_id19_battery','lupdate',3,'5','','','on','',0,'','on','on','','1h',''),(34,'domo_szambo','value',1,'130','','','on','Wypompuj szambo',0,'','on','on','','6h',''),(36,'domo_szambo','lupdate',3,'60','','','on','',0,'','on','on','','1h',''),(37,'ip_meteo_id9_temp','lupdate',3,'5','','','on','',-2,'','on','on','','15m',''),(38,'ip_meteo_id18_volt','lupdate',3,'5','','','','',-2,'','on','on','sent','1m',''),(39,'ip_meteo_id15_volt','lupdate',3,'5','','','','',-2,'','on','on','sent','1m',''),(40,'domo_Wilgotnosc','lupdate',3,'120','','','','',-2,'','on','on','sent','1m',''),(41,'domo_Graciarnia','value',1,'18','','','on','Graciarnia - niska temperatura',0,'','on','','','30m',''),(42,'host_Portal','value',5,'0','','','on','Tytus 1 nie działa',0,'','on','on','','5m',''),(43,'host_Tytus2','value',5,'0','','','on','Tytus 2 nie działa',0,'','on','on','','5m',''),(44,'host_CP_2','value',5,'0','','','on','Bór WAN 2 - nie działa',0,'','on','on','','5m',''),(45,'host_CP_1','value',5,'0','','','on','Bór WAN 1 - nie działa',0,'','on','on','','1h',''),(46,'host_CK_2','value',5,'0','','','on','',0,'','on','','','1h',''),(47,'host_CK_1','value',5,'0','','','on','',0,'','on','','','5m',''),(48,'domo_w_cieniu','value',1,'2','','','on','',2,'','','','','15m',''),(50,'ip_meteo_id9_temp','value',1,'3','','','on','',2,'','','','','15m',''),(51,'ip_meteo_id1_rainfall','value',3,'0','','','on','Pada deszcz',1,'','on','on','','1h',''),(52,'host_Domoticz','value',5,'0','','','on','Domoticz nie działa',0,'','on','on','','1h',''),(53,'host_Brama__','value',5,'0','','','on','Brama nie działa',0,'','on','on','','1h',''),(54,'host_Weranda','value',5,'0','','on','on','Weranda nie działa',0,'','on','on','','1h',''),(55,'ip_meteo_id20_gust','value',4,'50','','','on','Silny wiatr',0,'','on','on','','1m',''),(56,'shelly1pm-A4CF12F3CEFB_gpio_0','value',5,'0.0','','','on','Żelazko wyłączone',0,'','on','on','','1h',''),(57,'host_Rpi_Ogrod','value',5,'0','','','on','Rpi Ogród - nie działa',2,'','on','on','','5m','');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_settings`
--

DROP TABLE IF EXISTS `nt_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_settings` (
  `id` tinyint(4) DEFAULT NULL,
  `option` varchar(23) DEFAULT NULL,
  `value` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_settings`
--

LOCK TABLES `nt_settings` WRITE;
/*!40000 ALTER TABLE `nt_settings` DISABLE KEYS */;
INSERT INTO `nt_settings` VALUES (1,'server_key','1234'),(2,'client_ip','192.168.50.250'),(3,'client_key','1234!!'),(4,'client_on','on'),(5,'cauth_on',''),(6,'cauth_pass',''),(7,'mail_topic','Nettemp RpiTH35'),(8,'mail_onoff','on'),(9,'gpio','on'),(10,'gpio_demo','off'),(11,'MCP23017','off'),(12,'charts_min','1'),(13,'charts_theme','black'),(14,'charts_meteogram','Polen/Schlesien/Czestochowa/'),(15,'charts_default','Highcharts'),(16,'charts_max','day'),(17,'charts_fast','off'),(18,'fw',''),(19,'vpn',''),(20,'temp_scale','C'),(21,'footer','on'),(22,'info','on'),(23,'screen',''),(24,'map_height','600'),(25,'map_width','800'),(26,'nettemp_alt','nettemp.tk'),(27,'nettemp_link','http://nettemp.tk'),(28,'nettemp_logo','media/png/nettemp.tk.png'),(29,'sms','off'),(30,'authmod',''),(31,'radius',''),(32,'lcd','off'),(33,'lcd4','off'),(34,'ups_status',''),(35,'minmax_mode','1'),(36,'lcdmode','adv'),(37,'ups_akku_discharged','2.8'),(38,'ups_lcd_scroll','2'),(39,'ups_lcd_backlight','3'),(40,'ups_delay_on','5'),(41,'ups_delay_off','10'),(42,'ups_time_off','0'),(43,'ups_akku_temp','45'),(44,'ups_toff_start','1582488062'),(45,'ups_count','0'),(46,'ups_toff_stop','1582488062'),(47,'ups_language','1'),(48,'hide_gpio','off'),(49,'hide_minmax','off'),(50,'hide_counters','off'),(51,'hide_ups','off'),(52,'ups_backl_time','30'),(53,'client_port','80'),(54,'mapon',''),(55,'pusho_active','on'),(56,'pusho_user_key','u8z2an68bkgdbhe22rq1bripbo1c34'),(57,'pusho_api_key','ayjoka66mocbuqgb5oo42zs1xxdoia'),(58,'lat','50.7026'),(59,'long','19.0298'),(60,'domoip','192.168.50.2'),(61,'domoport','80'),(62,'domoon','on'),(63,'domoauth','on'),(64,'domolog','admin'),(65,'domopass','maniek1'),(66,'sensorinterval','2m'),(67,'switchinterval','5m'),(68,'logs','on'),(69,'logshis','3'),(70,'kwhcost1','0.65'),(71,'kwhcost2','0.65'),(72,'gascost1','0.65'),(73,'watercost1','0.65'),(74,'readerr','60'),(75,'refreshcount','2439'),(76,'logrefresh','off'),(77,'chartsrefresh',''),(78,'dbUpdateEditPreparePage','1'),(79,'logs_type','Errors'),(80,'theme','Dark'),(81,'inflip','192.168.50.4'),(82,'inflport','8086'),(83,'inflon',''),(84,'inflbase','nettemp'),(85,'inflbaseuser','nettemp'),(86,'inflbasepassword','Ala1Ala2'),(87,'chartsforall','on'),(88,'mqtt_ip','localhost'),(89,'mqtt_port','1883'),(90,'mqtt_usr',''),(91,'mqtt_pwd','');
/*!40000 ALTER TABLE `nt_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ovariables`
--

DROP TABLE IF EXISTS `ovariables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ovariables` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(14) DEFAULT NULL,
  `value` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ovariables`
--

LOCK TABLES `ovariables` WRITE;
/*!40000 ALTER TABLE `ovariables` DISABLE KEYS */;
INSERT INTO `ovariables` VALUES (1,'kurnik_po_zach',40),(2,'kurnik_po_wsch',95);
/*!40000 ALTER TABLE `ovariables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ownlinks`
--

DROP TABLE IF EXISTS `ownlinks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ownlinks` (
  `id` varchar(0) DEFAULT NULL,
  `pos` varchar(0) DEFAULT NULL,
  `name` varchar(0) DEFAULT NULL,
  `link` varchar(0) DEFAULT NULL,
  `onoff` varchar(0) DEFAULT NULL,
  `target` varchar(0) DEFAULT NULL,
  `logon` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ownlinks`
--

LOCK TABLES `ownlinks` WRITE;
/*!40000 ALTER TABLE `ownlinks` DISABLE KEYS */;
/*!40000 ALTER TABLE `ownlinks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ownwidget`
--

DROP TABLE IF EXISTS `ownwidget`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ownwidget` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(9) DEFAULT NULL,
  `body` smallint(6) DEFAULT NULL,
  `onoff` varchar(3) DEFAULT NULL,
  `iflogon` varchar(3) DEFAULT NULL,
  `refresh` varchar(3) DEFAULT NULL,
  `hide` varchar(3) DEFAULT NULL,
  `edithide` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ownwidget`
--

LOCK TABLES `ownwidget` WRITE;
/*!40000 ALTER TABLE `ownwidget` DISABLE KEYS */;
INSERT INTO `ownwidget` VALUES (2,'Burze',1228,'on','off','off','on','on'),(3,'My_widget',1628,'off','off','off','off','off');
/*!40000 ALTER TABLE `ownwidget` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relays`
--

DROP TABLE IF EXISTS `relays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relays` (
  `id` varchar(0) DEFAULT NULL,
  `list` varchar(0) DEFAULT NULL,
  `name` varchar(0) DEFAULT NULL,
  `ip` varchar(0) DEFAULT NULL,
  `delay` varchar(0) DEFAULT NULL,
  `rom` varchar(0) DEFAULT NULL,
  `type` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relays`
--

LOCK TABLES `relays` WRITE;
/*!40000 ALTER TABLE `relays` DISABLE KEYS */;
/*!40000 ALTER TABLE `relays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rs485`
--

DROP TABLE IF EXISTS `rs485`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rs485` (
  `id` tinyint(4) DEFAULT NULL,
  `dev` varchar(6) DEFAULT NULL,
  `addr` tinyint(4) DEFAULT NULL,
  `baudrate` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rs485`
--

LOCK TABLES `rs485` WRITE;
/*!40000 ALTER TABLE `rs485` DISABLE KEYS */;
INSERT INTO `rs485` VALUES (1,'SDM630',1,9600);
/*!40000 ALTER TABLE `rs485` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sensors`
--

DROP TABLE IF EXISTS `sensors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sensors` (
  `id` smallint(6) DEFAULT NULL,
  `time` varchar(19) DEFAULT NULL,
  `tmp` decimal(13,3) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `rom` varchar(33) DEFAULT NULL,
  `tmp_min` varchar(4) DEFAULT NULL,
  `tmp_max` varchar(5) DEFAULT NULL,
  `alarm` varchar(3) DEFAULT NULL,
  `type` varchar(11) DEFAULT NULL,
  `gpio` varchar(2) DEFAULT NULL,
  `ip` varchar(17) DEFAULT NULL,
  `device` varchar(7) DEFAULT NULL,
  `lcd` varchar(3) DEFAULT NULL,
  `method` varchar(0) DEFAULT NULL,
  `tmp_5ago` decimal(13,3) DEFAULT NULL,
  `adj` tinyint(4) DEFAULT NULL,
  `charts` varchar(3) DEFAULT NULL,
  `remote` varchar(3) DEFAULT NULL,
  `i2c` varchar(0) DEFAULT NULL,
  `minmax` varchar(5) DEFAULT NULL,
  `sum` decimal(16,8) DEFAULT NULL,
  `ch_group` varchar(10) DEFAULT NULL,
  `jg` varchar(3) DEFAULT NULL,
  `current` varchar(8) DEFAULT NULL,
  `mail` varchar(4) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  `usb` varchar(12) DEFAULT NULL,
  `position_group` smallint(6) DEFAULT NULL,
  `stat_min` varchar(17) DEFAULT NULL,
  `stat_max` varchar(15) DEFAULT NULL,
  `position` smallint(6) DEFAULT NULL,
  `jg_min` varchar(0) DEFAULT NULL,
  `jg_max` varchar(0) DEFAULT NULL,
  `logon` varchar(3) DEFAULT NULL,
  `thing` varchar(3) DEFAULT NULL,
  `readerr` varchar(2) DEFAULT NULL,
  `readerralarm` varchar(3) DEFAULT NULL,
  `trigzero` varchar(6) DEFAULT NULL,
  `trigone` varchar(7) DEFAULT NULL,
  `trigzeroclr` varchar(13) DEFAULT NULL,
  `trigoneclr` varchar(12) DEFAULT NULL,
  `latitude` varchar(8) DEFAULT NULL,
  `longitude` varchar(8) DEFAULT NULL,
  `apikey` varchar(32) DEFAULT NULL,
  `ssms` varchar(3) DEFAULT NULL,
  `smail` varchar(0) DEFAULT NULL,
  `script` varchar(0) DEFAULT NULL,
  `script1` varchar(0) DEFAULT NULL,
  `readerrsend` varchar(4) DEFAULT NULL,
  `ghide` varchar(3) DEFAULT NULL,
  `bindsensor` varchar(0) DEFAULT NULL,
  `hide` varchar(3) DEFAULT NULL,
  `timezone` varchar(1) DEFAULT NULL,
  `domoticz` varchar(3) DEFAULT NULL,
  `domoticzidx` varchar(3) DEFAULT NULL,
  `smssend` varchar(0) DEFAULT NULL,
  `posend` varchar(4) DEFAULT NULL,
  `cost1` varchar(4) DEFAULT NULL,
  `cost2` varchar(3) DEFAULT NULL,
  `t1start` varchar(0) DEFAULT NULL,
  `t1stop` varchar(0) DEFAULT NULL,
  `t2start` varchar(0) DEFAULT NULL,
  `t2stop` varchar(0) DEFAULT NULL,
  `readerrtime` tinyint(4) DEFAULT NULL,
  `dpromtemp` varchar(0) DEFAULT NULL,
  `dpromhumid` varchar(0) DEFAULT NULL,
  `hddpath` varchar(1) DEFAULT NULL,
  `tobase` varchar(3) DEFAULT NULL,
  `influxdb` varchar(3) DEFAULT NULL,
  `prec` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sensors`
--

LOCK TABLES `sensors` WRITE;
/*!40000 ALTER TABLE `sensors` DISABLE KEYS */;
INSERT INTO `sensors` VALUES (1,'2021-06-15 15:07:01',47.200,'Rpi','Raspberry_Pi','20.0','70.0','on','temp','','','rpi','','',47.700,0,'on','off','','',0.00000000,'Pozostałe','','','','ok','',3,'30.4','78.3',45,'','','on','off','10','on','','','','','','','','','','','','','off','','off','','on','','','','0.0','0.0','','','','',60,'','','','on','off',1),(3,'2021-06-15 15:07:04',0.000,'Brama','gpio_20','','','off','gpio','20','','gpio','','',0.000,0,'on','','','',0.00000000,'gpio','','','','ok','',5,'0','1',1,'','','off','off','60','off','','','','','','','','','','','','','off','','on','','off','','','','0.0','0.0','','','','',60,'','','','on','off',1),(4,'2021-06-15 15:07:18',1.600,'Wiatr','ip_meteo_id2_speed','','','off','speed','','192.168.50.3','ip','','',3.600,0,'on','','','',234710.80000000,'Parter','','','','ok','',1,'0.1','10.2',146,'','','on','off','60','off','','','','','','','','','','','','','off','','off','','on','183','','','0.0','0.0','','','','',60,'','','','on','off',1),(5,'2021-06-15 15:07:19',0.000,'Luxy','ip_meteo_id5_lux','','','','lux','','192.168.50.3','ip','off','',0.000,0,'off','','','off',28586.60000000,'Pozostałe','off','','sent','ok','',3,'0','27252.5',30,'','','on','off','10','on','','','','','','','','','','','','','off','','on','','on','180','','sent','0.0','0.0','','','','',60,'','','','on','off',1),(6,'2021-06-15 15:07:20',4.800,'Poryw','ip_meteo_id20_gust','','','off','gust','','192.168.50.3','ip','','',4.800,0,'on','','','on',0.00000000,'Parter','','','','ok','',1,'2.4','64.8',147,'','','on','off','60','off','','','','','','','','','','','','','off','','off','','on','184','','','0.0','0.0','','','','',60,'','','','on','off',1),(7,'2021-06-15 15:07:19',26.500,'W_słońcu','ip_meteo_id9_temp','','','','temp','','192.168.50.3','ip','off','',26.400,0,'on','on','','on',2388208.00000000,'Parter','off','','','ok','',1,'-18.5','44.2',100,'','','on','on','60','off','','','','','','','','','','','','','off','','off','','on','179','','','0.0','0.0','','','','',60,'','','','on','on',1),(8,'2021-06-15 15:07:20',93.000,'Akumulator','ip_meteo_id19_battery','50.0','100.0','','battery','','192.168.50.3','ip','','',92.000,0,'off','','','',24136782.00000000,'Pozostałe','off','','sent','ok','',3,'17','98',31,'','','on','off','10','on','','','','','','','','','','','','','off','','on','','on','181','','','0.0','0.0','','','','',60,'','','','on','off',0),(9,'2021-06-15 15:07:19',6.620,'Panel','ip_meteo_id15_volt','','','off','volt','','192.168.50.3','ip','off','',6.630,0,'on','','','',636596.38000000,'Pozostałe','','','','ok','',3,'0.54','6.95',40,'','','on','off','60','off','','','','','','','','','','','','','off','','off','','on','182','','','0.0','0.0','','','','',60,'','','','on','off',2),(11,'2021-06-15 15:07:00',25.400,'W_cieniu','domo_w_cieniu','','','off','temp','','192.168.50.2','ip','','',25.400,0,'on','on','','on',2427402.70070104,'Parter','off','','','ok','',1,'-128.3','62.8',105,'','','on','on','60','off','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','on',1),(12,'2021-06-15 15:07:00',23.700,'Salon','domo_Salon','','','off','temp','','192.168.50.2','ip','','',23.700,0,'on','','','',7784645.39357412,'Parter','','','','ok','',1,'18.1','61.9',110,'','','on','on','60','off','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','on',1),(13,'2021-01-21 17:34:00',39.000,'Wilgotność','domo_Wilgotnosc','','','off','humid','','192.168.50.2','ip','','',26.000,0,'on','','','',12975548.00000000,'Parter','','','sent','ok','',1,'6','75',115,'','','on','on','60','off','','','','','50.7026','19.0298','','','','','','sent','off','','off','','off','0','','','0.0','0.0','','','','',60,'','','','on','off',0),(15,'2021-06-15 15:07:01',57.500,'Piec','domo_Piec','','','off','temp','','192.168.50.2','ip','','',57.600,0,'on','','','',17026584.99793720,'Piwnica','','','','ok','',2,'20.7','90.3',215,'','','on','on','60','off','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(16,'2021-06-15 15:07:01',49.800,'Bojler','domo_Bojler','','','off','temp','','192.168.50.2','ip','','',49.800,0,'on','','','',17163474.89466250,'Piwnica','','','','ok','',2,'-11.4','81.6',220,'','','on','on','60','off','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(18,'2021-06-15 15:07:02',22.800,'Sypialnia','domo_Sypialnia','','','off','temp','','192.168.50.2','ip','','',22.800,0,'on','','','',7446253.38983338,'Parter','','','','ok','',1,'17.2','28.3',120,'','','on','off','60','off','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(19,'2021-06-15 15:07:02',23.000,'Łazienka_Duża','domo_laz_duz','','','off','temp','','192.168.50.2','ip','','',23.000,0,'on','','','off',7627725.79683804,'Parter','','','','ok','',1,'18.3','28.2',125,'','','on','off','60','off','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(20,'2021-06-15 15:07:01',22.100,'Łazienka_Mała','domo_laz_mala','','','off','temp','','192.168.50.2','ip','','',22.100,0,'on','','','',7766046.39761042,'Parter','','','','ok','',1,'11','27.8',130,'','','on','off','60','off','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(21,'2021-06-15 15:07:01',24.400,'Bawialnia','domo_Bawialnia','','','off','temp','','192.168.50.2','ip','','',24.400,0,'on','','','',7581570.49668619,'Parter','','','','ok','',1,'16.39999961853','61.8',145,'','','on','off','60','off','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(22,'2021-06-15 15:07:01',22.600,'Zosia','domo_Zosia','','','off','temp','','192.168.50.2','ip','','',22.600,0,'on','','','',7580370.49659236,'Parter','','','','ok','',1,'-0.1','29.9',140,'','','on','on','60','off','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(23,'2021-06-15 15:07:01',23.300,'Jaś','domo_Jas','','','off','temp','','192.168.50.2','ip','','',23.300,0,'on','','','',7581787.59578244,'Parter','','','','ok','',1,'-0.1','29.6',135,'','','on','on','60','off','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(24,'2021-06-15 15:07:03',20.700,'Korytarz','domo_Korytarz','10.0','30.0','on','temp','','192.168.50.2','ip','','',20.700,0,'on','','','',7130390.39208856,'Piwnica','','','','ok','',2,'-0.10000000149012','52.9',210,'','','on','off','60','off','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(25,'2021-06-15 15:07:03',20.600,'Pralnia','domo_Pralnia','10.0','30.0','on','temp','','192.168.50.2','ip','','',20.600,0,'on','','','',7037928.09699825,'Piwnica','','','','ok','',2,'16.8','22.8',205,'','','on','off','60','off','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(26,'2021-06-15 15:07:02',19.300,'Graciarnia','domo_Graciarnia','10.0','30.0','on','temp','','192.168.50.2','ip','','',19.300,0,'on','','','',6749843.19431422,'Piwnica','','','','ok','',2,'15.1','23.1',200,'','','on','off','60','off','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(27,'2021-06-15 15:07:02',29.300,'Powrót','domo_Powrot_Podloga','','','off','temp','','192.168.50.2','ip','','',29.300,0,'on','','','',9156628.19337880,'Piwnica','','','','ok','',2,'20.1','35.9',235,'','','on','off','60','off','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(28,'2021-06-15 15:07:09',0.000,'Desktop','host_Desktop','','','','host','','192.168.50.81','ip','','',0.610,0,'on','','','',0.00000000,'Hosty','off','','','error','',7,'0.20','1087',1,'','','','','','','','','','','','','','','','','','','off','','off','','','','','','0.0','0.0','','','','',0,'','','','on','off',1),(29,'2021-06-15 15:07:13',0.000,'Laptop','host_Laptop','','','on','host','','192.168.50.80','ip','','',41.600,0,'on','','','',0.00000000,'Hosty','','','','error','',7,'1.39','1674',1,'','','off','','','','','','','','','','','','','','','','off','','off','','','','','','0.0','0.0','','','','',0,'','','','on','off',1),(30,'2021-06-15 15:07:13',0.420,'Domoticz','host_Domoticz','','','on','host','','192.168.50.2','ip','','',0.530,0,'on','','','off',0.00000000,'Hosty','','','','ok','',7,'0.28','3021',1,'','','','','10','on','','','','','','','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(31,'2021-06-15 07:14:20',0.000,'Brama_','BramaTrigger','','','off','trigger','','192.168.50.61','','','',1.000,0,'on','','','',0.00000000,'Parter','off','','','on','',1,'','',160,'','','off','off','0','off','Closed','Open','label-info','label-danger','50.7026','19.0298','','off','','','','','off','','off','','','','','','0.0','0.0','','','','',0,'','','','on','off',1),(32,'2021-06-15 15:07:13',2.960,'Brama__','host_Brama__','','','on','host','','192.168.50.61','ip','','',80.600,0,'on','','','',0.00000000,'Hosty','off','','','ok','',7,'1.34','3163',1,'','','','','10','on','','','','','','','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(33,'2021-06-15 15:07:03',34.400,'Zasilanie','domo_Zasil_Pod','','','off','temp','','192.168.50.2','ip','','',34.400,0,'on','','','',11373051.29353570,'Piwnica','','','','ok','',2,'1','49.9',230,'','','on','off','60','off','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(34,'2021-06-15 15:07:14',13.900,'Weranda','host_Weranda','','','on','host','','192.168.50.60','ip','','',51.400,0,'on','','','',0.00000000,'Hosty','','','','ok','',7,'1.48','2180',1,'','','','','10','on','','','','','','','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(35,'2021-06-15 15:07:18',0.000,'Kominek','host_Kominek','','','on','host','','192.168.50.55','ip','','',58.600,0,'on','','','',0.00000000,'Hosty','','','','error','',7,'1.41','2294',1,'','','','','10','on','','','','','','','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(36,'2021-05-19 22:25:56',0.000,'Bawialnia_','gpio_bawialnia','','','off','trigger','','192.168.50.2','ip','','',0.000,0,'on','','','',90430.00000000,'Ogrzewanie','','','','on','',4,'','',625,'','','off','off','60','off','OFF','ON','label-info','label-danger','50.7026','19.0298','','','','','','','on','','off','','','','','','0.0','0.0','','','','',0,'','','','on','off',1),(37,'2021-06-13 22:03:48',0.000,'Graciarnia_','gpio_graciarnia','','','off','trigger','','192.168.50.2','ip','','',1.000,0,'on','','','',108331.00000000,'Ogrzewanie','','','','on','',4,'','',630,'','','off','off','60','off','OFF','ON','label-info','label-danger','50.7026','19.0298','','off','','','','','on','','off','','','','','','0.0','0.0','','','','',0,'','','','on','off',1),(38,'2021-05-20 05:59:27',0.000,'Łazienka_Duża_','gpio_lazd','','','off','trigger','','192.168.50.2','ip','','',0.000,0,'on','','','',103461.00000000,'Ogrzewanie','','','','on','',4,'','',605,'','','off','off','60','off','OFF','ON','label-info','label-danger','50.7026','19.0298','','','','','','','on','','off','','','','','','0.0','0.0','','','','',0,'','','','on','off',1),(39,'2021-05-20 04:26:30',0.000,'Jaś_','gpio_jas','','','off','trigger','','192.168.50.2','ip','','',0.000,0,'on','','','',99866.00000000,'Ogrzewanie','','','','on','',4,'','',615,'','','off','off','60','off','OFF','ON','label-info','label-danger','50.7026','19.0298','','','','','','','on','','off','','','','','','0.0','0.0','','','','',0,'','','','on','off',1),(40,'2021-05-20 05:59:24',0.000,'Łazienka_Mała_','gpio_lazm','','','off','trigger','','192.168.50.2','ip','','',0.000,0,'on','','','',29387.00000000,'Ogrzewanie','','','','on','',4,'','',610,'','','off','off','60','off','OFF','ON','label-info','label-danger','50.7026','19.0298','','','','','','','on','','off','','','','','','0.0','0.0','','','','',0,'','','','on','off',1),(41,'2021-05-17 18:15:38',0.000,'Sypialnia_','gpio_sypialnia','','','off','trigger','','192.168.50.2','ip','','',0.000,0,'on','','','',107249.00000000,'Ogrzewanie','','','','on','',4,'','',601,'','','off','off','60','off','OFF','ON','label-info','label-danger','50.7026','19.0298','','','','','','','on','','off','','','','','','0.0','0.0','','','','',0,'','','','on','off',1),(42,'2021-05-20 05:58:34',0.000,'Salon_','gpio_salon','','','off','trigger','','192.168.50.2','ip','','',0.000,0,'on','','','',116508.00000000,'Ogrzewanie','','','','on','',4,'','',600,'','','off','off','60','off','OFF','ON','label-info','label-danger','50.7026','19.0298','','off','','','','','on','','off','','','','','','0.0','0.0','','','','',0,'','','','on','off',1),(43,'2021-06-15 07:59:58',0.000,'Pralnia_','gpio_pralnia','','','off','trigger','','192.168.50.2','ip','','',0.000,0,'on','','','',120390.00000000,'Ogrzewanie','','','','on','',4,'','',635,'','','off','off','60','off','OFF','ON','label-info','label-danger','50.7026','19.0298','','','','','','','on','','off','','','','','','0.0','0.0','','','','',0,'','','','on','off',1),(44,'2021-05-20 05:57:11',0.000,'Zosia_','gpio_zosia','','','off','trigger','','192.168.50.2','ip','','',0.000,0,'on','','','',82116.00000000,'Ogrzewanie','','','','on','',4,'','',620,'','','off','off','60','off','OFF','ON','label-info','label-danger','50.7026','19.0298','','','','','','','on','','off','','','','','','0.0','0.0','','','','',0,'','','','on','off',1),(46,'2021-06-15 15:07:04',0.000,'P._Wiatrołap','gpio_13','','','off','gpio','13','','gpio','','',0.000,0,'on','','','',0.00000000,'gpio','','','','ok','',5,'0','11',1,'','','off','off','60','off','','','','','50.7026','19.0298','','','','','','','off','','on','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(47,'2021-06-15 15:07:04',0.000,'P._Pralnia','gpio_19','','','off','gpio','19','','gpio','','',0.000,0,'on','','','',0.00000000,'gpio','','','','ok','',5,'0','1',1,'','','off','off','60','off','','','','','50.7026','19.0298','','','','','','','off','','on','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(48,'2021-06-15 15:07:04',0.000,'P._Graciarnia','gpio_26','','','off','gpio','26','','gpio','','',0.000,0,'on','','','',0.00000000,'gpio','','','','ok','',5,'0','1',1,'','','off','off','60','off','','','','','50.7026','19.0298','','','','','','','off','','on','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(49,'2021-05-18 14:05:41',0.000,'P._Wiatrołap_','gpio_wiatrolap','','','off','trigger','','192.168.50.2','ip','','',0.000,0,'on','','','',64206.00000000,'Ogrzewanie','','','','on','',4,'','',640,'','','off','off','60','off','OFF','ON','label-info','label-danger','50.7026','19.0298','','','','','','','on','','off','','','','','','0.0','0.0','','','','',0,'','','','on','off',1),(50,'2021-06-15 15:07:18',0.320,'Nas','host_Nas','','','on','host','','192.168.50.7','ip','','',0.340,0,'on','','','',0.00000000,'Hosty','','','','ok','',7,'0.17','270',1,'','','','','10','on','','','','','','','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(51,'2021-06-15 15:07:03',20.900,'Wiatrołap','domo_Piw_wiatrolap','10.0','30.0','on','temp','','192.168.50.2','ip','','',20.900,0,'on','','','',5610132.49967543,'Piwnica','','','','ok','',2,'14.1','26.200000762939',195,'','','on','off','20','on','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(52,'2021-06-15 15:07:03',0.000,'Lato','gpio_6','','','off','gpio','6','','gpio','','',0.000,0,'on','','','',0.00000000,'gpio','','','','ok','',5,'0','1',1,'','','off','off','60','off','','','','','50.7026','19.0298','','','','','','','off','','on','','','','','','0.0','0.0','','','','',60,'','','','on','off',1),(56,'2021-06-15 15:07:03',137.000,'Szambo','domo_szambo','','','off','dist','','192.168.50.2','ip','','',137.000,0,'on','on','','',1836.00000000,'Piwnica','','','','ok','',2,'1','382',240,'','','off','off','60','off','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',0),(58,'2021-06-15 15:07:20',4.090,'Akumulator_V','ip_meteo_id18_volt','','','off','volt','','192.168.50.3','ip','','',4.080,0,'on','','','',885141.61000000,'Pozostałe','','','','ok','',3,'2.46','4.18',36,'','','off','off','60','off','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.0','0.0','','','','',60,'','','','on','off',2),(60,'2021-06-15 15:05:01',1623724098.000,'Sunrise','sunrise_336','','','','sunrise','','','virtual','','',1623724098.000,0,'off','','','off',0.00000000,'Pozostałe','','','','ok','',3,'1546843321','1623724098',47,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','off','','off','1','','','','','','','','','','',60,'','','','on','off',1),(61,'2021-06-15 15:05:01',1623783633.000,'Sunset','sunset_3','','','','sunset','','','virtual','','',1623783633.000,0,'off','','','off',0.00000000,'Pozostałe','','','','ok','',3,'1546873104','1623783633',48,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','off','','off','1','','','','','','','','','','',60,'','','','on','off',1),(62,'2021-06-15 15:07:18',8.680,'Tytus_1','host_Portal','','','','host','','89.25.182.54','ip','','',7.320,0,'on','','','',0.00000000,'Hosty','','','','ok','',7,'3.53','1422',1,'','','','','','','','','','','','','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','off',1),(63,'2021-06-15 15:07:18',15.600,'Tytus_2','host_Tytus2','','','','host','','tytus2.robelit.pl','ip','','',15.500,0,'on','','','',0.00000000,'Hosty','','','','ok','',7,'13.7','277',1,'','','','','','','','','','','','','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','off',1),(64,'2021-06-15 15:07:19',16.000,'CK_1_188.95.27.58','host_CK_1','','','','host','','188.95.27.58','ip','','',15.800,0,'on','','','',0.00000000,'Hosty','','','','ok','',7,'5.17','2962',1,'','','','','','','','','','','','','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','off',1),(65,'2021-06-15 15:07:19',8.820,'CK_2_178.19.103.179','host_CK_2','','','','host','','178.19.103.179','ip','','',8.140,0,'on','','','',0.00000000,'Hosty','','','','ok','',7,'2.82','1516',1,'','','','','','','','','','','','','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','off',1),(66,'2021-06-15 15:07:19',19.700,'CP_1_188.164.243.230','host_CP_1','','','','host','','188.164.243.230','ip','','',19.300,0,'on','','','',0.00000000,'Hosty','','','','ok','',7,'5.20','1699',1,'','','','','','','','','','','','','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','off',1),(67,'2021-06-15 15:07:19',26.600,'CP_2_	79.190.133.138','host_CP_2','','','','host','','79.190.133.138','ip','','',28.400,0,'on','','','',0.00000000,'Hosty','','','','ok','',7,'19.7','1573',1,'','','','','','','','','','','','','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','off',1),(79,'2021-06-15 15:05:04',12.000,'Powietrze','airquality_664','','','','airquality','','','virtual','','',12.000,0,'on','','','',0.00000000,'Parter','','','','ok','',1,'5','125',155,'','','on','on','','','','','','','50.76197','19.06242','KretbNKRLLMGUkjMo8dqGyE4kWXFv6ac','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','off',0),(80,'2021-06-15 15:07:02',1.000,'S1','domo_al_s1','','','','trigger','','192.168.50.2','ip','','',1.000,0,'on','','','',8028.00000000,'Pozostałe','','','','ok','',3,'1','1',50,'','','off','off','','','Off','On','label-danger','label-info','50.7026','19.0298','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','off',1),(81,'2021-06-15 15:07:02',1.000,'S2','domo_al_s2','','','','trigger','','192.168.50.2','ip','','',1.000,0,'on','','','',16221.00000000,'Pozostałe','','','','ok','',3,'1','1',51,'','','off','off','','','Off','On','label-danger','label-info','50.7026','19.0298','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','off',1),(82,'2021-06-15 15:07:18',0.000,'Deszcz','ip_meteo_id1_rainfall','','','','rainfall','','192.168.50.3','ip','','',0.000,0,'on','','','',0.30000000,'Parter','','','','ok','',1,'0','6.7',149,'','','on','off','','','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','off',1),(83,'2021-06-15 15:07:18',360.000,'Wiatr-kierunek','ip_meteo_id3_wind','','','','wind','','192.168.50.3','ip','','',45.000,0,'on','','','',342427.00000000,'Parter','','','','ok','',1,'22','360',148,'','','on','off','','','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','off',0),(84,'2021-06-15 15:06:28',0.000,'Deszcz_24h','rain24','','','','rainfall','','','virtual','','',0.000,0,'off','on','','',0.00000000,'Statystyki','','','','ok','',8,'0','26.9',666,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',1),(85,'2021-06-15 15:06:28',0.300,'Deszcz_suma','rainlastsum','','','','rainfallsum','','','virtual','','',0.300,0,'off','','','',0.00000000,'Statystyki','','','','ok','',8,'0.3','26.9',672,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','off','off',1),(86,'2021-06-15 15:06:28',3.300,'Deszcz_72h','rain72','','','','rainfall','','','virtual','','',3.300,0,'off','on','','',0.00000000,'Statystyki','','','','ok','',8,'0.3','26.9',670,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',1),(87,'2021-06-15 15:06:28',0.000,'Deszcz_48h','rain48','','','','rainfall','','','virtual','','',0.000,0,'off','on','','',0.00000000,'Statystyki','','','','ok','',8,'0','26.9',668,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',1),(88,'2021-06-15 15:07:23',0.060,'Export','usb_ttyUSB0a1EXP_elec','','','','elec','','','usb','','',0.060,0,'on','','','',8021.08000000,'elec','','-3391.29','','ok','/dev/ttyUSB0',1,'0.03','6.13',991,'','','on','off','','','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','0.61','2.1','','','','',60,'','','','on','on',1),(89,'2021-06-15 15:07:23',0.000,'Import','usb_ttyUSB0a1_elec','','','','elec','','','usb','on','',0.000,0,'on','','','',7566.34000000,'elec','','-3391.29','','ok','/dev/ttyUSB0',1,'0','1.08',990,'','','on','off','','','','','','','50.7026','19.0298','','','','','','','off','','off','','on','173','','','0.60','2','','','','',60,'','','','on','on',1),(90,'2021-06-15 15:07:22',247.570,'L1','usb_ttyUSB0L1a1_volt','','','','volt','','','usb','','',242.070,0,'on','','','light',0.00000000,'Licznik','','','','ok','/dev/ttyUSB0',9,'195.35','264.35',950,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',0),(91,'2021-06-15 15:07:22',-1245.500,'L3_','usb_ttyUSB0L3a1_watt','','','','watt','','','usb','','',-1321.070,0,'on','','','',0.00000000,'Licznik','','','','ok','/dev/ttyUSB0',9,'-2054.07','4507.59',966,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',0),(92,'2021-06-15 15:07:22',4.920,'L3__','usb_ttyUSB0L3a1_amps','','','','amps','','','usb','','',5.250,0,'on','','','',0.00000000,'Licznik','','','','ok','/dev/ttyUSB0',9,'0.2','23.18',960,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',2),(93,'2021-06-15 15:07:22',253.110,'L3','usb_ttyUSB0L3a1_volt','','','','volt','','','usb','','',251.810,0,'on','','','light',0.00000000,'Licznik','','','','ok','/dev/ttyUSB0',9,'206.66','264.74',954,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',0),(94,'2021-06-15 15:07:22',-1124.900,'L2_','usb_ttyUSB0L2a1_watt','','','','watt','','','usb','','',-1208.190,0,'on','','','',0.00000000,'Licznik','','','','ok','/dev/ttyUSB0',9,'-2028.15','4300.64',964,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',0),(95,'2021-06-15 15:07:22',5.000,'L2__','usb_ttyUSB0L2a1_amps','','','','amps','','','usb','','',5.340,0,'on','','','',0.00000000,'Licznik','','','','ok','/dev/ttyUSB0',9,'0.14','23.12',958,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',2),(96,'2021-06-15 15:07:22',224.870,'L2','usb_ttyUSB0L2a1_volt','','','','volt','','','usb','','',226.130,0,'on','','','light',0.00000000,'Licznik','','','','ok','/dev/ttyUSB0',9,'191.09','264.67',952,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',0),(97,'2021-06-15 15:07:22',-1020.890,'L1_','usb_ttyUSB0L1a1_watt','','','','watt','','','usb','','',-1072.070,0,'on','','','',0.00000000,'Licznik','','','','ok','/dev/ttyUSB0',9,'-2089.86','3623.81',962,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',0),(98,'2021-06-15 15:07:22',4.130,'L1__','usb_ttyUSB0L1a1_amps','','','','amps','','','usb','','',4.440,0,'on','','','',0.00000000,'Licznik','','','','ok','/dev/ttyUSB0',9,'0.05','18.33',956,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',2),(99,'2021-06-15 15:06:29',-1083.924,'Do_zużycia','kwhtouse','','','','kwhtouse','','','virtual','','',-1083.972,0,'on','','','',0.00000000,'Pozostałe','','','','ok','',3,'-6033.63','911.62',52,'','','on','off','','','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','off',1),(108,'2021-06-15 15:06:29',-3475.030,'Pobór','current_elec','','','','watt','','','virtual','','',-3601.330,0,'on','','','',0.00000000,'Pozostałe','','','','ok','',3,'-5804.91','9304.6',61,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','off',0),(113,'2021-06-15 15:05:05',213.850,'Dysk','freespace_516','','','','freespace','','','virtual','','',213.850,0,'on','','','',0.00000000,'Testy','','','','ok','',20,'20.82','213.9',1,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','/','on','off',1),(114,'2021-05-14 14:53:30',24.100,'Kominek_','ip_mqtt_Kominek_temp_Temperatura','','','','temp','','192.168.50.55','ip_mqtt','','',24.100,0,'on','','','',0.00000000,'Pozostałe','','','','ok','',3,'16.4','45.6',46,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','off',1),(115,'2021-05-11 03:02:07',1.000,'Ledy_HOME','ip_mqtt_Kominek_gpio_12_Ledy','','','','gpio','12','192.168.50.55','ip_mqtt','','',1.000,0,'on','','','',0.00000000,'gpio','','','','ok','',1,'1','1',1,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','off','','on','','','','','','','','','','','',60,'','','','on','off',1),(126,'2021-06-15 15:06:26',0.000,'PV_Status','inv_Zeversolar_status','','','','trigger','','192.168.50.8','ip','','',0.000,0,'on','','','',0.00000000,'Pozostałe','','','','on','',3,'','',60,'','','off','off','','','Sleep','Working','label-danger','label-info','50.7026','19.0298','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','off',1),(127,'2021-06-15 07:04:23',0.600,'PV_Day','inv_Zeversolar_day','','','','kwatt','','192.168.50.8','ip','','',0.500,0,'on','','','',0.00000000,'Pozostałe','','','','ok','',3,'0.1','43.3',57,'','','on','on','','','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','on',1),(128,'2021-06-15 15:06:27',0.000,'PV_Peak','inv_Zeversolar_pac','','','','watt','','192.168.50.8','ip','','',0.000,0,'on','','','',0.00000000,'Pozostałe','','','','ok','',3,'0','6061',58,'','','on','on','','','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','on',0),(129,'2021-06-15 15:06:31',10852.800,'PV_Total','inv_Zeversolar_total','','','','kwatt','','192.168.50.8','ip','','',10852.800,0,'on','','','',0.00000000,'Pozostałe','','','','ok','',3,'248.86','10852.8',59,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','','','','','','',60,'','','','off','off',0),(130,'2021-06-12 23:26:12',0.000,'Lampa_Brama','ip_mqtt_ESP_Brama_gpio_12_BramaPK','','','','gpio','12','192.168.50.61','ip_mqtt','','',1.000,0,'on','','','',0.00000000,'gpio','','','','ok','',1,'0','1',1,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','off','','on','','','','','','','','','','','',60,'','','','on','off',1),(131,'2021-04-30 21:08:21',0.000,'8255','shellyrgbw2-661BCA','','','','shellyrgbw2','','','mqtt','','',0.000,0,'on','','','',0.00000000,'Testy','','','','ok','',20,'0','1',1,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',1),(144,'2021-06-15 15:07:05',0.000,'Ogród','remote_NTOgrod_gpio_17','','','','water','','','ip','','',0.000,0,'on','','','',688.07200000,'water','','0','','ok','',1,'0','0.044',992,'','','on','off','','','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','4.42','','','','','',60,'','','','on','off',1),(145,'2021-06-15 15:06:29',42.500,'Deszcz_-_rok','rainyear','','','','rainfall','','','virtual','','',42.500,0,'on','','','',0.00000000,'Statystyki','','','','ok','',8,'0.8','171.8',674,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','off','off',1),(146,'2021-06-15 15:06:29',4.800,'Deszcz_-_miesiąc','rainmonth','','','','rainfall','','','virtual','','',4.800,0,'on','','','',0.00000000,'Statystyki','','','','ok','',8,'0.3','38.3',673,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','off','off',1),(147,'2021-06-15 15:07:20',0.470,'Rpi_Ogrod','host_Rpi_Ogrod','','','','host','','192.168.50.250','ip','','',0.450,0,'on','','','',0.00000000,'Hosty','','','','ok','',7,'0.30','209',1,'','','','','','','','','','','','','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','',1),(149,'2021-06-15 15:07:13',0.000,'Waty','shelly1pm-A4CF12F3CEFB_watt','','','','watt','','','mqtt','','',0.000,0,'on','','','',0.00000000,'Shelly_1PM','','','','ok','',1,'0','2266.84',1,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',1),(150,'2021-06-15 15:07:13',47.520,'Temperatura','shelly1pm-A4CF12F3CEFB_temp','','','','temp','','','mqtt','','',47.420,0,'on','','','',0.00000000,'Shelly_1PM','','','','ok','',1,'22.7','56.87',1,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',1),(151,'2021-06-15 15:07:13',0.000,'Przegrzanie','shelly1pm-A4CF12F3CEFB_trigger','','','','trigger','','','mqtt','','',0.000,0,'on','','','',0.00000000,'Shelly_1PM','','','','on','',1,'','',1,'','','off','off','','','NIE','TAK','label-success','label-danger','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',1),(152,'2021-06-15 15:07:12',1.000,'Przekaźnik','shelly1pm-A4CF12F3CEFB_gpio_0','','','','gpio','0','','mqtt','','',1.000,0,'on','','','',0.00000000,'Shelly_1PM','','','','ok','',1,'1','1',1,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',1),(153,'2021-06-15 15:07:13',0.000,'Przycisk','shelly1pm-A4CF12F3CEFB_input','','','','input','','','mqtt','','',0.000,0,'on','','','',0.00000000,'Shelly_1PM','','','','ok','',1,'0','',1,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',1),(154,'2021-06-15 15:07:13',0.250,'Suma_kWh','shelly1pm-A4CF12F3CEFB_kwatt','','','','kwatt','','','mqtt','','',0.250,0,'on','','','',0.00000000,'Shelly_1PM','','','','ok','',1,'0.02','9.39',1,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','on','','off','','','','','','','','','','','',60,'','','','on','off',2),(158,'2021-06-15 15:06:38',0.000,'Kurnik_światło','ip_mqtt_Kurnik_gpio_12_','','','','gpio','12','192.168.50.63','ip_mqtt','','',0.000,0,'on','','','',0.00000000,'Kurnik','','','','ok','',1,'0','1',1,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','off',1),(159,'2021-06-15 15:06:38',1.000,'Kurnik_drzwi','ip_mqtt_Kurnik_gpio_13_','','','','gpio','13','192.168.50.63','ip_mqtt','','',1.000,0,'on','','','',0.00000000,'Kurnik','','','','ok','',1,'1','1',1,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','off',1),(161,'2021-06-15 15:06:50',28.310,'Kurnik','ip_mqtt_Kurnik_temp_Kurnik_temp','','','','temp','','192.168.50.63','ip_mqtt','','',28.310,0,'on','','','',0.00000000,'Kurnik','','','','ok','',1,'10.13','31.13',1,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','off','','off','','','','','','','','','','','',60,'','','','on','off',1),(162,'2021-06-15 15:07:03',0.000,'NT_Ogród','gpio_17','','','','gpio','17','','gpio','','',0.000,0,'on','','','',0.00000000,'gpio','','','','ok','',1,'0','1',1,'','','off','off','','','','','','','50.7026','19.0298','','','','','','','off','','on','','','','','','','','','','','',60,'','','','on','off',1);
/*!40000 ALTER TABLE `sensors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `snmp`
--

DROP TABLE IF EXISTS `snmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `snmp` (
  `id` varchar(0) DEFAULT NULL,
  `name` varchar(0) DEFAULT NULL,
  `rom` varchar(0) DEFAULT NULL,
  `community` varchar(0) DEFAULT NULL,
  `host` varchar(0) DEFAULT NULL,
  `oid` varchar(0) DEFAULT NULL,
  `divider` varchar(0) DEFAULT NULL,
  `type` varchar(0) DEFAULT NULL,
  `version` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `snmp`
--

LOCK TABLES `snmp` WRITE;
/*!40000 ALTER TABLE `snmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `snmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statistics`
--

DROP TABLE IF EXISTS `statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statistics` (
  `id` tinyint(4) DEFAULT NULL,
  `agreement` varchar(3) DEFAULT NULL,
  `nick` varchar(0) DEFAULT NULL,
  `location` varchar(0) DEFAULT NULL,
  `sensor_temp` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statistics`
--

LOCK TABLES `statistics` WRITE;
/*!40000 ALTER TABLE `statistics` DISABLE KEYS */;
INSERT INTO `statistics` VALUES (1,'yes','','','');
/*!40000 ALTER TABLE `statistics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statusorder`
--

DROP TABLE IF EXISTS `statusorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statusorder` (
  `id` tinyint(4) DEFAULT NULL,
  `position` tinyint(4) DEFAULT NULL,
  `modulename` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statusorder`
--

LOCK TABLES `statusorder` WRITE;
/*!40000 ALTER TABLE `statusorder` DISABLE KEYS */;
INSERT INTO `statusorder` VALUES (1,1,'Sensors'),(2,4,'MinMax'),(3,3,'Counters'),(4,11,'Controls/GPIO'),(5,8,'Meteo'),(6,5,'IP Cam'),(7,6,'UPS'),(8,7,'Widget'),(9,2,'Just Gage');
/*!40000 ALTER TABLE `statusorder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thingspeak`
--

DROP TABLE IF EXISTS `thingspeak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thingspeak` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(3) DEFAULT NULL,
  `apikey` varchar(16) DEFAULT NULL,
  `f1` varchar(17) DEFAULT NULL,
  `f2` varchar(10) DEFAULT NULL,
  `f3` varchar(18) DEFAULT NULL,
  `f4` varchar(18) DEFAULT NULL,
  `f5` varchar(9) DEFAULT NULL,
  `f6` varchar(11) DEFAULT NULL,
  `f7` varchar(3) DEFAULT NULL,
  `f8` varchar(3) DEFAULT NULL,
  `active` varchar(2) DEFAULT NULL,
  `interval` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thingspeak`
--

LOCK TABLES `thingspeak` WRITE;
/*!40000 ALTER TABLE `thingspeak` DISABLE KEYS */;
INSERT INTO `thingspeak` VALUES (1,'NT1','SN9OKJ3JX1M1W3AK','ip_meteo_id9_temp','domo_Salon','domo_Wilgotnosc','airquality_664','domo_Piec','domo_Bojler','off','off','on',5),(2,'NT2','WA7DSMQV0RH5K9JS','domo_Jas','domo_Zosia','inv_Zeversolar_day','inv_Zeversolar_pac','off','off','off','off','on',10);
/*!40000 ALTER TABLE `thingspeak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types` (
  `id` tinyint(4) DEFAULT NULL,
  `type` varchar(11) DEFAULT NULL,
  `unit` varchar(6) DEFAULT NULL,
  `unit2` varchar(8) DEFAULT NULL,
  `ico` varchar(35) DEFAULT NULL,
  `title` varchar(15) DEFAULT NULL,
  `min` varchar(8) DEFAULT NULL,
  `max` varchar(10) DEFAULT NULL,
  `value1` varchar(2) DEFAULT NULL,
  `value2` varchar(3) DEFAULT NULL,
  `value3` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'temp','°C','°F','media/ico/temp2-icon.png','Temperature','-150','3000','85','185','127.9'),(2,'lux','lux','lux','media/ico/sun-icon.png','Lux','0','100000','','',''),(3,'humid','%','%','media/ico/rain-icon.png','Humidity','0','110','','',''),(4,'press','hPa','hPa','media/ico/Science-Pressure-icon.png','Pressure','0','10000','','',''),(5,'water','m3','litres/h','media/ico/water-icon.png','Water','0','10000','','',''),(6,'gas','m3','litres/h','media/ico/gas-icon.png','Gas','0','100','','',''),(7,'elec','kWh','Wh','media/ico/Lamp-icon.png','Electricity','0','99999999','','',''),(8,'watt','W','W','media/ico/watt.png','Watt','-10000','10000','','',''),(9,'volt','V','V','media/ico/volt.png','Volt','-10000','10000','','',''),(10,'amps','A','A','media/ico/amper.png','Amps','0','10000','','',''),(11,'dist','cm','cm','media/ico/Distance-icon.png','Distance','0','250','','',''),(12,'trigger','','','media/ico/alarm-icon.png','Trigger','0','100000','','',''),(13,'rainfall','l/m2','l/m2','media/ico/showers.png','Rainfall','0','10000','','',''),(14,'speed','km/h','km/h','media/ico/Wind-Flag-Storm-icon.png','Speed','0','10000','','',''),(15,'wind','°','°','media/ico/compass.png','Wind','0','10000','','',''),(16,'uv','index','index','','UV','0','10000','','',''),(17,'storm','km','km','media/ico/storm-icon.png','Storm','0','10000','','',''),(18,'lightining','','','media/ico/thunder-icon.png','Lightining','0','10000','','',''),(19,'host','ms','ms','media/ico/Computer-icon.png','Host','0','10000','','',''),(20,'gpio','H/L','','media/ico/gpio2.png','GPIO','-1000','1000','','',''),(21,'group','','','','','','','','',''),(22,'relay','H/L','','media/ico/Switch-icon.png','Relay','-1000','1000','','',''),(23,'battery','%','','media/ico/Battery-icon.png','Battery','0','100','','',''),(24,'rssi','rssi','','media/ico/wifi-icon.png','RSSI','-1000','1000','','',''),(25,'switch','H/L','','media/ico/Switch-icon.png','Switch','-1000','1000','','',''),(26,'gust','km/h','','media/ico/gust.png','Gust','0','255','','',''),(27,'dust','μg/m^3','','media/ico/Weather-Dust-icon.png','Dust','-4000','4000','','',''),(28,'max24','','','media/ico/max-icon.png','Max 24','0','10000','','',''),(29,'maxweek','','','media/ico/max-icon.png','Max Week','0','10000','','',''),(30,'maxmonth','','','media/ico/max-icon.png','Max Month','0','10000','','',''),(31,'sunrise','','','media/ico/sunrise-icon.png','Sunrise','0','-727379968','','',''),(32,'sunset','','','media/ico/sunset-icon.png','Sunset','0','-727379968','','',''),(33,'airquality','CAQI','CAQI','media/ico/airly.png','Air Quality','0','1000','','',''),(34,'air_pm_25','μg/m3','μg/m3','media/ico/airly.png','PM 2.5','0','1000','','',''),(35,'air_pm_10','μg/m3','μg/m3','media/ico/airly.png','PM 10','0','1000','','',''),(36,'min24','','','media/ico/min-icon.png','Min 24','-10000','10000','','',''),(37,'minweek','','','media/ico/min-icon.png','Min Week','-10000','10000','','',''),(38,'minmonth','','','media/ico/min-icon.png','Min Month','-10000','10000','','',''),(40,'Relay','a','a','media/ico/switch-icon.png','Relay','-100','100','','',''),(41,'rainfallsum','l/m2','l/m2','media/ico/showers.png','Rainfall','0','10000','','',''),(42,'kwhtouse','kWh','kWh','media/ico/lightning-icon.png','kWh to use','-10000','99999999','','',''),(43,'kwatt','kWh','kWh','media/ico/watt.png','kWh','-10000','99999999','','',''),(44,'elecesp','kWh','W','media/ico/Lamp-icon.png','Electricity','0','99999999','','',''),(45,'dewpoint','°C','°F','media/ico/Dewpoint-icon.png','Temperature','-1000','1000','','',''),(46,'cpuusage','%','%','media/ico/processor-icon.png','CPU Usage','0','100','','',''),(47,'memoryusage','%','%','media/ico/ram-icon.png','Memory Usage','0','100','','',''),(48,'freespace','GB','GB','media/ico/disc-icon.png','Free disk space','0','1000000','','',''),(49,'frequency','Hz','kHz','media/ico/freq-icon.png','Frequency','0','1000000','','',''),(50,'shellyrgbw2','S','S','media/ico/1wire.png','State','0','1','','',''),(51,'varh','kvarh','kvarh','media/ico/varh-icon.png','Reactive Energy','0','1000000','','',''),(52,'va','VA','VA','media/ico/va-icon.png','Apparent Power','-100000','1000000','','',''),(53,'var','var','var','media/ico/var-icon.png','Reactive Power','-1000000','1000000','','',''),(54,'cosfi','','','media/ico/cosfi-icon.png','Cosfi','0','100','','',''),(55,'ph','','','media/ico/ph-icon.png','pH','0','100','','',''),(56,'input','H/L','H/L','media/ico/switch-icon.png','Input','0','1','','','');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usb`
--

DROP TABLE IF EXISTS `usb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usb` (
  `id` tinyint(4) DEFAULT NULL,
  `dev` varchar(12) DEFAULT NULL,
  `device` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usb`
--

LOCK TABLES `usb` WRITE;
/*!40000 ALTER TABLE `usb` DISABLE KEYS */;
INSERT INTO `usb` VALUES (1,'none','1wire Serial'),(2,'none','1wire'),(3,'none','Modem Call'),(4,'none','Modem SMS'),(5,'/dev/ttyUSB0','RS485'),(6,'none','PiUPS'),(7,'none','SDS011');
/*!40000 ALTER TABLE `usb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` tinyint(4) DEFAULT NULL,
  `login` varchar(5) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `perms` varchar(3) DEFAULT NULL,
  `tel` bigint(20) DEFAULT NULL,
  `mail` varchar(19) DEFAULT NULL,
  `smsa` varchar(3) DEFAULT NULL,
  `maila` varchar(3) DEFAULT NULL,
  `adm` varchar(0) DEFAULT NULL,
  `ctr` varchar(3) DEFAULT NULL,
  `simple` varchar(3) DEFAULT NULL,
  `trigger` varchar(3) DEFAULT NULL,
  `moment` varchar(3) DEFAULT NULL,
  `cam` varchar(3) DEFAULT NULL,
  `at` varchar(3) DEFAULT NULL,
  `smspin` varchar(0) DEFAULT NULL,
  `smsts` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','74cc2df550a034896b4c4186b79ed59f7ae19bc2','adm',48603526744,'mmusik123@gmail.com','yes','yes','','','OFF','','OFF','yes','','',''),(2,'magda','4d5409e9a6db40430407517c9338529606db90e3','usr',48696451520,'','','','','OFF','OFF','OFF','OFF','','any','','');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `version`
--

DROP TABLE IF EXISTS `version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `version` (
  `db_ver` varchar(0) DEFAULT NULL,
  `lastupdate` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `version`
--

LOCK TABLES `version` WRITE;
/*!40000 ALTER TABLE `version` DISABLE KEYS */;
INSERT INTO `version` VALUES ('','');
/*!40000 ALTER TABLE `version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `virtual`
--

DROP TABLE IF EXISTS `virtual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `virtual` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(17) DEFAULT NULL,
  `rom` varchar(9) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `device` varchar(7) DEFAULT NULL,
  `lati` varchar(0) DEFAULT NULL,
  `long` varchar(0) DEFAULT NULL,
  `active` varchar(0) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `virtual`
--

LOCK TABLES `virtual` WRITE;
/*!40000 ALTER TABLE `virtual` DISABLE KEYS */;
INSERT INTO `virtual` VALUES (1,'Air_quality','Airly','airquality','virtual','','','','For api settings please visit https://airly.eu/pl/'),(2,'Air_quality_PM2.5','Airly25','air_pm_25','virtual','','','','For api settings please visit https://airly.eu/pl/'),(3,'Air_quality_PM10','Airly10','air_pm_10','virtual','','','','For api settings please visit https://airly.eu/pl/'),(4,'Max24','max24','max24','virtual','','','','Max value - 24H'),(5,'MaxWeek','maxweek','maxweek','virtual','','','','Max value - week'),(6,'MaxMonth','maxmonth','maxmonth','virtual','','','','Max value - month'),(7,'Min24','min24','min24','virtual','','','','Min value - 24H'),(8,'MinWeek','minweek','minweek','virtual','','','','Min value - week'),(9,'MinMonth','minmonth','minmonth','virtual','','','','Min value - month'),(10,'Sunrise','sunrise','sunrise','virtual','','','','Time of sunrise for a given location'),(11,'Sunset','sunset','sunset','virtual','','','','Time of sunset for a given location'),(12,'Min24','min24','min24','virtual','','','','Min value - 24H'),(13,'MinWeek','minweek','minweek','virtual','','','','Min value - week'),(14,'MinMonth','minmonth','minmonth','virtual','','','','Min value - month'),(15,'DewPoint','dewpoint','dewpoint','virtual','','','','Dew Point'),(16,'Free Space','freespace','freespace','virtual','','','','Free disk space');
/*!40000 ALTER TABLE `virtual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vpn`
--

DROP TABLE IF EXISTS `vpn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vpn` (
  `id` varchar(0) DEFAULT NULL,
  `users` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vpn`
--

LOCK TABLES `vpn` WRITE;
/*!40000 ALTER TABLE `vpn` DISABLE KEYS */;
/*!40000 ALTER TABLE `vpn` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-22 15:20:35
