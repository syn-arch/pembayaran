-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2021 at 12:16 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pembayaran`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses_role`
--

CREATE TABLE `akses_role` (
  `akses_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akses_role`
--

INSERT INTO `akses_role` (`akses_role`, `id_menu`, `id_role`) VALUES
(212, 9, 1),
(213, 10, 1),
(214, 11, 1),
(215, 1, 1),
(218, 23, 1),
(220, 27, 1),
(221, 22, 1),
(222, 57, 1),
(223, 62, 1),
(227, 24, 1),
(228, 64, 1),
(229, 65, 1),
(230, 66, 1),
(231, 67, 1),
(232, 70, 1),
(233, 68, 1),
(234, 69, 1),
(235, 71, 1),
(236, 74, 1),
(237, 73, 1),
(238, 72, 1),
(239, 75, 1),
(240, 76, 1),
(241, 77, 1),
(242, 1, 3),
(243, 9, 3),
(244, 10, 3),
(245, 65, 3),
(246, 77, 3),
(247, 66, 3),
(248, 67, 3),
(249, 69, 3),
(250, 70, 3),
(251, 68, 3),
(252, 71, 3),
(253, 74, 3),
(254, 73, 3),
(255, 72, 3),
(256, 75, 3),
(257, 76, 3),
(258, 22, 3);

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE `backup` (
  `id_backup` int(11) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `file` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(13, 'REKAYASA PERANGKAT LUNAK'),
(14, 'BISNIS DARING PEMASARAN'),
(15, 'DESAIN KOMUNIKASI VISUAL');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(4, 'UJI KOMPETENSI');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_jurusan`, `nama_kelas`) VALUES
(21, 13, '12 RPL 1'),
(22, 13, '12 RPL 2'),
(23, 13, '12 RPL 3'),
(24, 14, '12 BDP 1'),
(25, 14, '12 BDP 2'),
(26, 15, '12 DKV 1');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `ada_submenu` int(11) NOT NULL,
  `submenu` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `icon`, `ada_submenu`, `submenu`, `url`, `urutan`) VALUES
(1, 'Dashboard', 'fa fa-tachometer-alt', 0, 0, 'dashboard', 1),
(9, 'User', 'fas fa-user-friends', 1, 0, 'user', 2),
(10, 'Data User', 'fas fa-user-shield', 0, 9, 'user', 1),
(11, 'Akses Menu User', 'fas fa-shield-alt', 0, 9, 'user/akses', 2),
(22, 'Profil Saya', 'fa fa-user', 0, 0, 'profil', 7),
(23, 'Utilitas', 'fas fa-cog', 1, 0, 'utilitas', 6),
(24, 'Backup Database', 'fas fa-database', 0, 23, 'utilitas/backup', 1),
(27, 'Pengaturan', 'fas fa-cogs', 0, 0, 'pengaturan', 8),
(62, 'Menu Management', 'fa fa-bars', 0, 23, 'menu', 3),
(64, 'CRUD Generator', 'fas fa-edit', 0, 23, 'crud_generator', 2),
(65, 'Master', 'fas fa-box', 1, 0, 'master', 3),
(66, 'Data Jurusan', '', 0, 65, 'jurusan', 2),
(67, 'Data Kelas', '', 0, 65, 'kelas', 3),
(68, 'Data Pembayaran', '', 0, 65, 'pembayaran', 6),
(69, 'Data Siswa', '', 0, 65, 'siswa', 4),
(70, 'Data Kategori', '', 0, 65, 'kategori', 5),
(71, 'Transaksi', 'fas fa-credit-card', 1, 0, 'transaksi', 4),
(72, 'Data Transaksi', '', 0, 71, 'transaksi', 3),
(73, 'Transaksi Baru', '', 0, 71, 'transaksi/create', 2),
(74, 'Metode Pembayaran', '', 0, 71, 'metode_pembayaran', 1),
(75, 'Laporan', 'fas fa-book', 1, 0, 'laporan', 5),
(76, 'Laporan Transaksi', '', 0, 75, 'laporan', 1),
(77, 'Data Tahun Ajaran', '', 0, 65, 'tahun_ajaran', 1);

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id_metode_pembayaran` int(11) NOT NULL,
  `nama_bank` varchar(255) NOT NULL,
  `atas_nama` varchar(255) NOT NULL,
  `no_rekening` varchar(255) NOT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id_metode_pembayaran`, `nama_bank`, `atas_nama`, `no_rekening`, `keterangan`) VALUES
(1, 'BRI', 'Adiatna', '1718100009', ''),
(2, 'BNI', 'Abdurrahman', '1718100001', '');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_kategori`, `id_jurusan`, `id_tahun_ajaran`, `nominal`, `keterangan`) VALUES
(1, 4, 13, 7, 150000, '');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `nama_aplikasi` varchar(255) NOT NULL,
  `logo` varchar(128) NOT NULL,
  `smtp_host` varchar(128) NOT NULL,
  `smtp_email` varchar(128) NOT NULL,
  `smtp_username` varchar(128) NOT NULL,
  `smtp_password` varchar(128) NOT NULL,
  `smtp_port` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id_pengaturan`, `nama_aplikasi`, `logo`, `smtp_host`, `smtp_email`, `smtp_username`, `smtp_password`, `smtp_port`) VALUES
(1, 'APP PEMBAYARAN', 'layers.png', 'ssl://smtp.gmail.com', 'shadowRose069@gmail.com', 'BBC PEMBAYARAN', 'roseShadow255', 465);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'Superadmin'),
(3, 'Admin'),
(4, 'Petugas');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `aktif` int(11) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `atas_nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `no_rekening` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_jurusan`, `id_kelas`, `nis`, `nama_siswa`, `tgl_lahir`, `jk`, `id_tahun_ajaran`, `email`, `password`, `aktif`, `barcode`, `atas_nama`, `bank`, `no_rekening`) VALUES
(1, 13, 21, 111, 'ANNISA AULIA', '2001-01-01', 'P', 7, NULL, '$2y$10$wa0qriUgU390238FatQdCuqWDQca9Aahx.RDL9Sb/YHjUqSebbKqK', 0, '111', '', '', ''),
(2, 13, 22, 222, 'WIGA ADITIA', '2001-01-01', 'L', 7, NULL, '$2y$10$ngWOKOLXmF2PCk2c9076c.Mtb1euLwhdXaIYFJIKN72xePwpaKhaC', 0, '222', '', '', ''),
(3, 13, 23, 333, 'ADIATNA SUKMANA', '2001-01-01', 'L', 7, 'dyatna.id@gmail.com', '$2y$10$HulCVJX1t5ecTFOUypyu/u7VY5fTToI76zMjyDCCXOOhTKF5Br/hC', 1, '333', 'Adiatna Sukmana', 'BRI', '1718100009'),
(4, 14, 24, 444, 'SITI MULYANI', '2001-01-01', 'P', 7, NULL, '$2y$10$MO6BUC6GZAj2UB2cC4KdQOg6Kw7CLlIZEPszgktdGMUyl1QHEErxm', 0, '444', '', '', ''),
(5, 14, 25, 555, 'DIDAN ABDILAH', '2001-01-01', 'L', 7, NULL, '$2y$10$7HTy1aUT0h9q1CXnMh2OKOOheX3DpCmeVmQ4o9fUaB0rFO.oZP3da', 0, '555', '', '', ''),
(6, 15, 26, 666, 'NADHA RAMADHAN', '2001-01-01', 'L', 7, NULL, '$2y$10$qEEG2kbpWTopKOyPTyn1vuGu5BRZNA7AmrN9QTS3XldbF5HEU8pIi', 0, '666', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id_tahun_ajaran` int(11) NOT NULL,
  `tahun_ajaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id_tahun_ajaran`, `tahun_ajaran`) VALUES
