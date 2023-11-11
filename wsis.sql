-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 26, 2023 at 02:14 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wsis`

CREATE DATABASE wsis;
--
USE wsis;
-- --------------------------------------------------------
--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` char(5) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(100) DEFAULT NULL,
  `Designation` varchar(100) NOT NULL,
  `NIC` char(13) NOT NULL,
  `DOB` date NOT NULL,
  `TelNo` int(11) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `PostalAddress` varchar(300) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Gender` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `FName`, `LName`, `Designation`, `NIC`, `DOB`, `TelNo`, `Email`, `PostalAddress`, `Password`, `Gender`) VALUES
('CHH01', 'Chamudini Sansala Kodithuwakku', 'Tharanga', 'Singing', '772436200110', '2007-04-21', 778519048, 'chamu0110@gmail.com', 'No.270/2, Thilakapura, Ambalangoda.', '098765GG', ''),
('TIT01', 'Iresh', 'Tharanga', 'ML', '991450300V', '1999-05-24', 772974980, 'ggwrp2@outlook.com', 'fsgsghgh', '12345678', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `constructionCompany`
--

CREATE TABLE `constructionCompany` (
  `conComID` int(11) NOT NULL,
  `ComName` varchar(100) NOT NULL,
  `RegNo` char(21) NOT NULL,
  `TIN` char(21) NOT NULL,
  `TelNo` int(11) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `PostalAddress` varchar(300) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `constructionCompany`
--

INSERT INTO `constructionCompany` (`conComID`, `ComName`, `RegNo`, `TIN`, `TelNo`, `Email`, `PostalAddress`, `Password`) VALUES
(1, 'infXrge Pvt Ltd', '121426740', '0987654321', 772974980, 'iresh@inforge.com', 'No. 270/2,\r\nKatubedda,\r\nMoratuwa.', '12345678'),
(2, 'GGWZP Pvt Ltd', '9876543210', '6532482487092', 777838300, 'ggwp@gg.lk', 'abcsfaffas', '1234567890'),
(3, 'ARM01', '463463763t346', '4634634f467FH', 778519048, 'package@arm.lk', 'NO.390,\r\nGalle,\r\nmatara.', '12345678'),
(4, 'GGWPXR', '1234GKT', '44231GUYX', 772312345, 'ggwp123@hh.lk', 'No 234, fadfdsfs, gsgsfdg, gfdgdg.', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `fund`
--

CREATE TABLE `fund` (
  `fundID` int(11) NOT NULL,
  `Amount` double NOT NULL,
  `Date` date NOT NULL,
  `donorID` int(11) DEFAULT NULL,
  `orgDonorID` int(11) DEFAULT NULL,
  `fundRaiseID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fund`
--

INSERT INTO `fund` (`fundID`, `Amount`, `Date`, `donorID`, `orgDonorID`, `fundRaiseID`) VALUES
(1, 123141, '2023-01-28', NULL, NULL, 1),
(3, 500, '2023-01-11', 2, NULL, NULL),
(5, 25235, '2023-01-25', NULL, 2, NULL),
(6, 700, '2023-01-11', NULL, 2, NULL),
(7, 500, '2025-02-19', NULL, 1, NULL),
(8, 9800, '2025-03-29', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fundRaise`
--

