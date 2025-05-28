-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2025 at 07:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trip_planner_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` int(11) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `activities` text DEFAULT NULL,
  `info` text DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `city`, `region`, `activities`, `info`, `submitted_at`) VALUES
(1, 'Makati', 'Philippines', 'hiking, mountain biking', 'transportation', '2025-05-24 03:24:35'),
(2, 'Mandaluyong', 'NCR', 'hiking, mountain biking, kayaking', 'transportation', '2025-05-24 03:25:51'),
(3, 'Mandaluyong', 'NCR', 'hiking, mountain biking, kayaking', 'transportation', '2025-05-24 03:32:58'),
(4, 'Mandaluyong', 'NCR', 'hiking, mountain biking, kayaking', 'transportation', '2025-05-24 03:33:19'),
(5, 'Mandaluyong', 'Ncr', 'Hiking, Mountain Biking, Kayaking', 'Transportation', '2025-05-24 03:39:43'),
(6, 'Makati', 'Philippines', 'Hiking, Mountain Biking, Kayaking', 'Transportation, Health', '2025-05-24 03:40:24'),
(7, 'Makati', 'Philippines', 'hiking, mountain biking, kayaking', 'transportation, health', '2025-05-24 03:41:48'),
(8, 'Makati', 'Philippines', 'hiking, mountain biking, kayaking', 'transportation', '2025-05-24 03:47:30'),
(9, 'japan', 'new york', 'hiking, mountain biking, kayaking', 'transportation, health, weather', '2025-05-24 03:48:58'),
(10, 'japan', 'new york', 'hiking, mountain biking, kayaking', 'transportation, health, weather', '2025-05-24 03:49:14'),
(11, 'japan', 'new york', 'hiking, mountain biking, kayaking', 'transportation, health, weather', '2025-05-24 03:51:41'),
(12, 'japan', 'new york', 'hiking, mountain biking, kayaking', 'transportation, health, weather', '2025-05-24 04:02:33'),
(13, 'elsa', 'anna', 'hiking, mountain biking, kayaking', 'transportation, health', '2025-05-24 04:04:49'),
(14, 'taguig city', 'philippines', 'hiking, mountain biking, kayaking, skiing, fishing, surfing', 'transportation, health', '2025-05-24 04:08:09'),
(15, '', '', '', '', '2025-05-24 04:08:22'),
(16, '', '', '', '', '2025-05-24 04:09:40'),
(17, '', '', '', '', '2025-05-24 05:00:15'),
(18, '', '', '', '', '2025-05-24 05:06:15'),
(19, '', '', '', '', '2025-05-24 05:06:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
