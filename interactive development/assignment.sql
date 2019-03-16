-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2016 at 04:06 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `assignment`
--
CREATE DATABASE IF NOT EXISTS `assignment` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `assignment`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `user_name` varchar(15) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_name`, `password`) VALUES
('arman', 'Software1'),
('meharban', 'Seesame1');

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE IF NOT EXISTS `attendees` (
  `first_name` varchar(15) NOT NULL,
  `sur_name` varchar(15) NOT NULL,
  `birth_date` date NOT NULL,
  `mobile_number` int(11) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `password` varchar(10) NOT NULL,
  `confirm_password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`first_name`, `sur_name`, `birth_date`, `mobile_number`, `gender`, `password`, `confirm_password`) VALUES
('sifat', 'sultan', '1991-05-24', 416418024, 'Male', 'pizzahut', 'pizzahut'),
('Alisha', 'Panday', '1995-01-19', 450151398, 'Female', 'Alisharam', 'Alisharam'),
('Meharban', 'singh', '1995-07-23', 457542448, 'Male', 'Seesame1.', 'Seesame1.'),
('Gurkirt', 'singh', '1995-01-13', 473418999, 'Male', '0473418999', '0473418999');

-- --------------------------------------------------------

--
-- Table structure for table `bands`
--

CREATE TABLE IF NOT EXISTS `bands` (
`band_id` int(10) unsigned NOT NULL,
  `band_name` char(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bands`
--

INSERT INTO `bands` (`band_id`, `band_name`) VALUES
(1, 'Big Beats'),
(2, 'Kelly Roth'),
(3, 'Rollies'),
(4, 'The Boggletops'),
(6, 'The Ladder Coin');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
`booking_id` int(11) unsigned NOT NULL,
  `mob_number` int(11) NOT NULL,
  `concert_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `mob_number`, `concert_id`) VALUES
(1, 450151398, 1);

-- --------------------------------------------------------

--
-- Table structure for table `concerts`
--

CREATE TABLE IF NOT EXISTS `concerts` (
`concert_id` int(11) NOT NULL,
  `band_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `concert_date` date NOT NULL,
  `concert_time` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `concerts`
--

INSERT INTO `concerts` (`concert_id`, `band_id`, `venue_id`, `concert_date`, `concert_time`) VALUES
(1, 1, 1, '2016-09-01', '04:00:00'),
(2, 2, 2, '2016-09-04', '07:00:00'),
(3, 3, 3, '2016-09-05', '00:00:00'),
(4, 4, 3, '2016-09-21', '03:00:00'),
(5, 2, 1, '2018-02-12', '12:40:00'),
(6, 4, 1, '2017-09-02', '01:15:00'),
(7, 5, 4, '2017-09-02', '03:15:00'),
(8, 6, 1, '2016-09-14', '02:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE IF NOT EXISTS `venues` (
`venue_id` int(11) NOT NULL,
  `venue_name` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`venue_id`, `venue_name`) VALUES
(1, 'camboon hall'),
(2, 'the club'),
(3, 'savannah Lounge'),
(4, 'Stirling Club');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`user_name`);

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
 ADD PRIMARY KEY (`mobile_number`);

--
-- Indexes for table `bands`
--
ALTER TABLE `bands`
 ADD PRIMARY KEY (`band_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
 ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `concerts`
--
ALTER TABLE `concerts`
 ADD PRIMARY KEY (`concert_id`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
 ADD PRIMARY KEY (`venue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bands`
--
ALTER TABLE `bands`
MODIFY `band_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
MODIFY `booking_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `concerts`
--
ALTER TABLE `concerts`
MODIFY `concert_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
MODIFY `venue_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
