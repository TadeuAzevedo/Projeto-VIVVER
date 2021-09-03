-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Set-2021 às 19:59
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `programacaosemanalteste`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alocacao`
--

CREATE TABLE `alocacao` (
  `id` bigint(20) NOT NULL,
  `transporte` varchar(40) NOT NULL,
  `finalidade` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `alocacao`
--

INSERT INTO `alocacao` (`id`, `transporte`, `finalidade`) VALUES
(1, 'Ônibus', 'Suporte Técnico'),
(2, 'Ônibus', 'Projeto'),
(3, 'Veículo da Empresa', 'Implantação'),
(4, 'Veículo Próprio', 'Suporte Técnico'),
(5, 'Veículo Locado', 'Projeto'),
(6, 'Veículo Locado', 'Projeto'),
(7, 'Ônibus', 'Suporte Técnico'),
(8, 'Moto Táxi', 'Projeto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastrocolaborador`
--

CREATE TABLE `cadastrocolaborador` (
  `id` bigint(20) NOT NULL,
  `nomeCompleto` varchar(50) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `setor` int(11) NOT NULL,
  `imagem` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cadastrocolaborador`
--

INSERT INTO `cadastrocolaborador` (`id`, `nomeCompleto`, `usuario`, `senha`, `telefone`, `email`, `setor`, `imagem`) VALUES
(4, 'Coordenador', 'coordenador', '123', '(31) 99275-0196', 'tadeu.cruz@vivver.com.br', 4, '61044a9b534576.66285086.jpg'),
(9, 'Anderson Augusto Cruz', 'anderson.augusto', '123', '(31) 98500-3117', 'anderson.augusto@email', 1, 'default.jpg'),
(10, 'André Luiz de Pereira de Paula', 'andre.pereira', '123', '(38) 99949-1419', 'andre.pereira@email', 1, 'default.jpg'),
(11, 'Breno Bernal Braz', 'breno.bernal', '123', '(34) 99174-6430', 'breno.bernal@email', 1, 'default.jpg'),
(12, 'Breno Vinicius França Souza', 'breno.souza', '123', '(38) 99102-7903', 'breno.souza@email', 1, 'default.jpg'),
(13, 'Bruno Soares Batista', 'bruno', '123', '(37) 99995-5001', 'bruno@email', 1, 'default.jpg'),
(14, 'Carlos Henrique de Oliveira', 'carlos.henrique', '123', '(31) 97154-9744', 'carlos.henrique@email', 1, 'default.jpg'),
(15, 'Carlos Meira de Castro Pereira', 'carlos.pereira', '123', '(38) 99800-4032', 'carlos.pereira@email', 1, 'default.jpg'),
(16, 'Carlos Patrício Teixeira', 'carlos.teixeira', '123', '(31) 99655-6845', 'carlos.teixeira@email', 1, 'default.jpg'),
(17, 'Cláudio Luis de Medeiros', 'claudio.medeiros', '123', '(31) 98030-4695', 'claudio.medeiros@email', 1, 'default.jpg'),
(18, 'Cristopher', 'cristopher', '123', '(31) 33333-3333', 'cristopher@email', 1, 'default.jpg'),
(19, 'Danilo Paixão Lopes', 'danilo.lopes', '123', '(35) 98827-6271', 'danilo.lopes@email', 1, 'default.jpg'),
(20, 'Danilo Vitarelle de Freitas Junior', 'danilo.junior', '123', '(31) 8410-0829', 'danilo.junior@email', 1, 'default.jpg'),
(21, 'Douglas Rocha dos Santos', 'douglas.santos', '123', '(16) 99365-0119', 'douglas.santos@email', 1, 'default.jpg'),
(22, 'Eder Marques Miranda', 'eder.miranda', '123', '(38) 99305-9241', 'eder.miranda@email', 1, 'default.jpg'),
(23, 'Edson Ribas de Sá', 'edson.sa', '123', '(38) 99159-0525', 'edson.sa@email', 1, 'default.jpg'),
(24, 'Edson da Cunha Rodrigues', 'edson.rodrigues', '123', '(31) 99987-9567', 'edson.rodrigues@email', 1, 'default.jpg'),
(25, 'Felipe Roberto Rocha', 'felipe', '123', '(31) 99845-4295', 'felipe@email', 1, 'default.jpg'),
(26, 'Fernando Alencar', 'fernando.alencar', '123', '(38) 99749-3254', 'fernando.alencar@email', 1, 'default.jpg'),
(27, 'Frederico Macedo de Souza Zolio', 'frederico.macedo', '123', '(31) 99904-0959', 'frederico.macedo@email', 1, 'default.jpg'),
(28, 'Hevilaity Antonio Alves', 'hevilaity.alves', '123', '(38) 99896-3050', 'hevilaity.alves@email', 1, 'default.jpg'),
(29, 'Hugo Leonardo Duraes Alves', 'hugo.alves', '123', '(38) 99151-7321', 'hugoifnmg@email', 1, 'default.jpg'),
(30, 'Igor D Angelis Makuzki', 'igor.makuzki', '123', '(38) 99851-6577', 'igor.makuzki@email', 1, 'default.jpg'),
(31, 'Jander Vasconcelos Santos', 'jander', '123', '(31) 99602-2421', 'jander@email', 1, 'default.jpg'),
(32, 'José Fábio Formiga da Silva', 'j.fabio', '123', '(38) 99175-5554', 'j.fabio.f21@email', 1, 'default.jpg'),
(33, 'Jeisiane Fernanda Pereira Lopes', 'jeisiane.lopes', '123', '(38) 98404-4552', 'jeisiane.lopes@email', 1, 'default.jpg'),
(34, 'Lucas Cândido Rodrigues', 'lucas.rodrigues', '123', '(35) 99832-4869', 'lucascrodrigues0404@email', 1, 'default.jpg'),
(35, 'Lucas Rabelo Matos', 'lucas.matos', '123', '(38) 99861-7778', 'lucas.matos@email', 1, 'default.jpg'),
(36, 'Márcia Helena Lara', 'marcia', '123', '(35) 98825-9039', 'marcia@email', 1, 'default.jpg'),
(37, 'Mariana Almeida e Sá', 'mariana.sa', '123', '(33) 98898-9446', 'mariana.sa@email', 1, 'default.jpg'),
(38, 'Matteus Almeida de Sousa', 'matteus.almeida', '123', '(38) 99850-4519', 'matteus.almeida@email', 1, 'default.jpg'),
(39, 'Paulo Roberto Diniz Da Silva', 'paulo.roberto', '123', '(31) 99585-3037', 'paulo.roberto@email', 1, 'default.jpg'),
(40, 'Paulo Henrique da Silva', 'paulo.henrique', '123', '(31) 99525-3882', 'paulo.henrique@email', 1, 'default.jpg'),
(41, 'Rafael Alves Zanetti', 'rafael.zanetti', '123', '(35) 98419-6944', 'rafael.zanetti@email', 1, 'default.jpg'),
(42, 'Rodrigo Ferreira da Silveira', 'rodrigo.silveira', '123', '(38) 99966-4376', 'rodrigo.silveira@email', 1, 'default.jpg'),
(43, 'Salomão Nunes Coelho', 'salomao.nunes', '123', '(33) 99967-3120', 'salomao.nunes@email', 1, 'default.jpg'),
(44, 'Vinícius Jesus Viana', 'vinicius.viana', '123', '(31) 99174-2201', 'vinicius.viana@email', 1, 'default.jpg'),
(45, 'Willian Junio Resende Lacerda', 'willian.junio', '123', '(38) 99743-8272', 'willian.junio@email', 1, 'default.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastrovisita`
--

CREATE TABLE `cadastrovisita` (
  `id` bigint(20) NOT NULL,
  `nomeColaborador` varchar(255) NOT NULL,
  `local` varchar(255) NOT NULL,
  `periodoInicial` date NOT NULL,
  `periodoFinal` date NOT NULL,
  `transporte` varchar(255) NOT NULL,
  `municipio` varchar(255) DEFAULT NULL,
  `atividade` text NOT NULL,
  `observacoes` varchar(255) DEFAULT NULL,
  `situação` tinyint(4) NOT NULL,
  `prioridade` tinyint(4) DEFAULT NULL,
  `enviado` tinyint(4) DEFAULT NULL,
  `ativo` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cadastrovisita`
--

INSERT INTO `cadastrovisita` (`id`, `nomeColaborador`, `local`, `periodoInicial`, `periodoFinal`, `transporte`, `municipio`, `atividade`, `observacoes`, `situação`, `prioridade`, `enviado`, `ativo`) VALUES
(1, 'Coordenador', 'São Sebastião do Paraíso', '2021-09-06', '2021-09-10', 'Veículo Próprio', 'Belo Horizonte', 'Acompanhar implantação do PEC', '', 1, NULL, 0, 1),
(2, 'Anderson Augusto Cruz', 'Itambacuri', '2021-09-06', '2021-09-10', 'Veículo do Parceiro', 'MOC', 'Implantar PEC', '', 1, NULL, 0, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alocacao`
--
ALTER TABLE `alocacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cadastrocolaborador`
--
ALTER TABLE `cadastrocolaborador`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `cadastrovisita`
--
ALTER TABLE `cadastrovisita`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alocacao`
--
ALTER TABLE `alocacao`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `cadastrocolaborador`
--
ALTER TABLE `cadastrocolaborador`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `cadastrovisita`
--
ALTER TABLE `cadastrovisita`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
