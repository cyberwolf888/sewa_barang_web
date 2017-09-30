-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 30 Sep 2017 pada 05.29
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_sewa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Elektronik', '2017-09-25 18:38:40', '2017-09-25 18:39:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar_iklan`
--

CREATE TABLE `gambar_iklan` (
  `id` int(11) NOT NULL,
  `iklan_id` int(11) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gambar_iklan`
--

INSERT INTO `gambar_iklan` (`id`, `iklan_id`, `img`, `created_at`, `updated_at`) VALUES
(1, 1, '241456319a74e72b8c49326d4fd4d7c5.jpg', '2017-09-27 21:26:52', '2017-09-27 21:26:52'),
(2, 1, '997cc423b5d1b807f6cd3dd59945eb52.jpg', '2017-09-27 21:26:53', '2017-09-27 21:26:53'),
(3, 1, '86004764e64565610699e40252779756.jpg', '2017-09-27 21:26:53', '2017-09-27 21:26:53'),
(4, 2, '8984d1acaf7fa66dd8f588eac404a977.jpg', '2017-09-28 21:36:50', '2017-09-28 21:36:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `iklan`
--

CREATE TABLE `iklan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` float NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `iklan`
--

INSERT INTO `iklan` (`id`, `user_id`, `category_id`, `judul`, `deskripsi`, `harga`, `satuan`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Kamera keren', 'kamera paling ampuh', 150000, 'Hari', 2, '2017-09-27 21:25:54', '2017-09-28 20:58:11'),
(2, 3, 1, 'Laptop keren', 'Laptop paling kencang yang pernah ada', 500000, 'Hari', 2, '2017-09-28 21:36:36', '2017-09-28 21:36:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isActive` int(1) DEFAULT NULL,
  `type` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `address`, `img`, `email`, `password`, `remember_token`, `isActive`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '085737353569', 'Jalan Nangka utara', '9c3afc643d0a8c3e3031ea0045677dc8.jpg', 'admin@mail.com', '$2y$10$Iz8NCck3FBi/5yWfBEOSyu5E6wQ8Nol0fGz1pv3wR4RB4FSDmNGo2', 'yUkAE6NE8CthDexngDaSIGEv5Q9HXdxRakcdRJY97GfTSzDwxICJ4Sl9pjxS', 1, 1, '2017-09-25 01:02:51', '2017-09-25 20:43:57'),
(2, 'test', '82247464196', 'Jalan Wisnu Marga Belayu No 19', '', 'test@mail.com', '$2y$10$LcY37tduqESuda0MOZawKOUOvKMAAN4d1L0jaI1x3RJ8Dn6hyQgYi', NULL, 0, 1, '2017-09-25 20:23:33', '2017-09-25 20:33:03'),
(3, 'Coba Member', '85737353569', 'Jalan raya niti mandala renon', '2a3d8d086d177c17389c5a8bbf74cec9.jpg', 'member@mail.com', '$2y$10$O3PusdAqP0qvMXqHQKoSeO/boWfM406Wg1/8xbYMaeCEiisaiqpti', NULL, 1, 2, '2017-09-25 20:37:25', '2017-09-26 23:56:30'),
(4, 'testhsh', '085734694', 'Jalan Asd', '', 'testasd@mail.com', '$2y$10$O3PusdAqP0qvMXqHQKoSeO/boWfM406Wg1/8xbYMaeCEiisaiqpti', NULL, 1, 2, '2017-09-26 05:57:59', '2017-09-26 05:57:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gambar_iklan`
--
ALTER TABLE `gambar_iklan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iklan`
--
ALTER TABLE `iklan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gambar_iklan`
--
ALTER TABLE `gambar_iklan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `iklan`
--
ALTER TABLE `iklan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
