-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2019 at 06:55 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tel_the_cloud`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(10) UNSIGNED NOT NULL,
  `contact_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_address` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_name`, `contact_address`, `contact_phone`) VALUES
(13, NULL, NULL, NULL),
(14, NULL, NULL, NULL),
(15, NULL, NULL, NULL),
(16, 'S Roy', 'https://roytuts.com', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(12) NOT NULL,
  `contact_name` varchar(30) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `phone_type` text,
  `groups` text,
  `userId` int(11) NOT NULL,
  `date_added` varchar(40) NOT NULL DEFAULT 'CURDATE()'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `contact_name`, `phone_number`, `phone_type`, `groups`, `userId`, `date_added`) VALUES
(1, 'komuntu oscar', '0783765634', 'mobile', 'family', 1, '0000-00-00'),
(2, 'Kisembo Julio', '0783786544', 'office', 'family', 2, 'CURDATE'),
(3, 'Christopher Data analyst', '0774 764522', 'office', 'family', 3, 'CURDATE()'),
(4, 'Nikitta Violah', '0702675432', 'mobile', 'work', 1, 'CURDATE()');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'System Administrator'),
(2, 'Manager'),
(3, 'Employee'),
(4, 'other user');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `email` varchar(128) DEFAULT NULL COMMENT 'login email',
  `password` varchar(128) DEFAULT NULL COMMENT 'hashed login password',
  `uniqueId` varchar(6) NOT NULL,
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `mobile` varchar(20) DEFAULT NULL,
  `phone_mac_addr` varchar(50) DEFAULT NULL,
  `roleId` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) DEFAULT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `password`, `uniqueId`, `name`, `mobile`, `phone_mac_addr`, `roleId`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'admin@eco2016.org', '$2y$10$IUgslf6w8YBoxkHVDMzrMe8gOdomUJxbgOiczytzeEpo/cc0Ltbt.', 'AB65', 'Komuntu Oscar', '9890098900', '', 1, 0, 0, '2015-07-01 18:56:49', 1, '2018-07-24 11:16:46'),
(2, 'manager@bewithdhanu.in', '$2y$10$Gkl9ILEdGNoTIV9w/xpf3.mSKs0LB1jkvvPKK7K0PSYDsQY7GE9JK', '', 'Kizito Tom', '9890098901', '', 2, 0, 1, '2016-12-09 17:49:56', 1, '2018-07-24 10:59:34'),
(3, 'employee@bewithdhanu.in', '$2y$10$MB5NIu8i28XtMCnuExyFB.Ao1OXSteNpCiZSiaMSRPQx1F1WLRId2', '', 'Diana Dee', '9890098900', '', 3, 0, 1, '2016-12-09 17:50:22', 1, '2018-06-05 10:47:06'),
(4, 'samuelk@gmail.com', '$2y$10$NynAidMI7s0Dc5d6SSntFercSRk48o7wkxUuwgFzgqk5.uWcvjRri', '', 'Katuramu Samuel', '0773787621', '', 8, 0, 1, '2018-07-24 11:10:58', NULL, NULL),
(5, 'abc@xyz.com', '$2y$10$evNVGY1aXJfQvEAHsT7wkOp5A.MIcrHQEfbBXpX35KLUfyVhpwrb.', '', 'Balyesima Thomas', '0775910305', '', 2, 0, 1, '2018-07-31 11:58:26', NULL, NULL),
(6, 'm.nico99@gmail.com', '$2y$10$szkgcxjGj7jW9Wbw10qrS.x1hsE80GAoNR3wsR0UwZxdsXmTINskS', '', 'Mugisha Nicholas', '0782024533', '', 2, 0, 1, '2018-07-31 12:02:58', NULL, NULL),
(7, 'mbabaziinnocent192@gmail.com', '$2y$10$g3PpA6g/hMwRDfKX9rTnB.xGu3UzPGs1/GUllZCcTikoafk3vF/Nq', '', 'Mbabazi Innocent', '0783243076', '', 2, 0, 1, '2018-07-31 12:06:58', NULL, NULL),
(8, 'ajunamargret@gmail.com', '$2y$10$ZN87M329AgFkSTF4kOW4r.y7HS5S9M/TzrHOz9kiFJd77L9iCUy.a', '', 'Ajuna Margret', '0782044454', '', 6, 0, 7, '2018-07-31 12:18:14', NULL, NULL),
(9, 'sophilynbaby@gmail.com', '$2y$10$rMfPDRsX/Q7NKw7udUYTl.sLSIg5PKAi1sxaY5jBLixnaSLnpbee2', '', 'Masika Sophia', '0777763321', '', 8, 0, 7, '2018-07-31 12:21:18', NULL, NULL),
(10, 'abamwitirebye21@gmail.com', '$2y$10$ARa0RonXXde/aFWojV4MyuU.jONAVHz7hA0By7Yd/yNHdquzhLthq', '', 'Bamwitirebye Abraham', '0771365058', '', 7, 0, 7, '2018-07-31 12:24:30', NULL, NULL),
(11, 'kisembotm@yahoo.com', '$2y$10$rz4i5rBUur/2GM6h6IHH1.vgw/vI53dptl.E4XNtHuKv6caJPQqN.', '', 'Kisembo Richard', '0777529003', '', 6, 0, 7, '2018-07-31 12:32:38', NULL, NULL),
(12, 'komuntuoscar@gmail.com', '$2y$10$2BJw3bMRAANF/FzAk5XH.u4JFdfcAy09N6GHXwK6XE2C0/.yixJ4m', '', 'Komuntu Oscar', '0783765634', '', 6, 0, 1, '2018-08-13 01:06:09', NULL, NULL),
(14, 'ko@gmail.com', '$2y$10$YnUoC8Ln14dKTyZfsrGozeYU3ATnG153BKhR8SUskKtmoG1SVXG.W', '', 'oscr', '0783765634', '', 4, 0, 0, '2019-08-25 13:43:03', NULL, '2019-08-25 13:43:03'),
(15, 'ko1@gmail.com', '$2y$10$xA0MvvyqJnb1gZ1LPWqsdeXN9jPDkT6uSeGEZa7qNwWgIr9DGkHMK', '', 'oscarostest', '0783765634', '', 4, 0, 0, '2019-08-25 13:56:29', NULL, '2019-08-25 13:56:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_contacts_userid` (`userId`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `FK_tbl_users_tbl_roles_roleId` (`roleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `fk_contacts_tbl_users` FOREIGN KEY (`userId`) REFERENCES `tbl_users` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `FK_tbl_users_tbl_roles_roleId` FOREIGN KEY (`roleId`) REFERENCES `tbl_roles` (`roleId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
