DROP TABLE IF EXISTS cheque;
--#
DROP TABLE IF EXISTS pagamento;
--#
DROP TABLE IF EXISTS auditoria;
--#
DROP TABLE IF EXISTS pesquisa_divulgacao;
--#
DROP TABLE IF EXISTS meio_divulgacao;
--#
DROP TABLE IF EXISTS pessoa_onibus;
--#
DROP TABLE IF EXISTS onibus_ida;
--#
DROP TABLE IF EXISTS onibus_volta;
--#
DROP TABLE IF EXISTS onibus_local;
--#
DROP TABLE IF EXISTS pessoa;
--#
DROP TABLE IF EXISTS usuario;
--#
DROP TABLE IF EXISTS configuracao;
--#
DROP TABLE IF EXISTS status;
--#
DROP TABLE IF EXISTS cidade;
--#
DROP TABLE IF EXISTS servico;
--#
DROP TABLE IF EXISTS setor;
--#
DROP TABLE IF EXISTS familia;
--#
DROP TABLE IF EXISTS tipo_inscricao;

--#

CREATE TABLE configuracao
(
	id_config int AUTO_INCREMENT PRIMARY KEY,
	nm_config varchar(30) NOT NULL,
	nm_valor text NOT NULL
);

--#

INSERT INTO configuracao (nm_config, nm_valor) VALUES
('missao', '{missao}'),
('valor_participante', '{valor_participante}'),
('valor_servico', '{valor_servico}'),
('edicao', '{edicao}'),
('data_inicio', '{data_inicio}'),
('data_fim', '{data_fim}'),
('form_online', '{form_online}'),
('pagamento_simples', '{pagamento_simples}');

--#

CREATE TABLE status
(
	id_status int AUTO_INCREMENT PRIMARY KEY,
	ds_status varchar(25)
);

--#

INSERT INTO status (ds_status) VALUES
	('Aguardando Pagamento'),
	('Aguardando Liberação'),
	('Concluído');

--#

