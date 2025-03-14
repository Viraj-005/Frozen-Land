-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2023 at 11:03 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flice_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '111'),
(2, 'Sangeeth', '123'),
(3, 'Shamika', 'Sha#3'),
(4, 'Sahil', 'Sahil#66');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `number`, `email`, `message`) VALUES
(1, 1, 'Viraj', '0755415575', 'viraj2@gmail.com', 'Very good platform'),
(2, 1, 'viraj', '0755415575', 'viraj2@gmail.com', 'I like sundaes'),
(3, 7, 'Walle', '0718596352', 'walle87@gmail.com', 'I\'m enjoying the site'),
(4, 2, 'Sahil', '0753552064', 'Sahil6@gmail.com', 'Wow amazing products. I love this ice Creams'),
(6, 8, 'VRJ', '0798563125', 'vrj252@gmail.com', 'Superb products!'),
(7, 8, 'VRJ', '0798563125', 'vrj252@gmail.com', 'Good service'),
(8, 8, 'VRJ', '0798563125', 'vrj252@gmail.com', 'woow'),
(9, 8, 'VRJ', '0798563125', 'vrj252@gmail.com', 'I love this Site\r\n'),
(10, 9, 'Shaggy', '0789632542', 'shaggy56@gmail.com', 'I am big fan of your shop');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(6, 1, 'Viraj', '0755415575', 'cash on delivery', 'No.10/30, Aluthwatta,, Wattalpola, Panadura - 12500', 'Pebbles Choco (700 x 2 ) - Vanila Ice Cream (200 x 2 ) - ', 1800, '2023-06-11', 'completed'),
(7, 2, 'Sahil', '0753552064', 'cash on delivery', 'No.10/30, Aluthwatta,, Wattalpola, Panadura - 12500', 'Fancy Special 4 Packs (1500 x 1 ) - Baby Yoda Cone (350 x 1 ) - Vanila Ice Cream (200 x 1 ) - ', 2050, '2023-06-11', 'completed'),
(17, 2, 'shamika', '0753552064', 'cash on delivery', 'No.10/20, Aluthwaththa, panadura - 12500', 'Vanila Bean (200 x 12 ) - ', 2400, '2023-06-13', 'completed'),
(18, 5, 'Redmi', '0755415575', 'cash on delivery', 'No.56/32, Aluthmwtha,, Bakamuna rd, Walana - 12635', 'Birthday Cake Sundae (700 x 1 ) - Caramel Churro Cone  (250 x 1 ) - Baby Yoda Cone (250 x 1 ) - Strawberry Banana (300 x 1 ) - Double Decker Hot Chocolate Plate (500 x 2 ) - Handsome 4 Sticks (500 x 1 ) - ', 3000, '2023-06-15', 'completed'),
(19, 6, 'Indu', '0724415575', 'helapay', 'No.10/30, Aluthwatta, Dodangaha rd, Kalutara - 12466', 'Caramel Truffle Sundae (650 x 1 ) - Peanut Cluster Fudge (300 x 1 ) - Double Decker Hot Chocolate Plate (500 x 1 ) - Salted Caramel Truffle Cone (250 x 1 ) - Double Dip Cone (200 x 2 ) - ', 2100, '2023-06-15', 'completed'),
(20, 1, 'Viraj Piumal', '0755415575', 'cash on delivery', 'No.10/30, Aluthwatta, , Wattalpola, Panadura - 12500', 'peach triple berry sundae (600 x 1 ) - Cherry Limeade (300 x 1 ) - ', 900, '2023-06-21', 'completed'),
(21, 7, 'Walle', '0718596352', 'cash on delivery', 'No.21/56, Makubukoya,, dolewatta, morgahahandiya - 12596', 'Valentine Couple Cone (400 x 1 ) - ', 400, '2023-06-23', 'completed'),
(22, 7, 'Walle', '0718596352', 'debit card', 'No.21/56, Makubukoya,, dolewatta, morgahahandiya - 12596', 'Birthday Cake Sundae (750 x 1 ) - Red Velvet Brownie Sundae (500 x 1 ) - Valentine couple cone (400 x 1 ) - ', 1650, '2023-06-28', 'completed'),
(23, 1, 'Viraj Piumal', '0755415575', 'cash on delivery', 'No.10/30, Aluthwatta,, Wattalpola, Panadura - 12500', 'Cherry Limeade (300 x 1 ) - Birthday Cake Sundae (750 x 2 ) - ', 1800, '2023-06-30', 'completed'),
(24, 1, 'viraj', '0755415575', 'cash on delivery', 'No.10/30, Aluthwatta,, Wattalpola, Panadura - 12500', 'Brownie Fudge (600 x 2 ) - Vanila Ice Cream (200 x 2 ) - ', 1600, '2023-07-10', 'completed'),
(25, 8, 'VRJ', '0798563125', 'cash on delivery', 'No.20/15, Haragasmulla,, Keselwatta - 12510', 'Birthday Cake Sundae (700 x 2 ) - Cherry Limeade (300 x 3 ) - Peach (200 x 1 ) - Chocolate Ice Cream (270 x 1 ) - Peanut Cluster Fudge (300 x 1 ) - Valentine couple cone (400 x 2 ) - Double Decker Hot Chocolate Plate (500 x 1 ) - ', 4370, '2023-09-15', 'completed'),
(26, 8, 'VRJ', '0798563125', 'cash on delivery', 'No.20/15, Haragasmulla, Keselwatta - 12510', 'Brownie Fudge (650 x 3 ) - peach triple berry sundae (600 x 1 ) - Pomegranate (200 x 1 ) - Vanila Ice Cream (200 x 1 ) - ', 2950, '2023-09-16', 'completed'),
(27, 8, 'VRJ', '0798563125', 'cash on delivery', 'No.20/15, Haragasmulla, Keselwatta - 12510', 'Birthday Cake Sundae (700 x 1 ) - Cocoa Banana (700 x 1 ) - Valentine couple cone (400 x 1 ) - Strawberry Banana (300 x 1 ) - ', 2100, '2023-09-16', 'completed'),
(28, 8, 'VRJ', '0798563125', 'cash on delivery', 'No.20/15, Haragasmulla, Keselwatta - 12510', 'Caramel Truffle Sundae (750 x 2 ) - Pani kadju cone (250 x 1 ) - Peppermint Chocolate Chip (300 x 1 ) - ', 2050, '2023-09-17', 'completed'),
(29, 8, 'VRJ', '0798563125', 'cash on delivery', 'No.20/15, Haragasmulla, Keselwatta - 12510', 'Birthday Cake Sundae (700 x 2 ) - Baby yoda cone (250 x 1 ) - Vanila Bean (300 x 1 ) - peach triple berry sundae (600 x 1 ) - ', 2550, '2023-09-22', 'completed'),
(30, 9, 'Shaggy', '0789632542', 'cash on delivery', 'No.20/15, Ragamala, Keselwatta - 12510', 'Birthday Cake Sundae (700 x 1 ) - Red Raspberry (200 x 1 ) - Pistachio Almond (300 x 1 ) - Vanila Ice Cream (200 x 3 ) - ', 1800, '2023-09-23', 'completed'),
(31, 9, 'Shaggy', '0789632542', 'cash on delivery', 'No.20/15, Ragamala, Keselwatta - 12510', 'French Chocolate Macaroon (650 x 1 ) - Strawberry Cone (200 x 2 ) - Butterscotch (300 x 2 ) - ', 1650, '2023-09-27', 'completed'),
(34, 9, 'Shaggy', '0789632542', 'cash on delivery', 'No.20/15, Ragamala, Keselwatta - 12510', 'French Chocolate Macaroon (650 x 1 ) - Strawberry Cone (200 x 2 ) - Butterscotch (300 x 1 ) - ', 1350, '2023-09-27', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`) VALUES
(2, 'Vanila Ice Cream', 'Flavors', 200, 'realprod13.png'),
(3, 'Chocolate Ice Cream', 'Flavors', 250, 'nosugar3.jpeg'),
(4, 'Red Velvet Brownie Sundae', 'Sundaes', 550, 'realprod41.jpg'),
(5, 'Brownie Fudge', 'Sundaes', 600, 'realprod34.jpg'),
(7, 'Rainbow Sherbet', 'Sherbet', 200, 'sherb2.jpeg'),
(9, 'Green Tea Ice Plate', 'Fancy', 550, 'gallery2.jpg'),
(10, 'Vanila Bean', 'No-sugar added', 300, 'nosugar.jpeg'),
(12, 'Cocoa Banana', 'Sundaes', 650, 'realprod29.jpg'),
(13, 'Birthday Cake Sundae', 'Sundaes', 700, 'realprod35.jpg'),
(14, 'Caramel Truffle Sundae', 'Sundaes', 750, 'realprod38.jpg'),
(15, 'French Chocolate Macaroon', 'Sundaes', 650, 'realprod31.jpg'),
(16, 'Salted Caramel Truffle Cone', 'Icecones', 250, 'realprodp44.jpeg'),
(17, 'Caramel Churro Cone ', 'Icecones', 250, 'realprodp45.jpeg'),
(20, 'Double Dip Cone', 'Icecones', 200, 'realprod36.jpg'),
(21, 'Strawberry Cone', 'Icecones', 200, 'realprod24.jpg'),
(22, 'Choco Vanila Cone', 'Icecones', 200, 'realprodp43.jpeg'),
(24, 'Cherry Limeade', 'Sherbet', 300, 'realprod46.png'),
(25, 'Peach', 'Sherbet', 200, 'realprod48.png'),
(26, 'Sicilian Orange', 'Sherbet', 300, 'realprod49.png'),
(27, 'Pomegranate', 'Sherbet', 200, 'realprod47.png'),
(29, 'Red Raspberry', 'Sherbet', 200, 'realprod50.png'),
(30, 'Butterscotch', 'Flavors', 300, 'realprod12.png'),
(31, 'Strawberry Banana', 'Flavors', 350, 'realprod14.png'),
(32, 'Peppermint Chocolate Chip', 'Flavors', 300, 'realprod15.png'),
(33, 'Cherry Chunky Chocolate', 'Flavors', 300, 'realprod11.png'),
(34, 'Pistachio Almond', 'No-sugar added', 300, 'realprod52.png'),
(35, 'Cherries, Pecans & Cream', 'No-sugar added', 300, 'realprod51.png'),
(36, 'Chocolate Almond', 'No-sugar added', 300, 'realprod54.png'),
(37, 'Peanut Cluster Fudge', 'No-sugar added', 300, 'realprod53.png'),
(38, 'Chocolate Pecan', 'No-sugar added', 300, 'realprod55.png'),
(39, 'Double Decker Hot Chocolate Plate', 'Fancy', 500, 'gallery1.jpg'),
(41, 'Handsome 4 Sticks', 'Fancy', 500, 'gallery5.jpg'),
(43, 'peach triple berry sundae', 'Sundaes', 600, 'realprod16.jpg'),
(47, 'Baby yoda cone', 'Icecones', 250, 'realprodpss39.jpg'),
(48, 'Pani kadju cone', 'Icecones', 250, 'chocopea.jpg'),
(49, 'Valentine couple cone', 'Icecones', 400, 'realprod56.jpg'),
(53, 'Sticky bun sundae', 'Sundaes', 600, 'realprod60.jpg'),
(58, 'Turtle Sundae', 'Sundaes', 650, 'realprod59.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Viraj', 'viraj2@gmail.com', 'Viraj#2'),
(2, 'Sahil', 'Sahil6@gmail.com', 'Sahil#6'),
(3, 'Sangeeth', 'san5@gmail.com', 'Sang#10'),
(4, 'Shamika', 'Shamika3@gmail.com', 'Shamika#3'),
(5, 'Redmi', 'Redmi9pro@gmail.com', 'Redmi#9Pro'),
(6, 'Indu', 'induruwa3@gmail.com', 'Indu#3'),
(7, 'Walle', 'walle87@gmail.com', 'walle#87'),
(8, 'VRJ', 'vrj252@gmail.com', 'Vrj#252'),
(9, 'Shaggy', 'shaggy56@gmail.com', 'shaggy#56'),
(10, 'Sansing', 'sansin2@gmail.com', 'sansin#263');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
