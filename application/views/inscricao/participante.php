<h2>Formulário de Inscrição</h2>
<div id="form">
    <?php if(isset($erro) && $erro): ?>
        <div class="erro_onsubmit">
        <?php echo validation_errors(); ?>
        </div>
        <br/>
    <?php endif; ?>
<?php echo form_open_multipart('inscricao/participante'); ?>
<fieldset>
	<div class="clearfix">
		<label for="nm_pessoa">Nome Completo</label>
		<div class="input"><input type="text" class="obrigatorio somenteLetras xlarge" id="nm_pessoa" value="<?php echo set_value('nm_pessoa') ?>" name="nm_pessoa"></div>
	</div>
	<div class="clearfix">
		<label for="nm_cracha">Nome no Crachá</label>
		<div class="input"><input type="text" class="obrigatorio somenteLetras xlarge" id="nm_cracha" value="<?php echo set_value('nm_cracha') ?>" name="nm_cracha"></div>
	</div>
	<div class="clearfix">
		<label for="nr_rg">RG</label>
		<div class="input"><input type="text" class="obrigatorio somenteNumeros medium" id="nr_rg" value="<?php echo set_value('nr_rg') ?>" name="nr_rg"></div>
	</div>
	<div class="clearfix">
		<label for="dt_nascimento">Data de Nascimento</label>
		<div class="input"><input type="text" class="short obrigatorio small" id="dt_nascimento" value="<?php echo set_value('dt_nascimento') ?>" name="dt_nascimento"></div>
	</div>
	<div class="clearfix">
		<label>Sexo</label>
		<div class="input"><ul class="inputs-list">
			<li><label for="ds_sexo_h"><input type="radio" class="obrigatorio" id="ds_sexo_h" value="h" name="ds_sexo" checked="<?php echo set_radio('ds_sexo', 'h') ?>">Homem</label></li>
			<li><label for="ds_sexo_m"><input type="radio" class="obrigatorio" id="ds_sexo_m" value="m" name="ds_sexo" checked="<?php echo set_radio('ds_sexo', 'm') ?>">Mulher</label></li>
		</ul></div>
	</div>
</fieldset>

<hr/>

<fieldset>
	<div class="clearfix">
		<label for="ds_endereco">Endereço</label>
		<div class="input"><input type="text" class="obrigatorio somenteAlfanumerico xlarge" id="ds_endereco" value="<?php echo set_value('ds_endereco') ?>" name="ds_endereco"></div>
	</div>
	<div class="clearfix">
		<label for="nr_cep">CEP</label>
		<div class="input"><input type="text" class="short obrigatorio cep small" id="nr_cep" value="<?php echo set_value('nr_cep') ?>" name="nr_cep"><span class="help-block">Exemplo:&nbsp;60822-520 ou 60822520</span></div>
	</div>
	<div class="clearfix">
		<label for="ds_bairro">Bairro</label>
		<div class="input"><input type="text" class="obrigatorio somenteLetras" id="ds_bairro" value="<?php echo set_value('ds_bairro') ?>" name="ds_bairro"></div>
	</div>
	<div class="clearfix">
		<label for="id_cidade">Cidade</label>
		<div class="input"><?php echo form_dropdown('id_cidade', $cidades, $this->input->post('id_cidade'), 'class="obrigatorio"'); ?></div>
	</div>
</fieldset>

<hr/>

<fieldset>
	<div class="clearfix">
		<label>O que fará no período da tarde?<span class="help-block">Se você nunca participou de um Seminário de Vida no Espírito Santo, marque esta opção.</span></label>
		<div class="input">
			<ul class="inputs-list">
				<li><label for="bl_seminario_s"><input type="radio" class="obrigatorio" id="bl_seminario_s" value="1" name="bl_seminario" checked="<?php echo set_radio('bl_seminario', '1') ?>">Seminário de Vida no Espírito Santo</label></li>
				<li><label for="bl_seminario_a"><input type="radio" class="obrigatorio" id="bl_seminario_a" value="0" name="bl_seminario" checked="<?php echo set_radio('bl_seminario', '0') ?>">Aprofundamento</label></li>
			</ul>
		</div>
	</div>
	<div class="clearfix">
		<label>Você utilizará a alimentação fornecida por nós?</label>
		<div class="input">
			<ul class="inputs-list">
				<li><label for="bl_alimentacao_s"><input type="radio" class="obrigatorio" id="bl_alimentacao_s" value="1" name="bl_alimentacao" checked="<?php echo set_radio('bl_alimentacao', '1') ?>">Sim</label></li>
				<li><label for="bl_alimentacao_n"><input type="radio" class="obrigatorio" id="bl_alimentacao_n" value="0" name="bl_alimentacao" checked="<?php echo set_radio('bl_alimentacao', '0') ?>">Não</label></li>
			</ul>
		</div>
	</div>
	<div class="clearfix">
		<label>Você utilizará uma das barracas coletivas ou uma barraca particular?</label>
		<div class="input">
			<ul class="inputs-list">
				<li><label for="bl_barracao_s"><input type="radio" class="obrigatorio" id="bl_barracao_s" value="1" name="bl_barracao" checked="<?php echo set_radio('bl_barracao', '1') ?>">Barraca Coletiva</label></li>
				<li><label for="bl_barracao_n"><input type="radio" class="obrigatorio" id="bl_barracao_n" value="0" name="bl_barracao" checked="<?php echo set_radio('bl_barracao', '0') ?>">Barraca Particular</label></li>
			</ul>
		</div>
	</div>
	<div class="clearfix">
		<label>Você precisará de transporte para o acampamento?</label>
		<div class="input">
			<ul class="inputs-list">
				<li><label for="bl_transporte_s"><input type="radio" class="obrigatorio" id="bl_transporte_s" value="1" name="bl_transporte" checked="<?php echo set_radio('bl_transporte', '1') ?>">Sim</label></li>
				<li><label for="bl_transporte_n"><input type="radio" class="obrigatorio" id="bl_transporte_n" value="0" name="bl_transporte" checked="<?php echo set_radio('bl_transporte', '0') ?>">Não</label></li>
			</ul>
		</div>
	</div>
