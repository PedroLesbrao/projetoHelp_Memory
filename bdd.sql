-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 10-Dez-2021 às 13:08
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdd`
--
CREATE DATABASE IF NOT EXISTS `bdd` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bdd`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `anamnese`
--

DROP TABLE IF EXISTS `anamnese`;
CREATE TABLE IF NOT EXISTS `anamnese` (
  `codAna` int(11) NOT NULL AUTO_INCREMENT,
  `codUsu` int(11) NOT NULL,
  `altura` varchar(10) NOT NULL,
  `alergia` varchar(50) NOT NULL,
  `remedios` varchar(50) NOT NULL,
  `historicoPato` varchar(50) NOT NULL,
  `historicoSoci` varchar(50) NOT NULL,
  `sangue` varchar(10) NOT NULL,
  PRIMARY KEY (`codAna`),
  KEY `codUsu` (`codUsu`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

DROP TABLE IF EXISTS `historico`;
CREATE TABLE IF NOT EXISTS `historico` (
  `codHist` int(11) NOT NULL AUTO_INCREMENT,
  `codUsu` int(11) NOT NULL,
  `peso` varchar(10) NOT NULL,
  `historico` varchar(200) NOT NULL,
  `remedioHist` varchar(100) NOT NULL,
  `dataConsulta` varchar(11) NOT NULL,
  PRIMARY KEY (`codHist`),
  KEY `codUsu` (`codUsu`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `historico`
--

INSERT INTO `historico` (`codHist`, `codUsu`, `peso`, `historico`, `remedioHist`, `dataConsulta`) VALUES
(5, 76, '30,41', 'dores na garganta', 'paracetamol e ibuprofeno', '14/14/1414'),
(7, 78, '41,80', 'dores na garganta', 'paracetamol e ibuprofeno', '77/44/4441'),
(8, 78, '41,80', 'dores na garganta', 'paracetamol e ibuprofeno', '02/12/2000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `medico`
--

DROP TABLE IF EXISTS `medico`;
CREATE TABLE IF NOT EXISTS `medico` (
  `codMedico` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `datausu` varchar(15) NOT NULL,
  `telefone` varchar(25) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `foto` varchar(30) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`codMedico`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `medico`
--

INSERT INTO `medico` (`codMedico`, `nome`, `sobrenome`, `email`, `senha`, `datausu`, `telefone`, `genero`, `foto`, `cpf`, `create_date`) VALUES
(9, 'Help', 'Memory', 'HelpMemory@adm.com', 'SGVscE1lbW9yeQ==', '00/00/0000', '(00)00000-0000', 'Masculino', '000.000.000-00', '1639141120.png', '2021-12-10 12:58:40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `codUsu` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `datausu` varchar(15) NOT NULL,
  `telefone` varchar(25) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `foto` varchar(30) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`codUsu`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`codUsu`, `email`, `senha`, `nome`, `sobrenome`, `datausu`, `telefone`, `genero`, `foto`, `cpf`, `create_date`) VALUES
(79, 'asdrubal@gmail.com', '202cb962ac59075b964b07152d234b70', 'asdrubal', 'fernando', '11/11/1111', '(11)11111-1111', 'Masculino', '1639141547.jpg', '111.111.1111-11', '2021-12-10 13:05:47');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
