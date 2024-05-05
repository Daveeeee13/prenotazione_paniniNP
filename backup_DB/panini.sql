-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 05, 2024 alle 12:23
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
  `nome_gestionale` varchar(30) NOT NULL,
  `quantita` int(4) NOT NULL,
  `ingredienti` varchar(50) NOT NULL,
  `prezzo` double NOT NULL,
  `tipo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `listino`
--

INSERT INTO `listino` (`id`, `nome`, `nome_gestionale`, `quantita`, `ingredienti`, `prezzo`, `tipo`) VALUES
(1, 'Panino con cotto', 'panino_cotto', 40, 'prosciutto cotto', 2.5, 'panino'),
(2, 'Pizza Margherita', 'pizza_margherita', 35, 'pomodoro, mozzarella', 2.5, 'pizza'),
(3, 'Panino con soppressa', 'panino_soppressa', 30, 'soppressa', 2.5, 'panino'),
(4, 'Panino con crudo', 'panino_crudo', 35, 'prosciutto crudo', 2.5, 'panino'),
(5, 'Panino con formaggio', 'panino_formaggio', 40, 'formaggio asiago', 2.5, 'panino'),
(6, 'Brioche', 'brioche', 70, 'burro, crema chantilly', 3, 'brioche');

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazioni`
--

CREATE TABLE `prenotazioni` (
  `n_prenotazione` int(11) NOT NULL,
  `data_ritiro` date NOT NULL,
  `username` varchar(30) NOT NULL COMMENT 'username che ha eseguito la prenotazione',
  `panino_cotto` varchar(30) NOT NULL,
  `pizza_margherita` varchar(30) NOT NULL,
  `panino_soppressa` varchar(30) NOT NULL,
  `panino_crudo` varchar(30) NOT NULL,
  `panino_formaggio` varchar(30) NOT NULL,
  `brioche` varchar(30) NOT NULL,
  `plesso_ritiro` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `prenotazioni`
--

INSERT INTO `prenotazioni` (`n_prenotazione`, `data_ritiro`, `username`, `panino_cotto`, `pizza_margherita`, `panino_soppressa`, `panino_crudo`, `panino_formaggio`, `brioche`, `plesso_ritiro`) VALUES
(1, '2024-05-03', 'davide.c', '1', '0', '0', '0', '0', '1', 'Newton'),
(28, '2024-05-09', 'davide.c', '0', '1', '0', '0', '0', '0', 'Newton');

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
  `blacklist` varchar(2) NOT NULL,
  `data_registrazione` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`cf`, `username`, `pwd`, `nome`, `cognome`, `classe`, `sezione`, `n_aula`, `plesso`, `n_telefono`, `ruolo`, `blacklist`, `data_registrazione`) VALUES
('CRRDVD03C13B563N', 'guest', 'guest', 'nome', 'cognome', '3', 'AITI', 230, 'Pertini', '3407164115', 'user', 'no', '2024-05-03'),
('CRRDVD04C13B563N', 'davide.c', 'tiramisubest', 'Davide', 'Carraro', '5', 'AITT', 120, 'Newton', '3407164115', 'admin', 'no', '2024-05-03');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  MODIFY `n_prenotazione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