</fieldset>

<hr>

<fieldset>
	<div class="clearfix">
		<label>Já fez primeira eucaristia?</label>
		<div class="input">
			<ul class="inputs-list">
				<li><label for="bl_fez_comunhao_s"><input type="radio" class="obrigatorio" id="bl_fez_comunhao_s" value="1" name="bl_fez_comunhao" checked="<?php echo set_radio('bl_fez_comunhao', '1') ?>">Sim</label></li>
				<li><label for="bl_fez_comunhao_n"><input type="radio" class="obrigatorio" id="bl_fez_comunhao_n" value="0" name="bl_fez_comunhao" checked="<?php echo set_radio('bl_fez_comunhao', '0') ?>">Não</label></li>
			</ul>
		</div>
	</div>
	<div class="clearfix">
		<label>Deseja fazer durante o acampamento?</label>
		<div class="input">
			<ul class="inputs-list">
				<li><label for="bl_fazer_comunhao_s"><input type="radio" class="" id="bl_fazer_comunhao_s" value="1" name="bl_fazer_comunhao" checked="<?php echo set_radio('bl_fazer_comunhao', '1') ?>">Sim</label></li>
				<li><label for="bl_fazer_comunhao_n"><input type="radio" class="" id="bl_fazer_comunhao_n" value="0" name="bl_fazer_comunhao" checked="<?php echo set_radio('bl_fazer_comunhao', '0') ?>">Não</label></li>
			</ul>
		</div>
	</div>
</fieldset>

<hr/>

<fieldset>
	<div class="clearfix">
		<label for="nm_alergia_remedio">Você tem alergia a remédios?</label>
		<div class="input input-prepend">
			<label class="add-on"><input type="checkbox" name="bl_alergia_remedio" value="1" id="bl_alergia_remedio"  checked="<?php echo set_checkbox('bl_alergia_remedio', '1'); ?>"/></label>
			<input type="text" class="somenteAlfanumerico xlarge" id="nm_alergia_remedio" value="" name="nm_alergia_remedio">
		</div>
	</div>
	<div class="clearfix">
		<label for="nm_alergia_alimento">Você tem alergia a alimentos?</label>
		<div class="input input-prepend">
			<label class="add-on"><input type="checkbox" name="bl_alergia_alimento" value="1" id="bl_alergia_alimento"  checked="<?php echo set_checkbox('bl_alergia_alimento', '1'); ?>"/></label>
			<input type="text" class="somenteAlfanumerico xlarge" id="nm_alergia_alimento" value="" name="nm_alergia_alimento">
		</div>
	</div>
</fieldset>

    <hr/>

