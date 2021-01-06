-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2018 at 04:32 PM
-- Server version: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `site_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pass` char(40) NOT NULL,
  `reg_date` datetime NOT NULL,
  `Title` varchar(10) NOT NULL,
  `Mobile_Number` int(11) NOT NULL,
  `Date_Of_Birth` date NOT NULL,
  `Address1` varchar(50) NOT NULL,
  `Address2` varchar(50) NOT NULL,
  `Town` varchar(20) NOT NULL,
  `County` varchar(20) NOT NULL,
  `Postcode` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `pass`, `reg_date`, `Title`, `Mobile_Number`, `Date_Of_Birth`, `Address1`, `Address2`, `Town`, `County`, `Postcode`) VALUES
(1, 'john', 'smith', 'john@smith', 'a51dda7c7ff50b61eaea0444371f4a6a9301e501', '2018-04-18 20:42:35', '', 0, '0000-00-00', '', '', '', '', ''),
(2, 'a', 'a', '2018-04-10', '3c363836cf4e16666669a25da280a1865c2d2874', '2018-04-20 14:37:34', '', 0, '0000-00-00', '', '', '', '', ''),
(3, 'aaa', 'aa', '1999-11-26', 'a0f1490a20d0211c997b44bc357e1972deab8ae3', '2018-04-20 14:56:55', '', 0, '0000-00-00', '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
