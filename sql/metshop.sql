-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2017 at 01:49 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `clothing`
--

CREATE TABLE `clothing` (
  `id` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `price` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clothing`
--

INSERT INTO `clothing` (`id`, `type`, `price`) VALUES
(1, '4', 15),
(2, '2', 33),
(3, '0', 5);

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `gameName` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `gameGenre` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `gamePegi` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `gameName`, `gameGenre`, `gamePegi`) VALUES
(1, 'Test Igra III', '1', 15),
(2, 'IgrAaA', '4', 18);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ime` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `username`, `password`, `email`, `ime`, `prezime`, `token`) VALUES
(1, 'sava', '123', 'sava@gmail.com', 'Sava', 'Jeremic', '\01'),
(2, 'marko', '123', 'marko@gmail.com', 'marko', 'markovic', '\02'),
(3, 'asd', 'asd', 'asad@asd', 'asd', 'asd', '\03'),
(4, '123', '123', '123@asd', '123', '123', '\04'),
(5, 'testeraa', '12345', 'test@gmail.com', 'test1', 'test1ic', '\05'),
(6, 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', '6'),
(7, '1243123sz', 'a8f5f167f44f4964e6c998dee827110c', 'asdasd', 'asdasd', 'asdasd', 'fbdad3cd4b2189fc9c770fa5f0d539361c7e4671'),
(8, 'marecare', '0fd3ed07cf92bb97b3997da96220a72b', 'mare@gmail.com', 'marko', 'markovic', '616874bb6e4cea66976f9adf027cef3ea80a44d8'),
(9, 'jack96', '96d824b0865273d71bc65cafaa9eb37f', 'jack9666@gmail.com', 'Sava', 'Jeremic', 'a39eef6aed21cf0fa02bce170c1c589f56d22312');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clothing`
--
ALTER TABLE `clothing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clothing`
--
ALTER TABLE `clothing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
