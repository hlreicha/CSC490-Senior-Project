-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 14, 2020 at 05:03 PM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`hlreicha`@`localhost` PROCEDURE `deleteUser` (IN `id` INT(11))  BEGIN   
           DELETE FROM worked WHERE WorkedID = id;  
           END$$

CREATE DEFINER=`hlreicha`@`localhost` PROCEDURE `insertUser` (IN `ProductID` INT(11), `Quantity` INT(11), `Name` CHAR(25))  BEGIN  
                INSERT INTO inventory(ProductID, Quantity, Name) VALUES (ProductID, Quantity, Name);   
                END$$

CREATE DEFINER=`hlreicha`@`localhost` PROCEDURE `selectUser` (IN `id` INT(11))  BEGIN  
      SELECT * FROM schedule where SchedID = id;  
      END$$

CREATE DEFINER=`hlreicha`@`localhost` PROCEDURE `updateUser` (`id` INT(11), `Recorded_Start` INT(11), `Recorded_End` INT(11), `hours_worked` INT(5))  BEGIN   
                UPDATE worked SET Recorded_Start = Recorded_Start, Recorded_End = Recorded_End, `Hours Worked` = hours_worked  
                WHERE WorkedID = id;  
                END$$

CREATE DEFINER=`hlreicha`@`localhost` PROCEDURE `whereUser` (IN `id` INT(11))  BEGIN   
      SELECT * FROM worked WHERE WorkedID  = id;  
      END$$

DELIMITER ;

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
  `InventoryID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Name` char(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`InventoryID`, `ProductID`, `Quantity`, `Name`) VALUES
