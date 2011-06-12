<div id="detalhes" class="wrap">
<div id="cabecalho" class='clearfix'>
    
    <?php if(empty($pessoa['ds_foto'])): ?>
        <a href="#" id="adicionar-foto"><img id="foto" src="<?php echo assets_url('image').'sem_foto.png' ?>" alt="foto" title="Clique para enviar uma foto" /></a>
    <?php else: ?>
        <a href="#" id="adicionar-foto"><img id="foto" src="<?php echo $pessoa['ds_foto'] ?>" alt="foto" title="Clique para substituir a foto" /></a>
    <?php endif ?>
    
    <h2><?php echo $pessoa['id_pessoa']; ?> - <?php echo $pessoa['nm_pessoa']; ?></h2>
    <p>Tipo de inscrição: <?php switch($pessoa['cd_tipo']){
        case 'p':
            echo 'Participante';
            break;
        case 's':
            echo 'Serviço';
            break;
        case 'v':
            echo 'Comunidade de Vida';
            break;
    }
    ?></p>
    <p>Situação: <?php echo $pessoa['ds_status']; ?></p>
	
	<div class="comandos">
		<?php
			if($pessoa['cd_tipo'] != 'p'){ // Botão Liberação/Cancelar Liberação
			
				if($pessoa['id_status'] == '2'){ // Aguardando liberação
					if($this->session->userdata('permissao') & LIBERACAO){
						echo anchor('admin/liberar/'.$pessoa['id_pessoa'], 'Liberar', 'class="liberacao confirmacao"');
					}else{
						echo '<span class="liberacao" title="Você não tem permissão para liberar inscritos no serviço.">Liberar</span>';
					}
				}elseif($pessoa['id_status'] == '1'){ // Liberado, aguardando pagamento
					if($this->session->userdata('permissao') & LIBERACAO){
						echo anchor('admin/reverter/'.$pessoa['id_pessoa'], 'Cancelar Liberação', 'class="liberacao confirmacao"');
					}else{
						echo '<span class="liberacao" title="Você não tem permissão para reverter uma liberação.">Cancelar Liberação</span>';
					}
				}else{ // Concluído
					echo '<span class="liberacao" title="A inscrição foi paga. Não é possível reverter a liberação.">Cancelar Liberação</span>';
				}
			}
			if($pessoa['cd_tipo'] != 'v'){ // Botão Pagamento/Estornar Pagamento
			
				if($pessoa['id_status'] == '1'){ // Aguardando Pagamento
					if($this->session->userdata('permissao') & PAGAMENTO){
						echo anchor('admin/pagar/'.$pessoa['id_pessoa'], 'Realizar Pagamento', 'class="pagamento"');
					}else{
						echo '<span class="pagamento" title="Você não tem permissão para realizar pagamentos">Realizar Pagamento</span>';
					}
				}elseif($pessoa['id_status'] == '2'){ // Aguardando liberação
					echo '<span class="pagamento" title="A inscrição ainda não foi liberada.">Realizar Pagamento</span>';
				}else{ // Concluído
					if($this->session->userdata('permissao') & PAGAMENTO){
						echo anchor('admin/reverter/'.$pessoa['id_pessoa'], 'Estornar Pagamento', 'class="pagamento confirmacao"');
					}else{
						echo '<span class="pagamento" title="Você não tem permissão para estornar pagamentos.">Estornar Pagamento</span>';
					}
				}
			}
		?><?php
		if($pessoa['cd_tipo'] != 'v'): // Se não for da Comunidade de Vida
			?><a class="boleto" target="_blank" href="<?php echo site_url('/inscricao/boleto/').'/'.md5($pessoa['id_pessoa'].$pessoa['ds_email']) ?>">Imprimir Boleto</a><?php
		endif;
			echo anchor('admin/excluir/'.$pessoa['id_pessoa'], 'Excluir Inscrição', 'class="excluir confirmacao"');
		?>
    </div>
</div>

<div id="foto-upload">
    <h2>Enviar Foto</h2>
    <?php echo form_open_multipart('admin/corrigir/'.$pessoa['id_pessoa']) ?>
        <p class="center"><?php
        echo form_upload(array(
            'name'=>'ds_foto',
            'size'=>50
        ));
        ?></p><br/>
        <p class="center"><?php echo form_submit('adicionar_foto','Confirmar'); ?></p>
    <?php echo form_close()?>
</div>

