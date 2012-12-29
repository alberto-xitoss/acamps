<h2>Locais de Saída e Chegada dos Ônibus</h2>
<div id="onibus-locais" class="wrap">
	<?php if(!empty($onibus_locais)):?>
		<table class="table table-bordered">
			<?php foreach($onibus_locais as $local): ?>
				<tr><td><?php echo $local ?></td><td><i class="icon-pencil"></i><i class="icon-remove"></i></td></tr>
			<?php endforeach ?>
		</table>
	<?php else: ?>
		<p>Nenhum local foi definido.</p>
	<?php endif ?>
	
	<?php echo form_open('admin/onibus/locais', array('class'=>'form-horizontal')) ?>
		<input type="text" id="nm_local" placeholder="Adicionar novo local" name="nm_local" />
		<button type="submit" name="adicionar" value="adicionar" class="btn">Adicionar</button>
	<?php form_close() ?>
</div>