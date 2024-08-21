-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2024 at 05:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `B_id` int(11) NOT NULL,
  `B_name` varchar(255) NOT NULL,
  `B_address` varchar(255) DEFAULT NULL,
  `B_phone` varchar(255) DEFAULT NULL,
  `B_email` varchar(255) DEFAULT NULL,
  `Cust_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Cust_id` int(11) NOT NULL,
  `Cust_fname` varchar(255) NOT NULL,
  `Cust_lname` varchar(255) NOT NULL,
  `Cust_email` varchar(255) NOT NULL,
  `Cust_phone` varchar(255) NOT NULL,
  `Cust_address` text NOT NULL,
  `Cust_business` varchar(255) NOT NULL,
  `B_address` text NOT NULL,
  `B_industry` varchar(255) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` varchar(50) NOT NULL,
  `B_phone` varchar(255) NOT NULL,
  `B_email` varchar(255) NOT NULL,
  `createddate` datetime DEFAULT current_timestamp(),
  `updateddate` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `addedby` varchar(255) NOT NULL,
  `updatedby` varchar(255) NOT NULL,
  `Cust_status` varchar(255) DEFAULT 'added',
  `status` varchar(255) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Cust_id`, `Cust_fname`, `Cust_lname`, `Cust_email`, `Cust_phone`, `Cust_address`, `Cust_business`, `B_address`, `B_industry`, `state`, `country`, `zipcode`, `B_phone`, `B_email`, `createddate`, `updateddate`, `addedby`, `updatedby`, `Cust_status`, `status`) VALUES
(1, 'jacob', 'johnson', 'jacob@gmail.com', '+91 9188890592', 'k house,mambra thrissur', 'it company', 'info park ,kochi ', 'j companys', 'kerala', 'india', '680308', '+1 121-555-234', 'ggg@gmail.com', '2024-07-30 15:52:01', '2024-08-07 19:34:49', '10', '7', 'added', 'active'),
(5, 'a', 'b', 'aaa@gmail.com', '+54 123-456-789', 'kochi', 'sales', 'tvm', 'b-comp', 'kerala', 'india', '1234', '123', 'a@gmail.com', '2024-07-31 11:05:34', '2024-08-20 21:08:14', '7', '10', 'added', 'active'),
(13, 'johny', 'a', 'bbb@gmail.com', 'a', 'a', 'a', 'a', 'a', 'a', 'a', '123', 'a', 'bb@gmail.com', '2024-08-01 20:41:06', '2024-08-07 19:27:42', '7', '7', 'added', 'active'),
(17, 'John', 'Doe', 'john.doe@example.com', '123-456-7890', '123 Elm St', 'Tech Solutions', '456 Oak St', 'IT', 'CA', 'USA', '90001', '987-654-3210', 'business@example.com', '2024-08-20 20:59:32', NULL, '10', '10', 'added', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `uemail` varchar(255) NOT NULL,
  `upassword` varchar(255) NOT NULL,
  `urole` int(11) NOT NULL,
  `ustatus` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `uname`, `uemail`, `upassword`, `urole`, `ustatus`) VALUES
(2, 'h', 'h@gmail.com', '$2y$10$JGTYYaA8.CUu6TT3YwTQ9eRkpgY9/qY9gtRP8ps12BkqVZuPjmH0q', 1, 'active'),
(3, 'h22', 'h2@gmail.com', '$2y$10$zWr1Ju3u0xXXCncxD14Qf.Ex07v2q8IpkzaZCtpmGYucIdn6XwXB2', 1, 'inactive'),
(7, 'staff', 'staff@gmail.com', '$2y$10$gS6AEDymi3ZRf1E6NyhU3O.hqYI09YTnBlzJri2buwqmbNEV5an/S', 2, 'active'),
(10, 'jacob', 'jacob@gmail.com', '$2y$10$rtPusk61LEo0hZg/zSovXu5ZpsALO4nVX2LwoeUyJ8VPPrpotuQC6', 2, 'active'),
(11, 'admin', 'admin@gmail.com', '$2y$10$ykRpC1eKLwHDOJpUBXPOLuTDBj3W7VIc901mPMYKhGoguiqOG1pqu', 1, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`B_id`),
  ADD KEY `Cust_id` (`Cust_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Cust_id`),
  ADD UNIQUE KEY `Cust_email` (`Cust_email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `uemail` (`uemail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `business`
--
ALTER TABLE `business`
  ADD CONSTRAINT `business_ibfk_1` FOREIGN KEY (`Cust_id`) REFERENCES `customer` (`Cust_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
