-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2025 at 06:46 PM
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
-- Database: `company_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_joining` date NOT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_name`, `designation`, `date_of_birth`, `date_of_joining`, `blood_group`, `mobile`, `email`, `address`, `created_at`) VALUES
(1, 'Employee 1', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000001', 'employee1@example.com', 'City 1', '2025-09-03 10:15:34'),
(2, 'Employee 2', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000002', 'employee2@example.com', 'City 2', '2025-09-03 10:15:34'),
(3, 'Employee 3', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000003', 'employee3@example.com', 'City 3', '2025-09-03 10:15:34'),
(4, 'Employee 4', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000004', 'employee4@example.com', 'City 4', '2025-09-03 10:15:34'),
(5, 'Employee 5', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000005', 'employee5@example.com', 'City 5', '2025-09-03 10:15:34'),
(6, 'Employee 6', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000006', 'employee6@example.com', 'City 6', '2025-09-03 10:15:34'),
(7, 'Employee 7', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000007', 'employee7@example.com', 'City 7', '2025-09-03 10:15:34'),
(8, 'Employee 8', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000008', 'employee8@example.com', 'City 8', '2025-09-03 10:15:34'),
(9, 'Employee 9', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000009', 'employee9@example.com', 'City 9', '2025-09-03 10:15:34'),
(10, 'Employee 10', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000010', 'employee10@example.com', 'City 10', '2025-09-03 10:15:34'),
(11, 'Employee 11', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000011', 'employee11@example.com', 'City 11', '2025-09-03 10:15:35'),
(12, 'Employee 12', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000012', 'employee12@example.com', 'City 12', '2025-09-03 10:15:35'),
(13, 'Employee 13', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000013', 'employee13@example.com', 'City 13', '2025-09-03 10:15:35'),
(14, 'Employee 14', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000014', 'employee14@example.com', 'City 14', '2025-09-03 10:15:35'),
(15, 'Employee 15', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000015', 'employee15@example.com', 'City 15', '2025-09-03 10:15:35'),
(16, 'Employee 16', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000016', 'employee16@example.com', 'City 16', '2025-09-03 10:15:35'),
(17, 'Employee 17', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000017', 'employee17@example.com', 'City 17', '2025-09-03 10:15:35'),
(18, 'Employee 18', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000018', 'employee18@example.com', 'City 18', '2025-09-03 10:15:35'),
(19, 'Employee 19', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000019', 'employee19@example.com', 'City 19', '2025-09-03 10:15:35'),
(20, 'Employee 20', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000020', 'employee20@example.com', 'City 20', '2025-09-03 10:15:35'),
(21, 'Employee 21', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000021', 'employee21@example.com', 'City 21', '2025-09-03 10:15:35'),
(22, 'Employee 22', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000022', 'employee22@example.com', 'City 22', '2025-09-03 10:15:35'),
(23, 'Employee 23', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000023', 'employee23@example.com', 'City 23', '2025-09-03 10:15:35'),
(24, 'Employee 24', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000024', 'employee24@example.com', 'City 24', '2025-09-03 10:15:35'),
(25, 'Employee 25', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000025', 'employee25@example.com', 'City 25', '2025-09-03 10:15:35'),
(26, 'Employee 26', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000026', 'employee26@example.com', 'City 26', '2025-09-03 10:15:35'),
(27, 'Employee 27', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000027', 'employee27@example.com', 'City 27', '2025-09-03 10:15:35'),
(28, 'Employee 28', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000028', 'employee28@example.com', 'City 28', '2025-09-03 10:15:35'),
(29, 'Employee 29', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000029', 'employee29@example.com', 'City 29', '2025-09-03 10:15:35'),
(30, 'Employee 30', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000030', 'employee30@example.com', 'City 30', '2025-09-03 10:15:35'),
(31, 'Employee 31', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000031', 'employee31@example.com', 'City 31', '2025-09-03 10:15:35'),
(32, 'Employee 32', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000032', 'employee32@example.com', 'City 32', '2025-09-03 10:15:35'),
(33, 'Employee 33', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000033', 'employee33@example.com', 'City 33', '2025-09-03 10:15:35'),
(34, 'Employee 34', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000034', 'employee34@example.com', 'City 34', '2025-09-03 10:15:36'),
(35, 'Employee 35', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000035', 'employee35@example.com', 'City 35', '2025-09-03 10:15:36'),
(36, 'Employee 36', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000036', 'employee36@example.com', 'City 36', '2025-09-03 10:15:36'),
(37, 'Employee 37', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000037', 'employee37@example.com', 'City 37', '2025-09-03 10:15:36'),
(38, 'Employee 38', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000038', 'employee38@example.com', 'City 38', '2025-09-03 10:15:36'),
(39, 'Employee 39', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000039', 'employee39@example.com', 'City 39', '2025-09-03 10:15:36'),
(40, 'Employee 40', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000040', 'employee40@example.com', 'City 40', '2025-09-03 10:15:36'),
(41, 'Employee 41', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000041', 'employee41@example.com', 'City 41', '2025-09-03 10:15:36'),
(42, 'Employee 42', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000042', 'employee42@example.com', 'City 42', '2025-09-03 10:15:36'),
(43, 'Employee 43', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000043', 'employee43@example.com', 'City 43', '2025-09-03 10:15:36'),
(44, 'Employee 44', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000044', 'employee44@example.com', 'City 44', '2025-09-03 10:15:36'),
(45, 'Employee 45', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000045', 'employee45@example.com', 'City 45', '2025-09-03 10:15:36'),
(46, 'Employee 46', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000046', 'employee46@example.com', 'City 46', '2025-09-03 10:15:36'),
(47, 'Employee 47', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000047', 'employee47@example.com', 'City 47', '2025-09-03 10:15:36'),
(48, 'Employee 48', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000048', 'employee48@example.com', 'City 48', '2025-09-03 10:15:36'),
(49, 'Employee 49', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000049', 'employee49@example.com', 'City 49', '2025-09-03 10:15:36'),
(50, 'Employee 50', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000050', 'employee50@example.com', 'City 50', '2025-09-03 10:15:36'),
(51, 'Employee 51', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000051', 'employee51@example.com', 'City 51', '2025-09-03 10:15:36'),
(52, 'Employee 52', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000052', 'employee52@example.com', 'City 52', '2025-09-03 10:15:36'),
(53, 'Employee 53', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000053', 'employee53@example.com', 'City 53', '2025-09-03 10:15:36'),
(54, 'Employee 54', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000054', 'employee54@example.com', 'City 54', '2025-09-03 10:15:36'),
(55, 'Employee 55', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000055', 'employee55@example.com', 'City 55', '2025-09-03 10:15:36'),
(56, 'Employee 56', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000056', 'employee56@example.com', 'City 56', '2025-09-03 10:15:36'),
(57, 'Employee 57', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000057', 'employee57@example.com', 'City 57', '2025-09-03 10:15:36'),
(58, 'Employee 58', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000058', 'employee58@example.com', 'City 58', '2025-09-03 10:15:36'),
(59, 'Employee 59', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000059', 'employee59@example.com', 'City 59', '2025-09-03 10:15:36'),
(60, 'Employee 60', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000060', 'employee60@example.com', 'City 60', '2025-09-03 10:15:36'),
(61, 'Employee 61', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000061', 'employee61@example.com', 'City 61', '2025-09-03 10:15:36'),
(62, 'Employee 62', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000062', 'employee62@example.com', 'City 62', '2025-09-03 10:15:36'),
(63, 'Employee 63', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000063', 'employee63@example.com', 'City 63', '2025-09-03 10:15:37'),
(64, 'Employee 64', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000064', 'employee64@example.com', 'City 64', '2025-09-03 10:15:37'),
(65, 'Employee 65', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000065', 'employee65@example.com', 'City 65', '2025-09-03 10:15:37'),
(66, 'Employee 66', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000066', 'employee66@example.com', 'City 66', '2025-09-03 10:15:37'),
(67, 'Employee 67', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000067', 'employee67@example.com', 'City 67', '2025-09-03 10:15:37'),
(68, 'Employee 68', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000068', 'employee68@example.com', 'City 68', '2025-09-03 10:15:37'),
(69, 'Employee 69', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000069', 'employee69@example.com', 'City 69', '2025-09-03 10:15:37'),
(70, 'Employee 70', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000070', 'employee70@example.com', 'City 70', '2025-09-03 10:15:37'),
(71, 'Employee 71', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000071', 'employee71@example.com', 'City 71', '2025-09-03 10:15:37'),
(72, 'Employee 72', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000072', 'employee72@example.com', 'City 72', '2025-09-03 10:15:37'),
(73, 'Employee 73', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000073', 'employee73@example.com', 'City 73', '2025-09-03 10:15:37'),
(74, 'Employee 74', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000074', 'employee74@example.com', 'City 74', '2025-09-03 10:15:37'),
(75, 'Employee 75', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000075', 'employee75@example.com', 'City 75', '2025-09-03 10:15:37'),
(76, 'Employee 76', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000076', 'employee76@example.com', 'City 76', '2025-09-03 10:15:37'),
(77, 'Employee 77', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000077', 'employee77@example.com', 'City 77', '2025-09-03 10:15:37'),
(78, 'Employee 78', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000078', 'employee78@example.com', 'City 78', '2025-09-03 10:15:37'),
(79, 'Employee 79', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000079', 'employee79@example.com', 'City 79', '2025-09-03 10:15:37'),
(80, 'Employee 80', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000080', 'employee80@example.com', 'City 80', '2025-09-03 10:15:37'),
(81, 'Employee 81', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000081', 'employee81@example.com', 'City 81', '2025-09-03 10:15:37'),
(82, 'Employee 82', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000082', 'employee82@example.com', 'City 82', '2025-09-03 10:15:37'),
(83, 'Employee 83', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000083', 'employee83@example.com', 'City 83', '2025-09-03 10:15:37'),
(84, 'Employee 84', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000084', 'employee84@example.com', 'City 84', '2025-09-03 10:15:37'),
(85, 'Employee 85', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000085', 'employee85@example.com', 'City 85', '2025-09-03 10:15:37'),
(86, 'Employee 86', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000086', 'employee86@example.com', 'City 86', '2025-09-03 10:15:37'),
(87, 'Employee 87', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000087', 'employee87@example.com', 'City 87', '2025-09-03 10:15:38'),
(88, 'Employee 88', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000088', 'employee88@example.com', 'City 88', '2025-09-03 10:15:38'),
(89, 'Employee 89', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000089', 'employee89@example.com', 'City 89', '2025-09-03 10:15:38'),
(90, 'Employee 90', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000090', 'employee90@example.com', 'City 90', '2025-09-03 10:15:38'),
(91, 'Employee 91', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000091', 'employee91@example.com', 'City 91', '2025-09-03 10:15:38'),
(92, 'Employee 92', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000092', 'employee92@example.com', 'City 92', '2025-09-03 10:15:38'),
(93, 'Employee 93', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000093', 'employee93@example.com', 'City 93', '2025-09-03 10:15:38'),
(94, 'Employee 94', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000094', 'employee94@example.com', 'City 94', '2025-09-03 10:15:38'),
(95, 'Employee 95', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000095', 'employee95@example.com', 'City 95', '2025-09-03 10:15:38'),
(96, 'Employee 96', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000096', 'employee96@example.com', 'City 96', '2025-09-03 10:15:38'),
(97, 'Employee 97', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000097', 'employee97@example.com', 'City 97', '2025-09-03 10:15:38'),
(98, 'Employee 98', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000098', 'employee98@example.com', 'City 98', '2025-09-03 10:15:38'),
(99, 'Employee 99', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000099', 'employee99@example.com', 'City 99', '2025-09-03 10:15:38'),
(100, 'Employee 100', 'Software Engineer', '1990-01-01', '2020-01-01', 'A+', '9000000100', 'employee100@example.com', 'City 100', '2025-09-03 10:15:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
