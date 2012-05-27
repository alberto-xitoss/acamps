<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Validação dos formulários de inscrição
|--------------------------------------------------------------------------
|
| 
|
*/

$config = array(
	'inscricao/participante'=>array(
		array(
			'field'=>'nm_pessoa',
			'label'=>'Nome Completo',
			'rules'=>'trim|required'
		),
		array(
			'field'=>'nm_cracha',
			'label'=>'Nome no Crachá',
			'rules'=>'trim|required'
		),
		array(
			'field'=>'ds_sexo',
			'label'=>'Sexo',
			'rules'=>'required'
		),
		array(
			'field'=>'dt_nascimento',
			'label'=>'Data de Nascimento',
			'rules'=>'required|callback_data'
		),
		array(
			'field'=>'nr_rg',
			'label'=>'RG',
			'rules'=>'trim|required|numeric'
		),
		array(
			'field'=>'id_cidade',
			'label'=>'Cidade',
			'rules'=>'required|is_natural_no_zero'
		),
		array(
			'field'=>'bl_seminario',
			'label'=>'O que fará no período da tarde?',
			'rules'=>'required'
		),
		array(
			'field'=>'bl_transporte',
			'label'=>'Precisará de transporte do acampamento?',
			'rules'=>'required'
		),
		array(
			'field'=>'ds_email',
			'label'=>'E-mail',
			'rules'=>'trim|valid_email'
		),
		array(
			'field'=>'nr_telefone',
			'label'=>'Telefone ',
			'rules'=>'trim|callback_telefone'
		),
		array(
			'field'=>'bl_alimentacao',
			'label'=>'Alimentação',
			'rules'=>'required'
		),
		array(
			'field'=>'nm_alergia_alimento',
			'label'=>'Tem alergia a alimentos?',
			'rules'=>'trim'
		),
		array(
			'field'=>'bl_fez_comunhao',
			'label'=>'Já fez primeira eucaristia?',
			'rules'=>'required'
		),
		array(
			'field'=>'bl_fazer_comunhao',
			'label'=>'Deseja fazer primeira eucaristia?',
			'rules'=>'required'
		),
		array(
			'field'=>'nr_emergencia1',
			'label'=>'Telefone para Emergência (1)',
			'rules'=>'required'
		),
		array(
			'field'=>'nm_emergencia1',
			'label'=>'Nome do Responsável (1)',
			'rules'=>'required'
		),
		array(
			'field'=>'ds_endereco',
			'label'=>'Endereço',
			'rules'=>'trim|required'
		),
		array(
			'field'=>'nr_cep',
			'label'=>'CEP',
			'rules'=>'trim|required|callback_cep'
		),
		array(
			'field'=>'ds_bairro',
			'label'=>'Bairro',
			'rules'=>'trim|required'
		),
		array(
			'field'=>'bl_barracao',
			'label'=>'Utilizará o barracão?',
			'rules'=>'required'
		),
		array(
			'field'=>'nm_alergia_remedio',
			'label'=>'Tem alergia a remédios?',
			'rules'=>'trim'
		),			
		array(
			'field'=>'id_servico',
			'label'=>'Serviço',
			'rules'=>'required'
		),
		array(
			'field'=>'id_setor',
			'label'=>'Setor',
			'rules'=>'required'
		)
	),
	'pessoa/participante'=>array(
		array(
			'field'=>'nm_pessoa',
			'label'=>'Nome Completo',
			'rules'=>'trim|required'
		),
		array(
			'field'=>'nm_cracha',
			'label'=>'Nome no Crachá',
			'rules'=>'trim|required'
		),
		array(
			'field'=>'ds_sexo',
			'label'=>'Sexo',
			'rules'=>'required'
		),
		array(
			'field'=>'dt_nascimento',
			'label'=>'Data de Nascimento',
			'rules'=>'required|callback_data'
		),
		array(
			'field'=>'nr_rg',
			'label'=>'RG',
			'rules'=>'trim|required|numeric'
		),
		array(
			'field'=>'id_cidade',
			'label'=>'Cidade',
			'rules'=>'required|is_natural_no_zero'
		),
		array(
			'field'=>'bl_seminario',
			'label'=>'O que fará no período da tarde?',
			'rules'=>'required'
		),
		array(
			'field'=>'bl_transporte',
			'label'=>'Precisará de transporte para o Acampamento?',
			'rules'=>'required'
		),
		array(
			'field'=>'ds_email',
			'label'=>'E-mail',
			'rules'=>'trim'
		),
		array(
			'field'=>'nr_telefone',
			'label'=>'Telefone ',
			'rules'=>'trim'
		),
		array(
			'field'=>'nm_alergia_remedio',
			'label'=>'Tem alergia a remédios?',
			'rules'=>'trim'
		),
		array(
			'field'=>'nm_alergia_alimento',
			'label'=>'Tem alergia a alimentos?',
			'rules'=>'trim'
		),
		array(
			'field'=>'ds_endereco',
			'label'=>'Endereço',
			'rules'=>'trim'
		),
		array(
			'field'=>'nr_cep',
			'label'=>'CEP',
			'rules'=>'trim'
		),
		array(
			'field'=>'ds_bairro',
			'label'=>'Bairro',
			'rules'=>'trim'
		)
	),
	'pessoa/servico'=>array(
		array(
			'field'=>'nm_pessoa',
			'label'=>'Nome Completo',
			'rules'=>'trim|required'
		),
		array(
			'field'=>'nm_cracha',
			'label'=>'Nome no Crachá',
			'rules'=>'trim|required'
		),
		array(
			'field'=>'ds_sexo',
			'label'=>'Sexo',
			'rules'=>'required'
		),
		array(
			'field'=>'nr_rg',
			'label'=>'RG',
			'rules'=>'trim|required|numeric'
		),
		array(
			'field'=>'id_cidade',
			'label'=>'Cidade',
			'rules'=>'required|is_natural_no_zero'
		),
		array(
			'field'=>'id_servico',
			'label'=>'Serviço',
			'rules'=>'required|is_natural_no_zero'
		),
		array(
			'field'=>'bl_transporte',
			'label'=>'Precisará de transporte para o Acampamento?',
			'rules'=>'required'
		),
		array(
			'field'=>'ds_email',
			'label'=>'E-mail',
			'rules'=>'trim'
		),
		array(
			'field'=>'nr_telefone',
			'label'=>'Telefone ',
			'rules'=>'trim'
		),
		array(
			'field'=>'nm_alergia_remedio',
			'label'=>'Tem alergia a remédios?',
			'rules'=>'trim'
		),
		array(
			'field'=>'nm_alergia_alimento',
			'label'=>'Tem alergia a alimentos?',
			'rules'=>'trim'
		),
		array(
			'field'=>'ds_endereco',
			'label'=>'Endereço',
			'rules'=>'trim'
		),
		array(
			'field'=>'nr_cep',
			'label'=>'CEP',
			'rules'=>'trim'
		),
		array(
			'field'=>'ds_bairro',
			'label'=>'Bairro',
			'rules'=>'trim'
		)
	),
	'pessoa/cv'=>array(
		array(
			'field'=>'nm_pessoa',
			'label'=>'Nome Completo',
			'rules'=>'trim|required'
		),
		array(
			'field'=>'nm_cracha',
			'label'=>'Nome no Crachá',
			'rules'=>'trim|required'
		),
		array(
			'field'=>'ds_sexo',
			'label'=>'Sexo',
			'rules'=>'required'
		),
		array(
			'field'=>'id_setor',
			'label'=>'Setor',
			'rules'=>'required|is_natural_no_zero'
		),
		array(
			'field'=>'id_servico',
			'label'=>'Serviço',
			'rules'=>'required|is_natural_no_zero'
		),
		array(
			'field'=>'bl_transporte',
			'label'=>'Precisará de transporte para o Acampamento?',
			'rules'=>'required'
		),
		array(
			'field'=>'nm_alergia_alimento',
			'label'=>'Tem alergia a alimentos?',
			'rules'=>'trim'
		)
	),
	'pessoa/especial'=>array(
		array(
			'field'=>'nm_pessoa',
			'label'=>'Nome Completo',
			'rules'=>'trim|required'
		) ,
		array(
			'field'=>'nm_cracha',
			'label'=>'Nome no Crachá',
			'rules'=>'trim|required'
		),
		array(
			'field'=>'ds_sexo',
			'label'=>'Sexo',
			'rules'=>'required'
		),
		array(
			'field'=>'bl_alimentacao',
			'label'=>'Alimentação',
			'rules'=>'required'
		),
		array(
			'field'=>'id_servico',
			'label'=>'Serviço',
			'rules'=>'is_natural_no_zero'
		)
	)
);