-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 04, 2021 at 06:56 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `whma`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `D_ID` int(11) DEFAULT NULL,
  `U_ID` int(11) DEFAULT NULL,
  `A_Date` varchar(255) DEFAULT NULL,
  `A_Time` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Doctor FK` (`D_ID`),
  KEY `User FK` (`U_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`ID`, `D_ID`, `U_ID`, `A_Date`, `A_Time`, `status`) VALUES
(74, 1, 13, '2021-02-21', '9:00 AM - 9:30 AM', 'Cancelled'),
(75, 1, 13, '2021-02-21', '9:00 AM - 9:30 AM', 'Cancelled'),
(76, 1, 13, '2021-02-21', '9:00 AM - 9:30 AM', 'Completed'),
(77, 2, 13, '2021-02-21', '9:00 AM - 9:30 AM', 'Cancelled'),
(78, 2, 13, '2021-02-21', '9:00 AM - 9:30 AM', 'Cancelled'),
(79, 2, 13, '2021-02-21', '10:00 AM - 10:30 AM', 'Cancelled'),
(80, 1, 13, '2021-02-21', '9:30 AM - 10:00 AM', 'Completed'),
(81, 2, 13, '2021-02-22', '9:00 AM - 9:30 AM', 'Cancelled'),
(82, 1, 13, '2021-02-22', '9:00 AM - 9:30 AM', 'Completed'),
(83, 1, 13, '2021-02-22', '10:00 AM - 10:30 AM', 'Completed'),
(84, 1, 13, '2021-02-22', '11:00 AM - 11:30 AM', 'Cancelled'),
(85, 1, 13, '2021-02-22', '10:00 AM - 10:30 AM', 'Completed'),
(86, 1, 13, '2021-02-22', '9:00 AM - 9:30 AM', 'Cancelled'),
(87, 2, 13, '2021-02-22', '9:00 AM - 9:30 AM', 'Cancelled'),
(88, 1, 13, '2021-02-23', '9:00 AM - 9:30 AM', 'Cancelled'),
(89, 1, 13, '2021-02-22', '9:00 AM - 9:30 AM', 'Cancelled'),
(90, 2, 13, '2021-02-22', '9:00 AM - 9:30 AM', 'Cancelled'),
(91, 2, 13, '2021-02-22', '9:00 AM - 9:30 AM', 'Cancelled'),
(92, 2, 13, '2021-02-22', '9:00 AM - 9:30 AM', 'Cancelled'),
(93, 2, 13, '2021-02-22', '9:00 AM - 9:30 AM', 'Cancelled'),
(94, 2, 13, '2021-02-22', '9:00 AM - 9:30 AM', 'Cancelled'),
(95, 2, 13, '2021-02-22', '9:00 AM - 9:30 AM', 'Cancelled'),
(96, 1, 13, '2021-02-22', '9:00 AM - 9:30 AM', 'Cancelled'),
(97, 2, 13, '2021-02-22', '9:00 AM - 9:30 AM', 'Cancelled'),
(98, 2, 13, '2021-02-22', '9:00 AM - 9:30 AM', 'Cancelled'),
(99, 2, 13, '2021-02-22', '9:00 AM - 9:30 AM', 'Cancelled'),
(100, 2, 13, '2021-02-22', '9:30 AM - 10:00 AM', 'Cancelled'),
(101, 1, 13, '2021-02-23', '9:00 AM - 9:30 AM', 'Cancelled'),
(102, 1, 13, '2021-02-23', '9:30 AM - 10:00 AM', 'Cancelled'),
(103, 1, 24, '2021-02-24', '9:00 AM - 9:30 AM', 'Completed'),
(104, 3, 24, '2021-02-25', '9:30 AM - 10:00 AM', 'Active'),
(105, 1, 24, '2021-02-24', '9:00 AM - 9:30 AM', 'Completed'),
(106, 1, 24, '2021-02-24', '11:00 AM - 11:30 AM', 'Completed'),
(107, 1, 24, '2021-02-24', '9:30 AM - 10:00 AM', 'Cancelled'),
(108, 1, 21, '2021-02-24', '1:00 PM - 1:30 PM', 'Cancelled'),
(109, 3, 13, '2021-02-28', '9:00 AM - 9:30 AM', 'Cancelled'),
(110, 1, 13, '2021-03-01', '9:00 AM - 9:30 AM', 'Cancelled'),
(111, 1, 13, '2021-03-01', '9:00 AM - 9:30 AM', 'Cancelled'),
(112, 1, 11, '2021-03-01', '9:00 AM - 9:30 AM', 'Cancelled'),
(113, 1, 12, '2021-03-01', '9:00 AM - 9:30 AM', 'Cancelled'),
(114, 1, 21, '2021-03-01', '9:00 AM - 9:30 AM', 'Cancelled'),
(115, 1, 21, '2021-03-01', '9:00 AM - 9:30 AM', 'Cancelled'),
(116, 1, 21, '2021-03-01', '9:00 AM - 9:30 AM', 'Cancelled'),
(117, 2, 21, '2021-03-01', '9:00 AM - 9:30 AM', 'Cancelled'),
(118, 1, 21, '2021-03-01', '9:30 AM - 10:00 AM', 'Cancelled'),
(119, 1, 11, '2021-03-01', '9:00 AM - 9:30 AM', 'Completed'),
(120, 1, 12, '2021-03-01', '9:00 AM - 9:30 AM', 'Cancelled'),
(121, 1, 13, '2021-03-01', '9:00 AM - 9:30 AM', 'Cancelled'),
(122, 1, 21, '2021-03-02', '9:00 AM - 9:30 AM', 'Cancelled'),
(123, 2, 21, '2021-03-01', '9:00 AM - 9:30 AM', 'Active'),
(124, 1, 13, '2021-03-02', '9:00 AM - 9:30 AM', 'Cancelled'),
(125, 2, 13, '2021-03-01', '11:30 AM - 12:00 PM', 'Cancelled'),
(126, 1, 13, '2021-03-02', '9:00 AM - 9:30 AM', 'Completed'),
(127, 1, 13, '2021-03-02', '9:00 AM - 9:30 AM', 'Cancelled'),
(128, 4, 13, '2021-03-03', '9:00 AM - 9:30 AM', 'Cancelled'),
(129, 1, 13, '2021-03-04', '9:00 AM - 9:30 AM', 'Cancelled'),
(130, 1, 13, '2021-03-04', '9:00 AM - 9:30 AM', 'Cancelled'),
(131, 1, 24, '2021-03-04', '9:00 AM - 9:30 AM', 'Cancelled'),
(132, 1, 24, '2021-03-04', '10:00 AM - 10:30 AM', 'Completed'),
(133, 1, 24, '2021-03-04', '9:00 AM - 9:30 AM', 'Active'),
(134, 1, 13, '2021-03-04', '9:30 AM - 10:00 AM', 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE IF NOT EXISTS `doctors` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) NOT NULL,
  `Spec_name` varchar(500) NOT NULL,
  `Practicing_from` date NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `UID` (`UID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`ID`, `UID`, `Spec_name`, `Practicing_from`) VALUES
(1, 5, 'Surgeon', '2021-01-12'),
(2, 6, 'Cancer Specialist', '2021-01-04'),
(3, 10, 'Skin specialist', '2021-01-27'),
(4, 29, 'Skin', '2021-03-02'),
(5, 31, 'Skin Cancer Specialist', '2021-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

DROP TABLE IF EXISTS `medicine`;
CREATE TABLE IF NOT EXISTS `medicine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_description` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_fk` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `supplier_id`, `product_code`, `product_name`, `product_quantity`, `product_description`, `type`) VALUES
(1, 1, 'MAL08031377ACZ', 'Prazovex 0.25mg Tab', 5000, 'Used for the management of anxiety disorder or for the short-term relief of symptoms of anxiety', 'Tablet'),
(2, 1, 'MAL08042466ACZ', 'Prazovex 0.5mg Tab', 990, 'Used for the management of anxiety disorder or for the short-term relief of symptoms of anxiety', 'Liquid'),
(4, 3, 'MAL20040896ACZ', 'Clarinase 24hr Extended Release Tabs. Pseudoephedrine', 498, 'Clarinase relieves symptoms associated with allergic rhinitis', 'Tablet'),
(5, 4, 'MVC122342', 'Antibiotics', 1000, 'Antibiotics', 'Tablet');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_id` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `note` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  KEY `user id` (`UID`),
  KEY `appointment id` (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`p_id`, `a_id`, `UID`, `note`) VALUES
(28, 74, 13, NULL),
(29, 75, 13, NULL),
(30, 76, 13, 'depressed'),
(31, 77, 13, NULL),
(32, 78, 13, NULL),
(33, 79, 13, NULL),
(34, 80, 13, 'a'),
(35, 81, 13, NULL),
(36, 82, 13, NULL),
(37, 83, 13, NULL),
(38, 84, 13, NULL),
(39, 85, 13, 'depressed'),
(40, 86, 13, NULL),
(41, 87, 13, NULL),
(42, 88, 13, NULL),
(43, 89, 13, NULL),
(44, 90, 13, NULL),
(45, 91, 13, NULL),
(46, 92, 13, NULL),
(47, 93, 13, NULL),
(48, 94, 13, NULL),
(49, 95, 13, NULL),
(50, 96, 13, NULL),
(51, 97, 13, NULL),
(52, 98, 13, NULL),
(53, 99, 13, NULL),
(54, 100, 13, NULL),
(55, 101, 13, NULL),
(56, 102, 13, NULL),
(57, 103, 24, NULL),
(58, 104, 24, NULL),
(59, 105, 24, NULL),
(60, 106, 24, 'sad'),
(61, 107, 24, NULL),
(62, 108, 21, NULL),
(63, 109, 13, NULL),
(64, 110, 13, NULL),
(65, 111, 13, NULL),
(66, 112, 11, NULL),
(67, 113, 12, NULL),
(68, 114, 21, NULL),
(69, 115, 21, NULL),
(70, 116, 21, NULL),
(71, 117, 21, NULL),
(72, 118, 21, NULL),
(73, 119, 11, NULL),
(74, 120, 12, NULL),
(75, 121, 13, NULL),
(76, 122, 21, NULL),
(77, 123, 21, NULL),
(78, 124, 13, NULL),
(79, 125, 13, NULL),
(80, 126, 13, 'leg injury'),
(81, 127, 13, 'leg pain and sad'),
(82, 128, 13, NULL),
(83, 129, 13, NULL),
(84, 130, 13, 'adsds'),
(85, 131, 24, NULL),
(86, 132, 24, 'leg'),
(87, 133, 24, 'ladsd'),
(88, 134, 13, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_medication`
--

