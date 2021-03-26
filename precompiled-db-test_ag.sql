-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 26, 2021 alle 10:33
-- Versione del server: 10.1.40-MariaDB
-- Versione PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_ag`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `desserts`
--

CREATE TABLE `desserts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `available` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `desserts`
--

INSERT INTO `desserts` (`id`, `name`, `price`, `qty`, `available`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Torta Paradiso', 35, 5, 0, '2021-03-24 23:04:05', '2021-03-24 23:04:05', NULL),
(2, 'Torta Cioccolato', 15, 10, 0, '2021-03-25 22:06:39', '2021-03-25 22:06:39', NULL),
(3, 'Torta Crema', 20, 1, 1, '2021-03-26 00:00:20', '2021-03-26 00:00:20', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `desserts_ingredients`
--

CREATE TABLE `desserts_ingredients` (
  `id` int(11) NOT NULL,
  `dessert_id` int(11) DEFAULT NULL,
  `ingredient_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `desserts_ingredients`
--

INSERT INTO `desserts_ingredients` (`id`, `dessert_id`, `ingredient_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 2, '2021-03-25 23:15:28', '2021-03-25 23:15:28', NULL),
(2, 2, 4, '2021-03-25 23:15:28', '2021-03-25 23:15:28', '2021-03-09 00:00:00'),
(3, 2, 4, '2021-03-25 23:21:25', '2021-03-25 23:21:25', '2021-03-25 23:59:08'),
(4, 3, 2, '2021-03-26 00:00:20', '2021-03-26 00:00:20', NULL),
(5, 2, 4, '2021-03-26 00:09:47', '2021-03-26 00:09:47', NULL),
(6, 1, 2, '2021-03-26 00:29:07', '2021-03-26 00:29:07', NULL),
(7, 1, 4, '2021-03-26 00:29:07', '2021-03-26 00:29:07', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Farina 00', '2021-03-25 21:54:00', '2021-03-25 21:54:00', NULL),
(4, 'Cacao Amaro', '2021-03-25 21:59:53', '2021-03-25 21:59:53', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1616620165),
('m130524_201442_init', 1616620167),
('m190124_110200_add_verification_token_column_to_user_table', 1616620167),
('m210324_205557_create_table_desserts', 1616620167),
('m210324_205630_create_table_ingredients', 1616620167),
('m210324_210442_create_table_desserts_ingredients', 1616620167),
('m210324_211029_add_users_to_table_user', 1616620671);

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'luana', 'QTMx7QaF8WULqa32zYJOgLT9s22WD2Ha', '$2y$13$6LfCmET5NfYCKjQv3Jh0R.rHI8m0.YsEf.I8PrzjxGl2O3sjCTuka', NULL, 'luana@test.it', 10, 1616620670, 1616620670, NULL),
(2, 'maria', 'ZfpQJX-bHtdhggznJG40uZAKsiQlobeL', '$2y$13$uLA0t7ntpyGutoiB8K.T.OKPv9rKxueTtMqNIJyvEubG68vbmGKIq', NULL, 'maria@test.it', 10, 1616620671, 1616620671, NULL);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `desserts`
--
ALTER TABLE `desserts`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `desserts_ingredients`
--
ALTER TABLE `desserts_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_di_desserts` (`dessert_id`),
  ADD KEY `fk_di_ingredients` (`ingredient_id`);

--
-- Indici per le tabelle `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `desserts`
--
ALTER TABLE `desserts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `desserts_ingredients`
--
ALTER TABLE `desserts_ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `desserts_ingredients`
--
ALTER TABLE `desserts_ingredients`
  ADD CONSTRAINT `fk_di_desserts` FOREIGN KEY (`dessert_id`) REFERENCES `desserts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_di_ingredients` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
