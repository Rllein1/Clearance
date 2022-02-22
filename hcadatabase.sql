-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2022 at 05:30 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hcadatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `advisers`
--

CREATE TABLE `advisers` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advisers`
--

INSERT INTO `advisers` (`id`, `user_id`, `fname`, `lname`, `created_at`, `updated_at`) VALUES
(2, 8, 'neko', 'cat', '2022-01-09 07:22:12.000000', '2022-01-09 07:22:12.000000');

-- --------------------------------------------------------

--
-- Table structure for table `assignatories`
--

CREATE TABLE `assignatories` (
  `id` int(255) NOT NULL,
  `clearance_id` int(255) NOT NULL,
  `signatory_id` int(255) NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignatories`
--

INSERT INTO `assignatories` (`id`, `clearance_id`, `signatory_id`, `created_at`, `updated_at`) VALUES
(16, 15, 5, '2022-01-19 01:51:31.000000', '2022-01-19 01:51:31.000000'),
(17, 15, 4, '2022-01-19 01:51:31.000000', '2022-01-19 01:51:31.000000'),
(18, 15, 3, '2022-01-19 01:51:31.000000', '2022-01-19 01:51:31.000000'),
(19, 15, 6, '2022-01-19 01:51:31.000000', '2022-01-19 01:51:31.000000'),
(20, 16, 5, '2022-01-19 02:15:24.000000', '2022-01-19 02:15:24.000000'),
(21, 16, 3, '2022-01-19 02:15:25.000000', '2022-01-19 02:15:25.000000');

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` int(255) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `grade_level` int(255) NOT NULL,
  `adviser_id` int(255) NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `class_name`, `grade_level`, `adviser_id`, `created_at`, `updated_at`) VALUES
(2, 'manga', 7, 2, '2022-01-09 07:33:56.000000', '2022-01-09 07:33:56.000000');

-- --------------------------------------------------------

--
-- Table structure for table `clearances`
--

CREATE TABLE `clearances` (
  `id` int(255) NOT NULL,
  `schoolyear_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `grade_level` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clearances`
--

INSERT INTO `clearances` (`id`, `schoolyear_id`, `name`, `grade_level`, `status`, `created_at`, `updated_at`) VALUES
(15, 5, 'JHSclearance-(2019-2020)', 'jhs', 0, '2022-01-19 01:51:31.000000', '2022-01-19 02:26:09.000000'),
(16, 4, 'JHSclearance-(2021-2022)', 'jhs', 1, '2022-01-19 02:15:24.000000', '2022-01-19 02:26:09.000000');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(255) NOT NULL,
  `sender_id` int(255) NOT NULL,
  `receiver_id` int(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 'rawr admin to neko', '2022-01-12 01:51:48.000000', '2022-01-12 01:51:48.000000'),
(2, 8, 1, 'rara nek to admin', '2022-01-12 01:52:51.000000', '2022-01-12 01:52:51.000000'),
(3, 8, 1, 'rawr', '2022-01-12 04:33:54.000000', '2022-01-12 04:33:54.000000'),
(4, 8, 1, 'rarara', '2022-01-12 04:36:30.000000', '2022-01-12 04:36:30.000000'),
(5, 8, 1, 'rar', '2022-01-12 04:37:46.000000', '2022-01-12 04:37:46.000000'),
(6, 8, 9, '1', '2022-01-12 04:42:00.000000', '2022-01-12 04:42:00.000000'),
(7, 8, 9, '1', '2022-01-12 04:48:22.000000', '2022-01-12 04:48:22.000000'),
(8, 8, 1, '1', '2022-01-12 04:52:15.000000', '2022-01-12 04:52:15.000000'),
(9, 8, 1, '1', '2022-01-12 04:52:24.000000', '2022-01-12 04:52:24.000000'),
(10, 8, 1, '1', '2022-01-12 04:53:35.000000', '2022-01-12 04:53:35.000000'),
(11, 8, 1, '2', '2022-01-12 04:53:46.000000', '2022-01-12 04:53:46.000000'),
(12, 8, 9, '2', '2022-01-12 04:55:31.000000', '2022-01-12 04:55:31.000000'),
(13, 8, 9, '1', '2022-01-12 04:55:53.000000', '2022-01-12 04:55:53.000000'),
(14, 8, 9, '1', '2022-01-12 04:58:04.000000', '2022-01-12 04:58:04.000000'),
(15, 8, 12, '1', '2022-01-12 04:58:22.000000', '2022-01-12 04:58:22.000000'),
(16, 8, 12, '1', '2022-01-12 05:00:26.000000', '2022-01-12 05:00:26.000000'),
(17, 8, 12, '1', '2022-01-12 05:00:27.000000', '2022-01-12 05:00:27.000000'),
(18, 8, 12, '1', '2022-01-12 05:03:01.000000', '2022-01-12 05:03:01.000000'),
(19, 8, 1, 'msg', '2022-01-12 05:06:11.000000', '2022-01-12 05:06:11.000000'),
(20, 8, 1, 'msg', '2022-01-12 05:06:14.000000', '2022-01-12 05:06:14.000000'),
(21, 8, 12, '3', '2022-01-12 05:06:51.000000', '2022-01-12 05:06:51.000000'),
(22, 8, 1, '5', '2022-01-12 05:07:11.000000', '2022-01-12 05:07:11.000000'),
(23, 8, 12, '5', '2022-01-12 05:07:46.000000', '2022-01-12 05:07:46.000000'),
(24, 8, 12, '5', '2022-01-12 05:07:58.000000', '2022-01-12 05:07:58.000000'),
(25, 8, 12, 'sdada', '2022-01-12 05:12:42.000000', '2022-01-12 05:12:42.000000'),
(26, 8, 12, 'sdada', '2022-01-12 05:12:45.000000', '2022-01-12 05:12:45.000000'),
(27, 8, 12, 'sdada', '2022-01-12 05:12:45.000000', '2022-01-12 05:12:45.000000'),
(28, 8, 12, 'sdada', '2022-01-12 05:12:45.000000', '2022-01-12 05:12:45.000000'),
(29, 8, 12, 'sdada', '2022-01-12 05:12:46.000000', '2022-01-12 05:12:46.000000'),
(30, 8, 12, 'sdada', '2022-01-12 05:12:46.000000', '2022-01-12 05:12:46.000000'),
(31, 8, 12, 'sdada', '2022-01-12 05:12:46.000000', '2022-01-12 05:12:46.000000'),
(32, 8, 12, 'sdada', '2022-01-12 05:12:46.000000', '2022-01-12 05:12:46.000000'),
(33, 8, 12, 'sdada', '2022-01-12 05:12:47.000000', '2022-01-12 05:12:47.000000'),
(34, 8, 12, 'sdada', '2022-01-12 05:12:47.000000', '2022-01-12 05:12:47.000000'),
(35, 8, 12, 'sdada', '2022-01-12 05:12:47.000000', '2022-01-12 05:12:47.000000'),
(36, 8, 12, 'sdada', '2022-01-12 05:12:47.000000', '2022-01-12 05:12:47.000000'),
(37, 8, 12, 'sdada', '2022-01-12 05:12:48.000000', '2022-01-12 05:12:48.000000'),
(38, 8, 9, 'da', '2022-01-12 05:14:17.000000', '2022-01-12 05:14:17.000000'),
(39, 8, 9, 'da', '2022-01-12 05:14:18.000000', '2022-01-12 05:14:18.000000'),
(40, 8, 9, 'da', '2022-01-12 05:14:18.000000', '2022-01-12 05:14:18.000000'),
(41, 8, 9, 'da', '2022-01-12 05:14:19.000000', '2022-01-12 05:14:19.000000'),
(42, 8, 12, 'wew', '2022-01-12 05:14:48.000000', '2022-01-12 05:14:48.000000'),
(43, 8, 9, 'rawr', '2022-01-12 05:15:26.000000', '2022-01-12 05:15:26.000000'),
(44, 8, 9, 'rawr', '2022-01-12 05:15:28.000000', '2022-01-12 05:15:28.000000'),
(45, 8, 9, 'rawr', '2022-01-12 05:15:35.000000', '2022-01-12 05:15:35.000000'),
(46, 8, 12, 'rawr', '2022-01-12 05:17:26.000000', '2022-01-12 05:17:26.000000'),
(47, 8, 1, 'mia', '2022-01-12 05:17:44.000000', '2022-01-12 05:17:44.000000'),
(48, 8, 9, 'yayaya', '2022-01-12 05:18:44.000000', '2022-01-12 05:18:44.000000'),
(49, 8, 1, 'rawtas', '2022-01-12 05:22:01.000000', '2022-01-12 05:22:01.000000'),
(50, 8, 1, 'rawtas', '2022-01-12 05:22:04.000000', '2022-01-12 05:22:04.000000'),
(51, 8, 1, 'new', '2022-01-12 05:22:32.000000', '2022-01-12 05:22:32.000000'),
(52, 8, 9, 'e', '2022-01-12 05:24:27.000000', '2022-01-12 05:24:27.000000'),
(53, 8, 9, 'e', '2022-01-12 05:25:38.000000', '2022-01-12 05:25:38.000000'),
(54, 1, 9, 'rawr', '2022-01-13 01:55:08.000000', '2022-01-13 01:55:08.000000');

-- --------------------------------------------------------

--
-- Table structure for table `prerequisites`
--

CREATE TABLE `prerequisites` (
  `id` int(255) NOT NULL,
  `assignatory_id` int(255) NOT NULL,
  `signatory_id` int(255) NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prerequisites`
