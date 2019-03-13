-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 12, 2018 at 12:18 PM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.2.7-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event`
--

-- --------------------------------------------------------

--
-- Table structure for table `activations`
--

CREATE TABLE `activations` (
  `id` int(10) UNSIGNED NOT NULL,
  `org_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(30) DEFAULT NULL,
  `sorted_code` varchar(30) DEFAULT NULL,
  `code_key` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `org_id` int(10) UNSIGNED NOT NULL,
  `cat_name` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `org_id`, `cat_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Endowment Fund', '2018-06-08 12:04:21', '2018-06-08 23:15:40'),
(2, 1, 'Graduation Ceremony', '2018-06-08 12:05:04', '2018-06-08 23:15:55'),
(3, 1, 'Anniversary', '2018-06-08 12:07:30', '2018-06-08 12:07:30'),
(4, 1, 'Wedding', '2018-06-08 13:27:57', '2018-06-08 13:27:57'),
(5, 2, 'Naming', '2018-06-08 13:29:15', '2018-06-08 13:29:15'),
(6, 1, 'Others', '2018-06-08 14:59:16', '2018-06-08 14:59:16'),
(7, 1, 'Fund', '2018-06-19 15:19:05', '2018-06-19 15:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `org_id` int(10) UNSIGNED NOT NULL,
  `cat_id` int(10) UNSIGNED NOT NULL,
  `evt_date` varchar(255) DEFAULT NULL,
  `evt_desc` varchar(100) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `org_id`, `cat_id`, `evt_date`, `evt_desc`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2018-06-30', 'For Orphanage', 5, 5, '2018-06-10 13:10:41', '2018-06-11 13:29:44'),
(2, 1, 4, '2018-06-07', 'Sydney and Dorcas', 6, 5, '2018-06-10 13:27:03', '2018-06-11 14:03:49'),
(3, 1, 4, '2018-06-12', 'Wisdom and Anita', 6, 5, '2018-06-10 13:28:13', '2018-06-11 13:04:32'),
(4, 1, 2, '2018-06-30', 'Sis Alice', 6, 6, '2018-06-10 13:31:11', '2018-06-10 13:31:11'),
(5, 1, 3, '2018-07-28', '10 year Church Anniversary', 5, 5, '2018-06-10 13:37:22', '2018-06-10 13:37:22'),
(6, 1, 6, '2018-09-27', 'Children&#039;s Chapel Building project', 5, 5, '2018-06-10 13:40:19', '2018-06-10 13:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `permissions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`, `description`, `permissions`) VALUES
(1, 'Lite', '  This is the light Version of the software.\r\nit has just feel modules', '{\"Category\":[\"*\"],\"Event\":[\"*\"],\"Payment\":[],\"User\":[],\"Feature\":[],\"Other\":[\"*\"]}'),
(2, 'Standard', ' standard all pages', '{\"Category\":[\"*\"],\"Event\":[\"*\"],\"Payment\":[\"*\"],\"User\":[],\"Feature\":[],\"Other\":null}'),
(3, 'Extra-Gold', ' This is the extra golden feature', '{\"Category\":[],\"Event\":[],\"Payment\":[\"*\"],\"User\":[],\"Feature\":[],\"Other\":[\"*\"]}'),
(4, 'Gold', ' This is the golden feature', '{\"Category\":[\"*\"],\"Event\":[\"*\"],\"Payment\":[],\"User\":[],\"Feature\":[],\"Other\":null}'),
(5, 'Silver', ' Silver Package', '{\"Category\":[],\"Event\":[],\"Payment\":[],\"User\":[\"*\"],\"Feature\":[],\"Other\":[\"*\"]}'),
(6, 'Platinum', ' Speacial and top package', '{\"Category\":[\"*\"],\"Event\":[],\"Payment\":[],\"User\":[],\"Feature\":[],\"Other\":null}'),
(7, 'Lite Plus', ' extra with lite', '{\"Category\":[],\"Event\":[\"*\"],\"Payment\":[\"*\"],\"User\":[],\"Feature\":[],\"Other\":null}'),
(8, 'Lite Plus', ' The extra was added to lite ', '{\"Category\":[],\"Event\":[],\"Payment\":[\"*\"],\"User\":[],\"Feature\":[],\"Other\":null}');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `org_id` int(10) UNSIGNED NOT NULL,
  `evt_id` int(10) UNSIGNED NOT NULL,
  `pay_by` varchar(30) DEFAULT 'Undisclosed',
  `amount` varchar(100) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `received_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `org_id`, `evt_id`, `pay_by`, `amount`, `phone`, `received_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Gabriel', '905.93', '0242037596', 5, 5, '2018-06-11 11:19:50', '2018-06-14 15:28:52'),
(2, 1, 1, 'Elisha', '2,900.00', '07037351836', 5, 5, '2018-06-11 11:52:44', '2018-06-11 17:19:38'),
(3, 1, 2, 'Akinniyi Boluwatife', '2,900.00', '0209430625', 5, 5, '2018-06-11 11:53:31', '2018-06-11 11:53:31'),
(4, 1, 1, 'Kehinde Jumoke', '5,800.00', '0874333333', 5, 5, '2018-06-11 18:56:40', '2018-06-11 18:57:17'),
(5, 1, 1, 'Undisclosed', '105.04', '', 5, 5, '2018-06-11 19:01:54', '2018-06-11 19:01:54'),
(6, 1, 1, 'Sydney Ankrah', '100.00', '0243383359', 5, 5, '2018-06-11 19:07:09', '2018-06-11 19:07:09'),
(7, 1, 1, 'Undisclosed', '815.00', '0209430625', 5, 5, '2018-06-14 16:06:46', '2018-06-14 16:06:46'),
(8, 1, 1, 'Undisclosed', '815.00', '0209430625', 5, 5, '2018-06-14 16:06:49', '2018-06-14 16:06:49'),
(9, 1, 1, 'Undisclosed', '815.00', '0209430625', 5, 5, '2018-06-14 16:06:59', '2018-06-14 16:06:59'),
(10, 1, 1, 'Beedy', '20.00', '0209430625', 5, 5, '2018-06-14 16:19:41', '2018-06-14 16:19:41'),
(11, 1, 1, 'Beedy', '20.00', '0209430625', 5, 5, '2018-06-14 16:20:18', '2018-06-14 16:20:18'),
(12, 1, 1, 'Beedy', '202.00', '0209430625,0558215892', 5, 5, '2018-06-14 16:21:11', '2018-06-14 16:21:11'),
(13, 1, 1, 'Beedy', '202.00', '0209430625,0558215892', 5, 5, '2018-06-14 16:23:50', '2018-06-14 16:23:50'),
(14, 1, 1, 'Beedy', '202.00', '0209430625,0558215892', 5, 5, '2018-06-14 16:24:19', '2018-06-14 16:24:19'),
(15, 1, 1, 'Beedy', '202.00', '0209430625,0558215892', 5, 5, '2018-06-14 16:25:06', '2018-06-14 16:25:06'),
(16, 1, 1, 'Beedy', '202.00', '0209430625,0558215892', 5, 5, '2018-06-14 16:28:44', '2018-06-14 16:28:44'),
(17, 1, 1, 'Beedy', '202.00', '0209430625,0558215892', 5, 5, '2018-06-14 16:38:54', '2018-06-14 16:38:54'),
(18, 1, 4, 'Elisha Endowed', '400.00', '02093475658', 5, 5, '2018-06-15 08:36:50', '2018-06-15 08:36:50'),
(19, 1, 4, 'wisdom', '500.00', '4678000', 5, 5, '2018-06-15 14:07:06', '2018-06-15 14:15:41');

--
-- Triggers `payments`
--
DELIMITER $$
CREATE TRIGGER `spyMan` AFTER INSERT ON `payments` FOR EACH ROW BEGIN 
    INSERT INTO payment_audit (org_id, evt_id, pay_by, amount, phone, received_by, created_at, tranType) 
    VALUES (NEW.org_id, NEW.evt_id, NEW.pay_by, NEW.amount, NEW.phone,NEW.received_by, NEW.created_at, 'Added' );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `spyTrigger` BEFORE UPDATE ON `payments` FOR EACH ROW BEGIN 
    INSERT INTO payment_audit (org_id, evt_id, pay_by, amount, phone, received_by, created_at, updated_by, updated_at, tranType) 
    VALUES (NEW.org_id, NEW.evt_id, NEW.pay_by, NEW.amount, NEW.phone,NEW.received_by, NEW.created_at, NEW.updated_by, NEW.updated_at, 'Updated' );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_audit`
