-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2018 at 04:15 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foxentry`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventId` int(10) UNSIGNED NOT NULL,
  `eventName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `eventDate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `eventVenue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `eventTime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `eventPhoto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `eventFee` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_08_22_060941_create_events_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `studno` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `studno`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 20479634, 'Paul Andrey Cabrera', 'paulandreycabrera@gmail.com', '$2y$10$LAzLQEIhE88sgzO8kEpL4u1RW1EfD14xznudI80XJZd0LlwzBztpq', 'ADMIN', 'F7uxSXmM5xHAIh6XWvkGtnJ2TPfigZml8rr2aYgMEOLUPpQPTvWjkfX7c7T7', '2018-08-22 17:50:54', '2018-08-22 17:50:54'),
(2, 12345, '123456', 'asd@g.com', '123456', 'STUDENT', 'd5or8yFwdkE0KnFCwCBeAcFD9zawVOBwoW7FpSRLHHso5FfFKMAWAIthxgGC', '2018-08-22 17:59:01', '2018-08-22 18:52:54'),
(3, 9, 'asd', 'qq@yahoo.com.ph', '$2y$10$95EUHr9LX7391ceYYuaZ/ues8xA3yG7XjWRYC.QwUqrUUzQQ1VoeG', 'STUDENT', NULL, '2018-08-22 18:32:36', '2018-08-22 18:32:36'),
(4, 13, 'asd', 'sample@g.com', '$2y$10$/7zmIqFEJgyuveqlczruHuLXvM69/QJeLusIQKprniw6PVHD9sqeS', 'STUDENT', NULL, '2018-08-22 18:33:25', '2018-08-22 18:33:25'),
(5, 7, 'asd', 'asdx@g.com', '$2y$10$juzxH7rS3A/uCFtljLX1U.qOPrwuQkCCvyv79PPrER/w8qsCTq/Bu', 'STUDENT', NULL, '2018-08-22 18:33:44', '2018-08-22 18:33:44'),
(6, 12, 'asd', 'dd@g.com', '$2y$10$RikIIrxbyjw1JvpzBHVEpOZkwul2QEpOaImF/bv8ZLMOneHNW4PIW', 'STUDENT', 'OgF2qgYFzgjgLo0gWIB7VnQnqE7d58DzDmrhj4qNeabletbmneQ9mABr4fm0', '2018-08-22 18:36:26', '2018-08-22 18:36:26'),
(7, 123, 'Admin', 'admin@g.com', '$2y$10$1DeYKnT288Nw8.i3tC6iCuilzK7uK3LsLoZ6Ykh4dwTdnldEpI5OO', 'ADMIN', NULL, '2018-08-23 18:14:45', '2018-08-23 18:14:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventId`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_studno_unique` (`studno`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
