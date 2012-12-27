<h1>Relatório de Participantes do Seminário por Idade</h1>
<p>Relatório gerado em: <?php echo date('d/m/Y - H:m') ?></p>
<table style="width:auto">
	<thead>
	<tr>
		<th>Idade</th>
		<th>Quantidade</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($tabela as $linha): ?>
		<tr>
			<td><?php echo $linha['idade']; ?></td>
			<td><?php echo $linha['num']; ?></td>
		</tr>
	<?php endforeach?>
	</tbody>
</table>