-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2021 at 08:02 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webmastersdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminsId` int(11) NOT NULL,
  `adminsName` varchar(128) NOT NULL,
  `adminsEmail` varchar(128) NOT NULL,
  `adminsUid` varchar(128) NOT NULL,
  `adminsPwd` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminsId`, `adminsName`, `adminsEmail`, `adminsUid`, `adminsPwd`) VALUES
(1, 'Ermis', 'ermis@gmail.com', 'Ermisss', '$2y$10$IwMHN0rUk6qEjSMndUfMj.DPJZEqIduIEzioiBFK114QDEbki5jki'),
(2, 'Jotaro Kujo', 'JoJo@hotmale.com', '', 'oraora'),
(3, 'Joseph Joestar', 'JoJos@gmail.gr', '', 'ohnooo'),
(4, 'Jonathan Joestar', 'JojoOG@gmail.com', '', 'rerorero');

-- --------------------------------------------------------

--
-- Table structure for table `har`
--

CREATE TABLE `har` (
  `uploadDate` date DEFAULT NULL,
  `usersUid` varchar(128) DEFAULT NULL,
  `usersIp` varchar(64) DEFAULT NULL,
  `startedDateTime` varchar(255) DEFAULT NULL,
  `domainname` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `provider` varchar(50) DEFAULT NULL,
  `method` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `har`
--

INSERT INTO `har` (`uploadDate`, `usersUid`, `usersIp`, `startedDateTime`, `domainname`, `status`, `provider`, `method`) VALUES
(NULL, NULL, NULL, NULL, 'www.google.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.google.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.google.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.google.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.google.com', '204', NULL, 'POST'),
(NULL, NULL, NULL, NULL, 'fonts.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.google.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'fonts.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.google.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'id.google.com', '204', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.google.com', '204', NULL, 'POST'),
(NULL, NULL, NULL, NULL, 'www.google.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.google.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.google.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.google.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.google.com', '204', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'lh3.googleusercontent.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.google.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'apis.google.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.google.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'i.ytimg.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'i.ytimg.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'i.ytimg.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'encrypted-tbn0.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'encrypted-tbn0.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'encrypted-tbn0.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'encrypted-tbn0.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'encrypted-tbn0.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'encrypted-tbn0.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'encrypted-tbn0.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'encrypted-tbn0.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'encrypted-tbn0.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'encrypted-tbn0.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'encrypted-tbn0.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'encrypted-tbn0.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.google.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.google.com', '204', NULL, 'POST'),
(NULL, NULL, NULL, NULL, 'www.google.com', '204', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.google.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.google.com', '204', NULL, 'POST'),
(NULL, NULL, NULL, NULL, 'adservice.google.com', '204', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.google.com', '302', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.googleadservices.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'ogs.google.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'lh3.googleusercontent.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'ssl.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'fonts.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'fonts.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'www.gstatic.com', '200', NULL, 'GET'),
(NULL, NULL, NULL, NULL, 'play.google.com', '200', NULL, 'POST'),
(NULL, NULL, NULL, NULL, 'www.google.com', '204', NULL, 'POST'),
(NULL, NULL, NULL, NULL, '', '', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `method`
--

CREATE TABLE `method` (
  `meth` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `method`
--

INSERT INTO `method` (`meth`) VALUES
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('POST'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('POST'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('POST'),
('GET'),
('GET'),
('POST'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('GET'),
('POST'),
('POST'),
('');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersUid` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersUid`, `usersPwd`, `isAdmin`) VALUES
(1, 'ermis arvanitis', 'ermisarvanitis@gmail', 'ermis', '$2y$10$ZWr2gGyHSt7YxAKeCxt7qeFqTbD9EYsKPv1VPMcgT0NfYP5/2tsZi', 0),
(2, 'st1059574', 'iasonarvanitis1998@gmail.com', 'iasonas', '$2y$10$ZWr2gGyHSt7YxAKeCxt7qeFqTbD9EYsKPv1VPMcgT0NfYP5/2tsZi', 0),
(3, 'marios', 'marios@gmail.com', 'mariosss', '$2y$10$IwMHN0rUk6qEjSMndUfMj.DPJZEqIduIEzioiBFK114QDEbki5jki', 0),
(6, 'Jotaro Kujo', 'jojo@gmail.com', 'JoJoFTW', '$2y$10$a9PKfLImq77TLK3I1KDV7Oh/UD78Exi7qyf.zpCAOtFIVW.udtSz6', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminsId`);

--
-- Indexes for table `har`
--
ALTER TABLE `har`
  ADD KEY `users_har` (`usersUid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`),
  ADD UNIQUE KEY `idx_uid` (`usersUid`),
  ADD UNIQUE KEY `idx_email` (`usersEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adminsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `har`
--
ALTER TABLE `har`
  ADD CONSTRAINT `users_har` FOREIGN KEY (`usersUid`) REFERENCES `users` (`usersUid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
