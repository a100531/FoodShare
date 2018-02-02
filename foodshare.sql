-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2018 at 09:29 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodshare`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accounts`
--

CREATE TABLE `tbl_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(360) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `location` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `reports` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_accounts`
--

INSERT INTO `tbl_accounts` (`id`, `email`, `password`, `username`, `phone`, `location`, `name`, `surname`, `reports`) VALUES
(2, 'admin', '$2y$10$L/TQRfnibnCY9UItnsqQ6enEZh9926AMqIjz79MT3FKUxT34ATCu2', '', '', '', '', '', 0),
(5, 'dikmandu@gmail.com', '$2y$10$sJrKZHBX72zfPWp7Eg.78OItbjQbjkCCXB.2kvEtyqks9BRyqw.Hm', 'dumbshit', '99260514', 'Zurrieq', 'Dicky', 'Longy', 0),
(6, 'darren@gmail.com', '$2y$10$atlGtFfLiVaLUYQgHO1.YOnwRRvSILsdzRyRoU0bgc3PfLKiE9ZJu', 'darren', '69696969', 'Qajjenza', 'Darren', 'Camilleri', 4),
(10, 'cassardan0@gmail.com', '$2y$10$D1HM7SDFn2FgS0lp/BVmu.rtgX9fWu7KBtjU0dpyrSRrm/.fzIjVu', 'danzaq', '99260514', 'zurrieq', 'Daniel', 'Cassar', 0),
(11, 'joannumm@gmail.com', '$2y$10$Mo09qtVHYiu3UdaJTsDf7.aQSZN/9jMmF3tOKTB539h3VXv7br7o6', 'theKolme', '862174888', 'swieqi', 'Joana', 'New Melon', 0),
(12, 'jesus@gmail.com', '$2y$10$pRRvkP10aolGJqctZ5uvIuqL/de.JZYfh5LFlBLXT0LyplqQMIhdS', 'jesus', '99696969', 'zurrieq', 'Jesus', 'Nazarenus', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_posts`
--

CREATE TABLE `tbl_posts` (
  `posts_id` int(255) NOT NULL,
  `posts_product` varchar(100) NOT NULL,
  `posts_location` varchar(100) NOT NULL,
  `posts_phone` varchar(100) NOT NULL,
  `posts_expiry` int(255) NOT NULL,
  `posts_user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_posts`
--

INSERT INTO `tbl_posts` (`posts_id`, `posts_product`, `posts_location`, `posts_phone`, `posts_expiry`, `posts_user`) VALUES
(7, 'vegetable', 'Zurrieq', '21680601', 72, 'darren'),
(8, 'vegetables', 'zurrieq', '69696969', 1517430712, 'darren'),
(9, 'meat', 'zurrieq', '69696969', 1517430770, 'darren');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  ADD PRIMARY KEY (`posts_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `posts_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
