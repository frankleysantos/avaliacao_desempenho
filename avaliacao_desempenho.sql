-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 10-Out-2018 às 14:36
-- Versão do servidor: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avaliacao_desempenho`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `assiduidade`
--

DROP TABLE IF EXISTS `assiduidade`;
CREATE TABLE IF NOT EXISTS `assiduidade` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_avaliado` int(10) DEFAULT NULL,
  `id_gestor` int(10) DEFAULT NULL,
  `assiduidade_q1` float DEFAULT NULL,
  `assiduidade_q2` float DEFAULT NULL,
  `assiduidade_obs1` text COLLATE utf8_unicode_ci,
  `assiduidade_obs2` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `id_gestor` (`id_gestor`),
  KEY `id_avaliacao` (`id_avaliado`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `assiduidade`
--

INSERT INTO `assiduidade` (`id`, `id_avaliado`, `id_gestor`, `assiduidade_q1`, `assiduidade_q2`, `assiduidade_obs1`, `assiduidade_obs2`) VALUES
(1, 1, 1, 10, 10, 'teste 1', 'teste 1'),
(2, 2, 1, 10, 7.5, 'teste', 'teste2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

DROP TABLE IF EXISTS `avaliacao`;
CREATE TABLE IF NOT EXISTS `avaliacao` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data_avaliacao` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `avaliacao`
--

INSERT INTO `avaliacao` (`id`, `nome`, `data_avaliacao`) VALUES
(1, 'primeira avaliação', '10/10/2018');

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliado`
--

DROP TABLE IF EXISTS `avaliado`;
CREATE TABLE IF NOT EXISTS `avaliado` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_gestor` int(10) NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `matricula` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secretaria` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nomeacao` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_gestor` (`id_gestor`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `avaliado`
--

INSERT INTO `avaliado` (`id`, `id_gestor`, `nome`, `matricula`, `cargo`, `secretaria`, `data_nomeacao`, `status`) VALUES
(1, 1, 'Carlos Augustos Soares Santos', '112535', '27', '13', '01/02/2018', '1'),
(2, 1, 'Aquiles Santos de Paula', '116600', '27', '13', '01/06/2017', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargo`
--

DROP TABLE IF EXISTS `cargo`;
CREATE TABLE IF NOT EXISTS `cargo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=301 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cargo`
--

INSERT INTO `cargo` (`id`, `nome`) VALUES
(1, 'ADMINIST. REGIONAL'),
(2, 'ADMINISTRADOR DE AEROPORTO'),
(3, 'ADMINISTRADOR EMPRESA'),
(4, 'ADMINISTRATIVO E FINANCEIRO POUPANÇA'),
(5, 'ADVOGADO'),
(6, 'AGENTE ADMINISTRATIVO'),
(7, 'AGENTE CADUNICO BOLSA FAMILIAIA'),
(8, 'AGENTE COMUNITARIO SAUDE PSF'),
(9, 'AGENTE DE COMBATE A ENDEMIAS'),
(10, 'AGENTE DE TRANSITO E TRANSPORTE'),
(11, 'AGENTE FISCAL'),
(12, 'AGENTE SANITARIO'),
(13, 'AGENTE SOCIAL CONS RUA'),
(14, 'AGENTE SOCIAL NASF'),
(15, 'AP. DIRETOR ESCOLAR'),
(16, 'AP. MEDICO'),
(17, 'AP.PROFESSOR'),
(18, 'APOIO COMUNITARIO POUPANÇA JOVEM'),
(19, 'ARQUITETO'),
(20, 'ARTESAO CAPS AD II'),
(21, 'ARTESAO CAPS AD III'),
(22, 'ARTESÃO CENTRO POP'),
(23, 'ARTICULADOR POUPANÇA JOVEM'),
(24, 'ASSESSOR'),
(25, 'ASSESSOR COMUNIC. SOCIAL'),
(26, 'ASSESSOR CONTABIL'),
(27, 'ASSESSOR DE INFORMATICA I'),
(28, 'ASSESSOR DE RELAÇÕES PÚBLICAS'),
(29, 'ASSESSOR EXECUTIVO'),
(30, 'ASSESSOR FOTOGRAFICO'),
(31, 'ASSESSOR II'),
(32, 'ASSESSOR INFORMATICA II'),
(33, 'ASSESSOR JURIDICO'),
(34, 'ASSESSOR JURIDICO CREAS'),
(35, 'ASSESSOR PUBLICITÁRIO'),
(36, 'ASSESSOR TECNICO'),
(37, 'ASSESSOR TECNICO DE NIVEL SUPERIOR'),
(38, 'ASSESSOR TECNICO NIVEL SUPERIOR II'),
(39, 'ASSESSOR TECNICO NIVEL SUPERIOR III'),
(40, 'ASSISTENTE ADMINISTRATIVO PRO JOVEM'),
(41, 'ASSISTENTE DE GESTAO'),
(42, 'ASSISTENTE DE NUCLEO PETI'),
(43, 'ASSISTENTE PEDAGOGICO PRO JOVEM URB'),
(44, 'ASSISTENTE SOCIAL'),
(45, 'ASSISTENTE SOCIAL BOLSA FAMILIAIA'),
(46, 'ASSISTENTE SOCIAL CAPS AD II'),
(47, 'ASSISTENTE SOCIAL CAPS AD III'),
(48, 'ASSISTENTE SOCIAL CAPS i'),
(49, 'ASSISTENTE SOCIAL CENTRO POP'),
(50, 'ASSISTENTE SOCIAL CONS RUA'),
(51, 'ASSISTENTE SOCIAL CRAS/PAIF'),
(52, 'ASSISTENTE SOCIAL CREAS'),
(53, 'ASSISTENTE SOCIAL NASF'),
(54, 'ASSISTENTE SOCIAL PAC 1'),
(55, 'ASSISTENTE SOCIAL PAEFI'),
(56, 'ASSISTENTE SOCIAL PRO JOVEM ADOLESCENTE'),
(57, 'ASSISTENTE SOCIAL SCFV'),
(58, 'ASSISTENTE SOCIAL SCFV'),
(59, 'ASSISTENTE TECNICO'),
(60, 'AUX SERV.PRO JOVEM URBANO'),
(61, 'AUX.CON.ODONTOLOGICO'),
(62, 'AUXILIAR ADMINISTRATIVO'),
(63, 'AUXILIAR ADMINISTRATIVO BOLSA FAMILIA'),
(64, 'AUXILIAR ADMINISTRATIVO CAPS AD II'),
(65, 'AUXILIAR ADMINISTRATIVO CAPS'),
(66, 'AUXILIAR ADMINISTRATIVO CENTRO POP'),
(67, 'AUXILIAR ADMINISTRATIVO CRAS/PAIF'),
(68, 'AUXILIAR ADMINISTRATIVO CRASSECI'),
(69, 'AUXILIAR ADMINISTRATIVO CREAS'),
(70, 'AUXILIAR ADMINISTRATIVO PAEFI'),
(71, 'AUXILIAR ADMINISTRATIVO PAIF'),
(72, 'AUXILIAR ADMINISTRATIVO PSF'),
(73, 'AUXILIAR ADMINISTRATIVO SCFV'),
(74, 'AUXILIAR BIBLIOTECA'),
(75, 'AUXILIAR CONSULTORIO DENTARIO PSF'),
(76, 'AUXILIAR DE ENSINO'),
(77, 'AUXILIAR DE GESTAO'),
(78, 'AUXILIAR DE GESTAO SCFV'),
(79, 'AUXILIAR DE INSPEÇAO SANITARIA E IN'),
(80, 'AUXILIAR DE SAUDE'),
(81, 'AUXILIAR DE SECRETARIA ESCOLAR'),
(82, 'AUXILIAR DE SERVICOS'),
(83, 'AUXILIAR DE SERVICOS GERAIS PSF'),
(84, 'AUXILIAR DE SERVIÇO FIOCRUZ'),
(85, 'AUXILIAR DE SERVIÇOS CENTRO POP'),
(86, 'AUXILIAR DE SERVIÇOS GERAIS CAPS AD'),
(87, 'AUXILIAR DE SERVIÇOS GERAIS CAPS AD'),
(88, 'AUXILIAR DE SERVIÇOS GERAIS CAPS i'),
(89, 'AUXILIAR DE SERVIÇOS GERAIS POUPANÇA'),
(90, 'AUXILIAR ENFERMAGEM'),
(91, 'AUXILIAR SERVIÇOS GERAIS POUPANÇA JOVEM'),
(92, 'BIBLIOTECONOMO'),
(93, 'BIOQUIMICO'),
(94, 'CALCETEIRO'),
(95, 'CHEFE DE GABINETE'),
(96, 'CHEFE DE SETOR'),
(97, 'CHEFE DE SEÇÃO'),
(98, 'CONSELHEIRO TUTELAR'),
(99, 'CONTADOR'),
(100, 'COORDENADOR ACESSUAS'),
(101, 'COORDENADOR BOLSA FAMILIAIA'),
(102, 'COORDENADOR CREAS'),
(103, 'COORDENADOR DE NUCLEO PETI'),
(104, 'COORDENADOR DE NUCLEO SEGUNDO TEMPO'),
(105, 'COORDENADOR DE POSTO DE SAUDE'),
(106, 'COORDENADOR ESCOLAR'),
(107, 'COORDENADOR GERAL CRAS'),
(108, 'COORDENADOR GERAL POPI'),
(109, 'COORDENADOR GERAL POUPANÇA JOVEM'),
(110, 'COORDENADOR GERAL SCFV'),
(111, 'COORDENADOR GERAL SEGUNDO TEMPO'),
(112, 'COORDENADOR GERAL SUAS'),
(113, 'COORDENADOR GESTOR DE PROJETOS SCFV'),
(114, 'COORDENADOR PEDAGOGICO'),
(115, 'COORDENADOR POR CICLO ETARIO SCFV'),
(116, 'COORDENADOR PSIJU'),
(117, 'COORDENADOR RELAÇÃOES INSTITUCIONAI'),
(118, 'COORDENADOR TERRITORIAL CRAS/PAIF'),
(119, 'CORREGEDOR'),
(120, 'DESENHISTA'),
(121, 'DIRETOR ADMINISTRATIVO FINANCEIRO'),
(122, 'DIRETOR ADMINISTRATIVO HOSPITALAR'),
(123, 'DIRETOR CLINICO HOSPITALAR'),
(124, 'DIRETOR DE CONTABILIDADE GERAL'),
(125, 'DIRETOR DE CONTROLE INTERNO'),
(126, 'DIRETOR DE DIVISAO'),
(127, 'DIRETOR DE DIVISAO DE MANUTENÇAO DE'),
(128, 'DIRETOR DE DIVISAO DE TRANSITO'),
(129, 'DIRETOR DE DIVISAO DE TRANSPORTE PU'),
(130, 'DIRETOR DE DIVISAO(Cultura)'),
(131, 'DIRETOR DE ESCOLA I'),
(132, 'DIRETOR DE FINANÇAS'),
(133, 'DIRETOR DE PREVIDENCIA E ATUARIA'),
(134, 'DIRETOR ESCOLA II'),
(135, 'DIRETOR GERAL'),
(136, 'DIRETOR PRESIDENTE (sisprevto)'),
(137, 'DIRETOR TECNICO HOSPITALAR'),
(138, 'ECONOMISTA'),
(139, 'EDUCADOR CAPS i'),
(140, 'EDUCADOR FISICO CAPS AD II'),
(141, 'EDUCADOR FISICO CAPS AD III'),
(142, 'EDUCADOR FISICO NASF'),
(143, 'EDUCADOR POUPANÇA JOVEM'),
(144, 'EDUCADOR PRO JOVEM URBANO'),
(145, 'EDUCADOR SOCIAL PAEFI'),
(146, 'EDUCADOR SOCIAL PSIJU'),
(147, 'ENCARREGADO DE SERVIÇOS'),
(148, 'ENFERMEIRO'),
(149, 'ENFERMEIRO CAPS AD II'),
(150, 'ENFERMEIRO CAPS AD III'),
(151, 'ENFERMEIRO CAPS i'),
(152, 'ENFERMEIRO CONS RUA'),
(153, 'ENFERMEIRO ESF'),
(154, 'ENFERMEIRO NASF'),
(155, 'ENFERMEIRO PSF'),
(156, 'ENGENHEIRO'),
(157, 'ENGENHEIRO ALIMENTOS'),
(158, 'ENGENHEIRO AMBIENTAL'),
(159, 'ENGENHEIRO CIVIL'),
(160, 'ENGENHEIRO DE PRODUÇÃO'),
(161, 'ENGENHEIRO ELETRICISTA'),
(162, 'ESCRITURARIO'),
(163, 'ESTAGIARIO PAC 1'),
(164, 'FARMACEUTICO CAPS AD III'),
(165, 'FARMACEUTICO CAPS i'),
(166, 'FARMACEUTICO CO RESPONSAVEL'),
(167, 'FARMACEUTICO GERENTE'),
(168, 'FARMACEUTICO NASF'),
(169, 'FARMACEUTICO UPA'),
(170, 'FISCAL DE TRIBUTOS'),
(171, 'FISCAL SANITARIO'),
(172, 'FISIOTERAPEUTA'),
(173, 'FISIOTERAPEUTA NASF'),
(174, 'FISIOTERAPEUTA PSF'),
(175, 'FONOAUDIOLOGO'),
(176, 'FONOAUDIOLOGO NASF'),
(177, 'GEOLOGO'),
(178, 'GERENTE DE MATERIAIS IGD SUAS'),
(179, 'GERENTE FINANCEIRO IGD SUAS'),
(180, 'GERENTE(TEOTRANS)'),
(181, 'GESTOR CADUNICO BOLSA FAMILIAIA'),
(182, 'INSPETOR DE ALUNOS'),
(183, 'INSPETOR DE ALUNOS'),
(184, 'INSPETOR ESCOLAR'),
(185, 'INSTRUTOR'),
(186, 'MECANICO'),
(187, 'MECANICO MAQ.PESADA'),
(188, 'MEDIADOR CAPS II'),
(189, 'MEDIADOR DE CONFLITOS CENTRO POP'),
(190, 'MEDICO'),
(191, 'MEDICO CLINICO CAPS AD II'),
(192, 'MEDICO CLINICO CAPS AD III'),
(193, 'MEDICO COGESTOR'),
(194, 'MEDICO DERMATOLOGISTA'),
(195, 'MEDICO DO TRABALHO'),
(196, 'MEDICO GENERALISTA CONS.RUA'),
(197, 'MEDICO GENERALISTA ESF'),
(198, 'MEDICO GENERALISTA NASF'),
(199, 'MEDICO ORTOPEDISTA'),
(200, 'MEDICO PSF'),
(201, 'MEDICO PSIQUIATRA'),
(202, 'MEDICO PSIQUIATRA CAPS AD II'),
(203, 'MEDICO PSIQUIATRA CAPS AD III'),
(204, 'MEDICO PSIQUIATRA CAPS i'),
(205, 'MESTRE OBRAS'),
(206, 'MONITOR PETI'),
(207, 'MONITOR PSIJU'),
(208, 'MOTORISTA DE VEICULO LEVE'),
(209, 'MOTORISTA DE VEICULO PESADO'),
(210, 'NUTRICIONISTA'),
(211, 'NUTRICIONISTA NASF'),
(212, 'NUTRICIONISTA NASF'),
(213, 'NUTRICIONISTA PSF'),
(214, 'ODONTOLOGO'),
(215, 'ODONTOLOGO PSF'),
(216, 'OFICIAL DE SERVICOS'),
(217, 'OPERADOR DE MAQUINA LEVE'),
(218, 'OPERADOR DE MAQUINA PESADA'),
(219, 'ORIENTADOR DE ATIVIDADES LUDICAS SC'),
(220, 'ORIENTADOR EDUCACIONAL'),
(221, 'ORIENTADOR SOCIAL AGENTE JOVEM'),
(222, 'ORIENTADOR SOCIAL PRO JOVEM ADOLESCENTE'),
(223, 'ORIENTADOR SOCIAL SCFV'),
(224, 'ORIENTADOR SOCIAL SUAS/PPI'),
(225, 'PEDAGOGO'),
(226, 'PEDAGOGO CENTRO POP'),
(227, 'PREFEITO MUNICIPAL'),
(228, 'PRES.F.CASA CULTURA'),
(229, 'PROCURADOR JURIDICO'),
(230, 'PROFESSOR DE ACOLHIMENTO PRO JOVEM'),
(231, 'PROFESSOR I'),
(232, 'PROFESSOR II'),
(233, 'PROFESSOR III'),
(234, 'PROFESSOR III - ARTES'),
(235, 'PROFESSOR III - CIÊNCIAS'),
(236, 'PROFESSOR III - EDUCACAO FISICA'),
(237, 'PROFESSOR III - GEOGRAFIA'),
(238, 'PROFESSOR III - HISTORIA'),
(239, 'PROFESSOR III - INGLES'),
(240, 'PROFESSOR III - MATEMÁTICA'),
(241, 'PROFESSOR III - PORTUGUÊS'),
(242, 'PROFESSOR III - RELIGIÃO'),
(243, 'PSICOLOGO'),
(244, 'PSICOLOGO CAPS AD II'),
(245, 'PSICOLOGO CAPS AD III'),
(246, 'PSICOLOGO CAPS i'),
(247, 'PSICOLOGO CENTRO POP'),
(248, 'PSICOLOGO CONS RUA'),
(249, 'PSICOLOGO CRAS/PAIF'),
(250, 'PSICOLOGO CRAS/PAIF'),
(251, 'PSICOLOGO CREAS'),
(252, 'PSICOLOGO NASF'),
(253, 'PSICOLOGO PAEFI'),
(254, 'SEC J ALIST MILITAR'),
(255, 'SECRETARIA POUPANÇA JOVEM'),
(256, 'SECRETARIO ESCOLAR'),
(257, 'SECRETARIO EXECUTIVO'),
(258, 'SECRETARIO EXECUTIVO PETI'),
(259, 'SECRETARIO MUNICIPAL'),
(260, 'SECRETARIO/OFICINEIRO CONS RUA'),
(261, 'SECRETARIO/OFICINEIRO NASF'),
(262, 'SUBPROCURADOR MUNICIPAL'),
(263, 'SUPERV. PEDAGOGICO'),
(264, 'SUPERVISOR SUAS'),
(265, 'TEC EDUC MONITOR DE OFICINA TERAPEU'),
(266, 'TEC. CONTABILIDADE'),
(267, 'TEC.E.M.ODONTOLOGICO'),
(268, 'TEC.HIGIENE DENTAL'),
(269, 'TECNICO ADM SEGUNDO TEMPO'),
(270, 'TECNICO DE ENFERMAGEM CAPS AD II'),
(271, 'TECNICO DE ENFERMAGEM CAPS AD III'),
(272, 'TECNICO DE ENFERMAGEM CAPS i'),
(273, 'TECNICO DE ENFERMEGEM CONS RUA'),
(274, 'TECNICO DE MANUTENCAO DE REDE ELETRICA'),
(275, 'TECNICO EM ENFERMAGEM'),
(276, 'TECNICO EM ENFERMAGEM PSF'),
(277, 'TECNICO EM FARMACIA CAPS AD II'),
(278, 'TECNICO EM FARMACIA CAPS AD II'),
(279, 'TECNICO ENFERMAGEM NASF'),
(280, 'TECNICO HIGIENE DENTAL PSF'),
(281, 'TECNICO LABORATORIO'),
(282, 'TECNICO N. MEDIO II'),
(283, 'TECNICO NIVEL MEDIO ACESSUAS'),
(284, 'TECNICO NIVEL MEDIO PETI'),
(285, 'TECNICO NIVEL SUPEIOR - SUPORTE TEC'),
(286, 'TECNICO NIVEL SUPERIOR ACESSUAS'),
(287, 'TECNICO NIVEL SUPERIOR PETI'),
(288, 'TECNICO RAIO X'),
(289, 'TECNICO SEG.TRABALHO'),
(290, 'TECNOLOGO EM GEOPROCESSAMENTO'),
(291, 'TECNOLOGO EM GESTAO PUBLICA'),
(292, 'TELEFONISTA'),
(293, 'TERAPEUTA OCUPACIONAL'),
(294, 'TERAPEUTA OCUPACIONAL NASF'),
(295, 'TOPOGRAFO'),
(296, 'VETERINARIO'),
(297, 'VICE DIRETOR ESCOLAR'),
(298, 'VICE PREF. MUNICIPAL'),
(299, 'VIGIA-MEDIADOR CAPS AD III'),
(300, 'VIGILANTE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

DROP TABLE IF EXISTS `disciplina`;
CREATE TABLE IF NOT EXISTS `disciplina` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_avaliado` int(10) NOT NULL,
  `id_gestor` int(10) NOT NULL,
  `disciplina_q1` float NOT NULL,
  `disciplina_q2` float NOT NULL,
  `disciplina_obs1` text COLLATE utf8_unicode_ci NOT NULL,
  `disciplina_obs2` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_avaliado` (`id_avaliado`),
  KEY `id_gestor` (`id_gestor`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`id`, `id_avaliado`, `id_gestor`, `disciplina_q1`, `disciplina_q2`, `disciplina_obs1`, `disciplina_obs2`) VALUES
(1, 1, 1, 7.5, 7.5, '', 'teste 2'),
(2, 2, 1, 10, 7.5, '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gestor`
--

DROP TABLE IF EXISTS `gestor`;
CREATE TABLE IF NOT EXISTS `gestor` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `matricula` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cargo` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `perfil` enum('admin','avaliador','coordenador') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'avaliador',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `gestor`
--

INSERT INTO `gestor` (`id`, `nome`, `matricula`, `cargo`, `senha`, `perfil`) VALUES
(1, 'Jeferson nepomuceno teles', '1234', 'chefe cpd', '81dc9bdb52d04dc20036dbd8313ed055', 'avaliador'),
(2, 'Farlison Grande Boi', '152489', 'Gerente de Projetos', '81dc9bdb52d04dc20036dbd8313ed055', 'coordenador'),
(3, 'Thaylon Paulino Pereira', '113626', 'Assessor de informÃ¡tica 2', '81dc9bdb52d04dc20036dbd8313ed055', 'avaliador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `iniciativa`
--

DROP TABLE IF EXISTS `iniciativa`;
CREATE TABLE IF NOT EXISTS `iniciativa` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_avaliado` int(10) NOT NULL,
  `id_gestor` int(10) NOT NULL,
  `iniciativa_q1` float NOT NULL,
  `iniciativa_q2` float NOT NULL,
  `iniciativa_obs1` text COLLATE utf8_unicode_ci NOT NULL,
  `iniciativa_obs2` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_avaliado` (`id_avaliado`),
  KEY `id_gestor` (`id_gestor`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `iniciativa`
--

INSERT INTO `iniciativa` (`id`, `id_avaliado`, `id_gestor`, `iniciativa_q1`, `iniciativa_q2`, `iniciativa_obs1`, `iniciativa_obs2`) VALUES
(1, 1, 1, 7.5, 7.5, 'teste 2', 'teste 2'),
(2, 2, 1, 10, 10, '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtividade`
--

DROP TABLE IF EXISTS `produtividade`;
CREATE TABLE IF NOT EXISTS `produtividade` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_avaliado` int(10) NOT NULL,
  `id_gestor` int(10) NOT NULL,
  `produtividade_q1` float NOT NULL,
  `produtividade_q2` float NOT NULL,
  `produtividade_obs1` text COLLATE utf8_unicode_ci NOT NULL,
  `produtividade_obs2` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_avaliado` (`id_avaliado`),
  KEY `id_gestor` (`id_gestor`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtividade`
--

INSERT INTO `produtividade` (`id`, `id_avaliado`, `id_gestor`, `produtividade_q1`, `produtividade_q2`, `produtividade_obs1`, `produtividade_obs2`) VALUES
(1, 1, 1, 5, 5, 'teste 3', 'teste 3'),
(2, 2, 1, 10, 10, '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsabilidade`
--

DROP TABLE IF EXISTS `responsabilidade`;
CREATE TABLE IF NOT EXISTS `responsabilidade` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_avaliado` int(10) NOT NULL,
  `id_gestor` int(10) NOT NULL,
  `responsabilidade_q1` float NOT NULL,
  `responsabilidade_q2` float NOT NULL,
  `responsabilidade_obs1` text COLLATE utf8_unicode_ci NOT NULL,
  `responsabilidade_obs2` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_avaliado` (`id_avaliado`),
  KEY `id_gestor` (`id_gestor`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `responsabilidade`
--

INSERT INTO `responsabilidade` (`id`, `id_avaliado`, `id_gestor`, `responsabilidade_q1`, `responsabilidade_q2`, `responsabilidade_obs1`, `responsabilidade_obs2`) VALUES
(1, 1, 1, 2.5, 2.5, 'teste 4', 'teste 5'),
(2, 2, 1, 10, 10, '', 'tesfsdfsdfsd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `secretaria`
--

DROP TABLE IF EXISTS `secretaria`;
CREATE TABLE IF NOT EXISTS `secretaria` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `secretaria`
--

INSERT INTO `secretaria` (`id`, `nome`) VALUES
(1, 'Administração'),
(2, 'Assistência Social e Habitação / Cultura e Patrimônio Histórico'),
(3, 'Agropecuária / Meio Ambiente e Desenvolvimento Sustentável'),
(4, 'Educação'),
(5, 'Esporte e Lazer'),
(6, 'Fazenda'),
(7, 'Governo'),
(8, 'Obras'),
(9, 'Saúde'),
(10, 'Integração Regional, Trabalho e Emprego / Desenvolvimento Econômico e Coordenação de Gestão'),
(11, 'Serviços Urbanos /Meio Ambiente e Desenvolvimento Sustentável'),
(12, 'Procuradoria Jurídica'),
(13, 'Planejamento'),
(14, 'Gabinete');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
