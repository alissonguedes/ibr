-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 24/09/2024 às 19:54
-- Versão do servidor: 10.6.18-MariaDB-0ubuntu0.22.04.1-log
-- Versão do PHP: 8.2.21

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
-- Estrutura para tabela `tb_agenda`
--

CREATE TABLE `tb_agenda` (
  `id` int(11) UNSIGNED NOT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `tipo` enum('aniversario','culto','comemoracao') NOT NULL,
  `observacao` text DEFAULT NULL,
  `duracao` int(11) UNSIGNED DEFAULT NULL COMMENT 'A duração mínima entre os horários de agendamento em minutos (Padrão: 15 minutos)',
  `data` date DEFAULT NULL,
  `horarios` text NOT NULL,
  `tempo_min_agendamento` int(11) UNSIGNED DEFAULT NULL COMMENT 'O tempo mínimo de antecedência para reservar um horário em dias (Padrão: 30 dias)',
  `tempo_max_agendamento` int(11) UNSIGNED DEFAULT NULL COMMENT 'O tempo máximo de antecedência para reservar um horário em horas (Padrão: 1 hora)',
  `intervalo` int(11) UNSIGNED DEFAULT NULL COMMENT 'O intervalo entre horários disponíveis',
  `max_agendamento` int(11) UNSIGNED DEFAULT NULL COMMENT 'Número máximo de agendamentos por dia',
  `repetir` int(11) UNSIGNED DEFAULT NULL COMMENT 'Tempo em dias para repetir o evento. 0 - Não se repete; 1 - Diariamente; 2 - A cada 2 dias; 7 - Semanalmente; ... A cada X dias; ... 30 - Mensalmente; 365 - Anualmente...',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `atende` enum('S','N') NOT NULL DEFAULT 'S' COMMENT 'O médico pode determinar o campo como inativo durante este horário. Se ele atende ou não. Caso ele não atenda, ele pode definir como horário de almoço, por exemplo. Este campo é apenas um controle interno para o recepcionista visualizar.',
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela de cadastro de dias de atendimentos da agenda médica';

--
-- Despejando dados para a tabela `tb_agenda`
--

INSERT INTO `tb_agenda` (`id`, `titulo`, `tipo`, `observacao`, `duracao`, `data`, `horarios`, `tempo_min_agendamento`, `tempo_max_agendamento`, `intervalo`, `max_agendamento`, `repetir`, `created_at`, `updated_at`, `atende`, `status`) VALUES
(2, 'Culto de glorificação a Deus pelos 45 anos da ICM na Paraíba', 'comemoracao', NULL, 15, '2024-09-26', '{\"2024-09-26\":{\"inicio\":\"18:00:00\",\"fim\":\"21:00:00\"}}', NULL, NULL, NULL, NULL, 0, '2024-09-02 21:33:32', '2024-09-24 18:13:50', 'S', '1'),
(4, 'Pr. Walber', 'aniversario', NULL, 15, '2024-09-16', '2024-09-16', NULL, NULL, NULL, NULL, 0, '2024-09-02 21:38:03', '2024-09-24 18:02:18', 'S', '1'),
(6, 'Escola Bíblica Dominical', 'culto', NULL, NULL, '0000-00-00', '[[{\"inicio\":\"10:00:00\",\"fim\":\"11:00:00\"}]]', NULL, NULL, NULL, NULL, NULL, '2024-09-24 13:17:28', NULL, 'S', '1'),
(7, 'Estudo da Escola Bíblica Dominical', 'culto', NULL, NULL, '0000-00-00', '{\"2\":[{\"inicio\":\"19:30:00\",\"fim\":\"20:00:00\"}]}', NULL, NULL, NULL, NULL, NULL, '2024-09-24 13:17:44', '2024-09-24 13:17:50', 'S', '1'),
(8, 'Culto de Glorificação', 'culto', NULL, NULL, '0000-00-00', '{\"1\":[{\"inicio\":\"19:30:00\",\"fim\":\"20:00:00\"}]}', NULL, NULL, NULL, NULL, NULL, '2024-09-24 13:18:20', NULL, 'S', '1'),
(9, 'Culto de Senhoras', 'culto', NULL, NULL, '0000-00-00', '{\"3\":[{\"inicio\":\"19:30:00\",\"fim\":\"20:00:00\"}]}', NULL, NULL, NULL, NULL, NULL, '2024-09-24 13:19:28', '2024-09-24 13:19:55', 'S', '1'),
(10, 'Culto de Oração', 'culto', NULL, NULL, '0000-00-00', '{\"4\":[{\"inicio\":\"19:30:00\",\"fim\":\"20:00:00\"}]}', NULL, NULL, NULL, NULL, NULL, '2024-09-24 13:20:18', NULL, 'S', '1'),
(11, 'Culto da Família', 'culto', NULL, NULL, '0000-00-00', '{\"5\":[{\"inicio\":\"20:00:00\",\"fim\":\"20:30:00\"}]}', NULL, NULL, NULL, NULL, NULL, '2024-09-24 13:20:44', NULL, 'S', '1'),
(12, 'Culto de evangelização', 'culto', NULL, NULL, NULL, '{\"0\":[{\"inicio\":\"19:00:00\",\"fim\":\"19:30:00\"}],\"6\":[{\"inicio\":\"19:00:00\",\"fim\":\"19:30:00\"}]}', NULL, NULL, NULL, NULL, NULL, '2024-09-24 13:21:19', '2024-09-24 19:04:12', 'S', '1'),
(17, 'Alisson Guedes', 'aniversario', NULL, NULL, '1987-01-18', '1987-01-18', NULL, NULL, NULL, NULL, NULL, '2024-09-24 18:14:21', NULL, 'S', '1'),
(18, 'ts', 'comemoracao', NULL, NULL, '2025-01-23', '{\"2025-01-23\":{\"inicio\":\"00:30:00\",\"fim\":\"23:30:00\"}}', NULL, NULL, NULL, NULL, NULL, '2024-09-24 18:27:21', NULL, 'S', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_categoria`
--

CREATE TABLE `tb_categoria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_parent` bigint(20) UNSIGNED DEFAULT NULL,
  `titulo` varchar(100) NOT NULL,
  `titulo_slug` varchar(100) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `icone` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT '#ffffff',
  `text_color` varchar(50) DEFAULT '#000000',
  `ordem` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cidade`
--

CREATE TABLE `tb_cidade` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pais` bigint(20) UNSIGNED NOT NULL,
  `id_estado` bigint(20) UNSIGNED NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_config`
--

CREATE TABLE `tb_config` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Número sequencial da tabela.',
  `config` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL COMMENT 'Endereço do website',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela de configurações do site';

--
-- Despejando dados para a tabela `tb_config`
--

INSERT INTO `tb_config` (`id`, `config`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_logo', NULL, '2021-03-09 22:55:51', '2023-10-18 05:46:55'),
(2, 'original_logo_name', NULL, '2021-03-09 22:55:51', '2023-10-18 05:46:55'),
(3, 'site_title', 'Igreja Batista Renovada', '2021-03-09 22:55:51', '2024-08-26 19:27:21'),
(4, 'site_url', NULL, '2021-03-09 22:55:51', '2021-03-09 22:55:51'),
(5, 'language', 'pt-br', '2021-03-09 22:55:51', '2023-10-18 05:42:05'),
(6, 'contact_email', NULL, '2021-03-09 22:55:51', '2024-08-26 19:58:11'),
(7, 'contact_phone', NULL, '2021-03-09 22:55:51', '2024-08-26 19:58:09'),
(8, 'contact_cel', NULL, '2021-03-09 22:55:51', '2024-08-26 19:57:38'),
(9, 'facebook', NULL, '2021-03-09 22:55:51', '2024-08-26 19:22:33'),
(10, 'instagram', 'https://www.instagram.com/igrejabatistarenovadajp', '2021-03-09 22:55:51', '2024-08-26 19:56:48'),
(11, 'linkedin', NULL, '2021-03-09 22:55:51', '2024-08-26 19:22:33'),
(12, 'address', NULL, '2021-03-09 22:55:51', '2024-08-26 19:57:22'),
(13, 'address_nro', NULL, '2021-03-09 22:55:51', '2024-08-26 19:57:22'),
(14, 'cep', NULL, '2021-03-09 22:55:51', '2024-08-26 19:57:22'),
(15, 'complemento', NULL, '2021-03-09 22:55:51', '2024-08-26 19:22:33'),
(16, 'bairro', NULL, '2021-03-09 22:55:51', '2024-08-26 19:57:22'),
(17, 'cidade', NULL, '2021-03-09 22:55:51', '2024-08-26 19:57:22'),
(18, 'uf', NULL, '2021-03-09 22:55:51', '2024-08-26 19:57:22'),
(19, 'gmaps', NULL, '2021-03-09 22:55:51', '2024-08-26 19:22:33'),
(20, 'site_description', NULL, '2021-03-09 23:00:20', '2024-08-26 19:58:18'),
(21, 'site_tags', NULL, '2021-03-09 23:08:48', '2023-10-18 05:32:09'),
(22, 'pais', NULL, '2021-07-28 23:40:46', '2024-08-26 19:57:22'),
(24, 'youtube', 'https://www.youtube.com/@igrejabatistarenovadajp', '2024-08-26 20:01:22', '2024-09-02 10:58:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_estado`
--

CREATE TABLE `tb_estado` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pais` bigint(20) UNSIGNED NOT NULL,
  `estado` varchar(50) NOT NULL,
  `uf` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_evento`
--

CREATE TABLE `tb_evento` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_categoria` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `evento` varchar(255) NOT NULL,
  `evento_slug` varchar(255) NOT NULL,
  `tipo` enum('A','E') NOT NULL DEFAULT 'E',
  `subtipo` enum('evento','aniversario','culto','comemoracao') DEFAULT 'evento',
  `descricao` longtext DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `video` longtext DEFAULT NULL,
  `local_evento` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `data_ini` datetime NOT NULL,
  `data_fim` datetime NOT NULL,
  `dia_inteiro` enum('0','1') NOT NULL DEFAULT '0',
  `inscricao_encerrada` enum('0','1') NOT NULL DEFAULT '0',
  `data_inscricao_ini` datetime NOT NULL,
  `data_inscricao_fim` datetime NOT NULL,
  `observacao` text DEFAULT NULL,
  `recorrencia` enum('0','1') NOT NULL DEFAULT '0',
  `recorrencia_periodo` int(11) NOT NULL DEFAULT 0,
  `recorrencia_limite` int(11) NOT NULL DEFAULT 0,
  `cor` varchar(25) NOT NULL DEFAULT '#ffffff',
  `autor` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `publish_up` datetime DEFAULT NULL,
  `publish_down` datetime DEFAULT NULL,
  `vagas` int(11) NOT NULL DEFAULT -1 COMMENT 'Se -1, as vagas são ilimitadas.',
  `gratuito` tinyint(1) NOT NULL DEFAULT 0,
  `valor` decimal(10,3) NOT NULL DEFAULT 0.000,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tb_evento`
--

INSERT INTO `tb_evento` (`id`, `id_categoria`, `evento`, `evento_slug`, `tipo`, `subtipo`, `descricao`, `image`, `video`, `local_evento`, `endereco`, `data_ini`, `data_fim`, `dia_inteiro`, `inscricao_encerrada`, `data_inscricao_ini`, `data_inscricao_fim`, `observacao`, `recorrencia`, `recorrencia_periodo`, `recorrencia_limite`, `cor`, `autor`, `created_at`, `updated_at`, `publish_up`, `publish_down`, `vagas`, `gratuito`, `valor`, `status`) VALUES
(5, 1, 'Evangelização de Crianças, Intermediários e Adolescentes', 'evangelizacao-de-criancas-intermediarios-e-adolescentes', 'E', 'evento', NULL, NULL, NULL, 'Teste', 'Teste', '2024-07-27 00:00:00', '2024-07-27 23:59:59', '0', '0', '2024-07-16 00:00:00', '2024-07-25 23:59:59', NULL, '0', 0, 0, '#ffffff', 1, '2024-06-22 16:03:15', '2024-07-23 16:02:51', NULL, NULL, -1, 0, '0.000', '1'),
(6, 1, 'Teste', 'teste', 'E', 'evento', NULL, NULL, NULL, 'teste', 'teste', '2024-07-23 00:00:00', '2024-07-23 23:59:59', '0', '0', '2024-07-23 00:00:00', '2024-07-23 23:59:59', NULL, '0', 0, 0, '#ffffff', 1, '2024-06-29 22:48:52', '2024-07-23 15:18:46', NULL, NULL, -1, 0, '0.000', '1'),
(7, 1, 'Evento Editado 2', 'evento-editado-2', 'A', 'evento', NULL, NULL, NULL, 'Teste', 'Teste', '2024-07-17 00:00:00', '2024-07-18 23:59:59', '0', '0', '2024-09-01 00:00:00', '2024-10-05 23:59:59', NULL, '0', 0, 0, '#ffffff', 1, '2024-06-22 16:03:15', '2024-07-29 16:39:20', NULL, NULL, -1, 0, '0.000', '1'),
(9, 1, 'Evento editado', 'evento-editado', 'A', 'evento', NULL, NULL, NULL, 'Teste', 'Teste', '2024-06-13 00:00:00', '2024-06-14 23:59:59', '0', '0', '2024-09-01 00:00:00', '2024-10-05 23:59:59', NULL, '0', 0, 0, '#ffffff', 1, '2024-06-22 16:03:15', '2024-07-29 16:39:00', NULL, NULL, -1, 0, '0.000', '1'),
(11, 1, 'Teste', 'teste', 'A', 'culto', '<p>Teste</p>', NULL, NULL, 'Rua', 'Local', '2024-07-10 00:00:00', '2024-07-13 23:59:59', '0', '0', '2024-07-02 00:00:00', '2024-07-13 23:59:59', NULL, '0', 0, 0, '#ffffff', 1, '2024-07-09 05:22:30', '2024-07-14 13:10:22', NULL, NULL, -1, 0, '0.000', '1'),
(12, 1, 'Novo evento', 'novo-evento', 'A', 'comemoracao', '<p>Teste</p>', NULL, NULL, 'Teste', 'teste', '2024-07-31 00:00:00', '2024-08-03 23:59:59', '0', '0', '2024-07-31 00:00:00', '2024-08-21 23:59:59', NULL, '0', 0, 0, '#ffffff', 1, '2024-07-14 13:11:25', '2024-07-29 16:09:18', NULL, NULL, -1, 0, '0.000', '0'),
(13, 1, 'Aniversário do Pastor Walber', 'aniversario-do-pastor-walber', 'A', 'aniversario', '<p>Anivers&aacute;rio do Pastor Walber</p>', NULL, NULL, 'IBR', 'IBR', '2024-07-31 00:00:00', '2024-07-31 23:59:59', '0', '1', '2024-07-23 00:00:00', '2024-07-23 23:59:59', NULL, '0', 0, 0, '#ffffff', 1, '2024-07-23 21:21:04', '2024-07-23 21:21:04', NULL, NULL, -1, 0, '0.000', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_evento_categoria`
--

CREATE TABLE `tb_evento_categoria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `descricao_slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tb_evento_categoria`
--

INSERT INTO `tb_evento_categoria` (`id`, `titulo`, `descricao`, `descricao_slug`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Padrão', 'Categoria padrão. Sem restrições.', 'padrao', 'stars', '2024-06-21 15:07:39', '2024-06-21 15:07:39'),
(2, 'Agendamento', 'Agendamento', 'agendamento', 'calendar_event', '2024-06-21 15:07:39', '2024-06-21 15:07:39'),
(3, 'Aniversário', 'Aniversário', 'aniversario', 'cake', '2024-06-21 15:07:39', '2024-06-21 15:07:39'),
(4, 'Tarefa', 'Tarefa', 'tarefa', 'task_alt', '2024-06-21 15:07:39', '2024-06-21 15:07:39'),
(5, 'Comemoração', 'Comemoração', 'comemoracao', 'celebration', '2024-06-21 15:07:39', '2024-06-21 15:07:39');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_file`
--

CREATE TABLE `tb_file` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_object` bigint(20) NOT NULL,
  `categoria` varchar(50) NOT NULL DEFAULT 'post' COMMENT 'Determina qual é a categoria de arquivo',
  `key` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `imgname` varchar(255) NOT NULL,
  `imgtype` varchar(255) NOT NULL,
  `imgsize` int(11) NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `hits` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_file_chunk`
--

CREATE TABLE `tb_file_chunk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_file` bigint(20) NOT NULL,
  `id_chunk` int(11) NOT NULL,
  `filedata` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_inscricao`
--

CREATE TABLE `tb_inscricao` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_evento` bigint(20) UNSIGNED NOT NULL,
  `id_inscrito` bigint(20) UNSIGNED NOT NULL,
  `codigo_inscricao` varchar(100) NOT NULL,
  `status` enum('C','0','1','X') NOT NULL DEFAULT '0' COMMENT 'C - Cancelada, 0 - Pendente de confirmação, 1 - Confirmado/Aceito, X - Não aceito',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tb_inscricao`
--

INSERT INTO `tb_inscricao` (`id`, `id_evento`, `id_inscrito`, `codigo_inscricao`, `status`, `created_at`, `updated_at`) VALUES
(2, 5, 1, '8213756677208391f00', '0', '2024-06-22 16:05:39', '2024-06-22 16:05:39'),
(3, 5, 2, '21424366773060db587', '0', '2024-06-22 17:13:20', '2024-06-22 17:13:20');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_inscricao_pagamento`
--

CREATE TABLE `tb_inscricao_pagamento` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_inscricao` bigint(20) UNSIGNED NOT NULL,
  `data_pagamento` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `valor_pago` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_inscrito`
--

CREATE TABLE `tb_inscrito` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_uf` bigint(20) UNSIGNED NOT NULL,
  `id_cidade` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `rg` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tb_inscrito`
--

INSERT INTO `tb_inscrito` (`id`, `id_uf`, `id_cidade`, `nome`, `cpf`, `rg`, `email`, `telefone`, `created_at`, `updated_at`) VALUES
(1, 2552, 57556, 'Alisson Guedes Pereira', '06942292451', '3177241', 'alissonguedes87@gmail.com', '83987752444', '2024-06-22 15:55:27', '2024-06-22 16:05:39'),
(2, 2552, 20371, 'Aline Guedes Pereira', '12345678910', '123456', 'alineguedes@gmail.com', '83988888888', '2024-06-22 17:13:20', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_pais`
--

CREATE TABLE `tb_pais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo` varchar(2) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_pastor`
--

CREATE TABLE `tb_pastor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tb_pastor`
--

INSERT INTO `tb_pastor` (`id`, `nome`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Pr. Walber', '2024-05-27 19:09:59', '2024-07-29 16:33:42', '1'),
(6, 'Pr. Tito', '2024-05-28 14:56:25', '2024-05-28 14:56:25', '1'),
(7, 'Bp. Pedro', '2024-05-28 14:56:48', '2024-05-28 14:56:48', '1'),
(8, 'Ev. Marcelo Cardozo', '2024-05-28 14:57:15', '2024-05-28 14:57:15', '1'),
(9, 'Rv. Ícaro Vasconcelos', '2024-05-28 14:57:45', '2024-05-28 14:57:45', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_post`
--

CREATE TABLE `tb_post` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_parent` bigint(20) DEFAULT NULL,
  `autor` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `titulo_slug` varchar(255) NOT NULL,
  `tipo` varchar(255) DEFAULT NULL COMMENT 'Determina qual é o tipo de postagem',
  `categoria` varchar(100) DEFAULT NULL COMMENT 'Determina qual é a categoria das postagem',
  `subtitulo` varchar(255) DEFAULT NULL,
  `conteudo` longtext DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `url` longtext DEFAULT NULL,
  `texto_url` varchar(100) DEFAULT NULL,
  `hits` int(11) NOT NULL DEFAULT 0,
  `ordem` int(11) NOT NULL DEFAULT 0,
  `publish_up` datetime DEFAULT NULL,
  `publish_down` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tb_post`
--

INSERT INTO `tb_post` (`id`, `id_parent`, `autor`, `titulo`, `titulo_slug`, `tipo`, `categoria`, `subtitulo`, `conteudo`, `data`, `tags`, `url`, `texto_url`, `hits`, `ordem`, `publish_up`, `publish_down`, `created_at`, `updated_at`, `status`) VALUES
(2, NULL, '1', 'Main Banner', 'slideshow-container', 'post', 'banner', NULL, NULL, NULL, NULL, NULL, '', 0, 0, NULL, NULL, '2024-05-26 10:32:37', '2024-06-06 12:04:52', '1'),
(5, NULL, '1', 'Apresentação', 'apresentacao', 'page', 'apresentacao', 'Teste', '<p>teste</p>', NULL, NULL, NULL, '', 0, 0, NULL, NULL, '2024-05-27 19:14:50', '2024-05-27 19:14:50', '1'),
(6, 5, '1', 'O que acreditamos', 'o-que-acreditamos', 'post', 'apresentacao', 'A fé é o firme fundamento das coisas que não se vêem.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi porta arcu in velit pulvinar, ac consectetur risus elementum. Nullam hendrerit eleifend erat, quis fringilla ligula consequat ut. Etiam tempor finibus venenatis. Nam in aliquet ex. Duis egestas non mauris eget suscipit. Pellentesque habitant morbi tristique.</p>', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, '2024-05-27 19:09:21', '2024-07-29 16:33:13', '1'),
(7, 20, '1', 'Homem de Fé', 'a-ibr', 'post', 'post', 'Leonardo Aquino', '<p id=\"isPasted\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae eleifend nulla. Mauris porta venenatis orci id consectetur. Proin tincidunt, lacus a ornare facilisis, lectus nibh scelerisque elit, et lobortis odio augue sed tellus. Suspendisse efficitur ultrices lorem, vel molestie tortor congue sit amet. Suspendisse lobortis vestibulum tellus, cursus consequat purus consectetur a. Ut pharetra orci vitae dui consequat, a placerat eros feugiat. Nullam vitae lacus et ipsum sagittis faucibus.</p><p><br></p>', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, '2024-05-28 01:03:27', '2024-07-29 16:36:08', '1'),
(14, 8, '1', 'Será num abrir de olhos - Igreja Cristã Maranata', 'sera-num-abrir-de-olhos-igreja-crista-maranata', 'post', 'culto', 'Pr. Daniel Moreira', '<p id=\"isPasted\">É expressamente PROIBIDA a reprodução TOTAL ou PARCIAL. LEI DE DIREITOS AUTORAIS, LEI Nº 9.610/98: \"CANAL OFICIAL\" Transmissão especial da Igreja Cristã Maranata, transmitido no dia 02 de Junho de 2024. Inscreva-se no canal clicando no botão Inscrever. Ative o 🔔 para ser notificado do começo das transmissões ao vivo e também deixe sua curtida 👍🏻 para que mais e mais pessoas possam receber este vídeo. Todos os dias, neste canal, você encontrará mensagens bíblicas, estudos e cultos, incluindo transmissões ao vivo.</p><p><br></p><p>Conheça mais sobre a Igreja Cristã Maranata acessando o site: <a data-fr-linked=\"true\" href=\"https://www.igrejacristamaranata.org.br\">https://www.igrejacristamaranata.org.br</a></p><p><br></p><p>Siga também nas redes sociais:</p><p><br></p><p>Facebook: <a href=\"https://fb.com/igrejacristamaranata\">https://fb.com/igrejacristamaranata</a></p><p>Instagram: <a href=\"https://instagram.com/igrejacristamaranata\">https://instagram.com/igrejacristamaranata</a></p><p><br></p><p>Você ou sua família precisa de oração? Ligue para 0800 707 3076 e seja atendido por um grupo de irmãos prontos para te dar toda a assistência espiritual necessária.</p>', '2024-04-05 00:00:00', NULL, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/mlH9pqxA6I4?si=XqPSYHgEQfWtivPG\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', NULL, 0, 0, NULL, NULL, '2024-06-02 15:58:02', '2024-07-29 16:37:21', '0'),
(15, 8, '1', '[TRANSMISSÃO ESPECIAL 15h] - 02/06/2024 - Igreja Cristã Maranata - Igrejas do Brasil', 'transmissao-especial-15h-02-06-2024-igreja-crista-maranata-igrejas-do-brasil', 'post', 'culto', 'Pr. Felipe', '<p><span style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; white-space: pre-wrap;\" id=\"isPasted\"><span style=\"margin: 0px; padding: 0px; border: 0px; background: transparent;\">É expressamente PROIBIDA a reprodução TOTAL ou PARCIAL. LEI DE DIREITOS AUTORAIS, LEI Nº 9.610/98: \"CANAL OFICIAL\" Transmissão especial da Igreja Cristã Maranata, transmitido no dia 02 de Junho de 2024. Inscreva-se no canal clicando no botão Inscrever. Ative o 🔔 para ser notificado do começo das transmissões ao vivo e também deixe sua curtida 👍🏻 para que mais e mais pessoas possam receber este vídeo. Todos os dias, neste canal, você encontrará mensagens bíblicas, estudos e cultos, incluindo transmissões ao vivo. Conheça mais sobre a Igreja Cristã Maranata acessando o site:&nbsp;<a tabindex=\"0\" href=\"https://www.youtube.com/redirect?event=video_description&redir_token=QUFFLUhqa3I3UEtjTFFXZWdQaFZxM2FldmdZbFZMSjhDd3xBQ3Jtc0tsdl9VLTZ2bTctd0lRTy1MM3JSTnFZUENnTjYyNFN1QkhfWllOU0Etb3FaU3UxRWhZaEVmNVVPR0lVOHlNNVlqeGZXdmVlM1ZjMFdiX0hZM3owd1pXdDZMZElhR1J4dkx1YWhLQXNINE9QcVNWVkNvaw&q=https%3A%2F%2Fwww.igrejacristamaranata.org.br%2F&v=xEWtuwvyyKM\" rel=\"nofollow\" target=\"_blank\" style=\"text-decoration: none; display: inline; color: inherit;\">https://www.igrejacristamaranata.org.br</a>Siga também nas redes sociais:Facebook:&nbsp;<a tabindex=\"0\" href=\"https://www.youtube.com/redirect?event=video_description&redir_token=QUFFLUhqbG02dzdrVktlaFdldWt4TDhsdmwteWI1TzZNZ3xBQ3Jtc0ttS2VKTmtkcWh0Mk96V082MmFIT3NPZHlXb1NfSUp3M3R0dnJKZk13d1dTdVdaVm9FaHQ3Vzd4a3dHTTRYcnNuQmdiaUVtLXFYbGk5UjNNd1VLbmRBckdCRFdlZlhnbS1sSTJ6NGlEdmpRX1dhYjlSbw&q=http%3A%2F%2Ffb.com%2Figrejacristamaranata&v=xEWtuwvyyKM\" rel=\"nofollow\" target=\"_blank\" style=\"text-decoration: none; display: inline; color: inherit;\">http://fb.com/igrejacristamaranata</a>Instagram:&nbsp;<span style=\"margin: 0px; padding: 0px 0px 1px; border: 0px; background: rgba(0, 0, 0, 0.05); border-radius: 8px;\"><a tabindex=\"0\" href=\"https://www.youtube.com/redirect?event=video_description&redir_token=QUFFLUhqbGs0MkJhMnVZT2p6ZUhmYVBSUnJrbUZDWGFWZ3xBQ3Jtc0ttSElyUnYwX1Z6Ynlqb0FISDU5X21WVy1WOEdUU2JCSC00dUs3MHUyOGdQYjhkX1dxZ192VldDbVBxeHgwMWZQc3kxZ1AyZmxMV3Vld3lEWFVpaVlfNGxjQzRNOVNpa3JuMWUzSzRGRTBOSWgzdTFQWQ&q=http%3A%2F%2Finstagram.com%2Figrejacristamaraoficial&v=xEWtuwvyyKM\" rel=\"nofollow\" target=\"_blank\" style=\"text-decoration: none; display: inline-flex; color: inherit; align-items: center;\">&nbsp;<span style=\"margin: 0.5px 0px 0px; padding: 0px; border: 0px; background: transparent; display: inline-flex; height: 1.4em; vertical-align: middle;\"><img alt=\"\" src=\"blob:http://localhost/31153f13-659a-4ad6-983c-56859d7ac69d\" style=\"padding: 0px; border: 0px; background: transparent; align-self: center; visibility: inherit; min-height: 1px; min-width: 1px; object-fit: fill; height: 14px; width: 14px;\" class=\"fr-fil fr-dib\"></span> / igrejacristamaraoficial &nbsp;</a></span>Você ou sua família precisa de oração? Ligue para 0800 707 3076 e seja atendido por um grupo de irmãos prontos para te dar toda a assistência espiritual necessária.</span></span></p><div style=\"margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); white-space: pre-wrap; color: rgb(15, 15, 15); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><br></div><div style=\"margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); color: rgb(15, 15, 15); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><div style=\"margin: 0px; padding: 0px; border: 0px; background: transparent;\"><div style=\"margin: 0px; padding: 0px; border: 0px; background: transparent; display: flex; flex-direction: row;\"><br></div></div></div>', '2024-06-02 00:00:00', NULL, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/xEWtuwvyyKM?si=DFdHPjoRUJwi5r0l\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', NULL, 0, 0, NULL, NULL, '2024-06-02 17:14:46', '2024-07-29 16:37:26', '0'),
(17, 4, '1', 'asdf', 'asdf', 'post', 'banner', 'asdfas', '<p>asdf</p>', NULL, NULL, NULL, '', 0, 0, NULL, NULL, '2024-06-04 01:46:51', '2024-06-04 01:46:51', '1'),
(20, NULL, '1', 'Homem de Fé', 'a-ibr', 'post', 'post', 'Leonardo Aquino', '<p id=\"isPasted\" style=\"text-align: right;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae eleifend nulla. Mauris porta venenatis orci id consectetur. Proin tincidunt, lacus a ornare facilisis, lectus nibh scelerisque elit, et lobortis odio augue sed tellus. Suspendisse efficitur ultrices lorem, vel molestie tortor congue sit amet. Suspendisse lobortis vestibulum tellus, cursus consequat purus consectetur a. Ut pharetra orci vitae dui consequat, a placerat eros feugiat. Nullam vitae lacus et ipsum sagittis faucibus.</p><p><br></p>', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, '2024-06-06 12:18:26', '2024-07-29 16:36:18', '1'),
(21, 13, '1', 'Connect', 'connect', 'post', 'ministerio', 'Ministério de Comunicação', NULL, NULL, NULL, NULL, '', 0, 0, NULL, NULL, '2024-06-19 15:28:44', '2024-06-19 15:28:44', '1'),
(23, NULL, '1', 'Nosso novo Templo', 'nosso-novo-templo', 'post', 'proposito', NULL, '<p>teste</p>', NULL, NULL, 'http://teste.com', 'Faça a sua oferta', 0, 0, NULL, NULL, '2024-07-23 16:48:47', '2024-07-29 16:35:17', '1'),
(27, 2, '1', 'Teste', 'teste', 'post', 'banner', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, '2024-07-29 16:32:53', '2024-08-26 15:04:15', '1'),
(28, 13, '1', 'Ministério de Louvor 2', 'ministerio-de-louvor-2', 'post', 'ministerio', 'Ministério de Louvor 2', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, '2024-07-29 16:37:00', '2024-07-29 16:37:00', '1'),
(29, NULL, '1', 'Novo culto', 'novo-culto', 'post', 'culto', 'Novo culto', '<p>Novo culto</p>', '2024-07-17 00:00:00', NULL, 'http://teste.com', NULL, 0, 0, NULL, NULL, '2024-07-29 16:37:52', '2024-07-29 16:37:52', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nivel` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`id`, `nivel`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(1, 'root', 'Alisson Guedes Pereira', 'alissonguedes87@gmail.com', NULL, '$2y$12$takucIxCJiHpqnDyh9tkP.i4hHizJXjInNG6q3Lk34hZ6tiIo0Aku', NULL, '2024-05-16 03:57:32', '2024-07-25 20:44:47', '1');

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
-- Despejando dados para a tabela `tb_usuario_permissao`
--

INSERT INTO `tb_usuario_permissao` (`id_categoria`, `id_usuario`, `permissao`) VALUES
(2, 1, 'list'),
(2, 1, 'create'),
(2, 1, 'update'),
(2, 1, 'delete');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_agenda`
--
ALTER TABLE `tb_agenda`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ibr_site_tb_categoria_titulo_slug_unique` (`titulo_slug`);

--
-- Índices de tabela `tb_cidade`
--
ALTER TABLE `tb_cidade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_cidade_id_pais_foreign` (`id_pais`),
  ADD KEY `tb_cidade_id_estado_foreign` (`id_estado`);

--
-- Índices de tabela `tb_config`
--
ALTER TABLE `tb_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`config`);

--
-- Índices de tabela `tb_estado`
--
ALTER TABLE `tb_estado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_estado_id_pais_foreign` (`id_pais`);

--
-- Índices de tabela `tb_evento`
--
ALTER TABLE `tb_evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ibr_site_tb_evento_id_categoria_foreign` (`id_categoria`);

--
-- Índices de tabela `tb_evento_categoria`
--
ALTER TABLE `tb_evento_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_file`
--
ALTER TABLE `tb_file`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_file_chunk`
--
ALTER TABLE `tb_file_chunk`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_inscricao`
--
ALTER TABLE `tb_inscricao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ibr_site_tb_inscricao_id_evento_foreign` (`id_evento`),
  ADD KEY `ibr_site_tb_inscricao_id_inscrito_foreign` (`id_inscrito`);

--
-- Índices de tabela `tb_inscricao_pagamento`
--
ALTER TABLE `tb_inscricao_pagamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ibr_site_tb_inscricao_pagamento_id_inscricao_foreign` (`id_inscricao`);

--
-- Índices de tabela `tb_inscrito`
--
ALTER TABLE `tb_inscrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ibr_site_tb_inscrito_id_uf_foreign` (`id_uf`),
  ADD KEY `ibr_site_tb_inscrito_id_cidade_foreign` (`id_cidade`);

--
-- Índices de tabela `tb_pais`
--
ALTER TABLE `tb_pais`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_pastor`
--
ALTER TABLE `tb_pastor`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_post`
--
ALTER TABLE `tb_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ibr_site_tb_post_tipo_foreign` (`tipo`),
  ADD KEY `ibr_site_tb_post_categoria_foreign` (`categoria`);

--
-- Índices de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ibr_site_tb_usuario_email_unique` (`email`);

--
-- Índices de tabela `tb_usuario_permissao`
--
ALTER TABLE `tb_usuario_permissao`
  ADD UNIQUE KEY `premissao_UNIQUE` (`id_categoria`,`id_usuario`,`permissao`),
  ADD KEY `fk_tb_usuario_permissao_id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_agenda`
--
ALTER TABLE `tb_agenda`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_cidade`
--
ALTER TABLE `tb_cidade`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_config`
--
ALTER TABLE `tb_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Número sequencial da tabela.', AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `tb_estado`
--
ALTER TABLE `tb_estado`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_evento`
--
ALTER TABLE `tb_evento`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tb_evento_categoria`
--
ALTER TABLE `tb_evento_categoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_file`
--
ALTER TABLE `tb_file`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_file_chunk`
--
ALTER TABLE `tb_file_chunk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_inscricao`
--
ALTER TABLE `tb_inscricao`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_inscricao_pagamento`
--
ALTER TABLE `tb_inscricao_pagamento`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_inscrito`
--
ALTER TABLE `tb_inscrito`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_pais`
--
ALTER TABLE `tb_pais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_pastor`
--
ALTER TABLE `tb_pastor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tb_post`
--
ALTER TABLE `tb_post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_estado`
--
ALTER TABLE `tb_estado`
  ADD CONSTRAINT `tb_estado_id_pais_foreign` FOREIGN KEY (`id_pais`) REFERENCES `tb_pais` (`id`);

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
