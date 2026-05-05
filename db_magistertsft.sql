-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 28, 2026 at 05:44 AM
-- Server version: 10.5.29-MariaDB
-- PHP Version: 8.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_magistertsft`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_section_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` varchar(255) DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `overlay_icon_class` varchar(255) NOT NULL DEFAULT 'flaticon-plus',
  `author_name` varchar(255) DEFAULT NULL,
  `comment_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `published_at` datetime DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `animation_duration_ms` smallint(5) UNSIGNED NOT NULL DEFAULT 1500,
  `sort_order` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `blog_section_id`, `title`, `slug`, `excerpt`, `body`, `image_path`, `image_alt`, `overlay_icon_class`, `author_name`, `comment_count`, `published_at`, `is_published`, `animation_duration_ms`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Models & OEM Solutions | Simul Corporation.', 'models-oem-solutions-simul-corporation', 'There are many variations of passages of Lorem Ipsum available variations.', NULL, 'assets/images/blog/blog-v1-1.jpg', 'Models & OEM Solutions | Simul Corporation.', 'flaticon-plus', 'Editor', 2, '2025-10-10 04:36:42', 1, 1500, 1, '2025-10-12 20:36:42', '2025-10-12 20:36:42'),
(2, 1, 'Innovations in Smart Mobility & ITS Research.', 'innovations-in-smart-mobility-its-research', 'There are many variations of passages of Lorem Ipsum available variations.', NULL, 'assets/images/blog/blog-v1-2.jpg', 'Innovations in Smart Mobility & ITS Research.', 'flaticon-plus', 'Editor', 2, '2025-10-11 04:36:42', 1, 1500, 2, '2025-10-12 20:36:42', '2025-10-12 20:36:42'),
(3, 1, 'Hydroinformatics for Flood Early Warning Systems.', 'hydroinformatics-for-flood-early-warning-systems', 'There are many variations of passages of Lorem Ipsum available variations.', NULL, 'assets/images/blog/blog-v1-3.jpg', 'Hydroinformatics for Flood Early Warning Systems.', 'flaticon-plus', 'Editor', 2, '2025-10-12 04:36:42', 1, 1500, 3, '2025-10-12 20:36:42', '2025-10-12 20:36:42');

-- --------------------------------------------------------

--
-- Table structure for table `blog_sections`
--

CREATE TABLE `blog_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_sections`
--

INSERT INTO `blog_sections` (`id`, `slug`, `subtitle`, `title`, `button_text`, `button_url`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'blog-latest', 'The standard chunk of used since the is reproduced below for those.', 'Letest News', 'View All Blog', 'http://localhost/blog', 1, 0, '2025-10-12 20:36:42', '2025-10-12 20:36:42');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_items`
--

