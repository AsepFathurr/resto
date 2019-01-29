-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2019 at 03:25 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `resto`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE IF NOT EXISTS `bahan` (
`id_bahan` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `nama_bahan` varchar(150) NOT NULL,
  `harga_bahan` int(11) NOT NULL,
  `stock_bahan` float NOT NULL,
  `stock_minimal` int(11) NOT NULL DEFAULT '0',
  `catatan_bahan` text NOT NULL,
  `tgl_input_bahan` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan`
--

INSERT INTO `bahan` (`id_bahan`, `id_satuan`, `nama_bahan`, `harga_bahan`, `stock_bahan`, `stock_minimal`, `catatan_bahan`, `tgl_input_bahan`) VALUES
(24, 3, 'Ayam Potong', 35000, 40, 5, '', '2019-01-29 01:07:28'),
(25, 3, 'Ayam Kampung', 60000, 5, 2, '', '2019-01-29 01:08:26'),
(26, 3, 'Ikan Nila', 35000, 15, 3, '', '2019-01-29 01:10:03'),
(27, 3, 'Mie', 10000, 30, 4, '', '2019-01-29 01:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
`id_karyawan` int(11) NOT NULL,
  `nama_karyawan` varchar(150) NOT NULL,
  `telp_karyawan` char(20) NOT NULL,
  `username` char(30) NOT NULL,
  `password` char(30) NOT NULL,
  `tgl_login_terakhir` datetime NOT NULL,
  `tgl_input_karyawan` datetime NOT NULL,
  `jabatan` enum('chef','waiter','manajer','owner') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama_karyawan`, `telp_karyawan`, `username`, `password`, `tgl_login_terakhir`, `tgl_input_karyawan`, `jabatan`) VALUES
(1, 'Black taste s', '0891238', 'juna', '', '0000-00-00 00:00:00', '2018-11-17 15:36:54', 'chef'),
(8, 'ricky', '089182392', 'ricky', 'ricky', '0000-00-00 00:00:00', '2019-01-25 14:50:20', 'waiter'),
(9, 'Asep Faturahaman', '089128323', 'asep', 'asep123', '0000-00-00 00:00:00', '2018-11-09 22:27:05', 'owner'),
(10, 'Riska indah', '08410931239', 'riska', 'riska', '0000-00-00 00:00:00', '2018-11-09 22:28:22', 'manajer');

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE IF NOT EXISTS `meja` (
`id_meja` int(11) NOT NULL,
  `no_meja` char(20) NOT NULL,
  `catatan_meja` varchar(150) DEFAULT NULL,
  `tgl_input_meja` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`id_meja`, `no_meja`, `catatan_meja`, `tgl_input_meja`) VALUES
(1, '1', 'meja label A1', '2018-11-09 21:39:50'),
(2, '2', 'meja a2', '2018-11-09 21:40:00'),
(3, '3', '', '2019-01-29 19:18:26'),
(4, '4', '', '2019-01-29 19:18:32'),
(5, '5', '', '2019-01-29 19:18:37'),
(6, '6', '', '2019-01-29 19:18:48'),
(7, '7', '', '2019-01-29 19:18:53'),
(8, '8', '', '2019-01-29 19:18:58'),
(9, '9', '', '2019-01-29 19:19:04'),
(10, '10', '', '2019-01-29 19:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`id_menu` int(11) NOT NULL,
  `id_menu_kategori` int(11) NOT NULL,
  `nama_menu` varchar(200) NOT NULL,
  `foto_menu` varchar(255) NOT NULL,
  `harga_menu` int(11) NOT NULL,
  `stock_menu` int(11) NOT NULL,
  `catatan_menu` text NOT NULL,
  `tgl_input_menu` datetime NOT NULL,
  `is_favorit` tinyint(1) NOT NULL,
  `is_avaible` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `id_menu_kategori`, `nama_menu`, `foto_menu`, `harga_menu`, `stock_menu`, `catatan_menu`, `tgl_input_menu`, `is_favorit`, `is_avaible`) VALUES