--

INSERT INTO `prerequisites` (`id`, `assignatory_id`, `signatory_id`, `created_at`, `updated_at`) VALUES
(1, 16, 4, '2022-01-19 01:51:39.000000', '2022-01-19 01:51:39.000000'),
(2, 16, 4, '2022-01-19 01:51:43.000000', '2022-01-19 01:51:43.000000'),
(3, 16, 3, '2022-01-19 01:51:50.000000', '2022-01-19 01:51:50.000000');

-- --------------------------------------------------------

--
-- Table structure for table `schoolyears`
--

CREATE TABLE `schoolyears` (
  `id` int(255) NOT NULL,
  `schoolyear` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schoolyears`
--

INSERT INTO `schoolyears` (`id`, `schoolyear`, `status`, `created_at`, `updated_at`) VALUES
(2, '2020-2021', 0, '2022-01-07 13:29:44.000000', '2022-01-11 01:26:28.000000'),
(4, '2021-2022', 1, '2022-01-11 01:26:28.000000', '2022-01-19 02:13:39.000000'),
(5, '2019-2020', 0, '2022-01-11 01:35:55.000000', '2022-01-19 02:13:39.000000');

-- --------------------------------------------------------

--
-- Table structure for table `signatories`
--

CREATE TABLE `signatories` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `signatory_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `signatories`
--

INSERT INTO `signatories` (`id`, `user_id`, `signatory_name`, `created_at`, `updated_at`) VALUES
(3, 9, 'library', '2022-01-09 07:29:01', '2022-01-09 07:29:01'),
(4, 13, 'comlab', '2022-01-19 01:50:28', '2022-01-19 01:50:28'),
(5, 14, 'clinic', '2022-01-19 01:50:40', '2022-01-19 01:50:40'),
(6, 15, 'osa', '2022-01-19 01:50:58', '2022-01-19 01:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `student_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `grade` int(255) NOT NULL,
  `classroom_id` int(255) NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `student_id`, `fname`, `lname`, `grade`, `classroom_id`, `created_at`, `updated_at`) VALUES
(3, 12, 8888, 'mia', 'castillo', 7, 2, '2022-01-11 01:25:46.000000', '2022-01-11 01:25:46.000000');

-- --------------------------------------------------------

--
-- Table structure for table `student_stats`
--

CREATE TABLE `student_stats` (
  `id` int(255) NOT NULL,
  `student_id` int(255) NOT NULL,
  `signatory_id` int(255) NOT NULL,
  `assignatory_id` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_stats`
--

INSERT INTO `student_stats` (`id`, `student_id`, `signatory_id`, `assignatory_id`, `status`, `created_at`, `updated_at`) VALUES
(9, 3, 5, 16, 0, '2022-01-19 01:51:31.000000', '2022-01-19 01:51:31.000000'),
(10, 3, 4, 17, 0, '2022-01-19 01:51:31.000000', '2022-01-19 01:51:31.000000'),
(11, 3, 3, 18, 0, '2022-01-19 01:51:31.000000', '2022-01-19 01:51:31.000000'),
(12, 3, 6, 19, 0, '2022-01-19 01:51:32.000000', '2022-01-19 01:51:32.000000'),
(13, 3, 5, 20, 0, '2022-01-19 02:15:24.000000', '2022-01-19 02:15:24.000000'),
(14, 3, 3, 21, 0, '2022-01-19 02:15:25.000000', '2022-01-19 02:15:25.000000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `rank`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$Q.ALj6iqYMEmd..2UI5NU.pVLSOjjzgbAwEd6hHkjECouyZSscESy', 'admin', 'admin', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(8, 'neko1', '$2y$10$sQ.Wty6dPYJUj91viLyuCuHqVgx6soGDwD7NiNJnSIyZcReJBAePC', 'staff', 'adviser', '2022-01-09 07:22:12.000000', '2022-01-09 07:22:12.000000'),
(9, 'lib1', '$2y$10$BkZ8SkAGwoK6Ev6E/59IbuQuCzvuQHcy5JmQKy4CiE63nuBKg2W6u', 'staff', 'signatory', '2022-01-09 07:29:01.000000', '2022-01-09 07:29:01.000000'),
(12, '8888', '$2y$10$r3UV137PjXo3BEQUE0k6W.lY5UFNhSbVzQuR9d1tXmIEOTQB3n7BC', 'student', 'student', '2022-01-11 01:25:46.000000', '2022-01-11 01:25:46.000000'),
(13, 'lab1', '$2y$10$7/WpcTGhrSPzFg66nL9Lj.QZW04Yw9fx9Y3U.gpaJRauywjIMe7/2', 'staff', 'signatory', '2022-01-19 01:50:28.000000', '2022-01-19 01:50:28.000000'),
(14, 'clinic1', '$2y$10$Pwc1RFivTKoOvIAsESDfJOEPOeIk.0bj6KODWM7HR2qxJb6Jfjkb6', 'staff', 'signatory', '2022-01-19 01:50:40.000000', '2022-01-19 01:50:40.000000'),
(15, 'osa1', '$2y$10$P5kFs7BBCjE3bqxA89RegOqwO0e3TfVNekcEWE/djWm56pNHQi5VC', 'staff', 'signatory', '2022-01-19 01:50:58.000000', '2022-01-19 01:50:58.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advisers`
--
ALTER TABLE `advisers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignatories`
--
ALTER TABLE `assignatories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clearances`
--
ALTER TABLE `clearances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prerequisites`
--
ALTER TABLE `prerequisites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schoolyears`
--
ALTER TABLE `schoolyears`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signatories`
--
ALTER TABLE `signatories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_stats`
--
ALTER TABLE `student_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advisers`
--
ALTER TABLE `advisers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assignatories`
--
ALTER TABLE `assignatories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clearances`
--
ALTER TABLE `clearances`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `prerequisites`
--
ALTER TABLE `prerequisites`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schoolyears`
--
ALTER TABLE `schoolyears`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `signatories`
--
ALTER TABLE `signatories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_stats`
--
ALTER TABLE `student_stats`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
