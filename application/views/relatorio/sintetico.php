<h1>Relatório Sintético</h1>
<p>Relatório gerado em: <?php echo date('d/m/Y - H:m') ?></p>
<hr/>
<h2>Inscrições</h2>
<table>
	<thead>
		<tr>
			<th>Tipo</th>
			<?php if(ENVIRONMENT != 'acamps'): ?><th width="25%">Pré-Inscrições</th><?php endif ?>
			<th width="25%">Inscrições Concluídas</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php
				$p1 = empty($numeros['p'][1])?0:$numeros['p'][1];
				$p3 = empty($numeros['p'][3])?0:$numeros['p'][3];
			?>
			<td>Participante</th>
			<?php if(ENVIRONMENT != 'acamps'): ?><td><?php echo $p1 + $p3 ?></td><?php endif ?>
			<td><?php echo $p3 ?></td>
		</tr>
		<tr>
			<?php
				$s1 = empty($numeros['s'][1])?0:$numeros['s'][1];
				$s2 = empty($numeros['s'][2])?0:$numeros['s'][2];
				$s3 = empty($numeros['s'][3])?0:$numeros['s'][3];
			?>
			<td>Serviço</th>
			<?php if(ENVIRONMENT != 'acamps'): ?><td><?php echo $s1 + $s2 + $s3 ?></td><?php endif ?>
			<td><?php echo $s3 ?></td>
		</tr>
		<tr>
			<?php
				$v2 = empty($numeros['v'][2])?0:$numeros['v'][2];
				$v3 = empty($numeros['v'][3])?0:$numeros['v'][3];
			?>
			<td>Comunidade de Vida</th>
			<?php if(ENVIRONMENT != 'acamps'): ?><td><?php echo $v2 + $v3 ?></td><?php endif ?>
			<td><?php echo $v3 ?></td>
		</tr>
		<tr>
			<?php
				$e2 = empty($numeros['e'][2])?0:$numeros['e'][2];
				$e3 = empty($numeros['e'][3])?0:$numeros['e'][3];
			?>
			<td>Especial</th>
			<?php if(ENVIRONMENT != 'acamps'): ?><td><?php echo $e2 + $e3 ?></td><?php endif ?>
			<td><?php echo $e3 ?></td>
		</tr>
		<tr>
			<th>Total</th>
			<?php if(ENVIRONMENT != 'acamps'): ?><td><strong><?php echo $p1 + $p3 + $s1 + $s2 + $s3 + $v2 + $v3 + $e2 + $e3 ?></strong></td><?php endif ?>
			<td><strong><?php echo $p3 + $s3 + $v3 + $e3 ?></strong></td>
		</tr>
	</tbody>
