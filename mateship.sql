-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.18-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para mateship
CREATE DATABASE IF NOT EXISTS `mateship` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mateship`;

-- Copiando estrutura para tabela mateship.address
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela mateship.address: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
REPLACE INTO `address` (`id_address`, `street`, `number`, `complement`, `district`, `city`, `state`, `country`, `zipcode`) VALUES
	(1, 'Rua Fernando Souza e Silva', '25', '', 'Limoeiro', 'Brusque', 'SC', 'Brasil', '88346405');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;

-- Copiando estrutura para tabela mateship.enterprise
CREATE TABLE IF NOT EXISTS `enterprise` (
  `id_enterprise` int(11) NOT NULL AUTO_INCREMENT,
  `corporate_name` varchar(200) NOT NULL,
  `fantasy_name` varchar(200) DEFAULT NULL,
  `numbering_company` varchar(50) DEFAULT NULL COMMENT 'numero do registro da empresa se for PJ',
  `numbering_personal` varchar(50) DEFAULT NULL COMMENT 'numero do CPF caso não for PJ',
  `description` varchar(250) DEFAULT NULL,
  `enterprise_type` varchar(100) NOT NULL,
  `id_address` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_enterprise`),
  UNIQUE KEY `numero_PJ` (`numbering_company`),
  UNIQUE KEY `numero_PF` (`numbering_personal`),
  KEY `fk_address` (`id_address`),
  CONSTRAINT `fk_address` FOREIGN KEY (`id_address`) REFERENCES `address` (`id_address`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela mateship.enterprise: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `enterprise` DISABLE KEYS */;
REPLACE INTO `enterprise` (`id_enterprise`, `corporate_name`, `fantasy_name`, `numbering_company`, `numbering_personal`, `description`, `enterprise_type`, `id_address`, `active`) VALUES
	(8, 'Social mate', 'mateship', '30209467000107', '03171978008', 'artigos de chimarrão e moda gaúcha....', 'internet', NULL, 1);
/*!40000 ALTER TABLE `enterprise` ENABLE KEYS */;

-- Copiando estrutura para tabela mateship.following
CREATE TABLE IF NOT EXISTS `following` (
  `id_user` int(11) DEFAULT NULL,
  `like` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela mateship.following: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `following` DISABLE KEYS */;
REPLACE INTO `following` (`id_user`, `like`) VALUES
	(13, 14),
	(14, 13),
	(14, 12);
/*!40000 ALTER TABLE `following` ENABLE KEYS */;

-- Copiando estrutura para tabela mateship.history
CREATE TABLE IF NOT EXISTS `history` (
  `id_history` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_history`),
  KEY `fk_user` (`id_user`),
  CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela mateship.history: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
REPLACE INTO `history` (`id_history`, `description`, `id_user`) VALUES
	(1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 13),
	(2, 'eu vim pra contar a historia de um tatu que já morreu', 14);
/*!40000 ALTER TABLE `history` ENABLE KEYS */;

-- Copiando estrutura para tabela mateship.login
CREATE TABLE IF NOT EXISTS `login` (
  `user_id` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  KEY `user_fk` (`user_id`),
  CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela mateship.login: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
REPLACE INTO `login` (`user_id`, `start`, `end`) VALUES
	(14, '2021-08-19 11:32:37', '2021-09-19 13:14:44'),
	(13, '2021-08-19 01:14:44', '2021-08-29 15:46:40'),
	(12, '2021-08-29 12:51:15', '2021-08-29 16:03:21');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;

-- Copiando estrutura para tabela mateship.social_network
CREATE TABLE IF NOT EXISTS `social_network` (
  `id_social_network` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(255) NOT NULL,
  `icon` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_social_network`),
  KEY `fk_user_sn` (`id_user`),
  CONSTRAINT `fk_user_sn` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela mateship.social_network: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `social_network` DISABLE KEYS */;
REPLACE INTO `social_network` (`id_social_network`, `id_user`, `name`, `link`, `icon`) VALUES
	(7, 14, 'Twitter', 'https://twitter.com/@thalles_aguiar', 'far fa-twitter'),
	(8, 13, 'WhatsApp', 'https://api.whatsapp.com/send/?phone=+555584488864', 'far fa-whatsapp'),
	(9, 13, 'Instagram', 'https://www.instagram.com/thallestyzz', 'far fa-instagram');
/*!40000 ALTER TABLE `social_network` ENABLE KEYS */;

-- Copiando estrutura para tabela mateship.user
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
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `created` datetime DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email UNIQUE` (`email`),
  KEY `fk_enterprise_user` (`id_enterprise`),
  CONSTRAINT `fk_enterprise_user` FOREIGN KEY (`id_enterprise`) REFERENCES `enterprise` (`id_enterprise`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela mateship.user: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id_user`, `name`, `lastname`, `email`, `businessman`, `status`, `password`, `birthday`, `gender`, `phone`, `bio`, `id_enterprise`, `avatar`, `coordinates`, `lat`, `lng`, `created`, `city`, `country`) VALUES
	(12, 'Tony', 'Stark', 'thalles@email.com', 0, 'ATIVO', 'e10adc3949ba59abbe56e057f20f883e', '1996-02-18', 'M', '+155984488864', 'olá, eu sou o Thalles', NULL, 'https://cf.shopee.com.br/file/9c4784b91814ae1b24dec91d05fc28a4', _binary 0x0000000001010000009468c9e3696f48c09487855ad30c3bc0, -27.050100, -48.870419, '2021-07-01 19:03:06', 'Brusque', 'Brasil'),
	(13, 'Thalles', 'Aguiar', 'stark@aguiar.com', 0, 'ATIVO', 'e10adc3949ba59abbe56e057f20f883e', '1996-02-18', 'M', '55984488864', 'olá, eu sou o Thalles', NULL, 'https://cf.shopee.com.br/file/9c4784b91814ae1b24dec91d05fc28a4', _binary 0x0000000001010000009468c9e3696f48c09487855ad30c3bc0, -27.050100, -48.870419, '2021-07-01 20:40:32', 'Santo Ângelo - RS', 'Brazil'),
	(14, 'Yushuki', 'Urameshi', 'tony@stark.com', 1, 'ATIVO', 'e10adc3949ba59abbe56e057f20f883e', '1996-02-18', 'M', '55984488864', 'detetive espiritual', 8, 'https://matche.s3.amazonaws.com/3956ae2379de546a5041d9705d359558figurinha.png', _binary 0x000000000101000000e498767b5a6f48c0b79ca62ac80c3bc0, -27.049929, -48.869949, '2021-07-01 20:41:40', 'Santo Ângelo - RS', 'Brazil');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
