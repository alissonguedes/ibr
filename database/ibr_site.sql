-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 26/07/2024 às 14:46
-- Versão do servidor: 10.6.18-MariaDB-0ubuntu0.22.04.1
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
-- AUTO_INCREMENT de tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_cidade`
--
ALTER TABLE `tb_cidade`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_estado`
--
ALTER TABLE `tb_estado`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_evento`
--
ALTER TABLE `tb_evento`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_evento_categoria`
--
ALTER TABLE `tb_evento_categoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_inscricao_pagamento`
--
ALTER TABLE `tb_inscricao_pagamento`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_inscrito`
--
ALTER TABLE `tb_inscrito`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_pais`
--
ALTER TABLE `tb_pais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_pastor`
--
ALTER TABLE `tb_pastor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_post`
--
ALTER TABLE `tb_post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
