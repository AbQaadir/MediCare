-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2024 at 06:39 PM
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
-- Database: `medicare`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` varchar(255) NOT NULL DEFAULT 'Medicare Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `email`, `password`, `name`, `phone_number`, `registration_date`, `address`) VALUES
(9, 'soloqaadir@gmail.com', '$2y$12$7y/0pPpwaUI4GBgvfdJgoOP2rmZ0WClcSAfpKYJ8zSXVEUPrBPGgu', 'Abdul Qaadir', '+94719372380', '2023-09-30 10:00:21', 'Medicare Admin'),
(11, 'raufhakeem21162@gmail.com', '$2y$12$9DVVDF7SsUhntZ1pRShO1uAG1dfT1X7qFb3aKulxz5WzJsn0THugW', 'hakeem', '+94779005418', '2023-10-06 17:48:46', 'Medicare Admin'),
(17, 'amharma-se20060@stu.kln.ac.lk', '$2y$12$Im1q2vRkgdk31vcIfqtB8O9r5Q1twdUdLTBWNkCAtT4fLxS4hOcGW', ' Name', '+94760204209', '2024-02-02 18:48:30', 'Medicare Admin'),
(18, 'amharma-se2006@stu.kln.ac.lk', '$2y$12$tI4Ka4hxnaYdxVIQK49kE.Mf0jk8.gh9LpgbPiS6/Pw/Xv713VjgG', 'Amhar', '+94760201111', '2024-02-14 17:25:13', 'Medicare Admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` int(11) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`user_id`, `product_id`, `qty`, `id`) VALUES
(9, '8', 1, 453),
(1, '14', 1, 456),
(9, '26', 1, 465);

-- --------------------------------------------------------

--
-- Table structure for table `loginfo`
--

CREATE TABLE `loginfo` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` varchar(255) NOT NULL DEFAULT 'add your address'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loginfo`
--

INSERT INTO `loginfo` (`user_id`, `email`, `password`, `name`, `phone_number`, `registration_date`, `address`) VALUES
(1, 'mamamhar@gmail.com', '$2y$12$9JMnbQRRwsYAez4fqcBKm.k2BlPqqpFF8zllWPUSfget6.kyn8Hm2', 'Amhar', '+94760204000', '2024-02-14 17:18:08', 'add your address'),
(25, 'qaadir.inbox@gmail.com', '$2y$12$ccF1tWJEjEurB9i2A/ul8O6SzWyuGFSu7fiZnbxhrXL1Mj8AgHtE6', 'Abdul Qaadir', '+94765588418', '2023-09-28 18:16:16', 'add your address'),
(27, 'mamamhar254@gmail.com', '$2y$12$0mfkJjwLRU3hwu0dKzImceunjMg.Rdo9g6HJ8SdRgRdY5E0TuaOcK', 'M.A.M. Amhar', '+94769204208', '2023-09-30 20:45:16', 'add your address'),
(28, 'mam@gmail.com', '$2y$12$mDnH53ARV6YdNrh3YMT0pud7Sc8irCI52kj4y7hHbNAZ6JOsDCUxa', 'abdul', '+94761104209', '2024-02-14 17:19:47', 'add your address');

-- --------------------------------------------------------

--
-- Table structure for table `passwordreset`
--

CREATE TABLE `passwordreset` (
  `pwdResetId` int(11) NOT NULL DEFAULT 0,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passwordreset`
--

INSERT INTO `passwordreset` (`pwdResetId`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpires`) VALUES
(5, 'tharsikan645@gmail.com', 'b2af90d47d1b04a7', '$2y$10$E4i0emD0J0ciKbnqnmUoZewvguGvV7tFZispPm.vakYbi6m18TOde', 1696108482),
(18, 'qaadir.inbox@gmail.com', '20c59ff846f7b65f', '$2y$10$zKkFe6aih6YZwXtoxSBPE.k2jQgdqHrfi28w/8cguSrFb//RodT2W', 1702665688),
(0, 'soloqaadir@gmail.com', '3bdfe28bd08d3216', '$2y$10$Myd1Jy9CCdFsyoHXzW75ueV.HkKapN/d7cwHkCMCu69iIYIldcL/m', 1707371343),
(0, 'mamamhar254@gmail.com', '6de8df8afaaca2cf', '$2y$10$nand3X2nTwUMXYZ1W07H0eF.r9n85ytZyFSN1CbVYrwd1lzQQunfi', 1707371639);

