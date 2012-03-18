<div id="form" class="wrap">
<h2>Formulário de Inscrição > Participante</h2>
    <?php if(isset($erro) && $erro): ?>
        <div class="alert-message block-message error">
        <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>
<?php echo form_open_multipart('admin/inscrever/participante'); ?>

<div class="importante">
    <!-- Nome Completo -->
	<div class="clearfix">
		<label for="nm_pessoa">Nome Completo</label>
		<div class="input"><input type="text" class="xlarge" id="nm_pessoa" value="<?php echo set_value('nm_pessoa') ?>" name="nm_pessoa"></div>
	</div>
	<!-- Nome no Crachá -->
	<div class="clearfix">
		<label for="nm_cracha">Nome no Crachá</label>
		<div class="input"><input type="text" class="xlarge" id="nm_cracha" value="<?php echo set_value('nm_cracha') ?>" name="nm_cracha"></div>
	</div>
	<!-- Sexo -->
	<div class="clearfix">
		<label>Sexo</label>
		<div class="input"><ul class="inputs-list">
			<li><label for="ds_sexo_h"><input type="radio" id="ds_sexo_h" value="h" name="ds_sexo" <?php if(set_radio('ds_sexo', 'h')) echo 'checked' ?>>Homem</label></li>
			<li><label for="ds_sexo_m"><input type="radio" id="ds_sexo_m" value="m" name="ds_sexo" <?php if(set_radio('ds_sexo', 'm')) echo 'checked' ?>>Mulher</label></li>
		</ul></div>
	</div>
	<!-- Data de Nascimento -->
	<div class="clearfix">
		<label for="dt_nascimento">Data de Nascimento</label>
		<div class="input"><input type="text" class="small" id="dt_nascimento" value="<?php echo set_value('dt_nascimento') ?>" name="dt_nascimento"></div>
	</div>
	<!-- RG -->
	<div class="clearfix">
		<label for="nr_rg">RG</label>
		<div class="input"><input type="text" class="medium" id="nr_rg" value="<?php echo set_value('nr_rg') ?>" name="nr_rg"></div>
	</div>
	<!-- Cidade -->
	<div class="clearfix">
		<label for="id_cidade">Cidade</label>
		<div class="input"><?php echo form_dropdown('id_cidade', $cidades, $this->input->post('id_cidade')); ?></div>
	</div>
	<!-- Seminário/Aprofundamento -->
	<div class="clearfix">
		<label>O que fará no período da tarde?</label>
		<div class="input">
			<ul class="inputs-list">
				<li><label for="bl_seminario_s"><input type="radio" id="bl_seminario_s" value="1" name="bl_seminario" <?php if(set_radio('bl_seminario', '1')) echo 'checked' ?>>Seminário de Vida no Espírito Santo</label></li>
				<li><label for="bl_seminario_a"><input type="radio" id="bl_seminario_a" value="0" name="bl_seminario" <?php if(set_radio('bl_seminario', '0')) echo 'checked' ?>>Aprofundamento</label></li>
			</ul>
		</div>
	</div>
	<!-- Transporte -->
	<div class="clearfix">
		<label>Vai no ônibus do Acamp's?</label>
		<div class="input">
			<ul class="inputs-list">
				<li><label for="bl_transporte_s"><input type="radio" id="bl_transporte_s" value="1" name="bl_transporte" <?php if(set_radio('bl_transporte', '1')) echo 'checked' ?>>Sim</label></li>
				<li><label for="bl_transporte_n"><input type="radio" id="bl_transporte_n" value="0" name="bl_transporte" <?php if(set_radio('bl_transporte', '0')) echo 'checked' ?>>Não</label></li>
			</ul>
		</div>
	</div>
</div>
	
	<!-- E-mail -->
	<div class="clearfix">
		<label for="ds_email">E-mail</label>
		<div class="input">
			<input type="text" id="ds_email" value="<?php echo set_value('ds_email') ?>" name="ds_email">
		</div>
	</div>
    <!-- Telefone -->
	<div class="clearfix">
		<label for="nr_telefone">Telefone</label>
		<div class="input">
			<input type="text" class="medium" id="nr_telefone" value="<?php echo set_value('nr_telefone') ?>" name="nr_telefone">
		</div>
	</div>
