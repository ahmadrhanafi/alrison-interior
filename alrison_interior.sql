-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 09, 2025 at 01:15 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alrison_interior`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `kategori` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi_kategori` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int NOT NULL,
  `id_user` int NOT NULL,
  `id_produk` int NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` int NOT NULL,
  `jumlah` int NOT NULL,
  `total_harga` int NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_user`, `id_produk`, `nama_produk`, `harga`, `jumlah`, `total_harga`, `gambar`, `created_at`, `updated_at`) VALUES
(7, 6, 33, 'Kursi Rotan Kayu Plastik Jati Betawi', 1400000, 1, 1400000, '1749086538_ce80aaef4ad0151a37aa.jpg', '2025-06-05 20:04:14', '2025-06-05 20:04:14'),
(9, 6, 39, 'Buffet TV Buffet Pajangan ', 2500000, 1, 2500000, 'buffet pajangan 1.jpg', '2025-06-05 20:06:02', '2025-06-05 20:06:02'),
(21, 3, 37, 'Meja maka kayu rotan', 2100000, 2, 4200000, '1749096692_3a2b4f74dc6594061efd.jpg', '2025-06-06 17:23:07', '2025-06-06 17:25:45'),
(24, 9, 12, 'Lemari Olympic 3 Pintu', 900000, 1, 900000, '1748919872_18b3dece86714c54e5f6.jpg', '2025-06-07 16:46:51', '2025-06-07 16:46:51'),
(26, 9, 19, 'Lemari Sepatu Rak Sepatu', 850000, 1, 850000, '1748922330_0f3e547532583cca4e67.jpg', '2025-06-07 17:12:04', '2025-06-07 17:12:04'),
(27, 9, 36, 'lemari jati terang', 1800000, 1, 1800000, '1749087641_ab207d10d7cc0b4532a2.jpg', '2025-06-07 17:12:09', '2025-06-07 17:12:09'),
(34, 2, 14, 'Buffet TV Jati', 2500000, 1, 2500000, '1748922150_19f91b0d54a506b6867c.jpg', '2025-06-08 22:36:03', '2025-06-08 22:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `id_konsumen` int NOT NULL,
  `nama_konsumen` varchar(50) NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`id_konsumen`, `nama_konsumen`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(3, 'Tio', '087875413212', 'Jln. Cendrawasih', '2025-06-09 14:03:06', '2025-06-09 14:03:06'),
(4, 'Norman', '087645324655', 'Jln Merbabu', '2025-06-09 14:06:39', '2025-06-09 14:06:39');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `kode_pesanan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_pemesan` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat_pengiriman` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total_harga` int DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_user`, `kode_pesanan`, `nama_pemesan`, `no_hp`, `alamat_pengiriman`, `total_harga`, `status`, `created_at`, `updated_at`) VALUES
(11, 0, 'ALR20250515051922306', 'Rara', '21341234', 'Jln. Pancoran Mas 123', 800000, '0', '2025-05-15 05:19:22', '2025-05-15 05:19:22'),
(18, 0, 'AR202505151018237CBE', 'Sarah', '08445132181321', 'Jln. Pancoran Mas 123', 800000, '0', '2025-05-15 10:18:23', '2025-05-15 10:18:23'),
(19, 0, 'AR20250515101844FAC1', 'Sarah', '08657554356', 'Perumahan Bumi Permai, Jalan Gondang Jati 17, RT 09 RW 03, Matraman, Jakarta Timur, 13110.', 1800000, '0', '2025-05-15 10:18:44', '2025-05-15 10:18:44'),
(20, 0, 'AR20250515102050AC4A', 'Dafa', '43213431242', 'Perumahan Bumi Permai, Jalan Gondang Jati 17, RT 09 RW 03, Matraman, Jakarta Timur, 13110.', 650000, '0', '2025-05-15 10:20:50', '2025-05-15 10:20:50'),
(21, 0, 'AR20250515102121B290', 'Sarah', '0843212123104', 'Jln. Mekarsari No.82', 1200000, '0', '2025-05-15 10:21:21', '2025-05-15 10:21:21'),
(22, 0, 'AR20250516071219D292', 'Sarah', '08741312584', 'Jln. Pancoran Mas 123', 1400000, '0', '2025-05-16 07:12:19', '2025-05-16 07:12:19'),
(23, 0, 'AR202505160934216D91', 'Radik', '08745654544', 'Jln. Parung 123', 650000, '0', '2025-05-16 09:34:21', '2025-05-16 09:34:21'),
(30, 0, 'AR20250517083822ECF2', 'Dafa', '08741284451', 'Jln. Mekarsari No.82', 650000, '0', '2025-05-17 08:38:22', '2025-05-17 08:38:22'),
(32, 0, 'AR20250517091049E386', 'Sarah', '08743213452', 'Jln. Pancoran Mas 123', 1200000, '0', '2025-05-17 09:10:49', '2025-05-17 09:10:49'),
(33, 0, 'AR202505170914417511', 'Sarah', '08713452024', 'Jln. Pancoran Mas 123', 1200000, '0', '2025-05-17 09:14:41', '2025-05-17 09:14:41'),
(35, 0, 'AR202505170919111852', 'Sarah', '1278641', 'Jln. Pancoran Mas 123', 1200000, '0', '2025-05-17 09:19:11', '2025-05-17 09:19:11'),
(47, 0, 'AR20250517145247D094', 'Ferdi', '08784212233', 'Jln. Pancoran Mas 123', 2550000, 'Diproses', '2025-05-17 14:52:47', '2025-05-18 13:15:54'),
(48, NULL, 'AR2025051714545838E9', 'Hardono', '08784123143', 'Jln. Mekarsari No.82', 1560000, 'Dibatalkan', '2025-05-17 14:54:58', '2025-05-17 20:32:14'),
(51, 2, 'AR202505171645009831', 'Kamil', '08784131245', 'Jln. Pancoran Mas 123', 500000, 'Selesai', '2025-05-17 16:45:00', '2025-06-02 16:43:30'),
(52, 2, 'AR20250517164556EDC0', 'Herman', '08768452564', 'Jln. Pancoran Mas 123', 760000, 'Selesai', '2025-05-17 16:45:56', '2025-05-18 08:01:00'),
(60, 3, 'AR202506010619118EDB', 'Tio', '087984231', 'Jln. Parung 123', 720000, 'Selesai', '2025-06-01 06:19:11', '2025-06-02 16:44:32'),
(61, 3, 'AR202506010634015DE0', 'Hermansyah', '08789654102', 'Jln. Pancoran Mas 123', 1300000, 'Menunggu Pembayaran', '2025-06-01 06:34:01', '2025-06-01 06:34:01'),
(62, 3, 'AR202506010636532F50', 'Kurnia', '08745423154', 'Jln. Pancoran Mas 123', 1560000, 'Selesai', '2025-06-01 06:36:53', '2025-06-09 18:12:18'),
(65, 2, 'AR202506022020104DD8', 'Rama', '08789731231', 'Perumahan Bumi Permai, Jalan Gondang Jati 17, RT 09 RW 03, Matraman, Jakarta Timur, 13110.', 920000, 'Menunggu Pembayaran', '2025-06-02 20:20:10', '2025-06-02 20:20:10'),
(74, 11, 'AR20250603195009EACC', 'Joni', '084542446', 'Jl taman amir', 2000000, 'Menunggu Pembayaran', '2025-06-03 19:50:09', '2025-06-03 19:50:09'),
(78, 6, 'AR2025060515172121CE', 'Angel', '087978452132', 'Jln. Mekarsari No.82', 2100000, 'Selesai', '2025-06-05 15:17:21', '2025-06-09 18:12:04'),
(79, 21, 'AR202506051745020243', 'Si ganteng', '089657951760', 'Parung', 2500000, 'Menunggu Pembayaran', '2025-06-05 17:45:02', '2025-06-05 17:45:02'),
(80, 6, 'AR202506051938460D04', 'Farid', '087984121221', 'Perumahan Bumi Permai, Jalan Gondang Jati 17, 13110.', 6800000, 'Menunggu Pembayaran', '2025-06-05 19:38:46', '2025-06-05 19:38:46'),
(86, 9, 'AR202506081957132F12', 'Kuproy', '08798431231', 'Jln. Mekarsari No.82', 850000, 'Menunggu Pembayaran', '2025-06-08 19:57:13', '2025-06-08 19:57:13'),
(91, 4, 'AR20250609194644937D', 'Radic', '085894511225', 'Jln. Parung No.123', 5300000, 'Menunggu Pembayaran', '2025-06-09 19:46:44', '2025-06-09 19:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `id_detail` int NOT NULL,
  `id_pesanan` int NOT NULL,
  `id_produk` int NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `gambar` text NOT NULL,
  `jumlah` int NOT NULL,
  `harga` int NOT NULL,
  `total_harga` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`id_detail`, `id_pesanan`, `id_produk`, `kategori`, `nama_produk`, `gambar`, `jumlah`, `harga`, `total_harga`, `created_at`, `updated_at`) VALUES
(3, 3, 2, '0', 'Lemari Buku Anak Belajar', 'cupboard-removebg-preview.png', 1, 0, 800000, '2025-05-15 04:11:00', '2025-05-15 04:11:00'),
(4, 4, 3, '0', 'Kursi Gaming', 'work-chair-removebg-preview.png', 1, 0, 650000, '2025-05-15 04:13:27', '2025-05-15 04:13:27'),
(11, 11, 2, '0', 'Lemari Buku Anak Belajar', 'cupboard-removebg-preview.png', 1, 0, 800000, '2025-05-15 05:19:22', '2025-05-15 05:19:22'),
(18, 18, 2, '0', 'Lemari Buku Anak Belajar', 'cupboard-removebg-preview.png', 1, 0, 800000, '2025-05-15 10:18:23', '2025-05-15 10:18:23'),
(19, 19, 7, '0', 'Kasur Bigfoam', 'bed-removebg-preview.png', 1, 0, 1800000, '2025-05-15 10:18:44', '2025-05-15 10:18:44'),
(20, 20, 3, '0', 'Kursi Gaming', 'work-chair-removebg-preview.png', 1, 0, 650000, '2025-05-15 10:20:50', '2025-05-15 10:20:50'),
(21, 21, 8, '0', 'Sofa', 'sofa-removebg-preview.png', 1, 0, 1200000, '2025-05-15 10:21:21', '2025-05-15 10:21:21'),
(22, 22, 18, '0', 'Sofa Bed', '1747306229_c70dff855447dbb7b9c9.png', 1, 0, 1400000, '2025-05-16 07:12:19', '2025-05-16 07:12:19'),
(23, 23, 3, '0', 'Kursi Kantor Merk Kuca', 'work-chair-removebg-preview.png', 1, 0, 650000, '2025-05-16 09:34:21', '2025-05-16 09:34:21'),
(30, 30, 3, '0', 'Kursi Kantor Merk Kuca', 'work-chair-removebg-preview.png', 1, 0, 650000, '2025-05-17 08:38:22', '2025-05-17 08:38:22'),
(32, 32, 8, '0', 'Sofa Keluarga', 'sofa-removebg-preview.png', 1, 0, 1200000, '2025-05-17 09:10:49', '2025-05-17 09:10:49'),
(33, 33, 8, '0', 'Sofa Keluarga', 'sofa-removebg-preview.png', 2, 0, 2400000, '2025-05-17 09:14:41', '2025-05-17 09:14:41'),
(46, 47, 9, 'Buffet TV', 'Buffet TV Kayu', 'buffet-tv-removebg-preview.png', 3, 850000, 2550000, '2025-05-17 14:52:47', '2025-05-17 14:52:47'),
(47, 48, 12, 'Meja Kantor', 'Meja Komputer', 'work-table-removebg-preview.png', 2, 780000, 1560000, '2025-05-17 14:54:58', '2025-05-17 14:54:58'),
(50, 51, 10, 'Kursi Bar', 'Kursi Meja Makan', 'chair-removebg-preview.png', 2, 250000, 500000, '2025-05-17 16:45:00', '2025-05-17 16:45:00'),
(51, 52, 15, 'Kursi Teras', 'Kursi Goyang Lansia', 'patio-chairs-removebg-preview.png', 2, 380000, 760000, '2025-05-17 16:45:56', '2025-05-17 16:45:56'),
(59, 60, 19, 'Meja Makan', 'Meja Kayu 4 Kaki', 'table-removebg-preview.png', 2, 360000, 720000, '2025-06-01 06:19:11', '2025-06-01 06:19:11'),
(60, 61, 24, 'Kursi Kantor', 'Kursi Kantor Kursi Gaming', 'work-chair-removebg-preview.png', 2, 650000, 1300000, '2025-06-01 06:34:02', '2025-06-01 06:34:02'),
(61, 62, 12, 'Meja Kantor', 'Meja Komputer', 'work-table-removebg-preview.png', 2, 780000, 1560000, '2025-06-01 06:36:53', '2025-06-01 06:36:53'),
(64, 65, 30, 'Kursi Teras', 'Kursi Rotan Plastik', 'kursi teras estetik.jpg', 1, 920000, 920000, '2025-06-02 20:20:10', '2025-06-02 20:20:10'),
(73, 74, 2, 'Sofa', 'Sofa Jaguar Mini L Sudut', '1748920385_b2975a0c5b2067e2a2a8.jpg', 1, 2000000, 2000000, '2025-06-03 19:50:09', '2025-06-03 19:50:09'),
(77, 78, 37, 'Meja Makan', 'Meja maka kayu rotan', '1749096692_3a2b4f74dc6594061efd.jpg', 1, 2100000, 2100000, '2025-06-05 15:17:21', '2025-06-05 15:17:21'),
(78, 79, 34, 'Sofa', 'Sofa Uhuyyy', '1749097992_717ba50d2f8d06e82aca.jpg', 1, 2500000, 2500000, '2025-06-05 17:45:02', '2025-06-05 17:45:02'),
(79, 80, 36, 'Lemari Pakaian', 'lemari jati terang', '1749087641_ab207d10d7cc0b4532a2.jpg', 1, 1800000, 1800000, '2025-06-05 19:38:46', '2025-06-05 19:38:46'),
(80, 80, 39, 'Buffet Pajangan', 'Buffet TV Buffet Pajangan ', 'buffet pajangan 1.jpg', 1, 2500000, 2500000, '2025-06-05 19:38:46', '2025-06-05 19:38:46'),
(81, 80, 34, 'Sofa', 'Sofa Uhuyyy', '1749097992_717ba50d2f8d06e82aca.jpg', 1, 2500000, 2500000, '2025-06-05 19:38:46', '2025-06-05 19:38:46'),
(88, 86, 17, 'Kursi Kantor', 'Meja Komputer', '1748921863_cf45872e4914b0a6803c.jpg', 1, 850000, 850000, '2025-06-08 19:57:13', '2025-06-08 19:57:13'),
(96, 91, 33, 'Kursi Teras', 'Kursi Rotan Kayu Plastik Jati Betawi', '1749086538_ce80aaef4ad0151a37aa.jpg', 1, 1400000, 1400000, '2025-06-09 19:46:44', '2025-06-09 19:46:44'),
(97, 91, 14, 'Buffet TV', 'Buffet TV Jati', '1748922150_19f91b0d54a506b6867c.jpg', 1, 2500000, 2500000, '2025-06-09 19:46:44', '2025-06-09 19:46:44'),
(98, 91, 9, 'Lemari Pakaian', 'Lemari Olympic 2 Pintu', '1748921511_cf81faaf0cfaf7c3722f.jpg', 1, 1400000, 1400000, '2025-06-09 19:46:44', '2025-06-09 19:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `nama_produk` varchar(150) NOT NULL,
  `kategori` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi` varchar(800) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `slug` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `stok` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gambar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `kategori`, `deskripsi`, `slug`, `harga`, `stok`, `gambar`, `created_at`, `updated_at`) VALUES
