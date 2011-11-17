<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function cria_tabelas($params = array('id_pessoa_inicial' => 0)) {
		
		$create_queries = array(
			'missao' =>	'CREATE TABLE missao (
							id_missao int not null auto_increment PRIMARY KEY,
							nm_missao varchar(50) NOT NULL,
							nr_a_pagar_participante float NOT NULL,
							nr_a_pagar_servico float NOT NULL
						);',
		
			'status' =>	'CREATE TABLE status(
							id_status int not null auto_increment PRIMARY KEY,
							ds_status varchar(25)
						);',
			
			'cidade' => 'CREATE TABLE cidade(
							id_cidade int not null auto_increment ,
							nm_cidade varchar(50),
							cd_estado char(2),
							PRIMARY KEY(id_cidade)
						);',
			
		   'servico' => 'CREATE TABLE servico(
							id_servico int not null auto_increment ,
							nm_servico varchar(30),
							nm_coordenador varchar (100),
							nr_limite_pessoas int DEFAULT 1,
							id_missao int REFERENCES missao(id_missao),
							PRIMARY KEY(id_servico, id_missao)
						);',
			
			 'setor' => 'CREATE TABLE setor(
							id_setor int not null auto_increment ,
							nm_setor varchar(30),
							PRIMARY KEY(id_setor)
						);',
			
		   'familia' =>	'CREATE TABLE familia(
							id_familia int not null auto_increment ,
							nm_familia varchar(50),
							cd_familia char(1),
							nm_responsavel varchar(100),
							id_missao int REFERENCES missao(id_missao),
							PRIMARY KEY(id_familia, id_missao)
						);',
			
			'pessoa' =>	'CREATE TABLE pessoa (
							id_pessoa int not null auto_increment,
							cd_tipo char(1) NOT NULL,
							id_status int REFERENCES status(id_status),
							nm_pessoa varchar(200) NOT NULL CHECK (nm_pessoa <> \'\'),
							nm_cracha varchar(100) NOT NULL CHECK (nm_pessoa <> \'\'),
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
						);',
			
		   'usuario' => 'CREATE TABLE usuario(
							id_usuario int not null auto_increment ,
							nm_usuario varchar(20),
							pw_usuario varchar(64),
							cd_permissao int,
							dt_ultimo_login timestamp,
							id_missao int REFERENCES missao(id_missao),
							PRIMARY KEY(id_usuario, id_missao)
						);',
			
		 'pagamento' => 'CREATE TABLE pagamento(
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
						);',
			
			'cheque' => 'CREATE TABLE cheque(
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
						);',
		
			'meio_divulgacao'=>	'CREATE TABLE meio_divulgacao(
									id_meio int not null auto_increment PRIMARY KEY,
									nm_meio character varying(50)
								)',
		
		'pesquisa_divulgacao'=>	'CREATE TABLE pesquisa_divulgacao(
									id_registro int not null auto_increment PRIMARY KEY,
									id_meio integer,
									nm_obs character varying(200)
								)'
		);
		
		
		
		foreach ($create_queries as $table => $query) {
			
			if(!$this->db->table_exists($table)){
				
				if($this->db->platform() == 'postgre'){
					if($table == 'pessoa'){
						$this->db->query('CREATE SEQUENCE pessoa_id_seq START WITH '.$params['id_pessoa_inicial']);
						$query = str_replace("id_pessoa int not null auto_increment,",
											 "id_pessoa int DEFAULT nextval('pessoa_id_seq'),",
											 $query);
					}else{
						$query = str_replace("int not null auto_increment", "serial", $query);
					}
				}
				
				$this->db->query($query); 
				
				if($table == 'pessoa' && $this->db->platform() == 'mysql'){
					$this->db->query('ALTER TABLE pessoa AUTO_INCREMENT = '.$params['id_pessoa_inicial']);
				}
			}
		}
		
	}
	
	function inicializa_tabelas($params) {
		
		$id_missao = 0;
		
		if($this->db->table_exists('missao') && $this->db->count_all('missao')==0){
			$this->db->query("INSERT INTO missao (nm_missao,nr_a_pagar_participante,nr_a_pagar_servico) VALUES 
								('".$params['missao']."',".$params['valor_part'].",".$params['valor_serv'].");"
							);
			$id_missao = $this->db->insert_id();
		}
		
		if($id_missao == 0){
			return false;
		}
		
		if($this->db->table_exists('status') && $this->db->count_all('status')==0){
			$this->db->query("INSERT INTO status (ds_status) VALUES
								('Aguardando Pagamento'),
								('Aguardando Liberação'),
								('Concluído');"
							);
		}
		
		if($this->db->table_exists('cidade') && $this->db->count_all('cidade')==0){
			$this->db->query("INSERT INTO cidade (nm_cidade, cd_estado) VALUES
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
								('Guaiuba','CE');"
							);
		}
		
		if($this->db->table_exists('servico') && $this->db->count_all('servico')==0){
			$this->db->query("INSERT INTO servico (nm_servico, id_missao) VALUES
								('1ª Eucaristia',".$id_missao."),
								('Acolhimento',".$id_missao."),
								('Aconselhamento',".$id_missao."),
								('Adminstrativo',".$id_missao."),
								('Alimentação',".$id_missao."),
								('Alojamento Feminino',".$id_missao."),
								('Alojamento Masculino',".$id_missao."),
								('Ambulatório',".$id_missao."),
								('Amigos do Acamp\'s',".$id_missao."),
								('Animação',".$id_missao."),
								('Apoio',".$id_missao."),
								('Arte Visual',".$id_missao."),
								('Barracas',".$id_missao."),
								('Caixas',".$id_missao."),
								('Comissão Central',".$id_missao."),
								('Comunicação',".$id_missao."),
								('Curso',".$id_missao."),
								('Filmagem',".$id_missao."),
								('Financeiro',".$id_missao."),
								('Iluminação',".$id_missao."),
								('Informática',".$id_missao."),
								('Inscrições',".$id_missao."),
								('Intercessão',".$id_missao."),
								('Intérprete',".$id_missao."),
								('JMJ',".$id_missao."),
								('Lanchonete',".$id_missao."),
								('Lazer',".$id_missao."),
								('Limpeza',".$id_missao."),
								('Liturgia',".$id_missao."),
								('Livraria',".$id_missao."),
								('Loja de Conveniência',".$id_missao."),
								('Monitoramento',".$id_missao."),
								('Música',".$id_missao."),
								('Noites',".$id_missao."),
								('Ordem Feminina',".$id_missao."),
								('Ordem Masculina',".$id_missao."),
								('Portaria Central',".$id_missao."),
								('Promoção Humana',".$id_missao."),
								('Relação Pessoal',".$id_missao."),
								('Sacerdotes',".$id_missao."),
								('Secretaria',".$id_missao."),
								('Servos de Seminário',".$id_missao."),
								('Som',".$id_missao."),
								('Tesouraria',".$id_missao."),
								('Transportes',".$id_missao."),
								('Vocacional',".$id_missao.");"
							);
		}
		
		if($this->db->table_exists('setor') && $this->db->count_all('setor')==0){
			$this->db->query("INSERT INTO setor (nm_setor) VALUES
								('Aquiraz'),
								('Cristo Redentor'),
								('Discipulado Pacajus'),
								('Discipulado Quixadá'),
								('Fátima'),
								('Pacajus'),
								('Parquelândia'),
								('Paz');"
							);
		}
		
		if($this->db->table_exists('familia') && $this->db->count_all('familia')==0){
			$this->db->query("INSERT INTO familia (nm_familia, cd_familia, id_missao) VALUES
								('Amarelo','A', ".$id_missao."),
								('Azul','B', ".$id_missao."),
								('Cinza','C', ".$id_missao."),
								('Laranja','L', ".$id_missao."),
								('Preto','P', ".$id_missao."),
								('Roxo','R', ".$id_missao."),
								('Verde','G', ".$id_missao."),
								('Vermelho','V', ".$id_missao.");"
							);
		}
		
		if($this->db->table_exists('usuario') && $this->db->count_all('usuario')==0){
			$this->db->query("INSERT INTO usuario (nm_usuario, pw_usuario, cd_permissao, id_missao)	VALUES(
								'".$params['usuario']."',
								md5('".$params['senha']."'),
								31,
								".$id_missao.")"
							);
		}
		
		if($this->db->table_exists('meio_divulgacao') && $this->db->count_all('meio_divulgacao')==0){
			$this->db->query("INSERT INTO meio_divulgacao (nm_meio) VALUES
								('Pais'),
								('Amigo'),
								('Outro parente'),
								('Panfleto'),
								('Facebook'),
								('Orkut'),
								('Twitter'),
								('Outra rede social'),
								('Email'),
								('Internet (mas não por uma rede social)'),
								('Outro');"
							);
		}
	}
	
	function setup_alimentacao() {
		if($this->db->table_exists('alimentacao')){
			return true;
		}
		
		if(!$this->db->table_exists('pessoa')){
			return false;
		}
		
		$query = 'CREATE TABLE alimentacao(
					id_pessoa int,
					dt_alimentacao date DEFAULT current_date,
					bl_cafe boolean DEFAULT false,
					bl_almoco boolean DEFAULT false,
					bl_jantar boolean DEFAULT false,
					id_missao int REFERENCES missao(id_missao),
					PRIMARY KEY (id_pessoa, dt_alimentacao),
					FOREIGN KEY (id_pessoa, id_missao) REFERENCES pessoa(id_pessoa, id_missao)
				);';
	}
	
}
