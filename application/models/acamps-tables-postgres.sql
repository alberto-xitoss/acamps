
CREATE TABLE configuracao (
	id_config serial PRIMARY KEY,
	nm_config varchar(30) NOT NULL,
	nm_valor text NOT NULL
);
--#
INSERT INTO configuracao (nm_config, nm_valor) VALUES
('missao', '{nm_missao}'),
('valor_participante', '{nr_a_pagar_participante}'),
('valor_servico', '{nr_a_pagar_servico}'),
('edicao', '{nr_edicao}'),
('data_inicio', '{dt_inicio}'),
('data_fim', '{dt_fim}'),
('form_online', 'false'),
('pagamento_simples', 'true');

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
	('Caixas'),
	('Comissão Central'),
	('Comunicação'),
	('Cursos'),
	('Estrutura'),
	('Financeiro'),
	('Iluminação'),
	('Informática'),
	('Inscrições'),
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
	('Promoção Humana'),
	('Relação Pessoal'),
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
	PRIMARY KEY(id_pessoa),
	FOREIGN KEY (id_familia) REFERENCES familia(id_familia),
	FOREIGN KEY (id_servico) REFERENCES servico(id_servico)
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
	PRIMARY KEY(id_pgto),
	FOREIGN KEY (id_pessoa) REFERENCES pessoa(id_pessoa),
	FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
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
	PRIMARY KEY (id_pgto, nr_parcela),
	FOREIGN KEY (id_pgto) REFERENCES pagamento(id_pgto) ON DELETE RESTRICT -- QUAL REGRA SERIA MELHOR?
);

--#

CREATE TABLE alimentacao
(
	id_pessoa int,
	dt_alimentacao date DEFAULT current_date,
	bl_cafe boolean DEFAULT false,
	bl_almoco boolean DEFAULT false,
	bl_jantar boolean DEFAULT false,
	PRIMARY KEY (id_pessoa, dt_alimentacao),
	FOREIGN KEY (id_pessoa) REFERENCES pessoa(id_pessoa)
);

--#

CREATE TABLE portaria
(
	id_pessoa int,
	dt_movimentacao timestamp without time zone DEFAULT localtimestamp,
	cd_movimentacao char(2),
	bl_entrou boolean,
	PRIMARY KEY (id_pessoa, dt_movimentacao, cd_movimentacao),
	FOREIGN KEY (id_pessoa) REFERENCES pessoa(id_pessoa)
);

--#

CREATE TABLE pesquisa_divulgacao
(
  id_registro serial,
  id_meio int,
  nm_obs varchar(200),
  PRIMARY KEY (id_registro)
);

--#

CREATE TABLE meio_divulgacao
(
  id_meio serial,
  nm_meio varchar(50),
  PRIMARY KEY (id_meio)
);
--#
INSERT INTO meio_divulgacao (nm_meio) VALUES
	('Pais'),
	('Amigo'),
	('Outro parente'),
	('Panfleto'),
	('Facebook'),
	('Orkut'),
	('Twitter'),
	('Outra rede social'),
	('Email'),
	('Blog'),
	('Outro');
