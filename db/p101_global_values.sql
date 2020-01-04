-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2017 at 06:33 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

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
-- Table structure for table `p101_global_values`
--

CREATE TABLE `p101_global_values` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `p101_global_values`
--

INSERT INTO `p101_global_values` (`id`, `name`, `slug`, `value`, `created_at`, `updated_at`) VALUES
(1, 'contact', 'contact', '9028285332', '2017-11-29 17:58:06', '2017-11-29 17:41:06'),
(2, 'site email', 'site-email', 'aamir@mail.com', '2017-11-29 17:56:36', '2017-11-29 17:41:16'),
(3, 'facebook link', 'facebook', 'www.facebook.com', '2017-11-29 17:56:43', '0000-00-00 00:00:00'),
(4, 'twiter link', 'twitter', 'twitter.com', '2017-11-29 17:56:49', '0000-00-00 00:00:00'),
(5, 'site title', 'site-title', 'Afqami', '2017-11-29 17:56:57', '0000-00-00 00:00:00'),
(6, 'google plus', 'google-plus', 'plus.google.com', '2017-11-29 17:59:42', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `p101_global_values`
--
ALTER TABLE `p101_global_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `p101_global_values`
--
ALTER TABLE `p101_global_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
