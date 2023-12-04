-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/12/2023 às 20:52
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `autoescola`
--
CREATE DATABASE IF NOT EXISTS `autoescola` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `autoescola`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `carro_id` int(11) NOT NULL,
  `data_aula` date NOT NULL,
  `horario_aula` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `carros`
--

CREATE TABLE `carros` (
  `id` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `ano` int(11) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `capacidade_passageiros` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carros`
--

INSERT INTO `carros` (`id`, `marca`, `modelo`, `ano`, `placa`, `capacidade_passageiros`) VALUES
(1, 'Volkswagen', 'Gol', 2022, 'ABC1234', 5),
(2, 'Ford', 'Fiesta', 2021, 'XYZ5678', 4),
(3, 'Chevrolet', 'Onix', 2023, 'DEF9876', 5),
(4, 'Toyota', 'Corolla', 2022, 'MNO5432', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `log_professores_carros`
--

CREATE TABLE `log_professores_carros` (
  `id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `carro_id` int(11) NOT NULL,
  `data_atribuicao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipos`
--

CREATE TABLE `tipos` (
  `id` int(1) NOT NULL,
  `tipoNome` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipos`
--

INSERT INTO `tipos` (`id`, `tipoNome`) VALUES
(1, 'Gerente'),
(2, 'Instrutor'),
(3, 'Aluno');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `data_nascimento` date NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `tipo` int(1) NOT NULL,
  `validado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `cpf`, `data_nascimento`, `endereco`, `telefone`, `email`, `senha`, `tipo`, `validado`) VALUES
(1, 'Maria Silva', '123.456.789-01', '1990-05-15', 'Rua A, 123', '(11) 98765-4321', 'maria@email.com', '', 3, 0),
(2, 'João Oliveira', '987.654.321-09', '1985-08-20', 'Avenida B, 456', '(22) 98765-1234', 'joao@email.com', '', 3, 0),
(3, 'Ana Souza', '555.555.555-55', '1995-02-10', 'Rua C, 789', '(33) 98765-5678', 'ana@email.com', '', 3, 0),
(4, 'Pedro Santos', '111.222.333-44', '1980-11-25', 'Avenida D, 987', '(44) 98765-8765', 'pedro@email.com', '', 3, 0),
(5, 'Camila Lima', '777.888.999-00', '1998-07-05', 'Rua E, 654', '(55) 98765-4321', 'camila@email.com', '', 3, 0),
(6, 'Carlos Silva', '111.222.333-44', '1975-03-10', 'Rua X, 123', '(11) 98765-4321', 'carlos@email.com', '', 2, 0);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `view_alunos`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `view_alunos` (
`id` int(11)
,`nome` varchar(100)
,`cpf` varchar(14)
,`data_nascimento` date
,`endereco` varchar(255)
,`telefone` varchar(15)
,`email` varchar(50)
,`senha` varchar(60)
,`tipo` int(1)
,`validado` int(1)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `view_professores`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `view_professores` (
`id` int(11)
,`nome` varchar(100)
,`cpf` varchar(14)
,`data_nascimento` date
,`endereco` varchar(255)
,`telefone` varchar(15)
,`email` varchar(50)
,`senha` varchar(60)
,`tipo` int(1)
,`validado` int(1)
);

-- --------------------------------------------------------

--
-- Estrutura para view `view_alunos`
--
DROP TABLE IF EXISTS `view_alunos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_alunos`  AS   (select `usuarios`.`id` AS `id`,`usuarios`.`nome` AS `nome`,`usuarios`.`cpf` AS `cpf`,`usuarios`.`data_nascimento` AS `data_nascimento`,`usuarios`.`endereco` AS `endereco`,`usuarios`.`telefone` AS `telefone`,`usuarios`.`email` AS `email`,`usuarios`.`senha` AS `senha`,`usuarios`.`tipo` AS `tipo`,`usuarios`.`validado` AS `validado` from `usuarios` where `usuarios`.`tipo` = 2)  ;

-- --------------------------------------------------------

--
-- Estrutura para view `view_professores`
--
DROP TABLE IF EXISTS `view_professores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_professores`  AS   (select `usuarios`.`id` AS `id`,`usuarios`.`nome` AS `nome`,`usuarios`.`cpf` AS `cpf`,`usuarios`.`data_nascimento` AS `data_nascimento`,`usuarios`.`endereco` AS `endereco`,`usuarios`.`telefone` AS `telefone`,`usuarios`.`email` AS `email`,`usuarios`.`senha` AS `senha`,`usuarios`.`tipo` AS `tipo`,`usuarios`.`validado` AS `validado` from `usuarios` where `usuarios`.`tipo` = 1)  ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `professor_id` (`professor_id`),
  ADD KEY `carro_id` (`carro_id`);

--
-- Índices de tabela `carros`
--
ALTER TABLE `carros`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `log_professores_carros`
--
ALTER TABLE `log_professores_carros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professor_id` (`professor_id`),
  ADD KEY `carro_id` (`carro_id`);

--
-- Índices de tabela `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo` (`tipo`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `carros`
--
ALTER TABLE `carros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `log_professores_carros`
--
ALTER TABLE `log_professores_carros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `agendamentos_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `agendamentos_ibfk_2` FOREIGN KEY (`professor_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `agendamentos_ibfk_3` FOREIGN KEY (`carro_id`) REFERENCES `carros` (`id`);

--
-- Restrições para tabelas `log_professores_carros`
--
ALTER TABLE `log_professores_carros`
  ADD CONSTRAINT `log_professores_carros_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `log_professores_carros_ibfk_2` FOREIGN KEY (`carro_id`) REFERENCES `carros` (`id`);

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
