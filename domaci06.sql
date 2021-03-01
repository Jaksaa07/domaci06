-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2021 at 11:43 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `domaci06`
--

-- --------------------------------------------------------

--
-- Table structure for table `gradovi`
--

CREATE TABLE `gradovi` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `gradovi`
--

INSERT INTO `gradovi` (`id`, `ime`) VALUES
(1, 'Podgorica'),
(2, 'Bar'),
(3, 'Budva'),
(4, 'Bijelo Polje');

-- --------------------------------------------------------

--
-- Table structure for table `nekretnine`
--

CREATE TABLE `nekretnine` (
  `id` int(11) NOT NULL,
  `grad_id` int(11) NOT NULL,
  `tip_oglasa_id` int(11) NOT NULL,
  `tip_nekretnine_id` int(11) NOT NULL,
  `povrsina` decimal(10,0) NOT NULL,
  `cijena` decimal(10,0) NOT NULL,
  `godina_izgradnje` year(4) NOT NULL,
  `opis` text COLLATE utf8_bin NOT NULL,
  `fotografije` varchar(255) COLLATE utf8_bin NOT NULL,
  `status` tinyint(1) NOT NULL,
  `datum_prodaje` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `nekretnine`
--

INSERT INTO `nekretnine` (`id`, `grad_id`, `tip_oglasa_id`, `tip_nekretnine_id`, `povrsina`, `cijena`, `godina_izgradnje`, `opis`, `fotografije`, `status`, `datum_prodaje`) VALUES
(13, 3, 3, 3, '80', '24', 1976, 'Hic veritatis mollit', '', 0, NULL),
(15, 2, 2, 3, '26', '31', 2021, 'Totam consequatur c', '', 0, NULL),
(17, 1, 1, 2, '14', '37', 2034, 'Aliquip anim quisqua', '', 0, NULL),
(18, 1, 3, 4, '16', '77', 1988, 'Et earum eius ipsam ', '', 0, NULL),
(19, 2, 3, 4, '65', '19', 1996, 'Aute officia culpa ', '', 0, NULL),
(20, 1, 1, 1, '96', '22', 1981, 'Labore ut veritatis ', '', 0, NULL),
(22, 1, 1, 1, '51', '33', 1970, 'Quis totam tempor vo', '', 0, NULL),
(23, 1, 1, 2, '75', '71', 2061, 'Veniam et id ullam ', '', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tipovi_nekretnine`
--

CREATE TABLE `tipovi_nekretnine` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tipovi_nekretnine`
--

INSERT INTO `tipovi_nekretnine` (`id`, `ime`) VALUES
(1, 'stan'),
(2, 'kuca'),
(3, 'garaza'),
(4, 'poslovni_prostor');

-- --------------------------------------------------------

--
-- Table structure for table `tipovi_oglasa`
--

CREATE TABLE `tipovi_oglasa` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tipovi_oglasa`
--

INSERT INTO `tipovi_oglasa` (`id`, `ime`) VALUES
(1, 'prodaja'),
(2, 'iznajmljivanje'),
(3, 'kompenzacija');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gradovi`
--
ALTER TABLE `gradovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nekretnine`
--
ALTER TABLE `nekretnine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nekretnina_grad` (`grad_id`),
  ADD KEY `fk_nekretnina_tip_nekretnine` (`tip_nekretnine_id`),
  ADD KEY `fk_nekretnina_tip_oglasa` (`tip_oglasa_id`);

--
-- Indexes for table `tipovi_nekretnine`
--
ALTER TABLE `tipovi_nekretnine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipovi_oglasa`
--
ALTER TABLE `tipovi_oglasa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gradovi`
--
ALTER TABLE `gradovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nekretnine`
--
ALTER TABLE `nekretnine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tipovi_nekretnine`
--
ALTER TABLE `tipovi_nekretnine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tipovi_oglasa`
--
ALTER TABLE `tipovi_oglasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nekretnine`
--
ALTER TABLE `nekretnine`
  ADD CONSTRAINT `fk_nekretnina_grad` FOREIGN KEY (`grad_id`) REFERENCES `gradovi` (`id`),
  ADD CONSTRAINT `fk_nekretnina_tip_nekretnine` FOREIGN KEY (`tip_nekretnine_id`) REFERENCES `tipovi_nekretnine` (`id`),
  ADD CONSTRAINT `fk_nekretnina_tip_oglasa` FOREIGN KEY (`tip_oglasa_id`) REFERENCES `tipovi_oglasa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
