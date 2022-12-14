-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Des 2022 pada 04.59
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtracking`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alamat`
--

CREATE TABLE `alamat` (
  `id_alamat` int(11) NOT NULL,
  `kota_id` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `daerah` varchar(50) NOT NULL,
  `notelp` varchar(20) NOT NULL,
  `kdpos` varchar(20) NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `alamat`
--

INSERT INTO `alamat` (`id_alamat`, `kota_id`, `alamat`, `daerah`, `notelp`, `kdpos`, `createdAt`) VALUES
(1, 1, 'komplek pangkalan truk genuk blok aa 57-58', 'genuksari', '024-6584125', '50115', '2022-10-22 02:43:17'),
(2, 1, 'jl. puri anjasmoro raya blok dd1 no 16', 'puri anjasmoro', '024-xxxxxx', '50115', '2022-11-02 07:36:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang`
--

CREATE TABLE `cabang` (
  `id_cab` int(11) NOT NULL,
  `kota_id` int(11) NOT NULL,
  `kd_cab` varchar(50) NOT NULL,
  `nama_cab` varchar(50) NOT NULL,
  `jenis_cab` varchar(20) NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cabang`
--

INSERT INTO `cabang` (`id_cab`, `kota_id`, `kd_cab`, `nama_cab`, `jenis_cab`, `createdAt`) VALUES
(1, 1, 'cab001', 'cab-smg', 'cabang', '2022-10-20 03:49:21'),
(4, 11, 'cab002', 'cab-bdg', 'cabang', '2022-10-22 14:08:27'),
(5, 12, 'cab003', 'cab-jktb', 'cabang', '2022-10-22 14:15:01'),
(6, 13, 'cab004', 'cab-jktm', 'cabang', '2022-10-22 14:15:18'),
(7, 6, 'cab005', 'cab-solo', 'cabang', '2022-10-22 14:15:35'),
(8, 7, 'cab006', 'cab-yog', 'cabang', '2022-10-22 14:15:50'),
(9, 18, 'cab007', 'cab-mlg', 'cabang', '2022-10-22 14:16:15'),
(10, 19, 'cab008', 'cab-sby', 'cabang', '2022-10-22 14:16:29'),
(11, 22, 'cab009', 'cab-dps', 'cabang', '2022-10-22 14:16:48'),
(12, 1, 'cab010', 'agen a-smg', 'agen', '2022-10-22 14:17:22'),
(13, 1, 'cab011', 'agen b-smg', 'agen', '2022-10-22 14:17:37'),
(14, 2, 'cab012', 'agen-kds', 'agen', '2022-10-22 14:18:11'),
(15, 3, 'cab013', 'agen-ugr', 'agen', '2022-10-22 14:18:27'),
(16, 11, 'cab014', 'agen a-bdg', 'agen', '2022-10-25 15:26:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `delivagen`
--

CREATE TABLE `delivagen` (
  `id_delivagen` int(11) NOT NULL,
  `kd_delivagen` varchar(255) NOT NULL,
  `cab_id` int(11) NOT NULL,
  `kurir_id` int(11) NOT NULL,
  `total_reccu` int(11) NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `delivagen`
--

INSERT INTO `delivagen` (`id_delivagen`, `kd_delivagen`, `cab_id`, `kurir_id`, `total_reccu`, `createdAt`, `updatedAt`, `user_id`) VALUES
(1, '12agn11252022103555', 12, 9, 1, '2022-11-25 03:36:06', '2022-11-25 03:36:25', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `delivcab`
--

CREATE TABLE `delivcab` (
  `id_delivcab` int(11) NOT NULL,
  `kd_delivcab` varchar(255) NOT NULL,
  `kotaasal_id` int(11) NOT NULL,
  `kotatujuan_id` int(11) NOT NULL,
  `platno` varchar(20) NOT NULL,
  `total_reccu` int(11) NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `delivcab`
--

INSERT INTO `delivcab` (`id_delivcab`, `kd_delivcab`, `kotaasal_id`, `kotatujuan_id`, `platno`, `total_reccu`, `createdAt`, `updatedAt`, `user_id`) VALUES
(1, '4cab11122022220905', 11, 1, 'h 2365 ch', 2, '2022-11-12 15:09:22', '2022-11-15 03:20:59', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `delivlokal`
--

CREATE TABLE `delivlokal` (
  `id_delivlokal` int(11) NOT NULL,
  `kd_delivlokal` varchar(255) NOT NULL,
  `cab_id` int(11) NOT NULL,
  `kurir_id` int(11) NOT NULL,
  `total_reccu` int(11) NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `delivlokal`
--

INSERT INTO `delivlokal` (`id_delivlokal`, `kd_delivlokal`, `cab_id`, `kurir_id`, `total_reccu`, `createdAt`, `user_id`) VALUES
(1, '1lk12022022151640', 1, 7, 1, '2022-12-02 08:16:54', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_agen`
--

CREATE TABLE `detail_agen` (
  `id_detailagen` int(11) NOT NULL,
  `kd_delivagen` varchar(255) NOT NULL,
  `reccu` varchar(20) NOT NULL,
  `status` varchar(255) NOT NULL,
  `sentAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_agen`
--

INSERT INTO `detail_agen` (`id_detailagen`, `kd_delivagen`, `reccu`, `status`, `sentAt`) VALUES
(1, '12agn11252022103555', '878483', 'paket telah tiba di pool  - semarang', '2022-11-25 03:36:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_cab`
--

CREATE TABLE `detail_cab` (
  `id_detailcab` int(11) NOT NULL,
  `kd_delivcab` varchar(255) NOT NULL,
  `reccu` varchar(20) NOT NULL,
  `status` varchar(255) NOT NULL,
  `sentAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_cab`
--

INSERT INTO `detail_cab` (`id_detailcab`, `kd_delivcab`, `reccu`, `status`, `sentAt`) VALUES
(1, '4cab11122022220905', '343422', 'paket telah tiba di pool  - semarang', '2022-11-15 03:20:59'),
(2, '4cab11122022220905', '435325', 'paket telah tiba di pool  - semarang', '2022-11-15 03:20:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_lokal`
--

CREATE TABLE `detail_lokal` (
  `id_detaillokal` int(11) NOT NULL,
  `kd_delivlokal` varchar(255) NOT NULL,
  `reccu` varchar(20) NOT NULL,
  `status` varchar(255) NOT NULL,
  `sentAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_lokal`
--

INSERT INTO `detail_lokal` (`id_detaillokal`, `kd_delivlokal`, `reccu`, `status`, `sentAt`) VALUES
(1, '1lk12022022151640', '343422', 'paket disiapkan untuk dikirim ke alamat tujuan', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE `kota` (
  `id_kota` int(11) NOT NULL,
  `kd_kota` varchar(50) NOT NULL,
  `nama_kota` varchar(50) NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kota`
--

INSERT INTO `kota` (`id_kota`, `kd_kota`, `nama_kota`, `createdAt`) VALUES
(1, 'kt001', 'semarang', '2022-10-20 02:21:19'),
(2, 'kt002', 'kudus', '2022-10-20 02:56:29'),
(3, 'kt003', 'ungaran', '2022-10-20 02:56:56'),
(4, 'kt004', 'magelang', '2022-10-20 02:59:03'),
(6, 'kt005', 'solo', '2022-10-22 14:04:54'),
(7, 'kt006', 'yogyakarta', '2022-10-22 14:05:02'),
(8, 'kt007', 'pekalongan', '2022-10-22 14:05:23'),
(9, 'kt008', 'tegal', '2022-10-22 14:05:29'),
(10, 'kt009', 'cirebon', '2022-10-22 14:05:35'),
(11, 'kt010', 'bandung', '2022-10-22 14:05:40'),
(12, 'kt011', 'jakarta barat', '2022-10-22 14:05:48'),
(13, 'kt012', 'jakarta timur', '2022-10-22 14:05:55'),
(14, 'kt013', 'bekasi', '2022-10-22 14:06:00'),
(15, 'kt014', 'tangerang', '2022-10-22 14:06:05'),
(16, 'kt015', 'purwokerto', '2022-10-22 14:06:16'),
(17, 'kt016', 'bogor', '2022-10-22 14:06:35'),
(18, 'kt017', 'malang', '2022-10-22 14:07:13'),
(19, 'kt018', 'surabaya', '2022-10-22 14:07:19'),
(20, 'kt019', 'sidoarjo', '2022-10-22 14:07:25'),
(21, 'kt020', 'jember', '2022-10-22 14:07:29'),
(22, 'kt021', 'denpasar', '2022-10-22 14:07:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `kotaasal_id` int(11) NOT NULL,
  `kotatujuan_id` int(11) NOT NULL,
  `minimal` varchar(50) NOT NULL,
  `perkg` varchar(50) NOT NULL,
  `estimasi` varchar(50) NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `kotaasal_id`, `kotatujuan_id`, `minimal`, `perkg`, `estimasi`, `createdAt`) VALUES
(2, 1, 1, '35000', '1100', '1-2 hari', '2022-11-02 02:37:52'),
(3, 1, 2, '35000', '1500', '1-2 hari', '2022-11-02 04:38:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `kotaasal_id` int(11) NOT NULL,
  `kotatujuan_id` int(11) NOT NULL,
  `cabasal_id` int(11) NOT NULL,
  `cabtujuan_id` int(11) NOT NULL,
  `reccu` varchar(20) NOT NULL,
  `kd_paket` varchar(20) NOT NULL,
  `koli` varchar(20) NOT NULL,
  `pengirim` varchar(50) NOT NULL,
  `penerima` varchar(50) NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `receivedAt` timestamp NULL DEFAULT NULL,
  `lokalSentAt` timestamp NULL DEFAULT NULL,
  `cabSentAt` timestamp NULL DEFAULT NULL,
  `agenSentAt` timestamp NULL DEFAULT NULL,
  `successAt` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`id_paket`, `kotaasal_id`, `kotatujuan_id`, `cabasal_id`, `cabtujuan_id`, `reccu`, `kd_paket`, `koli`, `pengirim`, `penerima`, `createdAt`, `receivedAt`, `lokalSentAt`, `cabSentAt`, `agenSentAt`, `successAt`, `user_id`) VALUES
(1, 11, 1, 4, 1, '343422', '1 smg', '2', 'cab bdg', 'cab smg', '2022-11-12 15:08:16', '2022-11-15 03:20:59', '2022-12-02 08:16:54', '2022-11-12 15:09:22', NULL, NULL, 3),
(2, 11, 1, 4, 1, '435325', '2 smg', '3', 'cab bdg', 'cab smg', '2022-11-12 15:08:37', '2022-11-15 03:20:59', NULL, '2022-11-12 15:09:22', NULL, NULL, 3),
(3, 1, 11, 12, 4, '878483', '1 a bdg', '3', 'agen a', 'bandung', '2022-11-25 03:35:47', '2022-11-25 03:36:25', NULL, NULL, '2022-11-25 03:36:06', NULL, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `track`
--

CREATE TABLE `track` (
  `id_track` int(11) NOT NULL,
  `cab_id` int(11) NOT NULL,
  `reccu` varchar(20) NOT NULL,
  `status` varchar(255) NOT NULL,
  `actions` int(11) NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `track`
--

INSERT INTO `track` (`id_track`, `cab_id`, `reccu`, `status`, `actions`, `createdAt`, `user_id`) VALUES
(1, 4, '343422', 'paket telah diterima di cab-bdg', 1, '2022-11-12 15:08:16', 3),
(2, 4, '435325', 'paket telah diterima di cab-bdg', 1, '2022-11-12 15:08:37', 3),
(3, 4, '343422', 'paket disiapkan untuk dikirim ke cabang tujuan', 4, '2022-11-12 15:09:22', 3),
(4, 4, '435325', 'paket disiapkan untuk dikirim ke cabang tujuan', 4, '2022-11-12 15:09:22', 3),
(5, 1, '343422', 'paket telah tiba di pool  - semarang', 5, '2022-11-15 03:20:59', 12),
(6, 1, '435325', 'paket telah tiba di pool  - semarang', 5, '2022-11-15 03:20:59', 12),
(7, 12, '878483', 'paket telah diterima di agen a-smg', 1, '2022-11-25 03:35:47', 5),
(8, 12, '878483', 'paket disiapkan untuk dikirim ke pool - semarang', 2, '2022-11-25 03:36:06', 5),
(9, 1, '878483', 'paket telah tiba di pool  - semarang', 3, '2022-11-25 03:36:25', 12),
(10, 1, '343422', 'paket disiapkan untuk dikirim ke alamat tujuan', 6, '2022-12-02 08:16:54', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `userkota_id` int(11) NOT NULL,
  `usercab_id` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `role_access` varchar(20) NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `userkota_id`, `usercab_id`, `nama_user`, `username`, `pass`, `role_access`, `createdAt`) VALUES
(1, 1, 1, 'praga arya raharja', 'pragaarya', 'e10adc3949ba59abbe56e057f20f883e', 'superadmin', '2022-10-20 04:05:12'),
(2, 1, 1, 'test cab smg', 'cabsmg', 'e10adc3949ba59abbe56e057f20f883e', 'admcab', '2022-10-22 02:11:59'),
(3, 11, 4, 'cab bdg', 'cabbdg', 'e10adc3949ba59abbe56e057f20f883e', 'admcab', '2022-10-22 14:20:44'),
(4, 2, 14, 'agen kds', 'agenkds', 'e10adc3949ba59abbe56e057f20f883e', 'admagen', '2022-10-22 14:27:09'),
(5, 1, 12, 'agen a smg', 'agenasmg', 'e10adc3949ba59abbe56e057f20f883e', 'admagen', '2022-10-23 16:10:42'),
(6, 1, 13, 'agen b smg', 'agenbsmg', 'e10adc3949ba59abbe56e057f20f883e', 'admagen', '2022-10-23 18:17:10'),
(7, 1, 1, 'zainal', 'zainalloper', 'e10adc3949ba59abbe56e057f20f883e', 'kurir', '2022-10-24 07:12:25'),
(8, 1, 1, 'kiswanto', 'kisloper', 'e10adc3949ba59abbe56e057f20f883e', 'kurir', '2022-10-24 07:12:55'),
(9, 1, 1, 'gunawan', 'gunawan', 'e10adc3949ba59abbe56e057f20f883e', 'kurir', '2022-10-25 03:17:39'),
(10, 11, 16, 'agen a bdg', 'agenabdg', 'e10adc3949ba59abbe56e057f20f883e', 'admagen', '2022-10-26 07:46:47'),
(11, 11, 4, 'loper bdg', 'loperabdg', 'e10adc3949ba59abbe56e057f20f883e', 'kurir', '2022-10-26 07:48:50'),
(12, 1, 1, 'budi', 'budi', 'e10adc3949ba59abbe56e057f20f883e', 'mandor', '2022-11-15 03:14:19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`id_alamat`);

--
-- Indeks untuk tabel `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id_cab`);

--
-- Indeks untuk tabel `delivagen`
--
ALTER TABLE `delivagen`
  ADD PRIMARY KEY (`id_delivagen`);

--
-- Indeks untuk tabel `delivcab`
--
ALTER TABLE `delivcab`
  ADD PRIMARY KEY (`id_delivcab`);

--
-- Indeks untuk tabel `delivlokal`
--
ALTER TABLE `delivlokal`
  ADD PRIMARY KEY (`id_delivlokal`);

--
-- Indeks untuk tabel `detail_agen`
--
ALTER TABLE `detail_agen`
  ADD PRIMARY KEY (`id_detailagen`);

--
-- Indeks untuk tabel `detail_cab`
--
ALTER TABLE `detail_cab`
  ADD PRIMARY KEY (`id_detailcab`);

--
-- Indeks untuk tabel `detail_lokal`
--
ALTER TABLE `detail_lokal`
  ADD PRIMARY KEY (`id_detaillokal`);

--
-- Indeks untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indeks untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`id_track`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alamat`
--
ALTER TABLE `alamat`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id_cab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `delivagen`
--
ALTER TABLE `delivagen`
  MODIFY `id_delivagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `delivcab`
--
ALTER TABLE `delivcab`
  MODIFY `id_delivcab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `delivlokal`
--
ALTER TABLE `delivlokal`
  MODIFY `id_delivlokal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_agen`
--
ALTER TABLE `detail_agen`
  MODIFY `id_detailagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_cab`
--
ALTER TABLE `detail_cab`
  MODIFY `id_detailcab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `detail_lokal`
--
ALTER TABLE `detail_lokal`
  MODIFY `id_detaillokal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `track`
--
ALTER TABLE `track`
  MODIFY `id_track` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
