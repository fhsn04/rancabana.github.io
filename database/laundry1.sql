-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2023 at 05:08 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

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
  `nama_paket` varchar(50) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `proses` varchar(50) NOT NULL,
  `harga` double NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_paket`, `nama_paket`, `nama_kategori`, `proses`, `harga`, `qty`) VALUES
(236, 282, 5, 'Karpet Berat', 'Cuci doang', 'satuan', 30000, 1),
(237, 283, 8, 'Levis/Sweater', 'Cuci doang', 'satuan', 5000, 1),
(238, 283, 20, 'Kaos/Celana-Pendek', 'Cuci doang', 'kiloan', 5000, 1),
(239, 283, 5, 'Karpet Berat', 'Cuci doang', 'satuan', 30000, 1),
(240, 283, 23, 'Levis/Sweater', 'Cuci doang', 'kiloan', 5000, 4),
(241, 284, 4, 'Selimut/Bedcover', 'Setrika', 'satuan', 10000, 1),
(242, 285, 5, 'Karpet Berat', 'Cuci doang', 'satuan', 30000, 1),
(243, 285, 23, 'Levis/Sweater', 'Cuci doang', 'kiloan', 5000, 3),
(244, 286, 7, 'Sepatu', 'Cuci doang', 'satuan', 25000, 1),
(245, 287, 23, 'Levis/Sweater', 'Cuci doang', 'kiloan', 5000, 5),
(246, 288, 24, 'Levis/Sweater', 'Setrika', 'kiloan', 3000, 4),
(247, 289, 3, 'Kaos/Celana-Pendek', 'Cuci doang', 'satuan', 1000, 10),
(248, 290, 8, 'Levis/Sweater', 'Cuci doang', 'satuan', 5000, 1),
(249, 291, 7, 'Sepatu', 'Cuci doang', 'satuan', 25000, 1),
(250, 292, 28, 'Selimut/Bedcover', 'Cuci Setrika', 'kiloan', 7000, 5),
(251, 293, 25, 'Selimut/Bedcover', 'Cuci Saja /kg', 'kiloan', 5000, 1),
(252, 293, 3, 'Kaos/Celana-Pendek', 'Cuci Saja /pcs', 'satuan', 1000, 1),
(253, 294, 4, 'Selimut/Bedcover', 'Setrika /pcs', 'satuan', 10000, 1),
(254, 294, 25, 'Selimut/Bedcover', 'Cuci Saja /kg', 'kiloan', 5000, 5),
(255, 295, 25, 'Selimut/Bedcover', 'Cuci Saja /kg', 'kiloan', 5000, 1),
(256, 295, 2, 'Kaos/Celana-Pendek', 'Setrika /pcs', 'satuan', 1000, 13),
(257, 295, 20, 'Kaos/Celana-Pendek', 'Cuci Saja /kg', 'kiloan', 5000, 1000),
(258, 296, 5, 'Karpet Berat', 'Cuci Saja /pcs', 'satuan', 30000, 1),
(259, 296, 2, 'Kaos/Celana-Pendek', 'Setrika /pcs', 'satuan', 1000, 5),
(260, 297, 2, 'Kaos/Celana-Pendek', 'Setrika /pcs', 'satuan', 1000, 5),
(261, 298, 2, 'Kaos/Celana-Pendek', 'Setrika /pcs', 'satuan', 1000, 5),
(262, 299, 5, 'Karpet Berat', 'Cuci Saja /pcs', 'satuan', 30000, 4),
(263, 299, 2, 'Kaos/Celana-Pendek', 'Setrika /pcs', 'satuan', 1000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `proses` varchar(100) NOT NULL,
  `des_kategori` text NOT NULL,
  `foto_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `proses`, `des_kategori`, `foto_kategori`) VALUES
