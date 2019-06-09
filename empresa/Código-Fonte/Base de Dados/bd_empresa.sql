-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 09-Jun-2019 às 02:13
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
CREATE DATABASE IF NOT EXISTS `bd_empresa` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `bd_empresa`;

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
(2, 1, 'FarmÃ¡cia Silva Duarte', 'FarmÃ¡cia Silva Duarte', 'Farmacia', 'Rua Elias Garcia, 163A-163B', ' CacÃ©m', '2735-267', '091231293', '219148120', 'fsduarte@gmail.com', '', '2019-06-08 22:54:54', '0000-00-00 00:00:00'),
(3, 1, 'FarmÃ¡cia Janes', 'FarmÃ¡cia Janes', 'Farmacia', 'PraÃ§a Doutor Manuel Fialho Recto , 16', 'SÃ£o Pedro do Corval', '7200-114', '231123123', '266549182', 'fjanes@gmail.com', '', '2019-06-08 22:58:07', '0000-00-00 00:00:00'),
(4, 1, 'FarmÃ¡cia Valente', 'FarmÃ¡cia Valente', 'Farmacia', 'Rua Francisco Mateus Germano (EN 541), 14', 'Loures', '2670-717', '123123123', '219730814', 'fvalente@hotmail.com', '', '2019-06-08 23:00:22', '0000-00-00 00:00:00'),
(5, 2, 'FarmÃ¡cia Castro Mendes', 'FarmÃ¡cia Castro Mendes', 'Farmacia', 'Rua de MoÃ§ambique, 98', 'GuimarÃ£es', '4835-081', '989327131', '253414207', 'fcastro@castro.com', '', '2019-06-08 23:03:11', '0000-00-00 00:00:00'),
(6, 2, 'FarmÃ¡cia Central Barros', 'FarmÃ¡cia Central Barros', 'Parafarmacia', 'Rua da Cultura, 22', 'Freamunde', '4590 ', '032139712', '255879140', 'fcentral@barros.com', '', '2019-06-08 23:05:10', '0000-00-00 00:00:00'),
(9, 1, 'FarmÃ¡cia de Recarei', 'FarmÃ¡cia de Recarei', 'FarmÃ¡cia', 'Rua JoÃ£o Paulo II (EN 15-3), 29-39', 'Recarei', '4585-899', '232131232', '224339060', 'frecarei@hotmail.com', 'FarmÃ¡cia em Recarei', '2019-06-09 01:01:25', '0000-00-00 00:00:00');

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
  `iva_total` float NOT NULL,
  `iva_liquido` float NOT NULL,
  `autorizada` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `encomendas`
--

