-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2022 at 11:26 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estern`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing_infos`
--

CREATE TABLE `billing_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billing_infos`
--

INSERT INTO `billing_infos` (`id`, `order_id`, `customer_name`, `customer_phone`, `customer_address`, `created_at`, `updated_at`) VALUES
(1, 1, 'aminur', '01772119941', '113/c/3/a/1 , west shewora para mirpur dhaka', '2021-03-18 06:21:43', '2021-03-18 06:21:43'),
(2, 2, 'raju', '01911909871', '113/c/3/a/1 , west shewora para mirpur dhaka', '2021-05-25 04:29:49', '2021-05-25 04:29:49'),
(3, 4, 'Rasel Rana', '01744460010', 'Mirpur-1', '2021-05-26 02:08:35', '2021-05-26 02:08:35'),
(4, 5, 'cxc', 'cxc', 'xccx', '2021-12-13 04:08:49', '2021-12-13 04:08:49');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `brand_image`, `created_at`, `updated_at`) VALUES
(1, 'Apple', '66851.jpg', '2021-02-28 01:37:37', '2021-03-07 04:10:28'),
(2, 'Samsung', '92942.png', '2021-02-28 01:37:48', '2021-03-07 04:35:34'),
(4, 'Xaomi', '41277.png', '2021-02-28 06:11:34', '2021-03-07 04:35:48'),
(5, 'Sony', '32391.jpg', '2021-03-06 03:34:22', '2021-03-07 04:35:09'),
(6, 'SKMEI', NULL, '2021-03-06 04:37:38', '2021-03-06 04:37:38'),
(7, 'NAVIFORCE', NULL, '2021-03-06 04:37:53', '2021-03-06 04:37:53'),
(8, 'My Choice Watch', NULL, '2021-03-06 04:38:11', '2021-03-06 04:38:11'),
(9, 'CURREN', NULL, '2021-03-06 04:38:22', '2021-03-06 04:38:22'),
(10, 'CURREN BD', NULL, '2021-03-06 04:38:46', '2021-03-06 04:38:46'),
(11, 'Sikder Shop', NULL, '2021-03-06 04:39:15', '2021-03-06 04:39:15'),
(12, 'Wholesale Shop', NULL, '2021-03-06 04:39:53', '2021-03-06 04:39:53'),
(13, 'Kiss Beauties BD Women', NULL, '2021-03-06 04:41:27', '2021-03-06 04:41:27'),
(14, 'Ebuy', NULL, '2021-03-06 04:41:50', '2021-03-06 04:41:50'),
(15, 'Ajker Shop', NULL, '2021-03-06 04:42:05', '2021-03-06 04:42:05'),
(16, 'FlyBuy', NULL, '2021-03-06 04:42:23', '2021-03-06 04:42:23'),
(17, 'Omar Mart', '4688.png', '2021-03-06 04:42:41', '2021-03-08 01:34:04'),
(18, 'eHub', NULL, '2021-03-06 04:42:52', '2021-03-06 04:42:52'),
(19, 'Chinese', NULL, '2021-03-06 04:43:18', '2021-03-06 04:43:18'),
(20, 'Great Buy', NULL, '2021-03-06 04:43:41', '2021-03-06 04:43:41'),
(21, 'ALIF LEATHER CORNER Belts', NULL, '2021-03-06 04:44:33', '2021-03-06 04:44:33'),
(22, 'Best Leather LTD Belts', NULL, '2021-03-06 04:44:44', '2021-03-06 04:44:44'),
(23, 'Hira Jory Mahol Belts', NULL, '2021-03-06 04:44:57', '2021-03-06 04:44:57'),
(24, 'Belt & Wallet Gallery Belts', NULL, '2021-03-06 04:45:14', '2021-03-06 04:45:14'),
(25, 'Belt World Belts', NULL, '2021-03-06 04:45:35', '2021-03-06 04:45:35'),
(26, 'BEST COLLECTIONS BD', NULL, '2021-03-06 04:45:53', '2021-03-06 04:45:53'),
(27, 'Honest Belts', NULL, '2021-03-06 04:46:12', '2021-03-06 04:46:12'),
(28, 'LouisWill', NULL, '2021-03-06 04:46:39', '2021-03-06 04:46:39'),
(29, 'Arman Optics', NULL, '2021-03-06 04:46:51', '2021-03-06 04:46:51'),
(30, 'Grand Mart Optics', NULL, '2021-03-06 04:47:09', '2021-03-06 04:47:09'),
(31, 'Happy Shooping', NULL, '2021-03-06 04:47:26', '2021-03-06 04:47:26'),
(32, 'Bhuiyan Optics', NULL, '2021-03-06 04:48:07', '2021-03-06 04:48:07'),
(33, 'NEW PUPIL OPTICS', '96422.jpg', '2021-03-06 04:48:24', '2021-03-07 04:15:01'),
(34, 'T BEST MAN', '62640.png', '2021-03-06 04:48:41', '2021-03-07 04:12:30');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=not ordered,2=ordered',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catgeories`
--

