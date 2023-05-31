-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 04:50 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` int(11) NOT NULL,
  `Todo_name` varchar(255) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `Todo_Date` date NOT NULL,
  `Todo_status` varchar(255) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `Todo_name`, `user_ID`, `Todo_Date`, `Todo_status`, `date_added`) VALUES
(1, 'Washing Dishes', 785835699, '2023-05-31', 'FINISHED', '2023-05-27'),
(2, 'Cleaning Bathroom', 785835699, '2023-05-31', 'FINISHED', '2023-05-27'),
(3, 'Cleaning Computer Set', 1066444932, '2023-05-28', 'FINISHED', '2023-05-27'),
(4, 'Cooked Adobo', 1066444932, '2023-05-27', 'FINISHED', '2023-05-27'),
(5, 'Deploy Inventory Management System', 785835699, '2023-05-31', 'FINISHED', '2023-05-29'),
(6, 'Update Reflective Journal', 785835699, '2023-05-29', 'FINISHED', '2023-05-29'),
(7, 'Kakain', 785835699, '0000-00-00', 'FINISHED', '2023-05-30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`) VALUES
(1, 785835699, 'Jonas Isaiah', 'Mulingbayan', 'jonasmulingbayan@gmail.com', '1bbd886460827015e5d605ed44252251', '1685022745jonas2by2.png', 'Active now'),
(2, 1066444932, 'Ivy', 'Lachica', 'jonasipm29@gmail.com', '1bbd886460827015e5d605ed44252251', '1685022824IvySolo.jpg', 'Offline now');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
