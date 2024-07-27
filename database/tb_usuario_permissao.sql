-- phpMyAdmin SQL Dump
-- version 5.2.1-1.el8.remi
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 27/07/2024 às 07:37
-- Versão do servidor: 10.11.7-MariaDB-log
-- Versão do PHP: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ibr_site`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuario_permissao`
--

CREATE TABLE `tb_usuario_permissao` (
  `id_categoria` bigint(11) UNSIGNED NOT NULL,
  `id_usuario` bigint(11) UNSIGNED NOT NULL,
  `permissao` enum('list','create','update','delete') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_usuario_permissao`
--
ALTER TABLE `tb_usuario_permissao`
  ADD UNIQUE KEY `premissao_UNIQUE` (`id_categoria`,`id_usuario`,`permissao`),
  ADD KEY `fk_tb_usuario_permissao_id_usuario` (`id_usuario`);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_usuario_permissao`
--
ALTER TABLE `tb_usuario_permissao`
  ADD CONSTRAINT `fk_tb_usuario_permissao_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_usuario_permissao_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
