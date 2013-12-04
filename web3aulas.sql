-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 02/12/2013 às 13h24min
-- Versão do Servidor: 5.5.34
-- Versão do PHP: 5.5.6-1+debphp.org~precise+2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `web3aulas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `autor`
--

CREATE TABLE IF NOT EXISTS `autor` (
  `cod` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT '''1''',
  `pais` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `autor`
--

INSERT INTO `autor` (`cod`, `nome`, `pais`) VALUES
(1, ' Maurício Samy Silva', 'Brasil'),
(2, 'Carlos Alberto Heuser', 'Brasil'),
(3, 'Paul Deitel', 'EUA'),
(4, 'Harvey Deitel', 'EUA'),
(5, 'Andy Budd', 'EUA'),
(6, 'Ramez Elmasri', 'EUA'),
(7, 'Shamkant Navathe', 'EUA'),
(8, 'David Barnes', 'EUA'),
(9, 'Michael Kolling', 'EUA'),
(10, 'Anil Hemrajani', NULL),
(11, 'Cay S. Horstmann', NULL),
(12, 'Gary Cornell', NULL),
(13, 'Stuart Russel', 'EUA'),
(14, 'Peter Norving', 'EUA'),
(15, 'Symon Haykin', 'EUA'),
(16, 'LYNN BEIGHLEY', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `editora`
--

CREATE TABLE IF NOT EXISTS `editora` (
  `cod` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `editora`
--

INSERT INTO `editora` (`cod`, `nome`) VALUES
(1, 'Pearson'),
(2, 'Elsevier'),
(3, 'Novatec'),
(4, 'Alta Books'),
(5, 'Bookman');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livroautor`
--

CREATE TABLE IF NOT EXISTS `livroautor` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `codLivro` int(10) NOT NULL,
  `codAutor` int(10) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `livro` (`codLivro`),
  KEY `autor` (`codAutor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `livroautor`
--

INSERT INTO `livroautor` (`cod`, `codLivro`, `codAutor`) VALUES
(1, 4, 3),
(2, 4, 4),
(3, 7, 8),
(4, 7, 9),
(5, 8, 11),
(6, 8, 12),
(7, 9, 10),
(8, 10, 6),
(9, 10, 7),
(10, 11, 13),
(11, 11, 14),
(12, 13, 5),
(13, 14, 15),
(14, 15, 16),
(15, 17, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

CREATE TABLE IF NOT EXISTS `livros` (
  `cod` int(10) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `edicao` int(2) NOT NULL DEFAULT '0',
  `idioma` char(2) DEFAULT '0',
  `exemplares` int(3) DEFAULT NULL,
  `codEditora` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cod`),
  KEY `editora` (`codEditora`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`cod`, `titulo`, `edicao`, `idioma`, `exemplares`, `codEditora`) VALUES
(4, 'Java Como Programar', 8, 'pt', 10, 1),
(7, 'Programação Orientada a Objetos com Java', 4, 'pt', 2, 1),
(8, 'Core java', 8, 'pt', 7, 1),
(9, 'Java com Spring, Hibernate e Eclipse', 1, 'pt', 3, 1),
(10, 'Sistema de banco de Dados', 6, 'pt', 1, 1),
(11, 'Inteligencia Artificial', 2, 'pt', 1, 2),
(12, 'Projeto de Banco de Dados', 6, 'pt', 1, 5),
(13, 'Criando Páginas Web com CSS', 1, 'pt', 3, 1),
(14, 'Neural Networks', 2, 'en', 5, 5),
(15, 'Use a cabeça - SQL', 1, 'pt', 2, 4),
(17, 'HTML5 - A linguagem de marcação que revolucionou a web', 1, 'pt', 1, 3);

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `livroautor`
--
ALTER TABLE `livroautor`
  ADD CONSTRAINT `livroautor_ibfk_1` FOREIGN KEY (`codLivro`) REFERENCES `livros` (`cod`),
  ADD CONSTRAINT `livroautor_ibfk_2` FOREIGN KEY (`codAutor`) REFERENCES `autor` (`cod`);

--
-- Restrições para a tabela `livros`
--
ALTER TABLE `livros`
  ADD CONSTRAINT `FK_livros_editora` FOREIGN KEY (`codEditora`) REFERENCES `editora` (`cod`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
