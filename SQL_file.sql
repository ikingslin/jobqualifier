-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2022 at 12:46 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobqualifier`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `email`, `password`) VALUES
(1, 'issackingslin2000@gmail.com', 'welcome'),
(2, 'Preeti', 'welcome');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `application_id` varchar(15) NOT NULL,
  `cid` varchar(15) NOT NULL,
  `questionid` varchar(15) NOT NULL,
  `video` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `application_id` varchar(15) NOT NULL,
  `status` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `roleid` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `name` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `contact` bigint(10) UNSIGNED NOT NULL,
  `pincode` int(6) UNSIGNED NOT NULL,
  `per10` float NOT NULL,
  `per12` float NOT NULL,
  `ugcgpa` float NOT NULL,
  `pgcgpa` float DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `work` varchar(100) DEFAULT NULL,
  `projects` varchar(75) NOT NULL,
  `intern` varchar(50) DEFAULT NULL,
  `interests` varchar(50) NOT NULL,
  `resume` mediumblob NOT NULL,
  `id` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`name`, `password`, `address`, `gender`, `dob`, `contact`, `pincode`, `per10`, `per12`, `ugcgpa`, `pgcgpa`, `email`, `work`, `projects`, `intern`, `interests`, `resume`, `id`) VALUES
('ISSAC KINGSLIN G', 'candidate', '9/47A NEHRU NAGAR EAST,CIVIL AERODROME POST,COIMBA', 'male', '2000-09-19', 8523959368, 641014, 93, 77, 93, 0, 'kingslin.gnanasekar@gmail.com', '-', 'Student Requisites Android App', '-', 'Blockchain', 0x4973736163204b696e67736c696e20526573756d652e706466, 'C0001');

-- --------------------------------------------------------

--
-- Table structure for table `hires`
--

CREATE TABLE `hires` (
  `AdminID` int(5) NOT NULL,
  `cid` varchar(15) NOT NULL,
  `application_id` varchar(15) NOT NULL,
  `status` varchar(25) NOT NULL,
  `tag` varchar(25) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `questionid` varchar(15) NOT NULL,
  `question` varchar(150) NOT NULL,
  `role_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleid` varchar(15) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `requirement` varchar(100) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `last_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`application_id`,`cid`,`questionid`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact` (`contact`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `hires`
--
ALTER TABLE `hires`
  ADD PRIMARY KEY (`AdminID`,`cid`,`application_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`questionid`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`),
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `candidate` (`id`),
  ADD CONSTRAINT `answers_ibfk_3` FOREIGN KEY (`questionid`) REFERENCES `question` (`questionid`),
  ADD CONSTRAINT `answers_ibfk_4` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`),
  ADD CONSTRAINT `answers_ibfk_5` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`);

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `roles` (`roleid`);

--
-- Constraints for table `hires`
--
ALTER TABLE `hires`
  ADD CONSTRAINT `hires_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`),
  ADD CONSTRAINT `hires_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `candidate` (`id`),
  ADD CONSTRAINT `hires_ibfk_3` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`),
  ADD CONSTRAINT `hires_ibfk_4` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`),
  ADD CONSTRAINT `hires_ibfk_5` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`),
  ADD CONSTRAINT `hires_ibfk_6` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`roleid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
