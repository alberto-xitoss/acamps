<h1>Pesquisa sobre Meios de Divulgação</h1>
<p>Relatório gerado em: <?php echo date('d/m/Y - H:m') ?></p>
<table style="width:auto">
	<thead>
	<tr>
		<th>Meio</th>
		<th>Repostas</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($tabela as $linha): ?>
		<tr>
			<td><?php echo $linha['nm_meio']; ?></td>
			<td><?php echo $linha['nr_meio']; ?></td>
		</tr>
	<?php endforeach?>
	</tbody>
</table>