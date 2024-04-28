-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2022 at 08:59 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intendance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `it_data`
--

CREATE TABLE `it_data` (
  `id` int(30) NOT NULL,
  `project_id` int(30) NOT NULL,
  `task` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `it_rating` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `it_data`
--

INSERT INTO `it_data` (`id`, `project_id`, `task`, `description`, `status`, `date_created`, `it_rating`) VALUES
(2, 5, 'Project 4 Task 1', 'P4T1	', 2, '2022-03-23 15:58:38', 0),
(3, 5, 'Project 4 Task 2', 'XYZ	', 1, '2022-03-23 15:59:00', 0),
(4, 5, 'Project 4 Task 0', 'Done				', 3, '2022-03-23 15:59:15', 0),
(5, 4, 'Demo ', '				1234			', 2, '2022-03-23 18:37:19', 0),
(6, 3, 'Demo Task 3', '												Check Save.											', 1, '2022-03-23 21:09:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tp_data`
--

CREATE TABLE `tp_data` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` int(2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `manager_id` int(30) NOT NULL,
  `user_ids` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `tp_rating` int(10) DEFAULT NULL,
  `user_names` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tp_data`
--

INSERT INTO `tp_data` (`id`, `name`, `description`, `status`, `start_date`, `end_date`, `manager_id`, `user_ids`, `date_created`, `tp_rating`, `user_names`) VALUES
(2, 'Demo Project 1', '												Demo project 1 Completed.																			', 5, '2022-03-01', '2022-03-12', 8, '12', '2022-03-23 15:32:04', 50, ''),
(3, 'Demo Project 1', '																														Demo Pending Project 1.																									', 3, '2022-03-01', '2022-03-24', 11, '12,13', '2022-03-23 15:49:36', 0, ''),
(4, 'Demo Project 2', 'Demo project yet to start.', 0, '2022-03-24', '2022-03-27', 8, '13', '2022-03-23 15:51:33', 0, ''),
(5, 'Demo project 4', '												Will start..										', 0, '0000-00-00', '0000-00-00', 11, '12', '2022-03-23 15:57:48', 0, ''),
(8, 'Sample', 'Saved successfully..', 3, '2022-03-23', '2022-03-31', 11, '12,13', '2022-03-23 21:07:00', 0, ''),
(9, 'lmcv', '																													fm															', 3, '2022-03-31', '2022-04-08', 11, '12,13', '2022-03-25 01:14:55', 0, ''),
(10, 'ldskn', '																							sldknv										', 3, '2022-03-25', '2022-03-31', 11, '13', '2022-03-25 14:16:42', NULL, ''),
(11, 'dfnv', '											', 0, '0000-00-00', '0000-00-00', 8, '13', '2022-03-25 14:38:15', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` int(1) NOT NULL DEFAULT 2,
  `code` int(50) NOT NULL,
  `status` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `type`, `code`, `status`, `date_created`) VALUES
(1, 'Admin', 'First', 'hillpatel1357@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 290001, '0', '2020-11-26 10:57:04'),
(8, 'Abhishek', 'Mehra', 'abhishek.m@mail.com', '25d55ad283aa400af464c76d713c07ad', 2, 0, '0', '2022-03-19 21:22:42'),
(11, 'John', 'Doe', 'john.doe@mail.com', '25d55ad283aa400af464c76d713c07ad', 2, 0, '0', '2022-03-23 12:46:05'),
(12, 'Arjun', 'More', 'arjun.m@mail.com', '25d55ad283aa400af464c76d713c07ad', 3, 0, '0', '2022-03-23 15:43:27'),
(13, 'Rahul', 'Sharma', 'rahul.s@mail.com', '25d55ad283aa400af464c76d713c07ad', 3, 0, '0', '2022-03-23 15:45:59'),
(19, 'gs', 'dfh', 'g.dame0102@gmail.com', 'cb8b2723cb54e67cd19398e1c38d3c26', 1, 746337, '', '2022-03-25 16:56:58'),
(23, 'another', 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '', '2022-03-26 00:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `usr_activity`
--

CREATE TABLE `usr_activity` (
  `id` int(30) NOT NULL,
  `project_id` int(30) NOT NULL,
  `task_id` int(30) NOT NULL,
  `comment` text NOT NULL,
  `subject` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `user_id` int(30) NOT NULL,
  `time_rendered` float NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usr_activity`
--

INSERT INTO `usr_activity` (`id`, `project_id`, `task_id`, `comment`, `subject`, `date`, `start_time`, `end_time`, `user_id`, `time_rendered`, `date_created`) VALUES
(1, 4, 5, '																										', 'ABC', '2022-03-23', '18:39:00', '22:43:00', 1, 4.06667, '2022-03-23 18:39:12'),
(3, 3, 6, '			nsdksndksjdksn kjn knk 										', 'Analysis', '2022-03-25', '23:18:00', '13:18:00', 1, -10, '2022-03-25 23:18:25'),
(4, 3, 6, '30% done till XYZ.												', 'Designing', '0000-00-00', '00:00:00', '00:00:00', 1, 0, '2022-03-26 01:19:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `it_data`
--
ALTER TABLE `it_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_data`
--
ALTER TABLE `tp_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usr_activity`
--
ALTER TABLE `usr_activity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `it_data`
--
ALTER TABLE `it_data`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tp_data`
--
ALTER TABLE `tp_data`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `usr_activity`
--
ALTER TABLE `usr_activity`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
