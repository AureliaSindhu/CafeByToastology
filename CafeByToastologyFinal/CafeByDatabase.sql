-- MySQL dump 10.13  Distrib 8.0.36, for macos14 (x86_64)
--
-- Host: 127.0.0.1    Database: cafeDatabse
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin','618dcdfb0cd9ae4481164961c4796dd8e3930c8d'),(2,'test','7110eda4d09e062aa5e4a390b0a572ac0d2c0220');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (1,3,2,'Mushroom Tartar Toast',6,5,''),(3,5,2,'Mushroom Tartar Toast',6,1,''),(6,5,1,'Benedict Egg and Avocado Toast',6,1,''),(7,5,2,'Mushroom Tartar Toast',6,3,''),(8,5,3,'Sausage and Egg Toast',6,1,''),(9,5,1,'Benedict Egg and Avocado Toast',6,1,''),(10,1,3,'Sausage and Egg Toast',6,1,''),(11,1,3,'Sausage and Egg Toast',6,1,''),(12,1,6,'Broccoli and Hummus Toast',5,1,''),(17,1,8,'Cinnamon Butter Toast',5,1,''),(18,1,5,'Banana Peanut Butter Toast',7,1,''),(19,1,7,'S\'mores Toast',7,1,''),(20,1,7,'S\'mores Toast',7,1,''),(21,5,18,'Strawberry Cream Cheese Toast',11,1,''),(23,10,2,'Mushroom Tartar Toast',6,1,''),(24,10,5,'Banana Peanut Butter Toast',7,1,''),(25,10,7,'S\'mores Toast',7,1,'');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) DEFAULT NULL,
  `categories` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,1,'breakfast'),(2,2,'dessert');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,1,'asd','asdd@gmail.com','123','asdfaf'),(2,1,'qewr','test@gmail.com','123','qerw'),(3,1,'xx','adsf@dsf','123','adsrf'),(4,1,'fasd','fdsa1@fda','1234','drfa'),(5,1,'jake','jake@bighit.ent','876','fsdg'),(6,3,'jake','jake@bighit.ent','9678','okaii'),(7,3,'xx','afsd@fds','123','fsdg');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,4,'Wonwoo','9095677855','wonwoo@bighit.ent','credit card','flat no. BigHit, 1290, Seoul, Seoul, South Korea - 1234','Benedict Egg and Avocado Toast (6 x 1) - Mushroom Tartar Toast (6 x 1) - ',12,'2024-06-09','pending');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_1` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Benedict Egg and Avocado Toast','Indulge in our signature Benedict Egg and Avocado Toast, a harmonious blend of flavors and textures. Freshly toasted sourdough bread is topped with a perfectly poached egg, crispy bacon, and creamy avocado slices. Finished with a sprinkle of red pepper flakes and a drizzle of zesty lemon aioli, this toast is a brunch lover&#39;s dream come true.',6,'1.PNG'),(2,'Mushroom Tartar Toast','Indulge in the earthy flavors of our Mushroom Tartar Toast, a harmonious blend of sautéed wild mushrooms, tangy tartar sauce, and fresh herbs on toasted sourdough bread. Each bite transports you to a forest floor, with the richness of the mushrooms balanced by the brightness of the tartar sauce. Finished with a sprinkle of microgreens and a drizzle of truffle oil, this toast is a true umami delight.',6,'2.PNG'),(3,'Sausage and Egg Toast','Start your day off right with our savory Sausage and Egg Toast! Crispy, golden-brown sausage patties are perfectly paired with a fried egg, its runny yolk adding a rich and creamy element to each bite. All atop a toasted slice of our freshly baked bread, this satisfying breakfast combo is sure to fuel your morning.',6,'3.PNG'),(4,'Tuna Salad Toast','Dive into the freshness of our Tuna Salad Toast! Made with sustainably-sourced tuna, mixed with a hint of mayonnaise, and infused with a squeeze of lemon juice, our tuna salad is a perfect blend of protein and flavor. Served atop a crispy slice of whole grain bread, and finished with a sprinkle of chopped onions and a dash of parsley, this toast is a delicious and healthy twist on a classic favorite.',5,'4.PNG'),(5,'Banana Peanut Butter Toast','Indulge in the classic combination of banana and peanut butter with our Banana Peanut Butter Toast! Spread a generous layer of creamy peanut butter on a slice of toasted bread, then top it off with freshly sliced banana coins. This sweet and satisfying breakfast or snack is a perfect way to start your day or refuel your energy levels. Enjoy it as is, or sprinkle some cinnamon or honey for an extra touch of flavor.',7,'5.PNG'),(6,'Broccoli and Hummus Toast','Get your daily dose of greens with our Broccoli and Hummus Toast! Crunchy broccoli florets meet creamy hummus on toasted bread, creating a delightful contrast of textures and flavors. The earthy sweetness of broccoli pairs perfectly with the tangy, savory hummus, making for a satisfying and healthy snack or light lunch. Enjoy it as a guilt-free indulgence, packed with nutrients and flavor!',5,'6.PNG'),(7,'S&#39;mores Toast','Indulge in the classic campfire treat, reimagined as a decadent toast! Our S&#39;mores Toast is a sweet and gooey masterpiece, featuring rich chocolate spread, toasted marshmallows, and crunchy graham cracker crumbs all on top of a crispy baguette slice. It&#39;s a nostalgic delight that will transport you back to summertime adventures and cozy campfires. So why wait? Gather &#39;round and get ready to make some unforgettable memories with every bite of our S&#39;mores Toast!',7,'9.PNG'),(8,'Cinnamon Butter Toast','Indulge in the warm, comforting flavors of our Cinnamon Butter Toast! Freshly baked bread is generously slathered with a rich, creamy cinnamon butter that will transport you to a cozy morning moment. The sweetness of the cinnamon perfectly balances the savory notes of the butter, creating a delightful harmony of flavors that will leave you craving more. Whether you&#39;re in the mood for a sweet treat or a satisfying snack, our Cinnamon Butter Toast is the perfect companion to your day.',5,'7.PNG'),(10,'Tomato Avocado Toast','Indulge in the warm, comforting flavors of our Cinnamon Butter Toast! Freshly baked bread is generously slathered with a rich, creamy cinnamon butter that will transport you to a cozy morning moment. The sweetness of the cinnamon perfectly balances the savory notes of the butter, creating a delightful harmony of flavors that will leave you craving more. Whether you&#39;re in the mood for a sweet treat or a satisfying snack, our Cinnamon Butter Toast is the perfect companion to your day.',8,'8.PNG'),(11,'Garlic Butter Toast','Indulge in the rich, savory flavors of our Garlic Butter Toast, perfectly crafted to satisfy your cravings. Freshly baked bread is generously slathered with a decadent garlic butter spread, infused with the pungency of roasted garlic and the creaminess of melted butter. Each bite transports you to a world of comfort and delight, with the aromatic flavors of garlic mingling with the subtle sweetness of the bread. ',4,'10.PNG'),(12,'Nutella Toast','Indulge in the ultimate comfort food with our delectable Nutella Toast. This heavenly creation starts with a slice of perfectly toasted artisan bread, golden and crispy on the outside, yet soft and fluffy on the inside. Generously slathered with a rich layer of creamy Nutella, each bite offers the perfect balance of sweetness and texture. The velvety hazelnut spread melts into the warm toast, creating a mouthwatering experience that’s both nostalgic and satisfying.',9,'12.PNG'),(13,'PB&J Toast','Indulge in the nostalgic charm of our Classic PB&J Toast, a timeless treat that&#39;s sure to bring a smile to your face. Freshly toasted bread is generously slathered with a rich, creamy peanut butter and paired with a sweet and tangy grape jelly. The perfect harmony of flavors and textures, our PB&J toast is a comforting reminder of childhood simplicity. Whether you&#39;re in the mood for a quick breakfast, a satisfying snack, or a sweet treat, our PB&J toast is the perfect companion.',8,'14.PNG'),(18,'Strawberry Cream Cheese Toast','Savor the delightful fusion of flavors with our Strawberry Cheese Toast. This delicious creation begins with a slice of perfectly toasted artisan bread, generously spread with a smooth and creamy layer of rich cream cheese. Adorned with a vibrant strawberry compote made from ripe, juicy strawberries, this toast offers a harmonious blend of sweet and tangy notes. ',11,'11.PNG'),(19,'Blueberry Cheese Toast','Indulge in the perfect blend of sweet and savory with our Blueberry Cheese Toast. This delectable treat starts with a slice of freshly toasted artisan bread, generously spread with a rich, creamy layer of premium cream cheese. Topped with a succulent blueberry compote, made from fresh, juicy blueberries that burst with natural sweetness, this toast offers a delightful contrast of flavors and textures. ',11,'13.PNG');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'test','test@gmail.com','7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),(3,'jake','jake@bighit.ent','12748ff9b92cc2d72378167c18b7ada47e438e06'),(4,'wonwoo','wonwoo@bighit.ent','c1777d8e848654ca00348788ec9839cd0b1a0adb'),(5,'lia','lia@jyp.ent','4a5b9bbe3c6d75a323518b389606371a6af4e6e3'),(7,'winter','winter@sm.ent','8d3c3084a846396c13d9e80e3c78503c1c675e62'),(8,'lisa','lisa@yg.ent','850b36862fd1c00860ed3a968e75dc110eb9bcf6'),(10,'toastlover','toastlover@gmail.com','6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2'),(11,'admin','jake@bigh','6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xref_product_category`
--

DROP TABLE IF EXISTS `xref_product_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `xref_product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` varchar(150) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xref_product_category`
--

LOCK TABLES `xref_product_category` WRITE;
/*!40000 ALTER TABLE `xref_product_category` DISABLE KEYS */;
INSERT INTO `xref_product_category` VALUES (1,'Benedict Egg and Avocado Toast',1),(2,'Mushroom Tartar Toast',1),(3,'Sausage and Egg Toast',1),(4,'Tuna Salad Toast',1),(5,'Banana Peanut Butter Toast',1),(6,'Broccoli and Hummus Toast',1),(7,'S&#39;mores Toast',2),(8,'Cinnamon Butter Toast',1),(9,'Tomato Avocado Toast',1),(10,'Garlic Butter Toast',1),(11,'Nutella Toast',2),(12,'PB&J Toast',1),(13,'Strawberry Cream Cheese Toast',2),(14,'Blueberry Cheese Toast',2);
/*!40000 ALTER TABLE `xref_product_category` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-09 21:32:33
