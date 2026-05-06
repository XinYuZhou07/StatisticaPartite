-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 06, 2026 alle 20:11
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `statistica`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `partite`
--

CREATE TABLE `partite` (
  `id` int(11) NOT NULL,
  `squadra1` varchar(50) DEFAULT NULL,
  `squadra2` varchar(50) DEFAULT NULL,
  `punteggio1` int(11) DEFAULT NULL,
  `punteggio2` int(11) DEFAULT NULL,
  `vincitore` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `partite`
--

INSERT INTO `partite` (`id`, `squadra1`, `squadra2`, `punteggio1`, `punteggio2`, `vincitore`) VALUES
(1, 'Manchester City', 'West Ham', 3, 1, 'Manchester City'),
(2, 'Arsenal', 'Everton', 2, 1, 'Arsenal'),
(3, 'Liverpool', 'Wolverhampton', 2, 0, 'Liverpool'),
(4, 'Sheffield United', 'Tottenham', 0, 3, 'Tottenham'),
(5, 'Chelsea', 'Bournemouth', 2, 1, 'Chelsea'),
(6, 'Brighton', 'Manchester United', 0, 2, 'Manchester United'),
(7, 'Manchester City', 'Arsenal', 0, 0, 'Pareggio'),
(8, 'Manchester United', 'Liverpool', 2, 2, 'Pareggio'),
(9, 'Chelsea', 'Manchester City', 4, 4, 'Pareggio'),
(10, 'Arsenal', 'Manchester City', 1, 0, 'Arsenal'),
(11, 'Aston Villa', 'Manchester City', 1, 0, 'Aston Villa'),
(12, 'Tottenham', 'Arsenal', 2, 3, 'Arsenal'),
(13, 'Liverpool', 'Chelsea', 4, 1, 'Liverpool'),
(14, 'Sheffield United', 'Newcastle', 0, 8, 'Newcastle'),
(15, 'Chelsea', 'Everton', 6, 0, 'Chelsea'),
(16, 'Crystal Palace', 'Manchester United', 4, 0, 'Crystal Palace'),
(17, 'Fulham', 'Manchester City', 0, 4, 'Manchester City'),
(18, 'Manchester City', 'Wolves', 5, 1, 'Manchester City'),
(19, 'Arsenal', 'Bournemouth', 3, 0, 'Arsenal'),
(20, 'Liverpool', 'Tottenham', 4, 2, 'Liverpool'),
(21, 'Manchester United', 'Newcastle', 3, 2, 'Manchester United'),
(22, 'Tottenham', 'Manchester City', 0, 2, 'Manchester City'),
(23, 'Everton', 'Liverpool', 2, 0, 'Everton'),
(24, 'Arsenal', 'Chelsea', 5, 0, 'Arsenal'),
(25, 'Fulham', 'Liverpool', 1, 3, 'Liverpool'),
(26, 'Manchester United', 'Sheffield United', 4, 2, 'Manchester United'),
(27, 'Brighton', 'Manchester City', 0, 4, 'Manchester City'),
(28, 'Newcastle', 'Tottenham', 4, 0, 'Newcastle'),
(29, 'Manchester City', 'Aston Villa', 4, 1, 'Manchester City'),
(30, 'Arsenal', 'Luton', 2, 0, 'Arsenal'),
(31, 'Bournemouth', 'Manchester City', 0, 1, 'Manchester City'),
(32, 'Arsenal', 'Newcastle', 4, 1, 'Arsenal'),
(33, 'Manchester United', 'Fulham', 1, 2, 'Fulham'),
(34, 'Liverpool', 'Luton', 4, 1, 'Liverpool'),
(35, 'Manchester City', 'Chelsea', 1, 1, 'Pareggio'),
(36, 'Burnley', 'Arsenal', 0, 5, 'Arsenal'),
(37, 'Brentford', 'Liverpool', 1, 4, 'Liverpool'),
(38, 'Aston Villa', 'Manchester United', 1, 2, 'Manchester United'),
(39, 'West Ham', 'Arsenal', 0, 6, 'Arsenal'),
(40, 'Manchester City', 'Everton', 2, 0, 'Manchester City'),
(41, 'Liverpool', 'Burnley', 3, 1, 'Liverpool'),
(42, 'Tottenham', 'Brighton', 2, 1, 'Tottenham'),
(43, 'Arsenal', 'Liverpool', 3, 1, 'Arsenal'),
(44, 'Manchester United', 'West Ham', 3, 0, 'Manchester United'),
(45, 'Chelsea', 'Wolves', 2, 4, 'Wolves'),
(46, 'Everton', 'Tottenham', 2, 2, 'Pareggio'),
(47, 'Liverpool', 'Chelsea', 4, 1, 'Liverpool'),
(48, 'Manchester City', 'Burnley', 3, 1, 'Manchester City'),
(49, 'Nottingham Forest', 'Arsenal', 1, 2, 'Arsenal'),
(50, 'Fulham', 'Everton', 0, 0, 'Pareggio');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `partite`
--
ALTER TABLE `partite`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `partite`
--
ALTER TABLE `partite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