<fieldset>

	<div class="clearfix">
		<label for="ds_email">E-mail</label>
		<div class="input">
			<input type="text" class="obrigatorio email" id="ds_email" value="<?php echo set_value('ds_email') ?>" name="ds_email">
		</div>
	</div>
	<div class="clearfix">
		<label for="nr_telefone">Telefone</label>
		<div class="input">
			<input type="text" class="obrigatorio telefone small" id="nr_telefone" value="<?php echo set_value('nr_telefone') ?>" name="nr_telefone">
		</div>
	</div>
	<hr/>
	<div class="clearfix">
		<label for="nr_emergencia1">Telefone para Emergência (1)</label>
		<div class="input">
			<input type="text" class="obrigatorio telefone small" id="nr_emergencia1" value="<?php echo set_value('nr_emergencia1') ?>" name="nr_emergencia1"><span class="help-block">Coloque aqui um número de telefone para ligarmos em caso de emergência</span>
		</div>
	</div>
	<div class="clearfix">
		<label for="nm_emergencia1">Nome do Responsável (1)</label>
		<div class="input">
			<input type="text" class="obrigatorio somenteLetras xlarge" id="nm_emergencia1" value="<?php echo set_value('nm_emergencia1') ?>" name="nm_emergencia1"><span class="help-block">Coloque aqui o nome da pessoa com quem devemos falar se ligarmos para o número acima</span>
		</div>
	</div>
	<div class="clearfix">
		<label for="nr_emergencia2">Telefone para Emergência (2) <span style="color:#006bcc">(opcional)</span></label>
		<div class="input">
			<input type="text" class="telefone small" id="nr_emergencia2" value="<?php echo set_value('nr_emergencia2') ?>" name="nr_emergencia2"><span class="help-block">Coloque aqui outro número de telefone para ligarmos em caso de emergência</span>
		</div>
	</div>
	<div class="clearfix">
		<label class="campo" for="nm_emergencia2">Nome do Responsável (2) <span style="color:#006bcc">(opcional)</span></label>
		<div class="input">
			<input type="text" class="somenteLetras xlarge" id="nm_emergencia2" value="<?php echo set_value('nm_emergencia2') ?>" name="nm_emergencia2"><span class="help-block">Coloque aqui o nome da pessoa com quem devemos falar se ligarmos para o número acima</span>
		</div>
	</div>

<hr>

	<div class="clearfix">
		<label class="campo" for="ds_foto">Envie sua foto para o seu crachá</label>
		<div class="input">
			<input type="file" size="32" class="obrigatorio" value="<?php echo set_value('ds_foto') ?>" name="ds_foto"><span class="help-block">O tamanho máximo aceito para a foto é 2MB.<br>Formatos aceitos: bmp | jpg | png | gif</span>
		</div>
	</div>
</fieldset>
<fieldset>
	<div id="pesquisa" class="alert-message block-message info form-stacked" ><h3>Antes de concluir sua inscrição diga-nos <strong>como ficou sabendo do Acamp's</strong>?</h3>
		<ul class="inputs-list">
		<?php foreach ($divulgacao as $meio): ?>
			<li><div class="clearfix">
			<label for="meio_<?php echo $meio['id_meio'] ?>">
			<?php echo form_radio(array(
				'name'    => 'id_meio',
				'id'      => 'meio_'.$meio['id_meio'],
				'value'   => $meio['id_meio'],
				'checked' => set_radio('meio', $meio['id_meio']),
			)) ?><?php echo $meio['nm_meio'] ?></label>
			</div></li>
		<?php endforeach ?>
		</ul>
		<div class="clearfix"><label for="nm_obs">Alguma observação?</label>
		<?php echo form_input(array(
			'name' => 'nm_obs',
			'id'   => 'nm_obs',
			'class'=> 'xxlarge',
			'value'=> set_value('nm_obs')
		)) ?></div>
	</div>
</fieldset>
    <p class="center"><input type="submit" value="Confirmar" name="confirmar" class="btn success large" /></p>
    <?php echo form_close();?>
</div>
<script>

    $(function(){
        
        // Alterando obrigatoriedade dos campos de alergia
		
		$('#nm_alergia_remedio').attr('disabled',true);
		$('#nm_alergia_alimento').attr('disabled',true);
		
        $('#bl_alergia_remedio').change(function(){
			if( $(this).attr('checked') == "checked" ){
				$('#nm_alergia_remedio').attr('disabled',false).addClass('obrigatorio').change();
			}else{
				$('#nm_alergia_remedio').attr('disabled',true).removeClass('obrigatorio').change();
			}
        });
		
        $('#bl_alergia_alimento').change(function(){
            if( $(this).attr('checked') == "checked" ){
				$('#nm_alergia_alimento').attr('disabled',false).addClass('obrigatorio').change();
			}else{
				$('#nm_alergia_alimento').attr('disabled',true).removeClass('obrigatorio').change();
			}
        });
		
        // Alterando obrigatoriedade do campo 1ª Eucaristia
        $('#bl_fez_comunhao_n').click(function(){
            $('[name=bl_fazer_comunhao]').attr('disabled',false).addClass('obrigatorio').change();
        });
        $('#bl_fez_comunhao_s').click(function(){
            $('[name=bl_fazer_comunhao]').attr('disabled',true).removeClass('obrigatorio').removeData('obrigatorio').change();
        });

		//ativarValidacao($("#form form"));
		
		$('#dt_nascimento').datepicker({
			yearRange: '1980:2000',
			changeMonth: true,
			changeYear: true,
			onClose: function(dateText, inst){
				$(this).change();
			},
			showOn: "button",
			buttonImage: "<?php echo $this->config->item('img_url'); ?>calendar.png",
			buttonImageOnly: true
		});
		
		$(".ajuda_icone").tipTip({
			maxWidth: '300px',
			edgeOffset: 8,
			defaultPosition: 'right',
			delay: 0,
			fadeIn: 150,
			fadeOut: 150
		});
    })
    
</script>