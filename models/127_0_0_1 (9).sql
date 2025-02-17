-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2025 at 04:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bms`
--
CREATE DATABASE IF NOT EXISTS `bms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bms`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `time_Created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`id`, `username`, `password`, `time_Created`) VALUES
(1, 'admin', 'admin', '2025-01-04 12:13:33');

-- --------------------------------------------------------

--
-- Table structure for table `announcement_tbl`
--

CREATE TABLE `announcement_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `image` longblob NOT NULL,
  `time_Created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement_tbl`
--

INSERT INTO `announcement_tbl` (`id`, `title`, `content`, `image`, `time_Created`) VALUES
(5, 'test2', 'test2', '', '2025-01-14 11:12:07'),
(6, 'test3', 'test3', '', '2025-01-14 15:17:48'),
(7, 'test', 'test', '', '2025-01-23 09:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `approved_tbl`
--

CREATE TABLE `approved_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `resident_id` int(11) NOT NULL,
  `time_Created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approved_tbl`
--

INSERT INTO `approved_tbl` (`id`, `name`, `resident_id`, `time_Created`) VALUES
(31, 'John Joshua  Lozada ', 90, '2025-01-23 10:27:16'),
(32, 'John Joshua  Lozada ', 91, '2025-01-23 10:30:51'),
(33, 'John Joshua  Lozada ', 92, '2025-01-23 10:31:19'),
(34, 'John Joshua  Lozada ', 93, '2025-01-23 10:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `blotter_tbl`
--

CREATE TABLE `blotter_tbl` (
  `id` int(11) NOT NULL,
  `incident` varchar(255) NOT NULL,
  `place_of_incident` varchar(255) NOT NULL,
  `narrator_complaint` varchar(255) NOT NULL,
  `first_witness` varchar(255) NOT NULL,
  `second_witness` varchar(255) NOT NULL,
  `narrative` varchar(255) NOT NULL,
  `time_Created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments_tbl`
--

CREATE TABLE `comments_tbl` (
  `id` int(11) NOT NULL,
  `announcement_id` int(11) NOT NULL,
  `resident_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `time_Created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `concerns_replies_tbl`
--

CREATE TABLE `concerns_replies_tbl` (
  `id` int(11) NOT NULL,
  `concern_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `time_Created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `concerns_tbl`
--

CREATE TABLE `concerns_tbl` (
  `id` int(11) NOT NULL,
  `resident_id` int(11) NOT NULL,
  `concern_title` varchar(255) NOT NULL,
  `concern_message` varchar(255) NOT NULL,
  `time_Created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `concerns_tbl`
--

INSERT INTO `concerns_tbl` (`id`, `resident_id`, `concern_title`, `concern_message`, `time_Created`) VALUES
(1, 46, 'test', 'test', '2025-01-14 11:33:46'),
(2, 47, 'user 2 concern', 'test concern', '2025-01-16 10:50:37'),
(3, 47, 'user 3 concern', 'test', '2025-01-16 11:24:03'),
(4, 46, 'test request ', 'test', '2025-01-16 11:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `document_requested`
--

CREATE TABLE `document_requested` (
  `id` int(11) NOT NULL,
  `resident_id` int(11) NOT NULL,
  `document` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `time_Created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `officials_db`
--

CREATE TABLE `officials_db` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `time_Created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officials_db`
--

INSERT INTO `officials_db` (`id`, `name`, `role`, `time_Created`) VALUES
(1, 'Caridad J. Sanchez', 'Punong Barangay', '2025-01-13 15:51:43'),
(2, 'Nieves M, Dela Cruz', 'Kagawad', '2025-01-13 15:30:03'),
(3, 'test', 'test', '2025-01-13 15:51:27'),
(4, 'Cesar R. Concepcion', 'Kagawad', '2025-01-13 15:30:03'),
(5, 'Lolita E. Marquez', 'Kagawad', '2025-01-13 15:30:03'),
(6, 'Angeline Rose D. Sanchez', 'Kagawad', '2025-01-13 15:30:03'),
(7, 'Leo J. Ignacio', 'Kagawad', '2025-01-13 15:30:03'),
(8, 'Ervin G. Ignacio', 'Kagawad', '2025-01-13 15:30:03'),
(9, 'Juanise Raniel I. Ignacio', 'SK Kagawad', '2025-01-13 15:30:03'),
(10, 'John Paul T. Grande', 'Secretary', '2025-01-13 15:30:03'),
(11, 'Arthur B. Castor', 'Treasurer', '2025-01-13 15:30:03'),
(12, 'Robert F. Cuevas', 'Admin', '2025-01-13 15:30:03'),
(13, 'Ramon G. Colmenar', 'EX-0', '2025-01-13 15:30:03');

-- --------------------------------------------------------

--
-- Table structure for table `residents_information`
--

CREATE TABLE `residents_information` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `suffix` varchar(5) DEFAULT NULL,
  `sex` varchar(10) NOT NULL,
  `age` varchar(3) NOT NULL,
  `employment_status` varchar(10) NOT NULL,
  `birthday` date NOT NULL,
  `civil_status` varchar(10) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `house_number` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `house_owner` varchar(10) DEFAULT NULL,
  `id_front` longblob NOT NULL,
  `id_back` longblob NOT NULL,
  `time_Created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement_tbl`
--
ALTER TABLE `announcement_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approved_tbl`
--
ALTER TABLE `approved_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_approved_id` (`resident_id`);

--
-- Indexes for table `blotter_tbl`
--
ALTER TABLE `blotter_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments_tbl`
--
ALTER TABLE `comments_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_announcement_id` (`announcement_id`),
  ADD KEY `fk_comment_id` (`resident_id`);

--
-- Indexes for table `concerns_replies_tbl`
--
ALTER TABLE `concerns_replies_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_concerns_id` (`concern_id`);

--
-- Indexes for table `concerns_tbl`
--
ALTER TABLE `concerns_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_resident_id` (`resident_id`);

--
-- Indexes for table `document_requested`
--
ALTER TABLE `document_requested`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_document_id` (`resident_id`);

--
-- Indexes for table `officials_db`
--
ALTER TABLE `officials_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `residents_information`
--
ALTER TABLE `residents_information`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `announcement_tbl`
--
ALTER TABLE `announcement_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `approved_tbl`
--
ALTER TABLE `approved_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `blotter_tbl`
--
ALTER TABLE `blotter_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments_tbl`
--
ALTER TABLE `comments_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `concerns_replies_tbl`
--
ALTER TABLE `concerns_replies_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `concerns_tbl`
--
ALTER TABLE `concerns_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `document_requested`
--
ALTER TABLE `document_requested`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `officials_db`
--
ALTER TABLE `officials_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `residents_information`
--
ALTER TABLE `residents_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approved_tbl`
--
ALTER TABLE `approved_tbl`
  ADD CONSTRAINT `fk_approved_id` FOREIGN KEY (`resident_id`) REFERENCES `residents_tbl` (`id`);

--
-- Constraints for table `concerns_replies_tbl`
--
ALTER TABLE `concerns_replies_tbl`
  ADD CONSTRAINT `fk_concerns_id` FOREIGN KEY (`concern_id`) REFERENCES `concerns_tbl` (`id`);

--
-- Constraints for table `concerns_tbl`
--
ALTER TABLE `concerns_tbl`
  ADD CONSTRAINT `fk_resident_id` FOREIGN KEY (`resident_id`) REFERENCES `residents_tbl` (`id`);

--
-- Constraints for table `document_requested`
--
ALTER TABLE `document_requested`
  ADD CONSTRAINT `fk_document_id` FOREIGN KEY (`resident_id`) REFERENCES `residents_tbl` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
