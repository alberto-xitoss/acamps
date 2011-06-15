<?php 

if($tipo=='p'):

?>
<div id="secretaria" class="wrap participante">
    <h2>Etiquetas de Participantes</h2>
    <?php if($form): ?>
    	<div class="form">
        <?php echo form_open('admin/etiqueta/p') ?>
            <p class="info">- Digite uma faixa de números de inscrições<br/>- Deixe em branco se quiser buscar todas as inscrições</p>
            <table class="center">
                <tr><td width="40">Inicial:</td><td><?php echo form_input('id_ini') ?></td></tr>
                <tr><td>Final:</td><td><?php echo form_input('id_fim') ?></td></tr>
            </table>
            <p class="center"><?php echo form_submit('verificar', 'Listar') ?></p>
        <?php echo form_close() ?>
        </div>
    <?php else: ?>
        <?php echo form_open('admin/etiqueta/p') ?>
        <table width="100%">
            <thead><tr>
                <th width="40">Inscr</th>
                <th>Nome</th>
                <th width="90">Família</th>
                <th width="130">Seminário</th>
                <th class="center" width="70">Tem crachá?</th>
                <th class="center" width="70"><a href="#" class="todos">Imprimir etiqueta?</a></th>
            </tr></thead><tbody>
            <?php foreach($pessoas as $pessoa): ?>
                <tr>
                    <td class="center"><?php echo $pessoa['id_pessoa'] ?></td>
                    <td><?php echo $pessoa['nm_pessoa'] ?></td>
                    <td><span class="tipo-p familia-<?php echo strtolower($pessoa['cd_familia']) ?>"><?php echo $pessoa['nm_familia'] ?></span></td>
                    <td><?php echo $pessoa['ds_seminario'] ?></td>
                    <td class="center"><?php if($pessoa['bl_cracha']):?>
						<span class="sim">Sim</span>
					<?php else: ?>
						<span class="nao">Não</span>
					<?php endif ?>
                    </td>
                    <td class="center"><?php echo form_checkbox('imprimir[]', $pessoa['id_pessoa'], !$pessoa['bl_cracha']) ?></td>
                </tr>
            <?php endforeach ?></tbody>
        </table>
        <br/>
        <p class="center"><?php echo form_submit('gerar', 'Gerar Etiquetas') ?></p>
        <?php echo form_close() ?>
    <?php endif ?>
</div>
<?php 

elseif($tipo=='s'):

?>
<div id="secretaria" class="wrap servico">
    <h2>Etiquetas de Serviço</h2>
    <?php if($form): ?>
    	<div class="form">
        <?php echo form_open('admin/etiqueta/s') ?>
            <p class="center">Serviço: <?php
                $servicos = $this->servico->listar();
                $servicos = array_merge(array('0'=>'Todos'), $servicos);
                echo form_dropdown('id_servico', $servicos);
            ?></p>
            <br/>
            <p class="center"><?php echo form_submit('verificar', 'Listar') ?></p>
        <?php echo form_close() ?>
        </div>
    <?php else: ?>
        <?php echo form_open('admin/etiqueta/s') ?>
        <table width="100%">
            <thead><tr>
                <th width="40">Inscr</th>
                <th>Nome</th>
                <th width="200">Servico</th>
                <th class="center" width="70">Tem crachá?</th>
                <th class="center" width="70"><a href="#" class="todos">Imprimir etiqueta?</a></th>
            </tr></thead><tbody>
            <?php $swap = false;
                foreach($pessoas as $pessoa):?>
                <tr class='<?php
                    if($swap)
                        echo 'zebra ';
                    if(!$pessoa['bl_cracha'])
                        echo 'vermelho';
                    $swap = !$swap;
                ?>'>
                    <td class="center"><?php echo $pessoa['id_pessoa'] ?></td>
                    <td><?php echo $pessoa['nm_pessoa'] ?></td>
                    <td><?php echo $pessoa['nm_servico'] ?></td>
                    <td class="center"><?php if($pessoa['bl_cracha']):?>
                        <span class="sim">Sim</span>
					<?php else: ?>
						<span class="nao">Não</span>
                    <?php endif ?>
                    </td>
                    <td class="center"><?php echo form_checkbox('imprimir[]', $pessoa['id_pessoa'], !$pessoa['bl_cracha']) ?></td>
                </tr>
            <?php endforeach ?></tbody>
        </table>
        <br/>
        <p class="center"><?php echo form_submit('gerar', 'Gerar Etiquetas') ?></p>
        <?php echo form_close() ?>
    <?php endif ?>
</div>
<?php

elseif($tipo=='cv'):

