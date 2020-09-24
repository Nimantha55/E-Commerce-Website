-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2020 at 02:40 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cartdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_img` varchar(200) NOT NULL,
  `still_here` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `user_name`, `product_id`, `product_name`, `product_price`, `product_img`, `still_here`) VALUES
(32, 1, 'Nimantha Sankalpa', 5, 'Apple MacBook', 350, './img/Apple-MacBook.png', 0),
(31, 1, 'Nimantha Sankalpa', 3, 'HP Notebook', 300, './img/laptop.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_img` varchar(200) NOT NULL,
  `order_date` datetime DEFAULT NULL,
  `paid` tinyint(1) NOT NULL,
  `received` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`id`, `user_id`, `user_name`, `product_id`, `product_name`, `product_price`, `product_img`, `order_date`, `paid`, `received`) VALUES
(8, 1, 'Nimantha Sankalpa', 3, 'HP Notebook', 300, './img/laptop.png', '2020-06-06 18:48:22', 0, 0),
(7, 1, 'Nimantha Sankalpa', 3, 'HP Notebook', 300, './img/laptop.png', '2020-06-04 16:40:31', 1, 1),
(9, 1, 'Nimantha Sankalpa', 5, 'Apple MacBook', 350, './img/Apple-MacBook.png', '2020-06-09 22:37:26', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `items` int(10) NOT NULL,
  `net_amount` int(10) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `user_name`, `items`, `net_amount`, `date`) VALUES
(4, 1, 'Nimantha Sankalpa', 1, 300, '2020-06-06 17:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` float DEFAULT NULL,
  `product_img` varchar(200) NOT NULL,
  `category` varchar(100) NOT NULL,
  `product_description` varchar(300) NOT NULL,
  `product_features` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_price`, `product_img`, `category`, `product_description`, `product_features`) VALUES
(3, 'HP Notebook', 300, './img/laptop.png', 'Technology', 'New HP Notebook laptop.', '4GB RAM, Intel Core i9 8th gen processor.'),
(4, 'Apple MacBook', 350, './img/Apple-MacBook.png', 'Technology', 'New Apple laptop.', '4GB RAM, 1TB HDD'),
(5, 'Tablet 2550', 200, './img/tablet.png', 'Technology', 'New Tablet.', '2GB RAM, Windows 10 support.'),
(6, 'IPad', 250, './img/ipad.png', 'Technology', 'New Apple IPad.', '2GB RAM, 500GB HDD.'),
(10, 'Cricket Ball', 100, './img/cricket-ball.png', 'Sport', 'New cricket ball.', 'Color-red, Made in Pakistan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `uaddress` varchar(200) NOT NULL,
  `uage` varchar(3) NOT NULL,
  `utel_no` varchar(15) NOT NULL,
  `uemail` varchar(100) NOT NULL,
  `upassword` varchar(40) NOT NULL,
  `last_login` datetime DEFAULT CURRENT_TIMESTAMP,
  `account_type` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uname`, `uaddress`, `uage`, `utel_no`, `uemail`, `upassword`, `last_login`, `account_type`) VALUES
(1, 'Nimantha Sankalpa', 'No 23, 1st lane, Mathugama', '24', '0715902551', 'nimanthasankalpa28@gmail.com', '3cdc6719a00a8987619af5717d316e79f35b9d83', '2020-06-13 01:57:19', 1),
(2, 'Tharindu Malintha', 'No2, 4th lane, Matara', '24', '0714536675', 'tharindumalintha@gmail.com', 'malintha123', '2020-05-26 22:29:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_img` varchar(200) NOT NULL,
  `still_here` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `user_name`, `product_id`, `product_name`, `product_price`, `product_img`, `still_here`) VALUES
(17, 1, 'Nimantha Sankalpa', 6, 'IPad', 200, './img/ipad.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
