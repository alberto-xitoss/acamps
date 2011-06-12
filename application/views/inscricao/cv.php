<h2>Formulário de Inscrição > Comunidade de Vida</h2>
<div id="form">
    <?php if(isset($erro) && $erro): ?>
        <div class="erro_onsubmit"
        <?php echo validation_errors(); ?>
        </div><br/>
    <?php endif; ?>
    
<?php echo form_open_multipart('inscricao/cv'); ?>
    <p>
    <?php echo form_label('Nome Completo','nm_pessoa',array('class'=>'campo')); ?>
    </p>
    <p>
    <?php echo form_input(array(
            'name'=>'nm_pessoa',
            'id'=>'nm_pessoa',
            'value'=> set_value('nm_pessoa'),
            'class'=>'obrigatorio somenteLetras'
	)); ?>
    </p>
    <p>
    <?php echo form_label('Nome no Crachá','nm_cracha',array('class'=>'campo')); ?>
    </p>
    <p>
    <?php echo form_input(array(
            'name'=>'nm_cracha',
            'id'=>'nm_cracha',
            'value'=> set_value('nm_cracha'),
            'class'=>'obrigatorio somenteLetras'
    )); ?>
    </p>
    <p>
    <?php echo form_label('Data de Nascimento','dt_nascimento',array('class'=>'campo')); ?>
    </p>
    <p>
    <?php echo form_input(array(
        'name'=>'dt_nascimento',
        'id'=>'dt_nascimento',
        'value'=> set_value('dt_nascimento'),
        'class'=>'short obrigatorio data'
    )); ?>
    </p>
    <p>
    <?php echo form_label('Sexo','',array('class'=>'campo')); ?>
    </p>
    <p>
    <?php
    echo form_radio(array(
        'name'=>'ds_sexo',
        'id'=>'ds_sexo_h',
        'value'=>'h',
        'checked'=> set_radio('ds_sexo', 'h'),
        'class'=>'obrigatorio'
    ));
    echo form_label('Homem','ds_sexo_h');
    echo nbs(5);
    echo form_radio(array(
        'name'=>'ds_sexo',
        'id'=>'ds_sexo_m',
        'value'=>'m',
        'checked'=> set_radio('ds_sexo', 'm'),
        'class'=>'obrigatorio'
    ));
    echo form_label('Mulher','ds_sexo_m');
    ?>
    </p>

    <hr/>

    <p>
		<?php echo form_label('Serviço','',array('class'=>'campo')); ?>
    </p>
    <p>
		<?php echo form_dropdown('id_servico', $servicos, $this->input->post('id_servico'), 'class="obrigatorio"'); ?>
    </p>

    <p>
		<?php echo form_label('Setor','',array('class'=>'campo')) ?>
    </p>
    <p>
		<?php echo form_dropdown('id_setor', $setores, $this->input->post('id_setor'), 'class="obrigatorio"') ?>
    </p>

    <hr/>

    <p>
    <?php echo form_label('Alimentação?','',array('class'=>'campo'));
	?><span class="ajuda_icone"></span><span class="ajuda_texto">Você utilizará a alimentação fornecida por nós?</span>
    </p>
    <p>
    <?php
    echo form_radio(array(
        'name'=>'bl_alimentacao',
        'id'=>'bl_alimentacao_s',
        'value'=>'1',
        'checked'=> set_radio('bl_alimentacao', '1'),
        'class'=>'obrigatorio'
    ));
    echo form_label('Sim','bl_alimentacao_s');
    echo nbs(5);
    echo form_radio(array(
        'name'=>'bl_alimentacao',
        'id'=>'bl_alimentacao_n',
        'value'=>'0',
        'checked'=> set_radio('bl_alimentacao', '0'),
        'class'=>'obrigatorio'
    ));
    echo form_label('Não','bl_alimentacao_n');
    ?>
    </p>

    <hr/>

    <p>
    <?php echo form_label('Alergia a alimentos?','',array('class'=>'campo')); ?>
    </p>
    <p>
    <?php
    echo form_radio(array(
        'name'=>'bl_alergia_alimento',
        'id'=>'bl_alergia_alimento_s',
        'value'=>'1',
        'checked'=> set_radio('bl_alergia_alimento', '1'),
        'class'=>'obrigatorio'
    ));
    echo form_label('Sim','bl_alergia_alimento_s');
    echo nbs(5);
    echo form_radio(array(
        'name'=>'bl_alergia_alimento',
        'id'=>'bl_alergia_alimento_n',
        'value'=>'0',
        'checked'=> set_radio('bl_alergia_alimento', '0'),
        'class'=>'obrigatorio'
    ));
    echo form_label('Não','bl_alergia_alimento_n');
    ?>
    </p>
    <p>
    <?php echo form_label('Qual?','nm_alergia_alimento',array('class'=>'campo')); ?>
    </p>
    <p>
    <?php
    echo form_input(array(
        'name'=>'nm_alergia_alimento',
        'id'=>'nm_alergia_alimento',
        'value'=> set_value('nm_alergia_alimento'),
        'class'=>'somenteAlfanumerico'
    ));
    ?>
    </p>

    <hr/>

    <p>
    <?php
    echo form_label('Envie sua foto <span style="color:#006bcc">(opcional)</span>','ds_foto',array('class'=>'campo'));
    ?><span class="ajuda_icone"></span><span class="ajuda_texto">Tamanho máximo da imagem: 400x400 ou 2MB<br/>Formatos aceitos: bmp|jpg|png|gif</span>
    </p>
    <p>
    <?php
    echo form_upload(array(
        'name'=>'ds_foto',
        'value'=> set_value('ds_foto'),
        'class'=>'',
        'size'=>50
    ));
    ?></p>
    <p class="center"><?php echo form_submit('confirmar','Confirmar'); ?></p>
    <?php echo form_close();?>
</div>
<script>

    $(function(){
		$('#bl_alergia_alimento_s').click(function(){
            $('#nm_alergia_alimento').attr('disabled',false).addClass('obrigatorio').change();
        });
        $('#bl_alergia_alimento_n').click(function(){
            $('#nm_alergia_alimento').attr('disabled',true).removeClass('obrigatorio').removeData('obrigatorio').change();
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
			buttonImage: "<?php echo assets_url('image') ?>calendar.png",
			buttonImageOnly: true
		});

       $(".ajuda_icone").hover(function(){
            $(this).siblings('.ajuda_texto').stop().attr('style','').animate({
            opacity: 'show'
            },150);
        },function(){
            $(this).siblings('.ajuda_texto').stop().attr('style','').animate({
            opacity: 'hide'
            },150);
        });
    })

</script>