<hr/>
	<!-- Alimentação -->
	<div class="clearfix">
		<label>Você utilizará a alimentação fornecida por nós?</label>
		<div class="input">
			<ul class="inputs-list">
				<li><label for="bl_alimentacao_s"><input type="radio" id="bl_alimentacao_s" value="1" name="bl_alimentacao" <?php if(set_radio('bl_alimentacao', '1')) echo 'checked' ?>>Sim</label></li>
				<li><label for="bl_alimentacao_n"><input type="radio" id="bl_alimentacao_n" value="0" name="bl_alimentacao" <?php if(set_radio('bl_alimentacao', '0')) echo 'checked' ?>>Não</label></li>
			</ul>
		</div>
	</div>
    <!-- Barracão -->
	<div class="clearfix">
		<label>Você utilizará uma das barracas coletivas ou uma barraca particular?</label>
		<div class="input">
			<ul class="inputs-list">
				<li><label for="bl_barracao_s"><input type="radio" id="bl_barracao_s" value="1" name="bl_barracao" <?php if(set_radio('bl_barracao', '1')) echo 'checked' ?>>Barraca Coletiva</label></li>
				<li><label for="bl_barracao_n"><input type="radio" id="bl_barracao_n" value="0" name="bl_barracao" <?php if(set_radio('bl_barracao', '0')) echo 'checked' ?>>Barraca Particular</label></li>
			</ul>
		</div>
	</div>
<hr>
	<!-- Já fez 1ª Eucaristia? -->
	<div class="clearfix">
		<label>Já fez primeira eucaristia?</label>
		<div class="input">
			<ul class="inputs-list">
				<li><label for="bl_fez_comunhao_s"><input type="radio" id="bl_fez_comunhao_s" value="1" name="bl_fez_comunhao" <?php if(set_radio('bl_fez_comunhao', '1')) echo 'checked' ?>>Sim</label></li>
				<li><label for="bl_fez_comunhao_n"><input type="radio" id="bl_fez_comunhao_n" value="0" name="bl_fez_comunhao" <?php if(set_radio('bl_fez_comunhao', '0')) echo 'checked' ?>>Não</label></li>
			</ul>
		</div>
	</div>
	<!-- Fazer 1ª Eucaristia? -->
	<div class="clearfix">
		<label>Deseja fazer durante o acampamento?</label>
		<div class="input">
			<ul class="inputs-list">
				<li><label for="bl_fazer_comunhao_s"><input type="radio" class="" id="bl_fazer_comunhao_s" value="1" name="bl_fazer_comunhao" <?php if(set_radio('bl_fazer_comunhao', '1')) echo 'checked' ?>>Sim</label></li>
				<li><label for="bl_fazer_comunhao_n"><input type="radio" class="" id="bl_fazer_comunhao_n" value="0" name="bl_fazer_comunhao" <?php if(set_radio('bl_fazer_comunhao', '0')) echo 'checked' ?>>Não</label></li>
			</ul>
		</div>
	</div>
<hr/>
	<!-- ALergia a Remédios -->
	<div class="clearfix">
		<label for="nm_alergia_remedio">Você tem alergia a remédios?</label>
		<div class="input input-prepend">
			<label class="add-on"><input type="checkbox" name="bl_alergia_remedio" value="1" id="bl_alergia_remedio"  <?php if(set_checkbox('bl_alergia_remedio', '1')) echo 'checked' ?>/></label>
			<input type="text" class="xlarge" id="nm_alergia_remedio" value="" name="nm_alergia_remedio">
		</div>
	</div>
	<!-- Alergia a Alimentos -->
	<div class="clearfix">
		<label for="nm_alergia_alimento">Você tem alergia a alimentos?</label>
		<div class="input input-prepend">
			<label class="add-on"><input type="checkbox" name="bl_alergia_alimento" value="1" id="bl_alergia_alimento"  <?php if(set_checkbox('bl_alergia_alimento', '1')) echo 'checked' ?>/></label>
			<input type="text" class="xlarge" id="nm_alergia_alimento" value="" name="nm_alergia_alimento">
		</div>
	</div>
