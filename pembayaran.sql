-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2021 at 08:51 AM
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
(240, 76, 1);

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
(1, 'Bisnis Daring Pemasaran'),
(2, 'Rekayasa Perangkat Lunak'),
(3, 'Desain Komunikasi Visual');

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
(1, 'PTS'),
(2, 'UKK');

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
(1, 1, 'X BDP 1'),
(2, 2, 'X RPL 1'),
(3, 3, 'X DKV 1'),
(4, 2, 'X RPL 2'),
(5, 1, 'X BDP 2');

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
(66, 'Data Jurusan', '', 0, 65, 'jurusan', 1),
(67, 'Data Kelas', '', 0, 65, 'kelas', 2),
(68, 'Data Pembayaran', '', 0, 65, 'pembayaran', 4),
(69, 'Data Siswa', '', 0, 65, 'siswa', 5),
(70, 'Data Kategori', '', 0, 65, 'kategori', 3),
(71, 'Transaksi', 'fas fa-credit-card', 1, 0, 'transaksi', 4),
(72, 'Data Transaksi', '', 0, 71, 'transaksi', 3),
(73, 'Transaksi Baru', '', 0, 71, 'transaksi/create', 2),
(74, 'Metode Pembayaran', '', 0, 71, 'metode_pembayaran', 1),
(75, 'Laporan', 'fas fa-book', 1, 0, 'laporan', 5),
(76, 'Laporan Transaksi', '', 0, 75, 'laporan', 1);

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
  `tahun_angkatan` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_kategori`, `id_jurusan`, `tahun_angkatan`, `nominal`, `keterangan`) VALUES
(4, 2, 3, 2020, 50000, ''),
(5, 2, 2, 2020, 50000, ''),
(6, 2, 1, 2020, 50000, '');

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
(1, 'Admin');

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
  `tahun_ajaran` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `aktif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_jurusan`, `id_kelas`, `nis`, `nama_siswa`, `tgl_lahir`, `jk`, `tahun_ajaran`, `email`, `password`, `aktif`) VALUES
(1, 1, 1, 17180009, 'Siti', '2001-12-15', 'P', 2020, NULL, NULL, 0),
(2, 2, 2, 171810001, 'adiatna', '2001-12-15', 'L', 2020, 'dyatna.id@gmail.com', '$2y$10$JLe2bA/73bWcxQmHqABkgO/GeG6ZBVDA8.bx7pKphtu/dn2VAhN/2', 1),
(3, 3, 3, 171810005, 'Muhammad Rivaldi', '2021-04-06', 'L', 2020, NULL, NULL, 0),
(4, 2, 2, 1718100003, 'Dimas Subagja', '2001-12-12', 'L', 2020, NULL, NULL, 0),
(5, 2, 2, 1718100002, 'M Dicki Alfauzan', '2002-12-15', 'L', 2020, NULL, NULL, 0),
(6, 2, 2, 171810004, 'Misal Audrie', '2001-12-12', 'L', 2020, NULL, NULL, 0),
(7, 2, 4, 17181, 'sahrul', '2001-12-12', 'L', 2020, NULL, NULL, 0),
(8, 2, 4, 1718110000, 'sukmana', '2003-12-15', 'L', 2020, NULL, NULL, 0),
(9, 3, 3, 1718100020, 'nadaha', '2001-12-15', 'L', 2020, NULL, NULL, 0),
(10, 1, 5, 171810002, 'Dian', '2001-12-15', 'P', 20202, '', NULL, 0);

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
(1, 2, '2021-04-09 08:55:41', 'T72ZQETF4PIY9DUUCKNJDZLGED06KRKU'),
(2, 2, '2021-04-09 08:56:37', 'O14SH9XGQNR2PC2CB2P5XJCAN09DQPT7'),
(3, 2, '2021-04-09 09:01:21', 'XO4RXFA6F9BRCQEKQILVZHD6EOPE1IQE'),
(4, 2, '2021-04-09 09:03:29', 'DYS48PLJVNTPFZ245AERFEE1U8U3WFVL'),
(5, 2, '2021-04-09 09:19:38', '00O9JHC23Z49IM9L2B9TF4EKC4ZDUWZQ');

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
(7, 'FK-0704210001', 6, 17180009, '2021-04-07 13:22:49', 2021, 50000, 'diterima', NULL, NULL),
(9, 'FK-0704210003', 4, 171810005, '2021-04-07 13:23:33', 2021, 50000, 'diterima', NULL, NULL),
(10, 'FK-0704210004', 5, 1718100002, '2021-04-07 13:23:46', 2021, 50000, 'diterima', NULL, NULL),
(11, 'FK-0704210005', 5, 171810004, '2021-04-07 13:32:35', 2021, 25000, 'diterima', NULL, NULL),
(12, 'FK-0704210006', 5, 171810004, '2021-04-07 14:48:55', 2021, 25000, 'diterima', NULL, NULL),
(13, 'FK-0904210001', 5, 171810001, '2021-04-09 11:18:37', 2021, 50000, 'diterima', 'cc35c5c65d3aeecbe882204ee43c8d80.jpeg', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` char(10) NOT NULL,
  `nama_user` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `telepon` char(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `alamat`, `jk`, `telepon`, `email`, `password`, `gambar`, `id_role`) VALUES
('', 'SUPERADMIN', 'BANDUNG', 'L', '083822623170', 'superadmin@admin.com', '$2y$10$t2LIGNkyTgoo.wfFq65HU.RMH3.maKSCVMYL1.ix0l.xZjAOfi1PK', 'man.png', 1),
('PTS00001', 'Administrator', 'Batulawang', 'L', '085864273756', 'admin@admin.com', '$2y$10$t2LIGNkyTgoo.wfFq65HU.RMH3.maKSCVMYL1.ix0l.xZjAOfi1PK', 'man-1.png', 1);

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
  MODIFY `akses_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `backup`
--
ALTER TABLE `backup`
  MODIFY `id_backup` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id_metode_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `token_siswa`
--
ALTER TABLE `token_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `token_user`
--
ALTER TABLE `token_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