</table>
<h2>Números Gerais</h2>
<?php if(ENVIRONMENT != 'acamps') echo '<p>* Somente inscrições concluídas</p>' ?>
<table>
	<thead>
		<tr>
			<th></th>
			<th width="15%">Participante</th>
			<th width="15%">Serviço</th>
			<th width="15%">Com. de Vida</th>
			<th width="15%">Especial</th>
			<th width="10%">Total</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th colspan="6">Por sexo</th>
		</tr>
		<tr>
			<td>Homens</td>
			<td><?php echo $sexo_p_h = empty($sexo['p']['h'])?0:$sexo['p']['h'] ?></td>
			<td><?php echo $sexo_s_h = empty($sexo['s']['h'])?0:$sexo['s']['h'] ?></td>
			<td><?php echo $sexo_v_h = empty($sexo['v']['h'])?0:$sexo['v']['h'] ?></td>
			<td><?php echo $sexo_e_h = empty($sexo['e']['h'])?0:$sexo['e']['h'] ?></td>
			<th><?php echo $sexo_p_h + $sexo_s_h + $sexo_v_h + $sexo_e_h ?></th>
		</tr>
		<tr>
			<td>Mulheres</td>
			<td><?php echo $sexo_p_m = empty($sexo['p']['m'])?0:$sexo['p']['m'] ?></td>
			<td><?php echo $sexo_s_m = empty($sexo['s']['m'])?0:$sexo['s']['m'] ?></td>
			<td><?php echo $sexo_v_m = empty($sexo['v']['m'])?0:$sexo['v']['m'] ?></td>
			<td><?php echo $sexo_e_m = empty($sexo['e']['m'])?0:$sexo['e']['m'] ?></td>
			<th><?php echo $sexo_p_m + $sexo_s_m + $sexo_v_m + $sexo_e_m ?></th>
		</tr>
		<?php /*<tr>
			<th>Total</th>
			<th><?php echo $sexo_p_h + $sexo_p_m ?></th>
			<th><?php echo $sexo_s_h + $sexo_s_m ?></th>
			<th><?php echo $sexo_v_h + $sexo_v_m ?></th>
			<th><?php echo $sexo_e_h + $sexo_e_m ?></th>
			<th><?php echo $sexo_p_h + $sexo_s_h + $sexo_v_h + $sexo_p_m + $sexo_s_m + $sexo_v_m ?></th>
		</tr>*/ ?>
		<tr>
		<tr>
			<th colspan="6">Transporte</th>
		</tr>
			<td>Ônibus</td>
			<td><?php echo $transporte_p_s = empty($transporte['p']['s'])?0:$transporte['p']['s'] ?></td>
			<td><?php echo $transporte_s_s = empty($transporte['s']['s'])?0:$transporte['s']['s'] ?></td>
			<td><?php echo $transporte_v_s = empty($transporte['v']['s'])?0:$transporte['v']['s'] ?></td>
			<td>-</td>
			<th><?php echo $transporte_p_s + $transporte_s_s + $transporte_v_s ?></th>
		</tr>
		<tr>
			<td>Transporte Particular</td>
			<td><?php echo $transporte_p_n = empty($transporte['p']['n'])?0:$transporte['p']['n'] ?></td>
			<td><?php echo $transporte_s_n = empty($transporte['s']['n'])?0:$transporte['s']['n'] ?></td>
			<td><?php echo $transporte_v_n = empty($transporte['v']['n'])?0:$transporte['v']['n'] ?></td>
			<td>-</td>
			<th><?php echo $transporte_p_n + $transporte_s_n + $transporte_v_n ?></th>
		</tr>
		<tr>
			<th colspan="6">Alimentação</th>
		</tr>
		<tr>
			<td>Utilizarão a alimentação</td>
			<td><?php echo $alimentacao_p_s = empty($alimentacao['p']['s'])?0:$alimentacao['p']['s'] ?></td>
			<td><?php echo $alimentacao_s_s = empty($alimentacao['s']['s'])?0:$alimentacao['s']['s'] ?></td>
			<td><?php echo $alimentacao_v_s = empty($alimentacao['v']['s'])?0:$alimentacao['v']['s'] ?></td>
			<td><?php echo $alimentacao_e_s = empty($alimentacao['e']['s'])?0:$alimentacao['e']['s'] ?></td>
			<th><?php echo $alimentacao_p_s + $alimentacao_s_s + $alimentacao_v_s + $alimentacao_e_s ?></th>
		</tr>
		<tr>
			<td>Não utilizarão a alimentação</td>
			<td><?php echo $alimentacao_p_n = empty($alimentacao['p']['n'])?0:$alimentacao['p']['n'] ?></td>
			<td><?php echo $alimentacao_s_n = empty($alimentacao['s']['n'])?0:$alimentacao['s']['n'] ?></td>
			<td><?php echo $alimentacao_v_n = empty($alimentacao['v']['n'])?0:$alimentacao['v']['n'] ?></td>
			<td><?php echo $alimentacao_e_n = empty($alimentacao['e']['n'])?0:$alimentacao['e']['n'] ?></td>
			<th><?php echo $alimentacao_p_n + $alimentacao_s_n + $alimentacao_v_n + $alimentacao_e_n ?></th>
		</tr>
		<tr>
			<th colspan="6">Alojamento</th>
		</tr>
		<tr>
			<td>Barracão</td>
			<td><?php echo $barracao_p_s = empty($barracao['p']['s'])?0:$barracao['p']['s'] ?></td>
			<td><?php echo $barracao_s_s = empty($barracao['s']['s'])?0:$barracao['s']['s'] ?></td>
			<td>-</td>
			<td>-</td>
			<th><?php echo $barracao_p_s + $barracao_s_s ?></th>
		</tr>
		<tr>
			<td>Barraca Particular</td>
			<td><?php echo $barracao_p_n = empty($barracao['p']['n'])?0:$barracao['p']['n'] ?></td>
			<td><?php echo $barracao_s_n = empty($barracao['s']['n'])?0:$barracao['s']['n'] ?></td>
			<td>-</td>
			<td>-</td>
			<th><?php echo $barracao_p_n + $barracao_s_n ?></th>
		</tr>
	</tbody>
</table>
<h2>Participantes</h2>
<?php if(ENVIRONMENT != 'acamps') echo '<p>* Somente inscrições concluídas</p>' ?>
<table>
	<thead>
		<tr>
			<th>Atividade</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Seminário</td>
			<th><?php echo empty($seminario['s'])?0:$seminario['s'] ?></th>
		</tr>
		<tr>
			<td>Aprofundamento</td>
			<th><?php echo empty($seminario['n'])?0:$seminario['n'] ?></th>
		</tr>
		<tr>
			<td>1ª Eucaristia</td>
			<th><?php echo empty($eucaristia['s'])?0:$eucaristia['s'] ?></th>
		</tr>
	</tbody>
</table>