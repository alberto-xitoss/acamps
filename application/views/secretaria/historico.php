<h2>Histórico de Impressão de Etiquetas e Fotos</h2>
<div class="wrap">
	<?php if(empty($log)): ?>
		<p class="well well-small">O histórico está vazio. O serviço da secretaria ainda não foi utilizado.</p>
	<?php else: ?>
		<?php foreach($log as $registro): ?>
			<div class="well">
				<p>Etiquetas de <?php echo $registro->tipo; ?></p>
				<p>Data: <?php echo $registro->data; ?></p>
				<p>Baixar etiquetas:</p>
				<ul>
					<li><?php echo anchor(base_url().'cache/secretaria/'.$registro->etiquetas, 'Sem bordas', 'target="_blank"'); ?></li>
					<?php if(isset($registro->bordas)): ?>
						<li><?php echo anchor(base_url().'cache/secretaria/'.$registro->bordas, 'Com bordas', 'target="_blank"'); ?></li>
					<?php endif ?>
				</ul>
				<p><?php echo anchor(base_url().'cache/secretaria/'.$registro->fotos, 'Baixar fotos', 'target="_blank"'); ?></p>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
