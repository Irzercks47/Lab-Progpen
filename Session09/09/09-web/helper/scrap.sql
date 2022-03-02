-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2021 at 04:39 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pph4bp`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_image`) VALUES
(1, 'Coconut - Creamed, Pure', 12, 'prod1.png'),
(2, 'Chips Potato Swt Chilli Sour', 19, 'prod2.png'),
(3, 'Tart Shells - Sweet, 3', 71, 'prod3.png'),
(4, 'Bag Clear 10 Lb', 65, 'prod1.png'),
(5, 'Foil Wrap', 100, 'prod2.png'),
(6, 'Flour - Bran, Red', 36, 'prod3.png'),
(7, 'Tomatoes - Heirloom', 10, 'prod1.png'),
(8, 'Bar Mix - Lemon', 56, 'prod2.png'),
(9, 'Pastry - Lemon Danish - Mini', 61, 'prod3.png'),
(10, 'Beer - Mill St Organic', 83, 'prod1.png'),
(11, 'Muffin Mix - Carrot', 79, 'prod2.png'),
(12, 'Mustard - Seed', 50, 'prod3.png'),
(13, 'Energy Drink Bawls', 53, 'prod1.png'),
(14, 'Cornstarch', 64, 'prod2.png'),
(15, 'Cumin - Ground', 93, 'prod3.png'),
(16, 'Eggplant Italian', 87, 'prod1.png'),
(17, 'Salmon Steak - Cohoe 8 Oz', 62, 'prod2.png'),
(18, 'Wine - Hardys Bankside Shiraz', 50, 'prod3.png'),
(19, 'Soup - Canadian Pea, Dry Mix', 89, 'prod1.png'),
(20, 'Pasta - Cheese / Spinach Bauletti', 32, 'prod2.png'),
(21, 'Syrup - Monin - Blue Curacao', 57, 'prod3.png'),
(22, 'Beer - True North Strong Ale', 53, 'prod1.png'),
(23, 'Bread - White, Sliced', 71, 'prod2.png'),
(24, 'Plastic Wrap', 88, 'prod3.png'),
(25, 'Pie Filling - Cherry', 54, 'prod1.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