(7, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `token_siswa`
--

CREATE TABLE `token_siswa` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token_siswa`
--

INSERT INTO `token_siswa` (`id`, `id_siswa`, `tgl`, `token`) VALUES
(11, 3, '2021-04-30 21:58:14', 'DCQE7V5EODA2VZIEKC1PHO7SSMW7EKES'),
(12, 3, '2021-04-30 21:58:30', 'G59FQAT5BGY45216B5HVZCZ7H5H8RJD9'),
(13, 3, '2021-04-30 22:01:08', 'HMBMV9T88AP4QPLA6DQ4AYVYAZEWR1GV');

-- --------------------------------------------------------

--
-- Table structure for table `token_user`
--

CREATE TABLE `token_user` (
  `id` int(11) NOT NULL,
  `id_user` char(10) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `no_faktur` varchar(255) NOT NULL,
  `id_pembayaran` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tahun_dibayar` int(11) NOT NULL,
  `jumlah_dibayar` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `no_faktur`, `id_pembayaran`, `nis`, `tgl`, `tahun_dibayar`, `jumlah_dibayar`, `status`, `bukti_pembayaran`, `keterangan`) VALUES
(1, 'FK-0105210001', 1, 333, '2021-04-30 22:13:55', 2021, 150000, 'diterima', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` char(10) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `nama_user` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `telepon` char(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `id_role` int(11) NOT NULL,
  `petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_jurusan`, `nama_user`, `alamat`, `jk`, `telepon`, `email`, `password`, `gambar`, `id_role`, `petugas`) VALUES
('', 0, 'SUPERADMIN', 'BANDUNG', 'L', '083822623170', 'superadmin@admin.com', '$2y$10$t2LIGNkyTgoo.wfFq65HU.RMH3.maKSCVMYL1.ix0l.xZjAOfi1PK', 'man.png', 1, 0),
('PTS00001', 0, 'Administrator', 'Batulawang', 'L', '085864273756', 'superadmin@superadmin.com', '$2y$10$SRP/yG.Ld65tUXzNhV5q7O4UPCahMU5I./RV5NsI4VYS1iTncAmBm', 'man-1.png', 1, 0),
('PTS00002', 0, 'Admin', 'Bandung', 'L', '083822623170', 'admin@admin.com', '$2y$10$EBqRO8Q7ZljT9.bI/rdK..42lrYn5PA1pc3wG.hQem3jXEbQ.h4Ve', 'd7128161dc2c2bb320ce892df4983d6b.png', 3, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses_role`
--
ALTER TABLE `akses_role`
  ADD PRIMARY KEY (`akses_role`);

--
-- Indexes for table `backup`
--
ALTER TABLE `backup`
  ADD PRIMARY KEY (`id_backup`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id_metode_pembayaran`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id_tahun_ajaran`);

--
-- Indexes for table `token_siswa`
--
ALTER TABLE `token_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token_user`
--
ALTER TABLE `token_user`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `akses_role`
--
ALTER TABLE `akses_role`
  MODIFY `akses_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT for table `backup`
--
ALTER TABLE `backup`
  MODIFY `id_backup` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id_metode_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id_tahun_ajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `token_siswa`
--
ALTER TABLE `token_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `token_user`
--
ALTER TABLE `token_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
