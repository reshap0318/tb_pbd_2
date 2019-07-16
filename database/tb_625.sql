-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2019 at 06:58 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tb_625`
--

-- --------------------------------------------------------

--
-- Table structure for table `bensin`
--

CREATE TABLE `bensin` (
  `kode_bensin` varchar(1) NOT NULL,
  `nama` varchar(8) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bensin`
--

INSERT INTO `bensin` (`kode_bensin`, `nama`, `harga`) VALUES
('1', 'Petamax', 9800),
('2', 'hohoH', 12000);

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `kode_kendaraan` varchar(2) NOT NULL,
  `plat_no` varchar(10) NOT NULL,
  `no_mesin` varchar(16) NOT NULL,
  `no_rangka` varchar(16) NOT NULL,
  `minyak_full` decimal(5,2) NOT NULL,
  `m_1l` decimal(7,2) NOT NULL,
  `kondisi` int(1) NOT NULL,
  `kode_merek` varchar(1) NOT NULL,
  `kode_bensin` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`kode_kendaraan`, `plat_no`, `no_mesin`, `no_rangka`, `minyak_full`, `m_1l`, `kondisi`, `kode_merek`, `kode_bensin`) VALUES
('1', 'BA 4925 EZ', 'ASK39012oLKS', '314LASK1020L', '29.20', '21.01', 2, 'A', '1'),
('2', 'BA 7120 EK', 'HASK012KSAL021', 'JKAO99120031L', '12.00', '12.90', 1, 'A', '1');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan_kursi`
--

CREATE TABLE `kendaraan_kursi` (
  `kode_kursi` varchar(3) NOT NULL,
  `nama` varchar(5) NOT NULL,
  `kode_kendaraan` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kendaraan_kursi`
--

