<h2>Formulário de Inscrição > Comunidade de Vida</h2>

<?php if(isset($erro) && $erro): ?>
	<div class="alert alert-error alert-block">
		<?php echo validation_errors(); ?>
	</div>
<?php endif; ?>

<?php echo form_open_multipart('inscricao/cv', array('class'=>'form-horizontal')); ?>

<!-- Nome Completo -->
<div class="control-group">
	<label for="nm_pessoa" class="control-label">Nome Completo</label>
	<div class="controls"><input type="text" class="obrigatorio somenteLetras span5" id="nm_pessoa" value="<?php echo set_value('nm_pessoa') ?>" name="nm_pessoa"></div>
</div>
<!-- Nome no Crachá -->
<div class="control-group">
	<label for="nm_cracha" class="control-label">Nome no Crachá</label>
	<div class="controls"><input type="text" class="obrigatorio somenteLetras span5" id="nm_cracha" value="<?php echo set_value('nm_cracha') ?>" name="nm_cracha"></div>
</div>
<!-- Data de Nascimento -->
<div class="control-group">
	<label for="dt_nascimento" class="control-label">Data de Nascimento</label>
	<div class="controls"><input type="text" class="obrigatorio data span2" id="dt_nascimento" value="<?php echo set_value('dt_nascimento') ?>" name="dt_nascimento"></div>
</div>
<!-- Sexo -->
<div class="control-group">
	<label class="control-label">Sexo</label>
	<div class="controls">
		<label for="ds_sexo_h" class="radio">
			<input type="radio" class="obrigatorio" id="ds_sexo_h" value="h" name="ds_sexo" <?php if(set_radio('ds_sexo', 'h')) echo 'checked' ?>>Homem
		</label>
		<label for="ds_sexo_m" class="radio">
			<input type="radio" class="obrigatorio" id="ds_sexo_m" value="m" name="ds_sexo" <?php if(set_radio('ds_sexo', 'm')) echo 'checked' ?>>Mulher
		</label>
	</div>
</div>
<hr/>
<!-- Serviço -->
<div class="control-group">
	<label for="id_servico" class="control-label">Serviço</label>
	<div class="controls"><?php echo form_dropdown('id_servico', $servicos, $this->input->post('id_servico'), 'class="obrigatorio"'); ?></div>
</div>
<hr/>
<!-- Setor -->
<div class="control-group">
	<label for="id_setor" class="control-label">Setor</label>
	<div class="controls"><?php echo form_dropdown('id_setor', $setores, $this->input->post('id_setor'), 'class="obrigatorio"') ?></div>
</div>
<hr/>
<!-- Alimentação -->
<div class="control-group">
	<label class="control-label">Você utilizará a alimentação fornecida por nós?</label>
	<div class="controls">
		<label for="bl_alimentacao_s" class="radio">
			<input type="radio" class="obrigatorio" id="bl_alimentacao_s" value="1" name="bl_alimentacao" <?php if(set_radio('bl_alimentacao', '1')) echo 'checked' ?>>Sim
		</label>
		<label for="bl_alimentacao_n" class="radio">
			<input type="radio" class="obrigatorio" id="bl_alimentacao_n" value="0" name="bl_alimentacao" <?php if(set_radio('bl_alimentacao', '0')) echo 'checked' ?>>Não
		</label>
	</div>
</div>
<!-- Transporte -->
<div class="control-group">
	<label class="control-label">Você precisará de transporte para o acampamento?</label>
	<div class="controls">
		<label for="bl_transporte_s" class="radio">
			<input type="radio" class="obrigatorio" id="bl_transporte_s" value="1" name="bl_transporte" <?php if(set_radio('bl_transporte', '1')) echo 'checked' ?>>Sim
		</label>
		<label for="bl_transporte_n" class="radio">
			<input type="radio" class="obrigatorio" id="bl_transporte_n" value="0" name="bl_transporte" <?php if(set_radio('bl_transporte', '0')) echo 'checked' ?>>Não
		</label>
	</div>
</div>
<hr/>
<!-- Alergia a Alimentos -->
<div class="control-group">
	<label for="nm_alergia_alimento" class="control-label">Você tem alergia a alimentos?</label>
	<div class="controls">
		<input type="text" class="somenteAlfanumerico span5" id="nm_alergia_alimento" value="" name="nm_alergia_alimento">
	</div>
</div>
<hr/>
<!-- Foto -->
<div class="control-group">
	<label for="ds_foto" class="control-label">Envie sua foto para o seu crachá</label>
	<div class="controls">
		<input type="file" size="32" class="obrigatorio" value="<?php echo set_value('ds_foto') ?>" name="ds_foto" id="ds_foto"><span class="help-block">O tamanho máximo aceito para a foto é 2MB.<br>Formatos aceitos: bmp | jpg | png | gif</span>
	</div>
</div>
<p align="center"><input type="submit" value="Confirmar" name="confirmar" class="btn btn-primary btn-large" /></p>
<?php echo form_close();?>

<script>

    $(function(){
		
		ativarValidacao($("form"));

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
	})

</script>