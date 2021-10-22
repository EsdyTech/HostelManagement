-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2021 at 01:11 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `reg_date`, `updation_date`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '2016-04-04 20:31:45', '2020-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `adminlog`
--

CREATE TABLE `adminlog` (
  `id` int(11) NOT NULL,
  `adminid` int(11) NOT NULL,
  `ip` varbinary(16) NOT NULL,
  `logintime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(255) DEFAULT NULL,
  `course_sn` varchar(255) DEFAULT NULL,
  `course_fn` varchar(255) DEFAULT NULL,
  `posting_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_sn`, `course_fn`, `posting_date`) VALUES
(1, 'B10992', 'B.Tech', 'Bachelor  of Technology', '2020-07-04 19:31:42'),
(2, 'BCOM1453', 'B.Com', 'Bachelor Of commerce ', '2020-07-04 19:31:42'),
(3, 'BSC12', 'BSC', 'Bachelor  of Science', '2020-07-04 19:31:42'),
(4, 'BC36356', 'BCA', 'Bachelor Of Computer Application', '2020-07-04 19:31:42'),
(5, 'MCA565', 'MCA', 'Master of Computer Application', '2020-07-04 19:31:42'),
(6, 'MBA75', 'MBA', 'Master of Business Administration', '2020-07-04 19:31:42'),
(7, 'BE765', 'BE', 'Bachelor of Engineering', '2020-07-04 19:31:42');

-- --------------------------------------------------------

--
-- Table structure for table `feedingfee`
--

CREATE TABLE `feedingfee` (
  `Id` int(20) NOT NULL,
  `cost` int(20) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedingfee`
--

INSERT INTO `feedingfee` (`Id`, `cost`, `dateCreated`) VALUES
(2, 3500, '15-08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `hostelrooms`
--

CREATE TABLE `hostelrooms` (
  `Id` int(20) NOT NULL,
  `hostelId` int(20) NOT NULL,
  `roomName` varchar(255) NOT NULL,
  `roomDescription` varchar(500) NOT NULL,
  `isAllotted` varchar(10) NOT NULL,
  `studentAllottedTo` varchar(255) NOT NULL,
  `dateAllotted` varchar(20) NOT NULL,
  `dateCreated` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hostelrooms`
--

INSERT INTO `hostelrooms` (`Id`, `hostelId`, `roomName`, `roomDescription`, `isAllotted`, `studentAllottedTo`, `dateAllotted`, `dateCreated`) VALUES
(2, 7, 'Room AA', 'Testing Roomsss', 'No', '', '', '16-08-2021'),
(3, 7, 'Room B', 'Testing Room', 'No', '', '', '16-08-2021'),
(4, 8, 'Room A', 'Testing Room', 'Yes', '10806121', '16-08-2021', '16-08-2021'),
(6, 8, 'Room B', 'Testing Room', 'No', '', '', '16-08-2021'),
(9, 7, 'Room BA', 'Testing Room', 'No', '', '', '17-08-2021'),
(10, 7, 'Room BAS', 'Testing Room', 'No', '', '', '17-08-2021'),
(11, 7, 'Room BASS', 'Testing Room', 'No', '', '', '17-08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `hostels`
--

CREATE TABLE `hostels` (
  `id` int(11) NOT NULL,
  `hostelName` varchar(500) DEFAULT NULL,
  `noOfRooms` int(11) DEFAULT NULL,
  `noOfAvailableRooms` int(11) DEFAULT NULL,
  `fees` int(11) DEFAULT NULL,
  `location` varchar(500) DEFAULT NULL,
  `posting_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostels`
--

INSERT INTO `hostels` (`id`, `hostelName`, `noOfRooms`, `noOfAvailableRooms`, `fees`, `location`, `posting_date`) VALUES
(7, 'Lakeside Hostel', 5, 3, 2000, '24, Iseyin street', '2021-08-15 14:00:18'),
(8, 'Banana Hostels', 20, 17, 21000, 'lakeside view crescent', '2021-08-15 14:13:19');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `regNo` varchar(100) NOT NULL,
  `hostelId` int(11) NOT NULL,
  `roomAllotedId` int(10) NOT NULL,
  `feespm` int(11) NOT NULL,
  `foodstatus` varchar(10) NOT NULL,
  `stayfrom` varchar(50) NOT NULL,
  `duration` varchar(10) NOT NULL,
  `dateRegistered` varchar(50) NOT NULL,
  `isApproved` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `regNo`, `hostelId`, `roomAllotedId`, `feespm`, `foodstatus`, `stayfrom`, `duration`, `dateRegistered`, `isApproved`) VALUES
(11, '10806121', 8, 4, 21000, '1', '2021-08-17', '3', '16-08-2021', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `State` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `State`) VALUES
(1, 'Andaman and Nicobar Island (UT)'),
(2, 'Andhra Pradesh'),
(3, 'Arunachal Pradesh'),
(4, 'Assam'),
(5, 'Bihar'),
(6, 'Chandigarh (UT)'),
(7, 'Chhattisgarh'),
(8, 'Dadra and Nagar Haveli (UT)'),
(9, 'Daman and Diu (UT)'),
(10, 'Delhi (NCT)'),
(11, 'Goa'),
(12, 'Gujarat'),
(13, 'Haryana'),
(14, 'Himachal Pradesh'),
(15, 'Jammu and Kashmir'),
(16, 'Jharkhand'),
(17, 'Karnataka'),
(18, 'Kerala'),
(19, 'Lakshadweep (UT)'),
(20, 'Madhya Pradesh'),
(21, 'Maharashtra'),
(22, 'Manipur'),
(23, 'Meghalaya'),
(24, 'Mizoram'),
(25, 'Nagaland'),
(26, 'Odisha'),
(27, 'Puducherry (UT)'),
(28, 'Punjab'),
(29, 'Rajastha'),
(30, 'Sikkim'),
(31, 'Tamil Nadu'),
(32, 'Telangana'),
(33, 'Tripura'),
(34, 'Uttarakhand'),
(35, 'Uttar Pradesh'),
(36, 'West Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userIp` varbinary(16) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userId`, `userEmail`, `userIp`, `city`, `country`, `loginTime`) VALUES
(6, 3, '10806121', 0x3a3a31, '', '', '2020-07-20 14:56:45'),
(7, 3, 'test@gmail.com', 0x3a3a31, '', '', '2020-07-31 10:10:15'),
(8, 3, 'test@gmail.com', 0x3a3a31, '', '', '2020-07-31 10:11:40'),
(9, 3, 'test@gmail.com', 0x3a3a31, '', '', '2020-07-31 10:12:03'),
(10, 3, 'test@gmail.com', 0x3132372e302e302e31, '', '', '2021-08-14 18:48:00'),
(11, 3, 'test@gmail.com', 0x3132372e302e302e31, '', '', '2021-08-15 00:31:28'),
(12, 3, 'test@gmail.com', 0x3132372e302e302e31, '', '', '2021-08-15 12:52:05'),
(13, 3, 'test@gmail.com', 0x3132372e302e302e31, '', '', '2021-08-15 14:16:05'),
(14, 3, 'test@gmail.com', 0x3132372e302e302e31, '', '', '2021-08-15 14:59:46'),
(15, 3, 'test@gmail.com', 0x3132372e302e302e31, '', '', '2021-08-15 17:22:09'),
(16, 5, 'AHNJD89302', 0x3132372e302e302e31, '', '', '2021-08-15 17:32:39'),
(17, 3, '10806121', 0x3132372e302e302e31, '', '', '2021-08-15 17:33:03'),
(18, 3, 'test@gmail.com', 0x3132372e302e302e31, '', '', '2021-08-15 17:34:56'),
(19, 3, '10806121', 0x3132372e302e302e31, '', '', '2021-08-15 17:37:14'),
(20, 3, 'test@gmail.com', 0x3132372e302e302e31, '', '', '2021-08-15 17:56:50'),
(21, 3, '10806121', 0x3132372e302e302e31, '', '', '2021-08-16 20:59:11'),
(22, 3, 'test@gmail.com', 0x3132372e302e302e31, '', '', '2021-08-16 22:17:42'),
(23, 3, '10806121', 0x3132372e302e302e31, '', '', '2021-08-24 22:39:59'),
(24, 3, 'test@gmail.com', 0x3132372e302e302e31, '', '', '2021-09-03 15:35:21'),
(25, 3, '10806121', 0x3132372e302e302e31, '', '', '2021-09-18 12:42:02');

-- --------------------------------------------------------

--
-- Table structure for table `userregistration`
--

CREATE TABLE `userregistration` (
  `id` int(11) NOT NULL,
  `regNo` varchar(255) DEFAULT NULL,
  `class` varchar(50) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `contactNo` bigint(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(45) DEFAULT NULL,
  `passUdateDate` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userregistration`
--

INSERT INTO `userregistration` (`id`, `regNo`, `class`, `firstName`, `middleName`, `lastName`, `gender`, `contactNo`, `email`, `password`, `regDate`, `updationDate`, `passUdateDate`) VALUES
(3, '10806121', 'Primary One', 'Anuj', 'dasasdas', 'kumar', 'male', 1234567890, 'test@gmail.com', '11111', '2020-07-20 14:56:18', '15-08-2021 11:07:30', '17-08-2021 03:48:49'),
(5, 'AHNJD89302', 'Primary Two', 'Ahmad', 'Kunle', 'Ademola', 'male', 87568567089, 'schtest@gmail.com', '12345', '2021-08-15 17:30:38', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedingfee`
--
ALTER TABLE `feedingfee`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `hostelrooms`
--
ALTER TABLE `hostelrooms`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `hostels`
--
ALTER TABLE `hostels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userregistration`
--
ALTER TABLE `userregistration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedingfee`
--
ALTER TABLE `feedingfee`
  MODIFY `Id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hostelrooms`
--
ALTER TABLE `hostelrooms`
  MODIFY `Id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hostels`
--
ALTER TABLE `hostels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `userregistration`
--
ALTER TABLE `userregistration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
