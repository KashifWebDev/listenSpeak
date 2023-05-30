-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2023 at 10:14 AM
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
-- Database: `abc_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `audio_responses`
--

CREATE TABLE `audio_responses` (
  `response_id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `audio_url` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `percentage` int(100) DEFAULT NULL,
  `teacher_audio` varchar(1000) DEFAULT NULL,
  `date_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audio_responses`
--

INSERT INTO `audio_responses` (`response_id`, `unit_id`, `student_id`, `teacher_id`, `audio_url`, `status`, `percentage`, `teacher_audio`, `date_time`) VALUES
(1, 8, 2, 4, 'audio_url_1', 'Approved', NULL, NULL, '2023-05-22 07:06:40'),
(2, 12, 2, 4, 'audio_url_2', 'Pending', NULL, NULL, '2023-05-22 07:06:40'),
(3, 16, 3, 5, 'audio_url_3', 'Rejected', NULL, NULL, '2023-05-22 07:06:40'),
(4, 17, 3, 5, 'audio_url_4', 'Pending', NULL, NULL, '2023-05-22 07:06:40'),
(5, 1, 2, NULL, '', 'Pending', NULL, NULL, '2023-05-22 04:10:38'),
(6, 17, 2, NULL, '', 'Pending', NULL, NULL, '2023-05-22 04:14:32'),
(7, 17, 2, NULL, '', 'Pending', NULL, NULL, '2023-05-22 04:14:47'),
(8, 17, 2, NULL, '', 'Pending', NULL, NULL, '2023-05-22 04:17:08'),
(16, 17, 2, NULL, 'fd6a627d02a36f65d7cbf07bf3db8c0f.mp3', 'Pending', NULL, NULL, '2023-05-22 04:52:05'),
(17, 18, 2, NULL, '90b78b35965b7b7348394112eb4324e7.mp3', 'Pending', NULL, NULL, '2023-05-22 04:52:19'),
(18, 16, 2, NULL, 'a1bd5a60a87cce40ac1555cb74d8a219.mp3', 'Pending', NULL, NULL, '2023-05-22 04:52:37'),
(19, 15, 2, NULL, '64099d475e61082f9bfd7d425d1fada7.mp3', 'Pending', NULL, NULL, '2023-05-22 06:26:47'),
(20, 21, 2, 5, 'e97325c513d97e169ddf61f61a481c31.mp3', 'Pending', NULL, NULL, '2023-05-28 07:07:57'),
(21, 20, 2, 5, '0c9e613b1b7faf3ba58bb4d995d291c6.mp3', 'Approved', 44, '9bede884a9b5733ca6a08f8ca249b83b.mp3', '2023-05-30 04:55:30');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `thumbnail`, `description`) VALUES
(1, 'Course 1', 'default.jpg', 'dsafasdf'),
(2, 'Course 2', 'default.jpg', ''),
(3, 'Course 3', 'default.jpg', ''),
(4, 'Course 4', 'default.jpg', ''),
(5, 'Course 5', 'default.jpg', ''),
(6, 'Course 6', 'default.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_units`
--

CREATE TABLE `student_units` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_units`
--

INSERT INTO `student_units` (`id`, `student_id`, `unit_id`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 3, 1),
(4, 3, 2),
(5, 2, 17),
(6, 2, 18),
(7, 2, 16),
(8, 2, 15),
(9, 2, 21),
(10, 2, 20);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`, `course_id`) VALUES
(1, 'Subject 1', 1),
(2, 'Subject 2', 2),
(3, 'Subject 3', 3),
(4, 'Eng', 4),
(5, 'Math', 4),
(7, 'Test', 5),
(8, 'Learn Future Tenses', 6);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_courses`
--

CREATE TABLE `teacher_courses` (
  `teacher_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_courses`
--

INSERT INTO `teacher_courses` (`teacher_id`, `course_id`) VALUES
(4, 1),
(4, 2),
(5, 3),
(5, 4),
(5, 6),
(4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  `type` varchar(100) NOT NULL DEFAULT 'Lesson',
  `link` varchar(100) DEFAULT NULL,
  `status` enum('Pass','Fail','Pending') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`, `subject_id`, `content`, `file`, `type`, `link`, `status`) VALUES
