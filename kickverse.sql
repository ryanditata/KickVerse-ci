-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jul 2025 pada 12.07
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kickverse`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-05-24-080824', 'App\\Database\\Migrations\\User', 'default', 'App', 1748074506, 1),
(2, '2025-05-24-080834', 'App\\Database\\Migrations\\Product', 'default', 'App', 1748074506, 1),
(3, '2025-05-24-080845', 'App\\Database\\Migrations\\Transaction', 'default', 'App', 1748074506, 1),
(4, '2025-05-24-080854', 'App\\Database\\Migrations\\TransactionDetail', 'default', 'App', 1748074506, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `jumlah` int(5) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `nama`, `harga`, `jumlah`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Nike Dunk Low Twist', 1200000, 6, 'sneaker14.png', '2025-05-24 08:19:56', '2025-07-17 08:32:37'),
(2, 'Nike Dunk Low LX', 1500000, 6, 'sneaker12.png', '2025-05-24 08:19:56', '2025-05-25 10:10:47'),
(3, 'Nike Dunk Low Retro', 2600000, 6, 'sneaker13.png', '2025-05-24 08:19:56', '2025-07-15 09:27:35'),
(7, 'Nike Air Force 1 07', 1400000, 10, 'sneaker11.png', '2025-06-29 09:02:22', '2025-06-29 10:10:13'),
(13, 'Nike Jordan', 2000000, 1, '1752741923_d9a5f28c4aa174aabc92.png', '2025-07-17 15:45:23', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `total_harga` double NOT NULL,
  `alamat` text NOT NULL,
  `ongkir` double DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`id`, `username`, `phone`, `total_harga`, `alamat`, `ongkir`, `status`, `created_at`, `updated_at`) VALUES
(29, 'Ryandita', '', 1240000, 'Jl. Lempongsari 1', 40000, 1, '2025-04-29 00:42:34', '2025-04-29 00:42:34'),
(30, 'Ryandita', '', 5240000, 'Jl. Imam Bonjol 11', 40000, 1, '2025-05-29 00:44:17', '2025-05-29 00:44:17'),
(31, 'Ryandita', '', 1570000, 'Jl. Raya Panunggalan', 70000, 1, '2025-05-29 00:45:49', '2025-05-29 00:45:49'),
(32, 'Ryandita', '', 5255000, 'Jl. Pahlawan', 55000, 0, '2025-06-29 00:50:17', '2025-06-29 00:50:17'),
(33, 'Elenanda', '', 1270000, 'Jl. Imam Bonjol 13', 70000, 0, '2025-06-29 00:51:52', '2025-06-29 00:51:52'),
(34, 'Denirori', '', 2660000, 'Jl. Gajah Mada', 60000, 0, '2025-06-29 00:52:59', '2025-06-29 00:52:59'),
(35, 'Ryandita', '', 10000000, 'Jl. R suprapto No.22', 700000, 0, '2025-06-29 17:25:08', '2025-06-29 17:25:08'),
(75, 'Elenanda', '082245523911', 2655000, 'Jl. Senopati No. 74, RT 008/RW 003, Kel. Selong, Kec. Kebayoran Baru, Kota Jakarta Selatan, DKI Jakarta, 12110', 55000, 0, '2025-07-24 16:21:22', '2025-07-24 16:21:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `transaction_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `jumlah` int(5) NOT NULL,
  `diskon` double DEFAULT NULL,
  `subtotal_harga` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaction_detail`
--

INSERT INTO `transaction_detail` (`id`, `transaction_id`, `product_id`, `jumlah`, `diskon`, `subtotal_harga`, `created_at`, `updated_at`) VALUES
(31, 29, 1, 1, 0, 1200000, '2025-04-29 00:42:34', '2025-04-29 00:42:34'),
(32, 30, 3, 2, 0, 5200000, '2025-05-29 00:44:17', '2025-05-29 00:44:17'),
(33, 31, 2, 1, 0, 1500000, '2025-05-29 00:45:49', '2025-05-29 00:45:49'),
(34, 32, 3, 2, 0, 5200000, '2025-06-29 00:50:17', '2025-06-29 00:50:17'),
(35, 33, 1, 1, 0, 1200000, '2025-06-29 00:51:52', '2025-06-29 00:51:52'),
(36, 34, 3, 1, 0, 2600000, '2025-06-29 00:52:59', '2025-06-29 00:52:59'),
(37, 35, 1, 2, 0, 2400000, '2025-06-29 17:25:08', '2025-06-29 17:25:08'),
(81, 75, 3, 1, 0, 2600000, '2025-07-24 16:21:22', '2025-07-24 16:21:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `phone`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Ryandita', 'Ryandita@gmail.com', '0895361206884', '$2y$10$TyttT0b1AcZn7FwIO3nu1O2x2tl2Lajm7I7y/k8DyVOxzJEa98wjC', 'admin', '2025-05-24 08:21:25', NULL),
(2, 'Elenanda', 'Elenanda@gmail.com', '082245523911', '$2y$10$PK/AL.pW665J..0hVJENYe3nHFASW0ukj5Zb8.IcOWemSx/nWe2vq', 'admin', '2025-05-24 08:21:25', NULL),
(3, 'Denirori', 'Denirori@gmail.com', '081358868376', '$2y$10$RFJl4b5A2hCHOj4umXWNJuVhYty9IXr4Rqc1FMFmrl8ErXYzYwtde', 'guest', '2025-05-24 08:21:25', NULL),
(4, 'pangeran.novitasari', 'zhandayani@gmail.co.id', '', '$2y$10$fJZGMYWZGYs73FVMBPpHxupmm.HRL.8WMxBOdalzEX1U5KnwTimCO', 'admin', '2025-05-24 08:21:26', NULL),
(5, 'pradana.darimin', 'cawisadi58@yahoo.co.id', '', '$2y$10$VLivy8syg1NxCGP72lu3iuT.eoEAnFqaHMZUkw6B5p9221oQym6US', 'guest', '2025-05-24 08:21:26', NULL),
(6, 'cakrawangsa.mandala', 'mayasari.putri@iswahyudi.desa.id', '', '$2y$10$KmBuxd5cKVN.XQFDDsp4hO6L7kFAOr655B/d4ZPzT9eKY9hEBvtsq', 'admin', '2025-05-24 08:21:26', NULL),
(7, 'harjo.pratiwi', 'haryanto.gambira@yahoo.co.id', '', '$2y$10$QuTkCw179hwGX.sOS0vks.wT9hkLOEjVe0h5JLZSdSi0m1nRlI6P2', 'admin', '2025-05-24 08:21:26', NULL),
(8, 'dimaz.yulianti', 'marsito.sitompul@gmail.co.id', '', '$2y$10$97nv9J7zMdAWxIjsYCbz/eA8Mzs49jFwgB//6E7pFGC7p164hcjBK', 'admin', '2025-05-24 08:21:26', NULL),
(9, 'tania81', 'hadi.pranowo@mulyani.name', '', '$2y$10$WfOeKqKTmHbKFCI8HW3om.nYUCiZR4D4hXp/K2QPKqtl3p4gC2L3m', 'admin', '2025-05-24 08:21:26', NULL),
(10, 'cici50', 'putra.dinda@hutasoit.in', '', '$2y$10$N.DKPVX9T6UtYfHsLAVIN.w/hvN0PIrRM5atkXcfo2.LD7rqp1zCK', 'guest', '2025-05-24 08:21:26', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `transaction_detail`
--
ALTER TABLE `transaction_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
