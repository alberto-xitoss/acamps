<h2>Auditoria de Pagamento de Inscrições</h2>
<div id="auditoria">
	<?php echo form_open('admin/auditar') ?>
		<p class="form-inline" align="center">
			<label for="data">Data</label>
			<input type="text" id="data" name="data" class="span2" value="<?php echo $data_default ?>">
			<?php echo form_submit('verificar', 'Verificar', 'class="btn"') ?>
		</p>
	<?php echo form_close() ?>
	<?php if(isset($resultado)): ?>
		<p>Total: <?php echo count($resultado) ?> Inscrições</p>
		<?php if(count($resultado)>0): ?>
			<table class="table">
				<tr>
					<th>Inscrição</th>
					<th>Nome</th>
					<th>Tipo</th>
					<th>Responsável</th>
					<th>Forma</th>
					<th>Data</th>
					<th>Valor Pago</th>
					<th>Desconto</th>
					<th></th>
				</tr>
				<?php foreach ($resultado as $linha): ?>
				<tr>
					<td><?php echo $linha['id_pessoa'] ?></td>
					<td style="text-align:left"><?php echo $linha['nm_pessoa'] ?></td>
					<td><?php echo $linha['nm_tipo'] ?></td>
					<td style="text-align:left"><?php echo $linha['nm_usuario'] ?></td>
					<td><?php echo $linha['nm_tipo_pgto'] ?></td>
					<td><?php echo date_create($linha['dt_pgto'])->format('d/m/Y H:i') ?></td>
					<td><?php printf('R$ %.2f', $linha['nr_pago']) ?></td>
					<td><?php printf('R$ %.2f', $linha['nr_desconto']) ?></td>
					<td>
					<?php if(empty($linha['bl_verificada'])): ?>
						<a href="#" data-id="<?php echo $linha['id_pessoa'] ?>" class="concluir btn btn-small btn-primary">Concluir</a>
					<?php else: ?>
						<a href="#" data-id="<?php echo $linha['id_pessoa'] ?>" class="reverter btn btn-small btn-danger">Reverter</a>
					<?php endif ?>
					</td>
				</tr>
				<?php endforeach ?>
			</table>
		<?php else: ?>
			Nenhum pagamento foi realizado nessa data
		<?php endif ?>
	<?php endif ?>
</div>

<script type="text/javascript">
	
	$(function(){
		$('#data').datepicker({
			yearRange: '2012',
			changeMonth: true,
			changeYear: true,
			onClose: function(dateText, inst){
				$(this).change();
			},
			showOn: "button",
			buttonImage: "<?php echo img_url() ?>calendar.png",
			buttonImageOnly: true
		});

		$('#auditoria').on("click", ".concluir", function(event){
			btn = $(this);
			btn.after('<img src="<?php echo img_url() ?>ajax-loader.gif" />');
			
			$.get('financeiro/concluir/'+this.attributes.getNamedItem('data-id').value,
					function(response){
						console.log(response);
						btn.next().remove();
						btn.html('Reverter').removeClass('concluir btn-primary').addClass('reverter btn-danger');
					});
			event.preventDefault();
		});

		$('#auditoria').on("click", ".reverter", function(event){
			btn = $(this);
			btn.after('<img src="<?php echo img_url() ?>ajax-loader.gif" />');
			
			$.get('financeiro/reverter/'+this.attributes.getNamedItem('data-id').value,
					function(response){
						console.log(response);
						btn.next().remove();
						btn.html('Concluir').removeClass('reverter btn-danger').addClass('concluir btn-primary');
					});
			event.preventDefault();
		});
	});
	
</script>