-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2021 at 09:11 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wordoku`
--

-- --------------------------------------------------------

--
-- Table structure for table `words_list`
--

CREATE TABLE `words_list` (
  `id` int(5) NOT NULL,
  `word` varchar(81) NOT NULL,
  `length` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `words_list`
--

INSERT INTO `words_list` (`id`, `word`, `length`) VALUES
(2, 'fantastic', 9),
(4, 'princess', 8),
(5, 'real', 4),
(6, 'soccer', 6),
(7, 'stop', 4),
(8, 'yumyum', 6),
(10, 'Hoop', 4),
(12, 'home', 4),
(13, 'main', 4),
(14, 'ring', 4),
(15, 'మానవుడేమహ', 9),
(16, 'మానవుడేమహ', 9),
(17, 'మానవుడేమహ', 8),
(18, 'మానవుడేమహ', 4),
(19, 'మానవుడేమహ', 6),
(20, 'మానవుడేమహ', 9),
(22, 'hassan', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `words_list`
--
ALTER TABLE `words_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `words_list`
--
ALTER TABLE `words_list`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
