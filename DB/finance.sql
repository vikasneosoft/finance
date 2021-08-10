-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 22, 2021 at 06:24 PM
-- Server version: 8.0.25-0ubuntu0.20.04.1
-- PHP Version: 7.4.20

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
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `level_one_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_one_max` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_two_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_two_max` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_three_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_three_max` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_four_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_four_max` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_five_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_five_max` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `financial_year` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget_proj_ref_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_contacts` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget_from_date` datetime NOT NULL,
  `budget_to_date` datetime NOT NULL,
  `budget_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget_type_id` int NOT NULL,
  `cost_center_id` int NOT NULL,
  `project_code_id` int NOT NULL,
  `project_in_charge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`id`, `employee_id`, `company_id`, `location_id`, `division_id`, `department_id`, `section_id`, `financial_year`, `budget_proj_ref_no`, `vendor`, `vendor_contacts`, `budget_from_date`, `budget_to_date`, `budget_code`, `budget_type_id`, `cost_center_id`, `project_code_id`, `project_in_charge`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 1, 4, 1, 3, '2', 'Budget APP Deveopment', 'Ashtech', '9820131511', '2021-07-20 10:25:24', '2021-07-20 10:25:24', 'OPEX-VIK-2021-22-001', 3, 1, 2, 'Vikas', '2021-07-20 04:55:24', '2021-07-20 04:55:24');

-- --------------------------------------------------------

--
-- Table structure for table `budget_categories`
--

CREATE TABLE `budget_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `budget_for` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget_quantity` double NOT NULL,
  `budget_rate` double NOT NULL,
  `budget_amount` double NOT NULL,
  `budget_explanation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `specifications` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budget_details`
--

INSERT INTO `budget_details` (`id`, `budget_id`, `employee_id`, `company_id`, `location_id`, `division_id`, `department_id`, `section_id`, `budget_category_id`, `budget_subcategory_id`, `budget_for`, `budget_quantity`, `budget_rate`, `budget_amount`, `budget_explanation`, `specifications`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 1, 1, 4, 1, 0, 2, 4, 'Laptops', 10, 1000, 10000, 'This is a dummy entry', 'Standard', NULL, '2021-07-20 04:56:28', '2021-07-22 01:36:07'),
(2, 1, 5, 1, 1, 4, 1, 0, 2, 10, 'Printers', 5, 1000, 5000, 'Dummy Entry', 'Standard', NULL, '2021-07-21 02:40:49', '2021-07-22 01:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `budget_sub_categories`
--

CREATE TABLE `budget_sub_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(10, 'Hardware AMC', 2, '2021-07-07 06:37:19', '2021-07-07 06:37:19');

-- --------------------------------------------------------

--
-- Table structure for table `budget_types`
--

CREATE TABLE `budget_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manager_email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `manager_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `manager_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `proj_ref_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `what_is_required` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why_required` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scope_of_work` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `what_will_change` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_contacts` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason_for_selecting_vendor` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `assumptions_or_inclusions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `exceptions_or_exclusions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_terms` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `warranty_guarantee_details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `expensive_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget_type_id` int NOT NULL,
  `cost_center_id` int NOT NULL,
  `project_code_id` int NOT NULL,
  `project_in_charge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_id` int DEFAULT NULL,
  `submited` tinyint(1) NOT NULL COMMENT '0=>not,1=>yes',
  `is_approved` int NOT NULL COMMENT '0=>not,1=>yes',
  `is_cloned` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expensives`
--

INSERT INTO `expensives` (`id`, `employee_id`, `company_id`, `division_id`, `department_id`, `section_id`, `budget_id`, `financial_year`, `proj_ref_no`, `what_is_required`, `why_required`, `scope_of_work`, `what_will_change`, `vendor`, `vendor_contacts`, `reason_for_selecting_vendor`, `assumptions_or_inclusions`, `exceptions_or_exclusions`, `payment_terms`, `warranty_guarantee_details`, `from_date`, `to_date`, `expensive_code`, `budget_type_id`, `cost_center_id`, `project_code_id`, `project_in_charge`, `location_id`, `submited`, `is_approved`, `is_cloned`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 4, 1, 3, 1, 2, 'Budget APP Deveopment', NULL, NULL, NULL, NULL, 'Ashtech', '9820131511', 'Known and cheaper than others. separate comparison sheet is attached', 'No assumptions', 'nothing', 'Monthly', 'yes', '2021-07-20 08:47:13', '2021-07-20 08:47:13', 'OPEX-VIK-2021-22-001', 3, 1, 2, 'Vikas', NULL, 1, 0, 0, '2021-07-22 03:17:13', '2021-07-22 03:17:53');

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
  `expensive_for` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expensive_quantity` double NOT NULL,
  `expensive_rate` double NOT NULL,
  `expensive_amount` double NOT NULL,
  `expensive_explanation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `specifications` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expensive_details`
--

