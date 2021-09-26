-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2021 at 02:47 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marcopolo`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `resetpassword` (`given_id` INT) RETURNS VARCHAR(255) CHARSET latin1 BEGIN

   DECLARE pass varchar(255);

   SET pass = (select LEFT(MD5(NOW()), 10));
   UPDATE user SET password = SHA1(pass) where id = given_id;

   RETURN pass;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(400) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `address`, `email`, `phone`, `logo`) VALUES
(1, 'Marcopolo Inn Guest House', '3th street, Taimani, Kabul, Afghanistan', 'marcopoloinn@gmail.com', '0795695703', '0'),
(2, 'Test', 'Test', 'test@test.com', '234242432', '0');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`id`, `name`, `lastName`, `email`, `phone`, `address`, `photo`, `userID`) VALUES
(1, 'Ritu', 'Rakish', 'ritu@gmail.com', '0093789877887', 'Kabul, Afghanistan', '', 1),
(4, 'Manoj', 'Agarwal', 'manoj@gmail.com', '0093789453454', 'Kabul, Afghanistan', 'CERTIFICATE-1.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `guestcompany`
--

CREATE TABLE `guestcompany` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guestcompanyroom`
--

CREATE TABLE `guestcompanyroom` (
  `id` int(11) NOT NULL,
  `guestCompanyID` int(11) DEFAULT NULL,
  `roomID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guestcompanyservice`
--

CREATE TABLE `guestcompanyservice` (
  `id` int(11) NOT NULL,
  `guestCompanyID` int(11) DEFAULT NULL,
  `serviceID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `guestID` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `roomID` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `checkin`, `checkout`, `guestID`, `type`, `roomID`, `status`) VALUES
(1, '2020-12-25', '2020-12-30', 1, 1, 1, 2),
(2, '2021-01-10', '2021-01-11', 1, 1, 1, 2),
(3, '2021-01-15', '2021-01-25', 1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `reservationservice`
--

CREATE TABLE `reservationservice` (
  `id` int(11) NOT NULL,
  `serviceID` int(11) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `roomNumber` varchar(5) NOT NULL,
  `details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `roomNumber`, `details`) VALUES
(1, '#1', 'SINGLE BED'),
(3, 'two', 'two bed'),
(4, 'ww', 'ww'),
(7, '#2', 'Double Bed');

-- --------------------------------------------------------

--
-- Table structure for table `roomimage`
--

CREATE TABLE `roomimage` (
  `id` int(11) NOT NULL,
  `roomID` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `type` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(100) NOT NULL,
  `companyId` int(11) DEFAULT NULL,
  `photo` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `last_name`, `type`, `username`, `email`, `password`, `is_active`, `entry_date`, `token`, `companyId`, `photo`) VALUES
(3, 'Mirwais', 'Doost', 1, 'mirwais', 'mirwaisdoost@hotmail.com', 'bcefac0265513b033d547a6bfbda14f97ea11cfc', 1, '0000-00-00 00:00:00', 'confirmed', 1, 'photo.jpg'),
(9, 'Mahmood', 'Doost', 1, 'mahmood', 'mahmood_doost@hotmail.com', '2c1d81f2dabbf66582369a1f77d213538178926f', 1, '2020-12-30 19:01:09', 'confirmed', 1, 'CERTIFICATE-2.jpg'),
(13, 'Hussain', 'Doost', 1, 'hussain', 'hussaindoost@gmail.com', '6eeac7b3c25ec6f24b8103db2e32f94230207eda', 1, '2021-01-22 14:13:15', 'confirmed', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guestcompany`
--
ALTER TABLE `guestcompany`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guestcompanyroom`
--
ALTER TABLE `guestcompanyroom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roomID` (`roomID`),
  ADD KEY `guestCompanyID` (`guestCompanyID`);

--
-- Indexes for table `guestcompanyservice`
--
ALTER TABLE `guestcompanyservice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `serviceID` (`serviceID`),
  ADD KEY `guestCompanyID` (`guestCompanyID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guestID` (`guestID`),
  ADD KEY `roomID` (`roomID`);

--
-- Indexes for table `reservationservice`
--
ALTER TABLE `reservationservice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `serviceID` (`serviceID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roomimage`
--
ALTER TABLE `roomimage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roomID` (`roomID`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companyId` (`companyId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `guestcompany`
--
ALTER TABLE `guestcompany`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guestcompanyroom`
--
ALTER TABLE `guestcompanyroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guestcompanyservice`
--
ALTER TABLE `guestcompanyservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservationservice`
--
ALTER TABLE `reservationservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roomimage`
--
ALTER TABLE `roomimage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guestcompanyroom`
--
ALTER TABLE `guestcompanyroom`
  ADD CONSTRAINT `guestcompanyroom_ibfk_2` FOREIGN KEY (`roomID`) REFERENCES `room` (`id`),
  ADD CONSTRAINT `guestcompanyroom_ibfk_3` FOREIGN KEY (`guestCompanyID`) REFERENCES `guestcompany` (`id`);

--
-- Constraints for table `guestcompanyservice`
--
ALTER TABLE `guestcompanyservice`
  ADD CONSTRAINT `guestcompanyservice_ibfk_2` FOREIGN KEY (`serviceID`) REFERENCES `service` (`id`),
  ADD CONSTRAINT `guestcompanyservice_ibfk_3` FOREIGN KEY (`guestCompanyID`) REFERENCES `guestcompany` (`id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`guestID`) REFERENCES `guest` (`id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`roomID`) REFERENCES `room` (`id`);

--
-- Constraints for table `reservationservice`
--
ALTER TABLE `reservationservice`
  ADD CONSTRAINT `reservationservice_ibfk_1` FOREIGN KEY (`serviceID`) REFERENCES `service` (`id`);

--
-- Constraints for table `roomimage`
--
ALTER TABLE `roomimage`
  ADD CONSTRAINT `roomimage_ibfk_1` FOREIGN KEY (`roomID`) REFERENCES `room` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `company` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
