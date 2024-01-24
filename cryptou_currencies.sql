-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2024 at 06:46 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cryptou_currencies`
--

--
-- Dumping data for table `crypto_currencies`
--

INSERT INTO `crypto_currencies` (`cyt_id`, `cyt_name`, `created_at`, `updated_at`) VALUES
(1, 'BTC', '2024-01-23 22:25:33', '2024-01-23 22:25:33'),
(2, 'ETH', '2024-01-23 22:25:37', '2024-01-23 22:25:37'),
(3, 'USDT', '2024-01-23 22:25:44', '2024-01-23 22:25:44'),
(4, 'BNB', '2024-01-23 22:25:48', '2024-01-23 22:25:48'),
(5, 'SOL', '2024-01-23 22:25:54', '2024-01-23 22:25:54'),
(6, 'XRP', '2024-01-23 22:25:58', '2024-01-23 22:25:58'),
(7, 'USDC', '2024-01-23 22:26:03', '2024-01-23 22:26:03'),
(8, 'ADA', '2024-01-23 22:26:08', '2024-01-23 22:26:08'),
(9, 'DOGE', '2024-01-23 22:26:12', '2024-01-23 22:26:12'),
(10, 'AVAX', '2024-01-23 22:26:16', '2024-01-23 22:26:16'),
(11, 'TRX', '2024-01-23 22:26:22', '2024-01-23 22:26:22'),
(12, 'LINK', '2024-01-23 22:26:25', '2024-01-23 22:26:25'),
(13, 'DAI', '2024-01-23 22:26:33', '2024-01-23 22:26:33'),
(14, 'SHIB', '2024-01-23 22:26:37', '2024-01-23 22:26:37'),
(15, 'LTC', '2024-01-23 22:26:41', '2024-01-23 22:26:41'),
(16, 'ATOM', '2024-01-23 22:26:47', '2024-01-23 22:26:47'),
(17, 'XMR', '2024-01-23 22:26:53', '2024-01-23 22:26:53'),
(18, 'NEAR', '2024-01-23 22:26:58', '2024-01-23 22:26:58'),
(19, 'HBAR', '2024-01-23 22:27:03', '2024-01-23 22:27:03'),
(20, 'TUSD', '2024-01-23 22:27:08', '2024-01-23 22:27:08');

--
-- Dumping data for table `exchange`
--

INSERT INTO `exchange` (`exchange_id`, `buyer_user_id`, `seller_user_id`, `fiat_id`, `cyt_id`, `cyt_amount`, `fiat_amount`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5, 3, 0.00, 0.00, 'Buy', '2024-01-23 22:35:40', '2024-01-23 22:35:40'),
(2, 1, 1, 5, 3, 0.00, 0.00, 'Sell', '2024-01-23 22:35:51', '2024-01-23 22:35:51');

--
-- Dumping data for table `fiat_currencies`
--

INSERT INTO `fiat_currencies` (`fial_id`, `fial_name`, `created_at`, `updated_at`) VALUES
(1, 'THB', '2024-01-23 22:21:10', '2024-01-23 22:21:10'),
(2, 'AUD', '2024-01-23 22:21:43', '2024-01-23 22:21:43'),
(3, 'CAD', '2024-01-23 22:22:54', '2024-01-23 22:22:54'),
(4, 'USD', '2024-01-23 22:22:59', '2024-01-23 22:22:59'),
(5, 'JPY', '2024-01-23 22:23:07', '2024-01-23 22:23:07'),
(6, 'CHF', '2024-01-23 22:23:14', '2024-01-23 22:23:14'),
(7, 'BGN', '2024-01-23 22:23:21', '2024-01-23 22:23:21'),
(8, 'KRW', '2024-01-23 22:23:26', '2024-01-23 22:23:26'),
(9, 'NZD', '2024-01-23 22:23:37', '2024-01-23 22:23:37'),
(10, 'GBP', '2024-01-23 22:23:55', '2024-01-23 22:23:55'),
(11, 'PHP', '2024-01-23 22:24:04', '2024-01-23 22:24:04');

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `user_id`, `cyt_id`, `cyt_amount`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0.00, 'buy', '2024-01-23 22:34:38', '2024-01-23 22:34:38'),
(2, 1, 2, 0.00, 'buy', '2024-01-23 22:34:47', '2024-01-23 22:34:47'),
(3, 1, 3, 0.00, 'Sell', '2024-01-23 22:34:58', '2024-01-23 22:34:58');

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `created_at`, `updated_at`) VALUES
(2, '๊User', '2024-01-23 22:27:34', '2024-01-23 22:27:34'),
(3, 'Seller', '2024-01-23 22:27:57', '2024-01-23 22:27:57'),
(4, 'Admin', '2024-01-23 22:28:21', '2024-01-23 22:28:21');

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `exchange_id`, `user_id`, `wallet_id`, `fiat_id`, `cyt_id`, `cyt_amount`, `fiat_amount`, `type`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 2, 5, 3, 0.00, 0.00, 'Sell', '2024-01-23 22:38:21', '2024-01-23 22:38:21');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `name`, `phone`, `role_id`, `email`, `email_verified_at`, `is_admin`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'benz', 'kinjis', '0805715310', 1, 'benz@gmail.com', NULL, NULL, '$2y$10$yWsBXpepICWYd3fPdwez1urSfL2r6XWg3lg/59ADBt7Dp3tGxrK5W', NULL, '2024-01-23 22:16:25', '2024-01-23 22:16:25'),
(2, 'Admin', 'Admin', '0805715310', 1, 'admin@gmail.com', NULL, 1, '$2y$10$dDGlCVvnlkMUvOZQkUR1yu67T6TaX1etVjxo7DcS9j47G2KjYPYHS', NULL, '2024-01-23 22:18:37', '2024-01-23 22:18:37');

--
-- Dumping data for table `user_wallet`
--

INSERT INTO `user_wallet` (`wallet_id`, `user_id`, `cyt_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0.00, '2024-01-23 22:33:05', '2024-01-23 22:33:05'),
(2, 1, 2, 0.00, '2024-01-23 22:33:56', '2024-01-23 22:33:56'),
(3, 1, 3, 0.00, '2024-01-23 22:34:00', '2024-01-23 22:34:00'),
(4, 1, 4, 0.00, '2024-01-23 22:34:03', '2024-01-23 22:34:03'),
(5, 1, 5, 0.00, '2024-01-23 22:34:06', '2024-01-23 22:34:06'),
(6, 1, 6, 0.00, '2024-01-23 22:34:18', '2024-01-23 22:34:18');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
