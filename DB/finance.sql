-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 10, 2021 at 07:43 PM
-- Server version: 8.0.26-0ubuntu0.20.04.2
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_validate_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `password_validate_time`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'superadmin@yopmail.com', '$2y$10$/qFoRxB5X.onHMOPNLIUreAsJKdWBZFT14WNDJdbgAtTlfDyo2Ro2', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `approval_lists`
--

CREATE TABLE `approval_lists` (
  `id` bigint UNSIGNED NOT NULL,
  `employe_id` int NOT NULL,
  `level_one_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_one_max` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_two_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_two_max` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_three_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_three_max` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_four_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_four_max` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_five_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_five_max` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `approval_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int DEFAULT NULL,
  `company_id` int NOT NULL,
  `location_id` int NOT NULL,
  `division_id` int NOT NULL,
  `department_id` int NOT NULL,
  `section_id` int NOT NULL,
  `financial_year` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget_proj_ref_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_contacts` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget_from_date` datetime NOT NULL,
  `budget_to_date` datetime NOT NULL,
  `budget_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget_type_id` int NOT NULL,
  `cost_center_id` int NOT NULL,
  `project_code_id` int NOT NULL,
  `project_in_charge` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`id`, `employee_id`, `company_id`, `location_id`, `division_id`, `department_id`, `section_id`, `financial_year`, `budget_proj_ref_no`, `vendor`, `vendor_contacts`, `budget_from_date`, `budget_to_date`, `budget_code`, `budget_type_id`, `cost_center_id`, `project_code_id`, `project_in_charge`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 1, 4, 1, 3, '2', 'B-001', 'Ashtech', '9820131511', '2021-08-06 22:10:34', '2021-08-06 22:10:34', 'B-001', 2, 1, 2, 'Bhise', '2021-08-06 16:40:34', '2021-08-06 16:40:34'),
(2, 6, 1, 1, 4, 1, 3, '2', 'Suraj', 'Tata', '8989898989', '2021-08-09 13:42:59', '2021-08-09 13:42:59', 'Btest', 2, 1, 2, 'Suraj', '2021-08-09 08:12:59', '2021-08-09 08:12:59');

-- --------------------------------------------------------

--
-- Table structure for table `budget_categories`
--

CREATE TABLE `budget_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budget_categories`
--

INSERT INTO `budget_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Hardware', '2021-06-28 08:13:22', '2021-06-28 09:16:19'),
(3, 'Software', '2021-06-28 09:16:28', '2021-06-28 09:16:28'),
(4, 'Network', '2021-06-28 09:16:36', '2021-06-28 09:16:36');

-- --------------------------------------------------------

--
-- Table structure for table `budget_details`
--

CREATE TABLE `budget_details` (
  `id` bigint UNSIGNED NOT NULL,
  `budget_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `company_id` int NOT NULL,
  `location_id` int NOT NULL,
  `division_id` int NOT NULL,
  `department_id` int NOT NULL,
  `section_id` int NOT NULL,
  `budget_category_id` int NOT NULL,
  `budget_subcategory_id` int NOT NULL,
  `budget_for` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget_quantity` double NOT NULL,
  `budget_rate` double NOT NULL,
  `budget_amount` double NOT NULL,
  `budget_explanation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `specifications` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budget_details`
--

INSERT INTO `budget_details` (`id`, `budget_id`, `employee_id`, `company_id`, `location_id`, `division_id`, `department_id`, `section_id`, `budget_category_id`, `budget_subcategory_id`, `budget_for`, `budget_quantity`, `budget_rate`, `budget_amount`, `budget_explanation`, `specifications`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 1, 1, 4, 0, 0, 2, 4, 'B-1', 10, 1000, 10000, NULL, 'Intel Pentium 5 4 core, 8 GB RAM, 500 GB SSD, 1 Serial, 1 parallel, 2 USB, HDMI Ports, 13 inch display screen, light weight laptop', NULL, '2021-08-06 16:40:53', '2021-08-06 16:40:53'),
(2, 1, 6, 1, 1, 4, 0, 0, 2, 4, 'B-2', 20, 500, 10000, NULL, 'Laptops', NULL, '2021-08-06 16:42:50', '2021-08-06 16:54:56'),
(3, 2, 6, 1, 1, 4, 0, 0, 2, 4, 'BB-1', 10, 1000, 10000, NULL, 'Laptops', NULL, '2021-08-09 08:13:32', '2021-08-09 08:13:32'),
(4, 2, 6, 1, 1, 4, 0, 0, 2, 11, 'BB-2', 10, 2000, 20000, NULL, 'Printers', NULL, '2021-08-09 08:14:01', '2021-08-09 08:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `budget_sub_categories`
--

CREATE TABLE `budget_sub_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget_category_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budget_sub_categories`
--

INSERT INTO `budget_sub_categories` (`id`, `name`, `budget_category_id`, `created_at`, `updated_at`) VALUES
(2, 'Microsoft Licenses', 3, '2021-06-29 00:12:24', '2021-06-29 00:13:00'),
(3, 'Microsoft AMC', 3, '2021-06-29 00:12:47', '2021-06-29 00:12:47'),
(4, 'Laptops', 2, '2021-07-07 03:26:48', '2021-07-07 03:26:48'),
(5, 'Servers', 2, '2021-07-07 03:27:02', '2021-07-07 03:27:02'),
(6, 'Storages', 2, '2021-07-07 03:27:18', '2021-07-07 03:27:18'),
(7, 'Antivirus', 3, '2021-07-07 03:27:36', '2021-07-07 03:27:36'),
(8, 'Jio', 4, '2021-07-07 03:28:03', '2021-07-07 03:28:03'),
(9, 'BSNL Fiber', 4, '2021-07-07 03:28:29', '2021-07-07 03:28:29'),
(10, 'Hardware AMC', 2, '2021-07-07 06:37:19', '2021-07-07 06:37:19'),
(11, 'Printers', 2, '2021-07-25 23:53:54', '2021-07-25 23:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `budget_types`
--

CREATE TABLE `budget_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budget_types`
--

INSERT INTO `budget_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Capex', '2021-06-29 00:04:15', '2021-06-29 00:10:30'),
(3, 'Opex', '2021-06-29 00:10:20', '2021-06-29 00:10:20');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `manager_email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `manager_email`, `created_at`, `updated_at`) VALUES
(1, 'J B Chemicals', 'company@gmail.com', '2021-06-28 04:24:12', '2021-06-29 00:14:21'),
(2, 'Lekar Pharma', 'suresh.bhise@jbcpl.com', '2021-06-29 00:14:09', '2021-06-29 00:14:09');

-- --------------------------------------------------------

--
-- Table structure for table `cost_centers`
--

CREATE TABLE `cost_centers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cost_centers`
--

INSERT INTO `cost_centers` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Center-001', '2021-07-02 00:20:36', '2021-07-02 00:20:48'),
(2, 'Center-002', '2021-07-02 00:20:36', '2021-07-02 00:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `manager_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `manager_email`, `division_id`, `created_at`, `updated_at`) VALUES
(1, 'IT', 'xyz@yopmail.com', 4, '2021-06-28 04:39:37', '2021-07-07 06:33:15'),
(3, 'HR', 'anita@yopmail.com', 4, '2021-07-07 04:39:02', '2021-07-07 06:33:00'),
(4, 'Legal', 'legal@jbcpl.com', 4, '2021-07-07 06:32:45', '2021-07-07 06:32:45'),
(5, 'Jiva', 'jiva@yopmail.com', 5, '2021-07-21 02:50:11', '2021-07-21 02:50:11'),
(6, 'Diva', 'diva@yopmail.com', 5, '2021-07-21 02:53:27', '2021-07-21 02:53:27'),
(7, 'Viva', 'viva@yopmail.com', 5, '2021-07-21 02:54:03', '2021-07-21 02:54:03'),
(8, 'Neo', 'neo@yopmail.com', 5, '2021-07-21 02:55:08', '2021-07-21 02:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `manager_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `manager_email`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 'Jiva', 'jiva@jbcpl.com', 1, '2021-06-28 04:24:44', '2021-06-29 00:14:53'),
(3, 'Viva', 'viva@jbcpl.com', 1, '2021-06-29 00:15:06', '2021-06-29 00:15:06'),
(4, 'Corporate', 'suresh.bhise@jbcpl.com', 1, '2021-07-07 06:32:17', '2021-07-07 06:32:17'),
(5, 'Sales', 'saleperson@yopmail.com', 1, '2021-07-20 22:19:39', '2021-07-20 22:19:39');

-- --------------------------------------------------------

--
-- Table structure for table `expensives`
--

CREATE TABLE `expensives` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int NOT NULL,
  `company_id` int NOT NULL,
  `division_id` int NOT NULL,
  `department_id` int NOT NULL,
  `section_id` int NOT NULL,
  `budget_id` int NOT NULL,
  `financial_year` int NOT NULL,
  `proj_ref_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `what_is_required` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why_required` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scope_of_work` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `what_will_change` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_contacts` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason_for_selecting_vendor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `assumptions_or_inclusions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exceptions_or_exclusions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_terms` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `warranty_guarantee_details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `expensive_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget_type_id` int NOT NULL,
  `cost_center_id` int NOT NULL,
  `project_code_id` int NOT NULL,
  `project_in_charge` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_id` int DEFAULT NULL,
  `submited` tinyint(1) NOT NULL COMMENT '0=>not,1=>yes',
  `is_approved` int DEFAULT NULL COMMENT '0=>not,1=>approved,2=>rejected',
  `is_cloned` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expensives`
--

INSERT INTO `expensives` (`id`, `employee_id`, `company_id`, `division_id`, `department_id`, `section_id`, `budget_id`, `financial_year`, `proj_ref_no`, `what_is_required`, `why_required`, `scope_of_work`, `what_will_change`, `vendor`, `vendor_contacts`, `reason_for_selecting_vendor`, `assumptions_or_inclusions`, `exceptions_or_exclusions`, `payment_terms`, `warranty_guarantee_details`, `from_date`, `to_date`, `expensive_code`, `budget_type_id`, `cost_center_id`, `project_code_id`, `project_in_charge`, `location_id`, `submited`, `is_approved`, `is_cloned`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 4, 1, 3, 1, 2, 'B-001', NULL, NULL, NULL, NULL, 'Ashtech', '9820131511', 'dummy reasons for selecting a vendor', 'vdvdv', 'dummy exceptions or exclusions', 'second expense', 'dummy warranty guarantee details', '2021-08-06 11:52:11', '2021-08-06 11:52:11', 'B-001', 2, 1, 2, 'Bhise', NULL, 1, 1, 0, '2021-08-09 06:22:11', '2021-08-09 07:49:24'),
(2, 3, 1, 4, 1, 3, 1, 2, 'B-001', NULL, NULL, NULL, NULL, 'Ashtech', '9820131511', 'dummy reasons for selecting a vendor', 'dvdfv', 'second expense', 'second expense', 'dummy warranty guarantee details', '2021-08-06 11:59:03', '2021-08-06 11:59:03', 'B-001', 2, 1, 2, 'Bhise', NULL, 1, 0, 0, '2021-08-09 06:29:03', '2021-08-09 06:29:20'),
(3, 3, 1, 4, 1, 3, 2, 2, 'Suraj', NULL, NULL, NULL, NULL, 'Tata', '8989898989', 'dummy reasons for selecting a vendor', 'vdvdv', 'second expense', 'second expense', 'dummy warranty guarantee details', '2021-08-09 13:59:50', '2021-08-09 13:59:50', 'Btest', 2, 1, 2, 'Suraj', NULL, 1, 0, 0, '2021-08-09 08:29:50', '2021-08-09 08:30:08');

-- --------------------------------------------------------

--
-- Table structure for table `expensive_details`
--

CREATE TABLE `expensive_details` (
  `id` bigint UNSIGNED NOT NULL,
  `expensive_id` int NOT NULL,
  `budget_id` int NOT NULL,
  `budget_detail_id` int NOT NULL,
  `budget_category_id` int NOT NULL,
  `budget_subcategory_id` int NOT NULL,
  `expensive_for` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expensive_quantity` double NOT NULL,
  `expensive_rate` double NOT NULL,
  `expensive_amount` double NOT NULL,
  `budget_amt` double NOT NULL,
  `submited_expense` double NOT NULL,
  `expense_balance` double NOT NULL,
  `expensive_explanation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `specifications` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_rejected` tinyint(1) NOT NULL COMMENT '0=>not,1=>yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expensive_details`
--

INSERT INTO `expensive_details` (`id`, `expensive_id`, `budget_id`, `budget_detail_id`, `budget_category_id`, `budget_subcategory_id`, `expensive_for`, `expensive_quantity`, `expensive_rate`, `expensive_amount`, `budget_amt`, `submited_expense`, `expense_balance`, `expensive_explanation`, `specifications`, `image`, `is_rejected`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, 4, 'B-1', 1, 500, 500, 20000, 0, 14500, NULL, 'Intel Pentium 5 4 core, 8 GB RAM, 500 GB SSD, 1 Serial, 1 parallel, 2 USB, HDMI Ports, 13 inch display screen, light weight laptop', NULL, 0, '2021-08-09 06:22:24', '2021-08-09 06:29:20'),
(2, 1, 1, 2, 2, 4, 'B-2', 2, 500, 1000, 20000, 0, 14500, NULL, 'Laptops', NULL, 0, '2021-08-09 06:22:31', '2021-08-09 06:29:20'),
(3, 2, 1, 1, 2, 4, 'B-1', 2, 1000, 2000, 20000, 1500, 14500, NULL, 'Intel Pentium 5 4 core, 8 GB RAM, 500 GB SSD, 1 Serial, 1 parallel, 2 USB, HDMI Ports, 13 inch display screen, light weight laptop', NULL, 0, '2021-08-09 06:29:10', '2021-08-09 06:29:20'),
(4, 2, 1, 2, 2, 4, 'B-2', 4, 500, 2000, 20000, 1500, 14500, NULL, 'Laptops', NULL, 0, '2021-08-09 06:29:15', '2021-08-09 06:29:20'),
(5, 3, 2, 3, 2, 4, 'BB-1', 10, 1000, 10000, 30000, 0, 0, NULL, 'Laptops', NULL, 0, '2021-08-09 08:29:57', '2021-08-09 08:30:08'),
(6, 3, 2, 4, 2, 11, 'BB-2', 10, 2000, 20000, 30000, 0, 0, NULL, 'Printers', NULL, 0, '2021-08-09 08:30:02', '2021-08-09 08:30:08');

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

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, '1c9a090e-a028-4440-9d67-022bb3cbc9e2', 'database', 'default', '{\"uuid\":\"1c9a090e-a028-4440-9d67-022bb3cbc9e2\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":11:{s:12:\\\"\\u0000*\\u0000emailData\\\";a:6:{s:5:\\\"email\\\";s:16:\\\"vikdhr@gmail.com\\\";s:8:\\\"receiver\\\";s:5:\\\"vikas\\\";s:6:\\\"sender\\\";s:6:\\\"ganesh\\\";s:6:\\\"budget\\\";d:18000;s:10:\\\"submission\\\";s:4:\\\"2000\\\";s:7:\\\"balance\\\";d:13000;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'ParseError: syntax error, unexpected token \";\", expecting \")\" in /var/www/html/finance/storage/framework/views/897e48a011f2b8e325b0036005e380becfa36cb8.php:62\nStack trace:\n#0 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Filesystem/Filesystem.php(108): Illuminate\\Filesystem\\Filesystem::Illuminate\\Filesystem\\{closure}()\n#1 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/Engines/PhpEngine.php(58): Illuminate\\Filesystem\\Filesystem->getRequire()\n#2 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/Engines/CompilerEngine.php(61): Illuminate\\View\\Engines\\PhpEngine->evaluatePath()\n#3 /var/www/html/finance/vendor/facade/ignition/src/Views/Engines/CompilerEngine.php(37): Illuminate\\View\\Engines\\CompilerEngine->get()\n#4 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/View.php(139): Facade\\Ignition\\Views\\Engines\\CompilerEngine->get()\n#5 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/View.php(122): Illuminate\\View\\View->getContents()\n#6 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/View.php(91): Illuminate\\View\\View->renderContents()\n#7 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(382): Illuminate\\View\\View->render()\n#8 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(355): Illuminate\\Mail\\Mailer->renderView()\n#9 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(273): Illuminate\\Mail\\Mailer->addContent()\n#10 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(521): Illuminate\\Mail\\Mailer->send()\n#11 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(261): Illuminate\\Mail\\MailManager->__call()\n#12 /var/www/html/finance/app/Jobs/SendEmailJob.php(53): Illuminate\\Support\\Facades\\Facade::__callStatic()\n#13 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendEmailJob->handle()\n#14 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#15 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#16 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#17 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#18 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#19 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#20 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#21 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#22 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(120): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#23 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#24 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#25 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then()\n#26 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#27 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#28 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#29 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(378): Illuminate\\Queue\\Worker->process()\n#30 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(329): Illuminate\\Queue\\Worker->runJob()\n#31 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(117): Illuminate\\Queue\\Worker->runNextJob()\n#32 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#33 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#34 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#35 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#36 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#37 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#38 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Console/Command.php(136): Illuminate\\Container\\Container->call()\n#39 /var/www/html/finance/vendor/symfony/console/Command/Command.php(299): Illuminate\\Console\\Command->execute()\n#40 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#41 /var/www/html/finance/vendor/symfony/console/Application.php(978): Illuminate\\Console\\Command->run()\n#42 /var/www/html/finance/vendor/symfony/console/Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand()\n#43 /var/www/html/finance/vendor/symfony/console/Application.php(167): Symfony\\Component\\Console\\Application->doRun()\n#44 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Console/Application.php(92): Symfony\\Component\\Console\\Application->run()\n#45 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#46 /var/www/html/finance/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#47 {main}\n\nNext Facade\\Ignition\\Exceptions\\ViewException: syntax error, unexpected token \";\", expecting \")\" (View: /var/www/html/finance/resources/views/email/expense_submit.blade.php) in /var/www/html/finance/resources/views/email/expense_submit.blade.php:62\nStack trace:\n#0 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Filesystem/Filesystem.php(108): Illuminate\\Filesystem\\Filesystem::Illuminate\\Filesystem\\{closure}()\n#1 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/Engines/PhpEngine.php(58): Illuminate\\Filesystem\\Filesystem->getRequire()\n#2 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/Engines/CompilerEngine.php(61): Illuminate\\View\\Engines\\PhpEngine->evaluatePath()\n#3 /var/www/html/finance/vendor/facade/ignition/src/Views/Engines/CompilerEngine.php(37): Illuminate\\View\\Engines\\CompilerEngine->get()\n#4 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/View.php(139): Facade\\Ignition\\Views\\Engines\\CompilerEngine->get()\n#5 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/View.php(122): Illuminate\\View\\View->getContents()\n#6 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/View.php(91): Illuminate\\View\\View->renderContents()\n#7 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(382): Illuminate\\View\\View->render()\n#8 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(355): Illuminate\\Mail\\Mailer->renderView()\n#9 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(273): Illuminate\\Mail\\Mailer->addContent()\n#10 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(521): Illuminate\\Mail\\Mailer->send()\n#11 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(261): Illuminate\\Mail\\MailManager->__call()\n#12 /var/www/html/finance/app/Jobs/SendEmailJob.php(53): Illuminate\\Support\\Facades\\Facade::__callStatic()\n#13 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendEmailJob->handle()\n#14 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#15 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#16 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#17 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#18 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#19 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#20 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#21 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#22 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(120): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#23 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#24 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#25 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then()\n#26 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#27 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#28 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#29 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(378): Illuminate\\Queue\\Worker->process()\n#30 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(329): Illuminate\\Queue\\Worker->runJob()\n#31 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(117): Illuminate\\Queue\\Worker->runNextJob()\n#32 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#33 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#34 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#35 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#36 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#37 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#38 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Console/Command.php(136): Illuminate\\Container\\Container->call()\n#39 /var/www/html/finance/vendor/symfony/console/Command/Command.php(299): Illuminate\\Console\\Command->execute()\n#40 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#41 /var/www/html/finance/vendor/symfony/console/Application.php(978): Illuminate\\Console\\Command->run()\n#42 /var/www/html/finance/vendor/symfony/console/Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand()\n#43 /var/www/html/finance/vendor/symfony/console/Application.php(167): Symfony\\Component\\Console\\Application->doRun()\n#44 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Console/Application.php(92): Symfony\\Component\\Console\\Application->run()\n#45 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#46 /var/www/html/finance/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#47 {main}', '2021-08-06 13:23:50'),
(2, '37aa574d-a3b4-4cbb-97a4-54f20fd7f23d', 'database', 'default', '{\"uuid\":\"37aa574d-a3b4-4cbb-97a4-54f20fd7f23d\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":11:{s:12:\\\"\\u0000*\\u0000emailData\\\";a:3:{s:5:\\\"email\\\";s:18:\\\"suresh@yopmail.com\\\";s:8:\\\"receiver\\\";s:6:\\\"suresh\\\";s:6:\\\"sender\\\";s:5:\\\"vikas\\\";}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'ErrorException: Undefined array key \"budget\" in /var/www/html/finance/storage/framework/views/897e48a011f2b8e325b0036005e380becfa36cb8.php:50\nStack trace:\n#0 /var/www/html/finance/storage/framework/views/897e48a011f2b8e325b0036005e380becfa36cb8.php(50): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Filesystem/Filesystem.php(107): require(\'...\')\n#2 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Filesystem/Filesystem.php(108): Illuminate\\Filesystem\\Filesystem::Illuminate\\Filesystem\\{closure}()\n#3 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/Engines/PhpEngine.php(58): Illuminate\\Filesystem\\Filesystem->getRequire()\n#4 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/Engines/CompilerEngine.php(61): Illuminate\\View\\Engines\\PhpEngine->evaluatePath()\n#5 /var/www/html/finance/vendor/facade/ignition/src/Views/Engines/CompilerEngine.php(37): Illuminate\\View\\Engines\\CompilerEngine->get()\n#6 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/View.php(139): Facade\\Ignition\\Views\\Engines\\CompilerEngine->get()\n#7 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/View.php(122): Illuminate\\View\\View->getContents()\n#8 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/View.php(91): Illuminate\\View\\View->renderContents()\n#9 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(382): Illuminate\\View\\View->render()\n#10 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(355): Illuminate\\Mail\\Mailer->renderView()\n#11 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(273): Illuminate\\Mail\\Mailer->addContent()\n#12 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(521): Illuminate\\Mail\\Mailer->send()\n#13 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(261): Illuminate\\Mail\\MailManager->__call()\n#14 /var/www/html/finance/app/Jobs/SendEmailJob.php(53): Illuminate\\Support\\Facades\\Facade::__callStatic()\n#15 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendEmailJob->handle()\n#16 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#17 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#18 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#19 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#20 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#21 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#22 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#23 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#24 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(120): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#25 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#26 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#27 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then()\n#28 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#29 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#30 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#31 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(378): Illuminate\\Queue\\Worker->process()\n#32 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(329): Illuminate\\Queue\\Worker->runJob()\n#33 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(117): Illuminate\\Queue\\Worker->runNextJob()\n#34 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#35 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#36 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#37 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#38 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#39 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#40 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Console/Command.php(136): Illuminate\\Container\\Container->call()\n#41 /var/www/html/finance/vendor/symfony/console/Command/Command.php(299): Illuminate\\Console\\Command->execute()\n#42 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#43 /var/www/html/finance/vendor/symfony/console/Application.php(978): Illuminate\\Console\\Command->run()\n#44 /var/www/html/finance/vendor/symfony/console/Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand()\n#45 /var/www/html/finance/vendor/symfony/console/Application.php(167): Symfony\\Component\\Console\\Application->doRun()\n#46 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Console/Application.php(92): Symfony\\Component\\Console\\Application->run()\n#47 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#48 /var/www/html/finance/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#49 {main}\n\nNext Facade\\Ignition\\Exceptions\\ViewException: Undefined array key \"budget\" (View: /var/www/html/finance/resources/views/email/expense_submit.blade.php) in /var/www/html/finance/resources/views/email/expense_submit.blade.php:50\nStack trace:\n#0 /var/www/html/finance/resources/views/email/expense_submit.blade.php(50): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Filesystem/Filesystem.php(107): require(\'...\')\n#2 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Filesystem/Filesystem.php(108): Illuminate\\Filesystem\\Filesystem::Illuminate\\Filesystem\\{closure}()\n#3 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/Engines/PhpEngine.php(58): Illuminate\\Filesystem\\Filesystem->getRequire()\n#4 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/Engines/CompilerEngine.php(61): Illuminate\\View\\Engines\\PhpEngine->evaluatePath()\n#5 /var/www/html/finance/vendor/facade/ignition/src/Views/Engines/CompilerEngine.php(37): Illuminate\\View\\Engines\\CompilerEngine->get()\n#6 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/View.php(139): Facade\\Ignition\\Views\\Engines\\CompilerEngine->get()\n#7 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/View.php(122): Illuminate\\View\\View->getContents()\n#8 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/View/View.php(91): Illuminate\\View\\View->renderContents()\n#9 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(382): Illuminate\\View\\View->render()\n#10 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(355): Illuminate\\Mail\\Mailer->renderView()\n#11 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(273): Illuminate\\Mail\\Mailer->addContent()\n#12 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Mail/MailManager.php(521): Illuminate\\Mail\\Mailer->send()\n#13 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(261): Illuminate\\Mail\\MailManager->__call()\n#14 /var/www/html/finance/app/Jobs/SendEmailJob.php(53): Illuminate\\Support\\Facades\\Facade::__callStatic()\n#15 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendEmailJob->handle()\n#16 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#17 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#18 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#19 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#20 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#21 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#22 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#23 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#24 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(120): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#25 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#26 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#27 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then()\n#28 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#29 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#30 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#31 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(378): Illuminate\\Queue\\Worker->process()\n#32 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(329): Illuminate\\Queue\\Worker->runJob()\n#33 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(117): Illuminate\\Queue\\Worker->runNextJob()\n#34 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#35 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#36 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#37 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#38 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#39 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#40 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Console/Command.php(136): Illuminate\\Container\\Container->call()\n#41 /var/www/html/finance/vendor/symfony/console/Command/Command.php(299): Illuminate\\Console\\Command->execute()\n#42 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#43 /var/www/html/finance/vendor/symfony/console/Application.php(978): Illuminate\\Console\\Command->run()\n#44 /var/www/html/finance/vendor/symfony/console/Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand()\n#45 /var/www/html/finance/vendor/symfony/console/Application.php(167): Symfony\\Component\\Console\\Application->doRun()\n#46 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Console/Application.php(92): Symfony\\Component\\Console\\Application->run()\n#47 /var/www/html/finance/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#48 /var/www/html/finance/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#49 {main}', '2021-08-06 15:18:03');

-- --------------------------------------------------------

--
-- Table structure for table `financial_years`
--

CREATE TABLE `financial_years` (
  `id` bigint UNSIGNED NOT NULL,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `financial_years`
--

INSERT INTO `financial_years` (`id`, `year`, `created_at`, `updated_at`) VALUES
(2, '2021-22', '2021-07-02 01:31:47', '2021-07-02 01:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(61, 'default', '{\"uuid\":\"25161ca8-1d1c-4e28-80a9-b3b6037a1129\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":11:{s:12:\\\"\\u0000*\\u0000emailData\\\";a:6:{s:5:\\\"email\\\";s:16:\\\"vikdhr@gmail.com\\\";s:8:\\\"receiver\\\";s:5:\\\"vikas\\\";s:6:\\\"sender\\\";s:6:\\\"ganesh\\\";s:6:\\\"budget\\\";d:20000;s:10:\\\"submission\\\";s:4:\\\"1500\\\";s:7:\\\"balance\\\";d:18500;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1628336162, 1628336162),
(62, 'default', '{\"uuid\":\"572bc2d2-48a3-4e27-a167-7af29dd8ec4b\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":11:{s:12:\\\"\\u0000*\\u0000emailData\\\";a:6:{s:5:\\\"email\\\";s:18:\\\"suresh@yopmail.com\\\";s:8:\\\"receiver\\\";s:6:\\\"suresh\\\";s:6:\\\"sender\\\";s:5:\\\"vikas\\\";s:6:\\\"budget\\\";d:20000;s:10:\\\"submission\\\";d:1500;s:7:\\\"balance\\\";d:18500;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1628336429, 1628336429),
(63, 'default', '{\"uuid\":\"d932c3e7-055d-4892-9f95-8d55b4a443c3\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":11:{s:12:\\\"\\u0000*\\u0000emailData\\\";a:6:{s:5:\\\"email\\\";s:16:\\\"vikdhr@gmail.com\\\";s:8:\\\"receiver\\\";s:5:\\\"vikas\\\";s:6:\\\"sender\\\";s:6:\\\"ganesh\\\";s:6:\\\"budget\\\";d:20000;s:10:\\\"submission\\\";s:4:\\\"4000\\\";s:7:\\\"balance\\\";d:16000;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1628352062, 1628352062),
(64, 'default', '{\"uuid\":\"81d94743-b438-4160-a78d-2c5878200906\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":11:{s:12:\\\"\\u0000*\\u0000emailData\\\";a:6:{s:5:\\\"email\\\";s:16:\\\"vikdhr@gmail.com\\\";s:8:\\\"receiver\\\";s:5:\\\"vikas\\\";s:6:\\\"sender\\\";s:6:\\\"ganesh\\\";s:6:\\\"budget\\\";d:20000;s:10:\\\"submission\\\";s:4:\\\"1500\\\";s:7:\\\"balance\\\";d:18500;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1628352398, 1628352398),
(65, 'default', '{\"uuid\":\"fd1b4133-0ba1-4797-ac36-ac181cc11502\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":11:{s:12:\\\"\\u0000*\\u0000emailData\\\";a:6:{s:5:\\\"email\\\";s:16:\\\"vikdhr@gmail.com\\\";s:8:\\\"receiver\\\";s:5:\\\"vikas\\\";s:6:\\\"sender\\\";s:6:\\\"ganesh\\\";s:6:\\\"budget\\\";d:20000;s:10:\\\"submission\\\";s:4:\\\"4000\\\";s:7:\\\"balance\\\";d:14500;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1628352461, 1628352461),
(66, 'default', '{\"uuid\":\"348f4d11-b565-4257-9c09-8532d24371d0\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":11:{s:12:\\\"\\u0000*\\u0000emailData\\\";a:6:{s:5:\\\"email\\\";s:16:\\\"vikdhr@gmail.com\\\";s:8:\\\"receiver\\\";s:5:\\\"vikas\\\";s:6:\\\"sender\\\";s:6:\\\"ganesh\\\";s:6:\\\"budget\\\";d:20000;s:10:\\\"submission\\\";s:4:\\\"1500\\\";s:7:\\\"balance\\\";d:18500;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1628439576, 1628439576),
(67, 'default', '{\"uuid\":\"c908b1f9-8a15-4653-aa7b-c641caf3d49d\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":11:{s:12:\\\"\\u0000*\\u0000emailData\\\";a:6:{s:5:\\\"email\\\";s:16:\\\"vikdhr@gmail.com\\\";s:8:\\\"receiver\\\";s:5:\\\"vikas\\\";s:6:\\\"sender\\\";s:6:\\\"ganesh\\\";s:6:\\\"budget\\\";d:20000;s:10:\\\"submission\\\";s:4:\\\"4000\\\";s:7:\\\"balance\\\";d:14500;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1628439639, 1628439639),
(68, 'default', '{\"uuid\":\"6714ad53-fddd-4c43-aaea-3a6f216e3b5e\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":11:{s:12:\\\"\\u0000*\\u0000emailData\\\";a:6:{s:5:\\\"email\\\";s:16:\\\"vikdhr@gmail.com\\\";s:8:\\\"receiver\\\";s:5:\\\"vikas\\\";s:6:\\\"sender\\\";s:6:\\\"ganesh\\\";s:6:\\\"budget\\\";d:20000;s:10:\\\"submission\\\";s:4:\\\"1500\\\";s:7:\\\"balance\\\";d:18500;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1628484710, 1628484710),
(69, 'default', '{\"uuid\":\"c5c54408-6b3b-43fa-8d47-b999d2796ca4\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":11:{s:12:\\\"\\u0000*\\u0000emailData\\\";a:6:{s:5:\\\"email\\\";s:16:\\\"vikdhr@gmail.com\\\";s:8:\\\"receiver\\\";s:5:\\\"vikas\\\";s:6:\\\"sender\\\";s:6:\\\"ganesh\\\";s:6:\\\"budget\\\";d:20000;s:10:\\\"submission\\\";s:4:\\\"4000\\\";s:7:\\\"balance\\\";d:14500;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1628484819, 1628484819),
(70, 'default', '{\"uuid\":\"61e5fe09-755c-4d3b-9130-4776bdbc5c4b\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":11:{s:12:\\\"\\u0000*\\u0000emailData\\\";a:6:{s:5:\\\"email\\\";s:16:\\\"vikdhr@gmail.com\\\";s:8:\\\"receiver\\\";s:5:\\\"vikas\\\";s:6:\\\"sender\\\";s:6:\\\"ganesh\\\";s:6:\\\"budget\\\";d:20000;s:10:\\\"submission\\\";s:4:\\\"1500\\\";s:7:\\\"balance\\\";d:18500;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1628485102, 1628485102),
(71, 'default', '{\"uuid\":\"56accdbf-5bd9-4aaf-b982-c273a0aa237d\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":11:{s:12:\\\"\\u0000*\\u0000emailData\\\";a:6:{s:5:\\\"email\\\";s:16:\\\"vikdhr@gmail.com\\\";s:8:\\\"receiver\\\";s:5:\\\"vikas\\\";s:6:\\\"sender\\\";s:6:\\\"ganesh\\\";s:6:\\\"budget\\\";d:20000;s:10:\\\"submission\\\";s:4:\\\"4000\\\";s:7:\\\"balance\\\";d:14500;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1628485105, 1628485105),
(72, 'default', '{\"uuid\":\"c51eacf8-54b3-442a-a1e6-c5a41bbd6682\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":11:{s:12:\\\"\\u0000*\\u0000emailData\\\";a:6:{s:5:\\\"email\\\";s:16:\\\"vikdhr@gmail.com\\\";s:8:\\\"receiver\\\";s:5:\\\"vikas\\\";s:6:\\\"sender\\\";s:6:\\\"ganesh\\\";s:6:\\\"budget\\\";d:20000;s:10:\\\"submission\\\";s:4:\\\"1500\\\";s:7:\\\"balance\\\";d:18500;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1628490523, 1628490523),
(73, 'default', '{\"uuid\":\"b421106c-cf86-413d-a9da-5f2cfd4f2348\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":11:{s:12:\\\"\\u0000*\\u0000emailData\\\";a:6:{s:5:\\\"email\\\";s:16:\\\"vikdhr@gmail.com\\\";s:8:\\\"receiver\\\";s:5:\\\"vikas\\\";s:6:\\\"sender\\\";s:6:\\\"ganesh\\\";s:6:\\\"budget\\\";d:20000;s:10:\\\"submission\\\";s:4:\\\"4000\\\";s:7:\\\"balance\\\";d:14500;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1628490560, 1628490560),
(74, 'default', '{\"uuid\":\"5481f765-4d28-42fc-acb5-d8ca3f0a0157\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":11:{s:12:\\\"\\u0000*\\u0000emailData\\\";a:6:{s:5:\\\"email\\\";s:18:\\\"suresh@yopmail.com\\\";s:8:\\\"receiver\\\";s:6:\\\"suresh\\\";s:6:\\\"sender\\\";s:5:\\\"vikas\\\";s:6:\\\"budget\\\";d:20000;s:10:\\\"submission\\\";d:1500;s:7:\\\"balance\\\";d:14500;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1628495147, 1628495147),
(75, 'default', '{\"uuid\":\"5843104f-3857-4fff-9cfb-3d45d7258078\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":11:{s:12:\\\"\\u0000*\\u0000emailData\\\";a:6:{s:5:\\\"email\\\";s:16:\\\"vikdhr@gmail.com\\\";s:8:\\\"receiver\\\";s:5:\\\"vikas\\\";s:6:\\\"sender\\\";s:6:\\\"ganesh\\\";s:6:\\\"budget\\\";d:30000;s:10:\\\"submission\\\";s:5:\\\"30000\\\";s:7:\\\"balance\\\";d:0;}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1628497808, 1628497808);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `manager_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `manager_email`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 'Mumbai', 'sachin@gmail.com', 1, '2021-06-28 06:08:59', '2021-07-02 01:32:46'),
(2, 'Thane', 'sujay@jbcpl.com', 1, '2021-07-07 06:31:31', '2021-07-07 06:31:31'),
(3, 'Thane RO', 'suresh.bhise@jbcpl.com', 1, '2021-07-07 06:31:56', '2021-07-07 06:31:56');

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
(5, '2021_06_25_125102_division', 2),
(6, '2021_06_25_134457_admins', 3),
(7, '2021_06_25_151948_department', 4),
(13, '2021_06_28_045258_company', 5),
(14, '2021_06_28_063704_add_company_id_to_division', 5),
(15, '2021_06_28_094702_add_email_devision', 6),
(16, '2021_06_28_100347_add_email_department', 7),
(17, '2021_06_28_101447_section', 8),
(18, '2021_06_28_112016_location', 9),
(19, '2021_06_28_124838_budget_category', 10),
(20, '2021_06_28_134614_subcategories', 11),
(21, '2021_06_29_045012_budget_type', 12),
(22, '2021_06_29_062529_add_column_users', 13),
(23, '2021_06_29_080301_supplier', 14),
(28, '2021_06_29_093536_budget', 15),
(31, '2021_06_30_043820_approval', 16),
(33, '2021_06_30_092503_add_user_id_budget', 17),
(35, '2021_06_30_102807_remove_column_from_budget', 18),
(36, '2021_07_01_042807_remove_column_from_budget_table', 19),
(38, '2021_07_01_052310_budget_details', 20),
(39, '2021_07_01_153256_projectcode', 21),
(40, '2021_07_02_050046_cost_center', 22),
(41, '2021_07_02_061015_financial_year', 23),
(42, '2021_07_02_071847_remove_coloum_from_budget_details', 24),
(43, '2021_07_02_072315_add_column_budget', 25),
(44, '2021_07_05_103812_remove_budget_type', 26),
(54, '2021_07_05_144133_expensive', 27),
(55, '2021_07_05_152159_expensice_details', 27),
(56, '2021_07_07_054242_add_column_expenses', 28),
(57, '2021_07_07_092306_add_id_columns_budget', 29),
(58, '2021_07_07_094020_add_column_budget_details', 30),
(60, '2021_07_08_074624_routing', 31),
(63, '2021_07_08_173451_add_column_expenses_submit', 32),
(65, '2021_07_09_045820_rounting_status', 33),
(66, '2021_07_12_065029_add_cloned_expenseive', 34),
(68, '2021_07_14_063803_add_rejected_by_to_rounting', 35),
(69, '2021_07_21_083402_add_budget_detail_id_expensive', 36),
(155, '2021_07_22_033956_calculate_view', 37),
(156, '2021_07_22_071709_view_budget_detail', 37),
(157, '2021_07_26_045352_type_category_subcategory_status', 37),
(158, '2021_07_26_092821_category_status', 37),
(159, '2021_07_27_055348_view_budget_for_expense', 38),
(160, '2021_07_27_090648_type_wise_budgets', 38),
(161, '2021_08_02_124727_create_jobs_table', 39),
(164, '2021_08_04_222406_add_budget_expense_detail', 40);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('superadmin@yopmail.com', '$2y$10$VYhj2Ye6UOCiW6OmtX.40u0x2ILtzjjLQckIpLLHOPSMilxTWS/.i', '2021-06-25 04:50:24');

-- --------------------------------------------------------

--
-- Table structure for table `project_codes`
--

CREATE TABLE `project_codes` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_codes`
--

INSERT INTO `project_codes` (`id`, `code`, `created_at`, `updated_at`) VALUES
(1, 'ISO-27001', '2021-07-02 00:21:04', '2021-07-07 06:38:17'),
(2, 'Budgeting App', '2021-07-02 00:21:04', '2021-07-07 06:37:40'),
(3, 'Mercer', '2021-07-07 06:38:30', '2021-07-07 06:38:30'),
(4, 'Covid Support', '2021-07-07 06:39:16', '2021-07-07 06:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `rountings`
--

CREATE TABLE `rountings` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int NOT NULL,
  `manager_id` int NOT NULL,
  `level` int NOT NULL,
  `maximum_amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rountings`
--

INSERT INTO `rountings` (`id`, `employee_id`, `manager_id`, `level`, `maximum_amount`, `created_at`, `updated_at`) VALUES
(1, 3, 5, 1, 1000, '2021-08-09 06:23:36', '2021-08-09 06:23:36'),
(2, 3, 6, 2, 2000, '2021-08-09 06:24:01', '2021-08-09 06:24:01'),
(3, 3, 17, 3, 3000, '2021-08-09 06:24:18', '2021-08-09 06:24:18'),
(4, 1, 5, 1, 1000, '2021-08-09 06:24:37', '2021-08-09 06:24:37'),
(5, 1, 6, 2, 2000, '2021-08-09 06:25:04', '2021-08-09 06:25:04');

-- --------------------------------------------------------

--
-- Table structure for table `rounting_status`
--

CREATE TABLE `rounting_status` (
  `id` bigint UNSIGNED NOT NULL,
  `expense_id` int NOT NULL,
  `originator_id` int NOT NULL,
  `expense_amount` double NOT NULL,
  `subimtted_by` int NOT NULL,
  `approver_id` int NOT NULL,
  `level` int NOT NULL,
  `maximum_amount` double NOT NULL,
  `approval_status` int NOT NULL COMMENT '0=>Pending ,1=>approved, 2=>disapproved',
  `rejected_by` int DEFAULT NULL,
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rounting_status`
--

INSERT INTO `rounting_status` (`id`, `expense_id`, `originator_id`, `expense_amount`, `subimtted_by`, `approver_id`, `level`, `maximum_amount`, `approval_status`, `rejected_by`, `reason`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1500, 3, 5, 1, 1000, 1, NULL, NULL, '2021-08-09 06:28:43', '2021-08-09 07:45:47'),
(2, 2, 3, 4000, 3, 5, 1, 1000, 0, NULL, NULL, '2021-08-09 06:29:20', '2021-08-09 06:29:20'),
(3, 1, 3, 1500, 5, 6, 2, 2000, 1, NULL, NULL, '2021-08-09 07:45:47', '2021-08-09 07:49:24'),
(4, 3, 3, 30000, 3, 5, 1, 1000, 0, NULL, NULL, '2021-08-09 08:30:08', '2021-08-09 08:30:08');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `manager_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `manager_email`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'Networking', 'sachin@gmail.com', 1, '2021-06-28 05:31:47', '2021-07-02 01:33:12'),
(2, 'development', 'development@gmail.com', 3, '2021-07-07 04:40:51', '2021-07-07 04:40:51'),
(3, 'Infrastructure', 'Infrastructure@yopmail.com', 1, '2021-07-07 04:41:14', '2021-07-07 04:41:14'),
(4, 'Network', 'Network@gmail.com', 1, '2021-07-07 04:42:02', '2021-07-07 04:42:02'),
(5, 'Applications', 'vikas@yopmail.com', 1, '2021-07-20 07:16:41', '2021-07-20 07:16:41'),
(6, 'East', 'east@yopmail.com', 5, '2021-07-21 02:57:24', '2021-07-21 02:57:24'),
(7, 'West', 'west@yopmail.com', 5, '2021-07-21 02:57:52', '2021-07-21 02:57:52'),
(8, 'South', 'south@yopmail.com', 5, '2021-07-21 02:58:41', '2021-07-21 02:58:41'),
(9, 'North', 'north@yopmail.com', 5, '2021-07-21 02:59:04', '2021-07-21 02:59:04');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `contact_person`, `mobile_number`, `address`, `created_at`, `updated_at`) VALUES
(1, 'eBorn', 'eborn@jbcpl.com', 'Prakash Bagal', '9820131511', 'Thane', '2021-06-29 03:05:56', '2021-07-07 06:35:44'),
(2, 'Ashtech Infotech', 'ashtech@jbcpl.com', 'Vinod Menon', '9820131511', 'NEAR SHIV MANDIR', '2021-06-29 03:20:34', '2021-07-07 06:35:04');

-- --------------------------------------------------------

--
-- Stand-in structure for view `type_category_status`
-- (See below for the actual view)
--
CREATE TABLE `type_category_status` (
`budget_amount` double
,`cat_name` varchar(200)
,`company_id` int
,`department_id` int
,`division_id` int
,`employee_id` int
,`expense_amount` double
,`location_id` int
,`section_id` int
,`TYPE` varchar(200)
,`year` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `type_category_subcategory_status`
-- (See below for the actual view)
--
CREATE TABLE `type_category_subcategory_status` (
`budget_amount` double
,`cat_name` varchar(200)
,`company_id` int
,`department_id` int
,`division_id` int
,`employee_id` int
,`expense_amount` double
,`location_id` int
,`section_id` int
,`sub_cat_name` varchar(200)
,`TYPE` varchar(200)
,`year` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int NOT NULL,
  `division_id` int NOT NULL,
  `location_id` int NOT NULL,
  `department_id` int NOT NULL,
  `section_id` int NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_validate_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `company_id`, `division_id`, `location_id`, `department_id`, `section_id`, `remember_token`, `password_validate_time`, `created_at`, `updated_at`) VALUES
(1, 'Amod', 'amod@yopmail.com', NULL, '$2y$10$4hjUBQ.fvGcBoQEz3F2.pOi4BfkPokQHPF18izUXXYar25Vtqad8C', 1, 4, 1, 1, 3, 'XbEYHlmxvq8xuvGB2DKbt57LuuDJV41wOi5l7N8RMDOMjmrN0bAYuP7TIbDY', '2021-06-25 12:28:57', NULL, '2021-07-19 07:15:33'),
(3, 'ganesh', 'ganesh@yopmail.com', NULL, '$2y$10$4hjUBQ.fvGcBoQEz3F2.pOi4BfkPokQHPF18izUXXYar25Vtqad8C', 1, 4, 1, 1, 3, NULL, NULL, '2021-06-29 02:03:49', '2021-07-07 04:45:34'),
(4, 'anita', 'anita@yopmail.com', NULL, '$2y$10$4hjUBQ.fvGcBoQEz3F2.pOi4BfkPokQHPF18izUXXYar25Vtqad8C', 1, 4, 1, 3, 2, NULL, NULL, '2021-06-29 04:01:57', '2021-07-19 07:15:01'),
(5, 'vikas', 'vikdhr@gmail.com', NULL, '$2y$10$4hjUBQ.fvGcBoQEz3F2.pOi4BfkPokQHPF18izUXXYar25Vtqad8C', 1, 4, 1, 1, 0, NULL, NULL, '2021-06-29 08:20:23', '2021-07-07 04:38:24'),
(6, 'suresh', 'suresh@yopmail.com', NULL, '$2y$10$4hjUBQ.fvGcBoQEz3F2.pOi4BfkPokQHPF18izUXXYar25Vtqad8C', 1, 4, 1, 0, 0, NULL, NULL, '2021-07-07 04:31:36', '2021-07-20 01:15:33'),
(7, 'sunita', 'sunita@yopmail.com', NULL, '$2y$10$4hjUBQ.fvGcBoQEz3F2.pOi4BfkPokQHPF18izUXXYar25Vtqad8C', 1, 1, 1, 0, 2, NULL, NULL, '2021-07-07 04:46:43', '2021-07-19 04:41:19'),
(8, 'owner', 'owner@yopmail.com', NULL, '$2y$10$LM6svQywy5JxMIqlmOKcAOCWF/oyKLn6fA78T6BAsJc7eywHrymmC', 1, 0, 0, 0, 0, NULL, NULL, '2021-07-19 04:45:13', '2021-07-19 04:45:13'),
(9, 'President', 'president@yopmail.com', NULL, '$2y$10$doHuiTXiyD25LKCaOWwJ3uNfO8ugXyPDDcVmEPde9Ca2Z/5bbqOGi', 1, 0, 1, 0, 0, NULL, NULL, '2021-07-19 06:11:07', '2021-07-19 06:11:07'),
(11, 'Prashant Desai', 'prashant@yopmail.com', NULL, '$2y$10$P1TqdpwxNXjvTGCvEY8zNenLd7kk/QLLLJ8Tdz4qv52f02Ifwi5MS', 1, 4, 1, 1, 5, NULL, NULL, '2021-07-20 07:17:16', '2021-07-20 07:17:16'),
(12, 'jiva-head', 'jiva-head@yopmail.com', NULL, '$2y$10$EGWJ.4s23sAsoVY4iU01ce1Tp9oAXge6zJkruGmBPNai/gn3rsk8K', 1, 5, 1, 5, 0, NULL, NULL, '2021-07-21 02:52:33', '2021-07-21 02:52:33'),
(13, 'diva-head', 'diva-head@yopmail.com', NULL, '$2y$10$Kd8dgnq0wGWt8Cb.oKqXFeJLIq3kiSU998efHMG8PsTCibcHcLATO', 1, 5, 1, 6, 0, NULL, NULL, '2021-07-21 02:53:36', '2021-07-21 02:53:36'),
(14, 'viva-head', 'viva-head@yopmail.com', NULL, '$2y$10$fh8BtR1ACKS3t22NatZujOT9mmg3W0zqZtpFbCZGhsrR9AVLLbA2u', 1, 5, 1, 7, 0, NULL, NULL, '2021-07-21 02:54:41', '2021-07-21 02:54:41'),
(15, 'neo-head', 'neo-head@yopmail.com', NULL, '$2y$10$8DYtO90kDfs.UK4aVxLgrOb8NvpQYbjhWfLp7Wa5SXVTAzg2BAMsm', 1, 5, 1, 8, 0, NULL, NULL, '2021-07-21 02:55:41', '2021-07-21 02:55:41'),
(16, 'sales-head', 'sales-head@yopmail.com', NULL, '$2y$10$3PMIGvdcIdITpyZ23nnCPOdVa.aS4dfixEZWYNgtxar78Gpo14CNm', 1, 5, 1, 0, 0, NULL, NULL, '2021-07-21 02:56:15', '2021-07-21 02:56:15'),
(17, 'ceo', 'ceo@yopmail.com', NULL, '$2y$10$ghXiGaS3wlLCquDvUYcJ4uawaHQluDMJ6VOzhAabwrnblWM2eKfxu', 1, 0, 1, 0, 0, NULL, NULL, '2021-07-21 02:56:47', '2021-07-21 02:56:47'),
(18, 'jiva-east-head', 'jiva-east-head@yopmail.com', NULL, '$2y$10$6AAb.he1tmPmUk0.n4hKGeCTiuUtzOakxERuZvKIx8.1tUv.BE6WK', 1, 5, 1, 5, 6, NULL, NULL, '2021-07-21 02:59:46', '2021-07-21 02:59:46'),
(19, 'jiva-west-head', 'jiva-west-head@yopmail.com', NULL, '$2y$10$3DlMZ9C5Bl8cw1p0cayvpOCNZgTdX5NjTn/8VtJRsudBuuATPxDNu', 1, 5, 1, 5, 7, NULL, NULL, '2021-07-21 03:00:20', '2021-07-21 03:00:20'),
(20, 'jiva-south-head', 'jiva-south-head@yopmail.com', NULL, '$2y$10$4jP4r7Cbs6qIb08y6Jhj.erGum6kxRx.i5gAVpoEvbIEwQsq1.KyO', 1, 5, 1, 5, 8, NULL, NULL, '2021-07-21 03:00:53', '2021-07-21 03:00:53'),
(21, 'jiva-north-head', 'jiva-north-head@yopmail.com', NULL, '$2y$10$ARL3vW87tue6SidKL8Ncy.IOmSXfg/RPUL4rxwhu5VsxDvYyceD0G', 1, 5, 1, 5, 9, NULL, NULL, '2021-07-21 03:01:20', '2021-07-21 03:01:20');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_budget_details`
-- (See below for the actual view)
--
CREATE TABLE `view_budget_details` (
`balance` double
,`budget_amount` double
,`budget_id` int
,`expense_amount` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_budget_for_expense`
-- (See below for the actual view)
--
CREATE TABLE `view_budget_for_expense` (
`budget` double
,`budget_type` varchar(200)
,`company_id` int
,`cost_center` varchar(255)
,`created_by` varchar(255)
,`department_id` int
,`division_id` int
,`employee_id` int
,`expense` double
,`id` bigint unsigned
,`location_id` int
,`project_code` varchar(255)
,`project_in_charge` varchar(255)
,`section_id` int
,`year` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_expense_details`
-- (See below for the actual view)
--
CREATE TABLE `view_expense_details` (
`balance` double
,`budget_amount` double
,`budget_for` varchar(255)
,`budget_id` int
,`budget_quantity` double
,`budget_rate` double
,`cat_name` varchar(200)
,`expense_amount` double
,`expense_quantity` double
,`id` bigint unsigned
,`remain_qty` double
,`sub_cat_name` varchar(200)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_type_wise_budgets`
-- (See below for the actual view)
--
CREATE TABLE `view_type_wise_budgets` (
`budget_amount` double
,`cat_name` varchar(200)
,`company_id` int
,`department_id` int
,`division_id` int
,`employee_id` int
,`expense_amount` double
,`location_id` int
,`section_id` int
,`TYPE` varchar(200)
,`year` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `type_category_status`
--
DROP TABLE IF EXISTS `type_category_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `type_category_status`  AS  select `financial_years`.`year` AS `year`,`budget_types`.`name` AS `TYPE`,`budget_categories`.`name` AS `cat_name`,sum(`budget_details`.`budget_amount`) AS `budget_amount`,sum(`expense_details`.`expense_amount`) AS `expense_amount`,`budgets`.`employee_id` AS `employee_id`,`budgets`.`company_id` AS `company_id`,`budgets`.`location_id` AS `location_id`,`budgets`.`division_id` AS `division_id`,`budgets`.`department_id` AS `department_id`,`budgets`.`section_id` AS `section_id` from (((((`budgets` join `budget_details` on((`budgets`.`id` = `budget_details`.`budget_id`))) join `financial_years` on((`budgets`.`financial_year` = `financial_years`.`id`))) left join (select `expensives`.`id` AS `id`,`expensives`.`budget_id` AS `budget_id`,`expensives`.`budget_type_id` AS `budget_type_id`,`expensive_details`.`budget_detail_id` AS `budget_detail_id`,`expensive_details`.`budget_category_id` AS `budget_category_id`,sum(`expensive_details`.`expensive_amount`) AS `expense_amount` from (`expensives` join `expensive_details` on((`expensives`.`id` = `expensive_details`.`expensive_id`))) where ((`expensives`.`submited` = 1) and (`expensives`.`is_approved` in (0,1))) group by `expensive_details`.`budget_category_id`) `expense_details` on((`expense_details`.`budget_detail_id` = `budget_details`.`id`))) join `budget_categories` on((`budget_categories`.`id` = `budget_details`.`budget_category_id`))) join `budget_types` on((`budgets`.`budget_type_id` = `budget_types`.`id`))) group by `budget_details`.`budget_category_id` ;

-- --------------------------------------------------------

--
-- Structure for view `type_category_subcategory_status`
--
DROP TABLE IF EXISTS `type_category_subcategory_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `type_category_subcategory_status`  AS  select `financial_years`.`year` AS `year`,`budget_types`.`name` AS `TYPE`,`budget_categories`.`name` AS `cat_name`,`budget_sub_categories`.`name` AS `sub_cat_name`,sum(`budget_details`.`budget_amount`) AS `budget_amount`,sum(`expense_details`.`expense_amount`) AS `expense_amount`,`budgets`.`employee_id` AS `employee_id`,`budgets`.`company_id` AS `company_id`,`budgets`.`location_id` AS `location_id`,`budgets`.`division_id` AS `division_id`,`budgets`.`department_id` AS `department_id`,`budgets`.`section_id` AS `section_id` from ((((((`budgets` join `budget_details` on((`budgets`.`id` = `budget_details`.`budget_id`))) join `financial_years` on((`budgets`.`financial_year` = `financial_years`.`id`))) left join (select `expensives`.`id` AS `id`,`expensive_details`.`budget_subcategory_id` AS `budget_subcategory_id`,`expensives`.`budget_id` AS `budget_id`,`expensives`.`budget_type_id` AS `budget_type_id`,`expensive_details`.`budget_detail_id` AS `budget_detail_id`,sum(`expensive_details`.`expensive_amount`) AS `expense_amount` from (`expensives` join `expensive_details` on((`expensives`.`id` = `expensive_details`.`expensive_id`))) where ((`expensives`.`submited` = 1) and (`expensives`.`is_approved` in (0,1))) group by `expensive_details`.`budget_subcategory_id`) `expense_details` on((`expense_details`.`budget_detail_id` = `budget_details`.`id`))) join `budget_categories` on((`budget_categories`.`id` = `budget_details`.`budget_category_id`))) join `budget_sub_categories` on((`budget_sub_categories`.`id` = `budget_details`.`budget_subcategory_id`))) join `budget_types` on((`budgets`.`budget_type_id` = `budget_types`.`id`))) group by `budget_details`.`budget_subcategory_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_budget_details`
--
DROP TABLE IF EXISTS `view_budget_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_budget_details`  AS  select `budget_details`.`budget_id` AS `budget_id`,sum(`budget_details`.`budget_amount`) AS `budget_amount`,sum(`expensive_details`.`expensive_amount`) AS `expense_amount`,(sum(`budget_details`.`budget_amount`) - sum(`expensive_details`.`expensive_amount`)) AS `balance` from (`budget_details` join `expensive_details` on((`budget_details`.`id` = `expensive_details`.`budget_detail_id`))) group by `budget_details`.`budget_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_budget_for_expense`
--
DROP TABLE IF EXISTS `view_budget_for_expense`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_budget_for_expense`  AS  select `financial_years`.`year` AS `year`,`budgets`.`id` AS `id`,`cost_centers`.`name` AS `cost_center`,`budget_types`.`name` AS `budget_type`,`project_codes`.`code` AS `project_code`,`users`.`name` AS `created_by`,`budgets`.`project_in_charge` AS `project_in_charge`,sum(`budget_details`.`budget_amount`) AS `budget`,sum(`expense_detail`.`expense`) AS `expense`,`budgets`.`company_id` AS `company_id`,`budgets`.`location_id` AS `location_id`,`budgets`.`division_id` AS `division_id`,`budgets`.`department_id` AS `department_id`,`budgets`.`section_id` AS `section_id`,`budgets`.`employee_id` AS `employee_id` from (((((((`budgets` join (select `budget_details`.`budget_id` AS `budget_id`,sum(`budget_details`.`budget_amount`) AS `budget_amount` from `budget_details` group by `budget_details`.`budget_id`) `budget_details` on((`budgets`.`id` = `budget_details`.`budget_id`))) left join (select `expensives`.`budget_id` AS `budget_id`,sum(`expensive_details`.`expensive_amount`) AS `expense` from (`expensives` join `expensive_details` on((`expensives`.`id` = `expensive_details`.`expensive_id`))) where ((`expensives`.`submited` = 1) and (`expensives`.`is_approved` in (0,1))) group by `expensive_details`.`budget_id`) `expense_detail` on((`budgets`.`id` = `expense_detail`.`budget_id`))) join `financial_years` on((`financial_years`.`id` = `budgets`.`financial_year`))) join `cost_centers` on((`cost_centers`.`id` = `budgets`.`cost_center_id`))) join `budget_types` on((`budget_types`.`id` = `budgets`.`budget_type_id`))) join `project_codes` on((`project_codes`.`id` = `budgets`.`project_code_id`))) join `users` on((`users`.`id` = `budgets`.`employee_id`))) group by `budgets`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_expense_details`
--
DROP TABLE IF EXISTS `view_expense_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_expense_details`  AS  select `budget_details`.`id` AS `id`,`budget_details`.`budget_for` AS `budget_for`,`budget_details`.`budget_id` AS `budget_id`,`budget_details`.`budget_rate` AS `budget_rate`,`budget_categories`.`name` AS `cat_name`,`budget_sub_categories`.`name` AS `sub_cat_name`,sum(`budget_details`.`budget_quantity`) AS `budget_quantity`,sum(`expense_detail`.`expense_quantity`) AS `expense_quantity`,(sum(`budget_details`.`budget_quantity`) - sum(`expense_detail`.`expense_quantity`)) AS `remain_qty`,sum(`budget_details`.`budget_amount`) AS `budget_amount`,sum(`expense_detail`.`expense_amount`) AS `expense_amount`,(sum(`budget_details`.`budget_amount`) - sum(`expense_detail`.`expense_amount`)) AS `balance` from (((`budget_details` left join (select `expensives`.`submited` AS `submited`,`expensive_details`.`budget_id` AS `budget_id`,`expensive_details`.`budget_detail_id` AS `budget_detail_id`,sum(`expensive_details`.`expensive_quantity`) AS `expense_quantity`,sum(`expensive_details`.`expensive_amount`) AS `expense_amount` from (`expensives` join `expensive_details` on((`expensives`.`id` = `expensive_details`.`expensive_id`))) where ((`expensives`.`submited` = 1) and (`expensives`.`is_approved` in (0,1))) group by `expensive_details`.`budget_detail_id`) `expense_detail` on((`budget_details`.`id` = `expense_detail`.`budget_detail_id`))) join `budget_categories` on((`budget_categories`.`id` = `budget_details`.`budget_category_id`))) join `budget_sub_categories` on((`budget_sub_categories`.`id` = `budget_details`.`budget_subcategory_id`))) group by `budget_details`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_type_wise_budgets`
--
DROP TABLE IF EXISTS `view_type_wise_budgets`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_type_wise_budgets`  AS  select `financial_years`.`year` AS `year`,`budget_types`.`name` AS `TYPE`,`budget_categories`.`name` AS `cat_name`,sum(`budget_details`.`budget_amount`) AS `budget_amount`,sum(`expense_details`.`expense_amount`) AS `expense_amount`,`budgets`.`employee_id` AS `employee_id`,`budgets`.`company_id` AS `company_id`,`budgets`.`location_id` AS `location_id`,`budgets`.`division_id` AS `division_id`,`budgets`.`department_id` AS `department_id`,`budgets`.`section_id` AS `section_id` from (((((`budgets` join `budget_details` on((`budgets`.`id` = `budget_details`.`budget_id`))) join `financial_years` on((`budgets`.`financial_year` = `financial_years`.`id`))) left join (select `expensives`.`id` AS `id`,`expensives`.`budget_type_id` AS `budget_type_id`,`expensive_details`.`budget_detail_id` AS `budget_detail_id`,sum(`expensive_details`.`expensive_amount`) AS `expense_amount` from (`expensives` join `expensive_details` on((`expensives`.`id` = `expensive_details`.`expensive_id`))) where ((`expensives`.`submited` = 1) and (`expensives`.`is_approved` in (0,1))) group by `expensives`.`budget_type_id`) `expense_details` on((`expense_details`.`budget_detail_id` = `budget_details`.`id`))) join `budget_categories` on((`budget_categories`.`id` = `budget_details`.`budget_category_id`))) join `budget_types` on((`budgets`.`budget_type_id` = `budget_types`.`id`))) group by `budgets`.`budget_type_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approval_lists`
--
ALTER TABLE `approval_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget_categories`
--
ALTER TABLE `budget_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget_details`
--
ALTER TABLE `budget_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget_sub_categories`
--
ALTER TABLE `budget_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget_types`
--
ALTER TABLE `budget_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cost_centers`
--
ALTER TABLE `cost_centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expensives`
--
ALTER TABLE `expensives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expensive_details`
--
ALTER TABLE `expensive_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `financial_years`
--
ALTER TABLE `financial_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `project_codes`
--
ALTER TABLE `project_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rountings`
--
ALTER TABLE `rountings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rounting_status`
--
ALTER TABLE `rounting_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `approval_lists`
--
ALTER TABLE `approval_lists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `budget_categories`
--
ALTER TABLE `budget_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `budget_details`
--
ALTER TABLE `budget_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `budget_sub_categories`
--
ALTER TABLE `budget_sub_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `budget_types`
--
ALTER TABLE `budget_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cost_centers`
--
ALTER TABLE `cost_centers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expensives`
--
ALTER TABLE `expensives`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expensive_details`
--
ALTER TABLE `expensive_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `financial_years`
--
ALTER TABLE `financial_years`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `project_codes`
--
ALTER TABLE `project_codes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rountings`
--
ALTER TABLE `rountings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rounting_status`
--
ALTER TABLE `rounting_status`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
