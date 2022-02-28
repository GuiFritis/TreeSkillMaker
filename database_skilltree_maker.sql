-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.1.72-community - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para treeskill
CREATE DATABASE IF NOT EXISTS `treeskill` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `treeskill`;

-- Copiando estrutura para tabela treeskill.classe
CREATE TABLE IF NOT EXISTS `classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `cor` char(6) CHARACTER SET latin1 DEFAULT NULL,
  `texto` tinyint(4) DEFAULT NULL,
  `descricao` text CHARACTER SET latin1,
  `id_jogo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela treeskill.jogo
CREATE TABLE IF NOT EXISTS `jogo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela treeskill.marcadores
CREATE TABLE IF NOT EXISTS `marcadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tabela` varchar(255) DEFAULT NULL,
  `valor` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela treeskill.skill
CREATE TABLE IF NOT EXISTS `skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` text,
  `ordem` int(11) DEFAULT NULL,
  `forma` int(11) DEFAULT NULL,
  `id_row` int(11) DEFAULT NULL,
  `id_skilltree` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela treeskill.skilltree
CREATE TABLE IF NOT EXISTS `skilltree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` text,
  `colunas` int(11) DEFAULT NULL,
  `id_classe` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela treeskill.skilltree_row
CREATE TABLE IF NOT EXISTS `skilltree_row` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nivel` int(11) DEFAULT NULL,
  `requirements` varchar(255) DEFAULT NULL,
  `id_skilltree` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
