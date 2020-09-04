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
-- Database: `hours`
--

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
/* Guessing what areas UMW might want.  Add or subtract as needed.  I don't remember what Main does if anything because it doesn't apply to JMRL.  It may not be useful. */

INSERT INTO `Libraries` (`LibID`, `LibName`, `Main`) VALUES
(1, 'Simpson Library', 1),
(2, 'Special Collections', 0),
(3, 'ThinkLab', 0),
(4, 'HCC Desk', 0);  

--
-- Table structure for table `Alert`
--

/*I don't think this table is used for anything.  It's functionality I was going to add around the time COVID started and then it was eaiser just to hardcode the banner alerts.*/

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
  `Open24` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Schedule`
--

/* Default hours - Good idea to set these up here and have them what most semesters usually are, so that when you create a new one you do less editing.
The hours in the following table are whatever JMRL was set to, so you should probably change this before import*/

INSERT INTO `Schedule` (`SchedID`, `LibID`, `SemID`, `Day`, `OpenTime`, `CloseTime`, `Closed`, `Appointment`, `Open24`) VALUES
(210, 5, 0, 6, '09:00:00', '17:00:00', 0, 0, 0),
(209, 5, 0, 5, '09:00:00', '17:00:00', 0, 0, 0),
(208, 5, 0, 4, '09:00:00', '17:00:00', 0, 0, 0),
(207, 5, 0, 3, '09:00:00', '17:00:00', 0, 0, 0),
(206, 5, 0, 2, '09:00:00', '17:00:00', 0, 0, 0),
(205, 5, 0, 1, '09:00:00', '17:00:00', 0, 0, 0),
(204, 5, 0, 0, '09:00:00', '17:00:00', 0, 0, 0),
(168, 4, 0, 6, '09:00:00', '17:00:00', 0, 0, 0),
(167, 4, 0, 5, '09:00:00', '17:00:00', 0, 0, 0),
(166, 4, 0, 4, '10:00:00', '18:00:00', 0, 0, 0),
(165, 4, 0, 3, '10:00:00', '18:00:00', 0, 0, 0),
(164, 4, 0, 2, '12:00:00', '20:00:00', 0, 0, 0),
(163, 4, 0, 1, '12:00:00', '20:00:00', 0, 0, 0),
(162, 4, 0, 0, '09:00:00', '17:00:00', 1, 0, 0),
(161, 3, 0, 6, '10:00:00', '17:00:00', 0, 0, 0),
(160, 3, 0, 5, '10:00:00', '17:00:00', 0, 0, 0),
(159, 3, 0, 4, '10:00:00', '18:00:00', 0, 0, 0),
(158, 3, 0, 3, '12:00:00', '21:00:00', 0, 0, 0),
(157, 3, 0, 2, '09:00:00', '18:00:00', 0, 0, 0),
(156, 3, 0, 1, '09:00:00', '21:00:00', 0, 0, 0),
(155, 3, 0, 0, '09:00:00', '17:00:00', 1, 0, 0),
(154, 2, 0, 6, '09:00:00', '17:00:00', 0, 0, 0),
(153, 2, 0, 5, '09:00:00', '17:00:00', 0, 0, 0),
(152, 2, 0, 4, '09:00:00', '17:00:00', 0, 0, 0),
(151, 2, 0, 3, '09:00:00', '21:00:00', 0, 0, 0),
(150, 2, 0, 2, '13:00:00', '21:00:00', 0, 0, 0),
(149, 2, 0, 1, '13:00:00', '21:00:00', 0, 0, 0),
(148, 2, 0, 0, '13:00:00', '21:00:00', 1, 0, 0),
(147, 1, 0, 6, '09:00:00', '17:00:00', 0, 0, 0),
(146, 1, 0, 5, '09:00:00', '17:00:00', 0, 0, 0),
(145, 1, 0, 4, '09:00:00', '21:00:00', 0, 0, 0),
(144, 1, 0, 3, '09:00:00', '21:00:00', 0, 0, 0),
(143, 1, 0, 2, '09:00:00', '21:00:00', 0, 0, 0),
(142, 1, 0, 1, '09:00:00', '21:00:00', 0, 0, 0),
(141, 1, 0, 0, '13:00:00', '17:00:00', 1, 0, 0);

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

/* You might need more or different ones*/

INSERT INTO `Season` (`SeasonID`, `SeasonName`) VALUES
(1, 'Fall'),
(2, 'Winter Break'),
(3, 'Spring'),
(4, 'Summer'),
(5, 'COVID hours');

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


INSERT INTO `Semesters` (`SemID`, `SemYear`, `SeasonID`, `DayStart`, `DayEnd`) VALUES
(1, 2020, 1, '2020-08-15', '2020-12-31');

-- --------------------------------------------------------
--

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

/* Not bothering to add any holidays.  Easier to do this through the interface. */

/* Nothing you need edit by hand beyond this point */

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