(12, 2, 'Ayam Penyet Kampung', '_1.jpg', 25000, 10, '', '2019-01-28 09:04:38', 0, 1),
(13, 2, 'Ayam penyet Potong', '_11.jpg', 20000, 20, '', '2019-01-28 09:05:07', 0, 1),
(14, 2, 'Pecel Ayam Kampung', '_12.jpg', 25000, 20, '', '2019-01-28 09:05:32', 0, 1),
(15, 2, 'Pecel Ayam Potong', '_13.jpg', 20000, 20, '', '2019-01-28 09:06:05', 0, 1),
(16, 2, 'Ijo Pedes Ayam Kampung', '_14.jpg', 25000, 10, '', '2019-01-28 09:06:51', 0, 1),
(17, 2, 'Ijo Pedes Ayam Potong', '_15.jpg', 20000, 20, '', '2019-01-28 09:07:35', 0, 1),
(18, 2, 'Ayam Bakar Kampung', '_16.jpg', 25000, 10, '', '2019-01-28 09:08:09', 0, 1),
(19, 2, 'Ayam Bakar Potong', '_17.jpg', 20000, 20, '', '2019-01-28 09:09:06', 0, 1),
(20, 2, 'Ikan Nila Bakar', '_18.jpg', 15000, 15, '', '2019-01-28 09:09:39', 0, 1),
(21, 2, 'Ikan Nila Goreng', '_19.jpg', 15000, 15, '', '2019-01-28 09:10:08', 0, 1),
(22, 2, 'Ikan Nila Asam Manis', '_110.jpg', 15000, 15, '', '2019-01-28 09:10:52', 0, 1),
(23, 2, 'Mie Goreng', '_111.jpg', 10000, 20, '', '2019-01-28 09:11:29', 0, 1),
(24, 2, 'Mie Tek Tek', '_112.jpg', 12000, 20, '', '2019-01-28 09:12:00', 0, 1),
(25, 2, 'Nasi Goreng Selimut', '_113.jpg', 10000, 20, '', '2019-01-28 09:12:23', 0, 1),
(26, 2, 'Nasi Goreng Pete', '_114.jpg', 10000, 20, '', '2019-01-28 09:12:50', 0, 1),
(27, 2, 'Nasi Goreng Teri', '_115.jpg', 10000, 20, '', '2019-01-28 09:13:18', 0, 1),
(28, 2, 'Ayam Krispy', '_116.jpg', 15000, 20, '', '2019-01-28 09:14:11', 0, 1),
(29, 2, 'Roti Bakar', '_117.jpg', 8000, 10, '', '2019-01-29 00:50:43', 0, 1),
(30, 1, 'Jus Apel', 'alpukat.jpg', 8000, 10, '', '2019-01-29 00:51:36', 0, 1),
(31, 1, 'Jus Buah Naga', 'alpukat1.jpg', 8000, 10, '', '2019-01-29 00:51:59', 0, 1),
(32, 1, 'Jus Jeruk', 'alpukat2.jpg', 8000, 10, '', '2019-01-29 00:52:25', 0, 1),
(33, 1, 'Jus Mangga', 'alpukat3.jpg', 8000, 10, '', '2019-01-29 00:52:45', 0, 1),
(34, 1, 'Jus Melon', 'alpukat4.jpg', 8000, 10, '', '2019-01-29 00:53:04', 0, 1),
(35, 1, 'Jus Semangka', 'alpukat5.jpg', 8000, 10, '', '2019-01-29 00:53:30', 0, 1),
(36, 1, 'Sop Buah', 'alpukat6.jpg', 8000, 10, '', '2019-01-29 00:53:51', 0, 1),
(37, 1, 'Es Teh', 'alpukat7.jpg', 5000, 30, '', '2019-01-29 00:54:28', 0, 1),
(38, 1, 'Es Cappucino', 'alpukat8.jpg', 8000, 30, '', '2019-01-29 00:54:46', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_has_bahan`
--

CREATE TABLE IF NOT EXISTS `menu_has_bahan` (
`id_menu_has_bahan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_bahan` int(11) NOT NULL,
  `quantity` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_has_bahan`
--

INSERT INTO `menu_has_bahan` (`id_menu_has_bahan`, `id_menu`, `id_bahan`, `quantity`) VALUES
(2, 18, 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_kategori`
--

CREATE TABLE IF NOT EXISTS `menu_kategori` (
`id_menu_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(200) NOT NULL,
  `catatan_kategori` varchar(255) NOT NULL,
  `tgl_input_kategori` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_kategori`
--

INSERT INTO `menu_kategori` (`id_menu_kategori`, `nama_kategori`, `catatan_kategori`, `tgl_input_kategori`) VALUES
(1, 'Minuman', 'kategori minuman', '2018-11-08 00:00:00'),
(2, 'Makanan', 'kategori makanan', '2018-11-08 01:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE IF NOT EXISTS `satuan` (
`id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(150) NOT NULL,
  `catatan_satuan` varchar(150) NOT NULL,
  `tgl_input_satuan` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`, `catatan_satuan`, `tgl_input_satuan`) VALUES
(1, 'Gram', 'Grams', '2018-11-08 02:40:57'),
(2, 'Liter', 'Satuan liter untuk bahan cair seperti minyak makan dll', '2018-11-08 02:41:46'),
(3, 'Pcs', 'Satuan bijian', '2018-11-08 19:55:54');

-- --------------------------------------------------------

--
-- Table structure for table `sistem`
--

CREATE TABLE IF NOT EXISTS `sistem` (
`id_sistem` int(11) NOT NULL,
  `nama_resto` varchar(150) NOT NULL,
  `telp_resto` char(16) NOT NULL,
  `alamat_resto` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sistem`
--

INSERT INTO `sistem` (`id_sistem`, `nama_resto`, `telp_resto`, `alamat_resto`) VALUES
(1, 'Black taste', '0891238', 'Jln. Pulau buru nomor 44 wayhalim permai bandarlampung');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
`id_transaksi` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_meja` int(11) NOT NULL,
  `catatan` text,
  `tgl_transaksi` datetime NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `status_trans` enum('wait','done','cancel') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_karyawan`, `id_meja`, `catatan`, `tgl_transaksi`, `total_bayar`, `status_trans`) VALUES
(1, 8, 2, NULL, '2019-01-29 12:10:06', 50000, 'done'),
(2, 8, 1, NULL, '2019-01-29 12:19:12', 50000, 'done');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE IF NOT EXISTS `transaksi_detail` (
`id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `catatan_detail` varchar(250) DEFAULT NULL,
  `status` enum('wait','done','cancel') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `id_menu`, `jumlah_beli`, `catatan_detail`, `status`) VALUES
(1, 1, 12, 1, 'Paha', 'done'),
(2, 2, 18, 3, 'dada', 'done');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
 ADD PRIMARY KEY (`id_bahan`), ADD KEY `id_satuan` (`id_satuan`) USING BTREE;

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
 ADD PRIMARY KEY (`id_karyawan`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
 ADD PRIMARY KEY (`id_meja`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`id_menu`), ADD KEY `id_menu_kategori` (`id_menu_kategori`) USING BTREE;

--
-- Indexes for table `menu_has_bahan`
--
ALTER TABLE `menu_has_bahan`
 ADD PRIMARY KEY (`id_menu_has_bahan`), ADD KEY `id_menu` (`id_menu`) USING BTREE, ADD KEY `id_bahan` (`id_bahan`) USING BTREE;

--
-- Indexes for table `menu_kategori`
--
ALTER TABLE `menu_kategori`
 ADD PRIMARY KEY (`id_menu_kategori`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
 ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `sistem`
--
ALTER TABLE `sistem`
 ADD PRIMARY KEY (`id_sistem`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
 ADD PRIMARY KEY (`id_transaksi`), ADD KEY `id_karyawan_chef` (`id_karyawan`) USING BTREE, ADD KEY `id_meja` (`id_meja`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
 ADD PRIMARY KEY (`id_transaksi_detail`), ADD KEY `id_menu` (`id_menu`) USING BTREE, ADD KEY `id_transaksi` (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan`
--
ALTER TABLE `bahan`
MODIFY `id_bahan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
MODIFY `id_meja` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `menu_has_bahan`
--
ALTER TABLE `menu_has_bahan`
MODIFY `id_menu_has_bahan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu_kategori`
--
ALTER TABLE `menu_kategori`
MODIFY `id_menu_kategori` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sistem`
--
ALTER TABLE `sistem`
MODIFY `id_sistem` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bahan`
--
ALTER TABLE `bahan`
ADD CONSTRAINT `bahan_ibfk_1` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`id_menu_kategori`) REFERENCES `menu_kategori` (`id_menu_kategori`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `menu_has_bahan`
--
ALTER TABLE `menu_has_bahan`
ADD CONSTRAINT `menu_has_bahan_ibfk_2` FOREIGN KEY (`id_bahan`) REFERENCES `bahan` (`id_bahan`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `menu_has_bahan_ibfk_3` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_meja`) REFERENCES `meja` (`id_meja`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
