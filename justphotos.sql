-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2023 at 08:17 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `justphotos`
--

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `description` text COLLATE utf8_hungarian_ci NOT NULL,
  `userid` int(11) NOT NULL,
  `filename` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `uploaded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `title`, `description`, `userid`, `filename`, `uploaded`) VALUES
(4, 'Kép #1', 'Leírás #1', 1, '2023100917_21_36_lisbon-8268841_1280.jpg', '2023-10-09'),
(5, 'Ez is kép', 'Kacsa', 1, '2023100917_22_51_goose-8290811_1280.jpg', '2023-10-09'),
(6, 'VajRepülő', 'Virágra száll, nem vajra.', 1, '2023100917_23_45_butterfly-8231160_1280.jpg', '2023-10-09'),
(7, 'Finom kép', 'Nyami', 2, '2023100917_24_06_salad-8274421_1280.jpg', '2023-10-09'),
(8, 'Tutyus', 'Nézd a szemét.', 1, '2023101019_24_58_weimaraner-1381186_1920.jpg', '2023-10-10'),
(41, 'Cica', 'Miau', 1, '2023102009_13_17_cica.jpg', '2023-10-20');

-- --------------------------------------------------------

--
-- Table structure for table `photo_tag`
--

CREATE TABLE `photo_tag` (
  `p_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `photo_tag`
--

INSERT INTO `photo_tag` (`p_id`, `t_id`) VALUES
(8, 1),
(8, 3),
(6, 3),
(5, 3),
(7, 2),
(39, 2),
(39, 3),
(40, 2),
(40, 3),
(41, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `color` varchar(10) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `color`) VALUES
(1, 'Dogs', 'primary'),
(2, 'Foods', 'success'),
(3, 'Animals', 'danger');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'user', 'szemate03@gmail.com', '7815696ecbf1c96e6894b779456d330e'),
(2, 'user', 'asd@gmalo.lo', '7815696ecbf1c96e6894b779456d330e'),
(3, 'minta jános', 'proba@proba.hu', '7815696ecbf1c96e6894b779456d330e');

-- --------------------------------------------------------

--
-- Table structure for table `users_likes`
--

CREATE TABLE `users_likes` (
  `user_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `users_likes`
--

INSERT INTO `users_likes` (`user_id`, `photo_id`, `type`) VALUES
(1, 7, 0),
(1, 6, 0),
(1, 41, 1),
(3, 4, 1),
(1, 4, 1),
(1, 5, 1),
(1, 8, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
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
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
