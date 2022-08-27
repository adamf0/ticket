-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Agu 2022 pada 12.06
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipema`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_potongan`
--

CREATE TABLE `biaya_potongan` (
  `id` int(11) NOT NULL,
  `nama_beasiswa` varchar(100) NOT NULL,
  `persentase_potongan` int(11) NOT NULL,
  `id_item_bayar` int(11) NOT NULL,
  `id_tipe_biaya_potongan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kampus_data_gelombang`
--

CREATE TABLE `kampus_data_gelombang` (
  `id` int(11) NOT NULL,
  `nama_gelombang` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kampus_item_bayar`
--

CREATE TABLE `kampus_item_bayar` (
  `id` int(11) NOT NULL,
  `id_kampus` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `id_data_gelombang` int(11) NOT NULL,
  `tahun_akademik` date NOT NULL,
  `jumlah_angsuran` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kampus_mahasiswa`
--

CREATE TABLE `kampus_mahasiswa` (
  `id` int(11) NOT NULL,
  `nim` varchar(255) DEFAULT NULL,
  `nim_sementara` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` tinyint(1) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `id_mou` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kampus_mou`
--

CREATE TABLE `kampus_mou` (
  `id` int(11) NOT NULL,
  `no_mou` int(11) NOT NULL,
  `id_kampus` int(11) NOT NULL,
  `status_gelombang` int(11) NOT NULL,
  `max_reschedule` int(11) NOT NULL,
  `tanggal_dibuat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kampus_pembayaran`
--

CREATE TABLE `kampus_pembayaran` (
  `id` int(11) NOT NULL,
  `id_kampus` int(11) NOT NULL,
  `id_chanel_pembayaran` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kampus_prodi`
--

CREATE TABLE `kampus_prodi` (
  `id` int(11) NOT NULL,
  `id_kampus` int(11) NOT NULL,
  `kode_prodi` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenjang` varchar(255) NOT NULL,
  `masa_studi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kampus_rencana_mahasiswa`
--

CREATE TABLE `kampus_rencana_mahasiswa` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_item_bayar` int(11) NOT NULL,
  `id_biaya_potongan` int(11) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `biaya` int(11) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kampus_tagihan`
--

CREATE TABLE `kampus_tagihan` (
  `id` int(11) NOT NULL,
  `nomor_transaksi` varchar(200) NOT NULL,
  `tanggal` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kampus_tagihan_detail`
--

CREATE TABLE `kampus_tagihan_detail` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_tagihan_mahasiswa` int(11) NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kampus_template_item_bayar`
--

CREATE TABLE `kampus_template_item_bayar` (
  `id` int(11) NOT NULL,
  `id_kampus` int(11) NOT NULL,
  `template_item_bayar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_chanel_pembayaran`
--

CREATE TABLE `master_chanel_pembayaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_item`
--

CREATE TABLE `master_item` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_kampus`
--

CREATE TABLE `master_kampus` (
  `id` int(11) NOT NULL,
  `kode_kampus` varchar(255) NOT NULL,
  `nama_kampus` mediumtext NOT NULL,
  `singkatan` varchar(255) NOT NULL,
  `tahun_kerjasama` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_tipe_biaya_potonggan`
--

CREATE TABLE `master_tipe_biaya_potonggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `biaya_potongan`
--
ALTER TABLE `biaya_potongan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_item_bayar` (`id_item_bayar`),
  ADD KEY `id_tipe_biaya_potongan` (`id_tipe_biaya_potongan`);

--
-- Indeks untuk tabel `kampus_data_gelombang`
--
ALTER TABLE `kampus_data_gelombang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kampus_item_bayar`
--
ALTER TABLE `kampus_item_bayar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_kampus` (`id_kampus`),
  ADD KEY `id_data_gelombang` (`id_data_gelombang`);

--
-- Indeks untuk tabel `kampus_mahasiswa`
--
ALTER TABLE `kampus_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prodi` (`id_prodi`),
  ADD KEY `id_mou` (`id_mou`);

--
-- Indeks untuk tabel `kampus_mou`
--
ALTER TABLE `kampus_mou`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kampus` (`id_kampus`);

--
-- Indeks untuk tabel `kampus_pembayaran`
--
ALTER TABLE `kampus_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kampus` (`id_kampus`),
  ADD KEY `id_chanel_pembayaran` (`id_chanel_pembayaran`);

--
-- Indeks untuk tabel `kampus_prodi`
--
ALTER TABLE `kampus_prodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kampus` (`id_kampus`);

--
-- Indeks untuk tabel `kampus_rencana_mahasiswa`
--
ALTER TABLE `kampus_rencana_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_item_bayar` (`id_item_bayar`),
  ADD KEY `id_biaya_potongan` (`id_biaya_potongan`);

--
-- Indeks untuk tabel `kampus_tagihan`
--
ALTER TABLE `kampus_tagihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indeks untuk tabel `kampus_tagihan_detail`
--
ALTER TABLE `kampus_tagihan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_tagihan_mahasiswa` (`id_tagihan_mahasiswa`);

--
-- Indeks untuk tabel `kampus_template_item_bayar`
--
ALTER TABLE `kampus_template_item_bayar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `template_item_bayar_ibfk_1` (`id_kampus`);

--
-- Indeks untuk tabel `master_chanel_pembayaran`
--
ALTER TABLE `master_chanel_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_item`
--
ALTER TABLE `master_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_kampus`
--
ALTER TABLE `master_kampus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_tipe_biaya_potonggan`
--
ALTER TABLE `master_tipe_biaya_potonggan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `biaya_potongan`
--
ALTER TABLE `biaya_potongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kampus_data_gelombang`
--
ALTER TABLE `kampus_data_gelombang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kampus_item_bayar`
--
ALTER TABLE `kampus_item_bayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kampus_mahasiswa`
--
ALTER TABLE `kampus_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kampus_pembayaran`
--
ALTER TABLE `kampus_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kampus_prodi`
--
ALTER TABLE `kampus_prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kampus_rencana_mahasiswa`
--
ALTER TABLE `kampus_rencana_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kampus_tagihan`
--
ALTER TABLE `kampus_tagihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kampus_tagihan_detail`
--
ALTER TABLE `kampus_tagihan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kampus_template_item_bayar`
--
ALTER TABLE `kampus_template_item_bayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `master_chanel_pembayaran`
--
ALTER TABLE `master_chanel_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `master_item`
--
ALTER TABLE `master_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `master_kampus`
--
ALTER TABLE `master_kampus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `master_tipe_biaya_potonggan`
--
ALTER TABLE `master_tipe_biaya_potonggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `biaya_potongan`
--
ALTER TABLE `biaya_potongan`
  ADD CONSTRAINT `biaya_potongan_ibfk_1` FOREIGN KEY (`id_item_bayar`) REFERENCES `kampus_item_bayar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `biaya_potongan_ibfk_2` FOREIGN KEY (`id_tipe_biaya_potongan`) REFERENCES `master_tipe_biaya_potonggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kampus_item_bayar`
--
ALTER TABLE `kampus_item_bayar`
  ADD CONSTRAINT `kampus_item_bayar_ibfk_1` FOREIGN KEY (`id_kampus`) REFERENCES `master_kampus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kampus_item_bayar_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `master_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kampus_item_bayar_ibfk_3` FOREIGN KEY (`id_data_gelombang`) REFERENCES `kampus_data_gelombang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kampus_mahasiswa`
--
ALTER TABLE `kampus_mahasiswa`
  ADD CONSTRAINT `kampus_mahasiswa_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `kampus_prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kampus_mahasiswa_ibfk_2` FOREIGN KEY (`id_mou`) REFERENCES `kampus_mou` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kampus_mou`
--
ALTER TABLE `kampus_mou`
  ADD CONSTRAINT `kampus_mou_ibfk_1` FOREIGN KEY (`id_kampus`) REFERENCES `master_kampus` (`id`);

--
-- Ketidakleluasaan untuk tabel `kampus_pembayaran`
--
ALTER TABLE `kampus_pembayaran`
  ADD CONSTRAINT `kampus_pembayaran_ibfk_1` FOREIGN KEY (`id_chanel_pembayaran`) REFERENCES `master_chanel_pembayaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kampus_pembayaran_ibfk_2` FOREIGN KEY (`id_kampus`) REFERENCES `master_kampus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kampus_prodi`
--
ALTER TABLE `kampus_prodi`
  ADD CONSTRAINT `kampus_prodi_ibfk_1` FOREIGN KEY (`id_kampus`) REFERENCES `master_kampus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kampus_rencana_mahasiswa`
--
ALTER TABLE `kampus_rencana_mahasiswa`
  ADD CONSTRAINT `kampus_rencana_mahasiswa_ibfk_1` FOREIGN KEY (`id_item_bayar`) REFERENCES `kampus_item_bayar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kampus_rencana_mahasiswa_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `kampus_mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kampus_rencana_mahasiswa_ibfk_3` FOREIGN KEY (`id_biaya_potongan`) REFERENCES `biaya_potongan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kampus_tagihan`
--
ALTER TABLE `kampus_tagihan`
  ADD CONSTRAINT `kampus_tagihan_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `kampus_mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kampus_tagihan_detail`
--
ALTER TABLE `kampus_tagihan_detail`
  ADD CONSTRAINT `kampus_tagihan_detail_ibfk_1` FOREIGN KEY (`id_tagihan_mahasiswa`) REFERENCES `kampus_rencana_mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kampus_tagihan_detail_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `kampus_tagihan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kampus_template_item_bayar`
--
ALTER TABLE `kampus_template_item_bayar`
  ADD CONSTRAINT `kampus_template_item_bayar_ibfk_1` FOREIGN KEY (`id_kampus`) REFERENCES `master_kampus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
