-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2020 at 02:53 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website_parser`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_category`
--

CREATE TABLE `company_category` (
  `cc_id` int(11) NOT NULL,
  `field1` varchar(255) NOT NULL,
  `field2` varchar(255) NOT NULL,
  `field3` varchar(255) NOT NULL,
  `field4` varchar(255) NOT NULL,
  `field5` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `cd_id` int(11) NOT NULL,
  `field1` varchar(255) NOT NULL,
  `field2` varchar(255) NOT NULL,
  `field3` varchar(255) NOT NULL,
  `field4` varchar(255) NOT NULL,
  `field5` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_list`
--

CREATE TABLE `company_list` (
  `c_id` int(11) NOT NULL,
  `field1` varchar(255) NOT NULL,
  `field2` varchar(255) NOT NULL,
  `field3` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_list`
--

INSERT INTO `company_list` (`c_id`, `field1`, `field2`, `field3`, `added_on`) VALUES
(1, 'http://www.mycorporateinfo.com/industry/section/A', 'Agriculture, forestry and fishing', '', '2020-06-26 12:51:24'),
(2, 'http://www.mycorporateinfo.com/industry/section/B', 'Mining and quarrying', '', '2020-06-26 12:51:24'),
(3, 'http://www.mycorporateinfo.com/industry/section/C', 'Manufacturing', '', '2020-06-26 12:51:24'),
(4, 'http://www.mycorporateinfo.com/industry/section/D', 'Electricity, gas, steam and air conditioning supply', '', '2020-06-26 12:51:24'),
(5, 'http://www.mycorporateinfo.com/industry/section/E', 'Water supply; sewerage, waste management and remediation activities', '', '2020-06-26 12:51:24'),
(6, 'http://www.mycorporateinfo.com/industry/section/F', 'Construction', '', '2020-06-26 12:51:24'),
(7, 'http://www.mycorporateinfo.com/industry/section/G', 'Wholesale and retail trade; repair of motor vehicles and motorcycles', '', '2020-06-26 12:51:24'),
(8, 'http://www.mycorporateinfo.com/industry/section/H', 'Transportation and storage', '', '2020-06-26 12:51:24'),
(9, 'http://www.mycorporateinfo.com/industry/section/I', 'Accommodation and Food service activities', '', '2020-06-26 12:51:24'),
(10, 'http://www.mycorporateinfo.com/industry/section/J', 'Information and communication', '', '2020-06-26 12:51:24'),
(11, 'http://www.mycorporateinfo.com/industry/section/K', 'Financial and insurance activities', '', '2020-06-26 12:51:24'),
(12, 'http://www.mycorporateinfo.com/industry/section/L', 'Real estate activities', '', '2020-06-26 12:51:24'),
(13, 'http://www.mycorporateinfo.com/industry/section/M', 'Professional, scientific and technical activities', '', '2020-06-26 12:51:24'),
(14, 'http://www.mycorporateinfo.com/industry/section/N', 'Administrative and support service activities', '', '2020-06-26 12:51:24'),
(15, 'http://www.mycorporateinfo.com/industry/section/O', 'Public administration and defence; compulsory social security', '', '2020-06-26 12:51:24'),
(16, 'http://www.mycorporateinfo.com/industry/section/P', 'Education', '', '2020-06-26 12:51:24'),
(17, 'http://www.mycorporateinfo.com/industry/section/Q', 'Human health and social work activities', '', '2020-06-26 12:51:24'),
(18, 'http://www.mycorporateinfo.com/industry/section/J', 'Information and communication', '', '2020-06-26 12:51:24'),
(19, 'http://www.mycorporateinfo.com/industry/section/M', 'Professional, scientific and technical activities', '', '2020-06-26 12:51:24'),
(20, 'http://www.mycorporateinfo.com/industry/section/L', 'Real estate activities', '', '2020-06-26 12:51:25'),
(21, 'http://www.mycorporateinfo.com/industry/section/O', 'Public administration and defence; compulsory social security', '', '2020-06-26 12:51:25'),
(22, 'http://www.mycorporateinfo.com/industry/section/N', 'Administrative and support service activities', '', '2020-06-26 12:51:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_category`
--
ALTER TABLE `company_category`
  ADD PRIMARY KEY (`cc_id`);

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`cd_id`);

--
-- Indexes for table `company_list`
--
ALTER TABLE `company_list`
  ADD PRIMARY KEY (`c_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_category`
--
ALTER TABLE `company_category`
  MODIFY `cc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_details`
--
ALTER TABLE `company_details`
  MODIFY `cd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_list`
--
ALTER TABLE `company_list`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
