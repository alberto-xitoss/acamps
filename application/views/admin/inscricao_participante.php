<div class="form">
<h2>Formulário de Inscrição > Participante</h2>
    <?php if(isset($erro) && $erro): ?>
        <div class="alert alert-error alert-block">
        <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>
<?php echo form_open_multipart('admin/inscrever/participante', array('class'=>'form-horizontal')); ?>

<div class="importante">
	<!-- Nome Completo -->
	<div class="control-group">
		<label for="nm_pessoa" class="control-label">Nome Completo</label>
		<div class="controls"><input type="text" class="span5" id="nm_pessoa" value="<?php echo set_value('nm_pessoa') ?>" name="nm_pessoa"></div>
	</div>
	<!-- Nome no Crachá -->
	<div class="control-group">
		<label for="nm_cracha" class="control-label">Nome no Crachá</label>
		<div class="controls"><input type="text" class="span5" id="nm_cracha" value="<?php echo set_value('nm_cracha') ?>" name="nm_cracha"></div>
	</div>
	<!-- Sexo -->
	<div class="control-group">
		<label class="control-label">Sexo</label>
		<div class="controls">
			<label for="ds_sexo_h" class="radio">
				<input type="radio" id="ds_sexo_h" value="h" name="ds_sexo" <?php if(set_radio('ds_sexo', 'h')) echo 'checked' ?>>Homem
			</label>
			<label for="ds_sexo_m" class="radio">
				<input type="radio" id="ds_sexo_m" value="m" name="ds_sexo" <?php if(set_radio('ds_sexo', 'm')) echo 'checked' ?>>Mulher
			</label>
		</div>
	</div>
	<!-- Data de Nascimento -->
	<div class="control-group">
		<label for="dt_nascimento" class="control-label">Data de Nascimento</label>
		<div class="controls"><input type="text" class="span2" id="dt_nascimento" value="<?php echo set_value('dt_nascimento') ?>" name="dt_nascimento"></div>
	</div>
	<!-- RG -->
	<div class="control-group">
		<label for="nr_rg" class="control-label">RG</label>
		<div class="controls"><input type="text" class="span2" id="nr_rg" value="<?php echo set_value('nr_rg') ?>" name="nr_rg"></div>
	</div>
	<!-- Cidade -->
	<div class="control-group">
		<label for="id_cidade" class="control-label">Cidade</label>
		<div class="controls"><?php echo form_dropdown('id_cidade', $cidades, $this->input->post('id_cidade')); ?></div>
	</div>
	<!-- Seminário/Aprofundamento -->
	<div class="control-group">
		<label class="control-label">O que fará no período da tarde?</label>
		<div class="controls">
			<label for="bl_seminario_s"  class="radio">
				<input type="radio" id="bl_seminario_s" value="1" name="bl_seminario" <?php if(set_radio('bl_seminario', '1')) echo 'checked' ?>>Seminário de Vida no Espírito Santo
			</label>
			<label for="bl_seminario_a"  class="radio">
				<input type="radio" id="bl_seminario_a" value="0" name="bl_seminario" <?php if(set_radio('bl_seminario', '0')) echo 'checked' ?>>Aprofundamento
			</label>
		</div>
	</div>
	<!-- Transporte -->
	<div class="control-group">
		<label class="control-label">Precisará de transporte para o Acampamento?</label>
		<div class="controls">
			<label for="bl_transporte_s"  class="radio"><input type="radio" id="bl_transporte_s" value="1" name="bl_transporte" <?php if(set_radio('bl_transporte', '1')) echo 'checked' ?>>Sim</label>
			<label for="bl_transporte_n"  class="radio"><input type="radio" id="bl_transporte_n" value="0" name="bl_transporte" <?php if(set_radio('bl_transporte', '0')) echo 'checked' ?>>Não</label>
		</div>
	</div>
</div>

