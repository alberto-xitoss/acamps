<div id="detalhes" class="wrap">
<div id="cabecalho" class="id-<?php echo $pessoa['cd_tipo'] ?> status-<?php echo $pessoa['id_status'] ?>">
    
	<a href="#" id="foto" >
    <?php if(empty($pessoa['ds_foto'])): ?>
		<img id="foto" src="<?php echo $this->config->item('img_url') ?>sem_foto.png" alt="foto" title="Clique para enviar uma foto" />
    <?php else: ?>
		<img id="foto" src="<?php echo $pessoa['ds_foto'] ?>" alt="foto" title="Clique para substituir a foto" />
    <?php endif ?>
    </a>
	
    <h1><?php echo $pessoa['id_pessoa']; ?> - <?php echo $pessoa['nm_pessoa']; ?></h1>
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
    <p>Situação: <span><?php echo $pessoa['ds_status']; ?></span></p>
	
	<div class="comandos">
		<?php
			if($pessoa['cd_tipo'] != 'p'){ // Botão Liberação/Cancelar Liberação
			
				if($pessoa['id_status'] == '2'){ // Aguardando liberação
					if($this->session->userdata('permissao') & LIBERACAO){
						echo anchor('admin/liberar/'.$pessoa['id_pessoa'], 'Liberar', 'class="btn liberacao confirmacao"');
					}else{
						echo '<span class="btn disabled liberacao" title="Você não tem permissão para liberar inscritos no serviço.">Liberar</span>';
					}
				}elseif($pessoa['id_status'] == '1'){ // Liberado, aguardando pagamento
					if($this->session->userdata('permissao') & LIBERACAO){
						echo anchor('admin/reverter/'.$pessoa['id_pessoa'], 'Cancelar Liberação', 'class="btn liberacao neg confirmacao"');
					}else{
						echo '<span class="btn disabled liberacao" title="Você não tem permissão para reverter uma liberação.">Cancelar Liberação</span>';
					}
				}else{ // Concluído
					if($pessoa['cd_tipo'] == 'v' && $this->session->userdata('permissao') & LIBERACAO){
						echo anchor('admin/reverter/'.$pessoa['id_pessoa'], 'Cancelar Liberação', 'class="btn neg liberacao confirmacao"');
					}else{
						echo '<span class="btn disabled neg liberacao" title="A inscrição foi paga. Não é possível reverter a liberação.">Cancelar Liberação</span>';
					}
				}
			}
			
			if($pessoa['cd_tipo'] != 'v'){ // Botão Pagamento/Estornar Pagamento
			
				if($pessoa['id_status'] == '1'){ // Aguardando Pagamento
					if($this->session->userdata('permissao') & PAGAMENTO){
						echo anchor('admin/pagar/'.$pessoa['id_pessoa'], 'Realizar Pagamento', 'id="pagar" class="btn pagamento"');
					}else{
						echo '<span class="btn disabled pagamento" title="Você não tem permissão para realizar pagamentos">Realizar Pagamento</span>';
					}
				}elseif($pessoa['id_status'] == '2'){ // Aguardando liberação
					echo '<span class="btn disabled pagamento" title="A inscrição ainda não foi liberada.">Realizar Pagamento</span>';
				}else{ // Concluído
					if($this->session->userdata('permissao') & PAGAMENTO){
						echo anchor('admin/reverter/'.$pessoa['id_pessoa'], 'Estornar Pagamento', 'class="btn neg pagamento confirmacao"');
					}else{
						echo '<span class="btn disabled neg pagamento" title="Você não tem permissão para estornar pagamentos.">Estornar Pagamento</span>';
					}
				}
			}
			
		?><?php
		if($pessoa['cd_tipo'] != 'v'): // Se não for da Comunidade de Vida
			?><a class="btn boleto" target="_blank" href="<?php echo site_url('/inscricao/boleto/').'/'.md5($pessoa['id_pessoa'].$pessoa['ds_email']) ?>">Imprimir Boleto</a><?php
		endif;
			echo anchor('admin/excluir/'.$pessoa['id_pessoa'], 'Excluir Inscrição', 'class="btn btn-danger excluir confirmacao"');
		?>
    </div>
</div>

<div id="foto-upload" class="modal fade">
	<?php echo form_open_multipart('admin/corrigir/'.$pessoa['id_pessoa']) ?>
	<div class="modal-header"><a class="close" href="#" data-dismiss="modal">×</a><h3>Enviar Foto</h3></div>
	<div class="modal-body"><?php
        echo form_upload(array(
            'name'=>'ds_foto',
            'size'=>50
        ));
	?></div>
	<div class="modal-footer"><?php echo form_submit('adicionar_foto','Confirmar', 'class="btn btn-primary"'); ?></div>
    <?php echo form_close()?>
</div>

