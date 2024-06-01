-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 02:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `price`) VALUES
(1, 'Lol', 0, 100.00),
(2, 'try', 0, 21.00),
(3, '23', 0, 12.00),
(4, 'Bottle', 2, 23.00);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('completed','cancelled') DEFAULT 'completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `user_id`, `quantity`, `total_price`, `date`, `status`) VALUES
(1, 1, 1, 1, 100.00, '2024-05-31 13:09:36', 'cancelled'),
(2, 1, 1, 1, 100.00, '2024-05-31 13:09:43', 'cancelled'),
(3, 2, 1, 1, 21.00, '2024-05-31 14:32:55', 'cancelled'),
(4, 2, 1, 1, 21.00, '2024-05-31 14:33:51', 'cancelled'),
(5, 2, 1, 1, 21.00, '2024-05-31 14:47:02', 'cancelled'),
(6, 2, 1, 1, 21.00, '2024-05-31 14:47:05', 'cancelled'),
(7, 2, 1, 1, 21.00, '2024-05-31 14:47:49', 'cancelled'),
(8, 3, 1, 1, 12.00, '2024-05-31 14:48:23', 'completed'),
(9, 3, 1, 1, 12.00, '2024-05-31 15:10:56', 'completed'),
(10, 3, 1, 1, 12.00, '2024-05-31 15:13:18', 'completed'),
(11, 4, 1, 1, 23.00, '2024-06-01 02:31:22', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `status` enum('completed','cancelled') NOT NULL DEFAULT 'completed',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, '123', '$2y$10$4tbFEQIIpbMBEsdr6kyfoeIvyk38YwY.0BypFQiXgqMpk9x6JgSa6', 'user'),
(3, '321', '$2y$10$XYkM0SZWU0Zdvk5YaGBYbO3GzQ/QAJNeCNAHbLXaNViZk6Z8FQczu', 'user'),
(4, 'admin', '$2y$10$1G5LRfMgvbs2PA3apQ/X0OTMSeswwLpuAtPa2yeyUIUImCPyUZ85u', 'user'),
(5, '111', '$2y$10$ONm.ZXJOjheutEl/G90DeuzTbPe9jQ4LDzVFOaY2ads3KmG/X3RVS', 'user'),
(6, '1233', '$2y$10$5l3uYigZHDrbZwG/eZdIVem6ddkzsIb5ld0xicep8jzL82Ti0O5/u', 'user'),
(7, 'user', '$2y$10$1wnkXWxYEkY.eDV6XoHrSOUvYYXlzLGrErkP5772KTHaqBjHhg7iu', 'user'),
(8, 'admin1', '$2y$10$IszWKTOI8oWzivrLzreYV.2smm8n8cIiFptpLELqBUJrkXVMMDVsC', 'admin'),
(9, 'rer', '$2y$10$n2b4NokoDQQj4Uzau5p83.eH2z3m7s6bg9yYoUrDVCd/heon8QoLC', 'admin'),
(10, '222', '$2y$10$o52bWFnLMqiozRc4uhV0g.Arcj.ZYdopn2lUagjChPxmylfj0IFLW', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
