<h2>Histórico de Impressão de Etiquetas e Fotos</h2>
<div class="wrap">
	<?php if(empty($log)): ?>
		<p class="well well-small">O histórico está vazio. O serviço da secretaria ainda não foi utilizado.</p>
	<?php else: ?>
		<?php foreach($log as $registro): ?>
			<div class="well">
				<p>Etiquetas de <?php echo $registro->tipo; ?></p>
				<p>Data: <?php echo $registro->data; ?></p>
				<p><?php echo anchor(base_url().'cache/secretaria/'.$registro->etiquetas, 'Baixar etiquetas', 'target="_blank"'); ?></p>
				<?php if(isset($registro->bordas)): ?>
					<p><?php echo anchor(base_url().'cache/secretaria/'.$registro->bordas, 'Baixar etiquetas com bordas', 'target="_blank"'); ?></p>
				<?php endif ?>
				<p><?php echo anchor(base_url().'cache/secretaria/'.$registro->fotos, 'Baixar fotos'), 'target="_blank"'; ?></p>
			</div>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
</div>
