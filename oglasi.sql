-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2022 at 03:12 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oglasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `id_kategorije` int(11) NOT NULL,
  `naziv_kategorije` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id_kategorije`, `naziv_kategorije`) VALUES
(1, 'Administrativne i slicne usluge'),
(2, 'Arhitektonske usluge'),
(3, 'Bankarstvo'),
(4, 'Ekologija'),
(5, 'Ekonomija i finansije'),
(6, 'Elektrotehnika - Masinstvo'),
(7, 'Energetika'),
(8, 'IT'),
(9, 'Ljepota i zdravlje'),
(10, 'Nekretnine'),
(11, 'Turizam'),
(12, 'Zdravstvo'),
(13, 'Zanatske usluge'),
(14, 'Pravo'),
(15, 'Prehrambena industrija'),
(16, 'Ostalo');

-- --------------------------------------------------------

--
-- Table structure for table `kontakt`
--

CREATE TABLE `kontakt` (
  `id_kontakta` int(11) NOT NULL,
  `id_korisnika` int(11) NOT NULL,
  `ime_kontakta` varchar(100) DEFAULT NULL,
  `email_kontakta` varchar(100) NOT NULL,
  `poruka` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kontakt`
--

INSERT INTO `kontakt` (`id_kontakta`, `id_korisnika`, `ime_kontakta`, `email_kontakta`, `poruka`) VALUES
(1, 0, 'Aleksandar', 'aco.babic@gmail.com', 'Pozdrav'),
(2, 1, 'Aleksandar', 'ivana@gmail.com', 'Pozdrav');

-- --------------------------------------------------------

--
-- Table structure for table `mediji`
--

CREATE TABLE `mediji` (
  `id_medija` int(11) NOT NULL,
  `slika_medija` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mediji`
--

INSERT INTO `mediji` (`id_medija`, `slika_medija`) VALUES
(1, 'klix.jpg'),
(2, 'cnn.jpg'),
(3, 'bht.png');

-- --------------------------------------------------------

--
-- Table structure for table `premium_oglasi`
--

CREATE TABLE `premium_oglasi` (
  `id_pos` int(11) NOT NULL,
  `naziv_fir` varchar(100) NOT NULL,
  `log_firme` varchar(100) NOT NULL,
  `sj_firme` varchar(100) NOT NULL,
  `op_posla` varchar(255) NOT NULL,
  `datum_obj` date NOT NULL,
  `datum_is` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `premium_oglasi`
--

INSERT INTO `premium_oglasi` (`id_pos`, `naziv_fir`, `log_firme`, `sj_firme`, `op_posla`, `datum_obj`, `datum_is`) VALUES
(1, 'Microsoft', 'microsoft.png', 'Sarajevo', 'Programer', '2021-12-02', '2022-01-02'),
(2, 'Volkswagen', 'VW.png', 'Banjaluka', 'Radnik u računovodstvu', '2021-12-09', '2022-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `svioglasi`
--

CREATE TABLE `svioglasi` (
  `id_poslodavca` int(11) NOT NULL,
  `id_oglasa` int(11) NOT NULL,
  `naziv_firme` varchar(150) NOT NULL,
  `logo_firme` varchar(255) NOT NULL,
  `sjediste_firme` varchar(150) NOT NULL,
  `kategorija_id` int(11) NOT NULL,
  `opis_posla` varchar(255) NOT NULL,
  `datum_objavljivanja` date NOT NULL,
  `datum_isteka` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `svioglasi`
--

INSERT INTO `svioglasi` (`id_poslodavca`, `id_oglasa`, `naziv_firme`, `logo_firme`, `sjediste_firme`, `kategorija_id`, `opis_posla`, `datum_objavljivanja`, `datum_isteka`) VALUES
(1, 1, 'Mercedes', 'aaaa.jpg', 'Beograd', 14, 'Pravnik', '2021-12-20', '2022-01-20'),
(2, 2, 'Google', 'google.png', 'Sarajevo', 8, 'Software engineer', '2021-11-25', '2021-12-25'),
(1, 3, 'Nike', 'nike.png', 'Banjaluka', 16, 'Radnik u prodaji', '2021-12-09', '2022-01-09'),
(1, 4, 'Bosnalijek', '70f9b40e00a3476ed957f0b1e773b3ae.png', 'Sarajevo', 12, 'Farmaceut', '2021-12-20', '2022-01-20'),
(1, 5, 'Bingo', 'bingo-logo.jpg', 'Tuzla', 15, 'Prodavac', '2021-12-20', '2022-01-20'),
(1, 6, 'DM', 'Logo_of_dm-drogerie_markt.jpg', 'Sarajevo', 9, 'Prodavac', '2021-12-20', '2022-01-20'),
(1, 7, 'Klika', 'klika.png', 'Sarajevo', 8, 'Junior Developer', '2021-12-20', '2022-01-20'),
(1, 8, 'symphony.is', 'sym.jpg', 'Beograd', 8, 'Senior Developer', '2021-12-20', '2022-01-20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefon` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `firstname`, `lastname`, `email`, `telefon`, `password`) VALUES
(1, 'Aleksandar', 'Babic', 'aco.babic@gmail.com', '065291794', '$2y$10$FVMTB3jXIiry15oQzWjPfuYafQW/CXAsruvdtbNSo56DF5VmEF9D2'),
(2, 'Ivana ', 'Klepic', 'ivana@gmail.com', '+387652291794', '$2y$10$Oqvi64WEp3HqcCuQ/aztZer7yL4oHL2VfZHHA./FUIq1PG8o0LSAu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kontakt`
--
ALTER TABLE `kontakt`
  ADD PRIMARY KEY (`id_kontakta`);

--
-- Indexes for table `mediji`
--
ALTER TABLE `mediji`
  ADD PRIMARY KEY (`id_medija`);

--
-- Indexes for table `premium_oglasi`
--
ALTER TABLE `premium_oglasi`
  ADD PRIMARY KEY (`id_pos`);

--
-- Indexes for table `svioglasi`
--
ALTER TABLE `svioglasi`
  ADD PRIMARY KEY (`id_oglasa`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kontakt`
--
ALTER TABLE `kontakt`
  MODIFY `id_kontakta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `svioglasi`
--
ALTER TABLE `svioglasi`
  MODIFY `id_oglasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
