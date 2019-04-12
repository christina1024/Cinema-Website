-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2019 at 11:42 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinemaDB`
--
CREATE DATABASE IF NOT EXISTS `cinemaDB` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cinemaDB`;

-- --------------------------------------------------------

--
-- Table structure for table `actin`
--

DROP TABLE IF EXISTS `actin`;
CREATE TABLE `actin` (
  `movieIMDB` int(11) NOT NULL,
  `actorIMDB` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actin`
--

INSERT INTO `actin` (`movieIMDB`, `actorIMDB`) VALUES
(123, 375),
(123, 263265),
(123, 424060),
(123, 1165110),
(8567, 375),
(8567, 263265),
(8567, 1659221),
(12345, 1234),
(12345, 468399),
(85468, 148),
(85468, 515116),
(85647, 468399),
(85647, 896801);

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

DROP TABLE IF EXISTS `actor`;
CREATE TABLE `actor` (
  `IMDBID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `yearsActive` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actor`
--

INSERT INTO `actor` (`IMDBID`, `name`, `gender`, `yearsActive`) VALUES
(148, 'Harrison Ford', NULL, NULL),
(375, 'Robert Downey', 'male', NULL),
(1234, 'alice', NULL, NULL),
(5476, 'Hillary Swank', NULL, NULL),
(263265, 'Chris Evens', NULL, NULL),
(424060, 'Scarlett Johansson', NULL, NULL),
(468399, 'Esko Kovero', NULL, NULL),
(515116, 'Blake Lively', NULL, NULL),
(896801, 'Vessa Vierikko', NULL, NULL),
(1165110, 'Chris Hemsworth', NULL, NULL),
(1659221, 'Sebastian Stan ', NULL, NULL);

--
-- Triggers `actor`
--
DROP TRIGGER IF EXISTS `chkActo`;
DELIMITER $$
CREATE TRIGGER `chkActo` BEFORE INSERT ON `actor` FOR EACH ROW BEGIN
  IF NEW.name = '' OR NEW.gender = '' OR NEW.yearsActive = '' THEN
    SIGNAL SQLSTATE '45000' ;
    END IF ;
  END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `upActo`;
DELIMITER $$
CREATE TRIGGER `upActo` BEFORE UPDATE ON `actor` FOR EACH ROW BEGIN
  IF NEW.name = '' OR NEW.gender = '' OR NEW.yearsActive = '' THEN
    SIGNAL SQLSTATE '45000' ;
    END IF ;
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cinema`
--

DROP TABLE IF EXISTS `cinema`;
CREATE TABLE `cinema` (
  `address` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `policy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cinema`
--

INSERT INTO `cinema` (`address`, `name`, `phoneNumber`, `policy`) VALUES
('Crowfoot Crossing', 'Crowfoot Crossing', '4035473316', NULL),
('East Hills', 'East Hills', '4037415689', NULL),
('Sunridge Spectrum', 'Sunridge Spectrum', '4037171200', NULL),
('Westhills', 'Westhills', '4032465291', NULL);

--
-- Triggers `cinema`
--
DROP TRIGGER IF EXISTS `chkCin`;
DELIMITER $$
CREATE TRIGGER `chkCin` BEFORE INSERT ON `cinema` FOR EACH ROW BEGIN
  IF NEW.address = '' OR NEW.name = '' OR CHAR_LENGTH(NEW.phoneNumber) <> 10 THEN
    SIGNAL SQLSTATE '45000' ;
    END IF ;
  END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `upCin`;
DELIMITER $$
CREATE TRIGGER `upCin` BEFORE UPDATE ON `cinema` FOR EACH ROW BEGIN
  IF NEW.address = '' OR NEW.name = '' OR CHAR_LENGTH(NEW.phoneNumber) <> 10 THEN
    SIGNAL SQLSTATE '45000' ;
    END IF ;
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `userName` varchar(50) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `CCInfo` varchar(255) DEFAULT NULL,
  `age` tinyint(4) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`userName`, `passwd`, `CCInfo`, `age`, `name`, `phoneNumber`) VALUES
('1', '1', '1234567812345678', 20, 'john', '4031234567'),
('Alice0', '123', '1234567812345678', 22, 'Alice', '4031234567'),
('Alice12', '123', '1234567812345678', 0, 'AliceX', '4031234567');

--
-- Triggers `customer`
--
DROP TRIGGER IF EXISTS `chkCust`;
DELIMITER $$
CREATE TRIGGER `chkCust` BEFORE INSERT ON `customer` FOR EACH ROW BEGIN
  IF NEW.userName = '' OR NEW.passwd = '' THEN
    SIGNAL SQLSTATE '45000' ;
  ELSEIF CHAR_LENGTH(NEW.phoneNumber) <> 10 AND NEW.phoneNumber IS NOT NULL THEN
    SIGNAL SQLSTATE '45000' ;
    END IF ;
  END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `upCust`;
DELIMITER $$
CREATE TRIGGER `upCust` BEFORE UPDATE ON `customer` FOR EACH ROW BEGIN
  IF NEW.passwd = '' THEN
    SIGNAL SQLSTATE '45000' ;
  ELSEIF CHAR_LENGTH(NEW.phoneNumber) <> 10 AND NEW.phoneNumber IS NOT NULL THEN
    SIGNAL SQLSTATE '45000' ;
    END IF ;
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
CREATE TABLE `food` (
  `foodID` smallint(6) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `TYPE` varchar(255) NOT NULL,
  `price` double(4,2) NOT NULL,
  `size` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(125) NOT NULL DEFAULT 'image/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`foodID`, `name`, `TYPE`, `price`, `size`, `description`, `image`) VALUES
(1, 'fries', 'Fries', 5.00, 'original', NULL, 'image/fries2.jpg'),
(2, 'Chips_Poutine', 'Fries', 7.00, 'original', NULL, 'image/Chips_Poutine.png'),
(3, 'French-Fries', 'Fries', 4.00, 'small', NULL, 'image/Fries3.png'),
(4, 'fries', 'Fries', 6.00, 'small', NULL, 'image/fries4.png'),
(5, 'Coke', 'Drink', 4.00, 'small', NULL, 'image/Coke.png'),
(6, 'Coke2L', 'Drink', 7.00, 'large', NULL, 'image/coke2L.png'),
(7, 'Coffee', 'Drink', 5.50, 'orginal', NULL, 'image/coffee.png'),
(8, 'Juice', 'Drink', 6.00, 'original', NULL, 'image/juice.png'),
(9, 'MilkShake', 'Drink', 8.00, '', NULL, 'image/shake.png'),
(10, 'Cheese Burger', 'food', 8.00, '', NULL, 'image/burger.png');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE `genre` (
  `genre` varchar(255) NOT NULL,
  `movieIMDB` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre`, `movieIMDB`) VALUES
('action', 123),
('adventure', 85647),
('romance', 12345),
('romance', 85468);

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

DROP TABLE IF EXISTS `movie`;
CREATE TABLE `movie` (
  `IMDBID` int(11) NOT NULL,
  `addedBy` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `runTime` time NOT NULL,
  `producer` varchar(255) DEFAULT NULL,
  `synopsis` text,
  `director` varchar(255) DEFAULT NULL,
  `FORMAT` varchar(255) DEFAULT NULL,
  `releaseDate` date NOT NULL,
  `writer` varchar(255) DEFAULT NULL,
  `image` varchar(250) NOT NULL DEFAULT 'image/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`IMDBID`, `addedBy`, `name`, `runTime`, `producer`, `synopsis`, `director`, `FORMAT`, `releaseDate`, `writer`, `image`) VALUES
(123, 'admin', 'Avenger', '02:20:30', '', '', '', '', '2018-02-06', '', 'image/avenger.jpg'),
(8567, 'admin', 'WinterSolider', '01:50:00', '', '', '', '', '2016-03-02', '', 'image/winterS.jpg'),
(12345, 'admin', '55', '02:20:30', '', '', '', '', '2019-04-05', '', 'image/55.jpg'),
(85468, 'admin', 'Age Of Adline', '02:20:30', '', '', '', '', '2018-06-14', '', 'image/AofA.jpg'),
(85647, 'admin', 'WinterWar', '00:00:00', '', '', '', '', '2019-04-15', '', 'image/winterW.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

DROP TABLE IF EXISTS `offer`;
CREATE TABLE `offer` (
  `foodID` smallint(6) NOT NULL,
  `cinemaAddr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `overseer`
--

DROP TABLE IF EXISTS `overseer`;
CREATE TABLE `overseer` (
  `userName` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `passwd` varchar(255) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `adminFlag` bit(1) DEFAULT NULL,
  `manFlag` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `overseer`
--

INSERT INTO `overseer` (`userName`, `name`, `passwd`, `phoneNumber`, `adminFlag`, `manFlag`) VALUES
('admin', 'jacky', '123', '1234565432', b'1', b'0'),
('Alice', 'AliceX', '123', '4031234567', b'0', b'1'),
('man', 'jackJr', 'imbetterthandad', '4445556789', b'0', b'1');

--
-- Triggers `overseer`
--
DROP TRIGGER IF EXISTS `chkOver`;
DELIMITER $$
CREATE TRIGGER `chkOver` BEFORE INSERT ON `overseer` FOR EACH ROW BEGIN
    IF NEW.userName = '' OR NEW.passwd = '' OR CHAR_LENGTH(NEW.phoneNumber) <> 10 OR NEW.name = '' OR NEW.adminFlag = NEW.manFlag THEN
      SIGNAL SQLSTATE '45000' ;
      END IF ;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `playin`
--

DROP TABLE IF EXISTS `playin`;
CREATE TABLE `playin` (
  `movieIMDB` int(11) NOT NULL,
  `cinemaAddr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `playin`
--

INSERT INTO `playin` (`movieIMDB`, `cinemaAddr`) VALUES
(123, 'Crowfoot Crossing'),
(123, 'Sunridge Spectrum'),
(123, 'Westhills'),
(8567, 'Sunridge Spectrum'),
(8567, 'Westhills'),
(12345, 'Crowfoot Crossing'),
(85468, 'Crowfoot Crossing'),
(85468, 'East Hills'),
(85647, 'Sunridge Spectrum');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
CREATE TABLE `purchase` (
  `foodID` smallint(6) NOT NULL,
  `customer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`foodID`, `customer`) VALUES
(10, 'Alice0'),
(3, 'Alice0'),
(4, 'Alice0');

-- --------------------------------------------------------

--
-- Table structure for table `showtime`
--

DROP TABLE IF EXISTS `showtime`;
CREATE TABLE `showtime` (
  `DTime` datetime NOT NULL,
  `price` double(4,2) NOT NULL,
  `cinemaAddr` varchar(255) NOT NULL,
  `roomNum` tinyint(4) NOT NULL,
  `IMDB` int(11) NOT NULL,
  `manUsr` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `showtime`
--

INSERT INTO `showtime` (`DTime`, `price`, `cinemaAddr`, `roomNum`, `IMDB`, `manUsr`) VALUES
('2019-04-02 00:00:00', 6.00, 'Crowfoot Crossing', 101, 12345, 'Alice'),
('2019-04-03 01:59:00', 20.00, 'Crowfoot Crossing', 101, 123, 'Alice'),
('2019-04-03 15:00:00', 8.00, 'Sunridge Spectrum', 101, 8567, 'Alice'),
('2019-04-05 17:59:00', 12.00, 'Crowfoot Crossing', 101, 85468, 'Alice'),
('2019-04-10 15:00:00', 15.00, 'East Hills', 101, 85468, 'Alice'),
('2019-04-13 13:00:00', 15.00, 'Crowfoot Crossing', 101, 85468, 'Alice'),
('2019-04-13 13:00:00', 7.00, 'Sunridge Spectrum', 103, 85647, 'Alice'),
('2019-04-15 03:00:00', 2.00, 'Sunridge Spectrum', 101, 123, 'Alice'),
('2019-04-18 23:00:00', 20.00, 'Crowfoot Crossing', 101, 123, 'man'),
('2019-04-21 00:00:00', 5.00, 'Crowfoot Crossing', 104, 85647, 'Alice'),
('2019-04-21 18:38:00', 3.00, 'Westhills', 101, 8567, 'Alice'),
('2019-04-23 13:40:00', 4.00, 'Crowfoot Crossing', 102, 12345, 'Alice'),
('2019-06-19 10:00:00', 5.00, 'Westhills', 101, 123, 'Alice');

-- --------------------------------------------------------

--
-- Table structure for table `theater`
--

DROP TABLE IF EXISTS `theater`;
CREATE TABLE `theater` (
  `roomNum` tinyint(4) NOT NULL,
  `cinemaAddr` varchar(255) NOT NULL,
  `numSeats` smallint(6) NOT NULL,
  `TYPE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `theater`
--

INSERT INTO `theater` (`roomNum`, `cinemaAddr`, `numSeats`, `TYPE`) VALUES
(101, 'Crowfoot Crossing', 0, NULL),
(101, 'East Hills', 100, NULL),
(101, 'Sunridge Spectrum', 50, NULL),
(101, 'Westhills', 66, NULL),
(102, 'Crowfoot Crossing', 77, NULL),
(102, 'East Hills', 120, NULL),
(102, 'Sunridge Spectrum', 80, NULL),
(102, 'Westhills', 65, NULL),
(103, 'Crowfoot Crossing', 77, NULL),
(103, 'East Hills', 100, NULL),
(103, 'Sunridge Spectrum', 6, NULL),
(103, 'Westhills', 77, NULL),
(104, 'Crowfoot Crossing', 50, NULL),
(104, 'East Hills', 80, NULL),
(104, 'Sunridge Spectrum', 20, NULL),
(104, 'Westhills', 85, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket` (
  `DTime` datetime NOT NULL,
  `cinemaAddr` varchar(255) NOT NULL,
  `roomNum` tinyint(4) NOT NULL,
  `IMDB` int(11) NOT NULL,
  `customer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ticket`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `actin`
--
ALTER TABLE `actin`
  ADD PRIMARY KEY (`movieIMDB`,`actorIMDB`),
  ADD KEY `actorIMDB` (`actorIMDB`);

--
-- Indexes for table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`IMDBID`);

--
-- Indexes for table `cinema`
--
ALTER TABLE `cinema`
  ADD PRIMARY KEY (`address`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`userName`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`foodID`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre`,`movieIMDB`),
  ADD KEY `movieIMDB` (`movieIMDB`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`IMDBID`),
  ADD KEY `fk` (`addedBy`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`foodID`,`cinemaAddr`),
  ADD KEY `cinemaAddr` (`cinemaAddr`);

--
-- Indexes for table `overseer`
--
ALTER TABLE `overseer`
  ADD PRIMARY KEY (`userName`);

--
-- Indexes for table `playin`
--
ALTER TABLE `playin`
  ADD PRIMARY KEY (`movieIMDB`,`cinemaAddr`),
  ADD KEY `cinemaAddr` (`cinemaAddr`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`foodID`,`customer`),
  ADD KEY `customer` (`customer`);

--
-- Indexes for table `showtime`
--
ALTER TABLE `showtime`
  ADD PRIMARY KEY (`DTime`,`cinemaAddr`,`roomNum`,`IMDB`),
  ADD KEY `cinemaAddr` (`cinemaAddr`,`roomNum`),
  ADD KEY `IMDB` (`IMDB`),
  ADD KEY `manUsr` (`manUsr`);

--
-- Indexes for table `theater`
--
ALTER TABLE `theater`
  ADD PRIMARY KEY (`roomNum`,`cinemaAddr`),
  ADD KEY `cinemaAddr` (`cinemaAddr`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`DTime`,`cinemaAddr`,`roomNum`,`IMDB`,`customer`),
  ADD KEY `customer` (`customer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `foodID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actin`
--
ALTER TABLE `actin`
  ADD CONSTRAINT `actin_ibfk_1` FOREIGN KEY (`movieIMDB`) REFERENCES `movie` (`IMDBID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `actin_ibfk_2` FOREIGN KEY (`actorIMDB`) REFERENCES `actor` (`IMDBID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `genre`
--
ALTER TABLE `genre`
  ADD CONSTRAINT `genre_ibfk_1` FOREIGN KEY (`movieIMDB`) REFERENCES `movie` (`IMDBID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `fk` FOREIGN KEY (`addedBy`) REFERENCES `overseer` (`userName`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `offer`
--
ALTER TABLE `offer`
  ADD CONSTRAINT `offer_ibfk_1` FOREIGN KEY (`foodID`) REFERENCES `food` (`foodID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offer_ibfk_2` FOREIGN KEY (`cinemaAddr`) REFERENCES `cinema` (`address`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playin`
--
ALTER TABLE `playin`
  ADD CONSTRAINT `playin_ibfk_1` FOREIGN KEY (`movieIMDB`) REFERENCES `movie` (`IMDBID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `playin_ibfk_2` FOREIGN KEY (`cinemaAddr`) REFERENCES `cinema` (`address`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`foodID`) REFERENCES `food` (`foodID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`customer`) REFERENCES `customer` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `showtime`
--
ALTER TABLE `showtime`
  ADD CONSTRAINT `showtime_ibfk_1` FOREIGN KEY (`cinemaAddr`,`roomNum`) REFERENCES `theater` (`cinemaAddr`, `roomNum`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `showtime_ibfk_2` FOREIGN KEY (`IMDB`) REFERENCES `movie` (`IMDBID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `showtime_ibfk_3` FOREIGN KEY (`manUsr`) REFERENCES `overseer` (`userName`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `theater`
--
ALTER TABLE `theater`
  ADD CONSTRAINT `theater_ibfk_1` FOREIGN KEY (`cinemaAddr`) REFERENCES `cinema` (`address`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`DTime`,`cinemaAddr`,`roomNum`,`IMDB`) REFERENCES `showtime` (`DTime`, `cinemaAddr`, `roomNum`, `IMDB`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`customer`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
