-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 11, 2014 at 12:27 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `icsls`
--
CREATE DATABASE IF NOT EXISTS `icsls` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `icsls`;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event` text NOT NULL,
  `ipaddress` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `timestamp`, `event`, `ipaddress`) VALUES
(1, '2014-03-10 22:03:39', ' viewed book id 11.', '127.0.0.1'),
(2, '2014-03-10 22:04:40', 'librarian1 logged in.', '127.0.0.1'),
(3, '2014-03-10 22:27:38', 'librarian1 logged out.', '127.0.0.1'),
(4, '2014-03-10 22:27:51', 'librarian1 logged in.', '127.0.0.1'),
(5, '2014-03-10 22:28:45', 'librarian1 viewed his/her profile.', '127.0.0.1'),
(6, '2014-03-10 22:28:46', 'librarian1 retrieved reserved materials.', '127.0.0.1'),
(7, '2014-03-10 22:28:46', 'librarian1 retrieved waitlisted materials.', '127.0.0.1'),
(8, '2014-03-10 22:28:46', 'librarian1 retrieved borrowed materials.', '127.0.0.1'),
(9, '2014-03-10 22:28:46', 'librarian1 retrieved his/her profile picture.', '127.0.0.1'),
(10, '2014-03-10 22:31:17', 'librarian1 logged out.', '127.0.0.1'),
(11, '2014-03-10 22:31:54', 'joselle logged in.', '127.0.0.1'),
(12, '2014-03-10 22:32:03', 'joselle viewed book id 11.', '127.0.0.1'),
(13, '2014-03-10 22:36:06', 'joselle logged out.', '127.0.0.1'),
(14, '2014-03-10 22:36:12', 'librarian1 logged in.', '127.0.0.1'),
(15, '2014-03-10 22:45:48', 'librarian1 viewed his/her profile.', '127.0.0.1'),
(16, '2014-03-10 22:45:48', 'librarian1 retrieved reserved materials.', '127.0.0.1'),
(17, '2014-03-10 22:45:48', 'librarian1 retrieved waitlisted materials.', '127.0.0.1'),
(18, '2014-03-10 22:45:48', 'librarian1 retrieved borrowed materials.', '127.0.0.1'),
(19, '2014-03-10 22:45:49', 'librarian1 retrieved his/her profile picture.', '127.0.0.1'),
(20, '2014-03-10 22:47:50', 'librarian1 logged out.', '127.0.0.1'),
(21, '2014-03-10 22:51:02', 'librarian1 logged in.', '127.0.0.1'),
(22, '2014-03-10 22:59:11', 'librarian1 viewed his/her profile.', '127.0.0.1'),
(23, '2014-03-10 22:59:11', 'librarian1 retrieved reserved materials.', '127.0.0.1'),
(24, '2014-03-10 22:59:11', 'librarian1 retrieved waitlisted materials.', '127.0.0.1'),
(25, '2014-03-10 22:59:11', 'librarian1 retrieved borrowed materials.', '127.0.0.1'),
(26, '2014-03-10 22:59:11', 'librarian1 retrieved his/her profile picture.', '127.0.0.1'),
(27, '2014-03-10 23:12:56', 'librarian1 viewed his/her profile.', '127.0.0.1'),
(28, '2014-03-10 23:12:56', 'librarian1 retrieved reserved materials.', '127.0.0.1'),
(29, '2014-03-10 23:12:56', 'librarian1 retrieved waitlisted materials.', '127.0.0.1'),
(30, '2014-03-10 23:12:56', 'librarian1 retrieved borrowed materials.', '127.0.0.1'),
(31, '2014-03-10 23:12:56', 'librarian1 retrieved his/her profile picture.', '127.0.0.1'),
(32, '2014-03-11 00:23:32', 'librarian1 added a reference material.', '::1'),
(33, '2014-03-11 00:24:03', 'librarian1 viewed his/her profile.', '::1'),
(34, '2014-03-11 00:24:04', 'librarian1 retrieved reserved materials.', '::1'),
(35, '2014-03-11 00:24:04', 'librarian1 retrieved waitlisted materials.', '::1'),
(36, '2014-03-11 00:24:04', 'librarian1 retrieved borrowed materials.', '::1'),
(37, '2014-03-11 00:24:04', 'librarian1 retrieved his/her profile picture.', '::1'),
(38, '2014-03-11 00:24:16', 'librarian1 viewed his/her profile.', '::1'),
(39, '2014-03-11 00:24:16', 'librarian1 retrieved his/her profile picture.', '::1'),
(40, '2014-03-11 00:24:39', 'librarian1 viewed his/her profile.', '::1'),
(41, '2014-03-11 00:24:39', 'librarian1 retrieved his/her profile picture.', '::1'),
(42, '2014-03-11 00:24:44', 'librarian1 logged out.', '::1'),
(43, '2014-03-11 00:25:08', 'librarian1 logged in.', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `reference_materials`
--

CREATE TABLE IF NOT EXISTS `reference_materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `author` tinytext NOT NULL,
  `isbn` varchar(13) DEFAULT NULL,
  `category` char(1) NOT NULL,
  `description` text,
  `publisher` varchar(100) DEFAULT NULL,
  `publication_year` int(4) DEFAULT NULL,
  `access_type` char(1) NOT NULL,
  `course_code` varchar(8) NOT NULL,
  `total_available` int(2) NOT NULL,
  `total_stock` int(2) NOT NULL,
  `times_borrowed` int(5) DEFAULT '0',
  `item_image` varchar(20) NOT NULL DEFAULT '0.jpg',
  `for_deletion` char(1) NOT NULL DEFAULT 'F',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=129 ;

--
-- Dumping data for table `reference_materials`
--

