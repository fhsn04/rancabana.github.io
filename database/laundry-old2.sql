-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2023 at 02:31 AM
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
  `nama_paket` varchar(100) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `harga` int(20) NOT NULL,
  `qty` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_paket`, `nama_paket`, `nama_kategori`, `harga`, `qty`) VALUES
(35, 0, 0, 'Kaos/Celana-Pendek', 'Setrika', 1500, 0),
(50, 154, 4, '', '', 0, 1),
(51, 0, 0, '', '', 0, 0),
(52, 155, 2, '', '', 0, 1),
(53, 0, 0, '', '', 0, 0),
(54, 156, 3, 'Kaos/Celana-Pendek', 'Cuci doang', 3000, 1),
(55, 157, 2, 'Kaos/Celana-Pendek', 'Setrika', 1500, 1),
(56, 158, 3, 'Kaos/Celana-Pendek', 'Cuci doang', 3000, 1),
(57, 158, 4, 'Kaos/Celana-Pendek', 'Setrika', 1000, 1),
(58, 158, 5, 'Kaos/Celana-Pendek', 'Cuci doang', 15000, 1),
(59, 159, 2, 'Kaos/Celana-Pendek', 'Setrika', 1500, 1),
(60, 159, 3, 'Kaos/Celana-Pendek', 'Cuci doang', 3000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `des_kategori` text NOT NULL,
  `foto_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `des_kategori`, `foto_kategori`) VALUES
