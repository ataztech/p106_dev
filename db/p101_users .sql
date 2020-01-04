-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2017 at 06:49 PM
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
-- Table structure for table `p101_users`
--

CREATE TABLE `p101_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `flingal_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` text COLLATE utf8mb4_unicode_ci,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` enum('0','1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_status` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `p101_users`
--

INSERT INTO `p101_users` (`id`, `flingal_id`, `provider`, `provider_id`, `name`, `user_type`, `user_status`, `image`, `mobile`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, '1', '1', NULL, '9028285332', 'aamirkazi47@gmail.com', '$2y$10$ClUCqrPXBgxh0xeNY/GUTObExTBJmXV6gcoYlulhn5hX1krg6baNu', '5NPmua3loRHlrj8r1xDDuUizXOkS6QkpcIggpQtkLf5qFKcbxpezqGlvo79j', NULL, NULL),
(12, 'flingal12', 'google', '113853735466915693694', 'Afaque Shaikh', '2', NULL, 'https://lh3.googleusercontent.com/-LVrGNRz6VDQ/AAAAAAAAAAI/AAAAAAAAB48/tR5hlJjONRY/photo.jpg?sz=50', ' ', 'afaque.icon@gmail.com', ' ', 'EXX7BQqGiI6CtC63JrOgVzNWVBjATs71TuAXQOTTPUhEZ95yNxhqbEAFBDsT', '2017-12-08 12:03:21', '2017-12-08 12:03:21'),
(13, 'flingal13', 'facebook', '1134413916693087', 'Hancy Potter', '2', NULL, 'https://graph.facebook.com/v2.10/1134413916693087/picture?type=normal', ' ', 'hancy.pipl@gmail.com', ' ', '97zCBr9W2icZuwT8jLLlSwb7N7LcJvqq5GYO8iJ885SjLVSNi9xYWjgTmgLH', '2017-12-08 12:04:24', '2017-12-08 12:04:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `p101_users`
--
ALTER TABLE `p101_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `p101_users`
--
ALTER TABLE `p101_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
