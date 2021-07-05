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

-- Copiando dados para a tabela mateship.address: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
/*!40000 ALTER TABLE `address` ENABLE KEYS */;

-- Copiando dados para a tabela mateship.enterprise: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `enterprise` DISABLE KEYS */;
/*!40000 ALTER TABLE `enterprise` ENABLE KEYS */;

-- Copiando dados para a tabela mateship.user: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `name`, `lastname`, `email`, `businessman`, `status`, `password`, `birthday`, `gender`, `phone`, `bio`, `id_enterprise`, `avatar`, `coordinates`, `lat`, `lng`, `created`) VALUES
	(12, 'Thalles', 'Stark', 'stark@email.com', 0, 'ATIVO', 'e10adc3949ba59abbe56e057f20f883e', '1996-02-18', 'M', '55984488864', 'olá, eu sou o Thalles', NULL, 'https://gartic.com.br/imgs/mural/ra/raqueelita/chimarrao.png', _binary 0x000000000101000000e50cc51d6f7048c076fc1708020c3bc0, -27.046906, -48.878391, '2021-07-01 19:03:06'),
	(13, 'Thalles', 'Aguiar', 'stark@aguiar.com', 0, 'ATIVO', 'e10adc3949ba59abbe56e057f20f883e', '1996-02-18', 'M', '55984488864', 'olá, eu sou o Thalles', NULL, 'https://cf.shopee.com.br/file/9c4784b91814ae1b24dec91d05fc28a4', _binary 0x000000000101000000bbf1eec8586f48c0bbf083f3a90b3bc0, -27.045563, -48.869896, '2021-07-01 20:40:32'),
	(14, 'Tony', 'Stark', 'tony@stark.com', 0, 'ATIVO', 'e10adc3949ba59abbe56e057f20f883e', '1996-02-18', 'M', '55984488864', 'olá, eu sou o Thalles', NULL, 'https://cf.shopee.com.br/file/9c4784b91814ae1b24dec91d05fc28a4', _binary 0x000000000101000000bad7497d596f48c0c3baf1eec80c3bc0, -27.049940, -48.869919, '2021-07-01 20:41:40');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
