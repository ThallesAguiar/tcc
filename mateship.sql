-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Ago-2021 às 00:12
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mateship`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `address`
--

CREATE TABLE `address` (
  `id_address` int(11) NOT NULL,
  `street` varchar(200) NOT NULL,
  `number` varchar(10) NOT NULL,
  `complement` varchar(100) DEFAULT NULL,
  `district` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `enterprise`
--

CREATE TABLE `enterprise` (
  `id_enterprise` int(11) NOT NULL,
  `corporate_name` varchar(200) NOT NULL,
  `fantasy_name` varchar(200) DEFAULT NULL,
  `numbering_company` varchar(50) DEFAULT NULL COMMENT 'numero do registro da empresa se for PJ',
  `numbering_personal` varchar(50) DEFAULT NULL COMMENT 'numero do CPF caso não for PJ',
  `description` varchar(250) DEFAULT NULL,
  `enterprise_type` varchar(100) NOT NULL,
  `id_address` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `enterprise`
--

INSERT INTO `enterprise` (`id_enterprise`, `corporate_name`, `fantasy_name`, `numbering_company`, `numbering_personal`, `description`, `enterprise_type`, `id_address`, `active`) VALUES
(8, 'comapny name', 'fantasy nae', '', '', 'tete de descricao', '', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `history`
--

CREATE TABLE `history` (
  `id_history` int(11) NOT NULL,
  `description` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `history`
--

INSERT INTO `history` (`id_history`, `description`, `id_user`) VALUES
(1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `user_id` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`user_id`, `start`, `end`) VALUES
(14, '2021-08-19 11:32:37', '2021-08-20 19:12:24'),
(13, '2021-08-19 01:14:44', '2021-08-20 19:09:01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `social_network`
--

CREATE TABLE `social_network` (
  `id_social_network` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `social_network`
--

INSERT INTO `social_network` (`id_social_network`, `id_user`, `name`, `link`) VALUES
(2, 13, 'zap zap', 'https://api.whatsapp.com/phone=5555984488864');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `businessman` tinyint(1) DEFAULT 0,
  `status` varchar(50) NOT NULL DEFAULT 'ATIVO',
  `password` varchar(200) NOT NULL,
  `birthday` date NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `bio` text NOT NULL,
  `id_enterprise` int(11) DEFAULT NULL,
  `avatar` varchar(500) DEFAULT 'https://gartic.com.br/imgs/mural/ra/raqueelita/chimarrao.png',
  `coordinates` point NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id_user`, `name`, `lastname`, `email`, `businessman`, `status`, `password`, `birthday`, `gender`, `phone`, `bio`, `id_enterprise`, `avatar`, `coordinates`, `lat`, `lng`, `created`) VALUES
(12, 'Thalles', 'Aguiar', 'thalles@email.com', 0, 'ATIVO', 'e10adc3949ba59abbe56e057f20f883e', '1996-02-18', 'M', '+155984488864', 'olá, eu sou o Thalles', NULL, 'https://cf.shopee.com.br/file/9c4784b91814ae1b24dec91d05fc28a4', 0x0000000001010000001f1329cde67148c03d80457efd103bc0, -27.066368, -48.889854, '2021-07-01 19:03:06'),
(13, 'Thalles', 'Aguiar', 'stark@aguiar.com', 0, 'ATIVO', 'e10adc3949ba59abbe56e057f20f883e', '1996-02-18', 'M', '55984488864', 'olá, eu sou o Thalles', NULL, 'https://cf.shopee.com.br/file/9c4784b91814ae1b24dec91d05fc28a4', 0x000000000101000000bbf1eec8586f48c0bbf083f3a90b3bc0, -27.045563, -48.869896, '2021-07-01 20:40:32'),
(14, 'Tony', 'Stark', 'tony@stark.com', 1, 'ATIVO', 'e10adc3949ba59abbe56e057f20f883e', '1996-02-18', 'M', '55984488864', 'olá, eu sou o Thalles', 8, 'https://cf.shopee.com.br/file/9c4784b91814ae1b24dec91d05fc28a4', 0x0000000001010000001f1329cde67148c03d80457efd103bc0, -27.066368, -48.889854, '2021-07-01 20:41:40');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id_address`);

--
-- Índices para tabela `enterprise`
--
ALTER TABLE `enterprise`
  ADD PRIMARY KEY (`id_enterprise`),
  ADD UNIQUE KEY `numero_PJ` (`numbering_company`),
  ADD UNIQUE KEY `numero_PF` (`numbering_personal`);

--
-- Índices para tabela `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_history`),
  ADD KEY `fk_user` (`id_user`);

--
-- Índices para tabela `login`
--
ALTER TABLE `login`
  ADD KEY `user_fk` (`user_id`);

--
-- Índices para tabela `social_network`
--
ALTER TABLE `social_network`
  ADD PRIMARY KEY (`id_social_network`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email UNIQUE` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `address`
--
ALTER TABLE `address`
  MODIFY `id_address` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `enterprise`
--
ALTER TABLE `enterprise`
  MODIFY `id_enterprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `social_network`
--
ALTER TABLE `social_network`
  MODIFY `id_social_network` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `enterprise`
--
ALTER TABLE `enterprise`
  ADD CONSTRAINT `fk_endereco` FOREIGN KEY (`id_endereco`) REFERENCES `address` (`id_endereco`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

--
-- Limitadores para a tabela `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_empresa` FOREIGN KEY (`id_enterprise`) REFERENCES `enterprise` (`id_empresa`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
