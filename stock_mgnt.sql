-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2022 at 06:55 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock_mgnt`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ab` ()  BEGIN
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `item_master`
--

CREATE TABLE `item_master` (
  `id` int(11) NOT NULL,
  `dt` varchar(50) DEFAULT '0',
  `itemnm` varchar(200) DEFAULT '0',
  `hsn` varchar(50) DEFAULT '0',
  `rate` varchar(50) DEFAULT '0',
  `image` varchar(100) DEFAULT '0',
  `sts` int(4) DEFAULT 0,
  `edt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_master`
--

INSERT INTO `item_master` (`id`, `dt`, `itemnm`, `hsn`, `rate`, `image`, `sts`, `edt`) VALUES
(29, '2021-06-24', 'FERESH WATER', '2020', '5000', '0', 0, '2021-06-24 14:59:33'),
(30, '2021-06-24', 'NORMAL WATER ', '2021', '9000', '0', 0, '2021-06-24 14:59:47'),
(31, '2021-06-25', 'PURE WATER', '2022', '9000', '0', 0, '2021-06-25 15:12:30'),
(32, '2021-06-27', 'M-PURE RO', '2023', '0', '0', 0, '2021-06-27 14:05:19'),
(33, '2021-06-30', 'LG', 'UT069', '0', '0', 0, '2021-06-30 05:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `login_tbl`
--

CREATE TABLE `login_tbl` (
  `id` int(11) NOT NULL,
  `uname` varchar(100) DEFAULT '0',
  `mobile` varchar(50) DEFAULT '0',
  `emailId` varchar(50) DEFAULT '0',
  `pwd` varchar(50) DEFAULT '0',
  `sts` int(4) DEFAULT 0,
  `edt` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_tbl`
--

INSERT INTO `login_tbl` (`id`, `uname`, `mobile`, `emailId`, `pwd`, `sts`, `edt`) VALUES
(1, 'admin', '73385111284', 'avinashudata52@gmail.com', '0101', 0, '2021-06-25 15:11:11'),
(7, 'Avinash Udata', '7385111284', 'aviudata3010@gmail.com', 'Pass123', 0, '2022-08-15 10:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `party_details`
--

CREATE TABLE `party_details` (
  `id` int(11) NOT NULL,
  `company_nm` varchar(100) DEFAULT '0',
  `mobile` varchar(50) DEFAULT '0',
  `adrs` varchar(500) DEFAULT '0',
  `email` varchar(50) DEFAULT '0',
  `gst_no` varchar(30) DEFAULT '0',
  `state` varchar(50) DEFAULT '0',
  `city_pin` varchar(10) DEFAULT '0',
  `sts` int(4) DEFAULT 0,
  `edt` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `party_details`
--

INSERT INTO `party_details` (`id`, `company_nm`, `mobile`, `adrs`, `email`, `gst_no`, `state`, `city_pin`, `sts`, `edt`) VALUES
(11, 'BLUEWELL', '7798320468', 'MIDC SOLAPUR', 'bluewelll30@gmail.com', '202122', '1', '413005', 0, '2021-06-24 15:01:41'),
(12, 'URBANSKILL', '9890117602', 'SAIFUL SOLAPUR', 'admin@gmail.com', '202123', '2', '513006', 0, '2021-06-24 15:20:41'),
(13, 'BLUESTAR', '9970825000', 'NEW RAMVADI SOLAPUR', '1star@gmail.com', '202125', '1', '413008', 0, '2021-06-25 15:14:56'),
(14, '1XRUBIX', '8857958475', '170 STREET, MUMBAI', 'princeyuvraj181@gmail.com', '5848', '1', '243133', 0, '2021-06-30 05:40:36');

-- --------------------------------------------------------

--
-- Table structure for table `puchase_entry_info`
--

CREATE TABLE `puchase_entry_info` (
  `id` int(11) NOT NULL,
  `lastId` varchar(50) DEFAULT '0',
  `hsc_code` varchar(50) DEFAULT '0',
  `item_nm` varchar(500) DEFAULT '0',
  `rate` varchar(20) DEFAULT '0',
  `qty` varchar(20) DEFAULT '0',
  `total` varchar(20) DEFAULT '0',
  `edt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `puchase_entry_info`
--

INSERT INTO `puchase_entry_info` (`id`, `lastId`, `hsc_code`, `item_nm`, `rate`, `qty`, `total`, `edt`) VALUES
(27, '21', '2020', '29', '1500', '2', '3000', '2021-06-24 15:08:59'),
(28, '22', 'UT004', '31', '7500', '2', '15000', '2021-06-25 15:17:13'),
(29, '23', '2023', '32', '10000', '10', '100000', '2021-06-30 05:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_entry`
--

CREATE TABLE `purchase_entry` (
  `id` int(11) NOT NULL,
  `party_id` varchar(100) DEFAULT '0',
  `bill_no` varchar(50) DEFAULT '0',
  `date` varchar(50) DEFAULT '0',
  `purchase_type` int(4) DEFAULT 0,
  `gst_type` int(4) DEFAULT 0,
  `total` varchar(100) DEFAULT '0',
  `discount_type` int(4) DEFAULT 0,
  `discnt_amt_per` varchar(100) DEFAULT '0',
  `dis_total` varchar(50) DEFAULT '0',
  `sgst` varchar(20) DEFAULT '0',
  `cgst` varchar(20) DEFAULT '0',
  `igst` varchar(20) DEFAULT '0',
  `grand_tot` varchar(20) DEFAULT '0',
  `pay_bill_amt` int(4) DEFAULT 0,
  `payamt` varchar(30) DEFAULT '0',
  `balamt` varchar(30) DEFAULT '0',
  `stock_sts` int(4) DEFAULT 0,
  `sts` int(4) DEFAULT 0,
  `edt` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_entry`
--

INSERT INTO `purchase_entry` (`id`, `party_id`, `bill_no`, `date`, `purchase_type`, `gst_type`, `total`, `discount_type`, `discnt_amt_per`, `dis_total`, `sgst`, `cgst`, `igst`, `grand_tot`, `pay_bill_amt`, `payamt`, `balamt`, `stock_sts`, `sts`, `edt`) VALUES
(21, '12', '1123', '2021-06-24', 2, 4, '3000', 0, '0', '0', '0', '0', '0', '3000', 2, '0', '3000', 1, 0, '2021-06-24 15:08:58'),
(22, '12', '103', '2021-06-25', 2, 4, '15000', 0, '0', '0', '0', '0', '0', '15000', 1, '5000', '10000', 1, 0, '2021-06-25 15:17:13'),
(23, '12', '14', '2021-06-30', 1, 2, '100000', 0, '1000', '1000', '5940.00', '5940.00', '0', '110880', 1, '11080', '99800', 0, 0, '2021-06-30 05:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_outstanding`
--

CREATE TABLE `purchase_outstanding` (
  `id` int(11) NOT NULL,
  `purchase_id` int(50) DEFAULT 0,
  `receipt_no` varchar(50) DEFAULT '0',
  `bill_no` varchar(50) DEFAULT '0',
  `date` varchar(50) DEFAULT '0',
  `grand_tot` varchar(50) DEFAULT '0',
  `paid_amt` varchar(50) DEFAULT '0',
  `bal_amt` varchar(50) DEFAULT '0',
  `edt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_outstanding`
--

INSERT INTO `purchase_outstanding` (`id`, `purchase_id`, `receipt_no`, `bill_no`, `date`, `grand_tot`, `paid_amt`, `bal_amt`, `edt`) VALUES
(23, 21, '1', '1123', '2021-06-24', '3000', '0', '3000', '2021-06-24 15:08:59'),
(24, 22, '24', '103', '2021-06-25', '15000', '5000', '10000', '2021-06-25 15:17:13'),
(25, 21, '25', '1123', '2021-06-25', '3000', '1500', '1500', '2021-06-25 15:19:46'),
(26, 21, '26', '1123', '2021-06-25', '3000', '200', '1300', '2021-06-25 15:20:38'),
(27, 23, '27', '14', '2021-06-30', '110880', '11080', '99800', '2021-06-30 05:44:25'),
(28, 23, '28', '14', '2021-06-30', '110880', '800', '99000', '2021-06-30 05:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_party_details`
--

CREATE TABLE `purchase_party_details` (
  `id` int(11) NOT NULL,
  `company_nm` varchar(100) DEFAULT '0',
  `mobile` varchar(50) DEFAULT '0',
  `adrs` varchar(500) DEFAULT '0',
  `email` varchar(50) DEFAULT '0',
  `gst_no` varchar(30) DEFAULT '0',
  `state` int(4) DEFAULT 0,
  `city_pin` varchar(10) DEFAULT '0',
  `sts` int(4) DEFAULT 0,
  `edt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_party_details`
--

INSERT INTO `purchase_party_details` (`id`, `company_nm`, `mobile`, `adrs`, `email`, `gst_no`, `state`, `city_pin`, `sts`, `edt`) VALUES
(12, 'HELLO AUQA', '9890117602', 'SHIVAJI NAGAR PUNE.', 'helloaqua2000@gmail.com', '202123', 1, '413008', 0, '2021-06-24 15:06:59'),
(13, 'RO CARE ', '8921354700', 'KHARADI PUNE.', 'ro@gmail.com', '202124', 1, '413005', 0, '2021-06-24 15:18:30');

-- --------------------------------------------------------

--
-- Table structure for table `sale_billno`
--

CREATE TABLE `sale_billno` (
  `id` int(11) NOT NULL,
  `bill_no` varchar(30) DEFAULT '0',
  `edt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale_billno`
--

INSERT INTO `sale_billno` (`id`, `bill_no`, `edt`) VALUES
(14, 'US00001', '2021-06-24 15:12:26'),
(15, 'US00015', '2021-06-24 15:25:16'),
(16, 'US00016', '2021-06-27 14:58:51');

-- --------------------------------------------------------

--
-- Table structure for table `sale_entry`
--

CREATE TABLE `sale_entry` (
  `id` int(11) NOT NULL,
  `party_id` varchar(100) DEFAULT '0',
  `bill_no` varchar(50) DEFAULT '0',
  `date` varchar(50) DEFAULT '0',
  `sale_type` int(4) DEFAULT 0,
  `gst_type` int(4) DEFAULT 0,
  `total` varchar(100) DEFAULT '0',
  `discount_type` int(4) DEFAULT 0,
  `discnt_amt_per` varchar(100) DEFAULT '0',
  `dis_total` varchar(50) DEFAULT '0',
  `sgst` varchar(20) DEFAULT '0',
  `cgst` varchar(20) DEFAULT '0',
  `igst` varchar(20) DEFAULT '0',
  `grand_tot` varchar(20) DEFAULT '0',
  `pay_bill_amt` int(4) DEFAULT 0,
  `payamt` varchar(30) DEFAULT '0',
  `balamt` varchar(30) DEFAULT '0',
  `sts` int(4) DEFAULT 0,
  `edt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale_entry`
--

INSERT INTO `sale_entry` (`id`, `party_id`, `bill_no`, `date`, `sale_type`, `gst_type`, `total`, `discount_type`, `discnt_amt_per`, `dis_total`, `sgst`, `cgst`, `igst`, `grand_tot`, `pay_bill_amt`, `payamt`, `balamt`, `sts`, `edt`) VALUES
(14, '11', 'US00001', '2021-06-24', 1, 1, '5000', 0, '0', '0', '450.00', '450.00', '0', '5900', 2, '0', '5900', 0, '2021-06-24 15:12:26'),
(15, '12', 'US00015', '2021-06-24', 1, 2, '5000', 0, '0', '0', '0', '0', '600.00', '5600', 2, '0', '0', 0, '2021-06-24 15:25:16'),
(16, '11', 'US00016', '2021-06-27', 1, 2, '9000', 0, '0', '0', '540.00', '540.00', '0', '10080', 1, '5000', '5080', 0, '2021-06-27 14:58:51');

-- --------------------------------------------------------

--
-- Table structure for table `sale_entry_info`
--

CREATE TABLE `sale_entry_info` (
  `id` int(11) NOT NULL,
  `lastId` varchar(50) DEFAULT '0',
  `hsc_code` varchar(50) DEFAULT '0',
  `item_nm` varchar(500) DEFAULT '0',
  `stock_qty` varchar(20) DEFAULT '0',
  `qty` varchar(20) DEFAULT '0',
  `rate` varchar(20) DEFAULT '0',
  `total` varchar(50) NOT NULL DEFAULT '0',
  `edt` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale_entry_info`
--

INSERT INTO `sale_entry_info` (`id`, `lastId`, `hsc_code`, `item_nm`, `stock_qty`, `qty`, `rate`, `total`, `edt`) VALUES
(18, '14', '2020', '29', '2', '1', '5000', '5000', '2021-06-24 15:12:26'),
(19, '15', '2020', '29', '1', '1', '5000', '5000', '2021-06-24 15:25:16'),
(20, '16', '2022', '31', '2', '1', '9000', '9000', '2021-06-27 14:58:51');

-- --------------------------------------------------------

--
-- Table structure for table `sale_outstanding`
--

CREATE TABLE `sale_outstanding` (
  `id` int(11) NOT NULL,
  `sale_id` int(50) DEFAULT 0,
  `receipt_no` varchar(50) DEFAULT '0',
  `bill_no` varchar(50) DEFAULT '0',
  `date` varchar(50) DEFAULT '0',
  `grand_tot` varchar(50) DEFAULT '0',
  `paid_amt` varchar(50) DEFAULT '0',
  `bal_amt` varchar(50) DEFAULT '0',
  `edt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale_outstanding`
--

INSERT INTO `sale_outstanding` (`id`, `sale_id`, `receipt_no`, `bill_no`, `date`, `grand_tot`, `paid_amt`, `bal_amt`, `edt`) VALUES
(22, 14, '1', 'US00001', '2021-06-24', '5900', '0', '5900', '2021-06-24 15:12:26'),
(23, 15, '23', 'US00015', '2021-06-24', '5600', '0', '0', '2021-06-24 15:25:16'),
(24, 16, '24', 'US00016', '2021-06-27', '10080', '5000', '5080', '2021-06-27 14:58:51');

-- --------------------------------------------------------

--
-- Table structure for table `stock_info`
--

CREATE TABLE `stock_info` (
  `id` int(11) NOT NULL,
  `lastId` varchar(20) DEFAULT '0',
  `item` varchar(50) DEFAULT '0',
  `qty` varchar(50) DEFAULT '0',
  `p_rate` varchar(50) DEFAULT '0',
  `p_total` varchar(50) NOT NULL DEFAULT '0',
  `s_rate` varchar(50) DEFAULT '0',
  `s_total` varchar(50) DEFAULT '0',
  `edt` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_info`
--

INSERT INTO `stock_info` (`id`, `lastId`, `item`, `qty`, `p_rate`, `p_total`, `s_rate`, `s_total`, `edt`) VALUES
(24, '20', '29', '2', '1500', '3000', '5000', '10000', '2021-06-24 15:10:52'),
(25, '21', '31', '2', '7500', '15000', '9000', '18000', '2021-06-27 14:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `stock_maintain`
--

CREATE TABLE `stock_maintain` (
  `id` int(11) NOT NULL,
  `dt` varchar(50) DEFAULT '0',
  `itemId` varchar(100) DEFAULT '0',
  `sale_rate` varchar(50) DEFAULT '0',
  `rate` varchar(50) DEFAULT '0',
  `qty` varchar(50) DEFAULT '0',
  `bal` varchar(50) DEFAULT '0',
  `edt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_maintain`
--

INSERT INTO `stock_maintain` (`id`, `dt`, `itemId`, `sale_rate`, `rate`, `qty`, `bal`, `edt`) VALUES
(15, '2021-06-24', '29', '5000', '1500', '0', '2', '2021-06-24 15:10:52'),
(16, '2021-06-27', '31', '9000', '7500', '1', '2', '2021-06-27 14:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `stock_master`
--

CREATE TABLE `stock_master` (
  `id` int(11) NOT NULL,
  `dt` varchar(50) DEFAULT '0',
  `purchase_invoice` varchar(100) DEFAULT '0',
  `edt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_master`
--

INSERT INTO `stock_master` (`id`, `dt`, `purchase_invoice`, `edt`) VALUES
(20, '2021-06-24', '21', '2021-06-24 15:10:52'),
(21, '2021-06-27', '22', '2021-06-27 14:05:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_master`
--
ALTER TABLE `item_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_tbl`
--
ALTER TABLE `login_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `party_details`
--
ALTER TABLE `party_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `puchase_entry_info`
--
ALTER TABLE `puchase_entry_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_entry`
--
ALTER TABLE `purchase_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_outstanding`
--
ALTER TABLE `purchase_outstanding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_party_details`
--
ALTER TABLE `purchase_party_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_billno`
--
ALTER TABLE `sale_billno`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_entry`
--
ALTER TABLE `sale_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_entry_info`
--
ALTER TABLE `sale_entry_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_outstanding`
--
ALTER TABLE `sale_outstanding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_info`
--
ALTER TABLE `stock_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_maintain`
--
ALTER TABLE `stock_maintain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_master`
--
ALTER TABLE `stock_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_master`
--
ALTER TABLE `item_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `login_tbl`
--
ALTER TABLE `login_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `party_details`
--
ALTER TABLE `party_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `puchase_entry_info`
--
ALTER TABLE `puchase_entry_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `purchase_entry`
--
ALTER TABLE `purchase_entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `purchase_outstanding`
--
ALTER TABLE `purchase_outstanding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `purchase_party_details`
--
ALTER TABLE `purchase_party_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sale_billno`
--
ALTER TABLE `sale_billno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sale_entry`
--
ALTER TABLE `sale_entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sale_entry_info`
--
ALTER TABLE `sale_entry_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sale_outstanding`
--
ALTER TABLE `sale_outstanding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `stock_info`
--
ALTER TABLE `stock_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `stock_maintain`
--
ALTER TABLE `stock_maintain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `stock_master`
--
ALTER TABLE `stock_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
