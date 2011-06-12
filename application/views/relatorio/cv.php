<h1>Relatório de Comunidade de Vida</h1>
<br/>
<?php foreach($tabela as $nm_setor => $pessoas): ?>
<h2>Setor: <?php echo $nm_setor; ?></h2>
<br/>
<table border="1" width="800">
    <tr><th width="70">Inscrição</th><th>Nome</th><th>Serviço</th><th width="160">Situação</th></tr>
<?php foreach($pessoas as $pessoa): ?>
    <tr>
        <td><?php echo $pessoa['id_pessoa'] ?></td>
        <td style="text-align:left"><?php echo $pessoa['nm_pessoa'] ?></td>
        <td><?php echo $pessoa['nm_servico'] ?></td>
        <td><?php echo $pessoa['ds_status'] ?></td>
    </tr>
<?php endforeach?>
</table>
<br/>
<?php endforeach ?>