-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 03, 2020 at 01:38 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jmrl_hours`
--

-- --------------------------------------------------------

--
-- Table structure for table `Alert`
--

CREATE TABLE `Alert` (
  `LibID` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `Message` varchar(300) NOT NULL,
  `AlertID` smallint(6) NOT NULL,
  `SameForAll` tinyint(1) NOT NULL,
  `Name` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Alert`
--

INSERT INTO `Alert` (`LibID`, `StartDate`, `EndDate`, `Message`, `AlertID`, `SameForAll`, `Name`) VALUES
(6, '2020-02-29', '2020-03-14', 'Nelson Library is closed for renovations February 29th - March 14th.', 1, 1, 'Nelson Renovation');

-- --------------------------------------------------------

--
-- Table structure for table `Libraries`
--

CREATE TABLE `Libraries` (
  `LibID` int(11) NOT NULL,
  `LibName` varchar(60) NOT NULL DEFAULT '',
  `Main` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Libraries`
--

INSERT INTO `Libraries` (`LibID`, `LibName`, `Main`) VALUES
(1, 'Central Library', 1),
(2, 'Crozet Library', 1),
(3, 'Gordon Avenue Library', 1),
(4, 'Greene County Library', 1),
(5, 'Louisa County Library', 1),
(6, 'Nelson Memorial Library', 1),
(7, 'Northside Library', 1),
(8, 'Scottsville Library', 1),
(9, 'Bookmobile', 1),
(10, 'All Libraries', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Schedule`
--

CREATE TABLE `Schedule` (
  `SchedID` bigint(20) NOT NULL,
  `LibID` int(11) NOT NULL DEFAULT '0',
  `SemID` bigint(20) NOT NULL DEFAULT '0',
  `Day` tinyint(4) NOT NULL DEFAULT '0',
  `OpenTime` time DEFAULT '08:00:00',
  `CloseTime` time DEFAULT '23:30:00',
  `Closed` tinyint(1) NOT NULL DEFAULT '0',
  `Appointment` tinyint(1) NOT NULL DEFAULT '0',
  `Open24` tinyint(1) NOT NULL DEFAULT '0',
  `Notes` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Schedule`
--

INSERT INTO `Schedule` (`SchedID`, `LibID`, `SemID`, `Day`, `OpenTime`, `CloseTime`, `Closed`, `Appointment`, `Open24`) VALUES
(210, 10, 4, 6, '09:00:00', '17:00:00', 0, 0, 0),
(209, 10, 4, 5, '09:00:00', '17:00:00', 0, 0, 0),
(208, 10, 4, 4, '09:00:00', '17:00:00', 0, 0, 0),
(207, 10, 4, 3, '09:00:00', '17:00:00', 0, 0, 0),
(206, 10, 4, 2, '09:00:00', '17:00:00', 0, 0, 0),
(205, 10, 4, 1, '09:00:00', '17:00:00', 0, 0, 0),
(204, 10, 4, 0, '09:00:00', '17:00:00', 0, 0, 0),
(203, 9, 4, 6, '09:00:00', '17:00:00', 0, 1, 0),
(202, 9, 4, 5, '09:00:00', '17:00:00', 0, 1, 0),
(201, 9, 4, 4, '09:00:00', '17:00:00', 0, 1, 0),
(200, 9, 4, 3, '09:00:00', '17:00:00', 0, 1, 0),
(199, 9, 4, 2, '09:00:00', '17:00:00', 0, 1, 0),
(198, 9, 4, 1, '09:00:00', '17:00:00', 0, 1, 0),
(197, 9, 4, 0, '09:00:00', '17:00:00', 0, 1, 0),
(196, 8, 4, 6, '09:00:00', '17:00:00', 0, 0, 0),
(195, 8, 4, 5, '09:00:00', '17:00:00', 0, 0, 0),
(194, 8, 4, 4, '09:00:00', '19:00:00', 0, 0, 0),
(193, 8, 4, 3, '09:00:00', '19:00:00', 0, 0, 0),
(192, 8, 4, 2, '13:00:00', '21:00:00', 0, 0, 0),
(191, 8, 4, 1, '11:00:00', '19:00:00', 0, 0, 0),
(190, 8, 4, 0, '09:00:00', '17:00:00', 1, 0, 0),
(189, 7, 4, 6, '10:00:00', '17:00:00', 0, 0, 0),
(188, 7, 4, 5, '10:00:00', '17:00:00', 0, 0, 0),
(187, 7, 4, 4, '10:00:00', '21:00:00', 0, 0, 0),
(186, 7, 4, 3, '10:00:00', '21:00:00', 0, 0, 0),
(185, 7, 4, 2, '10:00:00', '21:00:00', 0, 0, 0),
(184, 7, 4, 1, '10:00:00', '21:00:00', 0, 0, 0),
(183, 7, 4, 0, '09:00:00', '17:00:00', 1, 0, 0),
(182, 6, 4, 6, '09:30:00', '16:00:00', 0, 0, 0),
(181, 6, 4, 5, '09:30:00', '17:00:00', 0, 0, 0),
(180, 6, 4, 4, '09:30:00', '17:00:00', 0, 0, 0),
(179, 6, 4, 3, '09:30:00', '17:00:00', 0, 0, 0),
(178, 6, 4, 2, '09:30:00', '19:00:00', 0, 0, 0),
(177, 6, 4, 1, '09:30:00', '19:00:00', 0, 0, 0),
(176, 6, 4, 0, '09:30:00', '17:00:00', 1, 0, 0),
(175, 5, 4, 6, '10:00:00', '17:00:00', 0, 0, 0),
(174, 5, 4, 5, '10:00:00', '17:00:00', 0, 0, 0),
(173, 5, 4, 4, '10:00:00', '18:00:00', 0, 0, 0),
(172, 5, 4, 3, '10:00:00', '18:00:00', 0, 0, 0),
(171, 5, 4, 2, '10:00:00', '19:00:00', 0, 0, 0),
(170, 5, 4, 1, '10:00:00', '19:00:00', 0, 0, 0),
(169, 5, 4, 0, '09:00:00', '17:00:00', 1, 0, 0),
(168, 4, 4, 6, '09:00:00', '17:00:00', 0, 0, 0),
(167, 4, 4, 5, '09:00:00', '17:00:00', 0, 0, 0),
(166, 4, 4, 4, '10:00:00', '18:00:00', 0, 0, 0),
(165, 4, 4, 3, '10:00:00', '18:00:00', 0, 0, 0),
(164, 4, 4, 2, '12:00:00', '20:00:00', 0, 0, 0),
(163, 4, 4, 1, '12:00:00', '20:00:00', 0, 0, 0),
(162, 4, 4, 0, '09:00:00', '17:00:00', 1, 0, 0),
(161, 3, 4, 6, '10:00:00', '17:00:00', 0, 0, 0),
(160, 3, 4, 5, '10:00:00', '17:00:00', 0, 0, 0),
(159, 3, 4, 4, '10:00:00', '18:00:00', 0, 0, 0),
(158, 3, 4, 3, '12:00:00', '21:00:00', 0, 0, 0),
(157, 3, 4, 2, '09:00:00', '18:00:00', 0, 0, 0),
(156, 3, 4, 1, '09:00:00', '21:00:00', 0, 0, 0),
(155, 3, 4, 0, '09:00:00', '17:00:00', 1, 0, 0),
(154, 2, 4, 6, '09:00:00', '17:00:00', 0, 0, 0),
(153, 2, 4, 5, '09:00:00', '17:00:00', 0, 0, 0),
(152, 2, 4, 4, '09:00:00', '17:00:00', 0, 0, 0),
(151, 2, 4, 3, '09:00:00', '21:00:00', 0, 0, 0),
(150, 2, 4, 2, '13:00:00', '21:00:00', 0, 0, 0),
(149, 2, 4, 1, '13:00:00', '21:00:00', 0, 0, 0),
(148, 2, 4, 0, '13:00:00', '21:00:00', 1, 0, 0),
(147, 1, 4, 6, '09:00:00', '17:00:00', 0, 0, 0),
(146, 1, 4, 5, '09:00:00', '17:00:00', 0, 0, 0),
(145, 1, 4, 4, '09:00:00', '21:00:00', 0, 0, 0),
(144, 1, 4, 3, '09:00:00', '21:00:00', 0, 0, 0),
(143, 1, 4, 2, '09:00:00', '21:00:00', 0, 0, 0),
(142, 1, 4, 1, '09:00:00', '21:00:00', 0, 0, 0),
(141, 1, 4, 0, '13:00:00', '17:00:00', 1, 0, 0),
(71, 1, 3, 0, '13:00:00', '17:00:00', 0, 0, 0),
(72, 1, 3, 1, '09:00:00', '21:00:00', 0, 0, 0),
(73, 1, 3, 2, '09:00:00', '21:00:00', 0, 0, 0),
(74, 1, 3, 3, '09:00:00', '21:00:00', 0, 0, 0),
(75, 1, 3, 4, '09:00:00', '21:00:00', 0, 0, 0),
(76, 1, 3, 5, '09:00:00', '17:00:00', 0, 0, 0),
(77, 1, 3, 6, '09:00:00', '17:00:00', 0, 0, 0),
(78, 2, 3, 0, '13:00:00', '21:00:00', 1, 0, 0),
(79, 2, 3, 1, '13:00:00', '21:00:00', 0, 0, 0),
(80, 2, 3, 2, '13:00:00', '21:00:00', 0, 0, 0),
(81, 2, 3, 3, '09:00:00', '21:00:00', 0, 0, 0),
(82, 2, 3, 4, '09:00:00', '17:00:00', 0, 0, 0),
(83, 2, 3, 5, '09:00:00', '17:00:00', 0, 0, 0),
(84, 2, 3, 6, '09:00:00', '17:00:00', 0, 0, 0),
(85, 3, 3, 0, '09:00:00', '17:00:00', 1, 0, 0),
(86, 3, 3, 1, '09:00:00', '21:00:00', 0, 0, 0),
(87, 3, 3, 2, '09:00:00', '18:00:00', 0, 0, 0),
(88, 3, 3, 3, '12:00:00', '21:00:00', 0, 0, 0),
(89, 3, 3, 4, '10:00:00', '18:00:00', 0, 0, 0),
(90, 3, 3, 5, '10:00:00', '17:00:00', 0, 0, 0),
(91, 3, 3, 6, '10:00:00', '17:00:00', 0, 0, 0),
(92, 4, 3, 0, '09:00:00', '17:00:00', 1, 0, 0),
(93, 4, 3, 1, '12:00:00', '20:00:00', 0, 0, 0),
(94, 4, 3, 2, '12:00:00', '20:00:00', 0, 0, 0),
(95, 4, 3, 3, '10:00:00', '18:00:00', 0, 0, 0),
(96, 4, 3, 4, '10:00:00', '18:00:00', 0, 0, 0),
(97, 4, 3, 5, '09:00:00', '17:00:00', 0, 0, 0),
(98, 4, 3, 6, '10:00:00', '17:00:00', 0, 0, 0),
(99, 5, 3, 0, '11:00:00', '19:00:00', 1, 0, 0),
(100, 5, 3, 1, '11:00:00', '19:00:00', 0, 0, 0),
(101, 5, 3, 2, '11:00:00', '19:00:00', 0, 0, 0),
(102, 5, 3, 3, '10:00:00', '17:00:00', 0, 0, 0),
(103, 5, 3, 4, '10:00:00', '17:00:00', 0, 0, 0),
(104, 5, 3, 5, '10:00:00', '17:00:00', 0, 0, 0),
(105, 5, 3, 6, '09:00:00', '16:00:00', 0, 0, 0),
(106, 6, 3, 0, '09:30:00', '17:00:00', 1, 0, 0),
(107, 6, 3, 1, '09:30:00', '19:00:00', 0, 0, 0),
(108, 6, 3, 2, '09:30:00', '19:00:00', 0, 0, 0),
(109, 6, 3, 3, '09:30:00', '17:00:00', 0, 0, 0),
(110, 6, 3, 4, '09:30:00', '17:00:00', 0, 0, 0),
(111, 6, 3, 5, '09:30:00', '17:00:00', 0, 0, 0),
(112, 6, 3, 6, '09:30:00', '16:00:00', 0, 0, 0),
(113, 7, 3, 0, '10:00:00', '17:00:00', 1, 0, 0),
(114, 7, 3, 1, '10:00:00', '21:00:00', 0, 0, 0),
(115, 7, 3, 2, '10:00:00', '21:00:00', 0, 0, 0),
(116, 7, 3, 3, '10:00:00', '21:00:00', 0, 0, 0),
(117, 7, 3, 4, '10:00:00', '21:00:00', 0, 0, 0),
(118, 7, 3, 5, '10:00:00', '17:00:00', 0, 0, 0),
(119, 7, 3, 6, '10:00:00', '17:00:00', 0, 0, 0),
(120, 8, 3, 0, '11:00:00', '19:00:00', 1, 0, 0),
(121, 8, 3, 1, '11:00:00', '19:00:00', 0, 0, 0),
(122, 8, 3, 2, '13:00:00', '21:00:00', 0, 0, 0),
(123, 8, 3, 3, '09:00:00', '19:00:00', 0, 0, 0),
(124, 8, 3, 4, '09:00:00', '19:00:00', 0, 0, 0),
(125, 8, 3, 5, '09:00:00', '17:00:00', 0, 0, 0),
(126, 8, 3, 6, '09:00:00', '17:00:00', 0, 0, 0),
(127, 9, 3, 0, '09:00:00', '17:00:00', 0, 0, 0),
(128, 9, 3, 1, '09:00:00', '17:00:00', 0, 0, 0),
(129, 9, 3, 2, '09:00:00', '17:00:00', 0, 0, 0),
(130, 9, 3, 3, '09:00:00', '17:00:00', 0, 0, 0),
(131, 9, 3, 4, '09:00:00', '17:00:00', 0, 0, 0),
(132, 9, 3, 5, '09:00:00', '17:00:00', 0, 0, 0),
(133, 9, 3, 6, '09:00:00', '17:00:00', 0, 0, 0),
(134, 10, 3, 0, '09:00:00', '17:00:00', 0, 0, 0),
(135, 10, 3, 1, '09:00:00', '17:00:00', 0, 0, 0),
(136, 10, 3, 2, '09:00:00', '17:00:00', 0, 0, 0),
(137, 10, 3, 3, '09:00:00', '17:00:00', 0, 0, 0),
(138, 10, 3, 4, '09:00:00', '17:00:00', 0, 0, 0),
(139, 10, 3, 5, '09:00:00', '17:00:00', 0, 0, 0),
(140, 10, 3, 6, '09:00:00', '17:00:00', 0, 0, 0),
(211, 1, 5, 0, '13:00:00', '17:00:00', 0, 0, 0),
(212, 1, 5, 1, '09:00:00', '21:00:00', 0, 0, 0),
(213, 1, 5, 2, '09:00:00', '21:00:00', 0, 0, 0),
(214, 1, 5, 3, '09:00:00', '21:00:00', 0, 0, 0),
(215, 1, 5, 4, '09:00:00', '21:00:00', 0, 0, 0),
(216, 1, 5, 5, '09:00:00', '17:00:00', 0, 0, 0),
(217, 1, 5, 6, '09:00:00', '17:00:00', 0, 0, 0),
(218, 2, 5, 0, '00:00:00', '00:00:00', 1, 0, 0),
(219, 2, 5, 1, '13:00:00', '21:00:00', 0, 0, 0),
(220, 2, 5, 2, '13:00:00', '21:00:00', 0, 0, 0),
(221, 2, 5, 3, '09:00:00', '21:00:00', 0, 0, 0),
(222, 2, 5, 4, '09:00:00', '17:00:00', 0, 0, 0),
(223, 2, 5, 5, '09:00:00', '17:00:00', 0, 0, 0),
(224, 2, 5, 6, '09:00:00', '17:00:00', 0, 0, 0),
(225, 3, 5, 0, '00:00:00', '00:00:00', 1, 0, 0),
(226, 3, 5, 1, '09:00:00', '21:00:00', 0, 0, 0),
(227, 3, 5, 2, '09:00:00', '18:00:00', 0, 0, 0),
(228, 3, 5, 3, '12:00:00', '21:00:00', 0, 0, 0),
(229, 3, 5, 4, '10:00:00', '18:00:00', 0, 0, 0),
(230, 3, 5, 5, '10:00:00', '17:00:00', 0, 0, 0),
(231, 3, 5, 6, '10:00:00', '17:00:00', 0, 0, 0),
(232, 4, 5, 0, '00:00:00', '00:00:00', 1, 0, 0),
(233, 4, 5, 1, '12:00:00', '20:00:00', 0, 0, 0),
(234, 4, 5, 2, '12:00:00', '20:00:00', 0, 0, 0),
(235, 4, 5, 3, '10:00:00', '18:00:00', 0, 0, 0),
(236, 4, 5, 4, '10:00:00', '18:00:00', 0, 0, 0),
(237, 4, 5, 5, '09:00:00', '17:00:00', 0, 0, 0),
(238, 4, 5, 6, '09:00:00', '17:00:00', 0, 0, 0),
(239, 5, 5, 0, '00:00:00', '00:00:00', 1, 0, 0),
(240, 5, 5, 1, '10:00:00', '19:00:00', 0, 0, 0),
(241, 5, 5, 2, '10:00:00', '19:00:00', 0, 0, 0),
(242, 5, 5, 3, '10:00:00', '18:00:00', 0, 0, 0),
(243, 5, 5, 4, '10:00:00', '18:00:00', 0, 0, 0),
(244, 5, 5, 5, '10:00:00', '17:00:00', 0, 0, 0),
(245, 5, 5, 6, '10:00:00', '17:00:00', 0, 0, 0),
(246, 6, 5, 0, '00:00:00', '00:00:00', 1, 0, 0),
(247, 6, 5, 1, '09:30:00', '19:00:00', 0, 0, 0),
(248, 6, 5, 2, '09:30:00', '19:00:00', 0, 0, 0),
(249, 6, 5, 3, '09:30:00', '17:00:00', 0, 0, 0),
(250, 6, 5, 4, '09:30:00', '17:00:00', 0, 0, 0),
(251, 6, 5, 5, '09:30:00', '17:00:00', 0, 0, 0),
(252, 6, 5, 6, '09:30:00', '16:00:00', 0, 0, 0),
(253, 7, 5, 0, '00:00:00', '00:00:00', 1, 0, 0),
(254, 7, 5, 1, '10:00:00', '21:00:00', 0, 0, 0),
(255, 7, 5, 2, '10:00:00', '21:00:00', 0, 0, 0),
(256, 7, 5, 3, '10:00:00', '21:00:00', 0, 0, 0),
(257, 7, 5, 4, '10:00:00', '21:00:00', 0, 0, 0),
(258, 7, 5, 5, '10:00:00', '17:00:00', 0, 0, 0),
(259, 7, 5, 6, '10:00:00', '17:00:00', 0, 0, 0),
(260, 8, 5, 0, '00:00:00', '00:00:00', 1, 0, 0),
(261, 8, 5, 1, '11:00:00', '19:00:00', 0, 0, 0),
(262, 8, 5, 2, '13:00:00', '21:00:00', 0, 0, 0),
(263, 8, 5, 3, '09:00:00', '17:00:00', 0, 0, 0),
(264, 8, 5, 4, '09:00:00', '21:00:00', 0, 0, 0),
(265, 8, 5, 5, '09:00:00', '17:00:00', 0, 0, 0),
(266, 8, 5, 6, '09:00:00', '17:00:00', 0, 0, 0),
(267, 1, 6, 0, '13:00:00', '17:00:00', 1, 0, 0),
(268, 1, 6, 1, '13:00:00', '19:00:00', 0, 0, 0),
(269, 1, 6, 2, '10:00:00', '16:00:00', 0, 0, 0),
(270, 1, 6, 3, '10:00:00', '16:00:00', 0, 0, 0),
(271, 1, 6, 4, '10:00:00', '16:00:00', 0, 0, 0),
(272, 1, 6, 5, '10:00:00', '16:00:00', 0, 0, 0),
(273, 1, 6, 6, '10:00:00', '16:00:00', 0, 0, 0),
(274, 2, 6, 0, '00:00:00', '00:00:00', 1, 0, 0),
(275, 2, 6, 1, '13:00:00', '19:00:00', 0, 0, 0),
(276, 2, 6, 2, '10:00:00', '16:00:00', 0, 0, 0),
(277, 2, 6, 3, '10:00:00', '16:00:00', 0, 0, 0),
(278, 2, 6, 4, '10:00:00', '16:00:00', 0, 0, 0),
(279, 2, 6, 5, '10:00:00', '16:00:00', 0, 0, 0),
(280, 2, 6, 6, '10:00:00', '16:00:00', 0, 0, 0),
(281, 3, 6, 0, '00:00:00', '00:00:00', 1, 0, 0),
(282, 3, 6, 1, '13:00:00', '19:00:00', 0, 0, 0),
(283, 3, 6, 2, '10:00:00', '16:00:00', 0, 0, 0),
(284, 3, 6, 3, '10:00:00', '16:00:00', 0, 0, 0),
(285, 3, 6, 4, '10:00:00', '16:00:00', 0, 0, 0),
(286, 3, 6, 5, '10:00:00', '16:00:00', 0, 0, 0),
(287, 3, 6, 6, '10:00:00', '16:00:00', 0, 0, 0),
(288, 4, 6, 0, '00:00:00', '00:00:00', 1, 0, 0),
(289, 4, 6, 1, '13:00:00', '19:00:00', 0, 0, 0),
(290, 4, 6, 2, '10:00:00', '14:00:00', 0, 0, 0),
(291, 4, 6, 3, '10:00:00', '14:00:00', 0, 0, 0),
(292, 4, 6, 4, '10:00:00', '14:00:00', 0, 0, 0),
(293, 4, 6, 5, '10:00:00', '14:00:00', 0, 0, 0),
(294, 4, 6, 6, '10:00:00', '14:00:00', 0, 0, 0),
(295, 5, 6, 0, '00:00:00', '00:00:00', 1, 0, 0),
(296, 5, 6, 1, '13:00:00', '19:00:00', 0, 0, 0),
(297, 5, 6, 2, '10:00:00', '16:00:00', 0, 0, 0),
(298, 5, 6, 3, '10:00:00', '16:00:00', 0, 0, 0),
(299, 5, 6, 4, '10:00:00', '16:00:00', 0, 0, 0),
(300, 5, 6, 5, '10:00:00', '16:00:00', 0, 0, 0),
(301, 5, 6, 6, '10:00:00', '16:00:00', 0, 0, 0),
(302, 6, 6, 0, '00:00:00', '00:00:00', 1, 0, 0),
(303, 6, 6, 1, '13:00:00', '19:00:00', 0, 0, 0),
(304, 6, 6, 2, '10:00:00', '16:00:00', 0, 0, 0),
(305, 6, 6, 3, '10:00:00', '16:00:00', 0, 0, 0),
(306, 6, 6, 4, '10:00:00', '16:00:00', 0, 0, 0),
(307, 6, 6, 5, '10:00:00', '16:00:00', 0, 0, 0),
(308, 6, 6, 6, '10:00:00', '16:00:00', 0, 0, 0),
(309, 7, 6, 0, '00:00:00', '00:00:00', 1, 0, 0),
(310, 7, 6, 1, '13:00:00', '19:00:00', 0, 0, 0),
(311, 7, 6, 2, '10:00:00', '16:00:00', 0, 0, 0),
(312, 7, 6, 3, '10:00:00', '16:00:00', 0, 0, 0),
(313, 7, 6, 4, '10:00:00', '16:00:00', 0, 0, 0),
(314, 7, 6, 5, '10:00:00', '16:00:00', 0, 0, 0),
(315, 7, 6, 6, '10:00:00', '16:00:00', 0, 0, 0),
(316, 8, 6, 0, '00:00:00', '00:00:00', 1, 0, 0),
(317, 8, 6, 1, '13:00:00', '19:00:00', 0, 0, 0),
(318, 8, 6, 2, '10:00:00', '14:00:00', 0, 0, 0),
(319, 8, 6, 3, '10:00:00', '14:00:00', 0, 0, 0),
(320, 8, 6, 4, '10:00:00', '14:00:00', 0, 0, 0),
(321, 8, 6, 5, '10:00:00', '14:00:00', 0, 0, 0),
(322, 8, 6, 6, '10:00:00', '14:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Season`
--

CREATE TABLE `Season` (
  `SeasonID` int(11) NOT NULL,
  `SeasonName` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Season`
--

INSERT INTO `Season` (`SeasonID`, `SeasonName`) VALUES
(1, 'Winter'),
(2, 'Summer'),
(3, 'COVID hours');

-- --------------------------------------------------------

--
-- Table structure for table `Semesters`
--

CREATE TABLE `Semesters` (
  `SemID` bigint(20) NOT NULL,
  `SemYear` year(4) NOT NULL DEFAULT '0000',
  `SeasonID` int(11) NOT NULL DEFAULT '0',
  `DayStart` date NOT NULL DEFAULT '0000-00-00',
  `DayEnd` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Semesters`
--

INSERT INTO `Semesters` (`SemID`, `SemYear`, `SeasonID`, `DayStart`, `DayEnd`) VALUES
(3, 2018, 1, '2018-09-03', '2019-05-20'),
(4, 2019, 2, '2019-05-21', '2019-09-01'),
(5, 2019, 1, '2019-09-02', '2020-05-23'),
(6, 2020, 3, '2020-05-26', '2020-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `Special`
--

CREATE TABLE `Special` (
  `SpecialID` bigint(20) NOT NULL,
  `HolName` varchar(50) NOT NULL DEFAULT 'Holiday',
  `LibID` int(11) NOT NULL DEFAULT '0',
  `SpecialDate` date NOT NULL DEFAULT '0000-00-00',
  `OpenTime` time DEFAULT '08:00:00',
  `CloseTime` time DEFAULT '23:30:00',
  `Closed` tinyint(1) NOT NULL DEFAULT '0',
  `Appointment` tinyint(1) NOT NULL DEFAULT '0',
  `Open24` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Special`
--

INSERT INTO `Special` (`SpecialID`, `HolName`, `LibID`, `SpecialDate`, `OpenTime`, `CloseTime`, `Closed`, `Appointment`, `Open24`) VALUES
(266, 'Labor Day', 9, '2020-09-07', NULL, NULL, 1, 0, 0),
(265, 'Labor Day', 8, '2020-09-07', NULL, NULL, 1, 0, 0),
(264, 'Labor Day', 7, '2020-09-07', NULL, NULL, 1, 0, 0),
(263, 'Labor Day', 6, '2020-09-07', NULL, NULL, 1, 0, 0),
(262, 'Labor Day', 5, '2020-09-07', NULL, NULL, 1, 0, 0),
(261, 'Labor Day', 4, '2020-09-07', NULL, NULL, 1, 0, 0),
(260, 'Labor Day', 3, '2020-09-07', NULL, NULL, 1, 0, 0),
(259, 'Labor Day', 2, '2020-09-07', NULL, NULL, 1, 0, 0),
(258, 'Labor Day', 1, '2020-09-07', NULL, NULL, 1, 0, 0),
(246, 'Renovations', 6, '2020-03-14', NULL, NULL, 1, 0, 0),
(245, 'Renovations', 6, '2020-03-13', NULL, NULL, 1, 0, 0),
(244, 'Renovations', 6, '2020-02-13', NULL, NULL, 1, 0, 0),
(243, 'Renovations', 6, '2020-03-12', NULL, NULL, 1, 0, 0),
(242, 'Renovations', 6, '2020-03-11', NULL, NULL, 1, 0, 0),
(241, 'Renovations', 6, '2020-03-10', NULL, NULL, 1, 0, 0),
(240, 'Renovations', 6, '2020-03-09', NULL, NULL, 1, 0, 0),
(238, 'Renovations', 6, '2020-03-07', NULL, NULL, 1, 0, 0),
(237, 'Renovations', 6, '2020-03-06', NULL, NULL, 1, 0, 0),
(236, 'Renovations', 6, '2020-03-05', NULL, NULL, 1, 0, 0),
(235, 'Renovations', 6, '2020-03-04', NULL, NULL, 1, 0, 0),
(234, 'Renovations', 6, '2020-03-03', NULL, NULL, 1, 0, 0),
(233, 'Renovations', 6, '2020-03-02', NULL, NULL, 1, 0, 0),
(232, 'Renovations', 6, '2020-03-01', NULL, NULL, 1, 0, 0),
(231, 'Renovations', 6, '2020-02-29', NULL, NULL, 1, 0, 0),
(239, 'Renovations', 6, '2020-03-08', NULL, NULL, 1, 0, 0),
(229, 'Memorial Day', 9, '2020-05-25', NULL, NULL, 1, 0, 0),
(227, 'inclement weather', 8, '2020-01-07', '13:00:00', '19:00:00', 0, 0, 0),
(226, 'inclement weather', 6, '2020-01-07', NULL, NULL, 1, 0, 0),
(225, 'inclement weather', 4, '2020-01-07', '12:00:00', '19:00:00', 0, 0, 0),
(224, 'inclement weather', 2, '2020-01-07', NULL, NULL, 1, 0, 0),
(248, 'Independence Day', 1, '2020-07-04', NULL, NULL, 1, 0, 0),
(249, 'Independence Day', 2, '2020-07-04', NULL, NULL, 1, 0, 0),
(250, 'Independence Day', 3, '2020-07-04', NULL, NULL, 1, 0, 0),
(251, 'Independence Day', 4, '2020-07-04', NULL, NULL, 1, 0, 0),
(252, 'Independence Day', 5, '2020-07-04', NULL, NULL, 1, 0, 0),
(253, 'Independence Day', 6, '2020-07-04', NULL, NULL, 1, 0, 0),
(254, 'Independence Day', 7, '2020-07-04', NULL, NULL, 1, 0, 0),
(212, 'Power Outage', 2, '2019-07-17', '09:00:00', '16:00:00', 1, 0, 0),
(213, 'Power outage ', 2, '2019-09-11', '09:00:00', '19:00:00', 0, 0, 0),
(210, 'New Year\'s Eve', 8, '2019-12-31', '13:00:00', '17:00:00', 0, 0, 0),
(209, 'New Year\'s Eve', 7, '2019-12-31', '10:00:00', '17:00:00', 0, 0, 0),
(208, 'New Year\'s Eve', 6, '2019-12-31', '09:30:00', '17:00:00', 0, 0, 0),
(214, 'AC Outage', 3, '2019-10-02', '12:00:00', '18:00:00', 0, 0, 0),
(207, 'New Year\'s Eve', 5, '2019-12-31', '10:00:00', '17:00:00', 0, 0, 0),
(206, 'New Year\'s Eve', 4, '2019-12-31', '12:00:00', '17:00:00', 0, 0, 0),
(199, 'Thanksgiving Eve', 5, '2019-11-27', '10:00:00', '17:00:00', 0, 0, 0),
(201, 'Thanksgiving Eve', 7, '2019-11-27', '10:00:00', '17:00:00', 0, 0, 0),
(202, 'Thanksgiving Eve', 8, '2019-11-27', '09:00:00', '17:00:00', 0, 0, 0),
(203, 'New Year\'s Eve', 1, '2019-12-31', '09:00:00', '17:00:00', 0, 0, 0),
(204, 'New Year\'s Eve', 2, '2019-12-31', '13:00:00', '17:00:00', 0, 0, 0),
(205, 'New Year\'s Eve', 3, '2019-12-31', '09:00:00', '17:00:00', 0, 0, 0),
(255, 'Independence Day', 8, '2020-07-04', NULL, NULL, 1, 0, 0),
(256, 'Independence Day', 9, '2020-07-04', NULL, NULL, 1, 0, 0),
(215, 'Power Outage', 6, '2019-11-01', NULL, NULL, 1, 0, 0),
(257, 'Power outage', 5, '2020-08-07', '10:00:00', '12:00:00', 1, 0, 0),
(84, 'Independence Day', 3, '2019-07-04', NULL, NULL, 1, 0, 0),
(83, 'Independence Day', 2, '2019-07-04', NULL, NULL, 1, 0, 0),
(82, 'Independence Day', 1, '2019-07-04', NULL, NULL, 1, 0, 0),
(200, 'Thanksgiving Eve', 6, '2019-11-27', '09:30:00', '17:00:00', 0, 0, 0),
(85, 'Independence Day', 4, '2019-07-04', NULL, NULL, 1, 0, 0),
(86, 'Independence Day', 5, '2019-07-04', NULL, NULL, 1, 0, 0),
(87, 'Independence Day', 6, '2019-07-04', NULL, NULL, 1, 0, 0),
(88, 'Independence Day', 7, '2019-07-04', NULL, NULL, 1, 0, 0),
(89, 'Independence Day', 8, '2019-07-04', NULL, NULL, 1, 0, 0),
(90, 'Labor Day', 1, '2019-09-02', NULL, NULL, 1, 0, 0),
(91, 'Labor Day', 2, '2019-09-02', NULL, NULL, 1, 0, 0),
(92, 'Labor Day', 3, '2019-09-02', NULL, NULL, 1, 0, 0),
(93, 'Labor Day', 4, '2019-09-02', NULL, NULL, 1, 0, 0),
(94, 'Labor Day', 5, '2019-09-02', NULL, NULL, 1, 0, 0),
(95, 'Labor Day', 6, '2019-09-02', NULL, NULL, 1, 0, 0),
(96, 'Labor Day', 7, '2019-09-02', NULL, NULL, 1, 0, 0),
(97, 'Labor Day', 8, '2019-09-02', NULL, NULL, 1, 0, 0),
(98, 'In-Service Day', 1, '2019-10-14', NULL, NULL, 1, 0, 0),
(99, 'In-Service Day', 2, '2019-10-14', NULL, NULL, 1, 0, 0),
(100, 'In-Service Day', 3, '2019-10-14', NULL, NULL, 1, 0, 0),
(101, 'In-Service Day', 4, '2019-10-14', NULL, NULL, 1, 0, 0),
(102, 'In-Service Day', 5, '2019-10-14', NULL, NULL, 1, 0, 0),
(103, 'In-Service Day', 6, '2019-10-14', NULL, NULL, 1, 0, 0),
(104, 'In-Service Day', 7, '2019-10-14', NULL, NULL, 1, 0, 0),
(105, 'In-Service Day', 8, '2019-10-14', NULL, NULL, 1, 0, 0),
(106, 'Veteran\'s Day', 1, '2019-11-11', NULL, NULL, 1, 0, 0),
(107, 'Veteran\'s Day', 2, '2019-11-11', NULL, NULL, 1, 0, 0),
(108, 'Veteran\'s Day', 3, '2019-11-11', NULL, NULL, 1, 0, 0),
(109, 'Veteran\'s Day', 4, '2019-11-11', NULL, NULL, 1, 0, 0),
(110, 'Veteran\'s Day', 5, '2019-11-11', NULL, NULL, 1, 0, 0),
(111, 'Veteran\'s Day', 6, '2019-11-11', NULL, NULL, 1, 0, 0),
(112, 'Veteran\'s Day', 7, '2019-11-11', NULL, NULL, 1, 0, 0),
(113, 'Veteran\'s Day', 8, '2019-11-11', NULL, NULL, 1, 0, 0),
(114, 'Thanksgiving Day', 1, '2019-11-28', NULL, NULL, 1, 0, 0),
(115, 'Thanksgiving Day', 2, '2019-11-28', NULL, NULL, 1, 0, 0),
(116, 'Thanksgiving Day', 3, '2019-11-28', NULL, NULL, 1, 0, 0),
(117, 'Thanksgiving Day', 4, '2019-11-28', NULL, NULL, 1, 0, 0),
(118, 'Thanksgiving Day', 5, '2019-11-28', NULL, NULL, 1, 0, 0),
(119, 'Thanksgiving Day', 6, '2019-11-28', NULL, NULL, 1, 0, 0),
(120, 'Thanksgiving Day', 7, '2019-11-28', NULL, NULL, 1, 0, 0),
(121, 'Thanksgiving Day', 8, '2019-11-28', NULL, NULL, 1, 0, 0),
(122, 'Day After Thanksgiving', 1, '2019-11-29', NULL, NULL, 1, 0, 0),
(123, 'Day After Thanksgiving', 2, '2019-11-29', NULL, NULL, 1, 0, 0),
(124, 'Day After Thanksgiving', 3, '2019-11-29', NULL, NULL, 1, 0, 0),
(125, 'Day After Thanksgiving', 4, '2019-11-29', NULL, NULL, 1, 0, 0),
(126, 'Day After Thanksgiving', 5, '2019-11-29', NULL, NULL, 1, 0, 0),
(127, 'Day After Thanksgiving', 6, '2019-11-29', NULL, NULL, 1, 0, 0),
(128, 'Day After Thanksgiving', 7, '2019-11-29', NULL, NULL, 1, 0, 0),
(129, 'Day After Thanksgiving', 8, '2019-11-29', NULL, NULL, 1, 0, 0),
(130, 'Christmas Eve', 1, '2019-12-24', NULL, NULL, 1, 0, 0),
(131, 'Christmas Eve', 2, '2019-12-24', NULL, NULL, 1, 0, 0),
(132, 'Christmas Eve', 3, '2019-12-24', NULL, NULL, 1, 0, 0),
(133, 'Christmas Eve', 4, '2019-12-24', NULL, NULL, 1, 0, 0),
(134, 'Christmas Eve', 5, '2019-12-24', NULL, NULL, 1, 0, 0),
(135, 'Christmas Eve', 6, '2019-12-24', NULL, NULL, 1, 0, 0),
(136, 'Christmas Eve', 7, '2019-12-24', NULL, NULL, 1, 0, 0),
(137, 'Christmas Eve', 8, '2019-12-24', NULL, NULL, 1, 0, 0),
(138, 'Christmas Day', 1, '2019-12-25', NULL, NULL, 1, 0, 0),
(139, 'Christmas Day', 2, '2019-12-25', NULL, NULL, 1, 0, 0),
(140, 'Christmas Day', 3, '2019-12-25', NULL, NULL, 1, 0, 0),
(141, 'Christmas Day', 4, '2019-12-25', NULL, NULL, 1, 0, 0),
(142, 'Christmas Day', 5, '2019-12-25', NULL, NULL, 1, 0, 0),
(143, 'Christmas Day', 6, '2019-12-25', NULL, NULL, 1, 0, 0),
(144, 'Christmas Day', 7, '2019-12-25', NULL, NULL, 1, 0, 0),
(145, 'Christmas Day', 8, '2019-12-25', NULL, NULL, 1, 0, 0),
(146, 'Day after Christmas', 1, '2019-12-26', NULL, NULL, 1, 0, 0),
(147, 'Day after Christmas', 2, '2019-12-26', NULL, NULL, 1, 0, 0),
(148, 'Day after Christmas', 3, '2019-12-26', NULL, NULL, 1, 0, 0),
(149, 'Day after Christmas', 4, '2019-12-26', NULL, NULL, 1, 0, 0),
(150, 'Day after Christmas', 5, '2019-12-26', NULL, NULL, 1, 0, 0),
(151, 'Day after Christmas', 6, '2019-12-26', NULL, NULL, 1, 0, 0),
(152, 'Day after Christmas', 7, '2019-12-26', NULL, NULL, 1, 0, 0),
(153, 'Day after Christmas', 8, '2019-12-26', NULL, NULL, 1, 0, 0),
(154, 'New Year\'s Day', 1, '2020-01-01', NULL, NULL, 1, 0, 0),
(155, 'New Year\'s Day', 2, '2020-01-01', NULL, NULL, 1, 0, 0),
(156, 'New Year\'s Day', 3, '2020-01-01', NULL, NULL, 1, 0, 0),
(157, 'New Year\'s Day', 4, '2020-01-01', NULL, NULL, 1, 0, 0),
(158, 'New Year\'s Day', 5, '2020-01-01', NULL, NULL, 1, 0, 0),
(159, 'New Year\'s Day', 6, '2020-01-01', NULL, NULL, 1, 0, 0),
(160, 'New Year\'s Day', 7, '2020-01-01', NULL, NULL, 1, 0, 0),
(161, 'New Year\'s Day', 8, '2020-01-01', NULL, NULL, 1, 0, 0),
(162, 'Martin Luther King, Jr. Day', 1, '2020-01-20', NULL, NULL, 1, 0, 0),
(163, 'Martin Luther King, Jr. Day', 2, '2020-01-20', NULL, NULL, 1, 0, 0),
(164, 'Martin Luther King, Jr. Day', 3, '2020-01-20', NULL, NULL, 1, 0, 0),
(165, 'Martin Luther King, Jr. Day', 4, '2020-01-20', NULL, NULL, 1, 0, 0),
(166, 'Martin Luther King, Jr. Day', 5, '2020-01-20', NULL, NULL, 1, 0, 0),
(167, 'Martin Luther King, Jr. Day', 6, '2020-01-20', NULL, NULL, 1, 0, 0),
(168, 'Martin Luther King, Jr. Day', 7, '2020-01-20', NULL, NULL, 1, 0, 0),
(169, 'Martin Luther King, Jr. Day', 8, '2020-01-20', NULL, NULL, 1, 0, 0),
(170, 'Presidents\' Day', 1, '2020-02-17', NULL, NULL, 1, 0, 0),
(171, 'Presidents\' Day', 2, '2020-02-17', NULL, NULL, 1, 0, 0),
(172, 'Presidents\' Day', 3, '2020-02-17', NULL, NULL, 1, 0, 0),
(173, 'Presidents\' Day', 4, '2020-02-17', NULL, NULL, 1, 0, 0),
(174, 'Presidents\' Day', 5, '2020-02-17', NULL, NULL, 1, 0, 0),
(175, 'Presidents\' Day', 6, '2020-02-17', NULL, NULL, 1, 0, 0),
(176, 'Presidents\' Day', 7, '2020-02-17', NULL, NULL, 1, 0, 0),
(177, 'Presidents\' Day', 8, '2020-02-17', NULL, NULL, 1, 0, 0),
(247, 'Blood Drive', 5, '2020-06-06', NULL, NULL, 1, 0, 0),
(179, 'Memorial Day', 1, '2020-05-25', NULL, NULL, 1, 0, 0),
(180, 'Memorial Day', 2, '2020-05-25', NULL, NULL, 1, 0, 0),
(181, 'Memorial Day', 3, '2020-05-25', NULL, NULL, 1, 0, 0),
(182, 'Memorial Day', 4, '2020-05-25', NULL, NULL, 1, 0, 0),
(183, 'Memorial Day', 5, '2020-05-25', NULL, NULL, 1, 0, 0),
(184, 'Memorial Day', 6, '2020-05-25', NULL, NULL, 1, 0, 0),
(185, 'Memorial Day', 7, '2020-05-25', NULL, NULL, 1, 0, 0),
(186, 'Memorial Day', 8, '2020-05-25', NULL, NULL, 1, 0, 0),
(198, 'Thanksgiving Eve', 4, '2019-11-27', '10:00:00', '17:00:00', 0, 0, 0),
(197, 'Thanksgiving Eve', 3, '2019-11-27', '12:00:00', '17:00:00', 0, 0, 0),
(196, 'Thanksgiving Eve', 2, '2019-11-27', '09:00:00', '17:00:00', 0, 0, 0),
(195, 'Thanksgiving Eve', 1, '2019-11-27', '09:00:00', '17:00:00', 0, 0, 0),
(267, 'Staff Training Day', 1, '2020-10-12', NULL, NULL, 1, 0, 0),
(268, 'Staff Training Day', 2, '2020-10-12', NULL, NULL, 1, 0, 0),
(269, 'Staff Training Day', 3, '2020-10-12', NULL, NULL, 1, 0, 0),
(270, 'Staff Training Day', 4, '2020-10-12', NULL, NULL, 1, 0, 0),
(271, 'Staff Training Day', 5, '2020-10-12', NULL, NULL, 1, 0, 0),
(272, 'Staff Training Day', 6, '2020-10-12', NULL, NULL, 1, 0, 0),
(273, 'Staff Training Day', 7, '2020-10-12', NULL, NULL, 1, 0, 0),
(274, 'Staff Training Day', 8, '2020-10-12', NULL, NULL, 1, 0, 0),
(275, 'Staff Training Day', 9, '2020-10-12', NULL, NULL, 1, 0, 0),
(276, 'Veteran\'s Day', 1, '2020-11-11', NULL, NULL, 1, 0, 0),
(277, 'Veteran\'s Day', 2, '2020-11-11', NULL, NULL, 1, 0, 0),
(278, 'Veteran\'s Day', 3, '2020-11-11', NULL, NULL, 1, 0, 0),
(279, 'Veteran\'s Day', 4, '2020-11-11', NULL, NULL, 1, 0, 0),
(280, 'Veteran\'s Day', 5, '2020-11-11', NULL, NULL, 1, 0, 0),
(281, 'Veteran\'s Day', 6, '2020-11-11', NULL, NULL, 1, 0, 0),
(282, 'Veteran\'s Day', 7, '2020-11-11', NULL, NULL, 1, 0, 0),
(283, 'Veteran\'s Day', 8, '2020-11-11', NULL, NULL, 1, 0, 0),
(284, 'Veteran\'s Day', 9, '2020-11-11', NULL, NULL, 1, 0, 0),
(285, 'Thanksgiving', 1, '2020-11-26', NULL, NULL, 1, 0, 0),
(286, 'Thanksgiving', 2, '2020-11-26', NULL, NULL, 1, 0, 0),
(287, 'Thanksgiving', 3, '2020-11-26', NULL, NULL, 1, 0, 0),
(288, 'Thanksgiving', 4, '2020-11-26', NULL, NULL, 1, 0, 0),
(289, 'Thanksgiving', 5, '2020-11-26', NULL, NULL, 1, 0, 0),
(290, 'Thanksgiving', 6, '2020-11-26', NULL, NULL, 1, 0, 0),
(291, 'Thanksgiving', 7, '2020-11-26', NULL, NULL, 1, 0, 0),
(292, 'Thanksgiving', 8, '2020-11-26', NULL, NULL, 1, 0, 0),
(293, 'Thanksgiving', 9, '2020-11-26', NULL, NULL, 1, 0, 0),
(294, 'Day After Thanksgiving', 1, '2020-11-27', NULL, NULL, 1, 0, 0),
(295, 'Day After Thanksgiving', 2, '2020-11-27', NULL, NULL, 1, 0, 0),
(296, 'Day After Thanksgiving', 3, '2020-11-27', NULL, NULL, 1, 0, 0),
(297, 'Day After Thanksgiving', 4, '2020-11-27', NULL, NULL, 1, 0, 0),
(298, 'Day After Thanksgiving', 5, '2020-11-27', NULL, NULL, 1, 0, 0),
(299, 'Day After Thanksgiving', 6, '2020-11-27', NULL, NULL, 1, 0, 0),
(300, 'Day After Thanksgiving', 7, '2020-11-27', NULL, NULL, 1, 0, 0),
(301, 'Day After Thanksgiving', 8, '2020-11-27', NULL, NULL, 1, 0, 0),
(302, 'Day After Thanksgiving', 9, '2020-11-27', NULL, NULL, 1, 0, 0),
(303, 'Christmas Eve', 1, '2020-12-24', NULL, NULL, 1, 0, 0),
(304, 'Christmas Eve', 2, '2020-12-24', NULL, NULL, 1, 0, 0),
(305, 'Christmas Eve', 3, '2020-12-24', NULL, NULL, 1, 0, 0),
(306, 'Christmas Eve', 4, '2020-12-24', NULL, NULL, 1, 0, 0),
(307, 'Christmas Eve', 5, '2020-12-24', NULL, NULL, 1, 0, 0),
(308, 'Christmas Eve', 6, '2020-12-24', NULL, NULL, 1, 0, 0),
(309, 'Christmas Eve', 7, '2020-12-24', NULL, NULL, 1, 0, 0),
(310, 'Christmas Eve', 8, '2020-12-24', NULL, NULL, 1, 0, 0),
(311, 'Christmas Eve', 9, '2020-12-24', NULL, NULL, 1, 0, 0),
(312, 'Christmas', 1, '2020-12-25', NULL, NULL, 1, 0, 0),
(313, 'Christmas', 2, '2020-12-25', NULL, NULL, 1, 0, 0),
(314, 'Christmas', 3, '2020-12-25', NULL, NULL, 1, 0, 0),
(315, 'Christmas', 4, '2020-12-25', NULL, NULL, 1, 0, 0),
(316, 'Christmas', 5, '2020-12-25', NULL, NULL, 1, 0, 0),
(317, 'Christmas', 6, '2020-12-25', NULL, NULL, 1, 0, 0),
(318, 'Christmas', 7, '2020-12-25', NULL, NULL, 1, 0, 0),
(319, 'Christmas', 8, '2020-12-25', NULL, NULL, 1, 0, 0),
(320, 'Christmas', 9, '2020-12-25', NULL, NULL, 1, 0, 0),
(321, 'Day after Christmas', 1, '2020-12-26', NULL, NULL, 1, 0, 0),
(322, 'Day after Christmas', 2, '2020-12-26', NULL, NULL, 1, 0, 0),
(323, 'Day after Christmas', 3, '2020-12-26', NULL, NULL, 1, 0, 0),
(324, 'Day after Christmas', 4, '2020-12-26', NULL, NULL, 1, 0, 0),
(325, 'Day after Christmas', 5, '2020-12-26', NULL, NULL, 1, 0, 0),
(326, 'Day after Christmas', 6, '2020-12-26', NULL, NULL, 1, 0, 0),
(327, 'Day after Christmas', 7, '2020-12-26', NULL, NULL, 1, 0, 0),
(328, 'Day after Christmas', 8, '2020-12-26', NULL, NULL, 1, 0, 0),
(329, 'Day after Christmas', 9, '2020-12-26', NULL, NULL, 1, 0, 0),
(330, 'New Year\'s Day', 1, '2021-01-01', NULL, NULL, 1, 0, 0),
(331, 'New Year\'s Day', 2, '2021-01-01', NULL, NULL, 1, 0, 0),
(332, 'New Year\'s Day', 3, '2021-01-01', NULL, NULL, 1, 0, 0),
(333, 'New Year\'s Day', 4, '2021-01-01', NULL, NULL, 1, 0, 0),
(334, 'New Year\'s Day', 5, '2021-01-01', NULL, NULL, 1, 0, 0),
(335, 'New Year\'s Day', 6, '2021-01-01', NULL, NULL, 1, 0, 0),
(336, 'New Year\'s Day', 7, '2021-01-01', NULL, NULL, 1, 0, 0),
(337, 'New Year\'s Day', 8, '2021-01-01', NULL, NULL, 1, 0, 0),
(338, 'New Year\'s Day', 9, '2021-01-01', NULL, NULL, 1, 0, 0),
(339, 'Martin Luther King, Jr. Day', 1, '2021-01-18', NULL, NULL, 1, 0, 0),
(340, 'Martin Luther King, Jr. Day', 2, '2021-01-18', NULL, NULL, 1, 0, 0),
(341, 'Martin Luther King, Jr. Day', 3, '2021-01-18', NULL, NULL, 1, 0, 0),
(342, 'Martin Luther King, Jr. Day', 4, '2021-01-18', NULL, NULL, 1, 0, 0),
(343, 'Martin Luther King, Jr. Day', 5, '2021-01-18', NULL, NULL, 1, 0, 0),
(344, 'Martin Luther King, Jr. Day', 6, '2021-01-18', NULL, NULL, 1, 0, 0),
(345, 'Martin Luther King, Jr. Day', 7, '2021-01-18', NULL, NULL, 1, 0, 0),
(346, 'Martin Luther King, Jr. Day', 8, '2021-01-18', NULL, NULL, 1, 0, 0),
(347, 'Martin Luther King, Jr. Day', 9, '2021-01-18', NULL, NULL, 1, 0, 0),
(348, 'Presidents\' Day', 1, '2021-02-15', NULL, NULL, 1, 0, 0),
(349, 'Presidents\' Day', 2, '2021-02-15', NULL, NULL, 1, 0, 0),
(350, 'Presidents\' Day', 3, '2021-02-15', NULL, NULL, 1, 0, 0),
(351, 'Presidents\' Day', 4, '2021-02-15', NULL, NULL, 1, 0, 0),
(352, 'Presidents\' Day', 5, '2021-02-15', NULL, NULL, 1, 0, 0),
(353, 'Presidents\' Day', 6, '2021-02-15', NULL, NULL, 1, 0, 0),
(354, 'Presidents\' Day', 7, '2021-02-15', NULL, NULL, 1, 0, 0),
(355, 'Presidents\' Day', 8, '2021-02-15', NULL, NULL, 1, 0, 0),
(356, 'Presidents\' Day', 9, '2021-02-15', NULL, NULL, 1, 0, 0),
(357, 'Easter', 1, '2021-04-04', NULL, NULL, 1, 0, 0),
(358, 'Memorial Day', 1, '2021-05-31', NULL, NULL, 1, 0, 0),
(359, 'Memorial Day', 2, '2021-05-31', NULL, NULL, 1, 0, 0),
(360, 'Memorial Day', 3, '2021-05-31', NULL, NULL, 1, 0, 0),
(361, 'Memorial Day', 4, '2021-05-31', NULL, NULL, 1, 0, 0),
(362, 'Memorial Day', 5, '2021-05-31', NULL, NULL, 1, 0, 0),
(363, 'Memorial Day', 6, '2021-05-31', NULL, NULL, 1, 0, 0),
(364, 'Memorial Day', 7, '2021-05-31', NULL, NULL, 1, 0, 0),
(365, 'Memorial Day', 8, '2021-05-31', NULL, NULL, 1, 0, 0),
(366, 'Memorial Day', 9, '2021-05-31', NULL, NULL, 1, 0, 0),
(367, 'Juneteenth', 1, '2021-06-19', NULL, NULL, 1, 0, 0),
(368, 'Juneteenth', 2, '2021-06-19', NULL, NULL, 1, 0, 0),
(369, 'Juneteenth', 3, '2021-06-19', NULL, NULL, 1, 0, 0),
(370, 'Juneteenth', 4, '2021-06-19', NULL, NULL, 1, 0, 0),
(371, 'Juneteenth', 5, '2021-06-19', NULL, NULL, 1, 0, 0),
(372, 'Juneteenth', 6, '2021-06-19', NULL, NULL, 1, 0, 0),
(373, 'Juneteenth', 7, '2021-06-19', NULL, NULL, 1, 0, 0),
(374, 'Juneteenth', 8, '2021-06-19', NULL, NULL, 1, 0, 0),
(375, 'Juneteenth', 9, '2021-06-19', NULL, NULL, 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Alert`
--
ALTER TABLE `Alert`
  ADD PRIMARY KEY (`AlertID`);

--
-- Indexes for table `Libraries`
--
ALTER TABLE `Libraries`
  ADD PRIMARY KEY (`LibID`),
  ADD UNIQUE KEY `LibName` (`LibName`);

--
-- Indexes for table `Schedule`
--
ALTER TABLE `Schedule`
  ADD PRIMARY KEY (`SchedID`),
  ADD UNIQUE KEY `DaySemesterLibrary` (`LibID`,`SemID`,`Day`);

--
-- Indexes for table `Season`
--
ALTER TABLE `Season`
  ADD PRIMARY KEY (`SeasonID`),
  ADD UNIQUE KEY `SeasonName` (`SeasonName`);

--
-- Indexes for table `Semesters`
--
ALTER TABLE `Semesters`
  ADD PRIMARY KEY (`SemID`),
  ADD UNIQUE KEY `SeasonYear` (`SemYear`,`SeasonID`);

--
-- Indexes for table `Special`
--
ALTER TABLE `Special`
  ADD PRIMARY KEY (`SpecialID`),
  ADD UNIQUE KEY `LibID` (`LibID`,`SpecialDate`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Alert`
--
ALTER TABLE `Alert`
  MODIFY `AlertID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Libraries`
--
ALTER TABLE `Libraries`
  MODIFY `LibID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Schedule`
--
ALTER TABLE `Schedule`
  MODIFY `SchedID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;

--
-- AUTO_INCREMENT for table `Season`
--
ALTER TABLE `Season`
  MODIFY `SeasonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Semesters`
--
ALTER TABLE `Semesters`
  MODIFY `SemID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Special`
--
ALTER TABLE `Special`
  MODIFY `SpecialID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=376;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
