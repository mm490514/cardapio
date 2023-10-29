-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2023 at 04:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cardapio`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nome` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `nome`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `imagem`, `status`) VALUES
(29, 'Diversos', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `forma_pgto`
--

CREATE TABLE `forma_pgto` (
  `id` int(11) NOT NULL,
  `opcao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forma_pgto`
--

INSERT INTO `forma_pgto` (`id`, `opcao`) VALUES
(1, 'Pix'),
(2, 'Cartão'),
(3, 'Dinheiro');

-- --------------------------------------------------------

--
-- Table structure for table `pedidosvendas`
--

CREATE TABLE `pedidosvendas` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `cliente_nome` varchar(200) NOT NULL,
  `observacao` text NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `order_id` int(11) NOT NULL,
  `num_mesa` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pedidosvendas`
--

INSERT INTO `pedidosvendas` (`id`, `item_id`, `name`, `price`, `quantity`, `cliente_nome`, `observacao`, `order_date`, `order_id`, `num_mesa`, `status`) VALUES
(77, 36, 'X tudão', 50, 1, 'MATHEUS HENRIQUE DE OLIVEIRA MENDES', 'Sem ovo', '2023-10-11', 531021, 1, 2),
(78, 9, 'Combo Clássico', 30, 1, 'MATHEUS HENRIQUE DE OLIVEIRA MENDES', 'Hamburguer Duplo', '2023-10-11', 531021, 1, 2),
(79, 10, 'Combo Salada', 25, 2, 'Matheus', 'Coca', '2023-10-11', 390957, 2, 3),
(80, 10, 'Combo Salada', 25, 2, 'Matheus', 'Coca', '2023-10-11', 390957, 2, 1),
(81, 36, 'X tudão', 50, 2, 'Matheus', '1 Sem Ovo', '2023-10-11', 727447, 3, 1),
(82, 9, 'Combo Clássico', 30, 1, 'Matheus', 'Fanta', '2023-10-11', 727447, 3, 1),
(83, 8, 'Fanta', 8, 1, 'Rosa', '', '2023-10-28', 862789, 1, 2),
(84, 9, 'Combo Clássico', 30, 2, 'Rosa', '', '2023-10-28', 862789, 1, 2),
(85, 36, 'X tudão', 50, 1, 'Rosa', '', '2023-10-28', 788027, 1, 2),
(86, 8, 'Fanta', 8, 1, 'Rosa', '', '2023-10-28', 647177, 1, 2),
(87, 36, 'X tudão', 50, 1, 'Teste', 'Teste', '2023-10-28', 863544, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forma_pgto`
--
ALTER TABLE `forma_pgto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pedidosvendas`
--
ALTER TABLE `pedidosvendas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `forma_pgto`
--
ALTER TABLE `forma_pgto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pedidosvendas`
--
ALTER TABLE `pedidosvendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
