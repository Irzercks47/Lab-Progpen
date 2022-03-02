-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2021 at 01:59 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `speedyninja`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `accountId` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phoneNumber` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`accountId`, `username`, `password`, `email`, `gender`, `phoneNumber`) VALUES
(1, 'ninakesya', '$2y$10$cDqJNR5MEGxl6LY3jTcLaOuZcqUInYABgV/AyfH81PdayUmlmcLFi', 'ninakesya@mail.com', 'Female', '0129694649'),
(2, 'gregory_amand', '$2y$10$PtCYlUqHjhGJZs.Sye09XO3UoJoZRdHsqniN3TZmflOorEPgPeloy', 'gregoryamando@mail.com', 'Male', '0384469194'),
(3, 'jessxjess', '$2y$10$ZbIzwslk0/34URJ/SpRKhO1GA2tEmMDBCYksBfXQ0XbGOkuxH1eZm', 'jessicachristina@mail.com', 'Female', '0474188373'),
(4, 'victoriatheressa', '$2y$10$RQu0.8IDQRjYXb7LvYs4N.Jc1cjNzPAUN1c5DlFWaSdkCSozbuVM2', 'vict.theresa@mail.com', 'Female', '0682810286'),
(5, 'harrypayne', '$2y$10$U443RbCe0xVJS.vjmpIlQuAvYwOd4WTrmbfFE0Af7wQZCVoGWldqC', 'harrypayne@yooha.com', 'Male', '0951901566'),
(6, 'j.ross', '$2y$10$y.iKys.5jko4VbrS731uZuyc04QQBkP3IwKSnUxHSp9o7BsU6tjqi', 'johan_ross@mail.com', 'Male', '0352295041'),
(7, 'ferdinand_louis', '$2y$10$6pK/4t0TF0OOvJpZ7i63deSm3jnrd2BUaQ8xMjDUb2Gym4A3i19qC', 'ferdinand_louis@inlook.com', 'Male', '0571220431'),
(8, 'christian_', '$2y$10$FxAJA4EEhM/ewbUzw0EBju6dOCwGjHJNOyPv0rw.AYG645kk3LWBi', 'christian012@mail.com', 'Male', '0890883531'),
(9, 'deboralee', '$2y$10$.iY7JDtGn9vW1XwbmizCwe1tQErahzkMbvUfhJDnJGJsKxHH9ITPq', 'deboooora@yooha.com', 'Female', '0932226853'),
(10, 'sebastianchndr', '$2y$10$F8D/XOEtIb975QwmtxoURuFDk8eEnu.nA3GKJPHZJ6Cl6dytWEX3m', 'chandrasebastian@inlook.com', 'Male', '0271179632'),
(11, 'grace_mcknzee', '$2y$10$FF5kB552HeyvjRUgemCB/.kDpR2vrPYYvwU54FlyuTPeLl5a1q7De', 'gracemcknz@inlook.com', 'Female', '0214438232'),
(12, 'ddion', '$2y$10$px5otjaxt0F3239JqpSb0.bQ9ShWehDFUWNv0NraWoR0wZKcQA7AW', 'dionisiusdion@yooha.com', 'Male', '0832103911'),
(13, 'amandersingh', '$2y$10$htKRF.PG5Yok0GCRmhnzQugRqxm52f1aJksVwmAw7JcsoO0kCV4qS', 'amander_singh@inlook.co ', 'Female', '0392130271'),
(14, 'leekyungsoo', '$2y$10$EUPdidQ4ANhjzZxhLTWGu.HksaSAULh2Hf/QrLlyBIr9xo.KNqT1a', 'lks22@yooha.com', 'Male', '0214738412'),
(15, 'vincenthan_', '$2y$10$Y.I/gQbcZIb9hIUda3MdeOLhIFF/EnQPkZk1E7B9gHoDgm05fi12a', 'vincenthan@yooha.com', 'Male', '0373238712');

-- --------------------------------------------------------

--
-- Table structure for table `thief`
--

CREATE TABLE `thief` (
  `thiefId` int(11) NOT NULL,
  `thiefCodeName` varchar(30) NOT NULL,
  `thiefTypeId` int(11) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `thiefAge` int(11) NOT NULL,
  `yearsOfExperience` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thief`
