-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2022 at 09:55 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

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
(10001, 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `application_id` varchar(15) NOT NULL,
  `cid` varchar(15) NOT NULL,
  `questionid` varchar(15) NOT NULL,
  `video` longblob NOT NULL,
  `mark` int(11) DEFAULT NULL
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

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`application_id`, `status`, `date`, `roleid`) VALUES
('A0001', 'scored', '2022-02-28', 'R00001'),
('A0002', 'pending', '2022-02-28', 'R00001');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `name` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
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
  `id` varchar(6) NOT NULL,
  `profile` longblob NOT NULL,
  `mime` varchar(10) NOT NULL,
  `account_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `canfilter`
-- (See below for the actual view)
--
CREATE TABLE `canfilter` (
`name` varchar(50)
,`gender` varchar(10)
,`per10` float
,`per12` float
,`ugcgpa` float
,`pgcgpa` float
,`email` varchar(50)
,`work` varchar(100)
,`projects` varchar(75)
,`intern` varchar(50)
,`interests` varchar(50)
,`resume` mediumblob
,`id` varchar(6)
,`application_id` varchar(15)
,`vidscore` decimal(32,0)
,`selrole` varchar(15)
);

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

--
-- Dumping data for table `hires`
--

INSERT INTO `hires` (`AdminID`, `cid`, `application_id`, `status`, `tag`, `rating`) VALUES
(10001, 'C0001', 'A0001', 'Selected', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ques`
--

CREATE TABLE `ques` (
  `questionid` varchar(5) NOT NULL,
  `question` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ques`
--

INSERT INTO `ques` (`questionid`, `question`) VALUES
('Q0001', 'Describe briefly about yourself'),
('Q0002', 'Why would like to apply to this post?'),
('Q0003', 'Tell us about your most recent project work'),
('Q0004', 'Are you a good team leader? Why or why not?');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `questionid` varchar(15) NOT NULL,
  `question` varchar(150) NOT NULL,
  `role_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`questionid`, `question`, `role_id`) VALUES
('Q0001', 'Describe briefly about yourself', 'R00001'),
('Q0003', 'Tell us about your most recent project work', 'R00001');

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
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleid`, `Name`, `requirement`, `qualification`, `last_date`) VALUES
('R00001', 'Data Analyst', 'UG and PG CGPA above 8', 'MCA', '2022-03-03'),
('R00002', 'Software Engineer', 'Overall Percentage above 80%', 'B.Tech , M.Tech, M.Sc, B.Sc', '2022-03-08');

-- --------------------------------------------------------

--
-- Structure for view `canfilter`
--
DROP TABLE IF EXISTS `canfilter`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `canfilter`  AS SELECT `candidate`.`name` AS `name`, `candidate`.`gender` AS `gender`, `candidate`.`per10` AS `per10`, `candidate`.`per12` AS `per12`, `candidate`.`ugcgpa` AS `ugcgpa`, `candidate`.`pgcgpa` AS `pgcgpa`, `candidate`.`email` AS `email`, `candidate`.`work` AS `work`, `candidate`.`projects` AS `projects`, `candidate`.`intern` AS `intern`, `candidate`.`interests` AS `interests`, `candidate`.`resume` AS `resume`, `candidate`.`id` AS `id`, `ans`.`application_id` AS `application_id`, `ans`.`vidscore` AS `vidscore`, `grole`.`selrole` AS `selrole` FROM ((`candidate` left join (select `answers`.`application_id` AS `application_id`,`answers`.`cid` AS `cid`,sum(`answers`.`mark`) AS `vidscore` from `answers` group by `answers`.`application_id`,`answers`.`cid`) `ans` on(`candidate`.`id` = `ans`.`cid`)) left join (select `roles`.`roleid` AS `selrole`,`application`.`application_id` AS `application_id`,`roles`.`Name` AS `Name` from (`roles` left join `application` on(`roles`.`roleid` = `application`.`roleid`))) `grole` on(`ans`.`application_id` = `grole`.`application_id`)) ;

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
  ADD PRIMARY KEY (`application_id`,`cid`,`questionid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `questionid` (`questionid`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `application_ibfk_1` (`roleid`);

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
  ADD PRIMARY KEY (`AdminID`,`cid`,`application_id`),
  ADD KEY `hires_ibfk_2` (`cid`),
  ADD KEY `hires_ibfk_3` (`application_id`);

--
-- Indexes for table `ques`
--
ALTER TABLE `ques`
  ADD PRIMARY KEY (`questionid`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`questionid`,`role_id`),
  ADD KEY `question_ibfk_1` (`role_id`);

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
  MODIFY `AdminID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10002;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`roleid`),
  ADD CONSTRAINT `question_ibfk_4` FOREIGN KEY (`questionid`) REFERENCES `ques` (`questionid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
