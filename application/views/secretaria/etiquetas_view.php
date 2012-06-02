<?php if($tipo=='p'): ?>

	<h2>Etiquetas de Participantes</h2>

	<?php if($form): ?>
		<div class="wrap secretaria participante">
			<?php echo form_open('admin/etiqueta/p', 'class="form-inline"') ?>
				<div class="well well-small">
					<p>Digite uma faixa de números de inscrições</p>
					<p>Deixe em branco se quiser buscar todas as inscrições</p>
				</div>
				<table>
					<tr>
						<td>Inicial</td>
						<td>Final</td>
						<td></td>
					</tr>
					<tr>
						<td><input type="text" placeholder="0" name="id_ini" class="input-mini"></td>
						<td><input type="text" placeholder="9999" name="id_fim" class="input-mini"></td>
						<td><?php echo form_submit('listar', 'Listar', 'class="btn"') ?></td>
					</tr>
				</table>
			<?php echo form_close() ?>
		</div>
	<?php else: ?>
		<div class="secretaria">
			<?php echo form_open('admin/etiqueta/p') ?>
			<table class="table etiquetas">
				<thead>
					<tr>
						<th class="inscricao">Inscrição</th>
						<th>Nome</th>
						<th>Família</th>
						<th>Atividade</th>
						<th class="cracha">Tem crachá?</th>
						<th class="imprimir"><a href="#" class="todos">Imprimir etiqueta?</a></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($pessoas as $pessoa): ?>
						<tr>
							<td class="inscricao"><?php echo $pessoa['id_pessoa'] ?></td>
							<td><?php echo $pessoa['nm_pessoa'] ?></td>
							<td><span class="tipo-p familia-<?php echo strtolower($pessoa['cd_familia']) ?>"><?php echo $pessoa['nm_familia'] ?></span></td>
							<td><?php echo $pessoa['ds_seminario'] ?></td>
							<td class="cracha"><?php if($pessoa['bl_cracha']):?>
								<span class="sim">Sim</span>
							<?php else: ?>
								<span class="nao">Não</span>
							<?php endif ?>
							</td>
							<td class="imprimir"><?php echo form_checkbox('imprimir[]', $pessoa['id_pessoa'], !$pessoa['bl_cracha']) ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<p align="center"><?php echo form_submit('gerar', 'Gerar Etiquetas', 'class="btn btn-primary btn-large"') ?></p>
			<?php echo form_close() ?>
		</div>
	<?php endif ?>


<?php elseif($tipo=='s'): ?>

	<h2>Etiquetas de Serviço</h2>
	<?php if($form): ?>
		<div class="wrap secretaria">
			<?php echo form_open('admin/etiqueta/s', 'class="form-inline"') ?>
			<table>
				<tr>
					<td>Serviço:</td>
					<td><?php
						$servicos = $this->servico->listar();
						$servicos = array_merge(array('0'=>'Todos'), $servicos);
						echo form_dropdown('id_servico', $servicos);
					?></td>
					<td><?php echo form_submit('listar', 'Listar', 'class="btn"') ?></td>
				</tr>
			</table>
			<?php echo form_close() ?>
		</div>
	<?php else: ?>
		<div class="secretaria">
			<?php echo form_open('admin/etiqueta/s') ?>
			<table class="table etiquetas">
				<thead>
					<tr>
						<th class="inscricao">Inscrição</th>
						<th>Nome</th>
						<th>Servico</th>
						<th class="cracha">Tem crachá?</th>
						<th class="imprimir"><a href="#" class="todos">Imprimir etiqueta?</a></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($pessoas as $pessoa): ?>
						<tr>
							<td class="inscricao"><?php echo $pessoa['id_pessoa'] ?></td>
							<td><?php echo $pessoa['nm_pessoa'] ?></td>
							<td><?php echo $pessoa['nm_servico'] ?></td>
							<td class="cracha"><?php if($pessoa['bl_cracha']):?>
								<span class="sim">Sim</span>
							<?php else: ?>
								<span class="nao">Não</span>
							<?php endif ?>
							</td>
							<td class="imprimir"><?php echo form_checkbox('imprimir[]', $pessoa['id_pessoa'], !$pessoa['bl_cracha']) ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<p align="center"><?php echo form_submit('gerar', 'Gerar Etiquetas', 'class="btn btn-primary btn-large"') ?></p>
			<?php echo form_close() ?>
		</div>
	<?php endif ?>

