<h1>Relatório de Sintético</h1>
<br/>
<h2>Data: <?php echo date('d/m/Y - h:m') ?></h2>
<br/>
<h2>Números gerais</h2>
<table>
    <tr>
        <th>Tipo</th>
		<td>Total de Inscrições*</td>
        <td>Inscrições concluídas**</td>
    </tr>
    <tr>
		<?php
			$p1 = empty($numeros['p'][1])?0:$numeros['p'][1];
			$p3 = empty($numeros['p'][3])?0:$numeros['p'][3];
		?>
        <th>Participante</th>
		<td><?php echo $p1 + $p3 ?></td>
        <td><?php echo $p3 ?></td>
    </tr>
    <tr>
		<?php
			$s1 = empty($numeros['s'][1])?0:$numeros['s'][1];
			$s2 = empty($numeros['s'][2])?0:$numeros['s'][2];
			$s3 = empty($numeros['s'][3])?0:$numeros['s'][3];
		?>
        <th>Serviço</th>
		<td><?php echo $s1 + $s2 + $s3 ?></td>
        <td><?php echo $s3 ?></td>
    </tr>
    <tr>
		<?php
			$v2 = empty($numeros['v'][2])?0:$numeros['v'][2];
			$v3 = empty($numeros['v'][3])?0:$numeros['v'][3];
		?>
        <th>Comunidade de Vida</th>
		<td><?php echo $v2 + $v3 ?></td>
        <td><?php echo $v3 ?></td>
    </tr>
    <tr>
        <th>Total</th>
		<td><strong><?php echo $p1 + $p3 + $s1 + $s2 + $s3 + $v2 + $v3 ?></strong></td>
        <td><strong><?php echo $p3 + $s3 + $v3 ?></strong></td>
    </tr>
</table>
<br/>
<p>* Este valor é o total de isncrições feitas pelo site, incluindo as que não foram concluídas.</p>
<p>** Inscrições que já foram pagas. No caso da CV, são as inscrições liberadas para o serviço.</p>
<br/>
<br/>
<h2>Por sexo</h2>
<p>* Somente concluídas</P>
<table>
    <tr>
        <td></td>
        <td>Participante</td>
        <td>Serviço</td>
		<td>Comunidade de Vida</td>
        <th>Total</th>
    </tr>
    <tr>
        <td>Homem</td>
        <td><?php echo $sexo_p_h = empty($sexo['p']['h'])?0:$sexo['p']['h'] ?></td>
        <td><?php echo $sexo_s_h = empty($sexo['s']['h'])?0:$sexo['s']['h'] ?></td>
		<td><?php echo $sexo_v_h = empty($sexo['v']['h'])?0:$sexo['v']['h'] ?></td>
        <th><?php echo $sexo_p_h + $sexo_s_h + $sexo_v_h ?></th>
    </tr>
    <tr>
        <td>Mulher</td>
        <td><?php echo $sexo_p_m = empty($sexo['p']['m'])?0:$sexo['p']['m'] ?></td>
        <td><?php echo $sexo_s_m = empty($sexo['s']['m'])?0:$sexo['s']['m'] ?></td>
		<td><?php echo $sexo_v_m = empty($sexo['v']['m'])?0:$sexo['v']['m'] ?></td>
        <th><?php echo $sexo_p_m + $sexo_s_m + $sexo_v_m ?></th>
    </tr>
	<tr>
		<th>Total</th>
		<th><?php echo $sexo_p_h + $sexo_p_m ?></th>
		<th><?php echo $sexo_s_h + $sexo_s_m ?></th>
		<th><?php echo $sexo_v_h + $sexo_v_m ?></th>
		<th><?php echo $sexo_p_h + $sexo_s_h + $sexo_v_h + $sexo_p_m + $sexo_s_m + $sexo_v_m ?></th>
	</tr>
