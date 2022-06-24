-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 23 Jun 2022 pada 05.47
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kereta_api2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gerbong`
--

CREATE TABLE `gerbong` (
  `id_gerbong` char(10) NOT NULL,
  `kelas_gerbong` enum('EKSEKUTIF','BISNIS','EKONOMI') NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `id_kereta` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gerbong`
--

INSERT INTO `gerbong` (`id_gerbong`, `kelas_gerbong`, `kapasitas`, `harga`, `id_kereta`) VALUES
('1', 'EKSEKUTIF', 14, 20000, 'KAI0001'),
('2', 'EKONOMI', 14, 20000, 'KAI0001'),
('3', 'BISNIS', 10, 50000, 'KAI0001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_kereta` char(10) NOT NULL,
  `stasiun_awal` varchar(30) NOT NULL,
  `stasiun_tujuan` varchar(30) NOT NULL,
  `kedatangan` char(5) NOT NULL,
  `keberangkatan` char(5) NOT NULL,
  `harga_tiket` int(11) NOT NULL,
  `tgl_berangkat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_kereta`, `stasiun_awal`, `stasiun_tujuan`, `kedatangan`, `keberangkatan`, `harga_tiket`, `tgl_berangkat`) VALUES
(16, 'KAI0001', 'awal', 'tujuan', '06:05', '06:05', 30000, '2022-06-21'),
(17, 'KAI0001', 'awal 2', 'tujuan 2', '06:06', '06:06', 10000, '2022-06-23'),
(20, 'KAI0005', 'sawal', 'sakhir', '10:26', '10:26', 25000, '2022-06-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kereta`
--

CREATE TABLE `kereta` (
  `id_kereta` char(10) NOT NULL,
  `nama_kereta` varchar(30) NOT NULL,
  `gerbong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kereta`
--

INSERT INTO `kereta` (`id_kereta`, `nama_kereta`, `gerbong`) VALUES
('KAI0001', 'JAKA BA', 15),
('KAI0005', 'Kereta 5', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penumpang`
--

CREATE TABLE `penumpang` (
  `id_penumpang` char(10) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_penumpang` varchar(30) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `gender` char(10) NOT NULL,
  `no_tlp` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penumpang`
--

INSERT INTO `penumpang` (`id_penumpang`, `id_user`, `nama_penumpang`, `alamat`, `gender`, `no_tlp`) VALUES
('USER0001', 1, 'iman', 'cengal', 'L', '09876533'),
('USER0002', 1, 'bayu', 'cengal', 'L', '0987'),
('USER0003', 1, 'rangga', 'salareuma', 'L', '7865'),
('USER0004', 1, 'sarutobi sasuke', 'desa daun tersembunyi, di dekat rumah kasuga', 'L', '09876543'),
('USER15ab5', 1, 'iman', 'Kuningan', 'L', '10000000'),
('USER1b87a', 1, 'iman', 'kuningan', 'L', '100022'),
('USER7245a', 1, 'iman', 'cirebon', 'L', '998'),
('USER89b01', 1, 'imannnn', 'jakarta', 'L', '1243242'),
('USERa5a02', 1, 'iman', 'Kuningan', 'L', '22222');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi2`
--

CREATE TABLE `reservasi2` (
  `id_reservasi` varchar(20) NOT NULL,
  `id_penumpang` varchar(20) DEFAULT NULL,
  `id_user` varchar(10) NOT NULL,
  `id_jadwal` varchar(10) DEFAULT NULL,
  `id_gerbong` varchar(10) DEFAULT NULL,
  `tgl_berangkat` date DEFAULT NULL,
  `tgl_pesan` date DEFAULT NULL,
  `status_bayar` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `reservasi2`
--

INSERT INTO `reservasi2` (`id_reservasi`, `id_penumpang`, `id_user`, `id_jadwal`, `id_gerbong`, `tgl_berangkat`, `tgl_pesan`, `status_bayar`) VALUES
('RSV100a9', 'USERa5a02', '1', '17', '1', '2022-06-23', '2022-06-23', 'sudah'),
('RSV39269', 'USER15ab5', '1', '20', '1', '2022-06-23', '2022-06-23', 'sudah'),
('RSV4a050', 'USER7245a', '1', '16', '1', '2022-06-21', '2022-06-23', 'belum'),
('RSV57498', 'USER1b87a', '2', '17', '1', '2022-06-23', '2022-06-23', 'belum'),
('RSV82b54', 'USER89b01', '1', '16', '1', '2022-06-21', '2022-06-23', 'sudah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stasiun`
--

CREATE TABLE `stasiun` (
  `id_stasiun` char(10) NOT NULL,
  `nama_stasiun` varchar(30) NOT NULL,
  `Kota` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stasiun`
--

INSERT INTO `stasiun` (`id_stasiun`, `nama_stasiun`, `Kota`) VALUES
('ST0001', 'Manggarai', 'Jakarta'),
('ST0002', 'Sedayu', 'Podomoro');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` char(10) NOT NULL,
  `id_kereta` char(10) NOT NULL,
  `id_jadwal` char(10) NOT NULL,
  `no_kursi` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` char(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `id_reservasi` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tgl_bayar`, `jumlah`, `total_bayar`, `id_reservasi`) VALUES
('TRX59947', '2022-06-23', 1, 30000, 'RSV82b54'),
('TRX68002', '2022-06-23', 1, 10000, 'RSV100a9'),
('TRXb3675', '2022-06-23', 1, 25000, 'RSV39269');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(1) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level` enum('USER','ADMIN') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`) VALUES
(1, 'iman', '111', 'USER'),
(2, 'iman', '123', 'ADMIN');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gerbong`
--
ALTER TABLE `gerbong`
  ADD PRIMARY KEY (`id_gerbong`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `kereta`
--
ALTER TABLE `kereta`
  ADD PRIMARY KEY (`id_kereta`);

--
-- Indeks untuk tabel `penumpang`
--
ALTER TABLE `penumpang`
  ADD PRIMARY KEY (`id_penumpang`);

--
-- Indeks untuk tabel `reservasi2`
--
ALTER TABLE `reservasi2`
  ADD PRIMARY KEY (`id_reservasi`);

--
-- Indeks untuk tabel `stasiun`
--
ALTER TABLE `stasiun`
  ADD PRIMARY KEY (`id_stasiun`);

--
-- Indeks untuk tabel `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`) USING BTREE;

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
