-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2020 at 03:36 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connections`
--

-- --------------------------------------------------------

--
-- Table structure for table `msgs`
--

CREATE TABLE `msgs` (
  `ID` int(5) NOT NULL,
  `to_email` varchar(100) NOT NULL,
  `from_email` varchar(100) NOT NULL,
  `msg` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msgs`
--

INSERT INTO `msgs` (`ID`, `to_email`, `from_email`, `msg`) VALUES
(1, 'najeebuddin09@gmail.com', 'ahmad@gmail.com', 'asdfasd'),
(2, 'najeebuddin09@gmail.com', 'ahmad@gmail.com', 'hello'),
(3, 'ahmad@gmail.com', 'najeebuddin09@gmail.com', 'asldkfjlaskdjflkasjdflkasjldfkjaslkdflaskjdflkasdjflkasjfdlkjasdlkfjasldkdjlaksjdflkasjdflkasjldfkjaslkfd'),
(4, 'najeebuddin09@gmail.com', 'ahmad@gmail.com', 'hi'),
(6, 'najeebuddin09@gmail.com', 'ahmad@gmail.com', 'To create a multi-line text input, use the HTML tag. You can set the size of a text area using the cols and rows attributes. It is used within a form, to allow users to input text over multiple rows.'),
(7, 'najeebuddin09@gmail.com', 'ahmad@gmail.com', 'Please note that the function does not check the live array, it actually checks the content received by php'),
(8, 'najeebuddin09@gmail.com', 'jamshidbacha@gmail.com', 'hi'),
(9, 'jamshidbacha@gmail.com', 'najeebuddin09@gmail.com', 'hello'),
(10, 'jamshidbacha@gmail.com', 'aslam@yahoo.com', 'hello'),
(11, 'jamshidbacha@gmail.com', 'najeebuddin09@gmail.com', 'asdf'),
(12, 'aslam@yahoo.com', 'najeebuddin09@gmail.com', 'asdf'),
(13, 'jamshidbacha@gmail.com', 'najeebuddin09@gmail.com', 'aslkdflksadjflkasjdflkjasjdflkjasldkfjalskjdflaksjdflkajsdlfkjaslkdjflaskdjflaksjdflkasjdflkasjdlfkjalsdkjfalskdjflaksjdflkajsdlfkjasldfkjaslkdfaslkfjlas;kjdflaskjdflaksjdflaksjdflkasjdflkasjdflkjasdlfkjaskdfjalkjdflasjdflkasjdlajflkasjlkdfjalskdjlka'),
(14, 'najeebuddin09@gmail.com', 'najeebuddin09@gmail.com', 'asdfasdfa'),
(15, 'najeebuddin09@gmail.com', 'amjidkhan@gmail.com', 'hi'),
(16, 'jamshidbacha@gmail.com', 'amjidkhan@gmail.com', 'hello'),
(17, 'najeebuddin09@gmail.com', 'amjidkhan@gmail.com', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `pic` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `email`, `pass`, `pic`) VALUES
('khan', 'kkhan@uet.com', 'kkhan', 'images\\12341601_955639584510602_3289995941544057509_n.jpg'),
('kamran khan', 'kamran@gmail.com', 'kamran', 'images\\jmm-ultimateextinction-2560.jpg'),
('Amjid Khan', 'amjidkhan@gmail.com', 'amjid', 'images\\4k-wallpaper-5.jpg'),
('aslam', 'aslam@yahoo.com', 'aslam', 'images\\jmm-ultimateextinction-2560.jpg'),
('Najeeb Uddin', 'najeebuddin09@gmail.com', 'abc123', 'images\\DSC_3292.JPG'),
('Jamshid Bacha', 'jamshidbacha@gmail.com', 'kkkan', 'images\\cat.jpg'),
('Ahmad', 'ahmad@gmail.com', 'khan', 'images\\cat.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `msgs`
--
ALTER TABLE `msgs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `msgs`
--
ALTER TABLE `msgs`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