<!-- Família -->
<div class="control-group">
	<label for="id_familia" class="control-label">Família</label>
	<div class="controls"><?php echo form_dropdown('id_familia', $familias, $this->input->post('id_familia')); ?></div>
</div>
<hr/>
<!-- E-mail -->
<div class="control-group">
	<label for="ds_email"  class="control-label">E-mail</label>
	<div class="controls">
		<input type="text" id="ds_email" value="<?php echo set_value('ds_email') ?>" name="ds_email"/>
	</div>
</div>
<!-- Telefone -->
<div class="control-group">
	<label for="nr_telefone"  class="control-label">Telefone</label>
	<div class="controls">
		<input type="text" class="span2" id="nr_telefone" value="<?php echo set_value('nr_telefone') ?>" name="nr_telefone">
	</div>
</div>
<hr/>
<!-- Alimentação -->
<div class="control-group">
	<label class="control-label">Utilizará a alimentação fornecida por nós?</label>
	<div class="controls">
		<label for="bl_alimentacao_s"  class="radio">
			<input type="radio" id="bl_alimentacao_s" value="1" name="bl_alimentacao" <?php if(set_radio('bl_alimentacao', '1')) echo 'checked' ?>>Sim
		</label>
		<label for="bl_alimentacao_n"  class="radio">
			<input type="radio" id="bl_alimentacao_n" value="0" name="bl_alimentacao" <?php if(set_radio('bl_alimentacao', '0')) echo 'checked' ?>>Não
		</label>
	</div>
</div>
<!-- Barracão -->
<div class="control-group">
	<label class="control-label">Utilizará uma das barracas coletivas ou uma barraca particular?</label>
	<div class="controls">
		<label for="bl_barracao_s"  class="radio">
			<input type="radio" id="bl_barracao_s" value="1" name="bl_barracao" <?php if(set_radio('bl_barracao', '1')) echo 'checked' ?>>Barraca Coletiva
		</label>
		<label for="bl_barracao_n"  class="radio">
			<input type="radio" id="bl_barracao_n" value="0" name="bl_barracao" <?php if(set_radio('bl_barracao', '0')) echo 'checked' ?>>Barraca Particular
		</label>
	</div>
</div>
<hr>
<!-- Já fez 1ª Eucaristia? -->
<div class="control-group">
	<label class="control-label">Já fez primeira eucaristia?</label>
	<div class="controls">
		<label for="bl_fez_comunhao_s"  class="radio"><input type="radio" id="bl_fez_comunhao_s" value="1" name="bl_fez_comunhao" <?php if(set_radio('bl_fez_comunhao', '1')) echo 'checked' ?>>Sim</label>
		<label for="bl_fez_comunhao_n"  class="radio"><input type="radio" id="bl_fez_comunhao_n" value="0" name="bl_fez_comunhao" <?php if(set_radio('bl_fez_comunhao', '0')) echo 'checked' ?>>Não</label>
	</div>
</div>
<!-- Fazer 1ª Eucaristia? -->
<div class="control-group">
	<label class="control-label">Deseja fazer durante o acampamento?</label>
	<div class="controls">
		<label for="bl_fazer_comunhao_s"  class="radio"><input type="radio" class="" id="bl_fazer_comunhao_s" value="1" name="bl_fazer_comunhao" <?php if(set_radio('bl_fazer_comunhao', '1')) echo 'checked' ?>/>Sim</label>
		<label for="bl_fazer_comunhao_n"  class="radio"><input type="radio" class="" id="bl_fazer_comunhao_n" value="0" name="bl_fazer_comunhao" <?php if(set_radio('bl_fazer_comunhao', '0')) echo 'checked' ?>/>Não</label>
	</div>
</div>
<hr/>
<!-- ALergia a Remédios -->
<div class="control-group">
	<label for="nm_alergia_remedio"  class="control-label">Tem alergia a remédios?</label>
	<div class="controls">
		<input type="text" class="span5" id="nm_alergia_remedio" value="" name="nm_alergia_remedio"/>
	</div>
