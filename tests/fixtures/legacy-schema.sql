-- Schema-only fixture of the pre-English tables. No sample accounts or game rows.

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nome` text CHARACTER SET utf8 NOT NULL,
  `password` varchar(60) CHARACTER SET utf8 NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `cartas` (
  `id` int(11) NOT NULL,
  `cidade` char(50) NOT NULL DEFAULT '',
  `cor` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `cartas_jogador` (
  `id` int(11) NOT NULL,
  `id_jogo` int(11) NOT NULL,
  `id_carta` int(11) NOT NULL,
  `id_jogador` text NOT NULL,
  `carta` text NOT NULL,
  `cor` text NOT NULL,
  `ja_jogada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cidades` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL,
  `cor` char(8) NOT NULL,
  `conexoes` char(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cidades_infectadas` (
  `id` int(11) NOT NULL,
  `id_jogo` int(11) NOT NULL,
  `id_cidade` int(11) NOT NULL,
  `nome_cidade` varchar(60) NOT NULL,
  `n_doencas` tinyint(1) NOT NULL,
  `cor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `doencas_erradicadas` (
  `id` int(11) NOT NULL,
  `id_jogo` int(11) NOT NULL,
  `Amarelo` tinyint(1) NOT NULL,
  `Azul` tinyint(4) NOT NULL,
  `Preto` tinyint(4) NOT NULL,
  `Vermelho` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `estado_jogo` (
  `id` int(11) NOT NULL,
  `id_jogo` int(11) NOT NULL,
  `estado` text NOT NULL,
  `n_jogadores` int(11) NOT NULL,
  `jogador1` text NOT NULL,
  `jogador2` text NOT NULL,
  `jogador3` text NOT NULL,
  `jogador4` text NOT NULL,
  `cidade_jogador1` int(11) NOT NULL,
  `cidade_jogador2` int(11) NOT NULL,
  `cidade_jogador3` int(11) NOT NULL,
  `cidade_jogador4` int(11) NOT NULL,
  `n_turnos` int(11) NOT NULL,
  `centros_pesquisa` varchar(100) NOT NULL,
  `jogadas` tinyint(1) NOT NULL,
  `turno_jogador` int(11) NOT NULL,
  `cartas_biscadas` int(11) NOT NULL,
  `pilha_descarte` varchar(200) NOT NULL,
  `velocidade_infecao` int(11) NOT NULL,
  `surtos` int(11) NOT NULL,
  `mudar_velocidade` tinyint(1) NOT NULL DEFAULT '0',
  `data_inicio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `jogo` (
  `id` int(11) NOT NULL,
  `n_jogadores` int(11) NOT NULL,
  `jogadores_actuais` tinyint(1) NOT NULL,
  `descricao` text NOT NULL,
  `nome` text NOT NULL,
  `criador` varchar(60) NOT NULL,
  `jogador2` varchar(60) DEFAULT NULL,
  `jogador3` varchar(60) DEFAULT NULL,
  `jogador4` varchar(60) DEFAULT NULL,
  `data_comeco` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nome` text CHARACTER SET utf8 NOT NULL,
  `apelido` text CHARACTER SET utf8 NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 NOT NULL,
  `sexo` char(1) CHARACTER SET utf8 DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `pais` text CHARACTER SET utf8 NOT NULL,
  `distrito` text CHARACTER SET utf8,
  `concelho` text CHARACTER SET utf8,
  `password` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cartas`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cartas_jogador`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cidades`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cidades_infectadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jogo` (`id_jogo`);

ALTER TABLE `doencas_erradicadas`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `estado_jogo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jogo` (`id_jogo`),
  ADD KEY `cidade_jogador1` (`cidade_jogador1`),
  ADD KEY `cidade_jogador2` (`cidade_jogador2`),
  ADD KEY `cidade_jogador4` (`cidade_jogador4`),
  ADD KEY `cidade_jogador3` (`cidade_jogador3`);

ALTER TABLE `jogo`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`,`email`);

ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `cartas_jogador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=615;

ALTER TABLE `cidades_infectadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

ALTER TABLE `doencas_erradicadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `estado_jogo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

ALTER TABLE `jogo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

ALTER TABLE `estado_jogo`
  ADD CONSTRAINT `estado_jogo_ibfk_1` FOREIGN KEY (`id_jogo`) REFERENCES `jogo` (`id`);
