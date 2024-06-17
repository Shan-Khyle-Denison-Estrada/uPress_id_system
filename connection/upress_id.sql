-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2024 at 08:26 AM
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
-- Database: `upress`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `accountID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `nameExtension` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `dateAdded` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL,
  `managerPhoto` blob NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `nameExtension` varchar(255) DEFAULT NULL,
  `emergencyFirstName` varchar(255) NOT NULL,
  `emergencyMiddleName` varchar(255) NOT NULL,
  `emergencyLastName` varchar(255) NOT NULL,
  `emergencyNameExtension` varchar(255) DEFAULT NULL,
  `emergencyAddress` varchar(255) NOT NULL,
  `emergencyContactNumber` int(11) NOT NULL,
  `clientSignature` blob NOT NULL,
  `clientPhoto` blob NOT NULL,
  `clientType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `clientIDEmployee` int(11) NOT NULL,
  `idNumber` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `worksAt` varchar(255) NOT NULL,
  `residentialAddress` varchar(255) NOT NULL,
  `birthDate` date NOT NULL,
  `contactNumber` int(11) NOT NULL,
  `bloodType` varchar(255) NOT NULL,
  `employeeIDForm` blob NOT NULL,
  `affidavitOfLoss` blob NOT NULL,
  `lostIDForm` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `clientIDStudent` int(11) NOT NULL,
  `studentNumber` int(11) NOT NULL,
  `collegeProgramOrStrand` varchar(255) NOT NULL,
  `certificateOfRegistration` blob NOT NULL,
  `affidavitOfLoss` blob NOT NULL,
  `lostIDForm` blob NOT NULL,
  `oldIDFront` blob NOT NULL,
  `oldIDBack` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transactionID` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  `clientID` int(11) NOT NULL,
  `transactionType` varchar(255) NOT NULL,
  `dateTime` datetime NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accountID`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`clientIDEmployee`,`idNumber`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`clientIDStudent`,`studentNumber`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transactionID`),
  ADD KEY `transactionClient` (`clientID`),
  ADD KEY `transactionManager` (`accountID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `clientEmployee` FOREIGN KEY (`clientIDEmployee`) REFERENCES `clients` (`clientID`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `clientStudent` FOREIGN KEY (`clientIDStudent`) REFERENCES `clients` (`clientID`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactionClient` FOREIGN KEY (`clientID`) REFERENCES `clients` (`clientID`),
  ADD CONSTRAINT `transactionManager` FOREIGN KEY (`accountID`) REFERENCES `accounts` (`accountID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
