-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2019 at 12:23 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pqsolutionsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `code` varchar(10) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`code`, `description`) VALUES
('MIT801', 'COMPUTER TECHNOLOGY'),
('MIT802', 'DATABASE MANAGEMENT'),
('MIT823', 'INFORMATION SYSTEMS AND BUSINESS DECISION MAKING');

-- --------------------------------------------------------

--
-- Table structure for table `qahistory`
--

CREATE TABLE IF NOT EXISTS `qahistory` (
  `qid` int(11) NOT NULL,
  `course` text NOT NULL,
  `description` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qahistory`
--

INSERT INTO `qahistory` (`qid`, `course`, `description`, `answer`) VALUES
(26, 'MIT801', 'Define Information Systems', 'IS is the coordination between  people, processes, information and software to support decision making\r\n'),
(27, 'MIT801', 'Define AI', 'AI is a broad field of computer science focusing on getting machines to mimic human responses to real life incidents\r\n'),
(28, 'MIT802', 'Describe legacy systems', 'Legacy Systems are hardware and software systems designed to process information during the pre-dotcom era '),
(29, 'MIT802', 'Explain File Processing Systems', 'Systems that store data in flat files'),
(30, 'MIT802', 'Elucidate File Processing Systems', 'Systems that are tightly coupled to data structures'),
(31, 'MIT802', 'Elucidate Database Management Systems', 'Systems that store data in a relational structure'),
(32, 'MIT801', 'What is a computer virus', 'A malicious computer program that does harm to a system'),
(116, 'MIT802', 'How many students offer MIT801 in the department', '5');

-- --------------------------------------------------------

--
-- Table structure for table `tabledata`
--

CREATE TABLE IF NOT EXISTS `tabledata` (
  `ROWNUM` int(11) NOT NULL,
  `COLNUM` int(11) NOT NULL,
  `CONTENT` text NOT NULL,
  `OWNER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabledata`
--

INSERT INTO `tabledata` (`ROWNUM`, `COLNUM`, `CONTENT`, `OWNER`) VALUES
(3, 3, 'TABLEINFO', 36),
(3, 3, 'surname-firstname-sex-age', 37),
(4, 4, 'matno-coursecode-1112-MIT802', 115),
(5, 5, 'COURSE,MEMBERS;MIT811,12;MIT823,29;MIT839,34;', 116);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `names` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passphrase` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`names`, `email`, `passphrase`) VALUES
('ijeoma onyenuforo', 'oijay@gmail.com', 'RRCVZx4W/ziDdp3JK8mbVQ==\n'),
('sebastian stan', 'sstan@aol.com', 'bucky');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `qahistory`
--
ALTER TABLE `qahistory`
  ADD PRIMARY KEY (`qid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `qahistory`
--
ALTER TABLE `qahistory`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=117;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
