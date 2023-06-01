-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 09:21 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `data` varchar(255) NOT NULL,
  `total` float NOT NULL,
  `count` int(32) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(40) NOT NULL,
  `user` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `user`) VALUES
('untao1bahqhg22qtcit9p6olo9', 'kairu');

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `artist` varchar(32) NOT NULL,
  `year` varchar(32) NOT NULL,
  `album` varchar(32) NOT NULL,
  `genre` varchar(32) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`id`, `title`, `artist`, `year`, `album`, `genre`, `price`) VALUES
(1, 'Stellar Stellar', 'Hoshimachi Suisei', '2021', 'Still Still Stellar', 'Pop', 4.99),
(2, 'Gunjo', 'Yoasobi', '2021', 'The Book', 'Pop', 5.99),
(3, 'GHOST', 'Hoshimachi Suisei', '2021', 'Still Still Stellar', 'Pop', 3.99),
(4, 'Silhouette', 'Kana-Boon', '2015', 'TIME', 'Rock', 4.49),
(5, 'Yoru ni Kakeru', 'Yoasobi', '2021', 'The Book', 'Pop', 5.99),
(6, 'Compared Child', 'TUYU', '2020', 'Its Raining After All', 'Rock', 7.49),
(7, 'Goodbye to Rock you', 'TUYU', '2020', 'Its Raining After All', 'Rock', 6.49),
(8, 'Michizure', 'Hoshimachi Suisei', '2023', 'Specter', 'Rock', 9.99),
(9, 'TEMPLATE', 'Hoshimachi Suisei', '2023', 'Specter', 'Rock', 9.49);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `fullname` varchar(32) NOT NULL,
  `address` varchar(64) NOT NULL,
  `email` varchar(32) NOT NULL,
  `data` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `address`, `email`, `data`) VALUES
(9, 'kairu', 'killjoy', 'Bonnie Kyle Estocapio', 'Baguio City', 'skyregalia028@gmail.com', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
