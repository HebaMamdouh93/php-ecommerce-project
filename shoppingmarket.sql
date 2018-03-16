-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2018 at 12:00 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoppingmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

CREATE TABLE `catagory` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`id`, `name`) VALUES
(1, 'Samsung'),
(2, 'LG'),
(3, 'Nokia'),
(4, ' Apple');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `catagory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `photo`, `price`, `catagory_id`) VALUES
(1, 'mobile1', 'mobile1 is Released 2016, November\n160g, 8.9mm thickness\nAndroid 6.0\n8GB storage, microSD card slo', 'uploads/01.png', '2000 LE', 1),
(2, 'mobile2', 'mobile2 is Released 2016, November\n160g, 8.9mm thickness\nAndroid 6.0\n8GB storage, microSD card slo', 'uploads/02.png', '3000 LE', 2),
(3, 'mobile3', 'mobile3 is Released 2016, November\n160g, 8.9mm thickness\nAndroid 6.0\n8GB storage, microSD card slo', 'uploads/03.png', '3000 LE', 3),
(4, 'mobile4', 'mobile4 is Released 2016, November\n160g, 8.9mm thickness\nAndroid 6.0\n8GB storage, microSD card slo', 'uploads/04.png', '5000 LE', 4),
(5, 'mobile6', 'mobile6 is Released 2016, November\n160g, 8.9mm thickness\nAndroid 6.0\n8GB storage, microSD card slo', 'uploads/05.png', '6000 LE', 1),
(6, 'mobile7', 'mobile7 is Released 2016, November\n160g, 8.9mm thickness\nAndroid 6.0\n8GB storage, microSD card slo', 'uploads/06.png', '8000 LE', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `rate` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `created_at`, `product_id`, `user_id`, `review`, `rate`) VALUES
(1, '2018-02-06 22:22:21', 1, 2, 'good product', 3),
(2, '2018-02-06 22:24:08', 3, 2, 'I recommended this product for each one to buy it', 4),
(3, '2018-02-06 22:26:12', 4, 2, 'woooooow , a very good product', 5),
(4, '2018-02-06 22:28:07', 2, 3, 'goood product', 3),
(5, '2018-02-06 22:31:04', 5, 3, 'good product', 3),
(6, '2018-02-06 22:32:12', 3, 3, 'wooooooooooow ,the price is awsome', 4),
(7, '2018-02-06 22:38:49', 6, 6, 'njkj', 3),
(8, '2018-02-06 22:39:29', 4, 6, 'wooooooooooooow', 4),
(9, '2018-02-06 22:48:38', 2, 8, 'nkjn', 2),
(10, '2018-02-06 22:49:34', 3, 8, 'wooooooooooow ,very good product', 3),
(11, '2018-02-06 22:52:52', 6, 5, 'bjbj', 3),
(12, '2018-02-06 22:53:25', 1, 5, 'wooooooooooooooooooooow', 4),
(13, '2018-02-06 22:56:24', 1, 3, 'njn', 2),
(14, '2018-02-06 22:58:35', 1, 7, 'nkn', 2),
(15, '2018-02-06 23:00:22', 2, 6, 'wooooooooooooow', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `photo`, `email`, `password`) VALUES
(1, 'Admin', 'uploads/usersImages/1516488368.png', 'heba93@gmail.com', '123'),
(2, 'HebaAkel93', 'uploads/usersImages/1517955710.png', 'hebaakel2016@gmail.com', '1234'),
(3, 'Asmaa93', 'uploads/usersImages/1517956059.png', 'asmaa93@gmail.com', '123'),
(5, 'MaiMohamed93', 'uploads/usersImages/1517956517.png', 'maiali93@gmail.com', '123'),
(6, 'hodaMamdouh93', 'uploads/usersImages/1517956642.png', 'hoda93@gmail.com', '123'),
(7, 'ahmed93', 'uploads/usersImages/1517956824.png', 'ahmed2016@gmail.com', '123'),
(8, 'mohamedAli93', 'uploads/usersImages/1517957162.png', 'mohamed90@gmail.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catagory`
--
ALTER TABLE `catagory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catagory`
--
ALTER TABLE `catagory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
