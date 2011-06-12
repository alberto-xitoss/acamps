<h1>Relatório de Pagamento</h1>
<br/>
<?php if(isset($dt_pgto)): ?>
<h2>Data: <?php echo $dt_pgto ?></h2>
<br/>
<table>
    <tr>
        <th>Total de inscrições pagas neste dia</th>
        <td><?php echo count($tabela) ?></td>
    </tr>
    <tr>
        <th>Valor total do dia</th>
        <td><?php
            $total = 0;
            foreach($tabela as $l){
                $total += $l['nr_pago'];
            }
            echo $total.'.00';//printf('%.2f', $total);
        ?></td>
    </tr>
</table>
<?php else: ?>
<h2>Data início: <?php echo $dt_inicio ?></h2>
<h2>Data fim: <?php echo $dt_fim ?></h2>
<br/>
<table>
    <tr>
        <th>Total de inscrições pagas neste período</th>
        <td><?php echo count($tabela) ?></td>
    </tr>
    <tr>
        <th>Valor total do período</th>
        <td><?php
            $total = 0;
            foreach($tabela as $l){
                $total += $l['nr_pago'];
            }
            echo $total.'.00';//printf('%.2f', $total);
        ?></td>
    </tr>
</table>
<?php endif ?>
<br/>
<table width="800">
    <tr>
        <th width='40'>Inscr.</th>
        <th>Nome</th>
        <th width="70">Tipo</th>
        <th>Caixa</th>
        <th width="112">Forma</th>
        <th width="130">Data</th>
        <th width="45">Valor</th>
    </tr>
<?php foreach($tabela as $linha): ?>
    <tr>
        <td><?php echo $linha['id_pessoa'] ?></td>
        <td style="text-align:left"><?php echo $linha['nm_pessoa'] ?></td>
        <td><?php echo $linha['nm_tipo'] ?></td>
        <td style="text-align:left"><?php echo $linha['nm_usuario'] ?></td>
        <td><?php echo $linha['nm_tipo_pgto'] ?></td>
        <td><?php echo $linha['dt_pgto'] ?></td>
        <td><?php printf('%.2f', $linha['nr_pago']) ?></td>
    </tr>
<?php endforeach?>
</table>