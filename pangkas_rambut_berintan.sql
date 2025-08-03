-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2025 at 09:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pangkas_rambut_berintan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nomor_telepon` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_lengkap`, `email`, `password`, `nomor_telepon`, `created_at`) VALUES
(1, 'Admin Utama', 'admin@berintan.com', 'admin123', '089518887402', '2025-07-16 07:58:46');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `waktu_booking` datetime NOT NULL,
  `status` enum('Pending','Confirmed','Completed','Cancelled','No Show') NOT NULL DEFAULT 'Pending',
  `catatan` text DEFAULT NULL,
  `harga_total` decimal(12,2) NOT NULL,
  `tanggal_diupdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `id_pelanggan`, `id_layanan`, `waktu_booking`, `status`, `catatan`, `harga_total`, `tanggal_diupdate`) VALUES
(2, 2, 2, '2025-07-15 17:00:00', 'Completed', '', 50000.00, '2025-08-01 15:37:22'),
(10, 2, 3, '2025-07-23 15:00:00', 'Completed', '', 110000.00, '2025-08-01 15:37:22'),
(14, 2, 3, '2025-07-24 17:00:00', 'Completed', '', 110000.00, '2025-08-01 15:37:22'),
(15, 2, 1, '2025-07-28 12:00:00', 'Completed', '', 75000.00, '2025-08-01 15:37:22'),
(17, 2, 3, '2025-07-29 20:00:00', 'Completed', '', 110000.00, '2025-08-01 15:37:22'),
(18, 2, 1, '2025-07-29 17:00:00', 'Completed', '', 75000.00, '2025-08-01 15:37:22'),
(19, 2, 2, '2025-07-30 10:00:00', 'Completed', '', 50000.00, '2025-08-01 15:37:22'),
(22, 2, 2, '2025-07-30 12:00:00', 'Completed', '', 50000.00, '2025-08-01 15:37:22'),
(25, 2, 3, '2025-07-30 12:00:00', 'Completed', '', 110000.00, '2025-08-01 15:37:22'),
(34, 3, 3, '2025-08-02 10:00:00', 'Cancelled', '', 110000.00, '2025-08-01 15:39:55');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(11) NOT NULL,
  `nama_layanan` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(12,2) NOT NULL,
  `durasi_menit` int(11) NOT NULL,
  `aktif` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nama_layanan`, `deskripsi`, `harga`, `durasi_menit`, `aktif`) VALUES
(1, 'Gentleman\'s Cut', 'Potongan rambut klasik atau modern, lengkap dengan konsultasi gaya, cuci, dan styling.', 75000.00, 40, 1),
(2, 'Berintan Shave & Groom', 'Cukur jenggot dan kumis tradisional menggunakan handuk panas dan pisau cukur.', 50000.00, 25, 1),
(3, 'Paket Komplit', 'Kombinasi Gentleman\'s Cut dan Berintan Shave untuk penampilan maksimal.', 110000.00, 60, 1),
(9, 'Haircut Anak', 'Layanan potong rambut untuk anak-anak usia 3–12 tahun.', 25000.00, 25, 1),
(10, 'Haircut + Creambath', 'Potong rambut disertai creambath untuk menyegarkan kulit kepala.', 60000.00, 60, 1),
(11, 'Cukur Kumis & Jenggot', 'Perapian dan pencukuran kumis atau jenggot menggunakan alat steril.', 20000.00, 20, 1),
(13, 'Facial Pria', 'Perawatan wajah untuk membersihkan dan menyegarkan kulit pria.', 50000.00, 45, 1),
(14, 'Hair Coloring (Highlight)', 'Pewarnaan highlight rambut pria dengan warna pilihan.', 80000.00, 60, 1),
(15, 'Hair Toning Abu-Abu', 'Toning rambut dengan hasil warna abu-abu elegan.', 90000.00, 50, 1),
(16, 'Paket VIP (Haircut + Cuci + Facial + Styling)', 'Paket lengkap dengan pelayanan eksklusif.', 120000.00, 90, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nomor_telepon` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_lengkap`, `nomor_telepon`, `email`, `password_hash`) VALUES
(2, 'Moch Syahrizal Fauzan', '032540980293', 'rizal@gmail.com', '$2y$10$OMcegrGOSBh9sMOifbAjnuQrJUQTeyUpb4fqW1yQCkUBm0Kvpr5j2'),
(3, 'Romlah', '084566558979', 'romlah@gmail.com', '$2y$10$Nv4RQn3BYZknRlTF6bJDD.4uGPpyJQJyRvgJTsAbyOongEJ5mYPJ6'),
(4, 'Sore', '0855447765', 'sore@gmail.com', '$2y$10$zE0SsB0dxG7fppTFuhNEzuA2gX5sGGFujZ7MTiw4/0RyuQmBWQUgO');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_booking` int(11) NOT NULL,
  `jumlah_bayar` decimal(12,2) NOT NULL,
  `metode_pembayaran` enum('Cash','Transfer','QRIS','Debit') DEFAULT 'Cash',
  `status_pembayaran` enum('DP','Lunas','Belum Bayar') DEFAULT 'Belum Bayar',
  `tanggal_bayar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_layanan` (`id_layanan`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `nomor_telepon` (`nomor_telepon`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_booking` (`id_booking`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_booking`) REFERENCES `booking` (`id_booking`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
