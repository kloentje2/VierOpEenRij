-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 03 jul 2017 om 20:58
-- Serverversie: 10.1.24-MariaDB
-- PHP-versie: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4opeenrij`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `game_sessions`
--

CREATE TABLE `game_sessions` (
  `id` int(11) NOT NULL,
  `userid1` int(11) NOT NULL,
  `userid2` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verlooptimestamp` datetime DEFAULT NULL,
  `speelveld` text NOT NULL,
  `gamehash` varchar(255) NOT NULL,
  `verlopen` enum('true','false') NOT NULL,
  `winnaar_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `game_sessions`
--

INSERT INTO `game_sessions` (`id`, `userid1`, `userid2`, `timestamp`, `verlooptimestamp`, `speelveld`, `gamehash`, `verlopen`, `winnaar_id`) VALUES
(18, 2, 4, '0000-00-00 00:00:00', NULL, '[[\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\"],[\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\"],[\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\"],[\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\"],[\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\"],[\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\"],[\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\"],[\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\",\"Leeg\"]]', 'bca923d1bcf42a1cc4d39ac10460ac204c0fca99', 'false', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `scores`
--

CREATE TABLE `scores` (
  `id` int(255) NOT NULL,
  `type` enum('win','gelijk','verloren') NOT NULL,
  `uid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` int(255) NOT NULL,
  `userid` int(255) NOT NULL,
  `type` enum('valid','invalid') NOT NULL,
  `skey` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `start_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stop_timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `sessions`
--

INSERT INTO `sessions` (`id`, `userid`, `type`, `skey`, `ip`, `start_timestamp`, `stop_timestamp`) VALUES
(3, 0, 'valid', '', '::1', '2017-07-01 18:10:50', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `level`) VALUES
(2, 'mail@koenhollander.nl', '$2y$10$8vXPbh0Q/F5/cVMtQNeSE.WmCWM9LKBB3nBBItz3RC.rrk0N4uUUy', 'user'),
(3, 'demo@speler.nl', '0', 'user'),
(4, '239389@cursist.rockopnh.nl', '', 'user');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `game_sessions`
--
ALTER TABLE `game_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `skey` (`skey`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `game_sessions`
--
ALTER TABLE `game_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT voor een tabel `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
