-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 26/07/2024 às 14:44
-- Versão do servidor: 10.6.18-MariaDB-0ubuntu0.22.04.1
-- Versão do PHP: 8.2.21

SET FOREIGN_KEY_CHECKS=0;
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

--
-- Despejando dados para a tabela `tb_categoria`
--

INSERT INTO `tb_categoria` (`id`, `id_parent`, `titulo`, `titulo_slug`, `descricao`, `icone`, `color`, `text_color`, `ordem`, `created_at`, `updated_at`, `status`) VALUES
(1, NULL, 'Página', 'page', NULL, NULL, NULL, NULL, 0, '2024-05-29 11:08:10', '2024-06-04 00:43:12', '1'),
(2, NULL, 'Postagem', 'post', NULL, NULL, NULL, NULL, 0, '2024-05-29 11:08:22', '2024-06-04 00:43:26', '1'),
(3, 2, 'Culto', 'culto', NULL, NULL, NULL, NULL, 0, '2024-05-29 11:16:07', '2024-06-04 00:43:44', '1'),
(4, 2, 'Ministério', 'ministerio', NULL, NULL, NULL, NULL, 0, '2024-05-29 11:50:52', '2024-06-04 00:43:50', '1'),
(5, 2, 'Evento', 'evento', NULL, NULL, NULL, NULL, 0, '2024-05-29 11:50:58', '2024-06-04 00:44:01', '1'),
(6, 2, 'Banner', 'banner', NULL, NULL, NULL, NULL, 0, '2024-06-04 00:44:17', '2024-06-04 00:44:17', '1'),
(7, 2, 'Apresentação', 'apresentacao', NULL, NULL, NULL, NULL, 0, '2024-06-04 01:32:15', '2024-06-04 01:39:30', '1'),
(8, NULL, 'Evento', 'e', NULL, NULL, NULL, NULL, 0, '2024-06-21 12:52:19', '2024-07-26 04:00:51', '1'),
(9, NULL, 'Agendamento', 'a', NULL, NULL, NULL, NULL, 0, '2024-07-07 01:15:59', '2024-07-26 04:00:45', '1'),
(10, NULL, 'Propósitos', 'proposito', NULL, NULL, NULL, NULL, 0, '2024-06-21 12:52:19', '2024-07-26 04:00:51', '1');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