(2, 'Sofa Jaguar Mini L Sudut', 'Sofa', 'Sofa Jaguar Mini L Sudut Tersedia 2 warna merah dan coklat', 'sofa-jaguar-mini-l-sudut', '2000000', '2', '1748920385_b2975a0c5b2067e2a2a8.jpg', '0000-00-00 00:00:00', '2025-06-05 03:22:13'),
(3, 'Buffet Pajangan Nadera', 'Buffet Pajangan', 'Buffet Pajangan Nadera', 'buffet-pajangan-nadera', '3500000', '5', '1748919780_8ae7d17c153f6ddfaeff.jpg', '0000-00-00 00:00:00', '2025-06-06 11:26:26'),
(8, 'Buffet TV Olympic', 'Buffet TV', 'Buffet TV Olympic', 'buffet-tv-olympic', '950000', '2', '1748921630_9f45ed76d74c58a666e1.jpg', '0000-00-00 00:00:00', '2025-06-03 10:33:50'),
(9, 'Lemari Olympic 2 Pintu', 'Lemari Pakaian', 'Lemari Olympic 2 Pintu', 'lemari-olympic-2-pintu', '1400000', '1', '1748921511_cf81faaf0cfaf7c3722f.jpg', '0000-00-00 00:00:00', '2025-06-09 19:46:44'),
(10, 'Buffet Pajangan Tikblok Hitam', 'Buffet Pajangan', 'Buffet Pajangan Tikblok Hitam', 'buffet-pajangan-tikblok-hitam', '1800000', '7', '1748922037_5c6ddcab7d28a9f219bf.jpg', '0000-00-00 00:00:00', '2025-06-06 11:26:31'),
(11, 'Meja Rias Hitam Merah', 'Meja Rias', 'Meja Rias warna Hitam Merah', 'meja-rias-hitam-merah', '1200000', '1', '1748922108_cfdd200b5e42a967f2d8.jpg', '0000-00-00 00:00:00', '2025-06-03 10:41:48'),
(12, 'Lemari Olympic 3 Pintu', 'Lemari Pakaian', 'Lemari Olympic 3 Pintu', 'lemari-olympic-3-pintu', '1600000', '1', '1748919872_18b3dece86714c54e5f6.jpg', '0000-00-00 00:00:00', '2025-06-08 22:40:13'),
(13, 'Ranjang Anak 2 Tingkat', 'Dipan Ranjang', 'Ranjang Anak 2 Tingkat', 'ranjang-anak-2-tingkat', '1500000', '5', '1748921751_451ebafd51fc5a90a31f.jpg', '0000-00-00 00:00:00', '2025-06-06 11:26:22'),
(14, 'Buffet TV Jati', 'Buffet TV', 'Buffet TV Jati', 'buffet-tv-jati', '2500000', '0', '1748922150_19f91b0d54a506b6867c.jpg', '0000-00-00 00:00:00', '2025-06-09 19:46:44'),
(15, 'Kasur Busa Dipan Ranjang Hitam', 'Dipan Ranjang', 'Kasur ukuran satu orang 80x200', 'kasur-busa-dipan-ranjang-hitam', '1800000', '2', '1748922257_e6d34bdaf4010f31ba8b.jpg', '0000-00-00 00:00:00', '2025-06-03 10:44:17'),
(16, 'Dipan Ranjang Kasur Busa', 'Kasur', 'Kasur busa Inoac yang empuk dan dipan ranjang yang elegan berwarna putih ukuran 180x200', 'dipan-ranjang-kasur-busa', '2000000', '1', '1748920067_c1f10b2e26c00e5e0bbf.jpg', '0000-00-00 00:00:00', '2025-06-03 10:07:47'),
(17, 'Meja Komputer', 'Kursi Kantor', 'Meja Komputer Olympic warna hitam', 'meja-komputer', '850000', '0', '1748921863_cf45872e4914b0a6803c.jpg', '0000-00-00 00:00:00', '2025-06-08 19:57:13'),
(18, 'Lemari Susun Plastik 2 Pintu', 'Lemari Pakaian', 'Lemari Susun Plastik 2 Pintu', 'lemari-susun-plastik-2-pintu', '650000', '2', '1748921942_a0d4b7de1820cb25030c.jpg', '0000-00-00 00:00:00', '2025-06-03 10:39:02'),
(19, 'Lemari Sepatu Rak Sepatu', 'Rak Sepatu', 'Lemari terbuat dari bahan olympic', 'lemari-sepatu-rak-sepatu', '850000', '1', '1748922330_0f3e547532583cca4e67.jpg', '0000-00-00 00:00:00', '2025-06-03 10:45:30'),
(21, 'Meja Makan Rotan Kokoh', 'Meja Makan', 'Meja Makan Rotan Kokoh tersedia warna coklat list kuning dan putih list merah', 'meja-makan-rotan-kokoh', '1500000', '2', '1748920201_b7ad2388d9ca17864068.jpg', '0000-00-00 00:00:00', '2025-06-03 10:10:01'),
(22, 'Kursi Teras Jati 2 Kursi', 'Kursi Teras', 'Kursi Teras Jati 2 Kursi', 'kursi-teras-jati-2-kursi', '1100000', '1', '1748740407_533b3d3d0c147a8b8cd7.jpg', '0000-00-00 00:00:00', '2025-06-01 01:13:27'),
(23, 'Sofa Abu-abu L Sudut', 'Sofa', 'Sofa Abu-abu L Sudut', 'sofa-abu-abu-l-sudut', '2200000', '1', '1748740358_dffd4b140b8516f75556.jpg', '0000-00-00 00:00:00', '2025-06-01 01:12:38'),
(25, 'Kursi Betawi 2 Pasang', 'Kursi Teras', 'Kursi Betawi 2 Pasang (4 Kursi)', 'kursi-betawi-2-pasang', '1600000', '11', '1748740189_4dbc71b85fa73ec05b06.jpg', '0000-00-00 00:00:00', '2025-06-01 01:09:49'),
(26, 'Sofa Kancing L Sudut', 'Sofa', 'Sofa Kancing L Sudut', 'sofa-kancing-l-sudut', '2200000', '1', '1748740120_ab397a3aeed71dd83ec5.jpg', '0000-00-00 00:00:00', '2025-06-01 01:08:40'),
(27, 'Lemari Jati 3 Pintu', 'Lemari Pakaian', 'Lemari jati 3 pintu', 'lemari-jati-3-pintu', '2500000', '1', '1748740032_3ff6724f596d1f20bd3f.jpg', '0000-00-00 00:00:00', '2025-06-01 01:21:29'),
(29, 'Kursi Rotan Aesthetic', 'Kursi Teras', 'Sempurnakan ruang santai atau teras rumah Anda dengan kursi rotan plastik minimalis yang elegan dan tahan lama! Desainnya yang sederhana namun modern memberikan sentuhan yang unik pada interior rumah Anda. Terbuat dari bahan plastik rotan berkualitas', 'kursi-rotan-aesthetic', '1250000', '1', 'kursi teras estetik 2.jpg', '0000-00-00 00:00:00', '2025-06-03 10:25:16'),
(30, 'Kursi Rotan Plastik', 'Kursi Teras', 'Sempurnakan ruang santai atau teras rumah Anda dengan kursi rotan plastik minimalis yang elegan dan tahan lama! Desainnya yang sederhana namun modern memberikan sentuhan yang unik pada interior rumah Anda. Terbuat dari bahan plastik rotan berkualitas, kursi ini tidak hanya terlihat indah, tetapi juga mudah dibersihkan dan tahan terhadap cuaca, air, dan jamur.\r\n\r\nCocok untuk digunakan di dalam rumah maupun di luar ruangan, kursi ini akan menjadi pilihan yang tepat untuk menciptakan suasana yang nyaman dan berkesan. Tersedia dalam beberapa ukuran, sehingga Anda dapat memilih yang sesuai dengan kebutuhan dan ukuran ruangan Anda. Jangan lewatkan kesempatan untuk memiliki kursi rotan plastik minimalis ini dengan harga yang terjangkau! ', 'kursi-rotan-plastik', '1100000', '1', 'kursi teras estetik.jpg', '0000-00-00 00:00:00', '2025-06-03 10:29:58'),
(31, 'Sofa Bed L Sudut', 'Sofa', 'Sofa Bed L Sudut warna coklat', 'sofa-bed-l-sudut', '2100000', '1', 'sofa bed L sudut.jpg', '0000-00-00 00:00:00', '2025-06-03 19:37:51'),
(32, 'Kursi Rotan Kayu Plastik', 'Kursi Teras', 'Kursi teras terbuat dari rotan yang dianyam', 'kursi-rotan-kayu-plastik', '1200000', '3', '1749080326_334c84654a77c03d06f2.jpg', '0000-00-00 00:00:00', '2025-06-05 06:40:14'),
(33, 'Kursi Rotan Kayu Plastik Jati Betawi', 'Kursi Teras', 'kursi uhuy', 'kursi-rotan-kayu-plastik-jati-betawi', '1400000', '3', '1749086538_ce80aaef4ad0151a37aa.jpg', '2025-06-05 08:22:18', '2025-06-09 19:46:44'),
(34, 'Sofa Uhuyyy', 'Sofa', 'Sofa', 'sofa-uhuyyy', '2500000', '3', '1749097992_717ba50d2f8d06e82aca.jpg', '2025-06-05 08:25:19', '2025-06-09 12:47:17'),
(36, 'Lemari Jati 3 Pintu Standard', 'Lemari Pakaian', 'lemari jati', 'lemari-jati-3-pintu-standard', '1800000', '1', '1749087641_ab207d10d7cc0b4532a2.jpg', '2025-06-05 08:39:44', '2025-06-08 22:38:37'),
(37, 'Meja makan kayu rotan', 'Meja Makan', 'meja makan', 'meja-makan-kayu-rotan', '2100000', '1', '1749096692_3a2b4f74dc6594061efd.jpg', '2025-06-05 10:11:11', '2025-06-08 22:39:03'),
(38, 'Lemari olympic ', 'Lemari Pakaian', 'lemari baju pakaian', 'lemari-olympic', '1400000', '2', 'lemari olympic 2 pintu.jpg', '2025-06-05 10:19:46', '2025-06-07 16:29:07'),
(39, 'Buffet TV Buffet Pajangan ', 'Buffet Pajangan', 'Buffet TV Buffet Pajangan ', 'buffet-tv-buffet-pajangan', '2500000', '4', 'buffet pajangan 1.jpg', '2025-06-05 10:39:59', '2025-06-09 12:47:18'),
(40, 'Kasur Plus Dipan Ranjang', 'Kasur', 'kasur', 'kasur-plus-dipan-ranjang', '1800000', '2', '1749095620_acb6d12cebffcd1c2bcf.jpg', '2025-06-05 10:53:40', '2025-06-08 22:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `produk_gambar`
--

CREATE TABLE `produk_gambar` (
  `id_gambar` int NOT NULL,
  `id_produk` int NOT NULL,
  `gambar` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk_gambar`
--

INSERT INTO `produk_gambar` (`id_gambar`, `id_produk`, `gambar`) VALUES
(1, 32, '1749080327_6cf527e2af030ebce696.jpg'),
(2, 33, '1749086538_18065fbfb075767f0ccd.jpg'),
(3, 33, '1749086538_e7ee4da94113c0a10913.jpg'),
(4, 33, '1749086539_7e8889edf72de0975d34.jpg'),
(5, 34, '1749086719_c8f0e79390bf3749ffbc.jpg'),
(7, 34, '1749086719_7e7935952cbfe33d6290.jpg'),
(8, 34, '1749086719_a66bc4b37c7b12dfa5ff.jpg'),
(11, 34, '1749090858_59625ef9824d02542c3c.jpg'),
(12, 34, '1749090858_1841c966223d3b4a93e6.jpg'),
(13, 37, '1749093071_b597ab0bfc858febf000.jpg'),
(14, 37, '1749093071_77828cb547c17146c0c7.jpg'),
(15, 38, '1749093586_647f6b5e80850617f8e8.jpg'),
(16, 38, '1749093586_0bf6471ac9e206966edc.jpg'),
(17, 39, '1749094799_449bc3c16bf007c64b7f.jpg'),
(18, 39, '1749094799_2ee7728607df721627c1.jpg'),
(19, 39, '1749094799_84deb71306edb88cee37.jpg'),
(20, 39, '1749094799_65ea75e5450693c6b475.jpg'),
(21, 39, '1749094799_c2be5f43ba215242121d.jpg'),
(22, 40, '1749095620_ca79990fbe63014c7859.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `kode_transaksi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenis_transaksi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_hp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `produk` varchar(150) DEFAULT NULL,
  `jumlah` varchar(20) DEFAULT NULL,
  `harga` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL,
  `keterangan` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode_transaksi`, `jenis_transaksi`, `nama`, `no_hp`, `alamat`, `produk`, `jumlah`, `harga`, `total`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(9, 'TRX-AR20250519104342', 'Penjualan', 'Bu Hj Suharti', '08754521542', 'Jln. Kayu Pahit', 'Lemari jati 4 pintu', '2', '2600000', '', '', 'Selesai', '2025-05-19 10:43:42', '2025-05-19 10:43:42'),
(21, 'TRX-AR20250519142625', 'Penjualan', 'Bintang', '08754623452', 'Jln. Gagak 123', 'Lemari susun plastik', '2', '450000', '', '', 'Tempo', '2025-05-19 14:26:25', '2025-05-29 09:12:24'),
(23, 'TRX-AR20250529095102', 'Penjualan', 'Gibran', '08784123542', 'Jln. Mekarsari', 'Kasur Guhdo', '2', '1250000', '2500000', '', 'Kredit', '2025-05-29 09:51:02', '2025-06-02 18:05:55'),
(24, 'TRX-AR20250529100513', 'Pembelian', 'Alrison', '', '', 'Lemari jati 2 pintu', '2', '1250000', '2500000', '', 'Selesai', '2025-05-29 10:05:13', '2025-05-29 10:05:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(250) NOT NULL,
  `gambar_user` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `level` int NOT NULL,
  `last_activity` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `reset_token` varchar(250) DEFAULT NULL,
  `reset_token_expired` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `email`, `username`, `password`, `gambar_user`, `no_hp`, `alamat`, `level`, `last_activity`, `reset_token`, `reset_token_expired`, `created_at`, `updated_at`) VALUES
(2, 'Ahmad Radik', 'radik@gmail.com', 'radik', '$2y$10$Z1HXdcojVFPp2kP4/0aeWuGiOVocv1p.dPvz7CAKK5.dOzLIU2HDW', 'profil_1749377357.png', '08972424154', 'Jln. Parung', 2, '2025-06-09 20:04:47', '285a33e1d972e25e3acbce6e69d6dae3', '2025-06-03 18:03:36', '2025-05-16 16:19:49', '2025-06-09 20:04:47'),
(3, 'Ahmad Hanafi', 'ahmad@gmail.com', 'ahmad', '$2y$10$MFmiJvXZBIJRhvxyVMWSTOPax2s9vgkezPqxF.i3zx2xk9tgJSDaq', 'brown-hair-man.png', '084454138878', NULL, 2, '2025-06-06 17:22:47', '0980f1eb46062e07735c6212ed12e1af', '2025-06-03 12:59:19', '2025-06-01 01:40:01', '2025-06-06 17:22:47'),
(4, 'Ahmad Radic', 'radicreative.id@gmail.com', 'radic', '$2y$10$5tqmUYCxdpqI3sDG0Mn2seWFUwKCxLYOQyok3/ace4oCSK3oqgRV.', 'profil_1749399921.png', '085894511225', 'Parung Bogor Jawa Barat', 2, '2025-06-09 20:01:21', '0f2ddec3b91316d9f3b23a136b01a519', '2025-06-02 01:28:44', '2025-06-02 07:50:39', '2025-06-09 20:01:21'),
(5, 'Administrator', 'admin@alrison.com', 'admin', '$2y$10$TUMIG7pk5hSr8TWC3xMjTOTy4nEC4eSpSOqKenGHPHASgw80xYjIW', 'profil_1749463947.png', '087870765283', 'Jl. Raya Parung Bogor Gg. Kp. Jati, RT./RW/RW.02/07, Parung, Kec. Parung, Kabupaten Bogor, Jawa Barat 16330', 1, '2025-06-09 19:44:33', NULL, NULL, '2025-06-02 08:35:47', '2025-06-09 19:44:33'),
(6, 'Angelina', 'angel@gmail.com', 'angel', '$2y$10$lYblfQFQ67IUCh7eosZk3uPuFRZyyW.jzxB3V.lOJWSG3ISyvi0.a', 'profil_1748990912.png', '08784452245', NULL, 2, '2025-06-07 19:30:39', NULL, NULL, '2025-06-02 13:41:14', '2025-06-07 19:30:39'),
(7, 'Arahan 872', 'arahan@gmail.com', 'arahan', '$2y$10$WQhPy3fAZnR/0xI0le6vv.EDN5fu79NnDE5QNF/bu5243pVAl6nsu', 'IMG_20240130_162201_818.jpg', '087964325804', NULL, 2, '2025-06-03 12:41:23', NULL, NULL, '2025-06-03 12:34:34', '2025-06-03 12:41:23'),
(10, 'Jackson', 'jack@gmail.com', 'jackson', '$2y$10$azJGL6S628Is5zALGgYLz.i2levvwlqO8MZcbWQ8uWDd82v.axSZK', 'default.jpeg', '0894661318', NULL, 2, '2025-06-09 18:08:12', NULL, NULL, '2025-06-03 19:00:13', '2025-06-08 22:11:19'),
(11, 'Jono', 'jono@gmail.com', 'joni', '$2y$10$yDgBf/goK3nHG1Cg6MRFF.LSOEAs/JLZ99eYKyDbMD2gj368u8XpS', '1000442530.jpg', '082312184', NULL, 2, '2025-06-03 22:22:38', NULL, NULL, '2025-06-03 19:10:09', '2025-06-03 22:22:38'),
(13, 'Ujang', 'ujang@gmail.com', 'ujang', '$2y$10$CcSzWsJfT2g33oJr8tO0HOozbAWHznvGQtfuaNnt7JM0Q9/ymu27O', 'profil_1748987046.png', '08798412132', NULL, 2, '2025-06-04 04:55:21', NULL, NULL, '2025-06-04 04:43:18', '2025-06-04 04:55:21'),
(14, 'Tina Martina', 'tina@gmail.com', 'tina', '$2y$10$pkgfvftldVMG5BQF/4Naj.zWo4Bu58KQQcMBjZ77UViG8imiCtxxW', '1748990242_97b85b9daa0c12bf4ab4.png', '08787423132', NULL, 2, '2025-06-04 05:37:57', NULL, NULL, '2025-06-04 04:55:53', '2025-06-04 05:37:57'),
(19, 'Burhan', 'burhan@gmail.com', 'burhan', '$2y$10$QAK1pJC0I9Y1zo7B3KYsp.mSlL27Txjm9O0PZeQZQgWujmc2oPCRW', 'default.jpeg', '087984321245', NULL, 2, '2025-06-08 23:16:40', NULL, NULL, '2025-06-04 05:52:48', '2025-06-08 23:16:40'),
(20, 'Anissa', 'nisa@gmail.com', 'nisa', '$2y$10$T3CqpGTpbBWP2Bc/k9O2V.sc90x0.vH2wRNTbSCcyNIs5qEozDbUO', 'default.jpeg', '08794321154', NULL, 2, '2025-06-05 00:45:43', NULL, NULL, '2025-06-04 06:39:57', '2025-06-05 00:45:43'),
(21, 'Anak cantik', 'lizahardiana.lh@gmail.com', 'Sicantik', '$2y$10$xstvDX9eUIhg/inUzPnp8.J5vrfk3LY9BFh/Mx3JndsNcx0xEja0y', 'default.jpeg', '089657951760', NULL, 2, '2025-06-05 17:44:14', NULL, NULL, '2025-06-05 17:43:28', '2025-06-05 17:44:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_konsumen`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produk_gambar`
--
ALTER TABLE `produk_gambar`
  ADD PRIMARY KEY (`id_gambar`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `id_konsumen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `produk_gambar`
--
ALTER TABLE `produk_gambar`
  MODIFY `id_gambar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
