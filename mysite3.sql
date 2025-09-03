-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 04 2025 г., 00:03
-- Версия сервера: 5.7.39
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mysite3`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Comments`
--

CREATE TABLE `Comments` (
  `id` bigint(20) NOT NULL,
  `IdPost` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Comments`
--

INSERT INTO `Comments` (`id`, `IdPost`, `userid`, `comment`, `created_at`, `updated_at`) VALUES
(11, 10, 10, 'Запись 1', '2025-06-27 21:10:32', '2025-06-27 21:10:32'),
(12, 10, 10, 'Запись 2', '2025-06-27 21:10:40', '2025-06-27 21:10:40'),
(13, 10, 10, 'Запись 3', '2025-06-27 21:10:49', '2025-06-27 21:10:49'),
(14, 10, 10, 'Запись 4', '2025-06-27 21:11:01', '2025-06-27 21:11:01'),
(15, 11, 10, '123133', '2025-07-24 19:41:32', '2025-07-24 19:41:32'),
(16, 11, 14, 'хахаха', '2025-08-19 06:14:29', '2025-08-19 06:14:29'),
(17, 63, 10, 'ввпвп', '2025-08-26 17:57:22', '2025-08-26 17:57:22');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_05_05_224255_create_posts_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `perm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postimg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tags` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `userid`, `caption`, `content`, `perm`, `postimg`, `created_at`, `updated_at`, `tags`, `latitude`, `longitude`, `cost`) VALUES
(10, 11, 'Привет', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'byrequest', 'postimages/10.png', '2025-05-06 21:25:13', '2025-05-06 21:25:13', NULL, '', '', NULL),
(11, 10, 'scscscscsczc', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'public', 'postimages/default.png', '2025-05-06 21:29:21', '2025-08-17 13:44:57', 'прогулка', '', '', NULL),
(29, 10, 'Пост только подписчкам', 'Только', 'byrequest', 'postimages/default.png', '2025-06-28 17:40:25', '2025-08-17 12:51:46', 'программирование учеба работа', '', '', NULL),
(31, 10, 'Пост доступен всем', 'И так', 'public', 'postimages/default.png', '2025-06-28 17:43:32', '2025-06-28 18:19:51', 'программирование', '', '', NULL),
(32, 14, 'Демо пост', 'Все круто!!!!', 'public', 'postimages/default.png', '2025-08-06 09:04:23', '2025-08-17 14:03:21', 'природа отдых отпуск', '', '', NULL),
(33, 14, 'Пост только подписчкам', 'реарареа', 'byrequest', 'postimages/default.png', '2025-08-17 15:50:16', '2025-08-17 15:50:16', 'отдых', '', '', NULL),
(34, 14, 'scscscscsczc', 'рерарараерарцкцец', 'public', 'postimages/default.png', '2025-08-17 15:50:31', '2025-08-17 15:50:31', 'отдых', '', '', NULL),
(35, 14, '142424', 'пвпвпк', 'public', 'postimages/default.png', '2025-08-17 15:50:51', '2025-08-17 15:50:51', 'природа', '', '', NULL),
(36, 14, '142424', 'kokokokokokokoko', 'public', 'postimages/default.png', '2025-08-17 16:00:47', '2025-08-21 14:01:28', 'отдых', '', '', NULL),
(37, 10, 'Пост только подписчкам', 'dadadawdadwawdwa', 'public', 'postimages/default.png', '2025-08-20 14:56:01', '2025-08-20 14:56:01', 'природа отдых отпуск', '', '', NULL),
(38, 10, 'Пост только подписчкам', 'sfsfsefesfsefsefe', 'public', 'postimages/default.png', '2025-08-20 14:57:36', '2025-08-20 14:57:36', 'программирование учеба', '', '', NULL),
(48, 10, 'Пост только подписчкам', 'fsfsefsef', 'public', 'postimages/48.png', '2025-08-20 15:58:44', '2025-08-20 15:58:44', 'природа', '', '', NULL),
(49, 10, 'sczsczsc', 'sczcs', 'public', 'postimages/49.png', '2025-08-20 16:02:46', '2025-08-20 16:02:46', 'природа', '', '', NULL),
(50, 10, 'fsfsfsf', 'sfsfs', 'public', 'postimages/50.png', '2025-08-20 16:07:15', '2025-08-20 16:07:15', 'отдых', '', '', NULL),
(51, 10, 'dadwadwd', 'dawdwadawd', 'public', 'postimages/51.png', '2025-08-20 16:31:54', '2025-08-20 16:31:54', 'природаdawd', '', '', NULL),
(52, 10, 'czsczscs', 'sczscs', 'public', 'postimages/52.jpg', '2025-08-20 16:33:52', '2025-08-20 16:33:52', 'природа', '', '', NULL),
(53, 10, 'Пост только подписчкам', 'kooio', 'public', 'postimages/53.png', '2025-08-20 16:41:19', '2025-08-20 16:41:37', 'природа', '', '', NULL),
(54, 10, 'csccscszc', 'sczscs', 'public', 'postimages/54.png', '2025-08-20 17:11:33', '2025-08-20 17:11:33', 'природа', '', '', NULL),
(55, 10, 'cscsrwrwrwdw', 'dwdwd', 'public', 'postimages/55.png', '2025-08-20 17:12:45', '2025-08-20 17:12:45', 'природа', '', '', NULL),
(56, 10, 'rwrwrwrw', 'rwrwrw', 'public', 'postimages/56.png', '2025-08-20 17:46:31', '2025-08-20 17:46:32', 'природа', '', '', NULL),
(57, 10, 'scscsc', 'scscs', 'public', 'postimages/57.png', '2025-08-20 17:49:18', '2025-08-20 17:49:18', 'природа', '', '', NULL),
(58, 10, 'sfsfsfs', 'dvdvd', 'public', 'postimages/58.jpg', '2025-08-20 17:53:57', '2025-08-20 17:53:58', 'dvd', '', '', NULL),
(59, 10, 'axaxaxa', 'xaaxaxa', 'public', 'postimages/59.jpg', '2025-08-20 18:10:39', '2025-08-20 18:17:34', 'природаaxax', '', '', NULL),
(60, 10, 'axaxaxa', 'xaaxaxa', 'public', 'postimages/60.png', '2025-08-20 18:12:11', '2025-08-20 18:15:54', 'природаaxax', '', '', NULL),
(61, 10, 'axaxaxa', 'xaxaxaxax', 'public', 'postimages/61.jpg', '2025-08-20 18:14:49', '2025-08-20 18:14:49', 'природа', '', '', NULL),
(62, 10, 'аыыпыпыпы', 'пвпвпвпвпвпвпв', 'public', 'postimages/62.jpg', '2025-08-21 14:09:24', '2025-08-21 14:09:25', 'программирование', '', '', NULL),
(63, 10, 'Астрахань', 'выываыаыа', NULL, 'postimages/default.png', '2025-08-26 17:42:41', '2025-08-26 17:42:41', 'позиция', '46.55364029070763', '48.01389689085077', NULL),
(64, 10, 'Новый пост', 'аыаывавыаыва', NULL, '', '2025-08-26 18:42:26', '2025-08-26 18:42:26', 'позиция', NULL, NULL, NULL),
(65, 10, 'Новый пост', 'аыаывавыаыва', NULL, '', '2025-08-26 18:47:56', '2025-08-26 18:47:56', 'позиция', NULL, NULL, NULL),
(66, 10, 'Новый пост', 'аыаывавыаыва', NULL, 'postimages/default.png', '2025-08-26 18:48:59', '2025-08-26 18:48:59', 'позиция', NULL, NULL, NULL),
(67, 10, 'Новый пост 2', 'efsfsef', NULL, '', '2025-08-26 18:59:30', '2025-08-26 18:59:30', 'sfsfsef', NULL, NULL, NULL),
(68, 10, 'Новый пост 2', 'efsfsef', NULL, '', '2025-08-26 19:01:03', '2025-08-26 19:01:03', 'sfsfsef', NULL, NULL, NULL),
(69, 10, 'Новый пост 2', 'efsfsef', NULL, 'postimages/default.png', '2025-08-26 19:02:47', '2025-08-26 19:02:47', 'sfsfsef', NULL, NULL, NULL),
(70, 10, 'Астрахань', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'public', 'postimages/70.jpg', '2025-08-27 17:30:25', '2025-08-27 18:06:26', 'dsdsds', NULL, NULL, NULL),
(71, 10, 'Новый пост 3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, 'postimages/71.jpg', '2025-08-27 18:09:16', '2025-08-27 19:37:44', 'lorem', '37.97190844576863', '58.24715754394525', '1000-1500 USD');

-- --------------------------------------------------------

--
-- Структура таблицы `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `postid` bigint(20) UNSIGNED NOT NULL,
  `slide` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sliders`
--

INSERT INTO `sliders` (`id`, `postid`, `slide`, `description`, `created_at`, `updated_at`) VALUES
(2, 69, 'slides/69_0.jpg', 'sdsdsd', '2025-08-26 19:02:47', '2025-08-26 19:02:47'),
(3, 70, 'slides/70_0.jpg', 'ssdsdsdsd', '2025-08-27 17:30:25', '2025-08-27 17:30:25'),
(4, 70, 'slides/70_1.jpg', 'sdsdsd', '2025-08-27 17:30:25', '2025-08-27 17:30:25'),
(5, 71, 'slides/71_0.jpg', 'Схема', '2025-08-27 18:09:16', '2025-08-27 18:09:16'),
(6, 71, 'slides/71_1.png', 'Хаза', '2025-08-27 18:09:16', '2025-08-27 18:09:16');

-- --------------------------------------------------------

--
-- Структура таблицы `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscriberid` bigint(20) UNSIGNED NOT NULL,
  `hosterid` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `subscribers`
--

INSERT INTO `subscribers` (`id`, `subscriberid`, `hosterid`, `created_at`, `updated_at`) VALUES
(3, 10, 14, '2025-08-23 22:59:22', '2025-08-23 22:59:22'),
(4, 14, 10, '2025-08-23 23:06:34', '2025-08-23 23:06:34');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aboutme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favorite_tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `img`, `aboutme`, `favorite_tags`) VALUES
(10, 'Анастасия', 'demo@yandex.ru', NULL, '$2y$10$nvfZVPN84mK8CRDSPSwKL.CioW5I2NqIt0VV/HdASLf8njavbxrDG', 'HeLXsd8S1Tao1NpXqVir2TnVjMkz3DAuk1qQ9PrP3ZDArAuag9HSUwX3ocQO', '2025-05-04 15:18:06', '2025-08-22 22:53:00', 'postimages/60.png', 'Я молодая красивая девушка занимаюсь поэзией люблю путешествовать', NULL),
(11, 'Антоха', 'demo@mail.ru', NULL, '$2y$10$QoTtXGGdGEJieJ2QMYoPeeSgPaLp64MrI1oqwkDr2/aPUPc1qeT/W', NULL, '2025-05-04 15:27:35', '2025-05-04 15:27:35', NULL, NULL, NULL),
(12, 'Анна', 'demox@yandex.ru', NULL, '$2y$10$v6xKu1HVgjLtUSM9HLWi/eAP5X2SkB22CLu1UBV94La6RdlWQtuIm', NULL, '2025-05-04 18:02:20', '2025-05-04 18:02:20', NULL, NULL, NULL),
(13, 'Zeroweb', 'demo@mail.com', NULL, '$2y$10$bDf9Z7Wv/WjYxxXVkVrLr.PMZ6q9vos9zKGbsfnzFZBUzy26F94p.', NULL, '2025-05-04 18:17:53', '2025-05-04 18:17:53', NULL, NULL, NULL),
(14, 'Иван', 'ivan@mail.ru', NULL, '$2y$10$9DsB9vd8OPUK1XZ7.XHbhOtyhd7Pbt4nrPPSVR6pSFY8rQAr62xLi', 'bFjmrnBlVUGV7d196QSPSzezsahyhHxKCpcoRJsmlj4cdTQPA4mdDjVjZkSN', '2025-06-28 18:26:44', '2025-08-23 22:27:39', 'postimages/user14.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `usersrequests`
--

CREATE TABLE `usersrequests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `senderid` bigint(20) UNSIGNED NOT NULL,
  `hosterid` bigint(20) UNSIGNED NOT NULL,
  `hosterack` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hostercanceled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `usersrequests`
--

INSERT INTO `usersrequests` (`id`, `senderid`, `hosterid`, `hosterack`, `created_at`, `updated_at`, `hostercanceled`) VALUES
(1, 10, 14, 0, '2025-08-17 12:44:20', '2025-08-17 13:49:13', 0),
(3, 14, 10, 0, '2025-08-17 12:54:04', '2025-08-17 12:56:19', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_comments_posts` (`IdPost`),
  ADD KEY `FK_comments_users` (`userid`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_post_users` (`userid`);

--
-- Индексы таблицы `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_sliders_posts` (`postid`);

--
-- Индексы таблицы `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_subscribers_users` (`subscriberid`),
  ADD KEY `FK_subscribers_users_2` (`hosterid`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `usersrequests`
--
ALTER TABLE `usersrequests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_senderid_users` (`senderid`),
  ADD KEY `FK_hosterid_users` (`hosterid`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT для таблицы `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `usersrequests`
--
ALTER TABLE `usersrequests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `FK_comments_posts` FOREIGN KEY (`IdPost`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_comments_users` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_post_users` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `FK_sliders_posts` FOREIGN KEY (`postid`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `subscribers`
--
ALTER TABLE `subscribers`
  ADD CONSTRAINT `FK_subscribers_users` FOREIGN KEY (`subscriberid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_subscribers_users_2` FOREIGN KEY (`hosterid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `usersrequests`
--
ALTER TABLE `usersrequests`
  ADD CONSTRAINT `FK_hosterid_users` FOREIGN KEY (`hosterid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_senderid_users` FOREIGN KEY (`senderid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