CREATE TABLE `gallery_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gallery_section_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_label` varchar(255) DEFAULT NULL,
  `icon_class` varchar(255) DEFAULT NULL,
  `icon_color_class` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `overlay_link_path` varchar(255) DEFAULT NULL,
  `col_classes` varchar(255) NOT NULL DEFAULT 'col-xl-4 col-lg-6 col-md-6',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_items`
--

INSERT INTO `gallery_items` (`id`, `gallery_section_id`, `title`, `slug`, `category_label`, `icon_class`, `icon_color_class`, `image_path`, `image_alt`, `overlay_link_path`, `col_classes`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Laboratorium Struktur & Bahan', 'laboratorium-struktur-bahan', 'Laboratorium', 'flaticon-architect', 'clr1', 'assets/images/gallery/gallery-v1-4.jpg', 'Pengujian beton & material di Laboratorium Struktur UNMUL', 'assets/images/gallery/gallery-v1-4.jpg', 'col-xl-4 col-lg-6 col-md-6', 1, 2, '2025-10-12 05:01:55', '2025-10-12 05:05:43'),
(2, 1, 'Compression Machine', 'laboratorium-geoteknik', 'Laboratorium', 'flaticon-manufacture', 'clr1', 'storage/gallery/items/mZ76v1hKEIP2f1CflJFsUVgeLt3BEKDFIreu8Xzo.jpg', 'Uji tanah dan peralatan geoteknik', 'assets/images/gallery/gallery-v1-4.jpg', 'col-xl-4 col-lg-6 col-md-6', 1, 2, '2025-10-12 05:01:55', '2025-11-18 21:28:45'),
(3, 1, 'Hidrolika & Sumber Daya Air', 'hidrolika-sumber-daya-air', 'Laboratorium', 'flaticon-chemical', 'clr1', 'assets/images/gallery/gallery-v1-4.jpg', 'Saluran uji dan instrumen hidrolika', 'assets/images/gallery/gallery-v1-4.jpg', 'col-xl-4 col-lg-6 col-md-6', 1, 3, '2025-10-12 05:01:55', '2025-10-12 05:01:55'),
(4, 1, 'Transportasi & Perencanaan', 'transportasi-perencanaan', 'Studio', 'flaticon-car-parts', 'clr1', 'assets/images/gallery/gallery-v1-4.jpg', 'Pemodelan lalu lintas dan survei transportasi', 'assets/images/gallery/gallery-v1-4.jpg', 'col-xl-4 col-lg-6 col-md-6', 1, 4, '2025-10-12 05:01:55', '2025-10-12 05:01:55'),
(5, 1, 'Seminar & Kuliah Tamu', 'seminar-kuliah-tamu', 'Kegiatan Akademik', 'flaticon-manufacture', 'clr1', 'assets/images/gallery/gallery-v1-4.jpg', 'Seminar dan kuliah tamu Magister Teknik Sipil UNMUL', 'assets/images/gallery/gallery-v1-4.jpg', 'col-xl-4 col-lg-6 col-md-6', 1, 5, '2025-10-12 05:01:55', '2025-10-12 05:01:55'),
(6, 1, 'Pengabdian & Mitra IKN', 'pengabdian-mitra-ikn', 'Kolaborasi', 'flaticon-architect', 'clr1', 'assets/images/gallery/gallery-v1-4.jpg', 'Kegiatan pengabdian masyarakat dan kolaborasi dengan mitra', 'assets/images/gallery/gallery-v1-4.jpg', 'col-xl-4 col-lg-6 col-md-6', 1, 6, '2025-10-12 05:01:55', '2025-10-12 05:01:55'),
(9, 1, 'Jadwal Kuliah Semester Genap 2025/2026', 'jadwal-kuliah-semester-genap-20252026', 'AKADEMIK', NULL, NULL, 'storage/gallery/items/3eOPGzmBtjvYPiST8pgaAQWX7qKJ9wEOm8wwGyeG.jpg', NULL, NULL, 'col-xl-4 col-lg-6 col-md-6', 1, 0, '2026-02-14 17:59:32', '2026-02-14 17:59:32');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_sections`
--

CREATE TABLE `gallery_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_sections`
--

