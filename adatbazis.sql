-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Okt 19. 20:58
-- Kiszolgáló verziója: 10.4.19-MariaDB
-- PHP verzió: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `justphotos`
--
CREATE DATABASE IF NOT EXISTS `justphotos` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `justphotos`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `description` text COLLATE utf8_hungarian_ci NOT NULL,
  `filename` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `uploaded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `photos`
--

INSERT INTO `photos` (`id`, `title`, `description`, `filename`, `uploaded`) VALUES
(4, 'Kép #1', 'Leírás #1', '2023100917_21_36_lisbon-8268841_1280.jpg', '2023-10-09'),
(5, 'Ez is kép', 'Kacsa', '2023100917_22_51_goose-8290811_1280.jpg', '2023-10-09'),
(6, 'VajRepülő', 'Virágra száll, nem vajra.', '2023100917_23_45_butterfly-8231160_1280.jpg', '2023-10-09'),
(7, 'Finom kép', 'Nyami', '2023100917_24_06_salad-8274421_1280.jpg', '2023-10-09'),
(8, 'Tutyus', 'Nézd a szemét.', '2023101019_24_58_weimaraner-1381186_1920.jpg', '2023-10-10');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `photo_tag`
--

CREATE TABLE `photo_tag` (
  `p_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `photo_tag`
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
(40, 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `color` varchar(10) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `tags`
--

INSERT INTO `tags` (`id`, `name`, `color`) VALUES
(1, 'Dogs', 'primary'),
(2, 'Foods', 'success'),
(3, 'Animals', 'danger');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT a táblához `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
