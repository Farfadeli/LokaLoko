-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 05, 2023 at 03:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `entreprise`
--

CREATE TABLE `entreprise` (
  `NOM` varchar(64) NOT NULL,
  `Mail` varchar(127) NOT NULL,
  `Password` varchar(127) NOT NULL,
  `ID_Entreprise` int(11) NOT NULL,
  `ID_User` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `NOM` varchar(64) NOT NULL,
  `Quantite` int(11) NOT NULL,
  `Prix` float NOT NULL,
  `Type_Produit` varchar(24) NOT NULL,
  `ID_Entreprise` int(11) NOT NULL,
  `Service_demande` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `NOM` varchar(8) NOT NULL,
  `Prix` float NOT NULL,
  `Type_Service` varchar(8) NOT NULL,
  `ID_entreprise` int(11) NOT NULL,
  `Service_demande` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `NOM` varchar(64) NOT NULL,
  `Prenom` varchar(64) NOT NULL,
  `Mail` varchar(127) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `Type_Compte` char(24) NOT NULL,
  `ID` int(11) NOT NULL,
  `Latitude` float NOT NULL,
  `Longitude` float NOT NULL,
  `Profession` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`NOM`, `Prenom`, `Mail`, `Password`, `Type_Compte`, `ID`, `Latitude`, `Longitude`, `Profession`) VALUES
('LAMBRIGO', 'Yanis', 'yanis.la', '1234', 'Particul', 1, 0, 0, ''),
('ANouar', 'Anouar', 'Anouar', 'Anouar', 'Professi', 2, 0, 0, 'boucher ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`ID_Entreprise`),
  ADD KEY `User ID` (`ID_User`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD KEY `Entreprise ID` (`ID_Entreprise`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD KEY `Entreprise_ID` (`ID_entreprise`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `User ID` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID`);

--
-- Constraints for table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `Entreprise ID` FOREIGN KEY (`ID_Entreprise`) REFERENCES `entreprise` (`ID_Entreprise`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `Entreprise_ID` FOREIGN KEY (`ID_entreprise`) REFERENCES `entreprise` (`ID_Entreprise`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