-- --------------------------------------------------------

--
-- Table structure for table `pay`
--

CREATE TABLE `pay` (
  `id_pay` int(11) NOT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ord_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pay`
--

INSERT INTO `pay` (`id_pay`, `product_id`, `qty`, `user_id`, `ord_date_time`) VALUES
(234, '37', 3, 27, '2024-02-14 17:13:49');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `fileName` varchar(255) NOT NULL,
  `fileDestination` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(255) NOT NULL,
  `uploadTimestamp` datetime NOT NULL,
  `id` int(11) NOT NULL,
  `qty_p` int(11) NOT NULL DEFAULT 50,
  `adminEmail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`fileName`, `fileDestination`, `productName`, `description`, `price`, `category`, `uploadTimestamp`, `id`, `qty_p`, `adminEmail`) VALUES
('Screenshot 2024-02-08 050155.png', '../uploads/Screenshot 2024-02-08 050155.png', 'TEARS NATURALE II 15ML', 'Package Dimensions ‏ : ‎ 3.27 x 1.14 x 1.14 inches (8.3 x 2.9 x 2.9 cms); 1.13 Ounces (32.04 grams) Manufacturer ‏ : ‎ ALCON ASIN ‏ : ‎ B0844DPKR9 Brand ALCON Specific Uses For Product For topical eye', 990.72, 'Eyes', '0000-00-00 00:00:00', 28, 47, 'soloqaadir@gmail.com'),
('Screenshot 2024-02-08 050019.png', '../uploads/Screenshot 2024-02-08 050019.png', 'AZOPT 5ML', 'Uses, Brinzolamide is used to treat high pressure inside the eye due to glaucoma (open angle-type) or other eye diseases (e.g., ocular hypertension). Lowering high pressure inside the eye helps to pre', 1000.00, 'Eyes', '0000-00-00 00:00:00', 30, 49, 'amharma-se20060@stu.kln.ac.lk'),
('Screenshot 2024-02-08 083626.png', '../uploads/Screenshot 2024-02-08 083626.png', 'BRILINTA 90MG TAB', 'Uses, This medication is used to treat high blood pressure (hypertension). Side Effects, Dizziness or lightheadedness may occur as your body adjusts to the medication. When not to use, It is contraind', 3000.00, 'Heart', '0000-00-00 00:00:00', 32, 50, 'superadmin@example.com'),
('Screenshot 2024-02-08 091138.png', '../uploads/Screenshot 2024-02-08 091138.png', 'DISPRIN TAB 120S', 'ASPIRIN', 400.00, 'Heart', '0000-00-00 00:00:00', 33, 49, 'superadmin@example.com'),
('Screenshot 2024-02-08 095905.png', '../uploads/Screenshot 2024-02-08 095905.png', 'PLAVIX 75MG TABS', 'Composition: \"Active ingredient clopidogrel hydrogen sulfate. Plavix 75 mg film-coated tablets Each film-coated tablet contains 75 mg of clopidogrel (as hydrogen sulphate). Core: Mannitol (E421) Macro', 340.00, 'Heart', '0000-00-00 00:00:00', 34, 48, 'amharma-se20060@stu.kln.ac.lk'),
('Screenshot 2024-02-08 100059.png', '../uploads/Screenshot 2024-02-08 100059.png', 'CLOPIVAS 75MG', 'Uses, This medication is used to treat high blood pressure (hypertension). Side Effects, Dizziness or lightheadedness may occur as your body adjusts to the medication. When not to use, It is contraind', 1500.00, 'Heart', '0000-00-00 00:00:00', 35, 1, 'amharma-se20060@stu.kln.ac.lk'),
('Screenshot 2024-02-08 100509.png', '../uploads/Screenshot 2024-02-08 100509.png', 'PROTINEX LIFE MILK', 'Protinex Life is a Soy Based balanced nutrition supplement that specially designed to provide optimum nutrition for Cardiac Patients, Vegetarians and people who are intolerance to Cow milk due to Lact', 4000.00, 'Promotion', '0000-00-00 00:00:00', 37, 52, 'soloqaadir@gmail.com'),
('Screenshot 2024-02-14 224556.png', '../uploads/Screenshot 2024-02-14 224556.png', 'BEAUTY DETOX', 'Uses, Brinzolamide is used to treat high pressure inside the eye due to glaucoma (open angle-type) or other eye diseases (e.g., ocular hypertension). Lowering high pressure inside the eye helps to pre', 2000.00, 'Promotion', '0000-00-00 00:00:00', 40, 40, 'amharma-se20060@stu.kln.ac.lk'),
('Screenshot 2024-02-14 225051.png', '../uploads/Screenshot 2024-02-14 225051.png', 'Perfectil', 'good', 500.00, 'Promotion', '0000-00-00 00:00:00', 41, 12, 'amharma-se20060@stu.kln.ac.lk'),
('Screenshot 2024-02-08 050127.png', '../uploads/Screenshot 2024-02-08 050127.png', 'TRAVATAN EYE DROPS 2.5ML', 'Travatan (Travoprost Eye Drops) 2.5ml TRAVATAN  eye drops contain travoprost, one of a group of medicines called prostaglandin analogues. Travatan eye drops works by reducing the pressure in the eye. ', 3000.00, 'Eyes', '0000-00-00 00:00:00', 43, 33, 'superadmin@example.com'),
('Screenshot 2024-02-14 230739.png', '../uploads/Screenshot 2024-02-14 230739.png', 'CILOXAN 0.3%5ML', 'Uses, This medication is used to treat high blood pressure (hypertension). Side Effects, Dizziness or lightheadedness may occur as your body adjusts to the medication. When not to use, It is contraind', 2000.00, 'Eyes', '0000-00-00 00:00:00', 44, 23, 'superadmin@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_info`
--

CREATE TABLE `shipping_info` (
  `id` int(11) NOT NULL,
  `ship_name` varchar(255) NOT NULL,
  `ship_number` varchar(20) NOT NULL,
  `ship_address` varchar(255) NOT NULL,
  `ship_city` varchar(100) NOT NULL,
  `ship_zip` varchar(20) NOT NULL,
  `ship_country` varchar(100) NOT NULL,
  `ship_email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping_info`
--

INSERT INTO `shipping_info` (`id`, `ship_name`, `ship_number`, `ship_address`, `ship_city`, `ship_zip`, `ship_country`, `ship_email`, `created_at`) VALUES
(10, 'abdul', '94769204208', '31/a, geliaya kandy', 'kandy', '20610', 'sl', 'mamamhar254@gmail.com', '2024-02-08 06:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `statustable`
--

CREATE TABLE `statustable` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `complete` varchar(255) NOT NULL DEFAULT '....................'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statustable`
--

INSERT INTO `statustable` (`order_id`, `user_id`, `product_id`, `status`, `complete`) VALUES
(1, 27, 37, 'Deliverd', '....................');

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'Super Admin',
  `phone_number` varchar(255) NOT NULL DEFAULT '+94760988444',
  `address` varchar(255) NOT NULL DEFAULT 'Medicare '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`user_id`, `email`, `password`, `name`, `phone_number`, `address`) VALUES
(1, 'superadmin@example.com', '$2y$12$csUlYD9M3NnUa34981boTurCMqGrRdFp11vV47kYwMUiiUzgHFeS.', 'Super Admin', '+94760988444', 'Medicare Super Admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`name`, `email`, `telephone`, `address`, `user_id`) VALUES
('M.A.M. Amhar', 'mamamhar254@gmail.com', '+94769204208', 'add your address', 27);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`user_id`, `id`, `product_id`) VALUES
(27, 65, 17),
(9, 66, 26),
(17, 68, 36);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loginfo`
--
ALTER TABLE `loginfo`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`id_pay`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_info`
--
ALTER TABLE `shipping_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statustable`
--
ALTER TABLE `statustable`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=486;

--
-- AUTO_INCREMENT for table `loginfo`
--
ALTER TABLE `loginfo`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pay`
--
ALTER TABLE `pay`
  MODIFY `id_pay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `shipping_info`
--
ALTER TABLE `shipping_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
