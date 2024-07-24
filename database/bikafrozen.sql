-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2024 at 07:42 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bikafrozen`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nm_barang` varchar(100) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `harga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_kategori`, `nm_barang`, `jumlah`, `foto`, `harga`) VALUES
(30, 2, 'Sosis Okey', 20, '044623050324sosis okey.jpg', '10000'),
(31, 1, 'Nugget Fiesta', 7, '044714050324nugget fiesta.jpg', '10000'),
(32, 1002, 'Daging Ayam Slice', 11, '044814050324daging ayam slice.png', '10000'),
(33, 1003, 'Chicken Katsu', 8, '044840050324chicken katsu.jpg', '10000'),
(34, 1004, 'Bakso Salam Ayam', 10, '044911050324salam ayam.jpg', '10000'),
(35, 1005, 'Kebab ', 11, '044939050324kebab.jpg', '10000'),
(36, 1006, 'Cedea Chikuwa', 28, '045033050324chikuwa.jpg', '10000'),
(37, 1007, 'Kulit Pangsit', 10, '045106050324pangsit.jpg', '10000'),
(38, 1008, 'Mix Vegetable', 7, '045131050324mix.jpg', '10000'),
(39, 1009, 'Prof Besar', 9, '045218050324prof.jpg', '10000'),
(40, 1010, 'Aice Cone', 17, '045244050324cone.jpg', '10000'),
(41, 1011, 'Basreng Pedas', 10, '045432050324basreng.jpeg', '10000'),
(42, 1012, 'Saos Barbeque', 10, '045441050324saos.jpg', '10000'),
(43, 1013, 'Spatula', 8, '045448050324spatula.jpg', '10000');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `id_supplier`, `id_barang`, `jumlah`, `tgl`) VALUES
(16, 5, 30, 2, '2024-03-05'),
(17, 6, 31, 2, '2024-03-05'),
(18, 8, 32, 5, '2024-03-05'),
(19, 9, 33, 2, '2024-03-05'),
(20, 12, 34, 3, '2024-03-05'),
(21, 11, 35, 3, '2024-03-05'),
(22, 14, 36, 23, '2024-03-05'),
(23, 10, 37, 2, '2024-03-05'),
(24, 6, 40, 10, '2024-03-05'),
(25, 10, 41, 5, '2024-03-05'),
(26, 6, 30, 2, '2024-03-20'),
(28, 5, 30, 5, '2024-03-22');

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `barang_masuk` AFTER INSERT ON `barang_masuk` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah = jumlah + NEW.jumlah
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `edit_barang` AFTER UPDATE ON `barang_masuk` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah = jumlah - OLD.jumlah + NEW.jumlah
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus` AFTER DELETE ON `barang_masuk` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah = jumlah - OLD.jumlah
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nm_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nm_kategori`) VALUES
(1, 'Nugget'),
(2, 'Sosis'),
(1002, 'Daging'),
(1003, 'Ayam Olahan'),
(1004, 'Bakso/Pentol'),
(1005, 'Makanan Olahan'),
(1006, 'Seafood Olahan'),
(1007, 'Kulit Olahan'),
(1008, 'Sayuran'),
(1009, 'Minuman'),
(1010, 'Ice Cream'),
(1011, 'Snack'),
(1012, 'Bumbu Masak'),
(1013, 'Alat Masak');

-- --------------------------------------------------------

--
-- Table structure for table `kondisi_barang`
--

