-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20-Maio-2019 às 02:49
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_empresa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `id_utilizador` int(11) NOT NULL,
  `nome_fiscal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nome_comercial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `morada` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `localidade` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_postal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_fiscal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_telefone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `obs` text COLLATE utf8_unicode_ci NOT NULL,
  `criado` datetime NOT NULL,
  `editado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `id_utilizador`, `nome_fiscal`, `nome_comercial`, `tipo`, `morada`, `localidade`, `codigo_postal`, `num_fiscal`, `num_telefone`, `email`, `obs`, `criado`, `editado`) VALUES
(4, 12, 'Farmacia Central', 'Farmacia Central', 'Farmacia', 'Rua Do Pimenta', '', '', '321321', '23232', 'farmacia@hotmail.com', '', '2019-05-16 12:36:59', '0000-00-00 00:00:00'),
(5, 12, 'teste', 'teste', 'Farmacia', 'teste', '', '', '123123213', '213213213', 'centra@gmail.com', '', '2019-05-16 12:38:57', '0000-00-00 00:00:00'),
(7, 13, 'WTF', 'WTF', 'Parafarmacia', 'WTF', '', '', '213123213', '321321321', 'wtf@gmail.com', '', '2019-05-20 01:12:48', '0000-00-00 00:00:00'),
(8, 13, 'lol', 'lol', 'Ouriversaria', 'lol', 'asdas', 'asdas', '213123123', '213123213', 'lol@gmail.com', '', '2019-05-20 01:13:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomendas`
--

CREATE TABLE `encomendas` (
  `id` int(11) NOT NULL,
  `id_encomenda` int(11) NOT NULL,
  `id_utilizador` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `id_material` int(11) DEFAULT NULL,
  `data_encomenda` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `quantidadeP` int(255) NOT NULL,
  `tipo_pagamento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comentario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_s_iva` float NOT NULL,
  `total_geral_cheque` float NOT NULL,
  `total_liquido_pp` float NOT NULL,
  `total_geral_pp` float NOT NULL,
  `autorizada` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `encomendas`
--

INSERT INTO `encomendas` (`id`, `id_encomenda`, `id_utilizador`, `id_cliente`, `id_produto`, `id_material`, `data_encomenda`, `quantidadeP`, `tipo_pagamento`, `comentario`, `total_s_iva`, `total_geral_cheque`, `total_liquido_pp`, `total_geral_pp`, `autorizada`) VALUES
(27, 1, 13, 5, 11, NULL, '2019-05-19 21:26:48', 4, '', 'asdas', 57.96, 0, 0, 0, '1'),
(28, 1, 13, 5, 13, NULL, '2019-05-19 21:26:48', 5, '', 'asdas', 57.96, 0, 0, 0, '1'),
(29, 2, 12, 5, 11, NULL, '2019-05-19 19:19:52', 4, 'Pronto Pagamento Contra Entrega - Desconto', '', 27.96, 34.39, 27.12, 33.36, '1'),
(31, 4, 12, 5, 13, NULL, '2019-05-19 21:29:45', 2, 'Pronto Pagamento Contra Entrega - c/ Desconto', '', 12, 0, 11.64, 14.32, '1'),
(35, 7, 12, 4, NULL, 2, '2019-05-19 15:42:29', 4, '', '', 0, 0, 0, 0, '1'),
(36, 7, 12, 4, NULL, 4, '2019-05-19 15:42:29', 5, '', '', 0, 0, 0, 0, '1'),
(37, 8, 13, 4, NULL, 2, '2019-05-19 15:58:06', 4, '', '', 0, 0, 0, 0, '1'),
(38, 8, 13, 4, NULL, 4, '2019-05-19 15:58:06', 5, '', '', 5, 0, 0, 0, '1'),
(41, 10, 13, 5, 11, NULL, '2019-05-19 21:28:22', 4, 'Pronto Pagamento Contra Entrega - c/ Desconto', '', 57.96, 0, 56.22, 69.15, '1'),
(42, 10, 13, 5, 13, NULL, '2019-05-19 21:28:22', 5, 'Pronto Pagamento Contra Entrega - c/ Desconto', '', 57.96, 0, 56.22, 69.15, '1'),
(43, 11, 12, 5, 11, NULL, '2019-05-19 23:56:55', 4, 'Pronto Pagamento Contra Entrega - c/ Desconto', '', 111.96, 0, 108.6, 133.58, '1'),
(44, 11, 12, 5, 13, NULL, '2019-05-19 23:56:55', 5, 'Pronto Pagamento Contra Entrega - c/ Desconto', '', 111.96, 0, 108.6, 133.58, '1'),
(45, 11, 12, 5, 35, NULL, '2019-05-19 23:56:55', 6, 'Pronto Pagamento Contra Entrega - c/ Desconto', '', 111.96, 0, 108.6, 133.58, '1'),
(46, 11, 12, 5, 36, NULL, '2019-05-19 23:56:55', 7, 'Pronto Pagamento Contra Entrega - c/ Desconto', '', 111.96, 0, 108.6, 133.58, '1'),
(47, 12, 12, 5, 11, NULL, '2019-05-19 21:25:12', 4, 'Cheque a 30 Dias - s/ Desconto', '', 90.96, 111.88, 0, 0, '0'),
(48, 12, 12, 5, 13, NULL, '2019-05-19 21:25:12', 5, 'Cheque a 30 Dias - s/ Desconto', '', 90.96, 111.88, 0, 0, '0'),
(49, 12, 12, 5, 35, NULL, '2019-05-19 21:25:12', 6, 'Cheque a 30 Dias - s/ Desconto', '', 90.96, 111.88, 0, 0, '0'),
(50, 13, 12, 5, 11, NULL, '2019-05-19 21:25:53', 4, 'Pronto Pagamento Contra Entrega - c/ Desconto', '', 57.96, 0, 56.22, 69.15, '0'),
(51, 13, 12, 5, 13, NULL, '2019-05-19 21:25:53', 5, 'Pronto Pagamento Contra Entrega - c/ Desconto', '', 57.96, 0, 56.22, 69.15, '0'),
(52, 14, 12, 5, 11, NULL, '2019-05-19 22:53:48', 4, 'Pronto Pagamento Contra Entrega - c/ Desconto', '', 57.96, 0, 56.22, 69.15, '0'),
(53, 14, 12, 5, 13, NULL, '2019-05-19 22:53:48', 5, 'Pronto Pagamento Contra Entrega - c/ Desconto', '', 57.96, 0, 56.22, 69.15, '0'),
(54, 15, 12, 4, 36, NULL, '2019-05-19 22:54:00', 5, 'Pronto Pagamento Contra Entrega - c/ Desconto', 'ola', 15, 0, 14.55, 17.9, '0'),
(56, 17, 12, 5, 13, NULL, '2019-05-19 21:26:36', 4, 'Pronto Pagamento Contra Entrega - c/ Desconto', 'd', 24, 0, 23.28, 28.63, '0'),
(57, 18, 12, 4, 11, NULL, '2019-05-19 19:19:30', 4, 'Pronto Pagamento Contra Entrega - c/ Desconto', 'ezkatkka', 57.96, 71.29, 56.22, 69.15, '1'),
(58, 18, 12, 4, 13, NULL, '2019-05-19 19:19:30', 5, 'Pronto Pagamento Contra Entrega - c/ Desconto', 'ezkatkka', 57.96, 71.29, 56.22, 69.15, '1'),
(65, 22, 12, 4, NULL, 2, '2019-05-19 21:30:37', 4, '', '', 0, 0, 0, 0, '1'),
(66, 22, 12, 4, NULL, 4, '2019-05-19 21:30:37', 5, '', '', 0, 0, 0, 0, '1'),
(67, 23, 12, 4, NULL, 2, '2019-05-19 23:50:52', 4, '', '', 0, 0, 0, 0, '0'),
(68, 23, 12, 4, NULL, 4, '2019-05-19 23:50:52', 5, '', '', 0, 0, 0, 0, '0'),
(69, 24, 12, 4, NULL, 2, '2019-05-19 23:51:47', 2, '', 'ez', 0, 0, 0, 0, '0'),
(70, 24, 12, 4, NULL, 4, '2019-05-19 23:51:47', 3, '', 'ez', 0, 0, 0, 0, '0'),
(71, 25, 12, 5, NULL, 2, '2019-05-20 00:10:09', 4, '', '', 0, 0, 0, 0, '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `material_apoio`
--

CREATE TABLE `material_apoio` (
  `id_material` int(11) NOT NULL,
  `nome_material` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mostruários/Expositores/Folhetos/Material Técnico',
  `imagem` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `criado` datetime NOT NULL,
  `editado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `material_apoio`
--

INSERT INTO `material_apoio` (`id_material`, `nome_material`, `tipo`, `imagem`, `criado`, `editado`) VALUES
(2, 'Pimenta Doce', 'Folhetos', 'Vne4MCg.png', '2019-04-20 14:13:39', '2019-05-16 00:49:49'),
(4, 'MostruÃ¡rio 36 Unidades FuraÃ§Ã£o', 'Expositores', 'caixa.jpg', '2019-04-29 19:38:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `nome_produto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imagem` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor_s_iva` float NOT NULL,
  `codigo_produto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `criado` datetime NOT NULL,
  `editado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `nome_produto`, `imagem`, `valor_s_iva`, `codigo_produto`, `descricao`, `criado`, `editado`) VALUES
(11, 'Brinco 4mm', '556579dfbd1cd38eb4ea2525cc588611.jpg', 6.99, 'INSO 152', 'asdasdas', '2019-04-17 00:00:00', '2019-04-29 19:52:34'),
(13, 'Brinco acrilico', 'anexo.png', 6, 'IA 1345', 'iasdasodkqwimfq', '1970-01-01 01:00:00', '2019-05-16 00:45:20'),
(35, 'Brinco Sensitive', 'aa3.jpg', 5.5, 'INSO 90', '5mm bola', '2019-04-29 19:40:49', '0000-00-00 00:00:00'),
(36, 'asdsad', 'anexo.png', 3, 'asdsa', 'asd', '2019-05-04 01:07:51', '0000-00-00 00:00:00'),
(37, 'ezskins', '', 10, 'INSO 31', '0293102321', '2019-05-19 18:59:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id_user` int(11) NOT NULL,
  `nome_completo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imagem` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_fiscal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_telefone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Gestor/Utilizador',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `criado` datetime NOT NULL,
  `editado` datetime NOT NULL,
  `obs` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`id_user`, `nome_completo`, `nome`, `imagem`, `email`, `num_fiscal`, `num_telefone`, `user_type`, `password`, `criado`, `editado`, `obs`) VALUES
(12, '', 'admin', '1JMQmZ2.png', '', '231313131', '918019358', 'Gestor', 'd4990116bbe7c39b88700a95607abd53', '0000-00-00 00:00:00', '2019-05-16 01:25:33', ''),
(13, '', 'user123', 'Vne4MCg.png', 'user1@gmail.com', '221852204', '913982323', 'Utilizador', '77f575f4a89b5c2223c862724e434929', '2019-05-07 19:46:04', '2019-05-16 13:21:46', ''),
(14, '', 'user2', '', 'user2@g.com', '232131232', '321321321', 'Gestor', '7da698e7bc49b707c212d80f2125b6c3', '2019-05-16 01:57:08', '2019-05-19 20:01:28', 'n00b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_utilizador` (`id_utilizador`);

--
-- Indexes for table `encomendas`
--
ALTER TABLE `encomendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_produto` (`id_produto`),
  ADD KEY `id_user` (`id_utilizador`),
  ADD KEY `id_material` (`id_material`);

--
-- Indexes for table `material_apoio`
--
ALTER TABLE `material_apoio`
  ADD PRIMARY KEY (`id_material`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Indexes for table `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `encomendas`
--
ALTER TABLE `encomendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `material_apoio`
--
ALTER TABLE `material_apoio`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `id_utilizador` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `encomendas`
--
ALTER TABLE `encomendas`
  ADD CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_material` FOREIGN KEY (`id_material`) REFERENCES `material_apoio` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_produto` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