?>
<div id="secretaria" class="wrap cv">
    <h2>Etiquetas de Comunidade de Vida</h2>
    <?php if($form): ?>
    	<div class="form">
        <?php echo form_open('admin/etiqueta/cv') ?>
            <p class="center">Setor: <?php
                $setores = $this->setor->listar();
                $setores = array_merge(array('0'=>'Todos'), $setores);
                echo form_dropdown('id_setor', $setores);
            ?></p>
            <br/>
            <p class="center"><?php echo form_submit('verificar', 'Listar') ?></p>
        <?php echo form_close() ?>
        </div>
    <?php else: ?>
        <?php echo form_open('admin/etiqueta/cv') ?>
        <table width="100%">
            <thead><tr>
                <th width="40">Inscr</th>
                <th>Nome</th>
                <th width="180">Setor</th>
                <th width="180">Servico</th>
                <th class="center" width="70">Tem crachá?</th>
                <th class="center" width="70"><a href="#" class="todos">Imprimir etiqueta?</a></th>
            </tr></thead><tbody>
            <?php $swap = false;//$this->firephp->log($pessoas);
                foreach($pessoas as $pessoa):?>
                <tr class='<?php
                    if($swap)
                        echo 'zebra ';
                    if(!$pessoa['bl_cracha'])
                        echo 'vermelho';
                    $swap = !$swap;
                ?>'>
                    <td class="center"><?php echo $pessoa['id_pessoa'] ?></td>
                    <td><?php echo $pessoa['nm_pessoa'] ?></td>
                    <td><?php echo $pessoa['nm_setor'] ?></td>
                    <td><?php echo $pessoa['nm_servico'] ?></td>
                    <td class="center"><?php if($pessoa['bl_cracha']):?>
                        <span class="sim">Sim</span>
					<?php else: ?>
						<span class="nao">Não</span>
                    <?php endif ?>
                    </td>
                    <td class="center"><?php echo form_checkbox('imprimir[]', $pessoa['id_pessoa'], !$pessoa['bl_cracha']) ?></td>
                </tr>
            <?php endforeach ?></tbody>
        </table>
        <br/>
        <p class="center"><?php echo form_submit('gerar', 'Gerar Etiquetas') ?></p>
        <?php echo form_close() ?>
    <?php endif ?>
</div>
<?php

elseif($tipo=='amigos'):

?>
<div id="amigos" class="wrap">
    <h2>Etiquetas - Amigos do Acamp's</h2>
    <?php echo form_open('admin/etiqueta/amigos') ?>
        <table width="100%">
            <thead><tr>
                <th width="40">Inscr</th>
                <th>Nome</th>
                <th width="200">Família</th>
                <th class="center" width="70">Tem crachá?</th>
                <th class="center" width="70"><a href="#" class="todos">Imprimir etiqueta?</a></th>
            </tr></thead><tbody>
            <?php $swap = false;//$this->firephp->log($pessoas);
                foreach($pessoas as $pessoa):?>
                <tr class='<?php
                    if($swap)
                        echo 'zebra ';
                    if(!$pessoa['bl_cracha'])
                        echo 'vermelho';
                    $swap = !$swap;
                ?>'>
                    <td class="center"><?php echo $pessoa['id_pessoa'] ?></td>
                    <td><?php echo $pessoa['nm_pessoa'] ?></td>
                    <td><?php
                        $familias = $this->familia->listar(true);
                        echo form_dropdown($pessoa['id_pessoa'], $familias);
                    ?></td>
                    <td class="center">
                    <?php if($pessoa['bl_cracha']):?>
                        <span style="color: #039B03;">Sim</span>
                    <?php else: ?>
                        <span style="color: #D3120E;">Não</span>
                    <?php endif ?>
                    </td>
                    <td class="center"><?php echo form_checkbox('imprimir[]', $pessoa['id_pessoa'], !$pessoa['bl_cracha']) ?></td>
                </tr>
            <?php endforeach ?></tbody>
        </table>
        <br/>
        <p class="center"><?php echo form_submit('gerar', 'Gerar Etiquetas') ?></p>
    <?php echo form_close() ?>
</div>
<?php

endif

?>
<script>
	$(function(){
		var op = 0;
		
		$("a.todos").click(function(event){
			event.preventDefault();
			if(op==0){
				$("input[type=checkbox]").attr('checked', true);
			}else if(op==1){
				$("input[type=checkbox]").attr('checked', false);
			}else if(op==2){
				$("input[type=checkbox]").attr('checked', function(index,attr){
					val = $(this).parent('td').prev('td').children('span').html();
					if(val == "Sim"){
						return false;
					}else{
						return true;
					}
				});
			}
			op = (op+1)%3;
		});
		
	});
</script>