CREATE TABLE `kondisi_barang` (
  `id_kondisi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `jumlah_baik` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kondisi_barang`
--

INSERT INTO `kondisi_barang` (`id_kondisi`, `id_barang`, `total`, `jumlah_baik`, `tgl`, `keterangan`) VALUES
(4, 27, 8, 8, '2024-01-11', 'ankasnk'),
(6, 25, 10, 10, '2024-01-11', 'jansjan\r\n'),
(7, 25, 10, 10, '2024-01-15', 'Hancur\r\n'),
(8, 30, 5, 5, '2024-01-22', 'Sobek'),
(9, 31, 1, 1, '2024-03-05', 'Sobek'),
(10, 32, 1, 0, '2024-03-05', 'Sobek'),
(11, 33, 1, 0, '2024-03-05', 'Sobek'),
(12, 34, 1, 0, '2024-03-05', 'Sobek'),
(13, 36, 1, 0, '2024-03-05', 'Sobek'),
(14, 38, 1, 0, '2024-03-05', 'Sobek'),
(15, 40, 1, 0, '2024-03-05', 'Sobek'),
(16, 41, 3, 0, '2024-03-05', 'Sobek'),
(17, 43, 1, 0, '2024-03-05', 'Patah');

--
-- Triggers `kondisi_barang`
--
DELIMITER $$
CREATE TRIGGER `edit_rusak` AFTER UPDATE ON `kondisi_barang` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah = jumlah + OLD.total - NEW.total
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus_rusak` AFTER DELETE ON `kondisi_barang` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah = jumlah + OLD.total
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_baik` AFTER UPDATE ON `kondisi_barang` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah = jumlah - OLD.jumlah_baik + NEW.jumlah_baik
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_rusask` AFTER INSERT ON `kondisi_barang` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah = jumlah - NEW.total
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `kota`, `harga`) VALUES
(1, '--pilih', ''),
(2, 'Jelapat', '7000'),
(3, 'Sanggu', '10000'),
(5, 'Buntok Kota', '5000'),
(7, 'Kartini', '6000');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `harga` varchar(50) NOT NULL,
  `alamat` varchar(225) DEFAULT NULL,
  `pembayaran` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id_order`, `id_pelanggan`, `id_ongkir`, `tgl`, `harga`, `alamat`, `pembayaran`) VALUES
(48, 9, 2, '2024-01-22', '50000', 'Jaya Karsa', 3),
(49, 10, 2, '2024-02-26', '50000', 'Adhyaksa', 3),
(53, 9, 7, '2024-02-26', '28000', 'adasdsa', 3),
(55, 14, 5, '2024-03-05', '35000', 'Jl. Panglima Batur No.26', 3),
(56, 13, 2, '2024-03-05', '47000', 'Jelapat', 3),
(57, 12, 3, '2024-03-05', '80000', 'Sanggu', 3),
(58, 15, 7, '2024-03-05', '66000', 'Kartini', 3),
(59, 15, 7, '2024-03-20', '36000', 'Jl. Patianom', 3),
(60, 10, 5, '2024-03-20', '25000', 'Pasar Lama', 3),
(61, 9, 2, '2024-03-20', '37000', 'Jelapat', 3),
(62, 9, 1, '2024-03-22', '0', NULL, 0),
(63, 9, 5, '2024-03-22', '0', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `tgl` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id_user`, `nama`, `tempat`, `tgl`, `alamat`, `no_hp`) VALUES
(4, 1, 'admin', 'Banjarmasin', '2018-09-15', 'Banjarmasin', '1434'),
(7, 7, 'ayu', 'jbasjb', '2018-10-02', 'asuas', '123'),
(8, 8, 'yua', 'yua', '2021-10-29', 'ssdaasd', '3728'),
(9, 9, 'yoga', 'Buntok', '2024-01-01', 'Jaya Karsa', '0817298172'),
(10, 10, 'dwi', 'Buntok', '2012-01-11', 'Adhyaksa', '0817298172'),
(11, 12, 'maulana', 'Jelapat', '2003-02-05', 'Kamper', '09178291'),
(12, 13, 'danur', 'Buntok', '2008-03-06', 'Jelapat', '097816291'),
(13, 14, 'rifqi', 'Danau Ganting', '2005-03-06', 'Jl. Pembangunan', '0197289017221'),
(14, 15, 'ika', 'Tanjung', '2021-06-10', 'Jaya Karsa', '081728121'),
(15, 16, 'febrina', 'Palangkaraya', '2001-03-01', 'Jl. Padat Karya', '01897269121');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `jumlah` int(10) NOT NULL,
  `total` int(10) NOT NULL,
  `harga` varchar(20) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_order`, `id_barang`, `tgl`, `jumlah`, `total`, `harga`, `status`) VALUES
