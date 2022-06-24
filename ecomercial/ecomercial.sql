-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 07, 2018 at 08:35 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecomercial`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(1, 'Apple'),
(2, 'Samsung'),
(3, 'HTC'),
(4, 'HP'),
(5, 'Lenovo'),
(7, 'Others'),
(9, 'Google');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `items` text NOT NULL,
  `expire_date` datetime NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `items`, `expire_date`, `paid`) VALUES
(1, '[{\"id\":\"14\",\"Capacity\":\"16gib\",\"quantity\":\"2\"},{\"id\":\"18\",\"Capacity\":\"64Gig\",\"quantity\":2},{\"id\":\"1\",\"Capacity\":\"128\",\"quantity\":1}]', '2018-10-07 19:04:55', 1),
(2, '[{\"id\":\"1\",\"Capacity\":\"256\",\"quantity\":\"4\"},{\"id\":\"14\",\"Capacity\":\"16gib\",\"quantity\":\"4\"}]', '2018-10-07 20:05:47', 1),
(3, '[{\"id\":\"19\",\"Capacity\":\"16 gig\",\"quantity\":\"4\"},{\"id\":\"1\",\"Capacity\":\"256\",\"quantity\":\"2\"}]', '2018-10-07 20:24:37', 1),
(4, '[{\"id\":\"19\",\"Capacity\":\"16 gig\",\"quantity\":\"5\"},{\"id\":\"14\",\"Capacity\":\"16gib\",\"quantity\":\"2\"},{\"id\":\"12\",\"Capacity\":\"16\",\"quantity\":\"2\"}]', '2018-10-07 20:27:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent`) VALUES
(1, 'Phones', 0),
(2, 'Computer', 0),
(3, 'Tablets', 0),
(4, 'External Storage', 0),
(5, 'Apple', 1),
(6, 'Samsung', 1),
(7, 'Windows Phone', 1),
(8, 'Google', 1),
(9, 'Accessories', 1),
(10, 'Apple', 2),
(11, 'HP', 2),
(12, 'Toshiba', 2),
(13, 'Acer', 2),
(14, 'Lenovo', 2),
(15, 'Accessories', 2),
(16, 'Android', 3),
(17, 'IPad', 3),
(18, 'Windows', 3),
(19, 'Phone Call Tablets', 3),
(20, 'Accessories', 3),
(21, 'Hard Drive', 4),
(22, 'Blank Disks', 4),
(23, 'Memory Cards', 4),
(24, 'Usb flash drives', 4),
(25, 'Accessories', 4),
(32, 'HTC', 1),
(35, 'Network', 0),
(36, 'RJ45', 35);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `list_prices` decimal(10,0) NOT NULL,
  `brand` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `Capacity` text NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_prices`, `brand`, `categories`, `image`, `description`, `featured`, `Capacity`, `deleted`) VALUES
(1, 'IPhone X', '1100', '1200', 1, '5', '/ecomercial/images/products/IPhonex.png', 'Super Retina HD display\r\nHDR display\r\n2436-by-1125-pixel resolution at 458 ppi', 1, '8:4,16:5,32:3,64:5,128:2,256:4', 0),
(2, 'Samsung S8', '1000', '1200', 2, '6', '/ecomercial/images/products/SS8W.png', '4K video recording at 30 fps\r\n1080p HD video recording at 30 fps or 60 fps\r\n720p HD video recording at 30 fps\r\nVDIS (Video Digital Image Stabilization)', 1, '8:4,16:5,32:3,64:5,128:2,256:8', 0),
(12, 'HTC', '850', '1000', 4, '32', '/ecomercial/images/products/d81e9de6fa8b91dbcfe251dd56bc7c00.png', 'Brilliant HD screen\r\nExcellent build quality\r\nTop of line performance\r\nDecent battery back-up', 1, '16:2,32:1', 0),
(13, 'IPhone 8', '8000', '1000', 1, '5', '/ecomercial/images/products/863d77aa8b0c14d69d64ff46e48dd43a.png', 'LED-backlit IPS LCD, capacitive touchscreen, 16M colors\r\nSize	4.7 inches, 60.9 cm2 (~65.4% screen-to-body ratio)\r\nResolution: 750 x 1334 pixels, 16:9 ratio (~326 ppi density)\r\n', 1, '16gig:3,32gig:4,128gig:2', 0),
(14, 'Note 4', '1000', '5555', 2, '6', '/ecomercial/images/products/88ef28014e7e4a02031c502236364e25.jpg', 'Display5.70-inch.\r\nProcessor1.3GHz quad-core.\r\nFront Camera8-megapixel.\r\nResolution1080x1920 pixels.\r\nRAM3GB.\r\nOSAndroid 7.0.\r\nStorage32GB.\r\nRear Camera13-megapixel.', 1, '16gib:4,32gib:1', 0),
(15, 'Note 4', '1', '5555', 2, '6', '/ecomercial/images/products/ef8d621f7219befe320f83e5b91ac8a4.jpg', 'ghxfhgsdhgafdhgafshgfshgafghdfasgfdhgafdfg', 0, '16gib:4,32gib:1', 1),
(16, 'Note 4', '1', '5555', 2, '6', '/ecomercial/images/products/0b5afb5f2602a5f55bf6b34b5748171f.jpg', 'ghxfhgsdhgafdhgafshgfshgafghdfasgfdhgafdfg', 0, '16gib:4,32gib:1', 1),
(17, 'Note 4', '1', '5555', 2, '6', '/ecomercial/images/products/0c259ecfee63b9db97d1c7f718593000.jpg', 'ghxfhgsdhgafdhgafshgfshgafghdfasgfdhgafdfg', 0, '16gib:4,32gib:1', 1),
(18, 'J5', '4444', '5555', 2, '6', '/ecomercial/images/products/59365d798d2434bfc60f676d23f94e96.jpg', 'Add latter', 1, '64Gig:3', 0),
(19, 'Google Pixel', '3500', '3800', 9, '8', '/ecomercial/images/products/ed9439b89e5b38123f7959ebd07ade21.png', 'If you didn&#039;t like the Pixel 2 XL because of Google&#039;s phone philosophy, the Pixel 3 XL won&#039;t change your mind.', 1, '16 gig:7', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `charge_id` varchar(255) NOT NULL,
  `cart_id` int(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `street2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(175) NOT NULL,
  `country` varchar(175) NOT NULL,
  `zip_code` varchar(50) NOT NULL,
  `sub_total` decimal(10,0) NOT NULL,
  `tax` decimal(10,0) NOT NULL,
  `grand_total` decimal(10,0) NOT NULL,
  `description` text NOT NULL,
  `txn_type` varchar(255) NOT NULL,
  `txn_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `charge_id`, `cart_id`, `full_name`, `email`, `street`, `street2`, `city`, `state`, `country`, `zip_code`, `sub_total`, `tax`, `grand_total`, `description`, `txn_type`, `txn_date`) VALUES
(1, 'ch_1D7qWbB7Vja6t6RMpAIUJiGZ', 3, 'Andreceu Fernade', 'andre@gmail.com', 'camama2', 'Camama', 'Luanda', 'Luanda', 'Angola', '12345', '16200', '0', '16200', '6 items from ecomercial', 'charge', '2018-09-07 13:25:52'),
(2, 'ch_1D7qaJB7Vja6t6RMeK0xvLyk', 4, 'Pascal Joker', 'pascal@gmail.com', 'De willtreet', 'De witstreet House 2', 'Windhoek', 'Komas', 'Namibia', '32145', '21200', '0', '21200', '9 items from ecomercial', 'charge', '2018-09-07 13:29:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `permissions` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `join_date`, `last_login`, `permissions`) VALUES
(1, 'Melqui Vunge', 'melquilegend@gmail.com', '$2y$10$Di14a9Y0J2AUippc6cI4..x3c4l9MFIl.G0atZzIJs2s3wWkbIt7m', '2018-08-23 13:26:07', '2018-08-28 14:08:08', 'admin,editor'),
(10, 'Andreceu Fernade', 'andre@gmail.com', '$2y$10$4/qR3BC4Wzv8EM5ySLJP8ecfcLb9T0msYfnEeh/6GaMEexpLZ9XCW', '2018-08-28 05:43:49', '2018-08-28 14:06:47', 'editor'),
(9, 'Jozelino Rosa', 'jozelino@gamil.com', '$2y$10$M3qwgxWm.WbYKFwFg6CiLebN5.XZw9LuFPDxQfz6ytmtFuBpt9xia', '2018-08-28 05:40:30', '2018-08-28 12:42:19', 'editor');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
