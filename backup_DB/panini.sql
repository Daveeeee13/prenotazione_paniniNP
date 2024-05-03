-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 03, 2024 alle 21:45
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
-- Database: `panini`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `listino`
--

CREATE TABLE `listino` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `quantita` int(4) NOT NULL,
  `ingredienti` varchar(50) NOT NULL,
  `prezzo` double NOT NULL,
  `tipo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `listino`
--

INSERT INTO `listino` (`id`, `nome`, `quantita`, `ingredienti`, `prezzo`, `tipo`) VALUES
(1, 'Panino con cotto', 40, 'prosciutto cotto', 2.5, 'panino'),
(2, 'Pizza Margherita', 35, 'pomodoro, mozzarella', 2.5, 'pizza'),
(3, 'Panino con soppressa', 30, 'soppressa', 2.5, 'panino'),
(4, 'Panino con crudo', 35, 'prosciutto crudo', 2.5, 'panino');

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazioni`
--

CREATE TABLE `prenotazioni` (
  `n_prenotazione` int(11) NOT NULL,
  `data_ritiro` date NOT NULL,
  `username` varchar(30) NOT NULL COMMENT 'username che ha eseguito la prenotazione',
  `messaggio` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `prenotazioni`
--

INSERT INTO `prenotazioni` (`n_prenotazione`, `data_ritiro`, `username`, `messaggio`) VALUES
(1, '2024-05-03', 'davide.c', '1 panino prosciutto cotto, 3 pizze'),
(17, '2024-05-16', 'davide.c', 'test');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `cf` varchar(16) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pwd` varchar(30) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `classe` varchar(10) NOT NULL,
  `sezione` varchar(10) NOT NULL,
  `n_aula` int(4) NOT NULL,
  `plesso` varchar(7) NOT NULL,
  `n_telefono` varchar(10) NOT NULL,
  `ruolo` varchar(5) NOT NULL,
  `blacklist` tinyint(1) NOT NULL,
  `data_registrazione` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`cf`, `username`, `pwd`, `nome`, `cognome`, `classe`, `sezione`, `n_aula`, `plesso`, `n_telefono`, `ruolo`, `blacklist`, `data_registrazione`) VALUES
('CRRDVD03C13B563N', 'guest', 'guest', 'nome', 'cognome', '3', 'AITI', 230, 'Pertini', '3407164115', 'user', 0, '2024-05-03'),
('CRRDVD04C13B563N', 'davide.c', 'tiramisubest', 'Davide', 'Carraro', '5', 'AITT', 120, 'Newton', '3407164115', 'admin', 0, '2024-05-03');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `listino`
--
ALTER TABLE `listino`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD PRIMARY KEY (`n_prenotazione`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`cf`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `listino`
--
ALTER TABLE `listino`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  MODIFY `n_prenotazione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
