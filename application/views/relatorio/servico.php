<h1>Relatório de Serviço</h1>

<?php foreach($tabela as $servico => $tabela_servico):
    if(!isset($tabela_servico[1]))
        $tabela_servico[1] = array();
    if(!isset($tabela_servico[2]))
        $tabela_servico[2] = array();
    if(!isset($tabela_servico[3]))
        $tabela_servico[3] = array();
?>
    <br/><br/>    
    <h2>Equipe: <?php echo $servico ?></h2>
    <br/>
    <table>
        <tr>
            <th>Pessoas liberadas</th>
            <td width="50"><?php echo count($tabela_servico[1])+count($tabela_servico[3]) ?></td>
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
    <br/>
    <?php if(!empty($tabela_servico[1]) || !empty($tabela_servico[3])): ?>
        <h3>Liberados</h3>
        <table width="800">
            <tr>
                <th width="70">Inscrição</th>
                <th>Nome</th>
                <th width="140">Tipo</th>
                <th width="160">Situação</th>
            </tr>
        <?php foreach($tabela_servico[1] as $linha): ?>
            <tr>
                <td><?php echo $linha['id_pessoa'] ?></td>
                <td style="text-align:left"><?php echo $linha['nm_pessoa'] ?></td>
                <td><?php echo $linha['nm_tipo'] ?></td>
                <td><?php echo $linha['ds_status'] ?></td>
            </tr>
        <?php endforeach?>
        <?php foreach($tabela_servico[3] as $linha): ?>
            <tr>
                <td><?php echo $linha['id_pessoa'] ?></td>
                <td style="text-align:left"><?php echo $linha['nm_pessoa'] ?></td>
                <td><?php echo $linha['nm_tipo'] ?></td>
                <td><?php echo $linha['ds_status'] ?></td>
            </tr>
        <?php endforeach ?>
        </table>
        <br/>
    <?php endif ?>
    <?php if(!empty($tabela_servico[2])): ?>
        <h3>Aguardando Liberação</h3>
        <table width="800">
            <tr>
                <th width="70">Inscrição</th>
                <th>Nome</th>
                <th width="140">Tipo</th>
            </tr>
        <?php foreach($tabela_servico[2] as $linha): ?>
            <tr>
                <td><?php echo $linha['id_pessoa'] ?></td>
                <td style="text-align:left"><?php echo $linha['nm_pessoa'] ?></td>
                <td><?php echo $linha['nm_tipo'] ?></td>
            </tr>
        <?php endforeach ?>
        </table>
    <?php endif ?>
<?php endforeach ?>