(1, 'Cuci Saja /pcs', 'satuan', 'paket ini hanya cuci saja tidak termasuk setrika', 'paket4.jpg'),
(3, 'Setrika /pcs', 'satuan', 'paket setrika saja tanpa cuci', 'setrika1.jpg'),
(6, 'Cuci Setrika /pcs', 'satuan', 'paket lengap cuci dan setrika', 'paket2.jpg'),
(8, 'Dry Clean', 'satuan', 'paket cuci kering tanpa air dengan menggunakan teknologi terkini', 'paket1.jpg'),
(10, 'Cuci Saja /kg', 'kiloan', 'paket ini hanya cuci saja tidak termasuk setrika', 'paket4.jpg'),
(11, 'Setrika /kg', 'kiloan', 'paket setrika saja tanpa cuci', 'setrika1.jpg'),
(12, 'Cuci Setrika /kg', 'kiloan', 'paket lengap cuci dan setrika', 'paket2.jpg');

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
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_pelanggan`, `id_paket`, `id_kategori`, `qty`, `id_user`) VALUES
(384, 0, 12, 3, 1, 1),
(397, 0, 11, 1, 1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket_cuci`
--

INSERT INTO `paket_cuci` (`id_paket`, `id_kategori`, `nama_paket`, `deskripsi`, `harga`, `p_foto`) VALUES
(2, 3, 'Kaos/Celana-Pendek', 'Paket tidak termasuk setrika dan pewangi tambahan', 1000, 'kaos.jpg'),
(3, 1, 'Kaos/Celana-Pendek', 'Paket lengkap cuci, setrika dan diberi tambahan pewangi', 1000, 'kaos.jpg'),
(4, 3, 'Selimut/Bedcover', 'Hanya setrika saja tanpa cuci', 10000, 'selimut.jpg'),
(5, 1, 'Karpet Berat', 'Paket tidak termasuk setrika dan pewangi tambahan', 30000, 'karpet.jpg'),
(7, 1, 'Sepatu', 'Paket tidak termasuk setrika', 25000, 'sepatu.jpg'),
(8, 1, 'Levis/Sweater', 'Paket tidak termasuk setrika', 5000, 'sweater.jpg'),
(10, 3, 'Levis/Sweater', 'Hanya setrika saja tanpa cuci', 2000, 'sweater.jpg'),
(11, 1, 'Selimut/Bedcover', 'Paket tidak termasuk setrika', 25000, 'selimut.jpg'),
(12, 3, 'Gaun/Jas', 'Hanya setrika saja tanpa cuci', 5000, 'jas.jpg'),
(13, 6, 'Kaos/Celana-Pendek', 'Paket lengkap cuci, setrika dan diberi tambahan pewangi', 1500, 'kaos.jpg'),
(14, 6, 'Levis/Sweater', 'Paket lengkap cuci, setrika dan diberi tambahan pewangi', 7500, 'sweater.jpg'),
(15, 6, 'Selimut/Bedcover', 'Paket lengkap cuci, setrika dan diberi tambahan pewangi', 30000, 'selimut.jpg'),
(17, 8, 'Sepatu', 'Cuci tanpa air, agar pakaian dan barang anda tidak mudah rusak', 35000, 'sepatu.jpg'),
(18, 8, 'Levis/Sweater', 'Cuci tanpa air, agar pakaian dan barang anda tidak mudah rusak', 15000, 'sweater.jpg'),
(19, 8, 'Gaun/Jas', 'Paket lengkap cuci dengan teknik dry clean, setrika dan diberi tambahan pewangi', 25000, 'jas.jpg'),
(20, 10, 'Kaos/Celana-Pendek', 'Paket tidak termasuk setrika dan pewangi tambahan', 5000, 'kaos.jpg'),
(21, 12, 'Kaos/Celana-Pendek', 'Paket lengkap cuci, setrika dan diberi tambahan pewangi', 7000, 'kaos.jpg'),
(22, 11, 'Selimut/Bedcover', 'Hanya setrika saja tanpa cuci', 3000, 'selimut.jpg'),
(23, 10, 'Levis/Sweater', 'Paket tidak termasuk setrika', 5000, 'sweater.jpg'),
(24, 11, 'Levis/Sweater', 'Hanya setrika saja tanpa cuci', 3000, 'sweater.jpg'),
(25, 10, 'Selimut/Bedcover', 'Paket tidak termasuk setrika', 5000, 'selimut.jpg'),
(27, 12, 'Levis/Sweater', 'Paket lengkap cuci, setrika dan diberi tambahan pewangi', 7000, 'sweater.jpg'),
(28, 12, 'Selimut/Bedcover', 'Paket lengkap cuci, setrika dan diberi tambahan pewangi', 7000, 'selimut.jpg');

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
  `email_pelanggan` varchar(50) NOT NULL,
  `foto_p` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `username`, `password`, `alamat_pelanggan`, `jenis_kelamin`, `telp_pelanggan`, `no_ktp`, `email_pelanggan`, `foto_p`) VALUES
