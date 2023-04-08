-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2023 at 12:18 PM
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
  `bookId` int(11) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `edition` varchar(50) NOT NULL,
  `price` varchar(10) NOT NULL,
  `year` varchar(4) NOT NULL,
  `pub` varchar(50) NOT NULL,
  `imgUrl` mediumtext NOT NULL,
  `author` varchar(100) NOT NULL,
  `cat` varchar(30) NOT NULL,
  `rack` varchar(10) NOT NULL,
  `shell` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bookId`, `isbn`, `name`, `edition`, `price`, `year`, `pub`, `imgUrl`, `author`, `cat`, `rack`, `shell`) VALUES
(1, '1234567890', 'Oliver Twist', '3rd', '200', '2023', 'Pearson', 'https://i2-prod.walesonline.co.uk/incoming/article6890072.ece/ALTERNATES/s615b/hp1.jpg', 'Mark Twain', 'Science', '21', '10'),
(2, '2358529384782', 'Titanic', '20', '44444', '1190', 'Bruce ', 'https://d28hgpri8am2if.cloudfront.net/book_images/onix/cvr9781499811063/escape-from-the-titanic-9781499811063_hr.jpg', 'Bruce Wayne', 'Arts and Humanities', '1', '2'),
(3, '6986239647', 'Harry potter', '2nd edition', '44500', '2017', 'Tony ', 'https://i2-prod.walesonline.co.uk/incoming/article6890072.ece/ALTERNATES/s615b/hp1.jpg', 'Hello', 'Education and Teaching', '4', '1'),
(19, '1234', 'Hello World 2', '5', '100', '2021', 'Tony Stark', 'https://cdn.cp.adobe.io/content/2/rendition/9231d555-36b8-43cf-9270-e0adfb6a9564/artwork/ea997594-eee5-44dd-9a88-bc5fd31abb80/version/0/format/jpg/dimension/width/size/400', 'Bruce Wayne', 'Civics and Government', '1', '3'),
(20, '1234', 'Hello World 2', '5', '100', '2021', 'Tony Stark', 'https://cdn.cp.adobe.io/content/2/rendition/9231d555-36b8-43cf-9270-e0adfb6a9564/artwork/ea997594-eee5-44dd-9a88-bc5fd31abb80/version/0/format/jpg/dimension/width/size/400', 'Bruce Wayne', 'Civics and Government', '1', '3'),
(31, '1234567890', 'Oliver Twist', '3rd', '200', '2023', 'Pearson', 'https://i2-prod.walesonline.co.uk/incoming/article6890072.ece/ALTERNATES/s615b/hp1.jpg', 'Mark Twain', 'Science', '21', '10'),
(32, '1234567890', 'Oliver Twist', '3rd', '200', '2023', 'Pearson', 'https://i2-prod.walesonline.co.uk/incoming/article6890072.ece/ALTERNATES/s615b/hp1.jpg', 'Mark Twain', 'Science', '21', '10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bookId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `bookId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
