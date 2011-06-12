<div id="form">
<h2>Formulário de Inscrição > Serviço</h2>
    <?php if(isset($erro) && $erro): ?>
        <div class="erro_onsubmit">
        <?php echo validation_errors(); ?>
        </div>
        <br/>
    <?php endif; ?>
<?php echo form_open_multipart('admin/inscrever/servico'); ?>

<div class="importante">
    <p>
    <?php echo form_label('Nome Completo','nm_pessoa',array('class'=>'campo'));
        echo form_input(array(
            'name'=>'nm_pessoa',
            'id'=>'nm_pessoa',
            'value'=> set_value('nm_pessoa'),
            'class'=>'obrigatorio somenteLetras'
        ));
    ?>
    </p>
	<p>
    <?php echo form_label('Nome no Crachá','nm_cracha',array('class'=>'campo'));
		echo form_input(array(
            'name'=>'nm_cracha',
            'id'=>'nm_cracha',
            'value'=> set_value('nm_cracha'),
        ));
    ?>
    </p>
	<p>
    <?php echo form_label('Sexo','',array('class'=>'campo'));
	echo form_radio(array(
        'name'=>'ds_sexo',
        'id'=>'ds_sexo_h',
        'value'=>'h',
        'checked'=> set_radio('ds_sexo', 'h'),
    ));
    echo form_label('Homem','ds_sexo_h');
    echo nbs(7);
    echo form_radio(array(
        'name'=>'ds_sexo',
        'id'=>'ds_sexo_m',
        'value'=>'m',
        'checked'=> set_radio('ds_sexo', 'm'),
    ));
    echo form_label('Mulher','ds_sexo_m');
    ?>
    </p>
	<p>
    <?php echo form_label('RG','nr_rg',array('class'=>'campo'));
		echo form_input(array(
            'name'=>'nr_rg',
            'id'=>'nr_rg',
            'value'=> set_value('nr_rg'),
        ));
    ?>
    </p>
	<p>
    <?php echo form_label('Cidade','id_cidade',array('class'=>'campo'));
	echo form_dropdown('id_cidade', $cidades, $this->input->post('id_cidade'));
    ?>
    </p>
	<p>
    <?php echo form_label('Serviço','',array('class'=>'campo'));
    echo form_dropdown('id_servico', $servicos, $this->input->post('id_servico'));
    ?>
    </p>
