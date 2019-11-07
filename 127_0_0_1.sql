-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2019 at 10:22 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `allcare`
--
CREATE DATABASE IF NOT EXISTS `allcare` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `allcare`;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `sno` int(11) NOT NULL,
  `uid` varchar(500) NOT NULL,
  `address` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`sno`, `uid`, `address`) VALUES
(8, 'qnfn0qBoncXRsgviRqEgvQmnCug1', '[{\"name\":\"Shubham Kumar\",\"phone\":\"7033265522\",\"pin\":\"828207\",\"add1\":\"Qtr TWB 10a\",\"add2\":\"\",\"land\":\"jdshjkl\",\"city\":\"vbnm,.\",\"state\":\"fgbnm,.\",\"$$hashKey\":\"object:3\"},{\"name\":\"wertyuio\",\"phone\":\"7903856844\",\"pin\":\"144411\",\"add1\":\"qwertyuio\",\"add2\":\"ertyujkl\",\"land\":\"wertyukil\",\"city\":\"ertyujkil\",\"state\":\"ertyukl;\",\"$$hashKey\":\"object:4\"},{\"name\":\"wertyu\",\"phone\":\"9431514622\",\"pin\":\"144411\",\"add1\":\"qwertyuio\",\"add2\":\"ertyui\",\"land\":\"rtyuio\",\"city\":\"wertyuiq\",\"state\":\"wertyuiop\",\"$$hashKey\":\"object:7\"},{\"name\":\"wertyu\",\"phone\":\"9431514622\",\"pin\":\"144411\",\"add1\":\"qwertyuio\",\"add2\":\"ertyui\",\"land\":\"rtyuio\",\"city\":\"wertyuiq\",\"state\":\"wertyuiop\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `carpenters`
--

CREATE TABLE `carpenters` (
  `sno` int(11) NOT NULL,
  `data` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carpenters`
--

INSERT INTO `carpenters` (`sno`, `data`) VALUES
(1, '[{\"image\":\"carpenter.jpg\",\"name\":\"Mani Carpenter House\",\"desc\":\"Specializes in all types of furnitures. 10+ years of experience.\",\"location\":\"Shop 8 , New market, Imaginary World\",\"rate\":\"Rs 300/hr \",\"rating\":\"4.5/5\"},{\"image\":\"carpenter.jpg\",\"name\":\"Goldi Wood Works\",\"desc\":\"Think Wood, Think Goldi.\",\"location\":\"Mittu Basti Road, Dream World\",\"rate\":\"Rs 350/hr \",\"rating\":\"4.1/5\"},{\"image\":\"carpenter.jpg\",\"name\":\"Mani Carpenter House\",\"desc\":\"Specializes in all types of furnitures. 10+ years of experience.\",\"location\":\"Shop 8 , New arket, Imaginary World\",\"rate\":\"Rs 300/hr \",\"rating\":\"4.5/5\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `electrician`
--

CREATE TABLE `electrician` (
  `sno` int(11) NOT NULL,
  `data` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `electrician`
--

INSERT INTO `electrician` (`sno`, `data`) VALUES
(1, '[{\"image\":\"electrician.jpg\",\"name\":\"Sai Electrician\",\"desc\":\"We undertake all type of electric works.\",\"location\":\"Sneaky Street ,Bumingham\",\"rate\":\"Rs 200/hr \",\"rating\":\"4.5/5\"},{\"image\":\"electrician.jpg\",\"name\":\"Sukhvir Electrical\",\"desc\":\"Work like no one else.\",\"location\":\"Solomon St., Sabinis\",\"rate\":\"Rs 400/hr \",\"rating\":\"4.1/5\"},{\"image\":\"electrician.jpg\",\"name\":\"Rimpi Elctroworld\",\"desc\":\"Customer satisfaction is our top priority.\",\"location\":\"Shop 8 , New market, Imaginary World\",\"rate\":\"Rs 300/hr \",\"rating\":\"4.5/5\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `time` double NOT NULL,
  `uid` varchar(1000) NOT NULL,
  `product` varchar(1000) NOT NULL,
  `address` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`time`, `uid`, `product`, `address`) VALUES
(1572894131, 'qnfn0qBoncXRsgviRqEgvQmnCug1', '{\"image\":\"electrician.jpg\",\"name\":\"Sukhvir Electrical\",\"desc\":\"Work like no one else.\",\"location\":\"Solomon St., Sabinis\",\"rate\":\"Rs 400/hr \",\"rating\":\"4.1/5\",\"$$hashKey\":\"object:10\"}', '{\"name\":\"Shubham Kumar\",\"phone\":\"7033265522\",\"pin\":\"828207\",\"add1\":\"Qtr TWB 10a\",\"add2\":\"\",\"land\":\"jdshjkl\",\"city\":\"vbnm,.\",\"state\":\"fgbnm,.\",\"$$hashKey\":\"object:3\"}'),
(1572895605, 'qnfn0qBoncXRsgviRqEgvQmnCug1', '{\"image\":\"electrician.jpg\",\"name\":\"Sai Electrician\",\"desc\":\"We undertake all type of electric works.\",\"location\":\"Sneaky Street ,Bumingham\",\"rate\":\"Rs 200/hr \",\"rating\":\"4.5/5\",\"$$hashKey\":\"object:9\"}', '{\"name\":\"wertyuio\",\"phone\":\"7903856844\",\"pin\":\"144411\",\"add1\":\"qwertyuio\",\"add2\":\"ertyujkl\",\"land\":\"wertyukil\",\"city\":\"ertyujkil\",\"state\":\"ertyukl;\",\"$$hashKey\":\"object:4\"}'),
(1572895622, 'qnfn0qBoncXRsgviRqEgvQmnCug1', '{\"image\":\"carpenter.jpg\",\"name\":\"Mani Carpenter House\",\"desc\":\"Specializes in all types of furnitures. 10  years of experience.\",\"location\":\"Shop 8 , New market, Imaginary World\",\"rate\":\"Rs 300/hr \",\"rating\":\"4.5/5\",\"$$hashKey\":\"object:3\"}', '{\"name\":\"wertyu\",\"phone\":\"9431514622\",\"pin\":\"144411\",\"add1\":\"qwertyuio\",\"add2\":\"ertyui\",\"land\":\"rtyuio\",\"city\":\"wertyuiq\",\"state\":\"wertyuiop\",\"$$hashKey\":\"object:5\"}'),
(1573115630, 'qnfn0qBoncXRsgviRqEgvQmnCug1', '{\"image\":\"carpenter.jpg\",\"name\":\"Mani Carpenter House\",\"desc\":\"Specializes in all types of furnitures. 10  years of experience.\",\"location\":\"Shop 8 , New market, Imaginary World\",\"rate\":\"Rs 300/hr \",\"rating\":\"4.5/5\",\"$$hashKey\":\"object:3\"}', '{\"name\":\"wertyuio\",\"phone\":\"7903856844\",\"pin\":\"144411\",\"add1\":\"qwertyuio\",\"add2\":\"ertyujkl\",\"land\":\"wertyukil\",\"city\":\"ertyujkil\",\"state\":\"ertyukl;\",\"$$hashKey\":\"object:4\"}');

-- --------------------------------------------------------

--
-- Table structure for table `plumbers`
--

CREATE TABLE `plumbers` (
  `sno` int(11) NOT NULL,
  `data` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plumbers`
--

INSERT INTO `plumbers` (`sno`, `data`) VALUES
(1, '[{\"image\":\"carpenter.jpg\",\"name\":\"Mani Carpenter House\",\"desc\":\"Specializes in all types of furnitures. 10+ years of experience.\",\"location\":\"Shop 8 , New market, Imaginary World\",\"rate\":\"Rs 300/hr \",\"rating\":\"4.5/5\"},{\"image\":\"carpenter.jpg\",\"name\":\"Goldi Wood Works\",\"desc\":\"Think Wood, Think Goldi.\",\"location\":\"Mittu Basti Road, Dream World\",\"rate\":\"Rs 350/hr \",\"rating\":\"4.1/5\"},{\"image\":\"carpenter.jpg\",\"name\":\"Mani Carpenter House\",\"desc\":\"Specializes in all types of furnitures. 10+ years of experience.\",\"location\":\"Shop 8 , New arket, Imaginary World\",\"rate\":\"Rs 300/hr \",\"rating\":\"4.5/5\"}]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `carpenters`
--
ALTER TABLE `carpenters`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `electrician`
--
ALTER TABLE `electrician`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD UNIQUE KEY `time` (`time`);

--
-- Indexes for table `plumbers`
--
ALTER TABLE `plumbers`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `carpenters`
--
ALTER TABLE `carpenters`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `electrician`
--
ALTER TABLE `electrician`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plumbers`
--
ALTER TABLE `plumbers`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