<div id="dados">
    <h2>Dados do Inscrito</h2>
    <?php echo form_open('admin/corrigir/'.$pessoa['id_pessoa']) ?>
    <?php if($this->session->userdata('permissao') & CORRECAO): // Verificando permissão ?>
        <input type="button" id="ativar-correcao" name="ativar_correcao" value="Ativar correção" class="btn" />
		<input type="submit" id="corrigir" name="corrigir" value="Salvar Alterações" class="btn btn-primary" disabled='disabled' />
		<input type="reset" id="reset" name="reset" value="Reset" class="btn" disabled='disabled' />
    <?php endif ?>
    
    <br/><br/>
    <table class="table table-striped form-inline">
        <tr>
            <th scope="col" width="210">Nome Completo</th>
            <td><input type="text" class="span5" id="nm_pessoa" value="<?php echo $pessoa['nm_pessoa'] ?>" name="nm_pessoa" /></td>
        </tr>
        <tr>
            <th scope="col">Nome no crachá</th>
            <td><input type="text" class="span5" id="nm_cracha" value="<?php echo $pessoa['nm_cracha'] ?>" name="nm_cracha"></td>
        </tr>
<!----------------------------------------------------------------------------->
        <?php if($pessoa['cd_tipo'] != 'p'): // Se não for Participante ?>
            <tr>
                <th scope="col">Serviço</th>
                <td><?php
                    $servicos = $this->servico->listar();
                    echo form_dropdown('id_servico', $servicos, $pessoa['id_servico']);
                ?></td>
            </tr>
        <?php endif ?>
<!----------------------------------------------------------------------------->
        <?php if($pessoa['cd_tipo'] == 'v'): // Se for da Comunidade de Vida ?>
            <tr>
                <th scope="col">Setor</th>
                <td><?php
                    $setores = $this->setor->listar();
                    echo form_dropdown('id_setor', $setores, $pessoa['id_setor']);
                ?></td>
            </tr>
        <?php endif ?>
<!----------------------------------------------------------------------------->
        <?php if($pessoa['cd_tipo'] == 'p'): // Se for Participante ?>
            <tr>
                <th scope="col">Família</th>
                <td><?php
                    $familias = $this->familia->listar();
					$familias = array_reverse($familias, true);
					$familias[0] = 'Sem família';
					$familias = array_reverse($familias, true);
					if(empty($pessoa['id_familia'])){$pessoa['id_familia'] = 0;}
                    echo form_dropdown('id_familia', $familias, $pessoa['id_familia']);
                ?></td>
            </tr>
        <?php endif ?>
<!----------------------------------------------------------------------------->
        <tr>
            <th scope="col">Data de Nascimento</th>
            <td><input type="text" class="data span2" id="dt_nascimento" value="<?php echo $pessoa['dt_nascimento'] ?>" name="dt_nascimento"></td>
        </tr>
        <tr>
            <th scope="col">Sexo</th>
            <td>
				<label for="ds_sexo_h" class="radio"><input type="radio" id="ds_sexo_h" value="h" name="ds_sexo" <?php if($pessoa['ds_sexo']=='h') echo 'checked' ?>>Homem</label>
				<br/><label for="ds_sexo_m" class="radio"><input type="radio" id="ds_sexo_m" value="m" name="ds_sexo" <?php if($pessoa['ds_sexo']=='m') echo 'checked' ?>>Mulher</label>
			</td>
        </tr>
<!----------------------------------------------------------------------------->
        <?php if ($pessoa['cd_tipo'] != 'v'): ?>
            <tr>
                <th scope="col">RG</th>
                <td><input type="text" class="span2" id="nr_rg" value="<?php echo $pessoa['nr_rg'] ?>" name="nr_rg"></td>
            </tr>
            <tr>
                <th scope="col">Telefone</th>
                <td><input type="text" class="span2" id="nr_telefone" value="<?php echo $pessoa['nr_telefone'] ?>" name="nr_telefone"></td>
            </tr>
            <tr>
                <th scope="col">E-mail</th>
                <td><input type="text" id="ds_email" value="<?php echo $pessoa['ds_email'] ?>" name="ds_email"></td>
            </tr>
            <tr>
                <th scope="col">Endereço</th>
                <td><input type="text" class="span5" id="ds_endereco" value="<?php echo $pessoa['ds_endereco'] ?>" name="ds_endereco"></td>
            </tr>
            <tr>
                <th scope="col">CEP</th>
                <td><input type="text" class="span2" id="nr_cep" value="<?php echo $pessoa['nr_cep'] ?>" name="nr_cep" ></td>
            </tr>
            <tr>
                <th scope="col">Bairro</th>
                <td><input type="text" id="ds_bairro" value="<?php echo $pessoa['ds_bairro'] ?>" name="ds_bairro"></td>
            </tr>
            <tr>
                <th scope="col">Cidade</th>
                <td><?php
                    $cidades = $this->cidade->listar();
                    echo form_dropdown('id_cidade', $cidades, $pessoa['id_cidade']);
                ?></td>
            </tr>
        <?php endif ?>
