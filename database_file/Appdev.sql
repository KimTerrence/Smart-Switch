-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 31, 2025 at 11:57 AM
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
-- Database: `Appdev`
--

-- --------------------------------------------------------

--
-- Table structure for table `switch`
--

CREATE TABLE `switch` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `switch` varchar(100) NOT NULL,
  `motion` varchar(100) NOT NULL,
  `light` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'unrestrict',
  `user` varchar(100) NOT NULL DEFAULT 'all'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `switch`
--

INSERT INTO `switch` (`id`, `name`, `ip_address`, `switch`, `motion`, `light`, `status`, `user`) VALUES
(109, 'sdsd', 'sdd', 'off', 'disabled', 'disabled', 'unrestrict', 'all'),
(110, 'ss', 'ss', 'off', 'off', 'off', 'unrestrict', 'all'),
(111, 's', 's', 'off', 'off', 'off', 'unrestrict', 'all');

-- --------------------------------------------------------

--
-- Table structure for table `switch_logs`
--

CREATE TABLE `switch_logs` (
  `id` int(11) NOT NULL,
  `switch_name` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'User',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `firstname`, `lastname`, `username`, `password`, `status`, `timestamp`) VALUES
(8, 'system', 'admin', 'admin', '$2y$10$A3EYFh5xauaoSrI6c0jeSu0OqoQNU6rc9YkpOio/1ndosQzNGISsC', 'Admin', '2025-01-05 13:40:27'),
(9, 'Kim Terrence', 'Quines', 'kimterrence', '$2y$10$xsYFgPej0WYME6gvZ8A4dO7MxGSSg6z.U1TwN.gTeKRkL5s0C41r.', 'User', '2025-01-05 13:42:24'),
(13, 'dummy', 'dummy', 'dummy', '$2y$10$F6bWCO15TWV9uMMxFFHF1On1/N5IHgtMEbxpt0MPUYLgH4SJyePgi', 'Blocked_User', '2025-01-19 13:40:43'),
(14, 'ad', 'add', 'd', '$2y$10$vICQgU0blzWBW32V/CrK6ObjzcdOKIT4pu7uAIYxmxCoOnHD5nb5y', 'Blocked_User', '2025-01-29 15:57:47'),
(15, 'cc', 'c', 'c', '$2y$10$RhD.fnCFBxGTfH1W.cXoweJbQcyq/NHCDPC1wkRMcDABDf/eOfHW.', 'Blocked_User', '2025-01-29 15:58:49'),
(16, 'dds', 'vd', 'V', '$2y$10$65ouJ7kV1ie4y3G.5tpG7eRYq72lUnypOL/u6Ygp8tcANNBKhWUgq', 'Blocked_User', '2025-01-29 15:59:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `switch`
--
ALTER TABLE `switch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `switch_logs`
--
ALTER TABLE `switch_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `switch`
--
ALTER TABLE `switch`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `switch_logs`
--
ALTER TABLE `switch_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