<?php elseif($tipo=='cv'): ?>

	<h2>Etiquetas de Comunidade de Vida</h2>
	<?php if($form): ?>
		<div class="wrap secretaria">
			<?php echo form_open('admin/etiqueta/cv', 'class="form-inline"') ?>
				<table>
					<tr>
						<td>Setor:</td>
						<td><?php
							$setores = $this->setor->listar();
							$setores = array_merge(array('0'=>'Todos'), $setores);
							echo form_dropdown('id_setor', $setores);
						?></td>
						<td><?php echo form_submit('listar', 'Listar', 'class="btn"') ?></td>
					</tr>
				</table>
			<?php echo form_close() ?>
		</div>
	<?php else: ?>
		<div class="secretaria">
			<?php echo form_open('admin/etiqueta/cv') ?>
			<table class="table etiquetas">
				<thead>
					<tr>
						<th class="inscricao">Inscrição</th>
						<th>Nome</th>
						<th>Setor</th>
						<th>Servico</th>
						<th class="cracha">Tem crachá?</th>
						<th class="imprimir"><a href="#" class="todos">Imprimir etiqueta?</a></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($pessoas as $pessoa): ?>
						<tr>
							<td class="inscricao"><?php echo $pessoa['id_pessoa'] ?></td>
							<td><?php echo $pessoa['nm_pessoa'] ?></td>
							<td><?php echo $pessoa['nm_setor'] ?></td>
							<td><?php echo $pessoa['nm_servico'] ?></td>
							<td class="cracha"><?php if($pessoa['bl_cracha']):?>
								<span class="sim">Sim</span>
							<?php else: ?>
								<span class="nao">Não</span>
							<?php endif ?>
							</td>
							<td class="imprimir"><?php echo form_checkbox('imprimir[]', $pessoa['id_pessoa'], !$pessoa['bl_cracha']) ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<p align="center"><?php echo form_submit('gerar', 'Gerar Etiquetas', 'class="btn btn-primary btn-large"') ?></p>
			<?php echo form_close() ?>
		</div>
	<?php endif ?>

<?php elseif($tipo=='amigos'): ?>

	<h2>Etiquetas - Amigos do Acamp's</h2>
	<div class="secretaria">
		<?php echo form_open('admin/etiqueta/amigos', 'class="form-inline"') ?>
			<table class="table etiquetas">
				<thead>
					<tr>
						<th class="inscricao">Inscr</th>
						<th>Nome</th>
						<th>Família</th>
						<th class="cracha">Tem crachá?</th>
						<th class="imprimir"><a href="#" class="todos">Imprimir etiqueta?</a></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($pessoas as $pessoa): ?>
						<tr>
							<td class="inscricao"><?php echo $pessoa['id_pessoa'] ?></td>
							<td><?php echo $pessoa['nm_pessoa'] ?></td>
							<td><?php
								$familias = $this->familia->listar(true);
								echo form_dropdown($pessoa['id_pessoa'], $familias);
							?></td>
							<td class="cracha">
							<?php if($pessoa['bl_cracha']):?>
								<span class="sim">Sim</span>
							<?php else: ?>
								<span class="nao">Não</span>
							<?php endif ?>
							</td>
							<td class="imprimir"><?php echo form_checkbox('imprimir[]', $pessoa['id_pessoa'], !$pessoa['bl_cracha']) ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<p align="center"><?php echo form_submit('gerar', 'Gerar Etiquetas', 'class="btn btn-primary btn-large"') ?></p>
		<?php echo form_close() ?>
	</div>

