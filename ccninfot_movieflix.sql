-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 22, 2023 at 06:49 PM
-- Server version: 8.0.32
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ccninfot_movieflix`
--

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` bigint UNSIGNED NOT NULL,
  `artist_type_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artist_types`
--

CREATE TABLE `artist_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `banner_type` enum('image','video','categoryImage','categoryVideo') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Movie', '1664607499.t2article2.jpg', 'active', NULL, NULL, '2022-10-01 00:58:19', '2022-10-01 00:58:19'),
(3, 'Drama', '1664772710.drama.jpg', 'active', NULL, NULL, '2022-10-02 22:51:50', '2022-10-02 22:51:50'),
(10, 'Action', NULL, 'active', NULL, NULL, '2022-12-12 03:11:16', '2022-12-12 05:16:45'),
(12, 'Horror', NULL, 'active', NULL, NULL, '2023-01-14 01:59:27', '2023-01-14 01:59:27'),
(13, 'Series', NULL, 'active', NULL, NULL, '2023-01-14 03:10:43', '2023-01-14 03:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `celebrities`
--

CREATE TABLE `celebrities` (
  `id` bigint UNSIGNED NOT NULL,
  `celebrity_type_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `celebrities`
--

INSERT INTO `celebrities` (`id`, `celebrity_type_id`, `name`, `file_type`, `file_link`, `image`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 2, 'Robert Pattinson', NULL, NULL, '1666186639.74-Robert-Pattinson.jpg.webp', 'active', NULL, NULL, '2022-10-19 07:37:19', '2022-10-19 07:37:19'),
(3, 2, 'Jeffrey Wright', NULL, NULL, '1666186935.Jeffrey-Wright-25-Things-You-Dont-Know-About-Me.jpg', 'active', NULL, NULL, '2022-10-19 07:42:15', '2022-10-19 07:42:15'),
(4, 2, 'Zoë Kravitz', NULL, NULL, '1666187017.2880.webp', 'active', NULL, NULL, '2022-10-19 07:43:37', '2022-10-19 07:43:37'),
(5, 2, 'Tom Cruise', NULL, NULL, '1666764977.tom-cruise-joins-techshohor-1200x900.png', 'active', NULL, NULL, '2022-10-26 00:16:17', '2022-10-26 00:16:17'),
(6, 2, 'Miles Teller', NULL, NULL, '1666765025.Miles-Teller.png', 'active', NULL, NULL, '2022-10-26 00:17:05', '2022-10-26 00:17:05'),
(7, 2, 'Jennifer Connelly', NULL, NULL, '1666765142.Jennifer-Connelly-Top-Gun.png', 'active', NULL, NULL, '2022-10-26 00:19:03', '2022-10-26 00:19:03'),
(8, 2, 'Ke Huy Quan', NULL, NULL, '1666767769.KeHuyQuan.png', 'active', NULL, NULL, '2022-10-26 01:02:49', '2022-10-26 01:02:49'),
(9, 2, 'Stephanie Hsu', NULL, NULL, '1666767824.00964B5F-190F-4BAA-9717-7EAF0A8FFFA1.png', 'active', NULL, NULL, '2022-10-26 01:03:44', '2022-10-26 01:03:44'),
(10, 2, 'Alexander Skarsgård', NULL, NULL, '1666768594.6732.png', 'active', NULL, NULL, '2022-10-26 01:16:34', '2022-10-26 01:16:34'),
(11, 2, 'Anya Taylor-Joy', NULL, NULL, '1666768632.anya-taylor-joy-viktor-rolf.png', 'active', NULL, NULL, '2022-10-26 01:17:12', '2022-10-26 01:17:12'),
(12, 2, 'Domee Shi', NULL, NULL, '1666769166.rexfeatures_9665775ag-e1554937311632.png', 'active', NULL, NULL, '2022-10-26 01:26:06', '2022-10-26 01:26:06'),
(13, 2, 'Abir', 'link', 'https://www.cricbuzz.com/a/img/v1/980x654/i1/c247795/no-bowler-has-taken-as-many-t2.jpg', '', 'active', NULL, NULL, '2022-11-08 06:26:04', '2022-11-08 06:26:04'),
(14, 2, 'Chris Hemsworth', 'file', NULL, '1669011807.Chris_Hemsworth_by_Gage_Skidmore_2_(cropped).jpg', 'active', NULL, NULL, '2022-11-16 04:46:50', '2022-11-21 00:53:27'),
(15, 2, 'Christian Bale', 'file', NULL, '1669011829.Christian_Bale_2009.jpg', 'active', NULL, NULL, '2022-11-16 04:47:55', '2022-11-21 00:53:49'),
(16, 2, 'Natalie Portman', 'file', NULL, '1669011916.Natalie_Portman_&_Chris_Hemsworth_(48470999262)_(cropped).jpg', 'active', NULL, NULL, '2022-11-16 04:49:24', '2022-11-21 00:55:16'),
(21, 2, '​Joseph Vijay', 'file', NULL, '1669011999.iGveyp8DuSr3YHK7m6faOXTKrjN.jpg', 'active', NULL, NULL, '2022-11-16 05:29:12', '2022-11-21 00:56:39'),
(22, 2, 'Pooja Hegde', 'file', NULL, '1669012021.pooja_hegde_on_salman_khan_bhaijaan_main.jpg', 'active', NULL, NULL, '2022-11-16 05:30:36', '2022-11-21 00:57:01'),
(23, 2, 'Redin Kingsley', 'file', NULL, '1669012048.JX9ukTnXCNBlsbQeHGY85qf3du.jpg', 'active', NULL, NULL, '2022-11-16 05:31:26', '2022-11-21 00:57:28'),
(24, 2, 'Mary Elizabeth Winstead', 'file', NULL, '1669012078.164153_v9_bb.jpg', 'active', NULL, NULL, '2022-11-16 06:22:52', '2022-11-21 00:57:58'),
(25, 2, 'Miku Martineau', 'file', NULL, '1669012105.gYfvC5PCBPAEzf6oxCaL3eCMQtH.jpg', 'active', NULL, NULL, '2022-11-16 06:23:07', '2022-11-21 00:58:25'),
(26, 2, 'Woody Harrelson', 'file', NULL, '1669012126.igxYDQBbTEdAqaJxaW6ffqswmUU.jpg', 'active', NULL, NULL, '2022-11-16 06:23:37', '2022-11-21 00:58:46'),
(27, 2, 'Tom Hardy', 'file', NULL, '1669012158.sGMA6pA2D6X0gun49igJT3piHs3.jpg', 'active', NULL, NULL, '2022-11-16 06:35:19', '2022-11-21 00:59:18'),
(28, 2, 'Michelle Williams', 'file', NULL, '1669012187.jn3BVMVbIptz2gc6Fhxo1qwJVvW.jpg', 'active', NULL, NULL, '2022-11-16 06:35:44', '2022-11-21 00:59:47'),
(29, 2, 'Randeep Hooda', 'file', NULL, '1669012209.fF6G3MlCfq6pH1YkHrFVDhe9Uvw.jpg', 'active', NULL, NULL, '2022-11-16 06:59:08', '2022-11-21 01:00:09'),
(30, 2, 'Rudhraksh Jaiswal', 'file', NULL, '1669012236.nIiqv0pbRwKeG7Ar42UrLgEBuYW.jpg', 'active', NULL, NULL, '2022-11-16 06:59:25', '2022-11-21 01:00:36'),
(31, 2, 'Millie Bobby Brown', 'file', NULL, '1669012256.2685xGmq68G6tmnUbfgSR6rywEV.jpg', 'active', NULL, NULL, '2022-11-19 01:04:38', '2022-11-21 01:00:56'),
(32, 2, 'Winona Ryder', 'file', NULL, '1669012275.rymbG27dRdRldtjZz3JfNpUT7A1.jpg', 'active', NULL, NULL, '2022-11-19 01:05:12', '2022-11-21 01:01:15'),
(33, 2, 'Finn Wolfhard', 'file', NULL, '1669012294.5OVmquAk0W5BIsRlVKslEP497JD.jpg', 'active', NULL, NULL, '2022-11-19 01:05:55', '2022-11-21 01:01:34'),
(34, 2, 'Bryan Cranston', 'file', NULL, '1669012324.7Jahy5LZX2Fo8fGJltMreAI49hC.jpg', 'active', NULL, NULL, '2022-11-20 03:41:40', '2022-11-21 01:02:04'),
(35, 2, 'Aaron Paul', 'file', NULL, '1669012357.lowE44ffgu4UmnOT3wOTKYhtUzp.jpg', 'active', NULL, NULL, '2022-11-20 03:41:58', '2022-11-21 01:02:37'),
(36, 2, 'Anna Gunn', 'file', NULL, '1669012382.adppyeu1a4REN3khtgmXusrapFi.jpg', 'active', NULL, NULL, '2022-11-20 03:42:14', '2022-11-21 01:03:02'),
(37, 2, 'Joaquin Phoenix', 'file', NULL, '1669012409.joaquin-phoenix-medium.jpg', 'active', NULL, NULL, '2022-11-20 04:43:07', '2022-11-21 01:03:29'),
(38, 2, 'Robert De Niro', 'file', NULL, '1669012429.cT8htcckIuyI1Lqwt1CvD02ynTh.jpg', 'active', NULL, NULL, '2022-11-20 04:44:10', '2022-11-21 01:03:49'),
(39, 2, 'Zazie Beetz', 'file', NULL, '1669012452.ijrT4pvALvxU0gphea4YxDnDh6e.jpg', 'active', NULL, NULL, '2022-11-20 04:45:30', '2022-11-21 01:04:12'),
(40, 2, 'Rosa Salazar', 'file', NULL, '1669012489.fddad0902d2dda3e.jpg', 'active', NULL, NULL, '2022-11-20 05:03:12', '2022-11-21 01:04:49'),
(41, 2, 'Keean Johnson', 'file', NULL, '1669012714.42e3a911d19ffd94.jpg', 'active', NULL, NULL, '2022-11-20 05:04:20', '2022-11-21 01:08:34'),
(42, 2, 'Michele Morrone', 'file', NULL, '1669012535.90IF4aQKrr7zXmtcsNAYbrvcIg2.jpg', 'active', NULL, NULL, '2022-11-20 05:21:51', '2022-11-21 01:05:35'),
(43, 2, 'Anna-Maria Sieklucka', 'file', NULL, '1669012555.eoimM6DQ5ngqSAYaXHrIADHU52C.jpg', 'active', NULL, NULL, '2022-11-20 05:22:10', '2022-11-21 01:05:55'),
(44, 2, 'Bronisław Wrocławski', 'file', NULL, '1669012573.zsN1MZUP4GdE3mHwSNNvY5qunZD.jpg', 'active', NULL, NULL, '2022-11-20 05:22:27', '2022-11-21 01:06:13'),
(45, 2, 'Michael Peña', 'file', NULL, '1669012614.tu5CtDtVP4oZBVQgi0s4vgZErIg.jpg', 'active', NULL, NULL, '2022-11-20 05:38:36', '2022-11-21 01:06:54'),
(46, 2, 'Lizzy Caplan', 'file', NULL, '1669012640.xOLXlzpSJExsBlKroCyCNGhzQEU.jpg', 'active', NULL, NULL, '2022-11-20 05:38:54', '2022-11-21 01:07:20'),
(47, 2, 'Israel Broussard', 'file', NULL, '1669012667.cSmPXUMjUgodorabkAHJ4IMWFz7.jpg', 'active', NULL, NULL, '2022-11-20 05:39:14', '2022-11-21 01:07:47'),
(48, 2, 'Ryan Reynolds', 'file', NULL, '1668945232.4SYTH5FdB0dAORV98Nwg3llgVnY.jpg', 'active', NULL, NULL, '2022-11-20 06:23:52', '2022-11-20 06:23:52'),
(49, 2, 'Morena Baccarin', 'file', NULL, '1668945249.kIL3zOqiC0xSXuCED6tB3KJWnSh.jpg', 'active', NULL, NULL, '2022-11-20 06:24:09', '2022-11-20 06:24:09'),
(50, 2, 'Ed Skrein', 'file', NULL, '1668945268.AaMTvZkroI8uo5JXQiJ5pSLEgSJ.jpg', 'active', NULL, NULL, '2022-11-20 06:24:28', '2022-11-20 06:24:28'),
(51, 2, 'Will Smith', 'file', NULL, '1669011471.rqqhzESgnlxREv7Q8ZtjqBZtSry.jpg', 'active', NULL, NULL, '2022-11-21 00:47:51', '2022-11-21 00:47:51'),
(52, 2, 'Martin Lawrence', 'file', NULL, '1669011498.15Ck85zfgWkmSMfNYLkE9JLTP7s.jpg', 'active', NULL, NULL, '2022-11-21 00:48:18', '2022-11-21 00:48:18'),
(53, 2, 'Paola Nunez', 'file', NULL, '1669011530.5k8tBBvoV43iK6u0k2YUSVXPmuK.jpg', 'active', NULL, NULL, '2022-11-21 00:48:50', '2022-11-21 00:48:50'),
(54, 2, 'Ryan Gosling', 'file', NULL, '1669109119.lyUyVARQKhGxaxy0FbPJCQRpiaW.jpg', 'active', NULL, NULL, '2022-11-22 03:55:19', '2022-11-22 03:55:19'),
(55, 2, 'Chris Evans', 'file', NULL, '1669109135.3bOGNsHlrswhyW79uvIHH1V43JI.jpg', 'active', NULL, NULL, '2022-11-22 03:55:35', '2022-11-22 03:55:35'),
(56, 2, 'Ana de Armas', 'file', NULL, '1669109160.vkoSSVrGxFYvtr2uUdz99ENXF1v.jpg', 'active', NULL, NULL, '2022-11-22 03:56:00', '2022-11-22 03:56:00'),
(57, 2, 'Ranbir Kapoor', 'file', NULL, '1670831686.Ranbir_Kapoor.jpg', 'active', NULL, NULL, '2022-12-12 02:24:46', '2022-12-12 02:24:46'),
(58, 2, 'Sanjay Dutt', 'file', NULL, '1670831703.zhYAdzlDMbhWr8ZBVDK02nrwnOJ.jpg', 'active', NULL, NULL, '2022-12-12 02:25:03', '2022-12-12 02:25:03'),
(59, 2, 'Vaani Kapoor', 'file', NULL, '1670831719.Vaani_Kapoor_walked_the_ramp_at_the_Lakme_Fashion_Week_2018_(03)_(cropped).jpg', 'active', NULL, NULL, '2022-12-12 02:25:19', '2022-12-12 02:25:19'),
(60, 2, 'Ajay Devgn', 'file', NULL, '1670832579.vnHQQFzTjJ0sv14DGMIoKa3qTxN.jpg', 'active', NULL, NULL, '2022-12-12 02:39:39', '2022-12-12 02:39:39'),
(61, 2, 'Amitabh Bachchan', 'file', NULL, '1670832593.yAvq3EG5W5WaegZHB7gNdlM2KED.jpg', 'active', NULL, NULL, '2022-12-12 02:39:53', '2022-12-12 02:39:53'),
(62, 2, 'Rakul Preet Singh', 'file', NULL, '1670832622.4n4MmOFNyxKc4qMfzyapglvDDlF.jpg', 'active', NULL, NULL, '2022-12-12 02:40:22', '2022-12-12 02:40:22'),
(63, 2, 'Tom Holland', 'file', NULL, '1670833303.bBRlrpJm9XkNSg0YT5LCaxqoFMX.jpg', 'active', NULL, NULL, '2022-12-12 02:51:43', '2022-12-12 02:51:43'),
(64, 2, 'Mark Wahlberg', 'file', NULL, '1670833322.bTEFpaWd7A6AZVWOqKKBWzKEUe8.jpg', 'active', NULL, NULL, '2022-12-12 02:52:02', '2022-12-12 02:52:02'),
(65, 2, 'Sophia Ali', 'file', NULL, '1670833337.uqXn3Gp0FlsV5kDLwJ6FbeuJvx2.jpg', 'active', NULL, NULL, '2022-12-12 02:52:17', '2022-12-12 02:52:17'),
(66, 2, 'Saif Ali Khan', 'file', NULL, '1670833967.MV5BMTUyNjI2NTg3M15BMl5BanBnXkFtZTcwNDEzNDg3OA@@._V1_.jpg', 'active', NULL, NULL, '2022-12-12 03:02:47', '2022-12-12 03:02:47'),
(67, 2, 'Siddhant Chaturvedi', 'file', NULL, '1670833982.2MTk5cqZUZEi35ksPbs6lr5I7wA.jpg', 'active', NULL, NULL, '2022-12-12 03:03:02', '2022-12-12 03:03:02'),
(68, 2, 'Rani Mukerji', 'file', NULL, '1670833996.6bm1lhrEgGFpOLBjvcOi3aoQmtg.jpg', 'active', NULL, NULL, '2022-12-12 03:03:16', '2022-12-12 03:03:16'),
(69, 2, 'Kevin Hart', 'file', NULL, '1670842662.7OwsFfoxNGIfWwSmdORyB7v8XNj.jpg', 'active', NULL, NULL, '2022-12-12 05:27:42', '2022-12-12 05:27:42'),
(70, 2, 'Kaley Cuoco', 'file', NULL, '1670842817.c01Ma8Jrr2OJ6uoikPwDK34Y8eK.jpg', 'active', NULL, NULL, '2022-12-12 05:30:17', '2022-12-12 05:30:17'),
(71, 2, 'Chris Pratt', 'file', NULL, '1670844200.83o3koL82jt30EJ0rz4Bnzrt2dd.jpg', 'active', NULL, NULL, '2022-12-12 05:53:20', '2022-12-12 05:53:20'),
(72, 2, 'Yvonne Strahovski', 'file', NULL, '1670844218.2IQEjn5T8urx6ikXM87QGs5MrWg.jpg', 'active', NULL, NULL, '2022-12-12 05:53:38', '2022-12-12 05:53:38'),
(73, 2, 'J.K. Simmons', 'file', NULL, '1670844234.jPoNW5fugs5h8AbcE7H5OBm04Tm.jpg', 'active', NULL, NULL, '2022-12-12 05:53:54', '2022-12-12 05:53:54'),
(74, 2, 'Brad Pitt', 'file', NULL, '1673681865.oTB9vGIBacH5aQNS0pUM74QSWuf.jpg', 'active', NULL, NULL, '2023-01-14 02:07:45', '2023-01-14 02:07:45'),
(75, 2, 'Joey King', 'file', NULL, '1673683411.b0diEOPPAxOOInWOP9koaqvqUvi.jpg', 'active', NULL, NULL, '2023-01-14 02:33:31', '2023-01-14 02:33:31'),
(76, 2, 'Aaron Taylor-Johnson', 'file', NULL, '1673683430.vkph4FcqFrOnVbrIQD7MbJXz4Uf.jpg', 'active', NULL, NULL, '2023-01-14 02:33:50', '2023-01-14 02:33:50'),
(77, 2, 'Emily Carey', 'file', NULL, '1673684213.961412_v9_bb.jpg', 'active', NULL, NULL, '2023-01-14 02:46:53', '2023-01-14 02:46:53'),
(78, 2, 'Matt Smith', 'file', NULL, '1673684233.matt-smith-2018-nom-450x600.jpg', 'active', NULL, NULL, '2023-01-14 02:47:13', '2023-01-14 02:47:13'),
(79, 2, 'Olivia Cooke', 'file', NULL, '1673684255.ipanews_4786b6df-41c9-4f15-87ce-6e8c1121ce47_1.jpg', 'active', NULL, NULL, '2023-01-14 02:47:35', '2023-01-14 02:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `celebrity_types`
--

CREATE TABLE `celebrity_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `celebrity_types`
--

INSERT INTO `celebrity_types` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Actor', 'active', NULL, NULL, '2022-10-01 00:59:56', '2022-10-01 00:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `video_id` int DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `video_id`, `comment`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 4, 'testt', 'active', 10, 10, '2022-11-20 07:43:43', '2022-11-20 07:43:43'),
(3, 13, 'Tina', 'active', 33, 33, '2022-12-15 18:21:45', '2022-12-15 18:21:45'),
(4, 18, 'test', 'active', 36, 36, '2022-12-26 01:06:42', '2022-12-26 01:06:42'),
(5, 27, 'yt', 'active', 38, 38, '2022-12-28 10:19:07', '2023-01-18 15:07:04'),
(6, 35, 'hlw', 'active', 1, 1, '2022-12-31 07:37:24', '2023-01-18 15:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `file_type`, `file_link`, `image`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'United States', 'link', 'https://upload.wikimedia.org/wikipedia/en/thumb/a/a4/Flag_of_the_United_States.svg/1920px-Flag_of_the_United_States.svg.png', '1666765266.Flag_of_the_United_States.svg', 'active', NULL, NULL, '2022-10-26 00:21:06', '2022-11-16 06:09:11'),
(5, 'India', 'file', NULL, '1669444697.Flag_of_India.svg.png', 'active', NULL, NULL, '2022-11-16 05:37:54', '2022-11-26 01:08:17');

-- --------------------------------------------------------

--
-- Table structure for table `episods`
--

CREATE TABLE `episods` (
  `id` bigint UNSIGNED NOT NULL,
  `series_id` int DEFAULT NULL,
  `season_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `episods`
--

INSERT INTO `episods` (`id`, `series_id`, `season_id`, `name`, `number`, `image`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 3, 3, 'Chapter One: The Vanishing of Will Byers', '01', NULL, 'active', 1, 1, '2022-11-19 00:54:37', '2022-11-19 00:54:37'),
(4, 3, 3, 'Chapter Two: The Weirdo on Maple Street', '02', NULL, 'active', 1, 1, '2022-11-19 00:55:15', '2022-11-19 00:55:15'),
(5, 3, 3, 'Chapter Three: Holly, Jolly', '03', NULL, 'active', 1, 1, '2022-11-19 00:55:43', '2022-11-19 00:55:43'),
(6, 3, 3, 'Chapter Four: The Body', '04', NULL, 'active', 1, 1, '2022-11-19 00:56:12', '2022-11-19 00:56:12'),
(7, 3, 4, 'S02 E01 · Chapter One: Madmax', '01', NULL, 'active', 1, 1, '2022-11-19 04:38:56', '2022-11-19 04:38:56'),
(8, 1, 2, 'Pilot', '01', NULL, 'active', 1, 1, '2022-11-20 03:43:04', '2022-11-20 03:43:04'),
(9, 1, 2, 'Cat\'s in the Bag...', '02', NULL, 'active', 1, 1, '2022-11-20 03:43:36', '2022-11-20 03:43:36'),
(10, 1, 2, '...And the Bag\'s in the River', '03', NULL, 'active', 1, 1, '2022-11-20 03:44:02', '2022-11-20 03:44:02'),
(11, 14, 5, 'Paris', 'EP1', NULL, 'active', 2, 2, '2022-12-07 06:04:29', '2022-12-07 06:04:29'),
(12, 15, 6, 'The Heirs of the Dragon', '01', NULL, 'active', 1, 1, '2023-01-14 03:03:54', '2023-01-14 03:03:54'),
(13, 15, 6, 'The Rogue Prince', '02', NULL, 'active', 1, 1, '2023-01-14 03:04:18', '2023-01-14 03:04:18'),
(14, 15, 6, 'Second of His Name', '03', NULL, 'active', 1, 1, '2023-01-14 03:05:34', '2023-01-14 03:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorite_videos`
--

CREATE TABLE `favorite_videos` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `video_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorite_videos`
--

INSERT INTO `favorite_videos` (`id`, `user_id`, `video_id`, `created_at`, `updated_at`) VALUES
(4, 1, 6, '2022-10-22 02:10:22', '2022-10-22 02:10:22'),
(7, 2, 20, '2022-11-24 11:09:41', '2022-11-24 11:09:41'),
(8, 22, 6, '2022-12-02 11:58:45', '2022-12-02 11:58:45'),
(9, 23, 3, '2022-12-03 12:34:13', '2022-12-03 12:34:13'),
(10, 2, 8, '2022-12-10 12:25:17', '2022-12-10 12:25:17'),
(11, 2, 5, '2022-12-10 12:25:23', '2022-12-10 12:25:23'),
(12, 29, 3, '2022-12-12 07:52:34', '2022-12-12 07:52:34'),
(14, 29, 27, '2022-12-12 07:53:03', '2022-12-12 07:53:03'),
(15, 29, 26, '2022-12-12 07:53:07', '2022-12-12 07:53:07'),
(16, 29, 36, '2022-12-12 07:53:15', '2022-12-12 07:53:15'),
(17, 29, 33, '2022-12-12 07:56:42', '2022-12-12 07:56:42'),
(18, 29, 35, '2022-12-12 07:56:46', '2022-12-12 07:56:46'),
(19, 10, 4, '2022-12-12 07:57:26', '2022-12-12 07:57:26'),
(20, 10, 37, '2022-12-12 07:57:36', '2022-12-12 07:57:36'),
(22, 33, 27, '2022-12-15 18:21:02', '2022-12-15 18:21:02'),
(23, 30, 22, '2022-12-16 15:03:36', '2022-12-16 15:03:36'),
(24, 1, 18, '2022-12-31 07:46:18', '2022-12-31 07:46:18');

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password_codes`
--

CREATE TABLE `forgot_password_codes` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_code` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forgot_password_codes`
--

INSERT INTO `forgot_password_codes` (`id`, `email`, `verification_code`, `created_at`, `updated_at`) VALUES
(1, 'davidbryansp6@gmail.com', 265634, '2022-11-15 09:43:57', '2022-11-15 09:43:57');

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password_requests`
--

CREATE TABLE `forgot_password_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forgot_password_requests`
--

INSERT INTO `forgot_password_requests` (`id`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'davidbryansp6@gmail.com', 'request', '2022-11-15 09:43:57', '2022-11-15 09:43:57');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`, `image`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Thriller', NULL, 'active', NULL, NULL, '2022-10-03 03:14:25', '2022-10-03 03:14:25'),
(3, 'Action', NULL, 'active', NULL, NULL, '2022-10-26 00:50:51', '2022-10-26 00:50:51'),
(4, 'Drama', NULL, 'active', NULL, NULL, '2022-10-26 00:51:03', '2022-10-26 00:51:03'),
(5, 'Rommantic', NULL, 'active', NULL, NULL, '2022-10-26 00:51:12', '2022-10-26 00:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `imdb_keys`
--

CREATE TABLE `imdb_keys` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `imdb_keys`
--

INSERT INTO `imdb_keys` (`id`, `key`, `created_at`, `updated_at`) VALUES
(1, '4ac0d2ddf166646a2c1dec2733a29673', '2022-10-12 04:17:18', '2022-10-12 04:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `manage_notifications`
--

CREATE TABLE `manage_notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `notification_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `medially_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `medially_id` bigint UNSIGNED NOT NULL,
  `file_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mgt_statuses`
--

CREATE TABLE `mgt_statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgt_statuses`
--

INSERT INTO `mgt_statuses` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'genres', 'on', '2022-11-14 23:51:16', '2023-01-06 03:56:55'),
(2, 'celebrity', 'on', '2022-11-15 11:05:50', '2022-11-15 11:05:50'),
(3, 'tv-channel', 'on', '2022-11-23 18:15:14', '2023-01-14 04:30:09'),
(4, 'country', 'on', '2023-01-19 23:57:28', '2023-01-19 23:57:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2020_06_14_000001_create_media_table', 1),
(6, '2021_10_14_061032_create_artists_table', 1),
(7, '2021_10_14_073205_create_banners_table', 1),
(8, '2021_10_14_074002_create_categories_table', 1),
(9, '2021_10_14_074656_create_comments_table', 1),
(10, '2021_10_14_075035_create_countries_table', 1),
(11, '2021_10_14_075249_create_genres_table', 1),
(12, '2021_10_14_080617_create_reports_table', 1),
(13, '2021_10_14_080902_create_series_table', 1),
(14, '2021_10_14_081317_create_sponsors_table', 1),
(15, '2021_10_14_085935_create_sub_categories_table', 1),
(16, '2021_10_14_090249_create_supports_table', 1),
(17, '2021_10_14_091106_create_top_features_table', 1),
(18, '2021_10_14_091638_create_tv_channels_table', 1),
(19, '2021_10_14_092116_create_user_roles_table', 1),
(20, '2021_10_14_095326_create_videos_table', 1),
(21, '2021_10_17_045711_create_notifications_table', 1),
(22, '2021_10_17_063613_create_user_verifications_table', 1),
(23, '2021_10_17_081547_create_artist_types_table', 1),
(24, '2021_11_01_045807_create_celebrity_types_table', 1),
(25, '2021_11_01_064831_create_celebrities_table', 1),
(26, '2021_11_05_120645_create_settings_table', 1),
(27, '2021_11_06_071728_create_video_settings_table', 1),
(28, '2021_11_09_042251_create_mobile_ads_table', 1),
(29, '2021_11_09_125809_create_web_ads_table', 1),
(30, '2021_11_10_122927_create_manage_notifications_table', 1),
(31, '2021_11_16_125312_create_favorite_videos_table', 1),
(32, '2021_11_19_063708_create_video_views_table', 1),
(33, '2021_11_24_093435_create_serieses_table', 1),
(34, '2021_11_24_093710_create_seasons_table', 1),
(35, '2021_11_24_093811_create_episods_table', 1),
(36, '2021_12_02_045022_create_forgot_password_codes_table', 1),
(37, '2021_12_02_045149_create_forgot_password_requests_table', 1),
(38, '2021_12_03_065902_create_mgt_statuses_table', 1),
(39, '2021_12_03_113552_create_imdb_keys_table', 1),
(40, '2022_01_17_044837_create_smtp_settings_table', 1),
(41, '2022_02_07_062416_create_series_categories_table', 1),
(42, '2022_02_07_062619_create_tv_channel_categories_table', 1),
(43, '2022_05_25_055601_create_request_movies_table', 1),
(44, '2022_05_25_113644_create_subscribers_table', 1),
(45, '2022_06_15_043846_create_packages_table', 1),
(46, '2022_06_15_082417_create_payment_gatways_table', 1),
(47, '2022_06_18_063234_create_package_subscribers_table', 1),
(48, '2022_06_18_124413_create_transactions_table', 1),
(49, '2022_06_25_080301_alter_table_videos', 1),
(50, '2022_06_25_090225_alter_table_series', 1),
(51, '2022_06_25_090726_alter_table_mobile_ads', 1),
(52, '2022_06_25_102415_alter_table_settings', 1),
(53, '2022_07_18_043312_alter_table_users', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_ads`
--

CREATE TABLE `mobile_ads` (
  `id` bigint UNSIGNED NOT NULL,
  `ad_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_status` enum('on','off') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_status` enum('on','off') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interesticial_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interesticial_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interesticial_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interesticial_click` int DEFAULT NULL,
  `custom_status` enum('on','off') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `native_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `native_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `native_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `native_per_video_like` int DEFAULT NULL,
  `native_per_video_series` int DEFAULT NULL,
  `startup_status` enum('on','off') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `startup_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_lovin_max_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_open_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_open_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_open_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `next_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `next_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iron_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iron_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unity_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unity_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobile_ads`
--

INSERT INTO `mobile_ads` (`id`, `ad_type`, `google_status`, `banner_id`, `banner_link`, `banner_image`, `facebook_status`, `interesticial_id`, `interesticial_link`, `interesticial_image`, `interesticial_click`, `custom_status`, `native_id`, `native_link`, `native_image`, `native_per_video_like`, `native_per_video_series`, `startup_status`, `startup_id`, `app_lovin_max_status`, `app_open_id`, `app_open_link`, `app_open_image`, `next_id`, `next_status`, `iron_id`, `iron_status`, `unity_id`, `unity_status`, `created_at`, `updated_at`) VALUES
(1, 'google', 'on', 'ca-app-pub-3940256099942544/6300978111', NULL, NULL, 'off', 'ca-app-pub-3940256099942544/1033173712', NULL, NULL, 2, 'off', 'ca-app-pub-3940256099942544/2247696110', NULL, NULL, 1, 2, 'off', NULL, 'off', 'ca-app-pub-3940256099942544/3419835294', NULL, NULL, NULL, 'off', NULL, 'off', NULL, 'off', '2022-12-21 01:45:08', '2022-12-21 01:45:08'),
(2, 'facebook', 'off', 'IMG_16_9_APP_INSTALL', NULL, NULL, 'off', 'CAROUSEL_IMG_SQUARE_APP_INSTALL', NULL, NULL, 2, 'off', 'VID_HD_9_16_39S_APP_INSTALL', NULL, NULL, 2, 2, 'off', NULL, 'off', NULL, NULL, NULL, NULL, 'off', NULL, 'off', NULL, 'off', '2022-12-21 01:45:08', '2022-12-21 01:45:08'),
(3, 'custom', 'off', NULL, NULL, NULL, 'off', NULL, NULL, NULL, 0, 'off', NULL, NULL, NULL, 0, 0, 'off', NULL, 'off', NULL, NULL, '1667289746.song.jpg', NULL, 'off', NULL, 'off', NULL, 'off', '2022-12-21 01:45:08', '2022-12-21 01:45:08'),
(4, 'startup', 'off', NULL, NULL, NULL, 'off', NULL, NULL, NULL, 0, 'off', NULL, NULL, NULL, 0, 0, 'off', NULL, 'off', NULL, NULL, NULL, NULL, 'off', NULL, 'off', NULL, 'off', '2022-12-21 01:45:08', '2022-12-21 01:45:08'),
(5, 'unity', 'off', '111', NULL, NULL, 'off', '1111', NULL, NULL, 11111, 'off', NULL, NULL, NULL, 0, 0, 'off', NULL, 'off', NULL, NULL, NULL, NULL, 'off', NULL, 'off', NULL, 'off', '2022-12-21 01:45:08', '2022-12-21 01:45:08'),
(6, 'app_lovin_max', 'off', 'aaaa', NULL, NULL, 'off', 'aaa', NULL, NULL, 111, 'off', NULL, NULL, NULL, 0, 0, 'off', NULL, 'off', NULL, NULL, NULL, NULL, 'off', NULL, 'off', NULL, 'off', '2022-12-21 01:45:08', '2022-12-21 01:45:08'),
(7, 'iron', 'off', NULL, NULL, NULL, 'off', NULL, NULL, NULL, 0, 'off', NULL, NULL, NULL, 0, 0, 'off', NULL, 'off', NULL, NULL, NULL, NULL, 'off', NULL, 'off', NULL, 'off', '2022-12-21 01:45:08', '2022-12-21 01:45:08'),
(8, 'next', 'off', NULL, NULL, NULL, 'off', NULL, NULL, NULL, 0, 'off', NULL, NULL, NULL, 0, 0, 'off', NULL, 'off', NULL, NULL, NULL, NULL, 'off', NULL, 'off', NULL, 'off', '2022-12-21 01:45:08', '2022-12-21 01:45:08');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_id` int DEFAULT NULL,
  `tv_channel_id` int DEFAULT NULL,
  `external_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `validity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `description`, `validity`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Popular', 'he pack gives you unlimited voice calls, one year of Netflix, Amazon Prime, and Disney+ Hotstar subscriptions, Vi Movies and TV VIP subscription, 100 SMS per day,', '30', '10', 'active', '2022-10-08 00:27:10', '2022-10-15 07:20:24'),
(2, 'Regular', 'he pack gives you unlimited voice calls, one year of Netflix, Amazon Prime, and Disney+ Hotstar subscriptions, Vi Movies and TV VIP subscription, 100 SMS per day,', '7', '4', 'active', '2022-10-08 00:27:43', '2022-10-08 00:27:43'),
(3, 'Yearly Pack', 'he pack gives you unlimited voice calls, one year of Netflix, Amazon Prime, and Disney+ Hotstar subscriptions, Vi Movies and TV VIP subscription, 100 SMS per day,', '365', '50', 'active', '2022-10-15 07:26:44', '2022-10-15 07:26:44');

-- --------------------------------------------------------

--
-- Table structure for table `package_subscribers`
--

CREATE TABLE `package_subscribers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `period` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_subscribers`
--

INSERT INTO `package_subscribers` (`id`, `user_id`, `transaction_id`, `package_id`, `amount`, `period`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(4, '5', '8', '1', '10', '30', '2022-10-14 18:00:00', '2022-11-13 18:00:00', '2022-10-10 06:25:07', '2022-10-10 06:25:07'),
(17, '2', '21', '2', '4', '7', '2022-12-31 03:43:19', '2023-01-07 03:43:19', '2022-12-31 03:43:19', '2022-12-31 03:43:19'),
(18, '2', '22', '3', '50', '365', '2023-01-14 23:02:50', '2024-01-14 23:02:50', '2023-01-14 23:02:50', '2023-01-14 23:02:50'),
(19, '2', '23', '2', '4', '7', '2023-01-18 18:55:19', '2023-01-25 18:55:19', '2023-01-18 18:55:19', '2023-01-18 18:55:19');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gatways`
--

CREATE TABLE `payment_gatways` (
  `id` bigint UNSIGNED NOT NULL,
  `paypal_client_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_secret` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_publishable_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_secret_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gatways`
--

INSERT INTO `payment_gatways` (`id`, `paypal_client_id`, `paypal_secret`, `stripe_publishable_key`, `stripe_secret_key`, `created_at`, `updated_at`) VALUES
(1, 'AVnnUHTuHTNYygz7KRccDRqQqNeJ8j-GxGZ4FNjwXxkRfscxZ_izwq5qSCjgVjgp7SrZTpasuku9DHMW', 'EOUW_eCVUQehX8tGG-0Q6Xz6tEYElyvbaOSg_g9iAmF9YE3qm-FTvMdGdWwDg-GmFtwC6_dD0gRvZqWg', 'sk_test_51LBZSsKUsyg2bTQ9qHqXd79q6wC0PdmKI6SmJ7sSBysjsSYHcigrZ82z1d8keYu39QCQhf8QRaqHTg2XbK6zgQJZ00G2ovhAz4', NULL, '2022-10-08 00:34:11', '2022-10-08 00:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 8, 'authToken', '396bf6f224c75f1ef5bf998471a82a52b7c0073b56a03107a7826ff634919593', '[\"*\"]', '2022-11-18 16:12:23', '2022-11-16 04:40:43', '2022-11-18 16:12:23'),
(2, 'App\\Models\\User', 2, 'authToken', 'd0c512797952004fd1f190126f6114243e707b7987595ab7aa9407ded2ca433c', '[\"*\"]', '2022-11-16 19:05:43', '2022-11-16 19:04:21', '2022-11-16 19:05:43'),
(3, 'App\\Models\\User', 2, 'authToken', '86c7c00f4c9ec2d15e04bcaa296f5e8bc339fd90a2e50f202142e0227c3d29cd', '[\"*\"]', NULL, '2022-11-18 04:21:07', '2022-11-18 04:21:07'),
(4, 'App\\Models\\User', 2, 'authToken', '25c3d3aea210049c88ff21b3330a4ddcb7a064467ae0d9a01ce6dbe334c7dac5', '[\"*\"]', NULL, '2022-11-18 04:21:08', '2022-11-18 04:21:08'),
(5, 'App\\Models\\User', 2, 'authToken', '943524c138e6ec89e91e5818c38f4a1645f1e3771e7da144e101dfbe056b446d', '[\"*\"]', NULL, '2022-11-18 04:21:08', '2022-11-18 04:21:08'),
(6, 'App\\Models\\User', 10, 'authToken', '892f9b80c0b1c999ec4d5d5fc562162c22356bb109cc0680c7aa2587cc7cad67', '[\"*\"]', '2022-11-20 08:02:04', '2022-11-20 07:38:58', '2022-11-20 08:02:04'),
(7, 'App\\Models\\User', 1, 'authToken', '87b1b922c37b636afd786ab336b9ff06fcd08112befa59d816b48954cd4b7c0d', '[\"*\"]', NULL, '2022-11-20 14:57:54', '2022-11-20 14:57:54'),
(8, 'App\\Models\\User', 11, 'authToken', '393165a0ffc41e5222a4cffda8c4af8c330987fa2a3b893b03539449035258f2', '[\"*\"]', '2022-11-23 11:13:00', '2022-11-23 11:11:05', '2022-11-23 11:13:00'),
(9, 'App\\Models\\User', 12, 'authToken', 'e63d747c511f19b1621d06ca32c4c80f146472ff5e0afe4099847838e9b6332b', '[\"*\"]', '2022-11-23 14:46:23', '2022-11-23 14:46:08', '2022-11-23 14:46:23'),
(10, 'App\\Models\\User', 13, 'authToken', 'e5a35a47c5bd8db9df157ff3d63e55e729012bf00f0384548eb307ccb32fa733', '[\"*\"]', '2022-11-25 06:45:14', '2022-11-25 06:44:33', '2022-11-25 06:45:14'),
(11, 'App\\Models\\User', 16, 'authToken', '18fa2d40d840629371efe1238916d1bf82e4946291b44040a6c1178e525dbfa4', '[\"*\"]', '2022-11-26 06:14:35', '2022-11-26 06:14:25', '2022-11-26 06:14:35'),
(12, 'App\\Models\\User', 17, 'authToken', 'c0fbcb6be18e471225a2b6e76b7d54e673acd4b210ee71ce990069826f6010bb', '[\"*\"]', '2022-12-11 15:16:53', '2022-11-26 11:23:00', '2022-12-11 15:16:53'),
(13, 'App\\Models\\User', 18, 'authToken', '37c8a9851aac70962f8287c827b8d30d923b28c44a5ab578f87fdd4c62c61421', '[\"*\"]', '2022-11-26 12:48:28', '2022-11-26 12:48:16', '2022-11-26 12:48:28'),
(15, 'App\\Models\\User', 2, 'authToken', 'fdd4689d72e4f5a7eb2d14a788c0eaf8b7dedb460e186f611c40e0e6f6b2abb1', '[\"*\"]', '2022-11-27 11:51:35', '2022-11-27 11:50:57', '2022-11-27 11:51:35'),
(16, 'App\\Models\\User', 2, 'authToken', '18dfa35351ed743360c98c0f4d088c4e36714551e615df375145947b27361dd1', '[\"*\"]', '2022-11-28 20:13:28', '2022-11-27 15:23:13', '2022-11-28 20:13:28'),
(17, 'App\\Models\\User', 20, 'authToken', '010ab9c24ba274720892faa7fda4db8b84c2df573dffd79de5533ae87e17b5ed', '[\"*\"]', '2022-11-29 07:21:08', '2022-11-29 07:19:26', '2022-11-29 07:21:08'),
(18, 'App\\Models\\User', 21, 'authToken', '4a0e391117311b16529b4c1d80821460db4149f17fe36210afe6eb8361910c83', '[\"*\"]', '2022-11-29 19:36:11', '2022-11-29 19:32:05', '2022-11-29 19:36:11'),
(19, 'App\\Models\\User', 22, 'authToken', '8a85dc266816f250e098ad80bb23e2b934d8cde9adeb14ba417a12318e2dddf3', '[\"*\"]', '2022-12-02 11:58:49', '2022-12-02 11:55:47', '2022-12-02 11:58:49'),
(20, 'App\\Models\\User', 23, 'authToken', '9b2797397f0c7a12a1514064b4230a49278d58519ddcf613f0d22457df7dd1d1', '[\"*\"]', '2022-12-08 03:19:06', '2022-12-03 11:41:46', '2022-12-08 03:19:06'),
(21, 'App\\Models\\User', 2, 'authToken', '38b05444d398405842e735f3919ec930b2a416bd08379c75e99b69d0cb25843e', '[\"*\"]', '2022-12-05 14:49:44', '2022-12-05 14:25:33', '2022-12-05 14:49:44'),
(22, 'App\\Models\\User', 24, 'authToken', '6482a0bedafeccc4db459ced5544bbeadf7bd55e40eb93c70dda516922f780ee', '[\"*\"]', NULL, '2022-12-07 01:58:50', '2022-12-07 01:58:50'),
(23, 'App\\Models\\User', 25, 'authToken', 'be2e320501b0ad1d19168e3b0756b7a7db337d6d652af2754f65e47be6984347', '[\"*\"]', '2022-12-07 12:39:40', '2022-12-07 12:39:27', '2022-12-07 12:39:40'),
(24, 'App\\Models\\User', 26, 'authToken', '2407cfd03bc2b7901efc285a9c0161f493979f6d8f7e38ffc2b0582268da0d3b', '[\"*\"]', NULL, '2022-12-08 14:27:35', '2022-12-08 14:27:35'),
(25, 'App\\Models\\User', 2, 'authToken', '9584faf09e01a3b2eb261330c97416d28402e01eed420f7b76e16aa16e1cd2ac', '[\"*\"]', '2022-12-17 12:44:42', '2022-12-08 21:03:43', '2022-12-17 12:44:42'),
(26, 'App\\Models\\User', 2, 'authToken', '906afae51acf3ae9034db90e68dc67a938f0bd972039b85b3e6f8e85a8ebf8b8', '[\"*\"]', '2022-12-10 12:25:53', '2022-12-10 12:24:39', '2022-12-10 12:25:53'),
(27, 'App\\Models\\User', 28, 'authToken', '0b38eca8d34af40abaab694607354248e8d351b3332a15948563b05cfa293462', '[\"*\"]', '2022-12-12 00:10:27', '2022-12-12 00:10:15', '2022-12-12 00:10:27'),
(28, 'App\\Models\\User', 29, 'authToken', '4e3ce29da62b003dbec0b15b69520b79322f4021e72ca209a9678b2764fb3e87', '[\"*\"]', '2022-12-13 04:12:04', '2022-12-12 01:55:28', '2022-12-13 04:12:04'),
(29, 'App\\Models\\User', 10, 'authToken', '3eef7d759bb365be2439eaffe4f916caa6ad862ae195b14a0f9e606ec1f93f40', '[\"*\"]', '2022-12-12 08:13:15', '2022-12-12 07:57:15', '2022-12-12 08:13:15'),
(30, 'App\\Models\\User', 2, 'authToken', 'b7ce2838c6faffe3e3293535e3945f5ee36951c85fe1206a48a46e1a2559a040', '[\"*\"]', '2022-12-12 15:46:46', '2022-12-12 15:46:07', '2022-12-12 15:46:46'),
(32, 'App\\Models\\User', 31, 'authToken', 'd7f4c502e4aaa92faa2ff46dbc8aabe7fec43614ada97319bf77b1826ee9cc15', '[\"*\"]', '2022-12-14 13:35:23', '2022-12-14 13:32:59', '2022-12-14 13:35:23'),
(33, 'App\\Models\\User', 32, 'authToken', '1a7079b36222fb49225002c22cfcad6b23054efb88b291f15f0e813be33e89cb', '[\"*\"]', '2022-12-14 15:18:33', '2022-12-14 15:17:39', '2022-12-14 15:18:33'),
(34, 'App\\Models\\User', 33, 'authToken', '4fd557d1a795e3c2f3740d94f27be5b9de12a8e974e3a848ab6d496d048e5b12', '[\"*\"]', '2022-12-15 22:54:33', '2022-12-15 18:20:25', '2022-12-15 22:54:33'),
(35, 'App\\Models\\User', 2, 'authToken', '65c648ee529caf4c9db195b6487bfa16fec32e3906e299cff17ab8ff22d823ff', '[\"*\"]', '2022-12-18 02:32:03', '2022-12-18 02:29:10', '2022-12-18 02:32:03'),
(36, 'App\\Models\\User', 34, 'authToken', '49a5247fea3dd7943ac8fa131d04e61dcf57abb78eda02646dadeca6bb6ab641', '[\"*\"]', '2023-01-17 03:08:58', '2022-12-22 18:12:29', '2023-01-17 03:08:58'),
(37, 'App\\Models\\User', 35, 'authToken', '0f2037d91953325c456419f0151ebe9d8c16228358225beb266f9825e151d30f', '[\"*\"]', '2022-12-23 16:36:40', '2022-12-23 16:32:17', '2022-12-23 16:36:40'),
(38, 'App\\Models\\User', 2, 'authToken', '5ca2955d75af22a60a1a1dd8850ae3a983b810c534f6f638cf7ac2d042a00ebd', '[\"*\"]', '2022-12-24 03:37:50', '2022-12-24 03:36:30', '2022-12-24 03:37:50'),
(39, 'App\\Models\\User', 36, 'authToken', 'adee6380d45c611e24f11ac4984eea21dfc1d5f238e6001bd46d1678566edd07', '[\"*\"]', '2022-12-26 07:19:10', '2022-12-26 01:03:40', '2022-12-26 07:19:10'),
(40, 'App\\Models\\User', 37, 'authToken', 'cc4dd32f96fe3854486e589d71fbfae2d014f90a0e9c68615017cac2387b3835', '[\"*\"]', '2022-12-26 01:50:15', '2022-12-26 01:49:37', '2022-12-26 01:50:15'),
(41, 'App\\Models\\User', 38, 'authToken', '9b54277a6fa4d51ce343fee9e2f2be31089b6c7f6f1a75358fc93cdc11fff568', '[\"*\"]', '2022-12-27 01:01:02', '2022-12-26 21:32:49', '2022-12-27 01:01:02'),
(42, 'App\\Models\\User', 38, 'authToken', '654bff8c66d08e66862d5d577c5be6ba9767145a62a25dd450e315a13edcaa8c', '[\"*\"]', '2022-12-28 10:30:51', '2022-12-28 10:17:53', '2022-12-28 10:30:51'),
(43, 'App\\Models\\User', 39, 'authToken', 'f78e5433b1e372d4992ca8d47545a81d1ec117e237908bcca4e58032d6523dc4', '[\"*\"]', '2022-12-31 08:19:06', '2022-12-31 08:15:17', '2022-12-31 08:19:06'),
(44, 'App\\Models\\User', 40, 'authToken', 'f262ef1302013eb22d0cd850c9eceaa7862f76efa881bdfaa685fc3c9617abbf', '[\"*\"]', '2023-01-04 03:51:19', '2023-01-04 03:50:38', '2023-01-04 03:51:19'),
(45, 'App\\Models\\User', 42, 'authToken', 'd62dd035cefa72371dc30c079997e5154f9e28009fb68e6a8769e3229ea9906f', '[\"*\"]', '2023-01-08 12:56:05', '2023-01-08 12:55:25', '2023-01-08 12:56:05'),
(47, 'App\\Models\\User', 2, 'authToken', 'aecb9ab653ff82bb8896ad2a8b0787a930eaf0d1d2fa925bc49ae03835add49b', '[\"*\"]', '2023-01-15 14:05:51', '2023-01-15 14:03:04', '2023-01-15 14:05:51'),
(48, 'App\\Models\\User', 2, 'authToken', 'fe28cb72ca8dfdc2a296e2c098777b615f993f95171d588e8b22e1b4f1cc14bd', '[\"*\"]', '2023-01-19 15:48:21', '2023-01-19 15:47:40', '2023-01-19 15:48:21'),
(49, 'App\\Models\\User', 48, 'authToken', 'd3c20ae9412b617f665152166a7ecacbb32c459f9010b00b4eb7010655c0bc4a', '[\"*\"]', '2023-01-20 10:45:43', '2023-01-20 10:37:15', '2023-01-20 10:45:43'),
(50, 'App\\Models\\User', 49, 'authToken', '45cb4c57ad1ba015d0468a041bb56ed0fb43d04c41f87066e162147751283040', '[\"*\"]', '2023-01-21 11:43:24', '2023-01-20 15:24:08', '2023-01-21 11:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint UNSIGNED NOT NULL,
  `video_id` int DEFAULT NULL,
  `report` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `video_id`, `report`, `view_status`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 35, 'low', 'viewed', 'active', 1, 1, '2022-12-31 07:38:14', '2022-12-31 07:38:27');

-- --------------------------------------------------------

--
-- Table structure for table `request_movies`
--

CREATE TABLE `request_movies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `movie_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_movies`
--

INSERT INTO `request_movies` (`id`, `name`, `email`, `movie_name`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'dcsdfds', 'sdfsdd@gmail.com', 'dwef', 'weferfr', NULL, '2022-11-20 06:42:48', '2022-11-20 06:42:48');

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
  `id` bigint UNSIGNED NOT NULL,
  `series_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`id`, `series_id`, `name`, `image`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 1, 'Season 1', NULL, 'active', 1, 1, '2022-10-03 04:11:17', '2022-10-03 04:11:17'),
(3, 3, 'Season 1', NULL, 'active', 1, 1, '2022-11-19 00:51:02', '2022-11-19 00:51:02'),
(4, 3, 'Season 2', NULL, 'active', 1, 1, '2022-11-19 04:38:13', '2022-11-19 04:38:13'),
(5, 14, 'saison1', NULL, 'active', 2, 2, '2022-12-07 06:03:47', '2022-12-07 06:03:47'),
(6, 15, 'Season 1', NULL, 'active', 1, 1, '2023-01-14 03:03:22', '2023-01-14 03:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `id` bigint UNSIGNED NOT NULL,
  `series_category_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`id`, `series_category_id`, `name`, `image`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 14, 'Breaking Bad', NULL, 'active', 1, 1, '2022-10-03 03:46:44', '2022-10-03 03:46:44'),
(2, 14, 'Game of Thrones', NULL, 'active', 1, 1, '2022-10-03 03:46:57', '2022-10-03 03:46:57'),
(3, 14, 'Stranger Things', NULL, 'active', 1, 1, '2022-10-03 03:47:07', '2022-10-03 03:47:07'),
(4, 14, 'The Walking Dead', NULL, 'active', 1, 1, '2022-10-03 03:47:15', '2022-10-03 03:47:15'),
(5, 14, '13 Reasons Why', NULL, 'active', 1, 1, '2022-10-03 03:47:30', '2022-10-03 03:47:30'),
(6, 14, 'The 100', NULL, 'active', 1, 1, '2022-10-03 03:47:40', '2022-10-03 03:47:40'),
(8, 14, 'Orange Is the New Black', NULL, 'active', 1, 1, '2022-10-03 04:04:15', '2022-10-03 04:04:15'),
(9, 14, 'Riverdale', NULL, 'active', 1, 1, '2022-10-03 04:04:24', '2022-10-03 04:04:24'),
(10, 14, 'Grey\'s Anatomy', NULL, 'active', 1, 1, '2022-10-03 04:04:33', '2022-10-03 04:04:33'),
(11, 14, 'The Flash', NULL, 'active', 1, 1, '2022-10-03 04:04:42', '2022-10-03 04:04:42'),
(12, 14, 'Arrow', NULL, 'active', 1, 1, '2022-10-03 04:04:51', '2022-10-03 04:04:51'),
(13, 14, 'Money Heist', NULL, 'active', 1, 1, '2022-10-03 04:05:01', '2022-10-03 04:05:01'),
(14, 14, 'Paris', NULL, 'active', 2, 2, '2022-12-07 06:03:23', '2022-12-07 06:03:23'),
(15, 16, 'House of the Dragon', NULL, 'active', 1, 1, '2023-01-14 03:02:58', '2023-01-14 03:02:58');

-- --------------------------------------------------------

--
-- Table structure for table `serieses`
--

CREATE TABLE `serieses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `series_categories`
--

CREATE TABLE `series_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `series_categories`
--

INSERT INTO `series_categories` (`id`, `name`, `image`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(14, 'English', NULL, 'active', NULL, NULL, '2022-10-03 03:46:19', '2022-10-03 03:46:19'),
(15, 'Fantasy', NULL, 'active', NULL, NULL, '2022-11-19 00:49:19', '2022-11-19 00:49:19'),
(16, 'TV Series', NULL, 'active', NULL, NULL, '2023-01-14 03:02:31', '2023-01-14 03:02:31'),
(17, 'Aar ya paar', NULL, 'active', NULL, NULL, '2023-01-15 14:16:15', '2023-01-15 14:16:15'),
(18, 'Drama', NULL, 'active', NULL, NULL, '2023-01-21 09:09:36', '2023-01-21 09:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `system_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_app` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `developed_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `more_social` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_parental_control` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parental_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `about_us` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacy_policy` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cookies_policy` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `terms_policy` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_tag` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `focus_keyword` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `system_name`, `app_version`, `mail_address`, `update_app`, `developed_by`, `website`, `facebook`, `instagram`, `twitter`, `youtube`, `more_social`, `is_parental_control`, `parental_password`, `copyright`, `logo`, `logo_icon`, `description`, `about_us`, `privacy_policy`, `cookies_policy`, `terms_policy`, `seo_tag`, `focus_keyword`, `meta_description`, `seo_title`, `created_at`, `updated_at`) VALUES
(1, 'MovieFlix', '1.0.5', 'ccn@gmail.com', NULL, 'CCN InfoTech Ltd.', NULL, 'https://www.facebook.com/ccninfotech', NULL, 'https://twitter.com/CcnInfotech', 'https://www.youtube.com/channel/UCdDO1IvFROG0PP2SuzWVE8g', NULL, 'on', '123456', 'ccn', '', '', NULL, NULL, '<h2>What is Lorem Ipsum?</h2><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><h2>Where does it come from?</h2><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p><h2>Where can I get some?</h2><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', '<h2>What is Lorem Ipsum?</h2><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><h2>Where does it come from?</h2><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p><h2>Where can I get some?</h2><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', '<h2>What is Lorem Ipsum?</h2><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><h2>Where does it come from?</h2><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p><h2>Where can I get some?</h2><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', NULL, NULL, NULL, NULL, '2022-10-06 01:06:04', '2023-01-04 00:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `smtp_settings`
--

CREATE TABLE `smtp_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `host` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encryption` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `port` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_id` int DEFAULT NULL,
  `banner_type` enum('image','video') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`id`, `title`, `file_type`, `file_link`, `url`, `image`, `video_id`, `banner_type`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'asd', 'link', 'https://english.cdn.zeenews.com/sites/default/files/styles/zm_700x400/public/2022/11/11/1115792-lleo10.jpg', 'https://www.youtube.com/watch?v=Nw-OdaX2moU', '1664799736.ad.jpg', NULL, 'image', 'active', NULL, NULL, '2022-10-03 06:22:16', '2022-11-16 06:27:10'),
(2, 'abir', 'link', 'https://www.cricbuzz.com/a/img/v1/980x654/i1/c247795/no-bowler-has-taken-as-many-t2.jpg', 'https://www.youtube.com/watch?v=Nw-OdaX2moU', '', NULL, 'image', 'active', NULL, NULL, '2022-11-09 00:06:23', '2022-11-09 00:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', 'active', '2022-11-20 06:42:25', '2022-11-20 06:42:25');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `image`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hollywood', '1664607527.t2article.png', 'active', NULL, NULL, '2022-10-01 00:58:47', '2022-10-01 00:58:47'),
(2, 1, 'Bollywood', NULL, 'active', NULL, NULL, '2022-10-03 00:51:38', '2022-10-03 00:51:38'),
(3, 4, 'Bangla Song', NULL, 'active', NULL, NULL, '2022-10-03 00:51:52', '2022-10-03 00:51:52'),
(4, 4, 'English Song', NULL, 'active', NULL, NULL, '2022-10-03 00:52:08', '2022-10-03 00:52:08'),
(5, 10, 'Hollywood', NULL, 'active', NULL, NULL, '2022-12-12 05:33:56', '2022-12-12 05:33:56'),
(6, 10, 'Bollywood', NULL, 'active', NULL, NULL, '2022-12-12 05:34:13', '2022-12-12 05:34:13'),
(7, 12, 'Hollywood', NULL, 'active', NULL, NULL, '2023-01-14 01:59:48', '2023-01-14 01:59:48'),
(8, 13, 'Sci-Fi, Fantasy', NULL, 'active', NULL, NULL, '2023-01-14 03:15:04', '2023-01-14 03:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `supports`
--

CREATE TABLE `supports` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('read','unread') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `top_features`
--

CREATE TABLE `top_features` (
  `id` bigint UNSIGNED NOT NULL,
  `video_id` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `top_features`
--

INSERT INTO `top_features` (`id`, `video_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, '2022-11-06 03:16:48', '2022-11-06 03:16:48'),
(2, 27, NULL, '2022-12-12 03:09:02', '2022-12-12 03:09:02'),
(3, 15, NULL, '2022-12-31 07:35:44', '2022-12-31 07:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gatway_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `package_id`, `payment_method`, `gatway_response`, `status`, `created_at`, `updated_at`) VALUES
(8, '5', '1', 'offline', NULL, 'payment', '2022-10-10 06:25:07', '2022-10-10 06:25:07'),
(21, '2', '2', 'stripe', 'cs_test_a1FfOr4nIpp2Jd5CdHALNDkVQ6QBVTDB6BworM81UPlMTNUOkidaU6nhQw', 'payment', '2022-12-31 03:43:19', '2022-12-31 03:43:19'),
(22, '2', '3', 'stripe', 'cs_test_a1UkQigT6e0JobxuhmaqCkW95STlJlUFspk3HoJi1YcbujZlAGvaR72FAe', 'payment', '2023-01-14 23:02:50', '2023-01-14 23:02:50'),
(23, '2', '2', 'stripe', 'cs_test_a1ShTfxI7iDa6R4rVl38BKJzkRjgCDV0YRUG0gqLz2XWkiIKZhSbo6LCIv', 'payment', '2023-01-18 18:55:19', '2023-01-18 18:55:19');

-- --------------------------------------------------------

--
-- Table structure for table `tv_channels`
--

CREATE TABLE `tv_channels` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_parental` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stream_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tv_channel_category_id` int DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tv_channels`
--

INSERT INTO `tv_channels` (`id`, `name`, `file_type`, `file_link`, `is_parental`, `url`, `stream_type`, `tv_channel_category_id`, `image`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'National Geographic', 'file', NULL, 'off', 'https://www.youtube.com/watch?v=0ThMultL4PY', 'youtube', 4, '1667638273.national-geographic-svg.png', 'active', NULL, NULL, '2022-10-23 23:35:14', '2023-01-22 01:53:09'),
(2, 'BBC News', 'file', NULL, 'off', 'https://www.youtube.com/watch?v=ntmPIzlkcJk', 'youtube', 2, '1667638205.1666603916.bbc.png', 'active', NULL, NULL, '2022-10-24 03:31:56', '2022-11-20 04:22:08'),
(11, 'BBC News', 'file', NULL, 'on', 'https://cph-p2p-msl.akamaized.net/hls/live/2000341/test/master.m3u8', '.m3u8', 2, '1667638220.1666603916.bbc.png', 'active', NULL, NULL, '2022-10-24 03:31:56', '2023-01-22 06:54:20'),
(12, 'Sky News', 'file', NULL, 'off', 'https://ottverse.com/free-hls-m3u8-test-urls/', '.m3u8', 2, '1667638087.sky (1).png', 'active', NULL, NULL, '2022-10-24 03:43:13', '2023-01-22 06:45:09'),
(14, 'T Sports', 'file', 'https://www.cricbuzz.com/a/img/v1/980x654/i1/c247795/no-bowler-has-taken-as-many-t2.jpg', 'off', 'https://www.youtube.com/watch?v=URVlsS7RJHU', 'youtube', 1, '1669444726.T_Sports_logo.png', 'active', NULL, NULL, '2022-11-09 00:02:30', '2022-11-26 01:08:46'),
(16, 'Sportv', 'file', NULL, 'off', 'https://ottverse.com/free-hls-m3u8-test-urls/', '.m3u8', 1, '1669455028.TV-Sport-TV-Ao-Vivo-Assistir-Sport-TV-Ao-Vivo.jpg', 'active', NULL, NULL, '2022-11-21 10:29:43', '2023-01-22 06:45:27'),
(19, 'CNN', 'file', NULL, 'off', 'https://www.youtube.com/watch?v=ljN9R9suv5s', 'youtube', 2, '1669800445.BCmoBSACzNJ8PMCMDZmTHH.jpg', 'active', NULL, NULL, '2022-11-30 03:57:25', '2022-11-30 03:57:25'),
(21, 'WB Kids', 'file', NULL, 'off', 'https://www.youtube.com/watch?v=rSn6ORAP2ns', 'youtube', 5, '1673682667.Kids\'_WB!_(logo).png', 'active', NULL, NULL, '2023-01-14 02:21:07', '2023-01-22 01:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `tv_channel_categories`
--

CREATE TABLE `tv_channel_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tv_channel_categories`
--

INSERT INTO `tv_channel_categories` (`id`, `name`, `image`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Sports', '1664607574.sports.jpg', 'active', NULL, NULL, '2022-10-01 00:59:34', '2022-10-01 00:59:34'),
(2, 'News', NULL, 'active', NULL, NULL, '2022-10-03 01:00:14', '2022-10-03 01:00:14'),
(4, 'Entertainment', NULL, 'active', NULL, NULL, '2022-10-03 02:18:13', '2022-10-03 02:18:13'),
(5, 'Cartoon', NULL, 'active', NULL, NULL, '2023-01-14 02:00:09', '2023-01-14 02:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `user_role_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_userid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_role_id`, `name`, `email`, `phone`, `password`, `access`, `image`, `provider_userid`, `login_provider`, `account_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super Admin', 'movieflix@admin.com', '01000000000', '$2y$10$bXPW3YTDcuH8fYvCloHYheRuis9k95Xlp6t/qw99tfzPNWoUro6xG', '', '1665409438.drama.jpg', NULL, NULL, 'confirmed', 'active', '2022-07-19 01:59:59', '2022-10-10 07:43:58'),
(2, 2, 'Demo', 'demoadmin@movieflix.com', '01000000001', '$2y$10$GdawTjZ0i85peeWoqoJU3.sWHknntMoNyHylqlq2NJdg2CQ2qyN6W', '[\"manage\",\"video\",\"administration\",\"user\",\"settings\",\"subscription\"]', NULL, NULL, NULL, 'confirmed', 'active', '2022-07-19 01:59:59', '2022-10-10 07:44:11'),
(5, 3, 'Abir', 'abir@gmail.com', '01741709262', '$2y$10$U1g0HXLzqyN1HNUWJWvg1ezky74px3B.6rdazMczrOHgoV21d38Bi', NULL, NULL, NULL, NULL, 'confirmed', 'active', '2022-10-10 06:25:07', '2022-10-10 06:25:07'),
(8, 1, 'oussama noukaila', 'oussamanoukaila@gmail.com', '0661040942', '$2y$10$COa2gDkvhraleSDhMapT2u1pCi2CoKY8wu9mtrhLZ9vObV/LGXHfu', '[\"manage\",\"video\",\"administration\",\"user\",\"settings\",\"subscription\"]', '1668593172.v-letter-logo-business-template-icon-free-vector.webp', NULL, NULL, 'confirmed', 'active', '2022-11-16 04:36:12', '2022-11-16 04:36:12'),
(9, 3, 'Sohag', 'sohag@gmail.com', '01538364831', '$2y$10$ypfOdlB8yYWTLkJ540d63.IUWFWdeCrlG4/5nO/8N3X0wbEPjOgci', NULL, '', NULL, NULL, 'pending', 'active', '2022-11-19 22:57:57', '2022-11-19 22:57:57'),
(14, 3, 'اثمةغ', 'taiz198019801@gmail.com', '976774216217', '$2y$10$T.rt.91WQMgnObcmEcPnhe5SvwWShXajwd3hEZl1Du1e3cBbWGFXC', NULL, '', NULL, NULL, 'pending', 'active', '2022-11-25 11:43:01', '2022-11-25 11:43:01'),
(15, 3, 'helmy', 'taiz19801980@gmail.com', '96778778798', '$2y$10$KlkwR48Lqg6AHq6Y3LdkmOUyQF6paa2hum2M.dvZSHG4SY6SWTR9K', NULL, '', NULL, NULL, 'pending', 'active', '2022-11-25 11:43:48', '2022-11-25 11:43:48'),
(19, 3, 'adul', 'user@tubemart.com', '082271499345', '$2y$10$uWpZkOW.lAQBPL3laMTije.4MYh/BF07.pGJ5FeL1S5QudZkUvStu', NULL, '1669522543.IMG_20221027_095941.jpg', NULL, NULL, 'confirmed', 'active', '2022-11-26 22:45:43', '2022-11-26 22:45:43'),
(29, 3, 'Ishrat Jahan', 'ishrat.221jahan@gmail.com', NULL, '$2y$10$lijMfr5Q3qa.0dJprVcinu55Q18k5CT4247ByimyFWHIht/Bsr5vy', NULL, 'https://lh3.googleusercontent.com/a/AItbvmlZ8RM9oks87TAqNipOnWactq4qt63rL5edZlnZ=s96-c', '8u467nKUPlVTw3eRy0N5TuahjX03', 'google', 'confirmed', 'active', '2022-12-12 01:55:28', '2022-12-12 01:55:28'),
(34, 3, 'Elite Moive Clips', 'walyawulapeter787@gmail.com', NULL, '$2y$10$d61OKYPqMRYhzWyZIbWP4.QATbciAAlRBfqmH0BXdre.GUBsLPNl6', NULL, 'https://lh3.googleusercontent.com/a/AEdFTp5UNGqeIthEmX4ZZ9QwWgl4i69h83V70YiXjsf1aQ=s96-c', 'DE3FAIHJclaoJ2uupgxyzysROB32', 'google', 'confirmed', 'active', '2022-12-22 18:12:29', '2022-12-22 18:12:29'),
(35, 3, 'Elysian dev', 'elysian.dev1@gmail.com', NULL, '$2y$10$2PmVx7o.apqgoaVF.8T.s.3bE.kRlfckUANnoGhaVZNm62B6TMsvi', NULL, 'https://lh3.googleusercontent.com/a/AEdFTp636jHD_i5V32y23HAfsQt8VRNOKTrF7tKlbw8L=s96-c', 'i2qeQcndzjYN9cB8Tg2bTJkuLsk1', 'google', 'confirmed', 'active', '2022-12-23 16:32:17', '2022-12-23 16:32:17'),
(36, 3, 'kangkan Bairagi (kangkan)', 'www.kangkanbairagi123@gmail.com', NULL, '$2y$10$w2RToewBxsvFfAMJjpdPeu5F6heC6A4c40cgfc9Y916Ncn1ue4LBG', NULL, 'https://lh3.googleusercontent.com/a/AEdFTp7KteE-0enTdYulgHYYuKkcA-YqLZe4kcLidRi7Vg=s96-c', '04t4k14T9WhBfSDt0wTPI2Z7a6j1', 'google', 'confirmed', 'active', '2022-12-26 01:03:40', '2022-12-26 01:03:40'),
(37, 3, 'Mzo pop', 'mzopop10@gmail.com', NULL, '$2y$10$v/dR5NM1FsPyz9jm40LwUuahdtUVJh.wqYNH0o7VSYrvWDCKwX7xq', NULL, 'https://lh3.googleusercontent.com/a/AEdFTp7lJoM1Ap_VZfhNWm5AGtlnloiWAmUtYIqFZS0u=s96-c', 'nPmBqDYARISirN2noItOMw8q6zb2', 'google', 'confirmed', 'active', '2022-12-26 01:49:37', '2022-12-26 01:49:37'),
(38, 3, 'Technical Strive', 'strivetechnical@gmail.com', NULL, '$2y$10$4dyX5fI5v8AcfWuFjLRvyuzXo0lp.McVO/Bwam6GTrJ22sGC9IqHy', NULL, 'https://lh3.googleusercontent.com/a/AEdFTp5KX3INTOKoBIPYpnVPTUz3xrhhwgPv22XJCInN=s96-c', 'Go3r3MwR2fSxR0RWi2NtMxQ2epG2', 'google', 'confirmed', 'active', '2022-12-26 21:32:49', '2022-12-26 21:32:49'),
(39, 3, '༒Bad\'BOY༒ बेङ बॉय', 'benaboya@gmail.com', NULL, '$2y$10$giHP0E29lhr8TYR7IA3XQ.W4VZXLm7h6yQtk1WXYtPajDkJxG16m.', NULL, 'https://lh3.googleusercontent.com/a/AEdFTp4Bxa1Ac2Cuu_b-1g_-lHpiFeLE7eZiTH4-u2zpMw=s96-c', 'b0E75Eq4acb1LTEgVeEDgYMI8VE2', 'google', 'confirmed', 'active', '2022-12-31 08:15:17', '2022-12-31 08:15:17'),
(40, 3, 'Ai-learn Indonesia', 'cs@ai-learn.com', NULL, '$2y$10$0D13BBK4EKxGp.e4BEkrE.jNY31gM1Y6dW/kbXxBYDykHE50pQ0P.', NULL, 'https://lh3.googleusercontent.com/a/AEdFTp5hBmIns-v2vsyCS9byC72rjimr7UT_ljstP2s_=s96-c', 'b3oLQPXXSRWRquA4Ox3uzu838OR2', 'google', 'confirmed', 'active', '2023-01-04 03:50:38', '2023-01-04 03:50:38'),
(41, 3, 'German Henriquez', 'Gucprez@gmail.com', '+18496541380', '$2y$10$h1HZUW5CKX.v9Dx2CFSvR.d0A85yNOW6MRzQXnysXYw3p7LMfpIDO', NULL, '', NULL, NULL, 'pending', 'active', '2023-01-05 20:44:42', '2023-01-05 20:44:42'),
(42, 3, 'bruno', 'brunocostamga@gmail.com', '67999343483', '$2y$10$91JGhIeKjA4ac1BT2ifix.ARe7DSnyqt5ptK.XR8OKDrp4LSb9h0i', NULL, '', NULL, NULL, 'pending', 'active', '2023-01-08 12:54:13', '2023-01-08 12:54:13'),
(43, 3, 'carlos', 'tvcanaldirecto5@gmail.com', '7722881199', '$2y$10$J/1iUqXIMPGVJHU6rhIFq.HNgGK3OdhRMZ2rfnAwZdhviqhSLByE6', NULL, '', NULL, NULL, 'pending', 'active', '2023-01-10 18:54:44', '2023-01-10 18:54:44'),
(44, 3, 'bablu', 'ashish.sharma.legend@gmail.com', '7048359235', '$2y$10$0cLKx5EdhnnSY.L5xsK2Y.z5O07NFe/6SiS5G8a7fIlOcZSBd7/BG', NULL, '', NULL, NULL, 'pending', 'active', '2023-01-13 18:22:26', '2023-01-13 18:22:26'),
(45, 3, 'bablu', 'ashish.sharma.legnd@gmail.com', '7048359239', '$2y$10$R.0bjS9yEyaekrgtGRpybe4uR5B4s1MCSxU6VDqdp5tJXJr7urCU6', NULL, '', NULL, NULL, 'pending', 'active', '2023-01-13 18:22:43', '2023-01-13 18:22:43'),
(46, 3, 'Regsi', 'meuappsite@gmail.com', '55991921094', '$2y$10$r8nuuL1HlI1JW.5iLr0/WObDfHOrepySE.3jYM8GvWCyfCVAx9f5a', NULL, '', NULL, NULL, 'pending', 'active', '2023-01-14 23:29:02', '2023-01-14 23:29:02'),
(47, 3, 'Regsi', 'danerisregis@gmail.com', '5555991921094', '$2y$10$AxTjjoYotqxjdWSCQEJWX.7Uagwc8wyQkAx9rdOjMCu1f6dVrtrGm', NULL, '', NULL, NULL, 'pending', 'active', '2023-01-14 23:29:37', '2023-01-14 23:29:37'),
(48, 3, 'aksel', 'sellers.pal@gmail.com', '00000000', '$2y$10$A3lQuR5laW7KQSqAOBlaCOhNLFmi6LKERJsJK00K6FABEgxa0ZYWK', NULL, '', NULL, NULL, 'pending', 'active', '2023-01-20 10:36:54', '2023-01-20 10:36:54'),
(49, 3, 'chirag', 'chanky1991.111@gmail.com', '8435630013', '$2y$10$3ERslYUralUyqI1BIvgIkeTmrtMWSzNBOkBKhZY9G1Dok1cMIqwOu', NULL, '', NULL, NULL, 'pending', 'active', '2023-01-20 15:23:33', '2023-01-20 15:23:33'),
(50, 3, 'KoNyo', 'admin@admin.com', '0999999999', '$2y$10$Er5rrgCyBZuGoXSQTAUCB.P5xs13xiZrccaMs36982NvZQFTw1S.O', NULL, '', NULL, NULL, 'pending', 'active', '2023-01-21 13:36:50', '2023-01-21 13:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'active', '2022-07-19 01:59:59', '2022-07-19 01:59:59'),
(2, 'Admin', 'active', '2022-07-19 01:59:59', '2022-07-19 01:59:59'),
(3, 'User', 'active', '2022-07-19 01:59:59', '2022-07-19 01:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_verifications`
--

CREATE TABLE `user_verifications` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_code` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_verifications`
--

INSERT INTO `user_verifications` (`id`, `email`, `verification_code`, `created_at`, `updated_at`) VALUES
(1, 'davidbryansp6@gmail.com', 27851, '2022-11-15 09:43:03', '2022-11-15 09:43:03'),
(2, 'davidbryanzikagames@gmail.com', 306687, '2022-11-15 09:44:29', '2022-11-15 09:44:29'),
(3, 'sohag@gmail.com', 342651, '2022-11-19 22:57:57', '2022-11-19 22:57:57'),
(4, 'aaaaaa@gmail.com', 410248, '2022-11-25 06:44:12', '2022-11-25 06:44:12'),
(5, 'taiz198019801@gmail.com', 348451, '2022-11-25 11:43:01', '2022-11-25 11:43:01'),
(6, 'taiz19801980@gmail.com', 433912, '2022-11-25 11:43:48', '2022-11-25 11:43:48'),
(7, 'Gucprez@gmail.com', 612078, '2023-01-05 20:44:42', '2023-01-05 20:44:42'),
(8, 'brunocostamga@gmail.com', 307195, '2023-01-08 12:54:13', '2023-01-08 12:54:13'),
(9, 'tvcanaldirecto5@gmail.com', 278418, '2023-01-10 18:54:44', '2023-01-10 18:54:44'),
(10, 'ashish.sharma.legend@gmail.com', 488951, '2023-01-13 18:22:26', '2023-01-13 18:22:26'),
(11, 'ashish.sharma.legnd@gmail.com', 840203, '2023-01-13 18:22:43', '2023-01-13 18:22:43'),
(12, 'meuappsite@gmail.com', 793738, '2023-01-14 23:29:02', '2023-01-14 23:29:02'),
(13, 'danerisregis@gmail.com', 437553, '2023-01-14 23:29:37', '2023-01-14 23:29:37'),
(14, 'sellers.pal@gmail.com', 694456, '2023-01-20 10:36:54', '2023-01-20 10:36:54'),
(15, 'chanky1991.111@gmail.com', 978760, '2023-01-20 15:23:33', '2023-01-20 15:23:33'),
(16, 'admin@admin.com', 598115, '2023-01-21 13:36:50', '2023-01-21 13:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` int DEFAULT NULL,
  `sub_category_id` int DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration_hour` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration_sec` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trailer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail_vertical` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_on_off` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `send_notification` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_on_off` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_trending` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fake_view` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_parental` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_series` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `series_category_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `series_id` int DEFAULT NULL,
  `season_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `episod_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celebrity_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genre_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `writer` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `director` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tmdb_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imdb_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmdb_rating` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_tmdb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_tag` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `focus_keyword` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `category_id`, `sub_category_id`, `title`, `year`, `duration_hour`, `duration`, `duration_sec`, `video_type`, `url`, `trailer`, `type`, `slug`, `video`, `thumbnail`, `thumbnail_vertical`, `video_on_off`, `send_notification`, `comment_on_off`, `is_trending`, `fake_view`, `is_parental`, `description`, `is_series`, `series_category_id`, `series_id`, `season_id`, `episod_id`, `country_id`, `celebrity_id`, `genre_id`, `writer`, `director`, `tmdb_type`, `imdb_id`, `tmdb_rating`, `show_tmdb`, `status`, `seo_tag`, `focus_keyword`, `meta_description`, `seo_title`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 'Top Gun: Maverick', '2022', '2', '11', NULL, '1', 'https://www.youtube.com/watch?v=giXco2jaZ_4', 'https://www.youtube.com/watch?v=giXco2jaZ_4', 'free', 'https://movieflix.ccninfotech.com/top-gun-maverick', '', '1668929818.Screenshot 2022-11-20 132107.jpg', '1668929818.Screenshot 2022-11-20 132214.jpg', 'off', 'on', 'on', 'on', '15000658', 'off', 'Over 30 years after graduating from Top Gun,[a] United States Navy Captain Pete \"Maverick\" Mitchell is a test pilot. Despite Maverick\'s many distinguished achievements, repeated insubordination has kept him from flag rank. His friend and former Top Gun rival, Admiral Tom \"Iceman\" Kazansky, is commander of the U.S. Pacific Fleet and often protects Maverick from being grounded. Rear Admiral Chester \"Hammer\" Cain plans to shut down Maverick\'s hypersonic \"Darkstar\" scramjet program in favor of funding drones. To save the program from cancellation, Maverick changes the flight plan in the upcoming test from the Mach 9 to Mach 10 to meet the program\'s contract specification. However, the prototype is destroyed when Maverick pushes beyond Mach 10. Iceman again saves Maverick\'s career by sending him to NAS North Island for his next assignment.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"5\",\"6\",\"7\"]', '[\"2\"]', 'Vince Gilligan', 'Joseph Kosinski', 'movie', '361743-top-gun-maverick', '8.343', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-10-17 04:04:32', '2022-12-31 04:17:28'),
(4, 1, 1, 'THE BATMAN', '2022', '2', '57', NULL, '1', 'https://www.youtube.com/watch?v=mqqft2x_Aa4', 'https://www.youtube.com/watch?v=mqqft2x_Aa4', 'free', 'https://movieflix.ccninfotech.com/the-batman', '', '1668951573.Screenshot 2022-11-20 132316.jpg', '1668951573.Screenshot 2022-11-20 132241.jpg', 'off', 'off', 'on', 'on', '6464458747', 'off', 'The Batman is a 2022 American superhero film based on the DC Comics character Batman. Produced by Warner Bros. Pictures, DC Films, 6th & Idaho, and Dylan Clark Productions, and distributed by Warner Bros. Pictures, it is a reboot of the Batman film franchise. The film was directed by Matt Reeves, who wrote the screenplay with Peter Craig. It stars Robert Pattinson as Bruce Wayne / Batman alongside Zoë Kravitz, Paul Dano, Jeffrey Wright, John Turturro, Peter Sarsgaard, Andy Serkis, and Colin Farrell. The film sees Batman, who has been fighting crime in Gotham City for two years, uncover corruption while pursuing the Riddler (Dano), a serial killer who targets Gotham\'s elite. It stars Robert Pattinson as Bruce Wayne / Batman alongside Zoë Kravitz, Paul Dano, Jeffrey Wright, John Turturro, Peter Sarsgaard, Andy Serkis, and Colin Farrell.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"2\",\"3\",\"4\"]', '[\"2\"]', 'Peter Craig', 'Matt Reeves', 'movie', '414906-the-batman', '7.708', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-10-17 04:10:30', '2022-11-21 06:11:22'),
(5, 3, 0, 'EVERYTHING EVERYWHERE ALL AT ONCE', '2022', '2', '20', NULL, '1', 'https://www.youtube.com/watch?v=wxN1T1uxQ2g', 'https://www.youtube.com/watch?v=wxN1T1uxQ2g', 'free', 'https://movieflix.ccninfotech.com/everything-everywhere-all-at-once', '', '1668936940.Screenshot 2022-11-20 153133-min.jpg', '1666001714.share(1).jpg', 'off', 'off', 'on', 'on', '545644989', 'off', 'Everything Everywhere All at Once is a 2022 American absurdist science fiction comedy-drama film written and directed by Daniel Kwan and Daniel Scheinert (collectively known as \"Daniels\"), who produced it with the Russo brothers. The plot centers on a Chinese American immigrant (played by Michelle Yeoh) who, while being audited by the IRS, discovers that she must connect with parallel universe versions of herself to prevent a powerful being from causing the destruction of the multiverse. Stephanie Hsu, Ke Huy Quan, Jenny Slate, Harry Shum Jr., James Hong, and Jamie Lee Curtis appear in supporting roles. The film has been described by The New York Times as a \"swirl of genre anarchy\" and incorporates elements of black comedy, science fiction, fantasy, martial arts films, and animation. Kwan and Scheinert had researched the concept of the multiverse as far back as 2010, and they began penning the screenplay by 2016.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"8\",\"9\"]', '[\"4\",\"5\"]', 'Daniel Kwan', 'Daniel Kwan', 'movie', '545611-everything-everywhere-all-at-once', '8.085', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-10-17 04:15:14', '2022-12-31 04:17:59'),
(6, 1, 1, 'THE NORTHMAN', '2022', '2', '17', NULL, '1', 'https://www.youtube.com/watch?v=oMSdFM12hOw', 'https://www.youtube.com/watch?v=oMSdFM12hOw', 'premium', 'https://movieflix.ccninfotech.com/the-northman', '', '1668929842.Screenshot 2022-11-20 132415.jpg', '1668930328.Screenshot 2022-11-20 134502.jpg', 'off', 'off', 'on', 'off', '98765433', 'off', 'The Northman is a 2022 American epic historical action thriller film directed by Robert Eggers, who co-wrote the screenplay with Sjón. Based on the legend of Amleth, the film stars Alexander Skarsgård (who also produced), Nicole Kidman, Claes Bang, Anya Taylor-Joy, Ethan Hawke, Björk, and Willem Dafoe. The plot centers on Amleth, a Viking prince who sets out on a quest to avenge the murder of his father. The film is heavily influenced by Norse mythology. Skarsgård had wanted to make a Viking film for several years, and Eggers decided to make the film his third project after the pair met to discuss possible collaborations. Much of the cast joined in October 2019, and filming took place in locations throughout Northern Ireland, the Republic of Ireland and Iceland from August to December 2020.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"10\",\"11\"]', '[\"2\",\"3\"]', 'Robert Eggers', 'Robert Eggers', 'movie', '639933-the-northman', '7.136', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-10-17 04:20:10', '2022-12-31 04:18:01'),
(7, 1, 1, 'Turning Red', '2022', '1', '44', NULL, '1', 'https://www.youtube.com/watch?v=XdKzUbAiswE', 'https://www.youtube.com/watch?v=XdKzUbAiswE', 'premium', 'https://movieflix.ccninfotech.com/turning-red', '', '1668932179.Screenshot 2022-11-20 141218.jpg', '1668932179.Screenshot 2022-11-20 141422.jpg', 'off', 'off', 'on', 'off', NULL, 'off', 'Turning Red is a 2022 American computer-animated fantasy comedy film produced by Pixar Animation Studios and distributed by Walt Disney Studios Motion Pictures. It was directed by Domee Shi in her feature directorial debut, written by Shi and Julia Cho, and produced by Lindsey Collins. It stars the voices of Rosalie Chiang, Sandra Oh, Ava Morse, Hyein Park, Maitreyi Ramakrishnan, Orion Lee, Wai Ching Ho, Tristan Allerick Chen, and James Hong. Set in Toronto, Ontario in 2002, Turning Red follows Meilin \"Mei\" Lee, a 13-year-old Chinese-Canadian student who, due to a hereditary curse, transforms into a giant red panda when she experiences any strong emotion.\r\n\r\nIt is the first Pixar film solely directed by a woman. Inspired by Shi\'s experiences growing up in Toronto, the film began development in May 2018 after she pitched it to Pixar in October 2017; several Pixar animators were visited locations around Northern California gathering visual references. The design and animation were inspired by anime works. Ludwig Göransson composed the film\'s musical score with Billie Eilish and Finneas O\'Connell performing original songs for the film.\r\n\r\nSpecial screenings of Turning Red took place in London at Everyman Borough Yards on February 21, 2022, and in Toronto at TIFF Bell Lightbox on March 8. It premiered at the El Capitan Theatre in Los Angeles on March 1, and on March 11 was released on the Disney+ streaming service and at limited theaters. It was released theatrically in most countries without Disney+, grossing over $20 million. Despite being a box office bomb, it received generally positive reviews from critics.[4]', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"12\"]', '[\"4\"]', 'Domee Shi', 'Domee Shi', 'movie', '508947-turning-red', '7.51', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-10-17 04:24:02', '2022-12-31 04:18:03'),
(8, 1, 1, 'Thor: Love and Thunder', '2022', '00', '02', '16', '1', 'https://www.youtube.com/watch?v=Go8nTmfrQd8', NULL, 'free', 'https://movieflix.ccninfotech.com/-thor-love-and-thunder', '', '1668929867.Screenshot 2022-11-20 132505.jpg', '1668929867.Screenshot 2022-11-20 132441.jpg', 'off', 'off', 'on', 'on', '255510', 'off', 'Gorr and his daughter, Love, the last of their race, struggle in a barren desert. Despite their prayers to their god, Rapu, Love dies. The god-killing Necrosword calls to Gorr, leading him to Rapu\'s lush realm. After Rapu cruelly mocks and dismisses Gorr\'s plight, he renounces the god, causing Rapu to strangle him. The Necrosword offers itself to Gorr, who kills Rapu with it and vows to kill all gods. Gorr is granted the ability to manipulate shadows and produce monsters but is cursed with impending death and corruption under the sword\'s influence. After Gorr kills several gods, Thor, who has joined the Guardians of the Galaxy, learns of a distress signal from Sif. He parts ways with the team and finds an injured Sif, who warns that Gorr\'s next target is New Asgard. Meanwhile, Dr. Jane Foster, Thor\'s ex-girlfriend, has been diagnosed with stage four terminal cancer.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"14\",\"15\",\"16\"]', '[\"3\",\"4\"]', 'Taika Waititi', 'Taika Waititi', 'movie', '616037-thor-love-and-thunder', '6.678', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-16 04:55:59', '2022-12-31 04:18:48'),
(10, 10, 6, 'Beast - Official Trailer', '2022', '00', '02', '56', '1', 'https://www.youtube.com/watch?v=0E1kVRRi6lk', 'https://www.youtube.com/watch?v=0E1kVRRi6lk', 'free', 'https://movieflix.ccninfotech.com/beast', '', '1668929897.Screenshot 2022-11-20 132633.jpg', '1668929897.Screenshot 2022-11-20 132529.jpg', 'off', 'off', 'on', 'on', '2548889', 'off', 'Veera Raghavan, an Indian RAW field operative is assigned to capture a terrorist named Umar Farooq. While he successfully manages to do so, a missile shot by him to prevent Farooq\'s escape injures and kills a civilian child, traumatising Veera, who quits the agency and returns to Chennai. Months later, Veera is still reeling from the after-effects of the child\'s death. He meets Preethi at a wedding, and they fall for each other, where she convinces him to join her company Dominic & Soldiers, a failing security service. Meanwhile, the Tamil Nadu government gets intel that a major terrorist event is planned in Chennai. He meets Preethi at a wedding, and they fall for each other, where she convinces him to join her company Dominic & Soldiers, a failing security service.', 'off', '0', 0, '0', '0', '[\"5\"]', '[\"21\",\"22\",\"23\"]', '[\"3\"]', 'Nelson Dilipkumar', 'Nelson Dilipkumar', 'movie', '800383-thalapathy-65', '5.9', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-16 05:40:22', '2022-12-31 04:18:50'),
(11, 1, 1, 'KATE | Official Trailer', '2021', '00', '02', '46', '1', 'https://www.youtube.com/watch?v=MysGjRS9jFU', NULL, 'free', 'https://movieflix.ccninfotech.com/kate', '', '1668929924.Screenshot 2022-11-20 132740.jpg', '1668929924.Screenshot 2022-11-20 132709.jpg', 'off', 'off', 'on', 'off', '2114566', 'on', 'Kate is an assassin and expert sniper who eliminates targets chosen by her trusted mentor and handler, Varrick. After she was left orphaned as a child, Varrick raised her as a father figure, giving her extensive training in weapons and combat and eventually inducting her into his private team of wetwork specialists. Kate is in Osaka to kill an officer of a powerful yakuza syndicate, but Kate resists taking the shot because a child has unexpectedly accompanied him. She ultimately shoots the target at Varrick\'s insistence. While Kate\'s assignment is a success, this breach of her personal code to not kill in the presence of children leaves her in emotional turmoil. She tells Varrick that she will do one final mission, and then retire so she can start a new life. Before the final mission, Kate meets a charismatic stranger, Stephen, at her hotel\'s bar. The pair share a bottle of wine and have sex in her room.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"24\",\"25\",\"26\"]', '[\"3\"]', 'Umair Aleem', 'Cedric Nicolas-Troyan', 'movie', '597891-kate', '6.703', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-16 06:26:25', '2022-11-20 06:36:55'),
(12, 10, 5, 'VENOM: LET THERE BE CARNAGE', '2021', '00', '02', '41', '1', 'https://www.youtube.com/watch?v=-FmWuCgJmxo', 'https://www.youtube.com/watch?v=-FmWuCgJmxo', 'free', 'https://movieflix.ccninfotech.com/venom-let-there-be-carnage', '', '1668929952.Screenshot 2022-11-20 132845.jpg', '1668929952.Screenshot 2022-11-20 132811.jpg', 'off', 'off', 'on', 'on', NULL, 'off', 'In 1996, a young Cletus Kasady watches helplessly as his lover, Frances Barrison, is taken away from St. Estes Home for Unwanted Children to the Ravencroft Institute. On the way, Barrison uses her sonic scream powers to attack young police officer Patrick Mulligan. Mulligan shoots Barrison in the eye and suffers an injury to his ear due to her scream. Unbeknownst to Mulligan, who believes he killed her, Barrison is still taken to Ravencroft where her abilities are restricted. In the present day, Mulligan is now a detective and asks journalist Eddie Brock to speak to serial killer Kasady in San Quentin State Prison, as Kasady refuses to talk to anyone other than Brock. After the visit, Brock\'s alien symbiote Venom deduces where Kasady has hidden the bodies of his victims, which gives Brock a huge career boost. Brock is then contacted by his ex-fiancée Anne Weying, who tells him that she is now engaged to Dr. Dan Lewis, to Venom\'s displeasure.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"26\",\"27\",\"28\"]', '[\"3\"]', 'Tom Hardy', 'Andy Serkis', 'movie', '580489-venom-let-there-be-carnage', '6.915', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-16 06:38:55', '2022-12-12 05:39:07'),
(13, 1, 0, 'TENET - Final Trailer', '2020', '00', '03', '09', '1', 'https://www.youtube.com/watch?v=AZGcmvrTX9M', 'https://www.youtube.com/watch?v=AZGcmvrTX9M', 'free', 'https://movieflix.ccninfotech.com/tenet', '', '1668929981.Screenshot 2022-11-20 132933.jpg', '1668929981.Screenshot 2022-11-20 133114.jpg', 'off', 'off', 'on', 'off', '20202145', 'on', 'On a date called \"the 14th\", the Protagonist leads a covert CIA extraction during a staged terrorist siege at a Kyiv Opera House. He is saved from KORD by an oddly behaving operative with a red trinket. The Protagonist retrieves the artifact but his team is sabotaged, captured, and tortured. He swallows a suicide pill but wakes up to find it was a fake; a test that only he has passed. Recruited by a secretive organization known as \"Tenet\", they brief him on bullets with \"inverted\" entropy that move backwards through time. With his handler Neil, he traces them to Priya Singh, an arms dealer in Mumbai. Priya reveals she is in Tenet and that her bullets were inverted by Russian oligarch Andrei Sator, who is communicating with the future. Sir Michael Crosby advises they approach Sator\'s estranged wife Kat Barton, an art appraiser who authenticated a forged Goya painting that Sator purchased from her friend Arepo, which he now uses to blackmail her.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"2\"]', '[\"2\",\"3\"]', 'Christopher Nolan', 'Christopher Nolan', 'movie', '577922-tenet', '7.208', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-16 06:51:22', '2022-11-20 06:37:32'),
(14, 1, 1, 'Extraction | Official Trailer', '2020', '00', '03', '02', '1', 'https://www.youtube.com/watch?v=L6P3nI6VnlY', 'https://www.youtube.com/watch?v=L6P3nI6VnlY', 'premium', 'https://movieflix.ccninfotech.com/extraction', '', '1668931721.Screenshot 2022-11-20 133241.jpg', '1668930006.Screenshot 2022-11-20 133137.jpg', 'off', 'off', 'on', 'off', '25254789', 'off', 'Ovi Mahajan – son of an incarcerated Indian drug lord Ovi Mahajan. Sr – sneaks out of his house to visit a club with his friend. At the party, Ovi and his friend go to the garage to have a smoke, where they encounter corrupt police officers working for rival drug lord Amir Asif, who shoot Ovi\'s friend and kidnap him. After discovering this, Saju Rav, a former Para Lt. Colonel and Ovi\'s protector, visits Ovi\'s father in prison. Unwilling to pay the ransom or surrender his territories to Amir as it will hurt his prestige, Ovi\'s father orders Saju to retrieve his son, threatening to kill Saju\'s own son if he is unwilling to do so. Tyler Rake, a former SASR operator turned black-market mercenary, is recruited by his handler Nik Khan, to save Ovi from Dhaka, Bangladesh.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"14\",\"29\",\"30\"]', '[\"2\",\"3\"]', 'Joe Russo', 'Sam Hargrave', 'movie', '545609-extraction', '7.35', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-16 07:03:35', '2022-11-20 06:38:05'),
(15, 3, 0, 'Stranger Things: Chapter One', '2016', '00', '02', '11', '1', 'https://www.youtube.com/watch?v=KxXJ57OgURg', 'https://www.youtube.com/watch?v=KxXJ57OgURg', 'free', 'https://movieflix.ccninfotech.com/stranger-things-S01E01', '', '1668930036.Screenshot 2022-11-20 133004.jpg', '1668930036.Screenshot 2022-11-20 133311.jpg', 'off', 'off', 'on', 'on', '12548796', 'off', 'Stranger Things is set in the fictional rural town of Hawkins, Indiana, during the 1980s. The nearby Hawkins National Laboratory ostensibly performs scientific research for the United States Department of Energy, but secretly does experiments into the paranormal and supernatural, including those that involve human test subjects. Inadvertently, they have created a portal to an alternate dimension, \"the Upside Down\". The influence of the Upside Down starts to affect the unknowing residents of Hawkins in calamitous ways. The first season begins in November 1983. Will Byers is abducted by a creature from the Upside Down. His mother, Joyce; the town\'s police chief, Jim Hopper; and a group of volunteers search for him. A young psychokinetic girl named Eleven escapes from the laboratory and is found by friends of Will. Eleven befriends and assists them in their efforts to find Will.', 'on', '14', 3, '3', '3', '[\"2\"]', '[\"31\",\"32\",\"33\"]', '[\"2\",\"3\"]', 'Matt Duffer', 'Matt Duffer, Ross Duffer', 'tv', '66732-stranger-things', '8.642', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-19 01:01:59', '2022-11-20 06:30:13'),
(16, 3, 0, 'Stranger Things: Chapter Two', '2016', '00', '02', '11', '1', 'https://www.youtube.com/watch?v=KxXJ57OgURg', 'https://www.youtube.com/watch?v=KxXJ57OgURg', 'premium', 'https://movieflix.ccninfotech.com/stranger-things-S01E02', '', '1668931571.Screenshot 2022-11-20 135418.jpg', '1668931165.Screenshot 2022-11-20 135250.jpg', 'off', 'off', 'on', 'off', '254698', 'off', 'Stranger Things is set in the fictional rural town of Hawkins, Indiana, during the 1980s. The nearby Hawkins National Laboratory ostensibly performs scientific research for the United States Department of Energy, but secretly does experiments into the paranormal and supernatural, including those that involve human test subjects. Inadvertently, they have created a portal to an alternate dimension, \"the Upside Down\". The influence of the Upside Down starts to affect the unknowing residents of Hawkins in calamitous ways. The first season begins in November 1983. Will Byers is abducted by a creature from the Upside Down. His mother, Joyce; the town\'s police chief, Jim Hopper; and a group of volunteers search for him. A young psychokinetic girl named Eleven escapes from the laboratory and is found by friends of Will. Eleven befriends and assists them in their efforts to find Will.', 'on', '14', 3, '3', '4', '[\"2\"]', '[\"31\",\"32\",\"33\"]', '[\"2\",\"3\"]', 'Matt Duffer', 'Matt Duffer, Ross Duffer', 'tv', '66732-stranger-things', '8.639', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-19 01:37:04', '2023-01-08 05:22:48'),
(17, 3, 0, 'Stranger Things: Chapter Three', '2016', '00', '02', '11', '1', 'https://www.youtube.com/watch?v=KxXJ57OgURg', 'https://www.youtube.com/watch?v=KxXJ57OgURg', 'free', 'https://movieflix.ccninfotech.com/stranger-things-S01E03', '', '1668931591.Screenshot 2022-11-20 135722.jpg', '1668931197.Screenshot 2022-11-20 135024.jpg', 'off', 'off', 'on', 'off', NULL, 'off', 'Stranger Things is set in the fictional rural town of Hawkins, Indiana, during the 1980s. The nearby Hawkins National Laboratory ostensibly performs scientific research for the United States Department of Energy, but secretly does experiments into the paranormal and supernatural, including those that involve human test subjects. Inadvertently, they have created a portal to an alternate dimension, \"the Upside Down\". The influence of the Upside Down starts to affect the unknowing residents of Hawkins in calamitous ways. The first season begins in November 1983. Will Byers is abducted by a creature from the Upside Down. His mother, Joyce; the town\'s police chief, Jim Hopper; and a group of volunteers search for him. A young psychokinetic girl named Eleven escapes from the laboratory and is found by friends of Will. Eleven befriends and assists them in their efforts to find Will.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"31\",\"32\",\"33\"]', '[\"2\",\"3\"]', 'Matt Duffer', 'Matt Duffer, Ross Duffer', 'tv', '66732-stranger-things', '8.642', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-19 01:50:32', '2022-11-20 06:31:20'),
(18, 3, 0, 'Breaking Bad Trailer: Pilot', '2008', '00', '02', '11', '1', 'https://www.youtube.com/watch?v=HhesaQXLuRY', 'https://www.youtube.com/watch?v=HhesaQXLuRY', 'free', 'https://movieflix.ccninfotech.com/breaking-bad', '', '1668936498.Screenshot 2022-11-20 145614.jpg', '1668935298.Screenshot 2022-11-20 145903.jpg', 'off', 'off', 'on', 'off', '12548', 'off', 'Walter H. White is a chemistry genius, but works as a chemistry teacher in an Albequerque, New Mexico high school. His life drastically changes when he\'s diagnosed with stage III terminal lung cancer, and given a short amount of time left to live: a mere matter of months. To ensure his handicapped son and his pregnant wife have a financial future, Walt uses his chemistry background to create and sell the world\'s finest crystal methamphetamine. To sell his signature \"blue meth,\" he teams up with Jesse Pinkman, a former student of his. The meth makes them very rich very quickly, but it attracts the attention of his DEA brother in law Hank. As Walt and Jesse\'s status in the drug world escalates, Walt becomes a dangerous criminal and Jesse becomes a hot-headed salesman. Hank is always hot on his tail, and it forces Walt to come up with new ways to cover his tracks.', 'on', '14', 1, '2', '8', '[\"2\"]', '[\"34\",\"35\",\"36\"]', '[\"2\",\"3\"]', 'Vince Gilligan', 'Vince Gilligan, Michael Slovis', 'tv', '1396-breaking-bad', '8.846', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-20 03:38:18', '2022-11-20 06:31:49'),
(19, 3, 0, 'Breaking Bad Trailer', '2016', '00', '02', '11', '1', 'https://www.youtube.com/watch?v=HhesaQXLuRY', 'https://www.youtube.com/watch?v=HhesaQXLuRY', 'premium', 'https://movieflix.ccninfotech.com/breaking-bad', '', '1668936521.Screenshot 2022-11-20 145738.jpg', '1668935900.Screenshot 2022-11-20 145810.jpg', 'off', 'off', 'on', 'off', '2254587', 'off', 'Walter H. White is a chemistry genius, but works as a chemistry teacher in an Albequerque, New Mexico high school. His life drastically changes when he\'s diagnosed with stage III terminal lung cancer, and given a short amount of time left to live: a mere matter of months. To ensure his handicapped son and his pregnant wife have a financial future, Walt uses his chemistry background to create and sell the world\'s finest crystal methamphetamine. To sell his signature \"blue meth,\" he teams up with Jesse Pinkman, a former student of his. The meth makes them very rich very quickly, but it attracts the attention of his DEA brother in law Hank. As Walt and Jesse\'s status in the drug world escalates, Walt becomes a dangerous criminal and Jesse becomes a hot-headed salesman. Hank is always hot on his tail, and it forces Walt to come up with new ways to cover his tracks.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"34\",\"35\",\"36\"]', '[\"2\",\"3\"]', 'Vince Gilligan', 'Vince Gilligan, Michael Slovis', 'tv', '1396-breaking-bad', '8.846', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-20 03:48:21', '2022-11-20 06:32:16'),
(20, 3, 0, 'Breaking Bad: ...And the Bag\'s in the River', '2016', '00', '02', '11', '1', 'https://www.youtube.com/watch?v=HhesaQXLuRY', 'https://www.youtube.com/watch?v=HhesaQXLuRY', 'free', 'https://movieflix.ccninfotech.com/blackadam', '', '1668936541.Screenshot 2022-11-20 145549.jpg', '1668936198.Screenshot 2022-11-20 145835.jpg', 'off', 'off', 'on', 'off', '2155879', 'on', 'Walter H. White is a chemistry genius, but works as a chemistry teacher in an Albequerque, New Mexico high school. His life drastically changes when he\'s diagnosed with stage III terminal lung cancer, and given a short amount of time left to live: a mere matter of months. To ensure his handicapped son and his pregnant wife have a financial future, Walt uses his chemistry background to create and sell the world\'s finest crystal methamphetamine. To sell his signature \"blue meth,\" he teams up with Jesse Pinkman, a former student of his. The meth makes them very rich very quickly, but it attracts the attention of his DEA brother in law Hank. As Walt and Jesse\'s status in the drug world escalates, Walt becomes a dangerous criminal and Jesse becomes a hot-headed salesman. Hank is always hot on his tail, and it forces Walt to come up with new ways to cover his tracks.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"34\",\"35\",\"36\"]', '[\"2\",\"3\"]', 'Vince Gilligan', 'Vince Gilligan, Michael Slovis', 'tv', '1396-breaking-bad', '8.861', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-20 03:53:18', '2023-01-08 05:24:31'),
(21, 1, 1, 'JOKER - Final Trailer', '2019', '00', '02', '24', '1', 'https://www.youtube.com/watch?v=zAGVQLHvwOY', 'https://www.youtube.com/watch?v=zAGVQLHvwOY', 'free', 'https://movieflix.ccninfotech.com/joker', '', '1668939584.Screenshot 2022-11-20 160438-min.jpg', '1668939584.Screenshot 2022-11-20 160841-min.jpg', 'off', 'off', 'on', 'on', '25547489', 'off', 'In 1981, clown and aspiring stand-up comedian Arthur Fleck lives with and cares for his mother, Penny, in crime-ridden and economically stagnant Gotham City. Arthur suffers from a neurological disorder that causes him to laugh uncontrollably at inappropriate times, requiring medication, for which he depends on social services. After Arthur is attacked by juvenile delinquents, his co-worker Randall gives him a revolver for self-defense. Arthur pursues a relationship with his neighbor, single mother Sophie and invites her to see his stand-up routine at a comedy club. At a children\'s hospital, Arthur\'s revolver falls out of his pant leg onto the floor in full view of the children. Randall lies to their manager, stating the gun was Arthur\'s own and Arthur is subsequently fired. Depressed on the subway, still in clown makeup, Arthur suffers a laughing fit and is accosted by a group of three drunk businessmen, shooting two of them in self-defense and murdering the third as he attempts to flee. The killings are condemned by billionaire mayoral candidate Thomas Wayne, whom the men worked for, calling supporters of the killer \"clowns.\" Protesters react by donning clown masks in Arthur\'s image. Budget cuts shut down the social service program, leaving Arthur without medication.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"37\",\"38\",\"39\"]', '[\"4\"]', 'Todd Phillips', 'Todd Phillips', 'movie', '475557-joker', '8.172', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-20 04:49:44', '2022-11-20 06:41:46'),
(22, 10, 5, 'Alita: Battle Angel | Official Trailer', '2019', '00', '02', '32', '1', 'https://www.youtube.com/watch?v=w7pYhpJaJW8', 'https://www.youtube.com/watch?v=w7pYhpJaJW8', 'premium', 'https://movieflix.ccninfotech.com/alita-battle-angel', '', '1668940827.Screenshot 2022-11-20 162646-min.jpg', '1668940827.Screenshot 2022-11-20 162529-min.jpg', 'off', 'off', 'on', 'off', '225486', 'off', 'In 2563, 300 years after Earth was devastated by a catastrophic war known as \"The Fall\", scientist Dr. Dyson Ido discovers a disembodied female cyborg with an intact human brain while scavenging for parts in the massive scrapyard of Iron City. Ido attaches a new cyborg body to the brain and names her \"Alita\" after his deceased daughter. Alita awakens with no memory of her past and quickly befriends Hugo, a young man who dreams of moving to the wealthy sky city of Zalem. She also meets Dr. Chiren, Ido\'s estranged ex-wife. Hugo later introduces Alita to Motorball, a Rollerball-like racing sport played by cyborg gladiators. Secretly, Hugo robs cyborgs of their parts for Vector, owner of the Motorball tournament and the \'de facto\' ruler of the Factory, Iron City\'s governing authority. One night, Alita follows Ido; they are ambushed by a gang of cyborg serial killers led by Grewishka. Ido is injured, and Alita instinctively fights using \"Panzer-Kunst\", a lost combat art for machine bodies. She kills two of the cyborgs and damages Grewishka, who retreats.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"7\",\"40\",\"41\"]', '[\"3\"]', 'Robert Rodriguez', 'Robert Rodriguez', 'movie', '399579-alita-battle-angel', '7.199', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-20 05:10:27', '2022-12-12 05:38:40'),
(23, 1, 1, 'The 365 Days | Official Trailer', '2020', '00', '02', '12', '1', 'https://www.youtube.com/watch?v=iXdw5wYI4cY', 'https://www.youtube.com/watch?v=iXdw5wYI4cY', 'free', 'https://movieflix.ccninfotech.com/365-dni', '', '1668942130.6KwrHucIE3CvNT7kTm2MAlZ4fYF.jpg', '1668942130.AAAABZGKLVk9PS7eETwLUcDxK3vy42z0FL_KW7Z1H4Pu2R3bgvOl50robFdNjuxnzOi3J_j_2YDZWf1cgKxL-Y0lbMNk-Xw2U7LVjkO2dgHe3SvhcLffIDwelUtOYk2xAH3IopAIrg.jpg', 'off', 'off', 'on', 'off', '25457874', 'on', 'After a meeting between the Torricelli Sicilian Mafia crime family and black market dealers, Massimo Torricelli watches a beautiful woman on a beach and talks with his father, the mafia boss. Suddenly, the dealers shoot Massimo and his father; Massimo survives while his father dies from his injuries. Five years later, Massimo is the leader of the Torricelli crime family. In Warsaw, Laura Biel is unhappy in her relationship with her boyfriend, Martin. Laura celebrates her 29th birthday in Italy with Martin and her friend Olga, but after Martin visits Etna without her, she goes for a walk and runs into Massimo, who kidnaps her. At his villa, Massimo reveals to Laura that she was the woman at the beach five years ago and that when he was injured, all he could think about was her. After searching for years and finally spotting her, he kidnapped her, intending to keep her as a prisoner for 365 days in the hopes that she will fall in love with him. He also promises her that he will not touch her intimately without her consent while he is physically and sexually aggressive towards her.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"42\",\"43\",\"44\"]', '[\"5\"]', 'Tomasz Klimala', 'Tomasz Mandes', 'movie', '664413-365-dni', '7.076', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-20 05:32:10', '2022-11-20 06:39:08'),
(24, 1, 1, 'Extinction | Official Trailer', '2018', '00', '02', '38', '1', 'https://www.youtube.com/watch?v=-ePDPGXkvlw', 'https://www.youtube.com/watch?v=-ePDPGXkvlw', 'free', 'https://movieflix.ccninfotech.com/extinction', '', '1668944972.Screenshot 2022-11-20 171004.jpg', '1668944972.Screenshot 2022-11-20 171030.jpg', 'off', 'off', 'on', 'off', '215488', 'off', 'Peter, an engineer, has recurring nightmares in which he and everyone he knows suffer through violent, alien invasion-like confrontations with an unknown enemy. This causes him to have a strained relationship with his wife, Alice, and his daughters Hanna and Lucy. He reluctantly visits a clinic to receive psychiatric help, only to find a patient there who reveals that he is having the same visions, and that the psyche would only suppress these visions. This prompts Peter to believe his visions are of an upcoming invasion. That night, invading spaceships open fire on the city, causing significant damage. Peter and Alice barricade their apartment amid the sounds of slaughter from ground troops. An armored alien soldier breaks through the barricade and finds Lucy hiding under a table. The soldier pauses to examine the girl, which allows Peter and Alice to immobilize the soldier. Peter, now armed with the soldier\'s weapon, leads his family out of the building.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"45\",\"46\",\"47\"]', '[\"2\"]', 'Spenser Cohen', 'Ben Young', 'movie', '429415-extinction', '6.013', NULL, 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-20 06:19:33', '2022-11-20 06:40:51'),
(25, 1, 1, 'Deadpool | Trailer', '2016', '02', '15', '25', '1', 'https://www.youtube.com/watch?v=ONHBaC-pfsk', 'https://www.youtube.com/watch?v=ONHBaC-pfsk', 'free', 'https://movieflix.ccninfotech.com/deadpool', '', '1668945448.Screenshot 2022-11-20 174315-min.jpg', '1668945448.Screenshot 2022-11-20 174343.jpg', 'off', 'off', 'on', 'off', '548796', 'off', 'Wade Wilson is a dishonorably discharged special forces operative working as a freelance mercenary when he meets a prostitute named Vanessa. They become romantically involved, and a year later she accepts his marriage proposal. However, Wilson is later diagnosed with terminal cancer and he leaves Vanessa without warning so she will not have to watch him die. A mysterious recruiter approaches Wilson and offers him an experimental cure for his cancer. He is taken to a laboratory run by Ajax and Angel Dust, who inject him with a serum designed to awaken latent mutant genes in his body. They subject Wilson to days of torture to trigger any mutation he may have, without success. When Wilson discovers Ajax\'s real name is Francis and mocks him for it, Ajax leaves Wilson in a hypobaric chamber that periodically takes him to the verge of asphyxiation over the weekend. This finally activates a regenerative healing factor that counteracts Wilson\'s cancer, but leaves him severely disfigured with burn-like scars over his entire body.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"48\",\"49\",\"50\"]', '[\"3\"]', 'Paul Wernick', 'Tim Miller', 'movie', '293660-deadpool', '7.602', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-20 06:27:28', '2022-11-20 06:39:43'),
(26, 1, 1, 'BAD BOYS FOR LIFE', '2020', '02', '04', '00', '1', 'https://www.youtube.com/watch?v=jKCj3XuPG8M', 'https://www.youtube.com/watch?v=jKCj3XuPG8M', 'free', 'https://movieflix.ccninfotech.com/bad-boys-for-life', '', '1669013144.Screenshot 2022-11-21 120935-min.jpg', '1669013144.Screenshot 2022-11-21 121431-min.jpg', 'off', 'off', 'on', 'off', '2154885', 'off', 'Isabel Aretas, widow of drug kingpin Benito, escapes from a Mexican prison with the aid of her son Armando. Isabel sends Armando to Miami, tasking him with recovering a substantial stash of money his father Benito had hidden, as well as assassinating the people responsible for his father\'s arrest and eventual death in prison. Isabel demands that Armando should also kill Detective Mike Lowrey, who is settled in Miami. Mike accompanies his partner Marcus Burnett to the birth of his first grandson. Desiring to spend more time with his family, the aging Marcus tells Mike he intends to retire, to Mike\'s chagrin. During a party celebrating Marcus\'s grandson, Mike is shot by Armando and left in a coma for months. Chastised by Isabel for targeting Mike first, Armando continues to assassinate other targets on his list during Mike\'s convalescence.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"51\",\"52\",\"53\"]', '[\"2\",\"3\"]', 'Peter Craig', 'Bilall Fallah, Adil El Arbi', 'movie', '38700-bad-boys-for-life', '7.162', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-21 01:15:44', '2022-11-21 01:15:44'),
(27, 10, 5, 'The Gray Man', '2022', '02', '08', '23', '1', 'https://www.youtube.com/watch?v=BmllggGO4pM', 'https://www.youtube.com/watch?v=BmllggGO4pM', 'premium', 'https://movieflix.ccninfotech.com/breaking-bad', '', '1669109589.Screenshot 2022-11-22 152715.jpg', '1669109589.Screenshot 2022-11-22 152743.jpg', 'off', 'off', 'on', 'on', '223657986', 'off', 'In 2003, senior CIA official Fitzroy visits a prisoner. Eight years earlier the prisoner was a minor convicted of killing his abusive father to protect his brother. Fitzroy offers the man his freedom in exchange for working as an assassin in the CIA\'s Sierra program. In 2021, on a mission in Bangkok, the prisoner Sierra Six, is working with fellow CIA agent Dani Miranda to assassinate a target suspected of selling off national security secrets. He is unable to do so stealthily without harming civilians and attacks the target directly, mortally wounding him. Before dying, the target reveals that he worked in the Sierra program as Sierra Four, and hands Six an encrypted drive detailing the corruption of CIA official Denny Carmichael, who is the lead agent on the assassination mission. Carmichael is elusive about the true purpose of the mission and the contents of the drive when confronted by Six.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"54\",\"55\",\"56\"]', '[\"2\",\"3\"]', 'Joe Russo', 'Joe Russo, Anthony Russo', 'movie', '725201-the-gray-man', '7.031', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-11-22 04:03:09', '2022-12-12 05:38:21'),
(31, 1, 2, 'Shamshera', '2022', '02', '38', '00', '1', 'https://www.youtube.com/watch?v=UHYUeZ8JszQ', 'https://www.youtube.com/watch?v=UHYUeZ8JszQ', 'free', 'https://movieflix.ccninfotech.com/shamshera', '', '1670831937.Screenshot 2022-12-12 134759.jpg', '1670831937.92430032.jpeg', 'off', 'off', 'on', 'off', '21254896', 'off', '1871: Shamshera is a Khameran tribesman, who along with his people was oppressed by the people of Kaza because of caste and status discrimination. Due to this, Shamshera counterattacks and pillages the kingdom, which leads to Kaza, creating a fearful reputation against the Khamerans. The kings and the wealthy men of the empire seek the help of the British to drive away the Khameran tribe from their village forest. The British accept the deal in exchange for 5000 gold coins. The British attack the Khameran tribe, but Shamshera and the tribal people fight valiantly and the British flee. Shamshera receives a message that their tribe could live peacefully and regain their lost respect if they promised to stop plundering Kaza and move to a fortress outside the city premises. Shamshera and his men arrive at the forest where they realize that it is a trap led by Shudh Singh, and are captured where they are tortured mercilessly.', 'off', '0', 0, '0', '0', '[\"5\"]', '[\"57\",\"58\",\"59\"]', '[\"3\",\"4\"]', 'Ekta Pathak Malhotra', 'Karan Malhotra', 'movie', '539686-shamshera', '5.5', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-12-12 02:28:58', '2022-12-12 02:28:58'),
(32, 1, 2, 'Runway 34', '2022', '02', '21', '00', '1', 'https://www.youtube.com/watch?v=Lb8mQCpZHco', 'https://www.youtube.com/watch?v=Lb8mQCpZHco', 'premium', 'https://movieflix.ccninfotech.com/runway-34', '', '1670832841.Screenshot 2022-12-12 140459.jpg', '1670832841.Screenshot 2022-12-12 140427.jpg', 'off', 'off', 'on', 'off', '2154863', 'off', 'Captain Vikrant Khanna is an accomplished pilot, who is preparing for a flight from Dubai to Cochin. He parties before the flight, and feels tired on boarding it, where his co-pilot is Tanya Albuquerque. Later, a cyclone in Cochin leads to the flight being diverted to Trivandrum on Khanna\'s suggestion, despite objection from Albuquerque. Albuquerque says that Bengaluru has to be the second option, not Trivandrum, as the latter is near Cochin and has a high chance of having bad weather too. Khanna says that if they divert to Trivandrum, they can attempt a landing there and save fuel. Due to miscommunication, the pilots do not realize that Trivandrum is facing weather worse than Cochin, which reduces the visibility level. Captain Khanna manages to land the flight while closing his eyes, and averts a major disaster.', 'off', '0', 0, '0', '0', '[\"5\"]', '[\"60\",\"61\",\"62\"]', '[\"3\"]', 'Sandeep Kewlani', 'Ajay Devgn', 'movie', '766116-mayday', '6.672', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-12-12 02:44:01', '2022-12-12 02:44:01'),
(33, 1, 1, 'UNCHARTED', '2022', '02', '12', '00', '1', 'https://www.youtube.com/watch?v=eHp3MbsCbMg', 'https://www.youtube.com/watch?v=eHp3MbsCbMg', 'free', 'https://movieflix.ccninfotech.com/uncharted', '', '1670833514.Screenshot 2022-12-12 141936.jpg', '1670833514.Screenshot 2022-12-12 141855.jpg', 'off', 'off', 'on', 'off', '215478', 'off', 'Orphaned brothers Sam and Nathan \"Nate\" Drake are caught trying to steal a map made after the Magellan expedition from a Boston museum. Before the orphanage can expel Sam, he sneaks out to be on his own, but promises Nate that he will return, leaving him a ring belonging to their ancestor Sir Francis Drake (although Sir Francis Drake actually had no children). Fifteen years later, Nate works as a bartender in New York City and pickpockets wealthy patrons. Victor \"Sully\" Sullivan, a fortune hunter who worked with Sam tracking treasure hidden by the Magellan crew, explains to Nate that Sam vanished after helping him steal Juan Sebastian Elcano\'s diary. Nate, having stopped receiving postcards from Sam, agrees to help Sully find him. Sully and Nate go to an auction to steal a golden cross linked to the Magellan crew, where they meet Santiago Moncada', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"63\",\"64\",\"65\"]', '[\"2\",\"3\"]', 'Rafe Judkins', 'Ruben Fleischer', 'movie', '335787-uncharted', '7.083', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-12-12 02:55:14', '2022-12-12 02:55:14'),
(34, 1, 2, 'Bunty Aur Babli 2', '2021', '02', '18', '00', '1', 'https://www.youtube.com/watch?v=UZVUrZIXnSU', 'https://www.youtube.com/watch?v=UZVUrZIXnSU', 'free', 'https://movieflix.ccninfotech.com/bunty-aur-babli-2', '', '1670834214.Screenshot 2022-12-12 143017.jpg', '1670834214.Screenshot 2022-12-12 142947.jpg', 'off', 'off', 'on', 'off', '215489', 'off', 'Sixteen years have passed since Rakesh Trivedi (Saif Ali Khan) and his wife Vimmi Saluja Trivedi (Rani Mukerji) retired from conning others with the brand \"Bunty Aur Babli\" for money, having been let go by DCP Dashrath Singh. A businessman named Chaddha (Neeraj Sood), as well as his rich affiliates, decide to invest money in a \"party nation\" by Chaddha\'s assistant and his friend. However, it soon turns out that Chaddha and his associates have been conned, and the culprits, revealed to be Kunal Singh (Siddhant Chaturvedi) and Sonia Rawat (Sharvari Wagh), decide to take on the pseudonym \"Bunty Aur Babli\", having heard stories of the original \"Bunty Aur Babli\" who were never caught, assuming that they would be able to escape from the clutches of the law, too.', 'off', '0', 0, '0', '0', '[\"5\"]', '[\"66\",\"67\",\"68\"]', '[\"4\",\"5\"]', 'Aditya Chopra', 'Varun V. Sharma', 'movie', '666390-bunty-aur-babli-2', '6.8', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-12-12 03:06:54', '2022-12-12 03:06:54'),
(35, 10, 5, 'The Man from Toronto', '2022', '01', '54', '12', '1', 'https://www.youtube.com/watch?v=dq1JecMR2_A', 'https://www.youtube.com/watch?v=dq1JecMR2_A', 'free', 'https://movieflix.ccninfotech.com/man-from-toronto', '', '1670843811.Screenshot 2022-12-12 165513.jpg', '1670843811.Screenshot 2022-12-12 170121.jpg', 'off', 'off', 'on', 'off', '2154869', 'off', 'Teddy, a struggling fitness entrepreneur in Yorktown, Virginia, is fired from his job at a local gym. He decides not to tell his wife Lori, taking her to Onancock for her birthday. Leaving her at a spa, Teddy arrives at the wrong cabin, where a man named Coughlin is being held hostage. Mistaken for \"the Man from Toronto\", a mysterious assassin with a talent for brutal interrogation, the clueless Teddy manages to intimidate Coughlin into giving up a code. The cabin is raided by the FBI, who convince Teddy to pose as the Man from Toronto to help capture would-be Venezuelan dictator Colonel Marin. Much to Teddy\'s jealousy, an agent is assigned to accompany Lori and her friend Anne on a day of luxury in Washington, D.C., telling them the trip has been provided by Teddy\'s job. As Toronto, Teddy meets Marin\'s wife Daniela, who flies him to San Juan, Puerto Rico with orders to identify Green, Coughlin\'s partner, and bring him to the Colonel in D.C.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"26\",\"69\",\"70\"]', '[\"3\"]', 'Jason Blumenthal', 'Patrick Hughes', 'movie', '667739-man-from-toronto', '6.556', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-12-12 05:46:51', '2022-12-12 05:46:51'),
(36, 10, 5, 'The Tomorrow War', '2021', '02', '18', '00', '1', 'https://www.youtube.com/watch?v=QPistcpGB8o', 'https://www.youtube.com/watch?v=QPistcpGB8o', 'premium', 'https://movieflix.ccninfotech.com/the-tomorrow-war', '', '1670848854.Screenshot 2022-12-12 171924.jpg', '1670848854.Screenshot 2022-12-12 171852.jpg', 'off', 'off', 'on', 'on', '2315874', 'off', 'In December 2022, biology teacher and former Green Beret Dan Forester is disappointed after failing to get a job at the Army Research Laboratory. Later, during the internationally televised World Cup, soldiers from the year 2051 arrive on the pitch via a time portal. They announce that in November 2048, aliens called White Spikes suddenly appeared in northern Russia and had wiped out most humans within a span of just three years. The world of the present-day sends their militaries into the future through a rudimentary wormhole device, called the JumpLink. Few return, prompting an international draft, but fewer than 20% survive their seven-day deployment. Dan receives a draft notice and is fitted with a temporal armband to track him and pull him back if he is alive at the end of his seven days.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"71\",\"72\",\"73\"]', '[\"3\"]', 'Director  Zach Dean', 'Chris McKay', 'movie', '588228-the-tomorrow-war', '7.916', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-12-12 07:10:54', '2022-12-31 04:27:47'),
(37, 10, 5, 'Carter (2022)', '2021', '02', '12', '00', '1', 'https://www.youtube.com/watch?v=vIQufUj8pFw', 'https://www.youtube.com/watch?v=vIQufUj8pFw', 'free', 'https://movieflix.ccninfotech.com/carter', '', '1670850374.AAAABfqGyGYO1UBswpX-VfI27uZo1aYv61HG0-7UlaEtRJkjBswvuvS2UE64JX_JvLZK1vEUtVLHeMNd5TWVAS-54L0wMyRLyU1ny-8u8yTAWomwsuvYP8BWxJEnjtPVjvmcxFdYsQ.jpg', '1670850374.Screenshot 2022-12-12 184536.jpg', 'off', 'off', 'on', 'off', '2559796', 'on', 'In the midst of a deadly pandemic caused by a virus which makes the infected patients violent and zombie-like, originating from the DMZ that has already devastated the United States and North Korea, a man wakes up in a blood-soaked bed in a motel room in Seoul, with a cross-shaped scar on the back of his head. Armed CIA agents burst in and threaten him demanding the whereabouts of Dr. Jung Byung-ho. With no recollections of his past, he doesn\'t know who he is or why he is there, let alone who Dr. Jung is. A female voice inside his ear which only he can hear, tells him that his name is Carter and he needs to accept her directions if he wants to live. Following her instructions, he escapes the room and enters a public bath where nearly a hundred gangsters attack and try to kill him. Thanks to his lethal fighting skills, he survives their assault.', 'off', '0', 0, '0', '0', '[\"2\"]', '[\"38\",\"40\"]', '[\"3\"]', 'Jung Byeong-sik', 'Jung Byung-gil', 'movie', '800345', '6.168', 'yes', 'active', NULL, NULL, NULL, NULL, 1, 1, '2022-12-12 07:36:14', '2022-12-31 04:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `video_settings`
--

CREATE TABLE `video_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `show_page` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `sub_category_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vertical_image` enum('on','off') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horizontal_image` enum('on','off') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_settings`
--

INSERT INTO `video_settings` (`id`, `show_page`, `category_id`, `sub_category_id`, `name`, `vertical_image`, `horizontal_image`, `video_number`, `created_at`, `updated_at`) VALUES
(36, 'home', 0, 0, 'top featured', 'off', 'on', '11', '2023-01-14 02:26:15', '2023-01-14 02:26:15'),
(37, 'home', 0, 0, 'trending now', 'off', 'on', '10', '2023-01-14 02:26:15', '2023-01-14 02:26:15'),
(38, 'home', 0, 0, 'just added', 'off', 'on', '10', '2023-01-14 02:26:15', '2023-01-14 02:26:15'),
(39, 'home', 0, 0, 'popular', 'off', 'on', '10', '2023-01-14 02:26:15', '2023-01-14 02:26:15'),
(40, 'home', 0, 0, 'dont miss', 'off', 'on', '10', '2023-01-14 02:26:15', '2023-01-14 02:26:15');

-- --------------------------------------------------------

--
-- Table structure for table `video_views`
--

CREATE TABLE `video_views` (
  `id` bigint UNSIGNED NOT NULL,
  `video_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_views`
--

INSERT INTO `video_views` (`id`, `video_id`, `user_id`, `ip_address`, `created_at`, `updated_at`) VALUES
(2, 2, 1, '127.0.0.1', '2022-10-12 07:59:08', '2022-10-12 07:59:08'),
(3, 1, 1, '127.0.0.1', '2022-10-16 02:45:34', '2022-10-16 02:45:34'),
(4, 1, NULL, '127.0.0.1', '2022-10-16 22:59:11', '2022-10-16 22:59:11'),
(83, 7, 1, '127.0.0.1', '2022-10-26 05:38:17', '2022-10-26 05:38:17'),
(87, 5, 1, '127.0.0.1', '2022-10-26 06:01:06', '2022-10-26 06:01:06'),
(101, 6, 1, '127.0.0.1', '2022-10-26 06:47:39', '2022-10-26 06:47:39'),
(155, 5, NULL, '127.0.0.1', '2022-10-29 03:22:42', '2022-10-29 03:22:42'),
(159, 3, NULL, '127.0.0.1', '2022-10-29 03:38:49', '2022-10-29 03:38:49'),
(160, 4, NULL, '127.0.0.1', '2022-10-29 22:35:33', '2022-10-29 22:35:33'),
(173, 6, NULL, '127.0.0.1', '2022-11-07 22:57:34', '2022-11-07 22:57:34'),
(174, 4, 1, '127.0.0.1', '2022-11-09 03:48:29', '2022-11-09 03:48:29'),
(176, 3, 1, '127.0.0.1', '2022-11-14 23:16:24', '2022-11-14 23:16:24'),
(177, 7, NULL, '127.0.0.1', '2022-11-15 05:02:47', '2022-11-15 05:02:47'),
(178, 3, NULL, '175.110.9.181', '2022-11-15 11:03:52', '2022-11-15 11:03:52'),
(179, 4, NULL, '2a02:2908:5103:2dbe:b5cf:201f:3ef1:a337', '2022-11-15 20:51:08', '2022-11-15 20:51:08'),
(180, 7, NULL, '103.73.227.212', '2022-11-16 03:24:04', '2022-11-16 03:24:04'),
(182, 9, 1, '103.73.227.212', '2022-11-16 05:08:59', '2022-11-16 05:08:59'),
(195, 5, 1, '103.73.227.212', '2022-11-16 07:14:33', '2022-11-16 07:14:33'),
(197, 3, 2, '41.92.59.44', '2022-11-16 19:04:56', '2022-11-16 19:04:56'),
(198, 4, 2, '41.92.59.44', '2022-11-16 19:05:22', '2022-11-16 19:05:22'),
(199, 4, NULL, '180.244.10.61', '2022-11-17 21:01:40', '2022-11-17 21:01:40'),
(201, 3, NULL, '2607:fea8:1b5e:5e00:b03e:1287:bd3a:8d8b', '2022-11-18 23:38:20', '2022-11-18 23:38:20'),
(202, 4, NULL, '2607:fea8:1b5e:5e00:b03e:1287:bd3a:8d8b', '2022-11-18 23:38:37', '2022-11-18 23:38:37'),
(214, 17, 1, '103.73.227.212', '2022-11-19 01:56:35', '2022-11-19 01:56:35'),
(244, 15, NULL, '37.111.195.149', '2022-11-19 04:24:47', '2022-11-19 04:24:47'),
(249, 10, NULL, '37.111.195.149', '2022-11-19 04:27:46', '2022-11-19 04:27:46'),
(250, 13, NULL, '37.111.195.149', '2022-11-19 04:27:59', '2022-11-19 04:27:59'),
(254, 16, NULL, '37.111.195.149', '2022-11-19 04:31:08', '2022-11-19 04:31:08'),
(255, 17, NULL, '37.111.195.149', '2022-11-19 04:31:33', '2022-11-19 04:31:33'),
(256, 5, 2, '109.74.43.44', '2022-11-19 08:37:39', '2022-11-19 08:37:39'),
(258, 10, 1, '103.73.227.212', '2022-11-19 08:51:38', '2022-11-19 08:51:38'),
(261, 4, NULL, '117.18.13.11', '2022-11-19 12:24:38', '2022-11-19 12:24:38'),
(271, 14, 2, '103.73.227.212', '2022-11-20 03:14:55', '2022-11-20 03:14:55'),
(274, 23, 1, '103.73.227.212', '2022-11-20 05:33:41', '2022-11-20 05:33:41'),
(276, 3, NULL, '102.149.139.10', '2022-11-20 06:43:28', '2022-11-20 06:43:28'),
(277, 8, NULL, '102.149.139.10', '2022-11-20 06:44:25', '2022-11-20 06:44:25'),
(286, 17, NULL, '103.73.227.212', '2022-11-20 08:00:12', '2022-11-20 08:00:12'),
(289, 19, NULL, '45.132.226.59', '2022-11-20 10:20:37', '2022-11-20 10:20:37'),
(290, 23, NULL, '45.132.226.59', '2022-11-20 10:21:43', '2022-11-20 10:21:43'),
(291, 22, NULL, '175.110.8.222', '2022-11-20 12:58:10', '2022-11-20 12:58:10'),
(293, 24, NULL, '175.110.8.222', '2022-11-20 13:07:28', '2022-11-20 13:07:28'),
(294, 3, NULL, '2a02:2f02:a503:2b00:7490:8b60:477c:8686', '2022-11-20 14:24:44', '2022-11-20 14:24:44'),
(295, 6, NULL, '2a02:2f02:a503:2b00:7490:8b60:477c:8686', '2022-11-20 14:25:28', '2022-11-20 14:25:28'),
(296, 4, NULL, '2a02:2f02:a503:2b00:7490:8b60:477c:8686', '2022-11-20 14:26:07', '2022-11-20 14:26:07'),
(297, 5, NULL, '2a02:2f02:a503:2b00:7490:8b60:477c:8686', '2022-11-20 14:26:14', '2022-11-20 14:26:14'),
(299, 8, NULL, '175.110.8.222', '2022-11-20 14:36:25', '2022-11-20 14:36:25'),
(300, 20, 1, '103.73.227.212', '2022-11-21 00:26:55', '2022-11-21 00:26:55'),
(302, 16, 1, '103.73.227.212', '2022-11-21 00:27:17', '2022-11-21 00:27:17'),
(303, 14, 1, '103.73.227.212', '2022-11-21 00:29:49', '2022-11-21 00:29:49'),
(306, 15, NULL, '119.30.45.137', '2022-11-21 01:17:12', '2022-11-21 01:17:12'),
(313, 14, NULL, '2804:d59:8434:bb00:fc93:eb11:ff11:1461', '2022-11-21 10:24:32', '2022-11-21 10:24:32'),
(314, 6, NULL, '2804:d59:8434:bb00:fc93:eb11:ff11:1461', '2022-11-21 10:34:44', '2022-11-21 10:34:44'),
(315, 3, NULL, '188.209.248.73', '2022-11-21 12:06:35', '2022-11-21 12:06:35'),
(316, 4, NULL, '188.209.248.73', '2022-11-21 12:08:01', '2022-11-21 12:08:01'),
(317, 27, NULL, '37.111.210.208', '2022-11-22 04:04:14', '2022-11-22 04:04:14'),
(319, 8, 1, '103.73.227.212', '2022-11-22 04:22:42', '2022-11-22 04:22:42'),
(321, 19, 1, '103.73.227.212', '2022-11-22 04:23:21', '2022-11-22 04:23:21'),
(323, 27, 1, '103.73.227.212', '2022-11-22 04:23:30', '2022-11-22 04:23:30'),
(324, 12, 1, '103.73.227.212', '2022-11-22 04:23:51', '2022-11-22 04:23:51'),
(325, 25, 2, '2804:d59:8434:bb00:fc93:eb11:ff11:1461', '2022-11-22 09:44:54', '2022-11-22 09:44:54'),
(326, 5, NULL, '103.161.71.190', '2022-11-22 11:45:06', '2022-11-22 11:45:06'),
(329, 3, NULL, '2409:4072:2e0f:de43:fcee:c4ff:feaf:1260', '2022-11-22 12:00:47', '2022-11-22 12:00:47'),
(330, 4, NULL, '2409:4072:2e0f:de43:fcee:c4ff:feaf:1260', '2022-11-22 12:01:06', '2022-11-22 12:01:06'),
(331, 3, NULL, '2a00:a040:185:316c:39a0:23db:dba9:7bb2', '2022-11-22 15:30:44', '2022-11-22 15:30:44'),
(333, 21, NULL, '2a00:a040:185:316c:39a0:23db:dba9:7bb2', '2022-11-22 15:31:49', '2022-11-22 15:31:49'),
(334, 5, NULL, '2a00:a040:185:316c:39a0:23db:dba9:7bb2', '2022-11-22 15:32:09', '2022-11-22 15:32:09'),
(336, 3, NULL, '2409:4060:2e03:4dd:c2c4:f50d:1165:2c51', '2022-11-22 19:28:21', '2022-11-22 19:28:21'),
(337, 4, 11, '105.71.18.35', '2022-11-23 11:11:41', '2022-11-23 11:11:41'),
(339, 7, 11, '105.71.18.35', '2022-11-23 11:13:00', '2022-11-23 11:13:00'),
(340, 4, NULL, '188.247.72.38', '2022-11-23 20:13:07', '2022-11-23 20:13:07'),
(341, 11, 2, '188.240.101.134', '2022-11-24 10:59:59', '2022-11-24 10:59:59'),
(342, 20, 2, '175.110.10.34', '2022-11-24 11:08:46', '2022-11-24 11:08:46'),
(343, 13, NULL, '175.110.10.34', '2022-11-24 11:28:42', '2022-11-24 11:28:42'),
(344, 3, NULL, '2405:201:300f:e18a:9010:ebc2:9b94:ba6c', '2022-11-24 22:42:58', '2022-11-24 22:42:58'),
(345, 3, 13, '2402:3a80:d64:56de:22e3:3b50:997a:86ce', '2022-11-25 06:45:15', '2022-11-25 06:45:15'),
(346, 26, NULL, '134.35.239.164', '2022-11-25 10:34:44', '2022-11-25 10:34:44'),
(347, 20, NULL, '134.35.239.164', '2022-11-25 10:45:43', '2022-11-25 10:45:43'),
(348, 3, NULL, '2409:4050:e42:92bc:9d8c:b227:95b3:c724', '2022-11-25 22:07:09', '2022-11-25 22:07:09'),
(349, 21, NULL, '2409:4050:e42:92bc:9d8c:b227:95b3:c724', '2022-11-25 22:07:33', '2022-11-25 22:07:33'),
(350, 3, 16, '223.24.156.15', '2022-11-26 06:14:36', '2022-11-26 06:14:36'),
(351, 20, 2, '178.130.106.252', '2022-11-26 08:48:56', '2022-11-26 08:48:56'),
(353, 5, 17, '102.118.49.45', '2022-11-26 11:24:25', '2022-11-26 11:24:25'),
(354, 26, 2, '2409:4062:238b:d26:3ca:8480:641e:6d4c', '2022-11-26 22:38:09', '2022-11-26 22:38:09'),
(355, 20, NULL, '2409:4062:238b:d26:3ca:8480:641e:6d4c', '2022-11-26 22:40:03', '2022-11-26 22:40:03'),
(356, 8, NULL, '103.117.110.234', '2022-11-27 02:16:11', '2022-11-27 02:16:11'),
(357, 27, NULL, '103.117.110.234', '2022-11-27 02:16:21', '2022-11-27 02:16:21'),
(358, 3, NULL, '103.117.110.234', '2022-11-27 02:17:20', '2022-11-27 02:17:20'),
(359, 4, NULL, '2409:4072:8d92:9a8b:480f:ef0c:f204:1893', '2022-11-27 11:50:06', '2022-11-27 11:50:06'),
(360, 15, NULL, '2409:4072:8d92:9a8b:480f:ef0c:f204:1893', '2022-11-27 11:50:15', '2022-11-27 11:50:15'),
(361, 20, NULL, '2409:4072:8d92:9a8b:480f:ef0c:f204:1893', '2022-11-27 11:50:32', '2022-11-27 11:50:32'),
(362, 4, 2, '2409:4072:8d92:9a8b:480f:ef0c:f204:1893', '2022-11-27 11:51:07', '2022-11-27 11:51:07'),
(363, 3, 2, '2409:4072:8d92:9a8b:480f:ef0c:f204:1893', '2022-11-27 11:51:18', '2022-11-27 11:51:18'),
(364, 27, 2, '2409:4072:8d92:9a8b:480f:ef0c:f204:1893', '2022-11-27 11:51:29', '2022-11-27 11:51:29'),
(365, 4, 2, '201.141.17.219', '2022-11-27 15:24:13', '2022-11-27 15:24:13'),
(366, 3, 2, '201.141.17.219', '2022-11-27 15:24:54', '2022-11-27 15:24:54'),
(367, 5, 2, '201.141.17.219', '2022-11-27 15:33:40', '2022-11-27 15:33:40'),
(369, 5, NULL, '2804:d59:8430:8600:fc93:eb11:ff11:1461', '2022-11-27 18:21:09', '2022-11-27 18:21:09'),
(371, 4, NULL, '2804:d59:8430:8600:fc93:eb11:ff11:1461', '2022-11-27 18:24:47', '2022-11-27 18:24:47'),
(372, 27, NULL, '2804:d59:8430:8600:fc93:eb11:ff11:1461', '2022-11-27 18:25:15', '2022-11-27 18:25:15'),
(373, 4, NULL, '1.47.20.106', '2022-11-28 01:29:18', '2022-11-28 01:29:18'),
(374, 3, NULL, '1.47.20.106', '2022-11-28 01:29:34', '2022-11-28 01:29:34'),
(375, 10, NULL, '103.167.151.206', '2022-11-28 03:46:36', '2022-11-28 03:46:36'),
(376, 20, NULL, '103.167.151.206', '2022-11-28 03:47:21', '2022-11-28 03:47:21'),
(377, 7, 2, '87.229.114.63', '2022-11-28 13:53:13', '2022-11-28 13:53:13'),
(378, 8, 2, '87.229.114.63', '2022-11-28 13:53:23', '2022-11-28 13:53:23'),
(379, 3, NULL, '2409:4062:2282:81f3:e1a4:b5f1:429d:b497', '2022-11-28 16:58:13', '2022-11-28 16:58:13'),
(380, 3, NULL, '165.56.185.155', '2022-11-29 00:21:05', '2022-11-29 00:21:05'),
(381, 4, 20, '139.47.33.177', '2022-11-29 07:19:50', '2022-11-29 07:19:50'),
(382, 5, NULL, '175.110.11.91', '2022-11-29 07:48:27', '2022-11-29 07:48:27'),
(383, 16, NULL, '178.130.117.223', '2022-11-29 10:33:36', '2022-11-29 10:33:36'),
(384, 15, NULL, '196.11.157.98', '2022-11-29 13:42:24', '2022-11-29 13:42:24'),
(385, 15, NULL, '165.57.80.247', '2022-11-30 01:35:03', '2022-11-30 01:35:03'),
(386, 19, NULL, '2405:201:a427:f81f:15ba:5937:7cfe:23e3', '2022-11-30 13:30:34', '2022-11-30 13:30:34'),
(387, 10, NULL, '2405:201:a427:f81f:15ba:5937:7cfe:23e3', '2022-11-30 13:30:42', '2022-11-30 13:30:42'),
(388, 5, NULL, '102.159.58.131', '2022-12-01 03:37:35', '2022-12-01 03:37:35'),
(389, 5, NULL, '2804:248:f8ed:6a00:5ca4:c0d5:8873:b704', '2022-12-01 09:01:10', '2022-12-01 09:01:10'),
(390, 3, NULL, '105.233.39.86', '2022-12-01 10:29:58', '2022-12-01 10:29:58'),
(391, 3, NULL, '197.210.74.152', '2022-12-01 15:55:04', '2022-12-01 15:55:04'),
(393, 3, NULL, '197.210.74.30', '2022-12-01 17:53:25', '2022-12-01 17:53:25'),
(395, 6, NULL, '95.108.213.26', '2022-12-02 02:41:25', '2022-12-02 02:41:25'),
(396, 21, NULL, '95.108.213.21', '2022-12-02 02:41:30', '2022-12-02 02:41:30'),
(398, 17, NULL, '95.108.213.21', '2022-12-02 02:41:40', '2022-12-02 02:41:40'),
(399, 26, NULL, '95.108.213.26', '2022-12-02 02:41:43', '2022-12-02 02:41:43'),
(400, 23, NULL, '95.108.213.21', '2022-12-02 02:41:50', '2022-12-02 02:41:50'),
(402, 8, NULL, '95.108.213.21', '2022-12-02 02:42:44', '2022-12-02 02:42:44'),
(406, 14, NULL, '95.108.213.21', '2022-12-02 02:43:20', '2022-12-02 02:43:20'),
(407, 16, NULL, '95.108.213.26', '2022-12-02 02:43:38', '2022-12-02 02:43:38'),
(408, 18, NULL, '95.108.213.21', '2022-12-02 02:43:42', '2022-12-02 02:43:42'),
(409, 3, NULL, '95.108.213.26', '2022-12-02 02:46:28', '2022-12-02 02:46:28'),
(411, 3, 22, '129.45.91.213', '2022-12-02 11:56:41', '2022-12-02 11:56:41'),
(412, 23, 22, '129.45.91.213', '2022-12-02 11:56:56', '2022-12-02 11:56:56'),
(413, 15, 22, '129.45.91.213', '2022-12-02 11:57:28', '2022-12-02 11:57:28'),
(415, 18, 22, '129.45.91.213', '2022-12-02 11:58:24', '2022-12-02 11:58:24'),
(416, 6, 22, '129.45.91.213', '2022-12-02 11:58:49', '2022-12-02 11:58:49'),
(417, 3, NULL, '2401:4900:392f:1680:1867:2e1a:8bb5:4d30', '2022-12-02 14:58:34', '2022-12-02 14:58:34'),
(418, 4, NULL, '2401:4900:392f:1680:1867:2e1a:8bb5:4d30', '2022-12-02 14:59:05', '2022-12-02 14:59:05'),
(419, 7, NULL, '103.62.144.83', '2022-12-02 16:09:09', '2022-12-02 16:09:09'),
(421, 28, 2, '103.62.144.83', '2022-12-02 16:13:30', '2022-12-02 16:13:30'),
(422, 6, 2, '103.62.144.83', '2022-12-02 16:13:36', '2022-12-02 16:13:36'),
(423, 28, NULL, '103.62.144.83', '2022-12-02 16:15:18', '2022-12-02 16:15:18'),
(424, 29, NULL, '103.62.144.83', '2022-12-02 16:17:30', '2022-12-02 16:17:30'),
(425, 3, NULL, '45.128.121.12', '2022-12-02 17:22:50', '2022-12-02 17:22:50'),
(427, 7, NULL, '45.128.121.12', '2022-12-02 17:23:50', '2022-12-02 17:23:50'),
(428, 8, NULL, '45.128.121.12', '2022-12-02 17:24:32', '2022-12-02 17:24:32'),
(429, 4, NULL, '45.128.121.12', '2022-12-02 17:36:09', '2022-12-02 17:36:09'),
(431, 20, NULL, '95.108.213.21', '2022-12-02 17:50:22', '2022-12-02 17:50:22'),
(432, 8, NULL, '95.108.213.26', '2022-12-02 17:56:55', '2022-12-02 17:56:55'),
(433, 10, NULL, '95.108.213.21', '2022-12-02 18:01:14', '2022-12-02 18:01:14'),
(434, 19, NULL, '95.108.213.21', '2022-12-02 18:10:44', '2022-12-02 18:10:44'),
(435, 22, NULL, '95.108.213.21', '2022-12-02 18:11:29', '2022-12-02 18:11:29'),
(436, 6, NULL, '95.108.213.21', '2022-12-02 18:19:10', '2022-12-02 18:19:10'),
(437, 3, NULL, '95.108.213.21', '2022-12-02 18:27:10', '2022-12-02 18:27:10'),
(438, 26, NULL, '95.108.213.21', '2022-12-02 18:42:17', '2022-12-02 18:42:17'),
(439, 5, NULL, '95.108.213.21', '2022-12-02 22:57:58', '2022-12-02 22:57:58'),
(440, 21, NULL, '95.108.213.26', '2022-12-02 22:59:02', '2022-12-02 22:59:02'),
(441, 23, NULL, '95.108.213.26', '2022-12-02 23:02:11', '2022-12-02 23:02:11'),
(442, 4, NULL, '95.108.213.21', '2022-12-02 23:27:57', '2022-12-02 23:27:57'),
(443, 7, NULL, '95.108.213.21', '2022-12-02 23:39:07', '2022-12-02 23:39:07'),
(444, 14, NULL, '87.250.224.109', '2022-12-03 01:36:05', '2022-12-03 01:36:05'),
(448, 3, 23, '46.56.184.122', '2022-12-03 12:34:18', '2022-12-03 12:34:18'),
(449, 4, 23, '46.56.184.122', '2022-12-03 12:34:48', '2022-12-03 12:34:48'),
(450, 15, NULL, '189.80.73.58', '2022-12-03 16:44:00', '2022-12-03 16:44:00'),
(451, 26, NULL, '189.80.73.58', '2022-12-03 16:44:18', '2022-12-03 16:44:18'),
(456, 4, NULL, '2405:201:a427:f81f:fd88:171e:306:cb24', '2022-12-05 12:59:26', '2022-12-05 12:59:26'),
(457, 3, NULL, '2405:201:a427:f81f:fd88:171e:306:cb24', '2022-12-05 12:59:45', '2022-12-05 12:59:45'),
(459, 8, NULL, '2405:201:a427:f81f:fd88:171e:306:cb24', '2022-12-05 13:04:50', '2022-12-05 13:04:50'),
(460, 3, NULL, '71.10.180.125', '2022-12-05 15:43:46', '2022-12-05 15:43:46'),
(461, 3, NULL, '200.105.212.177', '2022-12-06 17:35:08', '2022-12-06 17:35:08'),
(462, 3, NULL, '105.41.190.104', '2022-12-07 02:47:02', '2022-12-07 02:47:02'),
(463, 5, NULL, '178.247.165.206', '2022-12-07 03:27:57', '2022-12-07 03:27:57'),
(464, 16, NULL, '187.102.23.154', '2022-12-07 12:36:19', '2022-12-07 12:36:19'),
(465, 18, NULL, '187.102.23.154', '2022-12-07 12:36:22', '2022-12-07 12:36:22'),
(466, 3, NULL, '170.246.187.218', '2022-12-07 17:43:22', '2022-12-07 17:43:22'),
(467, 5, NULL, '5.28.186.36', '2022-12-08 05:46:31', '2022-12-08 05:46:31'),
(468, 3, NULL, '177.73.4.254', '2022-12-09 19:42:52', '2022-12-09 19:42:52'),
(469, 3, 2, '212.237.119.6', '2022-12-10 12:25:29', '2022-12-10 12:25:29'),
(470, 4, NULL, '111.125.157.114', '2022-12-10 13:19:21', '2022-12-10 13:19:21'),
(476, 19, NULL, '111.125.157.114', '2022-12-10 13:21:15', '2022-12-10 13:21:15'),
(477, 20, NULL, '111.125.157.114', '2022-12-10 13:21:24', '2022-12-10 13:21:24'),
(478, 27, NULL, '111.125.157.114', '2022-12-10 13:21:59', '2022-12-10 13:21:59'),
(479, 4, 17, '102.118.114.87', '2022-12-11 15:16:54', '2022-12-11 15:16:54'),
(480, 3, 28, '41.43.215.31', '2022-12-12 00:10:27', '2022-12-12 00:10:27'),
(481, 16, NULL, '103.73.227.212', '2022-12-12 01:47:37', '2022-12-12 01:47:37'),
(483, 6, 1, '103.73.227.212', '2022-12-12 01:50:47', '2022-12-12 01:50:47'),
(485, 22, 29, '37.111.202.49', '2022-12-12 01:56:10', '2022-12-12 01:56:10'),
(486, 4, 29, '37.111.202.49', '2022-12-12 01:57:31', '2022-12-12 01:57:31'),
(509, 32, 1, '103.73.227.212', '2022-12-12 03:29:16', '2022-12-12 03:29:16'),
(514, 34, 1, '103.73.227.212', '2022-12-12 03:29:57', '2022-12-12 03:29:57'),
(516, 31, 1, '103.73.227.212', '2022-12-12 03:30:35', '2022-12-12 03:30:35'),
(518, 25, 1, '103.73.227.212', '2022-12-12 03:32:16', '2022-12-12 03:32:16'),
(519, 33, 1, '103.73.227.212', '2022-12-12 03:32:20', '2022-12-12 03:32:20'),
(520, 21, 1, '103.73.227.212', '2022-12-12 03:32:33', '2022-12-12 03:32:33'),
(525, 34, NULL, '103.73.227.212', '2022-12-12 05:25:22', '2022-12-12 05:25:22'),
(528, 22, NULL, '103.73.227.212', '2022-12-12 05:32:30', '2022-12-12 05:32:30'),
(532, 18, 1, '103.73.227.212', '2022-12-12 05:35:27', '2022-12-12 05:35:27'),
(544, 4, 10, '103.73.227.212', '2022-12-12 08:01:10', '2022-12-12 08:01:10'),
(545, 18, 10, '103.73.227.212', '2022-12-12 08:13:16', '2022-12-12 08:13:16'),
(546, 33, 2, '95.107.255.3', '2022-12-12 15:46:28', '2022-12-12 15:46:28'),
(547, 36, NULL, '5.255.253.118', '2022-12-12 22:47:15', '2022-12-12 22:47:15'),
(548, 32, NULL, '95.108.213.26', '2022-12-12 22:47:21', '2022-12-12 22:47:21'),
(549, 31, NULL, '95.108.213.45', '2022-12-12 22:47:24', '2022-12-12 22:47:24'),
(550, 35, NULL, '5.255.231.245', '2022-12-12 22:47:27', '2022-12-12 22:47:27'),
(551, 34, NULL, '87.250.224.48', '2022-12-12 22:47:29', '2022-12-12 22:47:29'),
(552, 34, NULL, '95.108.213.45', '2022-12-12 22:47:32', '2022-12-12 22:47:32'),
(553, 37, NULL, '95.108.213.42', '2022-12-12 22:47:37', '2022-12-12 22:47:37'),
(554, 33, NULL, '87.250.224.172', '2022-12-12 22:47:40', '2022-12-12 22:47:40'),
(555, 32, NULL, '87.250.224.170', '2022-12-12 22:52:27', '2022-12-12 22:52:27'),
(557, 4, 31, '2401:4900:51e0:f26f:fda3:89eb:92b1:3c8f', '2022-12-14 13:34:14', '2022-12-14 13:34:14'),
(559, 3, 32, '2804:6828:c062:e400:f903:a5f0:f0a9:772d', '2022-12-14 15:18:09', '2022-12-14 15:18:09'),
(560, 37, 32, '2804:6828:c062:e400:f903:a5f0:f0a9:772d', '2022-12-14 15:18:33', '2022-12-14 15:18:33'),
(561, 4, 30, '2804:389:a032:3d00:b581:76a9:7475:a59', '2022-12-15 08:14:04', '2022-12-15 08:14:04'),
(563, 13, 33, '185.193.156.1', '2022-12-15 18:21:53', '2022-12-15 18:21:53'),
(564, 3, 33, '185.193.156.1', '2022-12-15 18:23:06', '2022-12-15 18:23:06'),
(565, 5, NULL, '111.125.157.114', '2022-12-16 08:22:27', '2022-12-16 08:22:27'),
(567, 15, NULL, '111.125.157.114', '2022-12-16 09:03:57', '2022-12-16 09:03:57'),
(568, 4, 30, '2804:6bd8:21cd:9700:b581:76a9:7475:a59', '2022-12-16 14:58:57', '2022-12-16 14:58:57'),
(569, 22, 30, '2804:6bd8:21cd:9700:b581:76a9:7475:a59', '2022-12-16 15:03:25', '2022-12-16 15:03:25'),
(570, 5, NULL, '37.212.199.177', '2022-12-17 11:36:15', '2022-12-17 11:36:15'),
(572, 13, 31, '2401:4900:51e7:9b0:2ad2:1a88:363e:f190', '2022-12-17 13:43:53', '2022-12-17 13:43:53'),
(575, 4, 31, '2401:4900:51e7:9b0:2ad2:1a88:363e:f190', '2022-12-17 13:48:20', '2022-12-17 13:48:20'),
(576, 22, 31, '2401:4900:51e7:9b0:2ad2:1a88:363e:f190', '2022-12-17 14:02:48', '2022-12-17 14:02:48'),
(579, 36, 31, '2401:4900:51e7:9b0:2ad2:1a88:363e:f190', '2022-12-17 14:05:04', '2022-12-17 14:05:04'),
(580, 3, 31, '2401:4900:51e7:9b0:2ad2:1a88:363e:f190', '2022-12-17 14:05:09', '2022-12-17 14:05:09'),
(581, 4, NULL, '142.132.210.190', '2022-12-18 10:33:44', '2022-12-18 10:33:44'),
(582, 4, 30, '2804:6bd8:21cd:9700:2102:e739:8a4:dbdf', '2022-12-19 15:33:51', '2022-12-19 15:33:51'),
(583, 4, 16, '142.93.2.23', '2022-12-20 01:48:20', '2022-12-20 01:48:20'),
(594, 8, NULL, '103.73.227.212', '2022-12-21 01:44:26', '2022-12-21 01:44:26'),
(596, 11, 1, '103.73.227.212', '2022-12-21 06:22:00', '2022-12-21 06:22:00'),
(597, 27, NULL, '102.85.137.243', '2022-12-22 18:11:51', '2022-12-22 18:11:51'),
(598, 4, 34, '102.85.137.243', '2022-12-22 18:13:06', '2022-12-22 18:13:06'),
(599, 25, 34, '102.85.137.243', '2022-12-22 18:13:29', '2022-12-22 18:13:29'),
(600, 3, NULL, '201.240.57.201', '2022-12-23 08:02:46', '2022-12-23 08:02:46'),
(601, 15, NULL, '201.240.57.201', '2022-12-23 08:03:11', '2022-12-23 08:03:11'),
(603, 6, 35, '196.118.16.12', '2022-12-23 16:34:17', '2022-12-23 16:34:17'),
(604, 25, 35, '196.118.16.12', '2022-12-23 16:34:31', '2022-12-23 16:34:31'),
(605, 8, NULL, '152.174.11.78', '2022-12-23 20:30:05', '2022-12-23 20:30:05'),
(606, 24, NULL, '152.174.11.78', '2022-12-23 20:30:42', '2022-12-23 20:30:42'),
(611, 3, NULL, '31.223.79.73', '2022-12-24 03:36:10', '2022-12-24 03:36:10'),
(612, 15, NULL, '152.174.11.78', '2022-12-24 03:49:24', '2022-12-24 03:49:24'),
(614, 3, NULL, '103.164.198.245', '2022-12-24 23:19:13', '2022-12-24 23:19:13'),
(615, 35, NULL, '103.164.198.245', '2022-12-24 23:19:29', '2022-12-24 23:19:29'),
(616, 4, NULL, '2404:c0:2d10::26c1:7d61', '2022-12-25 02:01:20', '2022-12-25 02:01:20'),
(618, 18, 36, '103.41.29.75', '2022-12-26 01:06:44', '2022-12-26 01:06:44'),
(619, 27, 37, '105.34.198.217', '2022-12-26 01:49:57', '2022-12-26 01:49:57'),
(620, 4, NULL, '71.10.180.125', '2022-12-26 05:33:23', '2022-12-26 05:33:23'),
(621, 4, 38, '51.79.240.197', '2022-12-26 21:35:40', '2022-12-26 21:35:40'),
(622, 4, 38, '103.83.186.212', '2022-12-27 01:00:13', '2022-12-27 01:00:13'),
(623, 4, NULL, '2402:8100:2632:3418:126c:159b:e545:acac', '2022-12-27 13:36:23', '2022-12-27 13:36:23'),
(625, 27, 38, '103.41.29.253', '2022-12-28 10:19:10', '2022-12-28 10:19:10'),
(626, 4, 2, '148.102.155.38', '2022-12-29 16:24:33', '2022-12-29 16:24:33'),
(627, 4, NULL, '103.188.93.249', '2022-12-31 01:03:36', '2022-12-31 01:03:36'),
(628, 5, NULL, '103.188.93.249', '2022-12-31 01:04:20', '2022-12-31 01:04:20'),
(629, 3, NULL, '103.188.93.249', '2022-12-31 01:06:12', '2022-12-31 01:06:12'),
(630, 27, NULL, '103.190.27.245', '2022-12-31 02:47:47', '2022-12-31 02:47:47'),
(631, 3, 1, '103.73.227.212', '2022-12-31 07:09:08', '2022-12-31 07:09:08'),
(633, 13, 1, '103.73.227.212', '2022-12-31 07:18:57', '2022-12-31 07:18:57'),
(636, 35, 1, '103.73.227.212', '2022-12-31 07:38:17', '2022-12-31 07:38:17'),
(637, 4, 1, '103.73.227.212', '2022-12-31 07:49:49', '2022-12-31 07:49:49'),
(640, 15, 1, '103.73.227.212', '2022-12-31 07:52:07', '2022-12-31 07:52:07'),
(641, 26, 1, '103.73.227.212', '2022-12-31 07:53:10', '2022-12-31 07:53:10'),
(643, 18, 39, '2409:4064:79b:cf52:e828:2d1e:741c:23e', '2022-12-31 08:19:09', '2022-12-31 08:19:09'),
(644, 3, 2, '2409:4072:8e9b:b053:a985:f2a4:b68a:d0b8', '2023-01-01 01:37:58', '2023-01-01 01:37:58'),
(646, 3, NULL, '37.111.129.4', '2023-01-02 05:41:20', '2023-01-02 05:41:20'),
(647, 3, NULL, '159.146.40.245', '2023-01-02 16:14:01', '2023-01-02 16:14:01'),
(648, 3, NULL, '119.160.59.233', '2023-01-02 23:42:00', '2023-01-02 23:42:00'),
(650, 14, NULL, '119.160.59.233', '2023-01-02 23:42:42', '2023-01-02 23:42:42'),
(651, 15, NULL, '187.213.132.185', '2023-01-03 10:45:19', '2023-01-03 10:45:19'),
(652, 20, NULL, '187.213.132.185', '2023-01-03 10:45:33', '2023-01-03 10:45:33'),
(654, 5, NULL, '187.213.132.185', '2023-01-03 10:51:01', '2023-01-03 10:51:01'),
(655, 27, NULL, '95.107.221.238', '2023-01-03 17:11:02', '2023-01-03 17:11:02'),
(660, 6, NULL, '103.73.227.212', '2023-01-04 00:25:11', '2023-01-04 00:25:11'),
(661, 25, NULL, '103.73.227.212', '2023-01-04 00:25:20', '2023-01-04 00:25:20'),
(666, 31, NULL, '103.73.227.212', '2023-01-04 00:26:25', '2023-01-04 00:26:25'),
(667, 33, NULL, '103.73.227.212', '2023-01-04 00:26:32', '2023-01-04 00:26:32'),
(668, 18, NULL, '103.73.227.212', '2023-01-04 00:27:07', '2023-01-04 00:27:07'),
(673, 32, NULL, '103.73.227.212', '2023-01-04 00:28:01', '2023-01-04 00:28:01'),
(675, 26, NULL, '103.73.227.212', '2023-01-04 00:28:25', '2023-01-04 00:28:25'),
(679, 15, NULL, '103.73.227.212', '2023-01-04 00:32:39', '2023-01-04 00:32:39'),
(684, 10, NULL, '103.73.227.212', '2023-01-04 00:33:45', '2023-01-04 00:33:45'),
(686, 24, NULL, '103.73.227.212', '2023-01-04 00:34:40', '2023-01-04 00:34:40'),
(688, 36, NULL, '103.73.227.212', '2023-01-04 00:35:02', '2023-01-04 00:35:02'),
(692, 27, NULL, '103.73.227.212', '2023-01-04 00:41:20', '2023-01-04 00:41:20'),
(694, 35, NULL, '103.73.227.212', '2023-01-04 00:46:14', '2023-01-04 00:46:14'),
(699, 4, NULL, '103.73.227.212', '2023-01-04 03:08:11', '2023-01-04 03:08:11'),
(700, 4, NULL, '37.111.147.39', '2023-01-04 14:06:34', '2023-01-04 14:06:34'),
(701, 4, NULL, '95.108.213.9', '2023-01-04 15:43:07', '2023-01-04 15:43:07'),
(703, 3, NULL, '2001:fb1:186:954b:71ed:d912:2ab7:f866', '2023-01-05 04:36:06', '2023-01-05 04:36:06'),
(704, 5, NULL, '87.20.68.129', '2023-01-05 06:14:55', '2023-01-05 06:14:55'),
(706, 3, NULL, '103.190.27.245', '2023-01-05 07:16:15', '2023-01-05 07:16:15'),
(707, 15, NULL, '84.143.43.53', '2023-01-05 09:28:48', '2023-01-05 09:28:48'),
(708, 26, NULL, '171.6.243.72', '2023-01-05 09:47:34', '2023-01-05 09:47:34'),
(709, 25, NULL, '171.6.243.72', '2023-01-05 09:49:39', '2023-01-05 09:49:39'),
(710, 24, NULL, '171.6.243.72', '2023-01-05 09:50:14', '2023-01-05 09:50:14'),
(711, 15, NULL, '171.6.243.72', '2023-01-05 09:51:49', '2023-01-05 09:51:49'),
(712, 4, NULL, '152.166.4.72', '2023-01-05 20:37:20', '2023-01-05 20:37:20'),
(717, 38, 1, '103.73.227.212', '2023-01-06 06:16:54', '2023-01-06 06:16:54'),
(718, 38, NULL, '37.111.212.157', '2023-01-06 06:18:17', '2023-01-06 06:18:17'),
(719, 38, NULL, '103.73.227.212', '2023-01-06 06:24:13', '2023-01-06 06:24:13'),
(721, 5, NULL, '103.190.27.245', '2023-01-06 06:36:56', '2023-01-06 06:36:56'),
(722, 38, NULL, '79.36.65.210', '2023-01-06 07:07:18', '2023-01-06 07:07:18'),
(723, 38, NULL, '171.6.243.72', '2023-01-06 09:18:46', '2023-01-06 09:18:46'),
(724, 14, 34, '41.75.187.27', '2023-01-06 11:14:52', '2023-01-06 11:14:52'),
(725, 18, 34, '41.75.187.27', '2023-01-06 11:15:12', '2023-01-06 11:15:12'),
(726, 35, 34, '41.75.187.27', '2023-01-06 11:15:42', '2023-01-06 11:15:42'),
(727, 6, 34, '41.75.187.27', '2023-01-06 11:16:29', '2023-01-06 11:16:29'),
(728, 4, NULL, '103.190.27.245', '2023-01-07 00:25:00', '2023-01-07 00:25:00'),
(729, 14, NULL, '2401:4900:12ca:d934:5448:c050:cba3:8e33', '2023-01-07 05:42:41', '2023-01-07 05:42:41'),
(730, 38, NULL, '91.207.102.154', '2023-01-07 22:35:55', '2023-01-07 22:35:55'),
(731, 36, NULL, '103.117.110.165', '2023-01-08 02:19:18', '2023-01-08 02:19:18'),
(732, 10, NULL, '122.164.80.210', '2023-01-08 05:01:05', '2023-01-08 05:01:05'),
(734, 8, NULL, '122.164.80.210', '2023-01-08 05:02:57', '2023-01-08 05:02:57'),
(735, 5, NULL, '122.164.80.210', '2023-01-08 05:03:27', '2023-01-08 05:03:27'),
(736, 4, NULL, '122.164.80.210', '2023-01-08 05:04:37', '2023-01-08 05:04:37'),
(737, 10, 42, '170.84.216.54', '2023-01-08 12:55:57', '2023-01-08 12:55:57'),
(738, 4, NULL, '46.106.133.100', '2023-01-09 16:42:06', '2023-01-09 16:42:06'),
(739, 3, NULL, '46.106.133.100', '2023-01-09 16:42:23', '2023-01-09 16:42:23'),
(740, 36, NULL, '46.106.133.100', '2023-01-09 16:43:04', '2023-01-09 16:43:04'),
(742, 6, NULL, '46.106.133.100', '2023-01-09 16:43:36', '2023-01-09 16:43:36'),
(743, 10, NULL, '109.75.54.130', '2023-01-09 17:37:33', '2023-01-09 17:37:33'),
(744, 3, NULL, '37.26.100.237', '2023-01-09 18:59:22', '2023-01-09 18:59:22'),
(745, 35, NULL, '207.237.122.247', '2023-01-09 19:06:54', '2023-01-09 19:06:54'),
(746, 8, NULL, '2804:7f3:f980:2797:7065:d551:7df6:fd58', '2023-01-09 19:36:21', '2023-01-09 19:36:21'),
(747, 4, NULL, '2409:4051:20c:f005:ad8a:c9b0:f008:e0c8', '2023-01-09 20:00:25', '2023-01-09 20:00:25'),
(748, 8, NULL, '170.246.186.17', '2023-01-09 20:11:31', '2023-01-09 20:11:31'),
(749, 10, NULL, '147.235.214.243', '2023-01-09 20:40:48', '2023-01-09 20:40:48'),
(750, 6, NULL, '2804:d59:a65b:9a00:85d1:cfc3:d555:d15c', '2023-01-09 20:46:46', '2023-01-09 20:46:46'),
(751, 21, NULL, '202.80.217.160', '2023-01-09 22:46:21', '2023-01-09 22:46:21'),
(752, 3, NULL, '2804:1d04:401:c9b:c011:e23a:5885:5b78', '2023-01-09 22:46:49', '2023-01-09 22:46:49'),
(753, 19, NULL, '196.202.214.93', '2023-01-09 23:16:52', '2023-01-09 23:16:52'),
(754, 36, NULL, '196.202.214.93', '2023-01-09 23:16:58', '2023-01-09 23:16:58'),
(755, 8, NULL, '103.217.210.56', '2023-01-09 23:48:22', '2023-01-09 23:48:22'),
(758, 22, NULL, '179.215.195.117', '2023-01-10 00:18:27', '2023-01-10 00:18:27'),
(759, 23, NULL, '146.112.47.230', '2023-01-10 00:50:39', '2023-01-10 00:50:39'),
(760, 21, NULL, '146.112.47.230', '2023-01-10 00:50:40', '2023-01-10 00:50:40'),
(762, 6, NULL, '98.58.204.180', '2023-01-10 03:33:51', '2023-01-10 03:33:51'),
(763, 24, NULL, '98.58.204.180', '2023-01-10 03:33:57', '2023-01-10 03:33:57'),
(764, 16, NULL, '98.58.204.180', '2023-01-10 03:34:23', '2023-01-10 03:34:23'),
(765, 22, NULL, '98.58.204.180', '2023-01-10 03:34:31', '2023-01-10 03:34:31'),
(766, 14, NULL, '98.58.204.180', '2023-01-10 03:34:35', '2023-01-10 03:34:35'),
(767, 16, NULL, '41.66.236.73', '2023-01-10 04:03:17', '2023-01-10 04:03:17'),
(768, 6, NULL, '109.136.104.17', '2023-01-10 04:11:07', '2023-01-10 04:11:07'),
(769, 18, NULL, '106.213.85.217', '2023-01-10 04:16:04', '2023-01-10 04:16:04'),
(770, 4, NULL, '24.133.84.251', '2023-01-10 04:36:55', '2023-01-10 04:36:55'),
(771, 37, NULL, '24.133.84.251', '2023-01-10 04:37:34', '2023-01-10 04:37:34'),
(772, 23, NULL, '24.133.84.251', '2023-01-10 04:37:47', '2023-01-10 04:37:47'),
(773, 8, NULL, '102.69.167.242', '2023-01-10 04:45:31', '2023-01-10 04:45:31'),
(774, 19, NULL, '213.181.119.34', '2023-01-10 05:10:40', '2023-01-10 05:10:40'),
(775, 5, NULL, '2a01:e0a:445:23d0:e41c:68d9:8498:8c3d', '2023-01-10 06:18:54', '2023-01-10 06:18:54'),
(777, 8, NULL, '49.207.181.111', '2023-01-10 06:22:03', '2023-01-10 06:22:03'),
(778, 35, NULL, '119.155.85.232', '2023-01-10 06:23:53', '2023-01-10 06:23:53'),
(779, 19, NULL, '104.28.211.105', '2023-01-10 06:31:13', '2023-01-10 06:31:13'),
(780, 10, NULL, '103.114.211.182', '2023-01-10 07:56:10', '2023-01-10 07:56:10'),
(781, 4, NULL, '138.255.108.176', '2023-01-10 07:57:42', '2023-01-10 07:57:42'),
(782, 3, NULL, '41.235.199.248', '2023-01-10 08:29:32', '2023-01-10 08:29:32'),
(783, 3, NULL, '173.77.201.5', '2023-01-10 08:35:26', '2023-01-10 08:35:26'),
(785, 22, NULL, '2a01:cb11:400:9500:b83b:c5a9:7dea:e618', '2023-01-10 08:54:04', '2023-01-10 08:54:04'),
(786, 6, NULL, '46.97.176.13', '2023-01-10 09:03:32', '2023-01-10 09:03:32'),
(787, 25, NULL, '46.97.176.13', '2023-01-10 09:03:46', '2023-01-10 09:03:46'),
(788, 14, NULL, '197.149.244.247', '2023-01-10 09:05:18', '2023-01-10 09:05:18'),
(789, 18, NULL, '203.192.225.105', '2023-01-10 10:24:27', '2023-01-10 10:24:27'),
(790, 21, NULL, '187.190.163.58', '2023-01-10 11:24:55', '2023-01-10 11:24:55'),
(791, 8, NULL, '168.194.104.96', '2023-01-10 12:17:02', '2023-01-10 12:17:02'),
(792, 3, NULL, '2403:6200:8861:1936:2018:fe59:8db8:550d', '2023-01-10 12:25:06', '2023-01-10 12:25:06'),
(794, 3, NULL, '171.5.222.48', '2023-01-10 12:26:46', '2023-01-10 12:26:46'),
(795, 18, NULL, '31.40.25.123', '2023-01-10 12:58:40', '2023-01-10 12:58:40'),
(796, 19, NULL, '45.231.153.44', '2023-01-10 13:13:42', '2023-01-10 13:13:42'),
(797, 19, NULL, '2600:1700:82a0:6f80:2568:3b53:8ba5:b630', '2023-01-10 13:14:11', '2023-01-10 13:14:11'),
(798, 4, NULL, '168.194.104.96', '2023-01-10 13:14:17', '2023-01-10 13:14:17'),
(800, 26, NULL, '168.194.104.96', '2023-01-10 13:15:03', '2023-01-10 13:15:03'),
(801, 35, NULL, '2.38.65.183', '2023-01-10 15:47:58', '2023-01-10 15:47:58'),
(802, 21, NULL, '2.38.65.183', '2023-01-10 15:48:07', '2023-01-10 15:48:07'),
(803, 8, NULL, '84.42.72.181', '2023-01-10 16:36:46', '2023-01-10 16:36:46'),
(804, 8, NULL, '85.106.116.96', '2023-01-10 17:41:43', '2023-01-10 17:41:43'),
(805, 4, NULL, '85.106.116.96', '2023-01-10 17:42:09', '2023-01-10 17:42:09'),
(806, 8, 2, '112.201.236.225', '2023-01-10 17:48:31', '2023-01-10 17:48:31'),
(807, 3, 43, '2803:3400:8:f929:1:1:646d:87d1', '2023-01-10 18:55:29', '2023-01-10 18:55:29'),
(809, 15, 43, '2803:3400:8:f929:1:1:646d:87d1', '2023-01-10 18:55:57', '2023-01-10 18:55:57'),
(810, 16, 43, '2803:3400:8:f929:1:1:646d:87d1', '2023-01-10 18:56:54', '2023-01-10 18:56:54'),
(811, 24, 43, '2803:3400:8:f929:1:1:646d:87d1', '2023-01-10 18:57:05', '2023-01-10 18:57:05'),
(812, 6, NULL, '27.156.220.183', '2023-01-10 21:03:42', '2023-01-10 21:03:42'),
(813, 8, NULL, '27.156.220.183', '2023-01-10 21:04:06', '2023-01-10 21:04:06'),
(814, 6, 2, '27.156.220.183', '2023-01-10 21:05:57', '2023-01-10 21:05:57'),
(815, 36, 2, '2804:14c:598d:85a3:1ba0:61ed:d43d:1786', '2023-01-10 22:02:01', '2023-01-10 22:02:01'),
(817, 6, NULL, '179.215.195.117', '2023-01-10 22:04:54', '2023-01-10 22:04:54'),
(818, 35, NULL, '182.186.9.130', '2023-01-10 23:09:27', '2023-01-10 23:09:27'),
(819, 3, NULL, '156.211.115.169', '2023-01-11 01:01:58', '2023-01-11 01:01:58'),
(820, 4, 34, '41.75.187.197', '2023-01-11 01:46:37', '2023-01-11 01:46:37'),
(821, 25, 34, '41.75.187.197', '2023-01-11 01:47:02', '2023-01-11 01:47:02'),
(822, 19, 34, '41.75.187.197', '2023-01-11 01:47:20', '2023-01-11 01:47:20'),
(823, 4, NULL, '179.215.195.117', '2023-01-11 02:50:26', '2023-01-11 02:50:26'),
(824, 3, NULL, '179.215.195.117', '2023-01-11 03:01:51', '2023-01-11 03:01:51'),
(825, 3, NULL, '95.70.146.54', '2023-01-11 03:10:56', '2023-01-11 03:10:56'),
(826, 4, NULL, '41.186.88.14', '2023-01-11 03:34:53', '2023-01-11 03:34:53'),
(827, 10, NULL, '103.255.37.37', '2023-01-11 03:38:47', '2023-01-11 03:38:47'),
(828, 4, NULL, '103.255.37.37', '2023-01-11 03:39:06', '2023-01-11 03:39:06'),
(829, 27, NULL, '103.255.37.37', '2023-01-11 03:39:13', '2023-01-11 03:39:13'),
(830, 16, NULL, '103.255.37.37', '2023-01-11 03:40:43', '2023-01-11 03:40:43'),
(831, 3, NULL, '46.99.60.129', '2023-01-11 03:41:11', '2023-01-11 03:41:11'),
(832, 4, NULL, '41.38.209.26', '2023-01-11 03:42:22', '2023-01-11 03:42:22'),
(833, 14, NULL, '105.98.59.236', '2023-01-11 06:27:54', '2023-01-11 06:27:54'),
(834, 3, NULL, '41.223.7.101', '2023-01-11 07:04:03', '2023-01-11 07:04:03'),
(835, 6, NULL, '5.45.207.153', '2023-01-11 10:12:33', '2023-01-11 10:12:33'),
(836, 19, NULL, '5.255.253.104', '2023-01-11 10:12:39', '2023-01-11 10:12:39'),
(837, 14, NULL, '5.45.207.153', '2023-01-11 10:12:42', '2023-01-11 10:12:42'),
(839, 22, NULL, '5.45.207.153', '2023-01-11 10:12:47', '2023-01-11 10:12:47'),
(841, 3, NULL, '5.45.207.153', '2023-01-11 10:12:55', '2023-01-11 10:12:55'),
(843, 8, NULL, '5.45.207.153', '2023-01-11 10:13:00', '2023-01-11 10:13:00'),
(844, 20, NULL, '5.45.207.153', '2023-01-11 10:15:47', '2023-01-11 10:15:47'),
(845, 25, NULL, '5.45.207.153', '2023-01-11 10:16:37', '2023-01-11 10:16:37'),
(846, 27, NULL, '5.45.207.153', '2023-01-11 10:17:26', '2023-01-11 10:17:26'),
(849, 8, NULL, '2804:d47:5d32:bb00:4a55:81a5:97a7:e23b', '2023-01-11 11:35:22', '2023-01-11 11:35:22'),
(850, 3, NULL, '189.13.174.253', '2023-01-11 11:38:43', '2023-01-11 11:38:43'),
(851, 6, NULL, '2401:4900:38f0:42ba:1d51:8acc:e618:e289', '2023-01-11 12:18:37', '2023-01-11 12:18:37'),
(852, 3, NULL, '2401:4900:38f0:42ba:1d51:8acc:e618:e289', '2023-01-11 12:19:05', '2023-01-11 12:19:05'),
(853, 4, NULL, '51.178.46.102', '2023-01-11 14:32:33', '2023-01-11 14:32:33'),
(855, 16, NULL, '116.71.9.20', '2023-01-11 15:08:58', '2023-01-11 15:08:58'),
(856, 5, NULL, '116.71.9.20', '2023-01-11 15:09:10', '2023-01-11 15:09:10'),
(857, 4, NULL, '116.71.9.20', '2023-01-11 15:09:25', '2023-01-11 15:09:25'),
(858, 3, NULL, '2620:10d:c099:200::1:c5d7', '2023-01-11 15:15:06', '2023-01-11 15:15:06'),
(859, 33, NULL, '2620:10d:c099:200::1:c5d7', '2023-01-11 15:16:04', '2023-01-11 15:16:04'),
(860, 5, NULL, '41.100.111.236', '2023-01-11 16:00:30', '2023-01-11 16:00:30'),
(861, 22, NULL, '31.173.85.99', '2023-01-11 16:10:16', '2023-01-11 16:10:16'),
(862, 5, NULL, '31.173.85.99', '2023-01-11 16:10:28', '2023-01-11 16:10:28'),
(864, 35, NULL, '94.205.198.12', '2023-01-11 17:50:54', '2023-01-11 17:50:54'),
(865, 6, NULL, '181.55.21.62', '2023-01-11 17:55:01', '2023-01-11 17:55:01'),
(867, 27, NULL, '5.91.175.84', '2023-01-11 18:50:42', '2023-01-11 18:50:42'),
(868, 5, NULL, '68.228.66.203', '2023-01-11 21:55:59', '2023-01-11 21:55:59'),
(880, 25, NULL, '2409:4064:4e9c:ee2f:cd21:4ba4:5065:cf69', '2023-01-11 22:14:25', '2023-01-11 22:14:25'),
(881, 26, NULL, '2409:4064:4e9c:ee2f:cd21:4ba4:5065:cf69', '2023-01-11 22:14:27', '2023-01-11 22:14:27'),
(882, 6, NULL, '103.204.69.138', '2023-01-12 01:45:47', '2023-01-12 01:45:47'),
(883, 4, 2, '103.204.69.138', '2023-01-12 01:49:45', '2023-01-12 01:49:45'),
(884, 27, NULL, '185.27.118.29', '2023-01-12 02:16:16', '2023-01-12 02:16:16'),
(885, 4, NULL, '185.27.118.29', '2023-01-12 02:16:26', '2023-01-12 02:16:26'),
(887, 5, NULL, '103.159.218.250', '2023-01-12 02:41:49', '2023-01-12 02:41:49'),
(891, 20, NULL, '103.159.218.250', '2023-01-12 02:43:12', '2023-01-12 02:43:12'),
(892, 6, NULL, '103.159.218.250', '2023-01-12 02:44:45', '2023-01-12 02:44:45'),
(893, 3, NULL, '176.59.168.44', '2023-01-12 11:26:46', '2023-01-12 11:26:46'),
(894, 3, NULL, '95.108.213.69', '2023-01-12 11:27:27', '2023-01-12 11:27:27'),
(895, 16, NULL, '5.45.207.153', '2023-01-12 11:27:48', '2023-01-12 11:27:48'),
(896, 11, NULL, '5.45.207.153', '2023-01-12 11:27:51', '2023-01-12 11:27:51'),
(897, 18, NULL, '5.45.207.153', '2023-01-12 11:27:54', '2023-01-12 11:27:54'),
(898, 13, NULL, '5.45.207.153', '2023-01-12 11:27:57', '2023-01-12 11:27:57'),
(899, 10, NULL, '5.45.207.153', '2023-01-12 11:28:00', '2023-01-12 11:28:00'),
(900, 15, NULL, '95.108.213.69', '2023-01-12 11:28:36', '2023-01-12 11:28:36'),
(901, 8, NULL, '95.108.213.69', '2023-01-12 11:28:38', '2023-01-12 11:28:38'),
(902, 27, NULL, '213.180.203.2', '2023-01-12 11:28:47', '2023-01-12 11:28:47'),
(903, 32, NULL, '5.45.207.153', '2023-01-12 11:28:49', '2023-01-12 11:28:49'),
(904, 19, NULL, '95.108.213.69', '2023-01-12 11:28:52', '2023-01-12 11:28:52'),
(905, 26, NULL, '5.45.207.153', '2023-01-12 11:28:56', '2023-01-12 11:28:56'),
(906, 4, NULL, '5.45.207.153', '2023-01-12 11:29:23', '2023-01-12 11:29:23'),
(907, 21, NULL, '95.108.213.69', '2023-01-12 11:29:25', '2023-01-12 11:29:25'),
(908, 35, NULL, '5.45.207.153', '2023-01-12 11:29:26', '2023-01-12 11:29:26'),
(909, 6, NULL, '95.108.213.69', '2023-01-12 11:29:28', '2023-01-12 11:29:28'),
(910, 33, NULL, '95.108.213.69', '2023-01-12 11:29:29', '2023-01-12 11:29:29'),
(911, 36, NULL, '95.108.213.69', '2023-01-12 11:29:31', '2023-01-12 11:29:31'),
(912, 24, NULL, '95.108.213.69', '2023-01-12 11:29:33', '2023-01-12 11:29:33'),
(913, 5, NULL, '5.45.207.153', '2023-01-12 11:29:36', '2023-01-12 11:29:36'),
(914, 37, NULL, '95.108.213.69', '2023-01-12 11:29:38', '2023-01-12 11:29:38'),
(915, 31, NULL, '95.108.213.69', '2023-01-12 11:29:40', '2023-01-12 11:29:40'),
(916, 34, NULL, '5.45.207.153', '2023-01-12 11:34:39', '2023-01-12 11:34:39'),
(917, 3, NULL, '45.173.201.27', '2023-01-12 11:36:51', '2023-01-12 11:36:51'),
(918, 3, NULL, '92.0.44.237', '2023-01-12 18:47:32', '2023-01-12 18:47:32'),
(919, 6, NULL, '102.165.57.193', '2023-01-12 21:21:26', '2023-01-12 21:21:26'),
(920, 3, NULL, '102.165.57.193', '2023-01-12 21:21:44', '2023-01-12 21:21:44'),
(921, 6, NULL, '115.98.215.216', '2023-01-13 03:02:59', '2023-01-13 03:02:59'),
(922, 14, NULL, '111.125.157.114', '2023-01-13 07:46:59', '2023-01-13 07:46:59'),
(923, 3, NULL, '111.125.157.114', '2023-01-13 08:08:44', '2023-01-13 08:08:44'),
(924, 6, 2, '111.125.157.114', '2023-01-13 08:22:27', '2023-01-13 08:22:27'),
(925, 4, 2, '2606:54c0:76e0:1258::e:292', '2023-01-13 10:44:49', '2023-01-13 10:44:49'),
(926, 27, 2, '2606:54c0:76e0:1258::e:292', '2023-01-13 10:45:06', '2023-01-13 10:45:06'),
(927, 3, NULL, '85.108.196.164', '2023-01-13 12:39:49', '2023-01-13 12:39:49'),
(928, 3, NULL, '104.28.204.78', '2023-01-13 12:58:01', '2023-01-13 12:58:01'),
(929, 8, 2, '114.31.131.222', '2023-01-13 13:19:31', '2023-01-13 13:19:31'),
(930, 4, 2, '114.31.131.222', '2023-01-13 13:19:52', '2023-01-13 13:19:52'),
(931, 3, 2, '114.31.131.222', '2023-01-13 13:20:02', '2023-01-13 13:20:02'),
(932, 26, 2, '114.31.131.222', '2023-01-13 13:20:14', '2023-01-13 13:20:14'),
(933, 37, 2, '114.31.131.222', '2023-01-13 13:21:03', '2023-01-13 13:21:03'),
(934, 4, NULL, '185.93.225.74', '2023-01-13 13:36:50', '2023-01-13 13:36:50'),
(935, 5, NULL, '171.5.234.7', '2023-01-13 13:37:24', '2023-01-13 13:37:24'),
(936, 36, NULL, '88.224.131.9', '2023-01-13 14:33:39', '2023-01-13 14:33:39'),
(940, 32, NULL, '2401:4900:2eed:2ee5:a5f4:f2c6:423b:b184', '2023-01-13 17:54:06', '2023-01-13 17:54:06'),
(941, 27, NULL, '2401:4900:2eed:2ee5:a5f4:f2c6:423b:b184', '2023-01-13 17:54:30', '2023-01-13 17:54:30'),
(942, 4, NULL, '2401:4900:2eed:2ee5:a5f4:f2c6:423b:b184', '2023-01-13 17:54:36', '2023-01-13 17:54:36'),
(943, 6, NULL, '2401:4900:2eed:2ee5:a5f4:f2c6:423b:b184', '2023-01-13 18:23:17', '2023-01-13 18:23:17'),
(944, 5, NULL, '2401:4900:2eed:2ee5:a5f4:f2c6:423b:b184', '2023-01-13 18:23:42', '2023-01-13 18:23:42'),
(945, 19, NULL, '2401:4900:2eed:2ee5:a5f4:f2c6:423b:b184', '2023-01-13 18:23:49', '2023-01-13 18:23:49'),
(946, 15, NULL, '2401:4900:2eed:2ee5:a5f4:f2c6:423b:b184', '2023-01-13 18:24:08', '2023-01-13 18:24:08'),
(947, 8, NULL, '140.213.159.179', '2023-01-13 22:46:02', '2023-01-13 22:46:02'),
(948, 13, NULL, '140.213.159.179', '2023-01-13 22:46:53', '2023-01-13 22:46:53'),
(950, 20, NULL, '140.213.159.179', '2023-01-13 22:48:54', '2023-01-13 22:48:54'),
(951, 18, NULL, '140.213.159.179', '2023-01-13 22:49:12', '2023-01-13 22:49:12'),
(952, 19, NULL, '140.213.159.179', '2023-01-13 22:49:40', '2023-01-13 22:49:40'),
(953, 16, NULL, '140.213.159.179', '2023-01-13 22:49:49', '2023-01-13 22:49:49'),
(954, 6, NULL, '140.213.159.179', '2023-01-13 23:33:47', '2023-01-13 23:33:47'),
(956, 22, NULL, '140.213.159.179', '2023-01-13 23:34:26', '2023-01-13 23:34:26'),
(957, 14, NULL, '140.213.159.179', '2023-01-13 23:34:33', '2023-01-13 23:34:33'),
(958, 4, NULL, '61.94.52.184', '2023-01-14 00:41:58', '2023-01-14 00:41:58'),
(959, 5, NULL, '61.94.52.184', '2023-01-14 00:42:42', '2023-01-14 00:42:42'),
(960, 25, 2, '41.41.48.227', '2023-01-14 03:27:23', '2023-01-14 03:27:23'),
(961, 4, NULL, '192.145.168.71', '2023-01-14 04:22:27', '2023-01-14 04:22:27'),
(962, 8, NULL, '192.145.168.71', '2023-01-14 04:30:57', '2023-01-14 04:30:57'),
(963, 4, NULL, '185.247.164.166', '2023-01-14 05:35:24', '2023-01-14 05:35:24'),
(964, 8, NULL, '62.211.159.53', '2023-01-14 07:39:36', '2023-01-14 07:39:36'),
(965, 15, 2, '102.81.247.174', '2023-01-14 09:43:44', '2023-01-14 09:43:44'),
(966, 36, NULL, '69.120.104.156', '2023-01-14 11:58:19', '2023-01-14 11:58:19'),
(967, 4, NULL, '159.69.67.227', '2023-01-14 12:44:17', '2023-01-14 12:44:17'),
(968, 13, NULL, '186.118.78.22', '2023-01-14 17:34:41', '2023-01-14 17:34:41'),
(969, 3, NULL, '2804:4914:8001:b782:79da:a7b7:6994:afa1', '2023-01-14 18:54:49', '2023-01-14 18:54:49'),
(970, 21, NULL, '2607:fb90:20d4:1757:5ccf:4c47:b9bd:a568', '2023-01-14 22:47:22', '2023-01-14 22:47:22'),
(971, 8, 2, '78.186.104.47', '2023-01-14 23:02:07', '2023-01-14 23:02:07'),
(973, 3, NULL, '2804:37a4:301:ef9b:1985:6c0e:2399:4032', '2023-01-14 23:31:09', '2023-01-14 23:31:09'),
(974, 15, NULL, '2804:37a4:301:ef9b:1985:6c0e:2399:4032', '2023-01-14 23:45:47', '2023-01-14 23:45:47'),
(975, 36, NULL, '62.231.72.130', '2023-01-14 23:57:01', '2023-01-14 23:57:01'),
(976, 3, NULL, '62.231.72.130', '2023-01-14 23:57:30', '2023-01-14 23:57:30'),
(978, 6, 2, '119.13.57.65', '2023-01-15 03:14:09', '2023-01-15 03:14:09'),
(979, 4, NULL, '103.135.138.136', '2023-01-15 06:21:57', '2023-01-15 06:21:57'),
(980, 4, NULL, '196.129.193.104', '2023-01-15 09:16:21', '2023-01-15 09:16:21'),
(981, 21, NULL, '190.87.166.92', '2023-01-15 09:25:12', '2023-01-15 09:25:12'),
(982, 35, NULL, '190.87.166.92', '2023-01-15 09:25:18', '2023-01-15 09:25:18'),
(983, 35, 2, '190.87.166.92', '2023-01-15 09:29:37', '2023-01-15 09:29:37'),
(984, 3, NULL, '190.87.166.92', '2023-01-15 09:43:25', '2023-01-15 09:43:25'),
(985, 6, NULL, '46.10.148.219', '2023-01-15 10:57:57', '2023-01-15 10:57:57'),
(986, 8, NULL, '186.7.33.155', '2023-01-15 11:11:53', '2023-01-15 11:11:53'),
(987, 35, 2, '144.48.176.71', '2023-01-15 14:04:23', '2023-01-15 14:04:23'),
(988, 4, NULL, '78.180.0.208', '2023-01-15 15:51:55', '2023-01-15 15:51:55'),
(989, 3, NULL, '78.180.0.208', '2023-01-15 15:52:07', '2023-01-15 15:52:07'),
(990, 6, 2, '2401:4900:b8f:6b36:89fe:eb76:276b:9aeb', '2023-01-15 17:29:50', '2023-01-15 17:29:50'),
(991, 36, NULL, '78.182.137.157', '2023-01-15 18:30:21', '2023-01-15 18:30:21'),
(992, 5, NULL, '122.161.243.69', '2023-01-16 01:15:13', '2023-01-16 01:15:13'),
(993, 18, NULL, '37.130.105.240', '2023-01-16 01:22:17', '2023-01-16 01:22:17'),
(994, 4, NULL, '37.130.105.240', '2023-01-16 01:22:52', '2023-01-16 01:22:52'),
(995, 4, NULL, '2001:448a:70af:47a3:8cfc:407c:ede0:65b', '2023-01-16 02:22:57', '2023-01-16 02:22:57'),
(996, 27, NULL, '2001:448a:70af:47a3:8cfc:407c:ede0:65b', '2023-01-16 02:23:10', '2023-01-16 02:23:10'),
(997, 8, NULL, '2001:448a:70af:47a3:8cfc:407c:ede0:65b', '2023-01-16 02:23:30', '2023-01-16 02:23:30'),
(998, 36, NULL, '197.210.226.102', '2023-01-16 02:46:57', '2023-01-16 02:46:57'),
(999, 15, NULL, '197.210.55.178', '2023-01-16 02:47:15', '2023-01-16 02:47:15'),
(1000, 4, NULL, '152.32.104.201', '2023-01-16 03:58:07', '2023-01-16 03:58:07'),
(1001, 8, NULL, '84.54.70.68', '2023-01-16 05:25:27', '2023-01-16 05:25:27'),
(1002, 16, NULL, '2003:e8:746:637:88ee:fca6:3bf2:74e5', '2023-01-16 09:16:16', '2023-01-16 09:16:16'),
(1003, 25, NULL, '94.122.157.89', '2023-01-16 11:45:21', '2023-01-16 11:45:21'),
(1004, 22, 2, '94.122.157.89', '2023-01-16 11:47:16', '2023-01-16 11:47:16'),
(1005, 8, 2, '91.106.36.181', '2023-01-16 14:27:40', '2023-01-16 14:27:40'),
(1006, 6, NULL, '123.21.207.116', '2023-01-16 15:08:06', '2023-01-16 15:08:06'),
(1007, 19, NULL, '197.248.101.122', '2023-01-16 15:18:43', '2023-01-16 15:18:43'),
(1008, 3, NULL, '197.248.101.122', '2023-01-16 15:18:50', '2023-01-16 15:18:50'),
(1009, 4, NULL, '95.107.221.238', '2023-01-16 17:15:12', '2023-01-16 17:15:12'),
(1010, 26, NULL, '122.162.195.153', '2023-01-16 23:00:42', '2023-01-16 23:00:42'),
(1011, 8, NULL, '122.162.195.153', '2023-01-16 23:14:18', '2023-01-16 23:14:18'),
(1012, 27, NULL, '2601:c4:4080:480:eca0:cdb6:bb21:3bdc', '2023-01-17 00:13:31', '2023-01-17 00:13:31'),
(1013, 37, NULL, '185.191.171.19', '2023-01-17 03:21:24', '2023-01-17 03:21:24'),
(1014, 15, NULL, '185.191.171.39', '2023-01-17 03:49:58', '2023-01-17 03:49:58'),
(1015, 4, NULL, '185.191.171.3', '2023-01-17 04:21:13', '2023-01-17 04:21:13'),
(1016, 26, NULL, '185.191.171.39', '2023-01-17 05:20:57', '2023-01-17 05:20:57'),
(1017, 21, NULL, '185.191.171.36', '2023-01-17 06:34:11', '2023-01-17 06:34:11'),
(1018, 18, NULL, '185.191.171.1', '2023-01-17 07:16:56', '2023-01-17 07:16:56'),
(1019, 11, NULL, '185.191.171.24', '2023-01-17 07:59:43', '2023-01-17 07:59:43'),
(1021, 27, NULL, '2409:4071:d1f:832e:cc9d:b0a7:c860:a66c', '2023-01-17 08:13:25', '2023-01-17 08:13:25'),
(1022, 13, NULL, '2409:4071:d1f:832e:cc9d:b0a7:c860:a66c', '2023-01-17 08:13:45', '2023-01-17 08:13:45'),
(1023, 15, NULL, '94.121.161.137', '2023-01-17 10:43:38', '2023-01-17 10:43:38'),
(1024, 5, NULL, '185.191.171.33', '2023-01-17 12:34:31', '2023-01-17 12:34:31'),
(1025, 22, NULL, '185.191.171.9', '2023-01-17 12:41:04', '2023-01-17 12:41:04'),
(1026, 32, NULL, '185.191.171.11', '2023-01-17 13:44:42', '2023-01-17 13:44:42'),
(1027, 20, NULL, '185.191.171.40', '2023-01-17 13:48:13', '2023-01-17 13:48:13'),
(1028, 4, NULL, '186.148.94.6', '2023-01-17 15:12:00', '2023-01-17 15:12:00'),
(1029, 8, NULL, '186.148.94.6', '2023-01-17 15:12:53', '2023-01-17 15:12:53'),
(1030, 25, NULL, '185.191.171.16', '2023-01-17 16:21:31', '2023-01-17 16:21:31'),
(1031, 3, NULL, '185.191.171.37', '2023-01-17 16:54:14', '2023-01-17 16:54:14'),
(1032, 16, NULL, '185.191.171.17', '2023-01-17 18:05:37', '2023-01-17 18:05:37'),
(1033, 23, NULL, '185.191.171.37', '2023-01-17 18:22:43', '2023-01-17 18:22:43'),
(1034, 24, NULL, '185.191.171.42', '2023-01-17 18:30:25', '2023-01-17 18:30:25'),
(1035, 10, NULL, '185.191.171.4', '2023-01-17 23:59:07', '2023-01-17 23:59:07'),
(1036, 19, NULL, '185.191.171.12', '2023-01-18 01:12:34', '2023-01-18 01:12:34'),
(1037, 35, NULL, '185.191.171.37', '2023-01-18 01:40:09', '2023-01-18 01:40:09'),
(1038, 6, NULL, '185.191.171.34', '2023-01-18 02:42:03', '2023-01-18 02:42:03'),
(1039, 31, NULL, '136.228.173.132', '2023-01-18 03:54:07', '2023-01-18 03:54:07'),
(1040, 15, NULL, '136.228.173.132', '2023-01-18 03:54:20', '2023-01-18 03:54:20'),
(1041, 6, NULL, '136.228.173.132', '2023-01-18 03:54:36', '2023-01-18 03:54:36'),
(1042, 18, 2, '41.141.235.91', '2023-01-18 03:57:05', '2023-01-18 03:57:05'),
(1043, 15, NULL, '36.69.112.137', '2023-01-18 06:32:03', '2023-01-18 06:32:03'),
(1044, 8, NULL, '185.191.171.45', '2023-01-18 07:08:06', '2023-01-18 07:08:06'),
(1045, 21, NULL, '2001:9e8:6117:de00:58aa:ee3f:df34:f63e', '2023-01-18 07:27:12', '2023-01-18 07:27:12'),
(1046, 14, NULL, '2001:9e8:6117:de00:58aa:ee3f:df34:f63e', '2023-01-18 07:27:37', '2023-01-18 07:27:37'),
(1047, 36, NULL, '185.191.171.36', '2023-01-18 08:11:12', '2023-01-18 08:11:12'),
(1048, 27, NULL, '185.191.171.23', '2023-01-18 08:45:40', '2023-01-18 08:45:40'),
(1049, 34, NULL, '185.191.171.7', '2023-01-18 09:11:23', '2023-01-18 09:11:23'),
(1050, 4, NULL, '79.152.134.125', '2023-01-18 09:27:27', '2023-01-18 09:27:27'),
(1051, 33, NULL, '185.191.171.10', '2023-01-18 10:31:41', '2023-01-18 10:31:41'),
(1052, 5, NULL, '178.51.199.225', '2023-01-18 12:38:47', '2023-01-18 12:38:47'),
(1053, 13, NULL, '185.191.171.37', '2023-01-18 13:07:26', '2023-01-18 13:07:26'),
(1054, 14, NULL, '185.191.171.20', '2023-01-18 13:20:42', '2023-01-18 13:20:42'),
(1055, 37, NULL, '37.221.6.88', '2023-01-18 15:02:21', '2023-01-18 15:02:21'),
(1056, 19, NULL, '37.221.6.88', '2023-01-18 15:03:27', '2023-01-18 15:03:27'),
(1057, 22, NULL, '2806:2f0:9020:a5d8:14ad:2c49:3aa0:b2ec', '2023-01-18 15:35:53', '2023-01-18 15:35:53'),
(1058, 31, NULL, '185.191.171.43', '2023-01-18 16:00:21', '2023-01-18 16:00:21'),
(1059, 3, NULL, '188.132.247.72', '2023-01-18 16:12:37', '2023-01-18 16:12:37'),
(1060, 31, NULL, '188.132.247.72', '2023-01-18 16:12:49', '2023-01-18 16:12:49'),
(1061, 3, 2, '2a0c:5a80:e312:8c00:911b:1cd8:1fe5:3f22', '2023-01-18 18:54:35', '2023-01-18 18:54:35'),
(1062, 14, NULL, '2a01:4f9:c010:6cc0::1', '2023-01-19 01:57:39', '2023-01-19 01:57:39'),
(1064, 3, NULL, '2a01:4f9:c010:6cc0::1', '2023-01-19 01:58:07', '2023-01-19 01:58:07'),
(1065, 8, NULL, '84.51.16.162', '2023-01-19 02:19:49', '2023-01-19 02:19:49'),
(1066, 6, NULL, '84.51.16.162', '2023-01-19 02:24:27', '2023-01-19 02:24:27'),
(1067, 36, NULL, '84.51.16.162', '2023-01-19 02:24:33', '2023-01-19 02:24:33'),
(1068, 32, NULL, '84.51.16.162', '2023-01-19 02:24:47', '2023-01-19 02:24:47'),
(1069, 34, NULL, '84.51.16.162', '2023-01-19 02:24:53', '2023-01-19 02:24:53'),
(1070, 4, NULL, '102.88.35.72', '2023-01-19 07:31:21', '2023-01-19 07:31:21'),
(1071, 4, NULL, '180.190.102.174', '2023-01-19 10:00:12', '2023-01-19 10:00:12'),
(1072, 14, NULL, '180.190.102.174', '2023-01-19 10:01:06', '2023-01-19 10:01:06'),
(1073, 3, NULL, '180.190.102.174', '2023-01-19 10:02:05', '2023-01-19 10:02:05'),
(1074, 4, NULL, '41.129.12.135', '2023-01-19 20:34:26', '2023-01-19 20:34:26'),
(1075, 11, NULL, '2a02:6b8:c14:3704:0:492c:f8d8:0', '2023-01-20 07:14:07', '2023-01-20 07:14:07'),
(1076, 14, NULL, '2a02:6b8:c0c:1291:0:492c:3845:0', '2023-01-20 07:14:41', '2023-01-20 07:14:41'),
(1077, 16, NULL, '95.108.213.131', '2023-01-20 07:14:41', '2023-01-20 07:14:41');
INSERT INTO `video_views` (`id`, `video_id`, `user_id`, `ip_address`, `created_at`, `updated_at`) VALUES
(1078, 20, NULL, '213.180.203.173', '2023-01-20 07:14:41', '2023-01-20 07:14:41'),
(1079, 24, NULL, '2a02:6b8:c08:10a7:0:492c:96a7:0', '2023-01-20 07:14:42', '2023-01-20 07:14:42'),
(1080, 3, NULL, '2a02:6b8:c1f:d8e:0:492c:8a60:0', '2023-01-20 07:14:44', '2023-01-20 07:14:44'),
(1082, 27, NULL, '2001:9e8:cee5:ff00:dd79:7d94:549f:acc3', '2023-01-20 10:27:18', '2023-01-20 10:27:18'),
(1083, 34, NULL, '2001:9e8:cee5:ff00:dd79:7d94:549f:acc3', '2023-01-20 10:27:25', '2023-01-20 10:27:25'),
(1084, 4, NULL, '2001:9e8:cee5:ff00:dd79:7d94:549f:acc3', '2023-01-20 10:28:00', '2023-01-20 10:28:00'),
(1085, 8, 48, '2001:9e8:cee5:ff00:dd79:7d94:549f:acc3', '2023-01-20 10:37:27', '2023-01-20 10:37:27'),
(1088, 16, 48, '2001:9e8:cee5:ff00:dd79:7d94:549f:acc3', '2023-01-20 10:44:58', '2023-01-20 10:44:58'),
(1089, 11, 48, '2001:9e8:cee5:ff00:dd79:7d94:549f:acc3', '2023-01-20 10:45:04', '2023-01-20 10:45:04'),
(1090, 13, 48, '2001:9e8:cee5:ff00:dd79:7d94:549f:acc3', '2023-01-20 10:45:10', '2023-01-20 10:45:10'),
(1091, 26, 48, '2001:9e8:cee5:ff00:dd79:7d94:549f:acc3', '2023-01-20 10:45:27', '2023-01-20 10:45:27'),
(1092, 22, 48, '2001:9e8:cee5:ff00:dd79:7d94:549f:acc3', '2023-01-20 10:45:43', '2023-01-20 10:45:43'),
(1094, 4, NULL, '2a02:4e0:2d89:c0:6892:8644:69e4:fbc8', '2023-01-20 11:00:27', '2023-01-20 11:00:27'),
(1095, 10, NULL, '2a02:4e0:2d89:c0:6892:8644:69e4:fbc8', '2023-01-20 11:01:00', '2023-01-20 11:01:00'),
(1096, 37, NULL, '2a02:4e0:2d89:c0:6892:8644:69e4:fbc8', '2023-01-20 11:01:02', '2023-01-20 11:01:02'),
(1098, 22, 49, '103.103.214.104', '2023-01-20 15:27:15', '2023-01-20 15:27:15'),
(1101, 27, 49, '103.103.214.104', '2023-01-20 15:28:15', '2023-01-20 15:28:15'),
(1102, 35, 49, '103.103.214.104', '2023-01-20 15:28:29', '2023-01-20 15:28:29'),
(1103, 3, 49, '103.103.214.104', '2023-01-20 15:29:36', '2023-01-20 15:29:36'),
(1104, 15, 49, '103.103.214.104', '2023-01-20 15:29:52', '2023-01-20 15:29:52'),
(1105, 10, 49, '103.103.214.104', '2023-01-20 15:30:03', '2023-01-20 15:30:03'),
(1106, 4, 49, '103.103.214.104', '2023-01-20 15:30:13', '2023-01-20 15:30:13'),
(1107, 21, NULL, '140.213.134.86', '2023-01-21 05:22:39', '2023-01-21 05:22:39'),
(1108, 34, NULL, '140.213.134.86', '2023-01-21 05:23:02', '2023-01-21 05:23:02'),
(1110, 33, NULL, '154.160.24.32', '2023-01-21 08:33:56', '2023-01-21 08:33:56'),
(1111, 6, NULL, '41.92.57.208', '2023-01-21 16:43:54', '2023-01-21 16:43:54'),
(1113, 3, NULL, '41.92.57.208', '2023-01-21 17:02:29', '2023-01-21 17:02:29'),
(1114, 16, NULL, '213.254.88.133', '2023-01-21 17:10:49', '2023-01-21 17:10:49'),
(1115, 3, NULL, '196.155.7.86', '2023-01-22 01:27:57', '2023-01-22 01:27:57'),
(1116, 3, NULL, '103.73.227.212', '2023-01-22 01:37:05', '2023-01-22 01:37:05'),
(1117, 14, NULL, '103.73.227.212', '2023-01-22 01:37:15', '2023-01-22 01:37:15'),
(1118, 5, NULL, '103.73.227.212', '2023-01-22 01:37:21', '2023-01-22 01:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `web_ads`
--

CREATE TABLE `web_ads` (
  `id` bigint UNSIGNED NOT NULL,
  `ad_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('on','off') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ad_link` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `ad_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_per_video_category` int DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disable_desktop` enum('on','off') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desktop_adsense` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disable_tablet_landscape` enum('on','off') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tablet_landscape_adsense` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disable_tablet_portrait` enum('on','off') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tablet_portrait_adsense` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disable_phone` enum('on','off') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_adsense` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_ads`
--

INSERT INTO `web_ads` (`id`, `ad_type`, `status`, `ad_link`, `ad_title`, `show_per_video_category`, `image`, `disable_desktop`, `desktop_adsense`, `disable_tablet_landscape`, `tablet_landscape_adsense`, `disable_tablet_portrait`, `tablet_portrait_adsense`, `disable_phone`, `phone_adsense`, `created_at`, `updated_at`) VALUES
(1, 'header', 'on', NULL, NULL, NULL, NULL, 'off', '0', 'off', '0', 'off', '0', 'off', '0', '2022-11-09 06:24:03', '2022-11-09 06:24:03'),
(2, 'after_category', 'on', NULL, NULL, NULL, NULL, 'off', '0', 'off', '0', 'off', '0', 'off', '0', '2022-11-09 06:24:03', '2022-11-09 06:24:03'),
(3, 'native_like', 'on', NULL, NULL, NULL, NULL, 'off', NULL, 'off', NULL, 'off', NULL, 'off', NULL, '2022-11-09 06:24:03', '2022-11-09 06:24:03'),
(4, 'native_series', 'on', NULL, NULL, NULL, NULL, 'off', NULL, 'off', NULL, 'off', NULL, 'off', NULL, '2022-11-09 06:24:03', '2022-11-09 06:24:03'),
(5, 'popup', 'on', 'https://www.cricbuzz.com/', NULL, 3, '1667988246.singer.jpeg', 'off', NULL, 'off', NULL, 'off', NULL, 'off', NULL, '2022-11-09 06:24:03', '2022-11-09 06:24:03'),
(6, 'custom_header', 'off', NULL, NULL, NULL, '1667042888.videoTopBanner.png', 'off', NULL, 'off', NULL, 'off', NULL, 'off', NULL, '2022-11-09 06:24:03', '2022-11-09 06:24:03'),
(7, 'custom_after_category', 'off', NULL, NULL, NULL, NULL, 'off', NULL, 'off', NULL, 'off', NULL, 'off', NULL, '2022-11-09 06:24:03', '2022-11-09 06:24:03'),
(8, 'custom_native_like', 'off', NULL, NULL, NULL, NULL, 'off', NULL, 'off', NULL, 'off', NULL, 'off', NULL, '2022-11-09 06:24:03', '2022-11-09 06:24:03'),
(9, 'custom_native_series', 'off', NULL, NULL, NULL, NULL, 'off', NULL, 'off', NULL, 'off', NULL, 'off', NULL, '2022-11-09 06:24:03', '2022-11-09 06:24:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artist_types`
--
ALTER TABLE `artist_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `celebrities`
--
ALTER TABLE `celebrities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `celebrity_types`
--
ALTER TABLE `celebrity_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `episods`
--
ALTER TABLE `episods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favorite_videos`
--
ALTER TABLE `favorite_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forgot_password_codes`
--
ALTER TABLE `forgot_password_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forgot_password_requests`
--
ALTER TABLE `forgot_password_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imdb_keys`
--
ALTER TABLE `imdb_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_notifications`
--
ALTER TABLE `manage_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_medially_type_medially_id_index` (`medially_type`,`medially_id`);

--
-- Indexes for table `mgt_statuses`
--
ALTER TABLE `mgt_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_ads`
--
ALTER TABLE `mobile_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_subscribers`
--
ALTER TABLE `package_subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_gatways`
--
ALTER TABLE `payment_gatways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_movies`
--
ALTER TABLE `request_movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serieses`
--
ALTER TABLE `serieses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `series_categories`
--
ALTER TABLE `series_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smtp_settings`
--
ALTER TABLE `smtp_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top_features`
--
ALTER TABLE `top_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tv_channels`
--
ALTER TABLE `tv_channels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tv_channel_categories`
--
ALTER TABLE `tv_channel_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_verifications`
--
ALTER TABLE `user_verifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_settings`
--
ALTER TABLE `video_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_views`
--
ALTER TABLE `video_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_ads`
--
ALTER TABLE `web_ads`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artist_types`
--
ALTER TABLE `artist_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `celebrities`
--
ALTER TABLE `celebrities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `celebrity_types`
--
ALTER TABLE `celebrity_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `episods`
--
ALTER TABLE `episods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorite_videos`
--
ALTER TABLE `favorite_videos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `forgot_password_codes`
--
ALTER TABLE `forgot_password_codes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forgot_password_requests`
--
ALTER TABLE `forgot_password_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `imdb_keys`
--
ALTER TABLE `imdb_keys`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `manage_notifications`
--
ALTER TABLE `manage_notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mgt_statuses`
--
ALTER TABLE `mgt_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `mobile_ads`
--
ALTER TABLE `mobile_ads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `package_subscribers`
--
ALTER TABLE `package_subscribers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payment_gatways`
--
ALTER TABLE `payment_gatways`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request_movies`
--
ALTER TABLE `request_movies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `serieses`
--
ALTER TABLE `serieses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `series_categories`
--
ALTER TABLE `series_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smtp_settings`
--
ALTER TABLE `smtp_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `supports`
--
ALTER TABLE `supports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `top_features`
--
ALTER TABLE `top_features`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tv_channels`
--
ALTER TABLE `tv_channels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tv_channel_categories`
--
ALTER TABLE `tv_channel_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_verifications`
--
ALTER TABLE `user_verifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `video_settings`
--
ALTER TABLE `video_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `video_views`
--
ALTER TABLE `video_views`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1119;

--
-- AUTO_INCREMENT for table `web_ads`
--
ALTER TABLE `web_ads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