INSERT INTO `encomendas` (`id`, `id_encomenda`, `id_utilizador`, `id_cliente`, `id_produto`, `id_material`, `data_encomenda`, `quantidadeP`, `tipo_pagamento`, `comentario`, `total_s_iva`, `total_geral_cheque`, `total_liquido_pp`, `total_geral_pp`, `iva_total`, `iva_liquido`, `autorizada`) VALUES
(1, 1, 2, 2, 2, NULL, '2019-06-08 22:43:52', 4, 'Pronto Pagamento Contra Entrega - c/ Desconto', 'entregar para a prÃ³xima semana', 258.5, 0, 250.75, 308.42, 0, 57.67, '0'),
(2, 1, 2, 2, 3, NULL, '2019-06-08 22:43:52', 5, 'Pronto Pagamento Contra Entrega - c/ Desconto', 'entregar para a prÃ³xima semana', 258.5, 0, 250.75, 308.42, 0, 57.67, '0'),
(3, 1, 2, 2, 5, NULL, '2019-06-08 22:43:52', 5, 'Pronto Pagamento Contra Entrega - c/ Desconto', 'entregar para a prÃ³xima semana', 258.5, 0, 250.75, 308.42, 0, 57.67, '0'),
(4, 1, 2, 2, 6, NULL, '2019-06-08 22:43:52', 4, 'Pronto Pagamento Contra Entrega - c/ Desconto', 'entregar para a prÃ³xima semana', 258.5, 0, 250.75, 308.42, 0, 57.67, '0'),
(5, 1, 2, 2, 7, NULL, '2019-06-08 22:43:52', 4, 'Pronto Pagamento Contra Entrega - c/ Desconto', 'entregar para a prÃ³xima semana', 258.5, 0, 250.75, 308.42, 0, 57.67, '0'),
(6, 1, 2, 2, 10, NULL, '2019-06-08 22:43:52', 2, 'Pronto Pagamento Contra Entrega - c/ Desconto', 'entregar para a prÃ³xima semana', 258.5, 0, 250.75, 308.42, 0, 57.67, '0'),
(7, 2, 1, 4, NULL, 1, '2019-06-08 22:51:21', 2, '', 'cliente novo', 0, 0, 0, 0, 0, 0, '0'),
(8, 2, 1, 4, NULL, 3, '2019-06-08 22:51:21', 2, '', 'cliente novo', 0, 0, 0, 0, 0, 0, '0'),
(9, 2, 1, 4, NULL, 4, '2019-06-08 22:51:21', 2, '', 'cliente novo', 0, 0, 0, 0, 0, 0, '0'),
(10, 2, 1, 4, NULL, 6, '2019-06-08 22:51:21', 2, '', 'cliente novo', 0, 0, 0, 0, 0, 0, '0'),
(11, 3, 1, 3, 1, NULL, '2019-06-08 23:36:52', 3, 'Pronto Pagamento Contra Entrega - c/ Desconto', '', 176.2, 0, 170.91, 210.22, 0, 39.31, '0'),
(12, 3, 1, 3, 2, NULL, '2019-06-08 23:36:52', 4, 'Pronto Pagamento Contra Entrega - c/ Desconto', '', 176.2, 0, 170.91, 210.22, 0, 39.31, '0'),
(13, 3, 1, 3, 5, NULL, '2019-06-08 23:36:52', 2, 'Pronto Pagamento Contra Entrega - c/ Desconto', '', 176.2, 0, 170.91, 210.22, 0, 39.31, '0'),
(14, 3, 1, 3, 7, NULL, '2019-06-08 23:36:52', 5, 'Pronto Pagamento Contra Entrega - c/ Desconto', '', 176.2, 0, 170.91, 210.22, 0, 39.31, '0'),
(15, 3, 1, 3, 8, NULL, '2019-06-08 23:36:52', 6, 'Pronto Pagamento Contra Entrega - c/ Desconto', '', 176.2, 0, 170.91, 210.22, 0, 39.31, '0'),
(22, 4, 1, 9, 1, NULL, '2019-06-09 00:03:31', 4, 'Pronto Pagamento Contra Entrega - c/ Desconto', 'Encomenda para a prÃ³xima semana.', 329.7, 0, 319.81, 393.37, 0, 73.56, '1'),
(23, 4, 1, 9, 2, NULL, '2019-06-09 00:03:31', 5, 'Pronto Pagamento Contra Entrega - c/ Desconto', 'Encomenda para a prÃ³xima semana.', 329.7, 0, 319.81, 393.37, 0, 73.56, '1'),
(24, 4, 1, 9, 3, NULL, '2019-06-09 00:03:31', 2, 'Pronto Pagamento Contra Entrega - c/ Desconto', 'Encomenda para a prÃ³xima semana.', 329.7, 0, 319.81, 393.37, 0, 73.56, '1'),
(25, 4, 1, 9, 4, NULL, '2019-06-09 00:03:31', 8, 'Pronto Pagamento Contra Entrega - c/ Desconto', 'Encomenda para a prÃ³xima semana.', 329.7, 0, 319.81, 393.37, 0, 73.56, '1'),
(26, 4, 1, 9, 5, NULL, '2019-06-09 00:03:31', 3, 'Pronto Pagamento Contra Entrega - c/ Desconto', 'Encomenda para a prÃ³xima semana.', 329.7, 0, 319.81, 393.37, 0, 73.56, '1'),
(27, 4, 1, 9, 6, NULL, '2019-06-09 00:03:31', 10, 'Pronto Pagamento Contra Entrega - c/ Desconto', 'Encomenda para a prÃ³xima semana.', 329.7, 0, 319.81, 393.37, 0, 73.56, '1'),
(28, 4, 1, 9, 8, NULL, '2019-06-09 00:03:31', 1, 'Pronto Pagamento Contra Entrega - c/ Desconto', 'Encomenda para a prÃ³xima semana.', 329.7, 0, 319.81, 393.37, 0, 73.56, '1');

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
(1, 'MostruÃ¡rio 24 Unidades FuraÃ§Ã£o', 'Mostruarios', 'ae2afc24b927ed61cf23c04b10ca9e81.jpg', '2019-06-08 23:34:07', '2019-06-08 23:34:18'),
(2, 'MostruÃ¡rio Novos Modelos', 'Mostruarios', '60eb5582828d8c6040be3cf4ed7ec14d.jpg', '2019-06-08 23:35:42', '0000-00-00 00:00:00'),
(3, 'Expositor AcrÃ­lico', 'Expositores', 'expositor6.jpg', '2019-06-08 23:36:04', '0000-00-00 00:00:00'),
(4, 'Dispositivo FuraÃ§Ã£o 2000', 'MaterialTecnico', 'expositor7.png', '2019-06-08 23:36:27', '0000-00-00 00:00:00'),
(5, 'MostruÃ¡rio Exxl', 'Mostruarios', 'expositor-wide5.jpg', '2019-06-08 23:36:54', '0000-00-00 00:00:00'),
(6, 'Expositor Sensitive 48 Unidades PÃ©', 'Expositores', 'wwwwwww.jpg', '2019-06-08 23:40:50', '2019-06-08 23:41:01'),
(7, 'Expositor Sensitive 48 Unidades Dupla Face - BalcÃ£o', 'Expositores', 'w.jpg', '2019-06-08 23:41:23', '0000-00-00 00:00:00');

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
(1, 'Bola 3mm Plaq. Ouro', '556579dfbd1cd38eb4ea2525cc588611 (1).jpg', 5.5, 'INDO 10', 'Bola 3mm Plaq. Ouro', '2019-06-08 23:12:41', '2019-06-08 23:13:34'),
(2, 'Bola 4mm Plaq. Ouro', '11-4mm-ball.jpg', 5.75, 'INDO 11', 'Bola 4mm Plaq. Ouro\r\n', '2019-06-08 23:14:11', '2019-06-08 23:14:21'),
(3, 'FLOR CRISTAL (Plaq. Ouro)', '805-Flor-Cristal-W.jpg', 9.5, 'INDO 805', 'FLOR CRISTAL (Plaq. Ouro)\r\n', '2019-06-08 23:16:13', '2019-06-08 23:16:22'),
(4, 'FLOR AZUL / ROSA (Plaq. Paladio)', '804FlorAzul_RosaPlaqPaladio.jpeg', 9.5, 'INDO 804', 'FLOR AZUL / ROSA (Plaq. Paladio)\r\n', '2019-06-08 23:17:00', '0000-00-00 00:00:00'),
(5, 'CoraÃ§Ã£o c/cristal Plaq. Paladium', 'dvwwvyR.jpg', 7, 'INDO 172', 'CoraÃ§Ã£o c/cristal Plaq. Paladium\r\n', '2019-06-08 23:17:32', '0000-00-00 00:00:00'),
(6, 'MICKEY', '806_mickey.jpg', 15.5, 'INDI 806', 'MICKEY\r\n', '2019-06-08 23:18:07', '2019-06-08 23:18:25'),
(7, 'ZircÃ£o 7mm Cristal', '189-Zircao-7mmD.jpg', 15, 'INDO 761', 'ZircÃ£o 7mm Cristal\r\n', '2019-06-08 23:22:30', '0000-00-00 00:00:00'),
(8, 'Safira 3mm', '119florcristalazul.jpeg', 7.95, 'INDO 89', 'Safira 3mm\r\n', '2019-06-08 23:23:18', '0000-00-00 00:00:00'),
(9, 'Joaninha(Plaq. Paladio)', '187joaninha.jpeg', 7.95, 'INDO 187', 'Joaninha(Plaq. Paladio)\r\n', '2019-06-08 23:24:26', '0000-00-00 00:00:00'),
(10, 'MINNIE', '807_minnie.jpg', 15.5, 'INDI 807', 'MINNIE\r\n', '2019-06-08 23:26:42', '0000-00-00 00:00:00'),
(11, 'BORBOLETA CRISTAL', '62-TripleStars.jpg', 9.5, 'INS 848', 'BORBOLETA CRISTAL\r\n', '2019-06-08 23:27:26', '0000-00-00 00:00:00'),
(12, 'SININHO', '833_Sininho.jpg', 15.5, 'INDI 833', 'SININHO\r\n', '2019-06-08 23:28:25', '0000-00-00 00:00:00'),
(13, 'BORBOLETA ROSA', '834-Bfly-Rose.jpg', 9.5, 'INS 849', 'BORBOLETA ROSA', '2019-06-08 23:29:23', '0000-00-00 00:00:00'),
(14, 'FLOR BONAIRE', '835-5florbonaire.jpeg', 9.5, 'INFT 835-5', 'FLOR BONAIRE\r\n', '2019-06-08 23:29:59', '0000-00-00 00:00:00');

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
(1, '', 'admin', 'transferir.jpg', '', '231313131', '918019358', 'Gestor', 'd4990116bbe7c39b88700a95607abd53', '0000-00-00 00:00:00', '2019-06-08 23:42:35', ''),
(2, '', 'user2', 'unr_example_170227_1250_yq2lr.png', 'user2@g.com', '232131232', '321321321', 'Utilizador', '7da698e7bc49b707c212d80f2125b6c3', '2019-05-16 01:57:08', '2019-06-08 23:43:09', 'n00b'),
(15, '', 'gestor1', 'vYZryaz.png', 'gestor1@gmail.com', '923109302', '902391893', 'Gestor', '20000c9b526b6cd6d5c20a993d17ddc6', '2019-06-09 00:10:57', '2019-06-09 00:17:25', 'Gestor nÂº1'),
(16, '', 'utilizador', 'images.jpg', 'utilizador@gmail.com', '092031032', '029391392', 'Utilizador', '95c42e358abc6efe05a8b57b9eaf3ea6', '2019-06-09 00:11:29', '2019-06-09 00:15:50', 'Utilizador ');

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
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `encomendas`
--
ALTER TABLE `encomendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `material_apoio`
--
ALTER TABLE `material_apoio`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