<!----------------------------------------------------------------------------->
        <?php if($pessoa['cd_tipo'] == 'p'): // Se for Participante ?>
            <tr>
                <th scope="col">Período da tarde</th>
                <td>
					<label for="bl_seminario_s" class="radio"><input type="radio" id="bl_seminario_s" value="1" name="bl_seminario" <?php if($pessoa['bl_seminario']) echo 'checked' ?>>Seminário de Vida no Espírito Santo</label>
					<br/><label for="bl_seminario_a" class="radio"><input type="radio" class="obrigatorio" id="bl_seminario_a" value="0" name="bl_seminario" <?php if(!$pessoa['bl_seminario']) echo 'checked' ?>>Aprofundamento</label>
				</td>
            </tr>
        <?php endif ?>
		<tr>
            <th scope="col">Alimentação</th>
            <td>
				<label for="bl_alimentacao_s" class="radio"><input type="radio" class="obrigatorio" id="bl_alimentacao_s" value="1" name="bl_alimentacao" <?php if($pessoa['bl_alimentacao']) echo 'checked' ?>>Sim</label>
				<br/><label for="bl_alimentacao_n" class="radio"><input type="radio" class="obrigatorio" id="bl_alimentacao_n" value="0" name="bl_alimentacao" <?php if(!$pessoa['bl_alimentacao']) echo 'checked' ?>>Não</label>
			</td>
        </tr>
<!----------------------------------------------------------------------------->
        <?php if ($pessoa['cd_tipo'] != 'v'): ?>
            <tr>
                <th>Barracão</th>
                <td>
					<label for="bl_barracao_s" class="radio"><input type="radio" class="obrigatorio" id="bl_barracao_s" value="1" name="bl_barracao" <?php if($pessoa['bl_barracao']) echo 'checked' ?>>Barraca Coletiva</label>
					<br/><label for="bl_barracao_n" class="radio"><input type="radio" class="obrigatorio" id="bl_barracao_n" value="0" name="bl_barracao" <?php if(!$pessoa['bl_barracao']) echo 'checked' ?>>Barraca Particular</label>
				</td>
            </tr>
        <?php endif ?>
<!----------------------------------------------------------------------------->
		<tr>
			<th scope="col">Transporte</th>
			<td>
				<label for="bl_transporte_s" class="radio"><input type="radio" class="obrigatorio" id="bl_transporte_s" value="1" name="bl_transporte" <?php if($pessoa['bl_transporte']) echo 'checked' ?>>Sim</label>
				<br/><label for="bl_transporte_n" class="radio"><input type="radio" class="obrigatorio" id="bl_transporte_n" value="0" name="bl_transporte" <?php if(!$pessoa['bl_transporte']) echo 'checked' ?>>Não</label>
			</td>
		</tr>
<!----------------------------------------------------------------------------->
        <?php if($pessoa['cd_tipo'] == 'p'): // Se for Participante ?>
            <tr>
                <th scope="col">Já fez 1ª comunhão</th>
                <td>
					<label for="bl_fez_comunhao_s" class="radio"><input type="radio" class="obrigatorio" id="bl_fez_comunhao_s" value="1" name="bl_fez_comunhao" <?php if($pessoa['bl_fez_comunhao']) echo 'checked' ?>>Sim</label>
					<br/><label for="bl_fez_comunhao_n" class="radio"><input type="radio" class="obrigatorio" id="bl_fez_comunhao_n" value="0" name="bl_fez_comunhao" <?php if(!$pessoa['bl_fez_comunhao']) echo 'checked' ?>>Não</label>
				</td>
            </tr>
        <?php endif ?>
<!----------------------------------------------------------------------------->
        <?php if($pessoa['cd_tipo'] == 'p'): // Se for Participante ?>
            <tr>
                <th scope="col">Fará 1ª comunhão</th>
                <td>
					<label for="bl_fazer_comunhao_s" class="radio"><input type="radio" class="" id="bl_fazer_comunhao_s" value="1" name="bl_fazer_comunhao" <?php if($pessoa['bl_fazer_comunhao']) echo 'checked' ?>>Sim</label>
					<br/><label for="bl_fazer_comunhao_n" class="radio"><input type="radio" class="" id="bl_fazer_comunhao_n" value="0" name="bl_fazer_comunhao" <?php if(!$pessoa['bl_fazer_comunhao']) echo 'checked' ?>>Não</label>
				</td>
            </tr>
        <?php endif ?>
