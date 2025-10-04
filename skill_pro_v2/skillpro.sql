-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2025 at 10:59 PM
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
-- Database: `skillpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` enum('ICT','Plumbing','Welding','Hotel Management','Other') NOT NULL,
  `description` text DEFAULT NULL,
  `mode` enum('online','onsite','hybrid') NOT NULL,
  `location` varchar(120) DEFAULT NULL,
  `duration_weeks` int(11) DEFAULT 0,
  `fee` decimal(10,2) DEFAULT 0.00,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `status` enum('draft','published','archived') NOT NULL DEFAULT 'published'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `category`, `description`, `mode`, `location`, `duration_weeks`, `fee`, `start_date`, `end_date`, `instructor_id`, `status`) VALUES
(1, 'ICT Fundamentals', 'ICT', 'Intro to computers and networking', 'online', NULL, 0, 15000.00, NULL, NULL, NULL, 'published'),
(2, 'Advanced Welding', 'Welding', 'Practical welding techniques', 'online', NULL, 0, 20000.00, NULL, NULL, NULL, 'published'),
(3, 'Plumbing Basics', 'Plumbing', 'Residential plumbing training', 'online', NULL, 0, 12000.00, NULL, NULL, NULL, 'published'),
(4, 'Hotel Management', '', 'Front office & housekeeping', 'online', NULL, 0, 18000.00, NULL, NULL, NULL, 'published'),
(5, 'Software Development', 'ICT', 'Full-stack development', 'online', NULL, 0, 25000.00, NULL, NULL, NULL, 'published'),
(6, 'Electrical Engineering Basics', '', 'Circuits and wiring', 'online', NULL, 0, 22000.00, NULL, NULL, NULL, 'published');

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
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `type` enum('course_start','exam','workshop','holiday','job_fair','seminar','other') NOT NULL DEFAULT 'other',
  `date` date NOT NULL,
  `location` varchar(200) DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `type`, `date`, `location`, `details`) VALUES
(1, 'ICT Fundamentals - Orientation', 'course_start', '2025-10-01', 'Colombo', 'Welcome session for ICT batch'),
(2, 'Welding Exam', 'exam', '2025-12-20', 'Kandy', 'Final assessment for welding students'),
(3, 'Hospitality Job Fair', 'job_fair', '2025-11-15', 'Colombo', 'Meet employers from the hotel industry');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `email` varchar(160) DEFAULT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `status` enum('open','closed') NOT NULL DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `visible_to` enum('students','instructors','all') NOT NULL DEFAULT 'students',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `visible_to` enum('all','students','instructors') NOT NULL DEFAULT 'all',
  `publish_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `body`, `visible_to`, `publish_at`) VALUES
(1, 'New Batch - ICT Fundamentals', 'Enrollments now open for October intake!', 'all', '2025-09-21 17:38:54'),
(2, 'Holiday Notice', 'Institute will be closed for Poya Day.', 'students', '2025-09-21 17:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `mode` enum('online','onsite') NOT NULL,
  `status` enum('pending','approved','rejected','waitlisted') NOT NULL DEFAULT 'pending',
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `room_or_link` varchar(255) DEFAULT NULL,
  `type` enum('class','exam','workshop') NOT NULL DEFAULT 'class'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('admin','instructor','student') NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(160) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `phone` varchar(40) DEFAULT NULL,
  `location` varchar(120) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `password_hash`, `phone`, `location`, `approved`, `created_at`) VALUES
(1, 'admin', 'Site Admin', 'admin@skillpro.lk', 'changeme123', NULL, 'Colombo', 1, '2025-09-21 12:08:54'),
(2, 'instructor', 'Kusal Perera', 'kusal@skillpro.lk', 'changeme123', NULL, 'Kandy', 1, '2025-09-21 12:08:54'),
(3, 'instructor', 'Nadeesha Silva', 'nadeesha@skillpro.lk', 'changeme123', NULL, 'Matara', 1, '2025-09-21 12:08:54'),
(4, 'student', 'Chamari Jayasinghe', 'chamari@student.lk', 'changeme123', NULL, 'Galle', 1, '2025-09-21 12:08:54'),
(5, 'student', 'Dilshan Fernando', 'dilshan@student.lk', 'changeme123', NULL, 'Kurunegala', 1, '2025-09-21 12:08:54'),
(6, 'student', 'Ishara De Silva', 'ishara@student.lk', 'changeme123', NULL, 'Colombo', 1, '2025-09-21 12:08:54'),
(11, 'instructor', 'Sanduni Fernando', 'sanduni@skillpro.lk', '9b8769a4a742959a2d0298c36fb70623f2dfacda8436237df08d8dfd5b37374c', NULL, NULL, 1, '2025-09-27 20:58:46'),
(12, 'instructor', 'Dilani Abeysekera', 'dilani@skillpro.lk', '9b8769a4a742959a2d0298c36fb70623f2dfacda8436237df08d8dfd5b37374c', NULL, NULL, 1, '2025-09-27 20:58:46'),
(13, 'instructor', 'Tharindu Weerasinghe', 'tharindu@skillpro.lk', '9b8769a4a742959a2d0298c36fb70623f2dfacda8436237df08d8dfd5b37374c', NULL, NULL, 1, '2025-09-27 20:58:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `course_offerings`
--
ALTER TABLE `course_offerings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

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
  ADD UNIQUE KEY `uniq_student_course` (`student_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

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
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `course_offerings`
--
ALTER TABLE `course_offerings`
  ADD CONSTRAINT `course_offerings_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_offerings_ibfk_2` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD CONSTRAINT `inquiries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `registrations_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