<div id="dados">
    <h2>Detalhes da Incrição</h2>
    <?php echo form_open('admin/corrigir/'.$pessoa['id_pessoa']) ?>
    <?php if($this->session->userdata('permissao') & CORRECAO): // Verificando permissão ?>
        <input type="button" id="ativar-correcao" name="ativar_correcao" value="Ativar correção" />
        <input type="submit" id="corrigir" name="corrigir" value="Salvar Alterações" disabled='disabled' />
        <input type="reset" id="reset" name="reset" value="Reset" class="right" disabled='disabled' />
    <?php endif ?>
    
    <br/><br/>
    <table align="center" width="100%">
        <tr>
            <th scope="col" width="200">Nome completo</th>
            <td><?php echo form_input(array(
                'name'=>'nm_pessoa',
                'id'=>'nm_pessoa',
                'value'=>$pessoa['nm_pessoa'],
                'disabled'=>true
            )) ?></td>
        </tr>
        <tr>
            <th scope="col">Nome no crachá</th>
            <td><?php
                echo form_input(array(
                    'name'=>'nm_cracha',
                    'id'=>'nm_cracha',
                    'value'=> $pessoa['nm_cracha'],
                    'disabled'=>true
                ))
            ?></td>
        </tr>
<!----------------------------------------------------------------------------->
        <?php if($pessoa['cd_tipo'] != 'p'): // Se não for Participante ?>
            <tr>
                <th scope="col">Serviço</th>
                <td><?php
                    $servicos = $this->servico->listar();
                    echo form_dropdown('id_servico', $servicos, $pessoa['id_servico'], 'disabled="disabled"');
                ?></td>
            </tr>
        <?php endif ?>
<!----------------------------------------------------------------------------->
        <?php if($pessoa['cd_tipo'] == 'v'): // Se for da Comunidade de Vida ?>
            <tr>
                <th scope="col">Setor</th>
                <td><?php
                    $setores = $this->setor->listar();
                    echo form_dropdown('id_setor', $setores, $pessoa['id_setor'], 'disabled="disabled"');
                ?></td>
            </tr>
        <?php endif ?>
<!----------------------------------------------------------------------------->
        <?php if($pessoa['cd_tipo'] == 'p'): // Se for Participante ?>
            <tr>
                <th scope="col">Família</th>
                <td><?php
                    $familias = $this->familia->listar();
                    echo form_dropdown('id_familia', $familias, $pessoa['id_familia'], 'disabled="disabled"');
                ?></td>
            </tr>
        <?php endif ?>
<!----------------------------------------------------------------------------->
        <tr>
            <th scope="col">Data de Nascimento</th>
            <td><?php
                echo form_input(array(
                    'name'=>'dt_nascimento',
                    'id'=>'dt_nascimento',
                    'value'=> $pessoa['dt_nascimento'],
                    'disabled'=>true
                ))
            ?></td>
        </tr>
        <tr>
            <th scope="col">Sexo</th>
            <td><?php
                echo form_radio(array(
                    'name'=>'ds_sexo',
                    'id'=>'ds_sexo_h',
                    'value'=>'h',
                    'checked'=> $pessoa['ds_sexo']=='h',
                    'disabled'=>true
                ));
                echo form_label('Homem','ds_sexo_h');
                echo nbs(5);
                echo form_radio(array(
                    'name'=>'ds_sexo',
                    'id'=>'ds_sexo_m',
                    'value'=>'m',
                    'checked'=> $pessoa['ds_sexo']=='m',
                    'disabled'=>true
                ));
                echo form_label('Mulher','ds_sexo_m');
            ?></td>
        </tr>