(52, 4, 12, 'Sumatra Roast'),
(51, 3, 17, 'Breakfast Roast'),
(50, 2, 10, 'French Roast'),
(53, 5, 5, 'Simple Syrup'),
(49, 1, 20, 'House Roast'),
(54, 6, 10, 'Mocha'),
(56, 7, 15, 'Whipped Cream'),
(57, 1, 120, 'Creamer');

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
(0, 1587963600, 2, 1588046400, 'hey man'),
(0, 1590987600, 4, 1591243200, 'hey man'),
(0, 1590987600, 5, 1591329600, 'hey man'),
(0, 1590987600, 6, 1591416000, 'hey man'),
(0, 1591592400, 0, 1592107200, 'hey man'),
(0, 1591592400, 4, 1591848000, 'hey man'),
(0, 1591592400, 5, 1591934400, 'hey man'),
(0, 1591592400, 6, 1592020800, 'hey man'),
(0, 1592197200, 0, 1592712000, 'hey man'),
(0, 1592197200, 1, 1592193600, 'hey man'),
(0, 1592197200, 2, 1592280000, 'hey man'),
(0, 1592197200, 3, 1592366400, 'hey man'),
(0, 1592197200, 4, 1592452800, 'hey man'),
(0, 1592197200, 5, 1592539200, 'hey man'),
(0, 1592197200, 6, 1592625600, 'hey man'),
(0, 1592802000, 1, 1592798400, 'hey man'),
(0, 1592802000, 2, 1592884800, 'hey man'),
(0, 1592802000, 3, 1592971200, 'hey man'),
(0, 1592802000, 4, 1593057600, 'hey man'),
(0, 1593406800, 3, 1593576000, 'hey man'),
(0, 1593406800, 4, 1593662400, 'hey man'),
(0, 1593406800, 5, 1593748800, 'hey man'),
(0, 1593406800, 6, 1593835200, 'hey man'),
(1, 1590987600, 4, 1591243200, 'hey man'),
(1, 1590987600, 5, 1591329600, 'hey man'),
(1, 1595826000, 0, 1596340800, 'hey man'),
(1, 1595826000, 6, 1596254400, 'hey man');

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
(1584334800, 0, 0, 1584917400, 1584917640, 'Test 3'),
(1584334800, 0, 3, 1584579600, 1584583200, 'Test'),
(1584334800, 0, 6, 1584835500, 0, 'Test 2'),
(1585544400, 0, 2, 1585681200, 1585710000, 'Laid Off'),
(1585544400, 0, 5, 1585940400, 1585969200, 'Quarantine '),
(1586149200, 0, 0, 1586199600, 1586228400, 'Laid Off'),
(1586149200, 1, 0, 1586199600, 1586228400, 'Qurantine'),
(1586149200, 1, 3, 1586368800, 1586397600, 'Boredom'),
(1586149200, 1, 6, 1586628000, 1586656800, 'Poverty'),
(1586754000, 1, 1, 1586800800, 1586829600, 'Sick'),
(1586754000, 1, 2, 1586887200, 1586916000, 'Laid Off'),
(1586754000, 2, 1, 1586800800, 1586829600, 'Sick'),
(1586754000, 2, 2, 1586887200, 1586916000, 'Laid Off');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`) VALUES
(17, 'Rosie', 'Peele'),
(18, 'Joseph', 'Harman'),
(19, 'John', 'Moss'),
(20, 'Lillie', 'Ferrari'),
(21, 'Yolanda', 'cbt'),
(23, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `worked`
--

CREATE TABLE `worked` (
  `WorkedID` int(11) NOT NULL,
  `Employee_ID` int(11) NOT NULL,
  `SchedID` int(11) NOT NULL,
  `DayCode` int(10) NOT NULL,
  `Recorded_Start` int(11) NOT NULL,
  `Recorded_End` int(11) NOT NULL,
  `Hours Worked` int(5) NOT NULL DEFAULT 0,
  `isLate` tinyint(1) NOT NULL DEFAULT 0,
  `isSched` tinyint(1) NOT NULL DEFAULT 1,
  `leftEarly` tinyint(1) NOT NULL DEFAULT 0,
  `isClockedIn` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `worked`
--

INSERT INTO `worked` (`WorkedID`, `Employee_ID`, `SchedID`, `DayCode`, `Recorded_Start`, `Recorded_End`, `Hours Worked`, `isLate`, `isSched`, `leftEarly`, `isClockedIn`) VALUES
(7, 0, 1585544400, 0, 1586130060, 1586130060, 3, 0, 0, 0, 0),
(8, 0, 1585544400, 0, 1586130106, 1586133793, 5, 0, 0, 0, 0),
(9, 0, 1585544400, 0, 1586088000, 1586109600, 0, 0, 1, 0, 0),
(10, 0, 1585544400, 6, 1586001600, 1585764000, 0, 0, 1, 0, 0),
(11, 0, 1585544400, 6, 1586001600, 1586023200, 0, 0, 1, 0, 0),
(12, 0, 1585544400, 0, 1586133788, 1586133793, 5, 0, 0, 0, 0),
(13, 0, 1585544400, 0, 1586133829, 1586133858, 29, 0, 0, 0, 0),
(14, 0, 1585544400, 0, 1586133867, 1586135494, 1627, 0, 0, 0, 0),
(15, 0, 1585544400, 5, 1585915200, 1585936800, 21600, 0, 1, 0, 0),
(17, 0, 1586149200, 1, 1586179620, 1586182920, 3300, 0, 0, 0, 0),
(18, 1, 1586149200, 3, 1586368800, 1586397600, 28800, 0, 1, 0, 0),
(19, 0, 1586149200, 4, 1586485074, 1586485075, 1, 0, 0, 0, 0),
(20, 1, 1586149200, 6, 1586626350, 1586626354, 4, 0, 0, 0, 0),
(40, 2, 1586754000, 1, 1586824218, 1586824219, 1, 1, 1, 1, 0),
(41, 2, 1586754000, 1, 1586824225, 1586824229, 4, 1, 1, 1, 0),
(42, 2, 1586754000, 1, 1586824273, 1586824274, 1, 1, 1, 1, 0),
(43, 2, 1586754000, 1, 1586824276, 1586824276, 0, 1, 1, 1, 0),
(44, 2, 1586754000, 1, 1586824281, 1586824287, 6, 1, 1, 1, 0),
(45, 2, 1586754000, 1, 1586824288, 1586824291, 3, 1, 1, 1, 0),
(46, 2, 1586754000, 1, 1586824292, 1586824292, 0, 1, 1, 1, 0),
(47, 2, 1586754000, 1, 1586824293, 1586824294, 1, 1, 1, 1, 0),
(48, 2, 1586754000, 1, 1586824326, 1586824330, 4, 1, 1, 1, 0),
(49, 2, 1586754000, 2, 1586879619, 1586880533, 914, 0, 1, 1, 0),
(50, 2, 1586754000, 2, 1586880538, 1586880542, 4, 0, 1, 1, 0);

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
  ADD PRIMARY KEY (`InventoryID`,`ProductID`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `worked`
--
ALTER TABLE `worked`
  ADD PRIMARY KEY (`WorkedID`),
  ADD KEY `Employee_ID` (`Employee_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `InventoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `worked`
--
ALTER TABLE `worked`
  MODIFY `WorkedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
  ADD CONSTRAINT `worked_ibfk_1` FOREIGN KEY (`Employee_ID`) REFERENCES `employee` (`Employee_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worked_ibfk_2` FOREIGN KEY (`SchedID`) REFERENCES `schedule` (`SchedID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
