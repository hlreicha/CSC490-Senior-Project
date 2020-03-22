-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 21, 2020 at 11:51 PM
-- Server version: 10.2.10-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Test`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Employee_ID` int(11) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `First_Name` varchar(12) NOT NULL,
  `Last_Name` varchar(25) NOT NULL,
  `isManager` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Employee_ID`, `Password`, `First_Name`, `Last_Name`, `isManager`) VALUES
(0, 'Password', 'First_Name', 'Last_Name', 0),
(1, 'Bf4God', 'Pooya', 'Mootee', 1),
(2, 'LockedIn', 'Jacob', 'Oleson', 0),
(3, 'TheBushes', 'Brody', 'Gore', 1),
(4, 'Liver', 'Nancy', 'Green', 0),
(5, 'doIevenExist?', 'Brady', 'Gore', 1),
(7, 'SheetzGod', 'Rick', 'Brochert', 0),
(8, 'PoonMagnet', 'Austin', 'Mueller', 1),
(9, 'ImSad', 'Malcolm', 'Xavier', 1),
(10, 'Feet', 'William', 'Patterson', 1),
(11, 'CBT', 'Carl', 'Wheezer', 0),
(12, 'NoCarl1', 'Mrs.', 'Fritz', 1),
(13, 'Oklahoma', 'Harold', 'Malcom\'sDad', 0),
(14, 'brokenCar', 'Jason', 'Arias', 1),
(15, 'GreenLover', 'Matthew', 'Malzahn', 0),
(16, 'noSpencer!', 'Zoe', 'Lambestos', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Name` char(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `Employee_ID` int(11) NOT NULL,
  `SchedID` int(11) NOT NULL,
  `DayCode` int(10) NOT NULL,
  `Day` int(11) NOT NULL,
  `Reason` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`Employee_ID`, `SchedID`, `DayCode`, `Day`, `Reason`) VALUES
(0, 1587358800, 0, 1587873600, 'hey man'),
(0, 1587358800, 3, 1587528000, 'hey man'),
(0, 1587358800, 5, 1587700800, 'hey man'),
(0, 1587358800, 6, 1587787200, 'hey man'),
(0, 1587963600, 1, 1587960000, 'hey man'),
(0, 1587963600, 2, 1588046400, 'hey man');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `SchedID` int(11) NOT NULL,
  `Employee_ID` int(11) NOT NULL,
  `DayCode` int(10) NOT NULL,
  `Start_Time` int(11) NOT NULL,
  `End_Time` int(11) NOT NULL,
  `Position` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`SchedID`, `Employee_ID`, `DayCode`, `Start_Time`, `End_Time`, `Position`) VALUES
(1584334800, 0, 3, 1584579600, 1584583200, 'Test'),
(1584334800, 0, 6, 1584835500, 0, 'Test 2');

-- --------------------------------------------------------

--
-- Table structure for table `worked`
--

CREATE TABLE `worked` (
  `Employee_ID` int(11) NOT NULL,
  `SchedID` int(11) NOT NULL,
  `DayCode` int(10) NOT NULL,
  `Recorded_Start` int(11) NOT NULL,
  `Recorded_End` int(11) NOT NULL,
  `isLate` tinyint(1) NOT NULL DEFAULT 0,
  `isSched` tinyint(1) NOT NULL DEFAULT 1,
  `isClockedIn` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`Employee_ID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`Employee_ID`,`SchedID`,`DayCode`),
  ADD KEY `SchedID` (`SchedID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`SchedID`,`Employee_ID`,`DayCode`),
  ADD KEY `schedule_ibfk_1` (`Employee_ID`);

--
-- Indexes for table `worked`
--
ALTER TABLE `worked`
  ADD PRIMARY KEY (`Employee_ID`,`SchedID`,`DayCode`),
  ADD KEY `worked_ibfk_1` (`SchedID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`Employee_ID`) REFERENCES `employee` (`Employee_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`Employee_ID`) REFERENCES `employee` (`Employee_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `worked`
--
ALTER TABLE `worked`
  ADD CONSTRAINT `worked_ibfk_1` FOREIGN KEY (`SchedID`) REFERENCES `schedule` (`SchedID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worked_ibfk_2` FOREIGN KEY (`Employee_ID`) REFERENCES `employee` (`Employee_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