--

INSERT INTO `thief` (`thiefId`, `thiefCodeName`, `thiefTypeId`, `gender`, `thiefAge`, `yearsOfExperience`) VALUES
(1, 'Jadeflash', 1, 'Male', 19, 8),
(2, 'Scarlethunter', 1, 'Female', 20, 9),
(3, 'Silverlock', 1, 'Male', 18, 5),
(4, 'Minibullet', 2, 'Male', 20, 15),
(5, 'Redtooth', 2, 'Female', 20, 9),
(6, 'Moonchild', 2, 'Male', 25, 13),
(7, 'Swordbeat', 2, 'Female', 19, 12),
(8, 'Ironstroke', 3, 'Male', 31, 20),
(9, 'Hollowlight', 3, 'Male', 30, 21),
(10, 'Stillblade', 3, 'Female', 25, 18),
(11, 'Cateye', 4, 'Male', 40, 30),
(12, 'Killstain', 4, 'Male', 45, 36),
(13, 'Starshadow', 5, 'Female', 40, 38),
(14, 'Deathflow', 5, 'Male', 55, 48),
(15, 'Quickclaw', 5, 'Male', 60, 52);

-- --------------------------------------------------------

--
-- Table structure for table `thieftype`
--

CREATE TABLE `thieftype` (
  `thiefTypeId` int(11) NOT NULL,
  `thiefTypeName` varchar(30) NOT NULL,
  `thiefTypeDesc` varchar(255) NOT NULL,
  `thiefTypePrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thieftype`
--

INSERT INTO `thieftype` (`thiefTypeId`, `thiefTypeName`, `thiefTypeDesc`, `thiefTypePrice`) VALUES
(1, 'Newbie', 'New but not so new. New but skilled. We are reliable.', 1000000),
(2, 'Intermediate', 'Obviously better and more skilled.', 8500000),
(3, 'Skilled', 'Explanation is not needed. You can see it in our name.', 15000000),
(4, 'Advanced', 'Ssst. Ninjas don\'t speak. Ninjas prove.', 30000000),
(5, 'Master', '...', 75000000);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transactionId` int(11) NOT NULL,
  `accountId` int(11) NOT NULL,
  `thiefId` int(11) NOT NULL,
  `bookedDate` date NOT NULL,
  `transactionStatus` varchar(20) NOT NULL,
  `transactionDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionId`, `accountId`, `thiefId`, `bookedDate`, `transactionStatus`, `transactionDate`) VALUES
(9, 1, 1, '2020-10-31', 'finished', '2020-10-17'),
(10, 7, 8, '2020-12-14', 'finished', '2020-12-12'),
(11, 3, 3, '2021-04-29', 'failed', '2021-04-05'),
(12, 5, 7, '2021-05-13', 'finished', '2021-05-12'),
(13, 4, 5, '2021-06-25', 'finished', '2021-06-18'),
(14, 11, 2, '2021-06-26', 'finished', '2021-06-25'),
(15, 7, 4, '2021-07-21', 'finished', '2021-07-06'),
(16, 9, 1, '2021-07-24', 'failed', '2021-07-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`accountId`);

--
-- Indexes for table `thief`
--
ALTER TABLE `thief`
  ADD PRIMARY KEY (`thiefId`),
  ADD KEY `thiefTypeId` (`thiefTypeId`);

--
-- Indexes for table `thieftype`
--
ALTER TABLE `thieftype`
  ADD PRIMARY KEY (`thiefTypeId`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionId`),
  ADD KEY `accountId` (`accountId`),
  ADD KEY `thiefId` (`thiefId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `accountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `thief`
--
ALTER TABLE `thief`
  MODIFY `thiefId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `thieftype`
--
ALTER TABLE `thieftype`
  MODIFY `thiefTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `thief`
--
ALTER TABLE `thief`
  ADD CONSTRAINT `thief_ibfk_1` FOREIGN KEY (`thiefTypeId`) REFERENCES `thieftype` (`thiefTypeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`thiefId`) REFERENCES `thief` (`thiefId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
