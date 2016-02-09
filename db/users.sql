-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2016 at 07:23 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fit4you`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `parentId` int(11) DEFAULT NULL,
  `client_id` varchar(25) DEFAULT NULL,
  `role` varchar(25) NOT NULL,
  `regisNo` varchar(50) DEFAULT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(25) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `is_present_client` int(1) DEFAULT NULL,
  `userPin` varchar(25) NOT NULL,
  `join_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `is_login` int(1) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `is_deleted` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `parentId`, `client_id`, `role`, `regisNo`, `username`, `password`, `firstName`, `lastName`, `email`, `phone`, `city`, `address`, `state`, `zip`, `start_time`, `end_time`, `photo`, `is_present_client`, `userPin`, `join_date`, `update_date`, `is_login`, `is_active`, `is_deleted`, `status`) VALUES
(1, 0, '0', 'CLIENT', '', 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Adam', 'Smith', NULL, NULL, 'Manhattan', '', 'NY', '32145', '2016-01-01 00:00:00', '2016-12-01 00:00:00', '', 1, '1234', '0000-00-00 00:00:00', '2016-02-07 00:00:00', 0, 1, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
