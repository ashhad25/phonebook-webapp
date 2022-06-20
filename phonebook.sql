-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2022 at 07:07 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phonebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactdetails`
--

CREATE TABLE `contactdetails` (
  `contact_id` int(11) NOT NULL COMMENT 'Primary Key',
  `contact_name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactdetails`
--

INSERT INTO `contactdetails` (`contact_id`, `contact_name`, `designation`, `phone`, `address`, `user_id`) VALUES
(11, 'kamlash', 'Teacher', '03568975', 'szabist', 1),
(10, 'Maham', 'Mentor', '0985622232', 'karachi pakistan', 1),
(8, 'Rafay', 'Professor', '03322600884', 'karachi Sindh', 1),
(9, 'Muzammil', 'Teacher', '336987546', 'qasimabad', 1),
(12, 'Madani', 'Professor', '0963522353', 'qasimabad', 1),
(13, 'Sidhu', 'Mentor', '033658975', 'Qasimabad', 2),
(14, 'Asfand', 'Student', '09685674', 'Lahore', 2),
(15, 'Wasiq', 'Student', '096856324', 'Karachi johar', 2),
(16, 'Dr. Amir Liaqat', 'Anchor', '0968457321', 'Unknown ', 2);

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `user_id` int(11) NOT NULL COMMENT 'Primary Key',
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`user_id`, `name`, `username`, `email`, `password`) VALUES
(1, 'wasay', 'wasay11', 'shaikhwasay300@gmail.com', 'shaikh.11'),
(2, 'ashhad', 'ashhad119', 'ashhad53@gmail.com', 'shaikh.11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactdetails`
--
ALTER TABLE `contactdetails`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactdetails`
--
ALTER TABLE `contactdetails`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
