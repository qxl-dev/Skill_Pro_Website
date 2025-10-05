-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2025 at 10:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(160) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `fee` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `category`, `description`, `fee`) VALUES
(1, 'ICT Fundamentals', 'ICT', 'Intro to computers and networking', 15000.00),
(2, 'Advanced Welding', 'Welding', 'Practical welding techniques', 20000.00),
(3, 'Plumbing Basics', 'Plumbing', 'Residential plumbing training', 12000.00),
(4, 'Hotel Management', 'Hospitality', 'Front office & housekeeping', 18000.00),
(5, 'Software Development', 'ICT', 'Full-stack development', 25000.00),
(6, 'Electrical Engineering Basics', 'Engineering', 'Circuits and wiring', 22000.00);

-- --------------------------------------------------------

--
-- Table structure for table `course_offerings`
--

CREATE TABLE `course_offerings` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `mode` enum('Online','On-site') DEFAULT NULL,
  `location` varchar(120) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_offerings`
--

INSERT INTO `course_offerings` (`id`, `course_id`, `instructor_id`, `mode`, `location`, `start_date`, `end_date`) VALUES
(1, 1, 2, 'On-site', 'Colombo', '2025-10-01', '2025-12-15'),
(2, 2, 3, 'On-site', 'Kandy', '2025-10-05', '2026-01-15'),
(3, 3, 4, 'Online', 'Online', '2025-11-01', '2026-01-30'),
(4, 4, 5, 'On-site', 'Matara', '2025-10-20', '2026-01-10'),
(5, 5, 2, 'Online', 'Online', '2025-10-10', '2026-02-20'),
(6, 6, 3, 'On-site', 'Colombo', '2025-11-15', '2026-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `email` varchar(160) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'Lakshan Perera', 'lakshan@mail.com', 'Need info about Plumbing Basics', '2025-09-24 13:54:52'),
(2, 'Shanika Rodrigo', 'shanika@mail.com', 'Do you provide certificates?', '2025-09-24 13:54:52');

-- --------------------------------------------------------

--
-- Table structure for table `instructor_profiles`
--

CREATE TABLE `instructor_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expertise` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor_profiles`
--

INSERT INTO `instructor_profiles` (`id`, `user_id`, `expertise`, `bio`) VALUES
(1, 2, 'ICT', '10+ years in IT training, software systems'),
(2, 3, 'Welding', 'Certified welding instructor with industry experience'),
(3, 4, 'Plumbing', 'Licensed plumbing instructor'),
(4, 5, 'Hospitality', 'Experienced hotel management lecturer');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `publish_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `content`, `publish_at`) VALUES
(1, 'New Batch Starts', 'ICT Fundamentals new batch begins on 1st October', '2025-09-24 13:54:52'),
(2, 'Holiday Notice', 'Institute will be closed on Poya Day', '2025-09-24 13:54:52'),
(3, 'Job Fair', 'SkillPro Job Fair on 15th November at Colombo branch', '2025-09-24 13:54:52'),
(4, 'Workshop', 'Special Welding Workshop in Kandy branch on 20th October', '2025-09-24 13:54:52');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `offering_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `offering_id`, `student_id`, `registered_at`) VALUES
(1, 1, 6, '2025-09-24 13:54:52'),
(2, 1, 7, '2025-09-24 13:54:52'),
(3, 2, 8, '2025-09-24 13:54:52'),
(4, 3, 9, '2025-09-24 13:54:52'),
(5, 4, 10, '2025-09-24 13:54:52'),
(6, 5, 11, '2025-09-24 13:54:52'),
(7, 6, 12, '2025-09-24 13:54:52'),
(8, 2, 13, '2025-09-24 13:54:52'),
(9, 3, 14, '2025-09-24 13:54:52'),
(10, 4, 15, '2025-09-24 13:54:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('admin','instructor','student') NOT NULL,
  `full_name` varchar(120) NOT NULL,
  `email` varchar(160) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `full_name`, `email`, `password_hash`, `created_at`) VALUES
(1, 'admin', 'Chathura Perera', 'admin@skillpro.lk', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', '2025-09-24 13:54:52'),
(2, 'instructor', 'Sanduni Fernando', 'sanduni@skillpro.lk', '9b8769a4a742959a2d0298c36fb70623f2dfacda8436237df08d8dfd5b37374c', '2025-09-24 13:54:52'),
(3, 'instructor', 'Kusal Jayawardena', 'kusal@skillpro.lk', '9b8769a4a742959a2d0298c36fb70623f2dfacda8436237df08d8dfd5b37374c', '2025-09-24 13:54:52'),
(4, 'instructor', 'Dilani Abeysekera', 'dilani@skillpro.lk', '9b8769a4a742959a2d0298c36fb70623f2dfacda8436237df08d8dfd5b37374c', '2025-09-24 13:54:52'),
(5, 'instructor', 'Tharindu Weerasinghe', 'tharindu@skillpro.lk', '9b8769a4a742959a2d0298c36fb70623f2dfacda8436237df08d8dfd5b37374c', '2025-09-24 13:54:52'),
(6, 'student', 'Nadeesha Silva', 'nadeesha@skillpro.lk', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2025-09-24 13:54:52'),
(7, 'student', 'Ruwan Peris', 'ruwan@skillpro.lk', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2025-09-24 13:54:52'),
(8, 'student', 'Ishara Bandara', 'ishara@skillpro.lk', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2025-09-24 13:54:52'),
(9, 'student', 'Malith Senanayake', 'malith@skillpro.lk', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2025-09-24 13:54:52'),
(10, 'student', 'Gayani Ratnayake', 'gayani@skillpro.lk', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2025-09-24 13:54:52'),
(11, 'student', 'Pasan Samarasinghe', 'pasan@skillpro.lk', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2025-09-24 13:54:52'),
(12, 'student', 'Hashini Wickramasinghe', 'hashini@skillpro.lk', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2025-09-24 13:54:52'),
(13, 'student', 'Chamika Gamage', 'chamika@skillpro.lk', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2025-09-24 13:54:52'),
(14, 'student', 'Rashmi Kulatunga', 'rashmi@skillpro.lk', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2025-09-24 13:54:52'),
(15, 'student', 'Sajith Mendis', 'sajith@skillpro.lk', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2025-09-24 13:54:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_offerings`
--
ALTER TABLE `course_offerings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor_profiles`
--
ALTER TABLE `instructor_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_student_offering` (`offering_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

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
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_offerings`
--
ALTER TABLE `course_offerings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `instructor_profiles`
--
ALTER TABLE `instructor_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_offerings`
--
ALTER TABLE `course_offerings`
  ADD CONSTRAINT `course_offerings_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_offerings_ibfk_2` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `instructor_profiles`
--
ALTER TABLE `instructor_profiles`
  ADD CONSTRAINT `instructor_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`offering_id`) REFERENCES `course_offerings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `registrations_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