INSERT INTO `gallery_sections` (`id`, `slug`, `subtitle`, `title`, `button_text`, `button_url`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'galeri', 'Dokumentasi laboratorium, riset, kuliah tamu, dan pengabdian masyarakat Program Magister (S2) Teknik Sipil Universitas Mulawarman.', 'Galeri Kegiatan & Fasilitas', 'Lihat Semua Galeri', 'http://localhost/galeri', 1, 0, '2025-10-12 05:01:55', '2025-10-12 05:01:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2025_10_12_000001_create_research_sections_table', 1),
(10, '2025_10_12_000002_create_research_topics_table', 1),
(11, '2025_10_12_000003_create_video_gallery_sections_table', 2),
(12, '2025_10_12_000004_create_video_gallery_items_table', 2),
(13, '2025_10_12_000005_create_gallery_sections_table', 3),
(14, '2025_10_12_000006_create_gallery_items_table', 3),
(15, '2025_10_12_000007_create_teacher_sections_table', 4),
(16, '2025_10_12_000008_create_teachers_table', 4),
(17, '2025_10_12_000009_create_blog_sections_table', 5),
(18, '2025_10_12_000010_create_blog_posts_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `research_sections`
--

CREATE TABLE `research_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `research_sections`
--

INSERT INTO `research_sections` (`id`, `slug`, `subtitle`, `title`, `button_text`, `button_url`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'riset-tesis', 'Klaster riset dan tema tesis Magister (S2) Teknik Sipil Universitas Mulawarman.', 'Riset & Tesis Unggulan', 'Lihat Semua Topik Riset', 'http://localhost/riset-tesis', 1, 0, '2025-10-12 03:43:39', '2025-10-12 03:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `research_topics`
--

CREATE TABLE `research_topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `research_section_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `icon_class` varchar(255) DEFAULT NULL,
  `bg_color_class` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `gallery_image_path` varchar(255) DEFAULT NULL,
  `animation_delay_ms` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `research_topics`
--

INSERT INTO `research_topics` (`id`, `research_section_id`, `title`, `slug`, `description`, `icon_class`, `bg_color_class`, `image_path`, `image_alt`, `gallery_image_path`, `animation_delay_ms`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Struktur & Material Cerdas', 'struktur-material-cerdas', 'Beton kinerja tinggi, SHM, pemodelan numerik, optimasi desain.', 'flaticon-architect', 'bgclr1', 'assets/images/project/project-v3-3.jpg', 'Riset Struktur & Material Cerdas', NULL, 0, 1, 1, '2025-10-12 03:43:39', '2025-10-12 03:43:39'),
(2, 1, 'Geoteknik & Ketahanan Bencana', 'geoteknik-ketahanan-bencana', 'Stabilitas lereng, tanah lunak, geosintetik, mikrozonasi & likuefaksi.', 'flaticon-manufacture', 'bgclr1', 'assets/images/project/project-v3-3.jpg', 'Riset Geoteknik & Ketahanan Bencana', NULL, 100, 1, 2, '2025-10-12 03:43:39', '2025-10-12 03:43:39'),
(3, 1, 'Transportasi & Smart Mobility', 'transportasi-smart-mobility', 'Keselamatan jalan, kinerja simpang, TDM, ITS, permodelan permintaan.', 'flaticon-car-parts', 'bgclr1', 'assets/images/project/project-v3-3.jpg', 'Riset Transportasi & Smart Mobility', NULL, 150, 1, 3, '2025-10-12 03:43:39', '2025-10-12 03:43:39'),
(4, 1, 'Sumber Daya Air & Hidroinformatika', 'sumber-daya-air-hidroinformatika', 'Banjir & drainase, sungai, hidrologi, dampak perubahan iklim.', 'flaticon-chemical', 'bgclr1', 'assets/images/project/project-v3-3.jpg', 'Riset Sumber Daya Air & Hidroinformatika', NULL, 200, 1, 4, '2025-10-12 03:43:39', '2025-10-12 03:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_section_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `photo_alt` varchar(255) DEFAULT NULL,
  `profile_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `scholar_url` varchar(255) DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `col_classes` varchar(255) NOT NULL DEFAULT 'col-xl-3 col-lg-6 col-md-6',
  `wow_animation_class` varchar(255) NOT NULL DEFAULT 'wow fadeInUp',
  `animation_delay_ms` smallint(5) UNSIGNED NOT NULL DEFAULT 100,
  `animation_duration_ms` smallint(5) UNSIGNED NOT NULL DEFAULT 1500,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `teacher_section_id`, `name`, `slug`, `tagline`, `photo_path`, `photo_alt`, `profile_url`, `linkedin_url`, `scholar_url`, `website_url`, `col_classes`, `wow_animation_class`, `animation_delay_ms`, `animation_duration_ms`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(5, 1, 'Prof. Dr. Ir. H. Tamrin, S.T., M.T. IPU. ASEAN Eng. APEC Eng.', 'prof-dr-ir-h-tamrin-st-mt-ipu-asean-eng-apec-eng', 'Guru Besar — Hidrologi & Sumber Daya Air; Dekan FT UNMUL (2024)', 'assets/images/team/1.png', 'Prof. Dr. Ir. H. Tamrin — Hidrologi & SDA', 'https://orasi.unmul.ac.id/web/guru-besar/prof-dr-ir-tamrin-st-mt', '#', 'https://scholar.google.com/citations?user=KXoZTgoAAAAJ', 'https://ts.ft.unmul.ac.id/list/all-dosen', 'col-xl-3 col-lg-6 col-md-6', 'wow fadeInUp', 100, 1500, 1, 1, '2025-10-13 06:02:51', '2025-10-13 06:02:51'),
(6, 1, 'Dr. Ir. Hj. Mardewi Jamal, S.T., M.T. IPM.', 'dr-ir-hj-mardewi-jamal-st-mt-ipm', 'Rekayasa Struktur — Kepala Laboratorium Rekayasa Sipil', 'assets/images/team/2.png', 'Dr. Ir. Hj. Mardewi Jamal — Struktur', 'https://labrek.sipil.ft.unmul.ac.id/', '#', 'https://scholar.google.com/citations?user=dlYvnEcAAAAJ', 'https://sinta.kemdiktisaintek.go.id/authors/profile/6156620/?view=garuda', 'col-xl-3 col-lg-6 col-md-6', 'wow fadeInDown', 200, 1500, 1, 2, '2025-10-13 06:02:51', '2025-10-13 06:02:51'),
(7, 1, 'Dr. Ir. Ery Budiman, S.T., M.T. IPM.', 'dr-ir-ery-budiman-st-mt-ipm', 'Struktur — riset terowongan apung/pipa bawah laut', 'assets/images/team/3.png', 'Dr. Ir. Ery Budiman — Struktur', 'https://ts.ft.unmul.ac.id/list/all-dosen', 'https://scholar.google.com/citations?user=sguZPdEAAAAJ', 'https://scholar.google.com/citations?user=sguZPdEAAAAJ', 'https://sinta.kemdiktisaintek.go.id/authors/profile/6156776/?view=garuda', 'col-xl-3 col-lg-6 col-md-6', 'wow fadeInUp', 300, 1500, 1, 3, '2025-10-13 06:02:51', '2025-10-22 23:45:31'),
(8, 1, 'Dr. Ir. Tiopan Henry Manto Gultom, S.T., M.T.', 'dr-ir-tiopan-henry-manto-gultom-st-mt', 'Sistem Transportasi dan Perkerasan Jalan', 'assets/images/team/4.png', 'Dr. Ir. Tiopan Henry Manto Gultom — Manajemen Konstruksi', 'https://sinta.kemdiktisaintek.go.id/authors/profile/6680512', NULL, 'https://scholar.google.com/citations?user=c76IU8YAAAAJ', 'https://sinta.kemdiktisaintek.go.id/authors/profile/6680512', 'col-xl-3 col-lg-6 col-md-6', 'wow fadeInDown', 400, 1500, 1, 4, '2025-10-13 06:02:51', '2026-01-04 18:46:24'),
(9, 1, 'Dr. Ir. Johannes E. Simangunsong, S.T., M.T.', 'dr-ir-johannes-e-simangunsong-st-mt', 'Transportasi — perencanaan & kinerja layanan', 'assets/images/team/5.png', 'Dr. Ir. Johannes E. Simangunsong — Transportasi', 'https://ts.ft.unmul.ac.id/list/all-dosen', '#', 'https://scholar.google.com/citations?user=ykxLfSIAAAAJ', '#', 'col-xl-3 col-lg-6 col-md-6', 'wow fadeInUp', 500, 1500, 1, 5, '2025-10-13 06:02:51', '2025-10-13 06:02:51'),
(10, 1, 'Dr. Ir. Ruminsar Simbolon, S.T., M.T.', 'dr-ir-ruminsar-simbolon-st-mt', 'Struktur', 'assets/images/team/6.png', 'Dr. Ir. Ruminsar Simbolon — Struktur', 'https://ts.ft.unmul.ac.id/list/all-dosen', '#', '#', 'https://www.datadikti.com/dosen/ruminsar-simbolon/s1-teknik-sipil/universitas-mulawarman/', 'col-xl-3 col-lg-6 col-md-6', 'wow fadeInDown', 600, 1500, 1, 6, '2025-10-13 06:02:51', '2025-10-13 06:02:51'),
(11, 1, 'Dr. Ir. Hj. Revia Oktaviani, S.T., M.T.', 'dr-ir-hj-revia-oktaviani-st-mt', 'Geoteknik — ketahanan lereng & batuan', 'assets/images/team/7.png', 'Dr. Ir. Hj. Revia Oktaviani — Geoteknik', 'https://sinta.kemdiktisaintek.go.id/authors/profile/6713087', '#', 'https://scholar.google.com/citations?user=i3_30AkAAAAJ', 'https://sinta.kemdiktisaintek.go.id/authors/profile/6713087', 'col-xl-3 col-lg-6 col-md-6', 'wow fadeInUp', 700, 1500, 1, 7, '2025-10-13 06:02:51', '2025-10-13 06:02:51'),
(12, 1, 'Dr. Ir. Shalaho Dina Devy, S.T., M.Eng.', 'dr-ir-shalaho-dina-devy-st-meng', 'Hidrogeologi & Pemodelan Air Tanah', 'assets/images/team/8.png', 'Dr. Ir. Shalaho Dina Devy — Hidrogeologi', 'https://sinta.kemdiktisaintek.go.id/authors/profile/6142460', '#', 'https://scholar.google.com/citations?user=gC4b9Z4AAAAJ', 'https://repository.unmul.ac.id/bitstream/handle/123456789/27140/16-Shalaho%20Dina%20Devy.pdf', 'col-xl-3 col-lg-6 col-md-6', 'wow fadeInDown', 800, 1500, 1, 8, '2025-10-13 06:02:51', '2025-10-13 06:02:51'),
(13, 1, 'Dr. Sc. Mustaid Yusuf, M.Si', 'dr-sc-mustaid-yusuf-msi', 'Hidro-Oseanografi & Pemodelan Oseanografi (FMIPA UNMUL)', 'assets/images/team/9.png', 'Dr. Sc. Mustaid Yusuf — Hidro-Oseanografi', 'https://geophysics.fmipa.unmul.ac.id/page?content=Dosen', '#', 'https://scholar.google.com/citations?user=c9IHjWQAAAAJ', 'https://geophysics.fmipa.unmul.ac.id/page?content=Dosen', 'col-xl-3 col-lg-6 col-md-6', 'wow fadeInUp', 900, 1500, 1, 9, '2025-10-13 06:02:51', '2025-10-13 06:02:51');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_sections`
--

CREATE TABLE `teacher_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_sections`
--

INSERT INTO `teacher_sections` (`id`, `slug`, `subtitle`, `title`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'dosen-pengajar', 'Profil singkat tim pengajar Magister (S2) Teknik Sipil Universitas Mulawarman.', 'Dosen Pengajar', 1, 0, '2025-10-12 05:11:40', '2025-10-13 06:02:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video_gallery_items`
--

CREATE TABLE `video_gallery_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video_gallery_section_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `play_icon_class` varchar(255) NOT NULL DEFAULT 'flaticon-play-button-1',
  `animation_delay_ms` smallint(5) UNSIGNED NOT NULL DEFAULT 300,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_gallery_items`
--

INSERT INTO `video_gallery_items` (`id`, `video_gallery_section_id`, `title`, `video_url`, `play_icon_class`, `animation_delay_ms`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'CarePress Video Gallery', 'https://www.youtube.com/watch?v=p25gICT63ek', 'flaticon-play-button-1', 300, 1, 1, '2025-10-12 03:52:08', '2025-10-12 04:44:11');

-- --------------------------------------------------------

--
-- Table structure for table `video_gallery_sections`
--

CREATE TABLE `video_gallery_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `background_image_path` varchar(255) DEFAULT NULL,
  `background_image_alt` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_gallery_sections`
--

INSERT INTO `video_gallery_sections` (`id`, `slug`, `title`, `subtitle`, `background_image_path`, `background_image_alt`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'video-gallery', 'Company Video', NULL, 'assets/images/resources/video-gallery-area-bg.jpg', 'Video Gallery Background', 1, 0, '2025-10-12 03:52:08', '2025-10-12 04:44:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_posts_blog_section_id_foreign` (`blog_section_id`),
  ADD KEY `blog_posts_slug_index` (`slug`);

--
-- Indexes for table `blog_sections`
--
ALTER TABLE `blog_sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_sections_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gallery_items`
--
ALTER TABLE `gallery_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_items_gallery_section_id_foreign` (`gallery_section_id`),
  ADD KEY `gallery_items_slug_index` (`slug`);

--
-- Indexes for table `gallery_sections`
--
ALTER TABLE `gallery_sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gallery_sections_slug_unique` (`slug`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `research_sections`
--
ALTER TABLE `research_sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `research_sections_slug_unique` (`slug`);

--
-- Indexes for table `research_topics`
--
ALTER TABLE `research_topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `research_topics_research_section_id_foreign` (`research_section_id`),
  ADD KEY `research_topics_slug_index` (`slug`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teachers_teacher_section_id_foreign` (`teacher_section_id`),
  ADD KEY `teachers_slug_index` (`slug`);

--
-- Indexes for table `teacher_sections`
--
ALTER TABLE `teacher_sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_sections_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `video_gallery_items`
--
ALTER TABLE `video_gallery_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_gallery_items_video_gallery_section_id_foreign` (`video_gallery_section_id`);

--
-- Indexes for table `video_gallery_sections`
--
ALTER TABLE `video_gallery_sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `video_gallery_sections_slug_unique` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog_sections`
--
ALTER TABLE `blog_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_items`
--
ALTER TABLE `gallery_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gallery_sections`
--
ALTER TABLE `gallery_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `research_sections`
--
ALTER TABLE `research_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `research_topics`
--
ALTER TABLE `research_topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `teacher_sections`
--
ALTER TABLE `teacher_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_gallery_items`
--
ALTER TABLE `video_gallery_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `video_gallery_sections`
--
ALTER TABLE `video_gallery_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_blog_section_id_foreign` FOREIGN KEY (`blog_section_id`) REFERENCES `blog_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gallery_items`
--
ALTER TABLE `gallery_items`
  ADD CONSTRAINT `gallery_items_gallery_section_id_foreign` FOREIGN KEY (`gallery_section_id`) REFERENCES `gallery_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `research_topics`
--
ALTER TABLE `research_topics`
  ADD CONSTRAINT `research_topics_research_section_id_foreign` FOREIGN KEY (`research_section_id`) REFERENCES `research_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_teacher_section_id_foreign` FOREIGN KEY (`teacher_section_id`) REFERENCES `teacher_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `video_gallery_items`
--
ALTER TABLE `video_gallery_items`
  ADD CONSTRAINT `video_gallery_items_video_gallery_section_id_foreign` FOREIGN KEY (`video_gallery_section_id`) REFERENCES `video_gallery_sections` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
