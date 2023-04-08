-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2023 at 10:27 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `imgUrl` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `name`, `email`, `no`, `state`, `password`, `imgUrl`) VALUES
('2346', 'savidu', 'savidumahasen@567gmail.com', '0756875656', 'active', '1234', 'https://www.google.com/imgres?imgurl=https%3A%2F%2Ficbt.lk%2Fwp-content%2Fuploads%2F2023%2F01%2FGihan.jpg&tbnid=VcXaR7HWMhgNTM&vet=12ahUKEwiAtcLgyJf-AhUP13MBHSDqCb8QMygAegUIARCcAQ..i&imgrefurl=https%3A%2F%2Ficbt.lk%2Fgihan_herath%2F&docid=9ev4Oml0bsgLbM&w=840&h=840&q=gihan%20icbt&ved=2ahUKEwiAtcLgyJf-AhUP13MBHSDqCb8QMygAegUIARCcAQ'),
('9540', 'Bruce Wayne', 'bruce@gmail.com', '0766786555', 'active', 'c4ca4238a0b923820dcc509a6f75849b', 'https://picsum.photos/200'),
('9563', 'Tony Stark', 'tony@gmail.com', '0766786225', 'active', 'c4ca4238a0b923820dcc509a6f75849b', 'https://picsum.photos/200'),
('9621', 'Peter Parker', 'peter@gmail.com', '0766786334', 'active', 'c4ca4238a0b923820dcc509a6f75849b', 'https://picsum.photos/200'),
('9783', 'Diana Prince', 'diana@gmail.com', '0766786443', 'active', 'c4ca4238a0b923820dcc509a6f75849b', 'https://picsum.photos/200'),
('9831', 'Steve Rogers', 'steve@gmail.com', '0766786552', 'active', 'c4ca4238a0b923820dcc509a6f75849b', 'https://picsum.photos/200'),
('9902', 'Clark Kent', 'clark@gmail.com', '0766786651', 'active', 'c4ca4238a0b923820dcc509a6f75849b', 'https://picsum.photos/200'),
('9910', 'Natasha Romanoff', 'natasha@gmail.com', '0766786760', 'active', 'c4ca4238a0b923820dcc509a6f75849b', 'https://picsum.photos/200'),
('9921', 'Arthur Curry', 'arthur@gmail.com', '0766786879', 'active', 'c4ca4238a0b923820dcc509a6f75849b', 'https://picsum.photos/200'),
('9943', 'Hal Jordan', 'hal@gmail.com', '0766786988', 'active', 'c4ca4238a0b923820dcc509a6f75849b', 'https://picsum.photos/200'),
('9956', 'Barry Allen', 'barry@gmail.com', '0766786097', 'active', 'c4ca4238a0b923820dcc509a6f75849b', 'https://picsum.photos/200');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
