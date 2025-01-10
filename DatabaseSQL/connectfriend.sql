-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 05:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connectfriend`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatars`
--

CREATE TABLE `avatars` (
  `avatar_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `avatars`
--

INSERT INTO `avatars` (`avatar_id`, `name`, `image_path`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Avatar 1', 'images/avatars/avatar1.jpg', 50, '2025-01-08 08:04:16', '2025-01-08 08:04:16'),
(2, 'Avatar 2', 'images/avatars/avatar2.jpg', 100, '2025-01-08 08:04:16', '2025-01-08 08:04:16'),
(3, 'Avatar 3', 'images/avatars/avatar3.jpg', 500, '2025-01-08 08:04:16', '2025-01-08 08:04:16'),
(4, 'Avatar 4', 'images/avatars/avatar4.jpg', 1000, '2025-01-08 08:04:16', '2025-01-08 08:04:16'),
(5, 'Avatar 5', 'images/avatars/avatar5.jpg', 5000, '2025-01-08 08:04:16', '2025-01-08 08:04:16'),
(6, 'Avatar 6', 'images/avatars/avatar6.jpg', 10000, '2025-01-08 08:04:16', '2025-01-08 08:04:16'),
(7, 'Avatar 7', 'images/avatars/avatar7.jpg', 25000, '2025-01-08 08:04:16', '2025-01-08 08:04:16'),
(8, 'Avatar 8', 'images/avatars/avatar8.jpg', 50000, '2025-01-08 08:04:16', '2025-01-08 08:04:16'),
(9, 'Avatar 9', 'images/avatars/avatar9.jpg', 75000, '2025-01-08 08:04:16', '2025-01-08 08:04:16'),
(10, 'Avatar 10', 'images/avatars/avatar10.jpg', 100000, '2025-01-08 08:04:16', '2025-01-08 08:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `hobby` varchar(500) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `coin` int(11) NOT NULL DEFAULT 100,
  `photo` varchar(255) DEFAULT NULL,
  `is_hidden` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `username`, `password`, `email`, `gender`, `hobby`, `instagram`, `phone`, `price`, `coin`, `photo`, `is_hidden`, `created_at`, `updated_at`) VALUES
(1, 'Cio', '12345678', 'jonathanlawrencio@gmail.com', 'male', 'belajar,makan,membaca', 'http://www.instagram.com/JonathanLaw', '0895617044005', 121912, 3545, '1736457516.jpg', 1, '2025-01-08 08:04:23', '2025-01-09 14:18:36'),
(2, 'Enje', '12345678', 'enje@gmail.com', 'female', 'tidur,makan,belajar', 'http://www.instagram.com/Enje', '0896823944990', 101719, 355, '1736447786.jpg', 0, '2025-01-08 08:14:24', '2025-01-09 11:36:26'),
(3, 'Chen', '12345678', 'chen@gmail.com', 'male', 'belajar,makan,membaca', 'http://www.instagram.com/Chen', '0898765677998', 114716, 100, NULL, 0, '2025-01-08 08:40:10', '2025-01-08 08:40:10'),
(4, 'Asep', '12345678', 'asep@gmail.com', 'male', 'tidur,belajar,membaca', 'http://www.instagram.com/Asep', '0898765677998', 112878, 185, '1736446192.png', 0, '2025-01-09 04:17:06', '2025-01-09 11:09:52'),
(5, 'Cici', '12345678', 'cici@gmail.com', 'female', 'membaca,belajar,tidur', 'http://www.instagram.com/Cici', '0876787099887', 116292, 103, NULL, 0, '2025-01-09 12:22:18', '2025-01-09 12:22:18'),
(6, 'Yolo', '12345678', 'yolo@gmail.com', 'male', 'berkuda,belajar,berdoa', 'http://www.instagram.com/Yolo', '0867554656776', 107551, 100, NULL, 0, '2025-01-09 12:51:59', '2025-01-09 12:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `customer_avatars`
--

CREATE TABLE `customer_avatars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `avatar_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_avatars`
--

INSERT INTO `customer_avatars` (`id`, `customer_id`, `avatar_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-01-08 08:04:37', '2025-01-08 08:04:37'),
(2, 2, 2, '2025-01-08 08:28:07', '2025-01-08 08:28:07'),
(3, 2, 5, '2025-01-08 09:55:46', '2025-01-08 09:55:46'),
(4, 4, 1, '2025-01-09 10:38:16', '2025-01-09 10:38:16'),
(5, 4, 2, '2025-01-09 10:51:07', '2025-01-09 10:51:07'),
(6, 2, 1, '2025-01-09 11:23:34', '2025-01-09 11:23:34'),
(7, 2, 3, '2025-01-09 11:24:36', '2025-01-09 11:24:36'),
(8, 2, 4, '2025-01-09 11:24:56', '2025-01-09 11:24:56'),
(9, 1, 2, '2025-01-09 13:40:10', '2025-01-09 13:40:10'),
(10, 1, 3, '2025-01-09 13:50:52', '2025-01-09 13:50:52'),
(11, 1, 4, '2025-01-09 14:08:33', '2025-01-09 14:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `friend_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `customer_id`, `friend_id`, `created_at`, `updated_at`) VALUES
(9, 4, 1, '2025-01-09 14:12:52', '2025-01-09 14:12:52'),
(10, 1, 4, '2025-01-09 14:12:52', '2025-01-09 14:12:52'),
(11, 3, 1, '2025-01-09 14:13:06', '2025-01-09 14:13:06'),
(12, 1, 3, '2025-01-09 14:13:06', '2025-01-09 14:13:06'),
(13, 5, 1, '2025-01-09 14:13:19', '2025-01-09 14:13:19'),
(14, 1, 5, '2025-01-09 14:13:19', '2025-01-09 14:13:19'),
(15, 6, 1, '2025-01-09 14:13:34', '2025-01-09 14:13:34'),
(16, 1, 6, '2025-01-09 14:13:34', '2025-01-09 14:13:34');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_03_140405_create_customers_table', 1),
(5, '2025_01_06_100720_create_wishlists_table', 1),
(6, '2025_01_07_100506_create_friends_table', 1),
(7, '2025_01_07_124019_create_notifications_table', 1),
(8, '2025_01_08_034606_create_avatars_table', 1),
(9, '2025_01_08_041638_create_customer_avatars_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `customer_id`, `sender_id`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'You have received a friend request!', 0, '2025-01-08 09:06:33', '2025-01-08 09:06:33'),
(2, 1, 2, 'You have received a friend request!', 0, '2025-01-08 09:07:31', '2025-01-08 09:07:31'),
(3, 3, 1, 'You have received a friend request!', 0, '2025-01-09 04:24:02', '2025-01-09 04:24:02'),
(4, 3, 1, 'You have received a friend request!', 0, '2025-01-09 09:53:24', '2025-01-09 09:53:24'),
(5, 3, 1, 'You have received a friend request!', 0, '2025-01-09 10:01:31', '2025-01-09 10:01:31'),
(6, 3, 1, 'You have received a friend request!', 0, '2025-01-09 10:01:42', '2025-01-09 10:01:42'),
(7, 1, 4, 'You have received a friend request!', 0, '2025-01-09 11:10:03', '2025-01-09 11:10:03'),
(8, 1, 4, 'You have received a friend request!', 0, '2025-01-09 11:10:14', '2025-01-09 11:10:14'),
(9, 4, 1, 'You have received a friend request!', 0, '2025-01-09 11:19:05', '2025-01-09 11:19:05'),
(10, 2, 1, 'You have received a friend request!', 0, '2025-01-09 11:22:53', '2025-01-09 11:22:53'),
(11, 1, 2, 'You have received a friend request!', 0, '2025-01-09 11:23:03', '2025-01-09 11:23:03'),
(12, 1, 2, 'You have received a friend request!', 0, '2025-01-09 11:36:12', '2025-01-09 11:36:12'),
(13, 2, 1, 'You have received a friend request!', 0, '2025-01-09 13:29:06', '2025-01-09 13:29:06'),
(14, 3, 1, 'You have received a friend request!', 0, '2025-01-09 13:29:54', '2025-01-09 13:29:54'),
(15, 4, 1, 'You have received a friend request!', 0, '2025-01-09 14:12:17', '2025-01-09 14:12:17'),
(16, 5, 1, 'You have received a friend request!', 0, '2025-01-09 14:12:21', '2025-01-09 14:12:21'),
(17, 6, 1, 'You have received a friend request!', 0, '2025-01-09 14:12:23', '2025-01-09 14:12:23'),
(18, 1, 4, 'You have received a friend request!', 0, '2025-01-09 14:12:52', '2025-01-09 14:12:52'),
(19, 1, 3, 'You have received a friend request!', 0, '2025-01-09 14:13:06', '2025-01-09 14:13:06'),
(20, 1, 5, 'You have received a friend request!', 0, '2025-01-09 14:13:19', '2025-01-09 14:13:19'),
(21, 1, 6, 'You have received a friend request!', 0, '2025-01-09 14:13:34', '2025-01-09 14:13:34');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('KHTh71xUevdIRfV8Ex4G0d2N085RneHjfvg2UKep', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiNU0zRHFFRnpZTXVuQVRjd2FRMFk4djJDd2t2OVNFY2VKeXh3ZnJEWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hdmF0YXJzP3RhYj1zdG9yZSI7fX0=', 1736484107);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2025-01-08 08:04:16', '$2y$12$NYkVt1DewY/BO/2ZY7jjfO2gGNS0wFvfB1GC8IJQOJIutf0QOklzq', 'SYid5OvGgJ', '2025-01-08 08:04:16', '2025-01-08 08:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `wishlist_customer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`avatar_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_avatars`
--
ALTER TABLE `customer_avatars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_avatars_customer_id_foreign` (`customer_id`),
  ADD KEY `customer_avatars_avatar_id_foreign` (`avatar_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friends_customer_id_foreign` (`customer_id`),
  ADD KEY `friends_friend_id_foreign` (`friend_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_customer_id_foreign` (`customer_id`),
  ADD KEY `notifications_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_customer_id_foreign` (`customer_id`),
  ADD KEY `wishlists_wishlist_customer_id_foreign` (`wishlist_customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avatars`
--
ALTER TABLE `avatars`
  MODIFY `avatar_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_avatars`
--
ALTER TABLE `customer_avatars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_avatars`
--
ALTER TABLE `customer_avatars`
  ADD CONSTRAINT `customer_avatars_avatar_id_foreign` FOREIGN KEY (`avatar_id`) REFERENCES `avatars` (`avatar_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_avatars_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `friends_friend_id_foreign` FOREIGN KEY (`friend_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_wishlist_customer_id_foreign` FOREIGN KEY (`wishlist_customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