(1, 'tes1', '', '', 'jl pelanggan 1', 'L', 812412412, 2147483647, '', ''),
(2, 'tes2', '', '', 'jl pelanggan 2', 'P', 9831513, 2147483647, '', ''),
(3, 'Farhan Sukma N', 'pelanggan', '7f78f06d2d1262a0a222ca9834b15d9d', 'Jl Kalibata Barat No.2002 Kel Kalibata, Kec Pancuran, Jaksel', 'L', 89124124, 21, 'farhan@gmail.com', '3982.jpg'),
(4, 'reza', 'reza', 'bb98b1d0b523d5e783f931550d7702b6', 'jalan kalibata yang kanan', 'L', 2147483647, 2147483647, '', ''),
(5, 'pelanggan2', 'pelanggan2', '7a8a80e50f6ff558f552079cefe2715d', 'jl mawar no 20', 'L', 24, 812512512, '', ''),
(6, 'farhan', 'hans01', '2a09c43c94735d5d093fb28d63f96fcf', 'jl kalibata tengah no 0124', 'L', 2147483647, 2147483647, '', ''),
(7, 'tomi', 'tomi', '08767d10c94125f26f95eaadb5ebb98a', 'jl mawar no 20', 'L', 2147483647, 2147483647, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `testimoni` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`id`, `id_pelanggan`, `testimoni`) VALUES
(1, 2, 'Sudah jadi langganan disini, pelayanan cepat, admin fast respown dan ramah.'),
(2, 3, 'mantabbb, pelayanan cepat, cucian bersih wangi, jadi rajin laundry disini'),
(4, 4, 'Harga murah, kualitas bagus, pakaian rapih dan wangi, pokoknya puas laundry disini.');

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
  `tgl_pembayaran` date NOT NULL,
  `biaya_tambahan` int(11) NOT NULL,
  `uang_muka` double NOT NULL,
  `total_harga` double NOT NULL,
  `pelunasan` double NOT NULL,
  `keterangan` text NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` int(20) NOT NULL,
  `alamat` text NOT NULL,
  `status` enum('baru','dijemput','proses','selesai','dikirim','dibatalkan') NOT NULL,
  `status_bayar` enum('lunas','belum','dp') NOT NULL,
  `resi_dp` varchar(100) NOT NULL,
  `resi_p` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode_invoice`, `id_pelanggan`, `tgl`, `batas_waktu`, `tgl_pembayaran`, `biaya_tambahan`, `uang_muka`, `total_harga`, `pelunasan`, `keterangan`, `nama`, `email`, `no_telp`, `alamat`, `status`, `status_bayar`, `resi_dp`, `resi_p`, `id_user`) VALUES
