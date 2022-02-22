-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2022 at 08:44 AM
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
('ISSAC KINGSLIN G', 'candidate', '9/47A NEHRU NAGAR EAST,CIVIL AERODROME POST,COIMBA', 'male', '2000-09-19', 8523959368, 641014, 93, 77, 93, 0, 'kingslin.gnanasekar@gmail.com', '-', 'Student Requisites Android App', '-', 'Blockchain', 0x4973736163204b696e67736c696e20526573756d652e706466, 'C0001'),
('Muthu', 'welcome', '35B, Periyar Nagar,Coimbatore', 'male', '1999-04-09', 9465489784, 641035, 80, 60, 75, 60, 'muthu@gmail.com', '2', 'Machine Leaning in Farming', 'Zolo', 'Big Data', 0x492053454d204d43415f4f46464c494e4520434c4153532054542e706466, 'C0002'),
('Maran', 'welcome', '4A, Kalapatti,Coimbatore', 'male', '1998-05-12', 9465431546, 641045, 85, 70, 80, 80, 'maran@gmail.com', 'Caramel Corp 2 Years', 'Block Chain Payment', 'Toyola 2 years', 'Web Development', 0x4973736163204b696e67736c696e20526573756d652e706466, 'C0003');

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
('Q0001', 'What are your strengths?', 'R0001'),
('Q0002', 'What are your weaknesses?', 'R0001'),
('Q0003', 'Why do you want this job?', 'R0001'),
('Q0004', 'What\'s your ideal company?', 'R0002'),
('Q0005', 'What attracted you to this company?', 'R0002'),
('Q0006', 'Why should we hire you?', 'R0003'),
('Q0007', 'Why do you want this job?', 'R0004'),
('Q0008', 'Why should we hire you?', 'R0004');

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
('R0001', 'Manager', 'Overall CGPA 60%', 'MCA, B.E. CSE', '2022-02-16'),
('R0002', 'Associate Analyst', '60% CGPA overall', 'MCA', '2022-02-23'),
('R0003', 'Senior Analyst', '70% CGPA', 'MCA', '2022-02-24'),
('R0004', 'Clerk', '50 CGPA overall', 'Any Degree', '2022-02-05');

-- --------------------------------------------------------

--
-- Structure for view `canfilter`
--
DROP TABLE IF EXISTS `canfilter`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `canfilter`  AS SELECT `candidate`.`name` AS `name`, `candidate`.`gender` AS `gender`, `candidate`.`per10` AS `per10`, `candidate`.`per12` AS `per12`, `candidate`.`ugcgpa` AS `ugcgpa`, `candidate`.`pgcgpa` AS `pgcgpa`, `candidate`.`email` AS `email`, `candidate`.`work` AS `work`, `candidate`.`projects` AS `projects`, `candidate`.`intern` AS `intern`, `candidate`.`interests` AS `interests`, `candidate`.`resume` AS `resume`, `candidate`.`id` AS `id`, `ans`.`application_id` AS `application_id`, `ans`.`vidscore` AS `vidscore`, `grole`.`selrole` AS `selrole` FROM ((`candidate` left join (select `answers`.`application_id` AS `application_id`,`answers`.`cid` AS `cid`,sum(`answers`.`mark`) AS `vidscore` from `answers` group by `answers`.`application_id`,`answers`.`cid`) `ans` on(`candidate`.`id` = `ans`.`cid`)) left join (select `roles`.`roleid` AS `selrole`,`application`.`application_id` AS `application_id`,`roles`.`Name` AS `Name` from (`roles` left join `application` on(`roles`.`roleid` = `application`.`roleid`))) `grole` on(`ans`.`application_id` = `grole`.`application_id`))  ;

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
  ADD KEY `roleid` (`roleid`);

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
  ADD KEY `cid` (`cid`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`questionid`),
  ADD KEY `role_id` (`role_id`);

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
