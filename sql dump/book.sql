-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2023 at 12:08 PM
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
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `isbn` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `edition` varchar(50) NOT NULL,
  `price` varchar(10) NOT NULL,
  `year` varchar(4) NOT NULL,
  `pub` varchar(50) NOT NULL,
  `imgUrl` varchar(200) NOT NULL,
  `author` varchar(100) NOT NULL,
  `cat` varchar(30) NOT NULL,
  `rack` varchar(10) NOT NULL,
  `shell` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`isbn`, `name`, `edition`, `price`, `year`, `pub`, `imgUrl`, `author`, `cat`, `rack`, `shell`) VALUES
('1234567890', 'Oliver Twist', '3rd', '200', '2023', 'Pearson', 'https://i2-prod.walesonline.co.uk/incoming/article6890072.ece/ALTERNATES/s615b/hp1.jpg', 'Mark Twain', 'Science', '21', '10'),
('2358529384782', 'Titanic', '20', '44444', '1190', 'Bruce ', 'https://d28hgpri8am2if.cloudfront.net/book_images/onix/cvr9781499811063/escape-from-the-titanic-9781499811063_hr.jpg', 'Bruce Wayne', 'Arts and Humanities', '1', '2'),
('6986239647', 'Harry potter', '2nd edition', '44500', '2017', 'Tony ', 'https://i2-prod.walesonline.co.uk/incoming/article6890072.ece/ALTERNATES/s615b/hp1.jpg', 'Hello', 'Education and Teaching', '4', '1'),
('9780078025402', 'Fundamentals of Financial Management', '14th', '120', '2014', 'McGraw-Hill Education', 'https://images-na.ssl-images-amazon.com/images/I/41lH-FzzMFL._SX385_BO1,204,203,200_.jpg', 'Eugene F. Brigham', 'Business and Careers', '10', '4'),
('9780134093413', 'Campbell Biology', '11th', '180', '2022', 'Pearson', 'https://images-na.ssl-images-amazon.com/images/I/51mBw8V54IL._SX398_BO1,204,203,200_.jpg', 'Jane B. Reece', 'Science', '5', '12'),
('9780316416765', 'Ready Player Two', '1st', '25', '2020', 'Ballantine Books', 'https://images-na.ssl-images-amazon.com/images/I/91bJv9YyMNL.jpg', 'Ernest Cline', 'English', '8', '2'),
('9780321926962', 'University Physics with Modern Physics', '14th', '220', '2015', 'Pearson', 'https://images-na.ssl-images-amazon.com/images/I/51XJJNFS0bL._SX396_BO1,204,203,200_.jpg', 'Hugh D. Young', 'Mathematics', '9', '3'),
('9780761169253', 'The 100', '1st', '10', '2012', 'Workman Publishing Company', 'https://images-na.ssl-images-amazon.com/images/I/51V8W-3qCWL._SX316_BO1,204,203,200_.jpg', 'Kass Morgan', 'Science Fiction', '7', '5'),
('9780789213147', 'The Art Book', '2nd', '45', '2020', 'Phaidon Press', 'https://images-na.ssl-images-amazon.com/images/I/61Z0ChfxckL._SX369_BO1,204,203,200_.jpg', 'Phaidon Editors', 'Arts and Humanities', '2', '7'),
('9781285177439', 'College Algebra', '10th', '100', '2015', 'Brooks Cole', 'https://images-na.ssl-images-amazon.com/images/I/41dYZv1fLrL._SX329_BO1,204,203,200_.jpg', 'Ron Larson', 'Mathematics', '7', '1'),
('9781449344184', 'Learning PHP, MySQL & JavaScript', '5th', '35', '2018', 'O\'Reilly Media, Inc.', 'https://images-na.ssl-images-amazon.com/images/I/51ZZy9bAtIL._SX379_BO1,204,203,200_.jpg', 'Robin Nixon', 'Technology and Engineering', '15', '6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`isbn`),
  ADD UNIQUE KEY `isbn` (`isbn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
