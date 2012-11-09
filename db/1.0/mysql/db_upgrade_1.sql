DROP TABLE IF EXISTS `articles`;

SET @saved_cs_client     = @@character_set_client;

SET character_set_client = utf8;

CREATE TABLE `articles` (
  `id` int(11) NOT NULL auto_increment,
  `date` varchar(25) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

SET character_set_client = @saved_cs_client;

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'Dec 12, 2008','How to generate Lorem
Ipsum','Nam accumsan enim tristique urna commodo mollis. Etiam eget leo est.
Donec tincidunt quam nec nulla pulvinar sed tristique lorem tincidunt.
Pellentesque nibh lectus; suscipit sed ullamcorper sed, laoreet ut tortor. Morbi
ut ante tellus. Integer vitae felis id justo tempor adipiscing. Curabitur eget
ipsum et urna ultricies pulvinar. Fusce enim dolor, interdum eu egestas vel,
iaculis eget nisl. Aenean pretium diam accumsan quam tincidunt sit amet dictum
lorem scelerisque. In gravida ultricies aliquet. Phasellus porta erat vel augue
sodales feugiat! Pellentesque mattis malesuada ultrices. Mauris eleifend mi quis
arcu tincidunt vehicula! Nam sodales commodo lacus, et commodo metus venenatis
vel. Sed mollis molestie congue. Nulla ante leo, aliquet et convallis sed;
consequat sed turpis. Duis augue leo, adipiscing at venenatis eget, eleifend
vitae velit!
','John Squibb'),(2,'Jan 03, 1988','Using __autoload','Now in order to try out
our new library and driver setup, we have to first make some changes to the way
files
are served in our framework. Open up the router.php file located in the
controllers folder that we created in the first part of this tutorial.
If we look at our __autoload function we\'ll see the code we wrote to handle the
\'lazy loading\' of our models. Since we used the same naming convention
for our libraries and drivers, a quick modification to this code will allow us
to load those as easily.','Frank Rabbit');