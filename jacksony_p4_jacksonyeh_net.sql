-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2013 at 11:32 PM
-- Server version: 5.1.72-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jacksony_p4_jacksonyeh_net`
--

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `like_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`like_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `created`, `review_id`, `user_id`) VALUES
(12853, 1387772681, 128, 53),
(13154, 1387772957, 131, 54),
(13353, 1387772718, 133, 53),
(13653, 1387772646, 136, 53),
(13654, 1387772959, 136, 54),
(13753, 1387772659, 137, 53),
(13853, 1387772690, 138, 53),
(13953, 1387772678, 139, 53),
(14053, 1387772671, 140, 53),
(14153, 1387772668, 141, 53),
(14253, 1387772713, 142, 53),
(14254, 1387772934, 142, 54),
(14353, 1387772735, 143, 53),
(14453, 1387772642, 144, 53),
(14553, 1387772688, 145, 53),
(14554, 1387772918, 145, 54),
(14653, 1387772656, 146, 53),
(14753, 1387772705, 147, 53),
(14754, 1387772928, 147, 54),
(14853, 1387772653, 148, 53),
(14953, 1387772676, 149, 53),
(14954, 1387772911, 149, 54),
(15053, 1387772639, 150, 53),
(15054, 1387772950, 150, 54),
(15153, 1387772715, 151, 53),
(15154, 1387772998, 151, 54),
(15253, 1387772665, 152, 53),
(15254, 1387772864, 152, 54),
(15353, 1387772732, 153, 53),
(15453, 1387772700, 154, 53),
(15454, 1387772924, 154, 54),
(15653, 1387772637, 156, 53),
(15654, 1387772948, 156, 54),
(15753, 1387772767, 157, 53),
(15754, 1387772941, 157, 54),
(15853, 1387772801, 158, 53),
(15953, 1387772829, 159, 53),
(15954, 1387772908, 159, 54),
(16054, 1387772900, 160, 54),
(16154, 1387772995, 161, 54);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE IF NOT EXISTS `restaurants` (
  `restaurant_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `credit_cards` varchar(255) NOT NULL,
  `price_range` varchar(255) NOT NULL,
  `attire` varchar(255) NOT NULL,
  `groups` varchar(255) NOT NULL,
  `kids` varchar(255) NOT NULL,
  `reservations` varchar(255) NOT NULL,
  `delivery` varchar(255) NOT NULL,
  `takeout` varchar(255) NOT NULL,
  `waiter` varchar(255) NOT NULL,
  `outdoor` varchar(255) NOT NULL,
  `ambience` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `seagal_rating` int(11) NOT NULL,
  `seagal_review` text NOT NULL,
  PRIMARY KEY (`restaurant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`restaurant_id`, `created`, `modified`, `name`, `address`, `city`, `state`, `zip`, `phone`, `website`, `credit_cards`, `price_range`, `attire`, `groups`, `kids`, `reservations`, `delivery`, `takeout`, `waiter`, `outdoor`, `ambience`, `category`, `seagal_rating`, `seagal_review`) VALUES
(18, 1387767653, 1387767653, 'Peter Luger Steakhouse', '225 Northern Blvd', 'Great Neck', 'NY', '11021', '(516) 487-8800', 'peterluger.com', 'No', '$$$$', 'Casual', 'Yes', 'No', 'Yes', 'No', 'No', 'Yes', '', 'Casual', 'Steakhouses', 9, 'The Long Island branch of the famous Brooklyn institution.  Almost as good as the original, but still better than everyone else.  It brings a smile to my face.'),
(19, 1387767789, 1387767789, 'Peter Luger Steak House', '178 Broadway', 'Brooklyn', 'NY', '11211', '(718) 387-7400', 'peterluger.com', 'No', '$$$$', 'Casual', 'Yes', 'No', 'Yes', 'No', 'No', 'Yes', '', 'Casual', 'Steakouses', 10, 'The best steakhouse in the world, bar none.  It is a privilege for a cow to die here.'),
(20, 1387770376, 1387770376, 'Sparks Steak House', '210 E 46th St', 'New York', 'NY', '10017', '(212) 687-4855', 'sparkssteakhouse.com', 'Yes', '$$$$', 'Classy', 'Yes', 'No', 'Yes', 'No', 'No', 'Yes', '', 'Classy', 'Steakhouses', 8, 'The biggest claim to fame is that John Gotti put the hit on the mob boss here.  Its a shame because the steaks are pretty good here...just bring your bullet proof vest.'),
(21, 1387768129, 1387768129, 'Curry In A Hurry', '119 Lexington Ave', 'New York', 'NY', '10016', 'Curry In A Hurry', 'curryhurry.net', 'Yes', '$', 'Casual', 'Yes', 'Yes', 'No', 'Yes', 'Yes', 'Yes', '', 'Casual', 'Indian', 7, 'All my cabbie friends eat here.  This place is packed at 3 in the morning...they promise to get you in and out in a hurry.'),
(22, 1387770393, 1387770393, 'Tortas Neza', '11103 Roosevelt Ave', 'Corona', 'NY', '11368', '(718) 505-2121', '', 'No', '$', 'Casual', 'Yes', 'Yes', 'No', 'No', 'Yes', 'No', '', 'Casual', 'Mexican', 7, 'Good Mexican food when you cannot make it to Taco Bell.'),
(23, 1387768383, 1387768383, 'Lucky Cheng', '240 W 52nd St', 'New York', 'NY', '10019', '(212) 995-5500', 'luckychengsnyc.com', 'Yes', '$$$', 'Casual', 'Yes', 'No', 'No', 'No', 'No', 'Yes', '', 'Touristy', 'Asian Fusion', 8, 'This place has some of the most beautiful women.  Too bad I am celibate.'),
(24, 1387770456, 1387770456, 'Wasabi Sushi', '144 Mott St', 'Oceanside', 'NY', '11572', '(516) 766-8818', 'wasabioceanside.com', 'Yes', '$$', 'Casual', 'Yes', 'Yes', 'No', 'Yes', 'Yes', 'Yes', '', 'Casual', 'Sushi', 8, 'This place brings me back to the old days...The sushi is fresh, the sake is flowing and I am all giddy like the Glimmer Man.'),
(25, 1387770432, 1387770432, 'Umbertos Clam House', '132 Mulberry St', 'New York', 'NY', '10013', '(212) 431-7545', 'umbertosclamhouse.com', 'Yes', '$$$', 'Casual', 'Yes', 'Yes', 'Yes', 'No', 'Yes', 'Yes', '', 'Casual', 'Italian', 8, 'I found this place while filming a gangster movie in New York.  Its in Little Italy and filled with wise guys.  My picture is on the wall.  This place is Above The Law :)');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `visit_date` varchar(20) NOT NULL,
  PRIMARY KEY (`review_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=162 ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `created`, `modified`, `user_id`, `content`, `restaurant_id`, `rating`, `visit_date`) VALUES
