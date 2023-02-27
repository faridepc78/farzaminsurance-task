-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 27, 2023 at 10:37 PM
-- Server version: 5.7.33
-- PHP Version: 8.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farzaminsurance-task`
--

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `files` json NOT NULL,
  `type` enum('image','video') COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base` enum('uploads','public','private') COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_folder` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vip_folder` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_storage` tinyint(1) NOT NULL DEFAULT '1',
  `is_private` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `files`, `type`, `filename`, `base`, `main_folder`, `vip_folder`, `is_storage`, `is_private`, `created_at`, `updated_at`) VALUES
(1, '{\"original\": \"products/images//zZKKIlArlPTDfqiCOBBrapLEXdY5XbxPzIw8TrkSgRO7ggS6xQ.png\"}', 'image', '1.png', 'uploads', 'products/images', NULL, 0, 0, '2023-02-27 22:36:11', '2023-02-27 22:36:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(123, '2012_05_29_095447_media', 1),
(124, '2014_10_12_000000_create_users_table', 1),
(125, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(126, '2023_02_26_215229_create_products_table', 1),
(127, '2023_02_26_215702_create_properties_table', 1),
(128, '2023_02_26_215745_create_product_properties_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'mahan@gmail.com_api_token', '5d99ccb271da376f67a7bd18980f13e842e56685bc204d648fe32cbe214e18e2', '[\"*\"]', '2023-02-27 22:36:32', '2023-02-27 22:35:37', '2023-02-27 22:36:32');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` double UNSIGNED NOT NULL,
  `discount` int(10) UNSIGNED DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `code`, `image_id`, `price`, `discount`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Miss Ava Pfeffer IV', 'et-qui-odio-sit-voluptatum-iure-ducimus-explicabo', 'dPk4xQNSNS', NULL, 187936, 60, 'Et nisi ullam totam in libero architecto quasi. Pariatur atque excepturi repellendus velit eligendi et labore molestias. Nam id ut eligendi optio. Culpa totam vel voluptatem deleniti ex vitae. Voluptatem sed et commodi explicabo magni. Sit numquam odit minus voluptas ratione est natus. Ut dolorum rerum laudantium quasi a. Ipsam et nobis iste fugit amet. Doloribus ex veniam sit voluptate numquam qui. Molestias tempore ex doloribus molestiae maxime. Autem ea et quae eius. Deleniti est id omnis. Inventore officiis nihil sint omnis et sed. Non pariatur corrupti hic accusantium dicta magnam. Aperiam necessitatibus rerum praesentium aperiam excepturi. Quidem quis molestiae enim autem. Iure libero autem voluptatem sint. Maxime odio accusamus ducimus consequatur cumque dolor. Voluptatem ipsam rerum vel perspiciatis debitis. Est ut consectetur sapiente dolor. Vel tenetur et error.', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(2, 'Ms. Theresia Bins MD', 'voluptate-placeat-aut-numquam-neque-dolores-nihil-sed', 'wZoUQGtM4s', NULL, 227130, 57, 'Qui blanditiis fuga aperiam temporibus enim. Quia culpa qui et officia. Aut maxime alias nisi harum molestiae est soluta. Iure sed sunt dolores alias quaerat. Omnis neque laudantium aspernatur. Ex vitae facilis laborum nobis animi odit qui. Earum soluta saepe eius omnis odio et sunt. Pariatur corrupti magni architecto amet laboriosam. Sunt magni architecto hic. Recusandae accusamus commodi quod non at aliquam quasi. Tempora hic sit beatae ipsam natus autem perspiciatis qui. Cum non fugiat ut dolores architecto est eos. Et iure impedit rem in. Sint autem amet facilis natus omnis non. Omnis dolor voluptatum consequatur. Ex et qui porro est. Reprehenderit non laboriosam dolor sequi omnis. Et ut hic sint optio labore officia corrupti quam. Blanditiis similique cum iure consequatur impedit. Voluptatum sit est quo quas. Ut iure dolorem eveniet. Deserunt possimus rem et. Cumque illo est vel eos. Facere ex doloribus voluptatem quas et minima aut.', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(3, 'Zander Kerluke', 'nesciunt-est-pariatur-labore-sint-possimus-qui-a', '5XHFMJg212', NULL, 504214, 54, 'Optio autem est veniam iste beatae. Vel odit voluptatem deserunt voluptate magni minima. Facere modi deleniti qui et adipisci. Et perferendis ex at sunt explicabo. Doloremque deserunt voluptatem esse aperiam et. Veniam maxime in ab sed et est tempore. Quibusdam reprehenderit occaecati labore sed ipsam odit. Saepe eum quia ad quis. Et consequatur ipsum ut sit magni quas totam. Atque qui non rerum quidem dolorem est eligendi voluptates. Distinctio ullam officia aut. Numquam non occaecati optio ratione iste consequuntur quisquam assumenda. Rerum illo cumque et fugiat nihil quaerat cupiditate. Eos aut quasi ipsam inventore esse autem. Modi qui ut veritatis voluptatem voluptatibus illo. Eum adipisci est rerum veniam accusamus natus. Ullam cum deserunt eos adipisci consequuntur et mollitia. Minima earum voluptas at eos. Quisquam quasi veritatis labore modi aut voluptas optio vitae.', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(4, 'Jailyn Runolfsdottir', 'omnis-velit-et-minus-assumenda-cum-dolorem-id', 'D69fEwnMcC', NULL, 694764, 20, 'Hic corporis eaque tempora non officiis id. Vero et esse maiores eaque. Qui recusandae doloribus molestiae qui ipsam qui minus. Qui consequatur voluptatibus quisquam qui. Molestiae incidunt quia delectus nisi unde voluptatibus. Sequi doloremque perferendis et non sit officiis. Et tempora molestiae optio totam est facilis molestiae. Iste voluptas quos voluptatum rem totam veritatis. Voluptatem distinctio autem ipsam nulla nam. Fugit iure qui quasi laboriosam natus. At ipsum nihil quas et vel aspernatur id. Velit commodi voluptas ea et vero amet sint. Voluptatibus non modi consectetur. Vero ut eius officiis illum consequatur. Placeat vel aliquam quod iure. Quis iusto voluptas perspiciatis fuga. Et omnis aperiam sunt consequatur eius. Porro quasi laboriosam consequatur possimus. Itaque deleniti laudantium reiciendis quaerat hic. Architecto qui voluptatem molestias mollitia non facere. Laudantium molestiae at autem eum.', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(5, 'Tatum Rempel', 'nesciunt-quia-sed-atque-eius-consequatur', 'DCE65gq8ov', NULL, 755695, 73, 'Similique vitae laborum ullam laborum quia ad voluptas. Quia odio mollitia corporis aperiam nostrum minus vel. Sit deleniti iusto dicta voluptatum et. Ab aut et molestiae molestias culpa possimus aut. Saepe dolor animi ipsam sunt. Voluptatem ut amet ab placeat error accusantium adipisci. Nihil quia illo autem in voluptatem dolores. Ut quam corporis rem rerum. Qui sequi fugiat facere voluptatibus in. Voluptatem iure ut sit suscipit. Voluptatum quis eum sapiente eum voluptatem quas quod illo. Nihil suscipit sint esse molestiae et tempora. Et quas sed atque nisi provident debitis. Sed repudiandae excepturi quaerat cum. Ut eligendi vero sit repellendus dolor quidem. Aut atque sed quia delectus iusto quia quis. At aut architecto iusto optio totam. Sit optio aut excepturi accusamus quos aliquam. Cum et consequatur accusamus est ex ab nulla. Vero voluptatem qui cum sit quaerat. At inventore distinctio veritatis dolores. Non dicta et est quibusdam inventore. Modi magnam non unde voluptatem.', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(6, 'Maritza Kilback', 'veniam-voluptate-repellendus-minus-veritatis-molestias-dolores', 'y20VG6unQv', NULL, 208898, 69, 'Fugit architecto debitis alias vero dicta placeat. Facere quae distinctio consequatur sunt. Sit qui deleniti eaque quos. Optio explicabo quos quis aut corporis. Sunt mollitia accusantium hic esse ut officiis ullam. Totam dolor officiis quis. Eaque temporibus et aperiam. Facere nostrum corrupti eveniet sunt commodi. Cumque rem odio in qui impedit ad laboriosam officia. Soluta aut mollitia odio temporibus id aut. Nihil nisi error optio aspernatur. Esse est dolorem aperiam. Et quasi enim iste aliquid quo porro dolorum. Quasi ea omnis voluptas ipsam similique dolorum atque. Quos rerum explicabo eaque laboriosam. Voluptates perferendis voluptas consequuntur sed odit praesentium temporibus. Excepturi molestiae explicabo praesentium quam tenetur dolorum voluptas. Repellat ut qui ut ea nihil. Possimus qui ut facilis. Consequuntur pariatur molestiae aliquid provident. Minima quidem accusamus sit. Corrupti iste harum iusto.', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(7, 'Forest Spinka', 'sit-repudiandae-alias-mollitia-tempore-fugiat-aut-consequatur-dicta', 'Mbswx420mg', NULL, 544464, 46, 'Dicta non qui sequi. Assumenda beatae veniam quo molestiae et aperiam placeat et. Deserunt saepe dolores reiciendis architecto a cupiditate beatae. Eos dolor voluptatem exercitationem. Corporis perferendis eum nesciunt rerum ex quisquam omnis. Totam incidunt omnis ut aut expedita debitis. Ut minima rem et est. Fugiat reiciendis accusantium quos aperiam et velit quo. Et eum placeat reprehenderit explicabo eligendi voluptatem. Quia magni repellat assumenda perferendis. Libero excepturi quaerat labore alias perspiciatis modi. Perferendis et officia error autem labore repellendus voluptatem sit. Beatae perferendis quisquam dolorem mollitia maiores. Blanditiis vel expedita incidunt quis itaque cupiditate. Omnis delectus voluptatum similique rerum dolores. Dolores et laboriosam voluptatum nam et architecto impedit. Quis sapiente voluptatem ut minus ut vel doloremque cum. Sed voluptates ut veniam officiis minus repudiandae quod.', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(8, 'Mrs. Hailee Jakubowski DDS', 'architecto-officiis-veniam-cum-nulla', 'ACkP0EQS9b', NULL, 960019, 3, 'Ipsa quas dolorum amet animi. Debitis dolore ab accusamus in atque tempora unde. Rerum dolorum et culpa tempore officiis aut numquam. Labore nemo quidem consequatur. Tempora accusamus quia enim distinctio nulla libero reiciendis. Rerum porro iure dolores. Dicta occaecati eius est non laboriosam eligendi vel. Beatae ducimus illo et repellendus. Et deleniti fugit rerum dolores repellat et enim assumenda. Commodi a a et nihil deserunt quis at. Aut laudantium eos officia reprehenderit excepturi nisi autem. Officiis assumenda pariatur autem ut dolor nihil. Porro consequatur nihil suscipit ullam. Earum quo ratione et fugit culpa maiores sed. Est deserunt laborum doloremque voluptas sed ipsam enim. Adipisci dolor est ea omnis sit earum autem. Error sed doloribus ut voluptatem sunt aut accusantium. Voluptas cupiditate incidunt distinctio quis et odio.', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(9, 'Prof. Loren Oberbrunner', 'alias-doloremque-debitis-ut-provident-aut', 'KZ6uxXqKAA', NULL, 926779, 35, 'Consectetur nobis et aut ex. Molestiae voluptas qui eligendi voluptatem qui cumque velit nesciunt. Repudiandae ab eum in est non officiis sit. Ut sit exercitationem minima rerum neque debitis. Non et eum et et quasi officia molestiae. Distinctio quibusdam velit cumque. Explicabo iusto autem enim aut quaerat nisi. Officia vel eum laboriosam sapiente non omnis facilis libero. Ea qui nemo eos aperiam distinctio asperiores sint. Qui odit laborum quidem accusamus neque iste dolores. Dolorum accusamus consectetur aut non. Deleniti itaque voluptas esse iusto dignissimos. Aut nostrum aut laudantium voluptas debitis. Perspiciatis voluptatem quia illum. Sit maxime a iure labore tempore architecto. Aut omnis error dolores autem. Quas laudantium eligendi amet tenetur. Dolor ducimus iure et voluptas illum iste quam magni. Ea sint labore corrupti deleniti doloribus odit. Nihil ut consequatur repellat dolores.', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(10, 'Delpha Torphy II', 'velit-perferendis-sunt-occaecati-voluptatem-laboriosam-ad-dicta-quod', '4BUJZDCRDT', NULL, 270247, 42, 'Inventore qui non aut velit dicta adipisci et qui. Et temporibus corporis quod cumque in. Soluta quam quaerat excepturi voluptas. Illo eum commodi aut odio id sed doloribus. Odio sunt quo et alias autem ratione ut. Nesciunt numquam quo ab voluptates sed eum maiores. Iusto voluptatem voluptas est. Ut quia omnis accusamus. Quos animi saepe qui et beatae. Et vel rerum et maxime assumenda ipsum rerum. Omnis inventore ratione deserunt quia. Ab quidem alias autem aut. Pariatur at totam cupiditate repellendus excepturi voluptas qui. Quia commodi sunt nostrum ea est quae sit. Esse quia neque magnam illum et porro odit. Quod assumenda esse sapiente repellendus aperiam. Neque sapiente voluptates quam earum molestiae voluptatum asperiores. Eveniet error necessitatibus veniam unde rem. Vero qui omnis nostrum debitis. Inventore ex dicta nam excepturi provident dolor.', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(11, 'test', 'test', 'MlmHF4ccGa', 1, 155656.63313, 20, 'this is test', '2023-02-27 22:36:11', '2023-02-27 22:36:11');

