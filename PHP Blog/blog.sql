-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 nov 2023 om 13:52
-- Serverversie: 10.4.27-MariaDB
-- PHP-versie: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `post_id` int(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `name`, `message`, `created_on`) VALUES
(7, 1, 'Robin van Klaveren', 'Helemaal mee eens!', '2023-06-17 19:47:00'),
(8, 4, 'Robin van Klaveren', 'Klopt helemaal!', '2023-06-17 19:47:30');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `images`
--

CREATE TABLE `images` (
  `id` int(10) NOT NULL,
  `post_id` int(10) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_on` datetime DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `content`, `created_on`, `updated_on`, `deleted_on`, `user_id`) VALUES
(1, 'Een introductie voor PHP.', 'De basis van PHP.', 'PHP (PHP: Hypertext Preprocessor, vroeger Personal Home Page) is een scripttaal, die bedoeld is om op webservers dynamische webpagina\'s te creëren. PHP is in 1994 ontworpen door Rasmus Lerdorf, een senior softwareontwikkelaar bij IBM. Lerdorf gebruikte Perl als inspiratie. PHP wordt veel gebruikt om op webservers dynamisch webpagina\'s te creëren. De code van de pagina wordt op de webserver uitgevoerd en het resultaat wordt naar de computer van de bezoeker gestuurd en in de webbrowser getoond. PHP wordt voor allerlei webapplicaties gebruikt, zoals bulletinboards/forums, contentmanagementsystemen, blogs en wiki\'s. Uit een analyse van W3Techs in mei 2022 blijkt dat op 77,4% van alle webservers waarvan de programmeertaal bekend is, PHP wordt gebruikt.', NULL, '2023-06-17 19:44:02', NULL, 1),
(4, 'Hoe een database werkt.', 'Een database in het kort.', 'Een database, gegevensbank of databank is een (meestal digitaal opgeslagen) gegevensverzameling, ingericht met het oog op flexibele raadpleging en gebruik. Databases spelen een belangrijke rol bij het archiveren en actueel houden van gegevens van onder meer de overheid, financiële instellingen en bedrijven, in de wetenschap, en ze worden op kleinere schaal ook privé gebruikt. Databases zijn een essentieel onderdeel van de informatiemaatschappij, steeds meer gegevens worden in een database opgeslagen. Het functioneren van de overheid, bedrijven en wetenschap is tegenwoordig zonder databases ondenkbaar.', NULL, '2023-06-17 19:44:16', NULL, 1),
(7, 'Hoi', 'Hoi', 'Hoi', NULL, '2023-06-22 07:00:35', NULL, 1),
(8, 'Hoi', 'Hoi', 'Hoi', NULL, '2023-06-22 07:00:42', NULL, 1),
(9, 'Hoi', 'Hoi', 'Hoi', NULL, '2023-06-22 07:00:46', NULL, 1),
(10, 'Hoi', 'Hoi', 'Hoi', NULL, '2023-06-22 07:00:50', NULL, 1),
(11, 'Hoi', 'Hoi', 'Hoi', NULL, '2023-06-22 07:00:52', NULL, 1),
(12, 'Hoi', 'Hoi', 'Hoi', NULL, '2023-06-22 07:00:54', NULL, 1),
(13, 'Hoi', 'Hoi', 'Hoi', NULL, '2023-06-22 07:00:56', NULL, 1),
(14, 'Hoi', 'Hoi', 'Hoi', NULL, '2023-06-22 07:00:58', NULL, 1),
(15, 'Hoi', 'Hoi', 'Hoi', NULL, '2023-06-22 07:01:00', NULL, 1),
(16, 'Hoi', 'Hoi', 'Hoi', NULL, '2023-06-22 07:01:02', NULL, 1),
(17, 'Hoi', 'Hoi', 'Hoi', NULL, '2023-06-22 07:01:04', NULL, 1),
(18, 'Hoi', 'Hoi', 'Hoi', NULL, '2023-06-22 07:01:05', NULL, 1),
(19, 'Hoi', 'Hoi', 'Hoi', NULL, '2023-06-22 07:01:13', NULL, 1),
(20, 'Hoi', 'Hoi', 'Hoi', NULL, '2023-06-22 07:01:14', NULL, 1),
(21, 'Hoi', 'Hoi', 'Hoi', NULL, '2023-06-22 07:01:16', NULL, 1),
(22, 'Hoi', 'Hoi', 'Hoi', NULL, '2023-06-22 07:01:18', NULL, 1),
(23, 'Hoi', 'Hoi', 'Hoi', NULL, '2023-06-22 07:01:19', NULL, 1),
(24, 'Hoi', 'Hoi', 'Hoi', NULL, '2023-06-22 07:01:21', NULL, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `userpermissions`
--

CREATE TABLE `userpermissions` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `permission` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'RobinvK', '$2a$12$ouvP2iGH83nlAzyv3O9upePOhUva/F4ymcP77tK8Fxr4xFVjZiUsu');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexen voor tabel `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `userpermissions`
--
ALTER TABLE `userpermissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT voor een tabel `userpermissions`
--
ALTER TABLE `userpermissions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Beperkingen voor tabel `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Beperkingen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `userpermissions`
--
ALTER TABLE `userpermissions`
  ADD CONSTRAINT `userpermissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
