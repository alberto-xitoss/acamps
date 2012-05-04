CREATE TABLE missao (
	id_missao int not null auto_increment  PRIMARY KEY,
	nm_missao varchar(50) NOT NULL,
	nr_a_pagar_participante float NOT NULL,
	nr_a_pagar_servico float NOT NULL
);

-- ---------------------------------------------------------

CREATE TABLE status(
	id_status int not null auto_increment PRIMARY KEY,
	ds_status varchar(25)
);
INSERT INTO status (ds_status) VALUES
	('Aguardando Pagamento'),
	('Aguardando Liberação'),
	('Concluído');

-- ---------------------------------------------------------

CREATE TABLE cidade(
	id_cidade int not null auto_increment ,
	nm_cidade varchar(50),
	cd_estado char(2),
	PRIMARY KEY(id_cidade)
);
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

-- ---------------------------------------------------------

CREATE TABLE servico(
	id_servico int not null auto_increment ,
	nm_servico varchar(30),
	nm_coordenador varchar (100),
	nr_limite_pessoas int DEFAULT 1,
	id_missao int REFERENCES missao(id_missao),
	PRIMARY KEY(id_servico, id_missao)
);
INSERT INTO servico (nm_servico, id_missao) VALUES
	('1ª Eucaristia', 1),
	('Acolhimento', 1),
	('Aconselhamento', 1),
	('Adminstrativo', 1),
	('Alimentação', 1),
	('Alojamento Feminino', 1),
	('Alojamento Masculino', 1),
	('Ambulatório', 1),
	("Amigos do Acamp's", 1),
	('Animação', 1),
	('Apoio', 1),
	('Arte Visual', 1),
	('Barracas', 1),
	('Caixas', 1),
	('Comissão Central', 1),
	('Comunicação', 1),
	('Curso', 1),
	('Filmagem', 1),
	('Financeiro', 1),
	('Informática', 1),
	('Inscrições', 1),
	('Intercessão', 1),
	('Lanchonete', 1),
	('Lazer', 1),
	('Limpeza', 1),
	('Liturgia', 1),
	('Livraria', 1),
	('Loja de Conveniência', 1),
	('Música', 1),
	('Noites', 1),
	('Ordem Feminina', 1),
	('Ordem Masculina', 1),
	('Portaria Central', 1),
	('Promoção Humana', 1),
	('Relação Pessoal', 1),
	('Sacerdotes', 1),
	('Secretaria', 1),
	('Servos de Seminário', 1),
	('Som', 1),
	('Tesouraria', 1),
	('Transportes', 1);

-- ---------------------------------------------------------

CREATE TABLE setor(
	id_setor int not null auto_increment ,
	nm_setor varchar(30),
	PRIMARY KEY(id_setor)
);
INSERT INTO setor (nm_setor) VALUES
	('Aquiraz'),
	('Cristo Redentor'),
	('Discipulado Pacajus'),
	('Discipulado Quixadá'),
	('Fátima'),
	('Pacajus'),
	('Parquelândia'),
	('Paz');

-- ---------------------------------------------------------

CREATE TABLE familia(
	id_familia int not null auto_increment ,
	nm_familia varchar(50),
	cd_familia char(1),
	nm_responsavel varchar(100),
	id_missao int REFERENCES missao(id_missao),
	PRIMARY KEY(id_familia, id_missao)
);
INSERT INTO familia (nm_familia, cd_familia, id_missao) VALUES
	('Amarelo','A', 1),
	('Azul','B', 1),
	('Cinza','C', 1),
	('Laranja','L', 1),
	('Preto','P', 1),
	('Roxo','R', 1),
	('Verde','G', 1),
	('Vermelho','V', 1);

-- ---------------------------------------------------------

CREATE TABLE pessoa (
	id_pessoa int not null auto_increment,
	cd_tipo char(1) NOT NULL,
	id_status int REFERENCES status(id_status),
	nm_pessoa varchar(200) NOT NULL CHECK (nm_pessoa <> ''),
	nm_cracha varchar(100) NOT NULL CHECK (nm_pessoa <> ''),
	dt_nascimento date NOT NULL,
	ds_sexo char(1),
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
	id_missao int REFERENCES missao(id_missao),
	PRIMARY KEY(id_pessoa, id_missao),
	FOREIGN KEY (id_familia, id_missao) REFERENCES familia(id_familia, id_missao),
	FOREIGN KEY (id_servico, id_missao) REFERENCES servico(id_servico, id_missao)
);
ALTER TABLE pessoa AUTO_INCREMENT =2700;

-- ---------------------------------------------------------

CREATE TABLE usuario(
	id_usuario int not null auto_increment ,
	nm_usuario varchar(20),
	pw_usuario varchar(64),
	cd_permissao int,
	-- FIXME - pode ser um conjunto de flags
	--               DCLSDP | DEC | HEX
	-- DESENVOLVEDOR 111111 | 63  | 1F
	-- COORDENADORES 011111 | 31  | 0F
	-- Raull         011011 | 27  | 1B
	-- CAIXAS        000001 | 1   | 01
	-- SECRETARIA    010100 | 20  | 14
	dt_ultimo_login timestamp,
	id_missao int REFERENCES missao(id_missao),
	PRIMARY KEY(id_usuario, id_missao)
);

-- ---------------------------------------------------------

CREATE TABLE pagamento(
	id_pgto int not null auto_increment ,
	id_pessoa int,
	cd_tipo_pgto varchar(2),
	nr_a_pagar float,
	nr_pago float,
	nr_desconto float,
	dt_pgto timestamp DEFAULT now(),
	id_usuario int,
	id_missao int REFERENCES missao(id_missao),
	PRIMARY KEY(id_pgto, id_missao),
	FOREIGN KEY (id_pessoa, id_missao) REFERENCES pessoa(id_pessoa, id_missao),
	FOREIGN KEY (id_usuario, id_missao) REFERENCES usuario(id_usuario, id_missao)
);

-- ---------------------------------------------------------

CREATE TABLE cheque(
	id_pgto int,
	nr_parcela int,
	nr_valor float,
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
	id_missao int REFERENCES missao(id_missao),
	PRIMARY KEY (id_pgto, nr_parcela, id_missao),
	FOREIGN KEY (id_pgto, id_missao) REFERENCES pagamento(id_pgto, id_missao) ON DELETE RESTRICT
);