INSERT INTO `reference_materials` (`id`, `title`, `author`, `isbn`, `category`, `description`, `publisher`, `publication_year`, `access_type`, `course_code`, `total_available`, `total_stock`, `times_borrowed`, `item_image`, `for_deletion`) VALUES
(1, 'Computer Applications in Engineering Education', 'Magdy F. Iskander', NULL, 'J', NULL, 'Wiley Periodicals, Inc., A Wiley Company', 2014, 'F', 'CS128', 6, 6, 0, '0.jpg', 'F'),
(2, 'Model-Driven and Software Product Line Engineering', 'Hugo Arboleda', '9781848214279', 'B', NULL, 'ISTE Ltd', 2012, 'F', 'CS128', 5, 5, 0, '0.jpg', 'F'),
(3, 'Computational Intelligence', 'Ali Ghorbani', NULL, 'J', 'This leading international journal promotes and stimulates research in the field of artificial intelligence (AI).', 'Wiley Periodicals, Inc.', 2014, 'S', 'CS170', 5, 5, 0, '0.jpg', 'F'),
(4, 'Emerging Methods, Technologies, and Process Management in Software Engineering', 'Andrea De Lucia', '9780470085714', 'B', NULL, 'John Wiley & Sons, Inc.', 2008, 'S', 'CS128', 7, 7, 0, '0.jpg', 'F'),
(5, 'Process Control Engineering', 'M. Polke', '9783527286898', 'B', 'This book surveys methods, problems, and tools used in process control engineering. Its scope has been purposely made broad in order to permit an overall view of this subject.', 'VCH Verlagsgesellschaft mbH', 1994, 'F', 'CS125', 2, 2, 0, '0.jpg', 'F'),
(6, 'The Handbook of Information and Computer Ethics', 'Kenneth Einar Himma', '9780471799597', 'B', 'This handbook provides an accessible overview of the most important issues in information and computer ethics.', 'John Wiley & Sons, Inc.', 2008, 'F', 'CS11', 3, 3, 0, '0.jpg', 'F'),
(7, 'Random Structures & Algorithms', 'Michal Karonski', NULL, 'J', NULL, 'Wiley Periodicals, Inc., A Wiley Company', 2014, 'S', 'CS123', 9, 9, 0, '0.jpg', 'F'),
(8, 'Network Modeling and Simulation: A Practical Perspective', 'Mohsen Guizani', '9780470035870', 'B', 'Network Modeling and Simulation is a practical guide to using modeling and simulation to solve real-life problems.', 'John Wiley & Sons, Ltd', 2010, 'F', 'CS100', 2, 2, 0, '0.jpg', 'F'),
(9, 'Advanced Computer Architecture and Parallel Processing', 'Hesham El-Rewini', '9780471467403', 'B', 'Computer architecture deals with the physical configuration, logical structure, formats, protocols, and operational sequences for processing data, controlling the configuration, and controlling the operations over a computer.', 'John Wiley & Sons, Inc.', 2005, 'F', 'CS132', 8, 8, 0, '0.jpg', 'F'),
(10, 'Computer Animation and Virtual Worlds', 'Nadia Magnenat Thalmann', NULL, 'J', NULL, 'John Wiley & Sons, Ltd.', NULL, 'S', 'CS161', 6, 6, 0, '0.jpg', 'F'),
(11, '3D Object Processing: Compression, Indexing and Watermarking', 'Jean-Luc Dugelay', '9780470065426', 'B', NULL, 'John Wiley & Sons, Ltd', 2008, 'F', 'CS161', 4, 4, 0, '0.jpg', 'F'),
(12, 'Computer System Design: System-on-Chip', 'Michael J. Flynn', '9780470643365', 'B', NULL, 'John Wiley & Sons, Inc.', 2011, 'F', 'CS132', 3, 3, 0, '0.jpg', 'F'),
(13, 'Compiler Construction Using Java, JavaCC, and Yacc', 'Anthony J. Dos Reis', '9780470949597', 'B', 'Broad in scope, involving theory, the application of that theory, and programming technology, compiler construction is a moving target, with constant advances in compiler technology taking place.', 'the IEEE Computer Society, Inc.', 2012, 'S', 'CS129', 2, 2, 0, '0.jpg', 'F'),
(14, 'Concurrency and Computation: Practice and Experience', 'Geoffrey C. Fox', NULL, 'J', NULL, 'John Wiley & Sons, Ltd.', 2014, 'F', 'CS132', 1, 1, 0, '0.jpg', 'F'),
(15, 'Mobile 3D Graphics SoC: From Algorithm to Chip', 'Jeong-Ho Woo', '9780470823774', 'B', 'The first book to explain the principals behind mobile 3D hardware implementation, helping readers understand advanced algorithms, produce low-cost, low-power SoCs, or become familiar with embedded systems', 'John Wiley & Sons (Asia) Pte Ltd', 2010, 'F', 'CS161', 7, 7, 0, '0.jpg', 'F'),
(16, 'Journal of Computer-Mediated Communication', 'S. Shyam Sundar', NULL, 'J', NULL, 'International Communication Association', 2014, 'S', 'CS170', 6, 6, 0, '0.jpg', 'F'),
(17, 'Journal of Software: Evolution and Process', 'Gerardo Canfora', NULL, 'J', NULL, 'John Wiley & Sons, Ltd.', NULL, 'F', 'CS128', 6, 6, 0, '0.jpg', 'F'),
(18, 'Internet Technologies Handbook: Optimizing the IP Network', 'Mark A. Miller', '9780471480501', 'B', 'A comprehensive reference that addresses the need for solid understanding of the operation of IP networks, plus optimization and management techniques to keep those networks running at peak performance', 'Mark A. Miller. All rights reserved.', 2004, 'F', 'CS100', 7, 7, 0, '0.jpg', 'F'),
(19, 'International Journal of Network Management', 'James Won-Ki Hong', NULL, 'J', NULL, 'John Wiley & Sons, Ltd.', NULL, 'S', 'CS100', 3, 3, 0, '0.jpg', 'F'),
(20, 'Fundamentals of Software Testing', 'Bernard Homès', '9781848213241', 'B', NULL, 'ISTE Ltd', 2012, 'F', 'CS128', 5, 5, 0, '0.jpg', 'F'),
(21, 'Designing a Better Authentication Model', 'Prashasti Gehalot', NULL, 'T', NULL, NULL, 2013, 'S', 'CS132', 1, 1, 0, '0.jpg', 'F'),
(22, 'in urna accumsan Aenean odio velit augue', 'Ivan Chen', NULL, 'B', 'diam ornare nisl Ut sodales litora dolor odio primis Aenean Pellentesque Suspendisse Maecenas Integer ante augue', 'Indigo Brock', 1946, 'S', 'JEH839', 3, 3, 13, '0.jpg', 'F'),
(23, 'molestie et facilisi bibendum ligula ac', 'Micah Reed', NULL, 'M', 'vel taciti ornare fringilla fermentum commodo penatibus libero Mauris senectus molestie fames nisi semper mus velit dapibus Cum', 'Leila Savage', 1603, 'F', 'HAE309', 6, 6, 15, '0.jpg', 'F'),
(24, 'ornare Ut ligula leo aliquet', 'Forrest Bender', NULL, 'M', 'lacinia Ut enim Morbi Integer scelerisque laoreet feugiat ultricies leo', 'Karen Valencia', 1367, 'S', 'MGR793', 4, 4, 71, '0.jpg', 'T'),
(25, 'Etiam nec iaculis Quisque fermentum pellentesque ridiculus arcu nonummy Duis elementum Fusce', 'Maris Vang', NULL, 'M', 'cursus aliquet risus habitant rhoncus Ut non ullamcorper lorem adipiscing vitae netus turpis risus nec pede natoque pellentesque ante Etiam', 'Mannix Roth', 1393, 'F', 'ITT435', 4, 4, 48, '0.jpg', 'F'),
(26, 'egestas vel viverra rutrum primis interdum Duis placerat', 'Rosalyn Norman', NULL, 'C', 'blandit torquent Maecenas tellus in blandit ultricies Nam senectus semper et scelerisque', 'Marvin Serrano', 1980, 'F', 'COO480', 6, 6, 27, '0.jpg', 'F'),
(27, 'Vestibulum felis penatibus sociis placerat varius suscipit elementum Mauris metus feugiat massa aliquam', 'Palmer Dean', NULL, 'T', 'Sed ultricies pellentesque fames aliquet mauris nonummy', 'Stella Cruz', 1374, 'F', 'MCS324', 1, 3, 66, '0.jpg', 'F'),
(28, 'Nullam cubilia tincidunt cubilia at diam adipiscing fermentum Cum magna posuere', 'Charles Frazier', NULL, 'T', 'Integer auctor Pellentesque', 'Ingrid Pate', 1800, 'F', 'CEV403', 2, 10, 69, '0.jpg', 'T'),
(29, 'hendrerit vehicula lorem rhoncus nisl erat Phasellus commodo vel vehicula', 'Maite Johnston', NULL, 'B', 'mi venenatis lacus Proin et mattis sem dis sociis Curae mus eget', 'Alexander Townsend', 1099, 'S', 'MXR646', 2, 3, 46, '0.jpg', 'F'),
(30, 'blandit habitant nisi Suspendisse rutrum justo sodales lectus ultricies Nam lectus parturient', 'Ferris Roberts', NULL, 'B', 'dis bibendum magna eleifend nec In urna sed hymenaeos Morbi tortor libero non quis malesuada lorem commodo', 'Arthur Barker', 1555, 'F', 'QDG633', 3, 10, 30, '0.jpg', 'F'),
(31, 'iaculis sit taciti facilisi nascetur sociis', 'Debra Kirby', NULL, 'C', 'dis montes mi taciti a Curae vestibulum ut convallis malesuada Nulla cursus molestie habitant sociis dolor', 'Xenos Harrington', 1564, 'S', 'IQL115', 1, 6, 34, '0.jpg', 'F'),
(32, 'eu purus ultricies est', 'Camden Coleman', NULL, 'C', 'sagittis', 'Harlan Ramsey', 1337, 'S', 'GZH870', 1, 7, 95, '0.jpg', 'F'),
(33, 'posuere Etiam tellus suscipit faucibus velit fringilla placerat feugiat Lorem quam Nam Quisque', 'Caesar Dodson', NULL, 'J', 'inceptos consequat aptent turpis sociis Sed nascetur arcu fames Duis fringilla', 'Clare Flores', 1158, 'F', 'BAS333', 5, 10, 55, '0.jpg', 'F'),
(34, 'Class molestie primis dictum feugiat consequat orci eros ligula ut', 'Philip Kelley', NULL, 'B', 'ridiculus venenatis nisi feugiat quam mus libero Nunc blandit ultrices inceptos luctus sodales odio conubia neque Nulla interdum', 'Davis Foster', 1008, 'F', 'XUK713', 6, 8, 39, '0.jpg', 'F'),
(35, 'placerat accumsan purus Aenean Ut Integer accumsan', 'Hiram Schroeder', NULL, 'S', 'feugiat magnis Cras arcu facilisi', 'Palmer Kirby', 1270, 'S', 'UVW550', 4, 4, 84, '0.jpg', 'F'),
(36, 'Duis tortor', 'Dorothy Cleveland', NULL, 'J', 'quis ridiculus vestibulum eleifend tellus inceptos Class Nam nunc non taciti Aliquam massa', 'Wang Barnes', 1961, 'S', 'MFW115', 3, 3, 7, '0.jpg', 'T'),
(37, 'pellentesque urna Etiam turpis sem suscipit Vivamus', 'Brendan Phillips', NULL, 'M', 'mauris convallis rutrum nisi adipiscing sem dictum mus feugiat ac varius Aenean', 'Hiroko Francis', 1402, 'F', 'UTP830', 7, 8, 31, '0.jpg', 'T'),
(38, 'dolor pretium sociosqu Cras iaculis pede Praesent Cum ornare suscipit Vestibulum id', 'Isaiah Short', NULL, 'B', 'non a vestibulum sociosqu Nam semper arcu faucibus torquent sem leo congue viverra Phasellus', 'Aaron Tanner', 1221, 'S', 'GNF018', 4, 9, 82, '0.jpg', 'T'),
(39, 'at taciti Integer aliquam ante in', 'Ralph Davenport', NULL, 'C', 'lobortis', 'Amber Clay', 1858, 'S', 'SZQ738', 5, 5, 6, '0.jpg', 'F'),
(40, 'Sed imperdiet', 'Georgia Huffman', NULL, 'B', 'cursus morbi cursus', 'Doris Espinoza', 1210, 'F', 'CUI313', 1, 5, 95, '0.jpg', 'T'),
(41, 'est', 'Graham Welch', NULL, 'J', 'cursus metus mi Sed Cum condimentum tincidunt tellus malesuada Nam Mauris pretium lectus mi turpis Integer per imperdiet consectetuer erat', 'Thomas Schwartz', 1210, 'F', 'SBM835', 3, 3, 82, '0.jpg', 'F'),
(42, 'metus', 'Blake Black', NULL, 'T', 'fames libero parturient Mauris mollis ultrices diam pretium Aenean Vestibulum accumsan ornare Fusce rutrum', 'Emerson Ryan', 1561, 'S', 'YNR743', 4, 4, 27, '0.jpg', 'F'),
(43, 'ante tempus', 'Arsenio Olson', NULL, 'J', 'pharetra sapien Ut aptent magnis Vivamus aliquet pharetra Duis pellentesque', 'Sydnee Beck', 1053, 'F', 'HBG776', 6, 10, 98, '0.jpg', 'F'),
(44, 'dignissim Vestibulum ullamcorper vestibulum lacus lacinia nisi nec', 'Rafael Mckay', NULL, 'J', 'facilisis hymenaeos faucibus porta in non litora enim dis massa risus venenatis massa', 'Rose Atkinson', 1464, 'S', 'DAM932', 7, 7, 38, '0.jpg', 'F'),
(45, 'vestibulum ad pulvinar tristique morbi risus malesuada ultrices Praesent Mauris montes', 'Amber Mcgee', NULL, 'M', 'porttitor volutpat Suspendisse malesuada rutrum fames Maecenas pretium euismod netus Curae vel bibendum Vivamus eu dictum', 'Tana Bond', 1255, 'S', 'MDF024', 7, 9, 20, '0.jpg', 'F'),
(46, 'ridiculus', 'Adam Benton', NULL, 'S', 'adipiscing odio commodo amet eget Vivamus torquent hendrerit amet ligula augue morbi eu egestas consequat', 'Wayne Singleton', 1665, 'F', 'TCF167', 5, 7, 99, '0.jpg', 'T'),
(47, 'magna eleifend conubia Morbi laoreet aliquam Maecenas', 'Amos Long', NULL, 'J', 'est litora gravida imperdiet Sed varius a nibh gravida nunc ullamcorper bibendum arcu tempus Aliquam', 'Gloria Carey', 1581, 'S', 'XLC196', 9, 10, 27, '0.jpg', 'T'),
(48, 'fringilla', 'Brian Bates', NULL, 'M', 'inceptos', 'Chaney Sargent', 1480, 'S', 'UOB604', 1, 1, 23, '0.jpg', 'F'),
(49, 'urna tempus lobortis condimentum dignissim Etiam Curae penatibus montes Fusce', 'Robert Bruce', NULL, 'J', 'ut id velit lacus ornare dapibus volutpat magna', 'Ulla Santana', 1104, 'S', 'RXA418', 1, 1, 90, '0.jpg', 'F'),
(50, 'Fusce inceptos Mauris viverra Phasellus velit enim Nunc arcu eleifend Proin litora nonummy', 'Katelyn Mercer', NULL, 'M', 'Quisque consectetuer ipsum leo ornare Mauris a In', 'Hanae Tate', 1636, 'F', 'WPK261', 1, 1, 91, '0.jpg', 'T'),
(51, 'cursus fermentum et nibh dolor dis tristique accumsan pede dui Sed est', 'Vivian Suarez', NULL, 'C', 'Mauris suscipit natoque justo massa morbi feugiat', 'Vladimir Villarreal', 1120, 'F', 'ITX180', 5, 7, 68, '0.jpg', 'F'),
(52, 'blandit elit pulvinar torquent vestibulum arcu eleifend est per habitant feugiat turpis laoreet', 'Teegan Bartlett', NULL, 'M', 'quam semper magnis in faucibus interdum auctor sem Cras Phasellus', 'Mona Gamble', 1100, 'S', 'HQY537', 5, 8, 62, '0.jpg', 'F'),
(53, 'magnis Class placerat lobortis porta felis Integer sem', 'Shoshana Benton', NULL, 'C', 'feugiat neque enim felis convallis tellus mattis leo', 'Olivia Gates', 1808, 'S', 'KLO286', 4, 6, 1, '0.jpg', 'T'),
(54, 'hymenaeos elementum et morbi dictum turpis aliquet ac tempus ut', 'Brennan Luna', NULL, 'S', 'Morbi nonummy primis sem', 'Rajah Burks', 1999, 'S', 'CBZ339', 2, 7, 55, '0.jpg', 'F'),
(55, 'amet facilisis enim blandit viverra', 'Steven Boyle', NULL, 'T', 'mattis nunc vitae vehicula Donec dolor ultrices elementum dui Nam gravida', 'Derek Griffin', 1806, 'F', 'DZO311', 5, 10, 90, '0.jpg', 'T'),
(56, 'elementum condimentum neque vitae nostra eget Maecenas auctor risus', 'Quail Landry', NULL, 'S', 'vestibulum vel vestibulum hymenaeos Sed tortor suscipit volutpat semper nunc Nunc montes senectus sapien Class eleifend tellus massa', 'Camilla Levine', 1454, 'F', 'ZVM558', 2, 2, 97, '0.jpg', 'T'),
(57, 'Cum lacinia ac magnis', 'Jamal May', NULL, 'M', 'Pellentesque urna aliquam natoque velit', 'Ahmed Carrillo', 1125, 'S', 'CMS570', 6, 6, 64, '0.jpg', 'T'),
(58, 'interdum vulputate vestibulum vehicula aptent facilisi ligula nec rhoncus', 'Kane Livingston', NULL, 'B', 'Class nunc at parturient suscipit varius mattis', 'Adrienne Mullen', 1271, 'S', 'ZNX386', 1, 4, 43, '0.jpg', 'F'),
(59, 'dis Nullam Lorem pulvinar tincidunt consectetuer eros est ad turpis dolor Donec', 'Teagan Harrell', NULL, 'T', 'tincidunt purus mi', 'Forrest Hunter', 1740, 'F', 'ORV921', 7, 7, 46, '0.jpg', 'T'),
(60, 'lectus In consequat Class eu ac vulputate', 'Jocelyn Fleming', NULL, 'S', 'In urna Lorem Lorem montes', 'Hyatt Rios', 1264, 'S', 'DVQ329', 3, 6, 70, '0.jpg', 'T'),
(61, 'litora', 'Calista Leach', NULL, 'S', 'cursus Phasellus', 'Fletcher Ballard', 1336, 'S', 'MJT566', 8, 8, 55, '0.jpg', 'F'),
(62, 'justo et tristique fermentum dignissim molestie', 'Cole Holden', NULL, 'B', 'sapien amet pretium Curae venenatis ad sed et pretium parturient hendrerit', 'Jayme England', 1283, 'S', 'AWV677', 1, 3, 88, '0.jpg', 'T'),
(63, 'vitae netus posuere adipiscing magnis nulla posuere suscipit dapibus porta', 'Castor Blackburn', NULL, 'M', 'vel convallis nisl lobortis accumsan feugiat iaculis sodales nibh volutpat velit odio congue justo', 'Rylee Blake', 1362, 'S', 'OEM643', 2, 10, 19, '0.jpg', 'F'),
(64, 'Quisque ac Cum mollis non ultrices ligula taciti posuere', 'Hayden Bowers', NULL, 'M', 'nec viverra Quisque Curabitur scelerisque facilisi', 'Octavius Mcconnell', 1575, 'F', 'QNB862', 3, 7, 56, '0.jpg', 'T'),
(65, 'pede mattis pede vulputate penatibus nunc nostra montes pharetra', 'Brody Petersen', NULL, 'T', 'vel lacus Ut eros Curae', 'Lara Clark', 1197, 'F', 'NGG057', 1, 1, 65, '0.jpg', 'F'),
(66, 'nostra accumsan ultricies nunc ultrices venenatis sociosqu Cras ornare Curae lobortis', 'Callie Moran', NULL, 'J', 'mi montes accumsan mollis Mauris Morbi taciti leo fermentum Vivamus convallis quam dignissim montes nulla scelerisque adipiscing', 'Pascale Bright', 1522, 'F', 'SRC468', 4, 4, 70, '0.jpg', 'T'),
(67, 'nascetur varius quis in Integer sed dictum inceptos nascetur eu nec Nulla tincidunt eleifend Nullam', 'Travis Herring', NULL, 'J', 'bibendum Praesent pretium orci torquent lorem vehicula iaculis elementum purus taciti Curae lobortis lectus', 'Charity Robbins', 1997, 'S', 'QZF768', 1, 4, 25, '0.jpg', 'F'),
(68, 'Proin urna pede massa Curabitur leo blandit odio', 'Uriah Floyd', NULL, 'S', 'tristique venenatis vestibulum Fusce ut quis', 'Hoyt Tillman', 1260, 'S', 'ZDN030', 8, 8, 73, '0.jpg', 'F'),
(69, 'faucibus venenatis ipsum aliquet Vivamus cursus habitant eros porttitor bibendum varius Nulla torquent habitant', 'Lilah Hopper', NULL, 'T', 'eleifend turpis interdum porttitor a pulvinar massa aptent felis neque congue', 'Ray Rich', 1283, 'S', 'XKY086', 5, 5, 77, '0.jpg', 'F'),
(70, 'nisl aliquam taciti gravida netus orci erat', 'Zephania Cox', NULL, 'C', 'vehicula Cum diam magnis diam sociis nec imperdiet dui rhoncus', 'Cameron Reeves', 1445, 'F', 'KNS644', 5, 5, 23, '0.jpg', 'T'),
(71, 'libero elit per eros magna', 'Mercedes Zimmerman', NULL, 'S', 'congue nisi ligula morbi adipiscing felis ridiculus vehicula vestibulum Vestibulum facilisi dis Morbi', 'Perry Leblanc', 2002, 'S', 'JJI016', 3, 4, 52, '0.jpg', 'T'),
(72, 'sapien massa Mauris magnis torquent pede Lorem sollicitudin torquent', 'Linda Lancaster', NULL, 'M', 'nascetur tellus vel tincidunt congue est', 'Kareem Fuentes', 1829, 'F', 'ATI828', 8, 8, 40, '0.jpg', 'F'),
(73, 'Pellentesque suscipit bibendum condimentum bibendum accumsan vitae porttitor malesuada porttitor a nunc ac lacinia nulla', 'Bruno Christian', NULL, 'C', 'diam pretium quis Curabitur odio nonummy vulputate Praesent', 'Hannah Boyle', 1407, 'F', 'AKI832', 4, 7, 75, '0.jpg', 'F'),
(74, 'natoque ultrices Pellentesque tempus litora odio facilisi habitant gravida ac a Proin Nulla fames parturient', 'Theodore Pittman', NULL, 'S', 'vel posuere arcu', 'Solomon Cooke', 1378, 'S', 'JGE146', 1, 3, 9, '0.jpg', 'F'),
(75, 'tincidunt ridiculus rhoncus enim facilisis luctus Suspendisse Proin in magnis penatibus nisi Praesent tellus semper', 'Solomon Frazier', NULL, 'T', 'ultrices hymenaeos torquent fermentum ut', 'Darryl Everett', 1530, 'S', 'KUB802', 2, 2, 1, '0.jpg', 'F'),
(76, 'Vivamus aliquet dui mi Etiam nisi Class feugiat', 'Pamela Emerson', NULL, 'B', 'Ut nibh id commodo ligula Class justo morbi euismod elementum ullamcorper tincidunt suscipit sollicitudin gravida', 'Imani Nixon', 1415, 'F', 'WUM799', 7, 7, 96, '0.jpg', 'F'),
(77, 'montes Donec vestibulum fames Quisque rutrum Quisque nisl', 'Lev Peterson', NULL, 'M', 'vulputate tortor', 'Quinlan Hurley', 1228, 'F', 'BJZ586', 4, 4, 14, '0.jpg', 'T'),
(78, 'eros sapien consectetuer sollicitudin Sed quis sagittis mauris amet', 'Erica Matthews', NULL, 'S', 'cursus quam Nam eros Class vulputate pulvinar bibendum blandit ante dapibus aliquam posuere massa nisi', 'Aidan Nixon', 1151, 'F', 'MZG371', 7, 7, 34, '0.jpg', 'T'),
(79, 'urna Nunc iaculis est ac dignissim', 'Rogan Collins', NULL, 'J', 'suscipit convallis et placerat Vestibulum rhoncus risus tincidunt fames dui fames egestas', 'Dexter Finley', 1353, 'S', 'YIQ380', 2, 8, 80, '0.jpg', 'T'),
(80, 'Praesent quis conubia Pellentesque libero Fusce torquent aliquam luctus condimentum Nam', 'Dillon Davidson', NULL, 'S', 'molestie pellentesque dignissim vel sagittis Mauris primis varius euismod commodo', 'Carter Greene', 1429, 'F', 'NAM702', 5, 5, 22, '0.jpg', 'T'),
(81, 'orci tincidunt congue nibh natoque dolor', 'Cally Gamble', NULL, 'B', 'Quisque eros nisl Vivamus fermentum congue Vestibulum pulvinar amet', 'Upton Norman', 1186, 'S', 'IFB873', 7, 10, 97, '0.jpg', 'T'),
(82, 'mollis venenatis vehicula mauris inceptos Vivamus cubilia tempus Phasellus aliquet nec primis blandit adipiscing', 'Tiger Best', NULL, 'C', 'Nulla Nunc natoque Nunc pede commodo viverra porttitor vehicula aliquam ridiculus Curabitur volutpat tristique ac eget volutpat', 'Robert Larson', 1909, 'F', 'JVF765', 1, 1, 59, '0.jpg', 'F'),
(83, 'Curabitur Aliquam habitant molestie morbi fringilla morbi lorem ad Integer sed litora ut aptent', 'Castor Bauer', NULL, 'C', 'sapien justo mi facilisi sociis velit at urna augue', 'Uriel Farrell', 1957, 'F', 'JNI624', 2, 9, 90, '0.jpg', 'F'),
(84, 'at auctor risus tincidunt urna venenatis senectus urna dignissim molestie inceptos tortor inceptos Suspendisse torquent', 'Donovan Fitzpatrick', NULL, 'T', 'nec diam odio ipsum netus tincidunt consectetuer pretium', 'Amber Salinas', 1101, 'F', 'VXO872', 1, 1, 94, '0.jpg', 'F'),
(85, 'vulputate Vestibulum', 'Risa Randolph', NULL, 'C', 'non sodales ridiculus vulputate sed', 'Valentine Valentine', 1492, 'S', 'IZS917', 1, 1, 48, '0.jpg', 'T'),
(86, 'nascetur', 'Perry Bauer', NULL, 'M', 'vehicula ultricies primis nisl Duis porta fermentum venenatis semper imperdiet per nisi', 'Shaine Puckett', 1898, 'F', 'XEO630', 8, 8, 27, '0.jpg', 'F'),
(87, 'lacus', 'Arden Tucker', NULL, 'C', 'nonummy Nulla Praesent Mauris velit dapibus Ut laoreet dolor adipiscing', 'Suki Gaines', 1414, 'F', 'PNZ613', 4, 4, 76, '0.jpg', 'T'),
(88, 'nostra ligula erat Proin arcu bibendum tincidunt pharetra consectetuer ligula elit', 'Farrah Valenzuela', NULL, 'C', 'cursus Quisque ullamcorper tincidunt dignissim hendrerit eu fringilla tellus', 'Uriel Carpenter', 1341, 'F', 'UGZ842', 4, 6, 77, '0.jpg', 'T'),
(89, 'posuere Integer nibh sapien vel neque pretium Aenean Lorem fringilla purus primis consectetuer lorem parturient', 'Nicole Dickerson', NULL, 'C', 'Nulla senectus cubilia Integer varius', 'Martha Lamb', 1920, 'S', 'AMO340', 5, 5, 77, '0.jpg', 'T'),
(90, 'Vivamus rutrum vehicula blandit adipiscing', 'Karen Brewer', NULL, 'J', 'molestie pellentesque mus commodo Pellentesque eros', 'Noelani Hood', 1955, 'S', 'SHK689', 1, 4, 51, '0.jpg', 'T'),
(91, 'aliquam mollis ipsum hymenaeos sapien purus varius libero mattis', 'Kasimir Bright', NULL, 'J', 'facilisis condimentum Maecenas nostra dis', 'Eagan Reed', 1740, 'S', 'NRH880', 2, 3, 73, '0.jpg', 'F'),
(92, 'Phasellus Aliquam senectus quam suscipit Etiam Cras Nullam', 'Kamal Guerra', NULL, 'T', 'Quisque sociis Praesent tellus', 'Steven Wilkerson', 1680, 'S', 'KSA151', 2, 9, 28, '0.jpg', 'F'),
(93, 'sed torquent sociis Curabitur non molestie fermentum ridiculus', 'Valentine Hess', NULL, 'C', 'non diam eros augue hendrerit pretium sagittis', 'Lyle Roberson', 1611, 'S', 'ILQ392', 3, 3, 79, '0.jpg', 'F'),
(94, 'nisl', 'Valentine Ayers', NULL, 'S', 'Vivamus nibh tincidunt feugiat magnis aptent Mauris amet interdum suscipit tempor mollis', 'Ivana Logan', 1894, 'S', 'IVF275', 4, 6, 84, '0.jpg', 'T'),
(95, 'dui', 'Linus Vargas', NULL, 'S', 'nascetur gravida Mauris litora sem Maecenas feugiat feugiat Duis', 'Ila Aguirre', 1067, 'F', 'JGM878', 3, 3, 78, '0.jpg', 'F'),
(96, 'tortor mi sollicitudin primis scelerisque semper tellus adipiscing pharetra lectus eu metus', 'Minerva Snyder', NULL, 'T', 'tortor est', 'Montana Mcgowan', 1915, 'S', 'CZU852', 2, 2, 85, '0.jpg', 'F'),
(97, 'Morbi dictum elit nunc purus dignissim Nullam nascetur Etiam nulla Etiam penatibus faucibus', 'Rahim Stevenson', NULL, 'J', 'ultrices sollicitudin Vestibulum turpis fames fermentum taciti mauris condimentum Cras scelerisque egestas eleifend fermentum nisi Aenean ipsum lectus', 'Tate Garza', 1682, 'S', 'KRM084', 5, 5, 61, '0.jpg', 'F'),
(98, 'elementum tempor vitae', 'Dominic Sharpe', NULL, 'S', 'elementum cursus ultrices elementum nibh ligula est', 'Justine Holcomb', 1318, 'F', 'AOX525', 4, 4, 78, '0.jpg', 'T'),
(99, 'Aenean senectus dictum eleifend lobortis facilisi', 'Jin Osborn', NULL, 'T', 'vulputate ligula torquent nibh ac vehicula adipiscing Aenean urna lorem euismod nulla odio nisl eleifend taciti quis interdum', 'Medge Waters', 1154, 'F', 'CHB916', 9, 9, 62, '0.jpg', 'T'),
(100, 'litora amet', 'Brianna Lyons', NULL, 'B', 'nisl tincidunt nec neque aliquet odio ipsum Nunc Curae Morbi venenatis elit vel conubia auctor tortor', 'Hashim Bates', 1521, 'S', 'SHU060', 3, 3, 73, '0.jpg', 'T'),
(101, 'commodo torquent tellus', 'Sylvester Hardin', NULL, 'M', 'interdum Aliquam eros Vestibulum tristique', 'Sopoline Skinner', 1771, 'S', 'DKO340', 3, 3, 65, '0.jpg', 'T'),
(102, 'Proin ligula accumsan vulputate sem Vestibulum Vestibulum', 'Zelda Slater', NULL, 'J', 'sit porta feugiat sociosqu conubia a viverra et conubia euismod dictum mus sagittis sit vulputate eget consequat varius', 'Orlando Copeland', 1540, 'F', 'TMG220', 6, 6, 38, '0.jpg', 'T'),
(103, 'rhoncus consequat mus vitae interdum nulla Mauris Vestibulum Integer velit magnis Proin est Aliquam ad', 'Beverly Merritt', NULL, 'T', 'netus dis senectus elit mauris pharetra pharetra quis habitant magnis nec sagittis', 'Conan Gentry', 1718, 'F', 'YOJ083', 1, 7, 19, '0.jpg', 'F'),
(104, 'Morbi erat Ut dictum sed nec', 'Shaeleigh Porter', NULL, 'S', 'elit natoque nisi et eleifend vitae molestie urna tempus tincidunt mollis metus', 'Price Stanley', 1915, 'S', 'NYI383', 4, 4, 63, '0.jpg', 'T'),
(105, 'Aenean Cum lobortis adipiscing ullamcorper Nam ornare mus consectetuer Praesent sociosqu', 'Grace Brady', NULL, 'B', 'quam porttitor Curabitur Suspendisse eget lobortis aptent Suspendisse luctus', 'Thaddeus Workman', 1869, 'S', 'PQU037', 1, 1, 94, '0.jpg', 'T'),
(106, 'quam Maecenas sollicitudin porttitor adipiscing', 'Aristotle Hooper', NULL, 'M', 'venenatis', 'Burke Mcintosh', 1103, 'S', 'VZK113', 3, 7, 58, '0.jpg', 'F'),
(107, 'feugiat dignissim Vivamus feugiat', 'Hasad Knapp', NULL, 'T', 'in tempus sociosqu est Donec Fusce Aenean', 'Jael Stein', 1659, 'S', 'OEB187', 3, 3, 62, '0.jpg', 'F'),
(108, 'pede tincidunt nonummy vehicula torquent neque dolor rutrum laoreet condimentum ac et commodo', 'Wayne Anthony', NULL, 'S', 'hendrerit diam taciti at In est nec consequat montes nisl rhoncus quam Lorem amet erat est lectus', 'Samson Ellis', 1714, 'F', 'IXM543', 3, 3, 85, '0.jpg', 'F'),
(109, 'lacus elit vulputate placerat vitae hymenaeos risus habitant metus aliquam libero enim mollis', 'Hilda Spence', NULL, 'B', 'congue', 'Dillon Bowers', 1922, 'S', 'AUT718', 7, 7, 42, '0.jpg', 'T'),
(110, 'lacus dui montes tortor fermentum Vestibulum quam mollis tempor', 'Cadman Paul', NULL, 'J', 'bibendum Class bibendum est tellus Ut iaculis in Nam sociosqu nonummy eget tempor quis vitae', 'Emi Mann', 1201, 'S', 'EXF804', 9, 10, 65, '0.jpg', 'T'),
(111, 'accumsan', 'John Galloway', NULL, 'J', 'Lorem faucibus Aenean nisl Phasellus risus morbi vestibulum ultrices Nam luctus augue', 'Candace Kidd', 1851, 'S', 'WPQ011', 8, 8, 64, '0.jpg', 'T'),
(112, 'aliquet pellentesque velit Cum dapibus cursus pulvinar diam ipsum nec tortor velit pretium magnis pretium', 'Bradley Gaines', NULL, 'B', 'sodales aptent habitant pharetra urna enim nunc', 'Uta Jordan', 1491, 'S', 'NDI595', 1, 1, 49, '0.jpg', 'T'),
(113, 'varius posuere condimentum', 'Hayden Wilkins', NULL, 'T', 'Lorem nulla laoreet mauris Aliquam netus facilisi ridiculus rutrum Ut facilisis ullamcorper nec interdum', 'Mari Finley', 1223, 'S', 'ERA033', 1, 1, 69, '0.jpg', 'T'),
(114, 'augue Mauris varius ornare posuere Phasellus', 'Kelly Delgado', NULL, 'B', 'In mus libero nisi dis eleifend In Vestibulum pharetra semper fames', 'Ayanna Trujillo', 1324, 'S', 'JDI123', 4, 10, 70, '0.jpg', 'F'),
(115, 'dapibus est mi', 'Xenos Cervantes', NULL, 'M', 'ad tempus sollicitudin volutpat adipiscing imperdiet faucibus eros tempor Ut odio consequat taciti pellentesque pharetra facilisis tristique Aliquam', 'Burke Serrano', 1485, 'S', 'EUZ546', 6, 9, 32, '0.jpg', 'T'),
(116, 'lacus aliquam tristique', 'Jamal Zimmerman', NULL, 'S', 'risus montes parturient senectus augue sapien rhoncus interdum erat', 'Aidan Evans', 1162, 'S', 'XOE192', 2, 9, 31, '0.jpg', 'T'),
(117, 'ullamcorper commodo viverra Integer Mauris Ut elit elementum elementum fringilla eu inceptos mattis', 'Shea Landry', NULL, 'M', 'diam penatibus condimentum ullamcorper mollis luctus dictum malesuada felis lacus ridiculus', 'Kylie Lindsey', 1410, 'S', 'HOE528', 2, 2, 68, '0.jpg', 'T'),
(118, 'sociosqu facilisi hendrerit elit', 'Yael Lara', NULL, 'S', 'facilisi nunc Fusce ut hymenaeos dapibus venenatis consequat Mauris eleifend Praesent tempus Curae', 'Mia Hobbs', 1035, 'F', 'YXH116', 2, 2, 71, '0.jpg', 'T'),
(119, 'Ut velit quis dui nec id commodo volutpat cubilia turpis dignissim Vestibulum pellentesque penatibus suscipit', 'Philip Cunningham', NULL, 'C', 'fringilla pretium', 'Zeph Bender', 1657, 'S', 'ZMB356', 1, 2, 24, '0.jpg', 'F'),
(120, 'blandit felis', 'Gary Sparks', NULL, 'M', 'commodo Aenean', 'Hadley Rowe', 1003, 'F', 'APA362', 3, 3, 39, '0.jpg', 'T'),
(121, 'facilisi', 'Shafira Kemp', NULL, 'T', 'In nisi ac Nullam torquent Ut netus dis vestibulum Donec inceptos at elementum nonummy per dictum non ac', 'Callie Valentine', 1732, 'F', 'HYI878', 3, 3, 20, '0.jpg', 'F'),
(122, 'OH MY BOOK!', 'OH MY BOOK AUTHOR', NULL, 'B', 'A book version of the very famous OH MY SERIES. It will make you feel that everything in this world is worth saying OH MY!', NULL, 2013, 'S', 'OHM001', 1, 1, 0, '0.jpg', 'F'),
(123, 'OH MY JOURNAL!', 'OH MY JOURNAL WRITER', NULL, 'J', 'A journal version of the very famous OH MY SERIES. It will make you feel that everything in this world is worth saying OH MY!', NULL, NULL, 'S', 'OHM001', 1, 1, 0, '0.jpg', 'F'),
(124, 'OH MY MAGAZINE!', 'OH MY Magazine Writer', NULL, 'M', 'A magazine version of the very famous OH MY SERIES. It will make you feel that everything in this world is worth saying OH MY!', NULL, NULL, 'S', 'OHM001', 1, 1, 0, '0.jpg', 'F'),
(125, 'OH MY THESIS!', 'OH MY Graduating Student', NULL, 'T', 'A thesis version of the very famous OH MY SERIES. It will make you feel that everything in this world is worth saying OH MY!', NULL, NULL, 'S', 'OHM001', 1, 1, 0, '0.jpg', 'F'),
(126, 'OH MY CD!', 'OH MY CD Pirate', NULL, 'C', 'A CD version of the very famous OH MY SERIES. It will make you feel that everything in this world is worth saying OH MY!', NULL, NULL, 'S', 'OHM001', 1, 1, 0, '0.jpg', 'F'),
(127, 'OH MY SPECIAL PROBLEM!', 'OH MY Problematic Person', NULL, 'S', 'A Special Problem version of the very famous OH MY SERIES. It will make you feel that everything in this world is worth saying OH MY!', NULL, NULL, 'S', 'OHM001', 1, 1, 0, '0.jpg', 'F'),
(128, 'IEEE Cloud Computing', 'Jack Moffitt and Fred Daoud', NULL, 'M', 'Be up-to-date on the latest in emerging technologies', NULL, NULL, 'S', 'CS100', 1, 1, 0, '0.jpg', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `reference_material_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `user_type` char(1) NOT NULL,
  `waitlist_rank` int(2) DEFAULT NULL,
  `date_waitlisted` date DEFAULT NULL,
  `date_reserved` date DEFAULT NULL,
  `reservation_due_date` date DEFAULT NULL,
  `date_borrowed` date DEFAULT NULL,
  `borrow_due_date` date DEFAULT NULL,
  `date_returned` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `employee_number` varchar(9) DEFAULT NULL,
  `student_number` varchar(10) DEFAULT NULL,
  `last_name` varchar(32) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `middle_name` varchar(32) DEFAULT NULL,
  `user_type` char(1) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `college_address` varchar(150) NOT NULL,
  `email_address` varchar(60) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `borrow_limit` int(1) DEFAULT NULL,
  `waitlist_limit` int(1) DEFAULT NULL,
  `college` varchar(6) DEFAULT NULL,
  `degree` varchar(12) DEFAULT NULL,
  `profile_picture` varchar(20) NOT NULL DEFAULT '0.jpg',
  `is_activated` char(1) NOT NULL DEFAULT 'T',
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_number` (`employee_number`,`student_number`,`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=201 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `employee_number`, `student_number`, `last_name`, `first_name`, `middle_name`, `user_type`, `username`, `password`, `college_address`, `email_address`, `contact_number`, `borrow_limit`, `waitlist_limit`, `college`, `degree`, `profile_picture`, `is_activated`) VALUES
(1, '000000001', NULL, 'Kimhoko', 'Erika', 'Cordova', 'A', 'administrator1', '200ceb26807d6bf99fd6f4f0d1ca54d4', 'Grove Street Los Banos Laguna', 'eckimhoko@gmail.com', '09058465816', NULL, NULL, NULL, NULL, '0.jpg', 'T'),
(2, '000000002', NULL, 'Jolloso', 'Leona', 'Jintalan', 'A', 'administrator2', '200ceb26807d6bf99fd6f4f0d1ca54d4', 'Men Residence Hall Dorm', 'maejolloso@gmail.com', '09157231682', NULL, NULL, NULL, NULL, '0.jpg', 'F'),
(3, '000000003', NULL, 'Cruz', 'kenneth', 'Cruz', 'A', 'administrator3', '200ceb26807d6bf99fd6f4f0d1ca54d4', 'Ilags Compound', 'kencruz07@gmail.com', '09064367611', NULL, NULL, NULL, NULL, '0.jpg', 'T'),
(4, '000000004', NULL, 'Balucating', 'Harland', 'Balucating', 'A', 'administrator4', '200ceb26807d6bf99fd6f4f0d1ca54d4', 'Groove Street Los Banos Laguna', 'harland@gmail.com', '09076547654', NULL, NULL, NULL, NULL, '0.jpg', 'T'),
(5, '000000005', NULL, 'Royo', 'Jeezle', 'Irish', 'A', 'administrator5', '200ceb26807d6bf99fd6f4f0d1ca54d4', 'La Ville', 'jeezleroyo@gmail.com', '09174976990', NULL, NULL, NULL, NULL, '0.jpg', 'T'),
(6, '000000011', NULL, 'Lee', 'Joanne', 'Evidor', 'L', 'librarian1', '35fa1bcb6fbfa7aa343aa7f253507176', 'Groove Street Los Banos Laguna', 'jelee@gmail.com', '09065757443', NULL, NULL, NULL, NULL, '0.jpg', 'T'),
(7, '000000012', NULL, 'Morada', 'Joar', 'Isaac', 'L', 'librarian2', '35fa1bcb6fbfa7aa343aa7f253507176', 'De Marces Compound', 'morada@gmail.com', '09065432765', NULL, NULL, NULL, NULL, '0.jpg', 'F'),
(8, '000000013', NULL, 'Kimhoko', 'Kim', 'Cordova', 'L', 'librarian3', '35fa1bcb6fbfa7aa343aa7f253507176', 'Mareha Residence Hall', 'kimVincent09@gmail.com', '09065754323', NULL, NULL, NULL, NULL, '0.jpg', 'T'),
(9, '000000014', NULL, 'Rugas', 'Beverly', 'Ruperez', 'L', 'librarian4', '35fa1bcb6fbfa7aa343aa7f253507176', 'Vet Med Residence Hall', 'rugas@gmail.com', '09065753223', NULL, NULL, NULL, NULL, '0.jpg', 'T'),
(10, '000000015', NULL, 'Padernal', 'Zara', 'Evidor', 'L', 'librarian5', '35fa1bcb6fbfa7aa343aa7f253507176', 'Batong Malake Hall', 'zel@gmail.com', '09065654223', NULL, NULL, NULL, NULL, '0.jpg', 'F'),
(11, '000000016', NULL, 'Ruperez', 'Carlo', 'Cordova', 'L', 'librarian6', '35fa1bcb6fbfa7aa343aa7f253507176', 'ATI Residence Hall', 'ccruperez@gmail.com', '09065654765', NULL, NULL, NULL, NULL, '0.jpg', 'T'),
(12, '000000017', NULL, 'Cordova', 'Remedios', 'Barrientos', 'L', 'librarian7', '35fa1bcb6fbfa7aa343aa7f253507176', 'ATI Residence Hall', 'remedios@gmail.com', '09056543211', NULL, NULL, NULL, NULL, '0.jpg', 'T'),
(13, '000000018', NULL, 'Vargas', 'Emman', 'Villapando', 'L', 'librarian8', '35fa1bcb6fbfa7aa343aa7f253507176', 'Catalan Compund', 'Vargas07@gmail.com', '09012343212', NULL, NULL, NULL, NULL, '0.jpg', 'T'),
(14, '000000019', NULL, 'Arcilla', 'Bernadette', 'Lariza', 'L', 'librarian9', '35fa1bcb6fbfa7aa343aa7f253507176', 'Raymundo Compound', 'arcilla@gmail.com', '09065432123', NULL, NULL, NULL, NULL, '0.jpg', 'T'),
(15, '000000021', NULL, 'Alano', 'James', 'Andal', 'L', 'librarian10', '35fa1bcb6fbfa7aa343aa7f253507176', 'White House', 'alano@gmail.com', '09067543654', NULL, NULL, NULL, NULL, '0.jpg', 'F'),
(16, '000000022', NULL, 'Andal', 'Feliz', 'Pamittan', 'L', 'librarian11', '35fa1bcb6fbfa7aa343aa7f253507176', 'Batong Malake Los Banos Laguna', 'flapamittan@gmail.com', '09067564654', NULL, NULL, NULL, NULL, '0.jpg', 'T'),
(17, '000000023', NULL, 'Aguila', 'Roinand', 'Baral', 'L', 'librarian12', '35fa1bcb6fbfa7aa343aa7f253507176', 'White House Compound', 'Aguila19@gmail.com', '09067564124', NULL, NULL, NULL, NULL, '0.jpg', 'T'),
(18, '000000024', NULL, 'Calayag', 'Maureen', 'Abogado', 'L', 'librarian13', '35fa1bcb6fbfa7aa343aa7f253507176', 'White House Compound', 'calayag@gmail.com', '09067564124', NULL, NULL, NULL, NULL, '0.jpg', 'F'),
(19, '000000025', NULL, 'Bulaong', 'Abby', 'Abogado', 'L', 'librarian14', '35fa1bcb6fbfa7aa343aa7f253507176', 'White House Compound', 'bulaong@gmail.com', '09067564124', NULL, NULL, NULL, NULL, '0.jpg', 'T'),
(20, '000000027', NULL, 'Almonte', 'Conrad', 'James', 'L', 'librarian15', '35fa1bcb6fbfa7aa343aa7f253507176', 'White House Compound', 'Almonte@gmail.com', '09067564124', NULL, NULL, NULL, NULL, '0.jpg', 'T'),
(21, '100000000', NULL, 'Samaniego', 'Kim', 'A', 'F', 'faculty1', 'd561c7c03c1f2831904823a95835ff5f', 'Los Banos', 'kim@gmail.com', '09100000001', 3, 3, NULL, NULL, '0.jpg', 'T'),
(22, '100000001', NULL, 'Recario', 'Reginald', 'B', 'F', 'faculty2', 'd561c7c03c1f2831904823a95835ff5f', 'Los Banos', 'reggie@gmail.com', '09111111111', 3, 3, NULL, NULL, '0.jpg', 'T'),
(23, '100000002', NULL, 'Danila', 'Lailani', 'C', 'F', 'faculty3', 'd561c7c03c1f2831904823a95835ff5f', 'Los Banos', 'lanie@gmail.com', '09123412341', 3, 3, NULL, NULL, '0.jpg', 'T'),
(24, '100000003', NULL, 'Manalang', 'Martee', 'A', 'F', 'faculty4', 'd561c7c03c1f2831904823a95835ff5f', 'Los Banos', 'martee@gmail.com', '09123412342', 3, 3, NULL, NULL, '0.jpg', 'F'),
(25, '100000004', NULL, 'Lo', 'John', 'C', 'F', 'faculty5', 'd561c7c03c1f2831904823a95835ff5f', 'Los Banos', 'john@gmail.com', '09123412340', 3, 3, NULL, NULL, '0.jpg', 'T'),
(26, '100000005', NULL, 'Mariano', 'Vladimir', 'A', 'F', 'faculty6', 'd561c7c03c1f2831904823a95835ff5f', 'Los Banos', 'vlad@gmail.com', '09100000012', 3, 3, NULL, NULL, '0.jpg', 'T'),
(27, '100000006', NULL, 'Aguila', 'Joy', 'A', 'F', 'faculty7', 'd561c7c03c1f2831904823a95835ff5f', 'Los Banos', 'joy@gmail.com', '09100000123', 3, 3, NULL, NULL, '0.jpg', 'T'),
(28, '100000007', NULL, 'Deeobles', 'Yvette', 'B', 'F', 'faculty8', 'd561c7c03c1f2831904823a95835ff5f', 'Laguna', 'yvette@gmail.com', '09100000111', 3, 3, NULL, NULL, '0.jpg', 'F'),
(29, '100000008', NULL, 'Peralta', 'Kei', 'B', 'F', 'faculty9', 'd561c7c03c1f2831904823a95835ff5f', 'Laguna', 'kei@gmail.com', '09100000112', 3, 3, NULL, NULL, '0.jpg', 'T'),
(30, '100000009', NULL, 'Bulalacao', 'Rommel', 'C', 'F', 'faculty10', 'd561c7c03c1f2831904823a95835ff5f', 'Laguna', 'rommel@gmail.com', '09926272711', 3, 3, NULL, NULL, '0.jpg', 'F'),
(31, NULL, '2013-12621', 'Ordillano', 'Janet', 'P', 'S', 'student1', 'cd73502828457d15655bbd7a63fb0bc8', 'Los Banos', 'janet@gmail.com', '09262738343', 3, 3, 'CAS', 'BSCS', '0.jpg', 'T'),
(32, NULL, '2012-16319', 'Agbay', 'Camille', 'A', 'S', 'student2', 'cd73502828457d15655bbd7a63fb0bc8', 'Laguna', 'camille@gmail.com', '09100000121', 3, 3, 'CA', 'BSA', '0.jpg', 'F'),
(33, NULL, '2011-19602', 'Linga', 'James', 'T', 'S', 'student3', 'cd73502828457d15655bbd7a63fb0bc8', 'Los Banos', 'james@gmail.com', '09102700111', 3, 3, 'CA-CAS', 'BSAC', '0.jpg', 'T'),
(34, NULL, '2008-14852', 'Olano', 'Emmanuel', 'M', 'S', 'student4', 'cd73502828457d15655bbd7a63fb0bc8', 'Los Banos', 'emman@gmail.com', '09108520111', 3, 3, 'CA', 'BSA', '0.jpg', 'T'),
(35, NULL, '2011-18592', 'Marbello', 'Ella', 'S', 'S', 'student5', 'cd73502828457d15655bbd7a63fb0bc8', 'Los Banos', 'ella@gmail.com', '09100084311', 3, 3, 'CA', 'BSFT', '0.jpg', 'T'),
(36, NULL, '2006-93752', 'Mendoza', 'Zyrille', 'B', 'S', 'student6', 'cd73502828457d15655bbd7a63fb0bc8', 'Los Banos', 'zy@gmail.com', '09100230111', 3, 3, 'CEM', 'BSABM', '0.jpg', 'F'),
(37, NULL, '2011-12421', 'Lasac', 'Kristine', 'A', 'S', 'student7', 'cd73502828457d15655bbd7a63fb0bc8', 'Laguna', 'kris@gmail.com', '09230050012', 3, 3, 'CEAT', 'BSIE', '0.jpg', 'T'),
(38, NULL, '2008-18592', 'Bernardo', 'Bernadeth', 'A', 'S', 'student8', 'cd73502828457d15655bbd7a63fb0bc8', 'Los Banos', 'bern@gmail.com', '09436023012', 3, 3, 'CHE', 'BSN', '0.jpg', 'T'),
(39, NULL, '2008-14921', 'Flores', 'Sabel', 'B', 'S', 'student9', 'cd73502828457d15655bbd7a63fb0bc8', 'Los Banos', 'bel@gmail.com', '09104362711', 3, 3, 'CDC', 'BSDC', '0.jpg', 'F'),
(40, NULL, '2009-19502', 'Ricohermoso', 'Joselle', 'C', 'S', 'student10', 'cd73502828457d15655bbd7a63fb0bc8', 'Los Banos', 'joselle@gmail.com', '09326000111', 3, 3, 'CVM', 'DVM', '0.jpg', 'T'),
(41, NULL, '2012-18602', 'Sy', 'Christian', 'A', 'S', 'student11', 'cd73502828457d15655bbd7a63fb0bc8', 'Laguna', 'chris@gmail.com', '09480000112', 3, 3, 'GS', 'MSCS', '0.jpg', 'T'),
(42, '730629706', NULL, 'Bradshaw', 'Quinn', 'Guerrero', 'A', 'administrator6', '200ceb26807d6bf99fd6f4f0d1ca54d4', '51003 West Virgin Islands, British Ave.', 'Vernon@quam.edu', '09291897032', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(43, '190712869', NULL, 'Macdonald', 'Graiden', 'Mckinney', 'A', 'administrator7', '200ceb26807d6bf99fd6f4f0d1ca54d4', '35766 North Littleton Way', 'Connor@Duis.edu', '09920392915', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(44, '820223535', NULL, 'Salas', 'Rose', 'Stephens', 'F', 'faculty11', 'd561c7c03c1f2831904823a95835ff5f', '83970 West Nicaragua Ln.', 'Charles@nisi.edu', '09356171887', 3, 5, 'NULL', 'NULL', '0.jpg', 'F'),
(45, '069149282', NULL, 'Contreras', 'Kay', 'Newton', 'A', 'administrator8', '200ceb26807d6bf99fd6f4f0d1ca54d4', '26282 North Detroit Way', 'Aidan@placerat.edu', '09096095651', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(46, '758417562', NULL, 'Conway', 'Madaline', 'Miller', 'A', 'administrator9', '200ceb26807d6bf99fd6f4f0d1ca54d4', '93855 West Chad Blvd.', 'Barbara@penatibus.net', '09239232080', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(47, '694117054', NULL, 'Schultz', 'Hoyt', 'Riley', 'A', 'administrator10', '200ceb26807d6bf99fd6f4f0d1ca54d4', '14711  Australia Way', 'Ursula@sit.org', '09976463068', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'T'),
(48, '205481366', NULL, 'Huffman', 'Lee', 'Mckee', 'F', 'faculty12', 'd561c7c03c1f2831904823a95835ff5f', '67438  Anguilla Ct.', 'Ginger@taciti.org', '09187482137', 3, 5, 'NULL', 'NULL', '0.jpg', 'F'),
(49, '335801652', NULL, 'Morse', 'Risa', 'Oneal', 'F', 'faculty13', 'd561c7c03c1f2831904823a95835ff5f', '81739 North Glendora St.', 'Chandler@nunc.org', '09130915328', 3, 5, 'NULL', 'NULL', '0.jpg', 'T'),
(50, '830865395', NULL, 'Mcclain', 'Luke', 'Travis', 'F', 'faculty14', 'd561c7c03c1f2831904823a95835ff5f', '62987 North Morocco Ln.', 'Audrey@ad.org', '09905965854', 3, 5, 'NULL', 'NULL', '0.jpg', 'T'),
(51, '840129544', NULL, 'Keith', 'Armando', 'Edwards', 'L', 'librarian16', '35fa1bcb6fbfa7aa343aa7f253507176', '76127 North Hudson Ct.', 'Trevor@auctor.us', '09815258609', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(52, '510229725', NULL, 'Roy', 'Hashim', 'Woods', 'A', 'administrator11', '200ceb26807d6bf99fd6f4f0d1ca54d4', '88204 West Barbados St.', 'Hop@ipsum.com', '09170747529', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(53, '278846746', NULL, 'Sampson', 'Odessa', 'Strickland', 'F', 'faculty15', 'd561c7c03c1f2831904823a95835ff5f', '43153 South Cape Verde Ct.', 'Lara@pharetra.net', '09100721294', 3, 5, 'NULL', 'NULL', '0.jpg', 'T'),
(54, '556672033', NULL, 'Hernandez', 'Cain', 'Dickson', 'F', 'faculty16', 'd561c7c03c1f2831904823a95835ff5f', '4600 North Korea, Republic of Ln.', 'TaShya@fames.net', '09791009959', 3, 5, 'NULL', 'NULL', '0.jpg', 'T'),
(55, '555744532', NULL, 'Callahan', 'Peter', 'Morgan', 'A', 'administrator12', '200ceb26807d6bf99fd6f4f0d1ca54d4', '84700  Anguilla Way', 'Zephania@Aliquam.com', '09690722881', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'T'),
(56, '351513621', NULL, 'Clay', 'Rae', 'Trujillo', 'A', 'administrator13', '200ceb26807d6bf99fd6f4f0d1ca54d4', '82162 North Belarus St.', 'Russell@convallis.com', '09454685644', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'T'),
(57, '418175343', NULL, 'Leblanc', 'Mannix', 'Carpenter', 'A', 'administrator14', '200ceb26807d6bf99fd6f4f0d1ca54d4', '95744  Svalbard and Jan Mayen Ave.', 'Adria@magnis.com', '09358986595', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(58, '900334106', NULL, 'Marshall', 'Keefe', 'Ferrell', 'A', 'administrator15', '200ceb26807d6bf99fd6f4f0d1ca54d4', '92126 West Christmas Island Way', 'Zachery@hymenaeos.net', '09185744432', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'T'),
(59, '861687140', NULL, 'Cabrera', 'Adara', 'Mcpherson', 'L', 'librarian17', '35fa1bcb6fbfa7aa343aa7f253507176', '24206 North Egypt St.', 'Amela@feugiat.us', '09497387442', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(60, '346664194', NULL, 'Gilbert', 'Judah', 'Browning', 'F', 'faculty17', 'd561c7c03c1f2831904823a95835ff5f', '16208 North Jeffersonville St.', 'Brenden@inceptos.edu', '09236932760', 3, 5, 'NULL', 'NULL', '0.jpg', 'F'),
(61, '900290832', NULL, 'Cross', 'Jenette', 'Richmond', 'F', 'faculty18', 'd561c7c03c1f2831904823a95835ff5f', '7459 South Timor-leste Ave.', 'Adele@primis.org', '09622140730', 3, 5, 'NULL', 'NULL', '0.jpg', 'T'),
(62, '260383001', NULL, 'Humphrey', 'Helen', 'Golden', 'A', 'administrator16', '200ceb26807d6bf99fd6f4f0d1ca54d4', '2126 East Alpharetta Blvd.', 'Kirby@gravida.com', '09028656418', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'T'),
(63, '945910277', NULL, 'White', 'John', 'Russo', 'F', 'faculty19', 'd561c7c03c1f2831904823a95835ff5f', '31208 East Sri Lanka Ln.', 'Bernard@dui.org', '09414834388', 3, 5, 'NULL', 'NULL', '0.jpg', 'F'),
(64, '089617839', NULL, 'Farley', 'Matthew', 'Valentine', 'L', 'librarian18', '35fa1bcb6fbfa7aa343aa7f253507176', '40213 North China Blvd.', 'Cyrus@sociis.us', '09260037660', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'T'),
(65, '140039654', NULL, 'Fletcher', 'Melyssa', 'Odonnell', 'A', 'administrator17', '200ceb26807d6bf99fd6f4f0d1ca54d4', '59844 North China Ln.', 'Graham@lorem.org', '09625610083', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'T'),
(66, '677837297', NULL, 'Richmond', 'Kieran', 'Bailey', 'L', 'librarian19', '35fa1bcb6fbfa7aa343aa7f253507176', '80710 West Ocean City Way', 'Amelia@vitae.edu', '09707260810', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(67, '866871957', NULL, 'Collins', 'Virginia', 'Bullock', 'A', 'administrator18', '200ceb26807d6bf99fd6f4f0d1ca54d4', '55303 West Belgium St.', 'Upton@congue.org', '09155478676', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'T'),
(68, '631210152', NULL, 'Murphy', 'Stella', 'Douglas', 'L', 'librarian20', '35fa1bcb6fbfa7aa343aa7f253507176', '77925  Armenia Way', 'Ian@blandit.org', '09479335467', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(69, '445485906', NULL, 'Odonnell', 'Malachi', 'Carroll', 'L', 'librarian21', '35fa1bcb6fbfa7aa343aa7f253507176', '55460 East Comoros Way', 'Clayton@mus.gov', '09989010187', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'T'),
(70, '077021132', NULL, 'Pugh', 'Edan', 'Sutton', 'L', 'librarian22', '35fa1bcb6fbfa7aa343aa7f253507176', '11458 South Kyrgyzstan Ln.', 'Nora@In.us', '09702991693', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'T'),
(71, '132258010', NULL, 'Riddle', 'Finn', 'Soto', 'A', 'administrator19', '200ceb26807d6bf99fd6f4f0d1ca54d4', '38161  Bismarck Blvd.', 'Ashton@hymenaeos.net', '09749472622', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(72, '426171908', NULL, 'Clements', 'Neve', 'Elliott', 'A', 'administrator20', '200ceb26807d6bf99fd6f4f0d1ca54d4', '29192 North Bouvet Island Blvd.', 'Alice@pellentesque.edu', '09681393407', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(73, '751986089', NULL, 'Owens', 'Ciara', 'Torres', 'L', 'librarian23', '35fa1bcb6fbfa7aa343aa7f253507176', '76068 North Tajikistan Ct.', 'Colorado@hendrerit.org', '09878437134', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(74, '934650550', NULL, 'Beach', 'Audra', 'Nguyen', 'L', 'librarian24', '35fa1bcb6fbfa7aa343aa7f253507176', '76624 South Gastonia Way', 'Stacy@felis.edu', '09855529536', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(75, '552407528', NULL, 'Clark', 'Erasmus', 'Tyson', 'L', 'librarian25', '35fa1bcb6fbfa7aa343aa7f253507176', '47276 East Bethlehem Ln.', 'Damian@turpis.org', '09308478925', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(76, '962292959', NULL, 'Williamson', 'Fredericka', 'Gilmore', 'A', 'administrator21', '200ceb26807d6bf99fd6f4f0d1ca54d4', '75386 South Bhutan St.', 'Mannix@ultrices.org', '09320919548', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(77, '098712973', NULL, 'Stafford', 'Sandra', 'Soto', 'F', 'faculty20', 'd561c7c03c1f2831904823a95835ff5f', '37377 South Burundi Way', 'Tatum@elit.us', '09727533910', 3, 5, 'NULL', 'NULL', '0.jpg', 'F'),
(78, '566410858', NULL, 'Glass', 'Fletcher', 'Hogan', 'F', 'faculty21', 'd561c7c03c1f2831904823a95835ff5f', '11163 East Brunei Darussalam Way', 'Byron@ligula.net', '09970532927', 3, 5, 'NULL', 'NULL', '0.jpg', 'T'),
(79, '174856778', NULL, 'Ryan', 'Jillian', 'Peck', 'A', 'administrator22', '200ceb26807d6bf99fd6f4f0d1ca54d4', '94946 North Barbados Way', 'Doris@eleifend.org', '09245895205', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(80, '911350634', NULL, 'Wright', 'Zena', 'Mullins', 'L', 'librarian26', '35fa1bcb6fbfa7aa343aa7f253507176', '52723 West Marietta St.', 'Wang@hendrerit.edu', '09468213372', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(81, '242973676', NULL, 'Stephenson', 'Kai', 'Maynard', 'F', 'faculty22', 'd561c7c03c1f2831904823a95835ff5f', '27718 East Cocos (Keeling) Islands Blvd.', 'Haley@parturient.gov', '09671688888', 3, 5, 'NULL', 'NULL', '0.jpg', 'F'),
(82, '090234415', NULL, 'Wagner', 'Rae', 'Payne', 'A', 'administrator23', '200ceb26807d6bf99fd6f4f0d1ca54d4', '59348 South Central African Republic Blvd.', 'Tara@pulvinar.edu', '09530475004', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(83, '763965480', NULL, 'Lindsay', 'Anthony', 'Pierce', 'A', 'administrator24', '200ceb26807d6bf99fd6f4f0d1ca54d4', '98497  Myanmar Way', 'Lael@mattis.edu', '09654066968', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'T'),
(84, '690069177', NULL, 'Jefferson', 'Amy', 'Monroe', 'F', 'faculty23', 'd561c7c03c1f2831904823a95835ff5f', '40746 North Argentina Ct.', 'Shannon@volutpat.us', '09150206415', 3, 5, 'NULL', 'NULL', '0.jpg', 'T'),
(85, '688574303', NULL, 'Hurst', 'Idona', 'Harding', 'L', 'librarian27', '35fa1bcb6fbfa7aa343aa7f253507176', '67179 North Kyrgyzstan St.', 'Ainsley@Cum.edu', '09161770607', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'T'),
(86, '717354874', NULL, 'Gray', 'Kermit', 'Mcfarland', 'F', 'faculty24', 'd561c7c03c1f2831904823a95835ff5f', '27389 South Uzbekistan Way', 'Mark@neque.net', '09286048325', 3, 5, 'NULL', 'NULL', '0.jpg', 'F'),
(87, '413300039', NULL, 'Burch', 'Oliver', 'Villarreal', 'A', 'administrator25', '200ceb26807d6bf99fd6f4f0d1ca54d4', '12720 South Belgium Way', 'Amal@enim.org', '09940429327', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(88, '549098563', NULL, 'Carver', 'Logan', 'Reilly', 'A', 'administrator26', '200ceb26807d6bf99fd6f4f0d1ca54d4', '85387 South Belpre St.', 'Francis@In.com', '09137858295', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(89, '374468729', NULL, 'Spence', 'Isabelle', 'Holloway', 'F', 'faculty25', 'd561c7c03c1f2831904823a95835ff5f', '56924 West Brunei Darussalam Way', 'Jin@sit.com', '09968085081', 3, 5, 'NULL', 'NULL', '0.jpg', 'T'),
(90, '568068676', NULL, 'Tyson', 'Timothy', 'Maddox', 'A', 'administrator27', '200ceb26807d6bf99fd6f4f0d1ca54d4', '61792 East Canada Ln.', 'Hakeem@Vestibulum.org', '09003405573', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(91, '971028919', NULL, 'Donovan', 'Rae', 'Mckinney', 'L', 'librarian28', '35fa1bcb6fbfa7aa343aa7f253507176', '2071 South Nauru Ln.', 'Sonia@ac.net', '09307378694', NULL, NULL, 'NULL', 'NULL', '0.jpg', 'F'),
(92, NULL, '2011-20568', 'Medina', 'Carson', 'Graham', 'S', 'student12', 'cd73502828457d15655bbd7a63fb0bc8', '84123 North Brunei Darussalam Ln.', 'Bianca@Phasellus.org', '09825313970', 3, 5, 'CAS', 'BSCS', '0.jpg', 'T'),
(93, NULL, '2010-11528', 'Hardin', 'Mohammad', 'Sullivan', 'S', 'student13', 'cd73502828457d15655bbd7a63fb0bc8', '59483 North Bowie Ln.', 'Oscar@imperdiet.net', '09389546133', 3, 5, 'CAS', 'BSSTAT', '0.jpg', 'F'),
(94, NULL, '2013-23663', 'Wright', 'Irene', 'Pruitt', 'S', 'student14', 'cd73502828457d15655bbd7a63fb0bc8', '40819 East Myanmar St.', 'Jacob@orci.us', '09756921853', 3, 5, 'CAS', 'BSCHEM', '0.jpg', 'T'),
(95, NULL, '2013-33592', 'Byers', 'Keelie', 'Leonard', 'S', 'student15', 'cd73502828457d15655bbd7a63fb0bc8', '47817 East Cocos (Keeling) Islands Ct.', 'Talon@Cras.org', '09236655764', 3, 5, 'CAS', 'BACA', '0.jpg', 'F'),
(96, NULL, '2010-66713', 'Holcomb', 'Chaney', 'Brown', 'S', 'student16', 'cd73502828457d15655bbd7a63fb0bc8', '43782 West Tonga Blvd.', 'Brynn@Nunc.org', '09105719999', 3, 5, 'CAS', 'BSCHEM', '0.jpg', 'F'),
(97, NULL, '2008-18099', 'Golden', 'Jessamine', 'Downs', 'S', 'student17', 'cd73502828457d15655bbd7a63fb0bc8', '5010 South Blacksburg Ct.', 'Cassandra@et.net', '09730225458', 3, 5, 'CAS', 'BSPHLO', '0.jpg', 'T'),
(98, NULL, '2006-28528', 'Ingram', 'Avram', 'Horne', 'S', 'student18', 'cd73502828457d15655bbd7a63fb0bc8', '34022 West Afghanistan St.', 'Alvin@tempor.edu', '09171926288', 3, 5, 'CAS', 'BSCHEM', '0.jpg', 'T'),
(99, NULL, '2008-24092', 'Page', 'Ivan', 'Hester', 'S', 'student19', 'cd73502828457d15655bbd7a63fb0bc8', '87973 East Minnetonka Way', 'Wanda@commodo.us', '09037599930', 3, 5, 'CAS', 'BSCS', '0.jpg', 'T'),
(100, NULL, '2011-07012', 'Ruiz', 'Kaye', 'Cortez', 'S', 'student20', 'cd73502828457d15655bbd7a63fb0bc8', '6699 North Barbados St.', 'Donna@magnis.gov', '09942934899', 3, 5, 'CAS', 'BSPHLO', '0.jpg', 'T'),
(101, NULL, '2006-61232', 'Stanton', 'Lucas', 'Cotton', 'S', 'student21', 'cd73502828457d15655bbd7a63fb0bc8', '11889 East Antigua and Barbuda Blvd.', 'Evan@ipsum.net', '09860813094', 3, 5, 'CAS', 'BACA', '0.jpg', 'T'),
(102, NULL, '2009-17085', 'Holder', 'Frances', 'Villarreal', 'S', 'student22', 'cd73502828457d15655bbd7a63fb0bc8', '60164 North Canada Ave.', 'Vaughan@erat.gov', '09281643013', 3, 5, 'CAS', 'BSSOC', '0.jpg', 'F'),
(103, NULL, '2012-51553', 'Barlow', 'Emma', 'Moreno', 'S', 'student23', 'cd73502828457d15655bbd7a63fb0bc8', '15310 South Myanmar Blvd.', 'Clinton@Proin.gov', '09331675531', 3, 5, 'CAS', 'BSMATH', '0.jpg', 'T'),
(104, NULL, '2006-95194', 'Lowery', 'Talon', 'Zimmerman', 'S', 'student24', 'cd73502828457d15655bbd7a63fb0bc8', '86115 North Tajikistan Way', 'Sonia@Vestibulum.gov', '09236312818', 3, 5, 'CAS', 'BSPHLO', '0.jpg', 'F'),
(105, NULL, '2006-18706', 'Solis', 'Jaden', 'Valenzuela', 'S', 'student25', 'cd73502828457d15655bbd7a63fb0bc8', '43514  Slovenia Ln.', 'Ayanna@quam.edu', '09202859541', 3, 5, 'CAS', 'BSCS', '0.jpg', 'F'),
(106, NULL, '2012-66501', 'Kemp', 'Alyssa', 'Abbott', 'S', 'student26', 'cd73502828457d15655bbd7a63fb0bc8', '38079 North Belarus Blvd.', 'Teegan@hymenaeos.com', '09239793931', 3, 5, 'CAS', 'BSBIO', '0.jpg', 'T'),
(107, NULL, '2010-57472', 'Nielsen', 'Deacon', 'Hernandez', 'S', 'student27', 'cd73502828457d15655bbd7a63fb0bc8', '16008  Canada Ave.', 'Alice@pellentesque.net', '09509839081', 3, 5, 'CAS', 'BACA', '0.jpg', 'F'),
(108, NULL, '2009-60559', 'Valencia', 'Signe', 'Howe', 'S', 'student28', 'cd73502828457d15655bbd7a63fb0bc8', '55299  Everett Ct.', 'Mohammad@quam.us', '09801891078', 3, 5, 'CAS', 'BACA', '0.jpg', 'F'),
(109, NULL, '2011-94918', 'Randolph', 'Isaac', 'Hughes', 'S', 'student29', 'cd73502828457d15655bbd7a63fb0bc8', '7222 North Malaysia St.', 'Paula@ac.us', '09744567515', 3, 5, 'CAS', 'BSBIO', '0.jpg', 'F'),
(110, NULL, '2013-52741', 'Lyons', 'Eleanor', 'Shaw', 'S', 'student30', 'cd73502828457d15655bbd7a63fb0bc8', '98256  Bloomington Ct.', 'Keane@varius.edu', '09744924342', 3, 5, 'CAS', 'BSBIO', '0.jpg', 'F'),
(111, NULL, '2009-28799', 'Riggs', 'Xaviera', 'Curtis', 'S', 'student31', 'cd73502828457d15655bbd7a63fb0bc8', '39750 North Malaysia Way', 'Hiroko@porta.com', '09328888977', 3, 5, 'CAS', 'BSSOC', '0.jpg', 'T');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