<!----------------------------------------------------------------------------->
        <?php if ($pessoa['cd_tipo'] != 'v'): ?>
            <tr>
                <th scope="col">RG</th>
                <td><?php
                    echo form_input(array(
                        'name'=>'nr_rg',
                        'id'=>'nr_rg',
                        'value'=> $pessoa['nr_rg'],
                        'disabled'=>true
                    ))
                ?></td>
            </tr>
            <tr>
                <th scope="col">Telefone</th>
                <td><?php
                    echo form_input(array(
                        'name'=>'nr_telefone',
                        'id'=>'nr_telefone',
                        'value'=> $pessoa['nr_telefone'],
                        'disabled'=>true
                    ))
                ?></td>
            </tr>
            <tr>
                <th scope="col">E-mail</th>
                <td><?php
                    echo form_input(array(
                        'name'=>'ds_email',
                        'id'=>'ds_email',
                        'value'=> $pessoa['ds_email'],
                        'disabled'=>true
                    ))
                ?></td>
            </tr>
            <tr>
                <th scope="col">Endereço</th>
                <td><?php
                    echo form_input(array(
                        'name'=>'ds_endereco',
                        'id'=>'ds_endereco',
                        'value'=> $pessoa['ds_endereco'],
                        'disabled'=>true
                    ))
                ?></td>
            </tr>
            <tr>
                <th scope="col">CEP</th>
                <td><?php
                    echo form_input(array(
                        'name'=>'nr_cep',
                        'id'=>'nr_cep',
                        'value'=> $pessoa['nr_cep'],
                        'disabled'=>true
                    ))
                ?></td>
            </tr>
            <tr>
                <th scope="col">Bairro</th>
                <td><?php
                    echo form_input(array(
                        'name'=>'ds_bairro',
                        'id'=>'ds_bairro',
                        'value'=> $pessoa['ds_bairro'],
                        'disabled'=>true
                    ))
                ?></td>
            </tr>
            <tr>
                <th scope="col">Cidade</th>
                <td><?php
                    $cidades = $this->cidade->listar();
                    echo form_dropdown('id_cidade', $cidades, $pessoa['id_cidade'], 'disabled="disabled"');
                ?></td>
            </tr>
        <?php endif ?>
<!----------------------------------------------------------------------------->
        <?php if($pessoa['cd_tipo'] == 'p'): // Se for Participante ?>
            <tr>
                <th scope="col">Período da tarde</th>
                <td><?php
                    echo form_radio(array(
                        'name'=>'bl_seminario',
                        'id'=>'bl_seminario_s',
                        'value'=>'1',
                        'checked'=> $pessoa['bl_seminario'],
                        'disabled'=>true
                    ));
                    echo form_label('Seminário','bl_seminario_s');
                    echo nbs(5);
                    echo form_radio(array(
                        'name'=>'bl_seminario',
                        'id'=>'bl_seminario_a',
                        'value'=>'0',
                        'checked'=> !$pessoa['bl_seminario'],
                        'disabled'=>true
                    ));
                    echo form_label('Aprofundamento','bl_seminario_a')
                ?></td>
            </tr>
        <?php endif ?>
		<tr>
            <th scope="col">Alimentação</th>
            <td><?php
                echo form_radio(array(
                    'name'=>'bl_alimentacao',
                    'id'=>'bl_alimentacao_s',
                    'value'=>'1',
                    'checked'=> $pessoa['bl_alimentacao'],
                    'disabled'=>true
                ));
                echo form_label('Sim','bl_alimentacao_s');
                echo nbs(5);
                echo form_radio(array(
                    'name'=>'bl_alimentacao',
                    'id'=>'bl_alimentacao_n',
                    'value'=>'0',
                    'checked'=> !$pessoa['bl_alimentacao'],
                    'disabled'=>true
                ));
                echo form_label('Não','bl_alimentacao_n')
            ?></td>
        </tr>
<!----------------------------------------------------------------------------->
        <?php if ($pessoa['cd_tipo'] != 'v'): ?>
            <tr>
                <th>Barracão</th>
                <td><?php
                    echo form_radio(array(
                        'name'=>'bl_barracao',
                        'id'=>'bl_barracao_s',
                        'value'=>'1',
                        'checked'=> $pessoa['bl_barracao'],
                        'disabled'=>true
                    ));
                    echo form_label('Sim','bl_barracao_s');
                    echo nbs(5);
                    echo form_radio(array(
                        'name'=>'bl_barracao',
                        'id'=>'bl_barracao_n',
                        'value'=>'0',
                        'checked'=> !$pessoa['bl_barracao'],
                        'disabled'=>true
                    ));
                    echo form_label('Não','bl_barracao_n')
                ?></td>
            </tr>
			<tr>
				<th scope="col">Transporte</th>
				<td><?php
					echo form_radio(array(
						'name'=>'bl_transporte',
						'id'=>'bl_transporte_s',
						'value'=>'1',
						'checked'=> $pessoa['bl_transporte'],
						'disabled'=>true
					));
					echo form_label('Sim','bl_transporte_s');
					echo nbs(5);
					echo form_radio(array(
						'name'=>'bl_transporte',
						'id'=>'bl_transporte_n',
						'value'=>'0',
						'checked'=> !$pessoa['bl_transporte'],
						'disabled'=>true
					));
					echo form_label('Não','bl_transporte_n')
				?></td>
			</tr>
        <?php endif ?>
