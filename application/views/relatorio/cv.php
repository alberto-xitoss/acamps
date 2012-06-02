<h1>Relatório de Comunidade de Vida</h1>
<p>Relatório gerado em: <?php echo date('d/m/Y - H:m') ?></p>
<?php foreach($tabela as $nm_setor => $pessoas): ?>
<hr/>
<h2><?php echo $nm_setor; ?></h2>
<table>
    <tr>
		<th  width="10%">Inscrição</th>
		<th>Nome</th>
		<th>Serviço</th>
		<th>Situação</th>
	</tr>
<?php foreach($pessoas as $pessoa): ?>
    <tr>
        <td><?php echo $pessoa['id_pessoa'] ?></td>
        <td><?php echo $pessoa['nm_pessoa'] ?></td>
        <td><?php echo $pessoa['nm_servico'] ?></td>
        <td><?php echo $pessoa['ds_status'] ?></td>
    </tr>
<?php endforeach?>
</table>
<?php endforeach ?>