INSERT INTO `kendaraan_kursi` (`kode_kursi`, `nama`, `kode_kendaraan`) VALUES
('1', 'PYK1', '1'),
('2', 'KSP1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan_satker`
--

CREATE TABLE `kendaraan_satker` (
  `id` char(3) NOT NULL,
  `kode_kendaraan` char(2) NOT NULL,
  `kode_satker` char(2) NOT NULL,
  `datang` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `keluar` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kendaraan_satker`
--

INSERT INTO `kendaraan_satker` (`id`, `kode_kendaraan`, `kode_satker`, `datang`, `keluar`) VALUES
('AA1', '1', 'L1', '2019-07-12 17:22:32', '2019-07-13 07:02:52'),
('AA2', '1', 'L1', '2019-07-14 18:00:00', NULL),
('AA3', '2', 'L1', '2019-07-14 18:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `kode_lokasi` varchar(1) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `asal` varchar(30) NOT NULL,
  `tujuan` varchar(30) NOT NULL,
  `jarak` decimal(7,2) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`kode_lokasi`, `nama`, `asal`, `tujuan`, `jarak`, `harga`) VALUES
('1', 'Padang - Payakubuh', 'Padang', 'Payakumbuh', '3120.01', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `merek_kendaraan`
--

CREATE TABLE `merek_kendaraan` (
  `kode_merek` varchar(1) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merek_kendaraan`
--

INSERT INTO `merek_kendaraan` (`kode_merek`, `nama`) VALUES
('A', 'Avanza');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `kode_pemesanan` char(3) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kode_kendaraan` varchar(2) NOT NULL,
  `nik` char(16) NOT NULL,
  `kode_lokasi` varchar(1) NOT NULL,
  `kode_waktu` varchar(1) NOT NULL,
  `kode_satker` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`kode_pemesanan`, `tanggal`, `kode_kendaraan`, `nik`, `kode_lokasi`, `kode_waktu`, `kode_satker`) VALUES
('1', '2019-07-14', '1', '1611523012', '1', '1', 'L1'),
('3', '2019-07-15', '2', '1611523012', '1', '1', 'L1');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_detail`
--

CREATE TABLE `pemesanan_detail` (
  `kode_pemesanan` char(3) NOT NULL,
  `kode_kursi` varchar(3) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `no_telp` char(13) NOT NULL,
  `jemput` varchar(50) NOT NULL,
  `antar` varchar(50) NOT NULL,
  `biaya_tambahan` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan_detail`
--

INSERT INTO `pemesanan_detail` (`kode_pemesanan`, `kode_kursi`, `nama`, `no_telp`, `jemput`, `antar`, `biaya_tambahan`) VALUES
('1', '1', 'REINALDO SHANDEV PRATAMA', '082284009498', 'ops', 'upss', 120);

-- --------------------------------------------------------

--
-- Table structure for table `satker`
--

CREATE TABLE `satker` (
  `kode_satker` char(2) NOT NULL,
  `nama` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satker`
--

INSERT INTO `satker` (`kode_satker`, `nama`) VALUES
('L1', 'Batusangkar'),
('L2', 'Padang');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `nik` char(16) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `kota_lahir` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `hak_akses` varchar(1) NOT NULL,
  `kode_satker` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`nik`, `nama`, `username`, `password`, `kota_lahir`, `tanggal_lahir`, `alamat`, `no_telp`, `hak_akses`, `kode_satker`) VALUES
('1611521006', 'Annisa Aulia Khaira', '1611521006', 'd23dcdf8e94cf86e2d8eb56877189d55', '', '0000-00-00', '', '082267846262', '2', 'L1'),
('1611522012', 'Reinaldo Shandev Pratama', '1611522012', '7deab5e2bbd609ec8f8e37f50483f612', '', '0000-00-00', '', '', '1', 'L1'),
('1611523012', 'Miftahul Asraf', '1611523012', 'f592f02b45526f480ae133cf2e9d0a14', 'Padang', '1998-06-03', 'Padang', '082284009400', '3', 'L2');

-- --------------------------------------------------------

--
-- Table structure for table `waktu`
--

CREATE TABLE `waktu` (
  `kode_waktu` varchar(1) NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_sampai` time NOT NULL,
  `hari` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waktu`
--

INSERT INTO `waktu` (`kode_waktu`, `waktu_mulai`, `waktu_sampai`, `hari`) VALUES
('1', '09:20:00', '12:50:00', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bensin`
--
ALTER TABLE `bensin`
  ADD PRIMARY KEY (`kode_bensin`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`kode_kendaraan`),
  ADD UNIQUE KEY `plat_no` (`plat_no`),
  ADD UNIQUE KEY `no_mesin` (`no_mesin`),
  ADD UNIQUE KEY `no_rangka` (`no_rangka`),
  ADD KEY `merek_kendaraan_mobil_fk` (`kode_merek`),
  ADD KEY `bensin_mobil_fk` (`kode_bensin`);

--
-- Indexes for table `kendaraan_kursi`
--
ALTER TABLE `kendaraan_kursi`
  ADD PRIMARY KEY (`kode_kursi`) USING BTREE,
  ADD KEY `mobil_mobil_kursi_fk` (`kode_kendaraan`);

--
-- Indexes for table `kendaraan_satker`
--
ALTER TABLE `kendaraan_satker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kendaraan_fk` (`kode_kendaraan`),
  ADD KEY `satker_fk` (`kode_satker`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`kode_lokasi`);

--
-- Indexes for table `merek_kendaraan`
--
ALTER TABLE `merek_kendaraan`
  ADD PRIMARY KEY (`kode_merek`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`kode_pemesanan`),
  ADD KEY `lokasi_pemesanan_fk` (`kode_lokasi`),
  ADD KEY `kendaraan_pemesanan_fk` (`kode_kendaraan`),
  ADD KEY `waktu_fk` (`kode_waktu`),
  ADD KEY `ssatker_pk` (`kode_satker`),
  ADD KEY `sopir_fk` (`nik`);

--
-- Indexes for table `pemesanan_detail`
--
ALTER TABLE `pemesanan_detail`
  ADD PRIMARY KEY (`kode_pemesanan`,`kode_kursi`),
  ADD KEY `kendaraan_kursi_pemesanan_detail_fk` (`kode_kursi`);

--
-- Indexes for table `satker`
--
ALTER TABLE `satker`
  ADD PRIMARY KEY (`kode_satker`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`nik`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `satker_users_fk` (`kode_satker`);

--
-- Indexes for table `waktu`
--
ALTER TABLE `waktu`
  ADD PRIMARY KEY (`kode_waktu`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD CONSTRAINT `bensin_mobil_fk` FOREIGN KEY (`kode_bensin`) REFERENCES `bensin` (`kode_bensin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `merek_kendaraan_mobil_fk` FOREIGN KEY (`kode_merek`) REFERENCES `merek_kendaraan` (`kode_merek`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kendaraan_kursi`
--
ALTER TABLE `kendaraan_kursi`
  ADD CONSTRAINT `mobil_mobil_kursi_fk` FOREIGN KEY (`kode_kendaraan`) REFERENCES `kendaraan` (`kode_kendaraan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kendaraan_satker`
--
ALTER TABLE `kendaraan_satker`
  ADD CONSTRAINT `kendaraan_fk` FOREIGN KEY (`kode_kendaraan`) REFERENCES `kendaraan` (`kode_kendaraan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `satker_fk` FOREIGN KEY (`kode_satker`) REFERENCES `satker` (`kode_satker`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `kendaraan_pemesanan_fk` FOREIGN KEY (`kode_kendaraan`) REFERENCES `kendaraan` (`kode_kendaraan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lokasi_pemesanan_fk` FOREIGN KEY (`kode_lokasi`) REFERENCES `lokasi` (`kode_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`kode_satker`) REFERENCES `satker` (`kode_satker`),
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`nik`) REFERENCES `users` (`nik`),
  ADD CONSTRAINT `waktu_fk` FOREIGN KEY (`kode_waktu`) REFERENCES `waktu` (`kode_waktu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan_detail`
--
ALTER TABLE `pemesanan_detail`
  ADD CONSTRAINT `kendaraan_kursi_pemesanan_detail_fk` FOREIGN KEY (`kode_kursi`) REFERENCES `kendaraan_kursi` (`kode_kursi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_pemesanan_detail_fk` FOREIGN KEY (`kode_pemesanan`) REFERENCES `pemesanan` (`kode_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `satker_users_fk` FOREIGN KEY (`kode_satker`) REFERENCES `satker` (`kode_satker`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
