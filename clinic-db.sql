-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 03, 2020 at 01:23 PM
-- Server version: 10.3.24-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `ra_complaint`
--

CREATE TABLE `ra_complaint` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `complaint` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `deleted_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_complaint`
--

INSERT INTO `ra_complaint` (`id`, `patient_id`, `complaint`, `created_date`, `updated_date`, `is_deleted`, `deleted_date`) VALUES
(1, 1, 'fever', '2020-04-29 09:52:19', '2020-04-29 09:52:19', '0', '0000-00-00 00:00:00'),
(2, 2, 'fever,cough ,sneezing', '2020-04-29 14:32:01', '2020-04-29 14:32:01', '0', '0000-00-00 00:00:00'),
(3, 3, 'Demo 4', '2020-05-01 07:09:00', '2020-05-01 07:09:00', '0', '0000-00-00 00:00:00'),
(4, 2, 'todya demo', '2020-05-09 09:12:19', '2020-05-09 09:12:19', '0', '0000-00-00 00:00:00'),
(5, 2, 'demo2', '2020-05-10 16:29:52', '2020-05-10 16:29:52', '0', '0000-00-00 00:00:00'),
(6, 2, 'demo 2', '2020-05-27 08:46:50', '2020-05-27 08:46:50', '0', '0000-00-00 00:00:00'),
(7, 2, 'something', '2020-06-03 13:43:10', '2020-06-03 13:43:10', '0', '0000-00-00 00:00:00'),
(8, 1, 'Jcjfjc', '2020-08-17 04:59:06', '2020-08-17 04:59:06', '0', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ra_diagnosis`
--

CREATE TABLE `ra_diagnosis` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_diagnosis`
--

INSERT INTO `ra_diagnosis` (`id`, `name`) VALUES
(1, 'mood disorder'),
(2, 'diahrrea'),
(3, 'diabetes'),
(4, 'chest pain'),
(5, 'demo'),
(6, 'demo1');

-- --------------------------------------------------------

--
-- Table structure for table `ra_diag_patient`
--

CREATE TABLE `ra_diag_patient` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` enum('0','1') NOT NULL,
  `deleted_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_diag_patient`
--

INSERT INTO `ra_diag_patient` (`id`, `patient_id`, `diagnosis`, `created_date`, `is_deleted`, `deleted_date`) VALUES
(1, 1, 'mood disorder', '2020-04-29 14:30:33', '0', '0000-00-00 00:00:00'),
(2, 2, 'diabetes', '2020-04-29 14:32:02', '0', '0000-00-00 00:00:00'),
(3, 3, 'demo', '2020-05-01 07:09:01', '0', '0000-00-00 00:00:00'),
(4, 2, 'diahrrea', '2020-05-09 09:12:20', '0', '0000-00-00 00:00:00'),
(5, 2, 'demo1', '2020-05-10 16:29:53', '1', '2020-05-27 08:47:05'),
(6, 2, 'diahrrea,chest pain', '2020-05-18 05:53:28', '0', '0000-00-00 00:00:00'),
(7, 2, 'diahrrea', '2020-05-27 08:46:50', '0', '0000-00-00 00:00:00'),
(8, 2, 'mood disorder,diabetes', '2020-06-03 13:43:10', '0', '0000-00-00 00:00:00'),
(9, 1, 'diabetes', '2020-08-17 04:59:06', '0', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ra_exa_patient`
--

CREATE TABLE `ra_exa_patient` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `s_bp` int(11) NOT NULL,
  `d_bp` int(11) NOT NULL,
  `pr` int(11) NOT NULL,
  `temp` int(11) NOT NULL,
  `spo2` int(11) NOT NULL,
  `rbs` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `height` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `bmi` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` enum('0','1') NOT NULL,
  `deleted_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_exa_patient`
--

INSERT INTO `ra_exa_patient` (`id`, `patient_id`, `s_bp`, `d_bp`, `pr`, `temp`, `spo2`, `rbs`, `weight`, `height`, `bmi`, `created_date`, `is_deleted`, `deleted_date`) VALUES
(1, 2, 120, 80, 80, 98, 0, 0, 130, '5', '25.4', '2020-04-29 14:32:01', '0', '0000-00-00 00:00:00'),
(2, 3, 120, 80, 80, 98, 100, 20, 90, '4.9', '18.3', '2020-05-01 07:09:02', '0', '0000-00-00 00:00:00'),
(3, 2, 110, 90, 80, 98, 90, 80, 80, '5', '15.6', '2020-05-09 09:12:21', '0', '0000-00-00 00:00:00'),
(4, 2, 120, 80, 80, 98, 90, 0, 0, '', '', '2020-05-10 16:29:53', '0', '0000-00-00 00:00:00'),
(5, 2, 110, 90, 90, 98, 120, 80, 90, '5', '17.6', '2020-05-18 05:53:29', '0', '0000-00-00 00:00:00'),
(6, 2, 110, 80, 0, 98, 0, 0, 0, '', '', '2020-05-27 08:46:50', '0', '0000-00-00 00:00:00'),
(7, 2, 110, 80, 0, 98, 0, 0, 0, '', '', '2020-06-03 13:43:10', '0', '0000-00-00 00:00:00'),
(8, 1, 110, 80, 80, 98, 70, 80, 120, '5', '23.4', '2020-08-17 04:59:06', '0', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ra_group`
--

CREATE TABLE `ra_group` (
  `id` int(11) NOT NULL,
  `groupname` varchar(255) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_group`
--

INSERT INTO `ra_group` (`id`, `groupname`, `permission`) VALUES
(1, 'Administrator', 'a:36:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:11:\"createBrand\";i:9;s:11:\"updateBrand\";i:10;s:9:\"viewBrand\";i:11;s:11:\"deleteBrand\";i:12;s:14:\"createCategory\";i:13;s:14:\"updateCategory\";i:14;s:12:\"viewCategory\";i:15;s:14:\"deleteCategory\";i:16;s:11:\"createStore\";i:17;s:11:\"updateStore\";i:18;s:9:\"viewStore\";i:19;s:11:\"deleteStore\";i:20;s:15:\"createAttribute\";i:21;s:15:\"updateAttribute\";i:22;s:13:\"viewAttribute\";i:23;s:15:\"deleteAttribute\";i:24;s:13:\"createProduct\";i:25;s:13:\"updateProduct\";i:26;s:11:\"viewProduct\";i:27;s:13:\"deleteProduct\";i:28;s:11:\"createOrder\";i:29;s:11:\"updateOrder\";i:30;s:9:\"viewOrder\";i:31;s:11:\"deleteOrder\";i:32;s:11:\"viewReports\";i:33;s:13:\"updateCompany\";i:34;s:11:\"viewProfile\";i:35;s:13:\"updateSetting\";}'),
(2, 'Clinic', 'a:19:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:13:\"createPatient\";i:9;s:13:\"updatePatient\";i:10;s:11:\"viewPatient\";i:11;s:13:\"deletePatient\";i:12;s:14:\"createPharmacy\";i:13;s:14:\"updatePharmacy\";i:14;s:12:\"viewPharmacy\";i:15;s:14:\"deletePharmacy\";i:16;s:11:\"viewReports\";i:17;s:11:\"viewProfile\";i:18;s:13:\"updateSetting\";}\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `ra_history`
--

CREATE TABLE `ra_history` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `history` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` enum('0','1') NOT NULL,
  `deleted_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_history`
--

INSERT INTO `ra_history` (`id`, `patient_id`, `history`, `created_date`, `is_deleted`, `deleted_date`) VALUES
(1, 2, 'demo', '2020-04-29 14:32:01', '0', '0000-00-00 00:00:00'),
(2, 3, 'Demo 4', '2020-05-01 07:09:02', '0', '0000-00-00 00:00:00'),
(3, 2, 'today demo history', '2020-05-09 09:12:20', '0', '0000-00-00 00:00:00'),
(4, 2, 'demo3', '2020-05-10 16:29:52', '0', '0000-00-00 00:00:00'),
(5, 2, 'this is history demo', '2020-05-18 05:53:28', '0', '0000-00-00 00:00:00'),
(6, 2, 'demo demo 3', '2020-05-27 08:46:50', '0', '0000-00-00 00:00:00'),
(7, 2, 'demo', '2020-06-03 13:43:10', '0', '0000-00-00 00:00:00'),
(8, 4, 'Head', '2020-06-08 04:13:08', '0', '0000-00-00 00:00:00'),
(9, 1, 'Hfjfj', '2020-08-17 04:59:06', '0', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ra_investigation`
--

CREATE TABLE `ra_investigation` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `investigation` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` enum('0','1') NOT NULL,
  `deleted_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ra_med_patient`
--

CREATE TABLE `ra_med_patient` (
  `med_patient_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `med_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `total_cost` int(11) NOT NULL,
  `highlighted` enum('0','1') NOT NULL,
  `assign_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_med_patient`
--

INSERT INTO `ra_med_patient` (`med_patient_id`, `patient_id`, `med_id`, `quantity`, `type`, `total_cost`, `highlighted`, `assign_date`) VALUES
(1, 2, 1, 5, 'Tabs', 15, '1', 1588170745),
(2, 2, 3, 1, 'Bot', 200, '1', 1588170745),
(3, 3, 4, 5, 'Tube', 3500, '1', 1588316957);

-- --------------------------------------------------------

--
-- Table structure for table `ra_patient`
--

CREATE TABLE `ra_patient` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `gender` tinyint(1) NOT NULL,
  `address` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_patient`
--

INSERT INTO `ra_patient` (`id`, `name`, `year`, `month`, `day`, `gender`, `address`, `created_date`, `updated_date`, `deleted_date`, `is_deleted`) VALUES
(1, 'Somone', 16, 0, 0, 1, 'No.180, demo', '2020-04-29 09:07:23', '2020-04-29 14:31:02', '0000-00-00 00:00:00', '0'),
(2, 'Patient 3', 5, 0, 0, 1, 'No.180, demo', '2020-04-29 14:31:25', '2020-04-29 14:31:25', '0000-00-00 00:00:00', '0'),
(3, 'Patient2', 40, 0, 0, 1, 'No.180, demo', '2020-05-01 07:07:47', '2020-06-03 13:45:27', '0000-00-00 00:00:00', '0'),
(4, 'Patient Name', 0, 0, 0, 1, 'Yangon', '2020-06-08 04:12:32', '2020-06-08 04:12:32', '0000-00-00 00:00:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `ra_patient_visit`
--

CREATE TABLE `ra_patient_visit` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `visited_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_patient_visit`
--

INSERT INTO `ra_patient_visit` (`id`, `patient_id`, `visited_date`) VALUES
(1, 1, '2020-04-29 14:30:33'),
(2, 2, '2020-04-29 14:32:01'),
(3, 3, '2020-05-01 07:09:01'),
(4, 2, '2020-05-09 09:12:20'),
(5, 2, '2020-05-10 16:29:53'),
(6, 2, '2020-05-18 05:53:28'),
(7, 2, '2020-05-27 08:46:50'),
(8, 2, '2020-06-03 13:43:10'),
(9, 4, '2020-06-08 04:13:08'),
(10, 4, '2020-06-08 04:13:52'),
(11, 1, '2020-08-17 04:59:06'),
(12, 1, '2020-08-17 04:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `ra_pharmacy`
--

CREATE TABLE `ra_pharmacy` (
  `id` int(100) NOT NULL,
  `medicine_name` varchar(100) NOT NULL,
  `quantity` int(10) NOT NULL,
  `tab_quantity` int(11) DEFAULT 0,
  `used_quantity` int(10) NOT NULL,
  `remain_quantity` int(10) NOT NULL,
  `remain_tab_quantity` int(11) DEFAULT 0,
  `register_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `sell_type` varchar(100) NOT NULL,
  `actual_price` int(10) NOT NULL,
  `selling_price` int(10) NOT NULL,
  `profit_price` varchar(255) NOT NULL,
  `tab_price` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `is_deleted` enum('1','0') NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_pharmacy`
--

INSERT INTO `ra_pharmacy` (`id`, `medicine_name`, `quantity`, `tab_quantity`, `used_quantity`, `remain_quantity`, `remain_tab_quantity`, `register_date`, `expire_date`, `description`, `sell_type`, `actual_price`, `selling_price`, `profit_price`, `tab_price`, `status`, `is_deleted`, `created_date`, `modified_date`, `deleted_date`) VALUES
(1, 'Medicin1', 100, 200, 1, 99, 19995, '2020-04-29', '2020-04-29', 'Adipisci nulla, nostra odit incidunt! Excepturi porta impedit eleifend, interdum porta.', 'Bot', 297, 600, '300(100%)', 3, '1', '0', '0000-00-00 00:00:00', '2020-06-28 11:52:22', NULL),
(2, 'Medicin 2', 200, 50, 0, 200, 10000, '2020-04-29', '2020-05-04', '', 'Bot', 50, 100, '50(100%)', 2, '1', '0', '2020-04-29 14:28:02', NULL, NULL),
(3, 'Medicine3', 100, 40, 1, 99, 3960, '2020-04-29', '2020-05-22', '', 'Bot', 20, 200, '180(900%)', 5, '1', '0', '2020-04-29 14:29:23', '2020-04-29 14:32:25', NULL),
(4, 'Medicine4', 120, 10, 5, 115, 1150, '2020-05-01', '2020-11-18', '', 'Tube', 400, 700, '300(75%)', 70, '1', '0', '2020-05-01 07:02:34', '2020-05-01 07:09:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ra_pres_patient`
--

CREATE TABLE `ra_pres_patient` (
  `pres_patient_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `pres_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `highlighted` enum('0','1') DEFAULT NULL,
  `assign_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ra_user`
--

CREATE TABLE `ra_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_user`
--

INSERT INTO `ra_user` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `phone`, `gender`) VALUES
(1, 'adminknst', '$2y$10$yfi5nUQGXUZtMdl27dWAyOd/jMOmATBpiUvJDmUu9hJ5Ro6BE5wsK', 'admin@admin.com', 'john', 'doe', '80789998', 0),
(2, 'admin', '$2y$10$NQqqebbQcvX/wzdziVNWn.P5BmwzKGqQd/yZ7WzzVdOWeyhmnSKNm', 'r@gmail.com', 'admin', 'admin', '3000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ra_usergroup`
--

CREATE TABLE `ra_usergroup` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_usergroup`
--

INSERT INTO `ra_usergroup` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ra_complaint`
--
ALTER TABLE `ra_complaint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ra_diagnosis`
--
ALTER TABLE `ra_diagnosis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ra_diag_patient`
--
ALTER TABLE `ra_diag_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ra_exa_patient`
--
ALTER TABLE `ra_exa_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ra_group`
--
ALTER TABLE `ra_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ra_history`
--
ALTER TABLE `ra_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ra_investigation`
--
ALTER TABLE `ra_investigation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ra_med_patient`
--
ALTER TABLE `ra_med_patient`
  ADD PRIMARY KEY (`med_patient_id`);

--
-- Indexes for table `ra_patient`
--
ALTER TABLE `ra_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ra_patient_visit`
--
ALTER TABLE `ra_patient_visit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ra_pharmacy`
--
ALTER TABLE `ra_pharmacy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ra_pres_patient`
--
ALTER TABLE `ra_pres_patient`
  ADD PRIMARY KEY (`pres_patient_id`);

--
-- Indexes for table `ra_user`
--
ALTER TABLE `ra_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ra_usergroup`
--
ALTER TABLE `ra_usergroup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ra_complaint`
--
ALTER TABLE `ra_complaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ra_diagnosis`
--
ALTER TABLE `ra_diagnosis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ra_diag_patient`
--
ALTER TABLE `ra_diag_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ra_exa_patient`
--
ALTER TABLE `ra_exa_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ra_group`
--
ALTER TABLE `ra_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ra_history`
--
ALTER TABLE `ra_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ra_investigation`
--
ALTER TABLE `ra_investigation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ra_med_patient`
--
ALTER TABLE `ra_med_patient`
  MODIFY `med_patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ra_patient`
--
ALTER TABLE `ra_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ra_patient_visit`
--
ALTER TABLE `ra_patient_visit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ra_pharmacy`
--
ALTER TABLE `ra_pharmacy`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ra_pres_patient`
--
ALTER TABLE `ra_pres_patient`
  MODIFY `pres_patient_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ra_user`
--
ALTER TABLE `ra_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ra_usergroup`
--
ALTER TABLE `ra_usergroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
