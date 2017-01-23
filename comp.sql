-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 23, 2017 at 10:41 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.13-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comp`
--

-- --------------------------------------------------------

--
-- Table structure for table `COMPANY`
--

CREATE TABLE `COMPANY` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `DATE_CREATED` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `COMPANY`
--

INSERT INTO `COMPANY` (`ID`, `NAME`, `DATE_CREATED`) VALUES
(39, 'Facebook', '2017-01-23'),
(38, 'Apple', '2017-01-23'),
(37, 'Canonical', '2017-01-23'),
(36, 'Ubuntu', '2017-01-23'),
(35, 'Aircel', '2017-01-23'),
(34, 'Idea', '2017-01-23'),
(33, 'Vodafone', '2017-01-23'),
(32, 'Airtel', '2017-01-23'),
(31, 'Reliance', '2017-01-23'),
(30, 'Aditya Birla Group', '2017-01-23'),
(29, 'Mahindra', '2017-01-23'),
(28, 'Paytm', '2017-01-23'),
(27, 'Paypal', '2017-01-23'),
(25, 'Microsoft', '2017-01-23'),
(24, 'Yahoo', '2017-01-23'),
(23, 'Google', '2017-01-23'),
(40, 'Avira', '2017-01-23'),
(41, 'Dell', '2017-01-23'),
(42, 'HP', '2017-01-23'),
(43, 'Asus', '2017-01-23'),
(44, 'Lenovo', '2017-01-23'),
(45, 'Samsung', '2017-01-23'),
(46, 'Motorola', '2017-01-23'),
(47, 'LG', '2017-01-23'),
(48, 'Twitter', '2017-01-23'),
(49, 'Wikipedia', '2017-01-23'),
(50, 'TATA', '2017-01-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `COMPANY`
--
ALTER TABLE `COMPANY`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `NAME` (`NAME`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `COMPANY`
--
ALTER TABLE `COMPANY`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
