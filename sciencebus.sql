-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2026 at 10:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sciencebus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` varchar(32) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(190) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','super_admin') NOT NULL DEFAULT 'admin',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
('c827040ffb12e20d', 'Admin', 'admin@sciencebus.local', '$2y$10$V2Rh3q5sCQBJX5XiSBUsTu86B8y7NdRppxCCH4C8G2Pn5DjI1AO0q', 'admin', '2026-05-16 06:54:50'),
('dda692418f704e04', 'Super Admin', 'superadmin@sciencebus.local', '$2y$10$V2Rh3q5sCQBJX5XiSBUsTu86B8y7NdRppxCCH4C8G2Pn5DjI1AO0q', 'super_admin', '2026-05-16 06:54:49');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` varchar(32) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(190) NOT NULL,
  `school` varchar(190) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_categories`
--

CREATE TABLE `gallery_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(190) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_categories`
--

INSERT INTO `gallery_categories` (`id`, `name`, `sort_order`, `created_at`) VALUES
(6, 'Farrukhabad', 0, '2026-06-11 14:49:47'),
(7, 'Kasganj', 1, '2026-06-11 14:49:47'),
(8, 'Lakhimpur', 2, '2026-06-11 14:49:47'),
(9, 'Lucknow', 3, '2026-06-11 14:49:48');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `package_id`, `image`, `sort_order`, `created_at`) VALUES
(22, 8, 'assets/uploads/tours/farrukhabad/a-gyanfort-innovative-school-sadar-farrukhabad/001-1527626412.jpg', 0, '2026-06-11 14:49:47'),
(23, 8, 'assets/uploads/tours/farrukhabad/a-gyanfort-innovative-school-sadar-farrukhabad/002-e6f07f5f29.jpg', 1, '2026-06-11 14:49:47'),
(24, 8, 'assets/uploads/tours/farrukhabad/a-gyanfort-innovative-school-sadar-farrukhabad/003-fa3e16dc07.jpg', 2, '2026-06-11 14:49:47'),
(25, 8, 'assets/uploads/tours/farrukhabad/a-gyanfort-innovative-school-sadar-farrukhabad/004-03c5cdcff3.jpeg', 3, '2026-06-11 14:49:47'),
(26, 8, 'assets/uploads/tours/farrukhabad/a-gyanfort-innovative-school-sadar-farrukhabad/005-2bc27a9ffc.jpeg', 4, '2026-06-11 14:49:47'),
(27, 9, 'assets/uploads/tours/farrukhabad/army-public-school-ram-tirth-dubey-memorial-school-fatehgarh-farrukhabad/001-9917e63430.jpg', 0, '2026-06-11 14:49:47'),
(28, 9, 'assets/uploads/tours/farrukhabad/army-public-school-ram-tirth-dubey-memorial-school-fatehgarh-farrukhabad/002-b5d2d43cdc.jpg', 1, '2026-06-11 14:49:47'),
(29, 10, 'assets/uploads/tours/farrukhabad/c-p-international-farrukhabad/001-60e0c3c395.jpg', 0, '2026-06-11 14:49:47'),
(30, 10, 'assets/uploads/tours/farrukhabad/c-p-international-farrukhabad/002-7505a94830.jpg', 1, '2026-06-11 14:49:47'),
(31, 10, 'assets/uploads/tours/farrukhabad/c-p-international-farrukhabad/003-b93a95fd01.jpg', 2, '2026-06-11 14:49:47'),
(32, 11, 'assets/uploads/tours/farrukhabad/c-p-v-n-kaimganj-farrukhabad/001-bc7aed748e.jpg', 0, '2026-06-11 14:49:47'),
(33, 11, 'assets/uploads/tours/farrukhabad/c-p-v-n-kaimganj-farrukhabad/002-3c6ee121f4.jpg', 1, '2026-06-11 14:49:47'),
(34, 11, 'assets/uploads/tours/farrukhabad/c-p-v-n-kaimganj-farrukhabad/003-6749b93173.jpg', 2, '2026-06-11 14:49:47'),
(35, 11, 'assets/uploads/tours/farrukhabad/c-p-v-n-kaimganj-farrukhabad/004-6a6ae77472.jpg', 3, '2026-06-11 14:49:47'),
(36, 12, 'assets/uploads/tours/farrukhabad/dr-b-p-agrawal-shiksha-niketan-farrukhabad/001-49c7e57491.jpg', 0, '2026-06-11 14:49:47'),
(37, 12, 'assets/uploads/tours/farrukhabad/dr-b-p-agrawal-shiksha-niketan-farrukhabad/002-0dae89af37.jpg', 1, '2026-06-11 14:49:47'),
(38, 12, 'assets/uploads/tours/farrukhabad/dr-b-p-agrawal-shiksha-niketan-farrukhabad/003-17c6063a08.jpg', 2, '2026-06-11 14:49:47'),
(39, 13, 'assets/uploads/tours/farrukhabad/g-i-c-g-g-i-c-fatehgarh-farrukhabad/001-4cb7855bf5.jpg', 0, '2026-06-11 14:49:47'),
(40, 13, 'assets/uploads/tours/farrukhabad/g-i-c-g-g-i-c-fatehgarh-farrukhabad/002-2dfb954080.jpg', 1, '2026-06-11 14:49:47'),
(41, 14, 'assets/uploads/tours/farrukhabad/rajputana-public-school-farrukhabad/001-77d3c56f28.jpg', 0, '2026-06-11 14:49:47'),
(42, 14, 'assets/uploads/tours/farrukhabad/rajputana-public-school-farrukhabad/002-2987d2c80a.jpeg', 1, '2026-06-11 14:49:47'),
(43, 15, 'assets/uploads/tours/farrukhabad/svrm-public-school-nawabganj-farrukhabad/001-f0926d12b4.jpg', 0, '2026-06-11 14:49:47'),
(44, 16, 'assets/uploads/tours/kasganj/a/001-6b770a1c24.jpeg', 0, '2026-06-11 14:49:47'),
(45, 16, 'assets/uploads/tours/kasganj/a/002-c02d2efd6e.jpeg', 1, '2026-06-11 14:49:47'),
(46, 16, 'assets/uploads/tours/kasganj/a/003-0311305c2d.jpeg', 2, '2026-06-11 14:49:47'),
(47, 16, 'assets/uploads/tours/kasganj/a/004-a42a44352f.jpeg', 3, '2026-06-11 14:49:47'),
(48, 16, 'assets/uploads/tours/kasganj/a/005-d946972155.jpeg', 4, '2026-06-11 14:49:47'),
(49, 17, 'assets/uploads/tours/kasganj/item/001-b4e1252a4e.jpg', 0, '2026-06-11 14:49:47'),
(50, 18, 'assets/uploads/tours/kasganj/item/001-089a13d4d3.jpeg', 0, '2026-06-11 14:49:47'),
(51, 18, 'assets/uploads/tours/kasganj/item/002-534e961889.jpeg', 1, '2026-06-11 14:49:47'),
(52, 18, 'assets/uploads/tours/kasganj/item/003-cba12fefe5.jpeg', 2, '2026-06-11 14:49:47'),
(53, 19, 'assets/uploads/tours/kasganj/item/001-a8badb9c83.jpeg', 0, '2026-06-11 14:49:47'),
(54, 20, 'assets/uploads/tours/kasganj/item/001-b9f5f4f23e.jpg', 0, '2026-06-11 14:49:47'),
(55, 21, 'assets/uploads/tours/kasganj/item/001-477364b9b8.jpg', 0, '2026-06-11 14:49:47'),
(56, 21, 'assets/uploads/tours/kasganj/item/002-d392838123.jpg', 1, '2026-06-11 14:49:47'),
(57, 22, 'assets/uploads/tours/kasganj/item/001-dbfa1f1b63.jpg', 0, '2026-06-11 14:49:47'),
(58, 22, 'assets/uploads/tours/kasganj/item/002-7923187590.jpg', 1, '2026-06-11 14:49:47'),
(59, 22, 'assets/uploads/tours/kasganj/item/003-31a727d4a5.jpg', 2, '2026-06-11 14:49:47'),
(60, 23, 'assets/uploads/tours/kasganj/item/001-5e771a310c.jpg', 0, '2026-06-11 14:49:47'),
(61, 24, 'assets/uploads/tours/kasganj/item/001-c7d4229721.jpg', 0, '2026-06-11 14:49:47'),
(62, 24, 'assets/uploads/tours/kasganj/item/002-42aa9c9ffe.jpg', 1, '2026-06-11 14:49:47'),
(63, 25, 'assets/uploads/tours/kasganj/item/001-f1ffc21034.jpg', 0, '2026-06-11 14:49:47'),
(64, 25, 'assets/uploads/tours/kasganj/item/002-ed1441e2e7.jpg', 1, '2026-06-11 14:49:47'),
(65, 26, 'assets/uploads/tours/kasganj/item/001-719893ee7e.jpeg', 0, '2026-06-11 14:49:47'),
(66, 27, 'assets/uploads/tours/kasganj/item/001-c651e7eed8.jpg', 0, '2026-06-11 14:49:47'),
(67, 27, 'assets/uploads/tours/kasganj/item/002-0786011d88.jpg', 1, '2026-06-11 14:49:47'),
(68, 28, 'assets/uploads/tours/kasganj/item/001-26f7c36d1c.jpg', 0, '2026-06-11 14:49:47'),
(69, 29, 'assets/uploads/tours/kasganj/item/001-bccc2029c1.jpg', 0, '2026-06-11 14:49:47'),
(70, 30, 'assets/uploads/tours/kasganj/item/001-974ca66e13.jpg', 0, '2026-06-11 14:49:47'),
(71, 30, 'assets/uploads/tours/kasganj/item/002-253b69f714.jpg', 1, '2026-06-11 14:49:47'),
(72, 31, 'assets/uploads/tours/kasganj/item/001-177b03a830.jpg', 0, '2026-06-11 14:49:47'),
(73, 32, 'assets/uploads/tours/lakhimpur/abalone-public-school/001-547b1479b0.jpeg', 0, '2026-06-11 14:49:47'),
(74, 33, 'assets/uploads/tours/lakhimpur/ajmani-international-school/001-ca686bedcf.jpg', 0, '2026-06-11 14:49:47'),
(75, 33, 'assets/uploads/tours/lakhimpur/ajmani-international-school/002-9e7e443630.jpg', 1, '2026-06-11 14:49:47'),
(76, 33, 'assets/uploads/tours/lakhimpur/ajmani-international-school/003-984bf1115b.jpeg', 2, '2026-06-11 14:49:47'),
(77, 34, 'assets/uploads/tours/lakhimpur/album/001-be4742361b.jpg', 0, '2026-06-11 14:49:47'),
(78, 35, 'assets/uploads/tours/lakhimpur/b-d-a-k-inter-college/001-77bb547f58.jpg', 0, '2026-06-11 14:49:47'),
(79, 35, 'assets/uploads/tours/lakhimpur/b-d-a-k-inter-college/002-e5ff1501f7.jpg', 1, '2026-06-11 14:49:47'),
(80, 36, 'assets/uploads/tours/lakhimpur/b-r-p-inter-college/001-dba00110d4.jpg', 0, '2026-06-11 14:49:47'),
(81, 37, 'assets/uploads/tours/lakhimpur/baldev-vedic-inter-college/001-f14ceccefe.jpeg', 0, '2026-06-11 14:49:47'),
(82, 38, 'assets/uploads/tours/lakhimpur/city-montessory-inter-college/001-449fe31848.jpg', 0, '2026-06-11 14:49:47'),
(83, 38, 'assets/uploads/tours/lakhimpur/city-montessory-inter-college/002-5e800cbea7.jpg', 1, '2026-06-11 14:49:47'),
(84, 38, 'assets/uploads/tours/lakhimpur/city-montessory-inter-college/003-9f37995573.jpg', 2, '2026-06-11 14:49:47'),
(85, 38, 'assets/uploads/tours/lakhimpur/city-montessory-inter-college/004-5bbac9d270.jpg', 3, '2026-06-11 14:49:47'),
(86, 38, 'assets/uploads/tours/lakhimpur/city-montessory-inter-college/005-06572c25a7.jpg', 4, '2026-06-11 14:49:47'),
(87, 38, 'assets/uploads/tours/lakhimpur/city-montessory-inter-college/006-be2bc5969e.jpg', 5, '2026-06-11 14:49:47'),
(88, 38, 'assets/uploads/tours/lakhimpur/city-montessory-inter-college/007-01d151c209.jpg', 6, '2026-06-11 14:49:47'),
(89, 38, 'assets/uploads/tours/lakhimpur/city-montessory-inter-college/008-a77907fa9f.jpg', 7, '2026-06-11 14:49:47'),
(90, 38, 'assets/uploads/tours/lakhimpur/city-montessory-inter-college/009-e82feaa93d.jpg', 8, '2026-06-11 14:49:47'),
(91, 39, 'assets/uploads/tours/lakhimpur/d-d-g-smarak-vidyalay/001-455c9fcb6a.jpg', 0, '2026-06-11 14:49:47'),
(92, 39, 'assets/uploads/tours/lakhimpur/d-d-g-smarak-vidyalay/002-d149b9ed0b.jpeg', 1, '2026-06-11 14:49:47'),
(93, 40, 'assets/uploads/tours/lakhimpur/gurukul-academy/001-feef72eafc.jpeg', 0, '2026-06-11 14:49:47'),
(94, 41, 'assets/uploads/tours/lakhimpur/guru-nanak-inter-college-lmp/001-0c5e5ef55d.jpeg', 0, '2026-06-11 14:49:47'),
(95, 42, 'assets/uploads/tours/lakhimpur/guru-nanak-vidhak-sabha-kanya-inter-college/001-50af0de033.jpeg', 0, '2026-06-11 14:49:47'),
(96, 43, 'assets/uploads/tours/lakhimpur/haridwar-lal-saraswati-bal-vidya-mandir-inter-college/001-471692eb0a.jpeg', 0, '2026-06-11 14:49:47'),
(97, 44, 'assets/uploads/tours/lakhimpur/k-v-s-s-b/001-f032b1f08f.jpeg', 0, '2026-06-11 14:49:47'),
(98, 45, 'assets/uploads/tours/lakhimpur/kedar-singh-memorial-inter-college/001-76b1b21e83.jpg', 0, '2026-06-11 14:49:47'),
(99, 45, 'assets/uploads/tours/lakhimpur/kedar-singh-memorial-inter-college/002-876b5ca36d.jpg', 1, '2026-06-11 14:49:47'),
(100, 46, 'assets/uploads/tours/lakhimpur/krashak-samaj-inter-college/001-dc2a5e7341.jpg', 0, '2026-06-11 14:49:47'),
(101, 46, 'assets/uploads/tours/lakhimpur/krashak-samaj-inter-college/002-7657f6fd0b.jpg', 1, '2026-06-11 14:49:47'),
(102, 46, 'assets/uploads/tours/lakhimpur/krashak-samaj-inter-college/003-798b47479f.jpeg', 2, '2026-06-11 14:49:47'),
(103, 46, 'assets/uploads/tours/lakhimpur/krashak-samaj-inter-college/004-c0ad2fa669.jpeg', 3, '2026-06-11 14:49:47'),
(104, 47, 'assets/uploads/tours/lakhimpur/lucknow-public-school/001-6fe6914ebb.jpeg', 0, '2026-06-11 14:49:47'),
(105, 48, 'assets/uploads/tours/lakhimpur/p-d-u-s-v-m-inter-college/001-78d81b3e86.jpg', 0, '2026-06-11 14:49:47'),
(106, 48, 'assets/uploads/tours/lakhimpur/p-d-u-s-v-m-inter-college/002-764fd1e61a.jpg', 1, '2026-06-11 14:49:47'),
(107, 49, 'assets/uploads/tours/lakhimpur/raja-lone-singh-inter-college/001-88a96b4947.jpg', 0, '2026-06-11 14:49:48'),
(108, 50, 'assets/uploads/tours/lakhimpur/raja-pratap-vikram-shah-inter-college/001-2caf750311.jpeg', 0, '2026-06-11 14:49:48'),
(109, 51, 'assets/uploads/tours/lakhimpur/rajkeey-high-school/001-1d3d0aefbe.jpg', 0, '2026-06-11 14:49:48'),
(110, 52, 'assets/uploads/tours/lakhimpur/rajkiy-kanya-inter-college/001-66f3c75cc4.jpeg', 0, '2026-06-11 14:49:48'),
(111, 53, 'assets/uploads/tours/lakhimpur/ramadhin-inter-college/001-ae6e92f9db.jpeg', 0, '2026-06-11 14:49:48'),
(112, 54, 'assets/uploads/tours/lakhimpur/rani-lakshmi-bai-girls-inter-college/001-c5e9a3709e.jpeg', 0, '2026-06-11 14:49:48'),
(113, 55, 'assets/uploads/tours/lakhimpur/seth-m-r-jaipuriya/001-d6744ff967.jpg', 0, '2026-06-11 14:49:48'),
(114, 55, 'assets/uploads/tours/lakhimpur/seth-m-r-jaipuriya/002-25680c6b39.jpg', 1, '2026-06-11 14:49:48'),
(115, 55, 'assets/uploads/tours/lakhimpur/seth-m-r-jaipuriya/003-6487f2fa9e.jpeg', 2, '2026-06-11 14:49:48'),
(116, 56, 'assets/uploads/tours/lakhimpur/uma-devi-children-academy/001-c52b7f3ab8.jpg', 0, '2026-06-11 14:49:48'),
(117, 56, 'assets/uploads/tours/lakhimpur/uma-devi-children-academy/002-31c706b4db.jpg', 1, '2026-06-11 14:49:48'),
(118, 56, 'assets/uploads/tours/lakhimpur/uma-devi-children-academy/003-9f04ef861c.jpeg', 2, '2026-06-11 14:49:48'),
(119, 57, 'assets/uploads/tours/lakhimpur/z-p-inter-college/001-47600e92af.jpg', 0, '2026-06-11 14:49:48'),
(120, 57, 'assets/uploads/tours/lakhimpur/z-p-inter-college/002-9ac4213f81.jpeg', 1, '2026-06-11 14:49:48'),
(121, 58, 'assets/uploads/tours/lucknow/album/001-9abf9b184e.jpg', 0, '2026-06-11 14:49:48'),
(122, 59, 'assets/uploads/tours/lucknow/atal-awaseey-vidyalay-lucknow/001-8ebbb5c3e6.jpg', 0, '2026-06-11 14:49:48'),
(123, 59, 'assets/uploads/tours/lucknow/atal-awaseey-vidyalay-lucknow/002-2b168e2f47.jpeg', 1, '2026-06-11 14:49:48'),
(124, 59, 'assets/uploads/tours/lucknow/atal-awaseey-vidyalay-lucknow/003-285c51615b.jpeg', 2, '2026-06-11 14:49:48'),
(125, 60, 'assets/uploads/tours/lucknow/b-r-c-malihabad-lucknow/001-6c180597b4.jpg', 0, '2026-06-11 14:49:48'),
(126, 60, 'assets/uploads/tours/lucknow/b-r-c-malihabad-lucknow/002-75d6e40cb8.jpg', 1, '2026-06-11 14:49:48'),
(127, 60, 'assets/uploads/tours/lucknow/b-r-c-malihabad-lucknow/003-a61ccde56b.jpg', 2, '2026-06-11 14:49:48'),
(128, 61, 'assets/uploads/tours/lucknow/p-m-v-amethiya-salempur/001-27e632d4d3.jpg', 0, '2026-06-11 14:49:48'),
(129, 61, 'assets/uploads/tours/lucknow/p-m-v-amethiya-salempur/002-7a256828cb.jpg', 1, '2026-06-11 14:49:48'),
(130, 61, 'assets/uploads/tours/lucknow/p-m-v-amethiya-salempur/003-0d65c4ace3.jpeg', 2, '2026-06-11 14:49:48'),
(131, 62, 'assets/uploads/tours/lucknow/rajkumar-academy-rajajipuram-lucknow/001-7b7514e392.jpg', 0, '2026-06-11 14:49:48'),
(132, 63, 'assets/uploads/tours/lucknow/raj-kumar-inter-college-alamnagar-lucknow/001-d287f05d24.jpg', 0, '2026-06-11 14:49:48'),
(133, 63, 'assets/uploads/tours/lucknow/raj-kumar-inter-college-alamnagar-lucknow/002-5ded99036f.jpg', 1, '2026-06-11 14:49:48'),
(134, 63, 'assets/uploads/tours/lucknow/raj-kumar-inter-college-alamnagar-lucknow/003-305ac4e79d.jpg', 2, '2026-06-11 14:49:48'),
(135, 63, 'assets/uploads/tours/lucknow/raj-kumar-inter-college-alamnagar-lucknow/004-715b44bc0c.jpeg', 3, '2026-06-11 14:49:48'),
(136, 64, 'assets/uploads/tours/lucknow/s-p-singh-inter-college-saudapur-mall-lucknow/001-605eb22ef4.jpg', 0, '2026-06-11 14:49:48'),
(137, 64, 'assets/uploads/tours/lucknow/s-p-singh-inter-college-saudapur-mall-lucknow/002-19d7aef35c.jpeg', 1, '2026-06-11 14:49:48'),
(138, 64, 'assets/uploads/tours/lucknow/s-p-singh-inter-college-saudapur-mall-lucknow/003-5cea2797a8.jpg', 2, '2026-06-11 14:49:48'),
(139, 64, 'assets/uploads/tours/lucknow/s-p-singh-inter-college-saudapur-mall-lucknow/004-1aee9e50c7.jpg', 3, '2026-06-11 14:49:48'),
(140, 64, 'assets/uploads/tours/lucknow/s-p-singh-inter-college-saudapur-mall-lucknow/005-61c4229c3c.jpeg', 4, '2026-06-11 14:49:48'),
(141, 65, 'assets/uploads/tours/lucknow/s-public-inter-college-kurakhar-mall-lucknow/001-ee1619fbe5.jpg', 0, '2026-06-11 14:49:48'),
(142, 65, 'assets/uploads/tours/lucknow/s-public-inter-college-kurakhar-mall-lucknow/002-6402e0b75e.jpeg', 1, '2026-06-11 14:49:48'),
(143, 66, 'assets/uploads/tours/lucknow/st-josephs-cathedral-hazratganj-lucknow/001-487f21f657.jpg', 0, '2026-06-11 14:49:48'),
(144, 66, 'assets/uploads/tours/lucknow/st-josephs-cathedral-hazratganj-lucknow/002-25971dd269.jpeg', 1, '2026-06-11 14:49:48'),
(145, 67, 'assets/uploads/tours/lucknow/vidya-bharti-saraswati-kunj-niralanagar-lucknow/001-9915de8c96.jpg', 0, '2026-06-11 14:49:48'),
(146, 67, 'assets/uploads/tours/lucknow/vidya-bharti-saraswati-kunj-niralanagar-lucknow/002-f259f57a2e.jpg', 1, '2026-06-11 14:49:48'),
(147, 67, 'assets/uploads/tours/lucknow/vidya-bharti-saraswati-kunj-niralanagar-lucknow/003-cab175f918.jpg', 2, '2026-06-11 14:49:48'),
(148, 67, 'assets/uploads/tours/lucknow/vidya-bharti-saraswati-kunj-niralanagar-lucknow/004-993abd9d0f.jpg', 3, '2026-06-11 14:49:48'),
(149, 67, 'assets/uploads/tours/lucknow/vidya-bharti-saraswati-kunj-niralanagar-lucknow/005-440c96953b.jpg', 4, '2026-06-11 14:49:48');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_packages`
--

