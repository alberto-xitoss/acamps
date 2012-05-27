<h1>Relatório de Pagamento</h1>
<p>Relatório gerado em: <?php echo date('d/m/Y - H:m') ?></p>
<hr/>
<?php if(isset($dt_pgto)): ?>

<p>Pagamentos do dia: <?php echo $dt_pgto ?></p>
<p>Total de inscrições pagas neste dia: <?php echo count($tabela) ?></p>
<p>Valor total do dia: 

<?php else: ?>

<p>Pagamentos do período: <?php echo $dt_inicio ?> a <?php echo $dt_fim ?></p>
<p>Total de inscrições pagas neste período: <?php echo count($tabela) ?></p>
<p>Valor total do período:
		
<?php endif ?>

<?php
	$total = 0;
	foreach($tabela as $l){
		$total += $l['nr_pago'];
	}
	printf('R$ %.2f', $total);
?></p>
<table>
	<thead>
		<tr>
			<th width='6%'>Inscr.</th>
			<th>Nome</th>
			<th>Tipo</th>
			<th>Usuário</th>
			<th>Forma</th>
			<th>Data</th>
			<th width="10%">Valor</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($tabela as $linha): ?>
			<tr>
				<td><?php echo $linha['id_pessoa'] ?></td>
				<td style="text-align:left"><?php echo $linha['nm_pessoa'] ?></td>
				<td><?php echo $linha['nm_tipo'] ?></td>
				<td style="text-align:left"><?php echo $linha['nm_usuario'] ?></td>
				<td><?php echo $linha['nm_tipo_pgto'] ?></td>
				<td><?php echo date_create($linha['dt_pgto'])->format('d/m/Y H:i') ?></td>
				<td><?php printf('R$ %.2f', $linha['nr_pago']) ?></td>
			</tr>
		<?php endforeach?>
	</tbody>
</table>