(1, 'Cuci doang', 'paket ini hanya cuci saja tidak termasuk setrika', 'cuci lipat.jpg'),
(3, 'Setrika', 'paket setrika saja tanpa cuci', 'paket3.jpg'),
(6, 'Cuci Setrika', 'paket lengap cuci dan setrika', 'paket2.jpg'),
(8, 'Dry Clean', 'paket cuci kering tanpa air dengan menggunakan teknologi terkini', 'paket1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `aktif` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_pelanggan`, `id_paket`, `id_kategori`, `qty`, `aktif`) VALUES
(97, 3, 3, 0, 0, 'y'),
(98, 3, 3, 0, 0, 'y'),
(99, 0, 2, 0, 0, 'y'),
(100, 0, 2, 0, 0, 'y'),
(101, 0, 2, 0, 0, 'y'),
(102, 0, 4, 0, 0, 'y'),
(103, 3, 5, 0, 0, 'y'),
(104, 3, 3, 0, 0, 'y'),
(105, 3, 3, 0, 0, 'y'),
(106, 3, 2, 0, 0, 'y'),
(107, 3, 3, 0, 0, 'y'),
(108, 3, 3, 0, 0, 'y'),
(109, 3, 4, 0, 0, 'y'),
(110, 3, 2, 0, 0, 'y'),
(111, 3, 3, 0, 0, 'y'),
(112, 3, 2, 0, 0, 'y'),
(113, 3, 4, 0, 0, 'y'),
(114, 3, 2, 0, 0, 'y'),
(115, 3, 3, 0, 0, 'y'),
(116, 3, 2, 0, 0, 'y'),
(117, 3, 3, 0, 0, 'y'),
(118, 3, 4, 0, 0, 'y'),
(119, 3, 4, 0, 0, 'y'),
(120, 3, 5, 0, 0, 'y'),
(121, 3, 5, 0, 0, 'y'),
(122, 3, 5, 0, 0, 'y'),
(123, 3, 2, 0, 0, 'y'),
(124, 3, 3, 0, 0, 'y'),
(125, 3, 3, 0, 0, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `paket_cuci`
--

CREATE TABLE `paket_cuci` (
  `id_paket` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `p_foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket_cuci`
--

INSERT INTO `paket_cuci` (`id_paket`, `id_kategori`, `nama_paket`, `deskripsi`, `harga`, `p_foto`) VALUES
(2, 3, 'Kaos/Celana-Pendek', 'Paket tidak termasuk setrika dan pewangi tambahan', 1500, 'paket3.jpg'),
(3, 1, 'Kaos/Celana-Pendek', 'Paket lengkap cuci, setrika dan diberi tambahan pewangi', 3000, 'paket2.jpg'),
(4, 3, 'Kaos/Celana-Pendek', 'Hanya setrika saja tanpa cuci', 1000, 'paket3.jpg'),
(5, 1, 'Kaos/Celana-Pendek', 'Paket tidak termasuk setrika dan pewangi tambahan', 15000, 'paket1.jpg'),
(6, 1, 'Selimut/Bedcover/Karpet Ringan/Boneka', 'Paket tidak termasuk setrika', 2000, 'paket1.jpg'),
(7, 1, 'Sepatu', 'Paket tidak termasuk setrika', 15000, 'paket1.jpg'),
(8, 1, 'Levis/Sweater', 'Paket tidak termasuk setrika', 2000, 'paket1.jpg');

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
  `no_ktp` int(30) NOT NULL,
  `email_pelanggan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `username`, `password`, `alamat_pelanggan`, `jenis_kelamin`, `telp_pelanggan`, `no_ktp`, `email_pelanggan`) VALUES
(1, 'tes1', '', '', 'jl pelanggan 1', 'L', 812412412, 2147483647, ''),
(2, 'tes2', '', '', 'jl pelanggan 2', 'P', 9831513, 2147483647, ''),
(3, 'Farhan Sukma N', 'pelanggan', '7f78f06d2d1262a0a222ca9834b15d9d', '', 'L', 23, 21, 'farhan@gmail.com');

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
  `total_harga` double NOT NULL,
  `keterangan` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` int(20) NOT NULL,
  `alamat` text NOT NULL,
  `status` enum('baru','dijemput','proses','selesai','dikirim') NOT NULL,
  `status_bayar` enum('dibayar','belum') NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode_invoice`, `id_pelanggan`, `tgl`, `batas_waktu`, `tgl_pembayaran`, `biaya_tambahan`, `total_harga`, `keterangan`, `email`, `no_telp`, `alamat`, `status`, `status_bayar`, `id_user`) VALUES
(1, 'CLN202306041139', 1, '2023-06-04 10:57:33', '2023-06-11 12:00:00', '2023-06-05 04:44:39', 0, 0, '', '', 0, '', 'dijemput', 'dibayar', 1),
(2, 'CLN202306055946', 1, '2023-06-05 04:47:09', '2023-06-12 12:00:00', '2023-06-05 10:30:03', 0, 0, '', '', 0, '', 'baru', 'dibayar', 1),
(126, 'CLN202306093143', 3, '2023-06-09 10:43:32', '2023-06-16 12:00:00', '0000-00-00 00:00:00', 15000, 18000, '', '', 89124124, '', 'baru', 'belum', 0),
(154, 'CLN202306122556', 3, '2023-06-12 11:56:47', '2023-06-19 12:00:00', '0000-00-00 00:00:00', 15000, 16000, '', '', 89124124, '', 'baru', 'belum', 0),
(155, 'CLN202306122457', 3, '2023-06-12 11:57:25', '2023-06-19 12:00:00', '0000-00-00 00:00:00', 15000, 16500, '', '', 89124124, '', 'baru', 'belum', 0),
(156, 'CLN202306121041', 3, '2023-06-12 01:41:11', '2023-06-19 12:00:00', '0000-00-00 00:00:00', 15000, 18000, '', '', 89124124, '', 'baru', 'belum', 0),
(157, 'CLN202306124219', 3, '2023-06-12 02:19:43', '2023-06-19 12:00:00', '0000-00-00 00:00:00', 15000, 16500, '', '', 89124124, '', 'baru', 'belum', 0),
(158, 'CLN202306132507', 3, '2023-06-13 02:07:31', '2023-06-20 12:00:00', '0000-00-00 00:00:00', 15000, 34000, '', 'farhan@gmail.com', 2147483647, '', 'baru', 'belum', 0),
(159, 'CLN202306132527', 3, '2023-06-13 02:27:44', '2023-06-20 12:00:00', '0000-00-00 00:00:00', 5000, 9500, '', 'farhan@gmail.com', 2147483647, '', 'baru', 'belum', 0);

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
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

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
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `paket_cuci`
--
ALTER TABLE `paket_cuci`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
