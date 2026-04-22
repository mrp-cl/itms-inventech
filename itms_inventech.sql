-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2026 at 04:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itms_inventech`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `user_id`, `type`, `description`) VALUES
(1, 16, '', ''),
(2, 17, 'Desktop', 'for gaming'),
(3, 17, '', ''),
(4, 18, '', ''),
(6, 20, 'laptop', ''),
(7, 23, 'Desktop', ''),
(8, 23, 'Laptop', ''),
(9, 24, 'Desktop', ''),
(10, 25, 'laptop', ''),
(11, 25, '', ''),
(12, 25, '', ''),
(13, 26, 'samplengani', ''),
(14, 27, 'laptop', ''),
(15, 28, 'lappy', ''),
(16, 29, '', ''),
(17, 29, '', ''),
(18, 30, 'sample', ''),
(19, 31, 'sadsad', ''),
(23, 35, '', ''),
(29, 41, '', ''),
(30, 42, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `link`) VALUES
(1, 'ARMD', 'armd.php'),
(2, 'SMD', 'smd.php'),
(3, 'ITSD', 'itsd.php'),
(4, 'ITPMD', 'itpmd.php'),
(5, 'DMD', 'dmd.php'),
(6, 'PTD', 'ptd.php'),
(7, 'HRD', 'hrd.php');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('superadmin','admin','user') DEFAULT NULL,
  `division` varchar(50) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `division`, `status`) VALUES
(3, 'superadmin@itms.com', '$2y$10$/dEY75WFU71Dw.k9fYvw.uVoBGfjzlwUVT.tVD4CFaRMuOFLwDU46', 'superadmin', 'MAIN', 'active'),
(4, 'admin@itms.com', '$2y$10$/dEY75WFU71Dw.k9fYvw.uVoBGfjzlwUVT.tVD4CFaRMuOFLwDU46', 'admin', 'ARMD', 'active'),
(13, 'admin2@itms.com', '$2y$10$cWlBumjxFKkjbF9FL/N.Fux1hcE9l4JujfcGdFi7wpHEH1z4qy/Py', 'admin', 'ITSD', 'active'),
(16, 'useritsd3', '$2y$10$nItQ5Sa/oUCqwjrUGgaZY.yX.7TgRZT5zvmKkDBshp7VOLF9XYcQW', 'user', 'ITSD', 'inactive'),
(17, 'useritsd3', '$2y$10$DgjFHqU6cKXE2ksXqagl3.o8cvzwKUOuG3uq2Nj3LgxxZkJIG1/iW', 'user', 'ITSD', 'inactive'),
(18, 'useritsd4@itms.com', '$2y$10$SsEKxbmzkCsA5wYmngSdS.L5DorMOOYRDTJaqhXTjsGazRrzyi.sa', 'user', 'ITSD', 'inactive'),
(20, 'userarmd5@itms', '$2y$10$IeKTtT8t8v4dsyndYRVF3OV1Z1Dir0q5lRfIrPOfF/4ZJGpcSyKqq', 'user', 'ARMD', 'inactive'),
(21, 'mark@itms.com', '$2y$10$HSliIA0ybnaX7qq2QYxA4.EBkfiav9miNDu/1hlGzbjDODmqhGQVC', 'admin', 'DMD', 'active'),
(22, 'mark@itms.com', '$2y$10$HSliIA0ybnaX7qq2QYxA4.EBkfiav9miNDu/1hlGzbjDODmqhGQVC', 'admin', 'DMD', 'active'),
(23, 'dmdmark@itms.com', '$2y$10$7e4FWaIjGiqbYaeXQJrKV..JrdQugDn500cU8udMRgQ1/8BjdXJpi', 'user', 'DMD', 'active'),
(24, 'dmdmarky@itms.com', '$2y$10$WSwrKovHpANKOObLiSsNnezBQGhGMcmaAFzfig1PixkZ2QiRuScke', 'user', 'DMD', 'active'),
(25, 'useritsd5@itms.com', '$2y$10$PXV4Xc.PvUE1rl.e3tysOevqYcee2fkJbVCo2FPeZfjgHc1BGPwSK', 'user', 'ITSD', 'inactive'),
(26, 'useritsd6@itms.com', '$2y$10$qsZ3YVFFXuWLvtlyXojsM.LsMsznQp1JBL6.ybNeW7jArxqzVw.8u', 'user', 'ITSD', 'inactive'),
(27, 'useritsd7@itms.com', '$2y$10$bmTgavcNurwYsePHPerMq.c1e8CKTuZCBUHVEsscpdV6SfCJJy1s2', 'user', 'ITSD', 'inactive'),
(28, 'useritsd8@itms.com', '$2y$10$btG.cmd8K80yTsg30kogNOo7vSZx2Pq92UP.l1EeuZUo3xOBU0ruG', 'user', 'ITSD', 'inactive'),
(29, 'useritsd10@itms.com', '$2y$10$h.FMyY64MZa30PnHPfZA.uhUiHiPhFOysCh9V7RzxcDOxQB5kmul6', 'user', 'ITSD', 'inactive'),
(30, 'useritsd11@itms.com', '$2y$10$7Sim6xl5hR.3Kv8kXrZ4MOEkQOeCOj4XksD/ipl33UB3nVVuRwFi6', 'user', 'ITSD', 'inactive'),
(31, 'user12@itms.com', '$2y$10$1IIX4huXZvp2Xe2V7Hw7LO/6j7rBvO1loQcWGyK2FzuYIHa0CeEuC', 'user', 'ITSD', 'inactive'),
(35, 'diaz@itms.com', '$2y$10$XKsvf/IMrAA6zatN6UhLYe4X.vK5YxZ1Z7h9Q1W0FKiS5YbQff3bC', 'user', 'ITSD', 'inactive'),
(41, 'user15@itms.com', '$2y$10$lANgT2zG621EoNONTJ./YuktB6Yl6HQNa9udgvbwpQNz7muoCf1dy', 'user', 'ITSD', 'inactive'),
(42, 'user51@itms.com', '$2y$10$FKdFxzZiwR4dHQk5HEQv6etn9MlMxv6KzAXaxzuIXje/mMQqQNiK.', 'user', 'ITSD', 'inactive'),
(51, 'mark03@itms.com', '$2y$10$.Cn6/WQATa/2NkhuHrmtIuyRUYx8lOhLm9vTdHs/Q1okW/GVJcDN2', 'user', 'ITSD', 'active'),
(52, 'brandon17@itms.com', '$2y$10$241.T0hACRnVOBvAaKj/remsNZS9a4GocFXHJb1mRDXZDGGy3XHJa', 'user', 'ITSD', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
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
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `devices_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
