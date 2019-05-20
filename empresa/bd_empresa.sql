-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30-Abr-2019 às 01:09
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
(1, 1, 'Farmacia Central', 'Central', 'FarmÃ¡cia', 'Rua Central', 'Porto', '20931093', '1231231', '012930129', 'central@gmail.com', 'asdasdas', '0000-00-00 00:00:00', '2019-04-26 01:30:28'),
(3, 1, 'asdas', 'ddd', 'FarmÃ¡cia', '', '', '', '7878', '7878', 'asd@gmail.com', '', '0000-00-00 00:00:00', '2019-04-27 01:36:57');

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomendas`
--

CREATE TABLE `encomendas` (
  `id_encomenda` int(11) NOT NULL,
  `id_utilizador` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `data_encomenda` date NOT NULL,
  `quantidade` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comentario_encomenda` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total` float NOT NULL,
  `autorizada` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(2, 'cxddd', 'MaterialTecnico', 'box.jpg', '2019-04-20 14:13:39', '2019-04-27 01:36:18'),
(3, 'asdas', 'Folhetos', '', '2019-04-27 01:35:32', '0000-00-00 00:00:00'),
(4, 'MostruÃ¡rio 36 Unidades FuraÃ§Ã£o', 'Expositores', 'caixa.jpg', '2019-04-29 19:38:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `nome_produto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imagem` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor` float NOT NULL,
  `codigo_produto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `criado` datetime NOT NULL,
  `editado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `nome_produto`, `imagem`, `valor`, `codigo_produto`, `descricao`, `criado`, `editado`) VALUES
(11, 'Brinco 4mm', '556579dfbd1cd38eb4ea2525cc588611.jpg', 6.99, 'INSO 152', 'asdasdas', '2019-04-17 00:00:00', '2019-04-29 19:52:34'),
(12, 'Brinco 6mm', '', 6, 'INSO 11', 'asdddddddd', '2019-04-18 00:00:00', '0000-00-00 00:00:00'),
(13, 'Brinco acrilico', '', 5, 'IA 1345', 'iasdasodkqwimfq', '1970-01-01 01:00:00', '0000-00-00 00:00:00'),
(14, 'ez for ence', '', 6, 'ez', 'asdas', '1970-01-01 01:00:00', '0000-00-00 00:00:00'),
(17, 'Bola 3mm Plaq. Ouro', 'Projeto_WBS_Requisitos.docx', 5.5, 'INDO 10', 'asdas', '2019-04-20 14:12:45', '0000-00-00 00:00:00'),
(34, 'ddd', 'aa3.jpg', 22, 'dd', 'dd', '2019-04-24 00:48:51', '0000-00-00 00:00:00'),
(35, 'Brinco Sensitive', 'aa3.jpg', 5.5, 'INSO 90', '5mm bola', '2019-04-29 19:40:49', '0000-00-00 00:00:00');

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
  `editado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`id_user`, `nome_completo`, `nome`, `imagem`, `email`, `num_fiscal`, `num_telefone`, `user_type`, `password`, `criado`, `editado`) VALUES
(1, 'Augusto Moura', 'admin', '42643124072_fdee5215f6_c.jpg', '333@gmail.com', '812312321', '777', 'Gestor', '$2y$10$rd6o6.e27LiUDTxu5Wc57OLyscfCeJ.8a0oQhHnh97LpWQ9tcep0.', '0000-00-00 00:00:00', '2019-04-29 19:36:29');

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
  ADD PRIMARY KEY (`id_encomenda`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_user` (`id_utilizador`),
  ADD KEY `id_produto` (`id_produto`),
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
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `encomendas`
--
ALTER TABLE `encomendas`
  MODIFY `id_encomenda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_apoio`
--
ALTER TABLE `material_apoio`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
