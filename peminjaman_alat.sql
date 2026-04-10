-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 10, 2026 at 07:51 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman_alat`
--

-- --------------------------------------------------------

--
-- Table structure for table `alats`
--

CREATE TABLE `alats` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_alat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `jumlah_tersedia` int NOT NULL DEFAULT '0',
  `kondisi` enum('baik','rusak','hilang') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'baik',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alats`
--

INSERT INTO `alats` (`id`, `nama_alat`, `deskripsi`, `kategori_id`, `jumlah_tersedia`, `kondisi`, `created_at`, `updated_at`) VALUES
(1, 'Bor Listrik Makita', 'Bor listrik profesional dari Makita dengan tenaga 13mm', 2, 3, 'baik', '2026-04-09 23:47:55', '2026-04-10 00:45:26'),
(2, 'Mesin Gerinda Bosch', 'Mesin gerinda sudut profesional Bosch GWS', 2, 6, 'baik', '2026-04-09 23:47:55', '2026-04-10 00:42:51'),
(5, 'Kamera Canon EOS 200D', 'Kamera DSLR entry-level dengan lensa kit', 3, 2, 'baik', '2026-04-09 23:47:55', '2026-04-09 23:47:55'),
(6, 'Tang Potong Stanley', 'Tang potong 8 inch standar', 4, 8, 'baik', '2026-04-09 23:47:55', '2026-04-09 23:47:55'),
(8, 'Tripod Kamera 1/4', 'Tripod standar untuk kamera atau proyektor', 3, 3, 'baik', '2026-04-09 23:47:55', '2026-04-09 23:47:55'),
(9, 'Kasur empuk', 'Tempat empuk untuk istirahat', 6, 11, 'baik', '2026-04-10 00:08:04', '2026-04-10 00:40:12'),
(10, 'Sendok', 'Sendok emas dari batu giok', 7, 28, 'baik', '2026-04-10 00:39:55', '2026-04-10 00:45:36');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `deskripsi`, `created_at`, `updated_at`) VALUES
(2, 'Peralatan Listrik', 'Peralatan listrik dan power tools', '2026-04-09 23:47:55', '2026-04-09 23:47:55'),
(3, 'Fotografi', 'Peralatan fotografi dan video', '2026-04-09 23:47:55', '2026-04-09 23:47:55'),
(4, 'Perkakas', 'Peralatan tangan dan perkakas umum ini', '2026-04-09 23:47:55', '2026-04-10 00:38:46'),
(5, 'Komputer', 'Perangkat komputer dan aksesoris', '2026-04-09 23:47:55', '2026-04-09 23:47:55'),
(6, 'Alat rumah tangga', 'Peralatan rumah tangga', '2026-04-10 00:07:11', '2026-04-10 00:07:11'),
(7, 'Alat Makan', 'Alat untuk makan MBG', '2026-04-10 00:38:30', '2026-04-10 00:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `aktivitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `waktu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id`, `user_id`, `aktivitas`, `deskripsi`, `waktu`, `created_at`, `updated_at`) VALUES
(1, 2, 'Login', 'User melakukan login', '06:48:21', '2026-04-09 23:48:21', '2026-04-09 23:48:21'),
(2, 2, 'Logout', 'User melakukan logout', '06:48:37', '2026-04-09 23:48:37', '2026-04-09 23:48:37'),
(3, 8, 'Login', 'User melakukan login', '06:49:33', '2026-04-09 23:49:33', '2026-04-09 23:49:33'),
(4, 8, 'Ajukan Peminjaman', 'Mengajukan peminjaman 1 unit Bor Listrik Makita', '06:49:42', '2026-04-09 23:49:42', '2026-04-09 23:49:42'),
(5, 8, 'Logout', 'User melakukan logout', '06:49:46', '2026-04-09 23:49:46', '2026-04-09 23:49:46'),
(6, 2, 'Login', 'User melakukan login', '06:49:54', '2026-04-09 23:49:54', '2026-04-09 23:49:54'),
(7, 2, 'Setujui Peminjaman', 'Menyetujui peminjaman alat Bor Listrik Makita oleh Myrtis Padberg', '06:50:05', '2026-04-09 23:50:05', '2026-04-09 23:50:05'),
(8, 2, 'Tolak Peminjaman', 'Menolak peminjaman alat Mesin Gerinda Bosch oleh Kyra Kohler', '06:50:23', '2026-04-09 23:50:23', '2026-04-09 23:50:23'),
(9, 2, 'Logout', 'User melakukan logout', '06:50:31', '2026-04-09 23:50:31', '2026-04-09 23:50:31'),
(10, 8, 'Login', 'User melakukan login', '06:50:38', '2026-04-09 23:50:38', '2026-04-09 23:50:38'),
(11, 8, 'Ajukan Peminjaman', 'Mengajukan peminjaman 2 unit Laptop Lenovo ThinkPad', '06:51:14', '2026-04-09 23:51:14', '2026-04-09 23:51:14'),
(12, 8, 'Logout', 'User melakukan logout', '06:51:31', '2026-04-09 23:51:31', '2026-04-09 23:51:31'),
(13, 2, 'Login', 'User melakukan login', '06:51:47', '2026-04-09 23:51:47', '2026-04-09 23:51:47'),
(14, 2, 'Setujui Peminjaman', 'Menyetujui peminjaman alat Laptop Lenovo ThinkPad oleh Myrtis Padberg', '06:51:56', '2026-04-09 23:51:56', '2026-04-09 23:51:56'),
(15, 2, 'Logout', 'User melakukan logout', '06:52:00', '2026-04-09 23:52:00', '2026-04-09 23:52:00'),
(16, 2, 'Login', 'User melakukan login', '06:52:17', '2026-04-09 23:52:17', '2026-04-09 23:52:17'),
(17, 2, 'Logout', 'User melakukan logout', '06:52:30', '2026-04-09 23:52:30', '2026-04-09 23:52:30'),
(18, 8, 'Login', 'User melakukan login', '06:52:36', '2026-04-09 23:52:36', '2026-04-09 23:52:36'),
(19, 8, 'Kembalikan Peminjaman', 'Mengembalikan Laptop Lenovo ThinkPad dalam kondisi rusak | Denda: Rp 200.000 | [ALERT] Alat rusak - perlu diperiksa oleh petugas', '06:57:59', '2026-04-09 23:57:59', '2026-04-09 23:57:59'),
(20, 8, '⚠ ALERT: Alat Rusak', 'Peminjam: Myrtis Padberg | Alat: Laptop Lenovo ThinkPad | Denda: Rp 200.000', '06:57:59', '2026-04-09 23:57:59', '2026-04-09 23:57:59'),
(21, 8, 'Logout', 'User melakukan logout', '06:58:03', '2026-04-09 23:58:03', '2026-04-09 23:58:03'),
(22, 2, 'Login', 'User melakukan login', '06:58:12', '2026-04-09 23:58:12', '2026-04-09 23:58:12'),
(23, 2, 'Logout', 'User melakukan logout', '07:03:28', '2026-04-10 00:03:28', '2026-04-10 00:03:28'),
(24, 1, 'Login', 'User melakukan login', '07:04:10', '2026-04-10 00:04:10', '2026-04-10 00:04:10'),
(25, 2, 'Login', 'User melakukan login', '07:04:36', '2026-04-10 00:04:36', '2026-04-10 00:04:36'),
(26, 1, 'Tambah User', 'Menambahkan user: awa', '07:06:35', '2026-04-10 00:06:35', '2026-04-10 00:06:35'),
(27, 1, 'Tambah Kategori', 'Menambahkan kategori: Alat rumah tangga', '07:07:11', '2026-04-10 00:07:11', '2026-04-10 00:07:11'),
(28, 1, 'Tambah Alat', 'Menambahkan alat: Kasur', '07:08:04', '2026-04-10 00:08:04', '2026-04-10 00:08:04'),
(29, 1, 'Hapus Alat', 'Menghapus alat: Laptop Lenovo ThinkPad', '07:08:08', '2026-04-10 00:08:08', '2026-04-10 00:08:08'),
(30, 1, 'Edit Alat', 'Mengedit alat: Kasurr', '07:08:15', '2026-04-10 00:08:15', '2026-04-10 00:08:15'),
(31, 1, 'Edit Alat', 'Mengedit alat: Kasur', '07:08:21', '2026-04-10 00:08:21', '2026-04-10 00:08:21'),
(32, 9, 'Login', 'User melakukan login', '07:09:27', '2026-04-10 00:09:27', '2026-04-10 00:09:27'),
(33, 9, 'Ajukan Peminjaman', 'Mengajukan peminjaman 1 unit Kasur', '07:10:28', '2026-04-10 00:10:28', '2026-04-10 00:10:28'),
(34, 2, 'Setujui Peminjaman', 'Menyetujui peminjaman alat Kasur oleh Nazwha Amelia', '07:10:37', '2026-04-10 00:10:37', '2026-04-10 00:10:37'),
(35, 9, 'Kembalikan Peminjaman', 'Mengembalikan Kasur dalam kondisi baik', '07:10:48', '2026-04-10 00:10:48', '2026-04-10 00:10:48'),
(36, 9, 'Ajukan Peminjaman', 'Mengajukan peminjaman 3 unit Bor Listrik Makita', '07:23:53', '2026-04-10 00:23:53', '2026-04-10 00:23:53'),
(37, 2, 'Tolak Peminjaman', 'Menolak peminjaman alat Bor Listrik Makita oleh Nazwha Amelia', '07:24:21', '2026-04-10 00:24:21', '2026-04-10 00:24:21'),
(38, 9, 'Ajukan Peminjaman', 'Mengajukan peminjaman 3 unit Mesin Gerinda Bosch', '07:24:40', '2026-04-10 00:24:40', '2026-04-10 00:24:40'),
(39, 2, 'Setujui Peminjaman', 'Menyetujui peminjaman alat Mesin Gerinda Bosch oleh Nazwha Amelia', '07:24:47', '2026-04-10 00:24:47', '2026-04-10 00:24:47'),
(40, 1, 'Logout', 'User melakukan logout', '07:35:20', '2026-04-10 00:35:20', '2026-04-10 00:35:20'),
(41, 2, 'Logout', 'User melakukan logout', '07:35:27', '2026-04-10 00:35:27', '2026-04-10 00:35:27'),
(42, 9, 'Logout', 'User melakukan logout', '07:35:32', '2026-04-10 00:35:32', '2026-04-10 00:35:32'),
(43, 9, 'Login', 'User melakukan login', '07:35:43', '2026-04-10 00:35:43', '2026-04-10 00:35:43'),
(44, 2, 'Login', 'User melakukan login', '07:35:58', '2026-04-10 00:35:58', '2026-04-10 00:35:58'),
(45, 1, 'Login', 'User melakukan login', '07:36:07', '2026-04-10 00:36:07', '2026-04-10 00:36:07'),
(46, 1, 'Tambah User', 'Menambahkan user: admin2', '07:37:09', '2026-04-10 00:37:09', '2026-04-10 00:37:09'),
(47, 1, 'Edit User', 'Mengedit user: waltenwerth', '07:37:54', '2026-04-10 00:37:54', '2026-04-10 00:37:54'),
(48, 1, 'Hapus User', 'Menghapus user: rachael.ward', '07:38:01', '2026-04-10 00:38:01', '2026-04-10 00:38:01'),
(49, 1, 'Tambah Kategori', 'Menambahkan kategori: Alat Makan', '07:38:30', '2026-04-10 00:38:30', '2026-04-10 00:38:30'),
(50, 1, 'Edit Kategori', 'Mengedit kategori: Perkakas', '07:38:46', '2026-04-10 00:38:46', '2026-04-10 00:38:46'),
(51, 1, 'Hapus Kategori', 'Menghapus kategori: Elektronik', '07:39:06', '2026-04-10 00:39:06', '2026-04-10 00:39:06'),
(52, 1, 'Tambah Alat', 'Menambahkan alat: Sendok', '07:39:55', '2026-04-10 00:39:55', '2026-04-10 00:39:55'),
(53, 1, 'Edit Alat', 'Mengedit alat: Kasur empuk', '07:40:12', '2026-04-10 00:40:12', '2026-04-10 00:40:12'),
(54, 1, 'Hapus Alat', 'Menghapus alat: Meteran Gulung 5m', '07:40:20', '2026-04-10 00:40:20', '2026-04-10 00:40:20'),
(55, 9, 'Ajukan Peminjaman', 'Mengajukan peminjaman 5 unit Sendok', '07:42:25', '2026-04-10 00:42:25', '2026-04-10 00:42:25'),
(56, 2, 'Setujui Peminjaman', 'Menyetujui peminjaman alat Sendok oleh Nazwha Amelia', '07:42:35', '2026-04-10 00:42:35', '2026-04-10 00:42:35'),
(57, 9, 'Kembalikan Peminjaman', 'Mengembalikan Mesin Gerinda Bosch dalam kondisi baik', '07:42:51', '2026-04-10 00:42:51', '2026-04-10 00:42:51'),
(58, 9, 'Kembalikan Peminjaman', 'Mengembalikan Sendok dalam kondisi baik', '07:43:07', '2026-04-10 00:43:07', '2026-04-10 00:43:07'),
(59, 9, 'Ajukan Peminjaman', 'Mengajukan peminjaman 8 unit Sendok', '07:44:19', '2026-04-10 00:44:19', '2026-04-10 00:44:19'),
(60, 9, 'Ajukan Peminjaman', 'Mengajukan peminjaman 2 unit Bor Listrik Makita', '07:44:55', '2026-04-10 00:44:55', '2026-04-10 00:44:55'),
(61, 2, 'Setujui Peminjaman', 'Menyetujui peminjaman alat Sendok oleh Nazwha Amelia', '07:45:05', '2026-04-10 00:45:05', '2026-04-10 00:45:05'),
(62, 2, 'Setujui Peminjaman', 'Menyetujui peminjaman alat Bor Listrik Makita oleh Nazwha Amelia', '07:45:09', '2026-04-10 00:45:09', '2026-04-10 00:45:09'),
(63, 9, 'Kembalikan Peminjaman', 'Mengembalikan Bor Listrik Makita dalam kondisi hilang | Denda: Rp 1.000.000 | [ALERT PENTING] Alat HILANG - perlu penyelidikan segera', '07:45:26', '2026-04-10 00:45:26', '2026-04-10 00:45:26'),
(64, 9, '✕ ALERT PENTING: Alat Hilang', 'Peminjam: Nazwha Amelia | Alat: Bor Listrik Makita | Denda: Rp 1.000.000', '07:45:26', '2026-04-10 00:45:26', '2026-04-10 00:45:26'),
(65, 9, 'Kembalikan Peminjaman', 'Mengembalikan Sendok dalam kondisi baik', '07:45:36', '2026-04-10 00:45:36', '2026-04-10 00:45:36');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_09_073441_create_kategoris_table', 1),
(5, '2026_04_09_073451_create_alats_table', 1),
(6, '2026_04_09_073451_create_peminjamans_table', 1),
(7, '2026_04_09_073452_create_log_aktivitass_table', 1),
(8, '2026_04_09_073452_create_pengembalians_table', 1),
(9, '2026_04_09_074000_add_pengembalian_id_to_peminjamans_table', 1),
(10, '2026_04_10_043727_add_penolakan_fields_to_peminjamans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjamans`
--

CREATE TABLE `peminjamans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `alat_id` bigint UNSIGNED NOT NULL,
  `jumlah_pinjam` int NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali_rencana` date NOT NULL,
  `status` enum('pending','disetujui','ditolak','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `alasan_ditolak` text COLLATE utf8mb4_unicode_ci,
  `notif_dilihat` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pengembalian_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjamans`
--

INSERT INTO `peminjamans` (`id`, `user_id`, `alat_id`, `jumlah_pinjam`, `tanggal_pinjam`, `tanggal_kembali_rencana`, `status`, `alasan_ditolak`, `notif_dilihat`, `created_at`, `updated_at`, `pengembalian_id`) VALUES
(1, 4, 1, 2, '2026-04-05', '2026-04-12', 'disetujui', NULL, 0, '2026-04-09 23:47:55', '2026-04-09 23:47:55', NULL),
(2, 4, 2, 1, '2026-04-10', '2026-04-15', 'ditolak', 'alat ada kerusakan', 0, '2026-04-09 23:47:55', '2026-04-09 23:50:23', NULL),
(4, 8, 1, 1, '2026-04-10', '2026-04-11', 'disetujui', NULL, 0, '2026-04-09 23:49:42', '2026-04-09 23:50:05', NULL),
(6, 9, 9, 1, '2026-04-10', '2026-04-11', 'selesai', NULL, 0, '2026-04-10 00:10:28', '2026-04-10 00:10:48', 3),
(7, 9, 1, 3, '2026-04-10', '2026-04-11', 'ditolak', 'Bor listrik sedang rusak', 1, '2026-04-10 00:23:53', '2026-04-10 00:24:26', NULL),
(8, 9, 2, 3, '2026-04-10', '2026-04-11', 'selesai', NULL, 0, '2026-04-10 00:24:40', '2026-04-10 00:42:51', 4),
(9, 9, 10, 5, '2026-04-10', '2026-04-11', 'selesai', NULL, 0, '2026-04-10 00:42:25', '2026-04-10 00:43:07', 5),
(10, 9, 10, 8, '2026-04-10', '2026-04-11', 'selesai', NULL, 0, '2026-04-10 00:44:19', '2026-04-10 00:45:36', 7),
(11, 9, 1, 2, '2026-04-10', '2026-04-11', 'selesai', NULL, 0, '2026-04-10 00:44:55', '2026-04-10 00:45:26', 6);

-- --------------------------------------------------------

--
-- Table structure for table `pengembalians`
--

CREATE TABLE `pengembalians` (
  `id` bigint UNSIGNED NOT NULL,
  `peminjaman_id` bigint UNSIGNED NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `kondisi_alat` enum('baik','rusak','hilang') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'baik',
  `denda` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengembalians`
--

INSERT INTO `pengembalians` (`id`, `peminjaman_id`, `tanggal_kembali`, `kondisi_alat`, `denda`, `created_at`, `updated_at`) VALUES
(3, 6, '2026-04-10', 'baik', 0.00, '2026-04-10 00:10:48', '2026-04-10 00:10:48'),
(4, 8, '2026-04-10', 'baik', 0.00, '2026-04-10 00:42:51', '2026-04-10 00:42:51'),
(5, 9, '2026-04-10', 'baik', 0.00, '2026-04-10 00:43:07', '2026-04-10 00:43:07'),
(6, 11, '2026-04-10', 'hilang', 1000000.00, '2026-04-10 00:45:26', '2026-04-10 00:45:26'),
(7, 10, '2026-04-10', 'baik', 0.00, '2026-04-10 00:45:36', '2026-04-10 00:45:36');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('rxQ7mZwOj0nRFE1WUrehoP2i88umYrWuWVvx7RG2', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiczJSWVByMzBDbUhvR0JWSGpDOVVlYVJDamJvMXUweVVOVlZPTXh4WiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2ctYWt0aXZpdGFzIjtzOjU6InJvdXRlIjtzOjI1OiJhZG1pbi5sb2ctYWt0aXZpdGFzLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1775806858),
('VBugIxmmQVzHru3w85SZPNwoU8VlpAEohG1CYUXy', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib1Rvd0sxaHVTV3ZOUFFwMU9MVUc4QlRNRmt2NDNVNmVsQm9sUWVWQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW1pbmphbS9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTg6InBlbWluamFtLmRhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk7fQ==', 1775807136),
('ypBltv5UbocFxf31PZ3kWmIgqrn6B49oRMDASkQI', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSTlDQlFLZnlxUHlmdm9CTklVNjBOTWlNOW04OHpySjJVNnFMOGI5QSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXR1Z2FzL2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czoxNzoicGV0dWdhcy5kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1775807161);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','petugas','peminjam') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'peminjam',
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `phone_number`, `email_verified_at`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', 'admin@example.com', '1-680-883-5162', '2026-04-09 23:47:55', '$2y$12$58PurTunBH4X1sQGM6zdt.A8fubYMiAHWSWtNcVIyoc2gKfPWRZAq', 'admin', 'aktif', 'AcW7A58dbwZGDssrVEPvCibRbqHKBpLDle8ElRkPT30NTtzwBgdfJXHppDf0', '2026-04-09 23:47:55', '2026-04-09 23:47:55'),
(2, 'petugas1', 'Petugas Satu', 'petugas1@example.com', '1-520-652-1584', '2026-04-09 23:47:55', '$2y$12$58PurTunBH4X1sQGM6zdt.A8fubYMiAHWSWtNcVIyoc2gKfPWRZAq', 'petugas', 'aktif', 'kwaOEE79zzBiLX6CBICvVnFyoryt5XaugaLcPdilonp0RkpDnAq1IktdbhDB', '2026-04-09 23:47:55', '2026-04-09 23:47:55'),
(3, 'petugas2', 'Petugas Dua', 'petugas2@example.com', '+1.971.383.4765', '2026-04-09 23:47:55', '$2y$12$58PurTunBH4X1sQGM6zdt.A8fubYMiAHWSWtNcVIyoc2gKfPWRZAq', 'petugas', 'aktif', 'Kpgbj8gzlJ', '2026-04-09 23:47:55', '2026-04-09 23:47:55'),
(4, 'phudson', 'Kyra Kohler', 'gbecker@example.com', '754-895-1277', '2026-04-09 23:47:55', '$2y$12$58PurTunBH4X1sQGM6zdt.A8fubYMiAHWSWtNcVIyoc2gKfPWRZAq', 'peminjam', 'aktif', 'CHBnPhuknA', '2026-04-09 23:47:55', '2026-04-09 23:47:55'),
(5, 'theodora.gottlieb', 'Kaycee McGlynn', 'ferne.berge@example.com', '1-865-376-5217', '2026-04-09 23:47:55', '$2y$12$58PurTunBH4X1sQGM6zdt.A8fubYMiAHWSWtNcVIyoc2gKfPWRZAq', 'peminjam', 'aktif', 'rYwcL1nGjb', '2026-04-09 23:47:55', '2026-04-09 23:47:55'),
(6, 'owen.greenfelder', 'Mayra Pouros', 'teagan.cummerata@example.org', '1-323-437-9303', '2026-04-09 23:47:55', '$2y$12$58PurTunBH4X1sQGM6zdt.A8fubYMiAHWSWtNcVIyoc2gKfPWRZAq', 'peminjam', 'aktif', 'ambaA4Iig3', '2026-04-09 23:47:55', '2026-04-09 23:47:55'),
(8, 'waltenwerth', 'Myrtis Padbergo', 'qmurphy@gmail.com', '941.535.7115', '2026-04-09 23:47:55', '$2y$12$58PurTunBH4X1sQGM6zdt.A8fubYMiAHWSWtNcVIyoc2gKfPWRZAq', 'peminjam', 'aktif', 'Kz4Wz868dsYzUFkgPtF3wqENWaLGjickZ6QNiHrUiXvNstzkvBb5mFfUg9Qw', '2026-04-09 23:47:55', '2026-04-10 00:37:54'),
(9, 'awa', 'Nazwha Amelia', 'nazwhaawa1864@gmail.com', '085718843710', NULL, '$2y$12$cAxNZcpYHvfCaSUF1VQkYe/WywzV7z7QoC0nDmfEjmt7aIHMDPz4u', 'peminjam', 'aktif', NULL, '2026-04-10 00:06:35', '2026-04-10 00:06:35'),
(10, 'admin2', 'Asteria Megan', 'aster@gmail.com', '00000000', NULL, '$2y$12$muS/hp/rNl8.utoitYnX3u.GBPoqNsQUgDa/0pZGQITLdXVbvXHa6', 'admin', 'aktif', NULL, '2026-04-10 00:37:09', '2026-04-10 00:37:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alats`
--
ALTER TABLE `alats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alats_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategoris_nama_kategori_unique` (`nama_kategori`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_aktivitas_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjamans_user_id_foreign` (`user_id`),
  ADD KEY `peminjamans_alat_id_foreign` (`alat_id`),
  ADD KEY `peminjamans_pengembalian_id_foreign` (`pengembalian_id`);

--
-- Indexes for table `pengembalians`
--
ALTER TABLE `pengembalians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengembalians_peminjaman_id_foreign` (`peminjaman_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alats`
--
ALTER TABLE `alats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pengembalians`
--
ALTER TABLE `pengembalians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alats`
--
ALTER TABLE `alats`
  ADD CONSTRAINT `alats_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD CONSTRAINT `peminjamans_alat_id_foreign` FOREIGN KEY (`alat_id`) REFERENCES `alats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjamans_pengembalian_id_foreign` FOREIGN KEY (`pengembalian_id`) REFERENCES `pengembalians` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `peminjamans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengembalians`
--
ALTER TABLE `pengembalians`
  ADD CONSTRAINT `pengembalians_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjamans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