(128, 1387768872, 1387768872, 49, 'I have to agree.  Bloody good steak.', 19, 10, '2013-11-29'),
(129, 1387768933, 1387768933, 49, 'the food is not good enough for rats!  I would never eat there again!  Only hurry is to the bathroom!', 21, 1, '2013-10-31'),
(130, 1387769002, 1387769002, 49, 'This place is just as good as Brooklyn', 18, 10, '2013-12-03'),
(131, 1387769020, 1387769020, 49, 'I go to Umberto\\''s to get one thing, and only one thing: lobster bisque. That has been the one dish that I have enjoyed throughout the Broome Street years and now into the Mulberry Street years.\\n\\nNot sure why they moved to Mulberry. Hopefully the ghost of Crazy Joe Gallo wasn\\''t haunting them at their previous location.', 25, 7, '2012-12-04'),
(132, 1387769081, 1387769081, 49, 'Bloody idiot!  Those are men!!!!!', 23, 6, '2013-12-04'),
(133, 1387769111, 1387769111, 49, 'Great food at a great price.', 22, 8, '2013-12-02'),
(134, 1387769145, 1387769145, 49, 'This is just as authentic Asian as you are Steven.', 24, 6, '2013-12-06'),
(135, 1387769198, 1387769198, 49, 'The steaks were so good that I forgot to wear the vest :)', 20, 9, '2013-12-10'),
(136, 1387769289, 1387769289, 50, 'This is just like the stuff my mom makes!', 25, 10, '2013-12-07'),
(137, 1387769342, 1387769342, 50, 'A little spicy, but I got a lot of attention from the cabbies :)', 21, 7, '2013-11-02'),
(138, 1387769385, 1387769385, 50, 'almost as good as Brooklyn.  ', 18, 9, '2013-12-04'),
(139, 1387769414, 1387769414, 50, 'this place is the bomb!', 19, 10, '2013-12-01'),
(140, 1387769489, 1387769489, 50, 'I absolutely loved the revenue. The drag queens were flawless and totally on point, it was an incredible time and I must commend those ladies on being on their A game!', 23, 9, '2013-12-05'),
(141, 1387769593, 1387769593, 51, 'OMG!  Those are men!!!  I lost my appetite', 23, 2, '2013-12-07'),
(142, 1387769634, 1387769634, 51, 'I was not impressed.', 22, 5, '2013-12-06'),
(143, 1387769684, 1387769684, 51, 'This was excellent Asian food.  Do those iron chefs work here?', 24, 7, '2013-12-11'),
(144, 1387769719, 1387769719, 51, 'I tried to get a job as a cook here.  They told me that they would call me back.', 25, 6, '2013-12-12'),
(145, 1387769765, 1387769765, 51, 'I do not know what all the fuss is about.  I can cook better meat...', 18, 6, '2013-12-11'),
(146, 1387769795, 1387769795, 51, 'I would not touch that stuff.', 21, 2, '2013-11-09'),
(147, 1387769828, 1387769828, 51, 'I felt right at home.', 20, 10, '2013-12-22'),
(148, 1387769961, 1387769961, 52, 'Great spices served fast.  Great for people in a hurry!', 21, 7, '2013-12-01'),
(149, 1387770009, 1387770009, 52, 'I would have given them a 10, but they would not me in the kitchen! ', 19, 9, '2013-12-05'),
(150, 1387770056, 1387770056, 52, 'Food has gone downhill.  I will buy this place and turn it around!', 25, 6, '2012-12-09'),
(151, 1387770093, 1387770093, 52, 'so so Mexican.', 22, 6, '2013-12-22'),
(152, 1387770122, 1387770122, 52, 'I love this place!!!', 23, 10, '2013-12-12'),
(153, 1387770157, 1387770157, 52, 'got food poisoning. nuff said.', 24, 1, '2013-12-14'),
(154, 1387770182, 1387770182, 52, 'got food poisoning. nuff said.', 20, 5, '2013-12-14'),
(156, 1387772632, 1387772632, 53, 'this place is better than most of the places I have been eating in the last 10 years.', 25, 8, '2013-12-22'),
(157, 1387772765, 1387772765, 53, 'this place has weirder food than Guam', 24, 6, '2013-12-11'),
(158, 1387772799, 1387772799, 53, 'Feels like I\\''m on another episode of my show when I eat here', 21, 8, '2013-12-11'),
(159, 1387772826, 1387772826, 53, 'Luger is the man!', 19, 10, '2013-12-22'),
(160, 1387772897, 1387772897, 54, 'A New York institution', 23, 9, '2013-12-21'),
(161, 1387772991, 1387772991, 54, 'Tex Mex at it best!', 22, 10, '2013-12-22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` int(11) NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `created`, `modified`, `token`, `password`, `last_login`, `timezone`, `first_name`, `last_name`, `email`, `city`, `state`) VALUES
(48, 1387766807, 1387766807, '68d4adb442f16ee055b7786e3820f0d2279b03cd', 'fb708c2b4bc65d6bf4aef081b7b22dd504e1dcda', 0, 'America/New_York', 'admin', 'admin', 'admin@g.com', 'New York', 'NY'),
(49, 1387768817, 1387768817, 'a34c62b7b7f66b11bfeec0317254425cec49d00f', '3b68e6bc540eda1242f650b89e6574b131046775', 0, '', 'Gordon', 'Ramsey', 'gordonramsey@g.com', 'Los Angeles', 'CA'),
(50, 1387769247, 1387769247, 'cc356b4c8bcf2b9a85afe86b6ed9ace6432e387c', '309c6f97b20b8ddd9d6be9a62dcf95d69293b6f8', 0, '', 'Rachel', 'Ray', 'rachelray@r.com', 'Brooklyn', 'NY'),
(51, 1387769549, 1387769549, '2c8b9c3fbb9d1f88e91a39935520a72e30c20e76', '85485dfd8dfe7616f85f787c36c50b6c7244bf58', 0, '', 'Paula', 'Deen', 'pauladeen@p.com', 'Atlanta', 'GA'),
(52, 1387769915, 1387769915, '5903a5c69a740b32bfabbb81fc22b8da7835678c', 'da8ecbaad315217d66e04f18971c8217ad591c4a', 0, '', 'Mario', 'Batali', 'mariobatali@m.com', 'New York', 'NY'),
(53, 1387772592, 1387772592, '66d5c0de40b0b601d26702179ec94aa34257f8dd', '1e83bcbb0b11864cbb1cd81bbe2bbe54ac33c5b8', 0, '', 'Anthony', 'Bourdain', 'anthonybourdain@a.com', 'New York', 'NY'),
(54, 1387772855, 1387772855, 'a69ddf4d19cb3ea36a3387aba3700ff64887155e', 'e7b5fbe959b9db41269ff89e5811d1300666f362', 0, '', 'Bobby', 'Flay', 'bobbyflay@b.com', 'New York', 'NY');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