INSERT INTO `expensive_details` (`id`, `expensive_id`, `budget_id`, `budget_detail_id`, `budget_category_id`, `budget_subcategory_id`, `expensive_for`, `expensive_quantity`, `expensive_rate`, `expensive_amount`, `expensive_explanation`, `specifications`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, 4, 'Laptops', 1, 1000, 1000, 'This is a dummy entry', 'Standard', NULL, '2021-07-22 03:17:19', '2021-07-22 03:17:19'),
(2, 1, 1, 2, 2, 10, 'Printers', 1, 1000, 1000, 'Dummy Entry', 'Standard', NULL, '2021-07-22 03:17:27', '2021-07-22 03:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `financial_years`
--

CREATE TABLE `financial_years` (
  `id` bigint UNSIGNED NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manager_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(72, '2021_07_22_033956_calculate_view', 37),
(73, '2021_07_22_071709_view_budget_detail', 38);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 3, 5, 1, 1000, '2021-07-08 03:28:04', '2021-07-08 03:28:04'),
(2, 3, 6, 2, 2000, '2021-07-08 03:28:23', '2021-07-08 03:28:23'),
(3, 7, 4, 1, 1000, '2021-07-08 03:28:47', '2021-07-08 03:28:47'),
(4, 7, 6, 2, 2000, '2021-07-08 03:29:11', '2021-07-08 03:29:11'),
(5, 3, 8, 3, 3000, '2021-07-20 03:51:49', '2021-07-20 03:51:49'),
(6, 11, 5, 1, 2000000, '2021-07-20 07:19:20', '2021-07-20 07:20:00');

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
  `reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rounting_status`
--

INSERT INTO `rounting_status` (`id`, `expense_id`, `originator_id`, `expense_amount`, `subimtted_by`, `approver_id`, `level`, `maximum_amount`, `approval_status`, `rejected_by`, `reason`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 2000, 3, 5, 1, 1000, 0, NULL, NULL, '2021-07-22 03:17:53', '2021-07-22 03:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manager_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int NOT NULL,
  `division_id` int NOT NULL,
  `location_id` int NOT NULL,
  `department_id` int NOT NULL,
  `section_id` int NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_validate_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `company_id`, `division_id`, `location_id`, `department_id`, `section_id`, `remember_token`, `password_validate_time`, `created_at`, `updated_at`) VALUES
(1, 'Amod', 'amod@yopmail.com', NULL, '$2y$10$4hjUBQ.fvGcBoQEz3F2.pOi4BfkPokQHPF18izUXXYar25Vtqad8C', 1, 4, 1, 1, 1, 'T3jGVIx6w7eeK67kUX1kZu0Kj5GmyDRiAgqSdrPDmroaeZ6ey06TDAM1YKA7', '2021-06-25 12:28:57', NULL, '2021-07-19 07:15:33'),
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
`budget_id` int
,`budget_amount` double
,`expense_amount` double
,`balance` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_expense_details`
-- (See below for the actual view)
--
CREATE TABLE `view_expense_details` (
`id` bigint unsigned
,`budget_id` int
,`budget_quantity` double
,`expense_quantity` double
,`remain_qty` double
,`budget_amount` double
,`expense_amount` double
,`balance` double
);

-- --------------------------------------------------------

--
-- Structure for view `view_budget_details`
--
DROP TABLE IF EXISTS `view_budget_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_budget_details`  AS  select `budget_details`.`budget_id` AS `budget_id`,sum(`budget_details`.`budget_amount`) AS `budget_amount`,sum(`expensive_details`.`expensive_amount`) AS `expense_amount`,(sum(`budget_details`.`budget_amount`) - sum(`expensive_details`.`expensive_amount`)) AS `balance` from (`budget_details` join `expensive_details` on((`budget_details`.`id` = `expensive_details`.`budget_detail_id`))) group by `budget_details`.`budget_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_expense_details`
--
DROP TABLE IF EXISTS `view_expense_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_expense_details`  AS  select `budget_details`.`id` AS `id`,`budget_details`.`budget_id` AS `budget_id`,sum(`budget_details`.`budget_quantity`) AS `budget_quantity`,sum(`expensive_details`.`expensive_quantity`) AS `expense_quantity`,(sum(`budget_details`.`budget_quantity`) - sum(`expensive_details`.`expensive_quantity`)) AS `remain_qty`,sum(`budget_details`.`budget_amount`) AS `budget_amount`,sum(`expensive_details`.`expensive_amount`) AS `expense_amount`,(sum(`budget_details`.`budget_amount`) - sum(`expensive_details`.`expensive_amount`)) AS `balance` from (`budget_details` join `expensive_details` on((`budget_details`.`id` = `expensive_details`.`budget_detail_id`))) group by `budget_details`.`budget_id`,`budget_details`.`id` ;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `budget_categories`
--
ALTER TABLE `budget_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `budget_details`
--
ALTER TABLE `budget_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `budget_sub_categories`
--
ALTER TABLE `budget_sub_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expensive_details`
--
ALTER TABLE `expensive_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_years`
--
ALTER TABLE `financial_years`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `project_codes`
--
ALTER TABLE `project_codes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rountings`
--
ALTER TABLE `rountings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rounting_status`
--
ALTER TABLE `rounting_status`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