DROP TABLE IF EXISTS `patient_medication`;
CREATE TABLE IF NOT EXISTS `patient_medication` (
  `pm_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `med_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`pm_id`),
  KEY `inventory id` (`med_id`),
  KEY `patient id` (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_medication`
--

INSERT INTO `patient_medication` (`pm_id`, `p_id`, `med_id`, `quantity`) VALUES
(6, 30, 1, 1),
(8, 30, 1, 2),
(9, 30, 4, 2),
(10, 34, 2, 2),
(12, 39, 1, 1),
(18, 59, 1, 2),
(22, 60, 2, 2),
(23, 60, 1, 2),
(24, 80, 2, 2),
(25, 81, 2, 2),
(27, 84, 1, 2),
(29, 86, 1, 2),
(31, 87, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `address`, `phone`, `email`) VALUES
(1, 'Apex Pharmacy Marketing Sdn Bhd', '2, Jalan SS13/5, 47500 Subang Jaya, Selangor Darul Ehsan', '03-5629 3688', 'enquiries@apexpharma.com.my'),
(3, 'Atlantic Laboratories (M) Sdn Bhd', 'No 4, Jalan Anggerik Vanilla Z 31/Z, Kota Kemuning 40460 Shah Alam Selangor', '03-5124 9819', 'malatc@po.jaring.my'),
(4, 'ABC supplier', 'No 4, Jalan Anggerik 222', '03-7584 7415', 'sd@mail.com'),
(5, 'sdadas', 'sdaddsda', '0122225874', 'sdad@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `PhoneNumber` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `temp_token` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `username`, `name`, `email`, `PhoneNumber`, `password`, `usertype`, `temp_token`) VALUES
(5, 'JamesL', 'Dr Bobsss', 'test2@hotmail.com', '0123456780', 'cc03e747a6afbbcbf8be7668acfebee5', 'Doctor', NULL),
(6, 'test1', 'Ali', 'test1@hotmail.com', '0124587639', '5a105e8b9d40e1329780d62ea2265d8a', 'Doctor', NULL),
(8, 'ken', 'ken', 'kenmail.com', '01247854444', '827ccb0eea8a706c4c34a16891f84e7b', 'Patient', NULL),
(10, 'john', 'Macolm John', 'john@hotmail.com', '0123456696', '25f9e794323b453885f5181f1b624d0b', 'Doctor', NULL),
(11, 'james', 'james', 'james@hotmail.com', '0123456789', '25f9e794323b453885f5181f1b624d0b', 'Patient', NULL),
(12, 'jux', 'jux', 'jux@hotmail.com', '0123456845', '25f9e794323b453885f5181f1b624d0b', 'Patient', NULL),
(13, 'jax', 'jaxess', 'jax@hotmail.com', '0123457415', 'e316ffac70bb7b5ed2a42427a44e14e8', 'Patient', NULL),
(14, 'admin', 'James Wilkinssssss', 'admin@gmail.com', '01235896784', '21232f297a57a5a743894a0e4a801fc3', 'Admin', NULL),
(15, 'bob', 'Bob', 'bob@gmail.com', '0125874698', '46de94fabe07850e0770f5e8f0ac0280', 'Nurse', NULL),
(16, 'jacob', 'Jacobssss', 'jacob@gmail.com', '0125879634', 'a7aed969c34749dd2f0a9b29193f90a7', 'Inventory Supervisor', NULL),
(17, 'jamesB', 'James Bos', 'jamesB@hotmail.com', '01258967422', '202cb962ac59075b964b07152d234b70', 'Nurse', NULL),
(19, 'sda', 'King James', 'King@mail.com', '01574', 'f6fdbc803505c59e61767fd95b166525', 'Doctor', NULL),
(21, 'ken123', 'Ken Ang', 'kenopy24@hotmail.com', '0124409985', 'fad9a15eff50ec25096aaec007c9d58d', 'Patient', '253991212e66a2f9317a553497d6a37a'),
(22, 'jim', 'jim', 'pickens@gmail.com', '0125874963', '76295d2bcbe589c9847cc331dd7ba348', 'Patient', NULL),
(24, 'kenken', 'Ang Ken', 'kenopy24@gmail.com', '0124027885', '49d10b739717d0e2a3f0709feeb2797d', 'Patient', 'd5101ba612907211ff003da9e20748fa'),
(25, 'tokiyo', 'Tokiyo', 'tokiyo@gmail.com', '01222587493', 'a7aed969c34749dd2f0a9b29193f90a7', 'Patient', NULL),
(26, 'kan123', 'Kang Bing Kang', 'kangmai@mail.com', '0128745874', 'f5546e9897b824f49b32c2d2c59a2281', 'Patient', NULL),
(27, 'konkonnn', 'konman', 'kon@mail.com', '0123456722', 'f5546e9897b824f49b32c2d2c59a2281', 'Patient', NULL),
(29, 'kankun', 'kankun', 'kan@mail.com', '0125874933', 'b41cb62ec6767f2e41f9df7a2d161515', 'Doctor', NULL),
(31, 'kankin', 'kankin', 'kankin@gmail.com', '0128745555', 'f5546e9897b824f49b32c2d2c59a2281', 'Doctor', NULL),
(32, 'adadada', 'dadadad', 'dadada@mail.com', '0125748804', '47bdb8f44799c163fbef8b37b8e118f4', 'Nurse', NULL),
(33, 'dadada', 'dadada', 'dadad@gmail.com', '01258748884', 'cecf7554747b6e6c621a718ccf9e35b4', 'Nurse', NULL),
(34, 'kenken1222', 'Ang Weng Ken', 'kenken@gmail.com', '0125874448', 'fad9a15eff50ec25096aaec007c9d58d', 'Patient', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `Doctor FK` FOREIGN KEY (`D_ID`) REFERENCES `doctors` (`ID`),
  ADD CONSTRAINT `User FK` FOREIGN KEY (`U_ID`) REFERENCES `users` (`UID`);

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `foreign key ` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`);

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `supplier_fk` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `appointment id` FOREIGN KEY (`a_id`) REFERENCES `appointment` (`ID`),
  ADD CONSTRAINT `user id` FOREIGN KEY (`UID`) REFERENCES `appointment` (`U_ID`);

--
-- Constraints for table `patient_medication`
--
ALTER TABLE `patient_medication`
  ADD CONSTRAINT `inventory id` FOREIGN KEY (`med_id`) REFERENCES `medicine` (`id`),
  ADD CONSTRAINT `patient id` FOREIGN KEY (`p_id`) REFERENCES `patient` (`p_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