<?php elseif($tipo=='e'): ?>

	<h2>Etiquetas - Especial</h2>
	<div class="secretaria">
		<?php echo form_open('admin/etiqueta/e', 'class="form-inline"') ?>
			<table class="table etiquetas">
				<thead>
					<tr>
						<th class="inscricao">Inscr</th>
						<th>Nome</th>
						<th>Serviço</th>
						<th class="cracha">Tem crachá?</th>
						<th class="imprimir"><a href="#" class="todos">Imprimir etiqueta?</a></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($pessoas as $pessoa): ?>
						<tr>
							<td class="inscricao"><?php echo $pessoa['id_pessoa'] ?></td>
							<td><?php echo $pessoa['nm_pessoa'] ?></td>
							<td><?php echo $pessoa['nm_servico'] ?></td>
							<td class="cracha">
							<?php if($pessoa['bl_cracha']):?>
								<span class="sim">Sim</span>
							<?php else: ?>
								<span class="nao">Não</span>
							<?php endif ?>
							</td>
							<td class="imprimir"><?php echo form_checkbox('imprimir[]', $pessoa['id_pessoa'], !$pessoa['bl_cracha']) ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<p align="center"><?php echo form_submit('gerar', 'Gerar Etiquetas', 'class="btn btn-primary btn-large"') ?></p>
		<?php echo form_close() ?>
	</div>

<?php elseif($tipo=='visitante'): ?>

	<h2>Etiquetas - Visitantes</h2>
	<div class="secretaria wrap visitante">
		<p class="well well-small">Escreva nos campos abaixo todos os nomes para os quais você deseja gerar etiquetas.</p>
		<?php echo form_open('admin/etiqueta/visitante') ?>
			<table>
				<tbody>
					<tr>
						<td><input type="text" placeholder="Visitante 1" name="imprimir[]"></td>
						<td><input type="text" placeholder="Visitante 2" name="imprimir[]"></td>
					</tr>
					<tr>
						<td><input type="text" placeholder="Visitante 3" name="imprimir[]"></td>
						<td><input type="text" placeholder="Visitante 4" name="imprimir[]"></td>
					</tr>
					<tr>
						<td><input type="text" placeholder="Visitante 5" name="imprimir[]"></td>
						<td><input type="text" placeholder="Visitante 6" name="imprimir[]"></td>
					</tr>
					<tr>
						<td><input type="text" placeholder="Visitante 7" name="imprimir[]"></td>
						<td><input type="text" placeholder="Visitante 8" name="imprimir[]"></td>
					</tr>
					<tr>
						<td><input type="text" placeholder="Visitante 9" name="imprimir[]"></td>
						<td><input type="text" placeholder="Visitante 10" name="imprimir[]"></td>
					</tr>
					<tr>
						<td><input type="text" placeholder="Visitante 11" name="imprimir[]"></td>
						<td><input type="text" placeholder="Visitante 12" name="imprimir[]"></td>
					</tr>
					<tr>
						<td><input type="text" placeholder="Visitante 13" name="imprimir[]"></td>
						<td><input type="text" placeholder="Visitante 14" name="imprimir[]"></td>
					</tr>
					<tr>
						<td><input type="text" placeholder="Visitante 15" name="imprimir[]"></td>
						<td><input type="text" placeholder="Visitante 16" name="imprimir[]"></td>
					</tr>
					<tr>
						<td><input type="text" placeholder="Visitante 17" name="imprimir[]"></td>
						<td><input type="text" placeholder="Visitante 18" name="imprimir[]"></td>
					</tr>
				</tbody>
			</table>
			<p align="center"><?php echo form_submit('gerar', 'Gerar Etiquetas', 'class="btn btn-primary btn-large"') ?></p>
		<?php echo form_close() ?>
	</div>

<?php endif ?>

<script>
	$(function()
	{
		var op = 0;
		
		$("a.todos").click(function(event)
		{
			event.preventDefault();
			if(op==0)
			{
				$("input[type=checkbox]").attr('checked', true);
			}
			else if(op==1)
			{
				$("input[type=checkbox]").attr('checked', false);
			}
			else if(op==2)
			{
				$("input[type=checkbox]").attr('checked', function(index,attr){
				
					val = $(this).parent('td').prev('td').children('span').html();
					if(val == "Sim")
					{
						return false;
					}
					else
					{
						return true;
					}
				});
			}
			op = (op+1)%3;
		});
		
	});
</script>
