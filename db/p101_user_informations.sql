-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2017 at 06:55 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `p101`
--

-- --------------------------------------------------------

--
-- Table structure for table `p101_user_informations`
--

CREATE TABLE `p101_user_informations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `activation_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_status` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1=>admin,2=>user',
  `image` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `p101_user_informations`
--

INSERT INTO `p101_user_informations` (`id`, `user_id`, `first_name`, `last_name`, `city`, `state`, `address`, `activation_code`, `user_status`, `user_type`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'super', 'admin', 'pune', 'maharashtra', '', '', '1', '1', NULL, NULL, NULL, NULL),
(4, 5, 'Hancy Potter', NULL, NULL, NULL, NULL, NULL, NULL, '2', 'https://graph.facebook.com/v2.10/1134413916693087/picture?type=normal', NULL, '2017-12-05 11:55:56', '2017-12-05 11:55:56'),
(5, 6, 'Afaque Shaikh', NULL, NULL, NULL, NULL, NULL, NULL, '2', 'https://lh3.googleusercontent.com/-LVrGNRz6VDQ/AAAAAAAAAAI/AAAAAAAAB48/tR5hlJjONRY/photo.jpg?sz=50', NULL, '2017-12-05 11:59:04', '2017-12-05 11:59:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `p101_user_informations`
--
ALTER TABLE `p101_user_informations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `p101_user_informations`
--
ALTER TABLE `p101_user_informations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