</div>
	<p>
    <?php echo form_label('Data de Nascimento','dt_nascimento',array('class'=>'campo'));
	echo form_input(array(
        'name'=>'dt_nascimento',
        'id'=>'dt_nascimento',
        'value'=> set_value('dt_nascimento'),
    ));
    ?>
    </p>
    <p>
    <?php echo form_label('E-mail','ds_email',array('class'=>'campo'));
	echo form_input(array(
        'name'=>'ds_email',
        'id'=>'ds_email',
        'value'=> set_value('ds_email'),
    ));
    ?>
    </p>
    <p>
    <?php echo form_label('Telefone','nr_telefone',array('class'=>'campo'));
	echo form_input(array(
        'name'=>'nr_telefone',
        'id'=>'nr_telefone',
        'value'=> set_value('nr_telefone'),
    ));
    ?>
    </p>
	
    <hr/>
	
	<p>
    <?php echo form_label('Alimentação?','',array('class'=>'campo'));
    echo form_radio(array(
        'name'=>'bl_alimentacao',
        'id'=>'bl_alimentacao_s',
        'value'=>'1',
        'checked'=> set_radio('bl_alimentacao', '1'),
    ));
    echo form_label('Sim','bl_alimentacao_s');
    echo nbs(5);
    echo form_radio(array(
        'name'=>'bl_alimentacao',
        'id'=>'bl_alimentacao_n',
        'value'=>'0',
        'checked'=> set_radio('bl_alimentacao', '0'),
    ));
    echo form_label('Não','bl_alimentacao_n');
    ?>
    </p>
    <p>
    <?php echo form_label('Utilizará o barracão?','',array('class'=>'campo'));
	echo form_radio(array(
        'name'=>'bl_barracao',
        'id'=>'bl_barracao_s',
        'value'=>'1',
        'checked'=> set_radio('bl_barracao', '1'),
    ));
    echo form_label('Sim','bl_barracao_s');
    echo nbs(8);
    echo form_radio(array(
        'name'=>'bl_barracao',
        'id'=>'bl_barracao_n',
        'value'=>'0',
        'checked'=> set_radio('bl_barracao', '0'),
    ));
    echo form_label('Não','bl_barracao_n');
    ?>
    </p>
    <p>
    <?php echo form_label('Precisará de transporte do acampamento?','',array('class'=>'campo'));
	echo form_radio(array(
        'name'=>'bl_transporte',
        'id'=>'bl_transporte_s',
        'value'=>'1',
        'checked'=> set_radio('bl_transporte', '1'),
    ));
    echo form_label('Sim','bl_transporte_s');
    echo nbs(5);
    echo form_radio(array(
        'name'=>'bl_transporte',
        'id'=>'bl_transporte_n',
        'value'=>'0',
        'checked'=> set_radio('bl_transporte', '0'),
    ));
    echo form_label('Não','bl_transporte_n');
    ?>
    </p>
    
	<hr/>
	
    <p>
    <?php echo form_label('Você tem alergia a remédios?','',array('class'=>'campo'));
	echo form_radio(array(
        'name'=>'bl_alergia_remedio',
        'id'=>'bl_alergia_remedio_s',
        'value'=>'1',
        'checked'=> set_radio('bl_alergia_remedio', '1'),
    ));
    echo form_label('Sim','bl_alergia_remedio_s');
    echo nbs(5);
    echo form_radio(array(
        'name'=>'bl_alergia_remedio',
        'id'=>'bl_alergia_remedio_n',
        'value'=>'0',
        'checked'=> set_radio('bl_alergia_remedio', '0'),
    ));
    echo form_label('Não','bl_alergia_remedio_n');
    ?>
    </p>
    <p>
    <?php echo form_label('Qual?','nm_alergia_remedio',array('class'=>'campo'));
	echo form_input(array(
        'name'=>'nm_alergia_remedio',
        'id'=>'nm_alergia_remedio',
        'value'=> set_value('nm_alergia_remedio'),
    ));
    ?>
    </p>
    <p>
    <?php echo form_label('Você tem alergia a alimentos?','',array('class'=>'campo'));
	echo form_radio(array(
        'name'=>'bl_alergia_alimento',
        'id'=>'bl_alergia_alimento_s',
        'value'=>'1',
        'checked'=> set_radio('bl_alergia_alimento', '1'),
    ));
    echo form_label('Sim','bl_alergia_alimento_s');
    echo nbs(5);
    echo form_radio(array(
        'name'=>'bl_alergia_alimento',
        'id'=>'bl_alergia_alimento_n',
        'value'=>'0',
        'checked'=> set_radio('bl_alergia_alimento', '0'),
    ));
    echo form_label('Não','bl_alergia_alimento_n');
    ?>
    </p>
    <p>
    <?php echo form_label('Qual?','nm_alergia_alimento',array('class'=>'campo'));
	echo form_input(array(
        'name'=>'nm_alergia_alimento',
        'id'=>'nm_alergia_alimento',
        'value'=> set_value('nm_alergia_alimento'),
    ));
    ?>
    </p>
	
	<hr/>
	
    <p>
    <?php echo form_label('Endereço','ds_endereco',array('class'=>'campo'));
	echo form_input(array(
        'name'=>'ds_endereco',
        'id'=>'ds_endereco',
        'value'=> set_value('ds_endereco'),
    ));
    ?>
    </p>
    <p>
    <?php echo form_label('CEP','nr_cep',array('class'=>'campo'));
	echo form_input(array(
        'name'=>'nr_cep',
        'id'=>'nr_cep',
        'value'=> set_value('nr_cep'),
    ));
    ?>
    </p>
    <p>
    <?php echo form_label('Bairro','ds_bairro',array('class'=>'campo'));
	echo form_input(array(
        'name'=>'ds_bairro',
        'id'=>'ds_bairro',
        'value'=> set_value('ds_bairro'),
    ));
    ?>
    </p>
	
    <hr/>
	
    <p>
    <?php echo form_label('Telefone para Emergência (1)','nr_emergencia1',array('class'=>'campo'));
    echo form_input(array(
        'name'=>'nr_emergencia1',
        'id'=>'nr_emergencia1',
        'value'=> set_value('nr_emergencia1'),
    ));
    ?>
    </p>
    <p>
    <?php echo form_label('Nome do Responsável (1)','nm_emergencia1',array('class'=>'campo'));
    echo form_input(array(
        'name'=>'nm_emergencia1',
        'id'=>'nm_emergencia1',
        'value'=> set_value('nm_emergencia1'),
    ));
    ?>
    </p>
    <p>
    <?php echo form_label('Telefone para Emergência (2)</span>','nr_emergencia2',array('class'=>'campo'));
    echo form_input(array(
        'name'=>'nr_emergencia2',
        'id'=>'nr_emergencia2',
        'value'=> set_value('nr_emergencia2'),
    ));
    ?>
    </p>
    <p>
    <?php echo form_label('Nome do Responsável (2)','nm_emergencia2',array('class'=>'campo'));
    echo form_input(array(
        'name'=>'nm_emergencia2',
        'id'=>'nm_emergencia2',
        'value'=> set_value('nm_emergencia2'),
    ));
    ?>
    </p>
    
	<p>
    <?php echo form_label('Enviar foto','ds_foto',array('class'=>'campo'));
    echo form_upload(array(
        'name'=>'ds_foto',
        'value'=> set_value('ds_foto'),
        'size'=>50
    ));
    ?>
	</p>
	<p class="center"><?php echo form_submit('confirmar','Confirmar'); ?></p>
    <?php echo form_close();?>
</div>
<script>

    $(function(){
        
        // Alterando obrigatoriedade dos campos de alergia
        $('#bl_alergia_remedio_s').click(function(){
            $('#nm_alergia_remedio').attr('disabled',false);
        });
        $('#bl_alergia_remedio_n').click(function(){
            $('#nm_alergia_remedio').attr('disabled',true);
        });
        $('#bl_alergia_alimento_s').click(function(){
            $('#nm_alergia_alimento').attr('disabled',false);
        });
        $('#bl_alergia_alimento_n').click(function(){
            $('#nm_alergia_alimento').attr('disabled',true);
        });
		
		$('#dt_nascimento').datepicker({
			yearRange: '1980:2000',
			changeMonth: true,
			changeYear: true,
			onClose: function(dateText, inst){
				$(this).change();
			},
			showOn: "button",
			buttonImage: "<?php echo assets_url('image') ?>calendar.png",
			buttonImageOnly: true
		});
    })
    
</script>