-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2023 at 03:55 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newmvc-akshayfultariya`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(2, 'a', 'a', 0, '2023-03-28 12:57:17', '2023-03-29 21:28:27'),
(3, 'khiladi@gmail.com', '', 1, '2023-03-29 20:41:00', '2023-03-30 09:49:32'),
(4, 'khiladi1@gmail.com', '', 2, '2023-03-29 20:42:00', NULL),
(5, '', '', 0, '2023-03-29 20:42:00', NULL),
(6, '1', '2', 3, '2023-03-29 20:42:00', NULL),
(7, '1', '2', 3, '2023-03-29 20:47:00', NULL),
(27, '', '', 1, '2023-04-10 10:13:19', '2023-04-10 10:13:23'),
(29, '', '', 1, '2023-04-20 07:05:57', NULL),
(30, '', '', 1, '2023-04-20 07:36:02', '2023-04-20 07:36:10'),
(31, '', '', 1, '2023-04-20 07:36:14', '2023-04-20 07:36:26'),
(32, '', '', 1, '2023-04-20 07:37:39', NULL),
(33, '', '', 1, '2023-04-20 07:37:44', '2023-04-20 07:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `admin_decimal`
--

CREATE TABLE `admin_decimal` (
  `value_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_int`
--

CREATE TABLE `admin_int` (
  `value_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_int`
--

INSERT INTO `admin_int` (`value_id`, `admin_id`, `attribute_id`, `value`) VALUES
(1, 30, 86, 58),
(2, 30, 86, 0),
(3, 31, 86, 58),
(4, 31, 86, 0),
(5, 32, 86, 0),
(6, 33, 86, 58),
(7, 33, 86, 58);

-- --------------------------------------------------------

--
-- Table structure for table `admin_text`
--

CREATE TABLE `admin_text` (
  `value_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_varchar`
--

CREATE TABLE `admin_varchar` (
  `value_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'akshay', 'xyz', '0', '2023-04-18 12:15:52', '2023-04-18 12:26:09'),