CREATE TABLE `catgeories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catgeories`
--

INSERT INTO `catgeories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Electronic', 'electronic', '2021-02-27 02:31:45', '2021-02-27 02:31:45'),
(18, 'Accessories', 'accessories', '2021-02-28 06:11:13', '2021-02-28 06:11:13'),
(19, 'House Hold', 'house-hold', '2021-03-06 03:33:09', '2021-03-06 03:33:09'),
(20, 'Electronics', 'electronics', '2021-03-06 04:03:05', '2021-03-06 04:03:05'),
(21, 'Women\'s', 'womens', '2021-03-06 04:09:19', '2021-03-06 04:09:19'),
(22, 'Man\'s', 'mans', '2021-03-06 04:09:49', '2021-03-06 04:09:49'),
(23, 'Health & Beauty', 'health-beauty', '2021-03-06 04:15:40', '2021-03-06 04:15:40'),
(24, 'Babies & Toys', 'babies-toys', '2021-03-06 04:15:52', '2021-03-06 04:15:52'),
(25, 'Groceries & Pets', 'groceries-pets', '2021-03-06 04:16:04', '2021-03-06 04:16:04'),
(26, 'Home & Lifestyle', 'home-lifestyle', '2021-03-06 04:16:19', '2021-03-06 04:16:19'),
(27, 'Watches & Accessories', 'watches-accessories', '2021-03-06 04:16:33', '2021-03-06 04:16:33'),
(28, 'Sports & Outdoor', 'sports-outdoor', '2021-03-06 04:16:48', '2021-03-06 04:16:48'),
(29, 'Automotive & Motorbike', 'automotive-motorbike', '2021-03-06 04:16:57', '2021-03-11 00:10:04'),
(30, 'ss', 'ss', '2021-12-29 00:37:38', '2021-12-29 00:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

CREATE TABLE `complain` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`id`, `user_id`, `details`, `created_at`, `updated_at`) VALUES
(1, 3, 'your apps is not working', NULL, NULL),
(2, 28, 'nice apps', '2021-03-11 03:02:17', '2021-03-11 03:02:17');

-- --------------------------------------------------------

--
-- Table structure for table `cupons`
--

CREATE TABLE `cupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_amount` double(8,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cupons`
--

