<h1>Relatório de Serviço</h1>
<p>Relatório gerado em: <?php echo date('d/m/Y - H:m') ?></p>
<?php foreach($tabela as $servico => $tabela_servico):
    if(!isset($tabela_servico[1]))
        $tabela_servico[1] = array();
    if(!isset($tabela_servico[2]))
        $tabela_servico[2] = array();
    if(!isset($tabela_servico[3]))
        $tabela_servico[3] = array();
?>  
    <hr/>
	<h2><?php echo $servico ?></h2>
    <table>
        <tr>
            <th>Pessoas liberadas</th>
            <td><?php echo count($tabela_servico[1])+count($tabela_servico[3]) ?></td>
        </tr>
        <tr>
            <th>Pessoas não liberadas</th>
            <td><?php echo count($tabela_servico[2]) ?></td>
        </tr>
        <tr>
            <th>Total</th>
            <td><?php echo count($tabela_servico[1])+count($tabela_servico[2])+count($tabela_servico[3]) ?></td>
        </tr>
    </table>
	<table>
		<thead>
			<tr>
				<th width="10%">Inscrição</th>
				<th>Nome</th>
				<th width="30%">Situação</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$todos = array_merge($tabela_servico[3], $tabela_servico[1], $tabela_servico[2]);
			?>
			<?php foreach($todos as $linha): ?>
				<tr>
					<td><?php echo $linha['id_pessoa'] ?></td>
					<td><?php echo $linha['nm_pessoa'];
					switch($linha['cd_tipo']) {
						case 'v':
							echo ' (CV)';
							break;
						case 'e':
							echo ' (Especial)';
							break;
						default:
							echo '';
					}
					?></td>
					<td><?php echo ($linha['id_status'] == 1 ? 'Liberado - ' : '') . $linha['ds_status'] ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
    <?php /* if(!empty($tabela_servico[1]) || !empty($tabela_servico[3])): ?>
        <h3>Liberados</h3>
        <table>
            <tr>
                <th width="10%">Inscrição</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Situação</th>
            </tr>
        <?php foreach($tabela_servico[1] as $linha): ?>
            <tr>
                <td><?php echo $linha['id_pessoa'] ?></td>
                <td><?php echo $linha['nm_pessoa'] ?></td>
                <td><?php echo $linha['nm_tipo'] ?></td>
                <td><?php echo $linha['ds_status'] ?></td>
            </tr>
        <?php endforeach?>
        <?php foreach($tabela_servico[3] as $linha): ?>
            <tr>
                <td><?php echo $linha['id_pessoa'] ?></td>
                <td><?php echo $linha['nm_pessoa'] ?></td>
                <td><?php echo $linha['nm_tipo'] ?></td>
                <td><?php echo $linha['ds_status'] ?></td>
            </tr>
        <?php endforeach ?>
        </table>
    <?php endif ?>
    <?php if(!empty($tabela_servico[2])): ?>
        <h3>Aguardando Liberação</h3>
        <table>
            <tr>
                <th width="10%">Inscrição</th>
                <th>Nome</th>
                <th>Tipo</th>
            </tr>
        <?php foreach($tabela_servico[2] as $linha): ?>
            <tr>
                <td><?php echo $linha['id_pessoa'] ?></td>
                <td><?php echo $linha['nm_pessoa'] ?></td>
                <td><?php echo $linha['nm_tipo'] ?></td>
            </tr>
        <?php endforeach ?>
        </table>
    <?php endif */ ?>
<?php endforeach ?>