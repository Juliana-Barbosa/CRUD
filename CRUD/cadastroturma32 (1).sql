-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/11/2024 às 16:43
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
-- Banco de dados: `cadastroturma32`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `telefone`, `email`, `senha`) VALUES
(26, 'Juliana Barbosa Martins', '67984741144', 'juliana29.bmartins@gmail.com', 'd9b1d7db4cd6e70935368a1efb10e377'),
(27, 'Gabriel Alvin', NULL, 'gab.gab@gmail.com', '$2y$10$6Tn27.w6wWLKBHhMH88m1up67'),
(28, 'Suelen', '88888888777', 'suelen@gmail.com', '$2y$10$ys0N63ZZbeEAxJG9FN00i.yAW'),
(29, 'Teste1', '12345678999', 'teste1@gmail.com', '$2y$10$Q80SvxbqWjOfVsf/GGXaPONeh'),
(30, 'Grazi', '12312312312', 'grazi@gmail.com', '$2y$10$br8YCIaRoqe890ttSTlNreYIN'),
(31, 'Fred', '22222222222', 'fred@gmail.com', '$2y$10$j4a7sPHW71cjNUt./AObZ.dTc'),
(32, 'Eliandro', '22222222222', 'eli@gmail.com', '$2y$10$NJ.Up.jq0koZDRYLEX0zAOoEp'),
(33, 'TesteFinal', '22222222222', 'final@gmail.com', '$2y$10$ZkhzHnvJbRqFiiwjeMepgO6ZB');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
