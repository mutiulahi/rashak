-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2023 at 07:12 AM
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
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `date_of_birth` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `disability` varchar(100) NOT NULL,
  `marital_status` varchar(100) NOT NULL,
  `did_you_have_children` varchar(150) NOT NULL,
  `numbers_of_children` varchar(100) NOT NULL,
  `is_children_in_school` varchar(100) NOT NULL,
  `average_monthly_income` varchar(100) NOT NULL,
  `other_income` varchar(100) NOT NULL,
  `land_size` varchar(400) NOT NULL,
  `land_picture` varchar(400) NOT NULL,
  `upload_profile_picture` varchar(300) NOT NULL,
  `farm_location` varchar(200) NOT NULL,
  `home_address` varchar(200) NOT NULL,
  `state_of_origin` varchar(100) NOT NULL,
  `nationality` varchar(300) NOT NULL,
  `national_means_of_identity` varchar(400) NOT NULL,
  `commitment_fee` varchar(200) NOT NULL,
  `reciept_of_commitment` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id`, `unique_id`, `email`, `first_name`, `last_name`, `phone_number`, `date_of_birth`, `gender`, `disability`, `marital_status`, `did_you_have_children`, `numbers_of_children`, `is_children_in_school`, `average_monthly_income`, `other_income`, `land_size`, `land_picture`, `upload_profile_picture`, `farm_location`, `home_address`, `state_of_origin`, `nationality`, `national_means_of_identity`, `commitment_fee`, `reciept_of_commitment`) VALUES
(1, 'RASH/FARMER/23/6403', '', 'Denis', 'Wisoky', '816-414-0198', '2023-05-18 00:36:48', 'Female', 'Yes', 'Married', 'No', '124', 'Yes public school', 'Est aliquam qui et.', '', 'Et veniam consectetur mollitia et dignissimos enim quasi rerum labore.', '', '', '', '43869 Harvey Trace', 'New Hampshire', 'Djibouti', '', '', ''),
(2, 'RASH/FARMER/23/9963', 'your.email+fakedata30103@gmail.com', 'Constance', 'Dietrich', '251-638-5946', '2023-02-24 08:55:51', 'Male', 'No', 'Divorced', 'No', '342', 'No not in school', 'Exercitationem nobis enim est aut dolores.', 'Osun', 'Nihil ab dolorem alias consequatur quia aut est.', 'Array', '', '', '76325 Turcotte Rapids', 'Arkansas', 'Algeria', 'Array', '', 'Array'),
(3, 'RASH/FARMER/23/4615', 'your.email+fakedata49197@gmail.com', 'Tina', 'Mills', '111-633-9244', '2023-02-17 03:15:35', 'Male', 'No', 'Married', 'Yes', '257', 'Yes private school', 'Accusamus minus et nobis voluptatem.', '', 'Asperiores aut laboriosam aliquam modi possimus magnam molestiae.', '../uploads/farmers/63b6272f88cd46.44102459.docx', '../uploads/farmers/63b6272f886972.64838180.docx', 'Minna', '295 Cordie Field', 'North Dakota', 'Cayman Islands', '../uploads/farmers/63b6272f8959e6.51401535.jpg', '', '../uploads/farmers/63b6272f89b297.91711143.docx'),
(4, 'RASH/FARMER/23/4317', 'your.email+fakedata54012@gmail.com', 'Helga', 'Padberg', '953-802-9028', '2023-05-19 15:16:55', 'Female', 'Yes', 'Single', 'Yes', '643', 'Yes public school', 'Quis qui iste repudiandae deserunt quisquam aut harum quo quo.', '', 'Qui dolor dolore dolorem id.', '../uploads/farmers/63b6679a755fa3.19244490.', '../uploads/farmers/63b6679a755ee8.40191398.', '', '2221 Theresa Light', 'Illinois', 'Pakistan', '../uploads/farmers/63b6679a756010.15641054.', '', '../uploads/farmers/63b6679a756075.38021657.');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_check_lists`
--

CREATE TABLE `farmer_check_lists` (
  `id` int(11) NOT NULL,
  `farmer_id` varchar(100) NOT NULL,
  `training` varchar(20) DEFAULT NULL,
  `land_preparation` varchar(20) DEFAULT NULL,
  `receiveid_input` varchar(20) DEFAULT NULL,
  `pre_emerg_herbicide_app` varchar(20) DEFAULT NULL,
  `planted` varchar(20) DEFAULT NULL,
  `post_emerg_herbicide_app` varchar(20) DEFAULT NULL,
  `fertilized` varchar(20) DEFAULT NULL,
  `harvest` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farmer_check_lists`
--

INSERT INTO `farmer_check_lists` (`id`, `farmer_id`, `training`, `land_preparation`, `receiveid_input`, `pre_emerg_herbicide_app`, `planted`, `post_emerg_herbicide_app`, `fertilized`, `harvest`, `created_at`, `updated_at`) VALUES
(1, 'RASH/FARMER/23/4317', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-05 06:00:58', '2023-01-05 06:00:58');

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

-- --------------------------------------------------------

--
-- Table structure for table `farm_users`
--

CREATE TABLE `farm_users` (
  `id` int(11) NOT NULL,
  `farm_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role_id` varchar(20) NOT NULL COMMENT '1=admin, 2=supervisor, 3=>farmers',
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
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `farmer_check_lists`
--
ALTER TABLE `farmer_check_lists`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `farmer_check_lists`
--
ALTER TABLE `farmer_check_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `farm_activities`
--
ALTER TABLE `farm_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farm_comments`
--
ALTER TABLE `farm_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farm_details`
--
ALTER TABLE `farm_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farm_users`
--
ALTER TABLE `farm_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