-- --------------------------------------------------------

--
-- Table structure for table `product_properties`
--

CREATE TABLE `product_properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_properties`
--

INSERT INTO `product_properties` (`id`, `product_id`, `property_id`) VALUES
(1, 11, 1),
(2, 11, 2),
(3, 11, 3),
(4, 11, 4),
(5, 11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Keaton Swaniawski', 'Katarina Veum', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(2, 'Mrs. Theresa Orn', 'Jodie Schumm', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(3, 'Emile Trantow', 'Thomas Braun', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(4, 'Mr. Mateo Pfeffer I', 'Jefferey Kuhlman', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(5, 'Louie Oberbrunner', 'Kaylie Swift DDS', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(6, 'Ms. Rachel Stokes DVM', 'Ms. Hertha Barton DDS', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(7, 'Prof. Dorcas Prosacco', 'Mrs. Tyra Davis', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(8, 'Queenie Jaskolski IV', 'Timothy Adams', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(9, 'Pamela Nolan', 'Destinee Lockman', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(10, 'Loraine Upton', 'Clarissa Stiedemann', '2023-02-27 22:35:24', '2023-02-27 22:35:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'mahan', 'mahan@gmail.com', '$2y$10$ZHdUE4C.b.NXoWmvlr6C8.iOT6m4Xfi1q.LkrcMQf0ShWFnhbgrFu', 'admin', '2023-02-27 22:35:23', '2023-02-27 22:35:23'),
(2, 'Savanah Ebert', 'alfreda.fritsch@example.org', '$2y$10$ZWdtOLVT7Qol4ZLb0A8rjuTmdQQzYa84AMs6omvgqOutvuKhlCVa6', 'user', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(3, 'Prof. Uriah Huels', 'chadrick.kemmer@example.net', '$2y$10$LnrLECrBfRMxrrytaF1txui0oZzc0LXvHug4.wxm.avcOlmrhwnD.', 'user', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(4, 'Jerel Mraz Jr.', 'benjamin85@example.org', '$2y$10$5xxcKmBRqizIMG/IQ1DSD.fAuBVTgEQPwQOchVhNnYKUxFZHC8O2C', 'user', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(5, 'Dr. Kay Berge MD', 'pbins@example.net', '$2y$10$IMlxa4P3StFQgwd/r5M6K.zP4hXAuQAh2jbc0QdzB/Xhu/AXjfKsC', 'user', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(6, 'Prof. Tressie Blanda Jr.', 'jwest@example.net', '$2y$10$QNjg/Ho.cWTex3CNdUNxHOtWC.e5A9SovCTD9fqtoBiNOC3DiY4PK', 'user', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(7, 'Dr. Joaquin Pagac', 'predovic.reyna@example.net', '$2y$10$Nr4FNclgWtgenM9Cf5y0nOID/GGoVZZ/YnzjmIyjfkWXSlOnYu0K6', 'user', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(8, 'Augustus Denesik MD', 'bettye42@example.com', '$2y$10$w9MMYnVnmjBGEqyKlDjlfOsm0jqmAAhYWQVx6ZJnt.5YuYG.Rg1YS', 'user', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(9, 'Leonel Hermann I', 'arvid.pagac@example.net', '$2y$10$ntthafnlcf0Si6EvoM6QeOHZLMAuDHfxyrNhsqF8WmV87WviMq.EC', 'user', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(10, 'Boyd Hermann Jr.', 'eflatley@example.com', '$2y$10$oacIE/VxYEtkbwujjRYSg.dDQLpCtSfPQJZpU/Q5TO2z7jPYxkpGS', 'user', '2023-02-27 22:35:24', '2023-02-27 22:35:24'),
(11, 'Dr. Emmett Leannon Jr.', 'hayes.beaulah@example.net', '$2y$10$ZY.3h9jKck2zBo0KYTVV.uW7k4ipP0X4i8cy0.fxotyHFxd0e3wPG', 'user', '2023-02-27 22:35:24', '2023-02-27 22:35:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_code_unique` (`code`),
  ADD KEY `products_image_id_foreign` (`image_id`);

--
-- Indexes for table `product_properties`
--
ALTER TABLE `product_properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_properties_product_id_foreign` (`product_id`),
  ADD KEY `product_properties_property_id_foreign` (`property_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `properties_name_unique` (`name`),
  ADD UNIQUE KEY `properties_value_unique` (`value`);

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
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_properties`
--
ALTER TABLE `product_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `media` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product_properties`
--
ALTER TABLE `product_properties`
  ADD CONSTRAINT `product_properties_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_properties_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