--

CREATE TABLE `payment_audit` (
  `id` int(10) UNSIGNED NOT NULL,
  `org_id` int(10) UNSIGNED NOT NULL,
  `evt_id` int(10) UNSIGNED NOT NULL,
  `pay_by` varchar(30) DEFAULT 'Undisclosed',
  `amount` varchar(100) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `received_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tranType` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_audit`
--

INSERT INTO `payment_audit` (`id`, `org_id`, `evt_id`, `pay_by`, `amount`, `phone`, `received_by`, `updated_by`, `created_at`, `updated_at`, `tranType`) VALUES
(1, 1, 4, 'Elisha Endowed', '400.00', '02093475658', 5, NULL, '2018-06-15 08:36:50', NULL, NULL),
(2, 1, 4, 'wisdom', '400.00', '4678000', 5, NULL, '2018-06-15 14:07:06', NULL, 'Added'),
(4, 1, 4, 'wisdom', '500.00', '4678000', 5, 5, '2018-06-15 14:07:06', '2018-06-15 14:15:41', 'Updated');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `org_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `permissions` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `org_id`, `name`, `description`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super Admin', '        Has access to virtually everything on the system', '{\"Category\":[\"*\"],\"Event\":[\"*\"],\"Payment\":[\"*\"],\"User\":[\"*\"],\"Role\":[\"*\"],\"Other\":[\"*\"]}', '2018-06-09 23:28:04', '2018-06-14 13:46:29'),
(3, 1, 'Editor', '    Just view and Edit processes', '{\"Category\":[\"r\",\"u\",\"d\"],\"Event\":[\"r\",\"u\",\"d\"],\"Payment\":[\"r\",\"u\",\"d\"],\"User\":[\"r\",\"u\",\"d\"],\"Role\":[\"r\",\"u\"],\"Other\":null}', '2018-06-10 00:54:11', '2018-06-14 11:33:51'),
(4, 1, 'Support', '        Help with editing but not all part of the software ', '{\"Category\":[\"r\",\"u\"],\"Event\":[\"r\",\"u\"],\"Payment\":[\"r\",\"u\"],\"User\":[\"c\"],\"Role\":[\"r\"],\"Other\":null}', '2018-06-12 08:14:14', '2018-06-14 11:49:02'),
(6, 1, 'Evaluator', 'Evaluates Software', '{\"Category\":[\"*\"],\"Event\":[\"*\"],\"Payment\":[\"*\"],\"User\":[\"*\"],\"Role\":[\"*\"],\"Other\":[\"*\"]}', '2018-06-14 13:44:28', '2018-06-14 13:44:28');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `org_id` int(10) UNSIGNED NOT NULL,
  `pageCount` int(11) DEFAULT '5',
  `allow_sms` varchar(255) NOT NULL DEFAULT 'NO',
  `sms_body` varchar(255) DEFAULT NULL,
  `sms_credit` varchar(255) DEFAULT NULL,
  `sms_allowed` varchar(255) DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `org_id`, `pageCount`, `allow_sms`, `sms_body`, `sms_credit`, `sms_allowed`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'NO', NULL, NULL, '5', NULL, '2018-06-14 11:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `softwares`
--

CREATE TABLE `softwares` (
  `id` int(10) UNSIGNED NOT NULL,
  `fid` int(10) UNSIGNED NOT NULL,
  `org_name` varchar(50) NOT NULL,
  `org_address` varchar(100) DEFAULT NULL,
  `org_num` varchar(30) DEFAULT NULL,
  `org_email` varchar(50) NOT NULL,
  `org_logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `softwares`
--

INSERT INTO `softwares` (`id`, `fid`, `org_name`, `org_address`, `org_num`, `org_email`, `org_logo`, `created_at`, `updated_at`) VALUES
(1, 3, 'Beedy International Incorporation', 'Snit Flat, Dansoman, Acca, Ghana      ', '0209430625', 'boladebode@gmail.com', NULL, '2018-06-03 22:48:12', '2018-06-14 15:45:30'),
(2, 2, 'CedarCliff Services', ' Lagos', '0703903703', 'cedarcliff@gmail.com', NULL, '2018-06-03 22:51:39', '2018-06-03 22:51:39'),
(3, 1, 'Avalanche Services', ' No 3, Kobiowu Crescent, Iyaganku GRA, Ibadan', '08085858585', 'avalanche@gmail.com', NULL, '2018-06-03 22:52:56', '2018-06-03 22:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `org_id` int(10) UNSIGNED NOT NULL,
  `rid` int(10) UNSIGNED NOT NULL,
  `acc_first_name` varchar(20) NOT NULL,
  `acc_last_name` varchar(20) NOT NULL,
  `acc_phone` varchar(255) DEFAULT NULL,
  `acc_email` varchar(30) NOT NULL,
  `acc_password` text NOT NULL,
  `acc_password_box` varchar(255) DEFAULT NULL,
  `acc_status` enum('Active','Banned','Pending') DEFAULT 'Active',
  `remember_token` varchar(100) DEFAULT NULL,
  `acc_question` varchar(30) DEFAULT NULL,
  `acc_answer` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `org_id`, `rid`, `acc_first_name`, `acc_last_name`, `acc_phone`, `acc_email`, `acc_password`, `acc_password_box`, `acc_status`, `remember_token`, `acc_question`, `acc_answer`, `created_at`, `updated_at`) VALUES
(5, 1, 1, 'Akinniyi', 'Bolade', '0209430625', 'boladebode@gmail.com', '$2y$10$Tvw529TaH98kAjM3rGvOreHCVyj6XayEkETeLqZRj4xRSt6a5lOHS', 'Salvation91#', 'Active', NULL, 'boo&#039;s name', 'damilola	 \r\n', '2018-06-01 05:12:00', '2018-06-14 05:09:31'),
(6, 1, 1, 'Kehinde', 'Damilola', NULL, 'kaydee@gmail.com', '$2y$10$qGL.U1atJDLSLmbilnWXiu4NRthtNm5IMP5usqgYjTS6ISupIZrE2', NULL, 'Banned', NULL, NULL, NULL, '2018-06-01 05:12:00', '2018-06-13 21:42:07'),
(10, 1, 3, 'Asuquo', 'Glory', '0705544171', 'glory@gmail.com', '$2y$10$uhE3vY1hK.qaGc6dGK8Gp.Z/uHCH6U5CeDPjTRJBV3SvI6ATKwKKq', NULL, 'Active', NULL, NULL, NULL, '2018-06-12 20:52:38', '2018-06-13 21:42:08'),
(11, 1, 4, 'Precious', 'Araba', '020229430648', 'araba1234@yahoo.com', '$2y$10$Z0HmC4UqKt.l5YmEhKT6W.y0qF5yrGoDoQfQrwhq68O3xt8Y8rvNa', NULL, 'Active', NULL, 'My Nickname', 'Beedy	 \r\n	 \r\n	 \r\n	 \r\n', '2018-06-12 20:54:16', '2018-06-14 05:10:48'),
(12, 1, 3, 'Robert', 'Bazuku', NULL, 'robert@gmail.com', '$2y$10$ORWiFf2me/Rahv1e4Dp91OdCkndxkynNy/7BtQz2.zlgBhl1yI3LG', NULL, 'Banned', NULL, NULL, NULL, '2018-06-13 07:46:41', '2018-06-13 21:16:14'),
(13, 1, 4, 'Danny', 'Green', NULL, 'dannygreen@hotmail.com', '$2y$10$aL.SdPPO3ECCBjqdx9.nHehv2mtWtEWLXblnEQprtiiJ0Ovo.OQsC', NULL, 'Active', NULL, NULL, NULL, '2018-06-13 21:01:57', '2018-06-13 21:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `usersessions`
--

CREATE TABLE `usersessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersessions`
--

INSERT INTO `usersessions` (`id`, `user_id`, `session`, `user_agent`) VALUES
(32, 5, 'e2ef524fbf3d9fe611d5a8e90fefdc9c', 'Mozilla (X11; Linux x86_64) AppleWebKit (KHTML, like Gecko) Ubuntu Chromium Chrome Safari');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activations`
--
ALTER TABLE `activations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activations_org_id_index` (`org_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_org_id_index` (`org_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_org_id_index` (`org_id`),
  ADD KEY `events_cat_id_index` (`cat_id`),
  ADD KEY `events_created_by_index` (`created_by`),
  ADD KEY `events_updated_by_index` (`updated_by`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_org_id_index` (`org_id`),
  ADD KEY `payments_evt_id_index` (`evt_id`),
  ADD KEY `payments_received_by_index` (`received_by`),
  ADD KEY `payments_updated_by_index` (`updated_by`);

--
-- Indexes for table `payment_audit`
--
ALTER TABLE `payment_audit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_org_id_index` (`org_id`),
  ADD KEY `payments_evt_id_index` (`evt_id`),
  ADD KEY `payments_received_by_index` (`received_by`),
  ADD KEY `payments_updated_by_index` (`updated_by`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_role_id_index` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_org_id_index` (`org_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_org_id_index` (`org_id`),
  ADD KEY `settings_updated_by_index` (`updated_by`);

--
-- Indexes for table `softwares`
--
ALTER TABLE `softwares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `software_fid_index` (`fid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_org_id_index` (`org_id`),
  ADD KEY `users_pid_index` (`rid`);

--
-- Indexes for table `usersessions`
--
ALTER TABLE `usersessions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activations`
--
ALTER TABLE `activations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `payment_audit`
--
ALTER TABLE `payment_audit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `softwares`
--
ALTER TABLE `softwares`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `usersessions`
--
ALTER TABLE `usersessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `activations`
--
ALTER TABLE `activations`
  ADD CONSTRAINT `activations_org_id_foreign` FOREIGN KEY (`org_id`) REFERENCES `softwares` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_org_id_foreign` FOREIGN KEY (`org_id`) REFERENCES `softwares` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_org_id_foreign` FOREIGN KEY (`org_id`) REFERENCES `softwares` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_evt_id_foreign` FOREIGN KEY (`evt_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_org_id_foreign` FOREIGN KEY (`org_id`) REFERENCES `softwares` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_received_by_foreign` FOREIGN KEY (`received_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_org_id_foreign` FOREIGN KEY (`org_id`) REFERENCES `softwares` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_org_id_foreign` FOREIGN KEY (`org_id`) REFERENCES `softwares` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `settings_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `softwares`
--
ALTER TABLE `softwares`
  ADD CONSTRAINT `software_fid_foreign` FOREIGN KEY (`fid`) REFERENCES `features` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_org_id_foreign` FOREIGN KEY (`org_id`) REFERENCES `softwares` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_pid_foreign` FOREIGN KEY (`rid`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
