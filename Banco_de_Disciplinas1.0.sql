-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 31-Ago-2026 às 23:24
-- Versão do servidor: 8.0.45-0ubuntu0.22.04.1
-- versão do PHP: 8.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `Banco de Disciplinas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `Aluno`
--

CREATE TABLE `Aluno` (
  `matricula` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Disciplina`
--

CREATE TABLE `Disciplina` (
  `id` int NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sala` varchar(255) NOT NULL,
  `id_professor` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Faz`
--

CREATE TABLE `Faz` (
  `id` int NOT NULL,
  `matricula_aluno` varchar(255) DEFAULT NULL,
  `id_disciplina` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Professor`
--

CREATE TABLE `Professor` (
  `id` int NOT NULL,
  `nome` varchar(255) NOT NULL,
  `dia_de_atendimento` dayofweek NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `Aluno`
--
ALTER TABLE `Aluno`
  ADD PRIMARY KEY (`matricula`);

--
-- Índices para tabela `Disciplina`
--
ALTER TABLE `Disciplina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_professor` (`id_professor`);

--
-- Índices para tabela `Faz`
--
ALTER TABLE `Faz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matricula_aluno` (`matricula_aluno`),
  ADD KEY `id_disciplina` (`id_disciplina`);

--
-- Índices para tabela `Professor`
--
ALTER TABLE `Professor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `Disciplina`
--
ALTER TABLE `Disciplina`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Faz`
--
ALTER TABLE `Faz`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Professor`
--
ALTER TABLE `Professor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `Disciplina`
--
ALTER TABLE `Disciplina`
  ADD CONSTRAINT `fk_disciplina_professor` FOREIGN KEY (`id_professor`) REFERENCES `Professor` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `Faz`
--
ALTER TABLE `Faz`
  ADD CONSTRAINT `Faz_ibfk_1` FOREIGN KEY (`matricula_aluno`) REFERENCES `Aluno` (`matricula`),
  ADD CONSTRAINT `Faz_ibfk_2` FOREIGN KEY (`id_disciplina`) REFERENCES `Disciplina` (`id`);

ALTER TABLE `Professor` 
  MODIFY `dia_de_atendimento` ENUM('Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo') NOT NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
