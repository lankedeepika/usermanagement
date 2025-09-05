# usermanagement

User Management System – PHP, MySQL, jQuery, AJAX
📌 Features

Super Admin

Add, Edit, Delete all users

Admin

Add, Delete users (no edit access)

User

Register account (requires Admin approval)

Update profile only

🗄 Database Setup
1. Create Database
CREATE DATABASE usermanagement;

2. Use Database
USE usermanagement;

3. Create Table – users

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