CREATE TABLE cidade
(
	id_cidade int AUTO_INCREMENT PRIMARY KEY,
	nm_cidade varchar(50),
	cd_estado char(2)
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

CREATE TABLE servico
(
	id_servico int AUTO_INCREMENT PRIMARY KEY,
	nm_servico varchar(30),
	nm_coordenador varchar (100),
	nr_limite_pessoas int DEFAULT 0
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

CREATE TABLE setor
(
	id_setor int AUTO_INCREMENT PRIMARY KEY,
	nm_setor varchar(30)
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

CREATE TABLE familia
(
	id_familia int AUTO_INCREMENT PRIMARY KEY,
	nm_familia varchar(50),
	cd_familia char(1),
	nm_responsavel varchar(100)
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

CREATE TABLE tipo_inscricao
(
	cd_tipo char(1) PRIMARY KEY,
	nm_tipo varchar(25)
);

--#

INSERT INTO tipo_inscricao (cd_tipo, nm_tipo) VALUES
	('p', 'Participante'),
	('s', 'Serviço'),
	('v', 'Comunidade de Vida'),
	('e', 'Especial');

--#

CREATE TABLE pessoa
(
	id_pessoa int AUTO_INCREMENT PRIMARY KEY,
	cd_tipo char(1) NOT NULL,
	id_status int,
	nm_pessoa varchar(200) NOT NULL CHECK (nm_pessoa <> ''),
	nm_cracha varchar(100) NOT NULL CHECK (nm_pessoa <> ''),
	dt_nascimento date NOT NULL,
	ds_sexo char(1),
	ds_endereco varchar(300),
	nr_cep varchar(15),
	ds_bairro varchar(200),
	id_cidade int,
	nr_rg varchar(20),
	nr_telefone varchar(20),
	ds_email varchar(100),
	id_familia int,
	id_servico int,
	id_setor int,
	bl_seminario boolean,
	bl_alimentacao boolean,
	bl_barracao boolean,
	bl_transporte boolean,
	bl_fez_comunhao boolean,
	bl_fazer_comunhao boolean,
	nm_alergia_alimento varchar(50),
	nm_alergia_remedio varchar(50),
	nm_deficiencia varchar(50),
	nm_emergencia1 varchar(200),
	nr_emergencia1 varchar(30),
	nm_emergencia2 varchar(200),
	nr_emergencia2 varchar(30),
	ds_foto varchar(200),
	bl_cracha boolean DEFAULT false,
	nr_cracha int DEFAULT 0,
	dt_inscricao timestamp DEFAULT now(),
	dt_alteracao timestamp,
	nr_boleto int DEFAULT 0,
	FOREIGN KEY (id_status) REFERENCES status(id_status) ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY (id_cidade) REFERENCES cidade(id_cidade) ON DELETE SET NULL,
	FOREIGN KEY (id_familia) REFERENCES familia(id_familia) ON DELETE SET NULL,
	FOREIGN KEY (id_servico) REFERENCES servico(id_servico) ON DELETE SET NULL,
	FOREIGN KEY (id_setor) REFERENCES setor(id_setor) ON DELETE SET NULL
);

--#

ALTER TABLE pessoa AUTO_INCREMENT =1000;

--#

CREATE TABLE usuario
(
	id_usuario int AUTO_INCREMENT PRIMARY KEY,
	nm_usuario varchar(20),
	pw_usuario varchar(64),
	cd_permissao int,
	dt_ultimo_login timestamp
);

--#

INSERT INTO usuario (nm_usuario, pw_usuario, cd_permissao) VALUES ('{usuario}', md5('{senha}'), 63);

--#

CREATE TABLE pagamento
(
	id_pgto int AUTO_INCREMENT PRIMARY KEY,
	id_pessoa int,
	cd_tipo_pgto varchar(2),
	nr_a_pagar numeric(5,2),
	nr_pago numeric(5,2),
	nr_desconto numeric(5,2),
	dt_pgto timestamp DEFAULT now(),
	id_usuario int,
	FOREIGN KEY (id_pessoa) REFERENCES pessoa(id_pessoa) ON DELETE CASCADE,
	FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE SET NULL
);

--#

CREATE TABLE auditoria
(
	id_pessoa integer PRIMARY KEY,
	bl_verificada smallint DEFAULT 0,
	FOREIGN KEY (id_pessoa) REFERENCES pessoa (id_pessoa) ON DELETE CASCADE
);

--#

CREATE TABLE cheque
(
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
	FOREIGN KEY (id_pgto) REFERENCES pagamento(id_pgto) ON DELETE CASCADE
);

--#

CREATE TABLE pesquisa_divulgacao
(
	id_registro int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_meio int,
	nm_obs varchar(200)
);

--#

CREATE TABLE meio_divulgacao
(
	id_meio int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nm_meio varchar(50)
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

--#

CREATE TABLE onibus_local
(
	id_onibus_local int PRIMARY KEY AUTO_INCREMENT,
	nm_local varchar(80)
);

--#

CREATE TABLE onibus_ida
(
	id_onibus_ida int PRIMARY KEY AUTO_INCREMENT,
	id_onibus_local int,
	nr_vagas int DEFAULT 46,
	FOREIGN KEY (id_onibus_local) REFERENCES onibus_local (id_onibus_local) ON DELETE SET NULL
);

--#

CREATE TABLE onibus_volta
(
	id_onibus_volta int PRIMARY KEY AUTO_INCREMENT,
	id_onibus_local int,
	nr_vagas int DEFAULT 46,
	FOREIGN KEY (id_onibus_local) REFERENCES onibus_local (id_onibus_local) ON DELETE SET NULL
);

--#

CREATE TABLE pessoa_onibus
(
	id_pessoa int PRIMARY KEY,
	id_onibus_local_preferencia int,
	id_onibus_ida int,
	id_onibus_volta int,
	FOREIGN KEY (id_pessoa) REFERENCES pessoa (id_pessoa) ON DELETE CASCADE,
	FOREIGN KEY (id_onibus_local_preferencia) REFERENCES onibus_local (id_onibus_local) ON DELETE SET NULL,
	FOREIGN KEY (id_onibus_ida) REFERENCES onibus_ida (id_onibus_ida) ON DELETE SET NULL,
	FOREIGN KEY (id_onibus_volta) REFERENCES onibus_volta (id_onibus_volta) ON DELETE SET NULL
);
