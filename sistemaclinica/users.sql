-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 16, 2022 at 02:16 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinicasistema`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `position_clinic` varchar(255) NOT NULL,
  `cellphone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `especialidade` varchar(255) NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime DEFAULT NULL,
  `permissions` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `address`, `position_clinic`, `cellphone`, `email`, `password`, `about`, `especialidade`, `join_date`, `last_login`, `permissions`) VALUES
(14, 'Melqui Vunge', 'Camama', 'Administrador', '+244935651790', 'melqui.vunge@vepcom.net', '$2y$10$ItGiUYXrsXxFh2rfEpvvkepqKK9zKpJdvrXatdmw0uYuUwMHV6U7S', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 'IT', '2020-04-29 11:30:30', '2022-03-16 11:32:38', 'admin,editor'),
(18, 'Emanuel Augusto111', 'Calemba2', 'CEO', '+244935657102', 'eaugusto@vepcom.net', '$2y$10$/zethjKGdl9pVgl0WmyKxuX1R5Lk.8KClEqV4sQwCCtidgv.6GPa6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 'Financeiro', '2020-08-19 12:06:33', '2020-11-25 19:04:20', 'admin,editor'),
(20, 'Luis Gon&ccedil;alves', 'Calemba2', 'DR', '+244935657102', 'luis.goncalves@vepcom.net', '$2y$10$Aqu0iO3UXiL1rgQXq75bo.2kCXdJlLPfYeOfQr7KBFRuAmmv5QXiq', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 'Direção Geral', '2021-05-14 10:53:23', '2020-01-02 00:00:00', 'admin,editor'),
(21, 'gilgracio Licachi', 'Calemba 2, E street, House No.', 'Admnistrador', '924409799', 'gilgraciolicachi@gmail.com', '$2y$10$nthSY5IJJHuhqcY6v5GWv.1ghJRr5xUiMDZIl8ZyVPMtNZhUTruEu', 'Teste', 'IT', '2022-03-16 14:39:32', '2022-03-16 13:40:22', 'admin,editor');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
