-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2022 at 04:39 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_listenspeak`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `released` tinyint(1) NOT NULL DEFAULT 0,
  `released_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `name`, `link`, `description`, `released`, `released_at`) VALUES
(2, 'asdf234', 'asdf234', 'asdf234', 0, NULL),
(3, 'Second Activity Title', '2nd', 'asdf', 0, NULL),
(4, 'Third Activity Title', '3rd', 'asdf\r\n', 1, NULL),
(5, 'New Activity Title', '', '', 1, NULL),
(6, 'Forth Activity Title', 'forth', 'sdlkf\r\n', 1, NULL),
(7, 'Fifth Activity Title', '', '', 1, NULL),
(8, 'Sixth Activity Title', '', '', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `activityPerWeek` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`activityPerWeek`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `percentage` int(100) NOT NULL,
  `message` varchar(100) NOT NULL,
  `structure` varchar(100) NOT NULL,
  `logic` varchar(100) NOT NULL,
  `fluency` varchar(100) NOT NULL,
  `expression` varchar(100) NOT NULL,
  `projection` varchar(100) NOT NULL,
  `posture` varchar(100) NOT NULL,
  `eyeContact` varchar(100) NOT NULL,
  `pause` varchar(100) NOT NULL,
  `connection` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `user_id`, `activity_id`, `percentage`, `message`, `structure`, `logic`, `fluency`, `expression`, `projection`, `posture`, `eyeContact`, `pause`, `connection`) VALUES
(2, 6, 4, 60, 'Excellent', 'Proficient', 'Needs Attention', 'Excellent', 'Proficient', 'Needs Attention', 'Excellent', 'Proficient', 'Needs Attention', 'Excellent'),
(3, 6, 4, 70, 'Excellent', 'Proficient', 'Needs Attention', 'Excellent', 'Proficient', 'Needs Attention', 'Excellent', 'Proficient', 'Needs Attention', 'Excellent'),
(4, 1, 8, 23, 'Proficient', 'Proficient', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Proficient', 'Proficient', 'Excellent', 'Needs Attention');

-- --------------------------------------------------------

--
-- Table structure for table `solutions`
--

CREATE TABLE `solutions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `audio` varchar(200) NOT NULL,
  `graded` tinyint(1) NOT NULL DEFAULT 0,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `solutions`
--

INSERT INTO `solutions` (`id`, `user_id`, `activity_id`, `audio`, `graded`, `date_time`) VALUES
(1, 6, 4, 'audioFile.wav', 1, '2022-08-17 09:09:15'),
(2, 6, 5, 'audioFile.wav', 0, '2022-08-17 09:09:15'),
(3, 1, 8, '1660811315.mp3', 1, '2022-08-18 05:28:38'),
(112, 1, 4, '1660811439.mp3', 0, '2022-08-18 05:30:41'),
(113, 1, 3, '1662906922.mp3', 0, '2022-09-11 11:35:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `userType` enum('Admin','Teacher','Student') NOT NULL DEFAULT 'Student',
  `level` varchar(30) DEFAULT NULL,
  `pic` varchar(100) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `country`, `address`, `phone`, `email`, `pass`, `userType`, `level`, `pic`) VALUES
(1, 'First Student', 'Pakistan', 'Main Street, Colony, Pakistan', '1111111', 'user@user.com', 'user@user.com', 'Student', 'Foundation-1', 'default.jpg'),
(2, 'Admin Account', 'South Africa', 'Near ABC School', '234234234', 'admin@admin.com', 'admin@admin.com', 'Admin', 'Foundation-1', 'default.jpg'),
(4, 'Teacher', 'Random', 'Random', '23232343423', 'teacher@abc.com', 'teacher@abc.com', 'Teacher', 'Foundation-1', 'default.jpg'),
(5, '1', '1', '1', '1', '1@1.com', '1', 'Student', 'Foundation-1', 'default.jpg'),
(6, 'TEsing Pic', 'Africa', 'asfdlj', '234234', 'testing@pic.com', 'testing@pic.com', 'Student', 'Foundation-1', 'default.jpg'),
(7, 'Kasfhi', 'Kasfhi@ds.sf', 'Kasfhi@ds.sfKasfhi@ds.sf', 'Kasfhi@ds.sf', 'Kasfhi@ds.sf', 'Kasfhi@ds.sf', 'Student', 'Foundation-1', 'default.jpg'),
(8, 'safd', 'Kasfhi@ds.sf', 'Kasfhi@ds.sf', 'Kasfhi@ds.sf', 'Kasfhi@ds.sf23', 'Kasfhi@ds.sf', 'Student', 'Foundation-1', '9d414a796b49c2f733c2d2ffe764d98f.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solutions`
--
ALTER TABLE `solutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `solutions`
--
ALTER TABLE `solutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
