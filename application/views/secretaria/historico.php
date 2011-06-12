<div class="log secretaria">
	<h2>Histórico de Impressão de Etiquetas e Fotos</h2>
	<?php if(empty($log)): ?>
		<p>O histórico está vazio. O serviço da secretaria ainda não foi utilizado.</p>
	<?php else: ?>
		<table width="100%" >
		<?php foreach($log as $registro): ?>
			<tr><td>
				<p>Etiquetas de <?php echo $registro->tipo; ?></p>
				<p>Data: <?php echo $registro->data; ?></p>
				<br/>
				<p><?php echo anchor(base_url().'cache/secretaria/'.$registro->etiquetas, 'Baixar etiquetas'); ?></p>
				<p><?php echo anchor(base_url().'cache/secretaria/'.$registro->fotos, 'Baixar fotos'); ?></p>
			</td></tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
</div>