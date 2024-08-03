-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2024 at 08:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_planner`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `event_date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `event_date`, `location`, `created_at`, `updated_at`) VALUES
(1, 'Wedding Reception', 'dwdwfewfewfef', '2024-08-07', 'Rajkot', '2024-07-31 07:19:10', '2024-08-02 10:58:04'),
(4, 'Birthday', 'fsfdgrgrg', '2024-08-05', 'Rajkot', '2024-07-31 07:47:38', '2024-08-02 09:51:23'),
(11, 'Quiz', 'dewfegerfwfrwf\r\n', '2024-08-06', 'Rajkot', '2024-07-31 10:58:58', '2024-08-03 05:28:46'),
(13, 'Anniversaryy', 'dwesfef', '2024-08-09', 'Rajkot', '2024-07-31 10:59:40', '2024-08-02 07:15:29'),
(14, 'dewfe', 'ewfe', '2024-08-11', 'Rajkot', '2024-07-31 11:00:04', '2024-08-02 09:37:09'),
(33, 'dewdew', 'ewfe', '2024-08-09', 'Rajkot', '2024-08-01 04:29:40', '2024-08-02 03:53:04'),
(36, 'hthtrh', 'hettrh', '2024-08-05', 'Rajkot', '2024-08-01 04:34:06', '2024-08-02 09:53:28'),
(59, 'rftrh', 'trhth', '2024-08-08', 'Rajkot', '2024-08-02 06:17:37', '2024-08-02 06:17:37'),
(60, 'brthy', 'tjyjtyj', '2024-08-09', 'Rajkot', '2024-08-02 06:22:00', '2024-08-02 06:22:00'),
(61, 'fferfre', 'regre', '2024-08-07', 'Ahmedabad', '2024-08-02 06:40:53', '2024-08-03 05:24:08'),
(63, 'Navratri', 'dwkdn', '2024-08-09', 'Rajkot', '2024-08-02 08:25:23', '2024-08-02 08:25:23'),
(65, 'gregre', 'gregre', '2024-08-12', 'Ahmedabad', '2024-08-02 11:04:09', '2024-08-02 19:07:52'),
(66, 'Anniversary Party ', 'jvhvjhj', '2024-08-10', 'Ahmedabad', '2024-08-02 11:33:40', '2024-08-02 19:08:28'),
(67, 'Birthday Party', 'gregre', '2024-08-17', 'Amreli', '2024-08-02 11:44:53', '2024-08-02 19:08:55'),
(70, 'gfdh', 'htrht', '2024-08-09', 'Rajkot', '2024-08-03 05:43:09', '2024-08-03 05:43:09'),
(71, 'fewgt', 'hrthtr', '2024-08-09', 'Rajkot', '2024-08-03 05:43:45', '2024-08-03 05:43:45'),
(72, 'fegfrgrg', 'grthfefrf', '2024-08-10', 'Rajkot', '2024-08-03 05:44:06', '2024-08-03 05:57:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
