-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2024 at 09:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `pharmconame` varchar(255) NOT NULL,
  `pharmacy_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `texts` text DEFAULT NULL,
  `supervisor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `ssn` varchar(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `specialty` varchar(255) DEFAULT NULL,
  `years_exp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`ssn`, `name`, `specialty`, `years_exp`) VALUES
('12345678911', 'doccod', 'physiotherapy', 2),
('287328', 'Arushi Kumar', 'dentist', 1),
('34947', 'abcde', 'none', 6);

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `tradeName` varchar(255) NOT NULL,
  `formula` varchar(255) DEFAULT NULL,
  `pharmCoName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`tradeName`, `formula`, `pharmCoName`) VALUES
('crocin', 'paracetamol', 'ABCDEPHARMA');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `ssn` varchar(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `pri_physician` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`ssn`, `name`, `address`, `age`, `pri_physician`) VALUES
('123324324', 'Arushi Kumar', 'guwahati', 32, '287328');

-- --------------------------------------------------------

--
-- Stand-in structure for view `patient medical history`
-- (See below for the actual view)
--
CREATE TABLE `patient medical history` (
`PatientName` varchar(255)
,`DoctorName` varchar(255)
,`DrugName` varchar(255)
,`PharmaCoName` varchar(255)
,`PrescriptionDate` date
,`Quantity` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`name`, `address`, `phone_number`) VALUES
('Arushi Kumar', 'E304 Regulus Balewadi', '9389283');

-- --------------------------------------------------------

--
-- Table structure for table `pharmco`
--

CREATE TABLE `pharmco` (
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmco`
--

INSERT INTO `pharmco` (`name`, `phone_number`) VALUES
('ABCDEPHARMA', '9766789070');

-- --------------------------------------------------------

--
-- Table structure for table `prescribes`
--

CREATE TABLE `prescribes` (
  `patient_ssn` varchar(11) NOT NULL,
  `doctor_ssn` varchar(11) NOT NULL,
  `pharmCoName` varchar(255) NOT NULL,
  `drugtrade_name` varchar(255) NOT NULL,
  `dateprescribed` date NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescribes`
--

INSERT INTO `prescribes` (`patient_ssn`, `doctor_ssn`, `pharmCoName`, `drugtrade_name`, `dateprescribed`, `qty`) VALUES
('123324324', '287328', 'ABCDEPHARMA', 'crocin', '2024-02-11', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `pharmacy_name` varchar(255) NOT NULL,
  `pharmCoName` varchar(255) NOT NULL,
  `drugtrade_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure for view `patient medical history`
--
DROP TABLE IF EXISTS `patient medical history`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `patient medical history`  AS SELECT `p`.`name` AS `PatientName`, `d`.`name` AS `DoctorName`, `dr`.`tradeName` AS `DrugName`, `dr`.`pharmCoName` AS `PharmaCoName`, `pr`.`dateprescribed` AS `PrescriptionDate`, `pr`.`qty` AS `Quantity` FROM (((`prescribes` `pr` join `patient` `p` on(`pr`.`patient_ssn` = `p`.`ssn`)) join `doctor` `d` on(`pr`.`doctor_ssn` = `d`.`ssn`)) join `drugs` `dr` on(`pr`.`drugtrade_name` = `dr`.`tradeName` and `pr`.`pharmCoName` = `dr`.`pharmCoName`)) ORDER BY `pr`.`dateprescribed` DESC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`pharmconame`,`pharmacy_name`),
  ADD KEY `pharmacy_name` (`pharmacy_name`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`ssn`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`pharmCoName`,`tradeName`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`ssn`),
  ADD KEY `pri_physician` (`pri_physician`);

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `pharmco`
--
ALTER TABLE `pharmco`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `prescribes`
--
ALTER TABLE `prescribes`
  ADD PRIMARY KEY (`patient_ssn`,`doctor_ssn`,`pharmCoName`,`drugtrade_name`),
  ADD KEY `doctor_ssn` (`doctor_ssn`),
  ADD KEY `pharmCoName` (`pharmCoName`,`drugtrade_name`);

--
-- Indexes for table `sells`
--
ALTER TABLE `sells`
  ADD PRIMARY KEY (`pharmacy_name`,`pharmCoName`,`drugtrade_name`),
  ADD KEY `pharmCoName` (`pharmCoName`,`drugtrade_name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `contracts_ibfk_1` FOREIGN KEY (`pharmconame`) REFERENCES `pharmco` (`name`),
  ADD CONSTRAINT `contracts_ibfk_2` FOREIGN KEY (`pharmacy_name`) REFERENCES `pharmacy` (`name`);

--
-- Constraints for table `drugs`
--
ALTER TABLE `drugs`
  ADD CONSTRAINT `drugs_ibfk_1` FOREIGN KEY (`pharmCoName`) REFERENCES `pharmco` (`name`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`pri_physician`) REFERENCES `doctor` (`ssn`);

--
-- Constraints for table `prescribes`
--
ALTER TABLE `prescribes`
  ADD CONSTRAINT `prescribes_ibfk_1` FOREIGN KEY (`patient_ssn`) REFERENCES `patient` (`ssn`),
  ADD CONSTRAINT `prescribes_ibfk_2` FOREIGN KEY (`doctor_ssn`) REFERENCES `doctor` (`ssn`),
  ADD CONSTRAINT `prescribes_ibfk_3` FOREIGN KEY (`pharmCoName`,`drugtrade_name`) REFERENCES `drugs` (`pharmCoName`, `tradeName`);

--
-- Constraints for table `sells`
--
ALTER TABLE `sells`
  ADD CONSTRAINT `sells_ibfk_1` FOREIGN KEY (`pharmacy_name`) REFERENCES `pharmacy` (`name`),
  ADD CONSTRAINT `sells_ibfk_2` FOREIGN KEY (`pharmCoName`,`drugtrade_name`) REFERENCES `drugs` (`pharmCoName`, `tradeName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