<hr/>
	<!-- Endereço -->
	<div class="clearfix">
		<label for="ds_endereco">Endereço</label>
		<div class="input"><input type="text" class="xlarge" id="ds_endereco" value="<?php echo set_value('ds_endereco') ?>" name="ds_endereco"></div>
	</div>
	<!-- CEP -->
	<div class="clearfix">
		<label for="nr_cep">CEP</label>
		<div class="input"><input type="text" class="small" id="nr_cep" value="<?php echo set_value('nr_cep') ?>" name="nr_cep"></div>
	</div>
	<!-- Bairro -->
	<div class="clearfix">
		<label for="ds_bairro">Bairro</label>
		<div class="input"><input type="text" id="ds_bairro" value="<?php echo set_value('ds_bairro') ?>" name="ds_bairro"></div>
	</div>
<hr/>
	<!-- Telefone para Emergência (1) -->
	<div class="clearfix">
		<label for="nr_emergencia1">Telefone para Emergência (1)</label>
		<div class="input">
			<input type="text" class="medium" id="nr_emergencia1" value="<?php echo set_value('nr_emergencia1') ?>" name="nr_emergencia1">
		</div>
	</div>
	<!-- Nome do Responsável (1) -->
	<div class="clearfix">
		<label for="nm_emergencia1">Nome do Responsável (1)</label>
		<div class="input">
			<input type="text" class="xlarge" id="nm_emergencia1" value="<?php echo set_value('nm_emergencia1') ?>" name="nm_emergencia1">
		</div>
	</div>
	<!-- Telefone para Emergência (2) -->
	<div class="clearfix">
		<label for="nr_emergencia2">Telefone para Emergência (2) <span style="color:#006bcc">(opcional)</span></label>
		<div class="input">
			<input type="text" class="medium" id="nr_emergencia2" value="<?php echo set_value('nr_emergencia2') ?>" name="nr_emergencia2">
		</div>
	</div>
	<!-- Nome do Responsável (2) -->
	<div class="clearfix">
		<label class="campo" for="nm_emergencia2">Nome do Responsável (2) <span style="color:#006bcc">(opcional)</span></label>
		<div class="input">
			<input type="text" class="xlarge" id="nm_emergencia2" value="<?php echo set_value('nm_emergencia2') ?>" name="nm_emergencia2">
		</div>
	</div>
<hr>
	<!-- Foto -->
	<div class="clearfix">
		<label class="campo" for="ds_foto">Envie sua foto para o seu crachá</label>
		<div class="input">
			<input type="file" size="32" class="obrigatorio" value="<?php echo set_value('ds_foto') ?>" name="ds_foto" id="ds_foto"><span class="help-block">O tamanho máximo aceito para a foto é 4MB.<br>Formatos aceitos: bmp | jpg | png | gif</span>
		</div>
	</div>
	<p class="center"><input type="submit" value="Confirmar" name="confirmar" class="btn success large" /></p>
    <?php echo form_close();?>
</div>
<script>

    $(function(){
        
        // Alterando edição dos campos de alergia
		$('#nm_alergia_remedio').attr('disabled',true);
		$('#nm_alergia_alimento').attr('disabled',true);
		
        $('#bl_alergia_remedio').change(function(){
			checkbox = $(this);
			if( checkbox.attr('checked') == "checked" ){
				$('#nm_alergia_remedio').attr('disabled',false);
				checkbox.parent('label').addClass('active');
			}else{
				$('#nm_alergia_remedio').attr('disabled',true);
				checkbox.parent('label').removeClass('active');
			}
        });
		
        $('#bl_alergia_alimento').change(function(){
			checkbox = $(this);
            if( checkbox.attr('checked') == "checked" ){
				$('#nm_alergia_alimento').attr('disabled',false);
				checkbox.parent('label').addClass('active');
			}else{
				$('#nm_alergia_alimento').attr('disabled',true);
				checkbox.parent('label').removeClass('active');
			}
        });
		
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
			buttonImage: "<?php echo $this->config->item('img_url'); ?>calendar.png",
			buttonImageOnly: true
		});
    })
    
</script>