(282, 'CLN202307020716', 3, '2023-07-02 09:16:07', '2023-07-09 12:00:00', '2023-07-03', 5000, 0, 35000, 35000, '', 'Farhan Sukma N', 'farhan@gmail.com', 225, '', 'dijemput', 'lunas', '', 'paket2.jpg', 0),
(283, 'CLN202307024716', 3, '2023-07-02 09:16:49', '2023-07-09 12:00:00', '2023-07-04', 5000, 45000, 60000, 20000, '', 'Farhan Sukma N', 'farhan@gmail.com', 225, '', 'baru', 'lunas', '', 'paket2.jpg', 0),
(284, 'CLN202307034913', 3, '2023-07-03 05:13:52', '2023-07-10 12:00:00', '0000-00-00', 5000, 0, 10000, 0, '', 'Farhan Sukma N', 'farhan@gmail.com', 225, '', 'baru', 'belum', '', '', 0),
(285, 'CLN202307034214', 3, '2023-07-03 05:14:49', '2023-07-10 12:00:00', '0000-00-00', 5000, 35000, 45000, 15000, '', 'Farhan Sukma N', 'farhan@gmail.com', 225, '', 'baru', 'dp', '', '', 0),
(286, 'CLN202307032628', 3, '2023-07-03 05:28:30', '2023-07-10 12:00:00', '0000-00-00', 5000, 0, 25000, 30000, '', 'Farhan Sukma N', 'farhan@gmail.com', 225, '', 'baru', 'belum', '', '', 0),
(287, 'CLN202307034930', 3, '2023-07-03 05:30:52', '2023-07-10 12:00:00', '2023-07-03', 5000, 5000, 25000, 25000, '', 'Farhan Sukma N', 'farhan@gmail.com', 225, '', 'proses', 'lunas', '', '', 0),
(288, 'CLN202307033245', 3, '2023-07-03 05:45:37', '2023-07-10 12:00:00', '2023-07-03', 5000, 10000, 6000, 1000, '', 'Farhan Sukma N', 'farhan@gmail.com', 225, '', 'proses', 'lunas', '', '', 0),
(289, 'CLN202307030303', 3, '2023-07-03 06:03:04', '2023-07-10 12:00:00', '0000-00-00', 5000, 0, 15000, 15000, '', 'Farhan Sukma N', 'farhan@gmail.com', 225, '', 'baru', 'belum', '', '', 0),
(290, 'CLN202307035843', 3, '2023-07-03 12:44:00', '2023-07-10 12:00:00', '0000-00-00', 5000, 0, 10000, 10000, '', 'Farhan Sukma N', 'farhan@gmail.com', 225, '', 'dibatalkan', 'belum', '', '', 0),
(291, 'CLN202307034630', 3, '2023-07-03 01:30:47', '2023-07-10 12:00:00', '2023-07-26', 5000, 0, 30000, 30000, '', 'Farhan Sukma N', 'farhan@gmail.com', 225, '', 'baru', 'lunas', '', 'resip.jpg', 0),
(292, 'CLN202307031031', 3, '2023-07-03 01:31:11', '2023-07-10 12:00:00', '0000-00-00', 5000, 10000, 35000, 30000, '', 'Farhan Sukma N', 'farhan@gmail.com', 225, '', 'dibatalkan', 'dp', '', '', 0),
(294, 'CLN202307043728', 3, '2023-07-04 08:28:38', '2023-07-11 12:00:00', '2023-07-26', 5000, 20000, 35000, 15000, '', 'Farhan Sukma N', 'farhan@gmail.com', 225, '', 'dibatalkan', 'lunas', 'residp1.jpg', '', 0),
(295, 'CLN202307103652', 3, '2023-07-10 09:54:22', '2023-07-17 12:00:00', '0000-00-00', 5000, 23000, 0, 0, '', 'Farhan Sukma N', 'farhan@gmail.com', 225, '', 'baru', 'belum', 'residp1.jpg', '', 0),
(296, 'CLN202307185852', 3, '2023-07-18 05:53:21', '2023-07-25 12:00:00', '0000-00-00', 5000, 0, 40000, 40000, 'percobaan pertama', 'Farhan Sukma N', 'farhan@gmail.com', 62, 'Jl Kalibata Barat No.2002 Kel Kalibata, Kec Pancuran, Jaksel', 'baru', 'belum', '', '', 0),
(297, 'CLN202307181758', 3, '2023-07-18 05:58:20', '2023-07-25 12:00:00', '0000-00-00', 5000, 0, 10000, 10000, 'percobaan pertama', 'Farhan Sukma N', 'farhan@gmail.com', 62, 'Jl Kalibata Barat No.2002 Kel Kalibata, Kec Pancuran, Jaksel', 'baru', 'belum', 'resip.jpg', '', 0),
(298, 'CLN202307184100', 3, '2023-07-18 06:00:43', '2023-07-25 12:00:00', '0000-00-00', 5000, 0, 10000, 10000, 'percobaan pertama', 'Farhan Sukma N', 'farhan@gmail.com', 62, 'Jl Kalibata Barat No.2002 Kel Kalibata, Kec Pancuran, Jaksel', 'baru', 'belum', 'resip.jpg', '', 0),
(299, 'CLN202307182110', 3, '2023-07-18 06:10:22', '2023-07-25 12:00:00', '0000-00-00', 5000, 0, 130000, 130000, 'percobaan pertama', 'Farhan Sukma N', 'farhan@gmail.com', 62, 'Jl Kalibata Barat No.2002 Kel Kalibata, Kec Pancuran, Jaksel', 'baru', 'belum', '', '', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_pelanggan` (`id_pelanggan`);

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
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=413;

--
-- AUTO_INCREMENT for table `paket_cuci`
--
ALTER TABLE `paket_cuci`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
