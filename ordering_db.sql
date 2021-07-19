-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2021 at 08:08 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ordering_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `model_price_master`
--

CREATE TABLE `model_price_master` (
  `id` int(11) NOT NULL,
  `price` varchar(20) NOT NULL,
  `position_order` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model_price_master`
--

INSERT INTO `model_price_master` (`id`, `price`, `position_order`, `created_at`, `status`) VALUES
(1, '2', 6, '2021-06-27 14:00:54', 1),
(2, '2.5', 5, '2021-06-27 14:01:14', 1),
(3, '3.5', 2, '2021-06-27 14:01:22', 1),
(4, '4.5', 4, '2021-06-27 14:01:29', 1),
(5, '51', 1, '2021-06-27 14:27:49', 1),
(7, '4', 7, '2021-06-27 15:05:47', 1),
(8, '12', 3, '2021-07-18 05:03:43', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `model_price_master`
--
ALTER TABLE `model_price_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `model_price_master`
--
ALTER TABLE `model_price_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
