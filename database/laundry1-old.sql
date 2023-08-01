-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2023 at 02:46 PM
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
-- Database: `laundry1`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `qty` double NOT NULL,
  `total_harga` double NOT NULL,
  `keterangan` text NOT NULL,
  `resi_pembayaran` varchar(100) NOT NULL,
  `resi_pengiriman` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_paket`, `qty`, `total_harga`, `keterangan`, `resi_pembayaran`, `resi_pengiriman`) VALUES
(1, 1, 2, 2, 3000, '', '', '0'),
(2, 2, 2, 3, 4500, '', '', '1231451251'),
(3, 3, 2, 12, 18000, '', 'cuci lipat.jpg', ''),
(4, 4, 2, 3, 14500, '', 'cuci lipat.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `paket_cuci`
--

CREATE TABLE `paket_cuci` (
  `id_paket` int(11) NOT NULL,
  `jenis_paket` varchar(50) NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `p_foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket_cuci`
--

INSERT INTO `paket_cuci` (`id_paket`, `jenis_paket`, `nama_paket`, `deskripsi`, `harga`, `p_foto`) VALUES
(2, 'Kaos/Celana-Pendek', 'Paket Cuci Lipat', 'Paket tidak termasuk setrika dan pewangi tambahan', 1500, 'paket1.jpg'),
(3, 'Kaos/Celana-Pendek', 'Paket Komplit', 'Paket lengkap cuci, setrika dan diberi tambahan pewangi', 3000, 'paket2.jpg'),
(4, 'Kaos/Celana-Pendek', 'Setrika', 'Hanya setrika saja tanpa cuci', 1000, 'paket3.jpg'),
(5, 'Selimut/Bedcover/Karpet Ringan/Boneka', 'Paket Cuci Lipat', 'Paket tidak termasuk setrika dan pewangi tambahan', 5000, 'paket1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp_pelanggan` int(15) NOT NULL,
  `no_ktp` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `username`, `password`, `alamat_pelanggan`, `jenis_kelamin`, `telp_pelanggan`, `no_ktp`) VALUES
(1, 'tes1', '', '', 'jl pelanggan 1', 'L', 812412412, 2147483647),
(2, 'tes2', '', '', 'jl pelanggan 2', 'P', 9831513, 2147483647),
(3, 'tes2', 'pelanggan', '7f78f06d2d1262a0a222ca9834b15d9d', 'jl jl yuk', 'L', 89124124, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kode_invoice` varchar(100) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tgl` datetime NOT NULL,
  `batas_waktu` datetime NOT NULL,
  `tgl_pembayaran` datetime NOT NULL,
  `biaya_tambahan` int(11) NOT NULL,
  `status` enum('baru','dijemput','proses','selesai','dikirim') NOT NULL,
  `status_bayar` enum('dibayar','belum') NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode_invoice`, `id_pelanggan`, `tgl`, `batas_waktu`, `tgl_pembayaran`, `biaya_tambahan`, `status`, `status_bayar`, `id_user`) VALUES
(1, 'CLN202306041139', 1, '2023-06-04 10:57:33', '2023-06-11 12:00:00', '2023-06-05 04:44:39', 0, 'baru', 'dibayar', 1),
(2, 'CLN202306055946', 1, '2023-06-05 04:47:09', '2023-06-12 12:00:00', '2023-06-05 10:30:03', 0, 'baru', 'dibayar', 1),
(3, 'CLN202306054933', 2, '2023-06-05 10:33:56', '2023-06-12 12:00:00', '0000-00-00 00:00:00', 0, 'baru', 'belum', 8),
(4, 'CLN202306052434', 2, '2023-06-05 10:34:39', '2023-06-12 12:00:00', '0000-00-00 00:00:00', 10000, 'baru', 'belum', 8);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','kasir','owner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `role`) VALUES
(1, 'admin1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'admin2', 'admin2', 'c84258e9c39059a89ab77d846ddab909', 'admin'),
(3, 'kasir1', 'kasir', 'c7911af3adbd12a035b289556d96470a', 'kasir'),
(4, 'owner1', 'owner', '72122ce96bfec66e2396d2e25225d70a', 'owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `paket_cuci`
--
ALTER TABLE `paket_cuci`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paket_cuci`
--
ALTER TABLE `paket_cuci`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
