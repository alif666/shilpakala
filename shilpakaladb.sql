-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2017 at 08:37 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shilpakaladb`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Block'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `date`, `created`, `modified`, `status`) VALUES
(1, '20171003085448', '2017-10-26', '2017-10-26 00:00:00', '2017-10-26 00:00:00', 1),
(2, '20171003095411', '2017-10-16', '2017-10-16 00:00:00', '2017-10-16 00:00:00', 2),
(3, '20171003100951', '2017-10-18', '2017-10-18 00:00:00', '2017-10-18 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hallbooking`
--

CREATE TABLE `hallbooking` (
  `id` int(11) NOT NULL,
  `hallbooking_id` varchar(100) NOT NULL,
  `hallname` varchar(50) DEFAULT NULL,
  `applicant_name` varchar(50) DEFAULT NULL,
  `designation` varchar(20) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `applicant_email` varchar(50) DEFAULT NULL,
  `organization` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `organization_head` varchar(50) DEFAULT NULL,
  `organization_head_telephone` varchar(20) DEFAULT NULL,
  `organization_head_designation` varchar(50) DEFAULT NULL,
  `name_of_drama` varchar(50) DEFAULT NULL,
  `writer_name` varchar(50) DEFAULT NULL,
  `director` varchar(50) DEFAULT NULL,
  `production_duration` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `total_stage_show` varchar(10) DEFAULT NULL,
  `before_discussion` varchar(200) DEFAULT NULL,
  `applicants_email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hallbooking`
--

INSERT INTO `hallbooking` (`id`, `hallbooking_id`, `hallname`, `applicant_name`, `designation`, `telephone`, `applicant_email`, `organization`, `address`, `organization_head`, `organization_head_telephone`, `organization_head_designation`, `name_of_drama`, `writer_name`, `director`, `production_duration`, `start_date`, `end_date`, `total_stage_show`, `before_discussion`, `applicants_email`) VALUES
(1, '20171003085448', 'theater studio hall', 'newOct', 'newOct', 'newOct', NULL, 'newOct', 'newOct', 'newOct', 'newOct', '', 'newOct', 'newOct', 'newOct', 'newOct', '2017-10-26', '2017-10-26', 'newOct', 'newOct', 'newOct'),
(2, '20171003095411', 'Main Theater Hall', 'Alif Lodi', 'SE', '01718521795', NULL, 'CTRLN', '31/4 A Block B Babor Road', 'kazi', '017111111111', '', 'GOO', 'GOO AUTHER', 'GOO PRODUCTIOn', '2', '2017-10-16', '2017-10-16', '3', 'NO DISCUSSION', 'aliflodi@gmail.com'),
(3, '20171003100951', 'experimental hall', 'hall', 'hall', 'hall', NULL, 'hall', 'hall', 'hall', 'hall', '', 'hall', 'hall', 'hall', 'hall', '2017-10-18', '2017-10-18', 'hall', 'hall', 'hall');

-- --------------------------------------------------------

--
-- Table structure for table `hallusetime`
--

CREATE TABLE `hallusetime` (
  `id` int(11) NOT NULL,
  `hallbooking_id` varchar(100) DEFAULT NULL,
  `hall_use_time` varchar(50) DEFAULT NULL,
  `hallname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hallusetime`
--

INSERT INTO `hallusetime` (`id`, `hallbooking_id`, `hall_use_time`, `hallname`) VALUES
(1, '20171003085448', 'Morning (9.30 am. - 2.00pm)', 'theater studio hall'),
(2, '20171003085448', 'Evening (3pm - 10pm)', 'theater studio hall'),
(3, '20171003095411', 'Morning (9.30 am. - 2.00pm)', 'Main Theater Hall'),
(4, '20171003095411', 'Evening (3pm - 10pm)', 'Main Theater Hall'),
(5, '20171003100951', 'Morning (9.30 am. - 2.00pm)', 'experimental hall'),
(6, '20171003100951', 'Evening (3pm - 10pm)', 'experimental hall');

-- --------------------------------------------------------

--
-- Table structure for table `productiontype`
--

CREATE TABLE `productiontype` (
  `id` int(11) NOT NULL,
  `hallbooking_id` varchar(100) DEFAULT NULL,
  `production_type` varchar(20) DEFAULT NULL,
  `hallname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productiontype`
--

INSERT INTO `productiontype` (`id`, `hallbooking_id`, `production_type`, `hallname`) VALUES
(1, '20171003085448', 'Drama', 'theater studio hall'),
(2, '20171003085448', 'Lokanatya', 'theater studio hall'),
(3, '20171003085448', 'others', 'theater studio hall'),
(4, '20171003095411', 'Drama', 'Main Theater Hall'),
(5, '20171003095411', 'Lokanatya', 'Main Theater Hall'),
(6, '20171003095411', 'Recital', 'Main Theater Hall'),
(7, '20171003095411', 'others', 'Main Theater Hall'),
(8, '20171003100951', '', 'experimental hall'),
(9, '20171003100951', '', 'experimental hall');

-- --------------------------------------------------------

--
-- Table structure for table `typeofstage`
--

CREATE TABLE `typeofstage` (
  `id` int(11) NOT NULL,
  `hallbooking_id` varchar(100) DEFAULT NULL,
  `type_of_stage` varchar(20) DEFAULT NULL,
  `hallname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `typeofstage`
--

INSERT INTO `typeofstage` (`id`, `hallbooking_id`, `type_of_stage`, `hallname`) VALUES
(1, '20171003085448', 'Praseniyama', 'theater studio hall'),
(2, '20171003085448', 'Eyarina', 'theater studio hall'),
(3, '20171003100951', 'Eyarina', 'experimental hall');

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE `user_admin` (
  `UserID` int(5) NOT NULL,
  `UserName` varchar(50) DEFAULT NULL,
  `UserType` varchar(50) DEFAULT NULL,
  `UserPassword` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_admin`
--

INSERT INTO `user_admin` (`UserID`, `UserName`, `UserType`, `UserPassword`) VALUES
(1, 'shilpa', 'Super Admin', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hallbooking`
--
ALTER TABLE `hallbooking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hallusetime`
--
ALTER TABLE `hallusetime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productiontype`
--
ALTER TABLE `productiontype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `typeofstage`
--
ALTER TABLE `typeofstage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `hallbooking`
--
ALTER TABLE `hallbooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `hallusetime`
--
ALTER TABLE `hallusetime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `productiontype`
--
ALTER TABLE `productiontype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `typeofstage`
--
ALTER TABLE `typeofstage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `UserID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