(100, 48, 30, '2024-01-22', 1, 1, '19000', 2),
(101, 48, 31, '2024-01-22', 1, 1, '24000', 2),
(102, 49, 30, '2024-02-26', 1, 1, '19000', 2),
(103, 49, 31, '2024-02-26', 1, 1, '24000', 2),
(104, 53, 35, '2024-02-26', 1, 1, '22000', 2),
(106, 55, 34, '2024-03-05', 2, 2, '10000', 2),
(107, 55, 39, '2024-03-05', 1, 1, '10000', 2),
(108, 56, 35, '2024-03-05', 1, 1, '10000', 2),
(109, 56, 38, '2024-03-05', 1, 1, '10000', 2),
(110, 56, 32, '2024-03-05', 2, 2, '10000', 2),
(111, 57, 31, '2024-03-05', 1, 1, '10000', 2),
(112, 57, 36, '2024-03-05', 4, 4, '10000', 2),
(113, 57, 40, '2024-03-05', 2, 2, '10000', 2),
(114, 58, 33, '2024-03-05', 2, 2, '10000', 2),
(115, 58, 31, '2024-03-05', 2, 2, '10000', 2),
(116, 58, 30, '2024-03-05', 2, 2, '10000', 2),
(117, 59, 43, '2024-03-20', 1, 1, '10000', 2),
(118, 59, 38, '2024-03-20', 1, 1, '10000', 2),
(119, 59, 33, '2024-03-20', 1, 1, '10000', 2),
(120, 60, 37, '2024-03-20', 2, 2, '10000', 2),
(121, 61, 41, '2024-03-20', 2, 2, '10000', 2),
(122, 61, 32, '2024-03-20', 1, 1, '10000', 2);

--
-- Triggers `pesanan`
--
DELIMITER $$
CREATE TRIGGER `pesan` AFTER UPDATE ON `pesanan` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah = jumlah - NEW.total 
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nm_supplier` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nm_supplier`, `alamat`, `kota`, `telp`) VALUES
(5, 'Rayen', 'Jl. Adhyaksa', 'Banjarmasin', '0819729812'),
(6, 'Mr. Frozen', 'Jl. Panglima Batur', 'Buntok', '097898172'),
(7, 'Kumakan Frozen Food', 'Jl. Perdagangan Raya', 'Banjarmasin', '018972801'),
(8, 'Dinar Frozen Food', 'Jl. Brig. Jend. H. Hasan Basry', 'Banjarmasin', '062521131'),
(9, 'Angga Frozen Food', 'Jl. HKSN', 'Banjarmasin', '081762871'),
(10, 'Sultan Frozen Food', 'Jalur I No.4, Sungai Miai', 'Banjarmasin', '07362513'),
(11, 'HAPPY Frozen Food', 'Surgi Mufti', 'Banjarmasin', '086716212'),
(12, 'Inara Frozen Food', 'Jl. HKSN', 'Banjarmasin', '086727816271'),
(13, 'Arshaka Frozen Food', 'Komp. Bumi Graha Lestari', 'Banjarmasin', '087212981'),
(14, 'Metrofrozen Food', 'Jl. Bumi Mas Raya', 'Banjarmasin', '0828162871');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `password`, `level`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
(4, 'sam', 'sam', '332532dcfaa1cbf61e2a266bd723612c', 'Pelanggan'),
(5, 'adi', 'adi', 'c46335eb267e2e1cde5b017acb4cd799', 'Pelanggan'),
(6, 'adi', 'adi', 'c46335eb267e2e1cde5b017acb4cd799', 'Pelanggan'),
(7, 'ayu', 'ayu', '29c65f781a1068a41f735e1b092546de', 'Pelanggan'),
(8, 'yua', 'yua', 'edacd35b04c42c20460cb169b94e0322', 'Pelanggan'),
(9, 'user', 'yoga', 'ee11cbb19052e40b07aac0ca060c23ee', 'Pelanggan'),
(10, 'dwi', 'dwi', '7aa2602c588c05a93baf10128861aeb9', 'Pelanggan'),
(11, 'user', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'Pelanggan'),
(12, 'maulana', 'maulana', 'aff4b352312d5569903d88e0e68d3fbb', 'Pelanggan'),
(13, 'danur', 'danur', '8b87993052d09f0e66f67020b9b8734b', 'Pelanggan'),
(14, 'rifqi', 'rifqi', '72561baf6079c338cc2dd68e98d52055', 'Pelanggan'),
(15, 'ika', 'ika', '7965c82127bd8517d2495e8efb12702c', 'Pelanggan'),
(16, 'febrina', 'febrina', 'c8abfd0961c1f7b701aab155299d1170', 'Pelanggan'),
(17, 'febrina', 'febrina', 'c8abfd0961c1f7b701aab155299d1170', 'Pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kondisi_barang`
--
ALTER TABLE `kondisi_barang`
  ADD PRIMARY KEY (`id_kondisi`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_pelanggan` (`id_pelanggan`,`id_ongkir`),
  ADD KEY `id_ongkir` (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_order` (`id_order`,`id_barang`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1014;

--
-- AUTO_INCREMENT for table `kondisi_barang`
--
ALTER TABLE `kondisi_barang`
  MODIFY `id_kondisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE;

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE;

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_4` FOREIGN KEY (`id_order`) REFERENCES `order` (`id_order`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
