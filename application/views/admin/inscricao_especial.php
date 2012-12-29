<div class="form">
<h2>Formulário de Inscrição - Especial</h2>
    <?php if(isset($erro) && $erro): ?>
        <div class="alert alert-error alert-block">
        <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>
<?php echo form_open_multipart('admin/inscrever/especial', array('class'=>'form-horizontal')); ?>

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
	<!-- Serviço -->
	<div class="control-group">
		<label for="id_servico" class="control-label">Serviço</label>
		<div class="controls"><?php echo form_dropdown('id_servico', $servicos, $this->input->post('id_servico')); ?></div>
	</div>
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
</div>
<p align="center"><input type="submit" value="Confirmar" name="confirmar" class="btn btn-primary btn-large" /></p>
<?php echo form_close();?>
</div>