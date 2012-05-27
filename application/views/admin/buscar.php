<div id="busca" class="form-inline">
	<?php echo form_open('admin/buscar') ?>
	<input type="text" id="consulta" value="<?php if(isset($consulta))echo $consulta ?>" name="consulta"><input type="submit" class="btn btn-primary" value="Buscar" name="buscar" id="buscar">
	<?php echo form_close() ?>
</div>

<div id="resultado">
<?php if(is_array($resultado) && count($resultado) > 0): ?>
	<table class="table table-striped">
		<tbody>
			<?php foreach($resultado as $linha): ?>
				<tr>
					<td><?php
						echo anchor('admin/pessoa/'.$linha->id_pessoa,
							'<span class="id-'.$linha->cd_tipo.' status-'.$linha->id_status.'">' .
							$linha->id_pessoa .
							'</span>' .
							$linha->nm_pessoa) ?></td>
					<td width="180">
					<?php if($linha->cd_tipo == 'p'): ?>
						<span class="tipo-p familia-<?php echo strtolower($linha->cd_familia) ?>"><?php echo empty($linha->nm_familia) ? $linha->nm_tipo : $linha->nm_familia ?></span>
					<?php else: ?>
						<span class="tipo-<?php echo $linha->cd_tipo ?>"><?php echo $linha->nm_tipo ?></span>
					<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php echo $this->pagination->create_links() ?>
<?php elseif(is_array($resultado) && count($resultado) == 0): ?>
	Não foi encontrado nenhum resultado.
<?php endif; ?>
</div>
<div id="detalhes-min">
	detalhes-min
</div>