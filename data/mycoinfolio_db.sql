-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-11-2021 a las 17:20:49
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mycoinfolio_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `analysis`
--

DROP TABLE IF EXISTS `analysis`;
CREATE TABLE IF NOT EXISTS `analysis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_33C73012469DE2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `analysis`
--

INSERT INTO `analysis` (`id`, `title`, `image`, `content`, `date`, `category_id`) VALUES
(1, 'XPR expect great upside', 'c25045ed38d8.png', 'asfdsgfdsgdsgdfagdfagdfga', '2021-10-28 10:13:37', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Technical');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `analysis_id` int(11) NOT NULL,
  `message` varchar(1500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CA76ED395` (`user_id`),
  KEY `IDX_9474526C7941003F` (`analysis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contain`
--

DROP TABLE IF EXISTS `contain`;
CREATE TABLE IF NOT EXISTS `contain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `crypto_id` int(11) NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4BEFF7C8E9571A63` (`crypto_id`),
  KEY `IDX_4BEFF7C8B96B5643` (`portfolio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contain`
--

INSERT INTO `contain` (`id`, `crypto_id`, `portfolio_id`) VALUES
(1, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crypto`
--

DROP TABLE IF EXISTS `crypto`;
CREATE TABLE IF NOT EXISTS `crypto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_price` double NOT NULL,
  `buy_date` datetime NOT NULL,
  `quantity` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `crypto`
--

INSERT INTO `crypto` (`id`, `name`, `entry_price`, `buy_date`, `quantity`) VALUES
(1, 'BTC', 215, '2016-06-08 00:00:00', 0.005),
(2, 'BTC', 215, '2017-05-14 00:00:00', 0.005),
(4, 'BTC', 215, '2021-06-18 00:00:00', 0.005);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20211007072452', '2021-10-07 07:25:20', 64),
('DoctrineMigrations\\Version20211008162415', '2021-10-08 16:24:30', 221),
('DoctrineMigrations\\Version20211026092122', '2021-10-27 15:37:32', 28),
('DoctrineMigrations\\Version20211026092952', '2021-10-27 16:04:49', 41),
('DoctrineMigrations\\Version20211026093117', '2021-10-27 16:06:03', 40),
('DoctrineMigrations\\Version20211026093309', '2021-10-27 16:06:29', 41),
('DoctrineMigrations\\Version20211027153426', '2021-10-27 16:08:39', 28),
('DoctrineMigrations\\Version20211027153603', '2021-10-27 16:08:39', 0),
('DoctrineMigrations\\Version20211027153636', '2021-10-27 16:08:39', 0),
('DoctrineMigrations\\Version20211027153724', '2021-10-27 16:08:39', 0),
('DoctrineMigrations\\Version20211027153759', '2021-10-27 16:08:39', 0),
('DoctrineMigrations\\Version20211027160328', '2021-10-27 16:08:39', 0),
('DoctrineMigrations\\Version20211027213308', '2021-10-28 07:29:44', 29),
('DoctrineMigrations\\Version20211027214834', '2021-10-28 07:29:44', 0),
('DoctrineMigrations\\Version20211027221701', '2021-10-28 07:29:44', 0),
('DoctrineMigrations\\Version20211027222046', '2021-10-28 07:29:44', 0),
('DoctrineMigrations\\Version20211028072130', '2021-10-28 07:29:44', 0),
('DoctrineMigrations\\Version20211028072400', '2021-10-28 07:29:44', 0),
('DoctrineMigrations\\Version20211028072940', '2021-10-28 07:31:41', 30),
('DoctrineMigrations\\Version20211028143803', '2021-10-28 14:39:54', 44),
('DoctrineMigrations\\Version20211028153252', '2021-10-28 15:33:52', 30),
('DoctrineMigrations\\Version20211029081009', '2021-10-29 08:10:46', 382);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portfolio`
--

DROP TABLE IF EXISTS `portfolio`;
CREATE TABLE IF NOT EXISTS `portfolio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `modified_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `total_price` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A9ED1062A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `portfolio`
--

INSERT INTO `portfolio` (`id`, `user_id`, `created_at`, `modified_at`, `total_price`) VALUES
(1, 6, '2021-10-28 14:43:09', NULL, NULL),
(2, 6, '2021-10-28 15:08:36', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `newsletter` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `created_at`, `modified_at`, `avatar`, `username`, `newsletter`) VALUES
(1, 'admin@admin.com', 'admin', '2021-05-13 00:00:00', '2021-05-13 00:00:00', 'nophoto.jpg', 'admin', 0),
(2, 'user@user.com', 'user', '2020-07-17 16:19:00', '2020-10-19 13:14:00', 'nophoto.jpg', 'user', 0),
(3, 'manager@manager.com', 'manager', '2016-01-01 00:00:00', '2019-07-14 10:11:00', 'nophoto.jpg', 'manager', 1),
(4, 'manager@manager.com', 'manager2', '2016-01-01 00:00:00', '2019-07-14 10:11:00', 'nophoto.jpg', 'manager2', 1),
(5, 'user@gmail.com', '$2y$13$lW2TECw7JkvJ3npKkLdXc.wXPB5/9CTzNT22rEc.n5r/y8pccC4h6', '2021-10-25 11:36:42', NULL, 'b65ec9c09d77.png', 'user', NULL),
(6, 'usuario@usuario.gmail.com', '$2y$13$nduGAXDHE/isNzsKpA2HS.RY/jvXsJFeqlby3scotitpKYIQ8FcpC', '2021-10-26 08:03:22', NULL, '1409a04b4102.png', 'Usuario', NULL),
(7, 'usuario@usuario.gmail.com', '$2y$13$OXNfmkRZxY8DG9P2tsph8e4s7ox8H3CzB9lnh7E7OURKb1kSsUy3S', '2021-10-26 08:06:16', NULL, '9b276ee23127.png', 'Usuario', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `analysis`
--
ALTER TABLE `analysis`
  ADD CONSTRAINT `FK_33C73012469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Filtros para la tabla `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C7941003F` FOREIGN KEY (`analysis_id`) REFERENCES `analysis` (`id`),
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `contain`
--
ALTER TABLE `contain`
  ADD CONSTRAINT `FK_4BEFF7C8B96B5643` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolio` (`id`),
  ADD CONSTRAINT `FK_4BEFF7C8E9571A63` FOREIGN KEY (`crypto_id`) REFERENCES `crypto` (`id`);

--
-- Filtros para la tabla `portfolio`
--
ALTER TABLE `portfolio`
  ADD CONSTRAINT `FK_A9ED1062A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