<!----------------------------------------------------------------------------->
        <?php if($pessoa['cd_tipo'] == 'p'): // Se for Participante ?>
            <tr>
                <th scope="col">Já fez 1ª comunhão</th>
                <td><?php
                    echo form_radio(array(
                        'name'=>'bl_fez_comunhao',
                        'id'=>'bl_fez_comunhao_s',
                        'value'=>'1',
                        'checked'=> $pessoa['bl_fez_comunhao'],
                        'disabled'=>true
                    ));
                    echo form_label('Sim','bl_fez_comunhao_s');
                    echo nbs(5);
                    echo form_radio(array(
                        'name'=>'bl_fez_comunhao',
                        'id'=>'bl_fez_comunhao_n',
                        'value'=>'0',
                        'checked'=> !$pessoa['bl_fez_comunhao'],
                        'disabled'=>true
                    ));
                    echo form_label('Não','bl_fez_comunhao_n')
                ?></td>
            </tr>
        <?php endif ?>
<!----------------------------------------------------------------------------->
        <?php if($pessoa['cd_tipo'] == 'p'): // Se for Participante ?>
            <tr>
                <th scope="col">Fará 1ª comunhão</th>
                <td><?php
                    echo form_radio(array(
                        'name'=>'bl_fazer_comunhao',
                        'id'=>'bl_fazer_comunhao_s',
                        'value'=>'1',
                        'checked'=> $pessoa['bl_fazer_comunhao'],
                        'disabled'=>true
                    ));
                    echo form_label('Sim','bl_fazer_comunhao_s');
                    echo nbs(5);
                    echo form_radio(array(
                        'name'=>'bl_fazer_comunhao',
                        'id'=>'bl_fazer_comunhao_n',
                        'value'=>'0',
                        'checked'=> !$pessoa['bl_fazer_comunhao'],
                        'disabled'=>true
                    ));
                    echo form_label('Não','bl_fazer_comunhao_n')
                ?></td>
            </tr>
        <?php endif ?>
<!----------------------------------------------------------------------------->
        <tr>
            <th scope="col">Alergia a alimentos</th>
            <td><?php
                echo form_radio(array(
                    'name'=>'bl_alergia_alimento',
                    'id'=>'bl_alergia_alimento_s',
                    'value'=>'1',
                    'checked'=> $pessoa['bl_alergia_alimento'],
                    'disabled'=>true
                ));
                echo form_label('Sim','bl_alergia_alimento_s');
                echo nbs(5);
                echo form_radio(array(
                    'name'=>'bl_alergia_alimento',
                    'id'=>'bl_alergia_alimento_n',
                    'value'=>'0',
                    'checked'=> !$pessoa['bl_alergia_alimento'],
                    'disabled'=>true
                ));
                echo form_label('Não','bl_alergia_alimento_n')
            ?></td>
        </tr>
        <tr>
            <th scope="col">Qual alimento</th>
            <td><?php
                    echo form_input(array(
                        'name'=>'nm_alergia_alimento',
                        'id'=>'nm_alergia_alimento',
                        'value'=> $pessoa['nm_alergia_alimento'],
                        'disabled'=>true
                    ))
                ?></td>
        </tr>