CREATE TABLE `gallery_packages` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(190) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_packages`
--

INSERT INTO `gallery_packages` (`id`, `category_id`, `name`, `sort_order`, `created_at`) VALUES
(8, 6, 'A. Gyanfort Innovative School, Sadar Farrukhabad', 0, '2026-06-11 14:49:47'),
(9, 6, 'Army Public School & Ram Tirth Dubey Memorial School Fatehgarh Farrukhabad', 1, '2026-06-11 14:49:47'),
(10, 6, 'C.P. International Farrukhabad', 2, '2026-06-11 14:49:47'),
(11, 6, 'C.P.V.N. Kaimganj Farrukhabad', 3, '2026-06-11 14:49:47'),
(12, 6, 'Dr. B.P. Agrawal Shiksha Niketan Farrukhabad', 4, '2026-06-11 14:49:47'),
(13, 6, 'G.I.C. & G.G.I.C. Fatehgarh, Farrukhabad', 5, '2026-06-11 14:49:47'),
(14, 6, 'Rajputana Public School Farrukhabad', 6, '2026-06-11 14:49:47'),
(15, 6, 'SVRM Public School Nawabganj, Farrukhabad', 7, '2026-06-11 14:49:47'),
(16, 7, 'A. कलेक्ट्रेट परिसर कासगंज से जिले में भ्रमण प्रारम्भ', 0, '2026-06-11 14:49:47'),
(17, 7, 'एच०एन०इण्टर कॉलेज गंजडुंडवारा', 1, '2026-06-11 14:49:47'),
(18, 7, 'एन.आर. पब्लिक स्कूल प्रहलादपुर सोरों, कासगंज', 2, '2026-06-11 14:49:47'),
(19, 7, 'एस. टी. डी. एम. इण्टर कॉलेज सोरों कासगंज', 3, '2026-06-11 14:49:47'),
(20, 7, 'एस० के०एम० इण्टर कॉलेज कासगंज', 4, '2026-06-11 14:49:47'),
(21, 7, 'एस०बी०आर इण्टर कॉलेज पटियाली', 5, '2026-06-11 14:49:47'),
(22, 7, 'दयानंद इण्टर कालेज, दरियावगंज', 6, '2026-06-11 14:49:47'),
(23, 7, 'पं०दीन० उ०माँ० इण्टर कॉलेज अलाउद्दीनपुर', 7, '2026-06-11 14:49:47'),
(24, 7, 'पी०आर० इण्टर कॉलेज सिढ़पुरा', 8, '2026-06-11 14:49:47'),
(25, 7, 'राजकीय बालिका इण्टर कॉलेज पटियाली', 9, '2026-06-11 14:49:47'),
(26, 7, 'शेरवानी इंटर कॉलेज न्यौली,कासगंज', 10, '2026-06-11 14:49:47'),
(27, 7, 'श्याम सुंदर इण्टर कालेज, दरियावगंज', 11, '2026-06-11 14:49:47'),
(28, 7, 'श्रीमती मीरादेवी इण्टर कॉलेज बनुपूरा अमांपुर', 12, '2026-06-11 14:49:47'),
(29, 7, 'श्री महताबराय उ०मा०वि० सिकहरा गंजडुंडवारा', 13, '2026-06-11 14:49:47'),
(30, 7, 'सेंट जोसेफ पब्लिक स्कूल कासगंज', 14, '2026-06-11 14:49:47'),
(31, 7, 'सेठ एम०आर० जयपुरिया स्कूल, कासगंज', 15, '2026-06-11 14:49:47'),
(32, 8, 'Abalone Public School', 0, '2026-06-11 14:49:47'),
(33, 8, 'AJMANI INTERNATIONAL SCHOOL', 1, '2026-06-11 14:49:47'),
(34, 8, 'Album', 2, '2026-06-11 14:49:47'),
(35, 8, 'B.D.A.K. INTER COLLEGE', 3, '2026-06-11 14:49:47'),
(36, 8, 'B. R. P. INTER COLLEGE', 4, '2026-06-11 14:49:47'),
(37, 8, 'Baldev Vedic Inter College', 5, '2026-06-11 14:49:47'),
(38, 8, 'CITY MONTESSORY INTER COLLEGE', 6, '2026-06-11 14:49:47'),
(39, 8, 'D. D. G. Smarak Vidyalay', 7, '2026-06-11 14:49:47'),
(40, 8, 'Gurukul Academy', 8, '2026-06-11 14:49:47'),
(41, 8, 'Guru Nanak Inter College LMP', 9, '2026-06-11 14:49:47'),
(42, 8, 'Guru Nanak Vidhak Sabha Kanya inter College', 10, '2026-06-11 14:49:47'),
(43, 8, 'Haridwar Lal Saraswati Bal Vidya Mandir inter College', 11, '2026-06-11 14:49:47'),
(44, 8, 'K. V. S. S. B', 12, '2026-06-11 14:49:47'),
(45, 8, 'KEDAR SINGH MEMORIAL INTER COLLEGE', 13, '2026-06-11 14:49:47'),
(46, 8, 'KRASHAK SAMAJ INTER COLLEGE', 14, '2026-06-11 14:49:47'),
(47, 8, 'LUCKNOW PUBLIC SCHOOL', 15, '2026-06-11 14:49:47'),
(48, 8, 'P. D. U. S. V. M. INTER COLLEGE', 16, '2026-06-11 14:49:47'),
(49, 8, 'RAJA LONE SINGH INTER COLLEGE', 17, '2026-06-11 14:49:47'),
(50, 8, 'Raja Pratap Vikram Shah inter College', 18, '2026-06-11 14:49:48'),
(51, 8, 'RAJKEEY HIGH SCHOOL', 19, '2026-06-11 14:49:48'),
(52, 8, 'Rajkiy Kanya inter College', 20, '2026-06-11 14:49:48'),
(53, 8, 'Ramadhin Inter College', 21, '2026-06-11 14:49:48'),
(54, 8, 'Rani Lakshmi Bai girls inter College', 22, '2026-06-11 14:49:48'),
(55, 8, 'SETH M. R. JAIPURIYA', 23, '2026-06-11 14:49:48'),
(56, 8, 'UMA DEVI CHILDREN ACADEMY', 24, '2026-06-11 14:49:48'),
(57, 8, 'Z. P. INTER COLLEGE', 25, '2026-06-11 14:49:48'),
(58, 9, 'Album', 0, '2026-06-11 14:49:48'),
(59, 9, 'ATAL AWASEEY VIDYALAY LUCKNOW', 1, '2026-06-11 14:49:48'),
(60, 9, 'B.R.C MALIHABAD LUCKNOW', 2, '2026-06-11 14:49:48'),
(61, 9, 'P. M. V. AMETHIYA SALEMPUR', 3, '2026-06-11 14:49:48'),
(62, 9, 'RAJKUMAR ACADEMY RAJAJIPURAM, LUCKNOW', 4, '2026-06-11 14:49:48'),
(63, 9, 'RAJ KUMAR INTER COLLEGE ALAMNAGAR LUCKNOW', 5, '2026-06-11 14:49:48'),
(64, 9, 'S.P.SINGH INTER COLLEGE SAUDAPUR MALL LUCKNOW', 6, '2026-06-11 14:49:48'),
(65, 9, 'S.PUBLIC INTER COLLEGE KURAKHAR MALL LUCKNOW', 7, '2026-06-11 14:49:48'),
(66, 9, 'ST.JOSEPHS CATHEDRAL HAZRATGANJ LUCKNOW', 8, '2026-06-11 14:49:48'),
(67, 9, 'VIDYA BHARTI SARASWATI KUNJ NIRALANAGAR LUCKNOW', 9, '2026-06-11 14:49:48');

-- --------------------------------------------------------

--
-- Table structure for table `home_slider_items`
--

CREATE TABLE `home_slider_items` (
  `id` varchar(32) NOT NULL,
  `title` varchar(190) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_slider_items`