<!----------------------------------------------------------------------------->
        <tr>
            <th scope="col">Alergia a alimentos</th>
            <td><input type="text" class="span5" id="nm_alergia_alimento" value="<?php echo $pessoa['nm_alergia_alimento'] ?>" name="nm_alergia_alimento"></td>
        </tr>
<!----------------------------------------------------------------------------->
        <?php if ($pessoa['cd_tipo'] != 'v'): ?>
            <tr>
                <th scope="col">Alergia a remédios</th>
                <td><input type="text" class="span5" id="nm_alergia_remedio" value="<?php echo $pessoa['nm_alergia_remedio'] ?>" name="nm_alergia_remedio"></td>
            </tr>
            <tr>
                <th scope="col">Número de emergência 1</th>
                <td><input type="text" class="span2" id="nr_emergencia1" value="<?php echo $pessoa['nr_emergencia1'] ?>" name="nr_emergencia1"></td>
            </tr>
            <tr>
                <th scope="col">Nome do contato 1</th>
                <td><input type="text" class="span5" id="nm_emergencia1" value="<?php echo $pessoa['nm_emergencia1'] ?>" name="nm_emergencia1"></td>
            </tr>
            <tr>
                <th scope="col">Número de emergência 2</th>
                <td><input type="text" class="span2" id="nr_emergencia2" value="<?php echo $pessoa['nr_emergencia2'] ?>" name="nr_emergencia2"></td>
            </tr>
            <tr>
                <th scope="col">Nome do contato 2</th>
                <td><input type="text" class="span5" id="nm_emergencia2" value="<?php echo $pessoa['nm_emergencia2'] ?>" name="nm_emergencia2"></td>
            </tr>
        <?php endif ?>
    </table>
    <?php echo form_close() ?>
</div>
</div>

<div id="popup" class="modal fade">
	<div class="modal-body"></div>
	<div class="modal-footer">
		<a id="sim" href="#" class="btn btn-primary pull-right">Sim</a>
		<a id="nao" href="#" class="btn pull-left">Não</a>
	</div>
</div>
<script>
$(function(){

	// Desbilita a edição dos dados do inscrito
	$(":input:not(:button)", "#dados").attr('disabled', true);
	
    // Formulário de Pagamento
    $('#pagar').click(function(event){
		event.preventDefault();
    	var pgto = $("<div />",{
            id:'pagamento',
			class:'modal fade'
        }).appendTo("body")
		.hide()
		.modal({
			'keyboard':true,
			'backdrop':true
		});
        
		$.get($(this).attr('href'), function(resposta){
			$("#pagamento").modal('show');
			pgto.html(resposta);
		});
    });
	
    // Adicionar Foto
	$("#foto-upload").modal({
		'keyboard':true,
		'backdrop':true,
		'show':false
	});
	$("#foto").click(function(event){
		event.preventDefault();
		$("#foto-upload").modal('show');
	});
    
    // Botão que ativa edição dos dados de inscrição
    $("#ativar-correcao").click(function(event){
        if($(this).hasClass('ativo')){
            $(this).removeClass('ativo btn-danger').val('Ativar correção');
            $("input:not(#ativar-correcao), select", '#dados').attr('disabled', true);
        }else{
            $(this).addClass('ativo btn-danger').val('Cancelar correção');
            $("input:not(#ativar-correcao), select", '#dados').attr('disabled', false);
        }
    });
    
    // Criando pop-up de confirmação
	$('#popup').modal({
			'keyboard': true,
			'backdrop': true,
			'show': false
		});
	
    $('.confirmacao').click(function(event){
        event.preventDefault();
        
        var msg = '';
        if(/.+liberar.+/.test($(this).attr('href'))){
            msg = 'Tem certeza que deseja liberar esta inscrição?';
        }else if(/.+excluir.+/.test($(this).attr('href'))){
            msg = 'Tem certeza que deseja excluir esta inscrição?';
			$("#popup").find("#sim").removeClass("primary").addClass("btn-danger");
        }else if(/.+reverter.+/.test($(this).attr('href'))){
            msg = 'Tem certeza que quer reverter esta ação?';
			$("#popup").find("#sim").removeClass("primary").addClass("btn-danger");
        }else{
            msg = 'Tem certeza?';
        }
        
        
        $("#popup").modal('show')
		.find(".modal-body").html('<p>' + msg + '</p>')
		.next(".modal-footer")
		.find("#sim").attr('href', $(this).attr('href'))
		.next("#nao").click(function(){
				$("#popup").modal('hide');
				return false;
			}
		);
    });
	
	// Comandos automáticos
	
	<?php if($this->session->flashdata('auto_pagar')): ?>
	$('#pagar').click();
	<?php endif ?>
	
	<?php if($this->session->flashdata('auto_liberar')): ?>
	$('.confirmacao.liberacao').click();
	<?php endif ?>
	
});
</script>