<!----------------------------------------------------------------------------->
        <?php if ($pessoa['cd_tipo'] != 'v'): ?>
            <tr>
                <th scope="col">Alergia a remédios</th>
                <td><?php
                    echo form_radio(array(
                        'name'=>'bl_alergia_remedio',
                        'id'=>'bl_alergia_remedio_s',
                        'value'=>'1',
                        'checked'=> $pessoa['bl_alergia_remedio'],
                        'disabled'=>true
                    ));
                    echo form_label('Sim','bl_alergia_remedio_s');
                    echo nbs(5);
                    echo form_radio(array(
                        'name'=>'bl_alergia_remedio',
                        'id'=>'bl_alergia_remedio_n',
                        'value'=>'0',
                        'checked'=> !$pessoa['bl_alergia_remedio'],
                        'disabled'=>true
                    ));
                    echo form_label('Não','bl_alergia_remedio_n')
                ?></td>
            </tr>
            <tr>
                <th scope="col">Qual remédio</th>
                <td><?php
                    echo form_input(array(
                        'name'=>'nm_alergia_remedio',
                        'id'=>'nm_alergia_remedio',
                        'value'=> $pessoa['nm_alergia_remedio'],
                        'disabled'=>true
                    ))
                ?></td>
            </tr>
            <tr>
                <th scope="col">Número de emergência 1</th>
                <td><?php
                    echo form_input(array(
                        'name'=>'nr_emergencia1',
                        'id'=>'nr_emergencia1',
                        'value'=> $pessoa['nr_emergencia1'],
                        'disabled'=>true
                    ))
                ?></td>
            </tr>
            <tr>
                <th scope="col">Nome do contato 1</th>
                <td><?php
                    echo form_input(array(
                        'name'=>'nm_emergencia1',
                        'id'=>'nm_emergencia1',
                        'value'=> $pessoa['nm_emergencia1'],
                        'disabled'=>true
                    ))
                ?></td>
            </tr>
            <tr>
                <th scope="col">Número de emergência 2</th>
                <td><?php
                    echo form_input(array(
                        'name'=>'nr_emergencia2',
                        'id'=>'nr_emergencia2',
                        'value'=> $pessoa['nr_emergencia2'],
                        'disabled'=>true
                    ))
                ?></td>
            </tr>
            <tr>
                <th scope="col">Nome do contato 2</th>
                <td><?php
                    echo form_input(array(
                        'name'=>'nm_emergencia2',
                        'id'=>'nm_emergencia2',
                        'value'=> $pessoa['nm_emergencia2'],
                        'disabled'=>true
                    ))
                ?></td>
            </tr>
        <?php endif ?>
    </table>
    <?php echo form_close() ?>
</div> 
</div>
<script>
$(function(){
    
    mask = $("<div />",{
        id:'mask',
        css:{
        	'background-color':'#000000',
            'height': $(document).height(),
            'position': 'absolute',
            'top': 0,
            'left': 0,
            'right': 0,
            'z-index': 998,
            'opacity': .5
        }
    });
    $('#mask').live('click',function(){
    	mask.remove();
    	foto.remove();
        $(".popup").remove();
        return false;
    });
    
    // Adicionar Foto
    foto = $("#foto-upload").remove().addClass('popup');
    $("#adicionar-foto").click(function(event){
        event.preventDefault();
        $("body").append(mask).append(foto);
        foto.css('top', $(window).height()/2 - foto.height())
        .css('left', $(window).width()/2 - foto.width()/2);
    });
    
    // Botão que ativa edição dos dados de inscrição
    $("#ativar-correcao").click(function(event){
        if($(this).hasClass('ativo')){
            $(this).removeClass('ativo').val('Ativar correção');
            $("input:not(#ativar-correcao), select", '#dados').attr('disabled', true);
        }else{
            $(this).addClass('ativo').val('Cancelar correção');
            $("input:not(#ativar-correcao), select", '#dados').attr('disabled', false);
        }
    });
    
    // Criando pop-up de confirmação
    $('.confirmacao').click(function(event){
        
        event.preventDefault();
        
        mask.appendTo("body");
        
        var msg = '';
        if(/.+liberar.+/.test($(this).attr('href'))){
            msg = 'Tem certeza que deseja liberar este inscrito?';
        }else if(/.+excluir.+/.test($(this).attr('href'))){
            msg = 'Tem certeza que deseja excluir esta inscrição?';
        }else if(/.+reverter.+/.test($(this).attr('href'))){
            msg = 'Tem certeza que reverter esta ação?';
        }else{
            msg = 'Tem certeza?';
        }
        
        
        popup = $("<div />",{
            class:'popup',
            html: msg+'<br/><br/>'
        }).appendTo("body")
        .append(
            $('<a></a>',{
                href: $(this).attr('href'),
                class: 'left',
                css:{
	            	'margin-left': '80px'
	            },
                text: 'Sim'
            })
        ).append(
            $('<a></a>',{
                href: "#",
                class: 'right',
                css:{
	            	'margin-right': '80px'
	            },
                text: 'Não',
                click: function(){
                    mask.remove();
                    $(".popup").remove();
                    return false;
                }
            })
        );
        popup.css('top', $(window).height()/2 - popup.height())
        .css('left', $(window).width()/2 - popup.width()/2);
    });
});
</script>