--

INSERT INTO `home_slider_items` (`id`, `title`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
('0bcccd25658611f191f9f068e37470a9', 'Science Bus Lab', 'assets/image/header/b.jpg', 3, '2026-06-11 16:39:35', NULL),
('537f25adf243ea06', '20260611130902-73d75f1b955edbd4', 'assets/uploads/20260611130902-73d75f1b955edbd4.png', 6, '2026-06-11 16:39:02', NULL),
('e9c16d3c658511f191f9f068e37470a9', 'Quote 1', 'assets/image/header/quote1.jpeg', 0, '2026-06-11 16:38:38', NULL),
('e9c17bed658511f191f9f068e37470a9', 'Quote 3', 'assets/image/header/quote3.jpeg', 1, '2026-06-11 16:38:38', NULL),
('e9c17d95658511f191f9f068e37470a9', 'Science Activity', 'assets/image/header/d.jpg', 4, '2026-06-11 16:38:38', NULL),
('e9c17dd7658511f191f9f068e37470a9', 'Science Outreach', 'assets/image/header/e.jpg', 5, '2026-06-11 16:38:38', NULL),
('fe5174ca95c8a16e', 'Science Bus', 'assets/image/header/a.jpg', 2, '2026-06-11 16:43:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news_items`
--

CREATE TABLE `news_items` (
  `id` varchar(32) NOT NULL,
  `title` varchar(190) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_items`
--

INSERT INTO `news_items` (`id`, `title`, `image`, `sort_order`, `created_at`) VALUES
('0a6260b2f87dfa13', '3Chakiya.jpg', 'assets/image/news/3Chakiya.jpg', 9, '2026-05-18 12:01:35'),
('5e33e0a79072e751', '5Etawah-II_bus_visit.jpeg', 'assets/image/news/5Etawah-II_bus_visit.jpeg', 7, '2026-05-18 12:01:35'),
('5ee9f6123952088c', '9Meerut_bus_visit.jpeg', 'assets/image/news/9Meerut_bus_visit.jpeg', 3, '2026-05-18 12:01:35'),
('60186cbfe0eedc14', '1Sandeela1.jpg', 'assets/image/news/1Sandeela1.jpg', 11, '2026-05-18 12:01:35'),
('78f9048fd2bd970e', '7yogi-ji_bus_launch.jpeg', 'assets/image/news/7yogi-ji_bus_launch.jpeg', 5, '2026-05-18 12:01:35'),
('7f9ceb048bf949e3', '10jaunpur_20260117_visit.jpeg', 'assets/image/news/10jaunpur_20260117_visit.jpeg', 2, '2026-05-18 12:01:35'),
('9929ea630fb4e4a1', '2Sandeela2.jpg', 'assets/image/news/2Sandeela2.jpg', 10, '2026-05-18 12:01:35'),
('bac6b60e74b83250', '8Balia_bus_visit.jpeg', 'assets/image/news/8Balia_bus_visit.jpeg', 4, '2026-05-18 12:01:35'),
('f54d81a4d29ef8fe', '6Etawah_bus_visit.jpeg', 'assets/image/news/6Etawah_bus_visit.jpeg', 6, '2026-05-18 12:01:35'),
('f9c09b1ff787f64b', '4Kandhini_bus_visit.jpeg', 'assets/image/news/4Kandhini_bus_visit.jpeg', 8, '2026-05-18 12:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `social_impact_testimonials`
--

CREATE TABLE `social_impact_testimonials` (
  `id` varchar(32) NOT NULL,
  `username` varchar(190) NOT NULL,
  `description` text NOT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT 5,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_impact_testimonials`
--

INSERT INTO `social_impact_testimonials` (`id`, `username`, `description`, `rating`, `sort_order`, `created_at`, `updated_at`) VALUES
('social_impact_1', 'User1', 'The Science Bus visit was a truly inspiring and life-changing experience for our students, sparking curiosity and making science come alive beyond the classroom.', 5, 0, '2026-09-17 21:54:04', NULL),
('social_impact_2', 'User2', 'For many of our students, this was their first real exposure to practical experiments, and it has ignited a new passion for learning.', 5, 1, '2026-09-17 21:54:04', NULL),
('social_impact_3', 'User3', 'The interactive sessions made science fun, relatable, and unforgettable for our children.', 5, 2, '2026-09-17 21:54:04', NULL),
('social_impact_4', 'User4', 'The Science Bus visit opened young minds to innovation and possibilities they had never imagined before.', 5, 3, '2026-09-17 21:54:04', NULL),
('social_impact_5', 'User5', 'The Science Bus brought science out of textbooks and into reality, leaving our students motivated, confident, and eager to explore more.', 5, 4, '2026-09-17 21:54:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` varchar(32) NOT NULL,
  `section` enum('main_team','educator_team','operational_team') NOT NULL,
  `name` varchar(190) NOT NULL,
  `role` varchar(190) NOT NULL,
  `org` varchar(190) NOT NULL DEFAULT '',
  `email` varchar(190) NOT NULL DEFAULT '',
  `contact` varchar(80) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `section`, `name`, `role`, `org`, `email`, `contact`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
('1f88cdc6a893347f', 'educator_team', 'Mr. Rinku', 'Educator', '', 'rinkugangwar9991@gmail.com', '9451237404', 'assets/image/Team/rinku.jpeg', 0, '2026-05-18 12:01:35', NULL),
('213c01a325fe93d6', 'operational_team', 'Mr. Ashish Tripathi', 'Operational Manager', 'IIT Kanpur', 'ashishkt@iitk.ac.in', '', 'assets/image/Team/ashish.jpeg', 0, '2026-05-18 12:01:35', NULL),
('58a9fbdd616825c6', 'main_team', 'Prof. Deepu Philip', 'Professor, DOMS Department', 'IIT Kanpur', 'dphilip@iitk.ac.in', '', 'assets/image/Team/ProfDeepuPhilip.png', 0, '2026-05-18 12:01:35', NULL),
('6bb29e87012473ba', 'main_team', 'Rachna Agrawal', 'Project Executive Officer', 'IIT Kanpur', 'rachna@iitk.ac.in', '', 'assets/image/Team/rachna.jpeg', 2, '2026-05-18 12:01:35', NULL),
('6de7d9fd5629aac8', 'educator_team', 'Mr. Brikesh Kumar', 'Educator', '', 'brikesh.kumar.0108@gmail.com', '7860134226', 'assets/image/Team/brikesh.jpeg', 1, '2026-05-18 12:01:35', NULL),
('895010cfd84b549a', 'operational_team', 'Mr. Subhashish Panday', 'Lab Technician', '', 'pshubhashish8@gmail.com', '9794370873', 'assets/image/Team/Shubhashish.jpeg', 1, '2026-05-18 12:01:35', NULL),
('b2c2f7153757c969', 'operational_team', 'Mr. Devendra Mishra', 'Bus Driver', '', 'devendramishra225@gmail.com', '9838577697', 'assets/image/Team/devendra.jpeg', 2, '2026-05-18 12:01:35', NULL),
('e125ae233b6d8fdf', 'main_team', 'Dr. Sumit Kumar Srivastava', 'Scientific Officer', 'C.S.T Department, UP', 'sumit.astro.physics@gmail.com', '', 'assets/image/Team/sumitkumarsr.jpeg', 1, '2026-05-18 12:01:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tour_profile_items`
--

CREATE TABLE `tour_profile_items` (
  `id` int(11) NOT NULL,
  `tour_start` date DEFAULT NULL,
  `tour_end` date DEFAULT NULL,
  `district` varchar(190) NOT NULL,
  `description` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_profile_items`
--

INSERT INTO `tour_profile_items` (`id`, `tour_start`, `tour_end`, `district`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, '2018-12-16', '2018-12-31', 'Chitrakoot', '4500 students benefitted', 0, '2026-06-11 16:51:58', NULL),
(2, '2019-01-20', '2019-03-04', 'Kumbh Mela, 2019, Prayagraj', '30,000 general population benefitted', 1, '2026-06-11 16:51:58', NULL),
(3, '2019-03-31', '2019-04-20', 'Ballia', '2000 students benefitted', 2, '2026-06-11 16:51:58', NULL),
(4, '2019-04-27', '2019-05-27', 'Meerut', '15000 students benefitted', 3, '2026-06-11 16:51:58', NULL),
(5, '2019-07-16', '2019-07-31', 'Chandauli', '1800 students benefitted', 4, '2026-06-11 16:51:58', NULL),
(6, '2019-08-10', '2019-08-10', 'Kanpur', '250 students benefitted at Khalsa Inter College, Govind Nagar, Kanpur', 5, '2026-06-11 16:51:58', NULL),
(7, '2019-08-19', '2019-09-03', 'Etawah', '1500 students benefitted', 6, '2026-06-11 16:51:58', NULL),
(8, '2019-09-06', '2019-09-11', 'Bhadauchath Mela Jaunpur', '4000 general population benefitted', 7, '2026-06-11 16:51:58', NULL),
(9, '2019-09-15', '2019-09-18', 'Gughal Mela, Saharanpur', '2000 general population benefitted', 8, '2026-06-11 16:51:58', NULL),
(10, '2019-10-01', '2019-10-25', 'Sandila', '7000 students benefitted', 9, '2026-06-11 16:51:58', NULL),
(11, '2019-11-13', '2019-11-28', 'Jalaun', '250 students benefitted', 10, '2026-06-11 16:51:58', NULL),
(12, '2019-10-04', '2019-10-14', 'Gorakhpur', '4200 general population benefitted', 11, '2026-06-11 16:51:58', NULL),
(13, '2020-01-10', '2020-01-15', 'Gorakhpur Mahotsav 2020', '3500 general population benefitted', 12, '2026-06-11 16:51:58', NULL),
(14, '2020-01-16', '2020-01-25', 'Deoria Mahotsav 2020', '8500 general population benefitted', 13, '2026-06-11 16:51:58', NULL),
(15, '2020-01-27', '2020-01-30', 'Amroha', '1200 students benefitted', 14, '2026-06-11 16:51:58', NULL),
(16, '2020-02-05', '2020-02-06', 'Rampur', '500 students benefitted', 15, '2026-06-11 16:51:58', NULL),
(17, '2020-02-20', '2020-02-24', 'Kalinjar Mahotsav, Banda', '30000 general population benefitted', 16, '2026-06-11 16:51:58', NULL),
(18, '2020-03-01', '2020-03-16', 'Ghaziabad', '1500 students benefitted', 17, '2026-06-11 16:51:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tour_profile_stats`
--

CREATE TABLE `tour_profile_stats` (
  `stat_key` varchar(80) NOT NULL,
  `stat_value` varchar(190) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_profile_stats`
--

INSERT INTO `tour_profile_stats` (`stat_key`, `stat_value`) VALUES
('active_period', '2018-2020'),
('districts_covered', '17'),
('people_benefitted', '117,700 +'),
('total_tours', '18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_email_unique` (`email`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_messages_created_idx` (`created_at`);

--
-- Indexes for table `gallery_categories`
--
ALTER TABLE `gallery_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_categories_sort_idx` (`sort_order`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_images_package_sort_idx` (`package_id`,`sort_order`);

--
-- Indexes for table `gallery_packages`
--
ALTER TABLE `gallery_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_packages_category_sort_idx` (`category_id`,`sort_order`);

--
-- Indexes for table `home_slider_items`
--
ALTER TABLE `home_slider_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `home_slider_items_image_unique` (`image`),
  ADD KEY `home_slider_items_sort_idx` (`sort_order`,`created_at`);

--
-- Indexes for table `news_items`
--
ALTER TABLE `news_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_items_image_unique` (`image`),
  ADD KEY `news_items_sort_idx` (`sort_order`,`created_at`);

--
-- Indexes for table `social_impact_testimonials`
--
ALTER TABLE `social_impact_testimonials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_impact_sort_idx` (`sort_order`,`created_at`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_members_section_sort_idx` (`section`,`sort_order`);

--
-- Indexes for table `tour_profile_items`
--
ALTER TABLE `tour_profile_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_profile_items_sort_idx` (`sort_order`,`id`);

--
-- Indexes for table `tour_profile_stats`
--
ALTER TABLE `tour_profile_stats`
  ADD PRIMARY KEY (`stat_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gallery_categories`
--
ALTER TABLE `gallery_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `gallery_packages`
--
ALTER TABLE `gallery_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tour_profile_items`
--
ALTER TABLE `tour_profile_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD CONSTRAINT `gallery_images_package_fk` FOREIGN KEY (`package_id`) REFERENCES `gallery_packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gallery_packages`
--
ALTER TABLE `gallery_packages`
  ADD CONSTRAINT `gallery_packages_category_fk` FOREIGN KEY (`category_id`) REFERENCES `gallery_categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
