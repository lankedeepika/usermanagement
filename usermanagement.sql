-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2025 at 06:35 PM
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
-- Database: `usermanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role` int(10) NOT NULL,
  `mobile` int(15) NOT NULL,
  `alternative_mobile` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `profile_picture` text NOT NULL,
  `signature` text NOT NULL,
  `is_verified` varchar(10) NOT NULL DEFAULT 'N',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `mobile`, `alternative_mobile`, `email`, `password`, `address`, `gender`, `dob`, `profile_picture`, `signature`, `is_verified`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'superadmin', 1, 2147483647, 0, 'superadmin@gmail.com', '$2y$10$V86aEq7a/UXcW0kGUyir0ucIDg6bVu5/XnYv2q9zeEqbOAzf6jML.', 'H.No 2-22,nagayalanka,nagayalanka mandal', 'Male', '2025-09-01', 'uploads/68b8012a66aa9_298662.jpg', 'uploads/68b8012a66ab2_1562046894-300x180.jpg', 'N', '2025-09-03 08:49:46', NULL, 0, 0),
(2, 'admin', 2, 0, 0, 'admin@gmail.com', '$2y$10$qQNHVF4d5Rkpw4p3WNfr/eeFCb9aw9AgK1xGxZOKDhG5myONOdcTO', '', '', '0000-00-00', '', '', 'N', '2025-09-03 09:38:35', NULL, 0, 0),
(4, 'user name', 3, 0, 0, 'user@gmail.com', '$2y$10$0nGeugIyIBE5e4RR1DSYR.PO.SPvFxSR4GkzEM3Ehvt96LNI6vXIS', '', '', '0000-00-00', '', '', 'Y', '2025-09-03 10:26:27', NULL, 0, 0),
(5, 'admin two', 2, 0, 0, 'admintwo@gmail.com', '$2y$10$tF5.ZfdDXKbAX.wLOm.6CuMPFLzITK0GTGfnSXgR74mYgIOLnhu4K', '', '', '0000-00-00', '', '', 'N', '2025-09-03 10:38:33', NULL, 0, 0),
(6, 'user two', 3, 0, 0, 'usertwo@gmail.com', '$2y$10$g.qzfv5I2K0vq.zTpRkunuND9yhk..0r6q/8P19/nop7RCMdFBjVm', '', '', '0000-00-00', '', '', 'Y', '2025-09-03 10:38:59', NULL, 0, 0),
(7, 'deepika', 3, 0, 0, 'deepika@gmail.com', '$2y$10$qiNvtYIr1lZ8newuuDKWm.2LBtmSAaRT.GLog3oRyxRLV9u.hjDVi', '', '', '0000-00-00', '', '', 'N', '2025-09-03 10:51:20', NULL, 0, 0),
(8, 'rani', 3, 0, 0, 'rani@gmail.com', '$2y$10$T9s7B80Je0XpTxkhCvTtfebYC967UHFU4cLPQERjWoSzJM0Mlqqiq', '', '', '0000-00-00', 'uploads/68b81f1b8f7a1_298662.jpg', '', 'N', '2025-09-03 10:57:31', NULL, 0, 0),
(9, 'user three', 3, 0, 0, 'userthree@gmail.com', '$2y$10$MV7PXGXkHQ1i.ADKaoWPQ.x/TJv10XyeAYoO6phgWykLtWisLVJWC', '', '', '0000-00-00', 'uploads/68b81f72d3f63_298662.jpg', '', 'Y', '2025-09-03 10:58:58', NULL, 0, 0),
(10, 'new user', 3, 2147483647, 2147483647, 'newuser@gmail.com', '$2y$10$Vsk7RBoz0R9npqiF7AjqDesLeIDGJmIb8QO9osl5SHpfYbAC2hC6C', 'H.No 2-22,nagayalanka,nagayalanka mandal', 'Female', '2025-08-07', 'uploads/68b8292562288_298662.jpg', 'uploads/68b8292562296_AI-blog-ad.jpg', 'N', '2025-09-03 11:40:21', NULL, 0, 0);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `set_alternative_mobile` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    IF NEW.alternative_mobile IS NULL OR NEW.alternative_mobile = '' THEN
        SET NEW.alternative_mobile = NEW.mobile;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_alternative_mobile` BEFORE UPDATE ON `users` FOR EACH ROW BEGIN
    IF (NEW.alternative_mobile IS NULL OR NEW.alternative_mobile = '') THEN
        SET NEW.alternative_mobile = NEW.mobile;
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
