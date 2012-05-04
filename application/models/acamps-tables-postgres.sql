
CREATE TABLE missao (
	id_missao serial PRIMARY KEY,
	nm_missao varchar(50) NOT NULL,
	nr_a_pagar_participante numeric(5,2) NOT NULL,
	nr_a_pagar_servico numeric(5,2) NOT NULL,
	nr_edicao int NOT NULL,
	dt_periodo varchar(40) NOT NULL,
	bl_form_online boolean DEFAULT TRUE,
	bl_pagamento_simples boolean DEFAULT TRUE
);
INSERT INTO missao (nm_missao, nr_a_pagar_participante, nr_a_pagar_servico, nr_edicao, dt_periodo) VALUES ('{nm_missao}', {nr_a_pagar_participante}, {nr_a_pagar_servico}, {nr_edicao}, '{dt_periodo})';

--#

CREATE TABLE status(
	id_status serial PRIMARY KEY,
	ds_status varchar(25)
);
--#
INSERT INTO status (ds_status) VALUES
	('Aguardando Pagamento'),
	('Aguardando Liberação'),
	('Concluído');

--#

CREATE TABLE cidade(
	id_cidade serial,
	nm_cidade varchar(50),
	cd_estado char(2),
	--id_missao int REFERENCES missao(id_missao),
	PRIMARY KEY(id_cidade)
);
--#
INSERT INTO cidade (nm_cidade, cd_estado) VALUES
	('Aquiraz', 'CE'),
	('Aracati', 'CE'),
	('Belém','PA'),
	('Caucaia','CE'),
	('Chorózinho','CE'),
	('Fortaleza','CE'),
	('Garanhuns','PE'),
	('Guaraciaba','CE'),
	('João Pessoa','PB'),
	('Juazeiro do Norte','CE'),
	('Maranguape','CE'),
	('Natal','RN'),
	('Pacajus','CE'),
	('Parnambi','RS'),
	('Quixadá','CE'),
	('Recife','PE'),
	('Rio de Janeiro','RJ'),
	('Salvador','BA'),
	('Sobral','CE'),
	('São Luis','MA'),
	('Terezina','PI'),
	('Trairi','CE'),
	('Guaiuba','CE');

--#

CREATE TABLE servico(
	id_servico serial,
	nm_servico varchar(30),
	nm_coordenador varchar (100),
	nr_limite_pessoas int DEFAULT 0,
	PRIMARY KEY(id_servico)
);
--#
INSERT INTO servico (nm_servico) VALUES
	('1ª Eucaristia'),
	('Acolhimento'),
	('Aconselhamento'),
	('Administrativo'),
	('Alimentação'),
	('Alojamento Feminino'),
	('Alojamento Masculino'),
	('Ambulatório'),
	('Amigos do Acamp''s'),
	('Animação'),
	('Apoio'),
	--('Arte Visual'),
	('Caixas'),
	('Comissão Central'),
	('Comunicação'),
	('Cursos'),
	('Estrutura'),
	('Financeiro'),
	('Iluminação'),
	('Informática'),
	--('Inscrições'),
	('Intercessão'),
	('Intérprete'),
	('Lanchonete'),
	('Lazer'),
	('Limpeza'),
	('Liturgia'),
	('Livraria'),
	('Loja de Conveniência'),
	('Música'),
	('Noites'),
	('Ordem Feminina'),
	('Ordem Masculina'),
	--('Promoção Humana'),
	('Relação Pessoal'),
	--('Sacerdotes'),
	('Secretaria'),
	('Servos de Seminário'),
	('Som'),
	('Sorveteria'),
	('Transportes');

--#

CREATE TABLE setor(
	id_setor serial,
	nm_setor varchar(30),
	PRIMARY KEY(id_setor)
);
--#
INSERT INTO setor (nm_setor) VALUES
	('Aquiraz'),
	('Cristo Redentor'),
	('Discipulado Pacajus'),
	('Discipulado Quixadá'),
	('Fátima'),
	('Pacajus'),
	('Parquelândia'),
	('Paz');

--#

CREATE TABLE familia(
	id_familia serial,
	nm_familia varchar(50),
	cd_familia char(1),
	nm_responsavel varchar(100),
	PRIMARY KEY(id_familia)
);
--#
INSERT INTO familia (nm_familia, cd_familia) VALUES
	('Amarelo','A'),
	('Azul','B'),
	('Cinza','C'),
	('Laranja','L'),
	('Preto','P'),
	('Roxo','R'),
	('Verde','G'),
	('Vermelho','V');

--#

CREATE TABLE tipo_inscricao(
	cd_tipo char(1) PRIMARY KEY,
	ds_tipo varchar(25)
);
--#
INSERT INTO tipo_inscricao (cd_tipo, ds_tipo) VALUES
	('p', 'Participante'),
	('s', 'Serviço'),
	('v', 'Comunidade de Vida'),
	('t', 'Terceirizado'),
	('i', 'Visitante');

--#

CREATE SEQUENCE pessoa_id_seq START WITH {id_pessoa_inicial};
--#
CREATE TABLE pessoa (
	id_pessoa int DEFAULT nextval('pessoa_id_seq'),
	cd_tipo char(1) NOT NULL,
	id_status int REFERENCES status(id_status),
	nm_pessoa varchar(200) NOT NULL CHECK (nm_pessoa <> ''),
	nm_cracha varchar(100) NOT NULL CHECK (nm_pessoa <> ''),
	dt_nascimento date,
	ds_sexo char(1) NOT NULL,
	ds_endereco varchar(300),
	nr_cep varchar(15),
	ds_bairro varchar(200),
	id_cidade int REFERENCES cidade(id_cidade),
	nr_rg varchar(20),
	nr_telefone varchar(20),
	ds_email varchar(100),
	id_familia int,
	id_servico int,
	id_setor int REFERENCES setor(id_setor),
	bl_seminario boolean,
	bl_alimentacao boolean,
	bl_barracao boolean,
	bl_transporte boolean,
	bl_fez_comunhao boolean,
	bl_fazer_comunhao boolean,
	bl_alergia_alimento boolean DEFAULT false,
	nm_alergia_alimento varchar(50),
	bl_alergia_remedio boolean DEFAULT false,
	nm_alergia_remedio varchar(50),
	nm_deficiencia varchar(50),
	nm_emergencia1 varchar(200),
	nr_emergencia1 varchar(30),
	nm_emergencia2 varchar(200),
	nr_emergencia2 varchar(30),
	ds_foto varchar(200),
	bl_cracha boolean DEFAULT false,
	nr_cracha int DEFAULT 0,
	dt_inscricao timestamp without time zone DEFAULT localtimestamp,
	dt_alteracao timestamp without time zone,
	nr_boleto int DEFAULT 0,
	--id_missao int REFERENCES missao(id_missao),
	PRIMARY KEY(id_pessoa/*, id_missao*/),
	FOREIGN KEY (id_familia/* , id_missao */) REFERENCES familia(id_familia/* , id_missao */),
	FOREIGN KEY (id_servico/* , id_missao */) REFERENCES servico(id_servico/* , id_missao */)
);
--#
ALTER SEQUENCE pessoa_id_seq OWNED BY pessoa.id_pessoa;

--#

CREATE TABLE usuario(
	id_usuario serial,
	nm_usuario varchar(20),
	pw_usuario varchar(64),
	cd_permissao int,
	--               DCLSDP | DEC | HEX
	-- DESENVOLVEDOR 111111 | 63  | 1F
	-- COORDENADORES 011111 | 31  | 0F
	-- COORD. INSCR. 011011 | 27  | 1B
	-- CAIXAS        000001 | 1   | 01
	-- SECRETARIA    011100 | 28  | 1C
	dt_ultimo_login timestamp without time zone,
	--id_missao int REFERENCES missao(id_missao),
	PRIMARY KEY(id_usuario)
);
--#
INSERT INTO usuario (nm_usuario, pw_usuario, cd_permissao) VALUES ('{nm_usuario}', md5('{pw_usuario}'), 63);

--#

CREATE TABLE pagamento(
	id_pgto serial,
	id_pessoa int,
	cd_tipo_pgto varchar(2),
	nr_a_pagar numeric(5,2),
	nr_pago numeric(5,2),
	nr_desconto numeric(5,2),
	dt_pgto timestamp without time zone DEFAULT localtimestamp,
	id_usuario int,
	--id_missao int REFERENCES missao(id_missao),
	PRIMARY KEY(id_pgto/* , id_missao */),
	FOREIGN KEY (id_pessoa/* , id_missao */) REFERENCES pessoa(id_pessoa/* , id_missao */),
	FOREIGN KEY (id_usuario/* , id_missao */) REFERENCES usuario(id_usuario/* , id_missao */)
);

--#

CREATE TABLE cheque(
	id_pgto int,
	nr_parcela int,
	nr_valor numeric(5,2),
	nr_cheque int,
	nr_cheque_dgt int,
	nr_comp int,
	nr_banco int,
	nr_agencia int,
	nr_agencia_dgt int,
	nr_conta int,
	nr_conta_dgt int,
	dt_pgto date,
	nm_emitente varchar(100),
	ds_cidade varchar(30),
	ds_estado varchar(20),
	dt_emissao date,
	dt_bompara date,
	nr_telefone varchar(20),
	ds_obs varchar(400),
	--id_missao int REFERENCES missao(id_missao),
	PRIMARY KEY (id_pgto, nr_parcela/* , id_missao */),
	FOREIGN KEY (id_pgto/* , id_missao */) REFERENCES pagamento(id_pgto/* , id_missao */) ON DELETE RESTRICT -- QUAL REGRA SERIA MELHOR?
);

--#

CREATE TABLE alimentacao(
	id_pessoa int,
	dt_alimentacao date DEFAULT current_date,
	bl_cafe boolean DEFAULT false,
	bl_almoco boolean DEFAULT false,
	bl_jantar boolean DEFAULT false,
	--id_missao int REFERENCES missao(id_missao),
	PRIMARY KEY (id_pessoa, dt_alimentacao),
	FOREIGN KEY (id_pessoa/* , id_missao */) REFERENCES pessoa(id_pessoa/* , id_missao */)
);

--#

CREATE TABLE portaria(
	id_pessoa int,
	dt_movimentacao timestamp without time zone DEFAULT localtimestamp,
	cd_movimentacao char(2),
	bl_entrou boolean,
	--id_missao int REFERENCES missao(id_missao),
	PRIMARY KEY (id_pessoa, dt_movimentacao, cd_movimentacao),
	FOREIGN KEY (id_pessoa/* , id_missao */) REFERENCES pessoa(id_pessoa/* , id_missao */)
);