(1, 'Unit 1', 1, '11 22', NULL, 'Unit', '', NULL),
(2, 'Unit 2', 1, '', NULL, 'Unit', '', NULL),
(5, 'Unit 1', 3, '', NULL, 'Unit', '', NULL),
(6, 'Unit 2', 3, '', NULL, 'Unit', '', NULL),
(7, 'Eng 1', 4, '', NULL, 'Unit', '', NULL),
(8, 'Eng 2', 4, '', NULL, 'Assessment\n', '', 'Pending'),
(9, 'Math 1', 5, '', NULL, 'Unit', '', NULL),
(10, 'math3', 5, '', NULL, 'Unit', '', NULL),
(11, 'Unit 1', 6, '', NULL, 'Unit', '', NULL),
(12, 'Unit 2', 6, '', NULL, 'Assessment\n', '', 'Fail'),
(15, 'testttt', 2, 'test222  222 2 2 ', '83397757ad2560816c77bb8f149b4a19.jpg', 'Unit', '', NULL),
(16, 'sadfsadfafd', 2, 'asdfasd', '', 'Assessment\n', '', 'Pending'),
(17, 'first unit2', 1, 'uni t1 content2', '', 'Unit', '', 'Pass'),
(18, 'Assesment #5', 1, '', '', 'Assessment', 'vimeo.com/myvideo5', NULL),
(19, 'Future Tense 1', 8, 'Hello', '', 'Unit', '', NULL),
(20, 'Past Tenses', 7, 'Practice past tense', 'b6951be6c9d051fec5cd99195f0e0932.png', 'Unit', '', NULL),
(21, 'TEST', 8, 'TEST', '16bf9b3117996b04adbf0fa23c6720a1.png', 'Assessment', 'vimeo.com/myvideo3333', NULL),
(22, 'TEST2', 8, 'TEST2', 'aa2bf58e00b7d994f71b912e1df3dcdb.png', 'Assessment', '', NULL),
(23, 'TEST3', 8, 'TEST3', '40233a624c3ac12ddd2612d4bb3b74be.svg', 'Unit', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `pic` varchar(100) NOT NULL DEFAULT 'default.jpg',
  `email` varchar(100) NOT NULL,
  `user_type` enum('Admin','Student','Teacher') NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `pic`, `email`, `user_type`, `fullName`, `pass`, `address`, `phone`, `country`) VALUES
(1, 'default.jpg', 'admin@admin.com', 'Admin', 'admin', 'admin@admin.com', NULL, NULL, NULL),
(2, 'default.jpg', 'user@user.com', 'Student', 'student1', 'user@user.com', NULL, NULL, NULL),
(3, 'default.jpg', 'user1@user.com', 'Student', 'student2', 'student2_password', NULL, NULL, NULL),
(4, 'default.jpg', 'user2@user.com', 'Teacher', 'teacher1', 'teacher1_password', NULL, NULL, NULL),
(5, 'default.jpg', 'user3@user.com', 'Teacher', 'teacher2', 'user3@user.com', NULL, NULL, NULL),
(6, 'default.jpg', 'test@test.com', 'Student', 'test', 'test@test.com', 'test@test.com', 'test@test.com', 'test@test.com'),
(7, 'default.jpg', 'test@test.c23om', 'Student', 'test@test.com', 'test@test.com', 'test@test.com', 'test@test.com', 'test@test.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audio_responses`
--
ALTER TABLE `audio_responses`
  ADD PRIMARY KEY (`response_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `student_units`
--
ALTER TABLE `student_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audio_responses`
--
ALTER TABLE `audio_responses`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_units`
--
ALTER TABLE `student_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
