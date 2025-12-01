-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2025 at 04:01 AM
-- Server version: 11.4.8-MariaDB-cll-lve-log
-- PHP Version: 8.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usavxtbm_shopmanager_cloud2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `timestamp` varchar(20) DEFAULT NULL,
  `added_by` varchar(7) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `---` varchar(4) NOT NULL DEFAULT '---',
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `location` varchar(30) DEFAULT NULL,
  `dob` varchar(20) DEFAULT NULL,
  `privs` varchar(255) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL,
  `balance` varchar(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `timestamp`, `added_by`, `status`, `last_updated`, `---`, `fname`, `lname`, `email`, `phone`, `location`, `dob`, `privs`, `username`, `password`, `notes`, `balance`) VALUES
(1, '1574494579', 'web', 'Published', '1574494579', '---', 'Muzammal', 'Arif', 'hello@muzammalarif.com', '03434123489', 'global', '21-jun-1993', '*', 'gfsoul', 'Start@21-jan-2019', NULL, '-86');

-- --------------------------------------------------------

--
-- Table structure for table `basic_fields`
--

CREATE TABLE `basic_fields` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chartofaccount`
--

CREATE TABLE `chartofaccount` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(500) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `account_head` varchar(99) DEFAULT NULL,
  `account_type` varchar(99) DEFAULT NULL,
  `balance` varchar(20) DEFAULT NULL,
  `balance_type` varchar(20) DEFAULT NULL,
  `old_balance` varchar(99) DEFAULT NULL,
  `old_balance_type` varchar(20) DEFAULT NULL,
  `last_update_date` varchar(20) DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `chartofaccount`
--

INSERT INTO `chartofaccount` (`id`, `owner_mobile`, `timestamp`, `added_by`, `status`, `last_updated`, `sync`, `---`, `account_head`, `account_type`, `balance`, `balance_type`, `old_balance`, `old_balance_type`, `last_update_date`, `notes`) VALUES
(1, '+256-759912814', 1760527011, 'System', 'Published', '1760527011', NULL, '---', 'Cash', 'Cash', '0', 'cr', '0', 'cr', '1760527011', ''),
(2, '+256-759912814', 1760527011, 'System', 'Published', '1763985678', NULL, '---', 'Expense', 'Expense', '43200', 'debit', '0', 'cr', '1763985678', ''),
(3, '+256-759912814', 1760527011, 'System', 'Published', '1760527011', NULL, '---', 'Accounts Receivable and Payable', 'Assets', '0', 'cr', '0', 'cr', '1760527011', ''),
(4, '+256-759912814', 1760527011, 'System', 'Published', '1760527011', NULL, '---', 'Sales', 'Income', '0', 'cr', '0', 'cr', '1760527011', ''),
(5, '+256-759912814', 1760527011, 'System', 'Published', '1760527011', NULL, '---', 'All Taxes', 'Liabilities', '0', 'cr', '0', 'cr', '1760527011', ''),
(6, '+256-759912814', 1760527011, 'System', 'Published', '1760527011', NULL, '---', 'Purchases', 'Cost of Sale', '0', 'cr', '0', 'cr', '1760527011', ''),
(7, '+256-759912814', 1760527011, 'System', 'Published', '1760527011', NULL, '---', 'Purchase Discount', 'Income', '0', 'cr', '0', 'cr', '1760527011', ''),
(8, '+256-759912814', 1760527011, 'System', 'Published', '1760527011', NULL, '---', 'Sale Discount', 'Expense', '0', 'cr', '0', 'cr', '1760527011', ''),
(9, '+256-759912814', 1760527011, 'System', 'Published', '1760527011', NULL, '---', 'Profit and Lose', 'Income', '0', 'cr', '0', 'cr', '1760527011', ''),
(10, '+256-759912814', 1760527011, 'System', 'Published', '1763985628', NULL, '---', 'Capital', 'Equity', '20919110', 'credit', '0', 'cr', '1763985628', ''),
(11, '+256-759912814', 1760527011, 'System', 'Published', '1763985678', NULL, '---', 'Inventory', 'Assets', '20875910', 'debit', '0', 'cr', '1763985678', ''),
(12, '+92-3006677492', 1760723838, 'System', 'Published', '1760723838', NULL, '---', 'Cash', 'Cash', '0', 'cr', '0', 'cr', '1760723838', ''),
(13, '+92-3006677492', 1760723838, 'System', 'Published', '1760723838', NULL, '---', 'Expense', 'Expense', '0', 'cr', '0', 'cr', '1760723838', ''),
(14, '+92-3006677492', 1760723838, 'System', 'Published', '1760723838', NULL, '---', 'Accounts Receivable and Payable', 'Assets', '0', 'cr', '0', 'cr', '1760723838', ''),
(15, '+92-3006677492', 1760723838, 'System', 'Published', '1760723838', NULL, '---', 'Sales', 'Income', '0', 'cr', '0', 'cr', '1760723838', ''),
(16, '+92-3006677492', 1760723838, 'System', 'Published', '1760723838', NULL, '---', 'All Taxes', 'Liabilities', '0', 'cr', '0', 'cr', '1760723838', ''),
(17, '+92-3006677492', 1760723838, 'System', 'Published', '1760723838', NULL, '---', 'Purchases', 'Cost of Sale', '0', 'cr', '0', 'cr', '1760723838', ''),
(18, '+92-3006677492', 1760723838, 'System', 'Published', '1760723838', NULL, '---', 'Purchase Discount', 'Income', '0', 'cr', '0', 'cr', '1760723838', ''),
(19, '+92-3006677492', 1760723838, 'System', 'Published', '1760723838', NULL, '---', 'Sale Discount', 'Expense', '0', 'cr', '0', 'cr', '1760723838', ''),
(20, '+92-3006677492', 1760723838, 'System', 'Published', '1760723838', NULL, '---', 'Profit and Lose', 'Income', '0', 'cr', '0', 'cr', '1760723838', ''),
(21, '+92-3006677492', 1760723838, 'System', 'Published', '1760723838', NULL, '---', 'Capital', 'Equity', '0', 'cr', '0', 'cr', '1760723838', ''),
(22, '+92-3006677492', 1760723838, 'System', 'Published', '1760723838', NULL, '---', 'Inventory', 'Assets', '0', 'cr', '0', 'cr', '1760723838', ''),
(23, '+92-3002564543', 1760742383, 'System', 'Published', '1760742383', NULL, '---', 'Cash', 'Cash', '0', 'cr', '0', 'cr', '1760742383', ''),
(24, '+92-3002564543', 1760742383, 'System', 'Published', '1760742383', NULL, '---', 'Expense', 'Expense', '0', 'cr', '0', 'cr', '1760742383', ''),
(25, '+92-3002564543', 1760742383, 'System', 'Published', '1760742383', NULL, '---', 'Accounts Receivable and Payable', 'Assets', '0', 'cr', '0', 'cr', '1760742383', ''),
(26, '+92-3002564543', 1760742383, 'System', 'Published', '1760742383', NULL, '---', 'Sales', 'Income', '0', 'cr', '0', 'cr', '1760742383', ''),
(27, '+92-3002564543', 1760742383, 'System', 'Published', '1760742383', NULL, '---', 'All Taxes', 'Liabilities', '0', 'cr', '0', 'cr', '1760742383', ''),
(28, '+92-3002564543', 1760742383, 'System', 'Published', '1760742383', NULL, '---', 'Purchases', 'Cost of Sale', '0', 'cr', '0', 'cr', '1760742383', ''),
(29, '+92-3002564543', 1760742383, 'System', 'Published', '1760742383', NULL, '---', 'Purchase Discount', 'Income', '0', 'cr', '0', 'cr', '1760742383', ''),
(30, '+92-3002564543', 1760742383, 'System', 'Published', '1760742383', NULL, '---', 'Sale Discount', 'Expense', '0', 'cr', '0', 'cr', '1760742383', ''),
(31, '+92-3002564543', 1760742383, 'System', 'Published', '1760742383', NULL, '---', 'Profit and Lose', 'Income', '0', 'cr', '0', 'cr', '1760742383', ''),
(32, '+92-3002564543', 1760742383, 'System', 'Published', '1760742383', NULL, '---', 'Capital', 'Equity', '0', 'cr', '0', 'cr', '1760742383', ''),
(33, '+92-3002564543', 1760742383, 'System', 'Published', '1760742383', NULL, '---', 'Inventory', 'Assets', '0', 'cr', '0', 'cr', '1760742383', ''),
(34, '+92-3335672555', 1761397110, 'System', 'Published', '1764131718', NULL, '---', 'Cash', 'Cash', '350', 'credit', '0', 'cr', '1764131718', ''),
(35, '+92-3335672555', 1761397110, 'System', 'Published', '1764131718', NULL, '---', 'Expense', 'Expense', '150', 'debit', '0', 'cr', '1764131718', ''),
(36, '+92-3335672555', 1761397110, 'System', 'Published', '1761397110', NULL, '---', 'Accounts Receivable and Payable', 'Assets', '0', 'cr', '0', 'cr', '1761397110', ''),
(37, '+92-3335672555', 1761397110, 'System', 'Published', '1761397110', NULL, '---', 'Sales', 'Income', '0', 'cr', '0', 'cr', '1761397110', ''),
(38, '+92-3335672555', 1761397110, 'System', 'Published', '1761397110', NULL, '---', 'All Taxes', 'Liabilities', '0', 'cr', '0', 'cr', '1761397110', ''),
(39, '+92-3335672555', 1761397110, 'System', 'Published', '1761397110', NULL, '---', 'Purchases', 'Cost of Sale', '0', 'cr', '0', 'cr', '1761397110', ''),
(40, '+92-3335672555', 1761397110, 'System', 'Published', '1761397110', NULL, '---', 'Purchase Discount', 'Income', '0', 'cr', '0', 'cr', '1761397110', ''),
(41, '+92-3335672555', 1761397110, 'System', 'Published', '1761397110', NULL, '---', 'Sale Discount', 'Expense', '0', 'cr', '0', 'cr', '1761397110', ''),
(42, '+92-3335672555', 1761397110, 'System', 'Published', '1761397110', NULL, '---', 'Profit and Lose', 'Income', '0', 'cr', '0', 'cr', '1761397110', ''),
(43, '+92-3335672555', 1761397110, 'System', 'Published', '1764131548', NULL, '---', 'Capital', 'Equity', '1000', 'credit', '0', 'cr', '1764131548', ''),
(44, '+92-3335672555', 1761397110, 'System', 'Published', '1764131548', NULL, '---', 'Inventory', 'Assets', '1300', 'debit', '0', 'cr', '1764131548', ''),
(45, '+94-773567467', 1763639536, 'System', 'Published', '1763639536', NULL, '---', 'Cash', 'Cash', '0', 'cr', '0', 'cr', '1763639536', ''),
(46, '+94-773567467', 1763639536, 'System', 'Published', '1763639536', NULL, '---', 'Expense', 'Expense', '0', 'cr', '0', 'cr', '1763639536', ''),
(47, '+94-773567467', 1763639536, 'System', 'Published', '1763639536', NULL, '---', 'Accounts Receivable and Payable', 'Assets', '0', 'cr', '0', 'cr', '1763639536', ''),
(48, '+94-773567467', 1763639536, 'System', 'Published', '1763639536', NULL, '---', 'Sales', 'Income', '0', 'cr', '0', 'cr', '1763639536', ''),
(49, '+94-773567467', 1763639536, 'System', 'Published', '1763639536', NULL, '---', 'All Taxes', 'Liabilities', '0', 'cr', '0', 'cr', '1763639536', ''),
(50, '+94-773567467', 1763639536, 'System', 'Published', '1763639536', NULL, '---', 'Purchases', 'Cost of Sale', '0', 'cr', '0', 'cr', '1763639536', ''),
(51, '+94-773567467', 1763639536, 'System', 'Published', '1763639536', NULL, '---', 'Purchase Discount', 'Income', '0', 'cr', '0', 'cr', '1763639536', ''),
(52, '+94-773567467', 1763639536, 'System', 'Published', '1763639536', NULL, '---', 'Sale Discount', 'Expense', '0', 'cr', '0', 'cr', '1763639536', ''),
(53, '+94-773567467', 1763639536, 'System', 'Published', '1763639536', NULL, '---', 'Profit and Lose', 'Income', '0', 'cr', '0', 'cr', '1763639536', ''),
(54, '+94-773567467', 1763639536, 'System', 'Published', '1763639536', NULL, '---', 'Capital', 'Equity', '0', 'cr', '0', 'cr', '1763639536', ''),
(55, '+94-773567467', 1763639536, 'System', 'Published', '1763639536', NULL, '---', 'Inventory', 'Assets', '0', 'cr', '0', 'cr', '1763639536', '');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) NOT NULL,
  `timestamp` int(20) NOT NULL,
  `added_by` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `last_updated` varchar(20) NOT NULL,
  `sync` varchar(5) NOT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `seen_status` varchar(11) DEFAULT NULL,
  `to_contact` varchar(30) DEFAULT NULL,
  `chat_msg` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companyadmin`
--

CREATE TABLE `companyadmin` (
  `id` int(11) NOT NULL,
  `timestamp` varchar(20) DEFAULT NULL,
  `added_by` varchar(7) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `---` varchar(4) NOT NULL DEFAULT '---',
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `location` varchar(30) DEFAULT NULL,
  `dob` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(500) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `name` varchar(99) DEFAULT NULL,
  `country_code` varchar(11) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `number` varchar(30) DEFAULT NULL,
  `type` varchar(11) DEFAULT NULL,
  `balance_status` varchar(11) DEFAULT NULL,
  `balance` varchar(99) DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `city` text DEFAULT NULL,
  `duedate` varchar(20) DEFAULT NULL,
  `tags` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `owner_mobile`, `timestamp`, `added_by`, `status`, `last_updated`, `sync`, `---`, `name`, `country_code`, `mobile`, `number`, `type`, `balance_status`, `balance`, `notes`, `email`, `city`, `duedate`, `tags`) VALUES
(1, '+256-759912814', 1760527011, 'System', 'Published', '1760527011', NULL, '---', 'Walk-in Customer / Supplier', '+', '0000', '+0000', 'customer', 'payable', '0', NULL, NULL, NULL, NULL, NULL),
(2, '+256-759912814', 1760533492, '+256-759912814', 'published', '1760533492', NULL, '---', 'MM Spares', '+256', '755499923', '+256-755499923', 'Supplier', 'payable', '0', '', '', 'Kampala', '', ',,'),
(3, '+256-759912814', 1760533689, '+256-759912814', 'published', '1760533689', NULL, '---', 'Golden Choice', '+256', '701348163', '+256-701348163', 'supplier', 'payable', '0', '', '', 'Kampala', '', ''),
(4, '+256-759912814', 1760533779, '+256-759912814', 'published', '1760533779', NULL, '---', 'J&L Spares', '+256', '754723336', '+256-754723336', 'supplier', 'payable', '0', '', '', 'Kampala', '', ''),
(5, '+256-759912814', 1760533884, '+256-759912814', 'published', '1760533884', NULL, '---', 'Kevla Spares', '+256', '743400016', '+256-743400016', 'supplier', 'payable', '0', '', '', 'Kampala', '', ''),
(6, '+256-759912814', 1760533979, '+256-759912814', 'published', '1760533979', NULL, '---', 'Yog Spares', '+246', '700114876', '+246-700114876', 'supplier', 'payable', '0', '', '', 'Kampala', '', ''),
(7, '+256-759912814', 1760534101, '+256-759912814', 'published', '1760534101', NULL, '---', '4s Spares', '+256', '709975547', '+256-709975547', 'supplier', 'payable', '0', '', '', 'Kampala', '', ''),
(8, '+256-759912814', 1760534209, '+256-759912814', 'published', '1760534209', NULL, '---', 'Beyond Spares', '+256', '703700086', '+256-703700086', 'supplier', 'payable', '0', '', '', 'Kampala', '', ''),
(9, '+256-759912814', 1760534309, '+256-759912814', 'published', '1760534309', NULL, '---', 'RT Spares', '+256', '708327592', '+256-708327592', 'supplier', 'payable', '0', '', '', 'Kampala', '', ''),
(10, '+256-759912814', 1760534396, '+256-759912814', 'published', '1760534396', NULL, '---', 'NYC Spares ', '+256', '778811715', '+256-778811715', 'supplier', 'payable', '0', '', '', 'Kampala', '', ''),
(11, '+256-759912814', 1760534542, '+256-759912814', 'published', '1760534542', NULL, '---', 'Jinli Spares', '+256', '772876555', '+256-772876555', 'supplier', 'payable', '0', '', '', 'Kampala', '', ''),
(12, '+92-3006677492', 1760723838, 'System', 'Published', '1760723838', NULL, '---', 'Walk-in Customer / Supplier', '+', '0000', '+0000', 'customer', 'payable', '0', NULL, NULL, NULL, NULL, NULL),
(13, '+92-3002564543', 1760742383, 'System', 'Published', '1760742383', NULL, '---', 'Walk-in Customer / Supplier', '+', '0000', '+0000', 'customer', 'payable', '0', NULL, NULL, NULL, NULL, NULL),
(14, '+92-3335672555', 1761397110, 'System', 'Published', '1761397110', NULL, '---', 'Walk-in Customer / Supplier', '+', '0000', '+0000', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '+92-3335672555', 1761650333, '+92-3335672555', 'published', '1761650422', '', '---', 'sharoz', '+73', '1', '+73-1', 'supplier', 'credit', '0', '', '', '', '', ''),
(16, '+92-3335672555', 1761650369, '+92-3335672555', 'published', '1761650369', '', '---', '11', '+13', '0', '+13-0', 'supplier', 'credit', '100', '', '', '', '', ''),
(17, '+94-773567467', 1763639536, 'System', 'Published', '1763639536', NULL, '---', 'Walk-in Customer / Supplier', '+', '0000', '+0000', 'customer', 'payable', '0', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deviceList`
--

CREATE TABLE `deviceList` (
  `id` int(11) NOT NULL,
  `platformOS` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `token` text DEFAULT NULL,
  `timestamp` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dummy`
--

CREATE TABLE `dummy` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `msg` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(500) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `posid` varchar(11) DEFAULT NULL,
  `amount` varchar(30) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `payment_method` varchar(30) DEFAULT NULL,
  `expense_type` varchar(30) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `attachments` varchar(99) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_type`
--

CREATE TABLE `expense_type` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(500) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `name` varchar(99) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forget_pass`
--

CREATE TABLE `forget_pass` (
  `number` varchar(20) DEFAULT NULL,
  `token` varchar(30) DEFAULT NULL,
  `timestamp` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'Published'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `ref_id` varchar(90) DEFAULT NULL,
  `type` varchar(19) DEFAULT NULL,
  `file_type` varchar(11) NOT NULL DEFAULT 'image',
  `file_path` varchar(200) DEFAULT NULL,
  `file_name` varchar(99) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `graph`
--

CREATE TABLE `graph` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `date` varchar(30) DEFAULT NULL,
  `total_sale` varchar(30) DEFAULT NULL,
  `cost_of_sale` varchar(30) DEFAULT NULL,
  `total_purchase` varchar(30) DEFAULT NULL,
  `expense` varchar(30) DEFAULT NULL,
  `profit` varchar(30) DEFAULT NULL,
  `sale_discount` varchar(20) DEFAULT NULL,
  `purchase_discount` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `title` varchar(255) DEFAULT NULL,
  `text` mediumtext DEFAULT NULL,
  `date_time` varchar(99) DEFAULT NULL,
  `link` mediumtext DEFAULT NULL,
  `read_status` varchar(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id`, `owner_mobile`, `timestamp`, `added_by`, `status`, `last_updated`, `sync`, `---`, `title`, `text`, `date_time`, `link`, `read_status`) VALUES
(1, '+92-3335672555', 1764131718, '+92-3335672555', 'Published', '1764131718', NULL, '---', 'Low Stock Alert', 'fabric 76/68 product is running low on stock', '1764131718', 'r-stock-view.php?id=398', '0');

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `description` mediumtext DEFAULT NULL,
  `date_time` varchar(30) DEFAULT NULL,
  `credit_json` mediumtext DEFAULT NULL,
  `debit_json` mediumtext DEFAULT NULL,
  `entry_type` varchar(230) DEFAULT NULL,
  `entry_link` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `journal`
--

INSERT INTO `journal` (`id`, `owner_mobile`, `timestamp`, `added_by`, `status`, `last_updated`, `sync`, `---`, `description`, `date_time`, `credit_json`, `debit_json`, `entry_type`, `entry_link`) VALUES
(1, '+256-759912814', 1760533492, '+256-759912814', 'Published', '1760533492', NULL, '---', 'Create new Contact with beginning balance.', '2025-10-15 13:04:52', '[{\"account\":\"c+256-755499923\",\"amount\":0}]', '[{\"account\":\"10\",\"amount\":0}]', 'Create new Contact with beginning balance.', 'contactid:+256-755499923'),
(2, '+256-759912814', 1760533689, '+256-759912814', 'Published', '1760533689', NULL, '---', 'Create new Contact with beginning balance.', '2025-10-15 13:08:09', '[{\"account\":\"c+256-701348163\",\"amount\":0}]', '[{\"account\":\"10\",\"amount\":0}]', 'Create new Contact with beginning balance.', 'contactid:+256-701348163'),
(3, '+256-759912814', 1760533779, '+256-759912814', 'Published', '1760533779', NULL, '---', 'Create new Contact with beginning balance.', '2025-10-15 13:09:39', '[{\"account\":\"c+256-754723336\",\"amount\":0}]', '[{\"account\":\"10\",\"amount\":0}]', 'Create new Contact with beginning balance.', 'contactid:+256-754723336'),
(4, '+256-759912814', 1760533884, '+256-759912814', 'Published', '1760533884', NULL, '---', 'Create new Contact with beginning balance.', '2025-10-15 13:11:24', '[{\"account\":\"c+256-743400016\",\"amount\":0}]', '[{\"account\":\"10\",\"amount\":0}]', 'Create new Contact with beginning balance.', 'contactid:+256-743400016'),
(5, '+256-759912814', 1760533979, '+256-759912814', 'Published', '1760533979', NULL, '---', 'Create new Contact with beginning balance.', '2025-10-15 13:12:59', '[{\"account\":\"c+246-700114876\",\"amount\":0}]', '[{\"account\":\"10\",\"amount\":0}]', 'Create new Contact with beginning balance.', 'contactid:+246-700114876'),
(6, '+256-759912814', 1760534101, '+256-759912814', 'Published', '1760534101', NULL, '---', 'Create new Contact with beginning balance.', '2025-10-15 13:15:01', '[{\"account\":\"c+256-709975547\",\"amount\":0}]', '[{\"account\":\"10\",\"amount\":0}]', 'Create new Contact with beginning balance.', 'contactid:+256-709975547'),
(7, '+256-759912814', 1760534209, '+256-759912814', 'Published', '1760534209', NULL, '---', 'Create new Contact with beginning balance.', '2025-10-15 13:16:49', '[{\"account\":\"c+256-703700086\",\"amount\":0}]', '[{\"account\":\"10\",\"amount\":0}]', 'Create new Contact with beginning balance.', 'contactid:+256-703700086'),
(8, '+256-759912814', 1760534309, '+256-759912814', 'Published', '1760534309', NULL, '---', 'Create new Contact with beginning balance.', '2025-10-15 13:18:29', '[{\"account\":\"c+256-708327592\",\"amount\":0}]', '[{\"account\":\"10\",\"amount\":0}]', 'Create new Contact with beginning balance.', 'contactid:+256-708327592'),
(9, '+256-759912814', 1760534396, '+256-759912814', 'Published', '1760534396', NULL, '---', 'Create new Contact with beginning balance.', '2025-10-15 13:19:56', '[{\"account\":\"c+256-778811715\",\"amount\":0}]', '[{\"account\":\"10\",\"amount\":0}]', 'Create new Contact with beginning balance.', 'contactid:+256-778811715'),
(10, '+256-759912814', 1760534542, '+256-759912814', 'Published', '1760534542', NULL, '---', 'Create new Contact with beginning balance.', '2025-10-15 13:22:22', '[{\"account\":\"c+256-772876555\",\"amount\":0}]', '[{\"account\":\"10\",\"amount\":0}]', 'Create new Contact with beginning balance.', 'contactid:+256-772876555'),
(11, '+256-759912814', 1760534721, '+256-759912814', 'Published', '1760534721', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:25:21', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:1'),
(12, '+256-759912814', 1760534896, '+256-759912814', 'Published', '1760534896', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:28:16', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:2'),
(13, '+256-759912814', 1760534985, '+256-759912814', 'Published', '1760534985', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:29:45', '[{\"account\":\"10\",\"amount\":\"6500\"}]', '[{\"account\":\"11\",\"amount\":\"6500\"}]', 'Create new Product with beginning balance.', 'product:3'),
(14, '+256-759912814', 1760535134, '+256-759912814', 'Published', '1760535134', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:32:14', '[{\"account\":\"10\",\"amount\":\"120840\"}]', '[{\"account\":\"11\",\"amount\":\"120840\"}]', 'Create new Product with beginning balance.', 'product:4'),
(15, '+256-759912814', 1760535562, '+256-759912814', 'Published', '1760535562', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:39:22', '[{\"account\":\"10\",\"amount\":\"23000\"}]', '[{\"account\":\"11\",\"amount\":\"23000\"}]', 'Create new Product with beginning balance.', 'product:5'),
(16, '+256-759912814', 1760535626, '+256-759912814', 'Published', '1760535626', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:40:26', '[{\"account\":\"10\",\"amount\":\"28000\"}]', '[{\"account\":\"11\",\"amount\":\"28000\"}]', 'Create new Product with beginning balance.', 'product:6'),
(17, '+256-759912814', 1760535683, '+256-759912814', 'Published', '1760535683', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:41:23', '[{\"account\":\"10\",\"amount\":\"35000\"}]', '[{\"account\":\"11\",\"amount\":\"35000\"}]', 'Create new Product with beginning balance.', 'product:7'),
(18, '+256-759912814', 1760535757, '+256-759912814', 'Published', '1760535757', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:42:37', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:8'),
(19, '+256-759912814', 1760535833, '+256-759912814', 'Published', '1760535833', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:43:53', '[{\"account\":\"10\",\"amount\":\"29900\"}]', '[{\"account\":\"11\",\"amount\":\"29900\"}]', 'Create new Product with beginning balance.', 'product:9'),
(20, '+256-759912814', 1760535908, '+256-759912814', 'Published', '1760535908', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:45:08', '[{\"account\":\"10\",\"amount\":\"18400\"}]', '[{\"account\":\"11\",\"amount\":\"18400\"}]', 'Create new Product with beginning balance.', 'product:10'),
(21, '+256-759912814', 1760535953, '+256-759912814', 'Published', '1760535953', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:45:53', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:11'),
(22, '+256-759912814', 1760536045, '+256-759912814', 'Published', '1760536045', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:47:25', '[{\"account\":\"10\",\"amount\":\"20000\"}]', '[{\"account\":\"11\",\"amount\":\"20000\"}]', 'Create new Product with beginning balance.', 'product:12'),
(23, '+256-759912814', 1760536149, '+256-759912814', 'Published', '1760536149', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:49:09', '[{\"account\":\"10\",\"amount\":\"9000\"}]', '[{\"account\":\"11\",\"amount\":\"9000\"}]', 'Create new Product with beginning balance.', 'product:13'),
(24, '+256-759912814', 1760536446, '+256-759912814', 'Published', '1760536446', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:54:06', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:14'),
(25, '+256-759912814', 1760536515, '+256-759912814', 'Published', '1760536515', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:55:15', '[{\"account\":\"10\",\"amount\":\"30000\"}]', '[{\"account\":\"11\",\"amount\":\"30000\"}]', 'Create new Product with beginning balance.', 'product:15'),
(26, '+256-759912814', 1760536582, '+256-759912814', 'Published', '1760536582', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:56:22', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:16'),
(27, '+256-759912814', 1760536652, '+256-759912814', 'Published', '1760536652', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:57:32', '[{\"account\":\"10\",\"amount\":\"2400\"}]', '[{\"account\":\"11\",\"amount\":\"2400\"}]', 'Create new Product with beginning balance.', 'product:17'),
(28, '+256-759912814', 1760536691, '+256-759912814', 'Published', '1760536691', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:58:11', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:18'),
(29, '+256-759912814', 1760536703, '+256-759912814', 'Published', '1760536703', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 13:58:23', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:19'),
(30, '+256-759912814', 1760536867, '+256-759912814', 'Published', '1760536867', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:01:07', '[{\"account\":\"10\",\"amount\":\"16800\"}]', '[{\"account\":\"11\",\"amount\":\"16800\"}]', 'Create new Product with beginning balance.', 'product:20'),
(31, '+256-759912814', 1760536918, '+256-759912814', 'Published', '1760536918', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:01:58', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:21'),
(32, '+256-759912814', 1760536970, '+256-759912814', 'Published', '1760536970', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:02:50', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:22'),
(33, '+256-759912814', 1760537036, '+256-759912814', 'Published', '1760537036', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:03:56', '[{\"account\":\"10\",\"amount\":\"67500\"}]', '[{\"account\":\"11\",\"amount\":\"67500\"}]', 'Create new Product with beginning balance.', 'product:23'),
(34, '+256-759912814', 1760537072, '+256-759912814', 'Published', '1760537072', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:04:32', '[{\"account\":\"10\",\"amount\":\"108000\"}]', '[{\"account\":\"11\",\"amount\":\"108000\"}]', 'Create new Product with beginning balance.', 'product:24'),
(35, '+256-759912814', 1760537117, '+256-759912814', 'Published', '1760537117', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:05:17', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:25'),
(36, '+256-759912814', 1760537200, '+256-759912814', 'Published', '1760537200', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:06:40', '[{\"account\":\"10\",\"amount\":\"45500\"}]', '[{\"account\":\"11\",\"amount\":\"45500\"}]', 'Create new Product with beginning balance.', 'product:26'),
(37, '+256-759912814', 1760537244, '+256-759912814', 'Published', '1760537244', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:07:24', '[{\"account\":\"10\",\"amount\":\"147000\"}]', '[{\"account\":\"11\",\"amount\":\"147000\"}]', 'Create new Product with beginning balance.', 'product:27'),
(38, '+256-759912814', 1760537307, '+256-759912814', 'Published', '1760537307', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:08:27', '[{\"account\":\"10\",\"amount\":\"512000\"}]', '[{\"account\":\"11\",\"amount\":\"512000\"}]', 'Create new Product with beginning balance.', 'product:28'),
(39, '+256-759912814', 1760537366, '+256-759912814', 'Published', '1760537366', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:09:26', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:29'),
(40, '+256-759912814', 1760537441, '+256-759912814', 'Published', '1760537441', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:10:41', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:30'),
(41, '+256-759912814', 1760537489, '+256-759912814', 'Published', '1760537489', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:11:29', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:31'),
(42, '+256-759912814', 1760537590, '+256-759912814', 'Published', '1760537590', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:13:10', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:32'),
(43, '+256-759912814', 1760537644, '+256-759912814', 'Published', '1760537644', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:14:04', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:33'),
(44, '+256-759912814', 1760537688, '+256-759912814', 'Published', '1760537688', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:14:48', '[{\"account\":\"10\",\"amount\":\"140000\"}]', '[{\"account\":\"11\",\"amount\":\"140000\"}]', 'Create new Product with beginning balance.', 'product:34'),
(45, '+256-759912814', 1760537727, '+256-759912814', 'Published', '1760537727', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:15:27', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:35'),
(46, '+256-759912814', 1760537832, '+256-759912814', 'Published', '1760537832', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:17:12', '[{\"account\":\"10\",\"amount\":\"12000\"}]', '[{\"account\":\"11\",\"amount\":\"12000\"}]', 'Create new Product with beginning balance.', 'product:36'),
(47, '+256-759912814', 1760537915, '+256-759912814', 'Published', '1760537915', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:18:35', '[{\"account\":\"10\",\"amount\":\"32000\"}]', '[{\"account\":\"11\",\"amount\":\"32000\"}]', 'Create new Product with beginning balance.', 'product:37'),
(48, '+256-759912814', 1760537982, '+256-759912814', 'Published', '1760537982', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:19:42', '[{\"account\":\"10\",\"amount\":\"121600\"}]', '[{\"account\":\"11\",\"amount\":\"121600\"}]', 'Create new Product with beginning balance.', 'product:38'),
(49, '+256-759912814', 1760538057, '+256-759912814', 'Published', '1760538057', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-15 14:20:57', '[{\"account\":\"10\",\"amount\":39100}]', '[{\"account\":\"11\",\"amount\":39100}]', 'Adjust stock: opening balance stock item', 'product:9'),
(50, '+256-759912814', 1760538245, '+256-759912814', 'Published', '1760538245', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:24:05', '[{\"account\":\"10\",\"amount\":\"16000\"}]', '[{\"account\":\"11\",\"amount\":\"16000\"}]', 'Create new Product with beginning balance.', 'product:39'),
(51, '+256-759912814', 1760538314, '+256-759912814', 'Published', '1760538314', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:25:14', '[{\"account\":\"10\",\"amount\":\"52800\"}]', '[{\"account\":\"11\",\"amount\":\"52800\"}]', 'Create new Product with beginning balance.', 'product:40'),
(52, '+256-759912814', 1760538412, '+256-759912814', 'Published', '1760538412', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:26:52', '[{\"account\":\"10\",\"amount\":\"48000\"}]', '[{\"account\":\"11\",\"amount\":\"48000\"}]', 'Create new Product with beginning balance.', 'product:41'),
(53, '+256-759912814', 1760538450, '+256-759912814', 'Published', '1760538450', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:27:30', '[{\"account\":\"10\",\"amount\":\"31200\"}]', '[{\"account\":\"11\",\"amount\":\"31200\"}]', 'Create new Product with beginning balance.', 'product:42'),
(54, '+256-759912814', 1760538494, '+256-759912814', 'Published', '1760538494', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:28:14', '[{\"account\":\"10\",\"amount\":\"16800\"}]', '[{\"account\":\"11\",\"amount\":\"16800\"}]', 'Create new Product with beginning balance.', 'product:43'),
(55, '+256-759912814', 1760538554, '+256-759912814', 'Published', '1760538554', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:29:14', '[{\"account\":\"10\",\"amount\":\"3600\"}]', '[{\"account\":\"11\",\"amount\":\"3600\"}]', 'Create new Product with beginning balance.', 'product:44'),
(56, '+256-759912814', 1760538607, '+256-759912814', 'Published', '1760538607', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:30:07', '[{\"account\":\"10\",\"amount\":\"31500\"}]', '[{\"account\":\"11\",\"amount\":\"31500\"}]', 'Create new Product with beginning balance.', 'product:45'),
(57, '+256-759912814', 1760538725, '+256-759912814', 'Published', '1760538725', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-15 14:32:05', '[{\"account\":\"10\",\"amount\":16000}]', '[{\"account\":\"11\",\"amount\":16000}]', 'Adjust stock: opening balance stock item', 'product:39'),
(58, '+256-759912814', 1760538824, '+256-759912814', 'Published', '1760538824', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:33:44', '[{\"account\":\"10\",\"amount\":\"2400\"}]', '[{\"account\":\"11\",\"amount\":\"2400\"}]', 'Create new Product with beginning balance.', 'product:46'),
(59, '+256-759912814', 1760538882, '+256-759912814', 'Published', '1760538882', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:34:42', '[{\"account\":\"10\",\"amount\":\"12000\"}]', '[{\"account\":\"11\",\"amount\":\"12000\"}]', 'Create new Product with beginning balance.', 'product:47'),
(60, '+256-759912814', 1760538929, '+256-759912814', 'Published', '1760538929', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:35:29', '[{\"account\":\"10\",\"amount\":\"2800\"}]', '[{\"account\":\"11\",\"amount\":\"2800\"}]', 'Create new Product with beginning balance.', 'product:48'),
(61, '+256-759912814', 1760538986, '+256-759912814', 'Published', '1760538986', NULL, '---', 'Create new Product with beginning balance.', '2025-10-15 14:36:26', '[{\"account\":\"10\",\"amount\":\"16000\"}]', '[{\"account\":\"11\",\"amount\":\"16000\"}]', 'Create new Product with beginning balance.', 'product:49'),
(62, '+256-759912814', 1760539047, '+256-759912814', 'Published', '1760539047', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-15 14:37:27', '[{\"account\":\"10\",\"amount\":4800}]', '[{\"account\":\"11\",\"amount\":4800}]', 'Adjust stock: opening balance stock item', 'product:41'),
(63, '+256-759912814', 1760598596, '+256-759912814', 'Published', '1760598596', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:09:56', '[{\"account\":\"10\",\"amount\":\"37700\"}]', '[{\"account\":\"11\",\"amount\":\"37700\"}]', 'Create new Product with beginning balance.', 'product:50'),
(64, '+256-759912814', 1760598596, '+256-759912814', 'Published', '1760598596', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:09:56', '[{\"account\":\"10\",\"amount\":\"37700\"}]', '[{\"account\":\"11\",\"amount\":\"37700\"}]', 'Create new Product with beginning balance.', 'product:51'),
(65, '+256-759912814', 1760598662, '+256-759912814', 'Published', '1760598662', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:11:02', '[{\"account\":\"10\",\"amount\":\"26000\"}]', '[{\"account\":\"11\",\"amount\":\"26000\"}]', 'Create new Product with beginning balance.', 'product:52'),
(66, '+256-759912814', 1760598862, '+256-759912814', 'Published', '1760598862', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:14:22', '[{\"account\":\"10\",\"amount\":\"120900\"}]', '[{\"account\":\"11\",\"amount\":\"120900\"}]', 'Create new Product with beginning balance.', 'product:53'),
(67, '+256-759912814', 1760598923, '+256-759912814', 'Published', '1760598923', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:15:23', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:54'),
(68, '+256-759912814', 1760598964, '+256-759912814', 'Published', '1760598964', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:16:04', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:55'),
(69, '+256-759912814', 1760599023, '+256-759912814', 'Published', '1760599023', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:17:03', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:56'),
(70, '+256-759912814', 1760599121, '+256-759912814', 'Published', '1760599121', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:18:41', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:57'),
(71, '+256-759912814', 1760599181, '+256-759912814', 'Published', '1760599181', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:19:41', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:58'),
(72, '+256-759912814', 1760599237, '+256-759912814', 'Published', '1760599237', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:20:37', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:59'),
(73, '+256-759912814', 1760599329, '+256-759912814', 'Published', '1760599329', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-16 07:22:09', '[{\"account\":\"10\",\"amount\":20400}]', '[{\"account\":\"11\",\"amount\":20400}]', 'Adjust stock: opening balance stock item', 'product:59'),
(74, '+256-759912814', 1760599476, '+256-759912814', 'Published', '1760599476', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:24:36', '[{\"account\":\"10\",\"amount\":\"70800\"}]', '[{\"account\":\"11\",\"amount\":\"70800\"}]', 'Create new Product with beginning balance.', 'product:60'),
(75, '+256-759912814', 1760599577, '+256-759912814', 'Published', '1760599577', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:26:17', '[{\"account\":\"10\",\"amount\":\"150800\"}]', '[{\"account\":\"11\",\"amount\":\"150800\"}]', 'Create new Product with beginning balance.', 'product:61'),
(76, '+256-759912814', 1760599664, '+256-759912814', 'Published', '1760599664', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:27:44', '[{\"account\":\"10\",\"amount\":\"12000\"}]', '[{\"account\":\"11\",\"amount\":\"12000\"}]', 'Create new Product with beginning balance.', 'product:62'),
(77, '+256-759912814', 1760599804, '+256-759912814', 'Published', '1760599804', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:30:04', '[{\"account\":\"10\",\"amount\":\"37800\"}]', '[{\"account\":\"11\",\"amount\":\"37800\"}]', 'Create new Product with beginning balance.', 'product:63'),
(78, '+256-759912814', 1760599854, '+256-759912814', 'Published', '1760599854', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:30:54', '[{\"account\":\"10\",\"amount\":\"4000\"}]', '[{\"account\":\"11\",\"amount\":\"4000\"}]', 'Create new Product with beginning balance.', 'product:64'),
(79, '+256-759912814', 1760599907, '+256-759912814', 'Published', '1760599907', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:31:47', '[{\"account\":\"10\",\"amount\":\"2400\"}]', '[{\"account\":\"11\",\"amount\":\"2400\"}]', 'Create new Product with beginning balance.', 'product:65'),
(80, '+256-759912814', 1760600093, '+256-759912814', 'Published', '1760600093', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:34:53', '[{\"account\":\"10\",\"amount\":\"25200\"}]', '[{\"account\":\"11\",\"amount\":\"25200\"}]', 'Create new Product with beginning balance.', 'product:66'),
(81, '+256-759912814', 1760600151, '+256-759912814', 'Published', '1760600151', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:35:51', '[{\"account\":\"10\",\"amount\":\"27000\"}]', '[{\"account\":\"11\",\"amount\":\"27000\"}]', 'Create new Product with beginning balance.', 'product:67'),
(82, '+256-759912814', 1760600196, '+256-759912814', 'Published', '1760600196', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:36:36', '[{\"account\":\"10\",\"amount\":\"21600\"}]', '[{\"account\":\"11\",\"amount\":\"21600\"}]', 'Create new Product with beginning balance.', 'product:68'),
(83, '+256-759912814', 1760600270, '+256-759912814', 'Published', '1760600270', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:37:50', '[{\"account\":\"10\",\"amount\":\"12000\"}]', '[{\"account\":\"11\",\"amount\":\"12000\"}]', 'Create new Product with beginning balance.', 'product:69'),
(84, '+256-759912814', 1760600361, '+256-759912814', 'Published', '1760600361', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:39:21', '[{\"account\":\"10\",\"amount\":\"35000\"}]', '[{\"account\":\"11\",\"amount\":\"35000\"}]', 'Create new Product with beginning balance.', 'product:70'),
(85, '+256-759912814', 1760600363, '+256-759912814', 'Published', '1760600363', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:39:23', '[{\"account\":\"10\",\"amount\":\"35000\"}]', '[{\"account\":\"11\",\"amount\":\"35000\"}]', 'Create new Product with beginning balance.', 'product:71'),
(86, '+256-759912814', 1760600461, '+256-759912814', 'Published', '1760600461', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:41:01', '[{\"account\":\"10\",\"amount\":\"33000\"}]', '[{\"account\":\"11\",\"amount\":\"33000\"}]', 'Create new Product with beginning balance.', 'product:72'),
(87, '+256-759912814', 1760600464, '+256-759912814', 'Published', '1760600464', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:41:04', '[{\"account\":\"10\",\"amount\":\"33000\"}]', '[{\"account\":\"11\",\"amount\":\"33000\"}]', 'Create new Product with beginning balance.', 'product:73'),
(88, '+256-759912814', 1760601059, '+256-759912814', 'Published', '1760601059', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:50:59', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:74'),
(89, '+256-759912814', 1760601102, '+256-759912814', 'Published', '1760601102', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:51:42', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:75'),
(90, '+256-759912814', 1760601161, '+256-759912814', 'Published', '1760601161', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:52:41', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:76'),
(91, '+256-759912814', 1760601227, '+256-759912814', 'Published', '1760601227', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:53:47', '[{\"account\":\"10\",\"amount\":\"37200\"}]', '[{\"account\":\"11\",\"amount\":\"37200\"}]', 'Create new Product with beginning balance.', 'product:77'),
(92, '+256-759912814', 1760601276, '+256-759912814', 'Published', '1760601276', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:54:36', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:78'),
(93, '+256-759912814', 1760601345, '+256-759912814', 'Published', '1760601345', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:55:45', '[{\"account\":\"10\",\"amount\":\"8000\"}]', '[{\"account\":\"11\",\"amount\":\"8000\"}]', 'Create new Product with beginning balance.', 'product:79'),
(94, '+256-759912814', 1760601388, '+256-759912814', 'Published', '1760601388', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:56:28', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:80'),
(95, '+256-759912814', 1760601438, '+256-759912814', 'Published', '1760601438', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:57:18', '[{\"account\":\"10\",\"amount\":\"12000\"}]', '[{\"account\":\"11\",\"amount\":\"12000\"}]', 'Create new Product with beginning balance.', 'product:81'),
(96, '+256-759912814', 1760601501, '+256-759912814', 'Published', '1760601501', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:58:21', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:82'),
(97, '+256-759912814', 1760601543, '+256-759912814', 'Published', '1760601543', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:59:03', '[{\"account\":\"10\",\"amount\":\"13750\"}]', '[{\"account\":\"11\",\"amount\":\"13750\"}]', 'Create new Product with beginning balance.', 'product:83'),
(98, '+256-759912814', 1760601580, '+256-759912814', 'Published', '1760601580', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 07:59:40', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:84'),
(99, '+256-759912814', 1760601627, '+256-759912814', 'Published', '1760601627', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:00:27', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:85'),
(100, '+256-759912814', 1760601676, '+256-759912814', 'Published', '1760601676', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:01:16', '[{\"account\":\"10\",\"amount\":\"58000\"}]', '[{\"account\":\"11\",\"amount\":\"58000\"}]', 'Create new Product with beginning balance.', 'product:86'),
(101, '+256-759912814', 1760601723, '+256-759912814', 'Published', '1760601723', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:02:03', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:87'),
(102, '+256-759912814', 1760601774, '+256-759912814', 'Published', '1760601774', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:02:54', '[{\"account\":\"10\",\"amount\":\"38500\"}]', '[{\"account\":\"11\",\"amount\":\"38500\"}]', 'Create new Product with beginning balance.', 'product:88'),
(103, '+256-759912814', 1760601827, '+256-759912814', 'Published', '1760601827', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:03:47', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:89'),
(104, '+256-759912814', 1760601869, '+256-759912814', 'Published', '1760601869', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:04:29', '[{\"account\":\"10\",\"amount\":\"42000\"}]', '[{\"account\":\"11\",\"amount\":\"42000\"}]', 'Create new Product with beginning balance.', 'product:90'),
(105, '+256-759912814', 1760601941, '+256-759912814', 'Published', '1760601941', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:05:41', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:91'),
(106, '+256-759912814', 1760601996, '+256-759912814', 'Published', '1760601996', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:06:36', '[{\"account\":\"10\",\"amount\":\"332000\"}]', '[{\"account\":\"11\",\"amount\":\"332000\"}]', 'Create new Product with beginning balance.', 'product:92'),
(107, '+256-759912814', 1760602039, '+256-759912814', 'Published', '1760602039', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:07:19', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:93'),
(108, '+256-759912814', 1760602764, '+256-759912814', 'Published', '1760602764', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:19:24', '[{\"account\":\"10\",\"amount\":\"13000\"}]', '[{\"account\":\"11\",\"amount\":\"13000\"}]', 'Create new Product with beginning balance.', 'product:94'),
(109, '+256-759912814', 1760602823, '+256-759912814', 'Published', '1760602823', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:20:23', '[{\"account\":\"10\",\"amount\":\"40300\"}]', '[{\"account\":\"11\",\"amount\":\"40300\"}]', 'Create new Product with beginning balance.', 'product:95'),
(110, '+256-759912814', 1760602894, '+256-759912814', 'Published', '1760602894', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:21:34', '[{\"account\":\"10\",\"amount\":\"11700\"}]', '[{\"account\":\"11\",\"amount\":\"11700\"}]', 'Create new Product with beginning balance.', 'product:96'),
(111, '+256-759912814', 1760603279, '+256-759912814', 'Published', '1760603279', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:27:59', '[{\"account\":\"10\",\"amount\":\"54000\"}]', '[{\"account\":\"11\",\"amount\":\"54000\"}]', 'Create new Product with beginning balance.', 'product:97'),
(112, '+256-759912814', 1760603323, '+256-759912814', 'Published', '1760603323', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:28:43', '[{\"account\":\"10\",\"amount\":\"13800\"}]', '[{\"account\":\"11\",\"amount\":\"13800\"}]', 'Create new Product with beginning balance.', 'product:98'),
(113, '+256-759912814', 1760603394, '+256-759912814', 'Published', '1760603394', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:29:54', '[{\"account\":\"10\",\"amount\":\"25000\"}]', '[{\"account\":\"11\",\"amount\":\"25000\"}]', 'Create new Product with beginning balance.', 'product:99'),
(114, '+256-759912814', 1760603447, '+256-759912814', 'Published', '1760603447', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:30:47', '[{\"account\":\"10\",\"amount\":\"2500\"}]', '[{\"account\":\"11\",\"amount\":\"2500\"}]', 'Create new Product with beginning balance.', 'product:100'),
(115, '+256-759912814', 1760603497, '+256-759912814', 'Published', '1760603497', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-16 08:31:37', '[{\"account\":\"10\",\"amount\":12500}]', '[{\"account\":\"11\",\"amount\":12500}]', 'Adjust stock: opening balance stock item', 'product:76'),
(116, '+256-759912814', 1760603566, '+256-759912814', 'Published', '1760603566', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:32:46', '[{\"account\":\"10\",\"amount\":\"108800\"}]', '[{\"account\":\"11\",\"amount\":\"108800\"}]', 'Create new Product with beginning balance.', 'product:101'),
(117, '+256-759912814', 1760603619, '+256-759912814', 'Published', '1760603619', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:33:39', '[{\"account\":\"10\",\"amount\":\"130500\"}]', '[{\"account\":\"11\",\"amount\":\"130500\"}]', 'Create new Product with beginning balance.', 'product:102'),
(118, '+256-759912814', 1760603688, '+256-759912814', 'Published', '1760603688', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:34:48', '[{\"account\":\"10\",\"amount\":\"80000\"}]', '[{\"account\":\"11\",\"amount\":\"80000\"}]', 'Create new Product with beginning balance.', 'product:103'),
(119, '+256-759912814', 1760603921, '+256-759912814', 'Published', '1760603921', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:38:41', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:104'),
(120, '+256-759912814', 1760603993, '+256-759912814', 'Published', '1760603993', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:39:53', '[{\"account\":\"10\",\"amount\":\"2500\"}]', '[{\"account\":\"11\",\"amount\":\"2500\"}]', 'Create new Product with beginning balance.', 'product:105'),
(121, '+256-759912814', 1760604187, '+256-759912814', 'Published', '1760604187', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:43:07', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:106'),
(122, '+256-759912814', 1760604229, '+256-759912814', 'Published', '1760604229', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:43:49', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:107'),
(123, '+256-759912814', 1760604276, '+256-759912814', 'Published', '1760604276', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:44:36', '[{\"account\":\"10\",\"amount\":\"18200\"}]', '[{\"account\":\"11\",\"amount\":\"18200\"}]', 'Create new Product with beginning balance.', 'product:108'),
(124, '+256-759912814', 1760604323, '+256-759912814', 'Published', '1760604323', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:45:23', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:109'),
(125, '+256-759912814', 1760604364, '+256-759912814', 'Published', '1760604364', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:46:04', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:110'),
(126, '+256-759912814', 1760604435, '+256-759912814', 'Published', '1760604435', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:47:15', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:111'),
(127, '+256-759912814', 1760604494, '+256-759912814', 'Published', '1760604494', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:48:14', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:112'),
(128, '+256-759912814', 1760604539, '+256-759912814', 'Published', '1760604539', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:48:59', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:113'),
(129, '+256-759912814', 1760604688, '+256-759912814', 'Published', '1760604688', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:51:28', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:114'),
(130, '+256-759912814', 1760604752, '+256-759912814', 'Published', '1760604752', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:52:32', '[{\"account\":\"10\",\"amount\":\"22000\"}]', '[{\"account\":\"11\",\"amount\":\"22000\"}]', 'Create new Product with beginning balance.', 'product:115'),
(131, '+256-759912814', 1760604795, '+256-759912814', 'Published', '1760604795', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:53:15', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:116'),
(132, '+256-759912814', 1760604833, '+256-759912814', 'Published', '1760604833', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:53:53', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:117'),
(133, '+256-759912814', 1760604873, '+256-759912814', 'Published', '1760604873', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:54:33', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:118'),
(134, '+256-759912814', 1760604916, '+256-759912814', 'Published', '1760604916', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:55:16', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:119'),
(135, '+256-759912814', 1760604955, '+256-759912814', 'Published', '1760604955', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:55:55', '[{\"account\":\"10\",\"amount\":\"11000\"}]', '[{\"account\":\"11\",\"amount\":\"11000\"}]', 'Create new Product with beginning balance.', 'product:120'),
(136, '+256-759912814', 1760604996, '+256-759912814', 'Published', '1760604996', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:56:36', '[{\"account\":\"10\",\"amount\":\"33000\"}]', '[{\"account\":\"11\",\"amount\":\"33000\"}]', 'Create new Product with beginning balance.', 'product:121'),
(137, '+256-759912814', 1760605031, '+256-759912814', 'Published', '1760605031', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:57:11', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:122'),
(138, '+256-759912814', 1760605069, '+256-759912814', 'Published', '1760605069', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:57:49', '[{\"account\":\"10\",\"amount\":\"88182\"}]', '[{\"account\":\"11\",\"amount\":\"88182\"}]', 'Create new Product with beginning balance.', 'product:123'),
(139, '+256-759912814', 1760605120, '+256-759912814', 'Published', '1760605120', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:58:40', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:124'),
(140, '+256-759912814', 1760605161, '+256-759912814', 'Published', '1760605161', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 08:59:21', '[{\"account\":\"10\",\"amount\":\"75000\"}]', '[{\"account\":\"11\",\"amount\":\"75000\"}]', 'Create new Product with beginning balance.', 'product:125'),
(141, '+256-759912814', 1760605380, '+256-759912814', 'Published', '1760605380', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:03:00', '[{\"account\":\"10\",\"amount\":\"274700\"}]', '[{\"account\":\"11\",\"amount\":\"274700\"}]', 'Create new Product with beginning balance.', 'product:126'),
(142, '+256-759912814', 1760605421, '+256-759912814', 'Published', '1760605421', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:03:41', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:127'),
(143, '+256-759912814', 1760605474, '+256-759912814', 'Published', '1760605474', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:04:34', '[{\"account\":\"10\",\"amount\":\"84000\"}]', '[{\"account\":\"11\",\"amount\":\"84000\"}]', 'Create new Product with beginning balance.', 'product:128'),
(144, '+256-759912814', 1760605517, '+256-759912814', 'Published', '1760605517', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:05:17', '[{\"account\":\"10\",\"amount\":\"81000\"}]', '[{\"account\":\"11\",\"amount\":\"81000\"}]', 'Create new Product with beginning balance.', 'product:129'),
(145, '+256-759912814', 1760605556, '+256-759912814', 'Published', '1760605556', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:05:56', '[{\"account\":\"10\",\"amount\":\"25500\"}]', '[{\"account\":\"11\",\"amount\":\"25500\"}]', 'Create new Product with beginning balance.', 'product:130'),
(146, '+256-759912814', 1760605795, '+256-759912814', 'Published', '1760605795', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:09:55', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:131'),
(147, '+256-759912814', 1760605852, '+256-759912814', 'Published', '1760605852', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:10:52', '[{\"account\":\"10\",\"amount\":\"42000\"}]', '[{\"account\":\"11\",\"amount\":\"42000\"}]', 'Create new Product with beginning balance.', 'product:132'),
(148, '+256-759912814', 1760605980, '+256-759912814', 'Published', '1760605980', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:13:00', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:133'),
(149, '+256-759912814', 1760606019, '+256-759912814', 'Published', '1760606019', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:13:39', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:134'),
(150, '+256-759912814', 1760606067, '+256-759912814', 'Published', '1760606067', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:14:27', '[{\"account\":\"10\",\"amount\":\"64000\"}]', '[{\"account\":\"11\",\"amount\":\"64000\"}]', 'Create new Product with beginning balance.', 'product:135'),
(151, '+256-759912814', 1760606185, '+256-759912814', 'Published', '1760606185', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:16:25', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:136'),
(152, '+256-759912814', 1760606286, '+256-759912814', 'Published', '1760606286', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:18:06', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:137'),
(153, '+256-759912814', 1760606340, '+256-759912814', 'Published', '1760606340', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:19:00', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:138'),
(154, '+256-759912814', 1760606372, '+256-759912814', 'Published', '1760606372', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:19:32', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:139'),
(155, '+256-759912814', 1760606454, '+256-759912814', 'Published', '1760606454', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:20:54', '[{\"account\":\"10\",\"amount\":\"80000\"}]', '[{\"account\":\"11\",\"amount\":\"80000\"}]', 'Create new Product with beginning balance.', 'product:140'),
(156, '+256-759912814', 1760606510, '+256-759912814', 'Published', '1760606510', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:21:50', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:141'),
(157, '+256-759912814', 1760606554, '+256-759912814', 'Published', '1760606554', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:22:34', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:142'),
(158, '+256-759912814', 1760606624, '+256-759912814', 'Published', '1760606624', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-16 09:23:44', '[{\"account\":\"10\",\"amount\":17500}]', '[{\"account\":\"11\",\"amount\":17500}]', 'Adjust stock: opening balance stock item', 'product:7'),
(159, '+256-759912814', 1760606675, '+256-759912814', 'Published', '1760606675', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-16 09:24:35', '[{\"account\":\"10\",\"amount\":2300}]', '[{\"account\":\"11\",\"amount\":2300}]', 'Adjust stock: opening balance stock item', 'product:98');
INSERT INTO `journal` (`id`, `owner_mobile`, `timestamp`, `added_by`, `status`, `last_updated`, `sync`, `---`, `description`, `date_time`, `credit_json`, `debit_json`, `entry_type`, `entry_link`) VALUES
(160, '+256-759912814', 1760606812, '+256-759912814', 'Published', '1760606812', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:26:52', '[{\"account\":\"10\",\"amount\":\"90000\"}]', '[{\"account\":\"11\",\"amount\":\"90000\"}]', 'Create new Product with beginning balance.', 'product:143'),
(161, '+256-759912814', 1760607178, '+256-759912814', 'Published', '1760607178', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:32:58', '[{\"account\":\"10\",\"amount\":\"21000\"}]', '[{\"account\":\"11\",\"amount\":\"21000\"}]', 'Create new Product with beginning balance.', 'product:144'),
(162, '+256-759912814', 1760607291, '+256-759912814', 'Published', '1760607291', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:34:51', '[{\"account\":\"10\",\"amount\":\"1500\"}]', '[{\"account\":\"11\",\"amount\":\"1500\"}]', 'Create new Product with beginning balance.', 'product:145'),
(163, '+256-759912814', 1760607334, '+256-759912814', 'Published', '1760607334', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:35:34', '[{\"account\":\"10\",\"amount\":\"30000\"}]', '[{\"account\":\"11\",\"amount\":\"30000\"}]', 'Create new Product with beginning balance.', 'product:146'),
(164, '+256-759912814', 1760607368, '+256-759912814', 'Published', '1760607368', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:36:08', '[{\"account\":\"10\",\"amount\":\"1500\"}]', '[{\"account\":\"11\",\"amount\":\"1500\"}]', 'Create new Product with beginning balance.', 'product:147'),
(165, '+256-759912814', 1760607399, '+256-759912814', 'Published', '1760607399', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:36:39', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:148'),
(166, '+256-759912814', 1760607441, '+256-759912814', 'Published', '1760607441', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:37:21', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:149'),
(167, '+256-759912814', 1760607545, '+256-759912814', 'Published', '1760607545', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:39:05', '[{\"account\":\"10\",\"amount\":\"52000\"}]', '[{\"account\":\"11\",\"amount\":\"52000\"}]', 'Create new Product with beginning balance.', 'product:150'),
(168, '+256-759912814', 1760607674, '+256-759912814', 'Published', '1760607674', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:41:14', '[{\"account\":\"10\",\"amount\":\"100000\"}]', '[{\"account\":\"11\",\"amount\":\"100000\"}]', 'Create new Product with beginning balance.', 'product:151'),
(169, '+256-759912814', 1760607727, '+256-759912814', 'Published', '1760607727', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:42:07', '[{\"account\":\"10\",\"amount\":\"60000\"}]', '[{\"account\":\"11\",\"amount\":\"60000\"}]', 'Create new Product with beginning balance.', 'product:152'),
(170, '+256-759912814', 1760607783, '+256-759912814', 'Published', '1760607783', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:43:03', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:153'),
(171, '+256-759912814', 1760608184, '+256-759912814', 'Published', '1760608184', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:49:44', '[{\"account\":\"10\",\"amount\":\"30000\"}]', '[{\"account\":\"11\",\"amount\":\"30000\"}]', 'Create new Product with beginning balance.', 'product:154'),
(172, '+256-759912814', 1760608229, '+256-759912814', 'Published', '1760608229', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:50:29', '[{\"account\":\"10\",\"amount\":\"13500\"}]', '[{\"account\":\"11\",\"amount\":\"13500\"}]', 'Create new Product with beginning balance.', 'product:155'),
(173, '+256-759912814', 1760608277, '+256-759912814', 'Published', '1760608277', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:51:17', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:156'),
(174, '+256-759912814', 1760608369, '+256-759912814', 'Published', '1760608369', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:52:49', '[{\"account\":\"10\",\"amount\":\"48000\"}]', '[{\"account\":\"11\",\"amount\":\"48000\"}]', 'Create new Product with beginning balance.', 'product:157'),
(175, '+256-759912814', 1760608417, '+256-759912814', 'Published', '1760608417', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:53:37', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:158'),
(176, '+256-759912814', 1760608457, '+256-759912814', 'Published', '1760608457', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:54:17', '[{\"account\":\"10\",\"amount\":\"5000\"}]', '[{\"account\":\"11\",\"amount\":\"5000\"}]', 'Create new Product with beginning balance.', 'product:159'),
(177, '+256-759912814', 1760608499, '+256-759912814', 'Published', '1760608499', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:54:59', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:160'),
(178, '+256-759912814', 1760608541, '+256-759912814', 'Published', '1760608541', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 09:55:41', '[{\"account\":\"10\",\"amount\":\"52500\"}]', '[{\"account\":\"11\",\"amount\":\"52500\"}]', 'Create new Product with beginning balance.', 'product:161'),
(179, '+256-759912814', 1760608885, '+256-759912814', 'Published', '1760608885', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:01:25', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:162'),
(180, '+256-759912814', 1760608931, '+256-759912814', 'Published', '1760608931', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:02:11', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:163'),
(181, '+256-759912814', 1760608981, '+256-759912814', 'Published', '1760608981', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:03:01', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:164'),
(182, '+256-759912814', 1760609045, '+256-759912814', 'Published', '1760609045', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:04:05', '[{\"account\":\"10\",\"amount\":\"292500\"}]', '[{\"account\":\"11\",\"amount\":\"292500\"}]', 'Create new Product with beginning balance.', 'product:165'),
(183, '+256-759912814', 1760609091, '+256-759912814', 'Published', '1760609091', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:04:51', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:166'),
(184, '+256-759912814', 1760609128, '+256-759912814', 'Published', '1760609128', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:05:28', '[{\"account\":\"10\",\"amount\":\"9000\"}]', '[{\"account\":\"11\",\"amount\":\"9000\"}]', 'Create new Product with beginning balance.', 'product:167'),
(185, '+256-759912814', 1760609163, '+256-759912814', 'Published', '1760609163', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:06:03', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:168'),
(186, '+256-759912814', 1760609202, '+256-759912814', 'Published', '1760609202', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:06:42', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:169'),
(187, '+256-759912814', 1760609235, '+256-759912814', 'Published', '1760609235', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:07:15', '[{\"account\":\"10\",\"amount\":\"1500\"}]', '[{\"account\":\"11\",\"amount\":\"1500\"}]', 'Create new Product with beginning balance.', 'product:170'),
(188, '+256-759912814', 1760609267, '+256-759912814', 'Published', '1760609267', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:07:47', '[{\"account\":\"10\",\"amount\":\"45900\"}]', '[{\"account\":\"11\",\"amount\":\"45900\"}]', 'Create new Product with beginning balance.', 'product:171'),
(189, '+256-759912814', 1760609463, '+256-759912814', 'Published', '1760609463', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:11:03', '[{\"account\":\"10\",\"amount\":\"19500\"}]', '[{\"account\":\"11\",\"amount\":\"19500\"}]', 'Create new Product with beginning balance.', 'product:172'),
(190, '+256-759912814', 1760609560, '+256-759912814', 'Published', '1760609560', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:12:40', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:173'),
(191, '+256-759912814', 1760609602, '+256-759912814', 'Published', '1760609602', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:13:22', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:174'),
(192, '+256-759912814', 1760609654, '+256-759912814', 'Published', '1760609654', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:14:14', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:175'),
(193, '+256-759912814', 1760609698, '+256-759912814', 'Published', '1760609698', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:14:58', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:176'),
(194, '+256-759912814', 1760609742, '+256-759912814', 'Published', '1760609742', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:15:42', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:177'),
(195, '+256-759912814', 1760609777, '+256-759912814', 'Published', '1760609777', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:16:17', '[{\"account\":\"10\",\"amount\":\"31600\"}]', '[{\"account\":\"11\",\"amount\":\"31600\"}]', 'Create new Product with beginning balance.', 'product:178'),
(196, '+256-759912814', 1760609832, '+256-759912814', 'Published', '1760609832', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:17:12', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:179'),
(197, '+256-759912814', 1760609860, '+256-759912814', 'Published', '1760609860', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:17:40', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:180'),
(198, '+256-759912814', 1760609905, '+256-759912814', 'Published', '1760609905', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:18:25', '[{\"account\":\"10\",\"amount\":\"23000\"}]', '[{\"account\":\"11\",\"amount\":\"23000\"}]', 'Create new Product with beginning balance.', 'product:181'),
(199, '+256-759912814', 1760610098, '+256-759912814', 'Published', '1760610098', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:21:38', '[{\"account\":\"10\",\"amount\":\"44000\"}]', '[{\"account\":\"11\",\"amount\":\"44000\"}]', 'Create new Product with beginning balance.', 'product:182'),
(200, '+256-759912814', 1760610163, '+256-759912814', 'Published', '1760610163', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:22:43', '[{\"account\":\"10\",\"amount\":\"4200\"}]', '[{\"account\":\"11\",\"amount\":\"4200\"}]', 'Create new Product with beginning balance.', 'product:183'),
(201, '+256-759912814', 1760610237, '+256-759912814', 'Published', '1760610237', NULL, '---', 'Create new Product with beginning balance.', '2025-10-16 10:23:57', '[{\"account\":\"10\",\"amount\":\"15000\"}]', '[{\"account\":\"11\",\"amount\":\"15000\"}]', 'Create new Product with beginning balance.', 'product:184'),
(202, '+256-759912814', 1760776776, '+256-759912814', 'Published', '1760776776', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 08:39:36', '[{\"account\":\"10\",\"amount\":\"50000\"}]', '[{\"account\":\"11\",\"amount\":\"50000\"}]', 'Create new Product with beginning balance.', 'product:187'),
(203, '+256-759912814', 1760776829, '+256-759912814', 'Published', '1760776829', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 08:40:29', '[{\"account\":\"10\",\"amount\":\"176000\"}]', '[{\"account\":\"11\",\"amount\":\"176000\"}]', 'Create new Product with beginning balance.', 'product:188'),
(204, '+256-759912814', 1760776887, '+256-759912814', 'Published', '1760776887', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 08:41:27', '[{\"account\":\"10\",\"amount\":\"396000\"}]', '[{\"account\":\"11\",\"amount\":\"396000\"}]', 'Create new Product with beginning balance.', 'product:189'),
(205, '+256-759912814', 1760776941, '+256-759912814', 'Published', '1760776941', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 08:42:21', '[{\"account\":\"10\",\"amount\":\"144000\"}]', '[{\"account\":\"11\",\"amount\":\"144000\"}]', 'Create new Product with beginning balance.', 'product:190'),
(206, '+256-759912814', 1760777081, '+256-759912814', 'Published', '1760777081', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 08:44:41', '[{\"account\":\"10\",\"amount\":\"312000\"}]', '[{\"account\":\"11\",\"amount\":\"312000\"}]', 'Create new Product with beginning balance.', 'product:191'),
(207, '+256-759912814', 1760777131, '+256-759912814', 'Published', '1760777131', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 08:45:31', '[{\"account\":\"10\",\"amount\":\"40000\"}]', '[{\"account\":\"11\",\"amount\":\"40000\"}]', 'Create new Product with beginning balance.', 'product:192'),
(208, '+256-759912814', 1760777372, '+256-759912814', 'Published', '1760777372', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 08:49:32', '[{\"account\":\"10\",\"amount\":\"22000\"}]', '[{\"account\":\"11\",\"amount\":\"22000\"}]', 'Create new Product with beginning balance.', 'product:193'),
(209, '+256-759912814', 1760778026, '+256-759912814', 'Published', '1760778026', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:00:26', '[{\"account\":\"10\",\"amount\":\"984000\"}]', '[{\"account\":\"11\",\"amount\":\"984000\"}]', 'Create new Product with beginning balance.', 'product:194'),
(210, '+256-759912814', 1760778116, '+256-759912814', 'Published', '1760778116', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:01:56', '[{\"account\":\"10\",\"amount\":\"451500\"}]', '[{\"account\":\"11\",\"amount\":\"451500\"}]', 'Create new Product with beginning balance.', 'product:195'),
(211, '+256-759912814', 1760778193, '+256-759912814', 'Published', '1760778193', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:03:13', '[{\"account\":\"10\",\"amount\":\"168000\"}]', '[{\"account\":\"11\",\"amount\":\"168000\"}]', 'Create new Product with beginning balance.', 'product:196'),
(212, '+256-759912814', 1760778259, '+256-759912814', 'Published', '1760778259', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:04:19', '[{\"account\":\"10\",\"amount\":\"198000\"}]', '[{\"account\":\"11\",\"amount\":\"198000\"}]', 'Create new Product with beginning balance.', 'product:197'),
(213, '+256-759912814', 1760778356, '+256-759912814', 'Published', '1760778356', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:05:56', '[{\"account\":\"10\",\"amount\":\"486000\"}]', '[{\"account\":\"11\",\"amount\":\"486000\"}]', 'Create new Product with beginning balance.', 'product:198'),
(214, '+256-759912814', 1760778425, '+256-759912814', 'Published', '1760778425', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:07:05', '[{\"account\":\"10\",\"amount\":\"253000\"}]', '[{\"account\":\"11\",\"amount\":\"253000\"}]', 'Create new Product with beginning balance.', 'product:199'),
(215, '+256-759912814', 1760778594, '+256-759912814', 'Published', '1760778594', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:09:54', '[{\"account\":\"10\",\"amount\":\"125000\"}]', '[{\"account\":\"11\",\"amount\":\"125000\"}]', 'Create new Product with beginning balance.', 'product:200'),
(216, '+256-759912814', 1760778652, '+256-759912814', 'Published', '1760778652', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-18 09:10:52', '[{\"account\":\"10\",\"amount\":100000}]', '[{\"account\":\"11\",\"amount\":100000}]', 'Adjust stock: opening balance stock item', 'product:193'),
(217, '+256-759912814', 1760778888, '+256-759912814', 'Published', '1760778888', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-18 09:14:48', '[{\"account\":\"10\",\"amount\":50000}]', '[{\"account\":\"11\",\"amount\":50000}]', 'Adjust stock: opening balance stock item', 'product:200'),
(218, '+256-759912814', 1760778896, '+256-759912814', 'Published', '1760778896', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-18 09:14:56', '[{\"account\":\"10\",\"amount\":100000}]', '[{\"account\":\"11\",\"amount\":100000}]', 'Adjust stock: opening balance stock item', 'product:200'),
(219, '+256-759912814', 1760778961, '+256-759912814', 'Published', '1760778961', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:16:01', '[{\"account\":\"10\",\"amount\":\"24000\"}]', '[{\"account\":\"11\",\"amount\":\"24000\"}]', 'Create new Product with beginning balance.', 'product:201'),
(220, '+256-759912814', 1760779070, '+256-759912814', 'Published', '1760779070', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:17:50', '[{\"account\":\"10\",\"amount\":\"42000\"}]', '[{\"account\":\"11\",\"amount\":\"42000\"}]', 'Create new Product with beginning balance.', 'product:202'),
(221, '+256-759912814', 1760779308, '+256-759912814', 'Published', '1760779308', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:21:48', '[{\"account\":\"10\",\"amount\":\"35000\"}]', '[{\"account\":\"11\",\"amount\":\"35000\"}]', 'Create new Product with beginning balance.', 'product:203'),
(222, '+256-759912814', 1760779367, '+256-759912814', 'Published', '1760779367', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:22:47', '[{\"account\":\"10\",\"amount\":\"70000\"}]', '[{\"account\":\"11\",\"amount\":\"70000\"}]', 'Create new Product with beginning balance.', 'product:204'),
(223, '+256-759912814', 1760779465, '+256-759912814', 'Published', '1760779465', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:24:25', '[{\"account\":\"10\",\"amount\":\"12000\"}]', '[{\"account\":\"11\",\"amount\":\"12000\"}]', 'Create new Product with beginning balance.', 'product:205'),
(224, '+256-759912814', 1760779516, '+256-759912814', 'Published', '1760779516', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:25:16', '[{\"account\":\"10\",\"amount\":\"30000\"}]', '[{\"account\":\"11\",\"amount\":\"30000\"}]', 'Create new Product with beginning balance.', 'product:206'),
(225, '+256-759912814', 1760779563, '+256-759912814', 'Published', '1760779563', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:26:03', '[{\"account\":\"10\",\"amount\":\"50000\"}]', '[{\"account\":\"11\",\"amount\":\"50000\"}]', 'Create new Product with beginning balance.', 'product:207'),
(226, '+256-759912814', 1760779638, '+256-759912814', 'Published', '1760779638', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:27:18', '[{\"account\":\"10\",\"amount\":\"45000\"}]', '[{\"account\":\"11\",\"amount\":\"45000\"}]', 'Create new Product with beginning balance.', 'product:208'),
(227, '+256-759912814', 1760779696, '+256-759912814', 'Published', '1760779696', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:28:16', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:209'),
(228, '+256-759912814', 1760779896, '+256-759912814', 'Published', '1760779896', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:31:36', '[{\"account\":\"10\",\"amount\":\"35000\"}]', '[{\"account\":\"11\",\"amount\":\"35000\"}]', 'Create new Product with beginning balance.', 'product:210'),
(229, '+256-759912814', 1760780089, '+256-759912814', 'Published', '1760780089', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-18 09:34:49', '[{\"account\":\"10\",\"amount\":119000}]', '[{\"account\":\"11\",\"amount\":119000}]', 'Adjust stock: opening balance stock item', 'product:209'),
(230, '+256-759912814', 1760780142, '+256-759912814', 'Published', '1760780142', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:35:42', '[{\"account\":\"10\",\"amount\":\"17000\"}]', '[{\"account\":\"11\",\"amount\":\"17000\"}]', 'Create new Product with beginning balance.', 'product:211'),
(231, '+256-759912814', 1760780195, '+256-759912814', 'Published', '1760780195', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:36:35', '[{\"account\":\"10\",\"amount\":\"26000\"}]', '[{\"account\":\"11\",\"amount\":\"26000\"}]', 'Create new Product with beginning balance.', 'product:212'),
(232, '+256-759912814', 1760780236, '+256-759912814', 'Published', '1760780236', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:37:16', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:213'),
(233, '+256-759912814', 1760780291, '+256-759912814', 'Published', '1760780291', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:38:11', '[{\"account\":\"10\",\"amount\":\"21500\"}]', '[{\"account\":\"11\",\"amount\":\"21500\"}]', 'Create new Product with beginning balance.', 'product:214'),
(234, '+256-759912814', 1760780334, '+256-759912814', 'Published', '1760780334', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:38:54', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:215'),
(235, '+256-759912814', 1760780384, '+256-759912814', 'Published', '1760780384', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:39:44', '[{\"account\":\"10\",\"amount\":\"25500\"}]', '[{\"account\":\"11\",\"amount\":\"25500\"}]', 'Create new Product with beginning balance.', 'product:216'),
(236, '+256-759912814', 1760780428, '+256-759912814', 'Published', '1760780428', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:40:28', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:217'),
(237, '+256-759912814', 1760780466, '+256-759912814', 'Published', '1760780466', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:41:06', '[{\"account\":\"10\",\"amount\":\"33000\"}]', '[{\"account\":\"11\",\"amount\":\"33000\"}]', 'Create new Product with beginning balance.', 'product:218'),
(238, '+256-759912814', 1760780520, '+256-759912814', 'Published', '1760780520', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:42:00', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:219'),
(239, '+256-759912814', 1760780574, '+256-759912814', 'Published', '1760780574', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:42:54', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:220'),
(240, '+256-759912814', 1760780618, '+256-759912814', 'Published', '1760780618', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:43:38', '[{\"account\":\"10\",\"amount\":\"84000\"}]', '[{\"account\":\"11\",\"amount\":\"84000\"}]', 'Create new Product with beginning balance.', 'product:221'),
(241, '+256-759912814', 1760780659, '+256-759912814', 'Published', '1760780659', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:44:19', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:222'),
(242, '+256-759912814', 1760780700, '+256-759912814', 'Published', '1760780700', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:45:00', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:223'),
(243, '+256-759912814', 1760780738, '+256-759912814', 'Published', '1760780738', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:45:38', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:224'),
(244, '+256-759912814', 1760780801, '+256-759912814', 'Published', '1760780801', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:46:41', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:225'),
(245, '+256-759912814', 1760780870, '+256-759912814', 'Published', '1760780870', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:47:50', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:226'),
(246, '+256-759912814', 1760780924, '+256-759912814', 'Published', '1760780924', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:48:44', '[{\"account\":\"10\",\"amount\":\"570000\"}]', '[{\"account\":\"11\",\"amount\":\"570000\"}]', 'Create new Product with beginning balance.', 'product:227'),
(247, '+256-759912814', 1760780965, '+256-759912814', 'Published', '1760780965', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:49:25', '[{\"account\":\"10\",\"amount\":\"11000\"}]', '[{\"account\":\"11\",\"amount\":\"11000\"}]', 'Create new Product with beginning balance.', 'product:228'),
(248, '+256-759912814', 1760781001, '+256-759912814', 'Published', '1760781001', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:50:01', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:229'),
(249, '+256-759912814', 1760781052, '+256-759912814', 'Published', '1760781052', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:50:52', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:230'),
(250, '+256-759912814', 1760781114, '+256-759912814', 'Published', '1760781114', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:51:54', '[{\"account\":\"10\",\"amount\":\"37500\"}]', '[{\"account\":\"11\",\"amount\":\"37500\"}]', 'Create new Product with beginning balance.', 'product:231'),
(251, '+256-759912814', 1760781150, '+256-759912814', 'Published', '1760781150', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:52:30', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:232'),
(252, '+256-759912814', 1760781181, '+256-759912814', 'Published', '1760781181', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:53:01', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:233'),
(253, '+256-759912814', 1760781211, '+256-759912814', 'Published', '1760781211', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:53:31', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:234'),
(254, '+256-759912814', 1760781240, '+256-759912814', 'Published', '1760781240', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:54:00', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:235'),
(255, '+256-759912814', 1760781277, '+256-759912814', 'Published', '1760781277', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-18 09:54:37', '[{\"account\":\"10\",\"amount\":240000}]', '[{\"account\":\"11\",\"amount\":240000}]', 'Adjust stock: opening balance stock item', 'product:189'),
(256, '+256-759912814', 1760781338, '+256-759912814', 'Published', '1760781338', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:55:38', '[{\"account\":\"10\",\"amount\":\"72000\"}]', '[{\"account\":\"11\",\"amount\":\"72000\"}]', 'Create new Product with beginning balance.', 'product:236'),
(257, '+256-759912814', 1760781418, '+256-759912814', 'Published', '1760781418', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:56:58', '[{\"account\":\"10\",\"amount\":\"252000\"}]', '[{\"account\":\"11\",\"amount\":\"252000\"}]', 'Create new Product with beginning balance.', 'product:237'),
(258, '+256-759912814', 1760781523, '+256-759912814', 'Published', '1760781523', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:58:43', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:238'),
(259, '+256-759912814', 1760781586, '+256-759912814', 'Published', '1760781586', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 09:59:46', '[{\"account\":\"10\",\"amount\":\"216000\"}]', '[{\"account\":\"11\",\"amount\":\"216000\"}]', 'Create new Product with beginning balance.', 'product:239'),
(260, '+256-759912814', 1760781627, '+256-759912814', 'Published', '1760781627', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 10:00:27', '[{\"account\":\"10\",\"amount\":\"79500\"}]', '[{\"account\":\"11\",\"amount\":\"79500\"}]', 'Create new Product with beginning balance.', 'product:240'),
(261, '+256-759912814', 1760781726, '+256-759912814', 'Published', '1760781726', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-18 10:02:06', '[{\"account\":\"10\",\"amount\":912000}]', '[{\"account\":\"11\",\"amount\":912000}]', 'Adjust stock: opening balance stock item', 'product:194'),
(262, '+256-759912814', 1760781782, '+256-759912814', 'Published', '1760781782', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 10:03:02', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:241'),
(263, '+256-759912814', 1760781914, '+256-759912814', 'Published', '1760781914', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 10:05:14', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:242'),
(264, '+256-759912814', 1760782543, '+256-759912814', 'Published', '1760782543', NULL, '---', 'Create new Product with beginning balance.', '2025-10-18 10:15:43', '[{\"account\":\"10\",\"amount\":\"24000\"}]', '[{\"account\":\"11\",\"amount\":\"24000\"}]', 'Create new Product with beginning balance.', 'product:243'),
(265, '+256-759912814', 1760867127, '+256-759912814', 'Published', '1760867127', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 09:45:27', '[{\"account\":\"10\",\"amount\":\"45000\"}]', '[{\"account\":\"11\",\"amount\":\"45000\"}]', 'Create new Product with beginning balance.', 'product:244'),
(266, '+256-759912814', 1760867196, '+256-759912814', 'Published', '1760867196', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 09:46:36', '[{\"account\":\"10\",\"amount\":\"50000\"}]', '[{\"account\":\"11\",\"amount\":\"50000\"}]', 'Create new Product with beginning balance.', 'product:245'),
(267, '+256-759912814', 1760867263, '+256-759912814', 'Published', '1760867263', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-19 09:47:43', '[{\"account\":\"10\",\"amount\":33000}]', '[{\"account\":\"11\",\"amount\":33000}]', 'Adjust stock: opening balance stock item', 'product:213'),
(268, '+256-759912814', 1760867385, '+256-759912814', 'Published', '1760867385', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 09:49:45', '[{\"account\":\"10\",\"amount\":\"2000\"}]', '[{\"account\":\"11\",\"amount\":\"2000\"}]', 'Create new Product with beginning balance.', 'product:246'),
(269, '+256-759912814', 1760867466, '+256-759912814', 'Published', '1760867466', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 09:51:06', '[{\"account\":\"10\",\"amount\":\"21000\"}]', '[{\"account\":\"11\",\"amount\":\"21000\"}]', 'Create new Product with beginning balance.', 'product:247'),
(270, '+256-759912814', 1760867487, '+256-759912814', 'Published', '1760867487', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-19 09:51:27', '[{\"account\":\"10\",\"amount\":2000}]', '[{\"account\":\"11\",\"amount\":2000}]', 'Adjust stock: opening balance stock item', 'product:246'),
(271, '+256-759912814', 1760867616, '+256-759912814', 'Published', '1760867616', NULL, '---', 'Adjust stock: Lost stock item.', '2025-10-19 09:53:36', '[{\"account\":\"11\",\"amount\":28000}]', '[{\"account\":\"2\",\"amount\":28000}]', 'Adjust stock: Lost stock item.', 'product:245'),
(272, '+256-759912814', 1760867669, '+256-759912814', 'Published', '1760867669', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 09:54:29', '[{\"account\":\"10\",\"amount\":\"25000\"}]', '[{\"account\":\"11\",\"amount\":\"25000\"}]', 'Create new Product with beginning balance.', 'product:248'),
(273, '+256-759912814', 1760867763, '+256-759912814', 'Published', '1760867763', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 09:56:03', '[{\"account\":\"10\",\"amount\":\"50000\"}]', '[{\"account\":\"11\",\"amount\":\"50000\"}]', 'Create new Product with beginning balance.', 'product:249'),
(274, '+256-759912814', 1760867835, '+256-759912814', 'Published', '1760867835', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 09:57:15', '[{\"account\":\"10\",\"amount\":\"50000\"}]', '[{\"account\":\"11\",\"amount\":\"50000\"}]', 'Create new Product with beginning balance.', 'product:250'),
(275, '+256-759912814', 1760867979, '+256-759912814', 'Published', '1760867979', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 09:59:39', '[{\"account\":\"10\",\"amount\":\"342000\"}]', '[{\"account\":\"11\",\"amount\":\"342000\"}]', 'Create new Product with beginning balance.', 'product:251'),
(276, '+256-759912814', 1760867979, '+256-759912814', 'Published', '1760867979', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 09:59:39', '[{\"account\":\"10\",\"amount\":\"342000\"}]', '[{\"account\":\"11\",\"amount\":\"342000\"}]', 'Create new Product with beginning balance.', 'product:252'),
(277, '+256-759912814', 1760868174, '+256-759912814', 'Published', '1760868174', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:02:54', '[{\"account\":\"10\",\"amount\":\"201600\"}]', '[{\"account\":\"11\",\"amount\":\"201600\"}]', 'Create new Product with beginning balance.', 'product:253'),
(278, '+256-759912814', 1760868212, '+256-759912814', 'Published', '1760868212', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:03:32', '[{\"account\":\"10\",\"amount\":\"85000\"}]', '[{\"account\":\"11\",\"amount\":\"85000\"}]', 'Create new Product with beginning balance.', 'product:254'),
(279, '+256-759912814', 1760868273, '+256-759912814', 'Published', '1760868273', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:04:33', '[{\"account\":\"10\",\"amount\":\"125000\"}]', '[{\"account\":\"11\",\"amount\":\"125000\"}]', 'Create new Product with beginning balance.', 'product:255'),
(280, '+256-759912814', 1760868327, '+256-759912814', 'Published', '1760868327', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:05:27', '[{\"account\":\"10\",\"amount\":\"12500\"}]', '[{\"account\":\"11\",\"amount\":\"12500\"}]', 'Create new Product with beginning balance.', 'product:256'),
(281, '+256-759912814', 1760868425, '+256-759912814', 'Published', '1760868425', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:07:05', '[{\"account\":\"10\",\"amount\":\"42000\"}]', '[{\"account\":\"11\",\"amount\":\"42000\"}]', 'Create new Product with beginning balance.', 'product:257'),
(282, '+256-759912814', 1760868462, '+256-759912814', 'Published', '1760868462', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:07:42', '[{\"account\":\"10\",\"amount\":\"34000\"}]', '[{\"account\":\"11\",\"amount\":\"34000\"}]', 'Create new Product with beginning balance.', 'product:258'),
(283, '+256-759912814', 1760868501, '+256-759912814', 'Published', '1760868501', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:08:21', '[{\"account\":\"10\",\"amount\":\"2000\"}]', '[{\"account\":\"11\",\"amount\":\"2000\"}]', 'Create new Product with beginning balance.', 'product:259'),
(284, '+256-759912814', 1760868601, '+256-759912814', 'Published', '1760868601', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-19 10:10:01', '[{\"account\":\"10\",\"amount\":38000}]', '[{\"account\":\"11\",\"amount\":38000}]', 'Adjust stock: opening balance stock item', 'product:257'),
(285, '+256-759912814', 1760868683, '+256-759912814', 'Published', '1760868683', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:11:23', '[{\"account\":\"10\",\"amount\":\"850\"}]', '[{\"account\":\"11\",\"amount\":\"850\"}]', 'Create new Product with beginning balance.', 'product:260'),
(286, '+256-759912814', 1760869583, '+256-759912814', 'Published', '1760869583', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:26:23', '[{\"account\":\"10\",\"amount\":\"483000\"}]', '[{\"account\":\"11\",\"amount\":\"483000\"}]', 'Create new Product with beginning balance.', 'product:261'),
(287, '+256-759912814', 1760869630, '+256-759912814', 'Published', '1760869630', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:27:10', '[{\"account\":\"10\",\"amount\":\"41400\"}]', '[{\"account\":\"11\",\"amount\":\"41400\"}]', 'Create new Product with beginning balance.', 'product:262'),
(288, '+256-759912814', 1760869716, '+256-759912814', 'Published', '1760869716', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:28:36', '[{\"account\":\"10\",\"amount\":\"54000\"}]', '[{\"account\":\"11\",\"amount\":\"54000\"}]', 'Create new Product with beginning balance.', 'product:263'),
(289, '+256-759912814', 1760869752, '+256-759912814', 'Published', '1760869752', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:29:12', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:264'),
(290, '+256-759912814', 1760869931, '+256-759912814', 'Published', '1760869931', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:32:11', '[{\"account\":\"10\",\"amount\":\"86000\"}]', '[{\"account\":\"11\",\"amount\":\"86000\"}]', 'Create new Product with beginning balance.', 'product:265'),
(291, '+256-759912814', 1760869994, '+256-759912814', 'Published', '1760869994', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:33:14', '[{\"account\":\"10\",\"amount\":\"32000\"}]', '[{\"account\":\"11\",\"amount\":\"32000\"}]', 'Create new Product with beginning balance.', 'product:266'),
(292, '+256-759912814', 1760870047, '+256-759912814', 'Published', '1760870047', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:34:07', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:267'),
(293, '+256-759912814', 1760870118, '+256-759912814', 'Published', '1760870118', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-19 10:35:18', '[{\"account\":\"10\",\"amount\":36000}]', '[{\"account\":\"11\",\"amount\":36000}]', 'Adjust stock: opening balance stock item', 'product:267'),
(294, '+256-759912814', 1760870214, '+256-759912814', 'Published', '1760870214', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:36:54', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:268'),
(295, '+256-759912814', 1760870288, '+256-759912814', 'Published', '1760870288', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:38:08', '[{\"account\":\"10\",\"amount\":\"54000\"}]', '[{\"account\":\"11\",\"amount\":\"54000\"}]', 'Create new Product with beginning balance.', 'product:269'),
(296, '+256-759912814', 1760870357, '+256-759912814', 'Published', '1760870357', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:39:17', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:270'),
(297, '+256-759912814', 1760870502, '+256-759912814', 'Published', '1760870502', NULL, '---', 'Create new Product with beginning balance.', '2025-10-19 10:41:42', '[{\"account\":\"10\",\"amount\":\"117500\"}]', '[{\"account\":\"11\",\"amount\":\"117500\"}]', 'Create new Product with beginning balance.', 'product:271'),
(298, '+256-759912814', 1760974742, '+256-759912814', 'Published', '1760974742', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:39:02', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:272'),
(299, '+256-759912814', 1760974855, '+256-759912814', 'Published', '1760974855', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:40:55', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:273'),
(300, '+256-759912814', 1760974900, '+256-759912814', 'Published', '1760974900', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:41:40', '[{\"account\":\"10\",\"amount\":\"27000\"}]', '[{\"account\":\"11\",\"amount\":\"27000\"}]', 'Create new Product with beginning balance.', 'product:274'),
(301, '+256-759912814', 1760974942, '+256-759912814', 'Published', '1760974942', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:42:22', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:275'),
(302, '+256-759912814', 1760975126, '+256-759912814', 'Published', '1760975126', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:45:26', '[{\"account\":\"10\",\"amount\":\"50000\"}]', '[{\"account\":\"11\",\"amount\":\"50000\"}]', 'Create new Product with beginning balance.', 'product:276'),
(303, '+256-759912814', 1760975191, '+256-759912814', 'Published', '1760975191', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:46:31', '[{\"account\":\"10\",\"amount\":\"150000\"}]', '[{\"account\":\"11\",\"amount\":\"150000\"}]', 'Create new Product with beginning balance.', 'product:277'),
(304, '+256-759912814', 1760975240, '+256-759912814', 'Published', '1760975240', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:47:20', '[{\"account\":\"10\",\"amount\":\"182000\"}]', '[{\"account\":\"11\",\"amount\":\"182000\"}]', 'Create new Product with beginning balance.', 'product:278'),
(305, '+256-759912814', 1760975363, '+256-759912814', 'Published', '1760975363', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:49:23', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:279'),
(306, '+256-759912814', 1760975364, '+256-759912814', 'Published', '1760975364', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:49:24', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:280'),
(307, '+256-759912814', 1760975411, '+256-759912814', 'Published', '1760975411', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:50:11', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:281'),
(308, '+256-759912814', 1760975453, '+256-759912814', 'Published', '1760975453', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:50:53', '[{\"account\":\"10\",\"amount\":\"79900\"}]', '[{\"account\":\"11\",\"amount\":\"79900\"}]', 'Create new Product with beginning balance.', 'product:282'),
(309, '+256-759912814', 1760975503, '+256-759912814', 'Published', '1760975503', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:51:43', '[{\"account\":\"10\",\"amount\":\"90000\"}]', '[{\"account\":\"11\",\"amount\":\"90000\"}]', 'Create new Product with beginning balance.', 'product:283'),
(310, '+256-759912814', 1760975546, '+256-759912814', 'Published', '1760975546', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:52:26', '[{\"account\":\"10\",\"amount\":\"150000\"}]', '[{\"account\":\"11\",\"amount\":\"150000\"}]', 'Create new Product with beginning balance.', 'product:284'),
(311, '+256-759912814', 1760975588, '+256-759912814', 'Published', '1760975588', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:53:08', '[{\"account\":\"10\",\"amount\":\"76000\"}]', '[{\"account\":\"11\",\"amount\":\"76000\"}]', 'Create new Product with beginning balance.', 'product:285'),
(312, '+256-759912814', 1760975667, '+256-759912814', 'Published', '1760975667', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:54:27', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:286'),
(313, '+256-759912814', 1760975732, '+256-759912814', 'Published', '1760975732', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:55:32', '[{\"account\":\"10\",\"amount\":\"553800\"}]', '[{\"account\":\"11\",\"amount\":\"553800\"}]', 'Create new Product with beginning balance.', 'product:287'),
(314, '+256-759912814', 1760975830, '+256-759912814', 'Published', '1760975830', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:57:10', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:288'),
(315, '+256-759912814', 1760975909, '+256-759912814', 'Published', '1760975909', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:58:29', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:289'),
(316, '+256-759912814', 1760975957, '+256-759912814', 'Published', '1760975957', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 15:59:17', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:290'),
(317, '+256-759912814', 1760976021, '+256-759912814', 'Published', '1760976021', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 16:00:21', '[{\"account\":\"10\",\"amount\":\"76000\"}]', '[{\"account\":\"11\",\"amount\":\"76000\"}]', 'Create new Product with beginning balance.', 'product:291');
INSERT INTO `journal` (`id`, `owner_mobile`, `timestamp`, `added_by`, `status`, `last_updated`, `sync`, `---`, `description`, `date_time`, `credit_json`, `debit_json`, `entry_type`, `entry_link`) VALUES
(318, '+256-759912814', 1760976099, '+256-759912814', 'Published', '1760976099', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 16:01:39', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:292'),
(319, '+256-759912814', 1760976152, '+256-759912814', 'Published', '1760976152', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 16:02:32', '[{\"account\":\"10\",\"amount\":\"68000\"}]', '[{\"account\":\"11\",\"amount\":\"68000\"}]', 'Create new Product with beginning balance.', 'product:293'),
(320, '+256-759912814', 1760976213, '+256-759912814', 'Published', '1760976213', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 16:03:33', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:294'),
(321, '+256-759912814', 1760976257, '+256-759912814', 'Published', '1760976257', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 16:04:17', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:295'),
(322, '+256-759912814', 1760976342, '+256-759912814', 'Published', '1760976342', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 16:05:42', '[{\"account\":\"10\",\"amount\":\"30000\"}]', '[{\"account\":\"11\",\"amount\":\"30000\"}]', 'Create new Product with beginning balance.', 'product:296'),
(323, '+256-759912814', 1760976396, '+256-759912814', 'Published', '1760976396', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-20 16:06:36', '[{\"account\":\"10\",\"amount\":10000}]', '[{\"account\":\"11\",\"amount\":10000}]', 'Adjust stock: opening balance stock item', 'product:290'),
(324, '+256-759912814', 1760976518, '+256-759912814', 'Published', '1760976518', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 16:08:38', '[{\"account\":\"10\",\"amount\":\"55000\"}]', '[{\"account\":\"11\",\"amount\":\"55000\"}]', 'Create new Product with beginning balance.', 'product:297'),
(325, '+256-759912814', 1760976975, '+256-759912814', 'Published', '1760976975', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 16:16:15', '[{\"account\":\"10\",\"amount\":\"84000\"}]', '[{\"account\":\"11\",\"amount\":\"84000\"}]', 'Create new Product with beginning balance.', 'product:298'),
(326, '+256-759912814', 1760977062, '+256-759912814', 'Published', '1760977062', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 16:17:42', '[{\"account\":\"10\",\"amount\":\"3000\"}]', '[{\"account\":\"11\",\"amount\":\"3000\"}]', 'Create new Product with beginning balance.', 'product:299'),
(327, '+256-759912814', 1760977145, '+256-759912814', 'Published', '1760977145', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 16:19:05', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:300'),
(328, '+256-759912814', 1760977427, '+256-759912814', 'Published', '1760977427', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 16:23:47', '[{\"account\":\"10\",\"amount\":\"135000\"}]', '[{\"account\":\"11\",\"amount\":\"135000\"}]', 'Create new Product with beginning balance.', 'product:301'),
(329, '+256-759912814', 1760977474, '+256-759912814', 'Published', '1760977474', NULL, '---', 'Create new Product with beginning balance.', '2025-10-20 16:24:34', '[{\"account\":\"10\",\"amount\":\"170000\"}]', '[{\"account\":\"11\",\"amount\":\"170000\"}]', 'Create new Product with beginning balance.', 'product:302'),
(330, '+256-759912814', 1761037680, '+256-759912814', 'Published', '1761037680', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:08:00', '[{\"account\":\"10\",\"amount\":\"22400\"}]', '[{\"account\":\"11\",\"amount\":\"22400\"}]', 'Create new Product with beginning balance.', 'product:303'),
(331, '+256-759912814', 1761037815, '+256-759912814', 'Published', '1761037815', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:10:15', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:304'),
(332, '+256-759912814', 1761037933, '+256-759912814', 'Published', '1761037933', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:12:13', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:305'),
(333, '+256-759912814', 1761038043, '+256-759912814', 'Published', '1761038043', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:14:03', '[{\"account\":\"10\",\"amount\":\"180000\"}]', '[{\"account\":\"11\",\"amount\":\"180000\"}]', 'Create new Product with beginning balance.', 'product:306'),
(334, '+256-759912814', 1761038098, '+256-759912814', 'Published', '1761038098', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:14:58', '[{\"account\":\"10\",\"amount\":\"325000\"}]', '[{\"account\":\"11\",\"amount\":\"325000\"}]', 'Create new Product with beginning balance.', 'product:307'),
(335, '+256-759912814', 1761038141, '+256-759912814', 'Published', '1761038141', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:15:41', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:308'),
(336, '+256-759912814', 1761038197, '+256-759912814', 'Published', '1761038197', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:16:37', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:309'),
(337, '+256-759912814', 1761038318, '+256-759912814', 'Published', '1761038318', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:18:38', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:310'),
(338, '+256-759912814', 1761038379, '+256-759912814', 'Published', '1761038379', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:19:39', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:311'),
(339, '+256-759912814', 1761038500, '+256-759912814', 'Published', '1761038500', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:21:40', '[{\"account\":\"10\",\"amount\":\"200000\"}]', '[{\"account\":\"11\",\"amount\":\"200000\"}]', 'Create new Product with beginning balance.', 'product:312'),
(340, '+256-759912814', 1761038547, '+256-759912814', 'Published', '1761038547', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:22:27', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:313'),
(341, '+256-759912814', 1761038614, '+256-759912814', 'Published', '1761038614', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:23:34', '[{\"account\":\"10\",\"amount\":\"48000\"}]', '[{\"account\":\"11\",\"amount\":\"48000\"}]', 'Create new Product with beginning balance.', 'product:314'),
(342, '+256-759912814', 1761038667, '+256-759912814', 'Published', '1761038667', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:24:27', '[{\"account\":\"10\",\"amount\":\"80000\"}]', '[{\"account\":\"11\",\"amount\":\"80000\"}]', 'Create new Product with beginning balance.', 'product:315'),
(343, '+256-759912814', 1761038711, '+256-759912814', 'Published', '1761038711', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:25:11', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:316'),
(344, '+256-759912814', 1761038784, '+256-759912814', 'Published', '1761038784', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:26:24', '[{\"account\":\"10\",\"amount\":\"168000\"}]', '[{\"account\":\"11\",\"amount\":\"168000\"}]', 'Create new Product with beginning balance.', 'product:317'),
(345, '+256-759912814', 1761038882, '+256-759912814', 'Published', '1761038882', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:28:02', '[{\"account\":\"10\",\"amount\":\"604500\"}]', '[{\"account\":\"11\",\"amount\":\"604500\"}]', 'Create new Product with beginning balance.', 'product:318'),
(346, '+256-759912814', 1761038932, '+256-759912814', 'Published', '1761038932', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:28:52', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:319'),
(347, '+256-759912814', 1761038973, '+256-759912814', 'Published', '1761038973', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:29:33', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:320'),
(348, '+256-759912814', 1761039034, '+256-759912814', 'Published', '1761039034', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:30:34', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:321'),
(349, '+256-759912814', 1761039113, '+256-759912814', 'Published', '1761039113', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:31:53', '[{\"account\":\"10\",\"amount\":\"9000\"}]', '[{\"account\":\"11\",\"amount\":\"9000\"}]', 'Create new Product with beginning balance.', 'product:322'),
(350, '+256-759912814', 1761039183, '+256-759912814', 'Published', '1761039183', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:33:03', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:323'),
(351, '+256-759912814', 1761039238, '+256-759912814', 'Published', '1761039238', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:33:58', '[{\"account\":\"10\",\"amount\":\"43700\"}]', '[{\"account\":\"11\",\"amount\":\"43700\"}]', 'Create new Product with beginning balance.', 'product:324'),
(352, '+256-759912814', 1761039702, '+256-759912814', 'Published', '1761039702', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:41:42', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:325'),
(353, '+256-759912814', 1761039781, '+256-759912814', 'Published', '1761039781', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:43:01', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:326'),
(354, '+256-759912814', 1761039833, '+256-759912814', 'Published', '1761039833', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:43:53', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:327'),
(355, '+256-759912814', 1761039910, '+256-759912814', 'Published', '1761039910', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:45:10', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:328'),
(356, '+256-759912814', 1761039958, '+256-759912814', 'Published', '1761039958', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:45:58', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:329'),
(357, '+256-759912814', 1761040049, '+256-759912814', 'Published', '1761040049', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:47:29', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:330'),
(358, '+256-759912814', 1761040098, '+256-759912814', 'Published', '1761040098', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:48:18', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:331'),
(359, '+256-759912814', 1761040155, '+256-759912814', 'Published', '1761040155', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:49:15', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:332'),
(360, '+256-759912814', 1761040210, '+256-759912814', 'Published', '1761040210', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:50:10', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:333'),
(361, '+256-759912814', 1761040214, '+256-759912814', 'Published', '1761040214', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:50:14', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:334'),
(362, '+256-759912814', 1761040298, '+256-759912814', 'Published', '1761040298', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:51:38', '[{\"account\":\"10\",\"amount\":\"18000\"}]', '[{\"account\":\"11\",\"amount\":\"18000\"}]', 'Create new Product with beginning balance.', 'product:335'),
(363, '+256-759912814', 1761040331, '+256-759912814', 'Published', '1761040331', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:52:11', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:336'),
(364, '+256-759912814', 1761040447, '+256-759912814', 'Published', '1761040447', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:54:07', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:337'),
(365, '+256-759912814', 1761040555, '+256-759912814', 'Published', '1761040555', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:55:55', '[{\"account\":\"10\",\"amount\":\"1338\"}]', '[{\"account\":\"11\",\"amount\":\"1338\"}]', 'Create new Product with beginning balance.', 'product:338'),
(366, '+256-759912814', 1761040599, '+256-759912814', 'Published', '1761040599', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:56:39', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:339'),
(367, '+256-759912814', 1761040639, '+256-759912814', 'Published', '1761040639', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:57:19', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:340'),
(368, '+256-759912814', 1761040675, '+256-759912814', 'Published', '1761040675', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:57:55', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:341'),
(369, '+256-759912814', 1761040727, '+256-759912814', 'Published', '1761040727', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:58:47', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:342'),
(370, '+256-759912814', 1761040797, '+256-759912814', 'Published', '1761040797', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 09:59:57', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:343'),
(371, '+256-759912814', 1761040861, '+256-759912814', 'Published', '1761040861', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:01:01', '[{\"account\":\"10\",\"amount\":\"392000\"}]', '[{\"account\":\"11\",\"amount\":\"392000\"}]', 'Create new Product with beginning balance.', 'product:344'),
(372, '+256-759912814', 1761040978, '+256-759912814', 'Published', '1761040978', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:02:58', '[{\"account\":\"10\",\"amount\":\"2500\"}]', '[{\"account\":\"11\",\"amount\":\"2500\"}]', 'Create new Product with beginning balance.', 'product:345'),
(373, '+256-759912814', 1761041019, '+256-759912814', 'Published', '1761041019', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:03:39', '[{\"account\":\"10\",\"amount\":\"4000\"}]', '[{\"account\":\"11\",\"amount\":\"4000\"}]', 'Create new Product with beginning balance.', 'product:346'),
(374, '+256-759912814', 1761041087, '+256-759912814', 'Published', '1761041087', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:04:47', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:347'),
(375, '+256-759912814', 1761041126, '+256-759912814', 'Published', '1761041126', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:05:26', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:348'),
(376, '+256-759912814', 1761041197, '+256-759912814', 'Published', '1761041197', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:06:37', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:349'),
(377, '+256-759912814', 1761041268, '+256-759912814', 'Published', '1761041268', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:07:48', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:350'),
(378, '+256-759912814', 1761041346, '+256-759912814', 'Published', '1761041346', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:09:06', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:351'),
(379, '+256-759912814', 1761041347, '+256-759912814', 'Published', '1761041347', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:09:07', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:352'),
(380, '+256-759912814', 1761041514, '+256-759912814', 'Published', '1761041514', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:11:54', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:353'),
(381, '+256-759912814', 1761041574, '+256-759912814', 'Published', '1761041574', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:12:54', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:354'),
(382, '+256-759912814', 1761041678, '+256-759912814', 'Published', '1761041678', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:14:38', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:355'),
(383, '+256-759912814', 1761041729, '+256-759912814', 'Published', '1761041729', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:15:29', '[{\"account\":\"10\",\"amount\":\"84000\"}]', '[{\"account\":\"11\",\"amount\":\"84000\"}]', 'Create new Product with beginning balance.', 'product:356'),
(384, '+256-759912814', 1761041767, '+256-759912814', 'Published', '1761041767', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:16:07', '[{\"account\":\"10\",\"amount\":\"49800\"}]', '[{\"account\":\"11\",\"amount\":\"49800\"}]', 'Create new Product with beginning balance.', 'product:357'),
(385, '+256-759912814', 1761041811, '+256-759912814', 'Published', '1761041811', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:16:51', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:358'),
(386, '+256-759912814', 1761041910, '+256-759912814', 'Published', '1761041910', NULL, '---', 'Adjust stock: opening balance stock item', '2025-10-21 10:18:30', '[{\"account\":\"10\",\"amount\":147000}]', '[{\"account\":\"11\",\"amount\":147000}]', 'Adjust stock: opening balance stock item', 'product:354'),
(387, '+256-759912814', 1761041971, '+256-759912814', 'Published', '1761041971', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:19:31', '[{\"account\":\"10\",\"amount\":\"8000\"}]', '[{\"account\":\"11\",\"amount\":\"8000\"}]', 'Create new Product with beginning balance.', 'product:359'),
(388, '+256-759912814', 1761042019, '+256-759912814', 'Published', '1761042019', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:20:19', '[{\"account\":\"10\",\"amount\":\"94500\"}]', '[{\"account\":\"11\",\"amount\":\"94500\"}]', 'Create new Product with beginning balance.', 'product:360'),
(389, '+256-759912814', 1761042060, '+256-759912814', 'Published', '1761042060', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:21:00', '[{\"account\":\"10\",\"amount\":\"8000\"}]', '[{\"account\":\"11\",\"amount\":\"8000\"}]', 'Create new Product with beginning balance.', 'product:361'),
(390, '+256-759912814', 1761042104, '+256-759912814', 'Published', '1761042104', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:21:44', '[{\"account\":\"10\",\"amount\":\"72000\"}]', '[{\"account\":\"11\",\"amount\":\"72000\"}]', 'Create new Product with beginning balance.', 'product:362'),
(391, '+256-759912814', 1761042143, '+256-759912814', 'Published', '1761042143', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:22:23', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:363'),
(392, '+256-759912814', 1761042190, '+256-759912814', 'Published', '1761042190', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:23:10', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:364'),
(393, '+256-759912814', 1761042235, '+256-759912814', 'Published', '1761042235', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:23:55', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:365'),
(394, '+256-759912814', 1761042671, '+256-759912814', 'Published', '1761042671', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:31:11', '[{\"account\":\"10\",\"amount\":\"273700\"}]', '[{\"account\":\"11\",\"amount\":\"273700\"}]', 'Create new Product with beginning balance.', 'product:366'),
(395, '+256-759912814', 1761042736, '+256-759912814', 'Published', '1761042736', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:32:16', '[{\"account\":\"10\",\"amount\":\"22800\"}]', '[{\"account\":\"11\",\"amount\":\"22800\"}]', 'Create new Product with beginning balance.', 'product:367'),
(396, '+256-759912814', 1761042781, '+256-759912814', 'Published', '1761042781', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:33:01', '[{\"account\":\"10\",\"amount\":\"10800\"}]', '[{\"account\":\"11\",\"amount\":\"10800\"}]', 'Create new Product with beginning balance.', 'product:368'),
(397, '+256-759912814', 1761042818, '+256-759912814', 'Published', '1761042818', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:33:38', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:369'),
(398, '+256-759912814', 1761042869, '+256-759912814', 'Published', '1761042869', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:34:29', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:370'),
(399, '+256-759912814', 1761042947, '+256-759912814', 'Published', '1761042947', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:35:47', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:371'),
(400, '+256-759912814', 1761042996, '+256-759912814', 'Published', '1761042996', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:36:36', '[{\"account\":\"10\",\"amount\":\"11000\"}]', '[{\"account\":\"11\",\"amount\":\"11000\"}]', 'Create new Product with beginning balance.', 'product:372'),
(401, '+256-759912814', 1761043045, '+256-759912814', 'Published', '1761043045', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:37:25', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:373'),
(402, '+256-759912814', 1761043116, '+256-759912814', 'Published', '1761043116', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:38:36', '[{\"account\":\"10\",\"amount\":\"2000\"}]', '[{\"account\":\"11\",\"amount\":\"2000\"}]', 'Create new Product with beginning balance.', 'product:374'),
(403, '+256-759912814', 1761043181, '+256-759912814', 'Published', '1761043181', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:39:41', '[{\"account\":\"10\",\"amount\":\"408000\"}]', '[{\"account\":\"11\",\"amount\":\"408000\"}]', 'Create new Product with beginning balance.', 'product:375'),
(404, '+256-759912814', 1761043217, '+256-759912814', 'Published', '1761043217', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:40:17', '[{\"account\":\"10\",\"amount\":\"19800\"}]', '[{\"account\":\"11\",\"amount\":\"19800\"}]', 'Create new Product with beginning balance.', 'product:376'),
(405, '+256-759912814', 1761043256, '+256-759912814', 'Published', '1761043256', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:40:56', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:377'),
(406, '+256-759912814', 1761043293, '+256-759912814', 'Published', '1761043293', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:41:33', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:378'),
(407, '+256-759912814', 1761043355, '+256-759912814', 'Published', '1761043355', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:42:35', '[{\"account\":\"10\",\"amount\":\"78000\"}]', '[{\"account\":\"11\",\"amount\":\"78000\"}]', 'Create new Product with beginning balance.', 'product:379'),
(408, '+256-759912814', 1761043424, '+256-759912814', 'Published', '1761043424', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:43:44', '[{\"account\":\"10\",\"amount\":\"3000\"}]', '[{\"account\":\"11\",\"amount\":\"3000\"}]', 'Create new Product with beginning balance.', 'product:380'),
(409, '+256-759912814', 1761043480, '+256-759912814', 'Published', '1761043480', NULL, '---', 'Create new Product with beginning balance.', '2025-10-21 10:44:40', '[{\"account\":\"10\",\"amount\":\"31350\"}]', '[{\"account\":\"11\",\"amount\":\"31350\"}]', 'Create new Product with beginning balance.', 'product:381'),
(410, '+256-759912814', 1761213772, '+256-759912814', 'Published', '1761213772', NULL, '---', 'Create new Product with beginning balance.', '2025-10-23 10:02:52', '[{\"account\":\"10\",\"amount\":\"54000\"}]', '[{\"account\":\"11\",\"amount\":\"54000\"}]', 'Create new Product with beginning balance.', 'product:382'),
(411, '+92-3335672555', 1761650333, '+92-3335672555', 'Published', '1761650333', NULL, '---', 'Create new Contact with beginning balance.', '2025-10-28 11:18:53', '[{\"account\":\"c+73-1\",\"amount\":\"200\"}]', '[{\"account\":\"43\",\"amount\":\"200\"}]', 'Create new Contact with beginning balance.', 'contactid:+73-1'),
(412, '+92-3335672555', 1761650369, '+92-3335672555', 'Published', '1761650369', NULL, '---', 'Create new Contact with beginning balance.', '2025-10-28 11:19:29', '[{\"account\":\"c+13-0\",\"amount\":\"100\"}]', '[{\"account\":\"43\",\"amount\":\"100\"}]', 'Create new Contact with beginning balance.', 'contactid:+13-0'),
(413, '+92-3335672555', 1761650422, '+92-3335672555', 'Published', '1761650422', NULL, '---', 'payment.Paid', '2025-10-28 11:20:22', '[{\"account\":\"34\",\"amount\":\"200\"}]', '[{\"account\":\"c+73-1\",\"amount\":\"200\"}]', 'payment.Paid', 'paymentid:1'),
(414, '+92-3335672555', 1761650422, '+92-3335672555', 'Published', '1761650422', NULL, '---', 'payment.Paid', '2025-10-28 11:20:22', '[{\"account\":\"41\",\"amount\":\"0\"}]', '[{\"account\":\"c+73-1\",\"amount\":\"0\"}]', 'payment.Paid', 'paymentid:1'),
(415, '+256-759912814', 1763977323, '+256-759912814', 'Published', '1763977323', NULL, '---', 'Create new Product with beginning balance.', '2025-11-24 09:42:03', '[{\"account\":\"10\",\"amount\":\"6400\"}]', '[{\"account\":\"11\",\"amount\":\"6400\"}]', 'Create new Product with beginning balance.', 'product:383'),
(416, '+256-759912814', 1763982936, '+256-759912814', 'Published', '1763982936', NULL, '---', 'Create new Product with beginning balance.', '2025-11-24 11:15:36', '[{\"account\":\"10\",\"amount\":\"13000\"}]', '[{\"account\":\"11\",\"amount\":\"13000\"}]', 'Create new Product with beginning balance.', 'product:384'),
(417, '+256-759912814', 1763984051, '+256-759912814', 'Published', '1763984051', NULL, '---', 'Create new Product with beginning balance.', '2025-11-24 11:34:11', '[{\"account\":\"10\",\"amount\":\"21250\"}]', '[{\"account\":\"11\",\"amount\":\"21250\"}]', 'Create new Product with beginning balance.', 'product:385'),
(418, '+256-759912814', 1763984136, '+256-759912814', 'Published', '1763984136', NULL, '---', 'Create new Product with beginning balance.', '2025-11-24 11:35:36', '[{\"account\":\"10\",\"amount\":\"3000\"}]', '[{\"account\":\"11\",\"amount\":\"3000\"}]', 'Create new Product with beginning balance.', 'product:386'),
(419, '+256-759912814', 1763984215, '+256-759912814', 'Published', '1763984215', NULL, '---', 'Create new Product with beginning balance.', '2025-11-24 11:36:55', '[{\"account\":\"10\",\"amount\":\"20000\"}]', '[{\"account\":\"11\",\"amount\":\"20000\"}]', 'Create new Product with beginning balance.', 'product:387'),
(420, '+256-759912814', 1763984486, '+256-759912814', 'Published', '1763984486', NULL, '---', 'Create new Product with beginning balance.', '2025-11-24 11:41:26', '[{\"account\":\"10\",\"amount\":\"120000\"}]', '[{\"account\":\"11\",\"amount\":\"120000\"}]', 'Create new Product with beginning balance.', 'product:388'),
(421, '+256-759912814', 1763984580, '+256-759912814', 'Published', '1763984580', NULL, '---', 'Create new Product with beginning balance.', '2025-11-24 11:43:00', '[{\"account\":\"10\",\"amount\":\"10000\"}]', '[{\"account\":\"11\",\"amount\":\"10000\"}]', 'Create new Product with beginning balance.', 'product:389'),
(422, '+256-759912814', 1763984682, '+256-759912814', 'Published', '1763984682', NULL, '---', 'Create new Product with beginning balance.', '2025-11-24 11:44:42', '[{\"account\":\"10\",\"amount\":\"116250\"}]', '[{\"account\":\"11\",\"amount\":\"116250\"}]', 'Create new Product with beginning balance.', 'product:390'),
(423, '+256-759912814', 1763984778, '+256-759912814', 'Published', '1763984778', NULL, '---', 'Create new Product with beginning balance.', '2025-11-24 11:46:18', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:391'),
(424, '+256-759912814', 1763984832, '+256-759912814', 'Published', '1763984832', NULL, '---', 'Create new Product with beginning balance.', '2025-11-24 11:47:12', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:392'),
(425, '+256-759912814', 1763984883, '+256-759912814', 'Published', '1763984883', NULL, '---', 'Create new Product with beginning balance.', '2025-11-24 11:48:03', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:393'),
(426, '+256-759912814', 1763984930, '+256-759912814', 'Published', '1763984930', NULL, '---', 'Create new Product with beginning balance.', '2025-11-24 11:48:50', '[{\"account\":\"10\",\"amount\":\"0\"}]', '[{\"account\":\"11\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:394'),
(427, '+256-759912814', 1763984971, '+256-759912814', 'Published', '1763984971', NULL, '---', 'Create new Product with beginning balance.', '2025-11-24 11:49:31', '[{\"account\":\"10\",\"amount\":\"11000\"}]', '[{\"account\":\"11\",\"amount\":\"11000\"}]', 'Create new Product with beginning balance.', 'product:395'),
(428, '+256-759912814', 1763985575, '+256-759912814', 'Published', '1763985575', NULL, '---', 'Create new Product with beginning balance.', '2025-11-24 11:59:35', '[{\"account\":\"10\",\"amount\":\"61600\"}]', '[{\"account\":\"11\",\"amount\":\"61600\"}]', 'Create new Product with beginning balance.', 'product:396'),
(429, '+256-759912814', 1763985628, '+256-759912814', 'Published', '1763985628', NULL, '---', 'Create new Product with beginning balance.', '2025-11-24 12:00:28', '[{\"account\":\"10\",\"amount\":\"19000\"}]', '[{\"account\":\"11\",\"amount\":\"19000\"}]', 'Create new Product with beginning balance.', 'product:397'),
(430, '+256-759912814', 1763985678, '+256-759912814', 'Published', '1763985678', NULL, '---', 'Adjust stock: Lost stock item.', '2025-11-24 12:01:18', '[{\"account\":\"11\",\"amount\":15200}]', '[{\"account\":\"2\",\"amount\":15200}]', 'Adjust stock: Lost stock item.', 'product:396'),
(431, '+92-3335672555', 1764131548, '+92-3335672555', 'Published', '1764131548', NULL, '---', 'Create new Product with beginning balance.', '2025-11-26 04:32:28', '[{\"account\":\"43\",\"amount\":\"1300\"}]', '[{\"account\":\"44\",\"amount\":\"1300\"}]', 'Create new Product with beginning balance.', 'product:398'),
(432, '+92-3335672555', 1764131599, '+92-3335672555', 'Published', '1764131599', NULL, '---', 'Create new Product with beginning balance.', '2025-11-26 04:33:19', '[{\"account\":\"43\",\"amount\":\"0\"}]', '[{\"account\":\"44\",\"amount\":\"0\"}]', 'Create new Product with beginning balance.', 'product:399'),
(433, '+92-3335672555', 1764131718, '+92-3335672555', 'Published', '1764131718', NULL, '---', 'manafacturing', '2025-11-26 04:35:18', '[{\"account\":\"34\",\"amount\":\"150\"}]', '[{\"account\":\"35\",\"amount\":\"150\"}]', 'manafacturing', 'activity_id:1');

-- --------------------------------------------------------

--
-- Table structure for table `journal_entries`
--

CREATE TABLE `journal_entries` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `description` mediumtext DEFAULT NULL,
  `date_time` varchar(30) DEFAULT NULL,
  `debit` mediumtext DEFAULT NULL,
  `credit` mediumtext DEFAULT NULL,
  `amount` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(500) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `date` varchar(30) DEFAULT NULL,
  `account_id` varchar(30) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `amount` varchar(30) DEFAULT NULL,
  `amount_type` varchar(30) DEFAULT NULL,
  `balance` varchar(30) DEFAULT NULL,
  `balance_type` varchar(30) DEFAULT NULL,
  `entry_link` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `ledger`
--

INSERT INTO `ledger` (`id`, `owner_mobile`, `timestamp`, `added_by`, `status`, `last_updated`, `sync`, `---`, `date`, `account_id`, `description`, `amount`, `amount_type`, `balance`, `balance_type`, `entry_link`) VALUES
(1, '+256-759912814', 1760534985, '+256-759912814', 'Published', '1760534985', NULL, '---', '2025-10-15 13:29:45', '10', 'Create new Product with beginning balance.', '6500', 'credit', '6500', 'credit', 'product:3'),
(2, '+256-759912814', 1760534985, '+256-759912814', 'Published', '1760534985', NULL, '---', '2025-10-15 13:29:45', '11', 'Create new Product with beginning balance.', '6500', 'debit', '6500', 'debit', 'product:3'),
(3, '+256-759912814', 1760535134, '+256-759912814', 'Published', '1760535134', NULL, '---', '2025-10-15 13:32:14', '10', 'Create new Product with beginning balance.', '120840', 'credit', '127340', 'credit', 'product:4'),
(4, '+256-759912814', 1760535134, '+256-759912814', 'Published', '1760535134', NULL, '---', '2025-10-15 13:32:14', '11', 'Create new Product with beginning balance.', '120840', 'debit', '127340', 'debit', 'product:4'),
(5, '+256-759912814', 1760535562, '+256-759912814', 'Published', '1760535562', NULL, '---', '2025-10-15 13:39:22', '10', 'Create new Product with beginning balance.', '23000', 'credit', '150340', 'credit', 'product:5'),
(6, '+256-759912814', 1760535562, '+256-759912814', 'Published', '1760535562', NULL, '---', '2025-10-15 13:39:22', '11', 'Create new Product with beginning balance.', '23000', 'debit', '150340', 'debit', 'product:5'),
(7, '+256-759912814', 1760535626, '+256-759912814', 'Published', '1760535626', NULL, '---', '2025-10-15 13:40:26', '10', 'Create new Product with beginning balance.', '28000', 'credit', '178340', 'credit', 'product:6'),
(8, '+256-759912814', 1760535626, '+256-759912814', 'Published', '1760535626', NULL, '---', '2025-10-15 13:40:26', '11', 'Create new Product with beginning balance.', '28000', 'debit', '178340', 'debit', 'product:6'),
(9, '+256-759912814', 1760535683, '+256-759912814', 'Published', '1760535683', NULL, '---', '2025-10-15 13:41:23', '10', 'Create new Product with beginning balance.', '35000', 'credit', '213340', 'credit', 'product:7'),
(10, '+256-759912814', 1760535683, '+256-759912814', 'Published', '1760535683', NULL, '---', '2025-10-15 13:41:23', '11', 'Create new Product with beginning balance.', '35000', 'debit', '213340', 'debit', 'product:7'),
(11, '+256-759912814', 1760535833, '+256-759912814', 'Published', '1760535833', NULL, '---', '2025-10-15 13:43:53', '10', 'Create new Product with beginning balance.', '29900', 'credit', '243240', 'credit', 'product:9'),
(12, '+256-759912814', 1760535833, '+256-759912814', 'Published', '1760535833', NULL, '---', '2025-10-15 13:43:53', '11', 'Create new Product with beginning balance.', '29900', 'debit', '243240', 'debit', 'product:9'),
(13, '+256-759912814', 1760535908, '+256-759912814', 'Published', '1760535908', NULL, '---', '2025-10-15 13:45:08', '10', 'Create new Product with beginning balance.', '18400', 'credit', '261640', 'credit', 'product:10'),
(14, '+256-759912814', 1760535908, '+256-759912814', 'Published', '1760535908', NULL, '---', '2025-10-15 13:45:08', '11', 'Create new Product with beginning balance.', '18400', 'debit', '261640', 'debit', 'product:10'),
(15, '+256-759912814', 1760536045, '+256-759912814', 'Published', '1760536045', NULL, '---', '2025-10-15 13:47:25', '10', 'Create new Product with beginning balance.', '20000', 'credit', '281640', 'credit', 'product:12'),
(16, '+256-759912814', 1760536045, '+256-759912814', 'Published', '1760536045', NULL, '---', '2025-10-15 13:47:25', '11', 'Create new Product with beginning balance.', '20000', 'debit', '281640', 'debit', 'product:12'),
(17, '+256-759912814', 1760536149, '+256-759912814', 'Published', '1760536149', NULL, '---', '2025-10-15 13:49:09', '10', 'Create new Product with beginning balance.', '9000', 'credit', '290640', 'credit', 'product:13'),
(18, '+256-759912814', 1760536149, '+256-759912814', 'Published', '1760536149', NULL, '---', '2025-10-15 13:49:09', '11', 'Create new Product with beginning balance.', '9000', 'debit', '290640', 'debit', 'product:13'),
(19, '+256-759912814', 1760536515, '+256-759912814', 'Published', '1760536515', NULL, '---', '2025-10-15 13:55:15', '10', 'Create new Product with beginning balance.', '30000', 'credit', '320640', 'credit', 'product:15'),
(20, '+256-759912814', 1760536515, '+256-759912814', 'Published', '1760536515', NULL, '---', '2025-10-15 13:55:15', '11', 'Create new Product with beginning balance.', '30000', 'debit', '320640', 'debit', 'product:15'),
(21, '+256-759912814', 1760536652, '+256-759912814', 'Published', '1760536652', NULL, '---', '2025-10-15 13:57:32', '10', 'Create new Product with beginning balance.', '2400', 'credit', '323040', 'credit', 'product:17'),
(22, '+256-759912814', 1760536652, '+256-759912814', 'Published', '1760536652', NULL, '---', '2025-10-15 13:57:32', '11', 'Create new Product with beginning balance.', '2400', 'debit', '323040', 'debit', 'product:17'),
(23, '+256-759912814', 1760536867, '+256-759912814', 'Published', '1760536867', NULL, '---', '2025-10-15 14:01:07', '10', 'Create new Product with beginning balance.', '16800', 'credit', '339840', 'credit', 'product:20'),
(24, '+256-759912814', 1760536867, '+256-759912814', 'Published', '1760536867', NULL, '---', '2025-10-15 14:01:07', '11', 'Create new Product with beginning balance.', '16800', 'debit', '339840', 'debit', 'product:20'),
(25, '+256-759912814', 1760537036, '+256-759912814', 'Published', '1760537036', NULL, '---', '2025-10-15 14:03:56', '10', 'Create new Product with beginning balance.', '67500', 'credit', '407340', 'credit', 'product:23'),
(26, '+256-759912814', 1760537036, '+256-759912814', 'Published', '1760537036', NULL, '---', '2025-10-15 14:03:56', '11', 'Create new Product with beginning balance.', '67500', 'debit', '407340', 'debit', 'product:23'),
(27, '+256-759912814', 1760537072, '+256-759912814', 'Published', '1760537072', NULL, '---', '2025-10-15 14:04:32', '10', 'Create new Product with beginning balance.', '108000', 'credit', '515340', 'credit', 'product:24'),
(28, '+256-759912814', 1760537072, '+256-759912814', 'Published', '1760537072', NULL, '---', '2025-10-15 14:04:32', '11', 'Create new Product with beginning balance.', '108000', 'debit', '515340', 'debit', 'product:24'),
(29, '+256-759912814', 1760537200, '+256-759912814', 'Published', '1760537200', NULL, '---', '2025-10-15 14:06:40', '10', 'Create new Product with beginning balance.', '45500', 'credit', '560840', 'credit', 'product:26'),
(30, '+256-759912814', 1760537200, '+256-759912814', 'Published', '1760537200', NULL, '---', '2025-10-15 14:06:40', '11', 'Create new Product with beginning balance.', '45500', 'debit', '560840', 'debit', 'product:26'),
(31, '+256-759912814', 1760537244, '+256-759912814', 'Published', '1760537244', NULL, '---', '2025-10-15 14:07:24', '10', 'Create new Product with beginning balance.', '147000', 'credit', '707840', 'credit', 'product:27'),
(32, '+256-759912814', 1760537244, '+256-759912814', 'Published', '1760537244', NULL, '---', '2025-10-15 14:07:24', '11', 'Create new Product with beginning balance.', '147000', 'debit', '707840', 'debit', 'product:27'),
(33, '+256-759912814', 1760537307, '+256-759912814', 'Published', '1760537307', NULL, '---', '2025-10-15 14:08:27', '10', 'Create new Product with beginning balance.', '512000', 'credit', '1219840', 'credit', 'product:28'),
(34, '+256-759912814', 1760537307, '+256-759912814', 'Published', '1760537307', NULL, '---', '2025-10-15 14:08:27', '11', 'Create new Product with beginning balance.', '512000', 'debit', '1219840', 'debit', 'product:28'),
(35, '+256-759912814', 1760537688, '+256-759912814', 'Published', '1760537688', NULL, '---', '2025-10-15 14:14:48', '10', 'Create new Product with beginning balance.', '140000', 'credit', '1359840', 'credit', 'product:34'),
(36, '+256-759912814', 1760537688, '+256-759912814', 'Published', '1760537688', NULL, '---', '2025-10-15 14:14:48', '11', 'Create new Product with beginning balance.', '140000', 'debit', '1359840', 'debit', 'product:34'),
(37, '+256-759912814', 1760537832, '+256-759912814', 'Published', '1760537832', NULL, '---', '2025-10-15 14:17:12', '10', 'Create new Product with beginning balance.', '12000', 'credit', '1371840', 'credit', 'product:36'),
(38, '+256-759912814', 1760537832, '+256-759912814', 'Published', '1760537832', NULL, '---', '2025-10-15 14:17:12', '11', 'Create new Product with beginning balance.', '12000', 'debit', '1371840', 'debit', 'product:36'),
(39, '+256-759912814', 1760537915, '+256-759912814', 'Published', '1760537915', NULL, '---', '2025-10-15 14:18:35', '10', 'Create new Product with beginning balance.', '32000', 'credit', '1403840', 'credit', 'product:37'),
(40, '+256-759912814', 1760537915, '+256-759912814', 'Published', '1760537915', NULL, '---', '2025-10-15 14:18:35', '11', 'Create new Product with beginning balance.', '32000', 'debit', '1403840', 'debit', 'product:37'),
(41, '+256-759912814', 1760537982, '+256-759912814', 'Published', '1760537982', NULL, '---', '2025-10-15 14:19:42', '10', 'Create new Product with beginning balance.', '121600', 'credit', '1525440', 'credit', 'product:38'),
(42, '+256-759912814', 1760537982, '+256-759912814', 'Published', '1760537982', NULL, '---', '2025-10-15 14:19:42', '11', 'Create new Product with beginning balance.', '121600', 'debit', '1525440', 'debit', 'product:38'),
(43, '+256-759912814', 1760538057, '+256-759912814', 'Published', '1760538057', NULL, '---', '2025-10-15 14:20:57', '10', 'Adjust stock: opening balance stock item', '39100', 'credit', '1564540', 'credit', 'product:9'),
(44, '+256-759912814', 1760538057, '+256-759912814', 'Published', '1760538057', NULL, '---', '2025-10-15 14:20:57', '11', 'Adjust stock: opening balance stock item', '39100', 'debit', '1564540', 'debit', 'product:9'),
(45, '+256-759912814', 1760538245, '+256-759912814', 'Published', '1760538245', NULL, '---', '2025-10-15 14:24:05', '10', 'Create new Product with beginning balance.', '16000', 'credit', '1580540', 'credit', 'product:39'),
(46, '+256-759912814', 1760538245, '+256-759912814', 'Published', '1760538245', NULL, '---', '2025-10-15 14:24:05', '11', 'Create new Product with beginning balance.', '16000', 'debit', '1580540', 'debit', 'product:39'),
(47, '+256-759912814', 1760538314, '+256-759912814', 'Published', '1760538314', NULL, '---', '2025-10-15 14:25:14', '10', 'Create new Product with beginning balance.', '52800', 'credit', '1633340', 'credit', 'product:40'),
(48, '+256-759912814', 1760538314, '+256-759912814', 'Published', '1760538314', NULL, '---', '2025-10-15 14:25:14', '11', 'Create new Product with beginning balance.', '52800', 'debit', '1633340', 'debit', 'product:40'),
(49, '+256-759912814', 1760538412, '+256-759912814', 'Published', '1760538412', NULL, '---', '2025-10-15 14:26:52', '10', 'Create new Product with beginning balance.', '48000', 'credit', '1681340', 'credit', 'product:41'),
(50, '+256-759912814', 1760538412, '+256-759912814', 'Published', '1760538412', NULL, '---', '2025-10-15 14:26:52', '11', 'Create new Product with beginning balance.', '48000', 'debit', '1681340', 'debit', 'product:41'),
(51, '+256-759912814', 1760538450, '+256-759912814', 'Published', '1760538450', NULL, '---', '2025-10-15 14:27:30', '10', 'Create new Product with beginning balance.', '31200', 'credit', '1712540', 'credit', 'product:42'),
(52, '+256-759912814', 1760538450, '+256-759912814', 'Published', '1760538450', NULL, '---', '2025-10-15 14:27:30', '11', 'Create new Product with beginning balance.', '31200', 'debit', '1712540', 'debit', 'product:42'),
(53, '+256-759912814', 1760538494, '+256-759912814', 'Published', '1760538494', NULL, '---', '2025-10-15 14:28:14', '10', 'Create new Product with beginning balance.', '16800', 'credit', '1729340', 'credit', 'product:43'),
(54, '+256-759912814', 1760538494, '+256-759912814', 'Published', '1760538494', NULL, '---', '2025-10-15 14:28:14', '11', 'Create new Product with beginning balance.', '16800', 'debit', '1729340', 'debit', 'product:43'),
(55, '+256-759912814', 1760538554, '+256-759912814', 'Published', '1760538554', NULL, '---', '2025-10-15 14:29:14', '10', 'Create new Product with beginning balance.', '3600', 'credit', '1732940', 'credit', 'product:44'),
(56, '+256-759912814', 1760538554, '+256-759912814', 'Published', '1760538554', NULL, '---', '2025-10-15 14:29:14', '11', 'Create new Product with beginning balance.', '3600', 'debit', '1732940', 'debit', 'product:44'),
(57, '+256-759912814', 1760538607, '+256-759912814', 'Published', '1760538607', NULL, '---', '2025-10-15 14:30:07', '10', 'Create new Product with beginning balance.', '31500', 'credit', '1764440', 'credit', 'product:45'),
(58, '+256-759912814', 1760538607, '+256-759912814', 'Published', '1760538607', NULL, '---', '2025-10-15 14:30:07', '11', 'Create new Product with beginning balance.', '31500', 'debit', '1764440', 'debit', 'product:45'),
(59, '+256-759912814', 1760538725, '+256-759912814', 'Published', '1760538725', NULL, '---', '2025-10-15 14:32:05', '10', 'Adjust stock: opening balance stock item', '16000', 'credit', '1780440', 'credit', 'product:39'),
(60, '+256-759912814', 1760538725, '+256-759912814', 'Published', '1760538725', NULL, '---', '2025-10-15 14:32:05', '11', 'Adjust stock: opening balance stock item', '16000', 'debit', '1780440', 'debit', 'product:39'),
(61, '+256-759912814', 1760538824, '+256-759912814', 'Published', '1760538824', NULL, '---', '2025-10-15 14:33:44', '10', 'Create new Product with beginning balance.', '2400', 'credit', '1782840', 'credit', 'product:46'),
(62, '+256-759912814', 1760538824, '+256-759912814', 'Published', '1760538824', NULL, '---', '2025-10-15 14:33:44', '11', 'Create new Product with beginning balance.', '2400', 'debit', '1782840', 'debit', 'product:46'),
(63, '+256-759912814', 1760538882, '+256-759912814', 'Published', '1760538882', NULL, '---', '2025-10-15 14:34:42', '10', 'Create new Product with beginning balance.', '12000', 'credit', '1794840', 'credit', 'product:47'),
(64, '+256-759912814', 1760538882, '+256-759912814', 'Published', '1760538882', NULL, '---', '2025-10-15 14:34:42', '11', 'Create new Product with beginning balance.', '12000', 'debit', '1794840', 'debit', 'product:47'),
(65, '+256-759912814', 1760538929, '+256-759912814', 'Published', '1760538929', NULL, '---', '2025-10-15 14:35:29', '10', 'Create new Product with beginning balance.', '2800', 'credit', '1797640', 'credit', 'product:48'),
(66, '+256-759912814', 1760538929, '+256-759912814', 'Published', '1760538929', NULL, '---', '2025-10-15 14:35:29', '11', 'Create new Product with beginning balance.', '2800', 'debit', '1797640', 'debit', 'product:48'),
(67, '+256-759912814', 1760538986, '+256-759912814', 'Published', '1760538986', NULL, '---', '2025-10-15 14:36:26', '10', 'Create new Product with beginning balance.', '16000', 'credit', '1813640', 'credit', 'product:49'),
(68, '+256-759912814', 1760538986, '+256-759912814', 'Published', '1760538986', NULL, '---', '2025-10-15 14:36:26', '11', 'Create new Product with beginning balance.', '16000', 'debit', '1813640', 'debit', 'product:49'),
(69, '+256-759912814', 1760539047, '+256-759912814', 'Published', '1760539047', NULL, '---', '2025-10-15 14:37:27', '10', 'Adjust stock: opening balance stock item', '4800', 'credit', '1818440', 'credit', 'product:41'),
(70, '+256-759912814', 1760539047, '+256-759912814', 'Published', '1760539047', NULL, '---', '2025-10-15 14:37:27', '11', 'Adjust stock: opening balance stock item', '4800', 'debit', '1818440', 'debit', 'product:41'),
(71, '+256-759912814', 1760598596, '+256-759912814', 'Published', '1760598596', NULL, '---', '2025-10-16 07:09:56', '10', 'Create new Product with beginning balance.', '37700', 'credit', '1856140', 'credit', 'product:50'),
(72, '+256-759912814', 1760598596, '+256-759912814', 'Published', '1760598596', NULL, '---', '2025-10-16 07:09:56', '11', 'Create new Product with beginning balance.', '37700', 'debit', '1856140', 'debit', 'product:50'),
(73, '+256-759912814', 1760598596, '+256-759912814', 'Published', '1760598596', NULL, '---', '2025-10-16 07:09:56', '10', 'Create new Product with beginning balance.', '37700', 'credit', '1893840', 'credit', 'product:51'),
(74, '+256-759912814', 1760598596, '+256-759912814', 'Published', '1760598596', NULL, '---', '2025-10-16 07:09:56', '11', 'Create new Product with beginning balance.', '37700', 'debit', '1893840', 'debit', 'product:51'),
(75, '+256-759912814', 1760598662, '+256-759912814', 'Published', '1760598662', NULL, '---', '2025-10-16 07:11:02', '10', 'Create new Product with beginning balance.', '26000', 'credit', '1919840', 'credit', 'product:52'),
(76, '+256-759912814', 1760598662, '+256-759912814', 'Published', '1760598662', NULL, '---', '2025-10-16 07:11:02', '11', 'Create new Product with beginning balance.', '26000', 'debit', '1919840', 'debit', 'product:52'),
(77, '+256-759912814', 1760598862, '+256-759912814', 'Published', '1760598862', NULL, '---', '2025-10-16 07:14:22', '10', 'Create new Product with beginning balance.', '120900', 'credit', '2040740', 'credit', 'product:53'),
(78, '+256-759912814', 1760598862, '+256-759912814', 'Published', '1760598862', NULL, '---', '2025-10-16 07:14:22', '11', 'Create new Product with beginning balance.', '120900', 'debit', '2040740', 'debit', 'product:53'),
(79, '+256-759912814', 1760599329, '+256-759912814', 'Published', '1760599329', NULL, '---', '2025-10-16 07:22:09', '10', 'Adjust stock: opening balance stock item', '20400', 'credit', '2061140', 'credit', 'product:59'),
(80, '+256-759912814', 1760599329, '+256-759912814', 'Published', '1760599329', NULL, '---', '2025-10-16 07:22:09', '11', 'Adjust stock: opening balance stock item', '20400', 'debit', '2061140', 'debit', 'product:59'),
(81, '+256-759912814', 1760599476, '+256-759912814', 'Published', '1760599476', NULL, '---', '2025-10-16 07:24:36', '10', 'Create new Product with beginning balance.', '70800', 'credit', '2131940', 'credit', 'product:60'),
(82, '+256-759912814', 1760599476, '+256-759912814', 'Published', '1760599476', NULL, '---', '2025-10-16 07:24:36', '11', 'Create new Product with beginning balance.', '70800', 'debit', '2131940', 'debit', 'product:60'),
(83, '+256-759912814', 1760599577, '+256-759912814', 'Published', '1760599577', NULL, '---', '2025-10-16 07:26:17', '10', 'Create new Product with beginning balance.', '150800', 'credit', '2282740', 'credit', 'product:61'),
(84, '+256-759912814', 1760599577, '+256-759912814', 'Published', '1760599577', NULL, '---', '2025-10-16 07:26:17', '11', 'Create new Product with beginning balance.', '150800', 'debit', '2282740', 'debit', 'product:61'),
(85, '+256-759912814', 1760599664, '+256-759912814', 'Published', '1760599664', NULL, '---', '2025-10-16 07:27:44', '10', 'Create new Product with beginning balance.', '12000', 'credit', '2294740', 'credit', 'product:62'),
(86, '+256-759912814', 1760599664, '+256-759912814', 'Published', '1760599664', NULL, '---', '2025-10-16 07:27:44', '11', 'Create new Product with beginning balance.', '12000', 'debit', '2294740', 'debit', 'product:62'),
(87, '+256-759912814', 1760599804, '+256-759912814', 'Published', '1760599804', NULL, '---', '2025-10-16 07:30:04', '10', 'Create new Product with beginning balance.', '37800', 'credit', '2332540', 'credit', 'product:63'),
(88, '+256-759912814', 1760599804, '+256-759912814', 'Published', '1760599804', NULL, '---', '2025-10-16 07:30:04', '11', 'Create new Product with beginning balance.', '37800', 'debit', '2332540', 'debit', 'product:63'),
(89, '+256-759912814', 1760599854, '+256-759912814', 'Published', '1760599854', NULL, '---', '2025-10-16 07:30:54', '10', 'Create new Product with beginning balance.', '4000', 'credit', '2336540', 'credit', 'product:64'),
(90, '+256-759912814', 1760599854, '+256-759912814', 'Published', '1760599854', NULL, '---', '2025-10-16 07:30:54', '11', 'Create new Product with beginning balance.', '4000', 'debit', '2336540', 'debit', 'product:64'),
(91, '+256-759912814', 1760599907, '+256-759912814', 'Published', '1760599907', NULL, '---', '2025-10-16 07:31:47', '10', 'Create new Product with beginning balance.', '2400', 'credit', '2338940', 'credit', 'product:65'),
(92, '+256-759912814', 1760599907, '+256-759912814', 'Published', '1760599907', NULL, '---', '2025-10-16 07:31:47', '11', 'Create new Product with beginning balance.', '2400', 'debit', '2338940', 'debit', 'product:65'),
(93, '+256-759912814', 1760600093, '+256-759912814', 'Published', '1760600093', NULL, '---', '2025-10-16 07:34:53', '10', 'Create new Product with beginning balance.', '25200', 'credit', '2364140', 'credit', 'product:66'),
(94, '+256-759912814', 1760600093, '+256-759912814', 'Published', '1760600093', NULL, '---', '2025-10-16 07:34:53', '11', 'Create new Product with beginning balance.', '25200', 'debit', '2364140', 'debit', 'product:66'),
(95, '+256-759912814', 1760600151, '+256-759912814', 'Published', '1760600151', NULL, '---', '2025-10-16 07:35:51', '10', 'Create new Product with beginning balance.', '27000', 'credit', '2391140', 'credit', 'product:67'),
(96, '+256-759912814', 1760600151, '+256-759912814', 'Published', '1760600151', NULL, '---', '2025-10-16 07:35:51', '11', 'Create new Product with beginning balance.', '27000', 'debit', '2391140', 'debit', 'product:67'),
(97, '+256-759912814', 1760600196, '+256-759912814', 'Published', '1760600196', NULL, '---', '2025-10-16 07:36:36', '10', 'Create new Product with beginning balance.', '21600', 'credit', '2412740', 'credit', 'product:68'),
(98, '+256-759912814', 1760600196, '+256-759912814', 'Published', '1760600196', NULL, '---', '2025-10-16 07:36:36', '11', 'Create new Product with beginning balance.', '21600', 'debit', '2412740', 'debit', 'product:68'),
(99, '+256-759912814', 1760600270, '+256-759912814', 'Published', '1760600270', NULL, '---', '2025-10-16 07:37:50', '10', 'Create new Product with beginning balance.', '12000', 'credit', '2424740', 'credit', 'product:69'),
(100, '+256-759912814', 1760600270, '+256-759912814', 'Published', '1760600270', NULL, '---', '2025-10-16 07:37:50', '11', 'Create new Product with beginning balance.', '12000', 'debit', '2424740', 'debit', 'product:69'),
(101, '+256-759912814', 1760600361, '+256-759912814', 'Published', '1760600361', NULL, '---', '2025-10-16 07:39:21', '10', 'Create new Product with beginning balance.', '35000', 'credit', '2459740', 'credit', 'product:70'),
(102, '+256-759912814', 1760600361, '+256-759912814', 'Published', '1760600361', NULL, '---', '2025-10-16 07:39:21', '11', 'Create new Product with beginning balance.', '35000', 'debit', '2459740', 'debit', 'product:70'),
(103, '+256-759912814', 1760600363, '+256-759912814', 'Published', '1760600363', NULL, '---', '2025-10-16 07:39:23', '10', 'Create new Product with beginning balance.', '35000', 'credit', '2494740', 'credit', 'product:71'),
(104, '+256-759912814', 1760600363, '+256-759912814', 'Published', '1760600363', NULL, '---', '2025-10-16 07:39:23', '11', 'Create new Product with beginning balance.', '35000', 'debit', '2494740', 'debit', 'product:71'),
(105, '+256-759912814', 1760600461, '+256-759912814', 'Published', '1760600461', NULL, '---', '2025-10-16 07:41:01', '10', 'Create new Product with beginning balance.', '33000', 'credit', '2527740', 'credit', 'product:72'),
(106, '+256-759912814', 1760600461, '+256-759912814', 'Published', '1760600461', NULL, '---', '2025-10-16 07:41:01', '11', 'Create new Product with beginning balance.', '33000', 'debit', '2527740', 'debit', 'product:72'),
(107, '+256-759912814', 1760600464, '+256-759912814', 'Published', '1760600464', NULL, '---', '2025-10-16 07:41:04', '10', 'Create new Product with beginning balance.', '33000', 'credit', '2560740', 'credit', 'product:73'),
(108, '+256-759912814', 1760600464, '+256-759912814', 'Published', '1760600464', NULL, '---', '2025-10-16 07:41:04', '11', 'Create new Product with beginning balance.', '33000', 'debit', '2560740', 'debit', 'product:73'),
(109, '+256-759912814', 1760601227, '+256-759912814', 'Published', '1760601227', NULL, '---', '2025-10-16 07:53:47', '10', 'Create new Product with beginning balance.', '37200', 'credit', '2597940', 'credit', 'product:77'),
(110, '+256-759912814', 1760601227, '+256-759912814', 'Published', '1760601227', NULL, '---', '2025-10-16 07:53:47', '11', 'Create new Product with beginning balance.', '37200', 'debit', '2597940', 'debit', 'product:77'),
(111, '+256-759912814', 1760601345, '+256-759912814', 'Published', '1760601345', NULL, '---', '2025-10-16 07:55:45', '10', 'Create new Product with beginning balance.', '8000', 'credit', '2605940', 'credit', 'product:79'),
(112, '+256-759912814', 1760601345, '+256-759912814', 'Published', '1760601345', NULL, '---', '2025-10-16 07:55:45', '11', 'Create new Product with beginning balance.', '8000', 'debit', '2605940', 'debit', 'product:79'),
(113, '+256-759912814', 1760601438, '+256-759912814', 'Published', '1760601438', NULL, '---', '2025-10-16 07:57:18', '10', 'Create new Product with beginning balance.', '12000', 'credit', '2617940', 'credit', 'product:81'),
(114, '+256-759912814', 1760601438, '+256-759912814', 'Published', '1760601438', NULL, '---', '2025-10-16 07:57:18', '11', 'Create new Product with beginning balance.', '12000', 'debit', '2617940', 'debit', 'product:81'),
(115, '+256-759912814', 1760601543, '+256-759912814', 'Published', '1760601543', NULL, '---', '2025-10-16 07:59:03', '10', 'Create new Product with beginning balance.', '13750', 'credit', '2631690', 'credit', 'product:83'),
(116, '+256-759912814', 1760601543, '+256-759912814', 'Published', '1760601543', NULL, '---', '2025-10-16 07:59:03', '11', 'Create new Product with beginning balance.', '13750', 'debit', '2631690', 'debit', 'product:83'),
(117, '+256-759912814', 1760601676, '+256-759912814', 'Published', '1760601676', NULL, '---', '2025-10-16 08:01:16', '10', 'Create new Product with beginning balance.', '58000', 'credit', '2689690', 'credit', 'product:86'),
(118, '+256-759912814', 1760601676, '+256-759912814', 'Published', '1760601676', NULL, '---', '2025-10-16 08:01:16', '11', 'Create new Product with beginning balance.', '58000', 'debit', '2689690', 'debit', 'product:86'),
(119, '+256-759912814', 1760601774, '+256-759912814', 'Published', '1760601774', NULL, '---', '2025-10-16 08:02:54', '10', 'Create new Product with beginning balance.', '38500', 'credit', '2728190', 'credit', 'product:88'),
(120, '+256-759912814', 1760601774, '+256-759912814', 'Published', '1760601774', NULL, '---', '2025-10-16 08:02:54', '11', 'Create new Product with beginning balance.', '38500', 'debit', '2728190', 'debit', 'product:88'),
(121, '+256-759912814', 1760601869, '+256-759912814', 'Published', '1760601869', NULL, '---', '2025-10-16 08:04:29', '10', 'Create new Product with beginning balance.', '42000', 'credit', '2770190', 'credit', 'product:90'),
(122, '+256-759912814', 1760601869, '+256-759912814', 'Published', '1760601869', NULL, '---', '2025-10-16 08:04:29', '11', 'Create new Product with beginning balance.', '42000', 'debit', '2770190', 'debit', 'product:90'),
(123, '+256-759912814', 1760601996, '+256-759912814', 'Published', '1760601996', NULL, '---', '2025-10-16 08:06:36', '10', 'Create new Product with beginning balance.', '332000', 'credit', '3102190', 'credit', 'product:92'),
(124, '+256-759912814', 1760601996, '+256-759912814', 'Published', '1760601996', NULL, '---', '2025-10-16 08:06:36', '11', 'Create new Product with beginning balance.', '332000', 'debit', '3102190', 'debit', 'product:92'),
(125, '+256-759912814', 1760602764, '+256-759912814', 'Published', '1760602764', NULL, '---', '2025-10-16 08:19:24', '10', 'Create new Product with beginning balance.', '13000', 'credit', '3115190', 'credit', 'product:94'),
(126, '+256-759912814', 1760602764, '+256-759912814', 'Published', '1760602764', NULL, '---', '2025-10-16 08:19:24', '11', 'Create new Product with beginning balance.', '13000', 'debit', '3115190', 'debit', 'product:94'),
(127, '+256-759912814', 1760602823, '+256-759912814', 'Published', '1760602823', NULL, '---', '2025-10-16 08:20:23', '10', 'Create new Product with beginning balance.', '40300', 'credit', '3155490', 'credit', 'product:95'),
(128, '+256-759912814', 1760602823, '+256-759912814', 'Published', '1760602823', NULL, '---', '2025-10-16 08:20:23', '11', 'Create new Product with beginning balance.', '40300', 'debit', '3155490', 'debit', 'product:95'),
(129, '+256-759912814', 1760602894, '+256-759912814', 'Published', '1760602894', NULL, '---', '2025-10-16 08:21:34', '10', 'Create new Product with beginning balance.', '11700', 'credit', '3167190', 'credit', 'product:96'),
(130, '+256-759912814', 1760602894, '+256-759912814', 'Published', '1760602894', NULL, '---', '2025-10-16 08:21:34', '11', 'Create new Product with beginning balance.', '11700', 'debit', '3167190', 'debit', 'product:96'),
(131, '+256-759912814', 1760603279, '+256-759912814', 'Published', '1760603279', NULL, '---', '2025-10-16 08:27:59', '10', 'Create new Product with beginning balance.', '54000', 'credit', '3221190', 'credit', 'product:97'),
(132, '+256-759912814', 1760603279, '+256-759912814', 'Published', '1760603279', NULL, '---', '2025-10-16 08:27:59', '11', 'Create new Product with beginning balance.', '54000', 'debit', '3221190', 'debit', 'product:97'),
(133, '+256-759912814', 1760603323, '+256-759912814', 'Published', '1760603323', NULL, '---', '2025-10-16 08:28:43', '10', 'Create new Product with beginning balance.', '13800', 'credit', '3234990', 'credit', 'product:98'),
(134, '+256-759912814', 1760603323, '+256-759912814', 'Published', '1760603323', NULL, '---', '2025-10-16 08:28:43', '11', 'Create new Product with beginning balance.', '13800', 'debit', '3234990', 'debit', 'product:98'),
(135, '+256-759912814', 1760603394, '+256-759912814', 'Published', '1760603394', NULL, '---', '2025-10-16 08:29:54', '10', 'Create new Product with beginning balance.', '25000', 'credit', '3259990', 'credit', 'product:99'),
(136, '+256-759912814', 1760603394, '+256-759912814', 'Published', '1760603394', NULL, '---', '2025-10-16 08:29:54', '11', 'Create new Product with beginning balance.', '25000', 'debit', '3259990', 'debit', 'product:99'),
(137, '+256-759912814', 1760603447, '+256-759912814', 'Published', '1760603447', NULL, '---', '2025-10-16 08:30:47', '10', 'Create new Product with beginning balance.', '2500', 'credit', '3262490', 'credit', 'product:100'),
(138, '+256-759912814', 1760603447, '+256-759912814', 'Published', '1760603447', NULL, '---', '2025-10-16 08:30:47', '11', 'Create new Product with beginning balance.', '2500', 'debit', '3262490', 'debit', 'product:100'),
(139, '+256-759912814', 1760603497, '+256-759912814', 'Published', '1760603497', NULL, '---', '2025-10-16 08:31:37', '10', 'Adjust stock: opening balance stock item', '12500', 'credit', '3274990', 'credit', 'product:76'),
(140, '+256-759912814', 1760603497, '+256-759912814', 'Published', '1760603497', NULL, '---', '2025-10-16 08:31:37', '11', 'Adjust stock: opening balance stock item', '12500', 'debit', '3274990', 'debit', 'product:76'),
(141, '+256-759912814', 1760603566, '+256-759912814', 'Published', '1760603566', NULL, '---', '2025-10-16 08:32:46', '10', 'Create new Product with beginning balance.', '108800', 'credit', '3383790', 'credit', 'product:101'),
(142, '+256-759912814', 1760603566, '+256-759912814', 'Published', '1760603566', NULL, '---', '2025-10-16 08:32:46', '11', 'Create new Product with beginning balance.', '108800', 'debit', '3383790', 'debit', 'product:101'),
(143, '+256-759912814', 1760603619, '+256-759912814', 'Published', '1760603619', NULL, '---', '2025-10-16 08:33:39', '10', 'Create new Product with beginning balance.', '130500', 'credit', '3514290', 'credit', 'product:102'),
(144, '+256-759912814', 1760603619, '+256-759912814', 'Published', '1760603619', NULL, '---', '2025-10-16 08:33:39', '11', 'Create new Product with beginning balance.', '130500', 'debit', '3514290', 'debit', 'product:102'),
(145, '+256-759912814', 1760603688, '+256-759912814', 'Published', '1760603688', NULL, '---', '2025-10-16 08:34:48', '10', 'Create new Product with beginning balance.', '80000', 'credit', '3594290', 'credit', 'product:103'),
(146, '+256-759912814', 1760603688, '+256-759912814', 'Published', '1760603688', NULL, '---', '2025-10-16 08:34:48', '11', 'Create new Product with beginning balance.', '80000', 'debit', '3594290', 'debit', 'product:103'),
(147, '+256-759912814', 1760603993, '+256-759912814', 'Published', '1760603993', NULL, '---', '2025-10-16 08:39:53', '10', 'Create new Product with beginning balance.', '2500', 'credit', '3596790', 'credit', 'product:105'),
(148, '+256-759912814', 1760603993, '+256-759912814', 'Published', '1760603993', NULL, '---', '2025-10-16 08:39:53', '11', 'Create new Product with beginning balance.', '2500', 'debit', '3596790', 'debit', 'product:105'),
(149, '+256-759912814', 1760604276, '+256-759912814', 'Published', '1760604276', NULL, '---', '2025-10-16 08:44:36', '10', 'Create new Product with beginning balance.', '18200', 'credit', '3614990', 'credit', 'product:108'),
(150, '+256-759912814', 1760604276, '+256-759912814', 'Published', '1760604276', NULL, '---', '2025-10-16 08:44:36', '11', 'Create new Product with beginning balance.', '18200', 'debit', '3614990', 'debit', 'product:108'),
(151, '+256-759912814', 1760604752, '+256-759912814', 'Published', '1760604752', NULL, '---', '2025-10-16 08:52:32', '10', 'Create new Product with beginning balance.', '22000', 'credit', '3636990', 'credit', 'product:115'),
(152, '+256-759912814', 1760604752, '+256-759912814', 'Published', '1760604752', NULL, '---', '2025-10-16 08:52:32', '11', 'Create new Product with beginning balance.', '22000', 'debit', '3636990', 'debit', 'product:115'),
(153, '+256-759912814', 1760604955, '+256-759912814', 'Published', '1760604955', NULL, '---', '2025-10-16 08:55:55', '10', 'Create new Product with beginning balance.', '11000', 'credit', '3647990', 'credit', 'product:120'),
(154, '+256-759912814', 1760604955, '+256-759912814', 'Published', '1760604955', NULL, '---', '2025-10-16 08:55:55', '11', 'Create new Product with beginning balance.', '11000', 'debit', '3647990', 'debit', 'product:120'),
(155, '+256-759912814', 1760604996, '+256-759912814', 'Published', '1760604996', NULL, '---', '2025-10-16 08:56:36', '10', 'Create new Product with beginning balance.', '33000', 'credit', '3680990', 'credit', 'product:121'),
(156, '+256-759912814', 1760604996, '+256-759912814', 'Published', '1760604996', NULL, '---', '2025-10-16 08:56:36', '11', 'Create new Product with beginning balance.', '33000', 'debit', '3680990', 'debit', 'product:121'),
(157, '+256-759912814', 1760605069, '+256-759912814', 'Published', '1760605069', NULL, '---', '2025-10-16 08:57:49', '10', 'Create new Product with beginning balance.', '88182', 'credit', '3769172', 'credit', 'product:123'),
(158, '+256-759912814', 1760605069, '+256-759912814', 'Published', '1760605069', NULL, '---', '2025-10-16 08:57:49', '11', 'Create new Product with beginning balance.', '88182', 'debit', '3769172', 'debit', 'product:123'),
(159, '+256-759912814', 1760605161, '+256-759912814', 'Published', '1760605161', NULL, '---', '2025-10-16 08:59:21', '10', 'Create new Product with beginning balance.', '75000', 'credit', '3844172', 'credit', 'product:125'),
(160, '+256-759912814', 1760605161, '+256-759912814', 'Published', '1760605161', NULL, '---', '2025-10-16 08:59:21', '11', 'Create new Product with beginning balance.', '75000', 'debit', '3844172', 'debit', 'product:125'),
(161, '+256-759912814', 1760605380, '+256-759912814', 'Published', '1760605380', NULL, '---', '2025-10-16 09:03:00', '10', 'Create new Product with beginning balance.', '274700', 'credit', '4118872', 'credit', 'product:126'),
(162, '+256-759912814', 1760605380, '+256-759912814', 'Published', '1760605380', NULL, '---', '2025-10-16 09:03:00', '11', 'Create new Product with beginning balance.', '274700', 'debit', '4118872', 'debit', 'product:126'),
(163, '+256-759912814', 1760605474, '+256-759912814', 'Published', '1760605474', NULL, '---', '2025-10-16 09:04:34', '10', 'Create new Product with beginning balance.', '84000', 'credit', '4202872', 'credit', 'product:128'),
(164, '+256-759912814', 1760605474, '+256-759912814', 'Published', '1760605474', NULL, '---', '2025-10-16 09:04:34', '11', 'Create new Product with beginning balance.', '84000', 'debit', '4202872', 'debit', 'product:128'),
(165, '+256-759912814', 1760605517, '+256-759912814', 'Published', '1760605517', NULL, '---', '2025-10-16 09:05:17', '10', 'Create new Product with beginning balance.', '81000', 'credit', '4283872', 'credit', 'product:129'),
(166, '+256-759912814', 1760605517, '+256-759912814', 'Published', '1760605517', NULL, '---', '2025-10-16 09:05:17', '11', 'Create new Product with beginning balance.', '81000', 'debit', '4283872', 'debit', 'product:129'),
(167, '+256-759912814', 1760605556, '+256-759912814', 'Published', '1760605556', NULL, '---', '2025-10-16 09:05:56', '10', 'Create new Product with beginning balance.', '25500', 'credit', '4309372', 'credit', 'product:130'),
(168, '+256-759912814', 1760605556, '+256-759912814', 'Published', '1760605556', NULL, '---', '2025-10-16 09:05:56', '11', 'Create new Product with beginning balance.', '25500', 'debit', '4309372', 'debit', 'product:130'),
(169, '+256-759912814', 1760605852, '+256-759912814', 'Published', '1760605852', NULL, '---', '2025-10-16 09:10:52', '10', 'Create new Product with beginning balance.', '42000', 'credit', '4351372', 'credit', 'product:132'),
(170, '+256-759912814', 1760605852, '+256-759912814', 'Published', '1760605852', NULL, '---', '2025-10-16 09:10:52', '11', 'Create new Product with beginning balance.', '42000', 'debit', '4351372', 'debit', 'product:132'),
(171, '+256-759912814', 1760606067, '+256-759912814', 'Published', '1760606067', NULL, '---', '2025-10-16 09:14:27', '10', 'Create new Product with beginning balance.', '64000', 'credit', '4415372', 'credit', 'product:135'),
(172, '+256-759912814', 1760606067, '+256-759912814', 'Published', '1760606067', NULL, '---', '2025-10-16 09:14:27', '11', 'Create new Product with beginning balance.', '64000', 'debit', '4415372', 'debit', 'product:135'),
(173, '+256-759912814', 1760606454, '+256-759912814', 'Published', '1760606454', NULL, '---', '2025-10-16 09:20:54', '10', 'Create new Product with beginning balance.', '80000', 'credit', '4495372', 'credit', 'product:140'),
(174, '+256-759912814', 1760606454, '+256-759912814', 'Published', '1760606454', NULL, '---', '2025-10-16 09:20:54', '11', 'Create new Product with beginning balance.', '80000', 'debit', '4495372', 'debit', 'product:140'),
(175, '+256-759912814', 1760606624, '+256-759912814', 'Published', '1760606624', NULL, '---', '2025-10-16 09:23:44', '10', 'Adjust stock: opening balance stock item', '17500', 'credit', '4512872', 'credit', 'product:7'),
(176, '+256-759912814', 1760606624, '+256-759912814', 'Published', '1760606624', NULL, '---', '2025-10-16 09:23:44', '11', 'Adjust stock: opening balance stock item', '17500', 'debit', '4512872', 'debit', 'product:7'),
(177, '+256-759912814', 1760606675, '+256-759912814', 'Published', '1760606675', NULL, '---', '2025-10-16 09:24:35', '10', 'Adjust stock: opening balance stock item', '2300', 'credit', '4515172', 'credit', 'product:98'),
(178, '+256-759912814', 1760606675, '+256-759912814', 'Published', '1760606675', NULL, '---', '2025-10-16 09:24:35', '11', 'Adjust stock: opening balance stock item', '2300', 'debit', '4515172', 'debit', 'product:98'),
(179, '+256-759912814', 1760606812, '+256-759912814', 'Published', '1760606812', NULL, '---', '2025-10-16 09:26:52', '10', 'Create new Product with beginning balance.', '90000', 'credit', '4605172', 'credit', 'product:143'),
(180, '+256-759912814', 1760606812, '+256-759912814', 'Published', '1760606812', NULL, '---', '2025-10-16 09:26:52', '11', 'Create new Product with beginning balance.', '90000', 'debit', '4605172', 'debit', 'product:143'),
(181, '+256-759912814', 1760607178, '+256-759912814', 'Published', '1760607178', NULL, '---', '2025-10-16 09:32:58', '10', 'Create new Product with beginning balance.', '21000', 'credit', '4626172', 'credit', 'product:144'),
(182, '+256-759912814', 1760607178, '+256-759912814', 'Published', '1760607178', NULL, '---', '2025-10-16 09:32:58', '11', 'Create new Product with beginning balance.', '21000', 'debit', '4626172', 'debit', 'product:144'),
(183, '+256-759912814', 1760607291, '+256-759912814', 'Published', '1760607291', NULL, '---', '2025-10-16 09:34:51', '10', 'Create new Product with beginning balance.', '1500', 'credit', '4627672', 'credit', 'product:145'),
(184, '+256-759912814', 1760607291, '+256-759912814', 'Published', '1760607291', NULL, '---', '2025-10-16 09:34:51', '11', 'Create new Product with beginning balance.', '1500', 'debit', '4627672', 'debit', 'product:145'),
(185, '+256-759912814', 1760607334, '+256-759912814', 'Published', '1760607334', NULL, '---', '2025-10-16 09:35:34', '10', 'Create new Product with beginning balance.', '30000', 'credit', '4657672', 'credit', 'product:146'),
(186, '+256-759912814', 1760607334, '+256-759912814', 'Published', '1760607334', NULL, '---', '2025-10-16 09:35:34', '11', 'Create new Product with beginning balance.', '30000', 'debit', '4657672', 'debit', 'product:146'),
(187, '+256-759912814', 1760607368, '+256-759912814', 'Published', '1760607368', NULL, '---', '2025-10-16 09:36:08', '10', 'Create new Product with beginning balance.', '1500', 'credit', '4659172', 'credit', 'product:147'),
(188, '+256-759912814', 1760607368, '+256-759912814', 'Published', '1760607368', NULL, '---', '2025-10-16 09:36:08', '11', 'Create new Product with beginning balance.', '1500', 'debit', '4659172', 'debit', 'product:147'),
(189, '+256-759912814', 1760607545, '+256-759912814', 'Published', '1760607545', NULL, '---', '2025-10-16 09:39:05', '10', 'Create new Product with beginning balance.', '52000', 'credit', '4711172', 'credit', 'product:150'),
(190, '+256-759912814', 1760607545, '+256-759912814', 'Published', '1760607545', NULL, '---', '2025-10-16 09:39:05', '11', 'Create new Product with beginning balance.', '52000', 'debit', '4711172', 'debit', 'product:150'),
(191, '+256-759912814', 1760607674, '+256-759912814', 'Published', '1760607674', NULL, '---', '2025-10-16 09:41:14', '10', 'Create new Product with beginning balance.', '100000', 'credit', '4811172', 'credit', 'product:151'),
(192, '+256-759912814', 1760607674, '+256-759912814', 'Published', '1760607674', NULL, '---', '2025-10-16 09:41:14', '11', 'Create new Product with beginning balance.', '100000', 'debit', '4811172', 'debit', 'product:151'),
(193, '+256-759912814', 1760607727, '+256-759912814', 'Published', '1760607727', NULL, '---', '2025-10-16 09:42:07', '10', 'Create new Product with beginning balance.', '60000', 'credit', '4871172', 'credit', 'product:152'),
(194, '+256-759912814', 1760607727, '+256-759912814', 'Published', '1760607727', NULL, '---', '2025-10-16 09:42:07', '11', 'Create new Product with beginning balance.', '60000', 'debit', '4871172', 'debit', 'product:152'),
(195, '+256-759912814', 1760608184, '+256-759912814', 'Published', '1760608184', NULL, '---', '2025-10-16 09:49:44', '10', 'Create new Product with beginning balance.', '30000', 'credit', '4901172', 'credit', 'product:154'),
(196, '+256-759912814', 1760608184, '+256-759912814', 'Published', '1760608184', NULL, '---', '2025-10-16 09:49:44', '11', 'Create new Product with beginning balance.', '30000', 'debit', '4901172', 'debit', 'product:154'),
(197, '+256-759912814', 1760608229, '+256-759912814', 'Published', '1760608229', NULL, '---', '2025-10-16 09:50:29', '10', 'Create new Product with beginning balance.', '13500', 'credit', '4914672', 'credit', 'product:155'),
(198, '+256-759912814', 1760608229, '+256-759912814', 'Published', '1760608229', NULL, '---', '2025-10-16 09:50:29', '11', 'Create new Product with beginning balance.', '13500', 'debit', '4914672', 'debit', 'product:155'),
(199, '+256-759912814', 1760608369, '+256-759912814', 'Published', '1760608369', NULL, '---', '2025-10-16 09:52:49', '10', 'Create new Product with beginning balance.', '48000', 'credit', '4962672', 'credit', 'product:157'),
(200, '+256-759912814', 1760608369, '+256-759912814', 'Published', '1760608369', NULL, '---', '2025-10-16 09:52:49', '11', 'Create new Product with beginning balance.', '48000', 'debit', '4962672', 'debit', 'product:157'),
(201, '+256-759912814', 1760608457, '+256-759912814', 'Published', '1760608457', NULL, '---', '2025-10-16 09:54:17', '10', 'Create new Product with beginning balance.', '5000', 'credit', '4967672', 'credit', 'product:159'),
(202, '+256-759912814', 1760608457, '+256-759912814', 'Published', '1760608457', NULL, '---', '2025-10-16 09:54:17', '11', 'Create new Product with beginning balance.', '5000', 'debit', '4967672', 'debit', 'product:159'),
(203, '+256-759912814', 1760608541, '+256-759912814', 'Published', '1760608541', NULL, '---', '2025-10-16 09:55:41', '10', 'Create new Product with beginning balance.', '52500', 'credit', '5020172', 'credit', 'product:161'),
(204, '+256-759912814', 1760608541, '+256-759912814', 'Published', '1760608541', NULL, '---', '2025-10-16 09:55:41', '11', 'Create new Product with beginning balance.', '52500', 'debit', '5020172', 'debit', 'product:161'),
(205, '+256-759912814', 1760609045, '+256-759912814', 'Published', '1760609045', NULL, '---', '2025-10-16 10:04:05', '10', 'Create new Product with beginning balance.', '292500', 'credit', '5312672', 'credit', 'product:165'),
(206, '+256-759912814', 1760609045, '+256-759912814', 'Published', '1760609045', NULL, '---', '2025-10-16 10:04:05', '11', 'Create new Product with beginning balance.', '292500', 'debit', '5312672', 'debit', 'product:165'),
(207, '+256-759912814', 1760609128, '+256-759912814', 'Published', '1760609128', NULL, '---', '2025-10-16 10:05:28', '10', 'Create new Product with beginning balance.', '9000', 'credit', '5321672', 'credit', 'product:167'),
(208, '+256-759912814', 1760609128, '+256-759912814', 'Published', '1760609128', NULL, '---', '2025-10-16 10:05:28', '11', 'Create new Product with beginning balance.', '9000', 'debit', '5321672', 'debit', 'product:167'),
(209, '+256-759912814', 1760609235, '+256-759912814', 'Published', '1760609235', NULL, '---', '2025-10-16 10:07:15', '10', 'Create new Product with beginning balance.', '1500', 'credit', '5323172', 'credit', 'product:170'),
(210, '+256-759912814', 1760609235, '+256-759912814', 'Published', '1760609235', NULL, '---', '2025-10-16 10:07:15', '11', 'Create new Product with beginning balance.', '1500', 'debit', '5323172', 'debit', 'product:170'),
(211, '+256-759912814', 1760609267, '+256-759912814', 'Published', '1760609267', NULL, '---', '2025-10-16 10:07:47', '10', 'Create new Product with beginning balance.', '45900', 'credit', '5369072', 'credit', 'product:171'),
(212, '+256-759912814', 1760609267, '+256-759912814', 'Published', '1760609267', NULL, '---', '2025-10-16 10:07:47', '11', 'Create new Product with beginning balance.', '45900', 'debit', '5369072', 'debit', 'product:171'),
(213, '+256-759912814', 1760609463, '+256-759912814', 'Published', '1760609463', NULL, '---', '2025-10-16 10:11:03', '10', 'Create new Product with beginning balance.', '19500', 'credit', '5388572', 'credit', 'product:172'),
(214, '+256-759912814', 1760609463, '+256-759912814', 'Published', '1760609463', NULL, '---', '2025-10-16 10:11:03', '11', 'Create new Product with beginning balance.', '19500', 'debit', '5388572', 'debit', 'product:172'),
(215, '+256-759912814', 1760609777, '+256-759912814', 'Published', '1760609777', NULL, '---', '2025-10-16 10:16:17', '10', 'Create new Product with beginning balance.', '31600', 'credit', '5420172', 'credit', 'product:178'),
(216, '+256-759912814', 1760609777, '+256-759912814', 'Published', '1760609777', NULL, '---', '2025-10-16 10:16:17', '11', 'Create new Product with beginning balance.', '31600', 'debit', '5420172', 'debit', 'product:178'),
(217, '+256-759912814', 1760609905, '+256-759912814', 'Published', '1760609905', NULL, '---', '2025-10-16 10:18:25', '10', 'Create new Product with beginning balance.', '23000', 'credit', '5443172', 'credit', 'product:181'),
(218, '+256-759912814', 1760609905, '+256-759912814', 'Published', '1760609905', NULL, '---', '2025-10-16 10:18:25', '11', 'Create new Product with beginning balance.', '23000', 'debit', '5443172', 'debit', 'product:181'),
(219, '+256-759912814', 1760610098, '+256-759912814', 'Published', '1760610098', NULL, '---', '2025-10-16 10:21:38', '10', 'Create new Product with beginning balance.', '44000', 'credit', '5487172', 'credit', 'product:182'),
(220, '+256-759912814', 1760610098, '+256-759912814', 'Published', '1760610098', NULL, '---', '2025-10-16 10:21:38', '11', 'Create new Product with beginning balance.', '44000', 'debit', '5487172', 'debit', 'product:182'),
(221, '+256-759912814', 1760610163, '+256-759912814', 'Published', '1760610163', NULL, '---', '2025-10-16 10:22:43', '10', 'Create new Product with beginning balance.', '4200', 'credit', '5491372', 'credit', 'product:183'),
(222, '+256-759912814', 1760610163, '+256-759912814', 'Published', '1760610163', NULL, '---', '2025-10-16 10:22:43', '11', 'Create new Product with beginning balance.', '4200', 'debit', '5491372', 'debit', 'product:183'),
(223, '+256-759912814', 1760610237, '+256-759912814', 'Published', '1760610237', NULL, '---', '2025-10-16 10:23:57', '10', 'Create new Product with beginning balance.', '15000', 'credit', '5506372', 'credit', 'product:184'),
(224, '+256-759912814', 1760610237, '+256-759912814', 'Published', '1760610237', NULL, '---', '2025-10-16 10:23:57', '11', 'Create new Product with beginning balance.', '15000', 'debit', '5506372', 'debit', 'product:184'),
(225, '+256-759912814', 1760776776, '+256-759912814', 'Published', '1760776776', NULL, '---', '2025-10-18 08:39:36', '10', 'Create new Product with beginning balance.', '50000', 'credit', '5556372', 'credit', 'product:187');
INSERT INTO `ledger` (`id`, `owner_mobile`, `timestamp`, `added_by`, `status`, `last_updated`, `sync`, `---`, `date`, `account_id`, `description`, `amount`, `amount_type`, `balance`, `balance_type`, `entry_link`) VALUES
(226, '+256-759912814', 1760776776, '+256-759912814', 'Published', '1760776776', NULL, '---', '2025-10-18 08:39:36', '11', 'Create new Product with beginning balance.', '50000', 'debit', '5556372', 'debit', 'product:187'),
(227, '+256-759912814', 1760776829, '+256-759912814', 'Published', '1760776829', NULL, '---', '2025-10-18 08:40:29', '10', 'Create new Product with beginning balance.', '176000', 'credit', '5732372', 'credit', 'product:188'),
(228, '+256-759912814', 1760776829, '+256-759912814', 'Published', '1760776829', NULL, '---', '2025-10-18 08:40:29', '11', 'Create new Product with beginning balance.', '176000', 'debit', '5732372', 'debit', 'product:188'),
(229, '+256-759912814', 1760776887, '+256-759912814', 'Published', '1760776887', NULL, '---', '2025-10-18 08:41:27', '10', 'Create new Product with beginning balance.', '396000', 'credit', '6128372', 'credit', 'product:189'),
(230, '+256-759912814', 1760776887, '+256-759912814', 'Published', '1760776887', NULL, '---', '2025-10-18 08:41:27', '11', 'Create new Product with beginning balance.', '396000', 'debit', '6128372', 'debit', 'product:189'),
(231, '+256-759912814', 1760776941, '+256-759912814', 'Published', '1760776941', NULL, '---', '2025-10-18 08:42:21', '10', 'Create new Product with beginning balance.', '144000', 'credit', '6272372', 'credit', 'product:190'),
(232, '+256-759912814', 1760776941, '+256-759912814', 'Published', '1760776941', NULL, '---', '2025-10-18 08:42:21', '11', 'Create new Product with beginning balance.', '144000', 'debit', '6272372', 'debit', 'product:190'),
(233, '+256-759912814', 1760777081, '+256-759912814', 'Published', '1760777081', NULL, '---', '2025-10-18 08:44:41', '10', 'Create new Product with beginning balance.', '312000', 'credit', '6584372', 'credit', 'product:191'),
(234, '+256-759912814', 1760777081, '+256-759912814', 'Published', '1760777081', NULL, '---', '2025-10-18 08:44:41', '11', 'Create new Product with beginning balance.', '312000', 'debit', '6584372', 'debit', 'product:191'),
(235, '+256-759912814', 1760777131, '+256-759912814', 'Published', '1760777131', NULL, '---', '2025-10-18 08:45:31', '10', 'Create new Product with beginning balance.', '40000', 'credit', '6624372', 'credit', 'product:192'),
(236, '+256-759912814', 1760777131, '+256-759912814', 'Published', '1760777131', NULL, '---', '2025-10-18 08:45:31', '11', 'Create new Product with beginning balance.', '40000', 'debit', '6624372', 'debit', 'product:192'),
(237, '+256-759912814', 1760777372, '+256-759912814', 'Published', '1760777372', NULL, '---', '2025-10-18 08:49:32', '10', 'Create new Product with beginning balance.', '22000', 'credit', '6646372', 'credit', 'product:193'),
(238, '+256-759912814', 1760777372, '+256-759912814', 'Published', '1760777372', NULL, '---', '2025-10-18 08:49:32', '11', 'Create new Product with beginning balance.', '22000', 'debit', '6646372', 'debit', 'product:193'),
(239, '+256-759912814', 1760778026, '+256-759912814', 'Published', '1760778026', NULL, '---', '2025-10-18 09:00:26', '10', 'Create new Product with beginning balance.', '984000', 'credit', '7630372', 'credit', 'product:194'),
(240, '+256-759912814', 1760778026, '+256-759912814', 'Published', '1760778026', NULL, '---', '2025-10-18 09:00:26', '11', 'Create new Product with beginning balance.', '984000', 'debit', '7630372', 'debit', 'product:194'),
(241, '+256-759912814', 1760778116, '+256-759912814', 'Published', '1760778116', NULL, '---', '2025-10-18 09:01:56', '10', 'Create new Product with beginning balance.', '451500', 'credit', '8081872', 'credit', 'product:195'),
(242, '+256-759912814', 1760778116, '+256-759912814', 'Published', '1760778116', NULL, '---', '2025-10-18 09:01:56', '11', 'Create new Product with beginning balance.', '451500', 'debit', '8081872', 'debit', 'product:195'),
(243, '+256-759912814', 1760778193, '+256-759912814', 'Published', '1760778193', NULL, '---', '2025-10-18 09:03:13', '10', 'Create new Product with beginning balance.', '168000', 'credit', '8249872', 'credit', 'product:196'),
(244, '+256-759912814', 1760778193, '+256-759912814', 'Published', '1760778193', NULL, '---', '2025-10-18 09:03:13', '11', 'Create new Product with beginning balance.', '168000', 'debit', '8249872', 'debit', 'product:196'),
(245, '+256-759912814', 1760778259, '+256-759912814', 'Published', '1760778259', NULL, '---', '2025-10-18 09:04:19', '10', 'Create new Product with beginning balance.', '198000', 'credit', '8447872', 'credit', 'product:197'),
(246, '+256-759912814', 1760778259, '+256-759912814', 'Published', '1760778259', NULL, '---', '2025-10-18 09:04:19', '11', 'Create new Product with beginning balance.', '198000', 'debit', '8447872', 'debit', 'product:197'),
(247, '+256-759912814', 1760778356, '+256-759912814', 'Published', '1760778356', NULL, '---', '2025-10-18 09:05:56', '10', 'Create new Product with beginning balance.', '486000', 'credit', '8933872', 'credit', 'product:198'),
(248, '+256-759912814', 1760778356, '+256-759912814', 'Published', '1760778356', NULL, '---', '2025-10-18 09:05:56', '11', 'Create new Product with beginning balance.', '486000', 'debit', '8933872', 'debit', 'product:198'),
(249, '+256-759912814', 1760778425, '+256-759912814', 'Published', '1760778425', NULL, '---', '2025-10-18 09:07:05', '10', 'Create new Product with beginning balance.', '253000', 'credit', '9186872', 'credit', 'product:199'),
(250, '+256-759912814', 1760778425, '+256-759912814', 'Published', '1760778425', NULL, '---', '2025-10-18 09:07:05', '11', 'Create new Product with beginning balance.', '253000', 'debit', '9186872', 'debit', 'product:199'),
(251, '+256-759912814', 1760778594, '+256-759912814', 'Published', '1760778594', NULL, '---', '2025-10-18 09:09:54', '10', 'Create new Product with beginning balance.', '125000', 'credit', '9311872', 'credit', 'product:200'),
(252, '+256-759912814', 1760778594, '+256-759912814', 'Published', '1760778594', NULL, '---', '2025-10-18 09:09:54', '11', 'Create new Product with beginning balance.', '125000', 'debit', '9311872', 'debit', 'product:200'),
(253, '+256-759912814', 1760778652, '+256-759912814', 'Published', '1760778652', NULL, '---', '2025-10-18 09:10:52', '10', 'Adjust stock: opening balance stock item', '100000', 'credit', '9411872', 'credit', 'product:193'),
(254, '+256-759912814', 1760778652, '+256-759912814', 'Published', '1760778652', NULL, '---', '2025-10-18 09:10:52', '11', 'Adjust stock: opening balance stock item', '100000', 'debit', '9411872', 'debit', 'product:193'),
(255, '+256-759912814', 1760778888, '+256-759912814', 'Published', '1760778888', NULL, '---', '2025-10-18 09:14:48', '10', 'Adjust stock: opening balance stock item', '50000', 'credit', '9461872', 'credit', 'product:200'),
(256, '+256-759912814', 1760778888, '+256-759912814', 'Published', '1760778888', NULL, '---', '2025-10-18 09:14:48', '11', 'Adjust stock: opening balance stock item', '50000', 'debit', '9461872', 'debit', 'product:200'),
(257, '+256-759912814', 1760778896, '+256-759912814', 'Published', '1760778896', NULL, '---', '2025-10-18 09:14:56', '10', 'Adjust stock: opening balance stock item', '100000', 'credit', '9561872', 'credit', 'product:200'),
(258, '+256-759912814', 1760778896, '+256-759912814', 'Published', '1760778896', NULL, '---', '2025-10-18 09:14:56', '11', 'Adjust stock: opening balance stock item', '100000', 'debit', '9561872', 'debit', 'product:200'),
(259, '+256-759912814', 1760778961, '+256-759912814', 'Published', '1760778961', NULL, '---', '2025-10-18 09:16:01', '10', 'Create new Product with beginning balance.', '24000', 'credit', '9585872', 'credit', 'product:201'),
(260, '+256-759912814', 1760778961, '+256-759912814', 'Published', '1760778961', NULL, '---', '2025-10-18 09:16:01', '11', 'Create new Product with beginning balance.', '24000', 'debit', '9585872', 'debit', 'product:201'),
(261, '+256-759912814', 1760779070, '+256-759912814', 'Published', '1760779070', NULL, '---', '2025-10-18 09:17:50', '10', 'Create new Product with beginning balance.', '42000', 'credit', '9627872', 'credit', 'product:202'),
(262, '+256-759912814', 1760779070, '+256-759912814', 'Published', '1760779070', NULL, '---', '2025-10-18 09:17:50', '11', 'Create new Product with beginning balance.', '42000', 'debit', '9627872', 'debit', 'product:202'),
(263, '+256-759912814', 1760779308, '+256-759912814', 'Published', '1760779308', NULL, '---', '2025-10-18 09:21:48', '10', 'Create new Product with beginning balance.', '35000', 'credit', '9662872', 'credit', 'product:203'),
(264, '+256-759912814', 1760779308, '+256-759912814', 'Published', '1760779308', NULL, '---', '2025-10-18 09:21:48', '11', 'Create new Product with beginning balance.', '35000', 'debit', '9662872', 'debit', 'product:203'),
(265, '+256-759912814', 1760779367, '+256-759912814', 'Published', '1760779367', NULL, '---', '2025-10-18 09:22:47', '10', 'Create new Product with beginning balance.', '70000', 'credit', '9732872', 'credit', 'product:204'),
(266, '+256-759912814', 1760779367, '+256-759912814', 'Published', '1760779367', NULL, '---', '2025-10-18 09:22:47', '11', 'Create new Product with beginning balance.', '70000', 'debit', '9732872', 'debit', 'product:204'),
(267, '+256-759912814', 1760779465, '+256-759912814', 'Published', '1760779465', NULL, '---', '2025-10-18 09:24:25', '10', 'Create new Product with beginning balance.', '12000', 'credit', '9744872', 'credit', 'product:205'),
(268, '+256-759912814', 1760779465, '+256-759912814', 'Published', '1760779465', NULL, '---', '2025-10-18 09:24:25', '11', 'Create new Product with beginning balance.', '12000', 'debit', '9744872', 'debit', 'product:205'),
(269, '+256-759912814', 1760779516, '+256-759912814', 'Published', '1760779516', NULL, '---', '2025-10-18 09:25:16', '10', 'Create new Product with beginning balance.', '30000', 'credit', '9774872', 'credit', 'product:206'),
(270, '+256-759912814', 1760779516, '+256-759912814', 'Published', '1760779516', NULL, '---', '2025-10-18 09:25:16', '11', 'Create new Product with beginning balance.', '30000', 'debit', '9774872', 'debit', 'product:206'),
(271, '+256-759912814', 1760779563, '+256-759912814', 'Published', '1760779563', NULL, '---', '2025-10-18 09:26:03', '10', 'Create new Product with beginning balance.', '50000', 'credit', '9824872', 'credit', 'product:207'),
(272, '+256-759912814', 1760779563, '+256-759912814', 'Published', '1760779563', NULL, '---', '2025-10-18 09:26:03', '11', 'Create new Product with beginning balance.', '50000', 'debit', '9824872', 'debit', 'product:207'),
(273, '+256-759912814', 1760779638, '+256-759912814', 'Published', '1760779638', NULL, '---', '2025-10-18 09:27:18', '10', 'Create new Product with beginning balance.', '45000', 'credit', '9869872', 'credit', 'product:208'),
(274, '+256-759912814', 1760779638, '+256-759912814', 'Published', '1760779638', NULL, '---', '2025-10-18 09:27:18', '11', 'Create new Product with beginning balance.', '45000', 'debit', '9869872', 'debit', 'product:208'),
(275, '+256-759912814', 1760779896, '+256-759912814', 'Published', '1760779896', NULL, '---', '2025-10-18 09:31:36', '10', 'Create new Product with beginning balance.', '35000', 'credit', '9904872', 'credit', 'product:210'),
(276, '+256-759912814', 1760779896, '+256-759912814', 'Published', '1760779896', NULL, '---', '2025-10-18 09:31:36', '11', 'Create new Product with beginning balance.', '35000', 'debit', '9904872', 'debit', 'product:210'),
(277, '+256-759912814', 1760780089, '+256-759912814', 'Published', '1760780089', NULL, '---', '2025-10-18 09:34:49', '10', 'Adjust stock: opening balance stock item', '119000', 'credit', '10023872', 'credit', 'product:209'),
(278, '+256-759912814', 1760780089, '+256-759912814', 'Published', '1760780089', NULL, '---', '2025-10-18 09:34:49', '11', 'Adjust stock: opening balance stock item', '119000', 'debit', '10023872', 'debit', 'product:209'),
(279, '+256-759912814', 1760780142, '+256-759912814', 'Published', '1760780142', NULL, '---', '2025-10-18 09:35:42', '10', 'Create new Product with beginning balance.', '17000', 'credit', '10040872', 'credit', 'product:211'),
(280, '+256-759912814', 1760780142, '+256-759912814', 'Published', '1760780142', NULL, '---', '2025-10-18 09:35:42', '11', 'Create new Product with beginning balance.', '17000', 'debit', '10040872', 'debit', 'product:211'),
(281, '+256-759912814', 1760780195, '+256-759912814', 'Published', '1760780195', NULL, '---', '2025-10-18 09:36:35', '10', 'Create new Product with beginning balance.', '26000', 'credit', '10066872', 'credit', 'product:212'),
(282, '+256-759912814', 1760780195, '+256-759912814', 'Published', '1760780195', NULL, '---', '2025-10-18 09:36:35', '11', 'Create new Product with beginning balance.', '26000', 'debit', '10066872', 'debit', 'product:212'),
(283, '+256-759912814', 1760780291, '+256-759912814', 'Published', '1760780291', NULL, '---', '2025-10-18 09:38:11', '10', 'Create new Product with beginning balance.', '21500', 'credit', '10088372', 'credit', 'product:214'),
(284, '+256-759912814', 1760780291, '+256-759912814', 'Published', '1760780291', NULL, '---', '2025-10-18 09:38:11', '11', 'Create new Product with beginning balance.', '21500', 'debit', '10088372', 'debit', 'product:214'),
(285, '+256-759912814', 1760780384, '+256-759912814', 'Published', '1760780384', NULL, '---', '2025-10-18 09:39:44', '10', 'Create new Product with beginning balance.', '25500', 'credit', '10113872', 'credit', 'product:216'),
(286, '+256-759912814', 1760780384, '+256-759912814', 'Published', '1760780384', NULL, '---', '2025-10-18 09:39:44', '11', 'Create new Product with beginning balance.', '25500', 'debit', '10113872', 'debit', 'product:216'),
(287, '+256-759912814', 1760780466, '+256-759912814', 'Published', '1760780466', NULL, '---', '2025-10-18 09:41:06', '10', 'Create new Product with beginning balance.', '33000', 'credit', '10146872', 'credit', 'product:218'),
(288, '+256-759912814', 1760780466, '+256-759912814', 'Published', '1760780466', NULL, '---', '2025-10-18 09:41:06', '11', 'Create new Product with beginning balance.', '33000', 'debit', '10146872', 'debit', 'product:218'),
(289, '+256-759912814', 1760780618, '+256-759912814', 'Published', '1760780618', NULL, '---', '2025-10-18 09:43:38', '10', 'Create new Product with beginning balance.', '84000', 'credit', '10230872', 'credit', 'product:221'),
(290, '+256-759912814', 1760780618, '+256-759912814', 'Published', '1760780618', NULL, '---', '2025-10-18 09:43:38', '11', 'Create new Product with beginning balance.', '84000', 'debit', '10230872', 'debit', 'product:221'),
(291, '+256-759912814', 1760780924, '+256-759912814', 'Published', '1760780924', NULL, '---', '2025-10-18 09:48:44', '10', 'Create new Product with beginning balance.', '570000', 'credit', '10800872', 'credit', 'product:227'),
(292, '+256-759912814', 1760780924, '+256-759912814', 'Published', '1760780924', NULL, '---', '2025-10-18 09:48:44', '11', 'Create new Product with beginning balance.', '570000', 'debit', '10800872', 'debit', 'product:227'),
(293, '+256-759912814', 1760780965, '+256-759912814', 'Published', '1760780965', NULL, '---', '2025-10-18 09:49:25', '10', 'Create new Product with beginning balance.', '11000', 'credit', '10811872', 'credit', 'product:228'),
(294, '+256-759912814', 1760780965, '+256-759912814', 'Published', '1760780965', NULL, '---', '2025-10-18 09:49:25', '11', 'Create new Product with beginning balance.', '11000', 'debit', '10811872', 'debit', 'product:228'),
(295, '+256-759912814', 1760781114, '+256-759912814', 'Published', '1760781114', NULL, '---', '2025-10-18 09:51:54', '10', 'Create new Product with beginning balance.', '37500', 'credit', '10849372', 'credit', 'product:231'),
(296, '+256-759912814', 1760781114, '+256-759912814', 'Published', '1760781114', NULL, '---', '2025-10-18 09:51:54', '11', 'Create new Product with beginning balance.', '37500', 'debit', '10849372', 'debit', 'product:231'),
(297, '+256-759912814', 1760781277, '+256-759912814', 'Published', '1760781277', NULL, '---', '2025-10-18 09:54:37', '10', 'Adjust stock: opening balance stock item', '240000', 'credit', '11089372', 'credit', 'product:189'),
(298, '+256-759912814', 1760781277, '+256-759912814', 'Published', '1760781277', NULL, '---', '2025-10-18 09:54:37', '11', 'Adjust stock: opening balance stock item', '240000', 'debit', '11089372', 'debit', 'product:189'),
(299, '+256-759912814', 1760781338, '+256-759912814', 'Published', '1760781338', NULL, '---', '2025-10-18 09:55:38', '10', 'Create new Product with beginning balance.', '72000', 'credit', '11161372', 'credit', 'product:236'),
(300, '+256-759912814', 1760781338, '+256-759912814', 'Published', '1760781338', NULL, '---', '2025-10-18 09:55:38', '11', 'Create new Product with beginning balance.', '72000', 'debit', '11161372', 'debit', 'product:236'),
(301, '+256-759912814', 1760781418, '+256-759912814', 'Published', '1760781418', NULL, '---', '2025-10-18 09:56:58', '10', 'Create new Product with beginning balance.', '252000', 'credit', '11413372', 'credit', 'product:237'),
(302, '+256-759912814', 1760781418, '+256-759912814', 'Published', '1760781418', NULL, '---', '2025-10-18 09:56:58', '11', 'Create new Product with beginning balance.', '252000', 'debit', '11413372', 'debit', 'product:237'),
(303, '+256-759912814', 1760781586, '+256-759912814', 'Published', '1760781586', NULL, '---', '2025-10-18 09:59:46', '10', 'Create new Product with beginning balance.', '216000', 'credit', '11629372', 'credit', 'product:239'),
(304, '+256-759912814', 1760781586, '+256-759912814', 'Published', '1760781586', NULL, '---', '2025-10-18 09:59:46', '11', 'Create new Product with beginning balance.', '216000', 'debit', '11629372', 'debit', 'product:239'),
(305, '+256-759912814', 1760781627, '+256-759912814', 'Published', '1760781627', NULL, '---', '2025-10-18 10:00:27', '10', 'Create new Product with beginning balance.', '79500', 'credit', '11708872', 'credit', 'product:240'),
(306, '+256-759912814', 1760781627, '+256-759912814', 'Published', '1760781627', NULL, '---', '2025-10-18 10:00:27', '11', 'Create new Product with beginning balance.', '79500', 'debit', '11708872', 'debit', 'product:240'),
(307, '+256-759912814', 1760781726, '+256-759912814', 'Published', '1760781726', NULL, '---', '2025-10-18 10:02:06', '10', 'Adjust stock: opening balance stock item', '912000', 'credit', '12620872', 'credit', 'product:194'),
(308, '+256-759912814', 1760781726, '+256-759912814', 'Published', '1760781726', NULL, '---', '2025-10-18 10:02:06', '11', 'Adjust stock: opening balance stock item', '912000', 'debit', '12620872', 'debit', 'product:194'),
(309, '+256-759912814', 1760782543, '+256-759912814', 'Published', '1760782543', NULL, '---', '2025-10-18 10:15:43', '10', 'Create new Product with beginning balance.', '24000', 'credit', '12644872', 'credit', 'product:243'),
(310, '+256-759912814', 1760782543, '+256-759912814', 'Published', '1760782543', NULL, '---', '2025-10-18 10:15:43', '11', 'Create new Product with beginning balance.', '24000', 'debit', '12644872', 'debit', 'product:243'),
(311, '+256-759912814', 1760867127, '+256-759912814', 'Published', '1760867127', NULL, '---', '2025-10-19 09:45:27', '10', 'Create new Product with beginning balance.', '45000', 'credit', '12689872', 'credit', 'product:244'),
(312, '+256-759912814', 1760867127, '+256-759912814', 'Published', '1760867127', NULL, '---', '2025-10-19 09:45:27', '11', 'Create new Product with beginning balance.', '45000', 'debit', '12689872', 'debit', 'product:244'),
(313, '+256-759912814', 1760867196, '+256-759912814', 'Published', '1760867196', NULL, '---', '2025-10-19 09:46:36', '10', 'Create new Product with beginning balance.', '50000', 'credit', '12739872', 'credit', 'product:245'),
(314, '+256-759912814', 1760867196, '+256-759912814', 'Published', '1760867196', NULL, '---', '2025-10-19 09:46:36', '11', 'Create new Product with beginning balance.', '50000', 'debit', '12739872', 'debit', 'product:245'),
(315, '+256-759912814', 1760867263, '+256-759912814', 'Published', '1760867263', NULL, '---', '2025-10-19 09:47:43', '10', 'Adjust stock: opening balance stock item', '33000', 'credit', '12772872', 'credit', 'product:213'),
(316, '+256-759912814', 1760867263, '+256-759912814', 'Published', '1760867263', NULL, '---', '2025-10-19 09:47:43', '11', 'Adjust stock: opening balance stock item', '33000', 'debit', '12772872', 'debit', 'product:213'),
(317, '+256-759912814', 1760867385, '+256-759912814', 'Published', '1760867385', NULL, '---', '2025-10-19 09:49:45', '10', 'Create new Product with beginning balance.', '2000', 'credit', '12774872', 'credit', 'product:246'),
(318, '+256-759912814', 1760867385, '+256-759912814', 'Published', '1760867385', NULL, '---', '2025-10-19 09:49:45', '11', 'Create new Product with beginning balance.', '2000', 'debit', '12774872', 'debit', 'product:246'),
(319, '+256-759912814', 1760867466, '+256-759912814', 'Published', '1760867466', NULL, '---', '2025-10-19 09:51:06', '10', 'Create new Product with beginning balance.', '21000', 'credit', '12795872', 'credit', 'product:247'),
(320, '+256-759912814', 1760867466, '+256-759912814', 'Published', '1760867466', NULL, '---', '2025-10-19 09:51:06', '11', 'Create new Product with beginning balance.', '21000', 'debit', '12795872', 'debit', 'product:247'),
(321, '+256-759912814', 1760867487, '+256-759912814', 'Published', '1760867487', NULL, '---', '2025-10-19 09:51:27', '10', 'Adjust stock: opening balance stock item', '2000', 'credit', '12797872', 'credit', 'product:246'),
(322, '+256-759912814', 1760867487, '+256-759912814', 'Published', '1760867487', NULL, '---', '2025-10-19 09:51:27', '11', 'Adjust stock: opening balance stock item', '2000', 'debit', '12797872', 'debit', 'product:246'),
(323, '+256-759912814', 1760867616, '+256-759912814', 'Published', '1760867616', NULL, '---', '2025-10-19 09:53:36', '11', 'Adjust stock: Lost stock item.', '28000', 'credit', '12769872', 'debit', 'product:245'),
(324, '+256-759912814', 1760867616, '+256-759912814', 'Published', '1760867616', NULL, '---', '2025-10-19 09:53:36', '2', 'Adjust stock: Lost stock item.', '28000', 'debit', '28000', 'debit', 'product:245'),
(325, '+256-759912814', 1760867669, '+256-759912814', 'Published', '1760867669', NULL, '---', '2025-10-19 09:54:29', '10', 'Create new Product with beginning balance.', '25000', 'credit', '12822872', 'credit', 'product:248'),
(326, '+256-759912814', 1760867669, '+256-759912814', 'Published', '1760867669', NULL, '---', '2025-10-19 09:54:29', '11', 'Create new Product with beginning balance.', '25000', 'debit', '12794872', 'debit', 'product:248'),
(327, '+256-759912814', 1760867763, '+256-759912814', 'Published', '1760867763', NULL, '---', '2025-10-19 09:56:03', '10', 'Create new Product with beginning balance.', '50000', 'credit', '12872872', 'credit', 'product:249'),
(328, '+256-759912814', 1760867763, '+256-759912814', 'Published', '1760867763', NULL, '---', '2025-10-19 09:56:03', '11', 'Create new Product with beginning balance.', '50000', 'debit', '12844872', 'debit', 'product:249'),
(329, '+256-759912814', 1760867835, '+256-759912814', 'Published', '1760867835', NULL, '---', '2025-10-19 09:57:15', '10', 'Create new Product with beginning balance.', '50000', 'credit', '12922872', 'credit', 'product:250'),
(330, '+256-759912814', 1760867835, '+256-759912814', 'Published', '1760867835', NULL, '---', '2025-10-19 09:57:15', '11', 'Create new Product with beginning balance.', '50000', 'debit', '12894872', 'debit', 'product:250'),
(331, '+256-759912814', 1760867979, '+256-759912814', 'Published', '1760867979', NULL, '---', '2025-10-19 09:59:39', '10', 'Create new Product with beginning balance.', '342000', 'credit', '13264872', 'credit', 'product:251'),
(332, '+256-759912814', 1760867979, '+256-759912814', 'Published', '1760867979', NULL, '---', '2025-10-19 09:59:39', '11', 'Create new Product with beginning balance.', '342000', 'debit', '13236872', 'debit', 'product:251'),
(333, '+256-759912814', 1760867979, '+256-759912814', 'Published', '1760867979', NULL, '---', '2025-10-19 09:59:39', '10', 'Create new Product with beginning balance.', '342000', 'credit', '13606872', 'credit', 'product:252'),
(334, '+256-759912814', 1760867979, '+256-759912814', 'Published', '1760867979', NULL, '---', '2025-10-19 09:59:39', '11', 'Create new Product with beginning balance.', '342000', 'debit', '13578872', 'debit', 'product:252'),
(335, '+256-759912814', 1760868174, '+256-759912814', 'Published', '1760868174', NULL, '---', '2025-10-19 10:02:54', '10', 'Create new Product with beginning balance.', '201600', 'credit', '13808472', 'credit', 'product:253'),
(336, '+256-759912814', 1760868174, '+256-759912814', 'Published', '1760868174', NULL, '---', '2025-10-19 10:02:54', '11', 'Create new Product with beginning balance.', '201600', 'debit', '13780472', 'debit', 'product:253'),
(337, '+256-759912814', 1760868212, '+256-759912814', 'Published', '1760868212', NULL, '---', '2025-10-19 10:03:32', '10', 'Create new Product with beginning balance.', '85000', 'credit', '13893472', 'credit', 'product:254'),
(338, '+256-759912814', 1760868212, '+256-759912814', 'Published', '1760868212', NULL, '---', '2025-10-19 10:03:32', '11', 'Create new Product with beginning balance.', '85000', 'debit', '13865472', 'debit', 'product:254'),
(339, '+256-759912814', 1760868273, '+256-759912814', 'Published', '1760868273', NULL, '---', '2025-10-19 10:04:33', '10', 'Create new Product with beginning balance.', '125000', 'credit', '14018472', 'credit', 'product:255'),
(340, '+256-759912814', 1760868273, '+256-759912814', 'Published', '1760868273', NULL, '---', '2025-10-19 10:04:33', '11', 'Create new Product with beginning balance.', '125000', 'debit', '13990472', 'debit', 'product:255'),
(341, '+256-759912814', 1760868327, '+256-759912814', 'Published', '1760868327', NULL, '---', '2025-10-19 10:05:27', '10', 'Create new Product with beginning balance.', '12500', 'credit', '14030972', 'credit', 'product:256'),
(342, '+256-759912814', 1760868327, '+256-759912814', 'Published', '1760868327', NULL, '---', '2025-10-19 10:05:27', '11', 'Create new Product with beginning balance.', '12500', 'debit', '14002972', 'debit', 'product:256'),
(343, '+256-759912814', 1760868425, '+256-759912814', 'Published', '1760868425', NULL, '---', '2025-10-19 10:07:05', '10', 'Create new Product with beginning balance.', '42000', 'credit', '14072972', 'credit', 'product:257'),
(344, '+256-759912814', 1760868425, '+256-759912814', 'Published', '1760868425', NULL, '---', '2025-10-19 10:07:05', '11', 'Create new Product with beginning balance.', '42000', 'debit', '14044972', 'debit', 'product:257'),
(345, '+256-759912814', 1760868462, '+256-759912814', 'Published', '1760868462', NULL, '---', '2025-10-19 10:07:42', '10', 'Create new Product with beginning balance.', '34000', 'credit', '14106972', 'credit', 'product:258'),
(346, '+256-759912814', 1760868462, '+256-759912814', 'Published', '1760868462', NULL, '---', '2025-10-19 10:07:42', '11', 'Create new Product with beginning balance.', '34000', 'debit', '14078972', 'debit', 'product:258'),
(347, '+256-759912814', 1760868501, '+256-759912814', 'Published', '1760868501', NULL, '---', '2025-10-19 10:08:21', '10', 'Create new Product with beginning balance.', '2000', 'credit', '14108972', 'credit', 'product:259'),
(348, '+256-759912814', 1760868501, '+256-759912814', 'Published', '1760868501', NULL, '---', '2025-10-19 10:08:21', '11', 'Create new Product with beginning balance.', '2000', 'debit', '14080972', 'debit', 'product:259'),
(349, '+256-759912814', 1760868601, '+256-759912814', 'Published', '1760868601', NULL, '---', '2025-10-19 10:10:01', '10', 'Adjust stock: opening balance stock item', '38000', 'credit', '14146972', 'credit', 'product:257'),
(350, '+256-759912814', 1760868601, '+256-759912814', 'Published', '1760868601', NULL, '---', '2025-10-19 10:10:01', '11', 'Adjust stock: opening balance stock item', '38000', 'debit', '14118972', 'debit', 'product:257'),
(351, '+256-759912814', 1760868683, '+256-759912814', 'Published', '1760868683', NULL, '---', '2025-10-19 10:11:23', '10', 'Create new Product with beginning balance.', '850', 'credit', '14147822', 'credit', 'product:260'),
(352, '+256-759912814', 1760868683, '+256-759912814', 'Published', '1760868683', NULL, '---', '2025-10-19 10:11:23', '11', 'Create new Product with beginning balance.', '850', 'debit', '14119822', 'debit', 'product:260'),
(353, '+256-759912814', 1760869583, '+256-759912814', 'Published', '1760869583', NULL, '---', '2025-10-19 10:26:23', '10', 'Create new Product with beginning balance.', '483000', 'credit', '14630822', 'credit', 'product:261'),
(354, '+256-759912814', 1760869583, '+256-759912814', 'Published', '1760869583', NULL, '---', '2025-10-19 10:26:23', '11', 'Create new Product with beginning balance.', '483000', 'debit', '14602822', 'debit', 'product:261'),
(355, '+256-759912814', 1760869630, '+256-759912814', 'Published', '1760869630', NULL, '---', '2025-10-19 10:27:10', '10', 'Create new Product with beginning balance.', '41400', 'credit', '14672222', 'credit', 'product:262'),
(356, '+256-759912814', 1760869630, '+256-759912814', 'Published', '1760869630', NULL, '---', '2025-10-19 10:27:10', '11', 'Create new Product with beginning balance.', '41400', 'debit', '14644222', 'debit', 'product:262'),
(357, '+256-759912814', 1760869716, '+256-759912814', 'Published', '1760869716', NULL, '---', '2025-10-19 10:28:36', '10', 'Create new Product with beginning balance.', '54000', 'credit', '14726222', 'credit', 'product:263'),
(358, '+256-759912814', 1760869716, '+256-759912814', 'Published', '1760869716', NULL, '---', '2025-10-19 10:28:36', '11', 'Create new Product with beginning balance.', '54000', 'debit', '14698222', 'debit', 'product:263'),
(359, '+256-759912814', 1760869931, '+256-759912814', 'Published', '1760869931', NULL, '---', '2025-10-19 10:32:11', '10', 'Create new Product with beginning balance.', '86000', 'credit', '14812222', 'credit', 'product:265'),
(360, '+256-759912814', 1760869931, '+256-759912814', 'Published', '1760869931', NULL, '---', '2025-10-19 10:32:11', '11', 'Create new Product with beginning balance.', '86000', 'debit', '14784222', 'debit', 'product:265'),
(361, '+256-759912814', 1760869994, '+256-759912814', 'Published', '1760869994', NULL, '---', '2025-10-19 10:33:14', '10', 'Create new Product with beginning balance.', '32000', 'credit', '14844222', 'credit', 'product:266'),
(362, '+256-759912814', 1760869994, '+256-759912814', 'Published', '1760869994', NULL, '---', '2025-10-19 10:33:14', '11', 'Create new Product with beginning balance.', '32000', 'debit', '14816222', 'debit', 'product:266'),
(363, '+256-759912814', 1760870118, '+256-759912814', 'Published', '1760870118', NULL, '---', '2025-10-19 10:35:18', '10', 'Adjust stock: opening balance stock item', '36000', 'credit', '14880222', 'credit', 'product:267'),
(364, '+256-759912814', 1760870118, '+256-759912814', 'Published', '1760870118', NULL, '---', '2025-10-19 10:35:18', '11', 'Adjust stock: opening balance stock item', '36000', 'debit', '14852222', 'debit', 'product:267'),
(365, '+256-759912814', 1760870288, '+256-759912814', 'Published', '1760870288', NULL, '---', '2025-10-19 10:38:08', '10', 'Create new Product with beginning balance.', '54000', 'credit', '14934222', 'credit', 'product:269'),
(366, '+256-759912814', 1760870288, '+256-759912814', 'Published', '1760870288', NULL, '---', '2025-10-19 10:38:08', '11', 'Create new Product with beginning balance.', '54000', 'debit', '14906222', 'debit', 'product:269'),
(367, '+256-759912814', 1760870502, '+256-759912814', 'Published', '1760870502', NULL, '---', '2025-10-19 10:41:42', '10', 'Create new Product with beginning balance.', '117500', 'credit', '15051722', 'credit', 'product:271'),
(368, '+256-759912814', 1760870502, '+256-759912814', 'Published', '1760870502', NULL, '---', '2025-10-19 10:41:42', '11', 'Create new Product with beginning balance.', '117500', 'debit', '15023722', 'debit', 'product:271'),
(369, '+256-759912814', 1760974900, '+256-759912814', 'Published', '1760974900', NULL, '---', '2025-10-20 15:41:40', '10', 'Create new Product with beginning balance.', '27000', 'credit', '15078722', 'credit', 'product:274'),
(370, '+256-759912814', 1760974900, '+256-759912814', 'Published', '1760974900', NULL, '---', '2025-10-20 15:41:40', '11', 'Create new Product with beginning balance.', '27000', 'debit', '15050722', 'debit', 'product:274'),
(371, '+256-759912814', 1760975126, '+256-759912814', 'Published', '1760975126', NULL, '---', '2025-10-20 15:45:26', '10', 'Create new Product with beginning balance.', '50000', 'credit', '15128722', 'credit', 'product:276'),
(372, '+256-759912814', 1760975126, '+256-759912814', 'Published', '1760975126', NULL, '---', '2025-10-20 15:45:26', '11', 'Create new Product with beginning balance.', '50000', 'debit', '15100722', 'debit', 'product:276'),
(373, '+256-759912814', 1760975191, '+256-759912814', 'Published', '1760975191', NULL, '---', '2025-10-20 15:46:31', '10', 'Create new Product with beginning balance.', '150000', 'credit', '15278722', 'credit', 'product:277'),
(374, '+256-759912814', 1760975191, '+256-759912814', 'Published', '1760975191', NULL, '---', '2025-10-20 15:46:31', '11', 'Create new Product with beginning balance.', '150000', 'debit', '15250722', 'debit', 'product:277'),
(375, '+256-759912814', 1760975240, '+256-759912814', 'Published', '1760975240', NULL, '---', '2025-10-20 15:47:20', '10', 'Create new Product with beginning balance.', '182000', 'credit', '15460722', 'credit', 'product:278'),
(376, '+256-759912814', 1760975240, '+256-759912814', 'Published', '1760975240', NULL, '---', '2025-10-20 15:47:20', '11', 'Create new Product with beginning balance.', '182000', 'debit', '15432722', 'debit', 'product:278'),
(377, '+256-759912814', 1760975453, '+256-759912814', 'Published', '1760975453', NULL, '---', '2025-10-20 15:50:53', '10', 'Create new Product with beginning balance.', '79900', 'credit', '15540622', 'credit', 'product:282'),
(378, '+256-759912814', 1760975453, '+256-759912814', 'Published', '1760975453', NULL, '---', '2025-10-20 15:50:53', '11', 'Create new Product with beginning balance.', '79900', 'debit', '15512622', 'debit', 'product:282'),
(379, '+256-759912814', 1760975503, '+256-759912814', 'Published', '1760975503', NULL, '---', '2025-10-20 15:51:43', '10', 'Create new Product with beginning balance.', '90000', 'credit', '15630622', 'credit', 'product:283'),
(380, '+256-759912814', 1760975503, '+256-759912814', 'Published', '1760975503', NULL, '---', '2025-10-20 15:51:43', '11', 'Create new Product with beginning balance.', '90000', 'debit', '15602622', 'debit', 'product:283'),
(381, '+256-759912814', 1760975546, '+256-759912814', 'Published', '1760975546', NULL, '---', '2025-10-20 15:52:26', '10', 'Create new Product with beginning balance.', '150000', 'credit', '15780622', 'credit', 'product:284'),
(382, '+256-759912814', 1760975546, '+256-759912814', 'Published', '1760975546', NULL, '---', '2025-10-20 15:52:26', '11', 'Create new Product with beginning balance.', '150000', 'debit', '15752622', 'debit', 'product:284'),
(383, '+256-759912814', 1760975588, '+256-759912814', 'Published', '1760975588', NULL, '---', '2025-10-20 15:53:08', '10', 'Create new Product with beginning balance.', '76000', 'credit', '15856622', 'credit', 'product:285'),
(384, '+256-759912814', 1760975588, '+256-759912814', 'Published', '1760975588', NULL, '---', '2025-10-20 15:53:08', '11', 'Create new Product with beginning balance.', '76000', 'debit', '15828622', 'debit', 'product:285'),
(385, '+256-759912814', 1760975732, '+256-759912814', 'Published', '1760975732', NULL, '---', '2025-10-20 15:55:32', '10', 'Create new Product with beginning balance.', '553800', 'credit', '16410422', 'credit', 'product:287'),
(386, '+256-759912814', 1760975732, '+256-759912814', 'Published', '1760975732', NULL, '---', '2025-10-20 15:55:32', '11', 'Create new Product with beginning balance.', '553800', 'debit', '16382422', 'debit', 'product:287'),
(387, '+256-759912814', 1760976021, '+256-759912814', 'Published', '1760976021', NULL, '---', '2025-10-20 16:00:21', '10', 'Create new Product with beginning balance.', '76000', 'credit', '16486422', 'credit', 'product:291'),
(388, '+256-759912814', 1760976021, '+256-759912814', 'Published', '1760976021', NULL, '---', '2025-10-20 16:00:21', '11', 'Create new Product with beginning balance.', '76000', 'debit', '16458422', 'debit', 'product:291'),
(389, '+256-759912814', 1760976152, '+256-759912814', 'Published', '1760976152', NULL, '---', '2025-10-20 16:02:32', '10', 'Create new Product with beginning balance.', '68000', 'credit', '16554422', 'credit', 'product:293'),
(390, '+256-759912814', 1760976152, '+256-759912814', 'Published', '1760976152', NULL, '---', '2025-10-20 16:02:32', '11', 'Create new Product with beginning balance.', '68000', 'debit', '16526422', 'debit', 'product:293'),
(391, '+256-759912814', 1760976342, '+256-759912814', 'Published', '1760976342', NULL, '---', '2025-10-20 16:05:42', '10', 'Create new Product with beginning balance.', '30000', 'credit', '16584422', 'credit', 'product:296'),
(392, '+256-759912814', 1760976342, '+256-759912814', 'Published', '1760976342', NULL, '---', '2025-10-20 16:05:42', '11', 'Create new Product with beginning balance.', '30000', 'debit', '16556422', 'debit', 'product:296'),
(393, '+256-759912814', 1760976396, '+256-759912814', 'Published', '1760976396', NULL, '---', '2025-10-20 16:06:36', '10', 'Adjust stock: opening balance stock item', '10000', 'credit', '16594422', 'credit', 'product:290'),
(394, '+256-759912814', 1760976396, '+256-759912814', 'Published', '1760976396', NULL, '---', '2025-10-20 16:06:36', '11', 'Adjust stock: opening balance stock item', '10000', 'debit', '16566422', 'debit', 'product:290'),
(395, '+256-759912814', 1760976518, '+256-759912814', 'Published', '1760976518', NULL, '---', '2025-10-20 16:08:38', '10', 'Create new Product with beginning balance.', '55000', 'credit', '16649422', 'credit', 'product:297'),
(396, '+256-759912814', 1760976518, '+256-759912814', 'Published', '1760976518', NULL, '---', '2025-10-20 16:08:38', '11', 'Create new Product with beginning balance.', '55000', 'debit', '16621422', 'debit', 'product:297'),
(397, '+256-759912814', 1760976975, '+256-759912814', 'Published', '1760976975', NULL, '---', '2025-10-20 16:16:15', '10', 'Create new Product with beginning balance.', '84000', 'credit', '16733422', 'credit', 'product:298'),
(398, '+256-759912814', 1760976975, '+256-759912814', 'Published', '1760976975', NULL, '---', '2025-10-20 16:16:15', '11', 'Create new Product with beginning balance.', '84000', 'debit', '16705422', 'debit', 'product:298'),
(399, '+256-759912814', 1760977062, '+256-759912814', 'Published', '1760977062', NULL, '---', '2025-10-20 16:17:42', '10', 'Create new Product with beginning balance.', '3000', 'credit', '16736422', 'credit', 'product:299'),
(400, '+256-759912814', 1760977062, '+256-759912814', 'Published', '1760977062', NULL, '---', '2025-10-20 16:17:42', '11', 'Create new Product with beginning balance.', '3000', 'debit', '16708422', 'debit', 'product:299'),
(401, '+256-759912814', 1760977427, '+256-759912814', 'Published', '1760977427', NULL, '---', '2025-10-20 16:23:47', '10', 'Create new Product with beginning balance.', '135000', 'credit', '16871422', 'credit', 'product:301'),
(402, '+256-759912814', 1760977427, '+256-759912814', 'Published', '1760977427', NULL, '---', '2025-10-20 16:23:47', '11', 'Create new Product with beginning balance.', '135000', 'debit', '16843422', 'debit', 'product:301'),
(403, '+256-759912814', 1760977474, '+256-759912814', 'Published', '1760977474', NULL, '---', '2025-10-20 16:24:34', '10', 'Create new Product with beginning balance.', '170000', 'credit', '17041422', 'credit', 'product:302'),
(404, '+256-759912814', 1760977474, '+256-759912814', 'Published', '1760977474', NULL, '---', '2025-10-20 16:24:34', '11', 'Create new Product with beginning balance.', '170000', 'debit', '17013422', 'debit', 'product:302'),
(405, '+256-759912814', 1761037680, '+256-759912814', 'Published', '1761037680', NULL, '---', '2025-10-21 09:08:00', '10', 'Create new Product with beginning balance.', '22400', 'credit', '17063822', 'credit', 'product:303'),
(406, '+256-759912814', 1761037680, '+256-759912814', 'Published', '1761037680', NULL, '---', '2025-10-21 09:08:00', '11', 'Create new Product with beginning balance.', '22400', 'debit', '17035822', 'debit', 'product:303'),
(407, '+256-759912814', 1761038043, '+256-759912814', 'Published', '1761038043', NULL, '---', '2025-10-21 09:14:03', '10', 'Create new Product with beginning balance.', '180000', 'credit', '17243822', 'credit', 'product:306'),
(408, '+256-759912814', 1761038043, '+256-759912814', 'Published', '1761038043', NULL, '---', '2025-10-21 09:14:03', '11', 'Create new Product with beginning balance.', '180000', 'debit', '17215822', 'debit', 'product:306'),
(409, '+256-759912814', 1761038098, '+256-759912814', 'Published', '1761038098', NULL, '---', '2025-10-21 09:14:58', '10', 'Create new Product with beginning balance.', '325000', 'credit', '17568822', 'credit', 'product:307'),
(410, '+256-759912814', 1761038098, '+256-759912814', 'Published', '1761038098', NULL, '---', '2025-10-21 09:14:58', '11', 'Create new Product with beginning balance.', '325000', 'debit', '17540822', 'debit', 'product:307'),
(411, '+256-759912814', 1761038500, '+256-759912814', 'Published', '1761038500', NULL, '---', '2025-10-21 09:21:40', '10', 'Create new Product with beginning balance.', '200000', 'credit', '17768822', 'credit', 'product:312'),
(412, '+256-759912814', 1761038500, '+256-759912814', 'Published', '1761038500', NULL, '---', '2025-10-21 09:21:40', '11', 'Create new Product with beginning balance.', '200000', 'debit', '17740822', 'debit', 'product:312'),
(413, '+256-759912814', 1761038614, '+256-759912814', 'Published', '1761038614', NULL, '---', '2025-10-21 09:23:34', '10', 'Create new Product with beginning balance.', '48000', 'credit', '17816822', 'credit', 'product:314'),
(414, '+256-759912814', 1761038614, '+256-759912814', 'Published', '1761038614', NULL, '---', '2025-10-21 09:23:34', '11', 'Create new Product with beginning balance.', '48000', 'debit', '17788822', 'debit', 'product:314'),
(415, '+256-759912814', 1761038667, '+256-759912814', 'Published', '1761038667', NULL, '---', '2025-10-21 09:24:27', '10', 'Create new Product with beginning balance.', '80000', 'credit', '17896822', 'credit', 'product:315'),
(416, '+256-759912814', 1761038667, '+256-759912814', 'Published', '1761038667', NULL, '---', '2025-10-21 09:24:27', '11', 'Create new Product with beginning balance.', '80000', 'debit', '17868822', 'debit', 'product:315'),
(417, '+256-759912814', 1761038784, '+256-759912814', 'Published', '1761038784', NULL, '---', '2025-10-21 09:26:24', '10', 'Create new Product with beginning balance.', '168000', 'credit', '18064822', 'credit', 'product:317'),
(418, '+256-759912814', 1761038784, '+256-759912814', 'Published', '1761038784', NULL, '---', '2025-10-21 09:26:24', '11', 'Create new Product with beginning balance.', '168000', 'debit', '18036822', 'debit', 'product:317'),
(419, '+256-759912814', 1761038882, '+256-759912814', 'Published', '1761038882', NULL, '---', '2025-10-21 09:28:02', '10', 'Create new Product with beginning balance.', '604500', 'credit', '18669322', 'credit', 'product:318'),
(420, '+256-759912814', 1761038882, '+256-759912814', 'Published', '1761038882', NULL, '---', '2025-10-21 09:28:02', '11', 'Create new Product with beginning balance.', '604500', 'debit', '18641322', 'debit', 'product:318'),
(421, '+256-759912814', 1761039113, '+256-759912814', 'Published', '1761039113', NULL, '---', '2025-10-21 09:31:53', '10', 'Create new Product with beginning balance.', '9000', 'credit', '18678322', 'credit', 'product:322'),
(422, '+256-759912814', 1761039113, '+256-759912814', 'Published', '1761039113', NULL, '---', '2025-10-21 09:31:53', '11', 'Create new Product with beginning balance.', '9000', 'debit', '18650322', 'debit', 'product:322'),
(423, '+256-759912814', 1761039238, '+256-759912814', 'Published', '1761039238', NULL, '---', '2025-10-21 09:33:58', '10', 'Create new Product with beginning balance.', '43700', 'credit', '18722022', 'credit', 'product:324'),
(424, '+256-759912814', 1761039238, '+256-759912814', 'Published', '1761039238', NULL, '---', '2025-10-21 09:33:58', '11', 'Create new Product with beginning balance.', '43700', 'debit', '18694022', 'debit', 'product:324'),
(425, '+256-759912814', 1761040298, '+256-759912814', 'Published', '1761040298', NULL, '---', '2025-10-21 09:51:38', '10', 'Create new Product with beginning balance.', '18000', 'credit', '18740022', 'credit', 'product:335'),
(426, '+256-759912814', 1761040298, '+256-759912814', 'Published', '1761040298', NULL, '---', '2025-10-21 09:51:38', '11', 'Create new Product with beginning balance.', '18000', 'debit', '18712022', 'debit', 'product:335'),
(427, '+256-759912814', 1761040555, '+256-759912814', 'Published', '1761040555', NULL, '---', '2025-10-21 09:55:55', '10', 'Create new Product with beginning balance.', '1338', 'credit', '18741360', 'credit', 'product:338'),
(428, '+256-759912814', 1761040555, '+256-759912814', 'Published', '1761040555', NULL, '---', '2025-10-21 09:55:55', '11', 'Create new Product with beginning balance.', '1338', 'debit', '18713360', 'debit', 'product:338'),
(429, '+256-759912814', 1761040861, '+256-759912814', 'Published', '1761040861', NULL, '---', '2025-10-21 10:01:01', '10', 'Create new Product with beginning balance.', '392000', 'credit', '19133360', 'credit', 'product:344'),
(430, '+256-759912814', 1761040861, '+256-759912814', 'Published', '1761040861', NULL, '---', '2025-10-21 10:01:01', '11', 'Create new Product with beginning balance.', '392000', 'debit', '19105360', 'debit', 'product:344'),
(431, '+256-759912814', 1761040978, '+256-759912814', 'Published', '1761040978', NULL, '---', '2025-10-21 10:02:58', '10', 'Create new Product with beginning balance.', '2500', 'credit', '19135860', 'credit', 'product:345'),
(432, '+256-759912814', 1761040978, '+256-759912814', 'Published', '1761040978', NULL, '---', '2025-10-21 10:02:58', '11', 'Create new Product with beginning balance.', '2500', 'debit', '19107860', 'debit', 'product:345'),
(433, '+256-759912814', 1761041019, '+256-759912814', 'Published', '1761041019', NULL, '---', '2025-10-21 10:03:39', '10', 'Create new Product with beginning balance.', '4000', 'credit', '19139860', 'credit', 'product:346'),
(434, '+256-759912814', 1761041019, '+256-759912814', 'Published', '1761041019', NULL, '---', '2025-10-21 10:03:39', '11', 'Create new Product with beginning balance.', '4000', 'debit', '19111860', 'debit', 'product:346'),
(435, '+256-759912814', 1761041729, '+256-759912814', 'Published', '1761041729', NULL, '---', '2025-10-21 10:15:29', '10', 'Create new Product with beginning balance.', '84000', 'credit', '19223860', 'credit', 'product:356'),
(436, '+256-759912814', 1761041729, '+256-759912814', 'Published', '1761041729', NULL, '---', '2025-10-21 10:15:29', '11', 'Create new Product with beginning balance.', '84000', 'debit', '19195860', 'debit', 'product:356'),
(437, '+256-759912814', 1761041767, '+256-759912814', 'Published', '1761041767', NULL, '---', '2025-10-21 10:16:07', '10', 'Create new Product with beginning balance.', '49800', 'credit', '19273660', 'credit', 'product:357'),
(438, '+256-759912814', 1761041767, '+256-759912814', 'Published', '1761041767', NULL, '---', '2025-10-21 10:16:07', '11', 'Create new Product with beginning balance.', '49800', 'debit', '19245660', 'debit', 'product:357'),
(439, '+256-759912814', 1761041910, '+256-759912814', 'Published', '1761041910', NULL, '---', '2025-10-21 10:18:30', '10', 'Adjust stock: opening balance stock item', '147000', 'credit', '19420660', 'credit', 'product:354'),
(440, '+256-759912814', 1761041910, '+256-759912814', 'Published', '1761041910', NULL, '---', '2025-10-21 10:18:30', '11', 'Adjust stock: opening balance stock item', '147000', 'debit', '19392660', 'debit', 'product:354'),
(441, '+256-759912814', 1761041971, '+256-759912814', 'Published', '1761041971', NULL, '---', '2025-10-21 10:19:31', '10', 'Create new Product with beginning balance.', '8000', 'credit', '19428660', 'credit', 'product:359'),
(442, '+256-759912814', 1761041971, '+256-759912814', 'Published', '1761041971', NULL, '---', '2025-10-21 10:19:31', '11', 'Create new Product with beginning balance.', '8000', 'debit', '19400660', 'debit', 'product:359'),
(443, '+256-759912814', 1761042019, '+256-759912814', 'Published', '1761042019', NULL, '---', '2025-10-21 10:20:19', '10', 'Create new Product with beginning balance.', '94500', 'credit', '19523160', 'credit', 'product:360'),
(444, '+256-759912814', 1761042019, '+256-759912814', 'Published', '1761042019', NULL, '---', '2025-10-21 10:20:19', '11', 'Create new Product with beginning balance.', '94500', 'debit', '19495160', 'debit', 'product:360'),
(445, '+256-759912814', 1761042060, '+256-759912814', 'Published', '1761042060', NULL, '---', '2025-10-21 10:21:00', '10', 'Create new Product with beginning balance.', '8000', 'credit', '19531160', 'credit', 'product:361'),
(446, '+256-759912814', 1761042060, '+256-759912814', 'Published', '1761042060', NULL, '---', '2025-10-21 10:21:00', '11', 'Create new Product with beginning balance.', '8000', 'debit', '19503160', 'debit', 'product:361'),
(447, '+256-759912814', 1761042104, '+256-759912814', 'Published', '1761042104', NULL, '---', '2025-10-21 10:21:44', '10', 'Create new Product with beginning balance.', '72000', 'credit', '19603160', 'credit', 'product:362'),
(448, '+256-759912814', 1761042104, '+256-759912814', 'Published', '1761042104', NULL, '---', '2025-10-21 10:21:44', '11', 'Create new Product with beginning balance.', '72000', 'debit', '19575160', 'debit', 'product:362');
INSERT INTO `ledger` (`id`, `owner_mobile`, `timestamp`, `added_by`, `status`, `last_updated`, `sync`, `---`, `date`, `account_id`, `description`, `amount`, `amount_type`, `balance`, `balance_type`, `entry_link`) VALUES
(449, '+256-759912814', 1761042671, '+256-759912814', 'Published', '1761042671', NULL, '---', '2025-10-21 10:31:11', '10', 'Create new Product with beginning balance.', '273700', 'credit', '19876860', 'credit', 'product:366'),
(450, '+256-759912814', 1761042671, '+256-759912814', 'Published', '1761042671', NULL, '---', '2025-10-21 10:31:11', '11', 'Create new Product with beginning balance.', '273700', 'debit', '19848860', 'debit', 'product:366'),
(451, '+256-759912814', 1761042736, '+256-759912814', 'Published', '1761042736', NULL, '---', '2025-10-21 10:32:16', '10', 'Create new Product with beginning balance.', '22800', 'credit', '19899660', 'credit', 'product:367'),
(452, '+256-759912814', 1761042736, '+256-759912814', 'Published', '1761042736', NULL, '---', '2025-10-21 10:32:16', '11', 'Create new Product with beginning balance.', '22800', 'debit', '19871660', 'debit', 'product:367'),
(453, '+256-759912814', 1761042781, '+256-759912814', 'Published', '1761042781', NULL, '---', '2025-10-21 10:33:01', '10', 'Create new Product with beginning balance.', '10800', 'credit', '19910460', 'credit', 'product:368'),
(454, '+256-759912814', 1761042781, '+256-759912814', 'Published', '1761042781', NULL, '---', '2025-10-21 10:33:01', '11', 'Create new Product with beginning balance.', '10800', 'debit', '19882460', 'debit', 'product:368'),
(455, '+256-759912814', 1761042996, '+256-759912814', 'Published', '1761042996', NULL, '---', '2025-10-21 10:36:36', '10', 'Create new Product with beginning balance.', '11000', 'credit', '19921460', 'credit', 'product:372'),
(456, '+256-759912814', 1761042996, '+256-759912814', 'Published', '1761042996', NULL, '---', '2025-10-21 10:36:36', '11', 'Create new Product with beginning balance.', '11000', 'debit', '19893460', 'debit', 'product:372'),
(457, '+256-759912814', 1761043116, '+256-759912814', 'Published', '1761043116', NULL, '---', '2025-10-21 10:38:36', '10', 'Create new Product with beginning balance.', '2000', 'credit', '19923460', 'credit', 'product:374'),
(458, '+256-759912814', 1761043116, '+256-759912814', 'Published', '1761043116', NULL, '---', '2025-10-21 10:38:36', '11', 'Create new Product with beginning balance.', '2000', 'debit', '19895460', 'debit', 'product:374'),
(459, '+256-759912814', 1761043181, '+256-759912814', 'Published', '1761043181', NULL, '---', '2025-10-21 10:39:41', '10', 'Create new Product with beginning balance.', '408000', 'credit', '20331460', 'credit', 'product:375'),
(460, '+256-759912814', 1761043181, '+256-759912814', 'Published', '1761043181', NULL, '---', '2025-10-21 10:39:41', '11', 'Create new Product with beginning balance.', '408000', 'debit', '20303460', 'debit', 'product:375'),
(461, '+256-759912814', 1761043217, '+256-759912814', 'Published', '1761043217', NULL, '---', '2025-10-21 10:40:17', '10', 'Create new Product with beginning balance.', '19800', 'credit', '20351260', 'credit', 'product:376'),
(462, '+256-759912814', 1761043218, '+256-759912814', 'Published', '1761043218', NULL, '---', '2025-10-21 10:40:18', '11', 'Create new Product with beginning balance.', '19800', 'debit', '20323260', 'debit', 'product:376'),
(463, '+256-759912814', 1761043355, '+256-759912814', 'Published', '1761043355', NULL, '---', '2025-10-21 10:42:35', '10', 'Create new Product with beginning balance.', '78000', 'credit', '20429260', 'credit', 'product:379'),
(464, '+256-759912814', 1761043355, '+256-759912814', 'Published', '1761043355', NULL, '---', '2025-10-21 10:42:35', '11', 'Create new Product with beginning balance.', '78000', 'debit', '20401260', 'debit', 'product:379'),
(465, '+256-759912814', 1761043424, '+256-759912814', 'Published', '1761043424', NULL, '---', '2025-10-21 10:43:44', '10', 'Create new Product with beginning balance.', '3000', 'credit', '20432260', 'credit', 'product:380'),
(466, '+256-759912814', 1761043424, '+256-759912814', 'Published', '1761043424', NULL, '---', '2025-10-21 10:43:44', '11', 'Create new Product with beginning balance.', '3000', 'debit', '20404260', 'debit', 'product:380'),
(467, '+256-759912814', 1761043480, '+256-759912814', 'Published', '1761043480', NULL, '---', '2025-10-21 10:44:40', '10', 'Create new Product with beginning balance.', '31350', 'credit', '20463610', 'credit', 'product:381'),
(468, '+256-759912814', 1761043480, '+256-759912814', 'Published', '1761043480', NULL, '---', '2025-10-21 10:44:40', '11', 'Create new Product with beginning balance.', '31350', 'debit', '20435610', 'debit', 'product:381'),
(469, '+256-759912814', 1761213772, '+256-759912814', 'Published', '1761213772', NULL, '---', '2025-10-23 10:02:52', '10', 'Create new Product with beginning balance.', '54000', 'credit', '20517610', 'credit', 'product:382'),
(470, '+256-759912814', 1761213772, '+256-759912814', 'Published', '1761213772', NULL, '---', '2025-10-23 10:02:52', '11', 'Create new Product with beginning balance.', '54000', 'debit', '20489610', 'debit', 'product:382'),
(471, '+92-3335672555', 1761650333, '+92-3335672555', 'Published', '1761650333', NULL, '---', '2025-10-28 11:18:53', 'c+73-1', 'Create new Contact with beginning balance.', '200', 'credit', '200', 'credit', 'contactid:+73-1'),
(472, '+92-3335672555', 1761650333, '+92-3335672555', 'Published', '1761650333', NULL, '---', '2025-10-28 11:18:53', '43', 'Create new Contact with beginning balance.', '200', 'debit', '200', 'debit', 'contactid:+73-1'),
(473, '+92-3335672555', 1761650369, '+92-3335672555', 'Published', '1761650369', NULL, '---', '2025-10-28 11:19:29', 'c+13-0', 'Create new Contact with beginning balance.', '100', 'credit', '100', 'credit', 'contactid:+13-0'),
(474, '+92-3335672555', 1761650369, '+92-3335672555', 'Published', '1761650369', NULL, '---', '2025-10-28 11:19:29', '43', 'Create new Contact with beginning balance.', '100', 'debit', '300', 'debit', 'contactid:+13-0'),
(475, '+92-3335672555', 1761650422, '+92-3335672555', 'Published', '1761650422', NULL, '---', '2025-10-28 11:20:22', '34', 'payment.Paid', '200', 'credit', '200', 'credit', 'paymentid:1'),
(476, '+92-3335672555', 1761650422, '+92-3335672555', 'Published', '1761650422', NULL, '---', '2025-10-28 11:20:22', 'c+73-1', 'payment.Paid', '200', 'debit', '0', 'credit', 'paymentid:1'),
(477, '+256-759912814', 1763977323, '+256-759912814', 'Published', '1763977323', NULL, '---', '2025-11-24 09:42:03', '10', 'Create new Product with beginning balance.', '6400', 'credit', '20524010', 'credit', 'product:383'),
(478, '+256-759912814', 1763977323, '+256-759912814', 'Published', '1763977323', NULL, '---', '2025-11-24 09:42:03', '11', 'Create new Product with beginning balance.', '6400', 'debit', '20496010', 'debit', 'product:383'),
(479, '+256-759912814', 1763982936, '+256-759912814', 'Published', '1763982936', NULL, '---', '2025-11-24 11:15:36', '10', 'Create new Product with beginning balance.', '13000', 'credit', '20537010', 'credit', 'product:384'),
(480, '+256-759912814', 1763982936, '+256-759912814', 'Published', '1763982936', NULL, '---', '2025-11-24 11:15:36', '11', 'Create new Product with beginning balance.', '13000', 'debit', '20509010', 'debit', 'product:384'),
(481, '+256-759912814', 1763984051, '+256-759912814', 'Published', '1763984051', NULL, '---', '2025-11-24 11:34:11', '10', 'Create new Product with beginning balance.', '21250', 'credit', '20558260', 'credit', 'product:385'),
(482, '+256-759912814', 1763984051, '+256-759912814', 'Published', '1763984051', NULL, '---', '2025-11-24 11:34:11', '11', 'Create new Product with beginning balance.', '21250', 'debit', '20530260', 'debit', 'product:385'),
(483, '+256-759912814', 1763984136, '+256-759912814', 'Published', '1763984136', NULL, '---', '2025-11-24 11:35:36', '10', 'Create new Product with beginning balance.', '3000', 'credit', '20561260', 'credit', 'product:386'),
(484, '+256-759912814', 1763984136, '+256-759912814', 'Published', '1763984136', NULL, '---', '2025-11-24 11:35:36', '11', 'Create new Product with beginning balance.', '3000', 'debit', '20533260', 'debit', 'product:386'),
(485, '+256-759912814', 1763984215, '+256-759912814', 'Published', '1763984215', NULL, '---', '2025-11-24 11:36:55', '10', 'Create new Product with beginning balance.', '20000', 'credit', '20581260', 'credit', 'product:387'),
(486, '+256-759912814', 1763984215, '+256-759912814', 'Published', '1763984215', NULL, '---', '2025-11-24 11:36:55', '11', 'Create new Product with beginning balance.', '20000', 'debit', '20553260', 'debit', 'product:387'),
(487, '+256-759912814', 1763984486, '+256-759912814', 'Published', '1763984486', NULL, '---', '2025-11-24 11:41:26', '10', 'Create new Product with beginning balance.', '120000', 'credit', '20701260', 'credit', 'product:388'),
(488, '+256-759912814', 1763984486, '+256-759912814', 'Published', '1763984486', NULL, '---', '2025-11-24 11:41:26', '11', 'Create new Product with beginning balance.', '120000', 'debit', '20673260', 'debit', 'product:388'),
(489, '+256-759912814', 1763984580, '+256-759912814', 'Published', '1763984580', NULL, '---', '2025-11-24 11:43:00', '10', 'Create new Product with beginning balance.', '10000', 'credit', '20711260', 'credit', 'product:389'),
(490, '+256-759912814', 1763984580, '+256-759912814', 'Published', '1763984580', NULL, '---', '2025-11-24 11:43:00', '11', 'Create new Product with beginning balance.', '10000', 'debit', '20683260', 'debit', 'product:389'),
(491, '+256-759912814', 1763984682, '+256-759912814', 'Published', '1763984682', NULL, '---', '2025-11-24 11:44:42', '10', 'Create new Product with beginning balance.', '116250', 'credit', '20827510', 'credit', 'product:390'),
(492, '+256-759912814', 1763984682, '+256-759912814', 'Published', '1763984682', NULL, '---', '2025-11-24 11:44:42', '11', 'Create new Product with beginning balance.', '116250', 'debit', '20799510', 'debit', 'product:390'),
(493, '+256-759912814', 1763984971, '+256-759912814', 'Published', '1763984971', NULL, '---', '2025-11-24 11:49:31', '10', 'Create new Product with beginning balance.', '11000', 'credit', '20838510', 'credit', 'product:395'),
(494, '+256-759912814', 1763984971, '+256-759912814', 'Published', '1763984971', NULL, '---', '2025-11-24 11:49:31', '11', 'Create new Product with beginning balance.', '11000', 'debit', '20810510', 'debit', 'product:395'),
(495, '+256-759912814', 1763985575, '+256-759912814', 'Published', '1763985575', NULL, '---', '2025-11-24 11:59:35', '10', 'Create new Product with beginning balance.', '61600', 'credit', '20900110', 'credit', 'product:396'),
(496, '+256-759912814', 1763985575, '+256-759912814', 'Published', '1763985575', NULL, '---', '2025-11-24 11:59:35', '11', 'Create new Product with beginning balance.', '61600', 'debit', '20872110', 'debit', 'product:396'),
(497, '+256-759912814', 1763985628, '+256-759912814', 'Published', '1763985628', NULL, '---', '2025-11-24 12:00:28', '10', 'Create new Product with beginning balance.', '19000', 'credit', '20919110', 'credit', 'product:397'),
(498, '+256-759912814', 1763985628, '+256-759912814', 'Published', '1763985628', NULL, '---', '2025-11-24 12:00:28', '11', 'Create new Product with beginning balance.', '19000', 'debit', '20891110', 'debit', 'product:397'),
(499, '+256-759912814', 1763985678, '+256-759912814', 'Published', '1763985678', NULL, '---', '2025-11-24 12:01:18', '11', 'Adjust stock: Lost stock item.', '15200', 'credit', '20875910', 'debit', 'product:396'),
(500, '+256-759912814', 1763985678, '+256-759912814', 'Published', '1763985678', NULL, '---', '2025-11-24 12:01:18', '2', 'Adjust stock: Lost stock item.', '15200', 'debit', '43200', 'debit', 'product:396'),
(501, '+92-3335672555', 1764131548, '+92-3335672555', 'Published', '1764131548', NULL, '---', '2025-11-26 04:32:28', '43', 'Create new Product with beginning balance.', '1300', 'credit', '1000', 'credit', 'product:398'),
(502, '+92-3335672555', 1764131548, '+92-3335672555', 'Published', '1764131548', NULL, '---', '2025-11-26 04:32:28', '44', 'Create new Product with beginning balance.', '1300', 'debit', '1300', 'debit', 'product:398'),
(503, '+92-3335672555', 1764131718, '+92-3335672555', 'Published', '1764131718', NULL, '---', '2025-11-26 04:35:18', '34', 'manafacturing', '150', 'credit', '350', 'credit', 'activity_id:1'),
(504, '+92-3335672555', 1764131718, '+92-3335672555', 'Published', '1764131718', NULL, '---', '2025-11-26 04:35:18', '35', 'manafacturing', '150', 'debit', '150', 'debit', 'activity_id:1');

-- --------------------------------------------------------

--
-- Table structure for table `lend_inventory`
--

CREATE TABLE `lend_inventory` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(500) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `contact_number` varchar(99) DEFAULT NULL,
  `invoice_id` varchar(99) DEFAULT NULL,
  `invoice_type` varchar(99) DEFAULT NULL,
  `item_id` int(99) DEFAULT NULL,
  `-` varchar(2) NOT NULL DEFAULT '-',
  `old_qty` varchar(99) DEFAULT NULL,
  `new_qty` varchar(99) DEFAULT NULL,
  `total_qty` varchar(99) DEFAULT NULL,
  `deposit_qty` varchar(99) DEFAULT NULL,
  `grand_total_qty` varchar(99) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(500) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `name` varchar(99) DEFAULT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'shop',
  `description` mediumtext DEFAULT NULL,
  `tags` varchar(99) DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `timestamp` varchar(20) DEFAULT NULL,
  `added_by` varchar(7) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `---` varchar(20) NOT NULL DEFAULT '---',
  `name` varchar(20) DEFAULT NULL,
  `price` int(7) DEFAULT NULL,
  `price_usd` varchar(20) DEFAULT NULL,
  `validity` int(7) DEFAULT NULL,
  `no_admins` int(7) DEFAULT NULL,
  `no_vendors` int(7) DEFAULT NULL,
  `no_staff` int(7) DEFAULT NULL,
  `no_clients` int(7) DEFAULT NULL,
  `no_products` int(7) DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(500) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `posid` varchar(11) DEFAULT NULL,
  `amount` varchar(30) DEFAULT NULL,
  `discount` varchar(99) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `contact_number` varchar(30) DEFAULT NULL,
  `payment_method` varchar(30) DEFAULT NULL,
  `payment_type` varchar(30) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `attachments` varchar(99) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `owner_mobile`, `timestamp`, `added_by`, `status`, `last_updated`, `sync`, `---`, `posid`, `amount`, `discount`, `date`, `contact_number`, `payment_method`, `payment_type`, `description`, `attachments`) VALUES
(1, '+92-3335672555', 1761650422, '+92-3335672555', 'Published', '1761650422', NULL, '---', NULL, '200', '0', '2025-10-28', '+73-1', '34', 'Paid', '', 'loCuKrw7');

-- --------------------------------------------------------

--
-- Table structure for table `paypal_payments`
--

CREATE TABLE `paypal_payments` (
  `id` int(6) NOT NULL,
  `txnid` varchar(20) NOT NULL,
  `payment_amount` decimal(7,2) NOT NULL,
  `payment_status` varchar(25) NOT NULL,
  `itemid` varchar(25) NOT NULL,
  `createdtime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_access`
--

CREATE TABLE `pos_access` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `number` varchar(30) DEFAULT NULL,
  `password` mediumtext NOT NULL,
  `privs` mediumtext DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL,
  `default_account_keys` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(500) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `name` varchar(99) DEFAULT NULL,
  `category` varchar(99) DEFAULT NULL,
  `tax` varchar(100) DEFAULT 'Exempted',
  `description` mediumtext DEFAULT NULL,
  `measuring_unit` varchar(20) DEFAULT NULL,
  `available_stock` varchar(11) DEFAULT NULL,
  `stock_on_locations` text DEFAULT NULL,
  `stock_value` varchar(11) DEFAULT NULL,
  `min_stock_limit` varchar(11) DEFAULT NULL,
  `max_stock_limit` varchar(11) DEFAULT NULL,
  `purchase_cost` varchar(11) DEFAULT NULL,
  `sale_price` varchar(11) DEFAULT NULL,
  `wholesale_price` varchar(20) DEFAULT NULL,
  `total_purchase` varchar(11) DEFAULT NULL,
  `total_sale` varchar(11) DEFAULT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `sku` varchar(20) DEFAULT NULL,
  `barcode` varchar(32) DEFAULT NULL,
  `category_id` varchar(10) DEFAULT NULL,
  `platforms` varchar(255) NOT NULL DEFAULT 'shop,onlineStore,',
  `youtube_link` text NOT NULL,
  `title` text NOT NULL,
  `product_description` text NOT NULL,
  `tags` varchar(99) DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL,
  `variants` varchar(99) DEFAULT NULL,
  `secondary_unit_count` int(11) DEFAULT 0,
  `secondary_units` text DEFAULT NULL,
  `lend_inventory` varchar(99) NOT NULL DEFAULT 'off',
  `salesman_commission` varchar(9) DEFAULT NULL,
  `agent_commission` varchar(9) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `owner_mobile`, `timestamp`, `added_by`, `status`, `last_updated`, `sync`, `---`, `name`, `category`, `tax`, `description`, `measuring_unit`, `available_stock`, `stock_on_locations`, `stock_value`, `min_stock_limit`, `max_stock_limit`, `purchase_cost`, `sale_price`, `wholesale_price`, `total_purchase`, `total_sale`, `weight`, `sku`, `barcode`, `category_id`, `platforms`, `youtube_link`, `title`, `product_description`, `tags`, `notes`, `variants`, `secondary_unit_count`, `secondary_units`, `lend_inventory`, `salesman_commission`, `agent_commission`) VALUES
(1, '+256-759912814', 1760534721, '+256-759912814', 'published', '1760534721', NULL, '---', '10T Opnion ', 'CG200', NULL, '', 'Pcs', '00', NULL, NULL, '0', '0', '25000', '35000', '30000', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(2, '+256-759912814', 1760534896, '+256-759912814', 'published', '1760534896', NULL, '---', '2T', 'Measured Oils', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '6834', '10000', '8000', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(3, '+256-759912814', 1760534985, '+256-759912814', 'published', '1760534985', NULL, '---', '4s Tubes', 'Cheap Tubes', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '6500', '10000', '8000', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(4, '+256-759912814', 1760535134, '+256-759912814', 'published', '1760535134', NULL, '---', '4T', 'Tinned Oils', NULL, '', 'Pcs', '10', NULL, NULL, '0', '0', '12084', '14000', '13500', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(5, '+256-759912814', 1760535562, '+256-759912814', 'published', '1760535562', NULL, '---', 'Cable Acc Houjue', 'Cables', '', '', 'Pcs', '10', NULL, NULL, '0', '0', '2300', '5000', '3500', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(6, '+256-759912814', 1760535626, '+256-759912814', 'published', '1760535626', NULL, '---', 'Cable Speed Houjue', 'Cables', '', '', 'Pcs', '10', NULL, NULL, '0', '0', '2800', '5000', '4000', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(7, '+256-759912814', 1760535683, '+256-759912814', 'published', '1760535683', NULL, '---', 'Cables Brake Houjue', 'Cables', '', '', 'Pcs', '15', NULL, NULL, '0', '0', '3500', '5000', '4500', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(8, '+256-759912814', 1760535757, '+256-759912814', 'published', '1760535757', NULL, '---', '8T Opnion', 'CG200', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '25000', '35000', '30000', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(9, '+256-759912814', 1760535833, '+256-759912814', 'published', '1760535833', NULL, '---', 'Cable Acc HM', 'Cables', '', '', 'Pcs', '30', NULL, NULL, '5', '0', '2300', '4000', '3000', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(10, '+256-759912814', 1760535908, '+256-759912814', 'published', '1760535908', NULL, '---', 'Cables Acc HLX', 'Cables', '', '', 'Pcs', '8', NULL, NULL, '0', '0', '2300', '4000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(11, '+256-759912814', 1760535953, '+256-759912814', 'published', '1760535953', NULL, '---', 'Cables Acc K90', 'Cables', '', '', 'Pcs', '0', NULL, NULL, '0', '0', '3000', '5000', '4000', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(12, '+256-759912814', 1760536045, '+256-759912814', 'published', '1760536045', NULL, '---', 'Cables Acc Kevla', 'Cables', '', '', 'Pcs', '5', NULL, NULL, '0', '0', '4000', '5000', '4700', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(13, '+256-759912814', 1760536149, '+256-759912814', 'published', '1760536149', NULL, '---', 'Cable Acc RT', 'Cables', NULL, '', 'Pcs', '4', NULL, NULL, '0', '0', '2250', '4000', '3000', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(14, '+256-759912814', 1760536446, '+256-759912814', 'published', '1760536446', NULL, '---', 'Cables - Acc V50', 'Cables', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '3000', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(15, '+256-759912814', 1760536515, '+256-759912814', 'published', '1760536515', NULL, '---', 'Cables - Acc Yog', 'Cables', NULL, '', 'Pcs', '10', NULL, NULL, '0', '0', '3000', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(16, '+256-759912814', 1760536582, '+256-759912814', 'published', '1760536582', NULL, '---', 'Cables - Acc Max', 'Cables', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '2500', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(17, '+256-759912814', 1760536652, '+256-759912814', 'published', '1760536652', NULL, '---', 'Wires - Acc RT', '', NULL, '', 'Pcs', '6', NULL, NULL, '0', '0', '400', '1000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(18, '+256-759912814', 1760536691, '+256-759912814', 'published', '1760536691', NULL, '---', 'Aerial', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '6500', '9000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(19, '+256-759912814', 1760536703, '+256-759912814', 'published', '1760536703', NULL, '---', 'Aerial', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '6500', '9000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(20, '+256-759912814', 1760536867, '+256-759912814', 'published', '1760536867', NULL, '---', 'Air Cleaner Sponge ', '', NULL, '', 'Pcs', '14', NULL, NULL, '0', '0', '1200', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(21, '+256-759912814', 1760536918, '+256-759912814', 'published', '1760536918', NULL, '---', 'Allen Key Bolts ', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1000', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(22, '+256-759912814', 1760536970, '+256-759912814', 'published', '1760536970', NULL, '---', 'Allen Key Mitto', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '600', '1000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(23, '+256-759912814', 1760537036, '+256-759912814', 'published', '1760537036', NULL, '---', 'Ball Race Yog', '', NULL, '', 'Pcs', '15', NULL, NULL, '0', '0', '4500', '6000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(24, '+256-759912814', 1760537072, '+256-759912814', 'published', '1760537072', NULL, '---', 'Ball Race Beyond', '', NULL, '', 'Pcs', '27', NULL, NULL, '0', '0', '4000', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(25, '+256-759912814', 1760537117, '+256-759912814', 'published', '1760537117', NULL, '---', 'Ball Race CG Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '3500', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(26, '+256-759912814', 1760537200, '+256-759912814', 'published', '1760537200', NULL, '---', 'Ball Race Kevla', '', NULL, '', 'Pcs', '7', NULL, NULL, '0', '0', '6500', '8000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(27, '+256-759912814', 1760537244, '+256-759912814', 'published', '1760537244', NULL, '---', 'Ball Race RT', '', NULL, '', 'Pcs', '35', NULL, NULL, '0', '0', '4200', '6000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(28, '+256-759912814', 1760537307, '+256-759912814', 'published', '1760537307', NULL, '---', 'Battery CG - Golden Choice', '', NULL, '', 'Pcs', '16', NULL, NULL, '0', '0', '32000', '40000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(29, '+256-759912814', 1760537366, '+256-759912814', 'published', '1760537366', NULL, '---', 'Battery Cg - 4s Dry', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '32000', '40000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(30, '+256-759912814', 1760537441, '+256-759912814', 'published', '1760537441', NULL, '---', 'Battery CG - Dry Kevla', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '37000', '45000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(31, '+256-759912814', 1760537489, '+256-759912814', 'published', '1760537489', NULL, '---', 'Battery CG - Wet Kevla', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '36000', '45000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(32, '+256-759912814', 1760537590, '+256-759912814', 'published', '1760537590', NULL, '---', 'Battery CG - Dry Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '40000', '50000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(33, '+256-759912814', 1760537644, '+256-759912814', 'published', '1760537644', NULL, '---', 'Battery K90 - 6w', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '15800', '25000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(34, '+256-759912814', 1760537688, '+256-759912814', 'published', '1760537688', NULL, '---', 'Battery Small - 4s', '', NULL, '', 'Pcs', '7', NULL, NULL, '0', '0', '20000', '25000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(35, '+256-759912814', 1760537727, '+256-759912814', 'published', '1760537727', NULL, '---', 'Battery small - J&L', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '21000', '25000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(36, '+256-759912814', 1760537832, '+256-759912814', 'published', '1760537832', NULL, '---', 'Ball Race Star', '', NULL, '', 'Pcs', '3', NULL, NULL, '0', '0', '4000', '6000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(37, '+256-759912814', 1760537915, '+256-759912814', 'published', '1760537915', NULL, '---', 'Ball Race CG - 4s', '', '', '', 'Pcs', '8', NULL, NULL, '0', '0', '3500', '6000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(38, '+256-759912814', 1760537982, '+256-759912814', 'published', '1760537982', NULL, '---', 'Wires Acc - Golden Choice ', '', NULL, '', 'Pcs', '304', NULL, NULL, '0', '0', '400', '1000', '700', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(39, '+256-759912814', 1760538245, '+256-759912814', 'published', '1760538245', NULL, '---', 'Bearing 6204', '', '', '', 'Pcs', '8', NULL, NULL, '0', '0', '4000', '6000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(40, '+256-759912814', 1760538314, '+256-759912814', 'published', '1760538314', NULL, '---', 'Bearing 6301 HM', '', '', '', 'Pcs', '44', NULL, NULL, '0', '0', '1300', '2500', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(41, '+256-759912814', 1760538412, '+256-759912814', 'published', '1760538412', NULL, '---', 'Bearing 6001 HM', '', '', '', 'Pcs', '44', NULL, NULL, '0', '0', '1200', '2500', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(42, '+256-759912814', 1760538450, '+256-759912814', 'published', '1760538450', NULL, '---', 'Bearing 6003 HM', '', NULL, '', 'Pcs', '24', NULL, NULL, '0', '0', '1300', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(43, '+256-759912814', 1760538494, '+256-759912814', 'published', '1760538494', NULL, '---', 'Bearing 6002 Royal', '', NULL, '', 'Pcs', '14', NULL, NULL, '0', '0', '1200', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(44, '+256-759912814', 1760538554, '+256-759912814', 'published', '1760538554', NULL, '---', 'Bearing 6200 HM', '', NULL, '', 'Pcs', '3', NULL, NULL, '0', '0', '1200', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(45, '+256-759912814', 1760538607, '+256-759912814', 'published', '1760538607', NULL, '---', 'Bearing 6003 Kevla', '', NULL, '', 'Pcs', '21', NULL, NULL, '0', '0', '1500', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(46, '+256-759912814', 1760538824, '+256-759912814', 'published', '1760538824', NULL, '---', 'Bearing 6004 RT', '', NULL, '', 'Pcs', '2', NULL, NULL, '0', '0', '1200', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(47, '+256-759912814', 1760538882, '+256-759912814', 'published', '1760538882', NULL, '---', 'Bearing 6304 J&L', '', NULL, '', 'Pcs', '3', NULL, NULL, '0', '0', '4000', '6000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(48, '+256-759912814', 1760538929, '+256-759912814', 'published', '1760538929', NULL, '---', 'Bearing 6201 Kevla', '', NULL, '', 'Pcs', '2', NULL, NULL, '0', '0', '1400', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(49, '+256-759912814', 1760538986, '+256-759912814', 'published', '1760538986', NULL, '---', 'Bearing 6305', '', NULL, '', 'Pcs', '4', NULL, NULL, '0', '0', '4000', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(50, '+256-759912814', 1760598596, '+256-759912814', 'published', '1760598596', NULL, '---', 'Bearing 6301 RT', '', NULL, '', 'Pcs', '29', NULL, NULL, '0', '0', '1300', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(51, '+256-759912814', 1760598596, '+256-759912814', 'published', '1760598596', NULL, '---', 'Bearing 6301 RT', '', NULL, '', 'Pcs', '29', NULL, NULL, '0', '0', '1300', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(52, '+256-759912814', 1760598662, '+256-759912814', 'published', '1760598662', NULL, '---', 'Bearing 6200 RT', '', NULL, '', 'Pcs', '20', NULL, NULL, '0', '0', '1300', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(53, '+256-759912814', 1760598862, '+256-759912814', 'published', '1760598862', NULL, '---', 'Bearing 6203 RT', '', NULL, '', 'Pcs', '93', NULL, NULL, '0', '0', '1300', '2500', '2000', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(54, '+256-759912814', 1760598923, '+256-759912814', 'published', '1760598923', NULL, '---', 'Battery Small JC', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '20000', '25000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(55, '+256-759912814', 1760598964, '+256-759912814', 'published', '1760598964', NULL, '---', 'Battery Small Kevra', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '24000', '28000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(56, '+256-759912814', 1760599023, '+256-759912814', 'published', '1760599023', NULL, '---', 'Battery Small RT', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '22000', '26000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(57, '+256-759912814', 1760599121, '+256-759912814', 'published', '1760599121', NULL, '---', 'Battery Small Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '24500', '28000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(58, '+256-759912814', 1760599181, '+256-759912814', 'published', '1760599181', NULL, '---', 'Battery Tuku Tuku', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '40500', '65000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(59, '+256-759912814', 1760599237, '+256-759912814', 'published', '1760599237', NULL, '---', 'Beads ', '', '', '', 'Pcs', '17', NULL, NULL, '0', '0', '1200', '2000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(60, '+256-759912814', 1760599476, '+256-759912814', 'published', '1760599476', NULL, '---', 'Bearing 6300 RT', '', NULL, '', 'Pcs', '59', NULL, NULL, '0', '0', '1200', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(61, '+256-759912814', 1760599577, '+256-759912814', 'published', '1760599577', NULL, '---', 'Bearing 6003 RT', '', NULL, '', 'Pcs', '116', NULL, NULL, '0', '0', '1300', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(62, '+256-759912814', 1760599664, '+256-759912814', 'published', '1760599664', NULL, '---', 'Bearing 6203 Kevra', '', NULL, '', 'Pcs', '8', NULL, NULL, '0', '0', '1500', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(63, '+256-759912814', 1760599804, '+256-759912814', 'published', '1760599804', NULL, '---', 'Bearing 6004 HM', '', NULL, '', 'Pcs', '27', NULL, NULL, '0', '0', '1400', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(64, '+256-759912814', 1760599854, '+256-759912814', 'published', '1760599854', NULL, '---', 'Bearing 6205 Kevra', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '4000', '6000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(65, '+256-759912814', 1760599907, '+256-759912814', 'published', '1760599907', NULL, '---', 'Bearing 628 HM', '', NULL, '', 'Pcs', '2', NULL, NULL, '0', '0', '1200', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(66, '+256-759912814', 1760600093, '+256-759912814', 'published', '1760600093', NULL, '---', 'Bearing 6004 Kevra', '', NULL, '', 'Pcs', '9', NULL, NULL, '0', '0', '2800', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(67, '+256-759912814', 1760600151, '+256-759912814', 'published', '1760600151', NULL, '---', 'Bearing 6304 Yog', '', NULL, '', 'Pcs', '9', NULL, NULL, '0', '0', '3000', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(68, '+256-759912814', 1760600196, '+256-759912814', 'published', '1760600196', NULL, '---', 'Bearing 6002 Kevra', '', NULL, '', 'Pcs', '12', NULL, NULL, '0', '0', '1800', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(69, '+256-759912814', 1760600270, '+256-759912814', 'published', '1760600270', NULL, '---', 'Bearing 6200 Kevra', '', NULL, '', 'Pcs', '6', NULL, NULL, '0', '0', '2000', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(70, '+256-759912814', 1760600361, '+256-759912814', 'published', '1760600361', NULL, '---', 'Bearing 6304 Kevra', '', NULL, '', 'Pcs', '7', NULL, NULL, '0', '0', '5000', '7000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(71, '+256-759912814', 1760600363, '+256-759912814', 'published', '1760600363', NULL, '---', 'Bearing 6304 Kevra', '', NULL, '', 'Pcs', '7', NULL, NULL, '0', '0', '5000', '7000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(72, '+256-759912814', 1760600461, '+256-759912814', 'published', '1760600461', NULL, '---', 'Bearing 6304 RT', '', NULL, '', 'Pcs', '11', NULL, NULL, '0', '0', '3000', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(73, '+256-759912814', 1760600464, '+256-759912814', 'published', '1760600464', NULL, '---', 'Bearing 6304 RT', '', NULL, '', 'Pcs', '11', NULL, NULL, '0', '0', '3000', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(74, '+256-759912814', 1760601059, '+256-759912814', 'published', '1760601059', NULL, '---', 'Big Horn', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '6100', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(75, '+256-759912814', 1760601102, '+256-759912814', 'published', '1760601102', NULL, '---', 'Big Horn J&L', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '14500', '20000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(76, '+256-759912814', 1760601161, '+256-759912814', 'published', '1760601161', NULL, '---', 'Brake shoes - Bifumbe', '', '', '', 'Pcs', '5', NULL, NULL, '0', '0', '2500', '5000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(77, '+256-759912814', 1760601227, '+256-759912814', 'published', '1760601227', NULL, '---', 'Bipiira Katama', '', NULL, '', 'Pcs', '93', NULL, NULL, '0', '0', '400', '1000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(78, '+256-759912814', 1760601276, '+256-759912814', 'published', '1760601276', NULL, '---', 'Bipiira Kiwato', '', NULL, '', 'Pcs', '00', NULL, NULL, '0', '0', '800', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(79, '+256-759912814', 1760601345, '+256-759912814', 'published', '1760601345', NULL, '---', 'Bipiira Mayembe', '', NULL, '', 'Pcs', '20', NULL, NULL, '0', '0', '400', '1000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(80, '+256-759912814', 1760601388, '+256-759912814', 'published', '1760601388', NULL, '---', 'Bipiira Shock Absorber', '', NULL, '', 'Pcs', '00', NULL, NULL, '0', '0', '500', '1000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(81, '+256-759912814', 1760601438, '+256-759912814', 'published', '1760601438', NULL, '---', 'Bipiira Tank', '', NULL, '', 'Pcs', '12', NULL, NULL, '0', '0', '1000', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(82, '+256-759912814', 1760601501, '+256-759912814', 'published', '1760601501', NULL, '---', 'Birevu Big', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '2000', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(83, '+256-759912814', 1760601543, '+256-759912814', 'published', '1760601543', NULL, '---', 'Birevu Big Malidad', '', NULL, '', 'Pcs', '11', NULL, NULL, '0', '0', '1250', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(84, '+256-759912814', 1760601580, '+256-759912814', 'published', '1760601580', NULL, '---', 'Birevu Small', '', NULL, '', 'Pcs', '00', NULL, NULL, '0', '0', '1200', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(85, '+256-759912814', 1760601627, '+256-759912814', 'published', '1760601627', NULL, '---', 'Birevu Small Local', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1000', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(86, '+256-759912814', 1760601676, '+256-759912814', 'published', '1760601676', NULL, '---', 'Grips Malidad', '', NULL, '', 'Pcs', '29', NULL, NULL, '0', '0', '2000', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(87, '+256-759912814', 1760601723, '+256-759912814', 'published', '1760601723', NULL, '---', 'Grips', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '2000', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(88, '+256-759912814', 1760601774, '+256-759912814', 'published', '1760601774', NULL, '---', 'Grips Padro', '', NULL, '', 'Pcs', '11', NULL, NULL, '0', '0', '3500', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(89, '+256-759912814', 1760601827, '+256-759912814', 'published', '1760601827', NULL, '---', 'Grips Kevra', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '2400', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(90, '+256-759912814', 1760601869, '+256-759912814', 'published', '1760601869', NULL, '---', 'Block Bj Kevra', '', '', '', 'Pcs', '1', NULL, NULL, '0', '0', '42000', '60000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(91, '+256-759912814', 1760601941, '+256-759912814', 'published', '1760601941', NULL, '---', 'Block Bj NYC', '', '', '', 'Pcs', '0', NULL, NULL, '0', '0', '48000', '65000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(92, '+256-759912814', 1760601996, '+256-759912814', 'published', '1760601996', NULL, '---', 'Block Bj RT', '', NULL, '', 'Pcs', '8', NULL, NULL, '0', '0', '41500', '60000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(93, '+256-759912814', 1760602039, '+256-759912814', 'published', '1760602039', NULL, '---', 'Block CG RT', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '42000', '60000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(94, '+256-759912814', 1760602764, '+256-759912814', 'published', '1760602764', NULL, '---', 'Bearing 6201', '', NULL, '', 'Pcs', '10', NULL, NULL, '0', '0', '1300', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(95, '+256-759912814', 1760602823, '+256-759912814', 'published', '1760602823', NULL, '---', 'Bearing 6202', '', NULL, '', 'Pcs', '31', NULL, NULL, '0', '0', '1300', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(96, '+256-759912814', 1760602894, '+256-759912814', 'published', '1760602894', NULL, '---', 'Bearing 6302', '', NULL, '', 'Pcs', '9', NULL, NULL, '0', '0', '1300', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(97, '+256-759912814', 1760603279, '+256-759912814', 'published', '1760603279', NULL, '---', 'Brake shoes - Rear Padro', '', NULL, '', 'Pcs', '12', NULL, NULL, '0', '0', '4500', '6000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(98, '+256-759912814', 1760603323, '+256-759912814', 'published', '1760603323', NULL, '---', 'Cables - Brake HM', '', '', '', 'Pcs', '7', NULL, NULL, '0', '0', '2300', '4000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(99, '+256-759912814', 1760603394, '+256-759912814', 'published', '1760603394', NULL, '---', 'Cables - Brake HLX', '', NULL, '', 'Pcs', '10', NULL, NULL, '0', '0', '2500', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(100, '+256-759912814', 1760603447, '+256-759912814', 'published', '1760603447', NULL, '---', 'Cylinder Axel ', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '2500', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(101, '+256-759912814', 1760603566, '+256-759912814', 'published', '1760603566', NULL, '---', 'Brake shoes - Rear RZ', '', NULL, '', 'Pcs', '34', NULL, NULL, '0', '0', '3200', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(102, '+256-759912814', 1760603619, '+256-759912814', 'published', '1760603619', NULL, '---', 'Brake Shoes - CG200', '', '', '', 'Pcs', '9', NULL, NULL, '0', '0', '9000', '15000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(103, '+256-759912814', 1760603688, '+256-759912814', 'published', '1760603688', NULL, '---', 'Block CG HM', '', '', '', 'Pcs', '2', NULL, NULL, '0', '0', '48000', '60000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(104, '+256-759912814', 1760603921, '+256-759912814', 'published', '1760603921', NULL, '---', 'Block Max', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '63500', '80000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(105, '+256-759912814', 1760603993, '+256-759912814', 'published', '1760603993', NULL, '---', 'Block Axle ', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '2500', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(106, '+256-759912814', 1760604187, '+256-759912814', 'published', '1760604187', NULL, '---', 'Bolts - double stand ', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '2500', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(107, '+256-759912814', 1760604229, '+256-759912814', 'published', '1760604229', NULL, '---', 'Bolts - engine', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '2000', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(108, '+256-759912814', 1760604276, '+256-759912814', 'published', '1760604276', NULL, '---', 'Bolts - Kiwato Bj', '', NULL, '', 'Pcs', '7', NULL, NULL, '0', '0', '2600', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(109, '+256-759912814', 1760604323, '+256-759912814', 'published', '1760604323', NULL, '---', 'Bolts - Kiwato CG', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '2500', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(110, '+256-759912814', 1760604364, '+256-759912814', 'published', '1760604364', NULL, '---', 'Bolts - Mayembe', '', NULL, '', 'Pcs', '00', NULL, NULL, '0', '0', '1000', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(111, '+256-759912814', 1760604435, '+256-759912814', 'published', '1760604435', NULL, '---', 'Bolts Big', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '400', '1000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(112, '+256-759912814', 1760604494, '+256-759912814', 'published', '1760604494', NULL, '---', 'Bolts medium', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '400', '1000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(113, '+256-759912814', 1760604539, '+256-759912814', 'published', '1760604539', NULL, '---', 'Bolts small', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '150', '500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(114, '+256-759912814', 1760604688, '+256-759912814', 'published', '1760604688', NULL, '---', 'Pump Short', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '4500', '7000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(115, '+256-759912814', 1760604752, '+256-759912814', 'published', '1760604752', NULL, '---', 'Pump Long small', '', NULL, '', 'Pcs', '4', NULL, NULL, '0', '0', '5500', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(116, '+256-759912814', 1760604795, '+256-759912814', 'published', '1760604795', NULL, '---', 'Bottle Holders', '', NULL, '', 'Pcs', '00', NULL, NULL, '0', '0', '4000', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(117, '+256-759912814', 1760604833, '+256-759912814', 'published', '1760604833', NULL, '---', 'Bottles', '', NULL, '', 'Pcs', '00', NULL, NULL, '0', '0', '4000', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(118, '+256-759912814', 1760604873, '+256-759912814', 'published', '1760604873', NULL, '---', 'Cables - Brake Kevra', '', NULL, '', 'Pcs', '00', NULL, NULL, '0', '0', '3300', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(119, '+256-759912814', 1760604916, '+256-759912814', 'published', '1760604916', NULL, '---', 'Cables - Brake Max', '', NULL, '', 'Pcs', '00', NULL, NULL, '0', '0', '2500', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(120, '+256-759912814', 1760604955, '+256-759912814', 'published', '1760604955', NULL, '---', 'Cables - Brake RT', '', NULL, '', 'Pcs', '5', NULL, NULL, '0', '0', '2200', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(121, '+256-759912814', 1760604996, '+256-759912814', 'published', '1760604996', NULL, '---', 'Cables - Brake yog', '', NULL, '', 'Pcs', '11', NULL, NULL, '0', '0', '3000', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(122, '+256-759912814', 1760605031, '+256-759912814', 'published', '1760605031', NULL, '---', 'Brake cover', '', NULL, '', 'Pcs', '00', NULL, NULL, '0', '0', '2000', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(123, '+256-759912814', 1760605069, '+256-759912814', 'published', '1760605069', NULL, '---', 'Brake fluid ', '', NULL, '', 'Pcs', '23', NULL, NULL, '0', '0', '3834', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(124, '+256-759912814', 1760605120, '+256-759912814', 'published', '1760605120', NULL, '---', 'Brake light cable ', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1700', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(125, '+256-759912814', 1760605161, '+256-759912814', 'published', '1760605161', NULL, '---', 'Brake Pedal Bj JC', '', NULL, '', 'Pcs', '15', NULL, NULL, '0', '0', '5000', '8000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(126, '+256-759912814', 1760605380, '+256-759912814', 'published', '1760605380', NULL, '---', 'Brake Pedal Bj RT', '', NULL, '', 'Pcs', '41', NULL, NULL, '0', '0', '6700', '8500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(127, '+256-759912814', 1760605421, '+256-759912814', 'published', '1760605421', NULL, '---', 'Brake Pedal Bj Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '7100', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(128, '+256-759912814', 1760605474, '+256-759912814', 'published', '1760605474', NULL, '---', 'Brake Pedal HLX', '', NULL, '', 'Pcs', '14', NULL, NULL, '0', '0', '6000', '8000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(129, '+256-759912814', 1760605517, '+256-759912814', 'published', '1760605517', NULL, '---', 'Brake Pedal CG', '', NULL, '', 'Pcs', '18', NULL, NULL, '0', '0', '4500', '7000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(130, '+256-759912814', 1760605556, '+256-759912814', 'published', '1760605556', NULL, '---', 'Brake Pedal Bj Kevra', '', NULL, '', 'Pcs', '3', NULL, NULL, '0', '0', '8500', '12000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(131, '+256-759912814', 1760605795, '+256-759912814', 'published', '1760605795', NULL, '---', 'brake Pedal Max', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '6000', '8000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(132, '+256-759912814', 1760605852, '+256-759912814', 'published', '1760605852', NULL, '---', 'Brake Shoe - CG', '', NULL, '', 'Pcs', '14', NULL, NULL, '0', '0', '3000', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(133, '+256-759912814', 1760605980, '+256-759912814', 'published', '1760605980', NULL, '---', 'Brake Shoe - Bj Beyond', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '3200', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(134, '+256-759912814', 1760606019, '+256-759912814', 'published', '1760606019', NULL, '---', 'Brake Shoe _ Bj Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '4700', '6000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(135, '+256-759912814', 1760606067, '+256-759912814', 'published', '1760606067', NULL, '---', 'Brake Shoe - Bj Front Kevra', '', '', '', 'Pcs', '16', NULL, NULL, '0', '0', '4000', '6000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(136, '+256-759912814', 1760606185, '+256-759912814', 'published', '1760606185', NULL, '---', 'Brake Shoe - Front Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '3760', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(137, '+256-759912814', 1760606286, '+256-759912814', 'published', '1760606286', NULL, '---', 'Brake Shoe HLX/K90', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '5300', '7000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(138, '+256-759912814', 1760606340, '+256-759912814', 'published', '1760606340', NULL, '---', 'Brake Shoe Bj - RZ Front', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '2900', '4500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(139, '+256-759912814', 1760606372, '+256-759912814', 'published', '1760606372', NULL, '---', 'Brake Shoe V50', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '3000', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(140, '+256-759912814', 1760606454, '+256-759912814', 'published', '1760606454', NULL, '---', 'Brake Shoe bj - Rear Kevra', '', NULL, '', 'Pcs', '16', NULL, NULL, '0', '0', '5000', '7000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(141, '+256-759912814', 1760606510, '+256-759912814', 'published', '1760606510', NULL, '---', 'Brake Spring', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '100', '500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(142, '+256-759912814', 1760606554, '+256-759912814', 'published', '1760606554', NULL, '---', 'Brake Springs Ling', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1500', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(143, '+256-759912814', 1760606812, '+256-759912814', 'published', '1760606812', NULL, '---', 'Block CG200 Kevra', '', '', '', 'Pcs', '2', NULL, NULL, '0', '0', '65000', '80000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(144, '+256-759912814', 1760607178, '+256-759912814', 'published', '1760607178', NULL, '---', 'Guards - Speed clock bj', '', NULL, '', 'Pcs', '3', NULL, NULL, '0', '0', '7000', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(145, '+256-759912814', 1760607291, '+256-759912814', 'published', '1760607291', NULL, '---', 'Buleega big Hole CG', '', NULL, '', 'Pcs', '2', NULL, NULL, '0', '0', '750', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(146, '+256-759912814', 1760607334, '+256-759912814', 'published', '1760607334', NULL, '---', 'Buleega big Hole HLX', '', '', '', 'Pcs', '20', NULL, NULL, '0', '0', '5000', '7000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(147, '+256-759912814', 1760607368, '+256-759912814', 'published', '1760607368', NULL, '---', 'Bunanga CT', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '1500', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(148, '+256-759912814', 1760607399, '+256-759912814', 'published', '1760607399', NULL, '---', 'Bubaati Clutch', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1500', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(149, '+256-759912814', 1760607441, '+256-759912814', 'published', '1760607441', NULL, '---', 'Bubaati Maaso', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '4000', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(150, '+256-759912814', 1760607545, '+256-759912814', 'published', '1760607545', NULL, '---', 'Bubakobakko', '', NULL, '', 'Pcs', '13', NULL, NULL, '0', '0', '4000', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(151, '+256-759912814', 1760607674, '+256-759912814', 'published', '1760607674', NULL, '---', 'Block CG200 RT', '', NULL, '', 'Pcs', '2', NULL, NULL, '0', '0', '50000', '70000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(152, '+256-759912814', 1760607727, '+256-759912814', 'published', '1760607727', NULL, '---', 'Bubazzi - Rear', '', NULL, '', 'Pcs', '24', NULL, NULL, '0', '0', '2500', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(153, '+256-759912814', 1760607783, '+256-759912814', 'published', '1760607783', NULL, '---', 'Bubazzi - Front', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '3000', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(154, '+256-759912814', 1760608184, '+256-759912814', 'published', '1760608184', NULL, '---', 'Buleega big Hole Bj', '', NULL, '', 'Pcs', '50', NULL, NULL, '0', '0', '600', '1500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(155, '+256-759912814', 1760608229, '+256-759912814', 'published', '1760608229', NULL, '---', 'Bugalo Brake Bj', '', NULL, '', 'Pcs', '9', NULL, NULL, '0', '0', '1500', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(156, '+256-759912814', 1760608277, '+256-759912814', 'published', '1760608277', NULL, '---', 'Bugalo Brake Max', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1500', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(157, '+256-759912814', 1760608369, '+256-759912814', 'published', '1760608369', NULL, '---', 'Bugalo CG', '', NULL, '', 'Pcs', '48', NULL, NULL, '0', '0', '1000', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(158, '+256-759912814', 1760608417, '+256-759912814', 'published', '1760608417', NULL, '---', 'Bugalo Clutch Bj', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1500', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(159, '+256-759912814', 1760608457, '+256-759912814', 'published', '1760608457', NULL, '---', 'Bugalo HLX', '', NULL, '', 'Pcs', '2', NULL, NULL, '0', '0', '2500', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(160, '+256-759912814', 1760608499, '+256-759912814', 'published', '1760608499', NULL, '---', 'Bugalo K90', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1350', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(161, '+256-759912814', 1760608541, '+256-759912814', 'published', '1760608541', NULL, '---', 'Bulb Holder Kevra', '', NULL, '', 'Pcs', '21', NULL, NULL, '0', '0', '2500', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(162, '+256-759912814', 1760608885, '+256-759912814', 'published', '1760608885', NULL, '---', 'Bulb Holder Kyuma', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1500', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(163, '+256-759912814', 1760608931, '+256-759912814', 'published', '1760608931', NULL, '---', 'Bulb Holders Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '2800', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(164, '+256-759912814', 1760608981, '+256-759912814', 'published', '1760608981', NULL, '---', 'Bulb Kisaawa', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '300', '500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(165, '+256-759912814', 1760609045, '+256-759912814', 'published', '1760609045', NULL, '---', 'Bunanga 13T', '', NULL, '', 'Pcs', '195', NULL, NULL, '0', '0', '1500', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(166, '+256-759912814', 1760609091, '+256-759912814', 'published', '1760609091', NULL, '---', 'Bunanga 14T', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1500', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(167, '+256-759912814', 1760609128, '+256-759912814', 'published', '1760609128', NULL, '---', 'Bunanga CG', '', NULL, '', 'Pcs', '5', NULL, NULL, '0', '0', '1800', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(168, '+256-759912814', 1760609163, '+256-759912814', 'published', '1760609163', NULL, '---', 'Bunanga HLX', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1500', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(169, '+256-759912814', 1760609202, '+256-759912814', 'published', '1760609202', NULL, '---', 'Bunanga Kevra', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1700', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(170, '+256-759912814', 1760609235, '+256-759912814', 'published', '1760609235', NULL, '---', 'Bunanga Max', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '1500', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(171, '+256-759912814', 1760609267, '+256-759912814', 'published', '1760609267', NULL, '---', 'Bunanga Yog', '', NULL, '', 'Pcs', '27', NULL, NULL, '0', '0', '1700', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(172, '+256-759912814', 1760609463, '+256-759912814', 'published', '1760609463', NULL, '---', 'Bupiira Gabo Bj', '', NULL, '', 'Pcs', '39', NULL, NULL, '0', '0', '500', '1000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(173, '+256-759912814', 1760609560, '+256-759912814', 'published', '1760609560', NULL, '---', 'Butaawo Mate', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '18000', '30000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(174, '+256-759912814', 1760609602, '+256-759912814', 'published', '1760609602', NULL, '---', 'Side Cover Bj 4s', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '12000', '17000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(175, '+256-759912814', 1760609654, '+256-759912814', 'published', '1760609654', NULL, '---', 'Side Cover Bj Kevra', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '13500', '20000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(176, '+256-759912814', 1760609698, '+256-759912814', 'published', '1760609698', NULL, '---', 'Side Cover CG', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '12500', '17000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL);
INSERT INTO `products` (`id`, `owner_mobile`, `timestamp`, `added_by`, `status`, `last_updated`, `sync`, `---`, `name`, `category`, `tax`, `description`, `measuring_unit`, `available_stock`, `stock_on_locations`, `stock_value`, `min_stock_limit`, `max_stock_limit`, `purchase_cost`, `sale_price`, `wholesale_price`, `total_purchase`, `total_sale`, `weight`, `sku`, `barcode`, `category_id`, `platforms`, `youtube_link`, `title`, `product_description`, `tags`, `notes`, `variants`, `secondary_unit_count`, `secondary_units`, `lend_inventory`, `salesman_commission`, `agent_commission`) VALUES
(177, '+256-759912814', 1760609742, '+256-759912814', 'published', '1760609742', NULL, '---', 'Side Cover HLX', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '20000', '25000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(178, '+256-759912814', 1760609777, '+256-759912814', 'published', '1760609777', NULL, '---', 'Bupiira Gabo HLX', '', NULL, '', 'Pcs', '79', NULL, NULL, '0', '0', '400', '1000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(179, '+256-759912814', 1760609832, '+256-759912814', 'published', '1760609832', NULL, '---', 'Side Cover Max', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '15700', '20000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(180, '+256-759912814', 1760609860, '+256-759912814', 'published', '1760609860', NULL, '---', 'Buuso', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '200', '500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(181, '+256-759912814', 1760609905, '+256-759912814', 'published', '1760609905', NULL, '---', 'cable Holdres', '', NULL, '', 'Pcs', '23', NULL, NULL, '0', '0', '1000', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(182, '+256-759912814', 1760610098, '+256-759912814', 'published', '1760610098', NULL, '---', 'Bugalo Clutch Bj Kevra', '', NULL, '', 'Pcs', '22', NULL, NULL, '0', '0', '2000', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(183, '+256-759912814', 1760610163, '+256-759912814', 'published', '1760610163', NULL, '---', 'Bulb - Head Mate', '', NULL, '', 'Pcs', '6', NULL, NULL, '0', '0', '700', '1000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(184, '+256-759912814', 1760610237, '+256-759912814', 'published', '1760610237', NULL, '---', 'Bulb RT - Fish Eye', '', NULL, '', 'Pcs', '2', NULL, NULL, '0', '0', '7500', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(185, '+92-3002564543', 1760742624, '+92-3002564543', 'published', '1760742624', NULL, '---', 'Name', 'Barcode', NULL, NULL, 'Tags', 'Available s', NULL, NULL, 'purchase co', '0', 'Sale Price', 'status', '0', NULL, NULL, NULL, NULL, NULL, NULL, ',moqame.com', '', '', '', 'bulk_import', '', NULL, 0, '[]', 'off', NULL, NULL),
(186, '+92-3002564543', 1760742825, '+92-3002564543', 'published', '1760742825', NULL, '---', 'Name', 'Barcode', NULL, NULL, 'Tags', 'Available s', NULL, NULL, 'purchase co', '0', 'Sale Price', 'status', '0', NULL, NULL, NULL, NULL, NULL, NULL, ',moqame.com', '', '', '', 'bulk_import', '', NULL, 0, '[]', 'off', NULL, NULL),
(187, '+256-759912814', 1760776776, '+256-759912814', 'published', '1760776776', NULL, '---', 'Chain System Padro', '', NULL, '', 'Pcs', '2', NULL, NULL, '0', '0', '25000', '35000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(188, '+256-759912814', 1760776829, '+256-759912814', 'published', '1760776829', NULL, '---', 'Chain system - Neeky', '', '', '', 'Pcs', '8', NULL, NULL, '0', '0', '20000', '30000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(189, '+256-759912814', 1760776887, '+256-759912814', 'published', '1760776887', NULL, '---', 'Chain system - Golden power', '', '', '', 'Pcs', '28', NULL, NULL, '0', '0', '24000', '30000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(190, '+256-759912814', 1760776941, '+256-759912814', 'published', '1760776941', NULL, '---', 'Carburetor - YBR ', '', NULL, '', 'Pcs', '2', NULL, NULL, '0', '0', '72000', '85000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(191, '+256-759912814', 1760777081, '+256-759912814', 'published', '1760777081', NULL, '---', 'Chain Kevra', '', NULL, '', 'Pcs', '24', NULL, NULL, '0', '0', '13000', '14000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(192, '+256-759912814', 1760777131, '+256-759912814', 'published', '1760777131', NULL, '---', 'Chain system - MM', '', NULL, '', 'Pcs', '2', NULL, NULL, '0', '0', '20000', '25000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(193, '+256-759912814', 1760777372, '+256-759912814', 'published', '1760777372', NULL, '---', 'Chain system - Lion', '', '', '', 'Pcs', '5', NULL, NULL, '0', '0', '25000', '30000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(194, '+256-759912814', 1760778026, '+256-759912814', 'published', '1760778026', NULL, '---', 'Chain system Bj - RT', '', '', '', 'Pcs', '79', NULL, NULL, '0', '0', '24000', '30000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(195, '+256-759912814', 1760778116, '+256-759912814', 'published', '1760778116', NULL, '---', 'Chain Bj - Yog', '', '', '', 'Pcs', '43', NULL, NULL, '0', '0', '9500', '13000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(196, '+256-759912814', 1760778193, '+256-759912814', 'published', '1760778193', NULL, '---', 'Chain system - HLX RT', '', NULL, '', 'Pcs', '7', NULL, NULL, '0', '0', '24000', '30000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(197, '+256-759912814', 1760778259, '+256-759912814', 'published', '1760778259', NULL, '---', 'Chain system 4s', '', NULL, '', 'Pcs', '9', NULL, NULL, '0', '0', '22000', '27000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(198, '+256-759912814', 1760778356, '+256-759912814', 'published', '1760778356', NULL, '---', 'Chain system bj - Kevra', '', NULL, '', 'Pcs', '18', NULL, NULL, '0', '0', '27000', '33000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(199, '+256-759912814', 1760778425, '+256-759912814', 'published', '1760778425', NULL, '---', 'Chain Yog CT124', '', NULL, '', 'Pcs', '22', NULL, NULL, '0', '0', '11500', '14000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(200, '+256-759912814', 1760778594, '+256-759912814', 'published', '1760778594', NULL, '---', 'Chain system - RK CT125', '', '', '', 'Pcs', '9', NULL, NULL, '0', '0', '25000', '33000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(201, '+256-759912814', 1760778961, '+256-759912814', 'published', '1760778961', NULL, '---', 'Carburator kit CG', '', '', '', 'Pcs', '8', NULL, NULL, '0', '0', '2800', '5000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(202, '+256-759912814', 1760779070, '+256-759912814', 'published', '1760779070', NULL, '---', 'Guard - Number plate', '', NULL, '', 'Pcs', '6', NULL, NULL, '0', '0', '7000', '12000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(203, '+256-759912814', 1760779308, '+256-759912814', 'published', '1760779308', NULL, '---', 'Head lump - CG200', '', NULL, '', 'Pcs', '2', NULL, NULL, '0', '0', '17500', '30000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(204, '+256-759912814', 1760779367, '+256-759912814', 'published', '1760779367', NULL, '---', 'Exhaust Pipe HLX', '', '', '', 'Pcs', '1', NULL, NULL, '0', '0', '95000', '120000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(205, '+256-759912814', 1760779465, '+256-759912814', 'published', '1760779465', NULL, '---', 'speed housing - Old Model', '', NULL, '', 'Pcs', '3', NULL, NULL, '0', '0', '4000', '6000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(206, '+256-759912814', 1760779516, '+256-759912814', 'published', '1760779516', NULL, '---', 'Rim - Rear HLX ', '', '', '', 'Pcs', '1', NULL, NULL, '0', '0', '105000', '130000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(207, '+256-759912814', 1760779563, '+256-759912814', 'published', '1760779563', NULL, '---', 'Rim - Front HLX', '', '', '', 'Pcs', '2', NULL, NULL, '0', '0', '96000', '120000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(208, '+256-759912814', 1760779638, '+256-759912814', 'published', '1760779638', NULL, '---', 'Seat - CG', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '45000', '60000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(209, '+256-759912814', 1760779696, '+256-759912814', 'published', '1760779696', NULL, '---', 'Guard - Front Bj', '', '', '', 'Pcs', '7', NULL, NULL, '0', '0', '17000', '20000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(210, '+256-759912814', 1760779896, '+256-759912814', 'published', '1760779896', NULL, '---', 'Katimba Bj', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '35000', '40000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(211, '+256-759912814', 1760780142, '+256-759912814', 'published', '1760780142', NULL, '---', 'Guard - Front HLX', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '17000', '20000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(212, '+256-759912814', 1760780195, '+256-759912814', 'published', '1760780195', NULL, '---', 'Came Shaft CG', '', NULL, '', 'Pcs', '2', NULL, NULL, '0', '0', '13000', '16000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(213, '+256-759912814', 1760780236, '+256-759912814', 'published', '1760780236', NULL, '---', 'Came Shaft Bj - Yog ', '', '', '', 'Pcs', '3', NULL, NULL, '0', '0', '11000', '15000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(214, '+256-759912814', 1760780291, '+256-759912814', 'published', '1760780291', NULL, '---', 'Carburator Bj - RT', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '21500', '40000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(215, '+256-759912814', 1760780334, '+256-759912814', 'published', '1760780334', NULL, '---', 'Carburator kit Original ', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '3000', '6000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(216, '+256-759912814', 1760780384, '+256-759912814', 'published', '1760780384', NULL, '---', 'Carburator CG - RT', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '25500', '30000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(217, '+256-759912814', 1760780428, '+256-759912814', 'published', '1760780428', NULL, '---', 'Carurator HLX - RT', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '72000', '90000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(218, '+256-759912814', 1760780466, '+256-759912814', 'published', '1760780466', NULL, '---', 'Carburator Joint', '', NULL, '', 'Pcs', '11', NULL, NULL, '0', '0', '3000', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(219, '+256-759912814', 1760780520, '+256-759912814', 'published', '1760780520', NULL, '---', 'Carburator kits Bj', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '3800', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(220, '+256-759912814', 1760780574, '+256-759912814', 'published', '1760780574', NULL, '---', 'Carburator Kit - CG', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '2800', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(221, '+256-759912814', 1760780618, '+256-759912814', 'published', '1760780618', NULL, '---', 'Carrier Bj', '', NULL, '', 'Pcs', '3', NULL, NULL, '0', '0', '28000', '35000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(222, '+256-759912814', 1760780659, '+256-759912814', 'published', '1760780659', NULL, '---', 'Carrier Kevra', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '33000', '40000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(223, '+256-759912814', 1760780700, '+256-759912814', 'published', '1760780700', NULL, '---', 'Carrier Max', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '18000', '25000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(224, '+256-759912814', 1760780738, '+256-759912814', 'published', '1760780738', NULL, '---', 'Tyres - CC Rear', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '52000', '60000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(225, '+256-759912814', 1760780801, '+256-759912814', 'published', '1760780801', NULL, '---', 'Center Clutch Shaft - Kevra', '', '', '', 'Pcs', '0', NULL, NULL, '0', '0', '28000', '35000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(226, '+256-759912814', 1760780870, '+256-759912814', 'published', '1760780870', NULL, '---', 'Center Clutch Shaft', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '25000', '30000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(227, '+256-759912814', 1760780924, '+256-759912814', 'published', '1760780924', NULL, '---', 'Chain 4s', '', NULL, '', 'Pcs', '60', NULL, NULL, '0', '0', '9500', '13000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(228, '+256-759912814', 1760780965, '+256-759912814', 'published', '1760780965', NULL, '---', 'Chain Beyond', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '11000', '13000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(229, '+256-759912814', 1760781001, '+256-759912814', 'published', '1760781001', NULL, '---', 'Chain J&L ', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '13000', '14000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(230, '+256-759912814', 1760781052, '+256-759912814', 'published', '1760781052', NULL, '---', 'Chain Crocodile', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '13000', '14000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(231, '+256-759912814', 1760781114, '+256-759912814', 'published', '1760781114', NULL, '---', 'Chain HLX Kevra', '', NULL, '', 'Pcs', '3', NULL, NULL, '0', '0', '12500', '14000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(232, '+256-759912814', 1760781150, '+256-759912814', 'published', '1760781150', NULL, '---', 'Chain JCJC', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '10500', '13000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(233, '+256-759912814', 1760781181, '+256-759912814', 'published', '1760781181', NULL, '---', 'Chain Lock', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '2500', '3500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(234, '+256-759912814', 1760781211, '+256-759912814', 'published', '1760781211', NULL, '---', 'Chain Mate ', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '7000', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(235, '+256-759912814', 1760781240, '+256-759912814', 'published', '1760781240', NULL, '---', 'Chain MM', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '9000', '12000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(236, '+256-759912814', 1760781338, '+256-759912814', 'published', '1760781338', NULL, '---', 'Chain system J&L', '', NULL, '', 'Pcs', '3', NULL, NULL, '0', '0', '24000', '30000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(237, '+256-759912814', 1760781418, '+256-759912814', 'published', '1760781418', NULL, '---', 'Chain system HLX - Kevra ', '', NULL, '', 'Pcs', '9', NULL, NULL, '0', '0', '28000', '35000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(238, '+256-759912814', 1760781523, '+256-759912814', 'published', '1760781523', NULL, '---', 'Chain system HLX - Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '24500', '30000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(239, '+256-759912814', 1760781586, '+256-759912814', 'published', '1760781586', NULL, '---', 'Chain system Bj - Yog', '', '', '', 'Pcs', '9', NULL, NULL, '0', '0', '24000', '30000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(240, '+256-759912814', 1760781627, '+256-759912814', 'published', '1760781627', NULL, '---', 'Chain system K90', '', NULL, '', 'Pcs', '3', NULL, NULL, '0', '0', '26500', '32000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(241, '+256-759912814', 1760781782, '+256-759912814', 'published', '1760781782', NULL, '---', 'Chain System Bj - RZ', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '24000', '30000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(242, '+256-759912814', 1760781914, '+256-759912814', 'published', '1760781914', NULL, '---', 'Tyres - Champion', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '35000', '45000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(243, '+256-759912814', 1760782543, '+256-759912814', 'published', '1760782543', NULL, '---', 'Carburator Joint ', '', '', '', 'Pcs', '8', NULL, NULL, '0', '0', '3000', '5000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(244, '+256-759912814', 1760867127, '+256-759912814', 'published', '1760867127', NULL, '---', 'Carburator CG200', '', '', '', 'Pcs', '1', NULL, NULL, '0', '0', '25500', '40000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(245, '+256-759912814', 1760867196, '+256-759912814', 'published', '1760867196', NULL, '---', 'Carrier CG125 big', '', '', '', 'Pcs', '1', NULL, NULL, '0', '0', '28000', '40000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(246, '+256-759912814', 1760867385, '+256-759912814', 'published', '1760867385', NULL, '---', 'Cables - Choke Yog', '', '', '', 'Pcs', '2', NULL, NULL, '0', '0', '2000', '3000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(247, '+256-759912814', 1760867466, '+256-759912814', 'published', '1760867466', NULL, '---', 'Clutch Plate - Metals', '', NULL, '', 'Pcs', '7', NULL, NULL, '0', '0', '3000', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(248, '+256-759912814', 1760867669, '+256-759912814', 'published', '1760867669', NULL, '---', 'Carrier CG125 Small', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '25000', '35000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(249, '+256-759912814', 1760867763, '+256-759912814', 'published', '1760867763', NULL, '---', 'Clutch Disk CG200 Complete', '', '', '', 'Pcs', '2', NULL, NULL, '0', '0', '30000', '40000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(250, '+256-759912814', 1760867835, '+256-759912814', 'published', '1760867835', NULL, '---', 'Clutch housing CG150', '', NULL, '', 'Pcs', '2', NULL, NULL, '0', '0', '25000', '35000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(251, '+256-759912814', 1760867979, '+256-759912814', 'published', '1760867979', NULL, '---', 'Clutch Disk RT - Incomplete ', '', '', '', 'Pcs', '38', NULL, NULL, '0', '0', '8500', '12000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(252, '+256-759912814', 1760867979, '+256-759912814', 'published', '1760867979', NULL, '---', 'Clutch Disk RT - Incomplete ', '', '', '', 'Pcs', '38', NULL, NULL, '0', '0', '9000', '13000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(253, '+256-759912814', 1760868174, '+256-759912814', 'published', '1760868174', NULL, '---', 'Clutch plate - Beyond', '', NULL, '', 'Pcs', '48', NULL, NULL, '0', '0', '4200', '6000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(254, '+256-759912814', 1760868212, '+256-759912814', 'published', '1760868212', NULL, '---', 'Carburator Kit Bj - Kevra', '', NULL, '', 'Pcs', '17', NULL, NULL, '0', '0', '5000', '6000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(255, '+256-759912814', 1760868273, '+256-759912814', 'published', '1760868273', NULL, '---', 'Clutch Disk BM150 - Complete', '', '', '', 'Pcs', '5', NULL, NULL, '0', '0', '24000', '35000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(256, '+256-759912814', 1760868327, '+256-759912814', 'published', '1760868327', NULL, '---', 'Cables - Clutch CG125', '', NULL, '', 'Pcs', '5', NULL, NULL, '0', '0', '2500', '3500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(257, '+256-759912814', 1760868425, '+256-759912814', 'published', '1760868425', NULL, '---', 'Cables - Choke Bj RT', '', '', '', 'Pcs', '40', NULL, NULL, '0', '0', '1600', '3000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(258, '+256-759912814', 1760868462, '+256-759912814', 'published', '1760868462', NULL, '---', 'Cables - Choke HLX', '', NULL, '', 'Pcs', '20', NULL, NULL, '0', '0', '1700', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(259, '+256-759912814', 1760868501, '+256-759912814', 'published', '1760868501', NULL, '---', 'Cables - Choke K90', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '2000', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(260, '+256-759912814', 1760868683, '+256-759912814', 'published', '1760868683', NULL, '---', 'Circle Springs - Brake ', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '850', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(261, '+256-759912814', 1760869583, '+256-759912814', 'published', '1760869583', NULL, '---', 'Cables - Clutch Bj HM', '', NULL, '', 'Pcs', '21', NULL, NULL, '0', '0', '23000', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(262, '+256-759912814', 1760869630, '+256-759912814', 'published', '1760869630', NULL, '---', 'Cables - Clutch HLX', '', NULL, '', 'Pcs', '18', NULL, NULL, '0', '0', '2300', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(263, '+256-759912814', 1760869716, '+256-759912814', 'published', '1760869716', NULL, '---', 'Cables - Clutch Bj Kevra', '', NULL, '', 'Pcs', '18', NULL, NULL, '0', '0', '3000', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(264, '+256-759912814', 1760869752, '+256-759912814', 'published', '1760869752', NULL, '---', 'Cables - Clutch Max', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '2500', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(265, '+256-759912814', 1760869931, '+256-759912814', 'published', '1760869931', NULL, '---', 'Cables - Clutch RT', '', NULL, '', 'Pcs', '40', NULL, NULL, '0', '0', '2150', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(266, '+256-759912814', 1760869994, '+256-759912814', 'published', '1760869994', NULL, '---', 'Clutch Disk Complete - Golden Choice ', '', NULL, '', 'Pcs', '2', NULL, NULL, '0', '0', '16000', '20000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(267, '+256-759912814', 1760870047, '+256-759912814', 'published', '1760870047', NULL, '---', 'Clutch Disk bj - Yog Incomp', '', '', '', 'Pcs', '4', NULL, NULL, '0', '0', '9100', '12000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(268, '+256-759912814', 1760870214, '+256-759912814', 'published', '1760870214', NULL, '---', 'Clutch Disk Incomp ', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '9000', '12000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(269, '+256-759912814', 1760870288, '+256-759912814', 'published', '1760870288', NULL, '---', 'Clutch Disk Complete - CG', '', NULL, '', 'Pcs', '3', NULL, NULL, '0', '0', '18000', '25000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(270, '+256-759912814', 1760870357, '+256-759912814', 'published', '1760870357', NULL, '---', 'Clutch Plate Bk Complete - Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '18500', '23000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(271, '+256-759912814', 1760870502, '+256-759912814', 'published', '1760870502', NULL, '---', 'Clutch Disk Comp Bj - Kevra', '', NULL, '', 'Pcs', '5', NULL, NULL, '0', '0', '23500', '30000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(272, '+256-759912814', 1760974742, '+256-759912814', 'published', '1760974742', NULL, '---', 'Clutch disk comp RT', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '18000', '24000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(273, '+256-759912814', 1760974855, '+256-759912814', 'published', '1760974855', NULL, '---', 'Clutch disk incomp - Kevra', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '10500', '14000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(274, '+256-759912814', 1760974900, '+256-759912814', 'published', '1760974900', NULL, '---', 'Clutch disk - Star', '', NULL, '', 'Pcs', '3', NULL, NULL, '0', '0', '9000', '13000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(275, '+256-759912814', 1760974942, '+256-759912814', 'published', '1760974942', NULL, '---', 'Clutch Housing Bj', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '28900', '35000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(276, '+256-759912814', 1760975126, '+256-759912814', 'published', '1760975126', NULL, '---', 'Clutch housing CG200', '', NULL, '', 'Pcs', '2', NULL, NULL, '0', '0', '25000', '35000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(277, '+256-759912814', 1760975191, '+256-759912814', 'published', '1760975191', NULL, '---', 'Clutch housing bj - Kevra', '', NULL, '', 'Pcs', '3', NULL, NULL, '0', '0', '50000', '65000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(278, '+256-759912814', 1760975240, '+256-759912814', 'published', '1760975240', NULL, '---', 'Clutch housing bj - RT', '', NULL, '', 'Pcs', '7', NULL, NULL, '0', '0', '26000', '40000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(279, '+256-759912814', 1760975363, '+256-759912814', 'published', '1760975363', NULL, '---', 'Clutch housing bj - Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '29400', '40000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(280, '+256-759912814', 1760975364, '+256-759912814', 'published', '1760975364', NULL, '---', 'Clutch housing bj - Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '29400', '40000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(281, '+256-759912814', 1760975411, '+256-759912814', 'published', '1760975411', NULL, '---', 'Clutch plate - HLX', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '6000', '8000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(282, '+256-759912814', 1760975453, '+256-759912814', 'published', '1760975453', NULL, '---', 'Clutch plate - CG', '', NULL, '', 'Pcs', '17', NULL, NULL, '0', '0', '4700', '6000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(283, '+256-759912814', 1760975503, '+256-759912814', 'published', '1760975503', NULL, '---', 'Clutch plate - J&L', '', NULL, '', 'Pcs', '20', NULL, NULL, '0', '0', '4500', '6000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(284, '+256-759912814', 1760975546, '+256-759912814', 'published', '1760975546', NULL, '---', 'Clutch plate bj - Kevra', '', NULL, '', 'Pcs', '25', NULL, NULL, '0', '0', '6000', '8000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(285, '+256-759912814', 1760975588, '+256-759912814', 'published', '1760975588', NULL, '---', 'Clutch plate - Max', '', NULL, '', 'Pcs', '19', NULL, NULL, '0', '0', '4000', '6000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(286, '+256-759912814', 1760975667, '+256-759912814', 'published', '1760975667', NULL, '---', 'Clutch Plate - Baj Baj', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '6000', '8000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(287, '+256-759912814', 1760975732, '+256-759912814', 'published', '1760975732', NULL, '---', 'Clutch plate bj - RT', '', NULL, '', 'Pcs', '142', NULL, NULL, '0', '0', '3900', '6000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(288, '+256-759912814', 1760975830, '+256-759912814', 'published', '1760975830', NULL, '---', 'Clutch plate - CG200', '', '', '', 'Pcs', '0', NULL, NULL, '0', '0', '8000', '13000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(289, '+256-759912814', 1760975909, '+256-759912814', 'published', '1760975909', NULL, '---', 'Clutch plate bj - Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '4100', '6000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(290, '+256-759912814', 1760975957, '+256-759912814', 'published', '1760975957', NULL, '---', 'Clutch plate - V50', '', '', '', 'Pcs', '2', NULL, NULL, '0', '0', '5000', '7000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(291, '+256-759912814', 1760976021, '+256-759912814', 'published', '1760976021', NULL, '---', 'Wires - Clutch bj', '', '', '', 'Pcs', '190', NULL, NULL, '0', '0', '400', '1000', '700', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(292, '+256-759912814', 1760976099, '+256-759912814', 'published', '1760976099', NULL, '---', 'Wires - Clutch Max', '', '', '', 'Pcs', '0', NULL, NULL, '0', '0', '400', '1000', '700', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(293, '+256-759912814', 1760976152, '+256-759912814', 'published', '1760976152', NULL, '---', 'Connecting Rod HLX - Kevra', '', NULL, '', 'Pcs', '4', NULL, NULL, '0', '0', '17000', '20000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(294, '+256-759912814', 1760976213, '+256-759912814', 'published', '1760976213', NULL, '---', 'Connecting Rod - K90', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '14000', '20000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(295, '+256-759912814', 1760976257, '+256-759912814', 'published', '1760976257', NULL, '---', 'Connecting Rod bj - Kevra', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '18000', '22000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(296, '+256-759912814', 1760976342, '+256-759912814', 'published', '1760976342', NULL, '---', 'Clutch disk comp - CG200', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '30000', '40000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(297, '+256-759912814', 1760976518, '+256-759912814', 'published', '1760976518', NULL, '---', 'Clutch disk complete - HLX', '', '', '', 'Pcs', '5', NULL, NULL, '0', '0', '28000', '35000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(298, '+256-759912814', 1760976975, '+256-759912814', 'published', '1760976975', NULL, '---', 'Double stand bj', '', NULL, '', 'Pcs', '7', NULL, NULL, '0', '0', '12000', '15000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(299, '+256-759912814', 1760977062, '+256-759912814', 'published', '1760977062', NULL, '---', 'Springs - Double stand ', '', NULL, '', 'Pcs', '6', NULL, NULL, '0', '0', '500', '1000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(300, '+256-759912814', 1760977145, '+256-759912814', 'published', '1760977145', NULL, '---', 'Cut Out - HLX', '', '', '', 'Pcs', '10', NULL, NULL, '0', '0', '6800', '10000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(301, '+256-759912814', 1760977427, '+256-759912814', 'published', '1760977427', NULL, '---', 'Cyllinder head bj - Yog', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '135000', '160000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(302, '+256-759912814', 1760977474, '+256-759912814', 'published', '1760977474', NULL, '---', 'Cyllinder head bj - Kevra', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '170000', '200000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(303, '+256-759912814', 1761037680, '+256-759912814', 'published', '1761037680', NULL, '---', 'Connecting Rod bj - Yog ', '', NULL, '', 'Pcs', '2', NULL, NULL, '0', '0', '11200', '15000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(304, '+256-759912814', 1761037815, '+256-759912814', 'published', '1761037815', NULL, '---', 'Connecting Rod Star - Kevra', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '17000', '20000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(305, '+256-759912814', 1761037933, '+256-759912814', 'published', '1761037933', NULL, '---', 'Crank shaft - Beyond', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '50000', '60000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(306, '+256-759912814', 1761038043, '+256-759912814', 'published', '1761038043', NULL, '---', 'Crank Shaft CG - 4s', '', NULL, '', 'Pcs', '4', NULL, NULL, '0', '0', '45000', '55000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(307, '+256-759912814', 1761038098, '+256-759912814', 'published', '1761038098', NULL, '---', 'Crank shaft bj - Kevra', '', NULL, '', 'Pcs', '5', NULL, NULL, '0', '0', '65000', '80000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(308, '+256-759912814', 1761038141, '+256-759912814', 'published', '1761038141', NULL, '---', 'Crank shaft bj - Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '54400', '70000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(309, '+256-759912814', 1761038197, '+256-759912814', 'published', '1761038197', NULL, '---', 'Cross Bearing - CG200', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '10000', '15000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(310, '+256-759912814', 1761038318, '+256-759912814', 'published', '1761038318', NULL, '---', 'Cut out bj - Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '7800', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(311, '+256-759912814', 1761038379, '+256-759912814', 'published', '1761038379', NULL, '---', 'Cut out CG', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '5000', '8000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(312, '+256-759912814', 1761038500, '+256-759912814', 'published', '1761038500', NULL, '---', 'Dimmer Switch bj - Beyond', '', NULL, '', 'Pcs', '25', NULL, NULL, '0', '0', '8000', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(313, '+256-759912814', 1761038547, '+256-759912814', 'published', '1761038547', NULL, '---', 'Dimmer switch CG', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '6000', '9000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(314, '+256-759912814', 1761038614, '+256-759912814', 'published', '1761038614', NULL, '---', 'Dimmer Switch K90', '', NULL, '', 'Pcs', '6', NULL, NULL, '0', '0', '8000', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(315, '+256-759912814', 1761038667, '+256-759912814', 'published', '1761038667', NULL, '---', 'Dimmer switch bj - Kevra', '', NULL, '', 'Pcs', '8', NULL, NULL, '0', '0', '10000', '13000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(316, '+256-759912814', 1761038711, '+256-759912814', 'published', '1761038711', NULL, '---', 'Dimmer Switch - Mate', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '5000', '8000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(317, '+256-759912814', 1761038784, '+256-759912814', 'published', '1761038784', NULL, '---', 'Dimmer Switch - Max', '', NULL, '', 'Pcs', '21', NULL, NULL, '0', '0', '8000', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(318, '+256-759912814', 1761038882, '+256-759912814', 'published', '1761038882', NULL, '---', 'Dimmer switch bj - RT', '', NULL, '', 'Pcs', '78', NULL, NULL, '0', '0', '7750', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(319, '+256-759912814', 1761038932, '+256-759912814', 'published', '1761038932', NULL, '---', 'Dimmer switch - Star', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '9500', '12000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(320, '+256-759912814', 1761038973, '+256-759912814', 'published', '1761038973', NULL, '---', 'Dimmer switch - V50', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '7500', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(321, '+256-759912814', 1761039034, '+256-759912814', 'published', '1761039034', NULL, '---', 'Double Life Oil', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '12500', '14000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(322, '+256-759912814', 1761039113, '+256-759912814', 'published', '1761039113', NULL, '---', 'Springs - Double Stand HLX', '', NULL, '', 'Pcs', '9', NULL, NULL, '0', '0', '1000', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(323, '+256-759912814', 1761039183, '+256-759912814', 'published', '1761039183', NULL, '---', 'Bolts - double stand CG', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1000', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(324, '+256-759912814', 1761039238, '+256-759912814', 'published', '1761039238', NULL, '---', 'Drum Rubber bj', '', NULL, '', 'Pcs', '19', NULL, NULL, '0', '0', '2300', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(325, '+256-759912814', 1761039702, '+256-759912814', 'published', '1761039702', NULL, '---', 'Drum Rubber bj - Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '2400', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(326, '+256-759912814', 1761039781, '+256-759912814', 'published', '1761039781', NULL, '---', 'Battery - Dry CG 4s', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '32000', '40000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(327, '+256-759912814', 1761039833, '+256-759912814', 'published', '1761039833', NULL, '---', 'Battery - Dry CG JCJC', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '30000', '38000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(328, '+256-759912814', 1761039910, '+256-759912814', 'published', '1761039910', NULL, '---', 'Battery - Dry CG Kevra', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '38500', '45000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(329, '+256-759912814', 1761039958, '+256-759912814', 'published', '1761039958', NULL, '---', 'Eagle Antenna', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '5000', '8000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(330, '+256-759912814', 1761040049, '+256-759912814', 'published', '1761040049', NULL, '---', 'Pump - Big Metered', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '18000', '25000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(331, '+256-759912814', 1761040098, '+256-759912814', 'published', '1761040098', NULL, '---', 'pump big', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '8000', '12000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(332, '+256-759912814', 1761040155, '+256-759912814', 'published', '1761040155', NULL, '---', 'Eddagala lya Valve', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '4000', '7000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(333, '+256-759912814', 1761040210, '+256-759912814', 'published', '1761040210', NULL, '---', 'Emigwa', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1350', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(334, '+256-759912814', 1761040214, '+256-759912814', 'published', '1761040214', NULL, '---', 'Emigwa', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1350', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(335, '+256-759912814', 1761040298, '+256-759912814', 'published', '1761040298', NULL, '---', 'Plug cap', '', NULL, '', 'Pcs', '18', NULL, NULL, '0', '0', '1000', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(336, '+256-759912814', 1761040331, '+256-759912814', 'published', '1761040331', NULL, '---', 'Plug cap - Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1100', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(337, '+256-759912814', 1761040447, '+256-759912814', 'published', '1761040447', NULL, '---', 'Spokes RT', '', '', '', 'Pcs', '00', NULL, NULL, '0', '0', '167', '300', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(338, '+256-759912814', 1761040555, '+256-759912814', 'published', '1761040555', NULL, '---', 'Spokes Kevra', '', NULL, '', 'Pcs', '6', NULL, NULL, '0', '0', '223', '500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(339, '+256-759912814', 1761040599, '+256-759912814', 'published', '1761040599', NULL, '---', 'Spokes Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '167', '300', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(340, '+256-759912814', 1761040639, '+256-759912814', 'published', '1761040639', NULL, '---', 'Engine cover', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1000', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(341, '+256-759912814', 1761040675, '+256-759912814', 'published', '1761040675', NULL, '---', 'Engine Valve', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '4000', '6000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(342, '+256-759912814', 1761040727, '+256-759912814', 'published', '1761040727', NULL, '---', 'Dimmer switch CT', '', '', '', 'Pcs', '3', NULL, NULL, '2', '0', '8000', '12000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(343, '+256-759912814', 1761040797, '+256-759912814', 'published', '1761040797', NULL, '---', 'Cut out bj - Kevra', '', '', '', 'Pcs', '3', NULL, NULL, '0', '0', '8000', '12000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(344, '+256-759912814', 1761040861, '+256-759912814', 'published', '1761040861', NULL, '---', 'Dimmer Switch bj - J&L', '', NULL, '', 'Pcs', '49', NULL, NULL, '0', '0', '8000', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(345, '+256-759912814', 1761040978, '+256-759912814', 'published', '1761040978', NULL, '---', 'Foot Rest CG', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '2500', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(346, '+256-759912814', 1761041019, '+256-759912814', 'published', '1761041019', NULL, '---', 'Flasher J&L', '', NULL, '', 'Pcs', '2', NULL, NULL, '0', '0', '2000', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(347, '+256-759912814', 1761041087, '+256-759912814', 'published', '1761041087', NULL, '---', 'Engine Vale - Gomet/Simba', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '3800', '6000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(348, '+256-759912814', 1761041126, '+256-759912814', 'published', '1761041126', NULL, '---', 'Engine Valve - HLX', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '3500', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(349, '+256-759912814', 1761041197, '+256-759912814', 'published', '1761041197', NULL, '---', 'Engine Valve - Kevra', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '7500', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(350, '+256-759912814', 1761041268, '+256-759912814', 'published', '1761041268', NULL, '---', 'Engine valve - Baj baj', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '5000', '8000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL);
INSERT INTO `products` (`id`, `owner_mobile`, `timestamp`, `added_by`, `status`, `last_updated`, `sync`, `---`, `name`, `category`, `tax`, `description`, `measuring_unit`, `available_stock`, `stock_on_locations`, `stock_value`, `min_stock_limit`, `max_stock_limit`, `purchase_cost`, `sale_price`, `wholesale_price`, `total_purchase`, `total_sale`, `weight`, `sku`, `barcode`, `category_id`, `platforms`, `youtube_link`, `title`, `product_description`, `tags`, `notes`, `variants`, `secondary_unit_count`, `secondary_units`, `lend_inventory`, `salesman_commission`, `agent_commission`) VALUES
(351, '+256-759912814', 1761041346, '+256-759912814', 'published', '1761041346', NULL, '---', 'Enkoba', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '400', '1000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(352, '+256-759912814', 1761041347, '+256-759912814', 'published', '1761041347', NULL, '---', 'Enkoba', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '400', '1000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(353, '+256-759912814', 1761041514, '+256-759912814', 'published', '1761041514', NULL, '---', 'Enkoba big', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '900', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(354, '+256-759912814', 1761041574, '+256-759912814', 'published', '1761041574', NULL, '---', 'Ennanga 4s (Cheap)', '', '', '', 'Pcs', '21', NULL, NULL, '0', '0', '7000', '10000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(355, '+256-759912814', 1761041678, '+256-759912814', 'published', '1761041678', NULL, '---', 'Ennanga CG', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '7000', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(356, '+256-759912814', 1761041729, '+256-759912814', 'published', '1761041729', NULL, '---', 'Ennanga - Golden choice', '', NULL, '', 'Pcs', '14', NULL, NULL, '0', '0', '6000', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(357, '+256-759912814', 1761041767, '+256-759912814', 'published', '1761041767', NULL, '---', 'ennanga - HLX', '', NULL, '', 'Pcs', '6', NULL, NULL, '0', '0', '8300', '12000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(358, '+256-759912814', 1761041811, '+256-759912814', 'published', '1761041811', NULL, '---', 'Ennanga - HLX Beyond', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '9500', '13000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(359, '+256-759912814', 1761041971, '+256-759912814', 'published', '1761041971', NULL, '---', 'Ennanga K90', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '8000', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(360, '+256-759912814', 1761042019, '+256-759912814', 'published', '1761042019', NULL, '---', 'Ennanga bj - Kevra', '', NULL, '', 'Pcs', '9', NULL, NULL, '0', '0', '10500', '13000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(361, '+256-759912814', 1761042060, '+256-759912814', 'published', '1761042060', NULL, '---', 'Ennanga - Max', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '8000', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(362, '+256-759912814', 1761042104, '+256-759912814', 'published', '1761042104', NULL, '---', 'Ennanga - Star', '', NULL, '', 'Pcs', '9', NULL, NULL, '0', '0', '8000', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(363, '+256-759912814', 1761042143, '+256-759912814', 'published', '1761042143', NULL, '---', 'Ennanga - V50', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '7500', '10000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(364, '+256-759912814', 1761042190, '+256-759912814', 'published', '1761042190', NULL, '---', 'Ennanga bj - Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '8200', '12000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(365, '+256-759912814', 1761042235, '+256-759912814', 'published', '1761042235', NULL, '---', 'Enock oil', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '15840', '18000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(366, '+256-759912814', 1761042671, '+256-759912814', 'published', '1761042671', NULL, '---', 'Brake rod - Bj', '', NULL, '', 'Pcs', '238', NULL, NULL, '0', '0', '1150', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(367, '+256-759912814', 1761042736, '+256-759912814', 'published', '1761042736', NULL, '---', 'Brake rod - CG', '', NULL, '', 'Pcs', '19', NULL, NULL, '0', '0', '1200', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(368, '+256-759912814', 1761042781, '+256-759912814', 'published', '1761042781', NULL, '---', 'Brake rod - HLX', '', NULL, '', 'Pcs', '6', NULL, NULL, '0', '0', '1800', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(369, '+256-759912814', 1761042818, '+256-759912814', 'published', '1761042818', NULL, '---', 'Brake rod bj - Kevra', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '2500', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(370, '+256-759912814', 1761042869, '+256-759912814', 'published', '1761042869', NULL, '---', 'Brake rod bj - Yog', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1300', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(371, '+256-759912814', 1761042947, '+256-759912814', 'published', '1761042947', NULL, '---', 'Exhaust Pipe Bj', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '80500', '120000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(372, '+256-759912814', 1761042996, '+256-759912814', 'published', '1761042996', NULL, '---', 'Filter Cheap bj', '', NULL, '', 'Pcs', '5', NULL, NULL, '0', '0', '2200', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(373, '+256-759912814', 1761043045, '+256-759912814', 'published', '1761043045', NULL, '---', 'Filter CT', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '3500', '5000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(374, '+256-759912814', 1761043116, '+256-759912814', 'published', '1761043116', NULL, '---', 'Flasher bj HM', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '2000', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(375, '+256-759912814', 1761043181, '+256-759912814', 'published', '1761043181', NULL, '---', 'Flasher bj - RT', '', NULL, '', 'Pcs', '204', NULL, NULL, '0', '0', '2000', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(376, '+256-759912814', 1761043217, '+256-759912814', 'published', '1761043217', NULL, '---', 'Flasher bj - Kevra', '', NULL, '', 'Pcs', '9', NULL, NULL, '0', '0', '2200', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(377, '+256-759912814', 1761043256, '+256-759912814', 'published', '1761043256', NULL, '---', 'Floating Pins ', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '1500', '3000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(378, '+256-759912814', 1761043293, '+256-759912814', 'published', '1761043293', NULL, '---', 'Foot Bars bj', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '13000', '20000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(379, '+256-759912814', 1761043355, '+256-759912814', 'published', '1761043355', NULL, '---', 'Foot Rest bj - Yog', '', '', '', 'Pcs', '30', NULL, NULL, '0', '0', '2600', '3500', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(380, '+256-759912814', 1761043424, '+256-759912814', 'published', '1761043424', NULL, '---', 'Foot rest - HLX', '', '', '', 'Pcs', '2', NULL, NULL, '0', '0', '1500', '2500', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(381, '+256-759912814', 1761043480, '+256-759912814', 'published', '1761043480', NULL, '---', 'Foot Rest bj - Kevra', '', NULL, '', 'Pcs', '19', NULL, NULL, '0', '0', '1650', '2500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(382, '+256-759912814', 1761213772, '+256-759912814', 'published', '1761213772', NULL, '---', 'Endege', '', NULL, '', 'Pcs', '18', NULL, NULL, '0', '0', '3000', '4000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(383, '+256-759912814', 1763977323, '+256-759912814', 'published', '1763977323', NULL, '---', 'Fork Seals K90', '', NULL, '', 'Pcs', '8', NULL, NULL, '0', '0', '800', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(384, '+256-759912814', 1763982936, '+256-759912814', 'published', '1763982936', NULL, '---', 'Lay Guard Star', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '13000', '18000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(385, '+256-759912814', 1763984051, '+256-759912814', 'published', '1763984051', NULL, '---', 'Foot Rest J&L', '', NULL, '', 'Pcs', '17', NULL, NULL, '0', '0', '1250', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(386, '+256-759912814', 1763984136, '+256-759912814', 'published', '1763984136', NULL, '---', 'Fork seals UG Boss', '', NULL, '', 'Pcs', '3', NULL, NULL, '0', '0', '1000', '1500', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(387, '+256-759912814', 1763984215, '+256-759912814', 'published', '1763984215', NULL, '---', 'Foot Rest CG', '', NULL, '', 'Pcs', '16', NULL, NULL, '0', '0', '1250', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(388, '+256-759912814', 1763984486, '+256-759912814', 'published', '1763984486', NULL, '---', 'Mud Guard - HLX Front', '', NULL, '', 'Pcs', '5', NULL, NULL, '0', '0', '24000', '30000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(389, '+256-759912814', 1763984580, '+256-759912814', 'published', '1763984580', NULL, '---', 'Fork Seals Bj Beyond', '', NULL, '', 'Pcs', '10', NULL, NULL, '0', '0', '1000', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(390, '+256-759912814', 1763984682, '+256-759912814', 'published', '1763984682', NULL, '---', 'Foot rest Malidad', '', NULL, '', 'Pcs', '93', NULL, NULL, '0', '0', '1250', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(391, '+256-759912814', 1763984778, '+256-759912814', 'published', '1763984778', NULL, '---', 'Foot Rest - passenger', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '25000', '30000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(392, '+256-759912814', 1763984832, '+256-759912814', 'published', '1763984832', NULL, '---', 'Fork pipe ', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '18200', '25000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(393, '+256-759912814', 1763984883, '+256-759912814', 'published', '1763984883', NULL, '---', 'Fork Pipe J&L', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '19250', '26000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(394, '+256-759912814', 1763984930, '+256-759912814', 'published', '1763984930', NULL, '---', 'Fork Pipe Kevra', '', NULL, '', 'Pcs', '0', NULL, NULL, '0', '0', '19750', '27000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(395, '+256-759912814', 1763984971, '+256-759912814', 'published', '1763984971', NULL, '---', 'Fork Seals Original', '', NULL, '', 'Pcs', '11', NULL, NULL, '0', '0', '1000', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(396, '+256-759912814', 1763985575, '+256-759912814', 'published', '1763985575', NULL, '---', 'Fork Seals', '', '', '', 'Pcs', '58', NULL, NULL, '0', '0', '800', '2000', '0', NULL, NULL, NULL, '', '', NULL, 'moqame', '', '', '', ',,', '', NULL, 0, '[]', 'off', '', ''),
(397, '+256-759912814', 1763985628, '+256-759912814', 'published', '1763985628', NULL, '---', 'Fork Seals CG', '', NULL, '', 'Pcs', '19', NULL, NULL, '0', '0', '1000', '2000', '0', NULL, NULL, NULL, NULL, '', NULL, 'moqame', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, NULL),
(398, '+92-3335672555', 1764131548, '+92-3335672555', 'published', '1764131548', '', '---', 'fabric 76/68', '', NULL, '', 'Meter', '0', NULL, NULL, '0', '0', '400', '440', '420', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, ''),
(399, '+92-3335672555', 1764131599, '+92-3335672555', 'published', '1764131599', '', '---', 'Dbl BEdsheet', '', NULL, '', 'Pcs', '1', NULL, NULL, '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, 0, '[]', 'off', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `product_measuring_calc`
--

CREATE TABLE `product_measuring_calc` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `product_id` int(11) DEFAULT NULL,
  `primary_unit` varchar(30) DEFAULT NULL,
  `primary_unit_qty` varchar(30) DEFAULT NULL,
  `secondary_unit` varchar(30) DEFAULT NULL,
  `secondary_unit_qty` varchar(30) DEFAULT NULL,
  `price` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(99) DEFAULT NULL,
  `available_stock` varchar(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoices`
--

CREATE TABLE `purchase_invoices` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(500) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `posid` varchar(11) DEFAULT NULL,
  `cartitems` mediumtext DEFAULT NULL,
  `variants_json` mediumtext DEFAULT NULL,
  `secondary_json` text NOT NULL,
  `service_count` varchar(10) NOT NULL,
  `cart_items_services` text NOT NULL,
  `contact_number` varchar(30) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `sub_total` varchar(30) DEFAULT NULL,
  `discount` varchar(30) DEFAULT NULL,
  `tax` varchar(11) DEFAULT NULL,
  `grand_total` varchar(30) DEFAULT NULL,
  `cost_of_sale` text NOT NULL,
  `amount_paid` varchar(30) DEFAULT NULL,
  `payment_method` varchar(30) DEFAULT NULL,
  `remaining_amount` varchar(30) DEFAULT NULL,
  `location_id` varchar(9) DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL,
  `attachments` varchar(99) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoices_returns`
--

CREATE TABLE `purchase_invoices_returns` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `posid` varchar(11) NOT NULL,
  `cartitems` mediumtext DEFAULT NULL,
  `contact_number` varchar(30) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `sub_total` varchar(30) DEFAULT NULL,
  `discount` varchar(30) DEFAULT NULL,
  `grand_total` varchar(30) DEFAULT NULL,
  `amount_paid` varchar(30) DEFAULT NULL,
  `payment_method` varchar(30) DEFAULT NULL,
  `remaining_amount` varchar(30) DEFAULT NULL,
  `location_id` varchar(11) DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL,
  `variants_json` text NOT NULL,
  `secondary_json` text NOT NULL,
  `service_count` text NOT NULL,
  `cart_items_services` text NOT NULL,
  `tax` text NOT NULL,
  `cost_of_sale` text NOT NULL,
  `attachments` text NOT NULL,
  `custom_fields` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_invoices`
--

CREATE TABLE `sale_invoices` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(500) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `posid` varchar(11) DEFAULT NULL,
  `cartitems` mediumtext DEFAULT NULL,
  `variants_json` mediumtext DEFAULT NULL,
  `secondary_json` text DEFAULT NULL,
  `service_count` varchar(10) DEFAULT NULL,
  `cart_items_services` text DEFAULT NULL,
  `contact_number` varchar(30) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `sub_total` varchar(30) DEFAULT NULL,
  `discount` varchar(30) DEFAULT NULL,
  `tax` varchar(30) DEFAULT NULL,
  `grand_total` varchar(30) DEFAULT NULL,
  `amount_paid` varchar(30) DEFAULT NULL,
  `payment_method` varchar(30) DEFAULT NULL,
  `remaining_amount` varchar(30) DEFAULT NULL,
  `location_id` varchar(11) DEFAULT NULL,
  `cost_of_sale` varchar(20) DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL,
  `attachments` varchar(99) DEFAULT NULL,
  `custom_fields` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_invoices_returns`
--

CREATE TABLE `sale_invoices_returns` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `posid` varchar(11) NOT NULL,
  `cartitems` mediumtext DEFAULT NULL,
  `contact_number` varchar(30) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `sub_total` varchar(30) DEFAULT NULL,
  `discount` varchar(30) DEFAULT NULL,
  `grand_total` varchar(30) DEFAULT NULL,
  `amount_paid` varchar(30) DEFAULT NULL,
  `payment_method` varchar(30) DEFAULT NULL,
  `remaining_amount` varchar(30) DEFAULT NULL,
  `location_id` varchar(11) DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL,
  `variants_json` text DEFAULT NULL,
  `tax` varchar(99) DEFAULT NULL,
  `cost_of_sale` varchar(99) DEFAULT NULL,
  `secondary_json` text DEFAULT NULL,
  `cart_items_services` text DEFAULT NULL,
  `service_count` int(5) DEFAULT NULL,
  `attachments` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_quotations`
--

CREATE TABLE `sale_quotations` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `posid` varchar(11) DEFAULT NULL,
  `cartitems` mediumtext DEFAULT NULL,
  `variants_json` mediumtext DEFAULT NULL,
  `secondary_json` text DEFAULT NULL,
  `service_count` varchar(10) DEFAULT NULL,
  `cart_items_services` text DEFAULT NULL,
  `contact_number` varchar(30) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `sub_total` varchar(30) DEFAULT NULL,
  `discount` varchar(30) DEFAULT NULL,
  `tax` varchar(30) DEFAULT NULL,
  `grand_total` varchar(30) DEFAULT NULL,
  `amount_paid` varchar(30) DEFAULT NULL,
  `payment_method` varchar(30) DEFAULT NULL,
  `remaining_amount` varchar(30) DEFAULT NULL,
  `location_id` varchar(11) DEFAULT NULL,
  `cost_of_sale` varchar(20) DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL,
  `attachments` varchar(99) DEFAULT NULL,
  `custom_fields` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(500) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `name` text DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `category` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sale_price` varchar(11) DEFAULT NULL,
  `wholesale_price` varchar(11) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services_sale_history`
--

CREATE TABLE `services_sale_history` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_receipt_history`
--

CREATE TABLE `shipping_receipt_history` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `contact_number` varchar(30) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `total_expense` varchar(10) DEFAULT '0',
  `picker_guy` varchar(99) DEFAULT NULL,
  `unit1` varchar(30) DEFAULT NULL,
  `qty1` varchar(30) DEFAULT NULL,
  `unit2` varchar(30) DEFAULT NULL,
  `qty2` varchar(30) DEFAULT NULL,
  `unit3` varchar(30) DEFAULT NULL,
  `qty3` varchar(30) DEFAULT NULL,
  `unit4` varchar(30) DEFAULT NULL,
  `qty4` varchar(30) DEFAULT NULL,
  `unit5` varchar(30) DEFAULT NULL,
  `qty5` varchar(30) DEFAULT NULL,
  `unit6` varchar(30) DEFAULT NULL,
  `qty6` varchar(30) DEFAULT NULL,
  `unit7` varchar(30) DEFAULT NULL,
  `qty7` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_history`
--

CREATE TABLE `stock_history` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `product_id` int(11) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `qty` varchar(30) DEFAULT NULL,
  `in_out` varchar(30) DEFAULT NULL,
  `qty_before` varchar(30) DEFAULT NULL,
  `qty_after` varchar(30) DEFAULT NULL,
  `invoice_id` varchar(30) DEFAULT NULL,
  `measuring_unit` varchar(30) DEFAULT NULL,
  `unit_price` varchar(30) DEFAULT NULL,
  `total_price` varchar(30) DEFAULT NULL,
  `cost_per_unit` varchar(30) DEFAULT NULL,
  `profit_per_unit` varchar(30) DEFAULT NULL,
  `total_profit` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `stock_history`
--

INSERT INTO `stock_history` (`id`, `owner_mobile`, `timestamp`, `added_by`, `status`, `last_updated`, `sync`, `---`, `product_id`, `date`, `qty`, `in_out`, `qty_before`, `qty_after`, `invoice_id`, `measuring_unit`, `unit_price`, `total_price`, `cost_per_unit`, `profit_per_unit`, `total_profit`) VALUES
(1, '+256-759912814', 1760534721, '+256-759912814', 'Published', '1760534721', NULL, '---', 1, '2025-10-15', '00', 'in', '0', '00', NULL, 'Pcs', '25000', '0', NULL, NULL, NULL),
(2, '+256-759912814', 1760534896, '+256-759912814', 'Published', '1760534896', NULL, '---', 2, '2025-10-15', '0', 'in', '0', '0', NULL, 'Pcs', '6834', '0', NULL, NULL, NULL),
(3, '+256-759912814', 1760534985, '+256-759912814', 'Published', '1760534985', NULL, '---', 3, '2025-10-15', '1', 'in', '0', '1', NULL, 'Pcs', '6500', '6500', NULL, NULL, NULL),
(4, '+256-759912814', 1760535134, '+256-759912814', 'Published', '1760535134', NULL, '---', 4, '2025-10-15', '10', 'in', '0', '10', NULL, 'Pcs', '12084', '120840', NULL, NULL, NULL),
(5, '+256-759912814', 1760535562, '+256-759912814', 'Published', '1760535562', NULL, '---', 5, '2025-10-15', '10', 'in', '0', '10', NULL, 'Pcs', '2300', '23000', NULL, NULL, NULL),
(6, '+256-759912814', 1760535626, '+256-759912814', 'Published', '1760535626', NULL, '---', 6, '2025-10-15', '10', 'in', '0', '10', NULL, 'Pcs', '2800', '28000', NULL, NULL, NULL),
(7, '+256-759912814', 1760535683, '+256-759912814', 'Published', '1760535683', NULL, '---', 7, '2025-10-15', '10', 'in', '0', '10', NULL, 'Pcs', '3500', '35000', NULL, NULL, NULL),
(8, '+256-759912814', 1760535757, '+256-759912814', 'Published', '1760535757', NULL, '---', 8, '2025-10-15', '0', 'in', '0', '0', NULL, 'Pcs', '25000', '0', NULL, NULL, NULL),
(9, '+256-759912814', 1760535833, '+256-759912814', 'Published', '1760535833', NULL, '---', 9, '2025-10-15', '13', 'in', '0', '13', NULL, 'Pcs', '2300', '29900', NULL, NULL, NULL),
(10, '+256-759912814', 1760535908, '+256-759912814', 'Published', '1760535908', NULL, '---', 10, '2025-10-15', '8', 'in', '0', '8', NULL, 'Pcs', '2300', '18400', NULL, NULL, NULL),
(11, '+256-759912814', 1760535953, '+256-759912814', 'Published', '1760535953', NULL, '---', 11, '2025-10-15', '0', 'in', '0', '0', NULL, 'Pcs', '3000', '0', NULL, NULL, NULL),
(12, '+256-759912814', 1760536045, '+256-759912814', 'Published', '1760536045', NULL, '---', 12, '2025-10-15', '5', 'in', '0', '5', NULL, 'Pcs', '4000', '20000', NULL, NULL, NULL),
(13, '+256-759912814', 1760536149, '+256-759912814', 'Published', '1760536149', NULL, '---', 13, '2025-10-15', '4', 'in', '0', '4', NULL, 'Pcs', '2250', '9000', NULL, NULL, NULL),
(14, '+256-759912814', 1760536446, '+256-759912814', 'Published', '1760536446', NULL, '---', 14, '2025-10-15', '0', 'in', '0', '0', NULL, 'Pcs', '3000', '0', NULL, NULL, NULL),
(15, '+256-759912814', 1760536515, '+256-759912814', 'Published', '1760536515', NULL, '---', 15, '2025-10-15', '10', 'in', '0', '10', NULL, 'Pcs', '3000', '30000', NULL, NULL, NULL),
(16, '+256-759912814', 1760536582, '+256-759912814', 'Published', '1760536582', NULL, '---', 16, '2025-10-15', '0', 'in', '0', '0', NULL, 'Pcs', '2500', '0', NULL, NULL, NULL),
(17, '+256-759912814', 1760536652, '+256-759912814', 'Published', '1760536652', NULL, '---', 17, '2025-10-15', '6', 'in', '0', '6', NULL, 'Pcs', '400', '2400', NULL, NULL, NULL),
(18, '+256-759912814', 1760536691, '+256-759912814', 'Published', '1760536691', NULL, '---', 18, '2025-10-15', '0', 'in', '0', '0', NULL, 'Pcs', '6500', '0', NULL, NULL, NULL),
(19, '+256-759912814', 1760536703, '+256-759912814', 'Published', '1760536703', NULL, '---', 19, '2025-10-15', '0', 'in', '0', '0', NULL, 'Pcs', '6500', '0', NULL, NULL, NULL),
(20, '+256-759912814', 1760536867, '+256-759912814', 'Published', '1760536867', NULL, '---', 20, '2025-10-15', '14', 'in', '0', '14', NULL, 'Pcs', '1200', '16800', NULL, NULL, NULL),
(21, '+256-759912814', 1760536918, '+256-759912814', 'Published', '1760536918', NULL, '---', 21, '2025-10-15', '0', 'in', '0', '0', NULL, 'Pcs', '1000', '0', NULL, NULL, NULL),
(22, '+256-759912814', 1760536970, '+256-759912814', 'Published', '1760536970', NULL, '---', 22, '2025-10-15', '0', 'in', '0', '0', NULL, 'Pcs', '600', '0', NULL, NULL, NULL),
(23, '+256-759912814', 1760537036, '+256-759912814', 'Published', '1760537036', NULL, '---', 23, '2025-10-15', '15', 'in', '0', '15', NULL, 'Pcs', '4500', '67500', NULL, NULL, NULL),
(24, '+256-759912814', 1760537072, '+256-759912814', 'Published', '1760537072', NULL, '---', 24, '2025-10-15', '27', 'in', '0', '27', NULL, 'Pcs', '4000', '108000', NULL, NULL, NULL),
(25, '+256-759912814', 1760537117, '+256-759912814', 'Published', '1760537117', NULL, '---', 25, '2025-10-15', '0', 'in', '0', '0', NULL, 'Pcs', '3500', '0', NULL, NULL, NULL),
(26, '+256-759912814', 1760537200, '+256-759912814', 'Published', '1760537200', NULL, '---', 26, '2025-10-15', '7', 'in', '0', '7', NULL, 'Pcs', '6500', '45500', NULL, NULL, NULL),
(27, '+256-759912814', 1760537244, '+256-759912814', 'Published', '1760537244', NULL, '---', 27, '2025-10-15', '35', 'in', '0', '35', NULL, 'Pcs', '4200', '147000', NULL, NULL, NULL),
(28, '+256-759912814', 1760537307, '+256-759912814', 'Published', '1760537307', NULL, '---', 28, '2025-10-15', '16', 'in', '0', '16', NULL, 'Pcs', '32000', '512000', NULL, NULL, NULL),
(29, '+256-759912814', 1760537366, '+256-759912814', 'Published', '1760537366', NULL, '---', 29, '2025-10-15', '0', 'in', '0', '0', NULL, 'Pcs', '32000', '0', NULL, NULL, NULL),
(30, '+256-759912814', 1760537441, '+256-759912814', 'Published', '1760537441', NULL, '---', 30, '2025-10-15', '0', 'in', '0', '0', NULL, 'Pcs', '37000', '0', NULL, NULL, NULL),
(31, '+256-759912814', 1760537489, '+256-759912814', 'Published', '1760537489', NULL, '---', 31, '2025-10-15', '0', 'in', '0', '0', NULL, 'Pcs', '36000', '0', NULL, NULL, NULL),
(32, '+256-759912814', 1760537590, '+256-759912814', 'Published', '1760537590', NULL, '---', 32, '2025-10-15', '0', 'in', '0', '0', NULL, 'Pcs', '40000', '0', NULL, NULL, NULL),
(33, '+256-759912814', 1760537644, '+256-759912814', 'Published', '1760537644', NULL, '---', 33, '2025-10-15', '0', 'in', '0', '0', NULL, 'Pcs', '15800', '0', NULL, NULL, NULL),
(34, '+256-759912814', 1760537688, '+256-759912814', 'Published', '1760537688', NULL, '---', 34, '2025-10-15', '7', 'in', '0', '7', NULL, 'Pcs', '20000', '140000', NULL, NULL, NULL),
(35, '+256-759912814', 1760537727, '+256-759912814', 'Published', '1760537727', NULL, '---', 35, '2025-10-15', '0', 'in', '0', '0', NULL, 'Pcs', '21000', '0', NULL, NULL, NULL),
(36, '+256-759912814', 1760537832, '+256-759912814', 'Published', '1760537832', NULL, '---', 36, '2025-10-15', '3', 'in', '0', '3', NULL, 'Pcs', '4000', '12000', NULL, NULL, NULL),
(37, '+256-759912814', 1760537915, '+256-759912814', 'Published', '1760537915', NULL, '---', 37, '2025-10-15', '8', 'in', '0', '8', NULL, 'Pcs', '4000', '32000', NULL, NULL, NULL),
(38, '+256-759912814', 1760537982, '+256-759912814', 'Published', '1760537982', NULL, '---', 38, '2025-10-15', '304', 'in', '0', '304', NULL, 'Pcs', '400', '121600', NULL, NULL, NULL),
(39, '+256-759912814', 1760538057, '+256-759912814', 'Published', '1760538057', NULL, '---', 9, '2025-10-15', '17', 'in', '13', '30', NULL, 'NaN', '2300', '39100', NULL, NULL, NULL),
(40, '+256-759912814', 1760538245, '+256-759912814', 'Published', '1760538245', NULL, '---', 39, '2025-10-15', '4', 'in', '0', '4', NULL, 'Pcs', '4000', '16000', NULL, NULL, NULL),
(41, '+256-759912814', 1760538314, '+256-759912814', 'Published', '1760538314', NULL, '---', 40, '2025-10-15', '44', 'in', '0', '44', NULL, 'Pcs', '1200', '52800', NULL, NULL, NULL),
(42, '+256-759912814', 1760538412, '+256-759912814', 'Published', '1760538412', NULL, '---', 41, '2025-10-15', '40', 'in', '0', '40', NULL, 'Pcs', '1200', '48000', NULL, NULL, NULL),
(43, '+256-759912814', 1760538450, '+256-759912814', 'Published', '1760538450', NULL, '---', 42, '2025-10-15', '24', 'in', '0', '24', NULL, 'Pcs', '1300', '31200', NULL, NULL, NULL),
(44, '+256-759912814', 1760538494, '+256-759912814', 'Published', '1760538494', NULL, '---', 43, '2025-10-15', '14', 'in', '0', '14', NULL, 'Pcs', '1200', '16800', NULL, NULL, NULL),
(45, '+256-759912814', 1760538554, '+256-759912814', 'Published', '1760538554', NULL, '---', 44, '2025-10-15', '3', 'in', '0', '3', NULL, 'Pcs', '1200', '3600', NULL, NULL, NULL),
(46, '+256-759912814', 1760538607, '+256-759912814', 'Published', '1760538607', NULL, '---', 45, '2025-10-15', '21', 'in', '0', '21', NULL, 'Pcs', '1500', '31500', NULL, NULL, NULL),
(47, '+256-759912814', 1760538725, '+256-759912814', 'Published', '1760538725', NULL, '---', 39, '2025-10-15', '4', 'in', '4', '8', NULL, 'NaN', '4000', '16000', NULL, NULL, NULL),
(48, '+256-759912814', 1760538824, '+256-759912814', 'Published', '1760538824', NULL, '---', 46, '2025-10-15', '2', 'in', '0', '2', NULL, 'Pcs', '1200', '2400', NULL, NULL, NULL),
(49, '+256-759912814', 1760538882, '+256-759912814', 'Published', '1760538882', NULL, '---', 47, '2025-10-15', '3', 'in', '0', '3', NULL, 'Pcs', '4000', '12000', NULL, NULL, NULL),
(50, '+256-759912814', 1760538929, '+256-759912814', 'Published', '1760538929', NULL, '---', 48, '2025-10-15', '2', 'in', '0', '2', NULL, 'Pcs', '1400', '2800', NULL, NULL, NULL),
(51, '+256-759912814', 1760538986, '+256-759912814', 'Published', '1760538986', NULL, '---', 49, '2025-10-15', '4', 'in', '0', '4', NULL, 'Pcs', '4000', '16000', NULL, NULL, NULL),
(52, '+256-759912814', 1760539047, '+256-759912814', 'Published', '1760539047', NULL, '---', 41, '2025-10-15', '4', 'in', '40', '44', NULL, 'NaN', '1200', '4800', NULL, NULL, NULL),
(53, '+256-759912814', 1760598596, '+256-759912814', 'Published', '1760598596', NULL, '---', 50, '2025-10-16', '29', 'in', '0', '29', NULL, 'Pcs', '1300', '37700', NULL, NULL, NULL),
(54, '+256-759912814', 1760598596, '+256-759912814', 'Published', '1760598596', NULL, '---', 51, '2025-10-16', '29', 'in', '0', '29', NULL, 'Pcs', '1300', '37700', NULL, NULL, NULL),
(55, '+256-759912814', 1760598662, '+256-759912814', 'Published', '1760598662', NULL, '---', 52, '2025-10-16', '20', 'in', '0', '20', NULL, 'Pcs', '1300', '26000', NULL, NULL, NULL),
(56, '+256-759912814', 1760598862, '+256-759912814', 'Published', '1760598862', NULL, '---', 53, '2025-10-16', '93', 'in', '0', '93', NULL, 'Pcs', '1300', '120900', NULL, NULL, NULL),
(57, '+256-759912814', 1760598923, '+256-759912814', 'Published', '1760598923', NULL, '---', 54, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '20000', '0', NULL, NULL, NULL),
(58, '+256-759912814', 1760598964, '+256-759912814', 'Published', '1760598964', NULL, '---', 55, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '24000', '0', NULL, NULL, NULL),
(59, '+256-759912814', 1760599023, '+256-759912814', 'Published', '1760599023', NULL, '---', 56, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '22000', '0', NULL, NULL, NULL),
(60, '+256-759912814', 1760599121, '+256-759912814', 'Published', '1760599121', NULL, '---', 57, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '24500', '0', NULL, NULL, NULL),
(61, '+256-759912814', 1760599181, '+256-759912814', 'Published', '1760599181', NULL, '---', 58, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '40500', '0', NULL, NULL, NULL),
(62, '+256-759912814', 1760599237, '+256-759912814', 'Published', '1760599237', NULL, '---', 59, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '1200', '0', NULL, NULL, NULL),
(63, '+256-759912814', 1760599329, '+256-759912814', 'Published', '1760599329', NULL, '---', 59, '2025-10-16', '17', 'in', '0', '17', NULL, 'NaN', '1200', '20400', NULL, NULL, NULL),
(64, '+256-759912814', 1760599476, '+256-759912814', 'Published', '1760599476', NULL, '---', 60, '2025-10-16', '59', 'in', '0', '59', NULL, 'Pcs', '1200', '70800', NULL, NULL, NULL),
(65, '+256-759912814', 1760599577, '+256-759912814', 'Published', '1760599577', NULL, '---', 61, '2025-10-16', '116', 'in', '0', '116', NULL, 'Pcs', '1300', '150800', NULL, NULL, NULL),
(66, '+256-759912814', 1760599664, '+256-759912814', 'Published', '1760599664', NULL, '---', 62, '2025-10-16', '8', 'in', '0', '8', NULL, 'Pcs', '1500', '12000', NULL, NULL, NULL),
(67, '+256-759912814', 1760599804, '+256-759912814', 'Published', '1760599804', NULL, '---', 63, '2025-10-16', '27', 'in', '0', '27', NULL, 'Pcs', '1400', '37800', NULL, NULL, NULL),
(68, '+256-759912814', 1760599854, '+256-759912814', 'Published', '1760599854', NULL, '---', 64, '2025-10-16', '1', 'in', '0', '1', NULL, 'Pcs', '4000', '4000', NULL, NULL, NULL),
(69, '+256-759912814', 1760599907, '+256-759912814', 'Published', '1760599907', NULL, '---', 65, '2025-10-16', '2', 'in', '0', '2', NULL, 'Pcs', '1200', '2400', NULL, NULL, NULL),
(70, '+256-759912814', 1760600093, '+256-759912814', 'Published', '1760600093', NULL, '---', 66, '2025-10-16', '9', 'in', '0', '9', NULL, 'Pcs', '2800', '25200', NULL, NULL, NULL),
(71, '+256-759912814', 1760600151, '+256-759912814', 'Published', '1760600151', NULL, '---', 67, '2025-10-16', '9', 'in', '0', '9', NULL, 'Pcs', '3000', '27000', NULL, NULL, NULL),
(72, '+256-759912814', 1760600196, '+256-759912814', 'Published', '1760600196', NULL, '---', 68, '2025-10-16', '12', 'in', '0', '12', NULL, 'Pcs', '1800', '21600', NULL, NULL, NULL),
(73, '+256-759912814', 1760600270, '+256-759912814', 'Published', '1760600270', NULL, '---', 69, '2025-10-16', '6', 'in', '0', '6', NULL, 'Pcs', '2000', '12000', NULL, NULL, NULL),
(74, '+256-759912814', 1760600361, '+256-759912814', 'Published', '1760600361', NULL, '---', 70, '2025-10-16', '7', 'in', '0', '7', NULL, 'Pcs', '5000', '35000', NULL, NULL, NULL),
(75, '+256-759912814', 1760600363, '+256-759912814', 'Published', '1760600363', NULL, '---', 71, '2025-10-16', '7', 'in', '0', '7', NULL, 'Pcs', '5000', '35000', NULL, NULL, NULL),
(76, '+256-759912814', 1760600461, '+256-759912814', 'Published', '1760600461', NULL, '---', 72, '2025-10-16', '11', 'in', '0', '11', NULL, 'Pcs', '3000', '33000', NULL, NULL, NULL),
(77, '+256-759912814', 1760600464, '+256-759912814', 'Published', '1760600464', NULL, '---', 73, '2025-10-16', '11', 'in', '0', '11', NULL, 'Pcs', '3000', '33000', NULL, NULL, NULL),
(78, '+256-759912814', 1760601059, '+256-759912814', 'Published', '1760601059', NULL, '---', 74, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '6100', '0', NULL, NULL, NULL),
(79, '+256-759912814', 1760601102, '+256-759912814', 'Published', '1760601102', NULL, '---', 75, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '14500', '0', NULL, NULL, NULL),
(80, '+256-759912814', 1760601161, '+256-759912814', 'Published', '1760601161', NULL, '---', 76, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '2500', '0', NULL, NULL, NULL),
(81, '+256-759912814', 1760601227, '+256-759912814', 'Published', '1760601227', NULL, '---', 77, '2025-10-16', '93', 'in', '0', '93', NULL, 'Pcs', '400', '37200', NULL, NULL, NULL),
(82, '+256-759912814', 1760601276, '+256-759912814', 'Published', '1760601276', NULL, '---', 78, '2025-10-16', '00', 'in', '0', '00', NULL, 'Pcs', '800', '0', NULL, NULL, NULL),
(83, '+256-759912814', 1760601345, '+256-759912814', 'Published', '1760601345', NULL, '---', 79, '2025-10-16', '20', 'in', '0', '20', NULL, 'Pcs', '400', '8000', NULL, NULL, NULL),
(84, '+256-759912814', 1760601388, '+256-759912814', 'Published', '1760601388', NULL, '---', 80, '2025-10-16', '00', 'in', '0', '00', NULL, 'Pcs', '500', '0', NULL, NULL, NULL),
(85, '+256-759912814', 1760601438, '+256-759912814', 'Published', '1760601438', NULL, '---', 81, '2025-10-16', '12', 'in', '0', '12', NULL, 'Pcs', '1000', '12000', NULL, NULL, NULL),
(86, '+256-759912814', 1760601501, '+256-759912814', 'Published', '1760601501', NULL, '---', 82, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '2000', '0', NULL, NULL, NULL),
(87, '+256-759912814', 1760601543, '+256-759912814', 'Published', '1760601543', NULL, '---', 83, '2025-10-16', '11', 'in', '0', '11', NULL, 'Pcs', '1250', '13750', NULL, NULL, NULL),
(88, '+256-759912814', 1760601580, '+256-759912814', 'Published', '1760601580', NULL, '---', 84, '2025-10-16', '00', 'in', '0', '00', NULL, 'Pcs', '1200', '0', NULL, NULL, NULL),
(89, '+256-759912814', 1760601627, '+256-759912814', 'Published', '1760601627', NULL, '---', 85, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '1000', '0', NULL, NULL, NULL),
(90, '+256-759912814', 1760601676, '+256-759912814', 'Published', '1760601676', NULL, '---', 86, '2025-10-16', '29', 'in', '0', '29', NULL, 'Pcs', '2000', '58000', NULL, NULL, NULL),
(91, '+256-759912814', 1760601723, '+256-759912814', 'Published', '1760601723', NULL, '---', 87, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '2000', '0', NULL, NULL, NULL),
(92, '+256-759912814', 1760601774, '+256-759912814', 'Published', '1760601774', NULL, '---', 88, '2025-10-16', '11', 'in', '0', '11', NULL, 'Pcs', '3500', '38500', NULL, NULL, NULL),
(93, '+256-759912814', 1760601827, '+256-759912814', 'Published', '1760601827', NULL, '---', 89, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '2400', '0', NULL, NULL, NULL),
(94, '+256-759912814', 1760601869, '+256-759912814', 'Published', '1760601869', NULL, '---', 90, '2025-10-16', '1', 'in', '0', '1', NULL, 'Pcs', '42000', '42000', NULL, NULL, NULL),
(95, '+256-759912814', 1760601941, '+256-759912814', 'Published', '1760601941', NULL, '---', 91, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '48000', '0', NULL, NULL, NULL),
(96, '+256-759912814', 1760601996, '+256-759912814', 'Published', '1760601996', NULL, '---', 92, '2025-10-16', '8', 'in', '0', '8', NULL, 'Pcs', '41500', '332000', NULL, NULL, NULL),
(97, '+256-759912814', 1760602039, '+256-759912814', 'Published', '1760602039', NULL, '---', 93, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '42000', '0', NULL, NULL, NULL),
(98, '+256-759912814', 1760602764, '+256-759912814', 'Published', '1760602764', NULL, '---', 94, '2025-10-16', '10', 'in', '0', '10', NULL, 'Pcs', '1300', '13000', NULL, NULL, NULL),
(99, '+256-759912814', 1760602823, '+256-759912814', 'Published', '1760602823', NULL, '---', 95, '2025-10-16', '31', 'in', '0', '31', NULL, 'Pcs', '1300', '40300', NULL, NULL, NULL),
(100, '+256-759912814', 1760602894, '+256-759912814', 'Published', '1760602894', NULL, '---', 96, '2025-10-16', '9', 'in', '0', '9', NULL, 'Pcs', '1300', '11700', NULL, NULL, NULL),
(101, '+256-759912814', 1760603279, '+256-759912814', 'Published', '1760603279', NULL, '---', 97, '2025-10-16', '12', 'in', '0', '12', NULL, 'Pcs', '4500', '54000', NULL, NULL, NULL),
(102, '+256-759912814', 1760603323, '+256-759912814', 'Published', '1760603323', NULL, '---', 98, '2025-10-16', '6', 'in', '0', '6', NULL, 'Pcs', '2300', '13800', NULL, NULL, NULL),
(103, '+256-759912814', 1760603394, '+256-759912814', 'Published', '1760603394', NULL, '---', 99, '2025-10-16', '10', 'in', '0', '10', NULL, 'Pcs', '2500', '25000', NULL, NULL, NULL),
(104, '+256-759912814', 1760603447, '+256-759912814', 'Published', '1760603447', NULL, '---', 100, '2025-10-16', '1', 'in', '0', '1', NULL, 'Pcs', '2500', '2500', NULL, NULL, NULL),
(105, '+256-759912814', 1760603497, '+256-759912814', 'Published', '1760603497', NULL, '---', 76, '2025-10-16', '5', 'in', '0', '5', NULL, 'NaN', '2500', '12500', NULL, NULL, NULL),
(106, '+256-759912814', 1760603566, '+256-759912814', 'Published', '1760603566', NULL, '---', 101, '2025-10-16', '34', 'in', '0', '34', NULL, 'Pcs', '3200', '108800', NULL, NULL, NULL),
(107, '+256-759912814', 1760603619, '+256-759912814', 'Published', '1760603619', NULL, '---', 102, '2025-10-16', '9', 'in', '0', '9', NULL, 'Pcs', '14500', '130500', NULL, NULL, NULL),
(108, '+256-759912814', 1760603688, '+256-759912814', 'Published', '1760603688', NULL, '---', 103, '2025-10-16', '2', 'in', '0', '2', NULL, 'Pcs', '40000', '80000', NULL, NULL, NULL),
(109, '+256-759912814', 1760603921, '+256-759912814', 'Published', '1760603921', NULL, '---', 104, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '63500', '0', NULL, NULL, NULL),
(110, '+256-759912814', 1760603993, '+256-759912814', 'Published', '1760603993', NULL, '---', 105, '2025-10-16', '1', 'in', '0', '1', NULL, 'Pcs', '2500', '2500', NULL, NULL, NULL),
(111, '+256-759912814', 1760604187, '+256-759912814', 'Published', '1760604187', NULL, '---', 106, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '2500', '0', NULL, NULL, NULL),
(112, '+256-759912814', 1760604229, '+256-759912814', 'Published', '1760604229', NULL, '---', 107, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '2000', '0', NULL, NULL, NULL),
(113, '+256-759912814', 1760604276, '+256-759912814', 'Published', '1760604276', NULL, '---', 108, '2025-10-16', '7', 'in', '0', '7', NULL, 'Pcs', '2600', '18200', NULL, NULL, NULL),
(114, '+256-759912814', 1760604323, '+256-759912814', 'Published', '1760604323', NULL, '---', 109, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '2500', '0', NULL, NULL, NULL),
(115, '+256-759912814', 1760604364, '+256-759912814', 'Published', '1760604364', NULL, '---', 110, '2025-10-16', '00', 'in', '0', '00', NULL, 'Pcs', '1000', '0', NULL, NULL, NULL),
(116, '+256-759912814', 1760604435, '+256-759912814', 'Published', '1760604435', NULL, '---', 111, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '400', '0', NULL, NULL, NULL),
(117, '+256-759912814', 1760604494, '+256-759912814', 'Published', '1760604494', NULL, '---', 112, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '400', '0', NULL, NULL, NULL),
(118, '+256-759912814', 1760604539, '+256-759912814', 'Published', '1760604539', NULL, '---', 113, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '150', '0', NULL, NULL, NULL),
(119, '+256-759912814', 1760604688, '+256-759912814', 'Published', '1760604688', NULL, '---', 114, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '4500', '0', NULL, NULL, NULL),
(120, '+256-759912814', 1760604752, '+256-759912814', 'Published', '1760604752', NULL, '---', 115, '2025-10-16', '4', 'in', '0', '4', NULL, 'Pcs', '5500', '22000', NULL, NULL, NULL),
(121, '+256-759912814', 1760604795, '+256-759912814', 'Published', '1760604795', NULL, '---', 116, '2025-10-16', '00', 'in', '0', '00', NULL, 'Pcs', '4000', '0', NULL, NULL, NULL),
(122, '+256-759912814', 1760604833, '+256-759912814', 'Published', '1760604833', NULL, '---', 117, '2025-10-16', '00', 'in', '0', '00', NULL, 'Pcs', '4000', '0', NULL, NULL, NULL),
(123, '+256-759912814', 1760604873, '+256-759912814', 'Published', '1760604873', NULL, '---', 118, '2025-10-16', '00', 'in', '0', '00', NULL, 'Pcs', '3300', '0', NULL, NULL, NULL),
(124, '+256-759912814', 1760604916, '+256-759912814', 'Published', '1760604916', NULL, '---', 119, '2025-10-16', '00', 'in', '0', '00', NULL, 'Pcs', '2500', '0', NULL, NULL, NULL),
(125, '+256-759912814', 1760604955, '+256-759912814', 'Published', '1760604955', NULL, '---', 120, '2025-10-16', '5', 'in', '0', '5', NULL, 'Pcs', '2200', '11000', NULL, NULL, NULL),
(126, '+256-759912814', 1760604996, '+256-759912814', 'Published', '1760604996', NULL, '---', 121, '2025-10-16', '11', 'in', '0', '11', NULL, 'Pcs', '3000', '33000', NULL, NULL, NULL),
(127, '+256-759912814', 1760605031, '+256-759912814', 'Published', '1760605031', NULL, '---', 122, '2025-10-16', '00', 'in', '0', '00', NULL, 'Pcs', '2000', '0', NULL, NULL, NULL),
(128, '+256-759912814', 1760605069, '+256-759912814', 'Published', '1760605069', NULL, '---', 123, '2025-10-16', '23', 'in', '0', '23', NULL, 'Pcs', '3834', '88182', NULL, NULL, NULL),
(129, '+256-759912814', 1760605120, '+256-759912814', 'Published', '1760605120', NULL, '---', 124, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '1700', '0', NULL, NULL, NULL),
(130, '+256-759912814', 1760605161, '+256-759912814', 'Published', '1760605161', NULL, '---', 125, '2025-10-16', '15', 'in', '0', '15', NULL, 'Pcs', '5000', '75000', NULL, NULL, NULL),
(131, '+256-759912814', 1760605380, '+256-759912814', 'Published', '1760605380', NULL, '---', 126, '2025-10-16', '41', 'in', '0', '41', NULL, 'Pcs', '6700', '274700', NULL, NULL, NULL),
(132, '+256-759912814', 1760605421, '+256-759912814', 'Published', '1760605421', NULL, '---', 127, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '7100', '0', NULL, NULL, NULL),
(133, '+256-759912814', 1760605474, '+256-759912814', 'Published', '1760605474', NULL, '---', 128, '2025-10-16', '14', 'in', '0', '14', NULL, 'Pcs', '6000', '84000', NULL, NULL, NULL),
(134, '+256-759912814', 1760605517, '+256-759912814', 'Published', '1760605517', NULL, '---', 129, '2025-10-16', '18', 'in', '0', '18', NULL, 'Pcs', '4500', '81000', NULL, NULL, NULL),
(135, '+256-759912814', 1760605556, '+256-759912814', 'Published', '1760605556', NULL, '---', 130, '2025-10-16', '3', 'in', '0', '3', NULL, 'Pcs', '8500', '25500', NULL, NULL, NULL),
(136, '+256-759912814', 1760605795, '+256-759912814', 'Published', '1760605795', NULL, '---', 131, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '6000', '0', NULL, NULL, NULL),
(137, '+256-759912814', 1760605852, '+256-759912814', 'Published', '1760605852', NULL, '---', 132, '2025-10-16', '14', 'in', '0', '14', NULL, 'Pcs', '3000', '42000', NULL, NULL, NULL),
(138, '+256-759912814', 1760605980, '+256-759912814', 'Published', '1760605980', NULL, '---', 133, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '3200', '0', NULL, NULL, NULL),
(139, '+256-759912814', 1760606019, '+256-759912814', 'Published', '1760606019', NULL, '---', 134, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '4700', '0', NULL, NULL, NULL),
(140, '+256-759912814', 1760606067, '+256-759912814', 'Published', '1760606067', NULL, '---', 135, '2025-10-16', '16', 'in', '0', '16', NULL, 'Pcs', '4000', '64000', NULL, NULL, NULL),
(141, '+256-759912814', 1760606185, '+256-759912814', 'Published', '1760606185', NULL, '---', 136, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '3760', '0', NULL, NULL, NULL),
(142, '+256-759912814', 1760606286, '+256-759912814', 'Published', '1760606286', NULL, '---', 137, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '5300', '0', NULL, NULL, NULL),
(143, '+256-759912814', 1760606340, '+256-759912814', 'Published', '1760606340', NULL, '---', 138, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '2900', '0', NULL, NULL, NULL),
(144, '+256-759912814', 1760606372, '+256-759912814', 'Published', '1760606372', NULL, '---', 139, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '3000', '0', NULL, NULL, NULL),
(145, '+256-759912814', 1760606454, '+256-759912814', 'Published', '1760606454', NULL, '---', 140, '2025-10-16', '16', 'in', '0', '16', NULL, 'Pcs', '5000', '80000', NULL, NULL, NULL),
(146, '+256-759912814', 1760606510, '+256-759912814', 'Published', '1760606510', NULL, '---', 141, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '100', '0', NULL, NULL, NULL),
(147, '+256-759912814', 1760606554, '+256-759912814', 'Published', '1760606554', NULL, '---', 142, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '1500', '0', NULL, NULL, NULL),
(148, '+256-759912814', 1760606624, '+256-759912814', 'Published', '1760606624', NULL, '---', 7, '2025-10-16', '5', 'in', '10', '15', NULL, 'NaN', '3500', '17500', NULL, NULL, NULL),
(149, '+256-759912814', 1760606675, '+256-759912814', 'Published', '1760606675', NULL, '---', 98, '2025-10-16', '1', 'in', '6', '7', NULL, 'NaN', '2300', '2300', NULL, NULL, NULL),
(150, '+256-759912814', 1760606812, '+256-759912814', 'Published', '1760606812', NULL, '---', 143, '2025-10-16', '2', 'in', '0', '2', NULL, 'Pcs', '45000', '90000', NULL, NULL, NULL),
(151, '+256-759912814', 1760607178, '+256-759912814', 'Published', '1760607178', NULL, '---', 144, '2025-10-16', '3', 'in', '0', '3', NULL, 'Pcs', '7000', '21000', NULL, NULL, NULL),
(152, '+256-759912814', 1760607291, '+256-759912814', 'Published', '1760607291', NULL, '---', 145, '2025-10-16', '2', 'in', '0', '2', NULL, 'Pcs', '750', '1500', NULL, NULL, NULL),
(153, '+256-759912814', 1760607334, '+256-759912814', 'Published', '1760607334', NULL, '---', 146, '2025-10-16', '20', 'in', '0', '20', NULL, 'Pcs', '1500', '30000', NULL, NULL, NULL),
(154, '+256-759912814', 1760607368, '+256-759912814', 'Published', '1760607368', NULL, '---', 147, '2025-10-16', '1', 'in', '0', '1', NULL, 'Pcs', '1500', '1500', NULL, NULL, NULL),
(155, '+256-759912814', 1760607399, '+256-759912814', 'Published', '1760607399', NULL, '---', 148, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '1500', '0', NULL, NULL, NULL),
(156, '+256-759912814', 1760607441, '+256-759912814', 'Published', '1760607441', NULL, '---', 149, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '4000', '0', NULL, NULL, NULL),
(157, '+256-759912814', 1760607545, '+256-759912814', 'Published', '1760607545', NULL, '---', 150, '2025-10-16', '13', 'in', '0', '13', NULL, 'Pcs', '4000', '52000', NULL, NULL, NULL),
(158, '+256-759912814', 1760607674, '+256-759912814', 'Published', '1760607674', NULL, '---', 151, '2025-10-16', '2', 'in', '0', '2', NULL, 'Pcs', '50000', '100000', NULL, NULL, NULL),
(159, '+256-759912814', 1760607727, '+256-759912814', 'Published', '1760607727', NULL, '---', 152, '2025-10-16', '24', 'in', '0', '24', NULL, 'Pcs', '2500', '60000', NULL, NULL, NULL),
(160, '+256-759912814', 1760607783, '+256-759912814', 'Published', '1760607783', NULL, '---', 153, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '3000', '0', NULL, NULL, NULL),
(161, '+256-759912814', 1760608184, '+256-759912814', 'Published', '1760608184', NULL, '---', 154, '2025-10-16', '50', 'in', '0', '50', NULL, 'Pcs', '600', '30000', NULL, NULL, NULL),
(162, '+256-759912814', 1760608229, '+256-759912814', 'Published', '1760608229', NULL, '---', 155, '2025-10-16', '9', 'in', '0', '9', NULL, 'Pcs', '1500', '13500', NULL, NULL, NULL),
(163, '+256-759912814', 1760608277, '+256-759912814', 'Published', '1760608277', NULL, '---', 156, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '1500', '0', NULL, NULL, NULL),
(164, '+256-759912814', 1760608369, '+256-759912814', 'Published', '1760608369', NULL, '---', 157, '2025-10-16', '48', 'in', '0', '48', NULL, 'Pcs', '1000', '48000', NULL, NULL, NULL),
(165, '+256-759912814', 1760608417, '+256-759912814', 'Published', '1760608417', NULL, '---', 158, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '1500', '0', NULL, NULL, NULL),
(166, '+256-759912814', 1760608457, '+256-759912814', 'Published', '1760608457', NULL, '---', 159, '2025-10-16', '2', 'in', '0', '2', NULL, 'Pcs', '2500', '5000', NULL, NULL, NULL),
(167, '+256-759912814', 1760608499, '+256-759912814', 'Published', '1760608499', NULL, '---', 160, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '1350', '0', NULL, NULL, NULL),
(168, '+256-759912814', 1760608541, '+256-759912814', 'Published', '1760608541', NULL, '---', 161, '2025-10-16', '21', 'in', '0', '21', NULL, 'Pcs', '2500', '52500', NULL, NULL, NULL),
(169, '+256-759912814', 1760608885, '+256-759912814', 'Published', '1760608885', NULL, '---', 162, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '1500', '0', NULL, NULL, NULL),
(170, '+256-759912814', 1760608931, '+256-759912814', 'Published', '1760608931', NULL, '---', 163, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '2800', '0', NULL, NULL, NULL),
(171, '+256-759912814', 1760608981, '+256-759912814', 'Published', '1760608981', NULL, '---', 164, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '300', '0', NULL, NULL, NULL),
(172, '+256-759912814', 1760609045, '+256-759912814', 'Published', '1760609045', NULL, '---', 165, '2025-10-16', '195', 'in', '0', '195', NULL, 'Pcs', '1500', '292500', NULL, NULL, NULL),
(173, '+256-759912814', 1760609091, '+256-759912814', 'Published', '1760609091', NULL, '---', 166, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '1500', '0', NULL, NULL, NULL),
(174, '+256-759912814', 1760609128, '+256-759912814', 'Published', '1760609128', NULL, '---', 167, '2025-10-16', '5', 'in', '0', '5', NULL, 'Pcs', '1800', '9000', NULL, NULL, NULL),
(175, '+256-759912814', 1760609163, '+256-759912814', 'Published', '1760609163', NULL, '---', 168, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '1500', '0', NULL, NULL, NULL),
(176, '+256-759912814', 1760609202, '+256-759912814', 'Published', '1760609202', NULL, '---', 169, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '1700', '0', NULL, NULL, NULL),
(177, '+256-759912814', 1760609235, '+256-759912814', 'Published', '1760609235', NULL, '---', 170, '2025-10-16', '1', 'in', '0', '1', NULL, 'Pcs', '1500', '1500', NULL, NULL, NULL),
(178, '+256-759912814', 1760609267, '+256-759912814', 'Published', '1760609267', NULL, '---', 171, '2025-10-16', '27', 'in', '0', '27', NULL, 'Pcs', '1700', '45900', NULL, NULL, NULL),
(179, '+256-759912814', 1760609463, '+256-759912814', 'Published', '1760609463', NULL, '---', 172, '2025-10-16', '39', 'in', '0', '39', NULL, 'Pcs', '500', '19500', NULL, NULL, NULL),
(180, '+256-759912814', 1760609560, '+256-759912814', 'Published', '1760609560', NULL, '---', 173, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '18000', '0', NULL, NULL, NULL),
(181, '+256-759912814', 1760609602, '+256-759912814', 'Published', '1760609602', NULL, '---', 174, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '12000', '0', NULL, NULL, NULL),
(182, '+256-759912814', 1760609654, '+256-759912814', 'Published', '1760609654', NULL, '---', 175, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '13500', '0', NULL, NULL, NULL),
(183, '+256-759912814', 1760609698, '+256-759912814', 'Published', '1760609698', NULL, '---', 176, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '12500', '0', NULL, NULL, NULL),
(184, '+256-759912814', 1760609742, '+256-759912814', 'Published', '1760609742', NULL, '---', 177, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '20000', '0', NULL, NULL, NULL),
(185, '+256-759912814', 1760609777, '+256-759912814', 'Published', '1760609777', NULL, '---', 178, '2025-10-16', '79', 'in', '0', '79', NULL, 'Pcs', '400', '31600', NULL, NULL, NULL),
(186, '+256-759912814', 1760609832, '+256-759912814', 'Published', '1760609832', NULL, '---', 179, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '15700', '0', NULL, NULL, NULL),
(187, '+256-759912814', 1760609860, '+256-759912814', 'Published', '1760609860', NULL, '---', 180, '2025-10-16', '0', 'in', '0', '0', NULL, 'Pcs', '200', '0', NULL, NULL, NULL),
(188, '+256-759912814', 1760609905, '+256-759912814', 'Published', '1760609905', NULL, '---', 181, '2025-10-16', '23', 'in', '0', '23', NULL, 'Pcs', '1000', '23000', NULL, NULL, NULL),
(189, '+256-759912814', 1760610098, '+256-759912814', 'Published', '1760610098', NULL, '---', 182, '2025-10-16', '22', 'in', '0', '22', NULL, 'Pcs', '2000', '44000', NULL, NULL, NULL),
(190, '+256-759912814', 1760610163, '+256-759912814', 'Published', '1760610163', NULL, '---', 183, '2025-10-16', '6', 'in', '0', '6', NULL, 'Pcs', '700', '4200', NULL, NULL, NULL),
(191, '+256-759912814', 1760610237, '+256-759912814', 'Published', '1760610237', NULL, '---', 184, '2025-10-16', '2', 'in', '0', '2', NULL, 'Pcs', '7500', '15000', NULL, NULL, NULL),
(192, '+256-759912814', 1760776776, '+256-759912814', 'Published', '1760776776', NULL, '---', 187, '2025-10-18', '2', 'in', '0', '2', NULL, 'Pcs', '25000', '50000', NULL, NULL, NULL),
(193, '+256-759912814', 1760776829, '+256-759912814', 'Published', '1760776829', NULL, '---', 188, '2025-10-18', '8', 'in', '0', '8', NULL, 'Pcs', '22000', '176000', NULL, NULL, NULL),
(194, '+256-759912814', 1760776887, '+256-759912814', 'Published', '1760776887', NULL, '---', 189, '2025-10-18', '18', 'in', '0', '18', NULL, 'Pcs', '22000', '396000', NULL, NULL, NULL),
(195, '+256-759912814', 1760776941, '+256-759912814', 'Published', '1760776941', NULL, '---', 190, '2025-10-18', '2', 'in', '0', '2', NULL, 'Pcs', '72000', '144000', NULL, NULL, NULL),
(196, '+256-759912814', 1760777081, '+256-759912814', 'Published', '1760777081', NULL, '---', 191, '2025-10-18', '24', 'in', '0', '24', NULL, 'Pcs', '13000', '312000', NULL, NULL, NULL),
(197, '+256-759912814', 1760777131, '+256-759912814', 'Published', '1760777131', NULL, '---', 192, '2025-10-18', '2', 'in', '0', '2', NULL, 'Pcs', '20000', '40000', NULL, NULL, NULL),
(198, '+256-759912814', 1760777372, '+256-759912814', 'Published', '1760777372', NULL, '---', 193, '2025-10-18', '1', 'in', '0', '1', NULL, 'Pcs', '22000', '22000', NULL, NULL, NULL),
(199, '+256-759912814', 1760778026, '+256-759912814', 'Published', '1760778026', NULL, '---', 194, '2025-10-18', '41', 'in', '0', '41', NULL, 'Pcs', '24000', '984000', NULL, NULL, NULL),
(200, '+256-759912814', 1760778116, '+256-759912814', 'Published', '1760778116', NULL, '---', 195, '2025-10-18', '43', 'in', '0', '43', NULL, 'Pcs', '10500', '451500', NULL, NULL, NULL),
(201, '+256-759912814', 1760778193, '+256-759912814', 'Published', '1760778193', NULL, '---', 196, '2025-10-18', '7', 'in', '0', '7', NULL, 'Pcs', '24000', '168000', NULL, NULL, NULL),
(202, '+256-759912814', 1760778259, '+256-759912814', 'Published', '1760778259', NULL, '---', 197, '2025-10-18', '9', 'in', '0', '9', NULL, 'Pcs', '22000', '198000', NULL, NULL, NULL),
(203, '+256-759912814', 1760778356, '+256-759912814', 'Published', '1760778356', NULL, '---', 198, '2025-10-18', '18', 'in', '0', '18', NULL, 'Pcs', '27000', '486000', NULL, NULL, NULL),
(204, '+256-759912814', 1760778425, '+256-759912814', 'Published', '1760778425', NULL, '---', 199, '2025-10-18', '22', 'in', '0', '22', NULL, 'Pcs', '11500', '253000', NULL, NULL, NULL),
(205, '+256-759912814', 1760778594, '+256-759912814', 'Published', '1760778594', NULL, '---', 200, '2025-10-18', '5', 'in', '0', '5', NULL, 'Pcs', '25000', '125000', NULL, NULL, NULL),
(206, '+256-759912814', 1760778652, '+256-759912814', 'Published', '1760778652', NULL, '---', 193, '2025-10-18', '4', 'in', '1', '5', NULL, 'NaN', '25000', '100000', NULL, NULL, NULL),
(207, '+256-759912814', 1760778888, '+256-759912814', 'Published', '1760778888', NULL, '---', 200, '2025-10-18', '2', 'in', '5', '7', NULL, 'NaN', '25000', '50000', NULL, NULL, NULL),
(208, '+256-759912814', 1760778896, '+256-759912814', 'Published', '1760778896', NULL, '---', 200, '2025-10-18', '4', 'in', '5', '9', NULL, 'NaN', '25000', '100000', NULL, NULL, NULL),
(209, '+256-759912814', 1760778961, '+256-759912814', 'Published', '1760778961', NULL, '---', 201, '2025-10-18', '8', 'in', '0', '8', NULL, 'Pcs', '3000', '24000', NULL, NULL, NULL),
(210, '+256-759912814', 1760779070, '+256-759912814', 'Published', '1760779070', NULL, '---', 202, '2025-10-18', '6', 'in', '0', '6', NULL, 'Pcs', '7000', '42000', NULL, NULL, NULL),
(211, '+256-759912814', 1760779308, '+256-759912814', 'Published', '1760779308', NULL, '---', 203, '2025-10-18', '2', 'in', '0', '2', NULL, 'Pcs', '17500', '35000', NULL, NULL, NULL),
(212, '+256-759912814', 1760779367, '+256-759912814', 'Published', '1760779367', NULL, '---', 204, '2025-10-18', '1', 'in', '0', '1', NULL, 'Pcs', '70000', '70000', NULL, NULL, NULL),
(213, '+256-759912814', 1760779465, '+256-759912814', 'Published', '1760779465', NULL, '---', 205, '2025-10-18', '3', 'in', '0', '3', NULL, 'Pcs', '4000', '12000', NULL, NULL, NULL),
(214, '+256-759912814', 1760779516, '+256-759912814', 'Published', '1760779516', NULL, '---', 206, '2025-10-18', '1', 'in', '0', '1', NULL, 'Pcs', '30000', '30000', NULL, NULL, NULL),
(215, '+256-759912814', 1760779563, '+256-759912814', 'Published', '1760779563', NULL, '---', 207, '2025-10-18', '2', 'in', '0', '2', NULL, 'Pcs', '25000', '50000', NULL, NULL, NULL),
(216, '+256-759912814', 1760779638, '+256-759912814', 'Published', '1760779638', NULL, '---', 208, '2025-10-18', '1', 'in', '0', '1', NULL, 'Pcs', '45000', '45000', NULL, NULL, NULL),
(217, '+256-759912814', 1760779696, '+256-759912814', 'Published', '1760779696', NULL, '---', 209, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '17000', '0', NULL, NULL, NULL),
(218, '+256-759912814', 1760779896, '+256-759912814', 'Published', '1760779896', NULL, '---', 210, '2025-10-18', '1', 'in', '0', '1', NULL, 'Pcs', '35000', '35000', NULL, NULL, NULL),
(219, '+256-759912814', 1760780089, '+256-759912814', 'Published', '1760780089', NULL, '---', 209, '2025-10-18', '7', 'in', '0', '7', NULL, 'NaN', '17000', '119000', NULL, NULL, NULL),
(220, '+256-759912814', 1760780142, '+256-759912814', 'Published', '1760780142', NULL, '---', 211, '2025-10-18', '1', 'in', '0', '1', NULL, 'Pcs', '17000', '17000', NULL, NULL, NULL),
(221, '+256-759912814', 1760780195, '+256-759912814', 'Published', '1760780195', NULL, '---', 212, '2025-10-18', '2', 'in', '0', '2', NULL, 'Pcs', '13000', '26000', NULL, NULL, NULL),
(222, '+256-759912814', 1760780236, '+256-759912814', 'Published', '1760780236', NULL, '---', 213, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '11000', '0', NULL, NULL, NULL),
(223, '+256-759912814', 1760780291, '+256-759912814', 'Published', '1760780291', NULL, '---', 214, '2025-10-18', '1', 'in', '0', '1', NULL, 'Pcs', '21500', '21500', NULL, NULL, NULL),
(224, '+256-759912814', 1760780334, '+256-759912814', 'Published', '1760780334', NULL, '---', 215, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '3000', '0', NULL, NULL, NULL),
(225, '+256-759912814', 1760780384, '+256-759912814', 'Published', '1760780384', NULL, '---', 216, '2025-10-18', '1', 'in', '0', '1', NULL, 'Pcs', '25500', '25500', NULL, NULL, NULL),
(226, '+256-759912814', 1760780428, '+256-759912814', 'Published', '1760780428', NULL, '---', 217, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '72000', '0', NULL, NULL, NULL),
(227, '+256-759912814', 1760780466, '+256-759912814', 'Published', '1760780466', NULL, '---', 218, '2025-10-18', '11', 'in', '0', '11', NULL, 'Pcs', '3000', '33000', NULL, NULL, NULL),
(228, '+256-759912814', 1760780520, '+256-759912814', 'Published', '1760780520', NULL, '---', 219, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '3800', '0', NULL, NULL, NULL),
(229, '+256-759912814', 1760780574, '+256-759912814', 'Published', '1760780574', NULL, '---', 220, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '2800', '0', NULL, NULL, NULL),
(230, '+256-759912814', 1760780618, '+256-759912814', 'Published', '1760780618', NULL, '---', 221, '2025-10-18', '3', 'in', '0', '3', NULL, 'Pcs', '28000', '84000', NULL, NULL, NULL),
(231, '+256-759912814', 1760780659, '+256-759912814', 'Published', '1760780659', NULL, '---', 222, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '33000', '0', NULL, NULL, NULL),
(232, '+256-759912814', 1760780700, '+256-759912814', 'Published', '1760780700', NULL, '---', 223, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '18000', '0', NULL, NULL, NULL),
(233, '+256-759912814', 1760780738, '+256-759912814', 'Published', '1760780738', NULL, '---', 224, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '52000', '0', NULL, NULL, NULL),
(234, '+256-759912814', 1760780801, '+256-759912814', 'Published', '1760780801', NULL, '---', 225, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '25000', '0', NULL, NULL, NULL),
(235, '+256-759912814', 1760780870, '+256-759912814', 'Published', '1760780870', NULL, '---', 226, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '25000', '0', NULL, NULL, NULL),
(236, '+256-759912814', 1760780924, '+256-759912814', 'Published', '1760780924', NULL, '---', 227, '2025-10-18', '60', 'in', '0', '60', NULL, 'Pcs', '9500', '570000', NULL, NULL, NULL),
(237, '+256-759912814', 1760780965, '+256-759912814', 'Published', '1760780965', NULL, '---', 228, '2025-10-18', '1', 'in', '0', '1', NULL, 'Pcs', '11000', '11000', NULL, NULL, NULL),
(238, '+256-759912814', 1760781001, '+256-759912814', 'Published', '1760781001', NULL, '---', 229, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '13000', '0', NULL, NULL, NULL),
(239, '+256-759912814', 1760781052, '+256-759912814', 'Published', '1760781052', NULL, '---', 230, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '13000', '0', NULL, NULL, NULL),
(240, '+256-759912814', 1760781114, '+256-759912814', 'Published', '1760781114', NULL, '---', 231, '2025-10-18', '3', 'in', '0', '3', NULL, 'Pcs', '12500', '37500', NULL, NULL, NULL),
(241, '+256-759912814', 1760781150, '+256-759912814', 'Published', '1760781150', NULL, '---', 232, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '10500', '0', NULL, NULL, NULL),
(242, '+256-759912814', 1760781181, '+256-759912814', 'Published', '1760781181', NULL, '---', 233, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '2500', '0', NULL, NULL, NULL),
(243, '+256-759912814', 1760781211, '+256-759912814', 'Published', '1760781211', NULL, '---', 234, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '7000', '0', NULL, NULL, NULL),
(244, '+256-759912814', 1760781240, '+256-759912814', 'Published', '1760781240', NULL, '---', 235, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '9000', '0', NULL, NULL, NULL),
(245, '+256-759912814', 1760781277, '+256-759912814', 'Published', '1760781277', NULL, '---', 189, '2025-10-18', '10', 'in', '18', '28', NULL, 'NaN', '24000', '240000', NULL, NULL, NULL),
(246, '+256-759912814', 1760781338, '+256-759912814', 'Published', '1760781338', NULL, '---', 236, '2025-10-18', '3', 'in', '0', '3', NULL, 'Pcs', '24000', '72000', NULL, NULL, NULL),
(247, '+256-759912814', 1760781418, '+256-759912814', 'Published', '1760781418', NULL, '---', 237, '2025-10-18', '9', 'in', '0', '9', NULL, 'Pcs', '28000', '252000', NULL, NULL, NULL),
(248, '+256-759912814', 1760781523, '+256-759912814', 'Published', '1760781523', NULL, '---', 238, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '24500', '0', NULL, NULL, NULL),
(249, '+256-759912814', 1760781586, '+256-759912814', 'Published', '1760781586', NULL, '---', 239, '2025-10-18', '9', 'in', '0', '9', NULL, 'Pcs', '24000', '216000', NULL, NULL, NULL),
(250, '+256-759912814', 1760781627, '+256-759912814', 'Published', '1760781627', NULL, '---', 240, '2025-10-18', '3', 'in', '0', '3', NULL, 'Pcs', '26500', '79500', NULL, NULL, NULL),
(251, '+256-759912814', 1760781726, '+256-759912814', 'Published', '1760781726', NULL, '---', 194, '2025-10-18', '38', 'in', '41', '79', NULL, 'NaN', '24000', '912000', NULL, NULL, NULL),
(252, '+256-759912814', 1760781782, '+256-759912814', 'Published', '1760781782', NULL, '---', 241, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '24000', '0', NULL, NULL, NULL),
(253, '+256-759912814', 1760781914, '+256-759912814', 'Published', '1760781914', NULL, '---', 242, '2025-10-18', '0', 'in', '0', '0', NULL, 'Pcs', '35000', '0', NULL, NULL, NULL),
(254, '+256-759912814', 1760782543, '+256-759912814', 'Published', '1760782543', NULL, '---', 243, '2025-10-18', '8', 'in', '0', '8', NULL, 'Pcs', '3000', '24000', NULL, NULL, NULL),
(255, '+256-759912814', 1760867127, '+256-759912814', 'Published', '1760867127', NULL, '---', 244, '2025-10-19', '1', 'in', '0', '1', NULL, 'Pcs', '45000', '45000', NULL, NULL, NULL),
(256, '+256-759912814', 1760867196, '+256-759912814', 'Published', '1760867196', NULL, '---', 245, '2025-10-19', '2', 'in', '0', '2', NULL, 'Pcs', '25000', '50000', NULL, NULL, NULL),
(257, '+256-759912814', 1760867263, '+256-759912814', 'Published', '1760867263', NULL, '---', 213, '2025-10-19', '3', 'in', '0', '3', NULL, 'NaN', '11000', '33000', NULL, NULL, NULL),
(258, '+256-759912814', 1760867385, '+256-759912814', 'Published', '1760867385', NULL, '---', 246, '2025-10-19', '1', 'in', '0', '1', NULL, 'Pcs', '2000', '2000', NULL, NULL, NULL),
(259, '+256-759912814', 1760867466, '+256-759912814', 'Published', '1760867466', NULL, '---', 247, '2025-10-19', '7', 'in', '0', '7', NULL, 'Pcs', '3000', '21000', NULL, NULL, NULL),
(260, '+256-759912814', 1760867487, '+256-759912814', 'Published', '1760867487', NULL, '---', 246, '2025-10-19', '1', 'in', '1', '2', NULL, 'NaN', '2000', '2000', NULL, NULL, NULL),
(261, '+256-759912814', 1760867616, '+256-759912814', 'Published', '1760867616', NULL, '---', 245, '2025-10-19', '1', 'out', '2', '1', NULL, 'NaN', '28000', '28000', NULL, NULL, NULL),
(262, '+256-759912814', 1760867669, '+256-759912814', 'Published', '1760867669', NULL, '---', 248, '2025-10-19', '1', 'in', '0', '1', NULL, 'Pcs', '25000', '25000', NULL, NULL, NULL),
(263, '+256-759912814', 1760867763, '+256-759912814', 'Published', '1760867763', NULL, '---', 249, '2025-10-19', '2', 'in', '0', '2', NULL, 'Pcs', '25000', '50000', NULL, NULL, NULL),
(264, '+256-759912814', 1760867835, '+256-759912814', 'Published', '1760867835', NULL, '---', 250, '2025-10-19', '2', 'in', '0', '2', NULL, 'Pcs', '25000', '50000', NULL, NULL, NULL),
(265, '+256-759912814', 1760867979, '+256-759912814', 'Published', '1760867979', NULL, '---', 251, '2025-10-19', '38', 'in', '0', '38', NULL, 'Pcs', '9000', '342000', NULL, NULL, NULL),
(266, '+256-759912814', 1760867979, '+256-759912814', 'Published', '1760867979', NULL, '---', 252, '2025-10-19', '38', 'in', '0', '38', NULL, 'Pcs', '9000', '342000', NULL, NULL, NULL),
(267, '+256-759912814', 1760868174, '+256-759912814', 'Published', '1760868174', NULL, '---', 253, '2025-10-19', '48', 'in', '0', '48', NULL, 'Pcs', '4200', '201600', NULL, NULL, NULL),
(268, '+256-759912814', 1760868212, '+256-759912814', 'Published', '1760868212', NULL, '---', 254, '2025-10-19', '17', 'in', '0', '17', NULL, 'Pcs', '5000', '85000', NULL, NULL, NULL),
(269, '+256-759912814', 1760868273, '+256-759912814', 'Published', '1760868273', NULL, '---', 255, '2025-10-19', '5', 'in', '0', '5', NULL, 'Pcs', '25000', '125000', NULL, NULL, NULL),
(270, '+256-759912814', 1760868327, '+256-759912814', 'Published', '1760868327', NULL, '---', 256, '2025-10-19', '5', 'in', '0', '5', NULL, 'Pcs', '2500', '12500', NULL, NULL, NULL),
(271, '+256-759912814', 1760868425, '+256-759912814', 'Published', '1760868425', NULL, '---', 257, '2025-10-19', '21', 'in', '0', '21', NULL, 'Pcs', '2000', '42000', NULL, NULL, NULL),
(272, '+256-759912814', 1760868462, '+256-759912814', 'Published', '1760868462', NULL, '---', 258, '2025-10-19', '20', 'in', '0', '20', NULL, 'Pcs', '1700', '34000', NULL, NULL, NULL),
(273, '+256-759912814', 1760868501, '+256-759912814', 'Published', '1760868501', NULL, '---', 259, '2025-10-19', '1', 'in', '0', '1', NULL, 'Pcs', '2000', '2000', NULL, NULL, NULL),
(274, '+256-759912814', 1760868601, '+256-759912814', 'Published', '1760868601', NULL, '---', 257, '2025-10-19', '19', 'in', '21', '40', NULL, 'NaN', '2000', '38000', NULL, NULL, NULL),
(275, '+256-759912814', 1760868683, '+256-759912814', 'Published', '1760868683', NULL, '---', 260, '2025-10-19', '1', 'in', '0', '1', NULL, 'Pcs', '850', '850', NULL, NULL, NULL),
(276, '+256-759912814', 1760869583, '+256-759912814', 'Published', '1760869583', NULL, '---', 261, '2025-10-19', '21', 'in', '0', '21', NULL, 'Pcs', '23000', '483000', NULL, NULL, NULL);
INSERT INTO `stock_history` (`id`, `owner_mobile`, `timestamp`, `added_by`, `status`, `last_updated`, `sync`, `---`, `product_id`, `date`, `qty`, `in_out`, `qty_before`, `qty_after`, `invoice_id`, `measuring_unit`, `unit_price`, `total_price`, `cost_per_unit`, `profit_per_unit`, `total_profit`) VALUES
(277, '+256-759912814', 1760869630, '+256-759912814', 'Published', '1760869630', NULL, '---', 262, '2025-10-19', '18', 'in', '0', '18', NULL, 'Pcs', '2300', '41400', NULL, NULL, NULL),
(278, '+256-759912814', 1760869716, '+256-759912814', 'Published', '1760869716', NULL, '---', 263, '2025-10-19', '18', 'in', '0', '18', NULL, 'Pcs', '3000', '54000', NULL, NULL, NULL),
(279, '+256-759912814', 1760869752, '+256-759912814', 'Published', '1760869752', NULL, '---', 264, '2025-10-19', '0', 'in', '0', '0', NULL, 'Pcs', '2500', '0', NULL, NULL, NULL),
(280, '+256-759912814', 1760869931, '+256-759912814', 'Published', '1760869931', NULL, '---', 265, '2025-10-19', '40', 'in', '0', '40', NULL, 'Pcs', '2150', '86000', NULL, NULL, NULL),
(281, '+256-759912814', 1760869994, '+256-759912814', 'Published', '1760869994', NULL, '---', 266, '2025-10-19', '2', 'in', '0', '2', NULL, 'Pcs', '16000', '32000', NULL, NULL, NULL),
(282, '+256-759912814', 1760870047, '+256-759912814', 'Published', '1760870047', NULL, '---', 267, '2025-10-19', '0', 'in', '0', '0', NULL, 'Pcs', '9000', '0', NULL, NULL, NULL),
(283, '+256-759912814', 1760870118, '+256-759912814', 'Published', '1760870118', NULL, '---', 267, '2025-10-19', '4', 'in', '0', '4', NULL, 'NaN', '9000', '36000', NULL, NULL, NULL),
(284, '+256-759912814', 1760870214, '+256-759912814', 'Published', '1760870214', NULL, '---', 268, '2025-10-19', '0', 'in', '0', '0', NULL, 'Pcs', '9000', '0', NULL, NULL, NULL),
(285, '+256-759912814', 1760870288, '+256-759912814', 'Published', '1760870288', NULL, '---', 269, '2025-10-19', '3', 'in', '0', '3', NULL, 'Pcs', '18000', '54000', NULL, NULL, NULL),
(286, '+256-759912814', 1760870357, '+256-759912814', 'Published', '1760870357', NULL, '---', 270, '2025-10-19', '0', 'in', '0', '0', NULL, 'Pcs', '18500', '0', NULL, NULL, NULL),
(287, '+256-759912814', 1760870502, '+256-759912814', 'Published', '1760870502', NULL, '---', 271, '2025-10-19', '5', 'in', '0', '5', NULL, 'Pcs', '23500', '117500', NULL, NULL, NULL),
(288, '+256-759912814', 1760974742, '+256-759912814', 'Published', '1760974742', NULL, '---', 272, '2025-10-20', '0', 'in', '0', '0', NULL, 'Pcs', '18000', '0', NULL, NULL, NULL),
(289, '+256-759912814', 1760974855, '+256-759912814', 'Published', '1760974855', NULL, '---', 273, '2025-10-20', '0', 'in', '0', '0', NULL, 'Pcs', '10500', '0', NULL, NULL, NULL),
(290, '+256-759912814', 1760974900, '+256-759912814', 'Published', '1760974900', NULL, '---', 274, '2025-10-20', '3', 'in', '0', '3', NULL, 'Pcs', '9000', '27000', NULL, NULL, NULL),
(291, '+256-759912814', 1760974942, '+256-759912814', 'Published', '1760974942', NULL, '---', 275, '2025-10-20', '0', 'in', '0', '0', NULL, 'Pcs', '28900', '0', NULL, NULL, NULL),
(292, '+256-759912814', 1760975126, '+256-759912814', 'Published', '1760975126', NULL, '---', 276, '2025-10-20', '2', 'in', '0', '2', NULL, 'Pcs', '25000', '50000', NULL, NULL, NULL),
(293, '+256-759912814', 1760975191, '+256-759912814', 'Published', '1760975191', NULL, '---', 277, '2025-10-20', '3', 'in', '0', '3', NULL, 'Pcs', '50000', '150000', NULL, NULL, NULL),
(294, '+256-759912814', 1760975240, '+256-759912814', 'Published', '1760975240', NULL, '---', 278, '2025-10-20', '7', 'in', '0', '7', NULL, 'Pcs', '26000', '182000', NULL, NULL, NULL),
(295, '+256-759912814', 1760975363, '+256-759912814', 'Published', '1760975363', NULL, '---', 279, '2025-10-20', '0', 'in', '0', '0', NULL, 'Pcs', '29400', '0', NULL, NULL, NULL),
(296, '+256-759912814', 1760975364, '+256-759912814', 'Published', '1760975364', NULL, '---', 280, '2025-10-20', '0', 'in', '0', '0', NULL, 'Pcs', '29400', '0', NULL, NULL, NULL),
(297, '+256-759912814', 1760975411, '+256-759912814', 'Published', '1760975411', NULL, '---', 281, '2025-10-20', '0', 'in', '0', '0', NULL, 'Pcs', '6000', '0', NULL, NULL, NULL),
(298, '+256-759912814', 1760975453, '+256-759912814', 'Published', '1760975453', NULL, '---', 282, '2025-10-20', '17', 'in', '0', '17', NULL, 'Pcs', '4700', '79900', NULL, NULL, NULL),
(299, '+256-759912814', 1760975503, '+256-759912814', 'Published', '1760975503', NULL, '---', 283, '2025-10-20', '20', 'in', '0', '20', NULL, 'Pcs', '4500', '90000', NULL, NULL, NULL),
(300, '+256-759912814', 1760975546, '+256-759912814', 'Published', '1760975546', NULL, '---', 284, '2025-10-20', '25', 'in', '0', '25', NULL, 'Pcs', '6000', '150000', NULL, NULL, NULL),
(301, '+256-759912814', 1760975588, '+256-759912814', 'Published', '1760975588', NULL, '---', 285, '2025-10-20', '19', 'in', '0', '19', NULL, 'Pcs', '4000', '76000', NULL, NULL, NULL),
(302, '+256-759912814', 1760975667, '+256-759912814', 'Published', '1760975667', NULL, '---', 286, '2025-10-20', '0', 'in', '0', '0', NULL, 'Pcs', '6000', '0', NULL, NULL, NULL),
(303, '+256-759912814', 1760975732, '+256-759912814', 'Published', '1760975732', NULL, '---', 287, '2025-10-20', '142', 'in', '0', '142', NULL, 'Pcs', '3900', '553800', NULL, NULL, NULL),
(304, '+256-759912814', 1760975830, '+256-759912814', 'Published', '1760975830', NULL, '---', 288, '2025-10-20', '0', 'in', '0', '0', NULL, 'Pcs', '10000', '0', NULL, NULL, NULL),
(305, '+256-759912814', 1760975909, '+256-759912814', 'Published', '1760975909', NULL, '---', 289, '2025-10-20', '0', 'in', '0', '0', NULL, 'Pcs', '4100', '0', NULL, NULL, NULL),
(306, '+256-759912814', 1760975957, '+256-759912814', 'Published', '1760975957', NULL, '---', 290, '2025-10-20', '0', 'in', '0', '0', NULL, 'Pcs', '5000', '0', NULL, NULL, NULL),
(307, '+256-759912814', 1760976021, '+256-759912814', 'Published', '1760976021', NULL, '---', 291, '2025-10-20', '190', 'in', '0', '190', NULL, 'Pcs', '400', '76000', NULL, NULL, NULL),
(308, '+256-759912814', 1760976099, '+256-759912814', 'Published', '1760976099', NULL, '---', 292, '2025-10-20', '0', 'in', '0', '0', NULL, 'Pcs', '400', '0', NULL, NULL, NULL),
(309, '+256-759912814', 1760976152, '+256-759912814', 'Published', '1760976152', NULL, '---', 293, '2025-10-20', '4', 'in', '0', '4', NULL, 'Pcs', '17000', '68000', NULL, NULL, NULL),
(310, '+256-759912814', 1760976213, '+256-759912814', 'Published', '1760976213', NULL, '---', 294, '2025-10-20', '0', 'in', '0', '0', NULL, 'Pcs', '14000', '0', NULL, NULL, NULL),
(311, '+256-759912814', 1760976257, '+256-759912814', 'Published', '1760976257', NULL, '---', 295, '2025-10-20', '0', 'in', '0', '0', NULL, 'Pcs', '18000', '0', NULL, NULL, NULL),
(312, '+256-759912814', 1760976342, '+256-759912814', 'Published', '1760976342', NULL, '---', 296, '2025-10-20', '1', 'in', '0', '1', NULL, 'Pcs', '30000', '30000', NULL, NULL, NULL),
(313, '+256-759912814', 1760976396, '+256-759912814', 'Published', '1760976396', NULL, '---', 290, '2025-10-20', '2', 'in', '0', '2', NULL, 'NaN', '5000', '10000', NULL, NULL, NULL),
(314, '+256-759912814', 1760976518, '+256-759912814', 'Published', '1760976518', NULL, '---', 297, '2025-10-20', '5', 'in', '0', '5', NULL, 'Pcs', '11000', '55000', NULL, NULL, NULL),
(315, '+256-759912814', 1760976975, '+256-759912814', 'Published', '1760976975', NULL, '---', 298, '2025-10-20', '7', 'in', '0', '7', NULL, 'Pcs', '12000', '84000', NULL, NULL, NULL),
(316, '+256-759912814', 1760977062, '+256-759912814', 'Published', '1760977062', NULL, '---', 299, '2025-10-20', '6', 'in', '0', '6', NULL, 'Pcs', '500', '3000', NULL, NULL, NULL),
(317, '+256-759912814', 1760977145, '+256-759912814', 'Published', '1760977145', NULL, '---', 300, '2025-10-20', '10', 'in', '0', '10', NULL, 'Pcs', '0', '0', NULL, NULL, NULL),
(318, '+256-759912814', 1760977427, '+256-759912814', 'Published', '1760977427', NULL, '---', 301, '2025-10-20', '1', 'in', '0', '1', NULL, 'Pcs', '135000', '135000', NULL, NULL, NULL),
(319, '+256-759912814', 1760977474, '+256-759912814', 'Published', '1760977474', NULL, '---', 302, '2025-10-20', '1', 'in', '0', '1', NULL, 'Pcs', '170000', '170000', NULL, NULL, NULL),
(320, '+256-759912814', 1761037680, '+256-759912814', 'Published', '1761037680', NULL, '---', 303, '2025-10-21', '2', 'in', '0', '2', NULL, 'Pcs', '11200', '22400', NULL, NULL, NULL),
(321, '+256-759912814', 1761037815, '+256-759912814', 'Published', '1761037815', NULL, '---', 304, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '17000', '0', NULL, NULL, NULL),
(322, '+256-759912814', 1761037933, '+256-759912814', 'Published', '1761037933', NULL, '---', 305, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '50000', '0', NULL, NULL, NULL),
(323, '+256-759912814', 1761038043, '+256-759912814', 'Published', '1761038043', NULL, '---', 306, '2025-10-21', '4', 'in', '0', '4', NULL, 'Pcs', '45000', '180000', NULL, NULL, NULL),
(324, '+256-759912814', 1761038098, '+256-759912814', 'Published', '1761038098', NULL, '---', 307, '2025-10-21', '5', 'in', '0', '5', NULL, 'Pcs', '65000', '325000', NULL, NULL, NULL),
(325, '+256-759912814', 1761038141, '+256-759912814', 'Published', '1761038141', NULL, '---', 308, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '54400', '0', NULL, NULL, NULL),
(326, '+256-759912814', 1761038197, '+256-759912814', 'Published', '1761038197', NULL, '---', 309, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '10000', '0', NULL, NULL, NULL),
(327, '+256-759912814', 1761038318, '+256-759912814', 'Published', '1761038318', NULL, '---', 310, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '7800', '0', NULL, NULL, NULL),
(328, '+256-759912814', 1761038379, '+256-759912814', 'Published', '1761038379', NULL, '---', 311, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '5000', '0', NULL, NULL, NULL),
(329, '+256-759912814', 1761038500, '+256-759912814', 'Published', '1761038500', NULL, '---', 312, '2025-10-21', '25', 'in', '0', '25', NULL, 'Pcs', '8000', '200000', NULL, NULL, NULL),
(330, '+256-759912814', 1761038547, '+256-759912814', 'Published', '1761038547', NULL, '---', 313, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '6000', '0', NULL, NULL, NULL),
(331, '+256-759912814', 1761038614, '+256-759912814', 'Published', '1761038614', NULL, '---', 314, '2025-10-21', '6', 'in', '0', '6', NULL, 'Pcs', '8000', '48000', NULL, NULL, NULL),
(332, '+256-759912814', 1761038667, '+256-759912814', 'Published', '1761038667', NULL, '---', 315, '2025-10-21', '8', 'in', '0', '8', NULL, 'Pcs', '10000', '80000', NULL, NULL, NULL),
(333, '+256-759912814', 1761038711, '+256-759912814', 'Published', '1761038711', NULL, '---', 316, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '5000', '0', NULL, NULL, NULL),
(334, '+256-759912814', 1761038784, '+256-759912814', 'Published', '1761038784', NULL, '---', 317, '2025-10-21', '21', 'in', '0', '21', NULL, 'Pcs', '8000', '168000', NULL, NULL, NULL),
(335, '+256-759912814', 1761038882, '+256-759912814', 'Published', '1761038882', NULL, '---', 318, '2025-10-21', '78', 'in', '0', '78', NULL, 'Pcs', '7750', '604500', NULL, NULL, NULL),
(336, '+256-759912814', 1761038932, '+256-759912814', 'Published', '1761038932', NULL, '---', 319, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '9500', '0', NULL, NULL, NULL),
(337, '+256-759912814', 1761038973, '+256-759912814', 'Published', '1761038973', NULL, '---', 320, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '7500', '0', NULL, NULL, NULL),
(338, '+256-759912814', 1761039034, '+256-759912814', 'Published', '1761039034', NULL, '---', 321, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '12500', '0', NULL, NULL, NULL),
(339, '+256-759912814', 1761039113, '+256-759912814', 'Published', '1761039113', NULL, '---', 322, '2025-10-21', '9', 'in', '0', '9', NULL, 'Pcs', '1000', '9000', NULL, NULL, NULL),
(340, '+256-759912814', 1761039183, '+256-759912814', 'Published', '1761039183', NULL, '---', 323, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '1000', '0', NULL, NULL, NULL),
(341, '+256-759912814', 1761039238, '+256-759912814', 'Published', '1761039238', NULL, '---', 324, '2025-10-21', '19', 'in', '0', '19', NULL, 'Pcs', '2300', '43700', NULL, NULL, NULL),
(342, '+256-759912814', 1761039702, '+256-759912814', 'Published', '1761039702', NULL, '---', 325, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '2400', '0', NULL, NULL, NULL),
(343, '+256-759912814', 1761039781, '+256-759912814', 'Published', '1761039781', NULL, '---', 326, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '32000', '0', NULL, NULL, NULL),
(344, '+256-759912814', 1761039833, '+256-759912814', 'Published', '1761039833', NULL, '---', 327, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '30000', '0', NULL, NULL, NULL),
(345, '+256-759912814', 1761039910, '+256-759912814', 'Published', '1761039910', NULL, '---', 328, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '38500', '0', NULL, NULL, NULL),
(346, '+256-759912814', 1761039958, '+256-759912814', 'Published', '1761039958', NULL, '---', 329, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '5000', '0', NULL, NULL, NULL),
(347, '+256-759912814', 1761040049, '+256-759912814', 'Published', '1761040049', NULL, '---', 330, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '18000', '0', NULL, NULL, NULL),
(348, '+256-759912814', 1761040098, '+256-759912814', 'Published', '1761040098', NULL, '---', 331, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '8000', '0', NULL, NULL, NULL),
(349, '+256-759912814', 1761040155, '+256-759912814', 'Published', '1761040155', NULL, '---', 332, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '4000', '0', NULL, NULL, NULL),
(350, '+256-759912814', 1761040210, '+256-759912814', 'Published', '1761040210', NULL, '---', 333, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '1350', '0', NULL, NULL, NULL),
(351, '+256-759912814', 1761040214, '+256-759912814', 'Published', '1761040214', NULL, '---', 334, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '1350', '0', NULL, NULL, NULL),
(352, '+256-759912814', 1761040298, '+256-759912814', 'Published', '1761040298', NULL, '---', 335, '2025-10-21', '18', 'in', '0', '18', NULL, 'Pcs', '1000', '18000', NULL, NULL, NULL),
(353, '+256-759912814', 1761040331, '+256-759912814', 'Published', '1761040331', NULL, '---', 336, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '1100', '0', NULL, NULL, NULL),
(354, '+256-759912814', 1761040447, '+256-759912814', 'Published', '1761040447', NULL, '---', 337, '2025-10-21', '00', 'in', '0', '00', NULL, 'Pcs', '167', '0', NULL, NULL, NULL),
(355, '+256-759912814', 1761040555, '+256-759912814', 'Published', '1761040555', NULL, '---', 338, '2025-10-21', '6', 'in', '0', '6', NULL, 'Pcs', '223', '1338', NULL, NULL, NULL),
(356, '+256-759912814', 1761040599, '+256-759912814', 'Published', '1761040599', NULL, '---', 339, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '167', '0', NULL, NULL, NULL),
(357, '+256-759912814', 1761040639, '+256-759912814', 'Published', '1761040639', NULL, '---', 340, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '1000', '0', NULL, NULL, NULL),
(358, '+256-759912814', 1761040675, '+256-759912814', 'Published', '1761040675', NULL, '---', 341, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '4000', '0', NULL, NULL, NULL),
(359, '+256-759912814', 1761040727, '+256-759912814', 'Published', '1761040727', NULL, '---', 342, '2025-10-21', '3', 'in', '0', '3', NULL, 'Pcs', '0', '0', NULL, NULL, NULL),
(360, '+256-759912814', 1761040797, '+256-759912814', 'Published', '1761040797', NULL, '---', 343, '2025-10-21', '3', 'in', '0', '3', NULL, 'Pcs', '0', '0', NULL, NULL, NULL),
(361, '+256-759912814', 1761040861, '+256-759912814', 'Published', '1761040861', NULL, '---', 344, '2025-10-21', '49', 'in', '0', '49', NULL, 'Pcs', '8000', '392000', NULL, NULL, NULL),
(362, '+256-759912814', 1761040978, '+256-759912814', 'Published', '1761040978', NULL, '---', 345, '2025-10-21', '1', 'in', '0', '1', NULL, 'Pcs', '2500', '2500', NULL, NULL, NULL),
(363, '+256-759912814', 1761041019, '+256-759912814', 'Published', '1761041019', NULL, '---', 346, '2025-10-21', '2', 'in', '0', '2', NULL, 'Pcs', '2000', '4000', NULL, NULL, NULL),
(364, '+256-759912814', 1761041087, '+256-759912814', 'Published', '1761041087', NULL, '---', 347, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '3800', '0', NULL, NULL, NULL),
(365, '+256-759912814', 1761041126, '+256-759912814', 'Published', '1761041126', NULL, '---', 348, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '3500', '0', NULL, NULL, NULL),
(366, '+256-759912814', 1761041197, '+256-759912814', 'Published', '1761041197', NULL, '---', 349, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '7500', '0', NULL, NULL, NULL),
(367, '+256-759912814', 1761041268, '+256-759912814', 'Published', '1761041268', NULL, '---', 350, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '5000', '0', NULL, NULL, NULL),
(368, '+256-759912814', 1761041346, '+256-759912814', 'Published', '1761041346', NULL, '---', 351, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '400', '0', NULL, NULL, NULL),
(369, '+256-759912814', 1761041347, '+256-759912814', 'Published', '1761041347', NULL, '---', 352, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '400', '0', NULL, NULL, NULL),
(370, '+256-759912814', 1761041514, '+256-759912814', 'Published', '1761041514', NULL, '---', 353, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '900', '0', NULL, NULL, NULL),
(371, '+256-759912814', 1761041574, '+256-759912814', 'Published', '1761041574', NULL, '---', 354, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '7000', '0', NULL, NULL, NULL),
(372, '+256-759912814', 1761041678, '+256-759912814', 'Published', '1761041678', NULL, '---', 355, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '7000', '0', NULL, NULL, NULL),
(373, '+256-759912814', 1761041729, '+256-759912814', 'Published', '1761041729', NULL, '---', 356, '2025-10-21', '14', 'in', '0', '14', NULL, 'Pcs', '6000', '84000', NULL, NULL, NULL),
(374, '+256-759912814', 1761041767, '+256-759912814', 'Published', '1761041767', NULL, '---', 357, '2025-10-21', '6', 'in', '0', '6', NULL, 'Pcs', '8300', '49800', NULL, NULL, NULL),
(375, '+256-759912814', 1761041811, '+256-759912814', 'Published', '1761041811', NULL, '---', 358, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '9500', '0', NULL, NULL, NULL),
(376, '+256-759912814', 1761041910, '+256-759912814', 'Published', '1761041910', NULL, '---', 354, '2025-10-21', '21', 'in', '0', '21', NULL, 'NaN', '7000', '147000', NULL, NULL, NULL),
(377, '+256-759912814', 1761041971, '+256-759912814', 'Published', '1761041971', NULL, '---', 359, '2025-10-21', '1', 'in', '0', '1', NULL, 'Pcs', '8000', '8000', NULL, NULL, NULL),
(378, '+256-759912814', 1761042019, '+256-759912814', 'Published', '1761042019', NULL, '---', 360, '2025-10-21', '9', 'in', '0', '9', NULL, 'Pcs', '10500', '94500', NULL, NULL, NULL),
(379, '+256-759912814', 1761042060, '+256-759912814', 'Published', '1761042060', NULL, '---', 361, '2025-10-21', '1', 'in', '0', '1', NULL, 'Pcs', '8000', '8000', NULL, NULL, NULL),
(380, '+256-759912814', 1761042104, '+256-759912814', 'Published', '1761042104', NULL, '---', 362, '2025-10-21', '9', 'in', '0', '9', NULL, 'Pcs', '8000', '72000', NULL, NULL, NULL),
(381, '+256-759912814', 1761042143, '+256-759912814', 'Published', '1761042143', NULL, '---', 363, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '7500', '0', NULL, NULL, NULL),
(382, '+256-759912814', 1761042190, '+256-759912814', 'Published', '1761042190', NULL, '---', 364, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '8200', '0', NULL, NULL, NULL),
(383, '+256-759912814', 1761042235, '+256-759912814', 'Published', '1761042235', NULL, '---', 365, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '15840', '0', NULL, NULL, NULL),
(384, '+256-759912814', 1761042671, '+256-759912814', 'Published', '1761042671', NULL, '---', 366, '2025-10-21', '238', 'in', '0', '238', NULL, 'Pcs', '1150', '273700', NULL, NULL, NULL),
(385, '+256-759912814', 1761042736, '+256-759912814', 'Published', '1761042736', NULL, '---', 367, '2025-10-21', '19', 'in', '0', '19', NULL, 'Pcs', '1200', '22800', NULL, NULL, NULL),
(386, '+256-759912814', 1761042781, '+256-759912814', 'Published', '1761042781', NULL, '---', 368, '2025-10-21', '6', 'in', '0', '6', NULL, 'Pcs', '1800', '10800', NULL, NULL, NULL),
(387, '+256-759912814', 1761042818, '+256-759912814', 'Published', '1761042818', NULL, '---', 369, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '2500', '0', NULL, NULL, NULL),
(388, '+256-759912814', 1761042869, '+256-759912814', 'Published', '1761042869', NULL, '---', 370, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '1300', '0', NULL, NULL, NULL),
(389, '+256-759912814', 1761042947, '+256-759912814', 'Published', '1761042947', NULL, '---', 371, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '80500', '0', NULL, NULL, NULL),
(390, '+256-759912814', 1761042996, '+256-759912814', 'Published', '1761042996', NULL, '---', 372, '2025-10-21', '5', 'in', '0', '5', NULL, 'Pcs', '2200', '11000', NULL, NULL, NULL),
(391, '+256-759912814', 1761043045, '+256-759912814', 'Published', '1761043045', NULL, '---', 373, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '3500', '0', NULL, NULL, NULL),
(392, '+256-759912814', 1761043116, '+256-759912814', 'Published', '1761043116', NULL, '---', 374, '2025-10-21', '1', 'in', '0', '1', NULL, 'Pcs', '2000', '2000', NULL, NULL, NULL),
(393, '+256-759912814', 1761043181, '+256-759912814', 'Published', '1761043181', NULL, '---', 375, '2025-10-21', '204', 'in', '0', '204', NULL, 'Pcs', '2000', '408000', NULL, NULL, NULL),
(394, '+256-759912814', 1761043217, '+256-759912814', 'Published', '1761043217', NULL, '---', 376, '2025-10-21', '9', 'in', '0', '9', NULL, 'Pcs', '2200', '19800', NULL, NULL, NULL),
(395, '+256-759912814', 1761043256, '+256-759912814', 'Published', '1761043256', NULL, '---', 377, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '1500', '0', NULL, NULL, NULL),
(396, '+256-759912814', 1761043293, '+256-759912814', 'Published', '1761043293', NULL, '---', 378, '2025-10-21', '0', 'in', '0', '0', NULL, 'Pcs', '13000', '0', NULL, NULL, NULL),
(397, '+256-759912814', 1761043355, '+256-759912814', 'Published', '1761043355', NULL, '---', 379, '2025-10-21', '30', 'in', '0', '30', NULL, 'Pcs', '2600', '78000', NULL, NULL, NULL),
(398, '+256-759912814', 1761043424, '+256-759912814', 'Published', '1761043424', NULL, '---', 380, '2025-10-21', '2', 'in', '0', '2', NULL, 'Pcs', '1500', '3000', NULL, NULL, NULL),
(399, '+256-759912814', 1761043480, '+256-759912814', 'Published', '1761043480', NULL, '---', 381, '2025-10-21', '19', 'in', '0', '19', NULL, 'Pcs', '1650', '31350', NULL, NULL, NULL),
(400, '+256-759912814', 1761213772, '+256-759912814', 'Published', '1761213772', NULL, '---', 382, '2025-10-23', '18', 'in', '0', '18', NULL, 'Pcs', '3000', '54000', NULL, NULL, NULL),
(401, '+256-759912814', 1763977323, '+256-759912814', 'Published', '1763977323', NULL, '---', 383, '2025-11-24', '8', 'in', '0', '8', NULL, 'Pcs', '800', '6400', NULL, NULL, NULL),
(402, '+256-759912814', 1763982936, '+256-759912814', 'Published', '1763982936', NULL, '---', 384, '2025-11-24', '1', 'in', '0', '1', NULL, 'Pcs', '13000', '13000', NULL, NULL, NULL),
(403, '+256-759912814', 1763984051, '+256-759912814', 'Published', '1763984051', NULL, '---', 385, '2025-11-24', '17', 'in', '0', '17', NULL, 'Pcs', '1250', '21250', NULL, NULL, NULL),
(404, '+256-759912814', 1763984136, '+256-759912814', 'Published', '1763984136', NULL, '---', 386, '2025-11-24', '3', 'in', '0', '3', NULL, 'Pcs', '1000', '3000', NULL, NULL, NULL),
(405, '+256-759912814', 1763984215, '+256-759912814', 'Published', '1763984215', NULL, '---', 387, '2025-11-24', '16', 'in', '0', '16', NULL, 'Pcs', '1250', '20000', NULL, NULL, NULL),
(406, '+256-759912814', 1763984486, '+256-759912814', 'Published', '1763984486', NULL, '---', 388, '2025-11-24', '5', 'in', '0', '5', NULL, 'Pcs', '24000', '120000', NULL, NULL, NULL),
(407, '+256-759912814', 1763984580, '+256-759912814', 'Published', '1763984580', NULL, '---', 389, '2025-11-24', '10', 'in', '0', '10', NULL, 'Pcs', '1000', '10000', NULL, NULL, NULL),
(408, '+256-759912814', 1763984682, '+256-759912814', 'Published', '1763984682', NULL, '---', 390, '2025-11-24', '93', 'in', '0', '93', NULL, 'Pcs', '1250', '116250', NULL, NULL, NULL),
(409, '+256-759912814', 1763984778, '+256-759912814', 'Published', '1763984778', NULL, '---', 391, '2025-11-24', '0', 'in', '0', '0', NULL, 'Pcs', '25000', '0', NULL, NULL, NULL),
(410, '+256-759912814', 1763984832, '+256-759912814', 'Published', '1763984832', NULL, '---', 392, '2025-11-24', '0', 'in', '0', '0', NULL, 'Pcs', '18200', '0', NULL, NULL, NULL),
(411, '+256-759912814', 1763984883, '+256-759912814', 'Published', '1763984883', NULL, '---', 393, '2025-11-24', '0', 'in', '0', '0', NULL, 'Pcs', '19250', '0', NULL, NULL, NULL),
(412, '+256-759912814', 1763984930, '+256-759912814', 'Published', '1763984930', NULL, '---', 394, '2025-11-24', '0', 'in', '0', '0', NULL, 'Pcs', '19750', '0', NULL, NULL, NULL),
(413, '+256-759912814', 1763984971, '+256-759912814', 'Published', '1763984971', NULL, '---', 395, '2025-11-24', '11', 'in', '0', '11', NULL, 'Pcs', '1000', '11000', NULL, NULL, NULL),
(414, '+256-759912814', 1763985575, '+256-759912814', 'Published', '1763985575', NULL, '---', 396, '2025-11-24', '77', 'in', '0', '77', NULL, 'Pcs', '800', '61600', NULL, NULL, NULL),
(415, '+256-759912814', 1763985628, '+256-759912814', 'Published', '1763985628', NULL, '---', 397, '2025-11-24', '19', 'in', '0', '19', NULL, 'Pcs', '1000', '19000', NULL, NULL, NULL),
(416, '+256-759912814', 1763985678, '+256-759912814', 'Published', '1763985678', NULL, '---', 396, '2025-11-24', '19', 'out', '77', '58', NULL, 'NaN', '800', '15200', NULL, NULL, NULL),
(417, '+92-3335672555', 1764131548, '+92-3335672555', 'Published', '1764131548', NULL, '---', 398, '2025-11-26', '3.25', 'in', '0', '3.25', NULL, 'Meter', '400', '1300', NULL, NULL, NULL),
(418, '+92-3335672555', 1764131599, '+92-3335672555', 'Published', '1764131599', NULL, '---', 399, '2025-11-26', '0', 'in', '0', '0', NULL, 'Pcs', '0', '0', NULL, NULL, NULL),
(419, '+92-3335672555', 1764131718, '+92-3335672555', 'Published', '1764131718', NULL, '---', 398, '2025-11-26', '3.25', 'activity_input', '3.25', '0', '1', '', '400', '1300', '400', '0', '0'),
(420, '+92-3335672555', 1764131718, '+92-3335672555', 'Published', '1764131718', NULL, '---', 399, '2025-11-26', '1', 'activity_output', '0', '1', '1', '', '1450', '1450', '1450', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfer`
--

CREATE TABLE `stock_transfer` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Published',
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `from_location` varchar(5) DEFAULT NULL,
  `to_location` varchar(5) DEFAULT NULL,
  `cartitems` mediumtext DEFAULT NULL,
  `variants_json` mediumtext DEFAULT NULL,
  `secondary_json` text DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL,
  `custom_fields` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_variant_history`
--

CREATE TABLE `stock_variant_history` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `variant_id` int(11) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `qty` varchar(30) DEFAULT NULL,
  `in_out` varchar(30) DEFAULT NULL,
  `qty_before` varchar(30) DEFAULT NULL,
  `qty_after` varchar(30) DEFAULT NULL,
  `invoice_id` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_cart_items`
--

CREATE TABLE `store_cart_items` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `PHPSESSID` text NOT NULL,
  `item_id` text NOT NULL,
  `item_qty` text NOT NULL,
  `sale_price` text NOT NULL,
  `total` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stripe_payments`
--

CREATE TABLE `stripe_payments` (
  `id` int(11) NOT NULL,
  `user_number` varchar(50) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `payment_status` enum('paid','failed') NOT NULL,
  `membership_type` enum('monthly','yearly','lifetime') NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE `todo` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `job` varchar(11) DEFAULT NULL,
  `date` varchar(11) DEFAULT NULL,
  `customer` varchar(30) DEFAULT NULL,
  `item_name` varchar(11) DEFAULT NULL,
  `uom` varchar(11) DEFAULT NULL,
  `qty` varchar(11) DEFAULT NULL,
  `brand` varchar(99) DEFAULT NULL,
  `priority` varchar(11) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `expiry` varchar(20) DEFAULT 'NULL',
  `added_by` varchar(20) DEFAULT 'NULL',
  `status` varchar(20) DEFAULT 'NULL',
  `last_updated` varchar(20) DEFAULT 'NULL',
  `ip` varchar(20) DEFAULT 'NULL',
  `sync` varchar(5) DEFAULT 'NULL',
  `source` varchar(255) DEFAULT 'NULL',
  `---` varchar(5) NOT NULL DEFAULT '---',
  `industry_type` varchar(50) DEFAULT 'NULL',
  `business_type` varchar(30) DEFAULT 'NULL',
  `business_name` varchar(50) DEFAULT 'NULL',
  `address` mediumtext DEFAULT NULL,
  `email` varchar(100) DEFAULT 'NULL',
  `country_code` varchar(7) DEFAULT 'NULL',
  `mobile` varchar(20) DEFAULT 'NULL',
  `number` varchar(30) DEFAULT 'NULL',
  `password` varchar(255) DEFAULT 'NULL',
  `default_account_keys` mediumtext DEFAULT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'Rs. ',
  `logo` text DEFAULT NULL,
  `----` varchar(5) NOT NULL DEFAULT '----',
  `gst` varchar(30) DEFAULT '0',
  `vat` varchar(30) DEFAULT '0',
  `negative` varchar(5) DEFAULT 'on',
  `tax` varchar(10) NOT NULL DEFAULT 'off',
  `lend_inventory` varchar(99) NOT NULL DEFAULT 'off',
  `secondary_units` varchar(10) NOT NULL DEFAULT 'off',
  `variants` varchar(10) NOT NULL DEFAULT 'off',
  `barcode` varchar(10) DEFAULT 'off',
  `smsnotification` varchar(10) NOT NULL DEFAULT 'on',
  `salesman_commission` varchar(5) NOT NULL DEFAULT 'off',
  `agent_commision` varchar(5) NOT NULL DEFAULT 'off',
  `-------` varchar(8) NOT NULL DEFAULT '-------',
  `print_header` varchar(11) NOT NULL DEFAULT 'on',
  `print_urdu_invoice` varchar(11) NOT NULL DEFAULT 'off',
  `print_header_note` text DEFAULT NULL,
  `print_footer_note` text DEFAULT NULL,
  `print_default_template` text DEFAULT 'A4',
  `-----` varchar(11) NOT NULL DEFAULT '-----',
  `type` varchar(20) NOT NULL DEFAULT 'prepaid',
  `date` varchar(20) DEFAULT 'NULL',
  `coins` varchar(20) DEFAULT '50',
  `sms_credit` varchar(9) DEFAULT '100',
  `------` varchar(11) NOT NULL DEFAULT '------',
  `cohort` varchar(11) DEFAULT '0000-00',
  `entries` int(5) NOT NULL DEFAULT 0,
  `active_days` int(11) DEFAULT NULL,
  `login_count` int(5) NOT NULL DEFAULT 0,
  `------------` varchar(20) NOT NULL DEFAULT '------------',
  `products` int(11) DEFAULT NULL,
  `accounts` int(11) DEFAULT NULL,
  `customers` int(11) DEFAULT NULL,
  `suppliers` int(11) DEFAULT NULL,
  `employees` int(11) DEFAULT NULL,
  `employee_access` int(11) DEFAULT NULL,
  `-------------` varchar(20) NOT NULL DEFAULT '-------------',
  `sales_invoices` int(11) DEFAULT NULL,
  `sales_return` int(11) DEFAULT NULL,
  `purchase_invoices` int(11) DEFAULT NULL,
  `purchase_return` int(11) DEFAULT NULL,
  `expense` int(11) DEFAULT NULL,
  `payments` int(11) DEFAULT NULL,
  `journal_entries` int(11) DEFAULT NULL,
  `--` varchar(3) DEFAULT '--',
  `continent_name` varchar(15) DEFAULT NULL,
  `country_name` varchar(99) DEFAULT NULL,
  `country_code_iso` varchar(5) DEFAULT NULL,
  `region_name` varchar(99) DEFAULT NULL,
  `city` varchar(99) DEFAULT NULL,
  `--------` varchar(11) NOT NULL DEFAULT '-',
  `reach_counter` int(11) DEFAULT 0,
  `referby` varchar(99) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `timestamp`, `expiry`, `added_by`, `status`, `last_updated`, `ip`, `sync`, `source`, `---`, `industry_type`, `business_type`, `business_name`, `address`, `email`, `country_code`, `mobile`, `number`, `password`, `default_account_keys`, `currency`, `logo`, `----`, `gst`, `vat`, `negative`, `tax`, `lend_inventory`, `secondary_units`, `variants`, `barcode`, `smsnotification`, `salesman_commission`, `agent_commision`, `-------`, `print_header`, `print_urdu_invoice`, `print_header_note`, `print_footer_note`, `print_default_template`, `-----`, `type`, `date`, `coins`, `sms_credit`, `------`, `cohort`, `entries`, `active_days`, `login_count`, `------------`, `products`, `accounts`, `customers`, `suppliers`, `employees`, `employee_access`, `-------------`, `sales_invoices`, `sales_return`, `purchase_invoices`, `purchase_return`, `expense`, `payments`, `journal_entries`, `--`, `continent_name`, `country_name`, `country_code_iso`, `region_name`, `city`, `--------`, `reach_counter`, `referby`) VALUES
(1, 1760527011, 'NULL', 'web', 'Published', '1760539287', '102.85.27.65', '0', 'default', '---', 'Automobile', 'Retailer', 'MAJERA TRADERS', 'Edward Avenue', 'gtmajera@gmail.com', '+256', '759912814', '+256-759912814', '1b143a478d0c78841d403f51637c1cc3', '{\"cashonhand\":\"1\",\"expense\":\"2\",\"rnp\":\"3\",\"sales\":\"4\",\"tax\":\"5\",\"purchases\":\"6\",\"purchasediscount\":\"7\",\"salediscount\":\"8\",\"profitandlose\":\"9\",\"capital\":\"10\",\"inventory\":\"11\"}', 'Uganda Shi', NULL, '----', '0', '0', 'on', 'off', 'off', 'off', 'off', 'off', 'on', 'off', 'off', '-------', 'on', 'off', '', '', 'A4', '-----', 'sponsor', '2029-12-31', '50', '100', '------', '2025-42', 426, NULL, 22, '------------', NULL, NULL, NULL, NULL, NULL, NULL, '-------------', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '--', '', 'Uganda', '', 'Buganda', 'Masaka City', '-', 0, ''),
(2, 1760723838, 'NULL', 'web', 'Published', '1760723838', '223.123.7.120', '0', 'default', '---', 'Sports', 'Retailer', 'MF Cricket Gear ', NULL, 'Faizi4ud7@gmail.com', '+92', '3006677492', '+92-3006677492', '296239af85ea4ea88b0c7ef190f99738', '{\"cashonhand\":\"12\",\"expense\":\"13\",\"rnp\":\"14\",\"sales\":\"15\",\"tax\":\"16\",\"purchases\":\"17\",\"purchasediscount\":\"18\",\"salediscount\":\"19\",\"profitandlose\":\"20\",\"capital\":\"21\",\"inventory\":\"22\"}', 'Rs ', NULL, '----', '0', '0', 'on', 'off', 'off', 'off', 'off', 'off', 'on', 'off', 'off', '-------', 'on', 'off', NULL, NULL, 'A4', '-----', 'prepaid', 'NULL', '50', '100', '------', '2025-42', 0, NULL, 0, '------------', NULL, NULL, NULL, NULL, NULL, NULL, '-------------', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '--', '', '', '', '', '', '-', 0, ''),
(3, 1760742383, 'NULL', 'web', 'Published', '1760742383', '103.156.137.98', '0', 'default', '---', 'Hardware', 'Wholesaller', 'MJ TRADER ', NULL, 'ammarmoiz111@gmail.com', '+92', '3002564543', '+92-3002564543', '926654cea81bf20c1306fe9442a17651', '{\"cashonhand\":\"23\",\"expense\":\"24\",\"rnp\":\"25\",\"sales\":\"26\",\"tax\":\"27\",\"purchases\":\"28\",\"purchasediscount\":\"29\",\"salediscount\":\"30\",\"profitandlose\":\"31\",\"capital\":\"32\",\"inventory\":\"33\"}', 'Rs ', NULL, '----', '0', '0', 'on', 'off', 'off', 'off', 'off', 'off', 'on', 'off', 'off', '-------', 'on', 'off', NULL, NULL, 'A4', '-----', 'prepaid', 'NULL', '50', '100', '------', '2025-42', 0, NULL, 0, '------------', NULL, NULL, NULL, NULL, NULL, NULL, '-------------', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '--', '', '', '', '', '', '-', 0, ''),
(4, 1761397110, 'NULL', 'web', 'Published', '1764130725', '206.84.188.24', '0', 'default', '---', 'Textile', 'Manufacturer', 'Arshad and grandsons', '', 'asimarshid786@yahoo.com', '+92', '3335672555', '+92-3335672555', '4a68e6f7cc144930bc69c85af0ced0c9', '{\"cashonhand\":\"34\",\"expense\":\"35\",\"rnp\":\"36\",\"sales\":\"37\",\"tax\":\"38\",\"purchases\":\"39\",\"purchasediscount\":\"40\",\"salediscount\":\"41\",\"profitandlose\":\"42\",\"capital\":\"43\",\"inventory\":\"44\"}', 'Rs ', NULL, '----', '0', '0', 'on', 'off', 'off', 'off', 'off', 'off', 'on', 'off', 'on', '-------', 'on', 'off', '', '', 'A4', '-----', 'sponsor', '2029-12-31', '50', '100', '------', '2025-43', 7, NULL, 5, '------------', NULL, NULL, NULL, NULL, NULL, NULL, '-------------', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '--', '', 'pakistan', '', 'punjab', 'Faislabad', '-', 0, ''),
(5, 1763639536, 'NULL', 'web', 'Published', '1763639536', '175.157.154.83', '0', 'default', '---', 'Electronics', 'Wholesaller', 'Fastrun Technology', NULL, 'usbunlockcode@gmail.com', '+94', '773567467', '+94-773567467', '55009514b244e6dd09f715e54beffdbc', '{\"cashonhand\":\"45\",\"expense\":\"46\",\"rnp\":\"47\",\"sales\":\"48\",\"tax\":\"49\",\"purchases\":\"50\",\"purchasediscount\":\"51\",\"salediscount\":\"52\",\"profitandlose\":\"53\",\"capital\":\"54\",\"inventory\":\"55\"}', 'Rs ', NULL, '----', '0', '0', 'on', 'off', 'off', 'off', 'off', 'off', 'on', 'off', 'off', '-------', 'on', 'off', NULL, NULL, 'A4', '-----', 'prepaid', 'NULL', '50', '100', '------', '2025-47', 0, NULL, 0, '------------', NULL, NULL, NULL, NULL, NULL, NULL, '-------------', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '--', '', '', '', '', '', '-', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `token` varchar(99) DEFAULT NULL,
  `deviceID` text NOT NULL,
  `timestamp` varchar(30) DEFAULT NULL,
  `expiry` varchar(30) DEFAULT NULL,
  `access_logs` mediumtext DEFAULT NULL,
  `access_header` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_interaction`
--

CREATE TABLE `user_interaction` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `new_package` varchar(11) DEFAULT NULL,
  `amount` varchar(99) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `comment` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `va-jobs`
--

CREATE TABLE `va-jobs` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `name` varchar(99) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `tags` varchar(99) DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL,
  `----` varchar(5) NOT NULL DEFAULT '----',
  `start_date` varchar(20) DEFAULT NULL,
  `end_date` varchar(20) DEFAULT NULL,
  `input_items_json` text DEFAULT NULL,
  `input_expense_json` text DEFAULT NULL,
  `outpout_json` text DEFAULT NULL,
  `items_total_cost` varchar(20) DEFAULT NULL,
  `expense_total_cost` varchar(20) DEFAULT NULL,
  `total_input` varchar(20) DEFAULT NULL,
  `total_output` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `va-jobs`
--

INSERT INTO `va-jobs` (`id`, `owner_mobile`, `timestamp`, `added_by`, `status`, `last_updated`, `sync`, `---`, `name`, `number`, `description`, `tags`, `notes`, `----`, `start_date`, `end_date`, `input_items_json`, `input_expense_json`, `outpout_json`, `items_total_cost`, `expense_total_cost`, `total_input`, `total_output`) VALUES
(1, '+92-3335672555', 1764130765, '+92-3335672555', 'published', '1764130765', NULL, '---', 'Dbl BEdsheet', 'eman', '', '-,,-', '', '----', '2025-11-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `va-jobs_activites`
--

CREATE TABLE `va-jobs_activites` (
  `id` int(11) NOT NULL,
  `owner_mobile` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL,
  `added_by` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_updated` varchar(20) DEFAULT NULL,
  `sync` varchar(5) DEFAULT NULL,
  `---` varchar(5) NOT NULL DEFAULT '---',
  `job_id` int(11) DEFAULT NULL,
  `activity_name` varchar(99) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `total_item_input` varchar(20) DEFAULT NULL,
  `total_expense` varchar(20) DEFAULT NULL,
  `total_input` varchar(20) DEFAULT NULL,
  `total_item_output` varchar(20) DEFAULT NULL,
  `input_cartitems` text DEFAULT NULL,
  `expense_cartitems` text DEFAULT NULL,
  `output_cartitems` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `va-jobs_activites`
--

INSERT INTO `va-jobs_activites` (`id`, `owner_mobile`, `timestamp`, `added_by`, `status`, `last_updated`, `sync`, `---`, `job_id`, `activity_name`, `notes`, `date`, `total_item_input`, `total_expense`, `total_input`, `total_item_output`, `input_cartitems`, `expense_cartitems`, `output_cartitems`) VALUES
(1, '+92-3335672555', 1764131718, '+92-3335672555', NULL, '1764131718', NULL, '---', 1, 'Dbl BEdsheet', '', '2025-11-26', '1300.00', '150', '1450.00', '1450.00', '[{\"item_id\":\"398\",\"item_qty\":\"3.25\",\"item_rate\":\"400\",\"item_total\":\"1300\",\"variants_json\":\"]\"}]', '[{\"this_expense_amount\":\"150\",\"this_expense_type\":\"Others\",\"expense_payment_account\":\"34\",\"this_expense_des\":\"\",\"this_expense_type\":\"Others\"}]', '[{\"item_id\":\"399\",\"item_qty\":\"1\",\"item_rate\":\"1450\",\"item_total\":\"1450\",\"variants_json\":\"]\"}]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basic_fields`
--
ALTER TABLE `basic_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chartofaccount`
--
ALTER TABLE `chartofaccount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companyadmin`
--
ALTER TABLE `companyadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deviceList`
--
ALTER TABLE `deviceList`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dummy`
--
ALTER TABLE `dummy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_type`
--
ALTER TABLE `expense_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `graph`
--
ALTER TABLE `graph`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lend_inventory`
--
ALTER TABLE `lend_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paypal_payments`
--
ALTER TABLE `paypal_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_access`
--
ALTER TABLE `pos_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_measuring_calc`
--
ALTER TABLE `product_measuring_calc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_invoices`
--
ALTER TABLE `purchase_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_invoices_returns`
--
ALTER TABLE `purchase_invoices_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_invoices`
--
ALTER TABLE `sale_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_invoices_returns`
--
ALTER TABLE `sale_invoices_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_quotations`
--
ALTER TABLE `sale_quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_sale_history`
--
ALTER TABLE `services_sale_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_receipt_history`
--
ALTER TABLE `shipping_receipt_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_history`
--
ALTER TABLE `stock_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_transfer`
--
ALTER TABLE `stock_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_variant_history`
--
ALTER TABLE `stock_variant_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_cart_items`
--
ALTER TABLE `store_cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stripe_payments`
--
ALTER TABLE `stripe_payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_id` (`session_id`);

--
-- Indexes for table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_interaction`
--
ALTER TABLE `user_interaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `va-jobs`
--
ALTER TABLE `va-jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `va-jobs_activites`
--
ALTER TABLE `va-jobs_activites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `basic_fields`
--
ALTER TABLE `basic_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chartofaccount`
--
ALTER TABLE `chartofaccount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companyadmin`
--
ALTER TABLE `companyadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `deviceList`
--
ALTER TABLE `deviceList`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dummy`
--
ALTER TABLE `dummy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_type`
--
ALTER TABLE `expense_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `graph`
--
ALTER TABLE `graph`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=434;

--
-- AUTO_INCREMENT for table `journal_entries`
--
ALTER TABLE `journal_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=505;

--
-- AUTO_INCREMENT for table `lend_inventory`
--
ALTER TABLE `lend_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paypal_payments`
--
ALTER TABLE `paypal_payments`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_access`
--
ALTER TABLE `pos_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400;

--
-- AUTO_INCREMENT for table `product_measuring_calc`
--
ALTER TABLE `product_measuring_calc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_invoices`
--
ALTER TABLE `purchase_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_invoices_returns`
--
ALTER TABLE `purchase_invoices_returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_invoices`
--
ALTER TABLE `sale_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_invoices_returns`
--
ALTER TABLE `sale_invoices_returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_quotations`
--
ALTER TABLE `sale_quotations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services_sale_history`
--
ALTER TABLE `services_sale_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_receipt_history`
--
ALTER TABLE `shipping_receipt_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_history`
--
ALTER TABLE `stock_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;

--
-- AUTO_INCREMENT for table `stock_transfer`
--
ALTER TABLE `stock_transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_variant_history`
--
ALTER TABLE `stock_variant_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_cart_items`
--
ALTER TABLE `store_cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stripe_payments`
--
ALTER TABLE `stripe_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_interaction`
--
ALTER TABLE `user_interaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `va-jobs`
--
ALTER TABLE `va-jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `va-jobs_activites`
--
ALTER TABLE `va-jobs_activites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
