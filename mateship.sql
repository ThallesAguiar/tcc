-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Jul-2021 às 00:42
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
CREATE DATABASE IF NOT EXISTS `mateship` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mateship`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `id_address` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(200) NOT NULL,
  `number` varchar(10) NOT NULL,
  `complement` varchar(100) DEFAULT NULL,
  `district` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` varchar(50) NOT NULL,
  PRIMARY KEY (`id_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `enterprise`
--

CREATE TABLE IF NOT EXISTS `enterprise` (
  `id_enterprise` int(11) NOT NULL AUTO_INCREMENT,
  `corporate_name` varchar(200) NOT NULL,
  `fantasy_name` varchar(200) DEFAULT NULL,
  `numbering_company` varchar(50) DEFAULT NULL COMMENT 'numero do registro da empresa se for PJ',
  `numbering_personal` varchar(50) DEFAULT NULL COMMENT 'numero do CPF caso não for PJ',
  `description` varchar(250) DEFAULT NULL,
  `enterprise_type` varchar(100) NOT NULL,
  `id_address` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_enterprise`),
  UNIQUE KEY `numero_PJ` (`numbering_company`),
  UNIQUE KEY `numero_PF` (`numbering_personal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id_user`, `name`, `lastname`, `email`, `businessman`, `status`, `password`, `birthday`, `gender`, `phone`, `bio`, `id_enterprise`, `avatar`, `coordinates`) VALUES
(1, 'Thalles', 'Aguiar', 'thalles@email.com', 0, 'ATIVO', 'e10adc3949ba59abbe56e057f20f883e', '1996-02-18', 'M', '55984488864', 'olá, eu sou o Thalles', NULL, 'https://gartic.com.br/imgs/mural/ra/raqueelita/chimarrao.png', 0x0000000001010000003d80457efd103bc01f1329cde67148c0),
(4, 'Thalles', 'Stark', 'stark@email.com', 0, 'ATIVO', 'e10adc3949ba59abbe56e057f20f883e', '1996-02-18', 'M', '55984488864', 'olá, eu sou o Thalles', NULL, 'https://gartic.com.br/imgs/mural/ra/raqueelita/chimarrao.png', 0x000000000101000000662fdb4e5b6f48c046990d32c90c3bc0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
