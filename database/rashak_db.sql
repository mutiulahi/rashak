-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2022 at 01:52 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rashak_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `farm_activities`
--

CREATE TABLE `farm_activities` (
  `id` int(11) NOT NULL,
  `farm_id` int(11) NOT NULL,
  `activity` varchar(200) NOT NULL,
  `start_date` varchar(200) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farm_activities`
--

INSERT INTO `farm_activities` (`id`, `farm_id`, `activity`, `start_date`, `end_date`, `created_at`, `status`) VALUES
(1, 2, 'dfgdfg', '2022-11-16', '2022-11-22', '2022-11-17 19:12:04', 0),
(2, 4, 'Spraying', '2022-11-16', '2022-11-30', '2022-11-17 19:28:43', 1),
(3, 4, 'Planting Potato', '2022-11-15', '2022-11-15', '2022-11-17 19:30:49', 1),
(4, 3, 'Spraying', '2022-11-21', '2022-11-28', '2022-11-17 19:51:29', 1),
(5, 1, 'Spraying', '2022-11-17', '2022-11-20', '2022-11-17 20:05:00', 1),
(6, 1, 'Planting Potato', '2022-11-14', '2022-11-30', '2022-11-17 20:11:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `farm_comments`
--

CREATE TABLE `farm_comments` (
  `id` int(11) NOT NULL,
  `farm_id` int(11) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `farm_details`
--

CREATE TABLE `farm_details` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `location` varchar(200) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `size` varchar(100) NOT NULL,
  `farm_description` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farm_details`
--

INSERT INTO `farm_details` (`id`, `name`, `location`, `picture`, `size`, `farm_description`, `created_at`) VALUES
(1, 'kerkj', 'rjerjker', '', 'jrkj', 'fjjjj', '2022-11-17 09:16:46'),
(2, 'ooola', 'djhjh', '', 'jjdfkjk', 'ndmnmnmndfdf', '2022-11-17 09:20:06'),
(3, 'Farm A', 'ILE GBO', '', '20 achars', 'Computer farm', '2022-11-17 10:54:53'),
(4, 'Aibinu Farm', 'Minna', '', '20 ', 'Okay firm', '2022-11-17 19:28:08');

-- --------------------------------------------------------

--
-- Table structure for table `farm_users`
--

CREATE TABLE `farm_users` (
  `id` int(11) NOT NULL,
  `farm_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farm_users`
--

INSERT INTO `farm_users` (`id`, `farm_id`, `user_id`) VALUES
(9, 1, 3),
(10, 2, 4),
(11, 4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role_id` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `created_at`) VALUES
(1, 'Tescode', 'ola@gmail.com', '1111', '3', '2022-11-13 17:12:04'),
(2, 'Tesleem Olamilekan Mutiulahi ', 'tescode@gmail.com', '444', '3', '2022-11-17 17:25:27'),
(3, 'LinkedIn', 'tescode@gmail.com', '444', '2', '2022-11-17 17:46:30'),
(4, 'index.html', 'wale@gmail.com', '', '2', '2022-11-17 17:52:38'),
(5, 'index.html', 'ola@gmail.com', 'ola', '4', '2022-11-17 18:00:38'),
(6, 'Wale', '123', '', '2', '2022-11-17 19:46:11'),
(7, 'Tesleem Mutiulahi', 'tes@gmail.com', 'tes', '2', '2022-11-17 19:50:01'),
(8, 'Abdulah Oyedokun', 'abdulah@gmail.com', '123456', '2', '2022-11-17 20:07:41'),
(9, 'Oye', 'oye@gmail.com', 'okay', '2', '2022-11-17 20:09:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `farm_activities`
--
ALTER TABLE `farm_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farm_comments`
--
ALTER TABLE `farm_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farm_details`
--
ALTER TABLE `farm_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farm_users`
--
ALTER TABLE `farm_users`
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
-- AUTO_INCREMENT for table `farm_activities`
--
ALTER TABLE `farm_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `farm_comments`
--
ALTER TABLE `farm_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farm_details`
--
ALTER TABLE `farm_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `farm_users`
--
ALTER TABLE `farm_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
