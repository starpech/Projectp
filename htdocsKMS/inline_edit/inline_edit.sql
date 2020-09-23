-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 15, 2020 at 06:00 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inline_edit`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp_database`
--

CREATE TABLE `emp_database` (
  `id` int(11) NOT NULL,
  `emp_name` varchar(250) NOT NULL,
  `emp_designation` varchar(250) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `emp_contact` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_database`
--

INSERT INTO `emp_database` (`id`, `emp_name`, `emp_designation`, `gender`, `emp_contact`) VALUES
(1, 'Delbert', 'iOS Developer', 'Male', '817-859-0974'),
(2, 'Raymond', 'Designer', 'Male', '650-732-0580'),
(4, 'Ernie', 'PHP Developer', 'Male', '262-257-8973'),
(5, 'Kevin', 'Designer', 'Male', '410-354-3440'),
(6, 'Joellen D Strader', 'Testing', 'Female', '520-730-5279'),
(7, 'Kimberly', 'Testing', 'Female', '540-852-9314'),
(8, 'Charles', 'PHP Developer', 'Male', '417-582-8065'),
(9, 'Gail J Prewitt', 'Designer', 'Female', '910-382-6759'),
(10, 'Dawn J Fordham', 'PHP Developer', 'Female', '252-218-8160'),
(11, 'Glen C Jones', 'iOS Developer', 'Male', '260-334-3988'),
(12, 'Natasha B Elmore', 'Testing', 'Female', '917-833-0240'),
(13, 'Mary R King', 'Support', 'Female', '913-458-5599'),
(14, 'Richard K Pedrosa', 'UI/UX ', 'Male', '815-675-5220'),
(15, 'Kayla', 'Testing', 'Female', '636-795-1670'),
(16, 'Caroline J Roy', 'UI/UX ', 'Female', '678-317-5195'),
(17, 'David S Soto', 'SEO Analyst', 'Male', '305-896-7204'),
(18, 'Orval A Hawkins', 'PHP Developer', 'Male', '360-967-2716'),
(19, 'Kevin H Green', 'Designer', 'Male', '662-416-3796');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp_database`
--
ALTER TABLE `emp_database`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emp_database`
--
ALTER TABLE `emp_database`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
