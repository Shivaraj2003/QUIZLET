-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2023 at 10:17 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `leaderboard` ()  NO SQL SELECT DISTINCT q.quizname, s.score,s.totalscore,st.usn,st.name,s.usn
FROM score s, student st, quiz q
WHERE s.usn=st.usn AND q.quizid=s.quizid
ORDER BY score DESC$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE `dept` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`dept_id`, `dept_name`) VALUES
(1, 'CSE'),
(2, 'ISE'),
(3, 'ECE'),
(4, 'EEE');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `qs` varchar(200) NOT NULL,
  `op1` varchar(30) NOT NULL,
  `op2` varchar(30) NOT NULL,
  `op3` varchar(30) NOT NULL,
  `op4` varchar(255) NOT NULL,
  `quizid` int(11) NOT NULL,
  `question_id` int(20) NOT NULL,
  `answers` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qs`, `op1`, `op2`, `op3`, `op4`, `quizid`, `question_id`, `answers`) VALUES
('DBMS Fullform', 'Date Base Management System', 'Data Base Management System', 'Date Bias Management System', 'Date Based Management System', 1, 1, 'Data Base Management System'),
('DBMS Textbook Author', 'Maxwell', 'Navathe', 'Mc Grewal', 'Smith', 1, 2, 'Navathe'),
('Pick Odd One', 'SQL', 'My SQL', 'Oracle', 'C++', 1, 3, 'C++'),
('CNS deals with', 'Computer Graphics', 'Computer Visualization', 'Computer Networks', 'Computer Organization', 2, 4, 'Computer Networks'),
('SHA stands for', 'Simple Hashing Algorithm', 'Secured Hashing Algorithm', 'Single Hashing Algorithm', 'Signed Hashing Algorithm', 2, 5, 'Secured Hashing Algorithm'),
('404 Error means', 'Not found', 'Invalid', 'Overload', 'None', 2, 6, 'Not found'),
('CSE stands for', 'Computer Science Engineering', 'Computer Social Engineering', 'College Science Engineering', 'Civil Science Engineering', 3, 7, 'Computer Science Engineering'),
('Unix is a', 'Opearating System', 'Software', 'Programming Language', 'Hardware', 4, 8, 'Opearating System'),
('uid means', 'useless id', 'user id', 'unknown id', 'useful id', 4, 9, 'user id'),
('Process can be created using', 'Fork', 'VFork', 'mkprocess', 'makeProcess', 4, 10, 'Fork');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quizid` int(11) NOT NULL,
  `quizname` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `staffid` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quizid`, `quizname`, `date_created`, `staffid`) VALUES
(1, 'dbms', '2023-01-09 15:11:39', '101'),
(2, 'cns', '2023-01-09 15:42:34', '101'),
(3, 'cse', '2023-01-15 12:39:32', '101'),
(4, 'unix', '2023-01-17 07:57:00', '101');

--
-- Triggers `quiz`
--
DELIMITER $$
CREATE TRIGGER `ondeleteqs` AFTER DELETE ON `quiz` FOR EACH ROW delete from questions where questions.quizid=old.quizid
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `slno` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `quizid` int(11) NOT NULL,
  `usn` varchar(30) NOT NULL,
  `totalscore` int(11) NOT NULL,
  `remark` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`slno`, `score`, `quizid`, `usn`, `totalscore`, `remark`) VALUES
(1, 1, 1, '4MT20CS153', 1, 'Good'),
(80, 0, 1, '4MT20CS153', 1, 'Bad'),
(81, 2, 2, '4MT21CS111', 2, 'Good'),
(82, 2, 1, '4MT21CS111', 3, 'Good'),
(83, 3, 1, '4MT21CS111', 3, 'Good'),
(84, 3, 1, '4MT20CS153', 3, 'Good'),
(85, 2, 2, '4MT20CS153', 2, 'Good'),
(86, 3, 1, '4MT20CS132', 3, 'Good'),
(87, 1, 2, '4MT20CS132', 2, 'Good'),
(88, 3, 1, 'CS154', 3, 'Good'),
(89, 3, 1, '4MT20CS153', 3, 'Good'),
(90, 2, 1, '4MT20CS153', 3, 'Good'),
(91, 3, 1, '4MT20CS153', 3, 'Good'),
(92, 3, 4, '4MT20CS153', 3, 'Good');

--
-- Triggers `score`
--
DELIMITER $$
CREATE TRIGGER `remarks` BEFORE INSERT ON `score` FOR EACH ROW SET NEW.remark = IF(NEW.score < NEW.totalscore / 2, 'Bad', 'Good')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffid` varchar(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `phno` varchar(10) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `DOB` varchar(10) NOT NULL,
  `pw` varchar(200) NOT NULL,
  `dept` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `name`, `mail`, `phno`, `gender`, `DOB`, `pw`, `dept`) VALUES
('101', 'SHIVARAJ SHETTY', 'staff@mite', '7483942724', 'M', '1992-01-06', 'password', 'ISE'),
('102', 'rakesh trivadi', 'rakesh@1', '9611838984', 'M', '1974-07-20', 'rakesh', 'ISE');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `usn` varchar(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `phno` varchar(10) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `DOB` varchar(10) NOT NULL,
  `pw` varchar(200) NOT NULL,
  `dept` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`usn`, `name`, `mail`, `phno`, `gender`, `DOB`, `pw`, `dept`) VALUES
('4MT20CS132', 'Sagar', 'sagar@123', '9741734545', 'M', '2000-01-01', 'Sagar@123', 'CSE'),
('4MT20CS153', 'Shivaraj Shetty', 'shivarajshetty@9423', '7483942724', 'M', '2003-04-09', 'Shivaraj@123', 'CSE'),
('4MT21CS111', 'Rakesh Shetty', 'abc@gmail.com', '9632653853', 'M', '2002-01-02', 'Rakesh@123', 'ISE'),
('4SC19CS022', 'Student', 'student@sahyadri.com', '8786788909', 'M', '2001-01-08', 'student@123', 'ISE'),
('4sf19cs54', 'siddanth', 'siddanth@gmail.com', '9972343444', 'M', '2011-02-10', 'siddanth@1', 'CSE'),
('CS154', 'Shobith', 'tester@gmail.com', '9876543212', 'M', '2002-04-16', 'Shobhi@1', 'CSE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD UNIQUE KEY `qs` (`qs`),
  ADD KEY `quizid` (`quizid`),
  ADD KEY `quizid_2` (`quizid`),
  ADD KEY `quizid_3` (`quizid`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quizid`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`slno`),
  ADD KEY `quizid` (`quizid`),
  ADD KEY `usn` (`usn`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`),
  ADD UNIQUE KEY `mail` (`mail`,`phno`),
  ADD UNIQUE KEY `staffid` (`staffid`),
  ADD KEY `mail_2` (`mail`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`usn`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `phno` (`phno`),
  ADD UNIQUE KEY `usn` (`usn`),
  ADD KEY `dept` (`dept`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quizid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`quizid`) REFERENCES `quiz` (`quizid`) ON DELETE CASCADE,
  ADD CONSTRAINT `score_ibfk_3` FOREIGN KEY (`usn`) REFERENCES `student` (`usn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
