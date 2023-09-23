-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2023 at 07:59 PM
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
(1, 'Bebidas', '', 1),
(2, 'Combos', '', 1),
(3, 'Lanches', '', 1),
(6, 'MATHEUS HENRIQUE DE OLIVEIRA MENDES', '', 1);

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
  `cliente_contato` varchar(50) NOT NULL,
  `cliente_endereco` text NOT NULL,
  `cliente_opc_pgt` int(11) NOT NULL,
  `observacao` text NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pedidosvendas`
--

INSERT INTO `pedidosvendas` (`id`, `item_id`, `name`, `price`, `quantity`, `cliente_nome`, `cliente_contato`, `cliente_endereco`, `cliente_opc_pgt`, `observacao`, `order_date`, `order_id`) VALUES
(11, 9, 'Combo Clássico', 30, 1, 'Mat', '14997', 'Rua Julio Prestes, 18 - Vila Tsuda - Guaimbê-SP Vila Sudan', 3, 'teste', '2023-09-23', 941711),
(12, 9, 'Combo Clássico', 30, 1, '45', '45', 'Rua Adelmo Fernades Polizatto, 18 - Conjunto Habitacional Guaimbê I - Guaimbê-SP ', 3, '', '2023-09-23', 429594),
(13, 8, 'Fanta', 8, 3, '45', '45', 'Rua Adelmo Fernades Polizatto, 18 - Conjunto Habitacional Guaimbê I - Guaimbê-SP ', 3, '', '2023-09-23', 429594),
(14, 9, 'Combo Clássico', 30, 1, 'MATHEUS HENRIQUE DE OLIVEIRA MENDES', '14997345836', 'Rua Almirante Barroso, 5 - Centro - Guaimbê-SP ', 3, '', '2023-09-23', 792403),
(15, 8, 'Fanta', 8, 1, 'MATHEUS HENRIQUE DE OLIVEIRA MENDES', '14997345836', 'Rua Almirante Barroso, 5 - Centro - Guaimbê-SP ', 3, '', '2023-09-23', 792403);

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
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`id`, `name`, `id_categoria`, `price`, `description`, `images`, `status`) VALUES
(1, 'Americano', 3, 20.5, 'Hambúrguer, cheddar, bacon, picles e cebola', 'x-classico.jpg', 1),
(2, 'X-Burger', 3, 25, 'Bacon e cebola caramelizada', 'x-classico.jpg', 1),
(3, 'X-Egg', 3, 22, 'Hambúrguer de frango, catupiry, alface, tomate e molho tártaro', 'x-classico.jpg', 1),
(4, 'X-Parmegiana', 3, 30, 'Mussarela, parmesão e molho de tomate', 'x-classico.jpg', 1),
(6, 'Coca Cola 2L', 1, 9, '', 'coca.jpg', 1),
(7, 'Hot-Cheddar', 3, 20, '', 'x-classico.jpg', 1),
(8, 'Fanta', 1, 8, '', 'fanta.jpg', 1),
(9, 'Combo Clássico', 2, 30, '', 'combo-classico.jpg', 1),
(10, 'Combo Salada', 2, 25, '', 'combo-salada.jpg', 1),
(11, 'MATHEUS HENRIQUE DE OLIVEIRA MENDES', 3, 10, 'teste', '', 1);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `cliente_opc_pgt` (`cliente_opc_pgt`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forma_pgto`
--
ALTER TABLE `forma_pgto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pedidosvendas`
--
ALTER TABLE `pedidosvendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pedidosvendas`
--
ALTER TABLE `pedidosvendas`
  ADD CONSTRAINT `pedidosvendas_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `pedidosvendas_ibfk_2` FOREIGN KEY (`cliente_opc_pgt`) REFERENCES `forma_pgto` (`id`);

--
-- Constraints for table `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