</div>
<!-- Alergia a Alimentos -->
<div class="control-group">
	<label for="nm_alergia_alimento"  class="control-label">Tem alergia a alimentos?</label>
	<div class="controls">
		<input type="text" class="span5" id="nm_alergia_alimento" value="" name="nm_alergia_alimento"/>
	</div>
</div>
<hr/>
<!-- Endereço -->
<div class="control-group">
	<label for="ds_endereco" class="control-label">Endereço</label>
	<div class="controls"><input type="text" class="span5" id="ds_endereco" value="<?php echo set_value('ds_endereco') ?>" name="ds_endereco"></div>
</div>
<!-- CEP -->
<div class="control-group">
	<label for="nr_cep" class="control-label">CEP</label>
	<div class="controls"><input type="text" class="span2" id="nr_cep" value="<?php echo set_value('nr_cep') ?>" name="nr_cep"></div>
</div>
<!-- Bairro -->
<div class="control-group">
	<label for="ds_bairro"  class="control-label">Bairro</label>
	<div class="controls"><input type="text" id="ds_bairro" value="<?php echo set_value('ds_bairro') ?>" name="ds_bairro"></div>
</div>
<hr/>
<!-- Telefone para Emergência (1) -->
<div class="control-group">
	<label for="nr_emergencia1"  class="control-label">Telefone para Emergência (1)</label>
	<div class="controls">
		<input type="text" class="span2" id="nr_emergencia1" value="<?php echo set_value('nr_emergencia1') ?>" name="nr_emergencia1">
	</div>
</div>
<!-- Nome do Responsável (1) -->
<div class="control-group">
	<label for="nm_emergencia1"  class="control-label">Nome do Responsável (1)</label>
	<div class="controls">
		<input type="text" class="span5" id="nm_emergencia1" value="<?php echo set_value('nm_emergencia1') ?>" name="nm_emergencia1">
	</div>
</div>
<!-- Telefone para Emergência (2) -->
<div class="control-group">
	<label for="nr_emergencia2" class="control-label">Telefone para Emergência (2)</label>
	<div class="controls">
		<input type="text" class="telefone span2" id="nr_emergencia2" value="<?php echo set_value('nr_emergencia2') ?>" name="nr_emergencia2">
	</div>
</div>
<!-- Nome do Responsável (2) -->
<div class="control-group">
	<label class="control-label" for="nm_emergencia2">Nome do Responsável (2)</label>
	<div class="controls">
		<input type="text" class="somenteLetras span5" id="nm_emergencia2" value="<?php echo set_value('nm_emergencia2') ?>" name="nm_emergencia2">
	</div>
</div>
<hr>
<!-- Foto -->
<div class="control-group">
	<label for="ds_foto" class="control-label">Envie a foto para o crachá</label>
	<div class="controls">
		<input type="file" size="32" class="obrigatorio" value="<?php echo set_value('ds_foto') ?>" name="ds_foto" id="ds_foto">
	</div>
</div>
<p align="center"><input type="submit" value="Confirmar" name="confirmar" class="btn btn-primary btn-large" /></p>
<?php echo form_close();?>
</div>

<script>

    $(function()
	{
        // Alterando edição do campo 1ª Eucaristia
        $('#bl_fez_comunhao_n').click(function(){
            $('[name=bl_fazer_comunhao]').attr('disabled',false);
        });
        $('#bl_fez_comunhao_s').click(function(){
            $('[name=bl_fazer_comunhao]').attr('disabled',true);
        });
		
		$('#dt_nascimento').datepicker({
			yearRange: '1980:2000',
			changeMonth: true,
			changeYear: true,
			onClose: function(dateText, inst){
				$(this).change();
			},
			showOn: "button",
			buttonImage: "<?php echo img_url() ?>calendar.png",
			buttonImageOnly: true
		});
    })
    
</script>