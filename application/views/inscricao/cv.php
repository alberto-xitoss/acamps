<h2>Formulário de Inscrição > Comunidade de Vida</h2>
<div id="form">
    <?php if(isset($erro) && $erro): ?>
        <div class="alert-message block-message error">
        <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>
<?php echo form_open_multipart('inscricao/cv'); ?>
	<!-- Nome Completo -->
	<div class="clearfix">
		<label for="nm_pessoa">Nome Completo</label>
		<div class="input"><input type="text" class="obrigatorio somenteLetras xlarge" id="nm_pessoa" value="<?php echo set_value('nm_pessoa') ?>" name="nm_pessoa"></div>
	</div>
	<!-- Nome no Crachá -->
	<div class="clearfix">
		<label for="nm_cracha">Nome no Crachá</label>
		<div class="input"><input type="text" class="obrigatorio somenteLetras xlarge" id="nm_cracha" value="<?php echo set_value('nm_cracha') ?>" name="nm_cracha"></div>
	</div>
	<!-- Data de Nascimento -->
	<div class="clearfix">
		<label for="dt_nascimento">Data de Nascimento</label>
		<div class="input"><input type="text" class="obrigatorio data small" id="dt_nascimento" value="<?php echo set_value('dt_nascimento') ?>" name="dt_nascimento"></div>
	</div>
	<!-- Sexo -->
	<div class="clearfix">
		<label>Sexo</label>
		<div class="input"><ul class="inputs-list">
			<li><label for="ds_sexo_h"><input type="radio" class="obrigatorio" id="ds_sexo_h" value="h" name="ds_sexo" <?php if(set_radio('ds_sexo', 'h')) echo 'checked' ?>>Homem</label></li>
			<li><label for="ds_sexo_m"><input type="radio" class="obrigatorio" id="ds_sexo_m" value="m" name="ds_sexo" <?php if(set_radio('ds_sexo', 'm')) echo 'checked' ?>>Mulher</label></li>
		</ul></div>
	</div>
<hr/>
	<!-- Serviço -->
	<div class="clearfix">
		<label for="id_servico">Serviço</label>
		<div class="input"><?php echo form_dropdown('id_servico', $servicos, $this->input->post('id_servico'), 'class="obrigatorio"'); ?></div>
	</div>
<hr/>
	<!-- Setor -->
	<div class="clearfix">
		<label for="id_setor">Setor</label>
		<div class="input"><?php echo form_dropdown('id_setor', $setores, $this->input->post('id_setor'), 'class="obrigatorio"') ?></div>
	</div>
<hr/>
	<!-- Alimentação -->
	<div class="clearfix">
		<label>Você utilizará a alimentação fornecida por nós?</label>
		<div class="input">
			<ul class="inputs-list">
				<li><label for="bl_alimentacao_s"><input type="radio" class="obrigatorio" id="bl_alimentacao_s" value="1" name="bl_alimentacao" <?php if(set_radio('bl_alimentacao', '1')) echo 'checked' ?>>Sim</label></li>
				<li><label for="bl_alimentacao_n"><input type="radio" class="obrigatorio" id="bl_alimentacao_n" value="0" name="bl_alimentacao" <?php if(set_radio('bl_alimentacao', '0')) echo 'checked' ?>>Não</label></li>
			</ul>
		</div>
	</div>
	<!-- Transporte -->
	<div class="clearfix">
		<label>Você precisará de transporte para o acampamento?</label>
		<div class="input">
			<ul class="inputs-list">
				<li><label for="bl_transporte_s"><input type="radio" class="obrigatorio" id="bl_transporte_s" value="1" name="bl_transporte" <?php if(set_radio('bl_transporte', '1')) echo 'checked' ?>>Sim</label></li>
				<li><label for="bl_transporte_n"><input type="radio" class="obrigatorio" id="bl_transporte_n" value="0" name="bl_transporte" <?php if(set_radio('bl_transporte', '0')) echo 'checked' ?>>Não</label></li>
			</ul>
		</div>
	</div>
<hr/>
	<!-- Alergia a Alimentos -->
	<div class="clearfix">
		<label for="nm_alergia_alimento">Você tem alergia a alimentos?</label>
		<div class="input input-prepend">
			<label class="add-on"><input type="checkbox" name="bl_alergia_alimento" value="1" id="bl_alergia_alimento"  <?php if(set_checkbox('bl_alergia_alimento', '1')) echo 'checked' ?>/></label>
			<input type="text" class="somenteAlfanumerico xlarge" id="nm_alergia_alimento" value="" name="nm_alergia_alimento">
		</div>
	</div>
<hr/>
	<!-- Foto -->
	<div class="clearfix">
		<label class="campo" for="ds_foto">Envie sua foto para o seu crachá</label>
		<div class="input">
			<input type="file" size="32" class="obrigatorio" value="<?php echo set_value('ds_foto') ?>" name="ds_foto" id="ds_foto"><span class="help-block">O tamanho máximo aceito para a foto é 2MB.<br>Formatos aceitos: bmp | jpg | png | gif</span>
		</div>
	</div>
	<p class="center"><input type="submit" value="Confirmar" name="confirmar" class="btn success large" /></p>
	<?php echo form_close();?>
</div>
<script>

    $(function(){
		
		$('#nm_alergia_alimento').attr('disabled',true);
		
		$('#bl_alergia_alimento').change(function(){
			checkbox = $(this);
            if( checkbox.attr('checked') == "checked" ){
				$('#nm_alergia_alimento').attr('disabled',false).addClass('obrigatorio').change();
				checkbox.parent('label').addClass('active');
			}else{
				$('#nm_alergia_alimento').attr('disabled',true).removeClass('obrigatorio').change();
				checkbox.parent('label').removeClass('active');
			}
        });
		
		ativarValidacao($("#form form"));

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