CREATE TABLE `fundRaise` (
  `fundRaiseID` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `EventDate` date NOT NULL,
  `adminID` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fundRaise`
--

INSERT INTO `fundRaise` (`fundRaiseID`, `Name`, `Description`, `EventDate`, `adminID`) VALUES
(1, 'Raise of the apesX', 'hjkj', '2023-01-31', 'TIT01'),
(3, 'asdgdasgsd', 'sfasfsafsa', '2023-02-25', 'CHH01'),
(4, 'fsafsafa', 'dsad', '2023-01-04', 'TIT01'),
(5, 'asfsafa', 'saffaf', '2023-01-04', 'TIT01');

-- --------------------------------------------------------

--
-- Table structure for table `infoProvider`
--

CREATE TABLE `infoProvider` (
  `userID` int(11) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(100) DEFAULT NULL,
  `Province` char(23) NOT NULL,
  `NIC` char(13) NOT NULL,
  `DOB` date NOT NULL,
  `TelNo` int(11) NOT NULL,
  `Email` varchar(70) DEFAULT NULL,
  `PostalAddress` varchar(300) NOT NULL,
  `Username` char(11) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Gender` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `infoProvider`
--

INSERT INTO `infoProvider` (`userID`, `FName`, `LName`, `Province`, `NIC`, `DOB`, `TelNo`, `Email`, `PostalAddress`, `Username`, `Password`, `Gender`) VALUES
(1, 'iresh', 'tharanga', 'Uva Province', '87623', '2001-01-26', 98765, 'ir@gmail.com', '390/5, ambalangoda', 'iresh1', '123', ''),
(3, 'ashani', 'sansala', 'Central Province', '43213', '2023-01-10', 54321, 'ash@gmail.com', '230/32, amb', 'gg1', '123456', ''),
(20, 'Cobalt', 'copperfield', 'Western Province', '991450300674', '2023-01-20', 917911019, '', '2123, djaiodais, jaosdjao\r\n sdjaksdja.', 'cobalt01', '1234qwer', ''),
(31, 'Ashani', 'Sansala', 'Western Province', '200176001585', '2001-09-16', 760156782, 'iresh.ashani@gmail.com', 'No No 123, Katandola, Thalagaspe, Elpitiya.', 'ashu02', 'iresha1234', 'Female'),
(32, 'KLIH', '', 'Northern Province', '991450300v', '1999-05-24', 917911019, 't4t4@gh.lk', 'No 123124, fsaddfdsfs, gsdgsdgsd, sdgsdgsg.', 'bbht12', '1234567890x', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `organizationalDonor`
--

CREATE TABLE `organizationalDonor` (
  `orgDonorID` int(11) NOT NULL,
  `OrgName` varchar(100) NOT NULL,
  `RegNo` char(21) NOT NULL,
  `Category` varchar(50) DEFAULT NULL,
  `TIN` char(21) NOT NULL,
  `TelNo` int(11) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `PostalAddress` varchar(300) DEFAULT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizationalDonor`
--

INSERT INTO `organizationalDonor` (`orgDonorID`, `OrgName`, `RegNo`, `Category`, `TIN`, `TelNo`, `Email`, `PostalAddress`, `Password`) VALUES
(1, 'GX Lanka OrgX', '9876565789', 'Marketing and Advertising', '12345678', 777848492, 'ggl@gg.org', 'No.72/4, Katubeddda, Moratuwa.', '12345678'),
(2, 'FFZK', '2455678907', 'Education and Training', '1234356789', 778426046, 'ffd@div.org', '12/2,\r\nasfasfasf,\r\nasff', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `personalDonor`
--

CREATE TABLE `personalDonor` (
  `donorID` int(11) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(100) DEFAULT NULL,
  `NIC` char(13) NOT NULL,
  `DOB` date NOT NULL,
  `TelNo` int(11) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `PostalAddress` varchar(300) DEFAULT NULL,
  `Password` varchar(20) NOT NULL,
  `Gender` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personalDonor`
--

INSERT INTO `personalDonor` (`donorID`, `FName`, `LName`, `NIC`, `DOB`, `TelNo`, `Email`, `PostalAddress`, `Password`, `Gender`) VALUES
(1, 'Makise', 'Kurisu', '234540499234', '2013-01-23', 912435678, 'handk@gg.lk', NULL, '1234567890', '0'),
(2, 'Daru', 'Kun', '773456789230', '2000-01-17', 775623456, 'grand1@abc.lk', NULL, '987654321', '0'),
(3, 'iresh', 'tharanga', '123456789v', '2023-01-26', 772974980, 'iresh01@abc.lk', '435gregergerg', '123456789', '0'),
(4, 'eafasfas', '', '123435622v', '2023-01-26', 1234567890, '3ffefe@gma.lk', '123 dsgsdgsdgds', '123456789', '0'),
(5, 'dasfasfs', 'asfsafasfs', '123456782v', '2023-01-18', 1234567890, '123gdsgsd@hl.lk', '23 fasfasfas asfasfasfas fafasfasf', '123456789', '0'),
(6, 'dasfasfs', 'asfsafasfs', '123443212v', '2023-01-18', 1234567890, '123gds12@hl.lk', '   ', '123456789', '0'),
(7, 'qweer', '', '123456789034', '2023-01-11', 1234567890, 'gfjgfjfg123@ffd.lk', '   ', '12345678', '0'),
(8, 'ggwphXX', '', '123456789089', '2023-01-20', 772345678, 'ZZKK12@kk.lk', 'No ,,,.', '123456789', '0'),
(9, 'ggwphXX', '', '123412789089', '2023-01-20', 772345678, 'ZZKK123@kk.lk', 'No ,,,.', '12345678', '0'),
(10, 'ggwphXX', '', '123412745089', '2023-01-20', 772345678, 'ZZKK3@kk.lk', 'No ,,,.', '12345678', '0'),
(11, 'ggwphXX', '', '123412712089', '2023-01-20', 772345678, 'ZZKK34@kk.lk', 'No ,,,.', '12345678', '0'),
(12, 'ggwphXX', '', '123412712289', '2023-01-20', 772345678, 'ZZ1K34@kk.lk', '', '12345678', '0'),
(13, 'ggwpZZZ', '', '132412712289', '1324-05-06', 772345678, 'ZZ1124@kk.lk', 'No 12,adsdsa,123.', '12345678', 'Male'),
(14, 'ggwphXX', '', '132412542289', '2023-01-20', 772345678, 'ZZ24@kk.lk', 'No 12,\nadsdsa,\nsfasf,\n123.', '12345678', '0'),
(15, 'ggwphXX', '', '132412543289', '2023-01-20', 772345678, 'ZZ84@kk.lk', '', '12345678', '0'),
(16, 'dasd', '', '883456789V', '2023-01-27', 778537834, '34fe@gh.lk', '', '12345678', '0'),
(24, 'sakfasf', '', '991450300v', '1999-05-24', 778519048, 'mkk12@kk.lk', 'dafasdas 12  ewgwegwegew4/', '12345678', 'Male'),
(25, 'safas', '', '732950133v', '1973-10-21', 773424134, 'asfaff43@gg.lk', '', '12345678', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `projectID` int(11) NOT NULL,
  `ProjectTitle` varchar(100) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `ProjectArea` varchar(100) NOT NULL,
  `EstimatedTime` varchar(50) NOT NULL,
  `EstimatedCost` double NOT NULL,
  `ProjectStatus` char(20) NOT NULL,
  `adminID` char(5) DEFAULT NULL,
  `conComID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`projectID`, `ProjectTitle`, `Description`, `ProjectArea`, `EstimatedTime`, `EstimatedCost`, `ProjectStatus`, `adminID`, `conComID`) VALUES
(2, 'Unreal ghh', 'aasd', 'San fransisco', '3 months', 100000, 'On hold', 'TIT01', 1),
(5, 'The Grand Line', 'XGH', 'East blue', '1 year', 400000, 'Ongoing', 'CHH01', 1),
(7, 'Azure', 'DF', 'hdhdh7', 'ty57', 36346, 'Completed', NULL, NULL),
(15, 'safasfs', 'safsaf', 'dgfdgf', 'hfghfh', 5534636, 'Approval pending', 'TIT01', 3),
(16, 'fsafaf', 'dfgdfgdf', 'gsdgsdgds', 'fh54', 2523523, 'Approval pending', 'TIT01', 3),
(24, 'asf', 'mmmmmmmmmmmmmmmm', 'dfsdfsd', 'ffsdfsdf', 53453, 'Approval pending', 'CHH01', 2),
(26, 'wetwe', 'HJK', 'bsdgg', 'xcvxv', 43534, 'Approval pending', NULL, 3),
(28, 'fsdfsd', 'sfsafasas', 'sgdsdds', 'sdgsgsdg', 123124, 'Approval pending', NULL, 1),
(32, 'ddsaa', 'DF', 'asfasf', 'asfsaf', 324243, 'On hold', NULL, 1),
(34, 'sfaf', 'safsaf', 'asfafsf', 'asfasfas', 1234, 'Approval pending', NULL, 1),
(35, 'sdgds', 'fafafsa', 'gsdgds', 'sdgsdggd', 3244, 'On hold', 'CHH01', NULL),
(36, 'sdgsdg', 'asdasads', 'sdgsdg', 'sdgdsgd', 424, 'Approval pending', NULL, 2),
(37, 'dhdhh', 'dhdhdfh', 'dhdhdh', '4 months', 213141, 'Completed', NULL, NULL),
(38, 'sdgsd', 'gsdgsd', 'gdsgd', 'gsdgdgds', 213123, 'On hold', 'CHH01', 3),
(39, 'sdsd', 'gsdgsd', 'dsdgsdgd', '$fsadfsd4', 23235, 'Completed', NULL, NULL),
(40, 'fasf', 'asfasfa', 'fafas', 'fasfafa', 21321412, 'Approval pending', 'CHH01', NULL),
(41, 'dfdsgsdg', 'fasffsdfsd', 'sgsgs', 'sgsgsgs', 123124, 'Approval pending', NULL, NULL),
(46, 'sad', 'asfafs', 'afas', 'safsafa', 123213, 'Approval pending', NULL, NULL),
(47, 'asaf', 'afasfas', 'fasfas', 'asfafas', 123, 'Approval pending', NULL, NULL),
(48, 'dfwewe', 'rwerew', 'rwerwe', 'rwerwer', 2142, 'Approval pending', NULL, NULL),
(49, 'GFJAHJF', 'asfafhashj', 'dfjdjsdg', '10 months', 109032, 'Approval pending', NULL, NULL),
(50, 'hghgf', 'fghfgh', 'fgjf', 'fghgh', 200, 'Approval pending', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `waterSupplyIssue`
--

CREATE TABLE `waterSupplyIssue` (
  `issueID` int(11) NOT NULL,
  `IssueType` char(20) NOT NULL,
  `District` char(15) NOT NULL,
  `Location` varchar(100) NOT NULL,
  `DurationOfIssue` int(4) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `AwareMethod` char(15) DEFAULT NULL,
  `Status` char(32) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `adminID` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `waterSupplyIssue`
--

INSERT INTO `waterSupplyIssue` (`issueID`, `IssueType`, `District`, `Location`, `DurationOfIssue`, `Description`, `AwareMethod`, `Status`, `userID`, `adminID`) VALUES
(1, 'typ2', 'Hambantota', 'ambalangodaX', 30, 'sdgsdgsdgsdg', '', 'Further investigation required', NULL, 'TIT01'),
(3, 'typ2', 'Anuradhapura', 'WPXXXKK', 12, 'KKKKKKKKKKKHHHHHHHHHHHHHHHH', '', 'Verified', NULL, 'TIT01'),
(6, 'typ2', 'Ampara', 'dddd', 240, 'adadas', '', 'Pending..', 1, 'TIT01'),
(11, 'typ1', 'Colombo', 'LGhood', 120, 'gdgdgdhdhhg', 'Social Media', 'Verified', 20, NULL),
(12, 'typ2', 'Kandy', 'GHHHXCx', 200, 'agfagagddsdsgsd', '', 'Verified', NULL, 'TIT01'),
(13, 'typ2', 'Kandy', 'afasfas', 56, 'sdafasfasf', '', 'Verified', NULL, 'TIT01'),
(14, 'typ1', 'Kalutara', 'Gdhgg', 123, 'XXXXXXXXXXXXXX', 'SMS Alert', 'Pending..', 20, NULL),
(15, 'typ2', 'Jaffna', 'fasfasfaf', 200, 'sffgafasfasfasf', '', 'Verified', NULL, 'TIT01'),
(16, 'typ2', 'Gampaha', 'assaf', 4, 'fasf', '', 'Ignored', NULL, 'TIT01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `constructionCompany`
--
ALTER TABLE `constructionCompany`
  ADD PRIMARY KEY (`conComID`);

--
-- Indexes for table `fund`
--
ALTER TABLE `fund`
  ADD PRIMARY KEY (`fundID`),
  ADD KEY `donorID` (`donorID`),
  ADD KEY `orgDonorID` (`orgDonorID`),
  ADD KEY `fundRaiseID` (`fundRaiseID`);

--
-- Indexes for table `fundRaise`
--
ALTER TABLE `fundRaise`
  ADD PRIMARY KEY (`fundRaiseID`),
  ADD KEY `adminID` (`adminID`);

--
-- Indexes for table `infoProvider`
--
ALTER TABLE `infoProvider`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `organizationalDonor`
--
ALTER TABLE `organizationalDonor`
  ADD PRIMARY KEY (`orgDonorID`);

--
-- Indexes for table `personalDonor`
--
ALTER TABLE `personalDonor`
  ADD PRIMARY KEY (`donorID`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`projectID`),
  ADD KEY `adminID` (`adminID`),
  ADD KEY `conComID` (`conComID`);

--
-- Indexes for table `waterSupplyIssue`
--
ALTER TABLE `waterSupplyIssue`
  ADD PRIMARY KEY (`issueID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `adminID` (`adminID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `constructionCompany`
--
ALTER TABLE `constructionCompany`
  MODIFY `conComID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fund`
--
ALTER TABLE `fund`
  MODIFY `fundID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `fundRaise`
--
ALTER TABLE `fundRaise`
  MODIFY `fundRaiseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `infoProvider`
--
ALTER TABLE `infoProvider`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `organizationalDonor`
--
ALTER TABLE `organizationalDonor`
  MODIFY `orgDonorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personalDonor`
--
ALTER TABLE `personalDonor`
  MODIFY `donorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `projectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `waterSupplyIssue`
--
ALTER TABLE `waterSupplyIssue`
  MODIFY `issueID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fund`
--
ALTER TABLE `fund`
  ADD CONSTRAINT `fund_ibfk_1` FOREIGN KEY (`donorID`) REFERENCES `personalDonor` (`donorID`),
  ADD CONSTRAINT `fund_ibfk_2` FOREIGN KEY (`orgDonorID`) REFERENCES `organizationalDonor` (`orgDonorID`),
  ADD CONSTRAINT `fund_ibfk_3` FOREIGN KEY (`fundRaiseID`) REFERENCES `fundRaise` (`fundRaiseID`);

--
-- Constraints for table `fundRaise`
--
ALTER TABLE `fundRaise`
  ADD CONSTRAINT `fundRaise_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`);

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`),
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`conComID`) REFERENCES `constructionCompany` (`conComID`);

--
-- Constraints for table `waterSupplyIssue`
--
ALTER TABLE `waterSupplyIssue`
  ADD CONSTRAINT `waterSupplyIssue_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `infoProvider` (`userID`),
  ADD CONSTRAINT `waterSupplyIssue_ibfk_2` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
