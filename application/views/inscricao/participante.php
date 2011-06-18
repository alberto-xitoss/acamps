<h2>Formulário de Inscrição</h2>
<div id="form">
    <?php if(isset($erro) && $erro): ?>
        <div class="erro_onsubmit">
        <?php echo validation_errors(); ?>
        </div>
        <br/>
    <?php endif; ?>
<?php echo form_open_multipart('inscricao/participante'); ?>
    <p>
    <?php
        echo form_label('Nome Completo','nm_pessoa',array('class'=>'campo'));
	?>
    </p>
    <p>
    <?php
        echo form_input(array(
            'name'=>'nm_pessoa',
            'id'=>'nm_pessoa',
            'value'=> set_value('nm_pessoa'),
            'class'=>'obrigatorio somenteLetras'
        ));
    ?>
    </p>
    <p>
    <?php
        echo form_label('Nome no Crachá','nm_cracha',array('class'=>'campo'));
    ?>
    </p>
    <p>
    <?php
		echo form_input(array(
            'name'=>'nm_cracha',
            'id'=>'nm_cracha',
            'value'=> set_value('nm_cracha'),
            'class'=>'obrigatorio somenteLetras'
        ));
    ?>
    </p>
    <p>
    <?php
        echo form_label('RG','nr_rg',array('class'=>'campo'));
	?>
    </p>
    <p>
    <?php
		echo form_input(array(
            'name'=>'nr_rg',
            'id'=>'nr_rg',
            'value'=> set_value('nr_rg'),
            'class'=>'obrigatorio somenteNumeros'
        ));
    ?>
    </p>
    <p>
    <?php
    echo form_label('Data de Nascimento','dt_nascimento',array('class'=>'campo'));
    ?>
    </p>
    <p>
    <?php
	echo form_input(array(
        'name'=>'dt_nascimento',
        'id'=>'dt_nascimento',
        'value'=> set_value('dt_nascimento'),
        'class'=>'short obrigatorio data'
    ));
    ?>
    </p>
    <p>
    <?php
    echo form_label('Sexo','',array('class'=>'campo'));
    ?>
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
    echo nbs(7);
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
    <?php
    echo form_label('Endereço','ds_endereco',array('class'=>'campo'));
    ?>
    </p>
    <p>
    <?php
	echo form_input(array(
        'name'=>'ds_endereco',
        'id'=>'ds_endereco',
        'value'=> set_value('ds_endereco'),
        'class'=>'obrigatorio somenteAlfanumerico'
    ));
    ?>
    </p>
    <p>
    <?php
    echo form_label('CEP','nr_cep',array('class'=>'campo'));
    ?><span class="ajuda_icone" title="Exemplo:<br/>&nbsp;60822-520 ou 60822520"></span>
    </p>
    <p>
    <?php
	echo form_input(array(
        'name'=>'nr_cep',
        'id'=>'nr_cep',
        'value'=> set_value('nr_cep'),
        'class'=>'short obrigatorio cep'
    ));
    ?>
    </p>
    <p>
    <?php
    echo form_label('Bairro','ds_bairro',array('class'=>'campo'));
    ?>
    </p>
    <p>
    <?php
	echo form_input(array(
        'name'=>'ds_bairro',
        'id'=>'ds_bairro',
        'value'=> set_value('ds_bairro'),
        'class'=>'obrigatorio somenteLetras'
    ));
    ?>
    </p>
    <p>
    <?php
    echo form_label('Cidade','id_cidade',array('class'=>'campo'));
    ?>
    </p>
    <p>
    <?php
	echo form_dropdown('id_cidade', $cidades, $this->input->post('id_cidade'), 'class="obrigatorio"');
    ?>
    </p>
    
    <hr/>
    
    <p>
    <?php
    echo form_label('O que fará no período da tarde?','',array('class'=>'campo'));
    ?>
    </p>
    <p>
    <?php
    echo form_radio(array(
        'name'=>'bl_seminario',
        'id'=>'bl_seminario_s',
        'value'=>'1',
        'checked'=> set_radio('bl_seminario', '1'),
        'class'=>'obrigatorio'
    ));
    echo form_label('Seminário','bl_seminario_s');
    ?><span class="ajuda_icone" title="Marque esta opção se você nunca fez um Seminário de Vida no Espírito Santo."></span><?php
    echo nbs(8);
    echo form_radio(array(
        'name'=>'bl_seminario',
        'id'=>'bl_seminario_a',
        'value'=>'0',
        'checked'=> set_radio('bl_seminario', '0'),
        'class'=>'obrigatorio'
    ));
    echo form_label('Aprofundamento','bl_seminario_a');
    ?><span class="ajuda_icone" title="Marque esta opção se você já participou de um Seminário de Vida no Espírito Santo e deseja fazer um dos cursos de aprofundamento."></span>
    </p>
    <p>
    <?php
    echo form_label('Alimentação?','',array('class'=>'campo'));
    ?><span class="ajuda_icone" title="Você utilizará a alimentação fornecida por nós?"></span>
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
    <p>
    <?php
    echo form_label('Utilizará o barracão?','',array('class'=>'campo'));
    ?>
    </p>
    <p>
    <?php
	echo form_radio(array(
        'name'=>'bl_barracao',
        'id'=>'bl_barracao_s',
        'value'=>'1',
        'checked'=> set_radio('bl_barracao', '1'),
        'class'=>'obrigatorio'
    ));
    echo form_label('Sim','bl_barracao_s');
    ?><span class="ajuda_icone" title="Marque esta opção se você for utilizar a barraca coletiva."></span><?php
    echo nbs(8);
    echo form_radio(array(
        'name'=>'bl_barracao',
        'id'=>'bl_barracao_n',
        'value'=>'0',
        'checked'=> set_radio('bl_barracao', '0'),
        'class'=>'obrigatorio'
    ));
    echo form_label('Não','bl_barracao_n');
    ?><span class="ajuda_icone" title="Marque esta opção se você possui e irá utilizar uma barraca particular."></span>
    </p>
    <p>
    <?php
    echo form_label('Precisará de transporte do acampamento?','',array('class'=>'campo'));
    ?>
    </p>
    <p>
    <?php
	echo form_radio(array(
        'name'=>'bl_transporte',
        'id'=>'bl_transporte_s',
        'value'=>'1',
        'checked'=> set_radio('bl_transporte', '1'),
        'class'=>'obrigatorio'
    ));
    echo form_label('Sim','bl_transporte_s');
    echo nbs(5);
    echo form_radio(array(
        'name'=>'bl_transporte',
        'id'=>'bl_transporte_n',
        'value'=>'0',
        'checked'=> set_radio('bl_transporte', '0'),
        'class'=>'obrigatorio'
    ));
    echo form_label('Não','bl_transporte_n');
    ?>
    </p>

    <hr/>

    <p>
    <?php
    echo form_label('Já fez primeira eucaristia?','',array('class'=>'campo'));
    ?>
    </p>
    <p>
    <?php
	echo form_radio(array(
        'name'=>'bl_fez_comunhao',
        'id'=>'bl_fez_comunhao_s',
        'value'=>'1',
        'checked'=> set_radio('bl_fez_comunhao', '1'),
        'class'=>'obrigatorio'
    ));
    echo form_label('Sim','bl_fez_comunhao_s');
    echo nbs(5);
    echo form_radio(array(
        'name'=>'bl_fez_comunhao',
        'id'=>'bl_fez_comunhao_n',
        'value'=>'0',
        'checked'=> set_radio('bl_fez_comunhao', '0'),
        'class'=>'obrigatorio'
    ));
    echo form_label('Não','bl_fez_comunhao_n');
    ?>
    </p>
    <p>
    <?php
    echo form_label('Deseja fazer?','',array('class'=>'campo'));
    ?>
    </p>
    <p>
    <?php
	echo form_radio(array(
        'name'=>'bl_fazer_comunhao',
        'id'=>'bl_fazer_comunhao_s',
        'value'=>'1',
        'checked'=> set_radio('bl_fazer_comunhao', '1'),
        'class'=>''
    ));
    echo form_label('Sim','bl_fazer_comunhao_s');
    echo nbs(5);
    echo form_radio(array(
        'name'=>'bl_fazer_comunhao',
        'id'=>'bl_fazer_comunhao_n',
        'value'=>'0',
        'checked'=> set_radio('bl_fazer_comunhao', '0'),
        'class'=>''
    ));
    echo form_label('Não','bl_fazer_comunhao_n');
    ?>
    </p>

    <hr/>

    <p>
    <?php
    echo form_label('Você tem alergia a remédios?','',array('class'=>'campo'));
    ?>
    </p>
    <p>
    <?php
	echo form_radio(array(
        'name'=>'bl_alergia_remedio',
        'id'=>'bl_alergia_remedio_s',
        'value'=>'1',
        'checked'=> set_radio('bl_alergia_remedio', '1'),
        'class'=>'obrigatorio'
    ));
    echo form_label('Sim','bl_alergia_remedio_s');
    echo nbs(5);
    echo form_radio(array(
        'name'=>'bl_alergia_remedio',
        'id'=>'bl_alergia_remedio_n',
        'value'=>'0',
        'checked'=> set_radio('bl_alergia_remedio', '0'),
        'class'=>'obrigatorio'
    ));
    echo form_label('Não','bl_alergia_remedio_n');
    ?>
    </p>
    <p>
    <?php
    echo form_label('Qual?','nm_alergia_remedio',array('class'=>'campo'));
    ?>
    </p>
    <p>
    <?php
	echo form_input(array(
        'name'=>'nm_alergia_remedio',
        'id'=>'nm_alergia_remedio',
        'value'=> set_value('nm_alergia_remedio'),
        'class'=>'somenteAlfanumerico'
    ));
    ?>
    </p>
    
    <hr/>

    <p>
    <?php
    echo form_label('Você tem alergia a alimentos?','',array('class'=>'campo'));
    ?>
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
    <?php
    echo form_label('Qual?','nm_alergia_alimento',array('class'=>'campo'));
    ?>
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
    echo form_label('E-mail','ds_email',array('class'=>'campo'));
    ?>
    </p>
    <p>
    <?php
	echo form_input(array(
        'name'=>'ds_email',
        'id'=>'ds_email',
        'value'=> set_value('ds_email'),
        'class'=>'obrigatorio email'
    ));
    ?>
    </p>
    <p>
    <?php
    echo form_label('Telefone','nr_telefone',array('class'=>'campo'));
    ?>
    </p>
    <p>
    <?php
	echo form_input(array(
        'name'=>'nr_telefone',
        'id'=>'nr_telefone',
        'value'=> set_value('nr_telefone'),
        'class'=>'short obrigatorio telefone'
    ));
    ?>
    </p>
    <p>
    <?php
    echo form_label('Telefone para Emergência (1)','nr_emergencia1',array('class'=>'campo'));
    ?><span class="ajuda_icone" title="Coloque aqui um número de telefone para ligarmos em caso de emergência."></span>
    </p>
    <p>
    <?php
    echo form_input(array(
        'name'=>'nr_emergencia1',
        'id'=>'nr_emergencia1',
        'value'=> set_value('nr_emergencia1'),
        'class'=>'short obrigatorio telefone'
    ));
    ?>
    </p>
    <p>
    <?php
    echo form_label('Nome do Responsável (1)','nm_emergencia1',array('class'=>'campo'));
    ?><span class="ajuda_icone" title="Coloque aqui o nome da pessoa com quem devemos falar se ligarmos para o número acima."></span>
    </p>
    <p>
    <?php
    echo form_input(array(
        'name'=>'nm_emergencia1',
        'id'=>'nm_emergencia1',
        'value'=> set_value('nm_emergencia1'),
        'class'=>'obrigatorio somenteLetras'
    ));
    ?>
    </p>
    <p>
    <?php
    echo form_label('Telefone para Emergência (2) <span style="color:#006bcc">(opcional)</span>','nr_emergencia2',array('class'=>'campo'));
    ?><span class="ajuda_icone" title="Coloque aqui outro número de telefone para ligarmos em caso de emergência."></span>
    </p>
    <p>
    <?php
    echo form_input(array(
        'name'=>'nr_emergencia2',
        'id'=>'nr_emergencia2',
        'value'=> set_value('nr_emergencia2'),
        'class'=>'short telefone'
    ));
    ?>
    </p>
    <p>
    <?php
    echo form_label('Nome do Responsável (2) <span style="color:#006bcc">(opcional)</span>','nm_emergencia2',array('class'=>'campo'));
    ?><span class="ajuda_icone" title="Coloque aqui o nome da pessoa com quem devemos falar se ligarmos para o número acima."></span>
    </p>
    <p>
    <?php
    echo form_input(array(
        'name'=>'nm_emergencia2',
        'id'=>'nm_emergencia2',
        'value'=> set_value('nm_emergencia2'),
        'class'=>'somenteLetras'
    ));
    ?>
    </p>
    
    <hr/>
    
    <p>
    <?php
    echo form_label('Envie sua foto','ds_foto',array('class'=>'campo'));
    ?><span class="ajuda_icone" title="O tamanho máximo aceito para a foto é 2MB.<br/>Formatos aceitos: bmp|jpg|png|gif"></span>
    </p>
    <p>
    <?php
    echo form_upload(array(
        'name'=>'ds_foto',
        'value'=> set_value('ds_foto'),
        'class'=>'obrigatorio',
        'size'=>50
    ));
    ?></p>
	<?php
		/*<div class="info" style="margin-top:2em;"><p>Antes de concluir sua inscrição diga-nos <strong>como ficou sabendo do Acamp's</strong>?</p>
	foreach ($divulgacao as $meio) {
			echo '<p>';
			echo form_radio(array(
				'name'    => 'meio',
				'id'      => 'meio_'.$meio['id_meio'],
				'value'   => $meio['id_meio'],
				'checked' => set_radio('meio', $meio['id_meio']),
			));
			echo form_label($meio['nm_meio'],'meio_'.$meio['id_meio']);
			echo '</p>';
		}
	</div>*/
	?>
    <p class="center"><?php echo form_submit('confirmar','Confirmar'); ?></p>
    <?php echo form_close();?>
</div>
<script>

    $(function(){
        
        // Alterando obrigatoriedade dos campos de alergia
        $('#bl_alergia_remedio_s').click(function(){
            $('#nm_alergia_remedio').attr('disabled',false).addClass('obrigatorio').change();
        });
        $('#bl_alergia_remedio_n').click(function(){
            $('#nm_alergia_remedio').attr('disabled',true).removeClass('obrigatorio').removeData('obrigatorio').change();
        });
        $('#bl_alergia_alimento_s').click(function(){
            $('#nm_alergia_alimento').attr('disabled',false).addClass('obrigatorio').change();
        });
        $('#bl_alergia_alimento_n').click(function(){
            $('#nm_alergia_alimento').attr('disabled',true).removeClass('obrigatorio').removeData('obrigatorio').change();
        });
        // Alterando obrigatoriedade do campo 1ª Eucaristia
        $('#bl_fez_comunhao_n').click(function(){
            $('[name=bl_fazer_comunhao]').attr('disabled',false).addClass('obrigatorio').change();
        });
        $('#bl_fez_comunhao_s').click(function(){
            $('[name=bl_fazer_comunhao]').attr('disabled',true).removeClass('obrigatorio').removeData('obrigatorio').change();
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