(5, '', '', '0', '2023-04-18 12:37:08', '2023-04-18 12:37:11');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `tex` int(11) NOT NULL,
  `creatred_date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `shipping_id`, `amount`, `tex`, `creatred_date`) VALUES
(1, 1, 55, 5, '2023-03-08 12:42:17.000000');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `cart_item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`cart_item_id`, `product_id`, `cost`, `price`, `quantty`) VALUES
(1, 1, 50, 50, 5),
(2, 2, 50, 60, 500),
(3, 3, 555, 599, 5);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `path` varchar(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `parent_id`, `path`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, '1', 'root', 'a', 'active', '2023-04-03 08:39:19', '2023-04-03 08:39:19'),
(9, 1, '1=9', 'chair', '', 'active', '2023-04-03 09:38:06', '0000-00-00 00:00:00'),
(14, 9, '1=9=14', '', '', 'active', '2023-04-10 08:20:51', '2023-04-15 11:01:28'),
(15, 9, '1=9=15', 'hello', '', 'active', '2023-04-11 10:41:22', '2023-04-15 11:01:39'),
(16, 9, '1=9=16', 'a', '', 'active', '2023-04-11 10:41:31', '0000-00-00 00:00:00'),
(17, 1, '1=17', '', '', 'active', '2023-04-15 11:01:17', '0000-00-00 00:00:00'),
(18, 1, '1=18', '', '', 'active', '2023-04-20 07:03:33', '0000-00-00 00:00:00'),
(19, 1, '1=19', '', '', 'active', '2023-04-20 07:04:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `category_decimal`
--

CREATE TABLE `category_decimal` (
  `value_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_int`
--

CREATE TABLE `category_int` (
  `value_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_text`
--

CREATE TABLE `category_text` (
  `value_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_varchar`
--

CREATE TABLE `category_varchar` (
  `value_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `billing_address_id` int(11) DEFAULT NULL,
  `shipping_address_id` int(11) DEFAULT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `mobile` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `billing_address_id`, `shipping_address_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `created_at`, `updated_at`) VALUES
(102, 147, 146, 'a', '   a', '  aaaa@gmail.com', '', 987654, 1, '2023-04-19 01:52:46', '2023-04-19 01:53:28'),
(103, 149, 148, 'a', 'a', 'a@gamil.com', '', 987885555, 1, '2023-04-19 01:53:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `address_id` int(11) NOT NULL,
  `customer_id` int(30) NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `zip_code` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`address_id`, `customer_id`, `address`, `city`, `state`, `country`, `zip_code`) VALUES
(102, 83, 'a', 'a', 'a', 'a', 0),
(103, 83, 'a', 'a', 'a', 'a', 0),
(111, 93, '', '', '', '', 0),
(112, 94, '', '', '', '', 0),
(113, 94, '', '', '', '', 0),
(114, 95, '', '', '', '', 0),
(115, 95, '', '', '', '', 0),
(116, 95, '', '', '', '', 0),
(117, 95, '', '', '', '', 0),
(118, 96, 'z', 'z', 'z', 'z', 0),
(119, 96, 'a', 'a', 'a', 'a', 0),
(120, 96, '', '', '', '', 0),
(121, 96, '', '', '', '', 0),
(122, 97, 'z', 'z', 'z', 'z', 0),
(123, 97, 'a', 'a', 'a', 'a', 0),
(124, 97, 'z', 'z', 'z', 'z', 0),
(125, 97, 'aaaaa', 'a', 'a', 'a', 0),
(126, 98, '', '', '', '', 0),
(127, 98, '', '', '', '', 0),
(128, 99, 'a', '', '', '', 0),
(129, 99, 'aaaaa', '', '', '', 0),
(130, 99, 'a', '', '', '', 0),
(131, 99, 'aaaaa', '', '', '', 0),
(132, 99, 'a', '', '', '', 0),
(133, 99, 'aaaaa', '', '', '', 0),
(134, 100, '', '', '', '', 0),
(135, 100, '', '', '', '', 0),
(136, 100, 'a', 'z', 'z', 'z', 0),
(137, 100, 'a', 'a', 'a', 'a', 0),
(138, 102, '', '', '', '', 0),
(139, 102, '', '', '', '', 0),
(140, 102, 'a', 'a', 'a', 'a', 0),
(141, 102, 'a', 'a', 'a', 'a', 0),
(142, 102, 'a', 'a', 'a', 'a', 0),
(143, 102, 'a', 'a', 'a', 'a', 0),
(144, 102, 'a', 'a', 'a', 'a', 0),
(145, 102, 'a', 'a', 'a', 'a', 0),
(146, 102, 'a', 'a', 'a', 'a', 0),
(147, 102, 'a', 'a', 'a', 'a', 0),
(148, 103, 'a', 'a', 'a', 'a', 0),
(149, 103, 'a', 'a', 'a', 'a', 0),
(150, 104, '', '', '', '', 0),
(151, 104, '', '', '', '', 0),
(152, 105, 'a', 'a', 'a', 'a', 0),
(153, 105, 'a', 'a', '', 'a', 0),
(154, 106, 'a', 'a', 'a', 'a', 0),
(155, 106, 'a', 'a', '', 'a', 0),
(156, 107, 'a', 'a', 'a', 'a', 0),
(157, 107, 'a', 'a', '', 'a', 0),
(158, 108, 'aa', 'a', 'a', 'a', 0),
(159, 108, 'a', 'a', 'a', 'a', 0),
(160, 109, 'aa', 'a', 'a', 'a', 0),
(161, 109, 'a', 'a', 'a', 'a', 0),
(162, 110, 'aa', 'a', 'a', 'a', 0),
(163, 110, 'a', 'a', 'a', 'a', 0),
(164, 110, 'aa', 'a', 'a', 'a', 0),
(165, 110, 'a', 'a', 'a', 'a', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_decimal`
--

CREATE TABLE `customer_decimal` (
  `value_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_int`
--

CREATE TABLE `customer_int` (
  `value_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_text`
--

CREATE TABLE `customer_text` (
  `value_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_varchar`
--

CREATE TABLE `customer_varchar` (
  `value_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eav_attribute`
--

CREATE TABLE `eav_attribute` (
  `attribute_id` int(11) NOT NULL,
  `entity_type_id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `backend_type` varchar(20) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `backend_model` varchar(255) NOT NULL,
  `input_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eav_attribute`
--

INSERT INTO `eav_attribute` (`attribute_id`, `entity_type_id`, `code`, `backend_type`, `name`, `status`, `backend_model`, `input_type`) VALUES
(66, 6, '1', 'int', ' color', 1, ' ', 'select'),
(68, 6, '1', 'text', ' colore', 1, ' 1', 'textarea'),
(69, 6, 'description', 'text', ' Description', 1, ' ', 'textarea'),
(73, 7, '1', 'text', 'Type', 1, ' 1', 'textarea'),
(75, 6, '', 'int', ' ', 1, ' ', 'multiselect'),
(77, 6, '', 'int', ' ', 1, ' ', 'select'),
(80, 1, '1', 'int', ' use', 1, ' 1', 'select'),
(81, 1, '1', 'text', '     aaa', 1, '     ', 'select'),
(82, 8, '1', 'int', ' a', 1, ' 1', 'select'),
(83, 4, '1', 'int', ' aaa', 1, ' 1', 'select'),
(84, 2, '1', 'int', ' home', 1, ' 1', 'select'),
(85, 5, '1', 'int', ' experiance', 1, ' 1', 'select'),
(86, 9, '1', 'int', ' a', 1, ' 1', 'select'),
(87, 3, '1', 'int', 'aaaa', 1, ' 1', 'select');

-- --------------------------------------------------------

--
-- Table structure for table `eav_attribute_option`
--

CREATE TABLE `eav_attribute_option` (
  `option_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `position` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eav_attribute_option`
--

INSERT INTO `eav_attribute_option` (`option_id`, `name`, `attribute_id`, `position`) VALUES
(33, 'yellow', 66, 0),
(34, 'red', 66, 0),
(35, 'aaaaaaaaa', 75, 0),
(36, 'aaaaa', 75, 0),
(37, 'a', 75, 0),
(42, 'outdoor', 80, 0),
(43, 'home', 80, 0),
(44, '', 81, 0),
(45, 'aaaaaa', 82, 0),
(46, 'aaaa', 82, 0),
(47, 'aaaaaa', 83, 0),
(48, 'aaaaaa', 83, 0),
(49, 'aaaaa', 83, 0),
(50, 'tv', 84, 0),
(51, 'chair', 84, 0),
(52, 'bed', 84, 0),
(53, 'a', 81, 0),
(54, 'a', 81, 0),
(55, 'new', 85, 0),
(56, 'average', 85, 0),
(57, 'old', 85, 0),
(58, 'aaa', 86, 0),
(59, 'a', 86, 0),
(60, 'a', 86, 0),
(61, '', 87, 0),
(62, 'aaaaaaa', 87, 0),
(63, 'aa', 87, 0),
(64, 'a', 87, 0);

-- --------------------------------------------------------

--
-- Table structure for table `entity_type`
--

CREATE TABLE `entity_type` (
  `entity_type_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `entity_model` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entity_type`
--

INSERT INTO `entity_type` (`entity_type_id`, `name`, `entity_model`) VALUES
(1, 'product', ''),
(2, 'category', ''),
(3, 'customer', ''),
(4, 'Vendor', ''),
(5, 'salesman', ''),
(6, 'Item', ''),
(7, 'Payment', ''),
(8, 'shipping', ''),
(9, 'Admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `entity_id` int(11) NOT NULL,
  `sku` int(11) NOT NULL,
  `entity_type_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`entity_id`, `sku`, `entity_type_id`, `status`, `created_at`, `updated_at`) VALUES
(44, 1, 6, 1, '2023-04-19 07:14:08', '2023-04-19 07:15:45'),
(45, 0, 6, 1, '2023-04-19 07:16:52', NULL),
(46, 1, 6, 1, '2023-04-19 07:20:15', NULL),
(47, 1, 6, 1, '2023-04-19 07:22:08', NULL),
(48, 1, 6, 1, '2023-04-19 07:23:20', NULL),
(49, 1, 6, 1, '2023-04-19 07:23:35', NULL),
(50, 1, 6, 1, '2023-04-19 07:24:07', NULL),
(51, 0, 6, 1, '2023-04-19 11:17:54', NULL),
(52, 0, 6, 1, '2023-04-19 11:27:14', NULL),
(53, 0, 6, 1, '2023-04-20 07:03:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_decimal`
--

CREATE TABLE `item_decimal` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_int`
--

CREATE TABLE `item_int` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_int`
--

INSERT INTO `item_int` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(28, 49, 66, 34),
(29, 50, 66, 34),
(30, 51, 66, 0),
(31, 51, 75, 35),
(32, 52, 66, 0),
(33, 52, 75, 35),
(34, 53, 66, 33),
(35, 53, 77, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_text`
--

CREATE TABLE `item_text` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_text`
--

INSERT INTO `item_text` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 51, 68, ' \"'),
(2, 51, 69, ' \"'),
(3, 52, 68, ' \"'),
(4, 52, 69, ' \"'),
(5, 53, 68, ' \"'),
(6, 53, 69, ' \"');

-- --------------------------------------------------------

--
-- Table structure for table `item_varchar`
--

CREATE TABLE `item_varchar` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `media_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `base` tinyint(4) NOT NULL,
  `thumbnail` tinyint(4) NOT NULL,
  `small` tinyint(4) NOT NULL,
  `gallery` tinyint(4) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`media_id`, `product_id`, `name`, `status`, `image`, `base`, `thumbnail`, `small`, `gallery`, `created_at`) VALUES
(1, '43', 'a', 2, '1.jpg', 1, 0, 1, 1, '2023-04-17'),
(2, '43', 'aaa', 2, '2.jpg', 0, 1, 0, 0, '2023-04-17'),
(3, '42', 'aa', 2, '3.jpg', 1, 1, 1, 1, '2023-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `shipping_method_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `name`, `email`, `mobile`, `total`, `created_at`, `status`, `payment_method_id`, `shipping_method_id`, `amount`) VALUES
(1, 0, '', '', 0, 0, '2023-04-19 14:08:59', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `address_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `zip_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `sku` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_method_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_method_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(37, 'xyz', 'active', '2023-03-21 09:22:56', '0000-00-00 00:00:00'),
(38, 'xyz1', 'active', '2023-03-21 09:23:21', '2023-03-28 09:37:51'),
(42, 'aaaaa', 'active', '2023-03-31 08:21:40', '2023-04-05 21:10:31'),
(45, '', 'active', '2023-04-05 21:10:18', '0000-00-00 00:00:00'),
(50, '', 'active', '2023-04-19 10:19:01', '0000-00-00 00:00:00'),
(51, '', 'active', '2023-04-19 10:19:15', '0000-00-00 00:00:00'),
(52, '', 'inactive', '2023-04-19 10:20:37', '0000-00-00 00:00:00'),
(53, '', 'active', '2023-04-19 10:22:43', '2023-04-19 10:22:57'),
(54, 'akshay', 'inactive', '2023-04-19 10:35:08', '2023-04-19 10:51:01'),
(55, '', 'active', '2023-04-19 21:23:58', '2023-04-19 21:24:03');

-- --------------------------------------------------------

--
-- Table structure for table `payment_decimal`
--

CREATE TABLE `payment_decimal` (
  `value_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_int`
--

CREATE TABLE `payment_int` (
  `value_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_text`
--

CREATE TABLE `payment_text` (
  `value_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_text`
--

INSERT INTO `payment_text` (`value_id`, `payment_method_id`, `attribute_id`, `value`) VALUES
(1, 50, 73, ' \"'),
(2, 51, 73, ' \"akshay'),
(3, 52, 73, ' \"'),
(4, 53, 73, ' \"hii'),
(5, 53, 73, '  \"hii\"'),
(6, 53, 73, '  \"hi'),
(7, 54, 73, ' \"aaa'),
(8, 54, 73, '  \"aaa\"'),
(9, 54, 73, '  \"aaa\"'),
(10, 54, 73, '  \"aaa\"'),
(11, 54, 73, '  \"aaa\"'),
(12, 55, 73, ' \"'),
(13, 55, 73, '  \"\"');

-- --------------------------------------------------------

--
-- Table structure for table `payment_varchar`
--

CREATE TABLE `payment_varchar` (
  `value_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `cost` int(11) NOT NULL,
  `SKU` varchar(10) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` int(100) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `color` text NOT NULL,
  `material` enum('hard','soft') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `base_id` int(11) DEFAULT NULL,
  `thumbnail_id` int(11) DEFAULT NULL,
  `small_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `cost`, `SKU`, `price`, `quantity`, `description`, `status`, `color`, `material`, `created_at`, `updated_at`, `base_id`, `thumbnail_id`, `small_id`) VALUES
(42, '', 0, '  ', '0', 0, '																		', 2, '  ', 'hard', '2023-04-12 06:58:58', '2023-04-19 10:50:25', 3, 3, 3),
(44, '', 0, '  ', '0', 0, '																		', 1, '  ', 'hard', '2023-04-19 19:50:23', '2023-04-19 19:50:28', 0, 0, 0),
(45, '', 0, ' ', '0', 0, '									', 1, ' ', 'hard', '2023-04-20 07:05:05', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_decimal`
--

CREATE TABLE `product_decimal` (
  `value_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_int`
--

CREATE TABLE `product_int` (
  `value_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_int`
--

INSERT INTO `product_int` (`value_id`, `product_id`, `attribute_id`, `value`) VALUES
(1, 45, 80, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_text`
--

CREATE TABLE `product_text` (
  `value_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_text`
--

INSERT INTO `product_text` (`value_id`, `product_id`, `attribute_id`, `value`) VALUES
(0, 45, 81, '53');

-- --------------------------------------------------------

--
-- Table structure for table `product_varchar`
--

CREATE TABLE `product_varchar` (
  `value_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quote`
--

CREATE TABLE `quote` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total` int(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `shipping_method_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quote`
--

INSERT INTO `quote` (`order_id`, `customer_id`, `total`, `created_at`, `status`, `payment_method_id`, `shipping_method_id`, `amount`) VALUES
(1, 1, 500, '2023-04-19 13:24:41', 1, 1, 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `quote_address`
--

CREATE TABLE `quote_address` (
  `address_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `zip_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quote_item`
--

CREATE TABLE `quote_item` (
  `item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `salesman_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `mobile` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `company` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`salesman_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `company`, `created_at`, `updated_at`) VALUES
(2, '', '', '', '', 0, 1, '', '2023-03-28 11:29:07', '2023-04-12 06:37:39'),
(17, '', '', '', '', 0, 1, '', '2023-04-12 06:37:57', '2023-04-15 09:57:10'),
(18, '', '', '', '', 0, 1, '', '2023-04-15 09:58:03', NULL),
(19, '', '', '', '', 0, 1, '', '2023-04-20 07:12:48', NULL),
(20, '', '', '', '', 0, 1, '', '2023-04-20 07:25:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salesman_address`
--

CREATE TABLE `salesman_address` (
  `address_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `zip_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesman_address`
--

INSERT INTO `salesman_address` (`address_id`, `salesman_id`, `address`, `city`, `state`, `country`, `zip_code`) VALUES
(17, 17, '', '', '', '', 0),
(18, 18, '', '', '', '', 0),
(19, 19, '', '', '', '', 0),
(20, 20, '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salesman_decimal`
--

CREATE TABLE `salesman_decimal` (
  `value_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salesman_int`
--

CREATE TABLE `salesman_int` (
  `value_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesman_int`
--

INSERT INTO `salesman_int` (`value_id`, `salesman_id`, `attribute_id`, `value`) VALUES
(1, 20, 85, 57);

-- --------------------------------------------------------

--
-- Table structure for table `salesman_price`
--

CREATE TABLE `salesman_price` (
  `entity_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `salesman_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesman_price`
--

INSERT INTO `salesman_price` (`entity_id`, `salesman_id`, `product_id`, `salesman_price`) VALUES
(1, 0, 16, 0),
(2, 16, 1, 10),
(3, 41, 1, 15),
(4, 40, 1, 10),
(5, 41, 2, 15),
(6, 40, 24, 10),
(7, 7, 1, 5),
(8, 7, 2, 10),
(9, 8, 1, 5),
(10, 8, 2, 10),
(13, 1, 1, 5),
(14, 1, 2, 5),
(15, 1, 11, 10),
(16, 1, 12, 11),
(17, 8, 30, 4),
(18, 2, 1, 10),
(23, 0, 1, 5),
(24, 0, 2, 10),
(25, 0, 41, 5),
(27, 0, 43, 5),
(28, 2, 41, 5),
(29, 2, 42, 5),
(30, 2, 43, 5),
(31, 0, 1, 5),
(32, 0, 2, 10),
(33, 0, 41, 5),
(35, 0, 43, 5),
(50, 17, 42, 50);

-- --------------------------------------------------------

--
-- Table structure for table `salesman_text`
--

CREATE TABLE `salesman_text` (
  `value_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salesman_varchar`
--

CREATE TABLE `salesman_varchar` (
  `value_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shipping_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `amount` int(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`shipping_id`, `name`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(18, 'silver', 1000, 1, '2023-03-14 09:00:29', '2023-03-28 01:08:45'),
(32, 'a', 0, 1, '2023-03-31 09:08:17', NULL),
(35, 'a', 0, 1, '2023-04-06 06:41:02', '2023-04-06 06:41:09'),
(36, '', 0, 0, '2023-04-07 10:23:45', NULL),
(37, '', 0, 0, '2023-04-07 10:23:50', '2023-04-07 10:23:55');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_decimal`
--

CREATE TABLE `shipping_decimal` (
  `value_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_int`
--

CREATE TABLE `shipping_int` (
  `value_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_text`
--

CREATE TABLE `shipping_text` (
  `value_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_varchar`
--

CREATE TABLE `shipping_varchar` (
  `value_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `mobile` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `company` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `company`, `created_at`, `updated_at`) VALUES
(1, 'a', 'a', 'a', '', 0, 1, '', '2023-04-19 10:19:07', NULL),
(2, '', '', '', '', 0, 0, '', '2023-04-19 22:19:46', NULL),
(3, '', '', '', '', 0, 0, '', '2023-04-19 22:20:28', NULL),
(4, 'a', 'a', 'a', '', 0, 1, 'a', '2023-04-19 10:21:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `address_id` int(20) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `zip_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`address_id`, `vendor_id`, `address`, `city`, `state`, `country`, `zip_code`) VALUES
(3, 1, 'a', 'z', 'z', 'z', 0),
(4, 4, 'zzzzzzzzzz', 'zzzzzzz', 'zzzzzzz', 'zzzzzzzzzz', 1111111111);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_decimal`
--

CREATE TABLE `vendor_decimal` (
  `value_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_int`
--

CREATE TABLE `vendor_int` (
  `value_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor_int`
--

INSERT INTO `vendor_int` (`value_id`, `vendor_id`, `attribute_id`, `value`) VALUES
(1, 12, 83, 47),
(2, 13, 83, 47),
(3, 14, 83, 47),
(4, 15, 83, 0),
(5, 16, 83, 0),
(6, 17, 83, 0),
(7, 18, 83, 0),
(8, 19, 83, 47),
(9, 20, 83, 0),
(10, 21, 83, 0),
(11, 21, 83, 0),
(12, 21, 83, 0),
(13, 21, 83, 0),
(14, 21, 83, 0),
(15, 22, 83, 47),
(16, 18, 83, 0),
(17, 1, 83, 0),
(18, 2, 83, 0),
(19, 3, 83, 47),
(20, 1, 83, 47),
(21, 4, 83, 47);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_text`
--

CREATE TABLE `vendor_text` (
  `value_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_varchar`
--

CREATE TABLE `vendor_varchar` (
  `value_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_decimal`
--
ALTER TABLE `admin_decimal`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `admin_int`
--
ALTER TABLE `admin_int`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `admin_text`
--
ALTER TABLE `admin_text`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `admin_varchar`
--
ALTER TABLE `admin_varchar`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_item_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `category_decimal`
--
ALTER TABLE `category_decimal`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `category_int`
--
ALTER TABLE `category_int`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `category_text`
--
ALTER TABLE `category_text`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `category_varchar`
--
ALTER TABLE `category_varchar`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `billing_address_id` (`billing_address_id`),
  ADD KEY `shipping_address_id` (`shipping_address_id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `customer_decimal`
--
ALTER TABLE `customer_decimal`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `customer_int`
--
ALTER TABLE `customer_int`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `customer_text`
--
ALTER TABLE `customer_text`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `customer_varchar`
--
ALTER TABLE `customer_varchar`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `eav_attribute`
--
ALTER TABLE `eav_attribute`
  ADD PRIMARY KEY (`attribute_id`),
  ADD KEY `antity_type_id` (`entity_type_id`);

--
-- Indexes for table `eav_attribute_option`
--
ALTER TABLE `eav_attribute_option`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `entity_type`
--
ALTER TABLE `entity_type`
  ADD PRIMARY KEY (`entity_type_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`entity_id`);

--
-- Indexes for table `item_decimal`
--
ALTER TABLE `item_decimal`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `item_int`
--
ALTER TABLE `item_int`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id` (`entity_id`,`attribute_id`);

--
-- Indexes for table `item_text`
--
ALTER TABLE `item_text`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `item_varchar`
--
ALTER TABLE `item_varchar`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `payment_decimal`
--
ALTER TABLE `payment_decimal`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `payment_int`
--
ALTER TABLE `payment_int`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `payment_text`
--
ALTER TABLE `payment_text`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `payment_varchar`
--
ALTER TABLE `payment_varchar`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_int`
--
ALTER TABLE `product_int`
  ADD PRIMARY KEY (`value_id`),
  ADD KEY `entity_id` (`product_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `quote`
--
ALTER TABLE `quote`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `quote_address`
--
ALTER TABLE `quote_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `quote_item`
--
ALTER TABLE `quote_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`salesman_id`);

--
-- Indexes for table `salesman_address`
--
ALTER TABLE `salesman_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `salesman_id` (`salesman_id`);

--
-- Indexes for table `salesman_decimal`
--
ALTER TABLE `salesman_decimal`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `salesman_int`
--
ALTER TABLE `salesman_int`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `salesman_price`
--
ALTER TABLE `salesman_price`
  ADD PRIMARY KEY (`entity_id`);

--
-- Indexes for table `salesman_text`
--
ALTER TABLE `salesman_text`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `salesman_varchar`
--
ALTER TABLE `salesman_varchar`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indexes for table `shipping_decimal`
--
ALTER TABLE `shipping_decimal`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `shipping_int`
--
ALTER TABLE `shipping_int`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `shipping_text`
--
ALTER TABLE `shipping_text`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `shipping_varchar`
--
ALTER TABLE `shipping_varchar`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `vendor_decimal`
--
ALTER TABLE `vendor_decimal`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `vendor_int`
--
ALTER TABLE `vendor_int`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `vendor_text`
--
ALTER TABLE `vendor_text`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `vendor_varchar`
--
ALTER TABLE `vendor_varchar`
  ADD PRIMARY KEY (`value_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `admin_decimal`
--
ALTER TABLE `admin_decimal`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_int`
--
ALTER TABLE `admin_int`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `admin_text`
--
ALTER TABLE `admin_text`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_varchar`
--
ALTER TABLE `admin_varchar`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `category_decimal`
--
ALTER TABLE `category_decimal`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_int`
--
ALTER TABLE `category_int`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_text`
--
ALTER TABLE `category_text`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_varchar`
--
ALTER TABLE `category_varchar`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `customer_decimal`
--
ALTER TABLE `customer_decimal`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_int`
--
ALTER TABLE `customer_int`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_text`
--
ALTER TABLE `customer_text`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_varchar`
--
ALTER TABLE `customer_varchar`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eav_attribute`
--
ALTER TABLE `eav_attribute`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `eav_attribute_option`
--
ALTER TABLE `eav_attribute_option`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `entity_type`
--
ALTER TABLE `entity_type`
  MODIFY `entity_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `item_decimal`
--
ALTER TABLE `item_decimal`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_int`
--
ALTER TABLE `item_int`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `item_text`
--
ALTER TABLE `item_text`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item_varchar`
--
ALTER TABLE `item_varchar`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `payment_decimal`
--
ALTER TABLE `payment_decimal`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_int`
--
ALTER TABLE `payment_int`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_text`
--
ALTER TABLE `payment_text`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment_varchar`
--
ALTER TABLE `payment_varchar`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `product_int`
--
ALTER TABLE `product_int`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quote`
--
ALTER TABLE `quote`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quote_address`
--
ALTER TABLE `quote_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quote_item`
--
ALTER TABLE `quote_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `salesman_address`
--
ALTER TABLE `salesman_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `salesman_decimal`
--
ALTER TABLE `salesman_decimal`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salesman_int`
--
ALTER TABLE `salesman_int`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salesman_price`
--
ALTER TABLE `salesman_price`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `salesman_text`
--
ALTER TABLE `salesman_text`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salesman_varchar`
--
ALTER TABLE `salesman_varchar`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `shipping_decimal`
--
ALTER TABLE `shipping_decimal`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_int`
--
ALTER TABLE `shipping_int`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_text`
--
ALTER TABLE `shipping_text`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_varchar`
--
ALTER TABLE `shipping_varchar`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `address_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendor_decimal`
--
ALTER TABLE `vendor_decimal`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_int`
--
ALTER TABLE `vendor_int`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `vendor_text`
--
ALTER TABLE `vendor_text`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_varchar`
--
ALTER TABLE `vendor_varchar`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`billing_address_id`) REFERENCES `customer_address` (`address_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`shipping_address_id`) REFERENCES `customer_address` (`address_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `eav_attribute`
--
ALTER TABLE `eav_attribute`
  ADD CONSTRAINT `eav_attribute_ibfk_1` FOREIGN KEY (`entity_type_id`) REFERENCES `entity_type` (`entity_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eav_attribute_option`
--
ALTER TABLE `eav_attribute_option`
  ADD CONSTRAINT `eav_attribute_option_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_int`
--
ALTER TABLE `product_int`
  ADD CONSTRAINT `product_int_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`),
  ADD CONSTRAINT `product_int_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendor_address_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