</table>
<br/>
<h2>Transporte</h2>
<table>
    <tr>
        <td></td>
        <td>Participante</td>
        <td>Serviço</td>
        <th>Total</th>
    </tr>
    <tr>
        <td>Sim</td>
        <td><?php echo $transporte_p_s = empty($transporte['p']['s'])?0:$transporte['p']['s'] ?></td>
        <td><?php echo $transporte_s_s = empty($transporte['s']['s'])?0:$transporte['s']['s'] ?></td>
        <th><?php echo $transporte_p_s + $transporte_s_s ?></th>
    </tr>
    <tr>
        <td>Não</td>
        <td><?php echo $transporte_p_n = empty($transporte['p']['n'])?0:$transporte['p']['n'] ?></td>
        <td><?php echo $transporte_s_n = empty($transporte['s']['n'])?0:$transporte['s']['n'] ?></td>
        <th><?php echo $transporte_p_n + $transporte_s_n ?></th>
    </tr>
</table>
<br/>
<h2>Alimentação</h2>
<table>
    <tr>
        <td></td>
        <td>Participante</td>
        <td>Serviço</td>
        <td>Comunidade de Vida</td>
        <th>Total</th>
    </tr>
    <tr>
        <td>Sim</td>
        <td><?php echo $alimentacao_p_s = empty($alimentacao['p']['s'])?0:$alimentacao['p']['s'] ?></td>
        <td><?php echo $alimentacao_s_s = empty($alimentacao['s']['s'])?0:$alimentacao['s']['s'] ?></td>
        <td><?php echo $alimentacao_v_s = empty($alimentacao['v']['s'])?0:$alimentacao['v']['s'] ?></td>
        <th><?php echo $alimentacao_p_s + $alimentacao_s_s + $alimentacao_v_s ?></th>
    </tr>
    <tr>
        <td>Não</td>
        <td><?php echo $alimentacao_p_n = empty($alimentacao['p']['n'])?0:$alimentacao['p']['n'] ?></td>
        <td><?php echo $alimentacao_s_n = empty($alimentacao['s']['n'])?0:$alimentacao['s']['n'] ?></td>
        <td><?php echo $alimentacao_v_n = empty($alimentacao['v']['n'])?0:$alimentacao['v']['n'] ?></td>
        <th><?php echo $alimentacao_p_n + $alimentacao_s_n + $alimentacao_v_n ?></th>
    </tr>
</table>
<br/>
<h2>Barracão</h2>
<table>
    <tr>
        <td></td>
        <td>Participante</td>
        <td>Serviço</td>
        <th>Total</th>
    </tr>
    <tr>
        <td>Sim</td>
        <td><?php echo $barracao_p_s = empty($barracao['p']['s'])?0:$barracao['p']['s'] ?></td>
        <td><?php echo $barracao_s_s = empty($barracao['s']['s'])?0:$barracao['s']['s'] ?></td>
        <th><?php echo $barracao_p_s + $barracao_s_s ?></th>
    </tr>
    <tr>
        <td>Não</td>
        <td><?php echo $barracao_p_n = empty($barracao['p']['n'])?0:$barracao['p']['n'] ?></td>
        <td><?php echo $barracao_s_n = empty($barracao['s']['n'])?0:$barracao['s']['n'] ?></td>
        <th><?php echo $barracao_p_n + $barracao_s_n ?></th>
    </tr>
</table>
<br/>
<h2>Seminário</h2>
<table>
    <tr>
        <td></td>
        <th>Total</th>
    </tr>
    <tr>
        <td>Sim</td>
        <th><?php echo empty($seminario['s'])?0:$seminario['s'] ?></th>
    </tr>
    <tr>
        <td>Não</td>
        <th><?php echo empty($seminario['n'])?0:$seminario['n'] ?></th>
    </tr>
</table>
<br/>
<h2>1ª Eucaristia</h2>
<table>
    <tr>
        <td></td>
        <th>Total</th>
    </tr>
    <tr>
        <td>Sim</td>
        <th><?php echo empty($eucaristia['s'])?0:$eucaristia['s'] ?></th>
    </tr>
    <tr>
        <td>Não</td>
        <th><?php echo empty($eucaristia['n'])?0:$eucaristia['n'] ?></th>
    </tr>
</table>