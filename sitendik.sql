-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jan 2020 pada 21.26
-- Versi server: 10.1.35-MariaDB
-- Versi PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sitendik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_log`
--

CREATE TABLE `tbl_log` (
  `id_log` int(11) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `type` varchar(50) NOT NULL,
  `log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_log`
--

INSERT INTO `tbl_log` (`id_log`, `userEmail`, `type`, `log`) VALUES
(1, 'fikriyogi@gmail.com', 'login', '2020-01-01 20:15:01'),
(2, 'fikriyogi@gmail.com', 'login', '2020-01-01 20:21:28'),
(3, 'fikriyogi@gmail.com', 'login', '2020-01-01 20:24:52'),
(4, 'fikriyogi@gmail.com', 'logout', '2020-01-01 20:25:02'),
(5, 'fikriyogi@gmail.com', 'login', '2020-01-01 20:25:34'),
(6, 'fikriyogi@gmail.com', 'logout', '2020-01-01 20:25:40'),
(7, 'almuallimin85@gmail.com', 'login', '2020-01-01 20:25:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_profil`
--

CREATE TABLE `tbl_profil` (
  `id_user` int(11) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_profil`
--

INSERT INTO `tbl_profil` (`id_user`, `hp`, `nama_lengkap`, `photo`) VALUES
(1, '55', 'Fikri Yogi, sss', '01012020202409-1'),
(2, '44', 'Khairul Fahri', '01012020201540-2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `userStatus` enum('Y','N') NOT NULL DEFAULT 'N',
  `userType` enum('4','3','2','1') NOT NULL,
  `tokenCode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_users`
--

INSERT INTO `tbl_users` (`userID`, `userName`, `userEmail`, `userPass`, `userStatus`, `userType`, `tokenCode`) VALUES
(1, 'fikriyogi', 'fikriyogi@gmail.com', '$2y$10$ks8kDKSHdM7OHWV/i1oc0uZxfLqAkMEa8HVc9xi1WMLIlh0ZbcRVa', 'Y', '4', 'e46297715fd70423c488e760d6ce598c'),
(2, 'fikriyogi', 'almuallimin85@gmail.com', '$2y$10$ks8kDKSHdM7OHWV/i1oc0uZxfLqAkMEa8HVc9xi1WMLIlh0ZbcRVa', 'Y', '4', '05a1ce331393e7fe340520736fb1d21e');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `tbl_profil`
--
ALTER TABLE `tbl_profil`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_profil`
--
ALTER TABLE `tbl_profil`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
