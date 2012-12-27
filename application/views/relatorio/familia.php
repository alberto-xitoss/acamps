<h1>Relatório de Participantes</h1>
<p>Relatório gerado em: <?php echo date('d/m/Y - H:m') ?></p>
<?php foreach($tabela as $nm_familia => $pessoas): ?>
	<hr/>
	<h2><?php echo $nm_familia; ?></h2>
	<p>Nº de Pessoas: <?php echo count($pessoas) ?></p>
	<table>
		<thead>
		<tr>
			<th width="10%">Inscrição</th>
			<th>Nome</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($pessoas as $pessoa): ?>
			<tr>
				<td><?php echo $pessoa['id_pessoa'] ?></td>
				<td><?php echo $pessoa['nm_pessoa'] ?></td>
			</tr>
		<?php endforeach?>
		</tbody>
	</table>
<?php endforeach ?>

<script>
	
	$(function(){
		$("thead").click(function(e){
			$("tbody", $(this).parent()).toggle();
		});
	});
	
</script>