INSERT INTO `cupons` (`id`, `coupon_code`, `coupon_amount`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(2, '#ERTY', 320.00, '2021-03-20', '2021-03-22', '2021-03-20 00:11:24', '2021-03-20 02:18:33'),
(3, '#FGTYH', 500.00, '2021-03-18', '2021-03-21', '2021-03-20 00:12:09', '2021-03-20 02:09:19');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role_id` int(11) DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `image`, `user_role_id`, `phone`, `email_verified_at`, `password`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test@gmail.com', NULL, 3, '01762714531', NULL, '25d55ad283aa400af464c76d713c07ad', 1, NULL, '2021-03-15 23:31:31', '2021-03-15 23:31:31'),
(2, 'rasel', 'rasel@gmail.com', NULL, 3, '01911909871', NULL, 'a1d50185e7426cbb0acad1e6ca74b9aa', 1, NULL, '2021-05-25 04:23:56', '2021-05-25 04:23:56'),
(3, 'raju', 'ra@gmail.com', NULL, 3, '019119098714', NULL, '81dc9bdb52d04dc20036dbd8313ed055', 1, NULL, '2021-05-25 05:19:20', '2021-05-25 05:19:20');

-- --------------------------------------------------------

--
-- Table structure for table `customer_services`
--

CREATE TABLE `customer_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quote_id` int(11) NOT NULL,
  `service_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(8,2) NOT NULL,
  `total` double(8,2) NOT NULL,
  `sub_total` double(8,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_services`
--

INSERT INTO `customer_services` (`id`, `quote_id`, `service_id`, `coupon_code`, `amount`, `total`, `sub_total`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '#9859', '#ERTY', 5000.00, 4680.00, 4680.00, 1, '2021-03-20 00:38:02', '2021-03-20 00:38:02');

-- --------------------------------------------------------

--
-- Table structure for table `drop_up`
--

CREATE TABLE `drop_up` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `drop_up_cost` double(8,2) NOT NULL,
  `sub_total` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drop_up`
--

INSERT INTO `drop_up` (`id`, `service_id`, `address`, `drop_up_cost`, `sub_total`, `created_at`, `updated_at`) VALUES
(2, '#9859', '58 frmagate monipuri para', 250.00, 250.00, '2021-03-20 03:14:48', '2021-03-20 03:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_02_26_064044_create_user_role_table', 2),
(5, '2021_02_27_052652_create_catgeories_table', 3),
(6, '2021_02_28_071355_create_brands_table', 4),
(7, '2021_02_28_075959_create_products_table', 5),
(8, '2021_03_01_062330_create_service_types_table', 6),
(9, '2021_03_01_073406_create_services_table', 7),
(10, '2021_03_01_090618_create_stock_brands_table', 8),
(11, '2021_03_01_090815_create_stock_models_table', 8),
(12, '2021_03_01_100607_create_stock_categories_table', 9),
(13, '2021_03_02_045324_create_stocks_table', 10),
(14, '2021_03_02_072831_create_rider_info_table', 11),
(15, '2021_03_03_112855_create_product_image_table', 12),
(16, '2021_03_04_063738_create_sub_categories_table', 13),
(17, '2021_03_11_085259_create_complain_table', 14),
(18, '2021_03_13_045335_create_quotes_table', 15),
(19, '2021_03_13_045633_create_customer_services_table', 15),
(20, '2021_03_13_044627_create_sliders_table', 16),
(21, '2021_03_13_114656_create_pick_up_table', 17),
(22, '2021_03_14_051741_create_drop_up_table', 18),
(23, '2021_03_14_063614_create_rider_assign_table', 19),
(24, '2021_03_14_080021_create_carts_table', 20),
(25, '2021_03_15_080300_create_customers_table', 21),
(26, '2021_03_16_075526_create_service_payment_table', 22),
(27, '2021_03_18_094922_create_orders_table', 23),
(28, '2021_03_18_095540_create_order_details_table', 23),
(29, '2021_03_18_095843_create_product_orders_table', 23),
(30, '2021_03_18_100011_create_order_payments_table', 23),
(31, '2021_03_18_100328_create_billing_infos_table', 23),
(32, '2021_03_20_050935_create_cupons_table', 24),
(33, '2021_03_20_061919_create_user_coupons_table', 25);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `sub_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grand_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=not deliver,2=delivered,3=canceled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `price`, `quantity`, `sub_total`, `grand_total`, `order_number`, `order_note`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '30000', 1, '30000', '30000', '81502', 'test', 3, '2021-03-18 06:21:43', '2021-03-20 04:18:48'),
(2, 2, '2500', 1, '2500', '2500', '47135', NULL, 1, '2021-05-25 04:29:49', '2021-05-25 04:29:49'),
(4, 2, '1500', 1, '1500', '1500', '88702', NULL, 2, '2021-05-26 02:08:35', '2021-12-29 00:38:05'),
(5, 2, '3000', 1, '3000', '3000', '25685', 'cxc', 1, '2021-12-13 04:08:49', '2021-12-13 04:08:49');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `user_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10, 'Vrbox Virtual Reality Glasses', '47366.jpg', '30000', 1, '2021-03-18 06:21:43', '2021-03-18 06:21:43'),
(2, 2, 2, 9, 'Mini Lepy LP-838 12V Hi-Fi Stereo Mega Bass 3-Channel Car Amplifier', '78585.jpg', '2500', 1, '2021-05-25 04:29:49', '2021-05-25 04:29:49'),
(3, 2, 4, 8, 'Black artificial leather gear belt for men', '46373.jpg', '1500', 1, '2021-05-26 02:08:35', '2021-05-26 02:08:35'),
(4, 2, 5, 8, 'Black artificial leather gear belt for men', '46373.jpg', '1500', 2, '2021-12-13 04:08:49', '2021-12-13 04:08:49');

-- --------------------------------------------------------

--
-- Table structure for table `order_payments`
--

CREATE TABLE `order_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payable_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_payments`
--

INSERT INTO `order_payments` (`id`, `user_id`, `order_id`, `payment_type`, `payment_name`, `transaction_number`, `customer_number`, `payable_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Mobile Banking', 'Bkash', '124567778888', '01772119941', '30000', '2021-03-18 06:21:43', '2021-03-18 06:21:43'),
(2, 2, 2, 'Mobile Banking', 'Bkash', '124567778888', '01772119941', '2500', '2021-05-25 04:29:49', '2021-05-25 04:29:49'),
(3, 2, 4, 'Mobile Banking', 'Bkash', 'fdsf', 'fdf', '1500', '2021-05-26 02:08:35', '2021-05-26 02:08:35'),
(4, 2, 5, 'Mobile Banking', 'Bkash', 'xcvxcv', 'vcxvxcvxcv', '3000', '2021-12-13 04:08:49', '2021-12-13 04:08:49');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pick_up`
--

CREATE TABLE `pick_up` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pick_up_cost` double(8,2) NOT NULL,
  `sub_total` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pick_up`
--

INSERT INTO `pick_up` (`id`, `service_id`, `address`, `pick_up_cost`, `sub_total`, `created_at`, `updated_at`) VALUES
(1, '#9859', '58, monipuri para framgate', 60.00, 60.00, '2021-03-20 03:06:47', '2021-03-20 03:06:47');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pro_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warranty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `feature` tinyint(4) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `new_arrival` tinyint(4) NOT NULL,
  `view_count` bigint(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `sub_cat_id`, `brand_id`, `model`, `code`, `pro_type`, `name`, `title`, `description`, `image`, `price`, `quantity`, `color`, `warranty`, `status`, `feature`, `publish`, `new_arrival`, `view_count`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '#900875', '12', 'Original', 'Iphone 8', 'Nice Iphone', '<p>This is Iphone</p>', '23557.jpg', 1500, 4, 'Black', '3 years', 0, 0, 0, 1, 0, '2021-03-06 05:38:49', '2021-03-16 01:14:41'),
(2, 27, 29, 15, '#875', '7854', '', 'Sunglasses Men', 'Nice Chose', '<p><span style=\"color: rgb(33, 33, 33); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 22px;\">2019 New Fashion Avengers Tony Stark Sunglasses Men Metal Square iron man Glasses Steampunk Sun Glasses Male</span></p>', '14319.jpg', 8500, 4, 'Blue', '3 years', 0, 0, 0, 1, 120, '2021-03-06 05:42:46', '2021-03-06 05:42:46'),
(3, 29, 5, 14, '#454', '12', '', 'Clean & Shine Car Shampoo', 'Car Shampoo', '<p><span style=\"color: rgb(33, 33, 33); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 22px;\">Clean &amp; Shine Car Shampoo 5 Liters With 500 ml Exclusive Pack Free</span></p>', '48493.jpg', 735, 12, 'Black', '1 Year', 0, 1, 0, 0, 0, '2021-03-06 05:56:13', '2021-03-07 05:51:23'),
(4, 29, 5, 11, '#456', 'black', '', 'Toyota Silicone Protecting Remote Key', 'Key Case Cover', '<p><div id=\"block-l01i4wNbix\" class=\"pdp-block pdp-block__rating-questions-summary\" style=\"margin: 0px; padding: 0px; display: table; width: 480px; color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><div id=\"block-kAtVArJwft\" class=\"pdp-block pdp-block__rating-questions\" style=\"margin: 0px; padding: 0px; display: table-cell; vertical-align: middle; text-align: left;\"><div id=\"module_product_review_star_1\" class=\"pdp-block module\" style=\"margin: 0px; padding: 0px;\"></div></div></div></p><div id=\"module_product_title_1\" class=\"pdp-block module\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"pdp-product-title\" style=\"margin: 13px 0px 11px; padding: 0px;\"><div class=\"pdp-mod-product-badge-wrapper\" style=\"margin: 4px 0px 0px; padding: 0px;\"><span class=\"pdp-mod-product-badge-title\" style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-size: 22px; font-weight: normal; word-break: break-word; overflow-wrap: break-word;\">Toyota Silicone Protecting Remote Key Case Cover</span></div></div></div>', '68393.jpg', 150, 5, 'Black', '3 years', 0, 1, 0, 1, 0, '2021-03-06 05:58:56', '2021-03-07 05:51:21'),
(5, 27, 26, 18, '#875', '14', '', '15 pcs/set Imitation Black Gem & Rhinestone Inlay Rings for Women', 'Jewelry', '<p><span style=\"color: rgb(33, 33, 33); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 22px;\">15 pcs/set Imitation Black Gem &amp; Rhinestone Inlay Rings for Women</span></p>', '49803.jpg', 30000, 2, '#7656', '5 Years', 0, 1, 0, 1, 0, '2021-03-06 06:01:22', '2021-03-13 00:07:23'),
(6, 27, 26, 18, '#4548', '78487', '', 'Finger ring for women-1pcs', 'Nice Choce', '<p><span style=\"color: rgb(33, 33, 33); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 22px;\">Finger ring for women-1pcs</span></p>', '30225.jpg', 12000, 4, 'white', '5 Years', 0, 0, 0, 0, 760, '2021-03-06 06:03:51', '2021-12-13 04:20:17'),
(7, 27, 27, 17, '#78457', '8457', '', 'Black Leather', 'Belt For Men', '<p><span style=\"color: rgb(33, 33, 33); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 22px;\">Black Leather Formal Belt For Men</span></p>', '4079.jpg', 8540, 15, 'Black', '1 Year', 0, 1, 0, 1, 0, '2021-03-06 06:06:24', '2021-03-07 05:51:19'),
(8, 27, 27, 14, '#8777', '78457', '', 'Black artificial leather gear belt for men', 'belt for men', '<p><span style=\"color: rgb(33, 33, 33); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 22px;\">Black artificial leather gear belt for men</span></p>', '46373.jpg', 1500, 4, 'Black', '1 Year', 0, 0, 0, 1, 155692564480, '2021-03-06 06:08:09', '2021-12-13 04:08:00'),
(9, 29, 12, 29, 'LP-838', '69558', 'Market original', 'Mini Lepy LP-838 12V Hi-Fi Stereo Mega Bass 3-Channel Car Amplifier', 'DVD Player, MP3 MP4', '<p><span style=\"color: rgb(33, 33, 33); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 22px;\">Mini Lepy LP-838 12V Hi-Fi Stereo Mega Bass 3-Channel Car Amplifier For Phone PC, DVD Player, MP3 MP4 Portable Subwoofer</span></p>', '78585.jpg', 2500, 4, 'white', '5 Years', 0, 1, 1, 0, 6710886400, '2021-03-06 06:11:00', '2021-05-26 02:26:17'),
(10, 27, 30, 27, 'Glasses', '#4566yhgtf', 'Original', 'Vrbox Virtual Reality Glasses', 'Eye-Glass', '<p><span style=\"color: rgb(33, 33, 33); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 22px;\">Vrbox Virtual Reality Glasses - Black and White</span></p>', '47366.jpg', 30000, 4, 'Black,Green,Yellow,Blue', '3 years', 1, 0, 1, 1, 0, '2021-03-06 06:13:10', '2021-05-25 04:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `product_image`, `created_at`, `updated_at`) VALUES
(4, 1, 'download.jpeg', '2021-03-03 23:49:24', '2021-03-03 23:49:24'),
(5, 3, '1615023413500download.jpeg', '2021-03-06 03:36:53', '2021-03-06 03:36:53'),
(6, 3, '1615023413502road-1072823__340.jpg', '2021-03-06 03:36:54', '2021-03-06 03:36:54'),
(7, 10, '51362.jpg', '2021-03-08 04:40:36', '2021-03-08 04:40:36'),
(8, 10, 'download.jpeg', '2021-03-08 04:40:59', '2021-03-08 04:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `product_orders`
--

CREATE TABLE `product_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_orders`
--

INSERT INTO `product_orders` (`id`, `order_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 10, '2021-03-18 06:21:43', '2021-03-18 06:21:43'),
(2, 2, 9, '2021-05-25 04:29:49', '2021-05-25 04:29:49'),
(3, 4, 8, '2021-05-26 02:08:35', '2021-05-26 02:08:35'),
(4, 5, 8, '2021-12-13 04:08:49', '2021-12-13 04:08:49');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `stock_category_id` int(11) NOT NULL,
  `stock_brand_id` int(11) NOT NULL,
  `stock_model_id` int(11) NOT NULL,
  `problem_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `user_id`, `stock_category_id`, `stock_brand_id`, `stock_model_id`, `problem_details`, `phone`, `coupon_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 27, 2, 3, 1, 'my mobile screen display broke down and battery change', '01772119941', '#ERTY', 1, '2021-03-20 00:38:02', '2021-03-20 00:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `rider_assign`
--

CREATE TABLE `rider_assign` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pick_up_id` int(11) DEFAULT NULL,
  `drop_up_id` int(11) DEFAULT NULL,
  `rider_id` int(11) NOT NULL,
  `pick_up_cost` float DEFAULT NULL,
  `drop_up_cost` float DEFAULT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rider_assign`
--

INSERT INTO `rider_assign` (`id`, `pick_up_id`, `drop_up_id`, `rider_id`, `pick_up_cost`, `drop_up_cost`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 25, 60, NULL, '2021-03-20', 0, '2021-03-20 04:11:27', '2021-03-20 04:11:27'),
(2, NULL, 2, 26, NULL, 250, '2021-03-20', 0, '2021-03-20 04:11:56', '2021-03-20 04:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `rider_info`
--

CREATE TABLE `rider_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `nid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rider_info`
--

INSERT INTO `rider_info` (`id`, `user_id`, `nid`, `address`, `country`, `city`, `zip`, `postal_code`, `card_number`, `created_at`, `updated_at`) VALUES
(3, 25, '98877728828', '113/c/3/a/1 , west shewora para mirpur dhaka', 'Bangladesh', 'dhaka', '1216', '1216', '1877309', '2021-03-02 05:28:29', '2021-03-02 05:28:29'),
(4, 26, '98877728828', '113/c/3/a/1 , west shewora para mirpur dhaka', 'Bangladesh', 'dhaka', '1216', '1216', '9164430', '2021-03-02 05:33:53', '2021-03-02 05:33:53'),
(5, 0, '98877728828', '113/c/3/a/1 , west shewora para mirpur dhaka', 'Bangladesh', 'dhaka', '1216', '1216', '6896894', '2021-03-02 06:31:35', '2021-03-02 06:31:35'),
(6, 0, '98877728828', '113/c/3/a/1 , west shewora para mirpur dhaka', 'Bangladesh', 'dhaka', '1216', '1216', '3265910', '2021-03-02 06:32:06', '2021-03-02 06:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `service_type_id` int(11) NOT NULL,
  `service_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_duration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `brand_id`, `model_id`, `service_type_id`, `service_name`, `charge`, `total_duration`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'mobile screen repair', '4500 for original , 2500 for copy', '4', '2021-03-02 00:57:39', '2021-03-02 00:57:39');

-- --------------------------------------------------------

--
-- Table structure for table `service_payment`
--

CREATE TABLE `service_payment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payable_amount` float NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` tinyint(4) NOT NULL,
  `payment_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_payment`
--

INSERT INTO `service_payment` (`id`, `service_id`, `customer_id`, `payment_type`, `payable_amount`, `mobile`, `transaction_id`, `payment_status`, `payment_date`, `created_at`, `updated_at`) VALUES
(1, '#9859', 27, 'bikash', 4990, '01772119941', '876635667388282', 1, '2021-03-16', '2021-03-20 03:18:21', '2021-03-20 03:18:21');

-- --------------------------------------------------------

--
-- Table structure for table `service_types`
--

CREATE TABLE `service_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_type_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_types`
--

INSERT INTO `service_types` (`id`, `service_type_name`, `created_at`, `updated_at`) VALUES
(1, 'test service', '2021-03-01 00:38:06', '2021-03-01 00:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=is active,2= is deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'banner1.jpg', '1', NULL, NULL),
(2, 'banner2.jpg', '1', NULL, NULL),
(3, 'banner3.jpg', '1', NULL, NULL),
(4, '63248.jpg', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_category_id` int(11) NOT NULL,
  `stock_brand_id` int(11) NOT NULL,
  `stock_model_id` int(11) NOT NULL,
  `quality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_price` double(8,2) NOT NULL,
  `retail_price` double(8,2) NOT NULL,
  `whole_sale_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `stock_category_id`, `stock_brand_id`, `stock_model_id`, `quality`, `color`, `variation`, `quantity`, `purchase_price`, `retail_price`, `whole_sale_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'very goods', 'Black', '6/128', '12', 2000.00, 1000.00, 500.00, '2021-03-01 23:48:49', '2021-03-02 00:20:49'),
(3, 3, 3, 4, 'very good', 'green,black', '6/128', '12', 2000.00, 1000.00, 500.00, '2021-03-06 03:39:43', '2021-03-06 03:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `stock_brands`
--

CREATE TABLE `stock_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_brand_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_brands`
--

INSERT INTO `stock_brands` (`id`, `stock_brand_name`, `created_at`, `updated_at`) VALUES
(1, 'Apple', '2021-03-01 03:25:09', '2021-03-01 03:25:09'),
(2, 'Samsung', '2021-03-01 03:25:15', '2021-03-01 03:25:15'),
(3, 'Oppo', '2021-03-01 03:25:18', '2021-03-01 03:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `stock_categories`
--

CREATE TABLE `stock_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_categories`
--

INSERT INTO `stock_categories` (`id`, `stock_category_name`, `created_at`, `updated_at`) VALUES
(1, 'MotherBoard', '2021-03-01 04:37:04', '2021-03-01 04:37:04'),
(2, 'Chipset', '2021-03-01 04:37:12', '2021-03-01 04:37:12'),
(3, 'Battery', '2021-03-01 04:37:21', '2021-03-01 04:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `stock_models`
--

CREATE TABLE `stock_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_brand_id` int(11) NOT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_models`
--

INSERT INTO `stock_models` (`id`, `stock_brand_id`, `model_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'iphone8', '2021-03-01 03:47:19', '2021-03-01 03:55:00'),
(2, 2, 's4', '2021-03-01 03:47:26', '2021-03-01 03:54:46'),
(4, 3, 'f17', '2021-03-06 03:38:56', '2021-03-06 03:38:56');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mobile', 'mobile', '2021-03-04 01:11:31', '2021-03-04 01:11:31'),
(2, 1, 'Computer', 'computer', '2021-03-04 01:11:42', '2021-03-04 01:11:42'),
(4, 19, 'furniture', 'furniture', '2021-03-06 03:33:42', '2021-03-06 03:33:42'),
(5, 29, 'Automobile', 'automobile', '2021-03-06 04:18:49', '2021-03-06 04:18:49'),
(6, 29, 'Auto Oils & Fluids', 'auto-oils-fluids', '2021-03-06 04:19:29', '2021-03-06 04:19:29'),
(7, 29, 'Interior Accessories', 'interior-accessories', '2021-03-06 04:19:55', '2021-03-06 04:19:55'),
(8, 29, 'Exterior Accessories', 'exterior-accessories', '2021-03-06 04:20:30', '2021-03-06 04:20:30'),
(9, 29, 'Exterior Vehicle Care', 'exterior-vehicle-care', '2021-03-06 04:21:05', '2021-03-06 04:21:05'),
(10, 29, 'Interior Vehicle Care', 'interior-vehicle-care', '2021-03-06 04:22:13', '2021-03-06 04:22:13'),
(11, 29, 'Car Electronics Accessories', 'car-electronics-accessories', '2021-03-06 04:22:20', '2021-03-06 04:22:20'),
(12, 29, 'Car Audio', 'car-audio', '2021-03-06 04:22:48', '2021-03-06 04:22:48'),
(13, 29, 'Motorcycle', 'motorcycle', '2021-03-06 04:23:16', '2021-03-06 04:23:16'),
(14, 29, 'Moto Parts & Spares', 'moto-parts-spares', '2021-03-06 04:23:48', '2021-03-06 04:23:48'),
(15, 29, 'Riding Gear', 'riding-gear', '2021-03-06 04:24:07', '2021-03-06 04:24:07'),
(16, 28, 'Treadmills', 'treadmills', '2021-03-06 04:25:06', '2021-03-06 04:25:06'),
(17, 28, 'Fitness Accessories', 'fitness-accessories', '2021-03-06 04:25:34', '2021-03-06 04:25:34'),
(18, 28, 'Dumbbells', 'dumbbells', '2021-03-06 04:26:00', '2021-03-06 04:26:00'),
(19, 28, 'Cycling', 'cycling', '2021-03-06 04:26:24', '2021-03-06 04:26:24'),
(20, 28, 'Boxing, Martial Arts & MMA', 'boxing-martial-arts-mma', '2021-03-06 04:26:43', '2021-03-06 04:26:43'),
(21, 28, 'Exercise & Fitness', 'exercise-fitness', '2021-03-06 04:27:32', '2021-03-06 04:27:32'),
(22, 28, 'Team Sports', 'team-sports', '2021-03-06 04:27:57', '2021-03-06 04:27:57'),
(23, 28, 'Camping & Hiking', 'camping-hiking', '2021-03-06 04:28:29', '2021-03-06 04:28:29'),
(24, 27, 'Man\'s Watch', 'mans-watch', '2021-03-06 04:30:12', '2021-03-06 04:30:12'),
(25, 27, 'Woman\'s Watch', 'womans-watch', '2021-03-06 04:30:34', '2021-03-06 04:30:34'),
(26, 27, 'Women\'s Jewelry', 'womens-jewelry', '2021-03-06 04:31:33', '2021-03-06 04:31:33'),
(27, 27, 'Man\'s Belt', 'mans-belt', '2021-03-06 04:32:12', '2021-03-06 04:32:12'),
(28, 27, 'Woman\'s Wallets', 'womans-wallets', '2021-03-06 04:33:33', '2021-03-06 04:33:33'),
(29, 27, 'Sun-Glass', 'sun-glass', '2021-03-06 04:34:11', '2021-03-06 04:35:25'),
(30, 27, 'Eye-Glass', 'eye-glass', '2021-03-06 04:34:23', '2021-03-06 04:34:23'),
(31, 27, 'Kid\'s Watch', 'kids-watch', '2021-03-06 04:34:38', '2021-03-06 04:34:38'),
(32, 30, 'sss', 'sss', '2021-12-29 00:37:53', '2021-12-29 00:37:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role_id` int(11) NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `user_role_id`, `phone`, `email_verified_at`, `password`, `remember_token`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, 1, '', NULL, '$2y$10$eYLYQ1WTwbkvnsYEcyb4iOsoJuDcUN.Bi8UGhyev7wSv3cCSSEPje', NULL, 1, '2021-02-25 23:22:02', '2021-02-25 23:22:02'),
(3, 'alex', 'alex@gmail.com', NULL, 3, '01432567890', NULL, '$2y$10$Mu2ZI.QMO4aYOrD1eaCndOBESgrAF5RKJooWBnDOW4xXZxj/tCwCS', NULL, 1, '2021-02-26 00:50:05', '2021-03-06 01:20:22'),
(26, 'mamun', 'mamun@gmail.com', '50187.jpeg', 5, '01762714531', NULL, '$2y$10$/C99bbsrjB6mstDqC42Mi.51fll7zMcSY1KOkTtoHZV5AYOURYN/6', NULL, 0, '2021-03-02 05:33:53', '2021-03-03 00:05:26'),
(31, 'rasel', 'raselrana1147@gmail.com', NULL, 2, '01964719349', NULL, '$2y$10$eYLYQ1WTwbkvnsYEcyb4iOsoJuDcUN.Bi8UGhyev7wSv3cCSSEPje', NULL, 1, '2021-12-14 02:06:43', '2021-12-14 02:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_coupons`
--

CREATE TABLE `user_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_coupons`
--

INSERT INTO `user_coupons` (`id`, `coupon_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 27, '2021-03-20 00:25:37', '2021-03-20 00:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2021-02-26 06:48:04', '2021-02-26 06:48:12'),
(2, 'executive', '2021-02-26 06:48:15', '2021-02-26 06:48:18'),
(3, 'customer', '2021-03-02 07:19:18', '2021-03-02 07:19:21'),
(4, 'member', '2021-03-02 07:19:24', '2021-03-02 07:19:27'),
(5, 'rider', '2021-03-02 07:31:01', '2021-03-02 07:31:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing_infos`
--
ALTER TABLE `billing_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catgeories`
--
ALTER TABLE `catgeories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complain`
--
ALTER TABLE `complain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cupons`
--
ALTER TABLE `cupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD UNIQUE KEY `customers_phone_unique` (`phone`);

--
-- Indexes for table `customer_services`
--
ALTER TABLE `customer_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drop_up`
--
ALTER TABLE `drop_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_payments`
--
ALTER TABLE `order_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pick_up`
--
ALTER TABLE `pick_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_orders`
--
ALTER TABLE `product_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rider_assign`
--
ALTER TABLE `rider_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rider_info`
--
ALTER TABLE `rider_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_payment`
--
ALTER TABLE `service_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_brands`
--
ALTER TABLE `stock_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_categories`
--
ALTER TABLE `stock_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_models`
--
ALTER TABLE `stock_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_coupons`
--
ALTER TABLE `user_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing_infos`
--
ALTER TABLE `billing_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `catgeories`
--
ALTER TABLE `catgeories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cupons`
--
ALTER TABLE `cupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_services`
--
ALTER TABLE `customer_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `drop_up`
--
ALTER TABLE `drop_up`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_payments`
--
ALTER TABLE `order_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pick_up`
--
ALTER TABLE `pick_up`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_orders`
--
ALTER TABLE `product_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rider_assign`
--
ALTER TABLE `rider_assign`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rider_info`
--
ALTER TABLE `rider_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_payment`
--
ALTER TABLE `service_payment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_types`
--
ALTER TABLE `service_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock_brands`
--
ALTER TABLE `stock_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock_categories`
--
ALTER TABLE `stock_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock_models`
--
ALTER TABLE `stock_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_coupons`
--
ALTER TABLE `user_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
