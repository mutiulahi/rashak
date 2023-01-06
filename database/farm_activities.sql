-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2023 at 08:43 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

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
  `farm_id` varchar(100) NOT NULL,
  `crop` varchar(200) NOT NULL,
  `harvest_date` varchar(200) NOT NULL,
  `total_yield` varchar(200) NOT NULL,
  `warehouse_to_be_delivered_to` varchar(200) NOT NULL,
  `actions` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farm_activities`
--

INSERT INTO `farm_activities` (`id`, `farm_id`, `crop`, `harvest_date`, `total_yield`, `warehouse_to_be_delivered_to`, `actions`, `created_at`, `status`) VALUES
(1, '2', 'dfgdfg', '2022-11-16', '2022-11-22', '', '', '2022-11-17 19:12:04', 0),
(2, '4', 'Spraying', '2022-11-16', '2022-11-30', '', '', '2022-11-17 19:28:43', 1),
(3, '4', 'Planting Potato', '2022-11-15', '2022-11-15', '', '', '2022-11-17 19:30:49', 1),
(4, '3', 'Spraying', '2022-11-21', '2022-11-28', '', '', '2022-11-17 19:51:29', 1),
(5, '1', 'Spraying', '2022-11-17', '2022-11-20', '', '', '2022-11-17 20:05:00', 1),
(6, '1', 'Planting Potato', '2022-11-14', '2022-11-30', '', '', '2022-11-17 20:11:08', 1),
(7, '0', 'corn ball', '2023-01-05', '4', 'ipaja', '', '2023-01-05 21:32:11', 0),
(8, 'RASH/FARMER/23/4317', 'happy', '2023-01-11', '56', 'oshodi', '', '2023-01-05 21:40:40', 0),
(9, 'RASH/FARMER/23/4317', 'today', '2023-01-01', '788', 'abule-egba', '', '2023-01-05 21:44:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `farm_activities`
--
ALTER TABLE `farm_activities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `farm_activities`
--
ALTER TABLE `farm_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
